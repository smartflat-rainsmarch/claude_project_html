<?php session_cache_expire(14400);session_start();?>
<?php
//if(!isset($_SERVER["HTTPS"])) {header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);}

date_default_timezone_set('Asia/Seoul');

include('./cmn_var.php');
include('./cmn_func.php');
//echo "login session : ".$_SESSION['key'];
//echo "login authgroup : ".$_SESSION['authgroup'];
//echo "  _COOKIE ".$_COOKIE['key'];
//echo "session len :".strlen($_SESSION['key']);
//echo "cookie len :".strlen($_COOKIE['mysession']);


if(isset($_SESSION['key'.DEV_REAL]) && isset($_SESSION['authgroup'.DEV_REAL])){
    $auth = $_SESSION['authgroup'.DEV_REAL];
    if($auth > 1)
        echo "<script>window.location = '".PAGE_ADMIN_MAIN."'</script>"; //로그인상태라면 메인화면으로 이동한다.
    else if($auth == 1 || $auth == 0)
        echo "<script>window.location = '".PAGE_HOME_PATH+""+PAGE_HOME_INDEX."'</script>"; //로그인상태라면 홈페이지 메인화면으로 이동한다.
    else
        echo "<script>window.location = '".PAGE_ADMIN_401."'</script>"; //로그인상태라면 에러화면으로  이동한다.
    
//     echo "Your Auth is ".$auth; //일반회원이다. 홈페이지로 이동할 예정이다.
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>로그인페이지 </title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="./img/border_CenterImage.ico" />
<!--    <link rel="icon" type="image/png" href="http://example.com/myicon.png">-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js?ver3.00a"></script>
    <link href='https://fonts.googleapis.com/css?family=Zen Dots' rel='stylesheet'>
    
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> <!--Montserrat 폰트설정-->
    <style>
        @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
        @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}
    
         body {
/*            font-family: 'Noto Sans KR', sans-serif;*/
             font-family: 'Montserrat', sans-serif;
        }
         .fsans {
            font-family: 'Noto', sans-serif;
        }    
       .fmont {
          font-family: 'Montserrat', sans-serif;
        } 
			img { display: block; margin: 0px auto; }
        #logo_ring {
            animation: rotate_image 2s linear infinite;
            transform-origin: 50% 50%;
        }

        @keyframes rotate_image {
            100% {
                transform: rotate(360deg);
            }
        }
		</style>
</head>

<body style="background-color:#031535">
    
    <div id="layoutAuthentication">
        
        <div align="center" id="login_logo" style='margin-top:50px;height:150px'>
            <div id="div_logo" style="width:90px;height:90px">
                <img id='title_logo' src = "./img/logo_bg.png" style='position:absolute;width:90px;height:90px'/>
                <img id='logo_ring' src = "./img/border_CenterImage.png" style='position:absolute;width:90px;height:90px'/>
            </div>
            <label id='lbl_title' style='float:middle;font-family: Zen Dots;font-size:30px;color:white;margin-top:10px'>SMARTFLAT</label>&nbsp;&nbsp;&nbsp;<text id="txt_title" style="font-size:40px;color:#b4b3ff;font-weight:bold">HTML</text>
        </div> 
        
        <div id="layoutAuthentication_content" >
            
                <div class="container">
                    <div align="center">
                        <div class="col-lg-5">
                            
                            
                            <div style='width:100%;max-width:410px;height:380px;border-radius:20px;background-color:#ffffff;box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.25);'>
                                <div align="center">
                                    <label style="font-size: 24px; color:#0c0d0d;text-align:center;font-weight:700;margin-top:40px;">LOGIN</label>
                                </div>
                                <div style="margin-top:15px;">
                                  
                                        <div style="width:100%;padding-left:25px;padding-right:25px">
                                            <label style="float:left;font-size: 14px;color:#181c32;text-align:left;font-weight:600;">Email</label><br>
                                            <input id="inputEmailAddress" type="email" placeholder="Enter email address"  onkeyup='enterkey(10)' style="margin-top:-5px;border:0px;width:100%;max-width:360px; height:45px;border-radius:10px;background-color:#f5f8fa;font-size: 14px;color:#a1a5b7;text-align:left;font-weight:600;padding-left:15px;padding-right:15px;" />
                                            <br><br>
                                            <label style="float:left;font-size: 14px;color:#181c32;text-align:left;font-weight:600;">Password</label><br>
                                            <input id="inputPassword" type="password" placeholder="Enter password"  onkeyup='enterkey(10)' style="margin-top:-5px;border:0px;width:100%;max-width:360px; height:45px;border-radius:10px;background-color:#f5f8fa;font-size: 14px;color:#a1a5b7;text-align:left;font-weight:600;padding-left:15px;padding-right:15px;"  /><br>
                                            <button id="btn_signup" style="margin-top:28px;border:0px;width:100%;max-width:360px; height:45px;border-radius:10px;background-color:#009ef7;font-size: 15px;color:#ffffff;text-align:center;font-weight:600;outline:none" onclick="page_login()">Login</button>
                                        </div>
                                        
                                  
                                </div>
                               
                                
                            </div>
                            <div style='width:100%;max-width:410px;'>
                                <table  width="100%;max-width:420px" style="'width:100%;max-width:420px;font-size:14px;">
                                  <tr>
                                    <td align="left" style="padding-top:14px;padding-left:30px;"><a href="./findidpass" style="color:#ffffff">Find ID</a></td>
                                    <td align="right" style="padding-top:14px;padding-right:30px;"><a href="./findidpass?type=pass" style="bold;color:#ffffff">Find Password</a></td>
                                  </tr>
                                  <tr>
                                     <td></td>
                                      <td align="right" style="padding-top:14px;padding-right:30px;"><a href="./join" style="font-weight:bold;color:#ffffff">회원가입</a></td>
                                  </tr>
                                </table>
                            </div>
                        </div>
          
                    </div>
                    
                </div>
                
                <div id="empty" style="width:100%; height:40px">
                    
                </div>
                
               
           
            
        </div>
        <footer>
            <div align="center" style='width:100%'><div style='color:gray;font-size:12px;font-family:Zen Dots;text-align:center;margin-bottom:20px'><label class='fmont' style='font-size:14px;font-weight:500;color:#e9e9e9;'>Copyright &copy; (주)스마트플랫<br>서울시 금천구 가산디지털1로 128 STX-V타워 314호 </label></div></div>            
        </footer>
    </div>
   
   
