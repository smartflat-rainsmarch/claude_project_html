<?php?>
<?php
include('./common.php');
//echo "login session : ".$_SESSION['key'];
//echo "login authgroup : ".$_SESSION['authgroup'];
//echo "  _COOKIE ".$_COOKIE['key'];
//echo "session len :".strlen($_SESSION['key']);
//echo "cookie len :".strlen($_COOKIE['mysession']);
$session = null;
$auth = null;
$userinfo = null;
$usernamedesc = "";
if(isset($_SESSION['key'.DEV_REAL]) && isset($_SESSION['authgroup'.DEV_REAL]) && isset($_SESSION['data'.DEV_REAL])){
    $session = $_SESSION['key'.DEV_REAL];
    $auth = $_SESSION['authgroup'.DEV_REAL];
    
    $userinfo = $_SESSION['data'.DEV_REAL]['userinfo'];
//    echo "info ".$userinfo['name'];
    $id = $userinfo["id"];
    $usernamedesc = $userinfo['name'];
    
    $groupcode = $userinfo["groupcode"];
    $centercodes = $userinfo["centercodes"];
}
?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!--        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />-->
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <link rel="manifest" href="app.manifest" />
        <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
        <!-- Allow fullscreen mode on iOS devices. (These are Apple specific meta tags.) -->
         <script>
//        if( /Android/i.test(navigator.userAgent)) {
//           
//                var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }else {
//             var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=0.5, maximum-scale=2.0, minimum-scale=0.5');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }
             
      var MetaTag = document.createElement("META");
        MetaTag.setAttribute('name', 'viewport');
        MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1, minimum-scale=1');
        document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
<!--    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1" />-->
        <!--<meta name="viewport" content="width=720, user-scalable=no, minimal-ui" />-->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        
        <title>Black 홈페이지</title>
        <link href="./css/modaldialog.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
        <link rel="shortcut icon" type="image/x-icon" href="https://bodypass.co.kr/real/black/web/icon/black_arc.ico" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src='signature_pad.min.js'></script>
        <script src='signature/assets/json2.min.js'></script>
        
        <style>
             @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
            @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}

            body {
                font-family: 'Noto Sans KR', sans-serif;
    /*             font-family:  : "Noto";*/
            }
             .fsans {
                font-family: 'Noto', sans-serif;
            }    
           .fmont {
              font-family: 'Montserrat', sans-serif;
            } 
            .fmontbold {
                font-family: 'montserrat-extra-bold', sans-serif;
            }
            .mbtn {
                width:302px;;
                height:43px;
                border-radius:10px;
                background-color:#191919;

            }

            /*이미지 무한회전*/
            img.infinite_rotating_logo{
                animation: rotate_image 1s linear infinite;
                transform-origin: 50% 50%;
            }
            @keyframes rotate_image{
                100% {
                    transform: rotate(360deg);
                }
            }
          /*모달 뒷배경 뿌옇게*/
/*
        .modal-backdrop{backdrop-filter: blur(5px);background-color: #000000cc;}
        .fade.modal-backdrop.show{opacity: 0.9;}
*/
        

    </style>
</head>
<body class="sb-nav-fixed" style="background-color:black">
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
<!--    <img src='./img/splash_bg_9_16.png' style = "position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1">-->
    <img src='./img/splash_bg.png' style = "position:absolute;top:0;left:0;width:100%;height:100%;z-index:-1">
    <img src='./img/logo_bg.png' style = "position:absolute;margin-top:195px;margin-left:55px;width:80px;height:80px;z-index:-1">
    <text id="main_group_name" class ="fmontbold" style="position:absolute;margin-top:205px;margin-left:155px;color:white;font-weight:900;font-size:40px;">BLACK GYM</text>
    <div id = "div_main" style="position:absolute;padding-top:60px;width:100%;height:100%;">
        
    </div>

        setZoom();
        <!--===========================-->
        <!--반드시 삽입해야함-->
        <!--===========================-->
        <div id="div_top"></div><div id="div_nav"></div><div id="div_bottom"></div>
       
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js?ver3.02ab4"></script>
        
        <!--    테이블 관련-->
        
        <script src="./libs/tables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="./libs/tables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        
        <script>
            try{
                if(window.android)window.android.setOrientation("portrait");        
            }catch(e){}
        
            
            
        var auth = "<?php echo $auth ;?>";
        var centercodes = "<?php echo $centercodes ;?>";
        var groupcode = "<?php echo $groupcode ;?>";
        var groupname = "<?php echo $groupname ;?>";
        var centerdatas = null;
            //토스트 DIV 영역 생성
        //토스트 DIV 영역 생성
        $(document).ready(function() {
             
                var main_group_name = document.getElementById("main_group_name").innerHTML = groupname;
                var _data = {
                    "type": "center", // group or center or auth
                    "group": groupcode
                };
                if(auth >= AUTH_CUSTOMER)
                {
                        CallHandler("getdata", _data, function(res) {
                        code = parseInt(res.code);
                        clog("center getdata res is ", res);
                        if (code == 100) {


                            var arr = res.message; //centers
                            var len = arr.length;

                            centerdatas = arr;
                            init("<?php echo $auth;?>","<?php echo $id;?>");

                        } else {
                            alertMsg(res.message);
                        }

                    }, function(err) {
                        alertMsg("네트워크 에러 ");

                    });
                }else{
                     init(AUTH_NOMEMBER);
                }
             
        });
        function init(issession,sid){

            $("#div_top").load("header.php",function(){
//                    $("#div_nav").load("nav.php",function(){
//                        clog("aaabbb");
                    loginuid = "<?php echo $uid; ?>";
                    loginauth = "<?php echo $auth; ?>";
                    initToastDiv();
                    uiinit(issession,"<?php echo $usernamedesc; ?>");
                    loadMainDiv(0);
//                        clog("issession "+issession+" sid "+sid);
                    initSaveKey(sid);
                    setHeaderCenterSelect(centerdatas);
//                        startBeaconLog();
//                    });
            });
        }   
        function setReservation(){
            clog("setReservation");
        }
        </script>
        
    
    </body>
</html>
