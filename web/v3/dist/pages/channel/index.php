<!-- SmartFlat CMS v3 - Channel Editor (화면 수정하기) -->
<div class="page-header">
    <div class="page-header-left">
        <nav class="breadcrumb-nav">
            <a href="#" onclick="loadPage('dashboard')">홈</a>
            <span>/</span>
            <span class="active">화면 수정</span>
        </nav>
        <h2 class="page-title">화면 수정하기</h2>
    </div>
    <div class="page-header-right">
        <!-- Safety Data Toggle -->
        <div id="channel-safety-toggle" style="display:none; align-items:center; gap:8px; padding:6px 12px; border-radius:8px; background:rgba(220,53,69,0.08); margin-right:8px;">
            <i class="fas fa-exclamation-triangle" style="color:var(--color-danger);"></i>
            <span style="font-size:13px; color:var(--color-danger); font-weight:500;">재난안전문자</span>
            <label class="toggle-switch" style="margin-left:4px;">
                <input type="checkbox" id="channel-safety-checkbox" onchange="channelEditor.toggleSafety(this.checked)">
                <span class="toggle-slider"></span>
            </label>
            <button class="btn btn-sm btn-light" onclick="channelEditor.showSafetySettings()" title="재난안전문자 설정" style="margin-left:4px; padding:2px 8px;">
                <i class="fas fa-cog"></i>
            </button>
        </div>
        <!-- ShortURL -->
        <div id="channel-shorturl-box" style="display:none; align-items:center; gap:6px; padding:4px 12px; border-radius:6px; background:var(--bg-input); border:1px solid var(--border-color); margin-right:8px; font-size:12px;">
            <span style="color:var(--color-danger); font-weight:500;">숏URL:</span>
            <span id="channel-shorturl-text" style="color:var(--text-dark); text-decoration:underline; cursor:pointer;" onclick="channelEditor.copyShortUrl()" title="클릭하여 복사"></span>
        </div>
        <button class="btn btn-light" onclick="channelEditor.copyPageUrl()" title="프로젝트 페이지 주소 복사">
            <i class="fas fa-link"></i> 페이지 주소
        </button>
        <button class="btn btn-light" onclick="channelEditor.copyPreviewUrl()" title="미리보기 주소 복사">
            <i class="fas fa-copy"></i> 주소 복사
        </button>
        <button class="btn btn-primary" onclick="channelEditor.showRawDataEditor()">
            <i class="fas fa-code"></i> 데이터 삽입/수정
        </button>
    </div>
</div>

<!-- Project Info (read from global selector) -->
<div id="channel-project-info-bar" class="card" style="margin-bottom:16px; display:none;">
    <div class="card-body" style="padding:10px 20px; font-size:13px; color:var(--text-gray);">
        <span id="channel-orientation-badge" class="badge badge-secondary"></span>
        <span id="channel-resolution-text" style="margin-left:8px;"></span>
        <span id="channel-language-text" style="margin-left:8px;"></span>
    </div>
</div>

