# SmartFlat CMS 3.0 상세 설계서

## 1. 문서 정보

| 항목 | 내용 |
|:-----|:-----|
| 문서명 | SmartFlat CMS 3.0 상세 설계서 |
| 버전 | 1.0 |
| 작성일 | 2026-03-17 |
| 기반 문서 | 설계서 초안.md |

---

## 2. 시스템 아키텍처

### 2.1 전체 아키텍처

```
┌─────────────────────────────────────────────────────────────────┐
│                        클라이언트 레이어                          │
├─────────────────┬─────────────────┬─────────────────────────────┤
│  관리자 CMS     │  키오스크 앱     │  모바일 관리 앱              │
│  (웹 브라우저)   │  (Android/Web)  │  (선택적)                   │
└────────┬────────┴────────┬────────┴──────────────┬──────────────┘
         │                 │                       │
         ▼                 ▼                       ▼
┌─────────────────────────────────────────────────────────────────┐
│                        API Gateway                              │
│                   (Apache + PHP Router)                         │
└────────────────────────────┬────────────────────────────────────┘
                             │
         ┌───────────────────┼───────────────────┐
         ▼                   ▼                   ▼
┌─────────────────┐ ┌─────────────────┐ ┌─────────────────┐
│  인증 서비스     │ │  콘텐츠 서비스   │ │  기기 서비스     │
│  (Auth)         │ │  (Content)      │ │  (Device)       │
└────────┬────────┘ └────────┬────────┘ └────────┬────────┘
         │                   │                   │
         └───────────────────┼───────────────────┘
                             ▼
┌─────────────────────────────────────────────────────────────────┐
│                        데이터 레이어                             │
├─────────────────┬─────────────────┬─────────────────────────────┤
│  MySQL          │  File Storage   │  Redis (선택적)             │
│  (메인 DB)       │  (ssapi/file)   │  (세션/캐시)                │
└─────────────────┴─────────────────┴─────────────────────────────┘
```

### 2.2 디렉토리 구조 (3.0 목표)

```
html/
├── web/
│   └── v3/dist/                    # CMS 3.0 (신규)
│       ├── index.php               # 진입점
│       ├── main.php                # 메인 레이아웃
│       ├── header.php              # 헤더 컴포넌트
│       ├── sidebar.php             # 사이드바 (nav.php 대체)
│       ├── components/             # 재사용 UI 컴포넌트
│       │   ├── breadcrumb.php
│       │   ├── data-table.php
│       │   ├── filter-panel.php
│       │   ├── modal-dialog.php
│       │   ├── status-badge.php
│       │   ├── summary-card.php
│       │   └── toast.php
│       ├── pages/                  # 페이지별 PHP
│       │   ├── dashboard/
│       │   ├── project/
│       │   ├── content/
│       │   ├── device/
│       │   ├── deploy/
│       │   ├── monitoring/
│       │   ├── schedule/
│       │   ├── log/
│       │   └── settings/
│       ├── api/                    # API 엔드포인트
│       │   ├── v3/
│       │   │   ├── project.php
│       │   │   ├── content.php
│       │   │   ├── device.php
│       │   │   ├── deploy.php
│       │   │   └── ...
│       │   └── router.php
│       ├── css/
│       │   ├── main.css
│       │   ├── components.css
│       │   └── themes/
│       ├── js/
│       │   ├── app.js
│       │   ├── api.js
│       │   ├── components/
│       │   └── pages/
│       └── libs/
│
├── game/                           # 기존 유지
└── docs/                           # 문서
```

---

## 3. 데이터베이스 설계

### 3.1 신규 테이블 목록

| 테이블명 | 설명 | 우선순위 |
|:---------|:-----|:--------:|
| `sf_projects` | 프로젝트 정보 | 1차 |
| `sf_project_groups` | 프로젝트 그룹 | 1차 |
| `sf_contents` | 콘텐츠 메타 정보 | 1차 |
| `sf_content_versions` | 콘텐츠 버전 이력 | 2차 |
| `sf_devices` | 기기 정보 | 1차 |
| `sf_device_groups` | 기기 그룹 | 2차 |
| `sf_device_heartbeats` | 기기 상태 이력 | 2차 |
| `sf_deployments` | 배포 정보 | 2차 |
| `sf_deployment_results` | 배포 결과 상세 | 2차 |
| `sf_schedules` | 전원/콘텐츠 스케줄 | 2차 |
| `sf_alerts` | 알림/경고 | 3차 |
| `sf_audit_logs` | 감사 로그 | 2차 |
| `sf_users` | 사용자 (기존 확장) | 1차 |
| `sf_roles` | 역할 | 3차 |
| `sf_permissions` | 권한 | 3차 |
| `sf_assets` | 파일 자산 | 1차 |
| `sf_common_codes` | 공통 코드 | 1차 |

