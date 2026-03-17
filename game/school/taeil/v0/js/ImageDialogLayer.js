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
    

    init:function(nowindex, message, imgdatas, OKCallback , CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        
        
        C_Loading(self);
//        console.log(" title "+title+" message "+message+" imgdatas "+imgdatas);
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

        
        if(nowindex && nowindex > 0){
            self.currentIndex = nowindex;            
        }
        var bgLayer = new cc.LayerColor(cc.color(32, 32, 32, 180));
        self.addChild(bgLayer, 0);
        //background not click 
        self.addChild(C_PopupBack(self));


        
        self._bg = new cc.Scale9Sprite (res._global_img_ninepatch_white_bg);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2+40;
        self._bg.width = 960;
        self._bg.height = 820;
        this.addChild (self._bg);
//        var bg_width = self._bg.width;
//        var bg_height = self._bg.height;
        

        var okres = style ? style.okres : res.btn_close;
        var cancelres = style ? style.cancelres : res.btn_cancel;
        
        if(OKCallback && CancelCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2-120,50,tag_imagedialog.btn_ok,1,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2+120,50,tag_imagedialog.btn_cancel,1,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }else if(OKCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2,50,tag_imagedialog.btn_ok,1,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
        }else if(CancelCallback){
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2,50,tag_imagedialog.btn_cancel,1,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);
        }
        
