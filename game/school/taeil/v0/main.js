/**
 * A brief explanation for "project.json":
 * Here is the content of project.json file, this is the global configuration for your game, you can modify it to customize some behavior.
 * The detail of each field is under it.
 {
    "project_type": "javascript",
    // "project_type" indicate the program language of your project, you can ignore this field

    "debugMode"     : 1,
    // "debugMode" possible values :
    //      0 - No message will be printed.
    //      1 - cc.error, cc.assert, cc.warn, cc.log will print in console.
    //      2 - cc.error, cc.assert, cc.warn will print in console.
    //      3 - cc.error, cc.assert will print in console.
    //      4 - cc.error, cc.assert, cc.warn, cc.log will print on canvas, available only on web.
    //      5 - cc.error, cc.assert, cc.warn will print on canvas, available only on web.
    //      6 - cc.error, cc.assert will print on canvas, available only on web.

    "showFPS"       : true,
    // Left bottom corner fps information will show when "showFPS" equals true, otherwise it will be hide.

    "frameRate"     : 60,
    // "frameRate" set the wanted frame rate for your game, but the real fps depends on your game implementation and the running environment.

    "id"            : "gameCanvas",
    // "gameCanvas" sets the id of your canvas element on the web page, it's useful only on web.

    "renderMode"    : 0,
    // "renderMode" sets the renderer type, only useful on web :
    //      0 - Automatically chosen by engine
    //      1 - Forced to use canvas renderer
    //      2 - Forced to use WebGL renderer, but this will be ignored on mobile browsers

    "engineDir"     : "frameworks/cocos2d-html5/",
    // In debug mode, if you use the whole engine to develop your game, you should specify its relative path with "engineDir",
    // but if you are using a single engine file, you can ignore it.

    "modules"       : ["cocos2d"],
    // "modules" defines which modules you will need in your game, it's useful only on web,
    // using this can greatly reduce your game's resource size, and the cocos console tool can package your game with only the modules you set.
    // For details about modules definitions, you can refer to "../../frameworks/cocos2d-html5/modulesConfig.json".

    "jsList"        : [
    ]
    // "jsList" sets the list of js files in your game.
 }
 *
 */

cc.game.onStart = function(){
    
//    var canvas = document.getElementById('gameCanvas');
//    var ctx = canvas.getContext('2d');
//    ctx.mozImageSmoothingEnabled = true;
//    ctx.webkitImageSmoothingEnabled = true;
//    ctx.msImageSmoothingEnabled = true;
//    ctx.imageSmoothingEnabled = true;
    
    // Pass true to enable retina display, disabled by default to improve performance
    cc.view.enableRetina(true);
    
    cc.director.setDisplayStats(false);
    // Adjust viewport meta
    cc.view.adjustViewPort(false);
    // Setup the resolution policy and design resolution size
     cc.view.setDesignResolutionSize(param_sw, param_sh, cc.ResolutionPolicy.SHOW_ALL);
    // The game will be resized when browser size change
    cc.view.resizeWithBrowserSize(true);
    //load resources
    cc.LoaderScene.preload(resources, function () {
        console.log("main.js");
       
                   

        AJAX_AdmGet(ADM_TYPE.GET_HOME_DATA, {"projectid":param_projectid, "groupidx":param_groupidx}, function(res){
           code = parseInt(res.code);
           if (code == 100) {
                getgamedata = res.message;    
                language_code = getgamedata.hm_language;
                var floor_path = language_code == "EN" ? "./contentdata/floor/floor_en.json" : "./contentdata/floor/floor.json";
                loadJSON(floor_path, function(err, data) {
                    if (err) {
                        console.error("JSON 로드 실패:", err);
                    } else {
                        json_floor = data;



                        if(res.lyricsdata){
                            var data = res.lyricsdata.lr_data ? JSON.parse(res.lyricsdata.lr_data) : {};
                            param_subtitle = res.lyricsdata.lr_subtitle;
                            if(data.lyrics)param_lyrics = data.lyrics;
                            if(data.level)param_level = parseInt(data.level);
                            if(data.musicurl)SOUND.BGM = data.musicurl.replace(".mp3","");
                            if(data.issoundon)isPlaySound = data.issoundon == "1" ? true : false;      
                            if(data.isword)param_isword = data.isword == "1" ? true : false;
                        }                              
                        C_loadsound();        
                        C_setFCMToken(app_fcmtoken);
                        C_nextScene(SCENE_HOME); //                               
                    }               
                }); 
                       
            }
        });
        getReservationList(1,500,"reservation",function(list){
            console.log("예약현황 목록",list);
        });
        
    }, this);
        
    
    _LoadFontFiles();
};
//function _LoadFontFiles(){
//     var font_res = [
//        {
//            type:"font",
//            name:"ChosunSg",
//            srcs:["res/ChosunSg.ttf", "res/ChosunSg.ttf"]
//        },
//        {
//            type:"font",
//            name:"ChosunKg",
//            srcs:["res/ChosunKg.TTF", "res/ChosunKg.TTF"]
//        },
//        {
//            type:"font",
//            name:"ChosunBg",
//            srcs:["res/ChosunBg.TTF", "res/ChosunBg.TTF"]
//        }
//    ];
//    cc.loader.load(font_res, function (result, count, loadedCount) {
////        console.log("loaded custom font!!");
//    });
//}
function _LoadFontFiles(){
     var font_res = [
        {
            type:"font",
            name:"현대하모니L",
            srcs:["res/현대하모니L.ttf", "res/현대하모니L.ttf"]
        },
        {
            type:"font",
            name:"현대하모니M",
            srcs:["res/현대하모니M.TTF", "res/현대하모니M.TTF"]
        },
        {
            type:"font",
            name:"현대하모니B",
            srcs:["res/현대하모니B.TTF", "res/현대하모니B.TTF"]
        }
    ];
    cc.loader.load(font_res, function (result, count, loadedCount) {
//        console.log("loaded custom font!!");
    });
}
//function _LoadFontFiles(){
//     var font_res = [
//        {
//            type:"font",
//            name:"Lato",
//            srcs:["res/Lato-Regular.ttf", "res/Lato-Regular.ttf"]
//        },
//        {
//            type:"font",
//            name:"LatoBold",
//            srcs:["res/LATO-BOLD.TTF", "res/LATO-BOLD.TTF"]
//        }
//    ];
//    cc.loader.load(font_res, function (result, count, loadedCount) {
////        console.log("loaded custom font!!");
//    });
//}
cc.game.run();


    
