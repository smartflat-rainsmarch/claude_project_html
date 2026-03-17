<?php
/**
 * SmartFlat CMS v3 - Common Code API
 *
 * GET /api/v3/common-codes - List common codes by group
 */

switch ($request['method']) {
    case 'GET':
        listCommonCodes($request['query']);
        break;

    default:
        ApiResponse::error('Method not allowed', 405);
}

/**
 * List common codes
 */
function listCommonCodes($query) {
    $group = $query['group'] ?? null;

    if (empty($group)) {
        // Return all groups
        $codes = db()->fetchAll("
            SELECT code_group, code_key, code_value, code_label, sort_order, extra_data
            FROM sf_common_codes
            WHERE is_active = 1
            ORDER BY code_group, sort_order, code_key
        ");

        // Group by code_group
        $grouped = [];
        foreach ($codes as $code) {
            $g = $code['code_group'];
            if (!isset($grouped[$g])) {
                $grouped[$g] = [];
            }
            if (!empty($code['extra_data'])) {
                $code['extra_data'] = json_decode($code['extra_data'], true);
            }
            $grouped[$g][] = $code;
        }

        ApiResponse::success($grouped);
    } else {
        // Return specific group
        $codes = db()->fetchAll("
            SELECT code_key, code_value, code_label, sort_order, extra_data
            FROM sf_common_codes
            WHERE code_group = ? AND is_active = 1
            ORDER BY sort_order, code_key
        ", [$group]);

        foreach ($codes as &$code) {
            if (!empty($code['extra_data'])) {
                $code['extra_data'] = json_decode($code['extra_data'], true);
            }
        }

        ApiResponse::success($codes);
    }
}
?>
