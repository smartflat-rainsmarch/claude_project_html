<?php
include('./common.php'); 

//$uid = isset($_POST['uid']) ? $_POST['uid'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$id = isset($_POST['id']) ? $_POST['id'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$type = isset($_POST['type']) ? $_POST['type'] : '';//이용약관인지 , 개인정보 처리방침인지

?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <title>예약할 수 있는 목록</title>

    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <script>
        if( /Android/i.test(navigator.userAgent)) {
           
                var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
        }else {
             var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=0.5, maximum-scale=2.0, minimum-scale=0.5');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
        }
        
//          var MetaTag = document.createElement("META");
//        MetaTag.setAttribute('name', 'viewport');
//        MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=3.0, minimum-scale=1');
//        document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
<!--    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1" />-->
    <meta name="format-detection" content="telephone=no, address=no, email=no" />

    <!-- 아이폰(사파리) UI 없애기 -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />



<!--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
    <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
<!--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <!------ Include the above in your HEAD tag ---------->

    <!--
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
-->
    <!--
 <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>

    
-->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <link href="./css/modaldialog.css" rel="stylesheet">
   
    
    
     <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
    <script src="js/scripts.js?ver3.02aab1"></script>

     <!--swipe-->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    
    <!--
<link rel="stylesheet" href="./css/layout.css"/>
<link rel="stylesheet" href="./css/sub.css"/>
-->

    <link rel="stylesheet" href="./css/calendar.css" />
    <style>
        body {
            background: #fff
        }

        .container {
            min-width: 100%;
            background: #fff
        }

        .body {
            width: 100%;
            background: #fff
        }

        .container {
            width: 100%;
            height: 100%;
            position: relative;
            /*  border: 3px solid green;*/
        }

        .center {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);

        }

        .reservation_center {
            padding-top: 5%;
            color: b;
            text-align: center;
        }

        .my-button {

            /*    width:100px;*/

            background-color: #f8585b;

            border: none;
            border-radius: 10px;
            color: #fff;

            padding: 15px 0;

            text-align: center;
            padding-left: 20px;
            padding-right: 20px;
            text-decoration: none;

            display: inline-block;

            font-size: 15px;

            margin: 4px;

            cursor: pointer;

        }

        .my-button:hover {
            /*    background-color: blue;*/
            border-radius: 10px;
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
         
        /* div 드래그막기 */
        .stop-dragging
        {
          -ms-user-select: none; 
          -moz-user-select: -moz-none;
          -khtml-user-select: none;
          -webkit-user-select: none;
          user-select: none;
        }
        
        
         .new_btn {
         background-image: -moz-linear-gradient( 90deg, rgb(109,110,112) 0%, rgb(139,141,145) 
        100%);
         background-image: -webkit-linear-gradient( 90deg, rgb(109,110,112) 0%, 
        rgb(139,141,145) 100%);
         background-image: -ms-linear-gradient( 90deg, rgb(109,110,112) 0%, rgb(139,141,145) 
        100%);

    }
    .new_btn2 {
        background-image: -moz-linear-gradient( 90deg, rgb(45,45,48) 0%, rgb(71,71,75) 100%);
         background-image: -webkit-linear-gradient( 90deg, rgb(45,45,48) 0%, rgb(71,71,75) 
        100%);
         background-image: -ms-linear-gradient( 90deg, rgb(45,45,48) 0%, rgb(71,71,75) 100%);

    }
    .new_data {
        border:1px solid #e9e9e9;
        background-image: -moz-linear-gradient( 90deg, rgb(228,230,239) 0%, rgb(242,243,247) 
        5%, rgb(255,255,255) 100%);
         background-image: -webkit-linear-gradient( 90deg, rgb(228,230,239) 0%, 
        rgb(242,243,247) 5%, rgb(255,255,255) 100%);
         background-image: -ms-linear-gradient( 90deg, rgb(228,230,239) 0%, rgb(242,243,247) 
        5%, rgb(255,255,255) 100%);
        padding-right:15px

    }

        
        
        /*말풍선*/
        .mytip {
            width: 110px;         /*전체를 감싸는 크기를 아이콘 크기로 맞춤*/
            height: 110px;
            margin: 10px;
            position: relative;
            z-index: 9999999;
        }
        .mytip span{
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
         .mytip span:after {
            content : '';             /*가상클래스 before, after는 무조건 content가 있어야 작동*/
            position: absolute;       /*상위클래스icon이 relative이므로, absolute로 설정하여 동적페이지에도 같은 위치로 유지*/
            background-color:#000;
            width : 10px;
            height: 10px;
            transform: rotate(45deg) translateX(-50%);  /*transform은 한 요소에 1번밖에 못쓰므로 합쳐줘야함*/
            top: 0px;
            left: 20%;                                  /*1. 왼쪽에서 50%위치에 둔다.*/
            z-index: 9999999;                                           /*2. 크기값을 50%만큼 이동시켜준다.->항상 중앙에 위치하게됨*/

        }
         .mytip:hover span{
            opacity: 0.9;
            visibility: visible;     /*hover시 발생하ㅡㄴ 이벤트*/

        }

    </style>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<style>
    
.container {
    width : 100%;
  height: 100%;
  position: relative;
/*  border: 3px solid green;*/
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  
}
.reservation_center {
  padding-top: 1%;
  color: b;
  text-align:center;
    width:100%;
}

.my-button {

/*    width:100px;*/
    
    background-color: #f8585b;

    border: none;
    border-radius:10px;
    color:#fff;

    padding: 15px 0;

    text-align: center;
    padding-left: 20px;
    padding-right:20px;
    text-decoration: none;

    display: inline-block;

    font-size: 15px;

    margin: 4px;

    cursor: pointer;

}
.my-button:hover {
/*    background-color: blue;*/
    border-radius:10px;
}

/* 검색창 */
.stop-dragging
{
  -ms-user-select: none; 
  -moz-user-select: -moz-none;
  -khtml-user-select: none;
  -webkit-user-select: none;
  user-select: none;
}
.ui-autocomplete{
    z-index: 3000;
    position:fixed;
}

</style>





</head>

<body id='body'>
   
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
     <div style='position:absolute;width:100%;height:100%'>
        <div id='div_center_list' style='margin-top:80px'>
        </div>
        <div id="div_main" style="display:block">
            <div id="main">


                <div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
                    <div id= "reservation_center" class="reservation_center" style='padding:5px'>

                        <div class="calendar_container theme-showcase">
                            <br>
                            <div id="gx_holder" class="row" ></div>
                        </div>
                    </div>


                </div>

<!--                    <div id="alltip" style="position:absolute;display:block" ></div>  -->

            </div>
         </div>
    </div>

    <div style="position:fixed;width:100%;height:80px;background-color:white">
        <img src="./img/arrow_l.png" style="position:fixed;z-index:999;padding:20px" onclick="androidBack()">
    </div>
    </body>
</html>

<script>

//    try{
//            if(window.android)window.android.setOrientation("landscape");
//        }catch(e){}
    

    
    var issliding = 0;
    var mySwiper = new Swiper('.swiper-container', {
            //최초 페이지 설정
            initialSlide: 1,
             //감도
             threshold:40, 
            speed: 200,
//         effect: 'slide',
              effect: 'flip',
              flipEffect: {
                slideShadows: false,
              },
            // 슬라이드를 버튼으로 움직일 수 있습니다.
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // 현재 페이지를 나타내는 점이 생깁니다. 클릭하면 이동합니다.
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
            },

            // 현재 페이지를 나타내는 스크롤이 생깁니다. 클릭하면 이동합니다.
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
            },

             //페이드
            fadeEffect: {
                crossFade: true
            },
            onAny(eventName, ...args) {

                if(eventName == "activeIndexChange"){
                   
                   const swipe = this;
//                   if(window.calendar && issliding == 0)
                   {
//                       clog("this.activeIndex "+this.activeIndex);
                        setTimeout(function(){
                            if(swipe.activeIndex == 0){
                                issliding = 1;
                                window.calendar(window.el,window.options,"prev");
                                swipe.slideTo(1,0);
                                
                            }
                            else if(swipe.activeIndex == 2){
                                issliding = 1;
                                window.calendar(window.el,window.options,"next");    
                                swipe.slideTo(1,0);
                               
                            }
                        },100);
                   }

               }
//               else if(eventName == "slidePrevTransitionEnd" || eventName == "slideNextTransitionEnd"){
//                 const swipe = this;
//                 
//                 if(issliding == 1){
//                     setTimeout(function(){
//                         swipe.slideTo(1,50);
//                           issliding = 0;
//                     },100);
//                 }
//               }
           }
        });
    
    
      //안드로이드 뒤로가기이다.
      function androidBack(){
            if(window.options && window.options.mode && window.options.mode == "day"){
                window.options.mode = "month";
                window.calendar(window.el,window.options,"month");
            }else if(ismullticenter && !isshow_centerlist){
//                isshow_centerlist = true;
//                document.getElementById("div_center_list").style.display = "block";
//                document.getElementById("div_main").style.display = "none";  
//                setZoom();
                reload_calendar_page();
            }
            else{
                call_app();
            }
        }
