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
                <label style="color:gray;background-color:yellow;padding:5px;">- 이번달 현황 -</label>
                <div id='div_month_total_table' style ='height:105px;background-color:#fff7d1'>
                    
                   <table id="month_total_table" class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr align="right"  style="background-color:#eeeeee">
<!--                                <td class='textevent' style="width:50px">전체 예약인원</td>-->
                                <td class='textevent' style="width:50px">예약인원</td>
                                <td class='textevent' style="width:1px"></td>
                                <td class='textevent' style="width:50px">전체 운동예약</td>
                                <td class='textevent' style="width:50px">현재 운동예약중</td>
<!--                                <td class='textevent' style="width:50px">승인요청중</td>-->
                                <td class='textevent' style="width:1px"></td>
                                <td class='textevent' style="width:100px">운동완료</td>
                                
                            </tr>
                            
                            
                        </thead>
                        <tbody>
                            <tr align="right" >                                
<!--                                <td><text id="month_all_user" style='font-weight:bold;color:#555555'>0</text>&nbsp;명</td>-->
                                <td><text id="month_now_user" style='font-weight:bold;color:#555555'>0</text>&nbsp;명</td>
                                <td style="width:1px"></td>
                                <td><text id="month_all_reservation_count" style='font-weight:bold;color:#555555'>0</text>&nbsp;회</td>
                                <td><text id="month_now_reservation_count" style='font-weight:bold;color:blue'>0</text>&nbsp;회</td>
<!--                                <td><text id="month_now_reservation_finish_count" style='font-weight:bold;color:blue'>0</text>&nbsp;회</td>-->
                                <td style="width:1px"></td>
                                <td><text id="month_total_confirm_count" style='font-weight:bold;color:#dd0000'>0</text>&nbsp;회</td>
                                
                            </tr>
                            
                        </tbody>
                    </table>   
                </div>
                <br>
                <p align="right"><button class="btn btn-default" id="btn_teach_reservation" onclick="open_sheet()" style="background-color:#a3bDf1">전체일정오픈하기</button></p>

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
        
        
        
        var isfirst = true;
        var param_centercode = getParam("centercode");
        
        var mem_teacher_alldata = [];
        var calendar_data = null;
