# SmartFlat CMS v3 구현 계획

> 생성일: 2026-03-17
> 상태: Phase1 대기 중 (사용자 확인 필요)

---

## 요구사항 정리

v1의 `a_channel.php` (3,462줄) 화면 편집 기능을 v3 디자인 시스템으로 재구현한다.
DB는 `smartflat_claude_html.tb_home` 테이블의 JSON 데이터(hm_home_data, hm_main_data, hm_content_data)를 읽고 쓴다.

---

## Phase 1: a_channel 화면 재구현

### 목표
v1의 "화면 수정하기" 페이지를 v3 스타일로 재구현. 프로젝트 선택 → tb_home 데이터 로드 → 3탭(콘텐츠/홈화면/메인화면) 테이블 표시 → 항목별 편집 모달

### 구현 파일

| 파일 | 용도 |
|------|------|
| `pages/channel/index.php` | a_channel 메인 페이지 (좌: 미리보기 iframe, 우: 3탭 데이터 테이블) |
| `api/v3/home.php` | tb_home CRUD API |
| `js/components/channel-editor.js` | 탭 전환, 테이블 렌더링, 편집 모달 JS |

### 세부 작업

1. **API: `api/v3/home.php`**
   - `GET /homes?project_id=xxx` → tb_home 데이터 로드
   - `PUT /homes/{id}` → hm_home_data / hm_main_data / hm_content_data 업데이트
   - `router.php`에 `homes` 리소스 추가

2. **페이지: `pages/channel/index.php`**
   - 상단: 제목("화면 수정하기") + "데이터 삽입/수정" 버튼 + 숏URL 복사
   - 좌측: iframe 미리보기 (540x960, 프로젝트 게임 URL)
   - 우측: 3개 탭
     - 탭0: 콘텐츠 데이터 (contentdatas) — type, name, url 표시
     - 탭1: 홈 화면 (homedatas) — id, name, type, x, y, imgurl 표시
     - 탭2: 메인 화면 (maindatas) — id, name, type, x, y, event 표시
   - 각 행: 편집/삭제 버튼
   - 편집 모달: 항목 타입별 폼 (이미지 업로드, 좌표 입력, 이벤트 설정)

3. **사이드바 메뉴 연동**
   - sidebar.php에 "화면 수정" 메뉴 항목 추가 (콘텐츠 섹션 하위)

### DB 스키마 (기존 tb_home 그대로 사용)

```
tb_home.hm_home_data  → JSON 배열: [{id, name, type, imgurl, x, y, w, h, event, ...}]
tb_home.hm_main_data  → JSON 배열: [{id, name, type, imgurl, x, y, event, ...}]
tb_home.hm_content_data → JSON 배열: [{id, name, type, url, tab, sub, images[], ...}]
```

### 요소 타입 (home/main)

| type | 설명 | 편집 필드 |
|------|------|----------|
| img | 정적 이미지 | imgurl, x, y, w, h, animationtype |
| button | 클릭 버튼 | imgurl, clickurl, x, y, event{page,tab,sub} |
| video | 배경 동영상 | videourl, x, y, w, h |
| text | 동적 텍스트 | texttype, fontsize, fontcolor, textalign, x, y |
| bgcolor | 배경색 | color |
| animation | 애니메이션 | imgurls[], anitime |
| airapi | 공기질 위젯 | mode, radius, fontcolor |
| weatherapi | 날씨 위젯 | mode, radius, fontsize |

### 콘텐츠 타입 (content)

| type | 설명 | 편집 필드 |
|------|------|----------|
| html | HTML 페이지 | url, images[], schoolapitype |
| gallery / gallery1 | 사진 갤러리 | gamemode |
| video_gallery | 동영상 갤러리 | isfirstscene |
| board | 게시판 | url(listid 연동) |
| survey | 설문조사 | surveyidx, surveyonoff |
| lyrics | 가사 맞추기 | lyidx, lyonoff, lyricsidx |
| mapimg | 층별 안내도 | value, images[] |
| game | 게임 | url |
| trand | 트렌드 | surveyidx, images[] |

### 복잡도: HIGH
- v1 a_channel.php가 3,462줄 → v3에서 분리된 모듈로 재구현
- 다양한 요소 타입별 편집 폼 필요
- iframe 미리보기 연동

---

## Phase 2: 비주얼 에디터 (드래그 & 드롭)

### 목표
홈화면/메인화면의 요소를 캔버스 위에서 드래그로 이동, 리사이즈, 속성 편집 가능한 WYSIWYG 에디터

### 구현 파일

| 파일 | 용도 |
|------|------|
| `pages/channel/editor.php` | 비주얼 에디터 페이지 |
| `js/components/visual-editor.js` | 캔버스 렌더링, 드래그, 리사이즈, 속성 패널 |
| `css/editor.css` | 에디터 전용 스타일 |

### 세부 작업

1. **캔버스 영역** (1080x1920 비율, 스케일링)
   - JSON 데이터의 각 요소를 `<div>` 로 렌더링
   - 이미지: `<img>` with absolute position
   - 텍스트: `<span>` with font properties
   - 동영상: `<video>` placeholder
   - 배경색: div with background-color