### 3.2 핵심 테이블 스키마

#### sf_projects (프로젝트)

```sql
CREATE TABLE sf_projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_key VARCHAR(50) NOT NULL UNIQUE COMMENT '프로젝트 키 (영문/숫자)',
    name VARCHAR(100) NOT NULL COMMENT '프로젝트명',
    description TEXT COMMENT '설명',
    category VARCHAR(50) COMMENT '카테고리 (school/library/public)',
    orientation CHAR(1) DEFAULT 'P' COMMENT '화면 방향 (P:세로, L:가로)',
    width INT DEFAULT 1080 COMMENT '화면 가로 픽셀',
    height INT DEFAULT 1920 COMMENT '화면 세로 픽셀',
    region VARCHAR(50) COMMENT '지역',
    status ENUM('active', 'paused', 'archived') DEFAULT 'active',
    theme_id INT COMMENT '적용 테마 ID',
    thumbnail VARCHAR(255) COMMENT '썸네일 경로',
    group_id INT COMMENT '프로젝트 그룹 ID',
    created_by INT COMMENT '생성자',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_region (region),
    INDEX idx_group (group_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### sf_contents (콘텐츠)

```sql
CREATE TABLE sf_contents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL COMMENT '소속 프로젝트',
    content_key VARCHAR(50) NOT NULL COMMENT '콘텐츠 키',
    name VARCHAR(100) NOT NULL COMMENT '콘텐츠명',
    content_type VARCHAR(30) NOT NULL COMMENT '타입 (image/video/pdf/survey/...)',
    status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
    current_version INT DEFAULT 1 COMMENT '현재 버전',
    config_json JSON COMMENT '콘텐츠 설정 JSON',
    area_position VARCHAR(50) COMMENT '배치 영역',
    display_order INT DEFAULT 0 COMMENT '표시 순서',
    created_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uk_project_content (project_id, content_key),
    INDEX idx_type (content_type),
    INDEX idx_status (status),
    FOREIGN KEY (project_id) REFERENCES sf_projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### sf_devices (기기)