</script>
<script type="text/tmpl" id="tmpl">

    {{
  var date = date || new Date(),
      
      month = date.getMonth(), 
      year = date.getFullYear(), 
      
      first = new Date(year, month, 1), 
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(), 
      thedate = new Date(year, month, 1 - startingDay),
      
      h_first = new Date(year, month, 1), 
      h_last = new Date(year, month + 1, 0),
      h_startingDay = h_first.getDay(), 
      h_thedate = new Date(year, month, 1 - startingDay),
      
      
      dayclass = lastmonthcss,
      today = new Date(),
      i, j; 
      
      

  var date = date || new Date(),
      
      month = date.getMonth(), 
      year = date.getFullYear(), 
      
      first = new Date(year, month, 1), 
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(), 
      thedate = new Date(year, month, 1 - startingDay),
      
      h_first = new Date(year, month, 1), 
      h_last = new Date(year, month + 1, 0),
      h_startingDay = h_first.getDay(), 
      h_thedate = new Date(year, month, 1 - startingDay),
     
      
      
      dayclass = lastmonthcss,
      today = new Date(),
      i, j; 
      
      
      
      
  if (mode === 'week') {
    thedate = new Date(date);
    thedate.setDate(date.getDate() - date.getDay());
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(last.getDate()+6);
    
    h_thedate = new Date(date),
    h_thedate.setDate(date.getDate() - date.getDay());
    h_first = new Date(h_thedate);
    h_last = new Date(h_thedate);
    h_last.setDate(h_last.getDate()+6);
    
  } else if (mode === 'day') {
    thedate = new Date(date);
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(thedate.getDate() + 1);
    
    h_thedate = new Date(date);
    h_first = new Date(h_thedate);
    h_last = new Date(h_thedate);
    h_last.setDate(h_thedate.getDate() + 1);
  }
  
  
  }}
    {{if(mode == 'day') { }}
    <div style="width: 1260px; background-color: #fff; border-radius: 10px; border-bottom-left-radius: 0px; border-bottom-right-radius: 0px; z-index: 1000;box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 5%);border: 1px solid #eff2f5; margin-top:-48px; margin-left: -17px; margin-right:-17px; position: fixed;">
        <div id="div_gxtitle" style="width:100%;height:auto; padding-top:25px; padding-right:10px;">
            <!-- 타이틀-->
        <text style="float:left;margin-left:30px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >GX 설정</text>
        <!-- 회원검색-->
            <div style="float:right;width:240px;height:40px;background-color:#f5f8fa;border-radius:8px;margin-top:-10px;border:1px solid #eff2f5; position: relative;">
                <span><img src="./img/icon_search.png" style="width:16px;height:14px;margin:12px 7px 5px -7px "></span>
                <span><input class="searchBox" id="input_all_search" type="text" placeholder="특정회원검색..."  title="검색한 회원 예약현황 데이타만 별도로 볼 수 있습니다." aria-label="Search" aria-describedby="basic-addon2" style="width:140px; height:40px;border:0px; background: transparent;outline: none;"/></span>
                <button  onclick="reload_calendar_page()" title="전체예약현황으로 돌아갑니다." class="btn" style="border:0px;cursor:pointer;width:30px; height:30px;border-radius:6px;background-color:#e4e6ef;color:#a7aabc;outline:none;float:right;margin-right:4px;margin-top:4px;padding-left:10px;font-size:13px"><i class="fa-solid fa-arrows-rotate" style="margin-left:-2px"></i></button>            
            </div><br>
        <hr style="border: solid 1px #eff2f5;margin-top:25px;margin-right:-17px;">
        
        </div>
        <div id="id_hcalendar" style="width:100%;">
            <div style="height:50px">
                <span style="float:left;margin-top:5px">
                    <span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>색깔로 해당 강좌 상태를 표시합니다.</span></span>&nbsp;
                    <svg style="width:13px;height:13px;"><rect width="13" height="13" rx="3" ry="3" style="fill:#E5F3DA"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">오픈됨</text>&nbsp;&nbsp;
                    <svg style="width:13px;height:13px"><rect width="13" height="13" rx="3" ry="3" style="fill:#FFE3E1"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">예약꽉참</text>&nbsp;&nbsp;
                    <svg style="width:13px;height:13px"><rect width="13" height="13" rx="3" ry="3" style="fill:#EEEEEE"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">비활성됨</text>&nbsp;&nbsp;
                    <svg style="width:8px;height:8px"><rect width="8" height="8" rx="4" ry="4" style="fill:#f2329a;border:1px solid #111111"></rect></svg>&nbsp;<text id="txt_total_gxuser_month" style="font-size:14px; color:#3f4254;font-weight:500;">예약: 0명</text>&nbsp;&nbsp;
                    <svg style="width:8px;height:8px"><rect width="8" height="8" rx="4" ry="4" style="fill:#7768d8;"></rect></svg>&nbsp;<text id="txt_total_gxreadyuser_month" style="font-size:14px; color:#3f4254;font-weight:500;">대기: 0명</text>&nbsp;&nbsp;
                    
                    
                </span>
                <span style="float:right;display:none">
                    <button id="btn_minicalendar_change" class="btn btn-primary btn-raised" onclick="minicalendar_change()" style="width:100px; height:40px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;">그룹수정&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                    <button id="btn_minicalendar_copy" class="btn" onclick="minicalendar_copy()" style="margin-left:10px;width:100px; height:40px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;">그룹복사&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                    
                </span>
            </div>
        
                <ul class="minicalendar_sub" style="display:none;padding:0px;"> 
                    <div style="width:100%;height:auto;background-color:#ffffff;border:1px solid #e4e6ef;border-radius:10px;">
                        <!-- 상단 -->
                        <div align="center" style="text-align:center;width:100%;height:58px;background-color:#f5f8fa;border-bottom:1px solid #e4e6ef;border-radius:10px 10px 0px 0px">
                                
                                <div align="center" style="position:absolute;width:1100px;margin-left:60px;margin-right:60px"><label id="minicalendar_title" style="font-size:18px; color:#3f4254;font-weight:500;margin-top:15px;text-align:left">복사할 날짜를 선택하세요.</label></div>
                                <button class="btn" onclick="reset_minicalendar()" style="float:left;width:35px;height:35px;margin:10px;background-color:#e4e6ef;border-radius:7px;"><i class="fa-solid fa-rotate" style="color:#a1a5b7;margin-left:-2px;margin-top:-2px"></i></button>
                                
                        </div>
                        <!-- 중간메인 -->
                        <div style="width:100%;height:400px">
                            <div align="center" style="float:left;width:610px;height:400px;border-right:1px solid #e4e6ef">
                            <button class="js-cal-prev btn btn-default" style="float:left;background-color:white;color:white;margin-top:150px"><img src="./img/minicalendar_arrow_l.png"></button>
                            
                            <label class="fmont" style="font-size: 20px; color:#3f4254;font-weight:500; text-align:center;margin-top:30px">{{: year}}. {{: month+1}}</label><br>
                            <table class="" style="width:525px">
                                    <thead>
                                        <tr class="c-weeks" style="background-color:white;height:45px">
                                            {{ for (i = 0; i < 7; i++) { 
                                                var yy = h_thedate.getFullYear();
                                                var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                                var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();
                                                var now = yy + "-" + mm + "-" + dd;

                                                var week_txt_color = "black";
                                                if(days[i%7] == "일") week_txt_color = "red";
                                                else if(days[i%7] == "토")week_txt_color = "blue";
                                                else week_txt_color = "black";

                                            }}
                                            <th class="c-name" style="text-align:center;color:#5e6278;text-align:center; font-weight:400;" onclick="onclick_hcalendar({{: now }})">
                                                {{: days[i%7] }}
                                            </th>
                                            {{ } }}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{ 

                                        for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
                                        <tr style="height:45px">
                                            {{ for (i = 0; i < 7; i++) { 
                                                var yy = h_thedate.getFullYear();
                                                var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                                var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();
                                                var now = yy + "-" + mm + "-" + dd;
                                                var textcolor = i == 0 ? "#fa6374" : "#3f4254";
                                                if(i == 6)textcolor = "#3980c0";
                                                var textopacity = parseInt(mm) != month+1 ? "opacity:0.2" : "";
                                            }}
                                            {{ if (h_thedate > h_last) { dayclass = nextmonthcss; } else if (h_thedate >= h_first) { dayclass = thismonthcss; } }}
                                            <td class="stop-dragging" id="copy0_hcalendar-day_{{: now }}"  onmouseover="onhover_hdate('{{: now }}',0)"  data-date="{{: h_thedate.toISOString() }}" onmousedown="onclick_hdate('{{: now }}',0)"  style="text-align:center;{{: textopacity }}">
                                                <div class="date" style="font-size: 14px; color:{{: textcolor }};text-align:center; font-weight:500;">{{: h_thedate.getDate() }}</div>
                                                {{ h_thedate.setDate(h_thedate.getDate() + 1);}}
                                            </td>
                                            {{ } }}
                                        </tr>
                                        {{ } }}


                                    </tbody>
                                </table>
                            </div>
                            
                        
                            <div align="center" style="float:right;width:610px;height:400px">
                                <button class="js-cal-next btn btn-default" style="float:right;background-color:white;color:white;margin-top:150px"><img src="./img/minicalendar_arrow_r.png"></button>
                                {{ 
                                    var nyear = month+2 > 12 ? year +1 : year;
                                    var nmonth = month+2 > 12 ? 1 : month+2;
                                }}
                                <label class="fmont" style="font-size: 20px; color:#3f4254;font-weight:500; text-align:center;margin-top:30px">{{: nyear}}. {{: nmonth}}</label><br>

                                <table class="" style="width:525px">
                                    <thead>
                                        <tr class="c-weeks" style="background-color:white;height:45px">
                                            {{ for (i = 0; i < 7; i++) { 
                                                var yy = h_thedate.getFullYear();
                                                var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                                var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();
                                                var now = yy + "-" + mm + "-" + dd;

                                                var week_txt_color = "black";
                                                if(days[i%7] == "일") week_txt_color = "red";
                                                else if(days[i%7] == "토")week_txt_color = "blue";
                                                else week_txt_color = "black";

                                            }}
                                            <th class="c-name" style="text-align:center;font-size: 14px; color:#5e6278;text-align:center; font-weight:400;" onclick="onclick_hcalendar({{: now }})">
                                                {{: days[i%7] }}
                                            </th>
                                            {{ } }}
                                        </tr>
                                    </thead>
                                <tbody>
                                    {{ 

                                        var gabday = h_thedate.getDate()-7 <= 1 ? h_thedate.getDate()-7 : h_thedate.getDate() -14;
                                        h_thedate.setDate(gabday);
                                        for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
                                    <tr style="height:45px">
                                        {{ for (i = 0; i < 7; i++) { 
                                            var yy = h_thedate.getFullYear();
                                            var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                            var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();                               
                                            var now = yy + "-" + mm + "-" + dd;
                                            var textcolor = i == 0 ? "#fa6374" : "#3f4254";
                                            if(i == 6)textcolor = "#3980c0";
                                            var textopacity = parseInt(mm) != nmonth ? "opacity:0.2" : "";
                                        }}
                                        {{ if (h_thedate > h_last) { dayclass = nextmonthcss; } else if (h_thedate >= h_first) { dayclass = thismonthcss; } }}
                                        <td class="stop-dragging" id="copy1_hcalendar-day_{{: now }}"  onmouseover="onhover_hdate('{{: now }}',1)"   data-date="{{: h_thedate.toISOString() }}"  onmousedown="onclick_hdate('{{: now }}',1)"  style="text-align:center;{{: textopacity }}">
                                            <div class="date" style="font-size: 14px; color:{{: textcolor }};text-align:center; font-weight:500;">{{: h_thedate.getDate() }}</div>
                                            {{ h_thedate.setDate(h_thedate.getDate() + 1);}}
                                        </td>
                                        {{ } }}
                                    </tr>
                                    {{ } }}


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- 하단 -->
                        <div align="right" id="span_opentime2" style="display:none;width:100%;height:80px;border-top:1px solid #e4e6ef">
                            <button class="btn" onclick="onClickRoomCopy()" style="float:right;width:180px; height:43px;border-radius:5px;background-color:#009ef7;font-size: 14px; color:#ffffff;font-weight:500;margin-top:20px;margin-right:30px">선택한강좌 복사하기</button>
                            <span id="span_opentime" style="float:right;width:300px;margin-top:24px;margin-right:20px">                   
                                <text>• 오픈시간:</text>&nbsp;&nbsp;<input type="datetime-local" id="input_minicalendar_opentime" style="width:198px; height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e6278;text-align:center; font-weight:700;outline:none"/>
                            </span>
                            
                        </div>
                    </div>
                
            
                

                    <!--</div>-->
                
            </ul>
            <!-- 캘린더 -->
            <!-- XXX -->
            <div style="height:50px;display:none">
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="createmultirooms()" style="float:right;display:none;">한꺼번에 강좌만들기</button>
            <button id="btn_update_multirooms" class="btn btn-primary btn-raised" onclick="updatemultirooms()" style="float:right;margin-right:10px;">한꺼번에 강좌수정하기</button>
            <button id="btn_copy_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms()" style="float:right;display:none;margin-right:10px;">강좌정보 복사하기</button>
            <button id="btn_paste_multirooms" class="btn btn-primary btn-raised" onclick="pasteMultiRooms()" style="float:right;display:none;margin-right:10px;background-color:#ff6666">강좌정보 붙여넣기</button>
            
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,1)" style="float:right;margin-left:5px;">이번주 복사</button>
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,2)" style="float:right;margin-left:5px;">이번주~2주전 복사</button>
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,3)" style="float:right;margin-left:5px;">이번주~3주전 복사</button>
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,4)" style="float:right;margin-left:5px;">이번주~4주전 복사</button>
                <br><br><button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,1)" style="float:right;margin-left:5px;">지난주 복사</button>
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,2)" style="float:right;margin-left:5px;">지난주~2주전 복사</button>
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,3)" style="float:right;margin-left:5px;">지난주~3주전 복사</button>
                <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,4)" style="float:right;margin-left:5px;">지난주~4주전 복사</button>
                
        </div>
        <hr style="border: solid 1px #eff2f5;margin-top:0px;margin-left:-17px;margin-right:-17px;">
        </div>
        <br>
        
        <div id="div_cbuttons" align="center" style="width:100%;height:80px;margin-top:15px; padding-left:10px; padding-right:10px;">
              
                    <div align="left" style="margin-top:-50px;">
                    
                        <span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>색깔로 회원 출석상태를 표시합니다.</span></span>&nbsp;
                        <svg style="width:13px;height:13px"><rect width="13" height="13" rx="3" ry="3" style="fill:white;stroke:#cbcdd3;stroke-width:1px"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">예약완료</text>&nbsp;&nbsp;
                        <svg style="width:13px;height:13px;"><rect width="13" height="13" rx="3" ry="3" style="fill:#c8d8d0"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">QR 출석완료</text>&nbsp;&nbsp;
                        <svg style="width:8px;height:8px"><rect width="8" height="8" rx="4" ry="4" style="fill:#f2329a;border:1px solid #111111"></rect></svg>&nbsp;<text id="txt_total_gxuser_day" style="font-size:14px; color:#3f4254;font-weight:500;">예약: 0명</text>&nbsp;&nbsp;
                    <svg style="width:8px;height:8px"><rect width="8" height="8" rx="4" ry="4" style="fill:#7768d8;"></rect></svg>&nbsp;<text id="txt_total_gxreadyuser_day" style="font-size:14px; color:#3f4254;font-weight:500;">대기: 0명</text>&nbsp;&nbsp;
                    
                    </div>
                    
                    <!-- 좌우화살표 -->   
                    <span class="btn-group" style="float:left;margin-top:8px">
                        <button class="js-cal-prev btn btn-default" style="background-color:#3e7db8;color:white;padding-top:10px;padding-bottom:10px"><i class="fa-solid fa-angle-left"></i></button>
                        <button class="js-cal-next btn btn-default" style="background-color:#3e7db8;color:white;padding-top:10px;padding-bottom:10px"><i class="fa-solid fa-angle-right"></i></button>
                    </span>
                   
                    <!-- Today -->   
                    <!--<button style="float:left;margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;margin-left:10px;" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }} " data-date="{{: today.toISOString()}}" data-mode="month">Today</button>-->  
                   <button class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }} " style="float:left;margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;margin-left:10px;" onclick="loadMainDiv(34)">Today</button>
                    <span class="btn-group btn-group-lg" style="font-size:18px;font-weight:700">
                                    {{





                    if (mode !== 'day') { 
                }}
                                    <text style="margin-top:10px">{{: year}}년</text>
                                    {{
                        if (mode === 'month') { 
                         var m_month = months[month];
                         
                           
                }}
                                    <text  style="margin-top:10px;margin-left:5px">{{: m_month }}</text>
                                    {{
                        } 
                        if (mode ==='week') { 
                        
                }}
                                    <text  style="margin-top:10px" >{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</text>
                                    {{
                        } 
                
                    } else { 
                        var day_date =  date.toDateString();
                        
                        var arr_week = ["Sun","Mon","Tue","Wed","Thu","Fri", "Sat"];
                        var arr_month = ["Jan","Feb","Mar","Apr","May","Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        
                        function getmonthweek(arr,val){
                            var rdata = -1;
                            for(var i = 0 ; i < arr.length; i++){
                                if(arr[i] == val){
                                    rdata = i;
                                    break;
                                }
                            }
                            return rdata;
                        }
                        
                        var arr = day_date.split(' ');
                        
                        var myear = arr[3]+"년";
                        var mmonth = shortMonths[getmonthweek(arr_month,arr[1])];
                        var mday = arr[2]+"일";
                        var mweek = days[getmonthweek(arr_week,arr[0])]+"요일";
                        var mdate = myear+" "+mmonth+" "+mday+" ("+mweek+")"; 
                        
                        
                }}
                                    <text style="margin-top:10px">{{: mdate }}</text>
                                    {{
                    } 
                }}
                    </span>
              
                    
                    <span class="btn-group" style="float:right">

                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">년</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">월</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">주</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day">일</button>
                    </span>
                    
                    <button id="btn_insert_room" style="display:none;float:right;margin-top:8px;margin-right:10px;background-color:#3e7db8;height:38px;color:white;border:0px;border 0px;border-radius:3px;font-size:13px;padding-left:15px;padding-right:15px" onclick="insert_gxroom()">강좌입력하기</button>
                    
                    
             

        </div>
    </div>
    {{ }else{ }}
    <div id="div_gxtitle" style="width:100%;height:auto">
        <!-- 타이틀-->
       <text style="float:left;margin-left:10px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >GX 설정</text>
       <!-- 회원검색-->
         <div style="float:right;width:240px;height:40px;background-color:#f5f8fa;border-radius:8px;margin-top:-10px;border:1px solid #eff2f5;">
            <span><img src="./img/icon_search.png" style="width:16px;height:14px;margin:12px 7px 5px -7px "></span>
            <span><input class="searchBox" id="input_all_search" type="text" placeholder="특정회원검색..."  title="검색한 회원 예약현황 데이타만 별도로 볼 수 있습니다." aria-label="Search" aria-describedby="basic-addon2" style="width:140px; height:40px;border:0px; background: transparent;outline: none;"/></span>
             <button  onclick="reload_calendar_page()" title="전체예약현황으로 돌아갑니다." class="btn" style="border:0px;cursor:pointer;width:30px; height:30px;border-radius:6px;background-color:#e4e6ef;color:#a7aabc;outline:none;float:right;margin-right:4px;margin-top:4px;padding-left:10px;font-size:13px"><i class="fa-solid fa-arrows-rotate" style="margin-left:-2px"></i></button>            
         </div><br>
       <hr style="border: solid 1px #eff2f5;margin-top:25px;margin-left:-17px;margin-right:-17px;">
      
    </div>
    <div id="id_hcalendar" style="width:100%;">
        <div style="height:50px">
            <span style="float:left;margin-top:5px">
                <span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>색깔로 해당 강좌 상태를 표시합니다.</span></span>&nbsp;
                <svg style="width:13px;height:13px;"><rect width="13" height="13" rx="3" ry="3" style="fill:#E5F3DA"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">오픈됨</text>&nbsp;&nbsp;
                <svg style="width:13px;height:13px"><rect width="13" height="13" rx="3" ry="3" style="fill:#FFE3E1"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">예약꽉참</text>&nbsp;&nbsp;
                <svg style="width:13px;height:13px"><rect width="13" height="13" rx="3" ry="3" style="fill:#EEEEEE"></rect></svg>&nbsp;<text style="font-size:13px; color:#3f4254;font-weight:500;">비활성됨</text>&nbsp;&nbsp;
                <svg style="width:8px;height:8px"><rect width="8" height="8" rx="4" ry="4" style="fill:#f2329a;border:1px solid #111111"></rect></svg>&nbsp;<text id="txt_total_gxuser_month" style="font-size:14px; color:#3f4254;font-weight:500;">총 예약인원: 0명</text>&nbsp;&nbsp;
                    <svg style="width:8px;height:8px"><rect width="8" height="8" rx="4" ry="4" style="fill:#7768d8;"></rect></svg>&nbsp;<text id="txt_total_gxreadyuser_month" style="font-size:14px; color:#3f4254;font-weight:500;">총 대기인원: 0명</text>&nbsp;&nbsp;
                    
                
            </span>
            <span style="float:right;display:none">
                <button id="btn_minicalendar_change" class="btn btn-primary btn-raised" onclick="minicalendar_change()" style="width:100px; height:40px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;">그룹수정&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                <button id="btn_minicalendar_copy" class="btn" onclick="minicalendar_copy()" style="margin-left:10px;width:100px; height:40px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;">그룹복사&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-caret-down"></i></button>
                
            </span>
        </div>
       
            <ul class="minicalendar_sub" style="display:none;padding:0px;"> 
                <div style="width:100%;height:auto;background-color:#ffffff;border:1px solid #e4e6ef;border-radius:10px;">
                    <!-- 상단 -->
                    <div align="center" style="text-align:center;width:100%;height:58px;background-color:#f5f8fa;border-bottom:1px solid #e4e6ef;border-radius:10px 10px 0px 0px">
                            <!--221031 유진 수정-->
                            <div align="center" style="position:absolute;width:1100px;margin-left:60px;margin-right:60px"><label id="minicalendar_title" style="font-size:18px; color:#3f4254;font-weight:500;margin-top:15px;text-align:left">복사할 날짜를 선택하세요.</label></div>
                            <button class="btn" id="reset_btn" onclick="reset_minicalendar()" style="float:left;width:35px;height:35px;margin:10px;background-color:#e4e6ef;border-radius:7px;"><i class="fa-solid fa-rotate" style="color:#a1a5b7;margin-left:-2px;margin-top:-2px"></i></button>
                            
                    </div>
                    <!-- 중간메인 -->
                    <div style="width:100%;height:400px">
                        <div align="center" style="float:left;width:610px;height:400px;border-right:1px solid #e4e6ef">
                           <button class="js-cal-prev btn btn-default" style="float:left;background-color:white;color:white;margin-top:150px"><img src="./img/minicalendar_arrow_l.png"></button>
                         
                           <label class="fmont" style="font-size: 20px; color:#3f4254;font-weight:500; text-align:center;margin-top:30px">{{: year}}. {{: month+1}}</label><br>
                           <table class="" style="width:525px">
                                <thead>
                                    <tr class="c-weeks" style="background-color:white;height:45px">
                                        {{ for (i = 0; i < 7; i++) { 
                                            var yy = h_thedate.getFullYear();
                                            var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                            var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();
                                            var now = yy + "-" + mm + "-" + dd;

                                            var week_txt_color = "black";
                                            if(days[i%7] == "일") week_txt_color = "red";
                                            else if(days[i%7] == "토")week_txt_color = "blue";
                                            else week_txt_color = "black";

                                        }}
                                        <th class="c-name" style="text-align:center;color:#5e6278;text-align:center; font-weight:400;" onclick="onclick_hcalendar({{: now }})">
                                            {{: days[i%7] }}
                                        </th>
                                        {{ } }}
                                    </tr>
                                </thead>
                                <tbody>
                                     {{ 

                                     for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
                                    <tr style="height:45px">
                                        {{ for (i = 0; i < 7; i++) { 
                                            var yy = h_thedate.getFullYear();
                                            var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                            var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();
                                            var now = yy + "-" + mm + "-" + dd;
                                            var textcolor = i == 0 ? "#fa6374" : "#3f4254";
                                            if(i == 6)textcolor = "#3980c0";
                                            var textopacity = parseInt(mm) != month+1 ? "opacity:0.2" : "";
                                        }}
                                        {{ if (h_thedate > h_last) { dayclass = nextmonthcss; } else if (h_thedate >= h_first) { dayclass = thismonthcss; } }}
                                        <td class="stop-dragging" id="copy0_hcalendar-day_{{: now }}"  onmouseover="onhover_hdate('{{: now }}',0)"  data-date="{{: h_thedate.toISOString() }}" onmousedown="onclick_hdate('{{: now }}',0)"  style="text-align:center;{{: textopacity }}">
                                              <div class="date" style="font-size: 14px; color:{{: textcolor }};text-align:center; font-weight:500;">{{: h_thedate.getDate() }}</div>
                                            {{ h_thedate.setDate(h_thedate.getDate() + 1);}}
                                        </td>
                                        {{ } }}
                                    </tr>
                                     {{ } }}


                                </tbody>
                            </table>
                        </div>
                        
                       
                        <div align="center" style="float:right;width:610px;height:400px">
                            <button class="js-cal-next btn btn-default" style="float:right;background-color:white;color:white;margin-top:150px"><img src="./img/minicalendar_arrow_r.png"></button>
                            {{ 
                                var nyear = month+2 > 12 ? year +1 : year;
                                var nmonth = month+2 > 12 ? 1 : month+2;
                             }}
                            <label class="fmont" style="font-size: 20px; color:#3f4254;font-weight:500; text-align:center;margin-top:30px">{{: nyear}}. {{: nmonth}}</label><br>

                            <table class="" style="width:525px">
                                <thead>
                                    <tr class="c-weeks" style="background-color:white;height:45px">
                                        {{ for (i = 0; i < 7; i++) { 
                                            var yy = h_thedate.getFullYear();
                                            var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                            var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();
                                            var now = yy + "-" + mm + "-" + dd;

                                            var week_txt_color = "black";
                                            if(days[i%7] == "일") week_txt_color = "red";
                                            else if(days[i%7] == "토")week_txt_color = "blue";
                                            else week_txt_color = "black";

                                        }}
                                        <th class="c-name" style="text-align:center;font-size: 14px; color:#5e6278;text-align:center; font-weight:400;" onclick="onclick_hcalendar({{: now }})">
                                            {{: days[i%7] }}
                                        </th>
                                        {{ } }}
                                    </tr>
                                </thead>
                             <tbody>
                                 {{ 

                                    var gabday = h_thedate.getDate()-7 <= 1 ? h_thedate.getDate()-7 : h_thedate.getDate() -14;
                                    h_thedate.setDate(gabday);
                                    for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
                                <tr style="height:45px">
                                    {{ for (i = 0; i < 7; i++) { 
                                        var yy = h_thedate.getFullYear();
                                        var mm = h_thedate.getMonth() + 1 < 10 ? "0"+(h_thedate.getMonth() + 1) : h_thedate.getMonth() + 1;
                                        var dd = h_thedate.getDate() < 10 ? "0"+h_thedate.getDate() : h_thedate.getDate();                               
                                        var now = yy + "-" + mm + "-" + dd;
                                        var textcolor = i == 0 ? "#fa6374" : "#3f4254";
                                        if(i == 6)textcolor = "#3980c0";
                                        var textopacity = parseInt(mm) != nmonth ? "opacity:0.2" : "";
                                    }}
                                    {{ if (h_thedate > h_last) { dayclass = nextmonthcss; } else if (h_thedate >= h_first) { dayclass = thismonthcss; } }}
                                    <td class="stop-dragging" id="copy1_hcalendar-day_{{: now }}"  onmouseover="onhover_hdate('{{: now }}',1)"   data-date="{{: h_thedate.toISOString() }}"  onmousedown="onclick_hdate('{{: now }}',1)"  style="text-align:center;{{: textopacity }}">
                                          <div class="date" style="font-size: 14px; color:{{: textcolor }};text-align:center; font-weight:500;">{{: h_thedate.getDate() }}</div>
                                        {{ h_thedate.setDate(h_thedate.getDate() + 1);}}
                                    </td>
                                    {{ } }}
                                </tr>
                                 {{ } }}


                                </tbody>
                            </table>
                        </div>
                    </div>
                     <!-- 하단 -->
                     <div align="right" id="span_opentime2" style="display:none;width:100%;height:80px;border-top:1px solid #e4e6ef">
                        <button class="btn" onclick="onClickRoomCopy()" style="float:right;width:180px; height:43px;border-radius:5px;background-color:#009ef7;font-size: 14px; color:#ffffff;font-weight:500;margin-top:20px;margin-right:30px">선택한강좌 복사하기</button>
                        <span id="span_opentime" style="float:right;width:300px;margin-top:24px;margin-right:20px">                   
                            <text>• 오픈시간:</text>&nbsp;&nbsp;<input type="datetime-local" id="input_minicalendar_opentime" style="width:198px; height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e6278;text-align:center; font-weight:700;outline:none"/>
                        </span>
                        
                    </div>
                </div>
               
        
               

                <!--</div>-->
            
        </ul>
        <!-- 캘린더 -->
        <!-- XXX -->
        <div style="height:50px;display:none">
           <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="createmultirooms()" style="float:right;display:none;">한꺼번에 강좌만들기</button>
           <button id="btn_update_multirooms" class="btn btn-primary btn-raised" onclick="updatemultirooms()" style="float:right;margin-right:10px;">한꺼번에 강좌수정하기</button>
           <button id="btn_copy_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms()" style="float:right;display:none;margin-right:10px;">강좌정보 복사하기</button>
           <button id="btn_paste_multirooms" class="btn btn-primary btn-raised" onclick="pasteMultiRooms()" style="float:right;display:none;margin-right:10px;background-color:#ff6666">강좌정보 붙여넣기</button>
           
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,1)" style="float:right;margin-left:5px;">이번주 복사</button>
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,2)" style="float:right;margin-left:5px;">이번주~2주전 복사</button>
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,3)" style="float:right;margin-left:5px;">이번주~3주전 복사</button>
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(0,4)" style="float:right;margin-left:5px;">이번주~4주전 복사</button>
            <br><br><button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,1)" style="float:right;margin-left:5px;">지난주 복사</button>
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,2)" style="float:right;margin-left:5px;">지난주~2주전 복사</button>
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,3)" style="float:right;margin-left:5px;">지난주~3주전 복사</button>
            <button id="btn_create_multirooms" class="btn btn-primary btn-raised" onclick="copymultirooms(1,4)" style="float:right;margin-left:5px;">지난주~4주전 복사</button>
            
       </div>
       <hr style="border: solid 1px #eff2f5;margin-top:0px;margin-left:-17px;margin-right:-17px;">
    </div>
    <br>
    
    <div id="div_cbuttons" align="center" style="width:100%;height:80px;margin-top:15px">
              
                    
                    <!-- 좌우화살표 -->   
                    <span class="btn-group" style="float:left;margin-top:8px">
                        <button class="js-cal-prev btn btn-default" style="background-color:#3e7db8;color:white;padding-top:10px;padding-bottom:10px"><i class="fa-solid fa-angle-left"></i></button>
                        <button class="js-cal-next btn btn-default" style="background-color:#3e7db8;color:white;padding-top:10px;padding-bottom:10px"><i class="fa-solid fa-angle-right"></i></button>
                    </span>
                   
                    <!-- Today -->   
                    <!-- <button style="float:left;margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;margin-left:10px;" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }} " data-date="{{: today.toISOString()}}" data-mode="month">Today</button> --> 
                   <button class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }} " style="float:left;margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;margin-left:10px;" onclick="loadMainDiv(34)">Today</button>
                    <span class="btn-group btn-group-lg" style="font-size:18px;font-weight:700">
                                    {{





                    if (mode !== 'day') { 
                }}
                                    <text style="margin-top:10px">{{: year}}년</text>
                                    {{
                        if (mode === 'month') { 
                         var m_month = months[month];
                         
                           
                }}
                                    <text  style="margin-top:10px;margin-left:5px">{{: m_month }}</text>
                                    {{
                        } 
                        if (mode ==='week') { 
                        
                }}
                                    <text  style="margin-top:10px" >{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</text>
                                    {{
                        } 
                
                    } else { 
                        var day_date =  date.toDateString();
                        
                        var arr_week = ["Sun","Mon","Tue","Wed","Thu","Fri", "Sat"];
                        var arr_month = ["Jan","Feb","Mar","Apr","May","Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        
                        function getmonthweek(arr,val){
                            var rdata = -1;
                            for(var i = 0 ; i < arr.length; i++){
                                if(arr[i] == val){
                                    rdata = i;
                                    break;
                                }
                            }
                            return rdata;
                        }
                        
                        var arr = day_date.split(' ');
                        
                        var myear = arr[3]+"년";
                        var mmonth = shortMonths[getmonthweek(arr_month,arr[1])];
                        var mday = arr[2]+"일";
                        var mweek = days[getmonthweek(arr_week,arr[0])]+"요일";
                        var mdate = myear+" "+mmonth+" "+mday+" ("+mweek+")"; 
                        
                        
                }}
                                    <text style="margin-top:10px">{{: mdate }}</text>
                                    {{
                    } 
                }}
                    </span>
              
                    
                    <span class="btn-group" style="float:right">

                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">년</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">월</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">주</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day">일</button>
                    </span>
                    
                    <button id="btn_insert_room" style="display:none;float:right;margin-top:8px;margin-right:10px;background-color:#3e7db8;height:38px;color:white;border:0px;border 0px;border-radius:3px;font-size:13px;padding-left:15px;padding-right:15px" onclick="insert_gxroom()">강좌입력하기</button>
                    
                    
             

        </div>
        {{ } }}
    <!--</div>-->
    {{ if (mode == 'day') { }}
    <table style="width:100%; margin-top:163px;">
    {{ }else{ }}
    <table style="width:100%">
    {{ } }}
        
        {{ if (mode ==='year') {
      month = 0;
    }}
        <tbody>
            {{ for (j = 0; j < 3; j++) { }}
            <tr>
                {{ for (i = 0; i < 4; i++) { }}
                <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
                    {{: months[month] }}
                    {{ month++;}}
                </td>
                {{ } }}
            </tr>
            {{ } }}
        </tbody>
        {{ } }}
        {{ if (mode ==='month' || mode ==='week') { }}
        <thead>
            <tr class="c-weeks" align="center" style="height:38px;background-color:#f5f6f8">
                {{ for (i = 0; i < 7; i++) { }}
                <th class="c-name" style="font-size:14px; color:#3f4254;text-align:center; font-weight:500;border:1px solid #eaf0f1">
                    {{: days[i] }}
                </th>
                {{ } }}
            </tr>
        </thead>
        <tbody>
            {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
            <tr style="height:140px">
                {{ for (i = 0; i < 7; i++) { 
                    var yy = thedate.getFullYear();
                    var mm = thedate.getMonth() + 1;
                    var dd = thedate.getDate();
                    var now = yy + "-" + mm + "-" + dd;
                    var sdate = "_"+yy + "_" + mm + "_" + dd;
                
                }}
                {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
                <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option  stop-dragging" data-date="{{: thedate.toISOString() }}" style="border:1px solid #eaf0f1;vertical-align: top;">
                    <div align="right" class="date" style="margin-right:7px;margin-top:7px;margin-bottom:7px;font-size:13px;color#3f4254">{{: thedate.getDate() }}</div>
                    <div id="div_gxuser_{{: sdate }}" style="display:none;font-size: 12px;height:20px;border-radius:5px;background-color:#f6f7f7; color:#3f4254;text-align:center; font-weight:500;margin:0 5px 20px 5px">
                        <svg style="width:6px;height:6px"><rect width="6" height="6" rx="3" ry="3" style="fill:#f2329a;"></rect></svg>&nbsp;&nbsp;<text id="txt_gxuser_{{: sdate }}" >0건</text>&nbsp;&nbsp;&nbsp;&nbsp;
                        <svg style="width:6px;height:6px"><rect width="6" height="6" rx="3" ry="3" style="fill:#7768d8;"></rect></svg>&nbsp;&nbsp;<text id="txt_gxreadyuser_{{: sdate }}" >0건</text>
                    </div>
                    {{ thedate.setDate(thedate.getDate() + 1);}}
                </td>
                {{ } }}
            </tr>
            {{ } }}
        </tbody>
        {{ } }}
        {{ if (mode ==='day') { }}
        <tbody>
            <tr>
                <td colspan="7">
                    <!--<table class="table table-striped table-condensed table-tight-vert">day 배경 색깔빼기-->
                    <table style="width:100%">
                       
                        <tbody>
                            <tr  style="display:none;">
                                <td colspan="2" class="{{: date.toDateCssClass() }}"> </td>
                            </tr>
                            <tr  id="tr_input" style="display:none;">
                                <td colspan="2" class="time-0-0"> </td>
                            </tr>
                            {{for (i = 6; i < 24; i++) { 
                            
                                var mhh = i < 10 ? "0"+i : i;
                                
                                var yy = thedate.getFullYear();
                                var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
                                var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
                                var now = yy + "-" + mm + "-" + dd;
                                var dday = getDDay(now);
                                
                                var time = getDateToStr(yy,mm,dd,mhh); 
                                var id = "open"+thedate.toDateCssClass()+"time"+i;
                                var addid = "add_"+time;
                                var strtime = i <= 12 ? i : i - 12;
                                if(strtime < 10)strtime = "0"+strtime;
                               
                               console.log("daytime_"+time);
                            }}
                            <tr id="daytime_{{: time }}" style="display:none">
                                <td class="timetitle" style="width:80px;vertical-align:top">
                                    <span style="float:left;height:100%"><div style="width:1px;height:30px;border:1px solid #e7e7e7;margin-left:35px;margin-top:0px"></div>
                                    </div></span>
                                    <span style="float:left;height:100%">
                                        <button  class="btn fmont"  onclick="update_gxroom('{{: time }}')" style="float:left;width:70px;height:30px;font-size:13px;font-weight:500;border:1px solid #e7e7e7;box-shadow: 0px 2px 2px 0px rgba(0, 0, 0, 0.1);border-radius:15px;background-color:white;" >{{: strtime }} {{: i < 12 ? "AM" : "PM"}}</button>
                                    </span>
                                    <span style="float:left;height:100%"><div id="vertical_line_{{: i }}" style="width:1px;height:130px;border:1px solid #e7e7e7;margin-left:35px;margin-top:0px"></div>
                                    </div></span>
                                </td>
                                <td  class="time-{{: i}}-0">
                                </td>
                            </tr>
                            
                            {{ } }}
                            <tr style="display:none;">
                                <td colspan="2" class="time-24-0"> </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
        {{ } }}
    </table>
    
</script>


<script>
    var param_centercode = getParam("centercode");
    var arr_years = [];
    var param_day = "";
    var param_year = 0;
    
    var thisyear = stringGetYear(getToday());
    var thismonth = stringGetMonth(getToday())-1;
    
    var allpayments = [];   
     var now_groupcode = "<?php echo $groupcode ;?>";
//    var now_groupcode = "<?php echo $groupcode ;?>";
    var now_centercode = param_centercode ? param_centercode : null;
   
//    var now_groupcode = getParam("groupcode");
//    var param_centercode = getParam("centercode");
    var param_useruid = getParam("useruid");
    var param_username = getParam("username");
    holidayCheckNoText();
    
    var arr_years = [];
    
    
    var thisyear = parseInt(stringGetYear(getToday()));
    var thismonth = parseInt(stringGetMonth(getToday()));
    var thisday = 0;
    var ymd = "";
    var user_uid = "";
    var user_name = "";
    var isloaddata = false;
    var allgxreservation = []; 
    var gxtypes = [];//강좌 정보
    var gxteachers = [];//GX강사들 정보
    var gxuserinfos = []; // 전체 유효 GX회원목록
    var searchSource = []; // 검색할때 필요한 데이타  [{"label":"엽기떡볶이","value":"1111"}
//    var now_groupcode = now_groupcode;
//    var param_centercode = param_centercode;
    var year_arr = [];
    
    var click_hdates = [];
    
    
    var div_center_list = document.getElementById("div_center_list");
    var div_main = document.getElementById("div_main");
    
    
     function gxPermissionCheck(){
        var btn_minicalendar_copy = document.getElementById("btn_minicalendar_copy"); //그룹복사
        var btn_minicalendar_change = document.getElementById("btn_minicalendar_change"); //그룹수정
        var btn_insert_room  = document.getElementById("btn_insert_room")//강좌추가하기 (강좌입력버튼)
        
        btn_minicalendar_copy.style.visibility = !isPermission(220) ? "hidden" : "visible";
        btn_minicalendar_change.style.visibility = !isPermission(221) ? "hidden" : "visible";
        btn_insert_room.style.visibility = !isPermission(222) ? "hidden" : "visible";
        
    }
    function checkYearData(year){
        
        var isyear = false;
        for(var i =0 ; i < arr_years.length;i++){
            if(year == arr_years[i]){
                isyear = true;
                break;
            }
        }
        var value = {}
        value.year = year;
        if(!isyear){
//            maininit(value);
        }
    }
    function onchangeRoomToggle(id){ //id = roomid
       
        var key = "idroomtoggle";
        var ptoggle = document.getElementById(key+"_"+id);
        var ptoggle_icon = document.getElementById(key+"_span_"+id);
        var ptoggle_txt = document.getElementById(key+"_txt_"+id);
               
        if(ptoggle.checked){
            ptoggle_txt.innerHTML = "ON";
            ptoggle_txt.style.color = "white";
            ptoggle_txt.style.marginLeft = "3px";
            ptoggle_icon.style.backgroundColor = "#2194f3";
            
        }else{
            ptoggle_txt.style.marginLeft = "30px";
            ptoggle_txt.innerHTML = "OFF";
            ptoggle_txt.style.color = "white";
            ptoggle_icon.style.backgroundColor = "#cccccc";
            
        }
        
    }
    function onchangeIsShowToggle(time,yearmonthnum,roomid,str_room){ //id = roomid
        var room = JSON.parse(str_room);
        var key = "idtoggle";
        var ptoggle = document.getElementById(key+"_"+roomid);
        var ptoggle_icon = document.getElementById(key+"_span_"+roomid);
        var ptoggle_txt = document.getElementById(key+"_txt_"+roomid);
               
        if(ptoggle.checked){
            ptoggle_txt.innerHTML = "&nbsp;ON";
            ptoggle_txt.style.color = "yellow";
            ptoggle_icon.style.backgroundColor = "#2194f3";
            room.room_isshow = "1";
        }else{
            ptoggle_txt.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
            ptoggle_txt.style.color = "white";
            ptoggle_icon.style.backgroundColor = "#cccccc";
            room.room_isshow = "0";
        }
        clog("111 createrooms");
        createRooms(time,roomid,room,[],[]);
        
    }
    var isshow_minicalendar = false;
    
    // 수정할건지 복사할건지 타입
    var set_minicalendar_type = "";
    function minicalendar_change(){
        var mtype = "change";
        document.getElementById("span_opentime").style.display = "none";
        document.getElementById("span_opentime2").style.display = "none";
        if(set_minicalendar_type == mtype){
            set_minicalendar_type = mtype;
            mlistClick();
        }
        else {
            set_minicalendar_type = mtype;
            reset_minicalendar();
            isshow_minicalendar = true;
            mlistClick(2);
        }
        
    }
    function minicalendar_copy(){
        var mtype = "copy";
        document.getElementById("span_opentime").style.display = "block";
        document.getElementById("span_opentime2").style.display = "block";
        
        if(set_minicalendar_type == mtype){
            set_minicalendar_type = mtype;
            
            mlistClick();
        }
        else {
            set_minicalendar_type = mtype;
            reset_minicalendar();      
            isshow_minicalendar = true;
            mlistClick(2);
        }
        set_minicalendar_type = mtype;
    }
    
    function mlistClick(default_setting){
        isshow_next_mini_calendar = true;
        //강제 슬라이드 설정하기
        clog("mlistClick "+default_setting);
        if(default_setting){
             //default_setting  1 :달력이 열렸는지가지 체크  2 : 강제로 열기
//            clog("default_setting "+default_setting+" isshow_minicalendar "+isshow_minicalendar);
            if(default_setting == 1 && isshow_minicalendar || default_setting == 2){
                clog("강제오픈");
                $(".minicalendar_sub").slideUp(0);
                $(".minicalendar_sub").slideDown(450);
                
                updateMiniCalendarBtnText(true);
            }
        }else{
            if($(".minicalendar_sub").is(":visible")){
                $(".minicalendar_sub").slideUp(300);

                isshow_minicalendar = false;
                updateMiniCalendarBtnText(false);
            }else{

                $(".minicalendar_sub").slideDown(450);
                isshow_minicalendar = true;
                updateMiniCalendarBtnText(true);
            }    
        }
        
    }
    function updateMiniCalendarBtnText(isshow){
        var btn_minicalendar_copy = document.getElementById("btn_minicalendar_copy");    
         var btn_minicalendar_change = document.getElementById("btn_minicalendar_change");
        if(set_minicalendar_type == "copy"){
            
            btn_minicalendar_copy.innerHTML = isshow ? "그룹복사&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-up'></i>" : "그룹복사&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-down'></i>" ;
            btn_minicalendar_change.innerHTML = "그룹수정&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-down'></i>";
        }else{
           
            btn_minicalendar_change.innerHTML = isshow ? "그룹수정&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-up'></i>" : "그룹수정&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-down'></i>";
            btn_minicalendar_copy.innerHTML = "그룹복사&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-caret-down'></i>" ;
        }
    }
    //엑셀다운로드버튼 숨기기
    var btn_download_excel = document.getElementById("btn_download_excel");
//    btn_download_excel.innerText  = (thismonth+1)+"월 매출현황 엑셀로 다운로드aaa";
//    btn_download_excel.style.visibility = auth >= AUTH_OPERATOR ? "visible" : "hidden";
//    
//    var div_dummy = document.getElementById("div_dummy");
//    div_dummy.style.visibility = auth >= AUTH_OPERATOR ? "visible" : "hidden";
    
//    var lastclick_hdate = "";
//    var ismousedown_hdate = false;
    var click_hdate_arr = []; //선택 노랑
    var copy_multi_date = []; // 복사하기 파랑
    function ondown_hdate(date){
        
//        ismousedown_hdate = true;
//        clog("ondown_hdate "+ismousedown_hdate);
    }
    function onup_hdate(){
        
//        ismousedown_hdate = false;
//        clog("onup_hdate "+ismousedown_hdate);
        clog("====================================");
        clog("click_hdate_arr ",click_hdate_arr);
        clog("copy_multi_date ",copy_multi_date);
        showHideMultiRoomsButton();
    }
     //누군가 있는 시간이라면 
    function isInHour(arr,hh){
        var flg = false;
        for(var i = 0 ; i < arr.length;i++){
            if(arr[i] == hh){
                flg = true;
                break;
            }
        }
        return flg;
    }
    //예약되어있는시간 체크하여 배열로 넘겨준다. select box 에서 색깔입히기 위해
    function getINHour(mdate){


        var arr = [];

        for(var i = 0 ; i < alldata.length;i++){
            var date = new Date(alldata[i].start);
            var yy = date.getFullYear();
            var mm = parseInt(date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : ""+(date.getMonth()+1);
            var dd = parseInt(date.getDate()) < 10 ? "0"+(date.getDate()) : ""+date.getDate();
            var hh = date.getHours();
            var thisday = yy+"-"+mm+"-"+dd;

            if(thisday == mdate){
                arr.push(hh);
            }
        }
        return arr;
    }
    function onClickRoomCopy(){
        var input_minicalendar_opentime = document.getElementById("input_minicalendar_opentime");
        if(before_copydates.length == 0){
            alertMsg("복사할 날짜를 선택하세요.");
            return;
        }
        else if(before_pastedates.length == 0){
            alertMsg("붙여넣기할 날짜를 선택하세요.");
            return;
        }else if(!input_minicalendar_opentime.value){
            alertMsg("오픈할 시간을 선택하세요");
            return;
        
        }else if(compare_date(before_pastedates[0],input_minicalendar_opentime.value) == -1){
            alertMsg("오픈시간은 붙여넣기할 날짜보다 이전이어야 합니다.");
            return;
        }
        
        pasteRooms(before_copydates,before_pastedates,input_minicalendar_opentime.value);
    }
    function insert_gxroom(){
         var date = new Date(window.options.date);
        var yy = date.getFullYear();
        var mm = parseInt(date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : ""+(date.getMonth()+1);
        var dd = parseInt(date.getDate()) < 10 ? "0"+(date.getDate()) : ""+date.getDate();
        var thisday = yy+"-"+mm+"-"+dd;
         var arr_inhours = getINHour(thisday); //array
             var nowdate = new Date();
        update_gxroom(thisday);
    }
    var copy_sdate = "";
    var copy_edate = "";
    var paste_sdate = "";
    var paste_edate = "";
    var before_copydates = [];
    var before_pastedates = [];
    
    //var reset_child = reset_btn.children;
    //clog(reset_child);
    function onclick_hdate(date,type){
        mini_calendar_draw(date,"onclick");
        /* 221031 유진 수정 */
        //reset_btn.cssText = 'background-color: #009ef7; color: #fff;';
        clog(reset_btn);
        var reset_child = $(reset_btn).children('i');
        reset_btn.style.cssText = 'background-color: #009ef7;float: left;width: 35px; height: 35px; margin: 10px;border-radius: 7px;';
        $(reset_child).css({
            'color':'#fff'
        });
        /****************** */
    }
   
   function onhover_hdate(date,type){
        mini_calendar_draw(date,"onhover");
        
    }
    function reset_minicalendar(){
         copy_sdate = "";
         copy_edate = "";
         paste_sdate = "";
         paste_edate = "";
         /* 221031 유진 수정 */
         var reset_btn = document.getElementById("reset_btn");
         reset_btn.style.cssText = 'background-color: #e4e6ef;float: left;width: 35px; height: 35px; margin: 10px;border-radius: 7px;';
         var reset_child = $(reset_btn).children('i');
         $(reset_child).css({
            'color':'#a1a5b7'
         });
        clog(reset_btn);
        /********************** */
        //흰색으로 초기화    
       for(var i = 0 ; i < before_copydates.length; i++){
           var listdate = before_copydates[i];
           var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
           var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
            if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "white";
           if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "white";
        }
        setCalendarBGList(before_copydates,"white");    
        //흰색으로 초기화    
       for(var i = 0 ; i < before_pastedates.length; i++){
           var listdate = before_pastedates[i];
           var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
           var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
           if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "white";
           if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "white";
       }
        setCalendarBGList(before_pastedates,"white");   
        minicalendar_title_update();
         before_copydates = [];
         before_pastedates = [];
        
        
    }
    function mini_calendar_draw(date,mousetype){
        
        if(date && mousetype && mousetype == "onclick"){
            if(!copy_sdate || !copy_edate || !paste_sdate || !paste_edate ){
                
                if(copy_sdate && copy_edate && paste_sdate && !paste_edate){
                    var listdates = getDateRange(paste_sdate,date);
                    clog("listdates ",listdates);
                    clog("before_copydates ",before_copydates);
                   if(listdates.length != before_copydates.length){
                       alertMsg("복사할 날짜와 붙여넣기할 날짜 일수는 같아야 합니다.");
                       return;
                   }
                }
                
                if(!copy_sdate || !copy_edate){
                    var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+date);
                    var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+date);
                    if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "#efe8cd";
                    if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "#efe8cd";
                    setCalendarBG(date,"#efe8cd");
                    if(!copy_sdate){
                        copy_sdate = date;    
                    }else{
                        copy_edate = date;
                    }
                    if(copy_sdate && copy_edate){
                        var listdates = getDateRange(copy_sdate,copy_edate);
                        before_copydates = listdates;
                    }

                }else if(copy_sdate && copy_edate && set_minicalendar_type == "copy"){
                    var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+date);
                    var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+date);
                    if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "#ccffff";
                    if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "#ccffff";
                    setCalendarBG(date,"#ccffff");
                    if(!paste_sdate){
                        paste_sdate = date;    
                    }else{
                        paste_edate = date;
                    }
                    if(paste_sdate && paste_edate){
                        var listdates = getDateRange(paste_sdate,paste_edate);
                        before_pastedates = listdates;
                    }
                }
                //수정하기라면
                if(copy_sdate && copy_edate && !paste_sdate && !paste_edate  && set_minicalendar_type == "change"){
                    updatemultirooms();
                }
                
            }
            
        }
        else if(date && mousetype && mousetype == "onhover"){
            if(copy_sdate && !copy_edate && !paste_sdate && !paste_edate ){
               var listdates = getDateRange(copy_sdate,date);
               //흰색으로 초기화    
               for(var i = 1 ; i < before_copydates.length; i++){
                   var listdate = before_copydates[i];
                   var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
                   var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
                    if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "white";
                   if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "white";
               }
                
               setCalendarBGList(before_copydates,"white"); 
               for(var i = 1 ; i < listdates.length; i++){
                    var listdate = listdates[i];
                    var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
                    var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
                    if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "#fff8dd";
                    if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "#fff8dd";
               }
               setCalendarBGList(listdates,"#fff8dd","#efe8cd");    
               before_copydates = listdates;
            
            }else if(copy_sdate && copy_edate && paste_sdate && !paste_edate && set_minicalendar_type == "copy"){
                   var listdates = getDateRange(paste_sdate,date);
                   
                   //흰색으로 초기화    
                   for(var i = 1 ; i < before_pastedates.length; i++){
                       var listdate = before_pastedates[i];
                       var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
                       var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
                        if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "white";
                       if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "white";
                   }
                   setCalendarBGList(before_pastedates,"white"); 
                   for(var i = 1 ; i < listdates.length; i++){
                        var listdate = listdates[i];
                        var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
                        var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
                        if(now_hclickdate0)now_hclickdate0.style.backgroundColor = "#ddffff";
                        if(now_hclickdate1)now_hclickdate1.style.backgroundColor = "#ddffff";
                   }
                   setCalendarBGList(listdates,"#ddffff","#ccffff");    
                   before_pastedates = listdates;
            }
            
        }
        else{
            
            for(var i = 0 ; i < before_copydates.length; i++){
                var listdate = before_copydates[i];
                var color = i == 0 || i == before_copydates.length -1 ? "#efe8cd" : "#fff8dd";
                var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
                var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
                if(now_hclickdate0)now_hclickdate0.style.backgroundColor = color;
                if(now_hclickdate1)now_hclickdate1.style.backgroundColor = color;
                
           }
           setCalendarBGList(before_copydates,"#fff8dd","#efe8cd");    
            
           if(set_minicalendar_type == "copy"){
               for(var i = 0 ; i < before_pastedates.length; i++){
                    var listdate = before_pastedates[i];
                    var color = i == 0 || i == before_pastedates.length -1 ? "#ccffff" : "#ddffff";
                    var now_hclickdate0 = document.getElementById("copy0_hcalendar-day_"+listdate);
                    var now_hclickdate1 = document.getElementById("copy1_hcalendar-day_"+listdate);
                    if(now_hclickdate0)now_hclickdate0.style.backgroundColor = color;
                    if(now_hclickdate1)now_hclickdate1.style.backgroundColor = color;

               }
               setCalendarBGList(before_pastedates,"#ddffff","#ccffff");        

           }
            
        }
//        clog("mousetype "+mousetype+" isshow_minicalendar "+isshow_minicalendar);
        if(!mousetype && isshow_minicalendar)
              mlistClick(1);
        
        minicalendar_title_update();
        
    }
    function minicalendar_title_update(){
//        var mini_btn_title = document.getElementById("mini_btn_title");
        var minicalendar_title = document.getElementById("minicalendar_title");
        
        if(set_minicalendar_type == "copy"){
//            mini_btn_title.innerHTML = "[그룹복사]";
            if(!copy_sdate || !copy_edate){
                minicalendar_title.innerHTML = "복사할 날짜를 선택하세요";
//                minicalendar_title.style.color = "#3f4254";
            }
            else if(copy_sdate && copy_edate && !paste_sdate || copy_sdate && copy_edate && !paste_edate){
                minicalendar_title.innerHTML = "붙여넣기 할 날짜를 선택하세요";
//                minicalendar_title.style.color = "blue";
            }else if(copy_sdate && copy_edate && paste_sdate && paste_edate){
                var csm = stringGetMonth(copy_sdate);
                var csd = stringGetDay(copy_sdate);
                var cem = stringGetMonth(copy_edate);
                var ced = stringGetDay(copy_edate);

                var psm = stringGetMonth(paste_sdate);
                var psd = stringGetDay(paste_sdate);
                var pem = stringGetMonth(paste_edate);
                var ped = stringGetDay(paste_edate);
                var sdate_txt = csm != cem ? csm+"."+csd+"~"+cem+"-"+ced : csm+"."+csd+"~"+ced;
                var pdate_txt = psm != pem ? psm+"."+psd+"~"+pem+"-"+ped : psm+"."+psd+"~"+ped;
                minicalendar_title.innerHTML = sdate_txt+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;▶&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+pdate_txt;
//                minicalendar_title.style.color = "blue";
            }
        }else{
//            mini_btn_title.innerHTML = "[그룹수정]";
             if(!copy_sdate || !copy_edate){
                minicalendar_title.innerHTML = "수정할 날짜를 선택하세요";
//                minicalendar_title.style.color = "red";
             }
             else if(copy_sdate && copy_edate && !paste_sdate && !paste_edate){
                var csm = stringGetMonth(copy_sdate);
                var csd = stringGetDay(copy_sdate);
                var cem = stringGetMonth(copy_edate);
                var ced = stringGetDay(copy_edate);
                var sdate_txt = csm != cem ? csm+"-"+csd+"~"+cem+"-"+ced : csm+"-"+csd+"~"+ced;
                minicalendar_title.innerHTML = sdate_txt;
//                minicalendar_title.style.color = "blue";
            }
        }
        
    }
    
    function reset_room_arr(date,ispush){
//        clog("bb ",click_hdate_arr);
        if(date){
            if(ispush)click_hdate_arr.push(date);
            else{
                var clickarr = [];
                for(var i = 0 ; i < click_hdate_arr.length;i++)
                    if(click_hdate_arr[i] != date)
                        clickarr.push(click_hdate_arr[i]);

                click_hdate_arr = clickarr;
            }
        }
        
        click_hdate_arr = trim_sort_1array(click_hdate_arr);
//        clog("aa ",click_hdate_arr);
        var copyarr = [];
        for(var i = 0 ;i < copy_multi_date.length;i++){
             var isclickin = false;
             for(var j = 0 ;j < click_hdate_arr.length;j++){
                if(click_hdate_arr[j] == copy_multi_date[i]){
                    isclickin = true;
                    break;
                }
             }
             if(isclickin)copyarr.push(copy_multi_date[i]);
        }
        copy_multi_date = copyarr;
//        clog("")
    }
     function showHideMultiRoomsButton(){
//        var btn_create_multirooms = document.getElementById("btn_create_multirooms");//한꺼번에 강좌만들기
//        var btn_update_multirooms = document.getElementById("btn_update_multirooms");//한꺼번에 강좌수정하기
//        var btn_copy_multirooms = document.getElementById("btn_copy_multirooms"); // 강좌정보 복사하기
//        var btn_paste_multirooms = document.getElementById("btn_paste_multirooms"); // 강좌정보 붙여넣기
//        if(click_hdate_arr.length > 0){
//            //복사한 강좌정보가 있다면
//            if(copy_multi_date.length > 0){
//                //복사한 강좌정보가
//                btn_create_multirooms.style.display = "none";
//                btn_update_multirooms.style.display = "none";
//                btn_copy_multirooms.style.display = copy_multi_date.length == click_hdate_arr.length ? "none" : "block";
//                btn_paste_multirooms.style.display = copy_multi_date.length*2 == click_hdate_arr.length ? "block" : "none";  
//               
//                
//            }
//            //복사한 강좌정보가 없다면
//            else {
//                btn_create_multirooms.style.display = "block";
//                btn_update_multirooms.style.display = isInRoom() ? "block" : "none";
//                btn_copy_multirooms.style.display = "block";  
//                btn_paste_multirooms.style.display = "none";  
//                
//            }
//            
//            
//        }
//            
//        else{
//            btn_create_multirooms.style.display = "none";
//            btn_update_multirooms.style.display = "none";
//            btn_copy_multirooms.style.display = "none";
//            btn_paste_multirooms.style.display = "none";
//            
//        } 
            
    }
    function getTimesTable(rows){
        if(!rows || rows && rows.length == 0){
            return "<br>목록이 없습니다.<br>";
        }
        rows.sort();
        multitimes_arr = [];
        var div_croom_table =document.createElement("div");
        var table = document.createElement("table");
        div_croom_table.appendChild(table);

        table.border = "1"; //테두리랑
        table.style.width = "auto";
    //    table.style.margin = "10px";
        table.id = "InputLogDataTable";
        table.className="table table-bordered";
        table.style.width="100%";
        table.style.float= "center";
        table.align='center';
        var len = rows.length;
        var thead_th_tag = "<th>시간</th>";
        for(var i = 0; i < len;i++)
            thead_th_tag+="<th>"+rows[i]+"</th>";
        clog("thead_th_tag",thead_th_tag);
        table.innerHTML = "<thead><tr style='height:30px;background-image:linear-gradient(to bottom, #dff0d8 0px, #c8e5bc);font-size:12px;text-align:center;' align='center' >"+thead_th_tag+"</tr></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];

        var foot = table.getElementsByTagName("tfoot")[0];
        
        if (len > 0) {
            var beforepaymentid = "";
            var isbeforesame = false;
            for (var j = 6; j < 24; j++) {
                var hour = j < 10 ? "0"+j : j;
                
                var brow = body.insertRow();
                brow.align = "center";
                brow.style.padding= "10px";
                brow.style.height = "30px";
                brow.style.backgroundColor = "white"; 
                
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = hour+"";
                bcell_index.style.maxWidth="30px";
                for (var i = 0; i < len; i++) {
                    
                    var date_arr = rows[i].split("-");
                    var year = date_arr[0];
                    var month = parseInt(date_arr[1]) < 10 ? "0"+parseInt(date_arr[1]) : ""+parseInt(date_arr[1]);
                    var day = parseInt(date_arr[2]) < 10 ? "0"+parseInt(date_arr[2]) : ""+parseInt(date_arr[2]);
                    var date = year+"-"+month+"-"+day;
                    var id = date+" "+hour+":00:00";    
                    var cell = brow.insertCell();
                    cell.id = "timeroom_"+id;
                    cell.innerHTML = "<text style='width:100%;height:100%' onclick='click_multitimes(\""+id+"\")'>강좌예약하기</text>";
                    cell.onclick = function(){
                        clog("cell click!!");
                        click_multitimes(id);
                    }
                }
            }
        }
        
        return div_croom_table.innerHTML;  

    }
    var multitimes_arr = [];
    function click_multitimes(id){
        var timeroom = document.getElementById("timeroom_"+id);
        var isin = -1;
        for(var i = 0 ; i < multitimes_arr.length; i++){
            if(multitimes_arr[i] == id){
                isin = i;
                break;
            }
        } 
        if(isin >= 0){
            multitimes_arr.pop(id);
            timeroom.style.backgroundColor = "white";
        }else {
            multitimes_arr.push(id);
            timeroom.style.backgroundColor = "yellow";
        }
        
    }
    //한꺼번에 강좌 수정하기
    function updatemultirooms(){
       
         var message =  "<label class='textevent' style='width:100%:color:red'>※그룹수정은 오픈시간, 강좌활성/비활성 여부만 설정가능합니다.</label><br>"+
             
             "<table class='form-control' style='width:auto;height:auto;' >"+
                            "<tbody style='width:100%;float:center;'>"+
                                "<tr style='width:50%'>"+                                           
                                    "<td>"+
                                        "<label class='textevent' style='background-image:linear-gradient(to bottom, #ffeeee 0px, #ffdddd 100%)'>오픈시간 선택</label>"+
                                    "</td>"+     
                                    "<td>"+
                                        "<label class='textevent' style='background-image:linear-gradient(to bottom, #ffeeee 0px, #ffdddd 100%)'>활성/비활성 설정</label>"+
                                    "</td>"+     
                                 "</tr>"+
                                 "<tr>"+                                            
                                    "<td  style='width:50%'>"+
                                        "<input class='form-control' type='datetime-local' id='id_all_opentime' placeholder='통합 오픈시간을 입력하세요...'/>"+
                                    "</td>"+   
                                    "<td style='width:50%'>"+
                                        "<select class='form-control' id='id_all_showhide' ><option >== 활성/비활성 선택 ==</option><option value='Y'>강좌 활성</option><option value='N'>강좌 비활성</option></select>";
                                    "</td>"+   
                                 "</tr>"+
                            "</tbody"+
                        "</table>";
             
        showModalDialog(document.body, "강좌그룹 수정하기", message, "강좌그룹 수정하기", "취소", function() {
            var id_all_opentime = document.getElementById("id_all_opentime");
            var id_all_showhide = document.getElementById("id_all_showhide");
            if(!id_all_opentime.value && !id_all_showhide.value){
                alertMsg("최소 1개 이상은 수정해야 합니다.");
                return;
            }
            var rooms = getInRooms();
            var minopentime = getMinOpentime(rooms);
            
            if(id_all_opentime.value && isOpentime(rooms,id_all_opentime.value)){
                alertMsg("오픈시간은  "+minopentime+" 보다 이전시간으로 설정해야합니다. ");
                return;
            }
            
            var times = [];//사용하지 않음
            for(var i = 0; i < rooms.length; i++){
                if(id_all_opentime.value){
                   rooms[i].room_opentime = id_all_opentime.value;
                }
                if(id_all_showhide.value == "Y" || id_all_showhide.value == "N"){
                    clog("id_all_showhide.value ",id_all_showhide.value);
                    rooms[i].room_isshow = id_all_showhide.value == "Y" ? "1" : "0";
                }
            }
            updateRooms(rooms);
        }, function() {
            hideModalDialog();
        },null);
        
//        update_gxroom(time,yearmonthnum,roomid);
    }
    function isOpentime(rooms,opentime){
        var minopentime = "";
        for(var i = 0 ; i < rooms.length;i++){
            if(!minopentime || minopentime && compare_date(minopentime,rooms[i].room_datetime) == 1)
                minopentime = rooms[i].room_datetime;
        }
        if(compare_date(minopentime,opentime) == 1)
            return false;
        else 
            return true;
        
    }
    function getMinOpentime(rooms){
        var minopentime = "";
        for(var i = 0 ; i < rooms.length;i++){
            if(!minopentime || minopentime && compare_date(minopentime,rooms[i].room_datetime) == 1)
                minopentime = rooms[i].room_datetime;
        }
        return minopentime;
    }
    function getMinTime(times){
        var minopentime = "";
        for(var i = 0 ; i < times.length;i++){
            if(!minopentime || minopentime && compare_date(minopentime,times[i]) == 1)
                minopentime = times[i];
        }
        return minopentime;
    }
    //여러개 강좌만들기 
    function createmultirooms(){
        var style = {
            bodycolor: "#eeeeee",
            size: {
                width: "85%",
                height: "50%"
            }
        };
        var create_rooms_tag = getTimesTable(click_hdate_arr);
        showModalDialog(document.body, "강좌그룹 만들기", create_rooms_tag, "강좌그룹만들기", "취소", function() {

           update_gxroom(multitimes_arr,null,null);
        }, function() {
            hideModalDialog();
        },style);
        
//        update_gxroom(time,yearmonthnum,roomid);
    }
    var now_week_count = 1;
    //강좌정보 복사하기
    function copymultirooms(start_week,week_count){
        now_week_count = week_count;
        //달력색상 흰색으로 초기화
        initClickDates();
        
        
        //달력 색칠하기
        click_hdate_arr = getWeekDays(start_week,week_count);
        copy_multi_date = [];
        for(var i = 0 ; i < click_hdate_arr.length;i++){
            var date = click_hdate_arr[i];
//            var nowclickdate = document.getElementById("hcalendar-day_"+date);
//            nowclickdate.style.backgroundColor="#80dbff";
            setCalendarBG(date,2);
        }
        copy_multi_date = C_Clone(click_hdate_arr);
        showHideMultiRoomsButton();
       pasteMultiRooms();     
        
//        
//        var message = "선택한 강좌정보를 복사하였습니다.<br>강좌정보를 붙여넣기 할 날짜를 선택해 주세요<br><input id='paste_date' type='date' onchange='onchange_paste_date()'/><br>오픈날짜시간: "+"<text class='textevent' style='float:left'>오픈날짜 설정</text><bar><input class='form-control' type='datetime-local' id='id_paste_opentime'/>";
//         showModalDialog(document.body, "강좌 정보 복사", message, "붙여넣기", "취소", function() {
//             var paste_date = document.getElementById("paste_date").value;
//             var id_paste_opentime = document.getElementById("id_paste_opentime");
//             if(compare_date(id_paste_opentime.value, click_hdate_arr[0]) == 1){
//                alertMsg("오픈날짜는 붙여넣을 날짜보다 작아야 합니다.");
//                return;
//             }
//             if(paste_date)
//                pasteMultiRooms();     
//            
//        }, function() {
//            hideModalDialog();
//        },null);

    }
    function initClickDates(){
        //달력색상 흰색으로 초기화
        if(click_hdate_arr.length > 0){
             for(var i = 0 ; i < click_hdate_arr.length;i++){
                var date = click_hdate_arr[i];
                setCalendarBG(date,0);
             }
        }
    }
    function onchange_paste_date(){
        var paste_date = document.getElementById("paste_date").value;
        
    }
    //강좌정보 붙여넣기
    function pasteMultiRooms(){
        
        
        
        //차집합
//        for(var j=0; j < copy_multi_date.length; j++) {
//            for(var i = 0; i < click_hdate_arr.length; i++){             
//                if(copy_multi_date[j] == click_hdate_arr[i]){
//                    click_hdate_arr.splice(i,1);
//                    break;
//                } 
//            }
//        }
        copy_multi_date.sort();
        click_hdate_arr.sort();
        clog("강좌정보 붙여넣기 click_hdate_arr ",click_hdate_arr);
        //여기부터해야함
        //여기부터해야함
//        여기부터해야함
//        여기부터해야함
//        여기부터해야함
        
       // var message = copy_multi_date[0]+" ~ "+copy_multi_date[copy_multi_date.length-1]+" 강좌정보 데이타를 "+click_hdate_arr[0]+" ~ "+click_hdate_arr[click_hdate_arr.length-1]+" 날짜로 붙여넣기 합니다.<br>"+
         var message = "선택한 강좌정보를 복사하였습니다.<br>강좌정보를 붙여넣기 할 주를 선택해 주세요<br><text class='textevent' style='float:left'>붙여넣기할 시작주 선택</text><input class='form-control'  id='paste_date' type='date' onchange='onchange_paste_date()'/><br>"+
            "<text class='textevent' style='float:left'>오픈날짜시간 설정</text><bar><input class='form-control' type='datetime-local' id='id_paste_opentime'/>";
        showModalDialog(document.body, "강좌정보 복사", message, "강좌정보 복사하기", "취소", function() {
            
            var paste_date = document.getElementById("paste_date").value;
            click_hdate_arr = getWeekDays_Paste(paste_date,now_week_count);
            
            var id_paste_opentime = document.getElementById("id_paste_opentime");
            if(compare_date(id_paste_opentime.value, click_hdate_arr[0]) == 1){
                alertMsg("오픈날짜는 붙여넣을 날짜보다 작아야 합니다.");
                return;
            }
             
            pasteRooms(copy_multi_date,click_hdate_arr,id_paste_opentime.value);
            
        }, function() {
            hideModalDialog();
            //달력색상 흰색으로 초기화
            initClickDates();
        },null);
    }
    
    function setCalendarBG(date,color){
       
        var allblock = document.getElementsByClassName("calendar-day");
       
        for(var i = 0 ; i < allblock.length; i++){
//            var classname = allblock[i].className;
            var tddate = new Date(allblock[i].getAttribute('data-date'));
            var yy = tddate.getFullYear();
            var mm = tddate.getMonth()+1 < 10 ? "0"+(tddate.getMonth()+1) : ""+(tddate.getMonth()+1);
            var dd = tddate.getDate() < 10 ? "0"+tddate.getDate() : ""+tddate.getDate();
            var strdate = yy+"-"+mm+"-"+dd;
            
            
            if(strdate == date){
                allblock[i].style.backgroundColor = color;
            }            
        }        
    }
    function setCalendarBGList(dates,color,first_last_color){
       
        var allblock = document.getElementsByClassName("calendar-day");
       for(var j = 0 ; j < dates.length; j++){
           var date = dates[j];
            for(var i = 0 ; i < allblock.length; i++){
//            var classname = allblock[i].className;
            
                var tddate = new Date(allblock[i].getAttribute('data-date'));
                var yy = tddate.getFullYear();
                var mm = tddate.getMonth()+1 < 10 ? "0"+(tddate.getMonth()+1) : ""+(tddate.getMonth()+1);
                var dd = tddate.getDate() < 10 ? "0"+tddate.getDate() : ""+tddate.getDate();
                var strdate = yy+"-"+mm+"-"+dd;

            
                
                
                if(strdate == date){
                    if(first_last_color && j == 0 || first_last_color && j == (dates.length-1))
                        allblock[i].style.backgroundColor = first_last_color;
                    else 
                        allblock[i].style.backgroundColor = color;
                }    
            }
                        
        }        
    }
    function download_excel(){
        
        exportExcelFile(getData("nowcentername")+"_"+(thisyear)+"년_"+(thismonth)+"월_매출목록_"+getToday()+".xlsx");
    }
    
    function showCenterGX(centercode,year){

        clog("센터 GX 보여준다.");

         //전체를 가져온다.
         var value1 = {
            year : year,
            month : 0,
            day : 0,
            uid : param_useruid
        }
        getGXReservationData(value1,function(res){
            clog("gxdata ",res);
            if(res.code == 100){
               clog("thisyear is "+thisyear);
               gxuserinfos = res.gxuserinfos;
               insertCalenderDatas(res.message);
               allgxreservation = res.message;
               gxtypes = res.gxtypes;
                clog("gxtypes ",gxtypes);
               gxteachers = res.gxteachers;
              
              div_center_list.style.display = "none";
               div_main.style.display = "block";   
               setZoom(0.3);
               initSearchSource(gxuserinfos);
                isloaddata = true;
                initAutoComplete();
                gxPermissionCheck();
            }else{
               
               C_showToast( "에러", "데이터를 가져올 수 없습니다. 다시 시도하세요", function() {});
                
            }
            hideModalDialog();
        });
    }
    function initSearchSource(infos){
        infos.sort(sort_by('mem_username', false, (a) => a.toUpperCase()));
        searchSource = [];
        for(var i = 0 ; i < infos.length;i++)
            searchSource.push({"label":infos[i].mem_username+"      "+infos[i].mem_userid,"userid":infos[i].mem_userid,"value":infos[i].mem_uid});
        clog("searchSource ",searchSource);
    }
    function onchange_gxroomdata(key,minopentime,arg1,arg2){
//        var keys = ["select_gxtype","select_gxmin","select_gxteacher","input_gx_max","input_opentime","input_reservationmin","input_cancel_reservationmin","select_isshow","input_gx_note"];
        var select_gxtype = document.getElementById("select_gxtype");
        var select_gxdetailname = document.getElementById("select_gxdetailname");
        var select_gxmin = document.getElementById("select_gxmin");
        var select_gxlessontime = document.getElementById("select_gxlessontime");
        var select_gxteacher = document.getElementById("select_gxteacher");
        var input_gx_max = document.getElementById("input_gx_max");
        var input_opentime = document.getElementById("input_opentime");
        var input_reservationmin = document.getElementById("input_reservationmin");
        var input_cancel_reservationmin = document.getElementById("input_cancel_reservationmin");
        var select_isshow = document.getElementById("select_isshow");
        var input_gx_note = document.getElementById("input_gx_note");
        
        var select_push = document.getElementById("idroomtoggle_select_push");
        var select_autocheckin = document.getElementById("idroomtoggle_select_autocheckin");
        var select_autoreadyin = document.getElementById("idroomtoggle_select_autoreadyin");
        var input_maxreservation = document.getElementById("input_maxreservation");
        
        
        if(key)
        switch(key){
            case 1://select_gxtype
                var gxtype = getGXType(select_gxtype.value)
                
                input_gx_max.value = gxtype.max;
                input_reservationmin.value = gxtype.insertmaxtime;
                input_cancel_reservationmin.value = gxtype.canceltime;
                input_opentime.value = checkOpenTime(gxtype.gxopentime,minopentime);
                
                select_push.checked = gxtype.push && gxtype.push == "0" ? false : true;
                select_autocheckin.checked = gxtype.gxautocheckin && gxtype.gxautocheckin == "0" ? false : true;
                select_autoreadyin.checked = gxtype.gxautoreadyin && gxtype.gxautoreadyin == "0" ? false : true;
                if(input_maxreservation.value == "0")input_maxreservation.value =  gxtype.gxmaxreservation;
                
                onchangeRoomToggle("select_push");onchangeRoomToggle("select_autocheckin");onchangeRoomToggle("select_autoreadyin");
                
                var gxdetailname_optiontag = "";
                var detailname_arr = gxtype.detailname.split(',');
                var darr = [];
                for(var i = 0 ; i < detailname_arr.length; i++){
                    var dname = detailname_arr[i].trim();
                    if(dname)
                        gxdetailname_optiontag += "<option value='"+dname+"' >"+dname+"</option>";            
                }                    
                select_gxdetailname.innerHTML = gxdetailname_optiontag;
                break;
            case 2://select_gxteacher
                break;
            case 3://input_gx_max
                var newmax = parseInt(input_gx_max.value);
                //arg1 = roomusers.length , arg2 : before_max
                if(newmax < parseInt(arg1)){
                                 
                    alertMsg("경고! 현재예약된 회원수가 입장최대인원수보다 큽니다. 회원을 미리 삭제후 입장최대인원수를 수정하세요");
                    input_gx_max.value = arg2;
                    return;
            
                }
                break;
            case 4://input_opentime
                if(value){
                    var roomtime = value;
                    if(compare_date(roomtime,input_opentime.value) < 0){
                        alertMsg("현재강좌시간보다 오픈하는 시간은 클 수 없습니다.");
                        input_opentime.value = "";
                        return;
                    }
                }
                break;
            case 5://input_reservationmin
                break;
            case 6://input_cancel_reservationmin
                break;
            case 7://select_isshow
                break;
            case 8://input_gx_max
                break;
            
        }
        check_gxroomdata();   
    }
    function checkOpenTime(opentimetype,minopentime){
        var rstr = "";
        var date = new Date(minopentime);
        
        var dayweek = date.getDay();
        switch(opentimetype){
            case "open_sunday":
                
                date.setDate(date.getDate() - dayweek);
                break;
            case "open_monday":
                var mday = (dayweek + 6)%7;
                date.setDate(date.getDate() - mday);
                break;
            case "open_tuesday":
                var mday = (dayweek + 5)%7;
                date.setDate(date.getDate() - mday);
                break;
            case "open_wednesday":
                var mday = (dayweek + 4)%7;
                date.setDate(date.getDate() - mday);
                break;
            case "open_thursday":
                var mday = (dayweek + 3)%7;
                date.setDate(date.getDate() - mday);
                break;
            case "open_friday":
                var mday = (dayweek + 2)%7;
                date.setDate(date.getDate() - mday);
                break;
            case "open_saturday":
                var mday = (dayweek + 1)%7;
                date.setDate(date.getDate() - mday);
                break;
            case "open_1day":
                date.setDate(date.getDate() - 1);
                break;
            case "open_2day":
                date.setDate(date.getDate() - 2);
                break;
            case "open_3day":
                date.setDate(date.getDate() - 3);
                break;
            case "open_4day":
                date.setDate(date.getDate() - 4);
                break;
            case "open_5day":
                date.setDate(date.getDate() - 5);
                break;
            case "open_6day":
                date.setDate(date.getDate() - 6);
                break;
            case "open_7day":
                date.setDate(date.getDate() - 7);                
                break;
            case "now":
                rstr = getOpenDateTime();
                break;              
        }
        if(opentimetype != "now")date.setHours(0);
        rstr = opentimetype == "now" ? getOpenDateTime() : getOpenDateTime(date.getTime());
//        clog("opentime is "+rstr);
        return rstr;
    }
    function getOpenDateTime(date){
        if(date)var date = new Date(date);
        else var date  = new Date();
        
      
        
        var y = date.getFullYear();
        var m = date.getMonth()+1; 
        var mm  = m < 10 ? "0"+m : m;
        var d = date.getDate();
        var dd = d < 10 ? "0"+d : d;
        
        var h = date.getHours();
        var hh = h < 10 ? "0"+h : h;
        var im = date.getMinutes(); 
        var imm = im < 10 ? "0"+im : im;
//        var s = date.getSeconds(); 
//        var ss = s < 10 ? "0"+s : s;
//        var rdate = new Date(y, m, d, hh, mm, ss);
        var rstr = y+"-"+mm+"-"+dd+"T"+hh+":"+imm;
        return rstr;
        
    }
    function check_gxroomdata(){
        var keys = ["select_gxtype","select_gxmin","select_gxteacher","input_gx_max","input_opentime","input_reservationmin","input_cancel_reservationmin","select_isshow","input_gx_note"];
        var isok = true;
        for(var i = 0; i < keys.length;i++){
            var obj = document.getElementById(keys[i]);
            if(obj){
                if(!obj.value){

                    document.getElementById("label_"+keys[i]).style.color="red";
                    if(i != 8)isok = false;
                }

                else {
                    document.getElementById("label_"+keys[i]).style.color="black";
                }
            }
            
                
        }
        return isok;
    }
    function getRoomdata(roomid){
        var return_roomdata = null;
        if( !roomid)
            return null;
        for(i = 0; i < allgxreservation.length; i++) {
            var roomdata = JSON.parse(allgxreservation[i].gx_roomdata);
          
                    if(roomid == roomdata.room_id){
                        return_roomdata = roomdata;
                        break;
                    }
                    
                
        }
        return return_roomdata;
    }
    function getGXType(type){
        var gxtype = null;
        for(var i = 0 ; i < gxtypes.length;i++){
            if(gxtypes[i].id == type){
                gxtype = gxtypes[i];
                break;
            }
        }
        return gxtype;
    }
    // 강좌만들기 / 강좌수정하기
    function update_gxroom(_datetimes,yearmonthnum,roomid){ //roomid 선택사항
        
        
         //강좌추가 권한
        if(!roomid && !isPermission(222)){
            alertMsg("강좌추가에 대한 권한이 없습니다.");
            return;
        }
        //강좌수정 권한 
        else if(roomid && !isPermission(223)){
            alertMsg("강좌 수정에 대한 권한이 없습니다.");
            return;
        }
        
        
        
        clog("_datetimes",_datetimes );
        
        var datetimes = [];
        var poptitle = "";
        var single_roomtime = ""; //강좌을 1개만 수정하거나 만들때
        var strhour = "";
        if(typeof(_datetimes) == "string"){
            datetimes.push(_datetimes);
            
            var mhour = "";
            if(_datetimes.length > 10)
               mhour = stringGetHour(_datetimes);
           
            poptitle = stringGetYear(_datetimes)+"-"+stringGetMonth(_datetimes)+"-"+stringGetDay(_datetimes);
            single_roomtime = _datetimes;
            
            clog(_datetimes+" 00 poptitle "+poptitle);
            
            
            var arr_inhours = getINHour(thisday); //array
            var nowdate = new Date();
            var starthour = getToday() == thisday ? nowdate.getHours()+1 : 6;
            if(starthour == 24 || starthour < 6)starthour = 6;
             
             clog(starthour+" arr_inhours ",arr_inhours);
             var option_hour_tag = "<option value=''>시간</option>";
//             var objs = [];
             for(var i = starthour ; i < 24; i++){
                 var hourtxt = i < 10 ? "0"+i : ""+i;
                 var isin = isInHour(arr_inhours, i);
                 var optionbg = isin ? mColor.C111111 : "#fffd0022";
                 var textcolor = isin ? "#666666" : "white";
                 var selected = mhour && parseInt(mhour) == i ? "selected disabled" : "";
                 if(selected){
                     option_hour_tag = "<option style='' value = '"+hourtxt+"' "+selected+">"+hourtxt+"시</option>";
                     break;
                 }else 
                    option_hour_tag += "<option style='' value = '"+hourtxt+"' "+selected+">"+hourtxt+"시</option>";
                 
                 
//                 objs.push({"value":hourtxt,"text":hourtxt,"imgname":"","optionbg":optionbg,"textcolor":textcolor});
             }
             var strhour = "<select id='select_hour'  style='width:70px; height:30px;font-size:14px;background-color:#f5f8fa;border-radius:6px;padding-left:10px;border:0px'>"+option_hour_tag+"</select>";
            
        }else {
            datetimes = _datetimes;
            poptitle = "강좌그룹";
        }
        var minopentime = getMinTime(datetimes);    
        
        clog("update_gxroom times ",_datetimes);
        var title = roomid ? "강좌 수정" : "강좌 입력";
        if(auth <= AUTH_TRANER){
            alertMsg(title+"는 강사등급보다 높아야합니다.");
            return;
        }
       
        
        var beforeroomid = "";
       
        if(roomid){
            var roomdata = getRoomdata(roomid);
            clog("000 roomdata ",roomdata);
            if(!roomdata){
                alertMsg("강좌정보를 찾을 수 없습니다.");
                return;
            }
            beforeroomid = roomdata.room_id;
            
            var idarr = roomdata.room_id.split('_');
            var rtype = idarr[1];// 날짜를 뺀 룸아이디 ym_type_datetime    ex)23324_1_2022-04-25 12:00:00
            var rdatetime = roomdata.room_datetime;// 날짜 시간 ex)2022-04-25 12:00:00
            //poptitle = stringGetYear(rdatetime)+"년 "+stringGetMonth(rdatetime)+"월 "+stringGetDay(rdatetime)+"일 "+stringGetHour(rdatetime)+"시";
            clog("rdatetime "+rdatetime);
            poptitle = stringGetYear(rdatetime)+"년 "+stringGetMonth(rdatetime)+"월 "+stringGetDay(rdatetime)+"일 ";
            
            var rmin = parseInt(roomdata.room_min);// 분
            var rlessontime = roomdata.room_lessontime ? parseInt(roomdata.room_lessontime) : 50;// 분
            
            var rname = roomdata.room_name;// 강좌이름
            var rdetailname = roomdata.room_detailname;// 세부강좌명
            var rmax = roomdata.room_max;// 최대인원수
            var rmanagerid = roomdata.room_managerid;// 강사uid
            var rmanagername = roomdata.room_managername;// 강사이름
            var ropentime = roomdata.room_opentime;// 오픈시간
            var rreservationmin = roomdata.room_reservationmin;// 예약가능시간
            var rcancelreservationmin = roomdata.room_cancelreservationmin;// 취소가능시간
            var risshow = roomdata.room_isshow;// 강좌 보여짐,안보여짐
            var rnote = roomdata.room_note;// 강좌 Note
            
            var gxtype = getGXType(rtype);
            var rpush = roomdata.room_push ? roomdata.room_push : "0";
            var rautocheckin = roomdata.room_autocheckin ? roomdata.room_autocheckin : "0";
            var rautoreadyin = roomdata.room_autoreadyin ? roomdata.room_autoreadyin : "0";
            
            var roomusers = roomdata.room_users ? roomdata.room_users : [];
            var roomreadyusers = roomdata.room_readyusers ? roomdata.room_readyusers : [];
            
//            clog("000 roomusers ",roomusers);
            //var rmaxreservation = roomdata.room_maxreservation ? roomdata.room_maxreservation : 0; // 설정에서 세팅하기때문에 사용하지 않음 XXX
//            clog("000 gxtype ",gxtype);
            var rmaxreservation = gxtype && gxtype.gxmaxreservation ? parseInt(gxtype.gxmaxreservation) : 0; // GX 최대예약횟수는 모든 GX 통합이다.
            
        }else {
            var roomdata = null;
//            clog("111 roomdata ",roomdata);
//            var idarr = roomdata.room_id.split('_');
            var rtype = -1;// 날짜를 뺀 룸아이디 ym_type_datetime    ex)23324_1_2022-04-25 12:00:00
            var rdatetime = single_roomtime ? single_roomtime : "";// 날짜 시간 ex)2022-04-25 12:00:00
            var rlessontime = 50;// 분
            var rmin = 0;// 분
            var rname = "";// 강좌이름
            var rdetailname = "";// 세부강좌명
            var rmax = "";// 최대인원수
            var rmanagerid = "";// 강사uid
            var rmanagername = "";// 강사이름
            var ropentime = "";// 오픈시간
            var rreservationmin = "";// 예약가능시간
            var rcancelreservationmin = "";// 취소가능시간
            var risshow = "1";// 강좌 보여짐,안보여짐
            var rnote = "";// 강좌 Note
            var roomusers = [];
            var roomreadyusers =  [];
            var gxtype = getGXType(rtype);
//             clog("111 gxtype ",gxtype);
            var rpush = gxtype ? gxtype.push : "0";
            var rautocheckin = gxtype ? gxtype.gxautocheckin : "0";
            var rautoreadyin = gxtype ? gxtype.gxautoreadyin : "0";
            var rmaxreservation = gxtype ? gxtype.gxmaxreservation : 0; //roomdata  ? parseInt(roomdata.room_maxreservation) : parseInt(gxtype.gxmaxreservation);  // GX 최대예약횟수는 모든 GX 통합이다.
        }
        
       
        
        var keys = ["select_gxtype","select_gxmin","select_gxteacher","input_gx_max","input_opentime","input_reservationmin","input_cancel_reservationmin","select_isshow","input_gx_note","select_push","select_autocheckin", "select_autoreadyin","input_maxreservation","select_gxdetailname","select_gxlessontime"];
        
        
          
        ////////////////////////////////////
        //GX min 세팅
        ////////////////////////////////////
        var gxmin_optiontag = "";
        for(var i = 0 ; i < 11; i++){
            var min = i*5;
            var selected = min == rmin ? "selected" : "";
            gxmin_optiontag += "<option value='"+min+"' "+selected+">"+min+"분</option>";            
        }
            
        var gxmin_tag = "<select onchange='onchange_gxroomdata(2,\""+minopentime+"\")' id='"+keys[1]+"'  style='width:70px; height:30px;font-size:14px;background-color:#f5f8fa;border-radius:6px;padding-left:10px;border:0px'>"+gxmin_optiontag+"</select>";         
        
        
          
        ////////////////////////////////////
        //GX 레슨시간 기본50분
        ////////////////////////////////////
        var gxlessontime_optiontag = "";
        for(var i = 3 ; i < 13; i++){
            var min = i*10;
            var selected = min == rlessontime ? "selected" : "";
            gxlessontime_optiontag += "<option value='"+min+"' "+selected+">"+min+"분</option>";            
        }
        var gxlessontime_tag = "<select onchange='onchange_gxroomdata(14,\""+minopentime+"\")' id='"+keys[14]+"'  style='width:70px; height:30px;font-size:14px;background-color:#f5f8fa;border-radius:6px;padding-left:10px;border:0px'>"+gxlessontime_optiontag+"</select>";         
        
        
        ////////////////////////////////////
        //강좌 세팅 강좌선택
        ////////////////////////////////////
        var gxtype_optiontag = "<option value=''>강좌를 선택하세요</option>";
        for(var i = 0 ; i < gxtypes.length; i++){
            var selected = gxtypes[i].id == rtype ? "selected" : "";
            clog(i+" gid "+gxtypes[i].id+" rtype "+rtype);
            gxtype_optiontag += "<option value='"+gxtypes[i].id+"' "+selected+">"+gxtypes[i].name+"</option>";        
        }
            
        var gxtype_tag = "<select onchange='onchange_gxroomdata(1,\""+minopentime+"\")'id='"+keys[0]+"' style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'>"+gxtype_optiontag+"</select>";            
      
        ////////////////////////////////////
        //GX 세부강좌명
        ////////////////////////////////////
        var gxdetailname_optiontag = "";
        var detailname_arr = gxtype && gxtype.detailname ? gxtype.detailname.split(',') : [];
        var darr = [];
        for(var i = 0 ; i < detailname_arr.length; i++){
            var dname = detailname_arr[i].trim();
            
            if(dname){
                 var selected = dname == rdetailname ? "selected" : "";
                gxdetailname_optiontag += "<option value='"+dname+"'  "+selected+">"+dname+"</option>";            
            }
                
        }            
        var gxdetailname_tag = "<select id='select_gxdetailname' onchange='onchange_gxroomdata(13,\""+minopentime+"\")' id='"+keys[13]+"'  style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'>"+gxdetailname_optiontag+"</select>";         
        
        
        ////////////////////////////////////
        //GX push 세팅
        ////////////////////////////////////
//        var gxpush_optiontag = rpush == "1" ? "<option value='1' selected>보내기</option><option value='0'>안보내기</option>" : "<option value='1'>보내기</option><option value='0' selected>안보내기</option>" ;
//        var gxpush_tag = "<select onchange='onchange_gxroomdata(10,\""+minopentime+"\")' id='"+keys[9]+"'  style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'>"+gxpush_optiontag+"</select>";         
        var gxpush_isshow = rpush== "1" ? true : false;
        var gxpush_tag = getIsRoomToggleTag(gxpush_isshow,keys[9],10);
        
        
        ////////////////////////////////////
        //GX autocheckin 세팅
        ////////////////////////////////////
//        var gxautocheckin_optiontag = rautocheckin == "1" ? "<option value='1' selected>자동출석하기</option><option value='0'>자동출석안함</option>" : "<option value='1'>자동출석하기</option><option value='0' selected>자동출석안함</option>" ;
//        var gxautocheckin_tag = "<select onchange='onchange_gxroomdata(11,\""+minopentime+"\")' id='"+keys[10]+"'  style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'>"+gxautocheckin_optiontag+"</select>";  
        var gxautocheckin_isshow = rautocheckin== "1" ? true : false;
        var gxautocheckin_tag = getIsRoomToggleTag(gxautocheckin_isshow,keys[10],11);
       
        ////////////////////////////////////
        //GX autoreadyin 세팅
        ////////////////////////////////////
//        var gxautoreadyin_optiontag = rautoreadyin == "1" ? "<option value='1' selected>대기후 자동예약하기</option><option value='0'>자동예약안하기</option>" : "<option value='1'>보내기</option><option value='0' selected>안보내기</option>" ;
//        var gxautoreadyin_tag = "<select onchange='onchange_gxroomdata(12,\""+minopentime+"\")' id='"+keys[11]+"'  style='width:100%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'>"+gxautoreadyin_optiontag+"</select>";         
        var gxautoreadyin_isshow = rautoreadyin== "1" ? true : false;
        var gxautoreadyin_tag = getIsRoomToggleTag(gxautoreadyin_isshow,keys[11],12);
       
        ////////////////////////////////////
        //GX maxreservation 세팅
        ////////////////////////////////////
        var gx_maxreservation_tag = "<input onchange='onchange_gxroomdata(3,\""+minopentime+"\")' id='"+keys[12]+"' placeholder='1주에 최대 예약가능한 횟수를 입력하세요...' value='"+rmaxreservation+"'  style='width:100%;height:45px;font-size:14px;background-color:#ebebeb;border-radius:10px;padding-left:15px;border:0px' disabled/>";
       
        
        ////////////////////////////////////
        //GX강사 세팅
        ////////////////////////////////////
        var gxteachers_optiontag = "<option value=''>강사를 선택하세요</option>";
        for(var i = 0 ; i < gxteachers.length; i++){
            var tselected = gxteachers[i].mem_uid == rmanagerid ? "selected" : "";
            gxteachers_optiontag += "<option value='"+gxteachers[i].mem_uid+"' "+tselected+">"+gxteachers[i].mem_username+"</option>";            
        }
            
        var gxteacher_tag = "<select onchange='onchange_gxroomdata(2,\""+minopentime+"\")'  id='"+keys[2]+"'  style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'>"+gxteachers_optiontag+"</select>";         
       
        ////////////////////////////////////
        //GX 인원수 (최초 빈값) 강좌 선택시 반영됨
        ////////////////////////////////////
        var gx_max_tag = "<input onchange='onchange_gxroomdata(3,\""+minopentime+"\",\""+roomusers.length+"\",\""+rmax+"\",)' id='"+keys[3]+"' placeholder='최대 입장 인원수를 입력하세요...' value='"+rmax+"' style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'/>";
        
        ////////////////////////////////////
        //GX 오픈시간
        ////////////////////////////////////
        clog("ropentime "+ropentime);
        var gx_opentime_tag = "<input id='input_opentime' onchange='onchange_gxroomdata(4,,\""+minopentime+"\")'  type='datetime-local' id='"+keys[4]+"' placeholder='오픈시간을 입력하세요...' value='"+ropentime+"' style='width:100%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px;padding-right:15px'/>";
        
        
        ////////////////////////////////////
        //GX 예약하기 최소시간 
        ////////////////////////////////////
        var gx_reservationtime_tag = "<input onchange='onchange_gxroomdata(5,\""+minopentime+"\")'  type='number' id='"+keys[5]+"' placeholder='최소 예약가능시간을 입력하세요...' value='"+rreservationmin+"' style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'/>";
        
        ////////////////////////////////////
        //GX 예약취소 최소시간
        ////////////////////////////////////
        var gx_cancelreservation_tag = "<input onchange='onchange_gxroomdata(6,\""+minopentime+"\")' type='number' id='"+keys[6]+"' placeholder='최소 예약취소시간 입력하세요...' value='"+rcancelreservationmin+"' style='width:95%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'/>";
        
        ////////////////////////////////////
        //강좌숨김기능 isShow 설정 최초 On
        ////////////////////////////////////
        var y_selected = risshow == "1" ? "selected" : "";
        var n_selected = risshow == "0" ? "selected" : "";
        var gxisshow_tag = "<select onchange='onchange_gxroomdata(7,\""+minopentime+"\")'  id='"+keys[7]+"'  style='width:100%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'><option value='Y' "+y_selected+">강좌보여짐</option><option value='N' "+n_selected+">강좌숨김</option></select>";            
        
        ////////////////////////////////////
        //GX Note
        ////////////////////////////////////
        var gx_note_tag = "<input onchange='onchange_gxroomdata(8,\""+minopentime+"\")'  id='"+keys[8]+"' placeholder='특이사항 입력...' value='"+rnote+"'  style='width:100%;height:45px;font-size:14px;background-color:#f5f8fa;border-radius:10px;padding-left:15px;border:0px'/>";
        
        clog("poptitle "+poptitle);
        var message = "<div style='width:auto;float:center;margin-left:15px;margin-right:15px;'>"+
                            "<label style='width:100%:font-size:14px; color:#181c32;text-align:left; font-weight:500;'>"+poptitle+strhour+"&nbsp;"+gxmin_tag+" 수업시간"+gxlessontime_tag+"</label><br>"+
                            "<div style='width:auto;height:auto;margin-top:10px;margin-left:10px;border-radius:10px;border:1px solid #e7e7e7;padding:20px;box-shadow: 0px 5px 5px 0px rgba(0, 0, 0, 0.1);' >"+
                                "<table style='width:auto;height:auto;' >"+
                                    "<tbody style='width:100%;float:center;'>"+
                                        "<tr style='width:100%;height:40px'>"+                                           
                                            "<td>"+
                                                "<label id='label_"+keys[0]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:15px'>강좌선택</label>"+
                                            "</td>"+     
                                            "<td>"+
                                                "<label id='label_"+keys[1]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>세부강좌명</label>"+
                                            "</td>"+     
                                            "<td>"+
                                                "<label  style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:15px'>1주당 예약가능횟수</label><br>"+  
                                            "</td>"+     
                                         "</tr>"+
                                         "<tr style='width:100%'>"+                                            
                                            "<td>"+
                                               gxtype_tag+
                                            "</td>"+   
                                            "<td>"+
                                               gxdetailname_tag+
                                            "</td>"+  
                                            "<td>"+
                                               gx_maxreservation_tag+
                                            "</td>"+   
                                         "</tr>"+
                                        "<tr style='width:100%;height:55px'>"+
                                            "<td>"+
                                                "<label id='label_"+keys[2]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>강사선택</label><br>"+
                                            "</td>"+
                                            "<td>"+
                                                "<label id='label_"+keys[3]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>입장 최대 인원수</label><br>"+                                    
                                            "</td>"+
                                            "<td>"+
                                                "<label id='label_"+keys[4]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>오픈시간</label><br>"+
                                            "</td>"+
                                         "</tr>"+
                                         "<tr style='width:100%'>"+
                                            "<td style='width:25%'>"+
                                               gxteacher_tag+
                                            "</td>"+
                                            "<td style='width:25%'>"+
                                              gx_max_tag+
                                            "</td>"+
                                            "<td style='width:25%'>"+
                                                gx_opentime_tag+
                                            "</td>"+                                           
                                         "</tr>"+
                                         "<tr style='width:100%;height:55px'>"+                                        
                                            "<td>"+
                                                "<label id='label_"+keys[5]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>예약하기 최소시간</label>"+
                                            "</td>"+
                                            "<td>"+
                                                "<label id='label_"+keys[6]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>예약취소 최소시간</label><br>"+
                                            "</td>"+
                                            "<td>"+
                                                "<label id='label_"+keys[7]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>강좌 오픈/숨김</label><br>"+                                    
                                            "</td>"+                                           
                                         "</tr>"+
                                         "<tr style='width:100%'>"+                                            
                                            "<td style='width:25%'>"+
                                               gx_reservationtime_tag+
                                            "</td>"+
                                            "<td style='width:25%'>"+
                                               gx_cancelreservation_tag+
                                            "</td>"+
                                            "<td style='width:25%'>"+
                                              gxisshow_tag+
                                            "</td>"+                                                                                     
                                         "</tr>"+
                                         "<tr style='width:100%;height:55px'>"+                                      
                                            "<td colspan='3'>"+
                                                "<label id='label_"+keys[8]+"' style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>특이사항 (선택사항)</label><br>"+
                                            "</td>"+
                                         "</tr>"+
                                         "<tr style='width:100%'>"+                                       
                                            "<td  colspan='3'>"+
                                                gx_note_tag+
                                            "</td>"+                                           
                                         "</tr>"+
                                         "<tr style='width:100%;height:55px'>"+                        
                                            "<td>"+
                                                 "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>푸시보내기</label><br>"+  
                                            "</td>"+     
                                            "<td>"+
                                                 "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>자동출석하기</label><br>"+  
                                            "</td>"+     
                                            "<td>"+
                                                "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;margin-top:20px'>대기후 자동예약하기</label><br>"+  
                                            "</td>"+     
                                         "</tr>"+
                                         "<tr style='width:100%'>"+                                            
                                            "<td>"+
                                               gxpush_tag+
                                            "</td>"+   
                                            "<td>"+
                                               gxautocheckin_tag+
                                            "</td>"+  
                                            "<td>"+
                                               gxautoreadyin_tag+
                                            "</td>"+   
                                         "</tr>"+
                                         
                                        "</tbody>"+
                                    "</table>"+
                                "</div>"+
                            "</div>";
                      
        
        var style = {
            bodycolor: "white",
            size: {
                width: "885px",
                height: "50%"
            }
        };
        
        showModalDialog(document.body, title, message, title, "취소", function() {
            
            //만약 강좌만들기 버튼을 눌렀다면
            if(typeof(_datetimes) == "string" && _datetimes.length <= 10){
                datetimes = [];
                var hour = document.getElementById("select_hour").value;
                if(!hour){
                    alertMsg("강좌시간을 입력하세요");
                    return;
                }
                var dtime = _datetimes+" "+hour+":00:00";
                datetimes.push(dtime);
                
                var opentime = document.getElementById("input_opentime").value;
                if(isNowTimeMinOver(opentime) == -1){
//                    alertMsg("경고! 오픈시간이 이전 시간이라 회원들에게 바로 보입니다.");
                     showModalDialog(document.body, "경고!", "오픈시간이 이전 시간이라 회원들에게 바로 보입니다.", "설정하기", "취소", function() {
                         createRooms(datetimes,beforeroomid,null,roomusers,roomreadyusers);
                     },function(){
                         hideModalDialog();
                     });
                    return;
                }
                createRooms(datetimes,beforeroomid,null,roomusers,roomreadyusers);
            }else {
                createRooms(datetimes,beforeroomid,null,roomusers,roomreadyusers);    
            }
           
//            clog("000 createrooms");
            
            
        },function(){
            hideModalDialog();
        },style);
        
        setTimeout(function(){
            onchange_gxroomdata();    
        },200);
    }
    function getIsRoomToggleTag(isshow,id,num){ //id = id
    
       var toggle_tag = "<label class='switch' style='float:left;margin-top:10px'>"+
            "<input id='idroomtoggle_"+id+"' type='checkbox' onchange='onchangeRoomToggle(\""+id+"\")' checked>"+
            "<span id='idroomtoggle_span_"+id+"' class='slider round' style='background-color:#2194f3'>"+
                "<text class='fmont' id='idroomtoggle_txt_"+id+"'style='float:left;font-size:13px;font-weight:500;margin-top:10px;margin-left:3px;z-index:3;color:white'>ON</text>"+
            "</span>"+
        "</label>";
        if(isshow == "0")toggle_tag = "<label class='switch' style='float:left;margin-top:10px'>"+
            "<input id='idroomtoggle_"+id+"' type='checkbox' onchange='onchangeRoomToggle(\""+id+"\")' >"+
            "<span id='idroomtoggle_span_"+id+"' class='slider round' style='background-color:#cccccc'>"+
                "<text class='fmont' id='idroomtoggle_txt_"+id+"'style='float:left;font-size:13px;font-weight:500;margin-top:10px;margin-left:30px;z-index:3;color:white'>OFF</text>"+
            "</span>"+
        "</label>";
        onchange_gxroomdata(num,"minopentime");
        return toggle_tag;
    }
    
    function onchangeGXOpenTime(){
        var input_opentime;
    }
    function pasteRooms(copydates,pastedates,opentime){
        
        var groupcode = now_groupcode;
        var centercode = now_centercode;
        var data = {
            type: "pastegxrooms",
            groupcode : groupcode,
            centercode : centercode,                
            value: {"copydates" : copydates ,"pastedates":pastedates,"opentime":opentime}
        };
       
        CallHandler("adm_get", data, function(res) {
            clog("res ",res);
            var code = parseInt(res.code);

//                var param = "?centercode="+calendar_data.centercode;

            if (code == 100) {
//                    refresh_page(param);
                 C_showToast("알림", "강좌 정보를 업데이트하였습니다.", function() {});
                
                   hideModalDialog(); 
                   reload_calendar_page();    
                
                
            }else{
                alertMsg(res.message);
//                    refresh_page(param);
//                reload_calendar_page(calendar_data.centercode);
            }
//            alertMsg("테스트",function(){
//               hideModalDialog(); 
//            }) 
        },function(err){

             hideModalDialog();
        });
    }
    function updateRooms(rooms){
        var groupcode = now_groupcode;
        var centercode = now_centercode;
        var data = {
            type: "updategxrooms",
            groupcode : groupcode,
            centercode : centercode,                
            value: {"rooms" : rooms}
        };
        CallHandler("adm_get", data, function(res) {
            var code = parseInt(res.code);

//                var param = "?centercode="+calendar_data.centercode;

            if (code == 100) {
//                    refresh_page(param);
                 C_showToast( "알림", "강좌 정보를 업데이트하였습니다.", function() {});
                
                   hideModalDialog(); 
                   reload_calendar_page();    
                
                
            }else{
                alertMsg(res.message);
//                    refresh_page(param);
//                reload_calendar_page(calendar_data.centercode);
            }
//            alertMsg("테스트",function(){
//               hideModalDialog(); 
//            }) 
        },function(err){

             hideModalDialog();
        });
    }
    
    function createRooms(_datetimes,beforeroomid,rooms,room_users,room_readyusers){
        
        var select_gxdetailname = document.getElementById("select_gxdetailname");
        var select_gxtype = document.getElementById("select_gxtype");
        var select_gxmin = document.getElementById("select_gxmin");
        var select_gxteacher = document.getElementById("select_gxteacher");
        var input_gx_max = document.getElementById("input_gx_max");
        var input_opentime = document.getElementById("input_opentime");
        var input_reservationmin = document.getElementById("input_reservationmin");
        var input_cancel_reservationmin = document.getElementById("input_cancel_reservationmin");
        var select_isshow = document.getElementById("select_isshow");
        var input_gx_note = document.getElementById("input_gx_note");
        
        var select_push = document.getElementById("idroomtoggle_select_push");
        var select_autocheckin = document.getElementById("idroomtoggle_select_autocheckin");
        var select_autoreadyin = document.getElementById("idroomtoggle_select_autoreadyin");
        var input_maxreservation = document.getElementById("input_maxreservation");
        
        
        
        var createroomdatas = [];
        
        
        if(rooms){
//            clog("rooms.length ",rooms.length);
            
            if(Array.isArray(rooms))
                createroomdatas = rooms;
                
            else 
                createroomdatas.push(rooms);
        }
        else{
            
            var datetimes = [];
            if(typeof(_datetimes) == "string"){
                datetimes.push(_datetimes);
            }else 
                datetimes = _datetimes;
        
            
            if(!check_gxroomdata()){
                alertMsg("특이사항을 제외한 모든 부분이 입력되어야 합니다.");
                return;
            }

           
            for(var i = 0; i < datetimes.length; i++){
                var hour = stringGetHour(datetimes[i]);
                var ym = parseInt(stringGetYear(datetimes[i])) *12 +  parseInt(stringGetMonth(datetimes[i]));
                var roomid = ym+"_"+select_gxtype.value+"_"+datetimes[i]+"_"+random_string(12);
                var roomtype = select_gxtype.value;
                var roommin = select_gxmin.value;
                var roomlessontime = select_gxlessontime.value;
               

                var roomname = select_gxtype.options[select_gxtype.selectedIndex].text;
                var roomdetailname = select_gxdetailname.value;
                var max = input_gx_max.value;
                var managerid = select_gxteacher.value;
                var managername = select_gxteacher.options[select_gxteacher.selectedIndex].text;
                var opentime = input_opentime.value;
                var open_min = input_reservationmin.value;
                var cancel_min = input_cancel_reservationmin.value;
                var isshow = select_isshow.value == "Y" ? "1" : "0";
                var note = input_gx_note.value;
                
                var push = select_push.checked == "1" ? "1" : "0";
                var autocheckin = select_autocheckin.checked == "1" ? "1" : "0";
                var autoreadyin = select_autoreadyin.checked == "1" ? "1" : "0";
                var maxreservation = input_maxreservation.value ? input_maxreservation.value : "5";
                
                

                var roomdata = {"room_id":roomid,"room_type":roomtype,"room_min":roommin,"room_lessontime":roomlessontime,"room_datetime":datetimes[i],"room_name":roomname,"room_detailname":roomdetailname,"room_max":max,"room_managerid":managerid,"room_managername":managername,"room_users":room_users,"room_readyusers":room_readyusers,"room_opentime":opentime,"room_reservationmin":open_min,"room_cancelreservationmin":cancel_min,"room_isshow":isshow,"room_note":note,"room_push":push,"room_autocheckin":autocheckin,"room_autoreadyin":autoreadyin,"room_maxreservation":maxreservation};
                createroomdatas.push(roomdata);
            }
        }
        
        //teset
//        if(true){
//            clog("createroomdatas ",createroomdatas);
//            return;
//        }
        
        
        var groupcode = now_groupcode;
        var centercode = now_centercode;
        var data = {
            type: "creategxrooms",
            groupcode : groupcode,
            centercode : centercode,                
            value: {"roomdata" : createroomdatas ,"beforeroomid":beforeroomid}
        };
        CallHandler("adm_get", data, function(res) {
            var code = parseInt(res.code);

//                var param = "?centercode="+calendar_data.centercode;

            if (code == 100) {
//                    refresh_page(param);
                 C_showToast( "알림", "강좌 정보를 업데이트하였습니다.", function() {});
                
                   hideModalDialog(); 
                   reload_calendar_page();    
                
                
            }else{
                alertMsg(res.message);
//                    refresh_page(param);
//                reload_calendar_page(calendar_data.centercode);
            }
//            alertMsg("테스트",function(){
//               hideModalDialog(); 
//            }) 
        },function(err){

             hideModalDialog();
        });
    }
    
     $( document ).ready(function() {

        
//        clog("d_payment.php maininit");
//        var groupcode = now_groupcode;
//        var centercode = param_centercode;
//        
//        
//        
//
//            ymd = getToday();
//            user_uid = param_useruid;
//            user_name = param_username;
//            
//       
//        
//        showCenterGX(param_centercode,thisyear);
        
        
         
         
         
         
         
            var div_center_list = document.getElementById("div_center_list");
            var div_main = document.getElementById("div_main");
            var centercodes = "<?php echo $centercodes ;?>";
           
         

         
           param_year = parseInt(getToday().substr(0,4));
          
          
           if(!isPermission(35)){
                alertMsg("권한이 없습니다.",function(){
                    call_app();
                });
                return;
           }
          
            var _data = {
                    "type": "center", // group or center or auth
                    "group": now_groupcode
            };
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
               
                if (code == 100) {
                    var centers = res.message;
                    var len = centers.length;
                    if(len == 1){
//                        now_centercode = centers[0].centercode;
//                        now_centername = centers[0].centername;
//                        div_center_list.style.display = "none";
//                        div_main.style.display = "block";
                        clickCenter(centers[0].centercode);
                    }else if(len > 1){
                        if(now_centercode){
                            clickCenter(now_centercode);
                        }else{
                            var top = len*30+100;
                            if(len > 1 ){
                                ismullticenter = true;
                                isshow_centerlist = true;
                            }
                            div_center_list.innerHTML = "<div class='textevent' style='width:100%;height:50px;margin-top:"+(-top)+"px;margin-bottom:50px'><h5 align='center'  style='padding:10px'>GX현황 센터목록</h5><div>";
                             for(var i = 0 ; i < len; i++){
                                clog(i+" centercode "+centers[i].centercode);
                                div_center_list.innerHTML += "<div align='center'><button class='btn btn-primary btn-raised' onclick='clickCenter(\""+centers[i].centercode+"\")' style='background-color:#116666;padding:20px' >"+centers[i].centername+"</button></div><br>";
                             }  
                             ///GX현황으로 이동하기 임시작업해놓음
                             //div_center_list.innerHTML += "<div align='center'><button class='btn btn-primary btn-raised' onclick='gotoGXInfo(\""+now_centercode+"\", \""+now_centercode+"\")' style='background-color:#116666;padding:20px' >GX현황</button></div>";
                           
//                            div_center_list.innerHTML += "<div align='center'><button class='btn btn-primary btn-raised' onclick='gotoGXInfo(\""+now_centercode+"\", \"1007\") ' style='background-color:#116666;padding:20px' >GX현황</button></div>";
                        }
                    }
                } else {
                      alertMsg("센터정보를 가져오는데 실패하였습니다. 다시시도해 주세요");
                }

            }, function (err) {
                alertMsg("네트워크 에러 ");
                
            });
        
