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
<meta name="viewport" content="user-scalable=yes, initial-scale=1.0, maximum-scale=2.0, minimum-scale=1.0, width=device-width" />
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
    <link href="./css/modaldialog.css" rel="stylesheet">
    <script src="js/scripts.js"></script>

<!--
<link rel="stylesheet" href="./css/layout.css"/>
<link rel="stylesheet" href="./css/sub.css"/>
-->
    
<link rel="stylesheet" href="./css/calendar.css"/>
<style>
    body			{ background:#fff}
.container		{ min-width:100%; background:#fff }
.body			{ width:100%;background:#fff }
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
  padding-top: 5%;
  color: b;
  text-align:center;
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


</style>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
 
    
    
    
    
    </head>

<body>

<div id= "container" class="container">	
     <div id= "center" class="center">
         
    </div>
</div>
<div id = "reservation_container" class="container" style="display:none">
    <div id= "reservation_center" class="reservation_center">
<!--        <h3 style="text-align:center" id="reservation_title"></h3><br>-->
        <button class ="my-button" type="button"><h3 id ="max_count">PT 30회</h3><h5 id ="use_count">30회중 12회 진행</h5><h5 id ="period">2020-01-01~2020-04-30</h5></button>
        <br><br>
        <h5 id ="manager"></h5>
        <div class="calendar_container theme-showcase">
            <br>
            <div id="holder" class="row" ></div>
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
    
<script>
    var container = document.getElementById("container");
    var reservation_container = document.getElementById("reservation_container");
    var reservation_title = document.getElementById("reservation_title");        
    CallHandler("my_reservation", null, function(res) {
        var code = parseInt(res.code);
       
        if (code == 100) {
            
            if(res.message == ""){
//               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });
                 show_error_popup("ERROR","목록이 없습니다.", "exit");
                return;
            }
            var json_array = JSON.parse(res.message);
//            document.write(res.message);
            var center = document.getElementById("center");
            var br0 = document.createElement('br');  
            center.appendChild(br0);
            
            if(json_array.length == 1){
                container.style.display = "none";
                reservation_container.style.display = "block";
                initReservation(json_array[0]);
            }else if(json_array.length > 1){
                for(var i = 0 ; i < json_array.length; i++){
                    const json = json_array[i];
                    var button = document.createElement('button');   
                    var title = json.mbstype+" 예약";
                    var btntxt = document.createTextNode(title);
                    button.id = json.mbstype;
                    button.className = "my-button";
                    button.appendChild(btntxt);
                    
                    button.onclick = function(){
                        
                        container.style.display = "none";
                        reservation_container.style.display = "block";
                        initReservation(json);
                    }
                    center.appendChild(button);

                    var br1 = document.createElement('br');    
                    var br2 = document.createElement('br');  
                    var br3 = document.createElement('br');  
                    center.appendChild(br1);
                    center.appendChild(br2);
                    center.appendChild(br3);
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
    
    function set_title(title){
        document.title = title; 
//        reservation_title.innerHTML = title;
    }
    function initReservation(json){
        var title = json.mbstype+" 예약현황";
        set_title(title);
        var txt_max = document.getElementById("max_count");
        var txt_use = document.getElementById("use_count");
        var txt_period = document.getElementById("period");
        var txt_manager = document.getElementById("manager");
        txt_max.innerHTML = json.mbstype+" "+json.mbsmaxcount+"회";
        txt_use.innerHTML = json.mbsmaxcount+"회중 "+json.usecount+"회 진행";
        txt_period.innerHTML = json.starttime+"~"+json.endtime;
        txt_manager.innerHTML = "담당:"+json.manager;
        
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
      clog("year is "+year);
      clog("month is "+month);
      clog("first is "+first);
      clog("last is "+last);
      clog("startingDay is "+startingDay);
      clog("dayclass is "+dayclass);
      
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
                  <button class="js-cal-prev btn btn-default" style="background-color:#f7e688"> <img src = "./img/arrow_l.png"/></button>&nbsp;&nbsp;
                  <button class="js-cal-next btn btn-default" style="background-color:#f7e688"><img src = "./img/arrow_r.png"/></button>
                
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
                         clog("m_month is "+m_month);
                           
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
                        clog("arr is ",days);
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
    function holidayCheck(){
        var allblock = document.getElementsByClassName("calendar-day");
        var yholiday = ["_1_1 ","_3_1 ","_5_5 ","_6_6 ","_8_15 ","_10_3 ","_10_9 ","_12_25 "];
        var uholiday = ['2000_2_4 ', '2000_2_5 ', '2000_2_6 ', '2000_5_11 ', '2000_9_11 ', '2000_9_12 ', '2000_9_13 ', '2001_1_23 ', '2001_1_24 ', '2001_1_25 ', '2001_5_1 ', '2001_9_30 ', '2001_10_1 ', '2001_10_2 ', '2002_2_11 ', '2002_2_12 ', '2002_2_13 ', '2002_5_19 ', '2002_9_20 ', '2002_9_21 ', '2002_9_22 ', '2003_1_31 ', '2003_2_1 ', '2003_2_2 ', '2003_5_8 ', '2003_9_10 ', '2003_9_11 ', '2003_9_12 ', '2004_1_21 ', '2004_1_22 ', '2004_1_23 ', '2004_5_26 ', '2004_9_27 ', '2004_9_28 ', '2004_9_29 ', '2005_2_8 ', '2005_2_9 ', '2005_2_10 ', '2005_5_15 ', '2005_9_17 ', '2005_9_18 ', '2005_9_19 ', '2006_1_28 ', '2006_1_29 ', '2006_1_30 ', '2006_5_5 ', '2006_10_5 ', '2006_10_6 ', '2006_10_7 ', '2007_2_17 ', '2007_2_18 ', '2007_2_19 ', '2007_5_24 ', '2007_9_24 ', '2007_9_25 ', '2007_9_26 ', '2008_2_6 ', '2008_2_7 ', '2008_2_8 ', '2008_5_12 ', '2008_9_13 ', '2008_9_14 ', '2008_9_15 ', '2009_1_25 ', '2009_1_26 ', '2009_1_27 ', '2009_5_2 ', '2009_10_2 ', '2009_10_3 ', '2009_10_4 ', '2010_2_13 ', '2010_2_14 ', '2010_2_15 ', '2010_5_21 ', '2010_9_21 ', '2010_9_22 ', '2010_9_23 ', '2011_2_2 ', '2011_2_3 ', '2011_2_4 ', '2011_5_10 ', '2011_9_11 ', '2011_9_12 ', '2011_9_13 ', '2012_1_22 ', '2012_1_23 ', '2012_1_24 ', '2012_5_28 ', '2012_9_29 ', '2012_9_30 ', '2012_10_1 ', '2013_2_9 ', '2013_2_10 ', '2013_2_11 ', '2013_5_17 ', '2013_9_18 ', '2013_9_19 ', '2013_9_20 ', '2014_1_30 ', '2014_1_31 ', '2014_2_1 ', '2014_5_6 ', '2014_9_7 ', '2014_9_8 ', '2014_9_9 ', '2015_2_18 ', '2015_2_19 ', '2015_2_20 ', '2015_5_25 ', '2015_9_26 ', '2015_9_27 ', '2015_9_28 ', '2016_2_7 ', '2016_2_8 ', '2016_2_9 ', '2016_5_14 ', '2016_9_14 ', '2016_9_15 ', '2016_9_16 ', '2017_1_27 ', '2017_1_28 ', '2017_1_29 ', '2017_5_3 ', '2017_10_3 ', '2017_10_4 ', '2017_10_5 ', '2018_2_15 ', '2018_2_16 ', '2018_2_17 ', '2018_5_22 ', '2018_9_23 ', '2018_9_24 ', '2018_9_25 ', '2019_2_4 ', '2019_2_5 ', '2019_2_6 ', '2019_5_12 ', '2019_9_12 ', '2019_9_13 ', '2019_9_14 ', '2020_1_24 ', '2020_1_25 ', '2020_1_26 ', '2020_4_30 ', '2020_9_30 ', '2020_10_1 ', '2020_10_2 ', '2021_2_11 ', '2021_2_12 ', '2021_2_13 ', '2021_5_19 ', '2021_9_20 ', '2021_9_21 ', '2021_9_22 ', '2022_1_31 ', '2022_2_1 ', '2022_2_2 ', '2022_5_8 ', '2022_9_9 ', '2022_9_10 ', '2022_9_11 ', '2023_1_21 ', '2023_1_22 ', '2023_1_23 ', '2023_5_27 ', '2023_9_28 ', '2023_9_29 ', '2023_9_30 ', '2024_2_9 ', '2024_2_10 ', '2024_2_11 ', '2024_5_15 ', '2024_9_16 ', '2024_9_17 ', '2024_9_18 ', '2025_1_28 ', '2025_1_29 ', '2025_1_30 ', '2025_5_5 ', '2025_10_5 ', '2025_10_6 ', '2025_10_7 ', '2026_2_16 ', '2026_2_17 ', '2026_2_18 ', '2026_5_24 ', '2026_9_24 ', '2026_9_25 ', '2026_9_26 ', '2027_2_6 ', '2027_2_7 ', '2027_2_8 ', '2027_5_13 ', '2027_9_14 ', '2027_9_15 ', '2027_9_16 ', '2028_1_26 ', '2028_1_27 ', '2028_1_28 ', '2028_5_2 ', '2028_10_2 ', '2028_10_3 ', '2028_10_4 ', '2029_2_12 ', '2029_2_13 ', '2029_2_14 ', '2029_5_20 ', '2029_9_21 ', '2029_9_22 ', '2029_9_23 ', '2030_2_2 ', '2030_2_3 ', '2030_2_4 ', '2030_5_9 ', '2030_9_11 ', '2030_9_12 ', '2030_9_13 ', '2031_1_22 ', '2031_1_23 ', '2031_1_24 ', '2031_5_28 ', '2031_9_30 ', '2031_10_1 ', '2031_10_2 ', '2032_2_10 ', '2032_2_11 ', '2032_2_12 ', '2032_5_16 ', '2032_9_18 ', '2032_9_19 ', '2032_9_20 ', '2033_1_30 ', '2033_1_31 ', '2033_2_1 ', '2033_5_6 ', '2033_10_6 ', '2033_10_7 ', '2033_10_8 ', '2034_2_18 ', '2034_2_19 ', '2034_2_20 ', '2034_5_25 ', '2034_9_26 ', '2034_9_27 ', '2034_9_28 ', '2035_2_7 ', '2035_2_8 ', '2035_2_9 ', '2035_5_15 ', '2035_9_15 ', '2035_9_16 ', '2035_9_17 ', '2036_1_27 ', '2036_1_28 ', '2036_1_29 ', '2036_5_3 ', '2036_10_3 ', '2036_10_4 ', '2036_10_5 ', '2037_2_14 ', '2037_2_15 ', '2037_2_16 ', '2037_5_22 ', '2037_9_23 ', '2037_9_24 ', '2037_9_25 ', '2038_2_3 ', '2038_2_4 ', '2038_2_5 ', '2038_5_11 ', '2038_9_12 ', '2038_9_13 ', '2038_9_14 ', '2039_1_23 ', '2039_1_24 ', '2039_1_25 ', '2039_4_30 ', '2039_10_1 ', '2039_10_2 ', '2039_10_3 ', '2040_2_11 ', '2040_2_12 ', '2040_2_13 ', '2040_5_18 ', '2040_9_20 ', '2040_9_21 ', '2040_9_22 ', '2041_1_31 ', '2041_2_1 ', '2041_2_2 ', '2041_5_7 ', '2041_9_9 ', '2041_9_10 ', '2041_9_11 ', '2042_1_21 ', '2042_1_22 ', '2042_1_23 ', '2042_5_26 ', '2042_9_27 ', '2042_9_28 ', '2042_9_29 ', '2043_2_9 ', '2043_2_10 ', '2043_2_11 ', '2043_5_16 ', '2043_9_16 ', '2043_9_17 ', '2043_9_18 ', '2044_1_29 ', '2044_1_30 ', '2044_1_31 ', '2044_5_5 ', '2044_10_4 ', '2044_10_5 ', '2044_10_6 ', '2045_2_16 ', '2045_2_17 ', '2045_2_18 ', '2045_5_24 ', '2045_9_24 ', '2045_9_25 ', '2045_9_26 ', '2046_2_5 ', '2046_2_6 ', '2046_2_7 ', '2046_5_13 ', '2046_9_14 ', '2046_9_15 ', '2046_9_16 ', '2047_1_25 ', '2047_1_26 ', '2047_1_27 ', '2047_5_2 ', '2047_10_4 ', '2047_10_5 ', '2048_2_13 ', '2048_2_14 ', '2048_2_15 ', '2048_5_20 ', '2048_9_21 ', '2048_9_22 ', '2048_9_23 ', '2049_2_1 ', '2049_2_2 ', '2049_2_3 ', '2049_5_9 ', '2049_9_10 ', '2049_9_11 ', '2049_9_12 ', '2050_1_22 ', '2050_1_23 ', '2050_1_24 ', '2050_5_28 ', '2050_9_29 ', '2050_9_30 ', '2050_10_1 ', '2051_2_10 ', '2051_2_11 ', '2051_2_12 ', '2051_5_17 ', '2051_9_18 ', '2051_9_19 ', '2051_9_20 ', '2052_1_31 ', '2052_2_1 ', '2052_2_2 ', '2052_5_6 ', '2052_9_6 ', '2052_9_7 ', '2052_9_8 ', '2053_2_18 ', '2053_2_19 ', '2053_2_20 ', '2053_5_25 ', '2053_9_25 ', '2053_9_26 ', '2053_9_27 ', '2054_2_7 ', '2054_2_8 ', '2054_2_9 ', '2054_5_15 ', '2054_9_15 ', '2054_9_16 ', '2054_9_17 ', '2055_1_27 ', '2055_1_28 ', '2055_1_29 ', '2055_5_4 ', '2055_10_4 ', '2055_10_5 ', '2055_10_6 ', '2056_2_14 ', '2056_2_15 ', '2056_2_16 ', '2056_5_22 ', '2056_9_23 ', '2056_9_24 ', '2056_9_25 ', '2057_2_3 ', '2057_2_4 ', '2057_2_5 ', '2057_5_11 ', '2057_9_12 ', '2057_9_13 ', '2057_9_14 ', '2058_1_23 ', '2058_1_24 ', '2058_1_25 ', '2058_4_30 ', '2058_10_1 ', '2058_10_2 ', '2058_10_3 ', '2059_2_11 ', '2059_2_12 ', '2059_2_13 ', '2059_5_19 ', '2059_9_20 ', '2059_9_21 ', '2059_9_22 ', '2060_2_1 ', '2060_2_2 ', '2060_2_3 ', '2060_5_7 ', '2060_9_8 ', '2060_9_9 ', '2060_9_10 ', '2061_1_21 ', '2061_1_22 ', '2061_1_23 ', '2061_5_26 ', '2061_9_27 ', '2061_9_28 ', '2061_9_29 ', '2062_2_8 ', '2062_2_9 ', '2062_2_10 ', '2062_5_16 ', '2062_9_16 ', '2062_9_17 ', '2062_9_18 ', '2063_1_28 ', '2063_1_29 ', '2063_1_30 ', '2063_5_6 ', '2063_10_5 ', '2063_10_6 ', '2063_10_7 ', '2064_2_16 ', '2064_2_17 ', '2064_2_18 ', '2064_5_23 ', '2064_9_24 ', '2064_9_25 ', '2064_9_26 ', '2065_2_4 ', '2065_2_5 ', '2065_2_6 ', '2065_5_12 ', '2065_9_14 ', '2065_9_15 ', '2065_9_16 ', '2066_1_25 ', '2066_1_26 ', '2066_1_27 ', '2066_5_1 ', '2066_10_2 ', '2066_10_3 ', '2066_10_4 ', '2067_2_13 ', '2067_2_14 ', '2067_2_15 ', '2067_5_20 ', '2067_9_22 ', '2067_9_23 ', '2067_9_24 ', '2068_2_2 ', '2068_2_3 ', '2068_2_4 ', '2068_5_9 ', '2068_9_10 ', '2068_9_11 ', '2068_9_12 ', '2069_1_22 ', '2069_1_23 ', '2069_1_24 ', '2069_4_28 ', '2069_9_28 ', '2069_9_29 ', '2069_9_30 ', '2070_2_10 ', '2070_2_11 ', '2070_2_12 ', '2070_5_17 ', '2070_9_18 ', '2070_9_19 ', '2070_9_20 ', '2071_1_30 ', '2071_1_31 ', '2071_2_1 ', '2071_5_7 ', '2071_9_7 ', '2071_9_8 ', '2071_9_9 ', '2072_2_18 ', '2072_2_19 ', '2072_2_20 ', '2072_5_25 ', '2072_9_25 ', '2072_9_26 ', '2072_9_27 ', '2073_2_6 ', '2073_2_7 ', '2073_2_8 ', '2073_5_14 ', '2073_9_15 ', '2073_9_16 ', '2073_9_17 ', '2074_1_26 ', '2074_1_27 ', '2074_1_28 ', '2074_5_3 ', '2074_10_4 ', '2074_10_5 ', '2074_10_6 ', '2075_2_14 ', '2075_2_15 ', '2075_2_16 ', '2075_5_22 ', '2075_9_23 ', '2075_9_24 ', '2075_9_25 ', '2076_2_4 ', '2076_2_5 ', '2076_2_6 ', '2076_5_10 ', '2076_9_11 ', '2076_9_12 ', '2076_9_13 ', '2077_1_23 ', '2077_1_24 ', '2077_1_25 ', '2077_4_30 ', '2077_9_30 ', '2077_10_1 ', '2077_10_2 ', '2078_2_11 ', '2078_2_12 ', '2078_2_13 ', '2078_5_19 ', '2078_9_19 ', '2078_9_20 ', '2078_9_21 ', '2079_2_1 ', '2079_2_2 ', '2079_2_3 ', '2079_5_8 ', '2079_9_9 ', '2079_9_10 ', '2079_9_11 ', '2080_1_21 ', '2080_1_22 ', '2080_1_23 ', '2080_5_26 ', '2080_9_27 ', '2080_9_28 ', '2080_9_29 ', '2081_2_8 ', '2081_2_9 ', '2081_2_10 ', '2081_5_16 ', '2081_9_16 ', '2081_9_17 ', '2081_9_18 ', '2082_1_28 ', '2082_1_29 ', '2082_1_30 ', '2082_5_5 ', '2082_10_5 ', '2082_10_6 ', '2082_10_7 ', '2083_2_16 ', '2083_2_17 ', '2083_2_18 ', '2083_5_24 ', '2083_9_25 ', '2083_9_26 ', '2083_9_27 ', '2084_2_5 ', '2084_2_6 ', '2084_2_7 ', '2084_5_12 ', '2084_9_13 ', '2084_9_14 ', '2084_9_15 ', '2085_1_25 ', '2085_1_26 ', '2085_1_27 ', '2085_5_1 ', '2085_10_2 ', '2085_10_3 ', '2085_10_4 ', '2086_2_13 ', '2086_2_14 ', '2086_2_15 ', '2086_5_20 ', '2086_9_21 ', '2086_9_22 ', '2086_9_23 ', '2087_2_2 ', '2087_2_3 ', '2087_2_4 ', '2087_5_10 ', '2087_9_10 ', '2087_9_11 ', '2087_9_12 ', '2088_1_23 ', '2088_1_24 ', '2088_1_25 ', '2088_4_28 ', '2088_9_28 ', '2088_9_29 ', '2088_9_30 ', '2089_2_10 ', '2089_2_11 ', '2089_2_12 ', '2089_5_17 ', '2089_9_18 ', '2089_9_19 ', '2089_9_20 ', '2090_1_29 ', '2090_1_30 ', '2090_1_31 ', '2090_5_7 ', '2090_9_7 ', '2090_9_8 ', '2090_9_9 ', '2091_2_17 ', '2091_2_18 ', '2091_2_19 ', '2091_5_25 ', '2091_9_26 ', '2091_9_27 ', '2091_9_28 ', '2092_2_6 ', '2092_2_7 ', '2092_2_8 ', '2092_5_13 ', '2092_9_15 ', '2092_9_16 ', '2092_9_17 ', '2093_1_26 ', '2093_1_27 ', '2093_1_28 ', '2093_5_3 ', '2093_10_4 ', '2093_10_5 ', '2093_10_6 ', '2094_2_14 ', '2094_2_15 ', '2094_2_16 ', '2094_5_21 ', '2094_9_23 ', '2094_9_24 ', '2094_9_25 ', '2095_2_4 ', '2095_2_5 ', '2095_2_6 ', '2095_5_11 ', '2095_9_12 ', '2095_9_13 ', '2095_9_14 ', '2096_1_24 ', '2096_1_25 ', '2096_1_26 ', '2096_4_30 ', '2096_9_30 ', '2096_10_1 ', '2096_10_2 ', '2097_2_11 ', '2097_2_12 ', '2097_2_13 ', '2097_5_19 ', '2097_9_19 ', '2097_9_20 ', '2097_9_21 ', '2098_1_31 ', '2098_2_1 ', '2098_2_2 ', '2098_5_8 ', '2098_9_9 ', '2098_9_10 ', '2098_9_11 ', '2099_1_20 ', '2099_1_21 ', '2099_1_22 ', '2099_5_27 ', '2099_9_28 ', '2099_9_29 ', '2099_9_30 ', '2100_2_8 ', '2100_2_9 ', '2100_2_10 ', '2100_5_16 ', '2100_9_17 ', '2100_9_18 ', '2100_9_19'];
        var holidayinterval = setInterval(function(){
            if(allblock.length > 10){
                clearInterval(holidayinterval);
                var dateblock = document.getElementsByClassName("date");
                for(var i = 0 ; i < allblock.length;i++){
    //                clog("allblock ",allblock[i]);
                    var classname = allblock[i].className;

                    var dateblock = allblock[i].querySelector('.date');
                    allblock[i].style.backgroundColor = classname.indexOf("outside") >=0 ? "#f5f5f5":"white";
                    if(classname.indexOf("today") >=0)allblock[i].style.backgroundColor = "#f7e688";
                    
                    if(classname.indexOf("sunday") >=0){
                         dateblock.style.color = classname.indexOf("outside") >=0 ? "#f5aba4" : "red";
                         dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                    }else if(classname.indexOf("saturday") >=0){
                        dateblock.style.color = classname.indexOf("outside") >=0 ? "#d7d8fa" : "blue";

                    }else {

                        dateblock.style.color = classname.indexOf("outside") >=0 ? "#cccccc" : "black";    
                        dateblock.style.fontWeight ="normal";

                    }

                        for(var j = 0 ; j < yholiday.length; j++){
                            if(classname.indexOf(yholiday[j]) >= 0){
                                var dateblock = allblock[i].querySelector('.date');
                                dateblock.style.color = classname.indexOf("outside") >=0 ? "#f5aba4" : "red";
                                dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                                break;
                            }    
                        }
                        for(var j = 0 ; j < uholiday.length; j++){
                            if(classname.indexOf(uholiday[j]) >= 0){
                                var dateblock = allblock[i].querySelector('.date');
                                dateblock.style.color = classname.indexOf("outside") >=0 ? "#f5aba4" : "red";
                                dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                                break;
                            }    
                        }


                }
                
            }
        },10);
        
            
    
    }
    holidayCheck();
    
    
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
    var zoom = 100;
    var screen_width = $(window).width();
    var calendar_width = 700;
    zoom = (screen_width/calendar_width)*0.95;
    if(zoom > 1)zoom = 1;
    clog("zoom is "+zoom);
    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  98%;  zoom: "+zoom+";-moz-transform: scale("+zoom+");}</style>";
   
    
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

    clog("width ",$(window).width());
    clog("height ",$(window).height());

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
    $el.on('click', '.js-cal-prev', function () {
        clog("prev click 000");
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() - 1); break;
      case 'month': options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1); break;
      case 'week': options.date.setDate(options.date.getDate() - 7); break;
      case 'day':  options.date.setDate(options.date.getDate() - 1); break;
      }
      draw();
        holidayCheck();
    }).on('click', '.js-cal-next', function () {
        clog("next click 111");
      switch(options.mode) {
      case 'year': options.date.setFullYear(options.date.getFullYear() + 1); break;
      case 'month': options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1); break;
      case 'week': options.date.setDate(options.date.getDate() + 7); break;
      case 'day':  options.date.setDate(options.date.getDate() + 1); break;
      }
      draw();
        holidayCheck();
    }).on('click', '.js-cal-option', function () {
      clog("==============================");
      clog("option click 222");
      var $t = $(this), o = $t.data();
      clog("o is ",o);
      clog("options is ",options);
      clog("$t is ",$t);
      if (o.date) {
          clog("o.mode is "+o.mode);
          clog("o.date is "+o.date);
          o.date = new Date(o.date);
          if(o.mode == undefined)o.mode = "day";
          
      }
        
      $.extend(options, o);
      draw();
      holidayCheck();
    
    }).on('click', '.js-cal-years', function () {
        clog("years click 222");
        holidayCheck();
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
        clog(" click 3333");
        var $t = $(this), o = $t.data();
        if (o.date) {
          clog("o.mode is "+o.mode);
          clog("o.date is "+o.date);
          o.date = new Date(o.date);
          if(o.mode == undefined)o.mode = "day";
          
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
        clog("index is "+index);
        clog("event is ",event);
        
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
                clog("event is ",event);
                clog(yy+"년 "+(mm+1)+"월 "+dd+"일 "+hh+"시 예약버튼 클릭! "+button.id);
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
      var $event = $('<div/>', {'class': 'event', text: event.title, title: event.title, 'data-index': index}),
          e = new Date(event.start),
          dateclass = e.toDateCssClass(),
          day = $('.' + e.toDateCssClass()),
          empty = $('<div/>', {'class':'clear event', html:' '}), 
          numbevents = 0, 
          time = event.start.toTimeString(),
          endday = event.end && $('.' + event.end.toDateCssClass()).length > 0,
          checkanyway = new Date(e.getFullYear(), e.getMonth(), e.getDate()+40),
          existing,
          i;
      $event.toggleClass('all-day', !!event.allDay);
      if (!!time) {
        $event.html('<strong>' + time + '</strong> ' + $event.html());
      }
      if (!event.end) {
        $event.addClass('begin end');
        $('.' + event.start.toDateCssClass()).append($event);
        return;
      }
            
      while (e <= event.end && (day.length || endday || options.date < checkanyway)) {
        if(day.length) { 
          existing = day.find('.event').length;
          numbevents = Math.max(numbevents, existing);
          for(i = 0; i < numbevents - existing; i++) {
            day.append(empty.clone());
          }
          day.append(
            $event.
            toggleClass('begin', dateclass === event.start.toDateCssClass()).
            toggleClass('end', dateclass === event.end.toDateCssClass())
          );
          $event = $event.clone();
          $event.html(' ');
        }
        e.setDate(e.getDate() + 1);
        dateclass = e.toDateCssClass();
        day = $('.' + dateclass);
      }
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
            clog("dayaddeventcall!!",options.data);
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
        }
      }
    }
    
    draw();    
  }
  
  ;(function (defaults, $, window, document) {
    $.extend({
      calendar: function (options) {
        return $.extend(defaults, options);
      }
    }).fn.extend({
      calendar: function (options) {
        options = $.extend({}, defaults, options);
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

    for(i = 0; i < 5; i++) {
        j = Math.max(i % 15 - 10, 0);
        //c and c1 jump around to provide an illusion of random data
        c = (c * 1063) % 1061; 
        c1 = (c1 * 3329) % 3331;
        d = (d1 + c + c1) % 839 - 440;
        hh = i % 36;
        mm = (i % 4) * 15;
        if (hh < 18) { hh = 0; mm = 0; } else { hh = Math.max(hh - 24, 0) + 8; }
        
        var title = "PT"; //제목이지만 내용을 적으면 된다.
        var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
        y = 2021;
        m = 0;  //
        d = 6;
        hh = 11;
        mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
        start = new Date(y, m, d, hh, mm);
        end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
        clog(i+") start is "+start);   
        clog(i+") j:"+j+" c :"+c+" c1:"+c1+" d:"+d+" hh:"+hh+" mm:"+mm+" start:"+start+" end:"+end)  
        clog("!(i % 6) "+(!(i % 6)));


//        data.push({ title: names[c1 % names.length], start: start, end: end, allDay: !(i % 6), text: slipsum[c % slipsum.length ]  });
       data.push({ title: title, start: start, end: end, allDay: allday });
    }
  
  data.sort(function(a,b) { return (+a.start) - (+b.start); });
  
//data must be sorted by start date

//Actually do everything
$('#holder').calendar({
  data: data
});
</script>