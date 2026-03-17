var NButton = cc.Node.extend({
    button:null,
    _callback:null,
    _tag:undefined,
    effect:null,
    ctor:function (res_off, res_on, tag, callback) {
        this._super();
        var self = this;
        var timestamp = new Date().getTime();

        // 기존 텍스처 제거
        cc.textureCache.removeTextureForKey(res_off);
        cc.textureCache.removeTextureForKey(res_on);

        // 쿼리스트링 추가 (캐시 무효화)
        var res_off_url = res_off + "?v=" + timestamp;
        var res_on_url = res_on + "?v=" + timestamp;

        self._callback = callback;
        self._tag = tag;

        self.button = new ccui.Button();
        self.button.loadTextures(res_off_url, res_on_url);
        self.button.addTouchEventListener(this.touchEvent, this);
        this.addChild(self.button);

        return true;
    },
//    initEffect:function(parent,res){
//        var self = this;
//        self.effect = cc.Sprite.create(res);
//        self.effect.setVisible(false);
//        parent.addChild(self.effect);
//    },
    showEffect:function(){
        var self = this;
        self.effect.setOpacity(150);
        self.effect.setScale(1);
        self.effect.setVisible(true);
        
        var zoomout = cc.scaleTo(0.25,1.8,1.8);
        var fadeout = cc.fadeOut(0.25);
        var func = cc.callFunc(function(){self.effect.setVisible(false);});
        var spawn = cc.spawn(zoomout,fadeout); 
        var seq = cc.Sequence.create(spawn, func);
        self.effect.runAction(seq);
      
    },
    touchEvent:function(sender, type){
        var self = this;
        switch(type){
                
            case ccui.Widget.TOUCH_BEGAN:
//                console.log("Touch Down ");
                
                
                var zoomout = cc.scaleTo(0.1,0.9,0.9);
                self.button.runAction(zoomout);
//                self.showEffect();
                break;
            case ccui.Widget.TOUCH_MOVED:
//                console.log("Touch TOUCH_MOVED");
//                console.log("Touch TOUCH_MOVED",sender);
//                console.log("Touch TOUCH_MOVED",type);
                break;
            case ccui.Widget.TOUCH_ENDED:
                
                var zoomin = cc.scaleTo(0.1,1);
                var func = cc.callFunc(function(){ self._callback(self._tag);});
                var seq = cc.Sequence.create(zoomin, func);
                self.button.runAction(seq);
                
                
                
                break;
            case ccui.Widget.TOUCH_CANCELLED:
//                console.log("Touch TOUCH_CANCELLED");
                break;
            default:
                 var zoomin = cc.scaleTo(0.1,1);
                self.button.runAction(zoomin);
//                console.log("Touch default");
                break;
                
        }
    }
});