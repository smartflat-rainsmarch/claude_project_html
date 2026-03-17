<?php
/**
 * SmartFlat CMS v3 - Deployment API
 *
 * GET    /api/v3/deployments              - List deployments
 * GET    /api/v3/deployments/{id}         - Get deployment
 * POST   /api/v3/deployments              - Create deployment
 * POST   /api/v3/deployments/{id}/retry   - Retry failed deployment
 * POST   /api/v3/deployments/{id}/cancel  - Cancel deployment
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id']) {
            getDeployment($request['id']);
        } else {
            listDeployments($request['query']);
        }
        break;

    case 'POST':
        Auth::requireRole(Auth::ROLE_OPERATOR);
        if ($request['id'] && $request['action']) {
            handleDeploymentAction($request);
        } else {
            createDeployment($request['input']);
        }
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List deployments with filters
 */
function listDeployments($query) {
    $page = max(1, (int)($query['page'] ?? 1));
    $limit = min(100, max(1, (int)($query['limit'] ?? 20)));
    $offset = ($page - 1) * $limit;

    // Build WHERE clause
    $where = ['1=1'];
    $params = [];

    // Project filter
    if (!empty($query['project_id'])) {
        $where[] = 'd.project_id = ?';
        $params[] = (int)$query['project_id'];
    }

    // Status filter
    if (!empty($query['status'])) {
        $where[] = 'd.status = ?';
        $params[] = $query['status'];
    }

    // Date range filter
    if (!empty($query['start_date'])) {
        $where[] = 'd.created_at >= ?';
        $params[] = $query['start_date'] . ' 00:00:00';
    }

    if (!empty($query['end_date'])) {
        $where[] = 'd.created_at <= ?';
        $params[] = $query['end_date'] . ' 23:59:59';
    }

    $whereClause = implode(' AND ', $where);

    // Get total count
    $countSql = "SELECT COUNT(*) FROM sf_deployments d WHERE {$whereClause}";
    $total = (int)db()->fetchColumn($countSql, $params);

    // Get items
    $sql = "
        SELECT
            d.id,
            d.project_id,
            d.deploy_type,
            d.target_type,
            d.content_version,
            d.status,
            d.total_count,
            d.success_count,
            d.fail_count,
            d.memo,
            d.scheduled_at,
            d.started_at,
            d.completed_at,
            d.created_at,
            p.name as project_name,
            u.name as created_by_name
        FROM sf_deployments d
        LEFT JOIN sf_projects p ON d.project_id = p.id
        LEFT JOIN sf_users u ON d.created_by = u.idx
        WHERE {$whereClause}
        ORDER BY d.created_at DESC
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

/**
 * Get single deployment with results
 */
function getDeployment($id) {
    $sql = "
        SELECT
            d.*,
            p.name as project_name,
            u.name as created_by_name
        FROM sf_deployments d
        LEFT JOIN sf_projects p ON d.project_id = p.id
        LEFT JOIN sf_users u ON d.created_by = u.idx
        WHERE d.id = ?
    ";

    $deployment = db()->fetchOne($sql, [$id]);

    if (!$deployment) {
        ApiResponse::notFound('배포를 찾을 수 없습니다.');
    }

    // Parse target_ids JSON
    if (!empty($deployment['target_ids'])) {
        $deployment['target_ids'] = json_decode($deployment['target_ids'], true);
    }

    // Get deployment results
    $results = db()->fetchAll("
        SELECT
            r.*,
            dv.name as device_name,
            dv.device_key
        FROM sf_deployment_results r
        JOIN sf_devices dv ON r.device_id = dv.id
        WHERE r.deployment_id = ?
        ORDER BY r.status DESC, dv.name ASC
    ", [$id]);

    $deployment['results'] = $results;

    ApiResponse::success($deployment);
}

/**
 * Handle deployment actions
 */
function handleDeploymentAction($request) {
    $id = $request['id'];
    $action = $request['action'];

    switch ($action) {
        case 'retry':
            retryDeployment($id);
            break;
        case 'cancel':
            cancelDeployment($id);
            break;
        case 'rollback':
            rollbackDeployment($id);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Create new deployment
 */
function createDeployment($input) {
    // Validate required fields
    $errors = [];

    if (empty($input['project_id'])) {
        $errors[] = ['field' => 'project_id', 'message' => '프로젝트는 필수입니다.'];
    }

    if (!empty($errors)) {
        ApiResponse::validationError($errors);
    }

    // Check project exists
    $project = db()->fetchOne("SELECT * FROM sf_projects WHERE id = ?", [$input['project_id']]);
    if (!$project) {
        ApiResponse::error('프로젝트를 찾을 수 없습니다.', 404);
    }

    // Get target devices
    $targetType = $input['target_type'] ?? 'all';
    $targetIds = $input['target_ids'] ?? [];

    $deviceWhere = 'project_id = ?';
    $deviceParams = [$input['project_id']];

    if ($targetType === 'group' && !empty($targetIds)) {
        $placeholders = implode(',', array_fill(0, count($targetIds), '?'));
        $deviceWhere .= " AND group_id IN ({$placeholders})";
        $deviceParams = array_merge($deviceParams, $targetIds);
    } elseif ($targetType === 'device' && !empty($targetIds)) {
        $placeholders = implode(',', array_fill(0, count($targetIds), '?'));
        $deviceWhere .= " AND id IN ({$placeholders})";
        $deviceParams = array_merge($deviceParams, $targetIds);
    }

    $devices = db()->fetchAll("SELECT id, name, fcm_token FROM sf_devices WHERE {$deviceWhere}", $deviceParams);

    if (empty($devices)) {
        ApiResponse::error('배포 대상 기기가 없습니다.', 400);
    }

    // Get current content version
    $contentVersion = db()->fetchColumn(
        "SELECT MAX(current_version) FROM sf_contents WHERE project_id = ? AND status = 'published'",
        [$input['project_id']]
    ) ?? 1;

    db()->beginTransaction();

    try {
        // Create deployment
        $deploymentData = [
            'project_id' => (int)$input['project_id'],
            'deploy_type' => $input['deploy_type'] ?? 'content',
            'target_type' => $targetType,
            'target_ids' => !empty($targetIds) ? json_encode($targetIds) : null,
            'content_version' => $contentVersion,
            'status' => 'queued',
            'total_count' => count($devices),
            'memo' => $input['memo'] ?? null,
            'scheduled_at' => $input['scheduled_at'] ?? null,
            'created_by' => Auth::id()
        ];

        $deploymentId = db()->insert('sf_deployments', $deploymentData);

        // Create deployment results for each device
        foreach ($devices as $device) {
            db()->insert('sf_deployment_results', [
                'deployment_id' => $deploymentId,
                'device_id' => $device['id'],
                'status' => 'pending'
            ]);
        }

        // Update deployment status to running (if immediate)
        if (empty($input['scheduled_at'])) {
            db()->update('sf_deployments', [
                'status' => 'running',
                'started_at' => date('Y-m-d H:i:s')
            ], 'id = ?', [$deploymentId]);

            // TODO: Actually send push notifications to devices
            // For now, simulate success
            simulateDeployment($deploymentId);
        }

        db()->commit();

        // Log audit
        AuditLogger::logDeploy($input['project_id'], $deploymentId, "배포 생성: {$project['name']}");

        getDeployment($deploymentId);
    } catch (Exception $e) {
        db()->rollback();
        throw $e;
    }
}

/**
 * Simulate deployment (for development)
 */
function simulateDeployment($deploymentId) {
    // Get all pending results
    $results = db()->fetchAll("SELECT id FROM sf_deployment_results WHERE deployment_id = ?", [$deploymentId]);

    $success = 0;
    $fail = 0;

    foreach ($results as $result) {
        // Simulate 90% success rate
        $isSuccess = (rand(1, 100) <= 90);

        db()->update('sf_deployment_results', [
            'status' => $isSuccess ? 'applied' : 'failed',
            'sent_at' => date('Y-m-d H:i:s'),
            'received_at' => $isSuccess ? date('Y-m-d H:i:s') : null,
            'applied_at' => $isSuccess ? date('Y-m-d H:i:s') : null,
            'error_message' => $isSuccess ? null : 'Connection timeout'
        ], 'id = ?', [$result['id']]);

        if ($isSuccess) {
            $success++;
        } else {
            $fail++;
        }
    }

    // Update deployment status
    $status = $fail === 0 ? 'success' : ($success === 0 ? 'failed' : 'partial_fail');

    db()->update('sf_deployments', [
        'status' => $status,
        'success_count' => $success,
        'fail_count' => $fail,
        'completed_at' => date('Y-m-d H:i:s')
    ], 'id = ?', [$deploymentId]);

    // Update project last deploy time
    $deployment = db()->fetchOne("SELECT project_id FROM sf_deployments WHERE id = ?", [$deploymentId]);
    db()->update('sf_projects', ['last_deploy_at' => date('Y-m-d H:i:s')], 'id = ?', [$deployment['project_id']]);
}

/**
 * Retry failed deployment
 */
function retryDeployment($id) {
    $deployment = db()->fetchOne("SELECT * FROM sf_deployments WHERE id = ?", [$id]);

    if (!$deployment) {
        ApiResponse::notFound('배포를 찾을 수 없습니다.');
    }

    if (!in_array($deployment['status'], ['failed', 'partial_fail'])) {
        ApiResponse::error('실패한 배포만 재시도할 수 있습니다.', 400);
    }

    // Get failed devices
    $failedResults = db()->fetchAll("
        SELECT r.id, r.device_id
        FROM sf_deployment_results r
        WHERE r.deployment_id = ? AND r.status = 'failed'
    ", [$id]);

    if (empty($failedResults)) {
        ApiResponse::error('재시도할 기기가 없습니다.', 400);
    }

    db()->beginTransaction();

    try {
        // Reset failed results
        foreach ($failedResults as $result) {
            db()->update('sf_deployment_results', [
                'status' => 'pending',
                'error_code' => null,
                'error_message' => null,
                'sent_at' => null,
                'received_at' => null,
                'applied_at' => null
            ], 'id = ?', [$result['id']]);
        }

        // Update deployment status
        db()->update('sf_deployments', [
            'status' => 'running',
            'fail_count' => 0
        ], 'id = ?', [$id]);

        // TODO: Actually resend to devices
        simulateDeployment($id);

        db()->commit();

        // Log audit
        AuditLogger::log('retry', 'deployment', $id, [
            'summary' => '배포 재시도'
        ]);

        getDeployment($id);
    } catch (Exception $e) {
        db()->rollback();
        throw $e;
    }
}

/**
 * Cancel deployment
 */
function cancelDeployment($id) {
    $deployment = db()->fetchOne("SELECT * FROM sf_deployments WHERE id = ?", [$id]);

    if (!$deployment) {
        ApiResponse::notFound('배포를 찾을 수 없습니다.');
    }

    if (!in_array($deployment['status'], ['created', 'queued'])) {
        ApiResponse::error('대기 중인 배포만 취소할 수 있습니다.', 400);
    }

    db()->update('sf_deployments', [
        'status' => 'cancelled',
        'completed_at' => date('Y-m-d H:i:s')
    ], 'id = ?', [$id]);

    // Log audit
    AuditLogger::log('cancel', 'deployment', $id, [
        'summary' => '배포 취소'
    ]);

    getDeployment($id);
}

/**
 * Rollback deployment
 */
function rollbackDeployment($id) {
    $deployment = db()->fetchOne("SELECT * FROM sf_deployments WHERE id = ?", [$id]);

    if (!$deployment) {
        ApiResponse::notFound('배포를 찾을 수 없습니다.');
    }

    // Find previous successful deployment
    $previousDeployment = db()->fetchOne("
        SELECT * FROM sf_deployments
        WHERE project_id = ?
        AND id < ?
        AND status = 'success'
        ORDER BY id DESC
        LIMIT 1
    ", [$deployment['project_id'], $id]);

    if (!$previousDeployment) {
        ApiResponse::error('롤백할 이전 배포가 없습니다.', 400);
    }

    // Create rollback deployment
    $rollbackData = [
        'project_id' => $deployment['project_id'],
        'deploy_type' => 'content',
        'target_type' => 'all',
        'content_version' => $previousDeployment['content_version'],
        'status' => 'queued',
        'total_count' => $deployment['total_count'],
        'memo' => "배포 #{$id}에서 롤백",
        'rollback_from' => $id,
        'created_by' => Auth::id()
    ];

    createDeployment(array_merge($rollbackData, [
        'project_id' => $deployment['project_id']
    ]));
}
?>
