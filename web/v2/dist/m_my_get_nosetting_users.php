<?php
include('./common.php'); 

//$uid = isset($_POST['uid']) ? $_POST['uid'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$id = isset($_POST['id']) ? $_POST['id'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$type = isset($_POST['type']) ? $_POST['type'] : '';

//$uid = "black_0000_test_name_2021-01-22 16:48:51";
//$uid = "test_uid0000";
//$id = "0000";
$type = "membership";

?>
<!DOCTYPE html> 
<html lang="ko">
<head>
<title>PT 미설정 고객들</title>

<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
<script>
//    
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
    <link rel="stylesheet" href="./css/layout.css"/>
    <link rel="stylesheet" href="./css/sub.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <link href="./css/modaldialog.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
    <script src="js/scripts.js?ver3.02aa3"></script>
    <style>
         @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
        @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}
    
         body {
            font-family: 'Noto Sans KR', sans-serif;
/*             font-family:  : "Noto";*/
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
        
       

        .center {
          margin: 0;
          position: absolute;
          top: 50%;
          left: 50%;
          -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);

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
            width: 100%;
        }
        
        
        table#tb_allmyusers thead { position: sticky; top: 0; }
        table#tb_allmyusers th:first-child,
        table#tb_allmyusers td:first-child { position: sticky; left: 0; }
        
        
          
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
        
</style>
    
    
    </head>

<body style="background-color:#111111;" >

<!--

    
-->
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <!--헤더부분 -->
    <div align="center" style="width:100%;height:120px;position:fixed;z-index:999;background-color:#111111;">

        <text style="color:white;text-align:center;font-size:20px;height:100%;line-height:60px;">회원정보보기</text>
        <!--X button-->
        <div onclick='call_app()' style='float:left;width:60px;height:60px;'><img src='./img/button_back_sub.png' style='float:left;margin-left:20px;margin-top:20px;width:9px;height:18px;'/></div>
        <div style='float:right;width:60px;height:60px;margin-right:7px'><img src='./img/button_reload.png' width='31px' height='30px'style="margin-top:15px;display:none"/></div>
        
        <!--탭-->
        <div id= "tab_container" style='padding-left:20px;padding-right:20px;background-color:#191919'>	
            <header>
                <table style='width:100%;height:60px;'>
                   
                        <tr>
                            <td onclick="tab_click(1)"  style='width:50%;' align="center"><text id='left_title' style='font-weight:bold;color:white;font-family:Noto Sans KR'>유료회원</text>
                            </td>
                            <td onclick="tab_click(2)" style='width:50%;' align="center"><text id='right_title'  style='color:#afafaf;font-family:Noto Sans KR'>무료회원</text>
                            </td>   
                        </tr>
                        <tr>
                            <td>
                                <div id='left_line' style='width:100%;height:2px;background-color:#fffd00'></div>
                            </td>
                            <td>
                                <div id='right_line' style='width:100%;height:2px;background-color:#afafaf'></div>
                            </td>
                        </tr>
                    
                </table>
            </header>
        </div>
    </div>
    <br>
    <!--탭포함 전전체-->
<!--    <div style="background-color:#191919">-->
        
        <!--내용-->
        <div id='dsaf' style="margin-top:130px" style="width:100%;height:100%;">

            <!--유료회원탭 내용-->
            <div id= "container_paidusers"  style="float:left;width:100%;position:absolute;background-color:#111111;" >
                <table id= "tb_allmyusers" style='width:100%;'></table>
            </div>
            <!--무료회원탭 내용-->
            <div id= "container_freeusers" style="float:left;width:100%;position:absolute;display:none;padding-left:15px;padding-right:15px" >
            </div>

        </div>
<!--    </div>-->
    </body>
