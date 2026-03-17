<?php
define("PAGE_HOME_INDEX", "index.php");
define("PAGE_HOME_LOGIN", "login.php");
define("PAGE_HOME_MAIN", "main.php");
define("PAGE_HOME_REGISTER", "register.php");
define("PAGE_HOME_PASSWORD", "password.php");
define("PAGE_HOME_401", "401.html");
define("PAGE_HOME_404", "404.html");
define("PAGE_HOME_500", "500.html");


define("PAGE_ADMIN_PATH", "../../v1/");
define("PAGE_ADMIN_INDEX", "index.html");

define("COMPARE_SAME", 0);
define("COMPARE_DIF", 1);

define("AUTH_OTHER",-1); //알수 없는 그룹  //블랙리스트 or 불법으로 접속
define("AUTH_NOMEMBER", 0); // 비회원 그룹
define("AUTH_CUSTOMER",1); //일반고객 그룹
define("AUTH_TRANER",2); //트레이너 그룹
define("AUTH_MANAGER",3); // 관리자 그룹
define("AUTH_OPERATOR",4);  //운영자 그룹
define("AUTH_OWNER",5);  //소유자 그룹


define("DEV_REAL",strpos($_SERVER["REQUEST_URI"],"real") ? "_real" : "_dev");  //
?>
<script>
    

const AUTH_OTHER = -1;
const AUTH_NOMEMBER = 0;
const AUTH_CUSTOMER =1;
const AUTH_TRANER = 2;
const AUTH_MANAGER = 3;
const AUTH_OPERATOR = 4;
const AUTH_OWNER = 5;
    
var savekey = null;    
var PAGE_HOME_INDEX = "index.php";
var PAGE_RESERVATION = "m_my_reservation.php";
var PAGE_HOME_LOGIN = "login.php";
var PAGE_HOME_MAIN = "main.php";
var PAGE_HOME_REGISTER = "register.html";
var PAGE_HOME_PASSWORD = "password.html";
var PAGE_HOME_401 = "401.html";
var PAGE_HOME_404 = "404.html";
var PAGE_HOME_500 = "500.html";
var PAGE_ADMIN_PATH = "../../v1/";
var PAGE_ADMIN_INDEX = "index.html";
var PAGE_IMAGE_PATH = "../../../ssapi/img/"; 
    
var TXT_WON = "￦";  
var TXT_PERCENT = "%";  
var TXT_KORWON = "원";
var ClickAction = {        
    "SHOW_NOTICE" 		: "SHOW_NOTICE", // 공지사항으로 이동
    "SHOW_GOTO_SINGLE_GAME" 		: "SHOW_GOTO_SINGLE_GAME", // 싱글게임 (showDialog)
    "SHOW_GOTO_PTGX_RESERVATION"		: "SHOW_GOTO_PTGX_RESERVATION", // PT/GX 예약정보로 가기(showDialog)
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
    
 var CHANGE_TYPE_STARTTIME = "starttime";
 var CHANGE_TYPE_HOLDING = "holding";
var ID_FREE = "무료";    
var TXT_FREEPT = "[무료PT]";
var TXT_TIMEOUT = "[기간종료]";
var TXT_FREEPT_AND_TIMEOUT = "[무료&종료]";
   
var TYPE_TERM = "헬스";
var TYPE_PT = "PT";
var TYPE_GX = "그룹";
var TYPE_OTHER = "기타";
    
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
var TITLE_LOGO_DEFAULT = "";
var TITLE_LOGO_WHITE = "";   

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

</script>
