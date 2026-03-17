# SmartFlat CMS 프로젝트 구조

## 개요

**SmartFlat CMS**는 학교 및 기관용 디지털 사이니지/키오스크 콘텐츠 관리 시스템(CMS)입니다.
관리자가 웹 기반 인터페이스를 통해 키오스크에 표시될 콘텐츠를 관리하고, 원격으로 기기를 제어할 수 있습니다.

---

## 기술 스택

| 분류 | 기술 |
|:-----|:-----|
| **백엔드** | PHP 7.x+ (XAMPP) |
| **프론트엔드** | HTML5, CSS3, JavaScript (ES6) |
| **UI 프레임워크** | Bootstrap 4, SB Admin Template |
| **JavaScript 라이브러리** | jQuery 3.5.1, Swiper, DataTables |
| **아이콘** | FontAwesome 6 |
| **결제** | Toss Payments |
| **푸시 알림** | FCM (Firebase Cloud Messaging) |
| **기타** | QRCode.js, XLSX.js, Chart.js, PDF.js |

---

## 디렉토리 구조

```
html/
├── web/                          # 웹 애플리케이션
│   ├── v1/dist/                  # 관리자 CMS (메인)
│   │   ├── index.php             # 진입점 (로그인 체크)
│   │   ├── main.php              # 메인 레이아웃
│   │   ├── header.php            # 상단 헤더 (프로젝트 선택, 사용자 메뉴)
│   │   ├── nav.php               # 좌측 사이드바 네비게이션
│   │   ├── cmn_var.php           # 공통 변수 정의
│   │   ├── cmn_func.php          # 공통 함수 정의
│   │   ├── css/                  # 스타일시트
│   │   ├── js/                   # JavaScript (scripts.js)
│   │   ├── libs/                 # 외부 라이브러리
│   │   └── img/                  # 이미지 리소스
│   │
│   └── v2/dist/                  # 회원용 웹페이지
│       ├── login.php             # 로그인
│       ├── join.php              # 회원가입
│       ├── m_my_*.php            # 회원 관련 페이지들
│       └── ...
│
├── game/                         # 키오스크 콘텐츠
│   ├── school/                   # 학교별 프로젝트
│   │   ├── kunja_asn/            # 군자초 프로젝트
│   │   ├── maecheon/             # 매천중 프로젝트
│   │   ├── yclib/                # 양천도서관 프로젝트
│   │   ├── sample_port/          # 샘플 (세로)
│   │   ├── sample_land/          # 샘플 (가로)
│   │   └── [프로젝트명]/
│   │       ├── v0/, v1/, v2/     # 버전별 폴더
│   │       ├── index.html        # 키오스크 메인 화면
│   │       ├── bg.png            # 배경 이미지
│   │       ├── build.xml         # 빌드 설정
│   │       ├── res/              # 리소스 (이미지, 오디오)
│   │       ├── static/js/        # JavaScript (AES 암호화 포함)
│   │       └── README.md
│   │
│   └── webpage/                  # 콘텐츠 템플릿
│       ├── type_image.html       # 이미지 뷰어
│       ├── type_video.html       # 비디오 플레이어
│       ├── type_gallery.html     # 갤러리
│       ├── type_pdf_gallery.html # PDF 뷰어
│       ├── type_survey.html      # 설문조사
│       ├── type_calendar.html    # 캘린더
│       ├── type_board.html       # 게시판
│       ├── type_faq.html         # FAQ
│       ├── type_floor.html       # 층별 안내
│       ├── libs/                 # 공통 라이브러리
│       │   ├── pdf.js/           # PDF 렌더링
│       │   ├── swiper/           # 슬라이드
│       │   └── qrcode/           # QR코드 생성
│       └── js/scripts.js         # 공통 스크립트
│
├── demo/                         # 데모 콘텐츠
│   ├── schoollyrics/             # 교가 게임 데모
│   └── flappybird/               # 게임 데모
│
├── PHPMailer-master/             # 이메일 발송 라이브러리
│
├── docs/                         # 프로젝트 문서
│
└── claude-forge/                 # Claude Code 확장 프레임워크
```

---

## 핵심 모듈 설명

### 1. 관리자 CMS (`web/v1/dist/`)

관리자가 키오스크 콘텐츠를 관리하는 웹 인터페이스입니다.

