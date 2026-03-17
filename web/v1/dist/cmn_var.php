<?php
define("PAGE_ADMIN_INDEX", "index");
define("PAGE_ADMIN_LOGIN", "./");
define("PAGE_ADMIN_MAIN", "main");
define("PAGE_ADMIN_REGISTER", "register");
define("PAGE_ADMIN_PASSWORD", "password");
define("PAGE_ADMIN_401", "401.html");
define("PAGE_ADMIN_404", "404.html");
define("PAGE_ADMIN_500", "500.html");


define("PAGE_HOME_PATH", "../../v1/");
define("PAGE_HOME_INDEX", "./");


define("AUTH_OTHER",-1); //알수 없는 그룹  //블랙리스트 or 불법으로 접속
define("AUTH_NOMEMBER", 0); // 비회원 그룹
define("AUTH_CUSTOMER",1); //일반고객 그룹
define("AUTH_TRANER",2); //트레이너 그룹
define("AUTH_MANAGER",3); // 관리자 그룹
define("AUTH_OPERATOR",4);  //점장/사장 그룹
define("AUTH_OWNER",5);  //운영자 그룹


define("DEV_REAL",strpos($_SERVER["REQUEST_URI"],"real") ? "_real" : "_dev");  //



?>
<script>
    
var AUTH_OTHER = -1;
var AUTH_NOMEMBER = 0;
var AUTH_CUSTOMER =1;
var AUTH_TRANER = 2;
var AUTH_MANAGER = 3;
var AUTH_OPERATOR = 4;
var AUTH_OWNER = 5;
var AUTH_SYSTEMOWNER = 7;

var AUTHNUM_PT = 55;
var AUTHNUM_GX = 51;

var savekey = null;    
var PAGE_ADMIN_INDEX = "index";
var PAGE_ADMIN_LOGIN = "./";
var PAGE_ADMIN_MAIN = "main";
var PAGE_ADMIN_REGISTER = "register";
var PAGE_ADMIN_PASSWORD = "password";
var PAGE_ADMIN_401 = "401.html";
var PAGE_ADMIN_404 = "404.html";
var PAGE_ADMIN_500 = "500.html";
var PAGE_HOME_PATH = "../../v2/";
var PAGE_HOME_INDEX = "./";
var PAGE_RESERVATION = "m_my_reservation";
var PAGE_LOGIN = "login";
var PAGE_HOME_401 = "401.html";
var PAGE_IMAGE_PATH = "../../../ssapi/img/"; 
var FILE_UPLOAD_PLACE = "../../../ssapi/adm_get.php"; 

var WORKER_PATH = "push_worker.js";

