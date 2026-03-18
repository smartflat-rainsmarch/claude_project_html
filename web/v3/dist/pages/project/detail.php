<!-- SmartFlat CMS v3 - Project Detail Page -->
<?php
require_once(__DIR__ . '/../../components/breadcrumb.php');
require_once(__DIR__ . '/../../components/status-badge.php');
require_once(__DIR__ . '/../../components/summary-card.php');

$projectId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
?>

<div class="page-header">
    <div class="page-header-content">
        <div class="page-header-left">
            <?php renderBreadcrumb([
                ['label' => '홈', 'link' => 'dashboard'],
                ['label' => '프로젝트', 'link' => 'project'],
                ['label' => '프로젝트 상세']
            ]); ?>
            <h1 class="page-title" id="project-title">프로젝트 상세</h1>
        </div>
        <div class="page-header-actions">
            <button class="btn btn-light" onclick="loadPage('project')">
                <i class="fas fa-arrow-left"></i> 목록
            </button>
            <button class="btn btn-primary" onclick="deployProject()">
                <i class="fas fa-paper-plane"></i> 배포
            </button>
            <button class="btn btn-light" onclick="editProject()">
                <i class="fas fa-edit"></i> 수정
            </button>
        </div>
    </div>
</div>

<!-- Project Summary Cards -->
<div class="stats-grid" id="project-stats">
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon primary"><i class="fas fa-tv"></i></div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-devices">-</div>
                    <div class="stats-label">연결 기기</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon success"><i class="fas fa-check-circle"></i></div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-online">-</div>
                    <div class="stats-label">온라인</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon info"><i class="fas fa-file-alt"></i></div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-contents">-</div>
                    <div class="stats-label">콘텐츠</div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon warning"><i class="fas fa-paper-plane"></i></div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-deploys">-</div>
                    <div class="stats-label">최근 배포</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Project Info -->
    <div class="col col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">프로젝트 정보</h3>
            </div>
            <div class="card-body" id="project-info">
                <div style="text-align: center; padding: 40px;">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Devices List -->
    <div class="col col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">연결된 기기</h3>
                <div class="card-toolbar">
                    <button class="btn btn-sm btn-light" onclick="loadPage('device', { project_id: currentProjectId })">
                        전체보기 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-container">
                    <table class="table" id="devices-table">
                        <thead>
                            <tr>
                                <th>기기명</th>
                                <th>그룹</th>
                                <th>상태</th>
                                <th>마지막 연결</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" style="text-align: center; padding: 40px;">
                                    <div class="spinner"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Contents List -->
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">콘텐츠</h3>
                <div class="card-toolbar">
                    <button class="btn btn-sm btn-primary" onclick="loadPage('content', { project_id: currentProjectId })">
                        <i class="fas fa-plus"></i> 추가
                    </button>
                </div>
            </div>
            <div class="card-body" style="padding: 0;">
                <div class="table-container">
                    <table class="table" id="contents-table">
                        <thead>
                            <tr>
                                <th>콘텐츠명</th>
                                <th>타입</th>
                                <th>상태</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 40px;">
                                    <div class="spinner"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Deployments -->
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">최근 배포</h3>
                <div class="card-toolbar">
                    <button class="btn btn-sm btn-light" onclick="loadPage('deployment', { project_id: currentProjectId })">
                        전체보기 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" id="recent-deployments">
                <div style="text-align: center; padding: 40px;">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * Project Detail Page
 */

var currentProjectId = <?php echo $projectId; ?>;
var currentProject = null;

// Initialize on load
(function() {
    clog('Project detail page loaded, id:', currentProjectId);

    if (!currentProjectId) {
        alertMsg('프로젝트 ID가 없습니다.', function() {
            loadPage('project');
        });
        return;
    }

    loadProjectDetail();
})();

/**
 * Load project detail
 */
