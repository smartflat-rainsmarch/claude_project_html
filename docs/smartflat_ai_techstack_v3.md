# SmartFlat CMS v3 - AI 콘텐츠 자동 생성 기술 스택

> 작성일: 2026-03-20
> 관련 문서: smartflat_ai_design_v3.md, smartflat_ai_plan_v3.md

---

## 1. AI 모델 선정

### 1.1 역할별 AI 모델

| 역할 | AI 모델 | 제공사 | 용도 | 비용 |
|------|---------|--------|------|------|
| **메인 두뇌** | Claude Sonnet 4 | Anthropic | 프로젝트 생성, JSON 구조 생성, 자연어 이해, Tool Use | $3/$15 per 1M tokens |
| **이미지 생성** | DALL-E 3 | OpenAI | 버튼 이미지, 로고, 배경 이미지 자동 생성 | $0.04~$0.12/장 |
| **이미지 생성 (대안)** | Stable Diffusion 3.5 | Stability AI | 자체 서버 설치 시 무료, 커스터마이징 가능 | 자체 서버: GPU 비용만 |
| **이미지 편집** | GPT-4o (DALL-E) | OpenAI | 기존 이미지 편집, 배경 제거, 리사이즈 | $0.04~$0.08/장 |
| **번역** | Claude Sonnet 4 | Anthropic | 다국어 텍스트 자동 번역 (KO↔EN↔ZH↔VI↔MS) | 메인 모델과 통합 |
| **OCR/이미지 분석** | Claude Sonnet 4 | Anthropic | 업로드된 이미지 분석, 레이아웃 참고 | 메인 모델과 통합 |

### 1.2 모델 선택 이유

#### Claude Sonnet 4 (메인)
```
✅ Tool Use (Function Calling) 지원 → DB 조작 자동화
✅ 4096+ 토큰 JSON 구조 정확히 생성
✅ 한국어 이해도 높음
✅ 시스템 프롬프트로 SmartFlat 구조 학습
✅ 비용 대비 성능 최적
❌ 이미지 생성 불가 → DALL-E 3 보완
```

#### DALL-E 3 (이미지 생성)
```
✅ 텍스트 프롬프트로 고품질 이미지 생성
✅ 1024x1024, 1024x1792, 1792x1024 해상도 지원
✅ 키오스크용 버튼, 아이콘, 배경에 적합
✅ API 통합 간단 (OpenAI SDK)
❌ 한글 텍스트 렌더링 품질 낮음 → 텍스트는 별도 레이어로 처리
```

#### Stable Diffusion 3.5 (대안)
```
✅ 자체 서버 설치 가능 (비용 통제)
✅ LoRA/Fine-tuning으로 키오스크 스타일 학습
✅ ComfyUI로 파이프라인 자동화
❌ GPU 서버 필요 (NVIDIA A10G 이상)
❌ 초기 설정 복잡
```

---

## 2. 기능별 AI 모델 매핑

### 2.1 프로젝트 생성 플로우

```
사용자: "초등학교 키오스크 만들어줘"
  │
  ▼
┌─────────────────────────────────┐
│ Claude Sonnet 4                 │
│ - 프로젝트 구조 설계            │
│ - tb_home INSERT                │
│ - hm_home_data JSON 생성        │
│ - hm_content_data JSON 생성     │
│ - 버튼/메뉴 배치 좌표 계산       │
└──────────┬──────────────────────┘
           │ (이미지 필요 시)
           ▼
┌─────────────────────────────────┐
│ DALL-E 3                        │
│ - 로고 이미지 생성              │
│ - 메뉴 버튼 이미지 생성         │
│ - 배경 이미지 생성              │
│ → 파일 저장 → URL 반환          │
└──────────┬──────────────────────┘
           │
           ▼
┌─────────────────────────────────┐
│ Claude Sonnet 4                 │
│ - 이미지 URL을 JSON에 삽입      │
│ - 최종 JSON 검증                │
│ - DB 저장 (Tool Use)            │
└─────────────────────────────────┘
```

