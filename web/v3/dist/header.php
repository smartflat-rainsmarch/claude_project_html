<!-- SmartFlat CMS v3 - Header Component -->
<header class="app-header">
    <!-- Left Section -->
    <div class="header-left">
        <!-- Sidebar Toggle -->
        <button class="sidebar-toggle" onclick="V3App.toggleSidebar()" title="사이드바 토글">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Breadcrumb -->
        <nav class="header-breadcrumb">
            <a href="#" class="breadcrumb-item" onclick="loadPage('dashboard')">홈</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-item active">대시보드</span>
        </nav>
    </div>

    <!-- Center: Global Project Selector -->
    <div class="header-center" style="display:flex; align-items:center; gap:8px; margin-left:16px; flex:1;">
        <i class="fas fa-folder-open" style="color:var(--text-muted); font-size:13px;"></i>
        <select id="global-project-select" class="form-control" style="width:260px; font-size:13px; height:34px; border-radius:6px;" onchange="onGlobalProjectChange(this.value)">
            <option value="">프로젝트를 선택하세요</option>
        </select>
        <span id="global-project-info" style="font-size:12px; color:var(--text-muted); display:none;">
            <span id="global-project-badge" class="badge badge-secondary" style="font-size:11px;"></span>
            <span id="global-project-resolution" style="margin-left:6px;"></span>
        </span>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <!-- Power Settings -->
        <div class="header-toolbar-item">
            <button class="toolbar-btn" onclick="showPowerControlPopup()" title="전원 설정">
                <i class="fas fa-power-off" style="color:var(--color-danger);"></i>
            </button>
        </div>

        <!-- Add Project -->
        <div class="header-toolbar-item">
            <button class="toolbar-btn" onclick="showAddProjectModal()" title="새 프로젝트 추가">
                <i class="fas fa-plus"></i>
            </button>
        </div>

        <!-- Search -->
        <div class="header-toolbar-item d-none d-md-block">
            <button class="toolbar-btn" onclick="openQuickSearch()" title="검색 (Ctrl+K)">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Notifications -->
        <div class="header-toolbar-item">
            <button class="toolbar-btn" onclick="toggleDropdown(this)" title="알림">
                <i class="fas fa-bell"></i>
                <span class="toolbar-badge" id="notification-count" style="display: none;">0</span>
            </button>
            <div class="dropdown-menu" style="width: 320px;">
                <div style="padding: 12px 16px; border-bottom: 1px solid var(--border-color);">
                    <strong>알림</strong>
                </div>
                <div id="notification-list" style="max-height: 300px; overflow-y: auto;">
                    <div class="empty-state" style="padding: 24px;">
                        <i class="fas fa-bell-slash" style="font-size: 24px; color: var(--text-muted);"></i>
                        <p style="margin-top: 8px; color: var(--text-muted); font-size: 13px;">새로운 알림이 없습니다</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Menu -->
        <div class="header-toolbar-item dropdown">
            <div class="user-menu" onclick="toggleDropdown(this)">
                <div class="user-avatar">
                    <?php echo safe_mb_substr($usernamedesc ?? 'U', 0, 1); ?>
                </div>
                <div class="user-info d-none d-lg-block">
                    <span class="user-name"><?php echo htmlspecialchars($usernamedesc ?? ''); ?></span>
                    <span class="user-role">
                        <?php
                        $roleNames = [
                            AUTH_SYSTEMOWNER => '시스템 관리자',
                            AUTH_OWNER => '운영자',
                            AUTH_OPERATOR => '점장',
                            AUTH_MANAGER => '관리자',
                            AUTH_TRANER => '트레이너',
                            AUTH_CUSTOMER => '고객'
                        ];
                        echo $roleNames[$auth] ?? '사용자';
                        ?>
                    </span>
                </div>
                <i class="fas fa-chevron-down d-none d-lg-block" style="margin-left: 8px; font-size: 10px; color: var(--text-muted);"></i>
            </div>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#" onclick="loadPage('settings')">
                    <i class="fas fa-cog"></i>
                    <span>설정</span>
                </a>
                <a class="dropdown-item" href="#" onclick="showProfile()">
                    <i class="fas fa-user"></i>
                    <span>프로필</span>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" onclick="logout()">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>로그아웃</span>
                </a>
            </div>
        </div>
    </div>
