//var NOW_SCENE = 0;
//function C_nextScene(state,data){
//    var sc;
//    //var res;
//    if(sc != null) sc = null;
//    NOW_SCENE = state;
//    switch(state){
//        case SCENE_HOME:
//
//            sc = new LogoScene(data);
//            //res = menu_resources;
//            break;
//        case SCENE_MENU:
//
//            sc = new MenuScene(data);
//            //res = menu_resources;
//            break;
//        case SCENE_GAME:
//            sc = new GameScene(data);
//            //res = menu_resources;
//            break;
//        case SCENE_HELP:
//            sc = new HelpScene(data);
//            //res = menu_resources;
//            break;
//        case SCENE_LYRICS:
//            sc = new LyricsScene(data);
//            //res = menu_resources;
//            break;
//
//
//    }
//    
//    sc.setTag(state);
//    cc.director.runScene(sc);
// }




//var NOW_SCENE = 0;
//
//function C_nextScene(state, data) {
//    NOW_SCENE = state;
//    var sc = null;
//
//    // 1. 새 씬 인스턴스 생성 (이때 내부 리소스 로드 시작)
//    switch (state) {
//        case SCENE_HOME:   sc = new LogoScene(data); break;
//        case SCENE_MENU:   sc = new MenuScene(data); break;
//        case SCENE_GAME:   sc = new GameScene(data); break;
//        case SCENE_HELP:   sc = new HelpScene(data); break;
//        case SCENE_LYRICS: sc = new LyricsScene(data); break;
//    }
//
//    if (sc) {
//        sc.setTag(state);
//
//        // 2. [핵심] 씬을 화면 밖으로 이동시켜서 로딩 과정을 숨김
//        // 사실 Transition을 사용하면 엔진이 내부적으로 처리해주지만, 
//        // 명시적으로 슬라이드 효과를 주면 더 안전하고 부드럽습니다.
//        
//        // TransitionMoveInR: 새 씬이 오른쪽에서 왼쪽으로 밀고 들어옴 (가장 대중적)
//        // 0.5초 동안 부드럽게 이동하며, 이전 씬은 뒤에 그대로 있다가 교체됨
//        var transition = cc.TransitionMoveInR.create(0.5, sc);
//
//        // 3. 만약 'SCENE_HOME'으로 갈 때는 반대로 왼쪽에서 들어오게 하고 싶다면?
//        if (state === SCENE_HOME) {
//            transition = cc.TransitionMoveInL.create(0.5, sc); // 왼쪽에서 들어옴
//        }
//
//        // 4. 장면 전환 실행
//        cc.director.runScene(transition);
//    }
//}





////다음씬이 오른쪽에서 왼쪽으로 나오기
//var NOW_SCENE = 0;
//var CURRENT_LAYER = null; // 현재 화면에 떠 있는 레이어를 추적
//
//function C_nextScene(state, data) {
//    // 1. 현재 실행 중인 씬 객체를 가져옵니다.
//    var runningScene = cc.director.getRunningScene();
//    if (!runningScene) return;
//
//    // 2. 기존에 덮어씌워진 레이어가 있다면 제거 (선택 사항)
//    if (CURRENT_LAYER) {
//        CURRENT_LAYER.removeFromParent(true);
//    }
//
//    var nextLayer = null;
//    NOW_SCENE = state;
//
//    // 3. 씬 대신 '레이어' 객체로 생성 (각 Scene 클래스들을 Layer 클래스로 구성했다고 가정)
//    switch (state) {
//        case SCENE_HOME:
//            nextLayer = new LogoLayer(data); // Scene이 아닌 Layer여야 함
//            break;
//        case SCENE_MENU:
//            nextLayer = new MenuLayer(data);
//            break;
//        case SCENE_GAME:
//            nextLayer = new GameLayer(data);
//            break;
//        case SCENE_HELP:
//            nextLayer = new HelpLayer(data);
//            break;
//    }
//
//    if (nextLayer) {
//        nextLayer.setTag(state);
//        // 4. 현재 씬 위에 덮어씌우기 (Z-index를 높게 설정)
//        runningScene.addChild(nextLayer, 999);
//        CURRENT_LAYER = nextLayer;
//        
//        // 5. 부드럽게 슥~ 나타나게 하고 싶다면 (페이드 말고 이동 효과)
//        nextLayer.setPosition(cc.p(1920, 0)); // 화면 오른쪽 밖에서 대기
//        nextLayer.runAction(cc.moveTo(0, cc.p(0, 0)).easing(cc.easeExponentialOut()));
//    }
//}




//// 홈씬으로 갈때 이전씬이 오른쪽으로 사라지기 , 다음씬이 오른쪽에서 왼쪽으로 나오기
var NOW_SCENE = 0;
var CURRENT_LAYER = null; 

function C_nextScene(state, data) {
    var runningScene = cc.director.getRunningScene();
    if (!runningScene) return;

    var prevLayer = CURRENT_LAYER; // 기존에 떠 있던 레이어 저장
    var nextLayer = null;
    
    

    // 1. 레이어 생성
    switch (state) {
        case SCENE_HOME: nextLayer = new LogoLayer(data); break;
        case SCENE_MENU: nextLayer = new MenuLayer(data); break;
        case SCENE_GAME: nextLayer = new GameLayer(data); break;
        case SCENE_HELP: nextLayer = new HelpLayer(data); break;
    }

    if (!nextLayer) return;
    nextLayer.setTag(state);

    if (state === SCENE_HOME) {
        // --- [HOME으로 돌아갈 때: 기존 레이어가 오른쪽으로 사라짐] ---
        
        // 1. 새 레이어(HOME)를 기존 레이어 "아래"에 추가
        runningScene.addChild(nextLayer, 0); 
        nextLayer.setPosition(0, 0); // 홈은 제자리에 고정
        
        if (prevLayer) {
            // 2. 기존 레이어를 오른쪽으로 밀어내기
            var moveOut = cc.moveTo(0.5, cc.p(1920, 0)).easing(cc.easeExponentialOut());
            var remove = cc.callFunc(function() {
                prevLayer.removeFromParent(true);
            });
            prevLayer.runAction(cc.sequence(moveOut, remove));
        }
    } else {
        // --- [다른 씬으로 갈 때: 새 레이어가 오른쪽에서 들어옴] ---
        var movetime = NOW_SCENE == SCENE_HOME ? 0.5 : 0;
        var sx = NOW_SCENE == SCENE_HOME ? 1920 : 0;
        // 1. 새 레이어를 기존 레이어 "위"에 추가
        runningScene.addChild(nextLayer, 999);
        nextLayer.setPosition(sx, 0); // 오른쪽 밖에서 대기
        
        var moveIn = cc.moveTo(movetime, cc.p(0, 0)).easing(cc.easeExponentialOut());
        var removePrev = cc.callFunc(function() {
            if (prevLayer) prevLayer.removeFromParent(true);
        });
        
        // 이동 완료 후 메모리 관리를 위해 이전 레이어 삭제
        nextLayer.runAction(cc.sequence(moveIn, removePrev));
    }
    NOW_SCENE = state;
    CURRENT_LAYER = nextLayer;
}







function C_Shuffle(d){
    for(var c = d.length-1;c>0;c--){
        var b = Math.floor(Math.random()*(c+1));
        var a = d[c]; d[c] = d[b]; d[b] = a;
    }
    return d;
}
function C_GetPlistsArray(plists, ppngs, mdata){
    var lists = mdata;
    for(var i = 0; i < plists.length; i++){
        var plist = plists[i];
        var ppng = ppngs[i];
        var cache = cc.spriteFrameCache;
        cache.addSpriteFrames(plist,ppng);
        for (var key in cache._spriteFrames) {
            var frame = cache.getSpriteFrame(key);
            var sp = cc.Sprite.createWithSpriteFrame(frame);
//            console.log("sp is ",sp);
            lists[key].sprite = sp;
        }
    }
    return lists;
}

function C_GetPlists(plist, ppng, mdata){
    var lists = mdata;
    var cache = cc.spriteFrameCache;
    cache.addSpriteFrames(plist,ppng);
    for (var key in cache._spriteFrames) {
        var frame = cache.getSpriteFrame(key);
        var sp = cc.Sprite.createWithSpriteFrame(frame);
       console.log(key+" sp is ",sp);
             lists[key].sprite = sp;
    }
    return lists;
}
function C_loadsound(){
//    ion.sound({
//        sounds: [
//            {name: SOUND.BG,loop: true},
//            {name: SOUND.STONE,loop: false},
//            {name: SOUND.WIN,loop: false},
//            {name: SOUND.FAIL,loop: false},
//            {name: SOUND.CLOCK,loop: false},
//            {name: SOUND.BTN_CLICK,loop: false},
//            {name: SOUND.CASH,loop: false},
//            {name: SOUND.GAMESTART,loop: false}
//        ],
//
//        path: "res/snd/",
//        preload: true,
//        multiplay: false,
//        volume: 0.9,
//        ready_callback: C_complete_media
//    });
}
var isPlaySound = true;
function C_PlaySound(id,isloop){

    
        if(isloop) {
            if(isPlaySound)cc.audioEngine.playMusic("contentdata/bgm/"+id+".mp3", true);
        }            
        else
            cc.audioEngine.playEffect("res/sound/"+id+".mp3");    
    
}
function C_PlayMusic(id){
	if(id == undefined || id == null){
		if(IS_NEW_MULTI){
			var lvl = NEW_CHALLENGE_MODE == 0 ? RANDOM_STAGE_COUNT : ALL_GAMEDATA.RANDOM_STAGE_COUNT;
			if(lvl%2 == 0)id = SOUND.SND_GAME_BGM;
			else id = SOUND.SND_HOME_BGM;	 
		}else{
			if(m_nNowStage%2 == 1)
				id = SOUND.SND_GAME_BGM;
			else 
				id = SOUND.SND_HOME_BGM;	
		}
		
	}
		
    C_StopMusic();
    C_PlaySound(id);
}
function C_StopMusic(){
    cc.audioEngine.stopMusic(true);
     cc.audioEngine.stopAllEffects();
    
}
function C_IsGameSound(){
    return SAVEDATA.SOUND;
}
function C_complete_media(){
    //console.log("C_complete_media");
}
function C_PauseSound(id){
    //console.log("C_PauseSound "+MYINFO.ISSOUND);
   
//    ion.sound.stop(id);
    
}
function C_ResumeSound(id){
//    if(MYINFO.ISSOUND)ion.sound.play(id);
        
}
function C_StopSound(id){
   
//    ion.sound.stop(id);
}



function C_GetMenu(key,mid, item_list,x,y,_this,callback){
    var mitems = [];
    var self = _this;
    for(var i = 0 ; i < item_list.length; i++){
        var m = item_list[i];
        var _x = m.x != undefined ? m.x : _this._plists[m.on].x;
        var _y = m.y != undefined ? m.y : _this._plists[m.on].y;
        var ax = m.ah != undefined ? C_getAnchor(m.ah).x : C_getAnchor(ANCHOR_LT).x;
        var ay = m.ah != undefined ? C_getAnchor(m.ah).y : C_getAnchor(ANCHOR_LT).y;
        var v = m.v != undefined ? m.v : true;    

        var mitem = C_LoadMenuItem(_this, key, m.id, m.on, m.off,_x,_y, ax , ay, v, function(key, id){
           callback(key,id);
        });
        mitems.push(mitem);

    }
    
    var menu = new cc.Menu(mitems);
    menu.x = x;
    menu.y = y;
    menu.setTag(mid);
    return menu;
}
function C_getAnchor(a){
    var achor = {"x":0,"y":1};
    switch(a){
        case ANCHOR_LT:
            break;
        case ANCHOR_CT:
            achor.x = 0.5;
            break;
        case ANCHOR_RT:
            achor.x = 1;
            break;
        case ANCHOR_CC:
            achor.x = 0.5;
            achor.y = 0.5;
            break;
        case ANCHOR_CB:
            achor.x = 0.5;
            achor.y = 0;
            break;
        case ANCHOR_RB:
            achor.x = 1;
            achor.y = 0;
            break;
        case ANCHOR_LB:
            achor.y = 0;
            break;
        case ANCHOR_LC:
            achor.y = 0.5;
            break;
        case ANCHOR_RC:
            achor.x = 1;
            achor.y = 0.5;
            break;


    }
    return achor;
}
function C_LoadMenuItem(_this, key, id, name_on, name_off, _x, _y, ax,ay,v, callback){
    
    
    // add plist button
    var frame_on = cc.spriteFrameCache.getSpriteFrame(name_on);
    var frame_off = cc.spriteFrameCache.getSpriteFrame(name_off);
    var btn_on = cc.Sprite.createWithSpriteFrame(frame_on);
    var btn_off = cc.Sprite.createWithSpriteFrame(frame_off);
    //add menu Item
    var item = cc.MenuItemSprite.create(btn_on, btn_off,function(){
        callback(key, id);
    },_this);
    item.attr({
        x: C_getX(_x),
        y:C_getY(_y),
        anchorX:ax,
        anchorY:ay
    });
    item.setTag(id);
    item.setVisible(v);
    return item;
}
function C_getX(_x){
    return _x;
}
function C_getY(_y){
    return cc.winSize.height-_y;
}
function C_getInY(sp,_y){
    return sp.height-_y;
}





function C_DrawPlistInNumbers(parent,str_score,type,_plist,_png,x,y,anchor,color,_scale){
    var len = str_score.length;
    var gab = 2;
    var _fontx = 0;
    var sps = [];
    var scale = _scale != undefined && _scale != null ? _scale : 1;
    for(var i = 0 ; i < len; i++){
        var num = parseInt(str_score.charAt(i));
        
        var sp = C_GetPlistInSprite(ID.BTN_GAME_SPEEDUP, type+"_"+num+".png", _plist, _png, 0, 0, ANCHOR_CC, true);     //mod by James    
        _fontx += (sp.width/2+gab)*scale;
        sp.setPosition(x+_fontx,y+sp.height/2);
        if(color != undefined && color != null)sp.setColor(color);
        if(scale != undefined && scale != null)sp.setScale(scale);
        parent.addChild(sp);
        _fontx += (sp.width/2+gab)*scale;
        sps.push(sp);
    }
    var move = 0;
    switch(anchor){
        case ANCHOR_CC:
            move = -_fontx/2;
            break;
        case ANCHOR_LC:
            move = 0;
            break;
        case ANCHOR_RC:
            move = -_fontx;
            break;
    }
    for(var i = 0 ; i < sps.length; i++){
        var mx = sps[i].getPosition().x+move;
        var my = sps[i].getPosition().y;
        sps[i].setPosition(mx,my);
    }
    
}
function C_AddScrollSceneMenuButton(parent,normal_url,click_url,x,y,tag,scale,zindex,callback,userdata){
    
    var bgCardDisable = cc.Sprite.create(normal_url);
    var bgCardEnable = click_url != null ? cc.Sprite.create(normal_url) : cc.Sprite.createWithTexture(bgCardDisable.getTexture());
    var muCard = cc.MenuItemSprite.create(bgCardDisable, bgCardEnable, function(){callback(tag);},parent);
    muCard.setTag(tag);
    muCard.setContentSize(bgCardDisable.getContentSize());
   
    var cardMenu = new ScScrollMenu(muCard);
    cardMenu.setTag(tag);
    cardMenu.userData = userdata;
    cardMenu.setPosition(x,y);
    cardMenu.setAnchorPoint(0.5,0.5);
    muCard.setEnabled(true);
    parent.addChild(cardMenu);
    cardMenu.setContentSize(bgCardDisable.getContentSize());
    cardMenu.setAnchorPoint(0.5,0.5);
    return cardMenu;
}
function C_ItemLevel(num){
    var level = 1;
    
    if(num == 0)
        level = 1;
    else if(num == 1)
        level = 2;
    else level = 3;
    return level;
}
function C_PopNums(count,max) {
    if(count > max)count = max;
    var pop = [];
    for(var i=0; i<count; i++) {
        var n = Math.floor(Math.random() * max);
        
        if (! sameNum(n)) {
            pop.push(n);
        } else {
            i--;
        }
    }
    function sameNum (n) {
        var rflg = false;
        for(var i = 0 ; i < pop.length; i++)
            if(pop[i] == n){
                rflg = true;
                break;
            }
        return rflg;
    }
    return pop;
}
function C_UpDownRepeatAni(sp,time,gab){
      
        var move1 = cc.moveBy(time,0,gab);
        var move2 = cc.moveBy(time,0,-gab);
        var seq1 = cc.sequence(move1,move2);
        var repeat1 = C_Repeat_Forever(seq1);//cc.RepeatForever.create(seq1);
        sp.runAction(repeat1);
}
function C_LeftRightRepeatAni(sp,time, width){
        
       sp.setPosition(0,sp.getPosition().y);
        var move1 = cc.moveBy(time, width-30 ,0);
        var movelow1 = cc.moveBy(1, 30 ,0);
        
        var move2 = cc.moveBy(time,-(width-30),0);
        var movelow2 = cc.moveBy(1, -30 ,0);
        
        var seq1 = cc.sequence(move1,movelow1, move2, movelow2);
        var repeat1 = C_Repeat_Forever(seq1);//cc.RepeatForever.create(seq1);
        sp.runAction(repeat1);
}
function C_ScaleRepeatAni(sp,time,scale){
       
        var scale1 = cc.scaleTo(time,scale,scale);
        var scale2 = cc.scaleTo(time/2,1,1);
        var seq = cc.sequence(scale1,scale2);
        var repeat = C_Repeat_Forever(seq);//cc.RepeatForever.create(seq);
        sp.runAction(repeat);
}
function C_OpacityRepeatAni(sp,time){
       
        var fadeIn = cc.fadeIn(time);
        var fadeOut = cc.FadeOut.create(time);
        var seq = cc.sequence(fadeIn, fadeOut);
        var repeat = C_Repeat_Forever(seq);//cc.RepeatForever.create(seq);
        sp.runAction(repeat);
       
}
function C_RotateRepeatAni(sp,round){
    var rotate = cc.rotateBy(round, 1080, 0);
    var sequence = cc.sequence(rotate);
    var action = C_Repeat_Forever(sequence);
    sp.runAction(action);
}
function C_BackRepeatAni(sp,time,scale){
        sp.setScale(scale*1.01);
        sp.attr({
                x: 0,
                y:0,
                anchorX:0 ,
                anchorY:0
            }); 
        var gabx = WINSIZE_WIDTH*scale-WINSIZE_WIDTH;
        var gaby = WINSIZE_HEIGHT*scale-WINSIZE_HEIGHT;
        var move1 = cc.moveBy(time,-gabx,0);
        var move2 = cc.moveBy(time,0,-gaby);
        var move3 = cc.moveBy(time,gabx,0);
        var move4 = cc.moveBy(time,0,gaby);
        
        var seq = cc.sequence(move1,move2,move3,move4);
        var repeat = C_Repeat_Forever(seq);//cc.RepeatForever.create(seq);
        sp.runAction(repeat);
}
function C_AddAnimButton(parent,normal_url,click_url,x,y,tag,scale,zindex,callback,userdata){
    if(click_url == null)click_url = normal_url;
    var nButton = new NButton(normal_url,click_url,tag,function(_tag){callback(_tag);});
    if(scale != null)nButton.setScale(scale);
    if(zindex != null)nButton.zIndex = zindex;
    
    nButton.setPosition(x,y);
    parent.addChild(nButton);
    return nButton;
}
function C_AddAnimBlock(parent,blockdata,normal_url,click_url,x,y,tag,scale,zindex,callback,userdata){
    if(click_url == null)click_url = normal_url;
    var nButton = new NBlock(blockdata,normal_url,click_url,tag,function(_tag){callback(_tag);});
    if(scale != null)nButton.setScale(scale);
    if(zindex != null)nButton.zIndex = zindex;
    
    nButton.setPosition(x,y);
    parent.addChild(nButton);
    return nButton;
}
function initTime(self){
    if(self.resetInactivityTimer)self.resetInactivityTimer();
}
function C_ShowAni(self,delaytime){
       
        var zoomin = cc.scaleTo(0.05,0.90);
        var zoomout = cc.scaleTo(0.1,1.1);
        var zoomdefault = cc.scaleTo(0.1,1);
        var func = cc.callFunc(function(){});
    
        if(delaytime > 0){
            setTimeout(function(){
                var seq = cc.Sequence.create(zoomin, zoomout,zoomdefault, func);
                self.runAction(seq);        
            },delaytime);
        }else {
            var seq = cc.Sequence.create(zoomin, zoomout,zoomdefault, func);
            self.runAction(seq);    
        }
        
    }
