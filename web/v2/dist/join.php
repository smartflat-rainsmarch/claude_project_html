<?php  
include('./common.php'); //아직 회원가입 페이지가 어디로 가야할지 모르겠다.

if(isset($_SESSION['authgroup'.DEV_REAL]) && $_SESSION['authgroup'.DEV_REAL] < AUTH_TRANER){

    echo "<script>alertMsg('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
$re_uid = isset($_POST['mem_uid']) ? $_POST['mem_uid'] : '';
$re_id = isset($_POST['mem_userid']) ? $_POST['mem_userid'] : '';
$re_name = isset($_POST['mem_username']) ? $_POST['mem_username'] : '';
$re_birth = isset($_POST['mem_birth']) ? $_POST['mem_birth'] : '';
$re_phone = isset($_POST['mem_phone']) ? $_POST['mem_phone'] : '';
$re_gender = isset($_POST['mem_gender']) ? $_POST['mem_gender'] : '';
$re_homeaddress = isset($_POST['mem_homeaddress']) ? $_POST['mem_homeaddress'] : '';
$re_lockernumber = isset($_POST['mem_lockernumber']) ? $_POST['mem_lockernumber'] : '';
$re_lockerpass = isset($_POST['mem_lockerpass']) ? $_POST['mem_lockerpass'] : '';
$re_newlockers = isset($_POST['mem_newlockers']) && strlen($_POST['mem_newlockers']) > 5 ? $_POST['mem_newlockers'] : "[]";
$re_starttime = isset($_POST['mem_starttime']) ? $_POST['mem_starttime'] : '';
$re_endtime = isset($_POST['mem_endtime']) ? $_POST['mem_endtime'] : '';
$re_membership = isset($_POST['mem_membership']) ? $_POST['mem_membership'] : '';


//$encode_newlockers = json_encode($re_newlockers, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
//echo "<script>";
//echo "var nnewlockers = ".$re_newlockers;
//echo "</script>";
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
    <link rel="stylesheet" type="text/css" href="css/checkbox.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
<!--    <script src="./libs/fonts/all.min.js" crossorigin="anonymous"></script>-->
<!--    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">-->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet" /> <!--Montserrat 폰트설정-->
    <script src="js/scripts.js?ver3.02ae4"></script>
    <script src="jquery.dd.min.js"></script>
<!--    <script src="./libs/qrcode/qrcode.min.js"></script>-->
    <script src="./libs/visualqrcode/qrcode.js"></script>
    <script src="./libs/visualqrcode/qart.js"></script>
    
    
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
        
        
        /*email progress*/
        .loader {
          border: 3px solid #f3a3a3; /* Light grey */
          border-top: 3px solid #3498db; /* Blue */
          border-radius: 50%;
          width: 20px;
          height: 20px;
          animation: spin 2s linear infinite;
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }
    </style>
    
</head>

<body style="background-color:#f5f8fa">
   
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
   
    <div id="div_header"></div>
    <div align="center" id = "txt_rejoin_user" style="width:100%;height:40px;display:none;background-color:#fee9d2;"><img src = "./img/icon_triangle.png" style="width:24px;height:22px;margin-top:-6px;">&nbsp;&nbsp;<text style="font-size:16px;color:#7e460f;line-height:40px;margin-top:9px">재등록중입니다.</text></div>
    <div align="center" style="width:100%"><!--가운데정렬을 위한 DIV1 -->
        <div align="left" style="max-width:960px;text-align:left"><!--가운데정렬을 위한 DIV2 -->
            <div id="join" style="float:left;width:100%;padding:35px 25px 35px 25px;">
        
       
        
        <div  style="width:100%;background-color:#ffffff;padding:25px;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)">
<!--            <div align="center" style='height:100px'></div>-->
            <div>
                <text id = "id_title_logo" style='color:#262930;font-size:20px;font-weight:700;'>회원가입 신청서</text>
                <div style='float:right;margin-top:-10px'><text style="font-size:15px;color:#3f4254;font-weight:500">결제일:&nbsp;</text><input id="id_payment_date" class='fmont' type='date' style="border:1px solid #e4e6ef;border-radius:8px;width:202px;height:35px;font-size:15px;padding:8px 12px 8px 12px" value="<?php echo date('Y-m-d'); ?>" disabled/></div>
            </div>
            <hr style='border:1px solid #eff2f5;margin-top:25px;margin-left:-25px;margin-right:-25px'/>
            
            
                   
            
<!--            <form action="#" method="post" id="join-us">-->

                <div>
                    <div id=formdiv >
                        <table style='width:100%'>
                            <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="authlevel" class="textevent">고객등급선택<span style='color:red'>*</span></label>
                                </td>
                                <td  style='width:50%'>
                                    <label for="centercode" class="textevent">센터</label>
                                </td>
                            </tr>
                            <tr>
                                <td  style='width:50%;padding-right:12px;height:50px'>
                                    <select id="authlevel" class="form-control myinputtype" onchange="authClick()" name="authlevel" ></select>
                                </td>
                                <td  style='width:50%'>
                                
<!--                                    <select id="centercode" class="form-control" onchange="centerClick()" name="centercode" ></select>-->
                                    <text class='form-control myinputtype' id='txt_centername'></text>
                                </td>
                            </tr>
                            <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="name" class="textevent">이름<span style='color:red'>*</span></label>
                                </td>
                                <td  style='width:50%'>
                                    <label for="birth" class="textevent">생년월일<span style='color:red'>*</span></label><br>                                    
                                </td>
                             </tr>
                             <tr> 
                                  <td  style='width:50%;padding-right:12px;height:50px'>
                                    <input type="text" class="form-control myinputtype" id="name" name="name" placeholder="예) 홍길동" >
                                </td>
                                <td  style='width:50%'>
                                    <div class="form-control myinputtype">

                                        <div id="bir_wrap" name="bir_wrap">

                                            <!-- BIRTH_YY -->
                                            <span class="box">
                                                <select id="yy" style='width:100px;border:0px'> </select>
                                            </span>
                                            &nbsp;

                                            <!-- BIRTH_MM -->

                                            <span class="box">
                                                <select id="mm" style='width:70px;border:0px'>

                                                </select>
                                            </span>
                                            &nbsp;
                                            <span class="box">
                                                <select id="dd" style='width:70px;border:0px'>

                                                </select>
                                            </span>

                                        </div>
                                        <span class="error_next_box"></span>
                                    </div>
                                </td>
                             </tr>
                             
                             <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="phone" class="textevent">휴대폰 번호<span style='color:red'>*</span></label>
                                </td>
                                <td  style='width:50%'>
                                    <label for="gender" class="textevent">성별<span style='color:red'>*</span></label>
                                    
                                </td>
                             </tr>
                             <tr> 
                                <td  style='width:50%;padding-right:12px;height:50px'>
                                    <input type="number" class="form-control myinputtype" maxlength="11" id="phone" name="mobile" oninput="maxLengthCheck(this)" placeholder="숫자만 입력.." >
                                </td>
                                <td  style='width:50%'>
                                    <div class="form-control myinputtype">
                                        <input id="gender_m" type='radio' name='gender' value='M' checked><text for="gender_m" style='font-size:14px'>남</text>&nbsp;&nbsp;<input id="gender_f" type='radio' name='gender' value='F'><text for="gender_f" style='font-size:14px'>여</text>&nbsp;&nbsp;
                                    </div>
                                </td>
                             </tr>
                             <tr>
                                 <td  id='td_address1' style='padding-right:12px;height:50px'>
                                   <label for="home_address" class="textevent">주소</label>                               
                                 </td> 
                                 <td id='td_email1' >
                                    <label for="email" class="textevent" >이메일<span style='color:red'>*</span></label>                                
                                 </td>
                                 
                             </tr>
                             <tr>
                                 <td id='td_address2'  style='padding-right:12px;height:50px'>
                                   
                                        <input type="text" class="form-control myinputtype" id="home_address"  name="home_address" placeholder="예) 서울시 중구 태평로1가 11번지..." >
                                   
                                 </td>
                                 <td id='td_email2' >
                                   
                                     <!--이메일 체크 아이콘들-->
                                     <span align="right" style="float:right;margin-right:40px">
                                         <div id="email_checkdiv" style="width:30px;height:30px;position:absolute;margin-top:13px;display:none">
                                             <label id = "email_icon_loading" class='loader' style=""></label>
                                             <i class="fa-regular fa-circle-exclamation"  id="email_icon_notuse" style="color:red;font-size:20px" title="이메일 형식에 맞지 않거나 중복된 이메일이 있습니다."></i>
                                             <i class="fa-regular fa-circle-check"  id="email_icon_use"style="color:#007bff;font-size:20px"></i>
                                         </div>
                                     </span>
                                     <span><input type="email" class="form-control myinputtype"  onchange='isEmail(this.id)' id="email" name="email" placeholder="예) black@email.com"  style='width:100%;margin-top:5px' ></span>                                       
                                   
                                 </td>
                                 
                             </tr>
                             
                        </table>


                        
                      
                        <br><br>
                       <!--회원권 설정-->
                        <div id="default_user_div">
                            
                             
                            <div align='left' style='border:2px solid #999999;border-radius:5px;'>
                                <div id='couponlist_0' onclick='cListClick(0)'  style='height:60px;border-radius:5px;border-bottom: 1px dashed #dfe2e5;'>
                                    <span style='margin-left:20px;margin-top:15px'>
                                        <label style='margin-top:22px;color:#262930;font-size:18px;font-weight:700;'>회원권 선택<span style='color:red'>*</span></label>                                        
                                    </span>
                                    <div id='div_cicon_updown_0' align='center' style='float:right;width:40px;height:60px;color:#a1a5b7;padding-top:20px'><i class='fa-solid fa-angle-down'></i></div>                                    
                                </div>                    
                                
                                <ul class='c_sub0' style='display:block;'>
                                    <div style='margin-left:-20px;margin-right:20px' >
                                         <label class='textevent'  for="termtype_coupon">기간제 이용권선택</label>
                                        <select id="termtype_coupon" onchange='change_termtype_coupon()' class="form-control myinputtype" name="termtype_coupon" >
                                            <option value='0'>기간제 운동목록을 선택하세요</option>
                                        </select>

                                        <div id='termdatediv' style='display:none;width:100%'>
                                             <table style='width:100%'>
                                                <tr>

                                                    <td style="width:22%">
                                                        <label class='textevent'  for="termtype_starttime">회원권 시작일 : </label><br><input id='termtype_starttime' class='myinputtype'  onchange='change_termtype_coupon()'  style='padding:10px;border-radius:8px'  type='date' value='<?php echo date('Y-m-d'); ?>' />
                                                    </td>
                                                    <td style="width:35%">
                                                        <label class='textevent' >회원권 종료일 : </label><br><label id='termtype_endtime'><?php echo date('Y-m-d');?></label><input class='myinputtype' style='margin-left:20px;visibility:hidden;width:65px;margin-width:40%;padding:10px;border-radius:8px'  id="id_bonusday" type="number" onchange="add_bonusday()" value='0' />
                                                    </td>
                                                    <td style="width:18%">
                                                        <div id="div_termcount" ><label class='textevent' >회원권 횟수 : </label><br><input  id="id_termcount"  type="number" class='myinputtype'  onchange="change_termcount()" style="width:80px;padding:10px;border-radius:8px" value='0' /></div>
                                                    </td>
                                                    <td align="right" style="width:25%">
                                                        <div id="id_termprice" style='width:160px' ><label class='textevent' style="float:left" >회원권 가격 </label><br>
        <!--                                                    <input id ="input_term_novat_price" value='0' style='display:none'/><input id='input_term_price' type="text"  onkeyup="inputChangeComma('input_term_novat_price')" onfocus='this.select()' placeholder="카드 결제금액..."  class='myinputtype'  onchange="checkAllPrice(113)"  style='width:160px; height:auto;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px' value='0'/></div>-->
                                                            <input id ="input_term_novat_price" value='0' style='display:none'/><input id='input_term_price' type="text"  placeholder="카드 결제금액..."  class='myinputtype' style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px' value='0' disabled/></div><!--neel_test-->
                                                    </td>
                                                </tr>

                                            </table>
        <!--                                    <hr style="border: solid 1px light-gray;"> -->

                                        </div>

                                        <div id='div_term_price'>
                                            <hr style="border: solid 1px light-gray;">
                                            <label for="payment_type" class="textevent" style='margin-top:-15px'>결제 방법<span style='color:red'>*</span></label>
                                            <select id="payment_type" onchange="checkAllPrice(120)" class="form-control myinputtype" name="payment_type" >
                                                <option value=''>결제방법을 선택하세요</option>
                                                <option value="1">카드결제</option>
                                                <option value="2">현금결제</option>
                                                <option value="4">카드+현금</option>
                                                <!--                                <option value="3">계좌이체</option>                                -->
                                            </select>
                                             <table id ='table_totalprice' class='class_table_term' style='width:100%;display:none' >
                                                <tr style='width:100%'>
        <!--
                                                    <td style='width:200px;display:none'>
                                                        <label class="textevent">현금 총액</label>
                                                    </td>
        -->
                                                    <td style='width:16%'>
                                                        <label class="textevent">카드</label>
                                                    </td>
                                                    <td style='width:16%'>
                                                        <label class="textevent">현금</label><br>                                    
                                                    </td>
                                                    <td style='width:16%'>
                                                        <label class="textevent">미수금</label><br>                                    
                                                    </td>
                                                    <td style='width:16%'>
                                                        <label class="textevent" style='color:#009ef7'>할인</label><br>                                    
                                                    </td>

                                                 </tr>
                                                 <tr>
        <!--
                                                    <td style='min-width:120px; background-color:yellow;display:none'>
                                                       <input type="text" class="form-control" id="id_cash_total" onfocus='this.select()' placeholder="현금기준 총금액" disabled>    
                                                    </td>
        -->
                                                    <td style='min-width:16%'>
                                                       <input type="text" class="form-control" id="id_price_card" onkeyup="checkAllPrice(1)" onfocus='this.select()' placeholder="카드 결제금액..." novalidate>    
                                                    </td>
                                                    <td style='min-width:16%'>
                                                       <input type="text" class="form-control" id="id_price_cash" onkeyup="checkAllPrice(2)" onfocus='this.select()' placeholder="현금 결제금액..." novalidate>    
                                                    </td>
                                                    <td style='min-width:16%'>
                                                       <input type="text" class="form-control" id="id_price_remain"  onkeyup="checkAllPrice(3)" onfocus='this.select()'  placeholder="미수금 가격..."  placeholder="미수금 입력 ..." novalidate>    
                                                    </td>
                                                    <td style='min-width:16%'>
                                                        <input type="text" class="form-control" id="id_price_discount"  onkeyup="checkAllPrice(4)" onfocus='this.select()' style='color:#009ef7'  placeholder="할인 가격..."  placeholder="할인가 입력 ..." novalidate>    
                                                    </td>

                                                 </tr>
                                                 <tr>
                                                     <td colspan = "4">
                                                         <span style="float:left"><label class="textevent" style="margin-right:10px;margin-top:5px">총금액</label></span>
                                                         <span style="float:left"><input type="text" class="form-control" id="id_price_total" placeholder="총 금액..." style="margin-top:15px" disabled></span>
                                                         <span style="float:right"><input type="text" class="form-control" id="id_price_totalremain" placeholder="결제 금액..." style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px;margin-top:15px' disabled></span>
                                                         <span style="float:right"><label class="textevent"  style="margin-right:10px;margin-top:5px">결제금액</label></span>
                                                     </td>
                                                 </tr>
                                            </table> 
                                         </div>
                                    </div>
                                </ul>
                            </div>
                           
                            
                            <br>
                            
                            <div align='left' style='border:2px solid #999999;border-radius:5px;'>
                                <div id='couponlist_1' onclick='cListClick(1)'  style='height:60px;border-radius:5px;border-bottom: 1px dashed #dfe2e5;'>
                                    <span style='margin-left:20px;margin-top:15px'>
                                        <label style='margin-top:22px;color:#262930;font-size:18px;font-weight:700;'>라커 사용</label>
                                    </span>
                                    <div id='div_cicon_updown_1' align='center' style='float:right;width:40px;height:60px;color:#a1a5b7;padding-top:20px'><i class='fa-solid fa-angle-down'></i></div>                                    
                                </div>                    
                                
                                <ul class='c_sub1' style='display:none;'>
                                    <div id="locker_wrap" style='height:auto'>
                                        <div id='div_new_termprice' style='margin-left:-20px;margin-right:20px' >
                                            <label for="use_locker" class='textevent' >라커 사용</label>
                                            <select id="use_locker" onchange="locker_change(1)" class="form-control myinputtype" name="use_locker" >
                                                <option value="0">개인라커 사용안함</option>
                                                <option value="1">개인라커 사용함</option>
                                            </select>

                                            <div id ='locker_info' style='width:100%;display:none' >
                                                <table style='width:100%;' >
                                                    <tr>

                                                        <td style='width:18%'>
                                                            <label class="textevent">라커 번호</label>
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class="textevent">라커 비밀번호</label><br>                                    
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class="textevent">라커 개월수</label><br>                                    
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class="textevent">서비스 개월수</label><br>                                    
                                                        </td>
                                                        <td align="right"  style='width:28%'>
                                                            <div style="width:160px">
                                                                <label class="textevent" style="float:left">라커 가격</label>
                                                            </div>
                                                        </td>
                                                     </tr>
                                                    <tr>

                                                         <td style='padding-right:2px'>
                                                           <text class='form-control myinputtype' id='id_locker_number'  ></text>
                                                        </td>
                                                         <td style='padding-right:2px'>
                                                            <input type="number" class="form-control myinputtype" id="id_locker_pass" name="id_locker_pass"  placeholder="라커 비밀번호" novalidate>                                
                                                        </td>
                                                        <td style='padding-right:2px'>
                <!--                                           <input type="number" class="form-control" id="id_locker_month" onchange='checkLockerPrice()' onfocus='this.select()' name="id_locker_month" placeholder="라커 가격" value='0' novalidate>                             -->
                                                            <select id="id_locker_month" onchange='checkLockerPrice(319)' class="form-control myinputtype" name="use_locker"   >
                                                                <option value="0">선택</option>
                                                                <option value="1">1개월</option>
                                                                <option value="2">2개월</option>
                                                                <option value="3">3개월</option>
                                                                <option value="4">4개월</option>
                                                                <option value="5">5개월</option>
                                                                <option value="6">6개월</option>
                                                                <option value="7">7개월</option>
                                                                <option value="8">8개월</option>
                                                                <option value="9">9개월</option>
                                                                <option value="10">10개월</option>
                                                                <option value="11">11개월</option>
                                                                <option value="12">12개월</option>
                                                                <option value="13">13개월</option>
                                                                <option value="14">14개월</option>
                                                                <option value="15">15개월</option>
                                                                <option value="16">16개월</option>
                                                                <option value="17">17개월</option>
                                                                <option value="18">18개월</option>
                                                                <option value="19">19개월</option>
                                                                <option value="20">20개월</option>
                                                                <option value="21">21개월</option>
                                                                <option value="22">22개월</option>
                                                                <option value="23">23개월</option>
                                                                <option value="24">24개월</option>
                                                                <option value="25">25개월</option>
                                                                <option value="26">26개월</option>
                                                                <option value="27">27개월</option>
                                                                <option value="28">28개월</option>
                                                                <option value="29">29개월</option>
                                                                <option value="30">30개월</option>
                                                                <option value="31">31개월</option>
                                                                <option value="32">32개월</option>
                                                                <option value="33">33개월</option>
                                                                <option value="34">34개월</option>
                                                                <option value="35">35개월</option>
                                                                <option value="36">36개월</option>
                                                            </select>
                                                        </td>
                                                        <td style='padding-right:2px'>
                <!--                                           <input type="number" class="form-control" id="id_locker_month" onchange='checkLockerPrice()' onfocus='this.select()' name="id_locker_month" placeholder="라커 가격" value='0' novalidate>                             -->
                                                            <select id="id_locker_servicemonth" onchange='checkLockerPrice(310)' class="form-control myinputtype" name="use_locker" style='color:red;'  >
                                                                <option value="0" style='color:red'>0개월</option>

                                                            </select>
                                                        </td>
                                                        <td align="right">
                                                           <input id ="input_locker_novat_price" value='0' style='display:none'/><input id='input_locker_price' type="text"  onkeyup="inputChangeComma('input_locker_price')" onfocus='this.select()' placeholder="라커금액..."   onchange="checkLockerPrice(311)"  class="form-control myinputtype"  style='width:160px; height:auto;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px;margin-left:20px;'  value='0' /><!--neel_test-->
                                                        </td>
                                                     </tr>
                                                     <tr>
                                                         <td colspan='5'>
                                                                <br>
                                                                <input id='locker_starttime' class='myinputtype'  onchange='change_locker_starttime()'  style='width:250px;padding:10px;border-radius:8px'  type='date' value='<?php echo date('Y-m-d'); ?>' /> ~ <input id='locker_endtime' class='myinputtype'  onchange='change_locker_starttime()'  style='width:250px;padding:10px;border-radius:8px'  type='date' value='' />

                                                         </td>

                                                     </tr>
                                                </table> 
                                                <hr style="border: solid 1px light-gray;">
                                                <label for="locker_payment_type" class="textevent" style='margin-top:-15px'>결제 방법<span style='color:red'>*</span></label>
                                                <select id="locker_payment_type" onchange="checkLockerPrice(300)" class="form-control myinputtype" name="payment_type" >
                                                    <option value=''>라커 결제방법을 선택하세요</option>
                                                    <option value="1">카드결제</option>
                                                    <option value="2">현금결제</option>
                                                    <option value="4">카드+현금</option>
                                                    <!--                                <option value="3">계좌이체</option>                                -->
                                                </select>
                                                <table id ='locker_table_totalprice' class='class_table_locker' style='width:100%;display:none' >
                                                    <tr style='width:100%'>
            <!--
                                                        <td style='width:200px;display:none'>
                                                            <label class="textevent">현금 총액</label>
                                                        </td>
            -->
                                                        <td style='width:18%'>
                                                            <label class="textevent">카드</label>
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class="textevent">현금</label><br>                                    
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class="textevent">미수금</label><br>                                    
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class="textevent">총금액</label><br>                                    
                                                        </td>
                                                        <td align="right"  style='width:28%'>
                                                            <div style="width:160px">
                                                                <label class="textevent" style="float:left">결제금액</label>
                                                            </div>
                                                        </td>
                                                     </tr>
                                                     <tr>
            <!--
                                                        <td style='min-width:120px; background-color:yellow;display:none'>
                                                           <input type="text" class="form-control" id="id_cash_total" onfocus='this.select()' placeholder="현금기준 총금액" disabled>    
                                                        </td>
            -->
                                                        <td style='min-width:18%'>
                                                           <input type="text" class="form-control" id="locker_id_price_card" onkeyup="checkLockerPrice(301)" onfocus='this.select()' placeholder="카드 결제금액..." novalidate>    
                                                        </td>
                                                        <td style='min-width:18%'>
                                                           <input type="text" class="form-control" id="locker_id_price_cash" onkeyup="checkLockerPrice(302)" onfocus='this.select()' placeholder="현금 결제금액..." novalidate>    
                                                        </td>
                                                        <td style='min-width:18%'>
                                                           <input type="text" class="form-control" id="locker_id_price_remain" onclick="alertMsg('라커결제는 미수금기능을 사용할 수 없습니다.')" onkeyup="checkLockerPrice(303)" onfocus='this.select()'  placeholder="미수금 가격..."  style='background-color:#e9ecef' novalidate readonly>    
                                                        </td>
                                                        <td style='min-width:18%'>
                                                            <input type="text" class="form-control" id="locker_id_price_total" placeholder="총 금액..." disabled>    
                                                        </td>
                                                        <td align="right">
                                                            <input type="text" class="form-control" id="locker_id_price_totalremain" placeholder="결제 금액..." style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px' disabled>    
                                                        </td>
                                                     </tr>
                                                </table> 
                                            </div>
                                        </div>
                                    </div>
                            
                                </ul>
                            </div>
                            <br>
                        <!--라커 설정-->
                      
                        
                            <!--PT 설정-->
                            
                            <div align='left' style='border:2px solid #999999;border-radius:5px;'>
                                <div id='couponlist_2' onclick='cListClick(2)'  style='height:60px;border-radius:5px;border-bottom: 1px dashed #dfe2e5;'>
                                    <span style='margin-left:20px;margin-top:15px'>
                                        <label style='margin-top:22px;color:#262930;font-size:18px;font-weight:700;'>PT 선택</label>
                                    </span>
                                    <div id='div_cicon_updown_2' align='center' style='float:right;width:40px;height:60px;color:#a1a5b7;padding-top:20px'><i class='fa-solid fa-angle-down'></i></div>                                    
                                </div>                    
                                
                                <ul class='c_sub2' style='display:none;'>
                                    <div style='margin-left:-20px;margin-right:20px' >
                                         <div id="counttype_wrap" style='height:100px' >


                                            <span  style='float:left;width:48%'>
                                                 <label id='id_ptgx_title'  class='textevent'  for="counttype_wrap">PT 이용권선택</label><br>
                                                <select  class='myinputtype'  id="counttype_coupon" onchange ='counttype_visible_change()'  style="width:100%;padding:10px;border-radius:8px" ></select>
                                            </span>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <!-- BIRTH_MM -->

                                             <span  style='float:right;width:48%'>
                                                 <label class='textevent'  for="counttype_wrap">PT 가격</label><br>
                                                 <input  class='myinputtype' id='counttype_coupon_price' type='text' value='0' placeholder='가격입력'  style="width:100%;padding:10px;border-radius:8px"  readonly/>

                                            </span>

                                        </div>
                                         <div id = "rpt_div_price_total" style='height:100px;display:none'>
                                                 <div  style='height:1px;margin-left:-20px;margin-right:-20px;background-color:#eff2f5'>
                                                 </div>
                                                 <table id ='rpt_table_totalprice' style='width:100%;' >
                                                    <tr style='width:100%'>
                                                        <td style='width:18%'>
                                                            <label class='textevent'>카드</label>
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class='textevent'>현금</label><br>
                                                        </td>
                                                        <td style='width:18%'>
                                                            <label class='textevent'>미수금</label><br>
                                                        </td>
                                                        <td style='width:18%%'>
                                                            <label class='textevent'>총금액</label><br> 
                                                        </td>
                                                        <td align="right"  style='width:28%'>
                                                            <div style="width:160px">
                                                                <label class="textevent" style="float:left">결제금액</label>
                                                            </div>
                                                        </td>
                                                     </tr>
                                                     <tr>

                                                        <td style='min-width:18%;padding-right:10px'>
                                                           <input type='text' class='form-control  myinputtype' id='rpt_id_price_card' onkeyup='checkAllPrice(1)' onfocus='this.select()' placeholder='카드 결제금액...' value ='0' novalidate disabled>    
                                                        </td>
                                                        <td style='min-width:18%;padding-right:10px'>
                                                           <input type='text' class='form-control myinputtype' id='rpt_id_price_cash' onkeyup='checkAllPrice(2)' onfocus='this.select()' placeholder='현금 결제금액...' value ='0' novalidate disabled>
                                                        </td>
                                                        <td style='min-width:18%;padding-right:10px'>
                                                           <input type='text' class='form-control myinputtype' id='rpt_id_price_remain'  onkeyup='checkAllPrice(3)' onfocus='this.select()' placeholder='미수금 가격...' value ='0' disabled>    
                                                        </td>
                                                         <td style='min-width:18%;padding-right:10px'>
                                                            <input type='text' style='border:0px' class='form-control' id='rpt_id_price_total' placeholder='총 금액...' value='0' disabled>
                                                        </td>
                                                         <td align="right">
                                                            <input type='text'class='form-control'  id='rpt_id_price_totalremain' placeholder='결제 금액...' style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px' value='0' disabled>
                                                        </td>
                                                     </tr>

                                                </table>
                                           </div>    

                                         <div id="div_teachers" style="display:none">


                                                <label for="teachers_list"  class='textevent' >트레이너 선택</label>
                                                <div class="form-control myinputtype">
                                                    <input id="traner_am" type='radio' name='ampm' value='AM' style='margin-top:10px' checked>&nbsp;오전&nbsp;&nbsp;
                                                    <input id="traner_pm" type='radio' name='ampm' value='PM'>&nbsp;오후&nbsp;&nbsp;

                                                    <span style='float:right'>
                                                        <select id="teachers_list" style="width:300px;display:block;border:0px" name="teachers_list" >
                                                        </select>
                                                    </span>
                                                </div>
                                                 <br>
                                            </div>

                                         <div align="center" id='set_pt_doc' onclick="getPTJoin()" style="display:none;background-color:#33a186;border:0px;height:110px;padding-top:20px;margin-top:20px" class='form-control'>
                                             <label style='color:white; font-size:23px;'>P.T 계약서 작성완료!</label><br>
                                             <label id='pt_change_button' style='color:#ff0000; font-size:16px;font-weight:bold;margin-top:-14px'></label><br>
                                             
                                             <label style='color:#faa3b4; font-size:15px;'>*PT정보수정시 클릭하세요</label>
                                         </div>
                                     </div>
                                </ul>
                            </div>
                           
                            <br>
                               
                            <div align='left' style='border:2px solid #999999;border-radius:5px;'>
                                <div id='couponlist_3' onclick='cListClick(3)'  style='height:60px;border-radius:5px;border-bottom: 1px dashed #dfe2e5;'>
                                    <span style='margin-left:20px;margin-top:15px'>
                                        <label style='margin-top:22px;color:#262930;font-size:18px;font-weight:700;'>기타상품</label>
                                    </span>
                                    <div id='div_cicon_updown_3' align='center' style='float:right;width:40px;height:60px;color:#a1a5b7;padding-top:20px'><i class='fa-solid fa-angle-down'></i></div>                                    
                                </div>                    
                                
                                <ul class='c_sub3' style='display:none;'>
                                    
                                    <div id="other_wrap" style='height:auto'>                                        
                                        <div style='margin-left:-20px;margin-right:20px' >
                                            <label class='textevent'  for="other_coupon">기타상품 추가</label>
                                            <select id="select_other_coupon" onchange='insert_other_coupon()' class="form-control myinputtype" name="termtype_coupon" >
                                                <option value='0'>기타상품을 선택하세요</option>
                                            </select>
                                            <div id='div_inserted_other_coupon'></div>
                                            
                                            
                                        </div>
                                    </div>
                            
                                </ul>
                            </div>
                            <br>
                        
                        <br>
                        
                        
                        
                        <!--가입경로 사용안함 XXX-->
                            <div style="display:none">

                                <label for="subscription_path">가입경로</label>
                                <div class="form-control" name="subscription_path">
                                    <div>
                                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="간판">&nbsp;간판&nbsp;&nbsp;&nbsp;
                                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="현수막">&nbsp;현수막&nbsp;&nbsp;&nbsp;
                                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="광고지">&nbsp;광고지&nbsp;&nbsp;&nbsp;
                                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="소개">&nbsp;소개&nbsp;&nbsp;&nbsp;
                                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="인터넷">&nbsp;인터넷&nbsp;&nbsp;&nbsp;
                                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="전봇대광고">&nbsp;전봇대광고
                                        <br><input class="checkboxgroup" type="checkbox" id="checkbox_other" name="chk_info" value="기타">&nbsp;기타<input id="edittext_other" class="form-control" name="edittext_other" placeholder="기타 입력란.." style="height:40px; display:none" />
                                    </div>
                                </div>
                            </div>
                  
                            <br>
                            <label for="subscription_path" class="textevent">기타특이사항</label>                          
                            <div>
                                <input id="id_other_input" class="form-control myinputtype" name="edittext_other" placeholder="기타 특이사항 입력란.." />
                            </div>
                    
                            <br>
                            <div style='width:100%;height:50px;border-bottom: 1px dashed #eff2f5;'>
                                <text style='margin-top:15px;color:#262930;font-size:18px;font-weight:700;line-height:50px'>약관 및 규정</text>
                            </div>
                            <div class="form-control" style="padding-left:20px;padding-right:20px;padding-bottom:20px;margin-top:30px">
                                <div  style='width:100%;height:50px;border-bottom: 1px dashed #eff2f5'>
                                    <label for="terms_container" class="textevent" style='float:left'>이용약관</label>
                                    <span style="float:right;margin-top:20px;"><text class='textevent'>전체 이용약관 확인</text></span>
                                    <span style="float:right;margin-top:20px;"><label class="mycheckbox" style='margin-left:-30px'><input id='id_all_terms' type='checkbox' onclick="all_check_click()"><span class="checkmark"></span></label></span>
                                   
                                    
                                </div>
                                <div id="terms_container" name="terms_container" ></div>
                            </div>
                            
                            <hr style="border: solid 1px light-gray;margin-left:-20px;margin-right:-20px">
                            <label for="privacy_container" class="textevent">개인정보 수집 및 이용</label>
                            <div id="privacy_container" class="form-control myinputtype" name="privacy_container">

                                <text style='font-size:15px;color:#5e6278;'>개인정보 수집 및 이용에 동의하지 않을 권리가 있으며 동의를 거부할 경우 회원가입이 불가능합니다.</text> 

                            </div>
                            <div style="margin-top:20px;margin-bottom:20px"><text  class='textevent' style='margin-top:15px;'>(필수) 위 개인정보를 수집/이용하는데 동의하십니까?</text>
                                
                                <span style="float:right;"><text class='textevent'>동의합니다.</text></span>
                                <span style="float:right;"><label class="mycheckbox" style='margin-left:-30px'><input id='id_privacy_policy' type='checkbox'><span class="checkmark"></span></label></span>
                            </div>
                            <div id="div_mainuse_container" >
                                <hr style="border: solid 1px light-gray;margin-left:-20px;margin-right:-20px">
                                <label id ="mainuse_container_title" for="mainuse_container" class="textevent" style='display:none'>주요 이용규정 및 환불규정</label>
                                <div id="mainuse_container" class="form-control myinputtype" name="mainuse_container">
                                </div>

                                  <div style="margin-top:20px;margin-bottom:20px"><text  class='textevent' style='margin-top:15px;'>(필수)약관의 모든 내용을 숙지하였으며, 이에 동의합니다</text>

                                    <span style="float:right;"><text class='textevent'>동의합니다.</text></span>
                                    <span style="float:right;"><label class="mycheckbox" style='margin-left:-30px'><input id='id_privacy_policy2' type='checkbox'><span class="checkmark"></span></label></span>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
<!--            </form>-->
            <hr style="border: solid 1px light-gray;">
            <!-- 싸인 DIV START-->
            <div id="signdiv">
                <div align="center" style="width:100%;height:80px">
                <label for='signpad' style='font-size:15px;color:#262930;font-weight:500;margin-top:30px'>약관의 모든 내용을 숙지하였으며, 이에 동의합니다.</label>
                </div>
               <div id='signpad'>
                <table style='width:100%'>
                    <tr>
                        <td style='width:20%;height:200px;vertical-align:top'>
                            
                                <text style='color:#3f4254;font-size:15px;font-weight:500'>이름 입력란:</text><br>
                                <button class='button' id='clear' onclick='clear_sign(1)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>
                            
                        </td>
                        <td id='signtd1' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>
                           
                            <div id='sign_devide1' style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;'></div>
                            <div id='sign_devide2' style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;'></div>
                            <div id='div_namepad' class='wrapper'>
                                <canvas id='signature-pad-name' class='signature-pad-name' style='width:100%;height:200px'></canvas>
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
                             <button class='button' id='clear' onclick='clear_sign(2)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>
                        </td>
                        <td id='signtd2' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>
                            <div class='wrapper'>
                                <canvas id='signature-pad-sign' class='signature-pad-sign' style='width:100%;height:200px'></canvas>
                            </div>
                        </td>
                    </tr>
                    
                </table>
                
            </div>

            </div>

            <!-- 싸인 DIV END-->

            <br>
            <div style='width:100%'>
                <button id='id_register_join' onclick="btn_register()" class="btn btn-primary btn-raised" style='float:right;width:140px;border:0px;'>회원가입하기</button>
                <button id='id_close_join' onclick="btn_close_join()" class="btn btn-primary btn-raised" style='border:0px;float:right;width:140px;display:none;margin-right:10px'>가입완료</button>
            </div><br><br>


            <!-- 회원가입한 고객 QR코드 Dialog -->
            <div id='myModal' class='modal fade' role='dialog'>
                <div class='modal-dialog'>

                    <!-- Modal content-->
                    <div class='modal-content'  style='border-radius:10px'>
                        <div class='modal-header' style='background-color:#fff'>
                            
                                <label id='result_title' style='font-size:20px;color:#262930;font-weight:700;line-height:50px;'></label>
                                <span id='span_qrcode_icon'></span>
                                
                        </div>
                        <div id='div_total_price' style='float:right;margin-top:20px;'></div>
                        <div id='div_modal_qrcode' class='modal-body' style='text-align:center;display:none'>
                            
                           <div style='width:100%;height:auto;background-color:#ffffff;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);padding:10px'>
                                <label id='usercodetitle' style='margin-top:10px;margin-bottom:10px;margin-left:10px;font-size:16px; color:#3f4254;float:left;font-weight:700;'>안드로이드 QR코드</label><br>
                                <hr style='border: solid 1px light-gray;margin-left:-13px;margin-right:-13px'>
                                <div align='center' id='qrcode_android'  style='padding:20px'></div>
                                <hr style='border: solid 1px light-gray;margin-left:-13px;margin-right:-13px'>
                                <text style='font-size:14px' >https://play.google.com/store/apps/details?id=com.blackcompany.blackproject</text>
                            </div><br>
                            <div style='width:100%;height:auto;background-color:#ffffff;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);padding:10px'>
                               
                                <label id='usercodetitle' style='margin-top:10px;margin-bottom:10px;margin-left:10px;font-size:16px; color:#3f4254;float:left;font-weight:700;'> 아이폰 QR코드</label><br>
                                <hr style='border: solid 1px light-gray;margin-left:-13px;margin-right:-13px'>
                                <div align='center' id='qrcode_ios'  style='padding:20px'></div>
                                <hr style='border: solid 1px light-gray;margin-left:-13px;margin-right:-13px'>
                                <text style='font-size:14px' >https://apps.apple.com/us/app/블랙짐/id1568060103</text>
                            </div><br>
                            
                            
                            <p align='center'><text style='font-size:14px;color:#3f4254'>스토어에서 '블랙짐'으로 검색하세요.</text></p>
                        </div>
                        <div class='modal-footer' style='background-color:#fff'>
                            <button id='btn_finish' type='button' class='btn btn-default' onclick='onclick_btn_finish()' style='background-color:#009ef7;color:white;display:none'>확인</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 회원가입 완료 Dialog -->
            <div id="end_modal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header" style='background-color:#55a7ff'>
                            <h3 id="end_modaltitle">회원가입완료</h3>
                        </div>
                        <div class="modal-body" style="text-align:center">
                            <p id="end_modalbody1" align="center">회원가입을 완료하였습니다.!</p>
                            <p id="end_modalbody2" align="center">홈화면으로 이동합니다.</p>
                        </div>
                        <div class="modal-footer" style='background-color:#55a7ff'>
                            <button type="button" class="btn btn-default" onclick="go_home()">홈으로</button>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- container end -->

    </div> <!-- join end -->
        </div>
    </div>
    
  
    <!-- 뒤로가기 하시겠습니까?  Dialog -->
<!--
    <div id="backModal" class="modal fade" role="dialog">
        <div class="modal-dialog">


            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="usercodetitle">페이지를 나가시겠습니까?</h3>
                </div>
                <div id="modal_body" class="modal-body" style="text-align:center">
                    페이지를 나가면 모든 내용이 지워집니다.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" onclick="back_cancel()">취소</button>
                    <button type="button" class="btn btn-default" onclick="back_yes()">나가기</button>
                </div>
            </div>

        </div>
    </div>
-->

    <!--===========================-->
    <!--반드시 삽입해야함-->
    <!--===========================-->
    <div id="div_top"></div>
    <div id="div_nav"></div>
    <div id="div_bottom"></div>
    
    <script src="signature_pad.min.js"></script>
    <script src="signature/assets/json2.min.js"></script>
    <script>
        
         var signtd1 = document.getElementById("signtd1");
         var signtd2 = document.getElementById("signtd2");
         var sign_devide1 = document.getElementById("sign_devide1");
         var sign_devide2 = document.getElementById("sign_devide2");
         
        var signtd1_width = signtd1.offsetWidth;
        var signtd1_height = signtd1.offsetHeight;
        sign_devide1.style.marginLeft = signtd1_width/3;
        sign_devide2.style.marginLeft = signtd1_width/3*2;
        clog("signtd1 width "+signtd1.offsetWidth+" signtd2 width "+signtd2.offsetWidth);
       
        var isuse_email = false; //이메일을 사용가능한가 체크
        
//        var qrcode_android = new QRCode(document.getElementById("qrcode_android"), {
//            text: "https://play.google.com/store/apps/details?id=com.blackcompany.blackproject",
//            width: 200,
//            height: 200,
//            colorDark : "#000000",
//            colorLight : "#ffffff",
//            correctLevel : QRCode.CorrectLevel.H
//        });
//        var qrcode_ios = new QRCode(document.getElementById("qrcode_ios"), {
//            text: "https://apps.apple.com/us/app/블랙짐/id1568060103",
//            width: 200,
//            height: 200,
//            colorDark : "#000000",
//            colorLight : "#ffffff",
//            correctLevel : QRCode.CorrectLevel.H
//        });
       
       
        
        //qrcode_android.clear(); // clear the code.
        //qrcode_android.makeCode("http://naver.com"); // make another code.
        
        var re_obj = new Object();
        var reregist = 0;
    
        
        var regist_total_price = 0;
        
        var listenInterval = null;
        var txt_ptgx = [{"trainingname":"P.T","teachername":"트레이너"},{"trainingname":"GX","teachername":"강사"}]
        try {
            if (window.android) window.android.setOrientation("portrait");
        } catch (e) {}
        var isshowptpopup = false;
        var pt_join_data = new Object();
        var param_pagetype = getParam("pagetype");
        var param_catalogtype = getParam("catalogtype");
        var param_catalognum = getParam("catalognum");
        var param_centercode = getParam("centercode");
        
        var canvasName = document.getElementById("signature-pad-name");
        var canvasSign = document.getElementById("signature-pad-sign");
        //                clog("width ", $("#formdiv").width());
        
        canvasName.width = signtd1_width;//좌측 이름입력란 텍스트 때문에 해당영역 100을 빼준다
        canvasSign.width = signtd1_width;//좌측 서명란 텍스트 때문에 해당영역 100을 빼준다
        canvasName.height = signtd1_height;
        canvasSign.height = signtd1_height;
        var code = "";
        var registerid = "";
        var signaturePadName = new SignaturePad(document.getElementById('signature-pad-name'), {
            backgroundColor: 'rgba(255, 255, 0, 0)',
            penColor: 'rgb(0, 0, 255)',
           
        });
        var signaturePadSign = new SignaturePad(document.getElementById('signature-pad-sign'), {
            backgroundColor: 'rgba(255, 255, 255, 0)',
            penColor: 'rgb(0, 0, 255)',
           
        });
        
        var sign_count = {};
        var sign_role_data = {};
        var signaturePadPTTermName1 = null;
        
        
//        var parentWidth = $(canvas).parent().outerWidth();
//        canvasName.setAttribute("width", parentWidth);
//        canvasSign.setAttribute("width", parentWidth);
        
        var saveButton = document.getElementById('save');
        var cancelButton = document.getElementById('clear');

        var all_check = document.getElementById("id_all_terms");
        
        var termsdatas = [];
        var termsofservice_count = 0;
        var ptruledata = "";
        //        var alllocker = null;
        var total_price = 0;
        var mbs_coupons = [];
        var my_centercode = -1;
        var json_price = {};
        var othercoupons = [];
        var pt_json_price = {};
        var is_firstuser = 1;
        var selected_mbs = null;
        var teacherlist = [];
        initInputSelectYMD(document.getElementById("yy"), document.getElementById("mm"), document.getElementById("dd"));
        var termtype_desc = "";
        var counttype_desc = "";
        var locker_desc = "";
        
        var default_locker_month_price = 10000;
        var default_locker_day_price = 400;
        var groupcode = "<?php echo $groupcode; ?>";
        var groupname = "<?php echo $groupname; ?>";
        $(document).ready(function() {
            
            
            
            var id_payment_date = document.getElementById("id_payment_date");
            
            
            ///qrcode 이미지
            document.getElementById("qrcode_ios").innerHTML = makeQRTag("https://apps.apple.com/us/app/블랙짐/id1568060103");
            document.getElementById("qrcode_android").innerHTML = makeQRTag("https://play.google.com/store/apps/details?id=com.blackcompany.blackproject");
            
            var param_groupcode = getParam("groupcode");
            if(param_groupcode)groupcode = param_groupcode;
            
            clog("groupcode "+groupcode);
//            var centercodes = "<?php echo $centercodes; ?>";
            savekey = "<?php echo $id; ?>";
//            var centers = centercodes.split(',');
            var auth = "<?php echo $auth; ?>";

            id_payment_date.disabled = auth >= AUTH_OPERATOR ?  false : true;
            
            
           
            var id_title_logo = document.getElementById("id_title_logo");
            //if(groupname)id_title_logo.innerHTML = groupname+" 회원가입 신청서";
//            if(groupcode)id_title_logo.src = "../../../ssapi/img/"+groupcode+"/logos/web_title_white_650x100.png";
            
           
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
                    //                                arr.sort(sort_by('auth_num', true, (a) =>  a.toUpperCase()));
                    arr.sort(sort_by('auth_num', true, parseInt));
                    var auth_group = document.getElementById('authlevel');
                    if (arr.length > 0) {
                        auth_group.innerHTML = "<option value=''>== 회원등급을 선택하세요 ==</option>";

                        for (var i = 0; i < arr.length; i++) {
                            var opt = document.createElement('option');
                            opt.value = arr[i]["auth_num"];
                            opt.innerHTML = arr[i]["auth_name"];
                            auth_group.appendChild(opt);
                        }

                        //이전에 선택되어진게 있다면 이전에 선택되어진것으로 바꾼다.
                        var value = loadSetGroupValue("joinauth", auth_group);


                    }

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러");

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
                     if(param_centercode != getData("nowcentercode")){
                        for(var i = 0 ; i < arr.length;i++){
                            if(arr[i].centercode == param_centercode){
                                saveDataGroupCenter(groupcode,arr[i].centername,arr[i].centercode);
                                break;
                            }
                        }    
                    }
                
                    
                    header_init("<?php echo $auth;?>","<?php echo $id;?>",arr,function(){
                        var centercode_group = document.getElementById('header_center_select');
                        if (arr.length > 1) centercode_group.innerHTML = "<option value=''>== 센터를 선택하세요 ==</option>";
                        else if (arr.length == 1) {
                            setMembership(arr[0]["centercode"]);
                        }

                        for (var i = 0; i < arr.length; i++) {
                            var opt = document.createElement('option');
                            opt.value = arr[i]["centercode"];
                            opt.innerHTML = arr[i]["centername"];
                            centercode_group.appendChild(opt);
                        }
                        if(param_centercode){
                            centercode_group.value = param_centercode;
                            setMembership(param_centercode);
                            setTermsOfService();                        
                            selected_centername = centercode_group.options[centercode_group.selectedIndex].text;
                            document.getElementById("txt_centername").innerHTML = selected_centername;
                            
                            document.getElementById("id_title_logo").innerHTML = selected_centername+" 회원가입 신청서";
                           
                        }else {
                            var value = loadSetGroupValue("nowcentercode", centercode_group);
                            if (value) {
                                setMembership(value);
                                setTermsOfService();                        
                                selected_centername = centercode_group.options[centercode_group.selectedIndex].text;
                                document.getElementById("txt_centername").innerHTML = selected_centername;
                                
                                document.getElementById("id_title_logo").innerHTML = selected_centername+" 회원가입 신청서";
                            }
                        }
                    });
                    
                    
                    
                    
                  


                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });

            
           
        });
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
        function change_locker_starttime(starttime,term_coupon_month){
            
            var locker_starttime = document.getElementById("locker_starttime");
            if(starttime && !locker_starttime.value)locker_starttime.value = starttime;
            var locker_endtime = document.getElementById("locker_endtime");
            var id_locker_month = document.getElementById("id_locker_month");
            var id_locker_servicemonth = document.getElementById("id_locker_servicemonth");
            var total_locker_month = id_locker_month.value ? parseInt(id_locker_month.value)-parseInt(id_locker_servicemonth.value) : 0;
           
            if(term_coupon_month){
                
                id_locker_month.value = term_coupon_month+"";
                total_locker_month =  term_coupon_month-parseInt(id_locker_servicemonth.value);
                locker_endtime.value = nextMonth(locker_starttime.value, term_coupon_month);
            }
            
            var nmonth = nextMonth(locker_starttime.value, parseInt(id_locker_month.value));
            
            if(total_locker_month > 0)locker_endtime.value = nmonth;
           
        }
        //이미 가입된 유저정보가 있으면 가져와서 세팅한다.
        function checkRegisteredUser(centercode){
            
            clog("re_obj ",re_obj);
            re_obj.uid = "<?php echo $re_uid; ?>";
            re_obj.id = "<?php echo $re_id; ?>";
            re_obj.name = "<?php echo $re_name; ?>";
            re_obj.birth = "<?php echo $re_birth; ?>";
            re_obj.phone = "<?php echo $re_phone; ?>";
            re_obj.gender = "<?php echo $re_gender; ?>";
            re_obj.homeaddress = "<?php echo $re_homeaddress; ?>";
            re_obj.lockernumber = "<?php echo $re_lockernumber; ?>";
            re_obj.lockerpass = "<?php echo $re_lockerpass; ?>";
//            clog("nnewlockers ",nnewlockers);
            re_obj.newlockers = JSON.parse(`<?php echo $re_newlockers; ?>`);
            re_obj.starttime = "<?php echo $re_starttime; ?>";
            re_obj.endtime = "<?php echo $re_endtime; ?>";
            
            //이미 가입한 고객이다.
            if(re_obj.name){
                reregist = 1;
                document.getElementById("name").value = re_obj.name;
                showOnOffRejoinAni();
            }
            if(re_obj.birth){
                document.getElementById('yy').value = parseInt(re_obj.birth.substr(0,4));
                document.getElementById('mm').value = parseInt(re_obj.birth.substr(4,2));
                document.getElementById('dd').value = parseInt(re_obj.birth.substr(6,2));
            }
            if(re_obj.phone){
                document.getElementById("phone").value = re_obj.phone;
            }
            if(re_obj.gender){
                if(re_obj.gender == "F")
                    document.getElementById("gender_f").checked = true;
                else 
                    document.getElementById("gender_m").checked = true;
            }
            if(re_obj.homeaddress){
                document.getElementById("home_address").value = re_obj.homeaddress;
            }
            
            if(re_obj.endtime){

                document.getElementById("termtype_starttime").value = getMembershipNextStarttime();
                change_termtype_coupon();    
                
//                if(get_Day(getToday(),re_obj.endtime) > 0){
//                    var offsetday = nextDay(re_obj.endtime,1);
//                    document.getElementById("termtype_starttime").value = offsetday;
//                    change_termtype_coupon();    
//                }   
               
            }
            if(re_obj.newlockers){
                getAllLocker(centercode,function(res){
                    var all_lockers = JSON.parse(res);
                    
                    var locker = null;
                    for(var i = 0 ; i < re_obj.newlockers.length; i++){
    
                        if(!locker && get_Day(getToday(),re_obj.newlockers[i].endtime) > 0){
                            locker = re_obj.newlockers[i];
                        }                        
                        else if(locker && get_Day(locker.endtime,re_obj.newlockers[i].endtime) > 0){
                            locker = re_obj.newlockers[i];
                        }
                    }
                    //현재 이용중인 라커가 없을때 만료된 라커중에 라커목록에 내정보가 들어있는지 체크
                    if(!locker){
                        for(var i = 0 ; i < re_obj.newlockers.length; i++){
                            if(isMyLocker(all_lockers, re_obj.newlockers[i].num, re_obj.id)){
                                locker = re_obj.newlockers[i];
                                break;
                            }
                        }
                        
                    }
                    
                    
                    if(locker){
                        var use_locker = document.getElementById("use_locker");
                        var locker_info = document.getElementById('locker_info');
                        var id_locker_number = document.getElementById('id_locker_number');
                        var id_locker_pass = document.getElementById('id_locker_pass');
                        use_locker.innerHTML += "<option value='2'>기존라커 연장하기</option>";
                        id_locker_number.innerHTML = locker.num;
                        id_locker_pass.value = locker.pass;
                    }
                });
                
            }
//            if(re_obj.lockernumber){
//                document.getElementById('use_locker').value = 1;
//                var locker_number = document.getElementById('id_locker_number').innerHTML = re_obj.lockernumber;
//                var locker_pass = document.getElementById('id_locker_pass').value = re_obj.lockerpass;
//                
//                locker_change();
//            }
            
            
        }
        
        function isMyLocker(lockers, lockernum, userid){
            var ismy = false;
            for(var i = 0; i < lockers.length;i++){
                for(var j = 0; j < lockers[i].data.length;j++){
                    for(var k = 0; k < lockers[i].data[j].length;k++){
                        if(lockers[i].data[j][k].name == lockernum && lockers[i].data[j][k].useid == userid){
                            ismy = true;
                            break;
                        }
                    }
                    
                }
            }
            return ismy;
        }
        
        //이전 회원권에서 검색해서 회원권 그 다음날짜를 가져온다. 오늘보다 이전이라면 내일날짜를 가져온다.
        function getMembershipNextStarttime(){
            var str_membership = `<?php echo $re_membership; ?>`;
            
            var return_day = getToday();
            if(str_membership != ""){
                var membership = JSON.parse(str_membership);
                if(membership)
                for(var i = 0 ; i < membership.length;i++){
                    if(!membership[i].isdelete || membership[i].isdelet == "N"){
                        var endtime = membership[i].endtime;
            
                        if(get_Day(return_day,endtime) > 0){
                            return_day = nextDay(endtime,1);                        
                        }
                    }
                    
                }
            }
            return return_day;
        }
        function counttype_visible_change() {
            var counttype_coupon = document.getElementById('counttype_coupon');
            var counttype_coupon_price = document.getElementById("counttype_coupon_price");
            var txt = counttype_coupon.options[counttype_coupon.selectedIndex].text;
//            clog("counttype_coupon.value "+counttype_coupon.value);
            if (counttype_coupon.value == "0"){
                div_teachers.style.display = "none";
                counttype_coupon_price.value = "0";
                setPTDocument(false);
            }else {
                
                //if(txt.indexOf("2회") >= 0 || txt.indexOf("무료") >= 0){
                if(txt.indexOf(ID_FREE) >= 0){
                    div_teachers.style.display = "block";
                    document.getElementById("set_pt_doc").style.display ="none";
                    document.getElementById("rpt_div_price_total").style.display = "none";
                    pt_join_data = {};
                    var obj = new Object();
                    counttype_coupon_price.value = "0";
//                    var counttype_coupon = document.getElementById('counttype_coupon');
                }else {
                    div_teachers.style.display = "none";
                    getPTJoin();    
                }
                
            }
            checkCouponTitleColor();
            
        }
        function setPTDocument(isset){
            if(isset){
                document.getElementById("set_pt_doc").style.display ="block";
                document.getElementById("rpt_div_price_total").style.display = "block";
                
                var pt_change_button = document.getElementById("pt_change_button");
                pt_change_button.innerHTML = parseInt(pt_join_data.pt_traner_payrollvat) == 0 ? "(※ 페이롤 부가세 미적용됨)" : "(※ 페이롤 부가세 10% 적용됨)";
            }else{
                document.getElementById("set_pt_doc").style.display ="none";
                document.getElementById("rpt_div_price_total").style.display = "none";
                pt_join_data = {};
                var counttype_coupon = document.getElementById('counttype_coupon');
                counttype_coupon.selectedIndex = 0;
            }
            checkAllPrice();
        }
        function getPTJoin(){
             var obj = new Object();
             obj.uid = "<?php echo $uid; ?>";
             obj.id = "<?php echo $id; ?>";
             obj.type = "ptrule";
             obj.centercode = document.getElementById('header_center_select').value;
             if(obj.centercode){
                CallHandler("getptrule",obj,function(res){
                    var code = parseInt(res.code);
                    if (code == 100) {
                        console.log("getptrule res ",res);
                        
                        ptruledata = unescapeHtml(res.message);
                        
                        
                        //일반회원가입에서 가져올 수 있는 값들
                        var obj = new Object();
                        obj.pt_name = document.getElementById("name").value;//기간제 정보에서 가져온다.
                        obj.pt_phone = document.getElementById("phone").value; //기간제 정보에서 가져온다.
//                        obj.pt_paymenttype = document.getElementById("payment_type").value;
                        obj.pt_starttime = document.getElementById("termtype_starttime").value;
                        obj.pt_endtime = document.getElementById("termtype_endtime").innerHTML;
                        
                        
                        
                        showPTJoinPopup(ptruledata,obj);
                        
                    }else{
                         alertMsg(res.message);
                    }
                }, function(err) {
                    alertMsg("네트워크 에러 ");
                });    
             }
             
            
            
        
        }
        function setPTData(obj){
//              var obj = new Object();
//            obj.pt_check = document.getElementById("check_pt_desc").checked ? true : false;
//            obj.pt_name = document.getElementById("pt_name").innerHTML;
//            obj.pt_phone = document.getElementById("pt_phone").innerHTML;
//            obj.pt_ampm = document.getElementById("pt_traner_am").checked ? "AM" : "PM";        
//            var pt_teachers_list = document.getElementById("pt_teachers_list");
//            obj.pt_teachers_value = pt_teachers_list.value;
//            obj.pt_starttime  = document.getElementById("pt_starttime").value;
//            obj.pt_endtime = document.getElementById("pt_endtime").value;
//            obj.pt_count = document.getElementById("pt_count").innerHTML;
//            obj.pt_pricetotal = document.getElementById("pt_pricetotal").value;
//            obj.pt_pricerefund = document.getElementById("pt_pricerefund").value;
//            obj.pt_paymenttype = document.getElementById("pt_paymenttype").innerHTML;
//            obj.signdataname1 = signaturePadName1.toDataURL('image/png');
//            obj.signdatasign1 = signaturePadSign1.toDataURL('image/png');
            
            obj.pt_name = pt_join_data.pt_name;
            obj.pt_phone = pt_join_data.pt_phone;
            obj.pt_paymenttype = pt_join_data.pt_paymenttype;
            obj.pt_starttime = pt_join_data.pt_starttime;
            obj.pt_endtime = pt_join_data.pt_endtime;
        }
        var before_pt_paymenttype = -1;
        var selected_pt_coupon = null;
        function showPTJoinPopup(ptruledata,obj){
            sign_count = {};
            if(pt_join_data.pt_pricetotal){
                clog("pt_join_data!!");
                
                obj.pt_price1set = 0;
                obj.pt_pricetotal = pt_join_data.pt_pricetotal;
                obj.pt_pricerefund = pt_join_data.pt_pricerefund;
                obj.counttype_coupon_value = pt_join_data.counttype_coupon_value;
                obj.pt_paymenttype = pt_join_data.pt_paymenttype;
                obj.pt_starttime = pt_join_data.pt_starttime;
                obj.pt_endtime = pt_join_data.pt_endtime;
                obj.pt_count = pt_join_data.pt_count;
                obj.pt_teachers_value = pt_join_data.pt_teachers_value;
                obj.pt_constructoruid = pt_join_data.pt_constructoruid;
                obj.pt_constructorname = pt_join_data.pt_constructorname;
                obj.pt_traner_payrollvat = pt_join_data.pt_traner_payrollvat;
               obj.pt_note = pt_join_data.pt_note;
              obj.pt_special_note = pt_join_data.pt_special_note;
               obj.pt_sign_special_contract = pt_join_data.pt_sign_special_contract;
               
                for(var i = 0 ; i < mbs_coupons.length; i++){
                    if(mbs_coupons[i]["mbs_idx"] == obj.counttype_coupon_value){
                        selected_pt_coupon = mbs_coupons[i];
                        break;
                    }
                }
                
//                var pt_vat = parseInt(obj.pt_paymenttype) == 1 ? 11 : 10;//neel_vat
//                var pt_vat = parseInt(obj.pt_paymenttype) == 1 ? (100+global_vat)*global_vat : 100*global_vat;
                

                if(selected_pt_coupon){
                    obj.pt_count = pt_join_data.pt_count ? pt_join_data.pt_count : (selected_pt_coupon["mbs_max_count"]);                

                }
               

                var stime = obj.pt_starttime ? obj.pt_starttime : <?php echo date('Y-m-d'); ?>;
                var etime = obj.pt_endtime ? obj.pt_endtime : <?php echo date('Y-m-d'); ?>;

                clog("stime "+stime+" etime "+etime);

                var userid = obj.pt_userid ? obj.pt_userid : "가입시보여짐";
                var message = document.createElement("div");
    //            message.innerHTML = "<div align='left' >"+ptruledata+"</div>";
                var tlist = "<option value='0'>트레이너를 선택하세요</option>";
                for (var i = 0; i < teacherlist.length; i++){
                    var selected =  obj.pt_teachers_value == teacherlist[i].mem_uid ? "selected" : "";
                    clog(i+" "+selected);
                    tlist += "<option value='" + teacherlist[i].mem_uid + "' data-image='" + teacherlist[i].mem_photo + "' "+selected+">" + teacherlist[i].mem_username + " 트레이너</option>";
                } 
                    

                var txt_paymenttype = ["","",""];
                txt_paymenttype[parseInt(obj.pt_paymenttype)] = "selected";

               
                var pt_total = parseCommaInt(obj.pt_pricetotal);
                var pt_count = parseInt(obj.pt_count);
                var set = obj.pt_price1set = pt_total == 0 ? 0 : pt_total/pt_count;
               // var txt_vat = parseInt(obj.pt_paymenttype) == 1 ? "(VAT "+global_vat+"% :"+CommaString(Math.floor((pt_total/(100+global_vat))*global_vat))+"원)"  : "";
                 var txt_vat = "";
                var txt_vat_display = txt_vat+"&nbsp;&nbsp;";
                var check_pt_checked = "checked";
            }else{
                
                obj.pt_price1set = 0;
                obj.pt_pricetotal = 0;
                obj.pt_pricerefund = 0;
                obj.pt_note = "";
                obj.pt_special_note = "";
                obj.pt_sign_special_contract = "";
                obj.pt_traner_payrollvat = "0";
                var counttype_coupon_value = document.getElementById('counttype_coupon').value;
                
                for(var i = 0 ; i < mbs_coupons.length; i++){
                    if(mbs_coupons[i]["mbs_idx"] == counttype_coupon_value){
                        selected_pt_coupon = mbs_coupons[i];
                        break;
                    }
                }
                clog("")
                
//                var pt_vat = parseInt(obj.pt_paymenttype) == 1 ? 11 : 10; //neel_vat
                var pt_vat = parseInt(obj.pt_paymenttype) == 1 ? (100+global_vat)*global_vat : 100*global_vat;
                
                if(selected_pt_coupon){
                    //obj.pt_pricetotal = parseInt(obj.pt_paymenttype) == 1 ? parseCommaInt(selected_pt_coupon["mbs_price"])*11/10 :  parseCommaInt(selected_pt_coupon["mbs_price"]); //neel_vat
                    obj.pt_pricetotal = parseInt(obj.pt_paymenttype) == 1 ? (parseCommaInt(selected_pt_coupon["mbs_price"])*(100+global_vat))/10 :  parseCommaInt(selected_pt_coupon["mbs_price"]); //neel_vat
                    obj.pt_count = selected_pt_coupon["mbs_max_count"];                

                }

                if(!obj.pt_name || !obj.pt_phone){
                    if(!obj.pt_name)
                        alertMsg("이름을 입력해 주세요.");
                    else if(!obj.pt_phone)
                        alertMsg("전화번호를 입력해 주세요.");
//                    else if(!obj.pt_paymenttype)
//                        alertMsg("결제방법을 먼저 입력해 주세요.");
                    document.getElementById('counttype_coupon').selectedIndex = 0;
                    checkCouponTitleColor();
                    return;
                }
                var set1_day = 4;
                var stime = obj.pt_starttime ? obj.pt_starttime : getToday();
                var etime = parseInt(obj.pt_count) != 0 ? nextDay(stime,parseInt(obj.pt_count)*set1_day) : "";

                clog("stime "+stime+" etime "+etime);

                var userid = obj.pt_userid ? obj.pt_userid : "가입시보여짐";
                var message = document.createElement("div");
    //            message.innerHTML = "<div align='left' >"+ptruledata+"</div>";
                var tlist = "<option value='0'>트레이너를 선택하세요</option>";
                for (var i = 0; i < teacherlist.length; i++) 
                    tlist += "<option value='" + teacherlist[i].mem_uid + "' data-image='" + teacherlist[i].mem_photo + "'>" + teacherlist[i].mem_username + " 트레이너</option>";

                var txt_paymenttype = ["","",""];
                txt_paymenttype[parseInt(obj.pt_paymenttype)] = "selected";

                
                var pt_total = parseCommaInt(obj.pt_pricetotal);
                var pt_count = parseInt(obj.pt_count);
                var set = obj.pt_price1set = pt_total == 0 ? 0 : pt_total/pt_count;
                //var txt_vat = parseInt(obj.pt_paymenttype) == 1 ? "(VAT "+global_vat+"% :"+CommaString(Math.floor((pt_total/(100+global_vat))*global_vat))+"원)"  : "";
                var txt_vat =  "";
                var txt_vat_display = txt_vat+"&nbsp;&nbsp;";
                var check_pt_checked = "";
            }
            before_pt_paymenttype = parseInt(obj.pt_paymenttype);
            var div_vat_text_display = before_pt_paymenttype == 1 ? "block":"none"; //VAT "+global_vat+"% 텍스트 최초 보여주기 안보여주기
            var div_vat_text_visiblity = before_pt_paymenttype == 1 ? "visible":"hidden"; //VAT "+global_vat+"% 텍스트 최초 보여주기 안보여주기
            
            //var refund_vat_10 =  before_pt_paymenttype == 1 ? "(VAT "+global_vat+"% :"+CommaString((parseCommaInt(obj.pt_pricerefund)/100)*global_vat)+"원)" : "";
            var refund_vat_10 = "";
            clog("refund_vat_10 "+refund_vat_10);
            clog("refund_vat_10 "+refund_vat_10);
            var screen_width = $(window).width();
            var popupwidth = screen_width-100;
            var twidth = popupwidth/6;
            var iwidth = popupwidth/6*2;
            
            
            var pt_price_card = pt_json_price.card ? pt_json_price.card : 0; //PT 카드
            var pt_price_cash = pt_json_price.cash ? pt_json_price.cash : 0;//PT 현금
            var pt_price_remain = pt_json_price.remain ? pt_json_price.remain : 0; //PT 미수금 
            var pt_price_discount = pt_json_price.remain ? pt_json_price.discount : 0; //PT 할인금
            var pt_price_total = pt_json_price.total ? pt_json_price.total : 0; //PT 총금액
            var pt_price_totalprice = pt_json_price.totalprice ? pt_json_price.totalprice : 0; //PT  총금액
            var pt_price_totalremain = pt_json_price.total_remain ? pt_json_price.total_remain : 0; //PT 미수금 제외한 결제금액
            var counttypeprice = pt_json_price.counttypeprice ? pt_json_price.counttypeprice : 0;
            
            
            var special_contract_tag = "<div style='border-radius:5px;background-color:white;width:240px;height:46px;float:right;padding:3px'>"+
                                                "<button id='sign_special_contract' onclick='click_signrule(\"sign_special_contract\", \"sign_img_special_contract\")' style='float:right;margin-top:2px;background-color:#33a186;border:0px;border-radius:5px;padding:8px 15px 8px 15px;font-size:14px;color:white'>서명</button>"+
                                                "<img id='sign_img_special_contract' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-right:5px;display:none' src=''/>"+                                
                                           "</div><br><br>";   
            if(obj.pt_special_note){
                 special_contract_tag = "<div style='border-radius:5px;background-color:white;width:240px;height:46px;float:right;padding:3px'>"+
                                                "<button id='sign_special_contract' onclick='click_signrule(\"sign_special_contract\", \"sign_img_special_contract\")' style='float:right;margin-top:2px;background-color:#33a186;border:0px;border-radius:5px;padding:8px 15px 8px 15px;font-size:14px;color:white'>서명다시하기</button>"+
                                                "<img id='sign_img_special_contract' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-right:5px;' src='"+obj.pt_sign_special_contract+"'/>"+                                
                                           "</div><br><br>";   
            }
             
            var select_payrollvat_tag = parseInt(obj.pt_traner_payrollvat) == 0 ? "<select id='pt_traner_payrollvat' class='form-control myinputtype'  >"+
                                                "<option value='0' selected>페이롤 부가세 미적용</option>"+
                                                "<option value='1'>페이롤 부가세 10% 적용</option>" +                                                
                                            "</select>" : "<select id='pt_traner_payrollvat' class='form-control myinputtype'  >"+
                                                "<option value='0' >페이롤 부가세 미적용</option>"+
                                                "<option value='1' selected>페이롤 부가세 10% 적용</option>" +                                                
                                            "</select>"
            
            
            message.innerHTML=
        "<div align='center' style='width:100%'>"+
            "<div align='left' style='max-width:960px;text-align:left'>"+
                "<div  style='padding:25px'>"+
                    "<div style='border: 1px solid #e4e6ef;border-radius:10px;padding:15px'>"+
                            
                            "<div style='width:100%;height:50px;'>"+
                                "<text style='float:left;margin-top:-9px;margin-left:5px;color:#3f4254;font-size:16px;font-weight:700;line-height:50px'>Personal Training Session 규정</text>"+
                            "</div>"+
                            "<div style='height:1px;margin-left:-15px;margin-right:-15px;background-color:#eff2f5'></div>"+
                            "<div align='left' style='width:100%; height:300px; overflow:auto; line-height:20px; background-color: #f5f8fa;padding:3%;border-radius:10px; margin-top:25px;color:#5e6278;font-size:14px'>"+replacePTSignTag("ptrule",ptruledata)+"</div><br>"+
                            "<div style='margin-bottom:30px;padding-right:25%'>"+myCheckBoxTag("규정에 관한 설명을 충분히 들었으며 이에 동의합니다.","check_pt_desc")+"</div>"+
                    "</div>"+
                "</div>"+
                
                  //특약!특약!특약!특약!특약!
                        "<div style='width:100%;padding-left:30px;padding-right:30px'><div class='form-control' id='special_contract' style=''>"+
                            "<label class='textevent' style='font-size:14px;margin-top:-8px;margin-left:5px;float:left'>특약&nbsp;&nbsp;</label>"+
                            "<input class='form-control myinputtype' id='spacial_contract_input'  style='width:90%;float:left;font-size:14px;margin-top:7px' value='"+obj.pt_special_note+"'/><br><br>"+         
                                special_contract_tag+        
                        "</div><br></div>"+
                  
                
//                     "<div style='height:100px;padding:10px;border: 1px solid #e4e6ef;border-radius:10px;margin:5px 25px 25px 25px;' >"+
//                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>PT 회원권<span style='color:red'>*</span></label>"+
//                            "<select class ='form-control myinputtype' id='id_pt_coupon' ><option value='"+selected_pt_coupon.mbs_idx+"'>"+selected_pt_coupon.mbs_name+"&nbsp;&nbsp;&nbsp;[카드부가세 : "+selected_pt_coupon.mbs_vat+"%]</option></select>" + //가입시킨 사람 이름
//                        "</div>"+
                    "<div align='left'>"+                    
                        "<div id='pt_formdiv' style='border: 1px solid #e4e6ef;border-radius:10px;margin:5px 25px 25px 25px;' >"+
                            "<div style='padding:15px 30px 15px 30px;border-radius:10px 10px 0px 0px;background-color:#f5f8fa'>"+
                                
                                "<img src='./img/icon_fileuser.png' style='width:15px;height:19px;margin-top:-5px;margin-left:-15px'>&nbsp;&nbsp;<text style='color:#3f4254;font-size:16px;font-weight:500;line-height:35px'>회원번호: <span style='color:#009ef7'>"+userid+"</span></text>"+
//                                "<hr style='border: solid 1px light-gray;'>"+
                            "</div>"+  
                            "<div >"+
                                "<table class='table' style='width:100%'>"+
                
                                    "<tr style='height:50px'>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>이름<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+            
                                            "<text class='form-control myinputtype' id='pt_name' name='pt_name' placeholder='예) 홍길동' align='center-vertical' style='margin:auto' >"+obj.pt_name+"</text>"+
                                        "</td>"+
                                        "<td style='width:"+twidth+"px'>"+                                           
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>휴대폰 번호<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                            "<text class='form-control myinputtype' id='pt_phone' name='pt_phone' placeholder='예) 010-1234-5678' style='margin:auto'>"+obj.pt_phone+"</text>"+
                                        "</td>"+ 
                                    "</tr>"+
                
                                    "<tr>"+
                                        "<td style='width:"+twidth+"px'>"+                                            
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>계약트레이너<span style='color:red'>*</span></label>"+
                                            "<br><label class='textevent' style='color:#009ef7;font-size:11px;margin-top:-25px;font-weight:normal'>페이롤 총매출에 반영</label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+                                          
                                            "<select class ='form-control myinputtype' id='pt_constructor'  style=''>"+constructor_name_option_tag+"</select>" + //가입시킨 사람 이름
                                        "</td>"+
                                       "<td style='width:"+twidth+"px'>"+                                               
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>담당트레이너<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                           "<div> "+
                                                "<select class='form-control  myinputtype' id='pt_teachers_list' style='border:0px' name='pt_teachers_list' >"+tlist+"</select>"+
                                                "<span style='float:left'>"+
                                                    "<input id='pt_traner_am' type='radio' name='ampm' value='AM' style='margin-top:10px' checked>&nbsp;오전&nbsp;&nbsp;<input id='pt_traner_pm' type='radio' name='ampm' value='PM'>&nbsp;오후"+
                                                "</span>"+
                                            "</div>"+
                                        "</td>"+ 
                                    "</tr>"+
                                
                                    "<tr>"+
                                        "<td style='width:"+twidth+"px'>"+                                      
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>PT 시작일<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+
                                                  
                                                "<input  class='form-control myinputtype' id='pt_starttime' type='date' style='border:0px'   min='"+getToday()+"' value='"+stime+"' />"+
                                             
                                        "</td>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>PT 종료일<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                    
                                        "<td style='width:"+iwidth+"px'>"+
                                            
                                                "<input  class='form-control myinputtype' id='pt_endtime' type='date'  style='border:0px' min='"+getToday()+"' value='"+etime+"' />"+
                                            
                                        "</td>"+ 
                                    "</tr>"+
                
                                  
                                    "<tr>"+
                                       "<td style='width:"+twidth+"px'>"+                                
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>총 Session<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+
                                             "<div class='form-control myinputtype' style='height:80px'>"+                                                
                                                "<span><input id='pt_count' type='number' onfocus='this.select()'  onchange='onchange_ptprice()'  style='width:50px;border:0px' value='"+obj.pt_count+"' />회<span>"+
                                                "<span style='float:right;'><button  id='service_pt_arrow_l' onclick='show_service_pt(1)' class='btn' style='padding:3px 35px 3px 35px;background-color:#2196F3;color:white;font-size:13px'>◀</button><button  id='service_pt_arrow_r' onclick='show_service_pt(2)' class='btn ' style='padding:3px 35px 3px 35px;background-color:#2196F3;color:white;display:none;font-size:13px'>▶</button></span>"+
                                                "<span id='span_service_pt' style='float:right;font-size:14px;width:100%;margin-top:8px;display:none'>"+
                                                    "<select onchange='change_service_pt()' id='select_service_pt' style='float:right;width:85px;height:30px;border:0px'><option value='0'>추가세션</option><option value='1'>+1회</option><option value='2'>+2회</option><option value='3'>+3회</option><option value='4'>+4회</option><option value='5'>+5회</option></select>"+
                                                "</span>"+    
                                             "</div>"+
                                        "</td>"+
                                       "<td style='width:"+twidth+"px'>"+                                        
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>PT 총수업료<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                                                            
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                            "<div class='form-control myinputtype' onchange='onchange_ptprice(0)'>"+                 
                                                "<input id='pt_pricetotal' onfocus='this.select()' type='text' style='width:130px;border:0px' onkeyup='inputChangeComma(\"pt_pricetotal\")'  value='"+CommaString(obj.pt_pricetotal)+"' />원<br>"+
                                                "<div id ='div_vat_text' style='display:"+div_vat_text_display+"'><text id='pt_pricevat' style='color:blue;'>"+txt_vat+"</text><br></div>"+
                                                "<label style='margin-top:10px'>1회당 :</label>&nbsp;<label style='margin-top:10px'  id='pt_price1set' value='"+obj.pt_price1set+"'>"+CommaString(obj.pt_price1set)+"</label>원"+                                                
                                            "</div>"+   
                                        "</td>"+
                                        
                                    "</tr>"+
                
                                      "<tr>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>환불시1회단가<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td style='width:"+iwidth+"px'>"+
                                            "<div class='form-control myinputtype' style='padding:8px;height:50px'>"+  
                                                "<span style='float:left;'><input id='pt_pricerefund' type='text' onfocus='this.select()' onkeyup='inputChangeComma(\"pt_pricerefund\")'  style='width:100px;border:0px' value='"+CommaString(obj.pt_pricerefund)+"' />원</span><br><br><span style='float:right;'><text id = 'txt_refund_vat' style='color:blue;visiblity:"+div_vat_text_visiblity+"'>"+refund_vat_10+"</text></span>"+      
                                            "</div>"+
                                        "</td>"+ 
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px'>결제방법<span style='color:red'>*</span></label>"+
                                        "</td>"+                                    
                                   
                                        "<td style='width:"+iwidth+"px'>"+
                                            
                                            "<select id='pt_paymenttype' onchange='onchange_ptprice(100)' class='form-control myinputtype' name='pt_paymenttype' >"+
                                                "<option value=''>결제방법을 선택하세요</option>"+
                                                "<option value='1' "+txt_paymenttype[1]+">카드결제</option>"+
                                                "<option value='2' "+txt_paymenttype[2]+">현금결제</option>"+
                                                "<option value='4' "+txt_paymenttype[4]+">카드+현금</option>"+
                                            "</select>"+
                                            
                                        "</td>"+ 
                                    "</tr>"+
                                      "<tr style='display:none'>"+
                                        "<td style='width:"+twidth+"px'>"+                                    
                                            "<label class='textevent' style='font-size:14px;margin-top:-15px;margin-left:5px'>페이롤 부가세<span style='color:red'>*</span></label>"+
                                        "</td>"+
                                        "<td colspan='3' style='width:"+iwidth+"px'>"+
                                             select_payrollvat_tag+
                                        "</td>"+ 
                                    "</tr>"+
                                "</table>"+
                                "<div class='form-control myinputtype' id='div_service_pt_desc' style='width:100%;height:70px;display:none;padding:20px'>"+                                     
                                    "<span style='float:left;'><label class='mycheckbox' ><input id='check_service_pt'  type='checkbox'><span class='checkmark'></span></label></span>"+
                                    "<span style='float:left;'><text id='txt_service_pt_desc' style='font-size:18px;color:red'>*환불시 서비스 수업에 대한 가격은 포함되지 않습니다.</text></span>"+
                                "</div>"+
                
                
                
                                "<div style='border: 1px solid #e4e6ef;border-radius:10px;margin:5px 25px 25px 25px;' >" +
                                    "<div id = 'pt_div_price_total'>"+
                                        "<div style='border-radius:10px 10px 0px 0px;background-color:#f5f8fa'>"+
                                            "<label class='textevent' style='margin-left:20px;margin-bottom:15px;'>최종금액</label>"+
                                        "</div>"+
                                        "<div style='padding:0px 20px 20px 20px;'>"+
                                             "<div style='height:1px;margin-left:-20px;margin-right:-20px;background-color:#eff2f5'></div>"+
                                                 "<table id ='pt_table_totalprice' style='width:100%;' >"+
                                                    "<tr style='width:100%'>"+
//                                                        "<td style='width:200px;display:none'>"+
//                                                            "<label class='textevent'>현금 총액</label>"+
//                                                        "</td>"+
                                                        "<td style='width:18%'>"+
                                                            "<label class='textevent'>카드</label>"+
                                                        "</td>"+
                                                        "<td style='width:18%'>"+
                                                            "<label class='textevent'>현금</label><br>"+
                                                        "</td>"+
                                                        "<td style='width:18%'>"+
                                                            "<label class='textevent'>미수금</label><br>"+
                                                        "</td>"+
                                                        "<td style='width:18%;display:none'>"+
                                                            "<label class='textevent' style='color:#009ef7'>할인</label><br>"+
                                                        "</td>"+
//                                                        "<td style='width:18%'>"+
//                                                            "<label class='textevent'>총금액</label><br>"+ 
//                                                        "</td>"+
//                                                        "<td align='right'  style='width:28%'>"+
//                                                            "<div style='width:160px'>"+
//                                                                "<label class='textevent' style='float:left'>결제금액</label>"+
//                                                            "</div>"+
//                                                        "</td>"+
                                                     "</tr>"+
                                                     "<tr>"+
//                                                        "<td style='min-width:150px; background-color:yellow;display:none'>"+
//                                                            "<input type='text' class='form-control myinputtype' id='pt_id_cash_total' onfocus='this.select()' placeholder='현금기준 총금액' vdisabled>"+
//                                                        "</td>"+
                                                        "<td style='min-width:18%;padding-right:10px'>"+
                                                           "<input type='text' class='form-control  myinputtype' id='pt_id_price_card' onkeyup='onchange_ptprice(1)' onfocus='this.select()' placeholder='카드 결제금액...' value ='"+CommaString(pt_price_card)+"' novalidate>"+    
                                                        "</td>"+
                                                        "<td style='min-width:18%;padding-right:10px'>"+
                                                           "<input type='text' class='form-control myinputtype' id='pt_id_price_cash' onkeyup='onchange_ptprice(2)' onfocus='this.select()' placeholder='현금 결제금액...' value ='"+CommaString(pt_price_cash)+"' novalidate>"+
                                                        "</td>"+
                                                        "<td style='min-width:18%;padding-right:10px'>"+
                                                           "<input type='text' class='form-control myinputtype' id='pt_id_price_remain'  onkeyup='onchange_ptprice(3)' onfocus='this.select()' placeholder='미수금 가격...' value ='"+CommaString(pt_price_remain)+"'>"+    
                                                        "</td>"+
                                                         "<td style='min-width:18%;padding-right:10px;display:none'>"+
                                                           "<input type='text' class='form-control myinputtype' id='pt_id_price_discount'  onkeyup='onchange_ptprice(4)' onfocus='this.select()' style='color:#009ef7' placeholder='할인 가격...' value ='"+CommaString(pt_price_discount)+"'>"+    
                                                        "</td>"+
//                                                         "<td style='min-width:18%;padding-right:10px'>"+
//                                                            "<input type='text' style='border:0px' class='form-control' id='pt_id_price_total' placeholder='총 금액...' value='"+CommaString(pt_price_total)+"' disabled>"+
//                                                        "</td>"+
//                                                        "<td align='right'>"+
//                                                            "<input type='text' style='width:160px; height:auto;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px' class='form-control' id='pt_id_price_totalremain' placeholder='결제 금액...' value='"+CommaString(pt_price_totalremain)+"' disabled>"+
//                                                        "</td>"+
                                                     "</tr>"+
                                                      "<tr>"+
                                                         "<td colspan = '4'>"+
                                                             "<span style='float:left'><label class='textevent' style='margin-right:10px;margin-top:5px'>총금액</label></span>"+
                                                             "<span style='float:left'><input type='text' class='form-control' id='pt_id_price_total' placeholder='총 금액...' style='margin-top:15px' disabled></span>"+
                                                             "<span style='float:right'><input type='text' class='form-control' id='pt_id_price_totalremain' placeholder='결제 금액...' style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px;margin-top:15px' disabled></span>"+
                                                             "<span style='float:right'><label class='textevent'  style='margin-right:10px;margin-top:5px'>결제금액</label></span>"+
                                                         "</td>"+
                                                     "</tr>"+
                                                "</table>"+
                                           "</div>"+
                                    "</div>"+
                             "</div>"+
                
                
                
                    
                            "</div>"+
                        "</div>"+  
                    "</div>"+  
                "</div>"+  
            "</div>";
               
                
                
            
            
//            var style = {
//                bodycolor: "#eeeeee",
//                marginTop : "0px",
//                size: {
//                    width: "95%",
//                    height: "100%"
//                }
//            }; 
             //neel_sessioncheck
            var style = {
                 modaltype:"large",
                 marginTop:"0px",
                 bodycolor:"#ffffff",
                 size:{
                     width:"95%",
                     maxWidth:"960px",
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
            isshowptpopup = true;
            
            if(pt_join_data.pt_pricetotal){
                var signdata = {};
                
                showModalDialogPTJoin(document.body, "PT 회원가입 양식",  message.innerHTML,"pt_join_script.php?ver1.01", "수정하기", "닫기", function() {
                    //수정하기
                     check_ptdata();
                    isshowptpopup = false;
                },function() {
                    //그냥닫기
                    isshowptpopup = false;
                    hideModalDialog();
                    
                }, style);    
                
            }else {
                showModalDialogPTJoin(document.body, "PT 회원가입 양식",  message.innerHTML,"pt_join_script.php?ver1.01", "PT 가입", "취소", function() {
                   check_ptdata();
                    isshowptpopup = false;
                }, function() {setPTDocument(false);hideModalDialog();isshowptpopup = false;}, style);    
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
        function onchange_ptprice(isinputchange){
            var ptpaymenttype = document.getElementById("pt_paymenttype");
            var pt_paymenttype = ptpaymenttype.value ? parseInt(ptpaymenttype.value) : 0;
            var pt_count =  parseInt(document.getElementById("pt_count").value);
            var pt_1set =  document.getElementById("pt_price1set");
            var pt_pricetotal = document.getElementById("pt_pricetotal");
            var pt_total = pt_pricetotal.value ? parseCommaInt(pt_pricetotal.value) : 0;
            var pt_pricevat = document.getElementById("pt_pricevat");
            var pt_pricerefund = document.getElementById("pt_pricerefund");//환불시 회당단가
            var div_vat_text = document.getElementById("div_vat_text");
            var pt_starttime = document.getElementById("pt_starttime");
            var pt_endtime = document.getElementById("pt_endtime");
            var txt_refund_vat = document.getElementById("txt_refund_vat");//환불시 단가 VAT10% 텍스트
           
            
            
//            var pt_id_cash_total = document.getElementById("pt_id_cash_total");
            var pt_id_price_card = document.getElementById("pt_id_price_card");
            var pt_id_price_cash = document.getElementById("pt_id_price_cash");
            var pt_id_price_remain = document.getElementById("pt_id_price_remain");
            var pt_id_price_discount = document.getElementById("pt_id_price_discount");
            var pt_id_price_total = document.getElementById("pt_id_price_total");
            var pt_id_price_totalremain = document.getElementById("pt_id_price_totalremain");
            var pt_traner_payrollvat = document.getElementById("pt_traner_payrollvat");
            
            
            var set1_day = 4;
            if(pt_count != 0){
                pt_endtime.value = nextDay(pt_starttime.value,pt_count*set1_day);
            }
            if(isinputchange != undefined && isinputchange === 0){
                console.log("총수업료 변경");
                pt_1set.innerHTML = "0";
                ptpaymenttype.value = "";
                
                pt_id_price_card.value = "0";
                pt_id_price_cash.value = "0";
                pt_id_price_remain.value = "0";
                pt_id_price_discount.value = "0";
                pt_id_price_total.value = "0";
                pt_id_price_totalremain.value = "0";
                
                return;
            }
//            if(isNaN(pt_id_price_card.value))pt_id_price_card.value = "0";
//            if(isNaN(pt_id_price_cash.value))pt_id_price_cash.value = "0";
//            if(isNaN(pt_id_price_remain.value))pt_id_price_remain.value = "0";
//            if(isNaN(pt_id_price_discount.value))pt_id_price_discount.value = "0";
//            if(isNaN(pt_id_price_total.value))pt_id_price_total.value = "0";
//            if(isNaN(pt_id_price_totalremain.value))pt_id_price_totalremain.value = "0";
            
            
            //////////////////////////////////////////
            //현금기준 총금액을 계산한다.
            //////////////////////////////////////////

            var all_cash_total = pt_paymenttype == 1 ? subVAT(null,parseCommaInt(pt_pricetotal.value)) : parseCommaInt(pt_pricetotal.value);            
//            pt_id_cash_total.value= CommaString(all_cash_total);
            //////////////////////////////////////////
            //현금기준 총금액을 계산한다.
            //////////////////////////////////////////
            
            
//            var pt_vat =pt_paymenttype == 1 ? 11 : 10;//neel_vat
            var pt_vat = pt_paymenttype == 1 ? (100+global_vat)*global_vat : 100*global_vat;
            
            var refundprice = parseCommaInt(pt_pricerefund.value);
            
            //카드결제
            if(before_pt_paymenttype != 1 && pt_paymenttype == 1){
                
                //pt_pricetotal.value = CommaString(Math.floor(pt_total*11/10));//neel_vat
                pt_pricetotal.value = CommaString(Math.floor((pt_total*(100+global_vat))/100));
                
                pt_total = parseCommaInt(pt_pricetotal.value);    
                
//                pt_pricerefund.value = CommaString(Math.floor(refundprice*11/10));//neel_vat
                pt_pricerefund.value = CommaString(Math.floor((refundprice*(100+global_vat))/100));
                
               
                var aaa = (refundprice/(100+global_vat))*global_vat;
                 clog("refundprice "+refundprice+" global_vat "+global_vat+" aaa "+aaa);
                /* 221027 유진 수정 */
                //txt_refund_vat.innerHTML = "(VAT "+global_vat+"% "+CommaString(Math.floor((refundprice/100)*global_vat))+" 원)";//neel_vat
                clog("card!!");
            }
            //현금결제
            else if(before_pt_paymenttype == 1 && pt_paymenttype != 1){
                
//                pt_pricetotal.value = CommaString(Math.floor(pt_total/11*10)); //neel_vat
                pt_pricetotal.value = CommaString(Math.floor(subVAT(null,pt_total))); 
                
                
                pt_total = parseCommaInt(pt_pricetotal.value);    
                
//                pt_pricerefund.value =CommaString(Math.floor(refundprice/11*10));//neel_vat
                pt_pricerefund.value =CommaString(Math.floor(subVAT(null,refundprice)));
                
                txt_refund_vat.innerHTML = "";
                clog("cash!!");
            }
            
            
            
            
            var price_card = pt_paymenttype == 1 ? pt_total : 0;
            var price_cash = pt_paymenttype != 1 ? pt_total : 0;
            var price_remain =  0;
            var price_total = pt_total;
            
            console.log("price_card");
            
            //결제타입 변경 카드 , 현금 , 
            if(isinputchange == 100){
                //카드
                if(pt_paymenttype == 1){
                    pt_id_price_card.value = pt_pricetotal.value;
                    pt_id_price_cash.value = "0";
                    pt_id_price_remain.value = "0";
                    pt_id_price_discount.value = "0";
                    pt_id_price_total.value = pt_pricetotal.value;
                }
                //현금
                else if(pt_paymenttype == 2){
                    pt_id_price_card.value = "0";
                    pt_id_price_cash.value = pt_pricetotal.value;
                    pt_id_price_remain.value = "0";
                    pt_id_price_discount.value = "0";
                    pt_id_price_total.value = pt_pricetotal.value;
                }
                 updateTranerPayrollVat(pt_traner_payrollvat, parseInt(pt_paymenttype));
            }
            clog("globak_vat "+global_vat);
            if(isinputchange && isinputchange == 1 && pt_id_price_card.value == ""){
                pt_id_price_card.value = "0";
            }
            if(isinputchange && isinputchange == 2 && pt_id_price_cash.value == ""){
                pt_id_price_cash.value = "0";
            }
            if(isinputchange && isinputchange == 1){
                pt_id_price_card.value = CommaString(parseCommaInt(pt_id_price_card.value));
            }else if(isinputchange && isinputchange == 2){
                pt_id_price_cash.value = CommaString(parseCommaInt(pt_id_price_cash.value));
            }
            else if(isinputchange && isinputchange == 3){
                pt_id_price_remain.value = CommaString(parseCommaInt(pt_id_price_remain.value));
            }

            if(!isinputchange){
                pt_id_price_card.value = pt_paymenttype == 1 ? pt_pricetotal.value : "0";
                pt_id_price_cash.value = pt_paymenttype != 1 ? pt_pricetotal.value : "0";            
            }
            if(isNaN(price_card))price_card = 0;
            if(isNaN(price_cash))price_cash = 0;
            if(isNaN(price_remain))price_remain = 0;
            if(isNaN(price_total))price_total = 0;
            
            
            //최종금액 중 하나 입력중일때
            if(isinputchange){
                var vatcard = 0; //수수료포함가
                var card = 0;
                var cash = 0;
                var remain = 0;
                var discount = parseCommaInt(pt_id_price_discount.value);
                var total = 0;
                //카드
                if(isinputchange == 1){
                    vatcard = parseCommaInt(pt_id_price_card.value);
                    card = subVAT(null,parseCommaInt(pt_id_price_card.value)); 
                    cash = parseCommaInt(pt_id_price_cash.value);  
                    remain = all_cash_total - card - cash - discount;
                    total = vatcard + cash + remain + discount;
                    

                    pt_id_price_cash.value = CommaString(cash);
                    pt_id_price_remain.value = CommaString(remain);
                    pt_id_price_total.value = CommaString(total);
                    pt_id_price_totalremain.value =  CommaString(total-remain-discount);
                    
                    if(card > 0 && cash > 0){ //카드+현금으로 바꾸기
                        ptpaymenttype.value = 4;
                        pt_paymenttype = 4;   //카드+카드로 바꾸기
                    }else if(card == 0 && cash > 0){
                        ptpaymenttype.value = 2;
                        pt_paymenttype = 2;
                    }else if(card > 0 && cash == 0){
                        ptpaymenttype.value = 1;
                        pt_paymenttype = 1;
                    }
                }
                //현금 
                else if(isinputchange == 2){

                    cash = parseCommaInt(pt_id_price_cash.value);

                    vatcard = parseCommaInt(pt_id_price_card.value);

    //                card = parseCommaInt(pt_id_price_card.value)/11*10; //neel_vat
                    card = subVAT(null,parseCommaInt(pt_id_price_card.value)); 

                    remain = all_cash_total - card - cash - discount;
                    total = vatcard + cash + remain + discount;
                    


                    pt_id_price_card.value = CommaString(vatcard);
    //                pt_id_price_cash.value = CommaString(cash);
                    pt_id_price_remain.value = CommaString(remain);
                    pt_id_price_total.value = CommaString(total);
                    pt_id_price_totalremain.value =  CommaString(total-remain-discount);
                    
                    if(card > 0 && cash > 0){ //카드+현금으로 바꾸기
                        ptpaymenttype.value = 4;
                        pt_paymenttype = 4;   //카드+카드로 바꾸기
                    }else if(card == 0 && cash > 0){
                        ptpaymenttype.value = 2;
                        pt_paymenttype = 2;
                    }else if(card > 0 && cash == 0){
                        ptpaymenttype.value = 1;
                        pt_paymenttype = 1;
                    }
                }
                //미수금
                else if(isinputchange == 3){

                    remain = parseCommaInt(pt_id_price_remain.value);
                    cash = parseCommaInt(pt_id_price_cash.value);
                    vatcard = addVAT(null,all_cash_total-cash-remain-discount); 
                    card = all_cash_total-cash-remain-discount;
                    total = vatcard + cash + remain + discount;
                    

                    pt_id_price_card.value = CommaString(vatcard);
                    pt_id_price_cash.value = CommaString(cash);
                    pt_id_price_total.value = CommaString(total);
                    pt_id_price_totalremain.value =  CommaString(total-remain-discount);
                    
                    if(card > 0 && cash > 0){ //카드+현금으로 바꾸기
                        ptpaymenttype.value = 4;
                        pt_paymenttype = 4;   //카드+카드로 바꾸기
                    }else if(card == 0 && cash > 0){
                        ptpaymenttype.value = 2;
                        pt_paymenttype = 2;
                    }else if(card > 0 && cash == 0){
                        ptpaymenttype.value = 1;
                        pt_paymenttype = 1;
                    }
                }
                 //할인가
                else if(isinputchange == 4){

                    remain = parseCommaInt(pt_id_price_remain.value);
                    cash = parseCommaInt(pt_id_price_cash.value);
                    vatcard = addVAT(null,all_cash_total-cash-remain-discount); 
                    card = all_cash_total-cash-remain - discount;
                    total = vatcard + cash + remain + discount;
                    

                    pt_id_price_card.value = CommaString(vatcard);
                    pt_id_price_cash.value = CommaString(cash);
                    pt_id_price_total.value = CommaString(total);
                    pt_id_price_totalremain.value =  CommaString(total-remain-discount);
                }
                //카드, 현금, 카드+현금 바꾸기
                else if(isinputchange == 100){
                    if(pt_paymenttype == 1){
                        card = pt_total;
                        vatcard = pt_total;
                        cash = 0;
                        remain = 0;
                        total = pt_total;

                        pt_id_price_total.value = CommaString(pt_total);
                        pt_id_price_totalremain.value =  CommaString(pt_total);    
                    }else if(pt_paymenttype == 2){
                        card = 0;
                        vatcard = 0;
                        cash = pt_total;
                        remain = 0;
                        total = pt_total;

                        pt_id_price_card.value = CommaString(vatcard);
                        pt_id_price_cash.value = CommaString(cash);
                        pt_id_price_total.value = CommaString(pt_total);
                        pt_id_price_totalremain.value =  CommaString(pt_total);    
                    }
                    else {

                        card = parseCommaInt(pt_id_price_card.value);
                        vatcard = parseCommaInt(pt_id_price_card.value);
                        cash = parseCommaInt(pt_id_price_cash.value);
                        remain = parseCommaInt(pt_id_price_remain.value);
                        total = card + cash + remain + discount;
 
                        pt_id_price_total.value = CommaString(total);
                        pt_id_price_totalremain.value =  CommaString(total-remain-discount);
                        
                        if(card == 0 && cash > 0){
                            ptpaymenttype.value = 2;
                            pt_paymenttype = 2;
                        }else if(card > 0 && cash == 0){
                            ptpaymenttype.value = 1;
                            pt_paymenttype = 1;
                        }
                    }
                }
                 updateTranerPayrollVat(pt_traner_payrollvat, parseInt(pt_paymenttype));
               
            }
            //다른거 입력이다.
            else {

                card = parseCommaInt(pt_id_price_card.value);
                cash = parseCommaInt(pt_id_price_cash.value);
                remain = parseCommaInt(pt_id_price_remain.value);
                total = card + cash + remain + discount;
                
                pt_id_price_total.value = CommaString(total);
                pt_id_price_totalremain.value =  CommaString(total-remain-discount);
            }
            
            
            //card -값을 없애기 위함
            if(card < 0 || vatcard < 0){
                cash = cash+card;
                card = 0;
                vatcard = 0;
            }
            if(isNaN(card))card = 0;
            if(isNaN(vatcard))vatcard = 0;
            if(isNaN(cash))cash = 0;
            if(isNaN(remain))remain = 0;
            if(isNaN(discount))discount = 0;
            if(isNaN(total))total = 0;
            
            
            pt_id_price_card.value = CommaString(vatcard);
            pt_id_price_cash.value = CommaString(cash);
            pt_id_price_total.value = CommaString(total);
            pt_id_price_totalremain.value =  CommaString(total-remain-discount);            
            pt_id_price_discount.value = CommaString(discount);
            
            pt_json_price.counttypeprice = parseCommaInt(pt_id_price_total.value);
            pt_json_price.totalprice = parseCommaInt(pt_id_price_total.value); //기간제 + 라커
            pt_json_price.card = parseCommaInt(pt_id_price_card.value);
            pt_json_price.cash = parseCommaInt(pt_id_price_cash.value);
            pt_json_price.remain = parseCommaInt(pt_id_price_remain.value);
            pt_json_price.discount = parseCommaInt(pt_id_price_discount.value);
            pt_json_price.total = pt_json_price.totalprice;
            pt_json_price.total_remain = pt_json_price.total-pt_json_price.remain-pt_json_price.discount;

              
            
            
            
            var set = pt_total == 0  || pt_count == 0 ? 0 : pt_total/pt_count;
            if(isNaN(set))set = 0;
           
            /* 221027 유진 수정 */
            //pt_pricevat.innerHTML = pt_paymenttype == 1 ? "(VAT "+global_vat+"% :"+CommaString(Math.floor((pt_total/(100+global_vat))*global_vat))+"원)" : ""; //neel_vat
            //div_vat_text.style.display = pt_paymenttype == 1 ? "block" : "none";
            pt_1set.innerHTML = CommaString(parseInt(set));

//            var vat = 0;
//            vat = parseInt(pt_total) == 0 ? 0 : parseInt(pt_total)*0.05;
//            pt_vat.innerHTML = parseInt(vat);
            checkAllPrice();
            
            
            document.getElementById("rpt_id_price_card").value = pt_id_price_card.value;
            document.getElementById("rpt_id_price_cash").value = pt_id_price_cash.value;
            document.getElementById("rpt_id_price_remain").value = pt_id_price_remain.value;
            document.getElementById("rpt_id_price_total").value = pt_id_price_total.value;
            document.getElementById("rpt_id_price_totalremain").value = pt_id_price_totalremain.value;
            
            
//            clog("ppp card "+card+" cash "+cash+" remain "+remain+" total "+total);
            
            before_pt_paymenttype = pt_paymenttype;
        }
        function check_ptdata(){
            
            var obj = new Object();
            obj.pt_check = document.getElementById("check_pt_desc").checked ? true : false;
            obj.pt_name = document.getElementById("pt_name").innerHTML;
            obj.pt_phone = document.getElementById("pt_phone").innerHTML;
            obj.pt_ampm = document.getElementById("pt_traner_am").checked ? "AM" : "PM"; 
            var pt_constructor =  document.getElementById("pt_constructor");
            obj.pt_constructoruid = pt_constructor && pt_constructor.value ? pt_constructor.value : "";
            obj.pt_constructorname = pt_constructor.options[pt_constructor.selectedIndex].text;
            var pt_teachers_list = document.getElementById("pt_teachers_list");
            obj.pt_teachers_value = pt_teachers_list && pt_teachers_list.value ? pt_teachers_list.value : "0";
            obj.pt_starttime  = document.getElementById("pt_starttime").value;
            obj.pt_endtime = document.getElementById("pt_endtime").value;
            obj.pt_count = document.getElementById("pt_count").value;
            obj.pt_mbsidx = selected_pt_coupon.mbs_idx;
            obj.pt_mbsvat = selected_pt_coupon.mbs_vat;
            //obj.pt_freecount = parseInt(document.querySelector('.radiofreept:checked').value);
            obj.pt_freecount = parseInt(document.getElementById("select_service_pt").value);
            obj.pt_pricetotal = parseCommaInt(document.getElementById("pt_pricetotal").value);
            obj.pt_pricerefund = parseCommaInt(document.getElementById("pt_pricerefund").value);
            obj.pt_remainprice = pt_json_price;
            obj.pt_paymenttype = document.getElementById("pt_paymenttype").value;
            obj.signdataname1 = signaturePadName1.toDataURL('image/png');
            obj.signdatasign1 = signaturePadSign1.toDataURL('image/png');
            obj.pt_note = "";
            obj.pt_special_note = "";
            obj.pt_traner_payrollvat = document.getElementById("pt_traner_payrollvat").value;
            
            var spacial_contract_input = document.getElementById("spacial_contract_input"); // 특약 input 
            var special_contract_signdata = document.getElementById("sign_img_special_contract").src;
            if(spacial_contract_input.value != "" && special_contract_signdata.indexOf("data:image") >= 0){
                obj.pt_sign_special_contract = special_contract_signdata;
                 obj.pt_special_note = spacial_contract_input.value;
            }
            
            obj.pt_desc = selected_pt_coupon.mbs_type+" "+obj.pt_count+"회 ￦"+obj.pt_pricetotal+"";
            obj.counttype_coupon_value = document.getElementById('counttype_coupon').value;
            
            
            if(spacial_contract_input.value != "" && special_contract_signdata.indexOf("data:image") < 0){
                alertMsg("PT 특약 규정에 서명해 주세요.");
                return;
            }
            if(!obj.pt_check || !obj.pt_name || !obj.pt_phone || !obj.pt_constructoruid || !obj.pt_starttime || !obj.pt_paymenttype || !obj.pt_endtime || obj.pt_count == '0'|| signaturePadName1.isEmpty() || signaturePadSign1.isEmpty()){
                    if(!obj.pt_check){
                         alertMsg("환불규정 체크박스에 체크해 주세요.");
                    }else if(!obj.pt_name){
                        alertMsg("이름을 입력해주세요.");     
                    }else if(!obj.pt_phone){
                        alertMsg("전화번호를 입력해주세요.");     
                    }else if(!obj.pt_constructoruid){
                        alertMsg("계약트레이너를 선택해주세요.");     
                    }else if(!obj.pt_starttime){
                        alertMsg("시작일을 선택해주세요.");     
                    }else if(!obj.pt_endtime){
                        alertMsg("종료일을 선택해주세요.");     
                    }else if(obj.pt_count == '0'){
                        alertMsg("총 Session값은 최소 1회 이상이어야 합니다.");     
                    }else if(!obj.pt_paymenttype){
                        alertMsg("결제방법을 선택하세요");     
                    }else if (signaturePadName1.isEmpty()){
                        alertMsg("자필 이름입력이 필요합니다.");
                    }else if (signaturePadSign1.isEmpty()){
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
            if(pt_teachers_list)
                var opts = document.getElementById("teachers_list").selectedIndex = pt_teachers_list.selectedIndex;
            
            document.getElementById("counttype_coupon_price").value = CommaString(obj.pt_pricetotal);
            
            if(obj.pt_ampm == "AM")
                document.getElementById("traner_am").checked = true;
            else 
                document.getElementById("traner_pm").checked = true;

            pt_join_data = obj;
            
            var txt_payrollvat_tag = parseInt(obj.pt_traner_payrollvat) == 0 ? "<br><span style='color:#fa6374;font-weight:bold'>페이롤 부가세 미적용됨</span>" : "<br><span style='color:#fa6374;font-weight:bold'>페이롤 부가세 10% 적용됨</span>";
            if(parseInt(obj.pt_teachers_value) == 0){
                 alertMsg("주의!! <br>트레이너 미지정상태입니다.",function(){
                    showModalDialog(document.body, "PT가입", "내용에 이상이 없으며 위 내용대로 가입하시겠습니까?"+txt_payrollvat_tag, "가입완료하기", "취소", function() {

                        showModalDialog(document.body, "P.T계약서 작성완료!", "PT 계약서 작성을 완료하였습니다. 계속해서 회원가입을 해주세요.", "확인", null, function() {

                             setPTDocument(true);
                             hideModalDialog();
                             hideModalDialog();
                             hideModalDialog();
                        }, function() {});

                    }, function() {hideModalDialog();});
                     
                 });
            }else{
                
                showModalDialog(document.body, "PT가입", "내용에 이상이 없으며 위 내용대로 가입하시겠습니까?"+txt_payrollvat_tag, "가입완료하기", "취소", function() {

                    showModalDialog(document.body, "P.T계약서 작성완료!", "PT 계약서 작성을 완료하였습니다. 계속해서 회원가입을 해주세요.", "확인", null, function() {

                         setPTDocument(true);
                         hideModalDialog();
                         hideModalDialog();
                         hideModalDialog();
                    }, function() {});

                }, function() {hideModalDialog();});
            }
           
            
             checkCouponTitleColor();
        }
        function change_termtype_coupon() {

            var termtype_coupon = document.getElementById("termtype_coupon").value;
            var termdatediv = document.getElementById("termdatediv");
            var id_bonusday = document.getElementById("id_bonusday");
            var div_termcount = document.getElementById("div_termcount");
            var id_termcount = document.getElementById("id_termcount");
            
            var payment_type = document.getElementById("payment_type");
            payment_type.value = "";
            
            if (termtype_coupon != 0) termdatediv.style.display = "block";
            else termdatediv.style.display = "none";
            selected_mbs = null;
            for (var i = 0; i < mbs_coupons.length; i++) {
                if (mbs_coupons[i].mbs_idx == termtype_coupon) {
                    selected_mbs = mbs_coupons[i];
                    break;
                }
            }
            
            if(selected_mbs && selected_mbs.mbs_max_count > 0){
                div_termcount.style.visibility = "visible";                
                id_termcount.value = selected_mbs.mbs_max_count;
            }else {
                div_termcount.style.visibility = "hidden";       
                id_termcount.value = 0;
            }
                
            
            var mbs_price = selected_mbs ? parseCommaInt(selected_mbs.mbs_price) : 0; //기간제 가격
            var mbs_month = selected_mbs ? parseInt(selected_mbs.mbs_month) : 0; //기간제 달
            clog("mbs_month " + mbs_month);
            
            var input_term_novat_price = document.getElementById("input_term_novat_price");
            input_term_novat_price.value = CommaString(mbs_price);
            
            if(auth >= AUTH_OPERATOR){
                id_bonusday.style.visibility = "visible";
            }else{
                id_bonusday.value = 0;
                id_bonusday.style.visibility = "hidden";
            }
            
            
            var termtype_starttime = document.getElementById("termtype_starttime");
            var termtype_endtime = document.getElementById("termtype_endtime");

            
            var nmonth = nextMonth(termtype_starttime.value, mbs_month);

            termtype_endtime.innerHTML = nmonth;

//            console.log("selected_mbs. ",selected_mbs);
            
//            change_locker_starttime(termtype_starttime.value,mbs_month);
            checkAllPrice();
        }
        var before_servicemonth = 0;
        function initServiceLocker(_month){
            var month = _month ? parseInt(_month) : 0;
            var id_locker_servicemonth =  document.getElementById("id_locker_servicemonth");
            id_locker_servicemonth.innerHTML = "";
            for(var i = 0 ; i <= month; i++){
                if(before_servicemonth == i)
                    id_locker_servicemonth.innerHTML += "<option value='"+i+"' style='color:red' selected>- "+i+"개월</option>";
                else 
                    id_locker_servicemonth.innerHTML += "<option value='"+i+"' style='color:red'>- "+i+"개월</option>";
            }
        }
        var term_and_locker_price = 0;
        var before_paymenttype = "";
        
        function checkAllPrice(isinputchange){
            
            var termtype_coupon = document.getElementById("termtype_coupon").value;
            for (var i = 0; i < mbs_coupons.length; i++) {
                if (mbs_coupons[i].mbs_idx == termtype_coupon) {
                    selected_mbs = mbs_coupons[i];
                    break;
                }
            }
            var mbsvat = selected_mbs ? selected_mbs.mbs_vat : 0;
            var payment_type = document.getElementById('payment_type');
            var mbs_month = selected_mbs ? parseInt(selected_mbs.mbs_month) : 0; //기간제 달
            
            var div_term_price = document.getElementById("div_term_price");
        
            
            
            var div_mainuse_container = document.getElementById("div_mainuse_container");
            var id_privacy_policy2 = document.getElementById("id_privacy_policy2");
            
            //금액이 0원짜리 무료 회원권이라면 카드현금 등등 화면을 보여주지 않는다.
            if(selected_mbs && selected_mbs.mbs_price == "0" && selected_mbs.mbs_name.indexOf(ID_FREE) >= 0){
                payment_type.value = "2";
                div_term_price.style.display = "none";
                
                div_mainuse_container.style.display = "none";
                id_privacy_policy2.checked = true;
                
            }else {
                
                div_term_price.style.display = "block";
                div_mainuse_container.style.display = "block";
                id_privacy_policy2.checked = false;
            }
           
//            clog("selected_mbs.mbs_price ",Math.floor(selected_mbs.mbs_price*vat));
            var input_term_novat_price = document.getElementById("input_term_novat_price");
            var input_term_price = document.getElementById("input_term_price");
            
            
            var id_price_card = document.getElementById("id_price_card");
            var id_price_cash = document.getElementById("id_price_cash");
            var id_price_remain = document.getElementById("id_price_remain");
            var id_price_discount = document.getElementById("id_price_discount");
            var id_price_total = document.getElementById("id_price_total");
            var id_price_totalremain = document.getElementById("id_price_totalremain");
            
   
            if(isinputchange == 113){//부가세포함 회원권가격
                input_term_novat_price.value = parseInt(payment_type.value) == 1 ? CommaString(subVAT(null,input_term_price.value,mbsvat)) : CommaString(input_term_price.value);                
            }

            json_price.counttypeprice = document.getElementById('counttype_coupon_price').value ? parseCommaInt(document.getElementById('counttype_coupon_price').value) : 0;

            

            
            if(isinputchange != 120 && isinputchange != 113 && isinputchange != 1 && isinputchange != 2 && isinputchange != 3)
                input_term_price.value = input_term_novat_price.value;

            var table_totalprice = document.getElementById("table_totalprice");
            
        
     
            
            //결제타입 변경했다면 카드 , 현금 , 카드+현금
            if(isinputchange && isinputchange == 120){
                //카드로 변경
                if(payment_type.value == "1" && before_paymenttype != "1"){
                    id_price_card.value = addVAT(null,parseCommaInt(input_term_novat_price.value),mbsvat);
                    id_price_cash.value = "0";
                    id_price_remain.value = "0";
                    id_price_discount.value = "0";
                    id_price_total.value = parseCommaInt(id_price_card.value)+parseCommaInt(id_price_cash.value)+parseCommaInt(id_price_remain.value);
                    id_price_totalremain.value = parseCommaInt(id_price_card.value)+parseCommaInt(id_price_cash.value);
                }
                //현금으로 변경
                else if(payment_type.value != "1" ){
                    id_price_card.value = "0";
                    id_price_cash.value = input_term_novat_price.value;
                    id_price_remain.value = "0";
                    id_price_discount.value = "0";
                    id_price_total.value = parseCommaInt(id_price_card.value)+parseCommaInt(id_price_cash.value)+parseCommaInt(id_price_remain.value);
                    id_price_totalremain.value = parseCommaInt(id_price_card.value)+parseCommaInt(id_price_cash.value);
                }else {
                    
                }
                
                if(payment_type.value)reshowTermPriceTable();
            }
            
           
            

            regist_total_price = total_price;
            
            //현금 , 카드 , 미수금 , 총금액
            var ctotal = parseCommaInt(input_term_novat_price.value);
            var card = parseCommaInt(id_price_card.value);
            var cash = parseCommaInt(id_price_cash.value);
            var remain = parseCommaInt(id_price_remain.value);
            var discount = parseCommaInt(id_price_discount.value);
            var total = parseCommaInt(id_price_total.value);
            var total_remain = parseCommaInt(id_price_totalremain.value);
            
               
            //회원권 가격을 수정했다면
            if(isinputchange == 113){
                payment_type.value == "2";
                //input_term_novat_price.value = parseInt(payment_type.value) == 1 ? CommaString(subVAT(null,input_term_price.value,mbsvat)) : input_term_price.value;     
                input_term_novat_price.value = input_term_price.value;     
                var price = parseCommaInt(input_term_novat_price.value);                
                
                card = 0;
                cash = parseCommaInt(price);
                remain = 0;
                dicount = 0;
                total = parseCommaInt(price);
                total_remain = parseCommaInt(price);
                
                id_price_card.value = "0";
                id_price_cash.value = price;
                id_price_remain.value = "0";
                id_price_discount.value = "0";
                id_price_total.value = price;
                id_price_totalremain.value = price;
                
                if(payment_type.value)reshowTermPriceTable();
                
                clog("회원권 가격을 수정 card "+card+" cash "+cash+" remain "+remain+" total "+total+" total_remain"+total_remain);
            }
            
            //카드수정
            else if(isinputchange && isinputchange == 1){
                input_term_novat_price.value = parseInt(payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_term_price.value),mbsvat)) : input_term_price.value;     
                var novatprice = parseCommaInt(input_term_novat_price.value);
                card = parseCommaInt(id_price_card.value);
                var dcardprice = parseInt(payment_type.value) == 1 ? subVAT(null,card) : card;
                cash = parseCommaInt(id_price_cash.value);
                remain = novatprice-(dcardprice+cash)-discount;
                total = card+cash+remain+discount;
                total_remain = card+cash;
                
                
                id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value = CommaString(total_remain);
            }
            //현금 수정
            else if(isinputchange && isinputchange == 2){
                input_term_novat_price.value = parseInt(payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_term_price.value),mbsvat)) : input_term_price.value;     
                var novatprice = parseCommaInt(input_term_novat_price.value);
                card = parseCommaInt(id_price_card.value);
                var dcardprice = parseInt(payment_type.value) == 1 ? subVAT(null,card) : card;
                cash = parseCommaInt(id_price_cash.value);
                remain = novatprice-(dcardprice+cash)-discount;;
                total = card+cash+remain+discount;
                total_remain = card+cash;
                
                
                id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value = CommaString(total_remain);
            }
            //미수금 수정
            else if(isinputchange && isinputchange == 3){
                input_term_novat_price.value = parseInt(payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_term_price.value),mbsvat)) : input_term_price.value;     
                var novatprice = parseCommaInt(input_term_novat_price.value);
                
                var dcardprice = parseInt(payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(id_price_cash.value);
                remain = parseCommaInt(id_price_remain.value);
                card = addVAT(null,novatprice-(remain+cash)-discount,mbsvat);
                
                
                
                total = card+cash+remain+discount;
                total_remain = card+cash;
                
                
               
                
                id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value = CommaString(total_remain);
            
            }
            //할인금 수정
            else if(isinputchange && isinputchange == 4){
                input_term_novat_price.value = parseInt(payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_term_price.value),mbsvat)) : input_term_price.value;     
                var novatprice = parseCommaInt(input_term_novat_price.value);
                
                var dcardprice = parseInt(payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(id_price_cash.value);
                remain = parseCommaInt(id_price_remain.value);
                card = addVAT(null,novatprice-(remain+cash)-discount,mbsvat);
                
                
//                clog("card "+card+" cash "+cash+" remain "+remain+" discount "+discount);
                
                total = card+cash+remain+discount;
                total_remain = card+cash;
                
                clog("total is "+total);
                
                
                
                id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_price_cash.value = CommaString(cash);
                id_price_remain.value = CommaString(remain);
                id_price_total.value = CommaString(total);
                id_price_totalremain.value = CommaString(total_remain);
            
            }
            
            //card -값을 없애기 위함
            if(card < 0){
                cash = cash+card;
                card = 0;
            }
            
            clog("eee card "+card+" cash "+cash+" remain "+remain+" total "+total+" total_remain"+total_remain);
            //다시 계산 반드시 필요
            total = card + cash + remain + discount;
            id_price_card.value = CommaString(card);
            id_price_cash.value = CommaString(cash);
            id_price_remain.value = CommaString(remain);
            id_price_discount.value = CommaString(discount);
            id_price_total.value = CommaString(total);
            id_price_totalremain.value = CommaString(total_remain);
            
            json_price.totalprice = total;
            json_price.card = card;
            json_price.cash = cash;
            json_price.remain = remain;
            json_price.discount = discount;
            json_price.total = total;
            json_price.total_remain = total-remain-discount;
          
            if(payment_type.value){
                if(card > 0 && cash > 0){
                    payment_type.value = "4";                
                }else if(card > 0 && cash == 0){
                    payment_type.value = "1";                
                }else if(card == 0 && cash > 0){
                    payment_type.value = "2";                
                }    
            }
            
            json_price.termtypeprice = parseCommaInt(input_term_price.value);
            //결제타입이 선택되어있다면 보여준다.
            table_totalprice.style.display = payment_type.value ? "block" : "none";
            
            before_paymenttype = payment_type.value;
         
//            if(isinputchange == 113)checkAllPrice();
            
            checkCouponTitleColor();
        }
        var before_locker_paymenttype = "";
       function checkLockerPrice(isinputchange){
            
            var locker_payment_type = document.getElementById('locker_payment_type');
            var id_locker_month = document.getElementById("id_locker_month");
            var mbsvat = global_vat;
//            var vat = parseInt(locker_payment_type.value) == 1 ? (100+global_vat)/100 : 1; //neel_vat
            
            //라커 개월수
            var locker_month = id_locker_month.value ? parseInt(id_locker_month.value) : 0;
            
//            var monthprice = default_locker_month_price * vat;
            var use_locker = document.getElementById('use_locker').value;
           
            
            var locker_id_price_card = document.getElementById("locker_id_price_card");
            var locker_id_price_cash = document.getElementById("locker_id_price_cash");
            var locker_id_price_remain = document.getElementById("locker_id_price_remain");
            var locker_id_price_total = document.getElementById("locker_id_price_total"); //미수금 포함 총금액
            var locker_id_price_totalremain = document.getElementById("locker_id_price_totalremain"); //결제금액
            var locker_table_totalprice = document.getElementById("locker_table_totalprice");
            var input_locker_novat_price = document.getElementById("input_locker_novat_price");
            var id_locker_servicemonth = document.getElementById("id_locker_servicemonth");
            var input_locker_price = document.getElementById("input_locker_price");
            
            //라커 서비스개월수 
            var locker_servicemonth =  id_locker_servicemonth.value ? parseInt(id_locker_servicemonth.value) : 0;
           
           
            if(isinputchange && isinputchange == 310){
                before_servicemonth = parseInt(id_locker_servicemonth.value);
            }else {
                initServiceLocker(locker_month);
            }
            
            

            
            
            var card = 0;
            var cash = 0;
            var remain = 0;
            var total = 0;
            var total_remain = 0;
            
            json_price.lockerprice = {};
            
            
            
              
            //결제타입 변경했다면 카드 , 현금 , 카드+현금
            if(isinputchange && isinputchange == 300){
                
                //카드로 변경
                if(locker_payment_type.value == "1" && before_locker_paymenttype != "1"){
                    locker_id_price_card.value = addVAT(null,parseCommaInt(input_locker_novat_price.value),mbsvat);
                    locker_id_price_cash.value = "0";
                    locker_id_price_remain.value = "0";
                    locker_id_price_total.value = parseCommaInt(locker_id_price_card.value)+parseCommaInt(locker_id_price_cash.value)+parseCommaInt(locker_id_price_remain.value);
                    locker_id_price_totalremain.value = parseCommaInt(locker_id_price_card.value)+parseCommaInt(locker_id_price_cash.value);
                    
                    var price = parseCommaInt(locker_id_price_card.value);
                    card = parseCommaInt(price);
                    cash = 0;
                    remain = 0;
                    total = parseCommaInt(price);
                    total_remain = parseCommaInt(price);
                }
                //현금으로 변경
                else if(locker_payment_type.value != "1" ){
                    locker_id_price_card.value = "0";
                    locker_id_price_cash.value = input_locker_novat_price.value;
                    locker_id_price_remain.value = "0";
                    locker_id_price_total.value = parseCommaInt(locker_id_price_card.value)+parseCommaInt(locker_id_price_cash.value)+parseCommaInt(locker_id_price_remain.value);
                    locker_id_price_totalremain.value = parseCommaInt(locker_id_price_card.value)+parseCommaInt(locker_id_price_cash.value);
                    
                    var price = parseCommaInt(locker_id_price_cash.value);
                    card = 0;
                    cash = parseCommaInt(price);
                    remain = 0;
                    total = parseCommaInt(price);
                    total_remain = parseCommaInt(price);
                }else {
                    
                }
                
                if(locker_payment_type.value)reshowLockerPriceTable("locker_table_totalprice");
                
            }
            
            
            
            // 라커개월수 변경 , 서비스라커 개월수 변경
            if(isinputchange == 319 || isinputchange == 310){ 
                if(isinputchange == 319){
                    id_locker_servicemonth.value ="0";
                    locker_servicemonth = 0;
                }
                var default_price =  (locker_month-locker_servicemonth)*default_locker_month_price;
                var vatprice = addVAT(null,(locker_month-locker_servicemonth)*default_locker_month_price,mbsvat);
               
                
                
                input_locker_novat_price.value = CommaString(default_price); //안보이는 현금기준 총금액
                
                //현재 카드결제타입이라면
                if(parseInt(locker_payment_type.value) == 1){
                     input_locker_price.value = CommaString(vatprice); //라커 가격
                
                
                    locker_id_price_card.value = "0";
                    locker_id_price_cash.value = CommaString(vatprice);
                    locker_id_price_remain.value = "0";
                    locker_id_price_total.value = CommaString(vatprice);
                    locker_id_price_totalremain.value = CommaString(vatprice);

                    card = parseCommaInt(vatprice);
                    cash = 0;
                    remain = 0;
                    total = parseCommaInt(vatprice);
                    total_remain = parseCommaInt(vatprice);
                }
                //현재 카드결제타입이 아니라면
                else {
                     input_locker_price.value =  CommaString(default_price); //라커 가격
                
                
                    locker_id_price_card.value = "0";
                    locker_id_price_cash.value = CommaString(default_price);
                    locker_id_price_remain.value = "0";
                    locker_id_price_total.value = CommaString(default_price);
                    locker_id_price_totalremain.value = CommaString(default_price);

                    card = 0;
                    cash = parseCommaInt(default_price);
                    remain = 0;
                    total = parseCommaInt(default_price);
                    total_remain = parseCommaInt(default_price);
                }
                if(locker_payment_type.value)reshowLockerPriceTable("locker_table_totalprice");
                
            }
            
            else if(isinputchange == 311){//라커금액을 변경했다면            
                locker_payment_type.value = "2";
                //input_locker_novat_price.value = parseInt(locker_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_locker_price.value),mbsvat)) : input_locker_price.value;     
                input_locker_novat_price.value = input_locker_price.value;     
                
                var price = parseCommaInt(input_locker_novat_price.value);                
                
                card = 0;
                cash = parseCommaInt(price);
                remain = 0;
                total = parseCommaInt(price);
                total_remain = parseCommaInt(price);
                
                locker_id_price_card.value = "0";
                locker_id_price_cash.value = price;
                locker_id_price_remain.value = "0";
                locker_id_price_total.value = price;
                locker_id_price_totalremain.value = price;
                
                if(locker_payment_type.value)reshowLockerPriceTable("locker_table_totalprice");
                
                clog("311 card "+card+" cash "+cash+" remain "+remain+" total "+total+" total_remain"+total_remain);
                
            }else if(isinputchange == 301){ //카드 수정
                input_locker_novat_price.value = parseInt(locker_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_locker_price.value),mbsvat)) : input_locker_price.value;     
                
                var novatprice = parseCommaInt(input_locker_novat_price.value);
                card = parseCommaInt(locker_id_price_card.value);
                var dcardprice = parseInt(locker_payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(locker_id_price_cash.value);
                remain = novatprice-(dcardprice+cash);
                
                //미수금을 항상 0으로 만들기위함
                {
                    cash += remain;
                    remain = 0;                
                }
                
                total = card+cash+remain;
                total_remain = card+cash;
                
                
                locker_id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                locker_id_price_cash.value = CommaString(cash);
                locker_id_price_remain.value = CommaString(remain);
                locker_id_price_total.value = CommaString(total);
                locker_id_price_totalremain.value = CommaString(total_remain);
            }
            else if(isinputchange == 302){ //현금 수정
                input_locker_novat_price.value = parseInt(locker_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_locker_price.value),mbsvat)) : input_locker_price.value;     
                
                var novatprice = parseCommaInt(input_locker_novat_price.value);
                card = parseCommaInt(locker_id_price_card.value);
                var dcardprice = parseInt(locker_payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(locker_id_price_cash.value);
                remain = novatprice-(dcardprice+cash);
                
                //미수금을 항상 0으로 만들기위함
                {
                    card += remain;
                    remain = 0;                
                }
                total = card+cash+remain;
                total_remain = card+cash;
                
                
                locker_id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                locker_id_price_cash.value = CommaString(cash);
                locker_id_price_remain.value = CommaString(remain);
                locker_id_price_total.value = CommaString(total);
                locker_id_price_totalremain.value = CommaString(total_remain);
            }
            else if(isinputchange == 303){ //미수금 수정
                input_locker_novat_price.value = parseInt(locker_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_locker_price.value),mbsvat)) : input_locker_price.value;     
                
                var novatprice = parseCommaInt(input_locker_novat_price.value);
                
                var dcardprice = parseInt(locker_payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(locker_id_price_cash.value);
                remain = parseCommaInt(locker_id_price_remain.value);
                card = addVAT(null,novatprice-(remain+cash),mbsvat);
                
                total = card+cash+remain;
                total_remain = card+cash;
                
                
                locker_id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                locker_id_price_cash.value = CommaString(cash);
                locker_id_price_remain.value = CommaString(remain);
                locker_id_price_total.value = CommaString(total);
                locker_id_price_totalremain.value = CommaString(total_remain);
            }
            