### 2.2 기능별 상세

| 기능 | AI 모델 | 입력 | 출력 |
|------|---------|------|------|
| 프로젝트 구조 생성 | Claude Sonnet 4 | 자연어 설명 | tb_home JSON |
| 홈화면 레이아웃 | Claude Sonnet 4 | 메뉴 목록 + 스타일 | hm_home_data JSON |
| 콘텐츠 목록 | Claude Sonnet 4 | 메뉴 설명 | hm_content_data JSON |
| 요소 수정 | Claude Sonnet 4 | 수정 요청 + 현재 JSON | 변경된 JSON |
| 로고 이미지 | DALL-E 3 | "학교 로고, 미니멀, 파란색" | PNG 1024x1024 |
| 버튼 이미지 | DALL-E 3 | "둥근 모서리 버튼, 학교소개 아이콘" | PNG 512x512 |
| 배경 이미지 | DALL-E 3 | "키오스크 배경, 밝은 그라데이션" | PNG 1080x1920 |
| 배경 영상 | — | 수동 업로드만 (AI 생성 불가) | — |
| 다국어 번역 | Claude Sonnet 4 | 한국어 텍스트 | KO/EN/ZH/VI/MS 텍스트 |
| 이미지 기반 레이아웃 | Claude Sonnet 4 (Vision) | 참고 이미지 업로드 | 유사 레이아웃 JSON |

---

## 3. 기술 스택 전체

### 3.1 프론트엔드

| 기술 | 버전 | 용도 |
|------|------|------|
| HTML5 / CSS3 | - | AI 입력 바 UI |
| JavaScript (Vanilla) | ES5+ | AI 입력 로직, API 호출 |
| jQuery | 3.5.1 | 기존 CMS와 호환 (DOM 조작) |
| Font Awesome | 6.4.0 | 아이콘 |
| marked.js | 최신 | AI 응답 Markdown 렌더링 (선택) |
| highlight.js | 최신 | 코드 블록 하이라이팅 (선택) |

### 3.2 백엔드

| 기술 | 버전 | 용도 |
|------|------|------|
| PHP | 7.4+ | AI API 프록시, DB 조작 |
| PHP cURL | 내장 | Anthropic/OpenAI API 호출 |
| PDO | 내장 | MySQL DB 연결 (prepared statements) |
| Apache (XAMPP) | 2.4 | 웹 서버 |
| MySQL/MariaDB | 10.4+ | 데이터베이스 (smartflat_claude_html) |

### 3.3 AI 서비스 (외부 API)

| 서비스 | API 엔드포인트 | 인증 | 용도 |
|--------|---------------|------|------|
| **Anthropic Claude API** | `https://api.anthropic.com/v1/messages` | `x-api-key` 헤더 | 메인 AI (텍스트 + Tool Use) |
| **OpenAI DALL-E 3 API** | `https://api.openai.com/v1/images/generations` | `Authorization: Bearer` | 이미지 생성 |
| **OpenAI GPT-4o API** | `https://api.openai.com/v1/chat/completions` | `Authorization: Bearer` | 이미지 편집 (선택) |

### 3.4 파일 저장

| 항목 | 경로 | 용도 |
|------|------|------|
| AI 생성 이미지 | `/game/school/{projectid}/v0/res/ai_generated/` | DALL-E가 생성한 이미지 |
| 업로드 이미지 | `/game/school/{projectid}/v0/res/` | 사용자 업로드 |
| AI 설정 | `/web/v3/dist/config/ai.php` | API 키, 모델 설정 |

---

## 4. API 키 관리

### 4.1 필요한 API 키