function C_ShowPointAni(self){
       
        var zoomin = cc.scaleTo(0.2,1.90);
        var zoomout = cc.scaleTo(0.2,1.5);
        var zoomdefault = cc.scaleTo(2,1);
//        var delay = cc.delayTime(1);
        var func = cc.callFunc(function(){});
        var seq = cc.Sequence.create(zoomin, zoomout,zoomin, zoomdefault, func);
        self.runAction(seq);
}
function C_ShowFlashAni(self,islongani){
       
        var color_white = cc.color(255,255,255);
        var color_black = cc.color(0,0,0);
        self.setColor(Color3B.YELLOW);
        var func0 = cc.callFunc(function(){ self.setColor(Color3B.WHITE);});
        var func1 = cc.callFunc(function(){ self.setColor(Color3B.YELLOW);});
        var delay = cc.delayTime(0.1);
        var seq = cc.Sequence.create(delay, func0,delay,func1,delay, func0,delay,func1,delay, func0,delay,func1,delay, func0,delay,func1,delay, func0);
        if(islongani)
            seq = cc.Sequence.create(delay, func0,delay,func1,delay, func0,delay,func1,delay, func0,delay,func1,delay, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0, func0,delay,func1,delay, func0);
        
        self.runAction(seq);
}
function C_ShowFlashOnOffAni(self,islongani){
       
        var color_white = cc.color(255,255,255);
        var color_black = cc.color(0,0,0);
        self.setColor(Color3B.YELLOW);
        var func0 = cc.callFunc(function(){ self.setVisible(true);});
        var func1 = cc.callFunc(function(){ self.setColor(Color3B.WHITE);});
        var func2 = cc.callFunc(function(){ self.setVisible(false);});
        var func3 = cc.callFunc(function(){ self.setColor(Color3B.YELLOW);});
        var delay = cc.delayTime(0.1);
        var seq = cc.Sequence.create(delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1);
        if(islongani)
            seq = cc.Sequence.create(delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1,delay, func2,delay,func3,delay, func0,delay,func1);
        
        self.runAction(seq);
}
function C_HEXtoCCColor(hex_color) {
    // # 기호 제거
    if (hex_color.charAt(0) === "#") {
        hex_color = hex_color.substring(1);
    }

    // 3자리 HEX를 6자리로 확장 (#abc → #aabbcc)
    if (hex_color.length === 3) {
        hex_color = hex_color.split("").map(ch => ch + ch).join("");
    }

    // HEX → RGB 값 추출
    var r = parseInt(hex_color.substring(0, 2), 16);
    var g = parseInt(hex_color.substring(2, 4), 16);
    var b = parseInt(hex_color.substring(4, 6), 16);

    return cc.color(r, g, b);
}
function C_HideAni(self,callback){
        
//        self.popupback.setVisible(false);
        var zoomin = cc.scaleTo(0.05,1.1);
        var zoomout = cc.scaleTo(0.15,0.5);
        var func = cc.callFunc(function(){callback();});
        var seq = cc.Sequence.create(zoomin, zoomout, func);
        self.runAction(seq);
}
function C_DrawBackColor(self){
    var bgcolorlayer = new cc.LayerColor.create(cc.color(255,0,0, 255));
    bgcolorlayer.setScale(1.3);
    self.addChild(bgcolorlayer);
}

function C_AddCustomFont_Back(parent, str, x, y, tag, scale, anchor, fontsize, color, isboldfont, onClick) {
    var label = null;

    if (isboldfont != undefined && isboldfont) {
        label = cc.LabelTTF.create(str, "현대하모니B", fontsize);
    } else {
        label = cc.LabelTTF.create(str, "현대하모니M", fontsize);
    }

    label.setPosition(x, y);

    if (anchor != null) label.setAnchorPoint(cc.p(anchor / 2, 0.5));
    if (scale != null) label.setScale(scale);
    if (color != null) label.setColor(color);
    if (tag != null) label.setTag(tag);

    // 터치 리스너 등록 (onClick 콜백이 있을 경우)
    if (typeof onClick === "function") {
        var listener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true,
            onTouchBegan: function (touch, event) {
                var target = event.getCurrentTarget();
                var locationInNode = target.convertToNodeSpace(touch.getLocation());
                var size = target.getContentSize();
                var rect = cc.rect(0, 0, size.width, size.height);

                if (cc.rectContainsPoint(rect, locationInNode)) {
                    onClick(tag); // 클릭 콜백 실행
                    return true;
                }
                return false;
            }
        });
        cc.eventManager.addListener(listener, label);
    }

    parent.addChild(label);
    return label;
}
function C_AddCustomFont(parent, str, x, y, tag, scale, anchor, fontsize, color, isboldfont, onClick) {

    var label = null;

    if (isboldfont != undefined && isboldfont) {
        label = cc.LabelTTF.create(str, "현대하모니B", fontsize);
    } else {
        label = cc.LabelTTF.create(str, "현대하모니M", fontsize);
    }
    if(!str)return;
    var lines = str.split('\n');
    var lineHeight = fontsize * 2;
    var totalHeight = lines.length * lineHeight;

    var anchorX = (anchor !== undefined && anchor !== null) ? anchor / 2 : 0.5;
    var anchorY = 0.5;  // 고정

    if (lines.length > 1) {
        var multilineLayer = new cc.Node(); // anchorPoint 없는 Layer 대신 Node 사용
        if (tag != null) multilineLayer.setTag(tag);

        // Anchor에 따라 보정된 위치 계산
        var offsetX = 0; // 수평 anchor 는 각 줄에 적용하므로 생략 가능
        var offsetY = totalHeight * (0.5 - anchorY);

        multilineLayer.setPosition(x + offsetX, y + offsetY);
        parent.addChild(multilineLayer);

        for (var i = 0; i < lines.length; i++) {
            var lineLabel = cc.LabelTTF.create(lines[i], labelFont, fontsize);
            lineLabel.setColor(color || cc.color(255, 255, 255));
            lineLabel.setAnchorPoint(cc.p(anchorX, 0.5));
            if (scale != null) lineLabel.setScale(scale);

            var posY = totalHeight / 2 - lineHeight * (i + 0.5); // 중앙 정렬
            lineLabel.setPosition(0, posY);
            multilineLayer.addChild(lineLabel);
        }

        if (typeof onClick === "function") {
            var listener = cc.EventListener.create({
                event: cc.EventListener.TOUCH_ONE_BY_ONE,
                swallowTouches: true,
                onTouchBegan: function (touch, event) {
                    var target = event.getCurrentTarget();
                    var locationInNode = target.convertToNodeSpace(touch.getLocation());
                    var rect = cc.rect(-500, -totalHeight / 2, 1000, totalHeight);

                    if (cc.rectContainsPoint(rect, locationInNode)) {
                        onClick(tag);
                        return true;
                    }
                    return false;
                }
            });
            cc.eventManager.addListener(listener, multilineLayer);
        }

        return multilineLayer;
    } else {
        var label = null;

    if (isboldfont != undefined && isboldfont) {
        label = cc.LabelTTF.create(str, "현대하모니B", fontsize);
    } else {
        label = cc.LabelTTF.create(str, "현대하모니M", fontsize);
    }
        label.setPosition(x, y);
        if (anchor != null) label.setAnchorPoint(cc.p(anchorX, 0.5));
        if (scale != null) label.setScale(scale);
        if (color != null) label.setColor(color);
        if (tag != null) label.setTag(tag);

        if (typeof onClick === "function") {
            var listener = cc.EventListener.create({
                event: cc.EventListener.TOUCH_ONE_BY_ONE,
                swallowTouches: true,
                onTouchBegan: function (touch, event) {
                    var target = event.getCurrentTarget();
                    var locationInNode = target.convertToNodeSpace(touch.getLocation());
                    var size = target.getContentSize();
                    var rect = cc.rect(0, 0, size.width, size.height);

                    if (cc.rectContainsPoint(rect, locationInNode)) {
                        onClick(tag);
                        return true;
                    }
                    return false;
                }
            });
            cc.eventManager.addListener(listener, label);
        }

        parent.addChild(label);
        return label;
    }
}
/**
 * 0부터 max-1 사이의 랜덤한 정수를 num개 생성하여 배열로 반환합니다.
 * (중복된 숫자가 나올 수 있습니다)
 * @param {number} max - 랜덤 숫자의 상한값 (이 값은 포함되지 않음)
 * @param {number} num - 생성할 숫자의 개수
 * @returns {number[]} 랜덤 숫자가 담긴 배열
 */
function getRandomNumbers(max, num) {
  const result = []; // 결과를 담을 빈 배열
  for (let i = 0; i < num; i++) {
    const randomNumber = Math.floor(Math.random() * max);
    result.push(randomNumber);
  }
  return result;
}
function getUniqueRandomNumbers(max, num) {
  // 요청 개수가 생성 가능한 숫자 범위보다 크면 오류를 반환합니다.
  if (num > max) {
    return "오류: 요청한 개수(num)가 최대값(max)보다 클 수 없습니다.";
  }

  // 1. 0부터 max-1까지 모든 숫자가 담긴 배열을 생성합니다.
  const allNumbers = [];
  for (let i = 0; i < max; i++) {
    allNumbers.push(i);
  }

  // 2. 배열을 무작위로 섞습니다 (피셔-예이츠 셔플).
  let currentIndex = allNumbers.length;
  while (currentIndex !== 0) {
    // 남은 요소 중에서 랜덤한 요소를 선택합니다.
    const randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex--;

    // 현재 요소와 랜덤 요소를 맞바꿉니다.
    [allNumbers[currentIndex], allNumbers[randomIndex]] = [
      allNumbers[randomIndex], allNumbers[currentIndex]];
  }

  // 3. 섞인 배열의 앞에서부터 num개 만큼 잘라서 반환합니다.
  return allNumbers.slice(0, num);
}


// --- 사용 예시 ---
// 0~39 사이의 랜덤 숫자 10개를 생성합니다.
const randomArray = getRandomNumbers(40, 10);
console.log(randomArray); // 예: [23, 5, 31, 11, 5, 39, 0, 18, 2, 22]
function getRandomHangul() {
  const startCode = 44032; // '가'의 유니코드
  const endCode = 55203;   // '힣'의 유니코드
  const randomCode = Math.floor(Math.random() * (endCode - startCode + 1)) + startCode;
  
  return String.fromCharCode(randomCode);
}

function getCommonRandomHangul(length = 1) {
  // KS X 1001 + 추가 상용 한글 (약 3,000자)
  const commonHangul = "가각간갇갈감갑강개객거건걸검겁게격견결겸경계고곡곤골공과곽관광괘괴굉교구국군굴궁권궐귀규균그극근글금급긍기긴길김깅나낙난날남납낭내냉녀녁년념녕노농뇌누눈눌뉴느능늦니닉다단달담답당대댁더덕도독돈돌동두둔둘득등디따딴딸땅때땡떠떡떤떨떻떼또똑뚜뚝뜨뜻띄라락란랄람랍랑래랭략량러럭런럴럼럽레렉렌려력련렬렴렵령례로록론롱뢰료룡루룩룬룰류륙윤률륭르름릅릉리린림립마막만많말맑맘맙망매맥맨맹멱면멸명몌모목몰몸몹못몽묘무묵묶문물므미민믿밀박반받발밝밟밤밥방배백번벌범법벽변별볍병보복본볼봄봉부북분불붉붐붓붕비빈빌빔빗빙빚빛빠빡빤빨빵빼빽뺀뺑뻐뻔뻗뻬뼈뽑뿌뿐쁘삐사삭산살삼삽상샅새색샌생서석선설섬섭성세섹센셈셋셔션소속손솔솟송쇄쇠수숙순술숨숫숭쉬쉽스슨슬슴습승시식신실심십싯싱싶싸싹싼쌀쌍쌓쌔쌩써썩썰썹쎄쏘쏟쑤쑥쓰쓸씌씨씩씬씹아악안앉않알앓암압앙앞애액앵야약얀얄얇얌얍양어억언얹얻얼엄업에엑엔여역연열엷염엽영예오옥온올옮옳옷옹와완왈왕왜외왼요욕용우운울움웃웅워원월웨웬위유육윤율으은을음읍응의이익인일임입잇잉자작잔잖잘잠잡장재쟁저적전절젊점접정제조족존졸좀좁종좌죄주죽준줄줌중즉증지직진질짐집징짙짚짜짝짧째쨌쨍쩌쩍쩐쩔쩜쪽쫓쭈쭉찌찍찢차착찬찰참창채책처척천철첨첩청체쳐초촉촌총촬최추축춘출춤춥충취측층치칙친칠침칩칭카칸칼캐캠커컨컬컴컵케켓코콘콜콤콧콩쾌쿄쿠퀴크큰클큼키킥타탁탄탈탑탕태택탱터턴털텀테텍텐텔토톤톨톱통퇴투퉁튀트특튼튿틀틈티틱틴팀팅파팍판팔팝패팩팬퍼퍽페펙펜펴편폄평폐포폭표푸품풍퓨프플피픽필핍하학한할함합항해핵핸햄햇행향허헌헐험헤헹혁현혈협형혜호혹혼홀홈홉홍화확환활황회획횡효후훈훌훔훨훼휘휴흉흐흑흔흘흠흡흥흩희흰히힘";
  
  let result = '';
  for (let i = 0; i < length; i++) {
    const randomIndex = Math.floor(Math.random() * commonHangul.length);
    result += commonHangul[randomIndex];
  }
  
    //레벨이 따른 난이도를 바닷가 글자개수로 따진다.
  var rand = Math.floor(Math.random() * 5)+1;
    
  if(rand >= param_level)result = "";

    return result;
}

