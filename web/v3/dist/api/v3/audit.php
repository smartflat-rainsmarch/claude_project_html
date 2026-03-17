<?php
/**
 * SmartFlat CMS v3 - Audit Log API
 *
 * GET /api/v3/audit-logs - List audit logs
 */

switch ($request['method']) {
    case 'GET':
        listAuditLogs($request['query']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List audit logs with filters
 */
function listAuditLogs($query) {
    Auth::requireRole(Auth::ROLE_ADMIN);

    $page = max(1, (int)($query['page'] ?? 1));
    $limit = min(100, max(1, (int)($query['limit'] ?? 50)));
    $offset = ($page - 1) * $limit;

    // Build WHERE clause
    $where = ['1=1'];
    $params = [];

    // Action type filter
    if (!empty($query['action_type'])) {
        $where[] = 'al.action_type = ?';
        $params[] = $query['action_type'];
    }

    // Target type filter
    if (!empty($query['target_type'])) {
        $where[] = 'al.target_type = ?';
        $params[] = $query['target_type'];
    }

    // User filter
    if (!empty($query['user_id'])) {
        $where[] = 'al.user_id = ?';
        $params[] = (int)$query['user_id'];
    }

    // Date range filter
    if (!empty($query['start_date'])) {
        $where[] = 'al.created_at >= ?';
        $params[] = $query['start_date'] . ' 00:00:00';
    }

    if (!empty($query['end_date'])) {
        $where[] = 'al.created_at <= ?';
        $params[] = $query['end_date'] . ' 23:59:59';
    }

    // Search filter
    if (!empty($query['search'])) {
        $where[] = '(al.target_name LIKE ? OR al.summary LIKE ?)';
        $searchTerm = '%' . $query['search'] . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm]);
    }

    $whereClause = implode(' AND ', $where);

    // Get total count
    $countSql = "SELECT COUNT(*) FROM sf_audit_logs al WHERE {$whereClause}";
    $total = (int)db()->fetchColumn($countSql, $params);

    // Get items
    $sql = "
        SELECT
            al.id,
            al.user_id,
            al.action_type,
            al.target_type,
            al.target_id,
            al.target_name,
            al.summary,
            al.ip_address,
            al.created_at,
            u.name as user_name
        FROM sf_audit_logs al
        LEFT JOIN sf_users u ON al.user_id = u.idx
        WHERE {$whereClause}
        ORDER BY al.created_at DESC
        LIMIT ? OFFSET ?
    ";

    $params[] = $limit;
    $params[] = $offset;

    $items = db()->fetchAll($sql, $params);

    ApiResponse::paginated($items, [
        'page' => $page,
        'limit' => $limit,
        'total' => $total,
        'total_pages' => ceil($total / $limit)
    ]);
}
?>
