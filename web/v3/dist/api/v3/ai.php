<?php
/**
 * SmartFlat CMS v3 - AI Content Generation API
 * POST /ai - Claude API를 통한 프로젝트/콘텐츠 자동 생성
 */

if ($request['method'] !== 'POST') {
    ApiResponse::error('Method not allowed', 405);
}

Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);

require_once(__DIR__ . '/ai-tools.php');

$prompt = $request['input']['prompt'] ?? '';
$context = $request['input']['context'] ?? [];
$messages = $request['input']['messages'] ?? [];

if (empty($prompt)) {
    ApiResponse::error('프롬프트를 입력하세요.', 400);
}

if (mb_strlen($prompt) > 2000) {
    ApiResponse::error('프롬프트는 2000자 이내로 입력하세요.', 400);
}

// Load config
$config = require(__DIR__ . '/../../config/ai.php');
$apiKey = $config['anthropic']['api_key'] ?? '';

if (empty($apiKey)) {
    ApiResponse::error('AI API 키가 설정되지 않았습니다. config/ai.php를 확인하세요.', 500);
}

// Load current project context
$currentProject = null;
if (!empty($context['current_hm_idx'])) {
    $currentProject = db()->fetchOne("SELECT * FROM tb_home WHERE hm_idx = ?", [(int)$context['current_hm_idx']]);
    if ($currentProject) {
        $currentProject['home_data'] = !empty($currentProject['hm_home_data']) ? json_decode($currentProject['hm_home_data'], true) : [];
        $currentProject['main_data'] = !empty($currentProject['hm_main_data']) ? json_decode($currentProject['hm_main_data'], true) : [];
        $currentProject['content_data'] = !empty($currentProject['hm_content_data']) ? json_decode($currentProject['hm_content_data'], true) : [];
    }
}

// Build system prompt
$systemPrompt = buildSystemPrompt($currentProject);

// Build messages for Claude
$claudeMessages = [];

// Add conversation history (max last 10 messages)
if (!empty($messages)) {
    $recent = array_slice($messages, -10);
    foreach ($recent as $msg) {
        if (isset($msg['role']) && isset($msg['content'])) {
            $claudeMessages[] = [
                'role' => $msg['role'] === 'user' ? 'user' : 'assistant',
                'content' => $msg['content']
            ];
        }
    }
}

// If no messages or last isn't the current prompt, add it
if (empty($claudeMessages) || end($claudeMessages)['content'] !== $prompt) {
    $claudeMessages[] = ['role' => 'user', 'content' => $prompt];
}

// Call Claude API with Tools
$response = callClaudeAPI($apiKey, $config['anthropic'], $systemPrompt, $claudeMessages);

if (isset($response['error'])) {
    ApiResponse::error('AI API 호출 실패: ' . ($response['error']['message'] ?? 'Unknown error'), 500);
}

// Process response - handle tool use
$result = processClaudeResponse($response, $currentProject, $apiKey, $config, $systemPrompt, $claudeMessages);

ApiResponse::success($result);

// =========================================
// Claude API Call
// =========================================

function callClaudeAPI($apiKey, $modelConfig, $systemPrompt, $messages) {
    $payload = [
        'model' => $modelConfig['model'],
        'max_tokens' => $modelConfig['max_tokens'],
        'system' => $systemPrompt,
        'messages' => $messages,
        'tools' => getToolDefinitions()
    ];

    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => [
            'Content-Type: application/json',
            'x-api-key: ' . $apiKey,
            'anthropic-version: 2023-06-01'
        ],
        CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60
    ]);

    $body = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);
    curl_close($ch);

    if ($error) {
        return ['error' => ['message' => 'cURL error: ' . $error]];
    }

    $decoded = json_decode($body, true);
    if ($httpCode !== 200) {
        return ['error' => ['message' => $decoded['error']['message'] ?? "HTTP $httpCode"]];
    }

    return $decoded;
}

// =========================================
// Process Claude Response (Tool Use Loop)
// =========================================

function processClaudeResponse($response, $currentProject, $apiKey, $config, $systemPrompt, $messages) {
    $actions = [];
    $textMessage = '';
    $projectHmIdx = null;
    $dataUpdated = false;

    // Max 5 tool use iterations
    for ($iteration = 0; $iteration < 5; $iteration++) {
        $stopReason = $response['stop_reason'] ?? '';
        $content = $response['content'] ?? [];

        $toolUses = [];
        foreach ($content as $block) {
            if ($block['type'] === 'text') {
                $textMessage .= $block['text'];
            } elseif ($block['type'] === 'tool_use') {
                $toolUses[] = $block;
            }
        }

        // No tool calls → done
        if (empty($toolUses) || $stopReason !== 'tool_use') {
            break;
        }

        // Execute tools and collect results
        $toolResults = [];
        foreach ($toolUses as $toolUse) {
            $toolResult = executeTool($toolUse['name'], $toolUse['input']);
            $actions[] = [
                'type' => $toolUse['name'],
                'description' => $toolResult['description'] ?? $toolUse['name']
            ];

            if (isset($toolResult['hm_idx'])) {
                $projectHmIdx = $toolResult['hm_idx'];
            }
            if (isset($toolResult['data_updated'])) {
                $dataUpdated = true;
            }

            $toolResults[] = [
                'type' => 'tool_result',
                'tool_use_id' => $toolUse['id'],
                'content' => json_encode($toolResult, JSON_UNESCAPED_UNICODE)
            ];
        }

        // Send tool results back to Claude for next iteration
        $messages[] = ['role' => 'assistant', 'content' => $content];
        $messages[] = ['role' => 'user', 'content' => $toolResults];

        $response = callClaudeAPI($apiKey, $config['anthropic'], $systemPrompt, $messages);
        if (isset($response['error'])) {
            break;
        }
    }

    return [
        'message' => $textMessage,
        'actions' => $actions,
        'project_hm_idx' => $projectHmIdx,
        'data_updated' => $dataUpdated
    ];
}
?>