var  ClickAction = {        
    "SHOW_NOTICE" 		: "SHOW_NOTICE", // 공지사항으로 이동
    "SHOW_GOTO_SINGLE_GAME" 		: "SHOW_GOTO_SINGLE_GAME", // 싱글게임 (showDialog)
    "SHOW_GOTO_PTGX_RESERVATION"		: "SHOW_GOTO_PTGX_RESERVATION", // PT 예약정보로 가기(showDialog)
    "SHOW_GOTO_NOTICE" 		: "SHOW_GOTO_NOTICE", // 공지사항으로 이동(showDialog)
    "SHOW_GOTO_QRCODE" 		: "SHOW_GOTO_QRCODE", //QR코드 입장하기로 이동(showDialog)
    "SHOW_GOTO_TERMS_OF_SERVICE" 		: "SHOW_GOTO_TERMS_OF_SERVICE", //이용약관(showDialog)
    "SHOW_GOTO_PRIVACY_POLICY" 		: "SHOW_GOTO_PRIVACY_POLICY", //개인정보처리방침(showDialog)
    "SHOW_GOTO_HEALTH_HISTORY" 		: "SHOW_GOTO_HEALTH_HISTORY", //운동기록보기(showDialog)
    "SHOW_GOTO_MYUSERS" 		: "SHOW_GOTO_MYUSERS", //트레이너 : 나의 고객정보(showDialog)
    "SHOW_GOTO_PAYROLL" 		: "SHOW_GOTO_PAYROLL", //트레이너 : 페이롤 정보(showDialog)
    "SHOW_GOTO_HOLDING_COUPON" 		: "SHOW_GOTO_HOLDING_COUPON", //회원 : 회원권 홀딩신청(showDialog)
    "SHOW_GOTO_CHANGE_STARTTIME" 		: "SHOW_GOTO_CHANGE_STARTTIME", //회원 :시작시간변경(showDialog)
    "GOTO_SINGLE_GAME" 		: "GOTO_SINGLE_GAME", // 싱글게임
    "GOTO_PTGX_RESERVATION"		: "GOTO_PTGX_RESERVATION", // PT/GX 예약정보로 가기
    "GOTO_NOTICE" 		: "GOTO_NOTICE", // 공지사항으로 이동
    "GOTO_QRCODE" 		: "GOTO_QRCODE", //QR코드 입장하기로 이동
    "GOTO_TERMS_OF_SERVICE" 		: "GOTO_TERMS_OF_SERVICE", //이용약관
    "GOTO_PRIVACY_POLICY" 		: "GOTO_TERMS", //개인정보처리방침
    "GOTO_HEALTH_HISTORY" 		: "GOTO_HEALTH_HISTORY", //운동기록보기
    "GOTO_MYUSERS" 		: "GOTO_MYUSERS", //트레이너 : 나의 고객정보
    "GOTO_PAYROLL" 		: "GOTO_PAYROLL", //트레이너 : 페이롤 정보
    "GOTO_HOLDING_COUPON" 		: "GOTO_HOLDING_COUPON", //회원 : 회원권 홀딩신청
    "GOTO_CHANGE_STARTTIME" 		: "GOTO_CHANGE_STARTTIME" //회원 :시작시간변경
}
var ID_FREE = "무료";
var TXT_FREEPT = "[무료PT]";
var TXT_TIMEOUT = "[기간종료]";
var TXT_FREEPT_AND_TIMEOUT = "[무료&종료]";
    
var TYPE_TERM = "헬스";
var TYPE_PT = "PT";
var TYPE_GX = "그룹";
var TYPE_OTHER = "기타"; //기타상품
var CLICKTYPE = {
    none : 0,
    card : 1,
    cash : 2,
    refund : 3,
    remain : 4,
    totalprice : 5,
    new : 6,
    renewal : 7,
    totalinsert : 8,
    card_cash : 10,
    term : 11,
    count : 12,
    other : 13,
    nogetremain :14
}
var TITLE_DEFAULT = "";
var QRCODE_LOGO = "";    
var TITLE_LOGO_WHITE = "";   
//var TOSS_CLIENT_KEY = "test_ck_YoEjb0gm23PQDKMkEwWVpGwBJn5e"; //개발연동테스트상점 test key
var TOSS_CLIENT_KEY_DEV = "test_ck_jkYG57Eba3GnwPxZwgk8pWDOxmA1"; //BG tech test 
var TOSS_CLIENT_KEY = "live_ck_LBa5PzR0ArnZoklAROzrvmYnNeDM"; //BG tech real
   
//채널톡 플러그인키
//var CHANNEL_TALK_PLUGIN_KEY = "a9601079-3b42-4b8d-b460-6a547333e76e"; // neel_test
var CHANNEL_TALK_PLUGIN_KEY = "65efcbbd-73c6-44af-bb4d-155b286655e2"; // bodypass    
var help={
    "setting_membership":["setting_settingmembership0.png","setting_settingmembership1.png"],
    "setting_membership_count":["setting_settingmembership.png"]
}
var APK_DOWNLOAD_URL = "https://"+window.location.hostname+"/apk/blackgym_v2.26_vc_66.apk";
    console.log("APK_DOWNLOAD_URL "+APK_DOWNLOAD_URL);