</header>

<script>
/**
 * Global Project Selector
 */
var globalProjectData = []; // cached project list

async function loadGlobalProjects() {
    var select = document.getElementById('global-project-select');
    if (!select || select.options.length > 1) return; // already loaded

    try {
        var res = await V3Api.get('/homes');
        if (res.code === 100 && res.data) {
            globalProjectData = res.data;
            res.data.forEach(function(home) {
                var opt = document.createElement('option');
                opt.value = home.hm_idx;
                opt.textContent = home.hm_projectname
                    ? home.hm_projectname + ' (' + home.hm_projectid + ')'
                    : home.hm_projectid;
                opt.dataset.projectId = home.hm_projectid;
                opt.dataset.orientation = home.hm_orientation || 'P';
                opt.dataset.width = home.hm_width || '';
                opt.dataset.height = home.hm_height || '';
                opt.dataset.language = home.hm_language || 'KO';
                opt.dataset.allLanguage = home.hm_all_language || home.hm_language || 'KO';
                select.appendChild(opt);
            });

            // Restore last selected project
            var savedIdx = getData('globalProjectHmIdx');
            if (savedIdx) {
                select.value = savedIdx;
                if (select.value === savedIdx) {
                    updateGlobalProjectInfo(savedIdx);
                }
            }
        }
    } catch (err) {
        cerror('Failed to load global projects:', err);
    }
}

function onGlobalProjectChange(hmIdx) {
    saveData('globalProjectHmIdx', hmIdx || '');
    updateGlobalProjectInfo(hmIdx);

    // Dispatch custom event so channel editor / visual editor can react
    document.dispatchEvent(new CustomEvent('globalProjectChanged', {
        detail: { hmIdx: hmIdx }
    }));
}

function updateGlobalProjectInfo(hmIdx) {
    var info = document.getElementById('global-project-info');
    var badge = document.getElementById('global-project-badge');
    var reso = document.getElementById('global-project-resolution');
    if (!info || !badge || !reso) return;

    if (!hmIdx) {
        info.style.display = 'none';
        return;
    }

    var select = document.getElementById('global-project-select');
    // Safe option lookup without querySelector selector injection
    var opt = null;
    if (select) {
        for (var i = 0; i < select.options.length; i++) {
            if (select.options[i].value === String(hmIdx)) { opt = select.options[i]; break; }
        }
    }
    if (!opt) { info.style.display = 'none'; return; }

    var orient = opt.dataset.orientation;
    badge.textContent = orient === 'L' ? '가로' : '세로';
    badge.className = 'badge ' + (orient === 'L' ? 'badge-info' : 'badge-primary');
    badge.style.fontSize = '11px';

    var w = opt.dataset.width || (orient === 'L' ? '1920' : '1080');
    var h = opt.dataset.height || (orient === 'L' ? '1080' : '1920');
    reso.textContent = w + ' x ' + h;

    info.style.display = 'inline';
}

/**
 * Get currently selected global project hmIdx
 */
function getGlobalProjectHmIdx() {
    var select = document.getElementById('global-project-select');
    return select ? select.value : '';
}

// Load projects on init
// Load projects after V3Api is ready, then dispatch event for auto-load
setTimeout(function() {
    loadGlobalProjects().then(function() {
        // Notify pages that projects are loaded and selected project is ready
        document.dispatchEvent(new CustomEvent('globalProjectsLoaded'));
    });
}, 100);

/**
 * Show user profile modal
 */
