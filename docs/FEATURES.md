# SmartFlat CMS 기능 명세

## 1. 관리자 기능

### 1.1 프로젝트 관리

프로젝트는 각 학교/기관의 키오스크 콘텐츠 단위입니다.

| 기능 | 설명 | 위치 |
|:-----|:-----|:-----|
| 프로젝트 선택 | 드롭다운으로 프로젝트 전환 | `header.php` |
| 프로젝트 추가 | 새 프로젝트 생성 (ID, 방향, 크기, 지역) | `header.php` → `insertProjectIdPopup()` |
| 프로젝트 미리보기 | 새 창에서 키오스크 화면 미리보기 | `header.php` → `showPreviewWindow()` |

**프로젝트 생성 시 필수 정보:**
- 프로젝트명 (영어 소문자/숫자, 최대 20자)
- 화면 방향 (세로 P / 가로 L)
- 화면 크기 (가로 x 세로 픽셀)
- 지역 (시/도 선택)

### 1.2 전원 예약 설정

키오스크 기기의 전원 On/Off 시간을 예약할 수 있습니다.

| 기능 | 설명 |
|:-----|:-----|
| 재시작 시간 설정 | 매일 특정 시간에 기기 재시작 |
| 매일 On/Off | 매일 동일한 시간에 전원 켜기/끄기 |
| 요일별 On/Off | 요일별로 다른 전원 시간 설정 |

**데이터 구조 (`DEFAULT_ONOFF_SETTINGDATA`):**
```javascript
{
    "IS_SET_RESTART": false,
    "RESTART_HOUR": -1,
    "RESTART_MIN": -1,
    "SWITCH_TURN_ON_OFF": false,
    "SWITCH_WEEK_ON": false,
    "DAILY_ONTIME_HOUR": -1,
    "DAILY_OFFTIME_HOUR": -1,
    "WEEK_TURN_ONOFF_DATAS": [
        { "name": "월", "ontimehour": -1, "offtimehour": -1, ... },
        // 화, 수, 목, 금, 토, 일
    ]
}
```

### 1.3 화면 편집

키오스크에 표시될 콘텐츠를 편집합니다.

| 기능 | 설명 |
|:-----|:-----|
| 화면 수정 | 콘텐츠 레이아웃 및 내용 편집 |
| 이미지 에디터 | 이미지 파일 편집 및 생성 |
| 학교코드 추가 | 새 학교 코드 등록 (관리자용) |

### 1.4 원격 제어

FCM을 통해 키오스크 기기를 원격 제어합니다.

| 기능 | 설명 | 함수 |
|:-----|:-----|:-----|
| 가상 리모컨 | 원격 리모컨 팝업 | `sendRemocon()` |
| 전원 설정 전송 | On/Off 설정을 기기에 푸시 | `pushOnOffSetting()` |

---

## 2. 콘텐츠 타입

키오스크에 표시할 수 있는 콘텐츠 유형입니다.

### 2.1 이미지 (`type_image.html`)

이미지 슬라이드 또는 단일 이미지 표시

- 최대 5개 이미지 지원
- 자동 스크롤
- 이미지 오류 시 자동 숨김

### 2.2 비디오 (`type_video.html`)

비디오 콘텐츠 재생

- 자동 재생
- 반복 재생 옵션
- 갤러리 형태 지원 (`type_video_gallery.html`)

### 2.3 갤러리 (`type_gallery.html`, `type_gallery1.html`, `type_gallery2.html`)

이미지 갤러리 형태로 콘텐츠 표시

- 그리드 레이아웃
- 썸네일 + 상세보기
- 다양한 레이아웃 옵션

### 2.4 PDF 뷰어 (`type_pdf_gallery.html`)

PDF 문서 표시

- PDF.js 라이브러리 사용
- 페이지 네비게이션
- 확대/축소 기능

### 2.5 설문조사 (`type_survey.html`)

터치 기반 설문조사

- 관리자 설계 화면 (`survey_admin_design.html`)
- 설문 목록 (`type_survey_list.html`)
- 결과 수집

### 2.6 캘린더 (`type_calendar.html`)

일정 및 이벤트 표시

- 월간 캘린더 뷰
- 이벤트 표시

### 2.7 게시판 (`type_board.html`)

공지사항 및 게시글 표시

- 리스트 형태
- 상세보기

### 2.8 FAQ (`type_faq.html`)

