# SmartFlat CMS v3 - AI 콘텐츠 자동 생성 구현 계획서

> 작성일: 2026-03-20
> 설계서: smartflat_ai_design_v3.md

---

## 구현 Phase

### Phase A: 프론트엔드 AI 입력 바 (기본)

| # | 작업 | 파일 | 설명 |
|---|------|------|------|
| A-1 | AI 입력 바 HTML | `main.php` | 하단 고정 입력창 + 응답 영역 |
| A-2 | AI 입력 바 CSS | `css/ai-prompt.css` | 스타일, 애니메이션, 반응형 |
| A-3 | AI 입력 바 JS | `js/ai-prompt.js` | 전송, 응답 표시, 키보드 단축키, 히스토리 |
| A-4 | main.php 레이아웃 조정 | `main.php` | 하단 바 공간 확보 (padding-bottom) |

**완료 기준:** 입력창 표시, Enter로 전송, 응답 영역 토글 (API 연동 전)

---

### Phase B: 백엔드 AI API

| # | 작업 | 파일 | 설명 |
|---|------|------|------|
| B-1 | AI API 엔드포인트 | `api/v3/ai.php` | POST /ai, 프롬프트 수신 |
| B-2 | Claude API 호출 | `api/v3/ai.php` | cURL로 Anthropic API 호출 |
| B-3 | Tool 정의 | `api/v3/ai-tools.php` | create_project, set_home/main/content_data, modify/add/remove_element |
| B-4 | Tool 실행 | `api/v3/ai-tools.php` | Tool 결과 → tb_home DB 반영 |
| B-5 | 시스템 프롬프트 | `api/v3/ai-tools.php` | SmartFlat 전용 프롬프트 (데이터 구조 설명) |
| B-6 | 라우터 등록 | `api/v3/router.php` | `ai` 리소스 추가 |
| B-7 | API 키 설정 | `config/ai.php` | ANTHROPIC_API_KEY 관리 |

**완료 기준:** 프롬프트 전송 → Claude API 응답 → Tool 실행 → DB 반영

---

### Phase C: 프론트엔드 ↔ 백엔드 연동

| # | 작업 | 파일 | 설명 |
|---|------|------|------|
| C-1 | API 연동 | `js/ai-prompt.js` | V3Api.post('/ai') 호출 |
| C-2 | 응답 표시 | `js/ai-prompt.js` | 단계별 진행 표시 (✅⏳❌) |
| C-3 | 프로젝트 갱신 | `js/ai-prompt.js` | 생성 후 헤더 프로젝트 목록 갱신 |
| C-4 | 미리보기 갱신 | `js/ai-prompt.js` | 수정 후 미리보기 iframe 갱신 |
| C-5 | 에러 처리 | `js/ai-prompt.js` | API 에러, 타임아웃, 네트워크 에러 |
| C-6 | Rate Limiting | `api/v3/ai.php` | 분당 10회 제한 |

**완료 기준:** 전체 E2E 동작 — 입력 → AI 처리 → DB 반영 → 화면 갱신

---

### Phase D: 고급 기능

| # | 작업 | 설명 |
|---|------|------|
| D-1 | 프롬프트 히스토리 | ↑키로 이전 프롬프트 불러오기, localStorage 저장 |
| D-2 | 컨텍스트 인식 | 현재 선택된 프로젝트 데이터를 AI에 전달 |
| D-3 | 다단계 대화 | 이전 대화 기억하여 수정 요청 가능 |
| D-4 | 프롬프트 제안 | 빈 상태에서 예시 프롬프트 칩 표시 |
| D-5 | Markdown 렌더링 | AI 응답을 Markdown으로 표시 |

---

## 우선순위 & 의존성

```
Phase A (프론트엔드 UI)
  └── A-1 ~ A-4: UI만 구현, API 없이 동작
       │
Phase B (백엔드 API) ← A와 독립적으로 병행 가능
  ├── B-1 ~ B-2: API 기본 구조
  ├── B-3 ~ B-5: Tool 정의 + 시스템 프롬프트
  └── B-6 ~ B-7: 라우터 + 설정
       │
Phase C (연동) ← A + B 완료 필요
  └── C-1 ~ C-6: E2E 연동 + 테스트
       │
Phase D (고급) ← C 완료 후
  └── D-1 ~ D-5: 순차적 구현
```

---

## 필수 사전 준비

| 항목 | 상태 | 비고 |
|------|------|------|
| Anthropic API Key | ❌ 미설정 | `ANTHROPIC_API_KEY` 환경변수 또는 config 파일 |
| PHP cURL 확장 | ✅ XAMPP 기본 포함 | |
| tb_home 테이블 | ✅ 존재 | smartflat_claude_html DB |

---

## 리스크

| 리스크 | 심각도 | 대응 |
|--------|--------|------|
| API Key 미설정 | **HIGH** | config/ai.php에서 로드, 없으면 에러 메시지 표시 |
| Claude API 응답 지연 | **MEDIUM** | 타임아웃 30초, 로딩 표시, 취소 버튼 |
| Tool 결과 JSON 유효성 | **MEDIUM** | JSON 스키마 검증 후 DB 반영 |
| API 비용 | **LOW** | Rate limiting + 토큰 사용량 로깅 |

---

## 예상 작업량

| Phase | 작업 수 | 복잡도 |
|-------|--------|--------|
| A (UI) | 4 | LOW |
| B (API) | 7 | HIGH |
| C (연동) | 6 | MEDIUM |
| D (고급) | 5 | MEDIUM |
| **합계** | **22** | |

---

## 다음 단계

**Phase A부터 시작** → 사용자 확인 후 진행

**WAITING FOR CONFIRMATION**: 이 계획으로 진행할까요?
