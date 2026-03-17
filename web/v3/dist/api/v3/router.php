<?php
/**
 * SmartFlat CMS v3 - API Router
 *
 * Routes:
 *   GET    /api/v3/{resource}          - List
 *   GET    /api/v3/{resource}/{id}     - Get one
 *   POST   /api/v3/{resource}          - Create
 *   PUT    /api/v3/{resource}/{id}     - Update
 *   DELETE /api/v3/{resource}/{id}     - Delete
 *   POST   /api/v3/{resource}/{id}/{action} - Custom action
 */

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_cache_expire(1440);
    session_start();
}

// Set headers
header('Content-Type: application/json; charset=utf-8');

// CORS - restrict to allowed origins
$allowedOrigins = [
    'http://localhost',
    'http://localhost:8080',
    'http://127.0.0.1',
    'https://smartflat.co.kr',
    'https://www.smartflat.co.kr'
];
$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
if (in_array($origin, $allowedOrigins)) {
    header('Access-Control-Allow-Origin: ' . $origin);
    header('Access-Control-Allow-Credentials: true');
} elseif (empty($origin) && php_sapi_name() !== 'cli') {
    // Same-origin request (no Origin header)
    header('Access-Control-Allow-Origin: ' . ($_SERVER['HTTP_HOST'] ?? 'localhost'));
}
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-CSRF-Token, Authorization');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Load dependencies
require_once(__DIR__ . '/../../lib/db.php');
require_once(__DIR__ . '/../../lib/auth.php');
require_once(__DIR__ . '/../../lib/audit.php');
require_once(__DIR__ . '/../../lib/response.php');

// Parse request
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove base path to get relative path
// Expected: /api/v3/{resource}/{id?}/{action?}
$basePath = '/web/v3/dist/api/v3/router.php';
$altPath = '/api/v3/';

if (strpos($uri, $basePath) !== false) {
    // Direct router.php access with query string routing
    $uri = $_GET['route'] ?? '';
} elseif (strpos($uri, $altPath) !== false) {
    // Rewrite rule: extract path after /api/v3/
    $uri = substr($uri, strpos($uri, $altPath) + strlen($altPath));
} else {
    $uri = '';
}

// Parse URI segments
$segments = array_values(array_filter(explode('/', trim($uri, '/'))));
$resource = $segments[0] ?? '';
$id = $segments[1] ?? null;
$action = $segments[2] ?? null;

// Get request body for POST/PUT
$input = [];
if (in_array($method, ['POST', 'PUT'])) {
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true) ?? [];
}

// Merge with POST data (for form submissions)
$input = array_merge($_POST, $input);

// Available resources
$resources = [
    'projects' => 'project.php',
    'contents' => 'content.php',
    'devices' => 'device.php',
    'deployments' => 'deployment.php',
    'dashboard' => 'dashboard.php',
    'device-groups' => 'device_group.php',
    'assets' => 'asset.php',
    'audit-logs' => 'audit.php',
    'common-codes' => 'common_code.php',
    'homes' => 'home.php'
];

// Check resource exists
if (!isset($resources[$resource])) {
    ApiResponse::error('Resource not found', 404);
}

// Require authentication for all API routes except some public ones
$publicRoutes = [
    'dashboard:GET' => true  // Dashboard summary might be public
];

$routeKey = "{$resource}:{$method}";
if (!isset($publicRoutes[$routeKey])) {
    Auth::requireAuth();

    // Enforce CSRF validation for state-changing methods
    if (in_array($method, ['POST', 'PUT', 'DELETE'])) {
        Auth::validateCsrf();
    }
}

// Load resource handler
$handlerFile = __DIR__ . '/' . $resources[$resource];

if (!file_exists($handlerFile)) {
    ApiResponse::error('Handler not found', 500);
}

// Set request context
$request = [
    'method' => $method,
    'resource' => $resource,
    'id' => $id,
    'action' => $action,
    'input' => $input,
    'query' => $_GET
];

// Include and execute handler
try {
    require_once($handlerFile);
} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    ApiResponse::serverError('Database error occurred');
} catch (Exception $e) {
    error_log("API error: " . $e->getMessage());
    ApiResponse::serverError($e->getMessage());
}
?>