//        initNewTip();
    });
    
    function clickCenter(centercode){
        isshow_centerlist = false;
        now_centercode = centercode;
        showCenterGX(centercode,thisyear);      
    }
    function maininit(value){

        
            var div_center_list = document.getElementById("div_center_list");
            var div_main = document.getElementById("div_main");
            var centercodes = "<?php echo $centercodes ;?>";
           
         
            var v = value && value.year ? parseInt(value.year) : parseInt(getToday().substr(0,4));//ex) "2021"
            if(value && value.paramday)param_day = value.paramday;

            param_year = v;
        
            var _data = {
                    "type": "center", // group or center or auth
                    "group": now_groupcode
            };
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
               
                if (code == 100) {
                    var centers = res.message;
                    var len = centers.length;
                    if(len == 1){
//                        now_centercode = centers[0].centercode;
//                        now_centername = centers[0].centername;
//                        div_center_list.style.display = "none";
//                        div_main.style.display = "block";
                        clickCenter(centers[0].centercode);
                    }else if(len > 1){
                        
                        if(now_centercode){
                            clickCenter(now_centercode);
                        }else{
                            var top = len*30+100;
                            div_center_list.innerHTML = "<div style='width:100%;height:50px;background-color:white;margin-top:"+(-top)+"px;margin-bottom:50px'><h5 align='center'  style='padding:10px'>GX현황 센터목록</h5><div>";
                             for(var i = 0 ; i < len; i++){

                                div_center_list.innerHTML += "<div align='center'><button class='btn btn-primary btn-raised' onclick='clickCenter(\""+centers[i].centercode+"\")' style='background-color:#116666;padding:20px' >"+centers[i].centername+"</button></div><br>";
                             }
                        }
                    }
                } else {
                      alertMsg("센터정보를 가져오는데 실패하였습니다. 다시시도해 주세요");
                }

            }, function (err) {
                alertMsg("네트워크 에러 ");
                
            });
        
    }
    
