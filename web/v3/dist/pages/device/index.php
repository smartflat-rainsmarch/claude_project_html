<!-- SmartFlat CMS v3 - Device Management Page -->
<?php
require_once(__DIR__ . '/../../components/breadcrumb.php');
require_once(__DIR__ . '/../../components/status-badge.php');

$projectId = isset($_GET['project_id']) ? (int)$_GET['project_id'] : 0;
?>

<?php
renderPageHeader('기기 관리', [
    ['label' => '홈', 'link' => 'dashboard'],
    ['label' => '기기 관리']
], '등록된 기기를 관리하고 모니터링합니다', [
    [
        'label' => '기기 추가',
        'icon' => 'fa-plus',
        'class' => 'btn btn-primary',
        'onclick' => 'showDeviceForm()'
    ]
]);
?>

<!-- Quick Stats -->
<div class="stats-grid" style="margin-bottom: 16px;">
    <div class="card">
        <div class="card-body" style="padding: 16px;">
            <div class="stats-card" style="gap: 12px;">
                <div class="stats-icon success" style="width: 40px; height: 40px; font-size: 16px;">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-online">-</div>
                    <div class="stats-label">온라인</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body" style="padding: 16px;">
            <div class="stats-card" style="gap: 12px;">
                <div class="stats-icon danger" style="width: 40px; height: 40px; font-size: 16px;">
                    <i class="fas fa-circle"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-offline">-</div>
                    <div class="stats-label">오프라인</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body" style="padding: 16px;">
            <div class="stats-card" style="gap: 12px;">
                <div class="stats-icon warning" style="width: 40px; height: 40px; font-size: 16px;">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-warning">-</div>
                    <div class="stats-label">점검필요</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body" style="padding: 16px;">
            <div class="stats-card" style="gap: 12px;">
                <div class="stats-icon primary" style="width: 40px; height: 40px; font-size: 16px;">
                    <i class="fas fa-tv"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-total">-</div>
                    <div class="stats-label">전체</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Panel -->
<div class="card" style="margin-bottom: 16px;">
    <div class="card-body" style="padding: 16px;">
        <div class="filter-inline">
            <div class="filter-row">
                <div class="filter-field">
                    <label class="filter-label">프로젝트</label>
                    <select class="form-control form-control-sm" id="filter-project" onchange="applyDeviceFilters()">
                        <option value="">전체</option>
                    </select>
                </div>
                <div class="filter-field">
                    <label class="filter-label">상태</label>
                    <select class="form-control form-control-sm" id="filter-status" onchange="applyDeviceFilters()">
                        <option value="">전체</option>
                        <option value="online">온라인</option>
                        <option value="offline">오프라인</option>
                        <option value="warning">점검</option>
                        <option value="unknown">알수없음</option>
                    </select>
                </div>
                <div class="filter-field" style="flex: 2;">
                    <label class="filter-label">검색</label>
                    <input type="text" class="form-control form-control-sm" id="filter-search"
                           placeholder="기기명, 키, IP 검색..." onkeyup="debounceSearch(this.value)">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Device Table -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title">기기 목록</h3>
        <div class="card-toolbar">
            <button class="btn btn-light btn-sm" onclick="deviceTable?.refresh(); loadDeviceStats();">
                <i class="fas fa-sync"></i> 새로고침
            </button>
        </div>
    </div>
    <div class="card-body" style="padding: 0;">
        <div class="data-table-wrapper" id="device-table_wrapper">
            <div class="table-container">
                <table class="table" id="device-table">
                    <thead>
                        <tr>
                            <th>기기명</th>
                            <th>프로젝트</th>
                            <th>그룹</th>
                            <th>상태</th>
                            <th>앱 버전</th>
                            <th>마지막 연결</th>
                            <th style="width: 140px;">관리</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="7" class="table-loading">
                                <div class="spinner"></div>
                                <div class="loading-text">데이터 로딩 중...</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="data-table-footer">
                <div class="table-info" id="device-table_info">
                    총 <span class="total-count">0</span>건
                </div>
                <div class="table-pagination" id="device-table_pagination"></div>
            </div>
        </div>
    </div>
</div>