//        var reservationinfo = null;
        var reservationinfo = null;
        var container = document.getElementById("container");
        var data = {
            type: "teacherreservation"
            
        }
        var userinfos = null;
        
        //당겨서 새로고침
        PullToRefresh.init({
            mainElement: '#main',
            onRefresh: function() { location.reload(); }
        });

        
       if(auth < AUTH_TRANER){
           alertMsg("접근 권한이 없습니다.");
           gotohome();
       }else {
           
       
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {

                    //강사의 예약정보가 한개도 없다.
                    if (res.message == "") {
                        //               $("#end_modal").modal({ keyboard: false, backdrop: 'static' });

                        var divcenter = document.getElementById("center");
                        var br0 = document.createElement('br');
                        divcenter.appendChild(br0);
                        for (var i = 0; i < res.centers.length; i++) {
                                var center = res.centers[i];
                                var button = document.createElement('button');
                                var title = center.centername;
                                var btntxt = document.createTextNode(title);
                                button.id = i;
                                button.className = "my-button";
                                button.appendChild(btntxt);

                                button.onclick = function() {

                                   var ctr = res.centers[parseInt(this.id)];
                                   var rinfo = JSON.parse(ctr.reservationinfo)[0];
                                   mem_teacher_alldata = [{"centercode": ctr.centercode,"centername": ctr.centername,"type": rinfo.type,"open":[],"close":[],"ready":[]}];
                                   setCalendar(mem_teacher_alldata[0]);                               
                                }
                                divcenter.appendChild(button);

                                var br1 = document.createElement('br');
                                var br2 = document.createElement('br');
                                var br3 = document.createElement('br');
                                divcenter.appendChild(br1);
                                divcenter.appendChild(br2);
                                divcenter.appendChild(br3);
                        }



                        return;
                    }
                    var json_array = JSON.parse(res.message);
                    mem_teacher_alldata = json_array;

                    //            document.write(res.message);
                    var divcenter = document.getElementById("center");
                    var br0 = document.createElement('br');
                    divcenter.appendChild(br0);

                    //예약정보가 1개 있다. 지금센터코드로 생각한다.
                    if (json_array.length == 1) {
                         const json = json_array[0];
                         setCalendar(json);

                    }else if (json_array.length > 1) {
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
                        container.style.display = "none";
                        reservation_container.style.display = "block";
                    }



                } else {
                    //            alertMsg(res.message);

                    show_error_popup("ERROR", res.message, "exit");
                }

            }, function(err) {
                //        alertMsg("네트워크 에러 ");
                show_error_popup("ERROR", "네트워크 에러", "exit");
            });

        }
        function setCalendar(json){
            var container = document.getElementById("container");
            
            var users = getUsers(json);
            var data = {
                type: "getusers",
                centercode: json.centercode,
                users : JSON.stringify(users)
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    userinfos = res.message;
                    container.style.display = "none";
                    reservation_container.style.display = "block";
                    calendar_data = json;
                    initReservation(json);
                    insertAllReservation();        
                }
            },function(err){
                console.log("err ",err);
            });
            
            
        }
        
        function set_title(title) {
            document.title = title;
            //        reservation_title.innerHTML = title;
        }

        function initReservation(json) {
//            console.log("강사 일정표 ", json);
            

            var data = {
                type: "reservationinfo",
                centercode: json.centercode
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    if (res.message == "") {
                        show_error_popup("ERROR", "목록이 없습니다.", "exit");
                        return;
                    }
                    
//                    console.log("userinfos ",userinfos);
                    var json_array = JSON.parse(res.message);
                    reservationinfo = json_array[0];
                    
                }
            });
        }
        
        function setCourseReservation(jsonobj) {
            //        reservationinfo = jsonobj;
            //select 
//            console.log("기본 정보 ", jsonobj);
            var teach_name = document.getElementById("teach_name");
            var teach_maxnumber = document.getElementById("teach_maxnumber");
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
            
            
//            console.log("teach_name_value " + teach_name_value);
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

        function open_sheet() {
//            console.log("일정 오픈하기");
            var style = {
                bodycolor: "#eeeeff",
                size: {
                    width: "100%",
                    height: "100%"
                }
            };
            var body = "<div id='div_teach_reservation' background-color:#eeeeff;padding-bottom:30px'><form action='#' method='post' id='join-us' target='iframe1'><div class='form-group row'><div id=formdiv class='col-8 offset-2'><br><label class='textevent' for='teach_name'>강좌종류</label><select id='teach_name' class='form-control' onchange='teachNameClick()' name='teach_name' required></select><br><div id='teach_datas' style='display:none'><label class='textevent' for='teach_maxnumber'>시간당 인원수</label><select id='teach_maxnumber' class='form-control' onchange='teachMaxNumberClick()' name='teach_maxnumber' required></select><br><label class='textevent' for='teach_times'>운동 시간대 선택</label><select id='teach_times' class='form-control' onchange='teachTimeClick()' name='teach_times' required></select><br><div class='form-control' name='subscription_path'><span id='teach_select_times'></span></div><br><div id = 'teach_date'>오픈시작일 : <input onchange='teachdate_onchange(1)' id = 'teach_startdate' type='date' value=''/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;오픈종료일 : <input onchange='teachdate_onchange(2)' id = 'teach_enddate' type='date' value=''/></div></div></div></div></form></div>";
            
            showModalDialog(document.body, "전체 일정 오픈하기", body, "전체일정오픈하기", "취소", function() {
//                console.log("오픈하기!!!");
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
           
            var teach_maxnumber = document.getElementById("teach_maxnumber").value;
//            var teach_times = document.getElementById("teach_times");
            var teach_select_times = document.getElementById("teach_select_times");
            var times = [];
            for (var i = 0; i < teach_select_times.children.length; i++) 
                times.push(parseInt(teach_select_times.children[i].id));
//            console.log("teach_select_times is ",times);
            var startdate = document.getElementById("teach_startdate").value;
            var enddate = document.getElementById("teach_enddate").value;
            var day = get_Day(startdate , enddate);
            var value_dates = [];
        
               
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
            value.max = teach_maxnumber;
            value.teachname = teach_name;
            value.dates = value_dates;
            //value를 만들어서 서버에 보내야한다.

//            console.log("window is ",value); 
            
            
//            mergeAllData(value);
            
//            insertAllReservation();
//            if(true)return;
            

            var data = {
                //            uid : "<?php echo $uid; ?>",
                //            id : "<?php echo $id; ?>",
                type: "sendteacherreservation",
                centercode : calendar_data.centercode,
                value: JSON.stringify(value)
            };
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                var param = "?centercode="+calendar_data.centercode;
                    
                if (code == 100) {
                    refresh_page(param);
                }else{
                    alertMsg(res.message);
                    refresh_page(param);
                }
                 hideModalDialog();
            },function(err){
//                console.log("err ",err);
                 hideModalDialog();
            });
        }
//        function mergeAllData(value){
//            if(!calendar_data.ready || calendar_data.ready.length == 0){
//                calendar_data.ready = [];
//                calendar_data.ready.push(value);
//               
//            }else{
//                 var ready = calendar_data.ready;
//                var select_idx = -1;
//                for(var i = 0 ; i < ready.length; i++){
//                    if(ready[i].teachid == value.teachid){
//                        select_idx = i;
//                        var rvalue = ready[i];
//                        var idx = 0;
//                        for(var c = 0 ; c < reservationinfo.classes.length;c++){
//                            if(reservationinfo.classes[c].id == value.teachid){
//                                idx = c;
//                                break;
//                            }
//                        }
//                        rvalue.openid = reservationinfo.classes[idx].openid;
//                        rvalue.teachname = value.teachname;
//                        rvalue.max = parseInt(value.max);
//
//                        for(var j = 0 ; j < value.dates.length; j++){
//                            var isdate = false;
//                            for(var k =0; k < rvalue.dates.length; k++){    
//                                if(value.dates[j].date == rvalue.dates[k].date){
//                                    isdate = true;
//                                    rvalue.dates[k] = value.dates[j];
//                                    break;    
//                                }
//                            }
//                            if(!isdate)rvalue.dates.push(value.dates[j]);
//                        }
//                        calendar_data.ready[i] = rvalue;
//                    }
//                }
//                if(select_idx == -1){
//                    ready.push(value);
//                }
//            }
//           
////            console.log("calendar_data is ",calendar_data);
//            for(var i =0 ; i < mem_teacher_alldata.length; i++){
//                if(mem_teacher_alldata[i].centercode == calendar_data.centercode){
//                    mem_teacher_alldata[i] = calendar_data;
//                } 
//            }
////            console.log("mem_teacher_alldata is ",mem_teacher_alldata);
//        }
//        
        
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
//                                            console.log("succ!!!!");
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
            
//            if(idx_opentype != -1 && idx_date != -1 && idx_time != -1 && idx_member != -1 ){
//                //calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members[idx_member];
//                calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members.splice(idx_member,1);
//                rflg = true;
//            }
//                
//            
//            console.log("calendar_data is ",calendar_data);
//            for(var a =0 ; a < mem_teacher_alldata.length; a++){
//                if(mem_teacher_alldata[a].centercode == calendar_data.centercode){
//                    mem_teacher_alldata[a] = calendar_data;
//                } 
//            }
//            console.log("mem_teacher_alldata is ",mem_teacher_alldata);
//            return rflg;
        }
        function mergeAllData_time_update(type,rdate,rtime){
            
            var types = ["open","close","ready"];  //현재 open 은 빈값으로 사용하지 않음
            for(var a = 0 ; a < types.length; a++){
                var cdata = calendar_data[types[a]];
                for(var i = 0 ; i < cdata.length; i++){
                        for(var j =0; j < cdata[i].dates.length; j++){
                            var date = cdata[i].dates[j];
                            if(date.date == rdate){
                                for(var k = 0 ; k < date.times.length; k++){
                                    var time = date.times[k];
                                    if(time.time == rtime){
                                        if(type == "removeteachtime")calendar_data[types[a]][i].dates[j].times.splice(k,1);
                                        else calendar_data[types[a]][i].dates[j].times.push({time:rtime,members:[]});
                                        break;
                                    }
                                }
                                break;
                            }
                        }
                        break;
                    
                }
            }
            
//            if(idx_opentype != -1 && idx_date != -1 && idx_time != -1 && idx_member != -1 ){
//                //calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members[idx_member];
//                calendar_data[removeuser.opentype][idx_opentype].dates[idx_date].times[idx_time].members.splice(idx_member,1);
//                rflg = true;
//            }
//                
//            
//            console.log("calendar_data is ",calendar_data);
            for(var a =0 ; a < mem_teacher_alldata.length; a++){
                if(mem_teacher_alldata[a].centercode == calendar_data.centercode){
                    mem_teacher_alldata[a] = calendar_data;
                } 
            }
//            console.log("mem_teacher_alldata is ",mem_teacher_alldata);
//            return rflg;
        }
        
        function teachdate_onchange(type){
            teach_startdate = document.getElementById("teach_startdate");
            teach_enddate = document.getElementById("teach_enddate");
            
            if(teach_startdate.value && teach_enddate.value){
                var isover = get_Day(teach_startdate.value,teach_enddate.value);
//                console.log("isover "+isover);
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
                }            }
