<?php  
include('./common.php'); //아직 회원가입 페이지가 어디로 가야할지 모르겠다.

if(isset($_SESSION['authgroup'.DEV_REAL]) && $_SESSION['authgroup'.DEV_REAL] < AUTH_TRANER){

    echo "<script>alertMsg('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$buser = isset($_POST['buser']) ? $_POST['buser'] : '';
$nuser = isset($_POST['nuser']) ? $_POST['nuser'] : '';
$coupon = isset($_POST['coupon']) ? $_POST['coupon'] : '';
$isremoveremaincount = isset($_POST['isremoveremaincount']) ? $_POST['isremoveremaincount'] : 0;
$newmaxcount = isset($_POST['newmaxcount']) ? $_POST['newmaxcount'] : 0;
$sendprice = isset($_POST['sendprice']) ? $_POST['sendprice'] : '0';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1">
    <link rel="icon" type="image/gif/png" href="img/black_arc_logo.png">
    <title>Join</title>
    <!--   signature about -->
    
    <link href="./css/modaldialog.css" rel="stylesheet">

    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/dd.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" /> <!--Montserrat 폰트설정-->
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <script src="js/scripts.js?ver3.02a2"></script>
    <script src="jquery.dd.min.js"></script>
    <script src="signature_pad.min.js"></script>
    <script src="signature/assets/json2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/dd.css">
    <link rel="stylesheet" type="text/css" href="css/checkbox.css">
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
/*
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
*/

        
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
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'>
        <img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/>
    </div>
    <div id="div_header"></div>
    <div align="center" style="width:100%">
        <div align="left" style="max-width:960px;text-align:left">
            <div style="padding:25px">
                <div  style="width:100%;background-color:#ffffff;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)">
                    <div style="height:70px;width:100%;border-bottom:1px solid #e4e6ef;">
                        <text class="textevent" style="margin-top:30px;margin-left:30px;font-size:20px;color:#262930;font-weight:700;line-height:70px;">회원권 명의변경 신청서</text>
                    </div>
                    <div id="join">

                        <div id='container' class="container">
                            
                        </div>
                        <div align='center' class='form-group row'>
                            <div id='pt_formdiv1' style='width:100%;' class='col-12 offset-0'>
                                <div align='center' id='signdiv1' style='width:600px;text-align: center;'>
                                    <label for='signpad1'>(서명) 약관의 모든 내용을 숙지하였으며, 이에 동의합니다.</label>
                                    <div id='signpad1'>
                                        <table style='width:100%'>
                                            <tr>
                                                <td style='width:20%;height:200px;vertical-align:top'>

                                                        <text style='color:#3f4254;font-size:15px;font-weight:500'>이름 입력란:</text><br>
                                                        <button class='button' id='clear' onclick='clear_sign1(1)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>

                                                </td>
                                                <td  id='signtd1' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>

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
                                                <td  id='signtd2' style='background-color:#f5f8fa;border-radius:10px;width:width:80%;height:200px'>
                                                    <div class='wrapper'>
                                                        <canvas id='signature-pad-sign1' class='signature-pad-sign1' style='width:100%;height:200px'></canvas>
                                                    </div>
                                                </td>
                                            </tr>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p align="right"><button onclick="btn_sendcoupon()" class="btn btn-primary btn-raised" style='margin-right:10%'>양도하기</button></p><br><br>
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

            canvasName1.width = signtd1_width; //좌측글씨 길이가 100이라서 100을 뺀다
            canvasSign1.width = signtd1_width;//좌측글씨 길이가 100이라서 100을 뺀다
            canvasName1.height = signtd1_height; //좌측글씨 길이가 100이라서 100을 뺀다
            canvasSign1.height = signtd1_height;//좌측글씨 길이가 100이라서 100을 뺀다


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
    var nowcentercode = getParam("centercode");
    var sendprice = getParam("sendprice") ? getParam("sendprice") : 0;//기본 설정된 양도비
    clog("nowcentercode ",nowcentercode);
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
//    var allcenters = null;
    var mbs_coupons = [];
    var auth = "<?php echo $auth; ?>";
    
    var json_buser = null;
    var json_nuser = null;
    var json_coupon = null;
    var coupon_name = "";
    var buser_new_lockers = [];
    var send_new_lockers = [];
    
    $(document).ready(function() {


        initVat(nowcentercode);


        var groupcode = "<?php echo $groupcode; ?>";
//        var centercodes = "<?php echo $centercodes; ?>";
        savekey = "<?php echo $id; ?>";
//        var centers = centercodes.split(',');
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

//                allcenters = arr;

//                for (var i = 0; i < allcenters.length; i++) {
//                    if (allcenters[i].centercode == getData("nowcentercode")) {
//                        nowcentercode = allcenters[i].centercode;
//                        break;
//                    }
//
//                }
                var buser = '<?php echo $buser; ?>';
                var nuser = '<?php echo $nuser; ?>';
                var coupon = '<?php echo $coupon; ?>';
                var newmaxcount = '<?php echo $newmaxcount; ?>';
//               console.log("newmaxcount is "+newmaxcount);
                json_buser = JSON.parse(buser);
                json_nuser = JSON.parse(nuser);
                json_coupon = JSON.parse(coupon);
               
                
                var coupon_name = json_coupon.mbsname;
                if(json_coupon.mbstype == TYPE_GX || json_coupon.mbstype == TYPE_PT){
                    var usecount = json_coupon.usecount ? json_coupon.usecount : 0;
                    coupon_name = json_coupon.mbsname+" ("+usecount+"/"+getMbsMaxCount(json_coupon)+")";
                    
                } 

                clog("coupon_name ",coupon_name);
//                clog("json_nuser ",json_nuser);
                clog("json_coupon ",json_coupon);
                
                if(json_coupon.mbstype == TYPE_GX){
                    var maxcnt = getMbsMaxCount(json_coupon);
                    var usecnt = json_coupon.usecount ? parseInt(json_coupon.usecount) : 0;
                    if(usecnt < 0 )usecnt = 0;
                    //var remaincnt = parseInt(maxcnt-usecnt); //old
                    var remaincnt = parseInt(newmaxcount); //new
//                    json_coupon.mbsname = json_coupon.mbsname.replace(maxcnt+"",remaincnt+"");
                    json_coupon.mbsmaxcount = remaincnt+"";
                    json_coupon.usecount = 0;
                }
//                 clog("111 json_coupon ",json_coupon);
                
                getSendCouponRule(function(rule){
                    sendCouponTagData(json_buser,json_nuser,json_coupon,rule);    
//                    clog("dddd");
                })
                
                //양도인 라커를 모두 가져온다.
                getUserData(json_buser.uid,function(res){
                    var code = parseInt(res.code);
                    if(code == 100){
                        var buserinfo = res.message[0];
                        buser_new_lockers = buserinfo.mem_newlockers ? JSON.parse(buserinfo.mem_newlockers) : [];
                        console.log("buser_new_lockers ",buser_new_lockers);
                    }
                    
                },function(err){},groupcode,nowcentercode);
                
                
            } else {
                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });
        
        
        
        
       
    });
  
    function getSendCouponRule(callback) {
        var obj = new Object();
        obj.uid = "<?php echo $uid; ?>";
        obj.id = "<?php echo $id; ?>";
        obj.type = "sendcouponrule";
        obj.centercode = nowcentercode;
        if (obj.centercode) {
            CallHandler("getptrule", obj, function(res) {
                var code = parseInt(res.code);
                if (code == 100) {
                    callback(unescapeHtml(res.message));
                } else {
                    alertMsg(res.message);
                }
            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
        }

    }
function sendCouponTagData(buser,nuser,coupon,rule){
    var container = document.getElementById("container");
    
    
    clog("일단 가입됬다"+sendprice);
    var bgcolor_tag = "background-color:f4f8fb;";
    
    
    var coupon_desc = "";
    if(coupon.mbstype =="PT" || coupon.mbstype =="GX"){
        coupon_desc = coupon.mbstype+" "+coupon.mbsmaxcount+"회 이용권 <span style='color:#f4436d'>["+coupon.usecount+"회 이용]</span>";
    }
    else if(coupon.mbstype == TYPE_GX){
        coupon_desc = coupon.mbsmonth+"개월 이용권 <span style='color:#f4436d'>["+coupon.usecount+"회 이용]</span>";
    }
    else{
        coupon_desc = coupon.mbsmonth+"개월 헬스 이용권";
    }
    coupon_name = coupon.mbsname;
    var max_count_tag =  coupon.mbstype == TYPE_GX || coupon.mbstype == TYPE_PT ? "<label style='float:right;margin-right:20px;font-size:14px; color:#f4436d; text-align:left; font-weight:700;'>("+coupon.mbsmaxcount+"회 양도)</label>" : "";
    var rule_tag = "<br><text class='textevent' style='font-size:15px'>양도규정</text><div style='margin-top:10px;color:#5e6278'>"+
                        "<div style='width:100%; height:300px; overflow:auto; line-height:18px; background-color: #f5f8fa;padding:3%;border-radius:10px; margin:0 auto'>"+
                            rule+
                        "</div>"+
                    "</div>";
    var title = "양도 신청서";
        container.innerHTML = ""+rule_tag+""+
            "<div style='margin-top:20px;margin-bottom:20px'><text  class='textevent' style='margin-top:15px;'>(필수) 규정에 관한 설명을 충분히 들었으며 이에 동의합니다.</text>"+
                "<span style='float:right;'><text class='textevent'>동의합니다.</text></span>"+
                "<span style='float:right;'><label class='mycheckbox' style='margin-left:-30px'><input id='check_sendcoupon_desc' type='checkbox'><span class='checkmark'></span></label></span>"+
            "</div><br>"+
//             "<p align='center'><input type='checkbox' id='check_sendcoupon_desc'>&nbsp;규정에 관한 설명을 충분히 들었으며 이에 동의합니다.&nbsp;&nbsp;&nbsp;</p>"+
            "<table class='table table-bordered' id='dataTable'style='width:100%;'>"+
                            "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>회원권</label>"+
                                "</td>"+
                                "<td  style='width:40%;'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+coupon_name+"</label>"+max_count_tag+
                                "</td>"+
                                "<td >"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>결제자 : "+username+"</label><br>"+
                                "</td>"+
                             "</tr>"+
                            "<tr>"+
                                "<td colspan='3' style='width:100%'>"+
                            "</tr>"+
                            "<tr>"+
                                 "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>구분</label>"+
                                 "</td>"+ 
                                 "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>양도자</label>"+
                                 "</td>"+
                                "<td style='"+bgcolor_tag+"' >"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>양수자</label>"+
                                 "</td>"+
                             "</tr>"+
                             
                             "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>이름</label>"+
                                "</td>"+
                                "<td  style='width:40%'>"+
                                     "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+buser.name+"&nbsp;["+buser.id+"]</label>"+
                                "</td>"+
                                 "<td  style='width:40%'>"+
                                     "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+nuser.name+"&nbsp;["+nuser.id+"]</label>"+
                                "</td>"+
                             "</tr>"+    
                                            
                              "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>생년월일</label>"+
                                "</td>"+
                                "<td  style='width:40%'>"+
                                     "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+buser.birth+"</label>"+
                                "</td>"+
                                 "<td  style='width:40%'>"+
                                     "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+nuser.birth+"</label>"+
                                "</td>"+
                             "</tr>"+    
                                            
                              "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>전화번호</label>"+
                                "</td>"+
                                "<td  style='width:40%'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+buser.phone+"</label>"+
                                "</td>"+
                                 "<td  style='width:40%'>"+
                                     "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>"+nuser.phone+"</label>"+
                                "</td>"+
                             "</tr>"+    
                             "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>기간</label>"+
                                "</td>"+
                                "<td  colspan='2' style='width:80%'>"+
                                    "<span style='float:left'><label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;margin-top:7px'>시작일&nbsp;</label></span>"+
                                    "<span style='float:left'><input id='starttime' class='form-control'   min='"+getToday()+"' onchange='onChangeStarttime()' type='date' value='"+nuser.startdate+"' style='width:150px;mar'/></span>"+
                                    "<span style='float:left'><label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;margin-top:7px'>&nbsp;&nbsp;~ 종료일&nbsp;</label></span>"+
                                    "<span style='float:left'><input id='endtime' class='form-control' type='date' value='"+nuser.enddate+"' style='width:150px;height:40px' /></span>"+
                                    "<span style='float:right'><label id='gabday' style='font-size:14px; color:#f4436d; text-align:left; font-weight:500;margin-top:7px'>&nbsp;&nbsp;"+nuser.gabday+"일</label></span>"+
                                "</td>"+
                             "</tr>"+    
                             "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>라커</label>"+
                                "</td>"+
                                "<td colspan='2' style='width:80%'>"+
                                       "<div class='form-control' style='padding-top:10px'>"+
                                         "<input id='locker_x' type='radio' name='locker' value='X' onclick='sendlockercheck(0)' checked><label for='locker_x'>양도안함</label>&nbsp;&nbsp;<input id='locker_o' type='radio' name='locker' value='O' onclick='sendlockercheck(1)'><label for='locker_o' >양도함</label>&nbsp;&nbsp;"+
                                        "<span style='float:right'>"+
                                            "<div id='div_sendlockers' style='width:200px'>"+
                                                
                                            "</div>"+
                                        "</span>"+
                                     "</div>"+
                                "</td>"+
                                 
                             "</tr>"+    
                              "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>양도비</label>"+
                                "</td>"+
                                "<td colspan='2' style='width:80%'>"+
                                       "<input type='text' class='form-control' id='id_sendcouponprice' name='note' onfocus='this.select()' onkeyup='sendcouponpricechange()'  placeholder='양도비 입력...' value='"+CommaString(sendprice)+"'>"+ 
                                "</td>"+
                                 
                             "</tr>"+       
                            "<tr>"+
                                "<td style='"+bgcolor_tag+"'>"+
                                    "<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>총금액</label>"+
                                "</td>"+
                                "<td style='width:40%'>"+
                                    "<select id='sendcoupon_payment_type' onchange='sendcouponpricechange(1)' class='form-control' name='payment_type' required>"+
                                        "<option value='1'>카드결제</option>"+
                                        "<option value='2'>현금결제</option>"+                                    
                                    "</select>"+
                                "</td>"+
                                 "<td style='width:40%;background-color:#ffffaa'>"+
                                       "<span style='float:right'><input class='form-control' type='text'  style='width:150px' id='id_sendcoupontotalprice' name='note' placeholder='총금액 입력...' value='"+CommaString(sendprice)+"' disabled></span>"+ 
            "<span style='float:right'><label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;margin-top:8px'>총금액 : ￦ </label></span>"+
                                       
                                "</td>"+
                             "</tr>"+    
            
            
                                      
                        "</table>";
        
       
    }
    //양도할 라커  선택
    var select_lockers = [];
    function getMoreLockerTable(new_lockers) {

        
        var div_member_table = document.createElement("div");
        var table = document.createElement('table'); //등록일 = couponid                               

        table.innerHTML = "<thead><tr style='background-color:#f8f9fa;height:40px'><th>선택</th><th>번호</th><th>등록일</th><th>리커번호</th><th>비밀번호</th><th>가격</th><th>시작일</th><th>종료일</th><th>회수유무</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        table.className = 'table table-bordered';
        table.width = "100%";
        table.cellspacing = "0";

        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = new_lockers.length;
        //        clog("new_lockers ",new_lockers);
        body.style.backgroundColor = "white";
        div_member_table.append(table);
        if (len > 0) {
            for (var i = 0; i < len; i++) {

                var locker = new_lockers[i];

                var brow = body.insertRow();

                 // 선택
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = new_lockers[i].isdelete != "D" && isNowTimeMinOver(new_lockers[i].endtime) >= 0 ? "<input type='checkbox' id='checkbox_locker_"+i+"' onclick='oncheck_locker("+i+")'>" : "";
                bcell_index.style.maxWidth = "30px";

                // 번호
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = (i + 1) + "";
                bcell_index.style.maxWidth = "30px";

                // 등록일       
                var bcell_id = brow.insertCell();
                bcell_id.innerHTML = new_lockers[i].id.substr(0,10);

                // 라커번호       
                var bcell_num = brow.insertCell();
                bcell_num.innerHTML = new_lockers[i].num;


                // 라커비번
                var bcell_pass = brow.insertCell();
                bcell_pass.innerHTML = new_lockers[i].pass;

                // 라커가격
                var bcell_price = brow.insertCell();
                var locker_price = isObject(locker.price) && locker.price.cash && locker.price.card ? parseInt(locker.price.card) + parseInt(locker.price.cash) : parseInt(locker.price);
                var locker_card = isObject(locker.price) && locker.price.card ? parseInt(locker.price.card) : locker_price;
                var locker_cash = isObject(locker.price) && locker.price.cash ? parseInt(locker.price.cash) : 0;

                if (!isNaN(locker.price)) locker_price = locker_card + locker_cash; //
                if (isNaN(locker_price)) locker_price = 0;
                if (isNaN(locker_card)) locker_card = 0;
                if (isNaN(locker_cash)) locker_cash = 0;
                bcell_price.innerHTML = "" + TXT_WON + CommaString(locker_price) + "";

                //시작일
                var bcell_starttime = brow.insertCell();
                bcell_starttime.innerHTML = new_lockers[i].starttime.substr(0, 10);

                //종료일
                var bcell_endtime = brow.insertCell();
                bcell_endtime.innerHTML = new_lockers[i].endtime.substr(0, 10);

                //회수됨
                var bcell_endtime = brow.insertCell();
                bcell_endtime.innerHTML = new_lockers[i].isdelete && new_lockers[i].isdelete == "D" ? "회수됨" : "-";



            }
        }


        return div_member_table.innerHTML;

    }
    function oncheck_locker(idx){
        if(!idx)idx = 0;
        checkbox_locker = document.getElementById("checkbox_locker_"+idx);
        if(checkbox_locker.checked){
            select_lockers.push(idx);
            select_lockers = trim_sort_1array(select_lockers);
        }else{
            for(var i = 0 ; i < select_lockers.length;i++){
                if(select_lockers[i] == idx){
                    select_lockers.splice(i,1);
                    break;
                }
            }
        }
        send_new_lockers = [];
        var div_sendlockers = document.getElementById("div_sendlockers");
        var lockers_label_tag = "양도할 라커 : ";
        for(var i = 0 ; i < select_lockers.length;i++){
            send_new_lockers.push(buser_new_lockers[select_lockers[i]]);
            lockers_label_tag += "<label style='border-radius:20px;border:1px solid gray;background-color:#f0feef;font-size:16px;pading:10px 25px 10px 25px'>"+buser_new_lockers[select_lockers[i]].num+"번</label>&nbsp;";
        }
        div_sendlockers.innerHTML = lockers_label_tag;
        console.log("send_new_lockers ",send_new_lockers);
    }

    function sendlockercheck(issend){
        
        
        var style = {
             modaltype:"large",
             marginTop:"0px",
             bodycolor:"#ffffff",
             size:{
                 width:"95%",
                 height:"auto"
             },
             top:{
                 color:"#262930",
                 textAlign:"left",
                 paddingLeft:"25px",
                 borderBottom: "1px solid #dddddd"
             },
             bottom:{
                 textAlign:"right",
                 paddingRight:"25px",
                 borderTop: "1px solid #dddddd",
                 
                
             },
             //커스텀 버튼
             button_width: "100px",
             button_height: "43px",
             button_color : "white",
             button_bgcolor : "#31b0f8"
             
             
        };
        if(issend){
            var message = getMoreLockerTable(buser_new_lockers);
            showModalDialog(document.body, "양도할 라커선택", message, "선택완료", "취소", function() {
                if(select_lockers.length == 0){
                    removeSendLockers();
                }
                hideModalDialog();
            }, function() {
                removeSendLockers();
                hideModalDialog();
            },style);
        }else {
            removeSendLockers();
        }
    }
    function removeSendLockers(){
        var locker_x = document.getElementById("locker_x");
        locker_x.checked = true;
        select_lockers = [];
    }
    function onChangeStarttime(){
         var starttime = document.getElementById("starttime");
         var endtime = document.getElementById("endtime");
        
        if(json_coupon.mbstype == "PT" || json_coupon.mbstype == "GX"){
            json_nuser.gabday = parseInt(json_coupon.mbsmaxcount)*4;
            document.getElementById("gabday").innerHTML = json_nuser.gabday;
        }
         endtime.value = nextDay(starttime.value,json_nuser.gabday);
    }
    function sendcouponpricechange(){
        var id_sendcouponprice = document.getElementById("id_sendcouponprice");
        var id_sendcoupontotalprice = document.getElementById("id_sendcoupontotalprice");
        var sendcoupon_payment_type = document.getElementById("sendcoupon_payment_type").value;
        var lockersend = document.querySelector('input[name="locker"]:checked').value;
        var check_sendcoupon_desc = document.getElementById("check_sendcoupon_desc").checked;
        var vat = sendcoupon_payment_type == "1" ? (100+global_vat)/100 : 1; //neel_vat
         
        id_sendcoupontotalprice.value = CommaString(parseCommaInt(id_sendcouponprice.value)*vat);
        id_sendcouponprice.value = CommaString(parseCommaInt(id_sendcouponprice.value));
    }
    function btn_sendcoupon(){
        clog("쿠폰을 양도한다.");
        var check_sendcoupon_desc = document.getElementById("check_sendcoupon_desc").checked;
       
        if (!check_sendcoupon_desc) {
            alertMsg("양도규정 체크박스에 체크해 주세요.");
            return;
        }else if (signaturePadName1.isEmpty()) {
            alertMsg("자필 이름입력이 필요합니다.");
            return;
        } else if (signaturePadSign1.isEmpty()) {
            alertMsg("서명이 필요합니다.");
            return;
        }
        
        var startdate = document.getElementById("starttime").value;
        var enddate = document.getElementById("endtime").value;
        if(!startdate || !enddate){
            alertMsg("기간을 설정해 주세요");
            return;
        }
        else if(startdate && enddate && compare_date(startdate,enddate) > 0){
            alertMsg("시작일은 종료일보다 이전날짜여야 합니다.");
            return;
        }
        
        showModalDialog(document.body, "회원권 양도", "위 내용대로 회원권을 양도하시겠습니까?", "양도하기", "취소", function() {
            sendCouponChange();
          

        }, function() {
            hideModalDialog();
        });
    }
    function sendCouponChange(){
        var obj = new Object();
        
        var remaincount = 1;
        //남은횟수
        if( json_coupon.mbstype == TYPE_GX || json_coupon.mbstype == "PT"){
            var max = json_coupon.mbsmaxcount ? parseInt(json_coupon.mbsmaxcount) : 0;
            var use = json_coupon.usecount ? parseInt(json_coupon.usecount) : 0;
            var remaincount =  max - use; 
        }            
       
        //쿠폰에 양도된 쿠폰이라고 표시한다.
        json_coupon.issendedcoupon = remaincount;
        
        var id_sendcouponprice = parseCommaInt(document.getElementById("id_sendcouponprice").value);
        var id_sendcoupontotalprice = parseCommaInt(document.getElementById("id_sendcoupontotalprice").value);
        var sendcoupon_payment_type = document.getElementById("sendcoupon_payment_type").value;
        var lockersend = document.querySelector('input[name="locker"]:checked').value;
        var check_sendcoupon_desc = document.getElementById("check_sendcoupon_desc").checked;
        var startdate = document.getElementById("starttime").value;
       
        console.log("json_buser",json_buser);
        console.log("json_nuser",json_nuser);
        
        obj.buid = json_buser.uid;
        obj.nuid = json_nuser.uid;
        obj.bname = json_buser.name;
        obj.nname = json_nuser.name;
        obj.coupon =  json_coupon;        
        obj.sendprice = id_sendcouponprice;
        obj.totalsendprice = id_sendcoupontotalprice;
        obj.paymenttype = sendcoupon_payment_type;
        obj.sendlocker = lockersend;
        obj.sendnewlockers = send_new_lockers;
        obj.signdataname = signaturePadName1.toDataURL('image/png');
        obj.signdatasign = signaturePadSign1.toDataURL('image/png');
        obj.startdate = startdate;
        obj.isremoveremaincount = '<?php echo $isremoveremaincount; ?>';
        
        sendCouponData(obj);
    }
    function sendCouponData(obj) {

        if (!nowcentercode) return;

        var _data = {
            "type": "sendcoupon", 
            "centercode": nowcentercode,
            "value": obj
        };

        CallHandler("getdata", _data, function(res) {
            clog("res",res);
            code = parseInt(res.code);
            if (code == 100) {
                alertMsg("성공적으로 양도하였습니다.", function() {
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
    
</script>