var PLAYSTORE_URL = "https://play.google.com/store/apps/details?id=com.blackcompany.blackproject";
var APPSTORE_URL = "https://apps.apple.com/kr/app/바디패스/id1568060103";
    
var EXCEL_COUPON = "기존회원권";    
   
    
var ADM_TYPE = {
    GET_HOME_DATA : "gethomedata",
    GET_TEXT_NOTICE_LIST : "gettextnoticelist",
    UPDATE_UI_DATA : "updateuidata",
    UPDATE_CONTENT_DATA : "updatecontentdata",
    UPDATE_CONTENT_WEBPAGE_DATA : "updatecontentwebpagedata",
    UPDATE_HOME_DATA : "updatehomedata",
    UPDATE_MAIN_DATA : "updatemaindata",
    UPDATE_SAFETY_DATA : "updatesafetydata",
    INSERT_SCHOOL_CODE : "insertschoolcode",
    GET_MAIN_DATA : "getmaindata",
    UPDATE_MAIN_DATA : "updatemaindata",
    UPLOAD_CONTENT_DATA : "uploadcontentdata",
    INSERT_PROJECTID : "insertprojectid",
    GET_PROJECTIDS : "getprojectids",
    CREATE_REMOCONID : "createremoconid",
    PUSH : "push",
    UPLOAD_FILE : "uploadfile",
    
    
    
    
    GET_ALLCOMPANIES : "getallcompanies",
    GET_CATEGORY_LIST : "getcategorylist",
    GET_PRODUCT_LIST : "getproductlist",
    GET_ORDERER_LIST : "getordererlist",
    GET_CUSTOMER_LIST : "getcustomerlist",
    GET_QUOTEDOCUMENT_LIST : "getquotedocumentlist",
    GET_SEARCH_COMPANY : "getsearchcompany",
    GET_SEARCH_PRODUCT : "getsearchproduct",
    GET_ALL_ASKHISTORYDATA : "getallaskhistorydata",
    GET_QUOTEHISTORY_COUNT : "getquotehistorycount",
    GET_QUOTEHISTORY_LIST : "getquotehistorylist",
    GET_QUOTEHISTORY_DATA : "getquotehistorydata",
    GET_DOCUMENTTAG_LIST : "getdocumenttaglist",
    GET_SETTING_DATA : "getsettingdata",
    GET_ECOUNT_SEARCH_DATA : "getecountsearchdata",
    GET_ECOUNT_FILE_DATA : "getecountfiledata",
    GET_ASKHISTORY_FILE_DATAS : "getaskhistoryfiledatas",
    GET_EMAIL_TODAY : "getemailtoday",
    GET_EMAIL_BODY : "getemailbody",
    GET_EMAIL_ATTACH_LIST : "getemailattachlist",
    GET_WORKORDER_LIST : "getworkorderlist",
    GET_MAIL_ATTACH_FILE_LIST : "getmailattachfilelist",
    GET_USER_QUESTION_LIST : "getuserquestionlist",
    GET_SHORTURL : "getshorturl",    
    ADD_PRODUCTDATA : "addproductdata",
    ADD_ORDERERDATA : "addordererdata",
    ADD_CUSTOMERDATA : "addcustomerdata",
    ADD_QUOTEDOCUMENT_DATA : "addquotedocumentdata",
    ADD_QUOTEHISTORY_DATA : "addquotehistorydata",
    ADD_ASKHISTORYDATA : "addaskhistorydata",
    ADD_WORKORDERDATA : "addworkorderdata",
    EDIT_PRODUCTDATA : "editproductdata",
    EDIT_ORDERERDATA : "editordererdata",
    EDIT_CUSTOMERDATA : "editcustomerdata",
    DELETE_CATEGORY : "deletecategory",
    DELETE_PRODUCTDATA : "deleteproductdata",
    DELETE_ORDERERDATA : "deleteordererdata",
    DELETE_CUSTOMERDATA : "deletecustomerdata",
    DELETE_QUOTEDOCUMENTDATA : "deletequotedocumentdata",
    DELETE_QUOTE_AND_HISTORY : "deletequoteandhistory",
    DELETE_HD_QUOTEDOCUMENTDATA : "deletehdquotedocument",
    DELETE_WORKORDER_DATA : "deleteworkorderdata",
    UPDATE_QUOTESTATUS : "updatequotestatus",
    UPDATE_QUOTE_RETURN : "updatequotereturn",
    UPDATE_QUOTE_DEPOSIT: "updatequotedeposit",
    UPDATE_SETTING_DATA : "updatesettingdata",
    UPDATE_CUSTOMER_MEMBER : "updatecustomermember",
    UPDATE_QUESTION_DATA : "updatequestiondata",
    UPDATE_QUOTE_TAX_STATUS : "updatequotetaxstatus",
    SEND_EMAIL_DOCUMENTDATA : "sendemaildocumentdata",
    SEND_NEWSMS_MESSAGE : "sendnewsmsmessage",
    SEND_DEFAULT_EMAIL : "senddefaultemail",
    SET_ECOUNTLIST_BINDING : "setecountlistbinding",
    COPY_QUOTE_DOCUMENT : "copyquotedocument",
    SET_READ_EMAIL:"setreademail",
    ADD_POSTIT_DATA:"addpostitdata",
    DELETE_POSTIT_DATA:"deletepostitdata",
    DELETE_QUESTION_DATA:"deletequestiondata",
    UPDATE_POSTIT_DATA:"updatepostitdata",
    GET_POSTIT_LIST:"getpostitlist",
    UPDATE_MYINFO:"updatemyinfo",
    UPLOAD_FILE : "uploadfile"
  
    
}
var BASE64_PICTURE = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADQAAAA0CAMAAADypuvZAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAkZQTFRFAAAAXmBjX2BkX2FkX2FkYGFlYGFlX2BkXV9jXV5iX2BkX2FkYGFlYGFlYGFlYGFlX2FkWFpeX2BkX2FkYGFlYGFlYGFlYGFlYGFlYGFlX2FkXmBkV1lcX2FkYGFlYGFlYGFlYGFlX2FkYGFlYGFlX2BkXmBkX2FkYGFlXV9jX2FkX2FkYGFlgIGEjY6QcHF1YWJmjo6RoKCjeHl8bG1xx8fJ6urqnZ6gZ2hsYmNnoKGj////0NDShIWIdXZ62Nna/f39+/v7ra6wbG1wtba48vPz4OHhkZKVhYaJ5+fnv7/Bzc3P+fn68PDwY2RoZGVpmZmc7u7u/v7+zs7PgoOGZmdrm5uetbW3amtva2xv3d7e/P399/f3sLCy29zdoaKk9PT12trbj4+S/Pz81NTVent+6enq+fn5vr/AcXJ1paWn7+/v9fX1aWpuxMTG+vr65+fon6Ci6enpo6OmjI2Q8fHxzMzNfX2Benp+wsLE+Pj42dnaaGlt19fY7+/wr7CyaWptq6yu7u7v9vb3xMXGoaGkiouOlJSXp6iqd3h75eXmyMjK39/gh4iLtLW25OTlmJmbsrK0k5SWy8zNdXV5l5ib4uLj9/j47e3tqamsf3+Dz8/QuLi68fHy9PT0u7u929vc3t7fc3R3YGFlYGFlX2BkX2FkW11gYGFlX2BkX2FkYGFlYGFlX2FkYGFlYGFlX2FkV1lcX2FkYGFlYGFlX2FkTE5UYGFlYGFlYGFlX2FkXmBkXmBkYGFlX2FkX2FkXmBkW11hgEdV7QAAAMJ0Uk5TAAwsTF5lZi0MAiN40PH19nkBDmzD7fz/7sRtDwSE3/n+4Ifi4yIje9INLk5g/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////1T9KJgDuySF+MtH88ZQAm7FpTcB0fTps08QZFpCHwRJMEhEAAACmElEQVR4nO3WS2gTQRgH8O/fJjG7g0aDNgYbqBEfhRzsobYqtFCLiooVlOaioJQePHgU0ZPSgwepKChaBOlBtFQQFEQFJfg4ROihYi5NbVrEoomGYCvJJq2J+0g2b3fn4M3vkJ3Znd88luzMB8oH1KB6kcvlLJAKbdVfwYAUWGZFQkdOY6KyBrnVfB41KyRlaOQJySzzRUVOZls0HiY/2Kpsel5GaxqYZNbIiqUTKdDmBJOMG+thz6wMg5jIzKynEILkmAKYaH5y6gTld93ARC5DlPSgkQmcKOWBhdk5keSBVeRGKdiE/+gfoibgGy9yyx/o76+cyKN81rN8yItlK7BYOpQx2gos2YAQD/IyJIkYoiVDGaI2LCgXx68p88jrhLo7OuPJ4lDVqAPBktpOIKpcXcDb+qhLfr8BvdYDzGmljZierYtc2783PddrexunC/cdeFoPNbtSXryP5WuH8SNaeOIDHtVGXeswSW2RTeNa1Y+JYn/tuF8bHcz9jJKrBfeUirsXM9EisrVjtBY6BbxWHu96E5bNIUTmSlZLezAZrEangRdqYT8CIerc8bn0v0Nk3c2uVyG3/6OkTceV6xgTjiAYLUPyYtOhSnRy7adC19ta8bD/XYUhOobLFainM/5Kf9z9YV8gVmnI58NQGXIP4mVJ18fHlqsM0QmMRlSU35aH8DhRtuylGqjFNhFTkXYArD+DuzVaVcYAZu4oSDtqtgw8qVp3jXD14ayC+A81KQm7hfP4pNRN0Gq7neegpuGLl0Ciw8aTEgjxEfAmHySNwK+kObcvLJhWN4CjWkJ19VzWVEJFw6K8h/RpqduGWxjMGg8mXDl/DTigJ4me2IN+oyRxXDkKepWi3rBVvhP+i3mmkG6t/AcGUeKHUQzOKQAAAABJRU5ErkJggg==";
    //