//    function initNewTip(){
//         
//        /////////////////////////////////////////////////////
//        //마우스 포인터에 말풍선 띄우기 START
//        /////////////////////////////////////////////////////
//        const alltip = document.getElementById("alltip");
//        document.addEventListener("mousemove", (e) => { // mousemove이벤트를 이용해 움
//
//            // 마우스의 좌표는 clientX와 clientY를 이용해 알수 있다. -> 브라우저 window의 좌표값 위치를 전달한다.
//            var scrollPositionX = window.scrollX || document.documentElement.scrollLeft;
//            var scrollPositionY = window.scrollY || document.documentElement.scrollTop;
//            // pageX, pageY와는 다름.
//
//            const mouseX = e.clientX;
//            const mouseY = e.clientY;
//            alltip.style.left = (mouseX + scrollPositionX)+'px';
//            alltip.style.top = (mouseY+scrollPositionY-220) + 'px';
//
//        });
//        /////////////////////////////////////////////////////
//        //마우스 포인터에 말풍선 띄우기 END
//        /////////////////////////////////////////////////////
//    
//    }
    
  var $currentPopover = null;
  $(document).on('shown.bs.popover', function (ev) {
    var $target = $(ev.target);
    if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
      $currentPopover.popover('toggle');
    }
    $currentPopover = $target;
  }).on('hidden.bs.popover', function (ev) {
    var $target = $(ev.target);
    if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
      $currentPopover = null;
    }
  });
    

    ///////////////////////////////////////////
    //달력 크기 스케일로 화면에 맞추기
    ///////////////////////////////////////////
