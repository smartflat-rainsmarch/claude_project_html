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
//        if( /Android/i.test(navigator.userAgent)) {
//           
//                var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }else {
//                var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=0.5, maximum-scale=2.0, minimum-scale=0.5');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }
        var MetaTag = document.createElement("META");
        MetaTag.setAttribute('name', 'viewport');
        MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
        document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
<!--    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1" />-->
    <meta name="format-detection" content="telephone=no, address=no, email=no" />

    <!-- 아이폰(사파리) UI 없애기 -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <!--<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <link href="./css/modaldialog.css?var1.02" rel="stylesheet">
    
<!--    당겨서 새로고침
    <script src="./libs/pulltorefresh/pulltorefresh.js"></script>  //Page Pull to Refresh 스크립트 
    <script src="./libs/pulltorefresh/touch-emulator.js"></script> // Page Pull to Refresh 스크립트
    <link rel="stylesheet" href="./libs/pulltorefresh/pulltorefreshstyle.css">
    -->
    <script src="js/scripts.js?ver3.02aac4"></script>

    <!--
<link rel="stylesheet" href="./css/layout.css"/>
<link rel="stylesheet" href="./css/sub.css"/>
-->

    <link rel="stylesheet" href="./css/calendar.css?var1.02" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
    
     <!--swipe-->
<!--
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
-->
    <link href="./libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="./libs/swiper/swiper-bundle.min.js"></script>
    
    <!--div to base64image-->    
