<!-- SmartFlat CMS v3 - Deployment Page -->
<div class="page-header">
    <div class="page-header-left">
        <h2 class="page-title">배포 관리</h2>
    </div>
    <div class="page-header-right">
        <button class="btn btn-primary" onclick="deployPage.showNewDeploy()">
            <i class="fas fa-paper-plane"></i> 새 배포
        </button>
    </div>
</div>

<!-- Filters -->
<div class="card" style="margin-bottom:16px;">
    <div class="card-body" style="padding:12px 20px;">
        <div style="display:flex;gap:12px;align-items:center;flex-wrap:wrap;">
            <select id="deploy-filter-status" class="form-control" style="width:150px;" onchange="deployPage.loadList()">
                <option value="">모든 상태</option>
                <option value="pending">대기</option>
                <option value="in_progress">진행중</option>
                <option value="completed">완료</option>
                <option value="failed">실패</option>
                <option value="cancelled">취소</option>
            </select>
            <input type="date" id="deploy-filter-from" class="form-control" style="width:160px;" onchange="deployPage.loadList()">
            <span style="color:var(--text-muted);">~</span>
            <input type="date" id="deploy-filter-to" class="form-control" style="width:160px;" onchange="deployPage.loadList()">
            <button class="btn btn-light" onclick="deployPage.loadList()"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>
</div>

<!-- Deployment List -->
<div class="card">
    <div class="card-body" style="padding:0;">
        <table class="data-table" id="deploy-table">
            <thead>
                <tr>
                    <th style="width:60px">#</th>
                    <th>프로젝트</th>
                    <th style="width:100px">타입</th>
                    <th style="width:100px">대상</th>
                    <th style="width:100px">상태</th>
                    <th style="width:160px">배포 시간</th>
                    <th style="width:80px">결과</th>
                    <th style="width:100px">작업</th>
                </tr>
            </thead>
            <tbody id="deploy-tbody">
                <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted);">로딩 중...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.status-badge { display:inline-block; padding:2px 10px; border-radius:12px; font-size:11px; font-weight:500; }
