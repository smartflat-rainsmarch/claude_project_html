<?php
/**
 * SmartFlat CMS v3 - Dashboard API
 *
 * GET /api/v3/dashboard           - Get dashboard summary
 * GET /api/v3/dashboard/stats     - Get statistics
 * GET /api/v3/dashboard/recent-deployments - Get recent deployments
 * GET /api/v3/dashboard/recent-errors - Get recent errors
 * GET /api/v3/dashboard/device-status - Get device status chart data
 */

switch ($request['method']) {
    case 'GET':
        if ($request['action']) {
            handleDashboardAction($request['action'], $request['query']);
        } else {
            getDashboardSummary($request['query']);
        }
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * Handle dashboard actions
 */
function handleDashboardAction($action, $query) {
    switch ($action) {
        case 'stats':
            getDashboardStats($query);
            break;
        case 'recent-deployments':
            getRecentDeployments($query);
            break;
        case 'recent-errors':
            getRecentErrors($query);
            break;
        case 'device-status':
            getDeviceStatusChart($query);
            break;
        case 'deployment-history':
            getDeploymentHistory($query);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Get dashboard summary (all data in one call)
 */
function getDashboardSummary($query) {
    $groupId = !empty($query['group_id']) ? (int)$query['group_id'] : null;

    // Build project filter
    $projectFilter = '';
    $projectParams = [];

    if ($groupId) {
        $projectFilter = 'WHERE p.group_id = ?';
        $projectParams = [$groupId];
    }

    // Get project count
    $projectCount = db()->fetchColumn(
        "SELECT COUNT(*) FROM sf_projects p {$projectFilter}",
        $projectParams
    );

    // Get device stats
    $deviceStats = db()->fetchOne("
        SELECT
            COUNT(*) as total,
            SUM(CASE WHEN d.status = 'online' THEN 1 ELSE 0 END) as online,
            SUM(CASE WHEN d.status = 'offline' THEN 1 ELSE 0 END) as offline,
            SUM(CASE WHEN d.status = 'warning' THEN 1 ELSE 0 END) as warning,
            SUM(CASE WHEN d.status = 'unknown' THEN 1 ELSE 0 END) as unknown
        FROM sf_devices d
        " . ($groupId ? "JOIN sf_projects p ON d.project_id = p.id WHERE p.group_id = ?" : ""),
        $groupId ? [$groupId] : []
    );

    // Get today's deployment count
    $todayDeployments = db()->fetchColumn("
        SELECT COUNT(*)
        FROM sf_deployments d
        " . ($groupId ? "JOIN sf_projects p ON d.project_id = p.id WHERE p.group_id = ? AND " : "WHERE ") . "
        DATE(d.created_at) = CURDATE()
    ", $groupId ? [$groupId] : []);

    // Get alert count (unresolved)
    $alertCount = db()->fetchColumn("
        SELECT COUNT(*)
        FROM sf_alerts a
        " . ($groupId ? "JOIN sf_projects p ON a.project_id = p.id WHERE p.group_id = ? AND " : "WHERE ") . "
        a.is_resolved = 0
    ", $groupId ? [$groupId] : []);

    // Get recent projects
    $recentProjects = db()->fetchAll("
        SELECT
            p.id,
            p.name,
            p.status,
            p.device_count,
            p.last_deploy_at,
            (SELECT COUNT(*) FROM sf_devices WHERE project_id = p.id AND status = 'online') as online_count
        FROM sf_projects p
        {$projectFilter}
        ORDER BY p.updated_at DESC
        LIMIT 5
    ", $projectParams);

    // Get recent activities
    $recentActivities = db()->fetchAll("
        SELECT
            al.id,
            al.action_type,
            al.target_type,
            al.target_name,
            al.summary,
            al.created_at,
            u.name as user_name
        FROM sf_audit_logs al
        LEFT JOIN sf_users u ON al.user_id = u.idx
        ORDER BY al.created_at DESC
        LIMIT 10
    ");

    ApiResponse::success([
        'stats' => [
            'projects' => (int)$projectCount,
            'devices' => [
                'total' => (int)$deviceStats['total'],
                'online' => (int)$deviceStats['online'],
                'offline' => (int)$deviceStats['offline'],
                'warning' => (int)$deviceStats['warning']
            ],
            'today_deployments' => (int)$todayDeployments,
            'alerts' => (int)$alertCount
        ],
        'recent_projects' => $recentProjects,
        'recent_activities' => $recentActivities
    ]);
}

/**
 * Get dashboard statistics
 */
function getDashboardStats($query) {
    $groupId = !empty($query['group_id']) ? (int)$query['group_id'] : null;

    $projectCount = db()->fetchColumn("SELECT COUNT(*) FROM sf_projects");

    $deviceStats = db()->fetchOne("
        SELECT
            COUNT(*) as total,
            SUM(CASE WHEN status = 'online' THEN 1 ELSE 0 END) as online,
            SUM(CASE WHEN status = 'offline' THEN 1 ELSE 0 END) as offline,
            SUM(CASE WHEN status = 'warning' THEN 1 ELSE 0 END) as warning
        FROM sf_devices
    ");

    $todayDeployments = db()->fetchColumn("
        SELECT COUNT(*) FROM sf_deployments WHERE DATE(created_at) = CURDATE()
    ");

    $alertCount = db()->fetchColumn("
        SELECT COUNT(*) FROM sf_alerts WHERE is_resolved = 0
    ");

    ApiResponse::success([
        'projects' => (int)$projectCount,
        'devices' => [
            'total' => (int)$deviceStats['total'],
            'online' => (int)$deviceStats['online'],
            'offline' => (int)$deviceStats['offline'],
            'warning' => (int)$deviceStats['warning']
        ],
        'today_deployments' => (int)$todayDeployments,
        'alerts' => (int)$alertCount
    ]);
}

/**
 * Get recent deployments
 */
function getRecentDeployments($query) {
    $limit = min(20, max(1, (int)($query['limit'] ?? 10)));

    $deployments = db()->fetchAll("
        SELECT
            d.id,
            d.project_id,
            d.deploy_type,
            d.target_type,
            d.status,
            d.success_count,
            d.fail_count,
            d.total_count,
            d.created_at,
            d.completed_at,
            p.name as project_name,
            u.name as created_by_name
        FROM sf_deployments d
        LEFT JOIN sf_projects p ON d.project_id = p.id
        LEFT JOIN sf_users u ON d.created_by = u.idx
        ORDER BY d.created_at DESC
        LIMIT ?
    ", [$limit]);

    ApiResponse::success($deployments);
}

/**
 * Get recent errors/alerts
 */
function getRecentErrors($query) {
    $limit = min(20, max(1, (int)($query['limit'] ?? 10)));

    $alerts = db()->fetchAll("
        SELECT
            a.id,
            a.project_id,
            a.device_id,
            a.alert_type,
            a.severity,
            a.title,
            a.message,
            a.is_resolved,
            a.created_at,
            p.name as project_name,
            d.name as device_name
        FROM sf_alerts a
        LEFT JOIN sf_projects p ON a.project_id = p.id
        LEFT JOIN sf_devices d ON a.device_id = d.id
        WHERE a.severity IN ('error', 'critical')
        ORDER BY a.created_at DESC
        LIMIT ?
    ", [$limit]);

    ApiResponse::success($alerts);
}

/**
 * Get device status for chart
 */
function getDeviceStatusChart($query) {
    $stats = db()->fetchOne("
        SELECT
            SUM(CASE WHEN status = 'online' THEN 1 ELSE 0 END) as online,
            SUM(CASE WHEN status = 'offline' THEN 1 ELSE 0 END) as offline,
            SUM(CASE WHEN status = 'warning' THEN 1 ELSE 0 END) as warning,
            SUM(CASE WHEN status = 'unknown' THEN 1 ELSE 0 END) as unknown
        FROM sf_devices
    ");

    ApiResponse::success([
        'labels' => ['온라인', '오프라인', '점검중', '알수없음'],
        'data' => [
            (int)$stats['online'],
            (int)$stats['offline'],
            (int)$stats['warning'],
            (int)$stats['unknown']
        ],
        'colors' => [
            'rgba(80, 205, 137, 0.8)',
            'rgba(241, 65, 108, 0.8)',
            'rgba(255, 199, 0, 0.8)',
            'rgba(150, 150, 150, 0.8)'
        ]
    ]);
}

/**
 * Get deployment history for chart (last 7 days)
 */
function getDeploymentHistory($query) {
    $days = min(30, max(7, (int)($query['days'] ?? 7)));

    $history = db()->fetchAll("
        SELECT
            DATE(created_at) as date,
            COUNT(*) as count,
            SUM(CASE WHEN status = 'success' THEN 1 ELSE 0 END) as success,
            SUM(CASE WHEN status IN ('failed', 'partial_fail') THEN 1 ELSE 0 END) as failed
        FROM sf_deployments
        WHERE created_at >= DATE_SUB(CURDATE(), INTERVAL ? DAY)
        GROUP BY DATE(created_at)
        ORDER BY date ASC
    ", [$days]);

    // Fill in missing dates
    $result = [];
    $labels = [];
    $data = [];

    for ($i = $days - 1; $i >= 0; $i--) {
        $date = date('Y-m-d', strtotime("-{$i} days"));
        $shortDate = date('n/j', strtotime($date));
        $labels[] = $shortDate;

        $found = array_filter($history, function($item) use ($date) {
            return $item['date'] === $date;
        });

        if ($found) {
            $item = array_values($found)[0];
            $data[] = (int)$item['count'];
        } else {
            $data[] = 0;
        }
    }

    ApiResponse::success([
        'labels' => $labels,
        'data' => $data
    ]);
}
?>
