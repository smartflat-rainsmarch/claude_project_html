/**
 * FloorGuideViewerBridge.js
 * Floor Guide Viewer와 Cocos2d 기반 키오스크 시스템 간의 브릿지 클래스
 *
 * 지도 영역만 오버레이하고, 기존 Cocos2d UI(층버튼, 층별안내 등)는 그대로 유지
 *
 * @version 1.1.0
 * @author Floor Guide Team
 */

(function(global) {
  'use strict';

  // UMD named export 대응: FloorGuideViewer.FloorGuideViewer 형태로 export될 수 있음
  var ViewerClass = null;
  if (typeof FloorGuideViewer !== 'undefined') {
    if (typeof FloorGuideViewer === 'function') {
      ViewerClass = FloorGuideViewer;
    } else if (FloorGuideViewer.FloorGuideViewer) {
      ViewerClass = FloorGuideViewer.FloorGuideViewer;
    } else if (FloorGuideViewer.default) {
      ViewerClass = FloorGuideViewer.default;
    }
  }

  /**
   * FloorGuideViewerBridge 클래스
   * Floor Guide Viewer 인스턴스를 관리하고 기존 키오스크 시스템과 연동
   *
   * 특징:
   * - 지도 영역만 오버레이 (#floor-viewer-container)
   * - 기존 Cocos2d UI(층버튼, 층별안내)는 그대로 유지
   * - MapDialogLayer에서 층 버튼 클릭 시 setFloor() 호출
   */
  class FloorGuideViewerBridge {
    constructor() {
      /** @type {FloorGuideViewer|null} */
      this.viewer = null;

      /** @type {boolean} */
      this.isInitialized = false;

      /** @type {boolean} */
      this.isVisible = false;

      /** @type {Array} 층 목록 */
      this.floors = [];

      /** @type {string|null} 현재 층 ID */
      this.currentFloorId = null;

      /** @type {string} ZIP 파일 경로 */
      this.dataPath = 'data/building.zip';

      // DOM 요소 캐싱 (지도 컨테이너만)
      this.elements = {
        viewerContainer: null,
        loading: null,
        navigateButton: null,
        routeControlButtons: null,
      };

      // 층 이름 → 층 ID 매핑 (Cocos2d 연동용)
      this.floorNameToId = {};

      // 현재 선택된 POI (길찾기용)
      this.selectedPOI = null;
    }

    /**
     * 브릿지 초기화
     * @returns {Promise<boolean>}
     */
    async init() {
      if (this.isInitialized) {
        return true;
      }

      try {
        // DOM 요소 캐싱
        this.elements.viewerContainer = document.getElementById('floor-viewer-container');
        this.elements.loading = document.getElementById('viewer-loading');

        if (!this.elements.viewerContainer) {
          throw new Error('Required DOM element not found: #floor-viewer-container');
        }

        // Floor Guide Viewer 라이브러리 확인
        if (!ViewerClass) {
          throw new Error('FloorGuideViewer library not loaded');
        }

        // Viewer 인스턴스 생성
        this.viewer = new ViewerClass({
          container: this.elements.viewerContainer,
          mode: '2d',
          interactive: true,
          touchEnabled: true,
          showPaths: false,
          showPathShading: false,
        });

        // 팝오버에서 길찾기 버튼 숨김 (별도 길찾기 버튼 오버레이 사용)
        this.viewer.setPopoverOptions({ showNavigateButton: false });

        // 이벤트 리스너 설정
        this._setupEventListeners();

        // 데이터 로드
        await this._loadData();

        this.isInitialized = true;
        console.log('[FloorGuideViewerBridge] Initialized successfully');
        return true;

      } catch (error) {
        console.error('[FloorGuideViewerBridge] Initialization FAILED:', error);
        this._showError('지도 초기화 실패', error.message);
        return false;
      }
    }

    /**
     * 지도 데이터 로드
     * @private
     */
    async _loadData() {
      try {
        this._showLoading(true);

        // ZIP 파일 로드
        await this.viewer.load(this.dataPath);

        // 층 목록 가져오기
        this.floors = this.viewer.getFloors();

        // 층 이름 → ID 매핑 생성 (Cocos2d 층 버튼 연동용)
        this.floorNameToId = {};
        for (const floor of this.floors) {
          // "1층" → floor.id
          this.floorNameToId[floor.name] = floor.id;
          // "1" → floor.id (숫자만으로도 접근 가능)
          this.floorNameToId[String(floor.level)] = floor.id;
          // level 값으로도 접근 가능
          this.floorNameToId['level_' + floor.level] = floor.id;
        }

        // 첫 번째 층(가장 낮은 층) 선택
        if (this.floors.length > 0) {
          // 레벨 기준 정렬 후 첫 번째 층
          const sortedFloors = [...this.floors].sort((a, b) => a.level - b.level);
          const firstFloor = sortedFloors[0];
          this.setFloor(firstFloor.id);
        }

        // ZIP 파일의 POI 데이터로 검색 trie 업데이트
        this._updateSearchTrie();

        this._showLoading(false);

      } catch (error) {
        console.error('[FloorGuideViewerBridge] Data load failed:', error);
        this._showError('데이터 로드 실패', error.message);
        throw error;
      }
    }

    /**
     * ZIP 파일의 POI 데이터로 검색 trie 업데이트
     * 기존 trie, trie_floors 전역 변수를 ZIP 데이터로 교체
     * @private
     */
    _updateSearchTrie() {
      try {
        // 전역 trie 객체가 없으면 스킵
        if (typeof trie === 'undefined' || typeof trie_floors === 'undefined') {
          console.warn('[Search] trie or trie_floors not found');
          return;
        }

        // 모든 POI 가져오기
        const allPOIs = this.viewer.getPOIs ? this.viewer.getPOIs() : [];

        // trie 초기화 (새 인스턴스로 교체)
        if (typeof SuffixTrie !== 'undefined') {
          trie = new SuffixTrie();
        }

        // trie_floors 초기화 (배열이므로 length = 0으로 비움)
        trie_floors.length = 0;

        // POI 데이터를 trie에 추가
        allPOIs.forEach((poi, index) => {
          const name = poi.name || '';
          const floorId = poi.floorId;
          const floor = this.floors.find(f => f.id === floorId);
          const floorName = floor ? floor.name : '';
          const category = poi.category || '';
          const description = poi.properties?.description || '';

          // trie_floors 형식: {idx, name, data, floor}
          // data 형식: "층이름|POI이름|카테고리|설명"
          const dataStr = floorName + '|' + name + '|' + category + '|' + description;
          const trieData = {
            idx: index,
            name: name,
            data: dataStr,
            floor: floorName,
            poiId: poi.id,  // POI ID 추가 (포커스용)
            floorId: floorId  // 층 ID 추가
          };
          trie_floors.push(trieData);
        });

        // trie에 데이터 삽입
        trie_floors.forEach(item => {
          // data 문자열로 검색 가능하게 삽입
          // 결과 형식: "idx|name|floor"
          trie.insert(item.data, item.idx + '|' + item.name + '|' + item.floor);
        });

        // 검색 기능 확인용 로그
        console.log('[Search] Trie updated: ' + trie_floors.length + ' POIs indexed');
        if (trie_floors.length > 0) {
          console.log('[Search] Sample POIs:', trie_floors.slice(0, 3).map(p => p.name));
        }

      } catch (error) {
        console.error('[Search] Failed to update trie:', error);
      }
    }

    /**
     * 이벤트 리스너 설정
     * @private
     */
    _setupEventListeners() {
      // 층 변경 이벤트
      this.viewer.on('floor:change', (floorInfo) => {
        this.currentFloorId = floorInfo.id;
      });

      // POI 클릭 이벤트
      this.viewer.on('poi:click', (poiInfo) => {
        this._handlePOIClick(poiInfo);
      });

      // 빈 공간 클릭 이벤트 (길찾기 버튼 숨기기)
      this.viewer.on('click', () => {
        // element:click 이벤트가 발생하지 않으면 빈 공간 클릭
        // 약간의 딜레이 후 체크 (element:click이 먼저 발생하도록)
        setTimeout(() => {
          if (!this._poiClickedRecently) {
            this._hideNavigateButton();
            this.selectedPOI = null;
            this.viewer.clearHighlight();
          }
          this._poiClickedRecently = false;
        }, 50);
      });

      // 로드 완료
      this.viewer.on('load:complete', () => {});

      // 경로 애니메이션 완료 이벤트
      this.viewer.on('route:animation:complete', () => {
        console.log('[Route] Animation completed');
        this._showRouteControlButtons();
      });
    }

    /**
     * POI 클릭 처리 - POI 선택 및 하이라이트, 길찾기 버튼 표시
     * @private
     */
    _handlePOIClick(poiInfo) {
      if (!poiInfo || !poiInfo.id) return;

      // POI 클릭 플래그 설정 (빈 공간 클릭과 구분)
      this._poiClickedRecently = true;

      // 기존 하이라이트 해제 후 새 POI 하이라이트 (카메라 이동 없음)
      this.viewer.clearHighlight();
      this.viewer.highlightPOI(poiInfo.id, { animate: false });

      // 선택된 POI 저장 및 길찾기 버튼 표시
      this.selectedPOI = poiInfo;
      this._showNavigateButton();

      console.log('[POI] Selected:', poiInfo.name);
    }

    /**
     * 지도 뷰어 표시
     */
    show() {
      if (!this.isInitialized) {
        return;
      }

      if (this.elements.viewerContainer) {
        // 캔버스 위치 기준으로 컨테이너 위치 조정
        this._updateContainerPosition();

        this.elements.viewerContainer.classList.add('visible');
        this.isVisible = true;

        // 리사이즈 (컨테이너 크기에 맞게 지도 확대)
        const self = this;
        setTimeout(() => {
          if (self.viewer) {
            self.viewer.resize();
            self.viewer.fitBounds();
          }
        }, 100);

        setTimeout(() => {
          if (self.viewer) {
            self.viewer.resize();
            self.viewer.fitBounds();
          }
        }, 300);
      }
    }

    /**
     * 캔버스 위치 기준으로 컨테이너 위치/크기 동적 조정
     * @private
     */
    _updateContainerPosition() {
      const canvas = document.getElementById('gameCanvas');
      if (!canvas || !this.elements.viewerContainer) return;

      const canvasRect = canvas.getBoundingClientRect();

      // 게임 캔버스 원본 크기
      const CANVAS_WIDTH = 1080;
      const CANVAS_HEIGHT = 1920;

      // 스케일 계산
      const scaleX = canvasRect.width / CANVAS_WIDTH;
      const scaleY = canvasRect.height / CANVAS_HEIGHT;

      // Cocos2d 좌표계 기준 지도 영역 (gamedata.json 참조)
      // 지도 이미지 중심: x=666, y=900
      // 지도 영역: 좌측 층버튼(x=152, 너비 220) 오른쪽부터 화면 끝까지
      // 상단: 검색창(y=200) + 층별안내(y=410) 아래부터
      // 하단: 마이크 버튼 위까지
      const MAP_LEFT = 270;  // 층버튼 영역 오른쪽
      const MAP_TOP = 450;   // 층별안내 + 층이름 아래 (Cocos2d 좌표로 1920 - 450 = 1470)
      const MAP_WIDTH = 810; // 1080 - 270 = 810
      const MAP_HEIGHT = 1100; // 지도 영역 높이

      // 스케일 적용 및 캔버스 오프셋 추가
      const containerLeft = canvasRect.left + MAP_LEFT * scaleX;
      const containerTop = canvasRect.top + MAP_TOP * scaleY;
      const containerWidth = MAP_WIDTH * scaleX;
      const containerHeight = MAP_HEIGHT * scaleY;

      // 스타일 적용
      this.elements.viewerContainer.style.left = containerLeft + 'px';
      this.elements.viewerContainer.style.top = containerTop + 'px';
      this.elements.viewerContainer.style.width = containerWidth + 'px';
      this.elements.viewerContainer.style.height = containerHeight + 'px';
    }

    /**
     * 지도 뷰어 숨기기
     */
    hide() {
      if (this.elements.viewerContainer) {
        this.elements.viewerContainer.classList.remove('visible');
        this.isVisible = false;
      }

      if (this.viewer) {
        this.viewer.clearHighlight();
      }
    }

    /**
     * 층 변경 (Cocos2d 층 버튼에서 호출)
     * @param {string|number} floorIdentifier - 층 ID, 층 이름("1층"), 또는 레벨(1, 2)
     */
    setFloor(floorIdentifier) {
      if (!this.viewer) {
        console.warn('[FloorGuideViewerBridge] Viewer not ready');
        return;
      }

      let floorId = floorIdentifier;

      // 층 이름이나 레벨로 전달된 경우 ID로 변환
      if (typeof floorIdentifier === 'number') {
        floorId = this.floorNameToId['level_' + floorIdentifier] || this.floorNameToId[String(floorIdentifier)];
      } else if (typeof floorIdentifier === 'string' && !floorIdentifier.includes('-')) {
        // UUID 형태가 아니면 매핑에서 찾기
        floorId = this.floorNameToId[floorIdentifier] || floorIdentifier;
      }

      if (floorId) {
        this.viewer.setFloor(floorId);
        this.currentFloorId = floorId;
      }
    }

    /**
     * POI 검색 및 포커스
     * @param {string} query 검색어
     * @returns {Array} 검색 결과
     */
    search(query) {
      if (!this.viewer || !query) return [];

      try {
        const results = this.viewer.searchPOI(query);

        if (results.length > 0) {
          const topResult = results[0];

          // 해당 층으로 이동
          if (topResult.floorId !== this.currentFloorId) {
            this.setFloor(topResult.floorId);
          }

          // POI 포커스 및 하이라이트
          setTimeout(() => {
            this.viewer.focusElement(topResult.id, { animate: true });
            this.viewer.highlightPOI(topResult.id);
          }, 300);
        }

        // 검색 기능 확인용 로그
        console.log('[Search] Query "' + query + '" → ' + results.length + ' results');

        return results;

      } catch (error) {
        console.error('[Search] Error:', error);
        return [];
      }
    }

    /**
     * POI 포커스 (검색 결과 클릭 시 호출)
     * @param {string} poiId - POI ID
     * @param {string} floorId - 층 ID
     * @param {Object} poiInfo - POI 정보 (선택적)
     */
    focusPOI(poiId, floorId, poiInfo) {
      if (!this.viewer) {
        return;
      }

      // 검색 기능 확인용 로그
      console.log('[Search] Focus POI:', poiId);

      // 해당 층으로 이동
      if (floorId && floorId !== this.currentFloorId) {
        this.setFloor(floorId);

        // Cocos2d 층 버튼 상태 업데이트
        this._updateCocosFloorButton(floorId);
      }

      // POI 하이라이트만 적용 (카메라 이동 없음)
      setTimeout(() => {
        if (this.viewer) {
          this.viewer.clearHighlight();
          // focusElement 제거 - 카메라 이동하지 않음
          this.viewer.highlightPOI(poiId, { animate: false });
        }
      }, 300);

      // 선택된 POI 저장 및 길찾기 버튼 표시
      // poiInfo가 trieItem 형식일 수 있음 (poiId vs id)
      if (poiInfo) {
        this.selectedPOI = {
          id: poiInfo.id || poiInfo.poiId,
          floorId: poiInfo.floorId,
          name: poiInfo.name
        };
      } else {
        this.selectedPOI = { id: poiId, floorId: floorId };
      }
      this._showNavigateButton();
    }

    /**
     * 길찾기 버튼 오버레이 표시
     * @private
     */
    _showNavigateButton() {
      // 기존 버튼이 있으면 제거
      this._hideNavigateButton();

      // 버튼 컨테이너 생성
      const btn = document.createElement('div');
      btn.id = 'navigate-button-overlay';
      btn.innerHTML = `
        <button id="btn-navigate-to-poi">
          <span class="text">길찾기</span>
        </button>
      `;

      // 스타일 적용
      btn.style.cssText = `
        position: absolute;
        right: 20px;
        bottom: 20px;
        z-index: 10000;
      `;

      const buttonStyle = `
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 14px 24px;
        background: linear-gradient(135deg, #1a237e 0%, #3949ab 100%);
        color: white;
        border: none;
        border-radius: 30px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4);
        transition: all 0.2s ease;
      `;

      // 버튼 요소에 스타일 적용
      setTimeout(() => {
        const button = btn.querySelector('#btn-navigate-to-poi');
        if (button) {
          button.style.cssText = buttonStyle;

          // 호버 효과
          button.addEventListener('mouseenter', () => {
            button.style.transform = 'scale(1.05)';
            button.style.boxShadow = '0 6px 20px rgba(26, 35, 126, 0.5)';
          });
          button.addEventListener('mouseleave', () => {
            button.style.transform = 'scale(1)';
            button.style.boxShadow = '0 4px 15px rgba(26, 35, 126, 0.4)';
          });

          // 클릭 이벤트
          button.addEventListener('click', () => {
            this._navigateToSelectedPOI();
          });
        }
      }, 0);

      // 뷰어 컨테이너에 추가
      if (this.elements.viewerContainer) {
        this.elements.viewerContainer.appendChild(btn);
        this.elements.navigateButton = btn;
      }
    }

    /**
     * 길찾기 버튼 숨기기
     * @private
     */
    _hideNavigateButton() {
      if (this.elements.navigateButton) {
        this.elements.navigateButton.remove();
        this.elements.navigateButton = null;
      }
      // ID로 직접 찾아서 제거 (혹시 캐시되지 않은 경우)
      const existing = document.getElementById('navigate-button-overlay');
      if (existing) {
        existing.remove();
      }
    }

    /**
     * 경로 컨트롤 버튼 표시 (재생, 종료)
     * @private
     */
    _showRouteControlButtons() {
      // 기존 버튼이 있으면 제거
      this._hideRouteControlButtons();

      // 버튼 컨테이너 생성
      const container = document.createElement('div');
      container.id = 'route-control-buttons';
      container.innerHTML = `
        <button id="btn-route-replay">
          <span class="text">재생</span>
        </button>
        <button id="btn-route-close">
          <span class="text">종료</span>
        </button>
      `;

      // 컨테이너 스타일
      container.style.cssText = `
        position: absolute;
        right: 20px;
        bottom: 20px;
        z-index: 10000;
        display: flex;
        gap: 12px;
      `;

      const baseButtonStyle = `
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 14px 24px;
        color: white;
        border: none;
        border-radius: 30px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.2s ease;
        min-width: 100px;
      `;

      const replayButtonStyle = baseButtonStyle + `
        background: linear-gradient(135deg, #1a237e 0%, #3949ab 100%);
        box-shadow: 0 4px 15px rgba(26, 35, 126, 0.4);
      `;

      const closeButtonStyle = baseButtonStyle + `
        background: linear-gradient(135deg, #c62828 0%, #e53935 100%);
        box-shadow: 0 4px 15px rgba(198, 40, 40, 0.4);
      `;

      // 버튼 요소에 스타일 및 이벤트 적용
      setTimeout(() => {
        const replayBtn = container.querySelector('#btn-route-replay');
        const closeBtn = container.querySelector('#btn-route-close');

        if (replayBtn) {
          replayBtn.style.cssText = replayButtonStyle;

          // 호버 효과
          replayBtn.addEventListener('mouseenter', () => {
            replayBtn.style.transform = 'scale(1.05)';
            replayBtn.style.boxShadow = '0 6px 20px rgba(26, 35, 126, 0.5)';
          });
          replayBtn.addEventListener('mouseleave', () => {
            replayBtn.style.transform = 'scale(1)';
            replayBtn.style.boxShadow = '0 4px 15px rgba(26, 35, 126, 0.4)';
          });

          // 클릭 이벤트 - 애니메이션 다시 재생
          replayBtn.addEventListener('click', () => {
            console.log('[Route] Replay animation');
            this._hideRouteControlButtons();
            if (this.viewer) {
              this.viewer.startRouteAnimation();
            }
          });
        }

        if (closeBtn) {
          closeBtn.style.cssText = closeButtonStyle;

          // 호버 효과
          closeBtn.addEventListener('mouseenter', () => {
            closeBtn.style.transform = 'scale(1.05)';
            closeBtn.style.boxShadow = '0 6px 20px rgba(198, 40, 40, 0.5)';
          });
          closeBtn.addEventListener('mouseleave', () => {
            closeBtn.style.transform = 'scale(1)';
            closeBtn.style.boxShadow = '0 4px 15px rgba(198, 40, 40, 0.4)';
          });

          // 클릭 이벤트 - 경로 제거 및 초기화
          closeBtn.addEventListener('click', () => {
            console.log('[Route] Close and clear route');
            this._hideRouteControlButtons();
            if (this.viewer) {
              this.viewer.hideRoute();
              this.viewer.clearHighlight();
            }
          });
        }
      }, 0);

      // 뷰어 컨테이너에 추가
      if (this.elements.viewerContainer) {
        this.elements.viewerContainer.appendChild(container);
        this.elements.routeControlButtons = container;
      }
    }

    /**
     * 경로 컨트롤 버튼 숨기기
     * @private
     */
    _hideRouteControlButtons() {
      if (this.elements.routeControlButtons) {
        this.elements.routeControlButtons.remove();
        this.elements.routeControlButtons = null;
      }
      // ID로 직접 찾아서 제거
      const existing = document.getElementById('route-control-buttons');
      if (existing) {
        existing.remove();
      }
    }

    /**
     * 선택된 POI로 길찾기 실행
     * @private
     */
    async _navigateToSelectedPOI() {
      if (!this.viewer || !this.selectedPOI) {
        console.warn('[Navigate] No POI selected');
        return;
      }

      const currentLocation = this.viewer.getCurrentLocation();
      if (!currentLocation) {
        console.warn('[Navigate] No current location set');
        alert('현재 위치가 설정되지 않았습니다.');
        return;
      }

      console.log('[Navigate] Starting navigation to:', this.selectedPOI);

      try {
        // 길찾기 실행
        const route = await this.viewer.navigate({
          from: { type: 'current' },
          to: { type: 'poi', id: this.selectedPOI.id },
        });

        if (route) {
          console.log('[Navigate] Route found:', route);
          // 경로 애니메이션 시작
          this.viewer.startRouteAnimation();
          // 길찾기 버튼 숨기기
          this._hideNavigateButton();
          this.selectedPOI = null;
        }
      } catch (error) {
        console.error('[Navigate] Error:', error);
        alert('경로를 찾을 수 없습니다.');
      }
    }

    /**
     * Cocos2d 층 버튼 상태 업데이트
     * @private
     */
    _updateCocosFloorButton(floorId) {
      // 층 정보로 tab 인덱스 찾기
      const floor = this.floors.find(f => f.id === floorId);
      if (!floor) return;

      // LogoScene의 now_floor 업데이트 및 버튼 상태 변경
      if (typeof cc !== 'undefined' && cc.director) {
        const scene = cc.director.getRunningScene();
        if (scene && scene.getChildByTag) {
          const logoLayer = scene.getChildByTag(100); // LogoLayer tag
          if (logoLayer && logoLayer.now_floor !== undefined) {
            // 층 레벨로 tab 인덱스 계산
            const sortedFloors = [...this.floors].sort((a, b) => a.level - b.level);
            const tabIndex = sortedFloors.findIndex(f => f.id === floorId);
            if (tabIndex >= 0) {
              logoLayer.now_floor = tabIndex;
              if (logoLayer.updateFloorBtns) {
                logoLayer.updateFloorBtns();
              }
            }
          }
        }
      }
    }

    /**
     * 층 목록 조회
     * @returns {Array}
     */
    getFloors() {
      return this.floors;
    }

    /**
     * 현재 층 조회
     * @returns {Object|null}
     */
    getCurrentFloor() {
      if (!this.viewer) return null;
      return this.viewer.getCurrentFloor();
    }

    /**
     * 층 레벨로 층 정보 조회 (Cocos2d 연동용)
     * @param {number} level - 층 레벨 (1, 2, -1 등)
     * @returns {Object|null} { id, name, level, description }
     */
    getFloorByLevel(level) {
      const floor = this.floors.find(f => f.level === level);
      if (floor) {
        return {
          id: floor.id,
          name: floor.name,
          level: floor.level,
          description: floor.description || ''
        };
      }
      return null;
    }

    /**
     * 층 tab 인덱스로 층 정보 조회 (Cocos2d 연동용)
     * gamedata.json의 tab 값(0, 1, 2)을 층 레벨로 매핑
     * @param {number} tabIndex - Cocos2d 층 버튼의 tab 인덱스
     * @returns {Object|null} { id, name, level, description }
     */
getFloorByTabIndex(tabIndex) {
      // tab 인덱스를 레벨로 매핑 (정렬된 순서 기준)
      // tab 0 = 가장 낮은 층, tab 1 = 그 다음 층...
      const sortedFloors = [...this.floors].sort((a, b) => a.level - b.level);
      if (tabIndex >= 0 && tabIndex < sortedFloors.length) {
        const floor = sortedFloors[tabIndex];
        return {
          id: floor.id,
          name: floor.name,
          level: floor.level,
          description: floor.description || ''
        };
      }
      return null;
    }

    /**
     * 층 이름으로 층 정보 조회 (Cocos2d 연동용)
     * @param {string} name - 층 이름 ("1층", "2층", "B1" 등)
     * @returns {Object|null} { id, name, level, description }
     */
    getFloorByName(name) {
      // 정확히 일치하는 층 찾기
      let floor = this.floors.find(f => f.name === name);

      // 없으면 부분 일치 시도 (예: "1층" vs "1F")
      if (!floor) {
        const normalizedName = name.toLowerCase().replace(/층|f/gi, '');
        floor = this.floors.find(f => {
          const floorNormalized = f.name.toLowerCase().replace(/층|f/gi, '');
          return floorNormalized === normalizedName;
        });
      }

      if (floor) {
        return {
          id: floor.id,
          name: floor.name,
          level: floor.level,
          description: floor.description || ''
        };
      }
      return null;
    }

    /**
     * 로딩 표시
     * @private
     */
    _showLoading(show) {
      if (this.elements.loading) {
        this.elements.loading.style.display = show ? 'flex' : 'none';
      }
    }

    /**
     * 에러 표시
     * @private
     */
    _showError(title, message) {
      console.error('[FloorGuideViewerBridge] Error:', title, message);
      this._showLoading(false);

      if (this.elements.viewerContainer) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'viewer-error';
        errorDiv.innerHTML = `
          <div class="viewer-error-title">${title}</div>
          <div class="viewer-error-message">${message}</div>
        `;
        this.elements.viewerContainer.appendChild(errorDiv);
      }
    }

    /**
     * 리소스 정리
     */
    destroy() {
      if (this.viewer) {
        this.viewer.destroy();
        this.viewer = null;
      }
      this.isInitialized = false;
      this.isVisible = false;
    }
  }

  // 글로벌 인스턴스 생성
  global.floorViewerBridge = new FloorGuideViewerBridge();

  // 페이지 로드 시 자동 초기화 (표시는 LogoScene에서 show() 호출 시)
  // Cocos2d 로딩 완료 후 초기화하기 위해 지연
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', autoInit);
  } else {
    setTimeout(autoInit, 100);
  }

  async function autoInit() {
    await global.floorViewerBridge.init();
  }

})(window);