| 파일 | 설명 |
|:-----|:-----|
| `main.php` | 메인 레이아웃, header.php와 nav.php를 동적 로드 |
| `header.php` | 프로젝트 선택, 미리보기, 전원 설정, 사용자 메뉴 |
| `nav.php` | 좌측 사이드바 메뉴 (화면수정, 학교코드 추가 등) |
| `cmn_var.php` | 상수 및 전역 변수 정의 (권한, API 타입, 색상 등) |
| `cmn_func.php` | 공통 PHP 함수 (환경 감지, 결제키 등) |
| `js/scripts.js` | 핵심 JavaScript (API 호출, UI 처리) |

### 2. 키오스크 콘텐츠 (`game/school/`)

각 학교/기관별로 분리된 키오스크 화면입니다.

- **버전 관리**: v0, v1, v2 등 폴더로 버전 구분
- **구성 요소**: index.html, 배경이미지, 리소스, 스크립트
- **AES 암호화**: 민감한 데이터 보호를 위한 암호화 모듈 포함

### 3. 콘텐츠 템플릿 (`game/webpage/`)

재사용 가능한 콘텐츠 타입별 템플릿입니다.

| 템플릿 | 용도 |
|:-------|:-----|
| `type_image.html` | 이미지 슬라이드/뷰어 |
| `type_video.html` | 비디오 재생 |
| `type_gallery.html` | 이미지 갤러리 |
| `type_pdf_gallery.html` | PDF 문서 뷰어 |
| `type_survey.html` | 설문조사 |
| `type_calendar.html` | 일정/캘린더 |
| `type_board.html` | 게시판 |
| `type_faq.html` | FAQ |
| `type_floor.html` | 층별 안내도 |

---

## API 구조

백엔드 API는 `ssapi/` 폴더에 위치하며, `CallHandler()` 함수를 통해 호출됩니다.

### 주요 API 엔드포인트

| 핸들러 | 파일 | 용도 |
|:-------|:-----|:-----|
| `login` | `login_web.php` | 로그인 처리 |
| `logout` | `logout_web.php` | 로그아웃 처리 |
| `getdata` | `getdata.php` | 데이터 조회 |
| `adm_get` | `adm_get.php` | 관리자 API |
| `adm_game` | `adm_game.php` | 게임/키오스크 API |
| `homepage` | `homepage.php` | 홈페이지 데이터 |
| `push_message` | `push_message.php` | 푸시 메시지 |

### ADM_TYPE 상수 (API 타입)

```javascript
ADM_TYPE = {
    GET_HOME_DATA: "gethomedata",      // 홈 데이터 조회
    UPDATE_UI_DATA: "updateuidata",    // UI 데이터 업데이트
    INSERT_SCHOOL_CODE: "insertschoolcode", // 학교 코드 삽입
    INSERT_PROJECTID: "insertprojectid",   // 프로젝트 추가
    GET_PROJECTIDS: "getprojectids",   // 프로젝트 목록
    PUSH: "push",                      // 푸시 발송
    UPLOAD_FILE: "uploadfile",         // 파일 업로드
    // ... 등
}
```

---

## 권한 시스템

사용자 권한은 계층형 구조로 관리됩니다.

| 상수 | 값 | 권한 |
|:-----|:--:|:-----|
| `AUTH_OTHER` | -1 | 알 수 없음 (블랙리스트) |
| `AUTH_NOMEMBER` | 0 | 비회원 |
| `AUTH_CUSTOMER` | 1 | 일반 고객 |
| `AUTH_TRANER` | 2 | 트레이너 |
| `AUTH_MANAGER` | 3 | 관리자 |
| `AUTH_OPERATOR` | 4 | 점장/사장 |
| `AUTH_OWNER` | 5 | 운영자 |
| `AUTH_SYSTEMOWNER` | 7 | 시스템 관리자 |

---

## 반응형 디자인

CSS 미디어 쿼리를 사용하여 다양한 화면 크기를 지원합니다.

```css
@media (max-width: 768px) {
    /* 모바일: 텍스트 숨기고 아이콘만 표시 */
    .nav-text { display: none; }
    #layoutSidenav_nav { width: 60px !important; }
}

@media (max-width: 1200px) {
    /* 태블릿: 상단 버튼을 메뉴로 변경 */
    .top-buttons { display: none !important; }
    .menu-btn { display: block !important; }
}
```

---

## 외부 서비스 연동

| 서비스 | 용도 | 설정 위치 |
|:-------|:-----|:----------|
| **Toss Payments** | 결제 처리 | `cmn_var.php` (TOSS_CLIENT_KEY) |
| **FCM** | 푸시 알림 | `push_message.php` |
| **Channel Talk** | 고객 상담 채팅 | `main.php` (플러그인 키) |

---

## 버전 정보

- **현재 버전**: 2.35
- **APK 버전**: 2.26 (vc 66)
- **UI 프레임워크**: SB Admin v6.0.2

