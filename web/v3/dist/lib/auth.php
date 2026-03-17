<?php
/**
 * SmartFlat CMS v3 - Authentication & Authorization
 */

require_once(__DIR__ . '/db.php');

class Auth {
    // Role constants
    const ROLE_VIEWER = 1;
    const ROLE_CONTENT_MANAGER = 2;
    const ROLE_DEVICE_MANAGER = 3;
    const ROLE_OPERATOR = 4;
    const ROLE_ADMIN = 5;
    const ROLE_OWNER = 6;
    const ROLE_SYSTEM_ADMIN = 7;

    // Role labels
    const ROLE_LABELS = [
        self::ROLE_VIEWER => '열람자',
        self::ROLE_CONTENT_MANAGER => '콘텐츠 관리자',
        self::ROLE_DEVICE_MANAGER => '기기 관리자',
        self::ROLE_OPERATOR => '운영자',
        self::ROLE_ADMIN => '관리자',
        self::ROLE_OWNER => '소유자',
        self::ROLE_SYSTEM_ADMIN => '시스템 관리자'
    ];

    private static $currentUser = null;

    /**
     * Check if user is authenticated
     */
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
    }

    /**
     * Get current user info
     */
    public static function user() {
        if (!self::check()) {
            return null;
        }

        if (self::$currentUser !== null) {
            return self::$currentUser;
        }

        self::$currentUser = [
            'id' => $_SESSION['user_id'] ?? null,
            'username' => $_SESSION['username'] ?? null,
            'name' => $_SESSION['user_name'] ?? null,
            'role' => $_SESSION['user_role'] ?? self::ROLE_VIEWER,
            'group_id' => $_SESSION['group_id'] ?? null
        ];

        return self::$currentUser;
    }

    /**
     * Get current user ID
     */
    public static function id() {
        return self::check() ? $_SESSION['user_id'] : null;
    }

    /**
     * Get current user role
     */
    public static function role() {
        return self::check() ? ($_SESSION['user_role'] ?? self::ROLE_VIEWER) : 0;
    }

    /**
     * Check if user has at least the required role
     */
    public static function hasRole($requiredRole) {
        return self::role() >= $requiredRole;
    }

    /**
     * Require authentication - terminates if not authenticated
     */
    public static function requireAuth() {
        if (!self::check()) {
            self::unauthorized('Authentication required');
        }
    }

    /**
     * Require specific role - terminates if not authorized
     */
    public static function requireRole($requiredRole) {
        self::requireAuth();

        if (!self::hasRole($requiredRole)) {
            self::forbidden('Insufficient permissions');
        }
    }

    /**
     * Check permission for a specific action on a resource
     */
    public static function can($action, $resource = null) {
        $role = self::role();

        // System admin can do everything
        if ($role >= self::ROLE_SYSTEM_ADMIN) {
            return true;
        }

        // Permission matrix
        $permissions = [
            'view' => self::ROLE_VIEWER,
            'create' => self::ROLE_CONTENT_MANAGER,
            'edit' => self::ROLE_CONTENT_MANAGER,
            'delete' => self::ROLE_ADMIN,
            'deploy' => self::ROLE_OPERATOR,
            'manage_device' => self::ROLE_DEVICE_MANAGER,
            'manage_user' => self::ROLE_ADMIN
        ];

        $requiredRole = $permissions[$action] ?? self::ROLE_VIEWER;

        return $role >= $requiredRole;
    }

    /**
     * Get CSRF token
     */
    public static function csrfToken() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Validate CSRF token
     */
    public static function validateCsrf($token = null) {
        if ($token === null) {
            $token = $_POST['_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        }

        if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            self::forbidden('Invalid CSRF token');
        }
    }

    /**
     * Send unauthorized response
     */
    public static function unauthorized($message = 'Unauthorized') {
        http_response_code(401);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'code' => 401,
            'message' => $message
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Send forbidden response
     */
    public static function forbidden($message = 'Forbidden') {
        http_response_code(403);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            'code' => 403,
            'message' => $message
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Get role label
     */
    public static function getRoleLabel($role) {
        return self::ROLE_LABELS[$role] ?? '알 수 없음';
    }
}

/**
 * Shorthand function for permission check
 */
function can($action, $resource = null) {
    return Auth::can($action, $resource);
}

/**
 * Shorthand function for requiring authentication
 */
function auth() {
    Auth::requireAuth();
    return Auth::user();
}
?>
