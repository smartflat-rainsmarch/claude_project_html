var m_tag = {
};
var g_menuLayer = null;

//var menu_instance = null;
var MenuLayer = cc.Layer.extend({
    _data: null,
    sprite: null,
    youTubePlayer1: null,
    videoIFrame: null,
    continue_video_btn: null,
    _inactivityTimer : null,
    webview : null,
    sp_rect : null,
    pageurl : null,
    homepage_data : null,
    homedatas : [],
    maindatas : [],
    contentdatas : [],
    now_contentdata : null,
    all_id_sps : [],//전체 sprite  //애니메이션 제외
    tab_max : 0,
    sub_maxs : [],
    bg_point : null,
    sp_animation_righttoleft: [],
    sp_animation_scale: [],    
    json_floor : null,
    sp_moves:[],
    
    ctor: function (data) {
        //////////////////////////////
        // 1. super init first
        this._super();
        this._data = data;
        g_menuLayer = this;
        
//        C_PlaySound(SOUND.BGM);
        /////////////////////////////
        // 2. add a menu item with "X" image, which is clicked to quit the program
        //    you may modify it.
        // ask the window size
        var self = this;
        var size = cc.winSize;
        

         console.log("MENU : CTOR");
        C_checkGetHomeData(self,function(){
            self.init();
        });
        return true;
    },
    init:function(){
        var self = this;
        var size = cc.winSize;
        
        console.log("MENU : Init");
        this.removeAllChildren();
        this.addChild(new cc.LayerColor.create(cc.color(255, 255, 255, 255)));
        
        m_tag = {};
        self.sub_maxs = [];
        self.sp_animation_righttoleft = [];
        self.sp_animation_scale = [];
        self.sp_moves = [];
        
        //////////////////////////////////////////////////////////////
        //new module
        //////////////////////////////////////////////////////////////
    
        self.homepage_data = getgamedata;
        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
        self.maindatas = JSON.parse(self.homepage_data.hm_main_data);
        
        
    
        
        this.all_id_sps = [];
        for(var i = 0 ; i < self.maindatas.length;i++){
            m_tag[self.maindatas[i].id] = i;
        }
//        for(var i = 0 ; i < 3;i++){//test
        for(var i = 0 ; i < self.maindatas.length;i++){
            if(self.maindatas[i].type == "animation"){
                var ani_sps = C_setUI(self,size,self.maindatas[i]);
                self.ani_datas.push({"id":self.maindatas[i].id, "anitime":self.maindatas[i].anitime, "nowindex":0, "ani_sps":ani_sps});
            }
            else {
                var _sp = C_setUI(self,size,self.maindatas[i]);
                if(self.maindatas[i].imgurl.indexOf("main_bg.png") >= 0)  //main_bg.png 이미지는 반드시 있어야한다.
                    this.sp_rect = _sp;
                self.all_id_sps.push({"imgurl":C_getResPath(self.maindatas[i].imgurl), "sp":_sp});
                
                //네모 하단 말풍선 포인트
                if(self.maindatas[i].id == "main_mainrect_point")
                    self.bg_point = _sp;
                if(self.maindatas[i].animationtype == "righttoleft")
                    self.sp_animation_righttoleft.push({"x":self.maindatas[i].x,"y":self.maindatas[i].y,"sp":_sp});
                if(self.maindatas[i].animationtype == "scale")
                    self.sp_animation_scale.push({"scale":self.maindatas[i].animationscale,"sp":_sp});     
                
                //갤러리2일때 하단버튼배경을 아래로 이동한다.
                if(self.maindatas[i].movey){
                    var movex = self.maindatas[i].movex ? self.maindatas[i].movex : self.maindatas[i].x;
                    var movey = self.maindatas[i].movey ? self.maindatas[i].movey : self.maindatas[i].y;
                                    
                    self.sp_moves.push({"x":self.maindatas[i].x, "y":self.maindatas[i].y, "movex":movex, "movey":movey, "sp":_sp});
                }
            }           
        }

        //탭 최대 갯수 10개까지 sub_max를 0으로 초기화
        for(var i = 0 ; i < 10;i++){
            self.sub_maxs.push(0);
        }
        //sub 탭 최대갯수를 먼저 구한다.
        for(var i = 0 ; i < self.contentdatas.length; i++){        
            var _tab = self.contentdatas[i].tab ? parseInt(self.contentdatas[i].tab) : -1;
            if(_tab >= 0 && _tab < 10)
                self.sub_maxs[_tab]++;            
        }
        //Tab 갯수를 구한다.
        for(var i = 0 ; i < 10;i++){
            if(self.sub_maxs[i] > 0)
                self.tab_max++;
        }
    
        
        self.initData(self._data);
        
        /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
        
    },
    initData:function(data){
        console.log("initData "+data.tab);
        var self = this;
        var size = cc.winSize;
        
        var _tab = parseInt(data.tab);
        var _sub = parseInt(data.sub);
        
        
//        this.pageurl = "./html/page0_0.html";
//        this.pageurl="https://maecheon.dge.ms.kr/maecheonm/ad/fm/foodmenu/selectFoodMenuView.do";
        
        //갤러리2이라면 버튼들을 이동시킨다.
        if(_tab == 4){
            for(var i = 0 ; i < self.sp_moves.length; i++){

                var movex = self.sp_moves[i].movex;
                var movey = C_getY(self.sp_moves[i].movey);
                var move = cc.moveTo(0.3, movex, movey);
                self.sp_moves[i].sp.runAction(move);
                              
            }
            //플로팅패널을 보여주게 한다.
            window.showFloatingPanel();
        }else 
            window.hideFloatingPanel();
        
        self.now_contentdata = null;
        for(var i = 0 ; i < self.contentdatas.length;i++){
            if(self.contentdatas[i].tab == _tab && self.contentdatas[i].sub == _sub){
                self.now_contentdata = self.contentdatas[i];
                break;
            }
        }

        
        if(self.now_contentdata){
            
            var schoolapitype = self.now_contentdata.schoolapitype ? self.now_contentdata.schoolapitype : "";             
            if(self.now_contentdata.type == "floor" && parseInt(self.now_contentdata.tab) != 4){
                document.getElementById("mWebView").style.display = "none";//예외처리
             
                loadJSON(self.now_contentdata.url, function(err, data) {
                    if (err) {
                        console.error("JSON 로드 실패:", err);
                    } else {
                        self.json_floor = data;
                        self.showFloor();                   
                    }
                });
            }
            else {
                self.pageurl = self.getIFrameUrl(self.now_contentdata.type, self.now_contentdata.id, schoolapitype);
                if(self.pageurl.indexOf("type_gallery2.html") >= 0){
                    self.isPosterScene = true;
                    self.hideWebView();
                    self.drawPoster();
                    
                }                    
                else{
                     self.isPosterScene = false;
                    self.showWebView();       
                   
                }
                    
            }
        }    
        self.updateBGUI(_tab);
    },
    
    /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 START
    /////////////////////////////////////////////////////////////////
    imageData: [],
    currentIndex: 0,
    slideSprite: null,
    isSliding: false,
    isPosterScene : false, //포스터 씬일때만 슬라이드 터치가 되도록한다.
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
    },
    
   
    showSlide: function (index, withAnimation, direction = "left") {
        var self = this;
        if (this.isSliding) return;
        if(!self.isPosterScene)return;
        this.isSliding = true;

        const imgPath = "contentdata/gallery/" + this.imageData[index].filename;
//        const newSlide = new cc.Sprite(imgPath);
        const MY = 1020;
        
        if(parseInt(self.now_contentdata.tab) == 4)
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
            const scaleX = 1080 / textureSize.width;
            const scaleY = 1800 / textureSize.height;
            newSlide.setScaleX(scaleX);
            newSlide.setScaleY(scaleY);
            newSlide.setPosition(this.width / 2, MY); // SwiperLayer 기준 아래쪽 중앙


            if (withAnimation) {
                let fromX = direction === "left" ? this.width + this.width / 2 : -this.width / 2;
                newSlide.setPosition(fromX, MY);
                this.addChild(newSlide, 1);

                const moveToCenter = cc.moveTo(0.4, cc.p(this.width / 2, MY));
                const onComplete = cc.callFunc(() => { this.isSliding = false; });

                if (this.slideSprite) {
                    const oldSlide = this.slideSprite;
                    const moveOutX = direction === "left" ? -this.width / 2 : this.width + this.width / 2;
                    const moveOut = cc.moveTo(0.4, cc.p(moveOutX, MY));
                    const removeOld = cc.callFunc(() => oldSlide.removeFromParent());
                    oldSlide.runAction(cc.sequence(moveOut, removeOld));
                }

                newSlide.runAction(cc.sequence(moveToCenter, onComplete));
            } else {
                this.addChild(newSlide);
                this.isSliding = false;
            }

            this.slideSprite = newSlide;
         });
    },



    startAutoSlide: function () {
        const self = this;
        
        this.schedule(function () {
            if(parseInt(self.now_contentdata.tab) == 4)
            self.nextSlide(true);
            
        }, 5);
    },

    nextSlide: function (withAnimation) {
        var self = this;
        this.currentIndex = (this.currentIndex + 1) % this.imageData.length;
        this.showSlide(this.currentIndex, withAnimation, "left");
        C_checkAutoUpdate();
    },

    prevSlide: function (withAnimation) {
        var self = this;
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
    loadImages :function (page, max, callback){
         var _data = {
            "projectid":param_projectid,
            "groupidx":param_groupidx,
            "page":page,
            "maxcount":max
        }
        AJAX_AdmGetGame("getgallerydata", _data, function(res){
            console.log("이미지로드했다. is ",res);
           code = parseInt(res.code);
           if (code == 100) {

               var getdatas = res.message;
               if(callback)callback(res.message);
           }
        });
    },
    /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 END
    /////////////////////////////////////////////////////////////////
    
    
    
    getIFrameUrl: function(type, id, schoolapitype){
         var self = this;   
         var useschoolapi = self.now_contentdata.useschoolapi ? parseInt(self.now_contentdata.useschoolapi) : 0;

            var fname = "";
            switch(type){
             case "html":
                    fname = "../../../webpage/type_image.html";
                     if(schoolapitype && useschoolapi == 1)
                          fname = "../../../webpage/type_schooldata.html";
                    break;
                case "img":
                    fname = "../../../webpage/type_image.html";
                    break;
                case "board":
                    fname = "../../../webpage/type_board.html";
                    break;
                case "gallery":
                    fname = "../../../webpage/type_gallery.html";
                    break;
                  case "gallery2":
                    fname = "../../../webpage/type_gallery2.html";
                    break;
                case "game":
                    fname = "../../../../"+self.now_contentdata.url;//flappybird
                    break;
                default:
                    fname = "../../../webpage/type_schooldata.html";
                    break;
            }
            return fname;
        

    },
    addWebView: function(parent, x, y, w, h, pageurl) {
//        console.log("addWebView");
         var self = this;
        var size = cc.winSize;
        if (!ccui || !ccui.WebView) {
            cc.log("WebView is not supported in this version of Cocos2d-JS.");
            return;
        }
         var schoolapitype = self.now_contentdata.schoolapitype ? self.now_contentdata.schoolapitype : "";
        var gamemode = self.now_contentdata.gamemode ? self.now_contentdata.gamemode : 0;
        
        var mWebView = document.getElementById("mWebView");
        mWebView.style.width= w+"px";
        mWebView.style.height= h+"px";
        mWebView.style.marginTop = y+"px";
        mWebView.style.marginLeft = x+"px";
        mWebView.src = pageurl+"?projectid="+self.homepage_data.hm_projectid+"&groupidx="+param_groupidx+"&listid="+self.now_contentdata.id+"&apitype="+schoolapitype+"&gamemode="+gamemode;
        mWebView.style.display = "block";
                        
        //iframe 클릭했을때 이벤트 받는다.
        initIframeTouchEvent(self);

    },
//    addWebView_Back: function(parent, x, y, w, h, pageurl) {
////        console.log("addWebView");
//         var self = this;
//        var size = cc.winSize;
//        if (!ccui || !ccui.WebView) {
//            cc.log("WebView is not supported in this version of Cocos2d-JS.");
//            return;
//        }
//        
//        this.webview = new ccui.WebView();
//        this.webview.setContentSize(w, h);
//        this.webview.setAnchorPoint(0.5, 0.5);
//        this.webview.setPosition(x, y);
//        
//        var schoolapitype = self.now_contentdata.schoolapitype ? self.now_contentdata.schoolapitype : "";
//        var gamemode = self.now_contentdata.gamemode ? self.now_contentdata.gamemode : 0;
//        this.webview.loadURL(pageurl+"?projectid="+self.homepage_data.hm_projectid+"&groupidx="+param_groupidx+"&listid="+self.now_contentdata.id+"&apitype="+schoolapitype+"&gamemode="+gamemode);
//        this.webview.setScalesPageToFit(true);
//        this.webview.setVisible(true);
//        this.webview.boderStyle("none");//iframe 테두리 안보이기
//        this.addChild(this.webview, 999);
//                        
//        //iframe 클릭했을때 이벤트 받는다.
//        initIframeTouchEvent(self);
//
//    },
    //웹페이지로 보여주기
    showWebView: function() {
       var self = this;
         // 실제 브라우저 화면 크기
        var screen_width = $(window).width();
        var screen_height = $(window).height();

        // 캔버스 고정 해상도
        var canvas_width = 1080;
        var canvas_height = 1920;

       
       
        var csize = getFittedCanvasSize(screen_width,screen_height);
        var x = (screen_width-csize.w)/2;
        var y = (screen_height-csize.h)/2;
        var w = csize.w;
        var h = csize.h;
        var scale = csize.s;
        
        if(self.now_contentdata.type == "gallery2"){
            h=h-120*scale;//갤러리2일때 웹뷰높이 재조정 
        }else{
            y = 120*scale;
            h=h-500*scale;//갤러리2일때 웹뷰높이 재조정 
        }
        console.log("x: "+x+" y: "+y+" w: "+w+" h: "+h+ "scale : "+scale);
        this.addWebView(this.sp_rect, x,y,w,h, this.pageurl);
    },
   
//    showWebView_Back: function() {
//       var self = this;
//         // 실제 브라우저 화면 크기
//        var screen_width = $(window).width();
//        var screen_height = $(window).height();
//
//        // 캔버스 고정 해상도
//        var canvas_width = 1080;
//        var canvas_height = 1920;
//
//        // 화면 비율에 따라 스케일 결정
//        var scaleX = screen_width / canvas_width;
//        var scaleY = screen_height / canvas_height;
//        var finalScale = Math.min(scaleX, scaleY); // letterbox 기준
//
//        var canvas_screenWidth = screen_width * (1 / finalScale);
//        var canvas_screenHeight = screen_height * (1 / finalScale);
//        var mx = (canvas_screenWidth-canvas_width)/2;
//        var my = (canvas_screenHeight-canvas_height)/2;
//        if(self.now_contentdata.type == "gallery2")my=-50;//갤러리2일때 웹뷰높이 재조정 
//        
//        this.addWebView(this.sp_rect, 540+mx, 1070+my, self.now_contentdata.width, self.now_contentdata.height, this.pageurl);
//    },
    showFloor: function() {
        var self = this;
        var size = cc.winSize;

        if(self.json_floor.floortitle){
            var title_bg = C_AddSprite(self, res._global_img_floor_title_bg, 570, C_getY(220),1,1,null);
            C_AddCustomFont(self, self.json_floor.floortitle, 570, C_getY(220), null, 1, cc.TEXT_ALIGNMENT_CENTER ,50, C_HEXtoCCColor("#063a4b"),true,function(tag){});
        }
        
        ////////////////////////////////////////////////////////////
        // 배경을 그린다. START
        ////////////////////////////////////////////////////////////
        var heights = [100, 188, 188, 250, 300, 100, 100, 100];
        var floordatas = self.json_floor.floordata;
        var flen = floordatas.length;

//        console.log("flen " + flen);

        var offset = size.height - 300; // 상단부터 시작 (위에서 아래로)

        for (var i = 0; i < flen; i++) {
            var height = floordatas[i].height;
            console.log("floordatas[i] ",floordatas[i]);
            //var bg = new cc.Scale9Sprite(res._global_img_ninepatch_floor_bg);
            
            var bg = new cc.Scale9Sprite(floordatas[i].floorbg.indexOf("floor_bg2.png") >= 0 ?  res._global_img_ninepatch_floor_bg2 :  res._global_img_ninepatch_floor_bg);
            bg.width = 980;
            bg.height = height;

            // 앵커 (0.5, 0.5) 유지 — 중심 좌표 계산
            bg.x = size.width / 2;
            bg.y = offset - height / 2;

            self.addChild(bg);

            // 다음 y 위치로 offset 감소
            offset -= height;
            self.drawFloorData(bg,i, floordatas[i],height);
        }
        ////////////////////////////////////////////////////////////
        // 배경을 그린다. END
        ////////////////////////////////////////////////////////////
        
    },
    
    drawFloorData: function(parent, findex, floor_data, fheight) {
        var self = this;
        var size = cc.winSize;

        //층수
        C_AddCustomFont(parent, floor_data.fname, 65, fheight / 2+10, null, 1, cc.TEXT_ALIGNMENT_CENTER, 50, C_HEXtoCCColor("#063a4b"), true, function () {});

        var max_w_area = 700;
        var lineSpacing = 45;
        var margin = 30;
        var baseX = 150;

        var offsetX = 0;
        var lines = [[]];
        var currentLine = 0;

        for (var i = 0; i < floor_data.data.length; i++) {
            var fdata = floor_data.data[i];
            var tag = "floor_" + findex + "_" + i;
            if(fdata.event.message == ""){
                    tag = null;                
                }
            //층 별 방이름
            var sp = C_AddCustomFontSprite(parent, fdata.title, -9999, -9999, tag, 1, cc.TEXT_ALIGNMENT_CENTER, 35, C_HEXtoCCColor("#063a4b"), true, function (tag) {
//                console.log("층별클릭 id : " + tag);
                self.buttonClick(tag);
            }, true,false);

            var spW = sp.width;

            if (offsetX + spW > max_w_area) {
                lines.push([]);
                currentLine++;
                offsetX = 0;
            }

            lines[currentLine].push({ sp: sp, width: spW, tag: tag });
            offsetX += spW + margin;
        }

        var totalHeight = lines.length * lineSpacing;
        var startY = fheight / 2 + (totalHeight - lineSpacing) / 2;

        for (var line = 0; line < lines.length; line++) {
            var lineData = lines[line];
            var offsetX = 0;

            for (var j = 0; j < lineData.length; j++) {
                var item = lineData[j];
                var drawX = baseX + offsetX + item.width / 2;
                var drawY = startY - (line * lineSpacing);

                item.sp.setPosition(drawX, drawY+10);

                // 🔽 tag 있을 때 터치 아이콘 추가
    //            if (item.tag) {
    //                var iconX = drawX + item.width / 2 + 10; // 오른쪽 끝 + 여백
    //                C_AddSprite(parent, res._global_img_ic_touch, iconX, drawY, null, 0.8, item.sp.zIndex + 1);
    //            }
                if (item.tag) {
                    var icon = C_AddSprite(item.sp, res._global_img_ic_touch, item.sp.width / 2-20, item.sp.height / 2-15, null, 0.5, item.sp.zIndex + 1);
                    icon.setAnchorPoint(0, 0.5);
                }

                offsetX += item.width + margin;
            }
        }
    },

    hideWebView: function() {
        if (this.webview) {
            this.webview.removeFromParent(true);
            this.webview = null;
        }
        var mWebView = document.getElementById("mWebView");
        if(mWebView)mWebView.style.display = "none";
    },
    setTabButtons:function(data){
         var self = this;
         var size = cc.winSize;
        const tab_width = [0,1020,510,340,258,204,170,145,127,113];
         var _tab = data.tab;
         var _sub = data.sub;
//         var tab_size = [258,110];
        var tab_size = tab_width[self.tab_max];
         for(var i = 0 ; i < self.tab_max; i++){
             var x = size.width / 2-515+i*tab_size;
             var y = C_getY(1920);
             var w = tab_size;
             var h = 200;
             var tag = 1000+i*10;
             
             C_AddTransparentButton(self, x,y,w,h,tag,  function (tag) {
//                console.log("tag "+tag);
                if(tag != _tab)self.buttonClick(tag);
                 var idx = tag-1000 == 0 ? 0 : (tag-1000)/10;
                
            });
         }
        
        
        
        var now_ontab_url = "res/n_menu/tab"+_tab+".png";
        for(var i =  0 ; i < self.all_id_sps.length;i++){
            if(self.all_id_sps[i].imgurl.indexOf("res/n_menu/tab") >= 0 && self.all_id_sps[i].imgurl.indexOf("res/n_menu/tab_bg") < 0){
                var isVisible = self.all_id_sps[i].imgurl == now_ontab_url ? true: false;          
                var sp = self.all_id_sps[i].sp;
                sp.setVisible(isVisible);
                sp.setScale(0.8);
                
                var scaleAni = cc.scaleTo(0.2, 1);
                sp.runAction(scaleAni);
            }
            
        }
            
    },
    updateBGUI:function(idx){
        var self = this;
        var size = cc.winSize;
//        console.log("idx is "+idx);
       
        //하단 말풍선 포인트 
        self.bg_point.setPosition(108+idx*216,C_getY(1580));
        
        self.initTitleAniScale(idx);
        self.initTitleImageMoveTo(idx);
    },
    initTitleAniScale:function(idx){
        var self = this;
        var size = cc.winSize;
        var len = self.sp_animation_scale.length;
        for(var i = 0 ; i < len; i ++){
            if(i == idx ){
                var scale = self.sp_animation_scale[i].scale;
                var sp = self.sp_animation_scale[i].sp;
                
                var scaleAni = cc.scaleTo(0.3, scale);
                sp.runAction(scaleAni);
            }else{
                self.sp_animation_scale[i].sp.setVisible(false);    
            }
                    
        }
    },
    initTitleImageMoveTo:function(idx){
        var self = this;
        var size = cc.winSize;
        var len = self.sp_animation_righttoleft.length;
        for(var i = 0 ; i < len; i ++){
            if(i == idx ){
                var x = self.sp_animation_righttoleft[i].x;
                var y = C_getY(self.sp_animation_righttoleft[i].y);
                var sp = self.sp_animation_righttoleft[i].sp;
                sp.setPosition(2000,y);
                var move = cc.moveTo(0.3,x,y);
                sp.runAction(move);
            }else{
                self.sp_animation_righttoleft[i].sp.setVisible(false);    
            }
           
            
        }
    },
    setSubButtons:function(data){
        var self = this;
        var size = cc.winSize;
        const sub_width = [0,1020,510,340,255,204,170,145,127,113];
        
        var _tab = data.tab;
        var _sub = data.sub;
        var _sub_max = self.sub_maxs[_tab];
        var sub_size = sub_width[_sub_max];
        
//        var btn_len = [4,3,3,2];
//        var sub_size = [[255,76],[340,76],[340,76],[510,76]];  //[[width,height],[width,height],[width,height],..]
        
        for(var i = 0 ; i < _sub_max; i++){
            const idx = i;
            const sub_tag = 1000+_tab*10+i;//(_tab+1)*10+idx;
//            
//            console.log("sub_tag "+sub_tag);
            C_AddTransparentButton(this, size.width / 2-510+i*sub_size, C_getY(440), sub_size, 76, sub_tag,  function (tag) {
                
                
                 if(tag%10 != _sub)self.buttonClick(tag);
            });            
        }
        
        
        
        
        //sub 배경그리기
        var now_sub_bgtab_url = "res/n_menu/sub"+_tab+"_bg.png";
        for(var i =  0 ; i < self.all_id_sps.length;i++){
            if(self.all_id_sps[i].imgurl.indexOf("res/n_menu/sub") >= 0 && self.all_id_sps[i].imgurl.indexOf("_bg.png") >= 0){
                var isVisible = self.all_id_sps[i].imgurl == now_sub_bgtab_url ? true: false;
                
                self.all_id_sps[i].sp.setVisible(isVisible);
//                C_AddSprite(self, "res/n_menu/sub"+_tab+"_bg.png", size.width / 2, C_getY(393),1,null,null);
            }            
        }
        
        
        
        
        
//        //선택된 sub 그리기
        var sprite_sx = [-382,-341,-341,-255];
        
        
        
        
        var now_sub_tab_url = "res/n_menu/sub"+_tab+"_"+_sub+".png";
        
        for(var i =  0 ; i < self.all_id_sps.length;i++){
            if(self.all_id_sps[i].imgurl.indexOf("res/n_menu/sub") >= 0 && self.all_id_sps[i].imgurl.indexOf("_bg.png") < 0){
                
                var isVisible = self.all_id_sps[i].imgurl == now_sub_tab_url ? true: false;
                
                self.all_id_sps[i].sp.setVisible(isVisible);
//                C_AddSprite(self, "res/n_menu/sub"+_tab+"_"+_sub+".png", size.width / 2 + sprite_sx[_tab] +_sub*sub_size[_tab][0], C_getY(393),1,null,null);
            }            
        }
     
        
    },
    setRunTypeList:function(isshow){
        var self = this;
        self.arrow_left.setVisible(isshow);
        self.arrow_right.setVisible(!isshow);
         //0 빈 Sub탭 버튼
        var tab0_btn = C_AddTransparentButton(self,  size.width / 2-513, C_getY(357),257,110, m_tag.btn_tab0,  function (tag) {
            
            if(self._data.tab != 0)self.buttonClick(tag);
        });
        
    },
    buttonClick: function(tag){
        var self = this;
        var size = cc.winSize;
        
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        if(checkType(tag) == "string")
        {                    
            for(var i = 0 ; i < self.maindatas.length;i++){
                if(tag == self.maindatas[i].id){
                    var event = self.maindatas[i].event ? self.maindatas[i].event : null; 
//                    console.log("click tag "+tag);
                    if(event){
                        if(event.page == "home" || event.page == "main"){
                            var scene = event.page == "main" ? SCENE_MENU : SCENE_HOME;
                            var data = event;          
                            if(parseInt(self._data.tab) != parseInt(data.tab)){
//                                 C_nextScene(scene, data);      
                                
                                
                                self._data = data;
                                if(event.page == "home" )
                                    C_nextScene(scene, data);                       
                                else
                                    self.init();
                                
                            }
                                
                        }
                        
                        else if(event.page == "map"){


                            self.hideWebView();

                            var mapdatas = [];
                            for(var i = 0 ; i < self.contentdatas.length;i++){
                                if(self.contentdatas[i].type == "mapimg")
                                    mapdatas.push(self.contentdatas[i]);
                            }

                             C_ShowMapDialogLayer(self,"","",mapdatas, function(){
            //                    C_AndroidCall("closeWebView","close");
            //                     self.showHideWebView(true);
                                 self.showWebView();

                            },null); 


                        }

                    }
                    break;
                }
            }
            if(tag.indexOf("floor_") >= 0){
//                console.log("층별안내클릭했다!!");
                var arr = tag.split("_");
                var findex = arr[1];
                var dindex = arr[2];
//                console.log("findex is "+findex+" dindex "+dindex);
                var fdata = self.json_floor.floordata[findex].data[dindex];
                
                var title = fdata.title;
                
                if(fdata.event){
                    var message = fdata.event.message;
                    //var imgres = fdata.event.img;
                    var imgres = "contentdata/floor/"+self.json_floor.floordata[findex].fname+"_"+self.json_floor.floordata[findex].data[dindex].title+".jpg";
                    if(fdata.event.type == "popup"){
                        C_ShowDialogLayer(self, title , message, imgres, function(){
                            
                        });    
                    }    
                }
                
                
            }

        }
        else if(checkType(tag) == "int" && tag >= 1000){
            var _tab = tag-1000 > 0 ? parseInt((tag-1000)/10) : 0;
            var _sub = tag-1000 > 0 ? parseInt(tag-1000)%10 : 0;
//            console.log("_tab "+_tab+" _sub "+_sub);
            if(parseInt(self._data.tab) != _tab)
                C_nextScene(SCENE_MENU,{"tab":_tab, "sub":_sub});
           
        }
        self.resetInactivityTimer();
        
    },
    buttonClick_Old: function (tag) {
        var self = this;
        var size = cc.winSize;
        
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        var canvas = document.getElementById("gameCanvas");
        switch (tag) {
            case m_tag.logo:
                C_nextScene(SCENE_HOME);
                break;
            case m_tag.btn_map:
                
                self.hideWebView();
                
                var mapdatas = [];
                for(var i = 0 ; i < self.contentdatas.length;i++){
                    if(self.contentdatas[i].type == "mapimg")
                        mapdatas.push(self.contentdatas[i]);
                }
                
                 C_ShowMapDialogLayer(self,"","",mapdatas, function(){
//                    C_AndroidCall("closeWebView","close");
//                     self.showHideWebView(true);
                     self.showWebView();
                     
                },null);    
                break;
            case m_tag.btn_tab0:
                
                C_nextScene(SCENE_MENU,{"tab":0, "sub":0,"pageurl":""});
                break;
            case m_tag.btn_tab1:
                
                C_nextScene(SCENE_MENU,{"tab":1, "sub":0});
                break;
            case m_tag.btn_tab2:
                
                C_nextScene(SCENE_MENU,{"tab":2, "sub":0});
                break;
            case m_tag.btn_tab3:
                
                C_nextScene(SCENE_MENU,{"tab":3, "sub":0});
                break;
            case m_tag.btn_sub00:
                C_nextScene(SCENE_MENU,{"tab":0, "sub":0});
                break;
            case m_tag.btn_sub01:
                C_nextScene(SCENE_MENU,{"tab":0, "sub":1});
                break;
            case m_tag.btn_sub02:
                C_nextScene(SCENE_MENU,{"tab":0, "sub":2});
                break;
            case m_tag.btn_sub03:
               C_nextScene(SCENE_MENU,{"tab":0, "sub":3});
                break;
            case m_tag.btn_sub10:
                C_nextScene(SCENE_MENU,{"tab":1, "sub":0});
                break;
            case m_tag.btn_sub11:
                C_nextScene(SCENE_MENU,{"tab":1, "sub":1});
                break;
            case m_tag.btn_sub12:
                C_nextScene(SCENE_MENU,{"tab":1, "sub":2});
                break;
            case m_tag.btn_sub20:
                C_nextScene(SCENE_MENU,{"tab":2, "sub":0});
                break;
            case m_tag.btn_sub21:
                C_nextScene(SCENE_MENU,{"tab":2, "sub":1});
                break;
            case m_tag.btn_sub22:
                C_nextScene(SCENE_MENU,{"tab":2, "sub":2});
                break;
            case m_tag.btn_sub30:
                C_nextScene(SCENE_MENU,{"tab":3, "sub":0});
                break;
            case m_tag.btn_sub31:
                C_nextScene(SCENE_MENU,{"tab":3, "sub":1});
                break;

        }
    },
    /////////////////////////////////////////
    // 일정시간 입력없으면 함수호출 START
    /////////////////////////////////////////
    
    onUserInactive: function () {
         var self = this;
        cc.log("🔕 30초 동안 아무 입력이 없었습니다.");
        // 여기에 원하는 동작을 넣으세요 (예: 화면 전환, 경고창 등)
        
        if (this._inactivityTimer) {
            this.unschedule(this._inactivityTimer);
        }
        
        if(parseInt(self._data.tab) != 4)
            C_nextScene(SCENE_MENU,{"tab":4,"sub":0});
    },

    resetInactivityTimer: function () {
//        console.log("시간리셋!!");
        if (this._inactivityTimer) {
            this.unschedule(this._inactivityTimer);
        }

        this._inactivityTimer = this.onUserInactive.bind(this);
        this.scheduleOnce(this._inactivityTimer, 30); // 30초 후 호출
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


var MenuScene = cc.Scene.extend({
     ctor: function (data) {
        this._super();
        this._data = data; // 전달받은 data 저장
    },

    onEnter: function () {
        this._super();
        var layer = new MenuLayer(this._data); // Layer에 data 전달
        this.addChild(layer);
    }
});
