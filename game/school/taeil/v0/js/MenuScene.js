var m_tag = {
    f1:100,
    f2:101,
    f3:102,
    f4:103,
    f5:104,
    f6:105,
    
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
    now_tab: -1,
    sp_titlebg:null,
    ani_datas : [],
    handcnt:0,
    language_code:"KO",
    floor:1,
    floor_btns : [],
    sp_map_bg : null,
    sp_place_bg : null,
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
        self.removeAllChildren();
        m_tag = {};
        self.sub_maxs = [];
        self.sp_animation_righttoleft = [];
        self.sp_animation_scale = [];
        self.indicator_on = [];
        
        C_Loading(self);
        //////////////////////////////////////////////////////////////
        //new module
        //////////////////////////////////////////////////////////////
    
        self.homepage_data = getgamedata;
        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
        self.maindatas = JSON.parse(self.homepage_data.hm_main_data);
        
        self.now_tab = parseInt(data.tab);
        console.log("now_tab is ",self.now_tab);
        
        self.language_code = self.homepage_data.hm_language;
    
        
        this.all_id_sps = [];
        for(var i = 0 ; i < self.maindatas.length;i++){
            m_tag[self.maindatas[i].id] = i;
        }
        m_tag["f1"] = "100";
        m_tag["f2"] = "101";
        m_tag["f3"] = "102";
        m_tag["f4"] = "103";
        m_tag["f5"] = "104";
        m_tag["f6"] = "105";
        
//        for(var i = 0 ; i < 3;i++){//test
        for(var i = 0 ; i < self.maindatas.length;i++){
            
            if(self.maindatas[i].id == "main_titlebg"){
                if(self.now_tab != 10)C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].id == "map_bg"){
                if(self.now_tab == 0)self.map_bg = C_setUI(self,size,self.maindatas[i]);
            }
           else if(self.maindatas[i].id == "map_bg_text"){
                if(self.now_tab == 0)C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].id == "place_bg"){
                if(self.now_tab == 0)self.place_bg = C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].id.indexOf("main_btn") >= 0){
                if (self.maindatas[i].id == "main_btn1" && self.now_tab == 0)
                    C_setUI(self,size,self.maindatas[i]);
                else if(self.maindatas[i].id == "main_btn2" && self.now_tab == 1)
                    C_setUI(self,size,self.maindatas[i]);
            }
            else if(self.maindatas[i].type == "animation"){
                var ani_sps = C_setUI(self,size,self.maindatas[i]);
                self.ani_datas.push({"id":self.maindatas[i].id, "anitime":self.maindatas[i].anitime, "nowindex":0, "ani_sps":ani_sps});
                ani_sps[0].setVisible(false);
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

         self.init(self._data);
        
        /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정

        
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
            console.log(" _tab is "+_tab+"  ttt "+self.contentdatas[i].tab);
            if(self.contentdatas[i].tab == _tab && self.contentdatas[i].sub == _sub){
                self.now_contentdata = self.contentdatas[i];
                break;
            }
        }
//        
        console.log("alllist is ",alllist);