| 키 | 환경변수 | 필수 | 취득 방법 |
|----|---------|------|----------|
| Anthropic API Key | `ANTHROPIC_API_KEY` | ✅ | https://console.anthropic.com/settings/keys |
| OpenAI API Key | `OPENAI_API_KEY` | 이미지 생성 시 | https://platform.openai.com/api-keys |

### 4.2 설정 파일 구조

```php
// config/ai.php
<?php
return [
    // Claude API (필수)
    'anthropic' => [
        'api_key' => getenv('ANTHROPIC_API_KEY') ?: 'sk-ant-...',
        'model' => 'claude-sonnet-4-20250514',
        'max_tokens' => 4096,
    ],

    // DALL-E 3 (이미지 생성 시)
    'openai' => [
        'api_key' => getenv('OPENAI_API_KEY') ?: 'sk-...',
        'image_model' => 'dall-e-3',
        'image_size' => '1024x1024',  // 1024x1024, 1024x1792, 1792x1024
        'image_quality' => 'standard', // standard, hd
    ],

    // Rate Limiting
    'rate_limit' => [
        'max_requests_per_minute' => 10,
        'max_tokens_per_request' => 4096,
        'max_prompt_length' => 2000,
    ],

    // 이미지 저장 경로
    'image_base_path' => __DIR__ . '/../../../../game/school/',
    'image_base_url' => '../../../game/school/',
];
```

---

## 5. AI 파이프라인 상세

### 5.1 텍스트 → 프로젝트 (Claude)

```
입력: "도서관 키오스크를 만들어줘"

시스템 프롬프트 → Claude Sonnet 4 → Tool Use 응답:

Tool Call 1: create_project
  → {projectid: "library_demo", projectname: "도서관", orientation: "P", width: 1080, height: 1920}

Tool Call 2: set_home_data
  → [{type:"bgcolor", color:"#1a237e"}, {type:"img", id:"home_logo", x:540, y:200}, ...]

Tool Call 3: set_content_data
  → [{id:"content_0", name:"도서검색", type:"html", tab:"0"}, ...]
```

### 5.2 텍스트 → 이미지 (DALL-E 3)

```
Claude가 이미지 필요성 판단 → DALL-E 3 호출:

프롬프트: "A clean, modern kiosk button icon for 'Library Search'.
           Flat design, blue gradient background, white book icon.
           512x512, no text, minimal style."

→ DALL-E 3 응답: base64 이미지 또는 URL
→ 서버에 저장: /game/school/library_demo/v0/res/ai_generated/btn_search.png
→ Claude에 URL 전달 → JSON에 imgurl로 삽입
```

### 5.3 이미지 생성 프롬프트 템플릿

| 카테고리 | DALL-E 프롬프트 템플릿 |
|----------|----------------------|
| 로고 | `"A modern, minimal logo for {name}. Clean vector style, {color} theme, suitable for digital kiosk display. No text, icon only, white background."` |
| 메뉴 버튼 | `"A flat design kiosk button icon for '{menu_name}'. Rounded rectangle, {color} gradient, white icon. 512x512, no text, minimal."` |
| 배경 | `"A clean, professional kiosk background. {style} theme, {color} gradient, 1080x1920 portrait orientation. No text, abstract geometric pattern."` |
| 클릭 버튼 | `"Same as normal button but with pressed/active state. Darker {color}, subtle shadow effect."` |

### 5.4 이미지 후처리

```
DALL-E 3 출력 (1024x1024)
  │
  ▼ PHP GD Library 또는 ImageMagick
  ├── 리사이즈 (버튼: 300x200, 로고: 400x400, 배경: 1080x1920)
  ├── PNG 최적화 (pngquant)
  ├── 파일 저장 (/res/ai_generated/)
  └── URL 반환 (../../../game/school/{pid}/v0/res/ai_generated/xxx.png)
```

---

## 6. 통신 프로토콜

### 6.1 프론트엔드 → 백엔드

