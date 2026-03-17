<?php
/**
 * SmartFlat CMS v3 - Content API
 *
 * GET    /api/v3/contents              - List contents
 * GET    /api/v3/contents/{id}         - Get content
 * POST   /api/v3/contents              - Create content
 * PUT    /api/v3/contents/{id}         - Update content
 * DELETE /api/v3/contents/{id}         - Delete content
 * POST   /api/v3/contents/{id}/publish - Publish content
 * GET    /api/v3/contents/{id}/versions - Get version history
 */

switch ($request['method']) {
    case 'GET':
        if ($request['id'] && $request['action']) {
            handleContentAction($request);
        } elseif ($request['id']) {
            getContent($request['id']);
        } else {
            listContents($request['query']);
        }
        break;

    case 'POST':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        if ($request['id'] && $request['action']) {
            handleContentPostAction($request);
        } else {
            createContent($request['input']);
        }
        break;

    case 'PUT':
        Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);
        updateContent($request['id'], $request['input']);
        break;

    case 'DELETE':
        Auth::requireRole(Auth::ROLE_ADMIN);
        deleteContent($request['id']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List contents with filters
 */
function listContents($query) {
    $page = max(1, (int)($query['page'] ?? 1));
    $limit = min(100, max(1, (int)($query['limit'] ?? 20)));
    $offset = ($page - 1) * $limit;

    // Build WHERE clause
    $where = ['1=1'];
    $params = [];

    // Project filter
    if (!empty($query['project_id'])) {
        $where[] = 'c.project_id = ?';
        $params[] = (int)$query['project_id'];
    }

    // Type filter
    if (!empty($query['content_type'])) {
        $where[] = 'c.content_type = ?';
        $params[] = $query['content_type'];
    }

    // Status filter
    if (!empty($query['status'])) {
        $where[] = 'c.status = ?';
        $params[] = $query['status'];
    }

    // Search filter
    if (!empty($query['search'])) {
        $where[] = '(c.name LIKE ? OR c.content_key LIKE ?)';
        $searchTerm = '%' . $query['search'] . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm]);
    }

    $whereClause = implode(' AND ', $where);

    // Get total count
    $countSql = "SELECT COUNT(*) FROM sf_contents c WHERE {$whereClause}";
    $total = (int)db()->fetchColumn($countSql, $params);

    // Get items
    $sql = "
        SELECT
            c.id,
            c.project_id,
            c.content_key,
            c.name,
            c.content_type,
            c.status,
            c.current_version,
            c.area_position,
            c.display_order,
            c.schedule_start,
            c.schedule_end,
            c.published_at,
            c.created_at,
            c.updated_at,
            p.name as project_name
        FROM sf_contents c
        LEFT JOIN sf_projects p ON c.project_id = p.id
        WHERE {$whereClause}
        ORDER BY c.project_id, c.display_order ASC
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
 * Get single content
 */
function getContent($id) {
    $sql = "
        SELECT
            c.*,
            p.name as project_name,
            p.project_key
        FROM sf_contents c
        LEFT JOIN sf_projects p ON c.project_id = p.id
        WHERE c.id = ?
    ";

    $content = db()->fetchOne($sql, [$id]);

    if (!$content) {
        ApiResponse::notFound('콘텐츠를 찾을 수 없습니다.');
    }

    // Parse config JSON
    if (!empty($content['config_json'])) {
        $content['config'] = json_decode($content['config_json'], true);
    }

    ApiResponse::success($content);
}

/**
 * Handle content GET actions
 */
