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
//             var MetaTag = document.createElement("META");
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <link href="./css/modaldialog.css?var1.02" rel="stylesheet">
    
   <!--    당겨서 새로고침-->
    <script src="./libs/pulltorefresh/pulltorefresh.js"></script><!-- Page Pull to Refresh 스크립트 -->
    <script src="./libs/pulltorefresh/touch-emulator.js"></script><!-- Page Pull to Refresh 스크립트 -->
    <link rel="stylesheet" href="./libs/pulltorefresh/pulltorefreshstyle.css">
    
    
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
    
    
    <script src="js/scripts.js?ver3.02rrb5"></script>

     <!--swipe-->
<!--
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
-->
    <link href="./libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="./libs/swiper/swiper-bundle.min.js"></script>
    
    <!--
<link rel="stylesheet" href="./css/layout.css"/>
<link rel="stylesheet" href="./css/sub.css"/>
-->

    <link rel="stylesheet" href="./css/calendar.css?var1.02" />
    <style>
        @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
        @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}
    
        body {
/*            font-family: 'Noto Sans KR', sans-serif;*/
             font-family: 'Noto Sans KR', sans-serif;
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
    </style>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->





</head>

<body style="background-color:#111111;" >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    
    <div id='div_center_list' style='position:fixed;width:100%;height:50px;background-color:#111111;z-index:999'>
        <div align="center" style="width:100%;height:60px;position:fixed;z-index:999;background-color:#111111;border-bottom:1px solid #292929">
            <text id='txt_title' style="color:white;text-align:center;font-size:20px;height:100%;line-height:60px;">예약</text>
            <img id='icon_gxlist' src='./img/icon_gxlist.png' style="width:25px;height:25px;margin-top:-5px;visibility:hidden" onclick="showAllGXCouponList()"/> 
            <img id='icon_ptlist' src='./img/icon_ptlist.png' style="width:25px;height:25px;margin-top:-5px;visibility:hidden" onclick="showAllPTCouponList()"/>
            <div onclick='androidBack()' style='float:left;width:60px;height:60px;'><img src='./img/button_back_sub.png' style='float:left;margin-left:20px;margin-top:20px;width:9px;height:18px;'/></div>
            <div onclick='reload_calendar_page()' style='float:right;width:60px;height:60px;margin-right:7px'><img src='./img/button_reload.png' width='31px' height='30px'style="margin-top:15px;"/></div>
            
        </div>

    </div>
    <div align='center' style='position:absolute;width:100%;margin-top:64px'><text style='color:#fffd00;text-align:left;font-size:11px;color:#afafaf;'><img src="./img/guide_arrow.png" style="width:7px;height:7px;margin-top:-3px"/>&nbsp;&nbsp;화면을 아래로 당겨서 새로고침하세요.</text></div>
    <div id="main" style='margin-top:60px'>
        
<!--        <label style="font-size:12px;color:#fffd00;padding-left:20px;">*화면을 아래로 당겨서 새로고침</label>-->
        <div id="container" class="container" >
            
        </div>
        
        <div id="reservation_container"style="display:none;">
            <div id="reservation_center">

                <div style='padding-left:10px;padding-right:10px'>
                    <div id ='div_manager_box'  style='width:100%;height:100px;background-image:url(./img/box_mybooking.png);border:0px;background-size:100% 100%;padding:20px 10px 20px 10px'>
                        <div id='div_arc_count' style='float:right;padding-left:10px;padding-right:10px;'>
                            <div align="center" style='width:70px;height:70px;background-color:#202020;margin-top:-7px;border-radius:35px'>
                                <div style='padding-top:17px'><text style="text-align:bottom;color:#919191;font-size:11px;">사용 횟수</text></div>
                                <div style='margin-top:3px'><text id='txt_ptcount' style='font-size:16px;color:white;'><span style='color:#fffd00;font-weight:bold'>0</span>/0</text></div>
                            </div>
                        </div>
                        <div style='width:100%;margin-top:-3px;padding-left:10px;padding-right:10px;'><text style="font-size:15px;color:#fffd00" id ="manager_name">홍길동</text></div>

                        <div  style='width:100%;margin-top:5px;padding-left:10px;padding-right:10px;'><text style="font-size:13px;color:white" id ="coupon_info">0회중 0회 진행</text><text class='fmont' id='txt_gx_startend' style='color:#919191;font-size:11px;float:right;display:none'></text></div>

                        <div style='width:100%;margin-top:6px;padding-left:10px;padding-right:10px;'><text class='fmont' style="color:#919191;font-size:11px" id ="coupon_startend">2020-01-01~2020-01-01</text></div>
                        <div id='div_gx_use4count' style='width:100%;height:auto;padding-left:1px;padding-right:1px;margin-top:15px;display:none'>
                            <table style='width:100%;color:white;font-size:10px;font-weight:400;'>
                                <tr>
                                    <td style='width:25%;padding-left:10px'>
<!--                                        <img src='./img/gx_icon_register.png' style='width:16px;height:16px;margin-left:5px'>-->
                                        <text style='font-size:10px'>등록횟수</text><text id='txt_gx_allcount' style='float:right;color:#fffd00;font-size:11px;font-weight:700;'>0</text>
                                    </td>
                                    <td style='width:25%;padding-left:10px'>
<!--                                        <img src='./img/gx_icon_usecount.png' style='width:16px;height:16px;margin-left:5px'>-->
                                        <text>사용횟수</text><text id='txt_gx_usecount' style='float:right;color:#fffd00;font-size:11px;font-weight:700;'>0</text>
                                    </td>
                                    <td style='width:25%;padding-left:10px'>
<!--                                        <img src='./img/gx_icon_reservationcount.png' style='width:16px;height:16px;margin-left:5px'>-->
                                        <text>예약횟수</text><text id='txt_gx_reservationcount' style='float:right;color:#fffd00;font-size:11px;font-weight:700;'>0</text>
                                    </td>
                                    <td style='width:25%;padding-left:10px;padding-right:10px'>
<!--                                        <img src='./img/gx_icon_remaincount.png' style='width:16px;height:16px;margin-left:5px'>-->
                                        <text>잔여횟수</text><text id='txt_gx_remaincount' style='float:right;color:#fffd00;font-size:11px;font-weight:700;'>0</text>
                                    </td>
                                    
                                </tr>
                            </table>
                        </div>
                        <div id="div_pt_info" style='width:100%;height:35px;border-top:1px solid #333333;margin-top:10px;display:none;padding-left:10px;padding-right:10px'> </div> 
                    </div>
                </div>
                <!--색깔별로 예약현황 알려줌-->
                <div align="center" style="margin-top:10px">
                    <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#fcbb1d'></rect></svg>&nbsp;<text id='icon_txt_1' style='font-size:13px;color:white'>일정오픈</text>&nbsp;&nbsp;
                    <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#2cc174'></rect></svg>&nbsp;<text id='icon_txt_2' style='font-size:13px;color:white'>예약</text>&nbsp;&nbsp;
                    <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#5c6cf3'></rect></svg>&nbsp;<text id='icon_txt_3' style='font-size:13px;color:white'>고객승인</text>&nbsp;&nbsp;
                    <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#eb703b'></rect></svg>&nbsp;<text id='icon_txt_4' style='font-size:13px;color:white'>완료</text>&nbsp;&nbsp;      
                    <svg style='width:10px;height:10px'><rect width='10' height='10' rx='5' ry='5' style='fill:#919191'></rect></svg>&nbsp;<text id='icon_txt_5' style='font-size:13px;color:white'>다른회원권</text>&nbsp;&nbsp;      
                </div>
                <br>
                
                
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
    <script>TouchEmulator()</script>
    <script>
        console.log("m_my_reservatin_view.php");
        var zoom = setZoom();
        var issliding = 0;
         var mySwiper = new Swiper('.swiper-container', {
            //최초 페이지 설정
            initialSlide: 1,
             //감도
             threshold:40, 
            speed: 200,
//             effect: 'slide',
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
//             else if(eventName == "slidePrevTransitionEnd" || eventName == "slideNextTransitionEnd"){
//                 const swipe = this;
//                 
//                 if(issliding == 1){
//                     setTimeout(function(){
//                         swipe.slideTo(1,50);
//                           issliding = 0;
//                     },100);
//                 }
//             }
           }
        });
      
        
        //안드로이드 뒤로가기이다.
        function androidBack(){
            if(window.options && window.options.mode && window.options.mode == "day"){
                window.options.mode = "month";
                window.calendar(window.el,window.options,"month");
            }else if(ismullticoupons && !isshow_couponlist){
//                isshow_couponlist = true;
//                
//                document.getElementById("container").style.display = "block";
//                document.getElementById("reservation_container").style.display = "none";  
                reload_calendar_page();
            }
            else{
                call_app();
            }
        }
        
        var isfirst = true;
        var param_centercode = getParam("centercode");
        var param_day = getParam("day");
    
        var calendar_data = null;
