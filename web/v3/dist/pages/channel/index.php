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
        <button class="btn btn-light" onclick="channelEditor.copyPreviewUrl()" title="미리보기 주소 복사">
            <i class="fas fa-copy"></i> 주소 복사
        </button>
        <button class="btn btn-primary" onclick="channelEditor.showRawDataEditor()">
            <i class="fas fa-code"></i> 데이터 삽입/수정
        </button>
    </div>
</div>

<!-- Project Selector -->
<div class="card" style="margin-bottom: 16px;">
    <div class="card-body" style="padding: 12px 20px;">
        <div style="display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <label style="font-weight: 500; white-space: nowrap;">프로젝트:</label>
                <select id="channel-project-select" class="form-control" style="width: 250px;" onchange="channelEditor.onProjectChange(this.value)">
                    <option value="">프로젝트를 선택하세요</option>
                </select>
            </div>
            <div id="channel-project-info" style="display: none; font-size: 13px; color: var(--text-gray);">
                <span id="channel-orientation-badge" class="badge badge-secondary"></span>
                <span id="channel-resolution-text" style="margin-left: 8px;"></span>
                <span id="channel-language-text" style="margin-left: 8px;"></span>
            </div>
        </div>
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

            <!-- Tabs -->
            <div class="card">
                <div class="card-header" style="padding: 0; border-bottom: none;">
                    <div style="display: flex;">
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
                </div>

                <div class="card-body" style="padding: 0;">
                    <!-- Content Data Tab -->
                    <div id="tab-panel-content" class="tab-panel active">
                        <table class="data-table" id="content-data-table">
                            <thead>
                                <tr>
                                    <th style="width:50px">#</th>
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
</style>

<script src="./js/components/channel-editor.js?v=<?php echo time(); ?>"></script>
<script>
    // Initialize after page load
    channelEditor.init();
</script>