<!-- Main Container: Preview + Editor -->
<div id="channel-main" style="display: none;">
    <div style="display: flex; gap: 20px; align-items: flex-start;">

        <!-- Left: iframe Preview -->
        <div id="channel-preview-container" style="flex-shrink: 0;">
            <div class="card">
                <div class="card-header" style="padding: 8px 16px;">
                    <span style="font-size: 13px; font-weight: 500;">미리보기</span>
                    <button class="btn btn-sm btn-light" onclick="channelEditor.refreshPreview()" style="float: right; padding: 2px 8px;">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
                <div class="card-body" style="padding: 0; overflow: hidden; background: #1e1e2d;">
                    <iframe id="channel-preview-iframe" style="border: none; display: block;"></iframe>
                </div>
            </div>
        </div>

        <!-- Right: Data Tables -->
        <div style="flex: 1; min-width: 0;">

            <!-- Tabs + Add Button -->
            <div class="card">
                <div class="card-header" style="padding: 0; border-bottom: none;">
                    <div style="display:flex; align-items:center; width:100%;">
                        <button class="tab-btn active" data-tab="content" onclick="channelEditor.switchTab('content')">
                            <i class="fas fa-th-large"></i> 콘텐츠 데이터
                            <span id="tab-count-content" class="badge badge-secondary" style="margin-left: 4px;">0</span>
                        </button>
                        <button class="tab-btn" data-tab="home" onclick="channelEditor.switchTab('home')">
                            <i class="fas fa-home"></i> 홈화면
                            <span id="tab-count-home" class="badge badge-secondary" style="margin-left: 4px;">0</span>
                        </button>
                        <button class="tab-btn" data-tab="main" onclick="channelEditor.switchTab('main')">
                            <i class="fas fa-bars"></i> 메인화면
                            <span id="tab-count-main" class="badge badge-secondary" style="margin-left: 4px;">0</span>
                        </button>
                    </div>
                    <div style="flex-shrink:0; padding-right:12px;">
                        <button class="btn btn-sm btn-primary" onclick="channelEditor.addNewItem()" title="새 항목 추가">
                            <i class="fas fa-plus"></i> 추가
                        </button>
                    </div>
                </div>

                <div class="card-body" style="padding: 0;">
                    <!-- Content Data Tab -->
                    <div id="tab-panel-content" class="tab-panel active">
                        <table class="data-table" id="content-data-table">
                            <thead>
                                <tr>
                                    <th style="width:30px" title="드래그하여 순서 변경"></th>
                                    <th style="width:50px">첫화면</th>
                                    <th style="width:40px">#</th>
                                    <th>이름</th>
                                    <th style="width:120px">타입</th>
                                    <th style="width:200px">미리보기</th>
                                    <th style="width:80px">작업</th>
                                </tr>
                            </thead>
                            <tbody id="content-data-tbody"></tbody>
                        </table>
                    </div>

                    <!-- Home Data Tab -->
                    <div id="tab-panel-home" class="tab-panel" style="display:none;">
                        <table class="data-table" id="home-data-table">
                            <thead>
                                <tr>
                                    <th style="width:30px"></th>
                                    <th style="width:40px">#</th>
                                    <th>이름</th>
                                    <th style="width:80px">타입</th>
                                    <th style="width:80px">이미지</th>
                                    <th style="width:60px">X</th>
                                    <th style="width:60px">Y</th>
                                    <th style="width:120px">이벤트</th>
                                    <th style="width:70px">작업</th>
                                </tr>
                            </thead>
                            <tbody id="home-data-tbody"></tbody>
                        </table>
                    </div>

                    <!-- Main Data Tab -->
                    <div id="tab-panel-main" class="tab-panel" style="display:none;">
                        <table class="data-table" id="main-data-table">
                            <thead>
                                <tr>
                                    <th style="width:30px"></th>
                                    <th style="width:40px">#</th>
                                    <th>이름</th>
                                    <th style="width:80px">타입</th>
                                    <th style="width:80px">이미지</th>
                                    <th style="width:60px">X</th>
                                    <th style="width:60px">Y</th>
                                    <th style="width:120px">이벤트</th>
                                    <th style="width:70px">작업</th>
                                </tr>
                            </thead>
                            <tbody id="main-data-tbody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
<div id="channel-empty" class="card" style="display: block;">
    <div class="card-body">
        <div class="empty-state">
            <div class="empty-state-icon"><i class="fas fa-tv"></i></div>
            <h4 class="empty-state-title">프로젝트를 선택하세요</h4>
            <p class="empty-state-description">상단에서 프로젝트를 선택하면 화면 데이터를 편집할 수 있습니다.</p>
        </div>
    </div>
</div>

