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
    

    <link href="./css/modaldialog.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/checkbox.css">
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dd.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" /> <!--Montserrat 폰트설정-->
    <script src="js/scripts.js?ver3.02ae3"></script>
    <script src="jquery.dd.min.js"></script>
    
    <script src="signature_pad.min.js"></script>
    <script src="signature/assets/json2.min.js"></script>
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

        .textevent {
           font-family: "Noto Sans KR";
           font-size:15px; color:#3f4254;
           font-weight:500;
            padding-top:20px;
        }
        .myinputtype {
            background-color:#f5f8fa;
            font-size:15px; color:#495057;
            border : 0px;
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
        
        /*모달 뒷배경 뿌옇게*/
/*
        .modal-backdrop{backdrop-filter: blur(5px);background-color: #000000cc;}
        .fade.modal-backdrop.show{opacity: 0.9;}
*/
        
    </style>

</head>

<body style="background-color:#f5f8fa;">
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <div id="div_header" ></div>
    <div align="center" style="width:100%"><!--가운데정렬을 위한 DIV1 -->
        <div align="left" style="max-width:960px;text-align:left"><!--가운데정렬을 위한 DIV2 -->
            <div style="padding:25px">
        <div  style="width:100%;background-color:#ffffff;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)">
            <div style="height:70px;width:100%;border-bottom:1px solid #e4e6ef;"><text class="textevent" style="margin-top:30px;margin-left:30px;font-size:20px;color:#262930;font-weight:700;line-height:70px;">P.T회원가입 양식</text></div>
            <div align="center" id = "txt_rejoin_user" style="width:100%;height:40px;display:none;background-color:#fee9d2;">
                <img src = "./img/icon_triangle.png" style="width:24px;height:22px;margin-top:-6px;">&nbsp;&nbsp;<text style="font-size:16px;color:#7e460f;line-height:40px;margin-top:9px">재등록중입니다.</text>
            </div>
             <div id="join">

                <div id='container'>

                </div>

                  <div id="center" style="padding-left:25px;padding-right:25px">
                       <div align="center" style="width:100%;height:80px">
                            <label style='font-size:15px;color:#262930;font-weight:500;margin-top:30px'>약관의 모든 내용을 숙지하였으며, 이에 동의합니다.</label>
                       </div>
                       <div id='signpad1'>
                       <table style='width:100%'>
                            <tr>
                                <td style='width:20%;height:200px;vertical-align:top'>

                                        <text style='color:#3f4254;font-size:15px;font-weight:500'>이름 입력란:</text><br>
                                        <button class='button' id='clear' onclick='clear_sign1(1)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>

                                </td>
                                <td id='signtd1' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>

                                    <div id='sign_devide1' style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;'></div>
                                    <div id='sign_devide2' style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;'></div>
                                    <div id='div_namepad' class='wrapper'>
                                        <canvas id='signature-pad-name1' class='signature-pad-name1' style='width:100%;height:200px'></canvas>
                                    </div>

                                </td>
                            </tr>
                            <tr>
                                <td colspan = '2' style='height:35px'>
                                </td>
                            </tr>
                            <tr>
                               <td style='width:20%;height:200px;vertical-align:top'>
                                    <text style='color:#3f4254;font-size:15px;font-weight:500'>서명란:</text><br>
                                     <button class='button' id='clear' onclick='clear_sign1(2)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>
                                </td>
                                <td id='signtd2' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>
                                    <div class='wrapper'>
                                        <canvas id='signature-pad-sign1' class='signature-pad-sign1' style='width:100%;height:200px'></canvas>
                                    </div>
                                </td>
                            </tr>

                        </table>

                    </div>

                    </div>
                 

                <br>
                <p align="right"><button onclick="btn_register()" class="btn btn-primary btn-raised" style='margin-right:25px'>재등록하기</button></p><br><br>
            </div>
        </div>
    </div>
        </div>
    </div>
</body>

</html>
<script>
    var canvasName1 = document.getElementById('signature-pad-name1');
    var canvasSign1 = document.getElementById('signature-pad-sign1');
    var signaturePadName1 = null;
    var signaturePadSign1 = null;
    var sign_count = 0;
    var signaturePadPTTermName1 = null;
    var cInterval = setInterval(function() {
        if ($('#signpad1').width() > 100) {
            
            
            var signtd1 = document.getElementById("signtd1");
            var signtd2 = document.getElementById("signtd2");
            var sign_devide1 = document.getElementById("sign_devide1");
            var sign_devide2 = document.getElementById("sign_devide2");

            var signtd1_width = signtd1.offsetWidth;
            var signtd1_height = signtd1.offsetHeight;
            sign_devide1.style.marginLeft = signtd1_width/3;
            sign_devide2.style.marginLeft = signtd1_width/3*2;
            
            
            signaturePadName1 = new SignaturePad(document.getElementById('signature-pad-name1'), {
                backgroundColor: 'rgba(255, 255, 0, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            signaturePadSign1 = new SignaturePad(document.getElementById('signature-pad-sign1'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            
            canvasName1.width = signtd1_width; //좌측 이름입력란 텍스트 때문에 해당영역 100을 빼준다
            canvasSign1.width = signtd1_width;//좌측 서명란 텍스트 때문에 해당영역 100을 빼준다
            canvasName1.height = signtd1_height; //좌측 이름입력란 텍스트 때문에 해당영역 100을 빼준다
            canvasSign1.height = signtd1_height;//좌측 서명란 텍스트 때문에 해당영역 100을 빼준다
            
//            clog("signtd1 width "+signtd1.offsetWidth+" signtd2 width "+signtd2.offsetWidth);
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
    var groupcode = "<?php echo $groupcode; ?>";
    var groupname = "<?php echo $groupname; ?>";
    $(document).ready(function() {


        


        
       
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
                
                //어드민에서 넘어온 센터코드와 저장된 센터코드가 다르다면 어드민에서 넘어온 센터코드로 저장한다.
                if(nowcentercode != getData("nowcentercode")){
                    for(var i = 0 ; i < arr.length;i++){
                        if(arr[i].centercode == nowcentercode){
                            saveDataGroupCenter(groupcode,arr[i].centername,arr[i].centercode);
                            break;
                        }
                    }    
                }
                
                
                header_init("<?php echo $auth;?>","<?php echo $id;?>",arr,function(){
                    
                    allcenters = arr;
                    setMembership(nowcentercode);

                    
                });
                

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
                
                
                constructor_name_option_tag = "<option value=''>강사를 선택하세요</option>";
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
                    ptruledata = unescapeHtml(res.message);
                    ptruledata = replacePTSignTag(ptruledata);


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
    function replacePTSignTag(tag){
//        console.log("tag ",tag);
        sign_count = tag.split("{{sign}}").length - 1;
        console.log("sign_count ",sign_count);
        for(var i = 0 ; i < sign_count; i++){
            var sign_tag = "<div style='border-radius:5px;background-color:white;width:auto;height:46px;float:right;padding:3px'>"+
                                "<button id='sign_rule_btn_ptrule_"+i+"' onclick='click_signrule(\"sign_rule_btn_ptrule_"+i+"\", \"sign_rule_img_ptrule_"+i+"\")' style='float:right;margin-top:2px;background-color:#33a186;border:0px;border-radius:5px;padding:8px 15px 8px 15px;font-size:14px;color:white'>서명</button>"+
                                "<img id='sign_rule_img_ptrule_"+i+"' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-right:5px;display:none' src=''/>"+                                
                           "</div><br><br>";            
            
            tag = tag.replace("{{sign}}",sign_tag); 
            
        }
        return tag;        
    }

    
    function click_signrule(btn_id,img_id) {
        var message_tag = "<tr>"+
                       "<td style='width:20%;height:200px;vertical-align:top'>"+
                           
                             "<button class='button' id='clear' onclick='clear_ptterm_sign()' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:8px 15px 8px 15px;font-size:14px;color:white'>다시쓰기</button><br><br>"+
                        "</td>"+
                        "<td id='signtd2' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>"+
                            "<div class='wrapper'>"+
                                "<canvas id='canvas_pt_term_sign' class='signature-pad-sign' style='margin:0 auto;background-color:#fff;'></canvas>"+
                            "</div>"+
                        "</td>"+
                    "</tr>";
        
        showModalDialog_sign_zone(document.body,"서명하기",message_tag,"확인","취소",function() {
            
            var popup_sign_img = signaturePadPTTermName1.toDataURL('image/png');
            var sign_rule_btn = document.getElementById(btn_id);
            var sign_rule_img = document.getElementById(img_id);
            
            sign_rule_img.src = popup_sign_img;
            sign_rule_img.style.display = "block";
            sign_rule_btn.innerHTML = "서명다시하기";
//            $("#sign_rule_img_"+idx).attr('src',popup_sign_img);
//            $("#sign_rule_img_"+idx).css({
//                'display':'block',
//                'width':'70%',
//                'height':'30px',
//                'background-color':'#fff'
//            });
            hideModalDialog();
        },function () {
            hideModalDialog();
        },'');
        
        signaturePadPTTermName1 = null;
        signaturePadPTTermName1 = new SignaturePad(document.getElementById('canvas_pt_term_sign'), {
            backgroundColor: 'rgba(255, 255, 0, 0)',
            penColor: 'rgb(0, 0, 255)',
        });
        
    }
     function clear_ptterm_sign(type) {
        signaturePadPTTermName1.clear();

    }
    function setMembership(centercode) {
        initVat(centercode);
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

//                 mbs_coupons.sort(sort_by('mbs_type', true, (a) => a.toUpperCase()));

//                clog("coupons ",mbs_coupons);
                initPTCoupon();
                selectPTCouponOptionTag(mbs_coupons,centercode);
                
                
            }
        });
    }
    var select_ptcoupon_option_tag = "";
    //선택할 PT쿠폰 option tag를 만든다.
    function selectPTCouponOptionTag(coupons,centercode){
        var ptcoupons = [];
        for(var i = 0 ; i < coupons.length; i++){
            var coupon = coupons[i];
            if(coupon.mbs_type == "PT"){
                ptcoupons.push(coupon);
            }
        }
        select_ptcoupon_option_tag = "<option value=''>PT 회원권을 선택하세요</option>";
        for(var i = 0 ; i < ptcoupons.length; i++){
            select_ptcoupon_option_tag += "<option value='"+ptcoupons[i].mbs_idx+"'>"+ptcoupons[i].mbs_name+"&nbsp;&nbsp;&nbsp;[카드부가세 : "+ptcoupons[i].mbs_vat+"%]</option>";
        }
 
        
        setTeachers(centercode);   
        
    }
    function getMembershipTag(){
      
        var message = document.createElement("div");
        
        
        message.innerHTML = "<input id='pt_count' type='number' onfocus='this.select()' onchange='onchange_ptcount()' style='width:60px;border:0px' value='0' />회";     
        
        return message.innerHTML;
    }
    function showPTJoinPopup(ptruledata, obj) {
       
//        var sdate = new Date(re_obj.starttime);
//        var edate = new Date(re_obj.endtime);
        var stime = getToday();
        
        clog("ptsetting ",setting);
        var container = document.getElementById("container");

        var tlist = "<option value=''>강사를 선택하세요</option>";
        for (var i = 0; i < teacherlist.length; i++)
            tlist += "<option value='" + teacherlist[i].mem_uid + "' data-image='" + teacherlist[i].mem_photo + "'>" + teacherlist[i].mem_username + " 트레이너</option>";

        var ispaymentdate = auth >= AUTH_OPERATOR ? "" : "disabled";
        var screen_width = $(window).width();
        var popupwidth = screen_width-60;
        var twidth = popupwidth/6;
        var iwidth = popupwidth/6*2;
        
        var special_contract_tag = "<div style='border-radius:5px;background-color:white;width:240px;height:46px;float:right;padding:3px'>"+
                                        "<button id='sign_special_contract' onclick='click_signrule(\"sign_special_contract\", \"sign_img_special_contract\")' style='float:right;margin-top:2px;background-color:#33a186;border:0px;border-radius:5px;padding:8px 15px 8px 15px;font-size:14px;color:white'>서명</button>"+
                                        "<img id='sign_img_special_contract' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-right:5px;display:none' src=''/>"+                                
                                   "</div><br><br>";       
 
        
              container.innerHTML=
                "<div  style='padding:25px'>"+
                    "<div style='border: 1px solid #e4e6ef;border-radius:10px;padding:15px'>"+                            
                            "<div style='width:100%;height:50px;'>"+
                                "<text for='id_coupon_div' style='float:left;margin-top:-9px;margin-left:5px;color:#3f4254;font-size:16px;font-weight:700;line-height:50px'>Personal Training Session 규정</text>"+
                            "</div>"+
                            "<div style='height:1px;margin-left:-15px;margin-right:-15px;background-color:#eff2f5'></div>"+
                            "<div align='left' style='width:100%; height:300px; overflow:auto; line-height:20px; background-color: #f5f8fa;padding:3%;border-radius:10px; margin-top:25px;color:#5e6278;font-size:14px'>"+ptruledata+"</div><br>"+
                            "<div style='margin-bottom:30px;padding-right:25%'>"+myCheckBoxTag("규정에 관한 설명을 충분히 들었으며 이에 동의합니다.","check_pt_desc")+"</div>"+
                    "</div>"+
                "</div>"+
//                    "<div style='height:100px;padding:10px;border: 1px solid #e4e6ef;border-radius:10px;margin:5px 25px 25px 25px;' >"+
//                        "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>PT 회원권 선택<span style='color:red'>*</span></label>"+
//                        "<select class ='form-control myinputtype' id='id_pt_coupon' onchange='onChangePTCoupon()' >"+select_ptcoupon_option_tag+"</select>" + //가입시킨 사람 이름
//                    "</div>"+
                
                    //"<div id='div_detail_input' align='left' style='display:none'>"+     
                  "<div id='div_detail_input' align='left' style=''>"+     
                  
                        //특약!특약!특약!특약!특약!
                        "<div style='width:100%;padding-left:30px;padding-right:30px'><div class='form-control' id='special_contract' style=''>"+
                            "<label class='textevent' style='font-size:14px;margin-top:-8px;margin-left:5px;float:left'>특약&nbsp;&nbsp;</label><input class='form-control myinputtype' id='spacial_contract_input'  style='width:90%;float:left;font-size:14px;margin-top:7px' value=''/><br><br>"+         special_contract_tag+        
                        "</div><br></div>"+
                  
                  
                        "<div id='pt_formdiv' style='border: 1px solid #e4e6ef;border-radius:10px;margin:5px 25px 25px 25px;' >"+
                            "<div style='padding:15px 20px 15px 20px;border-radius:10px 10px 0px 0px;background-color:#f5f8fa'>"+                                
                                "<img src='./img/icon_fileuser.png' style='width:15px;height:19px;margin-top:-5px;'>&nbsp;&nbsp;<text style='color:#3f4254;font-size:16px;font-weight:500;line-height:35px'>회원번호: <span style='color:#009ef7'>"+re_obj.userid+"</span></text>"+
                                "<input class='form-control myinputtype' id='id_payment_date' type='date' style='width:150px;float:right;font-size:14px' value='<?php echo date('Y-m-d'); ?>' "+ispaymentdate+"/><label style='margin-top:5px;font-size:14px;font-weight:700;color:#f14a72;float:right;'>결제일 :&nbsp;</label>"+
                            "</div>"+  
                            "<div >"+
                                "<table class='table'  style='width:100%'>"+
                
                                    "<tr style='height:50px'>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>이름<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+            
                                            "<text class='form-control myinputtype' id='pt_name' name='pt_name' placeholder='예) 홍길동' align='center-vertical' style='margin:auto' >"+re_obj.name+"</text>"+
                                        "</td>"+
                                        "<td style='width:"+twidth+"px'>"+                                           
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>휴대폰 번호<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                            "<text class='form-control myinputtype' id='pt_phone' name='pt_phone' placeholder='예) 010-1234-5678' style='margin:auto'>"+re_obj.phone+"</text>"+
                                        "</td>"+ 
                                    "</tr>"+
                
                                    "<tr>"+
                                        "<td style='width:"+twidth+"px'>"+                                            
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>계약트레이너<span style='color:red'>*</span></label>"+
                                            "<br><label class='textevent' style='color:#009ef7;font-size:11px;margin-top:-25px;margin-left:5px;font-weight:normal'>페이롤 총매출에 반영</label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+                                          
                                            "<select class ='form-control myinputtype' id='pt_constructor'  style=''>"+constructor_name_option_tag+"</select>" + //가입시킨 사람 이름
                                        "</td>"+
                                       "<td style='width:"+twidth+"px'>"+                                               
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>담당트레이너<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                           "<div>"+
                                                "<select  class='form-control  myinputtype' id='pt_teachers_list' style='border:0px' name='pt_teachers_list' required>"+tlist+"</select>"+
                                                "<span style='float:left'>"+
                                                    "<input id='pt_traner_am' type='radio' name='ampm' value='AM' style='margin-top:10px' checked>&nbsp;오전&nbsp;&nbsp;<input id='pt_traner_pm' type='radio' name='ampm' value='PM'>&nbsp;오후"+                                           
                                                "</span>"+
                                            "</div>"+
                                        "</td>"+ 
                                    "</tr>"+
                                
                                    "<tr>"+
                                        "<td style='width:"+twidth+"px'>"+                                      
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>PT 시작일<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+
                                                                                  
                                                "<input  class='form-control myinputtype' id='pt_starttime' type='date' style='border:0px'   min='"+getToday()+"' value='"+stime+"' />"+
                                            
                                        "</td>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;'>PT 종료일<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                    
                                        "<td style='width:"+iwidth+"px'>"+
                                            
                                                "<input  class='form-control myinputtype' id='pt_endtime' type='date'  style='border:0px' min='"+getToday()+"'  />"+
                                            
                                        "</td>"+ 
                                    "</tr>"+
                
                                  
                                    "<tr>"+
                                       "<td style='width:"+twidth+"px'>"+                                
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>총 Session<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+
                                             "<div class='form-control myinputtype' style='height:80px'>"+   

                                                "<span>"+getMembershipTag()+"<text id='pt_count' style='display:none'></text><span>"+
                                                "<span style='float:right;'><button id='service_pt_arrow_l' onclick='show_service_pt(1)' class='btn' style='padding:3px 35px 3px 35px;background-color:#2196F3;color:white;font-size:13px'>◀</button><button  id='service_pt_arrow_r' onclick='show_service_pt(2)' class='btn ' style='padding:3px 35px 3px 35px;;background-color:#2196F3;color:white;display:none;font-size:13px'>▶</button></span>"+
                                                "<span id='span_service_pt' style='float:right;font-size:14px;width:100%;margin-top:8px;display:none'>"+
                                                    "<select onchange='change_service_pt()' id='select_service_pt' style='float:right;width:85px;height:30px;border:0px'><option value='0'>추가세션</option><option value='1'>+1회</option><option value='2'>+2회</option><option value='3'>+3회</option><option value='4'>+4회</option><option value='5'>+5회</option></select>"+
                                                "</span>"+    
                                             "</div>"+
                                        "</td>"+
                                       "<td style='width:"+twidth+"px'>"+                                        
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;'>PT 총수업료<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                                                            
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                            "<div class='form-control myinputtype' onchange='checkAllPrice(111)'>"+                 
                                                "<input id='pt_pricetotal' onfocus='this.select()' type='text' style='width:130px;border:0px' onkeyup='inputChangeComma(\"pt_pricetotal\")' value='0' />원<br>"+
                                                "<div id ='div_vat_text' style='display:none;'><text id='pt_pricevat' style='color:blue;display:none'></text><br></div>"+
                                                "<label style='margin-top:10px'>1회당 :</label>&nbsp;<label style='margin-top:10px' id='pt_price1set' >0</label>원"+                                                
                                            "</div>"+   
                                        "</td>"+
                                        
                                    "</tr>"+
                
                                      "<tr>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>환불시1회단가<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+
                                            "<div class='form-control myinputtype' style='padding:8px;height:50px'>"+  
                                                "<span style='float:left;'><input id='pt_pricerefund' type='text' onfocus='this.select()' onkeyup='inputChangeComma(\"pt_pricerefund\")'  onchange='checkAllPrice()'  style='width:100px;border:0px' value='0' />원</span><br><br><span style='float:left;'><text id = 'txt_refund_vat' style='color:blue;display:none;visiblity:hidden'></text></span>"+      
                                            "</div>"+
                                        "</td>"+ 
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;'>결제방법<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                            
                                            "<select id='pt_paymenttype' onchange='checkAllPrice(100)' class='form-control myinputtype' name='pt_paymenttype' required>"+
                                                "<option value=''>결제방법을 선택하세요</option>"+
                                                "<option value='1'>카드결제</option>" +
                                                "<option value='2'>현금결제</option>" +
                                                "<option value='4'>카드+현금</option>" +
                                            "</select>"+
                                            
                                        "</td>"+
                                    
                                    "</tr>"+
                                    "<tr style='display:none'>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>페이롤 부가세<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td colspan='3' style='width:"+iwidth+"px'>"+
                                             "<select id='pt_traner_payrollvat' class='form-control myinputtype' required>"+
                                                "<option value='0'>페이롤 부가세 미적용</option>"+
                                                "<option value='1'>페이롤 부가세 10% 적용</option>" +
                                                
                                            "</select>"+
                                        "</td>"+ 
                                    "</tr>"+
                  
                                "</table>"+
                                "<div class='form-control myinputtype' id='div_service_pt_desc' style='width:100%;height:70px;display:none;padding:20px'>"+                                     
                                    "<span style='float:left;'><label class='mycheckbox' ><input id='check_service_pt'  type='checkbox'><span class='checkmark'></span></label></span>"+
                                    "<span style='float:left;'><text id='txt_service_pt_desc' style='font-size:18px;color:red'>*환불시 서비스 수업에 대한 가격은 포함되지 않습니다.</text></span>"+
                                "</div>"+
                  
                                "<text id='txt_vat' style='font-size:24px;color:red;display:none;padding:20px'>+ VAT "+global_vat+"% 추가</text>"+
                            "</div>" +                            
                         "</div>"+  
                         "<div style='border: 1px solid #e4e6ef;border-radius:10px;margin:5px 25px 25px 25px;' >" +
                                "<div id = 'div_price_total'>"+
                                    "<div style='border-radius:10px 10px 0px 0px;background-color:#f5f8fa'>"+
                                        "<label for='payment_type' class='textevent' style='margin-left:20px;margin-bottom:15px;'>최종금액</label>"+
                                    "</div>"+
                                    "<div style='padding:0px 20px 20px 20px;'>"+
                                         "<div style='height:1px;margin-left:-20px;margin-right:-20px;background-color:#eff2f5'></div>"+
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
                                                     "<td style='width:18%;display:none'>"+
                                                            "<label class='textevent' style='color:#009ef7'>할인</label><br>"+
                                                        "</td>"+
//                                                    "<td style='width:100%'>"+
//                                                        "<label class='textevent'>총금액</label><br>"+ 
//                                                    "</td>"+
                                                 "</tr>"+
                                                 "<tr>"+
                                                    "<td style='min-width:150px; background-color:yellow;display:none'>"+
                                                        "<input type='text' class='form-control myinputtype' id='id_cash_total' onfocus='this.select()' placeholder='현금기준 총금액' disabled>"+
                                                    "</td>"+
                                                    "<td style='min-width:150px;padding-right:10px'>"+
                                                       "<input type='text' class='form-control  myinputtype' id='id_price_card' onkeyup='checkAllPrice(1)' onfocus='this.select()' placeholder='카드 결제금액...' value ='0' novalidate>"+    
                                                    "</td>"+
                                                    "<td style='min-width:150px;padding-right:10px'>"+
                                                       "<input type='text' class='form-control myinputtype' id='id_price_cash' onkeyup='checkAllPrice(2)' onfocus='this.select()' placeholder='현금 결제금액...' value ='0' novalidate>"+
                                                    "</td>"+
                                                    "<td style='min-width:150px;padding-right:10px'>"+
                                                       "<input type='text' class='form-control myinputtype' id='id_price_remain'  onkeyup='checkAllPrice(3)' onfocus='this.select()' placeholder='미수금 가격...' value ='0'>"+    
                                                    "</td>"+
                                                     "<td style='min-width:18%;padding-right:10px;display:none'>"+
                                                       "<input type='text' class='form-control myinputtype' id='id_price_discount'  onkeyup='checkAllPrice(4)' onfocus='this.select()' style='color:#009ef7' placeholder='할인 가격...' value ='0'>"+    
                                                    "</td>"+
//                                                    "<td>"+
//                                                        "<input type='text' style='border:0px' class='form-control' id='id_price_total' placeholder='총 금액...' value='0'disabled>"+
//                                                    "</td>"+
                                                 "</tr>"+
                                                 "<tr>"+
                                                         "<td colspan = '4'>"+
                                                             "<span style='float:left'><label class='textevent' style='margin-right:10px;margin-top:5px'>총금액</label></span>"+
                                                             "<span style='float:left'><input type='text' class='form-control' id='id_price_total' placeholder='총 금액...' style='margin-top:15px' disabled></span>"+
                                                             "<span style='float:right'><input type='text' class='form-control' id='id_price_totalremain' placeholder='결제 금액...' style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px;margin-top:15px' disabled></span>"+
                                                             "<span style='float:right'><label class='textevent'  style='margin-right:10px;margin-top:5px'>결제금액</label></span>"+
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
    function onchange_ptcount(){
        var pt_pricetotal = document.getElementById("pt_pricetotal"); //총가격
        var ptpaymenttype = document.getElementById('pt_paymenttype');        
        var pt_price1set = document.getElementById("pt_price1set");
        
        var id_price_card = document.getElementById("id_price_card"); //카드
        var id_price_cash = document.getElementById("id_price_cash"); //현금
        var id_price_remain = document.getElementById("id_price_remain"); //미수금
        var id_price_discount = document.getElementById("id_price_discount"); //할인
        var id_price_total = document.getElementById("id_price_total"); //총금액
        var id_price_totalremain = document.getElementById("id_price_totalremain");//결제금액
        
        
        pt_pricetotal.value = "0";
        ptpaymenttype.value = "";
        pt_price1set.innerHTML = "";
        id_price_card.value = "0";
        id_price_cash.value = "0";
        id_price_remain.value = "0";
        id_price_discount.value = "0";
        id_price_total.value = "0";
        id_price_totalremain.value = "0";
        
    }
    function initPTCoupon(){
        for (var i = 0; i < mbs_coupons.length; i++) {
            if (mbs_coupons[i].mbs_type == "PT" && mbs_coupons[i].mbs_iscounttype == 1 && mbs_coupons[i].mbs_name.indexOf(ID_FREE) < 0) {
                selected_pt = mbs_coupons[i];
                break;
            }
        }
        clog("selected_pt ",selected_pt);
    }
    function onChangePTCoupon(){
        var id_pt_coupon = document.getElementById("id_pt_coupon");
        var div_detail_input = document.getElementById("div_detail_input");
        if(id_pt_coupon.value){
            div_detail_input.style.display = "block";
            for (var i = 0; i < mbs_coupons.length; i++) {
                if (mbs_coupons[i].mbs_type == "PT" && mbs_coupons[i].mbs_idx == id_pt_coupon.value) {
                    selected_pt = mbs_coupons[i];
                    break;
                }
            }
        }else{
            selected_pt = null;
            div_detail_input.style.display = "none";
        }
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
    var before_pt_paymenttype = -1;
    function btn_register() {
        
       
        var payment_date_value = document.getElementById("id_payment_date").value;
        var obj = new Object();
        obj.paymentdate = payment_date_value;
        obj.pt_uid = re_obj.uid;
        obj.pt_userid = re_obj.userid;
        var pt_constructor  = document.getElementById("pt_constructor");
        
        obj.pt_constructorname = pt_constructor ? pt_constructor.options[pt_constructor.selectedIndex].text : "";
        obj.pt_constructoruid = pt_constructor ? pt_constructor.value : "";
        
        obj.pt_check = document.getElementById("check_pt_desc").checked ? true : false;
        obj.pt_name = document.getElementById("pt_name").innerHTML;
        obj.pt_phone = document.getElementById("pt_phone").innerHTML;
        obj.pt_ampm = document.getElementById("pt_traner_am").checked ? "AM" : "PM";
        var pt_teachers_list = document.getElementById("pt_teachers_list");
        obj.pt_teacheruid = pt_teachers_list && pt_teachers_list.value ? pt_teachers_list.value : "0";
        obj.pt_teachername = pt_teachers_list.options[pt_teachers_list.selectedIndex].text;
        obj.pt_mbsidx = selected_pt.mbs_idx;
        obj.pt_mbsvat = selected_pt.mbs_vat;
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
        obj.pt_traner_payrollvat = document.getElementById("pt_traner_payrollvat").value;
        obj.pt_note = "";
        obj.pt_special_note = "";
        var spacial_contract_input = document.getElementById("spacial_contract_input"); // 특약 input 
        var special_contract_signdata = document.getElementById("sign_img_special_contract").src;
        if(spacial_contract_input.value != "" && special_contract_signdata.indexOf("data:image") >= 0){
            obj.pt_sign_special_contract = special_contract_signdata;
             obj.pt_special_note = spacial_contract_input.value;
        }
         obj.pt_note = "";
//        
        obj.pt_desc = selected_pt.mbs_type+" "+obj.pt_count+"회 ￦"+obj.pt_pricetotal+"";
        obj.jsonprice = json_price;
        obj.pt_term_sign = [];
        var signed_count = 0;
        for(var i = 0 ; i < sign_count;i++){
            var sign_rule_img = document.getElementById("sign_rule_img_ptrule_"+i);
            obj.pt_term_sign.push(sign_rule_img.src);
            if(sign_rule_img.src.indexOf("data:image") >= 0)signed_count++;
        }
        
        
        //카드 + 현금인지 체크한다.
        var iscard = document.getElementById("id_price_card").value && parseInt(document.getElementById("id_price_card").value) > 0 ? true : false;
        var iscash = document.getElementById("id_price_cash").value && parseInt(document.getElementById("id_price_cash").value) > 0 ? true : false;
        if(iscard && iscash){
            obj.selectedIndex = "4"; //카드 + 현금 
        }
        
        
        if(spacial_contract_input.value != "" && special_contract_signdata.indexOf("data:image") < 0){
            alertMsg("PT 특약 규정에 서명해 주세요.");
            return;
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
        if(json_price.card == 0 && json_price.cash == 0 && json_price.remain == 0 && json_price.discount == 0){
            alertMsg("카드,현금,미수금이 모두 0원입니다. 다시확인해 주세요");
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
        if(signed_count < sign_count){
            alertMsg("PT 규정에 서명하지 않은 부분이 있습니다.");
            return;
        }
       


        pt_join_data = obj;

        
        var txt_payrollvat_tag = parseInt(obj.pt_traner_payrollvat) == 0 ? "<span style='color:#fa6374;font-weight:bold'>(※ 페이롤 부가세 미적용됨)</span>" : "<span style='color:#fa6374;font-weight:bold'>(※ 페이롤 부가세 10% 적용됨)</span>";
        clog("obj.jsonprice ",obj.jsonprice);
        var message =  
                        "<text>위 내용대로 PT 재가입하시겠습니까?</text><br>"+txt_payrollvat_tag+"<br>"+
                        "<div style='margin-left:15px;margin-right:15px;'>"+
                            "<label class='textevent' style='width:100%;color:white;font-size:17px;'>총금액 ￦"+CommaString(json_price.total)+"</label>"+
                                "<table class='form-control' style='width:100%;text-align:center;font-size:14px' >"+
                                        "<tr style='width:100%'>"+
                                           
                                            "<td style='width:100px'>"+
                                                "<label class='textevent'>카드</label>"+
                                            "</td>"+
                                            "<td style='width:100px'>"+
                                                "<label class='textevent'>현금</label><br>"+
                                            "</td>"+
                                            "<td style='width:100px;color:#009ef7'>"+
                                                "<label class='textevent'>미수금</label><br>"+                                    
                                            "</td>"+
                                            "<td style='width:100px'>"+
                                                "<label class='textevent' style='color:#009ef7'>할인</label><br>"+
                                            "</td>"+
                                                "<td style='width:100%'>"+
                                                "<label class='textevent' style='color:red'>결제금액</label><br>"+
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
                                               "<text style='color:#009ef7'>-"+CommaString(json_price.remain)+"</text>"+
                                            "</td>"+
                                            "<td style='min-width:80px'>"+
                                                "<text style='color:#009ef7'>"+CommaString(json_price.discount)+"</text>"+
                                            "</td>"+
                                            "<td style='min-width:100%'>"+
                                                "<text style='color:red;font-weight:bold;'>￦"+CommaString(json_price.total_remain)+"</text>"+
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
        
        var ptpaymenttype = document.getElementById('pt_paymenttype');
        var pt_paymenttype = parseInt(ptpaymenttype.value); //카드 , 현금, 
//        var pt_vat = pt_paymenttype == 1 ? 11 : 10; //neel_vat
        var pt_total = parseCommaInt(pt_pricetotal.value); //총가격
        var refundprice = parseCommaInt(pt_pricerefund.value);//환불시 회당 가격
        var pt_traner_payrollvat = document.getElementById("pt_traner_payrollvat");
        
        if(isinputchange == 111){
            
        }
        
        
        
        var set1_day = 4;
        if(pt_count != 0){
            pt_endtime.value = nextDay(pt_starttime.value,pt_count*set1_day);
        }
      
        //////////////////////////////////////////
        //현금기준 총금액을 계산한다.
        //////////////////////////////////////////
           
        var all_cash_total = pt_paymenttype == 1 ? subVAT(null,parseCommaInt(pt_pricetotal.value)) : parseCommaInt(pt_pricetotal.value);

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
            pt_pricetotal.value = CommaString(Math.floor((pt_total*(100+global_vat))/100));
            
            pt_pricerefund.value = CommaString(Math.floor((refundprice*(100+global_vat))/100));
            //txt_refund_vat.innerHTML = "(VAT "+global_vat+"% "+CommaString(Math.floor(parseCommaInt(pt_pricerefund.value)/(100+global_vat))*global_vat)+" 원)";
            txt_refund_vat.innerHTML = ""+CommaString(Math.floor(parseCommaInt(pt_pricerefund.value)/(100+global_vat))*global_vat)+" 원)";
            div_vat_text.style.display = "block";
            //pt_pricevat.innerHTML =  "(VAT "+global_vat+"% "+CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/(100+global_vat))*global_vat)+" 원)";
            pt_pricevat.innerHTML =  ""+CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/(100+global_vat))*global_vat)+" 원)";
            clog("card!!");
        }
        //현금결제
        else if(before_pt_paymenttype == 1 && pt_paymenttype != 1){
//            pt_pricetotal.value = CommaString(Math.floor(pt_total/11*10)); //neel_vat
            pt_pricetotal.value = CommaString(Math.floor(subVAT(null,pt_total))); 
            
//            pt_pricerefund.value = CommaString(Math.floor(refundprice/11*10)); //neel_vat
            pt_pricerefund.value = CommaString(Math.floor(subVAT(null,refundprice))); 
            
            txt_refund_vat.innerHTML = "";
//            clog("cash!!");
            div_vat_text.style.display = "none";
        }else {
            pt_pricetotal.value = CommaString(Math.floor(pt_total));
            pt_pricerefund.value = CommaString(Math.floor(refundprice));
            //txt_refund_vat.innerHTML = pt_paymenttype == 1 ? "(VAT "+global_vat+"% "+CommaString(Math.floor(parseCommaInt(pt_pricerefund.value)/100*global_vat))+" 원)" : "";
            txt_refund_vat.innerHTML = "";
            div_vat_text.style.display = pt_paymenttype == 1 ? "block" : "none";
            //pt_pricevat.innerHTML =  "(VAT "+global_vat+"% "+CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/(100+global_vat))*global_vat)+" 원)";
            pt_pricevat.innerHTML =  ""+CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/(100+global_vat))*global_vat)+" 원)";
        }
        
//        clog("total_price "+pt_total+" pt_count "+pt_count);
        
        pt_price1set.innerHTML = pt_total == 0 || pt_count == 0 ? 0 : CommaString(Math.floor(parseCommaInt(pt_pricetotal.value)/pt_count));
        
        
        
        var price_card = pt_paymenttype == 1 ? pt_total : 0;
        var price_cash = pt_paymenttype != 1 ? pt_total : 0;
        var price_remain =  0;
        var price_total = pt_total;
        
        // 카드 ,현금 , 미수금 , 총금액
        var id_price_card = document.getElementById("id_price_card");
        var id_price_cash = document.getElementById("id_price_cash");
        var id_price_remain = document.getElementById("id_price_remain");
        var id_price_discount = document.getElementById("id_price_discount");
        var id_price_total = document.getElementById("id_price_total");
        var id_price_totalremain = document.getElementById("id_price_totalremain");
            
        
        //결제타입 변경
        if(isinputchange == 100){
            //카드
            if(pt_paymenttype == 1){
                id_price_card.value = pt_pricetotal.value;
                id_price_cash.value = "0";
                id_price_remain.value = "0";
                id_price_discount.value = "0";
                id_price_total.value = pt_pricetotal.value;
            }
            //현금
            else{
                id_price_card.value = "0";
                id_price_cash.value = pt_pricetotal.value;
                id_price_remain.value = "0";
                id_price_discount.value = "0";
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

        if(!isinputchange){
            id_price_card.value = pt_paymenttype == 1 ? pt_pricetotal.value : "0";
            id_price_cash.value = pt_paymenttype != 1 ? pt_pricetotal.value : "0";            
        }
        
        var vatcard = 0; //수수료포함가
        var card = 0;
        var cash = 0;
        var remain = 0;
        var discount = parseCommaInt(id_price_discount.value);
        var total = 0;

        
        //최종금액 중 하나 입력중일때
        if(isinputchange){
           
            //카드
            if(isinputchange == 1){
                vatcard = parseCommaInt(id_price_card.value);
                
//                card = parseCommaInt(id_price_card.value)/11*10; //neel_vat
                card = subVAT(null,parseCommaInt(id_price_card.value)); 
                
                cash = parseCommaInt(id_price_cash.value);  
                remain = all_cash_total - card - cash - discount;
                total = vatcard + cash + remain;
                
//                id_price_card.value = CommaString(vatcard);
                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value =  CommaString(total-remain-discount);
                
                
            }
            //현금 
            else if(isinputchange == 2){
                
                cash = parseCommaInt(id_price_cash.value);
                
                vatcard = parseCommaInt(id_price_card.value);
                
//                card = parseCommaInt(id_price_card.value)/11*10; //neel_vat
                 card = subVAT(null,parseCommaInt(id_price_card.value)); 
                
                remain = all_cash_total - card - cash - discount;
                total = vatcard + cash + remain;
                
                id_price_card.value = CommaString(vatcard);
//                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value =  CommaString(total-remain-discount);
                
               
            }
            //미수금
            else if(isinputchange == 3){
                
                remain = parseCommaInt(id_price_remain.value);
                cash = parseCommaInt(id_price_cash.value);
                
//                vatcard = (all_cash_total-cash-remain)*1.1; //neel_vat
                vatcard = addVAT(null,all_cash_total-cash-remain-discount); 
                
                card = all_cash_total-cash-remain-discount;
                total = vatcard + cash + remain + discount;
                
                id_price_card.value = CommaString(vatcard);
                id_price_cash.value = CommaString(cash);
//                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value =  CommaString(total-remain-discount);
            }
            //할인금
            else if(isinputchange == 4){
                
                remain = parseCommaInt(id_price_remain.value);
                cash = parseCommaInt(id_price_cash.value);
                
//                vatcard = (all_cash_total-cash-remain)*1.1; //neel_vat
                vatcard = addVAT(null,all_cash_total-cash-remain-discount); 
                
                card = all_cash_total-cash-remain;
                total = vatcard + cash + remain + discount;
                
                id_price_card.value = CommaString(vatcard);
                id_price_cash.value = CommaString(cash);
//                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value =  CommaString(total-remain-discount);
            }
            else if(isinputchange == 100){
                if(pt_paymenttype == 1){
                        card = pt_total;
                        vatcard = pt_total;
                        cash = 0;
                        remain = 0;
                        total = pt_total;

                        id_price_total.value = CommaString(pt_total);
                        id_price_totalremain.value =  CommaString(pt_total);    
                    }else if(pt_paymenttype == 2){
                        card = 0;
                        vatcard = 0;
                        cash = pt_total;
                        remain = 0;
                        total = pt_total;

                        id_price_card.value = CommaString(vatcard);
                        id_price_cash.value = CommaString(cash);
                        id_price_total.value = CommaString(pt_total);
                        id_price_totalremain.value =  CommaString(pt_total);    
                    }
                    else {

                        card = parseCommaInt(id_price_card.value);
                        vatcard = parseCommaInt(id_price_card.value);
                        cash = parseCommaInt(id_price_cash.value);
                        remain = parseCommaInt(id_price_remain.value);
                        total = card + cash + remain + discount;
 
                        id_price_total.value = CommaString(total);
                        id_price_totalremain.value =  CommaString(total-remain-discount);
                        
                        if(card == 0 && cash > 0){ //현금으로 바꾸기
                            ptpaymenttype.value = 2;
                            pt_paymenttype = 2;   //카드로 바꾸기
                        }else if(card > 0 && cash == 0){
                            ptpaymenttype.value = 1;
                            pt_paymenttype = 1;
                        }
                    }
               

            }else if(isinputchange == 111){
                card = 0;
                vatcard = 0;
                cash = 0;
                remain = 0;
                total = 0;    
                ptpaymenttype.value = "";
            }
             updateTranerPayrollVat(pt_traner_payrollvat, parseInt(pt_paymenttype));
            
//             clog("all_cash_total "+all_cash_total+" card "+card+" cash "+cash+" remain "+remain+" total "+total);
        }
        //다른거 입력이다.
        else {
            
           
            card = parseCommaInt(id_price_card.value);
            cash = parseCommaInt(id_price_cash.value);
            remain = parseCommaInt(id_price_remain.value);
            total = card + cash + remain + discount;
            id_price_total.value = CommaString(total);
            id_price_totalremain.value =  CommaString(total-remain-discount);
//            id_price_remain.value = CommaString(parseCommaInt(pt_pricetotal.value)-parseCommaInt(id_price_card.value)-parseCommaInt(id_price_cash.value));    
        }
        
        //card -값을 없애기 위함
        if(card < 0 || vatcard < 0){
            cash = cash+card;
            card = 0;
            vatcard = 0;
        }
        id_price_discount.value = CommaString(discount);
        
        
        clog("card "+card+" cash "+cash+" remain "+remain+" discount "+discount+" total "+total+ " total_remain ");

        id_price_card.value = CommaString(vatcard);
        id_price_cash.value = CommaString(cash);
        id_price_remain.value = CommaString(remain);
        id_price_total.value = CommaString(total);
        id_price_totalremain.value =  CommaString(total-remain-discount);
        
        json_price.counttypeprice = parseCommaInt(id_price_total.value);
        json_price.totalprice = parseCommaInt(id_price_total.value); //기간제 + 라커
        json_price.card = parseCommaInt(id_price_card.value);
        json_price.cash = parseCommaInt(id_price_cash.value);
        json_price.remain = parseCommaInt(id_price_remain.value);
        json_price.discount = parseCommaInt(id_price_discount.value);
        json_price.total = json_price.totalprice;
        json_price.total_remain = json_price.total-json_price.remain-json_price.discount;
        clog("json_price ",json_price);
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
        select.innerHTML ="<option value='0'>변경할 계약트레이너를 선택하세요</option>";
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
        select.innerHTML ="<option value='0'>횟수제 운동목록을 선택하세요</option>";
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
     function header_init(issession,sid,centerdatas,callback){

        $("#div_header").load("header.php",function(){

            loginuid = "<?php echo $uid; ?>";
            loginauth = "<?php echo $auth; ?>";
//                initToastDiv(); //not use toast
            uiinit(issession,"<?php echo $usernamedesc; ?>");
            initSaveKey(sid);

            
            setHeaderCenterSelect(centerdatas,true);
            var btn_goto_payroll = document.getElementById("btn_goto_payroll");
            if(btn_goto_payroll)btn_goto_payroll.style.display = "none";
            callback();
        });
    }   
</script>