function handleContentAction($request) {
    $id = $request['id'];
    $action = $request['action'];

    switch ($action) {
        case 'versions':
            getContentVersions($id);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Handle content POST actions
 */
function handleContentPostAction($request) {
    $id = $request['id'];
    $action = $request['action'];

    switch ($action) {
        case 'publish':
            publishContent($id);
            break;
        case 'rollback':
            rollbackContent($id, $request['input']);
            break;
        default:
            ApiResponse::error('Unknown action', 400);
    }
}

/**
 * Get content version history
 */
function getContentVersions($id) {
    $versions = db()->fetchAll("
        SELECT
            v.*,
            u.name as created_by_name
        FROM sf_content_versions v
        LEFT JOIN sf_users u ON v.created_by = u.idx
        WHERE v.content_id = ?
        ORDER BY v.version_number DESC
    ", [$id]);

    // Parse config JSON for each version
    foreach ($versions as &$version) {
        if (!empty($version['config_json'])) {
            $version['config'] = json_decode($version['config_json'], true);
        }
    }

    ApiResponse::success($versions);
}

/**
 * Create content
 */
function createContent($input) {
    // Validate required fields
    $errors = [];

    if (empty($input['project_id'])) {
        $errors[] = ['field' => 'project_id', 'message' => '프로젝트는 필수입니다.'];
    }

    if (empty($input['content_key'])) {
        $errors[] = ['field' => 'content_key', 'message' => '콘텐츠 키는 필수입니다.'];
    } elseif (!preg_match('/^[a-z0-9_-]+$/i', $input['content_key'])) {
        $errors[] = ['field' => 'content_key', 'message' => '콘텐츠 키는 영문, 숫자, 언더스코어, 하이픈만 사용 가능합니다.'];
    }

    if (empty($input['name'])) {
        $errors[] = ['field' => 'name', 'message' => '콘텐츠명은 필수입니다.'];
    }

    if (empty($input['content_type'])) {
        $errors[] = ['field' => 'content_type', 'message' => '콘텐츠 타입은 필수입니다.'];
    }

    if (!empty($errors)) {
        ApiResponse::validationError($errors);
    }

    // Check project exists
    $project = db()->fetchOne("SELECT id FROM sf_projects WHERE id = ?", [$input['project_id']]);
    if (!$project) {
        ApiResponse::error('프로젝트를 찾을 수 없습니다.', 404);
    }

    // Check duplicate key within project
    $existing = db()->fetchOne(
        "SELECT id FROM sf_contents WHERE project_id = ? AND content_key = ?",
        [$input['project_id'], $input['content_key']]
    );
    if ($existing) {
        ApiResponse::error('이 프로젝트에 이미 존재하는 콘텐츠 키입니다.', 409);
    }

    // Prepare data
    $data = [
        'project_id' => (int)$input['project_id'],
        'content_key' => $input['content_key'],
        'name' => $input['name'],
        'content_type' => $input['content_type'],
        'status' => $input['status'] ?? 'draft',
        'config_json' => !empty($input['config']) ? json_encode($input['config'], JSON_UNESCAPED_UNICODE) : null,
        'area_position' => $input['area_position'] ?? null,
        'display_order' => (int)($input['display_order'] ?? 0),
        'schedule_start' => $input['schedule_start'] ?? null,
        'schedule_end' => $input['schedule_end'] ?? null,
        'created_by' => Auth::id()
    ];

    db()->beginTransaction();

    try {
        $id = db()->insert('sf_contents', $data);

        // Create initial version
        db()->insert('sf_content_versions', [
            'content_id' => $id,
            'version_number' => 1,
            'config_json' => $data['config_json'],
            'change_summary' => '초기 버전',
            'is_current' => 1,
            'created_by' => Auth::id()
        ]);

        db()->commit();

        // Log audit
        AuditLogger::logCreate('content', $id, $data, $input['name']);

        // Return created content
        getContent($id);
    } catch (Exception $e) {
        db()->rollback();
        throw $e;
    }
}

/**
 * Update content
 */
function updateContent($id, $input) {
    // Get existing content
    $content = db()->fetchOne("SELECT * FROM sf_contents WHERE id = ?", [$id]);

    if (!$content) {
        ApiResponse::notFound('콘텐츠를 찾을 수 없습니다.');
    }

    // Prepare update data
    $data = [];
    $allowedFields = ['name', 'content_type', 'status', 'area_position', 'display_order', 'schedule_start', 'schedule_end'];

    foreach ($allowedFields as $field) {
        if (isset($input[$field])) {
            $data[$field] = $input[$field];
        }
    }

    // Handle config update
    $configChanged = false;
    if (isset($input['config'])) {
        $newConfigJson = json_encode($input['config'], JSON_UNESCAPED_UNICODE);
        if ($newConfigJson !== $content['config_json']) {
            $data['config_json'] = $newConfigJson;
            $configChanged = true;
        }
    }

    if (empty($data)) {
        ApiResponse::error('변경할 데이터가 없습니다.', 400);
    }

    db()->beginTransaction();

    try {
        // Update content
        db()->update('sf_contents', $data, 'id = ?', [$id]);

        // Create new version if config changed
        if ($configChanged) {
            $newVersion = $content['current_version'] + 1;

            // Mark old version as not current
            db()->update('sf_content_versions', ['is_current' => 0], 'content_id = ?', [$id]);

            // Create new version
            db()->insert('sf_content_versions', [
                'content_id' => $id,
                'version_number' => $newVersion,
                'config_json' => $data['config_json'],
                'change_summary' => $input['change_summary'] ?? '콘텐츠 수정',
                'is_current' => 1,
                'created_by' => Auth::id()
            ]);

            // Update current version
            db()->update('sf_contents', ['current_version' => $newVersion], 'id = ?', [$id]);
        }

        db()->commit();

        // Log audit
        AuditLogger::logUpdate('content', $id, $content, array_merge($content, $data), $content['name']);

        // Return updated content
        getContent($id);
    } catch (Exception $e) {
        db()->rollback();
        throw $e;
    }
}

/**
 * Delete content
 */
function deleteContent($id) {
    $content = db()->fetchOne("SELECT * FROM sf_contents WHERE id = ?", [$id]);

    if (!$content) {
        ApiResponse::notFound('콘텐츠를 찾을 수 없습니다.');
    }

    // Delete content (cascades to versions)
    db()->delete('sf_contents', 'id = ?', [$id]);

    // Log audit
    AuditLogger::logDelete('content', $id, $content, $content['name']);

    ApiResponse::success(null, '콘텐츠가 삭제되었습니다.');
}

/**
 * Publish content
 */
function publishContent($id) {
    $content = db()->fetchOne("SELECT * FROM sf_contents WHERE id = ?", [$id]);

    if (!$content) {
        ApiResponse::notFound('콘텐츠를 찾을 수 없습니다.');
    }

    if ($content['status'] === 'published') {
        ApiResponse::error('이미 게시된 콘텐츠입니다.', 400);
    }

    db()->update('sf_contents', [
        'status' => 'published',
        'published_at' => date('Y-m-d H:i:s')
    ], 'id = ?', [$id]);

    // Log audit
    AuditLogger::log('publish', 'content', $id, [
        'target_name' => $content['name'],
        'summary' => '콘텐츠 게시'
    ]);

    getContent($id);
}

/**
 * Rollback content to specific version
 */
function rollbackContent($id, $input) {
    $targetVersion = (int)($input['version'] ?? 0);

    if ($targetVersion < 1) {
        ApiResponse::error('버전 번호가 올바르지 않습니다.', 400);
    }

    $content = db()->fetchOne("SELECT * FROM sf_contents WHERE id = ?", [$id]);
    if (!$content) {
        ApiResponse::notFound('콘텐츠를 찾을 수 없습니다.');
    }

    $version = db()->fetchOne(
        "SELECT * FROM sf_content_versions WHERE content_id = ? AND version_number = ?",
        [$id, $targetVersion]
    );

    if (!$version) {
        ApiResponse::error('해당 버전을 찾을 수 없습니다.', 404);
    }

    db()->beginTransaction();

    try {
        $newVersion = $content['current_version'] + 1;

        // Mark old versions as not current
        db()->update('sf_content_versions', ['is_current' => 0], 'content_id = ?', [$id]);

        // Create rollback version
        db()->insert('sf_content_versions', [
            'content_id' => $id,
            'version_number' => $newVersion,
            'config_json' => $version['config_json'],
            'change_summary' => "버전 {$targetVersion}으로 롤백",
            'is_current' => 1,
            'created_by' => Auth::id()
        ]);

        // Update content
        db()->update('sf_contents', [
            'config_json' => $version['config_json'],
            'current_version' => $newVersion
        ], 'id = ?', [$id]);

        db()->commit();

        // Log audit
        AuditLogger::log('rollback', 'content', $id, [
            'target_name' => $content['name'],
            'summary' => "버전 {$targetVersion}으로 롤백"
        ]);

        getContent($id);
    } catch (Exception $e) {
        db()->rollback();
        throw $e;
    }
}
?>
