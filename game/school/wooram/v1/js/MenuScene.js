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
//    all_id_sps : [],//전체 sprite  //애니메이션 제외
//    tab_max : 0,
//    sub_maxs : [],
    arr_titles : [],
    arr_icons : [],
    arr_maindatas : [],
    
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
        this.addChild(new cc.LayerColor.create(cc.color(39, 38, 36, 255)));

        m_tag = {};
        
        //////////////////////////////////////////////////////////////
        //new module
        //////////////////////////////////////////////////////////////
    
        self.homepage_data = getgamedata;
        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
        self.maindatas = JSON.parse(self.homepage_data.hm_main_data);
        
        
    
        self.arr_titles = [];
        self.arr_icons = [];
        self.arr_maindatas = [];
        
//        this.all_id_sps = [];
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
               if(self.maindatas[i].id.indexOf("title_") >= 0){
                   self.arr_titles.push(_sp);
               }
               else if(self.maindatas[i].id.indexOf("icon_") >= 0){
                   self.arr_icons.push(_sp);
               }
               else if(self.maindatas[i].id.indexOf("maindata_") >= 0){
                   self.arr_maindatas.push(_sp);
               }
                
            }
        }
        
//        
//
//        self.sub_maxs = [];
//        //탭 최대 갯수 10개까지 sub_max를 0으로 초기화
//        for(var i = 0 ; i < 10;i++){
//            self.sub_maxs.push(0);
//        }
//        //sub 탭 최대갯수를 먼저 구한다.
//        for(var i = 0 ; i < self.contentdatas.length; i++){        
//            var _tab = self.contentdatas[i].tab ? parseInt(self.contentdatas[i].tab) : -1;
//            if(_tab >= 0 && _tab < 10)
//                self.sub_maxs[_tab]++;            
//        }
//        //Tab 갯수를 구한다.
//        for(var i = 0 ; i < 10;i++){
//            if(self.sub_maxs[i] > 0)
//                self.tab_max++;
//        }
//    
//         //tab Setting
//        self.setTabButtons(this._data);
////        
////        //sub Setting
//        self.setSubButtons(this._data);
//        
         self.init(self._data);
        
        return true;
    },
    init:function(data){
        var self = this;
        var size = cc.winSize;
        var now_index = parseInt(data.tab);
        for(var i = 0; i < self.arr_titles.length;i++){
            self.arr_titles[i].setVisible(i == now_index ? true : false);
        }
        for(var i = 0; i < self.arr_icons.length;i++){
            self.arr_icons[i].setVisible(i == now_index ? true : false);
        }
        for(var i = 0; i < self.arr_maindatas.length;i++){
            self.arr_maindatas[i].setVisible(i == now_index ? true : false);
        }
    },
    getIFrameUrl: function(type, id, schoolapitype){
         var self = this;   
         var useschoolapi = self.now_contentdata.useschoolapi ? self.now_contentdata.useschoolapi : 0;
        if(schoolapitype && useschoolapi == 1){
            var fname = "contentdata/type_schooldata.html";
            return fname;
        }else{
            var fname = "";
            switch(type){
                case "html":
                    fname = "contentdata/type_image.html";
                    break;
                case "img":
                    fname = "contentdata/type_image.html";
                    break;
                case "board":
                    fname = "contentdata/type_board.html";
                    break;
                case "gallery":
                    fname = "contentdata/type_gallery.html";
                    break;
                default:

                    break;
            }
            return fname;
        }

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

        parent.addChild(this.webview, 999);
//        console.log("addWebView");
       
       //test 안됨 iframe 안에 Dom 내용 내께 아니라 수정불가
//        var script = `
//                document.getElementById("header").style.display = "none";
//                document.getElementById("footer").style.display = "none";
//                document.getElementById("quickMenu").style.display = "none";
//            `;
//       this.webview.evaluateJS(script);
           
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
        
        
        this.addWebView(this.sp_rect, 500+mx+10, 700+my, 1000, 1300, this.pageurl);
    },
    hideWebView: function() {
        if (this.webview) {
            this.webview.removeFromParent(true);
            this.webview = null;
        }
    },
