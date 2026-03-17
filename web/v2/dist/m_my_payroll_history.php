<?php
include('./common.php'); 


?>
<!DOCTYPE html> 
<html lang="ko">
<head>
<title>내정보 보기</title>

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
    
<script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
<script src="js/scripts.js?ver3.02a1"></script>
    
    
    
    
    
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
            width:100%;
        }
        
        table.tb_payroll thead { position: sticky; top: 0; }
        table.tb_payroll th:first-child,
        table.tb_payroll td:first-child { position: sticky; left: -1; }
        
         
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
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <div id='div_center_list' style='position:absolute;display:none;width:100%;height:50px;margin-bottom:50px'>
        <div align="center" style="width:100%;height:60px;position:fixed;z-index:999;background-color:#111111;">
            <text style="color:white;text-align:center;font-size:20px;height:100%;line-height:60px;">페이롤 정보</text>
            <div onclick='call_app()' style='float:left;width:60px;height:60px;'><img src='./img/button_back_sub.png' style='float:left;margin-left:20px;margin-top:20px;width:9px;height:18px;'/></div>
            <div style='float:right;width:60px;height:60px;margin-right:7px'><img src='./img/button_reload.png' width='31px' height='30px'style="margin-top:15px;display:none"/></div>
        </div>
        <div id='div_clist' align="center" style="width:100%;height:100%;margin-top:60px;" >
           
        </div>
    </div>
    <div id='div_main_payroll' style='display:none;'>
           <!--헤더부분 -->
        <div id='div_header' align="center" style="width:100%;height:120px;position:fixed;z-index:999;background-color:#111111;">

            <text style="color:white;text-align:center;font-size:20px;height:100%;line-height:60px;">페이롤 정보</text>
            <!--X button-->
            <div onclick='call_app()' style='float:left;width:60px;height:60px;'><img src='./img/button_back_sub.png' style='float:left;margin-left:20px;margin-top:20px;width:9px;height:18px;'/></div>
            <div style='float:right;width:60px;height:60px;margin-right:7px'><img src='./img/button_reload.png' width='31px' height='30px'style="margin-top:15px;display:none"/></div>

            <!--좌우 년월 -->
            <div align="center" style="height:60px;border-top:1px solid #292929" >
                <div align='center'  onclick = "arrowClick(0)"/ style='width:50px;height:50px;float:left'><img src ='./img/button_prev_month.png' style='margin-top:15px;width:30px;height:30px;opacity:0.6'/></div>
                <div align='center'  onclick = "arrowClick(1)"/ style='width:50px;height:50px;float:right'><img src ='./img/button_next_month.png' style='margin-top:15px;width:30px;height:30px;opacity:0.6'/></div>
                <text style="text-align:center;font-size:17px;color:#ffffff;margin-top:15px;height:100%;line-height:50px;" id ="txt_title">Payroll Data</text>
                
            </div>
            <!--전체열기 전체 닫기-->
            <div id='div_allopenclose' align="center" style='background-color:#111111;padding-bottom:10px;margin-top:-20px' >
                <button id='btn_allopen' class='btn' onclick='allOpen()' style='border-radius:5px;font-size:10px;color:#191919;background-color:#fffd00;padding-left:10px;padding-right:10px;padding-top:2px;padding-bottom:2px;'>전체오픈</button>
                 <button id='btn_allclose' class='btn' onclick='allClose()' style='border-radius:5px;font-size:10px;color:#191919;background-color:#fffd00;padding-left:10px;padding-right:10px;padding-top:2px;padding-bottom:2px;display:none'>전체닫기</button>
            </div>
           
        </div>

        <div id="div_main" style="width:100%;height:100%;padding-top:120px;background-color:#191919;">
             <!--트레이너 1명일때만 이 div가 보여짐 -->
             <div id = "div_title_desc" align='left' style='width:100%;background-color:#191919;height:auto;padding-top:-5px'>

            </div>    

            <div id = "container" style="background-color:#191919">

            </div>
            <div id = "id_nodata">
                <br>
                <p align = "center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></p>
            </div>
        </div>

    </div>
    
 
    
    
</body>
</html>



