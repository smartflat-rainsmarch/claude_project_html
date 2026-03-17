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
<link href="./css/toast.css?var1.02" rel="stylesheet">
<link href="./css/modaldialog.css?var1.02" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    
    <script src="js/scripts.js?ver3.02a1"></script>


<link rel="stylesheet" href="./css/calendar.css?var1.02"/>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
<style>
    @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
    @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}

     body {
/*            font-family: 'Noto Sans KR', sans-serif;*/
         font-family:  : "Noto";
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

</style>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
 
    
    
    
    
    </head>

<body style="background-color:#111111;width:375px;" >

<div id= "container" style="background:#111111;" >
     <div id= "center" class="center">
         
    </div>
</div>
<div id = "reservation_container" >
    
    <!--X button-->
    <div onclick='call_app()' style='width:100%;height:46px'><img src='./img/btn_close_x.png' style='margin:20px;width:20px;height:21px'/></div>
    <!--Main-->
    <div id= "reservation_center">
        
        <!--Top-->
        <div style='margin-left:20px;margin-top:15px;margin-bottom:10px'>
            <text style="font-size:27px;color:#ffffff" id ="txt_title">타이틀</text><br>
            <div style="float:center-vertical;height:40px">
                <div style='margin-top:7px;'>
                    <img src="./img/icon_newcalendar.png" style='margin-top:-3px;width:15px;height:15px'/><text class='fmont' style="font-size:14px;color:#fff;margin-left:4px;color:#afafaf" id ="txt_date">날짜입력</text>
                </div>
            </div>
        </div>
        
        <!--다시 선택하기-->
      
       
        <div stlye="background-color:#f91919">
             <!--시작일 종료일 선택-->
            <div align = "center" style="width:100%;height:130px;background-color:#191919;border-radius: 40px 40px 0px 0px">               
                <br><text style="margin-top:40px;font-size:20px;color:#ffffff" id ="txt_message">메인메세지</text><br>
                <div style="margin-top:15px">
                    <text id='start_txt' style="float:left;margin-left:20px;color:#919191;font-size:14px">시작일</text><text id='end_txt' style="position:absolute;margin-left:-12px;color:#919191;font-size:14px">종료일</text>
                </div>
                <br>
                <div>
                    <text id="txt_id_startdate" style="visibility:hidden;float:left;margin-left:20px;color:#fff;font-size:15px;font-weight:bold">1월1일</text>
                    <text id="txt_id_enddate" style="visibility:hidden;position:absolute;margin-left:-25px;color:#fff;font-size:15px;font-weight:bold">1월1일</text>
                </div>
                <hr style="margin-top:28px;margin-left:20px;margin-right:20px;border: solid 1px #555555;">
            </div>
            
            <!--======================-->
            <!--달력-->
            <!--======================-->
            <div id="holder" align="center" style="background-color:#191919">
            
            </div>
            
            <!--======================-->
            
        </div>
        <div style="height:100px;background-color:#191919">
            <text id="id_reset" onclick="reset_holding()" style="display:none;float:left;margin-left:20px;margin-top:20px;text-decoration:underline;color:white;font-size:17px;">지우기</text>
            <text id = "btn_max_holding" style="display:none;float:left;margin-left:20px;margin-top:20px;text-decoration:underline;color:white;font-size:17px;" >최대일수 선택</text>
        
            <button id= "btn_set_holding" onclick="set_holding()" style="float:right;padding-left:35px;padding-right:35px;padding-top:10px;padding-bottom:10px;border-radius:10px;background-color:#222;font-size:17px;color:3a3a3a;font-weight:bold;margin-top:15px;margin-right:20px">홀딩신청</button>
            
        </div>
    </div>
    
</div>
     
<!--            <text id='txt_desc' style='font-size:14px;color:#888888;display:none'></text>-->
     
        
<script>
    
     setZoom();
    
    var container = document.getElementById("container");
    var reservation_container = document.getElementById("reservation_container");
    var reservation_title = document.getElementById("reservation_title");        
    
    
    var param_type = getParam("type"); // 공통
    
    
    var param_centercode = getParam("centercode");
    var param_mbsidx = getParam("mbsidx");
    var param_couponid = decodeURI(getParam("couponid"));
    var param_starttime = getParam("starttime").substring(0,10);
    var param_endtime = getParam("endtime").substring(0,10);
    var param_starttime_changecount = getParam("starttime_changecount") ? parseInt(getParam("starttime_changecount")) : 0;
    var param_mbsmaxchangestarttime = getParam("mbsmaxchangestarttime") ? parseInt(getParam("mbsmaxchangestarttime")) : 0;
    var param_iscounttype = getParam("iscounttype") ? parseInt(getParam("iscounttype")) : -1;
    
    clog("param_couponid "+param_couponid);
    var param_maxholdingday = getParam("maxholdingday") ? parseInt(getParam("maxholdingday")) : 0;
    var param_holdingstarttime = getParam("holdingstarttime") ? getParam("holdingstarttime") : "0";
    var param_holdingendtime = getParam("holdingendtime") ?  getParam("holdingendtime") : "0";
    if(param_holdingstarttime.length > 1)param_holdingstarttime = param_holdingstarttime.substring(0,10);
    if(param_holdingendtime.length > 1)param_holdingendtime = param_holdingendtime.substring(0,10);
    
    
    var holding_starttime = null;
    var holding_endtime = null;
    var getdatatype = param_iscounttype == 0 ? "my_membership" : "my_reservation";
    
    if(param_type == CHANGE_TYPE_STARTTIME){
        document.getElementById("start_txt").innerHTML = "현재시작일";
        document.getElementById("end_txt").innerHTML = "변경요청일";
        document.getElementById("btn_set_holding").style.display = "none";
    }

//    document.getElementsByClassName("js-cal-option").style.display = "none";
    
//    document.getElementById("btn_goto_today").style.display = "none";
//    document.getElementById("td_ymwd").style.display = "none";
    
    
    var click_starttimestamp = -1;

    
    var max_change_day = 30;
    
    
    var day_timestamp = 86400000;
    var month_timestamp = day_timestamp*max_change_day-1000; 
   
    
   $(document).ready(function() {
        var data = {
            type:getdatatype
        };
        CallHandler("getdata",data, function(res) {
            var code = parseInt(res.code);

            if (code == 100) {

                if(res.message == ""){
    //               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
                     show_error_popup("ERROR","목록이 없습니다.", "exit");
                    return;
                }
                var json_array = JSON.parse(res.message);
                
                //1번이라도 예약한 회원은 예약이 되지 않는다.
                if(param_type == "holding"){
                    for(var i = 0 ; i < json_array.length; i++){
                        var coupon = json_array[i];
                        if(coupon.id == param_couponid && coupon.holdingdata && getHoldingOKLength(coupon.holdingdata) > 0){
                            show_error_popup("ERROR","이미 홀딩이 승인되었습니다.", "exit");
                            return;
                        }
                    }
                }
               
    //            document.write(res.message);
                var center = document.getElementById("center");
                var br0 = document.createElement('br');  
                center.appendChild(br0);



                     for(var i = 0 ; i < json_array.length; i++){
                         var membership = json_array[i];
                         if(membership.mbsidx == param_mbsidx && membership.starttime.substring(0,10) == param_starttime && membership.endtime.substring(0,10) == param_endtime){
                            container.style.display = "none";
                            reservation_container.style.display = "block";
                            initReservation(json_array[i]);     
                            break;
                         }
                     }
                    

            } else {
    //            alertMsg(res.message);

                show_error_popup("ERROR",res.message, "exit");
            }

        }, function(err) {
    //        alertMsg("네트워크 에러 ");
             show_error_popup("ERROR","네트워크 에러", "exit");
        });
        
   });
   
    
    ///scripts.js로 이동
//   function getParam(sname) {  
//        var params = location.search.substr(location.search.indexOf("?") + 1);
//        var sval = "";
//        params = params.split("&");
//        for (var i = 0; i < params.length; i++) {
//            temp = params[i].split("=");
//            if ([temp[0]] == sname) { sval = temp[1]; }
//        }
//        return sval;
//    }
   

    function set_title(title){
        document.title = title; 
//        reservation_title.innerHTML = title;
    }
    function initReservation(json){
//        clog(param_type+" param_mbsidx "+param_mbsidx+" param_starttime "+param_starttime+" param_endtime"+param_endtime);
//        clog("json is ",json);
//        var title = json.mbs_type+" 예약현황";
//        set_title(title);
        var txt_title = document.getElementById("txt_title");
        var txt_id_startdate = document.getElementById("txt_id_startdate");
        var txt_message = document.getElementById("txt_message");
        var txt_date = document.getElementById("txt_date");
        
        if(param_type == CHANGE_TYPE_STARTTIME){
            txt_title.innerHTML = ""+json.mbsname+"";
            sdate_click = json.starttime.substr(0,10);
            var mm = stringGetMonth(json.starttime);
            var dd = stringGetDay(json.starttime);
            txt_message.innerHTML = "<b>새로운 시작일</b><span style='color:"+mColor.C919191+"'>을 선택하세요</span>";
            txt_id_startdate.style.visibility = "visible";
            txt_id_startdate.innerHTML = mm+"월"+dd+"일";
            txt_date.innerHTML = "기간 : "+param_starttime.substring(0,10)+" ~ "+param_endtime.substring(0,10)+"";   
            checkArc();
        }else if(param_type == CHANGE_TYPE_HOLDING){
            txt_title.innerHTML = ""+json.mbsname+"";
            txt_message.innerHTML ="<b>시작일</b><span style='color:"+mColor.C919191+"'>을 선택하세요</span>";
            txt_date.innerHTML = "기간 : "+param_starttime.substring(0,10)+" ~ "+param_endtime.substring(0,10)+"";    
        }
        
//        var txt_manager = document.getElementById("manager");
//        txt_max.innerHTML = json.mbs_type+" "+json.max_count+"회";
//        txt_use.innerHTML = json.max_count+"회중 "+json.use_count+"회 진행";
//        txt_period.innerHTML = json.starttime+"~"+json.endtime;
//        txt_manager.innerHTML = "담당:"+json.manager+" 트레이너";
        
    }
//    function show_error_popup(title,message,clickurl){
//        $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
//        
//    }
//    function error_click(){
//         if(window.android)window.android.closeWebView("close");    
//    }
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
  <table id="calendar_table" align="center">
    <!--==================================================-->
    <!--좌우 화살표   2022년 5월  -->
    <!--==================================================-->
    <thead>
      <tr style="height:70px">
        
        <td colspan="2">
            <button class="js-cal-prev btn btn-default" style="float:left;background-color:#00000000"> <img src = "./img/button_prev_month.png" style="width:25px;height:26px"/></button>
        </td>
        <td colspan="3" align="center">
            <span class="btn-group btn-group-lg" style="margin-top:-5px">
                
                {{ 
                
              
                    
                
                
                    if (mode !== 'day') { 
                }}
                        
                        <text style="color:white;font-size:17px;"><b>{{: year}}</b>년</text>
                {{
                        if (mode === 'month') { 
                         var m_month = months[month];
                         console.log("000 month is "+month+" m_month is "+m_month);
                           
                }}
                            
                            <text style="margin-left:10px;color:white;font-size:17px;"><b>{{: month+1 }}</b>월</text>
                {{ 
                        } 
                        if (mode ==='week') { 
                        
                }}
                            <button class="btn btn-link disabled">{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</button>
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
                        <button class="btn btn-link disabled">{{: mdate }}</button> 
                {{ 
                    } 
                }}
                </span>
        </td>
        <td colspan="2">
            <button class="js-cal-next btn btn-default" style="float:right;background-color:#00000000"><img src = "./img/button_next_month.png" style="width:25px;height:26px"/></button>
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
          {{: months[month] }}
          {{ month++;}}
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
      <tr class="c-weeks" align="center" style="width:48px;height:48px;">
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
    
    <tbody >
    {{ 
        for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { 
    }}
            <tr  align="center" >
    {{ 
            for (i = 0; i < 7; i++) { 
    }}
    {{
    
        var yy = thedate.getFullYear();
        var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
        var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
        var now = yy + "-" + mm + "-" + dd;
        
    
  
        if (thedate > last) { 
            dayclass = nextmonthcss; 
        } else if (thedate >= first) {
            dayclass = thismonthcss; 
        } 
    }}
        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? '':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
          <div style="color:white" class="date"><text id="num_{{: now }}"  class="fmont" style="font-size:15px;font-weight:400;opacity:0.3">{{: thedate.getDate() }}</text></div>
    {{ 
           thedate.setDate(thedate.getDate() + 1);
    }}
        </td>
    {{ 
        } 
    }}
        </tr>
    {{
      }
      
        
    }}
      
      
    </tbody>
    {{ } }}
    {{ if (mode ==='day') { }}
    <tbody>
      <tr>
        <td colspan="7">
          <table class="table table-striped table-condensed table-tight-vert" >
            <thead>
              <tr>
                <th> </th>
                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th class="timetitle" >All Day</th>
                <td class="{{: date.toDateCssClass() }}">  </td>
              </tr>
              <tr>
                <th class="timetitle" >Before 6 AM</th>
                <td class="time-0-0"> </td>
              </tr>
              {{for (i = 6; i < 22; i++) { }}
              <tr>
                <th class="timetitle" >{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
                <td class="time-{{: i}}-0"> </td>
              </tr>
              
              {{ } }}
              <tr>
                <th class="timetitle" >After 10 PM</th>
                <td class="time-22-0"> </td>
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
    
    holidayCheck(true,true);
        

    
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
//    var calendar_width = 750;
//    zoom = (screen_width/calendar_width)*0.95;
//    if(zoom > 1)zoom = 1;
//    
//    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  98%;  zoom: "+zoom+";-moz-transform: scale("+zoom+");}</style>";
   
    
//    var calendar = document.getElementsByClassName("calendar-table");//[0].style.transform = "scale(0.5)";
//    setTimeout(function(){
//        clog("*** calendar is ",calendar[0]);    
//        calendar[0].style.transform = "scale(0.5)";
//    },1000);
    

//quicktmpl is a simple template language I threw together a while ago; it is not remotely secure to xss and probably has plenty of bugs that I haven't considered, but it basically works
//the design is a function I read in a blog post by John Resig (http://ejohn.org/blog/javascript-micro-templating/) and it is intended to be loosely translateable to a more comprehensive template language like mustache easily
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
        ampm = (hours >= 12) ? ' pm' : ' am';
    if (hours === 0 && minutes===0) { return ''; }
    if (minutes > 0) {
      return hour + ':' + minutes + ampm;
    }
    return hour + ampm;
  }
});


(function ($) {

  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
    var t = $.quicktmpl($('#tmpl').get(0).innerHTML);

    
  function calendar($el, options) {
    //actions aren't currently in the template, but could be added easily...
    $el.on('click', '.js-cal-prev', function () {
        
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() - 1); break;
      case 'month': options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1); break;
      case 'week': options.date.setDate(options.date.getDate() - 7); break;
      case 'day':  options.date.setDate(options.date.getDate() - 1); break;
      }
      draw();
        holidayCheck(true,true);
    }).on('click', '.js-cal-next', function () {
        
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
      case 'month': options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1); break;
      case 'week': options.date.setDate(options.date.getDate() + 7); break;
      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
      }
      draw();
        holidayCheck(true,true);
    }).on('click', '.js-cal-option', function () {
      
      var $t = $(this), o = $t.data();
      
      
      if (o.date) {
          var clicktimestamp = changeDateToTimeStamp(o.date);
          var starttimestamp = changeDateToTimeStamp(param_starttime);
          var endtimestamp = changeDateToTimeStamp(param_endtime);
          var todaytimestamp = (new Date()).getTime();
          if(param_type == CHANGE_TYPE_STARTTIME){
             clog("param_starttime_changecount "+param_starttime_changecount+" param_mbsmaxchangestarttime "+param_mbsmaxchangestarttime);
              if(param_starttime_changecount >= param_mbsmaxchangestarttime ){
                  showModalDialog(document.body,"시작일 변경 불가", "이미 변경 가능한 횟수에 도달하였습니다. 센터에 문의하세요." , "확인", null,function(){
                      hideModalDialog();
                    });
              }else {
                  if(clicktimestamp > starttimestamp && clicktimestamp < starttimestamp+month_timestamp){

//                      clog("시작시간 수정할 수 있다.");
                      var beforedate = new Date(starttimestamp);
                      var clickdate = new Date(clicktimestamp);
                      var str1 = "시작일 변경 신청 이후 취소가 불가능합니다.<br>신청하시겠습니까?";
                      var str2 = "현재 시작일 : "+beforedate.getFullYear()+"."+(beforedate.getMonth()+1)+"."+beforedate.getDate();
                      var str3 = "변경요청 시작일 : "+clickdate.getFullYear()+"."+(clickdate.getMonth()+1)+"."+clickdate.getDate();
                      var message1 = "<h6 align='center'>" + str1 + "</h6>";
                      var message2 = "<h6 align='center'>" + str2 + "</h6>";
                      var message3 = "<h6 align='center'>" + str3 + "</h6>";
                      
                      //enddate 가 시작시간 변경일때는 변경요청일이다.
                      var txt_id_enddate = document.getElementById("txt_id_enddate");
                      var yyyy = clickdate.getFullYear();
                      var m = clickdate.getMonth()+1;
                      var d = clickdate.getDate();
                      var mm = m < 10 ? "0"+m : m;
                      var dd = d < 10 ? "0"+d : d;
                      
                      txt_id_enddate.innerHTML = m+"월 "+d+"일";
                      txt_id_enddate.style.visibility = "visible";
                      edate_click = yyyy+"-"+mm+"-"+dd;
                      showModalDialog(document.body,"선택한 날짜로 변경신청 하시겠습니까?", message1+message2+message3 , "변경신청하기", "취소",function(){
                          changeStartTime(clicktimestamp);
                      },function(){
                          txt_id_enddate.style.visibility = "hidden";
                          uncheckArc("end");
                          hideModalDialog();
                      });
                      
                  }else {
//                      clog("시작시간 수정할 수 없다.");
                      edate_click = "";
                  }
              }
              holidayCheck(true,true);
              
          }else if(param_type == CHANGE_TYPE_HOLDING){
             
              if(clicktimestamp > todaytimestamp && clicktimestamp < endtimestamp){
                  
                  var mdday = get_Day(getToday(new Date(holding_starttime)),getToday(new Date(clicktimestamp)));
                  clog("선택한 일수 "+mdday);
                  if(holding_starttime && param_maxholdingday < mdday+1){
                        alertMsg("홀딩기간은 최대 "+param_maxholdingday+"일을 을 초과할 수 없습니다.");                      
                        return;                                 
                  }
                  
//                  clog("홀딩가능하다.!!");
                  
                  var btn_max_holding = document.getElementById("btn_max_holding");
                 
                  //처음클릭
                  if(!holding_starttime){
                      holding_starttime = clicktimestamp;  
                      btn_max_holding.style.display = "block";
                  }else {
                      if(holding_starttime > clicktimestamp){
                          holding_starttime = clicktimestamp; 
                          btn_max_holding.style.display = "block";
                      }else {
                          holding_endtime = clicktimestamp+86399000;
                          btn_max_holding.style.display = "none";
                      }
                  } 
                  
//                  var txt_desc = document.getElementById("txt_desc");
                  if(holding_starttime && holding_endtime)
                  {
                      
                      var starttime = getToday(new Date(holding_starttime));
                      var endtime = getToday(new Date(holding_endtime));
                      holdingdatapush(holding_starttime,holding_endtime);
                      var dday = get_Day(starttime,endtime);
                      
//                      txt_desc.innerHTML = "(홀딩기간 : "+starttime+" ~ "+endtime+")";
//                      txt_desc.style.color = "blue";
//                      txt_desc.style.fontWeight = "bold";
                      
//                      alertMsg("홀딩기간 : "+starttime+" ~ "+endtime+"<br>총"+(dday+1)+"일을 선택하였습니다.");
                       
                       
                      
                      var txt_id_enddate = document.getElementById("txt_id_enddate");
                      var m = stringGetMonth(endtime);
                      var d = stringGetDay(endtime);
                      txt_id_enddate.innerHTML = m+"월 "+d+"일";
                      txt_id_enddate.style.visibility = "visible";
                      
                      
                      edate_click = endtime.substr(0,10);
                      
                      var txt_message = document.getElementById("txt_message");
                      txt_message.innerHTML = "<b>총 "+(dday+1)+"일</b><span style='color:"+mColor.C919191+"'>을 선택하였습니다.</span>";
                      
                      
                      
                  }else if(holding_starttime && !holding_endtime){
                      
                      var starttime = getToday(new Date(holding_starttime));
                     
//                      txt_desc.innerHTML = "(홀딩기간 : "+starttime+" ~ ";
//                      alertMsg("시작일 : "+starttime+".<br>종료일을 선택해 주세요!");
                      
                      sdate_click = starttime.substr(0,10);
                      
                      var txt_message = document.getElementById("txt_message");
                      var txt_id_startdate = document.getElementById("txt_id_startdate");
                      var m = stringGetMonth(starttime);
                      var d = stringGetDay(starttime);
                      txt_id_startdate.innerHTML = m+"월 "+d+"일";
                      txt_id_startdate.style.visibility = "visible";
                      txt_message.innerHTML = "<b>종료일</b><span style='color:#919191'>을 선택하세요</span>";
                      
                     
                  }
                  
              }
              else {
//                  clog("홀딩 불가능하다.");
              }
                holidayCheck(true,true);  
          }
         
              
          
//          clog("o.mode is "+o.mode);
//          clog("o.date is "+o.date);
//          o.date = new Date(o.date);
//          if(o.mode == undefined)o.mode = "day";
          
      }
        
//      $.extend(options, o);
      draw();
    
    }).on('click', '.js-cal-years', function () {
        
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
      return false;
    }).on('click', '.event', function () {
        
        var $t = $(this), o = $t.data();
        if (o.date) {
          
          o.date = new Date(o.date);
          if(o.mode == undefined)o.mode = "day";
          
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
    $("#btn_max_holding").click(function(event){
         click_max_holding();
         $("#btn_max_holding").hide();
    });
    
   
    function click_max_holding(){
        clog("ccc");
        holding_endtime = holding_starttime+day_timestamp * param_maxholdingday-1000; //1초를 뺀다.
        
        var starttime = getToday(new Date(holding_starttime));
        var endtime = getToday(new Date(holding_endtime));
        
//        var txt_desc = document.getElementById("txt_desc");
//        txt_desc.innerHTML =  "(홀딩기간 : "+starttime+" ~ "+endtime+")";
//        txt_desc.style.color = "blue";
//        txt_desc.style.fontWeight = "bold";
        holdingdatapush(holding_starttime,holding_endtime);
        edate_click = endtime.substr(0,10);
        
        var txt_message = document.getElementById("txt_message");
        var txt_id_enddate = document.getElementById("txt_id_enddate");
        var m = stringGetMonth(endtime);
        var d = stringGetDay(endtime);
        txt_id_enddate.innerHTML = m+"월 "+d+"일";
        txt_id_enddate.style.visibility = "visible";
        
        var dday = get_Day(starttime,endtime);
        var txt_message = document.getElementById("txt_message");
        txt_message.innerHTML = "<b>총 "+(dday+1)+"일</b><span style='color:"+mColor.C919191+"'>을 선택하였습니다.</span>";
        
        checkClickDate();
        draw();
        
       
    }
  
    function changeStartTime(clicktimestamp){

        
         var data = {
            type:param_type,
            centercode:param_centercode, 
            mbsidx: param_mbsidx,
            couponid: param_couponid,
            starttime : param_starttime,
            endtime : param_endtime,
            clicktimestamp : clicktimestamp
        };
        CallHandler("change_membership",data, function(res) {
            var code = parseInt(res.code);

            if (code == 100) {

                if(res.message == ""){
    //               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
                     show_error_popup("ERROR","목록이 없습니다.", "exit");
                    return;
                }
                var json = res.message;
                
               hideModalDialog();
                
                
               showModalDialog(document.body,"시작날짜 변경 완료", "시작날짜를 변경 완료하였습니다." , "확인", null,function(){
                        
                    hideModalDialog();
                    //var params = "?mbsidx="+param_mbsidx+"&type="+param_type+"&starttime="+json.starttime+"&endtime="+json.endtime+"&starttime_changecount="+json.starttime_changecount+"&mbsmaxchangestarttime="+json.mbsmaxchangestarttime;;
                    //refresh_page(params);
                   location.href = "m_my_membership_starttime.php";
                },function(){});
                
              
                
            } else {
    //            alertMsg(res.message);

                show_error_popup("ERROR",res.message, "exit");
                 hideModalDialog();
            }
           

        }, function(err) {
    //        alertMsg("네트워크 에러 ");
             show_error_popup("ERROR","네트워크 에러", "exit");
            hideModalDialog();
        });
    }
    function dayAddEvent(index, event) {
        
        
      if (!!event.allDay) {
        monthAddEvent(index, event);
        return;
      }
        var button = document.createElement('button');   
        if(event.type && event.type=="reservation_button"){

            var yy = event.start.getFullYear();
            var mm = event.start.getMonth();
            var dd = event.start.getDate();
            var hh = event.start.getHours();
            var title = hh+"시 예약하기";
            var btntxt = document.createTextNode(title);
            button.id = "btn_reservation_"+hh;
            button.className = "my-button";
            button.appendChild(btntxt);

            button.onclick = function(){
                
//                clog(yy+"년 "+(mm+1)+"월 "+dd+"일 "+hh+"시 예약버튼 클릭! "+button.id);
            }


        //        $event.css({'background-color':'yellow'});​
        }
        var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index});
        
          
        var start = event.start,
        end = event.end || start,
        time = event.start.toTimeString(),
        hour = start.getHours(),
        timeclass = '.time-22-0',
        startint = start.toDateInt(),
        dateint = options.date.toDateInt(),
        endint = end.toDateInt();
        if (startint > dateint || endint < dateint) { return; }

        if (!!time) {
        $event.html('<strong>' + time + '</strong> ' + $event.html());
        }
        $event.toggleClass('begin', startint === dateint);
        $event.toggleClass('end', endint === dateint);
        if (hour < 6) {
        timeclass = '.time-0-0';
        }
        if (hour < 22) {
        timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
        }
        if(event.type && event.type=="reservation_button")
        $(timeclass).append(button);
        else 
        $(timeclass).append($event);
      
      
    }
    
    function monthAddEvent(index, event) {
         var e = new Date(event.start);
//      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
//          e = new Date(event.start),
//          dateclass = e.toDateCssClass(),
//          day = $('.' + e.toDateCssClass()),
//          empty = $('<div/>', {'class':'clear event', html:' '}), 
//          numbevents = 0, 
//          time = event.start.toTimeString(),
//          endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
//          checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate()+40),
//          existing,
//          i;
            
         var yy = e.getFullYear();
         var mm = (e.getMonth() + 1) < 10 ? "0"+(e.getMonth() + 1) : (e.getMonth() + 1);
         var dd = e.getDate() < 10 ? "0"+e.getDate() : e.getDate();
         var now = yy + "-" + mm + "-" + dd;
         var num_id = document.getElementById("num_"+now);
         if(num_id && event.allDay){
             num_id.style.opacity = 1;
         }
//          if($event[0].title == "홀딩신청기간"){
//              
//              $event[0].className = "aaaa";
//              $event[0].style.backgroundColor = "#f06666";
//              
//          }
//      $event.toggleClass('all-day', !!event.allDay);
//      if (!!time) {
//        $event.html('<strong>' + time + '</strong> ' + $event.html());
//      }
//      if (!event.end) {
//        $event.addClass('begin end');
//        $('.' + event.start.toDateCssClass()).append($event);
//        return;
//      }
         
        //임시주석
//      while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
//        if(day.length) { 
//          existing = day.find('.event').length;
//          numbevents = Math.max(numbevents, existing);
//          for(i = 0; i < numbevents - existing; i++) {
//            day.append(empty.clone());
//          }
//          day.append(
//            $event.
//            toggleClass('begin', dateclass === event.start.toDateCssClass()).
//            toggleClass('end', dateclass === event.end.toDateCssClass())
//          );
//          $event = $event.clone();
//          $event.html(' ');
//        }
//        e.setDate(e.getDate() + 1);
//        dateclass = e.toDateCssClass();
//        day = $('.' + dateclass);
//      }
    }
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
        
      if (options.data && options.data.length) {
        if (options.mode === 'year') {
            yearAddEvents(options.data, options.date.getFullYear());
             
        } else if (options.mode === 'month' || options.mode === 'week') {
            $.each(options.data, monthAddEvent);
             
        } else {
            
            
            //////////////////////////////////////////////////////////////////////////////
            //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. START
            //////////////////////////////////////////////////////////////////////////////
            
            var title = "예약버튼"; //제목이지만 내용을 적으면 된다.
            var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
            y = 2021;
            m = 0;  //
            d = 6;
            hh = 13;
            mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
            start = new Date(y, m, d, hh, mm);
            
            var event = { title: title, start: start, end: null, allDay: allday, type:"reservation_button"};
            dayAddEvent(0,event);
            
            //////////////////////////////////////////////////////////////////////////////
            //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. END
            //////////////////////////////////////////////////////////////////////////////
            
            
            //기존 예약되어있는 날짜 표시
//            $.each(options.data, dayAddEvent);
            for(var i = 0 ; i < options.data.length; i++){
                dayAddEvent(i,options.data[i]);
            }
            
            
            var event = document.getElementsByClassName("event");
            
     
        }
          checkClickDate();
      }
    }
    
    draw();    
  }
  
  ;(function (defaults, $, window, document) {
    $.extend({
      calendar: function (options) {
          options.date = new Date(param_starttime);
        return $.extend(defaults, options);
      }
    }).fn.extend({
      calendar: function (options) {
        options = $.extend({}, defaults, options);
        return $(this).each(function () {
          var $this = $(this);
//            clog("options.date ",options.date = );
            
            //neel 
//            clog("param_type "+param_type);
            if(param_type == CHANGE_TYPE_STARTTIME){
                options.date = new Date(param_starttime);    
            }
            
          calendar($this, options);
        });
      }
    });
  })({
    days: ["일", "월", "화", "수", "목", "금", "토"],
    months: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
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

    
    
    //neel 이곳에 헬스 내용을 입력한다.
    
//    clog("param_starttime "+param_starttime+" endtime "+param_endtime+"  click "+click_starttimestamp);
    
    if(param_type == CHANGE_TYPE_STARTTIME){
        var start_date = new Date(param_starttime);
        var end_date = new Date(param_endtime);
        var gap = start_date.getTime() - end_date.getTime();
        var dday = Math.floor(gap / (1000 * 60 * 60 * 24)) * -1;
        for(i = 0; i < dday; i++) {
            var tdate = start_date.getTime()+day_timestamp*i;
            var date = new Date(tdate);
    //        clog(i+") "+date.getFullYear()+"년 "+(date.getMonth()+1)+"월 "+date.getDate()+"일");
            j = Math.max(i % 15 - 10, 0);
            //c and c1 jump around to provide an illusion of random data
            c = (c * 1063) % 1061; 
            c1 = (c1 * 3329) % 3331;
            d = (d1 + c + c1) % 839 - 440;
            hh = i % 36;
            mm = (i % 4) * 15;
            if (hh < 18) { hh = 0; mm = 0; } else { hh = Math.max(hh - 24, 0) + 8; }

            var title = "변경 불가"; //제목이지만 내용을 적으면 된다.

            var allday = true; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
            if(i > 0 && i <= max_change_day){
                allday = false;
                title = "변경 가능";
            }
            y = date.getFullYear();
            m = date.getMonth();  //
            d = date.getDate();
            hh = 0;
            mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
            start = new Date(y, m, d, hh, mm);
            end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
            end = date;
           data.push({ title: title, start: start, end: end, allDay: allday });
        }
    }else if(param_type == CHANGE_TYPE_HOLDING){
        var today = new Date();
        var start_date = new Date(param_starttime);
        var end_date = new Date(param_endtime);
        var gap = start_date.getTime() - end_date.getTime();
        var dday = Math.floor(gap / (1000 * 60 * 60 * 24)) * -1;
        for(i = 0; i <= dday; i++) {
            var tdate = start_date.getTime()+day_timestamp*i;
            var date = new Date(tdate);
    //        clog(i+") "+date.getFullYear()+"년 "+(date.getMonth()+1)+"월 "+date.getDate()+"일");
            j = Math.max(i % 15 - 10, 0);
            //c and c1 jump around to provide an illusion of random data
            c = (c * 1063) % 1061; 
            c1 = (c1 * 3329) % 3331;
            d = (d1 + c + c1) % 839 - 440;
            hh = i % 36;
            mm = (i % 4) * 15;
            if (hh < 18) { hh = 0; mm = 0; } else { hh = Math.max(hh - 24, 0) + 8; }

            var title = "홀딩가능"; //제목이지만 내용을 적으면 된다.

//            clog(i+" date.getTime()"+date.getTime()+" today gettime "+today.getTime());
            var allday = true; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
            if(date.getTime() < today.getTime()){
                allday = false;
                title = "홀딩 불가능";
            }
            y = date.getFullYear();
            m = date.getMonth();  //
            d = date.getDate();
            hh = 0;
            mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
            start = new Date(y, m, d, hh, mm);
            end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
            end = date;
           data.push({ title: title, start: start, end: end, allDay: allday });
        }
    }
    
   
    
  
    data.sort(function(a,b) { return (+a.start) - (+b.start); });
  
    
    var isinsertholding = false;
     
    function holdingdatapush(starttimestamp,endtimestamp){
//         clog("홀딩데이타 삽입한다.");
//
//        if(isinsertholding)return;
//        isinsertholding = true;
//
//        var today = new Date();
//        var start_date = new Date(starttimestamp);
//        var end_date = new Date(endtimestamp);
//        var tdate = start_date.getTime();
//        var date = new Date(tdate);
//
//        var title = "홀딩신청기간"; //제목이지만 내용을 적으면 된다.
//        var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
//
//        y = date.getFullYear();
//        m = date.getMonth();  //
//        d = date.getDate();
//        hh = 0;
//        mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
//        start = new Date(y, m, d, hh, mm);
//        end = end_date;
//        
//        data.push({ title: title, start: start, end: end, allDay: allday });
//        
         
    }
    
    
    function reset_holding(){
        refresh_page();
    }
    function set_holding(){
        
        if(!holding_starttime || !holding_endtime){
            return;
        }
//        holding_starttime,holding_endtime
         var starttime = new Date(holding_starttime);
         var endtime = new Date(holding_endtime);

         var gap = starttime.getTime() - endtime.getTime();
//         var dday = Math.floor(gap / (1000 * 60 * 60 * 24)) * -1;
         var dday = get_Day(starttime,endtime);
        clog("param_maxholdingday "+param_maxholdingday+ " dday"+dday);
         if(dday > param_maxholdingday){
              showModalDialog(document.body,"홀딩일수 초과", "선택가능한 홀딩일수를 초과하였습니다.<br> 다시 선택하여 주세요<br>※선택가능한 홀딩일수 : "+param_maxholdingday+"일 " , "다시선택하기", null,function(){
              hideModalDialog();
                  reset_holding();
            });
         }else{
             var holdingday = dday;
             var str1 = "홀딩 신청 이후 취소가 불가능합니다.<br>신청하시겠습니까?";
             var str2 = "홀딩기간 : "+starttime.getFullYear()+"."+(starttime.getMonth()+1)+"."+starttime.getDate()+" ~ "+endtime.getFullYear()+"."+(endtime.getMonth()+1)+"."+endtime.getDate();;
             var str3 = "총 "+holdingday+"일";
             

             var message1 = "<h6 align='center'>" + str1 + "</h6>";
             var message2 = "<h6 align='center'>" + str2 + "</h6>";
             var message3 = "<h6 align='center'>" + str3 + "</h6>";


            showModalDialog(document.body,"선택한 날짜로 홀딩신청하시겠습니까?", message1+message2+message3 , "홀딩 신청하기", "취소",function(){
              changeHolding(holding_starttime,holding_endtime);
            },function(){
                hideModalDialog();
            });
         }
        
    }
    
    
    function changeHolding(holdingstarttime , holdingendtime){
         var data = {
            type:param_type,
            centercode:param_centercode, 
            mbsidx: param_mbsidx,
            couponid: param_couponid,
            maxholdingday:param_maxholdingday, 
            starttime : param_starttime,
            endtime : param_endtime,
            holdingstarttime : holdingstarttime,
            holdingendtime :  holdingendtime
           
        };
        CallHandler("change_membership",data, function(res) {
            var code = parseInt(res.code);

            if (code == 100) {

                if(res.message == ""){
    //               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
                     show_error_popup("ERROR","목록이 없습니다.", "exit");
                    return;
                }
                var json = res.message;
                
               hideModalDialog();
                
                
               showModalDialog(document.body,"홀딩신청 완료", "홀딩기간 신청을 완료하였습니다." , "확인", null,function(){
                        
                    hideModalDialog();
//                    var params = "?mbsidx="+param_mbsidx+"&couponid="+param_couponid+"&type="+param_type+"&starttime="+json.starttime+"&endtime="+json.endtime+"&holdingstarttime="+json.holding_starttime+"&holdingendtime="+json.holding_endtime+"&maxholdingday="+param_maxholdingday+"&iscounttype="+iscounttype+"&centercode="+centercode;
//                    refresh_page(params); // 전체 기간을 갱신하기 위해서 페이지를 reload 한다.
//                   location.href = location.href;
                   location.href = "m_my_membership_holding.php";
               },function(){
                    hideModalDialog();
               });
                
                
               
                
            } else {
    //            alertMsg(res.message);
                hideModalDialog();
                show_error_popup("ERROR",res.message, "exit");
            }
            

        }, function(err) {
    //        alertMsg("네트워크 에러 ");
             show_error_popup("ERROR","네트워크 에러", "exit");
            hideModalDialog();
        });
    }
    
    if(param_type == CHANGE_TYPE_HOLDING && param_holdingstarttime.length > 1 && param_holdingendtime.length > 1){
       
        holdingdatapush(changeDateToTimeStamp(param_holdingstarttime),changeDateToTimeStamp(param_holdingendtime));
    }
        
    
//data must be sorted by start date

//Actually do everything
    
$('#holder').calendar({
  data: data
});
    
    //type == start , end 시작시간변경신청일때 취소하면 동그라미를 지운다. 
    function uncheckArc(type){
        if(type == "start"){
            
        }else{
            var id_enum = document.getElementById("num_"+edate_click);
            id_enum.style.color ="#ffffff";
            id_enum.style.fontWeight = "normal";
            var rect_start_id = document.getElementById("rect_end_id");
            id_enum.removeChild(rect_end_id);
        }
    }
   
       //시작시간변경요청일때
    function checkArc(){
         //////////////////////////////////////////
        // 찐한 노랑 동그라미 START
        //////////////////////////////////////////
        var id_snum = document.getElementById("num_"+sdate_click);
        if(id_snum){
            var rect = document.createElement("div");
            rect.id = "rect_start_id";
            rect.style.width = "33px";
            rect.style.height = "33px";
            rect.style.backgroundColor = mColor.YELLOW;
            rect.style.marginTop = "-26px";
            rect.style.borderRadius = "16px";
            rect.style.zIndex = -1;
            id_snum.appendChild(rect);
            
            id_snum.style.color = "black";
            id_snum.style.fontWeight = "bold";    
        }
        
        //////////////////////////////////////////
        // 찐한 노랑 동그라미 END
        //////////////////////////////////////////
        var id_enum = document.getElementById("num_"+edate_click);
        if(sdate_click != edate_click && id_enum){
            var rect = document.createElement("div");
            rect.id = "rect_end_id";
            rect.style.width = "33px";
            rect.style.height = "33px";
            rect.style.backgroundColor = mColor.YELLOW;
            rect.style.marginTop = "-26px";
            rect.style.borderRadius = "16px";
            rect.style.zIndex = -1;
            id_enum.appendChild(rect);
            id_enum.style.color = "black";
            id_enum.style.fontWeight = "bold";    
        }
             
    }
      
      
    var sdate_click = "";
    var edate_click = "";
    function checkClickDate(){
        checkArc();
        
        if(param_type == CHANGE_TYPE_HOLDING){
            //////////////////////////////////////////
            // 배경 투명 노랑 라인
            //////////////////////////////////////////
            if(sdate_click && edate_click && sdate_click != edate_click){

                var dates = getDatesStartToLast(sdate_click,edate_click);
                clog("dates",dates);
                for(var i = 0 ; i < dates.length; i++){
                    var id_num = document.getElementById("num_"+dates[i]);
                    var rect = document.createElement("div");
                    rect.style.height = "33px";
                    rect.style.backgroundColor = mColor.YELLOW;
                    rect.style.opacity = "0.1";

                    rect.style.zIndex = -1;
                    if(i == 0 ){
                        rect.style.width = "29px";
                        rect.style.float = "right";
                        rect.style.marginTop = "-33px";
                        rect.style.marginRight = "-2px";
                        if(id_num)id_num.appendChild(rect);

                    }else if(i == dates.length-1){
                        rect.style.width = "24px";
                        rect.style.float = "left";
                        rect.style.marginTop = "-33px";
                        if(id_num)id_num.appendChild(rect);
                    }else {
                        rect.style.marginTop = "-26px";
                        rect.style.width = "48px";
                        if(id_num)id_num.appendChild(rect);
                    }
                    //토요일이나 일요일이면 오른쪽 or 왼쪽을 둥글게 처리한다.
                    if(getDateOfWeek(dates[i]) == "토"){
                        rect.style.borderRadius = "0px 16px 16px 0px";
                    }else if(getDateOfWeek(dates[i]) == "일"){
                        rect.style.borderRadius = "16px 0px 0px 16px";
                    }



                }
            }
            check_buttons();
        }
        
    }
    function check_buttons(){
        var btn_set_holding = document.getElementById("btn_set_holding");
        var id_reset = document.getElementById("id_reset");
        var btn_max_holding = document.getElementById("btn_max_holding");
        if(!sdate_click && !edate_click){
            id_reset.style.display = "none";  
            btn_max_holding.style.display = "none";  
            
        }else if(sdate_click && !edate_click){
            id_reset.style.display = "none";  
            btn_max_holding.style.display = "block";  
        }else if(sdate_click && edate_click){
            id_reset.style.display = "block";  
            btn_max_holding.style.display = "none";  
            btn_set_holding.style.backgroundColor = mColor.YELLOW;
        }
          
    }
    
    
    
//    
// window.addEventListener("touchstart",onStart);
// window.addEventListener("touchmove",onMove);
// window.addEventListener("touchend",onEnd);
//    
//    var bStartEvent = false; //touchstart 이벤트 발생 여부 플래그  
//var nMoveType = -1; //현재 판단된 사용자 움직임의 방향  
//var htTouchInfo = { //touchstart 시점의 좌표와 시간을 저장하기  
//    nStartX : -1,
//    nStartY : -1,
//    nStartTime : 0
//};
////수평 방향을 판단하는 기준 기울기
//var nHSlope = ((window.innerHeight / 2) / window.innerWidth).toFixed(2) * 1;
//
//function initTouchInfo() { //터치 정보들의 값을 초기화하는 함수  
//    htTouchInfo.nStartX = -1;
//    htTouchInfo.nStartY = -1;
//    htTouchInfo.nStartTime = 0;
//}
//
////touchstart 좌표값과 비교하여 현재 사용자의 움직임을 판단하는 함수
//function getMoveType(x, y) {  
//    //0은 수평방향, 1은 수직방향
//    var nMoveType = -1;
//
//    var nX = Math.abs(htTouchInfo.nStartX - x);
//    var nY = Math.abs(htTouchInfo.nStartY - y);
//    var nDis = nX + nY;
//    //현재 움직인 거리가 기준 거리보다 작을 땐 방향을 판단하지 않는다.
//    if(nDis < 25) { return nMoveType }
//
//    var nSlope = parseFloat((nY / nX).toFixed(2), 10);
//
//    if(nSlope > nHSlope) {
//        nMoveType = 1;
//    } else {
//        nMoveType = 0;
//    }
//
//    return nMoveType;
//}
//
//function onStart(e) {  
//     clog("onStart");
//    initTouchInfo(); //터치 정보를 초기화한다.
//    nMoveType = -1; //이전 터치에 대해 분석한 움직임의 방향도 초기화한다.
//    //touchstart 이벤트 시점에 정보를 갱신한다.
//    htTouchInfo.nStartX = e.$value().changedTouches[0].pageX;
//    htTouchInfo.nStartY = e.$value().changedTouches[0].pageY;
//    htTouchInfo.nStartTime = e.$value().timeStamp;
//    bStartEvent = true;
//}
//
//function onMove(e) {  
//    clog("onMove");
//    if(!bStartEvent) {
//        return
//    }
//    var nX = e.$value().changedTouches[0].pageX;
//    var nY = e.$value().changedTouches[0].pageY;
//
//    //현재 touchmMove에서 사용자 터치에 대한 움직임을 판단한다.
//    nMoveType = getMoveType(nX, nY);
//    
//    //현재 사용자 움직임을 수직으로 판단해 기본 브라우저의 스크롤 기능을 막고 싶으면 아래 코드를 사용한다.
//    if(nMoveType === 1) {
//        e.stop(jindo.$Event.CANCLE_DEFAULT);
//    }
//    
//
//}
//
//function onEnd(e) {  
//    clog("onend");
//    if(!bStartEvent) {
//        return
//    }
//
//    //touchmove에서 움직임을 판단하지 못했다면 touchend 이벤트에서 다시 판단한다.
//    if(nMoveType < 0) {
//        var nX = e.$value().changedTouches[0].pageX;
//        var nY = e.$value().changedTouches[0].pageY;
//        nMoveType = getMoveType(nX, nY);
//    }
//    clog("nMoveType ",nMoveType);
//    bStartEvent = false;
//    nMoveType = -1; //분석한 움직임의 방향도 초기화한다.
//    initTouchInfo(); //터치 정보를 초기화한다.
//}
//    clog("DDDDD");
</script>