/**
 * SmartFlat CMS v3 - Channel Editor
 * Screen layout editor (화면 수정하기)
 * Replaces v1 a_channel.php functionality
 */

'use strict';

// Use var to allow re-declaration when page is reloaded via jQuery .load()
// eslint-disable-next-line no-var
var channelEditor = {
    // State
    homeData: null,       // Full tb_home row
    homedatas: [],        // hm_home_data parsed
    maindatas: [],        // hm_main_data parsed
    contentdatas: [],     // hm_content_data parsed
    currentTab: 'content',
    currentProjectId: null,
    hmIdx: null,
    dragSrcRow: null,     // Drag reorder source row

    /**
     * Initialize the editor
     * Project selection is handled by the global header selector
     */
    init() {
        // No internal project loading — uses global project selector in header
    },

    /**
     * Handle project selection change
     */
    async onProjectChange(hmIdx) {
        if (!hmIdx) {
            var mainEl = document.getElementById('channel-main');
            var emptyEl = document.getElementById('channel-empty');
            var safetyEl = document.getElementById('channel-safety-toggle');
            var shortEl = document.getElementById('channel-shorturl-box');
            var infoBar = document.getElementById('channel-project-info-bar');
            if (mainEl) mainEl.style.display = 'none';
            if (emptyEl) emptyEl.style.display = 'block';
            if (safetyEl) safetyEl.style.display = 'none';
            if (shortEl) shortEl.style.display = 'none';
            if (infoBar) infoBar.style.display = 'none';
            return;
        }

        this.hmIdx = hmIdx;
        C_ShowLoadingProgress();

        try {
            var res = await V3Api.get('/homes/' + hmIdx);
            if (res.code === 100 && res.data) {
                this.homeData = res.data;
                this.homedatas = res.data.home_data || [];
                this.maindatas = res.data.main_data || [];
                this.contentdatas = res.data.content_data || [];
                this.currentProjectId = res.data.hm_projectid;

                this.updateProjectInfo();
                this.updateSafetyToggle();
                this.renderAllTables();
                this.initPreview();

                var mainEl = document.getElementById('channel-main');
                var emptyEl = document.getElementById('channel-empty');
                if (mainEl) mainEl.style.display = 'block';
                if (emptyEl) emptyEl.style.display = 'none';
            }
        } catch (err) {
            cerror('Failed to load home data:', err);
            toastError('데이터를 불러오는데 실패했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    },

    /**
     * Update project info display
     */
    updateProjectInfo() {
        var infoBar = document.getElementById('channel-project-info-bar');
        var orient = document.getElementById('channel-orientation-badge');
        var reso = document.getElementById('channel-resolution-text');
        var lang = document.getElementById('channel-language-text');

        if (!infoBar || !orient || !reso || !lang) return;

        var d = this.homeData;
        orient.textContent = d.hm_orientation === 'L' ? '가로' : '세로';
        orient.className = 'badge ' + (d.hm_orientation === 'L' ? 'badge-info' : 'badge-primary');

        var w = d.hm_width || (d.hm_orientation === 'L' ? 1920 : 1080);
        var h = d.hm_height || (d.hm_orientation === 'L' ? 1080 : 1920);
        reso.textContent = w + ' \u00d7 ' + h + 'px';

        var langMap = { KO: '한국어', EN: 'English', ZH: '中文', VI: 'Tiếng Việt', MS: 'Bahasa' };
        lang.textContent = langMap[d.hm_language] || d.hm_language || 'KO';

        infoBar.style.display = 'block';
    },

    // =========================================
    // Safety Data (재난안전문자)
    // =========================================

    /**
     * Update safety toggle visibility based on hm_region
     */
    updateSafetyToggle() {
        var toggle = document.getElementById('channel-safety-toggle');
        var checkbox = document.getElementById('channel-safety-checkbox');
        if (!toggle || !checkbox) return;
        if (this.homeData.hm_region) {
            toggle.style.display = 'flex';
            checkbox.checked = this.homeData.hm_safety_onoff == 1;
        } else {
            toggle.style.display = 'none';
        }
    },

    /**
     * Toggle safety data ON/OFF
     */
    async toggleSafety(checked) {
        var val = checked ? 1 : 0;
        try {
            await V3Api.put('/homes/' + this.hmIdx, {
                hm_safety_onoff: val
            });
            this.homeData.hm_safety_onoff = val;
            toastSuccess('재난안전문자 ' + (checked ? 'ON' : 'OFF'));
        } catch (err) {
            cerror('Failed to toggle safety:', err);
            toastError('설정 변경에 실패했습니다.');
        }
    },

    /**
     * Show safety settings popup (region + closetime)
     */
    showSafetySettings() {
        var regions = [
            '서울특별시','부산광역시','대구광역시','인천광역시','광주광역시',
            '대전광역시','울산광역시','세종특별자치시','경기도','강원도',
            '충청북도','충청남도','전라북도','전라남도','경상북도','경상남도','제주특별자치도'
        ];
        var currentRegion = this.homeData.hm_region || '';
        var currentClose = this.homeData.hm_safety_closetime || 0;

        var regionOpts = regions.map(function(r) {
            return '<option value="' + r + '" ' + (r === currentRegion ? 'selected' : '') + '>' + r + '</option>';
        }).join('');

        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">지역</label>' +
            '<select class="form-control" id="safety-region">' +
            '<option value="">선택하세요</option>' + regionOpts + '</select></div>' +
            '<div class="form-group"><label class="form-label">표시 시간 (초)</label>' +
            '<input class="form-control" id="safety-closetime" type="number" min="0" max="1800" value="' + currentClose + '">' +
            '<small style="color:var(--text-muted);">0: 계속 표시, 1~1800초 (최대 30분)</small></div>' +
            '</div>';

        var self = this;
        showModalDialog(document.body, '재난안전문자 설정', html, '저장', '취소',
            function() { self.saveSafetySettings(); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '400px' }, allowHtml: true }
        );
    },

    async saveSafetySettings() {
        var region = document.getElementById('safety-region').value;
        var closetime = parseInt(document.getElementById('safety-closetime').value) || 0;
        if (closetime < 0) closetime = 0;
        if (closetime > 1800) closetime = 1800;

        try {
            await V3Api.put('/homes/' + this.hmIdx, {
                hm_region: region,
                hm_safety_closetime: closetime
            });
            this.homeData.hm_region = region;
            this.homeData.hm_safety_closetime = closetime;
            this.updateSafetyToggle();
            toastSuccess('재난안전문자 설정이 저장되었습니다.');
        } catch (err) {
            cerror('Failed to save safety settings:', err);
            toastError('저장에 실패했습니다.');
        }
    },

    // =========================================
    // ShortURL
    // =========================================

    /**
     * Copy short URL
     */
    copyShortUrl() {
        var el = document.getElementById('channel-shorturl-text');
        var text = el ? el.textContent : '';
        if (text) {
            navigator.clipboard.writeText(text).then(function() {
                toastSuccess('숏URL이 복사되었습니다.');
            }).catch(function() {
                toastError('복사에 실패했습니다.');
            });
        }
    },

    // =========================================
    // Preview
    // =========================================

    /**
     * Initialize iframe preview
     */
    initPreview() {
        var d = this.homeData;
        var container = document.getElementById('channel-preview-container');
        var iframe = document.getElementById('channel-preview-iframe');
        if (!container || !iframe) return;

        var swidth = d.hm_width > 0 ? parseInt(d.hm_width) : (d.hm_orientation === 'L' ? 1920 : 1080);
        var sheight = d.hm_height > 0 ? parseInt(d.hm_height) : (d.hm_orientation === 'L' ? 1080 : 1920);

        // Scale to fit (max 360px wide for portrait)
        var maxW = d.hm_orientation === 'L' ? 500 : 360;
        var scale = maxW / swidth;
        var displayW = Math.round(swidth * scale);
        var displayH = Math.round(sheight * scale);

        iframe.style.width = swidth + 'px';
        iframe.style.height = sheight + 'px';
        iframe.style.transform = 'scale(' + scale + ')';
        iframe.style.transformOrigin = '0 0';

        var cardBody = container.querySelector('.card-body');
        if (cardBody) {
            cardBody.style.width = displayW + 'px';
            cardBody.style.height = displayH + 'px';
        }

        // Build preview URL via game-preview proxy
        iframe.src = './api/game-preview.php?hm_idx=' + this.hmIdx + '&t=' + Date.now();
    },

    /**
     * Refresh preview iframe
     */
    refreshPreview() {
        var iframe = document.getElementById('channel-preview-iframe');
        if (iframe.src) {
            iframe.src = iframe.src.replace(/[?&]t=\d+/, '') + '?t=' + Date.now();
        }
    },

    /**
     * Copy preview URL
     */
    copyPreviewUrl() {
        var iframe = document.getElementById('channel-preview-iframe');
        if (iframe.src) {
            navigator.clipboard.writeText(iframe.src).then(function() {
                toastSuccess('미리보기 주소가 복사되었습니다.');
            }).catch(function() {
                toastError('복사에 실패했습니다.');
            });
        }
    },

    // =========================================
    // Tabs
    // =========================================

    /**
     * Switch between tabs
     */
    switchTab(tab) {
        this.currentTab = tab;

        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.toggle('active', btn.dataset.tab === tab);
        });

        document.querySelectorAll('.tab-panel').forEach(function(panel) {
            panel.style.display = 'none';
        });
        document.getElementById('tab-panel-' + tab).style.display = 'block';
    },

    // =========================================
    // Table Rendering
    // =========================================

    /**
     * Render all three tables
     */
    renderAllTables() {
        this.renderContentTable();
        this.renderHomeTable();
        this.renderMainTable();

        // Update counts
        document.getElementById('tab-count-content').textContent = this.contentdatas.length;
        document.getElementById('tab-count-home').textContent = this.homedatas.length;
        document.getElementById('tab-count-main').textContent = this.maindatas.length;
    },

    /**
     * Render content data table (Tab 0)
     */
    renderContentTable() {
        var tbody = document.getElementById('content-data-tbody');
        if (this.contentdatas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);">콘텐츠 데이터가 없습니다.</td></tr>';
            return;
        }

        var self = this;
        tbody.innerHTML = this.contentdatas.map(function(item, idx) {
            var typeClass = self.getTypeClass(item.type);
            var name = escapeHtml(item.name || '');
            var type = escapeHtml(item.type || '');
            var isFirst = item.isfirstscene === '1' || item.isfirstscene === 1;

            return '<tr draggable="true" data-idx="' + idx + '" data-tab="content">' +
                '<td><span class="drag-handle" title="드래그하여 순서 변경"><i class="fas fa-grip-vertical"></i></span></td>' +
                '<td style="text-align:center;"><input type="checkbox" ' + (isFirst ? 'checked' : '') + ' onchange="event.stopPropagation();channelEditor.setFirstScene(' + idx + ',this.checked)" title="첫화면 설정" style="width:16px;height:16px;cursor:pointer;"></td>' +
                '<td>' + (idx + 1) + '</td>' +
                '<td onclick="channelEditor.editContentItem(' + idx + ')"><strong>' + name + '</strong><br><span style="font-size:11px;color:var(--text-muted);">' + escapeHtml(item.id || '') + '</span></td>' +
                '<td><span class="type-badge ' + typeClass + '">' + type + '</span></td>' +
                '<td>' + self.getContentPreview(item) + '</td>' +
                '<td>' +
                    '<button class="btn-icon" onclick="event.stopPropagation();channelEditor.editContentItem(' + idx + ')" title="편집"><i class="fas fa-edit"></i></button> ' +
                    '<button class="btn-icon danger" onclick="event.stopPropagation();channelEditor.deleteItem(\'content\',' + idx + ')" title="삭제"><i class="fas fa-trash"></i></button>' +
                '</td>' +
            '</tr>';
        }).join('');

        this.initDragReorder(tbody);
    },

    /**
     * Set first scene (첫화면 정하기)
     * Only one item can be first scene - uncheck all others
     */
    setFirstScene(idx, checked) {
        // 모든 항목을 "0"으로 초기화 후, 체크된 항목만 "1"
        var updated = this.contentdatas.map(function(item, i) {
            var copy = Object.assign({}, item);
            if (i === idx && checked) {
                copy.isfirstscene = '1';
            } else {
                copy.isfirstscene = '0';
            }
            return copy;
        });
        this.contentdatas = updated;
        this.saveField('content-data', this.contentdatas);
    },

    /**
     * Render home data table (Tab 1)
     */
    renderHomeTable() {
        var tbody = document.getElementById('home-data-tbody');
        if (this.homedatas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align:center;padding:40px;color:var(--text-muted);">홈화면 데이터가 없습니다.</td></tr>';
            return;
        }

        var self = this;
        tbody.innerHTML = this.homedatas.map(function(item, idx) {
            return self.renderLayoutRow(item, idx, 'home');
        }).join('');

        this.initDragReorder(tbody);
    },

    /**
     * Render main data table (Tab 2)
     */
    renderMainTable() {
        var tbody = document.getElementById('main-data-tbody');
        if (this.maindatas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="9" style="text-align:center;padding:40px;color:var(--text-muted);">메인화면 데이터가 없습니다.</td></tr>';
            return;
        }

        var self = this;
        tbody.innerHTML = this.maindatas.map(function(item, idx) {
            return self.renderLayoutRow(item, idx, 'main');
        }).join('');

        this.initDragReorder(tbody);
    },

    /**
     * Render a home/main layout data row
     */
    renderLayoutRow(item, idx, tabType) {
        var typeClass = this.getTypeClass(item.type);
        var name = escapeHtml(item.name || '');
        var type = escapeHtml(item.type || '');
        var x = item.x !== undefined ? item.x : '-';
        var y = item.y !== undefined ? item.y : '-';
        var imgurl = item.imgurl || '';
        var event = item.event ? escapeHtml(JSON.stringify(item.event)) : '-';

        var imgHtml = imgurl
            ? '<img class="img-thumb" src="' + escapeHtml(imgurl) + '?t=' + Date.now() + '" onerror="this.style.display=\'none\'">'
            : '<span style="color:var(--text-muted);font-size:11px;">없음</span>';

        return '<tr draggable="true" data-idx="' + idx + '" data-tab="' + tabType + '">' +
            '<td><span class="drag-handle" title="드래그하여 순서 변경"><i class="fas fa-grip-vertical"></i></span></td>' +
            '<td>' + (idx + 1) + '</td>' +
            '<td onclick="channelEditor.editLayoutItem(\'' + tabType + '\',' + idx + ')"><strong>' + name + '</strong><br><span style="font-size:11px;color:var(--text-muted);">' + escapeHtml(item.id || '') + '</span></td>' +
            '<td><span class="type-badge ' + typeClass + '">' + type + '</span></td>' +
            '<td>' + imgHtml + '</td>' +
            '<td>' + x + '</td>' +
            '<td>' + y + '</td>' +
            '<td style="font-size:11px;max-width:120px;overflow:hidden;text-overflow:ellipsis;">' + event + '</td>' +
            '<td>' +
                '<button class="btn-icon" onclick="event.stopPropagation();channelEditor.editLayoutItem(\'' + tabType + '\',' + idx + ')" title="편집"><i class="fas fa-edit"></i></button> ' +
                '<button class="btn-icon danger" onclick="event.stopPropagation();channelEditor.deleteItem(\'' + tabType + '\',' + idx + ')" title="삭제"><i class="fas fa-trash"></i></button>' +
            '</td>' +
        '</tr>';
    },

    /**
     * Get content preview HTML
     */
    getContentPreview(item) {
        if (item.type === 'mapimg' && item.images && item.images.length > 0) {
            var src = '../../../game/school/' + this.currentProjectId + '/v' + (this.homeData.hm_gr_idx || 0) + '/contentdata/' + item.images[0];
            return '<img class="img-thumb" src="' + escapeHtml(src) + '" onerror="this.style.display=\'none\'">';
        }
        var iconMap = {
            gallery: '<i class="fas fa-images"></i> 갤러리',
            gallery1: '<i class="fas fa-images"></i> 갤러리',
            gallery2: '<i class="fas fa-images"></i> 갤러리',
            video_gallery: '<i class="fas fa-video"></i> 비디오',
            survey: '<i class="fas fa-poll"></i> 설문',
            board: '<i class="fas fa-clipboard-list"></i> 게시판',
            lyrics: '<i class="fas fa-music"></i> 가사',
            game: '<i class="fas fa-gamepad"></i> 게임'
        };
        if (iconMap[item.type]) {
            return '<span style="color:var(--text-muted);">' + iconMap[item.type] + '</span>';
        }
        return '<span style="color:var(--text-muted);"><i class="fas fa-file"></i> ' + escapeHtml(item.type || '') + '</span>';
    },

    /**
     * Get CSS class for element type
     */
    getTypeClass(type) {
        var map = {
            img: 'img', button: 'button', video: 'video', text: 'text',
            bgcolor: 'bgcolor', animation: 'img',
            html: 'html', gallery: 'gallery', gallery1: 'gallery', gallery2: 'gallery',
            video_gallery: 'video', board: 'board', survey: 'survey',
            mapimg: 'img', lyrics: 'text', game: 'html', trand: 'survey',
            airapi: 'text', weatherapi: 'text'
        };
        return map[type] || '';
    },

    // =========================================
    // Drag Reorder
    // =========================================

    /**
     * Initialize drag & drop reorder on a tbody
     */
    initDragReorder(tbody) {
        var self = this;
        var rows = tbody.querySelectorAll('tr[draggable="true"]');
        rows.forEach(function(row) {
            row.addEventListener('dragstart', function(e) {
                self.dragSrcRow = this;
                this.classList.add('dragging');
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', this.dataset.idx);
            });
            row.addEventListener('dragend', function() {
                this.classList.remove('dragging');
                tbody.querySelectorAll('tr').forEach(function(r) { r.classList.remove('drag-over'); });
            });
            row.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                this.classList.add('drag-over');
            });
            row.addEventListener('dragleave', function() {
                this.classList.remove('drag-over');
            });
            row.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('drag-over');
                if (self.dragSrcRow === this) return;

                var fromIdx = parseInt(self.dragSrcRow.dataset.idx);
                var toIdx = parseInt(this.dataset.idx);
                var tabType = this.dataset.tab;

                self.reorderItem(tabType, fromIdx, toIdx);
            });
        });
    },

    /**
     * Reorder item in the data array and save
     */
    async reorderItem(tabType, fromIdx, toIdx) {
        var items;
        if (tabType === 'content') items = this.contentdatas;
        else if (tabType === 'home') items = this.homedatas;
        else items = this.maindatas;

        // Move item from fromIdx to toIdx
        var moved = items.splice(fromIdx, 1)[0];
        items.splice(toIdx, 0, moved);

        var fieldMap = { content: 'content-data', home: 'home-data', main: 'main-data' };
        await this.saveField(fieldMap[tabType], items);
    },

    // =========================================
    // Add New Item
    // =========================================

    /**
     * Add new item to current tab
     */
    addNewItem() {
        if (!this.hmIdx) {
            toastError('프로젝트를 먼저 선택하세요.');
            return;
        }

        if (this.currentTab === 'content') {
            this.showAddContentDialog();
        } else {
            this.showAddLayoutDialog(this.currentTab);
        }
    },

    /**
     * Show dialog to add new content item
     */
    showAddContentDialog() {
        var typeOptions = ['html','img','mapimg','gallery','gallery1','gallery2','video_gallery','board','survey','lyrics','game','trand','webpage','faq','floor','pdf_gallery']
            .map(function(t) { return '<option value="' + t + '">' + t + '</option>'; }).join('');

        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="add-id" placeholder="고유 ID (예: content_1)"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="add-name" placeholder="콘텐츠 이름"></div>' +
            '<div class="form-group"><label class="form-label">타입</label>' +
            '<select class="form-control" id="add-type">' + typeOptions + '</select></div>' +
            '<div class="form-group"><label class="form-label">URL (선택)</label>' +
            '<input class="form-control" id="add-url" placeholder="콘텐츠 URL"></div>' +
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">Tab</label>' +
            '<input class="form-control" id="add-tab" value="0"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">Sub</label>' +
            '<input class="form-control" id="add-sub" value="0"></div>' +
            '</div></div>';

        var self = this;
        showModalDialog(document.body, '새 콘텐츠 추가', html, '추가', '취소',
            function() { self.doAddContentItem(); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );
    },

    doAddContentItem() {
        var id = document.getElementById('add-id').value.trim();
        var name = document.getElementById('add-name').value.trim();
        if (!id || !name) {
            toastError('ID와 이름을 입력하세요.');
            return;
        }

        var newItem = {
            id: id,
            name: name,
            type: document.getElementById('add-type').value,
            url: document.getElementById('add-url').value.trim(),
            tab: document.getElementById('add-tab').value || '0',
            sub: document.getElementById('add-sub').value || '0'
        };

        this.contentdatas.push(newItem);
        this.saveField('content-data', this.contentdatas);
    },

    /**
     * Show dialog to add new layout item (home/main)
     */
    showAddLayoutDialog(tabType) {
        var title = tabType === 'home' ? '새 홈화면 요소 추가' : '새 메인화면 요소 추가';
        var typeOptions = ['img','button','button_empty','video','text','bgcolor','animation','airapi','weatherapi']
            .map(function(t) { return '<option value="' + t + '">' + t + '</option>'; }).join('');

        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="add-id" placeholder="고유 ID (예: home_logo)"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="add-name" placeholder="요소 이름"></div>' +
            '<div class="form-group"><label class="form-label">타입</label>' +
            '<select class="form-control" id="add-type">' + typeOptions + '</select></div>' +
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">X</label>' +
            '<input class="form-control" id="add-x" type="number" value="0"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">Y</label>' +
            '<input class="form-control" id="add-y" type="number" value="0"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">W</label>' +
            '<input class="form-control" id="add-w" type="number" placeholder="너비"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">H</label>' +
            '<input class="form-control" id="add-h" type="number" placeholder="높이"></div>' +
            '</div>' +
            '<div class="form-group"><label class="form-label">이미지 URL (선택)</label>' +
            '<input class="form-control" id="add-imgurl" placeholder="이미지 경로"></div>' +
            '</div>';

        var self = this;
        showModalDialog(document.body, title, html, '추가', '취소',
            function() { self.doAddLayoutItem(tabType); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );
    },

    doAddLayoutItem(tabType) {
        var id = document.getElementById('add-id').value.trim();
        var name = document.getElementById('add-name').value.trim();
        if (!id || !name) {
            toastError('ID와 이름을 입력하세요.');
            return;
        }

        var newItem = {
            id: id,
            name: name,
            type: document.getElementById('add-type').value,
            x: document.getElementById('add-x').value || '0',
            y: document.getElementById('add-y').value || '0'
        };

        var w = document.getElementById('add-w').value;
        if (w) newItem.w = w;
        var h = document.getElementById('add-h').value;
        if (h) newItem.h = h;

        var imgurl = document.getElementById('add-imgurl').value.trim();
        if (imgurl) newItem.imgurl = imgurl;

        var items = tabType === 'home' ? this.homedatas : this.maindatas;
        items.push(newItem);

        var field = tabType === 'home' ? 'home-data' : 'main-data';
        this.saveField(field, items);
    },

    // =========================================
    // Edit Modals
    // =========================================

    /**
     * Edit a content data item
     */
    editContentItem(idx) {
        var item = Object.assign({}, this.contentdatas[idx]);
        var fields = this.buildContentFields(item);

        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="edit-id" value="' + escapeHtml(item.id || '') + '" readonly style="background:var(--bg-input);"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="edit-name" value="' + escapeHtml(item.name || '') + '"></div>' +
            '<div class="form-group"><label class="form-label">타입</label>' +
            '<select class="form-control" id="edit-type">' +
                ['html','img','mapimg','gallery','gallery1','gallery2','video_gallery','board','survey','lyrics','game','trand','webpage','faq','floor','pdf_gallery']
                    .map(function(t) { return '<option value="' + t + '" ' + (t === item.type ? 'selected' : '') + '>' + t + '</option>'; }).join('') +
            '</select></div>' +
            fields +
            '</div>';

        var self = this;
        showModalDialog(document.body, '콘텐츠 편집: ' + (item.name || ''), html, '저장', '취소',
            function() { self.saveContentItem(idx); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '550px' }, allowHtml: true }
        );
    },

    /**
     * Build extra fields for content types
     */
    buildContentFields(item) {
        var html = '';

        if (item.url !== undefined) {
            html += '<div class="form-group"><label class="form-label">URL</label>' +
                '<input class="form-control" id="edit-url" value="' + escapeHtml(item.url || '') + '"></div>';
        }

        if (item.tab !== undefined) {
            html += '<div style="display:flex;gap:8px;">' +
                '<div class="form-group" style="flex:1"><label class="form-label">Tab</label>' +
                '<input class="form-control" id="edit-tab" value="' + escapeHtml(String(item.tab || '0')) + '"></div>' +
                '<div class="form-group" style="flex:1"><label class="form-label">Sub</label>' +
                '<input class="form-control" id="edit-sub" value="' + escapeHtml(String(item.sub || '0')) + '"></div></div>';
        }

        if (item.type === 'survey') {
            html += '<div style="display:flex;gap:8px;">' +
                '<div class="form-group" style="flex:1"><label class="form-label">설문 IDX</label>' +
                '<input class="form-control" id="edit-surveyidx" value="' + (item.surveyidx || '') + '"></div>' +
                '<div class="form-group" style="flex:1"><label class="form-label">ON/OFF</label>' +
                '<select class="form-control" id="edit-surveyonoff">' +
                '<option value="1" ' + (item.surveyonoff == 1 ? 'selected' : '') + '>ON</option>' +
                '<option value="0" ' + (item.surveyonoff != 1 ? 'selected' : '') + '>OFF</option>' +
                '</select></div></div>';
        }

        if (item.type === 'lyrics') {
            html += '<div style="display:flex;gap:8px;">' +
                '<div class="form-group" style="flex:1"><label class="form-label">가사 IDX</label>' +
                '<input class="form-control" id="edit-lyricsidx" value="' + (item.lyricsidx || '') + '"></div>' +
                '<div class="form-group" style="flex:1"><label class="form-label">ON/OFF</label>' +
                '<select class="form-control" id="edit-lyricsonoff">' +
                '<option value="1" ' + (item.lyricsonoff == '1' ? 'selected' : '') + '>ON</option>' +
                '<option value="0" ' + (item.lyricsonoff != '1' ? 'selected' : '') + '>OFF</option>' +
                '</select></div></div>';
        }

        return html;
    },

    /**
     * Save edited content item
     */
    async saveContentItem(idx) {
        var item = Object.assign({}, this.contentdatas[idx]);

        item.name = document.getElementById('edit-name').value;
        item.type = document.getElementById('edit-type').value;

        var urlEl = document.getElementById('edit-url');
        if (urlEl) item.url = urlEl.value;

        var tabEl = document.getElementById('edit-tab');
        if (tabEl) item.tab = tabEl.value;

        var subEl = document.getElementById('edit-sub');
        if (subEl) item.sub = subEl.value;

        var surveyEl = document.getElementById('edit-surveyidx');
        if (surveyEl) item.surveyidx = parseInt(surveyEl.value) || 0;

        var surveyOnEl = document.getElementById('edit-surveyonoff');
        if (surveyOnEl) item.surveyonoff = parseInt(surveyOnEl.value);

        var lyricsEl = document.getElementById('edit-lyricsidx');
        if (lyricsEl) item.lyricsidx = lyricsEl.value;

        var lyricsOnEl = document.getElementById('edit-lyricsonoff');
        if (lyricsOnEl) item.lyricsonoff = lyricsOnEl.value;

        this.contentdatas[idx] = item;
        await this.saveField('content-data', this.contentdatas);
    },

    /**
     * Edit a home/main layout item
     */
    editLayoutItem(tabType, idx) {
        var items = tabType === 'home' ? this.homedatas : this.maindatas;
        var item = Object.assign({}, items[idx]);
        var html = this.buildLayoutEditHtml(item);
        var title = (tabType === 'home' ? '홈' : '메인') + '화면 편집: ' + (item.name || '');

        var self = this;
        showModalDialog(document.body, title, html, '저장', '취소',
            function() { self.saveLayoutItem(tabType, idx); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '600px' }, allowHtml: true }
        );
    },

    /**
     * Build HTML form for layout item editing
     */
    buildLayoutEditHtml(item) {
        var eventStr = item.event ? JSON.stringify(item.event, null, 2) : '';
        var typeOptions = ['img','button','button_empty','video','text','bgcolor','animation','airapi','weatherapi']
            .map(function(t) { return '<option value="' + t + '" ' + (t === item.type ? 'selected' : '') + '>' + t + '</option>'; }).join('');

        var typeFields = '';
        if (item.type === 'video') {
            typeFields += '<div class="form-group"><label class="form-label">동영상 URL</label>' +
                '<input class="form-control" id="edit-videourl" value="' + escapeHtml(item.videourl || '') + '"></div>';
        }
        if (item.type === 'text') {
            var ttOpts = ['text_notice','m/d','hh:mm','weekday','yyyy','hh:mm:ss','yyyymmdd']
                .map(function(t) { return '<option value="' + t + '" ' + (t === item.texttype ? 'selected' : '') + '>' + t + '</option>'; }).join('');
            typeFields += '<div style="display:flex;gap:8px;">' +
                '<div class="form-group" style="flex:1"><label class="form-label">텍스트 타입</label>' +
                '<select class="form-control" id="edit-texttype">' + ttOpts + '</select></div>' +
                '<div class="form-group" style="flex:1"><label class="form-label">폰트 크기</label>' +
                '<input class="form-control" id="edit-fontsize" value="' + (item.fontsize || '') + '"></div></div>' +
                '<div style="display:flex;gap:8px;">' +
                '<div class="form-group" style="flex:1"><label class="form-label">폰트 색상</label>' +
                '<div style="display:flex;gap:4px;">' +
                '<input type="color" id="edit-fontcolor" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="document.getElementById(\'edit-fontcolor-hex\').value=this.value" style="width:36px;height:32px;padding:2px;border:1px solid var(--border-color);border-radius:4px;cursor:pointer;">' +
                '<input class="form-control" id="edit-fontcolor-hex" value="' + escapeHtml(item.fontcolor || '#ffffff') + '" onchange="document.getElementById(\'edit-fontcolor\').value=this.value" style="flex:1;" placeholder="#000000">' +
                '</div></div>' +
                '<div class="form-group" style="flex:1"><label class="form-label">정렬</label>' +
                '<select class="form-control" id="edit-textalign">' +
                '<option value="left" ' + (item.textalign === 'left' ? 'selected' : '') + '>왼쪽</option>' +
                '<option value="center" ' + (item.textalign === 'center' ? 'selected' : '') + '>가운데</option>' +
                '<option value="right" ' + (item.textalign === 'right' ? 'selected' : '') + '>오른쪽</option>' +
                '</select></div></div>';
        }
        if (item.type === 'bgcolor') {
            typeFields += '<div class="form-group"><label class="form-label">배경색</label>' +
                '<input class="form-control" id="edit-color" type="color" value="' + (item.color || '#000000') + '"></div>';
        }

        var isText = item.type === 'text';

        // 이미지 URL (text 타입이 아닐 때만)
        var imgFields = '';
        if (!isText) {
            imgFields = '<div class="form-group"><label class="form-label">이미지 URL</label>' +
                '<div style="display:flex;gap:4px;">' +
                '<input class="form-control" id="edit-imgurl" value="' + escapeHtml(item.imgurl || '') + '" style="flex:1;">' +
                '<button type="button" class="btn btn-sm btn-light" onclick="channelEditor.pickImage(\'edit-imgurl\')" title="이미지 선택" style="white-space:nowrap;"><i class="fas fa-folder-open"></i></button>' +
                '</div></div>' +
                '<div class="form-group"><label class="form-label">클릭 이미지 URL</label>' +
                '<div style="display:flex;gap:4px;">' +
                '<input class="form-control" id="edit-clickurl" value="' + escapeHtml(item.clickurl || '') + '" style="flex:1;">' +
                '<button type="button" class="btn btn-sm btn-light" onclick="channelEditor.pickImage(\'edit-clickurl\')" title="이미지 선택" style="white-space:nowrap;"><i class="fas fa-folder-open"></i></button>' +
                '</div></div>';
        }

        // 텍스트 타입: 언어별 text 입력 (hm_all_language 기반)
        var textLangFields = '';
        if (isText && item.text && typeof item.text === 'object') {
            textLangFields = this.buildTextLangFields(item);
        }

        return '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">ID</label>' +
            '<input class="form-control" id="edit-id" value="' + escapeHtml(item.id || '') + '" readonly style="background:var(--bg-input);"></div>' +
            '<div class="form-group"><label class="form-label">이름</label>' +
            '<input class="form-control" id="edit-name" value="' + escapeHtml(item.name || '') + '"></div>' +
            '<div class="form-group"><label class="form-label">타입</label>' +
            '<select class="form-control" id="edit-type">' + typeOptions + '</select></div>' +
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">X</label>' +
            '<input class="form-control" id="edit-x" type="number" value="' + (item.x || 0) + '"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">Y</label>' +
            '<input class="form-control" id="edit-y" type="number" value="' + (item.y || 0) + '"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">W</label>' +
            '<input class="form-control" id="edit-w" type="number" value="' + (item.w || '') + '"></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">H</label>' +
            '<input class="form-control" id="edit-h" type="number" value="' + (item.h || '') + '"></div></div>' +
            imgFields +
            typeFields +
            textLangFields +
            '<div class="form-group"><label class="form-label">이벤트 (JSON)</label>' +
            '<textarea class="form-control" id="edit-event" rows="3" style="font-family:monospace;font-size:12px;">' + escapeHtml(eventStr) + '</textarea></div>' +
            '</div>';
    },

    /**
     * Build language-specific text input fields for text type elements
     */
    buildTextLangFields(item) {
        var languages = this.getLanguages();
        var html = '<div class="form-group"><label class="form-label">텍스트 (언어별)</label>';

        // 기존 text 키에서 언어 추가
        if (item.text && typeof item.text === 'object') {
            for (var k in item.text) {
                if (item.text.hasOwnProperty(k) && languages.indexOf(k) === -1) {
                    languages.push(k);
                }
            }
        }

        languages.forEach(function(lang) {
            var td = (item.text && item.text[lang]) ? item.text[lang] : {};
            var msg = td.message ? td.message.replace(/\|/g, '\n') : '';
            html += '<div style="display:flex;gap:6px;align-items:center;margin-bottom:6px;">' +
                '<span style="width:28px;font-size:12px;font-weight:600;color:var(--color-primary);flex-shrink:0;">' + escapeHtml(lang) + '</span>' +
                '<textarea class="form-control" id="edit-text-' + lang + '" rows="1" style="font-size:12px;resize:vertical;min-height:28px;flex:1;" placeholder="' + escapeHtml(lang) + ' 텍스트">' + escapeHtml(msg) + '</textarea>' +
                '</div>';
        });

        html += '</div>';
        return html;
    },

    /**
     * Get supported languages from homeData
     */
    getLanguages() {
        var codes = ['KO'];
        if (this.homeData) {
            if (this.homeData.hm_all_language) {
                codes = this.homeData.hm_all_language.split(',').map(function(s) { return s.trim(); }).filter(Boolean);
            } else if (this.homeData.hm_language) {
                codes = [this.homeData.hm_language];
            }
        }
        return codes;
    },

    /**
     * Save edited layout item
     */
    async saveLayoutItem(tabType, idx) {
        var items = tabType === 'home' ? this.homedatas : this.maindatas;
        var item = Object.assign({}, items[idx]);

        item.name = document.getElementById('edit-name').value;
        item.type = document.getElementById('edit-type').value;
        item.x = document.getElementById('edit-x').value;
        item.y = document.getElementById('edit-y').value;

        var w = document.getElementById('edit-w').value;
        if (w) item.w = w;
        var h = document.getElementById('edit-h').value;
        if (h) item.h = h;

        var imgurlEl = document.getElementById('edit-imgurl');
        if (imgurlEl) item.imgurl = imgurlEl.value;
        var clickurlEl = document.getElementById('edit-clickurl');
        if (clickurlEl) item.clickurl = clickurlEl.value;

        // Save language-specific text (for text type)
        if (item.type === 'text') {
            var languages = this.getLanguages();
            if (item.text && typeof item.text === 'object') {
                for (var k in item.text) {
                    if (item.text.hasOwnProperty(k) && languages.indexOf(k) === -1) {
                        languages.push(k);
                    }
                }
            }
            languages.forEach(function(lang) {
                var el = document.getElementById('edit-text-' + lang);
                if (el) {
                    if (!item.text || typeof item.text !== 'object') item.text = {};
                    if (!item.text[lang]) item.text[lang] = {};
                    item.text[lang].message = el.value.replace(/\n/g, '|');
                }
            });
        }

        var videoEl = document.getElementById('edit-videourl');
        if (videoEl) item.videourl = videoEl.value;

        var textTypeEl = document.getElementById('edit-texttype');
        if (textTypeEl) item.texttype = textTypeEl.value;

        var fontSizeEl = document.getElementById('edit-fontsize');
        if (fontSizeEl) item.fontsize = fontSizeEl.value;

        var fontColorHexEl = document.getElementById('edit-fontcolor-hex');
        var fontColorEl = document.getElementById('edit-fontcolor');
        if (fontColorHexEl && fontColorHexEl.value) {
            item.fontcolor = fontColorHexEl.value;
        } else if (fontColorEl) {
            item.fontcolor = fontColorEl.value;
        }

        var textAlignEl = document.getElementById('edit-textalign');
        if (textAlignEl) item.textalign = textAlignEl.value;

        var colorEl = document.getElementById('edit-color');
        if (colorEl) item.color = colorEl.value;

        var eventEl = document.getElementById('edit-event');
        if (eventEl && eventEl.value.trim()) {
            try {
                item.event = JSON.parse(eventEl.value);
            } catch (e) {
                toastError('이벤트 JSON 형식이 올바르지 않습니다.');
                return;
            }
        } else {
            delete item.event;
        }

        items[idx] = item;

        var field = tabType === 'home' ? 'home-data' : 'main-data';
        await this.saveField(field, items);
    },

    /**
     * Delete an item
     */
    deleteItem(tabType, idx) {
        var items = tabType === 'content' ? this.contentdatas : (tabType === 'home' ? this.homedatas : this.maindatas);
        var itemName = items[idx] ? items[idx].name : '';

        var self = this;
        confirmMsg('"' + itemName + '" 항목을 삭제하시겠습니까?', function() {
            items.splice(idx, 1);

            var fieldMap = { content: 'content-data', home: 'home-data', main: 'main-data' };
            self.saveField(fieldMap[tabType], items);
        });
    },

    // =========================================
    // Save
    // =========================================

    /**
     * Save a specific JSON field to server
     */
    async saveField(field, data) {
        C_ShowLoadingProgress();
        try {
            var res = await V3Api.put('/homes/' + this.hmIdx + '/' + field, { data: data });
            if (res.code === 100) {
                // Refresh local data
                if (res.data) {
                    this.homedatas = res.data.home_data || [];
                    this.maindatas = res.data.main_data || [];
                    this.contentdatas = res.data.content_data || [];
                }
                this.renderAllTables();
                this.refreshPreview();
                toastSuccess('저장되었습니다.');
            } else {
                toastError(res.message || '저장에 실패했습니다.');
            }
        } catch (err) {
            cerror('Save failed:', err);
            toastError('저장에 실패했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    },

    // =========================================
    // Raw Data Editor
    // =========================================

    /**
     * Show raw JSON data editor (v1 showContentsData equivalent)
     */
    showRawDataEditor() {
        var tabs = [
            { key: 'content', label: '콘텐츠 데이터', data: this.contentdatas },
            { key: 'home', label: '홈화면 데이터', data: this.homedatas },
            { key: 'main', label: '메인화면 데이터', data: this.maindatas }
        ];

        var html = '<div style="margin-bottom:12px;">' +
            '<select id="raw-data-select" class="form-control" onchange="channelEditor.onRawTabChange(this.value)">' +
            tabs.map(function(t) { return '<option value="' + t.key + '">' + t.label + ' (' + t.data.length + '개)</option>'; }).join('') +
            '</select></div>' +
            '<textarea id="raw-data-textarea" class="form-control" rows="20" ' +
            'style="font-family:monospace;font-size:12px;line-height:1.5;">' + JSON.stringify(this.contentdatas, null, 2) + '</textarea>' +
            '<p style="margin-top:8px;font-size:12px;color:var(--text-muted);">JSON 형식으로 직접 편집할 수 있습니다. 저장 시 유효성 검사를 수행합니다.</p>';

        var self = this;
        showModalDialog(document.body, '데이터 삽입/수정', html, '저장', '취소',
            function() { self.saveRawData(); },
            function() { hideModalDialog(); },
            { size: { width: '800px' }, allowHtml: true }
        );
    },

    onRawTabChange(key) {
        var dataMap = { content: this.contentdatas, home: this.homedatas, main: this.maindatas };
        document.getElementById('raw-data-textarea').value = JSON.stringify(dataMap[key] || [], null, 2);
    },

    async saveRawData() {
        var select = document.getElementById('raw-data-select');
        var textarea = document.getElementById('raw-data-textarea');
        var key = select.value;

        var parsed;
        try {
            parsed = JSON.parse(textarea.value);
            if (!Array.isArray(parsed)) throw new Error('배열이어야 합니다.');
        } catch (e) {
            toastError('JSON 형식 오류: ' + e.message);
            return;
        }

        var fieldMap = { content: 'content-data', home: 'home-data', main: 'main-data' };
        hideModalDialog();
        await this.saveField(fieldMap[key], parsed);
    },

    // =========================================
    // Image Picker (이미지 선택)
    // =========================================

    /**
     * Open file picker and set selected image to target input
     * @param {string} inputId - target input element ID
     */
    pickImage(inputId) {
        var input = document.getElementById(inputId);
        if (!input) return;

        var fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.style.display = 'none';

        fileInput.onchange = function() {
            if (!fileInput.files || !fileInput.files[0]) return;
            var file = fileInput.files[0];

            // Try upload via API
            var formData = new FormData();
            formData.append('file', file);
            formData.append('projectid', channelEditor.currentProjectId || '');
            formData.append('groupidx', channelEditor.homeData ? (channelEditor.homeData.hm_gr_idx || '0') : '0');

            fetch('./api/v3/upload.php', {
                method: 'POST',
                body: formData
            }).then(function(res) { return res.json(); })
            .then(function(data) {
                if (data.code === 100 && data.data && data.data.url) {
                    input.value = data.data.url;
                    toastSuccess(file.name + ' 업로드 완료');
                } else {
                    // Fallback: use data URL
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        input.value = e.target.result;
                        toastSuccess(file.name + ' 선택 완료 (로컬)');
                    };
                    reader.readAsDataURL(file);
                }
            }).catch(function() {
                var reader = new FileReader();
                reader.onload = function(e) {
                    input.value = e.target.result;
                    toastSuccess(file.name + ' 선택 완료 (로컬)');
                };
                reader.readAsDataURL(file);
            });

            fileInput.remove();
        };

        document.body.appendChild(fileInput);
        fileInput.click();
    }
};
