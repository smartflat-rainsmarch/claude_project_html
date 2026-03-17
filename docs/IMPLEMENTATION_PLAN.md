# SmartFlat CMS 3.0 구현 계획서

## 1. 문서 정보

| 항목 | 내용 |
|:-----|:-----|
| 문서명 | SmartFlat CMS 3.0 구현 계획서 |
| 버전 | 1.0 |
| 작성일 | 2026-03-17 |
| 기반 문서 | 설계서 초안.md, DESIGN_SPECIFICATION.md |

---

## 2. 프로젝트 개요

### 2.1 목표

SmartFlat CMS 2.x를 3.0으로 업그레이드하여:
- 운영 중심 UI로 전환
- 프로젝트/콘텐츠/기기/배포 체계 분리
- 버전관리 및 모니터링 강화
- 확장 가능한 아키텍처 구축

### 2.2 개발 원칙

| 원칙 | 설명 |
|:-----|:-----|
| 점진적 전환 | 기존 v1/v2와 병행 운영 |
| 하위 호환성 | 기존 API 유지 |
| 모듈화 | 독립적 기능 단위 개발 |
| 재사용성 | 공통 컴포넌트 우선 개발 |

---

## 3. 단계별 구현 계획

### 3.1 전체 일정 (예상)

```
┌─────────────────────────────────────────────────────────────────────────┐
│ Phase 0: 준비      │ Phase 1: 기반      │ Phase 2: 핵심      │ Phase 3  │
│ (1주)              │ (3주)              │ (4주)              │ (3주)    │
├────────────────────┼────────────────────┼────────────────────┼──────────┤
│ 환경 구축          │ DB 설계            │ 배포 관리          │ 모니터링 │
│ 디렉토리 구조      │ 공통 컴포넌트      │ 콘텐츠 버전관리    │ 알림     │
│ 기본 레이아웃      │ 프로젝트 관리      │ 기기 그룹관리      │ 권한     │
│                    │ 콘텐츠 관리        │ 전원 스케줄        │ 테마     │
│                    │ 기기 관리          │ 감사 로그          │          │
│                    │ 대시보드           │                    │          │
└────────────────────┴────────────────────┴────────────────────┴──────────┘
```

---

## Phase 0: 준비 단계 (1주)

### 목표
개발 환경 및 기본 구조 설정

### 작업 목록

#### 0.1 디렉토리 구조 생성

```bash
# 실행할 작업
mkdir -p web/v3/dist/{components,pages,api/v3,css/themes,js/{components,pages},libs}
mkdir -p web/v3/dist/pages/{dashboard,project,content,device,deploy,monitoring,schedule,log,settings}
```

**생성할 파일:**
- [ ] `web/v3/dist/index.php` - 진입점
- [ ] `web/v3/dist/main.php` - 메인 레이아웃
- [ ] `web/v3/dist/header.php` - 헤더
- [ ] `web/v3/dist/sidebar.php` - 사이드바
- [ ] `web/v3/dist/cmn_var.php` - 공통 변수
- [ ] `web/v3/dist/cmn_func.php` - 공통 함수

#### 0.2 기본 레이아웃 구현

**main.php 구조:**
```php
<?php
session_cache_expire(14400);
session_start();
include('./cmn_var.php');
include('./cmn_func.php');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartFlat CMS 3.0</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="../../../libs/fontawesome-6/css/all.min.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
    <div id="div_top"></div>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav"></div>
        <div id="layoutSidenav_content">
            <main id="div_main"></main>
        </div>
    </div>
    <script src="libs/jquery/jquery-3.5.1.min.js"></script>
    <script src="js/app.js"></script>
</body>
</html>
```

#### 0.3 CSS 기본 설정