function showProfile() {
    const profileHtml = `
        <div class="text-center" style="padding: 20px;">
            <div class="user-avatar" style="width: 80px; height: 80px; font-size: 32px; margin: 0 auto 16px;">
                ${escapeHtml('<?php echo safe_mb_substr($usernamedesc ?? "U", 0, 1); ?>')}
            </div>
            <h4 style="margin-bottom: 4px;"><?php echo htmlspecialchars($usernamedesc ?? ''); ?></h4>
            <p style="color: var(--text-muted); margin-bottom: 16px;"><?php echo htmlspecialchars($email ?? ''); ?></p>
            <div class="badge badge-primary"><?php echo $roleNames[$auth] ?? '사용자'; ?></div>
        </div>
        <div style="border-top: 1px solid var(--border-color); padding: 16px;">
            <div class="form-group">
                <label class="form-label">그룹</label>
                <p style="margin: 0; color: var(--text-gray);"><?php echo htmlspecialchars($mygroupname ?? '-'); ?></p>
            </div>
            <div class="form-group" style="margin-bottom: 0;">
                <label class="form-label">프로젝트 ID</label>
                <p style="margin: 0; color: var(--text-gray);"><?php echo htmlspecialchars($projectids ?? '-'); ?></p>
            </div>
        </div>
    `;

    showModalDialog(document.body, '프로필', profileHtml, '닫기', null, function() {
        hideModalDialog();
    }, null, { allowHtml: true });
}

/**
 * Show add project modal
 */
/**
 * Power Control Popup (전원 설정)
 */
// =========================================
// Power Settings (전원 설정) - v1 호환 JSON 구조
// =========================================

// v1 호환 기본 데이터
var pwrSettingData = {
    IS_SET_RESTART: false, RESTART_HOUR: -1, RESTART_MIN: -1,
    SWITCH_TURN_ON_OFF: false,
    SWITCH_WEEK_ON: false,
    DAILY_ONTIME_HOUR: -1, DAILY_OFFTIME_HOUR: -1,
    DAILY_ONTIME_MIN: -1, DAILY_OFFTIME_MIN: -1,
    WEEK_TURN_ONOFF_DATAS: [
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"월"},
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"화"},
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"수"},
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"목"},
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"금"},
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"토"},
        {ontimehour:-1,offtimehour:-1,ontimemin:-1,offtimemin:-1,ison:false,name:"일"}
    ]
};

function fmtTime(h, m) {
    if (h < 0 || m < 0) return '사용안함';
    return String(h).padStart(2,'0') + ':' + String(m).padStart(2,'0');
}