.status-badge.pending { background:#fff3e0; color:#e65100; }
.status-badge.in_progress { background:#e3f2fd; color:#1565c0; }
.status-badge.completed { background:#e8f5e9; color:#2e7d32; }
.status-badge.failed { background:#fce4ec; color:#c62828; }
.status-badge.cancelled { background:#f5f5f5; color:#757575; }
</style>

<script>
var deployPage = {
    init: function() { this.loadList(); },

    loadList: async function() {
        var tbody = document.getElementById('deploy-tbody');
        try {
            var params = {};
            var status = document.getElementById('deploy-filter-status').value;
            if (status) params.status = status;
            var from = document.getElementById('deploy-filter-from').value;
            if (from) params.date_from = from;
            var to = document.getElementById('deploy-filter-to').value;
            if (to) params.date_to = to;

            var qs = Object.keys(params).map(function(k) { return k + '=' + encodeURIComponent(params[k]); }).join('&');
            var res = await V3Api.get('/deployments' + (qs ? '?' + qs : ''));

            if (res.code === 100 && res.data && res.data.length > 0) {
                tbody.innerHTML = res.data.map(function(d, i) {
                    var statusMap = { pending:'대기', in_progress:'진행중', completed:'완료', failed:'실패', cancelled:'취소' };
                    var targetMap = { all:'전체', group:'그룹', device:'기기' };
                    return '<tr>' +
                        '<td>' + d.id + '</td>' +
                        '<td>' + escapeHtml(d.project_name || d.project_id || '-') + '</td>' +
                        '<td>' + escapeHtml(d.content_type || '-') + '</td>' +
                        '<td>' + (targetMap[d.target_type] || d.target_type || '-') + '</td>' +
                        '<td><span class="status-badge ' + (d.status || '') + '">' + (statusMap[d.status] || d.status) + '</span></td>' +
                        '<td>' + (d.deployed_at || d.created_at || '-') + '</td>' +
                        '<td>' + (d.success_count || 0) + '/' + (d.total_count || 0) + '</td>' +
                        '<td>' +
                            (d.status === 'failed' ? '<button class="btn btn-sm btn-light" data-action="retry" data-id="' + parseInt(d.id) + '">재시도</button> ' : '') +
                            (d.status === 'pending' || d.status === 'in_progress' ? '<button class="btn btn-sm btn-light" data-action="cancel" data-id="' + parseInt(d.id) + '">취소</button>' : '') +
                        '</td></tr>';
                }).join('');
            } else {
                tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted);">배포 기록이 없습니다.</td></tr>';
            }
        } catch (err) {
            cerror('Failed to load deployments:', err);
            tbody.innerHTML = '<tr><td colspan="8" style="text-align:center;padding:40px;color:var(--text-muted);">데이터를 불러오는데 실패했습니다.</td></tr>';
        }
    },

    showNewDeploy: function() {
        var html = '<div style="display:grid;gap:12px;">' +
            '<div class="form-group"><label class="form-label">프로젝트 ID</label>' +
            '<input class="form-control" id="deploy-project-id" placeholder="프로젝트 ID"></div>' +
            '<div class="form-group"><label class="form-label">대상 타입</label>' +
            '<select class="form-control" id="deploy-target-type">' +
            '<option value="all">전체 기기</option><option value="group">기기 그룹</option><option value="device">특정 기기</option></select></div>' +
            '<div class="form-group"><label class="form-label">대상 ID (그룹/기기 선택시)</label>' +
            '<input class="form-control" id="deploy-target-id" placeholder="그룹 또는 기기 ID"></div>' +
            '<div class="form-group"><label class="form-label">설명</label>' +
            '<textarea class="form-control" id="deploy-description" rows="2" placeholder="배포 설명 (선택)"></textarea></div>' +
            '</div>';

        showModalDialog(document.body, '새 배포', html, '배포 실행', '취소',
            function() { deployPage.executeDeploy(); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );
    },

    executeDeploy: async function() {
        var data = {
            project_id: document.getElementById('deploy-project-id').value,
            target_type: document.getElementById('deploy-target-type').value,
            target_id: document.getElementById('deploy-target-id').value || null,
            description: document.getElementById('deploy-description').value
        };
        if (!data.project_id) { toastError('프로젝트 ID를 입력하세요.'); return; }

        try {
            var res = await V3Api.post('/deployments', data);
            if (res.code === 100) {
                toastSuccess('배포가 시작되었습니다.');
                this.loadList();
            } else {
                toastError(res.message || '배포 실패');
            }
        } catch (err) {
            cerror('Deploy failed:', err);
            toastError('배포에 실패했습니다.');
        }
    },

    retry: async function(id) {
        try {
            var res = await V3Api.post('/deployments/' + id + '/retry', {});
            if (res.code === 100) { toastSuccess('재시도 중...'); this.loadList(); }
        } catch (err) { toastError('재시도 실패'); }
    },

    cancel: async function(id) {
        confirmMsg('배포를 취소하시겠습니까?', async function() {
            try {
                var res = await V3Api.post('/deployments/' + id + '/cancel', {});
                if (res.code === 100) { toastSuccess('취소되었습니다.'); deployPage.loadList(); }
            } catch (err) { toastError('취소 실패'); }
        });
    }
};

deployPage.init();

// Event delegation for action buttons
var deployTbody = document.getElementById('deploy-tbody');
if (deployTbody) {
    deployTbody.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-action]');
        if (!btn) return;
        var action = btn.dataset.action;
        var id = parseInt(btn.dataset.id);
        if (isNaN(id)) return;
        if (action === 'retry') deployPage.retry(id);
        if (action === 'cancel') deployPage.cancel(id);
    });
}
</script>
