# SmartFlat CMS v3 - AI 콘텐츠 자동 생성 설계서

> 작성일: 2026-03-20
> 버전: 1.0
> 참고: smartflat_cms_ai_content_generation_spec.md (기존 기획서)

---

## 1. 개요

### 1.1 목표
CMS 하단에 Claude Code 스타일의 AI 입력창을 추가하여, 자연어 명령으로 프로젝트 생성, 화면 구성, 콘텐츠 추가를 자동화한다.

### 1.2 핵심 컨셉
```
사용자: "초등학교 키오스크를 만들어줘. 학교소개, 급식, 공지사항 메뉴 필요해"
  ↓
AI가 자동으로:
  1. tb_home에 프로젝트 INSERT (hm_projectid, 해상도, 방향)
  2. hm_home_data JSON 생성 (배경, 로고, 날짜/시간 텍스트, 메뉴 버튼 배치)
  3. hm_main_data JSON 생성 (메인 화면 요소)
  4. hm_content_data JSON 생성 (학교소개, 급식, 공지사항)
  5. 헤더 프로젝트 목록 갱신 + 미리보기 표시
```

---

## 2. 시스템 아키텍처

### 2.1 전체 흐름
```
┌─────────────────────────────────────────────────┐
│  SmartFlat CMS v3 (Browser)                     │
│                                                  │
│  ┌────────────────────────────────────────────┐  │
│  │ header.php    [프로젝트▼] [⏻] [+] [🔍]    │  │
│  ├──────┬─────────────────────────────────────┤  │
│  │ side │  #main-content                      │  │
│  │ bar  │  (대시보드/에디터/설정)              │  │
│  │      │                                     │  │
│  │      │                                     │  │
│  │      ├─────────────────────────────────────┤  │
│  │      │  #ai-prompt-bar ★                   │  │
│  │      │  ┌─────────────────────────┐ ┌────┐│  │
│  │      │  │ AI에게 요청하세요...     │ │전송││  │
│  │      │  └─────────────────────────┘ └────┘│  │
│  └──────┴─────────────────────────────────────┘  │
│                       │                          │
│                       ▼                          │
│  ┌────────────────────────────────────────────┐  │
│  │  /api/v3/ai.php (서버 프록시)              │  │
│  │  ├─ 사용자 프롬프트 수신                   │  │
│  │  ├─ 현재 프로젝트 컨텍스트 조합            │  │
│  │  ├─ Claude API 호출 (Tool Use)             │  │
│  │  ├─ Tool 결과 → DB 반영 (tb_home CRUD)     │  │
│  │  └─ 결과 응답 (JSON)                       │  │
│  └────────────────────────────────────────────┘  │
│                       │                          │
│                       ▼                          │
│  ┌────────────────────────────────────────────┐  │
│  │  Claude API (Anthropic)                    │  │
│  │  model: claude-sonnet-4-20250514                │  │
│  │  tools: create_project, set_home_data,     │  │
│  │         set_content_data, modify_element   │  │
│  └────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────┘
```

### 2.2 파일 구성

| 파일 | 역할 | 신규/수정 |
|------|------|----------|
| `main.php` | AI 입력 바 HTML 추가 | 수정 |
| `css/ai-prompt.css` | AI 입력 바 스타일 | 신규 |
| `js/ai-prompt.js` | AI 입력 바 로직 (전송, 응답 표시, 히스토리) | 신규 |
| `api/v3/ai.php` | Claude API 프록시 + DB 반영 | 신규 |
| `api/v3/ai-tools.php` | Tool 정의 + 실행 함수 | 신규 |
| `api/v3/router.php` | `ai` 리소스 등록 | 수정 |

---

## 3. 프론트엔드 설계

### 3.1 AI 입력 바 HTML (main.php에 추가)

