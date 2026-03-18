# SmartFlat CMS v3 구현 계획

> 생성일: 2026-03-18
> 상태: **Phase 1~3 구현 완료** (2026-03-18)

---

## 요구사항 정리

v1의 `a_channel.php` (3,462줄)을 기반으로 v3 화면을 3단계로 구현한다.
- Phase 1: a_channel 화면 재구현 (테이블 기반 편집)
- Phase 2: 비주얼 드래그 에디터 (WYSIWYG)
- Phase 3: 좌측 nav + 상단 top 기능 구현

DB: `smartflat_claude_html.tb_home` 테이블
- `hm_content_data` → 콘텐츠 화면 JSON
- `hm_home_data` → 랜딩페이지 메인화면 JSON
- `hm_main_data` → 두번째 페이지 화면 JSON

---

## 현재 상태 (2026-03-18 기준)

### 이미 구현된 파일들

| 파일 | 상태 | 비고 |
|------|------|------|
| `api/v3/home.php` | **완료** | GET/PUT CRUD, field-specific update |
| `api/v3/router.php` | **완료** | homes 리소스 등록됨 |
| `pages/channel/index.php` | **완료** | 3탭 레이아웃, 미리보기 iframe |
| `js/components/channel-editor.js` | **완료** | 프로젝트 로드, 탭 전환, 테이블, 편집 모달, Raw JSON 에디터 |
| `sidebar.php` | **완료** | "화면 수정" 메뉴 연동 |
| `header.php` | **완료** | 검색 버튼, 알림, 사용자 메뉴 UI |
| `pages/dashboard/index.php` | **존재** | 대시보드 페이지 |
| `pages/project/index.php` | **존재** | 프로젝트 목록 |
| `pages/content/index.php` | **존재** | 콘텐츠 관리 |
| `pages/device/index.php` | **존재** | 기기 관리 |
| `pages/deployment/index.php` | **존재** | 배포 관리 |
| `pages/monitoring/index.php` | **존재** | 모니터링 |
| `pages/audit/index.php` | **존재** | 감사 로그 |
| `pages/settings/index.php` | **존재** | 설정 |
| `pages/version/index.php` | **존재** | 버전 관리 |

---

## Phase 1: a_channel 화면 재구현 (**90% 완료**)

### 남은 작업

| # | 작업 | 파일 | 설명 |
|---|------|------|------|
| 1-1 | v1 누락 기능 확인 및 보완 | `channel-editor.js` | v1 대비 누락된 기능 점검 |
| 1-2 | 숏URL 복사 기능 | `channel-editor.js` | v1의 `showCopyIframeAddress()`, `copyShortURL()` 대응 |
| 1-3 | 재난안전문자 토글 | `channel-editor.js`, `index.php` | v1의 `div_safetydata` 토글 ON/OFF + 설정 팝업 |
| 1-4 | 항목 추가 기능 | `channel-editor.js` | 새 콘텐츠/홈/메인 요소 추가 (v1의 showContentsData INSERT) |
| 1-5 | 항목 순서 변경 | `channel-editor.js` | 드래그로 테이블 행 순서 변경 (v1에서 지원) |
| 1-6 | 이미지 업로드 | `channel-editor.js`, `api/v3/upload.php` | 이미지 파일 직접 업로드 (현재는 URL 입력만) |
| 1-7 | 테스트 & 검증 | - | 프로젝트 선택 → 데이터 로드 → 편집 → 저장 → 미리보기 반영 |

### 복잡도: LOW (보완 작업)

---

## Phase 2: 비주얼 에디터 (드래그 & 드롭) (**미구현**)

### 목표
홈화면/메인화면의 요소를 캔버스 위에서 드래그로 이동, 리사이즈, 속성 편집 가능한 WYSIWYG 에디터.
수정하면 해당 정보가 DB(tb_home)로 자동 저장.

### 구현 파일

| 파일 | 용도 | 신규/수정 |
|------|------|----------|
| `pages/channel/editor.php` | 비주얼 에디터 페이지 | **신규** |
| `js/components/visual-editor.js` | 에디터 핵심 로직 | **신규** |
| `css/editor.css` | 에디터 전용 스타일 | **신규** |
| `sidebar.php` | "비주얼 에디터" 메뉴 추가 | **수정** |

### 세부 작업

