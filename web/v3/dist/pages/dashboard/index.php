<!-- SmartFlat CMS v3 - Dashboard Page -->
<div class="page-header">
    <h1 class="page-title">대시보드</h1>
    <p class="page-description">SmartFlat CMS 운영 현황을 한눈에 확인하세요</p>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
    <!-- Total Projects -->
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

    <!-- Active Devices -->
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon success">
                    <i class="fas fa-tv"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-devices">-</div>
                    <div class="stats-label">활성 기기</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Today Deployments -->
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon warning">
                    <i class="fas fa-paper-plane"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-deployments">-</div>
                    <div class="stats-label">오늘 배포</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    <div class="card">
        <div class="card-body">
            <div class="stats-card">
                <div class="stats-icon danger">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-content">
                    <div class="stats-value" id="stat-alerts">-</div>
                    <div class="stats-label">알림</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row">
    <!-- Recent Projects -->
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">최근 프로젝트</h3>
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
                                <th>기기 수</th>
                                <th>최근 배포</th>
                                <th>상태</th>
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
    </div>

    <!-- Recent Activities -->
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">최근 활동</h3>
                <div class="card-toolbar">
                    <button class="btn btn-sm btn-light" onclick="loadPage('audit')">
                        전체보기 <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" id="recent-activities">
                <div style="text-align: center; padding: 40px;">
                    <div class="spinner"></div>
                    <div style="margin-top: 8px; color: var(--text-muted);">로딩 중...</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Device Status Row -->
<div class="row">
    <!-- Device Status Chart -->
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">기기 상태</h3>
            </div>
            <div class="card-body">
                <canvas id="device-status-chart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Deployment History Chart -->
    <div class="col col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">배포 이력 (최근 7일)</h3>
            </div>
            <div class="card-body">
                <canvas id="deployment-chart" height="200"></canvas>
            </div>
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
            <div class="col col-md-3 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('project')">
                    <i class="fas fa-plus" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>새 프로젝트</span>
                </button>
            </div>
            <div class="col col-md-3 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('content')">
                    <i class="fas fa-edit" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>콘텐츠 편집</span>
                </button>
            </div>
            <div class="col col-md-3 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('deployment')">
                    <i class="fas fa-paper-plane" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>배포하기</span>
                </button>
            </div>
            <div class="col col-md-3 col-6" style="margin-bottom: 16px;">
                <button class="btn btn-light btn-lg" style="width: 100%; height: 80px;" onclick="loadPage('monitoring')">
                    <i class="fas fa-desktop" style="font-size: 20px; display: block; margin-bottom: 8px;"></i>
                    <span>모니터링</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
/**
 * Dashboard Page - Real API Integration
 */
(function() {
    clog('Dashboard page loaded');

    // Store chart instances for updates
    window.dashboardCharts = {
        deviceStatus: null,
        deploymentHistory: null
    };

    // Load all dashboard data
    loadDashboardData();
})();

/**
 * Load dashboard statistics from API
 */
async function loadDashboardData() {
    try {
        // Fetch main dashboard summary
        const response = await V3Api.get('/dashboard');

        if (response.success && response.data) {
            const data = response.data;
            const stats = data.stats || {};

            // Update stats cards
            document.getElementById('stat-projects').textContent = stats.projects || 0;
            document.getElementById('stat-devices').textContent = stats.devices?.online || 0;
            document.getElementById('stat-deployments').textContent = stats.today_deployments || 0;
            document.getElementById('stat-alerts').textContent = stats.alerts || 0;

            // Load recent projects from summary
            if (data.recent_projects) {
                renderRecentProjects(data.recent_projects);
            }

            // Load recent activities from audit logs
            if (data.recent_activities) {
                renderRecentActivitiesFromAudit(data.recent_activities);
            }
        }

        // Load chart data
        loadDeviceStatusChart();
        loadDeploymentHistoryChart();

    } catch (error) {
        cerror('Dashboard data load failed:', error);
        showDashboardError();
    }
}

