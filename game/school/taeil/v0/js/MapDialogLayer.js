var tag_dialog = {
    btn_x : 0,
    f1 :1,
    f2 :2,
    f3 :3,
    f4 :4,
    f5 :5,    
    f5 :6,    
    btn_cancel : 11,
    btn_ok : 12
    
}
var MapDialogLayer = cc.Layer.extend({
    sprite:null,
    m_muSound : null,
    m_muExitItem : null,
    btn_sndon:null,
    btn_sndoff:null,
    pback:null,
    zoomSlider:null,
    _bg : null,
    weight_speed:1, 
    
    mapViewLayer: null,
    mapSprite: null,
    touchListener: null,
    okCallback : null,
    floor:1,
    mapdatas : null,
    floor_btns : [],
    now_floordata : null,
    all_btns : [],
    search_floor : -1,
    search_text : "",
    search_sps : [],
    ctor:function () {
        this._super();
        var self = this;
        var size = cc.winSize;
        self.floor_btns = [];
        return true;
        
    },
    init:function(title,message, mapdatas, OKCallback , CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        self.mapdatas  = mapdatas;
        
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

        console.log("title", title);
        console.log("mapdatas", mapdatas);

        
        self._bg = new cc.Scale9Sprite (res.empty);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2-140;
        self._bg.width = 1080;
        self._bg.height = 1920;
        this.addChild (self._bg);
        

        
        self.initMap(self._bg, self.floor);
//        self.initWeightSpeed(self._bg);
        
        self.okCallback = OKCallback;
        
        //X 버튼
//        C_AddAnimButton(self._bg, "res/n_menu/home.png" ,null, 130,C_getY(90),tag_dialog.btn_x,1,null,function(tag){
//           C_PlaySound(SOUND.SND_BUTTONTOUCH);
//            C_nextScene(SCENE_HOME,{"tab":0,"sub":0});
//        },self);
        
         
         //line 
//        C_AddSprite(self._bg, res.n_menu_line, size.width / 2-25, C_getY(432),1,null,null);
        
        //층별안내 버튼        
        C_AddAnimButton(self._bg, "res/btn_1f.png" ,null, 150,C_getY(280),tag_dialog.f1,1,null,function(tag){
            if(self.floor != 1){
                self.floor = 1; 
                self.buttonClick(tag);
            }
        },self);
        C_AddAnimButton(self._bg, "res/btn_2f.png" ,null, 305,C_getY(280),tag_dialog.f2,1,null,function(tag){
            if(self.floor != 2){
                self.floor = 2; 
                self.buttonClick(tag);
            }
        },self);
        C_AddAnimButton(self._bg, "res/btn_3f.png" ,null, 460,C_getY(280),tag_dialog.f3,1,null,function(tag){
            if(self.floor != 3){
                self.floor = 3; 
                self.buttonClick(tag);
            }
        },self);
        C_AddAnimButton(self._bg, "res/btn_4f.png" ,null, 615,C_getY(280),tag_dialog.f4,1,null,function(tag){
            if(self.floor != 4){
                self.floor = 4; 
                self.buttonClick(tag);
            }
        },self);
        C_AddAnimButton(self._bg, "res/btn_5f.png" ,null, 770,C_getY(280),tag_dialog.f5,1,null,function(tag){
            if(self.floor != 5){
                self.floor = 5; 
                self.buttonClick(tag);
            }
        },self);
        C_AddAnimButton(self._bg, "res/btn_6f.png" ,null, 925,C_getY(280),tag_dialog.f6,1,null,function(tag){
            if(self.floor != 6){
                self.floor = 6; 
                self.buttonClick(tag);
            }
        },self);
        
        var floor_btn1 = C_AddSprite(self._bg,  "res/btn_1f_on.png", 150,C_getY(280),1,null,null);
        var floor_btn2 = C_AddSprite(self._bg,  "res/btn_2f_on.png", 305,C_getY(280),1,null,null);
        var floor_btn3 = C_AddSprite(self._bg,  "res/btn_3f_on.png", 460,C_getY(280),1,null,null);
        var floor_btn4 = C_AddSprite(self._bg,  "res/btn_4f_on.png", 615,C_getY(280),1,null,null);
        var floor_btn5 = C_AddSprite(self._bg,  "res/btn_5f_on.png", 770,C_getY(280),1,null,null);
        var floor_btn6 = C_AddSprite(self._bg,  "res/btn_6f_on.png", 925,C_getY(280),1,null,null);
        
        self.floor_btns.push(floor_btn1);
        self.floor_btns.push(floor_btn2);
         self.floor_btns.push(floor_btn3);
         self.floor_btns.push(floor_btn4);
         self.floor_btns.push(floor_btn5);
         self.floor_btns.push(floor_btn6);
        
        self.clickFloor();
        
        var okres = style ? style.okres : res.btn_ok;
        var cancelres = style ? style.cancelres : res.btn_cancel;
        var xres = style ? style.btnx : res.n_btn_x;
     
        
       
       
        var tab_size = 270;
        for(var i = 0 ; i < 3; i++){
             var x = size.width / 2-515+i*tab_size;
             var y = C_getY(1920);
             var w = tab_size;
             var h = 200;
             var tag = i;
             console.log("x "+x+" y "+y+" w "+w+" h "+h+" tag "+tag);
             C_AddTransparentButton(self, x,y,w,h,tag,  function (_tag) {
                   console.log("tag is ",_tag);
                self._remove(_tag);
                
            });
         }
        
        //모눈종이 효과  좌표맞추기용
//        this.mapSprite.addChild(createGridDrawNode(2160,3840));
        
        
        
        //검색데이타가 있다면
        if(title){
            var arr = title.split('|');
            self.search_floor = arr[0] == "2F" ? 2 : 1;
            self.floor = self.search_floor;
            self.search_text = arr[1];
            self.initMap(self._bg, self.floor);
            self.clickFloor();
            self.flashSearchText(self.search_text);
            this.schedule(this.update);
        }
    },
    wtime : 0,
    flashcnt : 0,
    flashSps : [],
    beforetime: -1,
    update: function (dt) {

        var self = this;
       
        this.wtime += dt;
       
        var nowtime = Math.floor(this.wtime);
//        console.log("nowtime "+nowtime +" beforetime "+self.beforetime);
        if(self.beforetime == -1 || self.beforetime != nowtime){
            self.beforetime = nowtime;
             console.log("Map update");
            this.displayFlash();
             this.flashcnt++;
        }
        
    },
    displayFlash:function(){
        var self = this;
        var color = this.flashcnt%2 == 0 ? cc.color(200,0,0) : cc.color(200,200,0);
        for(var i = 0 ; i < this.flashSps.length;i++){
            this.flashSps[i].fontSize = 50;
            this.flashSps[i].setColor(color);   
            
        }
    },
    flashSearchText: function(search_text){
        var self = this;
        flashSps = [];
        for(var i = 0 ; i < self.all_btns.length;i++){
            
            if(self.all_btns[i].data == search_text){
                this.flashSps.push(self.all_btns[i].sp);
            }
        }
        
        
    },
    initFloorData:function(){
        var self = this;
        self.now_floordata = json_floor.floordata[self.floor-1];
        for(var i = 0 ; i < self.now_floordata.data.length;i++){
            self.clickFloorData(i, self.now_floordata);
        }
        
    },
    clickFloorData:function(idx, floordata){
        var self = this;  
        
        const fname = floordata.fname;
        const floordata_item = floordata.data[idx];
        const title = floordata_item.title;        
        const event = floordata_item.event;
        const message = event.message;
        const x = floordata_item.x*2;
        const y = floordata_item.y*2;
        const fontsize = floordata_item.fontsize ? floordata_item.fontsize*2 : 28;
        const color = floordata_item.fontcolor ? C_HEXtoCCColor(floordata_item.fontcolor) :C_HEXtoCCColor("#313131");
        var imgres = "contentdata/floor/"+fname+"_"+title+".jpg";
        console.log(title+" x is "+parseInt(x)+" y is "+C_getY(parseInt(y)));
        var sp = C_AddCustomFontNew(this.mapSprite, title, parseInt(x), C_getY(parseInt(y)), title, 1, cc.TEXT_ALIGNMENT_CENTER ,fontsize,color,true,function(tag){
            C_ShowImageDialogLayer(self, title , message, imgres, function(){
                
            });    
        });
        self.all_btns.push({"sp":sp, "data":title});
    },
    clickFloor:function(){
        var self = this;
        var idx = self.floor-1;
        
        for(var i = 0 ; i < self.floor_btns.length;i++){
            self.floor_btns[i].setVisible(false);
            self.floor_btns[i].setScale(1);
        }
            
        
        
        if(idx >= 0){
            self.floor_btns[idx].setVisible(true);
            var scale = cc.scaleTo(0.3,1,1);
            self.floor_btns[idx].runAction(scale);
        }
    },
    buttonClick:function(tag){
        var self = this;
        //console.log("buttonClick!! ",tag);
       
         C_PlaySound(SOUND.SND_BUTTONTOUCH);
        switch(tag){
            case tag_dialog.f1:
                self.floor = 1;
                self.initMap(self._bg, self.floor);
                break;
            case tag_dialog.f2:
                self.floor = 2;
                self.initMap(self._bg, self.floor);
                break;
            case tag_dialog.f3:
                self.floor = 3;
                self.initMap(self._bg, self.floor);
                break;
            case tag_dialog.f4:
                self.floor = 4;
                self.initMap(self._bg, self.floor);
                break;
            case tag_dialog.f5:
                self.floor = 5;
                self.initMap(self._bg, self.floor);
                break;
             case tag_dialog.f6:
                self.floor = 6;
                self.initMap(self._bg, self.floor);
                break;
        }  
        self.clickFloor();
    },
    
    _remove:function(tag){      
        var self = this;
        IS_SHOW_POPUP = false; 
        cc.log(this.getParent());//This Works fine   <--------------- ?
        var p = this.getParent();
//        C_HideAni(self._bg,function(){
//            self.runAction(cc.RemoveSelf.create());
//            self.okCallback();
//        })
        self.runAction(cc.RemoveSelf.create());
            self.okCallback(tag);
    },
    initWeightSpeed:function(_bg){
        var size = cc.winSize;
        var self = this;
//        console.log("initWeightSpeed");
        this.zoomSlider = new ccui.Slider();
        this.zoomSlider.setTouchEnabled(true);
        this.zoomSlider.setRotation(-90);
        this.zoomSlider.direction = 0; // 0 :horizontal , 1: vertical;
        this.zoomSlider.loadBarTexture(res.n_speed_back);
        this.zoomSlider.loadSlidBallTextures(res.n_speed_stick);
        this.zoomSlider.loadProgressBarTexture(res.n_speed_on);
        this.zoomSlider.x = _bg.width-40;
        this.zoomSlider.y = C_getY(_bg.height-130);
//        this.zoomSlider.setScale(2);
        
        var gab = 100/12;  //8
        var value = this.weight_speed*2-3;
        this.zoomSlider.setPercent(value*gab);
        this.zoomSlider.addEventListener(this.sliderEvent,this);
        _bg.addChild(this.zoomSlider);
        
        
//        this.zoomSlider.setVisible(false);
    },
    sliderEvent:function(sender, type){
        var self = this;
        switch(type){
            case ccui.Slider.EVENT_PERCENT_CHANGED:
                console.log("percent : "+sender.getPercent().toFixed(0));
                // 1.5~7.5
                var gab = 100/6;
//                console.log("gab is "+gab);
                var value = (sender.getPercent()/gab);
//                console.log("value : ",value);
                var percent = parseInt(gab)*value;
//                console.log("value "+value+" percent "+percent);
                sender.setPercent(parseInt(gab)*value)
//                self.weight_speed = 1.5+value;
                
                //1초, 2초 , 3초 ... 초단위 속도조절
                //self.updateWeightSpeed(Math.floor(1.5+value*0.5)); 중간단위단위로 끊어서 확대
                self.updateWeightSpeed(1+value/2);
//                sender.setPercent(20);
                break;
        }
//        console.log("sender.getPercent() : "+sender.getPercent());
       
//        if(sender.getPercent() < 20)sender.setPercent(20);
//        if(sender.getPercent > 80)sender.setPercent(80);
    },
    updateWeightSpeed:function(speed){
        var _w = 1080;
        var _h = 1571;
        this.weight_speed = speed;
//        console.log("scale is "+speed);
//        C_SaveData("health_speed",speed);
        if(speed < 1)speed =1;
        this.mapSprite.setScale(speed/2);
        this.mapSprite.setPosition(_w/2, _h/2);
    },
    ///////////////////////////////////////////////////////
    // 지도영역 
    ///////////////////////////////////////////////////////
   initMap: function (_bg, value) {
        var self = this;
        var _w = 1080;
        var _h = 1571;

        // 이전 지도 레이어 및 스프라이트 제거
        if (this.mapSprite) {
            this.mapSprite.removeFromParent(true);
            this.mapSprite = null;
        }

        if (this.mapViewLayer) {
            this.mapViewLayer.removeFromParent(true);
            this.mapViewLayer = null;
        }

        // 클리핑 노드가 없으면 새로 생성 (최초 1회만 추가)
        if (!this.clipper) {
            var stencil = new cc.DrawNode();
            stencil.drawRect(cc.p(0, 0), cc.p(_w, _h), cc.color(70, 70, 70, 0), 1, cc.color(88, 0, 0, 0));

            this.clipper = new cc.ClippingNode(stencil);
            this.clipper.setAnchorPoint(0.5, 0.5);
            this.clipper.setPosition((_bg.width - _w) / 2, 180);
            _bg.addChild(this.clipper);
        }

        // 새 지도 레이어 생성
        this.mapViewLayer = new cc.Layer();
        this.mapViewLayer.setContentSize(_w, _h);
        this.clipper.addChild(this.mapViewLayer);

        // 지도 이미지 경로 결정
        var mapurl = "";
        for (var i = 0; i < self.mapdatas.length; i++) {
            if (self.mapdatas[i].value == value) {
                mapurl = self.mapdatas[i].url;
                break;
            }
        }

        // 지도 이미지 추가
        this.mapSprite = new cc.Sprite(mapurl);
        this.mapSprite.setAnchorPoint(0.5, 0.5);
        this.mapSprite.setPosition(_w / 2, _h / 2);
        this.mapSprite.setScale(0.5);
        this.mapViewLayer.addChild(this.mapSprite);

        // 터치 활성화
        this.enableMapTouch();
        self.initFloorData();
    },
    enableMapTouch: function () {
    
    var self = this;

    this.isDragging = false;
    this.startPos = null;

    var touchListener = cc.EventListener.create({
        event: cc.EventListener.TOUCH_ONE_BY_ONE,
        swallowTouches: true,

        onTouchBegan: function (touch, event) {
            self.startPos = touch.getLocation();
            self.isDragging = true;
            return true;
        },

        onTouchMoved: function (touch, event) {
            if (self.isDragging) {
                var delta = touch.getDelta();
                self.moveMapByDelta(delta);
            }
        },

        onTouchEnded: function (touch, event) {
            self.isDragging = false;
            if (g_menuLayer) g_menuLayer.resetInactivityTimer();
            
        },

        onTouchCancelled: function (touch, event) {
            self.isDragging = false;
            if (g_menuLayer) g_menuLayer.resetInactivityTimer();
        }
    });

    cc.eventManager.addListener(touchListener, this.mapSprite);

    // 💡 마우스도 동시에 지원하고 싶다면 아래도 함께 사용
    var mouseListener = cc.EventListener.create({
        event: cc.EventListener.MOUSE,
        onMouseDown: function (event) {
            self.isDragging = true;
            self.startPos = cc.p(event.getLocationX(), event.getLocationY());
        },
        onMouseMove: function (event) {
            if (self.isDragging) {
                var delta = event.getDelta();
                self.moveMapByDelta(delta);
            }
        },
        onMouseUp: function () {
            self.isDragging = false;
            if (g_menuLayer) g_menuLayer.resetInactivityTimer();
        }
    });

    cc.eventManager.addListener(mouseListener, this.mapSprite);
},

// 💡 지도 이동 보조 함수
moveMapByDelta: function (delta) {
    var pos = this.mapSprite.getPosition();
    var newPos = cc.p(pos.x + delta.x, pos.y + delta.y);

    var scale = this.mapSprite.getScale();
    var mapSize = this.mapSprite.getContentSize();
    var scaledWidth = mapSize.width * scale;
    var scaledHeight = mapSize.height * scale;

    var viewW = 1080;
    var viewH = 1571;

    // 이동 제한 계산
    var minX = viewW - scaledWidth / 2;
    var maxX = scaledWidth / 2;
    var minY = viewH - scaledHeight / 2;
    var maxY = scaledHeight / 2;

    newPos.x = Math.max(minX, Math.min(newPos.x, maxX));
    newPos.y = Math.max(minY, Math.min(newPos.y, maxY));

    this.mapSprite.setPosition(newPos);
},
    onExit: function () {
        this._super();
        if (this.touchListener) {
            cc.eventManager.removeListener(this.touchListener);
        }
    }
   
});