<!-- Device Form Modal Template -->
<div id="device-form-template" style="display: none;">
    <form id="device-form" onsubmit="return false;">
        <input type="hidden" id="device-id" name="id">

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">기기 키 <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="device-key" name="device_key" required>
                    <small class="form-text text-muted">기기 고유 식별자</small>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">기기명</label>
                    <input type="text" class="form-control" id="device-name" name="name">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">프로젝트</label>
                    <select class="form-control" id="device-project" name="project_id">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="form-group">
                    <label class="form-label">그룹</label>
                    <select class="form-control" id="device-group" name="group_id">
                        <option value="">선택하세요</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">설치 위치</label>
            <input type="text" class="form-control" id="device-location" name="location" placeholder="예: 1층 로비">
        </div>
    </form>
</div>

<!-- Command Modal Template -->
<div id="command-form-template" style="display: none;">
    <div class="form-group">
        <label class="form-label">명령 선택</label>
        <select class="form-control" id="command-type">
            <option value="refresh_content">콘텐츠 새로고침</option>
            <option value="restart_app">앱 재시작</option>
            <option value="clear_cache">캐시 삭제</option>
            <option value="screenshot">스크린샷</option>
            <option value="reboot">기기 재부팅</option>
        </select>
    </div>
    <div class="alert alert-warning" style="margin-top: 16px;">
        <i class="fas fa-exclamation-triangle"></i>
        기기 재부팅은 서비스 중단을 유발할 수 있습니다.
    </div>
</div>

<script>
/**
 * Device List Page
 */

let deviceTable = null;
let projects = [];
let deviceGroups = [];
let searchDebounceTimer = null;
const initialProjectId = <?php echo $projectId ?: 'null'; ?>;

// Initialize on load
(function() {
    clog('Device page loaded');
    loadInitialData();
})();

/**
 * Load initial data
 */
async function loadInitialData() {
    try {
        // Load projects
        const projectsResponse = await fetch('/web/v3/dist/api/v3/router.php?route=projects&limit=100', {
            credentials: 'same-origin'
        });
        const projectsResult = await projectsResponse.json();
        if (projectsResult.code === 100) {
            projects = projectsResult.data.items || [];
        }

        populateDropdowns();
        initDeviceTable();
        loadDeviceStats();

        // Apply initial project filter
        if (initialProjectId) {
            document.getElementById('filter-project').value = initialProjectId;
            applyDeviceFilters();
        }
    } catch (error) {
        cerror('Failed to load initial data:', error);
    }
}

/**
 * Populate dropdown options
 */
function populateDropdowns() {
    const projectSelects = document.querySelectorAll('#filter-project, #device-project');
    projectSelects.forEach(select => {
        while (select.options.length > 1) {
            select.remove(1);
        }
        projects.forEach(project => {
            const option = document.createElement('option');
            option.value = project.id;
            option.textContent = project.name;
            select.appendChild(option);
        });
    });
}

/**
 * Load device stats
 */
