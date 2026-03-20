<?php
/**
 * SmartFlat CMS v3 - AI Content Generation API
 * POST /ai - Gemini / Claude API를 통한 프로젝트/콘텐츠 자동 생성
 *
 * config/ai.php의 'provider' 설정에 따라 Gemini 또는 Claude 사용
 */

if ($request['method'] !== 'POST') {
    ApiResponse::error('Method not allowed', 405);
}

Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);

require_once(__DIR__ . '/ai-tools.php');

$prompt = $request['input']['prompt'] ?? '';
$context = $request['input']['context'] ?? [];
$messages = $request['input']['messages'] ?? [];

// Rate Limiting (분당 10회)
$userId = Auth::id() ?: session_id();
$rateLimitKey = 'ai_rate_' . $userId;
$now = time();
$rateData = isset($_SESSION[$rateLimitKey]) ? $_SESSION[$rateLimitKey] : ['count' => 0, 'reset' => $now + 60];
if ($now > $rateData['reset']) {
    $rateData = ['count' => 0, 'reset' => $now + 60];
}
$rateData['count']++;
$_SESSION[$rateLimitKey] = $rateData;
if ($rateData['count'] > 10) {
    ApiResponse::error('요청이 너무 많습니다. 1분 후 다시 시도하세요.', 429);
}

if (empty($prompt)) {
    ApiResponse::error('프롬프트를 입력하세요.', 400);
}

if (mb_strlen($prompt) > 2000) {
    ApiResponse::error('프롬프트는 2000자 이내로 입력하세요.', 400);
}

// Load config
$config = require(__DIR__ . '/../../config/ai.php');
$provider = $config['provider'] ?? 'gemini';