//        if(imgdatas.length == 1){
//            var img = new Image();
//            img.onload = function () {
//                // ✅ 로드 성공
//                console.log("정상적으로 이미지 로드됨: ", imgdatas);
//    //            C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,cc.color(255,255,255),true);
//                // 이제 cocos sprite로 사용
//                var sp = C_AddSpriteImageResize(self._bg, imgdatas[0].filename, self._bg.width/2, self._bg.height-360, null,1,null,960); //img
//
//                self.setCustomTitle(self, title);
//                C_AddCustomFont(self._bg, message, 50, self._bg.height-1090 ,1,1,cc.TEXT_ALIGNMENT_LEFT,30,cc.color(255,255,255),true);
//            };
//            img.onerror = function () {
//                // ❌ 로드 실패
//                console.log("이미지 로드 실패: ", imgdatas);
//    //            self._bg.height = 600;
//                C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,cc.color(255,255,255),true);
//                C_AddCustomFont(self._bg, message, 50, self._bg.height/2,1,1,cc.TEXT_ALIGNMENT_LEFT,30,cc.color(255,255,255),true);    
//            };
//            img.src = imgdatas[0].filename;
//        }else {
//            self.initSwiperLayer(imgdatas);    
//        }
        
        self.initSwiperLayer(imgdatas);  
        
      
        C_ShowAni(self._bg);
        
        
    },
     /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 START
    /////////////////////////////////////////////////////////////////
    imageData: [],
    currentIndex: 0,
    slideSprite: null,
    isSliding: false,
    isPosterScene : false, //포스터 씬일때만 슬라이드 터치가 되도록한다.    
    initSwiperLayer : function (imageList){
        var self = this;
        this.imageData = imageList;
//        this.currentIndex = 0;
//        this.addChild(new cc.LayerColor.create(cc.color(255, 0, 0, 77)));
        if (this.imageData.length === 0) {
            cc.log("이미지 데이터가 없습니다.");
            return true;
        }

        this.showSlide(this.currentIndex, false); // 첫 슬라이드는 애니메이션 없음
        this.startAutoSlide();
        this.addTouchHandlers();
//        if(self.now_contentdata.indicator)this.initIndecator(self.now_contentdata.indicator);
        this.initArrow();
    },
    
    initArrow: function(){
        var self = this;
        var size = cc.winSize;
        if(this.imageData.length > 1){
            
        
            C_AddAnimButton(self, res._global_img_ic_left, null,120,size.height/2+80,"tag_left",1,null,function(tag){
               console.log("Left Click1");
                self.prevSlide(true);
            },self);
            C_AddAnimButton(self, res._global_img_ic_right, null,self.width-120,size.height/2+80,"tag_right",1,999,function(tag){
                    console.log("Right Click1");
                self.nextSlide(true);

            },self);
        }
    },
    updateArrow:function(){
        var self = this;
        console.log("updateArrow!! ");
        self.setCustomTitle(self, self.imageData[self.currentIndex].title);
    },
    initIndecator : function(indicator){
        
        var self = this;
        var len = this.imageData.length;
        console.log("this.imageList ",this.imageList);
        var offset = len/2*40;
        for(var i = 0;i < len; i++){            
            C_AddSprite(self,res.indicator_normal, indicator.x-offset+i*40, C_getY(indicator.y),1,2,null);
            this.indicator_on.push(C_AddSprite(self,res.indicator_on, indicator.x-offset+i*40, C_getY(indicator.y),1,2,null));            
        }
        this.updateIndicator();
        
    },
    updateIndicator:function(){
        var self = this;
        for(var i = 0;i < this.indicator_on.length; i++){            
            this.indicator_on[i].setVisible(false);            
        }
       if(this.indicator_on[this.currentIndex])this.indicator_on[this.currentIndex].setVisible(true);
    },
    showSlide: function (index, withAnimation, direction = "left") {
        var self = this;
        if (this.isSliding) return;
       
        this.isSliding = true;

        var imgfoldername = "floor";
        const imgPath = "contentdata/"+imgfoldername+"/" + this.imageData[index].filename;
//        const newSlide = new cc.Sprite(imgPath);
        const MY =460;
        const MX = this.width/2 - (this.width-960)/2;
        
         cc.loader.loadImg(imgPath, { isCrossOrigin: false }, (err, texture) => {
            if (err) {
                console.error("이미지 로딩 실패:", err);
                this.isSliding = false;
                return;
            }

            const newSlide = new cc.Sprite(imgPath);
            // ✅ 이미지 크기 강제 설정
            newSlide.setTexture(imgPath);
            const textureSize = newSlide.getContentSize();      
//            console.log("textureSize width "+textureSize.width+" height "+textureSize.height);
            const scaleX = 960 / textureSize.width;
            const scaleY = 720 / textureSize.height;
            newSlide.setScaleX(scaleX);
            newSlide.setScaleY(scaleY);
            newSlide.setPosition(MX, MY); // SwiperLayer 기준 아래쪽 중앙


            if (withAnimation) {
                let fromX = direction === "left" ? this.width + MX : -MX;
                console.log("fromX is "+fromX);
                newSlide.setPosition(fromX, MY);
                self._bg.addChild(newSlide, 1);
               
                const moveToCenter = cc.moveTo(0.4, cc.p(MX, MY));
                const onComplete = cc.callFunc(() => { this.isSliding = false; });

                if (this.slideSprite) {
                    const oldSlide = this.slideSprite;
                    const moveOutX = direction === "left" ? -MX : this.width + MX;
                    const moveOut = cc.moveTo(0.4, cc.p(moveOutX, MY));
                    const removeOld = cc.callFunc(() => oldSlide.removeFromParent());
                    oldSlide.runAction(cc.sequence(moveOut, removeOld));
                }
                
                newSlide.runAction(cc.sequence(moveToCenter, onComplete));
            } else {
                self._bg.addChild(newSlide);
                this.isSliding = false;
               
                
            }

            this.slideSprite = newSlide;
//             if(self.now_contentdata.indicator) self.updateIndicator();
             self.updateArrow();
         });
         self.setCustomTitle(self, this.imageData[this.currentIndex].title);
    },

    wtime : 0,
    update: function (dt) {

        var self = this;
        this.wtime += dt;
        this.handcnt++;
        var nowtime = Math.floor(this.wtime);
        for(var i = 0 ; i < self.ani_datas.length;i++)
            C_updateAnimation(self.ani_datas[i], this.wtime);
    },
   
    

    nextSlide: function (withAnimation) {
        var self = this;
        if(this.imageData.length <= 1)return;
        this.startAutoSlide();
        
        this.currentIndex = (this.currentIndex + 1) % this.imageData.length;
        console.log("this.currentIndex is "+this.currentIndex);
        this.showSlide(this.currentIndex, withAnimation, "left");
        C_checkAutoUpdate();
    },

    prevSlide: function (withAnimation) {
        var self = this;
        if(this.imageData.length <= 1)return;
        this.startAutoSlide();
        this.currentIndex = (this.currentIndex - 1 + this.imageData.length) % this.imageData.length;
        this.showSlide(this.currentIndex, withAnimation, "right");
    },
    before_touchx : -1, //터치시 홈화면으로 이동  START
    before_touchy : -1, //터치시 홈화면으로 이동  START
   
    addTouchHandlers: function () {
        const self = this;
        let startX = 0;
        
        if(self.isPosterScene){
             const listener = cc.EventListener.create({
                event: cc.EventListener.TOUCH_ONE_BY_ONE,
                swallowTouches: true,

                onTouchBegan: function (touch) {
                     startX = touch.getLocation().x;
                    startY = touch.getLocation().y;
                    
                    self.before_touchx = startX;
                    self.before_touchy = startY;
                    return true;
                },

                onTouchEnded: function (touch) {
                     if(self.imageData.length <=    1)return;    
                    
                    const endX = touch.getLocation().x;
                    const endY = touch.getLocation().y;
                    const delta = endX - startX;
                    
                    // 👉 자동 슬라이드 리셋
                   
                   
                    if (Math.abs(delta) > 50) {
                        if (delta < 0) {
                            self.nextSlide(true); // 왼쪽 슬라이드
                        } else {
                            self.prevSlide(true); // 오른쪽 슬라이드
                        }
                    }
                    
                   
                }
            });

            cc.eventManager.addListener(listener, this);
        }
       
    },  
    startAutoSlide: function () {
        const self = this;

        // 이전 타이머 제거
        if (this.slideTimer) {
            this.unschedule(this.slideTimer);
        }

        // 새로운 슬라이드 함수 정의
        this.slideTimer = function () {
            self.nextSlide(true);
        };

        // 5초마다 자동 슬라이드 시작
        this.schedule(this.slideTimer, 5);
    },
    
    /////////////////////////////////////////////////////////////////
    // 화면 내부에 포스터슬라이드 구현 END
    /////////////////////////////////////////////////////////////////
    
    
    
    
    customtitle : null,
    setCustomTitle: function (parent, title) {
        var self = this;

        // 1. 기존 배경 제거
        var oldBg = parent.getChildren().find(child => child.tag === "tag_title_bg");
        if (oldBg) {
            oldBg.removeFromParent(true);
            self.customtitle = null; // 텍스트도 새로 만들 예정이므로 초기화
        }

        // 2. 텍스트 길이 측정
        var tempLabel = new cc.LabelTTF(title, null, 30);
        var textWidth = tempLabel.getContentSize().width;
        var padding = 60;
        var bgWidth = textWidth + padding;

        // 3. 배경 생성
        var _bg = new cc.Scale9Sprite(res._global_img_ninepatch_gray_bg);
        _bg.x = parent.width / 2;
        _bg.y = parent.height / 2 + 370;
        _bg.setContentSize(bgWidth, 88);
        _bg.tag = "tag_title_bg"; // 태그 지정

        // 4. 텍스트 추가
        self.customtitle = C_AddCustomFont(
            _bg,
            title,
            _bg.width / 2,
            _bg.height / 2 - 5,
            null,
            1,
            cc.TEXT_ALIGNMENT_CENTER,
            30,
            C_HEXtoCCColor("#ffffff"),
            false
        );

        // 5. parent에 추가
        parent.addChild(_bg);
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