/**
 * Render recent projects table
 */
function renderRecentProjects(projects) {
    const tbody = document.querySelector('#recent-projects-table tbody');

    if (!projects || projects.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-muted);">
                    <i class="fas fa-folder-open" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                    등록된 프로젝트가 없습니다
                </td>
            </tr>
        `;
        return;
    }

    const statusBadges = {
        active: '<span class="badge badge-success">활성</span>',
        inactive: '<span class="badge badge-light">비활성</span>',
        maintenance: '<span class="badge badge-warning">점검중</span>',
        archived: '<span class="badge badge-secondary">보관</span>'
    };

    tbody.innerHTML = projects.map(p => `
        <tr style="cursor: pointer;" onclick="loadPage('project', { id: ${p.id} })">
            <td><strong>${escapeHtml(p.name)}</strong></td>
            <td>${p.device_count || 0}대</td>
            <td>${p.last_deploy_at ? formatDateTime(p.last_deploy_at) : '-'}</td>
            <td>${statusBadges[p.status] || statusBadges.inactive}</td>
        </tr>
    `).join('');
}

/**
 * Render recent activities from audit logs
 */
function renderRecentActivitiesFromAudit(activities) {
    const container = document.getElementById('recent-activities');

    if (!activities || activities.length === 0) {
        container.innerHTML = `
            <div style="text-align: center; padding: 40px; color: var(--text-muted);">
                <i class="fas fa-history" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                최근 활동이 없습니다
            </div>
        `;
        return;
    }

    // Map action types to icons and colors
    const actionIcons = {
        create: { icon: 'fa-plus-circle', color: 'success' },
        update: { icon: 'fa-edit', color: 'primary' },
        delete: { icon: 'fa-trash', color: 'danger' },
        deploy: { icon: 'fa-paper-plane', color: 'info' },
        login: { icon: 'fa-sign-in-alt', color: 'light' },
        logout: { icon: 'fa-sign-out-alt', color: 'light' },
        publish: { icon: 'fa-check-circle', color: 'success' },
        command: { icon: 'fa-terminal', color: 'warning' }
    };

    // Map target types to Korean
    const targetTypes = {
        project: '프로젝트',
        content: '콘텐츠',
        device: '기기',
        deployment: '배포',
        user: '사용자',
        group: '그룹'
    };

    container.innerHTML = activities.slice(0, 5).map(a => {
        const actionInfo = actionIcons[a.action_type] || { icon: 'fa-circle', color: 'light' };
        const targetType = targetTypes[a.target_type] || a.target_type;
        const actionText = getActionText(a.action_type);
        const text = a.summary || `${targetType} ${a.target_name || ''} ${actionText}`;

        return `
            <div style="display: flex; align-items: flex-start; gap: 12px; padding: 12px 0; border-bottom: 1px solid var(--border-color);">
                <div class="stats-icon ${actionInfo.color}" style="width: 36px; height: 36px; font-size: 14px; flex-shrink: 0;">
                    <i class="fas ${actionInfo.icon}"></i>
                </div>
                <div style="flex: 1;">
                    <div style="font-size: 14px; color: var(--text-dark);">${escapeHtml(text)}</div>
                    <div style="font-size: 12px; color: var(--text-muted); margin-top: 4px;">
                        ${a.user_name ? escapeHtml(a.user_name) + ' · ' : ''}${formatRelativeTime(a.created_at)}
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

/**
 * Get action text in Korean
 */
function getActionText(action) {
    const texts = {
        create: '생성',
        update: '수정',
        delete: '삭제',
        deploy: '배포',
        login: '로그인',
        logout: '로그아웃',
        publish: '발행',
        command: '명령 전송'
    };
    return texts[action] || action;
}

/**
 * Format relative time (e.g., "5분 전")
 */
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

    return formatDateTime(dateStr);
}

/**
 * Format datetime
 */
