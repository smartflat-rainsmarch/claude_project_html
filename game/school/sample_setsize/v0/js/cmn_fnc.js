function C_nextScene(state,data){
    var sc;
    //var res;
    if(sc != null) sc = null;

    switch(state){
        case SCENE_HOME:

            sc = new LogoScene(data);
            //res = menu_resources;
            break;
        case SCENE_MENU:

            sc = new MenuScene(data);
            //res = menu_resources;
            break;
        case SCENE_GAME:
            sc = new GameScene(data);
            //res = menu_resources;
            break;
        case SCENE_HELP:
            sc = new HelpScene(data);
            //res = menu_resources;
            break;

    }
    sc.setTag(state);
    cc.director.runScene(sc);
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
function C_PlaySound(id,isloop){
    //console.log("C_PlaySound "+MYINFO.ISSOUND);
    
//    if(MYINFO.ISSOUND)
//        ion.sound.play(id); 
    
//    console.log("id is ",id);
    if(isloop) 
        cc.audioEngine.playMusic("res/sound/"+id+".mp3", true);
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
        var move2 = cc.moveBy(time/2,0,-gab);
        var seq1 = cc.sequence(move1,move2);
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

function C_AddCustomFont(parent,str,x,y,tag,scale,anchor,fontsize,color,isboldfont){

    var label = null;
    if(isboldfont != undefined && isboldfont){
        label = cc.LabelTTF.create(str, "LatoBold", fontsize);
    }
    else{
        label = cc.LabelTTF.create(str, "Lato", fontsize);
    }
    label.setPosition(x,y);
    
    if(anchor != null)label.setAnchorPoint(cc.p(anchor/2,0.5));
    if(scale != null)label.setScale(scale);
    if(color != null)label.setColor(color);
    parent.addChild(label);
    return label;
    
    
    
//    var label = null;
//
//    label = cc.LabelTTF.create(str, "NoricanRegular" ,fontsize);   
//    label.setPosition(x,y);
//    
//    if(anchor != null)label.setAnchorPoint(cc.p(anchor/2,0.5));
//    if(scale != null)label.setScale(scale);
//    if(tag != null)label.setTag(tag);
//    if(color != null)label.setColor(color);
//    parent.addChild(label);
//    return label;
    
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
function C_AddSprite(parent, res, x, y, tag, scale, zindex) {
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
function C_ShowLoadingProgress(self){

    var winSize = cc.director.getWinSize();
    var loadingLayer = self.getChildByTag(1555);
    if(loadingLayer != undefined && loadingLayer != null)
        loadingLayer.setVisible(true);
    else{
        var loadingLayer = new cc.LayerColor(cc.color(11, 11, 11, 200));
        loadingLayer.setTag(1555);
        loadingLayer.setContentSize(WINSIZE_WIDTH,WINSIZE_HEIGHT);
        loadingLayer.addChild(C_PopupBack(self));
        var loading = new cc.Sprite(res.loading_png);
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


function C_ShowDialogLayer(self, title , message, OKCallback , CancelCallback,style){
    var layer = new DialogLayer();
    layer.setTag(ID.POPUP_LAYER_DIALOG);
    self.addChild(layer, 2222);
    layer.init(title,message,OKCallback, CancelCallback,style);
    

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
function C_spriteAnimation(parent, x,y,res_arr,speed,scale){
    var ani = cc.Animation.create();   // create the animation

    var sprite = cc.Sprite.create(res_arr[0]);  // create the object
    sprite.setPosition(x,y);   // set position
    parent.addChild(sprite);    // add it to the layer or scene
    sprite.setScale(scale);

    for(var i = 0 ; i < res_arr.length; i++) 
        ani.addSpriteFrameWithFile(res_arr[i]);   // add frame 0
//        ani.addSpriteFrameWithFileName(magic12);  // add frame 1
    ani.setDelayPerUnit(speed);   // set the delay time, in seconds
    ani.setLoops(100000);  // repeat the animation 5 times,
    var action = cc.Animate.create(ani);   

    sprite.runAction(action);
    return sprite;
}

function C_setUI(self,size,data){
    var sp = null;
    var ani_sps = [];
    
    var scale = data.scale ? data.scale : 1;
    switch(data.type){
        case "img":
            sp = C_AddSprite(self,C_getResPath(data.imgurl), data.x, C_getY(data.y),1,scale,null);
            break;
        case "button":
           
            var clickurl = data.clickurl ? C_getResPath(data.clickurl) : C_getResPath(data.imgurl);
            sp = C_AddAnimButton(self, C_getResPath(data.imgurl), clickurl,  parseInt(data.x), C_getY(parseInt(data.y)), data.id, scale, null, function (tag) {
                self.buttonClick(tag);
            }, self);
            
            break;
        case "animation":
            for(var i = 0 ; i < data.imgurls.length;i++){
                ani_sps.push(C_AddSprite(self,C_getResPath(data.imgurls[i]), data.x, C_getY(data.y),1,scale,null));
            }
            return ani_sps;
            break;
        case "bgcolor":
            sp = self.addChild(new cc.LayerColor.create(cc.color(data.color)));
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
function C_setDataAnimaionType(self,size,sp, animationtype){
    switch(animationtype){
        case "showani":
            C_ShowAni(sp);
            break;
    }
}
function C_getResPath(str) {
    const index = str.indexOf("res/");
    var path = index !== -1 ? str.substring(index) : "";
//    console.log("path is "+path);
    return path;
}
function AJAX_AdmGet(type,_data,success,error){
    
   
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
function CallHandler(type, data, success, error) {

    var url = "";
    switch (type) {

        case "adm_get":
            url = '../../../../ssapi/adm_get.php';
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
//최초 씬이 있는지 체크하여 해당 씬으로 바로 이동한다.
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
            C_nextScene(SCENE_MENU, _data);
            break;
        }
    }
    return _data;
}