| # | 작업 | 설명 |
|---|------|------|
| 2-1 | 에디터 페이지 레이아웃 | 좌: 캔버스 영역, 우: 속성 패널, 상단: 툴바 |
| 2-2 | 캔버스 렌더링 엔진 | JSON → HTML 요소 변환, 1080x1920 비율 스케일링 |
| 2-3 | 요소 렌더링 | 타입별 렌더링: img→`<img>`, text→`<span>`, video→`<video>`, bgcolor→`<div>` |
| 2-4 | 드래그 이동 | mousedown/mousemove/mouseup, x/y 실시간 업데이트 |
| 2-5 | 리사이즈 핸들 | 8방향 핸들 (N,S,E,W,NE,NW,SE,SW), w/h 변경 |
| 2-6 | 요소 선택/해제 | 클릭 선택, 선택 테두리 표시, ESC로 해제 |
| 2-7 | 속성 패널 | 선택 요소의 속성 편집: 공통(id,name,type,x,y) + 타입별 |
| 2-8 | 텍스트 속성 | fontsize, fontcolor, textalign, texttype 편집 |
| 2-9 | 이미지 속성 | imgurl, clickurl, w, h, animationtype 편집 |
| 2-10 | 버튼 속성 | event{page, tab, sub} 편집 |
| 2-11 | Anchor 기능 | 요소 기준점(anchor) 설정: top-left, center 등 |
| 2-12 | 색상 선택기 | fontcolor, bgcolor용 컬러 피커 |
| 2-13 | 폰트 선택기 | 사용 가능한 폰트 목록에서 선택 |
| 2-14 | DB 저장 | 수정 즉시 PUT /homes/{id}/home-data 또는 main-data 호출 |
| 2-15 | 자동 저장 | debounce 2초, 변경 감지 시 자동 저장 |
| 2-16 | 탭 전환 | 홈화면(hm_home_data) ↔ 메인화면(hm_main_data) 전환 |
| 2-17 | Undo/Redo | Ctrl+Z/Y 지원 (상태 히스토리 스택) |
| 2-18 | 그리드/스냅 | 선택적 그리드 표시, 스냅 정렬 |

### JSON 데이터 구조 분석 (tb_home)

**hm_home_data / hm_main_data 요소 속성:**
```json
{
  "id": "home_logo",
  "name": "로고",
  "type": "img|button|button_empty|video|text|bgcolor|animation|airapi|weatherapi",
  "imgurl": "res/n_home/logo.png",
  "clickurl": "res/n_home/logo_click.png",
  "x": 540, "y": 230,
  "w": 200, "h": 100,
  "videourl": "res/video.mp4",
  "texttype": "text_notice|m/d|hh:mm|weekday|yyyy|hh:mm:ss|yyyymmdd",
  "fontsize": "16px",
  "fontcolor": "#ffffff",
  "textalign": "left|center|right",
  "color": "#000000",
  "animationtype": "fade",
  "event": {"page": "0", "tab": "0", "sub": "0"}
}
```

**hm_content_data 요소 (에디터 대상 아님 → 테이블 편집 유지):**
```json
{
  "id": "content_1",
  "name": "콘텐츠",
  "type": "html|gallery|gallery1|gallery2|video_gallery|board|survey|lyrics|mapimg|game|trand|webpage|faq|floor|pdf_gallery",
  "url": "...",
  "tab": "0", "sub": "0",
  "images": [],
  "surveyidx": 123,
  "surveyonoff": 1
}
```

### 복잡도: **HIGH**
- 커스텀 드래그 엔진 구현
- 스케일링 좌표 변환 (캔버스 크기 ↔ 실제 1080x1920)
- 다양한 요소 타입별 렌더링/편집
- Undo/Redo 상태 관리

---

## Phase 3: 네비게이션 기능 구현 (**미구현**)

### 3-A: 좌측 사이드바 메뉴 페이지 기능