// API 키 확인
if ($provider === 'gemini') {
    $apiKey = $config['gemini']['api_key'] ?? '';
    if (empty($apiKey)) {
        ApiResponse::error('Gemini API 키가 설정되지 않았습니다. config/ai.php를 확인하세요.', 500);
    }
} else {
    $apiKey = $config['anthropic']['api_key'] ?? '';
    if (empty($apiKey)) {
        ApiResponse::error('AI API 키가 설정되지 않았습니다. config/ai.php를 확인하세요.', 500);
    }
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

// Build conversation messages
$convMessages = [];
if (!empty($messages)) {
    $recent = array_slice($messages, -10);
    foreach ($recent as $msg) {
        if (isset($msg['role']) && isset($msg['content'])) {
            $convMessages[] = [
                'role' => $msg['role'] === 'user' ? 'user' : 'model',
                'content' => $msg['content']
            ];
        }
    }
}
if (empty($convMessages) || end($convMessages)['content'] !== $prompt) {
    $convMessages[] = ['role' => 'user', 'content' => $prompt];
}

// Call AI API
if ($provider === 'gemini') {
    $response = callGeminiAPI($apiKey, $config['gemini'], $systemPrompt, $convMessages);
} else {
    $response = callClaudeAPI($apiKey, $config['anthropic'], $systemPrompt, $convMessages);
}

if (isset($response['error'])) {
    ApiResponse::error('AI API 호출 실패: ' . ($response['error']['message'] ?? 'Unknown error'), 500);
}

// Process response
if ($provider === 'gemini') {
    $result = processGeminiResponse($response, $currentProject, $apiKey, $config, $systemPrompt, $convMessages);
} else {
    $result = processClaudeResponse($response, $currentProject, $apiKey, $config, $systemPrompt, $convMessages);
}

ApiResponse::success($result);

// =========================================
// Gemini API
// =========================================

function callGeminiAPI($apiKey, $modelConfig, $systemPrompt, $messages) {
    $model = $modelConfig['model'];
    $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

    // Build Gemini format messages
    $contents = [];
    foreach ($messages as $msg) {
        $role = ($msg['role'] === 'user') ? 'user' : 'model';
        $contents[] = [
            'role' => $role,
            'parts' => [['text' => $msg['content']]]
        ];
    }

    // Convert tools to Gemini function declarations
    $tools = getToolDefinitions();
    $geminiTools = [];
    foreach ($tools as $tool) {
        $decl = [
            'name' => $tool['name'],
            'description' => $tool['description'],
            'parameters' => convertToGeminiSchema($tool['input_schema'])
        ];
        $geminiTools[] = $decl;
    }

    $payload = [
        'contents' => $contents,
        'systemInstruction' => [
            'parts' => [['text' => $systemPrompt]]
        ],
        'tools' => [
            ['functionDeclarations' => $geminiTools]
        ],
        'generationConfig' => [
            'maxOutputTokens' => $modelConfig['max_tokens'],
            'temperature' => 0.7
        ]
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 120
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
        $errMsg = $decoded['error']['message'] ?? "HTTP $httpCode";
        return ['error' => ['message' => $errMsg]];
    }

    return $decoded;
}

function convertToGeminiSchema($schema) {
    // Anthropic input_schema → Gemini parameters 변환
    $result = ['type' => 'OBJECT'];
    if (isset($schema['properties'])) {
        $props = [];
        foreach ($schema['properties'] as $key => $prop) {
            $gProp = [];
            $type = $prop['type'] ?? 'string';
            $typeMap = ['string' => 'STRING', 'integer' => 'INTEGER', 'number' => 'NUMBER', 'boolean' => 'BOOLEAN', 'array' => 'ARRAY', 'object' => 'OBJECT'];
            $gProp['type'] = $typeMap[$type] ?? 'STRING';
            if (isset($prop['description'])) $gProp['description'] = $prop['description'];
            if (isset($prop['enum'])) $gProp['enum'] = $prop['enum'];
            if ($type === 'array' && isset($prop['items'])) {
                $gProp['items'] = ['type' => 'OBJECT'];
            }
            $props[$key] = $gProp;
        }
        $result['properties'] = $props;
    }
    if (isset($schema['required'])) {
        $result['required'] = $schema['required'];
    }
    return $result;
}

function processGeminiResponse($response, $currentProject, $apiKey, $config, $systemPrompt, $messages) {
    $actions = [];
    $textMessage = '';
    $projectHmIdx = null;
    $dataUpdated = false;

    for ($iteration = 0; $iteration < 5; $iteration++) {
        $candidates = $response['candidates'] ?? [];
        if (empty($candidates)) break;

        $parts = $candidates[0]['content']['parts'] ?? [];
        $functionCalls = [];

        foreach ($parts as $part) {
            if (isset($part['text'])) {
                $textMessage .= $part['text'];
            }
            if (isset($part['functionCall'])) {
                $functionCalls[] = $part;
            }
        }

        if (empty($functionCalls)) break;

        // Execute function calls
        $functionResponses = [];
        foreach ($functionCalls as $fc) {
            $fnName = $fc['functionCall']['name'];
            $fnArgs = $fc['functionCall']['args'] ?? [];

            $toolResult = executeTool($fnName, $fnArgs);
            $actions[] = [
                'type' => $fnName,
                'description' => $toolResult['description'] ?? $fnName
            ];

            if (isset($toolResult['hm_idx'])) {
                $projectHmIdx = $toolResult['hm_idx'];
            }
            if (isset($toolResult['data_updated'])) {
                $dataUpdated = true;
            }

            $functionResponses[] = [
                'functionResponse' => [
                    'name' => $fnName,
                    'response' => $toolResult
                ]
            ];
        }

        // Send function results back to Gemini
        $messages[] = ['role' => 'model', 'content' => json_encode($parts)];

        // Add function response as user turn
        $geminiContents = [];
        foreach ($messages as $msg) {
            $role = ($msg['role'] === 'user') ? 'user' : 'model';
            $geminiContents[] = [
                'role' => $role,
                'parts' => [['text' => $msg['content']]]
            ];
        }
        // Add the model's function call
        $geminiContents[] = [
            'role' => 'model',
            'parts' => $parts
        ];
        // Add function responses
        $geminiContents[] = [
            'role' => 'user',
            'parts' => $functionResponses
        ];

        // Re-call Gemini
        $model = $config['gemini']['model'];
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent?key={$apiKey}";

        $tools = getToolDefinitions();
        $geminiTools = [];
        foreach ($tools as $tool) {
            $geminiTools[] = [
                'name' => $tool['name'],
                'description' => $tool['description'],
                'parameters' => convertToGeminiSchema($tool['input_schema'])
            ];
        }

        $payload = [
            'contents' => $geminiContents,
            'systemInstruction' => ['parts' => [['text' => $systemPrompt]]],
            'tools' => [['functionDeclarations' => $geminiTools]],
            'generationConfig' => ['maxOutputTokens' => $config['gemini']['max_tokens'], 'temperature' => 0.7]
        ];

        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 120
        ]);
        $body = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($body, true);
        if (!$response || isset($response['error'])) break;
    }

    return [
        'message' => $textMessage,
        'actions' => $actions,
        'project_hm_idx' => $projectHmIdx,
        'data_updated' => $dataUpdated
    ];
}