```html
<!-- AI Prompt Bar - 하단 고정 -->
<div id="ai-prompt-bar" class="ai-prompt-bar">
    <!-- 응답 영역 (토글) -->
    <div id="ai-response-area" class="ai-response-area" style="display:none;">
        <div class="ai-response-header">
            <span>🤖 AI 어시스턴트</span>
            <button onclick="aiPrompt.toggleResponse()">✕</button>
        </div>
        <div id="ai-response-content" class="ai-response-content"></div>
    </div>

    <!-- 입력 영역 -->
    <div class="ai-input-area">
        <div class="ai-input-wrapper">
            <textarea id="ai-input" placeholder="AI에게 요청하세요... (예: 학교 키오스크를 만들어줘)"
                      rows="1" onkeydown="aiPrompt.onKeyDown(event)"></textarea>
            <button id="ai-send-btn" onclick="aiPrompt.send()">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>
```

### 3.2 AI 입력 바 스타일

```css
.ai-prompt-bar {
    position: fixed;
    bottom: 0;
    left: var(--sidebar-width);  /* 사이드바 너비만큼 오프셋 */
    right: 0;
    background: var(--bg-card);
    border-top: 1px solid var(--border-color);
    z-index: 1000;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.08);
}

.ai-input-wrapper {
    display: flex;
    align-items: flex-end;
    gap: 8px;
    padding: 12px 20px;
    max-width: 900px;
    margin: 0 auto;
}

.ai-input-wrapper textarea {
    flex: 1;
    resize: none;
    border: 1px solid var(--border-color);
    border-radius: 12px;
    padding: 10px 16px;
    font-size: 14px;
    max-height: 120px;
    outline: none;
}

.ai-input-wrapper textarea:focus {
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(0,158,247,0.1);
}

.ai-send-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--color-primary);
    color: white;
    border: none;
    cursor: pointer;
}

.ai-response-area {
    max-height: 400px;
    overflow-y: auto;
    padding: 16px 20px;
    background: var(--bg-main);
    border-bottom: 1px solid var(--border-color);
}

.ai-response-content .ai-step {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 4px 0;
    font-size: 13px;
}

.ai-step.done { color: var(--color-success); }
.ai-step.loading { color: var(--text-muted); }
.ai-step.error { color: var(--color-danger); }
```

### 3.3 AI 입력 바 로직 (js/ai-prompt.js)

```javascript
var aiPrompt = {
    history: [],
    historyIdx: -1,
    isProcessing: false,

    // 전송
    async send() {
        var input = document.getElementById('ai-input');
        var prompt = input.value.trim();
        if (!prompt || this.isProcessing) return;

        this.isProcessing = true;
        this.showResponse();
        this.addStep('loading', '요청을 처리하고 있습니다...');
        input.value = '';

        // 컨텍스트 수집
        var context = {
            current_hm_idx: getGlobalProjectHmIdx(),
            current_page: V3App.currentPage,
            user_language: 'KO'
        };

        try {
            var res = await V3Api.post('/ai', { prompt, context });
            if (res.code === 100 && res.data) {
                this.handleResponse(res.data);
            } else {
                this.addStep('error', res.message || '처리 실패');
            }
        } catch (err) {
            this.addStep('error', '요청 처리 중 에러가 발생했습니다.');
        }

        this.isProcessing = false;
        this.history.push(prompt);
    },

    // AI 응답 처리
    handleResponse(data) {
        // 각 액션 결과를 단계별로 표시
        if (data.actions) {
            data.actions.forEach(action => {
                this.addStep('done', action.description);
            });
        }
        if (data.message) {
            this.addStep('done', data.message);
        }

        // 프로젝트 목록 갱신
        loadGlobalProjects();

        // 현재 프로젝트면 미리보기 갱신
        if (data.project_hm_idx) {
            var sel = document.getElementById('global-project-select');
            if (sel) sel.value = data.project_hm_idx;
            onGlobalProjectChange(data.project_hm_idx);
        }
    }
};
```

### 3.4 키보드 단축키