| # | 메뉴 | 페이지 | 주요 기능 | API |
|---|------|--------|----------|-----|
| 3-1 | 대시보드 | `pages/dashboard/` | 프로젝트 수, 기기 수, 최근 활동, 배포 현황 차트 | `api/v3/dashboard.php` |
| 3-2 | 프로젝트 관리 | `pages/project/` | 프로젝트 목록 CRUD, 상세 정보, 설정 | `api/v3/project.php` (존재) |
| 3-3 | 콘텐츠 관리 | `pages/content/` | 콘텐츠 목록, 템플릿, 미디어 업로드 | `api/v3/content.php` (존재) |
| 3-4 | 미디어 관리 | `pages/content/media.php` | 이미지/비디오 파일 업로드, 갤러리 뷰 | `api/v3/asset.php` (존재) |
| 3-5 | 기기 관리 | `pages/device/` | 기기 목록, 상태 모니터링, 원격 제어 | `api/v3/device.php` (존재) |
| 3-6 | 기기 그룹 | `pages/device/groups.php` | 기기 그룹 관리, 그룹별 배포 | `api/v3/device_group.php` (존재) |
| 3-7 | 배포하기 | `pages/deployment/` | 콘텐츠 배포 실행, 대상 선택 | `api/v3/deployment.php` (존재) |
| 3-8 | 예약 배포 | `pages/deployment/schedule.php` | 날짜/시간 지정 배포 예약 | `api/v3/deployment.php` |
| 3-9 | 배포 이력 | `pages/deployment/history.php` | 배포 기록 조회, 결과 확인 | `api/v3/deployment.php` |
| 3-10 | 모니터링 | `pages/monitoring/` | 기기 실시간 상태, 연결 상태 | `api/v3/common_code.php` |
| 3-11 | 알림 설정 | `pages/monitoring/alerts.php` | 알림 조건 설정, 알림 이력 | 신규 API 필요 |
| 3-12 | 버전 관리 | `pages/version/` | 앱/콘텐츠 버전 관리 | 신규 API 필요 |
| 3-13 | 감사 로그 | `pages/audit/` | 활동 로그 조회, 필터링 | `api/v3/audit.php` (존재) |
| 3-14 | 설정 | `pages/settings/` | 시스템 설정, 테마, 언어 | 신규 API 필요 |

### 3-B: 상단 헤더 기능

| # | 기능 | 설명 | 구현 내용 |
|---|------|------|----------|
| 3-15 | 퀵 검색 (Ctrl+K) | `openQuickSearch()` | 모달 검색창, 프로젝트/페이지/기기 통합 검색 |
| 3-16 | 프로젝트 추가 | 헤더에 "+" 버튼 | 새 프로젝트 생성 모달 (projectid, name, orientation 입력) |
| 3-17 | 알림 시스템 | 알림 벨 드롭다운 | 실시간 알림 목록, 읽음/안읽음, 배포 완료 알림 |
| 3-18 | 사용자 프로필 | 사용자 메뉴 | 프로필 편집, 비밀번호 변경 |

### 복잡도: **MEDIUM** (각 페이지 독립적, 점진적 구현 가능)

---

## 우선순위 & 의존성

```
Phase 1 (a_channel 보완) ← 90% 완료, 남은 작업 소량
  ├── 1-1~1-3: 누락 기능 보완
  ├── 1-4~1-6: 추가 기능
  └── 1-7: 테스트
       │
Phase 2 (비주얼 에디터) ← Phase 1 완료 필요
  ├── 2-1~2-3: 캔버스 기반 구축
  ├── 2-4~2-6: 드래그/리사이즈/선택
  ├── 2-7~2-13: 속성 패널 (타입별)
  └── 2-14~2-18: 저장/자동저장/Undo
       │
Phase 3 (네비게이션) ← 독립적, Phase 1과 병행 가능
  ├── 3-A (3-1~3-14): 사이드바 페이지 기능
  └── 3-B (3-15~3-18): 헤더 기능
```

---

## 리스크

| 리스크 | 심각도 | 대응 |
|--------|--------|------|
| 비주얼 에디터 드래그 엔진 복잡도 | **HIGH** | 단순 구현 먼저, 기능 점진 추가 |
| 스케일링 좌표 변환 정확도 | **HIGH** | 캔버스 크기와 실제 해상도 비율 정확히 계산 |
| tb_home JSON 스키마 호환성 | **MEDIUM** | v1과 동일 스키마 유지, 필드 추가만 허용 |
| 각 페이지별 API 데이터 구조 | **MEDIUM** | API 존재하는 것 먼저 구현, 없는 것은 신규 생성 |
| 브라우저 호환성 (드래그) | **LOW** | 모던 브라우저(Chrome/Edge) 타겟 |

---

## 다음 단계

**Phase 1부터 시작** → Phase 2 → Phase 3 순서

**WAITING FOR CONFIRMATION**: 이 계획으로 진행할까요? 수정이 필요하면 말씀해주세요.