자주 묻는 질문

- 아코디언 형태
- 카테고리별 분류

### 2.9 층별 안내 (`type_floor.html`)

건물 층별 안내도

- 인터랙티브 층 선택
- 시설 정보 표시

### 2.10 교가 게임 (`type_game_schoollyrics.html`)

학교 교가 관련 게임 콘텐츠

- 가사 맞추기
- 점수 시스템

---

## 3. UI 컴포넌트

### 3.1 헤더 (`header.php`)

| 영역 | 기능 |
|:-----|:-----|
| 좌측 | 로고, 프로젝트 선택 드롭다운 |
| 중앙 | 미리보기 버튼, 전원 설정, 이미지 에디터, 리모컨 |
| 우측 | 사용자 아이콘, 이름, 로그인/로그아웃 |

**반응형 동작:**
- 1200px 이하: 상단 버튼을 햄버거 메뉴로 변경
- 768px 이하: 프로젝트 선택을 'P' 버튼으로 변경, 사용자 이름 숨김

### 3.2 사이드바 (`nav.php`)

| 메뉴 | 기능 |
|:-----|:-----|
| 화면수정 | 콘텐츠 편집 화면 |
| 학교코드 추가 | 관리자용 학교 등록 |
| 리모컨 버튼 | 가상 리모컨 (하단 고정) |

**반응형 동작:**
- 768px 이하: 텍스트 숨김, 아이콘만 표시, 너비 60px로 축소

### 3.3 모달 다이얼로그

`showModalDialog()` 함수로 팝업 표시

```javascript
showModalDialog(
    parent,       // 부모 요소
    title,        // 제목
    message,      // 내용 (HTML)
    okText,       // 확인 버튼 텍스트
    cancelText,   // 취소 버튼 텍스트
    okCallback,   // 확인 콜백
    cancelCallback, // 취소 콜백
    style         // 스타일 옵션
);
```

### 3.4 토스트 알림

`C_showToast()` 함수로 알림 표시

```javascript
C_showToast(title, message, callback);
```

---

## 4. 데이터 저장

### 4.1 로컬 스토리지

`saveData()` / `getData()` 함수로 브라우저 로컬 스토리지 사용

| 키 | 용도 |
|:---|:-----|
| `nowprojectid` | 현재 선택된 프로젝트 ID |
| `onofftime_[projectid]` | 전원 설정 데이터 |
| `postittoggle` | 포스트잇 표시 여부 |

### 4.2 세션

PHP 세션으로 로그인 상태 유지

| 세션 키 | 용도 |
|:--------|:-----|
| `key_dev` / `key_real` | 로그인 세션 토큰 |

---

## 5. 외부 연동

### 5.1 Toss Payments

결제 처리를 위한 토스페이먼츠 연동

```javascript
// 클라이언트 키
TOSS_CLIENT_KEY_DEV = "test_sk_..."; // 테스트
TOSS_CLIENT_KEY = "live_ck_...";     // 운영
```

### 5.2 FCM (Firebase Cloud Messaging)

키오스크 기기로 푸시 메시지 발송

```javascript
sendPush("remote_control", JSON.stringify(pushdata), callback);
```

### 5.3 Channel Talk

고객 상담 채팅 위젯

```javascript
CHANNEL_TALK_PLUGIN_KEY = "65efcbbd-...";
```

---

## 6. 보안

### 6.1 AES 암호화

민감한 데이터 암호화

- `static/js/aes/aes.js` - AES 알고리즘
- `static/js/aes/aes-ctr.js` - CTR 모드
- `static/js/aes/base64.js` - Base64 인코딩
- `static/js/aes/utf8.js` - UTF-8 처리

### 6.2 권한 체크

페이지 접근 시 권한 확인

```javascript
if (auth < AUTH_OWNER) {
    // 기능 숨김 또는 접근 차단
}
```

---

## 7. 개발/운영 환경 분리

URL에 따라 개발/운영 환경 자동 감지

```php
// cmn_func.php
function isDevLocalHost() {
    // localhost, dev → 개발 환경
    // real, blackgym.co.kr, bodypass.co.kr → 운영 환경
}
```

| 환경 | 도메인 | 결제키 |
|:-----|:-------|:-------|
| 개발 | localhost, dev | 테스트 키 |
| 운영 | real, 도메인 | 운영 키 |