**css/main.css 핵심 스타일:**
```css
/* 공통 변수 */
:root {
    --primary-color: #009ef7;
    --success-color: #50cd89;
    --warning-color: #ffc700;
    --danger-color: #f1416c;
    --sidebar-width: 250px;
    --sidebar-collapsed-width: 60px;
    --header-height: 60px;
}

/* 레이아웃 */
#layoutSidenav_nav {
    width: var(--sidebar-width);
    transition: width 0.3s;
}

#layoutSidenav_content {
    margin-left: var(--sidebar-width);
    transition: margin-left 0.3s;
}

/* 반응형 */
@media (max-width: 768px) {
    #layoutSidenav_nav {
        width: var(--sidebar-collapsed-width);
    }
    #layoutSidenav_content {
        margin-left: var(--sidebar-collapsed-width);
    }
    .nav-text { display: none; }
}
```

#### 0.4 완료 기준

- [ ] v3 디렉토리 구조 생성 완료
- [ ] 기본 레이아웃 페이지 렌더링 확인
- [ ] 사이드바 메뉴 표시 확인
- [ ] 반응형 동작 확인

---

## Phase 1: 기반 구축 (3주)

### 1주차: 데이터베이스 및 API 기반

#### 1.1 데이터베이스 테이블 생성

**실행 순서:**
1. `sf_common_codes` - 공통 코드
2. `sf_users` - 사용자 (기존 확장)
3. `sf_project_groups` - 프로젝트 그룹
4. `sf_projects` - 프로젝트
5. `sf_assets` - 파일 자산
6. `sf_contents` - 콘텐츠
7. `sf_devices` - 기기
8. `sf_audit_logs` - 감사 로그

**작업:**
- [ ] SQL 스크립트 작성 (`docs/sql/v3_tables.sql`)
- [ ] 초기 데이터 삽입 스크립트 (`docs/sql/v3_init_data.sql`)
- [ ] 개발 환경 DB 생성

#### 1.2 API Router 구현

**api/v3/router.php:**
```php
<?php
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/api/v3/', '', $uri);
$segments = explode('/', trim($uri, '/'));

$resource = $segments[0] ?? '';
$id = $segments[1] ?? null;
$action = $segments[2] ?? null;

// 인증 체크
require_once('../../lib/auth.php');

// 라우팅
switch ($resource) {
    case 'projects':
        require_once('project.php');
        break;
    case 'contents':
        require_once('content.php');
        break;
    case 'devices':
        require_once('device.php');
        break;
    default:
        http_response_code(404);
        echo json_encode(['code' => 404, 'message' => 'Not Found']);
}
?>
```

#### 1.3 공통 컴포넌트 개발

**개발 순서:**
1. `components/summary-card.php` - 요약 카드
2. `components/status-badge.php` - 상태 뱃지
3. `components/breadcrumb.php` - 브레드크럼
4. `components/data-table.php` - 데이터 테이블
5. `components/filter-panel.php` - 필터 패널
6. `components/modal-dialog.php` - 모달
7. `components/toast.php` - 토스트

**작업:**
- [ ] PHP 컴포넌트 함수 구현
- [ ] JavaScript 클래스 구현 (`js/components/`)
- [ ] 컴포넌트 스타일 작성 (`css/components.css`)

---

### 2주차: 프로젝트 관리

#### 2.1 프로젝트 목록 페이지

**pages/project/list.php:**
- [ ] 프로젝트 목록 테이블
- [ ] 검색 기능 (프로젝트명)
- [ ] 필터 기능 (지역, 상태, 카테고리)
- [ ] 페이지네이션
- [ ] 프로젝트 생성 버튼

**API:**
- [ ] `GET /api/v3/projects` - 목록 조회
- [ ] 쿼리 파라미터: `page`, `limit`, `search`, `status`, `region`

#### 2.2 프로젝트 상세 페이지

**pages/project/detail.php:**
- [ ] 기본 정보 섹션
- [ ] 연결 기기 요약
- [ ] 콘텐츠 현황 요약
- [ ] 최근 배포 이력
- [ ] 전원 스케줄 요약

**API:**
- [ ] `GET /api/v3/projects/{id}` - 상세 조회
- [ ] `GET /api/v3/projects/{id}/summary` - 요약 정보

