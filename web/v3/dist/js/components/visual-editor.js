/**
 * SmartFlat CMS v3 - Visual Editor
 * WYSIWYG drag & drop editor for home/main screen layouts
 */

'use strict';

// eslint-disable-next-line no-var
var visualEditor = {
    // State
    homeData: null,
    homedatas: [],
    maindatas: [],
    currentTab: 'home',
    currentProjectId: null,
    hmIdx: null,

    // Canvas
    canvasWidth: 1080,
    canvasHeight: 1920,
    scale: 0.5,
    showGrid: false,
    snapEnabled: false,
    snapSize: 10,

    // Selection
    selectedIdx: -1,
    selectedEl: null,
    currentTool: 'select',

    // Drag state
    isDragging: false,
    isResizing: false,
    resizeDir: '',
    dragStartX: 0,
    dragStartY: 0,
    dragOrigX: 0,
    dragOrigY: 0,
    dragOrigW: 0,
    dragOrigH: 0,

    // Undo/Redo
    undoStack: [],
    redoStack: [],
    maxUndo: 50,

    // Auto-save
    saveTimer: null,
    isDirty: false,

    /**
     * Initialize
     */
    init: function() {
        this.loadProjects();
        this.bindKeyboard();
        this.bindCanvasEvents();
    },

    /**
     * Load project list
     */
    loadProjects: async function() {
        try {
            var res = await V3Api.get('/homes');
            if (res.code === 100 && res.data) {
                var select = document.getElementById('ve-project-select');
                res.data.forEach(function(home) {
                    var opt = document.createElement('option');
                    opt.value = home.hm_idx;
                    opt.textContent = home.hm_projectname
                        ? home.hm_projectname + ' (' + home.hm_projectid + ')'
                        : home.hm_projectid;
                    select.appendChild(opt);
                });
            }
        } catch (err) {
            cerror('Failed to load projects:', err);
        }
    },

    /**
     * Handle project change
     */
    onProjectChange: async function(hmIdx) {
        if (!hmIdx) return;

        this.hmIdx = hmIdx;
        C_ShowLoadingProgress();

        try {
            var res = await V3Api.get('/homes/' + hmIdx);
            if (res.code === 100 && res.data) {
                this.homeData = res.data;
                this.homedatas = res.data.home_data || [];
                this.maindatas = res.data.main_data || [];
                this.currentProjectId = res.data.hm_projectid;

                // Set canvas dimensions
                this.canvasWidth = res.data.hm_width > 0 ? parseInt(res.data.hm_width) : (res.data.hm_orientation === 'L' ? 1920 : 1080);
                this.canvasHeight = res.data.hm_height > 0 ? parseInt(res.data.hm_height) : (res.data.hm_orientation === 'L' ? 1080 : 1920);

                document.getElementById('ve-info-text').textContent = this.canvasWidth + ' x ' + this.canvasHeight;

                this.undoStack = [];
                this.redoStack = [];
                this.zoomFit();
                this.renderCanvas();
            }
        } catch (err) {
            cerror('Failed to load data:', err);
            toastError('데이터를 불러오는데 실패했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    },

    // =========================================
    // Canvas Rendering
    // =========================================

    /**
     * Render all elements on the canvas
     */
    renderCanvas: function() {
        var canvas = document.getElementById('ve-canvas');
        var wrapper = document.getElementById('ve-canvas-wrapper');

        // Set wrapper size (scaled)
        wrapper.style.width = Math.round(this.canvasWidth * this.scale) + 'px';
        wrapper.style.height = Math.round(this.canvasHeight * this.scale) + 'px';

        // Set canvas size and scale
        canvas.style.width = this.canvasWidth + 'px';
        canvas.style.height = this.canvasHeight + 'px';
        canvas.style.transform = 'scale(' + this.scale + ')';

        if (this.showGrid) {
            canvas.classList.add('show-grid');
        } else {
            canvas.classList.remove('show-grid');
        }

        // Get current data
        var items = this.getCurrentItems();
        var self = this;

        // Clear and rebuild
        canvas.innerHTML = '';

        items.forEach(function(item, idx) {
            var el = self.createCanvasElement(item, idx);
            canvas.appendChild(el);
        });

        // Reselect if needed
        if (this.selectedIdx >= 0 && this.selectedIdx < items.length) {
            var selEl = canvas.querySelector('[data-idx="' + this.selectedIdx + '"]');
            if (selEl) {
                selEl.classList.add('selected');
                this.selectedEl = selEl;
                this.addResizeHandles(selEl);
            }
        }
    },

    /**
     * Create a canvas element from item data
     */
    /**
     * Convert data x,y (center anchor) to CSS left,top (top-left corner)
     */
    dataToCss: function(x, y, w, h) {
        return {
            left: x - Math.round(w / 2),
            top: y - Math.round(h / 2)
        };
    },

    /**
     * Convert CSS left,top (top-left corner) to data x,y (center anchor)
     */
    cssToData: function(left, top, w, h) {
        return {
            x: left + Math.round(w / 2),
            y: top + Math.round(h / 2)
        };
    },

    createCanvasElement: function(item, idx) {
        var el = document.createElement('div');
        el.className = 'canvas-element';
        el.dataset.idx = idx;

        var cx = parseInt(item.x) || 0;
        var cy = parseInt(item.y) || 0;
        var hasW = item.w !== undefined && item.w !== '' && item.w !== null;
        var hasH = item.h !== undefined && item.h !== '' && item.h !== null;
        var w = hasW ? parseInt(item.w) : 200;
        var h = hasH ? parseInt(item.h) : 200;

        // x,y는 중앙 좌표 → CSS left,top은 좌상단으로 변환
        var pos = this.dataToCss(cx, cy, w, h);
        el.style.left = pos.left + 'px';
        el.style.top = pos.top + 'px';
        el.style.width = w + 'px';
        el.style.height = h + 'px';

        // Label
        var label = document.createElement('div');
        label.className = 'element-label';
        label.textContent = (item.name || item.id || 'element') + ' [' + (item.type || '') + ']';
        el.appendChild(label);

        // Render based on type
        var self = this;
        switch (item.type) {
            case 'img':
            case 'button':
            case 'button_empty':
            case 'animation':
                if (item.imgurl) {
                    var img = document.createElement('img');
                    img.src = item.imgurl;
                    img.draggable = false;
                    // w/h 값이 없으면 이미지 원본 사이즈로 설정 + 중앙 기준 위치 재조정
                    if (!hasW || !hasH) {
                        img.onload = function() {
                            var natW = this.naturalWidth;
                            var natH = this.naturalHeight;
                            if (natW > 0 && natH > 0) {
                                var finalW = hasW ? parseInt(item.w) : natW;
                                var finalH = hasH ? parseInt(item.h) : natH;
                                item.w = String(finalW);
                                item.h = String(finalH);
                                el.style.width = finalW + 'px';
                                el.style.height = finalH + 'px';
                                // x,y(중앙)는 그대로, CSS 위치만 재계산
                                var newPos = self.dataToCss(parseInt(item.x) || 0, parseInt(item.y) || 0, finalW, finalH);
                                el.style.left = newPos.left + 'px';
                                el.style.top = newPos.top + 'px';
                                self.updatePanelValues();
                            }
                        };
                    }
                    img.onerror = function() { this.style.display = 'none'; };
                    el.appendChild(img);
                } else {
                    el.style.background = 'rgba(0,158,247,0.1)';
                    el.style.border = '1px dashed rgba(0,158,247,0.3)';
                    el.innerHTML += '<div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:#999;font-size:12px;">' +
                        '<i class="fas fa-image"></i></div>';
                }
                break;

            case 'text':
                el.className += ' canvas-element-text';
                el.style.color = item.fontcolor || '#ffffff';
                el.style.fontSize = item.fontsize || '16px';
                el.style.textAlign = item.textalign || 'left';
                el.style.display = 'flex';
                el.style.alignItems = 'center';
                var textMap = {
                    'text_notice': '공지사항 텍스트',
                    'm/d': '03/18',
                    'hh:mm': '14:30',
                    'weekday': '수요일',
                    'yyyy': '2026',
                    'hh:mm:ss': '14:30:00',
                    'yyyymmdd': '2026.03.18'
                };
                var span = document.createElement('span');
                span.style.width = '100%';
                span.textContent = textMap[item.texttype] || item.name || 'Text';
                el.appendChild(span);
                break;

            case 'video':
                el.className += ' canvas-element-video';
                el.innerHTML += '<i class="fas fa-play-circle"></i>';
                break;

            case 'bgcolor':
                el.className += ' canvas-element-bgcolor';
                el.style.background = item.color || '#000000';
                break;

            case 'airapi':
                el.style.background = 'rgba(76,175,80,0.1)';
                el.style.border = '1px dashed rgba(76,175,80,0.3)';
                el.innerHTML += '<div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:#4caf50;font-size:12px;">' +
                    '<i class="fas fa-wind"></i>&nbsp;공기질</div>';
                break;

            case 'weatherapi':
                el.style.background = 'rgba(33,150,243,0.1)';
                el.style.border = '1px dashed rgba(33,150,243,0.3)';
                el.innerHTML += '<div style="display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:#2196f3;font-size:12px;">' +
                    '<i class="fas fa-cloud-sun"></i>&nbsp;날씨</div>';
                break;

            default:
                el.style.background = 'rgba(128,128,128,0.1)';
                el.style.border = '1px dashed rgba(128,128,128,0.3)';
                var defaultLabel = document.createElement('div');
                defaultLabel.style.cssText = 'display:flex;align-items:center;justify-content:center;width:100%;height:100%;color:#999;font-size:11px;';
                defaultLabel.textContent = item.type || 'unknown';
                el.appendChild(defaultLabel);
        }

        return el;
    },

    /**
     * Get items for current tab
     */
    getCurrentItems: function() {
        return this.currentTab === 'home' ? this.homedatas : this.maindatas;
    },

    // =========================================
    // Selection & Interaction
    // =========================================

    bindCanvasEvents: function() {
        var canvas = document.getElementById('ve-canvas');
        if (!canvas) return;

        var self = this;

        canvas.addEventListener('mousedown', function(e) {
            self.onCanvasMouseDown(e);
        });

        document.addEventListener('mousemove', function(e) {
            self.onCanvasMouseMove(e);
        });

        document.addEventListener('mouseup', function(e) {
            self.onCanvasMouseUp(e);
        });
    },

    onCanvasMouseDown: function(e) {
        var target = e.target.closest('.canvas-element');
        var resizeHandle = e.target.closest('.resize-handle');

        if (resizeHandle) {
            // Start resize
            e.preventDefault();
            this.isResizing = true;
            this.resizeDir = resizeHandle.dataset.dir;
            this.dragStartX = e.clientX;
            this.dragStartY = e.clientY;
            var items = this.getCurrentItems();
            var item = items[this.selectedIdx];
            this.dragOrigX = parseInt(item.x) || 0;
            this.dragOrigY = parseInt(item.y) || 0;
            this.dragOrigW = parseInt(item.w) || parseInt(this.selectedEl.style.width) || 100;
            this.dragOrigH = parseInt(item.h) || parseInt(this.selectedEl.style.height) || 100;
            this.pushUndo();
            return;
        }

        if (target) {
            var idx = parseInt(target.dataset.idx);
            this.selectElement(idx);

            // Start drag — dragOrig stores data x,y (center coordinates)
            e.preventDefault();
            this.isDragging = true;
            this.dragStartX = e.clientX;
            this.dragStartY = e.clientY;
            var items = this.getCurrentItems();
            var item = items[idx];
            this.dragOrigX = parseInt(item.x) || 0;
            this.dragOrigY = parseInt(item.y) || 0;
            this.pushUndo();
        } else {
            this.deselectAll();
        }
    },

    onCanvasMouseMove: function(e) {
        if (!this.isDragging && !this.isResizing) return;

        var dx = (e.clientX - this.dragStartX) / this.scale;
        var dy = (e.clientY - this.dragStartY) / this.scale;

        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        if (this.isDragging) {
            // dragOrig is data x,y (center), dx/dy is pixel movement
            var newX = Math.round(this.dragOrigX + dx);
            var newY = Math.round(this.dragOrigY + dy);

            if (this.snapEnabled) {
                newX = Math.round(newX / this.snapSize) * this.snapSize;
                newY = Math.round(newY / this.snapSize) * this.snapSize;
            }

            item.x = String(newX);
            item.y = String(newY);

            // Convert center x,y → CSS left,top
            if (this.selectedEl) {
                var w = parseInt(item.w) || parseInt(this.selectedEl.style.width) || 100;
                var h = parseInt(item.h) || parseInt(this.selectedEl.style.height) || 100;
                var pos = this.dataToCss(newX, newY, w, h);
                this.selectedEl.style.left = pos.left + 'px';
                this.selectedEl.style.top = pos.top + 'px';
            }
            this.updatePanelValues();
        }

        if (this.isResizing) {
            var dir = this.resizeDir;
            // dragOrig stores data center x,y and w,h
            // First compute the original CSS top-left
            var origPos = this.dataToCss(this.dragOrigX, this.dragOrigY, this.dragOrigW, this.dragOrigH);
            var cssLeft = origPos.left;
            var cssTop = origPos.top;
            var newW = this.dragOrigW;
            var newH = this.dragOrigH;

            // Resize from edges (CSS top-left based)
            if (dir.includes('e')) newW = Math.max(10, this.dragOrigW + Math.round(dx));
            if (dir.includes('w')) {
                newW = Math.max(10, this.dragOrigW - Math.round(dx));
                cssLeft = origPos.left + Math.round(dx);
            }
            if (dir.includes('s')) newH = Math.max(10, this.dragOrigH + Math.round(dy));
            if (dir.includes('n')) {
                newH = Math.max(10, this.dragOrigH - Math.round(dy));
                cssTop = origPos.top + Math.round(dy);
            }

            if (this.snapEnabled) {
                newW = Math.round(newW / this.snapSize) * this.snapSize;
                newH = Math.round(newH / this.snapSize) * this.snapSize;
            }

            // Convert CSS left,top back to data center x,y
            var center = this.cssToData(cssLeft, cssTop, newW, newH);
            item.x = String(center.x);
            item.y = String(center.y);
            item.w = String(newW);
            item.h = String(newH);

            if (this.selectedEl) {
                this.selectedEl.style.left = cssLeft + 'px';
                this.selectedEl.style.top = cssTop + 'px';
                this.selectedEl.style.width = newW + 'px';
                this.selectedEl.style.height = newH + 'px';
            }
            this.updatePanelValues();
        }
    },

    onCanvasMouseUp: function() {
        if (this.isDragging || this.isResizing) {
            this.markDirty();
        }
        this.isDragging = false;
        this.isResizing = false;
    },

    selectElement: function(idx) {
        this.deselectAll();
        this.selectedIdx = idx;

        var canvas = document.getElementById('ve-canvas');
        var el = canvas.querySelector('[data-idx="' + idx + '"]');
        if (el) {
            el.classList.add('selected');
            this.selectedEl = el;
            this.addResizeHandles(el);
        }

        this.showPropertyPanel(idx);
    },

    deselectAll: function() {
        var canvas = document.getElementById('ve-canvas');
        if (canvas) {
            canvas.querySelectorAll('.canvas-element.selected').forEach(function(el) {
                el.classList.remove('selected');
            });
            canvas.querySelectorAll('.resize-handle').forEach(function(h) { h.remove(); });
        }
        this.selectedIdx = -1;
        this.selectedEl = null;
        this.hidePropertyPanel();
    },

    addResizeHandles: function(el) {
        // Remove existing handles
        el.querySelectorAll('.resize-handle').forEach(function(h) { h.remove(); });

        var dirs = ['nw','n','ne','e','se','s','sw','w'];
        dirs.forEach(function(dir) {
            var handle = document.createElement('div');
            handle.className = 'resize-handle ' + dir;
            handle.dataset.dir = dir;
            el.appendChild(handle);
        });
    },

    // =========================================
    // Property Panel
    // =========================================

    showPropertyPanel: function(idx) {
        var items = this.getCurrentItems();
        var item = items[idx];
        if (!item) return;

        document.getElementById('ve-panel-empty').style.display = 'none';
        var panel = document.getElementById('ve-panel-content');
        panel.style.display = 'block';

        panel.innerHTML = this.buildPanelHtml(item);
    },

    hidePropertyPanel: function() {
        document.getElementById('ve-panel-empty').style.display = 'block';
        document.getElementById('ve-panel-content').style.display = 'none';
    },

    buildPanelHtml: function(item) {
        var html = this.buildPanelBasicSection(item);
        html += this.buildPanelPositionSection(item);
        html += this.buildPanelTypeSection(item);
        html += this.buildPanelEventSection(item);
        html += '<div class="panel-section" style="text-align:center;">' +
            '<button class="btn btn-sm btn-light" style="color:var(--color-danger);" onclick="visualEditor.deleteSelected()"><i class="fas fa-trash"></i> 요소 삭제</button></div>';
        return html;
    },

    buildPanelBasicSection: function(item) {
        var typeClass = (typeof channelEditor !== 'undefined' && channelEditor.getTypeClass) ? channelEditor.getTypeClass(item.type) : '';
        return '<div class="panel-section">' +
            '<div class="panel-section-title">기본 정보</div>' +
            '<div class="panel-row"><span class="panel-label">ID</span>' +
            '<input class="panel-input" value="' + escapeHtml(item.id || '') + '" readonly style="background:var(--bg-input);opacity:0.6;"></div>' +
            '<div class="panel-row"><span class="panel-label">이름</span>' +
            '<input class="panel-input" id="ve-prop-name" value="' + escapeHtml(item.name || '') + '" onchange="visualEditor.onPropChange(\'name\',this.value)"></div>' +
            '<div class="panel-row"><span class="panel-label">타입</span>' +
            '<span style="font-size:12px;" class="type-badge ' + escapeHtml(typeClass) + '">' + escapeHtml(item.type || '') + '</span></div></div>';
    },

    buildPanelPositionSection: function(item) {
        return '<div class="panel-section">' +
            '<div class="panel-section-title">위치 & 크기</div>' +
            '<div class="panel-row">' +
            '<span class="panel-label">X</span><input class="panel-input panel-input-sm" type="number" id="ve-prop-x" value="' + (parseInt(item.x) || 0) + '" onchange="visualEditor.onPropChange(\'x\',this.value)">' +
            '<span class="panel-label">Y</span><input class="panel-input panel-input-sm" type="number" id="ve-prop-y" value="' + (parseInt(item.y) || 0) + '" onchange="visualEditor.onPropChange(\'y\',this.value)"></div>' +
            '<div class="panel-row">' +
            '<span class="panel-label">W</span><input class="panel-input panel-input-sm" type="number" id="ve-prop-w" value="' + (item.w || '') + '" onchange="visualEditor.onPropChange(\'w\',this.value)">' +
            '<span class="panel-label">H</span><input class="panel-input panel-input-sm" type="number" id="ve-prop-h" value="' + (item.h || '') + '" onchange="visualEditor.onPropChange(\'h\',this.value)"></div></div>';
    },

    buildPanelTypeSection: function(item) {
        var html = '';
        if (item.type === 'img' || item.type === 'button' || item.type === 'animation') {
            html += '<div class="panel-section"><div class="panel-section-title">이미지</div>' +
                '<div class="panel-row"><span class="panel-label">URL</span>' +
                '<input class="panel-input" id="ve-prop-imgurl" value="' + escapeHtml(item.imgurl || '') + '" onchange="visualEditor.onPropChange(\'imgurl\',this.value)"></div>' +
                '<div class="panel-row"><span class="panel-label">클릭</span>' +
                '<input class="panel-input" id="ve-prop-clickurl" value="' + escapeHtml(item.clickurl || '') + '" onchange="visualEditor.onPropChange(\'clickurl\',this.value)"></div></div>';
        }
        if (item.type === 'text') {
            var ttOpts = ['text_notice','m/d','hh:mm','weekday','yyyy','hh:mm:ss','yyyymmdd']
                .map(function(t) { return '<option value="' + t + '" ' + (t === item.texttype ? 'selected' : '') + '>' + t + '</option>'; }).join('');
            html += '<div class="panel-section"><div class="panel-section-title">텍스트</div>' +
                '<div class="panel-row"><span class="panel-label">종류</span>' +
                '<select class="panel-select" id="ve-prop-texttype" onchange="visualEditor.onPropChange(\'texttype\',this.value)">' + ttOpts + '</select></div>' +
                '<div class="panel-row"><span class="panel-label">크기</span>' +
                '<input class="panel-input panel-input-sm" id="ve-prop-fontsize" value="' + escapeHtml(item.fontsize || '16px') + '" onchange="visualEditor.onPropChange(\'fontsize\',this.value)">' +
                '<span class="panel-label">정렬</span><select class="panel-select" id="ve-prop-textalign" onchange="visualEditor.onPropChange(\'textalign\',this.value)" style="width:70px;">' +
                '<option value="left" ' + (item.textalign === 'left' ? 'selected' : '') + '>좌</option>' +
                '<option value="center" ' + (item.textalign === 'center' ? 'selected' : '') + '>중</option>' +
                '<option value="right" ' + (item.textalign === 'right' ? 'selected' : '') + '>우</option></select></div>' +
                '<div class="panel-row"><span class="panel-label">색상</span>' +
                '<input class="panel-color-input" type="color" id="ve-prop-fontcolor" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="visualEditor.onPropChange(\'fontcolor\',this.value)">' +
                '<input class="panel-input" id="ve-prop-fontcolor-text" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="visualEditor.onPropChange(\'fontcolor\',this.value)" style="flex:1;"></div></div>';
        }
        if (item.type === 'video') {
            html += '<div class="panel-section"><div class="panel-section-title">동영상</div>' +
                '<div class="panel-row"><span class="panel-label">URL</span>' +
                '<input class="panel-input" id="ve-prop-videourl" value="' + escapeHtml(item.videourl || '') + '" onchange="visualEditor.onPropChange(\'videourl\',this.value)"></div></div>';
        }
        if (item.type === 'bgcolor') {
            html += '<div class="panel-section"><div class="panel-section-title">배경색</div>' +
                '<div class="panel-row"><span class="panel-label">색상</span>' +
                '<input class="panel-color-input" type="color" id="ve-prop-color" value="' + escapeHtml(item.color || '#000000') + '" onchange="visualEditor.onPropChange(\'color\',this.value)">' +
                '<input class="panel-input" value="' + escapeHtml(item.color || '#000000') + '" onchange="visualEditor.onPropChange(\'color\',this.value)" style="flex:1;"></div></div>';
        }
        return html;
    },

    buildPanelEventSection: function(item) {
        if (item.type !== 'button' && item.type !== 'button_empty' && !item.event) return '';
        var evt = item.event || {};
        return '<div class="panel-section"><div class="panel-section-title">이벤트</div>' +
            '<div class="panel-row"><span class="panel-label">page</span>' +
            '<input class="panel-input panel-input-sm" id="ve-prop-evt-page" value="' + escapeHtml(evt.page || '') + '" onchange="visualEditor.onEventChange()"></div>' +
            '<div class="panel-row"><span class="panel-label">tab</span>' +
            '<input class="panel-input panel-input-sm" id="ve-prop-evt-tab" value="' + escapeHtml(evt.tab || '') + '" onchange="visualEditor.onEventChange()"></div>' +
            '<div class="panel-row"><span class="panel-label">sub</span>' +
            '<input class="panel-input panel-input-sm" id="ve-prop-evt-sub" value="' + escapeHtml(evt.sub || '') + '" onchange="visualEditor.onEventChange()"></div></div>';
    },

    /**
     * Update panel values without rebuilding
     */
    updatePanelValues: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        var xEl = document.getElementById('ve-prop-x');
        var yEl = document.getElementById('ve-prop-y');
        var wEl = document.getElementById('ve-prop-w');
        var hEl = document.getElementById('ve-prop-h');
        if (xEl) xEl.value = item.x || 0;
        if (yEl) yEl.value = item.y || 0;
        if (wEl) wEl.value = item.w || '';
        if (hEl) hEl.value = item.h || '';
    },

    /**
     * Property change handler
     */
    onPropChange: function(prop, value) {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        this.pushUndo();
        item[prop] = value;
        this.renderCanvas();
        this.markDirty();
    },

    /**
     * Event property change
     */
    onEventChange: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        this.pushUndo();
        var pageEl = document.getElementById('ve-prop-evt-page');
        var tabEl = document.getElementById('ve-prop-evt-tab');
        var subEl = document.getElementById('ve-prop-evt-sub');
        item.event = {
            page: pageEl ? pageEl.value : '',
            tab: tabEl ? tabEl.value : '',
            sub: subEl ? subEl.value : ''
        };
        this.markDirty();
    },

    /**
     * Delete selected element
     */
    deleteSelected: function() {
        if (this.selectedIdx < 0) return;

        var items = this.getCurrentItems();
        var name = items[this.selectedIdx] ? items[this.selectedIdx].name : '';
        var self = this;

        confirmMsg('"' + escapeHtml(name) + '" 요소를 삭제하시겠습니까?', function() {
            self.pushUndo();
            items.splice(self.selectedIdx, 1);
            self.deselectAll();
            self.renderCanvas();
            self.markDirty();
        });
    },

    // =========================================
    // Tabs
    // =========================================

    switchTab: function(tab) {
        this.currentTab = tab;
        this.deselectAll();

        document.getElementById('ve-tab-home').classList.toggle('active', tab === 'home');
        document.getElementById('ve-tab-main').classList.toggle('active', tab === 'main');

        this.renderCanvas();
    },

    // =========================================
    // Tools
    // =========================================

    setTool: function(tool) {
        this.currentTool = tool;
        document.getElementById('ve-tool-select').classList.toggle('active', tool === 'select');
        document.getElementById('ve-tool-move').classList.toggle('active', tool === 'move');
    },

    toggleGrid: function() {
        this.showGrid = !this.showGrid;
        document.getElementById('ve-grid-btn').classList.toggle('active', this.showGrid);
        this.renderCanvas();
    },

    toggleSnap: function() {
        this.snapEnabled = !this.snapEnabled;
        document.getElementById('ve-snap-btn').classList.toggle('active', this.snapEnabled);
    },

    setAnchor: function(anchor) {
        // Anchor changes how x,y is interpreted
        // For now, store as metadata on selected item
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (item) {
            this.pushUndo();
            item.anchor = anchor;
            this.markDirty();
        }
    },

    // =========================================
    // Zoom
    // =========================================

    zoomIn: function() {
        this.scale = Math.min(2, this.scale + 0.1);
        this.updateZoom();
    },

    zoomOut: function() {
        this.scale = Math.max(0.1, this.scale - 0.1);
        this.updateZoom();
    },

    zoomFit: function() {
        var area = document.getElementById('ve-canvas-area');
        if (!area) return;

        var padding = 24;
        var areaW = area.clientWidth - padding * 2;
        var areaH = area.clientHeight - padding * 2;

        var scaleW = this.canvasWidth > 0 ? areaW / this.canvasWidth : 1;
        var scaleH = this.canvasHeight > 0 ? areaH / this.canvasHeight : 1;
        // 영역에 맞추되 최대 1배까지
        this.scale = Math.min(scaleW, scaleH, 1);
        // 최소 0.15배 보장 (너무 작게 보이지 않도록)
        this.scale = Math.max(this.scale, 0.15);
        this.updateZoom();
    },

    updateZoom: function() {
        document.getElementById('ve-zoom-text').textContent = Math.round(this.scale * 100) + '%';
        this.renderCanvas();
    },

    // =========================================
    // Undo/Redo
    // =========================================

    pushUndo: function() {
        var state = {
            homedatas: JSON.parse(JSON.stringify(this.homedatas)),
            maindatas: JSON.parse(JSON.stringify(this.maindatas))
        };
        this.undoStack.push(state);
        if (this.undoStack.length > this.maxUndo) {
            this.undoStack.shift();
        }
        this.redoStack = [];
    },

    undo: function() {
        if (this.undoStack.length === 0) return;

        var redoState = {
            homedatas: JSON.parse(JSON.stringify(this.homedatas)),
            maindatas: JSON.parse(JSON.stringify(this.maindatas))
        };
        this.redoStack.push(redoState);

        var state = this.undoStack.pop();
        this.homedatas = state.homedatas;
        this.maindatas = state.maindatas;
        this.deselectAll();
        this.renderCanvas();
        this.markDirty();
    },

    redo: function() {
        if (this.redoStack.length === 0) return;

        var undoState = {
            homedatas: JSON.parse(JSON.stringify(this.homedatas)),
            maindatas: JSON.parse(JSON.stringify(this.maindatas))
        };
        this.undoStack.push(undoState);

        var state = this.redoStack.pop();
        this.homedatas = state.homedatas;
        this.maindatas = state.maindatas;
        this.deselectAll();
        this.renderCanvas();
        this.markDirty();
    },

    // =========================================
    // Save
    // =========================================

    markDirty: function() {
        this.isDirty = true;
        var indicator = document.getElementById('ve-save-indicator');
        indicator.className = 'save-indicator saving';
        indicator.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> 변경됨';

        // Debounced auto-save (2 seconds)
        if (this.saveTimer) clearTimeout(this.saveTimer);
        var self = this;
        this.saveTimer = setTimeout(function() {
            self.saveNow();
        }, 2000);
    },

    saveNow: async function() {
        if (!this.hmIdx) return;
        if (this.saveTimer) clearTimeout(this.saveTimer);

        var indicator = document.getElementById('ve-save-indicator');
        indicator.className = 'save-indicator saving';
        indicator.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> 저장 중...';

        try {
            // Save both home and main data
            await V3Api.put('/homes/' + this.hmIdx, {
                home_data: this.homedatas,
                main_data: this.maindatas
            });

            this.isDirty = false;
            indicator.className = 'save-indicator saved';
            indicator.innerHTML = '<i class="fas fa-check-circle"></i> 저장됨';
        } catch (err) {
            cerror('Save failed:', err);
            indicator.className = 'save-indicator error';
            indicator.innerHTML = '<i class="fas fa-exclamation-circle"></i> 저장 실패';
            toastError('저장에 실패했습니다.');
        }
    },

    // =========================================
    // Keyboard
    // =========================================

    bindKeyboard: function() {
        var self = this;
        document.addEventListener('keydown', function(e) {
            // Only handle if visual editor is active
            if (!document.getElementById('ve-canvas')) return;

            // Ctrl+Z: Undo
            if (e.ctrlKey && e.key === 'z' && !e.shiftKey) {
                e.preventDefault();
                self.undo();
            }
            // Ctrl+Y or Ctrl+Shift+Z: Redo
            if (e.ctrlKey && (e.key === 'y' || (e.key === 'z' && e.shiftKey))) {
                e.preventDefault();
                self.redo();
            }
            // Ctrl+S: Save
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                self.saveNow();
            }
            // Delete/Backspace: Delete selected
            if ((e.key === 'Delete' || e.key === 'Backspace') && self.selectedIdx >= 0) {
                // Don't delete if input is focused
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA' || e.target.tagName === 'SELECT') return;
                e.preventDefault();
                self.deleteSelected();
            }
            // Escape: Deselect
            if (e.key === 'Escape') {
                self.deselectAll();
            }
            // Arrow keys: move selected
            if (self.selectedIdx >= 0 && ['ArrowUp','ArrowDown','ArrowLeft','ArrowRight'].indexOf(e.key) >= 0) {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;
                e.preventDefault();
                var items = self.getCurrentItems();
                var item = items[self.selectedIdx];
                var step = e.shiftKey ? 10 : 1;

                self.pushUndo();
                if (e.key === 'ArrowUp') item.y = String((parseInt(item.y) || 0) - step);
                if (e.key === 'ArrowDown') item.y = String((parseInt(item.y) || 0) + step);
                if (e.key === 'ArrowLeft') item.x = String((parseInt(item.x) || 0) - step);
                if (e.key === 'ArrowRight') item.x = String((parseInt(item.x) || 0) + step);

                self.renderCanvas();
                self.markDirty();
            }
            // V: Select tool
            if (e.key === 'v' && !e.ctrlKey && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
                self.setTool('select');
            }
            // M: Move tool
            if (e.key === 'm' && !e.ctrlKey && e.target.tagName !== 'INPUT' && e.target.tagName !== 'TEXTAREA') {
                self.setTool('move');
            }
        });
    }
};