//        var reservationinfo = null;
        var reservationinfo = null;
        var container = document.getElementById("container");
        
        var selected_pt_coupon = null;
        var selected_gx_coupon = null;
        
        var allgxcoupons = [];
        var allgxreservation = [];
        var membership_coupons = [];
        //당겨서 새로고침
        PullToRefresh.init({
            mainElement: '#main',
            onRefresh: function() { 
//                refresh_page("?centercode="+param_centercode+"&day="+param_day); 
                reload_calendar_page();
            }
        });
        
        var all_reservation =[];
        
        var data = {
            type: "myreservation"           
        }
        
        var isptcoupon = false;
        var isgxcoupon = false;
        
        var ismullticoupons = false; //PT쿠폰 기준으로 표시한다.
        var isshow_couponlist = false; //현재 센터목록이 보이는지 , 달력이 보이는지 체크
        
        CallHandler("my_reservation", data, function(res) {
        var code = parseInt(res.code);
      
        if (code == 100) {
            clog("myreservation res  ",res);
            
            //양도나 ,삭제 , 환불된 쿠폰인지 체크한다.
//            for(var i = 0 ; i < res.gxcoupons.length; i++){
//                var isdelete = res.gxcoupons[i].isdelete && res.gxcoupons[i].isdelete != "N" ? true : false;                    
//                if(!isdelete)allgxcoupons.push(res.gxcoupons[i]);                
//            }
            
            
//            allgxcoupons = res.gxcoupons;
            allgxcoupons = checkUsingCoupon(res.gxcoupons);
            selected_gx_coupon = getGXCoupon();
            if(res.membership_coupons)membership_coupons = res.membership_coupons;
//            clog("allgxcoupons  ",allgxcoupons);
            if(res.message == "" && allgxcoupons.length == 0){
//               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
                alertMsg("회원권 목록이 없습니다.",function(){
                    call_app();
                });
                return;
            }
           
            if(allgxcoupons.length > 1)document.getElementById("icon_gxlist").style.visibility = "visible";
            
            ////////////////////////////////////////////
            // 삭제된 쿠폰이나 횟수를 모두 사용한 쿠폰 , 양도한 쿠폰 은 보여주지 않는다.
            ////////////////////////////////////////////
//            
//            var json_array = [];
//            
//           // var array = JSON.parse(res.message);
//            var array = res.message;
//           
//            
//            for(var i = 0 ; i < array.length; i++){
//                 var json = array[i];
//                 var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
//                var isdelete = json.isdelete && json.isdelete == "D" ? true : false;
//                var issended = json.issendedcoupon && json.issendedcoupon == -1 ? true : false;
//                var usecount = parseInt(json.usecount);
////                clog("maxcount "+maxcount+" usecount "+usecount);
//                //if(usecount < maxcount && !isdelete)
//                if(!isdelete && !issended)
//                    json_array.push(json);
//            }
//            all_reservation = json_array;
            
            
            all_reservation = checkUsingCoupon(res.message);
            
//            if(all_reservation.length > 1)document.getElementById("icon_ptlist").style.visibility = "visible";
            
             if(all_reservation.length > 0 )isptcoupon = true;
            else is_insert_pt = true;
            
            ////////////////////////////////////////////
            // 삭제된 쿠폰이나 횟수를 모두 사용한 쿠폰은 보여주지 않는다.
            ////////////////////////////////////////////
//               document.write(res.message);
            var container = document.getElementById("container");
            var br0 = document.createElement('br');  
            container.innerHTML = "";
            
//            clog("all_reservation.length "+all_reservation.length);
            if(all_reservation.length == 0 && allgxcoupons.length == 0){
                alertMsg("회원권 목록이 없습니다.",function(){
                    call_app();
                });
                
                return;
            }
            else if(all_reservation.length == 1){   
                
                getPTTeacher(all_reservation[0],1);
                
            }
            else if(all_reservation.length > 1){
                if(all_reservation.length > 1 ){
                    ismullticoupons = true;
                    isshow_couponlist = true;
                }
                
                for(var i = 0 ; i < all_reservation.length; i++){
                    const json = all_reservation[i];
                    var title = json.manager ? json.manager : "담당자 미지정";
                    if(json.mbstype == TYPE_GX){
                        title = json.mbsname;
                    }
                    var isboxon = getIsBoxOn(json);
                    
                    var regtime = json.id ? json.id.substr(0,10) : ""; // 아이폰때문에 무조건 substr 이다.
                    var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
                    var usecount = json.usecount ? json.usecount : 0;
                   
                    
                    
//                    var isdisabled = json.isdelete  && json.isdelete == "D" || isgxcoupon && !json.manager ? "disabled" : "";
                    
                    var font_color = "white";
                    var font_gray_color = "#afafaf";
                    var font_yellow_color = "#fffd00";
                    var btn_text = "예약하기";
                    var img_boxurl = "./img/thumb_PT.png";
                    var img_iconurl = "./img/icon_membership.png";
                    
                    var etag = "</div></div>";
                    //삭제됐거나 담당자가 없다면
                    if(json.isdelete  && json.isdelete == "D" || isgxcoupon && !json.manager){
                        font_color = "#5f5f5f";
                        font_gray_color = "#5f5f5f";
                        font_yellow_color = "#555000";
                        btn_text = "";
                        img_boxurl = "./img/thumb_PT_off.png";
                        img_iconurl = "./img/icon_membership_off.png";
                    }
                    //횟수를 모두 채웠다면 비활성
                    else if(maxcount == usecount){
                        font_color = "#5f5f5f";
                        font_gray_color = "#5f5f5f";
                        font_yellow_color = "#555000";
                        btn_text = "";
                        img_boxurl = "./img/thumb_PT_off.png";
                        img_iconurl = "./img/icon_membership_off.png";
                        
                    }
                    else {
                        isboxon = 1;
                    }
                    
                    var title_tag = "<div style='padding:12px;width:100%;height:auto'>"+
                                        "<img src='"+img_boxurl+"' style='float:left;width:53px;height:53px'>"+
                                        "<text style='float:left;margin-left:12px;margin-top:5px;text-align:left;font-size:14px;color:"+font_color+"'>"+title+" <span class='fmont' style='color:"+font_gray_color+";font-weight:400;'>["+regtime+"]</span></text>"+
                                    "</div>";
                    var subtitle_tag = "<div style='margin-top:16px;width:100%;height:30px'>"+
                                            "<img src='"+img_iconurl+"' style='float:left;width:16px;height:13px;margin-top:2px;margin-left:12px;margin-right:7px'>&nbsp;<label style='float:left;text-align:left;font-size:14px;color:"+font_color+";margin-left;6px'> <span style='color:"+font_yellow_color+";'>"+usecount+"</span>회 이용/ 총 "+maxcount+"회</label>"+
                                        "</div>";
                    var btn_tag = "<button class='btn' style='border:0px;outline:none;width:287px;height:43px;border-radius:10px;background-color:#191919;padding:10px;font-size:15px;color:"+font_color+"'>"+btn_text+"</button>";
                    var ftag = "<div style='padding:10px' align='center'><div onclick='clickReservation("+i+", "+isboxon+")' style='width:100%;height:133px;background-image:url(./img/box_membership.png);border:0px;background-size:100% 100%;'><text style='text-align:center;color:"+font_color+";font-size:13px'>";
                    container.innerHTML += ftag+title_tag+subtitle_tag+btn_tag+etag;
                }
            }
            //PT 없이 GX 회원권만 1개이상 있다.
            else {
                getGXDatas();
            }
            
            
           
        } else {
            alertMsg(res.message);
            
//            show_error_popup("ERROR",res.message, "exit");
        }

    }, function(err) {
        alertMsg("네트워크 에러 ");
//         show_error_popup("ERROR","네트워크 에러", "exit");
    });
        
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
    function checkUsingCoupon(coupons){
        var json_array = [];

        // var array = JSON.parse(res.message);
        var array = coupons;


        for(var i = 0 ; i < array.length; i++){
             var json = array[i];
             var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
            var isdelete = json.isdelete && json.isdelete == "D" ? true : false;
            var issended = json.issendedcoupon && json.issendedcoupon == -1 ? true : false;
            var usecount = parseInt(json.usecount);
            var endtime = getTotalEndtime(json);
        //                clog("maxcount "+maxcount+" usecount "+usecount);
            //if(usecount < maxcount && !isdelete)
            if(!isdelete && !issended){
                json_array.push(json);
            }
                
        }
        json_array.sort(sort_by('endtime', true, (a) => a.toUpperCase()));   
        return json_array;
    }
        
    function showAllGXCouponList(){
        var json_array = allgxcoupons;
        var list_tag = "";
        if(json_array.length > 1){
                if(json_array.length > 1 ){
                    ismullticoupons = true;
                    isshow_couponlist = true;
                }
                
                for(var i = 0 ; i < json_array.length; i++){
                    const json = json_array[i];
                    console.log("json is ",json);
                    if(json.issendedcoupon && json.issendedcoupon == -1 || json.isdelete  && json.isdelete == "D")continue;
                    
                    var title = title = json.mbsname;
                    
                    var isboxon = getIsBoxOn(json);
                    
                    var regtime = json.id ? json.id.substr(0,10) : ""; // 아이폰때문에 무조건 substr 이다.
                    var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
                    var usecount = json.usecount ? parseInt(json.usecount) : 0;
                    var starttime = json.starttime;
                    var endtime = getTotalEndtime(json);
                    
                    
//                    var isdisabled = json.isdelete  && json.isdelete == "D" || isgxcoupon && !json.manager ? "disabled" : "";
                    
                    var font_color = "white";
                    var font_gray_color = "#afafaf";
                    var font_yellow_color = "#fffd00";
                    var btn_text = "기간: "+json.starttime.substr(0,10)+" ~ "+getTotalEndtime(json).substr(0,10);
                    var img_boxurl = "./img/thumb_GX.png";
                    var img_iconurl = "./img/icon_membership.png";
                    
                    var etag = "</div></div>";
                    console.log("isNowTimeOver(endtime) ",isNowTimeOver(endtime));
                    //삭제됐거나 담당자가 없다면
                    if(json.isdelete  && json.isdelete == "D" || json.issendedcoupon && parseInt(json.issendedcoupon) < 0 || usecount >= maxcount || isNowTimeOver(endtime) == -1){
                        font_color = "#5f5f5f";
                        font_gray_color = "#5f5f5f";
                        font_yellow_color = "#555000";
//                        btn_text = "";
                        img_boxurl = "./img/thumb_GX_off.png";
                        img_iconurl = "./img/icon_membership_off.png";
                    }
//                    //횟수를 모두 채웠다면 비활성
//                    else if(usecount >= maxcount && !isNowTimeOver(endtime)){
//                        font_color = "#5f5f5f";
//                        font_gray_color = "#5f5f5f";
//                        font_yellow_color = "#555000";
//                        btn_text = "";
//                        img_boxurl = "./img/thumb_GX_off.png";
//                        img_iconurl = "./img/icon_membership_off.png";
//                        
//                    }
                    else {
                        isboxon = 1;
                    }
                    
                    var title_tag = "<div style='padding:12px;width:100%;height:auto'>"+
                                        "<img src='"+img_boxurl+"' style='float:left;width:53px;height:53px'>"+
                                        "<text style='float:left;margin-left:12px;margin-top:5px;text-align:left;font-size:14px;color:"+font_color+"'>"+title+" <span class='fmont' style='color:"+font_gray_color+";font-weight:400;'>["+regtime+"]</span></text>"+
                                    "</div>";
                    
                    var uid_couponid = user_uid+"_"+json.id;
                    var user_usecount = getGXCouponUseCount(uid_couponid,usecount);
                    var subtitle_tag = "<div style='margin-top:16px;width:100%;height:30px'>"+
                                            "<img src='"+img_iconurl+"' style='float:left;width:16px;height:13px;margin-top:2px;margin-left:12px;margin-right:7px'>&nbsp;<label style='float:left;text-align:left;font-size:14px;color:"+font_color+";margin-left;6px'> <span style='color:"+font_yellow_color+";'>"+user_usecount+"</span>회 이용/ 총 "+maxcount+"회</label>"+
                                        "</div>";
                    var btn_tag = "<button class='btn' style='border:0px;outline:none;width:287px;height:43px;border-radius:10px;background-color:#191919;padding:10px;font-size:15px;color:"+font_color+"'>"+btn_text+"</button>";
                    var ftag = "<div style='padding:10px' align='center'><div style='width:100%;height:133px;background-image:url(./img/box_membership.png);border:0px;background-size:100% 100%;'><text style='text-align:center;color:"+font_color+";font-size:13px'>";
                    list_tag += ftag+title_tag+subtitle_tag+btn_tag+etag;
                }
            
        } 
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

        showModalDialog(document.body, "GX목록",list_tag, "확인", null, function() {

          hideModalDialog();

        }, null,style);
    }
    
        
        
    function showAllPTCouponList(){
            var json_array = all_reservation;
            var list_tag = "";
            if(json_array.length > 1){
                if(json_array.length > 1 ){
                    ismullticoupons = true;
                    isshow_couponlist = true;
                }
                
                for(var i = 0 ; i < json_array.length; i++){
                    const json = json_array[i];
                    console.log("json is ",json);
                    if(json.issendedcoupon && json.issendedcoupon == -1 || json.isdelete  && json.isdelete == "D")continue;
                    
                    var title = title = json.mbsname;
                    
                    var isboxon = getIsBoxOn(json);
                    
                    var regtime = json.id ? json.id.substr(0,10) : ""; // 아이폰때문에 무조건 substr 이다.
                    var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
                    var usecount = json.usecount ? json.usecount : 0;
                   
                    
                    
//                    var isdisabled = json.isdelete  && json.isdelete == "D" || isgxcoupon && !json.manager ? "disabled" : "";
                    
                    var font_color = "white";
                    var font_gray_color = "#afafaf";
                    var font_yellow_color = "#fffd00";
                    var btn_text = "기간: "+json.starttime.substr(0,10)+" ~ "+getTotalEndtime(json).substr(0,10);
                    var img_boxurl = "./img/thumb_PT.png";
                    var img_iconurl = "./img/icon_membership.png";
                    
                    var etag = "</div></div>";
                    //삭제됐거나 담당자가 없다면
                    if(json.isdelete  && json.isdelete == "D" || json.issendedcoupon && parseInt(json.issendedcoupon) < 0){
                        font_color = "#5f5f5f";
                        font_gray_color = "#5f5f5f";
                        font_yellow_color = "#555000";
                        btn_text = "";
                        img_boxurl = "./img/thumb_PT_off.png";
                        img_iconurl = "./img/icon_membership_off.png";
                    }
                    //횟수를 모두 채웠다면 비활성
                    else if(maxcount == usecount){
                        font_color = "#5f5f5f";
                        font_gray_color = "#5f5f5f";
                        font_yellow_color = "#555000";
                        btn_text = "";
                        img_boxurl = "./img/thumb_PT_off.png";
                        img_iconurl = "./img/icon_membership_off.png";
                        
                    }
                    else {
                        isboxon = 1;
                    }
                    
                    var title_tag = "<div style='padding:12px;width:100%;height:auto'>"+
                                        "<img src='"+img_boxurl+"' style='float:left;width:53px;height:53px'>"+
                                        "<text style='float:left;margin-left:12px;margin-top:5px;text-align:left;font-size:14px;color:"+font_color+"'>"+title+" <span class='fmont' style='color:"+font_gray_color+";font-weight:400;'>["+regtime+"]</span></text>"+
                                    "</div>";
                    var subtitle_tag = "<div style='margin-top:16px;width:100%;height:30px'>"+
                                            "<img src='"+img_iconurl+"' style='float:left;width:16px;height:13px;margin-top:2px;margin-left:12px;margin-right:7px'>&nbsp;<label style='float:left;text-align:left;font-size:14px;color:"+font_color+";margin-left;6px'> <span style='color:"+font_yellow_color+";'>"+usecount+"</span>회 이용/ 총 "+maxcount+"회</label>"+
                                        "</div>";
                    var btn_tag = "<button class='btn' style='border:0px;outline:none;width:287px;height:43px;border-radius:10px;background-color:#191919;padding:10px;font-size:15px;color:"+font_color+"'>"+btn_text+"</button>";
                    var ftag = "<div style='padding:10px' align='center'><div style='width:100%;height:133px;background-image:url(./img/box_membership.png);border:0px;background-size:100% 100%;'><text style='text-align:center;color:"+font_color+";font-size:13px'>";
                    list_tag += ftag+title_tag+subtitle_tag+btn_tag+etag;
                }
        } 
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

        showModalDialog(document.body, "PT목록",list_tag, "확인", null, function() {

          hideModalDialog();

        }, null,style);
    }
    function getIsBoxOn(json){
        
         var regtime = json.id ? json.id.substr(0,10) : ""; // 아이폰때문에 무조건 substr 이다.
        var freecount = json.mbsfreecount ? parseInt(json.mbsfreecount) : 0;
        var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + freecount : getMbsMaxCount(json);
        var usecount = json.usecount ? json.usecount : 0;
        var isboxon = 0;
        if(json.isdelete  && json.isdelete == "D" || isgxcoupon && !json.manager){
        }
        else if(maxcount == usecount){
        }
        else {
            isboxon = 1;
        }
        return isboxon;
                   
    }    
    function clickReservation(idx,isboxon){
        
        getPTTeacher(all_reservation[idx],isboxon);
        
    }    
    var nowptcoupon = null;    
    var nowgxcoupon = null;    
    
    var nowcentercode = "";
    var gxtypes = null;
    var gxteachers = null;
        
    //GX회원권이 있는지 체크한다.    
    function getGXCoupon(){
        var selectgxcoupon = null;
            if(allgxcoupons.length > 0){
                
               
                
                
                for(var i = 0 ; i < allgxcoupons.length; i++){
                    var starttime = allgxcoupons[i].starttime;
                    var endtime = getTotalEndtime(allgxcoupons[i]);
                    //기간내에 있는 쿠폰이라면  s <  now  < e
                    if(!(allgxcoupons[i].isdelete && allgxcoupons[i].isdelete == "D" || allgxcoupons[i].issendedcoupon && allgxcoupons[i].issendedcoupon == -1))
                    if(isNowTimeMinOver(starttime) <= 0 && isNowTimeMinOver(endtime) >= 0 ){
                        selectgxcoupon = allgxcoupons[i];
                        break;   
                    }
                    
                }
                if(selectgxcoupon == null)
                for(var i = 0 ; i < allgxcoupons.length; i++){
                    var starttime = allgxcoupons[i].starttime;
                    var endtime = getTotalEndtime(allgxcoupons[i]);
                    //아직 시작전 쿠폰이라면  now  < s < e
                    if(!(allgxcoupons[i].isdelete && allgxcoupons[i].isdelete == "D" || allgxcoupons[i].issendedcoupon && allgxcoupons[i].issendedcoupon == -1))
                    if(isNowTimeMinOver(starttime) > 0 && isNowTimeMinOver(endtime) > 0){
                        selectgxcoupon = allgxcoupons[i];
                        break;   
                    }              
                }
                if(selectgxcoupon == null)
                for(var i = 0 ; i < allgxcoupons.length; i++){
                    var starttime = allgxcoupons[i].starttime;
                    var endtime = getTotalEndtime(allgxcoupons[i]);
                    //기간이 지난 쿠폰이라면 
                    if(!(allgxcoupons[i].isdelete && allgxcoupons[i].isdelete == "D" || allgxcoupons[i].issendedcoupon && allgxcoupons[i].issendedcoupon == -1))
                    if(isNowTimeMinOver(starttime) < 0 && isNowTimeMinOver(endtime) < 0){
                        selectgxcoupon = allgxcoupons[i];
                        break;   
                    }              
                }
                //최종적으로 첫번째 쿠폰을 등록한다.
                if(selectgxcoupon == null)selectgxcoupon = allgxcoupons[0];
            }
        if(selectgxcoupon)isgxcoupon = true;
        else is_insert_gx = true; 
        return selectgxcoupon;
    }
    function getPTTeacher(rjson,isboxon){
        
       isshow_couponlist = false;
        clog("rjson ",rjson);
        selected_pt_coupon = rjson;
        var teachername = rjson.manager;
        var teacheruid = rjson.managerid;
        var teachtype = rjson.mbstype;
        
        var txt_title = document.getElementById("txt_title");
        txt_title.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PT 예약";
//        var centercode = rjson.mbsusecentercode;
        nowcentercode = rjson.mbsusecentercode;
        param_centercode = nowcentercode;
        nowptcoupon = rjson;
        
        //PT일때 강사없을때 GX도 없을때 
        if(teachtype == "PT" && !teacheruid){
            alertMsg("아직 담당 강사가 선택되지 않았습니다.");
            return;
        }else{
            
            initMyInfo(rjson,isboxon);
        
            var value = {
                "starttime" : rjson.starttime,
                "endtime" : getTotalEndtime(rjson)
            }
            var data = {
                type: "customer_teacherreservation",
                teacheruid : teacheruid,
                teachtype : teachtype,
                centercode : nowcentercode,
                value : value
            }

            CallHandler("my_reservation", data, function(res) {
                var code = parseInt(res.code);
    //             clog("customer_teacherreservation res is ",res);
                if (code == 100) {

                    var json = res.message;
                    setPTCalendar(json);

                    if(res.gxtypes)gxtypes = res.gxtypes;
                    if(res.gxteachers)gxteachers = res.gxteachers;

                    var ready_count = 0;
//                    var fix_count = 0;
                    //회수중에 예약요청한 횟수도 포함한다.
                    if(isgxcoupon){

                    }else{
                        ready_count = getTeacherReservationStatusCount(mbs_couponid,10,json);
//                        fix_count = getTeacherReservationStatusCount(mbs_couponid,0,json);    
                    }
                    setTitlePTCount(ready_count);
                    getGXDatas();
                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                        alertMsg("네트워크 에러 ");
    //            show_error_popup("ERROR", "네트워크 에러", "exit");
            });
        }
    }
    function getGXDatas(){
        if(!selected_gx_coupon)return;
        
        var rjson = selected_gx_coupon;
        var isboxon =  isNowTimeMinOver(getTotalEndtime(rjson)) >= 0 ? true : false;
       
       
        
         
//        clog("rjson ",rjson);
        
        var teachername = rjson.manager;
        var teacheruid = rjson.managerid;
        var teachtype = rjson.mbstype;
        
        document.getElementById("icon_txt_1").innerHTML = "오픈";
        document.getElementById("icon_txt_2").innerHTML = "예약함";
        document.getElementById("icon_txt_3").innerHTML = "출석";
        document.getElementById("icon_txt_4").innerHTML = "정원초과";
        document.getElementById("icon_txt_5").innerHTML = "대기신청";
        
        
        
        var txt_title = document.getElementById("txt_title");
        txt_title.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GX 예약";
//        var centercode = rjson.mbsusecentercode;
        nowcentercode = rjson.mbsusecentercode;
        param_centercode = nowcentercode;
        
      
            
        initMyInfo(rjson,isboxon);

        var value = {
            "starttime" : rjson.starttime,
            "endtime" : getTotalEndtime(rjson)
        }
        var data = {
            type: "customer_teacherreservation",
            teacheruid : teacheruid,
            teachtype : teachtype,
            centercode : nowcentercode,
            value : value
        }
        
        CallHandler("my_reservation", data, function(res) {
            var code = parseInt(res.code);
             clog("gx customer_teacherreservation res is ",res);
            if (code == 100) {

                var json = res.message;
                allgxreservation = json;
                
                setGXCalendar(json);

                if(res.gxtypes)gxtypes = res.gxtypes;
                if(res.gxteachers)gxteachers = res.gxteachers;

                var ready_count = 0;


                setTitleGXCount(ready_count);

            } else {
                alertMsg(res.message);
            }

        }, function(err) {
                    alertMsg("네트워크 에러 ");
//            show_error_popup("ERROR", "네트워크 에러", "exit");
        });
        
    }
        //쿠폰이 PT ,GX 둘다 있는지 하나만 있는 지 둘다 없는지 체크한다.
        function isPTGX(){
             //0 : pt gx :false  ,  1: pt true gx false  , 2 : pt false , gx true   10 : pt true , gx true
             var showtype = 0;
             if(isptcoupon && isgxcoupon)
                 showtype = 10;
             else if(isptcoupon && !isgxcoupon)
                 showtype = 1;
            else if(!isptcoupon && isgxcoupon)
                showtype = 2;
            
           
            return showtype;
        }
        
        var mbs_max_count = 0;
        var mbs_use_count = 0;
        var new_usecount = 0;
        var mbs_couponid = "";        
        var mbs_manager_name = "";
        var mbs_startend = "";
        var pt_info  ={};
        var gx_maxcount = 0;
        var gx_usecount = 0;
        var gx_reservationcount = 0;
        var gx_remaincount = 0;
        
        
        function initMyInfo(json,isboxon){
           
            console.log("json ",json);
            //0 : pt gx :false  ,  1: pt true gx false  , 2 : pt false , gx true   10 : pt true , gx true
//            var isptgx = isPTGX();
            
            
            var div_manager_box = document.getElementById("div_manager_box");
            var div_pt_info = document.getElementById("div_pt_info");
            var manager_name = document.getElementById("manager_name");
            var coupon_info = document.getElementById("coupon_info");
            var coupon_startend = document.getElementById("coupon_startend");
            var txt_gx_startend = document.getElementById("txt_gx_startend");
            //비활성 박스 UI 처리
            if(!isboxon){
                div_manager_box.style.backgroundImage = "url(./img/box_mybooking.png)";
                manager_name.style.color = mColor.YELLOW_DISABLED;
                coupon_info.style.color = mColor.C919191;
                coupon_startend.style.color = mColor.C919191;
                
            }
            if(json.mbstype != TYPE_GX){    
                mbs_manager_name = json.manager;
                var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
                mbs_max_count = maxcount;
                mbs_use_count = json.usecount ? parseInt(json.usecount) : 0;
                mbs_couponid = json.id;   
                mbs_startend = json.starttime.substr(0,10)+" ~ "+getTotalEndtime(json).substr(0,10);
            }else {
                
                nowgxcoupon = json;
                var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
                
                gx_usecount = json.usecount ? parseInt(json.usecount) : 0;
                gx_maxcount = maxcount;
            }
            
            coupon_startend.innerHTML = json.starttime.substr(0,10)+" ~ "+getTotalEndtime(json).substr(0,10);
            txt_gx_startend.innerHTML = json.starttime.substr(0,10)+" ~ "+getTotalEndtime(json).substr(0,10);
            var dtypes = {
                            "N":"",
                            "S":"[양도됨]",
                            "D":"[삭제됨]",
                            "R":"[환불됨]",
                            "M":"",
                            
                         };
            var txt_use =  json.mbstype == TYPE_GX && selected_gx_coupon.isdelete && selected_gx_coupon.isdelete ? dtypes[selected_gx_coupon.isdelete] : "";
            
            manager_name.innerHTML = json.mbstype == TYPE_GX ? json.mbsname+txt_use : json.manager;
            
            
            
            //GX 일때 화면을키우고 하단에영역을 만들어 놓는다.
            if(isptcoupon && isgxcoupon && json.mbstype == TYPE_GX){
                div_manager_box.style.height = "145px";
                // selected_pt_coupon 
                clog("myinfosss");
                div_pt_info.innerHTML = "<label id='id_pt_detailinfo' style='margin-top:8px;font-size:13px;color:white;'></label><span style='float:right'><label class='fmont' style='margin-top:12px;font-size:11px;color:#919191;'>"+ mbs_startend+"</label></span>";
                div_pt_info.style.display = "block";
                    
            }
            
//            setTitleCount(0);
        }
        
      
         function setTitlePTCount(reservation){
            
            var coupon_info = document.getElementById("coupon_info");
            var txt_ptcount = document.getElementById("txt_ptcount");
//            clog("mbsuse "+mbs_use_count+" reservation "+reservation);
            new_usecount = mbs_use_count+reservation;
            if(new_usecount > mbs_max_count)new_usecount = mbs_max_count;
            
            pt_info.max = mbs_max_count;
            pt_info.use = new_usecount;
            clog("ptinfo ",pt_info);
            
            coupon_info.innerHTML = "PT "+mbs_max_count+"회 이용권";
            txt_ptcount.innerHTML = "<span style='color:#fffd00;font-weight:bold'>"+new_usecount+"</span>/"+mbs_max_count;
         }
         function setTitleGXCount(reservation){
           
            var div_arc_count = document.getElementById("div_arc_count");
            var coupon_startend = document.getElementById("coupon_startend").style.display = "none";
            var txt_gx_startend = document.getElementById("txt_gx_startend").style.display = "block";
            var div_gx_use4count = document.getElementById("div_gx_use4count").style.display = "block";
             
             div_arc_count.style.display = "none";
            var coupon_info = document.getElementById("coupon_info");
            var txt_ptcount = document.getElementById("txt_ptcount");
            
            var txt_use = selected_gx_coupon.isdelete && selected_gx_coupon.isdelete != "N" ? "[사용불가]" : "";
            coupon_info.innerHTML =  "GX "+gx_maxcount+"회<span style='float:right'>";
            txt_ptcount.innerHTML = "<span style='color:#fffd00;font-weight:bold'>"+gx_usecount+"</span>/"+gx_maxcount;
             
             
            var id_pt_detailinfo = document.getElementById("id_pt_detailinfo");
            if(id_pt_detailinfo)id_pt_detailinfo.innerHTML = "PT <span style='color:#fffd00;font-weight:bold'>"+new_usecount+"</span>/"+mbs_max_count+" 회";
             
        }
        
        
         function setGXCalendar(json){
            
            var container = document.getElementById("container");
            container.style.display = "none";
            reservation_container.style.display = "block";
            calendar_data = json;
             
           insertGXCalenderDatas(json);
            
        }
        
        function setPTCalendar(json){
            
            var container = document.getElementById("container");
            container.style.display = "none";
            reservation_container.style.display = "block";
            calendar_data = json;
            initReservation(json);
            insertAllReservation();
            
        }
        
        function set_title(title) {
            document.title = title;
            //        reservation_title.innerHTML = title;
        }

        function initReservation(json) {
            

            var centercode = json.mbsusecentercode ? json.mbsusecentercode : json.centercode;
            
            
            var data = {
                type: "reservationinfo",
                centercode: centercode,
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    if (res.message == "") {
                        show_error_popup("ERROR", "목록이 없습니다.", "exit");
                        return;
                    }
                    var json_array = JSON.parse(res.message);
                    //                setCourseReservation(json_array[0]);    
                    reservationinfo = json_array[0];
                    

                                    clog("json_array is ",reservationinfo);
                }
            },function(err){
                clog("err ",err);
            });
            
            

        }
        
        function setCourseReservation(jsonobj) {
            //        reservationinfo = jsonobj;
            //select 
            clog("기본 정보 ", jsonobj);
            var teach_name = document.getElementById("teach_name");
            var teach_maxnumber = document.getElementById("teach_maxnumber");
            var teach_times = document.getElementById("teach_times");
            //checkboxs
            var teach_select_times = document.getElementById("teach_select_times");
            //date start end 
            var teach_date = document.getElementById("teach_date");


            var reservation_title = document.getElementById("reservation_title");

            var teacher_type = jsonobj.type == "PT" ? "트레이너" : "강사";
            document.getElementById("teacher_reservation_title").innerHTML = jsonobj.type + " " + teacher_type + " 예약화면";

            ///////////////////////////////////////////////////////
            //강좌종류
            ///////////////////////////////////////////////////////

            var class_len = jsonobj.classes.length;
            if (class_len == 1) {
                var obj = jsonobj.classes[0];
                //다음 수강이 열렸는지 체크한다.
                var isnextopen = obj.next_openid > obj.openid ?  true :false; 
                
                teach_name.innerHTML = isnextopen ? "<option value='" + obj.id + "'>" + obj.name + "</option>" : "<option style='color:#ee2222'>" + obj.name + "(열려있지 않음)</option>";

                teach_datas.style.display = "block";

                
                if(!isnextopen){
                    teach_datas.style.display = "none";
                    return;
                }

                
                ///////////////////////////////////////////////////////
                //최대 정원
                ///////////////////////////////////////////////////////
                var max_people = parseInt(jsonobj.classes[0].max);
                teach_maxnumber.innerHTML = "";
                if (max_people == 1) {
                    teach_maxnumber.innerHTML = "<option value='" + max_people + "'>" + max_people + " 명</option>";
                } else if (max_people > 1) {
                    for (var i = 0; i < max_people; i++) {
                        teach_maxnumber.innerHTML += "<option value='" + (i + 1) + "'>" + (i + 1) + " 명</option>";
                    }
                    teach_maxnumber.selectedIndex = max_people-1;;
                    var text = teach_times.options[teach_times.selectedIndex].text;
                }

            } else if (class_len > 1) {
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
                teach_times.innerHTML += "<option value='" + time + "'>" + time + "시</option>";
            }

        }
        var default_open_starttime = "";
        var default_open_endtime = "";
        function teachNameClick() {
            
            var teach_name_value = document.getElementById("teach_name").value;
            var teach_datas = document.getElementById("teach_datas");
            var teach_maxnumber = document.getElementById("teach_maxnumber");
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
            
            
            clog("teach_name_value " + teach_name_value);
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
                var max_people = parseInt(reservationinfo.classes[teach_name_selectedindex].max);
                teach_maxnumber.innerHTML = "";
                if (max_people == 1) {
                    teach_maxnumber.innerHTML = "<option value='" + max_people + "'>" + max_people + " 명</option>";
                } else if (max_people > 1) {
                    for (var i = 0; i < max_people; i++) {
                        teach_maxnumber.innerHTML += "<option value='" + (i + 1) + "'>" + (i + 1) + " 명</option>";
                    }
                    teach_maxnumber.selectedIndex = max_people-1;;
                }
                
                
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
                teach_select_times.innerHTML += "<label style='border-radius: 25px;background: #e3eDf1;width: 100px;height: 30px;padding-top:2px;padding-right:20px' id='" + teach_times.value + "'>" + text + "<img onclick='removeTeachTime(" + teach_times.value + ")' type= 'button' src ='./img/btn_close_50.png' style='margin-left:60px;margin-top:-36px'/></label>";

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
        function mergeAllData(value){
            if(!calendar_data.ready || calendar_data.ready.length == 0){
                calendar_data.ready = [];
                calendar_data.ready.push(value);
               
            }else{
                 var ready = calendar_data.ready;
                var select_idx = -1;
                for(var i = 0 ; i < ready.length; i++){
                    if(ready[i].teachid == value.teachid){
                        select_idx = i;
                        var rvalue = ready[i];
                        var idx = 0;
                        for(var c = 0 ; c < reservationinfo.classes.length;c++){
                            if(reservationinfo.classes[c].id == value.teachid){
                                idx = c;
                                break;
                            }
                        }
                        rvalue.openid = reservationinfo.classes[idx].openid;
                        rvalue.teachname = value.teachname;
                        rvalue.max = parseInt(value.max);

                        for(var j = 0 ; j < value.dates.length; j++){
                            var isdate = false;
                            for(var k =0; k < rvalue.dates.length; k++){    
                                if(value.dates[j].date == rvalue.dates[k].date){
                                    isdate = true;
                                    rvalue.dates[k] = value.dates[j];
                                    break;    
                                }
                            }
                            if(!isdate)rvalue.dates.push(value.dates[j]);
                        }
                        calendar_data.ready[i] = rvalue;
                    }
                }
                if(select_idx == -1){
                    ready.push(value);
                }
            }

//            clog("mem_teacher_alldata is ",mem_teacher_alldata);
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
            if(idx_opentype != -1 && idx_date != -1 && idx_time != -1 && idx_member != -1 ){
                //calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members[idx_member];
                calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members.splice(idx_member,1);
                rflg = true;
            }
                

           
            return rflg;
        }
        
        
        function teachdate_onchange(type){
            teach_startdate = document.getElementById("teach_startdate");
            teach_enddate = document.getElementById("teach_enddate");
            
            if(teach_startdate.value && teach_enddate.value){
                var isover = get_Day(teach_startdate.value,teach_enddate.value);
                clog("isover "+isover);
                if(isover < 0){
                    alertMsg("종료일이 시작일보다 작습니다. 다시 선택하세요.");
                    teach_enddate.value = "";                        
                }
            }
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
//            clog("startdate "+teach_startdate.value);
//            clog("teach_enddate "+teach_enddate.value);            
        }
        function delete_reservation(info,status,note){  //note 에 시간 분이 들어있을 수 있다.
            clog("delete_reservation info is "+info);
            var mid = selected_pt_coupon.managerid;
            var mtype = selected_pt_coupon.mbstype;
            var centercode = selected_pt_coupon.mbsusecentercode;
            var couponid = selected_pt_coupon.id;
            
            var obj = info.split('|');
            var date = obj[0].substr(0,10);
            var time = obj[0].substr(11,2);
            // ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+myuid+"|"+event.opentype;
            
            //예약요청이들어옴
            if(status == 10){
//                var selecttag = "<select id='reservation_status' class='form-control' >"+
//                                    "<option value=''>== 상태값을 선택하세요 ==</option>"+
//                                    "<option value='2'>레슨종료(PT 1회 차감됨)</option>"+
//                                    "<option value='3'>예약 취소하기</option>"+                                
//                                "</select><br>";
                var message = "<label align = 'center'>("+mtype+") "+date+"일 "+time+" 시<br>예약건을 확인하시겠습니까?</label>"
                showModalDialog(document.body, "예약 확인",message, "예약확인하기", "닫기", function() {
                   
                    //예약건 확인하기
                    update_reservation_user(0,info,obj[0],obj[1],obj[2],obj[3],mid,mtype,centercode,couponid,note);
                }, function() {
                   hideModalDialog();
                });
            }else{ //status == 1 일때
                var message = "<br>"+date+" "+time+"시 레슨종료 확인을 하시겠습니까?<br><br>";
                showModalDialog(document.body, "운동종료 확인하기",message, "운동종료 확인하기", "닫기", function() {
                    
                    //운동종료 확인하기하기
                    update_reservation_user(2,info,obj[0],obj[1],obj[2],obj[3],mid,mtype,centercode,couponid,note);
                }, function() {
                   hideModalDialog();
                });
                
            }
            
        }
//        function insert_reservation(info){
//            var mid = selected_pt_coupon.managerid;
//            var mtype = selected_pt_coupon.mbstype;
//            var centercode = selected_pt_coupon.mbsusecentercode;
//            var couponid = selected_pt_coupon.id;
//            
//           
//            var obj = info.split('|');
//             clog("obj[0]",obj[0]);
//            var date = obj[0].substr(0,10);
//            var time = obj[0].substr(11,2);
//            // ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+myuid+"|"+event.opentype;
//            showModalDialog(document.body, "예약하기","("+mtype+") "+date+"일 "+time+" 시에 예약하시겠습니까?", "예약하기", "취소", function() {
//                update_reservation_user(0, info,obj[0],obj[1],obj[2],obj[3],mid,mtype,centercode,couponid);
//            }, function() {
//               hideModalDialog();
//            });
//            
//            
//            //월 달력으로 이동한다.테스트
////            window.options.mode = "month";
////            clog("window.defaults ",window.defaults);
////            clog("window.options ",window.options);
////            window.calendar(window.el,window.options);
//        }
        function update_reservation_user(nextstatus,info,_date ,_teachid,_user,_opentype,managerid,mbstype,centercode,couponid,note){
            var obj = info.split('|');
            var insertuser = {};
            insertuser.uid = _user;
            var date = obj[0].substr(0,10);
            var time = obj[0].substr(11,2);
            insertuser.date = date;
            insertuser.time = time;
            insertuser.teachid = _teachid;
            insertuser.opentype = _opentype; 
            insertuser.user = _user;
            insertuser.managerid = managerid;
            insertuser.mbstype = mbstype;
            insertuser.centercode = centercode;
            insertuser.status = nextstatus;
            insertuser.couponid = couponid;
            insertuser.note = note;
            
            var rtype = nextstatus == 0 ? "insertreservationuser" : "deletereservationuser";
            
            var data = {
                type: rtype,
                centercode: centercode,
                insertuser:JSON.stringify(insertuser)
            }
//            clog("info "+info+" _date "+_date+" _teachid "+_teachid+" _user "+_user+" _opentype "+_opentype+" managerid "+managerid+" couponid",couponid);
//            if(true)return;
            
            CallHandler("my_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {

                   var data = res.message;
                   var teacher_token = data.fcmtoken;
                   //////////////////////////////////////////////////////
//                   update_user_result(info,date,hh,nextstatus,data); //화면 색과 버튼을 바꾼다.
//                   update_window_options_data(nextstatus,_date ,insertuser.teachid,data); // 윈도우 데이타를 함께 바꾼다.
                    
                    
                    var mtitle = "운동종료확인";
                    var mmessage = username+"님이 운동종료 확인을 하였습니다.";    
                    
                    if(nextstatus == 0){
                        mtitle = "예약확인";
                        mmessage = username+"님이 운동예약 확인을 하였습니다.";                        
                    }
                    
                    request_confirm_traner(nextstatus,obj[0],managerid,teacher_token,mtitle,mmessage,true);
                    //////////////////////////////////////////////////////
                    
                }else{
                   alertMsg(res.message,function(){
                       hideModalDialog();
                   });
                }

//               
            },function(err){
                alertMsg("네트워크 에러 ",err);
            });
        }
        //확인요청 푸시 보내기
        function request_confirm_traner(nextstatus,date,managerid,token,mtitle,mmessage,isshow){
           
            //담당트레이너 설정하기
                     
             //트레이너 설정 성공하면 담당트레이너에게 푸시메세지 보내기
             //pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_GOTO_PTGX_RESERVATION,function(res){
            pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_NOTICE,function(res){
                if (res.code == 100) {
                    //푸시메세지를 보냈으면 성공팝업띄우고 종료
                    if(isshow){
                         var msg = nextstatus == 0 ? "<br>운동예약을 확인하였습니다.<br>" : "<br>운동종료를 확인하였습니다.<br>";
                         alertMsg(msg,function(){
                            hideModalDialog();
                            hideModalDialog();    
//                            var day = new Date(date);
//                            refresh_page("?centercode="+param_centercode+"&day="+day);
                             reload_calendar_page();
                         });   
                    }


                } else {
//                    alertMsg(res.message);
                    reload_calendar_page();
                }
            },function(err){
                alertMsg("네트워크 에러 ",err);
            }); 
        }
        
        //고객정보를 달력에서
