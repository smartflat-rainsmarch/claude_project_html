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
    <script src="js/scripts.js?ver3.02a"></script>

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
        
    </style>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->





</head>

<body style="background-color:#111111;" >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    
    <div id='div_center_list' style='position:fixed;width:100%;height:50px;background-color:#111111;z-index:999'>
        <div align="center" style="width:100%;height:60px;position:fixed;z-index:999;background-color:#111111;border-bottom:1px solid #292929">
            <text id='txt_title' style="color:white;text-align:center;font-size:20px;height:100%;line-height:60px;">회원권 예약</text>
            <div onclick='call_app()' style='float:left;width:60px;height:60px;'><img src='./img/button_back_sub.png' style='float:left;margin-left:20px;margin-top:20px;width:9px;height:18px;'/></div>
            <div onclick='reload_calendar_page()' style='float:right;width:60px;height:60px;margin-right:7px'><img src='./img/button_reload.png' width='31px' height='30px'style="margin-top:15px;"/></div>
            
        </div>

    </div>
    <div align='center' style='position:absolute;width:100%;margin-top:-14px'><text style='color:#fffd00;font-size:10px;text-align:center'><img src="./img/guide_arrow.png">&nbsp;&nbsp;화면을 아래로 당겨서 새로고침하세요.</text></div>
    <div id="main" style='margin-top:60px'>
        
<!--        <label style="font-size:12px;color:#fffd00;padding-left:20px;">*화면을 아래로 당겨서 새로고침</label>-->
        <div id="container" class="container" >
            
        </div>
        
        <div id="reservation_container"style="display:none;">
            <div id="reservation_center">

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
                
                
                <div class="calendar_container theme-showcase">
                    <div id="holder" align="center" style="background-color:#191919;border-radius:20px;margin-top:5px"></div>
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
        
         var zoom = setZoom();

        
        var isfirst = true;
        var param_centercode = getParam("centercode");
        var param_day = getParam("day");
    
        var calendar_data = null;
//        var reservationinfo = null;
        var reservationinfo = null;
        var container = document.getElementById("container");
        
        var selected_my_reservation = null;
        
        
        
        //당겨서 새로고침
        PullToRefresh.init({
            mainElement: '#main',
            onRefresh: function() { 
//                refresh_page("?centercode="+param_centercode+"&day="+param_day); 
                reload_calendar_page();
            }
        });
        
        var all_reservation =[];
        