</body>

</html>
<script>
    
    function initLogoSize(){
        var screen_width = $(window).width();
        var screen_height = $(window).height();
        
        var div_logo = document.getElementById("div_logo");
        var title_logo = document.getElementById("title_logo");
        var logo_ring = document.getElementById("logo_ring");
        var lbl_title = document.getElementById("lbl_title");
        
        var mSize = 90;
        var fontSize = 30;
        if(screen_width < 300){
            mSize = 40;
            fontSize = 20;
        }else if(screen_width < 400){
             mSize = 50;
            fontSize = 22;
        }else if(screen_width < 500){
             mSize = 60;
            fontSize = 24;
        }else if(screen_width < 700){
             mSize = 70;
            fontSize = 26;
        }else if(screen_width < 900){
             mSize = 80;
            fontSize = 28;
        }else{
             mSize = 90;
            fontSize = 30;
        }
        
        
        div_logo.style = "width:"+mSize+"px;height:"+mSize+"px";
        title_logo.style = "position:absolute;width:"+mSize+"px;height:"+mSize+"px";
        logo_ring.style = "position:absolute;width:"+mSize+"px;height:"+mSize+"px";
        lbl_title.style="float:middle;font-family: Zen Dots;font-size:"+fontSize+"px;color:white;margin-top:10px";
        txt_title.style="font-size:"+(fontSize+5)+"px;color:#b4b3ff;font-weight:bold";
        
    }
    clog("groupcode "+TITLE_LOGO_WHITE+" groupcode "+getData("nowgroupcode"));
    if(TITLE_LOGO_WHITE){
        clog("login ddd");
        var title_white = document.getElementById("title_white");    
        title_white.src = TITLE_LOGO_WHITE;
    }
    
    
    function enterkey(type) {
         if(window.event.keyCode == 13) {
             switch (type) {
                 case 10:
                     // 엔터키가 눌렸을 때 실행할 내용
                     page_login();
                     break;                 
             }
         }
     }
    setBtnEventColor("btn_signup","#009ef7","#29acf6","#52baf5");
    initLogoSize();
//    $( "#btn_signup" ).bind("touchstart",function(){
//        $(this).css("background-color", "#29acf6");
//    });
//    $( "#btn_signup" ).bind("touchend",function(){
//        $(this).css("background-color", "#009ef7");
//    });
//
//    $( "#btn_signup" ).mouseover(function(){
//         $(this).css("background-color", "#52baf5");
//    });
//
//    $( "#btn_signup" ).mouseout(function(){
//         $(this).css("background-color", "#009ef7");
//    });
//    $( "#btn_signup" ).mousedown(function(){
//        $(this).css("background-color", "#29acf6");
//    });
//     $( "#btn_signup" ).mouseup(function(){
//         $(this).css("background-color", "#009ef7");
//    });
    
</script>