async function loadDeviceStats() {
    try {
        const response = await fetch('/web/v3/dist/api/v3/router.php?route=dashboard/stats', {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            const devices = result.data.devices || {};
            document.getElementById('stat-online').textContent = devices.online || 0;
            document.getElementById('stat-offline').textContent = devices.offline || 0;
            document.getElementById('stat-warning').textContent = devices.warning || 0;
            document.getElementById('stat-total').textContent = devices.total || 0;
        }
    } catch (error) {
        cerror('Failed to load device stats:', error);
    }
}

/**
 * Initialize device data table
 */
function initDeviceTable() {
    deviceTable = new SFDataTable('device-table', {
        apiUrl: '/web/v3/dist/api/v3/router.php?route=devices',
        pageSize: 20,
        columns: [
            { key: 'name', label: '기기명' },
            { key: 'project_name', label: '프로젝트' },
            { key: 'group_name', label: '그룹' },
            { key: 'status', label: '상태' },
            { key: 'app_version', label: '앱 버전' },
            { key: 'last_heartbeat', label: '마지막 연결' },
            { key: 'actions', label: '관리' }
        ],
        onRowClick: (row) => {
            showDeviceDetail(row.id);
        }
    });

    deviceTable.renderRow = function(row) {
        const statusBadge = getStatusBadgeHtml(row.status);
        const lastHeartbeat = row.offline_duration || formatRelativeTime(row.last_heartbeat);

        return `
            <tr data-id="${escapeHtml(String(row.id))}">
                <td>
                    <strong>${escapeHtml(row.name || row.device_key)}</strong>
                    <small class="text-muted d-block">${escapeHtml(row.device_key)}</small>
                </td>
                <td>${escapeHtml(row.project_name || '-')}</td>
                <td>${escapeHtml(row.group_name || '-')}</td>
                <td>${statusBadge}</td>
                <td>${escapeHtml(row.app_version || '-')}</td>
                <td>
                    ${row.is_online ? '<span class="text-success">연결됨</span>' : escapeHtml(lastHeartbeat)}
                </td>
                <td class="no-row-click">
                    <div class="btn-group">
                        <button class="btn btn-sm btn-light" onclick="editDevice(${row.id})" title="수정">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-primary" onclick="sendCommand(${row.id}, '${escapeHtml(row.name || row.device_key)}')" title="명령">
                            <i class="fas fa-terminal"></i>
                        </button>
                        <button class="btn btn-sm btn-light text-danger" onclick="deleteDevice(${row.id}, '${escapeHtml(row.name || row.device_key)}')" title="삭제">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    };
}

/**
 * Apply filters
 */
function applyDeviceFilters() {
    const filters = {
        project_id: document.getElementById('filter-project').value,
        status: document.getElementById('filter-status').value,
        search: document.getElementById('filter-search').value
    };

    deviceTable?.setFilters(filters);
}

function debounceSearch(value) {
    clearTimeout(searchDebounceTimer);
    searchDebounceTimer = setTimeout(() => applyDeviceFilters(), 300);
}

/**
 * Show device form
 */
function showDeviceForm(deviceId = null) {
    const isEdit = !!deviceId;
    const title = isEdit ? '기기 수정' : '기기 추가';

    const formHtml = document.getElementById('device-form-template').innerHTML;

    showModalDialog(document.body, title, formHtml, '저장', '취소',
        function() {
            saveDevice();
        },
        function() {
            hideModalDialog();
        },
        { size: { width: 600 }, allowHtml: true }
    );

    setTimeout(() => {
        populateDropdowns();
        if (isEdit) {
            loadDeviceForEdit(deviceId);
        }
    }, 100);
}

/**
 * Load device for editing
 */
async function loadDeviceForEdit(deviceId) {
    try {
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=devices/${deviceId}`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            const device = result.data;
            document.getElementById('device-id').value = device.id;
            document.getElementById('device-key').value = device.device_key;
            document.getElementById('device-key').disabled = true;
            document.getElementById('device-name').value = device.name || '';
            document.getElementById('device-project').value = device.project_id || '';
            document.getElementById('device-location').value = device.location || '';

            // Load device groups for selected project
            if (device.project_id) {
                await loadDeviceGroups(device.project_id);
                document.getElementById('device-group').value = device.group_id || '';
            }
        }
    } catch (error) {
        cerror('Failed to load device:', error);
        toastError('기기 정보를 불러오는데 실패했습니다.');
    }
}

/**
 * Load device groups for project
 */