//    setTabButtons:function(data){
//         var self = this;
//         var size = cc.winSize;
//        const tab_width = [0,1020,510,340,258,204,170,145,127,113];
//         var _tab = data.tab;
//         var _sub = data.sub;
////         var tab_size = [258,110];
//        var tab_size = tab_width[self.tab_max];
//         for(var i = 0 ; i < self.tab_max; i++){
//
//             C_AddTransparentButton(self, size.width / 2-515+i*tab_size, C_getY(357),tab_size, 110, 1000+i*10,  function (tag) {
//                
//                if(tag != _tab)self.buttonClick(tag);
//            });
//         }
//        
//        
//        
//        var now_ontab_url = "res/n_menu/tab"+_tab+".png";
//        for(var i =  0 ; i < self.all_id_sps.length;i++){
//            if(self.all_id_sps[i].imgurl.indexOf("res/n_menu/tab") >= 0 && self.all_id_sps[i].imgurl.indexOf("res/n_menu/tab_bg") < 0){
//                var isVisible = self.all_id_sps[i].imgurl == now_ontab_url ? true: false;                
//                self.all_id_sps[i].sp.setVisible(isVisible);
//            }
//            
//        }
//            
//    },
//    setSubButtons:function(data){
//        var self = this;
//        var size = cc.winSize;
//        const sub_width = [0,1020,510,340,255,204,170,145,127,113];
//        
//        var _tab = data.tab;
//        var _sub = data.sub;
//        var _sub_max = self.sub_maxs[_tab];
//        var sub_size = sub_width[_sub_max];
//        
////        var btn_len = [4,3,3,2];
////        var sub_size = [[255,76],[340,76],[340,76],[510,76]];  //[[width,height],[width,height],[width,height],..]
//        
//        for(var i = 0 ; i < _sub_max; i++){
//            const idx = i;
//            const sub_tag = 1000+_tab*10+i;//(_tab+1)*10+idx;
////            
////            console.log("sub_tag "+sub_tag);
//            C_AddTransparentButton(this, size.width / 2-510+i*sub_size, C_getY(440), sub_size, 76, sub_tag,  function (tag) {
//                
//                
//                 if(tag%10 != _sub)self.buttonClick(tag);
//            });            
//        }
//        
//        
//        
//        
//        //sub 배경그리기
//        var now_sub_bgtab_url = "res/n_menu/sub"+_tab+"_bg.png";
//        for(var i =  0 ; i < self.all_id_sps.length;i++){
//            if(self.all_id_sps[i].imgurl.indexOf("res/n_menu/sub") >= 0 && self.all_id_sps[i].imgurl.indexOf("_bg.png") >= 0){
//                var isVisible = self.all_id_sps[i].imgurl == now_sub_bgtab_url ? true: false;
//                
//                self.all_id_sps[i].sp.setVisible(isVisible);
////                C_AddSprite(self, "res/n_menu/sub"+_tab+"_bg.png", size.width / 2, C_getY(393),1,null,null);
//            }            
//        }
//        
//        
//        
//        
//        
////        //선택된 sub 그리기
//        var sprite_sx = [-382,-341,-341,-255];
//        
//        
//        
//        
//        var now_sub_tab_url = "res/n_menu/sub"+_tab+"_"+_sub+".png";
//        
//        for(var i =  0 ; i < self.all_id_sps.length;i++){
//            if(self.all_id_sps[i].imgurl.indexOf("res/n_menu/sub") >= 0 && self.all_id_sps[i].imgurl.indexOf("_bg.png") < 0){
//                
//                var isVisible = self.all_id_sps[i].imgurl == now_sub_tab_url ? true: false;
//                
//                self.all_id_sps[i].sp.setVisible(isVisible);
////                C_AddSprite(self, "res/n_menu/sub"+_tab+"_"+_sub+".png", size.width / 2 + sprite_sx[_tab] +_sub*sub_size[_tab][0], C_getY(393),1,null,null);
//            }            
//        }
//     
//        
//    },
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