//            clog("eee card "+card+" cash "+cash+" remain "+remain+" total "+total+" total_remain"+total_remain);
            //card -값을 없애기 위함
            if(card < 0){
                cash = cash+card;
                card = 0;
            }
           
           
            locker_id_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
            locker_id_price_cash.value = CommaString(cash);
            locker_id_price_remain.value = CommaString(remain);
            locker_id_price_total.value = CommaString(total);
            locker_id_price_totalremain.value = CommaString(total_remain);
           
            var json_lockerprice = {
                "card":card,
                "cash":cash,
                "remain":remain,
                "total":total,
                "totalprice":total,
                "total_remain":total_remain                
            }
            
            
            
            
            
            json_price.lockerprice = json_lockerprice;
            
            json_price.serviceprice = parseInt(locker_payment_type.value) == 1 ? addVAT(null,locker_servicemonth*default_locker_month_price,mbsvat) : locker_servicemonth*default_locker_month_price;
            
            if(use_locker == "0"){
                json_price.lockerprice = {};
            }
            
            if(card > 0 && cash > 0){
                locker_payment_type.value = "4";                
            }else if(card > 0 && cash == 0){
                locker_payment_type.value = "1";                
            }else if(card == 0 && cash > 0){
                locker_payment_type.value = "2";                
            }
         
           change_locker_starttime();
           
           locker_table_totalprice.style.display = locker_payment_type.value ? "block" : "none";
           before_locker_paymenttype = locker_payment_type.value;