</html>
<script>
    var istype = "paidmember";
    clog("osett");
    var nosetting_users = [];
    var before_index = -1;
    var zoom = setZoom();
    var my_payroll_users = [];
     $( document ).ready(function() {
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.type = "<?php echo $type; ?>";
            
          
            var status_text = ["","전화","문자","연락안됨","예약됨","종료","직접입력"];
            CallHandler("my_nosetting_users", obj, function(res) {
                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {
                                       
                    var container_freeusers = document.getElementById("container_freeusers");
                    if(res.payrollusers)my_payroll_users = res.payrollusers;
                    if(res.message.length == 0){
                        alertMsg("고객정보가 없습니다.");
                        return;
                    }
                    
                    for(var a = 0; a < res.message.length; a++){
                        
						
                        var nosetting_users = res.message[a].nosettingusers;
                        var myall_users = res.message[a].myallusers;
   
                        var centercode = res.message[a]["centercode"];
                        
                        nosetting_users.sort(sort_by('mem_username', false, (a) => a.toUpperCase()));
                        ////////////////////////////////////////////////
                        //트레이너 미설정 고객
                        ////////////////////////////////////////////////
                        var cnt = 0;
                        
                        //nosetting_users = sortNoSettingUsersByRegistDate(centercode,nosetting_users);
                        
                        for(var i = 0 ; i < nosetting_users.length; i++){
                            
                            var user =  nosetting_users[i];
							var isfreeuserend = isFreeUserEnd(user);
							if(isfreeuserend)continue;
							
                            //var color = cnt%2 == 0 ? "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);": "background-image: linear-gradient(#fff7d1 0px, #fff1b0 100%);";
                            var bg  = "background-image:url(./img/box_button_mainmenu.png)";
                            var uidiv = document.createElement("div");

                            var user_reservations = user["mem_reservation"] ? JSON.parse(user["mem_reservation"]) : [];
                            var user_reservation = null;
                            clog("user ",user.mem_username);
                            var isfreeuser = false;
                            for(var k =  0 ; k < user_reservations.length; k++){
//                                clog("user reservation ",user_reservations[k]);
                                if(!user_reservations[k]["isdelete"] || user_reservations[k]["isdelete"] && user_reservations[k]["isdelete"] == "N")
                                if(user_reservations[k]["mbsusecentercode"] == centercode && !isUserStatusFinish(user_reservations[k]["userstatus"]) && getDDay(user_reservations[k]["endtime"]) > 0){  //현재는 빈값이나 나중에 시간이 들어갈 수 도 있다.
                                    user_reservation = user_reservations[k];
                                    if(user_reservation.mbsname.indexOf("무료") >= 0)
                                        isfreeuser = true;
                                    break;
                                }
                            }

                            //무료회원만 삽입한다.
                            if(!isfreeuser)continue;

                            uidiv.innerHTML = "<div style='margin-top:-4px'><span style='margin-left:5px;color:white;font-weight:bold'>&#183;</span><text style='color:"+mColor.Cafafaf+";font-size:15px'>&nbsp;&nbsp;운동권:&nbsp;</text><text style='color:white;font-size:15px'>"+user_reservation.mbsname+"</text></div>";
                            uidiv.innerHTML += "<div style='margin-top:-4px'><span style='margin-left:5px;color:white;font-weight:bold'>&#183;</span><text style='color:"+mColor.Cafafaf+";font-size:15px'>&nbsp;&nbsp;전화번호:&nbsp;</text><text style=' text-decoration:underline;color:#fffd00;font-size:15px' onclick='userPhoneCall(\""+user["mem_username"]+"\",\""+user["mem_phone"]+"\")'>"+user["mem_phone"]+"</text></div>";
                            uidiv.innerHTML += "<div style='margin-top:-4px'><span style='margin-left:5px;color:white;font-weight:bold'>&#183;</span><text style='color:"+mColor.Cafafaf+";font-size:15px'>&nbsp;&nbsp;오전/오후:&nbsp;</text><text style='color:white;font-size:15px'>"+user_reservation["counttypeampm"]+"</text></div>"; 
                            uidiv.innerHTML += "<div style='margin-top:-4px'><span style='margin-left:5px;color:white;font-weight:bold'>&#183;</span><text style='color:"+mColor.Cafafaf+";font-size:15px'>&nbsp;&nbsp;연락상황:&nbsp;</text></div>";


                            if(user_reservation["userstatus"]){  //전환 , 문자 , 연락안됨등등
                                var len = user_reservation["userstatus"].length;
                                for(var k =  0 ; k < len; k++){
                                    var userstatus = user_reservation["userstatus"][k];
                                    var status_idx = parseInt(userstatus["status"]);
                                    var finishnote = userstatus["finishnote"] ? userstatus["finishnote"]  : "";
                                    var time = userstatus["time"].substr(0,userstatus["time"].length-3);
                                    if(status_idx == 6) //직접입력이면 내용만 표기한다.
                                        uidiv.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;<text style='color:white;font-size:12px;'>"+(k+1)+") "+finishnote+"</text><span style='float:right'><text style='color:white;margin-left:60px;margin-top:10px;font-size:12px;color:white;'>"+time+"</text></span><br>"
                                    else 
                                        uidiv.innerHTML += "&nbsp;&nbsp;&nbsp;&nbsp;<text style='color:white;font-size:12px;'>"+(k+1)+") "+status_text[status_idx]+"["+finishnote+"]</text><span style='float:right'><text style='color:white;margin-left:60px;margin-top:10px;font-size:12px;color:white;'>"+time+"</text></span><br>"
                                }    
                            }

                            var couponid = user_reservation.id;
                            var status_tag = "<select id ='setstatus_"+i+"' onchange='insert_status("+i+", \""+user["mem_uid"]+"\", \""+centercode+"\", \""+couponid+"\",)' style='float:right;width:110px;font-size::14px;padding:10px;background-color:"+mColor.C191919+";border-radius:7px;color:"+mColor.Cafafaf+";border:1px solid #292929;margin-top:8px;margin-right:4px;'><option value =''>상태입력</option><option value ='6'>"+status_text[6]+"</option><option value ='1'>"+status_text[1]+"</option><option value ='2'>"+status_text[2]+"</option><option value ='3'>"+status_text[3]+"</option><option value ='4'>"+status_text[4]+"</option><option value ='5'>"+status_text[5]+"</option></select>";

                            var endtime = user_reservation["endtime"].substring(0,10);

                            container_freeusers.innerHTML+= 
                               //헤더부분 
                               "<div class='form-control'  style='width:100%;height:80px;"+bg+";background-color:#00000000;border:0px;background-size:100% 100%;padding-left:'>"+
                               "<span><text align='left' onclick='mlistClick("+i+")'  style='position:absolute;font-size:17px;color:white;padding-top:7px;padding-left:20px;padding-bottom:10px;padding-right:90px;'>"+user["mem_username"]+"<text><br><img src='./img/icon_newcalendar.png' style='width:15px;height:15px'/><text class='fmont' style='color:white;font-size:14px;font-weight:400'> "+endtime+"</text></span>"+status_tag+"</div>"+                    
                               //펼쳤을때 보이는 부분
                            "<ul class='sub"+i+"' style='display:none;'><div style='width:100%;height:224px;background-image:url(./img/box_membership_detail.png);background-size:100% 100%;padding:20px'>"+uidiv.innerHTML+"</div></ul><div>";  
                            cnt++;
                        }



                        ////////////////////////////////////////////////
                        //전체 회원
                        ////////////////////////////////////////////////

                          
//                        for(var i = 0 ; i < myall_users.length; i++)
//                            insertAllUserTable(myall_users[i]);    
//                            insertPaidUserTable(myall_users[i]);    

                        insertPaidUserTable(myall_users);
                    }
                }else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
     });
    function sortNoSettingUsersByRegistDate(centercode,nosetting_users){
        var nosetting_arr = [];
        for(var i = 0 ; i < nosetting_users.length; i++){

            var user =  nosetting_users[i];
         
            var user_reservations = user["mem_reservation"] ? JSON.parse(user["mem_reservation"]) : [];
            var user_reservation = null;
            clog("user ",user.mem_username);
            var rid = -1;
            for(var k =  0 ; k < user_reservations.length; k++){
                clog("user reservation ",user_reservations[k]);
                if(!user_reservations[k]["isdelete"] || user_reservations[k]["isdelete"] && user_reservations[k]["isdelete"] == "N")
                if(user_reservations[k]["mbsusecentercode"] == centercode && !isUserStatusFinish(user_reservations[k]["userstatus"]) && getDDay(user_reservations[k]["endtime"]) > 0){  //현재는 빈값이나 나중에 시간이 들어갈 수 도 있다.
                    user_reservation = user_reservations[k];
                    if(user_reservation.mbsname.indexOf("무료") >= 0)
                        rid = k;
                    break;
                }
            }

            //무료회원만 삽입한다.
            if(rid == -1)continue;
            
            nosetting_arr.push({"user":user,"couponid":user_reservations[rid]["id"]});
        }
        
        nosetting_arr.sort(sort_by('couponid', true, (a) => a.toUpperCase()));
        
        var newusers = [];
        for(var i = 0 ; i < nosetting_arr.length; i++)
            newusers.push(nosetting_arr[i].user);
        
        return newusers;

    }
    function insertPaidUserTable(rows){
    
        var table = document.getElementById("tb_allmyusers");
        table.style.display = rows.length > 0 ? "block" : "none";
        table.style.overflow = "auto";
        table.style.marginLeft = "-1px";
        table.style.marginRight = "-1px";
        table.className = "fsans";
        
        
        var screen_height = $(window).height();
        table.style.height = (screen_height/zoom-160)+"px";
         clog("screen_height "+screen_height+" zoom "+zoom+ " screen_height/zoom "+(screen_height/zoom) );
        
        table.style.textAlign = "center";
        table.innerHTML = "<tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        
        var len = rows.length;
        rows.sort(sort_by('couponid', true, (a) => a.toUpperCase()));
//        clog("rows ",rows);
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            for (var i = 0; i < len; i++) {
                 //table data
                //couponid: "2021-08-12 18:47:54"
                //date: "2021-08-12"
                //endtime: "2021-11-11"
                //mbsdesc: "PT 2회 무료 운동권"
                //mbsmaxcount: "2"
                //mbstype: "PT"
                //name: "장하늘"
                //ornerstatus: "1"
                //starttime: "2021-08-12"
                //uid: "JVTEnJJUMenB6dfoXq5D_2021-08-12"
                //usecount: 1
                //userid: "100211"
                
                var uid = rows[i]["uid"];                   //uid
                var name = rows[i]["name"];                 //name
                var userid = rows[i]["userid"];             //userid
                var phone = rows[i]["phone"];               //전화번호
                var couponid = rows[i]["couponid"];         //couponid
                var mbsprice = rows[i]["mbsprice"];           //가격
                var mbsmonth = rows[i]["mbsmonth"] ? rows[i]["mbsmonth"] : 0;           //개월수
                //var mbsdesc = rows[i]["mbsdesc"];           //설명 이상해서 사용하지 않음 tb_membership -> mbs_desc 설명부분 가져옴
                var mbsdesc = rows[i]["mbsdesc"];           //설명
                
                //이번달 페이롤 회원이 아니면 보여주지 않는다.
                if(!isPayrollUser(my_payroll_users,uid,couponid))continue;
                
                var mbsmaxcount = getMbsMaxCount(rows[i]);   //최대횟수
                var mbstype = rows[i]["mbstype"];           //PT or GX
                var starttime = rows[i]["starttime"];       //시작시간
                var endtime = rows[i]["endtime"];           //종료시간
                var ornerstatus = rows[i]["ornerstatus"];   //상태값
                var usecount = rows[i]["usecount"];         //사용한횟수
                var remaincount = mbsmaxcount -usecount;
                if(parseInt(mbsprice) > 0){
                    mbsdesc = mbstype == "PT" || mbstype == "GX" ? mbstype+" "+mbsmaxcount+"회 이용권" : "헬스 "+mbsmonth+"개월";
                    var brow = body.insertRow();
                    
                    var uid = rows[i]["uid"];


                    insertMyuserCell(brow,85,"<text style='color:white;font-size:13px'>"+name+"["+userid+"]</text>",true);
                    insertMyuserCell(brow,110,"<text style='text-decoration:underline;color:#fffd00;font-size:13px' class='fmont' onclick='userPhoneCall(\""+name+"\",\""+phone+"\")'>"+phone+"</text>");
                    insertMyuserCell(brow,120,"<text style='color:white;font-size:13px'>"+mbsdesc+" ["+mbsmaxcount+"/"+remaincount+"]</text>");
                    insertMyuserCell(brow,85,mbsprice > 0 ? "<text class='fmont'>"+"￦"+CommaString(mbsprice)+"</text>" : "-");
                    insertMyuserCell(brow,100,"<text style='color:white;font-size:13px' class='fmont'>"+starttime+"</text>");
                    insertMyuserCell(brow,100,"<text style='color:white;font-size:13px' class='fmont'>"+endtime+"</text>");
                }
            }
        }
        var thead_style = "background-color:"+mColor.C222222+";border-right:1px solid "+mColor.C2e2e2e;
       table.innerHTML += "<thead><tr style='background-color:"+mColor.C222222+";height:37px;color:white;font-size:13px'><th style='"+thead_style+"'>이름</th><th style='"+thead_style+"'>전화번호</th><th style='"+thead_style+"'>회원권</th><th style='"+thead_style+"'>가격</th><th style='"+thead_style+"'>시작일</th><th style='"+thead_style+"'>종료일</th></tr></thead>";
        table.style.backgroundColor = "#111111";
        
    }
    function userPhoneCall(name,phone){
        showModalDialog(document.body, "전화걸기",name+"회원에게 전화를 하시겠습니까?", "전화하기", "취소", function() {
                     call_app("phoneCall",phone);
                     hideModalDialog();
                }, function() {
                   
                    hideModalDialog();
                });
       
    }
    