//            console.log("startdate "+teach_startdate.value);
//            console.log("teach_enddate "+teach_enddate.value);            
        }
        function remove_user(info,status){
            
            var obj = info.split('|');
            console.log("obj ",obj);
            var userobj = findValueinArray(userinfos,"uid",obj[2]);
            
            //운동예약상태
            if(status == 0){
                var selecttag = "<select id='teacher_reservation_status' class='form-control' >"+
                                    "<option value=''>== 상태값을 선택하세요 ==</option>"+
                                    "<option value='1'>PT종료 (고객승인요청)</option>"+
                                    "<option value='4'>횟수 차감없이 삭제하기</option>"+                                
                                "</select><br>"+            
                                "<label align = 'left' class='textevent'>내용입력</label><input id='id_finish_note' class='form-control' name='edittext_other' placeholder='기타 특이사항 입력란..' />";
                
                var message = "<br><label align = 'left' class='textevent'>"+userobj.name+" 고객 상태값 변경</label><br>"+selecttag;

                showModalDialog(document.body, "상태값 변경", message, "변경하기", "취소", function() {
                    var teacher_reservation_status = document.getElementById("teacher_reservation_status");
                    var id_finish_note = document.getElementById("id_finish_note");
                    
                    if(teacher_reservation_status.value == ''){
                        alertMsg("상태값을 선택하세요.");
                        return;
                    }
                    

                    remove_teach_user(info,obj[0],obj[1],obj[2],obj[3],parseInt(teacher_reservation_status.value),id_finish_note.value);
                }, function() {
                   hideModalDialog();
                });
    
            }
            //운동완료상태 승인요청 다시하기
            else if(status == 1){
                
                
                var message = userobj.name+" 님에게 승인요청 푸시를 보내시겠습니까?";
                
//                var messag = "<label for='id_finish_note' class='textevent'>"+userobj.name+" 님에게 승인요청 푸시를 보내시겠습니까?</label>"+
//                            "<div class='form-control' name='subscription_path'>"+
//                                "<div>"+
//                                    "<textarea id='id_finish_note' class='form-control' name='edittext_other' placeholder='기타 특이사항 입력란..' style='height:140px;'></textarea>"+
//                                "</div>"+
//                            "</div>";
                
                showModalDialog(document.body, "승인요청 다시하기", message, "보내기", "취소", function() {
                    
                    request_confirm_user(info,true);
                }, function() {
                   hideModalDialog();
                });
            }
                        
            
            //월 달력으로 이동한다.테스트
//            window.options.mode = "month";
//            console.log("window.defaults ",window.defaults);
//            console.log("window.options ",window.options);
//            window.calendar(window.el,window.options);
        }
        //승인요청 푸시 보내기
        function request_confirm_user(info,isshow){
            var obj = info.split('|');
            //담당트레이너 설정하기
                get_token_user(obj[2],function(res){
                     var token = res.message;
                     if(res.code == 100){
                         var mtitle = "운동종료";
                         var mmessage = obj[0]+" 운동이 종료되었습니다. 체크후 승인확인 버튼을 눌러주세요.(공지사항에서 확인가능합니다.)";
                         //트레이너 설정 성공하면 담당트레이너에게 푸시메세지 보내기
                         pushmessage_user(token,mtitle,mmessage,null,function(res){
                            if (res.code == 100) {
                                //푸시메세지를 보냈으면 성공팝업띄우고 종료
                                if(isshow)
                                 alertMsg("승인요청을 보냈습니다.",function(){
                                    hideModalDialog();
                                    hideModalDialog();    
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
        function remove_teach_user(info,_date ,_teachid,_user,_opentype,status,finish_note){
            
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
            
//            if(mergeAllData_remove(removeuser)){
            var data = {
                type: "removeteachuser",
                centercode: calendar_data.centercode,
                value:JSON.stringify(mem_teacher_alldata),
                removeuser:JSON.stringify(removeuser)
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    var data = res.message;
                    if(status == 4){
                        document.getElementById(info).remove();
                        remove_user_data(_date ,_teachid,_user,status);
                        mergeAllData_remove(removeuser);
                    }else {
                        update_user_result(info,_date,hh,status,data); //화면 색과 버튼을 바꾼다.
                        update_window_options_data(status,_date ,removeuser.teachid,data); // 윈도우 데이타를 함께 바꾼다.
                        request_confirm_user(info,false);
                    }
                    
//                    hideModalDialog();
                }else{
                   alertMsg(res.message,function(){
                       hideModalDialog();
                   });
                }
                
            });
        }
         //고객정보를 달력에서
        function update_window_options_data(status,_date ,_teachid,data){
            var teachname = "";
            for(var i = 0 ; i < reservationinfo.classes.length; i++){
                if(data.teachid == reservationinfo.classes[i].id){
                    teachname = reservationinfo.classes[i].name;
                    break;
                }
            }
            
            var title = "("+data.userlen+"/"+data.max+") "+teachname;
            for(var i = 0 ; i < window.options.data.length; i++){
                var event = window.options.data[i];
               
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                var date = getDateToStr(yy,mm,dd,hh);
                var teachid = event.teachid;
                var user = event.user;
                if(date == _date && teachid == _teachid){
                    title = title+" 예약완료";
                         window.options.data[i].title = title;
                         window.options.data[i].user = "true";
                         window.options.data[i].tcss = setDivType("over");
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
            
            
            
            console.log("div is ",div);
            console.log("info is ",info);
            var btntag = "";
//            document.getElementById("use_count").innerHTML = data.maxcount+"회중 "+data.usecount+"회 진행";
            if(status != 0){ //
                var tcss = setDivType("tranerfinish");
                div.style.backgroundImage = tcss.titlebackimg;
                div.style.color = tcss.fontcolor;
                
                
                var btn = document.getElementById("btn_"+info);
                btn.innerHTML = "승인요청 다시하기";
                var innerhtml = div.innerHTML;
                console.log("innerhtml is "+innerhtml);
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
        function remove_user_data(_date ,_teachid,_user){
            for(var i = 0 ; i < window.options.data.length; i++){
                var event = window.options.data[i];
               
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                var date = getDateToStr(yy,mm,dd,hh);
                var teachid = event.teachid;
                var user = event.user.uid;
                if(date == _date && teachid == _teachid && user == _user){
                    window.options.data.splice(i,1);
                    break;
                }
            }
        }
        function remove_time_data(_date){
            for(var i = 0 ; i < window.options.data.length; i++){
                var event = window.options.data[i];
               
                var yy = event.start.getFullYear();
                var mm = event.start.getMonth()+1;
                var dd = event.start.getDate();
                var hh = event.start.getHours();
                var date = getDateToStr(yy,mm,dd,hh);
                
                if(date == _date){
                    window.options.data.splice(i,1);
                    if(window.mdraw)window.mdraw();
                    break;
                }
            }  
            
        }
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
        function open_time(time){
//            console.log("000 open_time ",time);
//            time = time.replace('T',' ');
//            time = time.replace('Z','');
//            console.log("111 open_time ",time);
            
            var date = new Date(time);
//            console.log(" date is ",date);
//            console.log(" date.getHours is ",date.getHours());
            
            var teach_datas = getTeachDatas();
          
            
            var info = time+"|||ready";
            var tag = "";
            if(teach_datas.length == 1){
                info = time+"|"+teach_datas[0].teachid+"||ready";
                tag = teach_datas[0].teachname;
                showModalDialog(document.body, "("+tag+")강좌 열기", date.getHours()+"시 타임을 OPEN 하시겠습니까?", "강좌시간 오픈하기", "취소", function() {
                    update_teach_time("openteachtime",info,time,teach_datas[0].teachid);
                }, function() {
                   hideModalDialog();
                });
            }else if(teach_datas.length > 1){
//                showModalDialog(document.body, "강좌 선택", date.getHours()+"시 강좌를 OPEN 하시겠습니까?", "강좌시간 오픈하기", "취소", function() {
//                    update_teach_time("openteachtime",info,time,teachid);
//                }, function() {
//                   hideModalDialog();
//                });
            }
                
            
        }
        function remove_time(info){
           
            var obj = info.split('|');
            var date = new Date(obj[0]);
//            console.log("info ",date.getFullYear());
//            
            var hh = stringGetHour(obj[0]);
//            console.log(obj[0]+"remove time ",hh);
           
            var ampm = parseInt(hh/12) < 1 ? "오전" :"오후";
            var timestr = ampm +" "+ hh%12;
            showModalDialog(document.body, "강좌 닫기", timestr+"시 타임을 CLOSE 하시겠습니까?", "강좌시간 닫기", "취소", function() {
                update_teach_time("removeteachtime",info,obj[0],obj[1]);
            }, function() {
               hideModalDialog();
            });
        }
        function update_teach_time(type,info,_date,teachid){
            
            var date = new Date(_date);
            var hh = date.getHours() < 10 ? "0"+date.getHours() : date.getHours();
            var timedata = {};
            timedata.date = getToday(date);
            timedata.time = parseInt(hh);
            timedata.teachid = teachid;
            timedata.mbstype = reservationinfo.type;
            var data = {
                type: type,
                centercode: calendar_data.centercode,
                value:timedata
                
            }
            CallHandler("my_teacher_reservation", data, function(res) {
                var code = parseInt(res.code);

                if (code == 100) {
                    if(type == "removeteachtime"){
                        document.getElementById(info).remove();
                        remove_time_data(_date);
                        mergeAllData_time_update(type,timedata.date,timedata.time);    
                    }else{
//                        console.log("info ",info);
//                        var div = document.createElement("div");
//                        div.innerHTML = "<span style='font-size:15px;padding:10px'>"+text+"</span>";
//                        div.style.padding = event.user ? "13px":"4px";
//                        div.style.margin = "2px";
//                        div.style.height = "50px";
//                        console.log("div is ",div);
//                        var clickid = info;
//                        div.innerHTML = div.innerHTML+"<button class='btn btn-primary' style='float:right;background-color:#0000af' onclick='remove_time(\"" + clickid + "\")' >Close</button>";       
                        
                        
//                        var timeclass = '.time-' + hour + '-' + (start.getMinutes() < 30 ? '0' : '30');
//                        $(timeclass).append(div);
                        
                        insert_time_data(_date,teachid);
                        mergeAllData_time_update(type,timedata.date,timedata.time);    
                        
                    }
                    hideModalDialog();
                }else{
                   alertMsg(res.message,function(){
                       hideModalDialog();
                   });
                }
                
            });
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
      console.log("today is ",today);
      
      console.log("date is ",date);
      console.log("date  is ",date.getTime());
      
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
  console.log("thedate is ",thedate);
  
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
                                <th class="timetitle">Before 6 AM</th>
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
                            }}
                            <tr>
                                <th class="timetitle">{{: i <= 12 ? i : i - 12 }} {{: i < 12 ? "AM" : "PM"}}
                                {{ if(dday >= 0) { }}
                                &nbsp;<button class="btn btn-primary" style="background-color:#af0000" id="{{: id }}" onclick="open_time('{{: time }}')">Open</button>
                                {{ } }}
                                </th>
                                <td class="time-{{: i}}-0"></td>
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

//        console.log("width ", $(window).width());
//        console.log("height ", $(window).height());

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
//            console.log("callender call $el !! ",$el);
//            console.log("callender call options !! ",options);
                
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
//                console.log("==============================");
//                console.log("option click 222");
                var $t = $(this),
                    o = $t.data();
//                console.log("o is ", o);
//                console.log("options is ", options);
//                console.log("$t is ", $t);
                if (o.date) {
//                    console.log("o.mode is " + o.mode);
                    console.log("o.date is " + o.date);
                    
                    o.date = new Date(o.date);
                    
                    if (o.mode == undefined) o.mode = "day";
                }

                $.extend(options, o);
                draw();
                holidayCheck();

            }).on('click', '.js-cal-years', function() {
//                console.log("years click 222");
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
//                console.log(" click 3333");
                var $t = $(this),
                    o = $t.data();
                if (o.date) {
//                    console.log("o.mode is " + o.mode);
//                    console.log("o.date is " + o.date);
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
                
                var sdate = getDateToStr(yy,mm,dd,hh);//event.start.getFullYear()+"-"+(event.start.getMonth()+1)+"-"+event.start.getDate()+" 00:00:00";
                //오픈 버튼을 숨긴다.
                var btn_open_id = "open_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate()+"time"+hh;
                
                var btn = document.getElementById(btn_open_id);
                if(btn)btn.style.visibility = "hidden";
                
//                console.log("today "+getToday()+" now "+sdate+"  dday "+getDDay(sdate));
                //기간이 지나서 버튼을 안보이게 한다.
                

//                console.log("btn ",btn);
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
                
                var title = event.title;
                var text = event.title;
                
                if(event.user.uid){
                    var userobj = findValueinArray(userinfos,"uid",event.user.uid);
                    
                    if(userobj){
                        
                        var statustxt = get_reservation_status_tag(event.user.status);
                        console.log("event ",event);
                        title = userobj.name;
                        if(userobj.mbstype){
                            if(event.user.status == 2)
                                text = statustxt+userobj.name+"(고객번호:"+userobj.userid+"), 내용 : "+event.user.note; 
                            else {
                                var stime = userobj.starttime.length <= 10 ? userobj.starttime : userobj.starttime.substr(0,10);
                                var etime = userobj.endtime.length <= 10 ? userobj.endtime : userobj.endtime.substr(0,10);
                                text = statustxt+userobj.name+"(고객번호:"+userobj.userid+"), "+userobj.mbsdesc+" ￦"+userobj.mbsprice+" <br>"+userobj.mbsmaxcount+"회중 "+userobj.usecount+"회사용, 기간 : "+stime+" ~ "+etime+" ("+userobj.mbsmonth+"개월)"; 
                            }
                                
                        }else
                            text = statustxt+userobj.name+"(고객번호:"+userobj.userid+")";    
                    }                    
                }
                
                
                
                var clickid = ""+getDateToStr(yy,mm,dd,hh)+"|"+event.teachid+"|"+event.user.uid+"|"+event.opentype;
//                console.log("clickid ",clickid);
                //기본 텍스트
                var div = document.createElement("div");
                div.id = clickid;
//                console.log("text ",text);
                div.innerHTML = "<span style='font-size:15px;padding:10px'>"+text+"</span>";
                div.style.padding = event.user.uid ? "13px":"4px";
                div.style.margin = "2px";
               
                if(event.user.uid){
                     div.style.marginLeft="20px";
                }
                else {
                    
                    div.style.height = "50px";
                    //기간이 지나서 버튼을 안보이게 한다.
                    
                    
                    if(getDDay(sdate) >= 0){
                        div.innerHTML = div.innerHTML+"<button class='btn btn-primary' style='float:right;background-color:#0000af' onclick='remove_time(\"" + clickid + "\")' >Close</button>";
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
                    timeclass = '.time-22-0',
                    startint = start.toDateInt(),
                    dateint = options.date.toDateInt(),
                    endint = end.toDateInt();
                if (startint > dateint || endint < dateint) {  //타이틀부분이라면
                    return;
                }

                if (!!time) {
//                   if(event.timefontcolor)
//                        $event.html('<strong style="color:'+ event.timefontcolor +'">' + time + '</strong> ' + $event.html());
//                    else
//                        $event.html('<strong>' + time + '</strong> ' + $event.html());
                }
               
                if(event.isover >= 0  && event.user.status < 2 || event.isover < 0  && event.user.status == 0 || event.isover < 0  && event.user.status == 1){                        
                    if(event.user.uid){
                        var btn_txt = event.user.status == 0 ? "운동완료" : "승인요청 다시하기";
                        div.innerHTML = div.innerHTML+"<button id='btn_"+clickid+"' class='btn btn-primary' style='float:right;margin-top:-9px;' onclick='remove_user(\"" + clickid + "\","+event.user.status+")' >"+btn_txt+"</button>";
                    }  
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

                if(event.backgroundimage)div.style.backgroundImage = event.backgroundimage;
                if(event.fontcolor)div.style.color = event.fontcolor;

                //////////////////////////////////////////////////////////
                //neel change end
                //////////////////////////////////////////////////////////
//                console.log("div innerHTML ",div.innerHTML);
                $(timeclass).append(div);
              
                    


            }
            function checkTotalMonthData(nowdate){
                
//                var month_all_user = document.getElementById("month_all_user");
                var month_now_user = document.getElementById("month_now_user");
                var month_all_reservation_count = document.getElementById("month_all_reservation_count");
                var month_now_reservation_count = document.getElementById("month_now_reservation_count");
                //var month_now_reservation_finish_count = document.getElementById("month_now_reservation_finish_count");
                var month_now_reservation_finish_count = 0;
                var month_total_confirm_count = document.getElementById("month_total_confirm_count");
                
                console.log("nowdate ",nowdate);
//                if(now_month.yy != nowdate.getFullYear() || now_month.mm != nowdate.getMonth())
                {
//                    console.log("이번달 "+nowdate.getMonth());
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
                    
                   
                }

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
            
            var now_month = {yy:"",mm:"",month_now_user:0,month_all_reservation_count:0,month_now_reservation_count:0,month_now_reservation_finish_count:0,month_total_confirm_count:0,users:[]};
            function monthAddEvent(index, event) {
//                console.log("monthAddEvent ",event);
                e = new Date(event.start),
                dateclass = e.toDateCssClass();
                var bdata = event.bdatas;
                var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
               
                
                if(bdata && dateclass == sdate)
                {
//                    console.log("bdata ",bdata);
//                    console.log("dateclass ",dateclass);
//                    console.log("sdate ",sdate);
                    if(event.start.getMonth() == now_month.mm){
                        if(bdata.status >= 0){
                            now_month.month_all_reservation_count++;
                        }

                        if(bdata.status == 0){
                            now_month.month_now_reservation_count++;                        
                        }
                        else if(bdata.status == 1){
                            now_month.month_now_reservation_finish_count++;
                        }
                        else if(bdata.status == 2){
                            now_month.month_total_confirm_count++;
                        }
                        if(bdata.uid){
                            console.log("uid is "+bdata.uid);
                            now_month.users.push(bdata.uid)
                            now_month.users = trim_sort_1array(now_month.users);
//                            console.log("now_month.users ",trim_array(now_month.users));
                            now_month.month_now_user = now_month.users.length;
                        }
                        setTotalMonthData();
                    }
                    
                }
                
                
                var title = event.title;
                var text = event.title;
                if(event.user.uid){
                    var userobj = findValueinArray(userinfos,"uid",event.user.uid);
//                    console.log("userobj ",userobj);
                    if(userobj){
                        title = userobj.name;
                        text = userobj.name+"("+userobj.userid+")";    
                    }
                    
                }
                var $event = $('<div/>', {
                        'class': 'event',
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
                if (!!time) {
                    if(event.timefontcolor)
                        $event.html('<strong style="color:'+ event.timefontcolor +'">' + time + '</strong> ' + $event.html());
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
//                        console.log("e ",e);
//                        console.log("event.end ",event.end);
//                        console.log("event.backgroundimage ",event.backgroundimage);
                        //이부분이 날짜칸에 데이타 태그를 삽입하는부분이다.
                        if(event.backgroundimage)$event.css("background-image",event.backgroundimage);
                        if(event.fontcolor)$event.css("color",event.fontcolor);
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
//                console.log("drawCall!!");
                $el.html(t(options));
                //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
                $('.' + (new Date()).toDateCssClass()).addClass('today');
                if (options.data && options.data.length) {
                    document.getElementById("div_month_total_table").style.visibility = options.mode == "month" ? "visible" : "hidden";
                     checkTotalMonthData(options.date);
                    
                    if (options.mode === 'year') {
                        yearAddEvents(options.data, options.date.getFullYear());
                    } else if (options.mode === 'month' || options.mode === 'week') {
                        $.each(options.data, monthAddEvent);
                    } else {
                         var o = options;
                         var dday = get_Day(o.date,reservationinfo.classes[0].next_endtime);
                         if(o.mode == "day" && dday < 0){// 날짜범위보다 미래 날짜이다면
                            var mday = "open_"+o.date.getFullYear()+"_"+(o.date.getMonth()+1)+"_"+o.date.getDate();
                            for(var i = 6 ; i < 24; i++){

                                var open_btn_id = mday+"time"+i;
//                                console.log("id is "+open_btn_id);
                                var open_btn = document.getElementById(open_btn_id);
//                                console.log("open_btn ",open_btn);
                                if(open_btn)open_btn.style.display = "none";
                            }
    //                        open_2021_3_19time9
                        }

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
            window.mdraw = draw;
        }
        
        ;
        
        window.calendar = calendar;
        (function(defaults, $, window, document) {
//            console.log("defaults ",defaults);
//            window.defaults = defaults;
            $.extend({
                
                calendar: function(options) {
//                    console.log("calendar!!! 0000");
                    return $.extend(defaults, options);
                }
            }).fn.extend({
                
                calendar: function(options) {
                    options = $.extend({}, defaults, options);
                    window.options = options;
                    return $(this).each(function() {
                        var $this = $(this);
//                        console.log("extends!!! 2222",$this);
//                        console.log("extends!!! 2222",options);
                        
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
    
    function insertAllReservation(){
//        console.log("calendar_data",calendar_data);
        //ex) var rdata = {"type":"GX","name":"리포머","date": "2021-02-21","times":[ {"time": 9,"members": ["test_uid0000", "test_uid1111"]},{"time": 10,"members": ["test_uid1111", "test_uid2222"]}]}
//        console.log("calendar_data.close ",calendar_data.close);
//        console.log("calendar_data.open ",calendar_data.open);
//        console.log("calendar_data.ready ",calendar_data.ready);
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
    function insertCalenderDatas(datas){
        var alldata = [];
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
                
                
                var isopenstr = datas[i].opentype == "close" ? "클로즈됨" : "오픈됨";
                
                
//                if(datas[i].times[j].members.length == 0) //타이틀 태그
                {
                    var titlebackimg = "linear-gradient(to bottom, #eeee00 0px, #f5f500 100%)";
                    var timefontcolor = "red";
                    var fontcolor = "blue";
                    if(datas[i].opentype == "close"){
                        titlebackimg = "linear-gradient(to bottom, #aa3333 0px, #aa1111 100%)";
                        timefontcolor = "#e9e9e9";
                        fontcolor = "#e9e9e9";
                    }
                    if(isover < 0){
                        
                        isopenstr = "기간만료";
                        var tcss = setDivType("over");
                        titlebackimg = tcss.titlebackimg;
                        timefontcolor =tcss.timefontcolor;
                        fontcolor = tcss.fontcolor;
                    }
                    var title = "("+datas[i].type+")"+datas[i].name+" "+isopenstr; //제목이지만 내용을 적으면 된다.
//                    console.log("title is is ",datas[i]);
                    if(isover >= 0)
                    alldata.push({ title: title, name: datas[i].name ,teachid: datas[i].teachid, user: "", opentype: datas[i].opentype, start: start, end: end, allDay: allday,backgroundimage:titlebackimg ,timefontcolor:timefontcolor,fontcolor:fontcolor});
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
                   
                      
                    var backimg = "linear-gradient(to bottom, #18755c 0px, #38957c 100%)";
                    if(isover < 0 && datas[i].times[j].members[k].status && datas[i].times[j].members[k].status == 0)
                        backimg = "linear-gradient(to bottom, #d8d8d8 0px, #e9e9e9 100%)";
                    //운동완료상태
                    if(datas[i].times[j].members[k].status && datas[i].times[j].members[k].status == 1){
                        var tcss = setDivType("tranerfinish");
                        backimg = tcss.titlebackimg;
                        fontcolor = tcss.fontcolor;
                    }
                    //고객 승인상태
                    else if(datas[i].times[j].members[k].status && datas[i].times[j].members[k].status == 2){
                        var tcss = setDivType("userfinish");
                        backimg = tcss.titlebackimg;                        
                        fontcolor = tcss.fontcolor;
                    }
                     
                    var b_date = new Date(y, m, d);
                    var b_uid = title.uid;
                    var b_status = title.status;
                    var b_datas =   {"date":b_date,"uid":b_uid,"status":b_status};
                    alldata.push({ title: title, teachid: datas[i].teachid , user: datas[i].times[j].members[k], opentype: datas[i].opentype,  start: start, end: end, allDay: allday,backgroundimage:backimg ,isover:isover,fontcolor:fontcolor, bdatas:b_datas});
                }
                
            }
            
        }
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

</script>