function showPowerControlPopup() {
    var hmIdx = getGlobalProjectHmIdx();
    if (!hmIdx) { toastError('프로젝트를 먼저 선택하세요.'); return; }
    var select = document.getElementById('global-project-select');
    var projectName = select ? select.options[select.selectedIndex].textContent : '';

    // Reset data
    pwrSettingData.SWITCH_TURN_ON_OFF = false;
    pwrSettingData.SWITCH_WEEK_ON = false;

    var html = '<div style="display:grid;gap:14px;">' +
        // Project
        '<div style="padding:10px 14px;background:var(--bg-input);border-radius:8px;display:flex;align-items:center;gap:8px;">' +
        '<i class="fas fa-folder-open" style="color:var(--color-primary);"></i>' +
        '<span style="font-size:13px;font-weight:500;">' + escapeHtml(projectName) + '</span></div>' +

        // Toggle: 전원 예약 ON/OFF
        '<div style="display:flex;align-items:center;justify-content:space-between;padding:8px 0;">' +
        '<span style="font-weight:600;font-size:14px;"><i class="fas fa-power-off" style="color:var(--color-danger);"></i> 전원 예약</span>' +
        '<label class="schedule-toggle"><input type="checkbox" id="pwr-toggle-onoff" onchange="pwrToggleOnOff(this.checked)"><span class="slider"></span></label></div>' +

        // Toggle: 매일/요일별
        '<div id="pwr-mode-section" style="display:none;">' +
        '<div style="display:flex;align-items:center;justify-content:space-between;padding:4px 0;margin-bottom:10px;">' +
        '<span style="font-size:13px;color:var(--text-gray);">모드</span>' +
        '<div style="display:flex;background:var(--bg-input);border-radius:6px;overflow:hidden;border:1px solid var(--border-color);">' +
        '<button id="pwr-mode-daily" class="pwr-mode-btn active" onclick="pwrSetMode(false)">매일</button>' +
        '<button id="pwr-mode-weekly" class="pwr-mode-btn" onclick="pwrSetMode(true)">요일별</button></div></div>' +

        // 매일 설정
        '<div id="pwr-daily-section">' +
        '<div style="display:flex;gap:12px;">' +
        '<div style="flex:1;text-align:center;">' +
        '<div style="font-size:11px;font-weight:600;color:var(--color-success);margin-bottom:4px;"><i class="fas fa-sun"></i> 켜기</div>' +
        '<button class="pwr-time-btn" id="pwr-daily-on" onclick="pwrSetTime(1,0,\'매일\')">사용안함</button></div>' +
        '<div style="flex:1;text-align:center;">' +
        '<div style="font-size:11px;font-weight:600;color:var(--color-danger);margin-bottom:4px;"><i class="fas fa-moon"></i> 끄기</div>' +
        '<button class="pwr-time-btn" id="pwr-daily-off" onclick="pwrSetTime(0,0,\'매일\')">사용안함</button></div>' +
        '</div></div>' +

        // 요일별 설정
        '<div id="pwr-weekly-section" style="display:none;">' +
        '<table style="width:100%;border-collapse:collapse;font-size:12px;">' +
        '<thead><tr style="border-bottom:1px solid var(--border-color);">' +
        '<th style="padding:6px 4px;text-align:center;width:40px;">요일</th>' +
        '<th style="padding:6px 4px;text-align:center;color:var(--color-success);">켜기</th>' +
        '<th style="padding:6px 4px;text-align:center;color:var(--color-danger);">끄기</th></tr></thead>' +
        '<tbody>' +
        ['월','화','수','목','금','토','일'].map(function(d, i) {
            return '<tr style="border-bottom:1px solid var(--border-color);">' +
                '<td style="padding:6px 4px;text-align:center;font-weight:600;">' + d + '</td>' +
                '<td style="padding:4px;text-align:center;"><button class="pwr-time-btn sm" id="pwr-week-on-' + i + '" onclick="pwrSetTime(1,1,\'' + d + '\')">사용안함</button></td>' +
                '<td style="padding:4px;text-align:center;"><button class="pwr-time-btn sm" id="pwr-week-off-' + i + '" onclick="pwrSetTime(0,1,\'' + d + '\')">사용안함</button></td></tr>';
        }).join('') +
        '</tbody></table></div>' +

        // 즉시 제어
        '<hr style="border:none;border-top:1px solid var(--border-color);margin:4px 0;">' +
        '<div style="display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:6px;">' +
        '<button class="btn btn-success btn-sm" onclick="sendPwrCmd(\'power_on\')" style="padding:8px 0;font-size:11px;"><i class="fas fa-power-off"></i><br>켜기</button>' +
        '<button class="btn btn-danger btn-sm" onclick="sendPwrCmd(\'power_off\')" style="padding:8px 0;font-size:11px;"><i class="fas fa-power-off"></i><br>끄기</button>' +
        '<button class="btn btn-light btn-sm" onclick="sendPwrCmd(\'reboot\')" style="padding:8px 0;font-size:11px;"><i class="fas fa-redo"></i><br>재부팅</button>' +
        '<button class="btn btn-light btn-sm" onclick="sendPwrCmd(\'restart_app\')" style="padding:8px 0;font-size:11px;"><i class="fas fa-sync-alt"></i><br>재시작</button></div>' +

        '</div></div>';

    showModalDialog(document.body, '전원 설정', html, '전송', '취소',
        function() { pushPwrSetting(); hideModalDialog(); },
        function() { hideModalDialog(); },
        { size: { width: '440px' }, allowHtml: true }
    );
}