//            if(isinputchange == 311)checkLockerPrice();
            
            clog("json_price.lockerprice ",json_price.lockerprice);
           
           checkCouponTitleColor();
        }
         var before_other_paymenttype = "";
       function checkOtherPrice(idx,isinputchange){
           //isinputchange ==  50:시작일 ,51:종료일 52:개월수 113 : 상품가격  , 120 : 결제방법 , 1:카드 ,2 :현금,3:미수금,4:할인가
           /*
            other_coupon_name
            other_coupon_value
            otherdatediv
            other_starttime
            other_endtime
            id_other_month
            id_otherprice_ ??
            input_other_price
            other_payment_type
            other_table_totalprice
            input_other_novat_price
            default_other_1month_price
            id_other_price_card
            id_other_price_cash
            id_other_price_remain
            id_other_price_discount
            id_other_price_total
            id_other_price_totalremain
           */
           
            var other_coupon_name = document.getElementById("other_coupon_name_"+idx);
            var other_coupon_value = document.getElementById("other_coupon_value_"+idx);
            var other_payment_type = document.getElementById("other_payment_type_"+idx);
            var other_starttime = document.getElementById("other_starttime_"+idx);
            var other_endtime = document.getElementById("other_endtime_"+idx);
            var id_other_month = document.getElementById("id_other_month_"+idx);
            var mbsvat = 0;
//            var vat = parseInt(other_payment_type.value) == 1 ? (100+global_vat)/100 : 1; //neel_vat
            
            //기타상품 개월수
            var other_month = id_other_month.value ? parseInt(id_other_month.value) : 0;
            
//            var monthprice = default_other_month_price * vat;
//            var use_other = document.getElementById('use_other').value;
           
            
            var id_other_price_card = document.getElementById("id_other_price_card_"+idx);
            var id_other_price_cash = document.getElementById("id_other_price_cash_"+idx);
            var id_other_price_remain = document.getElementById("id_other_price_remain_"+idx);
            var id_other_price_total = document.getElementById("id_other_price_total_"+idx); //미수금 포함 총금액
            var id_other_price_totalremain = document.getElementById("id_other_price_totalremain_"+idx); //결제금액
            var other_table_totalprice = document.getElementById("other_table_totalprice_"+idx);
            var input_other_novat_price = document.getElementById("input_other_novat_price_"+idx);
            var default_other_1month_price = parseInt(document.getElementById("default_other_1month_price_"+idx).value);
            var input_other_price = document.getElementById("input_other_price_"+idx);
            
            //기타상품 서비스개월수 
//            var other_servicemonth =  id_other_servicemonth.value ? parseInt(id_other_servicemonth.value) : 0;
           
           
//            if(isinputchange && isinputchange == 310){
//                before_servicemonth = parseInt(id_other_servicemonth.value);
//            }else {
//                initServiceother(other_month);
//            }
            
            

            
            
            var card = 0;
            var cash = 0;
            var remain = 0;
            var total = 0;
            var total_remain = 0;
            
           
            
            
              
            //결제타입 변경했다면 카드 , 현금 , 카드+현금
            if(isinputchange && isinputchange == 120){
                
                //카드로 변경
                if(other_payment_type.value == "1" && before_other_paymenttype != "1"){
                    id_other_price_card.value = addVAT(null,parseCommaInt(input_other_novat_price.value),mbsvat);
                    id_other_price_cash.value = "0";
                    id_other_price_remain.value = "0";
                    id_other_price_total.value = parseCommaInt(id_other_price_card.value)+parseCommaInt(id_other_price_cash.value)+parseCommaInt(id_other_price_remain.value);
                    id_other_price_totalremain.value = parseCommaInt(id_other_price_card.value)+parseCommaInt(id_other_price_cash.value);
                    
                    var price = parseCommaInt(id_other_price_card.value);
                    card = parseCommaInt(price);
                    cash = 0;
                    remain = 0;
                    total = parseCommaInt(price);
                    total_remain = parseCommaInt(price);
                }
                //현금으로 변경
                else if(other_payment_type.value != "1" ){
                    id_other_price_card.value = "0";
                    id_other_price_cash.value = input_other_novat_price.value;
                    id_other_price_remain.value = "0";
                    id_other_price_total.value = parseCommaInt(id_other_price_card.value)+parseCommaInt(id_other_price_cash.value)+parseCommaInt(id_other_price_remain.value);
                    id_other_price_totalremain.value = parseCommaInt(id_other_price_card.value)+parseCommaInt(id_other_price_cash.value);
                    
                    var price = parseCommaInt(id_other_price_cash.value);
                    card = 0;
                    cash = parseCommaInt(price);
                    remain = 0;
                    total = parseCommaInt(price);
                    total_remain = parseCommaInt(price);
                }else {
                    
                }
                
                if(other_payment_type.value)reshowOtherPriceTable("other_table_totalprice_"+idx);
                
            }
            if(isinputchange == 50 || isinputchange == 51){
                other_payment_type.value = "";
            }
            
            
            // 기타상품개월수 변경 
            if(isinputchange == 52 && default_other_1month_price > 0){ 
//                if(isinputchange == 319){
//                    id_other_servicemonth.value ="0";
//                    other_servicemonth = 0;
//                }
                var default_price =  (other_month)*default_other_1month_price;
                var vatprice = addVAT(null,(other_month)*default_other_1month_price,mbsvat);
               
                other_endtime.value = nextMonth(other_starttime.value, parseInt(id_other_month.value));
                
                input_other_novat_price.value = CommaString(default_price); //안보이는 현금기준 총금액
                
                //현재 카드결제타입이라면
                if(parseInt(other_payment_type.value) == 1){
                     input_other_price.value = CommaString(vatprice); //라커 가격
                
                
                    id_other_price_card.value = "0";
                    id_other_price_cash.value = CommaString(vatprice);
                    id_other_price_remain.value = "0";
                    id_other_price_total.value = CommaString(vatprice);
                    id_other_price_totalremain.value = CommaString(vatprice);

                    card = parseCommaInt(vatprice);
                    cash = 0;
                    remain = 0;
                    total = parseCommaInt(vatprice);
                    total_remain = parseCommaInt(vatprice);
                }
                //현재 카드결제타입이 아니라면
                else {
                    input_other_price.value =  CommaString(default_price); //라커 가격
                
                
                    id_other_price_card.value = "0";
                    id_other_price_cash.value = CommaString(default_price);
                    id_other_price_remain.value = "0";
                    id_other_price_total.value = CommaString(default_price);
                    id_other_price_totalremain.value = CommaString(default_price);

                    card = 0;
                    cash = parseCommaInt(default_price);
                    remain = 0;
                    total = parseCommaInt(default_price);
                    total_remain = parseCommaInt(default_price);
                }
                if(other_payment_type.value)reshowOtherPriceTable("other_table_totalprice_"+idx);
                
            }
            
            else if(isinputchange == 113){//라커금액을 변경했다면            
                other_payment_type.value = "2";
                //input_other_novat_price.value = parseInt(other_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_other_price.value),mbsvat)) : input_other_price.value;     
                input_other_novat_price.value = input_other_price.value;     
                
                var price = parseCommaInt(input_other_novat_price.value);                
                
                card = 0;
                cash = parseCommaInt(price);
                remain = 0;
                total = parseCommaInt(price);
                total_remain = parseCommaInt(price);
                
                id_other_price_card.value = "0";
                id_other_price_cash.value = price;
                id_other_price_remain.value = "0";
                id_other_price_total.value = price;
                id_other_price_totalremain.value = price;
                
                if(other_payment_type.value)reshowOtherPriceTable("other_table_totalprice_"+idx);
                
                clog("311 card "+card+" cash "+cash+" remain "+remain+" total "+total+" total_remain"+total_remain);
                
            }
           else if(isinputchange == 1){ //카드 수정
                input_other_novat_price.value = parseInt(other_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_other_price.value),mbsvat)) : input_other_price.value;     
                
                var novatprice = parseCommaInt(input_other_novat_price.value);
                card = parseCommaInt(id_other_price_card.value);
                var dcardprice = parseInt(other_payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(id_other_price_cash.value);
                remain = novatprice-(dcardprice+cash);
                
               //미수금을 항상 0으로 만들기위함
                {
                    cash += remain;
                    remain = 0;                
                }
               
                total = card+cash+remain;
                total_remain = card+cash;
                
                
                id_other_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_other_price_cash.value = CommaString(cash);
                id_other_price_remain.value = CommaString(remain);
                id_other_price_total.value = CommaString(total);
                id_other_price_totalremain.value = CommaString(total_remain);
            }
            else if(isinputchange == 2){ //현금 수정
                input_other_novat_price.value = parseInt(other_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_other_price.value),mbsvat)) : input_other_price.value;     
                
                var novatprice = parseCommaInt(input_other_novat_price.value);
                card = parseCommaInt(id_other_price_card.value);
                var dcardprice = parseInt(other_payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(id_other_price_cash.value);
                remain = novatprice-(dcardprice+cash);
                
                //미수금을 항상 0으로 만들기위함
                {
                    card += remain;
                    remain = 0;                
                }
                
                total = card+cash+remain;
                total_remain = card+cash;
                
                
                id_other_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_other_price_cash.value = CommaString(cash);
                id_other_price_remain.value = CommaString(remain);
                id_other_price_total.value = CommaString(total);
                id_other_price_totalremain.value = CommaString(total_remain);
            }
            else if(isinputchange == 3){ //미수금 수정
                input_other_novat_price.value = parseInt(other_payment_type.value) == 1 ? CommaString(subVAT(null,parseCommaInt(input_other_price.value),mbsvat)) : input_other_price.value;     
                
                var novatprice = parseCommaInt(input_other_novat_price.value);
                
                var dcardprice = parseInt(other_payment_type.value) == 1 ? subVAT(null,card,mbsvat) : card;
                cash = parseCommaInt(id_other_price_cash.value);
                remain = parseCommaInt(id_other_price_remain.value);
                card = addVAT(null,novatprice-(remain+cash),mbsvat);
                
                total = card+cash+remain;
                total_remain = card+cash;
                
                
                id_other_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
                id_other_price_cash.value = CommaString(cash);
                id_other_price_remain.value = CommaString(remain);
                id_other_price_total.value = CommaString(total);
                id_other_price_totalremain.value = CommaString(total_remain);
            }
            
