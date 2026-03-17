<?php
/**
 * SmartFlat CMS v3 - Login API
 * Authenticates against smartflat_claude_html database
 */

error_reporting(E_ALL);
date_default_timezone_set('Asia/Seoul');

header('Content-Type: application/json; charset=utf-8');

// Only accept POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['code' => 405, 'message' => 'Method not allowed'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Read POST data
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

if (empty($email) || empty($pass)) {
    echo json_encode(['code' => -1, 'message' => '이메일과 비밀번호를 입력해주세요.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// ============================================
// AES Encryption (same as ssapi/aes_encrypt.php)
// ============================================
// Load encryption key from environment (required in production)
$appKeyEnv = getenv('APP_ENCRYPTION_KEY');
if (!$appKeyEnv) {
    $isProduction = getenv('APP_ENV') === 'production' ||
        (isset($_SERVER['HTTP_HOST']) &&
         !preg_match('/^(localhost|127\.0\.0\.1|192\.168\.)/', $_SERVER['HTTP_HOST'] ?? ''));

    if ($isProduction) {
        error_log('SECURITY: APP_ENCRYPTION_KEY not set in production');
        echo json_encode(['code' => -99, 'message' => '서버 설정 오류'], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Development fallback only — matches legacy ssapi key
    $appKeyEnv = 'global_black_company';
    error_log('WARNING: Using default encryption key. Set APP_ENCRYPTION_KEY in production.');
}
define("APPKEY", $appKeyEnv);

function enc($str) {
    $secret_key = APPKEY;
    $secret_iv = "#@\$%^&*()_+=-";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return str_replace("=", "", base64_encode(openssl_encrypt($str, "AES-256-CBC", $key, 0, $iv)));
}

function dec($str) {
    $secret_key = APPKEY;
    $secret_iv = "#@\$%^&*()_+=-";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    return openssl_decrypt(base64_decode($str), "AES-256-CBC", $key, 0, $iv);
}

// ============================================
// Database Connection
// ============================================
try {
    $con = new PDO(
        "mysql:host=localhost;dbname=smartflat_claude_html;charset=utf8mb4",
        "root",
        "",
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    error_log("DB connection failed: " . $e->getMessage());
    echo json_encode(['code' => -99, 'message' => '서버 연결에 실패했습니다.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// ============================================
// Authenticate
// ============================================
$enc_email = enc($email);
$enc_pass = enc($pass);

$stmt = $con->prepare("SELECT * FROM tb_user WHERE mem_email = ? AND mem_password = ? LIMIT 1");
$stmt->execute([$enc_email, $enc_pass]);
$row = $stmt->fetch();

if (!$row) {
    echo json_encode(['code' => -11, 'message' => '이메일 또는 비밀번호가 올바르지 않습니다.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Decrypt user fields
$row['mem_username'] = dec($row['mem_username']);
$row['mem_nickname'] = isset($row['mem_nickname']) ? dec($row['mem_nickname']) : '';
$row['mem_email'] = dec($row['mem_email']);
$row['mem_phone'] = isset($row['mem_phone']) ? dec($row['mem_phone']) : '';

// Get auth group
$auth_num = (int)$row['mem_auth'];
$stmt2 = $con->prepare("SELECT auth_group FROM tb_auth WHERE auth_num = ? LIMIT 1");
$stmt2->execute([$auth_num]);
$auth_row = $stmt2->fetch();
$auth_group = $auth_row ? (int)$auth_row['auth_group'] : 1;

// ============================================
// Set Session (compatible with v1 common.php)
// ============================================
// Determine dev/real
$dev_real = (strpos($_SERVER["REQUEST_URI"] ?? '', "real") !== false) ? "_real" : "_dev";

$userinfo = [
    'uid'          => $row["mem_uid"],
    'id'           => $row["mem_userid"],
    'email'        => $row["mem_email"],
    'pass'         => $row["mem_password"],
    'cert'         => $row["mem_cert"],
    'name'         => $row["mem_username"],
    'nickname'     => $row["mem_nickname"],
    'gender'       => $row["mem_gender"],
    'level'        => $row["mem_level"],
    'auth'         => $row["mem_auth"],
    'point'        => $row["mem_point"],
    'regtime'      => $row["mem_regtime"],
    'regip'        => $row["mem_regip"],
    'photo'        => $row["mem_photo"],
    'passchangetime' => $row["mem_passchangetime"],
    'isadmin'      => $row["mem_is_admin"],
    'groupcode'    => $row["mem_groupcode"],
    'groupidx'     => $row["mem_groupidx"],
    'groupname'    => "스마트플랫HTML",
    'centercodes'  => $row["mem_centercodes"],
    'projectids'   => $row["mem_projectids"],
    'fcmtoken'     => $row["mem_fcmtoken"],
    'setting'      => $row["mem_setting"],
    'newips'       => $row["mem_reg_newips"]
];

// Generate random session key
function random_string($length) {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $str = '';
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[random_int(0, strlen($chars) - 1)];
    }
    return $str;
}

session_cache_expire(14400);
session_start();

$_SESSION['key' . $dev_real] = random_string(20);
$_SESSION['authgroup' . $dev_real] = $auth_group;
$_SESSION['data' . $dev_real]["userinfo"] = $userinfo;

// Return success
echo json_encode([
    'code' => 200,
    'message' => 'success',
    'data' => [
        'name' => $userinfo['name'],
        'auth_group' => $auth_group
    ]
], JSON_UNESCAPED_UNICODE);
exit;
?>
