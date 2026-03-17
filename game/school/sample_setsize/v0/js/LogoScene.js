var l_tag = {
//    btn0: 0, //학교소개
//    btn1: 1, //교육활동
//    btn2 : 2, //알림마당
//    btn3 : 3,//열린마당
//    btn4 : 4, //학교안내도
//    name : 5, //학교이름
//    title : 6, //타이틀
//    logo : 7, //로고
    
};

var LogoLayer = cc.Layer.extend({
    sprite:null,
    hand0:null,
    hand1:null,
    handcnt:0,
    wtime: 0,
    before_time: 0,
    homepage_data : null,
    homedatas : [],
    maindatas : [],
    contentdatas : [],
    ani_datas:[],
    ctor:function () {
        //////////////////////////////
        // 1. super init first
        this._super();
        //console.log("LogoLayer!!");
        /////////////////////////////
        // 2. add a menu item with "X" image, which is clicked to quit the program
        //    you may modify it.
        // ask the window size
        var self = this;
        var size = cc.winSize;
        
        //배경색
        this.addChild(new cc.LayerColor.create(cc.color(255, 36, 62, 100)));
        
        
        self.homepage_data = getgamedata;
        self.contentdatas = JSON.parse(self.homepage_data.hm_content_data);
        self.homedatas = JSON.parse(self.homepage_data.hm_home_data);
        
        
        //
        if(checkFirstScene(self.contentdatas)){
            return;
        }
        
        
        
        console.log("logo self.homedatas ",self.homedatas);
        l_tag = {};
        for(var i = 0 ; i < self.homedatas.length;i++){
            l_tag[self.homedatas[i].id] = i;
        }
        for(var i = 0 ; i < self.homedatas.length;i++){
            if(self.homedatas[i].type == "animation"){
                var ani_sps = C_setUI(self,size,self.homedatas[i]);
                self.ani_datas.push({"id":self.homedatas[i].id, "anitime":self.homedatas[i].anitime, "nowindex":0, "ani_sps":ani_sps});
            }
            else {
                C_setUI(self,size,self.homedatas[i]);
            }
        }
        
        
        
        
        
        
        //배경 이미지
        //var bg = C_AddSprite(self,res.n_home_mbg, size.width / 2, C_getY(size.height/2),1,null,null);
//        var bg = C_AddSprite(self,res.n_home_bg1, size.width / 2, C_getY(size.height/2),1,null,null);
        
//        //로고
//        var logo = C_AddSprite(self,res.n_home_logo, size.width / 2, C_getY(230),1,null,null);
//        
//        //타이틀  
//        var title = C_AddSprite(self,res.n_home_title, size.width / 2, C_getY(470),1,null,null);
//        C_ShowAni(title);
//        
////        //이름 // 매천중학교
////        var name = C_AddSprite(self,res.n_home_name, size.width / 2, C_getY(430),1,null,null);
////        C_ScaleRepeatAni(name,2,1.1);
//        
//        this.handcnt = 0;
//        
//        //버튼 0 : 학교소개
//        C_AddAnimButton(self, res.n_home_mbtn0, res.n_home_mbtn0_click, size.width / 2-235, C_getY(size.height / 2 - 165), l_tag.btn0, null, null, function (tag) {
//            self.buttonClick(tag);
//        }, self);
//        //버튼 1 : 교육활동
//        C_AddAnimButton(self, res.n_home_mbtn1, res.n_home_mbtn1_click, size.width / 2+235, C_getY(size.height / 2 - 165), l_tag.btn1, null, null, function (tag) {
//            self.buttonClick(tag);
//        }, self);
//        //버튼 2 : 알림마당
//        C_AddAnimButton(self, res.n_home_mbtn2, res.n_home_mbtn2_click, size.width / 2-235, C_getY(size.height / 2 + 370), l_tag.btn2, null, null, function (tag) {
//            self.buttonClick(tag);
//        }, self);
//        //버튼 3 : 열린마당
//        C_AddAnimButton(self, res.n_home_mbtn3, res.n_home_mbtn3_click, size.width / 2+235, C_getY(size.height / 2 + 370), l_tag.btn3, null, null, function (tag) {
//            self.buttonClick(tag);
//        }, self);
//        //버튼 4 : 학교안내도
//        C_AddAnimButton(self, "res/n_home/mbtn4.png", null, 100, C_getY(150), l_tag.btn4, null, null, function (tag) {
//            self.buttonClick(tag);
//        }, self);
        
//        this.hand0 = C_AddSprite(self,res.n_home_hand0, 295, C_getY(size.height  - 155),1,null,null);
//        this.hand1 = C_AddSprite(self,res.n_home_hand1,  295, C_getY(size.height  - 155),1,null,null);
//        this.hand1.setVisible(false);
        this.schedule(this.update);
        console.log("logo scene");
        
        
        
        return true;
    },
   
    update: function (dt) {
         
        var self = this;
        this.wtime += dt;
//        console.log("time is ",this.wtime);
        var nowtime = Math.floor(this.wtime);
//        console.log("status is "+this.status);
//         console.log("nowtime is "+nowtime+" beforetime "+this.before_time);
//        if (nowtime > this.before_time+0.5) {
//            console.log("this.handcnt is ",this.handcnt);
//            this.handcnt++;
//            this.updateHand();
//            this.before_time = this.wtime;
//        }
         for(var i = 0 ; i < self.ani_datas.length;i++)
            C_updateAnimation(self.ani_datas[i], this.wtime);
        
        //애니메이션 이미지 처리
//        self.ani_sps.forEach(function (ani) {
//            if (!ani.elapsed) ani.elapsed = 0;
//            if (ani.currentIndex === undefined) ani.currentIndex = -1;
//
//            ani.elapsed += dt * 1000; // dt는 초 단위 → ms 단위로 변환
//
//            let totalTime = ani.anitime;            // 예: 1000ms
//            let frameCount = ani.sps.length;        // 예: 5
//            let frameTime = totalTime / frameCount; // 예: 200ms
//
//            // 몇 번째 프레임을 보여야 하는가?
//            let newIndex = Math.floor(ani.elapsed / frameTime);
//
//            if (newIndex !== ani.currentIndex && newIndex < frameCount) {
//                // 이전 프레임 숨기기
//                if (ani.currentIndex >= 0 && ani.sps[ani.currentIndex]) {
//                    ani.sps[ani.currentIndex].setVisible(false);
//                }
//
//                // 새 프레임 보이기
//                if (ani.sps[newIndex]) {
//                    ani.sps[newIndex].setVisible(true);
//                }
//
//                ani.currentIndex = newIndex;
//            }
//
//            // 애니메이션 종료 처리 (루프 원하면 여기 수정)
//            if (ani.elapsed >= totalTime) {
//                ani.elapsed = totalTime; // 멈추기
//                // 또는 루프 시:
//                // ani.elapsed = 0;
//                // ani.currentIndex = -1;
//            }
//        });
    },
   
   
    updateHand: function(){
        if(this.handcnt%2 == 0){
            this.hand0.setVisible(true);
            this.hand1.setVisible(false);
        }else{
            this.hand0.setVisible(false);
            this.hand1.setVisible(true);
        }
    },
    buttonClick: function(tag){
        var self = this;
        var size = cc.winSize;
        console.log("buttonClick!! ", tag);
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        for(var i = 0 ; i < self.homedatas.length;i++){
            if(tag == self.homedatas[i].id){
                var event = self.homedatas[i].event ? self.homedatas[i].event : null; 
                
                if(event){
                    if(event.page == "home" || event.page == "main"){
                        var scene = event.page == "main" ? SCENE_MENU : SCENE_HOME;
                        var data = event;                    
                        C_nextScene(scene, data);                       
                    }else if(event.page == "map"){
                        var mapdatas = [];
                        for(var i = 0 ; i < self.contentdatas.length;i++){
                            if(self.contentdatas[i].type == "mapimg")
                                mapdatas.push(self.contentdatas[i]);
                        }

                        C_ShowMapDialogLayer(self,"","",mapdatas, function(){

                             console.log("closeMapdialogLayer 111");
                        },null);   
                    }
                    
                }
                
                break;
            }
        }
    },
    buttonClick_Old: function (tag) {
        var self = this;
        var size = cc.winSize;
        console.log("buttonClick!! ", tag);
        C_PlaySound(SOUND.SND_BUTTONTOUCH);
        var canvas = document.getElementById("gameCanvas");
        switch (tag) {
            case l_tag.logo:
                
                C_nextScene(SCENE_HOME);
                break;
            case l_tag.btn0:
                var data = {
                    "tab":0,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn1:
                var data = {
                    "tab":1,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn2:
                var data = {
                    "tab":2,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn3:
                var data = {
                    "tab":3,
                    "sub":0                    
                }
                C_nextScene(SCENE_MENU, data);
                break;
            case l_tag.btn4:

                
                
              
                
                var mapdatas = [];
                for(var i = 0 ; i < self.contentdatas.length;i++){
                    if(self.contentdatas[i].type == "mapimg")
                        mapdatas.push(self.contentdatas[i]);
                }
                
                 C_ShowMapDialogLayer(self,"","",mapdatas, function(){
                     
                     console.log("closeMapdialogLayer 111");
                },null);   
                break;
            
        }
    },
});
var LogoScene = cc.Scene.extend({
    onEnter:function () {
        this._super();
        var layer = new LogoLayer();
        this.addChild(layer);
    }
});

function complete_media(){
    //console.log("bg sound loaded!!");

}