//    function insertAllUserTable(rows){
//        var table = document.getElementById("tb_allmyusers");
//        table.style.display = rows.length > 0 ? "block" : "none";
////        table.style.margin = "5px";
//        table.style.textAlign = "center";
//        table.innerHTML = "<thead><tr style='border:1px solid #487be1;background-color:#f8f9d1;position:fixed'><th style='width:100px'>이름</th><th>전화번호</th><th style='width:100%'>회원권</th><th>가격</th><th>시작일</th> <th>종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
//        var head = table.getElementsByTagName("thead")[0];
//        var body = table.getElementsByTagName("tbody")[0];
//        var foot = table.getElementsByTagName("tfoot")[0];
//        
//        var len = rows.length;
//        
////        clog("rows ",rows);
//        if (len > 0) {
////            for(var j = 0 ; j < 100 ; j++)//test
//            for (var i = 0; i < len; i++) {
//                
//                
//                var uid = rows[i]["uid"];                   //uid
//                var name = rows[i]["name"];                 //name
//                var userid = rows[i]["userid"];             //userid
//                var phone = rows[i]["phone"];               //전화번호
//                var couponid = rows[i]["couponid"];         //couponid
//                var mbsprice = rows[i]["mbsprice"];           //가격
//                var mbsmonth = rows[i]["mbsmonth"] ? rows[i]["mbsmonth"] : 0;           //개월수
//                //var mbsdesc = rows[i]["mbsdesc"];           //설명 이상해서 사용하지 않음 tb_membership -> mbs_desc 설명부분 가져옴
//                var mbsdesc = rows[i]["mbsdesc"];           //설명
//               
//                var mbsmaxcount = rows[i]["mbsmaxcount"];   //최대횟수
//                var mbstype = rows[i]["mbstype"];           //PT or GX
//                var starttime = rows[i]["starttime"];       //시작시간
//                var endtime = rows[i]["endtime"];           //종료시간
//                var ornerstatus = rows[i]["ornerstatus"];   //상태값
//                var usecount = rows[i]["usecount"];         //사용한횟수
//               
//                
//                 mbsdesc = mbstype == "PT" || mbstype == "GX" ? mbstype+" "+mbsmaxcount+"회 이용권" : "헬스 "+mbsmonth+"개월";
//                
//                
//                
////                var using_coupons = getCoupons(rows[i],"using");
//                var brow = body.insertRow();
//                var uid = rows[i]["uid"];
//                
//                
//                insertMyuserCell(brow,85,name+"["+userid+"]",true);
//                insertMyuserCell(brow,110,phone);
//                insertMyuserCell(brow,120,mbsdesc+" ["+mbsmaxcount+"/"+usecount+"]");
//                insertMyuserCell(brow,85,mbsprice > 0 ? "￦"+CommaString(mbsprice) : "-");
//                insertMyuserCell(brow,100,starttime);
//                insertMyuserCell(brow,100,endtime);
//                 
//                
////                var bcell_name = brow.insertCell();
////                bcell_name.innerHTML = name+"["+userid+"]";
////
////                
////                var bcell_phone = brow.insertCell();
////                bcell_phone.innerHTML = phone;
////
////
////                var bcell_membership = brow.insertCell();
////                bcell_membership.innerHTML = mbsdesc+" ["+mbsmaxcount+"/"+usecount+"]";
////
////                var bcell_membership_price = brow.insertCell();
////                bcell_membership_price.innerHTML = mbsprice > 0 ? "￦"+CommaString(mbsprice) : "-";
////
////                var bcell_starttime = brow.insertCell();
////                bcell_starttime.innerHTML = starttime;
////
////                var bcell_endtime = brow.insertCell();
////                bcell_endtime.innerHTML = endtime;
//
//                
//            }
//        }
//       
//    }
//    
    function insertMyuserCell(brow,width,tag,isfixed){
        
        var cell = brow.insertCell();
        cell.style.border = "1px solid "+mColor.C292929;
        
        cell.style.padding = "5px";
        cell.style.color = "white";
        cell.style.backgroundColor = mColor.C111111;
        cell.style.minWidth = width+"px";
        
        if(isfixed){
           
//            cell.style.borderRight = "1px solid "+mColor.C292929;
        }
        cell.innerHTML = tag;
    }
    function isUserStatusFinish(userstatus){
        isfinish = false;
        for(var i = 0 ; i < userstatus.length; i++){
            var status = parseInt(userstatus[i].status);
            if(status == 100 || status == 101){
                isfinish = true;
                break;
            }
        }
        return isfinish;
    }
     function insert_status(idx,useruid,centercode,couponid){
        clog("idx is "+idx);
        var user_status = document.getElementById("setstatus_"+idx);
        if(user_status.value){
            var text = user_status.options[user_status.selectedIndex].text;
            var status_value = user_status.value;
            clog("status_value is "+status_value);
            if(user_status.selectedIndex == 6){
                showModalDialog(document.body, "연락상황 추가","연락 상태값 ("+text+")를 추가하시겠습니까?<br><br><text style='width:100%;padding:5px'>*종료내용 입력</text><input id='id_finish_note' type='text' style='border-radius:6px;width:80%;height:40px'><br>", "추가하기", "취소", function() {
                    var id_finish_note = document.getElementById("id_finish_note").value;
                    if(!id_finish_note){
                        alertMsg("내용을 입력해 주세요.");
                    }else 
                        insert_userstatus(useruid,status_value,centercode,couponid,id_finish_note);
                }, function() {
                   hideModalDialog();
                });        
            }
            else if(user_status.selectedIndex == 1){
                showModalDialog(document.body, "연락상황 직접입력","<text style='width:100%;padding:5px'>*내용 입력</text><input id='id_finish_note' type='text' style='border-radius:6px;width:80%;height:40px'><br>", "추가하기", "취소", function() {
                    var id_finish_note = document.getElementById("id_finish_note").value;
                    if(!id_finish_note){
                        alertMsg("내용을 입력해 주세요.");
                    }else 
                        insert_userstatus(useruid,status_value,centercode,couponid,id_finish_note);
                }, function() {
                   hideModalDialog();
                });        
            }else{
                showModalDialog(document.body, "연락상황 추가","연락 상태값 ("+text+")를 추가하시겠습니까?", "추가하기", "취소", function() {
                    insert_userstatus(useruid,status_value,centercode,couponid,"");
                }, function() {
                   hideModalDialog();
                });
            }
            
        }
        
    }
    function insert_userstatus(uid,status,centercode,couponid,finish_note){
        
            var value = {};
            value.uid = uid;
            value.status = status;
            value.finishnote = finish_note;
            value.couponid = couponid;
            
            var data = {
               type: "insertuserstatus",
               centercode : centercode,
               value: JSON.stringify(value)
            };
            CallHandler("insert_user_status", data, function(res) {
                var code = parseInt(res.code);
                if(code == 100){
                    showModalDialog(document.body, "상태추가 성공","연락 상태값을 추가하였습니다.", "확인", null, function() {
                        refresh_page();
                    });
                    
                }
            },function(err){
                alertMsg("네트워크 에러 ");
            });

    }
    function mlistClick(index){
        
        if(before_index != index && before_index != -1){
            if($(".sub"+before_index).is(":visible")){
                $(".sub"+before_index).slideUp(100);
            }           
        }
        
        if($(".sub"+index).is(":visible")){
            $(".sub"+index).slideUp(100);
            before_index = -1;
        }
        else{
            $(".sub"+index).slideDown(150);
            before_index = index;
        }
    }