| 단축키 | 동작 |
|--------|------|
| `Enter` | 전송 |
| `Shift+Enter` | 줄바꿈 |
| `Ctrl+/` | AI 입력창 포커스 |
| `Escape` | 응답 영역 닫기 |
| `↑` (빈 입력창에서) | 이전 프롬프트 |

---

## 4. 백엔드 설계

### 4.1 AI API 프록시 (api/v3/ai.php)

```php
<?php
// POST /ai
Auth::requireRole(Auth::ROLE_CONTENT_MANAGER);

$prompt = $request['input']['prompt'] ?? '';
$context = $request['input']['context'] ?? [];

// 1. 현재 프로젝트 데이터 로드 (컨텍스트)
$currentData = null;
if (!empty($context['current_hm_idx'])) {
    $currentData = db()->fetchOne("SELECT * FROM tb_home WHERE hm_idx = ?",
        [(int)$context['current_hm_idx']]);
}

// 2. Claude API 호출
$response = callClaude($prompt, $currentData);

// 3. Tool Use 결과 → DB 반영
$actions = executeTools($response['tool_calls'], $currentData);

// 4. 결과 응답
ApiResponse::success([
    'message' => $response['text'],
    'actions' => $actions,
    'project_hm_idx' => $actions[0]['hm_idx'] ?? null
]);
```

### 4.2 Claude API 호출

```php
function callClaude($prompt, $projectContext) {
    $apiKey = getenv('ANTHROPIC_API_KEY');
    // 또는 config 파일에서 로드

    $systemPrompt = buildSystemPrompt($projectContext);

    $payload = [
        'model' => 'claude-sonnet-4-20250514',
        'max_tokens' => 4096,
        'system' => $systemPrompt,
        'messages' => [
            ['role' => 'user', 'content' => $prompt]
        ],
        'tools' => getToolDefinitions()
    ];

    // cURL로 Anthropic API 호출
    $ch = curl_init('https://api.anthropic.com/v1/messages');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'x-api-key: ' . $apiKey,
        'anthropic-version: 2023-06-01'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);

    return json_decode($result, true);
}
```

### 4.3 Tool Definitions

| Tool | 설명 | 파라미터 |
|------|------|----------|
| `create_project` | 새 프로젝트 생성 | projectid, projectname, orientation, width, height, language |
| `set_home_data` | 홈화면 전체 설정 | hm_idx, elements[] |
| `set_main_data` | 메인화면 전체 설정 | hm_idx, elements[] |
| `set_content_data` | 콘텐츠 전체 설정 | hm_idx, contents[] |
| `add_element` | 요소 1개 추가 | hm_idx, data_type, element |
| `modify_element` | 요소 수정 | hm_idx, data_type, element_id, changes |
| `remove_element` | 요소 삭제 | hm_idx, data_type, element_id |

### 4.4 Tool 실행 (DB 반영)

```php
function executeTools($toolCalls, $currentData) {
    $results = [];

    foreach ($toolCalls as $call) {
        switch ($call['name']) {
            case 'create_project':
                $hm_idx = createNewProject($call['input']);
                $results[] = ['action' => 'create_project',
                              'hm_idx' => $hm_idx,
                              'description' => '프로젝트 생성: ' . $call['input']['projectname']];
                break;

            case 'set_home_data':
                $json = json_encode($call['input']['elements'], JSON_UNESCAPED_UNICODE);
                db()->update('tb_home', ['hm_home_data' => $json],
                    'hm_idx = ?', [(int)$call['input']['hm_idx']]);
                $results[] = ['action' => 'set_home_data',
                              'description' => '홈화면 구성 완료 (' . count($call['input']['elements']) . '개 요소)'];
                break;

            case 'set_content_data':
                $json = json_encode($call['input']['contents'], JSON_UNESCAPED_UNICODE);
                db()->update('tb_home', ['hm_content_data' => $json],
                    'hm_idx = ?', [(int)$call['input']['hm_idx']]);
                $results[] = ['action' => 'set_content_data',
                              'description' => '콘텐츠 추가 (' . count($call['input']['contents']) . '개)'];
                break;
                // ... 기타 tool 처리
        }
    }

    return $results;
}
```