var mColor = {
    WHITE : "#ffffff",
    WHITE_ALPHA5 : "#ffff55",
    YELLOW : "#fffd00",
    YELLOW_DISABLED : "#aaa900",
    Caa0000 : "#aa0000",
    Cafafaf : "#afafaf",
    Cc3da58 : "#c3da58",
    Ce36969 : "#e36969",
    Cd6d6d6 : "#d6d6d6",
    Cfffe69 : "#fffe69",
    C111111 : "#111111",
    C191919 : "#191919",
    C1e1e1e : "#1e1e1e",
    C1b1b1b : "#1b1b1b",
    C202020 : "#202020",
    C222222 : "#222222",
    C292929 : "#292929",
    C2e2e2e : "#2e2e2e",
    C333333 : "#333333",
    C3a3a3a : "#3a3a3a",
    C464646 : "#464646",
    C4444ff : "#4444ff",
    C444444 : "#444444",
    C5b5b5b : "#5b5b5b",
    C919191 : "#919191",
    Cafafaf : "#afafaf",
    Cdfdfdf : "#dfdfdf",
    
    R_OPEN :  "#fcbb1d",
    R_REQUEST :  "#2cc174",
    R_USERCHECKED :  "#5c6cf3",
    R_FINISH :  "#eb703b",
    R_OTHER :  "#555555",
    
    RA_OPEN :  "#fcbb1d22",
    RA_REQUEST :  "#2cc17422",
    RA_USERCHECKED :  "#5c6cf322",
    RA_FINISH :  "#eb703b22",
    RA_OTHER :  "#55555522",
    
    
    RGX_OPEN : "#fcbb1d", //오픈된 상태
    RGX_RESERVATION : "#164d38", // 예약함
    RGX_QRCHECKIN : "#8c9cf3", //QR출석까지 완료함
    RGX_FULL : "#eb703b",  //예약이 꽉참
    RGX_READY : "#c1ccc9" //대기신청함 (대기자에 내가 들어있음)
}
var mColorImg = {
    RGX_OPEN : "linear-gradient(to bottom, #dc9b00 0px, #fcbb1d 100%)", //오픈된 상태
    RGX_RESERVATION : "linear-gradient(to bottom, #18755c 0px, #38957c 100%)", // 예약함
    RGX_QRCHECKIN : "linear-gradient(to bottom, #5c6cf3 0px, #8c9cf3 100%)", //QR출석까지 완료함
    RGX_FULL : "linear-gradient(to bottom, #bb501b 0px, #eb703b 100%)",  //예약이 꽉참
    RGX_READY : "linear-gradient(to bottom, #a1aaa9 0px, #c1ccc9 100%)", //대기신청함 (대기자에 내가 들어있음)
    
    R_OPEN : "linear-gradient(to bottom, #dc9b00 0px, #fcbb1d 100%)",
    R_REQUEST : "linear-gradient(to bottom, #18755c 0px, #38957c 100%)",
    R_USERCHECKED : "linear-gradient(to bottom, #5c6cf3 0px, #8c9cf3 100%)",
    R_FINISH : "linear-gradient(to bottom, #e36969 0px, #e38989 100%)",
    R_OTHER : "linear-gradient(to bottom, #a1aaa9 0px, #c1ccc9 100%)"
}
//새롭게 할인가 들어간 UI 날짜
var NEW_CHANGEDAY = "2022-08-01";  // isnewstyle = compare_date(now,NEW_CHANGEDAY) >= 0 ? true : false;
var TXT_WON = "￦";  
var TXT_PERCENT = "%";  
var TXT_KORWON = "원";
//튜토리얼 status    
var TS = {
    _0_POPUP : 0,
    _1_GROUPCENTER : 1,
    _2_SETTING : 2,
    _3_SETTING_MEMBERSHIP : 3,
    _4_SETTING_ADDCOUPON : 4,
    _5_COUPON_SHOWPOPUP : 5,
    _6_DEFAULTSETTING : 6,
    _7_SETLOCKERPRICE : 7,
    _8_CONTINUELOCKER : 8,
    _9_CREATELOCKER : 9,
    _10_INSERTLOCKERDATA : 10,
    _11_SENDCOUPONPRICE : 11,
    _12_CONTINUESENDCOUPONPRICE : 12,
    _13_SETTINGSAVEPOPUP : 13,
    _14_SIGNUPTRANER : 14,
    _15_ADMINSETTING : 15,
    _16_ADMIN_SETTRANER : 16,
    _17_SETTINGGX : 17,
    _18_SETTINGGXLESSION : 18,
    _19_SETTINGSAVEPOPUP : 19,
    _20_GOTOGXPAGE : 20,
    _21_CLICKGXDATE : 21,
    _22_INSERTGXROOM : 22,
    _23_INSERTROOMPOPUP : 23,
    _24_GXGROUPCOPY : 24,
    _25_SETPAYROLL : 25,
    _26_INSERTPAROLLDATA : 26,
    _27_SETPAROLLPOPUP : 27,
    
    FINISH : 100
    
}


//
const TYPE_IMSI = "imsi";
const PERMISSION_NEW_CHAANEL = "new_channel";
const PERMISSION_REMOVE_CHAANEL = "remove_channel";
const PERMISSION_EDIT_DEFAULT = "edit_default";
const PERMISSION_EDIT_STUDY = "edit_study";
const PERMISSION_ADD_DOMAIN = "add_domain";
const PERMISSION_DELETE_DOMAIN = "delete_domain";
                
</script>