// =========================================
// Claude API (백업)
// =========================================

function callClaudeAPI($apiKey, $modelConfig, $systemPrompt, $messages) {
    // Convert messages format for Claude
    $claudeMessages = [];
    foreach ($messages as $msg) {
        $claudeMessages[] = [
            'role' => $msg['role'] === 'user' ? 'user' : 'assistant',
            'content' => $msg['content']
        ];
    }

    $payload = [
        'model' => $modelConfig['model'],
        'max_tokens' => $modelConfig['max_tokens'],
        'system' => $systemPrompt,
        'messages' => $claudeMessages,
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

    if ($error) return ['error' => ['message' => 'cURL error: ' . $error]];
    $decoded = json_decode($body, true);
    if ($httpCode !== 200) return ['error' => ['message' => $decoded['error']['message'] ?? "HTTP $httpCode"]];
    return $decoded;
}

function processClaudeResponse($response, $currentProject, $apiKey, $config, $systemPrompt, $messages) {
    $actions = [];
    $textMessage = '';
    $projectHmIdx = null;
    $dataUpdated = false;

    for ($iteration = 0; $iteration < 5; $iteration++) {
        $stopReason = $response['stop_reason'] ?? '';
        $content = $response['content'] ?? [];
        $toolUses = [];

        foreach ($content as $block) {
            if ($block['type'] === 'text') $textMessage .= $block['text'];
            elseif ($block['type'] === 'tool_use') $toolUses[] = $block;
        }

        if (empty($toolUses) || $stopReason !== 'tool_use') break;

        $toolResults = [];
        foreach ($toolUses as $toolUse) {
            $toolResult = executeTool($toolUse['name'], $toolUse['input']);
            $actions[] = ['type' => $toolUse['name'], 'description' => $toolResult['description'] ?? $toolUse['name']];
            if (isset($toolResult['hm_idx'])) $projectHmIdx = $toolResult['hm_idx'];
            if (isset($toolResult['data_updated'])) $dataUpdated = true;
            $toolResults[] = ['type' => 'tool_result', 'tool_use_id' => $toolUse['id'], 'content' => json_encode($toolResult, JSON_UNESCAPED_UNICODE)];
        }

        $claudeMessages = [];
        foreach ($messages as $msg) {
            $claudeMessages[] = ['role' => $msg['role'] === 'user' ? 'user' : 'assistant', 'content' => $msg['content']];
        }
        $claudeMessages[] = ['role' => 'assistant', 'content' => $content];
        $claudeMessages[] = ['role' => 'user', 'content' => $toolResults];

        $response = callClaudeAPI($apiKey, $config['anthropic'], $systemPrompt, $claudeMessages);
        if (isset($response['error'])) break;
    }

    return ['message' => $textMessage, 'actions' => $actions, 'project_hm_idx' => $projectHmIdx, 'data_updated' => $dataUpdated];
}
?>
