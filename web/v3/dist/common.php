<?php
/**
 * SmartFlat CMS v3 - Common Session & Authentication
 * Session management, authentication check, user info initialization
 */

// Session Configuration
session_cache_expire(1440); // 24 hours (security best practice)
session_start();

// Regenerate session ID periodically to prevent session fixation
if (!isset($_SESSION['_created'])) {
    $_SESSION['_created'] = time();
} else if (time() - $_SESSION['_created'] > 1800) {
    // Regenerate session ID every 30 minutes
    session_regenerate_id(true);
    $_SESSION['_created'] = time();
}

// Include required files
require_once('./cmn_var.php');
require_once('./cmn_func.php');

/**
 * Check if user is logged in
 * @return bool
 */
function isLoggedIn() {
    return isset($_SESSION['key' . DEV_REAL]) && isset($_SESSION['authgroup' . DEV_REAL]);
}

/**
 * Check session and redirect if not logged in
 */
function checkSession() {
    if (!isLoggedIn()) {
        redirectWithMessage(PAGE_ADMIN_LOGIN, '세션이 만료되었습니다. 다시 로그인해 주세요.');
    }
}

/**
 * Check if user has required auth level
 * @param int $requiredLevel
 * @return bool
 */
function hasAuthLevel($requiredLevel) {
    if (!isLoggedIn()) {
        return false;
    }
    return $_SESSION['authgroup' . DEV_REAL] >= $requiredLevel;
}

// Authentication Check
if (!isLoggedIn()) {
    redirectWithMessage(PAGE_ADMIN_LOGIN, '오랫동안 입력하지 않아 로그아웃되었습니다. 다시 로그인하여 주세요.');
}

// Check minimum auth level (Trainer or above)
if (!hasAuthLevel(AUTH_TRANER)) {
    redirectWithMessage('../../v2/index.html', '접근할 수 있는 권한이 부여되지 않았습니다.');
}

// Session Variables
$session = $_SESSION['key' . DEV_REAL];
$userinfo = $_SESSION['data' . DEV_REAL]["userinfo"] ?? [];

// User Info Variables
$uid = $userinfo["uid"] ?? '';
$id = $userinfo["id"] ?? '';
$email = $userinfo["email"] ?? '';
$auth = $_SESSION['authgroup' . DEV_REAL] ?? 0;
$auth_num = $userinfo['auth'] ?? 0;
$usernamedesc = $userinfo['name'] ?? '';
$mygroupcode = $userinfo['groupcode'] ?? '';
$mygroupname = $userinfo['groupname'] ?? '';
$mycentercodes = $userinfo['centercodes'] ?? '';
$projectids = $userinfo['projectids'] ?? '';
$groupidx = $userinfo['groupidx'] ?? '';
// Safely encode settings with proper JSON escaping to prevent XSS
$setting = isset($userinfo['setting'])
    ? json_encode($userinfo['setting'], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT)
    : 'null';

// Domain name
$domain_name = $_SERVER['SERVER_NAME'] ?? '';

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrfToken = $_SESSION['csrf_token'];
?>
<meta name="csrf-token" content="<?php echo htmlspecialchars($csrfToken); ?>">
<script>
/**
 * SmartFlat CMS v3 - Global User Variables
 */

// CSRF Token
const csrfToken = "<?php echo htmlspecialchars($csrfToken); ?>";

// User Session Variables
const global_uid = "<?php echo htmlspecialchars($uid); ?>";
const global_id = "<?php echo htmlspecialchars($id); ?>";
const global_email = "<?php echo htmlspecialchars($email); ?>";
const auth = <?php echo (int)$auth; ?>;
const auth_num = <?php echo (int)$auth_num; ?>;
const usernamedesc = "<?php echo htmlspecialchars($usernamedesc); ?>";
const session_groupcode = "<?php echo htmlspecialchars($mygroupcode); ?>";
const session_groupname = "<?php echo htmlspecialchars($mygroupname); ?>";
const session_centercodes = "<?php echo htmlspecialchars($mycentercodes); ?>";
const session_projectids = "<?php echo htmlspecialchars($projectids); ?>";
const session_groupidx = "<?php echo htmlspecialchars($groupidx); ?>";
const domain_name = "<?php echo htmlspecialchars($domain_name); ?>";

// User Settings (safely parsed from PHP)
let setting = <?php echo $setting; ?>;
let memsetting = setting && typeof setting === 'object' ? setting : {};
let permission_list = memsetting.adminsetting || null;

/**
 * Check session validity (client-side)
 */
function isSession() {
    <?php checkSession(); ?>
    return true;
}
</script>
