var _HC = 540;
var _VC = 960;
var WINSIZE_WIDTH	=	1080;				//스크린사이즈 X
var WINSIZE_HEIGHT		=1920;				//스크린사이즈 Y

var SCENE_HOME = 0;
var SCENE_MENU = 1;
var SCENE_GAME = 2;
var SCENE_HELP = 3;

var ANCHOR_LT = 0; // LEFT|TOP
var ANCHOR_CT = 1; // CENTER|TOP
var ANCHOR_RT = 2; // RIGHT|TOP
var ANCHOR_CC = 3; // CENTER|CENTER
var ANCHOR_CB = 4; // CENTER|BOTTOM
var ANCHOR_RB = 5; // RIGHT|BOTTOM
var ANCHOR_LB = 6; // LEFT|BOTTOM
var ANCHOR_LC = 7; // LEFT|CENTER
var ANCHOR_RC = 8; // RIGNT|CENTER
var IS_SHOW_POPUP = false;

var GLOBAL_PAUSE_ALL = false;

var LKEY_START = 0;
var LKEY_END = 1;
var LKEY_MACHINE_START = 2;
var LKEY_MACHINE_END = 3;
var LKKEY_RUNNING_START = 4;
var LKKEY_RUNNING_END = 5;

var MAX_MACHINE_NUM = 0;
var LOG_MACHINE_NAME = "";

var DATATYPE = {
    IMG : "img",
    TEXT : "text",
    VIDEO : "video",
    BUTTON : "button",
    BUTTON_TEST : "button_test",
    ANIMATION : "animation",
    BGCOLOR : "bgcolor",
    WEATHERAPI : "weatherapi",
    AIRAPI : "airapi"    
}
var LOG ={
    DAY : "day",
    DATE : "date",
    START : "start",
    END : "end",
    TOTAL : "total",
    HEALTHPART : "healthpart",
    MACHINES : "machines",
    ISSENDDATA : "issenddata"
    
}
//현재 사용하지 않음 나중에 사용할 예정
var SAVEDATA = {
    RUNTYPE : 0,  //달리기 타입
    HEALTH_SPEED : 4, //기구 들어올리는 속도

}

var RUNNINGTYPE = [
            [       //일반모드
                {runningAnimSpeed:0.3,arrowAnimSpeed:0.35,time:0,speed:4.5,txt_desc:"천천히 걷기"},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.2,time:60,speed:6,txt_desc:"빠르게 걷기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:180,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.2,time:300,speed:6,txt_desc:"빠르게 걷기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:360,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.05,arrowAnimSpeed:0.07,time:480,speed:12,txt_desc:"전속력 질주!!",isshowaura:true},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.4,time:540,speed:6,txt_desc:"빠르게 걷기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:610,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.2,time:680,speed:6,txt_desc:"빠르게 걷기"},
                {runningAnimSpeed:0.3,arrowAnimSpeed:0.35,time:840,speed:4.5,txt_desc:"천천히 걷기"}
            ],
            [       //걷기모드
                {runningAnimSpeed:0.3,arrowAnimSpeed:0.5,time:0,speed:3,txt_desc:"느리게 걷기"},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.35,time:60,speed:5,txt_desc:"천천히 걷기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.2,time:180,speed:6,txt_desc:"빠르게 걷기"},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.35,time:480,speed:5,txt_desc:"천천히 걷기"},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.5,time:540,speed:5,txt_desc:"느리게 걷기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.2,time:610,speed:6,txt_desc:"빠르게 걷기"},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.35,time:840,speed:5,txt_desc:"천천히 걷기"}
            ],
            [       //뛰기모드                
                {runningAnimSpeed:0.15,arrowAnimSpeed:0.16,time:0,speed:7,txt_desc:"가볍게 뛰기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:180,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.15,arrowAnimSpeed:0.16,time:300,speed:7,txt_desc:"가볍게 뛰기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:360,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.16,time:540,speed:7,txt_desc:"가볍게 뛰기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:610,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.2,arrowAnimSpeed:0.16,time:680,speed:7,txt_desc:"가볍게 뛰기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.2,time:840,speed:6,txt_desc:"빠르게 걷기"},
            ],
            [    //파워모드
                 {runningAnimSpeed:0.2,arrowAnimSpeed:0.16,time:0,speed:7,txt_desc:"가볍게 뛰기"},
                 {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:180,speed:9,txt_desc:"RUN!!",isshowaura:true},
                 {runningAnimSpeed:0.05,arrowAnimSpeed:0.07,time:300,speed:12,txt_desc:"전속력 질주!!",isshowaura:true},
                 {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:360,speed:9,txt_desc:"RUN!!",isshowaura:true},
                 {runningAnimSpeed:0.05,arrowAnimSpeed:0.07,time:480,speed:12,txt_desc:"전속력 질주!!",isshowaura:true},
                 {runningAnimSpeed:0.2,arrowAnimSpeed:0.4,time:540,speed:4.5,txt_desc:"천천히 걷기"},
                 {runningAnimSpeed:0.2,arrowAnimSpeed:0.16,time:610,speed:7,txt_desc:"가볍게 뛰기"},
                 {runningAnimSpeed:0.05,arrowAnimSpeed:0.07,time:780,speed:12,txt_desc:"전속력 질주!!",isshowaura:true},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.2,time:840,speed:6,txt_desc:"빠르게 걷기"}
            ],
            [   //극한모드
                {runningAnimSpeed:0.15,arrowAnimSpeed:0.16,time:0,speed:7,txt_desc:"가볍게 뛰기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:10,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.05,arrowAnimSpeed:0.07,time:60,speed:12,txt_desc:"전속력 질주!!",isshowaura:true},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:410,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.15,arrowAnimSpeed:0.16,time:540,speed:7,txt_desc:"가볍게 뛰기"},
                {runningAnimSpeed:0.1,arrowAnimSpeed:0.12,time:610,speed:9,txt_desc:"RUN!!",isshowaura:true},
                {runningAnimSpeed:0.05,arrowAnimSpeed:0.07,time:690,speed:12,txt_desc:"전속력 질주!!",isshowaura:true},
                {runningAnimSpeed:0.15,arrowAnimSpeed:0.16,time:840,speed:7,txt_desc:"가볍게 뛰기"}
            ]
            
            
        ];
