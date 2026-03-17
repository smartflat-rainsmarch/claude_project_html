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
var GameTimerManager = {
    _elapsedTime: 0,      // 경과 시간을 초 단위로 저장
    _timerLabel: null,      // 시간을 표시할 라벨 (cc.LabelTTF)
    _backgroundNode: null,  // 타이머의 배경 노드 (cc.DrawNode)
    _isTimerRunning: false, // 타이머가 현재 실행 중인지 확인하는 플래그
    _scheduledTarget: null, // 스케줄러를 등록한 대상 객체

    /**
     * 초 단위 시간을 "MM:SS" 형식의 문자열로 변환합니다.
     * @param {number} seconds - 변환할 시간(초)
     * @returns {string} "MM:SS" 형식의 시간 문자열
     */
    _formatTime: function(seconds) {
        var minutes = Math.floor(seconds / 60);
        var remainingSeconds = seconds % 60;

        // 숫자가 10보다 작으면 앞에 "0"을 붙여 두 자리로 만듭니다.
        var minutesStr = (minutes < 10) ? "0" + minutes : minutes;
        var secondsStr = (remainingSeconds < 10) ? "0" + remainingSeconds : remainingSeconds;

        return minutesStr + ":" + secondsStr;
    },

    /**
     * 1초마다 호출되어 타이머의 시간을 업데이트합니다.
     */
    _updateTimer: function() {
        this._elapsedTime++;
        if (this._timerLabel) {
            this._timerLabel.setString(this._formatTime(this._elapsedTime));
        }
    },

    /**
     * 게임 타이머를 시작합니다.
     * @param {cc.Node} parent - 타이머 UI를 추가할 부모 노드 (예: this, scene 등)
     * @param {number} x - 타이머가 위치할 x 좌표
     * @param {number} y - 타이머가 위치할 y 좌표
     */
    startGameTime: function(parent, x, y) {
        // 이미 실행 중인 타이머가 있다면 중지하고 새로 시작합니다.
        if (this._isTimerRunning) {
            this.stopGameTime();
        }
        // 이전에 생성된 UI가 있다면 제거합니다.
        if (this._backgroundNode) {
            this._backgroundNode.removeFromParent(true);
        }

        this._elapsedTime = 0;
        this._isTimerRunning = true;
        this._scheduledTarget = parent; // 스케줄러를 중지할 때 필요

        // 1. 파스텔 톤의 배경을 생성합니다. (120x40 크기)
        var width = 160;
        var height = 50;
        // 파스텔 톤 하늘색 (R, G, B, Alpha)
        var pastelColor = cc.color(200, 220, 255, 255);

        this._backgroundNode = new cc.DrawNode();
        // cc.DrawNode는 기본적으로 둥근 사각형을 지원하지 않으므로 일반 사각형을 그립니다.
        // 둥근 모서리가 꼭 필요하다면 cc.Scale9Sprite를 사용하는 것이 좋습니다.
//        this._backgroundNode.drawSolidRect(cc.p(0, 0), cc.p(width, height), pastelColor);
        this._backgroundNode = new cc.Sprite("res/n_lyrics/time_bg.png");
        
        // 입력받은 x, y 좌표가 타이머의 중앙이 되도록 위치를 조정합니다.
        this._backgroundNode.setPosition(x - width / 2, y - height / 2);
        parent.addChild(this._backgroundNode, 10); // z-order를 10으로 설정하여 다른 UI 요소 위에 보이게 합니다.

        // 2. "00:00"으로 초기화된 시간 라벨을 생성합니다.
        this._timerLabel = new cc.LabelTTF("00:00", "Arial", 34);
        this._timerLabel.setColor(cc.color(80, 80, 80)); // 가독성을 위해 어두운 회색으로 설정
        this._timerLabel.setPosition(width / 2, height / 2); // 배경의 중앙에 위치
        this._backgroundNode.addChild(this._timerLabel, 11);

        // 3. 1초 간격으로 _updateTimer 함수를 호출하도록 스케줄을 등록합니다.
        // bind(this)를 사용하여 _updateTimer 내부의 'this'가 GameTimerManager를 가리키도록 합니다.
        parent.schedule(this._updateTimer.bind(this), 1.0, cc.REPEAT_FOREVER, 0);
    },

    /**
     * 게임 타이머를 중지합니다.
     */
    stopGameTime: function() {
        if (this._isTimerRunning && this._scheduledTarget) {
            // 등록했던 스케줄을 해제합니다.
            this._scheduledTarget.unschedule(this._updateTimer.bind(this));
            this._isTimerRunning = false;
            this._scheduledTarget = null;
            
            // 타이머를 멈추면 UI가 마지막 시간을 표시한 채로 남아있게 됩니다.
            // 만약 멈췄을 때 UI를 완전히 제거하고 싶다면 아래 주석을 해제하세요.
            /*
            if (this._backgroundNode) {
                this._backgroundNode.removeFromParent(true);
                this._backgroundNode = null;
                this._timerLabel = null;
            }
            */
            return this._elapsedTime;
        }
    }
};
var LogoLayer = cc.Layer.extend({
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
    ani_datas:[],
    sps_sea_charbox:[],
    now_click_sp : null,
    bg:null,
    sps_white_charbox:[],
    sp_wrong : null,
    isStartClick : false,
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
        self.sps_sea_charbox = [];
        self.sps_white_charbox = [];
        self.isStartClick = false;
        
        //배경색
        this.addChild(new cc.LayerColor.create(cc.color(255, 36, 62, 100)));
        
        
        ///////////////////////////////////////
        // 시작 레이어
        ///////////////////////////////////////
        var startlayer = new cc.LayerColor(cc.color(0, 0, 0, 0), size.width, size.height);
          // 3. 터치 이벤트를 삼키는(swallow) 리스너 생성
        var listener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true, // 이 속성이 true이면, 이 레이어 아래의 다른 노드들은 터치 이벤트를 받지 못합니다.
            onTouchBegan: function (touch, event) {
                // 항상 true를 반환하여 터치 이벤트를 여기서 '소비'하고 하위 레이어로 전파되는 것을 막습니다.
                return true; 
            }
        });
        var man = C_AddSprite(startlayer,res.n_lyrics_man, size.width/2, C_getY(800),null,null,null);
         var txt_start = C_AddSprite(startlayer,res.n_lyrics_txt_start, size.width/2, C_getY(500),null,null,null);
        man.setVisible(false);
        txt_start.setVisible(false);

        // 4. 생성한 리스너를 투명 레이어에 추가
        cc.eventManager.addListener(listener, startlayer);
        C_AddButton(startlayer,res.n_lyrics_start_normal,res.n_lyrics_start_click,size.width/2,300,null,null,null,function(){
            if(!self.isStartClick){
                man.setVisible(true);
                self.isStartClick = true;
                
                 
                
                setTimeout(function(){
    //                man.setVisible(false);
                    txt_start.setVisible(true);
                    runScaleOutAnimation(txt_start);
                },1500);
                setTimeout(function(){
                    startlayer.runAction(cc.RemoveSelf.create());  
                    GameTimerManager.startGameTime(self.bg, size.width / 2+370, C_getY(330));
                },3000);
                
                
            }
            console.log("start button click");
//            
           
            
        },null);
        ///////////////////////////////////////
        
        
        //배경이미지
        self.bg = C_AddSprite(self,res.n_lyrics_bg, size.width/2, C_getY(size.height/2),null,null,null);
        
        
        ///////////////////////////////////////
        // 구름 배경 애니메이션
        ///////////////////////////////////////
        var cloud0 = C_AddSprite(self,res.n_lyrics_cloud1, 300, C_getY(100),null,null,null);
        var cloud1 = C_AddSprite(self,res.n_lyrics_cloud0, size.width/2+200, C_getY(250),null,null,null);
        var cloud2 = C_AddSprite(self,res.n_lyrics_cloud1, 30, C_getY(100),null,null,null);
        C_StartScrollFrom(cloud0,300, C_getY(100),30);
        C_StartScrollFrom(cloud1,size.width/2+200, C_getY(180),55);
        C_StartScrollFrom(cloud2,300, C_getY(250),10);
        
        self.sp_wrong = C_AddSprite(self.bg,res.n_lyrics_wrong, size.width/2,  C_getY(500) ,null,null,9999);
        self.sp_wrong.setVisible(false);
        
        
        //깃발 휘날리기
        var arr_flag = [res.n_lyrics_flag0, res.n_lyrics_flag1, res.n_lyrics_flag2, res.n_lyrics_flag3];
        C_spriteAnimation(self.bg, size.width/2+55, C_getY(250),arr_flag,0.2,1);
        
        
        
          //타이틀
        C_AddSprite(self,res.n_lyrics_title, size.width/2, C_getY(200),null,null,null);
        //SubTitle
        C_AddCustomFont(self, param_subtitle , 303, C_getY(323), null, 2, null, 20, cc.color(255, 255, 255), true); 
        C_AddCustomFont(self, param_subtitle , 300, C_getY(320), null, 2, null, 20, cc.color(130, 110, 180), true); 
        
        
        ///////////////////////////////////////
        // 가사 박스 그리기
        ///////////////////////////////////////
        var ll = param_lyrics.split('|');
        
        const rect_size = 80;
        for(var i = 0; i < ll.length;i++){
            
            //문자열을 글자 단위로 쪼개 배열로 만듭니다.
            var chars = ll[i].split(''); 
            var startx = 100;
            var starty = C_getY(500+i*rect_size);
            
            for(var j = 0 ; j < chars.length; j++){
                if(chars[j] != " "){
                    var sx = startx + j*rect_size ;               
                    var tag = chars[j];
                    const _sx = sx;
                    const _sy = starty;

                    //빨간 배경네모
                    var sp_txtbg = C_AddSprite(self.bg, res.n_lyrics_rect_select, _sx, _sy,tag,1,null,null,null);
                    //글자
                    C_AddCustomFont(sp_txtbg, chars[j] , 40, 30, null, 2, null, 28, cc.color(55, 10, 20), true);   
                    
                    //하얀 네모박스
                    var sp_charbox = C_AddSpriteTouch(self.bg, res.n_lyrics_rect_normal, _sx, _sy,tag,null,null,function(_sp){
                        
                        if(self.now_click_sp && self.now_click_sp.getTag() == _sp.getTag()){
                            C_PlayBrickBreakEffect(self.bg,_sx,_sy);//깨지는 파티클
                            
                             var cleartime = GameTimerManager.stopGameTime();
                            console.log("게임 클리어!!   "+cleartime+"초 ");
                            
                            setTimeout(function(){
                                removeSprite(self.sps_white_charbox, _sp);//_sprite 를 지운다.                                
                                removeSprite(self.sps_sea_charbox, self.now_click_sp);//sea_sprite 를 지운다.        
                            },500);
                            
                            
                            setTimeout(function(){
                                if(self.sps_white_charbox.length == 0){
                                    self.clearGameAni();
                                }
                            },2800);
                            
                            console.log("남은갯수 "+self.sps_white_charbox.length);
                        }
                        else {
                            self.sp_wrong.setVisible(true);
                            setTimeout(function(){
                                self.sp_wrong.setVisible(false);
                            },1000);
                        }
                       
                        
                    });
                    self.sps_white_charbox.push(sp_charbox);
                }else {
                    startx -= 50;
                }
                
            }
        }
        
        //순수 글자만 추출 공백 제거
        var txts = param_lyrics.replaceAll('|', "");
        txts = txts.replaceAll(' ', "");
        console.log("txts "+txts);
        var numbers = getUniqueRandomNumbers(40,txts.length);
        
        ///////////////////////////////////////
        // 바닷가에 떠다니는 글자 애니메이션 40ro
        ///////////////////////////////////////
        var tide0 = C_AddSprite(self,res.n_lyrics_tide0, size.width/2, C_getY(size.height-700),null,null,null);
        var tide1 = C_AddSprite(self,res.n_lyrics_tide1, size.width/2, C_getY(size.height-500),null,null,null);
        var tide2 = C_AddSprite(self,res.n_lyrics_tide0, size.width/2, C_getY(size.height-300),null,null,null);
        var tide3 = C_AddSprite(self,res.n_lyrics_tide1, size.width/2, C_getY(size.height-100),null,null,null);
        
        
        var tides = [tide0,tide1,tide2,tide3];
        for(var j = 0 ; j < tides.length; j++){
            var rand_tide_time = 3 + Math.random()*40/10;
            var rand_tide_updown = Math.random()*30+20;
            
            C_LeftRightRepeatAni(tides[j], rand_tide_time);
            
            
            for(var i = 0 ; i < 10 ;i++){
                const nownum = j*10+i;
                
                //랜덤위치가 있는지 체크한다.
                var isin = -1;
                for(var k = 0 ;k < numbers.length;k++){
                    if(numbers[k] == nownum){
                        isin = k;
                        break;
                    }
                }
                var tag = getCommonRandomHangul();
                if(isin >= 0){
                    tag = txts[isin];
                    console.log("*** 태그 : "+tag);
                }
                
                var randx = i*200+Math.random()*180;                
                var randy = Math.random()*200+100;
//                console.log("i "+i+" j "+j+ " randx "+randx+" randy "+randy);
                
                var sp_charbox = C_AddSpriteTouch(tides[j],res.n_lyrics_charbox0, randx, randy,tag,null,null,function(_sp){
//                    console.log("sprite click1!! "+_sp);
                    self.now_click_sp = _sp;
                    C_StartBlinkingWithColor(_sp,1,"#ffaabb");

                });
                //self.sps_sea_charbox.push({"tag":tag,"sp":sp_charbox});
                self.sps_sea_charbox.push(sp_charbox);
                var rand_updown = Math.random()*30+20;
                var rand_time = 1+ Math.random()*10/10;
                C_UpDownRepeatAni(sp_charbox, rand_time,rand_updown);
                
                var randr = Math.random()*250;
                var randg = Math.random()*250;
                var randb = Math.random()*250;
                C_AddCustomFont(sp_charbox, tag , 110, 120, null, 2, null, 35, cc.color(randr, randg, randb), true); 
            }
        }
       
        
        
        
        this.addChild(startlayer);
        return true;
    },
    clearGameAni: function(){
        var self = this;
        console.log("클리어게임 애니메이션 동작!");
       
    },
    update: function (dt) {
         
        var self = this;
        this.wtime += dt;
//        console.log("time is ",this.wtime);
        var nowtime = Math.floor(this.wtime);
//        console.log("status is "+this.status);
//         console.log("nowtime is "+nowtime+" beforetime "+this.before_time);
//        if (nowtime > this.before_time+0.5) {
//            console.log("this.handcnt is ",this.handcnt);
//            this.handcnt++;
//            this.updateHand();
//            this.before_time = this.wtime;
//        }
         for(var i = 0 ; i < self.ani_datas.length;i++)
            C_updateAnimation(self.ani_datas[i], this.wtime);
        
        //애니메이션 이미지 처리
//        self.ani_sps.forEach(function (ani) {
//            if (!ani.elapsed) ani.elapsed = 0;
//            if (ani.currentIndex === undefined) ani.currentIndex = -1;
//
//            ani.elapsed += dt * 1000; // dt는 초 단위 → ms 단위로 변환
//
//            let totalTime = ani.anitime;            // 예: 1000ms
//            let frameCount = ani.sps.length;        // 예: 5
//            let frameTime = totalTime / frameCount; // 예: 200ms
//
//            // 몇 번째 프레임을 보여야 하는가?
//            let newIndex = Math.floor(ani.elapsed / frameTime);
//
//            if (newIndex !== ani.currentIndex && newIndex < frameCount) {
//                // 이전 프레임 숨기기
//                if (ani.currentIndex >= 0 && ani.sps[ani.currentIndex]) {
//                    ani.sps[ani.currentIndex].setVisible(false);
//                }
//
//                // 새 프레임 보이기
//                if (ani.sps[newIndex]) {
//                    ani.sps[newIndex].setVisible(true);
//                }
//
//                ani.currentIndex = newIndex;
//            }
//
//            // 애니메이션 종료 처리 (루프 원하면 여기 수정)
//            if (ani.elapsed >= totalTime) {
//                ani.elapsed = totalTime; // 멈추기
//                // 또는 루프 시:
//                // ani.elapsed = 0;
//                // ani.currentIndex = -1;
//            }
//        });
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
                    }else if(event.page == "map"){
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
