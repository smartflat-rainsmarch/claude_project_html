var language_dialog = {
    btn_cancel : 1,
    btn_ok : 2,
    language0:10,
    language1:11,
    language2:12,
    language3:13,
    language4:14,
    
}
var SelectLanguageDialogLayer = cc.Layer.extend({
    sprite:null,
    m_muSound : null,
    m_muExitItem : null,
    btn_sndon:null,
    btn_sndoff:null,
    pback:null,
    select_idx : 0,
    sp_select:null,
    objY:270,
    ctor:function () {
        this._super();
        var self = this;
        var size = cc.winSize;
        
        
         ////////////////////////////////////////////////////////////
        // 하위 터치 이벤트 막기 START
        ////////////////////////////////////////////////////////////
        var touchBlocker = new cc.LayerColor(cc.color(0, 0, 0, 0), size.width, size.height);
        touchBlocker.setAnchorPoint(0, 0);
        touchBlocker.setPosition(0, 0);

        // 터치 이벤트 먹는 리스너 등록
        var listener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true, // 여기서 하단으로 전달을 막음
            onTouchBegan: function (touch, event) {
                return true; // true를 리턴해야 swallow가 작동됨
            }
        });
        cc.eventManager.addListener(listener, touchBlocker);

        this.addChild(touchBlocker, 0); // 팝업 내용보다 아래지만, 기존 UI 위에
        ////////////////////////////////////////////////////////////
        // 하위 터치 이벤트 막기 END
        ////////////////////////////////////////////////////////////
        
        
        
        
        IS_SHOW_POPUP = true;

       
        
        
//        C_DrawBackColor(self);
        C_AddCustomFont(self,"",size.width/2,525,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255));
        C_AddCustomFont(self,"",size.width/2,25,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255),true);
        
        
    
        
    },
    init:function(title,message, OKCallback , CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        
        ////////////////////////////////////////////////////////////
        // 하위 터치 이벤트 막기 START
        ////////////////////////////////////////////////////////////
        var touchBlocker = new cc.LayerColor(cc.color(0, 0, 0, 0), size.width, size.height);
        touchBlocker.setAnchorPoint(0, 0);
        touchBlocker.setPosition(0, 0);

        // 터치 이벤트 먹는 리스너 등록
        var listener = cc.EventListener.create({
            event: cc.EventListener.TOUCH_ONE_BY_ONE,
            swallowTouches: true, // 여기서 하단으로 전달을 막음
            onTouchBegan: function (touch, event) {
                return true; // true를 리턴해야 swallow가 작동됨
            }
        });
        cc.eventManager.addListener(listener, touchBlocker);

        this.addChild(touchBlocker, 0); // 팝업 내용보다 아래지만, 기존 UI 위에
        ////////////////////////////////////////////////////////////
        // 하위 터치 이벤트 막기 END
        ////////////////////////////////////////////////////////////
        
        
        
        
        self.select_idx = self.getLanguageIdx(message);
        var bgLayer = new cc.LayerColor(cc.color(32, 32, 32, 180));
        self.addChild(bgLayer, 0);
        //background not click 
        self.addChild(C_PopupBack(self));


        
        self._bg = new cc.Scale9Sprite (res._global_img_ninepatch_white_bg);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2;
        self._bg.width = style && style.width ? style.width : 900;
        self._bg.height = style && style.height ? style.height : 541;
//        self._bg.width = 1032;
//        self._bg.height = 616;
        this.addChild (self._bg);
//        self._bg = C_AddSprite(this,"res/n_home/lll.png",size.width / 2,size.height/2,null,null);
//        self._bg.width = 900;
//        self._bg.height = 841;
//        var bg_width = self._bg.width;
//        var bg_height = self._bg.height;
//         var bg_width = 900;
//        var bg_height = 841;
        
        
//        self._bg = cc.Sprite.create(res.pop_back);
//        self._bg.setPosition(360,600);
//        this.addChild (self._bg);
        
        var okres = style && style.okres ? style.okres : res.btn_ok;
        var cancelres = style && style.cancelres ? style.cancelres : res.btn_cancel;
        
        if(OKCallback && CancelCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2+140,100,language_dialog.btn_ok,1,null,function(tag){self.buttonClick(tag);OKCallback(self.getLanguageCode());self._remove();},self);
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2-230,100,language_dialog.btn_cancel,1,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }else if(OKCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2,70,language_dialog.btn_ok,1,null,function(tag){self.buttonClick(tag);OKCallback(self.getLanguageCode());self._remove();},self);
        }else if(CancelCallback){
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2,70,language_dialog.btn_cancel,1,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }
        
        var title_anchor = style && style.title && style.title.anchor != undefined ? style.title.anchor : cc.TEXT_ALIGNMENT_CENTER;
        var title_fontsize = style && style.title && style.title.fontsize ? style.title.fontsize : 50;