var IS_TODAY_ALL_FINISH = false;
var RUNNING_TIME = 10;
var TODAY_HEALTH_DATA = null;

//healthdata_1 , healthdata_2 , healthdata_3 ...   HEALTH_LOG = healthdata_
//운동 로그기록  시작시간 , 끝시간 , 총운동시간 , 운동부위 , 운동한 기구들 [{name: "", starttime :"", endtime :""}, ]
var HEALTH_LOG = {day:0,date:"",start:"",end:"",total:"",healthpart:"",machines:[],issenddata:false};

var BTN_START_PAUSE_STATE = {
    HIDE : 0,
    START: 1,
    PAUSE: 2    
}
var WEIGHT_MODEL_IDS = [];
var SOUND = {
    SIGN:"01",
    CASH:"08",
    COUNTDOWN:"09",
    CLOCK:"13",
    BGM:"game_bgm",
    LAST1:"last1",    
    READY:"ready",    
    START:"start",    
    S1:"s1",
    S2:"s2",
    S3:"s3",
    S4:"s4",
    S5:"s5",
    S6:"s6",
    S7:"s7",
    S8:"s8",
    S9:"s9",
    S10:"s10",
    S11:"s11",
    S12:"s12",
    S13:"s13",
    S14:"s14",
    S15:"s15",
    S16:"s16",
    S17:"s17",
    S18:"s18",
    S19:"s19",
    S20:"s20",
    S21:"s21",
    S22:"s22",
    S23:"s23",
    S24:"s24",
    S25:"s25",
    S26:"s26",
    S27:"s27",
    S28:"s28",
    S29:"s29",
    S30:"s30",
    SND_BUTTONTOUCH:"05",
    DEVIL:"devil"

    
};

var plist_all_datas = {
     "button_close.png":{},
    "button_close_press.png":{}
};
var ID = {
    //Layers ID  
    BTN_EXIT : 1000,
    LAYER_HELP_MENU : 1023,
    POPUP_LAYER_MACHINE : 1024
    
};
var KEY = {
    HELP_LAYER: "HELP_LAYER"
  


};
var MYINFO = {
    ISSOUND: true,
  
};
var GAMEINFO = {
    mystonetype : 0,  //0: black  1: white
    mypower : 0,
    jangi_position_type : 0, // blue :  0 ~ 3 ,  red : 4 ~ 7
    jangi_advantage_type : 0,  // 0 : type same , 1: type advantage
    nScore : 0,
    nDiff   : 0,
    nAi     : 0,
    item_guide : 0, //guide item
    item_addtime : 0, // add time item
    item_unlimited_time : 0
};
var NCoin = 0;
var Color3B = {
    WHITE:cc.color(255,255,255,255),
    GRAY:cc.color(128,128,128,255),
    LIGHT_GRAY:cc.color(198,198,198,255),
    DARK_GRAY:cc.color(78,78,78,255),
    RED : cc.color(255,0,0,255),
    YELLOW : cc.color(255,255,0,255)
};
var help_layer = {
  
    btns: [
        {"id":ID.BTN_EXIT, "on":"button_close.png","off":"button_close_press.png","x":30, "y":-970,"ah":ANCHOR_LT}
    ]
};

var ADM_TYPE = {
    GET_HOME_DATA : "gethomedata",
    GET_AIR_DATA : "getairdata",
    GET_WEATHER_DATA: "getweatherdata"
}