```javascript
// js/ai-prompt.js
var res = await V3Api.post('/ai', {
    prompt: "초등학교 키오스크 만들어줘",
    context: {
        current_hm_idx: getGlobalProjectHmIdx(),  // 현재 프로젝트
        current_page: V3App.currentPage,           // 현재 페이지
        generate_images: true                      // 이미지 생성 여부
    }
});
```

### 6.2 백엔드 → Claude API

```php
// api/v3/ai.php
$response = callAnthropicAPI([
    'model' => $config['anthropic']['model'],
    'max_tokens' => $config['anthropic']['max_tokens'],
    'system' => $systemPrompt,
    'messages' => $messages,
    'tools' => $toolDefinitions
]);
```

### 6.3 백엔드 → DALL-E 3 API

```php
// api/v3/ai.php (이미지 생성)
function generateImage($prompt, $size = '1024x1024') {
    $config = require(__DIR__ . '/../../config/ai.php');

    $ch = curl_init('https://api.openai.com/v1/images/generations');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $config['openai']['api_key']
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'model' => 'dall-e-3',
        'prompt' => $prompt,
        'n' => 1,
        'size' => $size,
        'response_format' => 'b64_json'  // base64로 받아서 서버에 저장
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);

    // base64 → 파일 저장
    $imageData = base64_decode($result['data'][0]['b64_json']);
    $filename = 'ai_' . time() . '_' . rand(1000, 9999) . '.png';
    $path = $config['image_base_path'] . $projectId . '/v0/res/ai_generated/';
    if (!is_dir($path)) mkdir($path, 0777, true);
    file_put_contents($path . $filename, $imageData);

    return $config['image_base_url'] . $projectId . '/v0/res/ai_generated/' . $filename;
}
```

### 6.4 응답 → 프론트엔드

```json
{
    "code": 100,
    "data": {
        "message": "초등학교 키오스크 프로젝트를 생성했습니다.",
        "actions": [
            {"type": "create_project", "description": "프로젝트 생성: school_demo (1080x1920)"},
            {"type": "generate_image", "description": "로고 이미지 생성"},
            {"type": "generate_image", "description": "메뉴 버튼 3개 생성"},
            {"type": "set_home_data", "description": "홈화면 구성 (8개 요소)"},
            {"type": "set_content_data", "description": "콘텐츠 3개 추가"}
        ],
        "project_hm_idx": 15,
        "images_generated": 4,
        "tokens_used": 2340
    }
}
```

---

## 7. 비용 예측

### 7.1 단일 프로젝트 생성 비용

| 항목 | 토큰/건수 | 단가 | 비용 |
|------|----------|------|------|
| Claude 시스템 프롬프트 | ~2,000 input | $3/1M | $0.006 |
| Claude 사용자 프롬프트 | ~200 input | $3/1M | $0.0006 |
| Claude 응답 (Tool Use) | ~3,000 output | $15/1M | $0.045 |
| DALL-E 3 로고 | 1장 | $0.04 | $0.04 |
| DALL-E 3 버튼 | 4장 | $0.04 | $0.16 |
| DALL-E 3 배경 | 1장 (1024x1792) | $0.08 | $0.08 |
| **합계** | | | **~$0.33/프로젝트** |

### 7.2 월간 비용 예측

| 사용량 | 프로젝트 생성 | 요소 수정 | 이미지 생성 | 월 비용 |
|--------|-------------|----------|------------|---------|
| 소규모 (10건/월) | 10 | 50 | 60 | ~$6 |
| 중규모 (50건/월) | 50 | 200 | 300 | ~$30 |
| 대규모 (200건/월) | 200 | 800 | 1,200 | ~$120 |

---

## 8. 대안 기술 비교

### 8.1 AI 모델 대안

