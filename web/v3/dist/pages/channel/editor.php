<!-- SmartFlat CMS v3 - Visual Editor (비주얼 에디터) -->
<link href="./css/editor.css?v=<?php echo time(); ?>" rel="stylesheet">

<div class="page-header">
    <div class="page-header-left">
        <nav class="breadcrumb-nav">
            <a href="#" onclick="loadPage('dashboard')">홈</a>
            <span>/</span>
            <a href="#" onclick="loadPage('channel')">화면 수정</a>
            <span>/</span>
            <span class="active">비주얼 에디터</span>
        </nav>
        <h2 class="page-title">비주얼 에디터</h2>
    </div>
    <div class="page-header-right">
        <span id="ve-save-indicator" class="save-indicator saved"><i class="fas fa-check-circle"></i> 저장됨</span>
        <button class="btn btn-light" onclick="visualEditor.undo()" title="되돌리기 (Ctrl+Z)"><i class="fas fa-undo"></i></button>
        <button class="btn btn-light" onclick="visualEditor.redo()" title="다시 실행 (Ctrl+Y)"><i class="fas fa-redo"></i></button>
        <button class="btn btn-primary" onclick="visualEditor.saveNow()" title="저장"><i class="fas fa-save"></i> 저장</button>
    </div>
</div>

<!-- Toolbar -->
<div class="editor-toolbar">
    <div class="toolbar-group">
        <span class="toolbar-label">화면:</span>
        <button class="tool-btn active" id="ve-tab-home" onclick="visualEditor.switchTab('home')" title="홈화면"><i class="fas fa-home"></i></button>
        <button class="tool-btn" id="ve-tab-main" onclick="visualEditor.switchTab('main')" title="메인화면"><i class="fas fa-bars"></i></button>
    </div>
    <div class="toolbar-group">
        <span class="toolbar-label">도구:</span>
        <button class="tool-btn active" id="ve-tool-select" onclick="visualEditor.setTool('select')" title="선택 (V)"><i class="fas fa-mouse-pointer"></i></button>
        <button class="tool-btn" id="ve-tool-move" onclick="visualEditor.setTool('move')" title="이동 (M)"><i class="fas fa-arrows-alt"></i></button>
    </div>
    <div class="toolbar-group">
        <span class="toolbar-label">추가:</span>
        <button class="tool-btn" onclick="visualEditor.showAddImageDialog()" title="이미지 추가"><i class="fas fa-image"></i></button>
        <button class="tool-btn" onclick="visualEditor.showAddButtonDialog()" title="버튼 추가"><i class="fas fa-hand-pointer"></i></button>
        <button class="tool-btn" onclick="visualEditor.showAddTextDialog()" title="텍스트 추가"><i class="fas fa-font"></i></button>
    </div>
    <div class="toolbar-group">
        <button class="tool-btn" onclick="visualEditor.toggleGrid()" id="ve-grid-btn" title="그리드 표시"><i class="fas fa-th"></i></button>
        <button class="tool-btn" onclick="visualEditor.toggleSnap()" id="ve-snap-btn" title="스냅 정렬"><i class="fas fa-magnet"></i></button>
    </div>
    <div class="toolbar-group">
        <span class="toolbar-label">앵커:</span>
        <select class="toolbar-select" id="ve-anchor-select" onchange="visualEditor.setAnchor(this.value)">
            <option value="top-left">좌상단</option>
            <option value="top-center">상단 중앙</option>
            <option value="top-right">우상단</option>
            <option value="center">중앙</option>
            <option value="bottom-left">좌하단</option>
            <option value="bottom-center">하단 중앙</option>
            <option value="bottom-right">우하단</option>
        </select>
    </div>
    <div class="toolbar-group" style="margin-left:auto;">
        <span class="toolbar-label" id="ve-info-text">1080 x 1920</span>
    </div>
</div>

<!-- Editor Main -->
<div class="editor-container">
    <!-- Canvas Area -->
    <div class="editor-canvas-area" id="ve-canvas-area">
        <div class="editor-canvas-wrapper" id="ve-canvas-wrapper">
            <div class="editor-canvas" id="ve-canvas"></div>
        </div>

        <!-- Zoom Controls -->
        <div class="editor-zoom-controls">
            <button class="tool-btn" onclick="visualEditor.zoomOut()"><i class="fas fa-minus"></i></button>
            <span class="zoom-text" id="ve-zoom-text">100%</span>
            <button class="tool-btn" onclick="visualEditor.zoomIn()"><i class="fas fa-plus"></i></button>
            <button class="tool-btn" onclick="visualEditor.zoomFit()" title="화면 맞춤"><i class="fas fa-expand"></i></button>
        </div>
    </div>

    <!-- Property Panel -->
    <div class="editor-panel" id="ve-panel">
        <div class="panel-header">
            <span>속성</span>
        </div>
        <div class="panel-empty" id="ve-panel-empty">
            <i class="fas fa-mouse-pointer"></i>
            <p>요소를 클릭하여 선택하세요</p>
        </div>
        <div id="ve-panel-content" style="display:none;">
            <!-- Filled dynamically -->
        </div>
    </div>
</div>

<!-- Context Menu -->
<div id="ve-context-menu" class="context-menu" style="display:none;">
    <div class="context-menu-item" data-action="edit"><i class="fas fa-edit"></i> 속성 편집</div>
    <div class="context-menu-item" data-action="font" id="ve-ctx-font" style="display:none;"><i class="fas fa-font"></i> 폰트 속성</div>
    <div class="context-menu-item" data-action="add-text" id="ve-ctx-addtext" style="display:none;"><i class="fas fa-plus"></i> 텍스트 추가</div>
    <div class="context-menu-divider"></div>
    <div class="context-menu-item" data-action="duplicate"><i class="fas fa-copy"></i> 복제</div>
    <div class="context-menu-item" data-action="bring-front"><i class="fas fa-arrow-up"></i> 맨 앞으로</div>
    <div class="context-menu-item" data-action="send-back"><i class="fas fa-arrow-down"></i> 맨 뒤로</div>
    <div class="context-menu-divider"></div>
    <div class="context-menu-item danger" data-action="delete"><i class="fas fa-trash"></i> 삭제</div>
</div>

<script src="./js/components/visual-editor.js?v=<?php echo time(); ?>"></script>
<script>
    visualEditor.init();

    // Listen for global project changes
    document.addEventListener('globalProjectChanged', function(e) {
        visualEditor.onProjectChange(e.detail.hmIdx);
    });

    // Auto-load after global projects are loaded
    document.addEventListener('globalProjectsLoaded', function() {
        var hmIdx = getGlobalProjectHmIdx();
        if (hmIdx) visualEditor.onProjectChange(hmIdx);
    });

    // Also try immediately (in case projects already loaded)
    (function() {
        var hmIdx = getGlobalProjectHmIdx();
        if (hmIdx) visualEditor.onProjectChange(hmIdx);
    })();
</script>