```sql
CREATE TABLE sf_devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_key VARCHAR(100) NOT NULL UNIQUE COMMENT '기기 고유 키',
    name VARCHAR(100) COMMENT '기기명',
    project_id INT COMMENT '할당 프로젝트',
    group_id INT COMMENT '기기 그룹',
    status ENUM('online', 'offline', 'warning', 'unknown') DEFAULT 'unknown',
    app_version VARCHAR(20) COMMENT '앱 버전',
    content_version INT COMMENT '콘텐츠 버전',
    last_heartbeat DATETIME COMMENT '마지막 heartbeat',
    ip_address VARCHAR(45) COMMENT 'IP 주소',
    fcm_token VARCHAR(255) COMMENT 'FCM 토큰',
    extra_info JSON COMMENT '추가 정보 (배터리, 저장공간 등)',
    registered_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_project (project_id),
    INDEX idx_status (status),
    INDEX idx_heartbeat (last_heartbeat),
    FOREIGN KEY (project_id) REFERENCES sf_projects(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### sf_deployments (배포)

```sql
CREATE TABLE sf_deployments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT NOT NULL,
    deploy_type ENUM('content', 'config', 'full') DEFAULT 'content',
    target_type ENUM('all', 'group', 'device') DEFAULT 'all',
    target_ids JSON COMMENT '대상 ID 목록',
    content_version INT COMMENT '배포 콘텐츠 버전',
    status ENUM('created', 'queued', 'running', 'success', 'partial_fail', 'failed', 'rollback') DEFAULT 'created',
    success_count INT DEFAULT 0,
    fail_count INT DEFAULT 0,
    memo TEXT COMMENT '배포 메모',
    scheduled_at DATETIME COMMENT '예약 시간 (즉시 배포시 NULL)',
    started_at DATETIME,
    completed_at DATETIME,
    created_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_project (project_id),
    INDEX idx_status (status),
    INDEX idx_scheduled (scheduled_at),
    FOREIGN KEY (project_id) REFERENCES sf_projects(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

#### sf_audit_logs (감사 로그)

```sql
CREATE TABLE sf_audit_logs (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user_id INT COMMENT '수행자',
    action_type VARCHAR(50) NOT NULL COMMENT '액션 타입',
    target_type VARCHAR(50) COMMENT '대상 유형 (project/content/device/...)',
    target_id INT COMMENT '대상 ID',
    before_data JSON COMMENT '변경 전 데이터',
    after_data JSON COMMENT '변경 후 데이터',
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_user (user_id),
    INDEX idx_action (action_type),
    INDEX idx_target (target_type, target_id),
    INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

## 4. API 설계

### 4.1 API 규칙

| 항목 | 규칙 |
|:-----|:-----|
| 기본 경로 | `/api/v3/` |
| 인증 | Bearer Token (세션 기반) |
| 응답 형식 | JSON |
| 에러 코드 | HTTP 상태 코드 + 커스텀 코드 |

### 4.2 응답 구조

```json
// 성공
{
    "code": 100,
    "message": "success",
    "data": { ... }
}

// 실패
{
    "code": 400,
    "message": "Invalid parameter",
    "errors": [
        { "field": "project_key", "message": "이미 존재하는 키입니다" }
    ]
}
```

### 4.3 주요 API 엔드포인트

#### 프로젝트 API

| Method | Endpoint | 설명 |
|:-------|:---------|:-----|
| GET | `/api/v3/projects` | 프로젝트 목록 조회 |
| GET | `/api/v3/projects/{id}` | 프로젝트 상세 조회 |
| POST | `/api/v3/projects` | 프로젝트 생성 |
| PUT | `/api/v3/projects/{id}` | 프로젝트 수정 |
| DELETE | `/api/v3/projects/{id}` | 프로젝트 삭제 |
| GET | `/api/v3/projects/{id}/devices` | 프로젝트 기기 목록 |
| GET | `/api/v3/projects/{id}/contents` | 프로젝트 콘텐츠 목록 |
| POST | `/api/v3/projects/{id}/deploy` | 배포 요청 |

#### 콘텐츠 API

| Method | Endpoint | 설명 |
|:-------|:---------|:-----|
| GET | `/api/v3/contents` | 콘텐츠 목록 |
| GET | `/api/v3/contents/{id}` | 콘텐츠 상세 |
| POST | `/api/v3/contents` | 콘텐츠 생성 |
| PUT | `/api/v3/contents/{id}` | 콘텐츠 수정 |
| DELETE | `/api/v3/contents/{id}` | 콘텐츠 삭제 |
| GET | `/api/v3/contents/{id}/versions` | 버전 이력 |
| POST | `/api/v3/contents/{id}/publish` | 게시 |
| POST | `/api/v3/contents/{id}/rollback` | 롤백 |

#### 기기 API

| Method | Endpoint | 설명 |
|:-------|:---------|:-----|
| GET | `/api/v3/devices` | 기기 목록 |
| GET | `/api/v3/devices/{id}` | 기기 상세 |
| PUT | `/api/v3/devices/{id}` | 기기 수정 |
| POST | `/api/v3/devices/{id}/command` | 원격 명령 전송 |
| GET | `/api/v3/devices/{id}/heartbeats` | 상태 이력 |

#### 배포 API

| Method | Endpoint | 설명 |
|:-------|:---------|:-----|
| GET | `/api/v3/deployments` | 배포 목록 |
| GET | `/api/v3/deployments/{id}` | 배포 상세 |
| POST | `/api/v3/deployments` | 배포 생성 |
| POST | `/api/v3/deployments/{id}/retry` | 재시도 |
| POST | `/api/v3/deployments/{id}/rollback` | 롤백 |

---

## 5. 컴포넌트 설계

### 5.1 공통 컴포넌트

#### SummaryCard (요약 카드)

```php
<!-- components/summary-card.php -->
<?php
function renderSummaryCard($title, $value, $icon, $color = 'primary', $link = null) {
    ?>
    <div class="card summary-card border-left-<?= $color ?>">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-<?= $color ?> text-uppercase mb-1">
                        <?= htmlspecialchars($title) ?>
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?= htmlspecialchars($value) ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas <?= $icon ?> fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
        <?php if ($link): ?>
        <a href="<?= $link ?>" class="card-footer text-center small">
            자세히 보기 <i class="fas fa-arrow-right"></i>
        </a>
        <?php endif; ?>
    </div>
    <?php
}
?>
```

#### StatusBadge (상태 뱃지)

```php
<!-- components/status-badge.php -->
<?php
function renderStatusBadge($status, $type = 'default') {
    $configs = [
        'project' => [
            'active' => ['class' => 'success', 'label' => '운영중'],
            'paused' => ['class' => 'warning', 'label' => '일시정지'],
            'archived' => ['class' => 'secondary', 'label' => '보관'],
        ],
        'device' => [
            'online' => ['class' => 'success', 'label' => '온라인'],
            'offline' => ['class' => 'danger', 'label' => '오프라인'],
            'warning' => ['class' => 'warning', 'label' => '경고'],
            'unknown' => ['class' => 'secondary', 'label' => '알수없음'],
        ],
        'content' => [
            'draft' => ['class' => 'secondary', 'label' => '초안'],
            'published' => ['class' => 'success', 'label' => '게시중'],
            'archived' => ['class' => 'dark', 'label' => '보관'],
        ],
        'deploy' => [
            'created' => ['class' => 'info', 'label' => '생성됨'],
            'queued' => ['class' => 'info', 'label' => '대기중'],
            'running' => ['class' => 'primary', 'label' => '진행중'],
            'success' => ['class' => 'success', 'label' => '성공'],
            'partial_fail' => ['class' => 'warning', 'label' => '부분실패'],
            'failed' => ['class' => 'danger', 'label' => '실패'],
            'rollback' => ['class' => 'dark', 'label' => '롤백'],
        ],
    ];

    $config = $configs[$type][$status] ?? ['class' => 'secondary', 'label' => $status];
    ?>
    <span class="badge badge-<?= $config['class'] ?>"><?= $config['label'] ?></span>
    <?php
}
?>
```

#### DataTable (데이터 테이블)

```javascript
// js/components/data-table.js
class SFDataTable {
    constructor(tableId, options) {
        this.tableId = tableId;
        this.options = {
            apiUrl: '',
            columns: [],
            filters: {},
            pageSize: 20,
            ...options
        };
        this.currentPage = 1;
        this.init();
    }

    init() {
        this.renderTable();
        this.bindEvents();
        this.loadData();
    }

    async loadData() {
        const params = new URLSearchParams({
            page: this.currentPage,
            limit: this.options.pageSize,
            ...this.options.filters
        });

        try {
            const response = await fetch(`${this.options.apiUrl}?${params}`);
            const result = await response.json();

            if (result.code === 100) {
                this.renderRows(result.data.items);
                this.renderPagination(result.data.pagination);
            }
        } catch (error) {
            console.error('데이터 로드 실패:', error);
            C_showToast('오류', '데이터를 불러오는데 실패했습니다');
        }
    }

    renderRows(items) {
        const tbody = document.querySelector(`#${this.tableId} tbody`);
        tbody.innerHTML = items.map(item => this.renderRow(item)).join('');
    }

    renderRow(item) {
        return `<tr data-id="${item.id}">
            ${this.options.columns.map(col =>
                `<td>${col.render ? col.render(item) : item[col.key]}</td>`
            ).join('')}
        </tr>`;
    }

    setFilter(key, value) {
        this.options.filters[key] = value;
        this.currentPage = 1;
        this.loadData();
    }

    refresh() {
        this.loadData();
    }
}
```

---

## 6. 보안 설계

### 6.1 인증/인가

| 항목 | 구현 방식 |
|:-----|:---------|
| 세션 관리 | PHP 세션 + 토큰 기반 |
| 비밀번호 | bcrypt 해싱 |
| CSRF 방지 | 토큰 검증 |
| XSS 방지 | 출력 이스케이프 |
| SQL Injection | Prepared Statement |

### 6.2 권한 체크 함수

```php
<?php
// lib/auth.php
class Auth {
    const ROLE_VIEWER = 1;
    const ROLE_CONTENT_MANAGER = 2;
    const ROLE_DEVICE_MANAGER = 3;
    const ROLE_OPERATOR = 4;
    const ROLE_ADMIN = 5;
    const ROLE_SYSTEM_ADMIN = 7;

    public static function checkPermission($requiredRole) {
        $currentRole = $_SESSION['user_role'] ?? 0;
        if ($currentRole < $requiredRole) {
            http_response_code(403);
            echo json_encode(['code' => 403, 'message' => '권한이 없습니다']);
            exit;
        }
    }

    public static function canView($resource) {
        return self::hasPermission($resource, 'view');
    }

    public static function canEdit($resource) {
        return self::hasPermission($resource, 'edit');
    }

    public static function canDelete($resource) {
        return self::hasPermission($resource, 'delete');
    }
}
?>
```

### 6.3 감사 로그 기록

```php
<?php
// lib/audit.php
class AuditLogger {
    public static function log($action, $targetType, $targetId, $beforeData = null, $afterData = null) {
        global $pdo;

        $stmt = $pdo->prepare("
            INSERT INTO sf_audit_logs
            (user_id, action_type, target_type, target_id, before_data, after_data, ip_address, user_agent)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $_SESSION['user_id'] ?? null,
            $action,
            $targetType,
            $targetId,
            $beforeData ? json_encode($beforeData) : null,
            $afterData ? json_encode($afterData) : null,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null
        ]);
    }
}
?>
```

---

## 7. 성능 고려사항

### 7.1 캐싱 전략

| 대상 | 캐시 방식 | TTL |
|:-----|:---------|:----|
| 프로젝트 목록 | 메모리 캐시 | 5분 |
| 공통 코드 | 세션 캐시 | 30분 |
| 정적 자원 | 브라우저 캐시 | 1시간 |
| API 응답 | 조건부 캐시 | 요청별 |

### 7.2 데이터베이스 최적화

- 자주 조회되는 컬럼에 인덱스 추가
- 페이지네이션 필수 적용 (기본 20건)
- N+1 쿼리 방지를 위한 JOIN 사용
- 대량 데이터는 비동기 처리

### 7.3 프론트엔드 최적화

- JavaScript/CSS 번들링 및 압축
- 이미지 lazy loading
- DataTable 가상 스크롤 (1000건 이상)
- API 요청 디바운싱

---

## 8. 마이그레이션 계획

### 8.1 기존 데이터 마이그레이션

| 기존 | 신규 | 방식 |
|:-----|:-----|:-----|
| 프로젝트 설정 (로컬스토리지) | sf_projects | 수동 등록 |
| 콘텐츠 JSON | sf_contents | 스크립트 변환 |
| 기기 정보 | sf_devices | 자동 등록 |

### 8.2 호환성 유지

- v1, v2 API 기존 유지
- v3 API 신규 개발
- 점진적 전환 (6개월 목표)

---

## 9. 부록

### 9.1 콘텐츠 타입별 config_json 스키마

#### 이미지 (type_image)

```json
{
    "images": [
        { "url": "/path/to/image1.jpg", "order": 1 },
        { "url": "/path/to/image2.jpg", "order": 2 }
    ],
    "autoplay": true,
    "interval": 5000,
    "transition": "fade"
}
```

#### 비디오 (type_video)

```json
{
    "videoUrl": "/path/to/video.mp4",
    "autoplay": true,
    "loop": true,
    "muted": false,
    "controls": false
}
```

#### PDF (type_pdf)

```json
{
    "pdfUrl": "/path/to/document.pdf",
    "defaultZoom": 100,
    "showNavigation": true,
    "autoScroll": false
}
```

#### 설문 (type_survey)

```json
{
    "surveyId": "survey_001",
    "questions": [
        {
            "id": "q1",
            "type": "single",
            "text": "만족도를 선택해주세요",
            "options": ["매우 만족", "만족", "보통", "불만족"]
        }
    ],
    "thankYouMessage": "참여해 주셔서 감사합니다"
}
```

### 9.2 에러 코드 정의

| 코드 | 설명 |
|:----:|:-----|
| 100 | 성공 |
| 400 | 잘못된 요청 |
| 401 | 인증 필요 |
| 403 | 권한 없음 |
| 404 | 리소스 없음 |
| 409 | 충돌 (중복 키 등) |
| 500 | 서버 오류 |
| 503 | 서비스 일시 중단 |
