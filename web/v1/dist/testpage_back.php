<?php session_cache_expire(14400);session_start();?>
<?php

include('common');

?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>테스트 페이지</title>
        <link href="./css/modaldialog.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="shortcut icon" type="image/x-icon" href="http://bodypass.co.kr/real/black/web/icon/black_arc.ico" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed" style="background-color: yellow;">

            
        <div id = "div_main" style="margin-top:60px">
            이곳에 표시하고 싶은것들을 삽입한다.이곳에 표시하고 싶은것들을 삽입한다.이곳에 표시하고 싶은것들을 삽입한다.<br>
            이곳에 표시하고 싶은것들을 삽입한다.이곳에 표시하고 싶은것들을 삽입한다.이곳에 표시하고 싶은것들을 삽입한다.<br>
            이곳에 표시하고 싶은것들을 삽입한다.이곳에 표시하고 싶은것들을 삽입한다.이곳에 표시하고 싶은것들을 삽입한다.<br>
        </div>

        
        <!--===========================-->
        <!--반드시 삽입해야함-->
        <!--===========================-->
        <div id="div_top"></div><div id="div_nav"></div><div id="div_bottom"></div>
       
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js?ver=1.24"></script>
        <script>
            function init(issession) {
                $("#div_top").load("header", function() {
                    $("#div_nav").load("nav", function() {
                        //토스트 DIV 영역 생성
                        initToastDiv();
                        //상단 타이틀바 로그인 했는지 안했는지 처리
                        uiinit(issession, usernamedesc);
                        //토스트 리스너 시작
                        startBeaconLog();

                    });
                });
            }  
        </script>
    </body>
</html>
<?php

    if($session != null && $auth != null && $auth >= AUTH_CUSTOMER){
//        echo "MEMBER!!!!";
        echo "<script>init($auth);</script>";

    }else{
//        echo "not MEMBER";
        echo "<script>init(0);</script>";
    }
    
?>