//var testcnt = 0;
var g_tag = {
    btn_ok: 0,
    btn_continue_video: 1,
    btn_close:2,
    btn_start:3,
    btn_pause:4,
    hp_on:10,
    icon_arm : 11,
    btn_running_start : 12
};
var HEALTH_STATUS = {
    SCAN_QRCODE: 0,
    PLAY_VIDEO: 1,
    READY: 2,
    START: 4,
    BREAKTIME: 5,
    BREAKTIME_STARTREADY: 6, // 다시 준비하세요. 10,9,8,...2,1
    ALL_SET_FINISH: 7,
    TODAY_HEALTH_FINISH: 8

};
var game_instance = null;
var GameLayer = cc.Layer.extend({
    sprite: null,
    _plists: [],
    youtube_player: null,
    videoIFrame: null,
    continue_video_btn: null,
    isWatchedVideo: false,
    wtime: 0,
    before_time: 0,
    shoutLabelBack: null,
    shoutCount: 0,
    beforePosition: {
        x: 0,
        y: 0
    },
    dayLabel:null,
    titleLabel:null,
    messageLabel: null,
    weight_speed:4,  //운동 속도 4초
    //운동기구 이름 , 운동할 기구 개수 , 세트당 기구 무게 , 
    todayHealthData:{
        day:1,
        color:"파랑색",      //todayHealthData.color
        modelid:"model111,a",       //todayHealthData.weightpart
        modeldesc:"",
        weightpart:"팔",       //todayHealthData.weightpart
        weightname:"팔운동XT1모델",
        maxmachinenum:5,            //todayHealthData.maxmachinenum  //오늘 운동할 운동기구 개수
        breaktimesec:30,       //todayHealthData.breaktimesec
        weightkg : [],
        weightcount : [],
        weightvideourl :""
    },
    
    setcount: 0, //5세트중 첫번째 세트
    todayWeightcount: 0, // 오늘 운동한 운동기구 개수
    status: 0,
    armLayer:null,
    armLabel:null,
    videoDiv:null,
    btn_pause:null,
    btn_start:null,
    msg_back :null,
    bottom_msg_back:null,
    speedSlider:null,
    qrcodeMessage : "",
    model_names : "",
    img_machine: null,
    txt_title : null,
    ctor: function () {
        //////////////////////////////
        // 1. super init first
        this._super();

        var self = this;
        var size = cc.winSize;

        C_DrawBackColor(self);
        
        //background Image 
//        var bg = C_AddButton(self,res._n_mainmenu_Background,null,0,0,-1,null,null,function(tag){},self);
        var bg = C_AddSprite(self,res._n_mainmenu_Background,size.width / 2,size.height/2,1,null,null);
        C_BackRepeatAni(bg,4,1.1);
        //title 
//        var title = C_AddSprite(self,res._n_mainmenu_Title,size.width / 2,size.height/2+350,1,null,null);
        var move = cc.moveTo(0.3,size.width/2,size.height-100);
        var scale1 = cc.scaleTo(0.1,0.9,1.1);
        var scale2 = cc.scaleTo(0.2,1,1);
        var func = cc.callFunc(function(){C_UpDownRepeatAni(title,3,11);});
        var seq = cc.sequence(move,scale1,scale2,func);
//        title.runAction(seq);
        //background Image 
        //        this.sprite = new cc.Sprite(res.game_back_png);
        //        this.sprite.attr({
        //            x: size.width / 2,
        //            y: size.height / 2
        //        });
        //        this.addChild(this.sprite, 0);
        
        
        this.weight_speed = SAVEDATA.HEALTH_SPEED;
        
        this.bottom_msg_back = C_AddSprite(self,res.n_game_bottom_msg_back,size.width / 2,80,1,null,null);
        C_AddCustomFont(self, param_healthday+"일차", size.width / 2, size.height-20, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 30, null, false);
        self.txt_title = C_AddCustomFont(self, "", size.width / 2, size.height-80, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 50, null, false);
        this.titleLabel = C_AddCustomFont(this.bottom_msg_back, "", this.bottom_msg_back.width / 2, 55, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 30, null, false);
        this.bottom_msg_back.setVisible(false);
        this.msg_back = C_AddSprite(self,res.n_game_message_back,size.width / 2,size.height-300,1,null,4);
        this.messageLabel = C_AddCustomFont(this.msg_back, "", this.msg_back.width / 2, this.msg_back.height/2, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 40, null, false);
        

        //        C_AddAnimButton(self, res.button_x, null, size.width / 2, size.height / 2 - 100, g_tag.btn_ok, null, null, function (tag) {
        //            self.buttonClick(tag);
        //        }, self);
        
        var weight_type = param_healthpart;
        
        
       
        
        
        
        if(param_modelnames &&  WEIGHT_MODEL_IDS.length > 0 && WEIGHT_MODEL_IDS.length >= JSON.parse(param_modelnames).length){
            this.setStatus(HEALTH_STATUS.TODAY_HEALTH_FINISH); //오늘 모든 운동기구 종료
            return;
        }
        
        this.updateMainMessage("");
        
        C_Toast(self, "오늘 운동할 부분은 "+param_healthcolor+" " + weight_type + "입니다.\n" + self.getModelNames() + " 중 \n 하나의 QR코드를 찍으세요", function () {
            self.setStatus(HEALTH_STATUS.SCAN_QRCODE);
        });
            
        
        
        
        
        

        
        
        self.setStartPuaseButton(BTN_START_PAUSE_STATE.HIDE);
         /////////////////////////////////////////
        //동영상 재생관련 코드 START
        /////////////////////////////////////////

        /////////////////////////////////////////
        //로컬 비디오 재생하기        
        /////////////////////////////////////////
        //        var video = new ccui.VideoPlayer();
        //        video.setContentSize(size.width, 768);
        //        video.setPosition(size.width/2, size.height/2);
        //        window.video = video;
        //        this.addChild(video);
        //        video.setURL("res/test_video.mp4");
        //        video.play();



        /////////////////////////////////////////
        //유튜브 플레이어 IFrame 재생하기
        /////////////////////////////////////////
        game_instance = this;

        var cocos_container = document.getElementById('Cocos2dGameContainer');
        self.videoDiv = document.createElement('div');
        self.videoDiv.style.width = "100%";
        self.videoDiv.style.height = "100%";
        
        cocos_container.appendChild(self.videoDiv);
        self.videoIFrame = document.createElement('div');
        self.videoIFrame.id = 'youTubePlayer1';
        self.videoDiv.appendChild(self.videoIFrame);


        //버튼 DIV
        var btn_div = document.createElement('div');
        btn_div.id = "btn_div";
        btn_div.className = "btn_container";


        self.continue_video_btn = document.createElement("BUTTON"); // Create a <button> element
        self.continue_video_btn.id = "my_centered_buttons_older";
        self.continue_video_btn.style.width = "200px";
        self.continue_video_btn.style.height = "80px";
        //        self.continue_video_btn.style.display = "none";
        self.continue_video_btn.innerHTML = "영상 건너띄기"; // Insert text
        self.continue_video_btn.onclick = function () {
            self.buttonClick(g_tag.btn_continue_video)
        };
        btn_div.appendChild(self.continue_video_btn);
        self.videoDiv.appendChild(btn_div);

        //운동스피드 조절 바 초기화
        self.initWeightSpeed();
        
        //팔운동 게이지 초기화
        self.initArmGuage();
        
        

        return true;
    },
    getModelNames : function(){
        if(!param_modelnames)return "";
        var json_models = JSON.parse(param_modelnames);
        var names = "";
        for(var i = 0 ; i < json_models.length; i++){
            var isname = false;
            for(var j = 0 ; j < WEIGHT_MODEL_IDS.length; j++){
                if(WEIGHT_MODEL_IDS[j] == json_models[i].modelid){
                    isname = true;
                    break;
                }                    
            }
            if(!isname){                
                names  = names == "" ? json_models[i].weightname : names+","+json_models[i].weightname;                
            }
        }
        
        return names;
        
        
    },
    //팔운동 게이지 초기화
    initArmGuage:function(){
        var self = this;
        
        this.armLayer = new cc.Layer();
        this.armLayer.setPosition(670,760);
        self.addChild(this.armLayer);
        
        var x = 0;
        var y = 0;
        var hp_back = C_AddSprite(this.armLayer,res.n_game_hpbarback,x,y,1,1,null);

        
        var hp_on = cc.ProgressTimer.create(cc.Sprite.create(res.n_game_hpbaron));
        
        hp_on.setType(cc.ProgressTimer.TYPE_BAR);
        hp_on.setMidpoint(cc.p(0.5, 0));
        hp_on.setBarChangeRate(cc.p(0, 1));
        hp_on.setPosition(x,y);
        hp_on.setTag(g_tag.hp_on);
        hp_on.zIndex= 111;
        this.armLayer.addChild(hp_on);
        hp_on.setPercentage(0.0);
        self.setArmGuage(0,0);
//        self.setHP(100);
        
//        var scale1 = cc.scaleTo(0.3,0.5,1);
//        var scale2 = cc.scaleTo(0.5,0.8,1);
//        var delay = cc.DelayTime.create(1);
//        var seq = cc.sequence(scale1, scale2,delay);
//        var repeate = cc.RepeatForever.create(seq);
//        hp_on.runAction(repeate);
        
        
        var arm_icon = cc.Sprite.create(res.n_game_img_arm);
        arm_icon.setPosition(x,y-160);
        arm_icon.setTag(g_tag.icon_arm);
        arm_icon.setScale(0.8)
        arm_icon.zIndex = 111;
        this.armLayer.addChild(arm_icon);
        
        
        this.armLabel = C_AddCustomFont(arm_icon, "",33,-10, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 20, null, false);
        
        this.armLayer.setVisible(false);
        
        
    },
    setArmGuage:function(percent,time){
        var gauge = this.armLayer.getChildByTag(g_tag.hp_on);
        if (gauge)
        {
//            gauge.stopAllActions();
            gauge.runAction(cc.ProgressTo.create(time, percent));
            
        }
        var arm_icon = this.armLayer.getChildByTag(g_tag.icon_arm);
        if(arm_icon){
            var scale1 = cc.scaleTo(time,1+percent/200);
            arm_icon.runAction(scale1);
        }
    },
    setQRCodeData: function (android_msg) {
        var self = this;
        var size = cc.winSize;
        
        self.setcount = 0;
        self.status = 0;
        self.wtime = 0;
        self.before_time = -1;
        this.shoutCount = 0;
        
        
       
        
        
        //QR코드로 기구를 찍은 기구정보를 가져온다.
        if(android_msg)this.todayHealthData = JSON.parse(android_msg); //sample
        
        if (WEIGHT_MODEL_IDS.length > 0 && WEIGHT_MODEL_IDS.length >= parseInt(this.todayHealthData.maxmachinenum)) {
            this.setStatus(HEALTH_STATUS.TODAY_HEALTH_FINISH); //오늘 모든 운동기구 종료
            return;
        }
        
        
        if(this.isModelID(this.todayHealthData.modelid)){
            C_Toast(self, "이미 운동한 기구입니다. 다른기구의 QR코드를 찍으세요", function () {
                self.qrcodeMessage = param_healthcolor+" "+self.getModelNames() + " 중 하나의 QR코드를 찍으세요";
                C_AndroidCall("checkQRCode", self.qrcodeMessage, function (res) {
                    self.setStatus(HEALTH_STATUS.PLAY_VIDEO, res);
                });
            });
        }else{
             
            var img_res = "res/n_game/machines/"+this.todayHealthData.modelid.split(',')[0]+".png";
            
            if(this.img_machine != null){
                this.img_machine.runAction(cc.RemoveSelf.create());
                
            }
            self.img_machine = C_AddSprite(self,img_res,size.width / 2,size.height/2,1,1.5,0);
            
            C_AddAnimButton(self.img_machine, res.n_game_question, null, self.img_machine.width -30, self.img_machine.height - 30, -1, 0.7, null, function (tag) {
                 self.pauseSchedule();
                 C_ShowMachinePopupLayer(self, img_res, self.todayHealthData.weightname , modeldesc ,function(){
                     self.resumeSchedule();
                 });
            }, self);
            
            var modeldesc  = this.todayHealthData.weightpart+" : "+this.todayHealthData.modeldesc
            
            C_ShowMachinePopupLayer(self, img_res, this.todayHealthData.weightname , modeldesc ,function(){
                C_AndroidCall("appLoadData","healthdata_"+param_healthday,function(res){
                    if(res != ""){

                        var _healthdata = JSON.parse(res); 
                        console.log("load healthdata : ",_healthdata);
                        if(_healthdata && _healthdata.date){
                            if(_healthdata.date != C_getToday(new Date(),"yyyy-mm-dd")){
        //                        C_AndroidCall("gameLog",JSON.stringify(_healthdata));
                                WEIGHT_MODEL_IDS = [];
                            }else{
                                HEALTH_LOG = JSON.parse(res);
                            }
                            self.todayWeightcount = WEIGHT_MODEL_IDS.length;
                        }
                    }

                    MAX_MACHINE_NUM = parseInt(self.todayHealthData.maxmachinenum);
                     C_SetLog(LKEY_MACHINE_START, self.todayHealthData.weightname);
                     var videoId = self.changeYoutubeURLToVideoID(self.todayHealthData.weightvideourl);
                     self.onYouTubeIframeAPIReady(videoId);

                });
            });
            
           
        }
    },
    isModelID:function(id){
        var flg = false;
        for(var i = 0; i < WEIGHT_MODEL_IDS.length; i++){
            if(id == WEIGHT_MODEL_IDS[i]){
                flg = true;
                break;
            }
        }
//        if(!flg){
//            WEIGHT_MODEL_IDS.push(id);
//        }
        return flg;
    },
    changeYoutubeURLToVideoID: function (url) {
        var regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
            return match[2];
        } else {
            //error
            return null;
        }
    },
    onYouTubeIframeAPIReady: function (videoid) {
        console.log("onYouTubeIframeAPIReady ");
        var self = this;
        
        if(self.youtube_player == null){
            self.youtube_player = new YT.Player('youTubePlayer1', {
                width: '500',
                height: '300',
                videoId: videoid,
                autoplay:1,
                playerVars: {
                    rel: 0
                }, //추천영상 안보여주게 설정
                events: {
                    'onReady': self.onPlayerReady, //로딩할때 이벤트 실행
                    'onStateChange': self.onPlayerStateChange //플레이어 상태 변화시 이벤트실행
                }
            }); //youTubePlayer1셋팅
            console.log("self.youtube_player ",self.youtube_player);
        }else{
            self.youtube_player.loadVideoById(videoid);
            self.showVideo();
        }
        
        
        
        
        console.log("onYouTubeIframeAPIReady!!");
    },
    onPlayerReady: function (event) {
        console.log("onPlayerReady 111 ", event);
        var canvas = document.getElementById("gameCanvas");
        canvas.style.display = "none";
        game_instance.continue_video_btn.style.display = "block";
//        game_instance.videoIFrame.style.display = "block";
        game_instance.videoDiv.style.display = "block";
        event.target.playVideo(); //자동재생    

        //로딩할때 실행될 동작을 작성한다.

    },
    onPlayerStateChange: function (event) {
        //            unstarted	YT.PlayerState.UNSTARTED	-1
        //            ended	YT.PlayerState.ENDED	0
        //            playing	YT.PlayerState.PLAYING	1
        //            paused	YT.PlayerState.PAUSED	2
        //            bufferring	YT.PlayerState.BUFFERING	3
        //            video cued	YT.PlayerState.CUED	5

        console.log("onPlayerStateChange 111 ", event);
        if (event.data == YT.PlayerState.PLAYING) { //value : 1
            //플레이어가 재생중일때 작성한 동작이 실행된다.
            console.log("VIDEO PLAYING");
        } else if (event.data == YT.PlayerState.PAUSED) { //value : 2
            console.log("VIDEO PAUSED");
        } else if (event.data == YT.PlayerState.CUED) { //value : 5
            console.log("VIDEO CUED");
        } else if (event.data == YT.PlayerState.BUFFERING) { //value : 3
            console.log("VIDEO BUFFERING");
        } else if (event.data == YT.PlayerState.UNSTARTED) { //value : -1
            console.log("VIDEO UNSTARTED");

        } else if (event.data == YT.PlayerState.ENDED) { //value : 0
            console.log("VIDEO ENDED");
            game_instance.hideVideo();
        }

    },
    showVideo: function () {
        var self = this;
        var canvas = document.getElementById("gameCanvas");
        canvas.style.display = "none";
        self.continue_video_btn.style.display = "block";
//        self.videoIFrame.style.display = "block";
        self.videoDiv.style.display = "block";
//        console.log("self.youTubePlayer1 ",self.youTubePlayer1);
        if(self.youtube_player)
            self.youtube_player.playVideo(); //재생
    },
    hideVideo: function () {
        var self = this;
        var canvas = document.getElementById("gameCanvas");
        console.log("동영상 건너띄기 눌렀다!");
        self.youtube_player.stopVideo();
//        self.videoIFrame.style.display = "none";
        self.videoDiv.style.display = "none";
        self.continue_video_btn.style.display = "none";
        self.isWatchedVideo = true;
        canvas.style.display = "block";

        self.setStatus(HEALTH_STATUS.READY);


    },
    buttonClick: function (tag) {
        var self = this;
        console.log("buttonClick!! ", tag);
        
        var canvas = document.getElementById("gameCanvas");
        switch (tag) {
            case g_tag.btn_ok:
                self.showVideo();
                break;
            case g_tag.btn_start:
                self.resumeSchedule();
                break;
            case g_tag.btn_pause:
                self.pauseSchedule();
                break;
            case g_tag.btn_continue_video:
                self.hideVideo();
                break;
            case g_tag.btn_close:
                 C_AndroidCall("closeWebView","close");
                break;
            case g_tag.btn_running_start:
                C_nextScene(SCENE_MENU);
                break;
        }
    },

    /////////////////////////////////////////
    //동영상 재생관련 코드 END
    /////////////////////////////////////////

    updateTitleLabel:function(){
        var self = this;
        
        var setnum = this.todayHealthData.weightkg .length;
        var count = this.todayHealthData.weightcount[self.setcount];
        
        var weightkg = self.setcount >= this.todayHealthData.weightkg.length ? this.todayHealthData.weightkg[this.todayHealthData.weightkg.length-1] : this.todayHealthData.weightkg[self.setcount];
        self.titleLabel.string = (self.todayWeightcount+1)+"번째 "+this.todayHealthData.weightname+" "+weightkg+"kg "+setnum + "세트 중 " + (self.setcount + 1) + "세트 " + count + "회";
        this.bottom_msg_back.setVisible(true);
        
        var scale_big2 = cc.scaleTo(0.4,1.2,1.2);
        var scale_small2 = cc.scaleTo(0.2,1,1);
        var seq = cc.sequence(scale_big2,scale_small2);
        self.bottom_msg_back.runAction(seq);
        
    },
    todayHealthFinish: function () {
        var self = this;
        var size = cc.winSize;
        console.log("오늘 운동끝~~~~");
        this.bottom_msg_back.setVisible(false);
        
//        self.messageLabel.string = "오늘의 모든 \n기구운동은 끝났습니다.\n 런닝머신 15분 뛴 후 \n 집에 가세요!";
        RUNNING_TIME = 15;
        
        
        self.updateMainMessage("오늘의 모든 \n기구운동은 끝났습니다.\n 런닝머신 "+RUNNING_TIME+"분 뛴 후 \n 운동을 종료하세요!");
        C_AddAnimButton(self, res._n_mainmenu_btn_health_finish, res._n_mainmenu_btn_health_finish, size.width / 2-150, size.height / 2 - 300, g_tag.btn_close, null, null, function (tag) {self.buttonClick(tag);}, self);
        C_AddAnimButton(self, res._n_mainmenu_btn_run_start, res._n_mainmenu_btn_run_start, size.width / 2+150, size.height / 2 - 300, g_tag.btn_running_start, null, null, function (tag) {self.buttonClick(tag);}, self);
      
//        setTimeout(function(){
//            C_AndroidCall("closeWebView","close");
//        },13000);
        
    },
    startSchedule: function () {
        var self = this;
        
        this.unschedule(this.update);
        this.schedule(this.update);
        
        self.wtime = -1;
        self.before_time = -1;
        this.shoutCount = 0;
        GLOBAL_PAUSE_ALL = false;
        this.setStartPuaseButton(BTN_START_PAUSE_STATE.START);
        console.log("startSchedule "+self.wtime);
    },
    pauseSchedule:function(){
        console.log("pauseSchedule");
        
        this.setStartPuaseButton(BTN_START_PAUSE_STATE.PAUSE);
        this.unschedule(this.update);
        GLOBAL_PAUSE_ALL = true;
        
    },
    resumeSchedule:function(){
        console.log("resumeSchedule");
        
        
        this.schedule(this.update);
        this.setStartPuaseButton(BTN_START_PAUSE_STATE.START);
        GLOBAL_PAUSE_ALL = false;
    },
    stopSchedule: function () {
        console.log("stopSchedule");
        
        this.setStartPuaseButton(BTN_START_PAUSE_STATE.HIDE);
        this.unschedule(this.update);
        GLOBAL_PAUSE_ALL = true;
    },
    setStartPuaseButton:function(type){
        var self = this;
        var size = cc.winSize;
        if(self.btn_start == null)self.btn_start = C_AddAnimButton(self, res.n_game_btn_start, null, size.width / 2, 240, g_tag.btn_start, null, null, function (tag) {self.buttonClick(tag);}, self);
        if(self.btn_pause == null)self.btn_pause = C_AddAnimButton(self, res.n_game_btn_pause, null, size.width / 2, 240, g_tag.btn_pause, null, null, function (tag) {self.buttonClick(tag);}, self);
        if(self.txt_pause == null)self.txt_pause = C_AddSprite(self,res.n_game_txt_pause,size.width / 2,size.height/2+400,1,null,9999);

        switch(type){
            case BTN_START_PAUSE_STATE.HIDE:  
                this.btn_start.setVisible(false);
                this.btn_pause.setVisible(false);
                this.txt_pause.setVisible(false);
                break;
            case BTN_START_PAUSE_STATE.START:
                this.btn_start.setVisible(false);
                this.btn_pause.setVisible(true);                
                this.txt_pause.setVisible(false);
                break;
            case BTN_START_PAUSE_STATE.PAUSE:
                this.btn_start.setVisible(true);
                this.btn_pause.setVisible(false);
                this.txt_pause.setVisible(true);
                break;
            
        }  
    },
    update: function (dt) {
        var self = this;
        this.wtime += dt;
//                console.log("time is ",this.wtime);
        var nowtime = Math.floor(this.wtime);
//        console.log("status is "+this.status);
//         console.log("nowtime is "+nowtime+" beforetime "+this.before_time);
        if (nowtime > this.before_time) {
            
            
            
            var time_sec = this.todayHealthData.breaktimesec;
            var weight_name = this.todayHealthData.weightname;
            var killogram = this.todayHealthData.weightkg [self.setcount];
            var setnum = this.todayHealthData.weightkg .length;
            var count = this.todayHealthData.weightcount[self.setcount];
            var qrcode_colorname = this.todayHealthData.color;
            
            switch(this.status){
                case HEALTH_STATUS.READY:

                   self.txt_title.string = "["+(self.setcount + 1)+"/"+setnum+"]세트 "+killogram+"kg "+count+"번";
                    switch(nowtime){
                        case 0:
                            self.updateMainMessage(weight_name + " 무게추를 \n" + killogram + "kg으로 조절하세요.");
                            break;
                        case 5:
                            self.updateMainMessage(setnum + "세트중에 " + (self.setcount + 1) + "세트 " + count + "번 시작합니다.");
                            break;
                        case 6:
                            C_StartCountDown(self, 5, function () {
                                self.setStatus(HEALTH_STATUS.START);
                            });    
                            break;
                    }
                    

                    break;
                case HEALTH_STATUS.START:
                    var timegab = this.weight_speed;
                    console.log("nowtime is " + nowtime + "timegab "+timegab+" r "+(nowtime % timegab));

                    if (nowtime % timegab == 0) {



                        //기구를 15번 운동했다.

                        if (this.shoutCount >= this.todayHealthData.weightcount[this.setcount]) {
                            this.armLayer.setVisible(false);
//                            this.speedSlider.setVisible(false);
                            
                            
                            if (this.setcount >= this.todayHealthData.weightkg .length-1) { //이 운동기구 운동할 세트가 끝났는지 체크 ex)5세트가 끝났는지 체크

//                                if (this.todayWeightcount >= parseInt(this.todayHealthData.maxmachinenum)-1) {
                                C_PushModelId(this.todayHealthData.modelid);
                                
                                if (WEIGHT_MODEL_IDS.length > 0 && WEIGHT_MODEL_IDS.length >= parseInt(this.todayHealthData.maxmachinenum)) {
                                    this.setStatus(HEALTH_STATUS.TODAY_HEALTH_FINISH); //오늘 모든 운동기구 종료
                                } else
                                    this.setStatus(HEALTH_STATUS.ALL_SET_FINISH); //이번 운동기구 종료
                                
                            } else
                                this.setStatus(HEALTH_STATUS.BREAKTIME);

                            
                            this.shoutCommand(this.shoutCount,false); //잔상이미지만 삭제
                        }else{
                            this.shoutCommand(this.shoutCount,true); //잔상이미지삭제와 동시에 구령을 센다.
                            this.shoutCount++;
                        }
                    }
                    
                    break;
                case HEALTH_STATUS.BREAKTIME:
                    
//                    console.log("BREAKTIME nowtime is " + nowtime);
                    
                    switch(nowtime){
                        case 0:
                            self.txt_title.string = "";
                            self.updateMainMessage(time_sec + "초 쉽니다. \n쉬는동안 " + weight_name + " 무게추를 \n" + killogram + "kg으로 조절하세요.");

                            this.bottom_msg_back.setVisible(false);
                            C_StartCountDown(self, time_sec, function () {
                                self.setStatus(HEALTH_STATUS.START);
                            });
                            break;
                        case time_sec-10:
                            C_PlaySound(SOUND.CLOCK);
                            self.updateMainMessage(setnum + "세트중에 " + (self.setcount + 1) + "세트 \n" + count + "번 시작합니다.");
                            self.txt_title.string = "["+(self.setcount + 1)+"/"+setnum+"]세트 "+killogram+"kg "+count+"번";
                            break;
                    }
                   
                    break;
                case HEALTH_STATUS.ALL_SET_FINISH:
                   
                   
                    self.todayWeightcount++;

                    
                      switch(nowtime){
                        case 0:
                            this.setStartPuaseButton(BTN_START_PAUSE_STATE.HIDE);
                            
                            self.updateMainMessage(weight_name + " 모든세트가 \n종료되었습니다. \n다음 운동기구로 가서 \n "+param_healthcolor+" " + self.getModelNames() + " 중 \n 하나의 QR코드를 찍으세요.");
                            break;
                        case 5:
                            self.setStatus(HEALTH_STATUS.SCAN_QRCODE);
                            break;
                       
                    }
                    
                    break; 
                }
            
            
            
            

            this.before_time = this.wtime;
//            console.log(this.status+" : end beforetime "+this.before_time);
        }
    },
    setStatus: function (status, msg) {
        var self = this;
        this.status = status;
        switch (this.status) {
            case HEALTH_STATUS.SCAN_QRCODE:
                self.qrcodeMessage = param_healthcolor+" "+self.getModelNames() + " 중 하나의 QR코드를 찍으세요";
                C_AndroidCall("checkQRCode", self.qrcodeMessage, function (res) {
                    self.setStatus(HEALTH_STATUS.PLAY_VIDEO, res);
                });
                
                //test
//                self.setStatus(HEALTH_STATUS.PLAY_VIDEO, null);
                
                
                break;
            case HEALTH_STATUS.PLAY_VIDEO:
               
                self.setQRCodeData(msg);
                
                break;
            case HEALTH_STATUS.READY:
                this.startSchedule();
                break;
            case HEALTH_STATUS.START:
                
                self.startSchedule();
                self.updateTitleLabel();
               
                break;
            case HEALTH_STATUS.BREAKTIME:
                self.setcount++;
                self.startSchedule();
                
//                C_SetLog(LKEY_MACHINE_END);//test 로그가 잘 찍히는지 테스트하기위함
                
                break;
            case HEALTH_STATUS.ALL_SET_FINISH:
                self.startSchedule();
                C_SetLog(LKEY_MACHINE_END);
//                C_PushModelId(this.todayHealthData.modelid);
                break;
            case HEALTH_STATUS.TODAY_HEALTH_FINISH:
                self.stopSchedule();
                this.todayHealthFinish();
                C_SetLog(LKEY_MACHINE_END);
                C_SetLog(LKEY_END);
                
                IS_TODAY_ALL_FINISH = true;
                break;
        }
    },

    shoutCommand: function (num, shoutflg) {
        var self = this;
        var size = cc.winSize;

        var commands = ["하나!", "두~울", "셋!", "넷!", "다섯", "여~섯", "일고~옵", "여덟!", "아홉!", "열~", "열~하나!", "열둘!", "열셋!", "열~넷!", "열~다섯!", "열~여섯!", "열~일곱!", "열~~여덟!", "열~아홉~", "스물~~", "스물하나!", "스물~둘!", "스물~셋!", "스물~넷!", "스물다섯!", "스물여섯!", "스물일곱!", "스물여덟!", "스물아홉!", "서른!"];
        if (this.shoutLabelBack) {
            this.shoutLabelBack.runAction(cc.RemoveSelf.create());
            this.shoutLabelBack = null;
            if (num > 0) {
                var number_back = C_AddSprite(self,res.n_game_number_back,this.beforePosition.x, this.beforePosition.y,1,1.5,null);
                var before_label = C_AddCustomFont(number_back, commands[num - 1], number_back.width/2, number_back.height/2, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 30, Color3B.WHITE, false);
                var move = cc.moveTo(1,this.beforePosition.x,-300);
                var fadeout = cc.fadeOut(0.5);
                var spawn1 = cc.spawn(move,fadeout);
                var func = cc.callFunc(function(){cc.RemoveSelf.create()});
                var seq = cc.sequence(spawn1,func);
                number_back.runAction(seq);
//                C_FadeOut(number_back, 1, function () {
//                    number_back.runAction(cc.RemoveSelf.create());
//                });
            }

        }
        
        if (shoutflg && num < 30) {
            var max_count = this.todayHealthData.weightcount[self.setcount]; 
            
            C_PlaySound("s"+(num+1));
            if((num+1) == max_count-1){
                setTimeout(function(){C_PlaySound(SOUND.LAST1);},1000);
            }
            var str_weightcount = (num+1) + " / " + max_count+" 회";
            self.updateMainMessage("", true);
            
            //오른쪽 횟수 업데이트
            self.armLabel.string = str_weightcount;
//            var pos = C_GetRandomPosition(400, 500);
            var pos = {x:size.width/2,y:size.height/2+300};
//            console.log("pos is ",pos);
            this.shoutLabelBack = C_AddSprite(self,res.n_game_number_back, pos.x, pos.y,1,1.5,null);
            var shoutLabel = C_AddCustomFont(this.shoutLabelBack, commands[num],this.shoutLabelBack.width/2, this.shoutLabelBack.height/2, 1, 1, cc.TEXT_ALIGNMENT_CENTER, 30, Color3B.YELLOW, false);

            
            //글자 커졌다 작아지게
            shoutLabel.setScale(2);
            var scale1 = cc.scaleTo(0.2, 4, 4);
            var scale2 = cc.scaleTo(0.5, 1, 1);
            var seq = cc.sequence(scale1, scale2);
            shoutLabel.runAction(seq);

            this.beforePosition = pos;
            
            
            this.armLayer.setVisible(true);
            this.speedSlider.setVisible(true);
            var hspeed = 0.5;
            var lspeed = this.weight_speed-hspeed;
            console.log(this.weight_speed+" hspeed is "+hspeed+" lspeed is "+lspeed);
            self.setArmGuage(100,hspeed);
            setTimeout(function(){self.setArmGuage(0,lspeed);},hspeed*1000);
        }

    },
    updateMainMessage:function(msg, stopAni){
        var self = this;
        var size = cc.winSize;

        self.msg_back.setVisible(msg.length == 0 ? false:true);
        self.messageLabel.string = msg;
        if(stopAni){
            
        }else{
            if(msg.length > 0){
                self.msg_back.setPosition(2000,size.height-300);
                self.msg_back.setScale(0.8);
            }
            var move = cc.moveTo(0.2,size.width/2,size.height-300);
            var scale = cc.scaleTo(0.4,1,1);
            var seq = cc.sequence(move,scale);
            self.msg_back.runAction(seq);    
            C_PlaySound(SOUND.CASH);
        }
       
        
    },
    initWeightSpeed:function(){
        var size = cc.winSize;
        this.speedSlider = new ccui.Slider();
        this.speedSlider.setTouchEnabled(true);
        this.speedSlider.setRotation(-90);
        this.speedSlider.direction = 0; // 0 :horizontal , 1: vertical;
        this.speedSlider.loadBarTexture(res.n_game_speed_back);
        this.speedSlider.loadSlidBallTextures(res.n_game_speed_stick);
        this.speedSlider.loadProgressBarTexture(res.n_game_speed_on);
        this.speedSlider.x = 70;
        this.speedSlider.y = 650;
        this.speedSlider.setScale(2);
        
        var gab = 100/12;  //8
        var value = this.weight_speed*2-3;
        this.speedSlider.setPercent(value*gab);
        this.speedSlider.addEventListener(this.sliderEvent,this);
        this.addChild(this.speedSlider);
        
        //속도조절 텍스트 이미지 추가
        C_AddSprite(this.speedSlider,res.n_game_txt_setspeed,-30,20,1,null,null);
        
        this.speedSlider.setVisible(false);
    },
    sliderEvent:function(sender, type){
        var self = this;
        switch(type){
            case ccui.Slider.EVENT_PERCENT_CHANGED:
                console.log("percent : "+sender.getPercent().toFixed(0));
                // 1.5~7.5
                var gab = 100/12;
                console.log("gab is "+gab);
                var value = parseInt(sender.getPercent()/gab);
                console.log("value : ",value);
                var percent = parseInt(gab)*value;
                console.log("value "+value+" percent "+percent);
                sender.setPercent(parseInt(gab)*value)
//                self.weight_speed = 1.5+value;
                
                //1초, 2초 , 3초 ... 초단위 속도조절
                self.updateWeightSpeed(Math.floor(1.5+value*0.5));
                
//                sender.setPercent(20);
                break;
        }
        console.log("sender.getPercent() : "+sender.getPercent());
       
//        if(sender.getPercent() < 20)sender.setPercent(20);
//        if(sender.getPercent > 80)sender.setPercent(80);
    },
    updateWeightSpeed:function(speed){
        console.log("weight_"+speed);
        this.weight_speed = speed;
        C_SaveData("health_speed",speed);
        
    },
    



});


var GameScene = cc.Scene.extend({
    onEnter: function () {
        this._super();
        var layer = new GameLayer();
        this.addChild(layer);
    }
});
