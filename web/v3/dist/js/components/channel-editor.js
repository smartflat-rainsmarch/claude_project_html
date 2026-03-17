/**
 * SmartFlat CMS v3 - Channel Editor
 * Screen layout editor (화면 수정하기)
 * Replaces v1 a_channel.php functionality
 */

'use strict';

const channelEditor = {
    // State
    homeData: null,       // Full tb_home row
    homedatas: [],        // hm_home_data parsed
    maindatas: [],        // hm_main_data parsed
    contentdatas: [],     // hm_content_data parsed
    currentTab: 'content',
    currentProjectId: null,
    hmIdx: null,

    /**
     * Initialize the editor
     */
    init() {
        this.loadProjects();
    },

    /**
     * Load project list for selector
     */
    async loadProjects() {
        try {
            const res = await V3Api.get('/homes');
            if (res.code === 100 && res.data) {
                const select = document.getElementById('channel-project-select');
                res.data.forEach(home => {
                    const opt = document.createElement('option');
                    opt.value = home.hm_idx;
                    opt.textContent = home.hm_projectname
                        ? `${home.hm_projectname} (${home.hm_projectid})`
                        : home.hm_projectid;
                    opt.dataset.projectId = home.hm_projectid;
                    select.appendChild(opt);
                });
            }
        } catch (err) {
            cerror('Failed to load projects:', err);
        }
    },

    /**
     * Handle project selection change
     */
    async onProjectChange(hmIdx) {
        if (!hmIdx) {
            document.getElementById('channel-main').style.display = 'none';
            document.getElementById('channel-empty').style.display = 'block';
            return;
        }

        this.hmIdx = hmIdx;
        C_ShowLoadingProgress();

        try {
            const res = await V3Api.get(`/homes/${hmIdx}`);
            if (res.code === 100 && res.data) {
                this.homeData = res.data;
                this.homedatas = res.data.home_data || [];
                this.maindatas = res.data.main_data || [];
                this.contentdatas = res.data.content_data || [];
                this.currentProjectId = res.data.hm_projectid;

                this.updateProjectInfo();
                this.renderAllTables();
                this.initPreview();

                document.getElementById('channel-main').style.display = 'block';
                document.getElementById('channel-empty').style.display = 'none';
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
        const info = document.getElementById('channel-project-info');
        const orient = document.getElementById('channel-orientation-badge');
        const reso = document.getElementById('channel-resolution-text');
        const lang = document.getElementById('channel-language-text');

        const d = this.homeData;
        orient.textContent = d.hm_orientation === 'L' ? '가로' : '세로';
        orient.className = 'badge ' + (d.hm_orientation === 'L' ? 'badge-info' : 'badge-primary');

        const w = d.hm_width || (d.hm_orientation === 'L' ? 1920 : 1080);
        const h = d.hm_height || (d.hm_orientation === 'L' ? 1080 : 1920);
        reso.textContent = `${w} × ${h}px`;

        const langMap = { KO: '한국어', EN: 'English', ZH: '中文', VI: 'Tiếng Việt', MS: 'Bahasa' };
        lang.textContent = langMap[d.hm_language] || d.hm_language || 'KO';

        info.style.display = 'flex';
    },

    /**
     * Initialize iframe preview
     */
    initPreview() {
        const d = this.homeData;
        const container = document.getElementById('channel-preview-container');
        const iframe = document.getElementById('channel-preview-iframe');

        const swidth = d.hm_width > 0 ? parseInt(d.hm_width) : (d.hm_orientation === 'L' ? 1920 : 1080);
        const sheight = d.hm_height > 0 ? parseInt(d.hm_height) : (d.hm_orientation === 'L' ? 1080 : 1920);

        // Scale to fit (max 360px wide for portrait)
        const maxW = d.hm_orientation === 'L' ? 500 : 360;
        const scale = maxW / swidth;
        const displayW = Math.round(swidth * scale);
        const displayH = Math.round(sheight * scale);

        iframe.style.width = swidth + 'px';
        iframe.style.height = sheight + 'px';
        iframe.style.transform = `scale(${scale})`;
        iframe.style.transformOrigin = '0 0';

        container.querySelector('.card-body').style.width = displayW + 'px';
        container.querySelector('.card-body').style.height = displayH + 'px';

        // Build preview URL
        const basePath = `../../../game/school/${d.hm_projectid}/v${d.hm_gr_idx || 0}/`;
        iframe.src = basePath + 'index.html?t=' + Date.now();
    },

    /**
     * Refresh preview iframe
     */
    refreshPreview() {
        const iframe = document.getElementById('channel-preview-iframe');
        if (iframe.src) {
            iframe.src = iframe.src.replace(/[?&]t=\d+/, '') + '?t=' + Date.now();
        }
    },

    /**
     * Copy preview URL
     */
    copyPreviewUrl() {
        const iframe = document.getElementById('channel-preview-iframe');
        if (iframe.src) {
            navigator.clipboard.writeText(iframe.src).then(() => {
                toastSuccess('미리보기 주소가 복사되었습니다.');
            }).catch(() => {
                toastError('복사에 실패했습니다.');
            });
        }
    },

    /**
     * Switch between tabs
     */
    switchTab(tab) {
        this.currentTab = tab;

        // Update tab buttons
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.tab === tab);
        });

        // Update panels
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.style.display = 'none';
        });
        document.getElementById(`tab-panel-${tab}`).style.display = 'block';
    },

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
        const tbody = document.getElementById('content-data-tbody');
        if (this.contentdatas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);">콘텐츠 데이터가 없습니다.</td></tr>';
            return;
        }

        tbody.innerHTML = this.contentdatas.map((item, idx) => {
            const typeClass = this.getTypeClass(item.type);
            const name = escapeHtml(item.name || '');
            const type = escapeHtml(item.type || '');

            return `<tr onclick="channelEditor.editContentItem(${idx})" title="클릭하여 편집">
                <td>${idx + 1}</td>
                <td><strong>${name}</strong><br><span style="font-size:11px;color:var(--text-muted);">${escapeHtml(item.id || '')}</span></td>
                <td><span class="type-badge ${typeClass}">${type}</span></td>
                <td>${this.getContentPreview(item)}</td>
                <td>
                    <button class="btn-icon" onclick="event.stopPropagation();channelEditor.editContentItem(${idx})" title="편집"><i class="fas fa-edit"></i></button>
                    <button class="btn-icon danger" onclick="event.stopPropagation();channelEditor.deleteItem('content',${idx})" title="삭제"><i class="fas fa-trash"></i></button>
                </td>
            </tr>`;
        }).join('');
    },

    /**
     * Render home data table (Tab 1)
     */
    renderHomeTable() {
        const tbody = document.getElementById('home-data-tbody');
        if (this.homedatas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted);">홈화면 데이터가 없습니다.</td></tr>';
            return;
        }

        tbody.innerHTML = this.homedatas.map((item, idx) => this.renderLayoutRow(item, idx, 'home')).join('');
    },

    /**
     * Render main data table (Tab 2)
     */
    renderMainTable() {
        const tbody = document.getElementById('main-data-tbody');
        if (this.maindatas.length === 0) {
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted);">메인화면 데이터가 없습니다.</td></tr>';
            return;
        }

        tbody.innerHTML = this.maindatas.map((item, idx) => this.renderLayoutRow(item, idx, 'main')).join('');
    },

    /**
     * Render a home/main layout data row
     */
    renderLayoutRow(item, idx, tabType) {
        const typeClass = this.getTypeClass(item.type);
        const name = escapeHtml(item.name || '');
        const type = escapeHtml(item.type || '');
        const x = item.x !== undefined ? item.x : '-';
        const y = item.y !== undefined ? item.y : '-';
        const imgurl = item.imgurl || '';
        const event = item.event ? escapeHtml(JSON.stringify(item.event)) : '-';

        const imgHtml = imgurl
            ? `<img class="img-thumb" src="${escapeHtml(imgurl)}?t=${Date.now()}" onerror="this.style.display='none'">`
            : '<span style="color:var(--text-muted);font-size:11px;">없음</span>';

        return `<tr onclick="channelEditor.editLayoutItem('${tabType}',${idx})" title="클릭하여 편집">
            <td>${idx + 1}</td>
            <td><strong>${name}</strong><br><span style="font-size:11px;color:var(--text-muted);">${escapeHtml(item.id || '')}</span></td>
            <td><span class="type-badge ${typeClass}">${type}</span></td>
            <td>${imgHtml}</td>
            <td>${x}</td>
            <td>${y}</td>
            <td style="font-size:11px;max-width:120px;overflow:hidden;text-overflow:ellipsis;">${event}</td>
            <td>
                <button class="btn-icon" onclick="event.stopPropagation();channelEditor.editLayoutItem('${tabType}',${idx})" title="편집"><i class="fas fa-edit"></i></button>
                <button class="btn-icon danger" onclick="event.stopPropagation();channelEditor.deleteItem('${tabType}',${idx})" title="삭제"><i class="fas fa-trash"></i></button>
            </td>
        </tr>`;
    },

    /**
     * Get content preview HTML
     */
    getContentPreview(item) {
        if (item.type === 'mapimg' && item.images && item.images.length > 0) {
            const src = `../../../game/school/${this.currentProjectId}/v${this.homeData.hm_gr_idx || 0}/contentdata/${item.images[0]}`;
            return `<img class="img-thumb" src="${escapeHtml(src)}" onerror="this.style.display='none'">`;
        }
        if (item.type === 'gallery' || item.type === 'gallery1' || item.type === 'gallery2') {
            return '<span style="color:var(--text-muted);"><i class="fas fa-images"></i> 갤러리</span>';
        }
        if (item.type === 'video_gallery') {
            return '<span style="color:var(--text-muted);"><i class="fas fa-video"></i> 비디오</span>';
        }
        if (item.type === 'survey') {
            return '<span style="color:var(--text-muted);"><i class="fas fa-poll"></i> 설문</span>';
        }
        if (item.type === 'board') {
            return '<span style="color:var(--text-muted);"><i class="fas fa-clipboard-list"></i> 게시판</span>';
        }
        if (item.type === 'lyrics') {
            return '<span style="color:var(--text-muted);"><i class="fas fa-music"></i> 가사</span>';
        }
        if (item.type === 'game') {
            return '<span style="color:var(--text-muted);"><i class="fas fa-gamepad"></i> 게임</span>';
        }
        return '<span style="color:var(--text-muted);"><i class="fas fa-file"></i> ' + escapeHtml(item.type || '') + '</span>';
    },

    /**
     * Get CSS class for element type
     */
    getTypeClass(type) {
        const map = {
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
    // Edit Modals
    // =========================================

    /**
     * Edit a content data item
     */
    editContentItem(idx) {
        const item = { ...this.contentdatas[idx] };
        const fields = this.buildContentFields(item);

        const html = `
            <div style="display:grid;gap:12px;">
                <div class="form-group"><label class="form-label">ID</label>
                    <input class="form-control" id="edit-id" value="${escapeHtml(item.id || '')}" readonly style="background:var(--bg-input);"></div>
                <div class="form-group"><label class="form-label">이름</label>
                    <input class="form-control" id="edit-name" value="${escapeHtml(item.name || '')}"></div>
                <div class="form-group"><label class="form-label">타입</label>
                    <select class="form-control" id="edit-type">
                        ${['html','img','mapimg','gallery','gallery1','gallery2','video_gallery','board','survey','lyrics','game','trand','webpage','faq','floor','pdf_gallery']
                            .map(t => `<option value="${t}" ${t===item.type?'selected':''}>${t}</option>`).join('')}
                    </select></div>
                ${fields}
            </div>`;

        showModalDialog(document.body, `콘텐츠 편집: ${item.name}`, html, '저장', '취소',
            () => { this.saveContentItem(idx); hideModalDialog(); },
            () => { hideModalDialog(); },
            { size: { width: '550px' }, allowHtml: true }
        );
    },

    /**
     * Build extra fields for content types
     */
    buildContentFields(item) {
        let html = '';

        if (item.url !== undefined) {
            html += `<div class="form-group"><label class="form-label">URL</label>
                <input class="form-control" id="edit-url" value="${escapeHtml(item.url || '')}"></div>`;
        }

        if (item.tab !== undefined) {
            html += `<div style="display:flex;gap:8px;">
                <div class="form-group" style="flex:1"><label class="form-label">Tab</label>
                    <input class="form-control" id="edit-tab" value="${escapeHtml(String(item.tab || '0'))}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">Sub</label>
                    <input class="form-control" id="edit-sub" value="${escapeHtml(String(item.sub || '0'))}"></div>
            </div>`;
        }

        if (item.type === 'survey') {
            html += `<div style="display:flex;gap:8px;">
                <div class="form-group" style="flex:1"><label class="form-label">설문 IDX</label>
                    <input class="form-control" id="edit-surveyidx" value="${item.surveyidx || ''}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">ON/OFF</label>
                    <select class="form-control" id="edit-surveyonoff">
                        <option value="1" ${item.surveyonoff==1?'selected':''}>ON</option>
                        <option value="0" ${item.surveyonoff!=1?'selected':''}>OFF</option>
                    </select></div>
            </div>`;
        }

        if (item.type === 'lyrics') {
            html += `<div style="display:flex;gap:8px;">
                <div class="form-group" style="flex:1"><label class="form-label">가사 IDX</label>
                    <input class="form-control" id="edit-lyricsidx" value="${item.lyricsidx || ''}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">ON/OFF</label>
                    <select class="form-control" id="edit-lyricsonoff">
                        <option value="1" ${item.lyricsonoff=='1'?'selected':''}>ON</option>
                        <option value="0" ${item.lyricsonoff!='1'?'selected':''}>OFF</option>
                    </select></div>
            </div>`;
        }

        return html;
    },

    /**
     * Save edited content item
     */
    async saveContentItem(idx) {
        const item = { ...this.contentdatas[idx] };

        item.name = document.getElementById('edit-name').value;
        item.type = document.getElementById('edit-type').value;

        const urlEl = document.getElementById('edit-url');
        if (urlEl) item.url = urlEl.value;

        const tabEl = document.getElementById('edit-tab');
        if (tabEl) item.tab = tabEl.value;

        const subEl = document.getElementById('edit-sub');
        if (subEl) item.sub = subEl.value;

        const surveyEl = document.getElementById('edit-surveyidx');
        if (surveyEl) item.surveyidx = parseInt(surveyEl.value) || 0;

        const surveyOnEl = document.getElementById('edit-surveyonoff');
        if (surveyOnEl) item.surveyonoff = parseInt(surveyOnEl.value);

        const lyricsEl = document.getElementById('edit-lyricsidx');
        if (lyricsEl) item.lyricsidx = lyricsEl.value;

        const lyricsOnEl = document.getElementById('edit-lyricsonoff');
        if (lyricsOnEl) item.lyricsonoff = lyricsOnEl.value;

        this.contentdatas[idx] = item;
        await this.saveField('content-data', this.contentdatas);
    },

    /**
     * Edit a home/main layout item
     */
    editLayoutItem(tabType, idx) {
        const items = tabType === 'home' ? this.homedatas : this.maindatas;
        const item = { ...items[idx] };
        const html = this.buildLayoutEditHtml(item);
        const title = `${tabType === 'home' ? '홈' : '메인'}화면 편집: ${item.name}`;

        showModalDialog(document.body, title, html, '저장', '취소',
            () => { this.saveLayoutItem(tabType, idx); hideModalDialog(); },
            () => { hideModalDialog(); },
            { size: { width: '600px' }, allowHtml: true }
        );
    },

    /**
     * Build HTML form for layout item editing
     */
    buildLayoutEditHtml(item) {
        const eventStr = item.event ? JSON.stringify(item.event, null, 2) : '';
        const typeOptions = ['img','button','button_empty','video','text','bgcolor','animation','airapi','weatherapi']
            .map(t => `<option value="${t}" ${t===item.type?'selected':''}>${t}</option>`).join('');

        let typeFields = '';
        if (item.type === 'video') {
            typeFields += `<div class="form-group"><label class="form-label">동영상 URL</label>
                <input class="form-control" id="edit-videourl" value="${escapeHtml(item.videourl || '')}"></div>`;
        }
        if (item.type === 'text') {
            const ttOpts = ['text_notice','m/d','hh:mm','weekday','yyyy','hh:mm:ss','yyyymmdd']
                .map(t => `<option value="${t}" ${t===item.texttype?'selected':''}>${t}</option>`).join('');
            typeFields += `<div style="display:flex;gap:8px;">
                <div class="form-group" style="flex:1"><label class="form-label">텍스트 타입</label>
                    <select class="form-control" id="edit-texttype">${ttOpts}</select></div>
                <div class="form-group" style="flex:1"><label class="form-label">폰트 크기</label>
                    <input class="form-control" id="edit-fontsize" value="${item.fontsize || ''}"></div>
            </div>
            <div style="display:flex;gap:8px;">
                <div class="form-group" style="flex:1"><label class="form-label">폰트 색상</label>
                    <input class="form-control" id="edit-fontcolor" type="color" value="${item.fontcolor || '#ffffff'}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">정렬</label>
                    <select class="form-control" id="edit-textalign">
                        <option value="left" ${item.textalign==='left'?'selected':''}>왼쪽</option>
                        <option value="center" ${item.textalign==='center'?'selected':''}>가운데</option>
                        <option value="right" ${item.textalign==='right'?'selected':''}>오른쪽</option>
                    </select></div>
            </div>`;
        }
        if (item.type === 'bgcolor') {
            typeFields += `<div class="form-group"><label class="form-label">배경색</label>
                <input class="form-control" id="edit-color" type="color" value="${item.color || '#000000'}"></div>`;
        }

        return `<div style="display:grid;gap:12px;">
            <div class="form-group"><label class="form-label">ID</label>
                <input class="form-control" id="edit-id" value="${escapeHtml(item.id || '')}" readonly style="background:var(--bg-input);"></div>
            <div class="form-group"><label class="form-label">이름</label>
                <input class="form-control" id="edit-name" value="${escapeHtml(item.name || '')}"></div>
            <div class="form-group"><label class="form-label">타입</label>
                <select class="form-control" id="edit-type">${typeOptions}</select></div>
            <div style="display:flex;gap:8px;">
                <div class="form-group" style="flex:1"><label class="form-label">X</label>
                    <input class="form-control" id="edit-x" type="number" value="${item.x || 0}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">Y</label>
                    <input class="form-control" id="edit-y" type="number" value="${item.y || 0}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">W</label>
                    <input class="form-control" id="edit-w" type="number" value="${item.w || ''}"></div>
                <div class="form-group" style="flex:1"><label class="form-label">H</label>
                    <input class="form-control" id="edit-h" type="number" value="${item.h || ''}"></div>
            </div>
            <div class="form-group"><label class="form-label">이미지 URL</label>
                <input class="form-control" id="edit-imgurl" value="${escapeHtml(item.imgurl || '')}"></div>
            <div class="form-group"><label class="form-label">클릭 이미지 URL</label>
                <input class="form-control" id="edit-clickurl" value="${escapeHtml(item.clickurl || '')}"></div>
            ${typeFields}
            <div class="form-group"><label class="form-label">이벤트 (JSON)</label>
                <textarea class="form-control" id="edit-event" rows="3" style="font-family:monospace;font-size:12px;">${escapeHtml(eventStr)}</textarea></div>
        </div>`;
    },

    /**
     * Save edited layout item
     */
    async saveLayoutItem(tabType, idx) {
        const items = tabType === 'home' ? this.homedatas : this.maindatas;
        const item = { ...items[idx] };

        item.name = document.getElementById('edit-name').value;
        item.type = document.getElementById('edit-type').value;
        item.x = document.getElementById('edit-x').value;
        item.y = document.getElementById('edit-y').value;

        const w = document.getElementById('edit-w').value;
        if (w) item.w = w;
        const h = document.getElementById('edit-h').value;
        if (h) item.h = h;

        item.imgurl = document.getElementById('edit-imgurl').value;
        item.clickurl = document.getElementById('edit-clickurl').value;

        const videoEl = document.getElementById('edit-videourl');
        if (videoEl) item.videourl = videoEl.value;

        const textTypeEl = document.getElementById('edit-texttype');
        if (textTypeEl) item.texttype = textTypeEl.value;

        const fontSizeEl = document.getElementById('edit-fontsize');
        if (fontSizeEl) item.fontsize = fontSizeEl.value;

        const fontColorEl = document.getElementById('edit-fontcolor');
        if (fontColorEl) item.fontcolor = fontColorEl.value;

        const textAlignEl = document.getElementById('edit-textalign');
        if (textAlignEl) item.textalign = textAlignEl.value;

        const colorEl = document.getElementById('edit-color');
        if (colorEl) item.color = colorEl.value;

        const eventEl = document.getElementById('edit-event');
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

        const field = tabType === 'home' ? 'home-data' : 'main-data';
        await this.saveField(field, items);
    },

    /**
     * Delete an item
     */
    deleteItem(tabType, idx) {
        const items = tabType === 'content' ? this.contentdatas : (tabType === 'home' ? this.homedatas : this.maindatas);
        const itemName = items[idx]?.name || '';

        confirmMsg(`"${itemName}" 항목을 삭제하시겠습니까?`, async () => {
            items.splice(idx, 1);

            const fieldMap = { content: 'content-data', home: 'home-data', main: 'main-data' };
            await this.saveField(fieldMap[tabType], items);
        });
    },

    /**
     * Save a specific JSON field to server
     */
    async saveField(field, data) {
        C_ShowLoadingProgress();
        try {
            const res = await V3Api.put(`/homes/${this.hmIdx}/${field}`, { data });
            if (res.code === 100) {
                // Refresh local data
                if (res.data) {
                    this.homedatas = res.data.home_data || [];
                    this.maindatas = res.data.main_data || [];
                    this.contentdatas = res.data.content_data || [];
                }
                this.renderAllTables();
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

    /**
     * Show raw JSON data editor (v1 showContentsData equivalent)
     */
    showRawDataEditor() {
        const tabs = [
            { key: 'content', label: '콘텐츠 데이터', data: this.contentdatas },
            { key: 'home', label: '홈화면 데이터', data: this.homedatas },
            { key: 'main', label: '메인화면 데이터', data: this.maindatas }
        ];

        const html = `
            <div style="margin-bottom:12px;">
                <select id="raw-data-select" class="form-control" onchange="channelEditor.onRawTabChange(this.value)">
                    ${tabs.map(t => `<option value="${t.key}">${t.label} (${t.data.length}개)</option>`).join('')}
                </select>
            </div>
            <textarea id="raw-data-textarea" class="form-control" rows="20"
                style="font-family:monospace;font-size:12px;line-height:1.5;">${JSON.stringify(this.contentdatas, null, 2)}</textarea>
            <p style="margin-top:8px;font-size:12px;color:var(--text-muted);">JSON 형식으로 직접 편집할 수 있습니다. 저장 시 유효성 검사를 수행합니다.</p>`;

        showModalDialog(document.body, '데이터 삽입/수정', html, '저장', '취소',
            () => { this.saveRawData(); },
            () => { hideModalDialog(); },
            { size: { width: '800px' }, allowHtml: true }
        );
    },

    onRawTabChange(key) {
        const dataMap = { content: this.contentdatas, home: this.homedatas, main: this.maindatas };
        document.getElementById('raw-data-textarea').value = JSON.stringify(dataMap[key] || [], null, 2);
    },

    async saveRawData() {
        const select = document.getElementById('raw-data-select');
        const textarea = document.getElementById('raw-data-textarea');
        const key = select.value;

        let parsed;
        try {
            parsed = JSON.parse(textarea.value);
            if (!Array.isArray(parsed)) throw new Error('배열이어야 합니다.');
        } catch (e) {
            toastError('JSON 형식 오류: ' + e.message);
            return;
        }

        const fieldMap = { content: 'content-data', home: 'home-data', main: 'main-data' };
        hideModalDialog();
        await this.saveField(fieldMap[key], parsed);
    }
};
