var tag_imagedialog = {
    
    btn_cancel : 1,
    btn_ok : 2
}
var ImageDialogLayer = cc.Layer.extend({
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
    

    init:function(title,message, imgres, OKCallback , CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        
        console.log(" title "+title+" message "+message+" imgres "+imgres);
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
        self._bg.y =  size.height/2+150;
        self._bg.width = 900;
        self._bg.height = 1300;
        this.addChild (self._bg);
        var bg_width = self._bg.width;
        var bg_height = self._bg.height;
        

        var okres = style ? style.okres : res.btn_ok;
        var cancelres = style ? style.cancelres : res.btn_cancel;
        
        if(OKCallback && CancelCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2-120,70,tag_imagedialog.btn_ok,0.7,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2+120,70,tag_imagedialog.btn_cancel,0.7,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }else if(OKCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2,70,tag_imagedialog.btn_ok,0.7,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
        }else if(CancelCallback){
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2,70,tag_imagedialog.btn_cancel,0.7,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }
        
        
        var img = new Image();
        img.onload = function () {
            // ✅ 로드 성공
            console.log("정상적으로 이미지 로드됨: ", imgres);
            C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,cc.color(255,255,255),true);
            // 이제 cocos sprite로 사용
            var sp = C_AddSpriteImageResize(self._bg, imgres, self._bg.width/2, self._bg.height-560, null,1,null,840); //img
            C_AddCustomFont(self._bg, message, 50, self._bg.height-1090 ,1,1,cc.TEXT_ALIGNMENT_LEFT,30,cc.color(255,255,255),true);
        };
        img.onerror = function () {
            // ❌ 로드 실패
            console.log("이미지 로드 실패: ", imgres);
            self._bg.height = 600;
            C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,cc.color(255,255,255),true);
            C_AddCustomFont(self._bg, message, 50, self._bg.height/2,1,1,cc.TEXT_ALIGNMENT_LEFT,30,cc.color(255,255,255),true);    
        };
        img.src = imgres;
        
        
      
        C_ShowAni(self._bg);
    },
    buttonClick:function(tag){
        var self = this;
        //console.log("buttonClick!! ",tag);
//         C_PlaySound(SOUND.CASH);
        C_PlaySound(SOUND.SND_BUTTONTOUCH);

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