//    var zoom = 100;
//    var screen_width = $(window).width();
//    var calendar_width = 700;
//    zoom = (screen_width/calendar_width)*0.95;
//    if(zoom > 1)zoom = 1;
//    clog("zoom is "+zoom);
//    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  98%;  zoom: "+zoom+";-moz-transform: scale("+zoom+");}</style>";
   

$.extend({
    quicktmpl: function (template) {return new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+template.replace(/[\r\t\n]/g," ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g,"$1\r").replace(/\t:(.*?)\}\}/g,"',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'")+"');}return p.join('');")}
});

$.extend(Date.prototype, {
  //provides a string that is _year_month_day, intended to be widely usable as a css class
  toDateCssClass:  function () { 
    return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate(); 
  },
  //this generates a number useful for comparing two dates; 
  toDateInt: function () { 
    return ((this.getFullYear()*12) + this.getMonth())*32 + this.getDate(); 
  },
  toTimeString: function() {
    var hours = this.getHours(),
        minutes = this.getMinutes(),
        hour = (hours > 12) ? (hours - 12) : hours,
        ampm = (hours >= 12) ? ' PM' : ' AM';
    if (hours === 0 && minutes===0) { return ''; }
    if (minutes > 0) {
      return hour + ':' + minutes + ampm;
    }
    return ampm+""+hour;
  }
});


(function ($) {

  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
    var t = $.quicktmpl($('#tmpl').get(0).innerHTML);

    
    function setYearMonth(date,mode){
        var isin = false;
        if(date){
            isin = isNewYear(date.getFullYear());
            thisyear = date.getFullYear();
            thismonth = mode != "year" ? date.getMonth()+1 : 0;
            thisday = mode == "day" ? date.getDate() : 0;
            
        }else {
            if(mode == "year") {
                thismonth = 0;
                thisday = 0;
            }else if(mode == "month"){
                thismonth = parseInt(stringGetMonth(getToday()));
                thisday = 0;
            
            }else if(mode == "week"){
                thismonth = parseInt(stringGetMonth(getToday()));
                thisday = 0;
            }else if(mode == "day"){
                thismonth = parseInt(stringGetMonth(getToday()));
                thisday = parseInt(stringGetDay(getToday()));
            }
        }
        //ymd = +thisyear+"-"+thismonth+"-"+thisday;
        clog("setYearMonth :  mode "+mode+" ,date  "+date+"  , "+thisyear+"-"+thismonth+"-"+thisday);
        if(!isin){
            showCenterGX(now_centercode,thisyear);
        }
    }
    function isNewYear(nowyear){
        var isin = false;
        for( var i = 0 ; i < year_arr.length; i ++){
            if(year_arr[i] == nowyear){
                isin = true;
                break;
            }
        }
         
        if(!isin){
            if(year_arr.length == 0)isin = true;
            year_arr.push(nowyear);
        }
        clog("=========================================");
        clog("year_arr  ",year_arr);
        clog("isin  "+isin);
        return isin;
    }
  function calendar($el, options) {
      
    //actions aren't currently in the template, but could be added easily...
    $el.on('click', '.js-cal-prev', function () {
         clog("prev click 000");
        
         switch(options.mode) {
              case 'year': 
                      options.date.setFullYear(options.date.getFullYear() - 1); 
                break;
              case 'month': 

                      options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1); 


                      break;
              case 'week': options.date.setDate(options.date.getDate() - 7); break;
              case 'day':  options.date.setDate(options.date.getDate() - 1); break;
         }
         
        
        checkYearData(options.date.getFullYear());
        param_day = options.mode == "day" ? options.date.getTime() : "";
        
        setYearMonth(options.date,options.mode);
        draw();
        holidayCheckNoText();
        
        id_hcalendar.style.display = options.mode == "month" ? "block" : "none";
        
        gxPermissionCheck();
    }).on('click', '.js-cal-next', function () {
        
        clog("next click 111 ",options.date.getFullYear());
        
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
      case 'month': options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1); break;
      case 'week': options.date.setDate(options.date.getDate() + 7); break;
      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
      }
        
        
        checkYearData(options.date.getFullYear());
        param_day = options.mode == "day" ? options.date.getTime() : "";
  
        setYearMonth(options.date,options.mode);
        draw();
        holidayCheckNoText();
        
        id_hcalendar.style.display = options.mode == "month" ? "block" : "none";
        
        gxPermissionCheck();
    }).on('click', '.js-cal-option', function () {
      clog("==============================");
      clog("option click 222");
        
      var $t = $(this), o = $t.data();
      if (o.date) {
          o.date = new Date(o.date);
          if(o.mode == undefined)o.mode = "day";          
      }
      
     
      param_day = o.mode && o.mode == "day" && o.date ? o.date.getTime() : "";
      clog("param_day is ",param_day);
      
      $.extend(options, o);
      
      draw();
      holidayCheckNoText();
      
       id_hcalendar.style.display = o.mode == "month" ? "block" : "none";
        
        gxPermissionCheck();
        initAutoComplete();
    }).on('click', '.js-cal-years', function () {
        param_day = "";
        clog("years click 222");
        holidayCheckNoText();
      var $t = $(this), 
          haspop = $t.data('popover'),
          s = '', 
          y = options.date.getFullYear() - 2, 
          l = y + 5;
      if (haspop) { return true; }
      for (; y < l; y++) {
        s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">'+y + '</button>';
          
          
      }
//      $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
        id_hcalendar.style.display = "none";
        
        gxPermissionCheck();
      return false;
    }).on('click', '.event', function () {
        clog(" click 3333");
        var $t = $(this), o = $t.data();
        if (o.date) {
//          clog("o.mode is "+o.mode);
//          clog("o.date is "+o.date);
          o.date = new Date(o.date);
          if(o.mode == undefined)o.mode = "day";
          
            holidayCheckNoText();
      }
        
      $.extend(options, o);
      draw();
        
//      var $t = $(this), 
//          index = +($t.attr('data-index')), 
//          haspop = $t.data('popover'),
//          data, time;
//          
//      if (haspop || isNaN(index)) { return true; }
//      data = options.data[index];
//      time = data.start.toTimeString();
//      if (time && data.end) { time = time + ' - ' + data.end.toTimeString(); }
//      $t.data('popover',true);
////      $t.popover({content: '<p><strong>' + time + '</strong></p>'+data.text, html: true, placement: 'auto left'}).popover('toggle');
//      return false;
    });
      
        function isRoomMax(users,max){
            
            var ismax = users.length >= max ? true : false;
           return ismax;
        }
      
    var before_bdatas = null;
    var tr_colorflg = false;  
   
    function dayAddEvent(index, event,max) {
        
        
        var e = new Date(event.start),
        dateclass = e.toDateCssClass(),
        startint = event.start.toDateInt(),
        dateint = options.date.toDateInt();
        
//        clog("event ",event);
        var roomid = event.roomdata.room_id;
        var room = event.roomdata;
        var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
        
        var yy = event.start.getFullYear();
        var mm = event.start.getMonth()+1;
        var dd = event.start.getDate();
        var hh = event.start.getHours();
                
        
        var roomname = room.room_name;
        var roomdetailname = room.room_detailname ? room.room_detailname : "";
        var roommax = parseInt(room.room_max);
        var userslen = room.room_users ? room.room_users.length : 0;
        var hour = parseInt(event.start.getHours());
        var roommin = parseInt(room.room_min);
        var lesson_time = room.room_lessontime ? parseInt(room.room_lessontime) : 50;
        var yearmonthnum = parseInt(event.start.getFullYear())*12+parseInt(event.start.getMonth())+1;
        var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
        var isbeforesame = false;
        
        if(startint == dateint){
            var timeclass = '.time-23-0';
             if (hour < 6) {
                    timeclass = '.time-0-0';
                }
                else if (hour < 24) {
                    timeclass = '.time-' + hour + '-' + (event.start.getMinutes() < 30 ? '0' : '30');
                }
            
            var users = room.room_users ? room.room_users : [];
            var ready_users = room.room_readyusers ? room.room_readyusers : [];
            var roomtext = "<text style='width:auto'>"+hour+"시"+roommin+"분 시작 <br>"+room.room_name+"["+room.room_detailname+"]<br> "+users.length+"/"+room.room_max+"명<br>강사명:"+room.room_managername+", 오픈시간:"+room.room_opentime+"<br>Note : "+room.room_note+"</text>";
            var div = document.createElement("div");
            var ismax = isRoomMax(users,roommax); //   -1 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  , 5 : 예약이 꽉참
            div.id = roomid;
            
            clog(lesson_time+"==================");
            //회원들 정보
            var userstext = [];
            for(var i = 0 ; i < users.length;i++){
                var user = users[i];
                var uid_couponid = user.useruid+"_"+user.couponid;                
//                console.log("user.id" +user.userid); 
                
                var mbsname = allusers[uid_couponid] ? allusers[uid_couponid].mbsname : "알수없음";
                var maxcount = allusers[uid_couponid] ? allusers[uid_couponid].maxcount : 0;
                var usecount = allusers[uid_couponid] ? allusers[uid_couponid].usecount : 0;
                userstext.push({"name":user.username,"userid":user.userid,"uid":user.useruid,"couponid":user.couponid,"couponname":mbsname,"maxcount":maxcount,"usecount":usecount,"status":user.status,"starttime":user.starttime,"endtime":user.endtime});
            }

            var roombg = ismax ? "background-image:linear-gradient(to bottom,  #c997c9 0px, #dab9da 100%);" : "background-image:linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%);";
            if(parseInt(room.room_isshow) == 0)roombg = "background-image:linear-gradient(to bottom,  #888888 0px, #aaaaaa 100%);";
            
            
            
            
            //회원삽입 태그 , 닫기 태그 X
            /* 221031 유진 수정 */ // input name에 type값 추가
            var type = 0;
             var isshow_removeroom_icon = isPermission(224) ? "visible" : "hidden";
            
            var insert_user_tag = isPermission(225) ? "<text>회원삽입:</text>&nbsp;<input class='searchBox' id='"+roomid+"' name='"+type+"' style='width:160px;height:35px;border:1px solid #ebedf3;border-radius:5px;outline:none'>&nbsp;" : "";
            
            var insertuser_tag = users.length >= roommax ? "<div style='margin-top:10px;margin-right:2px'><i class='fa-solid fa-xmark'  onclick='removeRoom(\"" +yearmonthnum + "\",\"" +roomid + "\",\"" +hour + "\",\"" +roomname + "\",\"" +userslen + "\")' style='color:gray;padding:13px 19px 13px 19px;cursor:pointer;visibility:"+isshow_removeroom_icon+"'  title='선택한 강좌를 삭제합니다.'></i></div>" : "<div style='position:relative;margin-top:10px;margin-right:2px;visibility:"+isshow_removeroom_icon+"'>"+insert_user_tag+"<i class='fa-solid fa-xmark'  onclick='removeRoom(\"" +yearmonthnum + "\",\"" +roomid + "\",\"" +hour + "\",\"" +roomname + "\",\"" +userslen + "\")' style='color:gray;padding:13px 19px 13px 19px;cursor:pointer;visibility:"+isshow_removeroom_icon+"'  title='선택한 강좌를 삭제합니다.'></i></div>";
          
            //시간 태그 ex: 12:00 ~ 13:20
            var endhour = (hour+Math.floor((roommin+lesson_time)/60))%24;
            var endmin = (roommin+lesson_time)%60;            
            
            var rsh = hour < 10 ? "0"+hour : ""+hour;
            var rsm = roommin < 10 ? "0"+roommin : ""+roommin;
            var reh = endhour < 10 ? "0"+endhour : ""+endhour;
            var rem = endmin < 10 ? "0"+endmin : ""+endmin;
//            clog(roommin+" endhour"+endhour+" emin "+endmin);
//            clog(sdate+" "+rsh+":"+rsm+" ~ "+reh+":"+rem+" ");
            var lesson_time_tag = "<label class='fmont' style='font-size:17px;font-weight:700;margin-left:17px;margin-top:17px;'>"+rsh+":"+rsm+" ~ "+reh+":"+rem+"</label>";
            
            //세부강좌명 (강사명)
            var detailname_tag = "<label style='font-size:15px;font-weight:500;margin-left:48px;margin-top:18px;'>· "+roomdetailname+"("+room.room_managername+")</label>";
            
            //룸 인원수 ex) 16/20
            var maxuser_tag = "<label class='fmont' style='font-size:16px;font-weight:700;margin-left:48px;margin-top:18px;'><i class='fa-solid fa-user-group'></i><span style='color:#009ef7'> "+users.length+"</span>/"+room.room_max+"</label>";
            
            //활성/비활성 토글
            var showhide_tag = isPermission(223) ? "&nbsp;&nbsp;"+getIsShowToggleTag(room.room_isshow,dateFormat(event.start),yearmonthnum,roomid,setJSONStringToParamString(room)) : "";
            
            
            var isopentime_open = isNowTimeMinOver(room.room_opentime) <= 0 ? true : false;
            //오픈시간 태그
            var opentime_txt = "오픈시간: "+stringGetMonth(room.room_opentime)+"/"+stringGetDay(room.room_opentime)+" "+stringGetHour(room.room_opentime)+"시"+stringGetMin(room.room_opentime)+"분";
            var open_tag = isopentime_open ? "" : "<label style='margin-left:20px;color:#f4436d;font-size:13px;font-wieght:bold'>"+opentime_txt+"</label>";
            
            
            //회원테이블
            var tr_tags = "";
            var tr_len = users.length != 0 && users.length%3 == 0 ? users.length/3 : Math.floor(users.length/3)+1;
            
            var ready_btn_height = tr_len*30+30;
            if(ready_btn_height > 120)ready_btn_height = 120;
            var main_div_height = 60+tr_len*42;
            var ready_btn_margintop = tr_len <= 1 ? 10 : (tr_len-1)*13;
            
//            clog(users.length+" ready_btn_margintop is "+ready_btn_margintop);
            
             var isshow_removeuser_icon = isPermission(226) ? "visible" : "hidden";
           
            for(var i = 0 ; i < tr_len;i++){
               
                tr_tags += "<tr style='height:42px'>";
                for(var j  = 0;  j < 3; j++){
                    var num = i+j*tr_len;
                    //var bgcolor = i%2 == 1 ? "#f5f8fa" : "white";
                    var bgcolor = "white";
                    var uinfo = userstext[num];
                    border_top_tag
                    var border_top_tag = i == 0 ? "border-top:1px solid #ebedf3;" : "";
                    if(uinfo){
                        clog("aa uinfo ",uinfo);
                       
                        
                        //QR 출석체크했다면 색깔을 바꾼다.
                        if(uinfo.status == "2")bgcolor = "#54ca8b22";
                        var uinfo_starttime = uinfo.starttime ? uinfo.starttime.substr(0,10) : "";
                        var uinfo_endtime = uinfo.endtime ? uinfo.endtime.substr(0,10) : "";
                        var desc = uinfo.name+" ["+uinfo.userid+"] ,  유효기간 : "+uinfo_starttime+" ~ "+uinfo_endtime;
                        console.log("aauinfo ",uinfo);
                        var user_usercount = parseInt(uinfo.usecount) - getReservationUserCouponCount(uinfo.uid+"_"+uinfo.couponid);
                        var tag = "<div style='"+border_top_tag+"border-bottom:1px solid #ebedf3;margin-right:10px;height:100%;background-color:"+bgcolor+"'>"+
                                    "<span style='float:left'>"+
                                        "<label  onclick='showUserInfoPopup(\"" +uinfo.uid + "\")'  style='font-size:14px;font-weight:400;margin-top:10px;margin-left:10px;cursor:pointer' title='"+desc+"'>"+(num+1)+".&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+uinfo.name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+replaceStr(uinfo.couponname,8)+" (<span style='color:#2194f3'>"+user_usercount+"</span>/"+uinfo.maxcount+")</label>"+
                                    "</span>"+
                                    "<span style='float:right'>"+
                                        "<i class='fa-solid fa-xmark' style='color:gray;padding:10px;cursor:pointer;visibility:"+isshow_removeuser_icon+"'  onclick='remove_inuser(\"" +yearmonthnum + "\",\"" +roomid + "\",\"" +yy + "\",\"" +mm + "\",\"" +dd + "\",\"" +hour + "\",\"" +roomname + "\",\""+uinfo.name+"\",\""+uinfo.uid+"\",\"gxpage\")' ></i>"+
                                    "</span>"+
                                  "</div>";
                        tr_tags += "<td style='width:25%;height:42px'>"+tag+"</td>";
                    }else {
                        tr_tags += "<td style='width:25%;height:42px'></td>";
                    }    
                }
                tr_tags += "</tr>";
            }
            var usertable_tag = "<table style='width:910px;height:"+(tr_len*42)+"px;margin-left:15px;margin-top:30px'>"+
                
                                    tr_tags+
                                    
                                "</table>";
           
            var str_ready_users = ready_users && ready_users.length > 0 ? setJSONStringToParamString(ready_users) : "";
          
            var title_color = users.length >= roommax ? "#fa637422" : "#f5f8fa";
            if(parseInt(room.room_isshow) == 0 || !isopentime_open)title_color = "#dddddd";
            
            //강좌수정 권한
            var isshow_changeicon = !isPermission(223) ? "hidden" : "visible";
            div.innerHTML = //타이틀 DIV
                            "<div id='top_div_"+hour+"' style='width:1120px;height:60px;background-color:"+title_color+";border:1px solid #ebedf3;border-radius:10px 10px 0px 0px'>"+
                                "<span style='float:left;'>"+
                                    "<div align='center'  onclick='roomclick( \""+dateFormat(event.start)+"\", "+yearmonthnum+" , \""+roomid+"\"  )' style='width:50px;height:40px;margin-top:10px;border-right:1px solid #ebedf3;visibility:"+isshow_changeicon+"'><i class='fa-solid fa-pen-to-square' style='margin-top:8px;font-size:20px;cursor:pointer;'></i></div>"+
                                "</span>"+
                                "<span >"+
                                    lesson_time_tag+detailname_tag+maxuser_tag+showhide_tag+"   "+open_tag+
                                 "</span>"+
                                "<span style='float:right'>"+
                                    insertuser_tag+
                                "</span>"+
                            "</div>"+
                            //메인 DIV
                            "<div id='main_div_"+hour+"' style='width:1120px;height:"+main_div_height+"px;background-color:white;border:1px solid #ebedf3;border-radius:0px 0px 10px 10px'>"+
                                "<span style='float:left'>"+
                                    usertable_tag+
                                "</span>"+
                                "<span style='float:right;margin-top:10px'>"+
//                                    "<div align='center' style='width:150px;height:150px;margin:20px'>"+
                                        "<button onclick='readyUsersClick(\""+str_ready_users+"\", \""+roomid+"\" )' class='btn' style='background-color:#e4e6ef;width:120px;height:"+ready_btn_height+"px;margin-top:"+ready_btn_margintop+"px;margin-right:20px;border:0px;border-radius:15px;font-size:15px;font-weight:600;text-align:center;'>대기인원<br><span style='font-size:20px'>"+ready_users.length+"</span></button>"+
//                                    "</div>"+
                                "</span>"+
                            "</div>";
            
            
            
//            div.innerHTML ="<table style='width:100%;"+roombg+"'><tr><td onclick='roomclick( \""+dateFormat(event.start)+"\", "+yearmonthnum+" , \""+roomid+"\"  )' style='float:left;width:27%;font-size:15px;padding:10px;height:100%;'>"+roomtext+"</td><td style='float:left;width:63%;height:100%;font-size:15px;padding:10px;background-image:linear-gradient(to bottom, #ffe0b8 0px, #f8e58c 100%);'>"+userstext+insertuser_tag+"</td><td >"+getIsShowToggleTag(room.room_isshow,dateFormat(event.start),yearmonthnum,roomid,setJSONStringToParamString(room))+"<image onclick='removeRoom(\"" +yearmonthnum + "\",\"" +roomid + "\",\"" +hour + "\",\"" +roomname + "\",\"" +userslen + "\")'  src='./img/btn_close_50.png' style='float:right;margin-top:-10px' title='선택한 강좌를 삭제합니다.'/></td></tr></table>";
            div.style.paddingBottom = "10px"
            div.style.marginLeft = "10px";
            div.style.height="auto";

            
            var vertical_line = document.getElementById("vertical_line_"+hour);
            
            if(dateclass == sdate ){
//                console.log("aaa");
                 var mhh = hh < 10 ? "0"+hh : hh;
                var trid = "daytime_"+getDateToStr(yy,mm,dd,hh+"");
                var time_tr = document.getElementById(trid);
                
                console.log("trid is "+trid);
                if(time_tr){
                    console.log("bb");
                    time_tr.style.display = "block";
                    time_tr.style.borderBottom = "0px";
                }

                if(timeclass == '.time-0-0'){
                    console.log("cc");
                    var tr_input = document.getElementById("tr_input");
                    tr_input.style.display = "block";
                }
                
            } 
       
                    
            
            $(timeclass).append(div);
            if(users.length < roommax)initAutoComplete();
            vertical_line.style.height =  vertical_line.parentNode.parentNode.offsetHeight+"px";
           
            
        }
        
    }
    
    function getIsShowToggleTag(isshow,time,yearmonthnum ,roomid,str_room){ //id = roomid
    
       var toggle_tag = "<label class='switch' style='margin-top:3px' title='강좌를 활성/비활성화 합니다. 비활성화시 회원들에게 보여지지 않습니다.'>"+
            "<input id='idtoggle_"+roomid+"' type='checkbox' onchange='onchangeIsShowToggle(\""+time+"\",\""+yearmonthnum+"\",\""+roomid+"\",\""+str_room+"\")' checked>"+
            "<span id='idtoggle_span_"+roomid+"' class='slider round' style='background-color:#2194f3'>"+
                "<text id='idtoggle_txt_"+roomid+"'style='font-size:13px;font-weight:bold;margin-top:8px;z-index:3;color:white;margin-left:5px;line-height:34px'>ON</text>"+
            "</span>"+
        "</label>";
        if(isshow == "0")toggle_tag = "<label class='switch' style='margin-top:3px' title='강좌를 활성/비활성화 합니다. 비활성화시 회원들에게 보여지지 않습니다.'>"+
            "<input id='idtoggle_"+roomid+"' type='checkbox' onchange='onchangeIsShowToggle(\""+time+"\",\""+yearmonthnum+"\",\""+roomid+"\",\""+str_room+"\")' >"+
            "<span id='idtoggle_span_"+roomid+"' class='slider round' style='background-color:#cccccc'>"+
                "<text id='idtoggle_txt_"+roomid+"' style='font-size:13px;font-weight:bold;margin-top:8px;z-index:3;color:white;margin-left:30px;line-height:34px'>OFF</text>"+
            "</span>"+
        "</label>";
        return toggle_tag;
    }
     
    function monthAddEvent(index, event) {
        
        e = new Date(event.start),
        dateclass = e.toDateCssClass();
//        var roomid = event.roomdata.room_id;
        var room = event.roomdata;
        var roomid = room.room_id;
        var room_name = room.room_name;
        var room_detailname = room.room_detailname;
        var max = parseInt(room.room_max);
         var y = event.start.getFullYear();
        var m = event.start.getMonth()+1;
        var d = event.start.getDate();
        var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
        var hour = parseInt(event.start.getHours());
         var room_min = room.room_min;
        
        var nowday = parseInt(event.start.getDate());
        
        if(dateclass == sdate)
        {
            //총예약, 총대기인원 표시
            showTotalGXUser(y,m,d);
            
             var users = room.room_users ? room.room_users : [];
            var ready_users = room.room_readyusers ? room.room_readyusers : [];
            
           // var text = room.room_name+"<br>"+users.length+"/"+room.room_max+"명<br>강사명:"+room.room_managername+", 오픈시간:"+hour+"<br>Note : "+room.room_note;
            
            var text = room_detailname.length > 6 ? room_detailname.substr(0,6)+"..." : room_detailname;
            var ismax = isRoomMax(users,max); //   -1 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  , 5 : 예약이 꽉참
            var isopentime_open = isNowTimeMinOver(room.room_opentime) <= 0 ? true : false;
            var roombg =  ismax ? "#FFE3E1" : "#E5F3DA";
            if(parseInt(room.room_isshow) == 0 || !isopentime_open)roombg = "#EEEEEE";
            var div = document.createElement("div");
            div.id = roomid;
            
            var isopentime_color = room.room_opentime == "" ? "#E5F3DA" : "#f0f0f0";
            //시간 AM 10 , PM 4
            var time = event.start.toTimeString();
            
            var txt_time = getTxtHourMin(hour,room_min);

            var timetag = //"<text class='fmont' style='font-size:7px; color:"+isopentime_color+";font-weight:500;margin-top:7px;margin-left:3px'>●</text>"+
                "<label class='fmont' style='font-size:9px; color:#444444;text-align:left; font-weight:600;margin-top:8px;margin-left:6px'>"+txt_time+"</label>"; //시간표시  AM09:30
            var maxuser_tag = "<text class='fmont' style='float:right;font-size:9px; color:#444444;text-align:right; font-weight:600;margin-top:7px;margin-right:5px'>("+users.length+"/"+room.room_max+")</text>"; //회원수 표시 (4/6)
            var maintext = "<text style='position:absolute;float:left;font-size:11px; color:#444444;text-align:left; font-weight:700;margin-top:5px;margin-left:70px'>"+text+"</text>"; // 내용표시 //강좌이름
            div.innerHTML += maintext+timetag+"&nbsp;&nbsp;&nbsp;"+maxuser_tag+"";
            div.style.height = "30px";
            div.style.backgroundColor = roombg;
            div.style.borderRadius = "3px";
            div.style.marginBottom = "4px";
            div.style.marginRight = "3px";
            div.className = "div_month_tip";
           
            
            var subdiv = document.createElement("div");
//            subdiv.append(maintext);
            subdiv.append(div);
            
//             subdiv.onmouseover = function(){
////                console.log("show "+sdate);
//                 
//                 $("#alltip").html(roomTipTag(event,room));
////                 $("#alltip").html("<div style='width:400px;height:100px;background-color:black'>dsafdsfdada</div>");
//                 $("#alltip").show();
//                 
//            }
//            
//            subdiv.onmouseout = function(){
////                console.log("hide "+sdate);
//                $("#alltip").hide();
//            }
            
//            $('.' + event.start.toDateCssClass()).append(maintext);
//            $('.' + event.start.toDateCssClass()).append(label_maxuser);
            $('.' + event.start.toDateCssClass()).append(subdiv);
            
            
        }
        
    }
        //월달력에서 일별 총예약인원 , 총 대기인원 표시
    function showTotalGXUser(y,m,d){
       
        var sdate = "_"+y+"_"+m+"_"+d;
        var div_gxuser = document.getElementById("div_gxuser_"+sdate);
        var txt_gxuser = document.getElementById("txt_gxuser_"+sdate);
        var txt_gxreadyuser = document.getElementById("txt_gxreadyuser_"+sdate);
        var ymd = y+"-"+m+"-"+d;
        
        
        if(div_gxuser)div_gxuser.style.display = "block";
        if(txt_gxuser)txt_gxuser.innerHTML =total_gxuser_day[ymd]+"건";
        if(txt_gxreadyuser)txt_gxreadyuser.innerHTML = total_gxreadyuser_day[ymd]+"건";
        
        
        
        
    }
    function getTxtHourMin(hour,min){
        //am
        if(parseInt(hour) <= 12){
            var hh = parseInt(hour) < 10 ? "0"+hour : ""+hour;
            var mm = parseInt(min) < 10 ? "0"+min : ""+min;
            return "AM "+hh+":"+mm;
        }//pm
        else{
            var hh = parseInt(hour-12) < 10 ? "0"+(hour-12) : ""+(hour-12);
            var mm = parseInt(min) < 10 ? "0"+min : ""+min;
            return "PM "+hh+":"+mm;
        }    
    } 
//    function roomTipTag(event,room){
//         var roomname = room.room_name;
//        var roomdetailname = room.room_detailname ? room.room_detailname : "";
//        var roommax = parseInt(room.room_max);
//        var users = room.room_users ? room.room_users : [];
//        
//        //test
////        if(users.length > 0)
////        for(var i = 0 ; i < 4;i++)
////            users.push(users[0]);
//        
//        var ready_users = room.room_readyusers ? room.room_readyusers : [];
//        var userslen = room.room_users ? room.room_users.length : 0;
//        var hour = parseInt(event.start.getHours());
//        var roommin = room.room_min;
//        var lesson_time = room.room_lessontime ? parseInt(room.room_lessontime) : 50;
//        var roomid = event.roomdata.room_id;
//        var yearmonthnum = parseInt(event.start.getFullYear())*12+parseInt(event.start.getMonth())+1;
//        var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
//        var isbeforesame = false;
//        
////         clog("==================");
//            //회원들 정보
//            var userstext = [];
//            for(var i = 0 ; i < users.length;i++){
//                var user = users[i];
//                var uid_couponid = user.useruid+"_"+user.couponid;                
//               
//                var mbsname = allusers[uid_couponid] ? allusers[uid_couponid].mbsname : "알수없음";
//                var maxcount = allusers[uid_couponid] ? allusers[uid_couponid].maxcount : 0;
//                var usecount = allusers[uid_couponid] ? allusers[uid_couponid].usecount : 0;
//                
//                userstext.push({"name":user.username,"uid":user.useruid,"userid":user.userid,"couponid":user.couponid,"couponname":mbsname,"maxcount":maxcount,"usecount":usecount,"status":user.status,"starttime":user.starttime,"endtime":user.endtime});
//            }
//        //시간 태그 ex: 12:00 ~ 13:20
//            var endhour = (hour+Math.floor((roommin+lesson_time)/60))%24;
//            var endmin = (roommin+lesson_time)%60;            
//            
//            var rsh = hour < 10 ? "0"+hour : ""+hour;
//            var rsm = roommin < 10 ? "0"+roommin : ""+roommin;
//            var reh = endhour < 10 ? "0"+endhour : ""+endhour;
//            var rem = endmin < 10 ? "0"+endmin : ""+endmin;
//            
//            var lesson_time_tag = "<label class='fmont' style='font-size:13px;font-weight:700;margin-left:17px;margin-top:17px;'>"+rsh+":"+rsm+" ~ "+reh+":"+rem+"</label>";
//            
//            //세부강좌명 (강사명)
//            var detailname_tag = "<label style='font-size:12px;font-weight:500;margin-left:48px;margin-top:18px;'>· "+roomdetailname+"("+room.room_managername+")</label>";
//            
//            //룸 인원수 ex) 16/20
//            var maxuser_tag = "<label class='fmont' style='font-size:13px;font-weight:700;margin-left:48px;margin-top:18px;'><i class='fa-solid fa-user-group'></i><span style='color:#009ef7'> "+users.length+"</span>/"+room.room_max+"</label>";
//            
//            //활성/비활성 토글
//            var showhide_tag = "&nbsp;&nbsp;"+getIsShowToggleTag(room.room_isshow,dateFormat(event.start),yearmonthnum,roomid,setJSONStringToParamString(room));
//            
//            
//            var isopentime_open = isNowTimeMinOver(room.room_opentime) <= 0 ? true : false;
//            //오픈시간 태그
//            var opentime_txt = "오픈시간: "+stringGetMonth(room.room_opentime)+"월 "+stringGetDay(room.room_opentime)+"일 "+stringGetHour(room.room_opentime)+"시"+stringGetMin(room.room_opentime)+"분";
//            var open_tag = isopentime_open ? "" : "<label style='position:absolute;margin-left:-80px;margin-top:5px;color:#f4436d;font-size:13px;font-wieght:bold'>"+opentime_txt+"</label>";
//            
//        
//        //회원테이블
//            var tr_tags = "";
//            var tr_len = users.length != 0 && users.length%2 == 0 ? users.length/2 : Math.floor(users.length/2)+1;
//            
//            var ready_btn_height = tr_len*30+30;
//            if(ready_btn_height > 120)ready_btn_height = 120;
//            var main_div_height = 60+tr_len*42;
//            var ready_btn_margintop = tr_len <= 1 ? 10 : (tr_len-1)*13;
//            
////            clog(users.length+" ready_btn_margintop is "+ready_btn_margintop);
//            for(var i = 0 ; i < tr_len;i++){
//               
//                tr_tags += "<tr style='height:30px'>";
//                for(var j  = 0;  j < 2; j++){
//                    var num = i+j*tr_len;
//                    //var bgcolor = i%2 == 1 ? "#f5f8fa" : "white";
//                    var bgcolor = "white";
//                    var uinfo = userstext[num];
//                    border_top_tag
//                    var border_top_tag = i == 0 ? "border-top:1px solid #ebedf3;" : "";
//                    if(uinfo){
////                        clog("uinfo ",uinfo);
////                        clog("user ",uinfo);
//                        
//                        //QR 출석체크했다면 색깔을 바꾼다.
//                        if(uinfo.status == "2")bgcolor = "#e8f8f0";
//                        var uinfo_starttime = uinfo.starttime ? uinfo.starttime.substr(2,8) : "";
//                        var uinfo_endtime = uinfo.endtime ? uinfo.endtime.substr(2,8) : "";
//                        var desc = uinfo.name+" ["+uinfo.userid+"] ,  유효기간 : "+uinfo_starttime+" ~ "+uinfo_endtime;
////                        console.log("desc = ",desc);
//                        
//                        var tag = "<div style='"+border_top_tag+"border-bottom:1px solid #ebedf3;margin-right:10px;height:100%;background-color:"+bgcolor+"'>"+
//                                    "<span style='float:left'>"+
//                                        "<label  style='font-size:12px;font-weight:400;margin-top:10px;margin-left:10px;cursor:pointer' title='"+desc+"'>"+(num+1)+".&nbsp;&nbsp;"+uinfo.name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+uinfo_starttime+" ~ "+uinfo_endtime+" </label>"+
//                                    "</span>"+
//                                    "<span style='float:right'>"+
//										"<label style='font-size:12px;font-weight:400;margin-top:10px;margin-right:10px'>(<span style='color:#2194f3'>"+uinfo.usecount+"</span>/"+uinfo.maxcount+")</label>"+
//							        "</span>"+
//                            
//                                  "</div>";
//                        tr_tags += "<td style='width:50%;height:30px'>"+tag+"</td>";
//                    }else {
//                        tr_tags += "<td style='width:50%;height:30px'></td>";
//                    }    
//                }
//                tr_tags += "</tr>";
//            }
//            var usertable_tag = "<table style='width:530px;height:"+(tr_len*42)+"px;margin-left:15px;margin-top:30px'>"+
//                
//                                    tr_tags+
//                                    
//                                "</table>";
//            var div = document.createElement("div");
//            var str_ready_users = ready_users && ready_users.length > 0 ? setJSONStringToParamString(ready_users) : "";
//          
//            var title_color = users.length >= roommax ? "#feeaec" : "#f5f8fa";
//            if(parseInt(room.room_isshow) == 0 || !isopentime_open)title_color = "#dddddd";
//            div.innerHTML = //타이틀 DIV
//                            "<div style='width:auto;height:auto;border:0px;border-radius:10px;box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.25);'>"+
//                            "<div id='top_div_"+hour+"' style='width:550px;height:60px;background-color:"+title_color+";border:0px;border-radius:10px 10px 0px 0px'>"+
//                             
//                                "<span >"+
//                                    lesson_time_tag+detailname_tag+maxuser_tag+showhide_tag+" <label style='float:right;font-size:13px;font-weight:bold;margin-top:18px;margin-right:15px'>대기 "+ready_users.length+"명</text>"+
//                                 "</span>"+
//                              
//                            "</div>"+
//                            //메인 DIV
//                            "<div align='center' id='main_div_"+hour+"' style='width:550px;height:"+main_div_height+"px;background-color:white;border:0px;border-radius:0px 0px 10px 10px;box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.25);'>"+
//                                        open_tag+
//                                "<span style='float:left'>"+
//                                    usertable_tag+
//                                "</span>"+
//                                "<span style='float:right;margin-top:10px'>"+
////                                    "<div align='center' style='width:150px;height:150px;margin:20px'>"+
//                                        
////                                    "</div>"+
//                                "</span>"+
//                            "</div>"+
//                        "</div>";
//            
//            return div.innerHTML;
//    }
    
    var before_month_isclickdata_on = CLICKTYPE.none;
    
    
    function yearAddEvents(events, year) {
      var counts = [0,0,0,0,0,0,0,0,0,0,0,0];
      $.each(events, function (i, v) {
        if (v.start.getFullYear() === year) {
            counts[v.start.getMonth()]++;
        }
      });
      $.each(counts, function (i, v) {
        if (v!==0) {
            $('.month-'+i).append('<span class="badge">'+v+'</span>');
        }
      });
    }
    
    function draw() {
      $el.html(t(options));
      //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
      $('.' + (new Date()).toDateCssClass()).addClass('today');
        
       
      var id_hcalendar = document.getElementById("id_hcalendar");
      var btn_insert_room = document.getElementById("btn_insert_room");
      if (options.data && options.data.length >= 0) {
          
           var day_total_table = document.getElementById("day_total_table");
          if(day_total_table)day_total_table.style.visibility = options.mode == "day" ? "visible" : "hidden";
          
          var month_total_table = document.getElementById("month_total_table");
          if(month_total_table)month_total_table.style.visibility = options.mode == "month" ? "visible" : "hidden";
          
          
        if (options.mode === 'year') {
            yearAddEvents(options.data, options.date.getFullYear());
          
            setYearMonth(options.date,options.mode);
//            $("#alltip").hide();
        } else if (options.mode === 'month' || options.mode === 'week') {
            
            $.each(options.data, monthAddEvent);
            setYearMonth(options.date,options.mode);
            
            
            if(options.mode === 'month')mini_calendar_draw();
            
            if(options.mode == "week")$("#alltip").hide();
            initTotalGXUser(options.mode,options.date.getFullYear(),(options.date.getMonth()+1));
        } else {
//            $("#alltip").hide();
            //맨위로가기
            window.scrollTo(0,0);
           
            //////////////////////////////////////////////////////////////////////////////
            //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. START
            //////////////////////////////////////////////////////////////////////////////
            
//            var title = "예약버튼"; //제목이지만 내용을 적으면 된다.
//            var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
//            y = 2021;
//            m = 0;  //
//            d = 6;
//            hh = 13;
//            mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
//            start = new Date(y, m, d, hh, mm);
//            clog("dayaddeventcall!!",options.data);
//            var event = { title: title, start: start, end: null, allDay: allday, type:"reservation_button"};
//            dayAddEvent(0,event);
            
            //////////////////////////////////////////////////////////////////////////////
            //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. END
            //////////////////////////////////////////////////////////////////////////////
            
            
            //기존 예약되어있는 날짜 표시
//            $.each(options.data, dayAddEvent);
            var mday = options.date.getFullYear()+"_"+(options.date.getMonth()+1)+"_"+options.date.getDate();
            setYearMonth(options.date,options.mode);
            
            
            var arr = [];
            for(var i = 0 ; i < options.data.length; i++){
                obj = options.data[i].start;
                var lday = obj.getFullYear()+"_"+(obj.getMonth()+1)+"_"+obj.getDate();
                if(mday == lday){
                    arr.push(options.data[i]);                    
                }                
            }
            var len = arr.length; //개수만큼 데이타를 삽입하고 나머지 빈곳들을 삭제하기 위해서
            for(var i = 0 ; i < len;i++){
                dayAddEvent(i,arr[i],len-1);
            }
            
            initTotalGXUser(options.mode,options.date.getFullYear(),(options.date.getMonth()+1),options.date.getDate());
        }
          
          
          
      }
    }
    clog(thisday+" ***************** ymd "+ymd);
    if(ymd != ""){
        var date_arr = ymd.split("-");
        thisyear = date_arr[0];
        thismonth = date_arr[1];
        thisday = date_arr[2];
        ymd == "";
        checkDayPage();
        
    }  
    draw();  
    window.mdraw = draw;
     
  }
   window.calendar = calendar;
  ;(function (defaults, $, window, document) {
    $.extend({
      calendar: function (options) {
        return $.extend(defaults, options);
      }
    }).fn.extend({
      calendar: function (options) {
        options = $.extend({}, defaults, options);
        window.options = options;
        return $(this).each(function () {
          var $this = $(this);
          calendar($this, options);
        });
      }
    });
  })({
    days: ["일", "월", "화", "수", "목", "금", "토"],
    months: ["1월달", "2월달", "3월달", "4월달", "5월달", "6월달", "7월달", "8월달", "9월달", "10월달", "11월달", "12월달"],
    shortMonths: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
    date: (new Date()),
        daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
        todayname: "오늘로가기",
        thismonthcss: "current",
        lastmonthcss: "outside",
        nextmonthcss: "outside",
    mode: "month",
    data: []
  }, jQuery, window, document);
    
   
})(jQuery);
    
    
    
    function readyUsersClick(str_ready_users,roomid){
         
        var users = str_ready_users ? JSON.parse(str_ready_users):[];
        clog("users ",users);
        clog("allusers ",allusers);
        var rows = [];
        for(var i = 0 ; i < users.length;i++){
            var user = users[i];
            var uid_couponid = user.useruid+"_"+user.couponid;
            var username = user.username;
            var userid = user.userid;
            var useruid = user.useruid;
            var starttime = user.starttime;
            var endtime = user.endtime;
            var couponid = user.couponid;
            var couponname = allusers[uid_couponid] ? allusers[uid_couponid].mbsname : "";
            var usecount = allusers[uid_couponid] ? allusers[uid_couponid].usecount : 0;
            var maxcount = allusers[uid_couponid] ? allusers[uid_couponid].maxcount : 0;
            var row = {"username":username,"userid":userid,"couponname":couponname,"usecount":usecount,"maxcount":maxcount,"roomid":roomid,"useruid":useruid,"starttime":starttime,"endtime":endtime};
            rows.push(row);            
        }
        

        /* 221031 유진 수정 */ // input name에 type값 추가 // css추가
        var type = 5;
         var user_search = isPermission(225) ?  "<div style='position:relative;margin-right:2px'><text style='font-weight:lighter; font-size: 18px; vertical-align: text-top;'>대기회원삽입:</text>&nbsp;<input class='searchBox' id='"+roomid+"' name='"+type+"' style='width:160px;height:35px;border:1px solid #ebedf3;border-radius:5px;outline:none;'>" : "";
        createGXReadyUsersTable(rows, user_search); 
            
       
    }
     function createGXReadyUsersTable(rows,search_form) {// 대기자 현황 회원 검색창 추가
        
       //array_push($teacher_reservation[$i]["myusers"], array("uid" => $m_uid, "userid"=>$m_userid,"name"=>$m_username, "starttime" => $pt_starttime,  "endtime" => $pt_endtime, "ornerstatus" => $orner_status, "couponid" => $couponid));//1.트레이너지정 , 2PT/
         //uid, id, name , starttime , endtime , ornerstatus , couponid , 

        var div_member_table =document.createElement("div");
        var table = document.createElement('table');    
        div_member_table.appendChild(table);
        
//        div_member_table.innerHTML = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'></table>";
     
        table.border = "1";
        table.style.width = "100%";
        table.id = "GXReadyUsersTable";
        table.className="table table-bordered";
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>인덱스</th><th>이름</th><th>고객번호</th><th>회원권</th><th>사용횟수</th><th>버튼</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;

        var push_users_token = [];
        var push_titles = [];
        var push_messages = [];
        
        if (len > 0) {
            for (var i = 0; i < len; i++) {
                var brow = body.insertRow();
               
                var row = rows[i];
                clog("row ",row);
                // 인덱스
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = (i+1)+"";
                bcell_index.style.maxWidth="30px";
                
                // 이름 성별               
                var bcell_name = brow.insertCell();
                bcell_name.innerHTML = "<button class='btn btn-primary btn-raised' onclick='showUserInfoPopup(\""+row.uid+"\")' style='background-color:#116666' >"+row.username+"</button>";

                
                //고객번호
                var bcell_id = brow.insertCell();
                bcell_id.innerHTML = row.userid;
                bcell_id.style.maxWidth="30px";
                

                //회원권 이름
                var bcell_couponid = brow.insertCell();
                bcell_couponid.innerHTML = row.couponname;
                
               
                //사용횟수
                var bcell_lockerpass = brow.insertCell();
                bcell_lockerpass.innerHTML = row.usecount+"/"+row.maxcount;

                /* 221031 유진 수정 */ // css추가
                //삭제버튼
                var bcell_delete = brow.insertCell();
                var str_row = setJSONStringToParamString(row);
                var type_num = 4;
                bcell_delete.innerHTML = isPermission(226) ? "<button style='width:70px; height:35px; border-radius:5px;background: rgb(0, 123, 255);color: rgb(238, 238, 238);padding-left: 20px;padding-right: 20px;border: 0px;' onclick='send_remove_user(\""+str_row+"\",\""+type_num+"\")'>삭제</button>" : "";

            }
        }
        
        
         var style = {
//             modaltype:"large",
             marginTop:"0px",
             bodycolor:"#ffffff",
             size:{
                 width:"95%",
                 height:"auto"
             },
             top:{
                 color:"#262930",
                 textAlign:"left",
                 paddingLeft:"25px",
                 borderBottom: "1px solid #dddddd"
             },
             bottom:{
                 textAlign:"right",
                 paddingRight:"25px",
                 borderTop: "1px solid #dddddd",
                 
                
             },
             //커스텀 버튼
             button_width: "100px",
             button_height: "43px",
             button_color : "white",
             button_bgcolor : "#31b0f8"
             
             
        };
       
            var title ="대기자 현황";
        /* 221031 유진 수정 */ // 대기자 현황 모달
        showModalDialogForReady(document.body,title, search_form, div_member_table.innerHTML ,"확인",null, function() {
                
                hideModalDialog();
                
        }, function() {
             
            
            
        },style);
    } 
    /* 221031 유진 추가 */
    function send_remove_user (rows,type) {
        type = Number(type);
        send_remove_gxuser(rows,type,function(res){
            if(res != null){
                alertMsg(res,function(){
                    reload_calendar_page();
                });
            }else
                alertMsg("네트워크 에러");
        });
    }
    function send_remove_gxuser(_rows,intype,callback){
        //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
        var nowcentercode = now_centercode;
        var rows = JSON.parse(_rows);
        var value = {
            "inserttime":"",
            "couponid" : rows.roomid,
            "username" : rows.username,
            "useruid" : rows.useruid,
            "userid" : rows.userid,
            "starttime" : rows.starttime,
            "endtime" : rows.endtime,
            "status" : intype
        };
        clog(value);
        var _data = {
            "type": "insertroomuser", // group or center or auth
            "centercode": nowcentercode,
            "value" : {"user": value,"roomid":rows.roomid}
        };
        CallHandler("adm_get", _data, function (res) {
            code = parseInt(res.code);
            clog("insertroomuser res is ", res);
            if (code == 100) {
                callback(res.message);

            } else {
                callback(null);
            }

        }, function (err) {
             callback(null);

        });    

    }
    /****************** */
    function roomclick(time,yearmonthnum, roomid){
        clog(yearmonthnum+" roomClick !! "+roomid+" time "+time);
        
        
        
        update_gxroom(time,yearmonthnum,roomid);
    }
    function insertRoomUser(yearmonthnum, roomid,hour,roomname){
        clog("회원추가하기 yearmonthnum "+yearmonthnum+", roomid "+roomid+", hour "+hour+", roomname "+roomname);
        
        var search_tag = "";
    }
    function get_gxcoupondata(uid,couponid){
        var gxcoupon = null;
        
        for(var i = 0; i < gxuserinfos.length; i++){
            if(gxuserinfos[i].mem_uid == uid){
                var user = gxuserinfos[i];
                var membership = JSON.parse(user.mem_membership);
               
                var offset_starttime = "";
                for(var i = 0 ; i < membership.length; i++){
                    if(membership[i].mbstype == TYPE_GX && membership[i].id == couponid){
                        gxcoupon = membership[i];
                        break;                
                    }
                }
                break;
            }
        }
        return gxcoupon;
    }
    /* 221031 유진 수정 */
    function get_user_gxcoupondata(uid, intype,roomid){ // type 추가  //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
        var info = null;
        var roomdata = getRoomdata(roomid);
        for(var i = 0; i < gxuserinfos.length; i++){
            if(gxuserinfos[i].mem_uid == uid){
                info = gxuserinfos[i];
                break;
            }
        }
        var membership = JSON.parse(info.mem_membership);
        var gxcoupon = null;
        var offset_starttime = "";
        if(info.mem_membership != "" && info.mem_membership != "null")
        for(var i = 0 ; i < membership.length; i++){
            if(membership[i].mbstype == TYPE_GX){
                var maxcount =  getMbsMaxCount(membership[i]);//parseInt(membership[i].mbsmaxcount);
                var usecount =  parseInt(membership[i].usecount);
                
                var isdelete = membership[i].isdelete && membership[i].isdelete == "D" ? true : false;
                var issendedcoupon =  membership[i].issendedcoupon && membership[i].issendedcoupon == -1 ? true : false;
                var isfulluse = usecount >= maxcount ? true : false;
                
                var room_datetime = roomdata.room_datetime;
                
                
				//오늘기준 날짜가 안지났으면서 해당회원권이 예약날짜종료일 안에 있다면
                if(getDDay(membership[i].endtime) >= 0 && compare_date(room_datetime, membership[i].starttime) >= 0  && compare_date(room_datetime, membership[i].endtime) <= 0 ){
                    
                    if(!isdelete && !issendedcoupon && !isfulluse){//삭제된쿠폰이 아니라면
                        
                        //회원권 시작일이 작은거 먼저
                        if(!gxcoupon|| gxcoupon && compare_date(gxcoupon.starttime, membership[i].starttime) > 0 ){
                            gxcoupon = membership[i];    
                            offset_starttime = gxcoupon.starttime;
                            
                        }
                        
                    }
                }
                    
                
//                if(gxcoupon)clog(i+" gxcoupon.starttime "+ gxcoupon.starttime+" membership[i].starttime "+membership[i].starttime+" compare "+compare_date(gxcoupon.starttime,  membership[i].starttime)+" dday "+getDDay(endtime));
            }
        }
        
        
        clog("gxcoupon ",gxcoupon);
        var value = null;
        if(gxcoupon){
            var value = {
                "inserttime":"",
                "couponid" : gxcoupon.id,
                "username" : info.mem_username,
                "useruid" : info.mem_uid,
                "userid" : info.mem_userid,
                "starttime" : gxcoupon.starttime,
                "endtime" : gxcoupon.endtime,
                "status" : intype  // type에 들어가게 // 0 : 강좌에 회원입력하기  //무조건 예약하기이다.
            };    
        } 
        
        return value;
         
        
    }
    /* 221031 유진 수정 */
    function send_gxuser(roomid,uid,type){ // type 추가
        //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
       
        var value = get_user_gxcoupondata(uid,type,roomid); // type 추가
        clog("value is ",value);
        if(!value){
            alertMsg("예약가능한 회원권이 없습니다. ");
            return;
        }
         var centercode = now_centercode;
        var _data = {
            "type": "insertroomuser", // group or center or auth
            "centercode": centercode,
            "value" : {"user": value,"roomid":roomid}
        };
        CallHandler("adm_get", _data, function (res) {
            code = parseInt(res.code);
            clog("insergxuser res is ", res);
            if (code == 100) {
                
                 C_showToast("알림", res.message, function() {});
                
                    reload_calendar_page();
                

            } else {
                alertMsg(res.message);
            }

        }, function (err) {
             alertMsg("네트워크 에러");

        });    

    }
    
    
    function removeRoom(yearmonthnum, roomid,hour,roomname,userslen){
         clog(yearmonthnum+" removeroom !! "+roomid);
         if(userslen > 0 ){
            alertMsg("강좌삭제는 회원이 없을때만 가능합니다. 회원을 삭제해주세요");
            return;
         }
        if(!isPermission(224)){
             alertMsg("강좌를 삭제할 권한이 없습니다.");
             return;
         }
         showModalDialog(document.body, "강좌삭제하기", hour+"시 ["+roomname+"]강좌를 삭제하시겠습니까?", "삭제하기", "취소", function() {

           
            var value = {
                yearmonthnum :yearmonthnum,
                roomid : roomid
            }
             sendRemoveRoom(value);
        }, function() {
            hideModalDialog();
        },null);
    }
    function sendRemoveRoom(value){
        
        
        var groupcode = now_groupcode;
        var centercode = now_centercode;

         var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"deleteroom",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
            code = parseInt(res.code);
            if (code == 100) {
                
               C_showToast( "알림", res.message, function() {});
                   reload_calendar_page();
              
            } else {
                alertMsg(res.message,function(){
                    hideModalDialog();       
                });
            }
             
        }, function (err) {
            alertMsg("네트워크 에러 ");

        });
    }

 function getInRooms(){
    var isinroom = false;
    var rooms = [];
    for(i = 0; i < allgxreservation.length; i++) {
        var roomdata = JSON.parse(allgxreservation[i].gx_roomdata);
        
        
            for(var k = 0 ; k < before_copydates.length;k++){
                
                if(roomdata.room_datetime.indexOf(calendarDateToDateTime(before_copydates[k])) >= 0){
                   
                   rooms.push(roomdata);
                }
            }

        
        
    }
     return rooms;
 }  
 function calendarDateToDateTime(cdate){
    var carr = cdate.split("-");
    var yyyy = carr[0];
    var mm = parseInt(carr[1]) < 10 ? "0"+parseInt(carr[1]) : ""+parseInt(carr[1]);
    var dd = parseInt(carr[2]) < 10 ? "0"+parseInt(carr[2]) : ""+parseInt(carr[2]);
    var cymd = yyyy+"-"+mm+"-"+dd;
     return cymd;
 }   
 function isInRoom(){
     var isinroom = false;
   
    for(i = 0; i < allgxreservation.length; i++) {
        var roomdata = JSON.parse(allgxreservation[i].gx_roomdata);
        
       
            clog("room datetime ",roomdata.room_datetime);
            for(var k = 0 ; k < click_hdate_arr.length;k++){
//                var carr = click_hdate_arr[k].split("-");
//                var yyyy = carr[0];
//                var mm = parseInt(carr[1]) < 10 ? "0"+carr[1] : carr[1];
//                var dd = parseInt(carr[2]) < 10 ? "0"+carr[2] : carr[2];
//                var cymd = yyyy+"-"+mm+"-"+dd;
                
                if(roomdata.room_datetime.indexOf(calendarDateToDateTime(click_hdate_arr[k])) >= 0){
                    isinroom = true;
                    break;
                }
            }

        
        if(isinroom)break;
    }
     return isinroom;
 }
