<?php  
//include('./common'); //아직 회원가입 페이지가 어디로 가야할지 모르겠다.

include('./cmn_var.php');
include('./cmn_func.php');
if(isset($_SESSION['authgroup'.DEV_REAL]) && $_SESSION['authgroup'.DEV_REAL] < AUTH_TRANER){

    echo "<script>alertMsg('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=login'>";
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

$groupcode = "smartflat";
$centercode = 1000;
$groupname = "스마트플랫";

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
<!--    <link rel="stylesheet" type="text/css" href="css/dd.css">-->
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
    <div align="center" id = "txt_rejoin_user" style="width:100%;height:40px;display:none;background-color:#fee9d2;"><img src = "./img/icon_warning.png" style="width:24px;height:22px;margin-top:-6px;">&nbsp;&nbsp;<text style="font-size:16px;color:#7e460f;line-height:40px;margin-top:9px">재등록중입니다.</text></div>
    <div align="center" style="width:100%"><!--가운데정렬을 위한 DIV1 -->
        <div align="left" style="max-width:960px;text-align:left"><!--가운데정렬을 위한 DIV2 -->
            <div id="join" style="float:left;width:100%;padding:35px 25px 35px 25px;">
        
       
        
        <div  style="width:100%;background-color:#ffffff;padding:25px;border-radius:15px;box-shadow:0px 0px 10px 0px rgba(0,0,0,0.1)">
<!--            <div align="center" style='height:100px'></div>-->
            <div>
                <text id = "id_title_logo" style='color:#262930;font-size:20px;font-weight:700;'>로그인 ID 찾기</text>
               
            </div>
            <hr style='border:1px solid #eff2f5;margin-top:25px;margin-left:-25px;margin-right:-25px'/>
            
            
                   
            
<!--            <form action="#" method="post" id="join-us">-->

                <div>
                    <div id=formdiv >
                        <table style='width:100%'>
                            <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="name" class="textevent">업체명<span style='color:red'>*</span></label>
                                </td>
                            </tr>
                            <tr>
                                <td  style='width:50%'>
                                   <input type="text" class="form-control myinputtype" id="company_name" name="company_name" placeholder="예) 스마트플랫" >                           
                                </td>
                             </tr>
                            <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="name" class="textevent">이름<span style='color:red'>*</span></label>
                                </td>                              
                             </tr>
                             <tr> 
                                  <td  style='width:50%;height:50px'>
                                    <input type="text" class="form-control myinputtype" id="name" name="name" placeholder="예) 홍길동" >
                                </td>                                
                             </tr>                             
                             <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="phone" class="textevent">휴대폰 번호<span style='color:red'>*</span></label>
                                </td>                               
                             </tr>
                             <tr> 
                                <td  style='width:50%;height:50px'>
                                    <input type="number" class="form-control myinputtype" maxlength="11" id="phone" name="mobile" oninput="maxLengthCheck(this.id)" placeholder="숫자만 입력.." >
                                </td>                                
                             </tr>
                             
                        </table>

                   

                        
                    </div>
                     
                </div>
                <div id= "table_email" style='width:100%;display:none'>
                   <div>
                        <label for="email" class="textevent">이메일<span style='color:red'>*</span></label>
                    </div>
                   <div>
                        <input type="text" class="form-control myinputtype" id="email" name="email" placeholder="Email 입력" >
                    </div>
                </div>
<!--            </form>-->
            <hr style="border: solid 1px light-gray;">

            <!-- 싸인 DIV END-->

            <br>
            <div style='width:100%'>
                <button id='id_register_join' onclick="btn_register_send()" class="btn btn-primary btn-raised" style='float:right;width:140px;border:0px;'>ID 찾기</button>
                
            </div><br><br>




        </div> <!-- container end -->

    </div> <!-- join end -->
        </div>
    </div>
    
  

    <!--===========================-->
    <!--반드시 삽입해야함-->
    <!--===========================-->
    <div id="div_top"></div>
    <div id="div_nav"></div>
    <div id="div_bottom"></div>
    
    <script src="signature_pad.min.js"></script>
    <script src="signature/assets/json2.min.js"></script>
    <script>
        
//         var signtd1 = document.getElementById("signtd1");
//         var signtd2 = document.getElementById("signtd2");
//         var sign_devide1 = document.getElementById("sign_devide1");
//         var sign_devide2 = document.getElementById("sign_devide2");
//         
//        
//        var signtd1_width = signtd1 ? signtd1.offsetWidth : 0;
//        var signtd1_height = signtd1 ? signtd1.offsetHeight : 0;
//        sign_devide1.style.marginLeft = signtd1_width/3;
//        sign_devide2.style.marginLeft = signtd1_width/3*2;
//        clog("signtd1 width "+signtd1.offsetWidth+" signtd2 width "+signtd2.offsetWidth);
       
         var param_type = getParam("type");
        if(param_type == "pass"){
            var table_email = document.getElementById("table_email");
            var id_title_logo = document.getElementById("id_title_logo");
            var id_register_join = document.getElementById("id_register_join");
            
            
            table_email.style.display = "block";
            id_title_logo.innerHTML = "새로운 비밀번호 변경";
            id_register_join.innerHTML = "비밀번호 변경";
            
        }
         function btn_register_send() {

            //         var name = $("#join-us input[name=name]").val();
          
            var company_name = spaceRemove(document.getElementById('company_name').value);
            var name = spaceRemove(document.getElementById('name').value);
            var phone = document.getElementById('phone').value;
            var email = document.getElementById('email').value;
            
            
            
            
            
           
            if (company_name == "") {
                alertMsg("업체명을 입력해 주세요");
                return;
            }
            else if (!name) {
                alertMsg("이름을 입력해 주세요");
                return;
            }
            
            else if (phone == "" || phone.length < 11) {
                alertMsg("휴대폰 번호를 - 없이 11자리를 입력해 주세요.");
                return;
            }
            
            
           
            var _data = {
                "company_name":company_name,
                "name": name + "",
                "phone": phone + "",
                "email": email + ""
                
            };
            
            //param_type : pass or id (other)
            findIDPassCheck(param_type, _data,function(res){
                code = parseInt(res.code);
                if (code == 100) {

                    alertMsg(res.message,function(){
                        gotoLoginPage();
                    });

                } else {
                    //
                     alertMsg(res.message);
                }
            },function(err){
                 alertMsg("네트워크 에러 ");
            });

        }
        </script>

</body>

</html>
