# SmartFlat CMS 개발 가이드

## 개발 환경 설정

### 필수 소프트웨어

| 소프트웨어 | 버전 | 용도 |
|:-----------|:-----|:-----|
| XAMPP | 7.x+ | Apache + PHP + MySQL |
| Git | 2.x+ | 버전 관리 |
| VS Code | 최신 | 코드 에디터 (권장) |

### 설치 및 실행

1. **XAMPP 설치 및 실행**
   ```
   Apache 시작
   MySQL 시작 (필요시)
   ```

2. **프로젝트 클론**
   ```bash
   cd C:\xampp2\htdocs\
   git clone [repository-url] claude_project
   ```

3. **브라우저 접속**
   ```
   http://localhost/claude_project/html/web/v1/dist/
   ```

---

## 코드 구조

### PHP 파일 구조

```php
<?php
// 세션 시작
session_cache_expire(14400);
session_start();

// 공통 파일 포함
include('./cmn_var.php');  // 상수 정의
include('./cmn_func.php'); // 공통 함수
?>

<!-- HTML 시작 -->
<!DOCTYPE html>
...
```

### JavaScript 모듈 로딩

```javascript
// main.php에서 동적 로딩
$(document).ready(function() {
    $("#div_top").load("header.php", function() {
        $("#div_nav").load("nav.php", function() {
            // 초기화 로직
            uiinit(issession, usernamedesc);
            loadMainDiv(0);
        });
    });
});
```

---

## API 호출 방법

### CallHandler 함수

```javascript
CallHandler(type, data, success, error);

// 예시: 프로젝트 데이터 조회
CallHandler("adm_get", {
    type: "gethomedata",
    projectid: "sample"
}, function(res) {
    if (res.code == 100) {
        console.log(res.message);
    }
}, function(err) {
    console.error(err);
});
```

### AJAX_AdmGet 함수

```javascript
AJAX_AdmGet(ADM_TYPE.INSERT_PROJECTID, {
    projectid: "newproject",
    groupidx: 1,
    orientation: "P",
    width: 1080,
    height: 1920,
    region: "서울특별시"
}, function(res) {
    // 처리
});
```

---

## 새 페이지 추가

### 1. PHP 파일 생성

```php
<!-- d_newpage.php -->
<?php include('./common.php'); ?>

<div class="default-container">
    <div class="default-header">
        <h3>새 페이지</h3>
    </div>
    <div id="content">
        <!-- 내용 -->
    </div>
</div>

<script>
    // 페이지 로직
</script>
```

### 2. 네비게이션 메뉴 추가 (`nav.php`)

```html
<a class="nav-link" onclick="loadMainDiv(NEW_PAGE_ID)" id='nav_newpage'>
    <i class="fa-solid fa-icon"></i>&nbsp;&nbsp;
    <span class="nav-text">새 메뉴</span>
</a>
```

### 3. 메인 로더에 등록 (`scripts.js`)

```javascript
function loadMainDiv(pageid, value) {
    switch(pageid) {
        case NEW_PAGE_ID:
            $("#div_main").load("d_newpage.php");
            break;
        // ...
    }
}
```

---

## 새 콘텐츠 템플릿 추가

### 1. HTML 파일 생성 (`game/webpage/`)

```html
<!-- type_newtype.html -->
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>새 타입</title>

    <!-- 공통 라이브러리 -->
    <script src="./libs/jquery/jquery-3.5.1.min.js"></script>
    <script src="./js/scripts.js"></script>
</head>
<body>
    <div id="content">
        <!-- 콘텐츠 영역 -->
    </div>

    <script>
        var projectid = getParam("projectid") || "sample";
        var listid = getParam("listid") || "";

        // 초기화 로직
        document.addEventListener('DOMContentLoaded', function() {
            loadContent();
        });

        function loadContent() {
            // 콘텐츠 로드
        }
    </script>
</body>
</html>
```

### 2. URL 파라미터 활용

| 파라미터 | 용도 | 예시 |
|:---------|:-----|:-----|
| `projectid` | 프로젝트 식별자 | `?projectid=sample` |
| `groupidx` | 그룹 인덱스 | `?groupidx=1` |
| `listid` | 콘텐츠 ID | `?listid=content123` |

---

## CSS 스타일 가이드

### 기본 컨테이너

```css
.default-container {
    width: calc(100% - 300px);
    margin-left: 270px;
    margin-right: 20px;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);
}
```

### 반응형 브레이크포인트

| 브레이크포인트 | 용도 |
|:---------------|:-----|
| `max-width: 1200px` | 태블릿 (버튼 → 메뉴) |
| `max-width: 768px` | 모바일 (텍스트 → 아이콘) |

### 버튼 스타일

```css
/* 파란색 버튼 */
.detail_btn_blue { background-color: #009ef7; }
.detail_btn_blue:hover { background-color: #008ee7; }

/* 빨간색 버튼 */
.detail_btn_red { background-color: #f1416c; }
.detail_btn_red:hover { background-color: #e1315c; }

/* 회색 버튼 */
.detail_btn_gray { background-color: #e4e6ef; }
.detail_btn_gray:hover { background-color: #d4d6df; }
```

---

## Git 워크플로우

### 브랜치 전략

```
main          ← 운영 배포
  └── feature/xxx  ← 기능 개발
  └── fix/xxx      ← 버그 수정
```

### 커밋 메시지 규칙

```
[타입] 제목 (한글)

- feat: 새 기능
- fix: 버그 수정
- style: 스타일 변경
- refactor: 리팩토링
- docs: 문서 수정
```

**예시:**
```
feat: 헤더 드롭다운 반응형 디자인 개선
fix: 프로젝트 선택 시 페이지 새로고침 오류 수정
style: 좌측 메뉴 아이콘 정렬
```

---

## 디버깅

### 콘솔 로그

```javascript
// 전역 ID 확인
console.log("global_uid " + global_uid);
console.log("auth " + auth);

// API 응답 확인
CallHandler("adm_get", data, function(res) {
    console.log("res", res);
});
```

### 로딩 프로그레스

```javascript
// 표시
C_ShowLoadingProgress();

// 숨김
C_HideLoadingProgress();
```

### 네트워크 오류 처리

```javascript
if (!internet_connected) {
    C_showToast("인터넷연결 끊김", "네트워크 연결을 확인해 주세요");
    return;
}
```

---

## 배포 체크리스트

### 배포 전 확인사항

- [ ] 개발/운영 환경 분기 확인 (`isDevLocalHost()`)
- [ ] API 키 설정 확인 (Toss, FCM, Channel Talk)
- [ ] 콘솔 로그 제거 또는 비활성화
- [ ] CSS/JS 캐시 버스팅 (`?v=timestamp`)

### 캐시 버스팅

```php
$version = time();
$scriptsFile = "js/scripts.js?v=$version";
```

---

## Claude Forge 활용

프로젝트에 claude-forge가 설치되어 있어 다음 커맨드를 활용할 수 있습니다:

| 커맨드 | 용도 |
|:-------|:-----|
| `/plan` | 구현 계획 수립 |
| `/code-review` | 코드 리뷰 |
| `/tdd` | 테스트 주도 개발 |
| `/commit-push-pr` | 커밋 및 PR 자동화 |
| `/security-review` | 보안 검토 |

**사용 예시:**
```
/plan 로그인 기능 개선
/code-review header.php 변경사항 검토
```

