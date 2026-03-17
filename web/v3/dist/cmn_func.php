<?php
/**
 * SmartFlat CMS v3 - Common Functions
 * PHP utility functions
 */

/**
 * Safe multibyte substr with fallback
 * @param string $str
 * @param int $start
 * @param int|null $length
 * @return string
 */
function safe_mb_substr($str, $start, $length = null) {
    if (function_exists('mb_substr')) {
        return $length !== null ? mb_substr($str, $start, $length) : mb_substr($str, $start);
    }
    return $length !== null ? substr($str, $start, $length) : substr($str, $start);
}

/**
 * Check if current environment is development/localhost
 * @return bool
 */
function isDevLocalHost() {
    $http_host = $_SERVER['HTTP_HOST'] ?? '';
    $request_uri = $_SERVER['REQUEST_URI'] ?? '';
    $url = 'https://' . $http_host . $request_uri;

    $real_pos = strpos($url, "real");
    $pos = strpos($url, "dev");
    $pos2 = strpos($url, "localhost");

    // localhost is development
    if ($pos2) {
        return true;
    }
    // Check domain
    if (strpos($url, "smartflat") !== false) {
        // Real site
        if ($real_pos) {
            return false;
        }
        // Dev site
        return true;
    }

    return true;
}

/**
 * Sanitize input data
 * @param string $data
 * @return string
 */
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Validate email format
 * @param string $email
 * @return bool
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Generate random string
 * @param int $length
 * @return string
 */
function generateRandomString($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $randomString;
}

/**
 * Format date in Korean style
 * @param string $date
 * @param string $format
 * @return string
 */
function formatDateKorean($date, $format = 'Y-m-d H:i:s') {
    $timestamp = strtotime($date);
    return date($format, $timestamp);
}

/**
 * Get current datetime
 * @return string
 */
function getCurrentDateTime() {
    return date('Y-m-d H:i:s');
}

/**
 * Get current date
 * @return string
 */
function getCurrentDate() {
    return date('Y-m-d');
}

/**
 * Calculate days between two dates
 * @param string $date1
 * @param string $date2
 * @return int
 */
function getDaysBetween($date1, $date2) {
    $datetime1 = new DateTime($date1);
    $datetime2 = new DateTime($date2);
    $interval = $datetime1->diff($datetime2);
    return $interval->days;
}

/**
 * JSON response helper
 * @param int $code
 * @param string $message
 * @param mixed $data
 */
function jsonResponse($code, $message = '', $data = null) {
    header('Content-Type: application/json; charset=utf-8');
    $response = [
        'code' => $code,
        'message' => $message
    ];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Log error to file
 * @param string $message
 * @param string $type
 */
function logError($message, $type = 'error') {
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    $logFile = $logDir . '/' . date('Y-m-d') . '_' . $type . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[{$timestamp}] {$message}" . PHP_EOL;

    file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
}

/**
 * Check required fields in array
 * @param array $data
 * @param array $requiredFields
 * @return array Missing fields
 */
function checkRequiredFields($data, $requiredFields) {
    $missing = [];
    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $missing[] = $field;
        }
    }
    return $missing;
}

/**
 * Format file size
 * @param int $bytes
 * @return string
 */
function formatFileSize($bytes) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= pow(1024, $pow);
    return round($bytes, 2) . ' ' . $units[$pow];
}

/**
 * Get file extension
 * @param string $filename
 * @return string
 */
function getFileExtension($filename) {
    return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
}

/**
 * Check if file is allowed type
 * @param string $filename
 * @param array $allowedTypes
 * @return bool
 */
function isAllowedFileType($filename, $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf']) {
    $ext = getFileExtension($filename);
    return in_array($ext, $allowedTypes);
}

/**
 * Redirect with message
 * @param string $url
 * @param string $message
 */
function redirectWithMessage($url, $message = '') {
    $safeUrl = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    if (!empty($message)) {
        $safeMsg = addslashes(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
        echo "<script>alert('{$safeMsg}');</script>";
    }
    echo "<meta http-equiv='refresh' content='0;url={$safeUrl}'>";
    exit;
}
?>
