<!-- SmartFlat CMS v3 - Monitoring Page -->
<div class="page-header">
    <div class="page-header-left">
        <h2 class="page-title">모니터링</h2>
    </div>
    <div class="page-header-right">
        <button class="btn btn-light" onclick="monitorPage.refresh()"><i class="fas fa-sync-alt"></i> 새로고침</button>
    </div>
</div>

<!-- Stats Cards -->
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:20px;" id="monitor-stats">
    <div class="card"><div class="card-body" style="text-align:center;padding:20px;">
        <div style="font-size:32px;font-weight:700;color:var(--color-success);" id="stat-online">-</div>
        <div style="font-size:13px;color:var(--text-gray);margin-top:4px;">온라인</div>
    </div></div>
    <div class="card"><div class="card-body" style="text-align:center;padding:20px;">
        <div style="font-size:32px;font-weight:700;color:var(--color-danger);" id="stat-offline">-</div>
        <div style="font-size:13px;color:var(--text-gray);margin-top:4px;">오프라인</div>
    </div></div>
    <div class="card"><div class="card-body" style="text-align:center;padding:20px;">
        <div style="font-size:32px;font-weight:700;color:var(--color-warning);" id="stat-warning">-</div>
        <div style="font-size:13px;color:var(--text-gray);margin-top:4px;">경고</div>
    </div></div>
    <div class="card"><div class="card-body" style="text-align:center;padding:20px;">
        <div style="font-size:32px;font-weight:700;color:var(--text-dark);" id="stat-total">-</div>
        <div style="font-size:13px;color:var(--text-gray);margin-top:4px;">전체</div>
    </div></div>
</div>

<!-- Device Status Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">기기 상태</h3>
        <div style="display:flex;gap:8px;">
            <select id="monitor-filter-status" class="form-control" style="width:130px;font-size:13px;" onchange="monitorPage.loadDevices()">
                <option value="">모든 상태</option>
                <option value="online">온라인</option>
                <option value="offline">오프라인</option>
                <option value="warning">경고</option>
            </select>
            <input type="text" id="monitor-search" class="form-control" style="width:200px;font-size:13px;" placeholder="기기 검색..." onkeyup="monitorPage.loadDevices()">
        </div>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>기기명</th>
                    <th style="width:120px">프로젝트</th>
                    <th style="width:100px">상태</th>
                    <th style="width:130px">IP 주소</th>
                    <th style="width:160px">마지막 연결</th>
                    <th style="width:100px">작업</th>
                </tr>
            </thead>
            <tbody id="monitor-tbody">
                <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">로딩 중...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.status-dot { display:inline-block; width:8px; height:8px; border-radius:50%; margin-right:6px; }
.status-dot.online { background:var(--color-success); }
.status-dot.offline { background:var(--color-danger); }
.status-dot.warning { background:var(--color-warning); }
</style>

<script>
var monitorPage = {
    devices: [],
    autoRefreshTimer: null,

    init: function() {
        this.cleanup();
        this.loadDevices();
        // Auto-refresh every 30 seconds
        var self = this;
        this.autoRefreshTimer = setInterval(function() { self.loadDevices(); }, 30000);
    },

    cleanup: function() {
        if (this.autoRefreshTimer) {
            clearInterval(this.autoRefreshTimer);
            this.autoRefreshTimer = null;
        }
    },

    refresh: function() { this.loadDevices(); },

    loadDevices: async function() {
        try {
            var params = {};
            var status = document.getElementById('monitor-filter-status').value;
            if (status) params.status = status;
            var search = document.getElementById('monitor-search').value;
            if (search) params.search = search;

            var qs = Object.keys(params).map(function(k) { return k + '=' + encodeURIComponent(params[k]); }).join('&');
            var res = await V3Api.get('/devices' + (qs ? '?' + qs : ''));

            if (res.code === 100 && res.data) {
                this.devices = res.data.items || res.data;
                var list = Array.isArray(this.devices) ? this.devices : [];

                // Update stats
                var online = list.filter(function(d) { return d.status === 'online'; }).length;
                var offline = list.filter(function(d) { return d.status === 'offline'; }).length;
                var warning = list.filter(function(d) { return d.status === 'warning'; }).length;
                document.getElementById('stat-online').textContent = online;
                document.getElementById('stat-offline').textContent = offline;
                document.getElementById('stat-warning').textContent = warning;
                document.getElementById('stat-total').textContent = list.length;

                var tbody = document.getElementById('monitor-tbody');
                if (list.length === 0) {
                    tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;padding:40px;color:var(--text-muted);">등록된 기기가 없습니다.</td></tr>';
                    return;
                }

                tbody.innerHTML = list.map(function(d) {
                    var statusLabel = { online:'온라인', offline:'오프라인', warning:'경고' };
                    return '<tr>' +
                        '<td><strong>' + escapeHtml(d.name || d.device_name || '-') + '</strong><br><span style="font-size:11px;color:var(--text-muted);">' + escapeHtml(d.device_key || '') + '</span></td>' +
                        '<td>' + escapeHtml(d.project_id || d.project_name || '-') + '</td>' +
                        '<td><span class="status-dot ' + (d.status || 'offline') + '"></span>' + (statusLabel[d.status] || d.status || '오프라인') + '</td>' +
                        '<td style="font-family:monospace;font-size:12px;">' + escapeHtml(d.ip_address || d.last_ip || '-') + '</td>' +
                        '<td style="font-size:12px;">' + (d.last_heartbeat || d.last_connection || '-') + '</td>' +
                        '<td><button class="btn btn-sm btn-light" data-action="command" data-id="' + parseInt(d.id) + '" data-name="' + escapeHtml(d.name || '') + '"><i class="fas fa-terminal"></i></button></td>' +
                        '</tr>';
                }).join('');
            }
        } catch (err) {
            cerror('Failed to load devices:', err);
        }
    },

    sendCommand: function(deviceId, deviceName) {
        var commands = [
            { value:'reload', label:'화면 새로고침' },
            { value:'restart', label:'앱 재시작' },
            { value:'screenshot', label:'스크린샷' },
            { value:'update', label:'업데이트 확인' },
            { value:'clear_cache', label:'캐시 삭제' },
            { value:'reboot', label:'기기 재부팅' }
        ];
        var opts = commands.map(function(c) { return '<option value="' + c.value + '">' + c.label + '</option>'; }).join('');

        var html = '<div class="form-group"><label class="form-label">명령어</label>' +
            '<select class="form-control" id="cmd-type">' + opts + '</select></div>';

        showModalDialog(document.body, '명령 전송: ' + deviceName, html, '전송', '취소',
            async function() {
                var cmd = document.getElementById('cmd-type').value;
                try {
                    var res = await V3Api.post('/devices/' + deviceId + '/command', { command: cmd });
                    if (res.code === 100) toastSuccess('명령이 전송되었습니다.');
                    else toastError(res.message || '전송 실패');
                } catch (err) { toastError('명령 전송 실패'); }
                hideModalDialog();
            },
            function() { hideModalDialog(); },
            { size: { width: '400px' }, allowHtml: true }
        );
    }
};

monitorPage.init();

// Cleanup timer when navigating away
document.addEventListener('pageLoaded', function() {
    monitorPage.cleanup();
});

// Event delegation for command buttons
var monitorTbody = document.getElementById('monitor-tbody');
if (monitorTbody) {
    monitorTbody.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-action="command"]');
        if (!btn) return;
        var id = parseInt(btn.dataset.id);
        if (isNaN(id)) return;
        monitorPage.sendCommand(id, btn.dataset.name || '');
    });
}
</script>