| 모델 | 장점 | 단점 | 적합도 |
|------|------|------|--------|
| **Claude Sonnet 4** (선택) | Tool Use, 한국어, JSON 정확 | 이미지 생성 불가 | ⭐⭐⭐⭐⭐ |
| GPT-4o | Tool Use, 이미지 입력 | Claude 대비 JSON 정확도 낮음 | ⭐⭐⭐⭐ |
| Gemini 2.0 Flash | 무료 티어, 빠름 | Tool Use 제한적 | ⭐⭐⭐ |
| Llama 3.3 (자체 호스팅) | 비용 없음, 프라이버시 | GPU 서버 필요, 품질 낮음 | ⭐⭐ |

### 8.2 이미지 생성 대안

| 모델 | 장점 | 단점 | 적합도 |
|------|------|------|--------|
| **DALL-E 3** (선택) | API 간편, 고품질 | 비용, 한글 텍스트 약함 | ⭐⭐⭐⭐⭐ |
| Midjourney | 최고 품질 | API 없음 (Discord만) | ⭐⭐ |
| Stable Diffusion 3.5 | 자체 서버, 무료 | GPU 필요, 설정 복잡 | ⭐⭐⭐⭐ |
| Flux.1 | 고품질, 빠름 | API 제한적 | ⭐⭐⭐ |
| Ideogram 2.0 | 텍스트 렌더링 우수 | API 제한적 | ⭐⭐⭐ |

### 8.3 향후 확장 가능 모델

| 기능 | 모델 | 시기 |
|------|------|------|
| 영상 생성 | Sora (OpenAI) / Runway Gen-3 | Phase D+ |
| 음성 합성 | OpenAI TTS / ElevenLabs | Phase D+ |
| 3D 모델 | Meshy / Tripo | Phase D+ |
| 실시간 번역 | DeepL API | Phase C |

---

## 9. 인프라 요구사항

### 9.1 현재 환경 (개발)

```
서버: localhost (XAMPP)
PHP: 7.4+
MySQL: MariaDB 10.4+
메모리: 2GB+ 권장
디스크: AI 이미지 저장 공간 (프로젝트당 ~50MB)
네트워크: 외부 API 호출 가능 (Anthropic, OpenAI)
```

### 9.2 프로덕션 권장

```
서버: AWS EC2 t3.medium 이상 / VPS
PHP: 8.1+
MySQL: MariaDB 10.6+
SSL: HTTPS 필수 (API 키 보안)
CDN: 이미지 서빙 (CloudFront/Cloudflare)
캐시: Redis (선택, 프롬프트 캐싱)
```

---

## 10. 요약: 핵심 기술 스택

```
┌─────────────────────────────────────────────┐
│              SmartFlat AI Stack              │
├─────────────────────────────────────────────┤
│                                             │
│  🧠 AI 두뇌: Claude Sonnet 4 (Anthropic)    │
│     - 프로젝트 설계, JSON 생성, Tool Use     │
│     - 다국어 번역, 이미지 분석 (Vision)      │
│                                             │
│  🎨 이미지: DALL-E 3 (OpenAI)               │
│     - 로고, 버튼, 배경 이미지 자동 생성      │
│     - 1024x1024 ~ 1024x1792                 │
│                                             │
│  🖥️ 프론트엔드: Vanilla JS + jQuery         │
│     - AI 입력 바 (하단 고정)                 │
│     - V3Api로 REST 호출                      │
│                                             │
│  ⚙️ 백엔드: PHP 7.4+ (cURL)                 │
│     - AI API 프록시                          │
│     - Tool 실행 → DB 반영                    │
│     - 이미지 저장/리사이즈                    │
│                                             │
│  💾 DB: MySQL (smartflat_claude_html)        │
│     - tb_home (프로젝트 + JSON 데이터)       │
│                                             │
│  🔑 API Keys:                               │
│     - ANTHROPIC_API_KEY (필수)               │
│     - OPENAI_API_KEY (이미지 생성 시)        │
│                                             │
│  💰 비용: ~$0.33/프로젝트 생성               │
│                                             │
└─────────────────────────────────────────────┘
```
