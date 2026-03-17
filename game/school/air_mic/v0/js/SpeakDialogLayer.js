var tag_speakdialog = {
    
    btn_cancel : 1,
    btn_ok : 2,
    btn_speak : 3
}

var SpeakDialogLayer = cc.Layer.extend({
    sprite:null,
    m_muSound : null,
    m_muExitItem : null,
    btn_sndon:null,
    btn_sndoff:null,
    pback:null,
    isspeak : 0,
    speak_btn : null,
    speak_ani : null,
    txt_title :null,
    txt_message :null,
    txt_question : null,
    txt_answer : null,
    ctor:function () {
        this._super();
        var self = this;
        var size = cc.winSize;
        window._speakDialogLayer = this;
        
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
        
        
        self.setOpacity(0.8);
        
        
        //test
        
           
    },
    init:function(title,message, OKCallback , CancelCallback,style){
        var self = this;
        var size = cc.winSize;
        

        
         var bgLayer = new cc.LayerColor(cc.color(32, 32, 32, 180));
        self.addChild(bgLayer, 0);
        //background not click 
        self.addChild(C_PopupBack(self));


        
        self._bg = new cc.Scale9Sprite (res._global_img_ninepatch_bg);
        self._bg.x = size.width / 2;
        self._bg.y =  size.height/2;
        self._bg.width = 1032;
        self._bg.height = 1916;
        this.addChild (self._bg);
        var bg_width = self._bg.width;
        var bg_height = self._bg.height;
        
//        self._bg = cc.Sprite.create(res.pop_back);
//        self._bg.setPosition(360,600);
//        this.addChild (self._bg);
        
        var okres = style ? style.okres : res.btn_ok;
        var cancelres = style ? style.cancelres : res.btn_cancel;
        
        if(OKCallback && CancelCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2-120,70,tag_speakdialog.btn_ok,0.7,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2+120,70,tag_speakdialog.btn_cancel,0.7,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }else if(OKCallback){
            C_AddAnimButton(self._bg,okres,null,self._bg.width/2,70,tag_speakdialog.btn_ok,0.7,null,function(tag){self.buttonClick(tag);OKCallback();self._remove();},self);
        }else if(CancelCallback){
            C_AddAnimButton(self._bg,cancelres,null,self._bg.width/2,70,tag_speakdialog.btn_cancel,0.7,null,function(tag){self.buttonClick(tag);CancelCallback();self._remove();},self);    
        }
        
        //title Text
        self.txt_title = C_AddCustomFont(self._bg, title, self._bg.width/2,self._bg.height-60,1,1,cc.TEXT_ALIGNMENT_CENTER,40,cc.color(255,255,255),true);
        
        //message Texxt
        self.txt_message = C_AddCustomFont(self._bg, message, self._bg.width/2, self._bg.height/2,1,1,cc.TEXT_ALIGNMENT_CENTER,30,cc.color(255,255,255));

        
        //question Text
        self.txt_question = C_AddCustomFont(self._bg, "", self._bg.width/2, C_getY(400), 1,1,cc.TEXT_ALIGNMENT_CENTER,50,cc.color(255,255,255),true);
        
        //answer Text
        self.txt_answer = C_AddCustomFont(self._bg, "", self._bg.width/2, self._bg.height/2+100,1,1,cc.TEXT_ALIGNMENT_CENTER,30,cc.color(255,255,255));

        
        startMediaRecord();
        self.isspeak = 1;
        self.updateSpeakButton();
        
        
      
    },
    onSpeakDisplayStop:function(){
        var self = this;
        var size = cc.winSize;
        // 기존 애니메이션 제거
        if (this.speak_ani) {
            this.speak_ani.removeFromParent(true);
            this.speak_ani = null;
        }
        var arr_flag = [res.n_speak_0, res.n_speak_1, res.n_speak_2, res.n_speak_3, res.n_speak_4, res.n_speak_5, res.n_speak_6];
        self.txt_question.string = "";
        self.txt_answer.string = "";   
        self.txt_message.string = "답변을 찾고 있어요...";
        var arr_flag = [res.n_mic_ready0, res.n_mic_ready1];
        this.speak_ani = C_spriteAnimation(self._bg, size.width/2, C_getY(1350), arr_flag, 0.1, 1, function(){});
    },
    onSpeakeCheck: function(result){
        var self = this;
        var size = cc.winSize;
        
    

        console.log("음성 답변 데이터 ", result);
        self.txt_message.string = "";
        var _question = result.question ? result.question : "";
        var _answer = result.answer ? result.answer : "";
        var _json = result.id ? JSON.parse(result.id): null;
        var _tab = result.tab ? result.tab : -1;
        var _sub = result.sub != undefined ? result.sub : 0;
                
        self.txt_question.string = C_insertNewlines(_question,30);
        self.txt_answer.string = C_insertNewlines(_answer,40);   
        self.isspeak = 0;
        self.updateSpeakButton();  
        
        console.log("resetWakeWord 000");
        if(window.android){
            console.log("resetWakeWord 111");
            window.android.resetWakeWord();
        }
        
        
        if(_json != null){
            var ids = _json.id.split("|");
            var floor_infos = [];
            var ids_datas = [];
            
            
            for(var i = 0 ; i < now_floor_info["floordata"].length; i++){
                 for(var j = 0 ; j < now_floor_info["floordata"][i]["data"].length; j++){
                     for(var k = 0 ; k < ids.length; k++){
                        if(now_floor_info["floordata"][i]["data"][j]["id"] == ids[k]){
                            ids_datas.push(now_floor_info["floordata"][i]["data"][j]);
                            floor_infos.push(now_floor_info["floordata"][i]);
                        }
                    }
                 }
            }
            console.log("ids_datas ",ids_datas);
            for(var i = 0 ; i< ids_datas.length;i++){
                var textdata = {
                 
                        "x": 140,
                        "y": 30,
                        "message": ids_datas[i].title+" ("+floor_infos[i].fname+")",
                        "fontsize": 24,
                        "color": "#b15151",
                        "textalign": "center"
                    
                }
                var sp = C_AddSpriteTouch(self._bg, res._global_listback, 540, C_getY(1000+i*70), i+"" ,1,null, function(tag) {
                    window.floorViewerBridge.show();
                    var idx = parseInt(tag);
                    var poiid = ids_datas[idx].id;
                    var floorid = floor_infos[idx].id;
                    
                    var poiinfo = ids_datas[idx];
                    C_floorNavigate(poiid);
                    self._remove();
                },textdata);
            }
            
        }
        else if(_tab != -1){
//            switch(_tab){
//                case 0: //home
//                    C_PlaySound(SOUND.MOVE_HOME);
//                    break;
//                case 1:
//                     C_PlaySound(SOUND.MOVE_FACILITY);
//                    break;
//                case 2:
//                    C_PlaySound(SOUND.MOVE_OPERATIONHOURS);
//                    break;
//                case 3:
//                    C_PlaySound(SOUND.MOVE_USING);
//                    break;
//                case 4:
//                    C_PlaySound(SOUND.MOVE_FESTIVAL);
//                    break;
//                
//
//            }
           
            C_playTTS(_answer);
            
            setTimeout(function(){
                if(_tab >= 0)
                    C_nextScene(SCENE_MENU,{"tab":_tab, "sub":_sub});                    
            },1000);   
            userClickTimestamp = (new Date()).getTime();
        }else{
             C_playTTS(_answer);
        }
        
       
          
    },
    updateSpeakButton: function() {
        var self = this;
        var size = cc.winSize;

        // 기존 애니메이션 제거
        if (this.speak_ani) {
            this.speak_ani.removeFromParent(true);
            this.speak_ani = null;
                }
                
        if (this.isspeak === 2) {
            // 녹음 완료 후 상태
            console.log("isspeak == 2");
            self.txt_question.string = "";
            self.txt_answer.string = "";   
            self.txt_message.string = "답변을 찾고 있어요...";
            var arr_flag = [res.n_mic_ready0, res.n_mic_ready1];
            this.speak_ani = C_spriteAnimation(self._bg, size.width/2, C_getY(1350), arr_flag, 0.1, 1, function(){});
        } else if (this.isspeak === 1) {
            // 녹음 중 상태
            var arr_flag = [res.n_speak_0, res.n_speak_1, res.n_speak_2, res.n_speak_3, res.n_speak_4, res.n_speak_5, res.n_speak_6];
            this.speak_ani = C_spriteAnimation(self._bg, size.width/2, C_getY(1350), arr_flag, 0.1, 1, function() {
            console.log("speak_ani 클릭했다.");
            self.isspeak = 2;
            self.updateSpeakButton();

            stopMediaRecord(function(res) {

                self.onSpeakeCheck(res);
            });
        });
    } else {
        // 기본 버튼 상태
        self.txt_message.string = "";
        this.speak_ani = C_AddAnimButton(self._bg, res.n_mic_on, null, self._bg.width/2, C_getY(1350), tag_speakdialog.btn_speak, null, null, function(tag) {
            console.log("speak_btn 클릭했다.");
            startMediaRecord();
            self.isspeak = 1;
            self.updateSpeakButton();
        }, self);
    }
},
    buttonClick:function(tag){
        var self = this;
        //console.log("buttonClick!! ",tag);
         C_PlaySound(SOUND.CASH);
        userClickTimestamp = (new Date()).getTime();
//        switch(tag){
//            case tag_speakdialog.btn_ok:
//                self._OKCallback();
//                self._remove();
//                break;
//            case tag_speakdialog.btn_cancel:
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
        mediaRecorder = null;
        C_HideAni(self._bg,function(){
            self.runAction(cc.RemoveSelf.create());
        })
    }
   
});