//   function tab_click(idx){
//       var container_paidusers = document.getElementById("container_paidusers");
//       var container_freeusers = document.getElementById("container_freeusers");
//       var tab1 = document.getElementById("tab1");
//       var tab2 = document.getElementById("tab2");
//        if(idx == 1){
//            istype = "paidmember";
//            container_paidusers.style.display = "block";
//            container_freeusers.style.display = "none";
//            tab1.style.color="black";
//            tab2.style.color="darkgray";
//        }else{
//            
//            istype = "freemember";
//            container_paidusers.style.display = "none";
//            container_freeusers.style.display = "block";
//            tab1.style.color="darkgray";
//            tab2.style.color="black";
//        }
//    }
     
    function tab_click(idx){
        
        var left_title = document.getElementById("left_title");
        var left_line = document.getElementById("left_line");
        var left_main = document.getElementById("container_paidusers");
        
        var right_title = document.getElementById("right_title");
        var right_line = document.getElementById("right_line");
        var right_main = document.getElementById("container_freeusers");
        
        if(idx == 1){
            left_title.style.color = "white";
            left_title.style.fontWeight = "bold";
            left_line.style.backgroundColor = "#fffd00";
            left_main.style.display ="block";
            
            right_title.style.color = "#afafaf";
            right_title.style.fontWeight = "normal";
            right_line.style.backgroundColor = "#afafaf";
            right_main.style.display ="none";
            
        }else{
            right_title.style.color = "white";
            right_title.style.fontWeight = "bold";
            right_line.style.backgroundColor = "#fffd00";
            right_main.style.display ="block";
            
            left_title.style.color = "#afafaf";
            left_title.style.fontWeight = "normal";
            left_line.style.backgroundColor = "#afafaf";
            left_main.style.display ="none";
        }
    }
</script>