#### 2.3 프로젝트 생성/수정 페이지

**pages/project/form.php:**
- [ ] 입력 폼 구현
- [ ] 유효성 검증 (클라이언트/서버)
- [ ] 썸네일 업로드
- [ ] 중복 키 체크

**API:**
- [ ] `POST /api/v3/projects` - 생성
- [ ] `PUT /api/v3/projects/{id}` - 수정
- [ ] `DELETE /api/v3/projects/{id}` - 삭제

---

### 3주차: 콘텐츠/기기 관리 및 대시보드

#### 3.1 콘텐츠 관리

**pages/content/list.php:**
- [ ] 콘텐츠 목록 (프로젝트 필터)
- [ ] 타입별 필터
- [ ] 상태별 필터

**pages/content/detail.php:**
- [ ] 콘텐츠 상세 정보
- [ ] 설정 JSON 표시
- [ ] 미리보기 링크

**pages/content/form.php:**
- [ ] 타입별 편집 폼
- [ ] 자산 연결
- [ ] 임시 저장/게시

**API:**
- [ ] `GET /api/v3/contents`
- [ ] `GET /api/v3/contents/{id}`
- [ ] `POST /api/v3/contents`
- [ ] `PUT /api/v3/contents/{id}`
- [ ] `POST /api/v3/contents/{id}/publish`

#### 3.2 기기 관리

**pages/device/list.php:**
- [ ] 기기 목록
- [ ] 온라인/오프라인 필터
- [ ] 프로젝트별 필터

**pages/device/detail.php:**
- [ ] 기기 상세 정보
- [ ] 최근 heartbeat
- [ ] 원격 명령 버튼

**API:**
- [ ] `GET /api/v3/devices`
- [ ] `GET /api/v3/devices/{id}`
- [ ] `POST /api/v3/devices/{id}/command`

#### 3.3 대시보드

**pages/dashboard/index.php:**
- [ ] KPI 카드 (프로젝트 수, 기기 수, 온라인/오프라인)
- [ ] 최근 배포 목록
- [ ] 최근 오류 목록
- [ ] 기기 상태 차트

**API:**
- [ ] `GET /api/v3/dashboard/summary`
- [ ] `GET /api/v3/dashboard/recent-deployments`
- [ ] `GET /api/v3/dashboard/recent-errors`

---

## Phase 2: 핵심 기능 (4주)

### 4주차: 배포 관리

#### 4.1 배포 목록

**pages/deploy/list.php:**
- [ ] 배포 이력 목록
- [ ] 프로젝트/상태/기간 필터
- [ ] 성공/실패 건수 표시

#### 4.2 배포 생성

**pages/deploy/create.php:**
- [ ] 프로젝트 선택
- [ ] 대상 선택 (전체/그룹/개별)
- [ ] 콘텐츠 버전 선택
- [ ] 사전 검증
- [ ] 즉시/예약 배포

#### 4.3 배포 상세

**pages/deploy/detail.php:**
- [ ] 배포 정보
- [ ] 기기별 결과
- [ ] 실패 사유
- [ ] 재시도/롤백 버튼

**API:**
- [ ] `GET /api/v3/deployments`
- [ ] `POST /api/v3/deployments`
- [ ] `GET /api/v3/deployments/{id}`
- [ ] `POST /api/v3/deployments/{id}/retry`
- [ ] `POST /api/v3/deployments/{id}/rollback`

---

### 5주차: 콘텐츠 버전관리 및 기기 그룹

#### 5.1 콘텐츠 버전관리

**pages/content/versions.php:**
- [ ] 버전 목록
- [ ] 버전 비교
- [ ] 버전 복원

**API:**
- [ ] `GET /api/v3/contents/{id}/versions`
- [ ] `POST /api/v3/contents/{id}/rollback`

#### 5.2 기기 그룹 관리

**pages/device/groups.php:**
- [ ] 그룹 목록
- [ ] 그룹 생성/수정
- [ ] 기기 할당