function C_AddCustomFontNew(parent, str, x, y, tag, scale, anchor, fontsize, color, isboldfont, onClick, isradius) {
    var label = null;

    if (isboldfont != undefined && isboldfont) {
        label = cc.LabelTTF.create(str, "현대하모니B", fontsize);
    } else {
        label = cc.LabelTTF.create(str, "현대하모니M", fontsize);
    }

    label.setPosition(x, y);

    if (anchor != null) label.setAnchorPoint(cc.p(anchor / 2, 0.5));
    if (scale != null) label.setScale(scale);
    if (color != null) label.setColor(color);
    if (tag != null) label.setTag(tag);

    // 배경 라운드 박스 처리
    if (isradius === true) {
        var bg = new cc.DrawNode();

        var padding = 16; // 라벨 주변 여백
        var radius = 10;

        var labelSize = label.getContentSize();
        var bgWidth = labelSize.width + padding;
        var bgHeight = labelSize.height + padding;

        var bgX = x - bgWidth / 2;
        var bgY = y - bgHeight / 2;

        var rect = cc.rect(bgX, bgY, bgWidth, bgHeight);
        var bgColor = cc.color(0, 0, 0, 80); // 반투명 회색
        var borderColor = cc.color(0, 0, 0, 120);

        bg.drawRect(
            cc.p(bgX, bgY),
            cc.p(bgX + bgWidth, bgY + bgHeight),
            bgColor,
            1,
            borderColor
        );

        // 둥근 모서리로 변경
        bg.drawRoundRect = function (x, y, w, h, r, fillColor, lineColor) {
            var segments = 10;
            var verts = [];

            function pushArc(cx, cy, startAngle, endAngle) {
                for (var i = 0; i <= segments; i++) {
                    var angle = startAngle + (endAngle - startAngle) * (i / segments);
                    verts.push(cc.p(cx + r * Math.cos(angle), cy + r * Math.sin(angle)));
                }
            }

            // 4 corner arcs
            pushArc(x + r, y + r, Math.PI, 1.5 * Math.PI); // bottom-left
            pushArc(x + w - r, y + r, 1.5 * Math.PI, 2 * Math.PI); // bottom-right
            pushArc(x + w - r, y + h - r, 0, 0.5 * Math.PI); // top-right
            pushArc(x + r, y + h - r, 0.5 * Math.PI, Math.PI); // top-left

            bg.drawPoly(verts, fillColor, 1, lineColor);
        };

        bg.drawRoundRect(bgX, bgY, bgWidth, bgHeight, radius, bgColor, borderColor);
        parent.addChild(bg);
    }

    // 터치 리스너 등록
    if (typeof onClick === "function") {
        var listener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true,
            onTouchBegan: function (touch, event) {
                var target = event.getCurrentTarget();
                var locationInNode = target.convertToNodeSpace(touch.getLocation());
                var size = target.getContentSize();
                var rect = cc.rect(0, 0, size.width, size.height);

                if (cc.rectContainsPoint(rect, locationInNode)) {
                    onClick(tag);
                    return true;
                }
                return false;
            }
        });
        cc.eventManager.addListener(listener, label);
    }

    parent.addChild(label);
    return label;
}
function C_AddCustomFontSprite(parent, str, x, y, tag, scale, anchor, fontsize, color, isboldfont, callback, isradius, isradiusshow) {
    var label = isboldfont ? cc.LabelTTF.create(str, "현대하모니B", fontsize) : cc.LabelTTF.create(str, "현대하모니L", fontsize);

    if (anchor != null) label.setAnchorPoint(cc.p(anchor / 2, 0.5));
    if (scale != null) label.setScale(scale);
    if (color != null) label.setColor(color);

    var wrapper = new cc.Node();
    wrapper.setPosition(x, y);
    if (tag != null) wrapper.setTag(tag);
    parent.addChild(wrapper);

    var labelSize = label.getContentSize();

    
    if (isradius === true) {
        var bg = new cc.DrawNode();
        var padding = 16;
        var radius = 10;

        var bgWidth = labelSize.width + padding;
        var bgHeight = labelSize.height + padding;

        var bgAlpha = tag && isradiusshow ? 80 : 0;
        var borderAlpha = tag && isradiusshow ? 0 : 0;
        var bgColor = cc.color(0, 50, 150, bgAlpha);
        var borderColor = cc.color(0, 50, 150, borderAlpha);

        bg.drawRoundRect = function (x, y, w, h, r, fillColor, lineColor) {
            var segments = 10;
            var verts = [];

            function pushArc(cx, cy, startAngle, endAngle) {
                for (var i = 0; i <= segments; i++) {
                    var angle = startAngle + (endAngle - startAngle) * (i / segments);
                    verts.push(cc.p(cx + r * Math.cos(angle), cy + r * Math.sin(angle)));
                }
            }

            pushArc(x + r, y + r, Math.PI, 1.5 * Math.PI);
            pushArc(x + w - r, y + r, 1.5 * Math.PI, 2 * Math.PI);
            pushArc(x + w - r, y + h - r, 0, 0.5 * Math.PI);
            pushArc(x + r, y + h - r, 0.5 * Math.PI, Math.PI);

            bg.drawPoly(verts, fillColor, 1, lineColor);
        };

        bg.drawRoundRect(
            -bgWidth / 2,
            -bgHeight / 2,
            bgWidth,
            bgHeight,
            radius,
            bgColor,
            borderColor
        );

        wrapper.addChild(bg);
        wrapper.setContentSize(bgWidth, bgHeight);
    }

    label.setPosition(0, 0);
    wrapper.addChild(label);

    // ✅ 터치 애니메이션
    if (typeof callback === "function") {
        var listener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true,
            onTouchBegan: function (touch, event) {
                var target = event.getCurrentTarget();
                var locationInNode = target.convertToNodeSpace(touch.getLocation());
                var size = target.getContentSize();
                var rect = cc.rect(-size.width/2, -size.height/2, size.width, size.height);

                if (cc.rectContainsPoint(rect, locationInNode)) {
                    // 터치 다운 → 스케일 작게
                    target.stopAllActions();
                    target.setScale(1);
                    target.runAction(cc.scaleTo(0.1, 0.9, 0.9));
                    return true;
                }
                return false;
            },
            onTouchEnded: function (touch, event) {
                var target = event.getCurrentTarget();

                // 터치 업 → 스케일 복원 후 콜백
                target.stopAllActions();
                var zoomin = cc.scaleTo(0.1, 1);
                var func = cc.callFunc(function () {
                    callback(tag);
                });
                var seq = cc.sequence(zoomin, func);
                target.runAction(seq);
            },
            onTouchCancelled: function (touch, event) {
                var target = event.getCurrentTarget();
                target.stopAllActions();
                target.runAction(cc.scaleTo(0.1, 1)); // 취소되었을 때도 복구
            }
        });
        cc.eventManager.addListener(listener, wrapper);
    }

    return wrapper;
}



function C_ReplaceName(str,max){
    var rstr = str;
    if(str.length > 20){
        rstr = str.substr(0,max);
        rstr+="..";
    }
    
    return rstr;
}
//////////////////////////////////////////
//use : C_Toast(self._LayerMain,"마지막으로 테스트 한 시점이 언제이다.\n그리고 어쩌구 저쩌구",100,100,false);
//////////////////////////////////////////
function C_Toast(self,text,callback){

    C_ToastM(self, text, 0,150,false,callback);

}
function C_ToastMessage(self,text,islongtime,callback){
    C_ToastM(self, text, 0,150,islongtime,callback);
}
function C_ToastM(self, text, x,y,islongtime,callback){

    var layer = cc.Layer.create();
    layer.setTag(8888);
    self.addChild(layer,9999);

    var winSize = cc.director.getWinSize();
    var centerPos = cc.p(winSize.width / 2, winSize.height / 2);

    var back_img = new cc.Sprite(res.toast_back_png);
    back_img.setPosition(centerPos);
    layer.addChild(back_img);

//    var label = cc.LabelTTF.create(text,"Arial","20",cc.TEXT_ALIGNMENT_CENTER);
//    label.setColor(cc.color(255,255,255));
//    label.setPosition(centerPos);
//    label.setTag(8881);
//    layer.addChild(label);

    var label = C_AddCustomFont(layer, text, centerPos.x, centerPos.y,8881,1,cc.TEXT_ALIGNMENT_CENTER,24,cc.color(255,255,255));
    
    var t = 2;
    if(islongtime)t = 4;
    
    
    
    var move = cc.moveTo(t,0,20);
    layer.runAction(move);
    
    
    var delay = cc.delayTime(t);
    var seq1 =  cc.sequence(delay,cc.callFunc(function(){
        C_FadeOut(back_img,1,function(){
            self.removeChild(layer);
            if(callback)callback();
        });
        C_FadeOut(label,1,function(){});
    }));
    self.runAction(seq1);
}
function C_FadeOut(obj,time_second,callback){
    //obj.setVisible(false);
    var fout1 = new cc.FadeOut(time_second);
    var seq1 =  cc.sequence(fout1,cc.callFunc(function(){callback();}));
    obj.runAction(seq1);
}
function C_ToastSprite(parent,res,x,y,islong){
        var sp = cc.Sprite.create(res);
        sp.setPosition(x,y);
        sp.zIndex = 111;
        parent.addChild(sp);
    
    
        var time = islong ? 4 : 2;
        var fadeIn = cc.fadeIn(0.2);
        var delay = cc.delayTime(2);
        var fadeOut = cc.FadeOut.create(1.5);
        var callFunc = cc.callFunc(function(){sp.runAction(cc.RemoveSelf.create());});
        var seq = cc.sequence(fadeIn, delay,fadeOut,callFunc);
        sp.runAction(seq);
}
function C_Repeat_Forever(seq){
    
    return new cc.Repeat(seq,10000);
//    return cc.RepeatForever.create(seq);
}

function C_PlistInSprite(parent, name, plist, ppng,x,y,ah,v,tag,scale,color){
    var sp = C_GetPlistInSprite(tag, name, plist, ppng,0,0,ah,v,scale,color)
    sp.setPosition(x,y);
    parent.addChild(sp);
    return sp;
}
function C_PlistInButton(parent, disable_name, enable_name, plist, ppng,x,y,ah,v,tag,scale,color){
    var sp_disable = C_GetPlistInSprite(tag, disable_name, plist, ppng,0,0,ah,v,scale,color)
    sp_disable.setPosition(x,y);
    var _enable_name = enable_name == null ? disable_name : enable_name;
    var sp_enable = C_GetPlistInSprite(tag, _enable_name, plist, ppng,0,0,ah,v,scale,color)
    sp_enable.setPosition(x,y);
    
    parent.addChild(sp);
    return sp;
}
function C_AddTransparentButton(parent, x, y, width, height, tag, callback) {
//    var touchLayer = new cc.LayerColor(cc.color(0, 0, 255, 60), width, height); // 완전 투명 //test
    var touchLayer = new cc.LayerColor(cc.color(0, 0, 0, 0), width, height); // 완전 투명
    
    touchLayer.setAnchorPoint(0.5, 0.5); // 중앙 기준
    touchLayer.setPosition(x, y);
    touchLayer.setTag(tag);

    // 터치 리스너 등록 (EventListener 방식)
    var listener = cc.EventListener.create({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true,
        onTouchBegan: function (touch, event) {
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(touch.getLocation());
            var size = target.getContentSize();
            var rect = cc.rect(0, 0, size.width, size.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                if (callback && typeof callback === "function") {
                    callback(tag);
                }
                return true;
            }
            return false;
        }
    });

    cc.eventManager.addListener(listener, touchLayer);
    parent.addChild(touchLayer);
    return touchLayer;
}
function C_resizeSprite(sprite, targetWidth, targetHeight) {
    var originalSize = sprite.getContentSize();
    var scaleX = targetWidth / originalSize.width;
    var scaleY = targetHeight / originalSize.height;
    sprite.setScaleX(scaleX);
    sprite.setScaleY(scaleY);
}
function removeSprite(sps , spriteToRemove) {
    // 1. 배열에서 제거할 스프라이트의 인덱스(위치)를 찾습니다.
    var index = sps.indexOf(spriteToRemove);

    // 2. 인덱스를 찾았는지 확인합니다 (못 찾으면 -1을 반환).
    if (index > -1) {
        // 배열에서 해당 인덱스의 항목 1개를 제거합니다.
        sps.splice(index, 1);
    }

    // 3. 스프라이트를 화면(부모 노드)에서도 제거합니다. (매우 중요!)
    spriteToRemove.removeFromParent(true);
}
function C_AddSprite_Old(parent, res, x, y, tag, scale, zindex,w,h) {
    var timestamp = new Date().getTime();
    var res_url = res + "?v=" + timestamp;

    // 캐시 제거
    cc.textureCache.removeTextureForKey(res);

    // 스프라이트 생성
    var sp = new cc.Sprite(res_url);
    sp.setPosition(x, y);

    if (tag != undefined && tag != null) sp.setTag(tag);
    if (scale != undefined && scale != null) sp.setScale(scale);
    if (zindex != undefined && zindex != null) sp.zIndex = zindex;

    parent.addChild(sp);
    return sp;
}
//new
function C_AddSprite(parent, res, x, y, tag, scale, zindex, w, h, txtdata) {
    var timestamp = new Date().getTime();
    var res_url = res + "?v=" + timestamp;

    // 캐시 제거
    cc.textureCache.removeTextureForKey(res);

    // ✅ 스프라이트 생성
    var sp = new cc.Sprite(res_url);
    sp.setPosition(x, y);

    if (tag != undefined && tag != null) sp.setTag(tag);
    if (scale != undefined && scale != null) sp.setScale(scale);
    if (zindex != undefined && zindex != null) sp.zIndex = zindex;

    parent.addChild(sp);

    addSpriteInText(txtdata,sp);

    return sp;
}
function C_AddSpriteImageResize(parent, res, x, y, tag, scale, zindex, w, h) {
    var timestamp = new Date().getTime();
    var res_url = res + "?v=" + timestamp;

    cc.textureCache.removeTextureForKey(res);

    var sp = new cc.Sprite(res_url);
    sp.setAnchorPoint(0.5, 0.5);

    if (tag !== undefined && tag !== null) sp.setTag(tag);
    if (zindex !== undefined && zindex !== null) sp.zIndex = zindex;

    parent.addChild(sp);

    var texture = cc.textureCache.addImage(res_url);
    function applySizeAndPosition() {
        var originalSize = sp.getContentSize();
        if (w && h) {
            sp.setScaleX(w / originalSize.width);
            sp.setScaleY(h / originalSize.height);
        } else if (w && !h) {
            let scaleVal = w / originalSize.width;
            sp.setScale(scaleVal);
        } else if (!w && h) {
            let scaleVal = h / originalSize.height;
            sp.setScale(scaleVal);
        } else if (scale !== undefined && scale !== null) {
            sp.setScale(scale);
        }
        sp.setPosition(x, y);
    }

    if (texture.isLoaded()) {
        applySizeAndPosition();
    } else {
        texture.addLoadedEventListener(applySizeAndPosition);
    }

    return sp;
}



function C_AddTextButton(parent, res, x, y, tag, scale, zindex, callback, text, textsize, hex_textcolor, istextbold) {
    const _scale = scale;
    var sp = C_AddSpriteTouch(parent, res, x, y, tag, _scale, zindex, callback,txtdata);
     C_AddCustomFont(sp,text, sp.width/2, sp.height/2, null, 1, cc.TEXT_ALIGNMENT_CENTER ,textsize, C_HEXtoCCColor(hex_textcolor),istextbold,function(tag){});
    return sp;
}
function C_AddSpriteTouch(parent, res, x, y, tag, scale, zindex, callback,txtdata) {
    var mscale = scale;
    if(mscale < 5){
        var sc = 0.1;
        for(var i = 1; i < 100; i++){
            if(scale == i/10){
                mscale = i/10;
                break;
            }
        }    
    }
    var tsp = _SpriteTouch(parent, res, x, y, tag, scale, zindex, function onTouchDown(sp, touch) {
        sp.setScale(1);
        sp.setScale(mscale);
        var zoomout = cc.scaleTo(0.1,mscale*0.9,mscale*0.9);
        sp.runAction(zoomout);
    },
    function onTouchUp(sp, touch) {
        console.log("touchUp");
        var zoomin = cc.scaleTo(0.1,1);
        var func = cc.callFunc(function(){ 
            callback(tag);
        });
        var seq = cc.Sequence.create(zoomin, func);
        sp.runAction(seq);
    });
    addSpriteInText(txtdata,tsp);
    return tsp;

}
function replacePLineToEnter(msg) {
    if (msg && msg.length > 0) {
        // | 를 실제 줄바꿈(\n)으로 변환
        msg = msg.replace(/\|/g, '\n');

        // HTML 엔티티로 바꿨던 쌍따옴표도 원복
        msg = msg.replaceAll('&quot;', '"');
    }
    return msg;
}
function addSpriteInText(txtdata,sp){
      // ✅ 텍스트 데이터가 있으면 라벨 추가
    if (txtdata && txtdata.message) {
        var fontSize = txtdata.fontsize || 24;
        var color = txtdata.color || "white";
        var textalign = txtdata.textalign || "center";
        var x = txtdata.x || 0;
        var y = txtdata.y || 0;
        var fontweight = txtdata.fontweight || "";
        var fontName = fontweight === "bold" ? "현대하모니B" : "현대하모니L";
            

        var label = new cc.LabelTTF( replacePLineToEnter(txtdata.message), fontName, fontSize );
        
            switch (textalign) {
            case "left":
                label.setHorizontalAlignment(cc.TEXT_ALIGNMENT_LEFT);
                break;
            case "right":
                label.setHorizontalAlignment(cc.TEXT_ALIGNMENT_RIGHT);
                break;
            case "center":
            default:
                label.setHorizontalAlignment(cc.TEXT_ALIGNMENT_CENTER);
                break;
        }
        console.log("sp.height "+sp.height);
        // ✅ 색상 처리
        if (typeof color === "string") {
            label.setColor(cc.color(color));
        } else {
            label.setColor(color); // cc.color 객체도 가능
        }
        label.setPosition(x,sp.height-y);

        

        label.setPosition(x, y);

        // ✅ 스프라이트 위에 텍스트 추가
        sp.addChild(label, 999);

        // ✅ 나중에 수정 가능하도록 저장
        sp._label = label;
    }
}


