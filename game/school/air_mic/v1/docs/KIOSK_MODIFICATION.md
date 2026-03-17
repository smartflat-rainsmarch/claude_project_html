# Kiosk 시스템 수정 내역

Floor Guide Viewer 통합을 위해 수정된 파일과 변경 내용을 기록합니다.

---

## 변경 개요

- **목적**: Cocos2d 기반 MapDialogLayer를 Floor Guide Viewer로 대체
- **영향 범위**: 지도 표시 기능
- **호환성**: 기존 코드와 호환 유지 (폴백 지원)

---

## 수정된 파일

### 1. `index.html`

#### 변경 내용

1. **Floor Guide Viewer 스크립트 로드 추가**

```html
<!-- 기존 -->
<script src="jquery-3.2.1.min.js"></script>

<!-- 추가됨 -->
<script src="lib/floor-guide-viewer.min.js"></script>
<link rel="stylesheet" href="css/floor-viewer-overlay.css">
```

2. **지도 오버레이 컨테이너 HTML 추가**

```html
<!-- gameCanvas 아래에 추가됨 -->
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
```

3. **브릿지 스크립트 로드 추가**

```html
<script type="text/javascript" src="js/FloorGuideViewerBridge.js"></script>
```

---

### 2. `js/cmn_fnc.js`

#### 변경된 함수

`C_ShowMapDialogLayer(self, title, message, mapdatas, OKCallback, CancelCallback, style)`

#### 변경 전

```javascript
function C_ShowMapDialogLayer(self, title, message, mapdatas, OKCallback, CancelCallback, style) {
    var layer = new MapDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title, message, mapdatas, OKCallback, CancelCallback, style);
}
```

#### 변경 후

```javascript
function C_ShowMapDialogLayer(self, title, message, mapdatas, OKCallback, CancelCallback, style) {
    // Floor Guide Viewer 사용 (우선)
    if (window.floorViewerBridge) {
        try {
            var searchQuery = '';
            var floorId = null;

            // title에서 층 정보와 검색어 추출
            if (title && title.indexOf('|') >= 0) {
                var parts = title.split('|');
                var floorName = parts[0].trim();
                var floors = window.floorViewerBridge.getFloors();
                for (var i = 0; i < floors.length; i++) {
                    if (floors[i].name === floorName || floors[i].name.indexOf(floorName) >= 0) {
                        floorId = floors[i].id;
                        break;
                    }
                }
                searchQuery = parts[1] ? parts[1].trim() : '';
            } else if (title) {
                searchQuery = title.trim();
            }

            if (!searchQuery && message) {
                searchQuery = message.trim();
            }

            window.floorViewerBridge.show(searchQuery, function() {
                if (OKCallback && typeof OKCallback === 'function') {
                    OKCallback();
                }
            });

            if (floorId) {
                setTimeout(function() {
                    window.floorViewerBridge.setFloor(floorId);
                }, 200);
            }

            return;
        } catch (e) {
            console.error('[C_ShowMapDialogLayer] Floor Guide Viewer error:', e);
        }
    }

    // 폴백: 기존 MapDialogLayer 사용
    var layer = new MapDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title, message, mapdatas, OKCallback, CancelCallback, style);
}
```

#### 주요 변경점

| 항목 | 설명 |
|------|------|
| 우선순위 | Floor Guide Viewer가 있으면 우선 사용 |
| 폴백 | FloorGuideViewerBridge 오류 시 기존 MapDialogLayer 사용 |
| 파라미터 활용 | `title`에서 층 정보와 검색어 추출 (`층이름\|검색어` 형식) |
| 콜백 호출 | `OKCallback`을 지도 닫기 시 호출 |

---

## 추가된 파일

### 1. `lib/floor-guide-viewer.min.js`

- **설명**: Floor Guide Viewer 라이브러리 (압축됨)
- **원본**: `viewer_lib/dist/floor-guide-viewer.min.js`
- **크기**: 약 780KB

### 2. `css/floor-viewer-overlay.css`

- **설명**: 지도 오버레이 스타일
- **주요 스타일**:
  - 오버레이 컨테이너 (`#map-overlay-container`)
  - 좌측 층별안내 패널 (`#floor-info-panel`)
  - 층 버튼 (`floor-btn`, `floor-btn.active`)
  - 뷰어 컨테이너 (`#floor-viewer-container`)
  - 닫기 버튼 (`#btn-close-map`)
  - 로딩/에러 표시

### 3. `js/FloorGuideViewerBridge.js`

- **설명**: Floor Guide Viewer와 Cocos2d 시스템 간의 브릿지 클래스
- **주요 기능**:
  - `init()`: 뷰어 초기화 및 데이터 로드
  - `show(searchQuery, onClose)`: 지도 표시
  - `hide()`: 지도 숨기기
  - `setFloor(floorId)`: 층 변경
  - `search(query)`: POI 검색 및 포커스
  - `getFloors()`: 층 목록 조회

### 4. `data/building.zip`

- **설명**: 테스트용 건물 데이터
- **원본**: `viewer_lib/test/3d-sample-export.zip`
- **내용**: 1층, 2층 지도 데이터

### 5. `docs/` 폴더 (3개 문서)

- `FLOOR_VIEWER_API.md`: API 명세서
- `KIOSK_MODIFICATION.md`: 수정 내역 (본 문서)
- `INTEGRATION_GUIDE.md`: 연동 가이드

---

## 제거/비활성화된 기능

| 기능 | 상태 | 설명 |
|------|------|------|
| `MapDialogLayer` (Cocos2d) | 폴백으로 유지 | Floor Guide Viewer 오류 시에만 사용 |

---

## 신규 기능

| 기능 | 설명 |
|------|------|
| 2D 지도 뷰어 | Canvas 기반 고성능 지도 렌더링 |
| 층별 안내 패널 | 좌측 패널에 층 이름, 설명, 버튼 표시 |
| POI 검색 | 검색어로 POI 검색 및 자동 포커스 |
| POI 클릭 이벤트 | POI 클릭 시 팝업 표시 가능 |
| 터치 지원 | 드래그, 핀치 줌, 탭 제스처 지원 |
| ZIP 데이터 로드 | 에디터에서 내보낸 ZIP 파일 직접 로드 |

---

## 호환성 노트

1. **기존 호출 코드 수정 불필요**
   - `C_ShowMapDialogLayer()` 함수 시그니처 동일
   - 기존 호출 코드 그대로 작동

2. **폴백 지원**
   - Floor Guide Viewer 초기화 실패 시 기존 MapDialogLayer 사용
   - 에러 로그는 콘솔에 기록

3. **title 파라미터 확장**
   - 기존: 단순 문자열
   - 확장: `"층이름|검색어"` 형식 지원
   - 예: `"1층|스타벅스"` → 1층으로 이동 후 스타벅스 검색

---

## 테스트 체크리스트

- [ ] 지도 열기/닫기 동작 확인
- [ ] 층 버튼 클릭 시 층 전환 확인
- [ ] POI 검색 및 포커스 확인
- [ ] POI 클릭 시 이벤트 발생 확인
- [ ] 터치 제스처 (드래그, 줌) 확인
- [ ] 폴백 동작 확인 (Floor Guide Viewer 제거 후)

---

## 변경 이력

| 날짜 | 버전 | 변경 내용 |
|------|------|----------|
| 2024-XX-XX | 1.0.0 | Floor Guide Viewer 초기 통합 |