//데이타를 최초로 삽입했는지 체크한다.    
var isfirstinsert = true;   
    var ismullticenter = false;//센터가 여러개인지체크
    var isshow_centerlist = false; //현재 센터목록이 보이는지 , 달력이 보이는지 체크
var alldata = [];
var allusers = new Object();
    
    //총 예약인원, 총 대기인원
var total_gxuser_month = {};
var total_gxreadyuser_month = {};
var total_gxuser_day = {};
var total_gxreadyuser_day = {};
    
var reservation_user_couponcount = {};
function insertCalenderDatas(datas){   
    
    clog("datas is ",datas);
    //test
    reservation_user_couponcount = {};
    alldata = [];
    for(i = 0; i < datas.length; i++) {
        var roomdata = JSON.parse(datas[i].gx_roomdata);
       
//            clog("roomdata ",roomdata);
            var tdate = roomdata.room_datetime;
            var date = new Date(tdate);

            var title = roomdata.room_name; //제목이지만 내용을 적으면 된다.
            var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
            var y = date.getFullYear();
            var m = date.getMonth();  //
            var d = date.getDate();
            var hh = date.getHours();
            var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
            var start = new Date(y, m, d, hh, mm);
            
             var ym = y+"-"+(m+1);
            var ymd = y+"-"+(m+1)+"-"+d;
            
            if(!user_uid || user_uid && isRoomUser(roomdata.room_users,user_uid) || isRoomUser(roomdata.room_readyusers,user_uid)){
                alldata.push({ title: title, start: start, roomdata:roomdata});   
                
                //각각 유저별 이용횟수를 가져오기 위해 유저 횟수를 데이터에 삽입한다.
                var roomusers = roomdata.room_users ? roomdata.room_users : [];
                
                if(!total_gxuser_month[ym])total_gxuser_month[ym] = 0;
                total_gxuser_month[ym] += roomusers.length;
                if(!total_gxuser_day[ymd])total_gxuser_day[ymd] = 0;
                total_gxuser_day[ymd] += roomusers.length;
                
                for(var k = 0 ; k < roomusers.length; k++){
                    var uid_couponid = roomusers[k].useruid+"_"+roomusers[k].couponid;
                    var coupon = get_gxcoupondata(roomusers[k].useruid,roomusers[k].couponid);
                    if(coupon){
                        if(!allusers[uid_couponid]){
                            allusers[uid_couponid] = new Object();
                            allusers[uid_couponid].usecount = coupon.usecount ? parseInt(coupon.usecount) : 0;
                            allusers[uid_couponid].maxcount = coupon.mbsmaxcount;
                            allusers[uid_couponid].mbsname = coupon.mbsname;
                            allusers[uid_couponid].couponid = coupon.id;
                            allusers[uid_couponid].starttime = coupon.starttime;
                            allusers[uid_couponid].endtime = coupon.endtime;
                            

                        }
                        
                        
                        ///////////////////////////////////////////
                        // 예약횟수 체크하기
                        ///////////////////////////////////////////
                        var roommin = roomdata.room_min;
                        var hour = hh;
                        var roomlessontime = roomdata.room_lessontime ? parseInt(roomdata.room_lessontime): 50;
                        var emin = (parseInt(roommin)+roomlessontime); //50분기준으로 한다.
                        var lesson_endtime = nextMin(tdate,emin);

                        var date = new Date(lesson_endtime);
                        var y = date.getFullYear();
                        var m = date.getMonth()+1;  //
                        var d = date.getDate();
                        var hh = date.getHours();
                        var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                        var etime = getDateToStr(y,m,d,hh,mm)

                        if(isNowTimeMinOver(etime) > 0){
                            if(!reservation_user_couponcount[uid_couponid])reservation_user_couponcount[uid_couponid] = 0;
                            reservation_user_couponcount[uid_couponid]++;
                        }   
                    }                    
                }
                
                //각각 유저별 이용횟수를 가져오기 위해 유저 횟수를 데이터에 삽입한다.
                var room_readyusers = roomdata.room_readyusers ? roomdata.room_readyusers : [];
                
                if(!total_gxreadyuser_month[ym])total_gxreadyuser_month[ym] = 0;
                total_gxreadyuser_month[ym] += room_readyusers.length;
                if(!total_gxreadyuser_day[ymd])total_gxreadyuser_day[ymd] = 0;
                total_gxreadyuser_day[ymd] += room_readyusers.length;
                
                for(var k = 0 ; k < room_readyusers.length; k++){
                    var uid_couponid = room_readyusers[k].useruid+"_"+room_readyusers[k].couponid;
                    var coupon = get_gxcoupondata(room_readyusers[k].useruid,room_readyusers[k].couponid);
                    if(coupon){
                        if(!allusers[uid_couponid]){
                            allusers[uid_couponid] = new Object();
                            allusers[uid_couponid].usecount = coupon.usecount ? parseInt(coupon.usecount) : 0;
                            allusers[uid_couponid].maxcount = coupon.mbsmaxcount;
                            allusers[uid_couponid].mbsname = coupon.mbsname;
                            allusers[uid_couponid].couponid = coupon.id;
                            allusers[uid_couponid].starttime = coupon.starttime;
                            allusers[uid_couponid].endtime = coupon.endtime;
                            
                        }
                    }                    
                }
            }
            
        
    }
    clog("allusers ",allusers);
    if(isfirstinsert){
        console.log("11 isfirstinsert "+isfirstinsert);
        alldata.sort(function(a, b) {return (+a.start) - (+b.start);});

        $('#gx_holder').calendar({
            data: alldata
        });
        window.el = $('#gx_holder');
         isfirstinsert = false;
        console.log("11 isfirstinsert "+isfirstinsert);
     }else{
        for(var i =0; i < alldata.length;i++)
            window.options.data.push(alldata[i]);
        if(window.mdraw)window.mdraw();
     }
    
    
}
    //예약한 현재시간 이후 미래의 횟수다 uid_couponid
    function getReservationUserCouponCount(uid_couponid){
        if(reservation_user_couponcount[uid_couponid])
            return reservation_user_couponcount[uid_couponid];
        else return 0;
    }
    function initTotalGXUser(mode, y,m,d){

        if(mode == "day"){
            var ymd = y+"-"+m+"-"+d;
            var txt_total_gxuser_day = document.getElementById("txt_total_gxuser_day"); //day
            var txt_total_gxreadyuser_day = document.getElementById("txt_total_gxreadyuser_day"); //day
            txt_total_gxuser_day.innerHTML = total_gxuser_day[ymd] ? "예약: "+total_gxuser_day[ymd]+"건" : "예약: 0건";
            txt_total_gxreadyuser_day.innerHTML = total_gxreadyuser_day[ymd] ? "대기: "+total_gxreadyuser_day[ymd]+"건" : "대기: 0건";
            
        }else {
            var ym = y+"-"+m;
            var txt_total_gxuser_month = document.getElementById("txt_total_gxuser_month"); //month
            var txt_total_gxreadyuser_month = document.getElementById("txt_total_gxreadyuser_month");//month
            
            txt_total_gxuser_month.innerHTML = total_gxuser_month[ym] ? "예약: "+total_gxuser_month[ym]+"건" : "예약: 0건" ;
            txt_total_gxreadyuser_month.innerHTML = total_gxreadyuser_month[ym] ? "대기: "+total_gxreadyuser_month[ym]+"건" : "대기: 0건";    
        }
    }
    function isRoomUser(roomusers,uid){
        var isin = false;
        if(roomusers)
        for(var i = 0 ; i < roomusers.length;i++){
            if(roomusers[i].useruid == uid){
                isin = true;
                break;
            }
        }
        
        return isin;
    }
   
    var first_goto_day = false;
    function checkDayPage(){
//        if(thisday && !first_goto_day && thisday > 0){
//            var fInterval = setInterval(function(){
//                if(isloaddata && window.options && window.mdraw){
//                    clearInterval(fInterval);
//                    // 달력으로 이동한다.테스트
//                    window.options.mode = "day";
//                    var date = new Date(ymd);
//                    window.options.date = date;
//                      if(window.mdraw){
//                          window.mdraw();
//                      }
//                    id_hcalendar.style.display = window.options.mode == "month" ? "block" : "none";
//                    btn_insert_room.style.display = isPermission(222) && options.mode == "day" ? "block" : "none";
//                    first_goto_day = true;
//                }
//            },1000);
//        }
    }
   
    
    //mode == day 라면 해당날짜로 간다.
