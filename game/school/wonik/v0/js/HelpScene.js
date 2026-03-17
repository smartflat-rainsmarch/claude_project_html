var HELP_Layer = cc.Layer.extend({
    
    sprite:null,
    _plists :[],
    _scheight : 2136,
    ctor:function () {
        //////////////////////////////
        // 1. super init first
        this._super();
        
        var self = this;
        var size = cc.winSize;
        
        //background Image 
//        this.sprite = new cc.Sprite(res.help_back_png);
//        this.sprite.attr({
//            x: size.width / 2,
//            y: size.height / 2
//        });
//        this.addChild(this.sprite, 0);
//        
        
       
        return true;
    }
  
  
});


var HelpScene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new HELP_Layer();
        this.addChild(layer);
    }
});