2. **드래그 & 드롭**
   - mousedown/mousemove/mouseup으로 요소 이동
   - 이동 시 x, y 값 실시간 업데이트
   - 8방향 리사이즈 핸들 (w, h 변경)
   - Snap to grid (옵션)

3. **속성 패널** (우측)
   - 선택된 요소의 속성 표시/편집
   - 공통: id, name, type, x, y
   - 이미지: imgurl (파일 업로드), w, h, animationtype
   - 텍스트: fontsize, fontcolor, textalign, texttype
   - 버튼: clickurl, event{page, tab, sub}
   - 앵커(Anchor): 특정 좌표 기준점 설정

4. **저장**
   - "저장" 버튼 → JSON 재구성 → API PUT 호출
   - 자동 저장 (옵션, debounce 2초)
   - 변경 이력 표시

5. **타입별 전환**
   - 탭: 홈화면(hm_home_data) / 메인화면(hm_main_data) / 콘텐츠(hm_content_data)
   - 콘텐츠는 테이블 편집 (비주얼 에디터 대상 아님)

### 복잡도: HIGH
- 커스텀 드래그 & 드롭 엔진 구현 필요
- 다양한 요소 타입별 렌더링
- 스케일링 좌표 변환 (캔버스 ↔ 실제 1080x1920)

---

## Phase 3: 네비게이션 기능 구현

### 목표
사이드바 메뉴와 상단 헤더의 모든 기능을 실제로 동작하게 구현

### 3-A: 좌측 사이드바 메뉴

| 메뉴 | v3 페이지 | v1 대응 | 구현 내용 |
|------|----------|---------|----------|
| 대시보드 | pages/dashboard/ | - | ✅ 구현 완료 |
| 프로젝트 목록 | pages/project/ | - | ✅ 구현 완료 |
| 화면 수정 | pages/channel/ | a_channel | Phase 1에서 구현 |
| 비주얼 에디터 | pages/channel/editor | - | Phase 2에서 구현 |
| 콘텐츠 관리 | pages/content/ | - | ✅ 구현 완료 |
| 미디어 관리 | pages/content/media | - | 파일 업로드/갤러리 |
| 기기 관리 | pages/device/ | - | 기기 목록/상태 |
| 기기 그룹 | pages/device/groups | - | 그룹 관리 |
| 배포 관리 | pages/deployment/ | push | 배포 실행/이력 |
| 배포 예약 | pages/deployment/schedule | 예약전송 | 예약 설정 |
| 모니터링 | pages/monitoring/ | - | 실시간 상태 |
| 알림 | pages/monitoring/alerts | - | 알림 목록 |
| 감사 로그 | pages/audit/ | 수정기록 | 활동 이력 |
| 설정 | pages/settings/ | 기본설정 | 시스템 설정 |
| 권한 관리 | pages/settings/permissions | 권한설정 | 역할/권한 |
| 푸시 메시지 | pages/push/ | push | 푸시 발송 |

### 3-B: 상단 헤더 기능

| 기능 | 구현 내용 |
|------|----------|
| 프로젝트 선택기 | 드롭다운으로 프로젝트 전환 (v1의 combo_projectids) |
| 프로젝트 추가 | "+" 버튼 → 새 프로젝트 생성 모달 |
| 검색 | Ctrl+K 퀵서치 (페이지/프로젝트/기기) |
| 알림 | 알림 벨 + 드롭다운 목록 |
| 사용자 메뉴 | 프로필/설정/로그아웃 |

### 복잡도: MEDIUM (각 페이지는 독립적, 점진적 구현 가능)

---

## 우선순위 & 의존성

```
Phase 1 (a_channel 재구현)
  ├── API: home.php
  ├── 페이지: channel/index.php
  └── 사이드바 메뉴 연동
       │
Phase 2 (비주얼 에디터) ← Phase 1 완료 필요
  ├── 에디터 캔버스
  ├── 드래그 & 드롭
  ├── 속성 패널
  └── 저장 연동
       │
Phase 3 (네비게이션 기능) ← 독립적, Phase 1과 병행 가능
  ├── 3-A: 사이드바 페이지들
  └── 3-B: 헤더 기능들
```

---

## 리스크

| 리스크 | 심각도 | 대응 |
|--------|--------|------|
| v1 a_channel.php 3,462줄 복잡도 | HIGH | 모듈 분리, 타입별 컴포넌트화 |
| 드래그 에디터 브라우저 호환성 | MEDIUM | 모던 브라우저만 지원 (Chrome/Edge) |
| tb_home JSON 스키마 변경 위험 | MEDIUM | v1과 동일 스키마 유지, 필드 추가만 허용 |
| iframe 미리보기 CORS | LOW | 같은 도메인이므로 문제 없음 |

---

## 작업 순서 (Phase 1부터)

1. `api/v3/home.php` API 생성 + router 등록
2. `pages/channel/index.php` 페이지 구현
3. `js/components/channel-editor.js` 탭/테이블/모달 JS
4. sidebar.php에 "화면 수정" 메뉴 추가
5. 테스트: 프로젝트 선택 → 데이터 로드 → 편집 → 저장

**WAITING FOR CONFIRMATION**: 이 계획으로 Phase 1부터 진행할까요?