**API:**
- [ ] `GET /api/v3/device-groups`
- [ ] `POST /api/v3/device-groups`
- [ ] `PUT /api/v3/device-groups/{id}/devices`

---

### 6주차: 전원 스케줄 및 원격 제어

#### 6.1 전원 스케줄 관리

**pages/schedule/power.php:**
- [ ] 프로젝트별 전원 설정
- [ ] 매일/요일별 On/Off
- [ ] 재시작 시간 설정
- [ ] 설정 전송

**API:**
- [ ] `GET /api/v3/projects/{id}/power-schedule`
- [ ] `PUT /api/v3/projects/{id}/power-schedule`
- [ ] `POST /api/v3/projects/{id}/power-schedule/push`

#### 6.2 원격 명령 관리

**pages/device/command.php:**
- [ ] 명령 유형 선택
- [ ] 대상 기기 선택
- [ ] 명령 전송
- [ ] 결과 확인

---

### 7주차: 감사 로그

#### 7.1 작업 이력

**pages/log/audit.php:**
- [ ] 작업 이력 목록
- [ ] 사용자/대상/기간 필터
- [ ] 변경 내용 상세

#### 7.2 로그인 이력

**pages/log/login.php:**
- [ ] 로그인 성공/실패 기록
- [ ] IP/시간 표시

#### 7.3 배포 이력

**pages/log/deploy.php:**
- [ ] 배포 관점 이력
- [ ] 롤백 이력 연결

**API:**
- [ ] `GET /api/v3/audit-logs`
- [ ] `GET /api/v3/login-logs`

---

## Phase 3: 고도화 (3주)

### 8주차: 모니터링

#### 8.1 실시간 상태

**pages/monitoring/realtime.php:**
- [ ] 온라인/오프라인 현황
- [ ] 프로젝트별 상태
- [ ] 자동 갱신 (30초)

#### 8.2 오류 현황

**pages/monitoring/errors.php:**
- [ ] 오류 목록
- [ ] 오류 유형별 분류
- [ ] 반복 오류 표시

#### 8.3 알림 센터

**pages/monitoring/alerts.php:**
- [ ] 알림 목록
- [ ] 심각도 표시
- [ ] 해결 처리

---

### 9주차: 권한 관리

#### 9.1 사용자 관리

**pages/settings/users.php:**
- [ ] 사용자 목록
- [ ] 사용자 생성/수정
- [ ] 역할 지정

#### 9.2 역할/권한 관리

**pages/settings/roles.php:**
- [ ] 역할 목록
- [ ] 권한 매핑

---

### 10주차: 테마 및 마무리

#### 10.1 테마 설정

**pages/settings/theme.php:**
- [ ] Light/Dark 테마
- [ ] 브랜드 컬러 설정

#### 10.2 시스템 설정

**pages/settings/system.php:**
- [ ] 업로드 제한
- [ ] 세션 정책
- [ ] 캐시 설정

#### 10.3 최종 테스트 및 문서화

- [ ] 전체 기능 테스트
- [ ] 성능 테스트
- [ ] 사용자 매뉴얼 작성

---

## 4. 작업 체크리스트

### Phase 0 체크리스트
- [ ] 디렉토리 구조 생성
- [ ] 기본 레이아웃 (main.php)
- [ ] 헤더 컴포넌트 (header.php)
- [ ] 사이드바 컴포넌트 (sidebar.php)
- [ ] 기본 CSS (main.css)
- [ ] 기본 JS (app.js)

### Phase 1 체크리스트
- [ ] DB 테이블 생성 스크립트
- [ ] API Router
- [ ] 공통 컴포넌트 7종
- [ ] 프로젝트 목록/상세/폼
- [ ] 콘텐츠 목록/상세/폼
- [ ] 기기 목록/상세
- [ ] 대시보드

### Phase 2 체크리스트
- [ ] 배포 목록/생성/상세
- [ ] 콘텐츠 버전관리
- [ ] 기기 그룹관리
- [ ] 전원 스케줄
- [ ] 원격 명령
- [ ] 감사 로그