<script>
    

    var zoom = setZoom();
    
    var payroll_history = [];
    var status_isdelete_arr = [];
    var before_index = -1;
    var payroll_setting = null;
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var now_groupcode = "<?php echo $groupcode ;?>";
    var now_centercode = null;
    var now_centername = null;
    var openlist = [];
    var alllist = [];
    var setpayrolldata = {};
    
    var center_setting = {};
    var gxdatas = []; //이번달 GX강좌들을 모두 불러온다.
    var ptgx_tab_index = 0;
    var missing_gx_teacherlist = [];
    $( document ).ready(function() {
        
         
         var div_center_list = document.getElementById("div_center_list");
         var div_clist = document.getElementById("div_clist");
         var div_main_payroll = document.getElementById("div_main_payroll");
            var div_main = document.getElementById("div_main");
            var centercodes = "<?php echo $centercodes ;?>";
           
            param_year = parseInt(getToday().substr(0,4));
          
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
                        now_centercode = centers[0].centercode;
                        now_centername = centers[0].centername;
                        div_center_list.style.display = "none";
                        div_main_payroll.style.display = "block";
                        getMyTranerHistory(now_centercode,year,month);
                    }else if(len > 1){
                         div_center_list.style.display = "block";
                       
//                        div_center_list.innerHTML = "<div class='textevent' style='width:100%;height:50px;margin-bottom:50px'><h5 align='center'  style='padding:10px'>페이롤 현황</h5><div>";
                        
                       
                         for(var i = 0 ; i < len; i++){                          
                            now_centercode = centers[i].centercode;
                            now_centername = centers[i].centername;
                              div_clist.innerHTML += "<div style='padding:10px' align='center'><div onclick='clickCenter(\""+now_centercode+"\")' style='width:100%;height:90px;background-image:url(./img/box_my_payroll.png);background-color:#00000000;border:0px;background-size:100% 100%;'><text style='text-align:center;line-height:90px;color:white;font-size:23px'>"+now_centername+"</text></div></div>";
//                            div_clist.innerHTML += "<button class='btn btn-primary btn-raised' onclick='clickCenter(\""+now_centercode+"\")' style='margin:10px;background-color:#116666;padding:20px' >"+now_centername+"</button><br>";
                         }
                       
                    }
                } else {
                      alertMsg("센터정보를 가져오는데 실패하였습니다. 다시시도해 주세요");
                }

            }, function (err) {
                alertMsg("네트워크 에러 ");
                
            });
         
         
     });
    function setNowMonthMissingGXTeachers(gxdatas,pt_teachers){
            missing_gx_teacherlist = [];
            var aym = parseInt(year)*12+parseInt(month);
            for(var i = 0; i < gxdatas.length; i++){

                //이번달일때
                if(aym == parseInt(gxdatas[i].gx_yearmonthnum)){
                    var gx_roomdata = JSON.parse(gxdatas[i].gx_roomdata);
                    var teacheruid = gx_roomdata.room_managerid ? gx_roomdata.room_managerid : "";
                    var teachername = gx_roomdata.room_managername ? gx_roomdata.room_managername : "";
                    
                    if(!isGXTeachers(teacheruid,pt_teachers)){                        
                        missing_gx_teacherlist.push({"pr_uid":teacheruid,"pr_name":teachername});
                    }
                }
            }
//            console.log("missing_gx_teacherlist ",missing_gx_teacherlist);
        }
        function isGXTeachers(teacheruid,pt_teachers){
            
                    
            var isin = false;
            for(var j = 0; j < missing_gx_teacherlist.length; j++){
                if(teacheruid == missing_gx_teacherlist[j].pr_uid){
                    isin = true;
                    break;
                }
            }
            for(var j = 0; j < pt_teachers.length; j++){
                if(teacheruid == pt_teachers[j].pr_uid){
                    isin = true;
                    break;
                }
            }
            
            return isin;
        }
        
     function clickCenter(centercode){
         document.getElementById("div_main_payroll").style.display = "block";
         now_centercode = centercode;    
         getMyTranerHistory(now_centercode,year,month);
    }
    function getMyTranerHistory(centercode,year,month){
        var obj = new Object();
            obj.centercode = centercode;
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.year = year;
            obj.month = month;
            var div_main = document.getElementById("div_main");
            document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
            
            
                
        
            CallHandler("my_payroll_history", obj, function(res) {
                clog("res is ",res);
            
                var div_title_desc = document.getElementById("div_title_desc");
                var container = document.getElementById("container");
                
                var code = parseInt(res.code);
                if (code == 100) {

                    if(res.teacherlist)teacherlist = res.teacherlist;
                    payroll_history = res.message;
                    status_isdelete_arr = res.statusisdeletearr;
                    if(res.teacherlist)teacherlist = res.teacherlist;
                    gxdatas = res.gxdatas;
                    setNowMonthMissingGXTeachers(gxdatas,res.message[0].data);
                    if(res.message[0] && res.message[0].setting)center_setting = JSON.parse(res.message[0].setting);
                    
                    div_center_list.style.display = "none";
                    div_main.style.display = "block";   
                    
                    div_title_desc.innerHTML = "";
                    container.innerHTML = ""; //초기화
                    
                    var teacher_uids = [];
                    var isdata = false;
                    for(var a = 0 ; a < res.message.length; a++){
                        var mdiv = document.createElement("div");
                        var my_div = document.createElement("div");
                        var other_div = document.createElement("div");
                        
//                        my_div.style.paddingLeft = "20px";
//                        my_div.style.paddingRight = "20px";
//                        
//                        other_div.style.paddingLeft = "20px";
//                        other_div.style.paddingRight = "20px";
                        
                        
                        var payroll_centercode = res.message[a].centercode;
                        var payroll_centername = res.message[a].centername;
                        var setting = res.message[a].setting ? JSON.parse(res.message[a].setting) : null; //payroll_setting
                        clog("res ",res);
                        var jsonarray = res.message[a].data;
                        status_isdelete_arr = res.statusisdeletearr;
                        payroll_history = jsonarray;
                        
                        alllist = jsonarray;
                        if(jsonarray){
//                            if(jsonarray.length > 0)isdata = true;
                            
                            jsonarray.sort(sort_by('pr_name', false, (a) => a.toUpperCase()));
                            
                            //관리자일때
                            if(isadmin == "Y"){
                                 for(var i = 0 ; i < jsonarray.length; i++){
                                    var item = jsonarray[i];
                                    if(item){
                                        var manageruid = item.pr_uid;
                                        var managerid = "";
                                        var managername = item.pr_name;
                                        var users = JSON.parse(jsonarray[i].pr_users);

                                        teacher_uids.push(manageruid);
                                        
                                        var user_len = users.length;
                                         var pr_newtotalprice_list = item.pr_newtotalprice ? JSON.parse(item.pr_newtotalprice) : [];
                                        var pr_newtotalprice = 0;
                                        for(var j = 0 ; j < pr_newtotalprice_list.length; j++)
                                            pr_newtotalprice += parseInt(pr_newtotalprice_list[j].price);


        //                                var color = i%2 == 0 ? "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);": "background-image: linear-gradient(#fff7d1 0px, #fff1b0 100%);";

                                        var num = a * jsonarray.length + i;
                                        var ptitle = "";

                                        var target_amount = item.pr_targetamount ? CommaString(item.pr_targetamount) : "0";
                                         var fix_percent = parseInt(item.pr_fixpercent);

                                      
                                           
                                            var table_data = createUsersTable(manageruid, i,users,setting,pr_newtotalprice,false,fix_percent);
                                            console.log("teacherlist",teacherlist);
                                            console.log("manageruid",manageruid);
                                            var mem_teahcer = getTeacherListByUid(teacherlist,manageruid);
                                            var teacher_setting = mem_teahcer && mem_teahcer.mem_setting != "" && mem_teahcer.mem_setting != "null" ? JSON.parse(mem_teahcer.mem_setting) : null;
                                            var my_pricenamesetting = getMyPriceSettingData(teacher_setting,year,month);
                                            var allpricedata = getTeacherAllPriceTag(manageruid,i,year,month,my_pricenamesetting,table_data.totalgetprice);
                                            var allprice_table_tag = getAllPriceTableTag(allpricedata,my_pricenamesetting,manageruid,year,month);
                                            var traner_allprice_tag = "<div class='div_total_tranerprice' id='div_total_tranerprice_"+manageruid+"'  style='display:block;width:100%;height:auto;border-top:1px solid #fffd0077;margin-top:10px;padding-top:10px;padding-bottom:10px'>"+allprice_table_tag+"</div>";
                                            

                                                var color = "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);";
                                                isdata = true;


                                                //트레이너 달력 아이콘
                                                var teacher_calendar_tag = auth >= AUTH_OPERATOR ? "<div onclick='clickInnerCalendar(\""+now_groupcode+"\",\""+now_centercode+"\",\""+manageruid+"\",\""+managerid+"\",\""+managername+"\")'  style='width:50px;height:50px;padding:10px;margin-top:-15px'><img src='./img/icon_newcalendar.png' style='width:30px;height:30px'/></div>" : "";



                                                //네모박스
                                                //이름 센터 , 총회원 , 목표금액 , 매출
                                                var targetamount_tag = "<div style='pading-left:10px;padding-right:10px'><div class='traner_bg' onclick='listClick(\""+manageruid+"\", "+num+")' id='traner_bg_"+manageruid+"' style='width:100%;height:auto;background-image:url(./img/box_my_payroll_new2.png);background-color:#00000000;border:1px solid #fffd0077;background-size:100% 100%;padding-left:20px;padding-right:20px;padding-top:15px;border-radius:8px'>"+                
                                                    
                                                                          "<div  style='margin-top:-5px'><text style='color:white;font-size:17px;font-weight:bold'>"+jsonarray[i].pr_name+"</text>&nbsp;&nbsp;<text style='font-size:12px;color:"+mColor.C919191+"'>"+payroll_centername+"<text><span style='float:right;margin-top:5px'>"+teacher_calendar_tag+"</span></div>"+
                                                                           "<div style='margin-top:5px'><text style='margin-top:15px;font-size:12px;color:"+mColor.C919191+"'>목표: <span class='fmont' style='color:"+mColor.WHITE+"'>￦ "+target_amount+"</span></text></div>"+
                                                                           "<div style='margin-top:-3px'><text style='font-size:12px;color:"+mColor.C919191+"'>매출: <span class='fmont' style='font-weight:bold;font-size:12px;color:"+mColor.YELLOW+"'>￦ "+CommaString(pr_newtotalprice)+"</span></text>"+
                                                                            "<span style='float:right'><text style='font-size:12px;color:"+mColor.C919191+"'>총회원: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+user_len+"</span>명</text></span></div>"+
                                                                           traner_allprice_tag+
                                                                       "</div></div>";

                                                //총횟수 , 총금액
                                                var total_price_tag = "<div style='width:100%margin-top:10px;margin-bottom:20px;border-bottom:1px solid #393939''>"+
    //                                                                      "<text style='font-size:12px;color:"+mColor.C919191+"'>잔여세션소진승인: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+table_data.totalremoveptcount+"</span>회</text>"+
                                                                          "<span style='float:right;padding-right:20px'><text style='font-size:12px;color:"+mColor.C919191+"'>총횟수: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+table_data.totalnowusecount+"</span>회 , 총금액: <span class='fmont' style='color:"+mColor.YELLOW+"'>￦"+CommaString(allpricedata.price)+"</span></text></span><br>";  
                                                                      "</div>";


                                                //최종 html
                                                other_div.innerHTML+= "<div style='padding-bottom:10px'>"+//"<span style='float:left'>"+teacher_calendar_tag+"</span>"+
                                                                            "<div style='padding-left:10px;' >"+

                                                                                    targetamount_tag+total_price_tag+

                                                                                "<ul class='sub"+i+"' style='display:none'>"+
                                                                                    "<div style='background:#aaaaaa'>"+table_data.tag+"</div>"+
    //                                                                                "<h6 align='left' style='position:absolute;padding:10px;font-size:14px;color:red'>잔여세션 소진승인("+table_data.totalremoveptcount+")회</h6>"+
    //                                                                                "<h6 align='right' style='"+color+"padding:10px;font-size:14px;'>총 횟수 : "+table_data.totalnowusecount+"회 , 총금액 : ￦"+CommaString(table_data.totalgetprice)+"</h6>"+
                                                                                "</ul>"+
                                                                            "</div>"+
                                                                        "</div>";               
                                            

                                        

                                    }
                                     

                                }

                            }
                            //트레이너일때 1개만
                            else {
                                 for(var i = 0 ; i < jsonarray.length; i++){
                                    var item = jsonarray[i];
                                    if(item){
                                        var manageruid = item.pr_uid;
                                        var managerid = "";
                                        var managername = item.pr_name;
                                        var users = JSON.parse(jsonarray[i].pr_users);
                                        
                                        teacher_uids.push(manageruid);
                                        
                                        var user_len = users.length;
                                         var pr_newtotalprice_list = item.pr_newtotalprice ? JSON.parse(item.pr_newtotalprice) : [];
                                        var pr_newtotalprice = 0;
                                        for(var j = 0 ; j < pr_newtotalprice_list.length; j++)
                                            pr_newtotalprice += parseInt(pr_newtotalprice_list[j].price);


        //                                var color = i%2 == 0 ? "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);": "background-image: linear-gradient(#fff7d1 0px, #fff1b0 100%);";

                                        var num = a * jsonarray.length + i;
                                        var ptitle = "";

                                        var target_amount = item.pr_targetamount ? CommaString(item.pr_targetamount) : "0";
                                        var fix_percent = parseInt(item.pr_fixpercent);


                                        //1명만 보일때
                                        if(obj.uid == item.pr_uid && isadmin == "N"){
                                            var table_data = createUsersTable(manageruid, i,users,setting,pr_newtotalprice,true,fix_percent);
                                            console.log("table_data",table_data)
                                            var mem_teahcer = getTeacherListByUid(teacherlist,manageruid);
                                            var teacher_setting = mem_teahcer && mem_teahcer.mem_setting != "" && mem_teahcer.mem_setting != "null" ? JSON.parse(mem_teahcer.mem_setting) : null;
                                            var my_pricenamesetting = getMyPriceSettingData(teacher_setting,year,month);
                                            var allpricedata = getTeacherAllPriceTag(manageruid,i,year,month,my_pricenamesetting,table_data.totalgetprice);
                                            var allprice_table_tag = getAllPriceTableTag(allpricedata,my_pricenamesetting,manageruid,year,month);
                                            var traner_allprice_tag = "<div class='div_total_tranerprice' id='div_total_tranerprice_"+manageruid+"'  style='display:none;width:100%;height:auto;border-top:1px solid #fffd0077;margin-top:10px;padding-top:10px;padding-bottom:10px'>"+allprice_table_tag+"</div>";
                                            
                                            
                                            
                                            console.log("111");
                                            //이름 센터 , 총회원 , 목표금액 , 매출

                                                var targetamount_tag = "<div style='border-radius:8px;pading-left:10px;height:auto;background-image:url(./img/box_my_payroll_new2.png);background-color:#00000000;background-size:100% 100%;'>"+
                                                                         "<div class='traner_bg'  id='traner_bg_"+manageruid+"' style='border-radius:8px;width:100%;height:90px;border:1px solid #fffd0077;padding-left:20px;padding-right:20px;padding-top:15px;'>"+                
                                                                               //이름, 센터명
                                                                               "<div style='margin-top:-5px'>"+
                                                                                  "<text style='color:white;font-size:17px;font-weight:bold'>"+jsonarray[i].pr_name+"</text>&nbsp;&nbsp;<text style='font-size:12px;color:"+mColor.C919191+"'>"+payroll_centername+"<text>"+
                                                                                  "<img id='img_down_"+manageruid+"' onclick='updownclick(\""+manageruid+"\", 1)' src='./img/down.png' style='width:20px;height:20px;float:right'>"+"<img id='img_up_"+manageruid+"' onclick='updownclick(\""+manageruid+"\", 0)' src='./img/up.png' style='width:20px;height:20px;display:none;float:right'>"+
                                                                               "</div>"+
                                                                                 //목표금액 input , 설정
                                                                               "<div style='margin-top:5px'>"+
                                                                                    "<text style='margin-top:15px;font-size:12px;color:"+mColor.C919191+"'>목표: <span class='fmont' style='color:"+mColor.WHITE+"'>￦ "+target_amount+"</span></text></div>"+
                                                                                //매출 , 총회원
                                                                               "<div style='margin-top:-3px'>"+
                                                                                    "<text style='font-size:12px;color:"+mColor.C919191+"'>매출: <span class='fmont' style='font-weight:bold;font-size:12px;color:"+mColor.YELLOW+"'>￦ "+CommaString(pr_newtotalprice)+"</span></text>"+
                                                                                    "<span style='float:right'><text style='font-size:12px;color:"+mColor.C919191+"'>총회원: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+user_len+"</span>명</text></span>"+
                                                                                "</div><hr style='width:100%;border: solid 1px #fffd0077;'>"+
                                                                                traner_allprice_tag+
                                                                           "</div>"+
                                                                            
                                                                        "</div>";


                                            //목표금액 input , 설정
                                            if(target_amount == "0")
                                               targetamount_tag = "<div style='border-radius:8px;pading-left:10px;height:auto;background-image:url(./img/box_my_payroll_new2.png);background-color:#00000000;background-size:100% 100%;'>"+
                                                                        "<div class='traner_bg'  id='traner_bg_"+manageruid+"' style='border-radius:8px;width:100%;height:90px;padding-left:20px;padding-right:20px;padding-top:15px;border:1px solid #fffd0077;'>"+
                                                                            //이름, 센터명
                                                                            "<div style='margin-top:-10px'>"+
                                                                                "<text style='color:white;font-size:17px;font-weight:bold'>"+jsonarray[i].pr_name+"</text>&nbsp;&nbsp;<text style='font-size:12px;color:"+mColor.C919191+"'>"+payroll_centername+"<text>"+
                                                                                "<img id='img_down_"+manageruid+"' onclick='updownclick(\""+manageruid+"\", 1)' src='./img/down.png' style='width:20px;height:20px;float:right'>"+"<img id='img_up_"+manageruid+"' onclick='updownclick(\""+manageruid+"\", 0)' src='./img/up.png' style='width:20px;height:20px;display:none;float:right'>"+
                                                                            "</div>"+
                                                                            //목표금액 input , 설정
                                                                            "<div style='margin-top:3px'>"+
                                                                                "<text style='position:absolute;font-size:13px;color:"+mColor.YELLOW+";margin-top:3px'>목표금액</text>"+
                                                                                "<div style='width:100%;height:40px'>"+
                                                                                    "<text id='txt_target_amount_"+a+"_"+i+"' class='fmont' style='float:left;font-size:23px;color:white;display:none;'></text><input id='target_amount_"+a+"_"+i+"' type='text' onfocus='this.select()' onkeyup='inputChangeComma(\"target_amount_"+a+"_"+i+"\")' value='"+target_amount+"' class='fmont' style='width:150px;margin-left:55px;background-color:"+mColor.C111111+";border:0px;border-radius:15px;padding:2px 15px 2px 10px;font-size:16px;color:white'/>"+
                                                                                    "<span style='float:right;'><button id='btn_target_amount_"+a+"_"+i+"' style='color:"+mColor.C919191+";font-size:14px;background-color:"+mColor.C111111+";border-radius:15px;padding:2px 15px 2px 15px' onclick='change_target_amount(\""+item.pr_centercode+"\","+item.pr_year+","+item.pr_month+",\""+item.pr_uid+"\","+a+","+i+")' >설정</button></span>"+   
                                                                                "</div>"+
                                                                            "</div>"+
                                                                            //매출 , 총회원
                                                                            "<div style='margin-top:-11px'>"+
                                                                                "<text style='font-size:12px;color:"+mColor.C919191+"'>매출: <span class='fmont' style='font-weight:bold;font-size:12px;color:"+mColor.YELLOW+"'>￦ "+CommaString(pr_newtotalprice)+"</span></text>"+
                                                                                "<span style='float:right'><text style='font-size:12px;color:"+mColor.C919191+"'>총회원: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+user_len+"</span>명</text></span>"+
                                                                            "</div><hr style='width:100%;border: solid 1px #fffd0077;'>"+
                                                                             traner_allprice_tag+
                                                                       "</div>"+
                                                                       
                                                                "</div>";


                                                //총횟수 , 총금액
                                                var total_price_tag = "<div style='width:100%margin-top:10px;margin-bottom:20px;border-bottom:1px solid #393939''>"+
    //                                                                      "<text style='font-size:12px;color:"+mColor.C919191+"'>잔여세션소진승인: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+table_data.totalremoveptcount+"</span>회</text>"+
                                                                          "<span style='float:right;padding-right:20px'><text style='font-size:12px;color:"+mColor.C919191+"'>총횟수: <span class='fmont' style='color:"+mColor.YELLOW+"'>"+table_data.totalnowusecount+"</span>회 , 총금액: <span class='fmont' style='color:"+mColor.YELLOW+"'>￦"+CommaString(allpricedata.price)+"</span></text></span><br>";  
                                                                      "</div>";




                                            div_title_desc.innerHTML+="<div style='padding-top:20px;padding-left:20px;padding-right:20px;height:auto'>"+targetamount_tag+total_price_tag+"</div>";
                                            my_div.innerHTML=table_data.tag;
                                            isdata = true;

                                        }
                                    }
                                 }
                                
                            }
                            
                        }
                        clog("other_div ",other_div);
                        mdiv.append(my_div);
                        mdiv.append(other_div);
                        container.append(mdiv);
                        allListOpen(jsonarray.length);
                        
                        
                        if(isadmin == "N")
                            document.getElementById("div_allopenclose").style.display = "none";
                        else {
                            document.getElementById("div_header").style.height = "100px";
                            document.getElementById("div_title_desc").style.display = "none";
                            div_main.style.paddingTop = "150px";
                        }
                    }
                    
                    var id_nodata = document.getElementById("id_nodata");
                    id_nodata.style.display = isdata ? "none" : "block";
                    
                    
                    for(var i = 0; i < teacher_uids.length; i++)
                        addRowHandlers("table_teacher_"+teacher_uids[i]);
                    
                        
                    
                    
                } else {
                    container.innerHTML = ""; //초기화
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
    }
    function addRowHandlers(table_id) {
        var table = document.getElementById(table_id);
        if(table){
            
            var rows = table.getElementsByTagName("tr");
            for (i = 0; i < rows.length; i++) {
                var currentRow = table.rows[i];
               rowonclick(currentRow);
            }
                    
        }
    }
    function rowonclick(currentRow){
         var createClickHandler = function(row) {
                return function() {
                    console.log("tds ",row.getElementsByTagName("td").length);
                    
                    var userdata = []
                    for(var i = 0; i < row.getElementsByTagName("td").length; i++){
                        var cell = row.getElementsByTagName("td")[i];
                        //var text = cell.innerText;
                        var innerhtml = cell.innerHTML;
                        userdata.push(innerhtml);
                    }
                    showUserPayrollInfoPopup(userdata);
                    
                };
            };
            currentRow.onclick = createClickHandler(currentRow);
    }
    function showUserPayrollInfoPopup(userdata){
//        if(isadmin == "N")
        {
            
        
        var usertitle = ["이름","등록일","진행횟수","수업료","등록횟수","단가","퍼센트단가","이전남은횟수","남은횟수","무료횟수[최대/남은횟수]","상태"];
        var style = {
                    bodycolor: "#191919",
                    size: {
                        width: "80%",
                        height: "auto"
                    }
                };
            var message_tag = "";
            for(var i = 0 ; i < userdata.length;i++){
                if(i == 0){
//                    message_tag = userdata[i];
                }else{
                    message_tag += "<div style='width:100%;height:25px;color:white'><text style='font-size:12px;float:left;margin-left:20px'>"+usertitle[i]+"</text><span style='float:right;margin-right:20px'>"+userdata[i]+"</span></div>";
                }
            }
           
            showModalDialog(document.body, userdata[0], message_tag, "확인", null, function() {
                hideModalDialog();

            },null,style);   
        }
    }
    function getAllPriceTableTag(allpricedata,my_pricenamesetting,teacheruid,y,m){
//            console.log("총급여 ",allpricedata);
            var mem_teahcer = getTeacherListByUid(teacherlist,teacheruid);
        
            if(allpricedata.price == 0 && !allpricedata.tag)
                allpricedata.tag = "※금액지급설정이 되어있지 않습니다.";
        
            return "<table style='width:100%;color:white;'>"+
                        "<tr>"+
                             "<td align='center' style='width:50%;padding-right:7px;vertical-align:top'>"+
                                 allpricedata.price_tag+
                            "</td>"+  
                             "<td align='center' style='width:50%;padding-left:8px;vertical-align:top'>"+
                                 allpricedata.percent_tag+
                            "</td>"+    
                        "</tr>"+
                    "</table>";
                    
        }
    function updownclick(manageruid,isdown){
        var traner_bg = document.getElementById("traner_bg_"+manageruid);//all 
        var img_down = document.getElementById("img_down_"+manageruid);
        var img_up = document.getElementById("img_up_"+manageruid);
        var div_total_tranerprice = document.getElementById("div_total_tranerprice_"+manageruid);//all 
        var div_title_desc = document.getElementById("div_title_desc");
        
        if(isdown){
            traner_bg.style.height = "auto";  //all 
            div_title_desc.style.display = "auto";
            if(img_down)img_down.style.display = "none";
            if(img_up)img_up.style.display = "block";
            div_total_tranerprice.style.display = "block";
            
        }else{
            traner_bg.style.height = "90px";    //all
            div_title_desc.style.display = "140px"; 
            if(img_down)img_down.style.display = "block";
            if(img_up)img_up.style.display = "none";
            div_total_tranerprice.style.display = "none";
        }
    }
    
    
     function getMyPriceSettingData(teacher_setting,year,month){
            var nym = parseInt(year)*12+parseInt(month);
            //강사 세팅이 있다면 
            var my_pricenamesetting = null;
                                    
            
         console.log("teacher_setting ",teacher_setting);
            var max_aym = 0;
            
             //강사 세팅이 있다면 강사의 마지막 세팅을 가져온다.
            
            
            if(teacher_setting && teacher_setting.allpricesetting){
                 
                var isin = false;
                for(key of Object.keys(teacher_setting.allpricesetting)) {
                    var ym = key.split("-");
                    var aym = parseInt(ym[0])*12+parseInt(ym[1]);
                    if(nym == aym){
                        
                        isin = true;
                        my_pricenamesetting = teacher_setting.allpricesetting[key];
                        break;
                    }
                }
                if(!isin)
                for(key of Object.keys(teacher_setting.allpricesetting)) {
                    var ym = key.split("-");
                    var aym = parseInt(ym[0])*12+parseInt(ym[1]);
                    if(aym > max_aym){
                        
                        my_pricenamesetting = teacher_setting.allpricesetting[key];
                        max_aym = aym;
                    }
                }
            }
            //강사 세팅이 없다면 tb_centercode setting 에서 가져온다.                                    
            else if(!my_pricenamesetting && center_setting){
                my_pricenamesetting = center_setting.pricenamesetting;
            
            }
            
            
            
            //ison 은 글로벌에서 모두 가져온다.
            for(var i = 0 ; i < my_pricenamesetting.length; i++){
                var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                var mid = parseInt(my_pricenamesetting[i].id);
//                if(mtype == "price" && mid < 2 || mtype == "percent" && mid < 1)
                for(var j = 0 ; j < center_setting.pricenamesetting.length; j++){
                    
                    var ctype = center_setting.pricenamesetting[j].type && center_setting.pricenamesetting[j].type == "percent" ? "percent" : "price";
                    var cid = parseInt(center_setting.pricenamesetting[j].id);
                    if(mtype == ctype && mid == cid){
                        my_pricenamesetting[i].ison = center_setting.pricenamesetting[j].ison;
                    }
                }
            }
            //PT수당, 그룹수업수당, 원천징수  는 디폴트이므로 무조건 있는지 체크 후 없으면 삽입한다.
            my_pricenamesetting = checkDefaultRules(my_pricenamesetting);
            
            return my_pricenamesetting;
        }
        //PT수당, 그룹수업수당, 원천징수  는 디폴트이므로 무조건 있는지 체크 후 없으면 삽입한다.
        function checkDefaultRules(my_pricenamesetting){
            
            var ptrule = null;
            var gxrule = null;
            var taxrule = null;
            for(var j = 0 ; j < center_setting.pricenamesetting.length; j++){                    
                 var ctype = center_setting.pricenamesetting[j].type && center_setting.pricenamesetting[j].type == "percent" ? "percent" : "price";
                 var cid = parseInt(center_setting.pricenamesetting[j].id);
                 if(ctype == "price" && cid == 0){
                     ptrule = center_setting.pricenamesetting[j];
                 }else if(ctype == "price" && cid == 1){
                     gxrule = center_setting.pricenamesetting[j];
                 }
                 else if(ctype == "percent" && cid == 0){
                     taxrule = center_setting.pricenamesetting[j];
                 }
            }
            var isptrule = false;    
            var isgxrule = false;    
            var istaxrule = false;    
            for(var i = 0 ; i < my_pricenamesetting.length; i++){
                var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                var mid = parseInt(my_pricenamesetting[i].id);
                if(mtype == "price" && mid == 0){
                     isptrule = true;
                 }else if(mtype == "price" && mid == 1){
                     isgxrule = true;
                 }
                 else if(mtype == "percent" && mid == 0){
                     istaxrule = true;
                 }                    
            }
                
            if(ptrule&& !isptrule)my_pricenamesetting.push(ptrule);
            if(gxrule&& !isgxrule)my_pricenamesetting.push(gxrule);
            if(taxrule&& !istaxrule)my_pricenamesetting.push(taxrule);
            return my_pricenamesetting;
        }
        function allPriceListOpen(){
             var style = {
                    bodycolor: "#eeeeee",
                    size: {
                        width: "80%",
                        height: "100%"
                    }
                };
            var message_tag = getAllTotalPriceListTag();
           
            showModalDialog(document.body, year+"년 "+month+"월 전체 금액목록", message_tag, "확인", null, function() {
                hideModalDialog();

            },null,style);   
        }
        function getAllTotalPriceListTag(){

            var div = document.createElement("div");
            
            //////////////////////////////////////////////////////////
            //트레이너별 금액 이름 삽입
            //////////////////////////////////////////////////////////
            console.log("total_teacher_pricedatas ",total_teacher_pricedatas);
            var isname = false;
            var titles = [];
            titles.push("순번");
            titles.push("이름");
            
            // + 금액먼저 삽입
            for(key of Object.keys(total_teacher_pricedatas)) {
                for(var i = 0 ; i < total_teacher_pricedatas[key].length;i++){
                    isname = true;
                     var type = total_teacher_pricedatas[key][i].type && total_teacher_pricedatas[key][i].type == "percent" ? "percent" : "price";
                    var name = total_teacher_pricedatas[key][i].name;
                    if(type == "price")titles.push(name);
                }
            }
            // - 금액은 나중에 삽입
             for(key of Object.keys(total_teacher_pricedatas)) {
                for(var i = 0 ; i < total_teacher_pricedatas[key].length;i++){
                    isname = true;
                    var name = total_teacher_pricedatas[key][i].name;
                    if(type == "percent")titles.push(name);
                }
                
            }
            
            titles.push("총금액");
            titles = Array.from(new Set(titles));
            console.log("titles ",titles);
            var title_tag = "<tr class='fmont' style='text-align:center;background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>";
            
            var td_width = ["10%","10%","auto"];
           
            for(var i = 0 ; i < titles.length;i++){
                var width = i < 2 ? td_width[i] : "auto";
                title_tag +="<td style='vertical-align:middle;width:"+width+";height:50px;border-right:1px solid #e4e6ef;background-color:#f0f6fa'>" +
                                "<text style='font-weight:bold'>"+titles[i]+"</text>" +
                            "</td>";
            }
            title_tag += "</tr>";
//            console.log("title_tag ",title_tag);
            //세로 총금액 초기화
            var num = 1;
            var row_totalprices = [];
            for(var i = 0 ; i < titles.length;i++){
                row_totalprices.push(0);
            }
            
            //////////////////////////////////////////////////////////
            //트레이너별 금액 내용 삽입
            //////////////////////////////////////////////////////////
            var allpricedata_tag = "";
             for(key of Object.keys(total_teacher_pricedatas)) {
                var number = num < 10 ? "0"+num:""+num;
                
                var total_price = 0;
                var mem_teahcer = getTeacherListByUid(teacherlist,key);
                var teacher_name = mem_teahcer.mem_username;
                var teacher_uid = mem_teahcer.mem_uid;
                allpricedata_tag +="<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                        "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+number+"</text>" +
                                        "</td>"+
                                        "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                            "<button class='btn' style='height:30px;background-color:#009ef7;border:0px;border-radius:5px;font-size:14px;color:white' onclick='showUserInfoPopup(\""+teacher_uid+"\");'>"+teacher_name+"</button>" +
                                        "</td>";
                            
                
                for(var j = 0 ; j < titles.length;j++){ 
                    var isin = false;
                    var tname = titles[j];
                    if(tname == "순번" || tname == "이름" || tname == "총금액")
                        isin = true;
                    
                    for(var i = 0 ; i < total_teacher_pricedatas[key].length;i++){
                        
                        var name = total_teacher_pricedatas[key][i].name;
                        
                        if(tname == name){
                            var type = total_teacher_pricedatas[key][i].type && total_teacher_pricedatas[key][i].type == "percent" ? "percent" : "price";
                            var isadd = type == "price" ? true : false;
                            var price = parseInt(total_teacher_pricedatas[key][i].price);
                            
                            
                            if(type == "price"){
                                row_totalprices[j] += parseInt(price);
                                total_price += parseInt(price);
                            }
                                
                            else {
                                row_totalprices[j] -= parseInt(price);
                                total_price -= parseInt(price);
                            }
                                console.log("33 price "+total_price);  
                            
                            var minus_tag = !isadd && price != 0 ? "-" : "";
                            allpricedata_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                                    "<text >"+minus_tag+""+CommaString(price)+"</text>" +
                                                "</td>";
                            isin = true;
                           
                            break;
                        }
                        
                    }
                    if(!isin){
                        allpricedata_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                                "<text >0</text>" +
                                            "</td>";
                    }
                }
                 //트레이너 총금액
                allpricedata_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                            "<text>"+CommaString(total_price)+""+TXT_KORWON+"</text>" +
                                        "</td>";
                allpricedata_tag += "</tr>";
                row_totalprices[titles.length-1] += total_price;                 
                num++;
               
             
                
            }
            console.log("row_totalprices ",row_totalprices);
            //하단 전체 총금액 내용 삽입
            var rowtotalprice_tag = "<tr class='fmont' style='text-align:center;background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+ 
                                    "<td colspan = '2' style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                        "<text >Total</text>" +
                                    "</td>";
            for(var i = 2 ; i < row_totalprices.length;i++){
                var row_totalprice = row_totalprices[i];
                rowtotalprice_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+CommaString(row_totalprice)+""+TXT_KORWON+"</text>" +
                                    "</td>";

            }
            rowtotalprice_tag += "</tr>";
            
            div.innerHTML = "<div align='center' style='width:100%;height:auto'>"+
                                "<table id='table_total_all_pricedata' align='center' class='table table-bordered' style='width:100%;height:auto;text-align:center'>"+                                    
                                        title_tag+                                        
                                        allpricedata_tag+                                        
                                        rowtotalprice_tag+                                                                            
                                 "</table>"+   
                                "<button onclick='exportTotalPriceExcel(\"table_total_all_pricedata\")' style='float:left;border:0px;background-color:#1d7146;border-radius:5px;font-size:14px;color:white;font-weigh:500;width:230px;height:35px;outline:none'><img src = './img/ic_excel.png' style='height:22px;margin-top:-1px;margin-right:10px'/>&nbsp;엑셀로 다운로드</button>"+
                            "</div>";

//            console.log(""+div.innerHTML);
            return div.innerHTML;

        }
        function updateGXPriceDatas(){
            if(teacher_gxprice_data){
                //key = teacheruid
                for(key of Object.keys(teacher_gxprice_data)) {
                     var table_gxpayroll = document.getElementById("table_gxpayroll_"+key);
                     if(table_gxpayroll){
                         table_gxpayroll.innerHTML = 
                                "<tr class='fmont' style='text-align:center;background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                     
                                        "<td style='vertical-align:middle;width:10%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>순번</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>정산방식</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>수업료</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>수업횟수</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>금액</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:auto;height:45px;'>" +
                                            "<text style='font-weight:bold'>내용</text>" +
                                        "</td>" +
                                        
                                    "</tr>";
                         
                         table_gxpayroll.innerHTML += teacher_gxprice_data[key].gxpricedata_tag ? teacher_gxprice_data[key].gxpricedata_tag : "";
                         var gx_bottom_total = document.getElementById("gx_bottom_total_"+key);
                         var now_total_roomcount = teacher_gxprice_data[key].now_total_roomcount ? teacher_gxprice_data[key].now_total_roomcount : "0";
                         var totalprice = teacher_gxprice_data[key].totalprice ? parseInt(teacher_gxprice_data[key].totalprice) : 0;
                         if(gx_bottom_total)gx_bottom_total.innerHTML = "총 횟수 : " + now_total_roomcount+ "회 , 총금액 : "+TXT_WON + CommaString(totalprice);
                     }
                 }
            }
            
//            var reservation_container = document.getElementById("reservation_container");
//            reservation_container.style.height = "1300px";
        }
        var before_selected_traner_uid = {};
     var teacher_gxprice_data = {};
        
        var total_teacher_pricedatas = {};
        function getTeacherAllPriceTag(teacheruid,idx,y,m,my_pricenamesetting,pt_price){
            
            //tb_centercode-setting : pricenamesetting  == mem_setting.allpricesetting[y+"-"+m].pricenamesetting
//            if(!teacher_setting)teacher_setting = {};
            
           total_teacher_pricedatas[teacheruid] = [];

//          
            var price_datas = getMyPriceNameSetting(my_pricenamesetting,"price");
           
           
            var allprice = 0;
           
            console.log("aaaa ",my_pricenamesetting);
            ////////////////////////////////////////////
            // + 금액 추가되는 데이타
            ////////////////////////////////////////////
            var price_tag = "";
            if(price_datas)
            for(var i = 0 ; i < price_datas.length;i++){
                var p = price_datas[i];
//                console.log("p is ",p);
                var name = p.name;
                var price = p.price;
                //
                if(i == 0){
                    price = pt_price;
                }else if(i == 1){
                    
                    var gxgroupdata = getGXGroupPriceCalculate(teacheruid,p);
                    price = gxgroupdata && gxgroupdata.totalprice ? gxgroupdata.totalprice : 0;
                    teacher_gxprice_data[teacheruid] = gxgroupdata;
                }
                
                var id = p.id;
                
               
                if(p.ison == "true"){
                    
                    price_tag += "<div style='width:100%;height:20px'>"+
                            "<text style='font-size:11px;float:left;font-weight:400' >"+name+"</text>"+
                            "<text class='fmont' style='float:right;font-size:11px;font-weight:400'>"+TXT_WON+" "+CommaString(price)+"</text></div>";
                    
                    total_teacher_pricedatas[teacheruid].push({"id":id,"type":"price","name":name,"price":price});
                }           
               
                allprice += parseInt(price);
            }
            
            ////////////////////////////////////////////
            // - 퍼센트 차감되는 데이터
            ////////////////////////////////////////////
            var percent_datas = getMyPriceNameSetting(my_pricenamesetting,"percent");
            var percent_tag = "";
            if(percent_datas)
            for(var i = 0 ; i < percent_datas.length;i++){
                var p = percent_datas[i];
//                console.log("percent_datas p is ",p);
                var name = p.name;
                
                var percent = parseFloat(p.percent);
                var price = parseInt((allprice/100)*percent);
                
              
                var id = p.id;
                
                
                var br5 = i != 0 && i%5 == 0 ? "<br><br>":"";
//                console.log(i+"p ison");
                if(p.ison == "true"){
                     var minus_tag = price != 0 ? "-" : "";
                    percent_tag += "<div style='width:100%;height:20px'>"+
                            "<text style='font-size:11px;float:left;font-weight:400;margin-top:1px' >"+name+"("+percent+"%)</text>"+
                            "<text class='fmont' style='float:right;font-size:11px;font-weight:400'>"+TXT_WON+" "+minus_tag+""+CommaString(price)+"</text></div>";
                   
                      total_teacher_pricedatas[teacheruid].push({"id":id,"type":"percent","name":name,"price":price});
                }           
               
                allprice -= parseInt(price);
            }
            //console.log("price_tag "+price_tag);
            return {"price":allprice,"price_tag":price_tag,"percent_tag":percent_tag};
            
        }
        function getMyPriceNameSetting(my_pricenamesetting,type){
            var arr_rule = [];
            for(var i = 0 ;i < my_pricenamesetting.length; i++){
                var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                if(mtype == type){
                    arr_rule.push(my_pricenamesetting[i]);

                }
            }
            return arr_rule;
        }
        //gx 금액세팅데이타
        function getGXGroupPriceCalculate(teacheruid,pdata){ //pdata = price data
            var total_gxprice = 0;
            if(!pdata.gxpricerule)return total_gxprice;
            
            var myroomdatas = getTeacherRoomDatas(teacheruid);
            
            //p.lesson , p.usertype , p.user[] , p.nosho , p.noshow ,p.nobody , p.other
            var p = pdata.gxpricerule;
            var pricetype = p.pricetype;
            var usertype = p.usertype;
            
            var lesson_price = 0; //강좌별 금액
            var user_price = 0; //수강인원별 금액
            // (강좌가 오픈되었으며 : 예약은 1명이상 되어있으나 아무도 출석하지 않았을때)
            var noshow_price = 0;
            // (강좌가 오픈되었으며 : 아무도 예약하지 않았을때)
            var nobody_price = 0;
            //기타
            var other_price = parseInt(p.other);
            
            
           
            var gxpricedata_tag = "";
            
            //노쇼,노바디를 제외한 현재시간까지 횟수
            
            var now_lesson_count = 0; //강좌별일때 횟수 
            var now_total_room_count = 0; //강좌별일때 횟수 
            var now_noshow_count = 0;
            var now_nobody_count = 0;
            
            var usertype_price = {};
            
//            console.log("myroomdatas ",myroomdatas);
            for(var i = 0; i < myroomdatas.length; i++){
                var room_datetime = myroomdatas[i].room_datetime;
                
                var room_min = parseInt(myroomdatas[i].room_min);
                var room_lessontime = myroomdatas[i].room_lessontime;
                var end_min = parseInt(room_min)+parseInt(room_lessontime);
                var room_lesson_endtime = nextMin(room_datetime,end_min);
                var room_isshow = parseInt(myroomdatas[i].room_isshow);
                
//                console.log(i+" "+room_datetime+" ~ "+room_lesson_endtime+" end_min "+end_min+" room_isshow "+room_isshow+" isend : "+isNowTimeMinOver(room_lesson_endtime) );
                //강좌가 종료된 방정보만 계산한다.
                if(isNowTimeMinOver(room_lesson_endtime) < 0 && room_isshow == 1){
                    
                    var room_max = parseInt(myroomdatas[i].room_max);
                    var room_users = myroomdatas[i].room_users ? myroomdatas[i].room_users : [];
                    var now_noshow = false;
                    var now_nobody = false;
                    var user_len = room_users ? room_users.length : 0; //방에 예약한 회원수
                    var user_ready_cnt = 0; //예약한상태
                    var user_checkin_cnt = 0; //QR 출석한상태
                    for(var j=0; j < room_users.length; j++){
                        if(room_users[j].status == "0") //예약한상태
                            user_ready_cnt++;
                        else if(room_users[j].status == "2")//QR 출석한상태
                            user_checkin_cnt++;
                    }
                    
                    //강좌별
                    if(pricetype == "0"){
                        //노쇼 횟수 ,금액
                        if(user_ready_cnt > 0 && user_checkin_cnt == 0){
                            noshow_price += parseInt(p.noshow);
                            now_noshow_count++;
                        }
                        //노바디 횟수 ,금액
                        else if(user_ready_cnt == 0 && user_checkin_cnt == 0){
                            nobody_price += parseInt(p.nobody);
                            now_nobody_count++;
                        }
                        //강좌별 계산인데 노쇼, 노바디 가격이 0 이어도 강좌로 체크한다.
                        else {
                            lesson_price += parseInt(p.lesson);    
                            now_lesson_count++;
                        }
                    }
                    //수강인원별
                    else {
                        if(p.user)
                        for(var a = 0 ; a < p.user.length; a++){
                            var len = parseInt(p.user[a].len);
                            var len_price = parseInt(p.user[a].price);
                            var check_len = usertype == 0 ? user_len : user_checkin_cnt;
                            if(!usertype_price[""+len])usertype_price[""+len] = {"defaultprice":len_price,"count":0,"total_price":0};

                            if(check_len <= len){
                                user_price += len_price;
//                                    console.log(i+" len_price "+len_price);

                                usertype_price[""+len].count++; 
                                usertype_price[""+len].total_price += len_price; 

                                break;
                            }
                        }

                    }
                    
                    now_total_room_count++;
                                    
                }
            }
//            console.log("now_noshow_count "+now_noshow_count+" now_nobody_count "+now_nobody_count+" now_lesson_count "+now_lesson_count);
            
            //강좌별일때 해당 금액을 모두 합산한다.
            if(pricetype == "0"){
//                console.log("lesson :  lesson_price "+lesson_price+" noshow_price "+noshow_price+" nobody_price "+nobody_price+" other_price "+other_price);
                total_gxprice = lesson_price + noshow_price + nobody_price + other_price;
                
                
                 gxpricedata_tag += "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >01</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >강좌별 계산</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(parseInt(p.lesson))+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+now_lesson_count+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(lesson_price)+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                        "<text ></text>" +
                                    "</td>" +
                                "</tr>"+
                                "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >02</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >노쇼</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(parseInt(p.noshow))+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+now_noshow_count+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(noshow_price)+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                        "<text ></text>" +
                                    "</td>" +
                                "</tr>"+
                                "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >03</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >노바디</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(parseInt(p.nobody))+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+now_nobody_count+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(nobody_price)+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                        "<text ></text>" +
                                    "</td>" +
                                "</tr>";
                     
            }
            //수강인원별일때 해당 금액을 모두 합산한다.
            else{
//                console.log("user :  user_price "+user_price+" noshow_price "+noshow_price+" nobody_price "+nobody_price+" other_price "+other_price);
                
                total_gxprice = user_price + other_price;
                
                var cnt = 1;
                var offset = 0;
                for(key of Object.keys(usertype_price)) {
                     
                     var value = usertype_price[key];
                    var num = cnt < 10 ? "0"+cnt : ""+cnt;
                    
                     gxpricedata_tag += "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                        "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+num+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+offset+"~"+key+"인</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+usertype_price[key].defaultprice+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+usertype_price[key].count+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+ CommaString(usertype_price[key].total_price)+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                            "<text ></text>" +
                                        "</td>" +
                                    "</tr>";
                    offset = parseInt(key)+1; 
                    cnt++;
                }

            }
//            var gx_bottom_total = document.getElementById("gx_bottom_total_"+teacheruid);
//            gx_bottom_total.innerHTML = "총 횟수 : " + now_total_room_count + "회 , 총금액 : "+TXT_WON + CommaString(total_gxprice) + "";
            return {"totalprice":total_gxprice,"now_total_roomcount":now_total_room_count,"gxpricedata_tag":gxpricedata_tag};
        }
        function getTeacherRoomDatas(teacheruid){
            var myroomdatas = [];
            if(gxdatas)
            for(var i = 0; i < gxdatas.length;i++){
                var gx_roomdata = JSON.parse(gxdatas[i].gx_roomdata);
                if(gx_roomdata.room_managerid == teacheruid){
                    myroomdatas.push(gx_roomdata);
                }
                    
            }
            return myroomdatas;
        }
    
    var isClickMoreTotal = false;
        function clickInnerCalendar(now_groupcode,now_centercode,manageruid,managerid,managername){
            clog("clickInnerObj");
            isClickMoreTotal = true;
            showTranerReservation(now_groupcode,now_centercode,manageruid,managerid,managername);
        }
    function change_target_amount(centercode, year,month,uid, a ,i){
        var target_amount = document.getElementById("target_amount_"+a+"_"+i);
        var amount = parseCommaInt(target_amount.value);

         showModalDialog(document.body, "금액 재설정", "목표금액을 "+CommaString(amount)+"로 설정하시겠습니까?", "재설정하기", "취소", function() {
            
            updateTargetAmount(centercode, year,month,uid,amount,a,i);
             
        }, function() {
            hideModalDialog();
        });
        
        
        
       
    }
    function updateTargetAmount(centercode, year,month,uid,targetamount, a,i){
        
        var obj = new Object();
        obj.year = year;
        obj.month = month;
        obj.uid = uid;
        obj.targetamount = targetamount;
        
        var senddata = {
            centercode : centercode,
            type :"updatetargetamount",
            value : obj
        }
        CallHandler("getdata", senddata, function (res) {
           if(res.code == 100){
               var target_amount = document.getElementById("target_amount_"+a+"_"+i);    
               var btn_target_amount = document.getElementById("btn_target_amount_"+a+"_"+i);    
               var txt_target_amount = document.getElementById("txt_target_amount_"+a+"_"+i);
               txt_target_amount.innerHTML = "￦ "+CommaString(targetamount);
               target_amount.style.display = "none";
               btn_target_amount.style.display = "none";
               txt_target_amount.style.display = "block";
               
               alertMsg("목표금액을 설정했습니다.", function() {
                    hideModalDialog();
                });
           }else{
               alertMsg(res.message, function() {
                    hideModalDialog();
                });
           }

        }, function (err) {alertMsg(err)});
    }
    function getPTPercent(manageruid,setting,totalprice, user_custom_percent,fixpercent){
        var rpercent = 0;
        var max_data = {"percent" : 0 , "price": 0};
        for(var i = 0 ; i < setting["pricerule"].length; i++){
            var setdata = setting["pricerule"][i];
            var price = parseInt(setdata.price);
            var percent = parseInt(setdata.percent);
           
            //나중에 속한 값이 없을때는 최고 퍼센트 배율을 삽입하기 위함
            if(price > max_data.price){
                max_data.percent = percent;
                max_data.price = price;
            }
           
            
            if(totalprice <= price){
                rpercent = percent;
                break;
            }
                
                
        }
        if(user_custom_percent > 0)
            rpercent = user_custom_percent;
        
        //속한 값이 없을때는 최고 퍼센트 배율을 삽입하기 위함
        if(rpercent == 0 )
            max_data.percent;
        
       
         return fixpercent > 0 ? fixpercent : rpercent;
    }
   
      var sortType = 'asc';  
    // 테이블 헤더 클릭시 정렬 
    function sortContent(tableid,index) {
        clog("tableid "+tableid+" index "+index);
        var table = document.getElementById(tableid);
        
       
        sortType = (sortType =='asc')?'desc' : 'asc';

        clog("table[0].children ",table.tBodies[0].children);
        var checkSort = true;
        var rows = table.tBodies[0].children;

        while (checkSort) { // 현재와 다음만 비교하기때문에 위치변경되면 다시 정렬해준다.
            checkSort = false;

            for (var i = 0; i < (rows.length - 1); i++) {
//            for (var i = 0; i < rows.length; i++) {
                
                var innertext = rows[i].cells[index].innerHTML;
                var innertext_1 = rows[i + 1].cells[index].innerHTML;
               
                var fCell = innertext.toUpperCase();
                var sCell = innertext_1.toUpperCase();

                var row = rows[i];

                // 오름차순<->내림차순 ( 이부분이 이해 잘안됬는데 오름차순이면 >, 내림차순이면 <
                //                        이고 if문의 내용은 동일하다 )
                if ( (sortType == 'asc' && fCell > sCell) || 
                        (sortType == 'desc' && fCell < sCell) ) {

                    row.parentNode.insertBefore(row.nextSibling, row);
                    checkSort = true;
                }
            }            
        }
    }
     function createUsersTable(manageruid,idx,rows,setting,total_getprice,isheight_scroll,fixpercent){
        
        //             document.getElementById("table_div").style.display = "block";
         
        if(rows)rows.sort(sort_by('id', false, (a) => a.toUpperCase()));//쿠폰아이디로 정렬
        var issetheaderpercent = false;

        var div = document.createElement("div");
        var table = document.createElement("table");
        table.className = "tb_payroll fsans";
        table.id = "table_teacher_"+manageruid;
        table.style.display = rows.length > 0 ? "block" : "none";
        table.style.overflow = "auto";
        table.style.marginLeft = "-1px";
        table.style.marginRight = "-1px";
        
        
        if(isheight_scroll){
            var screen_height = $(window).height();
            table.style.height = (screen_height/zoom-260)+"px";    
        }
        
         
        
        table.style.textAlign = "center";
        table.innerHTML = "<tfoot></tfoot><tbody></tbody>";
        
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        
        var total_nowusecount = 0; //이번달 총 강습한 횟수
//        var total_getprice = 0; //단가기준 전체금액
        var total_get_percent_price = 0; //퍼센트 적용 기준 전체금액
        var header_percent_idx = -1;
        var total_removeptcount = 0;
//        clog("setting ",setting);
//        clog("total_getprice "+total_getprice);
         
      
        var len = rows.length;
        if (len > 0) {

           
            for (var i = 0; i < len; i++) {
                var user = rows[i];
                //1년지난 데이터는 보여주지 않는다.
                if(getDDay(user.endtime) < -365)continue;
                
                if(user.isdeleteym){
                    var nym = parseInt(year)*12 + parseInt(month);
                    var oym = parseInt(stringGetYear(user.isdeleteym)) * 12 + parseInt(stringGetMonth(user.isdeleteym));
                    if(nym > oym)continue;                        
                }
                
                var brow = body.insertRow();
                brow.align = "center";
                

                
                var user_custom_percent = user["custompercent"] ? parseInt(user["custompercent"]) : 0;
                var couponid = user.id;
                var uid = user.uid;
                var percent = getPTPercent(manageruid,setting,total_getprice,user_custom_percent,fixpercent); //check
                var status = user["status"] ? user["status"] : "N";
                if(status == "N")status = checkStatusIsDelete(uid,couponid,manageruid);
                
                var totalcount  = user["totalptcount"] ? parseInt(user["totalptcount"]) : 0;
                var freecount  = user["freecount"] ? parseInt(user["freecount"]): 0;
                var usecount = parseInt(user["totalusecount"]);
                var setprice = parseInt(user["setprice"]);
                
                var orner_addnowuseptcount = user["orner_addnowuseptcount"] && parseInt(user["orner_addnowuseptcount"]) >= 0 ? parseInt(user["orner_addnowuseptcount"]) : 0;
                var nowusecount = parseInt(user["nowusecount"])+orner_addnowuseptcount;
                
                var removeptcount = user["removeptcount"] ? parseInt(user["removeptcount"]) : 0;
                
                var reservationcount = user["reservationcount"] ?  parseInt(user["reservationcount"]) : 0; //현재 예약승인(0값)인 상태횟수
                var totalremaincount = totalcount-usecount-removeptcount-reservationcount;
                //var percent_price = parseInt((setprice*percent)/100); //퍼센트 적용한 단가
                var beforeremaincount = parseInt(user["beforeremaincount"]);
                var getprice = 0;
                var color = i%2 == 0 ? "#ffffee": "#ffffee";
               
                brow.style.backgroundColor = color;
                brow.id = couponid;
                
                brow.name = "none";
                if (status != "N"){
                    brow.style.backgroundColor = "#aaaaaa";  
                    brow.name = "remove"
                
                } 
                
                //쿠폰이 이번달 등록한 쿠폰이라면
                var isnewuser = isThisMonth(couponid,year,month) ? true :false;
               
//                if(isThisMonth(couponid,year,month)){
//                    brow.style.backgroundColor = "#ffaaaa";
//                }
                
                    
                   
                
                var orner_totalcount =  user["orner_totalcount"] != undefined && user["orner_totalcount"] != null && parseInt(user["orner_totalcount"]) >= 0 ? parseInt(user["orner_totalcount"]) : -1; //등록최대(max)횟수
                var orner_freecount =  user["orner_freecount"] != undefined && user["orner_freecount"] != null &&  parseInt(user["orner_freecount"]) >= 0 ? parseInt(user["orner_freecount"]) : -1; //무료최대(max)횟수
                var orner_freecount_text = user["orner_freecount_text"] != undefined && user["orner_freecount_text"] != null && parseInt(user["orner_freecount_text"]) >= 0 ? parseInt(user["orner_freecount_text"]) : -1;
                var orner_1setprice = user["orner_1setprice"] != undefined && user["orner_1setprice"] != null  && parseInt(user["orner_1setprice"]) >= 0 ? parseInt(user["orner_1setprice"]) : -1;
                var orner_percentprice = user["orner_percentprice"] != undefined && user["orner_percentprice"] != null && parseInt(user["orner_percentprice"]) >= 0 ? parseInt(user["orner_percentprice"]) : -1;
                var orner_beforeptcount = user["orner_beforeptcount"] != undefined && user["orner_beforeptcount"] != null && parseInt(user["orner_beforeptcount"]) >= 0 ? parseInt(user["orner_beforeptcount"]) : -1;
                var orner_nowuseptcount = user["orner_nowuseptcount"] != undefined && user["orner_nowuseptcount"] != null && parseInt(user["orner_nowuseptcount"]) >= 0 ? parseInt(user["orner_nowuseptcount"]) : -1;
                var orner_remaincount = user["orner_nowuseptcount"] != undefined && user["orner_nowuseptcount"] != null && parseInt(user["orner_remaincount"]) >= 0 ? parseInt(user["orner_remaincount"]) : -1;
                
                if(isNaN(orner_totalcount))orner_totalcount = -1;
                if(isNaN(orner_freecount))orner_freecount = -1;
                if(isNaN(orner_1setprice))orner_1setprice = -1;
                if(isNaN(orner_percentprice))orner_percentprice = -1;
                if(isNaN(orner_beforeptcount))orner_beforeptcount = -1;
                if(isNaN(orner_nowuseptcount))orner_nowuseptcount = -1;
                if(isNaN(orner_remaincount))orner_remaincount = -1;
                
                
                //만약 설정된 무료최대횟수가 있다면 freecount를 설정된 무료최대횟수로 변경한다.
                if(orner_freecount_text >= 0)freecount = orner_freecount_text;
                
                var tcount = nowusecount+removeptcount;// 이번달진행횟수 +잔여세션승인횟수
                if (freecount > 0 && tcount > 0) {
                    totalremaincount = totalremaincount + freecount;

                    if (tcount >= freecount) {
                        tcount = tcount - freecount;
                        freecount = 0;
                    } else { //무료횟수가 이번달 이용횟수보다 크다.
                        freecount = freecount - tcount;
                        tcount = 0;
                    }

                }
                if(tcount < 0)tcount = 0;
                
                
                //오너 최대등록횟수가 있으면 이전 남은횟수를 수정한다.
                if(orner_totalcount > 0)beforeremaincount = beforeremaincount + orner_totalcount - totalcount;
                
                var new_maxcount = orner_totalcount != -1 ? orner_totalcount : totalcount;
                var new_beforeremaincount = orner_beforeptcount != -1  ? orner_beforeptcount : beforeremaincount;
                var new_setprice = orner_1setprice != -1  ? orner_1setprice : setprice;
                var new_percent_price = orner_percentprice != -1  ? orner_percentprice : parseInt((new_setprice*percent)/100);
                var base_percent_price = parseInt((new_setprice * percent) / 100); //퍼센트 적용한 단가
//                percent_price = new_percent_price;
                var new_nowuseptcount = orner_nowuseptcount != -1  ? orner_nowuseptcount : tcount;
                
                getprice = new_percent_price*new_nowuseptcount;
                total_get_percent_price += getprice;
                
                total_removeptcount += removeptcount; //footer 최종 총횟수
                if(new_beforeremaincount-new_nowuseptcount < totalremaincount)
                    totalremaincount = new_beforeremaincount-new_nowuseptcount;
                total_nowusecount += new_nowuseptcount;
                //남은횟수맞춤
                totalremaincount = new_beforeremaincount - (new_nowuseptcount + removeptcount);   orner_remaincount = -1;                        
                if(totalremaincount < 0 )totalremaincount = 0;
                
//                ///////////////////////////////////
//                //순번
//                ///////////////////////////////////
//                var index_tag = "<text style='color:white;font-size:13px' class='fmont'>"+(i+1)+"</text>";
//                insert_defaultcell(brow,50,index_tag);
                

//                //현재 진행하고 있다면 NEXT 아이콘을 삽입하지 않는다.
//                if(tcount <= 0)futureCouponCheck(brow,bcell_index,user["starttime"]);
                
                ///////////////////////////////////
                //이름
                ///////////////////////////////////
                var name_tag = "<text style='font-size:13px'>"+user["name"]+"</text>";
                insert_defaultcell(brow,70,name_tag,isnewuser);
                
                
                ///////////////////////////////////
                //등록일
                ///////////////////////////////////
                var starttime_tag = "<text style='font-size:13px' class='fmont'>"+user["id"].substr(0,10)+"</text>";
                insert_defaultcell(brow,100,starttime_tag,isnewuser);
                
                
                 ///////////////////////////////////
                //이번달진행횟수
                ///////////////////////////////////                
                var addnum = removeptcount > 0 ? removeptcount : "";                
                insert_cell(brow,"nowuseptcount",80,couponid,uid,idx,i,tcount,orner_nowuseptcount,false,addnum,isnewuser);//
               
                ///////////////////////////////////
                //획득금액
                ///////////////////////////////////                              
                var getprice_tag = "<text style='font-size:13px' class='fmont'>￦"+CommaString(getprice)+"</text>";
                insert_defaultcell(brow,100,getprice_tag,isnewuser);
                
                
                
                ///////////////////////////////////
                //등록횟수
                ///////////////////////////////////
                insert_cell(brow,"totalcount",80,couponid,uid,idx,i,totalcount,orner_totalcount,false,null,isnewuser);
                
               
                
                ///////////////////////////////////
                //단가
                ///////////////////////////////////                
                insert_cell(brow,"1setprice",80,couponid,uid,idx,i,setprice,orner_1setprice,true,null,isnewuser);//
                
                ///////////////////////////////////
                //퍼센트가격
                ///////////////////////////////////                
                insert_cell(brow,"percentprice",80,couponid,uid,idx,i,base_percent_price,orner_percentprice,true,null,isnewuser);//
                
                ///////////////////////////////////
                //이전남은횟수
                ///////////////////////////////////                
                insert_cell(brow,"beforeptcount",110,couponid,uid,idx,i,beforeremaincount,orner_beforeptcount,false,null,isnewuser);//
                
                
                ///////////////////////////////////
                //전체남은횟수
                ///////////////////////////////////                
                insert_cell(brow,"remaincount",80,couponid,uid,idx,i,totalremaincount,orner_remaincount,false,null,isnewuser);//
 
                
                
                ///////////////////////////////////
                //무료횟수
                ///////////////////////////////////                
                insert_cell(brow,"freecount",80,couponid,uid,idx,i,freecount,orner_freecount,false,orner_freecount_text,isnewuser);
                
                
                ///////////////////////////////////
                //페이롤 상태
                ///////////////////////////////////                    
                //페이롤 상태값 : 'N' : 일반 ,'D' : 삭제,'R' : 환불, 'M' : 이동(담당자변경)
                var txt_status = {
                    "N": "일반",
                    "D": "삭제됨",
                    "R": "환불됨",
                    "S": "양도됨",
                    "M": "담당자 변경됨"
                };  
                var desc_tag = "";
                if (status != "N"){
                    var desc = "";
                    if(user.isdeletedesc)desc = "<text style='font-size:13px; border-radius : 4px;font-size:14px;padding:5px'>"+user.isdeletedesc+"</text>";
                    if(user.desc)desc += user.desc+"";
                    desc_tag = txt_status[status]+" "+desc;
                }else{
                     if(user.desc)desc_tag = "<text style='font-size:13px; border-radius : 4px;font-size:14px;padding:5px'>"+user.desc+"</text>";
                }
                insert_defaultcell(brow,100,desc_tag,isnewuser);
            }
            
        }
        var thead_style = "background-color:"+mColor.C222222+";border-right:1px solid "+mColor.C2e2e2e;
         table.innerHTML += "<thead><tr style='background-color:"+mColor.C222222+";height:37px;color:white;font-size:13px'><th style='"+thead_style+"'>이름</th><th style='"+thead_style+"'>등록일</th><th style='"+thead_style+"'>진행횟수</th><th style='"+thead_style+"'>수업료</th><th style='"+thead_style+"'>등록횟수</th><th style='"+thead_style+"'>단가</th><th style='"+thead_style+"'>퍼센트</th><th style='"+thead_style+"'>이전남은횟수</th><th style='"+thead_style+"'>남은횟수</th><th style='"+thead_style+"'>무료횟수<br>[<span style='font-size:9px;color:#ff0000'>최대</span>/<span style='font-size:9px;color:#ffffff'>남은횟수</span>]<th style='"+thead_style+"'>상태</th></tr></thead>";
//        table.innerHTML += "<thead><tr style='background-color:"+mColor.C222222+";height:37px;color:white;font-size:13px'><th style='"+thead_style+"'>이름</th><th style='"+thead_style+"'>등록일</th><th style='"+thead_style+"'>금액</th><th style='"+thead_style+"'>상태</th></tr></thead>";
//         var head = table.getElementsByTagName("thead")[0];
        
        
        div.append(table);
        var head = table.getElementsByTagName("thead")[0];
        if (len > 0) {
            //헤더부분 퍼센트를 삽입하기 위함  
            var isfixpercent = fixpercent > 0 ? true : false;
            var hpercent = getPTPercent(manageruid,setting,total_getprice,null,fixpercent); //check       
            for(var i = 0 ;i  < head.children[0].children.length;i++)
                if(head.children[0].children[i].innerHTML == "퍼센트")
                    head.children[0].children[i].innerHTML =  isfixpercent ? "<text style='color:#999999'>ⓕ"+hpercent + "%</text>" : "<text>"+hpercent + "%</text>" ;
         }
        var resturndata = {"tag":div.innerHTML, "totalnowusecount":total_nowusecount, "totalgetprice":total_get_percent_price, "totalremoveptcount":total_removeptcount};
        
        return resturndata;

    }
   
    //rows = users 고객들 데이타
    
     //rows = users 고객들 데이타
    function checkStatusIsDelete(uid,couponid,managerid){

        var rflg = "N";
        for(var i = 0 ; i < status_isdelete_arr.length; i++){
            if(status_isdelete_arr[i].uid == uid && status_isdelete_arr[i].couponid == couponid){


                if(status_isdelete_arr[i].isdelete == "D")
                    rflg = "D";
                if(status_isdelete_arr[i].issendedcoupon == "-1")
                    rflg = "S";
                if(status_isdelete_arr[i].status == "M")
                    rflg = status_isdelete_arr[i].status;
                if(status_isdelete_arr[i].managerid != managerid)
                    rflg = "M";
                if(status_isdelete_arr[i].repay != 0)
                    rflg = "R";
                break;
            }
        }
        return rflg;
    }
    function futureCouponCheck(brow,cell,starttime){
        var now = new Date();
        var nowyear = now.getFullYear();
        var nowmonth = now.getMonth()+1;
        clog("nowyear "+nowyear+" nowmonth "+nowmonth);
//        if(stringGetYear(starttime) > nowyear || stringGetYear(starttime) == nowyear && stringGetMonth(starttime) > nowmonth){
//            brow.style.backgroundColor = "#aaaaaa";
//            cell.innerHTML = "<img src='./img/icon_next.png' title='시작일이 이번달 이후일때 NEXT 아이콘이 표시됩니다.'/>"+cell.innerHTML;
//        }
    }
    function insert_defaultcell(brow,width,tag,isnewuser){
        
        var cell = brow.insertCell();
        cell.style.border =  "1px solid "+mColor.C292929;
        
        cell.style.padding = "5px";
        cell.style.color = brow.name == "none" ? "white" : mColor.C5b5b5b;
        cell.style.backgroundColor = brow.name == "none" ?  mColor.C191919 : mColor.C111111;
        if(isnewuser)cell.style.backgroundColor = "#411d1d";
        cell.style.minWidth = width+"px";
        
        
//        if(isfixed){           
////            cell.style.borderRight = "1px solid "+mColor.C292929;
//        }
        cell.innerHTML = tag;
    }
    function insert_cell(brow,cellname,width,couponid,uid,idx,i,_default_value,_orner_value,isicon,_addnum,isnewuser){
        //var freeaddtag = _addnum && cellname == "freecount" ? _addnum : "";
        
        var freeaddtag = cellname == "freecount" && _addnum && parseInt(_addnum) != -1 ? "&nbsp;<text style='color:red;font-weight:bold;'>"+_addnum+"/</text>" : "";
        var addtag = _addnum && cellname != "freecount"  ? _addnum : "";
//        clog(couponid+" _orner_value ",_orner_value);
         if(cellname == "nowuseptcount" && _addnum)
            addtag = "&nbsp;<text style='color:red;font-weight:bold;'>(" + _addnum + ")</text>";
        
        if(isNaN(_orner_value)){
            _orner_value = "-1";
        }
        var default_value = isicon ? CommaString(_default_value) : _default_value;
        var orner_value =  isicon ? CommaString(_orner_value) : _orner_value;
        var icon = isicon ? "" : "";
        //등록횟수 총횟수
        
        var cell = brow.insertCell();
        cell.style.border = "1px solid "+mColor.C292929;        
        cell.style.padding = "5px";
        cell.style.color = brow.name == "none" ? "white" : mColor.C5b5b5b;
        cell.style.backgroundColor = brow.name == "none" ?  mColor.C191919 : mColor.C111111;
        if(isnewuser)cell.style.backgroundColor = "#411d1d";
        cell.style.minWidth = width+"px";

        
        var tvalue = default_value; //기본값
        var nvalue = "";
        var ivalue = _default_value; //기본값
         if(_orner_value+"" != "-1"){
            tvalue = "<del>"+default_value+"</del>";  //default value
            nvalue = orner_value; //오너설정값    new value
            ivalue = _orner_value; //오너 설정값  input value 
        }
        
        cell.innerHTML = freeaddtag+"<text id='text_"+cellname+"_"+idx+"_"+i+"' style='align:center;width:100%;'>"+icon+tvalue+"</text>&nbsp;<text id='ctext_"+cellname+"_"+idx+"_"+i+"' style='align:center;width:100%;color:"+mColor.YELLOW+";font-weight: bold;'>"+icon+nvalue+"</text>"+addtag;
    }
    function arrowClick(leftright){
        
        //left
        if(leftright == 0){
            if(month == 1){
                month = 12;
                year = year-1;
            }else {
                month--;
            }    
        }
        //right
        else {
            if(month == 12){
                month = 1;
                year = year+1;
            }else{
                month++;
            }  
        }
        getMyTranerHistory(now_centercode,year,month);
        
    }
    function listClick(manageruid,index) {

            if(!isClickMoreTotal){
                if ($(".sub" + index).is(":visible")) {
                    
                    $(".sub" + index).slideUp(100);
                    before_index = -1;
                    list_open(index, false);
                    
                    if(isadmin == "Y")
                        updownclick(manageruid,false);
                } else {
                    //            clog("down ");
                    $(".sub" + index).slideDown(150);
                    before_index = index;
                    list_open(index, true);
                    if(isadmin == "Y")
                        updownclick(manageruid,true);

                }
            }
            isClickMoreTotal = false;
        }

        function list_open(index, isopen) {

            if (isopen) {
                var data = {
                    "year": year,
                    "month": month,
                    "index": index
                };

                var isin = false;
                for (var i = 0; i < openlist.length; i++) {
                    if (openlist[i].year == year && openlist[i].month == month && openlist[i].index == index) {
                        isin = true;
                        break;
                    }
                }
                if (!isin)
                    openlist.push(data);
            } else {

                var popindex = -1;
                for (var i = 0; i < openlist.length; i++) {
                    if (openlist[i].year == year && openlist[i].month == month && openlist[i].index == index) {
                        popindex = i;
                        break;
                    }
                }
                if (popindex >= 0)
                    openlist.splice(popindex, 1);
            }

            //        clog("openlist is ",openlist);
        }

        function checkOpenList(year, month) {
            for (var i = 0; i < openlist.length; i++) {
                if (openlist[i].year == year && openlist[i].month == month) {
                    $(".sub" + openlist[i].index).slideDown(150);
                    
                }
            }
        }

        function allListOpen(len) {
            for (var i = 0; i < len; i++){
                $(".sub" + i).slideDown(150);
                if(isadmin == "Y"){
                    
                    var bgs = document.getElementsByClassName("traner_bg");
                    for (var a = 0; a < bgs.length; a++) 
                        bgs[a].style.height = "auto";
                    
                    var pdivs = document.getElementsByClassName("div_total_tranerprice");
                    for (var a = 0; a < pdivs.length; a++) 
                        pdivs[a].style.display = "block";
                    
                }
            }                
        }

        function allListClose(len) {
            for (var i = 0; i < len; i++){
                $(".sub" + i).slideUp(100);
                if(isadmin == "Y"){
                    
                    var bgs = document.getElementsByClassName("traner_bg");
                    for (var a = 0; a < bgs.length; a++) 
                        bgs[a].style.height = "90px";
                    
                    var pdivs = document.getElementsByClassName("div_total_tranerprice");
                    for (var a = 0; a < pdivs.length; a++) 
                        pdivs[a].style.display = "none";

                }
            }        
        }
     function allOpen() {
            var btn_allopen = document.getElementById("btn_allopen");
            var btn_allclose = document.getElementById("btn_allclose");
            btn_allopen.style.display = "none";
            btn_allclose.style.display = "block";
            allListOpen(alllist.length);
        }

        function allClose() {
            var btn_allopen = document.getElementById("btn_allopen");
            var btn_allclose = document.getElementById("btn_allclose");
            btn_allopen.style.display = "block";
            btn_allclose.style.display = "none";
            allListClose(alllist.length);
        }
</script>




