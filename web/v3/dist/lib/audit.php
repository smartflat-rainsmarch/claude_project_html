<?php
/**
 * SmartFlat CMS v3 - Audit Logger
 */

require_once(__DIR__ . '/db.php');
require_once(__DIR__ . '/auth.php');

class AuditLogger {
    /**
     * Log an action
     */
    public static function log($action, $targetType, $targetId, $options = []) {
        try {
            $data = [
                'user_id' => Auth::id(),
                'action_type' => $action,
                'target_type' => $targetType,
                'target_id' => $targetId,
                'target_name' => $options['target_name'] ?? null,
                'before_data' => isset($options['before']) ? json_encode($options['before'], JSON_UNESCAPED_UNICODE) : null,
                'after_data' => isset($options['after']) ? json_encode($options['after'], JSON_UNESCAPED_UNICODE) : null,
                'summary' => $options['summary'] ?? null,
                'ip_address' => self::getClientIp(),
                'user_agent' => self::getUserAgent(),
                'session_id' => session_id() ?: null
            ];

            db()->insert('sf_audit_logs', $data);
        } catch (Exception $e) {
            error_log("Audit log failed: " . $e->getMessage());
            // Don't throw - audit logging should not break the main operation
        }
    }

    /**
     * Log create action
     */
    public static function logCreate($targetType, $targetId, $data, $targetName = null) {
        self::log('create', $targetType, $targetId, [
            'target_name' => $targetName,
            'after' => $data,
            'summary' => "{$targetType} 생성: {$targetName}"
        ]);
    }

    /**
     * Log update action
     */
    public static function logUpdate($targetType, $targetId, $before, $after, $targetName = null) {
        $changes = self::getChanges($before, $after);

        if (empty($changes)) {
            return; // No changes, no log
        }

        self::log('update', $targetType, $targetId, [
            'target_name' => $targetName,
            'before' => $before,
            'after' => $after,
            'summary' => "{$targetType} 수정: " . implode(', ', array_keys($changes))
        ]);
    }

    /**
     * Log delete action
     */
    public static function logDelete($targetType, $targetId, $data, $targetName = null) {
        self::log('delete', $targetType, $targetId, [
            'target_name' => $targetName,
            'before' => $data,
            'summary' => "{$targetType} 삭제: {$targetName}"
        ]);
    }

    /**
     * Log deployment
     */
    public static function logDeploy($projectId, $deploymentId, $summary) {
        self::log('deploy', 'deployment', $deploymentId, [
            'summary' => $summary
        ]);
    }

    /**
     * Log login
     */
    public static function logLogin($userId, $username, $success, $reason = null) {
        try {
            $data = [
                'user_id' => $success ? $userId : null,
                'username' => $username,
                'login_type' => 'password',
                'status' => $success ? 'success' : 'failed',
                'fail_reason' => $reason,
                'ip_address' => self::getClientIp(),
                'user_agent' => self::getUserAgent()
            ];

            db()->insert('sf_login_logs', $data);
        } catch (Exception $e) {
            error_log("Login log failed: " . $e->getMessage());
        }
    }

    /**
     * Get changes between before and after data
     */
    private static function getChanges($before, $after) {
        $changes = [];

        foreach ($after as $key => $value) {
            $beforeValue = $before[$key] ?? null;

            if ($beforeValue !== $value) {
                $changes[$key] = [
                    'from' => $beforeValue,
                    'to' => $value
                ];
            }
        }

        return $changes;
    }

    /**
     * Get client IP address
     */
    private static function getClientIp() {
        $headers = ['HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR'];

        foreach ($headers as $header) {
            if (!empty($_SERVER[$header])) {
                $ips = explode(',', $_SERVER[$header]);
                $ip = trim($ips[0]);

                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }

        return $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    }

    /**
     * Get user agent (truncated)
     */
    private static function getUserAgent() {
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';
        return substr($ua, 0, 500);
    }
}
?>