//    function reload_calendar_page(_useruid,_username,_userid){
//     
//        var mode = window.options && window.options.mode ? window.options.mode : "month";
//        var date = window.options && window.options.date ? window.options.date.getTime() : "";
//        param_day = mode == "day" ? date : "";
//        
////        refresh_page("?centercode="+param_centercode+"&day="+param_day); //
//        first_goto_day = false;
//       
//        var useruid = _useruid ? _useruid : "";
//        var username = _username ? _username : "";
//        var userid = _userid ? _userid : "";
//        var value = {"date":thisyear+"-"+thismonth+"-"+thisday, "useruid":useruid, "username":username, "userid":userid}
//        var nowdate = thisyear+"-"+thismonth+"-"+thisday;
//        refresh_page("?groupcode="+now_groupcode+"&centercode="+param_centercode+"&date="+nowdate+"&useruid="+useruid+"&username="+username+"&day="+userid+"&day="+userid+"&day="+param_day); 
////        C_ShowLoadingProgress();
////        clog("window.clientHeight "+window.scrollHeight +" window.innerHeight "+window.innerHeight  +" window.scrollTop "+window.scrollTop );
//    }
    
       function reload_calendar_page(centercode){
            if(centercode)param_centercode = centercode;
            var mode = window.options && window.options.mode ? window.options.mode : "month";
            var date = window.options && window.options.date ? window.options.date.getTime() : "";
            param_day = mode == "day" ? date : "";
            refresh_page("?centercode="+param_centercode+"&day="+param_day); 
        }
    