function C_AddSpriteTouchReturnSP(parent, res, x, y, tag, scale, zindex, callback) {
    var tsp = _SpriteTouch(parent, res, x, y, tag, scale, zindex, function onTouchDown(sp, touch) {
        console.log("touchDown x "+sp.getPosition().x+" y "+sp.getPosition().x);
        sp.setScale(1);
        var zoomout = cc.scaleTo(0.1,0.9,0.9);
        sp.runAction(zoomout);
        
    },
    function onTouchUp(sp, touch) {
        var zoomin = cc.scaleTo(0.1,1);
        console.log("touchDown x "+sp.getPosition().x+" y "+sp.getPosition().x);
        var func = cc.callFunc(function(){ 
            callback(sp);
        });
        var seq = cc.Sequence.create(zoomin, func);
        sp.runAction(seq);
    });
    return tsp;

}
function C_Add9PatchSpriteTouchReturnSP(parent,res, _sx, _sy, _sw, _sh, tag, scale, zindex, callback){
    // var sp_9_patch = new cc.Scale9Sprite(res.n_lyrics_rect_normal);
     var sp_9_patch = new cc.Scale9Sprite(res);
    sp_9_patch.x = _sx;
    sp_9_patch.y = _sy;
    sp_9_patch.tag = tag;
    sp_9_patch.width = _sw;
    sp_9_patch.height = _sh;
    parent.addChild(sp_9_patch);

//    console.log(chars[j] + " width " + sp_9_patch.width + " height " + sp_9_patch.height);

   
    // 터치 리스너 등록
    const _sp = sp_9_patch;
    cc.eventManager.addListener({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true,
        
        onTouchBegan: function (touch, event) {
            console.log("addListener 가사박스 리스너");
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(touch.getLocation());
            var size = target.getContentSize();
            var rect = cc.rect(0, 0, size.width, size.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                var scale1 = cc.scaleTo(0.1, 0.9,1.1);
                sp_9_patch.runAction(scale1);
                
                return true; // 터치 이벤트 잡았음
            }
            return false;
        } ,onTouchEnded: function(touch, event) {
            var scale1 = cc.scaleTo(0.1,1,1);
            var delay = cc.delayTime(0.1);
            var func = cc.callFunc(function() {
                 callback(sp_9_patch);
            });
            var seq =  cc.sequence(scale1, delay,func);
            sp_9_patch.runAction(seq);
           

        }
    }, sp_9_patch);
    return sp_9_patch;
}

var before_click_sp = null;
/**
 * 스프라이트를 무한히 반짝이게 만드는 함수
 * @param {cc.Sprite} sprite - 반짝임 효과를 적용할 스프라이트 객체
 * @param {number} duration - 한 번 깜빡이는 데 걸리는 시간 (초 단위, 예: 0.5)
 */
function C_StartBlinkingEffect(sprite, duration) {
    // 1. 기존에 실행 중인 액션이 있다면 중지 (중복 방지)
    C_RestoreSprite(before_click_sp);
    sprite.stopAllActions();

    // 2. 액션 생성
    var fadeOut = cc.fadeOut(duration / 2); // 절반의 시간 동안 사라짐
    var fadeIn = cc.fadeIn(duration / 2);  // 절반의 시간 동안 나타남
    
    // 3. 순차적으로 실행할 액션 묶음 생성
    var sequence = cc.sequence(fadeOut, fadeIn);
    
    // 4. 액션 묶음을 무한 반복 실행
    var repeatForever = cc.repeatForever(sequence);

    // 5. 스프라이트에 액션 적용
    sprite.runAction(repeatForever);
    before_click_sp = sprite;
}
/**
 * 스프라이트를 지정된 색상으로 변경하며 무한히 반짝이게 만듭니다.
 * @param {cc.Sprite} sprite - 효과를 적용할 스프라이트 객체
 * @param {number} duration - 한 번 깜빡이는 데 걸리는 시간 (초)
 * @param {cc.Color} [highlightColor] - 반짝일 때 변할 색상 (기본값: 노란색)
 */
function C_StartBlinkingWithColor(sprite, duration, highlightColor) {
    // 1. 이전에 클릭했던 스프라이트는 원래대로 복구하고, 현재 스프라이트의 액션을 중지
    if (typeof before_click_sp !== 'undefined' && before_click_sp) {
        C_RestoreSprite(before_click_sp);
    }
    sprite.stopAllActions();

    // 2. 파라미터로 받은 색상이 없으면 기본값으로 노란색(255, 255, 0)을 사용
    var color = highlightColor || cc.color(255, 255, 0);

    // 3. 액션 생성
    var fadeOut = cc.fadeOut(duration / 2);        // 서서히 사라짐
    var fadeIn = cc.fadeIn(duration / 2);         // 서서히 나타남
    var tintToHighlight = cc.tintTo(duration / 2, color.r, color.g, color.b); // 지정된 색으로 변경
    var tintToOriginal = cc.tintTo(duration / 2, 255, 255, 255);             // 원래 색(흰색)으로 복구

    // 4. 액션 조합 (spawn으로 동시에 실행)
    // (A) 사라지면서 하이라이트 색상으로 변하는 액션
    var disappearAndTint = cc.spawn(fadeOut, tintToHighlight);
    // (B) 나타나면서 원래 색상으로 돌아오는 액션
    var appearAndRestore = cc.spawn(fadeIn, tintToOriginal);

    // 5. 순차 실행 및 무한 반복
    var sequence = cc.sequence(disappearAndTint, appearAndRestore);
    var repeatForever = cc.repeatForever(sequence);

    // 6. 스프라이트에 최종 액션 실행
    sprite.runAction(repeatForever);
    
    // 현재 스프라이트를 '이전에 클릭된 스프라이트'로 저장
    before_click_sp = sprite;
}

// --- C_RestoreSprite 함수 (참고용) ---
// 이 함수는 색상도 원래대로 되돌리도록 tintTo를 포함하는 것이 좋습니다.
function C_RestoreSprite(sprite) {
    if (sprite) {
        
        sprite.setOpacity(255);
        sprite.setScale(1.0);
        sprite.setColor(cc.color(255, 255, 255)); // 색상도 원본(흰색)으로 복구
    }
}


// --- 사용 예시 ---
// var mySprite = new cc.Sprite("res/character.png");
// this.addChild(mySprite);
//
// // 1초 간격으로 '빨간색'으로 반짝이게 하기
// C_StartBlinkingWithColor(mySprite, 1.0, cc.color(255, 0, 0));
//
// // 색상을 지정하지 않으면 기본값인 '노란색'으로 반짝임
// // C_StartBlinkingWithColor(mySprite, 1.0);
/**
 * 스프라이트의 모든 애니메이션 효과를 멈추고,
 * 원래의 모습(완전 불투명, 기본 크기)으로 즉시 되돌립니다.
 * @param {cc.Sprite} sprite - 복구할 스프라이트 객체
 */
function C_RestoreSprite(sprite) {
    if(sprite){
        
    
        // 1. 스프라이트에서 실행 중인 모든 액션을 중지시킵니다.
        sprite.stopAllActions();

        // 2. 스프라이트의 투명도를 255(완전 불투명)로 설정합니다.
        sprite.setOpacity(255);

        // 3. 스프라이트의 크기를 1.0 (원본 크기)로 설정합니다.
        sprite.setScale(1.0);
    }
}
function _SpriteTouch(parent, res, x, y, tag, scale, zindex, touchDownCallback, touchUpCallback) {
    var timestamp = new Date().getTime();
    var res_url = res + "?v=" + timestamp;

    cc.textureCache.removeTextureForKey(res);

    var sp = new cc.Sprite(res_url);
    sp.setPosition(x, y);

    if (tag != undefined && tag != null) sp.setTag(tag);
    if (scale != undefined && scale != null) sp.setScale(scale);
    if (zindex != undefined && zindex != null) sp.zIndex = zindex;

    parent.addChild(sp);

    // 이벤트 리스너 추가
    var listener = cc.EventListener.create({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true, // 터치 이벤트 전파 방지
        onTouchBegan: function(touch, event) {
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(touch.getLocation());
            var size = target.getContentSize();
            var rect = cc.rect(0, 0, size.width, size.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                if (touchDownCallback) touchDownCallback(target, touch);
                return true;
            }
            return false;
        },
        onTouchEnded: function(touch, event) {
            var target = event.getCurrentTarget();
            if (touchUpCallback) touchUpCallback(target, touch);
        }
    });

    cc.eventManager.addListener(listener, sp);

    return sp;
}
//function _SpriteTouch(parent, res, x, y, tag, scale, zindex, touchDownCallback, touchUpCallback) {
//    var timestamp = new Date().getTime();
//    var res_url = res + "?v=" + timestamp;
//
//    cc.textureCache.removeTextureForKey(res);
//
//    var sp = new cc.Sprite(res_url);
//    sp.setPosition(x, y);
//   
//
//    if (tag != undefined && tag != null) sp.setTag(tag);
//    if (scale != undefined && scale != null) sp.setScale(scale);
//    if (zindex != undefined && zindex != null) sp.zIndex = zindex;
//
//    parent.addChild(sp);
//    
//    // 이벤트 리스너 추가
//    var listener = cc.EventListener.create({
//        event: cc.EventListener.TOUCH_ONE_BY_ONE,
//        swallowTouches: true, // 터치 이벤트 전파 방지
//        onTouchBegan: function(touch, event) {
//            var target = event.getCurrentTarget();
//            var locationInNode = target.convertToNodeSpace(touch.getLocation());
//            var size = target.getContentSize();
//            var rect = cc.rect(0, 0, size.width, size.height);
//
//            if (cc.rectContainsPoint(rect, locationInNode)) {
//                if (touchDownCallback) touchDownCallback(target, touch);
//                return true;
//            }
//            return false;
//        },
//        // --- [추가된 부분] ---
//        onTouchMoved: function(touch, event) {
//            var target = event.getCurrentTarget();
//            // 터치의 현재 위치를 얻어와 스프라이트의 위치를 업데이트합니다.
//            console.log("onTouchMoved x "+sp.getPosition().x+" y "+sp.getPosition().y);
//            target.setPosition(touch.getLocation());
//        },
//        // --- [여기까지] ---
//        onTouchEnded: function(touch, event) {
//            var target = event.getCurrentTarget();
//            if (touchUpCallback) touchUpCallback(target, touch);
//        }
//    });
//
//    cc.eventManager.addListener(listener, sp);
//
//    return sp;
//}
function C_AddVideo(parentElement, videoPath, x, y, width, height, zIndex = 1) {
    // 1. 비디오 요소 생성
    const video = document.createElement("video");

    // 2. 속성 설정
    video.src = videoPath;
    video.autoplay = true;
    video.loop = true;
    video.muted = true;
    video.playsInline = true; // 모바일용

    // 3. 스타일로 위치/크기 지정
    video.style.position = "absolute";
    video.style.left = x + "px";
    video.style.top = y + "px";
    video.style.width = width + "px";
    video.style.height = height + "px";
    video.style.zIndex = zIndex;
    video.style.pointerEvents = "none"; // 클릭 방해 방지

    // 4. 부모 요소에 추가
    parentElement.appendChild(video);

    return video;
}
function C_getLimitScoreFun(num)
{//리미트 점수를 얻어오는 함수
    
    var totalScore = 0;
    var addScore = 0;
    for (var i = 0; i < num; i++)
    {
        addScore += 10;
        totalScore += addScore;
        //MY_Log("addScore = %d  totalScore %d", addScore, totalScore);
    }

    return totalScore;
}
function C_DrawCommaNumbers(parent,str_score,x,y,anchor,color,_scale,iscomma){
    var len = str_score.length;
    var gab = 0;
    var _fontx = 0;
    var sps = [];
    var scale = _scale != undefined && _scale != null ? _scale : 1;
    
    for(var i = 0 ; i < len; i++){
        var num = parseInt(str_score.charAt(i));
        
        var sp = cc.Sprite.create("res/global/"+num+".png");
        _fontx += (sp.width/2+gab)*scale;
        sp.setPosition(x+_fontx,y+sp.height/2);
        if(color != undefined && color != null)sp.setColor(color);
        if(scale != undefined && scale != null)sp.setScale(scale);
        parent.addChild(sp);
        _fontx += (sp.width/2+gab)*scale;
        sps.push(sp);
        
        if(i != len-1)
        if(iscomma && len > 3){
            if(len%3 == 1 && i%3 == 0 || len%3 == 2 && i%3 == 1 || len%3 == 0 && i%3 == 2){
                console.log("comma!!");
                var comma = cc.Sprite.create("res/global/c.png");
                _fontx += (comma.width/2+gab)*scale;
                comma.setPosition(x+_fontx,y+comma.height/2);
                if(color != undefined && color != null)comma.setColor(color);
                if(scale != undefined && scale != null)comma.setScale(scale);
                parent.addChild(comma);
                _fontx += (comma.width/2+gab)*scale;
                sps.push(comma);
            }
        }
    }
    var move = 0;
    switch(anchor){
        case ANCHOR_CC:
            move = -_fontx/2;
            break;
        case ANCHOR_LC:
            move = 0;
            break;
        case ANCHOR_RC:
            move = -_fontx;
            break;
    }
    for(var i = 0 ; i < sps.length; i++){
        var mx = sps[i].getPosition().x+move;
        var my = sps[i].getPosition().y;
        sps[i].setPosition(mx,my);
    }
    
}
function C_AddButton(parent,normal_url,click_url,x,y,tag,scale,zindex,callback,userdata){
    var Disable = cc.Sprite.create(normal_url);
    var Enable = click_url == null ? cc.Sprite.create(normal_url) : cc.Sprite.create(click_url);
    
//    Enable.setColor(Color3B.GRAY);
    var Item = cc.MenuItemSprite.create(Disable, Enable, function(){callback(tag);},self);
    Item.setUserData(tag);
     if(scale != undefined)Item.setScale(scale);

    var Menu = cc.Menu.create(Item);
    Menu.setPosition(x,y);
    Menu.setTag(tag);
    parent.addChild(Menu);
    return Item;
}