//        function update_window_options_data(status,_date ,_teachid,data){
//
//            var teachname = "";
//            for(var i = 0 ; i < reservationinfo.classes.length; i++){
//                if(data.teachid == reservationinfo.classes[i].id){
//                    teachname = reservationinfo.classes[i].name;
//                    break;
//                }
//            }
//            
//            var title = get_reservation_status_tag(status)+"("+data.userlen+"/"+data.max+") "+teachname;
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
//
////                clog("teachid "+teachid+" _teachid "+_teachid+" user "+user+" _user "+_user);
////               clog("window.options.data i ",window.options.data[i]);
//                if(date == _date && teachid == _teachid){
//
////                    clog("window.options.data ",window.options.data[i]);
//                    if(status != 0){ //예약을 취소했다. 화면
//                        title = title+" 오픈됨";
//                        window.options.data[i].title = title;
//                        window.options.data[i].user = "";
//                        window.options.data[i].tcss = setDivType("default");
//                        
//                    }else{ //예약했다. 화면
//                        var txt = status == 10 ? " 예약요청됨" : " 예약확인됨";
//                         title = title+txt;
//                         window.options.data[i].title = title;
//                         window.options.data[i].user = "true";
//                         window.options.data[i].tcss = setDivType("close");
//                        
//                        if(status == 0){
//                             window.options.data[i].title = title;
//                             window.options.data[i].user = "true";
//                             window.options.data[i].tcss = setDivType("green");
//                        }
//                    }
//
//                    break;
//                }
//            }
//        }
        
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
                                <!-- <span class="btn-group" style="border-radius:20px;margin-left:5px;margin-right:2px;">
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:16px 0px 0px 16px;padding-left:15px" class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year"><text id="txt_year">년</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px" class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month"><text id="txt_month">월</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px" class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week"><text id="txt_week">주</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:0px 16px 16px 0px;padding-right:15px" class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day"><text id="txt_day">일</text></button>
                                </span> -->
                                <!-- 오늘로가기 -->
                                 <button style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:16px;padding-left:15px;padding-right:15px" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
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
            <tr align="center">
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
                    var _ymd = "_"+yy+"_"+(thedate.getMonth() + 1)+"_"+thedate.getDate();
                }}
                {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss;opacity = 1; } }}
                <td class="stop-dragging calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? '':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}" style="opacity:{{: opacity }}">
                    <!--======================== -->
                    <!-- 오늘오픈된 강좌 이미지타입 -->
                    <!--======================== -->
                     <!-- <div id="td_month_{{: _ymd }}" style="position:absolute;width:48px;height:46px;font-size:12px;background-color:#ffffff44;display:none;border:1px solid #ffffff22"></div> -->
                    <!--  <text id="td_month_{{: _ymd }}" style="position:absolute;margin-top:-3px;font-size:12px;color:yellow;display:none">•</text> -->
                    <img id="td_month_{{: _ymd }}" src="./img/icon_n.png" style="position:absolute;margin-left:-7px;margin-top:-10px;width:25px;height:25px;display:none"> 
                    
                    <div style="color:white" class="date">
                        <text id="num_{{: now }}"  class="fmont" style="font-size:13px;font-weight:400;opacity:1;padding:10px">{{: thedate.getDate() }}</text>
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

                                    <td class="{{: date.toDateCssClass() }}"  style="width:100%"> </td>
                                </tr>
                                <tr id="tr_input" style="display:none;border-bottom: 1px solid #292929;">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text style="text-align:right;float:left;font-size:10px;color:#afafaf;font-weight:400">수동삽입 P.T</text></div></th>

                                    <td class="time-0-0" style="width:100%"> </td>
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
                                <tr id="daytime_{{: time }}" style="border-bottom: 1px solid #292929;display:none">
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

                                    <td class="time-24-0" style="width:100%"> </td>
                                </tr>
                            </tbody>
                        </table>
                        
                         {{ } else { }}
                         <table style="width:100%">
                            <!-- 오늘 이전 날짜라면 -->
                            <tbody>
                                <tr align="center" style="display:none;border-top: 1px solid #292929;border-bottom: 1px solid #292929;">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text class="fmont" style="text-align:right;float:right;font-size:10px;color:#afafaf;font-weight:400">All Day</text></div></th>
                                    <td class="{{: date.toDateCssClass() }}" style="border-left: 1px solid #292929;width:100%"> </td>
                                </tr>
                                <tr id="tr_input" style="display:none;border-bottom: 1px solid #292929;">
                                    <th ><div style="width:53px;min-height:30px;padding-top:7px;padding-right:12px"><text style="text-align:right;float:left;font-size:10px;color:#afafaf;font-weight:400">수동삽입 P.T</text></div></th>

                                    <td class="time-0-0" style="border-left: 1px solid #292929;width:100%" > </td>
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
                                <td class="time-24-0" style="border-left: 1px solid #292929;width:100%"></td>
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