<style>
.tab-btn {
    padding: 12px 20px;
    border: none;
    background: none;
    cursor: pointer;
    font-size: 14px;
    font-weight: 500;
    color: var(--text-gray);
    border-bottom: 2px solid transparent;
    transition: all 0.2s;
}
.tab-btn:hover { color: var(--text-dark); }
.tab-btn.active {
    color: var(--color-primary);
    border-bottom-color: var(--color-primary);
}
.data-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}
.data-table th {
    background: var(--bg-input);
    padding: 10px 12px;
    text-align: left;
    font-weight: 500;
    color: var(--text-gray);
    border-bottom: 1px solid var(--border-color);
}
.data-table td {
    padding: 8px 12px;
    border-bottom: 1px solid var(--border-color);
    vertical-align: middle;
}
.data-table tbody tr:hover { background: var(--bg-hover); }
.data-table tbody tr { cursor: pointer; }
.img-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border-color);
    background: var(--bg-input);
}
.type-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 4px;
    font-size: 11px;
    font-weight: 500;
    background: var(--bg-input);
    color: var(--text-dark);
}
.type-badge.img { background: #e8f5e9; color: #2e7d32; }
.type-badge.button { background: #e3f2fd; color: #1565c0; }
.type-badge.video { background: #fce4ec; color: #c62828; }
.type-badge.text { background: #fff3e0; color: #e65100; }
.type-badge.bgcolor { background: #f3e5f5; color: #6a1b9a; }
.type-badge.gallery { background: #e0f7fa; color: #00695c; }
.type-badge.html { background: #fafafa; color: #424242; }
.type-badge.board { background: #fff8e1; color: #f57f17; }
.type-badge.survey { background: #ede7f6; color: #4527a0; }
.btn-icon {
    width: 28px;
    height: 28px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-sm);
    border: 1px solid var(--border-color);
    background: var(--bg-card);
    cursor: pointer;
    font-size: 12px;
    color: var(--text-gray);
    transition: all 0.15s;
}
.btn-icon:hover { background: var(--bg-hover); color: var(--text-dark); }
.btn-icon.danger:hover { background: var(--color-danger-light); color: var(--color-danger); }

/* Toggle Switch */
.toggle-switch {
    position: relative;
    display: inline-block;
    width: 36px;
    height: 20px;
    margin: 0;
}
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute;
    cursor: pointer;
    inset: 0;
    background: #ccc;
    border-radius: 20px;
    transition: 0.2s;
}
.toggle-slider:before {
    content: "";
    position: absolute;
    width: 16px;
    height: 16px;
    left: 2px;
    bottom: 2px;
    background: white;
    border-radius: 50%;
    transition: 0.2s;
}
.toggle-switch input:checked + .toggle-slider { background: var(--color-danger); }
.toggle-switch input:checked + .toggle-slider:before { transform: translateX(16px); }

/* Drag handle */
.drag-handle {
    cursor: grab;
    color: var(--text-muted);
    font-size: 14px;
    padding: 4px;
    user-select: none;
}
.drag-handle:hover { color: var(--text-gray); }
.data-table tbody tr.dragging {
    opacity: 0.4;
    background: var(--bg-input);
}
.data-table tbody tr.drag-over {
    border-top: 2px solid var(--color-primary);
}
</style>

<script src="./js/components/channel-editor.js?v=<?php echo time(); ?>"></script>
<script>
    // Initialize - use global project selector
    channelEditor.init();

    // Listen for global project changes
    document.addEventListener('globalProjectChanged', function(e) {
        channelEditor.onProjectChange(e.detail.hmIdx);
    });

    // Auto-load after global projects are loaded
    document.addEventListener('globalProjectsLoaded', function() {
        var hmIdx = getGlobalProjectHmIdx();
        if (hmIdx) channelEditor.onProjectChange(hmIdx);
    });

    // Also try immediately (in case projects already loaded)
    (function() {
        var hmIdx = getGlobalProjectHmIdx();
        if (hmIdx) channelEditor.onProjectChange(hmIdx);
    })();
</script>
