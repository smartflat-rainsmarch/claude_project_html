<?php
/**
 * SmartFlat CMS v3 - Project API
 *
 * GET    /api/v3/projects              - List projects
 * GET    /api/v3/projects/{id}         - Get project
 * POST   /api/v3/projects              - Create project
 * PUT    /api/v3/projects/{id}         - Update project
 * DELETE /api/v3/projects/{id}         - Delete project
 * GET    /api/v3/projects/{id}/summary - Get project summary
 * GET    /api/v3/projects/{id}/devices - Get project devices
 * GET    /api/v3/projects/{id}/contents - Get project contents
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id'] && $request['action']) {
            handleProjectAction($request);
        } elseif ($request['id']) {
            getProject($request['id']);
        } else {
            listProjects($request['query']);
        }
        break;

    case 'POST':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        createProject($request['input']);
        break;

    case 'PUT':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        updateProject($request['id'], $request['input']);
        break;

    case 'DELETE':
        Auth::requireRole(Auth::ROLE_ADMIN);
        deleteProject($request['id']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List projects with filters
 */
function listProjects($query) {
    $page = max(1, (int)($query['page'] ?? 1));
    $limit = min(100, max(1, (int)($query['limit'] ?? 20)));
    $offset = ($page - 1) * $limit;

    // Build WHERE clause
    $where = ['1=1'];
    $params = [];

    // Status filter
    if (!empty($query['status'])) {
        $where[] = 'p.status = ?';
        $params[] = $query['status'];
    }

    // Region filter
    if (!empty($query['region'])) {
        $where[] = 'p.region = ?';
        $params[] = $query['region'];
    }

    // Category filter
    if (!empty($query['category'])) {
        $where[] = 'p.category = ?';
        $params[] = $query['category'];
    }

    // Search filter
    if (!empty($query['search'])) {
        $where[] = '(p.name LIKE ? OR p.project_key LIKE ? OR p.description LIKE ?)';
        $searchTerm = '%' . $query['search'] . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
    }

    // Group filter
    if (!empty($query['group_id'])) {
        $where[] = 'p.group_id = ?';
        $params[] = (int)$query['group_id'];
    }

    $whereClause = implode(' AND ', $where);

    // Get total count
    $countSql = "SELECT COUNT(*) FROM sf_projects p WHERE {$whereClause}";
    $total = (int)db()->fetchColumn($countSql, $params);

    // Get items
    $sql = "
        SELECT
            p.id,
            p.project_key,
            p.name,
            p.description,
            p.category,
            p.region,
            p.orientation,
            p.status,
            p.thumbnail,
            p.device_count,
            p.content_count,
            p.last_deploy_at,
            p.created_at,
            p.updated_at,
            pg.name as group_name
        FROM sf_projects p
        LEFT JOIN sf_project_groups pg ON p.group_id = pg.id
        WHERE {$whereClause}
        ORDER BY p.updated_at DESC
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
 * Get single project
 */
function getProject($id) {
    $sql = "
        SELECT
            p.*,
            pg.name as group_name,
            (SELECT COUNT(*) FROM sf_devices WHERE project_id = p.id) as device_count_live,
            (SELECT COUNT(*) FROM sf_contents WHERE project_id = p.id) as content_count_live
        FROM sf_projects p
        LEFT JOIN sf_project_groups pg ON p.group_id = pg.id
        WHERE p.id = ?
    ";

    $project = db()->fetchOne($sql, [$id]);

    if (!$project) {
        ApiResponse::notFound('프로젝트를 찾을 수 없습니다.');
    }

    // Parse settings JSON if exists
    if (!empty($project['settings'])) {
        $project['settings'] = json_decode($project['settings'], true);
    }

    ApiResponse::success($project);
}

/**
 * Handle project actions
 */
function handleProjectAction($request) {
    $id = $request['id'];
    $action = $request['action'];

    switch ($action) {
        case 'summary':
            getProjectSummary($id);
            break;
        case 'devices':
            getProjectDevices($id, $request['query']);
            break;
        case 'contents':
            getProjectContents($id, $request['query']);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Get project summary
 */
function getProjectSummary($id) {
    // Get project basic info
    $project = db()->fetchOne("SELECT * FROM sf_projects WHERE id = ?", [$id]);

    if (!$project) {
        ApiResponse::notFound('프로젝트를 찾을 수 없습니다.');
    }

    // Get device stats
    $deviceStats = db()->fetchOne("
        SELECT
            COUNT(*) as total,
            SUM(CASE WHEN status = 'online' THEN 1 ELSE 0 END) as online,
            SUM(CASE WHEN status = 'offline' THEN 1 ELSE 0 END) as offline,
            SUM(CASE WHEN status = 'warning' THEN 1 ELSE 0 END) as warning
        FROM sf_devices
        WHERE project_id = ?
    ", [$id]);

    // Get content stats
    $contentStats = db()->fetchOne("
        SELECT
            COUNT(*) as total,
            SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) as published,
            SUM(CASE WHEN status = 'draft' THEN 1 ELSE 0 END) as draft
        FROM sf_contents
        WHERE project_id = ?
    ", [$id]);

    // Get recent deployments
    $recentDeployments = db()->fetchAll("
        SELECT id, status, success_count, fail_count, created_at
        FROM sf_deployments
        WHERE project_id = ?
        ORDER BY created_at DESC
        LIMIT 5
    ", [$id]);

    ApiResponse::success([
        'project' => $project,
        'devices' => $deviceStats,
        'contents' => $contentStats,
        'recent_deployments' => $recentDeployments
    ]);
}

/**
 * Get project devices
 */
function getProjectDevices($projectId, $query) {
    $sql = "
        SELECT
            d.*,
            dg.name as group_name
        FROM sf_devices d
        LEFT JOIN sf_device_groups dg ON d.group_id = dg.id
        WHERE d.project_id = ?
        ORDER BY d.name ASC
    ";

    $devices = db()->fetchAll($sql, [$projectId]);

    ApiResponse::success($devices);
}

/**
 * Get project contents
 */
function getProjectContents($projectId, $query) {
    $sql = "
        SELECT *
        FROM sf_contents
        WHERE project_id = ?
        ORDER BY display_order ASC, name ASC
    ";

    $contents = db()->fetchAll($sql, [$projectId]);

    // Parse config_json
    foreach ($contents as &$content) {
        if (!empty($content['config_json'])) {
            $content['config'] = json_decode($content['config_json'], true);
        }
    }

    ApiResponse::success($contents);
}

/**
 * Create project
 */
function createProject($input) {
    // Validate required fields
    $errors = [];

    if (empty($input['project_key'])) {
        $errors[] = ['field' => 'project_key', 'message' => '프로젝트 키는 필수입니다.'];
    } elseif (!preg_match('/^[a-z0-9_-]+$/i', $input['project_key'])) {
        $errors[] = ['field' => 'project_key', 'message' => '프로젝트 키는 영문, 숫자, 언더스코어, 하이픈만 사용 가능합니다.'];
    }

    if (empty($input['name'])) {
        $errors[] = ['field' => 'name', 'message' => '프로젝트명은 필수입니다.'];
    }

    if (!empty($errors)) {
        ApiResponse::validationError($errors);
    }

    // Check duplicate key
    $existing = db()->fetchOne("SELECT id FROM sf_projects WHERE project_key = ?", [$input['project_key']]);
    if ($existing) {
        ApiResponse::error('이미 존재하는 프로젝트 키입니다.', 409);
    }

    // Prepare data
    $data = [
        'project_key' => $input['project_key'],
        'name' => $input['name'],
        'description' => $input['description'] ?? null,
        'category' => $input['category'] ?? null,
        'region' => $input['region'] ?? null,
        'orientation' => $input['orientation'] ?? 'P',
        'width' => (int)($input['width'] ?? 1080),
        'height' => (int)($input['height'] ?? 1920),
        'status' => $input['status'] ?? 'active',
        'group_id' => !empty($input['group_id']) ? (int)$input['group_id'] : null,
        'settings' => !empty($input['settings']) ? json_encode($input['settings'], JSON_UNESCAPED_UNICODE) : null,
        'created_by' => Auth::id()
    ];

    $id = db()->insert('sf_projects', $data);

    // Log audit
    AuditLogger::logCreate('project', $id, $data, $input['name']);

    // Return created project
    getProject($id);
}

/**
 * Update project
 */
function updateProject($id, $input) {
    // Get existing project
    $project = db()->fetchOne("SELECT * FROM sf_projects WHERE id = ?", [$id]);

    if (!$project) {
        ApiResponse::notFound('프로젝트를 찾을 수 없습니다.');
    }

    // Validate
    $errors = [];

    if (isset($input['project_key']) && $input['project_key'] !== $project['project_key']) {
        if (!preg_match('/^[a-z0-9_-]+$/i', $input['project_key'])) {
            $errors[] = ['field' => 'project_key', 'message' => '프로젝트 키는 영문, 숫자, 언더스코어, 하이픈만 사용 가능합니다.'];
        } else {
            $existing = db()->fetchOne("SELECT id FROM sf_projects WHERE project_key = ? AND id != ?", [$input['project_key'], $id]);
            if ($existing) {
                $errors[] = ['field' => 'project_key', 'message' => '이미 존재하는 프로젝트 키입니다.'];
            }
        }
    }

    if (!empty($errors)) {
        ApiResponse::validationError($errors);
    }

    // Prepare update data
    $data = [];
    $allowedFields = ['project_key', 'name', 'description', 'category', 'region', 'orientation', 'width', 'height', 'status', 'group_id', 'thumbnail'];

    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field];
        }
    }

    if (!empty($input['settings'])) {
        $data['settings'] = json_encode($input['settings'], JSON_UNESCAPED_UNICODE);
    }

    if (empty($data)) {
        ApiResponse::error('변경할 데이터가 없습니다.', 400);
    }

    // Update
    db()->update('sf_projects', $data, 'id = ?', [$id]);

    // Log audit
    AuditLogger::logUpdate('project', $id, $project, array_merge($project, $data), $project['name']);

    // Return updated project
    getProject($id);
}

/**
 * Delete project
 */
function deleteProject($id) {
    // Get existing project
    $project = db()->fetchOne("SELECT * FROM sf_projects WHERE id = ?", [$id]);

    if (!$project) {
        ApiResponse::notFound('프로젝트를 찾을 수 없습니다.');
    }

    // Check if has devices
    $deviceCount = db()->fetchColumn("SELECT COUNT(*) FROM sf_devices WHERE project_id = ?", [$id]);
    if ($deviceCount > 0) {
        ApiResponse::error('프로젝트에 연결된 기기가 있어 삭제할 수 없습니다. 먼저 기기를 다른 프로젝트로 이동하거나 삭제해주세요.', 409);
    }

    // Delete project (cascades to contents, deployments, etc.)
    db()->delete('sf_projects', 'id = ?', [$id]);

    // Log audit
    AuditLogger::logDelete('project', $id, $project, $project['name']);

    ApiResponse::success(null, '프로젝트가 삭제되었습니다.');
}
?>
