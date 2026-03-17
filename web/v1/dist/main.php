<?php 
include('./common.php'); 
$version = time(); // 또는 데이터베이스에서 관리하는 버전 번호
$scriptsFile = "js/scripts.js?v=$version";
$postitFile = "libs/postit/app.js?v=$version";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,  shrink-to-fit=no ,initial-scale=0.5, maximum-scale=1, minimum-scale=0.5"/>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>관리자 페이지</title>
    <link href="./css/w3.css" rel="stylesheet">
    <link href="./css/toast.css" rel="stylesheet">
    <link href="./css/modaldialog.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <link href="./css/toggle.css" rel="stylesheet">
    <link href="./css/buttons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/checkbox.css">
    <link rel="shortcut icon" type="image/x-icon" href="./img/border_CenterImage.ico" />
    <script src="https://kit.fontawesome.com/44795f2086.js" crossorigin="anonymous"></script>

    
    <script>
        const isTablet = /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(navigator.userAgent);
        if(!isTablet) {
           
                var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=1 minimum-scale=1');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
        }else {
             var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=0.7, maximum-scale=0.7, minimum-scale=0.7');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
        }
    </script>
    
    
    <!--폰트관련-->
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>-->
    <script src="./libs/fonts/all.min.js" crossorigin="anonymous"></script>
    <!--엑셀파일 관련-->
    <script src="./libs/xlsx/xlsx.full.min.js"></script>
    <script src="./libs/xlsx/FileSaver.js"></script>
    <script src="./libs/xlsx/tableexport.min.js"></script>
    <script src="./libs/visualqrcode/qrcode.js"></script>
    <script src="./libs/visualqrcode/qart.js"></script>
  
    <!--결제모듈-->
    <script src="https://js.tosspayments.com/v1"></script>
    

    <!--미니달력-->
      <link rel="stylesheet" href="libs/minicalendar/css/common.css">
      <link rel="stylesheet" href="libs/minicalendar/css/reset.css">
      
      <script src="libs/minicalendar/js/data.js"></script>
    
<!--    <script src="saveexcel.js"></script>    -->
    
    
    <!--포스트잇-->
    <link rel="stylesheet" href="libs/postit/app.css">
<!--
    <link rel="stylesheet" href="libs/postit/app.css">
    <link rel="stylesheet" href="libs/postit/app.js">
-->
     <!--swipe-->
<!--
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
-->
    <link href="./libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="./libs/swiper/swiper-bundle.min.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> <!--Montserrat 폰트설정-->
    
    
    
    
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>-->
     <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script><!--이메일체크 아이콘-->
<!--    <script src="jquery.dd.min.js"></script>-->
<!--    <script src="./libs/visualqrcode/qart.js"></script>-->
    
    <style>
         @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
        @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}
    
         body {
            font-family: 'Noto Sans KR', sans-serif;
/*             font-family: 'Montserrat', sans-serif;*/
        }
         .fsans {
            font-family: 'Noto', sans-serif;
        }    
       .fmont {
          font-family: 'Montserrat', sans-serif;
        } 
/*오른쪽 회원검색 화면*/
        #wrapper{
