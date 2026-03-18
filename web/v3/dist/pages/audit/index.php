<!-- SmartFlat CMS v3 - Audit Log Page -->
<div class="page-header">
    <div class="page-header-left">
        <h2 class="page-title">감사 로그</h2>
    </div>
    <div class="page-header-right">
        <button class="btn btn-light" onclick="auditPage.exportCsv()"><i class="fas fa-download"></i> CSV 내보내기</button>
    </div>
</div>

<!-- Filters -->
<div class="card" style="margin-bottom:16px;">
    <div class="card-body" style="padding:12px 20px;">
        <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
            <select id="audit-filter-action" class="form-control" style="width:140px;" onchange="auditPage.loadLogs()">
                <option value="">모든 액션</option>
                <option value="create">생성</option>
                <option value="update">수정</option>
                <option value="delete">삭제</option>
                <option value="login">로그인</option>
                <option value="deploy">배포</option>
            </select>
            <select id="audit-filter-target" class="form-control" style="width:140px;" onchange="auditPage.loadLogs()">
                <option value="">모든 대상</option>
                <option value="project">프로젝트</option>
                <option value="content">콘텐츠</option>
                <option value="device">기기</option>
                <option value="deployment">배포</option>
                <option value="home">화면</option>
            </select>
            <input type="date" id="audit-filter-from" class="form-control" style="width:160px;" onchange="auditPage.loadLogs()">
            <span style="color:var(--text-muted);">~</span>
            <input type="date" id="audit-filter-to" class="form-control" style="width:160px;" onchange="auditPage.loadLogs()">
            <input type="text" id="audit-search" class="form-control" style="width:200px;" placeholder="검색..." onkeyup="auditPage.debounceSearch()">
        </div>
    </div>
</div>

<!-- Log Table -->
<div class="card">
    <div class="card-body" style="padding:0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:160px">시간</th>
                    <th style="width:120px">사용자</th>
                    <th style="width:80px">액션</th>
                    <th style="width:100px">대상 타입</th>
                    <th>설명</th>
                    <th style="width:120px">IP</th>
                </tr>
            </thead>
            <tbody id="audit-tbody">
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">로딩 중...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
<div style="display:flex;justify-content:center;padding:16px;" id="audit-pagination"></div>

<style>
.action-badge { display:inline-block; padding:2px 10px; border-radius:4px; font-size:11px; font-weight:500; }
.action-badge.create { background:#e8f5e9; color:#2e7d32; }
.action-badge.update { background:#e3f2fd; color:#1565c0; }
.action-badge.delete { background:#fce4ec; color:#c62828; }
.action-badge.login { background:#f3e5f5; color:#6a1b9a; }
.action-badge.deploy { background:#fff3e0; color:#e65100; }
</style>

<script>
var auditPage = {
    page: 1,
    perPage: 30,
    searchTimer: null,

    init: function() { this.loadLogs(); },

    debounceSearch: function() {
        if (this.searchTimer) clearTimeout(this.searchTimer);
        var self = this;
        this.searchTimer = setTimeout(function() { self.loadLogs(); }, 300);
    },

    loadLogs: async function() {
        var tbody = document.getElementById('audit-tbody');
        try {
            var params = { page: this.page, per_page: this.perPage };
            var action = document.getElementById('audit-filter-action').value;
            if (action) params.action = action;
            var target = document.getElementById('audit-filter-target').value;
            if (target) params.target_type = target;
            var from = document.getElementById('audit-filter-from').value;
            if (from) params.date_from = from;
            var to = document.getElementById('audit-filter-to').value;
            if (to) params.date_to = to;
            var search = document.getElementById('audit-search').value;
            if (search) params.search = search;

            var qs = Object.keys(params).map(function(k) { return k + '=' + encodeURIComponent(params[k]); }).join('&');
            var res = await V3Api.get('/audit-logs?' + qs);

            if (res.code === 100 && res.data) {
                var logs = res.data.items || res.data;
                var list = Array.isArray(logs) ? logs : [];

                if (list.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">로그가 없습니다.</td></tr>';
                    return;
                }

                var actionLabels = { create:'생성', update:'수정', delete:'삭제', login:'로그인', deploy:'배포', logout:'로그아웃' };

                tbody.innerHTML = list.map(function(log) {
                    return '<tr>' +
                        '<td style="font-size:12px;">' + escapeHtml(log.created_at || '-') + '</td>' +
                        '<td>' + escapeHtml(log.user_name || log.username || '-') + '</td>' +
                        '<td><span class="action-badge ' + escapeHtml(log.action || '') + '">' + escapeHtml(actionLabels[log.action] || log.action || '-') + '</span></td>' +
                        '<td>' + escapeHtml(log.target_type || '-') + '</td>' +
                        '<td style="font-size:12px;">' + escapeHtml(log.description || log.details || '-') + '</td>' +
                        '<td style="font-family:monospace;font-size:11px;">' + escapeHtml(log.ip_address || '-') + '</td>' +
                        '</tr>';
                }).join('');

                // Pagination
                var totalPages = res.data.total_pages || Math.ceil((res.data.total || list.length) / this.perPage);
                this.renderPagination(totalPages);
            }
        } catch (err) {
            cerror('Failed to load audit logs:', err);
            tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">데이터를 불러오는데 실패했습니다.</td></tr>';
        }
    },

    renderPagination: function(totalPages) {
        var container = document.getElementById('audit-pagination');
        if (totalPages <= 1) { container.innerHTML = ''; return; }

        var self = this;
        var html = '';
        for (var i = 1; i <= Math.min(totalPages, 10); i++) {
            var active = i === this.page ? 'background:var(--color-primary);color:white;' : '';
            html += '<button class="btn btn-sm btn-light" style="margin:0 2px;' + active + '" onclick="auditPage.goPage(' + i + ')">' + i + '</button>';
        }
        container.innerHTML = html;
    },

    goPage: function(p) {
        this.page = p;
        this.loadLogs();
    },

    exportCsv: function() {
        toastSuccess('CSV 내보내기 기능은 준비 중입니다.');
    }
};

auditPage.init();
</script>
