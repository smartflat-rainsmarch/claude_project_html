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
                C_setUI(self,size,self.homedatas[i]);
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
        
        
        return true;
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
    
    buttonClick_Old: function (tag) {
        var self = this;
        var size = cc.winSize;
        console.log("buttonClick!! ", tag);
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        var canvas = document.getElementById("gameCanvas");
        switch (tag) {
            case l_tag.logo:
                
                C_nextScene(SCENE_HOME);
                break;
            case l_tag.btn0:
                var data = {
                    "tab":0,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn1:
                var data = {
                    "tab":1,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn2:
                var data = {
                    "tab":2,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn3:
                var data = {
                    "tab":3,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn4:

                
                
              
                
                var mapdatas = [];
                for(var i = 0 ; i < self.contentdatas.length;i++){
                    if(self.contentdatas[i].type == "mapimg")
                        mapdatas.push(self.contentdatas[i]);
                }
                
                 C_ShowMapDialogLayer(self,"","",mapdatas, function(){
                     
                     console.log("closeMapdialogLayer 111");
                },null);   
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
