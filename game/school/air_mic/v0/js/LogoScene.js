var l_tag = {
//    btn0: 0, //학교소개
//    btn1: 1, //교육활동
//    btn2 : 2, //알림마당
//    btn3 : 3,//열린마당
//    btn4 : 4, //학교안내도
//    name : 5, //학교이름
//    title : 6, //타이틀
//    logo : 7, //로고
    
};
var notice_datas = [];
var txtguide_bg = null;
var LogoLayer = cc.Layer.extend({
    sprite:null,
    hand0:null,
    hand1:null,
    handcnt:0,
    wtime: 0,
    before_time: 0,
    homepage_data : null,
     _inactivityTimer : null,
    homedatas : [],
    maindatas : [],
    contentdatas : [],
    ani_datas:[], //애니메이션 
    update_datas:[], // 업데이트해야하는 sp
    sp_md : null,
    sp_hhmm: null,
    sp_weekday :null,
    sp_noticelist:[],
    
    isShowMd : false,
    MAX_LEN : 37,
    webview : null,
    obj_weather : null,
    obj_air : null,
    noticeboard_event : null,
    now_contentdata : null,
    indicator_on : [],
    input_search : null,
    sp_searcharea : null,
    all_id_sps : [],
    floor_btns : [],
    floor_map_images : [],
    now_floor : 1,
    sp_floor_title:null,
    sp_floor_subtitle:null,
    sp_floor_txtguide_bg:null,
    ctor:function () {
        //////////////////////////////
        // 1. super init first
        this._super();
        //console.log("LogoLayer!!");
        /////////////////////////////
        // 2. add a menu item with "X" image, which is clicked to quit the program
        //    you may modify it.
        // ask the window size
        var self = this;
         NOW_SELF = this;
        var size = cc.winSize;
        
        C_CheckGPioSpeak(self);
        
        //배경색
//        this.addChild(new cc.LayerColor.create(cc.color(255, 255, 255, 255)));
       
        console.log("getgamedata ",getgamedata);
        self.homepage_data = getgamedata;
        self.contentdatas = self.homepage_data.hm_content_data || [];
        self.homedatas = self.homepage_data.hm_home_data;
        console.log("logo self.homedatas ",self.homedatas);
        self.indicator_on = [];
        self.all_id_sps = [];
        self.floor_btns = [];
        self.floor_map_images = [];
        self.now_contentdata = self.contentdatas[0];
        checkFirstScene(self.contentdatas);
       
        l_tag = {};
        self.sp_noticelist = [];
        for(var i = 0 ; i < self.homedatas.length;i++){
            l_tag[self.homedatas[i].id] = i;
        }
        for(var i = 0 ; i < self.homedatas.length;i++){
            if(self.homedatas[i].type == "animation"){
                var ani_sps = C_setUI(self,size,self.homedatas[i]);
                self.ani_datas.push({"id":self.homedatas[i].id, "anitime":self.homedatas[i].anitime, "nowindex":0, "ani_sps":ani_sps});
            }
            else if(self.homedatas[i].type == "weatherapi"){ //날씨 
                 var wsp = C_setUI(self,size,self.homedatas[i]);
                self.obj_weather = {"data":self.homedatas[i],"sp":wsp};
            }
            else if(self.homedatas[i].type == "airapi"){ // 미세먼지
                 var asp = C_setUI(self,size,self.homedatas[i]);
                self.obj_air = {"data":self.homedatas[i],"sp":asp};
            }
            else if(self.homedatas[i].event && self.homedatas[i].event.page && self.homedatas[i].event.page == "popup_board"){ // 게시판팝업이다
                 C_setUI(self,size,self.homedatas[i]);
                self.noticeboard_event = self.homedatas[i].event;
            }
            else if(self.homedatas[i].texttype && self.homedatas[i].texttype == "m/d"){ //  월/일
                self.sp_md = C_setUI(self,size,self.homedatas[i]);                    
            }
            else if(self.homedatas[i].texttype && self.homedatas[i].texttype == "hh:mm"){ //시:분
                self.sp_hhmm = C_setUI(self,size,self.homedatas[i]);                    
            }
            else if(self.homedatas[i].texttype && self.homedatas[i].texttype == "weekday"){ // 요일
                self.sp_weekday = C_setUI(self,size,self.homedatas[i]);                    
            }                    
            
            else  if(self.homedatas[i].texttype && self.homedatas[i].texttype == "text_notice"){ //공지사항
                var sp_notice = C_setUI(self,size,self.homedatas[i]);
                self.isShowMd = self.homedatas[i].showdateposition ? self.homedatas[i].showdateposition : "";
                self.sp_noticelist.push(sp_notice);
            }
            else {
                var sp = C_setUI(self,size,self.homedatas[i]);
                
                if(self.homedatas[i].id.indexOf("home_floorbtn") >= 0){
                    self.floor_btns.push({"sp":sp,"data":self.homedatas[i]});
                }
                else if(self.homedatas[i].id.indexOf("home_floormap") >= 0){
                    self.floor_map_images.push({"sp":sp,"data":self.homedatas[i]});
                }
                else if(self.homedatas[i].id == "home_floor_title"){
                    self.sp_floor_title = sp;
                }
                else if(self.homedatas[i].id == "home_floor_subtitle"){
                    self.sp_floor_subtitle = sp;
                }
                else if(self.homedatas[i].id == "home_txtguide_back"){
                    self.sp_floor_txtguide_bg = sp;
                    txtguide_bg = self.sp_floor_txtguide_bg;
                }
                
                
            }
            
            
        }

       
        self.updateFloorBtns();
        this.schedule(this.update);
        console.log("logo scene");

        
         /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
        C_checkSafetyDialogShow(self);
        
//         self.drawPoster();
        
        
        this.input_search = C_addInputBox(this, 500, C_getY(220), 800, 80,"검색사항을 입력하세요",26, function(text){
            
            console.log("text is ",trie.search(text));
            const areaY = -5;
            const gabY = -40;
            var arr = trie.search(text);
            
            self.sp_searcharea.removeAllChildren();
            self.sp_searcharea.height = arr && arr.length == 0 ? 0 : arr.length*45+40;
            self.sp_searcharea.y = areaY-self.sp_searcharea.height;
            
            
            for(var i = 0 ; i < arr.length; i++){
                const marr = arr[i].split('|');
                const idx = parseInt(marr[0]);
                const title = marr[1];
                const floor = marr[2];
                const trieItem = trie_floors[idx];
                const tag = trieItem.data;

                console.log("tag is "+tag, "poiId:", trieItem.poiId, "floorId:", trieItem.floorId);
                var x = 50;
                var y = gabY+self.sp_searcharea.height -i*45;

                // 클로저로 poiId, floorId, poiInfo 캡처
                (function(poiId, floorId, tagData, poiInfo) {
                    C_AddCustomFontNew(self.sp_searcharea, title+"("+floor+")", parseInt(x), parseInt(y), tagData, 1, cc.TEXT_ALIGNMENT_LEFT ,34,cc.color(0,0,0),false,function(_tag){
                        console.log("Search result clicked, tag:", _tag, "poiId:", poiId, "floorId:", floorId);

                        // FloorGuideViewer에서 POI 포커스
                        if (window.floorViewerBridge && window.floorViewerBridge.isInitialized && poiId && floorId) {
                            // 검색 영역 숨기기
                            self.sp_searcharea.removeAllChildren();
                            self.sp_searcharea.height = 0;

                            // 해당 층으로 이동 후 POI 포커스 (poiInfo 전달하여 길찾기 버튼 표시)
                            window.floorViewerBridge.focusPOI(poiId, floorId, poiInfo);
                        } else {
                            // 폴백: 기존 방식
                            var event = {"tab":4,"sub":0, "data":_tag};
                            C_nextScene(SCENE_MENU,event);
                        }
                    });
                })(trieItem.poiId, trieItem.floorId, tag, trieItem);
            }
                
            
        });
        this.sp_searcharea = new cc.LayerColor(cc.color(250, 250, 250, 240));
        this.sp_searcharea.width = 800;
        self.sp_searcharea.height = 0;
        this.input_search.addChild(this.sp_searcharea, 0);
        
//        this.sp_searcharea = C_AddSprite(this.input_search, res.empty,0,0);
      
        
        window.floorViewerBridge.viewer.on('floor:change', (floorInfo) => {
          console.log("층바뀜 floorInfo ",floorInfo);
            self.onChangeFloorInfo(floorInfo);
        });
        
        window.floorViewerBridge.viewer.on('poi:click', (floorInfo) => {
            console.log("클릭 floorInfo ",floorInfo);
            self.sp_floor_txtguide_bg.removeAllChildren();
        });
        //빈공간 클릭
        window.floorViewerBridge.viewer.on('click', () => {
            console.log("빈공간클릭 ");
        });
        
        window.floorViewerBridge.viewer.on('route:animation:complete', () => {
             console.log("길찾기애니메이션종료 ");        
        });
        
        window.floorViewerBridge.on('navigate:click', (data) => {
          console.log('길찾기 버튼 클릭됨:', data);
          // poi.id, poi.name, poi.floorId 등 POI 정보 사용 가능
            C_floorNavigate(data.poi.id);
        });
        
        
        ///////////////////
        //test
        ///////////////////
//        setTimeout(function(){
////            var data = window.floorViewerBridge.viewer.getPOIById("25a8f54e-a3c6-42d8-a3ef-cc423d9eb643");
//            //var info = window.floorViewerBridge.viewer.searchPOI("25a8f54e-a3c6-42d8-a3ef-cc423d9eb643"); //poi 정보리턴
////            var info = window.floorViewerBridge.viewer.searchPOI("산부인과"); //poi 정보리턴
//            
//             window.floorViewerBridge.focusPOI("25a8f54e-a3c6-42d8-a3ef-cc423d9eb643", "1fb1d625-57f4-4e67-94a7-1e21685f67e2", {
//                  "id": "25a8f54e-a3c6-42d8-a3ef-cc423d9eb643",
//                  "type": "POI",
//                  "points": [
//                    550,
//                    630
//                  ],
//                  "properties": {
//                    "name": "산부인과",
//                    "description": "산부인과\n운영시간 : 9:00 ~ 18:00",
//                    "markerShape": "circle",
//                    "customIconId": "md/MdOutlineLocalHospital",
//                    "customIconName": "응급",
//                    "customIconColor": "#ffffff"
//                  },
//                  "style": {
//                    "fill": "#f59e0b",
//                    "stroke": "#f59e0b",
//                    "strokeWidth": 2
//                  },
//                  "renderMode": "full"
//                });
//            
//            
//                window.floorViewerBridge.viewer.navigate({
//                      from: { type: 'current' },
//                      to: { type: 'poi', id: "25a8f54e-a3c6-42d8-a3ef-cc423d9eb643" }
//                    }).then(function(route) {
//                      if (route) {
//                        // 6. 경로 애니메이션 시작
//                         window.floorViewerBridge.viewer.startRouteAnimation();
//
//                          // 상세 경로 안내 정보 조회
//                          var detailedResult = window.floorViewerBridge.viewer.getDetailedRouteInstructions(
//                            route,
//                            '현재 위치',
//                            '목적지'
//                          );
//
//                          // 요약 정보 출력
//                          console.log('총 거리:', detailedResult.summary.totalDistance);
//                          console.log('예상 시간:', detailedResult.summary.totalTime);
//                          console.log('층간 이동:', detailedResult.summary.floorChanges);
//
//                          var txt_distance = '총 거리:'+detailedResult.summary.totalDistance;
//                          var txt_time = detailedResult.summary.totalTime ? '예상 시간:'+detailedResult.summary.totalTime : "예상 시간:";
//                          var txt_move = '층간 이동:'+detailedResult.summary.floorChanges+"층 이동";
//                          var data_guide = [];
//                          // 단계별 안내 출력
//                          console.log("detailedResult.instructions .",detailedResult.instructions.length);
//                          for(var i = 0 ; i < detailedResult.instructions.length;i++){
//                              var inst = detailedResult.instructions[i];
//                              // 아이콘 SVG 생성
//                                var iconSvg;
//                                if (inst.turnInfo) {
//                                  // 방법 B: 회전 화살표 (정확한 각도 반영)
//                                  iconSvg = FloorGuideViewer.renderTurnIconSVG(inst.turnInfo, 24, 1.5);
//                                } else {
//                                  // 방법 A: 기본 아이콘
//                                  var icon = FloorGuideViewer.getRouteActionIcon(inst.action);
//                                  iconSvg = FloorGuideViewer.renderIconSVG(icon, 24, 1.5);
//                                }
//                              data_guide.push({"img":svgToBase64(iconSvg),"txt":inst.description});
//                          }
//                          C_drawTextGuide(self.sp_floor_txtguide_bg, txt_distance,txt_time,txt_move,data_guide);
//
//                      }
//                    }).catch(function(error) {
//                      console.error('경로를 찾을 수 없습니다:', error);
//                    });
//            },1000);
          
       
        return true;
    },
   
   
   
    onChangeFloorInfo : function(now_info){
        var self = this;
        console.log("all floor info ", window.floorViewerBridge.getFloors());
        if(now_info)
        for(var i = 0 ; i < self.floor_btns.length; i++){
            var sp = self.floor_btns[i].sp;
            var data = self.floor_btns[i].data;
            if(now_info.level == i){
                C_ChangeSpriteImage(sp, "res/n_home/mbtn_select.png");
                
                var floorInfo = window.floorViewerBridge.getFloorByName(data.name);
                self.sp_floor_title.string = floorInfo.name;
                self.sp_floor_subtitle.string = floorInfo.description || '';
//                console.log(" data ",data);
            }else {
                C_ChangeSpriteImage(sp, "res/n_home/mbtn.png");
            }
        }
    },
    updateFloorBtns : function(){
        var self = this;
        for(var i = 0 ; i < self.floor_btns.length; i++){
            var sp = self.floor_btns[i].sp;
            var data = self.floor_btns[i].data;
            if(self.now_floor == parseInt(data.event.tab)){
//                console.log("선택 "+self.now_floor);
                C_ChangeSpriteImage(sp, "res/n_home/mbtn_select.png");
                self.updateFloorInfo(data);
                
            }else {
                C_ChangeSpriteImage(sp, "res/n_home/mbtn.png");
            }
        }
        self.updateFloorMageImage();
        
    },
    updateFloorInfo : function(data){
        var self = this;

        // FloorGuideViewerBridge에서 ZIP 파일의 층 정보 가져오기
        // 버튼의 text.KO.message 값 ("1층", "2층", "B1")으로 층 찾기
        if (window.floorViewerBridge && window.floorViewerBridge.isInitialized) {
            var floorName = data.text && data.text.KO ? data.text.KO.message : null;
            if (floorName) {
                var floorInfo = window.floorViewerBridge.getFloorByName(floorName);
                if (floorInfo) {
                    self.sp_floor_title.string = floorInfo.name;
                    self.sp_floor_subtitle.string = floorInfo.description || '';
                    console.log('[LogoScene] Floor info from ZIP:', floorInfo.name, floorInfo.description);
                    return;
                }
            }
        }

        // 폴백: gamedata.json 데이터 사용
//        self.sp_floor_title.string = data.name;
//        self.sp_floor_subtitle.string = data.desc;
    },
    before_floor_image : null,
    updateFloorMageImage : function(){
        var self = this;
        if(self.before_floor_image) {
//            var move = cc.moveTo(0.1, cc.p(1600, self.before_floor_image.y));
//            const onComplete = cc.callFunc(() => { 
//                self.moveInFloorImage();
//
//            });
//            self.before_floor_image.runAction(cc.sequence(move, onComplete));
            self.before_floor_image.setPosition(1600,self.before_floor_image.y);
            self.moveInFloorImage();
        }
        else{
            self.moveInFloorImage();
        }
    },
    moveInFloorImage:function(){
        var self = this;

        // ========== Floor Guide Viewer 사용 ==========
        if (window.floorViewerBridge && window.floorViewerBridge.isInitialized) {
            console.log('[LogoScene] Using Floor Guide Viewer for floor:', self.now_floor);

            // 기존 Cocos2d 지도 이미지 숨기기
            for(var i = 0 ; i < self.floor_map_images.length; i++){
                var sp = self.floor_map_images[i].sp;
                sp.setPosition(1600, sp.y); // 화면 밖으로 이동
            }

            // Floor Guide Viewer 표시 및 층 설정
            window.floorViewerBridge.show();
            window.floorViewerBridge.setFloor(self.now_floor);
            return;
        }

        // ========== 폴백: 기존 Cocos2d 지도 이미지 사용 ==========
        console.log('[LogoScene] Fallback: Using Cocos2d map images');

        for(var i = 0 ; i < self.floor_map_images.length; i++){
            var sp = self.floor_map_images[i].sp;
            var data = self.floor_map_images[i].data;
            sp.setPosition(1600,sp.y);
        }
        for(var i = 0 ; i < self.floor_map_images.length; i++){
            var sp = self.floor_map_images[i].sp;
            var data = self.floor_map_images[i].data;
            console.log(i+") self.now_floor "+self.now_floor+" data.id "+parseInt(data.id));
            if(self.now_floor == getStringInNumber(data.id)){
                self.before_floor_image = sp;
                var move = cc.moveTo(0.2, cc.p(data.x, data.y));
                self.before_floor_image.runAction(move);
                break;
            }
        }
    },
    /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 START
    /////////////////////////////////////////////////////////////////
    imageData: [],
    currentIndex: 0,
    slideSprite: null,
    isSliding: false,
    isPosterScene : true, //포스터 씬일때만 슬라이드 터치가 되도록한다.
    drawPoster: function (){
         var self = this;   
         self.loadImages(1,10,function(res){
            
            
           self.initSwiperLayer(res);
            
            
        });
    },
    initSwiperLayer : function (imageList){
        var self = this;
        this.imageData = imageList;
        this.currentIndex = 0;
//        this.addChild(new cc.LayerColor.create(cc.color(255, 0, 0, 77)));
        if (this.imageData.length === 0) {
            cc.log("이미지 데이터가 없습니다.");
            return true;
        }

        this.showSlide(this.currentIndex, false); // 첫 슬라이드는 애니메이션 없음
        this.startAutoSlide();
        this.addTouchHandlers();
        if(self.now_contentdata.indicator){
            console.log("인디케이터 리셋");
            this.initIndecator(self.now_contentdata.indicator);
        }
    },
    
   
    initIndecator : function(indicator){
        
        var self = this;
        var len = this.imageData.length;
        console.log("this.imageList ",this.imageList);
        var offset = len/2*40;
        var indicator_scale = 1.5;
        for(var i = 0;i < len; i++){            
            C_AddSprite(self,res.indicator_normal, indicator.x-offset+i*20*indicator_scale, C_getY(indicator.y),1,indicator_scale,10);
            this.indicator_on.push(C_AddSprite(self,res.indicator_on, indicator.x-offset+i*20*indicator_scale, C_getY(indicator.y),1,indicator_scale,10));            
        }
        this.updateIndicator();
        
    },
    updateIndicator:function(){
        var self = this;
        for(var i = 0;i < this.indicator_on.length; i++){            
            this.indicator_on[i].setVisible(false);            
        }
       if(this.indicator_on[this.currentIndex])this.indicator_on[this.currentIndex].setVisible(true);
    },
    showSlide: function (index, withAnimation, direction = "left") {
        var self = this;
        if (this.isSliding) return;
//        if(!self.isPosterScene)return;
        this.isSliding = true;

        var imgfoldername = self.now_contentdata.imgfoldername ? self.now_contentdata.imgfoldername : "gallery2";
        const imgPath = "contentdata/"+imgfoldername+"/" + this.imageData[index].filename;
//        const newSlide = new cc.Sprite(imgPath);
        console.log("imgPath is "+imgPath);
        const MX = this.width/2 - (this.width-1080)/2;
        const MY = 960;
        
         cc.loader.loadImg(imgPath, { isCrossOrigin: false }, (err, texture) => {
            if (err) {
                console.error("이미지 로딩 실패:", err);
                this.isSliding = false;
                return;
            }

             const newSlide = new cc.Sprite(imgPath);
            // ✅ 이미지 크기 강제 설정
            newSlide.setTexture(imgPath);
            const textureSize = newSlide.getContentSize();      
//            console.log("textureSize width "+textureSize.width+" height "+textureSize.height);
            const scaleX = 970 / textureSize.width;
            const scaleY = 630 / textureSize.height;
            newSlide.setScaleX(scaleX);
            newSlide.setScaleY(scaleY);
            newSlide.setPosition(MX, MY); // SwiperLayer 기준 아래쪽 중앙


            if (withAnimation) {
                let fromX = direction === "left" ? this.width + MX : -MX;
                console.log("fromX is "+fromX);
                newSlide.setPosition(fromX, MY);
                self.addChild(newSlide, 1);

                const moveToCenter = cc.moveTo(0.4, cc.p(MX, MY));
                const onComplete = cc.callFunc(() => { this.isSliding = false; });

                if (this.slideSprite) {
                    const oldSlide = this.slideSprite;
                    const moveOutX = direction === "left" ? -MX : this.width + MX;
                    const moveOut = cc.moveTo(0.4, cc.p(moveOutX, MY));
                    const removeOld = cc.callFunc(() => oldSlide.removeFromParent());
                    oldSlide.runAction(cc.sequence(moveOut, removeOld));
                }

                newSlide.runAction(cc.sequence(moveToCenter, onComplete));
            } else {
                self.addChild(newSlide);
                self.isSliding = false;
            }

            self.slideSprite = newSlide;
             if(self.now_contentdata.indicator) self.updateIndicator();
         });
    },



    startAutoSlide: function () {
        const self = this;
        
        this.schedule(function () {
            
            self.nextSlide(true);
            
        }, 5);
    },

    nextSlide: function (withAnimation) {
        var self = this;
        if(this.imageData.length <= 1)return;
        
        
        this.currentIndex = (this.currentIndex + 1) % this.imageData.length;
        this.showSlide(this.currentIndex, withAnimation, "left");
        C_checkAutoUpdate();
    },

    prevSlide: function (withAnimation) {
        var self = this;
        if(this.imageData.length <= 1)return;
        
        this.currentIndex = (this.currentIndex - 1 + this.imageData.length) % this.imageData.length;
        this.showSlide(this.currentIndex, withAnimation, "right");
    },

    addTouchHandlers: function () {
        const self = this;
        let startX = 0;
        
        if(self.isPosterScene){
             const listener = cc.EventListener.create({
                event: cc.EventListener.TOUCH_ONE_BY_ONE,
                swallowTouches: true,

                onTouchBegan: function (touch) {
                    startX = touch.getLocation().x;
                    return true;
                },

                onTouchEnded: function (touch) {
                     if(self.imageData.length <= 1)return;    
                    
                    const endX = touch.getLocation().x;
                    const delta = endX - startX;
                    
                    // 👉 자동 슬라이드 리셋
                    self.startAutoSlide();  // 타이머 리셋
                   
                    if (Math.abs(delta) > 50) {
                        if (delta < 0) {
                            self.nextSlide(true); // 왼쪽 슬라이드
                        } else {
                            self.prevSlide(true); // 오른쪽 슬라이드
                        }
                    }
                }
            });

            cc.eventManager.addListener(listener, this);
        }
       
    },  
    startAutoSlide: function () {
        const self = this;

        // 이전 타이머 제거
        if (this.slideTimer) {
            this.unschedule(this.slideTimer);
        }

        // 새로운 슬라이드 함수 정의
        this.slideTimer = function () {
            self.nextSlide(true);
        };

        // 5초마다 자동 슬라이드 시작
        this.schedule(this.slideTimer, 5);
    },
   loadImages: function (page, max, callback) {
        var self = this;
        var res_images = [
            { "filename": "bg0.jpg" },
            { "filename": "bg1.jpg" },
            { "filename": "bg2.jpg" },
            { "filename": "bg3.jpg" },
            { "filename": "bg4.jpg" }
        ];

        var basePath = "contentdata/" + self.now_contentdata.imgfoldername + "/";
        var arr = [];
        var checked = 0;

        function checkImageExists(url, done) {
            const img = new Image();
            img.onload = () => done(true, url);
            img.onerror = () => done(false, url);
            img.src = url;
        }

        res_images.forEach((item, idx) => {
            const fullPath = basePath + item.filename;

            checkImageExists(fullPath, (exists, url) => {
                if (exists) {
                    console.log("✅ exists:", url);
                    arr.push({ "filename": item.filename });
                } else {
                    console.log("❌ not found:", url);
                }

                checked++;
                // 모든 체크가 끝나면 콜백 실행
                if (checked === res_images.length) {
                    callback(arr);
                }
            });
        });
    },
    /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 END
    /////////////////////////////////////////////////////////////////
    
    

    //isShowMd 월/일 을 먼저 표시한다.
    initNoticeList:function(_isShowMd){
        var self = this;
        
        for(var i = 0 ; i < 5; i++){
            
            if(notice_datas.length > i){
                var noticedata = notice_datas[i];

                var notice_date = new Date(noticedata.lt_date);
                var text = "";
                switch(_isShowMd){
                    case "left":
                        text = (notice_date.getMonth()+1)+"/"+notice_date.getDate()+"  "+noticedata.lt_title;
                        break;
                    case "right":
                        text = noticedata.lt_title+"  "+(notice_date.getMonth()+1)+"/"+notice_date.getDate();
                        break;
                    default:
                        text = noticedata.lt_title;
                        break;
                }
                self.sp_noticelist[i].string = C_MaxLen(text, self.MAX_LEN);
            }
        }
        
    },
    gpioTimer: 0,
    update: function (dt) {
         
        var self = this;
        this.wtime += dt;
        var nowtime = Math.floor(this.wtime);
        
         for(var i = 0 ; i < self.ani_datas.length;i++)
            C_updateAnimation(self.ani_datas[i], this.wtime);
        C_updateDateTime(self.sp_md,self.sp_hhmm,self.sp_weekday,this.wtime);
//        C_updateWeatherAir(self.obj_weather, self.obj_air, this.wtime);//날씨 , 미세먼지 업데이트
        
        C_checkAutoUpdate();
        C_checkSafetyData(this.wtime);//재난안전문자

        // 2. 1초마다 C_CheckGPio 호출 로직 추가
        if (!this.gpioTimer) this.gpioTimer = 0; // 변수 미선언 대비 초기화

        this.gpioTimer += dt; // 프레임 간격 시간을 더함
        if (this.gpioTimer >= 1.0) { // 1초(1.0) 이상 쌓였을 때
            C_CheckGPio(self);
            this.gpioTimer -= 1.0; // 1초를 빼서 다음 1초를 다시 계산 (정밀도 유지)
        }
    },
   
   
    updateHand: function(){
        if(this.handcnt%2 == 0){
            this.hand0.setVisible(true);
            this.hand1.setVisible(false);
        }else{
            this.hand0.setVisible(false);
            this.hand1.setVisible(true);
        }
    },
    buttonClick: function(tag){
        var self = this;
        var size = cc.winSize;
        console.log("buttonClick!! ", tag);
        userClickTimestamp = (new Date()).getTime();
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        idleMode = IDLE_OFF;
        this.resetInactivityTimer();
        for(var i = 0 ; i < self.homedatas.length;i++){
            if(tag == self.homedatas[i].id){
                var event = self.homedatas[i].event ? self.homedatas[i].event : null; 
                
                if(event){
                    if(event.page == "home" || event.page == "main"){
                        var scene = event.page == "main" ? SCENE_MENU : SCENE_HOME;
                        var data = event;                    
                        C_nextScene(scene, data);                       
                    }
                    else if(event.page == "findfloor"){
                         var data = event;                    
                        console.log("지도 찾기 ",data);
                        self.now_floor = parseInt(data.tab);
                        self.updateFloorBtns();
                    }
                    else if(event.page == "speak"){
                         C_ShowSpeak();
                    }
                    else if(event.page == "popup"){
                        console.log("팝업을 띄운다", );
                        var index = event.index ? event.index : 0;
                        var title = C_MaxLen(notice_datas[index].lt_title, self.MAX_LEN);
                        var message = C_WrapTextByWidth(notice_datas[index].lt_message, self.MAX_LEN);
                        C_ShowDialogLayer(self, title , message, function(){
                            
                        });
                    }
                    else if(event.page == "popup_board"){
                       
                        
                        C_ShowWebViewDialogLayer(self,"공지사항 목록", self.noticeboard_event, 900,600, function(){

                             console.log("closeMapdialogLayer 111");
                            location.reload();
                        },null,{"bgres": res._global_img_ninepatch_white_bg});   
                    }
                    else if(event.page == "map"){
                        var mapdatas = [];
                        for(var i = 0 ; i < self.contentdatas.length;i++){
                            if(self.contentdatas[i].type == "mapimg")
                                mapdatas.push(self.contentdatas[i]);
                        }

                        C_ShowMapDialogLayer(self,"","",mapdatas, function(){

                             console.log("closeMapdialogLayer 111");
                        },null);   
                    }
                    
                }
                
                break;
            }
        }
    },
    
            
     /////////////////////////////////////////
    // 일정시간 입력없으면 함수호출 START
    /////////////////////////////////////////
    
    onUserInactive: function () {
        cc.log("🔕 60초 동안 아무 입력이 없었습니다.");
        // 여기에 원하는 동작을 넣으세요 (예: 화면 전환, 경고창 등)
        
        if (this._inactivityTimer) {
            this.unschedule(this._inactivityTimer);
        }
         
        if(home_scene != SCENE_HOME){
            
            if(!IS_SHOW_POPUP)gotoHomeScene();
        }else{
             idleMode = IDLE_READY;
         }
        
        C_callSafetyData();
    },

    resetInactivityTimer: function () {
        console.log("시간리셋!!");
        if (this._inactivityTimer) {
            this.unschedule(this._inactivityTimer);
        }

        this._inactivityTimer = this.onUserInactive.bind(this);
        this.scheduleOnce(this._inactivityTimer, 60); // 60초 후 호출
    },

    enableInputTracking: function () {
        var self = this;

        cc.eventManager.addListener({
            event: cc.EventListener.KEYBOARD,
            onKeyPressed: function () {
                self.resetInactivityTimer();
            }
        }, this);

        cc.eventManager.addListener({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: false,
            onTouchBegan: function () {
                self.resetInactivityTimer();
                return false;
            }
        }, this);
    }
    /////////////////////////////////////////
    // 일정시간 입력없으면 함수호출 END
    /////////////////////////////////////////
    
});
var LogoScene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new LogoLayer();
        this.addChild(layer);
    }
});

function complete_media(){
    //console.log("bg sound loaded!!");

}
