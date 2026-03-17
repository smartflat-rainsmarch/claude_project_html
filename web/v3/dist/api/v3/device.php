<?php
/**
 * SmartFlat CMS v3 - Device API
 *
 * GET    /api/v3/devices              - List devices
 * GET    /api/v3/devices/{id}         - Get device
 * PUT    /api/v3/devices/{id}         - Update device
 * DELETE /api/v3/devices/{id}         - Delete device
 * POST   /api/v3/devices/{id}/command - Send command to device
 * GET    /api/v3/devices/{id}/heartbeats - Get heartbeat history
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id'] && $request['action']) {
            handleDeviceGetAction($request);
        } elseif ($request['id']) {
            getDevice($request['id']);
        } else {
            listDevices($request['query']);
        }
        break;

    case 'POST':
        if ($request['id'] && $request['action']) {
            handleDevicePostAction($request);
        } else {
            Auth::requireRole(Auth::ROLE_DEVICE_MANAGER);
            registerDevice($request['input']);
        }
        break;

    case 'PUT':
        Auth::requireRole(Auth::ROLE_DEVICE_MANAGER);
        updateDevice($request['id'], $request['input']);
        break;

    case 'DELETE':
        Auth::requireRole(Auth::ROLE_ADMIN);
        deleteDevice($request['id']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List devices with filters
 */
function listDevices($query) {
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

    // Group filter
    if (!empty($query['group_id'])) {
        $where[] = 'd.group_id = ?';
        $params[] = (int)$query['group_id'];
    }

    // Status filter
    if (!empty($query['status'])) {
        $where[] = 'd.status = ?';
        $params[] = $query['status'];
    }

    // Search filter
    if (!empty($query['search'])) {
        $where[] = '(d.name LIKE ? OR d.device_key LIKE ? OR d.ip_address LIKE ?)';
        $searchTerm = '%' . $query['search'] . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
    }

    $whereClause = implode(' AND ', $where);

    // Get total count
    $countSql = "SELECT COUNT(*) FROM sf_devices d WHERE {$whereClause}";
    $total = (int)db()->fetchColumn($countSql, $params);

    // Get items
    $sql = "
        SELECT
            d.id,
            d.device_key,
            d.name,
            d.project_id,
            d.group_id,
            d.status,
            d.app_version,
            d.content_version,
            d.last_heartbeat,
            d.ip_address,
            d.location,
            d.registered_at,
            d.updated_at,
            p.name as project_name,
            dg.name as group_name
        FROM sf_devices d
        LEFT JOIN sf_projects p ON d.project_id = p.id
        LEFT JOIN sf_device_groups dg ON d.group_id = dg.id
        WHERE {$whereClause}
        ORDER BY d.name ASC
        LIMIT ? OFFSET ?
    ";

    $params[] = $limit;
    $params[] = $offset;

    $items = db()->fetchAll($sql, $params);

    // Calculate online duration for each device
    foreach ($items as &$item) {
        $item['is_online'] = isDeviceOnline($item['last_heartbeat']);
        $item['offline_duration'] = getOfflineDuration($item['last_heartbeat']);
    }

    ApiResponse::paginated($items, [
        'page' => $page,
        'limit' => $limit,
        'total' => $total,
        'total_pages' => ceil($total / $limit)
    ]);
}

/**
 * Get single device
 */
function getDevice($id) {
    $sql = "
        SELECT
            d.*,
            p.name as project_name,
            p.project_key,
            dg.name as group_name
        FROM sf_devices d
        LEFT JOIN sf_projects p ON d.project_id = p.id
        LEFT JOIN sf_device_groups dg ON d.group_id = dg.id
        WHERE d.id = ?
    ";

    $device = db()->fetchOne($sql, [$id]);

    if (!$device) {
        ApiResponse::notFound('기기를 찾을 수 없습니다.');
    }

    // Parse extra_info JSON
    if (!empty($device['extra_info'])) {
        $device['extra_info'] = json_decode($device['extra_info'], true);
    }

    if (!empty($device['settings'])) {
        $device['settings'] = json_decode($device['settings'], true);
    }

    $device['is_online'] = isDeviceOnline($device['last_heartbeat']);
    $device['offline_duration'] = getOfflineDuration($device['last_heartbeat']);

    ApiResponse::success($device);
}

/**
 * Handle device GET actions
 */