function pwrToggleOnOff(checked) {
    pwrSettingData.SWITCH_TURN_ON_OFF = checked;
    var section = document.getElementById('pwr-mode-section');
    if (section) section.style.display = checked ? 'block' : 'none';
}

function pwrSetMode(isWeekly) {
    pwrSettingData.SWITCH_WEEK_ON = isWeekly;
    document.getElementById('pwr-mode-daily').classList.toggle('active', !isWeekly);
    document.getElementById('pwr-mode-weekly').classList.toggle('active', isWeekly);
    document.getElementById('pwr-daily-section').style.display = isWeekly ? 'none' : 'block';
    document.getElementById('pwr-weekly-section').style.display = isWeekly ? 'block' : 'none';
}

function pwrSetTime(isOn, isWeek, name) {
    var weekIdx = {'월':0,'화':1,'수':2,'목':3,'금':4,'토':5,'일':6};
    var label = (isWeek ? name : '매일') + ' ' + (isOn ? '켜기' : '끄기') + ' 시간';

    // 현재 설정값
    var curH = -1, curM = -1;
    if (isWeek) {
        var wd = pwrSettingData.WEEK_TURN_ONOFF_DATAS[weekIdx[name]];
        curH = isOn ? wd.ontimehour : wd.offtimehour;
        curM = isOn ? wd.ontimemin : wd.offtimemin;
    } else {
        curH = isOn ? pwrSettingData.DAILY_ONTIME_HOUR : pwrSettingData.DAILY_OFFTIME_HOUR;
        curM = isOn ? pwrSettingData.DAILY_ONTIME_MIN : pwrSettingData.DAILY_OFFTIME_MIN;
    }
    var curVal = (curH >= 0 && curM >= 0) ? fmtTime(curH, curM) : '08:00';

    var timeHtml = '<div style="text-align:center;padding:10px 0;">' +
        '<input type="time" id="pwr-time-input" value="' + curVal + '" style="font-size:24px;font-weight:600;padding:8px 16px;border:2px solid var(--color-primary);border-radius:8px;text-align:center;">' +
        '</div>';

    showModalDialog(document.body, label, timeHtml, '설정', '사용안함',
        function() {
            var val = document.getElementById('pwr-time-input').value;
            var parts = val.split(':');
            var h = parseInt(parts[0]), m = parseInt(parts[1]);
            pwrApplyTime(isOn, isWeek, name, h, m);
            hideModalDialog();
        },
        function() {
            pwrApplyTime(isOn, isWeek, name, -1, -1);
            hideModalDialog();
        },
        { size: { width: '320px' }, allowHtml: true }
    );
}

function pwrApplyTime(isOn, isWeek, name, h, m) {
    var weekIdx = {'월':0,'화':1,'수':2,'목':3,'금':4,'토':5,'일':6};
    if (isWeek) {
        var wd = pwrSettingData.WEEK_TURN_ONOFF_DATAS[weekIdx[name]];
        if (isOn) { wd.ontimehour = h; wd.ontimemin = m; }
        else { wd.offtimehour = h; wd.offtimemin = m; }
        wd.ison = (wd.ontimehour >= 0 || wd.offtimehour >= 0);
    } else {
        if (isOn) { pwrSettingData.DAILY_ONTIME_HOUR = h; pwrSettingData.DAILY_ONTIME_MIN = m; }
        else { pwrSettingData.DAILY_OFFTIME_HOUR = h; pwrSettingData.DAILY_OFFTIME_MIN = m; }
    }
}