async function loadDeviceGroups(projectId) {
    try {
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=device-groups&project_id=${projectId}`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            const groups = result.data || [];
            const select = document.getElementById('device-group');

            while (select.options.length > 1) {
                select.remove(1);
            }

            groups.forEach(group => {
                const option = document.createElement('option');
                option.value = group.id;
                option.textContent = group.name;
                select.appendChild(option);
            });
        }
    } catch (error) {
        cerror('Failed to load device groups:', error);
    }
}

function editDevice(deviceId) {
    showDeviceForm(deviceId);
}

/**
 * Save device
 */
async function saveDevice() {
    const data = {
        id: document.getElementById('device-id')?.value || null,
        device_key: document.getElementById('device-key')?.value,
        name: document.getElementById('device-name')?.value,
        project_id: document.getElementById('device-project')?.value || null,
        group_id: document.getElementById('device-group')?.value || null,
        location: document.getElementById('device-location')?.value
    };

    const isEdit = !!data.id;

    C_ShowLoadingProgress();

    try {
        const url = isEdit
            ? `/web/v3/dist/api/v3/router.php?route=devices/${data.id}`
            : '/web/v3/dist/api/v3/router.php?route=devices';

        const response = await fetch(url, {
            method: isEdit ? 'PUT' : 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
            },
            body: JSON.stringify(data),
            credentials: 'same-origin'
        });

        const result = await response.json();

        if (result.code === 100) {
            hideModalDialog();
            toastSuccess(isEdit ? '기기가 수정되었습니다.' : '기기가 추가되었습니다.');
            deviceTable?.refresh();
            loadDeviceStats();
        } else {
            toastError(result.message || '저장에 실패했습니다.');
        }
    } catch (error) {
        cerror('Failed to save device:', error);
        toastError('저장 중 오류가 발생했습니다.');
    } finally {
        C_HideLoadingProgress();
    }
}

/**
 * Show device detail
 */
function showDeviceDetail(deviceId) {
    // Could navigate to detail page or show modal
    editDevice(deviceId);
}

/**
 * Send command to device
 */
function sendCommand(deviceId, deviceName) {
    const formHtml = document.getElementById('command-form-template').innerHTML;

    showModalDialog(document.body, `명령 전송: ${deviceName}`, formHtml, '전송', '취소',
        async function() {
            const command = document.getElementById('command-type').value;

            C_ShowLoadingProgress();

            try {
                const response = await fetch(`/web/v3/dist/api/v3/router.php?route=devices/${deviceId}/command`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
                    },
                    body: JSON.stringify({ command }),
                    credentials: 'same-origin'
                });

                const result = await response.json();

                if (result.code === 100) {
                    hideModalDialog();
                    toastSuccess('명령이 전송되었습니다.');
                } else {
                    toastError(result.message || '명령 전송에 실패했습니다.');
                }
            } catch (error) {
                cerror('Failed to send command:', error);
                toastError('명령 전송 중 오류가 발생했습니다.');
            } finally {
                C_HideLoadingProgress();
            }
        },
        function() {
            hideModalDialog();
        },
        { allowHtml: true }
    );
}

/**
 * Delete device
 */
function deleteDevice(deviceId, deviceName) {
    confirmMsg(`"${deviceName}" 기기를 삭제하시겠습니까?`, async function() {
        C_ShowLoadingProgress();

        try {
            const response = await fetch(`/web/v3/dist/api/v3/router.php?route=devices/${deviceId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
                },
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.code === 100) {
                toastSuccess('기기가 삭제되었습니다.');
                deviceTable?.refresh();
                loadDeviceStats();
            } else {
                toastError(result.message || '삭제에 실패했습니다.');
            }
        } catch (error) {
            cerror('Failed to delete:', error);
            toastError('삭제 중 오류가 발생했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    });
}

// Helper functions
function getStatusBadgeHtml(status) {
    const configs = {
        online: { class: 'badge-success', label: '온라인' },
        offline: { class: 'badge-danger', label: '오프라인' },
        warning: { class: 'badge-warning', label: '점검' },
        unknown: { class: 'badge-secondary', label: '알수없음' }
    };

    const config = configs[status] || configs.unknown;
    return `<span class="badge ${config.class}">${escapeHtml(config.label)}</span>`;
}

function formatRelativeTime(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    const now = new Date();
    const diffMs = now - date;
    const diffMins = Math.floor(diffMs / 60000);
    const diffHours = Math.floor(diffMs / 3600000);
    const diffDays = Math.floor(diffMs / 86400000);

    if (diffMins < 1) return '방금 전';
    if (diffMins < 60) return `${diffMins}분 전`;
    if (diffHours < 24) return `${diffHours}시간 전`;
    if (diffDays < 7) return `${diffDays}일 전`;
    return date.toLocaleDateString('ko-KR');
}

// Watch for project change to load groups
document.addEventListener('change', function(e) {
    if (e.target.id === 'device-project') {
        const projectId = e.target.value;
        if (projectId) {
            loadDeviceGroups(projectId);
        } else {
            const groupSelect = document.getElementById('device-group');
            if (groupSelect) {
                while (groupSelect.options.length > 1) {
                    groupSelect.remove(1);
                }
            }
        }
    }
});
</script>
