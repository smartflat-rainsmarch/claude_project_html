<?php  
//include('./common'); //아직 회원가입 페이지가 어디로 가야할지 모르겠다.

include('./cmn_var.php');
include('./cmn_func.php');

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
                <text id = "id_title_logo" style='color:#262930;font-size:20px;font-weight:700;'>회원가입</text>
               
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
                                <td  style='width:50%'>
                                   <label for="phone" class="textevent">휴대폰 번호<span style='color:red'>*</span></label>                         
                                </td>
                             </tr>
                             <tr> 
                                  <td  style='width:50%;padding-right:12px;height:50px'>
                                    <input type="text" class="form-control myinputtype" id="name" name="name" placeholder="예) 홍길동" >
                                </td>
                                <td  style='width:50%'>
                                   <input type="number" class="form-control myinputtype" maxlength="11" id="phone" name="mobile" oninput="maxLengthCheck(this.id)" placeholder="숫자만 입력.." >
                                </td>
                             </tr>
                             
                      
                             <tr>
                                 <td  id='td_email1' style='padding-right:12px;height:50px'>
                                    <label for="email" class="textevent" >이메일<span style='color:red'>*</span></label>                             
                                 </td> 
                                 <td id='td_email2' >
                                    <label for="email_code" class="textevent" >이메일 확인코드<span style='color:red'>*</span></label>                                
                                 </td>
                                 
                             </tr>
                             <tr>
                                 <td id='td_address2'  style='padding-right:12px;height:50px'>
                                   
                                   <table>
                                       <tr>
                                           <td style="width:100%">
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
                                           <td>
                                               <button id='btn_send_emailcode' onclick="send_emailcode()" class="btn btn-primary btn-raised" style='float:right;width:110px;margin-left:5px;display:none'>코드전송</button>
                                    
                                           </td>
                                       </tr>
                                   </table>
                                       
                                 </td>
                                 <td id='td_email2' >
                                   
                                     <!--이메일 체크 아이콘들-->
                                     <span align="right" style="float:right;margin-right:40px">
                                         <div id="email_confirm_checkdiv" style="width:30px;height:30px;position:absolute;margin-top:13px;display:none">
                                             <label id = "email_confirm_icon_loading" class='loader' style=""></label>
                                             <i class="fa-regular fa-circle-exclamation"  id="email_confirm_icon_notuse" style="color:red;font-size:20px" title="이메일 형식에 맞지 않거나 중복된 이메일이 있습니다."></i>
                                             <i class="fa-regular fa-circle-check"  id="email_confirm_icon_use"style="color:#007bff;font-size:20px"></i>
                                         </div>
                                     </span>
                                     <span><input type="email" class="form-control myinputtype"  onchange='isConfirmEmail(this.id)' id="email_confirm" name="email_confirm" placeholder="예) 123456"  style='width:100%;margin-top:5px' readonly></span>                                       
                                   
                                 </td>
                                 
                             </tr>
                             <tr>
                                <td  style='width:50%;height:40px'>
                                    <label for="pass1" class="textevent">비밀번호<span style='color:red'>*</span></label>
                                </td>
                                <td  style='width:50%'>
                                    <label for="pass2" class="textevent">비밀번호확인<span style='color:red'>*</span></label><br>                                    
                                </td>
                             </tr>
                             <tr> 
                                  <td  style='width:50%;padding-right:12px;height:50px'>
                                    <input type="password" class="form-control myinputtype" id="pass1" name="name" placeholder="비밀번호 입력" >
                                </td>
                                <td  style='width:50%;padding-right:12px;height:50px'>
                                    <input type="password" class="form-control myinputtype" id="pass2" name="name" placeholder="비밀번호 확인" >
                                </td>
                            </tr>
                        </table>


                        
                      
                        
                    </div>
                </div>
<!--            </form>-->
            <hr style="border: solid 1px light-gray;">

            <!-- 싸인 DIV END-->

            <br>
            <div style='width:100%'>
                <button id='id_register_join' onclick="btn_register()" class="btn btn-primary btn-raised" style='float:right;width:140px;border:0px;'>회원가입하기</button>
                <button id='id_close_join' onclick="btn_close_join()" class="btn btn-primary btn-raised" style='border:0px;float:right;width:140px;display:none;margin-right:10px'>가입완료</button>
            </div><br><br>




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

        $(document).ready(function() {
            
        });
        
         function btn_register(){
            
            var style = {
                bodycolor: "white",
                 marginTop:"0px",
                size: {
                    width: "100%",
                    height: "auto"
                }
            };
           
            
            var btn_text =  "회원가입";
                
            var title_tag = "<label style='color:#181c32'>"+btn_text+"</label>";
            showModalDialog(document.body, title_tag,  "<label style='font-size:16px;font-weight:600;color:#181c32'>이용약관을 숙지하였으며 위 내용대로 "+btn_text+"하시겠습니까?</label><br><br>" , btn_text+"하기", "취소", function() {
                    hideModalDialog();
                    btn_register_send();
                }, function() {
                    hideModalDialog();
                }, style);
            
        }
        function btn_register_send() {

            //         var name = $("#join-us input[name=name]").val();
          
            var company_name = spaceRemove(document.getElementById('company_name').value);
            var name = spaceRemove(document.getElementById('name').value);
            
            var email = spaceRemove(document.getElementById('email').value);
            var phone = document.getElementById('phone').value;
//            var gender = gender_m.checked ? "M" : "F";
            var pass1 = spaceRemove(document.getElementById('pass1').value);
            var pass2 = spaceRemove(document.getElementById('pass2').value);
            
            
            
            
            
           
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
            else if (email == "") {
                alertMsg("이메일을 입력해 주세요");
                return;
            }
            else if (pass1 == "") {
                alertMsg("비밀번호를 입력해 주세요");
                return;
            }
            else if (pass2 == "") {
                alertMsg("비밀번호 확인을 입력해 주세요");
                return;
            }
            else if (pass1 != pass2) {
                alertMsg("비밀번호가 일치하지 않습니다. ");
                return;
            }
            else if(!isuse_confirm_email){
                alertMsg("코드가 잘못되었습니다.");
                return;
            }
            
            
            
           
            var _data = {
                "company_name":company_name,
                "name": name + "",
                "email": email + "",
                "phone": phone + "",
                "pass": pass1 + ""
            };
            
            registerCheck(_data,function(res){
                code = parseInt(res.code);
                if (code == 100) {

                    alertMsg("회원가입 완료!<br>로그인 페이지로 이동합니다.",function(){
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
        function go_home() {
//            $("#end_modal").modal("hide");

            if (param_pagetype && param_pagetype == "adm")
                gotoadmin();
            else
                gotohome();

        }
        
        
      
    function isEmail(id){
        inputIsEmail(id,function(res){
            var btn_send_emailcode = document.getElementById("btn_send_emailcode");
            if(res == 1){
                isuse_email = true;
                btn_send_emailcode.style.display = "block";
               
            }                
            else {
                isuse_email = false;
                btn_send_emailcode.style.display = "none";
               
            }
                
        });
    }
    function isConfirmEmail(id){
        inputIsConfirmEmail(id,function(res){
            if(res == 1)
                isuse_confirm_email = true;
            else 
                isuse_confirm_email = false;
        });
    }
        
    </script>

</body>

</html>
