var tag_dialog = {
    
    btn_cancel : 1,
    btn_ok : 2
}
var WebViewDialogLayer = cc.Layer.extend({
    sprite:null,
    m_muSound : null,
    m_muExitItem : null,
    btn_sndon:null,
    btn_sndoff:null,
    pback:null,
    webview:null,
    event:null,
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
    init:function(title,event,w,h, OKCallback , CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        self.event = event;
        
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


        var bgres = style && style.bgres ? style.bgres : res._global_img_ninepatch_bg;
        self._bg = new cc.Scale9Sprite (bgres);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2;
        self._bg.width = w+40;
        self._bg.height = h+300;
        this.addChild (self._bg);
        var bg_width = self._bg.width;
        var bg_height = self._bg.height;

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
        
        var titlecolor = cc.color(255,255,255);
        if(bgres == res._global_img_ninepatch_white_bg)
            titlecolor = cc.color(25,25,25);
        C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,titlecolor,true);
       
        
        C_ShowAni(self._bg);
        
        
        var url = self.getIFrameUrl(event);
        
        self.showWebView(w,h, url);
    },
    getIFrameUrl: function(event){
         var self = this;   
         var type = event.type;
         var schoolapitype = event.schoolapitype ? event.schoolapitype : "";
         var useschoolapi = event.useschoolapi ? parseInt(event.useschoolapi) : 0;
         
        var fname = "";
        switch(type){
         case "html":
                fname = "../../../webpage/type_image.html";
                 if(schoolapitype && useschoolapi == 1)
                      fname = "../../../webpage/type_schooldata.html";
                break;
            case "survey":
                fname = "../../../webpage/type_survey.html";
                break;
            case "img":
                fname = "../../../webpage/type_image.html";
                break;
            case "board":
                fname = "../../../webpage/type_board.html";
                break;
            case "gallery":
                fname = "../../../webpage/type_gallery.html";
                break;
             case "game":
                fname = event.url ? "../../../../"+event.url : "";//flappybird
                break;
            default:
                fname = "../../../webpage/type_schooldata.html";
                break;
        }
        return fname;
        

    },
     showWebView: function(w,h,url) {
       
//        console.log("this.pageurl ",this.pageurl);
         // 실제 브라우저 화면 크기
        var screen_width = $(window).width();
        var screen_height = $(window).height();
//        console.log("screen_width", screen_width, "screen_height", screen_height);

        // 캔버스 고정 해상도
        var canvas_width = 1080;
        var canvas_height = 1920;

        // 화면 비율에 따라 스케일 결정
        var scaleX = screen_width / canvas_width;
        var scaleY = screen_height / canvas_height;
        var finalScale = Math.min(scaleX, scaleY); // letterbox 기준
//        console.log("finalScale "+finalScale);
//        console.log("screen_width "+screen_width+" canvas_width "+(canvas_width*finalScale));
//        console.log("screen_height "+screen_height+" canvas_height "+(canvas_height*finalScale));
        var canvas_screenWidth = screen_width * (1 / finalScale);
        var canvas_screenHeight = screen_height * (1 / finalScale);
        var mx = (canvas_screenWidth-canvas_width)/2;
        var my = (canvas_screenHeight-canvas_height)/2;
        
        
        this.addWebView(this.sp_rect, 540+mx, 950+my, w, h, url);
    },
    hideWebView: function() {
        if (this.webview) {
            this.webview.removeFromParent(true);
            this.webview = null;
        }
    },
    addWebView: function(parent,  x, y, w, h, pageurl) {
        var self = this;
        var size = cc.winSize;
        if (!ccui || !ccui.WebView) {
            cc.log("WebView is not supported in this version of Cocos2d-JS.");
            return;
        }
        
        this.webview = new ccui.WebView();
        this.webview.setContentSize(w, h);
        this.webview.setAnchorPoint(0.5, 0.5);
        this.webview.setPosition(x, y);
        
        
        var _param_schoolapitype = self.event.schoolapitype ? "&apitype="+self.event.schoolapitype : "";
        var _param_gamemode = self.event.gamemode ? "&gamemode="+self.event.gamemode : "";        
        var _param_surveyidx = self.event.surveyidx ? "&surveyidx="+self.event.surveyidx : "";
        var _param_surveyonoff = self.event.surveyonoff ? "&surveyonoff="+self.event.surveyonoff : "";
        var _param_editmode = self.event.editmode ? "&editmode="+self.event.editmode : "";
        var _param_ishideadd = self.event.ishideadd ? "&ishideadd="+self.event.ishideadd : "";
        var _param_ishideedit = self.event.ishideedit ? "&ishideedit="+self.event.ishideedit : "";
        var _param_ishidedelete = self.event.ishidedelete ? "&ishidedelete="+self.event.ishidedelete : "";
        
        this.webview.loadURL(pageurl+"?projectid="+param_projectid+"&groupidx="+param_groupidx+"&listid="+self.event.listid+_param_schoolapitype+_param_gamemode+_param_surveyidx+_param_surveyonoff+_param_editmode+_param_ishideadd+_param_ishideedit+_param_ishidedelete);
        this.webview.setScalesPageToFit(true);
        this.webview.setVisible(true);
        this.webview.boderStyle("none");//iframe 테두리 안보이기
        this.addChild(this.webview, 999);
        
        
        
        //iframe 클릭했을때 이벤트 받는다.
        initIframeTouchEvent(self);
        

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