### Phase 3 체크리스트
- [ ] 실시간 모니터링
- [ ] 오류 현황
- [ ] 알림 센터
- [ ] 사용자/권한 관리
- [ ] 테마 설정
- [ ] 시스템 설정
- [ ] 최종 테스트

---

## 5. 기술 스택 요약

| 분류 | 기술 | 버전 |
|:-----|:-----|:-----|
| Backend | PHP | 7.4+ |
| Database | MySQL | 5.7+ |
| Frontend | HTML5, CSS3, JavaScript (ES6) | - |
| UI Framework | Bootstrap | 4.6 |
| JS Library | jQuery | 3.5.1 |
| Charts | Chart.js | 3.x |
| Icons | FontAwesome | 6.x |
| DataTables | DataTables | 1.11+ |

---

## 6. 위험 요소 및 대응

| 위험 | 영향 | 대응 방안 |
|:-----|:-----|:---------|
| 기존 시스템 호환성 | 높음 | API 버전 분리, 점진적 전환 |
| 대용량 데이터 | 중간 | 페이지네이션, 인덱스 최적화 |
| 브라우저 호환성 | 낮음 | Chrome/Edge 우선 지원 |
| 개발 일정 지연 | 중간 | 핵심 기능 우선 개발 |

---

## 7. 다음 단계

1. **Phase 0 시작**: 디렉토리 구조 및 기본 레이아웃 생성
2. **DB 스키마 확정**: SQL 스크립트 작성 및 리뷰
3. **API 설계 확정**: 엔드포인트 및 응답 형식 확정
4. **컴포넌트 개발**: 공통 UI 컴포넌트 우선 개발

---

## 부록 A: 파일 목록

### 신규 생성 파일 (예정)

```
web/v3/dist/
├── index.php
├── main.php
├── header.php
├── sidebar.php
├── cmn_var.php
├── cmn_func.php
├── components/
│   ├── summary-card.php
│   ├── status-badge.php
│   ├── breadcrumb.php
│   ├── data-table.php
│   ├── filter-panel.php
│   ├── modal-dialog.php
│   └── toast.php
├── pages/
│   ├── dashboard/index.php
│   ├── project/list.php
│   ├── project/detail.php
│   ├── project/form.php
│   ├── content/list.php
│   ├── content/detail.php
│   ├── content/form.php
│   ├── content/versions.php
│   ├── device/list.php
│   ├── device/detail.php
│   ├── device/groups.php
│   ├── device/command.php
│   ├── deploy/list.php
│   ├── deploy/create.php
│   ├── deploy/detail.php
│   ├── monitoring/realtime.php
│   ├── monitoring/errors.php
│   ├── monitoring/alerts.php
│   ├── schedule/power.php
│   ├── log/audit.php
│   ├── log/login.php
│   ├── log/deploy.php
│   ├── settings/users.php
│   ├── settings/roles.php
│   ├── settings/theme.php
│   └── settings/system.php
├── api/v3/
│   ├── router.php
│   ├── project.php
│   ├── content.php
│   ├── device.php
│   ├── deploy.php
│   ├── dashboard.php
│   ├── audit.php
│   └── settings.php
├── css/
│   ├── main.css
│   ├── components.css
│   └── themes/
│       ├── light.css
│       └── dark.css
├── js/
│   ├── app.js
│   ├── api.js
│   ├── components/
│   │   ├── data-table.js
│   │   ├── filter-panel.js
│   │   └── modal.js
│   └── pages/
│       ├── dashboard.js
│       ├── project.js
│       ├── content.js
│       ├── device.js
│       └── deploy.js
└── libs/
    └── (기존 라이브러리 복사)
```

### SQL 스크립트

```
docs/sql/
├── v3_tables.sql        # 테이블 생성
├── v3_init_data.sql     # 초기 데이터
├── v3_indexes.sql       # 인덱스
└── v3_migration.sql     # 마이그레이션
```
