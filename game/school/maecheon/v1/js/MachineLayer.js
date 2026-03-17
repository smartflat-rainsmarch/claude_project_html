
var MachineLayer = cc.Layer.extend({
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
        
        IS_SHOW_POPUP = true;

       
        
        
//        C_DrawBackColor(self);
//        C_AddCustomFont(self,"",size.width/2,25,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255));
//        C_AddCustomFont(self,"",size.width/2,25,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255),true);
        
        
       
        
    },
    init:function(img_res, title, message, OKCallback){
        var self = this;
        var size = cc.winSize;
        
         var bgLayer = new cc.LayerColor(cc.color(32, 32, 32, 100));
        self.addChild(bgLayer, 0);
        //background not click 
        self.addChild(C_PopupBack(self));


        
        self._bg = new cc.Scale9Sprite (res._global_img_ninepatch_bg);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2;
        self._bg.width = 620;
        self._bg.height = 630;
        this.addChild (self._bg);
        var bg_width = self._bg.width;
        var bg_height = self._bg.height;
         C_AddSprite(self._bg,img_res,self._bg.width / 2,self._bg.height/2+60,1,null,null);
        C_AddAnimButton(self._bg,res.btn_ok,null,self._bg.width/2,70,tag_dialog.btn_ok,0.7,null,function(tag){OKCallback();self._remove();},self);
        
        //title Text
        C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,cc.color(255,255,255));
        //message Texxt
        C_AddCustomFont(self._bg, message, self._bg.width/2, self._bg.height/2-150,1,1,cc.TEXT_ALIGNMENT_CENTER,24,cc.color(255,255,255));
        C_ShowAni(self._bg);
    },
   
    _remove:function(){      
        var self = this;
        IS_SHOW_POPUP = false; 
        cc.log(this.getParent());//This Works fine   <--------------- ?
        var p = this.getParent();
        C_HideAni(self._bg,function(){
            self.runAction(cc.RemoveSelf.create());
        });
    }
   
});


