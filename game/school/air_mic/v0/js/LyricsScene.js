var ly_tag = {
    btn_close: 0, //닫기
    btn_ques: 1, //힌트
    btn_sndoff : 2, //사운드끄기
    btn_sndon : 3,//사운드켜기
    btn_lyric : 4, //가사집
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
    _callback : null,
    _timeover : false,
     _boundUpdateTimer: null,
    _limitTime : 1800,  //타임오버 시간 3분
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
        console.log("")
        this._elapsedTime++;
        if (this._timerLabel) {
            this._timerLabel.setString(this._formatTime(parseInt(this._elapsedTime/10)));
        }
        
        if(this._elapsedTime >= this._limitTime && !this._timeover){
            this._timeover = true;
            this._callback(this._elapsedTime/10);
        }
    },

    /**
     * 게임 타이머를 시작합니다.
     * @param {cc.Node} parent - 타이머 UI를 추가할 부모 노드 (예: this, scene 등)
     * @param {number} x - 타이머가 위치할 x 좌표
     * @param {number} y - 타이머가 위치할 y 좌표
     */
    startGameTime: function(parent, x, y, callback) {
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
        this._callback = callback;
        this._timeover = false;

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
        this._boundUpdateTimer = this._updateTimer.bind(this);
        parent.schedule(this._boundUpdateTimer, 0.1, cc.REPEAT_FOREVER, 0);
    },
    
    /**
     * 게임 타이머를 중지합니다.
     */
    stopGameTime: function() {
        if (this._isTimerRunning && this._scheduledTarget && this._boundUpdateTimer) {
            // ★★★ 수정 6: 저장된 함수로 스케줄 해제
            this._scheduledTarget.unschedule(this._boundUpdateTimer);

            this._isTimerRunning = false;
            this._scheduledTarget = null;
            this._boundUpdateTimer = null; // 참조 정리

            return this._elapsedTime/10;
        }
        return 0; // 타이머가 실행 중이 아닐 경우
    },
    getTime: function(){
        return this._elapsedTime/10;
    }
};
var LyricsLayer = cc.Layer.extend({
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
    
    btn_sndon : null,
    btn_sndoff : null,
    txt_board : null,
    ranking_bg :null,
    ctor:function () {
        //////////////////////////////
        // 1. super init first
        this._super();
        //console.log("LogoLayer!!");
        /////////////////////////////
        // 2. add a menu item with "X" image, which is clicked to quit the program
        //    you may modify it.
        // ask the window size
        
        this.init();
        return true;
    },
    init:function(){
           var self = this;
        this.removeAllChildren();
        var size = cc.winSize;
        self.sps_sea_charbox = [];
        self.sps_white_charbox = [];
        self.isStartClick = false;
        
        //배경색
        this.addChild(new cc.LayerColor.create(cc.color(255, 36, 62, 100)));
        
        
        ///////////////////////////////////////
        // 시작 레이어 START
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
        
        var txt_start = C_AddSprite(startlayer,res.n_lyrics_txt_start, size.width/2, C_getY(500),null,null,null); //START 글자
        
        txt_start.setVisible(false);

        
        self.ranking_bg = C_AddSprite(startlayer,res.n_lyrics_ranking_bg, size.width/2, C_getY(1200),null,null,null); //START 글자
        // 4. 생성한 리스너를 투명 레이어에 추가
        cc.eventManager.addListener(listener, startlayer);
        var btn_start = C_AddButton(startlayer, res.n_lyrics_start_normal, res.n_lyrics_start_click, size.width/2, 300, null, null, null, function(){
            if(!self.isStartClick){
                C_PlaySound(SOUND.SND_BUTTONTOUCH);
//                self.txt_board.setVisible(true);
//                var label = C_AddCustomFont(self.txt_board, "어디~ 교가실력\n한번 봐볼까나?~" ,  630,190, null, 2, null, 40, cc.color(88, 72, 10), true); 
                self.ranking_bg.setVisible(false);
                btn_start.setVisible(false);
                self.showMessage("어디~ 교가실력\n한번 봐볼까나?~");
                var move = cc.moveBy(3,0,-30);              
                self.txt_board.runAction(move);
                
                self.isStartClick = true;
                
                setTimeout(function(){    
                    txt_start.setVisible(true);
                    runScaleOutAnimation(txt_start);
                    C_PlaySound(SOUND.BGM,true);
                },1500);
                setTimeout(function(){
                    startlayer.runAction(cc.RemoveSelf.create());  
                    GameTimerManager.startGameTime(self.bg, size.width / 2+370, C_getY(330),function(timeoverTime){
                        console.log("timeoverTime is "+timeoverTime);
                        GameTimerManager.stopGameTime();
                        C_StopMusic();
                        self.failGameAni();
                    });
                },3000);                
                
            }
            
        },null);
        C_ScaleRepeatAni(btn_start, 1.5, 1.1);
        ///////////////////////////////////////
        // 시작 레이어 END
        ///////////////////////////////////////
        
        
        //배경이미지
        self.bg = C_AddSprite(self,res.n_lyrics_bg, size.width/2, C_getY(size.height/2),null,null,null);
       
        //About 버튼
        C_AddAnimButton(self, res.n_lyrics_ques_normal,   res.n_lyrics_ques_click,60,C_getY(60), ly_tag.btn_ques, 1, 1, function (tag){
            console.log("힌트 클릭!!"+tag);
            C_PlaySound(SOUND.SND_BUTTONTOUCH);
            C_ShowImageDialogLayer(self, "어떻게 해요?" , "① 아래 바닷가에서 글자를 선택해요 \n② 위쪽 네모칸을 선택해서 모든 글자를 완성해요", res.n_lyrics_img_hint, function(){
                            
            });  
            initTime(self);
        });
        //사운드 ON
        self.btn_sndon = C_AddAnimButton(self, res.n_lyrics_sndon_normal,   res.n_lyrics_sndon_click, 150, C_getY(60), ly_tag.btn_sndon, 1, 1, function (tag){
            C_PlaySound(SOUND.SND_BUTTONTOUCH);
            console.log("사운드ON 클릭!!"+tag);
            
            isPlaySound = false;
            
            self.updateSoundBtn();
            initTime(self);
        });
        //사운드 OFF
        self.btn_sndff = C_AddAnimButton(self, res.n_lyrics_sndoff_normal,   res.n_lyrics_sndoff_click, 150, C_getY(60), ly_tag.btn_sndoff, 1, 1, function (tag){
            C_PlaySound(SOUND.SND_BUTTONTOUCH);
            console.log("사운드OFF 클릭!!"+tag);
            
            isPlaySound = true;
          
            self.updateSoundBtn();
            initTime(self);
        });
         //가사보기 버튼
        C_AddAnimButton(self, res.n_lyrics_icon_lyric,   res.n_lyrics_icon_lyric, 240,C_getY(60), ly_tag.btn_ques, 1, 1, function (tag){
            console.log("힌트 클릭!!"+tag);
            C_PlaySound(SOUND.SND_BUTTONTOUCH);
            var lyric = C_replaceAll(param_lyrics,"|", "\n");
            C_ShowDialogLayer(self, "노래가사" , lyric, function(){
                            
            });   
            initTime(self);
        });
      
        
        //닫기 버튼
        C_AddAnimButton(self, res.n_lyrics_close_normal,   res.n_lyrics_close_click,size.width-60,C_getY(60), ly_tag.btn_close, 1, 1, function (tag){
            
            console.log("닫기 클릭!!"+tag);
            if(home_scene != SCENE_LYRICS){
                C_StopMusic();
                C_PlaySound(SOUND.SND_BUTTONTOUCH);
                C_nextScene(home_scene);
            }
            initTime(self);
        });
        
        ///////////////////////////////////////
        // 구름 배경 애니메이션
        ///////////////////////////////////////
        var cloud0 = C_AddSprite(self,res.n_lyrics_cloud1, 300, C_getY(100),null,null,null);
        var cloud1 = C_AddSprite(self,res.n_lyrics_cloud0, size.width/2+200, C_getY(250),null,null,null);
        var cloud2 = C_AddSprite(self,res.n_lyrics_cloud1, 30, C_getY(100),null,null,null);
        C_StartScrollFrom(cloud0,300, C_getY(100),30);
        C_StartScrollFrom(cloud1,size.width/2+200, C_getY(180),55);
        C_StartScrollFrom(cloud2,300, C_getY(250),10);
        
        self.sp_wrong = C_AddSprite(self.bg,res.n_lyrics_wrong, size.width/2,  C_getY(700) ,null,null,9999);
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
        const wsize = [0,80,140,200,260,320,380,440,500,560,620,680,740,800,860,920,980,1040,1100,1160,1220];
        const rect_size = 80;
        const empty_size = 30;

        for (var i = 0; i < ll.length; i++) {

            // 단어 단위 or 글자 단위 분리
            var chars = param_isword ? ll[i].split(' ') : ll[i].split('');

            var starty = C_getY(500 + i * rect_size);

            // === 1. 줄 전체 길이 계산 ===
            var line_width = 0;
            for (var j = 0; j < chars.length; j++) {
                if(param_isword){
                    line_width += j < chars.length-1 ? wsize[chars[j].length] + empty_size : wsize[chars[j].length];    
                }else{
                    line_width += chars[j] != " " ? rect_size : empty_size; 
                }
                
            }
            console.log(i + ") line_width " + line_width);

            // === 2. 줄 시작 X 좌표 (화면 가운데 정렬) ===
            var startx = (size.width - line_width) / 2;

            // === 3. 글자 박스 배치 ===
            for (var j = 0; j < chars.length; j++) {
                var w = (chars[j] != " " ? wsize[chars[j].length] : empty_size);

                if (chars[j] != " ") {
                    var tag = chars[j];
                    const _sx = startx + w / 2; // 박스 중심 좌표
                    const _sy = starty;

                    var sp_txtbg = new cc.Scale9Sprite(res.n_lyrics_rect_select);
                    sp_txtbg.x = _sx;
                    sp_txtbg.y = _sy;
                    sp_txtbg.width = w;
                    sp_txtbg.height = rect_size;
                    self.bg.addChild(sp_txtbg);

                    cc.log(chars[j] + " width " + sp_txtbg.width + " height " + sp_txtbg.height);
              
                    startx += w;
                   
//                   //빨간 배경네모
//                    var sp_txtbg = C_AddSprite(self.bg, res.n_lyrics_rect_select, _sx, _sy,tag,1,null,null,null);
                    //글자
                    C_AddCustomFont(sp_txtbg, chars[j] , (sp_txtbg.width)/2, 30, null, 2, null, 28, cc.color(55, 10, 20), true);   
                    
                    if(chars[j] == "")continue;
                    
                     if(param_isword)startx += empty_size;
                   
                    
                    
                    var _mysp = C_Add9PatchSpriteTouchReturnSP(self.bg,res.n_lyrics_rect_normal, _sx, _sy,  wsize[chars[j].length], rect_size, chars[j], null, null, function(_sp){
                          initTime(self);//터치초기화 60초로
                                
                        if(self.now_click_sp && self.now_click_sp.getTag() == _sp.getTag()){

                            C_PlaySound(SOUND.BOOM);
                            C_PlayBrickBreakEffect(self.bg,_sx,_sy);//깨지는 파티클



                            setTimeout(function(){
                                removeSprite(self.sps_white_charbox, _sp);//_sprite 를 지운다.                                
                                removeSprite(self.sps_sea_charbox, self.now_click_sp);//sea_sprite 를 지운다.        
                            },500);



                            setTimeout(function(){
                                console.log("결과체크 남은갯수 "+self.sps_white_charbox.length);
                                if(self.sps_white_charbox.length == 0){
                                    C_StopMusic();
                                    var cleartime = GameTimerManager.stopGameTime();
                                    self.clearGameAni(cleartime);
                                }
                            },2800);

                        }else {
                             C_PlaySound(SOUND.WRONG);
                            self.sp_wrong.setVisible(true);
                            setTimeout(function(){
                                self.sp_wrong.setVisible(false);
                            },1000);
                        }
                    });
                    self.sps_white_charbox.push(_mysp);
                    
                    
                    
                    
                    
                    
                    
//                    var sp_charbox = new cc.Scale9Sprite(res.n_lyrics_rect_normal);
//                    sp_charbox.x = _sx;
//                    sp_charbox.y = _sy;
//                    sp_charbox.tag = chars[j];
//                    sp_charbox.width = wsize[chars[j].length];
//                    sp_charbox.height = rect_size;
//                    self.bg.addChild(sp_charbox);
//
//                    console.log(chars[j] + " width " + sp_charbox.width + " height " + sp_charbox.height);
//
//                   
//                    // 터치 리스너 등록
//                    const _sp = sp_charbox;
//                    cc.eventManager.addListener({
//                        event: cc.EventListener.TOUCH_ONE_BY_ONE,
//                        swallowTouches: true,
//                        onTouchBegan: function (touch, event) {
//                            console.log("addListener 가사박스 리스너");
//                            var target = event.getCurrentTarget();
//                            var locationInNode = target.convertToNodeSpace(touch.getLocation());
//                            var size = target.getContentSize();
//                            var rect = cc.rect(0, 0, size.width, size.height);
//
//                            if (cc.rectContainsPoint(rect, locationInNode)) {
//                                console.log("하얀박스클릭 "+_sp.tag);
//                            
//                                initTime(self);
//                                
//                                console.log("now_click_sp.getTag() "+self.now_click_sp.getTag()+" "+_sp.getTag());
//                                if(self.now_click_sp && self.now_click_sp.getTag() == _sp.getTag()){
//                                    
//                                    C_PlaySound(SOUND.BOOM);
//                                    C_PlayBrickBreakEffect(self.bg,_sx,_sy);//깨지는 파티클
//
//
//
//                                    setTimeout(function(){
//                                        removeSprite(self.sps_white_charbox, _sp);//_sprite 를 지운다.                                
//                                        removeSprite(self.sps_sea_charbox, self.now_click_sp);//sea_sprite 를 지운다.        
//                                    },500);
//
//
//
//                                    setTimeout(function(){
//                                        console.log("결과체크 남은갯수 "+self.sps_white_charbox.length);
//                                        if(self.sps_white_charbox.length == 0){
//                                            C_StopMusic();
//                                            var cleartime = GameTimerManager.stopGameTime();
//                                            self.clearGameAni(cleartime);
//                                        }
//                                    },2800);
//
//                                }else {
//                                     C_PlaySound(SOUND.WRONG);
//                                    self.sp_wrong.setVisible(true);
//                                    setTimeout(function(){
//                                        self.sp_wrong.setVisible(false);
//                                    },1000);
//                                }
//                       
//                                return true; // 터치 이벤트 잡았음
//                            }
//                            return false;
//                        }
//                    }, sp_charbox);
//                    self.sps_white_charbox.push(_sp);
//                    
//                    console.log("self.sps_white_charbox ",self.sps_white_charbox);
                    //하얀 네모박스
//                    var sp_charbox = C_AddSpriteTouchReturnSP(self.bg, res.n_lyrics_rect_normal, _sx, _sy,tag,null,null,function(_sp){
//                        console.log("클릭 네모");
//                        initTime(self);
//                        if(self.now_click_sp && self.now_click_sp.getTag() == _sp.getTag()){
//                            C_PlaySound(SOUND.BOOM);
//                            C_PlayBrickBreakEffect(self.bg,_sx,_sy);//깨지는 파티클
//                            
//                            
//                            
//                            setTimeout(function(){
//                                removeSprite(self.sps_white_charbox, _sp);//_sprite 를 지운다.                                
//                                removeSprite(self.sps_sea_charbox, self.now_click_sp);//sea_sprite 를 지운다.        
//                            },500);
//                            
//                           
//                               
//                            setTimeout(function(){
//                                if(self.sps_white_charbox.length == 0){
//                                    C_StopMusic();
//                                    var cleartime = GameTimerManager.stopGameTime();
//                                    self.clearGameAni(cleartime);
//                                }
//                            },2800);
//                            
//                            
////                            console.log("남은갯수 "+self.sps_white_charbox.length);
//                        }
//                        else {
//                             C_PlaySound(SOUND.WRONG);
//                            self.sp_wrong.setVisible(true);
//                            setTimeout(function(){
//                                self.sp_wrong.setVisible(false);
//                            },1000);
//                        }
//                       
//                        
//                    });
//                    self.sps_white_charbox.push(sp_charbox);
                }else {
                    console.log("빈칸");
                    startx += empty_size;
                }
                
            }
        }
        
        var numbers = [];
        var lyric_arr = [];
        //단어순으로
         if(param_isword){
             var lyric_str = C_replaceAll(param_lyrics,'|', " ");
             lyric_arr = lyric_str.split(' '); 
             numbers = getUniqueRandomNumbers(40, lyric_arr.length);
             console.log("단어순으로",lyric_arr);
         }
        //1개 글자순으로
        else {
            //순수 글자만 추출 공백 제거
            var lyric_str = C_replaceAll(param_lyrics,'|', "");
            lyric_str = C_replaceAll(lyric_str,' ', "");
            console.log("lyric_str "+lyric_str);
            lyric_arr = lyric_str.split(''); 
            numbers = getUniqueRandomNumbers(40, lyric_str.length);
            console.log("1글자순으로");
         }
        
        console.log("ㄴㄴㄴ ",lyric_arr);
        
        ///////////////////////////////////////
        // 바닷가에 떠다니는 글자 애니메이션 40ro
        ///////////////////////////////////////
        var tide0 = C_AddSprite(self,res.n_lyrics_tide0, size.width/2, C_getY(size.height-700),null,null,null);//파도0
        var tide1 = C_AddSprite(self,res.n_lyrics_tide1, size.width/2, C_getY(size.height-500),null,null,null);//파도1
        var tide2 = C_AddSprite(self,res.n_lyrics_tide0, size.width/2, C_getY(size.height-300),null,null,null);//파도2
        var tide3 = C_AddSprite(self,res.n_lyrics_tide1, size.width/2, C_getY(size.height-100),null,null,null);//파도3
        
        var trect_default_width = 200;
        var trect_sizex = 100;
        var trect_sizey = 200;
        var tides = [tide0,tide1,tide2,tide3];
        for(var j = 0 ; j < tides.length; j++){
            var rand_tide_time = 3 + Math.random()*40/10;
            var rand_tide_updown = Math.random()*30+20;
            
            C_LeftRightRepeatAni(tides[j], rand_tide_time, size.width);
            
            
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
                    tag = lyric_arr[isin];
//                    console.log("*** 태그 : "+tag);
                }
                
                
                if(tag != ""){
                                    
                    var randx = i*200+Math.random()*180;                
                    var randy = Math.random()*200+100;
    //                console.log("i "+i+" j "+j+ " randx "+randx+" randy "+randy);

                    var len = tag.length;
                    
                    var _mysp = C_Add9PatchSpriteTouchReturnSP(tides[j], res.n_lyrics_charbox0, randx, randy,  trect_default_width+ trect_sizex * (len-1), trect_sizey, tag, null, null, function(_sp){
                         initTime(self);//터치초기화 60초로
                        C_PlaySound(SOUND.OBJ_CLICK);
                        self.now_click_sp = _sp;
                        C_StartBlinkingWithColor(_sp,1,"#ffaabb");
                        
                    });
                     self.sps_sea_charbox.push(_mysp);
                     var rand_updown = Math.random()*30+20;
                    var rand_time = 1+ Math.random()*10/10;
                    C_UpDownRepeatAni(_mysp, rand_time,rand_updown);

                    var randr = Math.random()*250;
                    var randg = Math.random()*250;
                    var randb = Math.random()*250;
                    C_AddCustomFont(_mysp, tag , _mysp.width/2, 120, null, 2, null, 35, cc.color(randr, randg, randb), true); 
                    
                    
                    
                    
//                    var sp_charbox = new cc.Scale9Sprite(res.n_lyrics_charbox0);
//                    sp_charbox.x = randx;
//                    sp_charbox.y = randy;
//                    sp_charbox.tag = tag;
//                    sp_charbox.width = trect_default_width+ trect_sizex * (len-1);
//                    sp_charbox.height = trect_sizey;
//                    tides[j].addChild(sp_charbox);

                    

                    // 터치 리스너 등록
//                    const _sp = sp_charbox;
//                    cc.eventManager.addListener({
//                        event: cc.EventListener.TOUCH_ONE_BY_ONE,
//                        swallowTouches: true,
//                        onTouchBegan: function (touch, event) {
//                            console.log("addListener 바닷가 글자 리스너");
//                            var target = event.getCurrentTarget();
//                            var locationInNode = target.convertToNodeSpace(touch.getLocation());
//                            var size = target.getContentSize();
//                            var rect = cc.rect(0, 0, size.width, size.height);
//
//                            if (cc.rectContainsPoint(rect, locationInNode)) {
//                                console.log("바닷가 박스클릭 "+_sp.tag);
//                                
//                                initTime(self);
//                                C_PlaySound(SOUND.OBJ_CLICK);
//                                self.now_click_sp = _sp;
//                                C_StartBlinkingWithColor(_sp,1,"#ffaabb");
//                                
//                                return true; // 터치 이벤트 잡았음
//                            }
//                            return false;
//                        }
//                    }, sp_charbox);
                    
                    
                    
                    
                    
//                    var sp_charbox = C_AddSpriteTouchReturnSP(tides[j],res.n_lyrics_charbox0, randx, randy,tag,null,null,function(_sp){
//                        initTime(self);
//    //                    console.log("sprite click1!! "+_sp);
//                        C_PlaySound(SOUND.OBJ_CLICK);
//                        self.now_click_sp = _sp;
//                        C_StartBlinkingWithColor(_sp,1,"#ffaabb");
//
//                    });
                    
                    
                    //self.sps_sea_charbox.push({"tag":tag,"sp":sp_charbox});
//                    self.sps_sea_charbox.push(sp_charbox);
                    
//                    var rand_updown = Math.random()*30+20;
//                    var rand_time = 1+ Math.random()*10/10;
//                    C_UpDownRepeatAni(sp_charbox, rand_time,rand_updown);
//
//                    var randr = Math.random()*250;
//                    var randg = Math.random()*250;
//                    var randb = Math.random()*250;
//                    C_AddCustomFont(sp_charbox, tag , sp_charbox.width/2, 120, null, 2, null, 35, cc.color(randr, randg, randb), true); 
                }
            }
        }
       
        loadRanking(function(rankingData){
           console.log("rankingData ",rankingData);
            self.updateRankingUI(rankingData);
        });
        this.updateSoundBtn(true);
        
        this.addChild(startlayer);
       
        if (getgamedata.hm_content_data) {
            checkFirstScene(JSON.parse(getgamedata.hm_content_data));
        }
        
        
        self.txt_board = C_AddSprite(self.bg,res.n_lyrics_txt_board, size.width/2, C_getY(800),null,null,null); // 할아버지 
        self.txt_board.setVisible(false);
        
        
         ////////////////////////////////////
        //일정시간 입력없을때 홈으로가도록 설정
        /////////////////////////////////////
        this.enableInputTracking();
        this.resetInactivityTimer(); // 최초 타이머 설정
        C_checkSafetyDialogShow(self);
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
        
        if(home_scene != SCENE_LYRICS){
            C_StopMusic();
            gotoHomeScene();
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
    
    updateRankingUI : function(list){
        var self = this;
         self.ranking_bg.removeAllChildren();
        for(var i = 0 ; i < list.length;i++){
            var score = list[i].score;
            var nickname = list[i].nickname;
            C_AddCustomFont(self.ranking_bg, score+"초" ,  240, 355-i*120, null, 2, null, 20, cc.color(55, 22, 10), true);     
            C_AddCustomFont(self.ranking_bg, nickname ,  480,355-i*120, null, 2, null, 20, cc.color(55, 22, 10), true);     
        }
        
        
    },  
    showMessage:function(txt){
        var self = this;
        self.txt_board.removeAllChildren();
        self.txt_board.setVisible(true);
        C_AddCustomFont(self.txt_board, txt ,  630,190, null, 2, null, 35, cc.color(88, 72, 10), true); 
        setTimeout(function(){
            self.txt_board.setVisible(false);
        },3000);        
    },
    updateSoundBtn:function(isfirst){
        var self = this;
        console.log("isPlaySound is "+isPlaySound);
        if(!isPlaySound){
            self.btn_sndon.setVisible(false);
            self.btn_sndff.setVisible(true);
            if(!isfirst)C_StopMusic();
        }else{
            self.btn_sndon.setVisible(true);
            self.btn_sndff.setVisible(false);
             if(!isfirst)C_PlaySound(SOUND.BGM,true);
        }
    },
    clearGameAni: function(cleartime){
        if(cleartime == 0)return;
        var self = this;
        C_PlaySound(SOUND.CLEAR);
        console.log("클리어게임 애니메이션 동작!");
        var size = cc.winSize;
        
        self.showMessage("축하해요! 시간이\n"+cleartime+"초 걸렸어요!");
        
        var rank = updateRankingData(cleartime);
        
        //순위안에 들었다면 
        if(rank >= 0 && rank < 3){
            showInputRankingPopup(cleartime, rank);   
        }else {
            setTimeout(function(){
                C_nextScene(SCENE_LYRICS);
            },3000); 
        }
        
       
    },
    failGameAni: function(){
        var self = this;
        var size = cc.winSize;
        console.log("타임오버");
         C_PlaySound(SOUND.FAIL);
        
        var bg = C_AddSprite(self.bg, res._global_img_ninepatch2_bg, size.width/2, size.height/2,null,100,null); 
        
        var img_timeover = C_AddSprite(self.bg, res.n_lyrics_timeover, size.width/2, C_getY(600),null,null,null); 
        var scale = cc.scaleTo(1,1.5);
        img_timeover.runAction(scale);
        
        setTimeout(function(){
            self.init();    
        },3000);
        
        
        
       
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
var LyricsScene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new LyricsLayer();
        this.addChild(layer);
    }
});

function complete_media(){
    //console.log("bg sound loaded!!");

}