//        if(self.now_contentdata){
//             var schoolapitype = self.now_contentdata.schoolapitype ? self.now_contentdata.schoolapitype : "";
//             
//             this.pageurl = self.getIFrameUrl(self.now_contentdata.type, self.now_contentdata.id, schoolapitype);
//            setTimeout(function(){
//             self.showWebView();   
//            },100);
//             
//            
//        }    
//        self.updateBGUI(_tab);
//        if(self.now_tab == 10){
//            console.log("행사안내");
//             self.isPosterScene = true;
//            self.hideWebView();
//            self.drawPoster();
//        }
        //층별 안내
        if(self.now_tab == 0){
            self.floor_btns = [];
             self.now_floordata = json_floor.floordata[self.floor-1];
           
            for(var i = 0 ; i < 6; i++){
                const floor = i+1;
                var txt_f = self.language_code == "KO" ? floor+"층" : floor+"F";
                var normal_textdata = {"x": 70,"y": 60,"message": txt_f ,"fontsize": 50,"fontweight": "bold","color": "#818285","textalign": "center"};
                var on_textdata = {"x": 70,"y": 60,"message": txt_f ,"fontsize": 50,"fontweight": "bold","color": "#ffffff","textalign": "center"};
                 //층별안내 버튼        
                C_AddSpriteTouch(self,"res/btn_f.png",  150+i*155,C_getY(422),(100+i)+"",1,null, function(tag) {
                    if(self.floor != floor){
                        self.floor = floor; 
                        self.buttonClick(tag);
                    }   
                },normal_textdata);
                
                
                var floor_btn = C_AddSprite(self, "res/btn_f_on.png", 150+i*155,C_getY(422), null, 1, null, null, null, on_textdata);
                self.floor_btns.push(floor_btn);
            }
            
            
            
//            
//            //층별안내 버튼        
//            C_AddAnimButton(self, "res/btn_1f.png" ,null, 150,C_getY(422),m_tag.f1,1,null,function(tag){
//                if(self.floor != 1){
//                    self.floor = 1; 
//                    self.buttonClick(tag);
//                }
//            },self);
//            C_AddAnimButton(self, "res/btn_2f.png" ,null, 305,C_getY(422),m_tag.f2,1,null,function(tag){
//                if(self.floor != 2){
//                    self.floor = 2; 
//                    self.buttonClick(tag);
//                }
//            },self);
//            C_AddAnimButton(self, "res/btn_3f.png" ,null, 460,C_getY(422),m_tag.f3,1,null,function(tag){
//                if(self.floor != 3){
//                    self.floor = 3; 
//                    self.buttonClick(tag);
//                }
//            },self);
//            C_AddAnimButton(self, "res/btn_4f.png" ,null, 615,C_getY(422),m_tag.f4,1,null,function(tag){
//                if(self.floor != 4){
//                    self.floor = 4; 
//                    self.buttonClick(tag);
//                }
//            },self);
//            C_AddAnimButton(self, "res/btn_5f.png" ,null, 770,C_getY(422),m_tag.f5,1,null,function(tag){
//                if(self.floor != 5){
//                    self.floor = 5; 
//                    self.buttonClick(tag);
//                }
//            },self);
//            C_AddAnimButton(self, "res/btn_6f.png" ,null, 925,C_getY(422),m_tag.f6,1,null,function(tag){
//                if(self.floor != 6){
//                    self.floor = 6; 
//                    self.buttonClick(tag);
//                }
//            },self);
//
//            
//            "text": {
//            "KO": {
//                "x": 220,
//                "y": 60,
//                "message": "층별안내",
//                "fontsize": 55,
//                "fontweight": "bold",
//                "color": "#000000",
//                "textalign": "center"
//            },
//            "EN": {
//                "x": 220,
//                "y": 60,
//                "message": "Floor Guide",
//                "fontsize": 55,
//                "fontweight": "bold",
//                "color": "#000000",
//                "textalign": "center"
//            }
//        }
//            var txt_1f = self.language_code == "KO" ? "1층" : "1F";
//            var txt_2f = self.language_code == "KO" ? "2층" : "2F";
//            var txt_3f = self.language_code == "KO" ? "3층" : "3F";
//            var txt_4f = self.language_code == "KO" ? "4층" : "4F";
//            var txt_5f = self.language_code == "KO" ? "5층" : "5F";
//            var txt_6f = self.language_code == "KO" ? "6층" : "6F";
//            var on_textdata = {"x": 66,"y": 51,"message": txt_1f ,"fontsize": 40,"fontweight": "bold","color": "#ffffff","textalign": "center"};
//            var floor_btn1 = C_AddSprite(self,  "res/btn_1f_on.png", 150,C_getY(422),1,null,null);
//            var floor_btn2 = C_AddSprite(self,  "res/btn_2f_on.png", 305,C_getY(422),1,null,null);
//            var floor_btn3 = C_AddSprite(self,  "res/btn_3f_on.png", 460,C_getY(422),1,null,null);
//            var floor_btn4 = C_AddSprite(self,  "res/btn_4f_on.png", 615,C_getY(422),1,null,null);
//            var floor_btn5 = C_AddSprite(self,  "res/btn_5f_on.png", 770,C_getY(422),1,null,null);
//            var floor_btn6 = C_AddSprite(self,  "res/btn_6f_on.png", 925,C_getY(422),1,null,null);
//
//            self.floor_btns.push(floor_btn1);
//            self.floor_btns.push(floor_btn2);
//             self.floor_btns.push(floor_btn3);
//             self.floor_btns.push(floor_btn4);
//             self.floor_btns.push(floor_btn5);
//             self.floor_btns.push(floor_btn6);

            self.clickFloor();
            
           
            self.initMap(self.map_bg, self.floor);
           
        }
        //예약현황
        else {
            self.drawReservationList();
            
        }
         console.log("self is ",self);
        this.schedule(this.update);
    },
    drawReservationList:function(){
        var self = this;
        let sps = [];
        for (let i = 0; i < alllist.length; i++) {
            var data = alllist[i];
            let sp = new cc.Sprite("res/n_menu/sample.png"); // 이미지 자원 필요
            const title = data.lt_title.length > 28 ? data.lt_title.substr(0,28)+".." : data.lt_title;
            const subtitle = data.lt_subtitle.length > 30 ? data.lt_subtitle.substr(0,20)+".." : data.lt_subtitle;
            
            C_AddCustomFont(sp, title,70, 220, null, 1, cc.TEXT_ALIGNMENT_LEFT , 40, C_HEXtoCCColor("#000000"),true);    
            C_AddCustomFont(sp, data.lt_startdate.substr(0,16)+"~"+data.lt_enddate.substr(0,16), 80, 150, null, 1, cc.TEXT_ALIGNMENT_LEFT , 30, C_HEXtoCCColor("#777777"),false);    
            self.createNinePatchText(sp, res._global_img_ninepatch_blueline_bg, subtitle, 80,  85, cc.TEXT_ALIGNMENT_LEFT , C_HEXtoCCColor("#00afef"), function(){});
            
            sps.push(sp);
        }
//        C_layoutSpriteListInArea(self.sp_rect, sps, 1080,1253,923,314);
        var scrollView = C_createScrollableSpriteList(self, sps, 1080,1253,1080,314,10);
//        self.sp_rect.addChild(scrollView);
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
            
            console.log("self.loadImages ",res);
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
        if(self.now_contentdata.indicator)this.initIndecator(self.now_contentdata.indicator);
    },
    
   
    initIndecator : function(indicator){
        
        var self = this;
        var len = this.imageData.length;
        console.log("this.imageList ",this.imageList);
        var offset = len/2*40;
        for(var i = 0;i < len; i++){            
            C_AddSprite(self,res.indicator_normal, indicator.x-offset+i*40, C_getY(indicator.y),1,2,null);
            this.indicator_on.push(C_AddSprite(self,res.indicator_on, indicator.x-offset+i*40, C_getY(indicator.y),1,2,null));            
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
       
        this.isSliding = true;

        var imgfoldername = self.now_contentdata.imgfoldername ? self.now_contentdata.imgfoldername : "gallery2";
        const imgPath = "contentdata/"+imgfoldername+"/" + this.imageData[index].filename;
//        const newSlide = new cc.Sprite(imgPath);
        const MY = 808;
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
            const scaleY = 1546 / textureSize.height;
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

    wtime : 0,
    update: function (dt) {

        var self = this;
        this.wtime += dt;
        this.handcnt++;
        var nowtime = Math.floor(this.wtime);
       for(var i = 0 ; i < self.ani_datas.length;i++)
            C_updateAnimation(self.ani_datas[i], this.wtime);
    },
   

    nextSlide: function (withAnimation) {
        self.startAutoSlide();  // 타이머 리셋
        var self = this;
        if(this.imageData.length <= 1)return;
        
        
        
        this.currentIndex = (this.currentIndex + 1) % this.imageData.length;
        this.showSlide(this.currentIndex, withAnimation, "left");
        C_checkAutoUpdate();
    },

    prevSlide: function (withAnimation) {
         self.startAutoSlide();  // 타이머 리셋
        var self = this;
        if(this.imageData.length <= 1)return;
       
        
        this.currentIndex = (this.currentIndex - 1 + this.imageData.length) % this.imageData.length;
        this.showSlide(this.currentIndex, withAnimation, "right");
    },
    before_touchx : -1, //터치시 홈화면으로 이동  START
    before_touchy : -1, //터치시 홈화면으로 이동  START
   
    addTouchHandlers: function () {
        const self = this;
        let startX = 0;
        
        if(self.isPosterScene){
             const listener = cc.EventListener.create({
                event: cc.EventListener.TOUCH_ONE_BY_ONE,
                swallowTouches: true,

                onTouchBegan: function (touch) {
                     startX = touch.getLocation().x;
                    startY = touch.getLocation().y;
                    
                    self.before_touchx = startX;
                    self.before_touchy = startY;
                    return true;
                },

                onTouchEnded: function (touch) {
                     if(self.imageData.length <=    1)return;    
                    
                    const endX = touch.getLocation().x;
                    const endY = touch.getLocation().y;
                    const delta = endX - startX;
                    
                    // 👉 자동 슬라이드 리셋
                    
                   
                    if (Math.abs(delta) > 50) {
                        if (delta < 0) {
                            self.nextSlide(true); // 왼쪽 슬라이드
                        } else {
                            self.prevSlide(true); // 오른쪽 슬라이드
                        }
                    }
                    
                    ////////////////////////////////////////
                    //터치시 홈화면으로 이동  START
                    ////////////////////////////////////////
                    if (self.now_tab == 10 && parseInt(self.now_contentdata.isfirstscene) == 1) {
                         const deltaX = endX - self.before_touchx;
                        const deltaY = endY - self.before_touchy;
                        const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
                        const CLICK_THRESHOLD = 15; // 클릭으로 판단할 최대 이동 거리
                        if (distance < CLICK_THRESHOLD) {
                            console.log("같은위치클릭했다. 홈화면이동");
                            C_nextScene(SCENE_HOME, null);
                        }
                    }
                    ////////////////////////////////////////
                    //터치시 홈화면으로 이동  END
                    ////////////////////////////////////////
                    
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
        AJAX_AdmGetGame("getgallerydata", _data, function(res){
            console.log("MenuScene 11 이미지로드했다. is ",res);
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
         var useschoolapi = self.now_contentdata.useschoolapi ? self.now_contentdata.useschoolapi : 0;
        if(schoolapitype && useschoolapi == 1){
            var fname = "../../../webpage/type_schooldata.html";
            return fname;
        }else{
            var fname = "";
            switch(type){
                case "html":
                    fname = "../../../webpage/type_image.html";
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
    //index.html mWebview 를 사용한다.  //real 사이즈로 보여지며 pixel로 보여짐
    addWebView_Other: function(parent, x, y, w, h, pageurl) {
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
        
        var _param_schoolapitype = self.now_contentdata.schoolapitype ? "&apitype="+self.now_contentdata.schoolapitype : "";
        var _param_gamemode = self.now_contentdata.gamemode ? "&gamemode="+self.now_contentdata.gamemode : "";        
        var _param_surveyidx = self.now_contentdata.surveyidx ? "&surveyidx="+self.now_contentdata.surveyidx : "";
        var _param_surveyonoff = self.now_contentdata.surveyonoff ? "&surveyonoff="+self.now_contentdata.surveyonoff : "";
        
        mWebView.src = pageurl+"?projectid="+param_projectid+"&groupidx="+param_groupidx+"&listid="+self.now_contentdata.id+_param_schoolapitype+_param_gamemode+_param_surveyidx+_param_surveyonoff;
        mWebView.style.display = "block";
                        
        //iframe 클릭했을때 이벤트 받는다.
        initIframeTouchEvent(self);

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
    showWebView_Other: function() {
       var self = this;
         // 실제 브라우저 화면 크기
        var screen_width = $(window).width();
        var screen_height = $(window).height();

        // 캔버스 고정 해상도
        var canvas_width = param_sw;
        var canvas_height = param_sh;

       
       
        var csize = getFittedCanvasSize(screen_width,screen_height);
        var x = (screen_width-csize.w)/2;
        var y = (screen_height-csize.h)/2;
        var w = csize.w;
        var h = csize.h;
        var scale = csize.s;
        
        y = 350*scale;
        h = h-500*scale;//갤러리2일때 웹뷰높이 재조정 
        console.log("x: "+x+" y: "+y+" w: "+w+" h: "+h+ "scale : "+scale);
        this.addWebView(this.sp_rect, x,y,w,h, this.pageurl);
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
        
        
        this.addWebView(this.sp_rect, 540+mx, 950+my, 1080, 1290, this.pageurl);
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
     clickFloor:function(){
        var self = this;
        var idx = self.floor-1;
        
        for(var i = 0 ; i < self.floor_btns.length;i++){
            self.floor_btns[i].setVisible(false);
            self.floor_btns[i].setScale(1);
        }
            
        
        
        if(idx >= 0){
            self.floor_btns[idx].setVisible(true);
            var scale = cc.scaleTo(0.3,1,1);
            self.floor_btns[idx].runAction(scale);
        }
    },
    place_btns: [],
    initMap:function(parent, floor){
        
        console.log("initMap");  
        var self = this;
        var size = cc.winSize;
        
        
        self.now_floordata = json_floor.floordata[self.floor-1];
        var mapBgW = 912;
        var mapBgH = 774;
        
        var placeBgW = 912;
        var placeBgH = 774;
        var place_btns = [];
        
        self.map_bg.removeAllChildren();
        self.place_bg.removeAllChildren();
        
        console.log("mapBgH/2+36 "+(mapBgH/2+36));
        C_AddSprite(parent,"contentdata/img/map"+floor+".png", mapBgW/2,mapBgH/2+36,null);
        C_AddCustomFontNew(parent, floor+"F", size.width-260, size.height/2-270, null, 1, cc.TEXT_ALIGNMENT_CENTER , 80,  C_HEXtoCCColor("#000000"),true);    
        var numtxt = ["①","①","②","③","④","⑤","⑥","⑦","⑧","⑨","⑩","⑪","⑫","⑬","⑭","⑮"];
      
        
        if(self.now_floordata && self.now_floordata.data){
            const datalen = self.now_floordata.data.length
            for(var i = 0 ; i < self.now_floordata.data.length;i++){
                const data = self.now_floordata.data[i];
                const datax = parseInt(data.x);
                const datay = parseInt(data.y);
    //            const imgres = data.event.img;
                const idx = i;


                var num = i+1;
                const title = numtxt[num]+" "+data.title;

//                console.log("now_floordata.data ",self.now_floordata.data);
                C_AddAnimButton(parent, "res/n_menu/num"+num+".png" ,null, datax, mapBgH-datay, (i+100)+"",1,null,function(tag){
//                    console.log("click tag is "+tag);
                    self.getNowImageFileNames(datalen, function(filenames){
//                        console.log("filenames ",filenames);
                       var imagedatas= [];
                        var numcount = 0;
                        var before_txt = "";
                        const clickNum = parseInt(tag)-100;
                        var clickIndex = 0;
                        for(var i = 0 ; i < filenames.length;i++){
                            
                            var arr = filenames[i].split("_");
//                            console.log(i+" filenames[i] is "+filenames[i]);
                            if(before_txt != arr[2]){
                                numcount++;
                                before_txt = arr[2];
                                if(clickNum == numcount-1)clickIndex = i;
                            }
                            var _mtitle = numtxt[numcount]+" "+self.now_floordata.data[parseInt(arr[2])].title;
                            
                            imagedatas.push({"title" : _mtitle , "filename":filenames[i]});    
                        }
//                       console.log("imagedatas ",imagedatas);
                        C_ShowImageDialogLayer(self, clickIndex , "", imagedatas, function(){

                        });       
                    });

                },self);

                if(data.title){
                    const place_btn = self.createNinePatchButton(self.place_bg, res._global_img_ninepatch_whiteline_bg, num, data, function(tag){
//                         console.log("tag ",tag);
                        self.getNowImageFileNames(datalen, function(filenames){
//                            console.log("bottom tag ",tag);
                            var imagedatas= [];
                            var numcount = 0;
                            var before_txt = "";

                            const clickNum = parseInt(tag.split("_")[1]);
                            var clickIndex = 0;
                            for(var i = 0 ; i < filenames.length;i++){

                                var arr = filenames[i].split("_");
                                if(before_txt != arr[2]){
                                    numcount++;
                                    before_txt = arr[2];
                                    if(clickNum == numcount)clickIndex = i;
                                }
//                                var _mtitle = numtxt[numcount]+" "+arr[1];
                                var _mtitle = numtxt[numcount]+" "+self.now_floordata.data[parseInt(arr[2])].title;
                               imagedatas.push({"title" : _mtitle , "filename":filenames[i]});    
                            }

                            C_ShowImageDialogLayer(self, clickIndex , "", imagedatas, function(){

                            });       
                        }); 
                    });
                    place_btns.push(place_btn);
                }
                
            }
        
        }
        
        self.layoutButtonsCenter(place_btns,1080,237,1000,80,20);
    },
    getNowImageFileNames: function(datalen, callback){
        var self = this;
        
        var floorname = self.now_floordata.fname;
        var titlenames = [];
        var titleidxs = [];
        //버튼클릭시 해당층 모든이미지 구할때
        for(var i = 0 ; i < datalen; i++){
            titlenames.push(self.now_floordata.data[i].title);
            titleidxs.push(i);
        }
            
            
        var floor_idx = self.floor-1; //인덱스
        
        var _data = {
            "projectid":param_projectid,
            "groupidx":param_groupidx,           
            "floorname" : floorname,
            "imgfoldername" : "floor",
            "titlenames" : titlenames
        }
        
         
        var _data = {
            "projectid":param_projectid,
            "groupidx":param_groupidx,           
            "flooridx":floor_idx,
            "titleidxs":titleidxs,
            "floorname" : floorname,
            "imgfoldername" : "floor",
            "titlenames" : titlenames,
            "languagecode":self.language_code
        }
        
        AJAX_AdmGetGame("getfloorimageres", _data, function(res){
//            console.log("MenuScene 11 이미지로드했다. is ",res);
           code = parseInt(res.code);
           if (code == 100) {
               if(callback)callback(res.message);
           }
        });
    },
    
    layoutButtonsCenter: function(buttons, containerWidth, containerHeight, maxLineWidth, buttonHeight, spacing) {
        var lines = [];
        var currentLine = [];
        var currentLineWidth = 0;

        // 1. 줄별로 버튼 분리
        for (var i = 0; i < buttons.length; i++) {
            var btn = buttons[i];
            var btnWidth = btn.width;

            if (currentLineWidth + btnWidth + (currentLine.length > 0 ? spacing : 0) > maxLineWidth) {
                lines.push(currentLine);
                currentLine = [];
                currentLineWidth = 0;
            }

            currentLine.push(btn);
            currentLineWidth += btnWidth + (currentLine.length > 1 ? spacing : 0);
        }

        if (currentLine.length > 0) {
            lines.push(currentLine);
        }

        var totalHeight = lines.length * buttonHeight + (lines.length - 1) * spacing;

        var startY = containerHeight / 2 + totalHeight / 2 - buttonHeight / 2;

        // 2. 각 줄에 버튼 배치
        for (var row = 0; row < lines.length; row++) {
            var line = lines[row];

            // 줄의 실제 총 너비 계산 (버튼 너비 + 간격)
            var lineWidth = 0;
            for (var j = 0; j < line.length; j++) {
                lineWidth += line[j].width;
            }
            lineWidth += (line.length - 1) * spacing;

            // 줄의 시작 X 좌표 (가운데 정렬)
            var startX = containerWidth / 2 - lineWidth / 2;

            // 버튼 배치
            var x = startX;
            var y = startY - row * (buttonHeight + spacing);

            for (var j = 0; j < line.length; j++) {
                var btn = line[j];
                btn.setPosition(x + btn.width / 2, y);
                x += btn.width + spacing;
            }
        }
    },
    createNinePatchText:function(parent, res, str, x,y,anchor, color, callback){
        var self = this;
        var size = cc.winSize;
        var _bg = new cc.Scale9Sprite (res);
        var fontsize = 30;
        if(!str)return;
        _bg.x = x;
        _bg.y = y;
        _bg.width = str.length * fontsize+50;
        _bg.height = 58;
        _bg.setAnchorPoint(0,0.5);
        
        C_AddCustomFont(_bg, str, _bg.width/2, _bg.height/2-5, null, 1, cc.TEXT_ALIGNMENT_CENTER , fontsize, color,false);    
        parent.addChild(_bg);
        return _bg;
        
    },
    createNinePatchButton:function(parent, res, num, data, callback){
        var self = this;
        var size = cc.winSize;
        
        
        
        var btn = C_AddAnimButton(parent, res ,null, 100,100, "tag_"+num,1,null,function(tag){

        },self);
        

        var numtxt = ["①","①","②","③","④","⑤","⑥","⑦","⑧","⑨","⑩","⑪","⑫","⑬","⑭","⑮"];
        var _bg = new cc.Scale9Sprite (res);
        _bg.x = 0;
        _bg.y = 0;
       
        var cw = this.calcTextWidth(data.title,data.fontsize);
        _bg.width = cw;
        _bg.height = 80;
        btn.width = cw;
        btn.height = 80;
        
        var color = data.fontcolor ? data.fontcolor : "#313131";
        
        C_AddCustomFont(_bg, numtxt[num]+" "+data.title, _bg.width/2, _bg.height/2-5, null, 1, cc.TEXT_ALIGNMENT_CENTER , data.fontsize, C_HEXtoCCColor(color),false);    
        btn.addChild (_bg);
        var bg_width = _bg.width;
        var bg_height = _bg.height;
        
          C_AddTransparentButton(_bg, 0,0,cw,80,"tag_"+num,  function (tag) {
             callback(tag);
        });
        
        return btn;
    },
     // ✅ 너비 계산 (한글 1, 영어 0.5 비율)
    calcTextWidth: function(text, fontsize) {
        var width = 0;
        for (var i = 0; i < text.length; i++) {
            var ch = text.charAt(i);
            width += (/[\uAC00-\uD7A3]/.test(ch)) ? 1 : 0.5;
        }
        return width * fontsize + 70;
    },
    buttonClick: function(tag){
        var self = this;
        var size = cc.winSize;
        
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        
        if(self.now_tab == 0){
             switch(tag){
                case m_tag.f1:
                    self.floor = 1;
                    self.initMap(self.map_bg, self.floor);
                    break;
                case m_tag.f2:
                    self.floor = 2;
                    self.initMap(self.map_bg, self.floor);
                    break;
                case m_tag.f3:
                    self.floor = 3;
                    self.initMap(self.map_bg, self.floor);
                    break;
                case m_tag.f4:
                    self.floor = 4;
                    self.initMap(self.map_bg, self.floor);
                    break;
                case m_tag.f5:
                    self.floor = 5;
                    self.initMap(self.map_bg, self.floor);
                    break;
                 case m_tag.f6:
                    self.floor = 6;
                    self.initMap(self.map_bg, self.floor);
                    break;
            }  
            self.clickFloor();
        }
            
        
        
         if(tag.indexOf("floor_") >= 0){
//                console.log("층별안내클릭했다!!");
                var arr = tag.split("_");
                var findex = arr[1];
                var dindex = arr[2];
                self.mapdatas = [];


                for(var i = 0 ; i < self.contentdatas.length;i++){
                    if(self.contentdatas[i].type == "mapimg")
                        self.mapdatas.push(self.contentdatas[i]);
                }


                var event = {
                    "page": "main",
                    "tab": 0,
                    "sub": "0"
               }
              C_nextScene(SCENE_MENU, event);   
              C_PlaySound(SOUND.SND_BUTTONTOUCH);

                
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

//                            var mapdatas = [];
//                            for(var i = 0 ; i < self.contentdatas.length;i++){
//                                if(self.contentdatas[i].type == "mapimg")
//                                    mapdatas.push(self.contentdatas[i]);
//                            }
//
//                             C_ShowMapDialogLayer(self,"","",mapdatas, function(){
//            //                    C_AndroidCall("closeWebView","close");
//            //                     self.showHideWebView(true);
////                                 self.showWebView();
//
//                            },null); 


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
           home_scene == SCENE_MENU && home_data.tab && this.now_contentdata && this.now_contentdata.tab && parseInt(home_data.tab) != parseInt(this.now_contentdata.tab) || 
           home_scene == SCENE_MENU && home_data.sub && this.now_contentdata && this.now_contentdata.sub && parseInt(home_data.sub) != parseInt(this.now_contentdata.sub))
            gotoHomeScene();
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
