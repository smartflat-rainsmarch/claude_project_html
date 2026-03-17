# Floor Guide Viewer 연동 가이드

키오스크 시스템에 Floor Guide Viewer를 연동하는 방법을 설명합니다.

---

## 목차

1. [설치 방법](#1-설치-방법)
2. [초기화 코드](#2-초기화-코드)
3. [지도 표시/숨기기](#3-지도-표시숨기기)
4. [층 전환](#4-층-전환)
5. [POI 검색](#5-poi-검색)
6. [이벤트 처리](#6-이벤트-처리)
7. [데이터 변환](#7-데이터-변환)
8. [트러블슈팅](#8-트러블슈팅)

---

## 1. 설치 방법

### 1.1 필요 파일 배치

```
kiosk_test/
├── lib/
│   └── floor-guide-viewer.min.js   # 뷰어 라이브러리
├── css/
│   └── floor-viewer-overlay.css    # 스타일
├── js/
│   └── FloorGuideViewerBridge.js   # 브릿지 클래스
└── data/
    └── building.zip                 # 지도 데이터
```

### 1.2 index.html에 스크립트 추가

```html
<head>
  <!-- 기존 스크립트들... -->

  <!-- Floor Guide Viewer -->
  <script src="lib/floor-guide-viewer.min.js"></script>
  <link rel="stylesheet" href="css/floor-viewer-overlay.css">
</head>

<body>
  <!-- 기존 요소들... -->

  <!-- 지도 오버레이 컨테이너 -->
  <div id="map-overlay-container">
    <div class="map-overlay-inner">
      <div id="floor-info-panel">
        <div class="floor-title">층별안내</div>
        <div class="floor-name" id="current-floor-name">1층</div>
        <div class="floor-subtitle" id="current-floor-desc">로딩 중...</div>
        <div class="floor-buttons" id="floor-buttons-container"></div>
      </div>
      <div id="floor-viewer-container">
        <div class="viewer-loading" id="viewer-loading">
          <div class="viewer-loading-spinner"></div>
          <div class="viewer-loading-text">지도 로딩 중...</div>
        </div>
      </div>
      <button id="btn-close-map">홈</button>
    </div>
  </div>

  <!-- 브릿지 스크립트 (Cocos2d 다음에 로드) -->
  <script src="js/FloorGuideViewerBridge.js"></script>
</body>
```

---

## 2. 초기화 코드

### 2.1 자동 초기화 (권장)

브릿지는 `window.floorViewerBridge`로 자동 생성됩니다.
처음 `show()` 호출 시 자동으로 초기화됩니다.

```javascript
// 첫 show() 호출 시 자동 초기화
window.floorViewerBridge.show();
```

### 2.2 수동 초기화

초기화를 미리 수행하려면:

```javascript
document.addEventListener('DOMContentLoaded', async () => {
  const success = await window.floorViewerBridge.init();
  if (success) {
    console.log('Floor Guide Viewer 초기화 완료');
  }
});
```

### 2.3 데이터 경로 변경

기본 경로는 `data/building.zip`입니다. 변경하려면:

```javascript
window.floorViewerBridge.dataPath = 'custom/path/to/data.zip';
await window.floorViewerBridge.init();
```

---

## 3. 지도 표시/숨기기

### 3.1 기본 표시

```javascript
window.floorViewerBridge.show();
```

### 3.2 검색어와 함께 표시

```javascript
// '스타벅스' 검색 후 해당 POI로 포커스
window.floorViewerBridge.show('스타벅스');
```

### 3.3 닫기 콜백 지정

```javascript
window.floorViewerBridge.show('스타벅스', function() {
  console.log('지도가 닫혔습니다');
  // 홈 화면으로 돌아가기 등
});
```

### 3.4 지도 숨기기

```javascript
window.floorViewerBridge.hide();
```

---

## 4. 층 전환

### 4.1 층 목록 조회

```javascript
const floors = window.floorViewerBridge.getFloors();
console.log(floors);
// [
//   { id: 'floor-2', name: '2층', level: 2, description: '식품관' },
//   { id: 'floor-1', name: '1층', level: 1, description: '화장품' }
// ]
```

### 4.2 현재 층 조회

```javascript
const current = window.floorViewerBridge.getCurrentFloor();
console.log(current.name); // "1층"
```

### 4.3 층 변경

```javascript
// ID로 변경
window.floorViewerBridge.setFloor('floor-2');
```

---

## 5. POI 검색

### 5.1 검색 및 자동 포커스

```javascript
// 검색 + 해당 층 이동 + 포커스 + 하이라이트
const results = window.floorViewerBridge.search('스타벅스');
console.log(`${results.length}개 결과 발견`);
```

### 5.2 검색만 수행 (포커스 없음)

```javascript
const results = window.floorViewerBridge.searchPOI('카페');
results.forEach(r => {
  console.log(`${r.name} (${r.floorName})`);
});
```

### 5.3 특정 POI로 포커스

```javascript
window.floorViewerBridge.focusPOI('poi-123', { zoom: 2.0 });
```

---

## 6. 이벤트 처리

### 6.1 POI 클릭 이벤트

FloorGuideViewerBridge는 POI 클릭 시 기존 `C_ShowDialogLayer()`를 호출합니다.

커스텀 처리가 필요하면 뷰어에 직접 이벤트 등록:

```javascript
// 초기화 후
window.floorViewerBridge.viewer.on('poi:click', (poiInfo) => {
  // 커스텀 팝업 표시
  showMyPopup({
    title: poiInfo.name,
    description: poiInfo.properties.description,
    floor: poiInfo.floorId
  });
});
```

### 6.2 층 변경 이벤트

```javascript
window.floorViewerBridge.viewer.on('floor:change', (floorInfo) => {
  updateFloorDisplay(floorInfo.name, floorInfo.description);
});
```

---

## 7. 데이터 변환

### 7.1 에디터에서 데이터 내보내기

1. Floor Guide Editor에서 건물 데이터 편집
2. "내보내기" 버튼 클릭
3. ZIP 파일 다운로드
4. `kiosk_test/data/building.zip`으로 복사

### 7.2 ZIP 파일 구조

```
building.zip/
├── manifest.json      # 메타정보
├── building.json      # 건물 정보
├── categories.json    # POI 카테고리
└── floors/
    ├── floor-1층.json # 1층 데이터
    └── floor-2층.json # 2층 데이터
```

### 7.3 층 설명 추가

에디터에서 층 탭 클릭 → 팝오버 메뉴 → "층 설정" → 설명 입력

```json
// floor-1층.json
{
  "id": "floor-1",
  "name": "1층",
  "level": 1,
  "description": "화장품 & 잡화 & 구두",
  "elements": [...]
}
```

---

## 8. 트러블슈팅

### 8.1 "FloorGuideViewer library not loaded" 에러

**원인**: floor-guide-viewer.min.js 로드 실패

**해결**:
1. 파일 경로 확인 (`lib/floor-guide-viewer.min.js`)
2. 네트워크 탭에서 404 에러 확인
3. 스크립트 로드 순서 확인 (브릿지보다 먼저 로드)

### 8.2 "Required DOM elements not found" 에러

**원인**: HTML 오버레이 요소 누락

**해결**:
1. `#map-overlay-container` 요소 존재 확인
2. `#floor-viewer-container` 요소 존재 확인

### 8.3 지도가 표시되지 않음

**원인**: 컨테이너 크기 0

**해결**:
1. CSS에서 `#floor-viewer-container` 크기 확인
2. `display: none` 상태에서 초기화하면 리사이즈 필요

```javascript
// 표시 후 리사이즈
window.floorViewerBridge.show();
setTimeout(() => {
  window.floorViewerBridge.viewer.resize();
}, 100);
```

### 8.4 터치 이벤트 Cocos2d와 충돌

**원인**: 이벤트 버블링

**해결**: 오버레이 컨테이너에서 이벤트 전파 차단

```javascript
document.getElementById('map-overlay-container').addEventListener('touchstart', (e) => {
  e.stopPropagation();
}, { passive: false });
```

### 8.5 POI 검색 결과 없음

**원인**: 검색어 불일치 또는 searchable=false

**해결**:
1. POI 이름 정확히 확인
2. 에디터에서 POI의 `searchable` 속성 확인
3. 숨겨진 POI 포함하려면:

```javascript
viewer.searchPOI('검색어', { includeHidden: true });
```

### 8.6 기존 MapDialogLayer로 폴백됨

**원인**: Floor Guide Viewer 초기화 실패

**확인**:
1. 콘솔에서 에러 메시지 확인
2. `window.floorViewerBridge.isInitialized` 값 확인

```javascript
console.log(window.floorViewerBridge.isInitialized); // false면 초기화 실패
```

---

## 코드 예제: 통합 구현

```javascript
// 검색 버튼 클릭 시
function onSearchButtonClick(searchText) {
  if (window.floorViewerBridge) {
    window.floorViewerBridge.show(searchText, function() {
      // 지도 닫힘 - 메인 화면으로
      showMainScreen();
    });
  }
}

// 층 버튼 클릭 시
function onFloorButtonClick(floorId) {
  window.floorViewerBridge.setFloor(floorId);
}

// 홈 버튼 클릭 시
function onHomeButtonClick() {
  window.floorViewerBridge.hide();
}
```

---

## 참고 자료

- [FLOOR_VIEWER_API.md](FLOOR_VIEWER_API.md) - 전체 API 명세
- [KIOSK_MODIFICATION.md](KIOSK_MODIFICATION.md) - 수정 내역
