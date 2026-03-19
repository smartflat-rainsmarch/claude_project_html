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
     * Project selection is handled by the global header selector
     */
    init: function() {
        this.bindKeyboard();
        this.bindCanvasEvents();
        this.initContextMenu();
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
                // text overlay on img/button (with style properties)
                if (item.text && typeof item.text === 'object') {
                    var langCode = (this.homeData && this.homeData.hm_language) || 'KO';
                    var textObj = item.text[langCode];
                    if (textObj && textObj.message) {
                        var overlay = document.createElement('div');
                        overlay.className = 'canvas-text-overlay';
                        overlay.textContent = textObj.message.replace(/\|/g, ' ');
                        // Apply text style properties
                        if (textObj.fontsize) overlay.style.fontSize = textObj.fontsize + 'px';
                        if (textObj.fontweight) overlay.style.fontWeight = textObj.fontweight;
                        if (textObj.color) overlay.style.color = textObj.color;
                        if (textObj.textalign) overlay.style.textAlign = textObj.textalign;
                        // If text has x,y, position absolutely within element
                        if (textObj.x !== undefined || textObj.y !== undefined) {
                            overlay.style.position = 'absolute';
                            overlay.style.bottom = 'auto';
                            overlay.style.left = (parseInt(textObj.x) || 0) + 'px';
                            overlay.style.top = (parseInt(textObj.y) || 0) + 'px';
                            overlay.style.right = 'auto';
                            overlay.style.background = 'transparent';
                            overlay.style.padding = '0';
                        }
                        el.appendChild(overlay);
                    }
                }
                break;

            case 'text':
                el.className += ' canvas-element-text';
                el.style.color = item.fontcolor || '#ffffff';
                el.style.fontSize = (item.fontsize || 16) + (String(item.fontsize).includes('px') ? '' : 'px');
                el.style.fontWeight = item.fontweight || 'normal';
                el.style.textAlign = item.textalign || 'left';
                el.style.display = 'flex';
                el.style.alignItems = 'center';
                var textMap = {
                    'text_notice': '공지사항 텍스트',
                    'm/d': '03/19',
                    'hh:mm': '14:30',
                    'weekday': '(수)',
                    'yyyy': '2026',
                    'hh:mm:ss': '14:30:00',
                    'yyyymmdd': '2026.03.19'
                };
                var displayText = item.text || textMap[item.texttype] || item.name || 'Text';
                if (typeof displayText === 'object') displayText = displayText.KO ? displayText.KO.message : item.name || 'Text';
                var span = document.createElement('span');
                span.style.width = '100%';
                span.textContent = displayText;
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
                '<div style="flex:1;display:flex;gap:4px;">' +
                '<input class="panel-input" id="ve-prop-imgurl" value="' + escapeHtml(item.imgurl || '') + '" onchange="visualEditor.onPropChange(\'imgurl\',this.value)" style="flex:1;">' +
                '<button class="panel-img-btn" onclick="visualEditor.pickImage(\'imgurl\')" title="이미지 변경"><i class="fas fa-folder-open"></i></button>' +
                '</div></div>' +
                '<div class="panel-row"><span class="panel-label">클릭</span>' +
                '<div style="flex:1;display:flex;gap:4px;">' +
                '<input class="panel-input" id="ve-prop-clickurl" value="' + escapeHtml(item.clickurl || '') + '" onchange="visualEditor.onPropChange(\'clickurl\',this.value)" style="flex:1;">' +
                '<button class="panel-img-btn" onclick="visualEditor.pickImage(\'clickurl\')" title="클릭 이미지 변경"><i class="fas fa-folder-open"></i></button>' +
                '</div></div>' +
                (item.imgurl ? '<div class="panel-row"><span class="panel-label"></span><img src="' + escapeHtml(item.imgurl) + '" style="max-width:100%;max-height:60px;border-radius:4px;border:1px solid var(--border-color);" onerror="this.style.display=\'none\'"></div>' : '') +
                '</div>';
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
                '<input class="panel-input" id="ve-prop-fontcolor-text" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="visualEditor.onPropChange(\'fontcolor\',this.value)" style="flex:1;"></div>' +
                '<div class="panel-row"><span class="panel-label">굵기</span>' +
                '<select class="panel-select" id="ve-prop-fontweight" onchange="visualEditor.onPropChange(\'fontweight\',this.value)">' +
                '<option value="normal" ' + ((item.fontweight || 'normal') === 'normal' ? 'selected' : '') + '>Normal</option>' +
                '<option value="bold" ' + (item.fontweight === 'bold' ? 'selected' : '') + '>Bold</option>' +
                '<option value="300" ' + (item.fontweight === '300' ? 'selected' : '') + '>Light</option>' +
                '<option value="500" ' + (item.fontweight === '500' ? 'selected' : '') + '>Medium</option>' +
                '<option value="700" ' + (item.fontweight === '700' ? 'selected' : '') + '>700</option>' +
                '<option value="900" ' + (item.fontweight === '900' ? 'selected' : '') + '>Black</option>' +
                '</select></div></div>';
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

        // Multilingual text data section (for img/button types)
        if (item.type === 'img' || item.type === 'button' || item.type === 'button_empty') {
            html += this.buildPanelTextDataSection(item);
        }

        return html;
    },

    /**
     * Build multilingual text data panel section
     * text: {KO: {message: "..."}, EN: {message: "..."}, ...}
     */
    buildPanelTextDataSection: function(item) {
        var languages = this.getSupportedLanguages();
        var hasText = item.text && typeof item.text === 'object';
        var html = '<div class="panel-section">' +
            '<div class="panel-section-title" style="display:flex;align-items:center;justify-content:space-between;">' +
            '<span>텍스트 데이터</span>' +
            (hasText
                ? '<button class="panel-img-btn" onclick="visualEditor.removeTextData()" title="텍스트 제거" style="width:22px;height:22px;font-size:10px;"><i class="fas fa-times"></i></button>'
                : '<button class="panel-img-btn" onclick="visualEditor.addTextData()" title="텍스트 추가" style="width:22px;height:22px;font-size:10px;"><i class="fas fa-plus"></i></button>'
            ) +
            '</div>';

        if (hasText) {
            // Text style properties (shared across languages, read from first language with data)
            var firstLang = null;
            for (var k in item.text) { if (item.text[k]) { firstLang = item.text[k]; break; } }
            var ts = firstLang || {};

            html += '<div style="margin-bottom:8px;">' +
                '<div class="panel-row">' +
                '<span class="panel-label" style="width:28px;font-size:10px;">X</span>' +
                '<input class="panel-input panel-input-sm" type="number" id="ve-prop-text-x" value="' + (ts.x || 0) + '" onchange="visualEditor.onTextStyleChange(\'x\',this.value)" style="width:50px;">' +
                '<span class="panel-label" style="width:28px;font-size:10px;">Y</span>' +
                '<input class="panel-input panel-input-sm" type="number" id="ve-prop-text-y" value="' + (ts.y || 0) + '" onchange="visualEditor.onTextStyleChange(\'y\',this.value)" style="width:50px;">' +
                '<span class="panel-label" style="width:35px;font-size:10px;">크기</span>' +
                '<input class="panel-input panel-input-sm" type="number" id="ve-prop-text-fontsize" value="' + (ts.fontsize || 16) + '" onchange="visualEditor.onTextStyleChange(\'fontsize\',this.value)" style="width:45px;">' +
                '</div>' +
                '<div class="panel-row">' +
                '<span class="panel-label" style="width:28px;font-size:10px;">색상</span>' +
                '<input type="color" id="ve-prop-text-color" value="' + escapeHtml(ts.color || '#ffffff') + '" onchange="visualEditor.onTextStyleChange(\'color\',this.value)" style="width:32px;height:24px;padding:1px;border:1px solid var(--border-color);border-radius:3px;cursor:pointer;">' +
                '<span class="panel-label" style="width:28px;font-size:10px;">굵기</span>' +
                '<select class="panel-select" id="ve-prop-text-fontweight" onchange="visualEditor.onTextStyleChange(\'fontweight\',this.value)" style="width:70px;font-size:11px;">' +
                '<option value="normal" ' + ((ts.fontweight || 'normal') === 'normal' ? 'selected' : '') + '>Normal</option>' +
                '<option value="bold" ' + (ts.fontweight === 'bold' ? 'selected' : '') + '>Bold</option>' +
                '<option value="300" ' + (ts.fontweight === '300' ? 'selected' : '') + '>Light</option>' +
                '<option value="700" ' + (ts.fontweight === '700' ? 'selected' : '') + '>700</option>' +
                '</select>' +
                '<span class="panel-label" style="width:28px;font-size:10px;">정렬</span>' +
                '<select class="panel-select" id="ve-prop-text-textalign" onchange="visualEditor.onTextStyleChange(\'textalign\',this.value)" style="width:50px;font-size:11px;">' +
                '<option value="left" ' + (ts.textalign === 'left' ? 'selected' : '') + '>좌</option>' +
                '<option value="center" ' + ((ts.textalign || 'center') === 'center' ? 'selected' : '') + '>중</option>' +
                '<option value="right" ' + (ts.textalign === 'right' ? 'selected' : '') + '>우</option>' +
                '</select>' +
                '</div></div>';

            // Language-specific message inputs
            languages.forEach(function(lang) {
                var msg = (item.text[lang.code] && item.text[lang.code].message) ? item.text[lang.code].message.replace(/\|/g, '\n') : '';
                html += '<div class="panel-row">' +
                    '<span class="panel-label" style="width:28px;font-size:11px;font-weight:600;color:var(--color-primary);">' + escapeHtml(lang.code) + '</span>' +
                    '<textarea class="panel-input" id="ve-prop-text-' + lang.code + '" rows="1" ' +
                    'style="font-size:11px;resize:vertical;min-height:28px;" ' +
                    'onchange="visualEditor.onTextDataChange(\'' + lang.code + '\',this.value)" ' +
                    'placeholder="' + escapeHtml(lang.label) + '">' + escapeHtml(msg) + '</textarea></div>';
            });
        } else {
            html += '<div style="padding:4px 0;font-size:11px;color:var(--text-muted);">텍스트 없음 (+ 버튼으로 추가)</div>';
        }

        html += '</div>';
        return html;
    },

    /**
     * Get supported languages based on homeData or defaults
     */
    getSupportedLanguages: function() {
        var all = [
            { code: 'KO', label: '한국어' },
            { code: 'EN', label: 'English' },
            { code: 'ZH', label: '中文' },
            { code: 'VI', label: 'Tiếng Việt' },
            { code: 'MS', label: 'Bahasa' }
        ];
        // If homeData has hm_language, put it first
        if (this.homeData && this.homeData.hm_language) {
            var primary = this.homeData.hm_language;
            all.sort(function(a, b) {
                if (a.code === primary) return -1;
                if (b.code === primary) return 1;
                return 0;
            });
        }
        return all;
    },

    /**
     * Add empty text data to current item
     */
    addTextData: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        this.pushUndo();
        var languages = this.getSupportedLanguages();
        item.text = {};
        languages.forEach(function(lang) {
            item.text[lang.code] = {
                message: '',
                x: 0,
                y: 0,
                fontsize: 20,
                fontweight: 'bold',
                color: '#ffffff',
                textalign: 'center'
            };
        });
        this.showPropertyPanel(this.selectedIdx);
        this.renderCanvas();
        this.markDirty();
    },

    /**
     * Remove text data from current item
     */
    removeTextData: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        var self = this;
        confirmMsg('텍스트 데이터를 제거하시겠습니까?', function() {
            self.pushUndo();
            delete item.text;
            self.showPropertyPanel(self.selectedIdx);
            self.renderCanvas();
            self.markDirty();
        });
    },

    /**
     * Handle text data change for a specific language (message)
     */
    onTextDataChange: function(langCode, value) {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item || !item.text) return;

        this.pushUndo();
        if (!item.text[langCode]) item.text[langCode] = {};
        // Replace newlines with pipe for storage
        item.text[langCode].message = value.replace(/\n/g, '|');
        this.renderCanvas();
        this.markDirty();
    },

    /**
     * Handle text style change (x, y, fontsize, fontweight, color, textalign)
     * Applies to ALL languages in the text object
     */
    onTextStyleChange: function(prop, value) {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item || !item.text || typeof item.text !== 'object') return;

        this.pushUndo();
        // Numeric props
        var numericProps = ['x', 'y', 'fontsize'];
        var val = numericProps.indexOf(prop) >= 0 ? parseInt(value) || 0 : value;

        // Apply to all languages
        for (var lang in item.text) {
            if (item.text.hasOwnProperty(lang) && item.text[lang]) {
                item.text[lang][prop] = val;
            }
        }
        this.renderCanvas();
        this.markDirty();
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

    /**
     * Ensure canvas area is square-ish so both landscape and portrait fit well
     */
    ensureSquareArea: function() {
        var area = document.getElementById('ve-canvas-area');
        if (!area) return;
        // 부모 컨테이너의 가용 크기
        var container = area.parentElement;
        var panelWidth = 280; // editor-panel width
        var availW = container.clientWidth - panelWidth;
        var availH = container.clientHeight;
        // 정사각형: 가로/세로 중 작은 쪽에 맞춤
        var squareSize = Math.max(Math.min(availW, availH), 500);
        area.style.width = squareSize + 'px';
        area.style.minHeight = squareSize + 'px';
    },

    zoomFit: function() {
        var area = document.getElementById('ve-canvas-area');
        if (!area) return;

        this.ensureSquareArea();

        var padding = 24;
        var areaW = area.clientWidth - padding * 2;
        var areaH = area.clientHeight - padding * 2;

        var scaleW = this.canvasWidth > 0 ? areaW / this.canvasWidth : 1;
        var scaleH = this.canvasHeight > 0 ? areaH / this.canvasHeight : 1;
        // 영역에 맞추되 최대 1배까지
        this.scale = Math.min(scaleW, scaleH, 1);
        // 최소 0.15배 보장
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
    },

    // =========================================
    // Context Menu (우클릭)
    // =========================================

    initContextMenu: function() {
        var self = this;
        var canvas = document.getElementById('ve-canvas');
        if (!canvas) return;

        canvas.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            var target = e.target.closest('.canvas-element');
            if (!target) {
                self.hideContextMenu();
                return;
            }

            var idx = parseInt(target.dataset.idx);
            self.selectElement(idx);

            var items = self.getCurrentItems();
            var item = items[idx];
            if (!item) return;

            // Show/hide type-specific menu items
            var fontItem = document.getElementById('ve-ctx-font');
            var addTextItem = document.getElementById('ve-ctx-addtext');
            if (fontItem) fontItem.style.display = item.type === 'text' ? 'flex' : 'none';
            if (addTextItem) addTextItem.style.display = (item.type === 'img' || item.type === 'button') ? 'flex' : 'none';

            var menu = document.getElementById('ve-context-menu');
            if (!menu) return;
            menu.style.display = 'block';
            menu.style.left = e.clientX + 'px';
            menu.style.top = e.clientY + 'px';

            // Ensure menu stays within viewport
            var rect = menu.getBoundingClientRect();
            if (rect.right > window.innerWidth) menu.style.left = (e.clientX - rect.width) + 'px';
            if (rect.bottom > window.innerHeight) menu.style.top = (e.clientY - rect.height) + 'px';
        });

        // Close context menu on click elsewhere (guard against multiple registrations)
        if (!this._contextClickBound) {
            this._contextClickBound = true;
            document.addEventListener('click', function() { self.hideContextMenu(); });
        }

        // Handle context menu actions
        var menu = document.getElementById('ve-context-menu');
        if (menu) {
            menu.addEventListener('click', function(e) {
                var item = e.target.closest('.context-menu-item');
                if (!item) return;
                var action = item.dataset.action;
                self.hideContextMenu();
                self.handleContextAction(action);
            });
        }
    },

    hideContextMenu: function() {
        var menu = document.getElementById('ve-context-menu');
        if (menu) menu.style.display = 'none';
    },

    handleContextAction: function(action) {
        switch (action) {
            case 'edit':
                this.showPropertyPanel(this.selectedIdx);
                break;
            case 'font':
                this.showFontPropertiesDialog();
                break;
            case 'add-text':
                this.addTextOverlay();
                break;
            case 'duplicate':
                this.duplicateSelected();
                break;
            case 'bring-front':
                this.bringToFront();
                break;
            case 'send-back':
                this.sendToBack();
                break;
            case 'delete':
                this.deleteSelected();
                break;
        }
    },

    // =========================================
    // Element Add Dialogs
    // =========================================

    showAddImageDialog: function() {
        if (!this.hmIdx) { toastError('프로젝트를 먼저 선택하세요.'); return; }
        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="ve-add-id" placeholder="home_img_1"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="ve-add-name" placeholder="이미지 이름"></div>' +
            '<div class="form-group"><label class="form-label">이미지 URL</label>' +
            '<input class="form-control" id="ve-add-imgurl" placeholder="../../../game/school/.../res/...png"></div>' +
            '</div>';

        var self = this;
        showModalDialog(document.body, '이미지 추가', html, '추가', '취소',
            function() {
                var id = document.getElementById('ve-add-id').value.trim();
                var name = document.getElementById('ve-add-name').value.trim();
                var imgurl = document.getElementById('ve-add-imgurl').value.trim();
                if (!id || !name) { toastError('ID와 이름을 입력하세요.'); return; }
                self.pushUndo();
                self.getCurrentItems().push({
                    id: id, name: name, type: 'img',
                    imgurl: imgurl,
                    x: String(Math.round(self.canvasWidth / 2)),
                    y: String(Math.round(self.canvasHeight / 2))
                });
                self.renderCanvas();
                self.markDirty();
                hideModalDialog();
            },
            function() { hideModalDialog(); },
            { size: { width: '450px' }, allowHtml: true }
        );
    },

    showAddButtonDialog: function() {
        if (!this.hmIdx) { toastError('프로젝트를 먼저 선택하세요.'); return; }
        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="ve-add-id" placeholder="home_btn_1"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="ve-add-name" placeholder="버튼 이름"></div>' +
            '<div class="form-group"><label class="form-label">이미지 URL (기본)</label>' +
            '<input class="form-control" id="ve-add-imgurl" placeholder="버튼 이미지"></div>' +
            '<div class="form-group"><label class="form-label">클릭 이미지 URL</label>' +
            '<input class="form-control" id="ve-add-clickurl" placeholder="클릭 시 이미지"></div>' +
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">이벤트 page</label>' +
            '<select class="form-control" id="ve-add-evt-page">' +
            '<option value="main">main</option><option value="home">home</option>' +
            '<option value="popup">popup</option><option value="popup_board">popup_board</option>' +
            '<option value="map">map</option><option value="speak">speak</option>' +
            '<option value="lyrics">lyrics</option><option value="language_popup">language_popup</option>' +
            '</select></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">tab</label>' +
            '<input class="form-control" id="ve-add-evt-tab" value="0"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">sub</label>' +
            '<input class="form-control" id="ve-add-evt-sub" value="0"></div>' +
            '</div></div>';

        var self = this;
        showModalDialog(document.body, '버튼 추가', html, '추가', '취소',
            function() {
                var id = document.getElementById('ve-add-id').value.trim();
                var name = document.getElementById('ve-add-name').value.trim();
                if (!id || !name) { toastError('ID와 이름을 입력하세요.'); return; }
                self.pushUndo();
                self.getCurrentItems().push({
                    id: id, name: name, type: 'button',
                    imgurl: document.getElementById('ve-add-imgurl').value.trim(),
                    clickurl: document.getElementById('ve-add-clickurl').value.trim(),
                    x: String(Math.round(self.canvasWidth / 2)),
                    y: String(Math.round(self.canvasHeight / 2)),
                    event: {
                        page: document.getElementById('ve-add-evt-page').value,
                        tab: document.getElementById('ve-add-evt-tab').value || '0',
                        sub: document.getElementById('ve-add-evt-sub').value || '0'
                    }
                });
                self.renderCanvas();
                self.markDirty();
                hideModalDialog();
            },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );
    },

    showAddTextDialog: function() {
        if (!this.hmIdx) { toastError('프로젝트를 먼저 선택하세요.'); return; }
        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="ve-add-id" placeholder="home_text_1"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="ve-add-name" placeholder="텍스트 이름"></div>' +
            '<div class="form-group"><label class="form-label">텍스트 타입</label>' +
            '<select class="form-control" id="ve-add-texttype">' +
            '<option value="">기본 (정적 텍스트)</option>' +
            '<option value="m/d">날짜 (03/19)</option>' +
            '<option value="weekday">요일 ((수))</option>' +
            '<option value="hh:mm">시간 (14:30)</option>' +
            '<option value="hh:mm:ss">시:분:초 (14:30:00)</option>' +
            '<option value="yyyy">연도 (2026)</option>' +
            '<option value="yyyymmdd">전체 날짜 (2026.03.19)</option>' +
            '<option value="text_notice">공지사항</option>' +
            '</select></div>' +
            '<div class="form-group" id="ve-add-text-wrap"><label class="form-label">텍스트 내용</label>' +
            '<input class="form-control" id="ve-add-text" placeholder="표시할 텍스트"></div>' +
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">크기 (px)</label>' +
            '<input class="form-control" id="ve-add-fontsize" type="number" value="24"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">색상</label>' +
            '<input class="form-control" id="ve-add-fontcolor" type="color" value="#ffffff"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">굵기</label>' +
            '<select class="form-control" id="ve-add-fontweight">' +
            '<option value="normal">Normal</option><option value="bold">Bold</option>' +
            '<option value="300">Light</option><option value="500">Medium</option>' +
            '<option value="700">Bold 700</option><option value="900">Black</option>' +
            '</select></div></div></div>';

        var self = this;
        showModalDialog(document.body, '텍스트 추가', html, '추가', '취소',
            function() {
                var id = document.getElementById('ve-add-id').value.trim();
                var name = document.getElementById('ve-add-name').value.trim();
                if (!id || !name) { toastError('ID와 이름을 입력하세요.'); return; }
                var item = {
                    id: id, name: name, type: 'text',
                    x: String(Math.round(self.canvasWidth / 2)),
                    y: String(Math.round(self.canvasHeight / 2)),
                    fontsize: parseInt(document.getElementById('ve-add-fontsize').value) || 24,
                    fontcolor: document.getElementById('ve-add-fontcolor').value || '#ffffff',
                    fontweight: document.getElementById('ve-add-fontweight').value || 'normal',
                    textalign: 'center',
                    texttype: document.getElementById('ve-add-texttype').value || undefined
                };
                var textVal = document.getElementById('ve-add-text').value.trim();
                if (textVal && !item.texttype) item.text = textVal;
                if (!item.texttype) delete item.texttype;
                // Default w/h for text
                item.w = '300';
                item.h = String((parseInt(item.fontsize) || 24) + 16);
                self.pushUndo();
                self.getCurrentItems().push(item);
                self.renderCanvas();
                self.markDirty();
                hideModalDialog();
            },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );
    },

    // =========================================
    // Font Properties Dialog (폰트 속성 팝업)
    // =========================================

    showFontPropertiesDialog: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item || item.type !== 'text') { toastError('텍스트 요소를 선택하세요.'); return; }

        var weightsOpts = [
            { v: 'normal', l: 'Normal' }, { v: 'bold', l: 'Bold' },
            { v: '100', l: '100 Thin' }, { v: '300', l: '300 Light' },
            { v: '500', l: '500 Medium' }, { v: '700', l: '700 Bold' }, { v: '900', l: '900 Black' }
        ].map(function(o) {
            return '<option value="' + o.v + '" ' + (o.v === (item.fontweight || 'normal') ? 'selected' : '') + '>' + o.l + '</option>';
        }).join('');

        var texttypeOpts = [
            { v: '', l: '기본 (정적)' }, { v: 'm/d', l: '날짜 (03/19)' },
            { v: 'weekday', l: '요일 ((수))' }, { v: 'hh:mm', l: '시간 (14:30)' },
            { v: 'hh:mm:ss', l: '시:분:초' }, { v: 'yyyy', l: '연도' },
            { v: 'yyyymmdd', l: '전체 날짜' }, { v: 'text_notice', l: '공지사항' }
        ].map(function(o) {
            return '<option value="' + o.v + '" ' + (o.v === (item.texttype || '') ? 'selected' : '') + '>' + o.l + '</option>';
        }).join('');

        var currentText = typeof item.text === 'string' ? item.text : (item.text && item.text.KO ? item.text.KO.message : '');
        var previewColor = item.fontcolor || '#ffffff';
        var previewSize = (item.fontsize || 24);
        var previewWeight = item.fontweight || 'normal';

        var html = '<div>' +
            '<div class="font-prop-preview" id="fp-preview" style="color:' + escapeHtml(previewColor) + ';font-size:' + previewSize + 'px;font-weight:' + escapeHtml(previewWeight) + ';">미리보기 텍스트</div>' +
            '<div class="font-prop-row"><span class="font-prop-label">텍스트 타입</span>' +
            '<select class="form-control" id="fp-texttype" onchange="visualEditor.onFontPropChange()">' + texttypeOpts + '</select></div>' +
            '<div class="font-prop-row" id="fp-text-row"><span class="font-prop-label">텍스트</span>' +
            '<input class="form-control" id="fp-text" value="' + escapeHtml(currentText) + '" onchange="visualEditor.onFontPropChange()"></div>' +
            '<div class="font-prop-row"><span class="font-prop-label">크기 (px)</span>' +
            '<input class="form-control" id="fp-fontsize" type="number" min="8" max="200" value="' + (item.fontsize || 24) + '" onchange="visualEditor.onFontPropChange()" style="width:80px;">' +
            '</div>' +
            '<div class="font-prop-row"><span class="font-prop-label">색상</span>' +
            '<input type="color" id="fp-fontcolor" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="visualEditor.onFontPropChange()" style="width:40px;height:32px;padding:2px;border:1px solid var(--border-color);border-radius:4px;cursor:pointer;">' +
            '<input class="form-control" id="fp-fontcolor-hex" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="document.getElementById(\'fp-fontcolor\').value=this.value;visualEditor.onFontPropChange()" style="width:90px;">' +
            '</div>' +
            '<div class="font-prop-row"><span class="font-prop-label">굵기</span>' +
            '<select class="form-control" id="fp-fontweight" onchange="visualEditor.onFontPropChange()">' + weightsOpts + '</select></div>' +
            '<div class="font-prop-row"><span class="font-prop-label">정렬</span>' +
            '<div class="align-btn-group">' +
            '<button type="button" onclick="visualEditor.setFontAlign(\'left\')" id="fp-align-left" class="' + (item.textalign === 'left' || !item.textalign ? 'active' : '') + '"><i class="fas fa-align-left"></i></button>' +
            '<button type="button" onclick="visualEditor.setFontAlign(\'center\')" id="fp-align-center" class="' + (item.textalign === 'center' ? 'active' : '') + '"><i class="fas fa-align-center"></i></button>' +
            '<button type="button" onclick="visualEditor.setFontAlign(\'right\')" id="fp-align-right" class="' + (item.textalign === 'right' ? 'active' : '') + '"><i class="fas fa-align-right"></i></button>' +
            '</div></div>' +
            '</div>';

        var self = this;
        showModalDialog(document.body, '폰트 속성', html, '적용', '취소',
            function() { self.applyFontProperties(); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '450px' }, allowHtml: true }
        );
    },

    onFontPropChange: function() {
        // Real-time preview update
        var preview = document.getElementById('fp-preview');
        if (!preview) return;

        var fsEl = document.getElementById('fp-fontsize');
        var fcEl = document.getElementById('fp-fontcolor');
        var fwEl = document.getElementById('fp-fontweight');
        var ttEl = document.getElementById('fp-texttype');
        var txEl = document.getElementById('fp-text');

        var fontsize = fsEl ? fsEl.value : '24';
        var fontcolor = fcEl ? fcEl.value : '#ffffff';
        var fontweight = fwEl ? fwEl.value : 'normal';
        var texttype = ttEl ? ttEl.value : '';
        var text = txEl ? txEl.value : '';

        preview.style.fontSize = fontsize + 'px';
        preview.style.color = fontcolor;
        preview.style.fontWeight = fontweight;

        var textMap = { 'm/d': '03/19', 'hh:mm': '14:30', 'weekday': '(수)', 'yyyy': '2026', 'hh:mm:ss': '14:30:00', 'yyyymmdd': '2026.03.19', 'text_notice': '공지사항' };
        preview.textContent = texttype ? (textMap[texttype] || texttype) : (text || '미리보기 텍스트');

        // Update hex input sync
        var hexInput = document.getElementById('fp-fontcolor-hex');
        if (hexInput) hexInput.value = fontcolor;
    },

    setFontAlign: function(align) {
        document.querySelectorAll('.align-btn-group button').forEach(function(b) { b.classList.remove('active'); });
        var btn = document.getElementById('fp-align-' + align);
        if (btn) btn.classList.add('active');
    },

    applyFontProperties: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        this.pushUndo();

        item.fontsize = parseInt(document.getElementById('fp-fontsize').value) || 24;
        item.fontcolor = document.getElementById('fp-fontcolor').value || '#ffffff';
        item.fontweight = document.getElementById('fp-fontweight').value || 'normal';
        item.texttype = document.getElementById('fp-texttype').value || undefined;
        if (!item.texttype) delete item.texttype;

        var text = document.getElementById('fp-text').value.trim();
        if (text && !item.texttype) {
            item.text = text;
        } else if (item.texttype) {
            delete item.text;
        }

        // Get align from active button
        var alignBtn = document.querySelector('.align-btn-group button.active');
        if (alignBtn) {
            var alignId = alignBtn.id.replace('fp-align-', '');
            item.textalign = alignId;
        }

        // Update h based on fontsize
        item.h = String((parseInt(item.fontsize) || 24) + 16);

        this.renderCanvas();
        this.markDirty();
    },

    // =========================================
    // Context Menu Actions
    // =========================================

    addTextOverlay: function() {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        var texttypeOpts = '<option value="">기본 (정적)</option>' +
            '<option value="m/d">날짜 (03/19)</option>' +
            '<option value="weekday">요일 ((수))</option>' +
            '<option value="hh:mm">시간 (14:30)</option>' +
            '<option value="hh:mm:ss">시:분:초</option>' +
            '<option value="yyyy">연도</option>' +
            '<option value="yyyymmdd">전체 날짜</option>';

        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">텍스트 타입</label>' +
            '<select class="form-control" id="ot-texttype">' + texttypeOpts + '</select></div>' +
            '<div class="form-group"><label class="form-label">텍스트 (기본 타입일 때)</label>' +
            '<input class="form-control" id="ot-text" placeholder="표시할 텍스트"></div>' +
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">크기</label>' +
            '<input class="form-control" id="ot-fontsize" type="number" value="20"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">색상</label>' +
            '<input class="form-control" id="ot-fontcolor" type="color" value="#ffffff"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">굵기</label>' +
            '<select class="form-control" id="ot-fontweight">' +
            '<option value="normal">Normal</option><option value="bold">Bold</option>' +
            '</select></div></div></div>';

        var self = this;
        showModalDialog(document.body, item.name + ' 위에 텍스트 추가', html, '추가', '취소',
            function() {
                var texttype = document.getElementById('ot-texttype').value;
                var fontSize = parseInt(document.getElementById('ot-fontsize').value) || 20;
                var newText = {
                    id: item.id + '_text_' + Date.now(),
                    name: item.name + ' 텍스트',
                    type: 'text',
                    x: item.x,
                    y: item.y,
                    w: '300',
                    h: String(fontSize + 16),
                    fontsize: fontSize,
                    fontcolor: document.getElementById('ot-fontcolor').value || '#ffffff',
                    fontweight: document.getElementById('ot-fontweight').value || 'normal',
                    textalign: 'center'
                };
                if (texttype) {
                    newText.texttype = texttype;
                } else {
                    var txt = document.getElementById('ot-text').value.trim();
                    if (txt) newText.text = txt;
                }
                self.pushUndo();
                self.getCurrentItems().push(newText);
                self.renderCanvas();
                self.markDirty();
                hideModalDialog();
            },
            function() { hideModalDialog(); },
            { size: { width: '450px' }, allowHtml: true }
        );
    },

    duplicateSelected: function() {
        if (this.selectedIdx < 0) return;
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        this.pushUndo();
        var clone = JSON.parse(JSON.stringify(item));
        clone.id = item.id + '_copy_' + Date.now();
        clone.name = item.name + ' 복사';
        clone.x = String((parseInt(item.x) || 0) + 20);
        clone.y = String((parseInt(item.y) || 0) + 20);
        items.push(clone);

        this.renderCanvas();
        this.selectElement(items.length - 1);
        this.markDirty();
    },

    bringToFront: function() {
        if (this.selectedIdx < 0) return;
        var items = this.getCurrentItems();
        if (this.selectedIdx >= items.length - 1) return;

        this.pushUndo();
        var item = items.splice(this.selectedIdx, 1)[0];
        items.push(item);
        this.selectedIdx = items.length - 1;
        this.renderCanvas();
        this.markDirty();
    },

    sendToBack: function() {
        if (this.selectedIdx <= 0) return;
        var items = this.getCurrentItems();

        this.pushUndo();
        var item = items.splice(this.selectedIdx, 1)[0];
        items.unshift(item);
        this.selectedIdx = 0;
        this.renderCanvas();
        this.markDirty();
    },

    // =========================================
    // Image Picker (이미지 변경)
    // =========================================

    pickImage: function(propName) {
        var items = this.getCurrentItems();
        var item = items[this.selectedIdx];
        if (!item) return;

        var currentUrl = item[propName] || '';
        var self = this;

        // Hidden file input for image upload
        var fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.style.display = 'none';
        document.body.appendChild(fileInput);

        // Build dialog with file upload + URL input
        var html = '<div style="display:grid;gap:16px;">' +
            // Current image preview
            (currentUrl ? '<div style="text-align:center;padding:12px;background:#1a1a2e;border-radius:8px;">' +
            '<img src="' + escapeHtml(currentUrl) + '" style="max-width:100%;max-height:120px;border-radius:4px;" onerror="this.parentElement.innerHTML=\'<span style=color:#999>이미지를 불러올 수 없습니다</span>\'">' +
            '<div style="font-size:11px;color:#999;margin-top:6px;word-break:break-all;">' + escapeHtml(currentUrl) + '</div></div>' : '') +
            // Upload button
            '<div class="form-group">' +
            '<label class="form-label">파일 업로드</label>' +
            '<div style="display:flex;gap:8px;">' +
            '<button class="btn btn-light" style="flex:1;" onclick="document.getElementById(\'ve-img-file-input\').click()">' +
            '<i class="fas fa-upload"></i> 파일 선택</button>' +
            '<span id="ve-img-file-name" style="flex:1;font-size:12px;color:var(--text-muted);display:flex;align-items:center;">선택된 파일 없음</span>' +
            '</div>' +
            '<input type="file" id="ve-img-file-input" accept="image/*" style="display:none;" onchange="visualEditor.onImageFileSelected(this)">' +
            '</div>' +
            // URL input
            '<div class="form-group">' +
            '<label class="form-label">또는 URL 직접 입력</label>' +
            '<input class="form-control" id="ve-img-url-input" value="' + escapeHtml(currentUrl) + '" placeholder="이미지 경로">' +
            '</div></div>';

        showModalDialog(document.body, (propName === 'clickurl' ? '클릭 ' : '') + '이미지 변경', html, '적용', '취소',
            function() {
                // Check if file was uploaded
                var uploadedUrl = document.getElementById('ve-img-file-input').dataset.uploadedUrl;
                var manualUrl = document.getElementById('ve-img-url-input').value.trim();
                var newUrl = uploadedUrl || manualUrl;

                if (newUrl && newUrl !== currentUrl) {
                    self.pushUndo();
                    item[propName] = newUrl;
                    self.renderCanvas();
                    self.showPropertyPanel(self.selectedIdx);
                    self.markDirty();
                }
                hideModalDialog();
            },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );

        // Cleanup
        if (fileInput.parentElement) fileInput.parentElement.removeChild(fileInput);
    },

    onImageFileSelected: function(input) {
        if (!input.files || !input.files[0]) return;
        var file = input.files[0];
        var nameSpan = document.getElementById('ve-img-file-name');
        if (nameSpan) nameSpan.textContent = file.name;

        // Upload to server
        var formData = new FormData();
        formData.append('file', file);
        formData.append('projectid', this.currentProjectId || '');
        formData.append('groupidx', this.homeData ? (this.homeData.hm_gr_idx || '0') : '0');

        var urlInput = document.getElementById('ve-img-url-input');

        // Try upload via API
        fetch('./api/v3/upload.php', {
            method: 'POST',
            body: formData
        }).then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.code === 100 && data.data && data.data.url) {
                input.dataset.uploadedUrl = data.data.url;
                if (urlInput) urlInput.value = data.data.url;
                if (nameSpan) nameSpan.textContent = file.name + ' (업로드 완료)';
                nameSpan.style.color = 'var(--color-success)';
            } else {
                // Fallback: use local file path (for development)
                var reader = new FileReader();
                reader.onload = function(e) {
                    input.dataset.uploadedUrl = e.target.result;
                    if (urlInput) urlInput.value = '(로컬 미리보기)';
                    if (nameSpan) nameSpan.textContent = file.name + ' (로컬)';
                };
                reader.readAsDataURL(file);
            }
        }).catch(function() {
            // No upload endpoint: use data URL as fallback
            var reader = new FileReader();
            reader.onload = function(e) {
                input.dataset.uploadedUrl = e.target.result;
                if (urlInput) urlInput.value = '(로컬 미리보기)';
                if (nameSpan) nameSpan.textContent = file.name + ' (로컬)';
            };
            reader.readAsDataURL(file);
        });
    }
};
