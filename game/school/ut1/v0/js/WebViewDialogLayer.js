var m_tag = {
};
//var g_menuLayer = null;
//var menu_instance = null;
var WebViewDialogLayer = cc.Layer.extend({
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
    json_pdf:null,
    language_code :"KO",
    now_tab:-1,
    webViewPage:"",
    wtime: 0,
    before_time: 0,
    sp_title:null,
    sw:0,
    sh:0,
    ctor: function () {
        //////////////////////////////
        // 1. super init first
        this._super();
//        this._data = data;
//        console.log("aaadata is ",data);
//        g_menuLayer = this;
        
//        C_PlaySound(SOUND.BGM);
        /////////////////////////////
        // 2. add a menu item with "X" image, which is clicked to quit the program
        //    you may modify it.
        // ask the window size
        var self = this;
        var size = cc.winSize;
//        this.addChild(new cc.LayerColor.create(cc.color(255, 255, 255, 255)));

//        m_tag = {};
//        self.sub_maxs = [];
//        self.sp_animation_righttoleft = [];
//        self.sp_animation_scale = [];
//        self.indicator_on = [];
//        
//        
////        C_Loading(self);
//        //////////////////////////////////////////////////////////////
//        //new module
//        //////////////////////////////////////////////////////////////
//    
//        self.homepage_data = getgamedata;
//        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
//        self.maindatas = JSON.parse(self.homepage_data.hm_main_data);
//        self.language_code = self.homepage_data.hm_language;
//        self.json_pdf = self.homepage_data.hm_videolist.length > 4 ? JSON.parse(self.homepage_data.hm_videolist)[self.language_code] : null;
//        self.now_tab = parseInt(data.tab);
//        ///////////////////////////////////////
//        //PDF 목록 테스트 START
//        ///////////////////////////////////////
//        
//        
        
//        self.json_pdf = [
//            {"id":"home_btn0", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn1", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn2", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn3", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn4", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn5", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn6", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn7", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn8", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn9", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn10", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn11", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn12", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn13", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            {"id":"home_btn14", "list":[{"id":"GF79-2025-00396", "company":"(주)한준건설", "workplace":"광명11R 1-1구간", "startdate":"2025-11-13","enddate":"2025-11-13", "registdate":"2025-11-05", "filename":"test.pdf"}]},
//            
//                        
//            {"id":"home_bottom_btn0", "list":[]},
//            {"id":"home_bottom_btn1", "list":[]},       
//            {"id":"home_bottom_btn2", "list":[]}                
//        ]
        ///////////////////////////////////////
        //PDF 목록 테스트 END
        ///////////////////////////////////////
        
    
//        
//        this.all_id_sps = [];
//        for(var i = 0 ; i < self.maindatas.length;i++){
//            m_tag[self.maindatas[i].id] = i;
//        }
////        for(var i = 0 ; i < 3;i++){//test
//        for(var i = 0 ; i < self.maindatas.length;i++){
//            if(self.maindatas[i].type == "animation"){
//                var ani_sps = C_setUI(self,size,self.maindatas[i]);
//                self.ani_datas.push({"id":self.maindatas[i].id, "anitime":self.maindatas[i].anitime, "nowindex":0, "ani_sps":ani_sps});
//            }
//            else {
//                var _sp = C_setUI(self,size,self.maindatas[i]);
//                if(self.maindatas[i].imgurl && self.maindatas[i].imgurl.indexOf("main_bg.png") >= 0)  //main_bg.png 이미지는 반드시 있어야한다.
//                    this.sp_rect = _sp;
//                console.log("self.maindatas[i].imgurl "+self.maindatas[i].imgurl);
//                if(self.maindatas[i].imgurl)self.all_id_sps.push({"imgurl":C_getResPath(self.maindatas[i].imgurl), "sp":_sp});
//                
//                //네모 하단 말풍선 포인트
//                if(self.maindatas[i].id == "main_mainrect_point")
//                    self.bg_point = _sp;
//                if(self.maindatas[i].animationtype == "righttoleft")
//                    self.sp_animation_righttoleft.push({"x":self.maindatas[i].x,"y":self.maindatas[i].y,"sp":_sp});
//                if(self.maindatas[i].animationtype == "scale")
//                    self.sp_animation_scale.push({"scale":self.maindatas[i].animationscale,"sp":_sp});
//                
//            }
//           
//        }
//        console.log("data is ",data);
////        C_AddCustomFont(self, data.name, 33, C_getY(178), null, 1, cc.TEXT_ALIGNMENT_LEFT , 40, C_HEXtoCCColor("#ffffff"),true);    
//        
//       
////        //탭 최대 갯수 10개까지 sub_max를 0으로 초기화
////        for(var i = 0 ; i < 10;i++){
////            self.sub_maxs.push(0);
////        }
////        //sub 탭 최대갯수를 먼저 구한다.
////        for(var i = 0 ; i < self.contentdatas.length; i++){        
////            var _tab = self.contentdatas[i].tab ? parseInt(self.contentdatas[i].tab) : -1;
////            if(_tab >= 0 && _tab < 10)
////                self.sub_maxs[_tab]++;            
////        }
////        //Tab 갯수를 구한다.
////        for(var i = 0 ; i < 10;i++){
////            if(self.sub_maxs[i] > 0)
////                self.tab_max++;
////        }
////        self.tab_max = 4; //고정한다.
//    
//         //tab Setting
////        self.setTabButtons(this._data);
////        
////        //sub Setting
////        self.setSubButtons(this._data);
//        
//         self.init(self._data);
//        
//        /////////////////////////////////////
//        //일정시간 입력없을때 홈으로가도록 설정
//        /////////////////////////////////////
//        this.enableInputTracking();
//        this.resetInactivityTimer(); // 최초 타이머 설정
//        C_checkSafetyDialogShow(self);
//        
//        this.initAnimationMoveTo();
//        
//        if(self.now_tab != 10)initEffectAnimation(self);  
//        
//        self.init();
        return true;
    },
    init:function(title,event,w,h, OKCallback, CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        self.html_string = event;
         var bgLayer = new cc.LayerColor(cc.color(32, 32, 32, 180));
        self.addChild(bgLayer, 0);
        var bgres = style && style.bgres ? style.bgres : res._global_img_ninepatch_bg;
//        var bgres = res._global_img_ninepatch_bg;
        self._bg = new cc.Scale9Sprite (bgres);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2;
        self._bg.width = w+40;
        self._bg.height = h+400;
        this.addChild (self._bg);
        var bg_width = self._bg.width;
        var bg_height = self._bg.height;

        var okres = style && style.okres ? style.okres : res.btn_ok;
        var cancelres = style && style.cancelres ? style.cancelres : res.btn_cancel;
              var titlecolor = cc.color(31,31,31);
        if(bgres == res._global_img_ninepatch_white_bg)
            titlecolor = cc.color(25,25,25);
        C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-80,1,1,cc.TEXT_ALIGNMENT_CENTER,30,titlecolor,true);
        
        
                 
        
//        self.updateBGUI(_tab);
//         this.schedule(this.update);
        
         C_AddAnimButton(self._bg,res.btn_ok,null,size.width/2,64,1,0.7,9999,function(tag){
                console.log("OK버튼클릭");
                self.buttonClick(tag);
                OKCallback();
                self.hideWebView();
                self._remove();
            },self);
        
         C_ShowAni(self._bg,null,function(){
            self.showWebView();   
         });
    },

   

   getIFrameUrl: function(event){
         var self = this;   
        var fname = "";
        
        ///html tag string 이다
        
         var type = event.type;
         var schoolapitype = event.schoolapitype ? event.schoolapitype : "";
         var useschoolapi = event.useschoolapi ? parseInt(event.useschoolapi) : 0;
         
        
        switch(type){
         case "html":
                fname = "../../../webpage/type_image.html";
                 if(schoolapitype && useschoolapi == 1)
                      fname = "../../../webpage/type_schooldata.html";
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
             case "game":
                fname = event.url ? "../../../../"+event.url : "";//flappybird
                break;
            default:
                fname = "../../../webpage/type_schooldata.html";
                break;
        }
        return fname;
        

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
        this.webview.setContentSize(w-40, h);
        this.webview.setAnchorPoint(0.5, 0.5);
        this.webview.setPosition(x, y);
        
        
//        var _param_schoolapitype = self.now_contentdata.schoolapitype ? "&apitype="+self.now_contentdata.schoolapitype : "";
//        var _param_gamemode = self.now_contentdata.gamemode ? "&gamemode="+self.now_contentdata.gamemode : "";        
//        var _param_surveyidx = self.now_contentdata.surveyidx ? "&surveyidx="+self.now_contentdata.surveyidx : "";
//        var _param_surveyonoff = self.now_contentdata.surveyonoff ? "&surveyonoff="+self.now_contentdata.surveyonoff : "";
//        var _param_pdf_category = "&languagecode="+self.language_code+"&pdfcategory="+this._data.id;
//        var _pdfpagetype = "";
//        if(this._data.id == this._data.id && self._data.webViewPage){
//            _pdfpagetype = "&pagetype="+self._data.webViewPage;
//           if(self._data.webViewPage != "list0") self.webViewPage = "list0";
//        }
        
         var wrapHtml = function(styledHtml) {
            return "<html>" +
                   "<head>" +
                   "<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>" + // 모바일 최적화 및 줌 방지
                   "</head>" +
                   "<body>" +
                   styledHtml + // 스타일과 div가 포함된 원본 문자열
                   "</body>" +
                   "</html>";
        };

        // ... 기존 addWebView 함수 내부 ...

        if (self.html_string) {
            // 1. 스타일이 적용된 문자열 생성
            var styled_html_string = "<style>" +
                                     "body { background-color: white; color: black; font-size: 30px; padding: 20px; line-height: 1.6; " +
                                     "overflow-y: scroll; -webkit-overflow-scrolling: touch; }" +
                                     "div { margin-bottom: 10px; }" +
                                     "</style>" +
                                     self.html_string;

            // 2. [핵심] 완벽한 HTML 구조로 감쌉니다.
            var final_html_string = wrapHtml(styled_html_string); 

            // 3. 최종 완성된 문서로 로딩합니다.
            this.webview.loadHTMLString(final_html_string, "http://localhost/"); 
            
//            this.webview.setPointerEvents("none");
            this.webview.loadURL("https://makesflat.co.kr");
        }else {
            this.webview.loadURL(pageurl+"?projectid="+param_projectid+"&groupidx="+param_groupidx+"&listid="+self.event.listid+_param_schoolapitype+_param_gamemode+_param_surveyidx+_param_surveyonoff+_param_editmode+_param_ishideadd+_param_ishideedit+_param_ishidedelete);    
        }
//        console.log("webview url is "+url);
        this.webview.loadURL(pageurl);
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
        
        console.log("pageurl ",this.pageurl);
//        this.addWebView(this.sp_rect, 1200+mx, 550+my, 1400, 787,  this.pageurl);//16:9  // 일반 비율
        this.addWebView(this.sp_rect, 540+mx, 920+my, 1040, 900,  this.pageurl);//4:3 power point 비율
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
        if(self.bg_point)self.bg_point.setPosition(135+idx*270,C_getY(1640));
        
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
    initAnimationMoveTo:function(idx){
        var self = this;
        var size = cc.winSize;
        var len = self.sp_animation_righttoleft.length;
        for(var i = 0 ; i < len; i ++){
            
            var x = self.sp_animation_righttoleft[i].x;
            var y = C_getY(self.sp_animation_righttoleft[i].y);
            var sp = self.sp_animation_righttoleft[i].sp;
            sp.setPosition(-500,y);
//                var move = cc.moveTo(0.13,x,y);
            // 이동 액션 생성 (0.5초 정도로 늘려야 부드러운 가속도 변화가 느껴집니다)
            var move = cc.moveTo(0.5, cc.p(x, y));

            // [핵심] 가속도가 점점 줄어드는 ExponentialOut 효과 적용
            var easeMove = move.easing(cc.easeExponentialOut());
            var delay = cc.delayTime(i*0.08);
            var seq = cc.Sequence.create(delay, easeMove);
            sp.runAction(seq);
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
    
    buttonClick: function(tag){
        var self = this;
        var size = cc.winSize;
        
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
       
       
        
    },
  
    _remove:function(){      
        var self = this;
        IS_SHOW_POPUP = false; 
        cc.log(this.getParent());//This Works fine   <--------------- ?
        var p = this.getParent();
        C_HideAni(self._bg,function(){
            self.runAction(cc.RemoveSelf.create());
        })
    }
   
});
//
//
//var GameScene = cc.Scene.extend({
//     ctor: function (data) {
//        this._super();
//        this._data = data; // 전달받은 data 저장
//    },
//
//    onEnter: function () {
//        this._super();
//        var layer = new WebViewDialogLayer(this._data); // Layer에 data 전달
//        this.addChild(layer);
//    }
//});
