<?php
include('./common'); 

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
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    
-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="./css/modaldialog.css" rel="stylesheet">
    
<!--    당겨서 새로고침-->
   <!-- <script src="./libs/pulltorefresh/pulltorefresh.js"></script> Page Pull to Refresh 스크립트 -->
    <!--<script src="./libs/pulltorefresh/touch-emulator.js"></script> Page Pull to Refresh 스크립트 -->
    <!--<link rel="stylesheet" href="./libs/pulltorefresh/pulltorefreshstyle.css">-->
    
    <script src="js/scripts.js?ver3.00a"></script>

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

    </style>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->





</head>

<body>

    <div style="background-color:#e1ece9;margin-top:0px;margin-left:0px;margin-right:0px;margin-top:-50px;width:100%;height:50px;position:fixed;z-index:999">
<!--          <span><img src='./img/btn_reset.png' width='50px' height='50px' onclick='reload_calendar_page()' /></span><span id='span_top_right'><div style='margin-top:8px;float:right'><input type="text"  onfocus='this.select()'   onchange='onselect_myuser()' list="select_users_list" id="select_users" placeholder='특정회원검색..' /><datalist  id='select_users_list' style='float:right;width:140px;height:40px;margin-top:5px;margin-right:15px' ></datalist></div></span>-->
        
        <span><img src='./img/btn_reset.png' width='50px' height='50px' onclick='reload_calendar_page()' /></span><div style='float:right'><span id='span_top_right'></span></div>
    </div>
    <div id="main">
<!--        <label class='textevent' style="color:red;">*화면을 아래로 당겨서 새로고침</label>         -->
        
<!--        <text id='test_desc'></text>-->
        <div id="container" class="container" style="margin-top:50px;background-color:#eeeeee">
            <div id="center" class="center">
            </div>
        </div>

        <div id="reservation_container" class="container" style="margin-top:50px;display:none;background-color:#ffffff">
            
            <div id="reservation_center" class="reservation_center">
                <!--        <h3 style="text-align:center" id="reservation_title"></h3><br>-->
                <br> 
                
                <!--색깔별로 예약현황 알려줌-->
                <div style='float:left;vertical-align:center'>
                    
                    <img src="./img/ques_20.png" title="예약현황을 색깔로 표현해 줍니다." style="margin-top:-6px;">&nbsp;
                    <svg style='width:14px;height:14px'><rect width='12' height='12' rx='3' ry='3' style='fill:#f5f500'></rect></svg>&nbsp;<text style='font-size:12px;color:#b1b100'>일정오픔</text>&nbsp;&nbsp;
                    <svg style='width:14px;height:14px'><rect width='12' height='12' rx='3' ry='3' style='fill:#38957c'></rect></svg>&nbsp;<text style='font-size:12px;color:#38957c'>운동예약신청함</text>&nbsp;&nbsp;
                    <svg style='width:14px;height:14px'><rect width='12' height='12' rx='3' ry='3' style='fill:#cfa0b8'></rect></svg>&nbsp;<text style='font-size:12px;color:cfa0b8'>고객승인됨</text>&nbsp;&nbsp;
                    <svg style='width:14px;height:14px;margin-top:-10x;'><rect width='12' height='12' rx='3' ry='3' style='fill:#ffaa2a'></rect></svg>&nbsp;<text style='font-size:12px;color:#ffaa2a'>운동종료됨</text>&nbsp;&nbsp;                    
                </div>
               <br>

                <div class="calendar_container theme-showcase">

                    <div id="holder" class="row"></div>
                </div>
            </div>


        </div>
      
    </div>
   
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:100%;background-color:#88888899;position:fixed;z-index:1000;display:none'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%'/></div>
    <!--    당겨서 새로고침-->
