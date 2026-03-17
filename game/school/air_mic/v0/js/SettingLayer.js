var tag_setting = {
    cancel : 1
}
var SettingLayer = cc.Layer.extend({
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

        C_DrawBackColor(self);
        C_AddCustomFont(self,"",size.width/2,25,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255));
        C_AddCustomFont(self,"",size.width/2,25,1,1,cc.TEXT_ALIGNMENT_CENTER,18,cc.color(255,255,255),true);
        
        self.addChild(C_PopupBack(self));
    
//        self.pback = cc.Sprite.create(res.pop_back);
//        self.pback.setPosition(360,600);
//        this.addChild (self.pback);
        

       
        
//         var btn_cancel = C_AddAnimButton(self.pback,res.button_x,null,self.pback.width/2,70,tag_setting.cancel,null,null,function(tag){self.buttonClick(tag);},self);
           
          
        
        var version = cc.LabelTTF.create("운동하기전에 런닝머신을 10분 뛰세요", "Arial", 17);
        version.setPosition(self.pback.width/2, self.pback.height/2);
        self.pback.addChild(version);
        
        C_ShowAni(self.pback);
    },
    buttonClick:function(tag){
        var self = this;
        //console.log("buttonClick!! ",tag);
         C_PlaySound(SOUND.SND_BUTTONTOUCH);
        switch(tag){
            case tag_setting.cancel:
                self._remove();
                break;
        }  
    },
    
    _remove:function(){      
        var self = this;
        IS_SHOW_POPUP = false; 
        cc.log(this.getParent());//This Works fine   <--------------- ?
        var p = this.getParent();
        C_HideAni(self.pback,function(){
           self.runAction(cc.RemoveSelf.create());
        })
        
     
    }
   
});


