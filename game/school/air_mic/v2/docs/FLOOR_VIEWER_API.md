# Floor Guide Viewer API 명세서

Floor Guide Viewer 라이브러리의 공개 API 명세입니다.

## 목차

1. [초기화](#초기화)
2. [데이터 로드](#데이터-로드)
3. [층 관리](#층-관리)
4. [POI 검색](#poi-검색)
5. [포커스 및 하이라이트](#포커스-및-하이라이트)
6. [이벤트](#이벤트)
7. [타입 정의](#타입-정의)

---

## 초기화

### `new FloorGuideViewer(options)`

FloorGuideViewer 인스턴스를 생성합니다.

#### 옵션

| 파라미터 | 타입 | 필수 | 기본값 | 설명 |
|---------|------|------|--------|------|
| `container` | `HTMLElement \| string` | O | - | 뷰어를 마운트할 컨테이너 요소 또는 선택자 |
| `mode` | `'2d' \| '2.5d' \| '3d'` | X | `'2d'` | 렌더링 모드 |
| `interactive` | `boolean` | X | `true` | 상호작용 가능 여부 (드래그, 줌) |
| `touchEnabled` | `boolean` | X | `true` | 터치 이벤트 활성화 |
| `initialZoom` | `number` | X | `1.0` | 초기 줌 레벨 |
| `minZoom` | `number` | X | `0.5` | 최소 줌 레벨 |
| `maxZoom` | `number` | X | `3.0` | 최대 줌 레벨 |
| `showPaths` | `boolean` | X | `false` | 경로(PATH) 요소 표시 여부 |
| `showPathShading` | `boolean` | X | `false` | 통로 음영 표시 여부 |
| `theme` | `'light' \| 'dark' \| ThemeConfig` | X | `'light'` | 테마 설정 |
| `locale` | `'ko' \| 'en' \| 'ja' \| 'zh'` | X | `'ko'` | 언어 설정 |

#### 예제

```javascript
const viewer = new FloorGuideViewer({
  container: '#floor-viewer-container',
  mode: '2d',
  interactive: true,
  touchEnabled: true,
  showPaths: false,
});
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `FloorGuideViewer` | 뷰어 인스턴스 |

---

## 데이터 로드

### `load(url)`

ZIP 또는 JSON 파일에서 건물 데이터를 로드합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `url` | `string` | O | 데이터 파일 URL (.zip 또는 .json) |

#### 예제

```javascript
await viewer.load('data/building.zip');
// 로드 완료
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `Promise<void>` | 로드 완료 시 resolve |

#### 에러

- 파일을 찾을 수 없는 경우: `Error: Failed to load: 404 Not Found`
- 잘못된 ZIP 형식: `Error: Invalid ZIP: manifest.json not found`

---

### `loadFile(file)`

File 객체에서 건물 데이터를 로드합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `file` | `File` | O | ZIP 또는 JSON 파일 객체 |

#### 예제

```javascript
const fileInput = document.getElementById('file-input');
const file = fileInput.files[0];
await viewer.loadFile(file);
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `Promise<void>` | 로드 완료 시 resolve |

---

## 층 관리

### `getFloors()`

건물의 모든 층 목록을 조회합니다.

#### 파라미터

없음

#### 예제

```javascript
const floors = viewer.getFloors();
console.log(floors);
// [
//   { id: 'floor-2', name: '2층', level: 2, description: '식품관 & 카페' },
//   { id: 'floor-1', name: '1층', level: 1, description: '화장품 & 잡화' }
// ]
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `FloorInfo[]` | 층 정보 배열 (레벨순 정렬) |

---

### `getCurrentFloor()`

현재 표시 중인 층 정보를 조회합니다.

#### 파라미터

없음

#### 예제

```javascript
const currentFloor = viewer.getCurrentFloor();
console.log(currentFloor);
// { id: 'floor-1', name: '1층', level: 1, description: '화장품 & 잡화' }
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `FloorInfo \| null` | 현재 층 정보, 없으면 null |

---

### `setFloor(floorId)`

표시할 층을 변경합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `floorId` | `string` | O | 변경할 층 ID |

#### 예제

```javascript
viewer.setFloor('floor-2');
// 2층으로 전환
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `void` | - |

---

## POI 검색

### `searchPOI(query, options?)`

POI(관심 지점)를 검색합니다. 이름, 카테고리, 그룹을 기준으로 검색합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `query` | `string` | O | 검색어 |
| `options` | `POISearchOptions` | X | 검색 옵션 |

#### POISearchOptions

| 옵션 | 타입 | 기본값 | 설명 |
|------|------|--------|------|
| `searchName` | `boolean` | `true` | 이름 검색 여부 |
| `searchCategory` | `boolean` | `true` | 카테고리 검색 여부 |
| `searchGroup` | `boolean` | `true` | 그룹 검색 여부 |
| `floorId` | `string` | - | 특정 층만 검색 |
| `categoryId` | `string` | - | 특정 카테고리만 검색 |
| `groupId` | `string` | - | 특정 그룹만 검색 |
| `includeHidden` | `boolean` | `false` | 숨겨진 POI 포함 여부 |

#### 예제

```javascript
// 기본 검색
const results = viewer.searchPOI('스타벅스');
console.log(results);
// [
//   {
//     id: 'poi-1',
//     name: '스타벅스',
//     category: 'cafe',
//     floorId: 'floor-1',
//     floorName: '1층',
//     floorLevel: 1,
//     position: { x: 150, y: 200 },
//     relevanceScore: 1.0,
//     matchedField: 'name',
//     matchedText: '스타벅스'
//   }
// ]

// 특정 층에서만 검색
const results2 = viewer.searchPOI('카페', { floorId: 'floor-2' });
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `POISearchResult[]` | 검색 결과 배열 (관련도순 정렬) |

---

### `autocomplete(query, options?)`

POI 자동완성 결과를 반환합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `query` | `string` | O | 검색어 |
| `options` | `object` | X | `{ limit: number }` |

#### 예제

```javascript
const suggestions = viewer.autocomplete('스타', { limit: 5 });
console.log(suggestions);
// [
//   { type: 'poi', text: '스타벅스', poiId: 'poi-1', floorName: '1층' },
//   { type: 'category', text: '카페', categoryId: 'cafe' }
// ]
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `POIAutocompleteResult[]` | 자동완성 결과 배열 |

---

## 포커스 및 하이라이트

### `focusElement(elementId, options?)`

특정 요소로 화면을 이동하고 포커스합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `elementId` | `string` | O | 포커스할 요소(POI, 등) ID |
| `options` | `FocusOptions` | X | 포커스 옵션 |

#### FocusOptions

| 옵션 | 타입 | 기본값 | 설명 |
|------|------|--------|------|
| `zoom` | `number` | - | 포커스 시 줌 레벨 |
| `animate` | `boolean` | `true` | 애니메이션 여부 |
| `duration` | `number` | `500` | 애니메이션 시간 (ms) |

#### 예제

```javascript
viewer.focusElement('poi-1', { animate: true, zoom: 2.0 });
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `void` | - |

---

### `highlightPOI(poiId)`

POI를 강조 표시합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `poiId` | `string` | O | 하이라이트할 POI ID |

#### 예제

```javascript
viewer.highlightPOI('poi-1');
// POI가 강조 표시됨
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `void` | - |

---

### `clearHighlight()`

모든 하이라이트를 해제합니다.

#### 파라미터

없음

#### 예제

```javascript
viewer.clearHighlight();
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `void` | - |

---

## 이벤트

### `on(event, callback)`

이벤트 리스너를 등록합니다.

#### 이벤트 목록

| 이벤트 | 콜백 데이터 | 설명 |
|--------|-------------|------|
| `load:complete` | `void` | 데이터 로드 완료 |
| `load:error` | `Error` | 데이터 로드 실패 |
| `load:progress` | `number` | 로드 진행률 (0-100) |
| `floor:change` | `FloorInfo` | 층 변경 |
| `floor:load` | `FloorInfo` | 층 로드 완료 |
| `poi:click` | `POIInfo` | POI 클릭 |
| `element:click` | `ElementInfo` | 요소 클릭 |
| `click` | `MapClickEvent` | 지도 클릭 |
| `zoom:change` | `number` | 줌 레벨 변경 |
| `pan` | `Position` | 지도 이동 |

#### 예제

```javascript
// 층 변경 이벤트
viewer.on('floor:change', (floorInfo) => {
  console.log('층 변경:', floorInfo.name);
  // 층 변경: 2층
});

// POI 클릭 이벤트
viewer.on('poi:click', (poiInfo) => {
  console.log('POI 클릭:', poiInfo.name);
  // POI 클릭: 스타벅스

  // 팝업 표시
  showPopup(poiInfo.name, poiInfo.properties.description);
});

// 로드 완료 이벤트
viewer.on('load:complete', () => {
  console.log('지도 로드 완료');
});
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `void` | - |

---

### `off(event, callback?)`

이벤트 리스너를 제거합니다.

#### 파라미터

| 이름 | 타입 | 필수 | 설명 |
|------|------|------|------|
| `event` | `string` | O | 이벤트 이름 |
| `callback` | `Function` | X | 제거할 콜백 (없으면 모든 리스너 제거) |

#### 예제

```javascript
viewer.off('floor:change', myCallback);
viewer.off('poi:click'); // 모든 poi:click 리스너 제거
```

#### 반환값

| 타입 | 설명 |
|------|------|
| `void` | - |

---

## 기타 메서드

### `resize()`

컨테이너 크기 변경 시 뷰어를 리사이즈합니다.

#### 예제

```javascript
window.addEventListener('resize', () => {
  viewer.resize();
});
```

---

### `destroy()`

뷰어 인스턴스를 정리하고 리소스를 해제합니다.

#### 예제

```javascript
viewer.destroy();
viewer = null;
```

---

## 타입 정의

### FloorInfo

```typescript
interface FloorInfo {
  id: string;          // 층 ID
  name: string;        // 층 이름 (예: "1층", "B1")
  level: number;       // 층 레벨 (숫자)
  description?: string; // 층 설명 (예: "화장품 & 잡화")
}
```

### POIInfo

```typescript
interface POIInfo {
  id: string;
  name: string;
  category: string;
  floorId: string;
  position: { x: number; y: number };
  properties: Record<string, unknown>;
}
```

### POISearchResult

```typescript
interface POISearchResult extends POIInfo {
  floorName: string;
  floorLevel: number;
  groups: string[];
  searchable: boolean;
  relevanceScore: number;    // 0.0 ~ 1.0
  matchedField: 'name' | 'category' | 'group';
  matchedText: string;
}
```

### MapClickEvent

```typescript
interface MapClickEvent {
  position: { x: number; y: number };
  floorId: string;
  originalEvent: MouseEvent | TouchEvent;
}
```

---

## 사용 예제

### 기본 사용

```javascript
// 1. 뷰어 생성
const viewer = new FloorGuideViewer({
  container: '#map-container',
  mode: '2d',
  interactive: true,
});

// 2. 데이터 로드
await viewer.load('data/building.zip');

// 3. 이벤트 등록
viewer.on('floor:change', (floor) => {
  document.getElementById('floor-name').textContent = floor.name;
  document.getElementById('floor-desc').textContent = floor.description || '';
});

viewer.on('poi:click', (poi) => {
  alert(`${poi.name} 클릭!`);
});

// 4. POI 검색 및 포커스
function searchAndFocus(query) {
  const results = viewer.searchPOI(query);
  if (results.length > 0) {
    const top = results[0];
    viewer.setFloor(top.floorId);
    viewer.focusElement(top.id, { animate: true });
    viewer.highlightPOI(top.id);
  }
}
```

### 층 버튼 동적 생성

```javascript
const floors = viewer.getFloors();
const container = document.getElementById('floor-buttons');

floors.forEach(floor => {
  const btn = document.createElement('button');
  btn.textContent = floor.name;
  btn.onclick = () => viewer.setFloor(floor.id);
  container.appendChild(btn);
});
```