async function loadProjectDetail() {
    try {
        // Load project summary
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=projects/${currentProjectId}/summary`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            const data = result.data;
            currentProject = data.project;

            // Update page title
            document.getElementById('project-title').textContent = currentProject.name;

            // Update stats
            document.getElementById('stat-devices').textContent = data.devices?.total || 0;
            document.getElementById('stat-online').textContent = data.devices?.online || 0;
            document.getElementById('stat-contents').textContent = data.contents?.total || 0;
            document.getElementById('stat-deploys').textContent = data.recent_deployments?.length || 0;

            // Render project info
            renderProjectInfo(currentProject);

            // Render recent deployments
            renderRecentDeployments(data.recent_deployments || []);
        } else {
            throw new Error(result.message);
        }

        // Load devices
        loadProjectDevices();

        // Load contents
        loadProjectContents();

    } catch (error) {
        cerror('Failed to load project detail:', error);
        toastError('프로젝트 정보를 불러오는데 실패했습니다.');
    }
}

/**
 * Render project info
 */
function renderProjectInfo(project) {
    const statusBadge = getStatusBadgeHtml(project.status, 'project');

    document.getElementById('project-info').innerHTML = `
        <div class="info-list">
            <div class="info-item">
                <span class="info-label">프로젝트 키</span>
                <span class="info-value"><code>${escapeHtml(project.project_key)}</code></span>
            </div>
            <div class="info-item">
                <span class="info-label">상태</span>
                <span class="info-value">${statusBadge}</span>
            </div>
            <div class="info-item">
                <span class="info-label">카테고리</span>
                <span class="info-value">${escapeHtml(project.category || '-')}</span>
            </div>
            <div class="info-item">
                <span class="info-label">지역</span>
                <span class="info-value">${escapeHtml(project.region || '-')}</span>
            </div>
            <div class="info-item">
                <span class="info-label">화면</span>
                <span class="info-value">${project.width} x ${project.height} (${project.orientation === 'P' ? '세로' : '가로'})</span>
            </div>
            <div class="info-item">
                <span class="info-label">최근 배포</span>
                <span class="info-value">${project.last_deploy_at ? formatDateTime(project.last_deploy_at) : '-'}</span>
            </div>
            <div class="info-item">
                <span class="info-label">생성일</span>
                <span class="info-value">${formatDateTime(project.created_at)}</span>
            </div>
            ${project.description ? `
            <div class="info-item" style="flex-direction: column; align-items: flex-start;">
                <span class="info-label">설명</span>
                <span class="info-value" style="margin-top: 4px;">${escapeHtml(project.description)}</span>
            </div>
            ` : ''}
        </div>
    `;
}

/**
 * Load project devices
 */
async function loadProjectDevices() {
    try {
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=projects/${currentProjectId}/devices`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            renderDevicesTable(result.data || []);
        }
    } catch (error) {
        cerror('Failed to load devices:', error);
    }
}

/**
 * Render devices table
 */
