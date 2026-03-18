<!-- SmartFlat CMS v3 - Version Management Page -->
<div class="page-header">
    <div class="page-header-left">
        <h2 class="page-title">버전 관리</h2>
    </div>
</div>

<!-- Current Version Info -->
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:20px;">
    <div class="card"><div class="card-body" style="padding:16px;">
        <div style="font-size:12px;color:var(--text-muted);margin-bottom:4px;">CMS 버전</div>
        <div style="font-size:18px;font-weight:600;">v<?php echo CMS_VERSION ?? '3.0.0'; ?></div>
    </div></div>
    <div class="card"><div class="card-body" style="padding:16px;">
        <div style="font-size:12px;color:var(--text-muted);margin-bottom:4px;">서버</div>
        <div style="font-size:18px;font-weight:600;">PHP <?php echo phpversion(); ?></div>
    </div></div>
    <div class="card"><div class="card-body" style="padding:16px;">
        <div style="font-size:12px;color:var(--text-muted);margin-bottom:4px;">데이터베이스</div>
        <div style="font-size:18px;font-weight:600;">MariaDB</div>
    </div></div>
</div>

<!-- Content Versions -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">콘텐츠 버전 이력</h3>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>프로젝트</th>
                    <th style="width:80px">버전</th>
                    <th style="width:120px">타입</th>
                    <th style="width:160px">수정 시간</th>
                    <th style="width:120px">수정자</th>
                </tr>
            </thead>
            <tbody id="version-tbody">
                <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);">로딩 중...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<script>
(async function() {
    var tbody = document.getElementById('version-tbody');
    try {
        var res = await V3Api.get('/contents?per_page=20');
        if (res.code === 100 && res.data) {
            var items = res.data.items || res.data;
            var list = Array.isArray(items) ? items : [];
            if (list.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);">콘텐츠가 없습니다.</td></tr>';
                return;
            }
            tbody.innerHTML = list.map(function(c) {
                return '<tr>' +
                    '<td><strong>' + escapeHtml(c.name || c.project_id || '-') + '</strong></td>' +
                    '<td>v' + (c.current_version || c.version || 1) + '</td>' +
                    '<td>' + escapeHtml(c.type || '-') + '</td>' +
                    '<td style="font-size:12px;">' + (c.updated_at || c.created_at || '-') + '</td>' +
                    '<td>' + escapeHtml(c.updated_by || '-') + '</td>' +
                    '</tr>';
            }).join('');
        }
    } catch (err) {
        cerror('Failed to load versions:', err);
        tbody.innerHTML = '<tr><td colspan="5" style="text-align:center;padding:40px;color:var(--text-muted);">데이터를 불러오는데 실패했습니다.</td></tr>';
    }
})();
</script>