//        var message_anchor = style && message.title && style.message.anchor != undefined ? style.message.anchor : cc.TEXT_ALIGNMENT_CENTER;
//        var message_fontsize = style && style.message && style.message.fontsize ? style.message.fontsize : 30;
        
        
        var pos = [
            {"x":self._bg.width/2-240,"y":self.objY},
            {"x":self._bg.width/2,"y":self.objY},
            {"x":self._bg.width/2+240,"y":self.objY}
         ]
        C_AddAnimButton(self._bg,res.n_home_language0,null,self._bg.width/2-240,self.objY,language_dialog.language0,1,null,function(tag){
            self.select_idx = 0;            
            self.moveSelect();
        },self);
        C_AddAnimButton(self._bg,res.n_home_language1,null,self._bg.width/2,self.objY,language_dialog.language1,1,null,function(tag){
            self.select_idx = 1;
            self.moveSelect();
        },self);
        C_AddAnimButton(self._bg,res.n_home_language2,null,self._bg.width/2+240,self.objY,language_dialog.language2,1,null,function(tag){
            self.select_idx = 2;
            self.moveSelect();
        },self);
       
        
        self.sp_select = C_AddAnimButton(self._bg,res.n_home_language_select,null,pos[self.select_idx].x,pos[self.select_idx].y,language_dialog.language1,1,null,function(tag){},self);
        
        
        //title Text
        C_AddCustomFontNew(self._bg, title, self._bg.width/2,self._bg.height-105,1,1,title_anchor,title_fontsize,cc.color(0,0,0),true);
//        var title = cc.LabelTTF.create(title, "Lato", 30);
//        title.setPosition(self._bg.width/2, self._bg.height-100);
//        self._bg.addChild(title);
        
        //message Texxt
//        C_AddCustomFontNew(self._bg, message, self._bg.width/2, self._bg.height/2,1,1,message_anchor,message_fontsize,cc.color(255,255,255));
//        var message = cc.LabelTTF.create(message, "Arial", 25);
//        message.setPosition(self._bg.width/2, self._bg.height/2);
//        self._bg.addChild(message);
        
        C_ShowAni(self._bg);
    },
    getLanguageCode:function(){
         var self = this;
         var language_code = ["KO","EN","ZH"];
         return language_code[self.select_idx];
    },
    getLanguageIdx:function(code){
        var language_code = ["KO","EN","ZH"];
        var idx = 0;
        for(var i = 0; i < language_code.length; i++){
            if(code == language_code[i]){
                idx = i;
                break;
            }
        }
        return idx;
    },
    moveSelect:function(){
        var self = this;
        var pos = [
            {"x":self._bg.width/2-240,"y":self.objY},
            {"x":self._bg.width/2,"y":self.objY},
            {"x":self._bg.width/2+240,"y":self.objY}
           
        ];
        var move = cc.moveTo(0.2,pos[self.select_idx].x,pos[self.select_idx].y);
        self.sp_select.runAction(move);
    },
    buttonClick:function(tag){
        var self = this;
        //console.log("buttonClick!! ",tag);
         C_PlaySound(SOUND.CASH);
//        switch(tag){
//            case language_dialog.btn_ok:
//                self._OKCallback();
//                self._remove();
//                break;
//            case language_dialog.btn_cancel:
//                self._CancelCallback();
//                self._remove();
//                break;
//        }  
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


