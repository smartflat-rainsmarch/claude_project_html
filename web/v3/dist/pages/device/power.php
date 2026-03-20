<!-- SmartFlat CMS v3 - Power Settings (전원 설정) -->
<div class="page-header">
    <div class="page-header-left">
        <nav class="breadcrumb-nav">
            <a href="#" onclick="loadPage('dashboard')">홈</a>
            <span>/</span>
            <a href="#" onclick="loadPage('device')">기기</a>
            <span>/</span>
            <span class="active">전원 설정</span>
        </nav>
        <h2 class="page-title">전원 설정</h2>
    </div>
    <div class="page-header-right">
        <button class="btn btn-primary" onclick="powerPage.showAddSchedule()">
            <i class="fas fa-plus"></i> 전원 스케줄 추가
        </button>
    </div>
</div>

<!-- Quick Power Control -->
<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-bolt" style="color:var(--color-warning);"></i> 즉시 전원 제어</h3>
    </div>
    <div class="card-body">
        <div style="display:flex;gap:16px;align-items:center;flex-wrap:wrap;">
            <div style="display:flex;align-items:center;gap:8px;">
                <label style="font-weight:500;font-size:13px;">대상:</label>
                <select id="power-target-type" class="form-control" style="width:130px;" onchange="powerPage.onTargetTypeChange()">
                    <option value="all">전체 기기</option>
                    <option value="group">기기 그룹</option>
                    <option value="device">특정 기기</option>
                </select>
                <select id="power-target-id" class="form-control" style="width:200px;display:none;">
                    <option value="">선택하세요</option>
                </select>
            </div>
            <div style="display:flex;gap:8px;">
                <button class="btn btn-success" onclick="powerPage.sendPowerCommand('power_on')" style="min-width:120px;">
                    <i class="fas fa-power-off"></i> 전원 켜기
                </button>
                <button class="btn btn-danger" onclick="powerPage.sendPowerCommand('power_off')" style="min-width:120px;">
                    <i class="fas fa-power-off"></i> 전원 끄기
                </button>
                <button class="btn btn-light" onclick="powerPage.sendPowerCommand('reboot')" style="min-width:120px;">
                    <i class="fas fa-redo"></i> 재부팅
                </button>
                <button class="btn btn-light" onclick="powerPage.sendPowerCommand('restart_app')" style="min-width:120px;">
                    <i class="fas fa-sync-alt"></i> 앱 재시작
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Power Schedules -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-clock" style="color:var(--color-primary);"></i> 전원 스케줄</h3>
        <span style="font-size:12px;color:var(--text-muted);">설정된 시간에 자동으로 전원을 켜고 끕니다</span>
    </div>
    <div class="card-body" style="padding:0;">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width:50px">상태</th>
                    <th>이름</th>
                    <th style="width:100px">전원 켜기</th>
                    <th style="width:100px">전원 끄기</th>
                    <th style="width:140px">반복</th>
                    <th style="width:100px">대상</th>
                    <th style="width:120px">작업</th>
                </tr>
            </thead>
            <tbody id="power-schedule-tbody">
                <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);">로딩 중...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<style>
