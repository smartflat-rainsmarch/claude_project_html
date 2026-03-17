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
function loadJson(path) {
    return fetch(path)
        .then(function(response) {
            if (!response.ok) {
                throw new Error("HTTP error! status = " + response.status);
            }
            return response.json();
        })
        .then(function(data) {
            return data;   // ✅ JSON 객체 반환
        })
        .catch(function(error) {
            console.error("JSON 로드 실패:", error);
            throw error;
        });
}
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
        console.log("main.js 00");
        AJAX_AdmGet(ADM_TYPE.GET_HOME_DATA, {"projectid":param_projectid, "groupidx":param_groupidx}, function(res){
           code = parseInt(res.code);
           if (code == 100) {
                getgamedata = res.message;               
                getgamedata.hm_content_data = JSON.parse(res.message.hm_content_data);                       
                getgamedata.hm_home_data = JSON.parse(res.message.hm_home_data);                       
                getgamedata.hm_main_data = JSON.parse(res.message.hm_main_data);                       
                
               
                C_loadsound();        
                C_setFCMToken(app_fcmtoken);
                C_nextScene(SCENE_HOME); //                               
           }               
        }); 
        
//        loadJson("gamedata.json").then(function(data) {
//            console.log("JSON 데이터:", data);
//            getgamedata = data;               
//            C_loadsound();        
//            C_setFCMToken(app_fcmtoken);
//            C_nextScene(SCENE_HOME); //     
//            
//        }).catch(function(err) {
//            console.log("에러:", err);
//        });
        
         
         loadJSON("./contentdata/floor/floor.json", function(err, data) {
            if (err) {
                console.error("JSON 로드 실패:", err);
            } else {
                json_floor = data;
                
                trie_floors = [];
                
                for(var j = 0; j < 2 ; j++){  //1f, 2f
                    for(var i = 0 ; i < json_floor.floordata[j].data.length;i++){
                        var title = json_floor.floordata[j].data[i].title.replace("\n","");
                        title = title.replace("\n","");
                        title = title.replace("\n","");
                        title = title.replace("\n","");
                        var data_str = json_floor.floordata[j].fname+"|"+title+"|"+json_floor.floordata[j].data[i].event.message+"|"+json_floor.floordata[j].data[i].desc;
                        var triedata = {"idx":i+j*1000, "name":title, "data":data_str, "floor":json_floor.floordata[j].fname};
                        trie_floors.push(triedata);
                    }
                }
                for(var i = 0 ; i < trie_floors.length;i++)
                    trie_floors[i].idx = i;

                trie_floors.forEach(floor => trie.insert(floor.data, floor.idx+"|"+floor.name+"|"+floor.floor));
                
                
                console.log("trie_floors ",trie_floors);
                                
//                const testcompanies = [
//                    { "idx": 1, "name": "현대 모비스", "type": "orderer" },
//                    { "idx": 2, "name": "현대 해상", "type": "orderer" },
//                    { "idx": 3, "name": "현대 건설", "type": "orderer" },
//                ];
//                // 데이터 삽입 (모든 부분 문자열 추가)
//                testcompanies.forEach(company => trie.insert(company.name, company.idx));
//
//                // 검색 테스트
//                console.log(trie.search("모비스")); // ✅ [1]
//                console.log(trie.search("현대"));   // ✅ [1, 2, 3]
//                console.log(trie.search("해상"));   // ✅ [2]
//                console.log(trie.search("건설"));   // ✅ [3]
//                console.log(trie.search("자동차")); // ❌ []
            }
         });
        
    }, this);
    
    _LoadFontFiles();
};
function _LoadFontFiles(){
     var font_res = [
        {
            type:"font",
            name:"ChosunSg",
            srcs:["res/ChosunSg.ttf", "res/ChosunSg.ttf"]
        },
        {
            type:"font",
            name:"ChosunKg",
            srcs:["res/ChosunKg.TTF", "res/ChosunKg.TTF"]
        },
        {
            type:"font",
            name:"ChosunBg",
            srcs:["res/ChosunBg.TTF", "res/ChosunBg.TTF"]
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


    
