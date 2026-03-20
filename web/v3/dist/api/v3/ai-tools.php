<?php
/**
 * SmartFlat CMS v3 - AI Tool Definitions & Execution
 * Claude Tool Use를 통한 DB 자동 조작
 */

/**
 * Build system prompt with SmartFlat data structure
 */
function buildSystemPrompt($currentProject) {
    $contextInfo = '';
    if ($currentProject) {
        $contextInfo = "\n\n## 현재 프로젝트 정보\n" .
            "- projectid: {$currentProject['hm_projectid']}\n" .
            "- projectname: " . ($currentProject['hm_projectname'] ?? '') . "\n" .
            "- orientation: {$currentProject['hm_orientation']}\n" .
            "- width: " . ($currentProject['hm_width'] ?: '1080') . "\n" .
            "- height: " . ($currentProject['hm_height'] ?: '1920') . "\n" .
            "- language: " . ($currentProject['hm_language'] ?? 'KO') . "\n" .
            "- 현재 홈화면 요소 수: " . count($currentProject['home_data'] ?? []) . "\n" .
            "- 현재 메인화면 요소 수: " . count($currentProject['main_data'] ?? []) . "\n" .
            "- 현재 콘텐츠 수: " . count($currentProject['content_data'] ?? []) . "\n";

        if (!empty($currentProject['home_data'])) {
            $contextInfo .= "- 현재 홈화면 JSON: " . json_encode($currentProject['home_data'], JSON_UNESCAPED_UNICODE) . "\n";
        }
        if (!empty($currentProject['content_data'])) {
            $contextInfo .= "- 현재 콘텐츠 JSON: " . json_encode($currentProject['content_data'], JSON_UNESCAPED_UNICODE) . "\n";
        }
    }

    return <<<PROMPT
당신은 SmartFlat CMS의 AI 어시스턴트입니다.
키오스크/디지털 사이니지 콘텐츠를 자동 생성합니다.
사용자의 자연어 요청을 해석하여 tool을 호출하고 프로젝트를 생성/수정합니다.

## 핵심 규칙
1. 항상 한국어로 응답하세요
2. tool을 적극적으로 사용하여 DB에 직접 반영하세요
3. 프로젝트 생성 시 create_project → set_home_data → set_content_data 순서로 호출
4. 수정 시 현재 프로젝트 데이터를 참고하여 변경

## 데이터 구조 (tb_home)
- hm_home_data: 홈화면 요소 JSON 배열 (로고, 배경, 날짜, 시간, 메뉴진입)
- hm_main_data: 메인화면 요소 JSON 배열 (메뉴 버튼들)
- hm_content_data: 콘텐츠 목록 JSON 배열

## 홈/메인 요소 타입
| type | 용도 | 필수 속성 |
|------|------|----------|
| img | 이미지 | id, name, type:"img", imgurl, x, y |
| button | 버튼 | id, name, type:"button", imgurl, clickurl, x, y, event:{page,tab,sub} |
| text | 텍스트 | id, name, type:"text", x, y, fontsize, fontcolor, textalign |
| video | 영상 | id, name, type:"video", videourl, x, y, w, h |
| bgcolor | 배경색 | id, name, type:"bgcolor", color |

## 텍스트 타입 (texttype 속성)
- (없음): 정적 텍스트 (text 속성에 내용)
- m/d: 월/일 자동 표시
- hh:mm: 시:분 자동 표시
- weekday: 요일 자동 표시
- yyyy: 연도
- yyyymmdd: 전체 날짜
- text_notice: 공지사항

## 콘텐츠 타입 (content type)
html, gallery, gallery1, gallery2, video_gallery, board, survey, lyrics, mapimg, game, webpage, faq, floor, pdf_gallery

## 좌표 기준
- 세로(P): 1080x1920, 가로(L): 1920x1080
- x, y: 요소 중앙 좌표
- button의 event.tab: content_data 배열 인덱스와 매핑

## 버튼 이벤트
- event.page: "main" (메인화면으로 이동)
- event.tab: 콘텐츠 인덱스 (0부터)
- event.sub: 서브탭 (보통 "0")

## 홈화면 기본 구성 (학교형 예시, 세로 1080x1920)
1. bgcolor: 배경색 (밝은 톤: #F0F4FF, 다크: #1a1a2e)
2. text(yyyymmdd): 날짜 표시 (x:300, y:80, fontsize:28)
3. text(hh:mm): 시간 표시 (x:780, y:80, fontsize:28)
4. text(weekday): 요일 (x:540, y:130, fontsize:24)
5. img: 로고/학교명 이미지 (x:540, y:350)
6. button: 터치하여 시작 (x:540, y:1600, event:{page:"main",tab:"0",sub:"0"})

## 메인화면 구성 (버튼 3개 예시, 세로)
- button 1: (x:540, y:600, event:{page:"main",tab:"0",sub:"0"})
- button 2: (x:540, y:900, event:{page:"main",tab:"1",sub:"0"})
- button 3: (x:540, y:1200, event:{page:"main",tab:"2",sub:"0"})
버튼 간격: 약 300px, 세로 중앙 정렬

## 콘텐츠 목록 구성
tab 값은 "0"부터 순서대로. 각 콘텐츠에 id, name, type, tab, sub 필수.
{$contextInfo}
PROMPT;
}

/**
 * Tool definitions for Claude API
 */
function getToolDefinitions() {
    return [
        [
            'name' => 'create_project',
            'description' => '새 키오스크 프로젝트를 tb_home 테이블에 생성합니다. 프로젝트 ID, 이름, 화면 방향, 해상도를 설정합니다.',
            'input_schema' => [
                'type' => 'object',
                'properties' => [
                    'projectid' => ['type' => 'string', 'description' => '프로젝트 ID (영문/숫자/언더스코어)'],
                    'projectname' => ['type' => 'string', 'description' => '프로젝트 표시 이름 (한글 가능)'],
                    'orientation' => ['type' => 'string', 'enum' => ['P', 'L'], 'description' => 'P=세로, L=가로'],
                    'width' => ['type' => 'integer', 'description' => '화면 너비 (기본 1080)'],
                    'height' => ['type' => 'integer', 'description' => '화면 높이 (기본 1920)'],
                    'language' => ['type' => 'string', 'description' => '기본 언어 (KO, EN 등)']
                ],
                'required' => ['projectid', 'projectname']
            ]
        ],
        [
            'name' => 'set_home_data',
            'description' => '프로젝트의 홈화면(hm_home_data) JSON을 설정합니다. 배경, 로고, 날짜/시간, 메뉴진입 버튼 등의 요소 배열입니다.',
            'input_schema' => [
                'type' => 'object',
                'properties' => [
                    'hm_idx' => ['type' => 'integer', 'description' => 'tb_home의 hm_idx'],
                    'elements' => [
                        'type' => 'array',
                        'description' => '홈화면 요소 배열',
                        'items' => ['type' => 'object']
                    ]
                ],
                'required' => ['hm_idx', 'elements']
            ]
        ],
        [
            'name' => 'set_main_data',
            'description' => '프로젝트의 메인화면(hm_main_data) JSON을 설정합니다. 메뉴 버튼들의 배열입니다.',
            'input_schema' => [
                'type' => 'object',
                'properties' => [
                    'hm_idx' => ['type' => 'integer', 'description' => 'tb_home의 hm_idx'],
                    'elements' => [
                        'type' => 'array',
                        'description' => '메인화면 요소 배열',
                        'items' => ['type' => 'object']
                    ]
                ],
                'required' => ['hm_idx', 'elements']
            ]
        ],
        [
            'name' => 'set_content_data',
            'description' => '프로젝트의 콘텐츠(hm_content_data) JSON을 설정합니다. 콘텐츠 목록 배열입니다.',
            'input_schema' => [
                'type' => 'object',
                'properties' => [
                    'hm_idx' => ['type' => 'integer', 'description' => 'tb_home의 hm_idx'],
                    'contents' => [
                        'type' => 'array',
                        'description' => '콘텐츠 목록 배열',
                        'items' => ['type' => 'object']
                    ]
                ],
                'required' => ['hm_idx', 'contents']
            ]
        ],
        [
            'name' => 'update_project_settings',
            'description' => '프로젝트의 메타 설정을 변경합니다 (이름, 방향, 해상도, 언어 등).',
            'input_schema' => [
                'type' => 'object',
                'properties' => [
                    'hm_idx' => ['type' => 'integer'],
                    'projectname' => ['type' => 'string'],
                    'orientation' => ['type' => 'string', 'enum' => ['P', 'L']],
                    'width' => ['type' => 'integer'],
                    'height' => ['type' => 'integer'],
                    'language' => ['type' => 'string']
                ],
                'required' => ['hm_idx']
            ]
        ]
    ];
}

/**
 * Execute a tool call and return result
 */
function executeTool($toolName, $input) {
    switch ($toolName) {
        case 'create_project':
            return executeCreateProject($input);
        case 'set_home_data':
            return executeSetHomeData($input);
        case 'set_main_data':
            return executeSetMainData($input);
        case 'set_content_data':
            return executeSetContentData($input);
        case 'update_project_settings':
            return executeUpdateSettings($input);
        default:
            return ['success' => false, 'error' => 'Unknown tool: ' . $toolName];
    }
}

function executeCreateProject($input) {
    $projectId = preg_replace('/[^a-zA-Z0-9_-]/', '', $input['projectid'] ?? 'ai_project');
    $projectName = $input['projectname'] ?? $projectId;
    $orientation = ($input['orientation'] ?? 'P') === 'L' ? 'L' : 'P';
    $width = (int)($input['width'] ?? ($orientation === 'L' ? 1920 : 1080));
    $height = (int)($input['height'] ?? ($orientation === 'L' ? 1080 : 1920));
    $language = $input['language'] ?? 'KO';

    // Check if project already exists
    $existing = db()->fetchOne("SELECT hm_idx FROM tb_home WHERE hm_projectid = ?", [$projectId]);
    if ($existing) {
        return [
            'success' => true,
            'hm_idx' => (int)$existing['hm_idx'],
            'description' => "기존 프로젝트 사용: {$projectName} ({$projectId})",
            'already_exists' => true
        ];
    }

    $data = [
        'hm_projectid' => $projectId,
        'hm_projectname' => $projectName,
        'hm_orientation' => $orientation,
        'hm_width' => $width,
        'hm_height' => $height,
        'hm_language' => $language,
        'hm_all_language' => $language,
        'hm_home_data' => '[]',
        'hm_main_data' => '[]',
        'hm_content_data' => '[]',
        'hm_other' => '',
        'hm_ranking' => '',
        'hm_gr_idx' => 0,
        'hm_ch_idx' => 0
    ];

    $hmIdx = db()->insert('tb_home', $data);

    return [
        'success' => true,
        'hm_idx' => (int)$hmIdx,
        'description' => "프로젝트 생성: {$projectName} ({$projectId}, {$width}x{$height} " . ($orientation === 'L' ? '가로' : '세로') . ")"
    ];
}

function executeSetHomeData($input) {
    $hmIdx = (int)($input['hm_idx'] ?? 0);
    $elements = $input['elements'] ?? [];

    if ($hmIdx <= 0) return ['success' => false, 'error' => 'hm_idx required'];
    $exists = db()->fetchOne("SELECT hm_idx FROM tb_home WHERE hm_idx = ?", [$hmIdx]);
    if (!$exists) return ['success' => false, 'error' => 'project not found'];

    $json = json_encode($elements, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if (!$json || strlen($json) > 5242880) return ['success' => false, 'error' => 'data too large'];
    db()->update('tb_home', ['hm_home_data' => $json], 'hm_idx = ?', [$hmIdx]);

    return [
        'success' => true,
        'hm_idx' => $hmIdx,
        'data_updated' => true,
        'description' => '홈화면 구성 완료 (' . count($elements) . '개 요소)'
    ];
}

function executeSetMainData($input) {
    $hmIdx = (int)($input['hm_idx'] ?? 0);
    $elements = $input['elements'] ?? [];

    if ($hmIdx <= 0) return ['success' => false, 'error' => 'hm_idx required'];
    $exists = db()->fetchOne("SELECT hm_idx FROM tb_home WHERE hm_idx = ?", [$hmIdx]);
    if (!$exists) return ['success' => false, 'error' => 'project not found'];

    $json = json_encode($elements, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if (!$json || strlen($json) > 5242880) return ['success' => false, 'error' => 'data too large'];
    db()->update('tb_home', ['hm_main_data' => $json], 'hm_idx = ?', [$hmIdx]);

    return [
        'success' => true,
        'hm_idx' => $hmIdx,
        'data_updated' => true,
        'description' => '메인화면 구성 완료 (' . count($elements) . '개 요소)'
    ];
}

function executeSetContentData($input) {
    $hmIdx = (int)($input['hm_idx'] ?? 0);
    $contents = $input['contents'] ?? [];

    if ($hmIdx <= 0) return ['success' => false, 'error' => 'hm_idx required'];
    $exists = db()->fetchOne("SELECT hm_idx FROM tb_home WHERE hm_idx = ?", [$hmIdx]);
    if (!$exists) return ['success' => false, 'error' => 'project not found'];

    $json = json_encode($contents, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if (!$json || strlen($json) > 5242880) return ['success' => false, 'error' => 'data too large'];
    db()->update('tb_home', ['hm_content_data' => $json], 'hm_idx = ?', [$hmIdx]);

    return [
        'success' => true,
        'hm_idx' => $hmIdx,
        'data_updated' => true,
        'description' => '콘텐츠 추가 (' . count($contents) . '개)'
    ];
}

function executeUpdateSettings($input) {
    $hmIdx = (int)($input['hm_idx'] ?? 0);
    if ($hmIdx <= 0) return ['success' => false, 'error' => 'hm_idx required'];

    $data = [];
    $fields = ['hm_projectname' => 'projectname', 'hm_orientation' => 'orientation',
               'hm_width' => 'width', 'hm_height' => 'height',
               'hm_language' => 'language', 'hm_all_language' => 'language'];

    foreach ($fields as $dbField => $inputField) {
        if (isset($input[$inputField])) {
            $data[$dbField] = $input[$inputField];
        }
    }

    if (!empty($data)) {
        db()->update('tb_home', $data, 'hm_idx = ?', [$hmIdx]);
    }

    return [
        'success' => true,
        'hm_idx' => $hmIdx,
        'description' => '프로젝트 설정 변경 완료'
    ];
}
