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
//        this.addChild(new cc.LayerColor.create(cc.color(255, 255, 255, 255)));

        m_tag = {};
        self.sub_maxs = [];
        self.sp_animation_righttoleft = [];
        self.sp_animation_scale = [];
        
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
    
         //tab Setting
        self.setTabButtons(this._data);
//        
//        //sub Setting
//        self.setSubButtons(this._data);
        
         self.init(self._data);
        
        /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
        
        
        
       
        
        //////////////////////////////////////////////////////////////
        //old code
        //////////////////////////////////////////////////////////////
//        
////        C_DrawBackColor(self);
//
//        //배경
////        var bgtest = C_AddSprite(self,res.n_menu_bgtest, size.width / 2, C_getY(size.height/2),1,null,null);//guide
////        var bg = C_AddSprite(self,res.n_home_mbg, size.width / 2, C_getY(size.height/2),1,null,null);
//        
//        //로고
//        C_AddAnimButton(self, res.n_home_logo, null, size.width / 2, C_getY(120), m_tag.logo, 0.6, null, function (tag) {
//            self.buttonClick(tag);
//        }, self);
//        
//        //학교안내도
//        C_AddAnimButton(self, res.n_menu_btn_map, null,  size.width - 120, C_getY(120), m_tag.btn_map, 0.7, null, function (tag) {
//            
//            self.buttonClick(tag);
//        }, self);
//        
//        
////        //Tab 배경4개버튼모두
//        var tab_bg = C_AddSprite(self,res.n_menu_tab_bg, size.width / 2, C_getY(298),1,null,null);
//        
//         //메인 네모
//        this.sp_rect = C_AddSprite(self,res.n_menu_main_bg, size.width / 2, C_getY(size.height / 2+120), 1,null,null);
//        
//        
//        
//         //tab Setting
//        self.setTabButtons(this._data);
//        
//        //sub Setting
//        self.setSubButtons(this._data);
//
//       
//        //Line
////        C_AddSprite(self,res.n_menu_line, size.width / 2, C_getY(432),1,null,null);
//        
//        
//        /////////////////////////////////////
//        //일정시간 입력없을때 홈으로가도록 설정
//        /////////////////////////////////////
//        this.enableInputTracking();
//        this.resetInactivityTimer(); // 최초 타이머 설정
//        
//     
//        
//         AJAX_AdmGet(ADM_TYPE.GET_HOME_DATA, param_projectid, function(res){
//               code = parseInt(res.code);
//               if (code == 100) {
//                   self.homepage_data = res.message;
//                   console.log("page_home_data",self.homepage_data);
//                   if(self.homepage_data.hm_home_data.length > 5){
//                       
//                        self.homedatas = JSON.parse(self.homepage_data.hm_home_data);
//                        
//                   } 
//                   if(self.homepage_data.hm_main_data.length > 5){
//                       
//                        self.maindatas = JSON.parse(self.homepage_data.hm_main_data);
//                        
//                   } 
//                   if(self.homepage_data.hm_content_data.length > 5){
//                       
//                        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
//                        
//                   } 
//                   self.init(self._data);
//                   console.log("contentdatas",self.contentdatas);
//                   
//                   
//               }               
//            });          
        
        return true;
    },
    init:function(data){
        var self = this;
        var size = cc.winSize;
        
        var _tab = data.tab;
        var _sub = data.sub;
        
//        this.pageurl = "./html/page0_0.html";
//        this.pageurl="https://maecheon.dge.ms.kr/maecheonm/ad/fm/foodmenu/selectFoodMenuView.do";

        
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
            setTimeout(function(){
                
                self.showWebView();   
            },100);
             
            
        }    
        self.updateBGUI(_tab);
    },
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
        
        var schoolapitype = self.now_contentdata.schoolapitype ? self.now_contentdata.schoolapitype : "";
        var gamemode = self.now_contentdata.gamemode ? self.now_contentdata.gamemode : 0;
        this.webview.loadURL(pageurl+"?projectid="+self.homepage_data.hm_projectid+"&groupidx="+param_groupidx+"&listid="+self.now_contentdata.id+"&apitype="+schoolapitype+"&gamemode="+gamemode);
        this.webview.setScalesPageToFit(true);
        this.webview.setVisible(true);
        this.webview.boderStyle("none");//iframe 테두리 안보이기
        this.addChild(this.webview, 999);
        
        
        
        //iframe 클릭했을때 이벤트 받는다.
        initIframeTouchEvent(self);
        
        
//        console.log("addWebView");
       
       //test 안됨 iframe 안에 Dom 내용 내께 아니라 수정불가
//        var script = `
//                document.getElementById("header").style.display = "none";
//                document.getElementById("footer").style.display = "none";
//                document.getElementById("quickMenu").style.display = "none";
//            `;
//       this.webview.evaluateJS(script);
           
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
        
        
        this.addWebView(this.sp_rect, 540+mx, 950+my, 1080, 1250, this.pageurl);
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
        cc.log("🔕 60초 동안 아무 입력이 없었습니다.");
        // 여기에 원하는 동작을 넣으세요 (예: 화면 전환, 경고창 등)
        
        if (this._inactivityTimer) {
            this.unschedule(this._inactivityTimer);
        }
        
        C_nextScene(SCENE_HOME);
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
