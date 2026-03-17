var tag_dialog = {
    
    btn_cancel : 1,
    btn_ok : 2
}
var DialogLayer = cc.Layer.extend({
    sprite:null,
    m_muSound : null,
    m_muExitItem : null,
    btn_sndon:null,
    btn_sndoff:null,
    pback:null,
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
        C_AddCustomFont(self,"",size.width/2,25,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255));
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
        
        
        
        
        
        var bgLayer = new cc.LayerColor(cc.color(32, 32, 32, 180));
        self.addChild(bgLayer, 0);
        //background not click 
        self.addChild(C_PopupBack(self));


        
        self._bg = new cc.Scale9Sprite (res._global_img_ninepatch_bg);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2;
        self._bg.width = style && style.width ? style.width : 1032;
        self._bg.height = style && style.height ? style.height : 616;
//        self._bg.width = 1032;
//        self._bg.height = 616;
        this.addChild (self._bg);
        var bg_width = self._bg.width;
        var bg_height = self._bg.height;
        
//        self._bg = cc.Sprite.create(res.pop_back);
//        self._bg.setPosition(360,600);
//        this.addChild (self._bg);
        
        var okres = style && style.okres ? style.okres : res.btn_ok;
        var cancelres = style && style.cancelres ? style.cancelres : res.btn_cancel;
        
        if(OKCallback && CancelCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2-120,70,tag_dialog.btn_ok,0.7,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2+120,70,tag_dialog.btn_cancel,0.7,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }else if(OKCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2,70,tag_dialog.btn_ok,0.7,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
        }else if(CancelCallback){
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2,70,tag_dialog.btn_cancel,0.7,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }
        
        var title_anchor = style && style.title && style.title.anchor != undefined ? style.title.anchor : cc.TEXT_ALIGNMENT_CENTER;
        var title_fontsize = style && style.title && style.title.fontsize ? style.title.fontsize : 40;
        var message_anchor = style && message.title && style.message.anchor != undefined ? style.message.anchor : cc.TEXT_ALIGNMENT_CENTER;
        var message_fontsize = style && style.message && style.message.fontsize ? style.message.fontsize : 30;
        //title Text
        C_AddCustomFontNew(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,title_anchor,title_fontsize,cc.color(255,255,255),true);
//        var title = cc.LabelTTF.create(title, "Lato", 30);
//        title.setPosition(self._bg.width/2, self._bg.height-100);
//        self._bg.addChild(title);
        
        //message Texxt
        C_AddCustomFontNew(self._bg, message, self._bg.width/2, self._bg.height/2,1,1,message_anchor,message_fontsize,cc.color(255,255,255));
//        var message = cc.LabelTTF.create(message, "Arial", 25);
//        message.setPosition(self._bg.width/2, self._bg.height/2);
//        self._bg.addChild(message);
        
        C_ShowAni(self._bg);
    },
    buttonClick:function(tag){
        var self = this;
        //console.log("buttonClick!! ",tag);
         C_PlaySound(SOUND.CASH);
//        switch(tag){
//            case tag_dialog.btn_ok:
//                self._OKCallback();
//                self._remove();
//                break;
//            case tag_dialog.btn_cancel:
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


