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
    cloud0 : null,
    cloud1 :null,
    all_id_sps : [],
    now_contentdata : null,
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
        var size = cc.winSize;
        
        //배경색
//        this.addChild(new cc.LayerColor.create(cc.color(255, 255, 255, 255)));
       
        
        self.homepage_data = getgamedata;
        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
        self.homedatas = JSON.parse(self.homepage_data.hm_home_data);
        console.log("logo self.homedatas ",self.homedatas);
        
        self.all_id_sps = [];
        checkFirstScene(self.contentdatas);
        
        l_tag = {};
        self.sp_noticelist = [];
        for(var i = 0 ; i < self.homedatas.length;i++){
            l_tag[self.homedatas[i].id] = i;
        }
        for(var i = 0 ; i < self.homedatas.length;i++){
            if(self.homedatas[i].id == "home_cloud0"){
                 self.cloud0 = C_setUI(self,size,self.homedatas[i]);
            }
            else if(self.homedatas[i].id == "home_cloud1"){
                self.cloud1 = C_setUI(self,size,self.homedatas[i]);
            }
            else if(self.homedatas[i].type == "animation"){
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
                 var _sp = C_setUI(self,size,self.homedatas[i]);
                if(self.homedatas[i].imgurl && self.homedatas[i].imgurl.indexOf("main_bg.png") >= 0)  //main_bg.png 이미지는 반드시 있어야한다.
                    this.sp_rect = _sp;
//                C_setUI(self,size,self.homedatas[i]);
            }
        }
        
        
        //최초에만 로드하고 이후에는 로드하지 않음
        if(notice_datas.length == 0){
            C_getListData("home", 1, 5, function(noticelist){
                 notice_datas = noticelist;
                 self.initNoticeList(self.isShowMd);
            });
            
        }else {
            self.initNoticeList(self.isShowMd);
        }
       
        
        this.schedule(this.update);
        console.log("logo scene");
        
        //미세먼지수치 구하기
//        getAirData(function(airdata_str){
//            console.log("airdata ",airdata_str);
//            var airdata =  airdata_str != "" ? JSON.parse(airdata_str) : {};
//            if(airdata.response && airdata.response.body && airdata.response.body.items && airdata.response.body.items.length > 0){
//                var item = airdata.response.body.items[0];
//                var dustInfo = getDustLevelInfo(item.pm10Value, item.pm25Value);
//                //dustInfo.grade // 예 : 좋음
//                //dustInfo.iconClass // 예 : icon-good
////                drawProgressArc(self, item.pm10Value);
//                drawProgressArc(self, 100, C_getY(100),  250, 300, 80, 40, 30); 
//            }
//                
//        });
        
