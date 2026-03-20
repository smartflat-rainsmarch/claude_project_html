<!-- SmartFlat CMS v3 - Project Management Page -->
<?php
require_once(__DIR__ . '/../../components/breadcrumb.php');
require_once(__DIR__ . '/../../components/status-badge.php');
require_once(__DIR__ . '/../../components/filter-panel.php');
?>

<?php
renderPageHeader('프로젝트 관리', [
    ['label' => '홈', 'link' => 'dashboard'],
    ['label' => '프로젝트 관리']
], '프로젝트를 생성하고 관리합니다', [
    [
        'label' => '새 프로젝트',
        'icon' => 'fa-plus',
        'class' => 'btn btn-primary',
        'onclick' => 'showProjectForm()'
    ]
]);
?>

<!-- Filter Panel -->
<div class="card" style="margin-bottom: 16px;">
    <div class="card-body" style="padding: 12px 16px;">
        <div style="display:flex;gap:8px;align-items:center;">
            <input type="text" class="form-control form-control-sm" id="filter-search"
                   placeholder="프로젝트명 검색..." onkeyup="debounceSearch(this.value)" style="max-width:300px;">
            <button class="btn btn-primary btn-sm" onclick="applyProjectFilters()">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>

<!-- Project Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">프로젝트 목록</h3>
        <div class="card-toolbar">
            <span id="project-count" class="badge badge-secondary" style="margin-right: 8px;">0</span>
            <button class="btn btn-light btn-sm" onclick="loadProjectList()">
                <i class="fas fa-sync"></i> 새로고침
            </button>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <table class="table" id="project-table">
            <thead>
                <tr>
                    <th>프로젝트명</th>
                    <th style="width:100px;">방향</th>
                    <th style="width:120px;">해상도</th>
                    <th style="width:80px;">언어</th>
                    <th style="width:100px;">지역</th>
                    <th style="width:130px;">수정일</th>
                    <th style="width:120px;">관리</th>
                </tr>
            </thead>
            <tbody id="project-tbody">
                <tr>
                    <td colspan="7" class="table-loading">
                        <div class="spinner"></div>
                        <div class="loading-text">데이터 로딩 중...</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Project Form Modal Template -->
<div id="project-form-template" style="display: none;">
    <form id="project-form" onsubmit="return saveProject(event)">
        <input type="hidden" id="project-id" name="id">

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">프로젝트 키 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="project-key" name="project_key"
                           placeholder="영문, 숫자, 언더스코어만" pattern="[a-zA-Z0-9_-]+" required>
                    <small class="form-text text-muted">고유 식별자 (영문/숫자만)</small>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">프로젝트명 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="project-name" name="name" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">설명</label>
            <textarea class="form-control" id="project-description" name="description" rows="2"></textarea>
        </div>

        <div class="row">
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">카테고리</label>
                    <select class="form-control" id="project-category" name="category">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">지역</label>
                    <select class="form-control" id="project-region" name="region">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">상태</label>
                    <select class="form-control" id="project-status" name="status">
                        <option value="active">운영중</option>
                        <option value="paused">일시정지</option>
                        <option value="archived">보관</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">화면 방향</label>
                    <select class="form-control" id="project-orientation" name="orientation">
                        <option value="P">세로 (Portrait)</option>
                        <option value="L">가로 (Landscape)</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">가로 픽셀</label>
                    <input type="number" class="form-control" id="project-width" name="width" value="1080">
                </div>
            </div>
            <div class="col col-md-4">
                <div class="form-group">
                    <label class="form-label">세로 픽셀</label>
                    <input type="number" class="form-control" id="project-height" name="height" value="1920">
                </div>
            </div>
        </div>
    </form>
</div>

<script>
/**
 * Project List Page — tb_home 기반
 */

// Use var to allow re-declaration when page is reloaded via jQuery .load()
var allProjects = [];
var searchDebounceTimer = null;

(function() {
    loadProjectList();
})();

/**
 * Load projects from /homes API (tb_home)
 */
async function loadProjectList() {
    try {
        const res = await V3Api.get('/homes');
        if (res.code === 100 && res.data) {
            allProjects = res.data;
            renderProjectTable(allProjects);
        }
    } catch (err) {
        cerror('Failed to load projects:', err);
        document.getElementById('project-tbody').innerHTML =
            '<tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);">프로젝트를 불러오는데 실패했습니다.</td></tr>';
    }
}

/**
 * Render project table from tb_home data
 */
