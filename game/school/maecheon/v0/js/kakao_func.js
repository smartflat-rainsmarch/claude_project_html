//////////////////////////////////////////////////
//boolean tyle
//////////////////////////////////////////////////
function K_TalkBangCheck(){
    return uiloader.hasLinkId();
}


//////////////////////////////////////////////////
//void type   
//////////////////////////////////////////////////
function K_ResetData(){
    /////////////////////////////
    //RESET SAVE DATA
    /////////////////////////////

    uiloader.removeSaveData(function(success){
        //console.log("remove success");

    },function(error){
        //console.log("remove fail");

    });
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_LoadData(callback){

    //C_ResetData();
    
    uiloader.getSaveData(function(status, res){
        //success
        //  res는 object
        //  {appId : ‘’, saveData: {}, playerId: ‘’, snackId : ‘’}
        if(res != undefined)
        if(res.saveData != undefined){
           callback(res);
        }

    }, function(status, err){
         callback(err);
    });
    
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_SaveData(callback){
    //data1 : MYINFO.FLAG  , data2 : MYINFO.ISSOUND , data3 : GAMEINFO.mystonetype , data4 : GAMEINFO.mypower 
    var sdata = {"data1":MYINFO.FLAG+"","data2":MYINFO.ISSOUND+"","data3":GAMEINFO.mystonetype+"","data4":GAMEINFO.mypower+""};

    uiloader.setSaveData(sdata, function(success){
        callback();
    },function(error){
    });
}


//////////////////////////////////////////////////
//void type
//////////////////////////////////////////////////
function K_SetScene(scene){
    uiloader.setScene(scene);
}


//////////////////////////////////////////////////
//void type
//////////////////////////////////////////////////
function K_SetSceneIntro(){
    uiloader.setScene("intro", {reload: false});
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_Kakao_Finish(score, wdl, callback){
    //wdl : 21 : win   ,  22 : lose  , 23 : draw ,  24 : drop
    var ltype = wdl == 21 ?  "result" : "failed";

    uiloader.setScene(ltype, {
        addType : true, //only gomoku true  
        score : score,   //number type , 
        scoreType : "text", //_<= 요대로 하셔야 어제 화면 처럼 나옵니다. 생략하면 "승리!" 문구 쪽은 기존 디자인대로 점수가 표시 됩니다._
        code : wdl+"",//  _"21" 부터 "24"까지. 순서대로 승리, 패배, 포기, 무승부,_
        onComplete : function(res) {
            callback(res);
        }
    }); 
 
}


//////////////////////////////////////////////////
//void type
//////////////////////////////////////////////////
function K_Share(){
   
    uiloader.talkShare({score : MYINFO.TOTALSCORE});
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_ShowAD(callback){
    uiloader.ad250x250(function(status, res){callback();}, function(status, err){});
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_QuitGame(callback){

    uiloader.reportScore({code : "23", score: 0},function(status, res){
        uiloader.ad250x250(function(status, res){
            callback(res);
        }, function(status, err){});
        
    }, function(status, err){
        uiloader.ad250x250(function(status, res){
           callback(res);
        }, function(status, err){});
        
    });
}


//////////////////////////////////////////////////
//void type
//////////////////////////////////////////////////
function K_Start(){
    uiloader.gameStart(function(success, error){
        //console.log("sucess is "+success+" error is "+error);
    });
    C_KakaoLog("start");
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_KakaoIsInit(callback){
    var c_gInterval = setInterval(function checkdStatus(){
        //console.log("C_KakaoIsInit");
        if(uiloader.isInited()){
            //console.log("C_KakaoIsInit FINISH");

            clearInterval(c_gInterval);
            callback();
        }
    }, 500);
}


//////////////////////////////////////////////////
//callback type
//////////////////////////////////////////////////
function K_StartTalkBang(callback){
    uiloader.startTalkbang(function(status,res){
        callback();
    },function(status,err){

    });
    
}


//////////////////////////////////////////////////
//void type
//////////////////////////////////////////////////
function K_KakaoLog(logname){
    uiloader.actionLog(logname);
}