function renderDevicesTable(devices) {
    const tbody = document.querySelector('#devices-table tbody');

    if (devices.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" class="text-center text-muted" style="padding: 40px;">
                    연결된 기기가 없습니다.
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = devices.slice(0, 10).map(device => {
        const statusBadge = getStatusBadgeHtml(device.status, 'device');
        const lastHeartbeat = device.last_heartbeat ? formatRelativeTime(device.last_heartbeat) : '-';

        return `
            <tr style="cursor: pointer;" onclick="loadPage('device/detail', { id: ${device.id} })">
                <td>
                    <strong>${escapeHtml(device.name || device.device_key)}</strong>
                </td>
                <td>${escapeHtml(device.group_name || '-')}</td>
                <td>${statusBadge}</td>
                <td>${escapeHtml(lastHeartbeat)}</td>
            </tr>
        `;
    }).join('');
}

/**
 * Load project contents
 */
async function loadProjectContents() {
    try {
        const response = await fetch(`/web/v3/dist/api/v3/router.php?route=projects/${currentProjectId}/contents`, {
            credentials: 'same-origin'
        });
        const result = await response.json();

        if (result.code === 100) {
            renderContentsTable(result.data || []);
        }
    } catch (error) {
        cerror('Failed to load contents:', error);
    }
}

/**
 * Render contents table
 */
function renderContentsTable(contents) {
    const tbody = document.querySelector('#contents-table tbody');

    if (contents.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="3" class="text-center text-muted" style="padding: 40px;">
                    콘텐츠가 없습니다.
                </td>
            </tr>
        `;
        return;
    }

    tbody.innerHTML = contents.map(content => {
        const statusBadge = getStatusBadgeHtml(content.status, 'content');
        const typeIcon = getContentTypeIcon(content.content_type);

        return `
            <tr style="cursor: pointer;" onclick="loadPage('content/detail', { id: ${content.id} })">
                <td>
                    <i class="fas ${typeIcon}" style="margin-right: 8px; color: var(--text-muted);"></i>
                    <strong>${escapeHtml(content.name)}</strong>
                </td>
                <td>${escapeHtml(content.content_type)}</td>
                <td>${statusBadge}</td>
            </tr>
        `;
    }).join('');
}

/**
 * Render recent deployments
 */
function renderRecentDeployments(deployments) {
    const container = document.getElementById('recent-deployments');

    if (deployments.length === 0) {
        container.innerHTML = `
            <div class="text-center text-muted" style="padding: 40px;">
                배포 이력이 없습니다.
            </div>
        `;
        return;
    }

    container.innerHTML = deployments.map(deploy => {
        const statusBadge = getStatusBadgeHtml(deploy.status, 'deploy');
        const date = formatRelativeTime(deploy.created_at);

        return `
            <div class="activity-item" style="display: flex; align-items: center; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                <div style="flex: 1;">
                    <div style="font-weight: 500;">${statusBadge}</div>
                    <div style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">
                        성공 ${deploy.success_count}건 / 실패 ${deploy.fail_count}건
                    </div>
                </div>
                <div style="font-size: 12px; color: var(--text-muted);">
                    ${escapeHtml(date)}
                </div>
            </div>
        `;
    }).join('');
}

/**
 * Edit project
 */
function editProject() {
    loadPage('project', { edit: currentProjectId });
}

/**
 * Deploy project
 */
function deployProject() {
    confirmMsg(`"${currentProject.name}" 프로젝트를 배포하시겠습니까?`, async function() {
        C_ShowLoadingProgress();

        try {
            const response = await fetch('/web/v3/dist/api/v3/router.php?route=deployments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': '<?php echo $_SESSION['csrf_token'] ?? ''; ?>'
                },
                body: JSON.stringify({
                    project_id: currentProjectId,
                    target_type: 'all',
                    deploy_type: 'content'
                }),
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.code === 100) {
                toastSuccess('배포가 시작되었습니다.');
                loadProjectDetail();
            } else {
                toastError(result.message || '배포 요청에 실패했습니다.');
            }
        } catch (error) {
            cerror('Failed to deploy:', error);
            toastError('배포 요청 중 오류가 발생했습니다.');
        } finally {
            C_HideLoadingProgress();
        }
    });
}

// Helper functions
function getStatusBadgeHtml(status, type) {
    const configs = {
        project: {
            active: { class: 'badge-success', label: '운영중' },
            paused: { class: 'badge-warning', label: '일시정지' },
            archived: { class: 'badge-secondary', label: '보관' }
        },
        device: {
            online: { class: 'badge-success', label: '온라인' },
            offline: { class: 'badge-danger', label: '오프라인' },
            warning: { class: 'badge-warning', label: '점검' },
            unknown: { class: 'badge-secondary', label: '알수없음' }
        },
        content: {
            draft: { class: 'badge-secondary', label: '초안' },
            published: { class: 'badge-success', label: '게시중' },
            archived: { class: 'badge-dark', label: '보관' }
        },
        deploy: {
            created: { class: 'badge-info', label: '생성됨' },
            queued: { class: 'badge-info', label: '대기중' },
            running: { class: 'badge-primary', label: '진행중' },
            success: { class: 'badge-success', label: '성공' },
            partial_fail: { class: 'badge-warning', label: '부분실패' },
            failed: { class: 'badge-danger', label: '실패' }
        }
    };

    const config = configs[type]?.[status] || { class: 'badge-secondary', label: status };
    return `<span class="badge ${config.class}">${escapeHtml(config.label)}</span>`;
}

function getContentTypeIcon(type) {
    const icons = {
        image: 'fa-image',
        video: 'fa-video',
        pdf: 'fa-file-pdf',
        html: 'fa-code',
        survey: 'fa-poll',
        slideshow: 'fa-images',
        weather: 'fa-cloud-sun',
        clock: 'fa-clock',
        text: 'fa-font'
    };
    return icons[type] || 'fa-file';
}

function formatDateTime(dateStr) {
    if (!dateStr) return '-';
    return new Date(dateStr).toLocaleString('ko-KR');
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
</script>

<style>
.info-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 8px 0;
    border-bottom: 1px solid var(--border-color);
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-size: 13px;
    color: var(--text-muted);
}

.info-value {
    font-size: 14px;
    color: var(--text-dark);
}

.info-value code {
    background: var(--bg-light);
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 12px;
}
</style>
