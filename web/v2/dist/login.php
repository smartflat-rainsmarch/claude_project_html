<?php session_cache_expire(14400);session_start();

?>
<?php
//if(!isset($_SERVER["HTTPS"])) {header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);}

include('./cmn_var.php');
//echo "login session : ".$_SESSION['key'];
//echo "login authgroup : ".$_SESSION['authgroup'];
//echo "  _COOKIE ".$_COOKIE['key'];
//echo "session len :".strlen($_SESSION['key']);
//echo "cookie len :".strlen($_COOKIE['mysession']);


//if(isset($_SESSION['key']) && isset($_SESSION['authgroup'])){
//    $auth = $_SESSION['authgroup'];
//    if($auth >= 0)
//        echo "<script>window.location = '".PAGE_HOME_INDEX."'</script>"; //로그인상태라면 메인화면으로 이동한다.
//    else
//         echo "<script>window.location = '".PAGE_HOME401."'</script>"; //로그인상태라면 메인화면으로 이동한다.
//    
////     echo "Your Auth is ".$auth; //일반회원이다. 홈페이지로 이동할 예정이다.
//}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>블랙 로그인페이지 </title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="shortcut icon" type="image/x-icon" href="https://bodypass.co.kr/real/black/web/icon/black_arc.ico" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js?ver3.02aa"></script>
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
		</style>
</head>

<body class="bg-primary">
    
    <div id="layoutAuthentication">
        
        <div align="center" id="login_logo" style='margin-top:100px;height:150px'>
            <img id='title_white' src = "./img/logo_bg.png" style='float:middle;width:90px;height:90px;float:center'/>
            <label style='float:middle;font-family: Zen Dots;font-size:30px;color:white;margin-top:10px'>BODY PASS</label>
        </div> 
        <div id="layoutAuthentication_content" style="margin-top:50px;">
            
                <div class="container">
                    <div align="center">
                        <div class="col-lg-5">
                            
                            
                            <div style='width:410px;height:360px;border-radius:20px;background-color:#ffffff;box-shadow: 0px 10px 10px 0px rgba(0, 0, 0, 0.25);'>
                                <div align="center">
                                    <label style="font-size: 24px; color:#0c0d0d;text-align:center;font-weight:700;margin-top:40px;">LOGIN</label>
                                </div>
                                <div style="margin-top:15px;">
                                  
                                        <div style="width:100%;padding-left:25px;padding-right:25px">
                                            <label style="float:left;font-size: 14px;color:#181c32;text-align:left;font-weight:600;">Email</label><br>
                                            <input id="inputEmailAddress" type="email" placeholder="Enter email address"  onkeyup='enterkey(10)' style="margin-top:-5px;border:0px;width:360px; height:45px;border-radius:10px;background-color:#f5f8fa;font-size: 14px;color:#a1a5b7;text-align:left;font-weight:600;padding-left:15px;padding-right:15px;" />
                                            <br><br>
                                            <label style="float:left;font-size: 14px;color:#181c32;text-align:left;font-weight:600;">Password</label><br>
                                            <input id="inputPassword" type="password" placeholder="Enter password"  onkeyup='enterkey(10)' style="margin-top:-5px;border:0px;width:360px; height:45px;border-radius:10px;background-color:#f5f8fa;font-size: 14px;color:#a1a5b7;text-align:left;font-weight:600;padding-left:15px;padding-right:15px;"  /><br>
                                            <button id="btn_signup" style="margin-top:28px;border:0px;width:360px; height:45px;border-radius:10px;background-color:#009ef7;font-size: 15px;color:#ffffff;text-align:center;font-weight:600;" onclick="page_login()">Login</button>
                                        </div>
                                        
                                  
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                 <div id="empty" style="width:100%; height:40px">
                    
                </div> 
                
               
           
            
        </div>
        <footer>
            <div align="center" style='width:100%'><div style='color:gray;font-size:12px;font-family:Zen Dots;text-align:center;margin-bottom:20px'><label class='fmont' style='font-size:14px;font-weight:500;color:#e9e9e9;'>Copyright &copy; 비지테크(스포츠)<br>사업자등록번호 176-37-01108 | 통신판매업신고번호 2022-안양동안-1405 | 대표 장석진<br>경기도 안양시 동안구 관평로 312, 2층 201-1호(관양동) | 유선연락처 031-388-2232</label></div></div>             
        </footer>
    </div>
   
   
</body>
</html>
<script>
    
    clog("groupcode "+TITLE_LOGO_WHITE);
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
    
        
</script>