//        clog("width ", $(window).width());
//        clog("height ", $(window).height());

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
//            clog("callender call $el !! ",$el);
//            clog("callender call options !! ",options);
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
                              console.log("options.date.getMonth() ",options.date.getMonth());
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
            
            function getGXButtonTag(roomid,intype,hour,color){
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
            
            function dayAddEvent(index, event) {
                var e = new Date(event.start),
                dateclass = e.toDateCssClass();
                var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                
                //GX 예약화면
                if(event.type_ptgx == "그룹"){
                    var e = new Date(event.start),
                    dateclass = e.toDateCssClass(),
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
                    var room_managername = room.room_managername ? room.room_managername : "";
                    var yearmonthnum = parseInt(event.start.getFullYear())*12+parseInt(event.start.getMonth())+1;
                    var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                    var isbeforesame = false;
                    
//                    clog(" clickid "+clickid+" roomid "+roomid+" max "+max+" sdate "+sdate+" roomname "+roomname+" userslen "+userslen+" hour "+hour+" roommin "+roommin+" yearmonthnum "+yearmonthnum+" sdate "+sdate);
//                    clog("room ",room);
                    var smm = mm < 10 ? "0"+mm : mm;
                    var sdd = dd < 10 ? "0"+dd : dd;
                    var shh = hour < 10 ? "0"+hour : hour;
                    var smin = parseInt(roommin) < 10 ? "0"+roommin : roommin;
                    var rstart = shh+":"+smin;
                    
                    var emin = (parseInt(roommin)+roomlessontime)%60; //50분기준으로 한다.
                     var addhour = Math.floor((parseInt(roommin)+roomlessontime)/60);
                    var ehour = (hour+addhour)%24;
//                    var ehour = smin+roomlessontime >= 60 ? hour+1 : hour;
//                    if(ehour > 23)ehour = 0;
                    var ehh = ehour < 10 ? "0"+ehour : ehour;
                    var emm = emin < 10 ? "0"+emin : emin;
                    var rend = ehh+":"+emm;
                    var txt_startend = rstart+"~"+rend;
                    
                    
                    //  -1 : 예약안된상태  0: 예약만한상태  2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(대기신청아직안함) , 5 : 예약이 꽉참(대기신청완료한상태)
//                    console.log("room.room_opentime ",room.room_opentime);
//                    if(room.room_id.indexOf("11-26") >= 0){
//                        console.log("=================================");
//                        console.log("room ",room);
//                        console.log("room.room_opentime ",room.room_opentime);
//                        console.log("isNowTimeMinOver(room.room_opentime) ",isNowTimeMinOver(room.room_opentime));
//                    }
                    if(startint == dateint  && isNowTimeMinOver(room.room_opentime) != 1 && parseInt(room.room_isshow) == 1){
                        var timeclass = '.time-23-0';
                        if (hour < 6) {
                            timeclass = '.time-0-0';
                        }
                        else if (hour < 24) {
                            timeclass = '.time-' + hour + '-' + (event.start.getMinutes() < 30 ? '0' : '30');
                        }
                        
                        
                        var users = room.room_users ? room.room_users : [];
                        var ready_users = room.room_readyusers ? room.room_readyusers : [];
                        
                        //방이름
                        var txt_roomname = "<text style='font-size:16px;color:white;font-weight:bold'>"+room_title+"</text>";
                        //강사이름
                        var txt_teacher_name = "<div style='position:absolute;margin-left:56px;margin-top:8px;'><text style='font-size:14px;color:white;'>"+room_managername+" 강사</text></div>";
                        //시간
                        var txt_time = "<div style='position:absolute;margin-left:56px;margin-top:27px;width:150px;height:30px'>"+
                            "<img src='./img/icon_class_time.png' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+txt_startend+"</text></div>";
                        //동그라미 그림
                        var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:30px'><img src='./img/arcicon_2.png' style='width:46px;height:46px;border-radius:23px'/></div>";
                        var div = document.createElement("div");
                        var intype = getGXInType(roomid,users,ready_users,max); //   -1 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  , 5 : 예약이 꽉참
                      
                        
                        //시간이지난 내가들어가있지 않은 방은 안보여준다.
                       
                        var room_starttime = yy+"-"+smm+"-"+sdd+" "+shh+":"+smin+":00";
                        if(intype == 10 && isNowTimeMinOver(room_starttime) == -1 || intype == 4 && isNowTimeMinOver(room_starttime) == -1){
                            return;
                        }
                        
                        div.id = clickid;
                        
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
                        var nexttype = 0; //예약하기
                        if(intype == 0)nexttype = 10; //취소해서 다시 원래대로 돌리기
                        if(intype == 4)nexttype = 5; //꽉차서 대기신청하기
                       if(intype == 5){//대기신청되어있음
                            if(users.length >= parseInt(room.room_max))
                                nexttype = 4; //꽉차서 대기신청하기
                            else 
                                nexttype = 0; //대기신청되어있으나 방이 비었음
                        }
                        var txts = ["예약취소","", "예약취소","","대기신청", "대기취소"]; //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
                        var btntxt = "예약하기";
                        if(intype < 10)
                            btntxt = txts[intype];
                        
                        //대기신청되어있으나 꽉차지않음
                        if(intype == 5 && users.length < parseInt(room.room_max))
                            btntxt = "예약하기";
                        
                        var bgcolor = intype == 0 ? mColor.RGX_RESERVATION : mColor.C222222;
                        //BG 배경색
                        var txt_cntcolor = intype == 0 ? "white" : roombg; 
//                        clog("roomdata is ",room);
                        //인원수 ex) 2/6
                        var txt_usercnt = "<div style='float:right;margin-top:47px;margin-right:5px;'><text style='font-size:20px;color:"+txt_cntcolor+";font-weight:600'>"+users.length+"/"+room.room_max+"</text></div>";
                        
                        var str_gxinfo = setJSONStringToParamString(event.roomdata);
                        
                        
                        
                        
                       
//                        clog("****** room_starttime "+room_starttime+" istimeover "+ isNowTimeOver(room_starttime));
                        var onclick_tag = "onclick='insert_gxuser(\"" +roomid + "\", "+intype+", "+nexttype+", "+hour+", \"" +btntxt + "\", \"" +room.room_name + "\", \"" +room.room_managername + "\", \"" +hour + "\", \"" +roommin + "\", \"" +users.length + "\", \"" +room.room_max + "\", \"" +txt_cntcolor + "\", \"" +bgcolor + "\", \"" +txt_date + "\", \"" +str_gxinfo + "\", \"" +txt_startend + "\", \"" +room_starttime + "\")'";
                        
                        //삭제,양도,환불된 회원권은 예약이 되지 않는다.
                        if(event.isdelete){
                            onclick_tag = "";
                            div.style.opacity = 0.5;
                        }
                            
                        div.innerHTML = "<div "+onclick_tag+"  style='width:280px;font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:100px;background-color:"+bgcolor+";border-radius:10px'>"+arc_div+txt_roomname+txt_teacher_name+txt_time+txt_usercnt+getGXButtonTag(roomid,intype,hour,roombg)+"</div>";
                        
                        div.style.width = "280px";
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
                //PT 예약화면
                else {
                    if (!!event.allDay) {
                        monthAddEvent(index, event);
                        return;
                    }
                    var button = document.createElement('button');
                    
                     var notedata = event.notedata;
                    //시간 : ex) 18:35~19:25
                    var minute = getNoteInMininute(removeFreePTText(notedata));
                    var shh = hh < 10 ? "0"+hh : hh;
                    var smin = parseInt(minute) < 10 ? "0"+minute : minute;
                    var rstart = shh+":"+smin;
                    var emin = (minute+50)%60; //50분기준으로 한다.
                    var ehour = smin+50 >= 60 ? hh+1 : hh;
                    if(ehour > 23)ehour = 0;
                    var ehh = ehour < 10 ? "0"+ehour : ehour;
                    var emm = emin < 10 ? "0"+emin : emin;
                    var rend = ehh+":"+emm;
                    var txt_startend = rstart+"~"+rend;  
                    
                    
                    
                    //오직 선택한 회원권 정보만 보여준다.
    //                if(event.couponid != nowcoupon.id)return;

                    var user = "<?php echo $uid; ?>";
                    var clickid = ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+user+"|"+event.opentype;

                    
                    
                    var bgcolor = mColor.RA_FINISH;
                    if(event.user&& event.status == 10) bgcolor = mColor.RA_REQUEST;
                    else if(event.user && event.status == 0) bgcolor = mColor.RA_USERCHECKED;
                    else bgcolor = mColor.RA_FINISH;
                    if(event.user && event.couponid != nowptcoupon.id)bgcolor = mColor.R_OTHER; // 다른회원권

                    
                    
                    var txtcolor = mColor.R_FINISH;
                    if(event.user && event.status == 10) txtcolor = mColor.R_REQUEST;
                    else if(event.user && event.status == 0) txtcolor = mColor.R_USERCHECKED;
                    else txtcolor = mColor.R_FINISH;
                    if(event.user && event.couponid != nowptcoupon.id)txtcolor = mColor.R_OTHER; // 다른회원권
                   
                    //before
                    //기본 텍스트
//                    var div = document.createElement("div");
//                    div.id = clickid;
//                    div.innerHTML = "<span style='font-size:15px;padding:10px'>"+event.title+"</span>";
//                    div.style.padding = !event.user ? "15px":"15px";
//                    div.style.margin = "2px";

//                     var rectLine = event.user ? "<span style='float:left'><div style='width:4px;height:40px;background-color:#ea703b;border-radius:5px,1px,5px,1px;'></div></span>" : "";
                    
                    var div = document.createElement("div");
                    div.id = clickid;

//                    div.style.borderRadius = "6px";
//                    div.style.paddingTop = "5px";
//                    div.style.paddingBottom = "10px";
//                    div.style.minHeight = "30px";
                    
                     div.style.width = "280px";
                    div.style.padding = "3px"
                    div.style.margin = "2px";
                    div.style.height="auto";
                    div.style.borderRadius = "10px";
//                    
//                    div.innerHTML = rectLine+"<span><div style='width:100%;margin-left:10px;margin-right:30px;'>"+event.title+"</div></span>";
                    
                    var $event = $('<div/>', {
                        
                        text: event.title,
                        title: event.title,
                        'data-index': index
                    });


                    var start = event.start,
                        end = event.end || start,
                        time = event.start.toTimeString(),
                        hour = start.getHours(),
                        timeclass = '.time-22-0',
                        startint = start.toDateInt(),
                        dateint = options.date.toDateInt(),
                        endint = end.toDateInt();
                    if (startint > dateint || endint < dateint) {
                        return;
                    }

                    
                    var mcolor = event.status == 0 ? "white" : txtcolor;
                    var btn_tag = "";
                    var isfreept = false;
                    if(event.isover >= 0 && !event.user){
                       
    //                    div.innerHTML = div.innerHTML+"<button class='btn btn-primary' style='float:right;margin-top:-9px;' onclick='insert_reservation(\"" + clickid + "\")' >예약하기</button>";                    
                    }else if(event.user && event.couponid == nowptcoupon.id){
                        
                        if(notedata && notedata.indexOf(TXT_FREEPT) >= 0 || notedata && notedata.indexOf(TXT_FREEPT_AND_TIMEOUT) >= 0)isfreept = true;
                        
                        var btn_txt = event.status == 10 ? "예약확인하기" : "운동종료 확인하기";
                        var onclick = " onclick='delete_reservation(\"" + clickid + "\", "+event.status+",\"" + event.note + "\")' ";
                        if(event.status == 0){
                             btn_txt = "고객승인";
                             onclick = "";
                        }
                        else if(event.status == 2){
                             btn_txt = "완료";
                             onclick = "";
                        }
                        
                        
                        
//                            div.innerHTML = div.innerHTML+"<span style='float:right;margin-right:10px;margin-top:-15px'><button class='btn' style='background-color:#3164ff;font-size:11px;color:white;padding-top:2px;padding-bottom:2px;padding-left:5px;padding-right:5px;border-radius:4px;float:right;margin-top:-5px' onclick='delete_reservation(\"" + clickid + "\", "+event.status+",\"" + event.note + "\")' >"+btn_txt+"</button></span>";       
                            
                            //버튼 
                        btn_tag = "<div "+onclick+" style='position:absolute;width:280px;height:70px;margin-top:-35px;'><button style='float:right;margin-top:10px;margin-right:25px;padding-right:7px;padding-top:4px;padding-bottom:4px;border:1px solid "+mcolor+";color:"+mcolor+";font-size:11px;font-weight:bold;border-radius:4px;background-color:#00000000' >"+btn_txt+"</button></div>";
                            
                    }
                     var note_tag = "<div style='position:absolute;margin-left:46px;margin-top:35px;'><text style='color:white;font-size:14px;margin-left:10px;'>Note:</text>&nbsp;<input value='"+removeFreePTText(event.notedata)+"' style='width:90px;height:22px;background-color:#62393233;border-radius:4px;color:white;font-size:14px;border:0 solid black' disabled/></div>"
                    
                    // 횟수 
//                    var txt_usercnt = "<div style='float:right;margin-top:47px;margin-right:5px;'><text style='font-size:20px;color:"+mcolor+";font-weight:600'>"+new_usecount+"/"+mbs_max_count+"</text></div>";
                     var txt_usercnt = "";

                    //방이름 PT
//                    var txt_roomname = "<text style='font-size:16px;color:white;font-weight:bold'>PT</text>";
                    var txt_roomname = isfreept ? "<text style='font-size:16px;color:white;font-weight:bold;margin-left:-10px;'><img src='./img/free3.png' style='width:30px;height:30px;margin-top:-10px;'>PT</text>":"<text style='font-size:16px;color:white;font-weight:bold;'>PT</text>";
                    //트레이너 이름
                    var txt_teacher_name = "<div style='position:absolute;margin-left:56px;margin-top:-23px;'><text style='font-size:16px;color:white;font-weight:bold'>"+mbs_manager_name+"</text></div>";

                    //PT시간
                    var txt_time = "<div style='position:absolute;margin-left:56px;margin-top:7px;width:150px;height:30px'>"+
                        "<img src='./img/icon_class_time.png' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+txt_startend+"</text></div>";
                    //동그라미 그림
                    var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:30px'><img src='./img/arcicon_0.png' style='width:46px;height:46px;border-radius:23px'/></div>";

                    var onclick_tag = "";

                    //div 배경포함 조합 
                    div.innerHTML = "<div "+onclick_tag+"  style='width:280px;font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:100px;border-radius:10px;background-color:"+bgcolor+"'>"+arc_div+txt_roomname+txt_teacher_name+txt_time+note_tag+txt_usercnt+btn_tag+"</div>";

                    
                    
                    if (hour < 6) {
                        timeclass = '.time-0-0';
                    }
                    if (hour < 24) {
                        timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
                    }
                    

                    
                    if(dateclass == sdate){

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
//                                var hhmm = time_h+":"+time_min;
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
                    
//                    
//                    if(event.user && event.status == 10) div.style.backgroundColor = mColor.R_REQUEST;// 10 요청
//                    else if(event.user && event.status == 0) div.style.backgroundColor = mColor.R_USERCHECKED; //0 고객승인
//                    else div.style.backgroundColor =  mColor.R_FINISH; // 완료
//                    
//                    if(event.user && event.couponid != nowcoupon.id)div.style.backgroundColor = mColor.R_OTHER; // 다른회원권
                    
                    
                    
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
            function removeFreePTText(txt){
                return txt ? txt.replace(TXT_FREEPT,"") : "";
            }
            function monthAddEvent(index, event) {
                
                //GX 예약화면
                if(event.type_ptgx == "그룹"){
                    e = new Date(event.start),
                    dateclass = e.toDateCssClass();
                    var clickid = event.roomdata.room_id;
                    var room = event.roomdata;
                    var roomid = room.room_id;
                    var max = room.room_max;
                    var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                    var hour = parseInt(event.start.getHours());
                    var min = room.room_min;
                    

                    var nowday = parseInt(event.start.getDate());
                   
                    if(dateclass == sdate && isNowTimeMinOver(room.room_opentime) != 1 && parseInt(room.room_isshow) == 1)
                    {//오픈시간체크
                        
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

                        var div = document.createElement("div");
                        div.id = clickid;
                         var time = event.start.toTimeString();
                         var timetag = getTimeTag(time,min);
                        div.innerHTML = timetag;
                        div.align = "center";
                        div.style.paddingTop = (2+zoom/3)+"px";
                        div.style.margin = "2px";
                        div.style.height = "14px";
                        div.style.borderRadius = "4px";                       
                        div.style.backgroundImage = roombg;
                        
                        
                        
                         
//                        var timetag = getTimeIconTag(time,4,5);
                        
                        if(intype == 0 || intype == 2 || intype == 5) //내꺼만 표시
                        $('.' + event.start.toDateCssClass()).append(div);
//                        $('.' + event.start.toDateCssClass()).append(div);
                        
                        
                        
                        
                        //오늘이후 오픈된 모든 강좌를 표시한다.
//                        var my = event.start.getFullYear()
//                        var mm = event.start.getMonth()+1 < 10 ? "0"+(event.start.getMonth()+1) : ""+event.start.getMonth()+1;
//                        var md = event.start.getDate() < 10 ? "0"+event.start.getDate() : ""+event.start.getDate();
//                        var ymd = my+"-"+mm+"-"+md;                        
                        //if(getDDay(ymd) > 0 && isNowTimeMinOver(room.room_opentime) < 0 && parseInt(room.room_isshow) == 1){
                        
                        //오늘 오픈된 강좌를 표시한다.
//                        if(getToday() == getToday(new Date(room.room_opentime)) && isNowTimeMinOver(room.room_opentime) <= 0 && parseInt(room.room_isshow) == 1){
//                            var td_month = document.getElementById("td_month_"+sdate);
//                            if(td_month)td_month.style.display = "block";
//                               
//                        }
                    }
                }
                //PT 예약화면
                else {
                    var hour = parseInt(event.start.getHours());
                    var $event = $('<div/>', {
                           
                            text: event.title,
//                            title: event.title,
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
                    $event.css("height","14px");
                    $event.css("padding","2px");
                    $event.css("margin","2px");
                    $event.css("borderRadius","4px");
                    
                    //오직 선택한 회원권 정보만 보여준다.
                    if(!event.user)return;

                    if(hour < 6 && event.user)$event.html("<text class='fmont' style='font-size:9px;color:black;font-weight:bold'>IN</text>");
//                 $event.css({ "height" : "100px"});
                    if (!!time) {
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


                            //이부분이 날짜칸에 데이타 태그를 삽입하는부분이다.
                            if(event.backgroundimage)$event.css("background-image",event.backgroundimage);
//                            if(event.fontcolor)$event.css("color",event.fontcolor);

                           
                            //수동입력이라면
                            if(hour < 6){
                                $event.css("background-image",mColorImg.R_OTHER);
                            }
                            //현재선택한 쿠폰이아닌 다른쿠폰이라면 회색으로 표현한다.
                            if(event.user == "true" && event.couponid != nowptcoupon.id){
                                 $event.css("background-image",mColorImg.R_OTHER);
                            }

                           
                            
                            
                            day.append($event.toggleClass('begin', dateclass === event.start.toDateCssClass()).toggleClass('end', dateclass === event.end.toDateCssClass()));
                            $event = $event.clone();
                            $event.html(' ');    
                        
                           
                            
                            
                        }
                        e.setDate(e.getDate() + 1);
                        dateclass = e.toDateCssClass();
                        day = $('.' + dateclass);
                    }
                }
//               
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
            function drawYMWDArc(mode){
                var txt = document.getElementById("txt_"+mode);
                if(txt){
                    txt.style.color = "#111111";
                    txt.style.backgroundColor = "#d6d6d6";
                    txt.style.paddingLeft = "10px";
                    txt.style.paddingRight = "10px";
                    txt.style.paddingTop = "4px";
                    txt.style.paddingBottom = "4px";
                    txt.style.borderRadius = "12px";    
                }
            }
            function draw() {
                $el.html(t(options));
                //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
                $('.' + (new Date()).toDateCssClass()).addClass('today');
                if (options.data && options.data.length) {
                    drawYMWDArc(options.mode);
                    if (options.mode === 'year') {
                        yearAddEvents(options.data, options.date.getFullYear());
                    } else if (options.mode === 'month' || options.mode === 'week') {
                        $.each(options.data, monthAddEvent);
                    } else {

                        //맨위로가기
                        window.scrollTo(0,0);
                        
                        //////////////////////////////////////////////////////////////////////////////
                        //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. START
                        //////////////////////////////////////////////////////////////////////////////

//                        var title = "예약버튼"; //제목이지만 내용을 적으면 된다.
//                        var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
//                        y = 2021;
//                        m = 0; //
//                        d = 6;
//                        hh = 13;
//                        mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
//                        start = new Date(y, m, d, hh, mm);
//                        clog("dayaddeventcall!!", options.data);
//                        var event = {
//                            title: title,
//                            start: start,
//                            end: null,
//                            allDay: allday,
//                            type: "reservation_button"
//                        };
//                        dayAddEvent(0, event);

                        //////////////////////////////////////////////////////////////////////////////
                        //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. END
                        //////////////////////////////////////////////////////////////////////////////


                        //기존 예약되어있는 날짜 표시
                        //            $.each(options.data, dayAddEvent);
//                        window.defaults.data = options.data;
                        for (var i = 0; i < options.data.length; i++) {
                            dayAddEvent(i, options.data[i]);
                        }
                    }
                }
            }

            draw();
            window.mdraw = draw;
        }
        
        ;
        
        window.calendar = calendar;
        (function(defaults, $, window, document) {
//            clog("defaults ",defaults);
//            window.defaults = defaults;
            $.extend({
                
                calendar: function(options) {
//                    clog("calendar!!! 0000");
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
//                                    console.log("options.date.getMonth() ",options.date.getMonth());
                                     
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
            //daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],//토요일 파랑색깔보여주기
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
    var calendar_datas = [];
    function insertAllReservation(){
//        clog("calendar_data",calendar_data);
//        //ex) var rdata = {"type":"GX","name":"리포머","date": "2021-02-21","times":[ {"time": 9,"members": ["test_uid0000", "test_uid1111"]},{"time": 10,"members": ["test_uid1111", "test_uid2222"]}]}
//        clog("calendar_data.close ",calendar_data.close);
//        clog("calendar_data.open ",calendar_data.open);
//        clog("calendar_data.ready ",calendar_data.ready);
        var datas = [];
        var close = addCalendatas(calendar_data.type,calendar_data.close, "close");
        var open = addCalendatas(calendar_data.type,calendar_data.open, "open");
        var ready = addCalendatas(calendar_data.type,calendar_data.ready, "ready");
//        clog("")
        calendar_datas = [];
        
        for(var i = 0 ; i < close.length;i++)
            calendar_datas.push(close[i]);
        
        for(var i = 0 ; i < open.length;i++)
            calendar_datas.push(open[i]);
        for(var i = 0 ; i < ready.length;i++)
            calendar_datas.push(ready[i]);
        
        insertCalenderDatas(calendar_datas);   
    }
    function addCalendatas(type,obj,opentype){
        if(!obj)return [];
        var dates = [];
        for(var i = 0 ; i < obj.length; i++){// close, open , ready 3개
            
            for(var j = 0 ; j < obj[i].dates.length; j++){
                
                var rdata = {"type":"","name":"","date": "","times":[]};
                rdata.type = type;
                rdata.name = obj[i].teachname;
                rdata.max = obj[i].max;
                rdata.teachid = obj[i].teachid;
                rdata.opentype = opentype;
                var mobj = obj[i].dates[j];
                rdata.date = mobj.date;
                rdata.times = mobj.times;
//                clog("")
                dates.push(rdata);
            }
        } 
        return dates;
    }
    var is_insert_gx = false;
    var thisweek_reservation_count = 0;
    var alldata = [];
    
    var user_reservation_couponcount = {};
    function insertGXCalenderDatas(datas){   
//        alldata = [];
        datas.sort(sort_by('gx_date', true, (a) => a.toUpperCase()));   
        clog("datas is ",datas);
        //test
        var weeks = getThisWeek();
        
        var now_coupon_gx_usecount = 0;
        var now_coupon_gx_reservationcount = 0;

        user_reservation_couponcount = {};
        for(i = 0; i < datas.length; i++) {
            var roomdata = JSON.parse(datas[i].gx_roomdata);
//            clog("roomdatas is ",roomdatas);
           
                var tdate = roomdata.room_datetime;
                tdate = tdate.replace(" ","T");
                var date = new Date(tdate);
//                console.log("tdate is "+tdate);
                var title = roomdata.room_name; //제목이지만 내용을 적으면 된다.
                var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
                var y = date.getFullYear();
                var m = date.getMonth();  //
                var d = date.getDate();
                var hh = date.getHours();
                var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                
            
            
          
            
            
//                console.log(y+"-"+m+"-"+d+" "+hh+":"+mm+":00");
                var start = new Date(y, m, d, hh, mm);
//                console.log("gx start is ",start);
                var sy = y;
                var sm = date.getMonth()+1 < 10 ? "0"+(date.getMonth()+1) : date.getMonth()+1;
                var sd = d < 10 ? "0"+d : d;
                var yyyymmdd = sy+"-"+sm+"-"+sd;
                
                var isthisweek = isThisWeek(yyyymmdd, weeks);
                var intype = getGXInType(roomdata.room_id,roomdata.room_users,roomdata.room_readyusers,roomdata.roommax); //   10: 오픈됨 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(내가없음) , 5 : 예약이 꽉참
                
//                clog(yyyymmdd+"=========="+intype);
                if(isthisweek && intype == 0 || isthisweek && intype == 2){
                    thisweek_reservation_count++;
                }
                
//            console.log("roomdata ",roomdata);
            
            ///////////////////////////////////////////
            // 예약횟수 체크하기
            ///////////////////////////////////////////
            
                if(roomdata.room_users)
                    for(var j = 0 ;  j < roomdata.room_users.length;j++){
                        var roomuser = roomdata.room_users[j];
                        var uid_couponid = roomuser.useruid+"_"+roomuser.couponid;
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
                        if(user_uid == roomuser.useruid && selected_gx_coupon.id == roomuser.couponid)
                        {
                            if(isNowTimeMinOver(etime) > 0){
                                now_coupon_gx_reservationcount++; //현시간기준 예약한 미래의 횟수
//                                console.log("000 "+etime);
                            }else {
                                now_coupon_gx_usecount++;//현시간기준 완료된 예약횟수
//                                console.log("111 "+etime);
                            }                            
                        }
                        
                             
//                        console.log(user_uid+" :  couponid "+selected_gx_coupon.id+" : "+getDDay(getTotalEndtime(selected_gx_coupon)));
                        if (user_uid == roomuser.useruid && getDDay(getTotalEndtime(selected_gx_coupon)) >= 0)
                        if(isNowTimeMinOver(etime) > 0){
                            if(!user_reservation_couponcount[uid_couponid])user_reservation_couponcount[uid_couponid] = {"use":0,"reservation":0};
                            user_reservation_couponcount[uid_couponid].reservation++;
                        }else {
                            if(!user_reservation_couponcount[uid_couponid])user_reservation_couponcount[uid_couponid] = {"use":0,"reservation":0};
                            user_reservation_couponcount[uid_couponid].use++;
                        }   
                    }
            
                    
                var isdelete = selected_gx_coupon.isdelete && selected_gx_coupon.isdelete != "N" ? true : false;
                if(isCouponArea(allgxcoupons,yyyymmdd))
                alldata.push({ type_ptgx : "그룹", title: title, start: start, roomdata:roomdata,isdelete:isdelete});
            
        }
        console.log("user_reservation_couponcount ",user_reservation_couponcount);
        setGXAllCount(selected_gx_coupon, now_coupon_gx_usecount);
         is_insert_gx = true;
        checkAllDataInsert();

    }
    
     //예약한 현재시간 기준 사용 횟수다 uid_couponid
    function getGXCouponUseCount(uid_couponid,user_usecount){
        if(user_reservation_couponcount[uid_couponid] && user_reservation_couponcount[uid_couponid].use >= 0)
            return user_reservation_couponcount[uid_couponid].use;
        else return user_usecount;
    }
    //예약한 현재시간 이후 미래의 횟수다 uid_couponid
    function getGXCouponReservationCount(uid_couponid){
        if(user_reservation_couponcount[uid_couponid] && user_reservation_couponcount[uid_couponid].reservation >= 0)
            return user_reservation_couponcount[uid_couponid].reservation;
        else return 0;
    }
    function setGXAllCount(selected_gx_coupon,allusecount){
        if(!selected_gx_coupon)return;
       
        var uid_couponid = user_uid+"_"+selected_gx_coupon.id;
        gx_usecount = getGXCouponUseCount(uid_couponid,allusecount);
        gx_reservationcount = getGXCouponReservationCount(uid_couponid);
        gx_remaincount = gx_maxcount - gx_usecount - gx_reservationcount;
        console.log(" 총횟수 "+gx_maxcount+" 사용횟수 "+gx_usecount+" 예약횟수 "+gx_reservationcount+" 남은횟수 "+gx_remaincount);
        var txt_gx_allcount = document.getElementById("txt_gx_allcount");
        var txt_gx_usecount = document.getElementById("txt_gx_usecount");
        var txt_gx_reservationcount = document.getElementById("txt_gx_reservationcount");
        var txt_gx_remaincount = document.getElementById("txt_gx_remaincount");
        
        txt_gx_allcount.innerHTML = ""+gx_maxcount;
        txt_gx_usecount.innerHTML = ""+gx_usecount;
        txt_gx_reservationcount.innerHTML = ""+gx_reservationcount;
        txt_gx_remaincount.innerHTML = ""+gx_remaincount;
        
         
    }
    
    //유효한 회원권들 기한내 방정보만 보여준다.
    function isCouponArea(allcoupons,mdate){
        var flg = false;
        for(var i = 0 ; i < allcoupons.length; i++){
            var coupon = allcoupons[i];
            if(compare_date(coupon.starttime, mdate) <= 0 && compare_date(getTotalEndtime(coupon), mdate) >= 0){
                flg = true;
                break;
            }
        }
        
        return flg;
    }
    var is_insert_pt = false;
    var user_uid = "<?php echo $uid; ?>";
    function insertCalenderDatas(datas){
//        clog("insertCalenderData ",datas);
        for(i = 0; i < datas.length; i++) {
            for(var j =0 ; j < datas[i].times.length; j++){
                var obj = datas[i];
                var tdate = obj.date;
                tdate = tdate.replace(" ","T");
                var date = new Date(tdate);

                
                var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
                    y = date.getFullYear();
                    m = date.getMonth();  //
                    d = date.getDate();
                    hh = parseInt(obj.times[j].time);
                    mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                    start = new Date(y, m, d, hh, mm);
                    end = start;
                
                 
                
                var today = getToday(); 
                var now = getToday(start);
                var isover = get_Day(today,now);
                
                var userlen = obj.times[j].members.length;
                var isopenstr = (obj.opentype == "close") ? "클로즈됨" : "예약가능";
                
                if(obj.opentype != "close" && userlen >= obj.max) isopenstr = "정원초과";
                
                var isuser = userlen < obj.max ? false : true;
                var isinserted = 0;
                var user = "<?php echo $uid; ?>";
                
                console.log(" uid is "+user);
                var timeuser = null;
                for(var a =0 ; a< userlen;a++){
                    if(obj.times[j].members[a].uid == user){
                        isinserted = 1; //내가 예약했다.
                        timeuser = obj.times[j].members[a];
                       
          
                        if(obj.times[j].members.length > 0 && isinserted == 0)
                            isinserted = 2; //다른사람이 예약했다.

                        if(isinserted == 1){
                            isuser = true;
                            isopenstr = timeuser && timeuser.status == 10 ? "예약요청됨" : "예약확인됨";

                        }else if(isinserted == 2){
                            isuser = false;
                            isopenstr = "다른고객이 예약함";
                        }
        //                
                        if(isover < 0){
                            isopenstr = "기간만료";

                        }
                        if(timeuser){
                            if(timeuser.status == 1){

                                isopenstr = " - "+timeuser.note;
                            }else if(timeuser.status == 2){

                                isopenstr = "운동종료됨";
                            }


                            var backimg = mColorImg.R_REQUEST; //10 예약신청
                            if(parseInt(timeuser.status) == 0){
                                 backimg = mColorImg.R_USERCHECKED; //0 고객승인
        //                        fontcolor = "#333333";
                            }

                             //운동완료상태 XXX
        //                    if(parseInt(timeuser.status) == 1){
        //                        var tcss = setDivType("tranerfinish");
        //                        backimg = tcss.titlebackimg;
        //                        fontcolor = tcss.fontcolor;
        //                    }
                            //2 완료
                            else if(parseInt(timeuser.status) == 2){  

                                backimg = mColorImg.R_FINISH;
        //                        fontcolor = tcss.fontcolor;
                            }
                        }



                        var txt_note = timeuser.note.indexOf("[수동삽입]") >= 0 ? "[수동삽입]" : timeuser.note;

                        var ttt = datas[i].times;    
                        var status = timeuser ? timeuser.status : 0;
                        var note = timeuser ? "<br><div style='margin-top:5px'><text style='color:white;font-size:12px;margin-left:10px;'>Note: </text><text style='width:150px;height:17px;background-color:#62393233;border-radius:4px;color:white;font-size:11px;border:0 solid black;padding-left:10px;padding-right:10px;padding-bottom:1px'/>"+txt_note+"</text></div>" : "";

                        var title = isuser ? get_reservation_status_tag(status)+"<text style='color:white;font-size:12px'> "+userlen+"/"+obj.max+"  "+obj.name+" "+isopenstr+"</text>"+note : "오픈됨"; //제목이지만 내용을 적으면 된다.

                        //다른고객이 예약한부분은 보여주지 않는다.
                        if(isuser && isover >= 0 || isuser && isover < 0 && timeuser != null){         
                            var note = timeuser && timeuser.note ? timeuser.note : "";
                            var couponid = timeuser && timeuser.couponid ? timeuser.couponid : "";
                            alldata.push({ type_ptgx : "PT", title: title,teachid: obj.teachid , name: obj.name ,user: isuser, status:status, opentype: obj.opentype, start: start, end: end, allDay: allday,isover:isover,note:note,couponid:couponid,backgroundimage:backimg ,notedata : timeuser.note});
                        } 
                    }
                }

            }
            
        }
        is_insert_pt = true;
        checkAllDataInsert();
        
        
       
    }
    
    function checkAllDataInsert(){
        
        if(is_insert_pt && is_insert_gx){
          
            alldata.sort(function(a, b) {
                return (+a.start) - (+b.start);
            });

            //data must be sorted by start date

            //Actually do everything
            $('#holder').calendar({
                data: alldata
            });
            window.el = $('#holder');
            
        }
    }
    
    
    var first_goto_day = false;
    
    if(!first_goto_day && param_day){
        
          
        var fInterval = setInterval(function(){
            if(!isfirst){
                // 달력으로 이동한다.테스트
                window.options.mode = "day";
                var date = new Date(parseInt(param_day));
                window.options.date = date;
    //            window.calendar(window.el,window.options); //날짜를 2개 건너띄는 버그
                if(window.mdraw)window.mdraw();
                first_goto_day = true;
            }
        },100);
    }
    
    //mode == day 라면 해당날짜로 간다.
    function reload_calendar_page(centercode){
        if(centercode)param_centercode = centercode;
        
        var mode = window.options && window.options.mode ? window.options.mode : "month";
        var date = window.options && window.options.date ? window.options.date.getTime() : "";
        param_day = mode == "day" ? date : "";
        refresh_page("?centercode="+param_centercode+"&day="+param_day); 
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
    function minToHourText(minnum){
        var h = parseInt(minnum/60);
        var m = minnum%60;
        var hstr = h > 0 ? h+"시간" : "";
        var mstr = m > 0 ? m+"분" : "";
        var rstr = hstr ? hstr+" "+mstr : mstr;
        if(!hstr && !mstr)rstr = "0분";
        return rstr;
        
    }
    function insert_gxuser(roomid,intype,nexttype,hour,btntxt,room_name,room_managername,hour,roommin,userlen,maxuser,txt_cntcolor,bgcolor,tdate,str_gxinfo,txt_startend,room_starttime,isdelete){
//        clog("isdelete ",isdelete);
        var gxinfo = JSON.parse(str_gxinfo);
        var global_gxinfo = getGlobalGXInfo(gxinfo.room_type);
//        clog("insert_gxuser intype "+intype);
        //강좌이름
        var txt_roomname = "<div style='float:left;margin-top:-40px;'><text style='font-size:16px;color:white;font-weight:bold'>"+room_name+"</text></div>";
        //박스안 강사이름
        var txt_teacher_name = "<div style='position:absolute;margin-left:56px;margin-top:5px;'><text style='font-size:14px;color:white;'><b>"+room_managername+"</b> 강사</text></div>";
        //박스안 시간 
        var txt_time = "<div style='position:absolute;margin-left:26px;margin-top:20px;width:150px;height:30px'>"+
            "<img src='./img/icon_class_time.png' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+txt_startend+"</text></div>";

        //박스안 사진
        var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:1px'><img src='./img/arcicon_2.png' style='width:46px;height:46px;border-radius:23px'/></div>";
        
        //박스안 인원 표시
        var txt_usercnt = "<div style='float:right;margin-top:10px;margin-right:5px;'><text style='font-size:20px;color:"+txt_cntcolor+";font-weight:600'>"+userlen+"/"+maxuser+"</text></div>";
        
        //박스
        var box = "<div style='font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:70px;background-color:"+bgcolor+";border-radius:10px'>"+arc_div+txt_teacher_name+txt_time+txt_usercnt+"</div>";
        //일,월,화,수,목,금,토
//        clog("aa tdate is "+tdate);
        var week = getDateOfWeek(tdate);
        //큰날짜
        var txt_date = "<text class='fmont' style='float:left;font-size:17px;color:white;'>"+tdate+". ("+week+") "+txt_startend+"</text>";
        //줄
        var hr_line = "<hr style='margin-top:20px;border: solid 1px #393939;'>";
        
       
        
        /////////////////////////////////////////////
        //예약가능시간   (방에 설정된 예약가능 , 취소시간)
        var reservation_min =  parseInt(gxinfo.room_reservationmin) == 0 ? "항상 예약가능" : "수업시작 "+minToHourText(gxinfo.room_reservationmin)+" 전까지 예약가능";
        var cancel_reservation_min = "수업시작 "+minToHourText(gxinfo.room_cancelreservationmin)+" 전까지만 취소가능";
        
        //Global 예약가능시간    (현재 어드민에 설정되어있는 예약가능 ,취소시간)
//        var reservation_min =  parseInt(global_gxinfo.insertmaxtime) == 0 ? "항상 예약가능" : global_gxinfo.insertmaxtime+"분 전까지 예약가능";
//        var cancel_reservation_min = global_gxinfo.canceltime+" 분 전까지만 취소가능";
        /////////////////////////////////////////////
        
        var remain_thisweek_reservation_count = parseInt(global_gxinfo.gxmaxreservation) - thisweek_reservation_count < 0 ? 0 : parseInt(global_gxinfo.gxmaxreservation) - thisweek_reservation_count;
        var info_title = "<text style='float:left;font-size:14px;color:white;font-weight:500;margin-top:5px'>예약취소 안내</text>";
        
        var info_message = "<text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> 예약횟수: 주 "+global_gxinfo.gxmaxreservation+"회중 "+remain_thisweek_reservation_count+"회 예약가능</text>"+
                          
                           "<br><text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> 예약시간: "+reservation_min+"</text>"+
                           "<br><text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> 취소시간: "+cancel_reservation_min+"</text>";
                           "<br><text style='float:left;color:"+mColor.C919191+";font-size:14px'><span style='margin-left:5px;font-weight:bold'>&#183;</span> Note: "+gxinfo.room_note+"</text>";
                           
        var info_div = "<div align='left' style='width:100%;height:auto;'>"+info_title+"<br><br>"+info_message+"</div>";
        
        
        var cancel_title = "<div style='position:absolute;margin-left:16px;margin-top:20px;width:150px;height:30px'>"+
            "<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+hour+":"+roommin+"~"+hour+":"+roommin+"</text></div>";
        
        var date = window.options && window.options.date ? window.options.date.getTime() : "";
        var message = "<div style='padding-left:20px;padding-right:20px'>"+txt_roomname+box+"<br>"+txt_date+"<br>"+hr_line+""+info_div+"</div>";
        
        //날짜가 지났다면 확인버튼만 보여준다.
//        console.log("room_starttime "+room_starttime)
        var canceltime = nextMin(room_starttime,-parseInt(gxinfo.room_cancelreservationmin));
        var reservationtime = nextMin(room_starttime,-parseInt(gxinfo.room_reservationmin));
//        console.log("intype "+intype+" c minover "+isNowTimeMinOver(canceltime)+" r minover "+isNowTimeMinOver(reservationtime)+" btntext "+btntxt);
        if(intype == 0 && isNowTimeMinOver(canceltime) > 0 || intype != 0 && intype != 2 && isNowTimeMinOver(reservationtime) > 0){
//            clog("reservationtime ",reservationtime);
//            clog("000");
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
            
            showModalDialog(document.body, "",message, btntxt, "닫기", function() {

                send_gxuser(roomid,nexttype,gxinfo,function(res){
                    if(res != null){
                        var code = parseInt(res.code);
                        if(code == 100){
                            alertMsg(res.message,function(){
                                reload_calendar_page();
                            });    
                        }else {
                            alertMsg(res.message);
                        }
                        
                    }else
                        alertMsg("네트워크 에러");
                });

            }, function() {
               hideModalDialog();
            },style);
            
        }
        //날짜가 안지났다면 취소(닫기) , 예약하기... 2개버튼을 보여준다.
        else {
//            clog("111");
//            alertMsg("예약가능한 시간이 아닙니다.");
            showModalDialog(document.body, "",message, "닫기", null, function() {

               hideModalDialog();

            }, null);
        }
        
       
    }
    function getGXInType(roomid,users,readyusers,max){
                var muid = "<?php echo $uid; ?>";
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
                if(!isin && ismax){
                    intype = isreadyin ? 5 : 4; //강좌꽉참 대기신청해야함
                } 
                if(!isin && !ismax && isreadyin){ //대기신청되어있음
                    intype = 5;
                }
                return intype;
            }
    

    function send_gxuser(roomid,intype,gxinfo,callback){
        //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
        var couponid = "";
        var starttime = "";
        var endtime = "";
        var useruid = "<?php echo $uid; ?>";
        var userid = "<?php echo $id; ?>";
        var nowgxcoupon = get_user_gxcoupondata(intype,roomid);
        if(!nowgxcoupon){
            alertMsg("예약가능한 회원권이 없습니다.");
            return;
        }
        couponid = nowgxcoupon.id;
        starttime = nowgxcoupon.starttime;
        endtime = getTotalEndtime(nowgxcoupon);
        
//        if(intype == 0 || intype == 5){
//            
//            
//            couponid = nowgxcoupon.id;
//            starttime = nowgxcoupon.starttime;
//            endtime = getTotalEndtime(nowgxcoupon);
//            
//        }
//        else {
//            var room_userdata = getRoomUserData(gxinfo,useruid);
//            if(room_userdata){
//                couponid = room_userdata.couponid;
//                starttime = room_userdata.starttime;
//                endtime = getTotalEndtime(nowgxcoupon);
//            }
//            
//        }
        
        var istimeout = false;
        
        var value = {
            "inserttime":"",
            "couponid" : couponid,
            "username" : username,
            "useruid" : useruid,
            "userid" : userid,
            "starttime" : starttime,
            "endtime" : endtime,
            "status" : intype,
            "coupons" : membership_coupons
        };
        var _data = {
            "type": "insertgxuser", // group or center or auth
            "centercode": nowcentercode,
            "value" : {"user": value,"roomid":roomid}
        };
        
        CallHandler("my_reservation", _data, function (res) {
            
            if(!istimeout){
                istimeout = true;
                callback(res);
            }

        }, function (err) {
            if(!istimeout){
                istimeout = true;
             callback(null);
            }
        });    
        setTimeout(function(){
            if(!istimeout){
                istimeout = true;
                alertMsg("응답시간초과! 다시시도해 주세요");
            }
        },10000);

    }
    function getRoomUserData(gxinfo,uid){
        var room_user = null;
        for(var i = 0 ; i < gxinfo.room_users.length;i++){
            if(gxinfo.room_users[i].useruid == uid){
                room_user = gxinfo.room_users[i];
                break;
            }
        }
        return room_user;
    }
    /* 221031 유진 수정 */
    function get_user_gxcoupondata(intype,roomid){ // type 추가  //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
        var info = null;
        var roomdata = getRoomdata(roomid);
        var membership = allgxcoupons;
        var gxcoupon = null;
        var offset_starttime = "";
        for(var i = 0 ; i < membership.length; i++){
            if(membership[i].mbstype == TYPE_GX){
                var maxcount = getMbsMaxCount(membership[i]);// parseInt(membership[i].mbsmaxcount);
                var usecount =  parseInt(membership[i].usecount);
                
                var isdelete = membership[i].isdelete && membership[i].isdelete == "D" ? true : false;
                var issendedcoupon =  membership[i].issendedcoupon && membership[i].issendedcoupon == -1 ? true : false;
                var isfulluse = intype == 0 && usecount >= maxcount ? true : false; //예약하기 할때만 체크한다.
                
                
                var room_datetime = roomdata.room_datetime;
                
                //오늘기준 날짜가 안지났으면서 해당회원권이 예약날짜종료일 안에 있다면
//                console.log("getDDay(getTotalEndtime(membership[i])) "+getDDay(getTotalEndtime(membership[i])));
//                console.log("start  "+compare_date(room_datetime, membership[i].starttime));
//                console.log("end "+compare_date(room_datetime, getTotalEndtime(membership[i])));
                if(getDDay(getTotalEndtime(membership[i])) >= 0 && compare_date(room_datetime, membership[i].starttime) >= 0  && compare_date(room_datetime, getTotalEndtime(membership[i])) <= 0 ){
//                    console.log("aaa");
                    if(!isdelete && !issendedcoupon && !isfulluse){//삭제된쿠폰이 아니라면
//                        console.log("aaa");
                        gxcoupon = membership[i];    
                        break;
                    }
                }
                    
                
//                if(gxcoupon)clog(i+" gxcoupon.starttime "+ gxcoupon.starttime+" membership[i].starttime "+membership[i].starttime+" compare "+compare_date(gxcoupon.starttime,  membership[i].starttime)+" dday "+getDDay(endtime));
            }
        }
        
        
//        clog("gxcoupon ",gxcoupon);

        return gxcoupon;
         
        
    }
    
</script>
