<?php
/**
 * SmartFlat CMS v3 - API Response Helper
 */

class ApiResponse {
    /**
     * Send JSON response
     */
    public static function json($data, $statusCode = 200) {
        http_response_code($statusCode);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        exit;
    }

    /**
     * Send success response
     */
    public static function success($data = null, $message = 'success') {
        $response = [
            'code' => 100,
            'message' => $message
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        self::json($response);
    }

    /**
     * Send paginated response
     */
    public static function paginated($items, $pagination, $message = 'success') {
        self::json([
            'code' => 100,
            'message' => $message,
            'data' => [
                'items' => $items,
                'pagination' => $pagination
            ]
        ]);
    }

    /**
     * Send error response
     */
    public static function error($message, $code = 400, $errors = null) {
        $response = [
            'code' => $code,
            'message' => $message
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        // Map code to HTTP status
        $httpStatus = match(true) {
            $code === 401 => 401,
            $code === 403 => 403,
            $code === 404 => 404,
            $code === 409 => 409,
            $code >= 500 => 500,
            default => 400
        };

        self::json($response, $httpStatus);
    }

    /**
     * Send not found response
     */
    public static function notFound($message = 'Resource not found') {
        self::error($message, 404);
    }

    /**
     * Send validation error
     */
    public static function validationError($errors, $message = 'Validation failed') {
        self::json([
            'code' => 400,
            'message' => $message,
            'errors' => $errors
        ], 400);
    }

    /**
     * Send server error
     */
    public static function serverError($message = 'Internal server error') {
        error_log("Server error: " . $message);
        self::error('서버 오류가 발생했습니다.', 500);
    }
}

/**
 * Shorthand functions
 */
function apiSuccess($data = null, $message = 'success') {
    ApiResponse::success($data, $message);
}

function apiError($message, $code = 400, $errors = null) {
    ApiResponse::error($message, $code, $errors);
}

function apiNotFound($message = 'Resource not found') {
    ApiResponse::notFound($message);
}
?>