async function pushPwrSetting() {
    var hmIdx = getGlobalProjectHmIdx();
    if (!hmIdx) { toastError('프로젝트를 선택하세요.'); return; }

    var pushdata = { event: 'setting', option: pwrSettingData };
    C_ShowLoadingProgress();
    try {
        var res = await V3Api.get('/devices?project_id=' + hmIdx);
        var devices = (res.data && res.data.items) || res.data || [];
        if (!Array.isArray(devices) || devices.length === 0) {
            toastError('등록된 기기가 없습니다.');
            C_HideLoadingProgress(); return;
        }
        var count = 0;
        for (var i = 0; i < devices.length; i++) {
            try {
                await V3Api.post('/devices/' + devices[i].id + '/command', {
                    command: 'remote_control', seq: JSON.stringify(pushdata)
                });
                count++;
            } catch (e) { /* continue */ }
        }
        toastSuccess('전원 설정이 ' + count + '대 기기에 전송되었습니다.');
    } catch (err) { toastError('전송 실패'); }
    finally { C_HideLoadingProgress(); }
}

async function sendPwrCmd(command) {
    var hmIdx = getGlobalProjectHmIdx();
    if (!hmIdx) { toastError('프로젝트를 선택하세요.'); return; }
    var labels = { power_on:'전원 켜기', power_off:'전원 끄기', reboot:'재부팅', restart_app:'앱 재시작' };

    confirmMsg(escapeHtml(labels[command] || command) + ' 명령을 전송하시겠습니까?', async function() {
        C_ShowLoadingProgress();
        try {
            var res = await V3Api.get('/devices?project_id=' + hmIdx);
            var devices = (res.data && res.data.items) || res.data || [];
            if (!Array.isArray(devices) || devices.length === 0) {
                toastError('등록된 기기가 없습니다.'); C_HideLoadingProgress(); return;
            }
            var count = 0;
            for (var i = 0; i < devices.length; i++) {
                try { await V3Api.post('/devices/' + devices[i].id + '/command', { command: command }); count++; }
                catch (e) { /* continue */ }
            }
            toastSuccess(count + '대 기기에 명령 전송 완료');
        } catch (err) { toastError('명령 전송 실패'); }
        finally { C_HideLoadingProgress(); }
    });
}