function C_SetArray1(data , x){
    var r=[];
    for(var i = 0; i < x; i++){
        r[i] = C_Clone(data);
    }
    return r;
}
function C_SetArray2(data , x, y){
    
    var r=[];
    for(var i = 0; i < x; i++){
        r[i] = [];
        for(var j = 0; j < y; j++){
            r[i][j] = C_Clone(data);
        }
    }
    return r;
}
function C_Clone(obj) {
    if (obj === null || typeof(obj) !== 'object')
        return obj;
    var copy = obj.constructor();
    for (var attr in obj) {
        if (obj.hasOwnProperty(attr)) {
            copy[attr] = obj[attr];
        }
    }
    return copy;
}
function C_GetSaveData(callback){

    try{
        
        var d1 = localStorage.getItem('d1',"");
        var d2 = localStorage.getItem('d2',"");
        var d3 = localStorage.getItem('d3',"");
        var d4 = localStorage.getItem('d4',"");
        var d5 = localStorage.getItem('d5',"");

        var s = "0";
        if(d1.length < 3){
            d1 = "1";
            for(var i = 0 ;  i < 2999; i++)d1+=s;
        }
        callback(d1,d2,d3,d4,d5);
    }catch(e){
        var s = "0";
        var d1 = "1";
        for(var i = 0 ;  i < 2999; i++)d1+=s;
        var d2 = "";
        var d3 = "";
        var d4 = "";
        var d5 = "";
        callback(d1,d2,d3,d4,d5);
    }
}
var stime = 0;
var mtime = 0;
var machine = {};
function C_SetLog(key, value){
    var date = new Date();
    var now_timestamp = date.getTime();
    switch(key){
        case LKEY_START:
            HEALTH_LOG[LOG.DAY] = param_healthday;
            if(HEALTH_LOG[LOG.DATE] != C_getToday(date, "yyyy-mm-dd") || HEALTH_LOG[LOG.START] == "")HEALTH_LOG[LOG.START] = C_getToday(date, "hh:mm:ss");
            HEALTH_LOG[LOG.DATE] = C_getToday(date, "yyyy-mm-dd");
            
            HEALTH_LOG[LOG.HEALTHPART] = value; //health part
            
            stime = now_timestamp;
            break;
        
        case LKEY_MACHINE_START: //1개의 운동기구 첫세트 시작할때
            machine = {name: value, starttime :now_timestamp, endtime :0};
            machine.starttime = now_timestamp; 
            mtime = now_timestamp;
            break;
        case LKEY_MACHINE_END: //1개의 운동기구 운동이 5세트가 끝났다.
            if(machine.endtime != undefined){
                machine.endtime = now_timestamp;
                HEALTH_LOG[LOG.MACHINES].push(machine);       
                
                //한개의 운동기구 파트가 끝날때마다 저장한다.
                HEALTH_LOG[LOG.END] = C_getToday(date, "hh:mm:ss"); //
                HEALTH_LOG[LOG.TOTAL] = now_timestamp - stime;

                C_AppSaveData("healthdata_"+param_healthday,HEALTH_LOG);
            }
            
            break;
        
        case LKEY_END:
            HEALTH_LOG[LOG.END] = C_getToday(date, "hh:mm:ss"); //
            HEALTH_LOG[LOG.TOTAL] = now_timestamp - stime;
            C_SendHealthData(HEALTH_LOG);
            break;        

    }
    
    
}
function C_PushModelId(id){
    WEIGHT_MODEL_IDS.push(id);
    C_AppSaveData("modelids_"+param_healthday,WEIGHT_MODEL_IDS);
}
function C_AppSaveData(key,value){
    var data = {key:key,value:value};
    C_AndroidCall("appSaveData",data);
    
}
function C_SendHealthData(data){
    var jsonstr = JSON.stringify(data);
    var message = jsonstr.replace(/\s/gi, "");
    if(!HEALTH_LOG[LOG.ISSENDDATA]){
        HEALTH_LOG[LOG.ISSENDDATA] = true;
        C_AppSaveData("healthdata_"+param_healthday,HEALTH_LOG);
        C_AndroidCall("gameLog",message);    //message = healthdata_ 같은거임 
    }
    
}
function C_SaveData(key, value){
//    SAVEDATA[key] = value;
    switch(key){
        case "runtype":
            SAVEDATA.RUNTYPE = value;
            break;
        case "health_speed":
            SAVEDATA.HEALTH_SPEED = value;
            break;        
    }
    C_AppSaveData("gamesettingdata",SAVEDATA);
}
function C_LoadData(callback){
     
}
function C_getToday(date, type){
    var year = date.getFullYear();
    var month = (date.getMonth()+1);
    month = month >= 10 ? month : '0'+month;
    var day = date.getDate();
    day = day >= 10 ? day : '0'+day;
    var hh = date.getHours();
    var mm = date.getMinutes();
    var ss = date.getSeconds();
    
    
    if(type && type == "yyyy-mm-dd")
        return year+'-'+month+'-'+day;
    else if(type && type == "hh:mm:ss")
        return hh+":"+mm+":"+ss;
    else 
        return year+'-'+month+'-'+day+" "+hh+":"+mm+":"+ss;
}
function C_SetSaveData(d1,d2,d3,d4,d5,callback){
//    uiloader.PLAYER.SETSAVEDATA(d1,d2,d3,d4,d5,function(){callback();});    
//    console.log("save d1 ",d1);
//    console.log("save d2 ",d2);
//    console.log("save d3 ",d3);
//    console.log("save d4 ",d4);
//    console.log("save d5 ",d5);
    try{
        localStorage.setItem('d1', d1);
        localStorage.setItem('d2', d2);
        localStorage.setItem('d3', d3);
        localStorage.setItem('d4', d4);
        localStorage.setItem('d5', d5);
        callback();
    }catch(e){
        callback();
    }
    
    callback();
    
}
function C_ShowLoadingProgress(self, color){

    var winSize = cc.director.getWinSize();
    var loadingLayer = self.getChildByTag(1555);
    if(loadingLayer != undefined && loadingLayer != null)
        loadingLayer.setVisible(true);
    else{
        //var loadingLayer = new cc.LayerColor(cc.color(11, 11, 11, 200));
        var _colorRGB = color ? color : cc.color(11, 11, 11, 200);
        var loadingLayer = new cc.LayerColor(_colorRGB);
        loadingLayer.setTag(1555);
        loadingLayer.setContentSize(WINSIZE_WIDTH,WINSIZE_HEIGHT);
        loadingLayer.addChild(C_PopupBack(self));
        var loading = new cc.Sprite(res._global_img_loading80);
        loading.setScale(2/3);
        loading.setPosition(cc.p(winSize.width/2,winSize.height/2));

        var rotate = cc.rotateBy(2, 1080, 0);
        var sequence = cc.sequence(rotate);
//        var action = cc.RepeatForever.create(sequence); 
        var action = C_Repeat_Forever(sequence);
        loading.runAction(action);

        loadingLayer.addChild(loading);
        self.addChild(loadingLayer, 1000);
    }

}
function C_HideLoadingProgress(self){
    var loadingLayer = self.getChildByTag(1555);
    if(loadingLayer != undefined && loadingLayer != null)
        loadingLayer.setVisible(false);
}
function C_PopupBack(_this){
    var size = cc.winSize;
    var back = new cc.MenuItemImage.create(res.img_not_click_back,res.img_not_click_back,function () {}, _this);

    back.setPosition(size.width/2,size.height/2);
    back.setScale(1.4);
    var menu = new cc.Menu(back);
    menu.x = 0;
    menu.y = 0;

    return menu;
}
function C_GetPlistInSpriteFrame(id, name, plist, ppng,x,y,ah,v,scale,color){

    var cache = cc.spriteFrameCache;

    cache.addSpriteFrames(plist,ppng);
    var frame = null;
    for (var key in cache._spriteFrames) {
        if(key == name){
            frame = cache.getSpriteFrame(key);
        }
    }
    return frame;
}
function C_GetPlistInSprite(id, name, plist, ppng,x,y,ah,v,scale,color){
    //var lists = mdata;
    var cache = cc.spriteFrameCache;

    cache.addSpriteFrames(plist,ppng);
    var sp = null;
    for (var key in cache._spriteFrames) {
        if(key == name){
            var frame = cache.getSpriteFrame(key);
            sp = cc.Sprite.createWithSpriteFrame(frame);
            sp.attr({
                x: C_getX(x),
                y:C_getY(y),
                anchorX:C_getAnchor(ah).x ,
                anchorY:C_getAnchor(ah).y
            }); 
            sp.setTag(id);
            sp.setVisible(v);
            if(color != undefined && color != 0)sp.setColor(color);
            if(scale != undefined && scale != 0)sp.scale = scale;

        }
    }
    return sp;
}
function C_PlistInSprite(parent, name, plist, ppng,x,y,ah,v,tag,scale,color){
    var sp = C_GetPlistInSprite(tag, name, plist, ppng,0,0,ah,v,scale,color)
    sp.setPosition(x,y);
    parent.addChild(sp);
    return sp;
}


function C_ShowMachinePopupLayer(self, img_res, title , message, OKCallback ){
    var layer = new MachineLayer();
    layer.setTag(ID.POPUP_LAYER_MACHINE);
    self.addChild(layer, 2222);
    layer.init(img_res,title,message,OKCallback);
    

}

function C_ShowWebViewDialogLayer(self, title , event, w,h, OKCallback , CancelCallback,style){
    var layer = new WebViewDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,event,w,h, OKCallback, CancelCallback,style);
    

}

function C_ShowSpeakDialogLayer(self, title , message, OKCallback , CancelCallback, style){
    var layer = new SpeakDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,message,OKCallback, CancelCallback,style);
    

}
function C_ShowDialogLayer(self, title , message, OKCallback , CancelCallback,style){
    var layer = new DialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,message,OKCallback, CancelCallback,style);
    

}
function C_ShowSelectLanguageDialogLayer(self, title , message, OKCallback , CancelCallback,style){
    var layer = new SelectLanguageDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,message,OKCallback, CancelCallback,style);
    

}
function C_ShowImageDialogLayer(self, title , message, imgres, OKCallback , CancelCallback,style){
    var layer = new ImageDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,message,imgres, OKCallback, CancelCallback,style);
    

}

function C_ShowMapDialogLayer(self, title , message, mapdatas, OKCallback , CancelCallback,style){
    var layer = new MapDialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,message,mapdatas, OKCallback, CancelCallback,style);
    

}
function C_ShowSettingLayer(self){
    
    var layer = new SettingLayer();
    layer.setTag(ID.POPUP_LAYER_SETTING);
    self.addChild(layer, 2222);

}
function C_GetObject(objs, id){
    var robj = null;
    for(var i = 0 ; i < objs.length; i++){
        if(objs[i].getTag() == id){
            robj = objs[i];       
            break;
        }
    }
    return robj;
}
function C_AndroidCall(AndroidFunctionName,message,callback){
    cc.log("cc.syst.os");
    cc.log("cc.syst.os" ,cc.sys.os);
    var callbackkey = C_make_Id();
    if(cc.sys.os == cc.sys.OS_IOS) {
        try{
            var callbackkey = C_make_Id();
            switch(AndroidFunctionName){
                case "checkQRCode":
                    webkit.messageHandlers.checkQRCode.postMessage({"callbackkey" :callbackkey , "message" : message});
                    
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
                case "closeWebView":
                   
                    webkit.messageHandlers.closeWebView.postMessage({ "message" : message});
                    break;
                case "gameLog":
                    webkit.messageHandlers.gameLog.postMessage({"callbackkey" :callbackkey , "message" : message});
                    break;
                case "appSaveData":
                    var key = message.key+"";
                    var value = JSON.stringify(message.value);
                    webkit.messageHandlers.appSaveData.postMessage({"key" :key , "value" : value});
                    
                    break;
                case "appLoadData":
                    webkit.messageHandlers.appLoadData.postMessage({"callbackkey" :callbackkey , "message" : message});
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
            }
        }catch(e){
            cc.log("iOS call error ",e);
        }
    }else {
        if(window.android){
           
//            console.log("window.android is ",window);
            switch(AndroidFunctionName){
                case "checkQRCode":

                    window.android.checkQRCode(callbackkey , message);    
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
                case "closeWebView":
                    window.android.closeWebView(message);    
                    break;
                case "gameLog":
                    window.android.gameLog(callbackkey , message);    
                    break;
                case "appSaveData":
                    var key = message.key+"";
                    var value = JSON.stringify(message.value);
                    window.android.appSaveData(key , value);    
                    break;
                case "appLoadData":
                    window.android.appLoadData(callbackkey , message);    
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
            }
        }
    }
    
}