<!--    <script>TouchEmulator()</script>-->

    <script>
        
        
        var selected_my_reservation = null;
        var isfirst = true;
        var param_groupcode = getParam("groupcode");
        var param_centercode = getParam("centercode");
        
       
        var param_day = getParam("day");
        var param_teachername = decodeURIComponent(getParam("teachername"));
        var param_teacheruid = getParam("teacheruid");
        var param_teacherid = getParam("teacherid");
        var param_useruid = getParam("useruid");
        var orneruid = '<?php echo $uid ;?>';
        var mem_teacher_alldata = [];
        var calendar_data = null;
//        var reservationinfo = null;
        var reservationinfo = null;
        var container = document.getElementById("container");
        
        var label_title = document.getElementById("label_title");
//        label_title.innerHTML = decodeURIComponent(param_teachername)+" 예약표";
        var userinfos = null;
        var newuserinfos = null;

        
       if(auth < AUTH_TRANER){
           alertMsg("접근 권한이 없습니다.");
           gotohome();
       }else {
           clog("param_groupcode "+param_groupcode+" param_centercode "+param_centercode);
           

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
    <table class="calendar-table table table-condensed table-tight">
        <thead>
            <tr>
                <td colspan="7" style="text-align: center">
                    <table style="white-space: nowrap; width: 100%">
                        <tr style="background-color:#fff7d1">
                            <td style="text-align: left;">
                                <span class="btn-group">
                                    <button class="js-cal-prev btn btn-default" style="background-color:#f7e688"> <img src="./img/arrow_l.png" /></button>&nbsp;&nbsp;
                                    <button class="js-cal-next btn btn-default" style="background-color:#f7e688"><img src="./img/arrow_r.png" /></button>

                                </span>
                                <button style="background-color:#f7e688;height:62px" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }}" data-date="{{: today.toISOString()}}" data-mode="month">{{: todayname }}</button>
                            </td>
                            <td>

                                <span class="btn-group btn-group-lg">

                                    {{





                    if (mode !== 'day') { 
                }}
                                    <button class="js-cal-years btn btn-link">{{: year}}년</button>
                                    {{
                        if (mode === 'month') { 
                         var m_month = months[month];
                         
                           
                }}
                                    <button class="js-cal-option btn btn-link" data-mode="year">{{: m_month }}</button>
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
                            <td style="text-align: right">
                                <span class="btn-group">
                                    <button style="background-color:#f7e688;height:62px" class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">년</button>
                                    <button style="background-color:#f7e688;height:62px" class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">월</button>
                                    <button style="background-color:#f7e688;height:62px" class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">주</button>
                                    <button style="background-color:#f7e688;height:62px" class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day">일</button>
                                </span>
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
            <tr class="c-weeks" style="background-color:#ddddee">
                {{ for (i = 0; i < 7; i++) { }}
                <th class="c-name">
                    {{: days[i] }}
                </th>
                {{ } }}
            </tr>
        </thead>
        <tbody>
            {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
            <tr>
                {{ for (i = 0; i < 7; i++) { }}
                {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } }}
                <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}">
                    <div class="date">{{: thedate.getDate() }}</div>
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
                    <table class="table table-striped table-condensed table-tight-vert">
                        <thead>
                            <tr>
                                <th> </th>
                                <th style="text-align: center; width: 100%">{{: days[date.getDay()] }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="timetitle">All Day</th>
                                <td class="{{: date.toDateCssClass() }}"> </td>
                            </tr>
                            <tr>
                                <th class="timetitle">수동삽입 P.T</th>
                                <td class="time-0-0"> </td>
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
                                
                            }}
                            <tr>
                                <th class="timetitle">{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}
                                {{ if(dday >= 0) { }}
                                &nbsp;<button button class="btn disabled" style="color:white;width:100%;background-color:#faaa00" id="{{: id }}" >공강</button>
                                
                                </th>
                                <td class="time-{{: i}}-0">
                                    
                                </td>
                                {{ } else { }}
                                </th>
                                <td class="time-{{: i}}-0">
                                    
                                </td>
                                {{ } }}  
                                
                            </tr>
                            
                            {{ } }}
                            <tr>
                                <th class="timetitle">After 12 PM</th>
                                <td class="time-24-0"> </td>
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
    var zoom = 100;
    var screen_width = $(window).width();
    var calendar_width = 700;
    zoom = (screen_width / calendar_width) * 0.95;
    
    var width_percent = 92;
    if (zoom > 1) zoom = 1;
    
    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  "+width_percent+"%;  zoom: " + zoom + ";-moz-transform: scale(" + zoom + ");}</style>";
    
    
