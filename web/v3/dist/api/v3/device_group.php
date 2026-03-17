<?php
/**
 * SmartFlat CMS v3 - Device Group API
 *
 * GET    /api/v3/device-groups              - List device groups
 * GET    /api/v3/device-groups/{id}         - Get device group
 * POST   /api/v3/device-groups              - Create device group
 * PUT    /api/v3/device-groups/{id}         - Update device group
 * DELETE /api/v3/device-groups/{id}         - Delete device group
 * PUT    /api/v3/device-groups/{id}/devices - Assign devices to group
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id']) {
            getDeviceGroup($request['id']);
        } else {
            listDeviceGroups($request['query']);
        }
        break;

    case 'POST':
        Auth::requireRole(Auth::ROLE_DEVICE_MANAGER);
        createDeviceGroup($request['input']);
        break;

    case 'PUT':
        Auth::requireRole(Auth::ROLE_DEVICE_MANAGER);
        if ($request['action'] === 'devices') {
            assignDevicesToGroup($request['id'], $request['input']);
        } else {
            updateDeviceGroup($request['id'], $request['input']);
        }
        break;

    case 'DELETE':
        Auth::requireRole(Auth::ROLE_ADMIN);
        deleteDeviceGroup($request['id']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List device groups
 */
function listDeviceGroups($query) {
    $where = ['1=1'];
    $params = [];

    // Project filter
    if (!empty($query['project_id'])) {
        $where[] = 'dg.project_id = ?';
        $params[] = (int)$query['project_id'];
    }

    $whereClause = implode(' AND ', $where);

    $sql = "
        SELECT
            dg.*,
            p.name as project_name,
            (SELECT COUNT(*) FROM sf_devices WHERE group_id = dg.id) as device_count
        FROM sf_device_groups dg
        LEFT JOIN sf_projects p ON dg.project_id = p.id
        WHERE {$whereClause}
        ORDER BY dg.project_id, dg.sort_order, dg.name
    ";

    $groups = db()->fetchAll($sql, $params);

    ApiResponse::success($groups);
}

/**
 * Get single device group
 */
function getDeviceGroup($id) {
    $sql = "
        SELECT
            dg.*,
            p.name as project_name
        FROM sf_device_groups dg
        LEFT JOIN sf_projects p ON dg.project_id = p.id
        WHERE dg.id = ?
    ";

    $group = db()->fetchOne($sql, [$id]);

    if (!$group) {
        ApiResponse::notFound('기기 그룹을 찾을 수 없습니다.');
    }

    // Get devices in group
    $devices = db()->fetchAll("
        SELECT id, device_key, name, status, last_heartbeat
        FROM sf_devices
        WHERE group_id = ?
        ORDER BY name
    ", [$id]);

    $group['devices'] = $devices;

    ApiResponse::success($group);
}

/**
 * Create device group
 */
function createDeviceGroup($input) {
    $errors = [];

    if (empty($input['project_id'])) {
        $errors[] = ['field' => 'project_id', 'message' => '프로젝트는 필수입니다.'];
    }

    if (empty($input['group_key'])) {
        $errors[] = ['field' => 'group_key', 'message' => '그룹 키는 필수입니다.'];
    }

    if (empty($input['name'])) {
        $errors[] = ['field' => 'name', 'message' => '그룹명은 필수입니다.'];
    }

    if (!empty($errors)) {
        ApiResponse::validationError($errors);
    }

    // Check duplicate
    $existing = db()->fetchOne(
        "SELECT id FROM sf_device_groups WHERE project_id = ? AND group_key = ?",
        [$input['project_id'], $input['group_key']]
    );

    if ($existing) {
        ApiResponse::error('이 프로젝트에 이미 존재하는 그룹 키입니다.', 409);
    }

    $data = [
        'project_id' => (int)$input['project_id'],
        'group_key' => $input['group_key'],
        'name' => $input['name'],
        'description' => $input['description'] ?? null,
        'sort_order' => (int)($input['sort_order'] ?? 0),
        'created_by' => Auth::id()
    ];

    $id = db()->insert('sf_device_groups', $data);

    AuditLogger::logCreate('device_group', $id, $data, $input['name']);

    getDeviceGroup($id);
}

/**
 * Update device group
 */
function updateDeviceGroup($id, $input) {
    $group = db()->fetchOne("SELECT * FROM sf_device_groups WHERE id = ?", [$id]);

    if (!$group) {
        ApiResponse::notFound('기기 그룹을 찾을 수 없습니다.');
    }

    $data = [];
    $allowedFields = ['name', 'description', 'sort_order', 'is_active'];

    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field];
        }
    }

    if (empty($data)) {
        ApiResponse::error('변경할 데이터가 없습니다.', 400);
    }

    db()->update('sf_device_groups', $data, 'id = ?', [$id]);

    AuditLogger::logUpdate('device_group', $id, $group, array_merge($group, $data), $group['name']);

    getDeviceGroup($id);
}

/**
 * Delete device group
 */
function deleteDeviceGroup($id) {
    $group = db()->fetchOne("SELECT * FROM sf_device_groups WHERE id = ?", [$id]);

    if (!$group) {
        ApiResponse::notFound('기기 그룹을 찾을 수 없습니다.');
    }

    // Remove group assignment from devices
    db()->update('sf_devices', ['group_id' => null], 'group_id = ?', [$id]);

    // Delete group
    db()->delete('sf_device_groups', 'id = ?', [$id]);

    AuditLogger::logDelete('device_group', $id, $group, $group['name']);

    ApiResponse::success(null, '기기 그룹이 삭제되었습니다.');
}

/**
 * Assign devices to group
 */
function assignDevicesToGroup($id, $input) {
    $group = db()->fetchOne("SELECT * FROM sf_device_groups WHERE id = ?", [$id]);

    if (!$group) {
        ApiResponse::notFound('기기 그룹을 찾을 수 없습니다.');
    }

    $deviceIds = $input['device_ids'] ?? [];

    if (!is_array($deviceIds)) {
        ApiResponse::error('device_ids는 배열이어야 합니다.', 400);
    }

    db()->beginTransaction();

    try {
        // Remove all devices from this group first
        db()->update('sf_devices', ['group_id' => null], 'group_id = ?', [$id]);

        // Assign new devices
        if (!empty($deviceIds)) {
            $placeholders = implode(',', array_fill(0, count($deviceIds), '?'));
            db()->query(
                "UPDATE sf_devices SET group_id = ? WHERE id IN ({$placeholders}) AND project_id = ?",
                array_merge([$id], $deviceIds, [$group['project_id']])
            );
        }

        db()->commit();

        AuditLogger::log('update', 'device_group', $id, [
            'target_name' => $group['name'],
            'summary' => count($deviceIds) . '개 기기 할당'
        ]);

        getDeviceGroup($id);
    } catch (Exception $e) {
        db()->rollback();
        throw $e;
    }
}
?>