function C_make_Id() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_";

    for (var i = 0; i < 16; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
function C_StartCountDown(self, max_num,callback){
    var size = cc.winSize;
    var layer = null;
    var countdown_interval = setInterval(function(){
        if(GLOBAL_PAUSE_ALL)return;
        
        if(layer != null){layer.runAction(cc.RemoveSelf.create());layer = null;}
        layer = new cc.Layer();
        var color = max_num <= 10 ? Color3B.RED : null;
            C_DrawCommaNumbers(layer,max_num+"",size.width/2,size.height/2-50,ANCHOR_CC,color,1,false);
            self.addChild(layer);
            
            if(max_num <= 10)
                C_PlaySound(SOUND.COUNTDOWN); 
            if(max_num == 2)
                C_PlaySound(SOUND.READY); 
            if(max_num == 0)
                C_PlaySound(SOUND.START); 
            //애니메이션 
            layer.setScale(7);
            var scale = cc.scaleTo(0.1,2,2);
            layer.runAction(scale);
        
        
        if(max_num == 0){
            
            clearInterval(countdown_interval);
            callback();
            setTimeout(function(){if(layer != null){layer.runAction(cc.RemoveSelf.create());layer = null;}},1000);
        }
        max_num--;
    },1000);    
}
function C_GetRandomPosition(w,h){    
    var _x = Math.floor(Math.random() * w)+(WINSIZE_WIDTH-w)/2;
    var _y = Math.floor(Math.random() * h)+350;
    return {x:_x,y:_y};
            
            
}
function C_MaxLen(str, max){
    var txt = str.length > max ? str.substr(0,max)+"..." : str;
    return txt;
}
function C_WrapTextByWidth(str, maxCharsPerLine) {
    if (!str || maxCharsPerLine <= 0) return str;

    let result = '';
    let lineCharCount = 0; // 현재 줄에서 얼마나 문자가 쌓였는지

    for (let i = 0; i < str.length; i++) {
        const char = str[i];
        result += char;

        if (char === '\n') {
            lineCharCount = 0; // 줄바꿈이면 카운트 리셋
        } else {
            lineCharCount++;
        }

        // 줄바꿈이 아닌 상태에서, 줄 길이가 maxCharsPerLine 도달하면 자동 개행
        if (lineCharCount === maxCharsPerLine && i !== str.length - 1) {
            result += '\n';
            lineCharCount = 0;
        }
    }

    return result;
}

function C_AsyncCall(callurl, options, onComplete, onError){
      
        if (!options) options = {};
        return $.ajax({
            url : callurl
            ,method : 'POST'
            ,headers: {
                'Content-Type' : 'application/x-www-form-urlencoded'
            }
            ,data : options
            ,transformRequest: function(data){
                return $.param(data);
            }
            ,success : function(data, status, xhr){
                
                if(onComplete) onComplete(data);
            }
            ,error : function(xhr, status, err){

                if(onError) onError(err);
            }
        });

    }
function initIframeTouchEvent(self){
    window.addEventListener("message", function(event) {
//        console.log("📩 iframe 메시지 수신됨:111", event);
        if(event.data.type && event.data.type == "iframe_clicked"){
             self.webViewPage = event.data.value;
        }else {
            
        
            switch (event.data) {
              case "iframe_clicked":
                console.log("✅ iframe 내 클릭 감지됨");
                self.resetInactivityTimer();
                break;
              case "iframe_button_clicked":
                console.log("🟢 iframe 내 버튼 클릭됨");
                self.resetInactivityTimer();
                break;
              case "iframe_scrolled":
                console.log("🔄 iframe 내 스크롤 발생!");
                self.resetInactivityTimer();
                break;          
            }
        }
  });
}
//자동업데이트체크
function checkAutoUpdate(callback){
    var _data = {
        "projectid":param_projectid, 
        "groupidx":param_groupidx
    }
    AJAX_AdmGetGame(ADM_TYPE.CHECK_AUTO_UPDATE, _data, function(res){
       code = parseInt(res.code);
       if (code == 100) {
           callback(res.message);
           
       }            
    }); 
}
//날씨데이터 가져오기
function getWeatherData( mode, callback){
    var _data = {
        "mode" : mode,
        "sido" : "서울",
        "projectid":param_projectid, 
        "groupidx":param_groupidx
    }
    AJAX_AdmGetGame(ADM_TYPE.GET_WEATHER_DATA, _data, function(res){
       code = parseInt(res.code);
       if (code == 100) {
           callback(res.message);
           
       }else{
           callback(null);
       }            
    }); 
}
//미세먼지데이터 가져오기
function getAirData(callback){
    AJAX_AdmGetGame(ADM_TYPE.GET_AIR_DATA, {"projectid":param_projectid, "groupidx":param_groupidx}, function(res){
       code = parseInt(res.code);
       if (code == 100) {
           callback(res.message);
           
       }else{
           callback(null);
       }            
    }); 
}
//미세먼지 데이터로 표시하기 위한 데이터 가공해서 가져오기
function getDustLevelInfo(pm10, pm25) {
    
    if(pm10 == "-")
        pm10 = 0;
    if(pm25 == "-")
        pm25 = 0;
  // 등급 기준
  const levels = [
    { grade: "아주좋음", icon: "res/global/icon_very_good.png", pm10: 30, pm25: 15 },
    { grade: "좋음", icon: "res/global/icon_good.png", pm10: 80, pm25: 35 },
    { grade: "보통", icon: "res/global/icon_normal.png", pm10: 150, pm25: 75 },
    { grade: "나쁨", icon: "res/global/icon_bad.png", pm10: 200, pm25: 115 },
    { grade: "아주나쁨", icon: "res/global/icon_very_bad.png", pm10: Infinity, pm25: Infinity }
  ];

  let pm10Grade = levels.find(l => pm10 <= l.pm10);
  let pm25Grade = levels.find(l => pm25 <= l.pm25);

  // 더 높은 등급(나쁜 것)을 선택
  const finalGrade = Math.max(
    levels.indexOf(pm10Grade),
    levels.indexOf(pm25Grade)
  );

  var _grade = levels[finalGrade] && levels[finalGrade].grade ? levels[finalGrade].grade : "";
  var _icon = levels[finalGrade] && levels[finalGrade].icon ? levels[finalGrade].icon : "";
  return {
    grade: _grade,
    iconClass: _icon
  };
}


function drawAirText(parent, x, y, mode, dustInfo){
    //미세먼지 텍스트
   if(!parent)return;
    console.log("drawAirText : dustInfo ",dustInfo);
    
    if(mode == "icon"){
        var _icon = dustInfo.iconClass ? dustInfo.iconClass : "";
        
        C_AddCustomFont(parent,"미세먼지", x, y+30, null, 1, cc.TEXT_ALIGNMENT_CENTER , 16, C_HEXtoCCColor("#ffffff"),false);    
        if(_icon)C_AddSprite(parent,_icon, x, y-25,1,1,null);    
    }else { // text mode
        var _grade = dustInfo.grade ? dustInfo.grade : "";
        C_AddCustomFont(parent,"미세먼지 "+_grade, x, y+30, null, 1, cc.TEXT_ALIGNMENT_CENTER , 16, C_HEXtoCCColor("#ffffff"),false);    
//        if(_grade)C_AddCustomFont(parent,_grade, x, y-20, null, 1, cc.TEXT_ALIGNMENT_CENTER , 20, C_HEXtoCCColor("#ffffff"),false);    
    }
    console.log("dustInfo.icon ",dustInfo);
    
}
function drawWeatherToday(parent, x, y, weatherdata, spdata){//mode, _fontColor, _fontSizeBig, _fontSizeSmall,iconscale){
     if(!parent)return;
     if(!weatherdata)return;
        console.log("weatherdata : ",weatherdata);
       console.log("spdata : ",spdata);
     C_AddCustomFont(parent,weatherdata.today_tmp+"℃", x-20, y+15, null, 1, cc.TEXT_ALIGNMENT_CENTER , spdata.fontsize_big, C_HEXtoCCColor(spdata.fontcolor),false);    
     C_AddSprite(parent,getWeatherIconRes(weatherdata.today_sky, weatherdata.today_pty), x+60, y+30,1,spdata.iconscale,null);    
     C_AddCustomFont(parent,"최저"+weatherdata.today_tmn+"℃ / 최고"+weatherdata.today_tmx+"℃", x+10, y-20, null, 1, cc.TEXT_ALIGNMENT_CENTER , spdata.fontsize2_small, C_HEXtoCCColor(spdata.fontcolor),false);    
//     C_AddCustomFont(parent," / 최고"+weatherdata.today_tmx+"℃", x+100, y-20, null, 1, cc.TEXT_ALIGNMENT_CENTER , spdata.fontsize2_small, C_HEXtoCCColor(spdata.fontcolor),false);    
    
}
//function drawWeatherTodayTomorrow(parent, x, y, weatherdata, mode, _fontColor, _fontSizeBig, _fontSizeSmall){
//         var item = weatherdata.response && weatherdata.response.body && weatherdata.response.body.items && weatherdata.response.body.items.item ? weatherdata.response.body.items.item : [];
//         var todayArray = [];
//         var tomorrowArray = [];
//
//         for(var i=0; i<item.length; i++) {
//            // 강수형태
//            if (item[i].category == 'PTY') {
//               if (item[i].fcstDate == today) {
//                  if (todayArray.pty == null || todayArray.pty < item[i].fcstValue) {
//                     todayArray.pty = item[i].fcstValue;
//                  }
//               } else if (item[i].fcstDate == tomorrow) {
//                  if (tomorrowArray.pty == null || tomorrowArray.pty < item[i].fcstValue) {
//                     tomorrowArray.pty = item[i].fcstValue;
//                  }
//               }
//            }
//            // 하늘상태
//            if (item[i].category == 'SKY') {
//               if (item[i].fcstDate == today) {
//                  if (todayArray.sky == undefined || todayArray.sky < item[i].fcstValue) {
//                     todayArray.sky = item[i].fcstValue;
//                  }
//               } else if (item[i].fcstDate == tomorrow) {
//                  if (tomorrowArray.sky == undefined || tomorrowArray.sky < item[i].fcstValue) {
//                     tomorrowArray.sky = item[i].fcstValue;
//                  }
//               }
//            }
//            // 최저온도
//            if (item[i].category == 'TMN') {
//               if (item[i].fcstDate == today) {
//                  todayArray.tmn = item[i].fcstValue;
//               } else if (item[i].fcstDate == tomorrow) {
//                  tomorrowArray.tmn = item[i].fcstValue;
//               }
//            }
//            // 최고온도
//            if (item[i].category == 'TMX') {
//               if (item[i].fcstDate == today) {
//                  todayArray.tmx = item[i].fcstValue;
//               } else if (item[i].fcstDate == tomorrow) {
//                  tomorrowArray.tmx = item[i].fcstValue;
//               }
//            }
//         }
//    
//        C_AddCustomFont(parent,"º", x, y+60, null, 1, cc.TEXT_ALIGNMENT_CENTER , 30, C_HEXtoCCColor("#ffffff"),false);    
//        C_AddSprite(parent,getWeatherIconRes(todayArray.sky, todayArray.pty), x, y-10,1,1,null);    
//
//    
//         if (index != undefined && num != undefined) {
//            $('.today_icon'+index+"_"+num).html($('<img width="70%" />').attr('src', getWeatherIconRes(todayArray.sky, todayArray.pty)));
//            $('.today_temp'+index+"_"+num).html(todayArray.tmn + '℃/' + todayArray.tmx + '℃');
//            $('.tomorrow_icon'+index+"_"+num).html($('<img width="70%"/>').attr('src', getWeatherIconRes(tomorrowArray.sky, tomorrowArray.pty)));
//            $('.tomorrow_temp'+index+"_"+num).html(tomorrowArray.tmn + '℃/' + tomorrowArray.tmx + '℃');
//         } 
//}


// 하늘상태(SKY) 코드 : 맑음(1), 구름조금(2), 구름많음(3), 흐림(4)
// 강수형태(PTY) 코드 : 없음(0), 비(1), 비/눈(2), 눈(3), 소나기(4)
function getWeatherIconRes( sky, pty ) {
    var wether = ['sunny', 'partlysunny', 'partlycloudy', 'cloudy', 'rain', 'sleet', 'snow'];
   var iconName = wether[0];
   if(pty > 0) {
      switch (pty) {
         case '1':
            iconName = wether[4];
            break;
         case '2':
            iconName = wether[5];
            break;
         case '3':
            iconName = wether[6];
            break;
      }
   } else {
      switch (sky) {
         case '1':
            iconName = wether[0];
            break;
         case '2':
            iconName = wether[1];
            break;
         case '3':
            iconName = wether[2];
            break;
         case '4':
            iconName = wether[3];
            break;
      }
   }
    console.log("./res/icons/" + iconName + ".png");
   return "./res/icons/" + iconName + ".png";
};

function drawProgressArc(parent, x, y, percent, max, radius, _fontColor, _fontSize, _arcLineWidth) {
    console.log("parent "+parent+", x "+x+", y "+y+", percent "+percent+", max "+max+", radius "+radius+" , _fontColor "+_fontColor+" , _fontSize, "+_fontSize+" _arcLineWidth "+_arcLineWidth);
    var drawNode = new cc.DrawNode();
    parent.addChild(drawNode);

    var center = cc.p(x, y);
    var arcLineWidth = _arcLineWidth;

    function getColorByPercent(p) {
        if (p <= 40) return cc.color(0, 0, 255, 255);        // 파랑
        else if (p <= 80) return cc.color(0, 200, 255, 255); // 하늘색
        else if (p <= 120) return cc.color(0, 255, 0, 255);  // 초록
        else if (p <= 160) return cc.color(255, 255, 0, 255); // 노랑
        else return cc.color(255, 0, 0, 255);                // 빨강
    }

    var clampedPercent = Math.max(0, Math.min(percent, max));
    var angle = (clampedPercent / max) * 360;

    var totalSegments = Math.ceil(360 / 3); // 전체 원 기준 segment 수
     var progressSegments = Math.ceil(angle / 3);
    var startAngle = -90; // 12시 방향 시작
    var endAngle = startAngle + 360;

    ////////////////////////////////////
    // 테두리 끝이 둥근모양
    ////////////////////////////////////
    
    // 1. 전체 흰색 테두리 원
//    for (var i = 0; i < totalSegments; i++) {
//        var a1 = startAngle + (360) * (i / totalSegments);
//        var a2 = startAngle + (360) * ((i + 1) / totalSegments);
//        var rad1 = a1 * Math.PI / 180;
//        var rad2 = a2 * Math.PI / 180;
//
//        var p1 = cc.p(x + radius * Math.cos(rad1), y + radius * Math.sin(rad1));
//        var p2 = cc.p(x + radius * Math.cos(rad2), y + radius * Math.sin(rad2));
//
//        drawNode.drawSegment(p1, p2, lineWidth, cc.color(255, 255, 255, 100)); // 흐릿한 흰색
//    }
//
//   // 2. 진행률 색상 arc
//    var progressSegments = Math.ceil(angle / 3);
//    var progressColor = getColorByPercent(clampedPercent);    
//   
//    for (var i = 0; i < progressSegments; i++) {
//        var a1 = startAngle + angle * (i / progressSegments);
//        var a2 = startAngle + angle * ((i + 1) / progressSegments);
//        var rad1 = a1 * Math.PI / 180;
//        var rad2 = a2 * Math.PI / 180;
//
//        var p1 = cc.p(x + radius * Math.cos(rad1), y + radius * Math.sin(rad1));
//        var p2 = cc.p(x + radius * Math.cos(rad2), y + radius * Math.sin(rad2));
//
//        drawNode.drawSegment(p1, p2, lineWidth, progressColor);
//    }
    ////////////////////////////////////
    
    ////////////////////////////////////
    // 테두리 끝이 딱잘린모양
    ////////////////////////////////////
    var bgColor = cc.color(255, 255, 255, 255);
    var fgColor = getColorByPercent(clampedPercent);

    // 1. 전체 배경 arc (하얀색, 각진 조각)
    for (var i = 0; i < totalSegments; i++) {
        drawArcSegment(drawNode, x, y, radius, arcLineWidth, startAngle + i * 3, 3, bgColor);
    }

    // 2. 진행 arc (색상, 각진 조각)
    for (var i = 0; i < progressSegments; i++) {
        drawArcSegment(drawNode, x, y, radius, arcLineWidth, startAngle + i * 3, 3, fgColor);
    }

    C_AddCustomFont(drawNode, ""+percent, x, y, null, 1, cc.TEXT_ALIGNMENT_CENTER ,_fontSize, C_HEXtoCCColor(_fontColor),false,function(tag){
                 
    });
}

function drawArcSegment(drawNode, cx, cy, radius, width, startDeg, arcDeg, color) {
    var rad1 = (startDeg) * Math.PI / 180;
    var rad2 = (startDeg + arcDeg) * Math.PI / 180;

    var rOuter = radius;
    var rInner = radius - width;

    var p1 = cc.p(cx + rInner * Math.cos(rad1), cy + rInner * Math.sin(rad1));
    var p2 = cc.p(cx + rOuter * Math.cos(rad1), cy + rOuter * Math.sin(rad1));
    var p3 = cc.p(cx + rOuter * Math.cos(rad2), cy + rOuter * Math.sin(rad2));
    var p4 = cc.p(cx + rInner * Math.cos(rad2), cy + rInner * Math.sin(rad2));

    drawNode.drawPoly([p1, p2, p3, p4], color, 0, color);
}


function C_AddWebView(parent, webview, x, y, w, h, pageurl) {
        var self = this;
        var size = cc.winSize;
        if (!ccui || !ccui.WebView) {
            cc.log("WebView is not supported in this version of Cocos2d-JS.");
            return;
        }
        
        webview = new ccui.WebView();
        webview.setContentSize(w, h);
        webview.setAnchorPoint(0.5, 0.5);
        webview.setPosition(x, y);
        
       
        webview.loadURL("../../../../game/webpage/type_video.html?url="+pageurl);
        webview.setScalesPageToFit(true);
        webview.setVisible(true);
        webview.boderStyle("none");//iframe 테두리 안보이기

        parent.addChild(webview, 999);
}
//function C_spriteAnimation(parent, x,y,res_arr,speed,scale){
//    var ani = cc.Animation.create();   // create the animation
//
//    var sprite = cc.Sprite.create(res_arr[0]);  // create the object
//    sprite.setPosition(x,y);   // set position
//    parent.addChild(sprite);    // add it to the layer or scene
//    sprite.setScale(scale);
//
//    for(var i = 0 ; i < res_arr.length; i++) 
//        ani.addSpriteFrameWithFile(res_arr[i]);   // add frame 0
////        ani.addSpriteFrameWithFileName(magic12);  // add frame 1
//    ani.setDelayPerUnit(speed);   // set the delay time, in seconds
//    ani.setLoops(100000);  // repeat the animation 5 times,
//    var action = cc.Animate.create(ani);   
//
//    sprite.runAction(action);
//    return sprite;
//}
function C_spriteAnimation(parent, x, y, tag, res_arr, speed, scale, onClickCallback, delaytime) {
    // 1. 애니메이션 설정
    var ani = cc.Animation.create();
    for (var i = 0; i < res_arr.length; i++) {
        ani.addSpriteFrameWithFile(res_arr[i]);
    }
    ani.setDelayPerUnit(speed);
    
    // [수정] 루프를 여기서 설정하지 않습니다. (기본 1회 실행)
    // ani.setLoops(1); // 기본값이 1이므로 생략 가능

    // 2. 스프라이트 생성
    var sprite = cc.Sprite.create(res_arr[0]);
    sprite.setPosition(x, y);
    sprite.setScale(scale);
    sprite.setTag(tag);
    parent.addChild(sprite);
    
    // 3. 액션 구성
    var animateAction = cc.Animate.create(ani);
    var delayAction = cc.delayTime(delaytime);
    
    // [핵심] (애니메이션 1회 -> 딜레이) 과정을 무한 반복합니다.
    var seq = cc.Sequence.create(animateAction, delayAction);
    var repeatAction = seq.repeatForever(); 
    
    sprite.runAction(repeatAction);

    // ✅ 클릭(터치) 이벤트 리스너 (기존과 동일)
    var listener = cc.EventListener.create({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true,
        onTouchBegan: function (touch, event) {
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(touch.getLocation());
            var s = target.getContentSize();
            var rect = cc.rect(0, 0, s.width, s.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                if (typeof onClickCallback === "function") {
                    onClickCallback(tag);
                }
                return true;
            }
            return false;
        }
    });
    cc.eventManager.addListener(listener, sprite);

    return sprite;
}
function C_spriteSheetAnimation(parent, img_path, x, y, col, row, speed, scale, delayBetweenCycles, onClickCallback) {
    // 1. 텍스처 로드 및 크기 계산
    var texture = cc.textureCache.addImage(img_path);
    var textureSize = texture.getContentSize();
    var frameW = textureSize.width / col;
    var frameH = textureSize.height / row;

    // 2. [수정] 프레임 배열을 먼저 생성 (이게 핵심입니다)
    var animFrames = [];
    for (var r = 0; r < row; r++) {
        for (var c = 0; c < col; c++) {
            // 이미지에서 자를 영역 설정
            var rect = cc.rect(c * frameW, r * frameH, frameW, frameH);
            // SpriteFrame을 만들 때 텍스처와 영역을 정확히 지정
            var frame = new cc.SpriteFrame(texture, rect);
            animFrames.push(frame);
        }
    }

    // 3. 스프라이트 생성 (첫 번째 프레임 설정)
    var sprite = new cc.Sprite(animFrames[0]); 
    sprite.setPosition(x, y);
    sprite.setScale(scale);
    parent.addChild(sprite);

    // 4. 애니메이션 생성
    var animation = new cc.Animation(animFrames, speed);
    var animate = cc.animate(animation);

    // 5. 시퀀스 및 무한 반복 설정
    var action;
    if (delayBetweenCycles > 0) {
        // 애니메이션 1회(animate) -> 대기(delayTime) -> 다시 시작
        action = cc.sequence(animate, cc.delayTime(delayBetweenCycles)).repeatForever();
    } else {
        action = animate.repeatForever();
    }

    sprite.runAction(action);

    // 6. 터치 리스너 (영역 계산 보정)
    var listener = cc.EventListener.create({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true,
        onTouchBegan: function (touch, event) {
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(touch.getLocation());
            // 현재 프레임 크기만큼만 터치되도록 함
            var s = target.getContentSize();
            var rect = cc.rect(0, 0, s.width, s.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                if (typeof onClickCallback === "function") onClickCallback(target);
                return true;
            }
            return false;
        }
    });
    cc.eventManager.addListener(listener, sprite);

    return sprite;
}
function random_string(_len) {
    var len = 16;
    if (_len) len = _len;
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_";

    for (var i = 0; i < len; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
function C_setUI(self,size,data){
    var sp = null;
    var ani_sps = [];
    
    var scale = data.scale ? data.scale : 1;
    
    var textdata = data.text ? data.text[self.language_code] : null;
    switch(data.type){
        case DATATYPE.IMG:
            sp = C_AddSprite(self,C_getResPath(data.imgurl), data.x, C_getY(data.y),1,scale,null,null,null,textdata);
            break;
        case DATATYPE.VIDEO:
            // <video id="backgroundVideo" autoplay loop muted  style="width: 100%; height: 100%; position: absolute; z-index: 0;background-color: #dddddd;display:none"></video>
            var backgroundVideo = document.getElementById("backgroundVideo");
            var offset = data.videourl.indexOf("res/");
            var path = data.videourl.substr(offset);
            console.log("path is "+path);
            backgroundVideo.src = path;
            if(path != "")backgroundVideo.style.display = "block";
            backgroundVideo.style.marginLeft = data.x+"px";
            backgroundVideo.style.marginTop = data.y+"px";
            if(data.w < param_sw)backgroundVideo.style.width = data.w+"px";
            if(data.h < param_sh)backgroundVideo.style.height = data.h+"px";
//            backgroundVideo.style.width = data.w+"px";
//            backgroundVideo.style.height = data.h+"px";
            
            break;
        case DATATYPE.BUTTON:
            var clickurl = data.clickurl ? C_getResPath(data.clickurl) : C_getResPath(data.imgurl);
            
            sp = C_AddSpriteTouch(self,C_getResPath(data.imgurl), data.x, C_getY(data.y),data.id,scale,null, function(tag) {
                self.buttonClick(tag);
            },textdata);
            
           
//            sp = C_AddAnimButton(self, C_getResPath(data.imgurl), clickurl,  parseInt(data.x), C_getY(parseInt(data.y)), data.id, scale, 1, function (tag) {
//                self.buttonClick(tag);
//            }, self);
            
            
//            C_AddButton(self,C_getResPath(data.imgurl),clickurl,parseInt(data.x), C_getY(parseInt(data.y)),random_string(),scale,1,function(tag){
//                self.buttonClick(tag);
//            });
            break;
        case DATATYPE.BUTTON_TEST:
           
//            var clickurl = data.clickurl ? C_getResPath(data.clickurl) : C_getResPath(data.imgurl);
//            sp = C_AddAnimButton(self, C_getResPath(data.imgurl), clickurl,  parseInt(data.x), C_getY(parseInt(data.y)), data.id, scale, null, function (tag) {
//                self.buttonClick(tag);
//            }, self);
            
            break;
        case DATATYPE.ANIMATION:
            for(var i = 0 ; i < data.imgurls.length;i++){
                ani_sps.push(C_AddSprite(self,C_getResPath(data.imgurls[i]), data.x, C_getY(data.y),1,scale,null));
            }
            return ani_sps;
            break;
         case DATATYPE.SPRITE_ANIMATION:
            var arr_flag = [];
            for(var i = 0 ; i < data.imgurls.length;i++){
                arr_flag.push(data.imgurls[i]);
            }
            
             
            this.speak_ani = C_spriteAnimation(self, data.x, C_getY(data.y), data.id, arr_flag, parseFloat(data.speed), 1, function(tag){
                console.log("sprite_animation click!! "+tag);
                self.buttonClick(tag);
            },5);
            
//            return ani_sps;
            break;
        case DATATYPE.BGCOLOR:
            sp = self.addChild(new cc.LayerColor.create(cc.color(data.color)));
            break;     
         case DATATYPE.WEATHERAPI:
            sp = C_AddSprite(self,res.empty, data.x, C_getY(data.y),1,scale,null);
            
            C_updateWeather(sp , data);
        
            break;     
        case DATATYPE.AIRAPI:
            sp = C_AddSprite(self,res.empty, data.x, C_getY(data.y),1,scale,null);
            C_updateAir(sp , data);
            break;     
        case DATATYPE.TEXT:
            var mtext = data.text;
            
            if (data.texttype) {
                var date = new Date();
                switch (data.texttype) {
                    case "m/d":
                        // 월/일 (월은 0부터 시작하므로 +1 필요)
                        var mmm = date.getMonth() + 1 < 10 ? "0"+(date.getMonth() + 1) : date.getMonth() + 1;
                        var dd =  date.getDate() < 10 ? "0"+ date.getDate() :  date.getDate();
                        mtext = mmm+ "/" + dd;
                        
                        break;
                    case "hh:mm":
                        // 시:분
                        
                         var ampm = date.getHours() >= 12 ? "PM" : "AM";   // 오전/오후 구분
                        var hh = date.getHours() % 12;                        // 12시간제로 변환
                        hh = hh === 0 ? 12 : hh;                   // 0시는 12로 표시
                        hh = hh < 10 ? "0"+hh : hh;
                        var mm = date.getMinutes() < 10 ? "0"+date.getMinutes() : date.getMinutes();
                        mtext = ampm + " " + hh + ":" + mm;
                        
//                        var hour = date.getHours().toString().padStart(2, '0');
//                        var minute = date.getMinutes().toString().padStart(2, '0');
//                        mtext = hour + ":" + minute;
                        break;
                    case "weekday":
                        // 요일 이름 구하기
                        var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
                        mtext = weekdays[date.getDay()];
                        break;
                }
            }

            
            var text_align = cc.TEXT_ALIGNMENT_CENTER;
            switch(data.textalign){
                case "left":
                    text_align = cc.TEXT_ALIGNMENT_LEFT;
                    break;
                case "center":
                    text_align = cc.TEXT_ALIGNMENT_CENTER;
                    break;
                case "right":
                     text_align = cc.TEXT_ALIGNMENT_RIGHT;
                    break;                    
            }
           
            sp = C_AddCustomFont(self,mtext, parseInt(data.x), C_getY(parseInt(data.y)), data.id, 1, text_align ,data.fontsize, C_HEXtoCCColor(data.fontcolor),false,function(tag){
                 self.buttonClick(tag);
            });
            break;
    }
    if(data.animationtype)C_setDataAnimaionType(self,size,sp, data.animationtype);
    return sp;
}

function C_updateAnimation(anidata, nowtime){
       
    const aniTime = parseInt(anidata.anitime);
    var frameCount = anidata.ani_sps.length;
     var frameDuration = aniTime / frameCount; 

    var currentIndex = Math.floor((nowtime*1000) / frameDuration) % frameCount;
    if (anidata.nowindex !== currentIndex) {
        // 모든 스프라이트 숨기기
        for (var i = 0; i < frameCount; i++) {
            anidata.ani_sps[i].setVisible(false);
        }

        // 현재 인덱스만 보이기
        anidata.ani_sps[currentIndex].setVisible(true);

        // 현재 인덱스 저장
        anidata.nowindex = currentIndex;
    }
}
var before_sectime = 0;
var before_hourtime = 0;
//월/일 , 시:분, 요일 업데이트
function C_updateDateTime(md,hhmm,weekday, nowtime){
    var now_sectime = parseInt(nowtime);
    if(before_sectime != now_sectime){
//        console.log("nowtime ",nowtime);  
        before_sectime = now_sectime;
        var date = new Date();
        var mmm = date.getMonth()+1 < 10 ? "0"+(date.getMonth()+1) : date.getMonth()+1;
        var dd = date.getDate() < 10 ? "0"+date.getDate() : date.getDate();
        md.string = mmm+"/"+dd;
//        hhmm.string = now_sectime%2 == 0 ? date.getHours()+" "+date.getMinutes() : date.getHours()+":"+date.getMinutes();
        
        //24시기준 
//        var hh = date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
//        var mm = date.getMinutes() < 10 ? "0"+date.getMinutes() : date.getMinutes();
//        hhmm.string = hh+":"+mm;
        
        //12시기준
        var hh24 = date.getHours();
        var mm = parseInt(date.getMinutes()) < 10 ? "0"+date.getMinutes() : date.getMinutes();

        var ampm = hh24 >= 12 ? "PM" : "AM";   // 오전/오후 구분
        var hh = hh24 % 12;                        // 12시간제로 변환
        hh = hh === 0 ? 12 : hh;                   // 0시는 12로 표시
        hh = hh < 10 ? "0"+hh : hh;

        hhmm.string = ampm + " " + hh + ":" + mm;
        
        
        var weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        if(weekday)weekday.string = weekdays[date.getDay()];                
    }
}
function C_checkGetHomeData(self,callback){
    if(!getgamedata){
            AJAX_AdmGet(ADM_TYPE.GET_HOME_DATA, {"projectid":param_projectid, "groupidx":param_groupidx}, function(res){
               var code = parseInt(res.code);
               if (code == 100) {
                   getgamedata = res.message;
                   
               }   
                callback();
            }); 
        }else {
            callback();
        }
}

var menu_click_time = 0;


///////////////////////////////////////////////////
//  재난안전문자 관련 START
///////////////////////////////////////////////////
var _lastSafetyCheck = 0;
function C_checkSafetyData(wtime){
    
      // 1분(60초)마다 호출
        if (!_lastSafetyCheck) {
            _lastSafetyCheck = 0;
        }

        if (wtime - _lastSafetyCheck >= 60) {
            C_callSafetyData();
            _lastSafetyCheck = wtime; // 기준 갱신
        }
}
var isSafetyShow = 0;
var safetydatas = [];
function C_callSafetyData(){
    if(getgamedata.hm_region && getgamedata.hm_safety_onoff == 1){
        AJAX_AdmGetGame(ADM_TYPE.GET_SAFETY_DATA, {"projectid":param_projectid, "groupidx":param_groupidx}, function(res){
           var code = parseInt(res.code);
           if (code == 100) {
               safetydatas = res.message;
               console.log("safetydatas is ",safetydatas);
               if(safetydatas.length > 0 ){
                   isSafetyShow = 1;               
               }
           }
        }); 
    }
}
// 로컬스토리지 fallback 전역 변수
var g_safetyLogs = { date: "", sns: [] };

function getSafetyLogs() {
    try {
        var storedData = JSON.parse(localStorage.getItem("safetyLogs") || "{}");

        // storedData 가 비어있으면 g_safetyLogs 사용
        if (!storedData || Object.keys(storedData).length === 0) {
            return g_safetyLogs;
        }

        return storedData;
    } catch (e) {
        // localStorage 자체가 막혀있는 경우
        return g_safetyLogs;
    }
}

function setSafetyLogs(data) {
    try {
        g_safetyLogs = data;
        localStorage.setItem("safetyLogs", JSON.stringify(data));
    } catch (e) {
        // localStorage 저장 실패 → 전역변수에 저장
        g_safetyLogs = data;
    }
}

function C_checkSafetyDialogShow(self) {
    setTimeout(function () {
        if (isSafetyShow == 1 && safetydatas.length > 0) {

            var safety = safetydatas[0]; // 첫 번째 데이터 사용
            var sn = safety["SN"];
            var crtDt = safety["CRT_DT"].split(" ")[0]; // "2025/09/24"

            // 오늘 날짜
            var today = new Date().toISOString().slice(0, 10).replace(/-/g, "/"); 

            // 로컬스토리지(또는 전역변수) 데이터 가져오기
            var storedData = getSafetyLogs();

            // 날짜가 바뀌었으면 초기화
            if (storedData.date !== today) {
                storedData = { date: today, sns: [] };
            }

            // 이미 본 SN이면 팝업 안 띄움
            if (storedData.sns.includes(sn)) {
                console.log("이미 본 SN, 팝업 건너뜀:", sn);
                return;
            }

            // 새 SN 저장
            storedData.sns.push(sn);
            setSafetyLogs(storedData);

            // 팝업 띄우기
            isSafetyShow = 0;
            C_showSafetyMessageDialog(self, safety);
        }
    }, 3000);
}
//재난문자 팝업을 띄운다.
function C_showSafetyMessageDialog(self,safetydata){
    var title = "긴급재난문자 ["+safetydata["DST_SE_NM"]+"]";
    var message = safetydata["MSG_CN"];
    message = message.replace(/(.{40})/g, "$1\n");
    var closetime = getgamedata.hm_safety_closetime ? getgamedata.hm_safety_closetime : 0;
    C_ShowDialogLayer(self, title , message, function(){
        
    },null,null,closetime);
}
///////////////////////////////////////////////////
//  재난안전문자 관련 END
///////////////////////////////////////////////////



//1시간마다 날씨, 미세먼지 업데이트
function C_updateWeatherAir(obj_weather, obj_air, nowtime){
//    var now_hourtime = parseInt(nowtime/3600);
//     if(before_hourtime != now_hourtime){
//         before_hourtime = now_hourtime;
//         C_updateWeather(obj_weather.sp, obj_weather.data);
//         C_updateAir(obj_weather.sp, obj_weather.data);
//     }
    
    
     var date = new Date();
    var h = date.getHours();
    if(before_weatherhour == -1 || before_weatherhour != h)C_updateWeather(obj_weather.sp, obj_weather.data);
    if(before_airhour == -1 || before_airhour != h)C_updateAir(obj_air.sp, obj_air.data);
}
var before_weatherhour = -1;
var now_weatherdata = {};
function C_updateWeather(sp , data){
    sp.removeAllChildren();
    var date = new Date();
    var h = date.getHours();
   if(before_weatherhour == -1 || before_weatherhour != h){
       before_weatherhour = h;
       getWeatherData(data.mode, function(weatherdata_str){
            
            if(typeof(weatherdata_str) == 'object')
                now_weatherdata = weatherdata_str;
            else 
                now_weatherdata = weatherdata_str != "" ? JSON.parse(weatherdata_str) : {};
            
            drawWeatherToday(sp,0,0,now_weatherdata, data);
        });
   }else{
        drawWeatherToday(sp,0,0,now_weatherdata, data);
   }
    
        
}
var before_autoupdatemin = -1;
function C_checkAutoUpdate(){
    if(param_au == 1){ //자동업데이트일때 
        var date = new Date();
        var m = date.getMinutes();
       if(before_autoupdatemin == -1 || before_autoupdatemin != m)
       {
           before_autoupdatemin = m;
            checkAutoUpdate(function(message){
                if(message == 1){ //페이지 리로드 신호
                    console.log("업데이트신호 들어옴 !! 페이지 새로고침한다.");
                    location.reload();
                }            
            });
       }
   }
}

var before_airhour = -1;
var now_airdata = {};
function C_updateAir(sp, data){
   sp.removeAllChildren();
     
   var date = new Date();
   var h = date.getHours();
   if(before_airhour == -1 || before_airhour != h){
        before_airhour = h;
        getAirData(function(airdata_str){
            now_airdata =  airdata_str != "" ? JSON.parse(airdata_str) : {};
            if(now_airdata && now_airdata.response && now_airdata.response.body && now_airdata.response.body.items && now_airdata.response.body.items.length > 0){
                if(now_airdata.response && now_airdata.response.body.items[0]){
                    var item = now_airdata.response.body.items[0];
                    var pm10Value = item.pm10Value ? item.pm10Value : "";
                    var pm25Value = item.pm25Value ? item.pm25Value : "";
                    console.log("000 item is ",item);
                    global_dustInfo = getDustLevelInfo(pm10Value, pm25Value);


                    drawAirText(sp, 0, 0, data.mode, global_dustInfo);
//                    drawProgressArc(sp, 150, 5,  pm10Value, data.max, data.radius, data.fontcolor, data.fontsize, data.arclinewidth); 
                }
            }
        });
   }else {
       if(now_airdata && now_airdata.response && now_airdata.response.body && now_airdata.response.body.items && now_airdata.response.body.items.length > 0){
           if(now_airdata.response && now_airdata.response.body.items[0]){
                var item = now_airdata.response.body.items[0];
                var pm10Value = item.pm10Value ? item.pm10Value : null;
                var pm25Value = item.pm25Value ? item.pm25Value : null;
                console.log("111 item is ",item);
                global_dustInfo = getDustLevelInfo(pm10Value, pm25Value);

                drawAirText(sp, 0, 0, data.mode, global_dustInfo);
//                drawProgressArc(sp, 150, 5,  pm10Value, data.max, data.radius, data.fontcolor, data.fontsize, data.arclinewidth); 
           }
        }
   }
}
function C_setDataAnimaionType(self,size,sp, animationtype){
    switch(animationtype){
        case "showani":
            C_ShowAni(sp);
            break;
    }
}
function C_getResPath(str) {
    console.log("C_getResPath : str is "+str);
    const index = str.indexOf("res/");
    var path = index !== -1 ? str.substring(index) : "";
//    console.log("path is "+path);
    return path;
}
function AJAX_AdmGet(type,_data,success,error){
    console.log("AJAX_AdmGet type "+type+" _data ",_data);
   
    var senddata = {
        type :type,
        value : _data    
    };
    CallHandler("adm_get", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {
        if(error)error(err);
        console.log("err ",err);
    },true);
}
function AJAX_AdmGetGame(type,_data,success,error){
    
   
    var senddata = {
        type :type,
        value : _data    
    };
    CallHandler("adm_game", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {
        if(error)error(err);
        console.log("err ",err);
    },true);
}
function CallHandler(type, data, success, error) {

    var url = "";
    switch (type) {

        case "adm_get":
            url = '../../../../ssapi/adm_get.php';
            break;
         case "adm_game":
            url = '../../../../ssapi/adm_game.php';
            break;
        
    }
    

    

    if (type != "check_beacon_log" && typeof (isSession) == 'function') isSession();
    C_AsyncCall(url, data, function (res) {


//        C_HideLoadingProgress();
        if (success) success(res);

    }, function (err) {
//        C_HideLoadingProgress();
        if (error) error(err);

    });
}


function loadJSON(filePath, callback) {
    fetch(filePath)
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(data => {
            callback(null, data); // 성공 시 callback에 데이터 전달
        })
        .catch(error => {
            callback(error, null); // 실패 시 callback에 에러 전달
        });
}
function checkType(value) {
    if (typeof value === 'string') {
        return 'string';
    } else if (typeof value === 'number' && Number.isInteger(value)) {
        return 'int';
    } else if (typeof value === 'number') {
        return 'float';
    } else {
        return typeof value;
    }
}

//목록을 가져온다.
function C_getListData(list_name_id, pagenum, list_max, callback) {
      
    const _data = {
        "projectid": param_projectid,
        "groupidx": param_groupidx,
        "listnameid": list_name_id,
        "pagenum": pagenum,
        "listmax": list_max//
    };
    AJAX_AdmGetGame("getlistdata", _data, function (res) {
        console.log("getgallerydata res is ", res);
        const code = parseInt(res.code);
        if (code === 100) {
            callback(res.list);

        } else {
            console.log("데이터를 불러오지 못했습니다.");
        }
    });
}

//9:15 비율 계산하기
function getHeightFromAspectRatio(width, ratioWidth = 9, ratioHeight = 15) {
  return (width * ratioHeight) / ratioWidth;
}
function getFittedCanvasSize(screenWidth, screenHeight, baseWidth = 1080, baseHeight = 1920) {
  const screenRatio = screenWidth / screenHeight;
  const targetRatio = baseWidth / baseHeight;

  let canvasWidth, canvasHeight, scale;

  if (screenRatio > targetRatio) {
    // 화면이 더 넓음 → height 기준
    canvasHeight = screenHeight;
    canvasWidth = canvasHeight * targetRatio;
    scale = canvasHeight / baseHeight;
  } else {
    // 화면이 더 높음 또는 같음 → width 기준
    canvasWidth = screenWidth;
    canvasHeight = canvasWidth / targetRatio;
    scale = canvasWidth / baseWidth;
  }

  return {
    "w":canvasWidth,
    "h":canvasHeight,
    "s":scale
  };
}

function C_setFCMToken(fcmtoken){
    if(fcmtoken && param_au == 1 && param_projectid && param_groupidx){
        var _data = {
            "projectid":param_projectid,
            "groupidx":param_groupidx,
            "fcmtoken":fcmtoken            
        }
        AJAX_AdmGetGame("updatefcmtoken", _data, function (res) {
            console.log("updatefcmtoken res is ", res);
            const code = parseInt(res.code);
            if (code === 100) {
                console.log("토큰 업데이트 완료!");
            } else {
                console.log("토큰 업데이트 실패!");
            }
        });
    }
}
var home_data = {
    "tab":0,
    "sub":0    
};
var home_scene = 0; // SCENE_HOME

function setHomeScene(scene, data){
    home_scene = scene;
    home_data = data;
}

function gotoHomeScene(){
    C_nextScene(home_scene, home_data);
}
//최초 씬이 있는지 체크하여 해당 씬으로 바로 이동한다.
var is_first_load = true;
function checkFirstScene(contentdatas){
    
    var _data = null;
    for(var i = 0 ; i < contentdatas.length;i++){
        if(contentdatas[i].isfirstscene && contentdatas[i].isfirstscene == 1){
            
            
            const _tab = contentdatas[i].tab ? parseInt(contentdatas[i].tab) : 0;
            const _sub = contentdatas[i].sub ? parseInt(contentdatas[i].sub) : 0;
            _data = {
                "tab":_tab,
                "sub":_sub    
            };
            var scene = contentdatas[i].type == "lyrics" ? SCENE_LYRICS : SCENE_MENU;
            setHomeScene(scene, _data);
            if(is_first_load){
                is_first_load = false;
                gotoHomeScene();
            }
            break;
        }
    }
    return _data;
}
/**
 * 지정된 좌표(x, y)에 벽돌이 깨지는 듯한 파편 파티클 효과를 생성하고 실행합니다.
 * 이 파티클은 한 번 실행된 후 자동으로 사라집니다.
 * @param {cc.Node} parentNode - 파티클을 추가할 부모 노드 (예: this, this.layer 등)
 * @param {number} x - 파티클이 생성될 x 좌표
 * @param {number} y - 파티클이 생성될 y 좌표
 */
function C_PlayBrickBreakEffect(parentNode, x, y) {
    // 1. 파티클 시스템 객체 생성 (폭발 효과)
    var particle = new cc.ParticleExplosion();

    // 2. 파티클 속성 설정
    particle.setTexture(cc.textureCache.addImage("res/n_lyrics/block.png")); // 파편 텍스처 이미지
    particle.setPosition(x, y);

    // --- 파티클 세부 설정 (이 값을 조절하여 느낌을 바꿀 수 있습니다) ---
    particle.setDuration(0.7);             // 파티클 시스템 총 지속 시간
    particle.setLife(0.8);                 // 개별 파티클 생존 시간
    particle.setLifeVar(0.3);              // 생존 시간 변화량

    particle.setStartColor(cc.color(150, 150, 150, 255));   // 시작 색상 (갈색 계열)
    particle.setStartColorVar(cc.color(50, 20, 40, 0));   // 시작 색상 변화량
    particle.setEndColor(cc.color(150, 150, 150, 255));      // 종료 색상 (어두운 갈색)
    particle.setEndColorVar(cc.color(50, 20, 40, 0));     // 종료 색상 변화량

    var startSize = Math.random()*30+40;
    var endSize = Math.random()*20+2;
    particle.setStartSize(startSize);             // 시작 크기
    particle.setStartSizeVar(5);           // 시작 크기 변화량
    particle.setEndSize(endSize);              // 종료 크기
    particle.setEndSizeVar(1.0);           // 종료 크기 변화량

    particle.setEmissionRate(300);         // 초당 파티클 생성 개수
    particle.setTotalParticles(50);        // 최대 파티클 개수

    particle.setGravity(cc.p(0, -400));    // 중력 설정 (아래 방향으로 강하게)
    particle.setSpeed(250);                // 파티클 초기 속도
    particle.setSpeedVar(80);              // 속도 변화량
    particle.setAngle(90);                 // 발사 각도 (90도 = 위)
    particle.setAngleVar(360);             // 발사 각도 변화량 (360도 = 모든 방향)

    // 3. 자동 소멸 설정
    // 이 옵션을 true로 해야 파티클 효과가 끝났을 때 씬에서 자동으로 제거됩니다.
    particle.setAutoRemoveOnFinish(true);

    // 4. 부모 노드에 파티클 추가
    parentNode.addChild(particle, 10); // zIndex를 높게 주어 다른 스프라이트 위에 보이게 함
}

/**
 * 지정된 시작 위치(startX, y)에서 스크롤을 시작하고,
 * 화면을 완전히 벗어난 후 왼쪽 끝에서 나타나 무한히 반복 스크롤됩니다.
 * @param {cc.Sprite} sprite - 애니메이션을 적용할 스프라이트 객체
 * @param {number} startX - 최초 애니메이션을 시작할 x 좌표
 * @param {number} y - 스프라이트가 떠다닐 고정 높이 (y 좌표)
 * @param {number} duration - 화면을 한 번 가로지르는 기준 시간 (초)
 */
function C_StartScrollFrom(sprite, startX, y, duration) {
    // 1. 기본 변수 설정
    var winSize = cc.winSize;
    var spriteWidth = sprite.getContentSize().width;
    var buffer = 200; // 화면 밖 여유 공간

    // [수정됨] 화면 왼쪽 바깥(-200px)에서 나타나도록 설정
    var resetX = -spriteWidth / 2 - buffer;
    // [수정됨] 화면 오른쪽 바깥(+200px)으로 완전히 사라지도록 설정
    var endX = winSize.width + spriteWidth / 2 + buffer;

    // 최초 위치 설정 및 기존 액션 정지
    sprite.setPosition(startX, y);
    sprite.stopAllActions();

    // --- 액션 1: 최초 위치에서 오른쪽 끝까지 한 번만 이동 ---
    var firstMoveDistance = endX - startX;
    var totalDistance = endX - resetX;
    var firstDuration = (firstMoveDistance / totalDistance) * duration;
    
    var firstMoveAction = cc.moveTo(firstDuration, cc.p(endX, y));

    // --- 액션 2: 최초 이동이 끝난 후, 무한 반복을 시작시키는 콜백 액션 ---
    var startLoopingAction = cc.callFunc(function() {
        var loopMove = cc.moveTo(duration, cc.p(endX, y));
        
        var reset = cc.callFunc(function() {
            sprite.setPosition(resetX, y);
        });

        var loopSequence = cc.sequence(reset, loopMove); // 순서 변경: 리셋 후 이동
        var repeatForever = cc.repeatForever(loopSequence);
        
        sprite.runAction(repeatForever);
    });

    // --- 최종 실행: '액션 1'과 '액션 2'를 순서대로 실행 ---
    var finalSequence = cc.sequence(firstMoveAction, startLoopingAction);
    sprite.runAction(finalSequence);
}

// --- 사용 예시 ---
// var myCloud = new cc.Sprite("res/cloud.png");
// this.addChild(myCloud);
//
// C_StartScrollFrom(myCloud, 300, 500, 20.0);

/**
 * 스프라이트를 2초 동안 5배 크기로 확대하면서 동시에 투명하게 만들어 사라지게 하는 애니메이션을 실행합니다.
 * 애니메이션이 완료된 후에는 해당 스프라이트를 부모 노드에서 자동으로 제거합니다.
 *
 * @param {cc.Sprite} sp - 애니메이션을 적용할 스프라이트 객체입니다.
 */
function runScaleOutAnimation(sp) {
    if (!sp || !(sp instanceof cc.Sprite)) {
        cc.log("오류: 유효한 스프라이트 객체가 아닙니다.");
        return;
    }

    // 1. 2초 동안 5배로 커지는 액션 (ScaleTo)
    var scaleAction = cc.scaleTo(1.0, 5.0);

    // 2. 2초 동안 투명해지면서 사라지는 액션 (FadeOut)
    var fadeAction = cc.fadeOut(1.0);

    // 3. 두 액션을 동시에 실행하기 위해 Spawn으로 묶습니다.
    // Spawn은 내부에 있는 모든 액션을 병렬로(동시에) 실행합니다.
    var spawn = cc.spawn(scaleAction, fadeAction);

    // 4. 애니메이션이 끝난 후 스스로를 제거하는 액션
    var removeAction = cc.removeSelf(true);

    // 5. Spawn 액션이 끝난 후 removeAction을 순차적으로 실행하기 위해 Sequence로 묶습니다.
    var seq = cc.sequence(spawn, removeAction);

    // 6. 대상 스프라이트(sp)에서 최종적으로 만들어진 시퀀스 액션을 실행합니다.
    sp.runAction(seq);
}

// --- 사용 예시 ---
/*
    // somewhere in your layer or scene
    var mySprite = new cc.Sprite("res/my_character.png");
    mySprite.setPosition(cc.winSize.width / 2, cc.winSize.height / 2);
    this.addChild(mySprite);

    // 3초 후에 mySprite에 애니메이션을 실행하는 예시
    this.scheduleOnce(function() {
        runScaleOutAnimation(mySprite);
    }, 3);
*/
function removeSubSprite(sp){
    var children = sp.getChildren();
    var childrenToRemove = [];

    // 제거할 스프라이트만 새로운 배열에 추가합니다.
    for (var i = 0; i < children.length; i++) {
        var child = children[i];
        // 자식 노드가 cc.Sprite의 인스턴스인지 확인합니다.
        if (child instanceof cc.Sprite) {
            childrenToRemove.push(child);
        }
    }

    // 위에서 찾은 스프라이트들을 실제로 제거합니다.
    for (var i = 0; i < childrenToRemove.length; i++) {
        sp.removeChild(childrenToRemove[i]);
    }
}
function C_replaceAll(str, search, replacement) {
    if (!str || !search) return str;

    let result = "";
    let start = 0;
    let index;

    while ((index = str.indexOf(search, start)) !== -1) {
        result += str.substring(start, index) + replacement;
        start = index + search.length;
    }
    result += str.substring(start);

    return result;
}


/////////////////////////////////////////
//교가 랭킹 입력팝업  START
/////////////////////////////////////////
var rankingData = {};
 //랭킹세팅
function loadRanking(callback){
    
    var _data = {
        "projectid":param_projectid,
        "groupidx":param_groupidx
    };
    AJAX_AdmGetGame("getranking", _data, function (res) {
        console.log("getgallerydata res is ", res);
        const code = parseInt(res.code);
        if (code === 100) {

            rankingData = res.message && res.message.length > 5 ? JSON.parse(res.message) : {};

            if(!rankingData.lyrics)
                rankingData.lyrics = [];
            callback(rankingData.lyrics);

        }else {
             if(!rankingData.lyrics)
                rankingData.lyrics = [];
            callback(rankingData.lyrics);
        }
    });
}
function saveRanking(nickname, score, rank, callback){
    var new_rank = [];
    var brank = rankingData.lyrics;
    brank.push({"nickname":nickname,"score":score});
    // score 기준으로 오름차순 정렬
    brank.sort((a, b) => a.score - b.score);

    // 상위 3개만 유지 (필요한 경우)
    if (brank.length > 3) {
        brank = brank.slice(0, 3);
    }
    // 다시 rankingData 에 반영
    rankingData.lyrics = brank;


    var _data = {
        "projectid":param_projectid,
        "groupidx":param_groupidx,
        "ranking":rankingData
    };
    if(rank >= 0 && rank < 3)
    AJAX_AdmGetGame("setranking", _data, function (res) {
        console.log("getgallerydata res is ", res);
        const code = parseInt(res.code);
        if (code === 100) {
            callback();
           
        } 
    });
}                    
//function updateRankingUI(){
//    var div_ranking = document.getElementById("div_ranking");
//    var lbl_rank1 = document.getElementById("lbl_rank1");
//    var lbl_rank2 = document.getElementById("lbl_rank2");
//    var lbl_rank3 = document.getElementById("lbl_rank3");
//
//    console.log("updateRankingUI ",rankingData.lyrics);
//    for(var i = 0 ; i < rankingData.lyrics.length;i++){
//        if(i==0){
//            lbl_rank1.innerHTML = rankingData.lyrics[i]["nickname"]+"<br><span style='color:blue;font-weight:400'>"+rankingData.lyrics[i]["score"]+"초</span>";
//        }else if(i==1){
//            lbl_rank2.innerHTML = rankingData.lyrics[i]["nickname"]+"<br><span style='color:blue;font-weight:400'>"+rankingData.lyrics[i]["score"]+"초</span>";
//        }else 
//            lbl_rank3.innerHTML = rankingData.lyrics[i]["nickname"]+"<br><span style='color:blue;font-weight:400'>"+rankingData.lyrics[i]["score"]+"초</span>";
//    }
//}
function showInputRankingPopup(score, rank) {
    const popup = document.getElementById('ranking-popup');
    const input = document.getElementById('nickname-input');
    var txt_ranking = document.getElementById("txt_ranking");
    input.value = '';

    popup.style.display = 'block';
    txt_ranking.innerHTML = "순위 : "+(rank+1)+"등<br>축하합니다. 랭킹에 등록되었습니다. 닉네임을 입력해 주세요";

    // 저장 이벤트를 위한 전역 상태 저장
    window._pendingRanking = { score, rank };
}


function submitNickname() {
    const input = document.getElementById('nickname-input');
    const nickname = input.value;
    if (!nickname) return;

    const popup = document.getElementById('ranking-popup');
    popup.style.display = 'none';

    if (window._pendingRanking) {
        const { score, rank } = window._pendingRanking;
        saveRanking(nickname, score, rank,function(res){
            C_nextScene(SCENE_LYRICS);
        });
        window._pendingRanking = null;
    }
}
function closeNickname() {

    const popup = document.getElementById('ranking-popup');
    popup.style.display = 'none';
    C_nextScene(SCENE_LYRICS);
}

function updateRankingData(time) {
    var rank = -1;
    console.log("time is "+time);
    
    if(!rankingData.lyrics)return 0;
    
    for (let i = 0; i < rankingData.lyrics.length; i++) {
        if (time <= rankingData.lyrics[i].score) {
            rank = i;
            break;
        }
    }
    

    if (rankingData.lyrics.length < 3) {
        if (rank === -1) {
            rank = rankingData.lyrics.length;
        }
    } else if (rank === -1 || rank >= 3) {
        // 3등 안에 못 들어감
        rank = -1;
    }

    
    console.log("ranking is "+rank);
    return rank;
}
function C_addClickListener(node, callback) {
    // === 터치 이벤트 ===
    cc.eventManager.addListener({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true,
        onTouchBegan: function (touch, event) {
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(touch.getLocation());
            var size = target.getContentSize();
            var rect = cc.rect(0, 0, size.width, size.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                if (callback) callback(target, "touch");
                return true;
            }
            return false;
        }
    }, node);

    // === 마우스 이벤트 ===
    cc.eventManager.addListener({
        event: cc.EventListener.MOUSE,
        onMouseDown: function (event) {
            var target = event.getCurrentTarget();
            var locationInNode = target.convertToNodeSpace(event.getLocation());
            var size = target.getContentSize();
            var rect = cc.rect(0, 0, size.width, size.height);

            if (cc.rectContainsPoint(rect, locationInNode)) {
                if (callback) callback(target, "mouse");
            }
        }
    }, node);
}
/////////////////////////////////////////
//교가 랭킹 입력팝업  END
/////////////////////////////////////////


/////////////////////////////////////////
//음성입력 STT START
/////////////////////////////////////////

/////////////////////////////////////////
//음성입력 STT END
/////////////////////////////////////////



//줄바꿈
function C_insertNewlines(text, maxLen) {
    let result = "";
    for (let i = 0; i < text.length; i += maxLen) {
        result += text.substr(i, maxLen);
        if (i + maxLen < text.length) result += "\n";
    }
    return result;
}

function sendLanguageCode (new_code){
    var _data = {
        "projectid":param_projectid,
        "groupidx":param_groupidx,
        "languagecode":new_code            
    }

    AJAX_AdmGetGame("changelanguage", _data, function(res){
        console.log("MenuScene 11 이미지로드했다. is ",res);
       code = parseInt(res.code);
       if (code == 100) {
            location.reload();

       }
    });
}
function C_Loading(self,color,delaytime){
    var _delaytime = delaytime ? delaytime : 300;
    C_ShowLoadingProgress(self,color);
    setTimeout(function(){
        C_HideLoadingProgress(self);
    },_delaytime);
}