//        getWeatherData(function(weatherdata_str){
//            var weatherdata = weatherdata_str != "" ? JSON.parse(weatherdata_str) : {};
//           console.log("weatherdata ",weatherdata);
//            
//        });
        
        
         /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
        C_checkSafetyDialogShow(self);
        
        C_LeftRightRepeatAni(self.cloud0,30,-600);
        C_LeftRightRepeatAni(self.cloud1,40,600);
        
        this.init();
        return true;
    },
    init:function(){
        var self = this;
        self.now_contentdata = null;
         for(var i = 0 ; i < self.contentdatas.length;i++){
            if(self.contentdatas[i].tab == 100){
                self.now_contentdata = self.contentdatas[i];
                break;
            }
        }
         this.drawPoster();
    },
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
    
    update: function (dt) {
         
        var self = this;
        this.wtime += dt;
        var nowtime = Math.floor(this.wtime);
        
         for(var i = 0 ; i < self.ani_datas.length;i++)
            C_updateAnimation(self.ani_datas[i], this.wtime);
        C_updateDateTime(self.sp_md,self.sp_hhmm,self.sp_weekday,this.wtime);
        C_updateWeatherAir(self.obj_weather, self.obj_air, this.wtime);//날씨 , 미세먼지 업데이트
        
        C_checkAutoUpdate();
        C_checkSafetyData(this.wtime);//재난안전문자

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
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        for(var i = 0 ; i < self.homedatas.length;i++){
            if(tag == self.homedatas[i].id){
                var event = self.homedatas[i].event ? self.homedatas[i].event : null; 
                
                if(event){
                    if(event.page == "home" || event.page == "main"){
                        var scene = event.page == "main" ? SCENE_MENU : SCENE_HOME;
                        var data = event;                    
                        C_nextScene(scene, data);                       
                    }
                    else if(event.page == "speak"){
                         C_ShowSpeakDialogLayer(self, "음성인식" , "음성으로 말해주세요.", function(){
                             
                         });
                    }
                     else if(event.page == "lyrics"){
                        C_nextScene(SCENE_LYRICS, data);                       
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
    
     /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 START
    /////////////////////////////////////////////////////////////////
    imageData: [],
    currentIndex: 0,
    slideSprite: null,
    isSliding: false,
    isPosterScene : true, //포스터 씬일때만 슬라이드 터치가 되도록한다.
    indicator_on : [],
    drawPoster: function (){
         var self = this;   
        self.loadImages(1,20,function(res){
            
            console.log("self.loadImages ",res);
           self.initSwiperLayer(res);
            
            
        });
    },
    initSwiperLayer : function (imageList){
        var self = this;
        this.imageData = imageList;
        this.currentIndex = 0;
        this.indicator_on = [];
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
        var offset = len/2*20;
        for(var i = 0;i < len; i++){            
            C_AddSprite(self,res.indicator_normal, indicator.x-offset+i*20, C_getY(indicator.y),1,1,null);
            this.indicator_on.push(C_AddSprite(self,res.indicator_on, indicator.x-offset+i*20, C_getY(indicator.y),1,1,null));            
        }
        this.updateIndicator();
        
    },
    updateIndicator:function(){
        var self = this;
        for(var i = 0;i < this.indicator_on.length; i++){            
            this.indicator_on[i].setVisible(false);            
        }
        console.log("currentIndex ", this.currentIndex);
       if(this.indicator_on[this.currentIndex])this.indicator_on[this.currentIndex].setVisible(true);
    },
    showSlide: function (index, withAnimation, direction = "left") {
        var self = this;
        if (this.isSliding) return;
       
        this.isSliding = true;

        var imgfoldername = self.now_contentdata.imgfoldername ? self.now_contentdata.imgfoldername : "gallery2";
        const imgPath = "contentdata/"+imgfoldername+"/" + this.imageData[index].filename;
//        const newSlide = new cc.Sprite(imgPath);
        const MY = 190;
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
            const scaleY = 380 / textureSize.height;
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

//        var self = this;
//        this.wtime += dt;
//        this.handcnt++;
//        var nowtime = Math.floor(this.wtime);
//       for(var i = 0 ; i < self.ani_datas.length;i++)
//            C_updateAnimation(self.ani_datas[i], this.wtime);
//        
//         if(self.now_tab != 10)C_updateDateTime(self.sp_md,self.sp_hhmm,self.sp_weekday,this.wtime);
//        
//        
         var self = this;
        this.wtime += dt;
        var nowtime = Math.floor(this.wtime);
        
       
        C_updateDateTime(self.sp_md,self.sp_hhmm,self.sp_weekday,this.wtime);
        C_updateWeatherAir(self.obj_weather, self.obj_air, this.wtime);//날씨 , 미세먼지 업데이트
        
        C_checkAutoUpdate();
        C_checkSafetyData(this.wtime);//재난안전문자
    },
   
    startAutoSlide: function () {
        const self = this;
        
        this.schedule(function () {
            
            self.nextSlide(true);
            
        }, 20);
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
                    self.startAutoSlide();  // 타이머 리셋
                   
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
//                    if (self.now_tab == 10 && parseInt(self.now_contentdata.isfirstscene) == 1) {
//                         const deltaX = endX - self.before_touchx;
//                        const deltaY = endY - self.before_touchy;
//                        const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);
//                        const CLICK_THRESHOLD = 15; // 클릭으로 판단할 최대 이동 거리
//                        if (distance < CLICK_THRESHOLD) {
//                            console.log("같은위치클릭했다. 홈화면이동");
//                            C_nextScene(SCENE_HOME, null);
//                        }
//                    }
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
        this.schedule(this.slideTimer, 20);
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
    
    
     /////////////////////////////////////////
    // 일정시간 입력없으면 함수호출 START
    /////////////////////////////////////////
    
    onUserInactive: function () {
        cc.log("🔕 60초 동안 아무 입력이 없었습니다.");
        // 여기에 원하는 동작을 넣으세요 (예: 화면 전환, 경고창 등)
        
        if (this._inactivityTimer) {
            this.unschedule(this._inactivityTimer);
        }
        if(home_scene != SCENE_HOME)
            gotoHomeScene();
        
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
