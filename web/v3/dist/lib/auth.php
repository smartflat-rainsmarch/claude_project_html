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

        // v3 native session
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            return true;
        }

        // v1 compatible session (key_dev or key_real)
        $devReal = (strpos($_SERVER["REQUEST_URI"] ?? '', "real") !== false) ? "_real" : "_dev";
        if (isset($_SESSION['key' . $devReal]) && isset($_SESSION['authgroup' . $devReal])) {
            return true;
        }

        return false;
    }

    /**
     * Detect dev/real suffix for v1 session keys
     */
    private static function getDevReal() {
        return (strpos($_SERVER["REQUEST_URI"] ?? '', "real") !== false) ? "_real" : "_dev";
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

        // Try v3 native session first
        if (isset($_SESSION['user_id'])) {
            self::$currentUser = [
                'id' => $_SESSION['user_id'] ?? null,
                'username' => $_SESSION['username'] ?? null,
                'name' => $_SESSION['user_name'] ?? null,
                'role' => $_SESSION['user_role'] ?? self::ROLE_VIEWER,
                'group_id' => $_SESSION['group_id'] ?? null
            ];
        } else {
            // v1 compatible session
            $dr = self::getDevReal();
            $userinfo = $_SESSION['data' . $dr]['userinfo'] ?? [];
            self::$currentUser = [
                'id' => $userinfo['id'] ?? null,
                'username' => $userinfo['id'] ?? null,
                'name' => $userinfo['name'] ?? null,
                'role' => self::mapAuthGroupToRole($_SESSION['authgroup' . $dr] ?? 0),
                'group_id' => $userinfo['groupidx'] ?? null,
                'auth_group' => $_SESSION['authgroup' . $dr] ?? 0,
                'userinfo' => $userinfo
            ];
        }

        return self::$currentUser;
    }

    /**
     * Get current user ID
     */
    public static function id() {
        if (!self::check()) return null;

        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        }

        $dr = self::getDevReal();
        return $_SESSION['data' . $dr]['userinfo']['id'] ?? null;
    }

    /**
     * Map v1 auth_group integer to v3 role constant
     */
    private static function mapAuthGroupToRole($authGroup) {
        $authGroup = (int)$authGroup;
        if ($authGroup >= 5) return self::ROLE_SYSTEM_ADMIN;
        if ($authGroup >= 4) return self::ROLE_ADMIN;
        if ($authGroup >= 3) return self::ROLE_OPERATOR;
        if ($authGroup >= 2) return self::ROLE_CONTENT_MANAGER;
        return self::ROLE_VIEWER;
    }

    /**
     * Get current user role
     */
    public static function role() {
        if (!self::check()) return 0;

        if (isset($_SESSION['user_role'])) {
            return $_SESSION['user_role'] ?? self::ROLE_VIEWER;
        }

        $dr = self::getDevReal();
        return self::mapAuthGroupToRole($_SESSION['authgroup' . $dr] ?? 0);
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
