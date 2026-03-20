<!-- SmartFlat CMS v3 - Dashboard Page -->
<div class="page-header">
    <h1 class="page-title">대시보드</h1>
    <p class="page-description">SmartFlat CMS 운영 현황을 한눈에 확인하세요</p>
</div>

<!-- Stats Cards -->
<div class="stats-grid" style="grid-template-columns: repeat(1, 1fr);">
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon primary">
                    <i class="fas fa-folder-open"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-projects">-</div>
                    <div class="stats-label">전체 프로젝트</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Projects -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">프로젝트 목록</h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-light" onclick="loadPage('project')">
                전체보기 <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="table-container">
            <table class="table" id="recent-projects-table">
                <thead>
                    <tr>
                        <th>프로젝트명</th>
                        <th>해상도</th>
                        <th>수정일</th>
                        <th>방향</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 40px;">
                            <div class="spinner"></div>
                            <div style="margin-top: 8px; color: var(--text-muted);">로딩 중...</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">빠른 작업</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col col-md-4 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('project')">
                    <i class="fas fa-plus" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>프로젝트 관리</span>
                </button>
            </div>
            <div class="col col-md-4 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('channel')">
                    <i class="fas fa-desktop" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>화면 수정</span>
                </button>
            </div>
            <div class="col col-md-4 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('channel/editor')">
                    <i class="fas fa-paint-brush" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>비주얼 에디터</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    loadDashboardData();
})();

async function loadDashboardData() {
    try {
        var homesRes = await V3Api.get('/homes');
        if (homesRes.code === 100 && homesRes.data) {
            var projects = homesRes.data;
            document.getElementById('stat-projects').textContent = projects.length;
            renderRecentProjects(projects);
        }
    } catch (error) {
        cerror('Dashboard data load failed:', error);
    }
}

function renderRecentProjects(projects) {
    var tbody = document.querySelector('#recent-projects-table tbody');
    if (!projects || projects.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" style="text-align:center;padding:40px;color:var(--text-muted);"><i class="fas fa-folder-open" style="font-size:24px;margin-bottom:8px;display:block;"></i>등록된 프로젝트가 없습니다</td></tr>';
        return;
    }

    tbody.innerHTML = projects.map(function(p) {
        var name = p.hm_projectname || p.hm_projectid;
        var w = p.hm_width || (p.hm_orientation === 'L' ? 1920 : 1080);
        var h = p.hm_height || (p.hm_orientation === 'L' ? 1080 : 1920);
        var orientBadge = p.hm_orientation === 'L'
            ? '<span class="badge badge-info">가로</span>'
            : '<span class="badge badge-primary">세로</span>';

        return '<tr style="cursor:pointer;" onclick="loadPage(\'channel\')">' +
            '<td><strong>' + escapeHtml(name) + '</strong><br><span style="font-size:11px;color:var(--text-muted);">' + escapeHtml(p.hm_projectid) + '</span></td>' +
            '<td>' + w + '×' + h + '</td>' +
            '<td>' + (p.hm_date || '-') + '</td>' +
            '<td>' + orientBadge + '</td></tr>';
    }).join('');
}
</script>