// 배열을 선언하여 사용하는 방식
function initAutoComplete(){

    clog("initAutoComplete!!");
//    var searchSource = [{"label":"엽기떡볶이","value":"1111"},{"label":"신전떡볶이","value":"22222"},{"label":"걸작떡볶이","value":"33333"},{"label":"신당동떡볶이","value":"44444"}];
    $(".searchBox").autocomplete({
        source:searchSource,//source 는 자동완성의 대상
        select: function(event, ui) {// item 선택 시 이벤트
            event.preventDefault();
            clog("aa event",event);
            var roomid = this.id;
            var type = this.name;
            
            $(this).val(ui.item.label);
            
            clog("선택했다 value "+ui.item.value);
            //월에서 회원을 검색했다면 해당 회원달력으로 표기한다.
            if(roomid == "input_all_search")reload_calendar_page(ui.item.value,ui.item.label,ui.item.userid);
            else send_gxuser(roomid, ui.item.value, type);
            return false;
        },
        minLength: 1,// 최소 글자 수
        autoFocus : true,// true로 설정 시 메뉴가 표시 될 때, 첫 번째 항목에 자동으로 초점이 맞춰짐
        focus : function(event, ui) { // 포커스 시 이벤트
            return false;
        },
        classes : { // 위젯 요소에 추가 할 클래스를 지정
            'ui-autocomplete' : 'highlight'
        },
        delay : 50,
        disable : true, // 해당 값 true 시, 자동완성 기능 꺼짐
        position : { my : 'right top', at : 'right bottom'}, // 제안 메뉴의 위치를 식별
        close : function(event) { // 자동완성 창 닫아질 때의 이벤트
//            clog("this ",this);           
        }
    });
};
//function scrollToY(y,duration){
//    clog("scrollToY");
//    const stepY = (y - window.scrollY) / duration;
//
//  const currentY = window.scrollY;
//
//  const startTime = new Date().getTime();
//
//  const scrollInterval = setInterval(() => {
//    const now = new Date().getTime() - startTime;
//
//    window.scrollTo({ top: currentY + (stepY * now) });
//
//    if (duration <= now) {
//      clearInterval( scrollInterval );
//    }
//  }, 1);
//}
function getGXReservationData(value,callback){

        
//        var groupcode = getData("nowgroupcode");
//        var centercode = getData("nowcentercode");

        var senddata = {
            groupcode : now_groupcode,
            centercode : now_centercode,
            type :"getgxreservationdata",
            value:value
        };
//        clog("year is ",v);
        CallHandler("adm_get", senddata, function (res) {
           callback(res);
        }, function (err) { 
            alertMsg(err);
        });
    }    
    
    function showUserInfoPopup(useruid){
        var screen_width = $(window).width();
        //neel_sessioncheck
        var style = {
             modaltype:"large",
             marginTop:"0px",
             bodycolor:"#ffffff",
             size:{
                 width:"95%",
                 height:"auto"
             },
             top:{
                 color:"#262930",
                 textAlign:"left",
                 paddingLeft:"25px",
                 borderBottom: "1px solid #dddddd"
             },
             bottom:{
                 textAlign:"right",
                 paddingRight:"25px",
                 borderTop: "1px solid #dddddd",
                 
                
             },
             //커스텀 버튼
             button_width: "100px",
             button_height: "43px",
             button_color : "white",
             button_bgcolor : "#31b0f8"
             
             
        };
        
        getUserData(useruid, function(res) {
             var code = parseInt(res.code);
             if (code == 100) {
                 getUserGXDatas(now_groupcode,now_centercode,useruid,function(){
                     //global_gxdatas
                    showModalDialog(document.body,"고객정보보기", gettag(random_string(),res.message[0]), "확인", null,function(){
                        hideModalDialog();
                    },function(){},style);    
                 });
                 
             }
            
        },function(err){},now_groupcode,now_centercode);
        
    }
    function remove_inuser(yearmonthnum, roomid,yy,mm,dd,hour,roomname,username,useruid,page){
        showModalDialog(document.body, "회원삭제하기", mm+"월 "+dd+"일 "+hour+"시 ["+roomname+"]강좌에서 "+username+" 회원을 삭제하시겠습니까?", "회원삭제하기", "취소", function() {

            var value = {
                "yearmonthnum" :yearmonthnum,
                "roomid" : roomid,
                "useruid" : useruid
            }
             sendRemoveRoomUser(value,page);
        }, function() {
            hideModalDialog();
        },null);
    }
    function sendRemoveRoomUser(value,page){
        
        
        var groupcode = now_groupcode;
        var centercode = now_centercode;

         var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"removeroomuser",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
            code = parseInt(res.code);
            if (code == 100) {
                 C_showToast("알림", res.message, function() {});
                 if(page == "gxpage")reload_calendar_page();
                 else if(page == "userpage"){
                     hideModalDialog();
                     
                     header_search(value.useruid);
                 }

            } else {
                alertMsg(res.message,function(){
                    hideModalDialog();       
                });
            }
             
        }, function (err) {
            alertMsg("네트워크 에러 ");

        });
    }
</script>