.schedule-toggle { position:relative; display:inline-block; width:40px; height:22px; }
.schedule-toggle input { opacity:0; width:0; height:0; }
.schedule-toggle .slider { position:absolute; cursor:pointer; inset:0; background:#ccc; border-radius:22px; transition:0.2s; }
.schedule-toggle .slider:before { content:""; position:absolute; width:18px; height:18px; left:2px; bottom:2px; background:white; border-radius:50%; transition:0.2s; }
.schedule-toggle input:checked + .slider { background:var(--color-success); }
.schedule-toggle input:checked + .slider:before { transform:translateX(18px); }

.day-chips { display:flex; gap:4px; }
.day-chip { width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:600; border:1px solid var(--border-color); background:var(--bg-card); color:var(--text-gray); cursor:pointer; transition:all 0.15s; }
.day-chip.active { background:var(--color-primary); color:white; border-color:var(--color-primary); }
.day-chip:hover { border-color:var(--color-primary); }

.time-input { width:80px; text-align:center; font-size:14px; font-weight:500; padding:6px 8px; border:1px solid var(--border-color); border-radius:var(--radius-sm); }
.time-input:focus { border-color:var(--color-primary); outline:none; }
</style>

<script>
var powerPage = {
    schedules: [],

    init: function() {
        this.loadSchedules();
        this.loadDevices();
    },

    loadSchedules: async function() {
        var tbody = document.getElementById('power-schedule-tbody');
        try {
            var res = await V3Api.get('/schedules?type=power');
            if (res.code === 100 && res.data) {
                this.schedules = Array.isArray(res.data) ? res.data : (res.data.items || []);
                this.renderSchedules();
            } else {
                this.schedules = [];
                this.renderSchedules();
            }
        } catch (err) {
            // API may not exist yet — show empty state
            this.schedules = [];
            this.renderSchedules();
        }
    },

    renderSchedules: function() {
        var tbody = document.getElementById('power-schedule-tbody');
        if (this.schedules.length === 0) {
            tbody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:40px;color:var(--text-muted);">' +
                '<i class="fas fa-clock" style="font-size:24px;display:block;margin-bottom:8px;"></i>' +
                '등록된 전원 스케줄이 없습니다.<br><small>상단의 "전원 스케줄 추가" 버튼으로 추가하세요.</small></td></tr>';
            return;
        }

        tbody.innerHTML = this.schedules.map(function(s, i) {
            var data = typeof s.schedule_data === 'string' ? JSON.parse(s.schedule_data) : (s.schedule_data || {});
            var dayLabels = { mon:'월', tue:'화', wed:'수', thu:'목', fri:'금', sat:'토', sun:'일' };
            var days = (data.days || []).map(function(d) { return dayLabels[d] || d; }).join(' ');
            var targetMap = { all:'전체', group:'그룹', device:'기기' };

            return '<tr>' +
                '<td><label class="schedule-toggle"><input type="checkbox" ' + (s.is_active ? 'checked' : '') +
                ' onchange="powerPage.toggleSchedule(' + s.id + ',this.checked)"><span class="slider"></span></label></td>' +
                '<td><strong>' + escapeHtml(s.name || '스케줄 ' + (i + 1)) + '</strong></td>' +
                '<td style="font-size:16px;font-weight:600;color:var(--color-success);">' + escapeHtml(data.power_on || '-') + '</td>' +
                '<td style="font-size:16px;font-weight:600;color:var(--color-danger);">' + escapeHtml(data.power_off || '-') + '</td>' +
                '<td style="font-size:12px;">' + escapeHtml(days || '매일') + '</td>' +
                '<td>' + (targetMap[s.target_type] || s.target_type || '전체') + '</td>' +
                '<td>' +
                '<button class="btn btn-sm btn-light" onclick="powerPage.editSchedule(' + i + ')"><i class="fas fa-edit"></i></button> ' +
                '<button class="btn btn-sm btn-light" style="color:var(--color-danger);" onclick="powerPage.deleteSchedule(' + s.id + ')"><i class="fas fa-trash"></i></button>' +
                '</td></tr>';
        }).join('');
    },

    loadDevices: async function() {
        try {
            var res = await V3Api.get('/devices');
            if (res.code === 100 && res.data) {
                var list = res.data.items || res.data;
                var select = document.getElementById('power-target-id');
                if (!select) return;
                if (Array.isArray(list)) {
                    list.forEach(function(d) {
                        var opt = document.createElement('option');
                        opt.value = d.id;
                        opt.textContent = d.name || d.device_name || d.device_key || d.id;
                        opt.dataset.type = 'device';
                        select.appendChild(opt);
                    });
                }
            }
        } catch (err) { /* ignore */ }
    },

    onTargetTypeChange: function() {
        var type = document.getElementById('power-target-type').value;
        var targetSelect = document.getElementById('power-target-id');
        if (targetSelect) targetSelect.style.display = (type === 'all') ? 'none' : 'block';
    },

    sendPowerCommand: async function(command) {
        var targetType = document.getElementById('power-target-type').value;
        var targetId = document.getElementById('power-target-id').value;
        var cmdLabels = { power_on:'전원 켜기', power_off:'전원 끄기', reboot:'재부팅', restart_app:'앱 재시작' };

        confirmMsg('"' + (cmdLabels[command] || command) + '" 명령을 전송하시겠습니까?', async function() {
            C_ShowLoadingProgress();
            try {
                if (targetType === 'all') {
                    // Send to all devices
                    var res = await V3Api.get('/devices');
                    var devices = (res.data && res.data.items) || res.data || [];
                    var count = 0;
                    for (var i = 0; i < devices.length; i++) {
                        try {
                            await V3Api.post('/devices/' + devices[i].id + '/command', { command: command });
                            count++;
                        } catch (e) { /* continue */ }
                    }
                    toastSuccess(count + '대 기기에 명령을 전송했습니다.');
                } else {
                    if (!targetId) { toastError('대상을 선택하세요.'); C_HideLoadingProgress(); return; }
                    var res = await V3Api.post('/devices/' + targetId + '/command', { command: command });
                    if (res.code === 100) toastSuccess('명령이 전송되었습니다.');
                    else toastError(res.message || '전송 실패');
                }
            } catch (err) {
                toastError('명령 전송에 실패했습니다.');
            } finally {
                C_HideLoadingProgress();
            }
        });
    },

    showAddSchedule: function() {
        this.showScheduleDialog(null);
    },

    editSchedule: function(idx) {
        this.showScheduleDialog(this.schedules[idx]);
    },

    showScheduleDialog: function(schedule) {
        var isEdit = !!schedule;
        var data = {};
        if (isEdit && schedule.schedule_data) {
            data = typeof schedule.schedule_data === 'string' ? JSON.parse(schedule.schedule_data) : schedule.schedule_data;
        }
        var activeDays = data.days || ['mon','tue','wed','thu','fri','sat','sun'];

        var dayButtons = [
            { key:'mon', label:'월' }, { key:'tue', label:'화' }, { key:'wed', label:'수' },
            { key:'thu', label:'목' }, { key:'fri', label:'금' }, { key:'sat', label:'토' }, { key:'sun', label:'일' }
        ].map(function(d) {
            var active = activeDays.indexOf(d.key) >= 0 ? ' active' : '';
            return '<div class="day-chip' + active + '" data-day="' + d.key + '" onclick="this.classList.toggle(\'active\')">' + d.label + '</div>';
        }).join('');

        var html = '<div style="display:grid;gap:16px;">' +
            '<div class="form-group"><label class="form-label">스케줄 이름</label>' +
            '<input class="form-control" id="sched-name" value="' + escapeHtml(schedule ? schedule.name || '' : '') + '" placeholder="예: 평일 전원 스케줄"></div>' +
            // Power on/off times
            '<div style="display:flex;gap:24px;align-items:flex-end;">' +
            '<div class="form-group" style="flex:1;text-align:center;">' +
            '<label class="form-label" style="color:var(--color-success);"><i class="fas fa-power-off"></i> 전원 켜기</label>' +
            '<input type="time" class="time-input" id="sched-on" value="' + escapeHtml(data.power_on || '08:00') + '" style="width:100%;font-size:18px;text-align:center;"></div>' +
            '<div class="form-group" style="flex:1;text-align:center;">' +
            '<label class="form-label" style="color:var(--color-danger);"><i class="fas fa-power-off"></i> 전원 끄기</label>' +
            '<input type="time" class="time-input" id="sched-off" value="' + escapeHtml(data.power_off || '22:00') + '" style="width:100%;font-size:18px;text-align:center;"></div>' +
            '</div>' +
            // Day selection
            '<div class="form-group"><label class="form-label">반복 요일</label>' +
            '<div class="day-chips" id="sched-days">' + dayButtons + '</div>' +
            '<div style="margin-top:6px;">' +
            '<button type="button" class="btn btn-sm btn-light" onclick="powerPage.selectDays(\'weekday\')">평일</button> ' +
            '<button type="button" class="btn btn-sm btn-light" onclick="powerPage.selectDays(\'weekend\')">주말</button> ' +
            '<button type="button" class="btn btn-sm btn-light" onclick="powerPage.selectDays(\'all\')">매일</button>' +
            '</div></div>' +
            // Target
            '<div style="display:flex;gap:8px;">' +
            '<div class="form-group" style="flex:1"><label class="form-label">대상</label>' +
            '<select class="form-control" id="sched-target-type">' +
            '<option value="all" ' + (!schedule || schedule.target_type === 'all' ? 'selected' : '') + '>전체 기기</option>' +
            '<option value="group" ' + (schedule && schedule.target_type === 'group' ? 'selected' : '') + '>기기 그룹</option>' +
            '<option value="device" ' + (schedule && schedule.target_type === 'device' ? 'selected' : '') + '>특정 기기</option>' +
            '</select></div>' +
            '<div class="form-group" style="flex:1"><label class="form-label">활성화</label>' +
            '<select class="form-control" id="sched-active">' +
            '<option value="1" ' + (!schedule || schedule.is_active ? 'selected' : '') + '>활성</option>' +
            '<option value="0" ' + (schedule && !schedule.is_active ? 'selected' : '') + '>비활성</option>' +
            '</select></div></div>' +
            '</div>';

        var self = this;
        var schedId = isEdit ? schedule.id : null;
        showModalDialog(document.body, isEdit ? '전원 스케줄 수정' : '전원 스케줄 추가', html, isEdit ? '수정' : '추가', '취소',
            function() { self.saveSchedule(schedId); hideModalDialog(); },
            function() { hideModalDialog(); },
            { size: { width: '500px' }, allowHtml: true }
        );
    },

    selectDays: function(preset) {
        var chips = document.querySelectorAll('#sched-days .day-chip');
        var weekdays = ['mon','tue','wed','thu','fri'];
        var weekends = ['sat','sun'];
        chips.forEach(function(chip) {
            var day = chip.dataset.day;
            if (preset === 'all') chip.classList.add('active');
            else if (preset === 'weekday') chip.classList.toggle('active', weekdays.indexOf(day) >= 0);
            else if (preset === 'weekend') chip.classList.toggle('active', weekends.indexOf(day) >= 0);
        });
    },

    saveSchedule: async function(schedId) {
        var name = document.getElementById('sched-name').value.trim();
        if (!name) { toastError('스케줄 이름을 입력하세요.'); return; }

        var days = [];
        document.querySelectorAll('#sched-days .day-chip.active').forEach(function(c) { days.push(c.dataset.day); });

        var payload = {
            name: name,
            schedule_type: 'power',
            is_active: parseInt(document.getElementById('sched-active').value),
            target_type: document.getElementById('sched-target-type').value,
            schedule_data: {
                power_on: document.getElementById('sched-on').value,
                power_off: document.getElementById('sched-off').value,
                days: days
            }
        };

        try {
            var res;
            if (schedId) {
                res = await V3Api.put('/schedules/' + schedId, payload);
            } else {
                res = await V3Api.post('/schedules', payload);
            }
            if (res.code === 100) {
                toastSuccess(schedId ? '수정되었습니다.' : '추가되었습니다.');
                this.loadSchedules();
            } else {
                toastError(res.message || '저장 실패');
            }
        } catch (err) {
            toastError('저장에 실패했습니다.');
        }
    },

    toggleSchedule: async function(id, active) {
        try {
            await V3Api.put('/schedules/' + id, { is_active: active ? 1 : 0 });
            toastSuccess(active ? '활성화' : '비활성화');
        } catch (err) {
            toastError('변경 실패');
        }
    },

    deleteSchedule: function(id) {
        confirmMsg('이 전원 스케줄을 삭제하시겠습니까?', async function() {
            try {
                var res = await V3Api.delete('/schedules/' + id);
                if (res.code === 100) {
                    toastSuccess('삭제되었습니다.');
                    powerPage.loadSchedules();
                } else {
                    toastError(res.message || '삭제 실패');
                }
            } catch (err) { toastError('삭제 실패'); }
        });
    }
};

powerPage.init();
</script>
