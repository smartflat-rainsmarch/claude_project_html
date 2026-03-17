<?php
include('./common'); 

//$uid = isset($_POST['uid']) ? $_POST['uid'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$id = isset($_POST['id']) ? $_POST['id'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$type = isset($_POST['type']) ? $_POST['type'] : '';

//$uid = "black_0000_test_name_2021-01-22 16:48:51";
//$uid = "test_uid0000";
//$id = "0000";
//$type = "membership";

?>
<!DOCTYPE html> 
<html lang="ko">
<head>
    

    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <script>

          var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=no, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
    <link rel="icon" type="image/gif/png" href="img/black_arc_logo.png">
    <title>.</title>
    <!--   signature about -->
    <style>
        body {
            font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .checkmark:after {
            left: 5px !important;
            top: 2px !important;
        }
        .sub_label{
            font-weight: bold;
            margin-top:20px;
        }
        .pt_ck{
            margin-top:-10px;
        }
    </style>
    
    <link href="./css/modaldialog.css" rel="stylesheet">
    
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
    <link rel="stylesheet" type="text/css" href="css/dd.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <script src="js/scripts.js?ver3.00a"></script>
    <script src="jquery.dd.min.js"></script>
    
    <!--결제모듈-->
    <script src="https://js.tosspayments.com/v1"></script>
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
        }
        .textevent {
            border-top: 1px solid #b2dba1;
            border-bottom: 1px solid #b2dba1;
            background-image: linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%);
            background-repeat: repeat-x;
            color: #3c763d;
            border-width: 1px;
            font-size: 1em;
            padding: 0 .75em;
            line-height: 2em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 1px;
            width:100%;
        }
        .holdingbox {
            width : 100%;
            height : 80px;
            background-image : url(./img/box_button_mainmenu.png);
            background-size: contain;
            background-repeat: no-repeat;
        }
        .fsans {
            font-family: 'Noto Sans KR', sans-serif;
        }    
       .fmont {
          font-family: 'Montserrat Alternates', sans-serif;
        } 

        .mbtn {
            width:302px;;
            height:43px;
            border-radius:10px;
            background-color:#191919;

        }
        
         
/*        //이미지 무한회전*/
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

<body >
    <text class='textevent' style='float:left'>충전금액 선택</text><select id='id_charge_price' class='form-control' ><option value='0'>=== 충전할 금액을 선택하세요 ===</option><option value='1000'>1,000원 결제</option><option value='10000'>10,000원 결제</option><option value='30000'>30,000원 결제</option><option value='50000'>50,000원 결제</option><option value='100000'>100,000원 결제</option></select><br><text class='textevent' style='float:left'>결제수단 선택</text><div class='form-control' style='height:auto'><br><br><button class='button-7' style='padding:10px'  onclick='chargeCard()' >신용카드</button>&nbsp;&nbsp;<button class='button-7' style='padding:10px'  onclick='chargeCash()' >계좌이체</button></div>
    <script>
        
    </script>
</body>
    