---

## 5. 시스템 프롬프트

AI에게 SmartFlat CMS 데이터 구조를 완전히 이해시키는 시스템 프롬프트:

```
당신은 SmartFlat CMS의 AI 어시스턴트입니다.
키오스크/디지털 사이니지 콘텐츠를 자동 생성합니다.

## 데이터 구조 (tb_home)
- hm_home_data: 홈화면 요소 JSON 배열
- hm_main_data: 메인화면 요소 JSON 배열
- hm_content_data: 콘텐츠 목록 JSON 배열

## 홈/메인 요소 타입
| type | 용도 | 필수 속성 |
|------|------|----------|
| img | 이미지 | id, name, imgurl, x, y |
| button | 버튼 | id, name, imgurl, clickurl, x, y, event:{page,tab,sub} |
| text | 텍스트 | id, name, fontsize, fontcolor, textalign, x, y, texttype? |
| video | 영상 | id, name, videourl, x, y, w, h |
| bgcolor | 배경색 | id, name, color |

## 텍스트 타입 (texttype)
- m/d: 월/일, hh:mm: 시:분, weekday: 요일, yyyy: 연도, text_notice: 공지

## 콘텐츠 타입 (content type)
- html, gallery, video_gallery, board, survey, lyrics, mapimg, game, webpage

## 좌표 기준
- 해상도: 세로(P) 1080x1920, 가로(L) 1920x1080
- x, y: 요소 중앙 좌표
- button의 event.tab: content_data 배열의 인덱스

## 규칙
1. JSON은 항상 배열 형태 []
2. ID는 고유 (home_btn0, content_0 등)
3. 이미지 경로: ../../../game/school/{projectid}/v0/res/...
4. 버튼 event.tab은 content_data 인덱스와 매핑
5. 한국어 응답
```

---

## 6. 프롬프트 예시

### 6.1 프로젝트 생성
```
입력: "도서관 키오스크를 만들어줘. 도서검색, 신착도서, 이용안내 메뉴"
→ create_project + set_home_data + set_content_data
```

### 6.2 요소 수정
```
입력: "로고를 화면 가운데 위쪽으로 옮겨줘"
→ modify_element (home_logo, x:540, y:150)
```

### 6.3 콘텐츠 추가
```
입력: "설문조사 메뉴를 추가해줘"
→ add_element (content_data, survey 타입)
→ add_element (home_data, button 추가)
```

### 6.4 전체 재구성
```
입력: "홈화면 배경을 어두운 테마로 바꾸고 버튼을 2열로 배치해줘"
→ modify_element (bgcolor → 어두운색)
→ modify_element (각 버튼 x,y 재배치)
```

---

## 7. 보안

| 항목 | 대응 |
|------|------|
| API 키 노출 | 서버 환경변수만 사용, 프론트엔드 노출 없음 |
| 프롬프트 인젝션 | 시스템 프롬프트로 역할 제한, JSON 스키마 검증 |
| Rate Limiting | 분당 10회 제한 |
| 입력 길이 | 최대 2,000자 |
| DB 조작 | Tool 결과만 DB 반영 (직접 SQL 실행 없음) |
| 인증 | 세션 인증 + CSRF 토큰 필수 |

---

## 8. 의존성

| 항목 | 용도 | 필수 |
|------|------|------|
| Anthropic Claude API | AI 텍스트 생성 + Tool Use | ✅ |
| ANTHROPIC_API_KEY | 환경변수 또는 config | ✅ |
| PHP cURL | API 호출 | ✅ |
| PHP 7.4+ | json_encode/decode | ✅ |