function renderProjectTable(projects) {
    const tbody = document.getElementById('project-tbody');
    document.getElementById('project-count').textContent = projects.length;

    if (projects.length === 0) {
        tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);"><i class="fas fa-folder-open" style="font-size:24px;display:block;margin-bottom:8px;"></i>등록된 프로젝트가 없습니다</td></tr>';
        return;
    }

    const langMap = { KO: '한국어', EN: 'English', ZH: '中文', VI: 'Tiếng Việt', MS: 'Bahasa' };

    tbody.innerHTML = projects.map(p => {
        const name = p.hm_projectname || p.hm_projectid;
        const orient = p.hm_orientation === 'L'
            ? '<span class="badge badge-info">가로</span>'
            : '<span class="badge badge-primary">세로</span>';
        const w = p.hm_width || (p.hm_orientation === 'L' ? 1920 : 1080);
        const h = p.hm_height || (p.hm_orientation === 'L' ? 1080 : 1920);
        const lang = langMap[p.hm_language] || p.hm_language || 'KO';
        const region = p.hm_region || '-';
        const date = p.hm_date ? new Date(p.hm_date).toLocaleDateString('ko-KR') : '-';

        return `<tr>
            <td>
                <strong>${escapeHtml(name)}</strong><br>
                <small style="color:var(--text-muted);">${escapeHtml(p.hm_projectid)}</small>
            </td>
            <td>${orient}</td>
            <td>${w} × ${h}</td>
            <td>${escapeHtml(lang)}</td>
            <td>${escapeHtml(region)}</td>
            <td>${escapeHtml(date)}</td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary" onclick="goToChannelEditor(${p.hm_idx})" title="화면 수정">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm btn-light" onclick="showProjectInfo(${p.hm_idx})" title="상세정보">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

/**
 * Navigate to channel editor with project selected
 */
function goToChannelEditor(hmIdx) {
    // Set global project selector and navigate
    var globalSel = document.getElementById('global-project-select');
    if (globalSel) {
        globalSel.value = hmIdx;
        onGlobalProjectChange(hmIdx);
    }
    loadPage('channel');
}

/**
 * Show project info modal
 */
async function showProjectInfo(hmIdx) {
    C_ShowLoadingProgress();
    try {
        const res = await V3Api.get('/homes/' + hmIdx);
        C_HideLoadingProgress();
        if (res.code === 100 && res.data) {
            const d = res.data;
            const w = d.hm_width || (d.hm_orientation === 'L' ? 1920 : 1080);
            const h = d.hm_height || (d.hm_orientation === 'L' ? 1080 : 1920);
            const html = `<table class="table" style="font-size:14px;">
                <tr><td style="font-weight:500;width:120px;">프로젝트 ID</td><td>${escapeHtml(d.hm_projectid)}</td></tr>
                <tr><td style="font-weight:500;">프로젝트명</td><td>${escapeHtml(d.hm_projectname || '-')}</td></tr>
                <tr><td style="font-weight:500;">방향</td><td>${d.hm_orientation === 'L' ? '가로 (Landscape)' : '세로 (Portrait)'}</td></tr>
                <tr><td style="font-weight:500;">해상도</td><td>${w} × ${h}</td></tr>
                <tr><td style="font-weight:500;">언어</td><td>${escapeHtml(d.hm_language || 'KO')}</td></tr>
                <tr><td style="font-weight:500;">지역</td><td>${escapeHtml(d.hm_region || '-')}</td></tr>
                <tr><td style="font-weight:500;">홈화면 요소</td><td>${(d.home_data || []).length}개</td></tr>
                <tr><td style="font-weight:500;">메인화면 요소</td><td>${(d.main_data || []).length}개</td></tr>
                <tr><td style="font-weight:500;">콘텐츠</td><td>${(d.content_data || []).length}개</td></tr>
                <tr><td style="font-weight:500;">수정일</td><td>${escapeHtml(d.hm_date || '-')}</td></tr>
            </table>`;
            showModalDialog(document.body, d.hm_projectname || d.hm_projectid, html, '화면 수정', '닫기',
                function() { hideModalDialog(); goToChannelEditor(hmIdx); },
                function() { hideModalDialog(); },
                { size: { width: '500px' }, allowHtml: true }
            );
        }
    } catch (err) {
        C_HideLoadingProgress();
        cerror('Failed to load project info:', err);
    }
}

/**
 * Filter projects by search text
 */
function applyProjectFilters() {
    const search = (document.getElementById('filter-search')?.value || '').toLowerCase();
    const region = document.getElementById('filter-region')?.value || '';

    const filtered = allProjects.filter(p => {
        const name = (p.hm_projectname || p.hm_projectid || '').toLowerCase();
        const pid = (p.hm_projectid || '').toLowerCase();
        const matchSearch = !search || name.includes(search) || pid.includes(search);
        const matchRegion = !region || p.hm_region === region;
        return matchSearch && matchRegion;
    });

    renderProjectTable(filtered);
}

function debounceSearch(value) {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => applyProjectFilters(), 300);
}

function showProjectForm() {
    toastWarning('새 프로젝트 생성은 준비 중입니다.');
}
</script>
