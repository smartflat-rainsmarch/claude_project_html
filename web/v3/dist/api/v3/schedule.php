<?php
/**
 * SmartFlat CMS v3 - Schedule API
 * Manages sf_schedules (power on/off, content, restart schedules)
 *
 * GET    /schedules              - List schedules
 * GET    /schedules/{id}         - Get single schedule
 * POST   /schedules              - Create schedule
 * PUT    /schedules/{id}         - Update schedule
 * DELETE /schedules/{id}         - Delete schedule
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id']) {
            getSchedule((int)$request['id']);
        } else {
            listSchedules($request['query']);
        }
        break;

    case 'POST':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        createSchedule($request['input']);
        break;

    case 'PUT':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        updateSchedule((int)$request['id'], $request['input']);
        break;

    case 'DELETE':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        deleteSchedule((int)$request['id']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List schedules with optional filtering
 */
function listSchedules($query) {
    $where = ['1=1'];
    $params = [];

    if (!empty($query['type'])) {
        $where[] = 'schedule_type = ?';
        $params[] = $query['type'];
    }

    if (!empty($query['project_id'])) {
        $where[] = 'project_id = ?';
        $params[] = (int)$query['project_id'];
    }

    if (isset($query['active'])) {
        $where[] = 'is_active = ?';
        $params[] = (int)$query['active'];
    }

    $whereClause = implode(' AND ', $where);

    $items = db()->fetchAll("
        SELECT *
        FROM sf_schedules
        WHERE {$whereClause}
        ORDER BY created_at DESC
    ", $params);

    // Parse JSON fields
    foreach ($items as &$item) {
        if (!empty($item['schedule_data'])) {
            $item['schedule_data'] = json_decode($item['schedule_data'], true);
        }
        if (!empty($item['target_ids'])) {
            $item['target_ids'] = json_decode($item['target_ids'], true);
        }
    }

    ApiResponse::success($items);
}

/**
 * Get single schedule
 */
function getSchedule($id) {
    $schedule = db()->fetchOne("SELECT * FROM sf_schedules WHERE id = ?", [$id]);
    if (!$schedule) {
        ApiResponse::notFound('스케줄을 찾을 수 없습니다.');
    }

    if (!empty($schedule['schedule_data'])) {
        $schedule['schedule_data'] = json_decode($schedule['schedule_data'], true);
    }
    if (!empty($schedule['target_ids'])) {
        $schedule['target_ids'] = json_decode($schedule['target_ids'], true);
    }

    ApiResponse::success($schedule);
}

/**
 * Create schedule
 */
function createSchedule($input) {
    if (empty($input['name'])) {
        ApiResponse::error('스케줄 이름은 필수입니다.', 400);
    }

    $data = [
        'project_id' => (int)($input['project_id'] ?? 0),
        'schedule_type' => $input['schedule_type'] ?? 'power',
        'name' => $input['name'],
        'is_active' => isset($input['is_active']) ? (int)$input['is_active'] : 1,
        'schedule_data' => json_encode($input['schedule_data'] ?? [], JSON_UNESCAPED_UNICODE),
        'target_type' => $input['target_type'] ?? 'all',
        'target_ids' => !empty($input['target_ids']) ? json_encode($input['target_ids']) : null,
        'created_by' => Auth::id()
    ];

    $id = db()->insert('sf_schedules', $data);

    AuditLogger::logCreate('schedule', $id, $data, $input['name']);

    getSchedule($id);
}

/**
 * Update schedule
 */
function updateSchedule($id, $input) {
    $schedule = db()->fetchOne("SELECT id FROM sf_schedules WHERE id = ?", [$id]);
    if (!$schedule) {
        ApiResponse::notFound('스케줄을 찾을 수 없습니다.');
    }

    $data = [];
    $allowedFields = ['name', 'schedule_type', 'is_active', 'target_type'];
    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field];
        }
    }

    if (isset($input['schedule_data'])) {
        $data['schedule_data'] = json_encode($input['schedule_data'], JSON_UNESCAPED_UNICODE);
    }
    if (isset($input['target_ids'])) {
        $data['target_ids'] = json_encode($input['target_ids']);
    }

    if (!empty($data)) {
        db()->update('sf_schedules', $data, 'id = ?', [$id]);
    }

    getSchedule($id);
}

/**
 * Delete schedule
 */
function deleteSchedule($id) {
    $schedule = db()->fetchOne("SELECT id, name FROM sf_schedules WHERE id = ?", [$id]);
    if (!$schedule) {
        ApiResponse::notFound('스케줄을 찾을 수 없습니다.');
    }

    db()->delete('sf_schedules', 'id = ?', [$id]);

    AuditLogger::logDelete('schedule', $id, $schedule['name']);

    ApiResponse::success(null, '삭제되었습니다.');
}
?>