//        var data = {
//            type: "myreservation"           
//        }
//        
//        CallHandler("my_gxreservation", data, function(res) {
//        var code = parseInt(res.code);
//      
//        if (code == 100) {
//            
//            if(res.message == ""){
////               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
//                alertMsg("회원권 목록이 없습니다.",function(){
//                    call_app();
//                });
//                return;
//            }
//            
//            ////////////////////////////////////////////
//            // 삭제된 쿠폰이나 횟수를 모두 사용한 쿠폰은 보여주지 않는다.
//            ////////////////////////////////////////////
//            
//            var json_array = [];
//           // var array = JSON.parse(res.message);
//            var array = res.message;
//            for(var i = 0 ; i < array.length; i++){
//                 var json = array[i];
//                 var maxcount = json.mbsfreecount ? parseInt(json.mbsmaxcount) + parseInt(json.mbsfreecount) : parseInt(json.mbsmaxcount);
//                var isdelete = json.isdelete && json.isdelete == "D" ? true : false;
//                var usecount = parseInt(json.usecount);
////                clog("maxcount "+maxcount+" usecount "+usecount);
//                //if(usecount < maxcount && !isdelete)
//                if(!isdelete)
//                    json_array.push(json);
//            }
//            all_reservation = json_array;
//            ////////////////////////////////////////////
//            // 삭제된 쿠폰이나 횟수를 모두 사용한 쿠폰은 보여주지 않는다.
//            ////////////////////////////////////////////
//            
////            document.write(res.message);
//            var container = document.getElementById("container");
//            var br0 = document.createElement('br');  
//            container.innerHTML = "";
//            
////            clog("json_array.length "+json_array.length);
//            if(json_array.length == 0){
//                alertMsg("회원권 목록이 없습니다.",function(){
//                    call_app();
//                });
//                return;
//            }
//            else if(json_array.length == 1){                
//               getGXTeacher(json_array[0],1);
//            }
//            else if(json_array.length > 1){
//                
//                
//                for(var i = 0 ; i < json_array.length; i++){
//                    const json = json_array[i];
//                    var title = json.manager ? json.manager : "담당자 미지정";
//                    if(json.mbstype == TYPE_GX){
//                        title = json.mbsname;
//                    }
//                    var isboxon = 0;
//                    
//                    var regtime = json.id ? json.id.substr(0,10) : ""; // 아이폰때문에 무조건 substr 이다.
//                    var maxcount = json.mbsfreecount ? parseInt(json.mbsmaxcount) + parseInt(json.mbsfreecount) : parseInt(json.mbsmaxcount);
//                    var usecount = json.usecount ? json.usecount : 0;
//                   
//                    
//                    
//                    var isdisabled = json.isdelete  && json.isdelete == "D" || isgx && !json.manager ? "disabled" : "";
//                    
//                   
//                    var etag = "</div></div>";
//                    //삭제됬거나 담당자가 없다면
//                    if(json.isdelete  && json.isdelete == "D" || isgx && !json.manager){
//                        var title_tag = "<div style='padding-top:20px;width:100%;height:30px'><text style='text-align:center;color:"+mColor.C919191+";font-size:17px'>["+regtime+"] <span style='color:"+mColor.YELLOW_DISABLED+";font-weight:bold'>"+title+"</span></text></div>";
//                        var subtitle_tag = "<div style='margin-top:20px;width:100%;height:20px'><text style='text-align:center;color:"+mColor.C919191+";font-size:13px'>"+json.mbstype+" "+maxcount+"회 중 "+usecount+"회 사용</text></div>";
//                        var ftag = "<div style='padding:10px' align='center'><div onclick='clickReservation("+i+", "+isboxon+")' style='width:100%;height:90px;background-image:url(./img/box_my_payroll.png);border:0px;background-size:100% 100%;' disabled>";
//                        container.innerHTML += ftag+"<del>"+title_tag+subtitle_tag+"</del>"+etag;
//                        
//                    }
//                    //횟수를 모두 채웠다면 비활성
//                    else if(maxcount == usecount){
//                        var title_tag = "<div style='padding-top:20px;width:100%;height:30px'><text style='text-align:center;color:"+mColor.C919191+";font-size:17px'>["+regtime+"] <span style='color:"+mColor.YELLOW_DISABLED+";font-weight:bold'>"+title+"</span></text></div>";
//                        var subtitle_tag = "<div style='margin-top:20px;width:100%;height:20px'><text style='text-align:center;color:"+mColor.C919191+";font-size:13px'>"+json.mbstype+" "+maxcount+"회 중 "+usecount+"회 사용</text></div>";
//                        var ftag = "<div style='padding:10px' align='center'><div onclick='clickReservation("+i+", "+isboxon+")' style='width:100%;height:90px;background-image:url(./img/box_my_payroll.png);border:0px;background-size:100% 100%;'><text style='text-align:center;color:white;font-size:13px'>";
//                        container.innerHTML += ftag+title_tag+subtitle_tag+etag;
//                        
//                    }
//                    else {
//                        isboxon = 1;
//                        var title_tag = "<div style='padding-top:20px;width:100%;height:30px'><text style='text-align:center;color:"+mColor.C292929+";font-size:17px'>["+regtime+"] <span style='color:"+mColor.YELLOW+";font-weight:bold'>"+title+"</span></text></div>";
//                        var subtitle_tag = "<div style='margin-top:20px;width:100%;height:20px'><text style='text-align:center;color:white;font-size:13px'>"+json.mbstype+" "+maxcount+"회 중 "+usecount+"회 사용</text></div>";
//                        var ftag = "<div style='padding:10px' align='center'><div onclick='clickReservation("+i+", "+isboxon+")' style='width:100%;height:90px;background-image:url(./img/box_my_payroll_on.png);border:0px;background-size:100% 100%;'><text style='text-align:center;color:white;font-size:13px'>";
//                        container.innerHTML += ftag+title_tag+subtitle_tag+etag;
//                        
//                        isboxon = 1;
//                    }
//                }
//            }
//            
//            
//           
//        } else {
//            alertMsg(res.message);
//            
////            show_error_popup("ERROR",res.message, "exit");
//        }
//
//    }, function(err) {
//        alertMsg("네트워크 에러 ");
////         show_error_popup("ERROR","네트워크 에러", "exit");
//    });
//        
//        
//    function clickReservation(idx,isboxon){
//        getGXTeacher(all_reservation[idx],isboxon);
//    } 
        
        getGXTeacher();
        
    var nowcoupon = null;    
    var isgx = false;
    
    var gxtypes = null;
    var gxteachers = null;
    function getGXTeacher(rjson,isboxon){
        selected_my_reservation = rjson;
        isgx = true;
        
        if(isgx){
            document.getElementById("icon_txt_1").innerHTML = "오픈";
            document.getElementById("icon_txt_2").innerHTML = "예약함";
            document.getElementById("icon_txt_3").innerHTML = "출석";
            document.getElementById("icon_txt_4").innerHTML = "정원초과";
            document.getElementById("icon_txt_5").innerHTML = "대기신청";
        }
        
        
        var txt_title = document.getElementById("txt_title");
        if(isgx) txt_title.innerHTML = "GX 회원권 예약";
        

        var centercodes_str = "<?php echo $centercodes; ?>";
        var centercodes = centercodes_str.split(',');
        param_centercode = centercodes[0];
        var user = "<?php echo $uid; ?>";
        
//        nowcoupon = rjson;
//        if(teachtype == "PT" && !teacheruid){
//            alertMsg("아직 담당 강사가 선택되지 않았습니다.");
//            return;
//        }
        
//        initMyInfo(rjson,isboxon);
        

        var data = {
            type: "gxteacher_reservation",
            centercode : param_centercode,
        }
       
        CallHandler("my_gxreservation", data, function(res) {
            var code = parseInt(res.code);
//             clog("customer_teacherreservation res is ",res);
            if (code == 100) {

                var json = res.message;
                setCalendar(json);
               
                if(res.gxtypes)gxtypes = res.gxtypes;
                if(res.gxteachers)gxteachers = res.gxteachers;
                
                var ready_count = 0;
                var fix_count = 0;
                //회수중에 예약요청한 횟수도 포함한다.
                if(isgx){
                    
                }
                
//                clog("mbs_use_count "+mbs_use_count+"ready_count "+ready_count+" fix_count "+fix_count);
                setTitleCount(ready_count);
                
            } else {
                alertMsg(res.message);

//                show_error_popup("ERROR", res.message, "exit");
            }

        }, function(err) {
                    alertMsg("네트워크 에러 ");
//            show_error_popup("ERROR", "네트워크 에러", "exit");
        });
    }
        
        var mbs_max_count = 0;
        var mbs_use_count = 0;
        var mbs_couponid = "";
        function initMyInfo(json,isboxon){
            var div_manager_box = document.getElementById("div_manager_box");
            var manager_name = document.getElementById("manager_name");
            var coupon_info = document.getElementById("coupon_info");
            var coupon_startend = document.getElementById("coupon_startend");
            
            //비활성 박스 UI 처리
            if(!isboxon){
                div_manager_box.style.backgroundImage = "url(./img/box_mybooking.png)";
                manager_name.style.color = mColor.YELLOW_DISABLED;
                coupon_info.style.color = mColor.C919191;
                coupon_startend.style.color = mColor.C919191;
                
            }
                

            manager_name.innerHTML = json.mbstype == TYPE_GX ? json.mbsname : json.manager;
            var maxcount = json.mbsfreecount ? getMbsMaxCount(json) + parseInt(json.mbsfreecount) : getMbsMaxCount(json);
            coupon_startend.innerHTML = json.starttime.substr(0,10)+" ~ "+json.endtime.substr(0,10);
            mbs_max_count = maxcount;
            mbs_use_count = json.usecount ? parseInt(json.usecount) : 0;
            mbs_couponid = json.id;   
            
            
//            setTitleCount(0);
        }
        function setTitleCount(reservation){
            var coupon_info = document.getElementById("coupon_info");
            var txt_ptcount = document.getElementById("txt_ptcount");
//            clog("mbsuse "+mbs_use_count+" reservation "+reservation);
            var new_usecount = mbs_use_count+reservation;
            if(new_usecount > mbs_max_count)new_usecount = mbs_max_count;
            
            coupon_info.innerHTML = "GX "+mbs_max_count+"회 이용권";
            txt_ptcount.innerHTML = "<span style='color:#fffd00;font-weight:bold'>"+new_usecount+"</span>/"+mbs_max_count;
        }
        
        
        
        
        function setCalendar(json){
            
            var container = document.getElementById("container");
            container.style.display = "none";
            reservation_container.style.display = "block";
            calendar_data = json;
            
            insertGXCalenderDatas(json);
            
        }
        
        function set_title(title) {
            document.title = title;
            //        reservation_title.innerHTML = title;
        }

        function initReservation(json) {
            clog("강사 일정표 ", json);

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
            var mid = selected_my_reservation.managerid;
            var mtype = selected_my_reservation.mbstype;
            var centercode = selected_my_reservation.mbsusecentercode;
            var couponid = selected_my_reservation.id;
            
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
//            var mid = selected_my_reservation.managerid;
//            var mtype = selected_my_reservation.mbstype;
//            var centercode = selected_my_reservation.mbsusecentercode;
//            var couponid = selected_my_reservation.id;
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
            
            CallHandler("my_gxreservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {

                   var data = res.message;
                   var teacher_token = data.fcmtoken;
                   //////////////////////////////////////////////////////
//                   update_user_result(info,date,hh,nextstatus,data); //화면 색과 버튼을 바꾼다.
//                   update_window_options_data(nextstatus,_date ,insertuser.teachid,data); // 윈도우 데이타를 함께 바꾼다.
                    
                    
                    var mtitle = "운동종료확인";
                    var mmessage = username+"님이 "+date+" "+time+"시 운동종료 확인을 하였습니다.";    
                    
                    if(nextstatus == 0){
                        mtitle = "예약확인";
                        mmessage = username+"님이 "+date+" "+time+"시 운동예약 확인을 하였습니다.";                        
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
                                <span class="btn-group" style="border-radius:20px;margin-left:5px;margin-right:2px;">
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:16px 0px 0px 16px;padding-left:15px" class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year"><text id="txt_year">년</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px" class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month"><text id="txt_month">월</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px" class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week"><text id="txt_week">주</text></button>
                                    <button style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:0px 16px 16px 0px;padding-right:15px" class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day"><text id="txt_day">일</text></button>
                                </span>
                              <!-- 전체일정 오픈하기 -->
                                <button class="js-cal-option btn btn-default"  id="btn_teach_reservation" onclick="set_pt()" style="background-color:#333333;height:32px;color:white;font-size:13px;border-radius:16px;padding-left:15px;padding-right:15px;margin-right:2px;" >개인 PT 예약</button>
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
                <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? '':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}" style="opacity:{{: opacity }}">
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


        function calendar($el, options) {
            //actions aren't currently in the template, but could be added easily...
//            clog("callender call $el !! ",$el);
//            clog("callender call options !! ",options);
                
            $el.on('click', '.js-cal-prev', function() {
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
                draw();
                holidayCheck();
            }).on('click', '.js-cal-next', function() {
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
                draw();
                holidayCheck();
            }).on('click', '.js-cal-option', function() {
//                clog("==============================");
//                clog("option click 222");
                var $t = $(this),
                    o = $t.data();
//                clog("o is ", o);
//                clog("options is ", options);
//                clog("$t is ", $t);
                if (o.date) {
//                    clog("o.mode is " + o.mode);
//                    clog("o.date is " + o.date);
                    o.date = new Date(o.date);
                    if (o.mode == undefined) o.mode = "day";

                }

                param_day = o.mode && o.mode == "day" && o.date ? o.date.getTime() : "";
                
                $.extend(options, o);
                draw();
                holidayCheck();

            }).on('click', '.js-cal-years', function() {
//                clog("years click 222");
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
            }).on('click', '.event', function() {
//                clog(" click 3333");
                var $t = $(this),
                    o = $t.data();
                if (o.date) {
                    clog("o.mode is " + o.mode);
                    clog("o.date is " + o.date);
                    o.date = new Date(o.date);
                    if (o.mode == undefined) o.mode = "day";

                    holidayCheck();
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
            
            
            function dayAddEvent(index, event) {
                var e = new Date(event.start),
                dateclass = e.toDateCssClass();
                var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                
                //GX 예약화면
//                if(isgx)
                {
                    var e = new Date(event.start),
                    dateclass = e.toDateCssClass(),
                    startint = event.start.toDateInt(),
                    dateint = options.date.toDateInt();
                    
                    

                    var clickid = event.roomdata.room_id;
                    var room = event.roomdata;
                    var roomid = room.room_id;
                    var max = room.room_max;
                    var txt_date = event.start.getFullYear()+". "+(event.start.getMonth()+1)+". "+event.start.getDate();
                    var roomname = room.room_name;
                    var userslen = room.room_users ? room.room_users.length : 0;
                    var hour = parseInt(event.start.getHours());
                    var roommin = room.room_min;
                    
                    var yearmonthnum = parseInt(event.start.getFullYear())*12+parseInt(event.start.getMonth())+1;
                    var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                    var isbeforesame = false;
                    
//                    clog(" clickid "+clickid+" roomid "+roomid+" max "+max+" sdate "+sdate+" roomname "+roomname+" userslen "+userslen+" hour "+hour+" roommin "+roommin+" yearmonthnum "+yearmonthnum+" sdate "+sdate);
                    
                    var smm = mm < 10 ? "0"+mm : mm;
                    var sdd = dd < 10 ? "0"+dd : dd;
                    var shh = hour < 10 ? "0"+hour : hour;
                    var smin = parseInt(roommin) < 10 ? "0"+roommin : roommin;
                    var rstart = shh+":"+smin;
                    
                    var emin = (parseInt(roommin)+50)%60; //50분기준으로 한다.
                    var ehour = smin+50 >= 60 ? hour+1 : hour;
                    if(ehour > 23)ehour = 0;
                    var ehh = ehour < 10 ? "0"+ehour : ehour;
                    var emm = emin < 10 ? "0"+emin : emin;
                    var rend = ehh+":"+emm;
                    var txt_startend = rstart+"~"+rend;
                    
                    
                    //  -1 : 예약안된상태  0: 예약만한상태  2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(대기신청아직안함) , 5 : 예약이 꽉참(대기신청완료한상태)
                    var intype_bg = ["background-image:linear-gradient(to bottom,  #fff7d1 0px, #dfd7b1 100%);","", "background-image:linear-gradient(to bottom, #e36969 0px, #f38989 100%);","","background-image:linear-gradient(to bottom,  #c997c9 0px, #dab9da 100%);","background-image: linear-gradient(rgb(199, 144, 90) 0px, rgb(219, 168, 110) 100%);"];   
                    if(startint == dateint  && isNowTimeOver(room.room_opentime) != 1 && parseInt(room.room_isshow) == 1){
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
                        var txt_roomname = "<text style='font-size:16px;color:white;font-weight:bold'>"+room.room_name+"</text>";
                        //강사이름
                        var txt_teacher_name = "<div style='position:absolute;margin-left:56px;margin-top:8px;'><text style='font-size:14px;color:white;'>"+room.room_managername+" 강사</text></div>";
                        //시간
                        var txt_time = "<div style='position:absolute;margin-left:56px;margin-top:27px;width:150px;height:30px'>"+
                            "<img src='./img/icon_class_time.png' style='width:14px;height:15px;'>&nbsp;<text class='fmont' style='text-align:center;font-size:14px;color:white;height:100%;line-height:30px'>"+txt_startend+"</text></div>";
                        //동그라미 그림
                        var arc_div = "<div align='center' style='position:absolute;width:46px;height:46px;border-radius:23px;margin-top:30px'><img src='./img/arcicon_2.png' style='width:46px;height:46px;border-radius:23px'/></div>";
                        var div = document.createElement("div");
                        var intype = getGXInType(roomid,users,ready_users,max); //   -1 : 예약안된상태 , 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  , 5 : 예약이 꽉참
                      
                        clog("***** day intype "+intype);
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
                        if(intype == 5)nexttype = 4; //꽉차서 대기신청하기
                        var txts = ["예약취소","", "예약취소","","대기신청", "대기취소"]; //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
                        var btntxt = "예약하기";
                        if(intype < 10)
                            btntxt = txts[intype];
                        
                        var bgcolor = intype == 0 ? mColor.RGX_RESERVATION : mColor.C222222;
                        var txt_cntcolor = intype == 0 ? "white" : roombg; 
                        var txt_usercnt = "<div style='float:right;margin-top:47px;margin-right:5px;'><text style='font-size:20px;color:"+txt_cntcolor+";font-weight:600'>"+users.length+"/"+room.room_max+"</text></div>";
                        
                        var str_gxinfo = setJSONStringToParamString(event.roomdata);
                        var str_roomusers = setJSONStringToParamString(users);
                        
                        
//                        clog("room ",room);
                        var room_starttime = yy+"-"+smm+"-"+sdd+" "+shh+":"+smin+":00";
//                        clog("****** room_starttime "+room_starttime+" istimeover "+ isNowTimeOver(room_starttime));
                        
                        var onclick_tag = "onclick='insert_gxuser(\"" +roomid + "\", "+intype+", "+nexttype+", "+hour+", \"" +btntxt + "\", \"" +room.room_name + "\", \"" +room.room_managername + "\", \"" +hour + "\", \"" +roommin + "\", \"" +str_roomusers + "\", \"" +room.room_max + "\", \"" +txt_cntcolor + "\", \"" +bgcolor + "\", \"" +txt_date + "\", \"" +str_gxinfo + "\", \"" +txt_startend + "\", \"" +room_starttime + "\")'";
                        
                        div.innerHTML = "<div "+onclick_tag+"  style='font-size:15px;padding-left:15px;padding-top:10px;padding-bottom:15px;padding-right:10px;height:100px;background-color:"+bgcolor+";border-radius:10px'>"+arc_div+txt_roomname+txt_teacher_name+txt_time+txt_usercnt+getGXButtonTag(roomid,intype,hour,roombg)+"</div>";
                        
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
                                    var hhmm = time_h+":"+time_min;
                                    time_txt.style.marginTop = "9px";
                                    time_txt.innerHTML = hhmm;
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
      

            }
            
            function monthAddEvent(index, event) {
                
                //GX 예약화면
//                if(isgx)
                {
                    e = new Date(event.start),
                    dateclass = e.toDateCssClass();
                    var clickid = event.roomdata.room_id;
                    var room = event.roomdata;
                    var roomid = room.room_id;
                    var max = room.room_max;
                    var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
                    var hour = parseInt(event.start.getHours());


                    var nowday = parseInt(event.start.getDate());
                    var intype_bg = ["background-image:linear-gradient(to bottom,  #fff7d1 0px, #dfd7b1 100%);","", "background-image:linear-gradient(to bottom, #e36969 0px, #f38989 100%);","","background-image:linear-gradient(to bottom,  #c997c9 0px, #dab9da 100%);","background-image: linear-gradient(rgb(199, 144, 90) 0px, rgb(219, 168, 110) 100%);"]; 
                    
                    if(dateclass == sdate && isNowTimeOver(room.room_opentime) != 1 && parseInt(room.room_isshow) == 1){//오픈시간체크
                        
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
                        var muid = "<?php echo $uid; ?>";
                        if(room.room_managerid == muid)
                        $('.' + event.start.toDateCssClass()).append(div);
//                        $('.' + event.start.toDateCssClass()).append(div);
                        
                        
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
                    clog("calendar!!! 0000");
                    return $.extend(defaults, options);
                }
            }).fn.extend({
                
                calendar: function(options) {
                    options = $.extend({}, defaults, options);
                    window.options = options;
                    return $(this).each(function() {
                        var $this = $(this);
//                        clog("extends!!! 2222",$this);
//                        clog("extends!!! 2222",options);
                        
                        calendar($this, options);
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
    var thisweek_reservation_count = 0;
    function insertGXCalenderDatas(datas){   
        alldata = [];
//        clog("datas is ",datas);
        //test
        var weeks = getThisWeek();
        

        for(i = 0; i < datas.length; i++) {
            var roomdatas = JSON.parse(datas[i].gx_roomdata);
            
            for(j = 0; j < roomdatas.length; j++) {
                var roomdata = roomdatas[j];
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
                
                var sy = y;
                var sm = date.getMonth()+1 < 10 ? "0"+(date.getMonth()+1) : date.getMonth()+1;
                var sd = d < 10 ? "0"+d : d;
                var yyyymmdd = sy+"-"+sm+"-"+sd;
                
                var isthisweek = isThisWeek(yyyymmdd, weeks);
                var intype = getGXInType(roomdata.room_id,roomdata.room_users,roomdata.room_readyusers,roomdata.roommax); //   10: 오픈됨 0: 예약만한상태 2 : 예약하고 QR 출석완료  ,  4 : 예약이 꽉참(내가없음) , 5 : 예약이 꽉참
                clog(yyyymmdd+"=========="+intype);
                if(isthisweek && intype == 0 || isthisweek && intype == 2){
                    thisweek_reservation_count++;
                }
                    
                
                alldata.push({ title: title, start: start, roomdata:roomdata});
            }
        }

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
    function insert_gxuser(roomid,intype,nexttype,hour,btntxt,room_name,room_managername,hour,roommin,str_roomusers,maxuser,txt_cntcolor,bgcolor,tdate,str_gxinfo,txt_startend,room_starttime){
       
        var users = JSON.parse(str_roomusers);
        var userlen = users.length;
        var gxinfo = JSON.parse(str_gxinfo);
        clog("gxinfo ",gxinfo);
        clog("users ",users);
        var global_gxinfo = getGlobalGXInfo(gxinfo.room_type);
        clog("insert_gxuser intype "+intype);
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
        var close_button_tag =  intype == 0 && isNowTimeMinOver(canceltime) > 0 || intype != 0 && isNowTimeMinOver(reservationtime) > 0 ? "<span onclick='' style='float:right;width:30px;height:30px'><img src = './img/button_calendar.png' style='width:12px;height:12px;margin-left:9px;margin-top:9px'></span>" : ""; 
        for(var i = 0 ; i < users.length;i++){
            var user = users[i];
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
            
//            showModalDialog(document.body, "",message, btntxt, "닫기", function() {
//
//                send_gxuser(roomid,nexttype,function(res){
//                    if(res != null){
//                        alertMsg(res,function(){
//                            reload_calendar_page();
//                        });
//                    }else
//                        alertMsg("네트워크 에러");
//                });
//
//            }, function() {
//               hideModalDialog();
//            },style);
        }
        //날짜가 안지났다면 취소 , 예약하기... 2개버튼을 보여준다.
        else {
            showModalDialog(document.body, "",message, "확인", null, function() {

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
                if(ismax && !isin){
                    intype = isreadyin ? 5 : 4; //강좌꽉참 대기신청해야함
                } 
                return intype;
            }
//    function send_gxuser(roomid,intype,callback){
//        //intype  //  0 : 예약하기 , 2 : QR 출석완료  , 3 : 예약취소 , 5 : 대기신청
//        
//        var value = {
//            "inserttime":"",
//            "couponid" : nowcoupon.id,
//            "username" : username,
//            "useruid" : "<?php echo $uid; ?>",
//            "userid" : "<?php echo $id; ?>",
//            "starttime" : nowcoupon.starttime,
//            "endtime" : nowcoupon.endtime,
//            "status" : intype
//        };
//        var _data = {
//            "type": "insertgxuser", // group or center or auth
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
//
//    }
</script>