//    document.getElementById("div_month_total_table").style.zoom = zoom+"";
    //    var calendar = document.getElementsByClassName("calendar-table");//[0].style.transform = "scale(0.5)";
    //    setTimeout(function(){
    //        
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


        function calendar($el, options) {
            //actions aren't currently in the template, but could be added easily...
//            
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
                clog("option click 222");
                var $t = $(this),
                    o = $t.data();
                
                if (o.date) {
                    
                    o.date = new Date(o.date);
                    
                    if (o.mode == undefined) o.mode = "day";
                    
                    
                }
                param_day = o.mode && o.mode == "day" ? o.date.getTime() : "";
                
                $.extend(options, o);
                draw();
                holidayCheck();

            }).on('click', '.js-cal-years', function() {
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
                clog(" click 3333");
                var $t = $(this),
                    o = $t.data();
                if (o.date) {
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

             
            
            function dayAddEvent(index, event) {
                

                if (!!event.allDay) {
                    monthAddEvent(index, event);
                    return;
                }
               
                var button = document.createElement('button');
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                
                
                
                var sdate = getDateToStrDisplay(yy,mm,dd,hh);//event.start.getFullYear()+"-"+(event.start.getMonth()+1)+"-"+event.start.getDate()+" 00:00:00";
                //오픈 버튼을 숨긴다.
                var btn_open_id = "open_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate()+"time"+hh;
                
                var btn = document.getElementById(btn_open_id);
                if(btn)btn.style.visibility = "hidden";
                

                var mhh = hh < 10 ? "0"+hh : hh;
                var addid = "add_"+getDateToStr(yy,mm,dd,mhh);
                var addbtn = document.getElementById(addid);
                if(addbtn)addbtn.style.display = "none";

                var clickid = ""+getDateToStr(yy,mm,dd,hh);
                var title = event.title;
                var text = event.title;
                var isdisplayuser = !param_useruid || param_useruid && param_useruid == event.user.uid ? true : false;

                var deleteicon = "";
                //기본 텍스트
                var div = document.getElementById(clickid);
                var txt = document.getElementById("txt_"+clickid);
                if(!div){
                    div = document.createElement("div");
                    div.id = clickid;    
                    div.innerHTML = "<text class='textevent' id='txt_"+clickid+"' style='float:left;font-size:15px;padding:10px'>"+text+"</span>";
                }
                else {
                    txt.innerHTML += ", "+text;
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
                if (startint > dateint || endint < dateint) {  //타이틀부분이라면
                    return;
                }
                //6시 이전 시간오픈 을 수동삽입목록
                if(hour < 6 && !event.user.uid){
                    div.innerHTML = "";
                    div.style.display = "none";
                }

                $event.toggleClass('begin', startint === dateint);
                $event.toggleClass('end', endint === dateint);
                if (hour < 6) {
                    timeclass = '.time-0-0';
                }
                else if (hour < 24) {
                    timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
                }
                
               $(timeclass).append(div);
              
                    


            }
            function removeFreePTText(txt){
                return txt.replace(TXT_FREEPT,"");
            }
            function isFreePTText(txt){
                if(txt.indexOf(TXT_FREEPT) >= 0)
                    return TXT_FREEPT;
                return "";
            }
           
            
            var now_month = {yy:"",mm:"",month_now_user:0,month_all_reservation_count:0,month_now_reservation_count:0,month_now_reservation_finish_count:0,month_total_confirm_count:0,users:[]};
            var nowmonthusersdata = [];
            function monthAddEvent(index, event) {
//                
                
                e = new Date(event.start),
                dateclass = e.toDateCssClass();
                var bdata = event.bdatas;
                var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
              
                 var datehh = event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate()+"_"+event.time;

               var free_tag = "";
               var name_tag = "";
                                //일정오픈, 운동예약신청함, 고객승인함, 운동종료됨
//                var color_arr = ["#f5f500","#38957c","#cfa0b8","#ffaa2a"];
                if(event.user.uid){

                   
//                  if(event.user.note.indexOf(TXT_FREEPT) >= 0){
//                        free_tag = "<img src = './img/icon_freept_mini.png' style='margin-top:-3px;margin-left:-10px;position:absolute;width:20px;height:20px' title='무료PT일때 이 아이콘이 표시됩니다.'/>";                    
//                    }
                    
                    
                }else{
                    //시간오픈 삭제
                    return;
                }
                
                var bgimage = null
               
                if(event.user.status == 0 ) //고객승인함
                    bgimage = setDivType("tranerfinish");
                else if(event.user.status == 2 ) //운동종료됨
                    bgimage =  setDivType("userfinish");
                
                
                
                 var $event = $('<div/>', {
                        'class': 'event',
                        'id' : 'dayid_'+datehh,
                        text: event.title,
                        title: event.title,
                        'data-index': index
                    });   
                
                
            
                var e = new Date(event.start);
                var dateclass = e.toDateCssClass();
                var day = $('.' + e.toDateCssClass());
                var div = document.getElementById("dayid_"+datehh);
                var txt = document.getElementById("daytxt_"+datehh);
                if(!div){
                    var time = event.start.toTimeString();
                    div = document.createElement("div");
                    div.id = "dayid_"+datehh;
                    div.style.backgroundImage = "linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%)";
                    div.style.margin="10px";
                    var timetag = getTimeIconTag(time,1);
                    
                    div.innerHTML=timetag;
                    div.innerHTML+="<text id='daytxt_"+datehh+"' style='font-size:12px;color:blue'>"+event.title+"</text>";
                    day.append(div);
                    
                }
                if(txt)txt.innerHTML += ","+event.title;               
                
                
                
                
                
                
                
                
                
                
                
                
                
//                var empty = $('<div/>', {
//                        'class': 'clear event',
//                        html: ' '
//                    });
//                var numbevents = 0;
//                var time = event.start.toTimeString();
//                var endday = event.end && $('.' + event.end.toDateCssClass()).length > 0;
//                var checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate() + 40);
//                var existing;
//                var i;
////                title += "<span style='float:right'><img src='./img/icon_delete72.png' width='35px' height='35px'  ></span>";
//                $event.toggleClass('all-day', !!event.allDay);
//                if (!!time) {
//
//                    var timetag = getTimeIconTag(time);
//
//                    $event.html(free_tag+timetag + $event.html());
//                }
//                if (!event.end) {
//                    $event.addClass('begin end');
//                    $('.' + event.start.toDateCssClass()).append($event);
//                    return;
//                }
//
//                while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
//                    if (day.length) {
//                        existing = day.find('.event').length;
//                        numbevents = Math.max(numbevents, existing);
//                        for (i = 0; i < numbevents - existing; i++) {
//                            day.append(empty.clone());
//                        }
//                        
//                        //////////////////////////////////////////////////////////
//                        //neel change start
//                        //////////////////////////////////////////////////////////
////                        
////                        //이부분이 날짜칸에 데이타 태그를 삽입하는부분이다.
////                        if(event.backgroundimage)$event.css("background-image",event.backgroundimage);
////                        if(event.fontcolor)$event.css("color",event.fontcolor);
////                        
////                        //수동입력이라면
////                        if(hour < 6)
////                            $event.css("background-color","linear-gradient(to bottom, #ffffff 0px, #555555 100%)");
//                        
//                        
//                       
//                        //////////////////////////////////////////////////////////
//                        //neel change end
//                        //////////////////////////////////////////////////////////
//                        
//                        if(bgimage)$event.css("background-image",bgimage.titlebackimg);
//                         if(bgimage)$event.css("color",bgimage.fontcolor);
//                        day.append(
//                            $event.toggleClass('begin', dateclass === event.start.toDateCssClass()).toggleClass('end', dateclass === event.end.toDateCssClass())
//                        );
//                        $event = $event.clone();
//                        $event.html(' ');
//                    }
//                    e.setDate(e.getDate() + 1);
//                    dateclass = e.toDateCssClass();
//                    day = $('.' + dateclass);
//                }
                
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
                        $('.month-' + i).append('<span class="badge">' + v + '</span>');
                    }
                });
            }
            
            function draw() {
//                
                $el.html(t(options));
                //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
                $('.' + (new Date()).toDateCssClass()).addClass('today');
                if (options.data && options.data.length) {
//                    document.getElementById("div_month_total_table").style.visibility = options.mode == "month" ? "visible" : "hidden";
//                     checkTotalMonthData(options.date);
                    
                    if (options.mode === 'year') {
                        yearAddEvents(options.data, options.date.getFullYear());
                    } else if (options.mode === 'month' || options.mode === 'week') {
                        $.each(options.data, monthAddEvent);
                    } else {
                        //맨위로가기
                        window.scrollTo(0,0);
                        
                         var o = options;
                        if(reservationinfo && reservationinfo.classes[0]){
                             var dday = get_Day(o.date,reservationinfo.classes[0].next_endtime);
                             if(o.mode == "day" && dday < 0){// 날짜범위보다 미래 날짜이다면
                                var mday = "open_"+o.date.getFullYear()+"_"+(o.date.getMonth()+1)+"_"+o.date.getDate();
                                for(var i = 6 ; i <= 24; i++){

                                    var open_btn_id = mday+"time"+i;
    //                                
                                    var open_btn = document.getElementById(open_btn_id);
    //                                
                                    if(open_btn)open_btn.style.display = "none";
                                }
        //                        open_2021_3_19time9
                            }
                        }
                      
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
//            
//            window.defaults = defaults;
            $.extend({
                
                calendar: function(options) {
//                    
                    return $.extend(defaults, options);
                }
            }).fn.extend({
                
                calendar: function(options) {
                    options = $.extend({}, defaults, options);
                    window.options = options;
                    return $(this).each(function() {
                        var $this = $(this);
                        window._mthis = $this;
//                        
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
    
    function insertAllReservation(teacher_list){

        var teachers = [];
        for(var k = 0 ; k < teacher_list.length; k++){
            var teachername = teacher_list[k].mem_username;
            var teacheruid = teacher_list[k].mem_uid;
            var teacherreservation = JSON.parse(teacher_list[k].mem_teacher_reservation);
            for(var j = 0 ; j < teacherreservation.length; j++){
                if(teacherreservation[j].centercode && teacherreservation[j].centercode == param_centercode){
                    var datas = [];
                      
                    for(var i = 0 ; i < teacherreservation[j].close[0].dates.length;i++)
                       datas.push(teacherreservation[j].close[0].dates[i]);
                    for(var i = 0 ; i < teacherreservation[j].open[0].dates.length;i++)
                       datas.push(teacherreservation[j].open[0].dates[i]);
                    for(var i = 0 ; i < teacherreservation[j].ready[0].dates.length;i++)
                       datas.push(teacherreservation[j].ready[0].dates[i]);

                    
                    teachers.push({"teachername":teachername,"teacheruid":teacheruid,"datas": datas});
                }                
            }
        }
        insertCalenderDatas(teachers);   
        
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
    var testcnt = 1;
    function insertCalenderDatas(teachers){
        
        var alldata = [];
        
        for(a = 0; a < teachers.length; a++) {    
            var teachername = teachers[a].teachername;
            var teacheruid = teachers[a].teacheruid;
            var datas = teachers[a].datas; //date array
            for(i = 0; i < datas.length; i++) {
                if(datas[i].times)
                for(var j =0 ; j < datas[i].times.length; j++){
                    var tdate = datas[i].date;
                    var date = new Date(tdate);

                    if(datas[i].times[j].members.length > 0){
                        var time = datas[i].times[j].time;
                        for(var k = 0; k < datas[i].times[j].members.length;k++){
                            var member = datas[i].times[j].members[k];   

                            
                            var y = date.getFullYear();
                            var m = date.getMonth();  //
                            var d = date.getDate();
                            var hh = parseInt(datas[i].times[j].time);
                            var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                            var start = new Date(y, m, d, hh, mm);
                            
                            
                            alldata.push({ title: teachername, teacheruid: teacheruid, date :date, time: time , user :member, start : start, end : start});
                        }
                    }
                    


                }

            }
        }
//        
//        var mid = param_teacheruid;
//        newuserinfos = trim_teacher_userinfos(mem_teacher_alldata,userinfos, mid);
//        
//        newuserinfos.sort(sort_by('name', false, (a) => a.toUpperCase()));//이름순 정렬
//        clog("newuserinfos : ",newuserinfos);
//        setMonthUsers(newuserinfos);
//        
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
    function setMonthUsers(month_users){
        month_users = trim_sort_2array(month_users,"uid");
        month_users.sort(sort_by('name', false, (a) => a.toUpperCase()));
        var selected_uid = "";
        var objs = [];
        var isselected = -1;
        var selected_uid = "";
        clog("setMonthUsers!!");
        for(var i = 0 ; i < month_users.length; i++){
            var user = month_users[i];
            if(param_useruid && param_useruid == user.uid){
                isselected = i; 
                selected_uid = user.uid;
            }
            var rectimgname = "";
            var isfree = checkFreePT(user.mbsprice,user.mbsname);//무료쿠폰인지 체크
            var eday =  get_Day(getToday(),user.endtime);
            if(isfree){
                rectimgname = "./img/rect_freept.png";
            }else {
                if(eday < 0)rectimgname = "./img/rect_ptoff.png";
                else rectimgname = "./img/rect_pton.png";
            }
            objs.push({"value":user.uid,"text":user.name+"("+user.userid+")","imgname":rectimgname});
        }
        C_ComboBox("span_top_right",random_string(),"== 전체회원 ==",objs,240,1,"onselect_myusernew",isselected);
        displayUserCouponTable(selected_uid);
        
//        var select_users_list = document.getElementById("select_users_list");
////        clog("000 month_users ",month_users);
//        month_users = trim_sort_2array(month_users,"uid");
//        month_users.sort(sort_by('name', false, (a) => a.toUpperCase()));
////        clog("111 month_users ",month_users);
//        select_users_list.innerHTML = "<option data-value='0' value='전체회원'/>";
//        var selected_uid = "";
//        for(var i = 0 ; i < month_users.length; i++){
//            var user = month_users[i];
//
//            var isselected = param_useruid && param_useruid == user.uid ? "selected" : "";
//            if(isselected){
//                selected_uid = user.uid;                
//            }
//            if( param_useruid && param_useruid == user.uid)label_title.innerHTML = user.name+" 예약표";
//            select_users_list.innerHTML+="<option data-value='"+user.uid+"' value='"+user.name+"("+user.userid+")'  "+isselected+"/>";
//        }
//        displayUserCouponTable(selected_uid);
    }
    
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
        refresh_page("?groupcode="+param_groupcode+"&centercode="+param_centercode); 
        
//        var params = "?centercode="+param_centercode+"&day="+param_day+"&useruid="+select_useruid;         
//        location.href = window.location.href.split("?")[0] + params;
    }
</script>

   
