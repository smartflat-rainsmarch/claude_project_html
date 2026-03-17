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
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

    
-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="./css/modaldialog.css" rel="stylesheet">
   <!--    당겨서 새로고침-->
    <script src="./libs/pulltorefresh/pulltorefresh.js"></script><!-- Page Pull to Refresh 스크립트 -->
    <script src="./libs/pulltorefresh/touch-emulator.js"></script><!-- Page Pull to Refresh 스크립트 -->
    <link rel="stylesheet" href="./libs/pulltorefresh/pulltorefreshstyle.css">
    
    <script src="js/scripts.js?ver1.3"></script>

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

    </style>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->





</head>

<body>
    <div id="main">
        <label class='textevent' style="color:red;">*화면을 아래로 당겨서 새로고침</label>
        <div id="container" class="container" style="background-color:#eeeeee">
            <div id="center" class="center">

            </div>
        </div>
        <div id="reservation_container" class="container" style="display:none;background-color:#eeeeee">
            <div id="reservation_center" class="reservation_center">
                <!--        <h3 style="text-align:center" id="reservation_title"></h3><br>-->

                <div>
<!--                    <div align="left" style="position:absolute;margin-left:4px;margin-top:4px"><button class="btn btn-default" onclick="refresh_page()" style="background-color:#a3bDf1"><img src="./img/refresh.png"/></button></div>-->
                <div style="padding:20px;background-color:#fff7d1" ><text style="font-size:20px;color:#555555" id ="manager_name">PT 30회</text>&nbsp;&nbsp;(횟수 :&nbsp;<text style="font-size:15px;font-weight:bold;color:#ee0000" id ="max_count">PT 30회</text>)<br><text style="font-size:15px;font-weight:bold;color:#ee0000" id ="use_count">30회중 12회 진행</text>&nbsp;&nbsp;&nbsp;<text style="color:blue;font-size:15px" id ="period">2020-01-01~2020-04-30</text></div>
                </div>
                <br><br>
                <h5 id ="manager"></h5>
                <div class="calendar_container theme-showcase">
                    <br>
                    <div id="holder" class="row" ></div>
                </div>



    <!--            <h5 id="teacher_reservation_title" style="color:gray;padding:20px;background-color:#fff7d1">강사 예약화면</h5>-->
    <!--            <p align="right"><button class="btn btn-default" id="btn_teach_reservation" onclick="open_sheet()" style="background-color:#a3bDf1">일정오픈하기</button></p>-->

                <div class="calendar_container theme-showcase">
                    <div id="holder" class="row"></div>
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
        
        //당겨서 새로고침
        PullToRefresh.init({
            mainElement: '#main',
            onRefresh: function() { location.reload(); }
        });

        
        
        var param_centercode = getParam("centercode");
        
    
        var calendar_data = null;
