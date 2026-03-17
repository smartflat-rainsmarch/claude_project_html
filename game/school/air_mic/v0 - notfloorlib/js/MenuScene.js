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
    indicator_on : [],
    tabon0 : null,
    tabon1 : null,
    taboff0 : null,
    taboff1 : null,
    nowtab : -1,
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
		NOW_SELF = this;
        var size = cc.winSize;
        

        C_CheckGPioSpeak(self);
        var size = cc.winSize;
//        this.addChild(new cc.LayerColor.create(cc.color(255, 255, 255, 255)));

        m_tag = {};
        self.sub_maxs = [];
        self.sp_animation_righttoleft = [];
        self.sp_animation_scale = [];
        
        //////////////////////////////////////////////////////////////
        //new module
        //////////////////////////////////////////////////////////////
    
        self.homepage_data = getgamedata;
        self.contentdatas = self.homepage_data.hm_content_data;
        self.maindatas = self.homepage_data.hm_main_data;
        
        
    
        
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
            else if(self.maindatas[i].id == "taboff0"){
                self.taboff0 = C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].id == "taboff1"){
                self.taboff1 = C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].id == "tabon0"){
                self.tabon0 = C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].id == "tabon1"){
                self.tabon1 = C_setUI(self,size,self.maindatas[i]);
            }
            else {
                var _sp = C_setUI(self,size,self.maindatas[i]);
                if(self.maindatas[i].imgurl && self.maindatas[i].imgurl.indexOf("main_bg.png") >= 0)  //main_bg.png 이미지는 반드시 있어야한다.
                    this.sp_rect = _sp;
                self.all_id_sps.push({"imgurl":C_getResPath(self.maindatas[i].imgurl), "sp":_sp});
                
                //네모 하단 말풍선 포인트
                if(self.maindatas[i].id == "main_mainrect_point")
                    self.bg_point = _sp;
                if(self.maindatas[i].animationtype == "righttoleft")
                    self.sp_animation_righttoleft.push({"x":self.maindatas[i].x,"y":self.maindatas[i].y,"sp":_sp});
                if(self.maindatas[i].animationtype == "scale")
                    self.sp_animation_scale.push({"scale":self.maindatas[i].animationscale,"sp":_sp});
                
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
        self.tab_max = 4; //고정한다.
    
         //tab Setting
//        self.setTabButtons(this._data);
//        
//        //sub Setting
//        self.setSubButtons(this._data);
        
         self.init(self._data);
        
        /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
        C_checkSafetyDialogShow(self);
        
        
        return true;
    },
    init:function(data){
        var self = this;
        var size = cc.winSize;
        
        var _tab = data.tab;
        var _sub = data.sub;
        self.nowtab = _tab;
//        this.pageurl = "./html/page0_0.html";
//        this.pageurl="https://maecheon.dge.ms.kr/maecheonm/ad/fm/foodmenu/selectFoodMenuView.do";

        
        //지도보기이다.
        if(_tab == 4){
            console.log("지도보기이다.");
            self.mapdatas = [];
            
            self._bg = C_AddSprite(self,"res/main_bg.png", 540, C_getY(1880),1,1,null);
            for(var i = 0 ; i < self.contentdatas.length;i++){
                if(self.contentdatas[i].type == "mapimg")
                    self.mapdatas.push(self.contentdatas[i]);
            }

        
//            self.initMap(self._bg, self.floor);
//            self.initWeightSpeed(self._bg);
              C_ShowMapDialogLayer(self, data.data,"",self.mapdatas, function(tag){
                   var event = {
                        "page": "main",
                        "tab": tag,
                        "sub": "0"
                   }
                  C_nextScene(SCENE_MENU, event);   
                  C_PlaySound(SOUND.SND_BUTTONTOUCH);
              },null);
            self.hideTab();
        }
        
        else {
            //건강검진 항공 특수
            if(_tab == 1){
                self.initTab(_sub);
            }else {
                self.hideTab();
            }
            
            self.now_contentdata = null;
            for(var i = 0 ; i < self.contentdatas.length;i++){
                if(self.contentdatas[i].tab == _tab && self.contentdatas[i].sub == _sub){
                    self.now_contentdata = self.contentdatas[i];
                    break;
                }
            }
            if(self.now_contentdata){
                 var schoolapitype = self.now_contentdata.schoolapitype ? self.now_contentdata.schoolapitype : "";

                 this.pageurl = self.getIFrameUrl(self.now_contentdata.type, self.now_contentdata.id, schoolapitype);
                self.showWebView();   
            }    
        }
        
        
        self.updateBGUI(_tab);
    },
    initTab:function(idx){
        var self = this;
        if(idx == 0){
            self.taboff0.setVisible(false);
            self.tabon0.setVisible(true);
            
            self.taboff1.setVisible(true);
            self.tabon1.setVisible(false);
        }else {
            self.taboff0.setVisible(true);
            self.tabon0.setVisible(false);
            
            self.taboff1.setVisible(false);
            self.tabon1.setVisible(true);
        }
        
    },
    hideTab:function(){
        var self = this;
        self.taboff0.setVisible(false);
        self.taboff1.setVisible(false);
        self.tabon0.setVisible(false);
        self.tabon1.setVisible(false);
        
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
//        self.loadImages(1,10,function(res){
//            
//            
//           self.initSwiperLayer(res);
//            
//            
//        });
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
        if(self.now_contentdata.indicator)this.initIndecator(self.now_contentdata.indicator);
    },
    gpioTimer: 0,
    update: function (dt) {
         
        var self = this;
        this.wtime += dt;
        var nowtime = Math.floor(this.wtime);
    
   
        // 2. 1초마다 C_CheckGPio 호출 로직 추가
        if (!this.gpioTimer) this.gpioTimer = 0; // 변수 미선언 대비 초기화
        
        this.gpioTimer += dt; // 프레임 간격 시간을 더함
        if (this.gpioTimer >= 1.0) { // 1초(1.0) 이상 쌓였을 때
            C_CheckGPio(self);
            this.gpioTimer -= 1.0; // 1초를 빼서 다음 1초를 다시 계산 (정밀도 유지)
        }
        this.updateIndicator();
        
    },
    updateIndicator:function(){
        console.log("updateIndicator!");
        var self = this;
        for(var i = 0;i < this.indicator_on.length; i++){            
            this.indicator_on[i].setVisible(false);            
        }
       if(this.indicator_on[this.currentIndex]){
           console.log("인디케이터 aaa "+this.currentIndex);
           this.indicator_on[this.currentIndex].setVisible(true);
       }else {
           console.log("인디케이터 bbb "+this.currentIndex);
       }
    },
    showSlide: function (index, withAnimation, direction = "left") {
        var self = this;
        if (this.isSliding) return;
        if(!self.isPosterScene)return;
        this.isSliding = true;

        var imgfoldername = self.now_contentdata.imgfoldername ? self.now_contentdata.imgfoldername : "gallery2";
        const imgPath = "contentdata/"+imgfoldername+"/" + this.imageData[index].filename;
//        const newSlide = new cc.Sprite(imgPath);
        const MY = 785;
        const MX = this.width/2 - (this.width-1080)/2;
        
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
            const scaleY = 1570 / textureSize.height;
            newSlide.setScaleX(scaleX);
            newSlide.setScaleY(scaleY);
            newSlide.setPosition(MX, MY); // SwiperLayer 기준 아래쪽 중앙


            if (withAnimation) {
                let fromX = direction === "left" ? this.width + MX : -MX;
                console.log("fromX is "+fromX);
                newSlide.setPosition(fromX, MY);
                this.sp_rect.addChild(newSlide, 1);

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
                this.sp_rect.addChild(newSlide);
                this.isSliding = false;
            }

            this.slideSprite = newSlide;
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
    loadImages :function (page, max, callback){
        var self = this;
        var foldername = self.now_contentdata.imgfoldername ? self.now_contentdata.imgfoldername : "gallery2";
         var _data = {
            "projectid":param_projectid,
            "groupidx":param_groupidx,
            "page":page,
            "maxcount":max,
             "imgfoldername" : foldername
        }
         console.log("MenuScene 00 이미지로드했다. is ",res);
//        AJAX_AdmGetGame("getgallerydata", _data, function(res){
//            console.log("MenuScene 11 이미지로드했다. is ",res);
//           code = parseInt(res.code);
//           if (code == 100) {
//
//               var getdatas = res.message;
//               if(callback)callback(res.message);
//           }
//        });
    },
    /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 END
    /////////////////////////////////////////////////////////////////
    
    
    getIFrameUrl: function(type, id, schoolapitype){
         var self = this;   
         var useschoolapi = self.now_contentdata.useschoolapi ? self.now_contentdata.useschoolapi : 0;
        if(schoolapitype && useschoolapi == 1){
            var fname = "../../../webpage/type_schooldata.html";
            return fname;
        }else{
            var fname = "";
            switch(type){
                case "html":
                    fname = "type_image.html";
                    break;
                case "survey":
                    fname = "../../../webpage/type_survey.html";
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
                case "gallery1":
                    fname = "../../../webpage/type_gallery1.html";
                    break;
                case "gallery2": //행사안내 포스트
                    fname = "../../../webpage/type_gallery2.html";
                    break;
                case "game":
                    fname = "../../../../"+self.now_contentdata.url;//flappybird
                    break;
                case "video_gallery":
                    fname = "../../../webpage/type_video_gallery.html";
                    break;
                case "trand":
                    fname = "../../../webpage/type_trand.html";
                    break;
                default:

                    break;
            }
            return fname;
        }

    },

    //cocos webView를 사용한다. 1080,1920 사이즈로 보여지며 축소되서 잘 보여짐
    addWebView: function(parent, x, y, w, h, pageurl) {
        var self = this;
        var size = cc.winSize;
        if (!ccui || !ccui.WebView) {
            cc.log("WebView is not supported in this version of Cocos2d-JS.");
            return;
        }
        
        this.webview = new ccui.WebView();
        this.webview.setContentSize(w, h);
        this.webview.setAnchorPoint(0.5, 0.5);
        this.webview.setPosition(x, y);
        
        
        var _param_schoolapitype = self.now_contentdata.schoolapitype ? "&apitype="+self.now_contentdata.schoolapitype : "";
        var _param_gamemode = self.now_contentdata.gamemode ? "&gamemode="+self.now_contentdata.gamemode : "";        
        var _param_surveyidx = self.now_contentdata.surveyidx ? "&surveyidx="+self.now_contentdata.surveyidx : "";
        var _param_surveyonoff = self.now_contentdata.surveyonoff ? "&surveyonoff="+self.now_contentdata.surveyonoff : "";
        
        var url = pageurl+"?projectid="+param_projectid+"&groupidx="+param_groupidx+"&listid="+self.now_contentdata.id+_param_schoolapitype+_param_gamemode+_param_surveyidx+_param_surveyonoff;
         console.log("mWebView.url  ",url );
       
        this.webview.loadURL(pageurl+"?projectid="+param_projectid+"&groupidx="+param_groupidx+"&listid="+self.now_contentdata.id+_param_schoolapitype+_param_gamemode+_param_surveyidx+_param_surveyonoff);
       
        this.webview.setScalesPageToFit(true);
        this.webview.setVisible(true);
        this.webview.boderStyle("none");//iframe 테두리 안보이기
        this.addChild(this.webview, 999);
        
        
        
        //iframe 클릭했을때 이벤트 받는다.
        initIframeTouchEvent(self);
        

    },
    //이미지로 보여주기
     showContentImage : function(){
        var self = this;
        var size = cc.winSize;
        
//        console.log("this.pageurl ",this.pageurl);
        var dataimage = C_AddSprite(self, this.pageurl, size.width / 2-25, C_getY(size.height/2+230),1,null,null);
         
        if(this.sp_rect)
            this.sp_rect.addChild(dataimage);
    },

    //웹페이지로 보여주기
    showWebView: function() {
       
//        console.log("this.pageurl ",this.pageurl);
         // 실제 브라우저 화면 크기
        var screen_width = $(window).width();
        var screen_height = $(window).height();
//        console.log("screen_width", screen_width, "screen_height", screen_height);

        // 캔버스 고정 해상도
        var canvas_width = 1080;
        var canvas_height = 1920;

        // 화면 비율에 따라 스케일 결정
        var scaleX = screen_width / canvas_width;
        var scaleY = screen_height / canvas_height;
        var finalScale = Math.min(scaleX, scaleY); // letterbox 기준
//        console.log("finalScale "+finalScale);
//        console.log("screen_width "+screen_width+" canvas_width "+(canvas_width*finalScale));
//        console.log("screen_height "+screen_height+" canvas_height "+(canvas_height*finalScale));
        var canvas_screenWidth = screen_width * (1 / finalScale);
        var canvas_screenHeight = screen_height * (1 / finalScale);
        var mx = (canvas_screenWidth-canvas_width)/2;
        var my = (canvas_screenHeight-canvas_height)/2;
        
        if(this._data.tab == 1)
            this.addWebView(this.sp_rect, 540+mx, 1080+my, 1080, 1100, this.pageurl);
        else 
            this.addWebView(this.sp_rect, 540+mx, 1110+my, 1080, 1260, this.pageurl);
    },
    hideWebView: function() {
        if (this.webview) {
            this.webview.removeFromParent(true);
            this.webview = null;
        }
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
                console.log("tag "+tag);
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
        console.log("idx is "+idx);
       
        //하단 말풍선 포인트 
        self.bg_point.setPosition(135+idx*270,C_getY(1640));
        
        self.initTitleAniScale(idx);
        self.initTitleImageMoveTo(idx);
    },
    initTitleAniScale:function(idx){
        var self = this;
        var size = cc.winSize;
        var len = self.sp_animation_scale.length;
        for(var i = 0 ; i < len; i ++){
            if(i == parseInt(idx)){
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
        idleMode = IDLE_OFF;
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        if(tag == "taboff0"){
            var data = {"tab":1, "sub":0};                    
            C_nextScene(SCENE_MENU, data);     
        }else if(tag == "taboff1"){
            var data = {"tab":1, "sub":1};                    
            C_nextScene(SCENE_MENU, data);     
        }
        else if(checkType(tag) == "string")
        {                    
            for(var i = 0 ; i < self.maindatas.length;i++){
                if(tag == self.maindatas[i].id){
                    var event = self.maindatas[i].event ? self.maindatas[i].event : null; 

                    if(event){
                        if(event.page == "home" || event.page == "main"){
                            var scene = event.page == "main" ? SCENE_MENU : SCENE_HOME;
                            var data = event;                    
                            C_nextScene(scene, data);                       
                        }else if(event.page == "map"){


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
        }
        else if(checkType(tag) == "int" && tag >= 1000){
            var _tab = tag-1000 > 0 ? parseInt((tag-1000)/10) : 0;
            var _sub = tag-1000 > 0 ? parseInt(tag-1000)%10 : 0;
//            console.log("_tab "+_tab+" _sub "+_sub);
            C_nextScene(SCENE_MENU,{"tab":_tab, "sub":_sub});
           
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
        
        if(home_scene != SCENE_MENU || 
           home_scene == SCENE_MENU && home_data.tab && this.now_contentdata.tab && parseInt(home_data.tab) != parseInt(this.now_contentdata.tab) || 
           home_scene == SCENE_MENU && home_data.sub && this.now_contentdata.sub && parseInt(home_data.sub) != parseInt(this.now_contentdata.sub)){
            if(!IS_SHOW_POPUP)gotoHomeScene();
        }else{
            idleMode = IDLE_READY;
        }
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
    },
    /////////////////////////////////////////
    // 일정시간 입력없으면 함수호출 END
    /////////////////////////////////////////
    
    
    
    
    ///////////////////////////////////////////////////////
    // 지도영역 
    ///////////////////////////////////////////////////////
     mapViewLayer: null,
    mapSprite: null,
    touchListener: null,
    okCallback : null,
    floor:1,
    mapdatas : null,
   initMap: function (_bg, value) {
        var self = this;
        var _w = 960;
        var _h = 1400;

        // 이전 지도 레이어 및 스프라이트 제거
        if (this.mapSprite) {
            this.mapSprite.removeFromParent(true);
            this.mapSprite = null;
        }

        if (this.mapViewLayer) {
            this.mapViewLayer.removeFromParent(true);
            this.mapViewLayer = null;
        }

        // 클리핑 노드가 없으면 새로 생성 (최초 1회만 추가)
        if (!this.clipper) {
            var stencil = new cc.DrawNode();
            stencil.drawRect(cc.p(0, 0), cc.p(_w, _h), cc.color(70, 70, 70, 100), 1, cc.color(88, 0, 0, 255));

            this.clipper = new cc.ClippingNode(stencil);
            this.clipper.setAnchorPoint(0.5, 0.5);
            this.clipper.setPosition((_bg.width - _w) / 2, 180);
            _bg.addChild(this.clipper);
        }

        // 새 지도 레이어 생성
        this.mapViewLayer = new cc.Layer();
        this.mapViewLayer.setContentSize(_w, _h);
        this.clipper.addChild(this.mapViewLayer);

        // 지도 이미지 경로 결정
        var mapurl = "";
        for (var i = 0; i < self.mapdatas.length; i++) {
            if (self.mapdatas[i].value == value) {
                mapurl = self.mapdatas[i].url;
                break;
            }
        }

        // 지도 이미지 추가
        this.mapSprite = new cc.Sprite(mapurl);
        this.mapSprite.setAnchorPoint(0.5, 0.5);
        this.mapSprite.setPosition(_w / 2, _h / 2);
        this.mapSprite.setScale(0.63);
        this.mapViewLayer.addChild(this.mapSprite);

        // 터치 활성화
        this.enableMapTouch();
    },
    enableMapTouch: function () {

        var self = this;

        this.isDragging = false;
        this.startPos = null;

        var touchListener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true,

            onTouchBegan: function (touch, event) {
                self.startPos = touch.getLocation();
                self.isDragging = true;
                return true;
            },

            onTouchMoved: function (touch, event) {
                if (self.isDragging) {
                    var delta = touch.getDelta();
                    self.moveMapByDelta(delta);
                }
            },

            onTouchEnded: function (touch, event) {
                self.isDragging = false;
                if (g_menuLayer) g_menuLayer.resetInactivityTimer();

            },

            onTouchCancelled: function (touch, event) {
                self.isDragging = false;
                if (g_menuLayer) g_menuLayer.resetInactivityTimer();
            }
        });

        cc.eventManager.addListener(touchListener, this.mapSprite);

        // 💡 마우스도 동시에 지원하고 싶다면 아래도 함께 사용
        var mouseListener = cc.EventListener.create({
            event: cc.EventListener.MOUSE,
            onMouseDown: function (event) {
                self.isDragging = true;
                self.startPos = cc.p(event.getLocationX(), event.getLocationY());
            },
            onMouseMove: function (event) {
                if (self.isDragging) {
                    var delta = event.getDelta();
                    self.moveMapByDelta(delta);
                }
            },
            onMouseUp: function () {
                self.isDragging = false;
                if (g_menuLayer) g_menuLayer.resetInactivityTimer();
            }
        });

        cc.eventManager.addListener(mouseListener, this.mapSprite);
    },

    // 💡 지도 이동 보조 함수
    moveMapByDelta: function (delta) {
        var pos = this.mapSprite.getPosition();
        var newPos = cc.p(pos.x + delta.x, pos.y + delta.y);

        var scale = this.mapSprite.getScale();
        var mapSize = this.mapSprite.getContentSize();
        var scaledWidth = mapSize.width * scale;
        var scaledHeight = mapSize.height * scale;

        var viewW = 960;
        var viewH = 1400;

        // 이동 제한 계산
        var minX = viewW - scaledWidth / 2;
        var maxX = scaledWidth / 2;
        var minY = viewH - scaledHeight / 2;
        var maxY = scaledHeight / 2;

        newPos.x = Math.max(minX, Math.min(newPos.x, maxX));
        newPos.y = Math.max(minY, Math.min(newPos.y, maxY));

        this.mapSprite.setPosition(newPos);
    },
    initWeightSpeed:function(_bg){
        var size = cc.winSize;
        var self = this;
//        console.log("initWeightSpeed");
        this.zoomSlider = new ccui.Slider();
        this.zoomSlider.setTouchEnabled(true);
        this.zoomSlider.setRotation(-90);
        this.zoomSlider.direction = 0; // 0 :horizontal , 1: vertical;
        this.zoomSlider.loadBarTexture(res.n_speed_back);
        this.zoomSlider.loadSlidBallTextures(res.n_speed_stick);
        this.zoomSlider.loadProgressBarTexture(res.n_speed_on);
        this.zoomSlider.x = _bg.width-40;
        this.zoomSlider.y = C_getY(_bg.height-30);
//        this.zoomSlider.setScale(2);
        
        var gab = 100/12;  //8
        var value = this.weight_speed*2-3;
        this.zoomSlider.setPercent(value*gab);
        this.zoomSlider.addEventListener(this.sliderEvent,this);
        _bg.addChild(this.zoomSlider);
        
        
//        this.zoomSlider.setVisible(false);
    },
    sliderEvent:function(sender, type){
        var self = this;
        switch(type){
            case ccui.Slider.EVENT_PERCENT_CHANGED:
                console.log("percent : "+sender.getPercent().toFixed(0));
                // 1.5~7.5
                var gab = 100/12;
//                console.log("gab is "+gab);
                var value = parseInt(sender.getPercent()/gab);
//                console.log("value : ",value);
                var percent = parseInt(gab)*value;
//                console.log("value "+value+" percent "+percent);
                sender.setPercent(parseInt(gab)*value)
//                self.weight_speed = 1.5+value;
                
                //1초, 2초 , 3초 ... 초단위 속도조절
                self.updateWeightSpeed(Math.floor(1.5+value*0.5));
                
//                sender.setPercent(20);
                break;
        }
//        console.log("sender.getPercent() : "+sender.getPercent());
       
//        if(sender.getPercent() < 20)sender.setPercent(20);
//        if(sender.getPercent > 80)sender.setPercent(80);
    },
    updateWeightSpeed:function(speed){
        var _w = 960;
        var _h = 1400;
        this.weight_speed = speed;
//        C_SaveData("health_speed",speed);
        if(speed < 1)speed =1;
        this.mapSprite.setScale(speed);
        this.mapSprite.setPosition(_w/2, _h/2);
    }
    /////////////////////////////////////////
    // 화면에 층별안내를 만든다. START
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