function showAddProjectModal() {
    var html = '<div style="display:grid;gap:12px;">' +
        '<div class="form-group"><label class="form-label">프로젝트 ID</label>' +
        '<input class="form-control" id="new-project-id" placeholder="영문/숫자 (예: sample_port)"></div>' +
        '<div class="form-group"><label class="form-label">프로젝트 이름</label>' +
        '<input class="form-control" id="new-project-name" placeholder="프로젝트 표시 이름"></div>' +
        '<div style="display:flex;gap:8px;">' +
        '<div class="form-group" style="flex:1"><label class="form-label">화면 방향</label>' +
        '<select class="form-control" id="new-project-orientation">' +
        '<option value="P">세로 (Portrait)</option>' +
        '<option value="L">가로 (Landscape)</option></select></div>' +
        '<div class="form-group" style="flex:1"><label class="form-label">기본 언어</label>' +
        '<select class="form-control" id="new-project-language">' +
        '<option value="KO">한국어</option><option value="EN">English</option>' +
        '<option value="ZH">中文</option><option value="VI">Tiếng Việt</option><option value="MS">Bahasa</option></select></div>' +
        '</div>' +
        // 언어 목록 (hm_all_language)
        '<div class="form-group"><label class="form-label">지원 언어 목록</label>' +
        '<div style="display:flex;gap:8px;align-items:center;">' +
        '<select class="form-control" id="new-project-add-lang" style="width:150px;">' +
        '<option value="KO">KO 한국어</option><option value="EN">EN English</option>' +
        '<option value="ZH">ZH 中文</option><option value="VI">VI Tiếng Việt</option><option value="MS">MS Bahasa</option></select>' +
        '<button type="button" class="btn btn-sm btn-primary" onclick="addProjectLang()">추가</button>' +
        '</div>' +
        '<div id="new-project-lang-tags" style="display:flex;gap:6px;flex-wrap:wrap;margin-top:8px;">' +
        '<span class="lang-tag" data-lang="KO">KO <i class="fas fa-times" onclick="removeProjectLang(this)" style="cursor:pointer;margin-left:4px;font-size:10px;"></i></span>' +
        '</div>' +
        '<input type="hidden" id="new-project-all-language" value="KO">' +
        '</div>' +
        '<div style="display:flex;gap:8px;">' +
        '<div class="form-group" style="flex:1"><label class="form-label">너비</label>' +
        '<input class="form-control" id="new-project-width" type="number" value="1080"></div>' +
        '<div class="form-group" style="flex:1"><label class="form-label">높이</label>' +
        '<input class="form-control" id="new-project-height" type="number" value="1920"></div>' +
        '</div></div>';

    showModalDialog(document.body, '새 프로젝트 추가', html, '생성', '취소',
        async function() {
            var projectId = document.getElementById('new-project-id').value.trim();
            var projectName = document.getElementById('new-project-name').value.trim();
            if (!projectId || !projectName) { toastError('프로젝트 ID와 이름을 입력하세요.'); return; }

            var allLanguage = document.getElementById('new-project-all-language').value || 'KO';

            try {
                var res = await V3Api.post('/projects', {
                    project_id: projectId,
                    name: projectName,
                    orientation: document.getElementById('new-project-orientation').value,
                    language: document.getElementById('new-project-language').value,
                    all_language: allLanguage,
                    width: parseInt(document.getElementById('new-project-width').value) || 1080,
                    height: parseInt(document.getElementById('new-project-height').value) || 1920
                });
                if (res.code === 100) {
                    toastSuccess('프로젝트가 생성되었습니다.');
                    hideModalDialog();
                    loadPage('project');
                } else {
                    toastError(res.message || '생성 실패');
                }
            } catch (err) {
                toastError('프로젝트 생성에 실패했습니다.');
            }
        },
        function() { hideModalDialog(); },
        { size: { width: '500px' }, allowHtml: true }
    );
}

/**
 * Add language tag to project creation dialog
 */
function addProjectLang() {
    var select = document.getElementById('new-project-add-lang');
    var container = document.getElementById('new-project-lang-tags');
    var hidden = document.getElementById('new-project-all-language');
    if (!select || !container || !hidden) return;

    var code = select.value;
    // Check if already added
    if (container.querySelector('[data-lang="' + code + '"]')) {
        toastError(code + ' 는 이미 추가되었습니다.');
        return;
    }

    var tag = document.createElement('span');
    tag.className = 'lang-tag';
    tag.dataset.lang = code;
    tag.innerHTML = escapeHtml(code) + ' <i class="fas fa-times" onclick="removeProjectLang(this)" style="cursor:pointer;margin-left:4px;font-size:10px;"></i>';
    container.appendChild(tag);

    updateProjectLangHidden();
}

/**
 * Remove language tag
 */
function removeProjectLang(icon) {
    var tag = icon.parentElement;
    if (!tag) return;
    tag.remove();
    updateProjectLangHidden();
}

/**
 * Sync hidden input with current lang tags
 */
function updateProjectLangHidden() {
    var container = document.getElementById('new-project-lang-tags');
    var hidden = document.getElementById('new-project-all-language');
    if (!container || !hidden) return;

    var tags = container.querySelectorAll('.lang-tag');
    var codes = [];
    tags.forEach(function(t) { codes.push(t.dataset.lang); });
    hidden.value = codes.join(',');
}

/**
 * Logout user
 */
function logout() {
    confirmMsg('로그아웃 하시겠습니까?', function() {
        window.location.href = 'logout.php';
    });
}

/**
 * Update notification badge
 * @param {number} count
 */
function updateNotificationBadge(count) {
    const badge = document.getElementById('notification-count');
    if (badge) {
        if (count > 0) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.style.display = 'flex';
        } else {
            badge.style.display = 'none';
        }
    }
}
</script>
