<?php
/**
 * SmartFlat CMS v3 - Home Data API
 * Manages tb_home (screen layout JSON data)
 *
 * GET    /homes                    - List homes (by project)
 * GET    /homes/{id}               - Get single home
 * PUT    /homes/{id}               - Update home data
 * PUT    /homes/{id}/home-data     - Update hm_home_data only
 * PUT    /homes/{id}/main-data     - Update hm_main_data only
 * PUT    /homes/{id}/content-data  - Update hm_content_data only
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id']) {
            getHome((int)$request['id']);
        } else {
            listHomes($request['query']);
        }
        break;

    case 'PUT':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        if ($request['action']) {
            updateHomeField((int)$request['id'], $request['action'], $request['input']);
        } else {
            updateHome((int)$request['id'], $request['input']);
        }
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List homes by project
 */
function listHomes($query) {
    $where = ['1=1'];
    $params = [];

    // Filter by user's projects and group
    $user = Auth::user();
    $userinfo = $user['userinfo'] ?? $user;
    $projectIds = $userinfo['projectids'] ?? '';
    $groupIdx = $userinfo['groupidx'] ?? $user['group_id'] ?? null;

    if (!empty($projectIds)) {
        $projectList = array_unique(array_filter(explode(',', $projectIds)));
        if (count($projectList) > 0) {
            $placeholders = implode(',', array_fill(0, count($projectList), '?'));
            $where[] = "hm_projectid IN ({$placeholders})";
            $params = array_merge($params, $projectList);
        }
    }

    if ($groupIdx !== null && $groupIdx !== '') {
        $where[] = 'hm_gr_idx = ?';
        $params[] = (int)$groupIdx;
    }

    // Allow explicit overrides via query params
    if (!empty($query['project_id'])) {
        $where[] = 'hm_projectid = ?';
        $params[] = $query['project_id'];
    }

    $whereClause = implode(' AND ', $where);

    $items = db()->fetchAll("
        SELECT
            hm_idx,
            hm_projectid,
            hm_projectname,
            hm_orientation,
            hm_width,
            hm_height,
            hm_language,
            hm_all_language,
            hm_region,
            hm_safety_onoff,
            hm_autoupdate,
            hm_gr_idx,
            hm_ch_idx,
            hm_date,
            LENGTH(hm_home_data) as home_data_size,
            LENGTH(hm_main_data) as main_data_size,
            LENGTH(hm_content_data) as content_data_size
        FROM tb_home
        WHERE {$whereClause}
        ORDER BY hm_projectid ASC
    ", $params);

    ApiResponse::success($items);
}

/**
 * Get single home with full JSON data
 */
function getHome($id) {
    $home = db()->fetchOne("SELECT * FROM tb_home WHERE hm_idx = ?", [$id]);

    if (!$home) {
        ApiResponse::notFound('홈 데이터를 찾을 수 없습니다.');
    }

    // Parse JSON fields
    $home['home_data'] = !empty($home['hm_home_data']) ? json_decode($home['hm_home_data'], true) : [];
    $home['main_data'] = !empty($home['hm_main_data']) ? json_decode($home['hm_main_data'], true) : [];
    $home['content_data'] = !empty($home['hm_content_data']) ? json_decode($home['hm_content_data'], true) : [];

    ApiResponse::success($home);
}

/**
 * Update home record
 */
function updateHome($id, $input) {
    $home = db()->fetchOne("SELECT hm_idx FROM tb_home WHERE hm_idx = ?", [$id]);
    if (!$home) {
        ApiResponse::notFound('홈 데이터를 찾을 수 없습니다.');
    }

    $data = [];
    $allowedFields = [
        'hm_projectname', 'hm_orientation', 'hm_width', 'hm_height',
        'hm_language', 'hm_all_language', 'hm_region', 'hm_safety_onoff', 'hm_safety_closetime', 'hm_autoupdate',
        'hm_other'
    ];

    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field];
        }
    }

    // Handle JSON data fields
    if (isset($input['home_data'])) {
        $data['hm_home_data'] = json_encode($input['home_data'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    if (isset($input['main_data'])) {
        $data['hm_main_data'] = json_encode($input['main_data'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    if (isset($input['content_data'])) {
        $data['hm_content_data'] = json_encode($input['content_data'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    if (empty($data)) {
        ApiResponse::error('변경할 데이터가 없습니다.', 400);
    }

    db()->update('tb_home', $data, 'hm_idx = ?', [$id]);

    getHome($id);
}

/**
 * Update a specific JSON field (home-data, main-data, content-data)
 */
function updateHomeField($id, $action, $input) {
    $home = db()->fetchOne("SELECT hm_idx FROM tb_home WHERE hm_idx = ?", [$id]);
    if (!$home) {
        ApiResponse::notFound('홈 데이터를 찾을 수 없습니다.');
    }

    $fieldMap = [
        'home-data' => 'hm_home_data',
        'main-data' => 'hm_main_data',
        'content-data' => 'hm_content_data'
    ];

    if (!isset($fieldMap[$action])) {
        ApiResponse::error('Unknown action', 400);
    }

    $field = $fieldMap[$action];

    if (!isset($input['data'])) {
        ApiResponse::error('data 필드가 필요합니다.', 400);
    }

    $jsonData = json_encode($input['data'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    db()->update('tb_home', [$field => $jsonData], 'hm_idx = ?', [$id]);

    getHome($id);
}
?>