function handleDeviceGetAction($request) {
    $id = $request['id'];
    $action = $request['action'];

    switch ($action) {
        case 'heartbeats':
            getDeviceHeartbeats($id, $request['query']);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Handle device POST actions
 */
function handleDevicePostAction($request) {
    $id = $request['id'];
    $action = $request['action'];

    switch ($action) {
        case 'command':
            Auth::requireRole(Auth::ROLE_DEVICE_MANAGER);
            sendDeviceCommand($id, $request['input']);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Get device heartbeat history
 */
function getDeviceHeartbeats($id, $query) {
    $limit = min(100, max(1, (int)($query['limit'] ?? 50)));

    $heartbeats = db()->fetchAll("
        SELECT *
        FROM sf_device_heartbeats
        WHERE device_id = ?
        ORDER BY created_at DESC
        LIMIT ?
    ", [$id, $limit]);

    // Parse extra_data JSON
    foreach ($heartbeats as &$hb) {
        if (!empty($hb['extra_data'])) {
            $hb['extra_data'] = json_decode($hb['extra_data'], true);
        }
    }

    ApiResponse::success($heartbeats);
}

/**
 * Register new device
 */
function registerDevice($input) {
    // Validate required fields
    $errors = [];

    if (empty($input['device_key'])) {
        $errors[] = ['field' => 'device_key', 'message' => '기기 키는 필수입니다.'];
    }

    if (!empty($errors)) {
        ApiResponse::validationError($errors);
    }

    // Check duplicate key
    $existing = db()->fetchOne("SELECT id FROM sf_devices WHERE device_key = ?", [$input['device_key']]);
    if ($existing) {
        ApiResponse::error('이미 등록된 기기 키입니다.', 409);
    }

    // Prepare data
    $data = [
        'device_key' => $input['device_key'],
        'name' => $input['name'] ?? $input['device_key'],
        'project_id' => !empty($input['project_id']) ? (int)$input['project_id'] : null,
        'group_id' => !empty($input['group_id']) ? (int)$input['group_id'] : null,
        'status' => 'unknown',
        'location' => $input['location'] ?? null
    ];

    $id = db()->insert('sf_devices', $data);

    // Update project device count
    if (!empty($input['project_id'])) {
        updateProjectDeviceCount($input['project_id']);
    }

    // Log audit
    AuditLogger::logCreate('device', $id, $data, $data['name']);

    getDevice($id);
}

/**
 * Update device
 */
function updateDevice($id, $input) {
    // Get existing device
    $device = db()->fetchOne("SELECT * FROM sf_devices WHERE id = ?", [$id]);

    if (!$device) {
        ApiResponse::notFound('기기를 찾을 수 없습니다.');
    }

    // Prepare update data
    $data = [];
    $allowedFields = ['name', 'project_id', 'group_id', 'location'];

    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field] !== '' ? $input[$field] : null;
        }
    }

    if (!empty($input['settings'])) {
        $data['settings'] = json_encode($input['settings'], JSON_UNESCAPED_UNICODE);
    }

    if (empty($data)) {
        ApiResponse::error('변경할 데이터가 없습니다.', 400);
    }

    // Update
    db()->update('sf_devices', $data, 'id = ?', [$id]);

    // Update project device counts if project changed
    $oldProjectId = $device['project_id'];
    $newProjectId = $data['project_id'] ?? $oldProjectId;

    if ($oldProjectId != $newProjectId) {
        if ($oldProjectId) {
            updateProjectDeviceCount($oldProjectId);
        }
        if ($newProjectId) {
            updateProjectDeviceCount($newProjectId);
        }
    }

    // Log audit
    AuditLogger::logUpdate('device', $id, $device, array_merge($device, $data), $device['name']);

    getDevice($id);
}

/**
 * Delete device
 */
function deleteDevice($id) {
    $device = db()->fetchOne("SELECT * FROM sf_devices WHERE id = ?", [$id]);

    if (!$device) {
        ApiResponse::notFound('기기를 찾을 수 없습니다.');
    }

    // Delete device (cascades to heartbeats)
    db()->delete('sf_devices', 'id = ?', [$id]);

    // Update project device count
    if (!empty($device['project_id'])) {
        updateProjectDeviceCount($device['project_id']);
    }

    // Log audit
    AuditLogger::logDelete('device', $id, $device, $device['name']);

    ApiResponse::success(null, '기기가 삭제되었습니다.');
}

/**
 * Send command to device
 */
function sendDeviceCommand($id, $input) {
    $device = db()->fetchOne("SELECT * FROM sf_devices WHERE id = ?", [$id]);

    if (!$device) {
        ApiResponse::notFound('기기를 찾을 수 없습니다.');
    }

    $command = $input['command'] ?? '';
    $params = $input['params'] ?? [];

    if (empty($command)) {
        ApiResponse::error('명령어는 필수입니다.', 400);
    }

    // Validate command type
    $validCommands = ['restart_app', 'reboot', 'refresh_content', 'clear_cache', 'screenshot', 'update_app', 'power_off', 'power_on'];
    if (!in_array($command, $validCommands)) {
        ApiResponse::error('유효하지 않은 명령어입니다.', 400);
    }

    // Check if device is online for certain commands
    if (!isDeviceOnline($device['last_heartbeat']) && in_array($command, ['restart_app', 'refresh_content', 'clear_cache', 'screenshot'])) {
        ApiResponse::error('오프라인 기기에는 해당 명령을 보낼 수 없습니다.', 400);
    }

    // TODO: Actually send command via FCM or WebSocket
    // For now, just log the command attempt

    // Log audit
    AuditLogger::log('command', 'device', $id, [
        'target_name' => $device['name'],
        'summary' => "명령 전송: {$command}",
        'after' => ['command' => $command, 'params' => $params]
    ]);

    ApiResponse::success([
        'device_id' => $id,
        'command' => $command,
        'status' => 'sent'
    ], '명령이 전송되었습니다.');
}

/**
 * Check if device is online (heartbeat within 5 minutes)
 */
function isDeviceOnline($lastHeartbeat) {
    if (empty($lastHeartbeat)) {
        return false;
    }

    $threshold = 5 * 60; // 5 minutes
    $lastTime = strtotime($lastHeartbeat);

    return (time() - $lastTime) < $threshold;
}

/**
 * Get offline duration string
 */
function getOfflineDuration($lastHeartbeat) {
    if (empty($lastHeartbeat)) {
        return '알 수 없음';
    }

    $lastTime = strtotime($lastHeartbeat);
    $diff = time() - $lastTime;

    if ($diff < 300) {
        return null; // Online
    }

    if ($diff < 3600) {
        return floor($diff / 60) . '분 전';
    }

    if ($diff < 86400) {
        return floor($diff / 3600) . '시간 전';
    }

    return floor($diff / 86400) . '일 전';
}

/**
 * Update project device count cache
 */
function updateProjectDeviceCount($projectId) {
    $count = db()->fetchColumn("SELECT COUNT(*) FROM sf_devices WHERE project_id = ?", [$projectId]);
    db()->update('sf_projects', ['device_count' => $count], 'id = ?', [$projectId]);
}
?>