//            clog("eee card "+card+" cash "+cash+" remain "+remain+" total "+total+" total_remain"+total_remain);
            //card -값을 없애기 위함
            if(card < 0){
                cash = cash+card;
                card = 0;
            }
           
           
            id_other_price_card.value = CommaString(card); //수정한게 카드이니 고대로다
            id_other_price_cash.value = CommaString(cash);
            id_other_price_remain.value = CommaString(remain);
            id_other_price_total.value = CommaString(total);
            id_other_price_totalremain.value = CommaString(total_remain);
           
            var json_otherprice = {
                "card":card,
                "cash":cash,
                "remain":remain,
                "total":total,
                "totalprice":total,
                "total_remain":total_remain,
                
            }
            var json_othercoupon = {
                "starttime" : other_starttime.value,
                "endtime" : other_endtime.value,
                "month" : id_other_month.value,
                "paymenttype" : other_payment_type.value,
                "couponname" : other_coupon_name.innerHTML,
                "couponidx" : other_coupon_value.innerHTML,
                "couponprice" :json_otherprice
            }
            
            
            
           
            
            setOtherCoupon(json_othercoupon);
            
//            json_price.serviceprice = parseInt(other_payment_type.value) == 1 ? addVAT(null,default_other_month_price,mbsvat) : default_other_month_price;
            