/*            border:1px solid #ffbb00;*/
            width:100%;
            
            position:absolute;
            top:70px;
            left:10px;
            
            overflow:hidden;
        }
        #div_main{

            width:100%;
            display: inline-block;
            
        }

        @media (max-width: 768px) {
            #div_main {
                margin-left: 60px !important;
            }
        }

        
   
        .text_style {
            width:100%;
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
        .othertextevent {
           font-family: "Noto Sans KR";
           font-size:15px; color:#3f4254;
           font-weight:500;
            padding-top:20px;
        }
        .comboevent {
            background-repeat: repeat-x;
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

        #div_bottom{
          position: fixed;
          left: 0;
          right: 0;
          bottom: 0;

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
        
        /*인풋 넘버 위아래 숫자늘리고 감소시키는 화살표 없애기*/
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        
        /*모달 뒷배경 뿌옇게*/
/*
        .modal-backdrop{backdrop-filter: blur(5px);background-color: #000000cc;}
        .fade.modal-backdrop.show{opacity: 0.9;}
*/
        .blur-image {
          /* The image used */
          background-image: url("photographer.jpg");

          /* Add the blur effect */
          filter: blur(8px);
          -webkit-filter: blur(8px);

          /* Full height */
          height: 100%; 

          /* Center and scale the image nicely */
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        }
        

        /*말풍선 왼쪽*/
        .lefttip {
            width: 110px;         /*전체를 감싸는 크기를 아이콘 크기로 맞춤*/
            height: 110px;
            margin: 10px;
            position: relative;
            z-index: 9999999;
        }
        .lefttip span{
            position: absolute;  /*어떤 요소에 absolute를 주면 블럭요소는 inline으로 변경됨.*/
            background-color: #000;
            width: 300px;
            color : #fff;
            top : 30px;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            left: 50%;                    /*중앙배치 : 왼쪽에서 50%위치*/
            transform: translateX(-20%);  /*중앙배치 : X크기값을 50%만큼 이동*/
            opacity: 0;                   /*이벤트설정 : 서서히 변하게 함*/
            transition: 0.5s;             /*어떤 변화가 요청되면 0.5초뒤에 일어나자.*/
            visibility: hidden;          /*특정 요소 접촉시 이벤트 발생*/
             z-index: 9999999;
        }
         .lefttip span:after {
            content : '';             /*가상클래스 before, after는 무조건 content가 있어야 작동*/
            position: absolute;       /*상위클래스icon이 relative이므로, absolute로 설정하여 동적페이지에도 같은 위치로 유지*/
            background-color:#000;
            width : 10px;
            height: 10px;
            transform: rotate(45deg) translateX(-50%);  /*transform은 한 요소에 1번밖에 못쓰므로 합쳐줘야함*/
            top: 0px;
            left: 20%;                                  /*1. 세모를 왼쪽에서 50%위치에 둔다.*/
            z-index: 9999999;                                           /*2. 크기값을 50%만큼 이동시켜준다.->항상 중앙에 위치하게됨*/

        }
         .lefttip:hover span{
            opacity: 0.9;
            visibility: visible;     /*hover시 발생하ㅡㄴ 이벤트*/

        }
		/*말풍선 오른쪽*/
        .righttip {
            width: 110px;         /*전체를 감싸는 크기를 아이콘 크기로 맞춤*/
            height: 110px;
            margin: 10px;
            position: relative;
            z-index: 9999999;
        }
        .righttip span{
            position: absolute;  /*어떤 요소에 absolute를 주면 블럭요소는 inline으로 변경됨.*/
            background-color: #000;
            width: 300px;
            color : #fff;
            top : 30px;
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            left: 50%;                    /*중앙배치 : 왼쪽에서 50%위치*/
            transform: translateX(-80%);  /*중앙배치 : X크기값을 50%만큼 이동*/
            opacity: 0;                   /*이벤트설정 : 서서히 변하게 함*/
            transition: 0.5s;             /*어떤 변화가 요청되면 0.5초뒤에 일어나자.*/
            visibility: hidden;          /*특정 요소 접촉시 이벤트 발생*/
             z-index: 9999999;
        }
         .righttip span:after {
            content : '';             /*가상클래스 before, after는 무조건 content가 있어야 작동*/
            position: absolute;       /*상위클래스icon이 relative이므로, absolute로 설정하여 동적페이지에도 같은 위치로 유지*/
            background-color:#000;
            width : 10px;
            height: 10px;
            transform: rotate(45deg) translateX(-50%);  /*transform은 한 요소에 1번밖에 못쓰므로 합쳐줘야함*/
            top: 0px;
            left: 80%;                                  /*1. 세모를 왼쪽에서 50%위치에 둔다.*/
            z-index: 9999999;                                           /*2. 크기값을 50%만큼 이동시켜준다.->항상 중앙에 위치하게됨*/

        }
         .righttip:hover span{
            opacity: 0.9;
            visibility: visible;     /*hover시 발생하ㅡㄴ 이벤트*/

        }
		
		
		
		

        
        
        /*모달다이얼로그 바디 스크롤바 css*/
        .modal-body {
            width: 100%;
            height: 100%;
           overflow:auto;

        }
        .modal-body::-webkit-scrollbar {

            width: 10px;
             height: 10px;
        }
        .modal-body::-webkit-scrollbar-thumb {
            background-color: #2f3542;
            border-radius: 10px;
            background-clip: padding-box;
            border: 2px solid transparent;
          }
          .modal-body::-webkit-scrollbar-track {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: inset 0px 0px 5px white;
          }

        /*입력박스 CSS*/
        .myinputtype {
            background-color:#f5f8fa;
            font-size:14px; color:#495057;
            border : 0px;
            height: 45px;
       }
		
		 /* div 드래그막기 */
        .stop-dragging
        {
          -ms-user-select: none; 
          -moz-user-select: -moz-none;
          -khtml-user-select: none;
          -webkit-user-select: none;
          user-select: none;
        }
        
        
        /*튜토리얼 배경 구멍뚤린거*/
        #clip-container {
          position: absolute;
          z-index:9999;
        
            width:100%;
            height:100%;
/*          background: rgba(197, 185, 185, 0.7);*/
          clip-path: polygon(0% 0%,
                0% 100%,
                var(--windowposition-x) 100%,
                var(--windowposition-x) var(--windowposition-y),
                calc(var(--windowposition-x) + var(--windowposition-width)) var(--windowposition-y),
                calc(var(--windowposition-x) + var(--windowposition-width)) calc(var(--windowposition-y) + var(--windowposition-height)),
                var(--windowposition-x) calc(var(--windowposition-y) + var(--windowposition-height)),
                var(--windowposition-x) 100%,
                100% 100%,
                100% 0%);
        }
        
        /*======================*/
        /*디테일 버튼 타입*/
        /*======================*/
        /*버튼 : 회색*/
        .detail_btn_gray{background-color:#e4e6ef;}
        .detail_btn_gray:hover {background-color:#d4d6df;}
        .detail_btn_gray:a:active {background-color:#f4f6ff;}
        
        /*버튼 : 빨강색*/
        .detail_btn_red{background-color:#f1416c;}
        .detail_btn_red:hover {background-color:#e1315c;}
        .detail_btn_red:a:active {background-color:#ff517c;}
        
        /*버튼 : 파랑색*/
        .detail_btn_blue{background-color:#009ef7;}
        .detail_btn_blue:hover {background-color:#008ee7;}
        .detail_btn_blue:a:active {background-color:#00aeff;}
        
        
        
        .Rectangle-10 {
          width: 305px;
          height: 45px;
          border-radius: 5px;
          background-color: #f5f8fa;
        }
         /*email progress*/
        .loader {
          border: 3px solid #f3a3a3; /* Light grey */
          border-top: 3px solid #3498db; /* Blue */
          border-radius: 50%;
          width: 20px;
          height: 20px;
          animation: spin 2s linear infinite;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
        
        
        
        
        
        
        
        /*테이블 기본 설정 START*/
        .default-container {
            width: calc(100% - 300px); /* 좌측 네비바(260px) + 좌우 여백(40px) 만큼 제외 */
            margin-left: 270px;
            margin-right: 20px; /* 우측 여백 */
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);
            margin-top: 20px;
        }

        .default-header {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 20px;
        }

        .default-table {
            width: 100%;
            border-collapse: collapse;
        }

        .default-table th {
            background-color: #f9f9f9;
            padding: 12px;
            text-align: center;
            border-top: 1px solid #eff2f5;
            border-bottom: 1px solid #eff2f5;
            color: #181c32;
            font-weight: 500;
        }

        .default-table td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #eff2f5;
            color: #7e8299;
        }

        .default-table td[onclick] {
            transition: background-color 0.2s;
        }

        .default-table td[onclick]:hover {
            background-color: #eef6ff;
        }

        .default-table tbody tr {
            transition: all 0.2s ease;
        }

        .default-table tbody tr:hover {
            background-color: #eef6ff;
        }

        .default-table tbody tr:hover td {
            color: #181c32;
        }

        .default-table tbody tr td {
            transition: all 0.2s ease;
        }

        .default-table tbody tr td:nth-child(5) {
            cursor: pointer;
        }

        .default-table tbody tr td:first-child {
            background-color: transparent;
        }
    </style>
</head>

<body class="sb-nav-fixed" style="background-color: #f5f8fa;">






    

    <!--===========================-->
    <!--반드시 삽입해야함-->
    <!--===========================-->
<!--
    <div id="dmain" style="position:absolute;text-align:right; width:100%">
        <span style="width:80%; height:100%; background-color:yellow"><div id="div_main" style="margin-top:60px">dfsafsafds</div></span>
        <span  style="width:20%;  height:100%; background-color:blue"id="right_div">aadksalfjdsal</span>
    </div>
    
-->
    <div id = "wrapper" style="padding-bottom:70px;">
        
        <div id="div_main">
            본문
        </div>
        
    </div>
    
    <div id="div_top"></div>
    <div id="div_nav"></div>
    <div id="div_bottom">    
        
<!--        <footer class="py-4 bg-light mt-auto" style="">-->
        <footer id="main-footer">
            <div style='width:100%;height:auto;background-color:#f5f8fa'>
                <div class="d-flex align-items-center justify-content-between medium">
                 
                    <div align="left" style='width:100%'><div class="text-muted fmont" style='font-size:14px;margin-left:280px;text-align:left;float:left;margin-top:15px'>Copyright(c) Smartflat inc. All rights reserved. &copy; <b>주식회사 스마트플랫</b><br><label class='fsans' style='font-size:12px;font-weight:500;color:#181c32;margin-top:8px'>사업자번호 : 177-86-00018 | 통신판매업신고번호 : 제2015-서울서초-1646호 | 대표 황휘장 | 서울시 금천구 가산디지털1로 128 STX V타워 314호 | TEL:02-577-0177 | FAX:02-529-6217</label></div></div>

                    <div class='fmont' style="width:350px;height:70px;float:right;margin-right:100px;padding-top:55px;font-size:12px;color:#7e8299;margin-top:-20px;text-align:right;line-height:12px">
                        <a href="#" onclick="clickTerms('termsofservice')">이용약관</a>&middot;
                        <a href="#" onclick="clickTerms('privacy_policy')">개인정보처리방침</a>&nbsp;
<!--                        <a id='admin_settingid_202' href="#" onclick="showDownloadApkQRCode()">-->
                            <a id='admin_settingid_xxx' href="#" onclick="showDownloadApkQRCode()">
                        <i class="fa-solid fa-qrcode"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>Ver 2.35
                    </div>
                </div>
            </div>
            
        </footer>
        
    </div>
    <div id='clip_container' onclick='check_tutorialdata()' style='display:none;position:absolute;width:100%;height:100%;backdrop-filter: blur(3px);background-color: #14141469;z-index:9999;clip-path: polygon(0% 0%,
                0% 100%,
                var(--windowposition-x) 100%,
                var(--windowposition-x) var(--windowposition-y),
                calc(var(--windowposition-x) + var(--windowposition-width)) var(--windowposition-y),
                calc(var(--windowposition-x) + var(--windowposition-width)) calc(var(--windowposition-y) + var(--windowposition-height)),
                var(--windowposition-x) calc(var(--windowposition-y) + var(--windowposition-height)),
                var(--windowposition-x) 100%,
                100% 100%,
                100% 0%);
                                    --windowposition-x: 175px;--windowposition-y: 175px;--windowposition-height: 175px;--windowposition-width: 175px;'></div>

   


    <script src="./libs/jquery/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!--    <script src="./libs/bootstrap/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    
     <script src="<?php echo $scriptsFile; ?>"></script>
    

<!--    <script src="./libs/chart/chart.min.js"></script>-->
<!--    테이블 관련-->
    <link href="./libs/tables/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="./libs/tables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="./libs/tables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    
    <!--//도움말 페이지전환-->
<!--    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">-->
<!--    <script src="./css/swiper-bundle.min.js"></script>-->
    
    <script>
        
//        clog("manddd");
//        setTextEventColor("admin_settingid_13","#009ef7","#009ef7","#009ef7");
//        setTextEventColor("admin_settingid_14","#5e6278","#009ef7","#009ef7");
//     
    
         
            resize_screen();
       
        var isclick_shift = false;
        window.addEventListener("keydown", function(e){
            if(e.key == "Shift")isclick_shift = true;
            
            
//            clog("isclick_shift ",isclick_shift);
        });
        window.addEventListener("click", function(e){
            
            if(!isfirstsound)
            {
                var audio = new Audio('./sound/01.mp3');
                audio.volume = 0;
                audio.play();
                isfirstsound = true;
                
            }

        });
        window.addEventListener("keyup", function(e){
            isclick_shift = false;
//            clog("isclick_shift ",isclick_shift);
            
        });
        window.addEventListener('resize', function(event) {
           resize_screen();
        }, true);
        
        resize_screen();
        
        var isfirstsound = false;
        var isshowtodaylist = true;
        $(document).mousedown(function( e ){
            if(!isfirstsound)
            {
                var audio = new Audio('./sound/01.mp3');
                audio.volume = 0;
                audio.play();
                isfirstsound = true;
                
            }
             
        });
        
        var title_icon = "<img src='./img/icon_title.png' />&nbsp;";
        try{
            if(window.android)window.android.setOrientation("landscape");
        }catch(e){}
        
        //회원검색창이 사라지는 이슈 수정
       
        document.addEventListener('scroll', function(event) {
            var currentScrollValue = document.body.scrollTop*(100/screen_zoom)+20;
          
            resize_screen();
        });
        //토스트 DIV 영역 생성
        $(document).ready(function() {
//             initminicalendar();
             initToastDiv();
            console.log("main auth is "+auth+ ", auth_num "+auth_num);
             init(auth,global_id);
             
        });
        
        function init(issession,sid) {
            $("#div_top").load("header.php", function() {
                $("#div_nav").load("nav.php", function() {

                    //상단 타이틀바 로그인 했는지 안했는지 처리
                    uiinit(issession, usernamedesc);
                    //토스트 리스너 시작
                    clog("GLOBAL_ID "+global_id);
                    
                    loadMainDiv(0);
                    initSaveKey(sid);
                    checkAccountAuth();
//                    startBeaconLog();
//                    initSelectProjectIds();
                    
                    
//                    document.getElementById("div_main").onscroll = (event) => {
//                        // handle the scroll event
//                        clog("scroll ",event);
//                    };
//                     window.onscroll = Scroll;
                    
                    
                    //test
                    //                    C_showToast("dsadf","title","message fdsfds ");
                });
            });
        }
        function checkAccountAuth(){
            if(auth_num <= 99){
                var nav_account = document.getElementById("nav_account");
                
                if(nav_account)nav_account.style.display = "none";
            }
            var json_setting = setting ? JSON.parse(setting) : {};
            if(json_setting["channel"]){
                var channel_setting = json_setting["channel"];
                var channel_toggle = channel_setting["toggle"];//채널생성권한 토글
                if(!channel_toggle)
                    document.getElementById("nav_channel").style.display = "none";
            }
            //채널
            if(json_setting["createkey"]){
                var createkey_setting = json_setting["createkey"];
                var createkey_toggle = createkey_setting["toggle"];//채널키만들기 토글
                if(!createkey_toggle)
                    document.getElementById("nav_createkey").style.display = "none";
            }
        }
        function get_statistics(type){
            clog("get_statistics type "+type);
//            alertMsg("회원검색 : "+type);
            loadMainDiv(3,type);
            
        }
        
        function showDownloadApkQRCode(){
            var div = document.createElement("div");
            var url = APK_DOWNLOAD_URL;
            var message = makeQRTag(url)+"<br><br><a href='"+url+"'>"+url+"</a><br><hr style='border: solid 1px light-gray;'><div class='form-control' style='background-color:#e0e9ef;height:auto'><label style='font-size:16px;font-weight:bold;margin-top:10px'>플레이스토어 바로가기</label><br>"+makeQRTag(PLAYSTORE_URL)+"<br><br><a href='https://play.google.com/store/apps/details?id=com.blackcompany.blackproject' target='_blank' >https://play.google.com/store/apps/details?id=com.blackcompany.blackproject</a><br><hr style='border: solid 1px light-gray;'><label style='font-size:16px;font-weight:bold;'>앱스토어 바로가기</label><br>"+makeQRTag(APPSTORE_URL)+"<br><br><a href='https://apps.apple.com/kr/app/id1568060103' target='_blank'>https://apps.apple.com/kr/app/id1568060103</a></div>";
            showModalDialog(document.body, "(주의)안드로이드 APK 수동다운로드", message ,"확인",null, function() {
                hideModalDialog();
                
            }, function() {},null);
        }
        
        function clickTerms(type){
            
            //old
            var obj = new Object();
            obj.uid = global_uid;
            obj.id = global_id;
            obj.type = type;
            var centercode = getData("nowcentercode");
            if(centercode){
                obj.centercode = getData("nowcentercode");
                showTermsPopup(obj);
            }
//            
            
            //new
//            var params = {
//                "uid": global_uid,
//                "id": global_id ,
//                "type": type                    
//            };
//            var centercode = getData("nowcentercode");
//            var height = screen.height - 400;
//            var message = "<iframe style='width:1000px;max-width:1500px;height:"+height+"' src='../../v2/dist/m_terms.php?pagetype=adm&centercode=" + centercode +"&uid="+ global_uid +"&id="+ global_id +"&type="+ type + "'></iframe>";
//            var style = {
//                bodycolor: "#eeeeee",
//                size: {
//                    width: "1100px",
//                    height: "100%"
//                }
//            };
//            var title = type == "termsofservice" ? "이용약관" : "개인정보처리방침";
//            showModalDialog(document.body, title, message, "닫기", null, function () {
//                hideModalDialog();                
//            }, null, style);
        }
        var check = $("input[type='checkbox']");
        check.click(function(){
            $("p").toggle();
        });
        
        function addPostIt(){
            createCard("", {
                title: "",
                content: "",
                top: "100px",
                left: "400px",
                date: getToday()+" "+getNowHHMM()
            });
        }
        function postItClear(){
            clearPostItAll();
        }
        
    </script>
    
    <div id='div_loading_progress' style='text-align:center;width:100%;height:100%;background-color:#88888899;position:fixed;z-index:1000;display:none'><img src='./img/loading80.png' class="infinite_rotating_logo" style="margin-top:35%"/></div>
    
    <script src="<?php echo $postitFile; ?>"></script>
    <script>
    
      //채널톡로드
      (function(){const w=window;if(w.ChannelIO){return w.console.error("ChannelIO script included twice.")}const ch=function(...args){ch.c(args)};ch.q=[];ch.c=function(args){ch.q.push(args)};w.ChannelIO=ch;function l(){if(w.ChannelIOInitialized){return}w.ChannelIOInitialized=true;const s=document.createElement("script");s.type="text/javascript";s.async=true;s.src='https://cdn.channel.io/plugin/ch-plugin-web.js';const x=document.getElementsByTagName("script")[0];if(x.parentNode){x.parentNode.insertBefore(s,x)}}if(document.readyState==="complete"){l()}else{w.addEventListener("DOMContentLoaded",l);w.addEventListener("load",l)}})();

    </script>
    <style>
        @media (max-width: 768px) {
            #main-footer {
                display: none !important;
            }
        }
    </style>
    
</body>

</html>

