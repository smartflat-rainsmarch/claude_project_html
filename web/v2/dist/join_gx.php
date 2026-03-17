<?php  
include('./common.php'); //아직 회원가입 페이지가 어디로 가야할지 모르겠다.

if(isset($_SESSION['authgroup'.DEV_REAL]) && $_SESSION['authgroup'.DEV_REAL] < AUTH_TRANER){

    echo "<script>alertMsg('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$re_uid = isset($_POST['mem_uid']) ? $_POST['mem_uid'] : '';
$re_userid = isset($_POST['mem_userid']) ? $_POST['mem_userid'] : '';
$re_name = isset($_POST['mem_username']) ? $_POST['mem_username'] : '';
$re_birth = isset($_POST['mem_birth']) ? $_POST['mem_birth'] : '';
$re_phone = isset($_POST['mem_phone']) ? $_POST['mem_phone'] : '';
$re_gender = isset($_POST['mem_gender']) ? $_POST['mem_gender'] : '';
$re_homeaddress = isset($_POST['mem_homeaddress']) ? $_POST['mem_homeaddress'] : '';
$re_lockernumber = isset($_POST['mem_lockernumber']) ? $_POST['mem_lockernumber'] : '';
$re_lockerpass = isset($_POST['mem_lockerpass']) ? $_POST['mem_lockerpass'] : '';
$re_starttime = isset($_POST['mem_starttime']) ? $_POST['mem_starttime'] : '';
$re_endtime = isset($_POST['mem_endtime']) ? $_POST['mem_endtime'] : '';
$re_reservation = isset($_POST['mem_reservation']) ? json_decode($_POST['mem_reservation'],true) : '';


$re_last_reservation_id = ""; 
$re_last_reservation_mbsidx = 0;
$re_managerid = "";
if($re_reservation != ''){
    
    for($i = 0 ;$i < count($re_reservation); $i++){
        if($i == 0)$re_last_reservation_id = $re_reservation[$i]["id"];        
        if($i > 0 && strtotime($re_reservation[$i]["id"]) > strtotime($re_last_reservation_id)){
            $re_last_reservation_id = $re_reservation[$i]["id"];
            $re_last_reservation_mbsidx = $re_reservation[$i]["mbsidx"];
            $re_managerid = $re_reservation[$i]["manager"];
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="icon" type="image/gif/png" href="img/black_arc_logo.png">
    <title>Join</title>
    <!--   signature about -->
    <style>
        body {
            font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

    </style>

    <link href="./css/modaldialog.css" rel="stylesheet">

    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dd.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <script src="js/scripts.js?ver3.02ae4"></script>
    <script src="jquery.dd.min.js"></script>
    <!--	<link href="./css/styles.css" rel="stylesheet">-->
    <!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->

    <!--
    <link href="signature/assets/jquery.signaturepad.css" rel="stylesheet">
    <script src="signature/assets/numeric-1.2.6.min.js"></script>
    <script src="signature/assets/bezier.js"></script>
    <script src="signature/jquery.signaturepad.js"></script>
    <script src="signature/assets/json2.min.js"></script>
-->

    <style>
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

    </style>

</head>

<body style="background-color:#eeeeee">
    <script src="signature_pad.min.js"></script>
    <script src="signature/assets/json2.min.js"></script>
    <br><br>
    <h1 align="center" class="textevent" style="font-size:2em">P.T회원가입 양식</h1><br>
    <div class='form-control' align='center'>
        <button class="btn btn-default btn-raised" id="txt_rejoin_user" style="background-color:ff6666;font-size:30px;display:none;color:white">재등록중..</button>
        
    </div>
    <hr style="border: solid 1px light-gray;">
    <div id="join">

        <div id='container' class="container">
            fdsafdsa
        </div>
        <div align='center' class='form-group row'>
            <div id='pt_formdiv1' style='width:100%;' class='col-12 offset-0'>
                <div align='center' id='signdiv1' style='width:600px;text-align: center;'>
                    <label for='signpad1'>(서명) 약관의 모든 내용을 숙지하였으며, 이에 동의합니다.</label>
                    <div id='signpad1'>
                        <label style='color:gray'>※이름 입력란</label>
                        <div style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;margin-left:200px'></div>
                        <div style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;margin-left:400px'></div>
                        <div class='wrapper' style='background-color: #ffffff'>
                            <canvas id='signature-pad-name1' class='signature-pad-name1' width=800px height=200px></canvas>
                        </div>
                        <div>
                            <button id='clear' onclick='clear_sign1(1)'>이름다시쓰기</button>
                        </div>
                        <hr style='border: solid 1px light-gray;'>
                        <label style='color:gray'>※서명란</label>
                        <div class='wrapper' style='background-color: #ffffff'>
                            <canvas id='signature-pad-sign1' class='signature-pad-sign1' width=800px height=200px></canvas>
                        </div>
                        <div>
                            <button id='clear' onclick='clear_sign1(2)'>서명다시하기</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <p align="right"><button onclick="btn_register()" class="btn btn-primary btn-raised" style='margin-right:10%'>재등록하기</button></p><br><br>
    </div>

</body>

</html>
<script>
    var canvasName1 = document.getElementById('signature-pad-name1');
    var canvasSign1 = document.getElementById('signature-pad-sign1');
    var signaturePadName1 = null;
    var signaturePadSign1 = null;
    var cInterval = setInterval(function() {
        if ($('#signpad1').width() > 10) {
            canvasName1.width = $('#signpad1').width();
            canvasSign1.width = $('#signpad1').width();
            signaturePadName1 = new SignaturePad(document.getElementById('signature-pad-name1'), {
                backgroundColor: 'rgba(255, 255, 0, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            signaturePadSign1 = new SignaturePad(document.getElementById('signature-pad-sign1'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            clearInterval(cInterval);
        }
    });

    function clear_sign1(type) {
        clog("clear sign!!");
        if (type == 1)
            signaturePadName1.clear();
        else
            signaturePadSign1.clear();

    }

    var total_price = 0;

    var param_pagetype = getParam("pagetype");
    var selected_pt = null;
    var re_obj = new Object();
    var reregist = 0;
    //var nowcentercode = getData("nowcentercode");
    var nowcentercode = getParam("centercode");
    
    var json_price = {};


    var listenInterval = null;
    var txt_ptgx = [{
        "trainingname": "P.T",
        "teachername": "트레이너"
    }, {
        "trainingname": "GX",
        "teachername": "강사"
    }]
    try {
        if (window.android) window.android.setOrientation("portrait");
    } catch (e) {}

    var teacherlist = [];
    //        initInputSelectYMD(document.getElementById("yy"), document.getElementById("mm"), document.getElementById("dd"));
    var termtype_desc = "";
    var counttype_desc = "";
    var allcenters = null;
    var mbs_coupons = [];
    var auth = "<?php echo $auth; ?>";
    $(document).ready(function() {


        


        var groupcode = "<?php echo $groupcode; ?>";
        var centercodes = "<?php echo $centercodes; ?>";
        savekey = "<?php echo $id; ?>";
        var centers = centercodes.split(',');
        auth = "<?php echo $auth; ?>";

        var _data = {
            "type": "auth", // group or center or auth
            "group": groupcode,
            "auth": auth
        };

        CallHandler("getdata", _data, function(res) {
            code = parseInt(res.code);
            clog("auth res ", res);
            if (code == 100) {
                var arr = res.message;



            } else {
                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });


        var _data = {
            "type": "center", // group or center or auth
            "group": groupcode
        };

        CallHandler("getdata", _data, function(res) {
            code = parseInt(res.code);
            if (code == 100) {
                var arr = res.message;

                allcenters = arr;

//                for (var i = 0; i < allcenters.length; i++) {
//                    if (allcenters[i].centercode == getData("nowcentercode")) {
//                        nowcentercode = allcenters[i].centercode;
//                        break;
//                    }
//
//                }
                setMembership(nowcentercode);


            } else {
                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });
        
        checkRegisteredUser();

        showOnOffRejoinAni();
    });
  
    var onoffcount = 0;
    var onoffInterval = null;

    function showOnOffRejoinAni() {
        onoffcount = 0;
        var txt_rejoin_user = document.getElementById("txt_rejoin_user");
        if (onoffInterval) {
            clearInterval(onoffInterval);
            onoffInterval = null;
        }
        txt_rejoin_user.style.display = "block";
        onoffInterval = setInterval(function() {
            if (onoffcount % 2 == 1)
                txt_rejoin_user.style.visibility = "hidden";
            else
                txt_rejoin_user.style.visibility = "visible";
            onoffcount++;
        }, 1000);
    }

    function hideOnOffRejoinAni() {
        onoffcount = 0;
        var txt_rejoin_user = document.getElementById("txt_rejoin_user");
        if (onoffInterval) {
            clearInterval(onoffInterval);
            onoffInterval = null;
        }
        txt_rejoin_user.style.display = "none";
    }
    var constructor_name_option_tag = "";
    function setTeachers(centercode) {
        
        if (centercode == null) return;
        my_centercode = centercode;
        var _data = {
            "type": "teachers", // group or center or auth
            "mbs_centercode": centercode
        };
        
        CallHandler("getdata", _data, function(res) {
            code = parseInt(res.code);
            if (code == 100) {
//                if (res.message.length == 0) return;
                
                teacherlist = res.message;
               
                getPTJoin();
                
                
                constructor_name_option_tag = "<option value=''>== 강사를 선택하세요 ==</option>";
                for(var i = 0 ; i < teacherlist.length; i++){
                    constructor_name_option_tag += "<option value='"+teacherlist[i].mem_uid+"'>"+teacherlist[i].mem_username+"</option>";
                }

            } else {
                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });

    }
    //이미 가입된 유저정보가 있으면 가져와서 세팅한다.
    function checkRegisteredUser() {

        re_obj.uid = "<?php echo $re_uid; ?>";
        re_obj.userid = "<?php echo $re_userid; ?>";
        re_obj.name = "<?php echo $re_name; ?>";
        re_obj.birth = "<?php echo $re_birth; ?>";
        re_obj.phone = "<?php echo $re_phone; ?>";
        re_obj.gender = "<?php echo $re_gender; ?>";
        re_obj.homeaddress = "<?php echo $re_homeaddress; ?>";
        re_obj.lockernumber = "<?php echo $re_lockernumber; ?>";
        re_obj.lockerpass = "<?php echo $re_lockerpass; ?>";
        re_obj.starttime = "<?php echo $re_starttime; ?>";
        re_obj.endtime = "<?php echo $re_endtime; ?>";
        re_obj.constructorname = username;
        re_obj.constructoruid = "<?php echo $uid; ?>";


    }

    function getPTJoin() {
        var obj = new Object();
        obj.uid = "<?php echo $uid; ?>";
        obj.id = "<?php echo $id; ?>";
        obj.type = "ptrule";
        obj.centercode = nowcentercode;
        if (obj.centercode) {
            CallHandler("getptrule", obj, function(res) {
                var code = parseInt(res.code);
                if (code == 100) {
                    ptruledata = res.message;


                    //일반회원가입에서 가져올 수 있는 값들
                    var obj = new Object();
                    obj.pt_name = re_obj.name;
                    obj.pt_phone = re_obj.phone;
                    //                        obj.pt_paymenttype = document.getElementById("payment_type").value;
                    //                        obj.pt_starttime = document.getElementById("termtype_starttime").value;
                    //                        obj.pt_endtime = document.getElementById("termtype_endtime").innerHTML;

                    showPTJoinPopup(ptruledata, obj);

                } else {
                    alertMsg(res.message);
                }
            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
        }

    }

    function setMembership(centercode) {
        clog("join_pt centercode is "+centercode);
        if (centercode == null) return;
        my_centercode = centercode;
        var _data = {
            "type": "membership", // group or center or auth
            "mbs_centercode": centercode
        };
        
        CallHandler("getdata", _data, function(res) {
            code = parseInt(res.code);
            if (code == 100) {
                if (res.message.length == 0) return;

                mbs_coupons = res.message;

                 mbs_coupons.sort(sort_by('mbs_type', true, (a) => a.toUpperCase()));


                setTeachers(centercode);
            }
        });
    }
    function getMembershipTag(){
      
        var message = document.createElement("div");
        
        
        message.innerHTML = "<input id='pt_count' type='number' onfocus='this.select()' onkeyup='checkAllPrice()' style='width:60px' value='0' />회";     
        
        return message.innerHTML;
    }
    function showPTJoinPopup(ptruledata, obj) {
       
//        var sdate = new Date(re_obj.starttime);
//        var edate = new Date(re_obj.endtime);
        var stime = getToday();
        

        var container = document.getElementById("container");

        var tlist = "<option value=''>== 담당트레이너를 선택하세요 ==</option>";
        for (var i = 0; i < teacherlist.length; i++)
            tlist += "<option value='" + teacherlist[i].mem_uid + "' data-image='" + teacherlist[i].mem_photo + "'>" + teacherlist[i].mem_username + " 트레이너</option>";

        var ispaymentdate = auth >= AUTH_OPERATOR ? "" : "disabled";
        container.innerHTML = "<div align='left' >" + ptruledata + "</div><br>" +
            "<p align='center'><input type='checkbox' id='check_pt_desc'>&nbsp;규정에 관한 설명을 충분히 들었으며 이에 동의합니다.&nbsp;&nbsp;&nbsp;</p>" +
            "<div align='left' class='form-group row'>" +
                "<div id='pt_formdiv' style='padding:50px;' class='col-12 offset-0'>" +
                    "<div class='form-control'>" +

                    "<label class='textevent'>회원번호 : " + re_obj.userid + "<input id='id_payment_date' type='date' style=' float:right;font-size:14px' value='<?php echo date('Y-m-d'); ?>' "+ispaymentdate+"/><text style='font-size:16px;font-weight:bold;color:blue;float:right;'>결제일 :&nbsp;</text></label>" +
                    "<hr style='border: solid 1px light-gray;'>" +

                    "<table style='width:100%'>" +

                        "<tr>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>*이름</label>" +
                            "</td>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>*휴대폰 번호</label>" +
                            "</td>" +
                            "<tr>" +
                            "</tr>" +
                            "<td>" +
                                    "<text class='form-control' id='pt_name' name='pt_name' placeholder='ex) 홍길동' align='center-vertical' style='margin:auto' value='" + re_obj.name + "'>" + re_obj.name + "</text>" +
                            "</td>" +
                            "<td>" +
                                "<input class='form-control' id='pt_phone' name='pt_phone' placeholder='ex) 010-1234-5678' style='margin:auto' value='" + re_obj.phone + "'/>" +
                            "</td>" +
                        "</tr>" +

                        "<tr>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>계약트레이너</label>" +
                            "</td>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>*담당트레이너 선택</label>" +
                            "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>" +
                                "<select class ='form-control' id='constructor_name'  style=''>"+constructor_name_option_tag+"</select>" + //가입시킨 사람 이름
                               
                            "</td>" +
                            "<td>" +
                                "<div class='form-control'>" +
                                    "<input id='pt_traner_am' type='radio' name='ampm' value='AM' style='margin-top:10px' checked>&nbsp;오전&nbsp;&nbsp;<input id='pt_traner_pm' type='radio' name='ampm' value='PM'>&nbsp;오후&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>" +
                                    "<span>" +
                                    "<select id='pt_teachers_list' style='width:300px;' name='pt_teachers_list' required>" + tlist +
                                    "</select>" +
                                    "</span>" +
                                "</div>" +
                            "</td>" +
                        "</tr>" +

                        "<tr>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>* P.T 시작일</label>" +
                            "</td>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>* P.T 종료일</label>" +
                            "</td>" +
                        "<tr>" +
                        "</tr>" +
                            "<td>" +
                                "<div class='form-control'>" +
                                    "<input id='pt_starttime' type='date'  min='"+getToday()+"' value = '"+stime+"'/>" +
                                "</div>" +
                            "</td>" +
                            "<td>" +
                                "<div class='form-control'>" +
                                    "<input id='pt_endtime'  min='"+getToday()+"' type='date'/>" +
                                "</div>" +
                            "</td>" +
                        "</tr>" +


                        "<tr>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>총 Session</label>" +
                            "</td>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>* P.T 가격설정</label>" +
                            "</td>" +

                        "</tr>" +
                        "<tr>" +
                            "<td>" +
                                "<div class='form-control' style='padding:18px;height:70px'>" +            
                                    "<span>"+getMembershipTag()+"<text id='pt_count' style='display:none'></text></span><span style='float:right;'><button  id='service_pt_arrow_l' onclick='show_service_pt(1)' class='btn btn-primary btn-raised' style='margin-right:10%'>◀</button><button  id='service_pt_arrow_r' onclick='show_service_pt(2)' class='btn btn-primary btn-raised' style='margin-right:10%;display:none'>▶</button></span><span id='span_service_pt' style='float:right;margin-top:-20px;display:none'><select onchange='change_service_pt()'  id='select_service_pt' class='form-control' style='margin-top:20px;width:90px'><option value='0'>추가세션</option><option value='1'>+1회</option><option value='2'>+2회</option><option value='3'>+3회</option><option value='4'>+4회</option><option value='5'>+5회</option></select></span>"+
                                "</div>" +
                            "</td>" +
                            "<td>" +
                                "<div class='form-control' onchange='checkAllPrice(0)'>" +
                                    "총수업료:&nbsp;<input id='pt_pricetotal' onfocus='this.select()' type='text' style='width:130px' onkeyup='inputChangeComma(\"pt_pricetotal\")'  style='width:80px' value='0' />원<br>" +
                                    "<div id ='div_vat_text' style='display:none'><text id='pt_pricevat' style='color:blue;'></text><br></div>"+
                                    "1회당 :&nbsp;<text id='pt_price1set'>0</text>원" +
                                "</div>" +
                            "</td>" +

                        "</tr>" +


                        "<tr>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>* 환불시 회당 적용단가</label>" +
                            "</td>" +
                            "<td style='width:50%'>" +
                                "<label class='textevent'>결제 방법</label>" +
                            "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td>" +
                                "<div class='form-control'style='padding:8px;height:50px'>" +
                        //            "<input id='pt_pricerefund' type='text'  onkeyup='inputChangeComma(\"pt_pricerefund\")' onfocus='this.select()' style='width:100px;' value='0' />원" +
                                     "<span style='float:left;'><input id='pt_pricerefund' type='text' onfocus='this.select()' onkeyup='inputChangeComma(\"pt_pricerefund\")' onchange='checkAllPrice()'  style='width:100px;' value='0' />원</span><span style='float:right;'><text id = 'txt_refund_vat' style='color:blue;visiblity:hidden'></text></span>"+  
                                "</div>" +
                            "</td>" +
                            "<td>" +

                                "<select id='pt_paymenttype' onchange='checkAllPrice(100)' class='form-control' name='payment_type' style='height:50px' required>" +
                                "<option value=''>== 결제방법을 선택하세요 ==</option>" +
                                "<option value='1'>카드결제</option>" +
                                "<option value='2'>현금결제</option>" +
                                //"<option value='3'>환불</option>" +
                                "<option value='4'>카드+현금</option>" +
                                "</select>" +

                            "</td>" +
                        "</tr>" +
                        "<tr>"+
                            "<td colspan='2'>"+          
                                "<div class='form-control' id='div_service_pt_desc' style='width:100%;display:none'>"+  
                                    "<input type='checkbox' id='check_service_pt' >&nbsp;<text id='txt_service_pt_desc' style='font-size:18px;color:red'>*환불시 서비스 수업에 대한 가격은 포함되지 않습니다.</text>"+
                                "</div>"+
                            "</td>"+                                                                 
                        "<tr>"+                                                 


                    "</table>" +
                    "<text id='txt_vat' style='font-size:24px;color:red;display:none;padding:20px'>+ VAT 10% 추가</text>"+
                    "</div>" +
                    "<div id = 'div_price_total'>"+
                        "<label for='payment_type' class='textevent'>최종금액</label>"+
                        "<div class='form-control'>"+
        //                     "<text id = 'txt_all_price'  class='form-control' style='padding:10px;color:red;'></text>"+
                             "<table id ='table_totalprice' style='width:100%;' >"+
                                "<tr style='width:100%'>"+
                                    "<td style='width:200px;display:none'>"+
                                        "<label class='textevent'>현금 총액</label>"+
                                    "</td>"+
                                    "<td style='width:200px'>"+
                                        "<label class='textevent'>카드</label>"+
                                    "</td>"+
                                    "<td style='width:200px'>"+
                                        "<label class='textevent'>현금</label><br>"+
                                    "</td>"+
                                    "<td style='width:200px'>"+
                                        "<label class='textevent'>미수금</label><br>"+
                                    "</td>"+
                                    "<td style='width:100%'>"+
                                        "<label class='textevent'>총금액</label><br>"+ 
                                    "</td>"+
                                 "</tr>"+
                                 "<tr>"+
                                    "<td style='min-width:120px; background-color:yellow;display:none'>"+
                                        "<input type='text' class='form-control' id='id_cash_total' onfocus='this.select()' placeholder='현금기준 총금액' disabled>"+
                                    "</td>"+
                                    "<td style='min-width:120px'>"+
                                       "<input type='text' class='form-control' id='id_price_card' onkeyup='checkAllPrice(1)' onfocus='this.select()' placeholder='카드 결제금액...' value ='0' novalidate>"+    
                                    "</td>"+
                                    "<td style='min-width:120px'>"+
                                       "<input type='text' class='form-control' id='id_price_cash' onkeyup='checkAllPrice(2)' onfocus='this.select()' placeholder='현금 결제금액...' value ='0' novalidate>"+
                                    "</td>"+
                                    "<td style='min-width:120px'>"+
                                       "<input type='text' class='form-control' id='id_price_remain'  onkeyup='checkAllPrice(3)' onfocus='this.select()' placeholder='미수금 가격...' value ='0'>"+    
                                    "</td>"+
                                    "<td>"+
                                        "<input type='text' class='form-control' id='id_price_total' placeholder='총 금액...' value='0'disabled>"+
                                    "</td>"+
                                 "</tr>"+
                            "</table>"+
                        "</div>"+
                    "</div>"+

                "</div>"+
            "</div>";


//        var btn_change_constructor = document.getElementById("btn_change_constructor");
//        btn_change_constructor.style.display = auth >= AUTH_MANAGER && getDevice() == "PC" ? "block" : "none";
        checkAllPrice();
        
//        var select = document.getElementById("counttype_coupon");
//        var last_reservation_mbsidx = "<?php echo $re_last_reservation_mbsidx; ?>";
//        for (var i = 0; i < select.children.length; i++) {
//            if (parseInt(select.children[i].value) == last_reservation_mbsidx) {
//                select.selectedIndex = i;
//                break;
//            }
//        }
//        counttype_visible_change();
        
    }
    function change_service_pt(isshow){
            var div_service_pt_desc = document.getElementById("div_service_pt_desc");
            var select_service_pt_value = document.getElementById("select_service_pt").value;
            var check_service_pt = document.getElementById("check_service_pt");
            var txt_service_pt_desc = document.getElementById("txt_service_pt_desc");
            if(select_service_pt_value == "0"){
                div_service_pt_desc.style.display = "none";
                check_service_pt.checked = false;
            }else{
                div_service_pt_desc.style.display = "block";
                txt_service_pt_desc.innerHTML = "S.V "+select_service_pt_value+"회&nbsp;&nbsp;&nbsp;&nbsp;환불시 서비스 수업에 대한 가격은 포함되지 않습니다.";
            }
            
        }
    function show_service_pt(isshow){
        var span_service_pt = document.getElementById("span_service_pt");
        var service_pt_arrow_l = document.getElementById("service_pt_arrow_l");
        var service_pt_arrow_r = document.getElementById("service_pt_arrow_r");
        var select_service_pt = document.getElementById("select_service_pt");
        if(isshow == 1){
            span_service_pt.style.display = "block";    
            service_pt_arrow_l.style.display = "none";
            service_pt_arrow_r.style.display = "block";
        }else {
            select_service_pt.value = "0";
            span_service_pt.style.display = "none";    
            service_pt_arrow_l.style.display = "block";
            service_pt_arrow_r.style.display = "none";
        }
        change_service_pt(isshow);
        
    }
//    function onchange_ptprice(){
//         var pt_paymenttype = document.getElementById("pt_paymenttype").value ? parseInt(document.getElementById("pt_paymenttype").value) : 0;
//        var pt_count =  parseInt(document.getElementById("pt_count").value);
//        var pt_1set =  document.getElementById("pt_price1set");
//        var pt_pricetotal = document.getElementById("pt_pricetotal");
//        var pt_total = document.getElementById("pt_pricetotal").value;
//        var pt_pricerefund = document.getElementById("pt_pricerefund");//환불시 회당단가
//        var pt_vat = pt_paymenttype == 1 ? 11 : 10;
//        var refundprice = parseCommaInt(pt_pricerefund.value);
//         var txt_refund_vat = document.getElementById("txt_refund_vat");//환불시 단가 VAT10% 텍스트
//        for (var i = 0; i < mbs_coupons.length; i++) {
//            if (mbs_coupons[i].mbs_type == "PT" && mbs_coupons[i].mbs_max_count > 0) {
//                selected_pt = mbs_coupons[i];
//                break;
//            }
//        }
//        //카드결제
//        if(before_pt_paymenttype != 1 && pt_paymenttype == 1){
//            pt_pricetotal.value = CommaString(Math.floor(pt_total*pt_vat/10));
//            pt_total = parseCommaInt(pt_pricetotal.value);    
//            pt_pricerefund.value = CommaString(Math.floor(refundprice*pt_vat/10));
//            txt_refund_vat.innerHTML = "(VAT 10% "+CommaString(Math.floor(refundprice/10))+" 원)";
//            clog("card!!");
//        }
//        //현금결제
//        else if(before_pt_paymenttype == 1 && pt_paymenttype != 1){
//            pt_pricetotal.value = CommaString(Math.floor(pt_total/11*10));
//            pt_total = parseCommaInt(pt_pricetotal.value);    
//            pt_pricerefund.value =CommaString(Math.floor(refundprice/11*10));
//
//            txt_refund_vat.innerHTML = "";
//            clog("cash!!");
//        }
//        var set = 0;
//        clog("pt_total "+pt_total+" pt_count "+pt_count);
//        set = parseCommaInt(pt_total) == 0 || parseCommaInt(pt_count) == 0 ? "0" : parseCommaInt(pt_total)/parseCommaInt(pt_count);
//        
//        clog("set is "+set);
//        pt_1set.innerHTML = CommaString(parseCommaInt(set));
//
//        checkAllPrice();
//            
//    }
    var before_pt_paymenttype = -1;
//    function counttype_visible_change() {
//        clog("counttype_visible_change");
////        var pcount = document.getElementById("counttype_coupon").value; //pt 선택값
//        var pt_count = document.getElementById("pt_count"); // 총 Session
//        var pt_pricetotal = document.getElementById("pt_pricetotal"); //총수업료
//        var pt_price1set = document.getElementById("pt_price1set"); //총수업료
//        var join = document.getElementById("join");
////        join.style.display = pcount == '0' ? "none" : "block";
//        var txt_refund_vat = document.getElementById("txt_refund_vat");
//        var pt_pricerefund = document.getElementById("pt_pricerefund");//환불시 회당단가
////        pt_count.innerHTML = pcount + "회";
////
//        for (var i = 0; i < mbs_coupons.length; i++) {
//            if (mbs_coupons[i].mbs_type == "PT" && mbs_coupons[i].mbs_max_count > 0) {
//                selected_pt = mbs_coupons[i];
//                break;
//            }
//        }
//        
//        var paymenttype = document.getElementById("pt_paymenttype").value;
//        //카드결제
//        if(before_pt_paymenttype != 1 && pt_paymenttype == 1){
//            
//        } 
//        //현금결제
//        else if(before_pt_paymenttype == 1 && pt_paymenttype != 1){
//            
//        }
//        var refundprice = parseCommaInt(pt_pricerefund.value);
//            var vat = parseInt(paymenttype) == 1 ? 1.1 : 1; //카드일때만 부가세 10%
//        pt_pricerefund.style.visiblity = parseInt(paymenttype) == 1 ? "visible" : "hidden";
//            var ptnum = parseInt(parseInt(pt_count.value));
//            var price = parseCommaInt(pt_pricetotal.value);
//        clog("price "+price+" ptnum "+ptnum);
//            var setprice = price == 0 || ptnum == 0 ? 0 : price / ptnum;
//            clog("setprice "+setprice);
//            pt_count.innerHTML = ptnum + "회";
//            pt_pricetotal.value = price * vat; //부가세 10% 적용
////            pt_price1set.innerHTML = setprice == 0 ? "0" : CommaString(setprice);
//        txt_refund_vat.innerHTML = "(VAT 10% "+CommaString(Math.floor(refundprice/10))+" 원)";
//        checkAllPrice();
//    }

    function btn_register() {
        
        for (var i = 0; i < mbs_coupons.length; i++) {
            if (mbs_coupons[i].mbs_type == "PT" && mbs_coupons[i].mbs_max_count > 0) {
                selected_pt = mbs_coupons[i];
                break;
            }
        }
         var payment_date_value = document.getElementById("id_payment_date").value;
        var obj = new Object();
        obj.paymentdate = payment_date_value;
        obj.pt_uid = re_obj.uid;
        obj.pt_userid = re_obj.userid;
        var constructor_name  = document.getElementById("constructor_name");
        obj.pt_constructorname = constructor_name.options[constructor_name.selectedIndex].text;
        
        obj.pt_constructoruid = constructor_name.value;
        obj.pt_check = document.getElementById("check_pt_desc").checked ? true : false;
        obj.pt_name = document.getElementById("pt_name").innerHTML;
        obj.pt_phone = document.getElementById("pt_phone").value;
        obj.pt_ampm = document.getElementById("pt_traner_am").checked ? "AM" : "PM";
        var pt_teachers_list = document.getElementById("pt_teachers_list");
        obj.pt_teacheruid = pt_teachers_list.value;
        obj.pt_teachername = pt_teachers_list.options[pt_teachers_list.selectedIndex].text;
        obj.pt_mbsidx = selected_pt.mbs_idx;
        obj.pt_starttime = document.getElementById("pt_starttime").value;
        obj.pt_endtime = document.getElementById("pt_endtime").value;
        obj.pt_count = parseInt(document.getElementById("pt_count").value);
//        obj.pt_freecount = parseInt(document.querySelector('.radiofreept:checked').value);
        obj.pt_freecount = parseInt(document.getElementById("select_service_pt").value);
        //obj.pt_pricetotal = document.getElementById("pt_pricetotal").value;
        obj.pt_pricetotal = parseCommaInt(document.getElementById("pt_pricetotal").value);
        obj.pt_price1set = parseCommaInt(document.getElementById("pt_price1set").innerHTML);
        obj.pt_pricerefund = parseCommaInt(document.getElementById("pt_pricerefund").value);
        obj.pt_paymenttype = document.getElementById("pt_paymenttype").value;
        obj.pt_signdataname = signaturePadName1.toDataURL('image/png');
        obj.pt_signdatasign = signaturePadSign1.toDataURL('image/png');
        obj.pt_note = "";
        obj.pt_desc = selected_pt.mbs_type+" "+obj.pt_count+"회 ￦"+obj.pt_pricetotal+"";
        obj.jsonprice = json_price;
        
        
        
        
        //카드 + 현금인지 체크한다.
        var iscard = document.getElementById("id_price_card").value && parseInt(document.getElementById("id_price_card").value) > 0 ? true : false;
        var iscash = document.getElementById("id_price_cash").value && parseInt(document.getElementById("id_price_cash").value) > 0 ? true : false;
        if(iscard && iscash){
            obj.selectedIndex = "4"; //카드 + 현금 
        }
        
        
        if (!obj.pt_check || !obj.pt_name || !obj.pt_phone || !obj.pt_constructoruid || !pt_teachers_list.value|| !obj.pt_starttime || !obj.pt_endtime || obj.pt_count == 0 || obj.pt_pricerefund == 0 || signaturePadName1.isEmpty() || signaturePadSign1.isEmpty() || !obj.pt_paymenttype) {
            if (!obj.pt_check) {
                alertMsg("환불규정 체크박스에 체크해 주세요.");
            } else if (!obj.pt_name) {
                alertMsg("이름을 입력해주세요.");
            } else if (!obj.pt_phone) {
                alertMsg("전화번호를 입력해주세요.");
            } else if (!obj.pt_constructoruid) {
                alertMsg("계약 트레이너를 선택하세요");
            } else if (!pt_teachers_list.value) {
                alertMsg("담당 트레이너를 선택해 주세요.");
            } else if (!obj.pt_starttime) {
                alertMsg("시작일을 선택해주세요.");
            } else if (!obj.pt_endtime) {
                alertMsg("종료일을 선택해주세요.");
            } else if (obj.pt_count == 0) {
                alertMsg("총 Session값은 최소 1회 이상이어야 합니다.");
            } else if (obj.pt_pricerefund == 0) {
                alertMsg("환불시 회당 적용단가는 최소 1원 이상이어야 합니다.");
            } else if (!obj.pt_paymenttype) {
                alertMsg("결제방법을 선택해 주세요");
            } else if (signaturePadName1.isEmpty()) {
                alertMsg("자필 이름입력이 필요합니다.");
            } else if (signaturePadSign1.isEmpty()) {
                alertMsg("서명이 필요합니다.");
            }
            return;
        }
        if(obj.pt_freecount > 0 && !document.getElementById("check_service_pt").checked){
            alertMsg("서비스 수업에 대한 체크박스에 체크해 주세요");
            return;
        }
        if(compare_date(obj.pt_starttime,obj.pt_endtime) == 1){
            alertMsg("종료일이 시작일보다 이전날짜입니다. 종료일을 다시 선택해 주세요");
            return;
        }



        pt_join_data = obj;

        clog("obj.jsonprice ",obj.jsonprice);
        var message =  
                        "<text>위 내용대로 PT 재가입하시겠습니까?</text><br>"+
                        "<div style='margin-left:15px;margin-right:15px;'>"+
                            "<label class='textevent' style='width:100%:'>최종금액</label>"+
                                "<table class='form-control' style='width:100%;text-align:center' >"+
                                        "<tr style='width:100%'>"+
                                           
                                            "<td style='width:100px'>"+
                                                "<label class='textevent'>카드</label>"+
                                            "</td>"+
                                            "<td style='width:100px'>"+
                                                "<label class='textevent'>현금</label><br>"+
                                            "</td>"+
                                            "<td style='width:100px'>"+
                                                "<label class='textevent'>미수금</label><br>"+                                    
                                            "</td>"+
                                            "<td style='width:100px'>"+
                                                "<label class='textevent'>총금액</label><br>"+
                                            "</td>"+
                                                "<td style='width:100%'>"+
                                                "<label class='textevent'>결제금액</label><br>"+
                                            "</td>"+
                                         "</tr>"+
                                         "<tr>"+
                                            
                                            "<td style='min-width:80px'>"+
                                               "<text>"+CommaString(json_price.card)+"</text>"+
                                            "</td>"+
                                            "<td style='min-width:80px'>"+
                                               "<text>"+CommaString(json_price.cash)+"</text>"+
                                            "</td>"+
                                            "<td style='min-width:80px'>"+
                                               "<text style='color:red;'>-"+CommaString(json_price.remain)+"</text>"+
                                            "</td>"+
                                            "<td style='min-width:80px'>"+
                                                "<text>"+CommaString(json_price.total)+"</text>"+
                                            "</td>"+
                                            "<td style='min-width:100%'>"+
                                                "<text style='color:blue;font-weight:bold;font-size:20px'>￦"+CommaString(json_price.total_remain)+"</text>"+
                                            "</td>"+
                                         "</tr>"+
                                    "</table></div>";
        
        showModalDialog(document.body, "PT 재가입", message, "가입완료하기", "취소", function() {
            sendPTReregistData(obj);
            //            showModalDialog(document.body, "P.T계약서 작성완료!", "PT 계약서 작성을 완료하였습니다. 계속해서 회원가입을 해주세요.", "확인", null, function() {
            //
            //                setPTDocument(true);
            //                hideModalDialog();
            //                hideModalDialog();
            //                hideModalDialog();
            //            }, function() {});

        }, function() {
            hideModalDialog();
        });


    }
    function checkPaymentType(){
        var pt_paymenttype = document.getElementById('pt_paymenttype'); //카드 , 현금, 
        if(!pt_paymenttype.value)return;
        var paymenttype = parseInt(pt_paymenttype.value);
        
        var iscard = document.getElementById("id_price_card").value && parseInt(document.getElementById("id_price_card").value) > 0 ? true : false;
        var iscash = document.getElementById("id_price_cash").value && parseInt(document.getElementById("id_price_cash").value) > 0 ? true : false;
        
        clog("iscard "+iscard+" cash "+iscash);
        if(iscard && !iscash){
            pt_paymenttype.selectedIndex = 1; //카드
        }
        else if(!iscard && iscash){
            pt_paymenttype.selectedIndex = 2; //현금
        }
        else if(iscard && iscash){
            pt_paymenttype.selectedIndex = 1; //카드 + 현금 
        }
    }
    var before_pt_paymenttype = -1;
    function checkAllPrice(isinputchange){
        clog("checkAllPrice !! ");
        
        var pt_count =  parseInt(document.getElementById("pt_count").value);
        var pt_price1set =  document.getElementById("pt_price1set"); //세트당 가격 
        var pt_pricetotal = document.getElementById("pt_pricetotal"); //총가격
        var pt_pricevat = document.getElementById("pt_pricevat"); //총가격
        var pt_pricerefund = document.getElementById("pt_pricerefund");
        var txt_refund_vat = document.getElementById("txt_refund_vat"); //환불시 카드 부가세
        var div_vat_text = document.getElementById("div_vat_text"); //총가격 부가세 텍스트
        var pt_starttime = document.getElementById("pt_starttime");
        var pt_endtime = document.getElementById("pt_endtime");
        
        
        var pt_paymenttype = parseInt(document.getElementById('pt_paymenttype').value); //카드 , 현금, 
        var pt_vat = pt_paymenttype == 1 ? 11 : 10;
        var pt_total = parseCommaInt(pt_pricetotal.value); //총가격
        var refundprice = parseCommaInt(pt_pricerefund.value);//환불시 회당 가격
        
        
        
        
        
        var set1_day = 4;
        if(pt_count != 0){
            pt_endtime.value = nextDay(pt_starttime.value,pt_count*set1_day);
        }
      
        //////////////////////////////////////////
        //현금기준 총금액을 계산한다.
        //////////////////////////////////////////
           
            var all_cash_total = pt_paymenttype == 1 ? parseCommaInt(pt_pricetotal.value)/11*10 : parseCommaInt(pt_pricetotal.value);
            
            clog("all_cash_total ",all_cash_total)
            var id_cash_total = document.getElementById("id_cash_total");
            id_cash_total.value= CommaString(all_cash_total);
        //////////////////////////////////////////
        //현금기준 총금액을 계산한다.
        //////////////////////////////////////////
       
        clog("all_cash_total ",all_cash_total);
        
        div_vat_text.style.display = parseInt(pt_paymenttype) == 1 ? "block" : "none"; //환불시 부가세 보여줄지 안보여줄지
        
        
         //카드결제
        if(before_pt_paymenttype != 1 && pt_paymenttype == 1){
            pt_pricetotal.value = CommaString(Math.floor(pt_total*pt_vat/10));
            
            pt_pricerefund.value = CommaString(Math.floor(refundprice*pt_vat/10));
            txt_refund_vat.innerHTML = "(VAT 10% "+CommaString(Math.floor(parseCommaInt(pt_pricerefund.value)/10))+" 원)";
            div_vat_text.style.display = "block";
            pt_pricevat.innerHTML =  "(VAT 10% "+CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/11))+" 원)";
            clog("card!!");
        }
        //현금결제
        else if(before_pt_paymenttype == 1 && pt_paymenttype != 1){
            pt_pricetotal.value = CommaString(Math.floor(pt_total/11*10));
            pt_pricerefund.value = CommaString(Math.floor(refundprice/11*10));
            txt_refund_vat.innerHTML = "";
            clog("cash!!");
            div_vat_text.style.display = "none";
        }else {
            pt_pricetotal.value = CommaString(Math.floor(pt_total));
            pt_pricerefund.value = CommaString(Math.floor(refundprice));
            txt_refund_vat.innerHTML = pt_paymenttype == 1 ? "(VAT 10% "+CommaString(Math.floor(parseCommaInt(pt_pricerefund.value)/10))+" 원)" : "";
            div_vat_text.style.display = pt_paymenttype == 1 ? "block" : "none";
            pt_pricevat.innerHTML =  "(VAT 10% "+CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/11))+" 원)";
        }
        
        clog("total_price "+pt_total+" pt_count "+pt_count);
        
        pt_price1set.innerHTML = pt_total == 0 || pt_count == 0 ? 0 : CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/pt_count));
        
        
        
        var price_card = pt_paymenttype == 1 ? pt_total : 0;
        var price_cash = pt_paymenttype != 1 ? pt_total : 0;
        var price_remain =  0;
        var price_total = pt_total;
        
        // 카드 ,현금 , 미수금 , 총금액
        var id_price_card = document.getElementById("id_price_card");
        var id_price_cash = document.getElementById("id_price_cash");
        var id_price_remain = document.getElementById("id_price_remain");
        var id_price_total = document.getElementById("id_price_total");
       
        
        
        if(isinputchange == 100){
            if(pt_paymenttype == 1){
                id_price_card.value = pt_pricetotal.value;
                id_price_cash.value = "0";
                id_price_remain.value = "0";
                id_price_total.value = pt_pricetotal.value;
            }else{
                id_price_card.value = "0";
                id_price_cash.value = pt_pricetotal.value;
                id_price_remain.value = "0";
                id_price_total.value = pt_pricetotal.value;
            }
        }
        
        
        if(isinputchange && isinputchange == 1 && id_price_card.value == ""){
            id_price_card.value = "0";
        }
        if(isinputchange && isinputchange == 2 && id_price_cash.value == ""){
            id_price_cash.value = "0";
        }
        if(isinputchange && isinputchange == 1){
            id_price_card.value = CommaString(parseCommaInt(id_price_card.value));
        }else if(isinputchange && isinputchange == 2){
            id_price_cash.value = CommaString(parseCommaInt(id_price_cash.value));
        }
//        if(isinputchange){
//            if(parseCommaInt(id_price_card.value) > 0 && parseCommaInt(id_price_cash.value) > 0){
//                pt_paymenttype = 4;
//                document.getElementById('pt_paymenttype').value = "4";
//            }else if(parseCommaInt(id_price_card.value) > 0 && parseCommaInt(id_price_cash.value) == 0){
//                pt_paymenttype = 1;
//                document.getElementById('pt_paymenttype').value = "1";
//            }else if(parseCommaInt(id_price_card.value) == 0 && parseCommaInt(id_price_cash.value) > 0){
//                pt_paymenttype = 2;
//                document.getElementById('pt_paymenttype').value = "2";
//            }
//        }
        
        if(!isinputchange){
            id_price_card.value = pt_paymenttype == 1 ? pt_pricetotal.value : "0";
            id_price_cash.value = pt_paymenttype != 1 ? pt_pricetotal.value : "0";            
        }
        
        //최종금액 중 하나 입력중일때
        if(isinputchange){
            var vatcard = 0; //수수료포함가
            var card = 0;
            var cash = 0;
            var remain = 0;
            var total = 0;
            //카드
            if(isinputchange == 1){
                vatcard = parseCommaInt(id_price_card.value);
                card = parseCommaInt(id_price_card.value)/11*10;
                cash = parseCommaInt(id_price_cash.value);
                remain = all_cash_total - card - cash;
                total = vatcard + cash + remain;
                
//                id_price_card.value = CommaString(vatcard);
                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
            }
            //현금 
            else if(isinputchange == 2){
                
                cash = parseCommaInt(id_price_cash.value);
                
                vatcard = parseCommaInt(id_price_card.value);
                card = parseCommaInt(id_price_card.value)/11*10;
                remain = all_cash_total - card - cash;
                total = vatcard + cash + remain;
                
                id_price_card.value = CommaString(vatcard);
//                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
            }
            //미수금
            else if(isinputchange == 3){
                
                remain = parseCommaInt(id_price_remain.value);
                cash = parseCommaInt(id_price_cash.value);
                
                vatcard = (all_cash_total-cash-remain)*1.1;
                card = all_cash_total-cash-remain;
                total = vatcard + cash + remain;
                
                id_price_card.value = CommaString(vatcard);
                id_price_cash.value = CommaString(cash);
//                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
            }
            else {
                
                
            }
            
            
             clog("all_cash_total "+all_cash_total+" card "+card+" cash "+cash+" remain "+remain+" total "+total);
        }
        //다른거 입력이다.
        else {
            
           
            card = parseCommaInt(id_price_card.value);
            cash = parseCommaInt(id_price_cash.value);
            remain = parseCommaInt(id_price_remain.value);
            total = card + cash + remain;
            id_price_total.value = CommaString(total);
//            id_price_remain.value = CommaString(parseCommaInt(pt_pricetotal.value)-parseCommaInt(id_price_card.value)-parseCommaInt(id_price_cash.value));    
        }
            
        
//        id_price_total.value = pt_pricetotal.value;
        
        
//        txt_refund_vat.innerHTML = "(VAT 10% "+CommaString(Math.floor(refundprice/10))+" 원)";
        
        json_price.counttypeprice = parseCommaInt(id_price_total.value);
        json_price.totalprice = parseCommaInt(id_price_total.value); //기간제 + 라커
        json_price.card = parseCommaInt(id_price_card.value);
        json_price.cash = parseCommaInt(id_price_cash.value);
        json_price.remain = parseCommaInt(id_price_remain.value);
//        json_price.remain_card =  pt_paymenttype == 1 ? json_price.remain : 0;
//        json_price.remain_cash = pt_paymenttype != 1 ? json_price.remain : 0;     
        json_price.total = json_price.totalprice;
        json_price.total_remain = json_price.total-json_price.remain;
        
        before_pt_paymenttype = pt_paymenttype;
        
        checkPaymentType();
        if(json_price.card > 0 && json_price.cash > 0){
            document.getElementById('pt_paymenttype').value = "4";
        }
    }
   
    function sendPTReregistData(obj) {

        if (!nowcentercode) return;

        var _data = {
            "type": "simpleptreregist", // group or center or auth
            "centercode": nowcentercode,
            "value": obj
        };

        CallHandler("getdata", _data, function(res) {
            code = parseInt(res.code);
            if (code == 100) {
                alertMsg("성공적으로 재가입하였습니다.", function() {
                    hideModalDialog();
                    go_home();
                    call_app();//closeWebView();
                    
                });

                //3초후에 자동으로 로그아웃. 즉 태블릿 웹뷰를 닫는다. 
                setTimeout(function() {
                    go_home();
                    call_app();//closeWebView();
                }, 3000);

            } else {
                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });

    }

    function go_home() {
        if (param_pagetype && param_pagetype == "adm")
            gotoadmin();
        else
            gotohome();
    }
    function change_constructor(){
//        <text class="textevent">계약트레이너 선택</text>
//        <select id='constructor_id' onchange='constructor_change()' style='width:300px'></select>
        var message = document.createElement("div");
        var select = document.createElement("select");
        select.id = "change_constructor";
        select.innerHTML ="<option value='0'>== 변경할 계약트레이너를 선택하세요 ==</option>";
        for(var i = 0; i < teacherlist.length; i++){
            var opt = document.createElement('option');
            opt.value = teacherlist[i]["mem_uid"];
            opt.innerHTML = teacherlist[i]["mem_username"];
            select.appendChild(opt);
        }
        message.appendChild(select);
        
        for (var i = 0; i < select.children.length; i++) {
            if (select.children[i].value == re_obj.constructoruid) {
                select.selectedIndex = i;
                break;
            }
        }
        
        showModalDialog(document.body, "계약트레이너 변경", message.innerHTML, "변경하기", "취소", function() {
            var mselect = document.getElementById("change_constructor");
            var constructor_name = document.getElementById("constructor_name");
            var constructor_uid = document.getElementById("constructor_uid");
            
            var name = mselect.options[mselect.selectedIndex].text;
            var uid = mselect.value;
            constructor_name.innerHTML = name;
            constructor_uid.innerHTML = uid;
            
            hideModalDialog();
        }, function() {
            hideModalDialog();
        });
    }
     function change_membership(){
//        <text class="textevent">계약트레이너 선택</text>
//        <select id='constructor_id' onchange='constructor_change()' style='width:300px'></select>
         
        var message = document.createElement("div");
        var select = document.createElement("select");
        select.id = "change_constructor";
        select.innerHTML ="<option value='0'>== 횟수제 운동목록을 선택하세요 ==</option>";
        for(var i = 0; i < mbs_coupons.length; i++){
            var opt = document.createElement('option');
            if (parseInt(mbs_coupons[i]["mbs_iscounttype"]) == 1) {
                opt.value =  mbs_coupons[i]["mbs_idx"];
                opt.innerHTML = mbs_coupons[i]["mbs_name"] + "  (￦" + mbs_coupons[i]["mbs_price"] + ")";
                select.appendChild(opt);
            }
        }
        message.appendChild(select);
        
        for (var i = 0; i < select.children.length; i++) {
            if (select.children[i].value == re_obj.constructoruid) {
                select.selectedIndex = i;
                break;
            }
        }
        
        showModalDialog(document.body, "멤버쉽 변경", message.innerHTML, "변경하기", "취소", function() {
            var mselect = document.getElementById("change_constructor");
            var constructor_name = document.getElementById("constructor_name");
            var constructor_uid = document.getElementById("constructor_uid");
            
            var name = mselect.options[mselect.selectedIndex].text;
            var uid = mselect.value;
            constructor_name.innerHTML = name;
            constructor_uid.innerHTML = uid;
            
            hideModalDialog();
        }, function() {
            hideModalDialog();
        });
    }
</script>