//            if(use_other == "0"){
//                json_price.otherprice = {};
//            }
            
            if(card > 0 && cash > 0){
                other_payment_type.value = "4";                
            }else if(card > 0 && cash == 0){
                other_payment_type.value = "1";                
            }else if(card == 0 && cash > 0){
                other_payment_type.value = "2";                
            }
         
//           change_other_starttime();
           
           other_table_totalprice.style.display = other_payment_type.value ? "block" : "none";
           before_other_paymenttype = other_payment_type.value;
//            if(isinputchange == 311)checkotherPrice();
            
            clog("json_price.otherprice ",json_price.otherprice);
           
           checkCouponTitleColor();
        }
        function setOtherCoupon(json_othercoupon){
            if(!othercoupons)othercoupons = [];
            
            var isin = false;
            for(var i = 0 ; i < othercoupons.length; i++){
                if(othercoupons[i].couponidx == json_othercoupon.couponidx){
                    isin = true;
                    othercoupons[i] = json_othercoupon;
                }
            }
            if(!isin)othercoupons.push(json_othercoupon);
            
        }
        function reshowLockerPriceTable(){

            $(".class_table_locker").hide(100);
            setTimeout(function(){
                $(".class_table_locker").show(200);            
            },100);
        }
        function reshowOtherPriceTable(id){

            $("#"+id).hide(100);
            setTimeout(function(){
                $("#"+id).show(200);            
            },100);
        }
        function reshowTermPriceTable(){

            $(".class_table_term").hide(100);
            setTimeout(function(){
                $(".class_table_term").show(200);            
            },100);
        }
        function change_termcount(){
            var id_termcount = document.getElementById("id_termcount");
            
        }
        function add_bonusday() {
            var id_bonusday = document.getElementById("id_bonusday").value ? document.getElementById("id_bonusday").value : 0;
            for (var i = 0; i < mbs_coupons.length; i++) {
                if (mbs_coupons[i].mbs_idx == termtype_coupon) {
                    selected_mbs = mbs_coupons[i];
                    break;
                }
            }
            var input_term_novat_price = document.getElementById("input_term_novat_price");
            var mbs_price = parseCommaInt(input_term_novat_price.value); //기간제 가격
            var mbs_month = parseInt(selected_mbs.mbs_month); //기간제 달
            clog("mbs_month " + mbs_month);


            var termtype_starttime = document.getElementById("termtype_starttime");
            var termtype_endtime = document.getElementById("termtype_endtime");


            var nmonth = nextMonth(termtype_starttime.value, mbs_month);

            termtype_endtime.innerHTML = nmonth;

            var add_endday = nextDay(termtype_endtime.innerHTML, parseInt(id_bonusday));
            termtype_endtime.innerHTML = add_endday;
        }
        //        function termtype_date_change(){
        //            var termtype_starttime =  document.getElementById("termtype_starttime");
        //            var termtype_endtime =  document.getElementById("termtype_endtime");
        //            
        //        }
        
        function checkCouponTitleColor(){
            var couponlist_0 = document.getElementById("couponlist_0"); //회원권
            var couponlist_1 = document.getElementById("couponlist_1"); //라커
            var couponlist_2 = document.getElementById("couponlist_2"); //PT
            var couponlist_3 = document.getElementById("couponlist_3"); //PT
            
            var termtype_coupon = document.getElementById("termtype_coupon");
            var use_locker = document.getElementById("use_locker");
            var counttype_coupon = document.getElementById("counttype_coupon");
            
            couponlist_0.style.backgroundColor = termtype_coupon.value == "0" || termtype_coupon.value == ""  ? "white" : "#e0e9e9";
            couponlist_1.style.backgroundColor = use_locker.value == "0"  ||  use_locker.value == "" ? "white" : "#e0e9e9";
            couponlist_2.style.backgroundColor = counttype_coupon.value == "0" || counttype_coupon.value == "" ? "white" : "#e0e9e9";
            
            couponlist_3.style.backgroundColor = arr_other_coupon_idx.length == 0 ? "white" : "#e0e9e9";
            
            
            
        }
        function all_check_click() {
            if (all_check.checked) {
                clog("check!!");
                for (var i = 0; i < termsofservice_count; i++)
                    document.getElementById("id_terms_" + i).checked = true;
            } else {
                clog("notcheck");
                for (var i = 0; i < termsofservice_count; i++)
                    document.getElementById("id_terms_" + i).checked = false;
            }

        }

        function authClick() {
            var auth_group = document.getElementById('authlevel');
            clog("auth_group ", auth_group.value);
            if (auth_group.value != "") {
                saveData("joinauth", auth_group.value);
            }


            defaultUserCheck();


        }

        function defaultUserCheck() {
            var auth_group = document.getElementById('authlevel');
            var default_user_div = document.getElementById('default_user_div');
            var signdiv = document.getElementById('signdiv');
            var td_email1 = document.getElementById('td_email1');
            var td_email2 = document.getElementById('td_email2');
            var td_address1 = document.getElementById('td_address1');
            var td_address2 = document.getElementById('td_address2');
            
            //일반유저
            if (auth_group.value < 10) {

                default_user_div.style.display = "block";
                signdiv.style.display = "block";
                
                td_email1.style.display = "none";
                td_email2.style.display = "none";
                td_address1.colSpan = 2;
                td_address2.colSpan = 2;
            }
            //트레이너이상급
            else {
                default_user_div.style.display = "none";
                signdiv.style.display = "none";
                
                td_email1.style.display = "block";
                td_email2.style.display = "block";
                td_address1.colSpan = 1;
                td_address2.colSpan = 1;
            }
        }
        var selected_centername = "";
        function centerClick() {
            var centercode_group = document.getElementById('header_center_select');
            if (centercode_group.value != "") {
                setTermsOfService();


                clog("my_centercode " + my_centercode);
                setMembership(centercode_group.value);

                selected_centername = centercode_group.options[centercode_group.selectedIndex].text;
                document.getElementById("txt_centername").innerHTML = selected_centername;
               
                clog("savedata ", centercode_group.value);
                saveData("nowcentercode", centercode_group.value);
                saveData("nowcentername", selected_centername);
                
                 document.getElementById("id_title_logo").innerHTML = selected_centername+" 회원가입 신청서";
            }
        }

        function setMembership(centercode) {
            checkRegisteredUser(centercode);
            
            initVat(centercode);
            clog("setMembership");
            if (centercode == null) return;
            my_centercode = centercode;
            
            
            
            var _data = {
                "type": "membership", // group or center or auth
                "mbs_centercode": centercode
            };
            clog("centercode is " + centercode);
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {
                    if (res.message.length == 0) return;
                    mbs_coupons = res.message;
                    default_locker_month_price = parseInt(res.lockermonthprice);
                    default_locker_day_price = parseInt(res.lockerdayprice);
                    
                    //                    var id_ptgx_title = document.getElementById('id_ptgx_title');
                    //                    id_ptgx_title.innerHTML = mbs_coupons.length > 0 && mbs_coupons[0].mbs_user_centercode == "1001" ? "PT 횟수 (선택)" : "GX 횟수 (선택)";
                    //GX 부분은 작업하지 않음

                    var termtype_coupon = document.getElementById('termtype_coupon');
                    termtype_coupon.innerHTML = "";
                    termtype_coupon.innerHTML = "<option value='0'>기간제 운동목록을 선택하세요</option>";

                    var counttype_coupon = document.getElementById('counttype_coupon');
                    counttype_coupon.innerHTML = "";
                    counttype_coupon.innerHTML = "<option value='0'>P.T 선택안함</option>";
                    //                    for(var i = 1 ;i <= 50; i++){
                    //                        counttype_coupon.innerHTML += "<option value='"+i+"'>PT "+i+"회</option>";
                    //                    }
                    var select_other_coupon = document.getElementById("select_other_coupon");
                    select_other_coupon.innerHTML = "";
                    select_other_coupon.innerHTML = "<option value='0'>기타상품을 선택하세요</option>";

                    mbs_coupons.sort(sort_by('mbs_type', true, (a) => a.toUpperCase()));
                    //                                mbs_coupons.sort(sort_by('mbs_use_centercode', true, parseInt));
                    for (var i = 0; i < mbs_coupons.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = mbs_coupons[i]["mbs_idx"];
                        
                        //기타상품
                        if (mbs_coupons[i]["mbs_type"] == TYPE_OTHER) {
                             opt.innerHTML = mbs_coupons[i]["mbs_type"] + "  (" + mbs_coupons[i]["mbs_name"] + ") ￦" + CommaString(mbs_coupons[i]["mbs_price"]) + "";
                             select_other_coupon.appendChild(opt);
                        }else {
                            //기간제
                            if (parseInt(mbs_coupons[i]["mbs_iscounttype"]) == 0) {
                                opt.innerHTML = mbs_coupons[i]["mbs_type"] + "  (" + mbs_coupons[i]["mbs_name"] + ") ￦" + CommaString(mbs_coupons[i]["mbs_price"]) + "";
                                termtype_coupon.appendChild(opt);
                            } 
                            //횟수제
                            else {

                                opt.innerHTML = mbs_coupons[i]["mbs_type"] + "  (" + mbs_coupons[i]["mbs_name"] + ")";
                                counttype_coupon.appendChild(opt);
                            }    
                        }
                        

                    }
                    

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });

            //강사목록을 가져온다.
            setTeachers(centercode);
        }
        var constructor_name_option_tag = "";
        function setTeachers(centercode) {

            if (centercode == null) return;
            my_centercode = centercode;
            var _data = {
                "type": "teachers", // group or center or auth
                "mbs_centercode": centercode
            };
            clog("setTeachers centercode is " + centercode);
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {
                    if (res.message.length == 0) return;
                    teacherlist = res.message;
                    //                    var id_ptgx_title = document.getElementById('id_ptgx_title');
                    //                    id_ptgx_title.innerHTML = mbs_coupons.length > 0 && mbs_coupons[0].mbs_user_centercode == "1001" ? "PT 횟수 (선택)" : "GX 횟수 (선택)";
                    //GX 부분은 작업하지 않음

                    var teachers_list = document.getElementById('teachers_list');
                    teachers_list.innerHTML = "";
                    teachers_list.innerHTML = "<option value='0'>담당 트레이너를 선택하세요</option>";

                    for (var i = 0; i < res.message.length; i++) {
                        teachers_list.innerHTML += "<option value='" + res.message[i].mem_uid + "' >" + res.message[i].mem_username + " 트레이너</option>";
                    }
                    
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
        var onoffcount  = 0;
        var onoffInterval = null;
        function showOnOffRejoinAni(){
            onoffcount  = 0;
            var txt_rejoin_user = document.getElementById("txt_rejoin_user");
            if(onoffInterval){
                clearInterval(onoffInterval);
                onoffInterval = null;  
            } 
            txt_rejoin_user.style.display = "block";
            onoffInterval = setInterval(function(){
                if(onoffcount%2==1)
                    txt_rejoin_user.style.visibility="hidden";
                else 
                    txt_rejoin_user.style.visibility="visible";
                onoffcount++;
            },1000);
        }
        function hideOnOffRejoinAni(){
            onoffcount  = 0;
            var txt_rejoin_user = document.getElementById("txt_rejoin_user");
            if(onoffInterval){
                clearInterval(onoffInterval);
                onoffInterval = null;  
            } 
            txt_rejoin_user.style.display = "none";
        }
        function setTermsOfService() {
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.type = "termsofservice";
            obj.centercode = document.getElementById('header_center_select').value;

            CallHandler("terms", obj, function(res) {
                var code = parseInt(res.code);
               
                if (code == 100) {
                    res = decodeTerms(res);
                     console.log("aares",res);
                    var container = document.getElementById("terms_container");
                    container.innerHTML = "";
                    var br0 = document.createElement('br');
                    container.appendChild(br0);
                    termsofservice_count = res.message.length;
                    termsdatas = res.message;
                    for (var i = 0; i < res.message.length; i++) {
                        var terms_title = i == 0 ? "BG Tech 이용약관" : selected_centername;
                        var starttag  = "<text class='textevent' style='font-size:15px'>"+terms_title+"</text><div style='margin-top:10px;color:#5e6278'><div style='width:100%; height:300px; overflow:auto; line-height:18px; background-color: #f5f8fa;padding:3%;border-radius:10px; margin:0 auto'>";
                        var endtag = "</div></div>";
                        var div = document.createElement('div');
                        div.innerHTML = starttag+replacePTSignTag("terms"+i, res.message[i])+endtag;
                        
//                        div.innerHTML += "<br><input type='button' onclick='click_terms_detail(" + i + ")' style='position:absolute;width:125px;font-size:14px;color:white;font-weight:500;padding:10px;border:0px;border-radius:8px;padding:7px 10px 7px 10px;background-color:#33a186' class='btn-raised' name='약관 자세히보기' value='약관 자세히보기'/><p align='right'><input id='id_terms_" + i + "' type='checkbox'>&nbsp;&nbsp;<text class='textevent'>이용약관확인</text><p>";
                        
                         div.innerHTML += "<br><div style='margin-bottom:20px'><input type='button' onclick='click_terms_detail(" + i + ")' style='position:absolute;width:125px;font-size:14px;color:white;font-weight:500;padding:10px;border:0px;border-radius:8px;padding:7px 10px 7px 10px;background-color:#33a186' class='btn-raised' name='약관 자세히보기' value='약관 자세히보기'/>"+
                             myCheckBoxTag("이용약관확인","id_terms_"+i  )+
                                
                            "</div>";
                        
                        //                                div.style.backgroundColor = "gray";
                        div.onclick = function() {

                            var check_cnt = 0;
                            for (var i = 0; i < termsofservice_count; i++) {
                                var check = document.getElementById("id_terms_" + i);
                                if (check.checked) check_cnt++;
                            }
                            all_check.checked = check_cnt >= termsofservice_count ? true : false;

                        }
                        container.appendChild(div);

                        var br = document.createElement('br');

                        container.appendChild(br);

                    }
                    var mainuse_container_title = document.getElementById("mainuse_container_title");
                    var mainuse_container = document.getElementById("mainuse_container");
                    var mainuserule = replacePTSignTag("mainuserule",res.mainuserule[0]);
                   
                    if(mainuserule){
                        mainuse_container_title.style.display = "block";
                        mainuse_container.innerHTML = mainuserule;
//                        mainuse_container.innerHTML += "<br>";
                    }

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
            
            
            
        }
        
        function getPTRule(obj){
            CallHandler("getptrule",obj,function(res){
                var code = parseInt(res.code);
                if (code == 100) {
                    console.log("getptrule res ",res);
                    ptruledata = res.message;
                }else{
                     alertMsg(res.message);
                }
            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
        }
        function click_terms_detail(idx) {
            //                    clog("============================");
            termsdatas[idx] = termsdatas[idx].replace("height:300px;", "height:100%;");
            //                    clog(termsdatas[idx]);
            
            //검정배경테마
//            var style = {
//                bodycolor: "#bbbbbb",
//                size: {
//                    width: "100%",
//                    height: "100%"
//                }
//            };
//            var style = {
//                 modaltype:"large",
//                 marginTop:"0px",
////                 bodycolor:"#ffffff",
//                 size:{
//                     width:"95%",
//                     height:"auto"
//                 },
//                 top:{
//                     color:"#ffffff",
//                     textAlign:"left",
//                     paddingLeft:"25px",
//                     borderBottom: "1px solid #666666"
//                 },
//                 bottom:{
//                     textAlign:"right",
//                     paddingRight:"25px",
//                     borderTop: "1px solid #666666",
//
//
//                 },
//                 //커스텀 버튼
//                 button_width: "100px",
//                 button_height: "43px",
//                 button_color : "white",
//                 button_bgcolor : "#31b0f8"
//
//
//            };
            
            //흰색배경테마
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
            var str_terms = "<div style='padding:20px'><div align='left' style='background-color:#f5f8fa;height:auto;margin-top:15px;text-align:left;width:100%;padding:30px;border:1px solid #e9e9e9;border-radius:10px;font-size:14px;font-weight:500;box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.25);'>" + termsdatas[idx] + "</div></div>";
            
            showModalDialog(document.body, "회원약관", str_terms, "확인", null, function() {
                hideModalDialog();
            }, function() {}, style);

        }

        function clear_sign(type) {
            clog("clear sign!!");
            if (type == 1)
                signaturePadName.clear();
            else
                signaturePadSign.clear();

        }

        function formclick() {
            clog("aaa");
        }
        //        $("#join-us").submit(function(event) {
        function btn_register(){
            
            var style = {
                bodycolor: "white",
                 marginTop:"0px",
                size: {
                    width: "100%",
                    height: "auto"
                }
            };
            var authlevel = parseInt(document.getElementById('authlevel').value);
            if(authlevel < 10){
                
                if(document.getElementById("payment_type").value == ""){
                    alertMsg("회원권 결제방법을 선택해 주세요");
                    return;
                }
                if(json_price.lockerprice && document.getElementById("locker_payment_type").value == ""){
                    alertMsg("라커 결제방법을 선택해 주세요");
                    return;
                }                    
           
            

            var tag = getResultPriceTag();
            
            var btn_text = reregist == 1 ? "재가입" : "회원가입";
                
            var title_tag = "<label style='color:#181c32'>"+tag.title+"</label>";
            showModalDialog(document.body, title_tag,  "<label style='font-size:16px;font-weight:600;color:#181c32'>이용약관을 숙지하였으며 위 내용대로 "+btn_text+"하시겠습니까?</label><br><br>"+tag.message, btn_text+"하기", "취소", function() {
                    hideModalDialog();
                    btn_register_send();
                }, function() {
                    hideModalDialog();
                }, style);
            }else{
                btn_register_send();
            } 
        }
        function getResultPriceTag(){
             var name = spaceRemove(document.getElementById('name').value);
             var center = document.getElementById('header_center_select');
            var centercode = center.value;
            var centername = center.options[center.selectedIndex].text;
            var title_tag = reregist == 1 ? "<span style='color:#262930'>[재가입]"+name+"</span> 고객번호 : " + re_obj.id : centername;
            console.log("json_price ",json_price);
            
            var other_coupons_tag = othercoupons.length > 0 ? "<br><div style='margin-left:15px;margin-right:15px;'>"+
                    "<div style='width:100%;height:"+(othercoupons.length*40+20)+";border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);padding:10px 20px 20px 20px'>" : "";
            
            //기타상품 총금액
            var other_total_card = 0;
            var other_total_cash = 0;
            for(var i = 0 ; i < othercoupons.length;i++){
                 other_coupons_tag += "<label style='color:#262930;float:left;margin-top:10px;font-size:15px'><span style='font-weight:bold'>"+othercoupons[i].couponname+"</span>   (카드 : "+CommaString(othercoupons[i].couponprice.card)+" + 현금 : "+CommaString(othercoupons[i].couponprice.cash)+")</label><label style='float:right;margin-top:10px;font-size:15px;font-weight:bold;color:#262930;margin-right:10px'>결제금액 : <span style='color:#009ef7'>￦"+CommaString(othercoupons[i].couponprice.total_remain)+" </label><br>";
                other_total_card += parseInt(othercoupons[i].couponprice.card);
                other_total_cash += parseInt(othercoupons[i].couponprice.cash);
                
            }
            other_coupons_tag += othercoupons.length > 0 ? "</div></div>" : "";
            
            var locker_tag = json_price.lockerprice ? "<br>"+
                "<div style='margin-left:15px;margin-right:15px;'>"+
                    "<div style='width:100%;height:160px;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)'>"+
                        "<div style='height:auto;background-color:#f5f8fa;border-radius:15px 15px 0px 0px;'>"+
                            "<label class='textevent' style='float:left;margin-left:20px;'>라커 총금액  ￦"+CommaString(json_price.lockerprice.total)+"</label>"+
                        "</div>"+
                        "<div style='width:100%;height:1px;border:1px solid #eff2f5;'>"+
                            "<table style='width:100%;text-align:center;color:#262930' >"+
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
//                                        "<label class='textevent' >총금액</label><br>"+
                                    "</td>"+
                                    "<td style='width:100%'>"+
                                        "<label class='textevent'>결제금액</label><br>"+
                                    "</td>"+
                                 "</tr>"+
                                 "<tr>"+
                                     "<td colspan='5' style='border-bottom:1px solid #eff2f5;'></td>"+
                                 "</tr>"+
                                 "<tr>"+

                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;font-size:15px'>"+CommaString(json_price.lockerprice.card)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;font-size:15px'>"+CommaString(json_price.lockerprice.cash)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;color:red;font-size:15px'>-"+CommaString(json_price.lockerprice.remain)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
//                                        "<label style='margin-top:10px;font-size:15px'>"+CommaString(json_price.lockerprice.total)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:100%'>"+
                                        "<label style='margin-top:10px;color:#009ef7;font-weight:bold;font-size:15px'>￦"+CommaString(json_price.lockerprice.total_remain)+"</label>"+
                                    "</td>"+
                                 "</tr>"+
                            "</table>"+
                        "</div>"+
                    "</div>"+
                "</div>" : "";
            var pt_price_tag = pt_join_data && pt_join_data.pt_remainprice ? 
                "<br>"+
                "<div style='margin-left:15px;margin-right:15px;'>"+
                    "<div style='width:100%;height:160px;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)'>"+
                        "<div style='height:auto;background-color:#f5f8fa;border-radius:15px 15px 0px 0px;'>"+
                            "<label class='textevent' style='float:left;margin-left:20px;'>PT 총금액  ￦"+CommaString(pt_join_data.pt_remainprice.total)+"</label>"+
                        "</div>"+
                        "<div style='width:100%;height:1px;border:1px solid #eff2f5;'>"+
                            "<table style='width:100%;text-align:center;color:#262930' >"+
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
                                        "<label class='textevent' style='color:#009ef7'>할인</label><br>"+
                                    "</td>"+
                                        "<td style='width:100%'>"+
                                        "<label class='textevent'>결제금액</label><br>"+
                                    "</td>"+
                                 "</tr>"+
                                 "<tr>"+
                                     "<td colspan='5' style='border-bottom:1px solid #eff2f5;'></td>"+
                                 "</tr>"+
                                 "<tr>"+

                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;font-size:15px'>"+CommaString(pt_join_data.pt_remainprice.card)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;font-size:15px'>"+CommaString(pt_join_data.pt_remainprice.cash)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;color:red;font-size:15px'>-"+CommaString(pt_join_data.pt_remainprice.remain)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                        "<label style='margin-top:10px;font-size:15px;color:#f4436d'>"+CommaString(pt_join_data.pt_remainprice.discount)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:100%'>"+
                                        "<label style='margin-top:10px;color:#009ef7;font-weight:bold;font-size:15px'>￦"+CommaString(pt_join_data.pt_remainprice.total_remain)+"</label>"+
                                    "</td>"+
                                 "</tr>"+
                            "</table>"+
                        "</div>"+
                    "</div>"+
                "</div>" : "";


            var result_card = pt_join_data && pt_join_data.pt_remainprice ? pt_join_data.pt_remainprice.card + json_price.card : json_price.card;
            if(json_price.lockerprice)result_card += json_price.lockerprice.card;
            result_card += other_total_card;
            
            var result_cash = pt_join_data && pt_join_data.pt_remainprice ? pt_join_data.pt_remainprice.cash + json_price.cash : json_price.cash;
            if(json_price.lockerprice)result_cash += json_price.lockerprice.cash;
            result_cash += other_total_cash;
            
            
            var result_total = result_card + result_cash;

            var total_tag = 
             "<br><div style='margin-left:15px;margin-right:15px;'>"+
                    "<div style='width:100%;height:55px;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)'>"+
                        "<div align='right' style='height:auto;border-radius:15px;padding:10px'>"+
                            "<label class='textevent' style='float:left;margin-left:10px;margin-top:-15px'>카드:<span style='color:#009ef7'>￦"+CommaString(result_card)+"</span>&nbsp;&nbsp;+&nbsp;&nbsp;현금:<span style='color:#009ef7'>￦"+CommaString(result_cash)+"</span></label><label class='textevent' style='float:right;margin-right:10px;margin-top:-15px'>총결제금액:<span style='color:#009ef7'>￦"+CommaString(result_total)+"</span></label>"+
                        "</div>"+
                    "</div>"+
            "</div><br>";
            var message_tag = authlevel > 10 ? "" : 

                "<div style='margin-left:15px;margin-right:15px;'>"+
                    "<div style='width:100%;height:160px;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)'>"+
                        "<div style='height:auto;background-color:#f5f8fa;border-radius:15px 15px 0px 0px;'>"+
                            "<label class='textevent' style='float:left;margin-left:20px;'>회원권 총금액  ￦"+CommaString(json_price.total)+"</label>"+
                        "</div>"+
                        "<div style='width:100%;height:1px;border:1px solid #eff2f5;'>"+
                            "<table style='width:100%;text-align:center;color:#262930' >"+
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
                                        "<label class='textevent' style='color:#009ef7'>할인</label><br>"+
                                    "</td>"+
                                        "<td style='width:100%'>"+
                                        "<label class='textevent'>결제금액</label><br>"+
                                    "</td>"+
                                 "</tr>"+
                                 "<tr>"+
                                     "<td colspan='5' style='border-bottom:1px solid #eff2f5;'></td>"+
                                 "</tr>"+
                                 "<tr>"+

                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;font-size:15px'>"+CommaString(json_price.card)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;font-size:15px'>"+CommaString(json_price.cash)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                       "<label style='margin-top:10px;color:red;font-size:15px'>-"+CommaString(json_price.remain)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:80px'>"+
                                        "<label style='margin-top:10px;font-size:15px;color:#f4436d'>"+CommaString(json_price.discount)+"</label>"+
                                    "</td>"+
                                    "<td style='min-width:100%'>"+
                                        "<label style='margin-top:10px;color:#009ef7;font-weight:bold;font-size:15px'>￦"+CommaString(json_price.total_remain)+"</label>"+
                                    "</td>"+
                                 "</tr>"+
                            "</table>"+
                        "</div>"+
                    "</div>"+
                "</div>"+ pt_price_tag+locker_tag+other_coupons_tag+total_tag;
            return {"title":title_tag,"message":message_tag};
        }
        function btn_register_send() {

            //         var name = $("#join-us input[name=name]").val();
            var authlevel = parseInt(document.getElementById('authlevel').value);
            var center = document.getElementById('header_center_select');
            var centercode = center.value;
            var centername = center.options[center.selectedIndex].text;

            var name = spaceRemove(document.getElementById('name').value);
            var yy = document.getElementById('yy').value;
            var mm = document.getElementById('mm').value < 10 ? "0" + document.getElementById('mm').value : document.getElementById('mm').value;
            var dd = document.getElementById('dd').value < 10 ? "0" + document.getElementById('dd').value : document.getElementById('dd').value;
            var birth = yy + mm + dd + "";

            var email = spaceRemove(document.getElementById('email').value);
            var phone = document.getElementById('phone').value;
            var gender_m = document.getElementById('gender_m');
            var gender_f = document.getElementById('gender_f');
            var gender = gender_m.checked ? "M" : "F";
            var home_address = document.getElementById('home_address').value;
            var counttype_coupon = document.getElementById('counttype_coupon');
            var counttype_coupon_value = counttype_coupon.value;

            var traner_am = document.getElementById('traner_am');
            var traner_pm = document.getElementById('traner_pm');
            var traner_no = document.getElementById('traner_no');
            var traner_ampm = "NO";
            if(traner_am.checked)traner_ampm = "AM" 
            else if(traner_pm.checked)traner_ampm = "PM";
            

            var counttype_coupon_price = 0;
            var counttype_teacher = null;
            var counttype_teacherid = "";
            var counttype_teachername = "";
            if (counttype_coupon_value > 0) {
                counttype_coupon_price = document.getElementById('counttype_coupon_price').value ? parseCommaInt(document.getElementById('counttype_coupon_price').value) : 0;
                counttype_teacher = document.getElementById("teachers_list");
                counttype_teacherid = counttype_teacher.value != "" && counttype_teacher.value != "0" ? counttype_teacher.value : "";
                counttype_teachername = counttype_teacher.value != "" && counttype_teacher.value != "0" ? counttype_teacher.options[counttype_teacher.selectedIndex].text : "";
            }

            
            var termtype_coupon = document.getElementById('termtype_coupon').value;
            var use_locker = document.getElementById('use_locker').value;
            var id_locker_number = document.getElementById('id_locker_number').innerHTML;
            var id_locker_pass = document.getElementById('id_locker_pass').value;
            var id_locker_month = document.getElementById('id_locker_month').value;
            var id_privacy_policy = document.getElementById('id_privacy_policy').checked;
            var id_privacy_policy2 = document.getElementById('id_privacy_policy2').checked;
            var payment_type = document.getElementById('payment_type').value;
            var termtype_starttime = document.getElementById('termtype_starttime').value ? document.getElementById('termtype_starttime').value + " 00:00:00" : null;
            var termtype_endtime = document.getElementById('termtype_endtime').innerHTML + " 23:59:59";
            var id_termcount_value = parseInt(document.getElementById("id_termcount").value);

            
            
            var locker_starttime = document.getElementById('locker_starttime').value ? document.getElementById('locker_starttime').value + " 00:00:00" : "";
            var locker_endtime = document.getElementById('locker_endtime').value ? document.getElementById('locker_endtime').value + " 23:59:59" : "";            
            var locker_payment_type = document.getElementById('locker_payment_type').value ? document.getElementById('locker_payment_type').value : "";
            
            
            //                    var id_terms = document.getElementById('id_terms').checked;
            var clist = document.getElementsByClassName("checkboxgroup");
            var edittext_other = document.getElementById('edittext_other').value;
            var signdatas = [];
            var signdataname = signaturePadName.toDataURL('image/png');
            var signdatasign = signaturePadSign.toDataURL('image/png');
            
            var signed_count = {};
            var pt_term_sign = {};

            console.log("sign_count ",sign_count);
            for(key in sign_count){
                for(var i = 0 ; i < sign_count[key].length;i++){
                    //var sign_rule_img = document.getElementById("sign_rule_img_"+key+"_"+i);
                    var sign_rule_img = sign_count[key][i];
                   
                    if(sign_rule_img){
                        if(!pt_term_sign[""+key])pt_term_sign[""+key] = [];
                        pt_term_sign[""+key].push(sign_rule_img);
                        if(!signed_count[""+key])signed_count[""+key] = 0;
                        if(sign_rule_img.indexOf("data:image") >= 0)signed_count[""+key]++;    
                    }    
                }
                
            }


            var id_other_input = document.getElementById('id_other_input').value;

            var id_price_remain = document.getElementById("id_price_remain");
            var id_price_card = document.getElementById("id_price_card");
            var id_price_cash = document.getElementById("id_price_cash");
            
            if(parseInt(id_price_card.value) < 0){
                alertMsg("카드금액이 잘못되었습니다. 0원이상으로 설정해 주세요");
                return;
            }
            else if(parseInt(id_price_cash.value) < 0){
                alertMsg("현금이 잘못되었습니다. 0원이상으로 설정해 주세요");
                return;
            }
            else if(parseInt(id_price_remain.value) < 0){
                alertMsg("미수금이 잘못되었습니다. 0원이상으로 설정해 주세요");
                return;
            }


            if (!authlevel || yy == "년도" || mm == "월" || dd == "일" || !all_check.checked || !id_privacy_policy || !id_privacy_policy2 || !name || !email || !phone || !home_address || termtype_coupon == "0" && counttype_coupon == "0" || id_termcount_value < 0 || !payment_type || signaturePadName.isEmpty() || signaturePadSign.isEmpty()) {

                if(!authlevel){
                    alertMsg("회원등급을 선택해 주세요");
                    return;
                }
                if (!name) {
                    alertMsg("이름을 입력해 주세요");
                    return;
                } else if (yy == "" || mm == "월" || dd == "일") {
                    alertMsg("생년월일을 제대로 입력해주세요.");
                    return;
                } else if (authlevel >= 10 && !email) {
                    alertMsg("이메일을 입력해 주세요");
                    return;
                } else if (!phone) {
                    alertMsg("전화번호를 입력해 주세요");
                    return;
                } 
                //                else if(!home_address){
                //                    alertMsg("주소를 입력해 주세요");
                //                    return;
                //                }                    
                else if (authlevel < 10) {
//                    if (termtype_coupon == "0") {
//                        alertMsg("기간제 쿠폰을 선택해 주세요");
//                        return;
//                    }
//                    else 
                    if(termtype_coupon == "0"){
                        alertMsg("회원권을 선택하여주세요");
                        return;
                    }
                    else if (termtype_coupon == "0" && counttype_coupon_value == "0") {
                        alertMsg("기간제 혹은 횟수제 중 1개 이상의 쿠폰을 선택해 주세요");
                        return;
                    } 
                    else if(id_termcount_value < 0){
                        alertMsg("기간제 횟수는 0회이상으로 입력해주세요.");
                        return;
                    }
                    else if (!payment_type) {
                        alertMsg("결제방법을 선택해 주세요");
                        return;
                    } else if (!all_check.checked) {
                        alertMsg("이용약관을 확인 후 체크해주세요.");
                        return;
                    } else if (!id_privacy_policy) {
                        alertMsg("개인정보 수집 및 이용에 동의해 주세요");
                        return;
                    } else if (!id_privacy_policy2) {
                        alertMsg("주요 이용규정 및 환불규정 이용에 동의해 주세요");
                        return;
                    } else if (signaturePadName.isEmpty()) {
                        alertMsg("자필 이름입력이 필요합니다.");
                        return;
                    } else if (signaturePadSign.isEmpty()) {
                        alertMsg("서명이 필요합니다.");
                        return;
                    }
                }
            }
            if (phone.length < 11) {
                alertMsg("전화번호는 - 없이 11자리를 입력해 주세요.");
                return;
            }
            
            if(use_locker == "1" && id_locker_month == "0"){
                alertMsg("라커 개월수를 입력해 주세요");
                return;
            }
            
            if (authlevel < 10)
            for(key in sign_count){
                var pt_coupon = document.getElementById('counttype_coupon');
                var pt_txt = pt_coupon.options[pt_coupon.selectedIndex].text;
                if(key != "ptrule"  || key == "ptrule" && pt_coupon.value != "0" && pt_txt.indexOf(ID_FREE) < 0)
                if(signed_count[""+key] != undefined && signed_count[""+key] < sign_count[""+key].length){
                    alertMsg("규정에 서명하지 않은 부분이 있습니다.");
                    return;
                }
            }
//            if (parseInt(counttype_coupon) > 0 && counttype_teacherid == "0") {
//                alertMsg("트레이너를 선택해 주세요.");
//                return;
//            } 
//            else if (counttype_coupon == '0') {
//                counttype_teacherid = "";
//                counttype_teachername = "";
//            }
//            counttype_teacherid = "";
//            counttype_teachername = "";

            var vat = parseInt(payment_type) == 1 ? (100+global_vat)/100 : 1; //카드결제일때만 부가세 10%  //neel_vat
            var locker_price = null;
            var locker_month = 0;
            var mbs_price = 0;
            //트레이너 이상급이라면 
            if (authlevel >= 10) {
                json_price.termtypeprice = 0;
                json_price.counttypeprice = 0;
                json_price.lockerprice = 0;
                json_price.totalprice = 0;
//                json_price.remain_price = "";
                json_price.discountprice = 0;
                termtype_endtime = nextYear(termtype_endtime, 10);
                payment_type = "0";
                termtype_coupon = 1; //센터직원이다.
                locker_price = null;
                
                
                if(!isuse_email){
                    alertMsg("이메일이 중복되거나 형식에 맞지 않습니다. 이메일을 다시 입력해 주세요");
                    return;
                }
            } else {
                for (var i = 0; i < mbs_coupons.length; i++) {
                    if (mbs_coupons[i].mbs_idx == termtype_coupon) {
                        selected_mbs = mbs_coupons[i];
                        break;
                    }
                }

                var input_term_novat_price = document.getElementById("input_term_novat_price");
                if(selected_mbs)mbs_price = Math.floor(parseCommaInt(input_term_novat_price.value)*vat); //기간제 가격

                total_price = mbs_price; //기간제 가격
//                total_price += parseInt(counttype_coupon_price) ? parseInt(counttype_coupon_price) : 0;


                var locker_month = document.getElementById("id_locker_month").value ? parseInt(document.getElementById("id_locker_month").value) : 0;
                var locker_servicemonth =  document.getElementById("id_locker_servicemonth").value ? parseInt(document.getElementById("id_locker_servicemonth").value) : 0;
           
                //라커사용안함
                if (use_locker == 0) {
                    id_locker_number = "";
                    id_locker_pass = "";
                    locker_servicemonth = 0;

                } else {
                    //라커 1달 가격
                    var monthprice = alllocker ? Math.floor(parseCommaInt(alllocker[0].monthprice)*vat) : 10000;
                    var serviceprice = json_price.serviceprice;
                    total_price += parseCommaInt(selected_mbs.mbs_month) * monthprice-serviceprice;
                    var price_month = parseCommaInt(selected_mbs.mbs_month)-parseCommaInt(locker_servicemonth);
                    if(locker_price == null)
                        locker_price = json_price.lockerprice;
                    
                    locker_desc = !json_price.lockerprice ? "" : "라커 "+selected_mbs.mbs_month+"개월 ￦"+CommaString(json_price.lockerprice.totalprice)+"";
                }




            }
            

            
            
            
            if(selected_mbs)termtype_desc = selected_mbs.mbs_name +" ￦"+CommaString(mbs_price)+"";
            counttype_desc = counttype_coupon.selectedIndex == 0 || counttype_coupon.selectedIndex == -1 ? "" : "P.T "+pt_join_data.pt_count+"회 ￦"+CommaString(json_price.counttypeprice)+"";

            clog("name is ", name);
            clog("yy is ", yy);
            clog("mm is ", mm);
            clog("dd is ", dd);
            clog("email is ", email);
            clog("phone is ", phone);
            clog("gender is ", gender);
            clog("home_address is ", home_address);
            clog("counttype_coupon is ", counttype_coupon_value);
            clog("termtype_coupon is ", termtype_coupon);
            clog("use_locker is ", use_locker);
            clog("id_locker_number is ", use_locker);
            clog("id_locker_pass is ", use_locker);
            for (var i = 0; i < clist.length; ++i)
                clog(i + ")clist check is  " + clist[i].value);
            clog("edittext_other is ", edittext_other);
            //            clog("signdata is ", signdata);


            var list = [];
            for (var i = 0; i < clist.length; ++i) {
                if (clist[i].checked) {
                    if (clist[i].value == "기타") {
                        list.push(edittext_other);
                    } else
                        list.push(clist[i].value);
                }
            }

            var useruid = re_obj.uid ? re_obj.uid : "";
            
            var payment_date_value = document.getElementById("id_payment_date").value;
            var _data = {
                "paymentdate":payment_date_value,
                "useruid":useruid,
                "reregist":reregist,
                "auth": authlevel + "",
                "groupcode":groupcode,
                "centercode": centercode + "",
                "centername": centername,
                "name": name + "",
                "birth": birth + "",
                "email": email + "",
                "phone": phone + "",
                "gender": gender + "",
                "homeaddress": home_address + "",
                "counttypecoupon": counttype_coupon_value + "", //횟수제 횟수
                "counttypeteacherid": counttype_teacherid + "", //선택한 강사 uid
                "counttypeteachername": counttype_teachername + "", //선택한 강사 uid
                "counttypeampm":traner_ampm + "", //강사 오전 오후 선택 
                "termtypecoupon": termtype_coupon + "",
                "uselocker": use_locker + "",
                "lockernumber": id_locker_number + "",
                "lockerpass": id_locker_pass + "",
                "lockermonth" : locker_month+"",
                "lockerservicemonth" : locker_servicemonth+"",
                "lockerstarttime" : locker_starttime,
                "lockerendtime" : locker_endtime,
                "lockerpaymenttype" : locker_payment_type,
                "mbsprice": mbs_price, //기간제 가격
                "mbsmaxcount":id_termcount_value,
                "counttypecouponprice": counttype_coupon_price, //횟수제 가격
                "termtypedesc":termtype_desc,
                "counttypedesc":counttype_desc,
                "lockerdesc":locker_desc,
                "lockerprice": locker_price, //라커 가격
                "totalprice": total_price,
                "clist": list + "",
                "paymenttype": payment_type,
                "signdata": {
                    "name": signdataname + "",
                    "sign": signdatasign + "",
                    "pt_term_sign" : pt_term_sign
                },
                "jsonprice" : json_price,
                "other": id_other_input,
                "termtypestarttime": termtype_starttime,
                "termtypeendtime": termtype_endtime,
                "ptjoindata":pt_join_data,
                "othercoupons":othercoupons
            };
            

            clog("join data ",_data);
//            if(true)return;
            CallHandler("register", _data, function(res) {
                console.log("res ",res);
                code = parseInt(res.code);
                if (code == 100) {
                    clog("json_price ",json_price);
                    registerid = res.message["id"]; //고객번호
                    is_firstuser = parseInt(res.message["isfirst"]); //최초회원인지
                    
                     
                    
                    var title = document.getElementById("result_title");
                    var div_title_price = document.getElementById("div_total_price");
                    var span_qrcode_icon = document.getElementById("span_qrcode_icon");
                    span_qrcode_icon.innerHTML = "<i class='fa-solid fa-qrcode' onclick='showDownloadQRCode()' style='color:white;font-size:20px;padding:10px;border-radius:5px;background-color:009ef7;border:0px' title='안드로이드, IOS 앱 다운로드 QR코드를 보여줍니다.'/>";

                    title.innerHTML = "<span style='color:#262930'>"+name+"</span> 고객번호 : " + registerid;

                    var ptag = getResultPriceTag();
                    div_title_price.innerHTML = ptag.message;
                    
                   
                    
                    
                    $("#myModal").modal({
                        keyboard: false,
                        backdrop: 'static'
                    });


                    //태블릿에서 SMS 메세지를 고객에게 보낸다. 
                    //추후에 앱스토어 주소로 이동한다. 
                    //var sms_message = centername+" 고객번호:"+registerid+" , http://bodypass.co.kr/dev/black/download/blackgym.apk";
//                    var sms_message1 = centername + " 회원가입 고객번호는 " + registerid + " 입니다.";
//                    var sms_message2 = "안드로이드 : https://play.google.com/store/apps/details?id=com.blackcompany.blackproject";
//                    var sms_message3 = "아이폰 : https://apps.apple.com/us/app/블랙짐/id1568060103";
//                    if (window.android) {
//                        window.android.sendSMS(phone, sms_message1);
//                        window.android.sendSMS(phone, sms_message2);
//                        window.android.sendSMS(phone, sms_message3);
//                    }
                    
                    //트레이너라면
                    if(authlevel >= 10){
                        div_title_price.innerHTML = "<label style='margin-left:30px;font-size:16px;font-weight:bold;'>회원가입 완료!! </label><br><label style='margin-left:30px;font-size:16px;font-weight:bold;'>로그인 Email : "+email+"</label>";
                    }
                    
                    join_userinfo = res.message.info; 
                    listen_register();

                }
                //재가입 성공
                else if(code == 20){
                    
                    registerid = res.message["id"]; //고객번호
                    is_firstuser = parseInt(res.message["isfirst"]); //최초회원인지
                    
                    
                    var title = document.getElementById("result_title");
                    var div_title_price = document.getElementById("div_total_price");
                    var span_qrcode_icon = document.getElementById("span_qrcode_icon");
                    span_qrcode_icon.innerHTML = "<i class='fa-solid fa-qrcode' onclick='showDownloadQRCode()' style='color:white;font-size:20px;padding:10px;border-radius:5px;background-color:009ef7;border:0px' title='안드로이드, IOS 앱 다운로드 QR코드를 보여줍니다.'/>";

                    title.innerHTML ="<span style='color:#262930'>"+name+"</span> 고객번호 : " + registerid;

                    var ptag = getResultPriceTag();
                    div_title_price.innerHTML = ptag.message;
                    
                   
                    $("#myModal").modal({
                        keyboard: false,
                        backdrop: 'static'
                    });
                    
                    join_userinfo = res.message.info;       
                    var btn_finish = document.getElementById("btn_finish").style.display = "block";
                    change_registerbutton();          

                    
                    
                    
//                    showModalDialog(document.body, title, message, "확인", null, function() {
//                         hideModalDialog();          
//                         hideModalDialog();          
//                         join_userinfo = res.message.info;            
//                         change_registerbutton();
//                        
//                    }, function() {});
                    
                }
                else if(code == -15){
                    showModalDialog(document.body, "경고", res.message, "확인", null, function() {
                        go_home();
                        hideModalDialog();
                        
                    }, function() {});
                } else {
                    //
                     alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });

        }
        function showDownloadQRCode(){
            var div_modal_qrcode = document.getElementById("div_modal_qrcode");
            if(div_modal_qrcode.style.display == "none"){
                div_modal_qrcode.style.display = "block";
            }else {
                div_modal_qrcode.style.display = "none";
            }
        }
        function listen_register(){
            if(listenInterval != null)listenInterval = null;
            var cnt = 0;
            var txts = ["고객승인 대기중.","고객승인 대기중..","고객승인 대기중...","고객승인 대기중....",]
//            listenInterval = setInterval(function(){
//                if(cnt%4 == 0)check_register();                    
//                document.getElementById("id_label_checking").innerHTML = txts[cnt%4];
//                cnt++;
//            },500);
            
            check_register();  
            
        }
        function go_home() {
//            $("#end_modal").modal("hide");

            if (param_pagetype && param_pagetype == "adm")
                gotoadmin();
            else
                gotohome();

        }
       
        function cancel_register() {
            var obj = new Object();
            obj.code = registerid;
            obj.name = document.getElementById('name').value;
            obj.phone = document.getElementById('phone').value;

            
            if(listenInterval)clearInterval(listenInterval);
            
            CallHandler("cancel_register", obj, function(res) {
                var code = parseInt(res.code);
                if (code == 100) {
                    document.getElementById("div_total_price").innerHTML = "";
                    $("#myModal").modal("hide");

                } else {
                    alertMsg(res.message);
                    $("#myModal").modal("hide");
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
                $("#myModal").modal("hide");

            });
        }
        var join_userinfo = null;
        function check_register(callback) {
            
            //test
//            document.getElementById("btn_finish").style.display = "block";
            
            var center = document.getElementById('header_center_select');
            var centercode = center.value;
            var centername = center.options[center.selectedIndex].text;
//            clog("check_register!!");
            var authlevel = parseInt(document.getElementById('authlevel').value);

            var termtype_coupon = document.getElementById('termtype_coupon');
            var counttype_coupon = document.getElementById('counttype_coupon');
            var counttype_coupon_price = document.getElementById('counttype_coupon_price').value ? parseCommaInt(document.getElementById('counttype_coupon_price').value) : 0;

            var use_locker = document.getElementById('use_locker').value;
            var id_locker_number = document.getElementById('id_locker_number').innerHTML;
            var id_locker_pass = document.getElementById('id_locker_pass').value;

            var locker_starttime = document.getElementById('locker_starttime').value ? document.getElementById('locker_starttime').value + " 00:00:00" : "";
            var locker_endtime = document.getElementById('locker_endtime').value ? document.getElementById('locker_endtime').value + " 23:59:59" : "";            
            var locker_payment_type = document.getElementById('locker_payment_type').value ? document.getElementById('locker_payment_type').value : "";
          
            
            
            var termtext = "";
            if(authlevel < 10  && termtype_coupon.selectedIndex != 0 )termtext = termtype_coupon.options[termtype_coupon.selectedIndex].text;
            var counttext = "";
            if(authlevel < 10  && counttype_coupon.selectedIndex != 0 ) counttext = counttype_coupon.options[counttype_coupon.selectedIndex].text;
            var desc = authlevel < 10 ? termtext + " + " + counttext + " ￦" + CommaString(counttype_coupon_price) + "" : "";
            //var nowcentercode = getData("nowcentercode");
            var counttype_coupon_value = document.getElementById('counttype_coupon').value;
            
            var payment_date_value = document.getElementById("id_payment_date").value;
            
            
            
            
            var obj = new Object();
            obj.paymentdate = payment_date_value;
            obj.code = registerid;
            obj.centercode = centercode;
            obj.name = spaceRemove(document.getElementById('name').value);
            
            obj.phone = document.getElementById('phone').value;
            obj.paymenttype = authlevel < 10 ? document.getElementById('payment_type').value : 0;
//            json_price.totalprice = parseInt(term_and_locker_price);
            obj.jsonprice = json_price;
            obj.isfirst = is_firstuser;
            obj.termtypedesc = termtype_desc;
            obj.counttypedesc = counttype_desc;
            obj.lockerdesc = locker_desc;
            obj.uselocker = use_locker;
            obj.lockernumber = id_locker_number;
            obj.lockerpass = id_locker_pass;
            obj.lockerstarttime = locker_starttime;
            obj.lockerendtime = locker_endtime ? locker_endtime : "";
            obj.lockerpaymenttype = locker_payment_type;
            
            obj.counttypecoupon = counttype_coupon_value;
            obj.termtypecoupon = termtype_coupon.value;
            obj.ptjoindata = pt_join_data;
            CallHandler("check_register", obj, function(res) {
                var code = parseInt(res.code);
               
                if (code == 100) {
                    
//                    $("#myModal").modal("hide");
//                    var title = is_firstuser == 1 ? "회원가입 완료" : "재가입 완료";
//                    var message = is_firstuser == 1 ?  "<p align='center'>회원가입을 완료하였습니다.!</p>" : "<p align='center'>재가입을 완료하였습니다.!</p>" ;
//                    showModalDialog(document.body, title, message, "확인", null, function() {
//                         hideModalDialog();          
//                         hideModalDialog();          
//                         change_registerbutton();                        
//                    }, function() {});
//                    clearInterval(listenInterval);
                    
                    var btn_finish = document.getElementById("btn_finish").style.display = "block";
//                    hideModalDialog();   
                    
                    change_registerbutton();          
                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });
        }
       
        function onclick_btn_finish(){
            clog("onclick_btn_finish");
           
            hideModalDialog();   
             $("#myModal").modal("hide");
        }
        function select_uselocker(){
            clog("select_uselocker");
        }


        
        function click_counttype_coupon(){

            counttype_visible_change();
        }
        
        function change_registerbutton(){
            document.getElementById("id_register_join").style.display = "none";
            document.getElementById("id_close_join").style.display = "block";
            
            document.getElementById('counttype_coupon').disabled = true; //PT disabled
            document.getElementById('counttype_coupon_price').disabled = true;     //pt price disabled
            document.getElementById('set_pt_doc').disabled = true; //PT disabled
            
            document.getElementById('use_locker').disabled = true;     //locker disabled
            document.getElementById('locker_payment_type').disabled = true;     //locker price disabled
            
            
        }
        function btn_close_join(){
            call_app();//closeWebView();
            go_home();
        }
//        function btn_pt_join(){
//            post_to_url('./join_pt.php?pagetype=adm&centercode='+my_centercode, join_userinfo);
//        }
  
        
        ///////////////////////////////////////////////////////////////////////
        // 라커 사용할때 목록에서 클릭할때만 이벤트를 발생한다.  END
        ///////////////////////////////////////////////////////////////////////
        
        
        function locker_change(isshow){
            clog("locker_change");
            var value = document.getElementById('use_locker').value;
            
            var locker_starttime = document.getElementById('locker_starttime');
            if (value == 1) {
                
               
                if(isshow){
                    //라커 팝업을 띄운다. 성별에 따라서 라커를 다르게 보여준다.
                    var gender_m = document.getElementById('gender_m');
                    var gender_f = document.getElementById('gender_f');
                    var gender = gender_m.checked ? "M" : "F";

                    showLocker(my_centercode,gender,function(res){
                        if(res == "success"){
                            setTimeout(function(){
                                locker_info.style.display = "block";
                            },1000);
                        }
                            
                    });    
                    
                }



            }
            //기존라커 연장하기
            else if(value == 2){
                var last_locker_endtime = "";
                if(re_obj.newlockers && re_obj.newlockers.length > 0){
                    for(var i = 0 ; i < re_obj.newlockers.length; i++){
                        if(!(re_obj.newlockers[i].isdelete && re_obj.newlockers[i].isdelete == "D")){
                            if(last_locker_endtime == "" || getDDay(re_obj.newlockers[i].endtime) > 0)
                            last_locker_endtime = re_obj.newlockers[i].endtime;
                        }
                    }
                }
                locker_info.style.display = "block";
                if(last_locker_endtime){
                    var stime = nextDay(re_obj.endtime,1);
                    locker_starttime.value = stime;
                }
            }
            else {
                locker_info.style.display = "none";
               
            }
            checkAllPrice();
            
        }


        //기타 체크박스 클릭시 값을 설정한다.
        $("#checkbox_other").click(function() {
            var flg = $("#checkbox_other").is(":checked");
            clog("flg ", flg);
            var edittext_other = document.getElementById('edittext_other');
            if (flg) {
                edittext_other.value = "";
                edittext_other.style.display = "block";
            } else {
                edittext_other.style.display = "none";
                edittext_other.value = "null";
            }
        });

        //                check_register();
        window.history.pushState(null, '', location.href);
        window.onpopstate = () => {
            
            if(isshowptpopup){
                 showModalDialog(document.body, "P.T가입취소", "P.T가입을 취소하고 회원가입 양식으로 돌아가시겠습니까?", "뒤로가기", "취소", function() {
                    setPTDocument(false);
                    hideModalDialog();
                    isshowptpopup = false; 
                     hideModalDialog();
                     window.history.pushState(null, '', location.href);
                }, function() {
                     window.history.pushState(null, '', location.href);
                     hideModalDialog();isshowptpopup = true;
                 });    
                
                
            }else{
                                
                history.go(1);
                //                  this.handleGoback();
//                $("#backModal").modal({
//                    keyboard: false,
//                    backdrop: 'static'
//                });
                
                showModalDialog(document.body, "페이지 나가기", "현재 페이지를 나가시겠습니까?<br>페이지를 나가면 모든 내용이 지워집니다.", "나가기", "취소", function() {
                     if (param_pagetype && param_pagetype == "adm")
                        gotoadmin();
                    else
                        gotohome();
                    hideModalDialog();   
                    hideModalDialog();  
                }, function() {
                    
                    hideModalDialog();
                     hideModalDialog();  
                    
                });
             
            }
            
        };

//        function back_cancel() {
//            $("#backModal").modal("hide");
//            window.history.go(1);
//        }
//
//        function back_yes() {
//            $("#backModal").modal("hide");
//            clog("window.history ", window.history);
//            if (param_pagetype && param_pagetype == "adm")
//                gotoadmin();
//            else
//                gotohome();
//        }

    var before_cindex = -1;
    function cListClick(index){
        var div_beforecouponicon_updown = document.getElementById("div_cicon_updown_"+before_cindex);
        var div_couponicon_updown = document.getElementById("div_cicon_updown_"+index);

        if(before_cindex != index && before_cindex != -1){
            if($(".c_sub"+before_cindex).is(":visible")){
                $(".c_sub"+before_cindex).slideUp(100);
                div_beforecouponicon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
            }           
        }

        if($(".c_sub"+index).is(":visible")){
            $(".c_sub"+index).slideUp(100);
            before_index = -1;
            div_couponicon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
        }
        else{
            $(".c_sub"+index).slideDown(150);
            div_couponicon_updown.innerHTML = "<i class='fa-solid fa-angle-up'></i>";
            before_index = index;
        }

    }
    function isEmail(id){
        inputIsEmail(id,function(res){
            if(res == 1)
                isuse_email = true;
            else 
                isuse_email = false;
        });
    }
        
    function replacePTSignTag(id,tag){
        console.log(id+" id ");
        
        
        if(!sign_count[""+id])sign_count[""+id] = [];
        var signcnt = tag.split("{{sign}}").length - 1;
        console.log("sign_count ",sign_count);
        for(var i = 0 ; i < signcnt; i++){
            sign_count[""+id].push("empty");
            var sign_btn_id = "sign_rule_btn_"+id+"_"+i;
            var sign_img_id = "sign_rule_img_"+id+"_"+i;
            var sign_tag = "<div style='border-radius:5px;background-color:white;width:auto;height:46px;float:right;padding:3px'>"+
                                "<button id='sign_rule_btn_"+id+"_"+i+"' onclick='click_signrule(\""+sign_btn_id+"\" ,\""+sign_img_id+"\" ,\""+id+"\",\""+i+"\")' style='float:right;margin-top:2px;background-color:#33a186;border:0px;border-radius:5px;padding:8px 15px 8px 15px;font-size:14px;color:white'>서명</button>"+
                                "<img id='sign_rule_img_"+id+"_"+i+"' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-right:5px;display:none' src=''/>"+                                
                           "</div><br><br>";            
            
            tag = tag.replace("{{sign}}",sign_tag); 
            
        }
        return tag;        
    }
    function click_signrule(btn_id, img_id,id,_i) {
        var i = parseInt(_i);
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
            if(!sign_count[""+id])sign_count[""+id] = [];
            if(id){
                sign_count[""+id][i] = popup_sign_img;               
            }
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
        signaturePadPTTermName1 = new SignaturePad(document.getElementById("canvas_pt_term_sign"), {
            backgroundColor: 'rgba(255, 255, 0, 0)',
            penColor: 'rgb(0, 0, 255)',
        });
        
    }
        
    function clear_ptterm_sign(type) {
        signaturePadPTTermName1.clear();

    }
        
    var arr_other_coupon_idx =[];
        
    function insert_other_coupon(){
        var select_other_coupon = document.getElementById("select_other_coupon");
       
        
        if(parseInt(select_other_coupon.value) <= 0)return;
        var div_inserted_other_coupon = document.getElementById("div_inserted_other_coupon");
        var couponlist_3 = document.getElementById("couponlist_3");
        var isin = false;
        console.log("00 arr_other_coupon_idx ",arr_other_coupon_idx);
        for(var i = 0 ; i < arr_other_coupon_idx.length;i++){
            if(parseInt(arr_other_coupon_idx[i]) == parseInt(select_other_coupon.value)){
                isin = true;
                break;
            }
        }
        
        if(!isin){
            arr_other_coupon_idx.push(select_other_coupon.value);
            var mbs_coupon = null;
            for(var i = 0; i < mbs_coupons.length;i++){
                if(mbs_coupons[i].mbs_idx == parseInt(select_other_coupon.value)){
                    mbs_coupon = mbs_coupons[i];
                    break;
                }
            }
            console.log("othercoupon ",mbs_coupon);
            var mbs_idx = parseInt(select_other_coupon.value);
            var couponname = mbs_coupon.mbs_name;
           
            var coupon_starttime = getToday();
            var coupon_endtime = nextMonth(coupon_starttime,parseInt(mbs_coupon.mbs_month));
            var coupon_month = mbs_coupon.mbs_month;
            var coupon_price = mbs_coupon.mbs_price;
            
            //1개월 기준 가격
            var default_other_1month_price = mbs_coupon.mbs_month && parseInt(mbs_coupon.mbs_month) > 0 ? parseInt(mbs_coupon.mbs_price)/parseInt(mbs_coupon.mbs_month) : 0;
            var div = document.createElement("div");
            div.id = "div_other_"+mbs_idx;
            
            div.innerHTML = "<br>"+
                "<div id='other_info_"+mbs_idx+"' style='border:1px solid #e9e9e9;border-radius:5px;' >"+
                    "<div style='width:100%;height:60px;background-color:#eaefe4;padding:10px 20px 10px 20px;border-bottom:1px dashed #dfe2e5;'>"+
                        "<label id='other_coupon_name_"+mbs_idx+"' style='margin-top:12px;color:#262930;font-size:16px;font-weight:500;'>"+couponname+"</label>"+
                        "<label id='other_coupon_value_"+mbs_idx+"' style='margin-top:12px;color:#262930;font-size:16px;font-weight:500;display:none'>"+mbs_idx+"</label>"+
                        "<button onclick='delete_other_coupon("+mbs_idx+")' class='btn' style='float:right;cursor:pointer;'><i class='fa-solid fa-x'></i></button>"+
                    "</div>"+
                    "<div style='width:100%;height:aut;padding:10px 20px 10px 20px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1);'>"+
                        "<div id='otherdatediv_"+mbs_idx+"' style='display:block;width:100%'>"+
                             "<table style='width:100%'>"+
                                "<tr>"+
                                    "<td style='width:22%'>"+
                                        "<label class='textevent'  for='other_starttime'>기타상품 시작일 : </label><br><input id='other_starttime_"+mbs_idx+"' class='myinputtype'  onchange='checkOtherPrice("+mbs_idx+", 50)'  style='padding:10px;border-radius:8px'  type='date' value='"+coupon_starttime+"' />"+
                                    "</td>"+
                                    "<td style='width:35%'>"+
                                        "<label class='textevent'  for='other_starttime'>기타상품 종료일 : </label><br><input id='other_endtime_"+mbs_idx+"' class='myinputtype'  onchange='checkOtherPrice("+mbs_idx+", 51)'  style='padding:10px;border-radius:8px'  type='date' value='"+coupon_endtime+"' />"+
                                    "</td>"+
                                    "<td style='width:18%'>"+
                                        "<div id='div_other_month' ><label class='textevent' >기타상품 개월수 : </label><br><input  id='id_other_month_"+mbs_idx+"' onfocus='this.select()'   type='number' class='myinputtype'  onchange='checkOtherPrice("+mbs_idx+", 52)' style='width:80px;padding:10px;border-radius:8px' value='"+coupon_month+"' /></div>"+
                                    "</td>"+
                                    "<td align='right' style='width:25%'>"+
                                        "<div id='id_otherprice_"+mbs_idx+"' style='width:160px' ><label class='textevent' style='float:left' >기타상품 가격 </label><br>"+
                                            "<input id='input_other_novat_price_"+mbs_idx+"' value='"+coupon_price+"' style='display:none'/><input id='default_other_1month_price_"+mbs_idx+"' value='"+default_other_1month_price+"' style='display:none'/><input id='input_other_price_"+mbs_idx+"' type='text'  onkeyup='inputChangeComma('input_other_price_"+mbs_idx+"')' onfocus='this.select()' placeholder='카드 결제금액...'  class='myinputtype'  onchange='checkOtherPrice("+mbs_idx+",113)'  style='width:160px; height:auto;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px' value='"+coupon_price+"'/></div>"+
                                    "</td>"+
                                "</tr>"+
                            "</table>"+
                        "</div>"+
                        "<hr style='border: solid 1px light-gray;'>"+
                        "<label class='textevent' style='margin-top:-15px'>결제 방법<span style='color:red'>*</span></label>"+
                        "<select id='other_payment_type_"+mbs_idx+"' onchange='checkOtherPrice("+mbs_idx+",120)' class='form-control myinputtype' name='payment_type'>"+
                            "<option value=''>결제방법을 선택하세요</option>"+
                            "<option value='1'>카드결제</option>"+
                            "<option value='2'>현금결제</option>"+
                            "<option value='4'>카드+현금</option>"+
                        "</select>"+
                         "<table id='other_table_totalprice_"+mbs_idx+"' class='class_table_other' style='width:100%;display:block' >"+
                            "<tr style='width:100%'>"+
                                "<td style='width:16%'>"+
                                    "<label class='textevent'>카드</label>"+
                                "</td>"+
                                "<td style='width:16%'>"+
                                    "<label class='textevent'>현금</label><br>"+
                                "</td>"+
                                "<td style='width:16%'>"+
                                    "<label class='textevent' style=''>미수금</label><br>"+
                                "</td>"+
                                "<td style='width:16%'>"+
                                    "<label class='textevent' style='color:#009ef7'>할인</label><br>"+
                                "</td>"+
                             "</tr>"+
                             "<tr>"+
                                "<td style='min-width:16%'>"+
                                   "<input type='text' class='form-control' id='id_other_price_card_"+mbs_idx+"' onkeyup='checkOtherPrice("+mbs_idx+",1)' onfocus='this.select()' placeholder='카드 결제금액...' novalidate>"+
                                "</td>"+
                                "<td style='min-width:16%'>"+
                                   "<input type='text' class='form-control' id='id_other_price_cash_"+mbs_idx+"' onkeyup='checkOtherPrice("+mbs_idx+",2)' onfocus='this.select()' placeholder='현금 결제금액...' novalidate>"+
                                "</td>"+
                                "<td style='min-width:16%'>"+
                                   "<input type='text' class='form-control' id='id_other_price_remain_"+mbs_idx+"' onclick='alertMsg(\"기타상품은 미수금기능을 사용할 수 없습니다.\")' onkeyup='checkOtherPrice("+mbs_idx+",3)' onfocus='this.select()'  placeholder='미수금 가격...'  placeholder='미수금 입력 ...' style='background-color:#e9ecef' novalidate readonly>"+
                                "</td>"+
                                "<td style='min-width:16%'>"+
                                    "<input type='text' class='form-control' id='id_other_price_discount_"+mbs_idx+"'  onclick='alertMsg(\"기타상품은 할인기능을 사용할 수 없습니다.<br>금액을 변경하려면 기타상품가격을 수정하세요\")'  onkeyup='checkOtherPrice("+mbs_idx+",4)' onfocus='this.select()' style='color:#009ef7' placeholder='할인가 입력 ...' novalidate readonly>"+
                                "</td>"+
                             "</tr>"+
                             "<tr>"+
                                 "<td colspan = '4'>"+
                                     "<span style='float:left'><label class='textevent' style='margin-right:10px;margin-top:5px'>총금액</label></span>"+
                                     "<span style='float:left'><input type='text' class='form-control' id='id_other_price_total_"+mbs_idx+"' placeholder='총 금액...' style='margin-top:15px' disabled></span>"+
                                     "<span style='float:right'><input type='text' class='form-control' id='id_other_price_totalremain_"+mbs_idx+"' placeholder='결제 금액...' style='width:160px; height:auto;background-color:#e9e9e9;border:1px solid #b9b9b9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 15px 10px 15px;margin-top:15px' disabled></span>"+
                                     "<span style='float:right'><label class='textevent'  style='margin-right:10px;margin-top:5px'>결제금액</label></span>"+
                                 "</td>"+
                             "</tr>"+
                        "</table>"+
                    "</div>"+
                "</div>";
            div_inserted_other_coupon.append(div);
            
            checkCouponTitleColor();
            console.log("arr_other_coupon_idx ",arr_other_coupon_idx);
            checkOtherPrice(mbs_idx);
        }

    }
    function delete_other_coupon(idx){
        var div_other = document.getElementById("div_other_"+idx);
        var div_inserted_other_coupon = document.getElementById("div_inserted_other_coupon");
        div_inserted_other_coupon.removeChild(div_other);
        
        var newarr = [];
        console.log("11 arr_other_coupon_idx ",arr_other_coupon_idx);
        for(var i = 0 ; i < arr_other_coupon_idx.length;i++){
            if(parseInt(arr_other_coupon_idx[i]) == idx){
                delete arr_other_coupon_idx[""+idx];
            }else {
                newarr.push(arr_other_coupon_idx[i]);
            }
        }
//         console.log("11 arr_other_coupon_idx ",arr_other_coupon_idx);
        arr_other_coupon_idx = newarr;
        checkCouponTitleColor();
//        console.log("json_price.otherprice ",json_price.otherprice);
        
        
        var delete_index = -1;
        if(othercoupons.length > 0){
            for(var i = 0 ; i < othercoupons.length; i++){
                if(parseInt(othercoupons[i].couponidx) == parseInt(idx)){
                    delete_index = i;
                    break;
                }
            }
            if(delete_index >= 0){
                othercoupons.splice(delete_index,1);
            }
        }
        console.log("othercoupons ",othercoupons);
    }
    </script>

</body>

</html>