//        var reservationinfo = null;
        var reservationinfo = null;
        var container = document.getElementById("container");
        
        var selected_my_reservation = null;
        
        var data = {
            type: "myreservation"           
        }
        
        CallHandler("my_reservation", data, function(res) {
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
               getTeacher(json_array[0]);
            }else if(json_array.length > 1)
            {
                for(var i = 0 ; i < json_array.length; i++){
                    const json = json_array[i];
                    var button = document.createElement('button');   
                    var title = json.mbstype+" 예약";
                    var btntxt = document.createTextNode(title);
                    button.id = json.mbstype;
                    button.className = "my-button";
                    button.appendChild(btntxt);
                    
                    button.onclick = function(){
                        
                       getTeacher(json);
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
            alertMsg(res.message);
            
//            show_error_popup("ERROR",res.message, "exit");
        }

    }, function(err) {
        alertMsg("네트워크 에러 ");
//         show_error_popup("ERROR","네트워크 에러", "exit");
    });
        
        
        
        
    function getTeacher(rjson){
        selected_my_reservation = rjson;
        var teachername = rjson.manager;
        var teacherid = rjson.managerid;
        var teachtype = rjson.mbstype;
        var centercode = rjson.mbsusecentercode;
        
        if(!teacherid){
            alertMsg("아직 담당 강사가 선택되지 않았습니다.");
            return;
        }
        
        initMyInfo(rjson);
        
        var data = {
            type: "customer_teacherreservation",
            teacherid : teacherid,
            teachtype : teachtype,
            centercode : centercode
        }
       
        CallHandler("my_reservation", data, function(res) {
            var code = parseInt(res.code);

            if (code == 100) {

                var json = res.message;
                setCalendar(json);
               

            } else {
                            alertMsg(res.message);

//                show_error_popup("ERROR", res.message, "exit");
            }

        }, function(err) {
                    alertMsg("네트워크 에러 ");
//            show_error_popup("ERROR", "네트워크 에러", "exit");
        });
    }
        
        
        function initMyInfo(json){
            
            var manager_name = document.getElementById("manager_name");
            var max_count = document.getElementById("max_count");
            var use_count = document.getElementById("use_count");
            var period = document.getElementById("period");
            
            manager_name.innerHTML = json.mbstype == "PT" ? json.manager : json.manager;
            max_count.innerHTML = json.mbsname;
            use_count.innerHTML = json.mbsmaxcount+"회중 "+json.usecount+"회 진행";
            period.innerHTML = json.starttime.substr(0,10)+" ~ "+json.endtime.substr(0,10);
            
        }
        
        
        
        
        
        function setCalendar(json){
            
            
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
            console.log("강사 일정표 ", json);

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
                    

                                    console.log("json_array is ",reservationinfo);
                }
            },function(err){
                console.log("err ",err);
            });
            
            

        }
        
        function setCourseReservation(jsonobj) {
            //        reservationinfo = jsonobj;
            //select 
            console.log("기본 정보 ", jsonobj);
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
            
            
            console.log("teach_name_value " + teach_name_value);
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

//        function show_error_popup(title, message, clickurl) {
//            $("#end_modal").modal({
//                keyboard: false,
//                backdrop: 'static'
//            });
//
//        }
//
//        function error_click() {
//            if (window.android) window.android.closeWebView("close");
//        }

//        function open_sheet() {
//            console.log("일정 오픈하기");
//            var style = {
//                bodycolor: "#eeeeff",
//                size: {
//                    width: "100%",
//                    height: "100%"
//                }
//            };
//            var body = "<div id='div_teach_reservation' background-color:#eeeeff;padding-bottom:30px'><form action='#' method='post' id='join-us' target='iframe1'><div class='form-group row'><div id=formdiv class='col-8 offset-2'><br><label for='teach_name'>강좌종류</label><select id='teach_name' class='form-control' onchange='teachNameClick()' name='teach_name' required></select><br><div id='teach_datas' style='display:none'><label for='teach_maxnumber'>인원수</label><select id='teach_maxnumber' class='form-control' onchange='teachMaxNumberClick()' name='teach_maxnumber' required></select><br><label for='teach_times'>시간대 선택</label><select id='teach_times' class='form-control' onchange='teachTimeClick()' name='teach_times' required></select><br><div class='form-control' name='subscription_path'><span id='teach_select_times'></span></div><br><div id = 'teach_date'>오픈시작일 : <input onchange='teachdate_onchange(1)' id = 'teach_startdate' type='date' value=''/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;오픈종료일 : <input onchange='teachdate_onchange(2)' id = 'teach_enddate' type='date' value=''/></div></div></div></div></form></div>";
//            showModalDialog(document.body, "일정 오픈하기", body, "일정오픈하기", "취소", function() {
//                console.log("오픈하기!!!");
//                sendTeacherReservation();
//                hideModalDialog();
//                
//            }, function() {
//                hideModalDialog();
//            }, style);
//
//            setCourseReservation(reservationinfo);
//
//            //        var div_teach_reservation = document.getElementById("div_teach_reservation");
//            //        var btn_teach_reservation = document.getElementById("btn_teach_reservation");
//            //        if(div_teach_reservation.style.display == "block"){
//            //            div_teach_reservation.style.display="none";
//            //            btn_teach_reservation.innerHTML = "▼ 일정오픈하기";
//            //        }else {
//            //            div_teach_reservation.style.display="block";   
//            //            btn_teach_reservation.innerHTML = "▲ 일정오픈접기";
//            //        }
//
//        }

//        function sendTeacherReservation() {
//            var select_teach = document.getElementById("teach_name");
//            var teach_id = parseInt(select_teach.value);
//            var teach_name = select_teach.options[select_teach.selectedIndex].text;
//           
//            var teach_maxnumber = document.getElementById("teach_maxnumber").value;
////            var teach_times = document.getElementById("teach_times");
//            var teach_select_times = document.getElementById("teach_select_times");
//            var times = [];
//            for (var i = 0; i < teach_select_times.children.length; i++) 
//                times.push(parseInt(teach_select_times.children[i].id));
//            console.log("teach_select_times is ",times);
//            var startdate = document.getElementById("teach_startdate").value;
//            var enddate = document.getElementById("teach_enddate").value;
//            var day = get_Day(startdate , enddate);
//            var value_dates = [];
//        
//               
//            for(var i = 0 ; i < day; i++){
//                
//                 var default_data = {"date": "","times":[]};
//                var mdate = nextDay(startdate, i);
//                for(var j = 0; j < times.length; j++){
//                    var default_time = {"time":-1, "members":[]};
//                    default_data.date = mdate;
//                    default_time.time = times[j];
//                    default_data.times.push(default_time);
//                }
//                value_dates.push(default_data);
//            }
//            
//            
//            var value = {};
//            for(var i = 0 ; i < reservationinfo.classes.length; i++){
//                if(reservationinfo.classes[i].id == teach_id){
//                    value.openid = reservationinfo.classes[i].openid;        
//                    break;
//                }
//            }
//            value.teachid = teach_id;
//            value.max = teach_maxnumber;
//            value.teachname = teach_name;
//            value.dates = value_dates;
//            //value를 만들어서 서버에 보내야한다.
//
////            console.log("window is ",value);
//            
//            
//            mergeAllData(value);
//            
////            insertAllReservation();
////            if(true)return;
//            
//
//            var data = {
//                //            uid : "<?php echo $uid; ?>",
//                //            id : "<?php echo $id; ?>",
//                type: "sendteacherreservation",
//                value: JSON.stringify(calendar_data)
//            };
//            CallHandler("my_teacher_reservation", data, function(res) {
//                var code = parseInt(res.code);
//
//                var param = "?centercode="+calendar_data.centercode;
//                    
//                if (code == 100) {
//                    refresh_page(param);
//                }else{
//                    alertMsg(res.message);
//                    refresh_page(param);
//                }
//            });
//        }
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

//            console.log("mem_teacher_alldata is ",mem_teacher_alldata);
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
                console.log("isover "+isover);
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
//            console.log("startdate "+teach_startdate.value);
//            console.log("teach_enddate "+teach_enddate.value);            
        }
        function delete_reservation(info,status){
            console.log("delete_reservation info is "+info);
            var mid = selected_my_reservation.managerid;
            var mtype = selected_my_reservation.mbstype;
            var centercode = selected_my_reservation.mbsusecentercode;
            
            var obj = info.split('|');
            var date = obj[0].substr(0,10);
            var time = obj[0].substr(11,2);
            // ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+myuid+"|"+event.opentype;
            
            if(status == 0){
                var selecttag = "<select id='reservation_status' class='form-control' >"+
                                    "<option value=''>== 상태값을 선택하세요 ==</option>"+
                                    "<option value='2'>레슨종료(PT 1회 차감됨)</option>"+
                                    "<option value='3'>예약 취소하기</option>"+                                
                                "</select><br>";
                var message = "<label align = 'center'>("+mtype+") "+date+"일 "+time+" 시 예약건변경</label><br>"+selecttag;
                showModalDialog(document.body, "예약 변경",message, "변경하기", "닫기", function() {
                    var reservation_status = document.getElementById("reservation_status");
                    if(reservation_status.value == ''){
                        alertMsg("상태값을 선택하세요.");
                        return;
                    }
                    //예약건 취소하기
                    update_reservation_user(parseInt(reservation_status.value),info,obj[0],obj[1],obj[2],obj[3],mid,mtype,centercode);
                }, function() {
                   hideModalDialog();
                });
            }else{ //status == 1 일때
                var message = date+" "+time+"시 레슨종료 확인을 하시겠습니까?";
                showModalDialog(document.body, "운동종료 승인하기",message, "운동종료 승인하기", "닫기", function() {
                    
                    //운동종료 승인하기하기
                    update_reservation_user(2,info,obj[0],obj[1],obj[2],obj[3],mid,mtype,centercode);
                }, function() {
                   hideModalDialog();
                });
                
            }
            
        }
        function insert_reservation(info){
            var mid = selected_my_reservation.managerid;
            var mtype = selected_my_reservation.mbstype;
            var centercode = selected_my_reservation.mbsusecentercode;
            
           
            var obj = info.split('|');
             console.log("obj[0]",obj[0]);
            var date = obj[0].substr(0,10);
            var time = obj[0].substr(11,2);
            // ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+myuid+"|"+event.opentype;
            showModalDialog(document.body, "예약하기","("+mtype+") "+date+"일 "+time+" 시에 예약하시겠습니까?", "예약하기", "취소", function() {
                update_reservation_user(0, info,obj[0],obj[1],obj[2],obj[3],mid,mtype,centercode);
            }, function() {
               hideModalDialog();
            });
            
            
            //월 달력으로 이동한다.테스트
//            window.options.mode = "month";
//            console.log("window.defaults ",window.defaults);
//            console.log("window.options ",window.options);
//            window.calendar(window.el,window.options);
        }
        function update_reservation_user(status,info,_date ,_teachid,_user,_opentype,managerid,mbstype,centercode){
            
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
            var rtype = status == 0 ? "insertreservationuser" : "deletereservationuser";
            
            var data = {
                type: rtype,
                centercode: centercode,
                insertuser:JSON.stringify(insertuser)
            }
            CallHandler("my_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {

                   var data = res.message;
                   
                   //////////////////////////////////////////////////////
                   update_user_result(info,date,hh,status,data); //화면 색과 버튼을 바꾼다.
                   update_window_options_data(status,_date ,insertuser.teachid,data); // 윈도우 데이타를 함께 바꾼다.
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
        
        //고객정보를 달력에서
        function update_window_options_data(status,_date ,_teachid,data){
//            console.log("remove_user_data 000");
            var teachname = "";
            for(var i = 0 ; i < reservationinfo.classes.length; i++){
                if(data.teachid == reservationinfo.classes[i].id){
                    teachname = reservationinfo.classes[i].name;
                    break;
                }
            }
            
            var title = get_reservation_status_text(status)+"("+data.userlen+"/"+data.max+") "+teachname;
            for(var i = 0 ; i < window.options.data.length; i++){
                var event = window.options.data[i];
               
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                var date = getDateToStr(yy,mm,dd,hh);
                var teachid = event.teachid;
                var user = event.user;
//                console.log("remove_user_data 111 date "+date+" _date "+_date);
//                console.log("teachid "+teachid+" _teachid "+_teachid+" user "+user+" _user "+_user);
//               console.log("window.options.data i ",window.options.data[i]);
                if(date == _date && teachid == _teachid){
//                    console.log("remove_user_data 222");
//                    console.log("window.options.data ",window.options.data[i]);
                    if(status != 0){ //예약을 취소했다. 화면
                        title = title+" 예약가능";
                        window.options.data[i].title = title;
                        window.options.data[i].user = "";
                        window.options.data[i].tcss = setDivType("default");
                        
                    }else{ //예약했다. 화면
                         title = title+" 예약완료";
                         window.options.data[i].title = title;
                         window.options.data[i].user = "true";
                         window.options.data[i].tcss = setDivType("close");
                    }
//                        window.options.data.splice(i,1);
//                    else
//                        window.options.data.splice(i,1);
//                    console.log("window.options.data i ",window.options.data[i]);
                    break;
                }
            }
        }
        
        //고객정보상태 변환
        function update_user_result(info,date,hh, status,data){
//            console.log("innerHTML ",document.getElementById(info).innerHTML);
            var div = document.getElementById(info);
            var teachname = "";
            for(var i = 0 ; i < reservationinfo.classes.length; i++){
                if(data.teachid == reservationinfo.classes[i].id){
                    teachname = reservationinfo.classes[i].name;
                    break;
                }
            }
            
            var status_txt = status == 2 ? "종료 승인함" : "";
            var btntag = "("+data.userlen+"/"+data.max+") "+teachname+status_txt;
            document.getElementById("use_count").innerHTML = data.maxcount+"회중 "+data.usecount+"회 진행";
            if(status != 0){ //

                
                
//                C_showToast(random_string(), "예약취소", date+" "+hh+"시 예약을 취소하였습니다.", function() {});
                if(status == 3){
                    var tcss = setDivType("default");
                    div.style.backgroundImage = tcss.titlebackimg;
                    div.style.color = tcss.fontcolor;
                    div.style.fontWeight = "normal";

                    btntag = btntag+" 예약가능<button class='btn btn-primary' style='float:right;margin-top:-9px;' onclick='insert_reservation(\"" + info + "\")' >예약하기</button>";
                    alertMsg(hh+"시 예약을 취소하였습니다.",function(){
                        hideModalDialog();
                    });
                } //cancel
                    
                else if(status == 2){
                    var tcss = setDivType("userfinish");
                    div.style.backgroundImage = tcss.titlebackimg;
                    div.style.color = tcss.fontcolor;
                    div.style.fontWeight = "normal";

//                    btntag = btntag+" 예약가능<button class='btn btn-primary' style='float:right;margin-top:-9px;' onclick='insert_reservation(\"" + info + "\")' >예약하기</button>";
                    alertMsg(hh+"시 운동상태를 완료로 변경하였습니다.",function(){
                        hideModalDialog();
                    });
                }
                    
                else 
                    hideModalDialog();
                
            }else { //최초 예약한상태
                var tcss = setDivType("close");
                div.style.backgroundImage = tcss.titlebackimg;
                div.style.color = tcss.fontcolor;
                div.style.fontWeight = "normal";
                
                btntag = btntag+" 예약완료<button class='btn btn-primary' style='background-color:f8585b;float:right;margin-top:-9px;' onclick='delete_reservation(\"" + info + "\", "+status+")' >변경하기</button>";
                
//                C_showToast(random_string(), "예약완료", date+" "+hh+"시 예약을 완료하였습니다.", function() {});
                 alertMsg(hh+"시 예약을 완료하였습니다.",function(){
                     hideModalDialog();
                 });
                
            }
            div.innerHTML = btntag;
            
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
      console.log("year is "+year);
      console.log("month is "+month);
      console.log("first is "+first);
      console.log("last is "+last);
      console.log("startingDay is "+startingDay);
      console.log("dayclass is "+dayclass);
      
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
                         console.log("m_month is "+m_month);
                           
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
                        console.log("arr is ",days);
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
                                <th class="timetitle">Before 6 AM</th>
                                <td class="time-0-0"> </td>
                            </tr>
                            {{for (i = 6; i < 22; i++) { }}
                            <tr>
                                <th class="timetitle">{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}</th>
                                <td class="time-{{: i}}-0"> </td>
                            </tr>

                            {{ } }}
                            <tr>
                                <th class="timetitle">After 10 PM</th>
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
    if (zoom > 1) zoom = 1;
    console.log("zoom is " + zoom);
    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  98%;  zoom: " + zoom + ";-moz-transform: scale(" + zoom + ");}</style>";


    //    var calendar = document.getElementsByClassName("calendar-table");//[0].style.transform = "scale(0.5)";
    //    setTimeout(function(){
    //        console.log("*** calendar is ",calendar[0]);    
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

        console.log("width ", $(window).width());
        console.log("height ", $(window).height());

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
        //    console.log("calendar ",$('calendar-table'));
        //    console.log("zoom is "+zoom);
        //    $('calendar-table').css("zoom", "50%");
        //    $('.calendar-table').css("transform", "scale(0.5)");

        //     $('.scalable').each(function(){
        //        rescale($(this));
        //    })


        function calendar($el, options) {
            //actions aren't currently in the template, but could be added easily...
            console.log("callender call $el !! ",$el);
            console.log("callender call options !! ",options);
                
            $el.on('click', '.js-cal-prev', function() {
                console.log("prev click 000");
                switch (options.mode) {
                    case 'year':
                        options.date.setFullYear(options.date.getFullYear() - 1);
                        break;
                    case 'month':
                        options.date.setMonth(options.date.getMonth() - 1);
                        break;
                    case 'week':
                        options.date.setDate(options.date.getDate() - 7);
                        break;
                    case 'day':
                        options.date.setDate(options.date.getDate() - 1);
                        break;
                }
                draw();
                holidayCheck();
            }).on('click', '.js-cal-next', function() {
                console.log("next click 111");
                switch (options.mode) {
                    case 'year':
                        options.date.setFullYear(options.date.getFullYear() + 1);
                        break;
                    case 'month':
                        options.date.setMonth(options.date.getMonth() + 1);
                        break;
                    case 'week':
                        options.date.setDate(options.date.getDate() + 7);
                        break;
                    case 'day':
                        options.date.setDate(options.date.getDate() + 1);
                        break;
                }
                draw();
                holidayCheck();
            }).on('click', '.js-cal-option', function() {
                console.log("==============================");
                console.log("option click 222");
                var $t = $(this),
                    o = $t.data();
                console.log("o is ", o);
                console.log("options is ", options);
                console.log("$t is ", $t);
                if (o.date) {
                    console.log("o.mode is " + o.mode);
                    console.log("o.date is " + o.date);
                    o.date = new Date(o.date);
                    if (o.mode == undefined) o.mode = "day";

                }

                $.extend(options, o);
                draw();
                holidayCheck();

            }).on('click', '.js-cal-years', function() {
                console.log("years click 222");
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
                console.log(" click 3333");
                var $t = $(this),
                    o = $t.data();
                if (o.date) {
                    console.log("o.mode is " + o.mode);
                    console.log("o.date is " + o.date);
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
//                console.log("index is " + index);
//                console.log("event is ", event);

                if (!!event.allDay) {
                    monthAddEvent(index, event);
                    return;
                }
                var button = document.createElement('button');
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
//                if (event.type && event.type == "reservation_button") {
//
//                    
//                    var title = hh + "시 예약하기";
//                    var btntxt = document.createTextNode(title);
//                    button.id = "btn_reservation_" + hh;
//                    button.className = "my-button";
//                    button.appendChild(btntxt);
//
//                    button.onclick = function() {
//                        console.log("event is ", event);
//                        console.log(yy + "년 " + (mm + 1) + "월 " + dd + "일 " + hh + "시 예약버튼 클릭! " + button.id);
//                    }
//
//
//                    //        $event.css({'background-color':'yellow'});​
//                }
                var user = "<?php echo $uid; ?>";
                var clickid = ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+user+"|"+event.opentype;
                
                //기본 텍스트
                var div = document.createElement("div");
                div.id = clickid;
                div.innerHTML = "<span style='font-size:15px;padding:10px'>"+event.title+"</span>";
                div.style.padding = !event.user ? "15px":"15px";
                div.style.margin = "2px";
                
                var $event = $('<div/>', {
                    'class': 'event',
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

                if (!!time) {
//                   if(event.timefontcolor)
//                        $event.html('<strong style="color:'+ event.timefontcolor +'">' + time + '</strong> ' + $event.html());
//                    else
//                        $event.html('<strong>' + time + '</strong> ' + $event.html());
                }
               
//                console.log("clickid is ",clickid);
                
                if(event.isover >= 0 && !event.user){
//                    $event.html($event.html()+"<p align='right'><button class='btn btn-primary' onclick='remove_user(13)' >삭제하기</button></p>");
                    div.innerHTML = div.innerHTML+"<button class='btn btn-primary' style='float:right;margin-top:-9px;' onclick='insert_reservation(\"" + clickid + "\")' >예약하기</button>";                    
                }else if(event.user=="true"){
                    var btn_txt = event.status == 0 ? "변경하기" : "운동종료 승인하기";
                    if(event.status < 2)
                        div.innerHTML = div.innerHTML+"<button class='btn btn-primary' style='background-color:f8585b;float:right;margin-top:-9px;' onclick='delete_reservation(\"" + clickid + "\", "+event.status+")' >"+btn_txt+"</button>";                    
                }
                
//                $event.toggleClass('begin', startint === dateint);
//                $event.toggleClass('end', endint === dateint);
                if (hour < 6) {
                    timeclass = '.time-0-0';
                }
                if (hour < 22) {
                    timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
                }
                
                
                

                 //////////////////////////////////////////////////////////
                //neel change start
                //////////////////////////////////////////////////////////

                //이부분이 날짜칸에 데이타 태그를 삽입하는부분이다.
//                    if(event.backgroundimage)$event.css("background-image",event.backgroundimage);
//                    if(event.fontcolor)$event.css("color",event.fontcolor);
                
                if(event.isover < 0){
                    var tcss = setDivType("over");
                    div.style.backgroundImage = tcss.titlebackimg;
                    div.style.color = tcss.fontcolor;
                    div.style.fontWeight = "normal";
                }
                
                
                if(!event.user) //예약가능하다.
                {                    
                    if(event.tcss.titlebackimg)div.style.backgroundImage = event.tcss.titlebackimg;
                    if(event.tcss.fontcolor)div.style.color = event.tcss.fontcolor;
                    div.style.fontWeight = "bold";
                }else if(event.user == "true"){ // 이미 예약했거나 인원이 꽉찼다.
                    if(event.status == 0){
                        var tcss = setDivType("close");                   
                        div.style.backgroundImage = tcss.titlebackimg;
                        div.style.color = tcss.fontcolor;
                        div.style.fontWeight = "normal";    
                    }else if(event.status == 1){
                        var tcss = setDivType("tranerfinish");                   
                        div.style.backgroundImage = tcss.titlebackimg;
                        div.style.color = tcss.fontcolor;
                        div.style.fontWeight = "normal";
                    }else if(event.status == 2){
                        var tcss = setDivType("userfinish");                   
                        div.style.backgroundImage = tcss.titlebackimg;
                        div.style.color = tcss.fontcolor;
                        div.style.fontWeight = "normal";
                    }
                    
                }
//                else if(event.user == "false"){ //다른사람이 이미 예약했거나 인원이 꽉찼다.
//                    var tcss = setDivType("over");                   
//                    div.style.backgroundImage = tcss.titlebackimg;
//                    div.style.color = tcss.fontcolor;
//                    div.style.fontWeight = "normal";
//                }
                
                

                //////////////////////////////////////////////////////////
                //neel change end
                //////////////////////////////////////////////////////////
                $(timeclass).append(div);
                
                    


            }
            
            function monthAddEvent(index, event) {
//                console.log("monthAddEvent ",event);
                var $event = $('<div/>', {
                        'class': 'event',
                        text: event.title,
                        title: event.title,
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
                if (!!time) {
                    if(event.tcss.timefontcolor)
                        $event.html('<strong style="color:'+ event.tcss.timefontcolor +'">' + time + '</strong> ' + $event.html());
                    else
                        $event.html('<strong>' + time + '</strong> ' + $event.html());
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
                       
                        if(event.isover < 0){
                            var tcss = setDivType("over");
                            if(event.tcss.titlebackimg)$event.css("background-image",tcss.titlebackimg);
                            if(event.tcss.fontcolor)$event.css("color",tcss.fontcolor);
                        }
                        
                        
                        if(!event.user)
                        {
                            if(event.tcss.titlebackimg)$event.css("background-image",event.tcss.titlebackimg);
                            if(event.tcss.fontcolor)$event.css("color",event.tcss.fontcolor);
                        }else if(event.user == "true"){
                             if(event.status == 0){
                                var tcss = setDivType("close");
                                if(event.tcss.titlebackimg)$event.css("background-image",tcss.titlebackimg);
                                if(event.tcss.fontcolor)$event.css("color",tcss.fontcolor);
                            }else if(event.status == 1){
                                var tcss = setDivType("tranerfinish");
                                if(event.tcss.titlebackimg)$event.css("background-image",tcss.titlebackimg);
                                if(event.tcss.fontcolor)$event.css("color",tcss.fontcolor);
                            }else if(event.status == 2){
                                var tcss = setDivType("userfinish");
                                if(event.tcss.titlebackimg)$event.css("background-image",tcss.titlebackimg);
                                if(event.tcss.fontcolor)$event.css("color",tcss.fontcolor);
                            }
                            
                        }
//                        else if(event.user == "false"){
//                            var tcss = setDivType("close");
//                            if(event.tcss.titlebackimg)$event.css("background-image",tcss.titlebackimg);
//                            if(event.tcss.fontcolor)$event.css("color",tcss.fontcolor);
//                        }
                        
                        //////////////////////////////////////////////////////////
                        //neel change end
                        //////////////////////////////////////////////////////////
                        
                        
                        
                        day.append(
                            $event.toggleClass('begin', dateclass === event.start.toDateCssClass()).toggleClass('end', dateclass === event.end.toDateCssClass())
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

//                        var title = "예약버튼"; //제목이지만 내용을 적으면 된다.
//                        var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
//                        y = 2021;
//                        m = 0; //
//                        d = 6;
//                        hh = 13;
//                        mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
//                        start = new Date(y, m, d, hh, mm);
//                        console.log("dayaddeventcall!!", options.data);
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
            if(window.mdraw)window.mdraw();
        }
        
        ;
        
        window.calendar = calendar;
        (function(defaults, $, window, document) {
            console.log("defaults ",defaults);
//            window.defaults = defaults;
            $.extend({
                
                calendar: function(options) {
                    console.log("calendar!!! 0000");
                    return $.extend(defaults, options);
                }
            }).fn.extend({
                
                calendar: function(options) {
                    options = $.extend({}, defaults, options);
                    window.options = options;
                    return $(this).each(function() {
                        var $this = $(this);
                        console.log("extends!!! 2222",$this);
                        console.log("extends!!! 2222",options);
                        
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

//    for (i = 0; i < 5; i++) {
//        j = Math.max(i % 15 - 10, 0);
//        //c and c1 jump around to provide an illusion of random data
//        c = (c * 1063) % 1061;
//        c1 = (c1 * 3329) % 3331;
//        d = (d1 + c + c1) % 839 - 440;
//        hh = i % 36;
//        mm = (i % 4) * 15;
//        if (hh < 18) {
//            hh = 0;
//            mm = 0;
//        } else {
//            hh = Math.max(hh - 24, 0) + 8;
//        }
//
//        var title = "PT"; //제목이지만 내용을 적으면 된다.
//        var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
//        y = 2021;
//        m = 0; //
//        d = 6;
//        hh = 11;
//        mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
//        start = new Date(y, m, d, hh, mm);
//        end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
//        console.log(i + ") start is " + start);
//        console.log(i + ") j:" + j + " c :" + c + " c1:" + c1 + " d:" + d + " hh:" + hh + " mm:" + mm + " start:" + start + " end:" + end)
//        console.log("!(i % 6) " + (!(i % 6)));
//
//
//        //        data.push({ title: names[c1 % names.length], start: start, end: end, allDay: !(i % 6), text: slipsum[c % slipsum.length ]  });
//        data.push({
//            title: title,
//            start: start,
//            end: end,
//            allDay: allday
//        });
//    }
    
   
//    var testdatas = ["2021-02-23","2021-02-24","2021-02-25","2021-02-26","2021-02-27","2021-02-28","2021-02-23","2021-02-24","2021-02-24","2021-02-24","2021-02-24","2021-02-24","2021-02-24","2021-02-24","2021-02-24","2021-02-24","2021-02-24"];
   
    var calendar_datas = [];
    function insertAllReservation(){
        console.log("calendar_data",calendar_data);
        //ex) var rdata = {"type":"GX","name":"리포머","date": "2021-02-21","times":[ {"time": 9,"members": ["test_uid0000", "test_uid1111"]},{"time": 10,"members": ["test_uid1111", "test_uid2222"]}]}
        console.log("calendar_data.close ",calendar_data.close);
        console.log("calendar_data.open ",calendar_data.open);
        console.log("calendar_data.ready ",calendar_data.ready);
        var datas = [];
        var close = addCalendatas(calendar_data.type,calendar_data.close, "close");
        var open = addCalendatas(calendar_data.type,calendar_data.open, "open");
        var ready = addCalendatas(calendar_data.type,calendar_data.ready, "ready");
        console.log("")
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
//                console.log("")
                dates.push(rdata);
            }
        } 
        return dates;
    }
    function insertCalenderDatas(datas){
//        console.log("reservationinfo");
        //ex) var rdata = {"type":"GX","name":"리포머","date": "2021-02-21","times":[ {"time": 9,"members": ["test_uid0000", "test_uid1111"]},{"time": 10,"members": ["test_uid1111", "test_uid2222"]}]}
        console.log("insertCalenderData ",datas);
        
//        var rnames = trim_sort_2array(datas, "name");
//        console.log("rnames ",rnames);
        for(i = 0; i < datas.length; i++) {
            for(var j =0 ; j < datas[i].times.length; j++){
                var obj = datas[i];
                var tdate = obj.date;
                var date = new Date(tdate);

                
                var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
                    y = date.getFullYear();
                    m = date.getMonth();  //
                    d = date.getDate();
                    hh = parseInt(obj.times[j].time);
                    mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                    start = new Date(y, m, d, hh, mm);
        //            end = !j ? null : new Date(y, m, d + j, hh + 2, mm);
                    end = start;
                

                
                var today = getToday(); 
                var now = getToday(start);
                var isover = get_Day(today,now);
                
                var userlen = obj.times[j].members.length;
                var isopenstr = (obj.opentype == "close") ? "클로즈됨" : "예약가능";
                
                if(obj.opentype != "close" && userlen >= obj.max) isopenstr = "정원초과";
                var tcss = setDivType("default");

                var isuser = userlen < obj.max ? "" : "true";
                var isinserted = 0;
                var user = "<?php echo $uid; ?>";
                var timeuser = null;
                for(var a =0 ; a< userlen;a++){
                    if(obj.times[j].members[a].uid == user){
                        isinserted = 1; //내가 예약했다.
                        timeuser = obj.times[j].members[a];
                        break;
                    }
                }
//                if(timeuser){
//                    //내가 예약함
//                    if(timeuser.uid == user){
//                        isuser = "true";
//                       isopenstr = "예약완료";
//                    }
//                    //다른사람이 예약함
//                    else if(timeuser.uid != user){
//                       isuser = "true";
//                       isopenstr = "다른고객이 예약함";
//                    }
//                }
//                
                if(obj.times[j].members.length > 0 && isinserted == 0)
                    isinserted = 2; //다른사람이 예약했다.
                
                if(isinserted == 1){
                    isuser = "true";
                    isopenstr = "예약완료";
                }else if(isinserted == 2){
                    isuser = "false";
                    isopenstr = "다른고객이 예약함";
                }
//                
                if(isover < 0){
                    isopenstr = "기간만료";
                    tcss = setDivType("over");
                }
                if(timeuser){
                    if(timeuser.status == 1){
                        
                        isopenstr = " - "+timeuser.note;
                    }else if(timeuser.status == 2){
                        
                        isopenstr = "운동종료 승인";
                    }
                }
                var ttt = datas[i].times;    
                var status = timeuser ? timeuser.status : 0;
                var title = get_reservation_status_text(status)+"("+userlen+"/"+obj.max+") "+obj.name+" "+isopenstr; //제목이지만 내용을 적으면 된다.
                
                //다른고객이 예약한부분은 보여주지 않는다.
                if(isuser != "false" && isover >= 0 || isuser != "false" && isover < 0 && timeuser != null){                    
                    data.push({ title: title,teachid: obj.teachid , name: obj.name ,user: isuser, status:status, opentype: obj.opentype, start: start, end: end, allDay: allday,tcss:tcss,isover:isover});
                } 
            }
            
        }
        data.sort(function(a, b) {
            return (+a.start) - (+b.start);
        });

        //data must be sorted by start date

        //Actually do everything
        $('#holder').calendar({
            data: data
        });
        window.el = $('#holder');
    }

</script>