<!--   <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"></script>-->
    <style>
        @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
        @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}
    
         body {
/*            font-family: 'Noto Sans KR', sans-serif;*/
             font-family: 'Noto Sans KR', sans-serif;
        }
      .holdingbox {
            width : 100%;
            height : 133px;
            background-image : url(./img/box_membership.png);
            background-size: contain;
            background-repeat: no-repeat;
        }
        .fsans {
            font-family: 'Noto', sans-serif;
        }    
       .fmont {
          font-family: 'Montserrat', sans-serif;
        } 

        .mbtn {
            width:302px;;
            height:43px;
            border-radius:10px;
            background-color:#191919;

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
    
        /*커스텀 라디오*/
        .radio_select {
            width:100%;            
        }
        .radio_select input[type=radio]{
            display: none;
        }
        .radio_select input[type=radio]+label{
            background-color:#191919;
            display: inline-block;
            color:white;
            cursor: pointer;
            height: 30px;
            width: 65px;
           
            line-height: 24px;
            text-align: center;
            
            font-size:15px;
            border-radius:5px;
            margin:3px;
        }
        .radio_select input[type=radio]+label{
            background-color: #191919;
            color: #ffffff;
        }
        .radio_select input[type=radio]:checked+label{
            background-color: #fffd00;
            color: #111111;
        }
        

        /*모달 뒷배경 뿌옇게*/
        .modal-backdrop{backdrop-filter: blur(5px);background-color: #000000cc;}
        .fade.modal-backdrop.show{opacity: 0.9;}
        
        
        /* div 드래그막기 */
        .stop-dragging
        {
          -ms-user-select: none; 
          -moz-user-select: -moz-none;
          -khtml-user-select: none;
          -webkit-user-select: none;
          user-select: none;
        }
    </style>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->





</head>

<body style="background-color:#111111;" >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <div align="center" style="width:100%;height:60px;margin-top:-60px;position:fixed;z-index:999;background-color:#111111;">

        <text style="color:white;text-align:center;font-size:20px;height:100%;line-height:60px;">예약신청확인</text>
        <!--X button-->
        <div onclick='androidBack()' style='float:left;width:60px;height:60px;'><img src='./img/button_back_sub.png' style='float:left;margin-left:20px;margin-top:20px;width:9px;height:18px;'/></div>
        <div onclick='reload_calendar_page()' style='float:right;width:60px;height:60px;margin-right:7px'><img src='./img/button_reload.png' width='31px' height='30px'style="margin-top:15px"/></div>
    </div>
    
    <div id="main" style="margin-top:60px;">
        
<!--
         <div id= "container" style="background:#111111;" >
             <div id= "center" >

            </div>
        </div>
-->

        <div id="reservation_container">
            
            <div id="reservation_center">
                
                <!--        <h3 style="text-align:center" id="reservation_title"></h3><br>-->
                <div id='type_pt' style='display:none'>
                    <div id='id_customcombobox' style="width:100%;padding-left:20px;padding-right:20px;"></div>
                    <div id='div_month_total_table' style='width:100%;height:80px;margin-top:10px;padding-left:20px;padding-right:20px' align="center" >
                       <img src = "./img/box_button_reservation_box_new.png" style="text-align:center;width:335px;height:80px;z-index:-1;"/> 
                       <table id="month_total_table" cellspacing="0" style="position:absolute;margin-top:-80px">
                            <thead>
                                <tr align="center"  style="height:34px">
                                    <td style="width:84px;vertical-align:bottom"><text style="margin-top:20px;font-size:13px;color:#919191">예약인원</text></td>
                                    <td style="width:84px;vertical-align:bottom"><text style="margin-top:20px;font-size:13px;color:#919191">전체예약</text></td>
                                    <td style="width:84px;vertical-align:bottom"><text style="margin-top:20px;font-size:13px;color:#919191">현재예약중</text></td>
                                    <td style="width:84px;vertical-align:bottom"><text style="margin-top:20px;font-size:13px;color:#919191">완료</text></td>
                                </tr>


                            </thead>
                            <tbody>

                                 <tr align="center" style="height:42px" >                                
                                    <td style="width:84px;vertical-align:top"><text id="month_now_user" style='font-size:17px;font-weight:bold;color:white'>0</text></td>
                                    <td style="width:84px;vertical-align:top"><text id="month_all_reservation_count" style='font-size:17px;font-weight:bold;color:white'>0</text></td>
                                    <td style='width:84px;vertical-align:top'><text id="month_now_reservation_count" style='font-size:17px;font-weight:bold;color:white'>0</text></td>
                                    <td style='width:84px;vertical-align:top'><text id="month_total_confirm_count" style='font-size:17px;font-weight:bold;color:white'>0</text></td>

                                </tr>
                            </tbody>
                        </table>   
                    </div>
                    <div id='div_user_coupon' style="background-color:#1e1e1e;height:auto;display:none;border-radius:8px;margin-left:20px;margin-right:20px;margin-top:5px">
                        <table  id="user_coupon_table" cellspacing="0" >
                            <thead>
                                <tr align="center" style="height:30px" >
                                    <td style=""><text style="font-size:12px;color:#919191">숫자</text></td>
                                    <td style=""><text style="font-size:12px;color:#919191">등록일</text></td> <!--couponid-->
                                    <td style=""><text style="font-size:12px;color:#919191">등록횟수</text></td>
                                    <td style=""><text style="font-size:12px;color:#919191">완료/확인/신청</text></td>
                                    <td style=""><text style="font-size:12px;color:#919191">목록보기</text></td>
                                </tr>


                            </thead>
                            <tbody>

                            </tbody>
                        </table>  
                    </div>
                    <!--색깔별로 예약현황 알려줌-->
                    <div align="center" style="margin-top:10px">


                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#fcbb1d'></rect></svg>&nbsp;<text id="mmmm" style='font-size:13px;color:white'>일정오픈</text>&nbsp;&nbsp;
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#2cc174'></rect></svg>&nbsp;<text style='font-size:13px;color:white'>예약</text>&nbsp;&nbsp;
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#5c6cf3'></rect></svg>&nbsp;<text style='font-size:13px;color:white'>고객승인</text>&nbsp;&nbsp;
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#eb703b'></rect></svg>&nbsp;<text style='font-size:13px;color:white'>완료</text>&nbsp;&nbsp;                    
                    </div>
                    <br>
                </div>
                
                <div id='type_gx' style='display:none'>
                    <div style='padding-left:20px;padding-right:20px;display:none'>
                        <div id ='div_manager_box'  style='width:100%;height:100px;background-image:url(./img/box_mybooking.png);border:0px;background-size:100% 100%;padding:20px'>
                            <div style='float:right'>
                                <div align="center" style='width:70px;height:70px;background-color:#202020;margin-top:-7px;border-radius:35px'>
                                    <div style='padding-top:17px'><text style="text-align:bottom;color:#919191;font-size:11px;"><span style='color:#fffd00;font-weight:bold'>PT</span> : 그룹</text></div>
                                    <div style='margin-top:3px'><text id='txt_ptcount' style='font-size:16px;color:white;'><span style='color:#fffd00;font-weight:bold'>19</span>24</text></div>
                                </div>
                            </div>
                            <div style='width:100%;margin-top:-3px'><text style="font-size:15px;color:#fffd00" id ="manager_name">이번달 진행횟수</text></div>

                            <div style='width:100%;margin-top:5px;display:none'><text style="font-size:13px;color:white" id ="coupon_info">0회 진행</text></div><!--GX일반회원 회원권이나 강사는 사용안함-->

                            <div style='width:100%;margin-top:6px;display:none'><text class='fmont' style="color:#919191;font-size:11px" id ="coupon_startend">2020-01-01~2020-04-30</text></div><!--GX일반회원 기간이나 강사는 사용안함-->

                        </div>
                    </div>
                     <!--색깔별로 예약현황 알려줌-->
                    <div align="center" style="margin-top:10px">

                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#fcbb1d'></rect></svg>&nbsp;<text id='icon_txt_1' style='font-size:13px;color:white'>오픈</text>&nbsp;&nbsp;
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#2cc174'></rect></svg>&nbsp;<text id='icon_txt_2' style='font-size:13px;color:white'>예약함</text>&nbsp;&nbsp;
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#5c6cf3'></rect></svg>&nbsp;<text id='icon_txt_3' style='font-size:13px;color:white'>출석</text>&nbsp;&nbsp;
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#eb703b'></rect></svg>&nbsp;<text id='icon_txt_4' style='font-size:13px;color:white'>정원초과</text>&nbsp;&nbsp;      
                        <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#919191'></rect></svg>&nbsp;<text id='icon_txt_5' style='font-size:13px;color:white'>대기신청</text>&nbsp;&nbsp;      
                    </div>
                    <br>
                </div>
<!--                <p align="right"><button class="btn btn-default" id="btn_teach_reservation" onclick="open_sheet()" style="background-color:#a3bDf1">전체일정오픈하기</button></p>-->

                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="calendar_container theme-showcase swiper-slide">
                           <img id="holder_prev" />
                        </div> 
                        <div class="calendar_container theme-showcase swiper-slide">
                            <div id="holder" align="center"  style="background-color:#191919;border-radius:20px;margin-top:-5px"></div>
                        </div>  
                        <div class="calendar_container theme-showcase swiper-slide">
                           <div id="holder_next" align="center"  style="background-color:#191919;border-radius:20px;margin-top:-5px"></div>
                        </div>  
                    </div>               
                </div>
               
                        
                  
            </div>


        </div>
        <!--    에러 다이얼로그 -->
        <div id="end_modal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body" style="text-align:center">
                        <p align="center">가입한 목록이 없습니다.</p>
                        <p align="center">홈화면으로 이동합니다.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" onclick="call_app()">홈으로</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    
    
    <!--    당겨서 새로고침-->
<!--    <script>TouchEmulator()</script>-->

    <script>
        setZoom();
        var now_month = {yy:"",mm:"",month_now_user:0,month_all_reservation_count:0,month_now_reservation_count:0,month_now_reservation_finish_count:0,month_total_confirm_count:0,users:[]};
        ///////////////////////////////////
        //Hammer 제스처 Start
        ///////////////////////////////////
       
        //상단 PT 인지 GX 인지 체크한다.
        var type_ptgx = "PT";
//        C_AppLoadData("type_ptgx",function(res){
//            type_ptgx = res;
//            clog("C_AppLoadData : type_tpgx is "+type_ptgx);
//        }); 
        
        var issliding = 0;
         var mySwiper = new Swiper('.swiper-container', {
            //최초 페이지 설정
            initialSlide: 1,
             //감도
            threshold:40, 
            speed: 200,
//            effect : 'fade', 
//            fadeEffect: { 
//            crossFade: true 
//            },
              effect: 'flip',
              flipEffect: {
                slideShadows: false,
              },
//            effect: 'slide',
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

            // 3초마다 자동으로 슬라이드가 넘어갑니다. 1초 = 1000
            //  autoplay: {
            //    delay: 3000,
            //  },
            
             //페이드
            fadeEffect: {
                crossFade: true
            },
            onAny(eventName, ...args) {

                if(eventName == "activeIndexChange"){
                   
                   const swipe = this;
//                   if(window.calendar && issliding == 0)
                   {
                       clog("this.activeIndex "+this.activeIndex);
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
//             clog('Event: ', eventName);
//             clog('Event data: ', args);
//            if(eventName == "slidePrevTransitionEnd")clog("**** ",args[0].activeIndex);
                
//             if(eventName == "slideNextTransitionEnd" && args[0].activeIndex == 2){
////                  this.slideTo(1,0);
//                 this.activeIndex = 1;
////                 if(window.calendar){                    
////                     window.calendar(window.el,window.options,"next");
////                 }
//             }
//             else if(eventName == "slidePrevTransitionEnd" || eventName == "slideNextTransitionEnd"){
//                 clog(issliding+" eventName "+eventName);
//                 const swipe = this;
//                 
//                 if(issliding == 1){
//                     setTimeout(function(){
//                         swipe.slideTo(1,50);
//                           issliding = 0;
//                     },100);
//                 }
//             }
               
//               if(eventName == "setTranslate"){
////                   if(istouchend){
////                       istouchend = false;
////                       const swipe = this;
////                       setTimeout(function(){
////                           swipe.slideTo(1,0);
////                       },200);
////                   }
//               }
               if(eventName == "slideChange"){
                   clog("slideChange ");
                   isslide_change = true;
               }
//               if(eventName == "touchStart"){
//                    copyHolder();
////                   swipe_x = args[1].x;
////                   istouchend = false;
////                   clog("START :  before "+swipe_x+" now "+swipe_x);
//               }
//               if(eventName == "touchMove"){
////                   swipe_x = args[1].x;
////                   clog("MOVE :  before "+swipe_x+" now "+swipe_x);
////                   if(istouchend)this.slideTo(1,0);
//               }
//               if(eventName == "touchEnd"){
//                   
//                   var now_x = args[1].x;
//                   var area_gab = 100;
////                   clog("END :  before "+swipe_x+" now "+now_x);
//                   if(swipe_x  < now_x+area_gab){
////                       clog("<< PREV");
//                       if(window.calendar){    
////                           clog("<< dd PREV");
//                           
////                           window.calendar(window.el,window.options,"prev");
//                       }
//                   }else if(swipe_x  > now_x+area_gab){
////                       clog(">> NEXT");
//                       if(window.calendar){
////                            this.activeIndex = 1;
////                           clog(">> dd NEXT");
////                           window.calendar(window.el,window.options,"next");
//                           
//                       }
//                   }
////                   this.activeIndex = 1;
////                   const swipe = this;
////                   setTimeout(function(){
////                       swipe.slideTo(1,0);
////                       isslide_change = false;
////                   },200);
//                   
////                   clog("END x "+args[1].x+" y "+args[1].y+" index "+swipe_x);
//               }
                
           }
        });
        
        
        //안드로이드 뒤로가기이다.
        function androidBack(){
            if(window.options && window.options.mode && window.options.mode == "day"){
                window.options.mode = "month";
                window.calendar(window.el,window.options,"month");
            }else {
                call_app();
            }
        }
        ///////////////////////////////////
        //Hammer 제스처 End
        ///////////////////////////////////
        
//        function copyHolder(){
//            var holder = document.getElementById("holder");
//            var holder_prev = document.getElementById("holder_prev");
//            var holder_next = document.getElementById("holder_next");
////            divToBase64("holder",function(base64){
////                holder_next.src = base64;    
////                holder_prev.src = base64;    
////            });
////            
//        }
//        function removeHolder(){
//            var holder_prev = document.getElementById("holder_prev");
//            var holder_next = document.getElementById("holder_next");
//            holder_prev.src = "";
//            holder_next.src = "";
//           
//        }
//        function divToBase64(id,callback)
//        {
////           var imgbase64data =  base64_encode(document.getElementById(id).img);
////           clog("imgbase64data "+imgbase64data);
//            
//            let div = document.getElementById(id);
//  
//            // Use the html2canvas
//            // function to take a screenshot
//            // and append it
//            // to the output div
//            html2canvas(div).then(
//                function (canvas) {
////                    document
////                    .getElementById('output')
////                    .appendChild(canvas);
//                    callback(canvas.toDataURL());
//                })
//        }
        
        
        
        var isfirst = true;
        var param_centercode = getParam("centercode");
        var param_day = getParam("day");
        var param_useruid = getParam("useruid");
 		var param_teachername = decodeURIComponent(getParam("teachername"));
        var param_teacheruid = getParam("teacheruid");
        var param_teacherid = getParam("teacherid");
        
        var orneruid = '<?php echo $uid ;?>';
        var mem_teacher_alldata = [];
        var calendar_data = null;
//        var reservationinfo = null;
        var reservationinfo = null;
        console.log("00 param_centercode is "+param_centercode);
//        var container = document.getElementById("container");
        
        
        var userinfos = null;
        var newuserinfos = null;
  
		 document.title = "[강사용] "+decodeURI(param_teachername)+" 예약화면";

        var isgxdata = false;
       if(auth < AUTH_TRANER){
           alertMsg("접근 권한이 없습니다.");
           gotohome();
       }else {
           
           
           GX_init(function(isgx){
               isgxdata = isgx;
               
               
               var data = {
                    orneruid : orneruid,
                    teacheruid:param_teacheruid,
                    teacherid:param_teacherid,
                    centercode: param_centercode,
                    type: "teacherreservation"

                }
                PT_init(data);
           });
           
        }
        function removeFreePTText(_txt){
            var txt = _txt+"";
            return txt.replace(TXT_FREEPT,"");
        }
        function isFreePTText(txt){
            if(txt.indexOf(TXT_FREEPT) >= 0)
                return TXT_FREEPT;
            return "";
        }
      
        ////////////////////////////////////////////////////////////////////
        // GX START
        ////////////////////////////////////////////////////////////////////
        
        var gxtypes = null;
        var gxteachers = null;
        function GX_init(callback){
            

            var user = param_teacheruid;
           
            var data = {
                type: "gxteacher_reservation",
                
                centercode : param_centercode,
            }

            CallHandler("my_gxreservation", data, function(res) {
                var code = parseInt(res.code);
                if (code == 100) {

                    var json = res.message;
                    GX_setCalendar(json);

                    if(res.gxtypes)gxtypes = res.gxtypes;
                    if(res.gxteachers)gxteachers = res.gxteachers;

                    var ready_count = 0;
                    var fix_count = 0;
                    if(res.message.length > 0)
                        callback(true); 
                    else 
                        callback(false);
                } else {
//                    alertMsg(res.message);
                    GX_setCalendar(null);
                    callback(false);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
        }
         
        function GX_setCalendar(json){
            
//            var container = document.getElementById("container");
//            container.style.display = "none";
            reservation_container.style.display = "block";
            calendar_data = json;
            
            insertGXCalenderDatas(json);
            
        }
        
        
        ////////////////////////////////////////////////////////////////////
        // GX END
        ////////////////////////////////////////////////////////////////////
        
        
        
        function PT_init(data){
            
           
            
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {

                    //강사의 예약정보가 한개도 없다.
                    if (res.message == "") {
                        //               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });

//                        var divcenter = document.getElementById("center");
//                        var br0 = document.createElement('br');
//                        divcenter.appendChild(br0);
//                        for (var i = 0; i < res.centers.length; i++) {
//                                var center = res.centers[i];
//                                var button = document.createElement('button');
//                                var title = center.centername;
//                                var btntxt = document.createTextNode(title);
//                                button.id = i;
//                                button.className = "my-button";
//                                button.appendChild(btntxt);
//
//                                button.onclick = function() {
//
//                                   var ctr = res.centers[parseInt(this.id)];
//                                   var rinfo = JSON.parse(ctr.reservationinfo)[0];
//                                   mem_teacher_alldata = [{"centercode": ctr.centercode,"centername": ctr.centername,"type": rinfo.type,"open":[],"close":[],"ready":[]}];
//                                   setCalendar(mem_teacher_alldata[0]);                               
//                                }
//                                divcenter.appendChild(button);
//
//                                var br1 = document.createElement('br');
//                                var br2 = document.createElement('br');
//                                var br3 = document.createElement('br');
//                                divcenter.appendChild(br1);
//                                divcenter.appendChild(br2);
//                                divcenter.appendChild(br3);
//                        }
                        is_insert_pt = true;
                        return;
                    }
                    var json_array = JSON.parse(res.message);
                    mem_teacher_alldata = json_array;

                    //            document.write(res.message);
//                    var divcenter = document.getElementById("center");
//                    var br0 = document.createElement('br');
//                    divcenter.appendChild(br0);

                    //예약정보가 1개 있다. 지금센터코드로 생각한다.
                    if (json_array && json_array.length == 1) {
                         const json = json_array[0];
                         setCalendar(json);

                    }else if (json_array && json_array.length > 1) {
                        if(param_centercode){
                            for (var i = 0; i < json_array.length; i++) {
                                const json = json_array[i];
                                if(json.centercode == param_centercode){
                                    setCalendar(json);
                                    break;
                                }
                            }
                        }else{
                            
                            for (var i = 0; i < json_array.length; i++) {
                                const json = json_array[i];

                                var button = document.createElement('button');
                                var title = json.centername + " "+json.type+" 예약";
                                var btntxt = document.createTextNode(title);
                                button.id = json.mbstype;
                                button.className = "my-button";
                                button.appendChild(btntxt);

                                button.onclick = function() {
                                   setCalendar(json);
                                }
                                divcenter.appendChild(button);

                                var br1 = document.createElement('br');
                                var br2 = document.createElement('br');
                                var br3 = document.createElement('br');
                                divcenter.appendChild(br1);
                                divcenter.appendChild(br2);
                                divcenter.appendChild(br3);
                            }
                        }

                    } else {
                        is_insert_pt = true;
//                        container.style.display = "none";
                        reservation_container.style.display = "block";
//                        alertMsg("현재 회원이 없습니다.");
                    }



                } else {
                    //            alertMsg(res.message);
                    is_insert_pt = true;
                    reservation_container.style.display = "block";
//                    show_error_popup("ERROR", res.message, "exit");
                }

            }, function(err) {
                //        alertMsg("네트워크 에러 ");
                show_error_popup("ERROR", "네트워크 에러", "exit");
            });
        }
        function findcoupon(myusers,user_uid,couponid){
            var myuser = null;
            for(var i = 0 ;i < myusers.length;i++){
//                clog("myusers[i].uid "+myusers[i].uid+" myusers[i].couponid "+myusers[i].couponid+" uid "+user_uid+" couponid "+couponid);
                if(myusers[i].uid == user_uid && myusers[i].couponid == couponid){
                    myuser = myusers[i];
                    break;
                }
            }
            return myuser;
        }
        function displayUserCouponTable(user_uid){
            var div_user_coupon = document.getElementById("div_user_coupon");
            var user_coupon_table = document.getElementById("user_coupon_table");
//            clog(" scale "+zoom);
//            div_user_coupon.style.zoom = zoom+"";
            //show
            if(user_uid != ""){
                var couponlist = {};
                var ptlist = [];
                var cnt = 0;            
                var dates = mem_teacher_alldata[0].ready[0].dates;
                var myusers = mem_teacher_alldata[0].myusers;
                var isin = false; // 시간표에 PT가 1개라도 있는지 체크
                
                if(dates)
                for(var j = 0 ; j < dates.length; j++){
                    var ymd = dates[j].date;
                    var times = dates[j].times;
                    if(times)
                    for(var k = 0 ; k < times.length; k++){
                        var hour = times[k].time
                        var members = times[k].members;
                        if(members)
                        for(var l = 0 ; l < members.length; l++){
                            var userpt = members[l];
                            if(userpt.uid == user_uid){
                                
                                if(!couponlist[userpt.couponid]){
                                    
                                    var myuser = findcoupon(myusers,userpt.uid,userpt.couponid);
                                    if(myuser)
                                        couponlist[userpt.couponid] = {"myuser":myuser,"ptlist":[]};
                                }
                                    
                                userpt.date = ymd;
                                userpt.hour = hour;
                                
                                if(couponlist[userpt.couponid]){
                                    couponlist[userpt.couponid].ptlist.push(userpt);
                                    cnt++;
                                    isin = true;
                                }
                            }
                        }
                    }
                }
                
                if(isin){
                    div_user_coupon.style.display = "block";
                    showUserCouponTable(couponlist);
                }else 
                    div_user_coupon.style.display = "none";
            }else{
                //hide
                div_user_coupon.style.display = "none";
            }
        }
        function getMaxCountInMyusers(myuser){
            var issendedcount = 0;
            var coupon_maxcount = 0;
            for(var i = 0; i < newuserinfos.length;i++){
                if(myuser.uid == newuserinfos[i].uid && myuser.couponid == newuserinfos[i].id){
                    coupon_maxcount = getMbsMaxCount(newuserinfos[i]);//형태는 다르지만 mbsmaxcount , addcountdatas 만 체크해서 상관없다.
                    if(newuserinfos[i].issendedcoupon && parseInt(newuserinfos[i].issendedcoupon) > 0){
                        issendedcount = parseInt(newuserinfos[i].issendedcoupon);
                    }
                    
                    break;
                }
            }
            var max_count = issendedcount > 0 ? issendedcount : coupon_maxcount;
            
            return max_count;
        }
        
        function showUserCouponTable(_couponlist){
            var table = document.getElementById("user_coupon_table");
            
//            table.border = "1";
//            table.style.width = "100%";
//            table.className="table table-bordered";
//            clog("rows ",rows);
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            body.innerHTML = "";
            body.style.float = "center";
            var isdelete = false;
            var isselected = true;
            var foot = table.getElementsByTagName("tfoot")[0];
          
           clog("couponlist ",_couponlist);
            //object 를 key 값으로 정렬
            const couponlist = Object.keys(_couponlist).sort().reduce((obj, key) => { obj[key] = _couponlist[key]; return obj;}, {});
            var cnt = 1;
            for(key in couponlist){
                
                var myuser = couponlist[key].myuser;
                var ptlist = couponlist[key].ptlist;
                ptlist.sort(sort_by('date', false, (a) => a.toUpperCase()));
                
                var len = ptlist.length; //총횟수
                var couponid = myuser.couponid;
                var finish_cnt = 0;   //완료된 횟수
                var confirm_cnt = 0; //고객확인된 횟수
                var request_cnt = 0; //신청만한 횟수
                 var maxcount = getMaxCountInMyusers(myuser);
                var freecount = myuser.freecount ? myuser.freecount : 0;
                var totalmaxcount = parseInt(maxcount)+parseInt(freecount);
                if (len > 0) {
                    cnt++;
                    for(var i = 0 ; i < ptlist.length; i++){

                        var data = ptlist[i];     
                        if(parseInt(data.status) == 10)
                            request_cnt++;
                        else if(parseInt(data.status) == 0)
                            confirm_cnt++;
                        else if(parseInt(data.status) == 2)
                            finish_cnt++;
                    }

                    var brow = body.insertRow();
//                    brow.style.backgroundColor = finish_cnt == totalmaxcount || getDDay(myuser.endtime) < 0 ? "#222" : "#666";
                    brow.style.textAlign = "center";
                    brow.style.height = "auto";
                    if(cnt == couponlist.length){
                        brow.style.borderRadius = "10px 0px 0px 10px";
                    }
                    if( finish_cnt == totalmaxcount || getDDay(myuser.endtime) < 0){
                        brow.style.backgroundColor = "#222";
                    }else {
                        brow.style.backgroundColor = "#ff000022";
                        
                    }
                    // 인덱스
                    var bcell_index = brow.insertCell();
                    bcell_index.innerHTML = "<text style='font-size:12px;color:white;'>"+cnt+"</text>";
                    bcell_index.style.minWidth = "35px";

                    // 결제일 (등록일)       couponid
                    var bcell_id = brow.insertCell();
                    var mmonth =  stringGetMonth(couponid);
                    var mday = stringGetDay(couponid);
                    bcell_id.innerHTML = couponid;
                    bcell_id.innerHTML = "<text style='font-size:12px;color:white;'>"+mmonth+"-"+mday+"</text>";
                    bcell_id.style.minWidth = "80px";
                    
//                    // 기간      
//                    var bcell_startendtime = brow.insertCell();
//                    bcell_startendtime.innerHTML = "<text style='margin-top:18px;font-size:12px'>"+myuser.starttime.substr(0,10)+" ~ "+myuser.endtime.substr(0,10)+"</text>";
//                    bcell_startendtime.style.minWidth = "200px";

                    // 등록횟수       
                    var bcell_total = brow.insertCell();
                    bcell_total.innerHTML = freecount > 0 ? "<text style='color:white;font-size:12px'>[F]"+freecount+"+"+maxcount+"</text>" : "<text style='color:white;font-size:12px'>"+maxcount+"</text>";
                    bcell_total.style.minWidth = "40px";

                    //PT완료/고객승인/운동신청
                    var bcell_finish = brow.insertCell();
                    bcell_finish.innerHTML = "<text style='color:white;font-size:12px'>"+finish_cnt+" / "+confirm_cnt+" / "+request_cnt+"</text>";
                    bcell_finish.style.minWidth = "100px";

                    //목록보기 버튼
                    var bcell_confirm = brow.insertCell();
                    var str_rows = setJSONStringToParamString(ptlist);
                    bcell_confirm.style.minWidth = "73px";
               
                    bcell_confirm.innerHTML = "<button style='font-size:11px;color:@191919;background-color:"+mColor.YELLOW+";border-radius:5px;border:0px' onclick='showCouponList( \"" + couponid + "\", "+totalmaxcount+", \"" + str_rows + "\")' >보기</button>";

                    
                }
                
                
            }
            
           
            
        } 
        function showCouponTable(rows,maxcount) {
            //날짜순 정렬
            rows.sort(sort_by('date', false, (a) => a.toUpperCase()));
            
            var div_temp_table =document.createElement("div");
            var table = document.createElement('table');                                                      //등록일 = couponid                               
            

            table.innerHTML = "<thead><tr style='background-color:#1e1e1e;color:white;font-size:13px;height:30px;'>"+
                "<th><text style='font-weight:300;font-size:12px;'>횟수</text></th>"+
                "<th><text style='font-weight:300;font-size:12px;'>운동날짜</text></th>"+
                "<th><text style='font-weight:300;font-size:12px;'>시간</text></th>"+
                "<th><text style='font-weight:300;font-size:12px;'>상태값</text></th>"+
                "<th><text style='font-weight:300;font-size:12px;'>설명</text></th>"+
                "<th><text style='font-weight:300;font-size:12px;'>삭제</text></th>"+
                "</tr></thead><tfoot></tfoot><tbody></tbody>";
            table.width="100%";        
            table.cellspacing="0";
            table.border = "0px";
            table.style.textAlign="center";
            table.style.backgroundColor = "#191919";
//            table.className="table table-bordered";
           
            table.style.height = "25px";

            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];
            var len = rows.length;
          
            div_temp_table.append(table);
            var newmaxcnt = maxcount > len ? maxcount : len;
            if (newmaxcnt > 0) {
                for (var i = 0; i < newmaxcnt; i++) {

                    var data = rows[i];
                    var brow = body.insertRow();
                   
                    brow.style.height = "30px";
                     if(i < len){
                        // 인덱스
                        var bgcolor = mColor.C333333;
                        var txt_status = "PT종료";
                        if(data.status == 10){
                            txt_status = "PT요청중";  
                            bgcolor = "#33aaaa44";
                        } 
                        else if(data.status == 0){
                             bgcolor = "#8977ad44";
                            txt_status = "고객확인됨";
                        } 
                        brow.style.color = "white";
                        brow.style.backgroundColor=bgcolor; 
                         
                        var bcell_index = brow.insertCell();
                        bcell_index.innerHTML = "<text style='font-size:11px;color:white;font-weight:300'>"+(i+1)+"</text>";
                        bcell_index.style.maxWidth="30px";

                        // 운동날짜       
                        var bcell_id = brow.insertCell();
                        bcell_id.innerHTML = "<text style='font-size:11px;font-weight:300'>"+data.date+"</text>";

                        // 운동시간 
                        var bcell_id = brow.insertCell();
                        bcell_id.innerHTML = "<text style='font-size:11px;font-weight:300'>"+data.hour+"시</text>";

                        // 상태값       
                        var bcell_num = brow.insertCell();
                        bcell_num.innerHTML = "<text style='font-size:11px;font-weight:300'>"+txt_status+"</text>";

                        // 설명
                        var bcell_pass = brow.insertCell();
                        bcell_pass.innerHTML = "<text style='font-size:11px;font-weight:300'>"+data.note+"</text>";
                        
                         
                         
                        var cdatetime = data.date+" "+":"+data.hour+":00:00";   
                        var clickid = ""+cdatetime+"|0|"+data.uid+"|ready"; 
                         
                        // 삭제                        
                        var bcell_delete = brow.insertCell();
                        bcell_delete.innerHTML =  "<button style='font-size:10px' onclick='remove_user_reservation(\"" + clickid + "\","+data.status+",\""+data.couponid+"\")'>삭제</button>";
                            
                        
                        
                     }else {
                        bgcolor = mColor.C191919;
                      
                         // 인덱스
                        var bcell_index = brow.insertCell();
                        bcell_index.innerHTML = "<text style='font-size:11px;color:white;font-weight:300'>"+(i+1)+"</text>";
                        bcell_index.style.maxWidth="30px";
                        
                        // 운동날짜       
                        var bcell_id = brow.insertCell();
                        bcell_id.innerHTML = "";

                        // 운동시간       
                        var bcell_id = brow.insertCell();
                        bcell_id.innerHTML = "";

                        
                        // 상태값       
                        var bcell_num = brow.insertCell();
                        bcell_num.innerHTML = "";


                        // 설명
                        var bcell_pass = brow.insertCell();
                        bcell_pass.innerHTML = "";
                        
                         // 삭제
                        var bcell_delete = brow.insertCell();
                        bcell_delete.innerHTML = "";
                     }
                }
            }


            return div_temp_table.innerHTML;

        }
        
        function showCouponList(couponid,maxcount,str_rows){
            var rows = JSON.parse(str_rows);
            
            clog("rows ",rows);
            var title = "["+couponid.substr(0,10)+"] 등록횟수 : "+maxcount+"회";
            var message_tag = showCouponTable(rows,maxcount);
            
            var style = {
                bodycolor: mColor.C191919,
//                size: {
//                    width: "100%",
//                    height: "100%"
//                }
            };

            showModalDialog(document.body, title, message_tag, "닫기", null, function() {
                hideModalDialog();                
            }, null, style);
        }
        var select_useruid = "";
        function onselect_myusernew(res){
            var dvalue = res.value;
            var dtext = res.text;
            var uid = dvalue != "0" && dvalue != "" ? dvalue : "";
            var username = dtext;
            if(uid){
                select_useruid = uid;
                reload_calendar_page();
            }else {
                select_useruid = "";
                reload_calendar_page();
            }
//            label_title.innerHTML = username+" 예약표";
        }

       
        
        function set_title(title) {
            document.title = title;
            //        reservation_title.innerHTML = title;
        }

        function initReservation(json) {

             var data = {
                type: "reservationinfo",
                orneruid : orneruid,
                teacheruid:param_teacheruid,
                teacherid:param_teacherid,
                centercode: json.centercode
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    if (res.message == "") {
                        show_error_popup("ERROR", "목록이 없습니다.", "exit");
                        return;
                    }
                    
                    var json_array = JSON.parse(res.message);
                    reservationinfo = json_array[0];
                    
                }
            });
        }
        
        function setCourseReservation(jsonobj) {
            //        reservationinfo = jsonobj;
            //select 
            var teach_name = document.getElementById("teach_name");
//            var teach_maxnumber = document.getElementById("teach_maxnumber");
            var teach_times = document.getElementById("teach_times");
            //checkboxs
            var teach_select_times = document.getElementById("teach_select_times");
            //date start end 
            var teach_date = document.getElementById("teach_date");


            var reservation_title = document.getElementById("reservation_title");

//            var teacher_type = jsonobj.type == "PT" ? "트레이너" : "강사";
//            document.getElementById("teacher_reservation_title").innerHTML = jsonobj.type + " " + teacher_type + " 예약화면";

            ///////////////////////////////////////////////////////
            //강좌종류
            ///////////////////////////////////////////////////////

            var class_len = jsonobj.classes.length;
//            if (class_len == 1) {
//                var obj = jsonobj.classes[0];
//                //다음 수강이 열렸는지 체크한다.
//                var isnextopen = obj.next_openid > obj.openid ?  true :false; 
//                
//                teach_name.innerHTML = isnextopen ? "<option value='" + obj.id + "'>" + obj.name + "</option>" : "<option style='color:#ee2222'>" + obj.name + "(열려있지 않음)</option>";
//
//                teach_datas.style.display = "block";
//
//                
//                if(!isnextopen){
//                    teach_datas.style.display = "none";
//                    return;
//                }
//
//                
//                ///////////////////////////////////////////////////////
//                //최대 정원
//                ///////////////////////////////////////////////////////
//                var max_people = parseInt(jsonobj.classes[0].max);
//                teach_maxnumber.innerHTML = "";
//                if (max_people == 1) {
//                    teach_maxnumber.innerHTML = "<option value='" + max_people + "'>" + max_people + " 명</option>";
//                } else if (max_people > 1) {
//                    for (var i = 0; i < max_people; i++) {
//                        teach_maxnumber.innerHTML += "<option value='" + (i + 1) + "'>" + (i + 1) + " 명</option>";
//                    }
//                    teach_maxnumber.selectedIndex = max_people-1;;
//                    var text = teach_times.options[teach_times.selectedIndex].text;
//                }
//
//            } else if (class_len > 1) 
            
            {
                teach_name.innerHTML = "<option value='-1'>강좌 종류를 선택하세요</option>";
                for (var i = 0; i < class_len; i++) {
                    var obj = jsonobj.classes[i];
                    var isnextopen = obj.next_openid > obj.openid ?  true :false; 
                
                    teach_name.innerHTML += isnextopen ? "<option value='" + obj.id + "'>" + obj.name + "</option>" : "<option value='-1' style='color:#ee2222'>" + obj.name + "(열려있지 않음)</option>";
                }
            }



            ///////////////////////////////////////////////////////
            //시간대 
            ///////////////////////////////////////////////////////        
            var opentime_len = jsonobj.opentimes.length;
            teach_times.innerHTML = "<option >예약시간을 선택하세요</option>";
            for (var i = 0; i < opentime_len; i++) {
                var time = parseInt(jsonobj.opentimes[i]);
                if(isOpenTime(time))
                    teach_times.innerHTML += "<option value='" + time + "'>" + time + "시</option>";
            }

        }
        var default_open_starttime = "";
        var default_open_endtime = "";
        var teach_max_people = 1;
        function teachNameClick() {
            
            var teach_name_value = document.getElementById("teach_name").value;
            var teach_datas = document.getElementById("teach_datas");
//            var teach_maxnumber = document.getElementById("teach_maxnumber");
            var teach_times = document.getElementById("teach_times");
            
            var teach_name_selectedindex = -1;
            
            for(var i = 0 ; i < reservationinfo.classes.length; i++){
                if(teach_name_value == reservationinfo.classes[i].id){
                    teach_name_selectedindex = i;
                    break;
                }
            }
            if(teach_name_selectedindex == -1){
                teach_datas.style.display = "none";
                return;
            }
            var obj = reservationinfo.classes[teach_name_selectedindex];
            var isnextopen = obj.next_openid > obj.openid ?  true :false; 
            
            
            var value = teach_name_value >= 0 ? teach_name_value : -1;
            if (value == -1) {
                teach_datas.style.display = "none";
            } else {
                teach_datas.style.display = "block";
                
                if(!isnextopen){
                    teach_datas.style.display = "none";
                    return;
                }
                
                ///////////////////////////////////////////////////////
                //최대 정원
                ///////////////////////////////////////////////////////
                teach_max_people = parseInt(reservationinfo.classes[teach_name_selectedindex].max);
//                teach_maxnumber.innerHTML = "";
//                if (max_people == 1) {
//                    teach_maxnumber.innerHTML = "<option value='" + max_people + "'>" + max_people + " 명</option>";
//                    
//                } else if (max_people > 1) {
//                    for (var i = 0; i < max_people; i++) {
//                        teach_maxnumber.innerHTML += "<option value='" + (i + 1) + "'>" + (i + 1) + " 명</option>";
//                    }
//                    teach_maxnumber.selectedIndex = max_people-1;;
//                }
                
                
                default_open_starttime = obj.next_starttime;
                default_open_endtime = obj.next_endtime;
                document.getElementById("teach_startdate").value = default_open_starttime;
                document.getElementById("teach_enddate").value = default_open_endtime;
            }
        }

        function teachMaxNumberClick() {

        }

        function teachTimeClick() {
            var teach_times = document.getElementById("teach_times");
            var teach_select_times = document.getElementById("teach_select_times");
            var text = teach_times.options[teach_times.selectedIndex].text;

            var isin = false;
            for (var i = 0; i < teach_select_times.children.length; i++) {
                if (teach_select_times.children[i].id == teach_times.value) {
                    isin = true;
                    break;
                }
            }
            if (!isin)
                teach_select_times.innerHTML += "<text align='center' onclick='removeTeachTime(" + teach_times.value + ")'  style='float:left;text-align:left;font-weight:bold;border-radius:5px;background:"+mColor.YELLOW+";color:"+mColor.C111111+";max-height:36px;font-size:12px;padding:8px;margin:3px;min-width:58px;max-width:58px;' id='" + teach_times.value + "'>" + text + "<img src='./img/button_x_gray.png' style='width:9px;height:9px;float:right;margin-top:5px;margin-right:-2px'/></text>";
            
            
            //단순 배경높이 계산
            var bottomheight = teach_select_times.children.length > 0 ? 20 : 0;
            teach_select_times.style.height = (parseInt((teach_select_times.children.length-1)/4)+1)*39+bottomheight;

            //        var ps = document.querySelectorAll( "#teach_select_times label" );
            //        var sortedPs = Array.from( ps ).sort( (a, b) => a.id.localeCompare( b.id ) ); //sort the ps
            //        document.querySelector( "#teach_select_times" ).innerHTML = sortedPs.map( s => s.outerHTML ).join("");                         
            sortListIntType(teach_select_times, false);
        }

        function removeTeachTime(time) {
            var teach_select_times = document.getElementById("teach_select_times");
            //        teach_select_times.style.visibility = teach_select_times.children.length > 0 ? "block" : "none";
            for (var i = 0; i < teach_select_times.children.length; i++) {

                if (teach_select_times.children[i].id == time) {
                    teach_select_times.removeChild(teach_select_times.children[i]);

                    break;
                }
            }
        }



        function open_sheet() {
            var style = {
                bodycolor: "#eeeeff",
                size: {
                    width: "100%",
                    height: "100%"
                }
            };
            var body = "<div id='div_teach_reservation' style='background-color:#222222;padding-left:20px;padding-right:20px'>"+
                           
                                
                                "<text style='float:left;font-size:15px;color:"+mColor.Cafafaf+"'>강좌종류</text>"+
                                "<select id='teach_name' onchange='teachNameClick()' style='margin-top:10px;width:100%;color:white;background-color:#111111;border-radius:8px;padding-left:10px;padding-right:10px;padding-top:8px;padding-bottom:8px;border:1px solid #292929'></select>"+
                                "<br>"+
                                "<div id='teach_datas' style='display:none'>"+
                                    "<br>"+
                                    "<text style='float:left;font-size:15px;color:"+mColor.Cafafaf+"'>오픈시간</text>"+                    
                                    "<select id='teach_times' onchange='teachTimeClick()' style='margin-top:10px;width:100%;color:white;background-color:#111111;border-radius:8px;padding-left:10px;padding-right:10px;padding-top:8px;padding-bottom:8px;border:1px solid #292929'></select>"+
                                    "<br>"+
                                    "<div id='teach_select_times' style='background-color:#111111;padding-left:10px;border:1px solid #292929;border-radius:8px;margin-top:5px;padding-right:10px;padding-top:8px;padding-bottom:8px;height:auto'>"+
                                        
                                    "</div>"+
                                    "<br>"+
                                    
                                    "<div id='teach_date' style='height:70px'>"+
                                        "<text style='float:left;font-size:15px;color:"+mColor.Cafafaf+"'>오픈기간</text>"+
                                        "<br>"+
                                        "<div style='margin-top:10px;'>"+
                                            "<input onchange='teachdate_onchange(1)' id='teach_startdate' type='date' value='' style='color-scheme: dark;float:left;background-color:#111111;color:white;font-size:12px;border-radius:6px;padding:6px;border:1px solid #292929'/>&nbsp;~&nbsp;"+
                                            "<input onchange='teachdate_onchange(2)' id='teach_enddate' type='date' value='' style='color-scheme: dark;float:right;background-color:#111111;color:white;font-size:12px;border-radius:6px;padding:6px;border:1px solid #292929'/>"+
                                        "</div>"+
                                    "</div>"+                                   
                                "</div>"+
                            
                        "</div>";
            
            showModalDialog(document.body, "전체 일정 오픈하기", body, "전체일정오픈", "취소", function() {

                sendTeacherReservation();
//                hideModalDialog();
                
            }, function() {
                hideModalDialog();
            }, style);

            setCourseReservation(reservationinfo);

            //        var div_teach_reservation = document.getElementById("div_teach_reservation");
            //        var btn_teach_reservation = document.getElementById("btn_teach_reservation");
            //        if(div_teach_reservation.style.display == "block"){
            //            div_teach_reservation.style.display="none";
            //            btn_teach_reservation.innerHTML = "▼ 일정오픈하기";
            //        }else {
            //            div_teach_reservation.style.display="block";   
            //            btn_teach_reservation.innerHTML = "▲ 일정오픈접기";
            //        }

        }

        function sendTeacherReservation() {
            var select_teach = document.getElementById("teach_name");
            var teach_id = parseInt(select_teach.value);
            var teach_name = select_teach.options[select_teach.selectedIndex].text;
           
//            var teach_maxnumber = document.getElementById("teach_maxnumber").value;
//            var teach_times = document.getElementById("teach_times");
            var teach_select_times = document.getElementById("teach_select_times");
            var times = [];
            for (var i = 0; i < teach_select_times.children.length; i++) 
                times.push(parseInt(teach_select_times.children[i].id));
            var startdate = document.getElementById("teach_startdate").value;
            var enddate = document.getElementById("teach_enddate").value;
            var day = get_Day(startdate , enddate);
            var value_dates = [];
        
            
            if(times.length == 0 || day > 30){
                if(times.length == 0)
                    alertMsg("오픈시간대를 1개이상 선택해주세요.");
                else if(day > 30)
                    alertMsg("오픈시작일부터 최대 30일까지 오픈할 수 있습니다.");
                return;
            }
               
            for(var i = 0 ; i <= day; i++){
                
                var default_data = {"date": "","times":[]};
                var mdate = nextDay(startdate, i);
                for(var j = 0; j < times.length; j++){
                    var default_time = {"time":-1, "members":[]};
                    default_data.date = mdate;
                    default_time.time = times[j];
                    default_data.times.push(default_time);
                }
                value_dates.push(default_data);
            }
            
            
            var value = {};
            for(var i = 0 ; i < reservationinfo.classes.length; i++){
                if(reservationinfo.classes[i].id == teach_id){
                    value.openid = reservationinfo.classes[i].openid;        
                    break;
                }
            }
            value.mbstype = reservationinfo.type;
            value.teachid = teach_id;
            value.max = teach_max_people;
            value.teachname = teach_name;
            value.dates = value_dates;
            //value를 만들어서 서버에 보내야한다.

//           
//            var data = {
//                type: "sendteacherreservation",
//                orneruid : orneruid,
//                teacheruid:param_teacheruid,
//                teacherid:param_teacherid,
//                centercode : calendar_data.centercode,
//                
//                value: JSON.stringify(value)
//            };
//            CallHandler("my_teacher_reservation", data, function(res) {
//                var code = parseInt(res.code);
//
////                var param = "?centercode="+calendar_data.centercode;
//                    
//                if (code == 100) {
////                    refresh_page(param);
//                    reload_calendar_page(calendar_data.centercode);
//                }else{
//                    alertMsg(res.message);
////                    refresh_page(param);
//                    reload_calendar_page(calendar_data.centercode);
//                }
//                 hideModalDialog();
//            },function(err){
//                 hideModalDialog();
//            });
        }

        
        function mergeAllData_remove(removeuser){
            var cdata = calendar_data[removeuser.opentype];
            var select_idx = -1;
            var idx_opentype = -1;
            var idx_date = -1;
            var idx_time = -1; 
            var idx_member = -1;
            var rflg = false;
            for(var i = 0 ; i < cdata.length; i++){
                if(cdata[i].teachid == removeuser.teachid){
                    for(var j =0; j < cdata[i].dates.length; j++){
                        var date = cdata[i].dates[j];
                        if(date.date == removeuser.date){
                            for(var k = 0 ; k < date.times.length; k++){
                                var time = date.times[k];
                                if(time.time == removeuser.time){
                                    for(var l = 0; l < time.members.length; l++){
                                        var user = time.members[l];
                                        if(user == removeuser.user){
                                            
                                            idx_opentype = i;
                                            idx_date = j;
                                            idx_time = k;
                                            idx_member = l;
                                            calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members.splice(idx_member,1);
                                            
                                            for(var a =0 ; a < mem_teacher_alldata.length; a++){
                                                if(mem_teacher_alldata[a].centercode == calendar_data.centercode){
                                                    mem_teacher_alldata[a] = calendar_data;
                                                    break;
                                                } 
                                            }
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                            break;
                        }
                    }
                    break;
                }
            }

        }
//        function mergeAllData_time_update(type,rdate,rtime){
//            
//            var types = ["open","close","ready"];  //현재 open 은 빈값으로 사용하지 않음
//            for(var a = 0 ; a < types.length; a++){
//                var cdata = calendar_data[types[a]];
//                for(var i = 0 ; i < cdata.length; i++){
//                        for(var j =0; j < cdata[i].dates.length; j++){
//                            var date = cdata[i].dates[j];
//                            if(date.date == rdate){
//                                for(var k = 0 ; k < date.times.length; k++){
//                                    var time = date.times[k];
//                                    if(time.time == rtime){
//                                        if(type == "removeteachtime")calendar_data[types[a]][i].dates[j].times.splice(k,1);
//                                        else calendar_data[types[a]][i].dates[j].times.push({time:rtime,members:[]});
//                                        break;
//                                    }
//                                }
//                                break;
//                            }
//                        }
//                        break;
//                    
//                }
//            }
//            
//            for(var a =0 ; a < mem_teacher_alldata.length; a++){
//                if(mem_teacher_alldata[a].centercode == calendar_data.centercode){
//                    mem_teacher_alldata[a] = calendar_data;
//                } 
//            }
//        }
        
        function teachdate_onchange(type){
            teach_startdate = document.getElementById("teach_startdate");
            teach_enddate = document.getElementById("teach_enddate");
            
            if(teach_startdate.value && teach_enddate.value){
                var isover = get_Day(teach_startdate.value,teach_enddate.value);

                if(isover < 0){
                    alertMsg("종료일이 시작일보다 작습니다. 다시 선택하세요.");
                    teach_enddate.value = "";                        
                }
            }
            if(!default_open_starttime || !default_open_endtime)return;
            if(type == 1){ //시작일 change
                if(get_Day(teach_startdate.value, default_open_starttime) > 0 || get_Day(teach_startdate.value, default_open_endtime) < 0){
                    alertMsg("오픈되어있는 날짜범위 안에서 선택하여 주세요.\n 오픈시작일 : "+default_open_starttime+" 오픈종료일 : "+default_open_endtime);
                    teach_startdate.value = default_open_starttime;
                }
            }else { //종료일 change
                if(get_Day(teach_enddate.value, default_open_endtime) < 0 || get_Day(teach_enddate.value, default_open_starttime) > 0){
                    alertMsg("오픈되어있는 날짜범위 안에서 선택하여 주세요.\n 오픈시작일 : "+default_open_starttime+" 오픈종료일 : "+default_open_endtime);
                    teach_enddate.value = default_open_endtime;
                }            
            }
        }
        function time_note_change(info,status,couponid,isfreepttxt){
            
           
            var obj = info.split('|');  //getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+event.user.uid+"|"+event.opentype;
            var checkhour = stringGetHour(obj[0]);
            var userobj = findValueinArray(userinfos,"uid",obj[2],couponid);
            var noteid = "timenote_"+info;
//            clog('noteid '+noteid);
            var timenote = isfreepttxt+""+document.getElementById(noteid).value;
            
            //운동완료상태
//            if(status == 2)
            {
                var message = "<br>"+userobj.name+" 님 "+checkhour+"시 코멘트를 수정하시겠습니까?<br><br>";

                showModalDialog(document.body, checkhour+"시 코멘트 수정", message, "코멘트수정", "취소", function() {
                    
                    update_time_note(info,obj[0],obj[1],obj[2],obj[3],status,timenote,couponid);
                }, function() {
                   hideModalDialog();
                });
            }
           
        }
        function remove_user_reservation(info,status,couponid){
            
            var obj = info.split('|');  //getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+event.user.uid+"|"+event.opentype;
            
            var userobj = findValueinArray(userinfos,"uid",obj[2],couponid);
            
            //운동예약상태
            if(status == 0){
                
                var today = getToday();
                var todayhour = getTodayHour();
                
                var checkday = getToday(new Date(obj[0]));
                var checkhour = stringGetHour(obj[0]);
                
                
//                alertMsg("시간 : .."+today+" "+todayhour+"  : "+checkday+" "+checkhour+" dday "+get_Day(today, checkday));//test
                
                //real  neel_test
                var finishtag =  isNowTimeOver(obj[0]) <= 0 ? "<option style='background-color:"+mColor.C191919+";color:white;font-size:17px;'  value='2'>P.T종료</option>" : ""; //운동종료 시간이 되어야 PT종료 목록이 보인다.
                //test
//                var finishtag =  "<option style='background-color:"+mColor.C191919+";color:white;font-size:17px;'  value='2'>P.T종료</option>"//test //20210907_neel
                
                var selecttag = "<select id='teacher_reservation_status' class='form-control' style='background-color:#00000000;border:2px solid "+mColor.C292929+" ;border-radius: 6px;font-size:12px;color:white' >"+
                                    "<option style='background-color:"+mColor.C191919+";color:white;font-size:17px;' value=''>상태값을 선택하세요</option>"+
                                    finishtag+
                                    "<option style='background-color:"+mColor.C191919+";color:white;font-size:17px;' value='4'>P.T지우기 (횟수차감없음)</option>"+                                
                                "</select><br>"+            
                                "<text style='float:left;font-size:12px;color:#ffa025;margin-bottom:4px'>내용입력</text><input id='id_finish_note' class='form-control' name='edittext_other' placeholder='기타 특이사항 입력란..' style='font-size:12px;color:white;border:solid 0px;background-color:#62393233;'/>";
                
                var message = "<div style='padding-left:10px;padding-right:10px'><text style='float:left;font-size:12px;color:#ffa025;'>※"+userobj.name+" 고객 상태값 변경</text><br>"+selecttag+"</div>";
                
//                var day = get_Day("2021-08-10 18:00:00", obj[0]);
                
//                if( get_Day("2021-08-10 18:00:00", obj[0]) > 0)
//                    alertMsg("시간이 안지났다.."+getDDay(obj[0])+" "+obj[0]+" "+getToday());
//                else 
//                    alertMsg("시간이 안지났다.."+getDDay(obj[0])+" "+obj[0]+" "+getToday());
                showModalDialog(document.body, "상태값 변경", message, "변경하기", "취소", function() {
                    var teacher_reservation_status = document.getElementById("teacher_reservation_status");
                    var id_finish_note = document.getElementById("id_finish_note");
                    
                    
                    if(teacher_reservation_status.value == ''){
                        alertMsg("상태값을 선택하세요.");
                        return;
                    }else if(teacher_reservation_status.value != "4" && getDDay(obj[0]) > 0 || teacher_reservation_status.value != "4" && getDDay(obj[0]) == 0 && parseInt(checkhour) > getTodayHour()){
                        //20210907_neel
                        alertMsg("아직 종료할 수 없습니다.");
                        return;
                    }
                    

                    remove_teach_user(info,obj[0],obj[1],obj[2],obj[3],0,parseInt(teacher_reservation_status.value),id_finish_note.value,couponid);
                }, function() {
                   hideModalDialog();
                });
    
            }
            //XXX 지금은 사용하지 않음
            //운동완료상태 승인요청 다시하기
            else if(status == 1){
                 //XXX 지금은 사용하지 않음
                 //XXX 지금은 사용하지 않음
                 //XXX 지금은 사용하지 않음
                 //XXX 지금은 사용하지 않음
                
                var message = "<br><span style='color:"+mColor.WHITE+";'>"+userobj.name+"</span>님에게 승인요청<br>푸시를 보내시겠습니까?<br><br>";
                
//                var messag = "<label for='id_finish_note' class='textevent'>"+userobj.name+" 님에게 승인요청 푸시를 보내시겠습니까?</label>"+
//                            "<div class='form-control' name='subscription_path'>"+
//                                "<div>"+
//                                    "<textarea id='id_finish_note' class='form-control' name='edittext_other' placeholder='기타 특이사항 입력란..' style='height:140px;'></textarea>"+
//                                "</div>"+
//                            "</div>";
                 //XXX 지금은 사용하지 않음
                 //XXX 지금은 사용하지 않음
                 //XXX 지금은 사용하지 않음
                showModalDialog(document.body, "승인요청 다시하기", message, "보내기", "취소", function() {
                    var mtitle = "운동종료";
                    var mmessage = obj[0]+" 운동이 종료되었습니다. 체크후 승인확인 버튼을 눌러주세요.(공지사항에서 확인가능합니다.)";
                    var alert_text = "승인요청 푸시를 보냈습니다. <br>운동시간 종료전에 회원이 승인해야 합니다.<br><br> <text style='color:#f4436d;font-size: 12px;'>※ 주의: 운동종료시간전까지 해당회원이 확인버튼을<br> 누르지 않으면 해당 수업은 자동으로 취소됩니다.</text>";
                    request_confirm_user(info,mtitle,mmessage,true,alert_text);
                }, function() {
                   hideModalDialog();
                });
            }
            //운동예약신청한 상태에서 트레이너가 취소한다.
            else if(status == 10){
                var message = "<br><span style='color:"+mColor.WHITE+";'>"+userobj.name+"</span>님 운동신청건을<br>취소하시겠습니까?<br><br>";

                showModalDialog(document.body, "운동예약요청 취소하기", message, "운동신청취소", "닫기", function() {
                    var mtitle = "운동종료";
                    var mmessage = obj[0]+" 운동 예약신청이 취소되었습니다.";
                    
                    remove_teach_user(info,obj[0],obj[1],obj[2],obj[3],10,status,"",couponid);
                }, function() {
                   hideModalDialog();
                });
            }else if(status == 2){
                var message = "<br><span style='color:"+mColor.WHITE+";'>"+userobj.name+"</span>님 PT종료건을<br>삭제하시겠습니까?<br><br>";

                showModalDialog(document.body, "PT완료건 삭제하기", message, "PT삭제하기", "취소", function() {
                    var mtitle = "PT삭제";
                    var mmessage = obj[0]+" 운동 예약신청이 취소되었습니다.";
                    
                    remove_teach_user(info,obj[0],obj[1],obj[2],obj[3],2,status,"",couponid);
                }, function() {
                   hideModalDialog();
                });
            }
                        
            
            //월 달력으로 이동한다.테스트
//            window.options.mode = "month";
//            clog("window.defaults ",window.defaults);
//            clog("window.options ",window.options);
//            window.calendar(window.el,window.options);
        }
        //승인요청 푸시 보내기
        function request_confirm_user(info,mtitle,mmessage,isshow,alert_text){
            var obj = info.split('|');
            //담당트레이너 설정하기
                get_token_user(obj[2],function(res){
                     var token = res.message;
                     if(res.code == 100){
                         //트레이너 설정 성공하면 담당트레이너에게 푸시메세지 보내기
                         //pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_GOTO_PTGX_RESERVATION,function(res){
                         pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_NOTICE,function(res){
                            if (res.code == 100) {
                                //푸시메세지를 보냈으면 성공팝업띄우고 종료
                                if(isshow)
                                 alertMsg("<br>"+alert_text+"<br>",function(){
                                    hideModalDialog();
                                    hideModalDialog();    
//                                     var day = new Date(obj[0]);
//                                    refresh_page("?centercode="+param_centercode+"&day="+day);
                                     reload_calendar_page();
                                 });
                                 
                               
                            } else {
                                alertMsg(res.message);
                            }
                        },function(err){
                            alertMsg("네트워크 에러 ",err);
                        }); 
                     }else{
                         alertMsg(res.message);
                     }
                     
                    
                },function(err){
                    alertMsg(err,function(){
                        hideModalDialog();
                        hideModalDialog();
                    });
                });
        }
        function update_time_note(info,_date ,_teachid,_user,_opentype,status,finish_note,couponid){
         var obj = info.split('|');
            var timeuser = {};
            timeuser.uid = _user;
            var date = new Date(_date);
            var hh = date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
            timeuser.date = getToday(date);
            timeuser.time = parseInt(hh);
            timeuser.teachid = _teachid;
            timeuser.opentype = _opentype; 
            timeuser.user = _user;
            timeuser.mbstype = reservationinfo.type;
            timeuser.status = status;
            timeuser.note = finish_note;
            timeuser.couponid = couponid;
            

//           var data = {
//                type: "updatetimenote",
//                orneruid : orneruid,
//                teacheruid:param_teacheruid,
//                teacherid:param_teacherid,
//                centercode: calendar_data.centercode,
//                value:{"date":timeuser.date,"time":timeuser.time,"uid":timeuser.uid,"couponid":timeuser.couponid,"note":timeuser.note,"status":timeuser.status,"mbstype":timeuser.mbstype}
//                
//            }
//            CallHandler("my_teacher_reservation", data, function(res) {
//                var code = parseInt(res.code);
//
//                if (code == 100) {
//                   var data = res.message;
//                   var mtitle = "운동종료";
//                        var mmessage = obj[0]+" 코멘트가 변경되었습니다. [내용:"+finish_note+"] (공지사항에서 확인가능)";
//                        var alert_text = "코멘트 변경 푸시를 보냈습니다.";
//                        request_confirm_user(info,mtitle,mmessage,true,alert_text);
//                    
////                    hideModalDialog();
//                }else{
//                    
//                   alertMsg(res.message,function(){
//                       hideModalDialog();
//                       //화면을 갱신한다
//                       if(code == -111)
//                           reload_calendar_page();
//                   });
//                }
//                
//            });
        }
        function remove_teach_user(info,_date ,_teachid,_user,_opentype,before_status,status,finish_note,couponid){
             var obj = info.split('|');
            var removeuser = {};
            removeuser.uid = _user;
            var date = new Date(_date);
            var hh = date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
            removeuser.date = getToday(date);
            removeuser.time = parseInt(hh);
            removeuser.teachid = _teachid;
            removeuser.opentype = _opentype; 
            removeuser.user = _user;
            removeuser.mbstype = reservationinfo.type;
            removeuser.status = status;
            removeuser.note = finish_note;
            removeuser.couponid = couponid;
            
//            if(mergeAllData_remove(removeuser)){
//             var data = {
//                type: "removeteachuser",
//                orneruid : orneruid,
//                teacheruid:param_teacheruid,
//                teacherid:param_teacherid,
//                centercode: calendar_data.centercode,
//                value:JSON.stringify(mem_teacher_alldata),
//                removeuser:JSON.stringify(removeuser)
//            }
//            CallHandler("my_teacher_reservation", data, function(res) {
//                var code = parseInt(res.code);
//
//                if (code == 100) {
//                    var data = res.message;
//                    if(status == 4){
//                        alertMsg("<br>횟수 차감없이 삭제하였습니다.<br>",function(){
//                            hideModalDialog();
//                            hideModalDialog();    
////                             var day = new Date(obj[0]);
////                            refresh_page("?centercode="+param_centercode+"&day="+day);
//                            reload_calendar_page();
//                         });
//                    }else if(status == 10){
//                        alertMsg("<br>운동예약 신청건을 취소하였습니다.<br>",function(){
//                            hideModalDialog();
//                            hideModalDialog();    
////                             var day = new Date(obj[0]);
////                            refresh_page("?centercode="+param_centercode+"&day="+day);
//                            reload_calendar_page();
//                         });
//                    }
//                    //관리자가 삭제한다.
//                    else if(before_status == 2 && status == 2){
//                        alertMsg("<br>PT운동종료건을 삭제하였습니다.<br>",function(){
//                            hideModalDialog();
//                            hideModalDialog();    
////                             var day = new Date(obj[0]);
////                            refresh_page("?centercode="+param_centercode+"&day="+day);
//                            reload_calendar_page();
//                         });
//                    }
//                    else {
////                        update_user_result(info,_date,hh,status,data); //화면 색과 버튼을 바꾼다.
////                        update_window_options_data(status,_date ,removeuser.teachid,data); // 윈도우 데이타를 함께 바꾼다.
//                        var mtitle = "운동종료";
//                        var mmessage = obj[0]+" 운동이 종료되었습니다. [내용:"+finish_note+"] (공지사항에서 확인가능)";
//                        var alert_text = "운동종료 푸시를 보냈습니다.";
//                        request_confirm_user(info,mtitle,mmessage,true,alert_text);
//                    }
//                    
////                    hideModalDialog();
//                }else{
//                    
//                   alertMsg(res.message,function(){
//                       hideModalDialog();
//                       //화면을 갱신한다
//                       if(code == -111)
//                           reload_calendar_page();
//                   });
//                }
//                
//            });
        }
        
        //예약되어있는시간 체크하여 배열로 넘겨준다. select box 에서 색깔입히기 위해
        function getINHour(mdate){
            
            
            var arr = [];
            
            for(var i = 0 ; i < alldata.length;i++){
                var date = new Date(alldata[i].start);
                var yy = date.getFullYear();
                var mm = parseInt(date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : ""+date.getMonth();
                var dd = parseInt(date.getDate()) < 10 ? "0"+(date.getDate()) : ""+date.getDate();
                var hh = date.getHours();
                var thisday = yy+"-"+mm+"-"+dd;
               
                if(thisday == mdate){
                    arr.push(hh);
                }
            }
            return arr;
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
        //type : timeover , freept, defaultpt 
//         function insert_user(datetime,type){ 
         function insert_user(_type){ 
             var type = _type == 0 ? "freept" : "defaultpt";
           
             clog("window.options.date "+window.options.date);
            var date = new Date(window.options.date);
            var yy = date.getFullYear();
            var mm = parseInt(date.getMonth()+1) < 10 ? "0"+(date.getMonth()+1) : ""+(date.getMonth()+1);
            var dd = parseInt(date.getDate()) < 10 ? "0"+(date.getDate()) : ""+date.getDate();
            
            var centercode = param_centercode;
//            var obj = info.split('|');
//             clog("date "+window.options.date);
             var thisday = yy+"-"+mm+"-"+dd;
             var tomorrow = nextDay(thisday,1);
             clog(thisday+" tomorrow ",tomorrow);
             if(isNowTimeOver(tomorrow) == -1){
                 alertMsg("이전시간은 예약할 수 없습니다.");
                 return;
             }
             
             var arr_inhours = getINHour(thisday); //array
             var nowdate = new Date();
             
             var starthour = getToday() == thisday ? nowdate.getHours()+1 : 6;
             if(starthour == 24 || starthour < 6)starthour = 6;
             
             clog(starthour+" arr_inhours ",arr_inhours);
             var option_hour_tag = "<option value=''>시간</option>";
             var objs = [];
             for(var i = starthour ; i < 24; i++){
                 var hourtxt = i < 10 ? "0"+i : ""+i;
                 var isin = isInHour(arr_inhours, i);
                 var optionbg = isin ? mColor.C111111 : "#fffd0022";
                 var textcolor = isin ? "#666666" : "white";
                 option_hour_tag += "<option style='background-color:"+optionbg+";color:"+textcolor+"' value = '"+hourtxt+"'>"+hourtxt+"</option>";
                 
                 
                 objs.push({"value":hourtxt,"text":hourtxt,"imgname":"","optionbg":optionbg,"textcolor":textcolor});
             }
//             var strhour = "<select id='select_hour' style='text-align:center;font-size:14px;color:white;width:60px;height:30px;background-color:#333333;border-radius:5px;border:0px'>"+option_hour_tag+"</select>";
             var strhour = C_ComboBoxTag("select_hour","시간",objs,90,0.7,"onSelectHour",-1);
             var option_min_tag = "";
             for(var i = 0 ; i < 12; i++){
                 var min = i*5;
                 var txt_min = min < 10 ? "0"+min : ""+min;
                 option_min_tag += "<option value = '"+txt_min+"'>"+txt_min+"</option>";
             }
             var strmin = "<select id='select_min' style='text-align:center;font-size:14px;color:"+mColor.Cafafaf+";width:60px;background-color:#111111;border-radius:3px;border:1px solid #292929;padding-top:5px;padding-bottom:5px'>"+option_min_tag+"</select>";
             
             
             
             
             var myusers = null;
             for(var i = 0 ; i < mem_teacher_alldata.length; i++)
              if(mem_teacher_alldata[i].centercode == centercode){
                  myusers = mem_teacher_alldata[i].myusers;
                  break;
              }
             clog("myusers ",myusers);
             if(myusers){
                 var users = [];
                 for(var i = 0 ; i < myusers.length ; i++){
                     var user = {"uid":myusers[i].uid,"couponids":[myusers[i].couponid]};
                     var isuser = false;
                     for(var j = 0 ; j  < users.length; j++){
                         if(user.uid == users.uid){
                             user[j].couponids.push(myusers[i].couponid);
                             isuser = true;
                             
                             break;
                         }
                     }
                     if(!isuser){                        
                         users.push(user);                         
                     }
                 }
                 
//                 getMyUsers(users,function(userinfos){
                     var teststr = "";
                    
                    if(newuserinfos){
                        clog("newuserinfos ",newuserinfos);
                        

                        var div = document.createElement("div");
                       
//                        var options = "<option value=''>== 회원을 선택하세요 ==</option>";
                         var objs = [];
                        
                        for (var i = 0; i < newuserinfos.length; i++) {
                            var new_userinfo = newuserinfos[i];
                            var iddate =  (newuserinfos[i].id).substr(0,10);//getToday(new Date(newuserinfos[i].id));
                            var maxcount = getMbsMaxCount(newuserinfos[i]);
                            var freecount  = newuserinfos[i].mbsfreecount ? parseInt(newuserinfos[i].mbsfreecount) : 0;
                           var total_maxcount = freecount > 0 ? maxcount+"+"+freecount : maxcount+"";
                            var usecount = parseInt(newuserinfos[i].usecount);
                            var remaincount = maxcount - parseInt(newuserinfos[i].usecount);
                            
                            var isfree = checkFreePT(newuserinfos[i].mbsprice,newuserinfos[i].mbsname);//무료쿠폰인지 체크
                            //오늘 기준으로 쿠폰 기간이 예약가능한 쿠폰인지 체크한다.
                             //if(getDDay(newuserinfos[i].starttime) <= 0 && getDDay(newuserinfos[i].endtime) >= 0)
                            var date_arr = iddate.split('-');
                            var month = date_arr[1] ? date_arr[1] : ".";
                            var day = date_arr[2] ? date_arr[2] : ".";
                           
                            var txt_str = "";
                            //고객PT시작시간체크한다. 그리고 종료시간만 체크한다.
                            var stime = newuserinfos[i].starttime;//.substr(0,10);
                            var etime = newuserinfos[i].endtime;//.substr(0,10);
                            
                            var sday = get_Day(date,stime);
                            var eday = get_Day(date,etime);
                            var rectimgname = "";

                            //무료PT 이라면
                            if(type == "freept" && isfree && eday >= 0){ 
                                txt_str = newuserinfos[i].name+"("+newuserinfos[i].userid+")&nbsp;"+total_maxcount+"/"+usecount+"회 이용";
                                rectimgname = "./img/icrect_freept.png";
                            }else if(type != "freept" && !isfree){
                                txt_str = "["+month+"/"+day+"]&nbsp;"+newuserinfos[i].name+"("+newuserinfos[i].userid+")&nbsp;"+total_maxcount+"/"+usecount+"회 이용";
                                
                                 //var isremainprice = new_userinfo.remainprice && new_userinfo.remainprice.remain && parseInt(new_userinfo.remainprice.remain) > 0 ? true : false;
                                var isremainprice = isRemain_Price(new_userinfo);
                if(isremainprice) console.log("new_userinfo.remainprice.remain", new_userinfo.remainprice);
                                if(eday < 0){
                                    rectimgname = isremainprice ? "./img/icrect_ptoff_remainprice.png" : "./img/icrect_ptoff.png";
                                }
                                else {
                                    rectimgname =  isremainprice ? "./img/icrect_pton_remainprice.png" : "./img/icrect_pton.png";
                                }
                                
//                                rectimgname =  eday < 0 ? "./img/icrect_ptoff.png" : "./img/icrect_pton.png";
                            }
                            
                            
                            clog(" userinfos[i] ", userinfos[i]);
                            if(txt_str)
                            if(!param_useruid || param_useruid && param_useruid == newuserinfos[i].uid){//예약할때 목록을 선택한 회원만 보여줄건지 전체회원을 보여줄건지
//                                 options += "<option value='"+i+"'>"+txt_str+"</option>";
//                                 options += "<option value='"+i+"' style='font-size:10px;'>"+newuserinfos[i].name+"("+newuserinfos[i].userid+")&nbsp;&nbsp;&nbsp;등록:"+iddate+"&nbsp;["+remaincount+"회남음]</text></option>";
                                if(type == "freept" || type != "freept" && isPayrollUser(my_payroll_users, newuserinfos[i].uid, newuserinfos[i].id))
                                    objs.push({"value":i,"text":txt_str,"imgname":rectimgname});
                            }
                        }
                        var mid = param_teacheruid;
                        
                        
//                        var time_tag = "<div class='radio_select' style='width:100%'>"+
//                                        "<input type='radio' id='select' name='mtime' value='0' checked><label for='select'>0분</label>"+
//                                        "<input type='radio' id='select2' name='mtime' value='5' ><label for='select2'>5분</label>"+
//                                        "<input type='radio' id='select3' name='mtime' value='10' ><label for='select3'>10분</label>"+
//                                        "<input type='radio' id='select4' name='mtime' value='15' ><label for='select4'>15분</label>"+
//                                        "<input type='radio' id='select5' name='mtime' value='20' ><label for='select5'>20분</label>"+
//                                        "<input type='radio' id='select6' name='mtime' value='25' ><label for='select6'>25분</label>"+
//                                        "<input type='radio' id='select7' name='mtime' value='30' ><label for='select7'>30분</label>"+
//                                        "<input type='radio' id='select8' name='mtime' value='35' ><label for='select8'>35분</label>"+
//                                        "<input type='radio' id='select9' name='mtime' value='40' ><label for='select9'>40분</label>"+
//                                        "<input type='radio' id='select10' name='mtime' value='45'><label for='select10'>45분</label>"+
//                                        "<input type='radio' id='select11' name='mtime' value='50'><label for='select11'>50분</label>"+
//                                        "<input type='radio' id='select12' name='mtime' value='55'><label for='select12'>55분</label>"+
//                                    "</div>";
//                        
//                        div.innerHTML += "<text style='float:left;font-size:15px;color:#afafaf;margin-left:13px;'>분을 선택하세요</text><br><br><div style='margin-top:-10px;background-color:#00000000;width:100%;height:auto'>"+time_tag+"</div>";
                        
                        
                        console.log("objs ",objs);
                        div.innerHTML += "<div style='padding:10px;'>"+C_ComboBoxTag("time_select_users","회원을 선택하세요",objs,0,1,"onTimeSelectUserNew",-1)+"</div>";
                        var style = {
                            bodycolor: mColor.C191919,
                            size: {
                                width: "100%",
                                height: "100%"
                            }
                        };
                        // ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+myuid+"|"+event.opentype;
                        if(type == "freept"){
                            var message = "<div style='padding-left:10px;padding-right:10px;'>"+
                                                "<hr style='border: solid 1px #292929'>"+
                                                "<div style='width:100%;'><span style='float:left'><label style='font-size:17px;margin-top:4px'>"+thisday+"일&nbsp;</label></span>"+"<span style='float:left;'>"+strhour+"</span>"+"<text style='font-size:17px;'>시 "+strmin+" 분 예약</text></span>"+
                                                "<hr style='border: solid 1px #292929'>"+
                                                "<text style='font-size:17px;margin:10px;'>"+div.innerHTML+"</text>"+
                                          "</div>";
                            showModalDialog3Button(document.body, "무료PT 예약하기",message,  "예약완료하기", "취소", "무료PT종료",function() { //real                        

//                                var mtime_value = $('input:radio[name="mtime"]:checked').val();
//                                var min = parseInt(mtime_value); 

                                var arg = getCustomComboData("time_select_users");
                                var selected_user_index = arg.value;
                                var text = arg.text;
                                //var isfreept = text.indexOf(TXT_FREEPT_AND_TIMEOUT) >= 0 || text.indexOf(TXT_FREEPT) >= 0 ? true : false;
                                var isfreept = true;

                                
//                                var select_hour = document.getElementById("select_hour");
                                var select_hour = getCustomComboData("select_hour");
                                var select_min = document.getElementById("select_min");
                                var hh = select_hour.value; 
                                var min = parseInt(select_min.value); 
                                
                                if(!selected_user_index){
                                    alertMsg("회원을 선택해 주세요.");
                                    return;
                                }
                                else if(!select_hour.value){
                                    alertMsg("시간을 선택해 주세요.");
                                    return;
                                }
                                var selected_user = newuserinfos[selected_user_index];
                                var mid = param_teacheruid;
                                var mtype = selected_user.mbstype;

                                //새로재정의해서 넘긴다.
                                
                                var clickid = ""+getDateToStr(yy,mm,dd,hh)+"|0|"+selected_user.uid+"|ready";

                                open_time(getDateToStr(yy,mm,dd,hh),function(){
                                    insert_teach_user(0, clickid,getDateToStr(yy,mm,dd,hh),"0",selected_user.uid,"ready",mid,mtype,centercode,selected_user.id,min,isfreept);//selected_user.id  = 쿠폰아이디    
                                });
                                
                            }, function() {
                               hideModalDialog();
                            },function(){
                                showModalDialog(document.body, "무료PT 종료하기 ", "현재 무료PT 쿠폰을 종료처리 하시겠습니까?", "무료PT종료하기", "취소", function() {
                                    var arg = getCustomComboData("time_select_users");
                                    var selected_user_index = arg.value;
                                    var text = arg.text;
                                    
                                  
                                    if(!selected_user_index){
                                        alertMsg("회원을 선택해 주세요.");
                                        return;
                                    }
                                    
                                    var mid = param_teacheruid; //강사 uid
                                    var mname = "<?php echo $username ;?>";  //강사 이름
                                    var selected_user = newuserinfos[selected_user_index];
                                    var user_uid = selected_user.uid;
                                    var couponid = selected_user.id;
                                  
                                    finishFreePT(user_uid,couponid,param_teachername, param_teacheruid);
                                }, function() {
                                   hideModalDialog();
                                });
                            },style);
                        }else{
//                            var message = "<div style='padding-left:10px;padding-right:10px'><hr style='border: solid 1px #292929'><text style='font-size:17px;margin:10px;'>"+thisday+"일 "+strhour+" 시 "+strmin+" 분 예약</text><hr style='border: solid 1px #292929'>"+div.innerHTML+"<br></div>";
                            
                            var message = "<div style='padding-left:10px;padding-right:10px;'>"+
                                                "<hr style='border: solid 1px #292929'>"+
                                                "<div style='width:100%;'><span style='float:left'><label style='font-size:17px;margin-top:4px'>"+thisday+"일&nbsp;</label></span>"+"<span style='float:left;'>"+strhour+"</span>"+"<text style='font-size:17px;'>시 "+strmin+" 분 예약</text></span>"+
                                                "<hr style='border: solid 1px #292929'>"+
                                                "<text style='font-size:17px;margin:10px;'>"+div.innerHTML+"</text>"+
                                          "</div>";
                            showModalDialog(document.body, "유료PT 예약하기",message, "예약하기", "취소", function() { //real                        
    //                        showModalDialog(document.body, "예약하기",teststr, "예약하기", "취소", function() {//test

                                
//                                 var mtime_value = $('input:radio[name="mtime"]:checked').val();
//                                var min = parseInt(mtime_value); 

//                                var select_hour = document.getElementById("select_hour");
                                var select_hour = getCustomComboData("select_hour");
                                var select_min = document.getElementById("select_min");
                                var hh = select_hour.value; 
                                var min = parseInt(select_min.value); 
                                
                                var arg = getCustomComboData("time_select_users");
                                var selected_user_index = arg.value;
                                var text = arg.text;
                                clog("select_hour.value "+select_hour.value);
                                //var isfreept = text.indexOf(TXT_FREEPT_AND_TIMEOUT) >= 0 || text.indexOf(TXT_FREEPT) >= 0 ? true : false;
                                var isfreept = false;
                                if(!selected_user_index){
                                    alertMsg("회원을 선택해 주세요.");
                                    return;
                                }
                                else if(!select_hour.value){
                                    alertMsg("시간을 선택해 주세요.");
                                    return;
                                }
                                var selected_user = newuserinfos[selected_user_index];
                                var mid = param_teacheruid;
                                var mtype = selected_user.mbstype;

                                //새로재정의해서 넘긴다.
                                var clickid = ""+getDateToStr(yy,mm,dd,hh)+"|0|"+selected_user.uid+"|ready";
                                open_time(getDateToStr(yy,mm,dd,hh),function(){
                                    insert_teach_user(10, clickid,getDateToStr(yy,mm,dd,hh),"0",selected_user.uid,"ready",mid,mtype,centercode,selected_user.id,min,isfreept);//selected_user.id  = 쿠폰아이디
                                });
                            }, function() {
                               hideModalDialog();
                            });
                        }
                        
                    } 
//                 });
               
             }
             
            
            
            
            //월 달력으로 이동한다.테스트
//            window.options.mode = "month";
//            clog("window.defaults ",window.defaults);
//            clog("window.options ",window.options);
//            window.calendar(window.el,window.options);
        }
         function finishFreePT(user_uid,couponid,teachername, teacher_uid){
            var orner_status_value = 3;
            //담당트레이너 설정하기
            
                var groupcode = "<?php echo $groupcode;?>";
                setPTTraner(user_uid,couponid,teachername, teacher_uid,orner_status_value,teacher_uid,teachername,groupcode,param_centercode,function(res){
                     var token = res.message;
                     if(res.code == 100){
                        
                         
                         alertMsg("무료PT쿠폰을 종료처리 하였습니다.",function(){
                             reload_calendar_page(param_centercode);
                         });
                      
                     }else{
                         alertMsg(res.message);
                     }
                     
                    
                },function(err){
                    hideModalDialog();
                });
        }
        function onSelectHour(res){
//            clog("res ",res);
        }
         function onTimeSelectUserNew(res){
            var text = res.text;
          
            if(text.indexOf(TXT_FREEPT_AND_TIMEOUT) >= 0){
                
                alertMsg("기간이 종료된 무료PT 입니다.");
            }else if(text.indexOf(TXT_TIMEOUT) >= 0){
                
                alertMsg("기간이 종료된 쿠폰입니다.");
            }else if(text.indexOf(TXT_FREEPT) >= 0){
                
                alertMsg("무료PT 쿠폰입니다.");
            }
        }

        
        //서버에서 나의 현재 고객들정보를 가져온다. callback res.message = userinfos
        function getMyUsers(users,callback){
//            var users = getUsers(json);
            var data = {
                type: "getmyusers",
                orneruid : orneruid,
                teacheruid:param_teacheruid,
                teacherid:param_teacherid,
                centercode: param_centercode,
                users : JSON.stringify(users),
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    callback(res.message);
                }else 
                    callback(null);
            },function(err){
                clog("err ",err);
                callback(null);
            });
        }
        function insert_teach_user(status,info,_date ,_teachid,_user,_opentype,managerid,mbstype,centercode,couponid,min,isfree){
            
            var insertuser = {};
            insertuser.uid = _user;
            var date = new Date(_date);
            var hh = date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
            insertuser.date = getToday(date);
            insertuser.time = parseInt(hh);
            insertuser.teachid = _teachid;
            insertuser.opentype = _opentype; 
            insertuser.user = _user;
            insertuser.managerid = managerid;
            insertuser.mbstype = mbstype;
            insertuser.centercode = centercode;
            insertuser.status = status;
            insertuser.couponid = couponid;
            insertuser.min = min;
            insertuser.isfree = isfree;
           
            
            
//            var data = {
//                type: "insertteachuser",//트레이너가 P.T 고객을 예약한다.
//                orneruid : orneruid,
//                teacheruid:param_teacheruid,
//                teacherid:param_teacherid,
//                centercode: centercode,
//                insertuser:JSON.stringify(insertuser)
//            }
//            CallHandler("my_teacher_reservation", data, function(res) {
//                var code = parseInt(res.code);
//
//                if (code == 100) {
//
////                   var data = res.message;
//                   
//                   //////////////////////////////////////////////////////
////                   update_user_result(info,date,hh,status,data); //화면 색과 버튼을 바꾼다.
////                   update_window_options_data(status,_date ,insertuser.teachid,data); // 윈도우 데이타를 함께 바꾼다.
//                    
//                    if(status == 0 && isfree){
//                        var ymd = getToday(new Date(date));
//                        var mtitle = "무료PT 예약완료";
//                        var mmessage = ymd+"일 "+hh+ "시 "+min+"분 운동이 예약되었습니다. (PT/GX 예약에서 확인가능합니다.)";
//                        var alert_text = "회원에게 무료PT 예약완료 푸시를 보냈습니다.";
//                        
//                    }else{
//                        var ymd = getToday(new Date(date));
//                        var mtitle = "운동예약 확인요청";
//                        var mmessage = ymd+"일 "+hh+ "시 "+min+"분 운동이 예약되었습니다. 체크후 확인 버튼을 눌러주세요.(PT/GX 예약에서 확인가능합니다.)";
//                        var alert_text = "승인요청 푸시를 보냈습니다. <br>운동시간 종료전에 회원이 승인해야 합니다.<br><br> <text style='color:#f4436d;font-size: 12px;'>※ 주의: 운동종료시간전까지 해당회원이 확인버튼을<br> 누르지 않으면 해당 수업은 자동으로 취소됩니다.</text>";
//                        
//                    }
//                    request_confirm_user(info,mtitle,mmessage,true,alert_text);    
//                    
//                   //////////////////////////////////////////////////////
//                    
//                }else{
//                   alertMsg(res.message,function(){
//                       hideModalDialog();
//                   });
//                }
//
////               
//            },function(err){
//                alertMsg("네트워크 에러 ",err);
//            });
        }
         //고객정보를 달력에서
//        function update_window_options_data(status,_date ,_teachid,data){
//            var teachname = "";
//            for(var i = 0 ; i < reservationinfo.classes.length; i++){
//                if(data.teachid == reservationinfo.classes[i].id){
//                    teachname = reservationinfo.classes[i].name;
//                    break;
//                }
//            }
//            
//            var title = "("+data.userlen+"/"+data.max+") "+teachname;
//            for(var i = 0 ; i < window.options.data.length; i++){
//                var event = window.options.data[i];
//               
//                var yy = event.start.getFullYear();
//                var mm = event.start.getMonth()+1;
//                var dd = event.start.getDate();
//                var hh = event.start.getHours();
//                var date = getDateToStr(yy,mm,dd,hh);
//                var teachid = event.teachid;
//                var user = event.user;
//                if(date == _date && teachid == _teachid){
//                    title = title+" 예약완료";
//                         window.options.data[i].title = title;
//                         window.options.data[i].user = "true";
//                         window.options.data[i].tcss = setDivType("over");
//                    break;
//                }
//            }
//        }
        //고객정보상태 변환
        function update_user_result(info,date,hh, status,data){
            var div = document.getElementById(info);
            var teachname = "";
            for(var i = 0 ; i < reservationinfo.classes.length; i++){
                if(data.teachid == reservationinfo.classes[i].id){
                    teachname = reservationinfo.classes[i].name;
                    break;
                }
            }
            
            
            
            var btntag = "";
//            document.getElementById("use_count").innerHTML = data.maxcount+"회중 "+data.usecount+"회 진행";
            if(status != 0){ //
//                var tcss = setDivType("tranerfinish");
//                div.style.backgroundImage = tcss.titlebackimg;
//                div.style.color = tcss.fontcolor;
                
                
                var btn = document.getElementById("btn_"+info);
                btn.innerHTML = "승인요청 다시하기";
                var innerhtml = div.innerHTML;
                if(status == 1){
                    innerhtml = innerhtml.replace('[운동예약]', '[운동완료]');
                    div.innerHTML = innerhtml.replace(',0)">', ',1)">');                    
                }
                    
                
                //btntag = btntag+" 예약가능<button class='btn btn-primary' style='float:right;margin-top:-9px;' onclick='insert_reservation(\"" + info + "\")' >예약하기</button>";
//                btntag
//                btntag
//                btntag
//                btntag
//                btntag
//                이 태그를 수정해야함
                
                
//                C_showToast(random_string(), "예약취소", date+" "+hh+"시 예약을 취소하였습니다.", function() {});
                if(status == 4) //cancel
                    alertMsg(hh+"시 예약을 취소하였습니다.",function(){
                        hideModalDialog();  hideModalDialog();
                    });
                else if(status == 1)
                    alertMsg(hh+"시 운동상태를 완료로 변경하였습니다.",function(){
                        hideModalDialog();  hideModalDialog();
                    });
                else 
                    hideModalDialog();
                
            }
            
//            div.innerHTML = btntag;
            
        }
        
        //고객정보를 달력에서 삭제한다.
//        function remove_user_data(_date ,_teachid,_user){
//            for(var i = 0 ; i < window.options.data.length; i++){
//                var event = window.options.data[i];
//               
//                var yy = event.start.getFullYear();
//                var mm = event.start.getMonth()+1;
//                var dd = event.start.getDate();
//                var hh = event.start.getHours();
//                var date = getDateToStr(yy,mm,dd,hh);
//                var teachid = event.teachid;
//                var user = event.user.uid;
//                if(date == _date && teachid == _teachid && user == _user){
//                    window.options.data.splice(i,1);
//                    break;
//                }
//            }
//        }
//        function remove_time_data(_date){
//            for(var i = 0 ; i < window.options.data.length; i++){
//                var event = window.options.data[i];
//               
//                var yy = event.start.getFullYear();
//                var mm = event.start.getMonth()+1;
//                var dd = event.start.getDate();
//                var hh = event.start.getHours();
//                var date = getDateToStr(yy,mm,dd,hh);
//                
//                if(date == _date){
//                    window.options.data.splice(i,1);
//                    if(window.mdraw)window.mdraw();
//                    break;
//                }
//            }  
//            
//        }
        function insert_time_data(_date,teachid){
            var date = new Date(_date);
            var hh = date.getHours();
            var ymd = getToday(date);
            var mdata = null;
            var isdata = false;
            for(var i = 0 ; i < window.options.data.length; i++){
                var event = window.options.data[i];
                if(window.options.data[i].date == ymd){
                    window.options.data[i].times.push({time:hh,members:[]});   
                    isdata = true;
                    break;
                }
            }
            if(!isdata){
                var times = [];
                var teachname = "";
                for(var i = 0 ; i < reservationinfo.classes.length; i++){
                    if(teachid == reservationinfo.classes[i].id){
                        teachname = reservationinfo.classes[i].name;
                        break;
                    }
                }
                times.push({time:hh,members:[]});
                var mdata = {type:reservationinfo.type,date:ymd,name:teachname,teachid:teachid,opentype:"ready",times:times};
                clog("insertCalenderDatas 11");
                insertCalenderDatas([mdata]);
                
            }else{
                if(window.mdraw)window.mdraw();
            }
        }
        function getTeachDatas(){
             var datas = [];
             for(var i = 0 ; i < reservationinfo.classes.length; i++){
                datas.push({teachid:reservationinfo.classes[i].id, teachname:reservationinfo.classes[i].name});
             }
            return datas;
        }
        //트레이너가 오픈할 수 있는 시간을 체크한다.
        function isOpenTime(hour){
            var isopen = true;
            for(var i = 0 ; i < closetimes.length;i++){
                if(parseInt(closetimes[i]) == parseInt(hour)){
                    isopen = false;
                    break;
                }
            }
            return isopen;
        }
        function pt_reservation(date,type){
            clog("pt_reservation "+date);
        }
       
        function open_time(time,callback){
            
            var date = new Date(time);
            var teach_datas = getTeachDatas();
          
            
            var info = time+"|||ready";
            var tag = "";
            clog("closetimes ",closetimes);
            clog("hour ",date.getHours());
            
            if(!isOpenTime(date.getHours())){
                alertMsg(date.getHours()+"시 타임은 오픈할 수 없습니다. 관리자에게 문의하세요.");
                return;
            }
            
            if(teach_datas.length == 1){
                info = time+"|"+teach_datas[0].teachid+"||ready";
                tag = teach_datas[0].teachname;
                update_teach_time("openteachtime",info,time,teach_datas[0].teachid,callback);

            }else if(teach_datas.length > 1){
                
                clog("teach_datas ",teach_datas);
                update_teach_time("openteachtime",info,time,teach_datas[0].teachid,callback);

            }
                
            
        }
        
        //예전 시간오픈버튼이 있을때 사용했으나 지금은 사용하지 않음
//        function remove_time(info,callback){
//           clog("remove_time");
//            var obj = info.split('|');
//            var date = new Date(obj[0]);            
//            var hh = stringGetHour(obj[0]);
//           
//            var ampm = parseInt(hh/12) < 1 ? "오전" :"오후";
//            var timestr = ampm +" "+ hh%12;
//            update_teach_time("removeteachtime",info,obj[0],obj[1],function(){});
//
//        }
        function update_teach_time(type,info,_date,teachid,callback){
            
            var date = new Date(_date);
            var hh = date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
            var timedata = {};
            timedata.date = getToday(date);
            timedata.time = parseInt(hh);
            timedata.teachid = teachid;
            timedata.mbstype = reservationinfo.type;
//            var data = {
//                type: type,
//                orneruid : orneruid,
//                teacheruid:param_teacheruid,
//                teacherid:param_teacherid,
//                centercode: calendar_data.centercode,
//                value:timedata
//                
//            }
//            CallHandler("my_teacher_reservation", data, function(res) {
//                var code = parseInt(res.code);
//
//                if (code == 100) {
////                    if(type == "removeteachtime"){
////                        document.getElementById(info).remove();
////                        remove_time_data(_date);
////                        mergeAllData_time_update(type,timedata.date,timedata.time);    
////                    }else{
////                        insert_time_data(_date,teachid);
////                        mergeAllData_time_update(type,timedata.date,timedata.time);    
////                        
////                    }
//                    callback();
//                    hideModalDialog();
//                }else{
//                   alertMsg(res.message,function(){
//                       hideModalDialog();
//                   });
//                }
//                
//            },function(err){
//                alertMsg(err);
//            });
//            }
            
            
        }
        
        
    </script>

</body>

</html>





<script type="text/tmpl" id="tmpl">

    {{
  var date = date || new Date(),
      month = date.getMonth(), 
      year = date.getFullYear(), 
      first = new Date(year, month, 1), 
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(), 
      thedate = new Date(year, month, 1 - startingDay),
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
      dayclass = lastmonthcss,
      today = new Date(),
      i, j; 

      
  if (mode === 'week') {
    thedate = new Date(date);
    thedate.setDate(date.getDate() - date.getDay());
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(last.getDate()+6);
  } else if (mode === 'day') {
    thedate = new Date(date);
    
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(thedate.getDate() + 1);
  }
  
  }}
   <table style="width:100%">
        <thead>
            <tr>
                <td colspan="7" style="text-align: center">
                    <br>
                    <table style="white-space: nowrap; width: 100%">
                        <!-- 년월주일, 전체일정오픈 , 오늘로가기 -->
                        <tr >
                            <td colspan="7" style="text-align: center;">
                                <!-- 년월주일 -->
                              <!--  <span class="btn-group" style="border-radius:20px;margin-left:5px;margin-right:2px;">
                                    <button style="background-color:#333333;height:32px;color:white;font-size:12px;border-radius:16px 0px 0px 16px;padding-left:15px;padding-right:10px" class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year"><text id="txt_year">년</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:12px;padding-left:10px;padding-right:10px" class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month"><text id="txt_month">월</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:12px;padding-left:10px;padding-right:10px" class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week"><text id="txt_week">주</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:12px;border-radius:0px 16px 16px 0px;padding-left:10px;padding-right:15px" class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day"><text id="txt_day">일</text></button>
                                </span> -->
                                
                                <!-- GX룸 개수 -->
                                 {{   if (mode ==='month') {  }}
                                <button id="total_gxroom_count" style="float:left;margin-left:10px;background-color:#333333;height:32px;color:white;font-size:12px;border:0px;border-radius:16px;padding-left:15px;padding-right:15px;display:none">GX룸: 0개</button>
                                {{ }  }}
                                <!-- 오늘로가기 -->
                                 <button style="background-color:#333333;height:32px;color:white;font-size:12px;border-radius:16px;padding-left:15px;padding-right:15px" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
                                 
                                 
                                {{
                                    var yy = thedate.getFullYear();
                                    var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
                                    var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
                                    var time = getDateToStr(yy,mm,dd);
                                    
                                    
                                }}
                               
                                 {{   if (mode ==='day') {  }}
                                

                                <button class="js-cal-option btn btn-default"  id="btn_teach_reservation" onclick="insert_user(0)" style="background-color:#333333;height:32px;color:white;font-size:12px;border-radius:16px;padding-left:10px;padding-right:10px;margin-right:2px;" >무료PT 예약</button>
                             
                               <button class="js-cal-option btn btn-default"  id="btn_teach_reservation" onclick="insert_user(1)" style="background-color:#333333;height:32px;color:white;font-size:12px;border-radius:16px;padding-left:10px;padding-right:10px;margin-right:2px;" >유료PT 예약</button>
                             
                               
                                {{ } else { }}
                               <button class="js-cal-option btn btn-default"  id="btn_teach_reservation" style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:16px;padding-left:15px;padding-right:15px;margin-right:2px;visibility:hidden" >PT예약</button>
                                
                                {{ }  }}
                                
                            </td>
                        </tr>
                        
                        <!-- 좌 년월 우 -->
                        <tr style="height:60px;border-bottom: 1px solid #292929;">
                            <td colspan="1" style="text-align: center;">
                                    
                            </td>
                            <td colspan="5" align="center">
                                <button class="js-cal-prev btn btn-default" style="background-color:#00000000;margin-right:10px"> <img src="./img/arrow_l.png" style="width:9px;height:15px"/></button>
                                <span class="btn-group btn-group-lg">
                {{
                                if (mode !== 'day') { 
                }}
                                        <text style="color:white;font-size:17px;"><b>{{: year}}</b>년</text>
                {{
                                    if (mode === 'month') { 
                                        var m_month = shortMonths[month];
                                        
                }}
                                        <text style="margin-left:10px;color:white;font-size:17px;"><b>{{: month+1 }}</b>월</text>
                {{
                                    } 
                                    if (mode ==='week') {                         
                }}
                                        <text style="margin-left:10px;color:white;font-size:17px;">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</text>
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
                                    var mdate = myear+" "+mmonth+" "+mday+" "+mweek+""; 

                        
                }}
                                    <text style="color:white;font-size:17px;">{{: mdate }}</text>
                {{
                                } 
                }}
                                </span>
                                <button class="js-cal-next btn btn-default" style="background-color:#00000000;margin-left:10px"><img src="./img/arrow_r.png"  style="width:9px;height:15px"/></button>
                            </td>
                            <td colspan="1" style="text-align: left">
                                
                                    
                                
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        </thead>
        {{ if (mode ==='year') {
      month = 0;
    }}
        <tbody>
            {{ for (j = 0; j < 3; j++) { }}
            <tr>
                {{ for (i = 0; i < 4; i++) { }}
                <td class="calendar-month month-{{:month}} js-cal-option" data-date="{{: new Date(year, month, 1).toISOString() }}" data-mode="month">
                    <text style="font-size:12px;color:white">{{: months[month] }}</text>
                    <text style="font-size:12px;color:white">{{ month++;}}</text>
                </td>
                {{ } }}
            </tr>
            {{ } }}
        </tbody>
        {{ } }}
        {{ if (mode ==='month' || mode ==='week') { }}
        <!--==================================================-->
        <!-- 일 , 월 , 화 , 수 , 목 , 금 , 토 -->
        <!--==================================================-->
        <thead>
          <tr class="c-weeks" align="center" style="width:48px;height:48px;border-bottom: 1px solid #292929;">
            {{ for (i = 0; i < 7; i++) { 
                var wcolor = i == 0 ? "#e36969" : "#ffffff";
            }}
              <th class="c-name">
                <text style="font-weight:300;font-size:14px;color:{{: wcolor }}">{{: days[i] }}</text>
              </th>
            {{ } }}
          </tr>
        </thead>
        
        
        <!--==================================================-->
        <!-- 메인 날짜 -->
        <!--==================================================-->
         <tbody>
            {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
            <tr align="center"  style="border-bottom: 1px solid #292929;vertical-align:top">
                {{ for (i = 0; i < 7; i++) { 
                    var yy = thedate.getFullYear();
                    var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
                    var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
                    var now = yy + "-" + mm + "-" + dd;
                    var opacity = 0.1;
                    
                }}
                {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss;opacity = 1; } }}
                <td  class="stop-dragging calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? '':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}" style="opacity:{{: opacity }}">
                  <div id="rect_{{: now }}" style="color:white" class="date">
                  <label id="text_{{: now }}"   style="position:absolute;font-size:12px;font-weight:500;width:52px; height:45px;border-radius:3px;background-color:#aaaaaa66;color:white;padding-top:20px;display:none"></label>
                    <text id="num_{{: now }}"  class="fmont" style="font-size:13px;font-weight:400;opacity:1;padding:10px">{{: thedate.getDate() }}</text>
                    <input id="input_{{: now }}"  style="display:none" value="0" />
                  </div>
            {{ 
                   thedate.setDate(thedate.getDate() + 1);
            }}
                </td>
                {{ } }}
            </tr>
            
            {{ } }}
            
            <!-- 맨하단 빈공간 -->
            <tr><td><br></td></tr>
        </tbody>
        {{ } }}
        {{ if (mode ==='day') { }}
        <tbody>
            <tr>
                <td colspan="7">
                    
                    
                        <!-- 오늘 이후 날짜라면 -->
                        {{ if(thedate.toDateInt() >= today.toDateInt()) { }} 
                        <table style="width:100%">
                            <tbody>
                                <tr align="center" style="display:none;border-top: 1px solid #292929;border-bottom: 1px solid #292929;">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text class="fmont" style="text-align:right;float:right;font-size:10px;color:#afafaf;font-weight:400">All Day</text></div></th>
                                    
                                    <td class="{{: date.toDateCssClass() }}"  style=""border-left: 1px solid #292929;width:100%"> </td>
                                </tr>
                                <tr id="tr_input" style="display:none;border-bottom: 1px solid #292929;">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text style="text-align:right;float:left;font-size:10px;color:#afafaf;font-weight:400">수동삽입 P.T</text></div></th>
                                    
                                    <td class="time-0-0" style=""border-left: 1px solid #292929;width:100%"> </td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%">
                             <tbody>
                                {{for (i = 6; i < 24; i++) { 

                                    var mhh = i < 10 ? "0"+i : i;

                                    var yy = thedate.getFullYear();
                                    var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
                                    var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
                                    var now = yy + "-" + mm + "-" + dd;
                                    var dday = getDDay(now);

                                    var time = getDateToStr(yy,mm,dd,mhh); 
                                    var id = "open"+thedate.toDateCssClass()+"time"+i;
                                }}
                                <tr id="daytime_{{: time }}" style="display:none;border-bottom: 1px solid #292929;">
                                     <th class="timetitle"; style="vertical-align:top">
                                        <div style="width:53px;min-height:30px;padding-top:7px;">
                                            <div id="daytime_arc_{{: time }}" style="float:right;width:6px;height:6px;border-radius:3px;background-color:#fffd00;margin-top:3px;margin-right:-4px;display:none"></div>
                                            <text id="daytime_txt_{{: time }}" class="fmont" style="text-align:right;float:right;font-size:13px;color:#afafaf;font-weight:400;padding-right:9px">{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</text>
                                        </div>
                                    </th>
                                   
                                    <td class="time-{{: i}}-0" style="width:100%;border-left:solid 1px #393939"></td>
                                </tr>

                                {{ } }}
                            </tbody>
                        </table>
                        <table style="width:100%">
                             <tbody>
                                <tr style="display:none">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text class="fmont" style="text-align:right;float:right;font-size:10px;color:#afafaf;font-weight:400">After 12 PM</text></div></th>
                                    
                                    <td class="time-24-0" style=""border-left: 1px solid #292929;width:100%"> </td>
                                </tr>
                            </tbody>
                        </table>
                        
                         {{ } else { }}
                         <table style="width:100%">
                            <!-- 오늘 이전 날짜라면 -->
                            <tbody>
                                <tr align="center" style="display:none;border-top: 1px solid #292929;border-bottom: 1px solid #292929;display:none">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text class="fmont" style="text-align:right;float:right;font-size:10px;color:#afafaf;font-weight:400">All Day</text></div></th>
                                    <td style="border-left: 1px solid #292929;width:100%" class="{{: date.toDateCssClass() }}"><div style="width:100%"></div></td>
                                </tr>
                                
                                <tr id="tr_input" style="display:none;border-bottom: 1px solid #292929;">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text style="text-align:right;float:left;font-size:10px;color:#afafaf;font-weight:400">수동삽입 P.T</text></div></th>

                                    <td style="border-left: 1px solid #292929;width:100%"  class="time-0-0"><div style="width:100%"></div></td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="width:100%">
                             <tbody>
                                {{
                                    for (i = 6; i < 24; i++) { 

                                        var mhh = i < 10 ? "0"+i : i;

                                        var yy = thedate.getFullYear();
                                        var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
                                        var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
                                        var now = yy + "-" + mm + "-" + dd;
                                        var dday = getDDay(now);

                                        var time = getDateToStr(yy,mm,dd,mhh); 
                                        var id = "open"+thedate.toDateCssClass()+"time"+i;
                                       
                                }}
                                <tr id="daytime_{{: time }}" style="border-bottom: 1px solid #292929;display:none">
                                    <th class="timetitle"; style="vertical-align:top">
                                        <div style="width:53px;min-height:30px;padding-top:7px;">
                                            <div id="daytime_arc_{{: time }}" style="float:right;width:5px;height:5px;border-radius:3px;background-color:#fffd00;margin-top:3px;margin-right:-4px;display:none"></div>
                                            <text id="daytime_txt_{{: time }}" class="fmont" style="text-align:right;float:right;font-size:13px;color:#afafaf;font-weight:400;padding-right:9px">{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</text>
                                        </div>
                                    </th>

                                    <td class="time-{{: i}}-0" style="width:100%;border-left:solid 1px #393939"></td>
                                </tr>
                                {{ } }}
                            </tbody>
                        </table>
                        <table style="width:100%">
                             <tbody>
                                
                                <tr style="display:none">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text class="fmont" style="text-align:right;float:right;font-size:10px;color:#afafaf;font-weight:400">After 12 PM</text></div></th>
                                    <td style="border-left: 1px solid #292929;width:100%" class="time-24-0" ><div style="width:100%"></div></td>
                                </tr>
                            </tbody>
                        </table>
                         {{ } }}
                        
                    
                    
                </td>
            </tr>
                
            
        </tbody>
        {{ } }}
    </table>
</script>


<script>
     
    holidayCheck();


    var $currentPopover = null;
    $(document).on('shown.bs.popover', function(ev) {
        var $target = $(ev.target);
        if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
            $currentPopover.popover('toggle');
        }
        $currentPopover = $target;
    }).on('hidden.bs.popover', function(ev) {
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
//    zoom = (screen_width / calendar_width) * 0.95;
//    
//    var width_percent = 92;
//    if (zoom > 1) zoom = 1;
//    
//    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  "+width_percent+"%;  zoom: " + zoom + ";-moz-transform: scale(" + zoom + ");}</style>";
//    
//    
//    document.getElementById("div_month_total_table").style.zoom = zoom+"";
    
    
    
    
    //    var calendar = document.getElementsByClassName("calendar-table");//[0].style.transform = "scale(0.5)";
    //    setTimeout(function(){
    //        clog("*** calendar is ",calendar[0]);    
    //        calendar[0].style.transform = "scale(0.5)";
    //    },1000);


    //quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
    //the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
    $.extend({
        quicktmpl: function(template) {
            return new Function("obj", "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('" + template.replace(/[\r\t\n]/g, " ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g, "$1\r").replace(/\t:(.*?)\}\}/g, "',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'") + "');}return p.join('');")
        }
    });

    $.extend(Date.prototype, {
        //provides a string that is _year_month_day, intended to be widely usable as a css class
        toDateCssClass: function() {
            return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate();
        },
        //this generates a number useful for comparing two dates; 
        toDateInt: function() {
            return ((this.getFullYear() * 12) + this.getMonth()) * 32 + this.getDate();
        },
        toTimeString: function() {
            var hours = this.getHours(),
                minutes = this.getMinutes(),
                hour = (hours > 12) ? (hours - 12) : hours,
                ampm = (hours >= 12) ? ' pm' : ' am';
            if (hours === 0 && minutes === 0) {
                return '';
            }
            if (minutes > 0) {
                return hour + ':' + minutes + ampm;
            }
            return hour + ampm;
        }
    });


    (function($) {

        //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
        var t = $.quicktmpl($('#tmpl').get(0).innerHTML);


        //    var zoom = 100;
        //    var screen_width = $(window).width();
        //    var calendar_width = 700;
        //    zoom = parseInt((screen_width/calendar_width)*100);

        //    if(screen_width < calendar_width)
        //        zoom = parseInt((screen_width/calendar_width)*100);
        //    else 
        //        zoom = parseInt((calendar_width/screen_width/)*100);
        //   setTimeout(function(){
        //    $('.calendar-table').css("transform", "scale(0.5)");   
        //   },1000);
        //    clog("calendar ",$('calendar-table'));
        //    clog("zoom is "+zoom);
        //    $('calendar-table').css("zoom", "50%");
        //    $('.calendar-table').css("transform", "scale(0.5)");

        //     $('.scalable').each(function(){
        //        rescale($(this));
        //    })


        function calendar($el, options,key) {
            //actions aren't currently in the template, but could be added easily...
//            clog("calendar call!!");
             if(key){
//                 clog("key is "+key);
                 if(key == "prev"){
//                     clog("prev --");
                     switch (options.mode) {
                        case 'year':
                            options.date.setFullYear(options.date.getFullYear() - 1);

                            break;
                        case 'month':
                            options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1);

                            break;
                        case 'week':
                            options.date.setDate(options.date.getDate() - 7);

                            break;
                        case 'day':
                            options.date.setDate(options.date.getDate() - 1);

                            break;
                    }
                    param_day = options.mode == "day" ? options.date.getTime() : "";
                    draw();
                    holidayCheck();
                 }else if(key == "next"){
//                     clog("next !!");
                      switch (options.mode) {
                        case 'year':
                            options.date.setFullYear(options.date.getFullYear() + 1);

                            break;
                        case 'month':
                            options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1);

                            break;
                        case 'week':
                            options.date.setDate(options.date.getDate() + 7);

                            break;
                        case 'day':
                            options.date.setDate(options.date.getDate() + 1);

                            break;
                    }
                    param_day = options.mode == "day" ? options.date.getTime() : "";
                    draw();
                    holidayCheck();
                 }
             }   
            
           
             function getPTButtonTag(roomid,intype,hour,color){
                 //   10 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  , 3 : 예약된상태 , 5 : 예약이 꽉참
                var now_texts = ["예약완료","", "출석완료","","정원초과", "대기신청됨"]; //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
                var txts = ["예약취소","", "예약취소","","대기신청", "대기취소"]; //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
                
                var nowtxt = "수업열림";
                var btntxt = "예약하기";
                
//                clog("intype"+intype);
                if(intype < 10){
                    btntxt = txts[intype];
                    nowtxt = now_texts[intype];
                }
                
                //var tag = "<span style='float:right;margin-top:-70px'><button  onclick='removeRoom(\"" +yearmonthnum + "\",\"" +clickid + "\",\"" +hour + "\",\"" +roomname + "\",\"" +userslen + "\")'  /></span>";
                
                var nexttype = 0; //예약하기
                if(intype == 0)nexttype = 10; //취소해서 다시 원래대로 돌리기
                if(intype == 4)nexttype = 5; //꽉차서 대기신청하기
                if(intype == 5)nexttype = 4; //꽉차서 대기신청하기
                var mcolor = intype == 0 ? "white" : color;
                var tag = "<div  style='position:absolute;width:275px;height:100px;margin-top:-35px;margin-left:-15px;'><button style='float:right;margin-top:10px;margin-right:15px;padding-right:10px;padding-top:4px;padding-bottom:4px;border:1px solid "+mcolor+";color:"+mcolor+";font-size:11px;font-weight:bold;border-radius:4px;background-color:#00000000'>"+nowtxt+"</button></div>";
                
                return tag;
            }
            function getGXTeacherButtonTag(isroomopen,roomid,intype,hour,color){
                 //   10 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  , 3 : 예약된상태 , 5 : 예약이 꽉참
                var now_texts = ["예약완료","", "출석완료","","정원초과", "대기신청됨"]; //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
                var nowtxt = "수업열림";
              
                
//                clog("intype"+intype);
                if(intype == 4){ //정원초과
                    nowtxt = now_texts[intype];
                }
                
                if(!isroomopen){
                    nowtxt = "수강종료";
                    color = "gray";
                }
                //var tag = "<span style='float:right;margin-top:-70px'><button  onclick='removeRoom(\"" +yearmonthnum + "\",\"" +clickid + "\",\"" +hour + "\",\"" +roomname + "\",\"" +userslen + "\")'  /></span>";
                
                var nexttype = 0; //예약하기
                if(intype == 0)nexttype = 10; //취소해서 다시 원래대로 돌리기
                if(intype == 4)nexttype = 5; //꽉차서 대기신청하기
                if(intype == 5)nexttype = 4; //꽉차서 대기신청하기
                var mcolor = intype == 0 ? "white" : color;
                var tag = "<div  style='position:absolute;width:275px;height:100px;margin-top:-35px;margin-left:-15px;'><button style='float:right;margin-top:10px;margin-right:15px;padding-right:10px;padding-top:4px;padding-bottom:4px;border:1px solid "+mcolor+";color:"+mcolor+";font-size:11px;font-weight:bold;border-radius:4px;background-color:#00000000'>"+nowtxt+"</button></div>";
                
                return tag;
            } 
           
            function dayAddEvent(index, event) {
                //GX 예약화면
                if(event.type_ptgx == "그룹")
                {
                
                    var e = new Date(event.start),
                    dateclass = e.toDateCssClass();
                    var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();

                    var yy = event.start.getFullYear();
                    var mm = event.start.getMonth()+1;
                    var dd = event.start.getDate();
                    var hh = event.start.getHours();
                

                 
                    startint = event.start.toDateInt(),
                    dateint = options.date.toDateInt();
                    
                    

                    var clickid = event.roomdata.room_id;
                    var room = event.roomdata;
                    var roomid = room.room_id;
                    var max = room.room_max;
                    var txt_date = event.start.getFullYear()+". "+(event.start.getMonth()+1)+". "+event.start.getDate();
                    var room_title = room.room_detailname ? room.room_detailname : room.room_name;
                    var userslen = room.room_users ? room.room_users.length : 0;
                    var hour = parseInt(event.start.getHours());
                    var roommin = room.room_min;
                    var roomlessontime = room.room_lessontime ? parseInt(room.room_lessontime): 50;
                    
                    var muid = param_teacheruid;
                    if(room.room_managerid != muid)return;
                    
                    
                    var yearmonthnum = parseInt(event.start.getFullYear())*12+parseInt(event.start.getMonth())+1;
                    var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                    var isbeforesame = false;
                    
//                    clog(" clickid "+clickid+" roomid "+roomid+" max "+max+" sdate "+sdate+" roomname "+roomname+" userslen "+userslen+" hour "+hour+" roommin "+roommin+" yearmonthnum "+yearmonthnum+" sdate "+sdate);
                    
                    var smm = mm < 10 ? "0"+mm : mm;
                    var sdd = dd < 10 ? "0"+dd : dd;
                    var shh = hour < 10 ? "0"+hour : hour;
                    var smin = parseInt(roommin) < 10 ? "0"+roommin : roommin;
                    var rstart = shh+":"+smin;
                    
                    var emin = (parseInt(roommin)+roomlessontime)%60; //50분기준으로 한다.
                    var addhour = Math.floor((parseInt(roommin)+roomlessontime)/60);
                    var ehour = (hour+addhour)%24;
//                    if(ehour > 23)ehour = 0;
                    var ehh = ehour < 10 ? "0"+ehour : ehour;
                    var emm = emin < 10 ? "0"+emin : emin;
                    var rend = ehh+":"+emm;
                    var txt_startend = rstart+"~"+rend;
                    var room_starttime = yy+"-"+smm+"-"+sdd+" "+shh+":"+smin+":00";
                    var room_endttime = yy+"-"+smm+"-"+sdd+" "+ehh+":"+emin+":00";
                    var isroomopen = isNowTimeMinOver(room_endttime) > 0 ? true : false;
                    
                    //  -1 : 예약안된상태  0: 예약만한상태  2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(대기신청아직안함) , 5 : 예약이 꽉참(대기신청완료한상태)
                    var intype_bg = ["background-image:linear-gradient(to bottom,  #fff7d1 0px, #dfd7b1 100%);","", "background-image:linear-gradient(to bottom, #e36969 0px, #f38989 100%);","","background-image:linear-gradient(to bottom,  #c997c9 0px, #dab9da 100%);","background-image: linear-gradient(rgb(199, 144, 90) 0px, rgb(219, 168, 110) 100%);"];   
                    if(startint == dateint  && isNowTimeMinOver(room.room_opentime) != 1 && parseInt(room.room_isshow) == 1){
                        var timeclass = '.time-23-0';
                        if (hour < 6) {
                            timeclass = '.time-0-0';
                        }
                        else if (hour < 24) {
                            timeclass = '.time-' + hour + '-' + (event.start.getMinutes() < 30 ? '0' : '30');
                        }
                        var roombg = mColor.RGX_OPEN; //오픈된 상태icon_class_time.png
                        switch(intype){
                          
                            case 10:
                                roombg = mColor.RGX_OPEN; //오픈된 상태
                                break;
                            case 0:
                                roombg = mColor.RGX_RESERVATION; // 예약함
                                break;
                            case 2:
                                roombg = mColor.RGX_QRCHECKIN; // QR체크인까지 완료함
                                break;
                            case 4:
                                roombg = mColor.RGX_FULL;  // 예약이 꽉참 내가 없음
                                break;
                            case 5:
                                roombg = mColor.RGX_READY; //대기신청함 내가 들어있음
                                break;                                
                        }
                        var txt_color = "white"; // 글자색
                        var icon_clock = "./img/icon_class_time.png"; //시계아이콘 
                        var opacity = 1;
                        if(!isroomopen){
                             opacity = 0.5;
//                            roombg = "gray";
//                            txt_color = "gray";
//                            icon_clock = "./img/icon_class_time_off.png";
                           
                        }
                        
                        
                        
                        
                        var users = room.room_users ? room.room_users : [];
                        var ready_users = room.room_readyusers ? room.room_readyusers : [];
                        //방이름
                        
                        var txt_roomname = "<text style='font-size:16px;color:"+txt_color+";font-weight:bold'>"+room_title+"</text>";
                        //강사이름
                        var txt_teacher_name = "<div style='position:absolute;margin-left:56px;margin-top:8px;'><text style='font-size:14px;color:"+txt_color+";'>"+room.room_managername+" 강사</text></div>";
                        //시간
                        var txt_time = "<div style='position:absolute;margin-left:56px;margin-top:27px;width:150px;height:30px'>"+
                            "<img src='"+icon_clock+"' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:"+txt_color+";height:100%;line-height:30px'>"+txt_startend+"</text></div>";
                        //동그라미 그림
                        var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:30px;'><img src='./img/arcicon_2.png' style='width:46px;height:46px;border-radius:23px'/></div>";
                        var div = document.createElement("div");
                        var intype = getGXInType(roomid,users,ready_users,max); //   -1 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  , 5 : 예약이 꽉참
                      
                        
                        div.id = clickid;
                        
                       
                        var nexttype = 0; //예약하기
                        if(intype == 0)nexttype = 10; //취소해서 다시 원래대로 돌리기
                        if(intype == 4)nexttype = 5; //꽉차서 대기신청하기
                        if(intype == 5)nexttype = 4; //꽉차서 대기신청하기
                        var txts = ["예약취소","", "예약취소","","대기신청", "대기취소"]; //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
                        var btntxt = "예약하기";
                        if(intype < 10)
                            btntxt = txts[intype];
                        
                        var bgcolor = intype == 0 ? mColor.RGX_RESERVATION : mColor.C222222;
                        var txt_cntcolor = intype == 0 ? "white" : roombg; 
                        
                        //인원수 ex) 6/2
                        var txt_usercnt = "<div style='float:right;margin-top:47px;margin-right:5px;'><text style='font-size:20px;color:"+txt_cntcolor+";font-weight:600'>"+users.length+"/"+room.room_max+"</text></div>";
                        
                        var str_gxinfo = setJSONStringToParamString(event.roomdata);
                        var str_roomusers = setJSONStringToParamString(users);
                        
                        
//                        clog("room ",room);
                        
                        
//                        clog("****** room_starttime "+room_starttime+" istimeover "+ isNowTimeOver(room_starttime));
                        
                        var onclick_tag = "onclick='show_roomdetail(\"" +room_starttime + "\", \"" +roomid + "\", "+hour+", \"" +btntxt + "\", \"" +room.room_name + "\", \"" +room.room_managername + "\", \"" +hour + "\", \"" +roommin + "\", \"" +str_roomusers + "\", \"" +room.room_max + "\", \"" +txt_cntcolor + "\", \"" +bgcolor + "\", \"" +txt_date + "\", \"" +str_gxinfo + "\", \"" +txt_startend + "\")'";
                        
                        div.innerHTML = "<div "+onclick_tag+"  style='width:280px;font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:100px;background-color:"+bgcolor+";border-radius:10px;opacity:"+opacity+"'>"+arc_div+txt_roomname+txt_teacher_name+txt_time+txt_usercnt+getGXTeacherButtonTag(isroomopen,roomid,intype,hour,roombg)+"</div>";
                        
                        div.style.width = "280px"
                        div.style.padding = "3px"
                        div.style.margin = "2px";
                        div.style.height="auto";
                        div.onclick = function(){                 
//                            roomclick(yearmonthnum,clickid,dateFormat(event.start));
                        }

                        
                        //빈시간대는 보여지지 않는다.
                       
                        if(dateclass == sdate ){
                            var trid = "daytime_"+getDateToStr(yy,mm,dd,hh+"");
                            var trarc = "daytime_arc_"+getDateToStr(yy,mm,dd,hh+"");
                            var trtxt = "daytime_txt_"+getDateToStr(yy,mm,dd,hh+"");
                            
                            var time_tr = document.getElementById(trid);
                            var time_arc = document.getElementById(trarc);
                            var time_txt = document.getElementById(trtxt);
                            if(time_tr){
                                time_tr.style.display = "block";
                                time_tr.style.borderBottom = "0px";
                               
                                
                                if(time_arc){
                                    time_arc.style.display = "block";
                                    time_arc.style.marginTop = "15px";
                                }
                                if(time_txt){
                                    var time_h = parseInt(hh) < 10 ? "0"+hh : hh;
                                    var time_min = parseInt(roommin) < 10 ? "0"+roommin : roommin;
//                                    var hhmm = time_h+":"+time_min;
//                                    var hhmm = time_h+":00";
                                    time_txt.style.marginTop = "9px";
//                                    time_txt.innerHTML = hhmm;
                                }
                            }

                            if(timeclass == '.time-0-0'){
                                var tr_input = document.getElementById("tr_input");
                                tr_input.style.display = "block";
                            }

                        } 
                            
                        $(timeclass).css("padding","15px");
                        $(timeclass).append(div);


                    }
                }
                // PT 예약화면
                else {
                    var e = new Date(event.start),
                    dateclass = e.toDateCssClass();
                    var clickdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();

                    if (!!event.allDay) {
                        monthAddEvent(index, event);
                        return;
                    }

                    //시간오픈 tr은 안보여진다.
                    if(!event.user.uid)return;

                    var button = document.createElement('button');
                    var yy = event.start.getFullYear();
                    var mm = event.start.getMonth()+1;
                    var dd = event.start.getDate();
                    var hh = event.start.getHours();
                    var smm = mm < 10 ? "0"+mm : mm;
                    var sdd = dd < 10 ? "0"+dd : dd;

                    //시간 : ex) 18:35~19:25
                    //var minute = getNoteInMininute(removeFreePTText(event.user.note));
                    var minute = event.min;
                    var shh = hh < 10 ? "0"+hh : hh;
                    var smin = parseInt(minute) < 10 ? "0"+minute : minute;
                    var rstart = shh+":"+smin;
                    var emin = (minute+50)%60; //50분기준으로 한다.
                    var ehour = smin+50 >= 60 ? hh+1 : hh;
                    if(ehour > 23)ehour = 0;
                    var ehh = ehour < 10 ? "0"+ehour : ehour;
                    var emm = emin < 10 ? "0"+emin : emin;
                    var rend = ehh+":"+emm;
                    var txt_startend = rstart+" ~ "+rend;    
                    var room_starttime = yy+"-"+smm+"-"+sdd+" "+shh+":"+smin+":00";
                    var room_endttime = yy+"-"+smm+"-"+sdd+" "+ehh+":"+emin+":00";
                   
//                    clog("시간 "+room_endttime);
                    
                    
                    var sdate = getDateToStrDisplay(yy,mm,dd,hh);//event.start.getFullYear()+"-"+(event.start.getMonth()+1)+"-
                    var s_date = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();

                    //오픈 버튼을 숨긴다.
                    var btn_open_id = "open_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate()+"time"+hh;

                    var btn = document.getElementById(btn_open_id);
                    if(btn)btn.style.visibility = "hidden";

                    var clickid = ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+event.user.uid+"|"+event.opentype;
                    var title = event.title;
                    var text = event.title;
                    var isdisplayuser = !param_useruid || param_useruid && param_useruid == event.user.uid ? true : false;

    //                  if(mm == 10 && dd == 19){
    //                        clog(event.user.uid+"================================",userinfos);
    //                        clog("aa event.user.uid ",event.user.uid);
    //                        var userobj = findValueinArray(userinfos,"uid",event.user.uid,event.user.couponid);
    //                        clog("bb obj ",userobj);
    //                    }
                    var isdeleteicon = false;

                    //X icon
                    var delete_icon = "<div style='float:right;width:35px;height:35px;margin-top:-10px;margin-right:-10px;' align='center' onclick='remove_user_reservation(\"" + clickid + "\","+event.user.status+",\""+event.user.couponid+"\")'><img src='./img/button_delete_schedule.png' style='width:9px;height:9px;margin-top:10px;z-index:999'  ></div>";


                    var maxcount = 0;
                    var freecount = 0;
                    var usecount = 0;
                    var note_tag = "";
                    var isfreept = false;
                    if(event.user.uid){
                        var userobj = findValueinArray(userinfos,"uid",event.user.uid,event.user.couponid);
                        if(event.user.note.indexOf(TXT_FREEPT) >= 0 || event.user.note.indexOf(TXT_FREEPT_AND_TIMEOUT) >= 0)isfreept = true;
                        if(userobj){
    //                         clog(userobj.name+" ccc "+dateclass);
                            var statustxt = get_reservation_status_tag(event.user.status);
                            title = userobj.name;

                            if(userobj.mbstype){
                                 if(isdisplayuser){
                                        var isfreepttxt = isFreePTText(event.user.note);

                                        maxcount = getMbsMaxCount(userobj);
                                        freecount = userobj.mbsfreecount ? parseInt(userobj.mbsfreecount) : 0;
                                        usecount = parseInt(userobj.usecount);

                                        if(event.user.status == 2){

                                            note_tag = event.user.note ? "<div style='position:absolute;margin-left:56px;margin-top:35px;'><text style='color:white;font-size:14px;'>Note:</text>&nbsp;<input id='timenote_"+clickid+"' onchange='time_note_change(\"" + clickid + "\","+event.user.status+",\""+event.user.couponid+"\",\""+isfreepttxt+"\")' value='"+removeFreePTText(event.user.note)+"' style='width:100px;height:22px;background-color:#62393233;border-radius:4px;color:white;font-size:14px;border:0 solid black'/></div>": "";
    //                                        text = statustxt+"<text style='color:white;font-size:12px'>"+userobj.name+" ["+userobj.userid+"]</text>"+note;
                                             isdeleteicon = true;
                                        }                                
                                        else {

                                            note_tag = event.user.note ? "<div style='position:absolute;margin-left:56px;margin-top:35px;'><text style='color:white;font-size:14px'>Note:</text>&nbsp;<input id='timenote_"+clickid+"' onchange='time_note_change(\"" + clickid + "\","+event.user.status+",\""+event.user.couponid+"\",\""+isfreepttxt+"\")' value='"+removeFreePTText(event.user.note)+"'  style='width:100px;height:22px;background-color:#62393233;border-radius:4px;color:white;font-size:14px;border:0 solid black'/></div>": "";
                                            var stime = userobj.starttime.length <= 10 ? userobj.starttime : userobj.starttime.substr(0,10);
                                            var etime = userobj.endtime.length <= 10 ? userobj.endtime : userobj.endtime.substr(0,10);

                                            ////////////////////////////////////////
                                            //이부분  재사용함
                                            ////////////////////////////////////////
    //                                        maxcount = parseInt(userobj.mbsmaxcount);
    //                                        freecount = userobj.mbsfreecount ? parseInt(userobj.mbsfreecount) : 0;
    //                                        usecount = parseInt(userobj.usecount);
                                            ////////////////////////////////////////

    //                                        text = note+statustxt+"<text style='color:white;font-size:11px'>"+userobj.name+"</text><text class='fmont' style='color:white;font-size:11px;'>["+userobj.userid+"], "+userobj.mbsdesc+" ￦"+CommaString(userobj.mbsprice)+"</text><br><div style='margin-top:-7px'><text class='fmont' style='color:white;font-size:11px;'>"+maxcount+"/<span style='color:"+mColor.YELLOW+"'>"+userobj.usecount+"</span>, "+stime+"~"+etime+"</text>&nbsp;<text style='color:white;font-size:11px'>(<span style='color:"+mColor.YELLOW+"'>"+userobj.mbsmonth+"</span>개월)"+"</text></div>"; 
                                        }
                                 }else{
                                     text = "<text style='color:white'>"+userobj.name+"["+userobj.userid+"]</text>";
                                 }


                            }else{
                                text = "<text style='color:white'>"+userobj.name+"["+userobj.userid+"]</text>";
                            }
                            if(event.user.note.indexOf(TXT_FREEPT) >= 0){
                                text ="<img src = './img/icrect_freept.png' style='margin-top:-5px;margin-left:-50px;position:absolute;'/>"+text;
                            }     
                        }else{

                        }                    
                    }
                    var rectLine = event.user.uid ? "<span style='float:left'><div style='width:4px;height:40px;background-color:#ea703b;border-radius:5px,1px,5px,1px;'></div></span>" : "";


                    var bgcolor = mColor.RA_FINISH;
                    if(event.user.uid && event.user.status == 10) bgcolor = mColor.RA_REQUEST;
                    else if(event.user.uid && event.user.status == 0) bgcolor = mColor.RA_USERCHECKED;
                    else bgcolor = mColor.RA_FINISH;

                    var txtcolor = mColor.R_FINISH;
                    if(event.user.uid && event.user.status == 10) txtcolor = mColor.R_REQUEST;
                    else if(event.user.uid && event.user.status == 0) txtcolor = mColor.R_USERCHECKED;
                    else txtcolor = mColor.R_FINISH;

    //                clog("bgcolor "+bgcolor)
                    //기본 텍스트
                    var div = document.createElement("div");
                    div.id = clickid;
                    div.style.width = "280px"
                    div.style.borderRadius = "6px";
                    div.style.paddingTop = "5px";
                    div.style.paddingBottom = "5px";
                    div.style.marginBottom = "1px";
                    div.style.backgroundColor = bgcolor;


    //                if(!event.user)div.style.backgroundColor = mColor.R_OPEN;

                    //내용 텍스트
    //                div.innerHTML = rectLine+"<span><div style='width:100%;margin-left:10px;margin-right:30px;'>"+text+"</div></span>";
    //                div.style.padding = event.user.uid ? "13px":"4px";
                    //시간 오픈 + 고객 데이타 가 있으면 오늘 이전 날짜면 시간오픈이 보이지 않으므로 margin은 오늘 날짜 이후로만 적용한다.
                    if(event.user.uid && getDDay(sdate) >= 0)div.style.marginTop = "7px";



                    //div 테두리 강조하기 
    //                if(param_useruid && isdisplayuser){
    //                      
    //                    div.style.border = "5px solid #48BAE4";
    //                }
    //                else {
    //                clog("param_useruid  "+param_useruid);
                    if(param_useruid && event.user && event.user.uid &&  param_useruid == event.user.uid ||  !param_useruid && event.user && event.user.uid &&   event.user.uid){
                        div.style.minHeight = "30px";
                        //기간이 지나서 버튼을 안보이게 한다.


                        //if(getDDay(sdate) >= 0)
                        if(isNowTimeOver(sdate) > 0) //현재시간보다 나중이라면 , 즉 시간이 아직 안지났다면
                        {
    //                        div.innerHTML = "&nbsp;&nbsp;<button class='btn btn-default' style='background-color:#9237d9;font-size:11px;color:white;padding-top:2px;padding-bottom:2px;padding-left:5px;padding-right:5px;border-radius:4px' onclick='insert_user(\"" + clickid + "\",\"freept\")' >무료PT</button>&nbsp;&nbsp;<button class='btn' style='background-color:#3164ff;font-size:11px;color:white;padding-top:2px;padding-bottom:2px;padding-left:5px;padding-right:5px;border-radius:4px' onclick='insert_user(\"" + clickid + "\",\"defaultpt\")' >유료PT예약</button>&nbsp;&nbsp;<span style='float:right'><div onclick='remove_time(\"" + clickid + "\")' align='center' style='width:30px;height;30px'><img src ='./img/button_delete_schedule.png' style='width;9px;height:9px'/></span>";
                        }  
                    }

                    var $event = $('<div/>', {
                        'class': 'event',
                        text: text,
                        title: title,
                        'data-index': index
                    });


                    var start = event.start,
                        end = event.end || start,
                        time = event.start.toTimeString(),
                        hour = start.getHours(),
                        timeclass = '.time-23-0',
                        startint = start.toDateInt(),
                        dateint = options.date.toDateInt(),
                        endint = end.toDateInt();

                    //
                    if (startint > dateint || endint < dateint) {  //타이틀부분이라면

                        return;
                    }
                    //6시 이전 시간오픈 을 수동삽입목록
                    if(hour < 6 && !event.user.uid){
                        div.innerHTML = "";
                        div.style.display = "none";

                    }
                    var mcolor = event.user.status == 0 ? "white" : txtcolor;
                    var btn_tag = "";
                    if(event.user.status < 2 || event.user.status == 10)
                    {                        
                        if(event.user.uid){
                            var btn_txt = "";
                            var color_tag = "";
                            var click_tag = " onclick='remove_user_reservation(\"" + clickid + "\","+event.user.status+",\""+event.user.couponid+"\")' ";
                            switch(event.user.status){
                                case 0:// 운동예약된상태
                                    btn_txt = "종료설정";
                                    color_tag = "background-color:#82081c";
                                    break;
                                case 1:  //고객인 운등했는지  승인한다. 지금은 사용하지 않음 
                                    btn_txt = "승인요청 다시하기";
                                    break;    
                                case 10: //트레이너가 운동예약신청한상태
                                    btn_txt = "취소하기";
                                    break;    


                            }
    //                        btn_txt = event.user.status+"";
    //                        var btn_txt = event.user.status == 0 ? "운동완료" : "승인요청 다시하기";

                            if(isdisplayuser){

    //                            btn_tag = "<br><button id='btn_"+clickid+"' style='background-color:#191919;font-size:11px;color:white;float:right;margin-top:-21px;margin-right:5px;border-radius:5px;border:0px' onclick='remove_user_reservation(\"" + clickid + "\","+event.user.status+",\""+event.user.couponid+"\")' >"+btn_txt+"</button>";

                                //버튼 
                                btn_tag = "<div "+click_tag+" style='position:absolute;width:280px;height:70px;margin-top:-35px;'><button style='float:right;margin-top:10px;margin-right:25px;padding-right:7px;padding-top:4px;padding-bottom:4px;border:1px solid "+mcolor+";color:"+mcolor+";font-size:11px;font-weight:bold;border-radius:4px;background-color:#00000000' >"+btn_txt+"</button></div>";
                            }
                        }  
                    }else if(event.user.status == 2 ){
    //                    btn_tag = "<label style='position:absolute;float:right;margin-top:-4px;right:50px;padding-left:7px;padding-right:7px;padding-top:4px;padding-bottom:4px;border:1px solid "+mcolor+";color:"+mcolor+";font-size:11px;font-weight:bold;border-radius:4px;background-color:#00000000' >완료</label>";
                    }
    //                div.innerHTML += btn_tag;

                    // 횟수  ex) 2/10
                    var txt_usercnt = "<label style='position:absolute;float:right;font-size:20px;color:"+mcolor+";font-weight:600;margin-top:53px;right:35px;'>"+usecount+"/"+(maxcount+freecount)+"</label>";

                    
                    var txt_roomname = isfreept ? "<text style='font-size:16px;color:white;font-weight:bold;margin-left:-10px;'><img src='./img/free3.png' style='width:30px;height:30px;margin-top:-10px;'>PT</text>":"<text style='font-size:16px;color:white;font-weight:bold;'>PT</text>";
                    //방이름 PT
//                    var txt_roomname = "<text style='font-size:16px;color:white;font-weight:bold'>"+freept_txt+"PT</text>";
                    //회원이름
                    var txt_teacher_name = userobj ? "<div style='position:absolute;margin-left:56px;margin-top:-23px;'><text style='font-size:16px;color:white;font-weight:bold'>"+userobj.name+"&nbsp;<span class='fmont' style='color:e9e9e9;font-weight:400'>["+userobj.userid+"]</span></text></div>" : "";

                    //PT시간
                    var txt_time = "<div style='position:absolute;margin-left:56px;margin-top:7px;width:150px;height:30px'>"+
                        "<img src='./img/icon_class_time.png' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+txt_startend+"</text></div>";
                    //동그라미 그림
                    var arc_icon = isfreept ? "./img/arcicon_f00.png" : "./img/arcicon_0.png";
                    var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:30px;'><img src='"+arc_icon+"' style='width:46px;height:46px;border-radius:23px'/></div>";

//                    var onclick_tag = "";

                     var isroomopen = isNowTimeMinOver(room_endttime) > 0 ? true : false;
                    var opacity = 1;
                    if(!isroomopen){
                        opacity = 0.5;
                    }
                    if(!isdeleteicon)delete_icon = "";
                    //div 배경포함 조합 
                    div.innerHTML = "<div "+onclick_tag+"  style='width:280px;font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:100px;border-radius:10px;opacity:"+opacity+"'>"+arc_div+txt_roomname+txt_teacher_name+txt_time+note_tag+txt_usercnt+btn_tag+delete_icon+"</div>";

    //                $event.toggleClass('begin', startint === dateint);
    //                $event.toggleClass('end', endint === dateint);
                    if (hour < 6) {
                        timeclass = '.time-0-0';
                    }
                    else if (hour < 24) {
                        timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
                    }


                    //빈시간대는 보여지지 않는다.                     


                    if(dateclass == s_date){

    //                     clog(userobj.name+" "+dateclass+" aaa");
                        var trid = "daytime_"+getDateToStr(yy,mm,dd,hh+"");
                        var trarc = "daytime_arc_"+getDateToStr(yy,mm,dd,hh+"");
                        var trtxt = "daytime_txt_"+getDateToStr(yy,mm,dd,hh+"");

                        var time_tr = document.getElementById(trid);
                        var time_arc = document.getElementById(trarc);
                        var time_txt = document.getElementById(trtxt);
                        if(time_tr){
                            time_tr.style.display = "block";
                            time_tr.style.borderBottom = "0px";


                            if(time_arc){
                                time_arc.style.display = "block";
                                time_arc.style.marginTop = "15px";
                            }
                            if(time_txt){
                                var time_h = parseInt(hh) < 10 ? "0"+hh : hh;
                                var time_min = "00";
                               // var hhmm = time_h+":"+time_min;
//                                var hhmm = time_h+":00";
                                time_txt.style.marginTop = "9px";
//                                time_txt.innerHTML = hhmm;
                            }
                        }

                        if(timeclass == '.time-0-0'){
                            var tr_input = document.getElementById("tr_input");
                            tr_input.style.display = "block";
                        }

                    } 


    //                $(timeclass).append(div);


                     //////////////////////////////////////////////////////////
                    //neel change start
                    //////////////////////////////////////////////////////////


    //                if(event.backgroundimage)div.style.backgroundImage = event.backgroundimage;

    //                if(event.user.uid && event.user.status == 10) div.style.backgroundColor = mColor.R_REQUEST;
    //                else if(event.user.uid && event.user.status == 0) div.style.backgroundColor = mColor.R_USERCHECKED;
    //                else div.style.backgroundColor = mColor.R_FINISH;
    //               
    //                if(!event.user)div.style.backgroundColor = mColor.R_OPEN;


                    //수동입력이라면
                    if(hour < 6){
                        div.style.backgroundColor = mColor.R_OTHER;
                        div.style.marginBottom = "1px";
                    }
                    //////////////////////////////////////////////////////////
                    //neel change end
                    //////////////////////////////////////////////////////////
                     $(timeclass).css("padding","15px");
                    
                     $(timeclass).append(div);     
                     
                   
                }
                
                
                
                
            }
            
            function checkTotalMonthData(nowdate){
                
//                var month_all_user = document.getElementById("month_all_user");
                var month_now_user = document.getElementById("month_now_user");
                var month_all_reservation_count = document.getElementById("month_all_reservation_count");
                var month_now_reservation_count = document.getElementById("month_now_reservation_count");
                //var month_now_reservation_finish_count = document.getElementById("month_now_reservation_finish_count");
                var month_now_reservation_finish_count = 0;
                var month_total_confirm_count = document.getElementById("month_total_confirm_count");
                
                now_month.yy = nowdate.getFullYear();
                now_month.mm = nowdate.getMonth();
                now_month.users = [];
//                    now_month.month_all_user = 0;
                now_month.month_now_user = 0;
                now_month.month_all_reservation_count = 0;
                now_month.month_now_reservation_count = 0;
                now_month.month_now_reservation_finish_count = 0;
                now_month.month_total_confirm_count = 0;

//                    month_all_user.innerHTML = 0;
                month_now_user.innerHTML = 0;
                month_all_reservation_count.innerHTML = 0;
                month_now_reservation_count.innerHTML = 0;
                month_now_reservation_finish_count.innerHTML = 0;
                month_total_confirm_count.innerHTML = 0;
                    
                nowmonthusersdata = [];
//                document.getElementById("select_users").style.display = "none";   

            }
            function setTotalMonthData(){
//                var month_all_user = document.getElementById("month_all_user");
                var month_now_user = document.getElementById("month_now_user");
                var month_all_reservation_count = document.getElementById("month_all_reservation_count");
                var month_now_reservation_count = document.getElementById("month_now_reservation_count");
                //var month_now_reservation_finish_count = document.getElementById("month_now_reservation_finish_count");
                var month_now_reservation_finish_count = 0;
                var month_total_confirm_count = document.getElementById("month_total_confirm_count");

//                month_all_user.innerHTML = now_month.month_all_user;
                month_now_user.innerHTML = now_month.month_now_user;
                month_all_reservation_count.innerHTML = now_month.month_all_reservation_count;
                month_now_reservation_count.innerHTML = now_month.month_now_reservation_count;

                month_now_reservation_finish_count.innerHTML = now_month.month_now_reservation_finish_count;
                month_total_confirm_count.innerHTML = now_month.month_total_confirm_count;

            }
//            function setMonthUsers(month_users){
//                var select_users = document.getElementById("select_users");
//               
////                if(!month_users){
////                    select_users.innerHTML = "";
////                    select_users.style.display = "none";
////                    return;
////                }
////                select_users.style.display = "block";
//                month_users = trim_sort_2array(month_users,"uid");
//                select_users.innerHTML = "<option value='0'>전체</option>";
//                for(var i = 0 ; i < month_users.length; i++){
//                    var user = month_users[i];
//                    var userobj = findValueinArray(userinfos,"uid",user.uid,user.couponid);
//                    var isselected = param_useruid && param_useruid == user.uid ? "selected" : "";
//                    if( param_useruid && param_useruid == user.uid)label_title.innerHTML = userobj.name+" 예약표";
//                    
////                    clog("userobj ",userobj);
//                    if(userobj)select_users.innerHTML+="<option value='"+userobj.uid+"' "+isselected+">"+userobj.name+"</option>";
//                }
//                
//            }
//            var now_month = {yy:"",mm:"",month_now_user:0,month_all_reservation_count:0,month_now_reservation_count:0,month_now_reservation_finish_count:0,month_total_confirm_count:0,users:[]};
            var nowmonthusersdata = [];
            
            function monthAddEvent(index, event) {
                
                //GX 예약화면
                if(event.type_ptgx == "그룹")
                {
                    
                    e = new Date(event.start),
                    dateclass = e.toDateCssClass();
                    var clickid = event.roomdata.room_id;
                    var room = event.roomdata;
                    var roomid = room.room_id;
                    var max = room.room_max;
                    var hour = parseInt(event.start.getHours());
                    var roommin = room.room_min;
                    
                    var yy = event.start.getFullYear();
                    var mm = event.start.getMonth()+1;
                    var dd = event.start.getDate();
                    var hmm = mm < 10 ? "0"+mm : mm;
                    var hdd = dd < 10 ? "0"+dd : dd;
                    var sdate = "_"+yy+"_"+mm+"_"+dd;               
                    var ymd = yy+"-"+hmm+"-"+hdd;  
                    var ym = yy+"-"+hmm;  
                    
                    var hour = parseInt(event.start.getHours());


                    var nowday = parseInt(event.start.getDate());
                    var intype_bg = ["background-image:linear-gradient(to bottom,  #fff7d1 0px, #dfd7b1 100%);","", "background-image:linear-gradient(to bottom, #e36969 0px, #f38989 100%);","","background-image:linear-gradient(to bottom,  #c997c9 0px, #dab9da 100%);","background-image: linear-gradient(rgb(199, 144, 90) 0px, rgb(219, 168, 110) 100%);"]; 
                    
                    
                    var min = parseInt(roommin) < 10 ? "0"+roommin : roommin;
                    var hhh = hour < 10 ? "0"+hour : hour;
                    var ymdhms = yy+"-"+hmm+"-"+hdd+"T"+hhh+":"+min+":00";               
                    //시간이 지났거나 회원이 승인했다면 회색 , 승인안했다면 녹색
                    var isgreencolor = bdata && bdata.status && bdata.status == 10 && isNowTimeMinOver(ymdhms) > 0 ? true : false;
                    
                    if(dateclass == sdate && isNowTimeMinOver(room.room_opentime) != 1 && parseInt(room.room_isshow) == 1){//오픈시간체크
                        
                        var users = room.room_users ? room.room_users : [];
                        var ready_users = room.room_readyusers ? room.room_readyusers : [];
                        
                        var text = room.room_name+"<br>"+users.length+"/"+room.room_max+"명<br>강사명:"+room.room_managername+", 오픈시간:"+hour+"<br>Note : "+room.room_note;
                        var intype = getGXInType(roomid,users,ready_users,max); //   10: 오픈됨 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(내가없음) , 5 : 예약이 꽉참
                        var roombg = mColorImg.R_OPEN;
                        switch(intype){
                          
                            case 10:
                                roombg = mColorImg.RGX_OPEN; //오픈된 상태
                                break;
                            case 0:
                                roombg = mColorImg.RGX_RESERVATION; // 예약함
                                break;
                            case 2:
                                roombg = mColorImg.RGX_QRCHECKIN; // QR체크인까지 완료함
                                break;
                            case 4:
                                roombg = mColorImg.RGX_FULL;  // 예약이 꽉참 내가 없음
                                break;
                            case 5:
                                roombg = mColorImg.RGX_READY; //대기신청함 내가 들어있음
                                break;
                                
                        }
//                        if(intype< 10)roombg = intype_bg[intype];
                        var div = document.createElement("div");
                        div.id = clickid;
                         var time = event.start.toTimeString();
                         var timetag = getTimeTag(time);
                        div.innerHTML = timetag;
                        div.style.padding = "3px"
                        div.style.margin = "2px";
                        div.style.height = "14px";
                        div.style.padding = "2px";
                        div.style.margin = "2px";
                        div.style.borderRadius = "4px";                       
                        div.style.backgroundImage = roombg;
                        
                       
//                        var timetag = getTimeIconTag(time,4,5);
                        
//                        if(intype == 0 || intype == 2 || intype == 5) //내꺼만 표시
                        var muid = param_teacheruid;
                        if(room.room_managerid == muid){

                            
//                          $('.' + event.start.toDateCssClass()).append(div);
                            
//                            if(isgxdata)
                            {
                                
                            
                                var total_user_text = document.getElementById("text_"+ymd);
                                var input_value = document.getElementById("input_"+ymd);
                                var ivalue = input_value ? parseInt(input_value.value) : 0;
                                if(isgreencolor)input_value.value = ""+(ivalue++);
                                if(total_user_text){
                                    var time_count = stringGetOnlyNumber(total_user_text.innerHTML)+1;
                                    if(time_count > 0){
                                        total_user_text.innerHTML = ""+time_count+"건";
                                        total_user_text.style.display = "block";
                                        if(getDDay(ymd) >= 0 && ivalue == 1)
                                            total_user_text.style.backgroundColor = "#0cc57f88";
                                    }
                                }
                            }
                        }
                        
                    }
                }
                //PT 예약화면
                else {
//                    clog("PT "+event.start);
                    e = new Date(event.start),
                    dateclass = e.toDateCssClass();
                    var bdata = event.bdatas;
                    
                    var yy = event.start.getFullYear();
                    var mm = event.start.getMonth()+1;
                    var dd = event.start.getDate();
                    var hmm = mm < 10 ? "0"+mm : mm;
                    var hdd = dd < 10 ? "0"+dd : dd;
                    var sdate = "_"+yy+"_"+mm+"_"+dd;               
                    var ymd = yy+"-"+hmm+"-"+hdd;               
                    
                    
                   
                    var isdisplayuser = !param_useruid || param_useruid && param_useruid == event.user.uid ? true : false;
                    if(bdata && dateclass == sdate)
                    {
                        
                        if(event.start.getFullYear() == now_month.yy && event.start.getMonth() == now_month.mm){
                            if(bdata.status >= 0){
                                if(isdisplayuser)now_month.month_all_reservation_count++;
                            }

                            if(bdata.status == 0){
                                if(isdisplayuser)now_month.month_now_reservation_count++;                        
                            }
                            else if(bdata.status == 1){
                                if(isdisplayuser)now_month.month_now_reservation_finish_count++;
                            }
                            else if(bdata.status == 2){
                                if(isdisplayuser)now_month.month_total_confirm_count++;
                            }
                            if(bdata.uid){
    //                            
                                if(isdisplayuser){
                                    now_month.users.push(bdata.uid)
                                    now_month.users = trim_sort_1array(now_month.users);
                                    var trim_month_users = trim_array(now_month.users);
                                    now_month.month_now_user = trim_month_users.length;
                                }

                                nowmonthusersdata.push(bdata);
    //                            setMonthUsers(nowmonthusersdata);
                            }
                            setTotalMonthData();
                        }

                    }


                    var title = event.title;
                    var text = event.title;
                    var hour = parseInt(event.start.getHours());
                    if(hour < 6 && !event.user.uid){
                        text = "P.T수동삽입";
                    }
                    var free_tag = "";
                    var cid_tag = "";
                    var name_tag = "";
                    var $timeevent = null;
                    
                    var min = parseInt(event.min) < 10 ? "0"+event.min : event.min;
                    var hhh = hour < 10 ? "0"+hour : hour;
                    var ymdhms = yy+"-"+hmm+"-"+hdd+"T"+hhh+":"+min+":00";               
                    //시간이 지났거나 회원이 승인했다면 회색 , 승인안했다면 녹색
                    var isgreencolor = bdata && bdata.status && bdata.status == 10 && isNowTimeMinOver(ymdhms) > 0 ? true : false;
//                    if(bdata && bdata.status){
//                        clog(bdata.status+" isgreencolor "+isNowTimeMinOver(ymdhms));
//                        clog(ymdhms+" isgreencolor "+isgreencolor);
//                    }
                    if(isdisplayuser && event.user.uid){


                        var userobj = findValueinArray(userinfos,"uid",event.user.uid,event.user.couponid);

                        if(userobj){

                           var cid = stringGetMonth(userobj.id)+""+stringGetDay(userobj.id); 
                            cid_tag = "<text style='color:white;text-shadow:1px 1px 1px #f00;'>["+cid+"]</text><br>";
                            name_tag = "<text style='color:white;'>"+userobj.name+"</text>";
                            text = hour < 6 && event.user.uid ? "" : "고객번호("+userobj.userid+")";    
    //                        text = hour < 6 && event.user.uid ? "<text class='fmont' style='font-size:10px;color:white;'>"+userobj.name+"</text>" : "고객번호("+userobj.userid+")";    

                        }
                        if(event.user.note.indexOf(TXT_FREEPT) >= 0){
                            free_tag = "<img src = './img/icon_freept_mini.png' style='margin-top:3px;margin-left:-20px;position:absolute;width:20px;height:20px'/>";                    
                        }
                    }else{
                        return;
                    }
                    var $event = $('<div/>', {

                        text: text,
                        title: title,
                        'data-index': index
                    }),
                    e = new Date(event.start),
                    dateclass = e.toDateCssClass(),
                    day = $('.' + e.toDateCssClass()),
                    empty = $('<div/>', {
                        'class': 'clear event',
                        html: ' '
                    }),
                    numbevents = 0,
                    time = event.start.toTimeString(),
                    endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
                    checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 40),
                    existing,
                    i;
                    $event.toggleClass('all-day', !!event.allDay);
                    $event.css("height","13px");
                    $event.css("margin","2px");
                    $event.css("borderRadius","4px");
//                    if(userobj && hour < 6 && event.user.uid){
//                        console.log("ddddd ",userobj.name);
//                        $event.html("<text class='fmont' style='font-size:9px;color:"+mColor.C111111+";'>"+userobj.name+"</text>");
//                    }
    //                 $event.css({ "height" : "100px"});
                    if (!!time) {

    //                    var timetag = getTimeIcon(time);

                        var timetag = getTimeTag(time);

                        $event.html(timetag);

                    }
                    if (!event.end) {
                        $event.addClass('begin end');
                        $('.' + event.start.toDateCssClass()).append($event);
                        return;
                    }

                    while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
                        if (day.length) {
                            existing = day.find('.event').length;
                            numbevents = Math.max(numbevents, existing);
                            for (i = 0; i < numbevents - existing; i++) {
                                day.append(empty.clone());
                            }

                            //////////////////////////////////////////////////////////
                            //neel change start
                            //////////////////////////////////////////////////////////
    //                        clog("e ",e);
    //                        clog("event.end ",event.end);
    //                        clog("event.backgroundimage ",event.backgroundimage);
                            //이부분이 날짜칸에 데이타 태그를 삽입하는부분이다.
                            if(event.backgroundimage)$event.css("background-image",event.backgroundimage);


                            //수동입력이라면
                            if(hour < 6){
                                $event.css("background-image",mColorImg.R_OTHER);
                            }



                            //////////////////////////////////////////////////////////
                            //neel change end
                            //////////////////////////////////////////////////////////
                            if(isdisplayuser){ // 오픈시간을 월달력에서 보여준다.
    //                        if(isdisplayuser && event.user){ //오픈시간을 월달력에서 보여주지 않는다.


    //                            day.append($event.toggleClass('begin', dateclass === event.start.toDateCssClass()).toggleClass('end', dateclass === event.end.toDateCssClass()));    
//                                  clog("--------------------text_"+ymd);
                                
                                  
                                      var total_user_text = document.getElementById("text_"+ymd);
                                      var input_value = document.getElementById("input_"+ymd);
                                     
                                      var ivalue = input_value ? parseInt(input_value.value) : 0;
                                      if(isgreencolor)input_value.value = ""+(ivalue++);
                                      if(total_user_text){
                                          var time_count = stringGetOnlyNumber(total_user_text.innerHTML)+1;
                                          if(time_count > 0){
//                                              if(!isgxdata)
                                              total_user_text.innerHTML = ""+time_count+"건";
                                              total_user_text.style.display = "block";
                                              if(getDDay(ymd) >= 0 && ivalue == 1)
                                                 total_user_text.style.backgroundColor = "#0cc57f88";
                                          }
                                      }
                                  
                            }
                            $event = $event.clone();
                            $event.html(' '); 

                        }





                        e.setDate(e.getDate() + 1);
                        dateclass = e.toDateCssClass();
                        day = $('.' + dateclass);
                    }
                }
                
                
                
            }

            function yearAddEvents(events, year) {
                var counts = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                $.each(events, function(i, v) {
                    if (v.start.getFullYear() === year) {
                        counts[v.start.getMonth()]++;
                    }
                });
                $.each(counts, function(i, v) {
                    if (v !== 0) {
                        $('.month-' + i).append('<span class="badge"><text style="font-size:10px;color:yellow">' + v + '</text></span>');
                    }
                });
            }
           //년,월,주,일 배경 동그라미를 넣는다.
//            function drawYMWDArc(mode){
//                var txt = document.getElementById("txt_"+mode);
//                if(txt){
//                    txt.style.color = "#111111";
//                    txt.style.backgroundColor = "#d6d6d6";
//                    txt.style.paddingLeft = "10px";
//                    txt.style.paddingRight = "10px";
//                    txt.style.paddingTop = "4px";
//                    txt.style.paddingBottom = "4px";
//                    txt.style.borderRadius = "12px";    
//                }
//            }
            function draw() {
                $el.html(t(options));
                //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
                $('.' + (new Date()).toDateCssClass()).addClass('today');
                if (options.data && options.data.length) {
//                    document.getElementById("div_month_total_table").style.visibility = options.mode == "month" ? "visible" : "hidden";
                    document.getElementById("div_month_total_table").style.display = options.mode == "month" ? "block" : "none";
                     checkTotalMonthData(options.date);
//                    drawYMWDArc(options.mode);
                    
                    showGXRoomCount(options);
                    if (options.mode === 'year') {
                        yearAddEvents(options.data, options.date.getFullYear());
                        
                    } else if (options.mode === 'month' || options.mode === 'week') {
                        $.each(options.data, monthAddEvent);
                        
                        
                        //month arc
                    } else {
                        //맨위로가기
                        window.scrollTo(0,0);
                        
                         var o = options;
                        if(reservationinfo && reservationinfo.classes[0]){
                             var dday = get_Day(o.date,reservationinfo.classes[0].next_endtime);
                             if(o.mode == "day" && dday < 0){// 날짜범위보다 미래 날짜이다면
                                var mday = "open_"+o.date.getFullYear()+"_"+(o.date.getMonth()+1)+"_"+o.date.getDate();
                                for(var i = 6 ; i < 24; i++){

                                    var open_btn_id = mday+"time"+i;
                                    var open_btn = document.getElementById(open_btn_id);
                                    if(open_btn)open_btn.style.display = "none";
                                }
                            }
                        }
                        for (var i = 0; i < options.data.length; i++) {
                            dayAddEvent(i, options.data[i]);
                        }
                    }
                }
            }
            
            function showGXRoomCount(options){
                var mode = options.mode;
                var odate = options.date;
                var total_gxroom_count = document.getElementById("total_gxroom_count");
                if(total_gxroom_count)
                if(mode == "month"){
                    total_gxroom_count.style.display = "block";
                    var y = odate.getFullYear();
                    var m = odate.getMonth()+1;
                    var ym = y+"-"+m;
                    
                    var userlen = totalgxroomusercount[ym] ? totalgxroomusercount[ym] : 0;
                    if(totalgxroomcount[ym]){
                        total_gxroom_count.innerHTML = "<i class='fa-sharp fa-solid fa-door-open'></i>&nbsp;&nbsp;<span style='color:yellow'>"+totalgxroomcount[ym].nowroom+"</span>/"+totalgxroomcount[ym].maxroom;
                        total_gxroom_count.title = "GX방 총"+totalgxroomcount[ym].maxroom+"개 중 오늘까지 [방:"+totalgxroomcount[ym].nowroom+"개 , 예약:"+userlen+"건]";
                    }
                        
                    else 
                        total_gxroom_count.style.display = "none";
                }else {
                    total_gxroom_count.style.display = "none";
                }
                
            }
           
            draw();
            window.mdraw = draw;
        }
        
        ;
        var mycalendar = null;
        window.calendar = calendar;
        (function(defaults, $, window, document) {
           
//            window.defaults = defaults;
            $.extend({
                
                calendar: function(options) {
                    
                    return $.extend(defaults, options);
                }
            }).fn.extend({
               
                calendar: function(options) {
                    
                    options = $.extend({}, defaults, options);
                    window.options = options;
                    return $(this).each(function() {
                        var $this = $(this);
                        
                        window._mthis = $this;
                        calendar($this, options);
                        
                      
                        
                        $this.on('click', '.js-cal-prev', function() {
                            clog("prev click 000");
                            switch (options.mode) {
                                case 'year':
                                    options.date.setFullYear(options.date.getFullYear() - 1);

                                    break;
                                case 'month':
                                    options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1);

                                    break;
                                case 'week':
                                    options.date.setDate(options.date.getDate() - 7);

                                    break;
                                case 'day':
                                    options.date.setDate(options.date.getDate() - 1);

                                    break;
                            }
                            param_day = options.mode == "day" ? options.date.getTime() : "";
                            window.mdraw();
                            holidayCheck();
                        })
                        .on('click', '.js-cal-next', function() {
                            clog("next click 111");
                            switch (options.mode) {
                                case 'year':
                                    options.date.setFullYear(options.date.getFullYear() + 1);

                                    break;
                                case 'month':
                                   
                                    options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1);

                                    break;
                                case 'week':
                                    options.date.setDate(options.date.getDate() + 7);

                                    break;
                                case 'day':
                                    options.date.setDate(options.date.getDate() + 1);

                                    break;
                            }
                            param_day = options.mode == "day" ? options.date.getTime() : "";
                            window.mdraw();
                            holidayCheck();
                        })
                        .on('click', '.js-cal-option', function() {
            //                clog("==============================");
                            clog("option click 222");
                            var $t = $(this),
                                o = $t.data();

                            if (o.date) {

                                o.date = new Date(o.date);

                                if (o.mode == undefined) o.mode = "day";


                            }
                            param_day = o.mode && o.mode == "day" && o.date ? o.date.getTime() : "";

                            $.extend(options, o);
                             window.mdraw();
                            holidayCheck();

                         })
                        .on('click', '.js-cal-years', function() {
                            param_day = "";
                            holidayCheck();
                            var $t = $(this),
                                haspop = $t.data('popover'),
                                s = '',
                                y = options.date.getFullYear() - 2,
                                l = y + 5;
                            if (haspop) {
                                return true;
                            }
                            for (; y < l; y++) {
                                s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">' + y + '</button>';
                            }
                            //      $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
                            return false;
})
                        .on('click', '.event', function() {
                                clog(" click 3333");
                                var $t = $(this),
                                    o = $t.data();
                                if (o.date) {
                                    o.date = new Date(o.date);
                                    if (o.mode == undefined) o.mode = "day";

                                    holidayCheck();
                                }

                                $.extend(options, o);
                                 window.mdraw();

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

                    });
                }
            });
        })({
            days: ["일", "월", "화", "수", "목", "금", "토"],
            months: ["1월달", "2월달", "3월달", "4월달", "5월달", "6월달", "7월달", "8월달", "9월달", "10월달", "11월달", "12월달"],
            shortMonths: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
            date: (new Date()),
            //daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
            daycss: ["c-sunday", "", "", "", "", "", ""],
            todayname: "오늘",
            thismonthcss: "current",
            lastmonthcss: "outside",
            nextmonthcss: "outside",
            mode: "month",
            data: []
        }, jQuery, window, document);

    })(jQuery);

    
    var data = [],
        date = new Date(),
        d = date.getDate(),
        d1 = d,
        m = date.getMonth(),
        y = date.getFullYear(),
        i,
        start,
        end,
        j,
        c = 1063,
        c1 = 3329,
        hh,
        mm;
    //    names = ['All Day Event', 'Long Event', 'Birthday Party', 'Repeating Event', 'Training', 'Meeting', 'Mr. Behnke', 'Date', 'Ms. Tubbs'],
    //    slipsum = ["Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends.", "Well, the way they make shows is, they make one show. That show's called a pilot. Then they show that show to the people who make shows, and on the strength of that one show they decide if they're going to make more shows. Some pilots get picked and become television programs. Some don't, become nothing. She starred in one of the ones that became nothing.", "Yeah, I like animals better than people sometimes... Especially dogs. Dogs are the best. Every time you come home, they act like they haven't seen you in a year. And the good thing about dogs... is they got different dogs for different people. Like pit bulls. The dog of dogs. Pit bull can be the right man's best friend... or the wrong man's worst enemy. You going to give me a dog for a pet, give me a pit bull. Give me... Raoul. Right, Omar? Give me Raoul.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.", "You see? It's curious. Ted did figure it out - time travel. And when we get back, we gonna tell everyone. How it's possible, how it's done, what the dangers are. But then why fifty years in the future when the spacecraft encounters a black hole does the computer call it an 'unknown entry event'? Why don't they know? If they don't know, that means we never told anyone. And if we never told anyone it means we never made it back. Hence we die down here. Just as a matter of deductive logic.", "Like you, I used to think the world was this great place where everybody lived by the same standards I did, then some kid with a nail showed me I was living in his world, a world where chaos rules not order, a world where righteousness is not rewarded. That's Cesar's world, and if you're not willing to play by his rules, then you're gonna have to pay the price.", "You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man."];

     var my_payroll_users = [];
     function setCalendar(json){
            clog("setCalendar : type_ptgx is "+type_ptgx);
//         type_ptgx = "GX";
            if(type_ptgx == "PT"){
                document.getElementById("type_pt").style.display = "block";
                document.getElementById("type_gx").style.display = "none";
            }else{
                document.getElementById("type_pt").style.display = "none";
                document.getElementById("type_gx").style.display = "block";
            }
         
         
         
            param_centercode = json.centercode;
         console.log("22 json is ",json);
         console.log("22 param_centercode is "+param_centercode);
//            var container = document.getElementById("container");
            
         
         
            var now = new Date();
            var year = now.getFullYear();
            var month = now.getMonth() + 1;
         
            var obj = new Object();
            obj.centercode = param_centercode;
            obj.uid = param_teacheruid;
            obj.id = param_teacherid;
            obj.year = year;
            obj.month = month;
         
//            //페이롤을 가져온다. 페이롤안의 내 이번달 회원들
//            CallHandler("my_payroll_history", obj, function(res) {
//                clog("payroll res is ",res);
//                var code = parseInt(res.code);
//                if(code == 100){
//                    var payroll_teachers = res.message[0].data;
//                    for(var i = 0 ; i < payroll_teachers.length;i++){
//                        if(payroll_teachers[i].pr_uid == param_teacheruid){
//                            my_payroll_users = JSON.parse(payroll_teachers[i].pr_users);
//                            break;
//                        }
//                    }
//                    console.log("my_payroll_users ",my_payroll_users);
//                }
//            }, function(err) {
//                //        alertMsg("네트워크 에러 ");
//                show_error_popup("ERROR", "네트워크 에러", "exit");
//            });
         
            var users = getUsers(json);

//            if(users.length > 0){
                var data = {
                    type: "getusers",
                    orneruid : orneruid,
                    teacheruid:param_teacheruid,
                    teacherid:param_teacherid,
                    centercode: json.centercode,
                    users : JSON.stringify(users)
                }

                CallHandler("my_teacher_reservation", data, function(res) {


                    var code = parseInt(res.code);

                    if (code == 100) {

                        userinfos = res.message;
                        if(res.payrollusers)my_payroll_users = res.payrollusers;
                        clog("userinfos ",userinfos);
                         clog("my_payroll_users ",my_payroll_users);

                        reservation_container.style.display = "block";
                        calendar_data = json;
                        initReservation(json);
                        insertAllReservation();        
                    }else {
//                        alertMsg(res.message);
                    }
                },function(err){
//                    alertMsg(res.message);
                });

            
            
            
        }
    function insertAllReservation(){
        var datas = [];
        var close = addCalendatas(calendar_data.type,calendar_data.close, "close");
        var open = addCalendatas(calendar_data.type,calendar_data.open, "open");  //현재 open은 빈 값으로 사용하지 않음
        var ready = addCalendatas(calendar_data.type,calendar_data.ready, "ready");
        
        
        
        for(var i = 0 ; i < close.length;i++)
            datas.push(close[i]);
        
        for(var i = 0 ; i < open.length;i++)
            datas.push(open[i]);
        for(var i = 0 ; i < ready.length;i++)
            datas.push(ready[i]);
        
        insertCalenderDatas(datas);   
        
    }
    function addCalendatas(type,obj,opentype){
        if(!obj)return [];
        var dates = [];
        for(var i = 0 ; i < obj.length; i++){// close, open , ready 3개
            
            for(var j = 0 ; j < obj[i].dates.length; j++){
                
                var rdata = {"type":"","name":"","date": "","times":[]};
                rdata.type = type;
                rdata.name = obj[i].teachname;
                rdata.teachid = obj[i].teachid;
                rdata.opentype = opentype;
                var mobj = obj[i].dates[j];
                rdata.date = mobj.date;
                rdata.times = mobj.times;
                dates.push(rdata);
            }
        } 
        return dates;
    }
    var is_insert_pt = false;
    var testcnt = 1;
    var alldata = [];
    function insertCalenderDatas(datas){
//        alldata = [];
        if(datas)
        for(i = 0; i < datas.length; i++) {
            if(datas[i].times)
            for(var j =0 ; j < datas[i].times.length; j++){
                var tdate = datas[i].date;
                var date = new Date(tdate);

                
                var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
                    y = date.getFullYear();
                    m = date.getMonth();  //
                    d = date.getDate();
                    hh = parseInt(datas[i].times[j].time);
                    mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                    start = new Date(y, m, d, hh, mm);
        //            end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
                    end = start;
                
                var today = getToday(); 
                var now = getToday(start);
                var isover = get_Day(today,now);//날짜가 지났는지 체크
                
                
                var isopenstr = datas[i].opentype == "close" ? "<text style='font-size:10px;color:#fcbb1d'>클로즈됨</text>" : "<text style='font-size:10px;color:#fcbb1d'>시간오픈</text>";
                
                
//                if(datas[i].times[j].members.length == 0) //타이틀 태그
                {
                    var titlebackimg = mColorImg.R_OPEN; // 일정만오픈
                    var timefontcolor = "red";
                    
//                    if(datas[i].opentype == "close"){
//                        titlebackimg = "linear-gradient(to bottom, #aa3333 0px, #aa1111 100%)";
//                        timefontcolor = "#e9e9e9";
//                        fontcolor = "#e9e9e9";
//                    }
//                    if(isover < 0){
//                        
//                        isopenstr = "<text style='font-size:10px;color:#fcbb1d'>기간만료</text>";
//                        var tcss = setDivType("over");
//                        titlebackimg = tcss.titlebackimg;
//                        timefontcolor =tcss.timefontcolor;
//                        fontcolor = tcss.fontcolor;
//                    }
                    //title = "("+datas[i].type+")"+datas[i].name+" "+isopenstr; //제목이지만 내용을 적으면 된다.
                    //title = datas[i].name+" "+isopenstr; //제목이지만 내용을 적으면 된다.
                    title = "<text style='font-size:10px;color:#fcbb1d'>시간오픈</text>";
                    
//                    clog("start "+start);
                
                    if(isover >= 0)
                    alldata.push({ title: title, name: datas[i].name ,teachid: datas[i].teachid, user: "", opentype: datas[i].opentype, start: start, end: end, allDay: allday,backgroundimage:titlebackimg });
                }
                
                for(var k = 0; k < datas[i].times[j].members.length;k++){
                    title = datas[i].times[j].members[k];   
                    
                    allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
                    y = date.getFullYear();
                    m = date.getMonth();  //
                    d = date.getDate();
                    hh = parseInt(datas[i].times[j].time);
                    mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                    start = new Date(y, m, d, hh, mm);
        //            end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
                    end = start;
                   
                   
                    var backimg = mColorImg.R_REQUEST; //10 예약신청
                    if(parseInt(datas[i].times[j].members[k].status) == 0){
                         backimg = mColorImg.R_USERCHECKED; //0 고객승인
                        
                    }

                     //운동완료상태 XXX
//                    if(datas[i].times[j].members[k].status && datas[i].times[j].members[k].status == 1){
//                        var tcss = setDivType("tranerfinish");
//                        backimg = tcss.titlebackimg;
//                        fontcolor = tcss.fontcolor;
//                    }
                    //완료
                    else if(datas[i].times[j].members[k].status && datas[i].times[j].members[k].status == 2){                        
                        backimg = mColorImg.R_FINISH;
                        
                    }
                    
//                    clog(start+"---------- note "+datas[i].times[j].members[k].note+" ress "+ getNoteInMininute(removeFreePTText(datas[i].times[j].members[k].note)));
                    var b_min = datas[i].times[j].members[k].min ? datas[i].times[j].members[k].min : getNoteInMininute(removeFreePTText(datas[i].times[j].members[k].note));
                    var b_date = new Date(y, m, d);
                    var b_uid = title.uid;
                    var b_status = title.status;
                    var b_couponid = title.couponid;
                    var b_datas =   {"date":b_date,"uid":b_uid,"status":b_status,"couponid":b_couponid};
                    alldata.push({type_ptgx : "PT",  title: title, teachid: datas[i].teachid , user: datas[i].times[j].members[k], opentype: datas[i].opentype,  start: start, end: end, allDay: allday,backgroundimage:backimg ,isover:isover,bdatas:b_datas,min:b_min});
                }
                
                
            }
            
        }
        var mid = param_teacheruid;
        clog("mem_teacher_alldata ",mem_teacher_alldata);
//        var userlessons = getAllPTs(mem_teacher_alldata[0].ready[0].dates);
        
        clog("000 userinfos ",userinfos);
        newuserinfos = trim_teacher_userinfos(mem_teacher_alldata,userinfos, mid);
        clog("111 newuserinfos ",newuserinfos);
        newuserinfos.sort(sort_by('name', false, (a) => a.toUpperCase()));//이름순 정렬
        setMonthUsers(newuserinfos);
        is_insert_pt = true;
        checkAllDataInsert();
        
        
        
//        if(isfirst){
//            alldata.sort(function(a, b) {return (+a.start) - (+b.start);});
//
//            $('#holder').calendar({
//                data: alldata
//            });
//            window.el = $('#holder');
//             isfirst = false;
//             
//         }else{
//            for(var i =0; i < alldata.length;i++)
//                window.options.data.push(alldata[i]);
//            if(window.mdraw)window.mdraw();
//         }
        
        
    }
//    function getAllPTs(dates){
//        var lessions = {}
//        for(var i = 0 ; i < dates.length;i++){
//            for(var j = 0 ; j < dates[i].times.length;j++){
//                for(var k = 0 ; k < dates[i].times[j].members.length;k++){
//                    var uid = dates[i].times[j].members[k].uid;
//                    var couponid = dates[i].times[j].members[k].couponid;
//                    var uid_couponid = uid+"_"+couponid;
//                    if(!lessions[uid_couponid])
//                        lessions[uid_couponid] = [];
//
//                    lessions[uid_couponid].push(dates[i].times[j].members[k]);
//                }
//            }
//            
//        }
//    }
    
    function checkAllDataInsert(){
        if(is_insert_pt && is_insert_gx){
          
            if(isfirst){
                alldata.sort(function(a, b) {return (+a.start) - (+b.start);});

                $('#holder').calendar({
                    data: alldata
                });
                window.el = $('#holder');
                 isfirst = false;

             }else{
                for(var i =0; i < alldata.length;i++)
                    window.options.data.push(alldata[i]);
                if(window.mdraw)window.mdraw();
             }
            
        }
    }
//    function setMonthUsers(month_users){
//        var select_users = document.getElementById("select_users");
//
//        month_users = trim_sort_2array(month_users,"uid");
//        month_users.sort(sort_by('name', false, (a) => a.toUpperCase()));
//        select_users.innerHTML = "<option value='0'>전체회원</option>";
//        for(var i = 0 ; i < month_users.length; i++){
//            var user = month_users[i];
//
//            var isselected = param_useruid && param_useruid == user.uid ? "selected" : "";
//            if( param_useruid && param_useruid == user.uid)label_title.innerHTML = user.name+" 예약표";
//            select_users.innerHTML+="<option value='"+user.uid+"' "+isselected+">"+user.name+"("+user.userid+")</option>";
//        }
//    }
     function getNoteInMininute(str){
//                clog("getNoteInMininute "+str);
               
                var result = "";
                var offset = 0; //0 : 대기  1 : 시작 : 2 종료
                for(var i = 0 ; i < str.length;i++){
                    if(offset == 1){
                        result += str[i];
                    }else if(offset == 2){
                        break;
                    }
                    if(str[i] == "시"){
                        offset = 1;
                    }
                    if(str[i] == "분"){
                        offset = 2;
                    }
                }
                return parseInt(result);
                return 0;
            }
            
    function setMonthUsers(month_users){
        
         month_users = trim_sort_2array(month_users,"uid");
        month_users.sort(sort_by('name', false, (a) => a.toUpperCase()));
        var selected_uid = "";
        var objs = [];
        var isselected = -1;
        var selected_uid = "";
//        clog("setMonthUsers!!");
        for(var i = 0 ; i < month_users.length; i++){
            var user = month_users[i];
            if(param_useruid && param_useruid == user.uid){
                isselected = i;  
                selected_uid = user.uid;
            } 
            var rectimgname = "";
            var isfree = checkFreePT(user.mbsprice,user.mbsname); //무료쿠폰인지 체크
            var eday =  get_Day(getToday(),user.endtime);
            if(isfree){
                rectimgname = "./img/icrect_freept.png";
            }else {
                //var isremainprice = user.remainprice && user.remainprice.remain && parseInt(user.remainprice.remain) > 0 ? true : false;
                var isremainprice = isRemain_Price(user);
                if(isremainprice) {
                    
                }
                if(eday < 0){
                    rectimgname = isremainprice ? "./img/icrect_ptoff_remainprice.png" : "./img/icrect_ptoff.png";
                }
                else {
                    rectimgname =  isremainprice ? "./img/icrect_pton_remainprice.png" : "./img/icrect_pton.png";
                }
            }
//            console.log("aaa user",user);
            if(isfree || !isfree && isPayrollUser(my_payroll_users, user.uid,user.id))
            objs.push({"value":user.uid,"text":user.name+"("+user.userid+")","imgname":rectimgname});
        }
        
        C_ComboBox("id_customcombobox","testid","전체회원",objs,0,0.8,"onselect_myusernew",isselected);
        displayUserCouponTable(selected_uid);
        
//        var select_users = document.getElementById("select_users");
//        month_users = trim_sort_2array(month_users,"uid");
//        month_users.sort(sort_by('name', false, (a) => a.toUpperCase()));
//        select_users.innerHTML = "<option value='0'>전체회원</option>";
//        var selected_uid = "";
//        for(var i = 0 ; i < month_users.length; i++){
//            var user = month_users[i];
//
//            var isselected = param_useruid && param_useruid == user.uid ? "selected" : "";
//            if(isselected){
//                selected_uid = user.uid;                
//            }
//            if( param_useruid && param_useruid == user.uid)label_title.innerHTML = user.name+" 예약표";
//            select_users.innerHTML+="<option value='"+user.uid+"' "+isselected+">"+user.name+"("+user.userid+")</option>";
//        }
//        displayUserCouponTable(selected_uid);
    }
    
    function isRemain_Price(user){
        var remainprice = user.remainprice && user.remainprice.remain && parseInt(user.remainprice.remain) > 0 ? parseInt(user.remainprice.remain) : 0;
        var result = false;
        if(remainprice && user.addcountdatas){
            var addremainprice = 0;
            for(var i = 0 ; i < user.addcountdatas.length;i++){
                if(user.addcountdatas[i].type == "remain"){
                    addremainprice += parseInt(user.addcountdatas[i].total_remain);
                }
            }
            result = remainprice - addremainprice > 0 ? true : false;
        }
        return result;
    }
    
    ////////////////////////////////////////////////////////////////////
    // GX START
    ////////////////////////////////////////////////////////////////////
    var is_insert_gx = false;
    var thisweek_reservation_count = 0;
    var totalgxroomcount = {};
    var totalgxroomusercount = {};
    function insertGXCalenderDatas(datas){   
//        alldata = [];
//        clog("datas is ",datas);
        var muid = param_teacheruid;
        
        //test
        var weeks = getThisWeek();
        
        if(datas)
        for(i = 0; i < datas.length; i++) {
            var roomdata = JSON.parse(datas[i].gx_roomdata);
            
           
                var tdate = roomdata.room_datetime;
                var date = getIOSDate(tdate);

                var title = roomdata.room_name; //제목이지만 내용을 적으면 된다.
                var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
              
                
                var y = date.getFullYear();
                var m = date.getMonth();  //
                var d = date.getDate();
                var hh = date.getHours();
                var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                
                var start = new Date(y, m, d, hh, mm);
                
                var sy = y;
                var sm = date.getMonth()+1 < 10 ? "0"+(date.getMonth()+1) : date.getMonth()+1;
                var sd = d < 10 ? "0"+d : d;
                var yyyymmdd = sy+"-"+sm+"-"+sd;
                var ym = y+"-"+(m+1);
               
           
           
                 if(roomdata.room_managerid == muid && roomdata.room_isshow == "1"){
                    if(!totalgxroomcount[ym])totalgxroomcount[ym] = {"maxroom":0,"nowroom":0};
                    totalgxroomcount[ym].maxroom++;    
                    if(roomdata.room_datetime && isNowTimeMinOver(roomdata.room_datetime) <= 0){
                        
                        totalgxroomcount[ym].nowroom++;    
                        if(!totalgxroomusercount[ym])totalgxroomusercount[ym] = 0;
                        totalgxroomusercount[ym] += roomdata.room_users ? roomdata.room_users.length : 0;    


                    }
                }
                
                
                var isthisweek = isThisWeek(yyyymmdd, weeks);
                var intype = getGXInType(roomdata.room_id,roomdata.room_users,roomdata.room_readyusers,roomdata.roommax); //   10: 오픈됨 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(내가없음) , 5 : 예약이 꽉참
                
                if(isthisweek && intype == 0 || isthisweek && intype == 2){
                    thisweek_reservation_count++;
                }
                    
                
                alldata.push({ type_ptgx : "그룹", title: title, start: start, roomdata:roomdata});
            
        }
//        console.log("totalgxroomcount ",totalgxroomcount);
        is_insert_gx = true;
        checkAllDataInsert();
        
        
        
//        alldata.sort(function(a, b) {
//            return (+a.start) - (+b.start);
//        });
//
//        //data must be sorted by start date
//
//        //Actually do everything
//        $('#holder').calendar({
//            data: alldata
//        });
//        window.el = $('#holder');


    }
    
    function show_roomdetail(room_starttime,roomid,hour,btntxt,room_name,room_managername,hour,roommin,str_roomusers,maxuser,txt_cntcolor,bgcolor,tdate,str_gxinfo,txt_startend){
       
        var users = JSON.parse(str_roomusers);
        var userlen = users.length;
        var gxinfo = JSON.parse(str_gxinfo);
//        clog("gxinfo ",gxinfo);
//        clog("users ",users);
        
        var global_gxinfo = getGlobalGXInfo(gxinfo.room_type);
        
        //intype 예약상태 강사와는 상관없음
        clog("show_roomdetail intype "+intype);
        //강좌이름
        var txt_roomname = "<div style='float:left;margin-top:-40px;'><text style='font-size:16px;color:white;font-weight:bold'>"+room_name+"</text></div>";
        //박스안 강사이름
        var txt_teacher_name = "<div style='position:absolute;margin-left:56px;margin-top:5px;'><text style='font-size:14px;color:white;'><b>"+room_managername+"</b> 강사</text></div>";
        //박스안 시간 
        var txt_time = "<div style='position:absolute;margin-left:26px;margin-top:20px;width:150px;height:30px'>"+
            "<img src='./img/icon_class_time.png' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+txt_startend+"</text></div>";

        //박스안 사진
        var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:1px'><img src='./img/arcicon_2.png' style='width:46px;height:46px;'/></div>";
        
        //박스안 인원 표시
        var txt_usercnt = "<div style='float:right;margin-top:10px;margin-right:5px;'><text style='font-size:20px;color:"+txt_cntcolor+";font-weight:600'>"+userlen+"/"+maxuser+"</text></div>";
        
        //박스
        var box = "<div style='font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:70px;background-color:"+bgcolor+";border-radius:10px'>"+arc_div+txt_teacher_name+txt_time+txt_usercnt+"</div>";
        //일,월,화,수,목,금,토
        var week = getDateOfWeek(tdate);
        //큰날짜
        var txt_date = "<text class='fmont' style='float:left;font-size:17px;color:white;'>"+tdate+". ("+week+") "+txt_startend+"</text>";
        //줄
        var hr_line = "<hr style='margin-top:20px;border: solid 1px #393939;'>";
        
       
        
        /////////////////////////////////////////////
        //예약가능시간   (방에 설정된 예약가능 , 취소시간)
        var reservation_min =  parseInt(gxinfo.room_reservationmin) == 0 ? "항상 예약가능" : "수업시작 "+gxinfo.room_reservationmin+"분 전까지 예약가능";
        var cancel_reservation_min = "수업시작 "+gxinfo.room_cancelreservationmin+" 분 전까지만 취소가능";
        
        //Global 예약가능시간    (현재 어드민에 설정되어있는 예약가능 ,취소시간)
//        var reservation_min =  parseInt(global_gxinfo.insertmaxtime) == 0 ? "항상 예약가능" : global_gxinfo.insertmaxtime+"분 전까지 예약가능";
//        var cancel_reservation_min = global_gxinfo.canceltime+" 분 전까지만 취소가능";
        /////////////////////////////////////////////
        
        var remain_thisweek_reservation_count = parseInt(global_gxinfo.gxmaxreservation) - thisweek_reservation_count < 0 ? 0 : parseInt(global_gxinfo.gxmaxreservation) - thisweek_reservation_count;
        var info_title = "<text style='float:left;font-size:14px;color:white;font-weight:500;margin-top:5px'>예약자 명단</text>";
        
//        var info_message = "<text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> 예약횟수: 주 "+global_gxinfo.gxmaxreservation+"회중 "+remain_thisweek_reservation_count+"회 예약가능</text>"+
//                          
//                           "<br><text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> 예약시간: "+reservation_min+"</text>"+
//                           "<br><text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> 취소시간: "+cancel_reservation_min+"</text>";
//                           "<br><text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> Note: "+gxinfo.room_note+"</text>";
        var info_message = "";
        
        
        
        
        //날짜가 안지났다면
       // var close_button_tag =  intype == 0 && isNowTimeMinOver(canceltime) > 0 || intype != 0 && isNowTimeMinOver(reservationtime) > 0 ? "<span onclick='' style='float:right;width:30px;height:30px'><img src = './img/button_calendar.png' style='width:12px;height:12px;margin-left:9px;margin-top:9px'></span>" : ""; 
        
        
       
        for(var i = 0 ; i < users.length;i++){
            var user = users[i];
            
            var intype = parseInt(user.status);
            var nexttype = getNextType(intype);
             var close_button_tag = isNowTimeMinOver(room_starttime) > 0 && isPermission(226) ? "<span onclick='remove_gxuser(\""+roomid+"\", \""+room_name+"\",  \""+hour+"\", \""+user.couponid+"\", \""+user.useruid+"\", \""+user.userid+"\", \""+user.username+"\", \""+user.starttime+"\", \""+user.endtime+"\", \""+nexttype+"\")' style='float:right;width:30px;height:30px'><img src = './img/button_calendar.png' style='width:12px;height:12px;margin-left:9px;margin-top:9px'></span>" : "";
            info_message += "<div style='height:30px'><text style='float:left;color:"+mColor.C919191+";font-size:14px;line-height:30px;'><span style='margin-left:5px;font-weight:bold'>&#183;</span><span style='color:#fffd00;font-weight:bold'>"+user.username+"</span>  ["+user.userid+"] "+user.starttime.substr(0,10)+" ~ "+user.endtime.substr(0,10)+"</text>"+close_button_tag+"</div>";
        }
      
                           
        var info_div = "<div align='left' style='width:100%;height:auto;'>"+info_title+"<br><br>"+info_message+"</div>";
        
        
        var cancel_title = "<div style='position:absolute;margin-left:16px;margin-top:20px;width:150px;height:30px'>"+
            "<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+hour+":"+roommin+"~"+hour+":"+roommin+"</text></div>";
        
        var date = window.options && window.options.date ? window.options.date.getTime() : "";
        var message = "<div style='padding-left:20px;padding-right:20px'>"+txt_roomname+box+"<br>"+txt_date+"<br>"+hr_line+""+info_div+"</div>";
        
        //날짜가 지났다면 확인버튼만 보여준다.
        var canceltime = nextMin(room_starttime,-parseInt(gxinfo.room_cancelreservationmin));
        var reservationtime = nextMin(room_starttime,-parseInt(gxinfo.room_reservationmin));
        if(intype == 0 && isNowTimeMinOver(canceltime) > 0 || intype != 0 && isNowTimeMinOver(reservationtime) > 0){
            
            var style = {
                button_type : "vertical",
                
                button_ispositionchange : true, 
                button_width : "90%",
                button_dark_bg : mColor.C111111,
                button_dark_text_decoration  : "underline",
                button_dark_text_color : mColor.C919191,

                size: {
                    width: "100%",
                    height: "100%"
                }

            };
            
            showModalDialog(document.body, "",message, "확인", null, function() {

               hideModalDialog();

            }, null,style);

        }
        //날짜가 안지났다면 취소 , 예약하기... 2개버튼을 보여준다.
        else {
            showModalDialog(document.body, "",message, "확인", null, function() {

               hideModalDialog();

            }, null);
        }
    }
    function remove_gxuser(roomid,room_name,hour,couponid,useruid,userid,username,starttime,endtime,nexttype){
        
        showModalDialog(document.body, "회원삭제",hour+"시 "+room_name+" 방에서 "+username+" 회원을 삭제하시겠습니까?", "삭제하기", "취소", function() {

            send_gxuser(roomid,couponid,useruid,userid,starttime,endtime,nexttype,function(res){
                if(res != null){
                    alertMsg(res,function(){
                        reload_calendar_page();
                    });
                }else
                    alertMsg("네트워크 에러");
            });
            
              
        }, function(){
           hideModalDialog();
        });

         
    }
    function getNextType(intype){
        var nexttype = 0; //예약하기
        if(intype == 0)nexttype = 10; //취소해서 다시 원래대로 돌리기
        if(intype == 4)nexttype = 5; //꽉차서 대기신청하기
        if(intype == 5)nexttype = 4; //꽉차서 대기신청하기
        return nexttype;
    }
    function getGXInType(roomid,users,readyusers,max){
        var muid = param_teacheruid;
        var isin = false;
        var isreadyin = false;
        var ismax = users && users.length >= max ? true : false;
        var isqrcheck = false;
        if(users)
        for(var i = 0 ; i < users.length; i++){
            if(users[i].useruid == muid){
                isin = true;
                if(parseInt(users[i].status) == 2)//QR출석체크완료
                    isqrcheck = true;
                break;
            }    
        }
        if(readyusers)
        for(var i = 0 ; i < readyusers.length; i++){
            if(readyusers[i].useruid == muid){
                isreadyin = true;
                break;
            }    
        }

        //   10 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  , 3 : 예약된상태 , 5 : 예약이 꽉참
        var intype = 10; // 예약안된 대기상태 PT와 코드를 맞추려고 10으로 설정함
        if(isin){                    
            intype = isqrcheck ? 2 : 0; // 예약된 상태                      
        } 
        if(ismax && !isin){
            intype = isreadyin ? 5 : 4; //강좌꽉참 대기신청해야함
        } 
        return intype;
    }
    function isThisWeek(date,weeks){
        var flg = false;
        for(var i = 0 ; i < weeks.length;i++){
            if(weeks[i] == date){
                flg = true;
                break;
            }
        }
        return flg;
    }
    //이번주 날짜 모두구하기
    function getThisWeek(){
        var currentDay = new Date();  
        var theYear = currentDay.getFullYear();
        var theMonth = currentDay.getMonth();
        var theDate  = currentDay.getDate();
        var theDayOfWeek = currentDay.getDay();

        var thisWeek = [];

        for(var i=0; i<7; i++) {
          var resultDay = new Date(theYear, theMonth, theDate + (i - theDayOfWeek));
          var yyyy = resultDay.getFullYear();
          var mm = Number(resultDay.getMonth()) + 1;
          var dd = resultDay.getDate();

          mm = String(mm).length === 1 ? '0' + mm : mm;
          dd = String(dd).length === 1 ? '0' + dd : dd;

          thisWeek[i] = yyyy + '-' + mm + '-' + dd;
        }
//        clog("thisWeek ",thisWeek);
        return thisWeek;
 
    }
    function getGlobalGXInfo(roomtype){
        var gxinfo = null;
        for(var i = 0 ; i < gxtypes.length; i++){
            if(parseInt(roomtype) == parseInt(gxtypes[i].id)){
                gxinfo = gxtypes[i];
                break;
            }
        }
        return gxinfo;
    }
    function send_gxuser(roomid,couponid,useruid,userid,starttime,endtime,intype,callback){
        //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
        
        var value = {
            "inserttime":"",
            "couponid" : couponid,
            "username" : username,
            "useruid" : useruid,
            "userid" : userid,
            "starttime" : starttime,
            "endtime" : endtime,
            "status" : intype
        };
//        var _data = {
//            "type": "insertgxteacher", // group or center or auth
//            "centercode": param_centercode,
//            "value" : {"user": value,"roomid":roomid}
//        };
//        CallHandler("my_gxreservation", _data, function (res) {
//            code = parseInt(res.code);
//            clog("insergxuser res is ", res);
//            if (code == 100) {
//                callback(res.message);
//
//            } else {
//                callback(null);
//            }
//
//        }, function (err) {
//             callback(null);
//
//        });    

    }
    ////////////////////////////////////////////////////////////////////
    // GX END
    ////////////////////////////////////////////////////////////////////
    
    
    
    
    var first_goto_day = false;
    if(!first_goto_day && param_day){
        
        var fInterval = setInterval(function(){
            if(!isfirst){
                // 달력으로 이동한다.테스트
                window.options.mode = "day";
                var date = new Date(parseInt(param_day));
                window.options.date = date;
    //            window.calendar(window.el,window.options);
                if(window.mdraw)window.mdraw();
                    first_goto_day = true;
                clearInterval(fInterval);
            }
        },100);
        
    }
    
    //mode == day 라면 해당날짜로 간다.
    function reload_calendar_page(centercode){
        if(centercode)param_centercode = centercode;
        var mode = window.options && window.options.mode ? window.options.mode : "month";
        var date = window.options && window.options.date ? window.options.date.getTime() : "";
        param_day = mode == "day" ? date : "";
        refresh_page("?centercode="+param_centercode+"&teacheruid="+param_teacheruid+"&teacherid="+param_teacherid+"&teachername="+param_teachername+"&useruid="+select_useruid); 
    }
</script>
