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

var LogoLayer = cc.Layer.extend({
    _inactivityTimer: null,
    sprite:null,
    hand0:null,
    hand1:null,
    handcnt:0,
    wtime: 0,
    before_time: 0,
    homepage_data : null,
    homedatas : [],
    maindatas : [],
    contentdatas : [],
    ani_datas:[], //애니메이션 
    update_datas:[], // 업데이트해야하는 sp
    sp_md : null,
    sp_hhmm: null,
    sp_weekday :null,
    sp_noticelist:[],
    notice_datas:[],
    isShowMd : false,
    MAX_LEN : 37,
    webview : null,
    obj_weather : null,
    obj_air : null,
    
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
        
        C_checkGetHomeData(self,function(){
            self.init();
        });
        var mWebView = document.getElementById("mWebView");
        mWebView.style.display = "none";
        
        /////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
                       
        return true;
    },
    init:function(){
        
        var self = this;
        var size = cc.winSize;
        
        self.homepage_data = getgamedata;
        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
        self.homedatas = JSON.parse(self.homepage_data.hm_home_data);
        console.log("logo self.homedatas ",self.homedatas);
        
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
                C_setUI(self,size,self.homedatas[i]);
            }
        }
        
        
        C_getListData("home", 1, 5, function(noticelist){
             self.notice_datas = noticelist;
             self.initNoticeList(self.isShowMd);
        });
        
        this.schedule(this.update);
//       
        console.log("window ",window);
//         window.hideFloatingPanel();
    },

    //isShowMd 월/일 을 먼저 표시한다.
    initNoticeList:function(_isShowMd){
        var self = this;
        
        for(var i = 0 ; i < 5; i++){
            
            if(self.notice_datas.length > i){
                var noticedata = self.notice_datas[i];

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
        C_updateWeatherAir(self.obj_weather, self.obj_air, this.wtime);//날씨 , 미세먼지 업데이트
        C_checkAutoUpdate();
        
        
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
                    else if(event.page == "speak"){
                         C_ShowSpeak();
                    }
                    else if(event.page == "popup"){
                        console.log("팝업을 띄운다", );
                        var index = event.index ? event.index : 0;
                        var title = C_MaxLen(self.notice_datas[index].lt_title, self.MAX_LEN);
                        var message = C_WrapTextByWidth(self.notice_datas[index].lt_message, self.MAX_LEN);
                        C_ShowDialogLayer(self, title , message, null, function(){
                            
                        });
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