function formatDateTime(dateStr) {
    if (!dateStr) return '-';
    const date = new Date(dateStr);
    const month = date.getMonth() + 1;
    const day = date.getDate();
    const hours = String(date.getHours()).padStart(2, '0');
    const mins = String(date.getMinutes()).padStart(2, '0');
    return `${month}/${day} ${hours}:${mins}`;
}

/**
 * Load device status chart from API
 */
async function loadDeviceStatusChart() {
    if (typeof Chart === 'undefined') {
        cerror('Chart.js not loaded');
        return;
    }

    try {
        const response = await V3Api.get('/dashboard/device-status');

        // API returns { labels, data, colors }
        let labels = ['온라인', '오프라인', '점검중'];
        let data = [0, 0, 0];
        let colors = [
            'rgba(80, 205, 137, 0.8)',
            'rgba(241, 65, 108, 0.8)',
            'rgba(255, 199, 0, 0.8)'
        ];

        if (response.success && response.data) {
            labels = response.data.labels || labels;
            data = response.data.data || data;
            colors = response.data.colors || colors;
        }

        const deviceCtx = document.getElementById('device-status-chart');
        if (!deviceCtx) return;

        // Destroy existing chart if exists
        if (window.dashboardCharts.deviceStatus) {
            window.dashboardCharts.deviceStatus.destroy();
        }

        window.dashboardCharts.deviceStatus = new Chart(deviceCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                cutout: '70%'
            }
        });
    } catch (e) {
        cerror('Device status chart load failed:', e);
    }
}

/**
 * Load deployment history chart from API
 */
async function loadDeploymentHistoryChart() {
    if (typeof Chart === 'undefined') {
        cerror('Chart.js not loaded');
        return;
    }

    try {
        const response = await V3Api.get('/dashboard/deployment-history');

        // API returns { labels: [...], data: [...] }
        let labels = [];
        let data = [];

        if (response.success && response.data) {
            labels = response.data.labels || [];
            data = response.data.data || [];
        }

        // If no data, show last 7 days with zeros
        if (labels.length === 0) {
            for (let i = 6; i >= 0; i--) {
                const d = new Date();
                d.setDate(d.getDate() - i);
                labels.push(`${d.getMonth() + 1}/${d.getDate()}`);
                data.push(0);
            }
        }

        const deployCtx = document.getElementById('deployment-chart');
        if (!deployCtx) return;

        // Destroy existing chart if exists
        if (window.dashboardCharts.deploymentHistory) {
            window.dashboardCharts.deploymentHistory.destroy();
        }

        window.dashboardCharts.deploymentHistory = new Chart(deployCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: '배포 횟수',
                    data: data,
                    borderColor: 'rgba(0, 158, 247, 1)',
                    backgroundColor: 'rgba(0, 158, 247, 0.1)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    } catch (e) {
        cerror('Deployment history chart load failed:', e);
    }
}

/**
 * Show dashboard error state
 */
function showDashboardError() {
    // Stats show dash
    ['stat-projects', 'stat-devices', 'stat-deployments', 'stat-alerts'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.textContent = '-';
    });

    // Tables show error
    const tbody = document.querySelector('#recent-projects-table tbody');
    if (tbody) {
        tbody.innerHTML = `
            <tr>
                <td colspan="4" style="text-align: center; padding: 40px; color: var(--text-danger);">
                    <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                    데이터를 불러올 수 없습니다
                </td>
            </tr>
        `;
    }

    const activities = document.getElementById('recent-activities');
    if (activities) {
        activities.innerHTML = `
            <div style="text-align: center; padding: 40px; color: var(--text-danger);">
                <i class="fas fa-exclamation-circle" style="font-size: 24px; margin-bottom: 8px; display: block;"></i>
                데이터를 불러올 수 없습니다
            </div>
        `;
    }
}

/**
 * Refresh dashboard data (can be called from outside)
 */
function refreshDashboard() {
    loadDashboardData();
}
</script>
