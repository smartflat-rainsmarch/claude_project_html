    
 
    <div id = "reservation_container" class="container" style='width:auto;height:100%;margin-left:270px;margin-right:30px;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text id='title_payment' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >계정추가하기</text>
            
            <button id="button_chargehistory" style="float:right; width: 133px;margin-top:5px; height: 40px; border-radius: 5px; background-color: rgb(0, 158, 247); font-size: 13px; color: rgb(255, 255, 255); text-align: center; font-weight: 400; border: 0px; outline: none;" onclick="showAddAccount()">+ 부계정 추가</button>
            <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
          
            
            <div id="container" style="display:flex">

            </div>
            <div id="id_nodata">
            <br>
            <div  id="nodata" align="center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
            </div>
            <br>
            <div id='main_div'>                
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style='background-color:white;display:none;'></table>
        </div>
    </div>
    
    <script>
        
        setImageButton("admin_settingid_215","btn_alltraner.png","btn_alltraner_press.png","btn_alltraner_hover.png");
        setImageButton("arrow_l","button_prev_yellow.png","button_prev_yellow_press.png","button_prev_yellow_hover.png");
        setImageButton("arrow_r","button_next_yellow.png","button_next_yellow_press.png","button_next_yellow_hover.png");
        
        var container = document.getElementById("container");
        
        var isuse_email = false;
        var isuse_confirm_email = false;
        var accounts = null;
        $(document).ready(function() {
            init();                             
        });
        function init(){
 
            if(auth_num <= 99)return;
             getSubUserList(function(res){
                 accounts = res;
                console.log("getSubUserList res ",res);
                if(res != null){
                    console.log("111 getSubUserList res ",res);
                    drawAccounts(res);
                }
            });
            
        }
        function drawAccounts(res){
            var len = res ? res.length : 0;
            if(len > 0)updateNoData(false);
            
            for(var i=0; i< len;i++){
                var channel = res[i];
//                console.log(`ID: ${channel.id}, Name: ${channel.name}`);
                var isselected = false;            
                var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
                var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
                var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D9DCED;";
                var users_info_display = isselected ? "block" : "none";
                var user_name = channel.mem_username;
                var user_mail = channel.mem_email;
                var traner_info_tag = 
                        "<div id='div_accountinfo_"+i+"' onclick ='selectAccount("+i+")' align='center' style='width:230px;height:120px;border-radius:5px;"+box_css+";color:#3F4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;'>"+
                            "<div id='div_accountinfo_top_"+i+"' align='left' style='width:100%;height:40px;padding:10px 13px;10px;20px;background-color:#F6F7F7;border-radius:5px 5px 0px 0px;"+title_css+"'>"+
                               //PT달력 이름
                                "<label style='font-weight: 500;font-size:16px;float:left' >"+user_name+"</label>"+
                                "<img src='./img/icon_list_black.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick='deleteAccount(\""+user_mail+"\")'>"+
//                                "<i class='fa-regular fa-calendar' onclick=''  style='float:right;margin-top:2px;margin-left:5px;color:#3f4254;cursor:pointer'></i><br>"+
                             "</div>"+
                            
                            "<div id='div_accountinfo_body_"+i+"' align='left' style='width:100%;height:80px;padding:10px 17px 10px 20px;border-radius:0px 0px 5px 5px;"+body_css+"'>"+
                                "<div style='width:100%;height:40px;padding:10px 13px;10px;20px;'>"+
                                    "<text>"+user_mail+"</text>"+
                                "</div>"+
//                                "<img src='./img/icon_delete48.png' style='float:left;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick=''>"+
//                                "<img src='./img/btn_reset.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick=''>"+
                            "</div>"+
                        "</div>";
                container.innerHTML += traner_info_tag;    
            }     
             if(len > 0)selectAccount(0);
        }
        function updateNoData(flg){
            var nodata = document.getElementById("nodata");
            nodata.style.display = flg ? "block" : "none";
        }
        function showAddAccount() {
       
             if(auth_num <= 99)return;
    //        var sdate = new Date(re_obj.starttime);
    //        var edate = new Date(re_obj.endtime);
            var stime = getToday();


            var container = document.getElementById("container");

    //        var tlist = "<option value=''>== 담당트레이너를 선택하세요 ==</option>";
    //        for (var i = 0; i < teacherlist.length; i++)
    //            tlist += "<option value='" + teacherlist[i].mem_uid + "' data-image='" + teacherlist[i].mem_photo + "'>" + teacherlist[i].mem_username + " 트레이너</option>";


            var title_tag = "<label style='color:#181c32'>계정 추가</label><text id='company_name'>"+session_groupname+"</text>";
            var message_tag = 
                "<div>"+
                 "<table id='email_table' style='width:100%'>"+
                    "<tr>"+
                         "<td id='td_email1' style='width:50%;height:50px'>"+
                             "<label for='email'>이메일<span style='color:red'>*</span></label>&nbsp;&nbsp;<text id='txt_email_subdesc' style='color:blue;display:none'></text>"+
                         "</td>"+
                         "<td id='td_email2'>"+
                             "<label for='email_code'>이메일 확인코드<span style='color:red'>*</span></label>"+
                         "</td>"+
                     "</tr>"+
                     "<tr>"+
                         "<td id='td_address2' style='width:50%;height:50px'>"+
                             "<table style='width:100%;'>"+
                                 "<tr>"+
                                     "<td style='width:100%;padding-right:12px;'>"+
                                         "<span align='right' style='float:right;margin-right:40px'>"+
                                             "<div id='email_checkdiv' style='width:30px;height:30px;position:absolute;margin-top:13px;display:none'>"+
                                                 "<label id='email_icon_loading' class='loader' style=''></label>"+
                                                 "<i class='fa-regular fa-circle-exclamation' id='email_icon_notuse' style='color:red;font-size:20px' title='이메일 형식에 맞지 않거나 중복된 이메일이 있습니다.'></i>"+
                                                 "<i class='fa-regular fa-circle-check' id='email_icon_use' style='color:#007bff;font-size:20px'></i>"+
                                             "</div>"+
                                         "</span>"+
                                         "<span><input type='email' class='form-control myinputtype' onchange='isEmail(this.id)' id='email' name='email' placeholder='예) black@email.com' style='width:100%;margin-top:5px'></span>"+
                                     "</td>"+
                                     "<td style='padding-right:12px'>"+
                                         "<button id='btn_send_emailcode' onclick='send_emailcode()' class='btn btn-primary btn-raised' style='float:right;width:110px;margin-left:5px;display:none'>코드전송</button>"+

                                     "</td>"+
                                 "</tr>"+
                             "</table>"+
                         "</td>"+
                         "<td id='td_email2'>"+
                             "<span align='right' style='float:right;margin-right:40px'>"+
                                 "<div id='email_confirm_checkdiv' style='width:30px;height:30px;position:absolute;margin-top:13px;display:none'>"+
                                     "<label id='email_confirm_icon_loading' class='loader' style=''></label>"+
                                     "<i class='fa-regular fa-circle-exclamation' id='email_confirm_icon_notuse' style='color:red;font-size:20px' title='이메일 형식에 맞지 않거나 중복된 이메일이 있습니다.'></i>"+
                                     "<i class='fa-regular fa-circle-check' id='email_confirm_icon_use' style='color:#007bff;font-size:20px'></i>"+
                                 "</div>"+
                             "</span>"+
                             "<span><input type='email' class='form-control myinputtype' onchange='isConfirmEmail(this.id)' id='email_confirm' name='email_confirm' placeholder='예) 123456' style='width:100%;margin-top:5px' readonly></span>"+
                         "</td>"+
                     "</tr>"+
                 "</table>"+
                 "</div>"+
                 "<br>"+
                 "<div id='sub_table' style='width:100%;display:none'>"+
                  "<table style='width:100%'>"+

                     "<tr>"+
                         "<td style='width:50%;height:40px'>"+
                             "<label for='name'>이름<span style='color:red'>*</span></label>"+
                         "</td>"+
                         "<td style='width:50%'>"+
                            "<label for='phone'>휴대폰 번호<span style='color:red'>*</span></label>"+
                         "</td>"+
                     "</tr>"+
                     "<tr>"+
                         "<td style='width:50%;padding-right:12px;height:50px'>"+
                             "<input type='text' class='form-control myinputtype' id='name' name='name' placeholder='예) 홍길동'>"+
                         "</td>"+
                         "<td style='width:50%'>"+
                            "<input type='number' class='form-control myinputtype' maxlength='11' id='phone' name='mobile' oninput='maxLengthCheck(this.id)' placeholder='숫자만 입력..'>"+
                         "</td>"+
                     "</tr>"+               

                     "<tr>"+
                         "<td style='width:50%;height:40px'>"+
                             "<label for='pass1'>비밀번호<span style='color:red'>*</span></label>"+
                         "</td>"+
                         "<td style='width:50%'>"+
                             "<label for='pass2'>비밀번호확인<span style='color:red'>*</span></label><br>"+
                         "</td>"+
                     "</tr>"+
                     "<tr>"+
                         "<td style='width:50%;padding-right:12px;height:50px'>"+
                             "<input type='password' class='form-control myinputtype' id='pass1' placeholder='비밀번호 입력'>"+
                         "</td>"+
                         "<td style='width:50%;padding-right:12px;height:50px'>"+
                             "<input type='password' class='form-control myinputtype' id='pass2' placeholder='비밀번호 확인 입력'>"+
                         "</td>"+
                     "</tr>"+
                 "</table>"
                "</div>";



                 var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "60%",
                        height: "auto"
                    }
                };
                 showModalDialog(document.body, title_tag,  message_tag , "추가하기", "취소", function() {
                     var company_name = session_groupname;
                     var name = document.getElementById("name").value;
                     var email = document.getElementById("email").value;
                     var email_confirm = document.getElementById("email_confirm").value;
                     var phone = document.getElementById("phone").value;
                     var pass1 = document.getElementById("pass1").value;
                     var pass2 = document.getElementById("pass2").value;
                     console.log("name :"+name+" email: "+email);
                     var _data = {
                         "company_name" : company_name,
                         "name" : name,
                         "email" : email,
                         "email_confirm" : company_name,
                         "phone" : phone,
                         "pass1" : pass1,
                         "pass2" : pass2                     
                     }

                     hideModalDialog();
                     btn_register_sub(_data);

                }, function() {
                    hideModalDialog();
                }, style);

             
        
        }
        function selectAccount(idx){
            var div_accountinfo = document.getElementById("div_accountinfo_"+idx);
            
            for(var i = 0 ; i < accounts.length;i++){
                var div_accountinfo = document.getElementById("div_accountinfo_"+i);
                var div_accountinfo_top = document.getElementById("div_accountinfo_top_"+i);
                var div_accountinfo_body = document.getElementById("div_accountinfo_body_"+i);
                //selected
                if(i == idx){
                    div_accountinfo.style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
                    div_accountinfo.style.border = "0px";
                    div_accountinfo_top.style.borderBottom = "0px";
                    div_accountinfo_body.style.backgroundColor = "#F1FAFF";
                    div_accountinfo_body.style.borderBottom = "0px";
                    
                    
                }
                //not selected
                else{
                     div_accountinfo.style.boxShadow = "0px 0px 0px rgba(0, 0, 0, 0)";
                    div_accountinfo.style.border = "1px solid #D9DCED";
                    div_accountinfo_top.style.borderBottom = "1px solid #D9DCED";
                    div_accountinfo_body.style.backgroundColor = "#ffffff";
                    div_accountinfo_body.style.borderBottom = "1px solid #D9DCED";
                    
                }
            }
            editAccountPermissionTag(idx);
            onclick_Ani(idx);
             var main_div = document.getElementById("main_div");
             animateHeight("main_div",main_div.offsetHeight+2,500);   
        }
        function onclick_Ani(idx){
             ///////////////////////////////////////////////////////////
            // name animation START
            ///////////////////////////////////////////////////////////


                var div_temp = document.createElement("div");
                div_temp.id = "div_temp";
                div_temp.align = "center";
                
                div_temp.innerHTML = "<label style='font-weight: 500;font-size:16px' ></label>";
                var div_box = document.getElementById("div_accountinfo_"+idx);

                var mleft = (idx%5)*242+4;
                var mtop = parseInt(idx/5)*135+5;
                
                console.log("mleft "+mleft+" mtop "+mtop);
                
                div_temp.style="position:absolute;width:230px;height:120px;background-color:#F1FAFF;color:white;border-radius:5px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float:left;padding:10px 20px;10px;20px;px;margin-top:-120px;cursor:pointer";


                var tlen = div_box.children.length;
                var hlen = tlen > 0 ? parseInt((tlen-1)/5) : 0;
                var addheight = (hlen-parseInt(idx/5))*135;
                
                div_box.appendChild(div_temp);

                var anitop = parseInt(div_temp.style.marginTop)+170+addheight;
//                var anileft = parseInt(div_temp.style.marginLeft)-mleft+87;
            
                div_temp.style.opacity = "0.5";
            
                
                $("#div_temp").animate({"margin-top":anitop, "margin-left":-idx*242, "width":"769px","height":"236px","opacity":0,"transition":"top 1s"} ,500,function(){
                    div_box.removeChild(div_temp);
                });
            ///////////////////////////////////////////////////////////
            // name animation END
            ///////////////////////////////////////////////////////////

            
        }
      
        function editAccountPermissionTag(idx) {
            var main_div = document.getElementById("main_div");
            main_div.innerHTML = "";
            var manageruid = "";
            
            var div = document.createElement("div");
            div.innerHTML = "<div align='center' id='div_data_"+manageruid+"' style='width:100%;height:auto;'>"+
                                    //권한 체크박스들
                                    detailPermissionTag(idx)+
                                 "<br><br><br><br><br><div align='left' style='height:60px;margin-left:20px;'>"+
                                    "<button onclick='savePermissions("+idx+")' class='btn ' style='float:right;;margin-right:20px;cursor:pointer;width:160px; height:40px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='btn_change_channel_data'>["+accounts[idx].mem_username+"] 권한수정</button>"+
                                 "</div>"+
                            "</div>";
            
              
            var main_div = document.getElementById("main_div");
            main_div.appendChild(div);
            
            
            //init element
            togglechange("channel", "OFF","ON");
            togglechange("createkey", "OFF","ON");
            
        }
       
        function detailPermissionTag(idx){
            
            
            
            var toggle_channel = "";//채널생성권한 ON/Off
            var checkbox_channel_new_channel = "";//신규 채널생성 권한
            var checkbox_channel_remove_channel = "";//채널삭제 권한
            var checkbox_channel_default = "";// 개본설정 수정
            var checkbox_channel_study = "";//학습관리 수정
            
            var toggle_createkey = "";//채널키 만들기 권한 ON/OFF
            var checkbox_add_domain = "";//도메인 추가
            var checkbox_delete_domain = "";//도메인 삭제
            
            var setting = accounts[idx]["mem_setting"];
            if(setting != null && setting.length > 5 && typeof(JSON)){
                var json_setting = JSON.parse(setting);
                if(json_setting["channel"]["toggle"] == "true")toggle_channel = "checked";
                if(json_setting["channel"]["new_channel"] == "true")checkbox_channel_new_channel = "checked";
                if(json_setting["channel"]["remove_channel"] == "true")checkbox_channel_remove_channel = "checked";
                if(json_setting["channel"]["edit_default"] == "true")checkbox_channel_default = "checked";
                if(json_setting["channel"]["edit_study"] == "true")checkbox_channel_study = "checked";
                
                if(json_setting["createkey"]["toggle"] == "true")toggle_createkey = "checked";
                if(json_setting["createkey"]["add_domain"] == "true")checkbox_add_domain = "checked";
                if(json_setting["createkey"]["delete_domain"] == "true")checkbox_delete_domain = "checked";
               
            }
            
            
            
            var div_center_vertical_css = "display: flex; flex-direction: column; align-items: center; justify-content: center; box-sizing: border-box;";
            var div_center_vertical_css2 = "display: flex; flex-direction: column; justify-content: center; ";
               
           
            var txt_off = "OFF";
            var txt_on = "ON";
          
            var name = "channel";      
            var txt_default = toggle_channel == "checked" ? txt_on : txt_off;
            var color_bg = toggle_channel == "checked" ? "#F1FAFF" : "#cccccc";
            
            var channel_toggle_tag =
            "<div style='float:right; width:180px;height:auto;padding-left:10px;padding-right:5px;'>" +
                "<label class='switch' style='float:left;'>" +
                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")' "+toggle_channel+"/>" +
                "<span id='toggle_icon_"+name+"'  class='slider round'>" +
                "</span>" +
                "</label>" +
                 "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;' >"+txt_default+"</text>" +
            "</div>";
            
            name = "createkey";     
            txt_default = toggle_createkey == "checked" ? txt_on : txt_off;
            
            
            var create_key_toggle_tag =
            "<div style='float:right; width:180px;height:auto;padding-left:10px;padding-right:5px;'>" +
                "<label class='switch' style='float:left;'>" +
                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")' / "+toggle_createkey+">" +
                "<span id='toggle_icon_"+name+"'  class='slider round'>" +
                "</span>" +
                "</label>" +
                 "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;'>"+txt_default+"</text>" +
            "</div>";
            
            var channel_tag = 
                "<br><div style='display:flex;'><label for='subscription_path' style='text-align:left;width:100%;float:left;font-size:16px'>채널생성 권한</label>"+channel_toggle_tag+"</div><br>"+
                "<div id='div_checkbox_channel' style='width:100%;height:60px;border-radius:5px;background-color:"+color_bg+";padding-left:20px'>"+
                "  <span style='float:left;margin-top:20px;'><text >신규채널생성 권한</text></span>"+
                "  <span style='float:left;margin-top:20px;'><label class='mycheckbox' style='margin-left:5px;margin-right:15px;'><input id='checkbox_channel_new_channel' type='checkbox' "+checkbox_channel_new_channel+"><span class='checkmark'></span></label></span>"+
                "  <span style='float:left;margin-top:20px;'><text >채널삭제 권한</text></span>"+
                "  <span style='float:left;margin-top:20px;'><label class='mycheckbox' style='margin-left:5px;margin-right:15px;'><input id='checkbox_channel_remove_channel' type='checkbox' "+checkbox_channel_remove_channel+"><span class='checkmark'></span></label></span>"+
                "  <span style='float:left;margin-top:20px;'><text >기본설정 수정</text></span>"+
                "  <span style='float:left;margin-top:20px;'><label class='mycheckbox' style='margin-left:5px;margin-right:15px;'><input id='checkbox_channel_default' type='checkbox' "+checkbox_channel_default+"><span class='checkmark'></span></label></span>"+
                "  <span style='float:left;margin-top:20px;'><text >학습관리 수정</text></span>"+
                "  <span style='float:left;margin-top:20px;'><label class='mycheckbox' style='margin-left:5px;margin-right:15px;'><input id='checkbox_channel_study' type='checkbox' "+checkbox_channel_study+"><span class='checkmark'></span></label></span>"+
                "</div><br>";
            
            color_bg = toggle_createkey == "checked" ? "#F1FAFF" : "cccccc";
            var create_key_tag = 
                "<br><div style='display:flex;'><label for='subscription_path' style='text-align:left;width:100%;float:left;font-size:16px'>채널키만들기 권한</label>"+create_key_toggle_tag+"</div><br>"+
                "<div id='div_checkbox_createkey' style='width:100%;height:60px;border-radius:5px;background-color:"+color_bg+";padding-left:20px'>"+
                "   <span style='float:left;margin-top:20px;'><text >도메인 추가</text></span>"+
                "   <span style='float:left;margin-top:20px;'><label class='mycheckbox' style='margin-left:5px;margin-right:15px;'><input id='checkbox_add_domain' type='checkbox' "+checkbox_add_domain+"><span class='checkmark'></span></label></span>"+
                "   <span style='float:left;margin-top:20px;'><text >도메인 삭제</text></span>"+
                "   <span style='float:left;margin-top:20px;'><label class='mycheckbox' style='margin-left:5px;margin-right:15px;'><input id='checkbox_delete_domain' type='checkbox' "+checkbox_delete_domain+"><span class='checkmark'></span></label></span>"+
                "</div><br>";
            var tag = 
                "<div style='width:100%;height:auto;border-radius:0 10px 10px 10px ;border:1px solid #eeeeee;padding:20px;'>"+
                "   <div >"+
                        channel_tag+
                "   </div>"+
                "   <br>"+
                "   <div>"+
                        create_key_tag+
                "   </div>"+
                "</div>";
            return tag;
         
        }   
        function savePermissions(idx){
            console.log("권한수정버튼클릭 "+idx);
            var toggle_channel = document.getElementById("toggle_channel").checked;//채널생성권한 ON/Off
            var checkbox_channel_new_channel = document.getElementById("checkbox_channel_new_channel").checked;//신규 채널생성 권한
            var checkbox_channel_remove_channel = document.getElementById("checkbox_channel_remove_channel").checked;//채널삭제 권한
            var checkbox_channel_default = document.getElementById("checkbox_channel_default").checked;// 개본설정 수정
            var checkbox_channel_study = document.getElementById("checkbox_channel_study").checked;//학습관리 수정
            
            var toggle_createkey = document.getElementById("toggle_createkey").checked;//채널키 만들기 권한 ON/OFF
            var checkbox_add_domain = document.getElementById("checkbox_add_domain").checked;//도메인 추가
            var checkbox_delete_domain = document.getElementById("checkbox_delete_domain").checked;//도메인 삭제
            
            
            var user_idx = accounts[idx].mem_idx;
            var user_setting = {"channel":{},"createkey":{}};
            user_setting["channel"] = {"toggle":toggle_channel, "new_channel":checkbox_channel_new_channel, "remove_channel":checkbox_channel_remove_channel,"edit_default":checkbox_channel_default,"edit_study":checkbox_channel_study };
            user_setting["createkey"] = {"toggle":toggle_createkey, "add_domain":checkbox_add_domain, "delete_domain":checkbox_delete_domain};
            console.log("user_setting :",user_setting);
            
            var _data = {
                    "idx": user_idx,
                    "setting":user_setting                   
                };
            updatePermissionUser(_data,function(res){
                    code = parseInt(res.code);
                    if (code == 100) {

                         alertMsg(res.message);

                    } else {
                        //
                         alertMsg(res.message);
                    }
                },function(err){
                     alertMsg("네트워크 에러 ");
                });
        }
        
        function togglechange(name, txt_off,txt_on) {

            var toggle_title_ = document.getElementById("toggle_title_"+name); //글자바꾸기
            var toggle = document.getElementById("toggle_"+name);
            var toggle_icon = document.getElementById("toggle_icon_"+name);
            
            if (toggle.checked) {
                toggle_icon.style.backgroundColor = "#33aaaa";
                
                toggle_title_.innerHTML = txt_on;
            } else {
                toggle_icon.style.backgroundColor = "#cccccc";
                toggle_title_.innerHTML = txt_off;
            }
            
            if(name == "channel"){
                updateCheckBox(name,toggle.checked);
            }else if(name == "createkey"){
                updateCheckBox(name,toggle.checked);
            }
        }
         function updateCheckBox(name, toggle_checked){
            var div_checkbox_ = document.getElementById('div_checkbox_'+name);
            div_checkbox_.style.backgroundColor = toggle_checked ? "#F1FAFF" : "#cccccc";
            setDivElementsDisabled("div_checkbox_"+name,!toggle_checked);
        }
        /*하위 Element Disabled Enabled*/
        function setDivElementsDisabled(divId, isDisabled) {
            // div 요소 가져오기
            var div = document.getElementById(divId);

            if (!div) {
                console.error(`Div with id "${divId}" not found.`);
                return;
            }

            // 모든 하위 요소 가져오기
            var elements = div.querySelectorAll("*");

            // 하위 요소를 순회하며 disabled 속성 설정
           
            elements.forEach(element => {
                 console.log("element tagNAme "+element.tagName);
                if (element.tagName === "INPUT" || element.tagName === "BUTTON" || element.tagName === "SELECT" || element.tagName === "TEXTAREA") {
                    element.disabled = isDisabled;
                }
            });
        }
        function btn_register_sub(_data){
                
            var title_tag = "<label style='color:#181c32'>계정추가</label>";
            
            showModalDialog(document.body, title_tag,  "<label style='font-size:16px;font-weight:600;color:#181c32'>부계정 "+_data.name+"("+_data.email+")를 추가하시겠습니까?</label><br><br>" , "추가하기", "취소", function() {
                    
                    btn_register_send_sub(_data);
                    hideModalDialog();
                }, function() {
                    hideModalDialog();
                }, null);
            
        }
        function deleteAccount(email){
            var title_tag = "<label style='color:#181c32'>[경고]부계정 삭제</label>";
            
            showModalDialog(document.body, title_tag,  "<label style='font-size:16px;font-weight:600;color:#181c32'>부계정 ("+email+")를 삭제하시겠습니까? 해당계정은 복구할 수 없습니다. 신중하게 선택하세요.</label><br><br>" , "삭제하기", "취소", function() {
                    
                deleteSubAccount(email);
                hideModalDialog();
            }, function() {
                hideModalDialog();
            }, null);
            
        }
        function deleteSubAccount(email){


              deleteSubAccountCheck(email,function(res){
                    code = parseInt(res.code);
                    if (code == 100) {

                         alertMsg(res.message);

                    } else {
                        //
                         alertMsg(res.message);
                    }
                },function(err){
                     alertMsg("네트워크 에러 ");
                });
        }
        function btn_register_send_sub(_data) {

            //         var name = $("#join-us input[name=name]").val();
//          
            var company_name = session_groupname;
            console.log("company_name : "+company_name);
            var name = spaceRemove(_data.name);
//            var yy = document.getElementById('yy').value;
//            var mm = document.getElementById('mm').value < 10 ? "0" + document.getElementById('mm').value : document.getElementById('mm').value;
//            var dd = document.getElementById('dd').value < 10 ? "0" + document.getElementById('dd').value : document.getElementById('dd').value;
//            var birth = yy + mm + dd + "";
//
            var email = spaceRemove(_data.email);
            var phone = _data.phone;
//            var gender_m = document.getElementById('gender_m');
//            var gender_f = document.getElementById('gender_f');
//            var gender = gender_m.checked ? "M" : "F";
            var pass1 = spaceRemove(_data.pass1);
            var pass2 = spaceRemove(_data.pass2);
            
            
            
            if(isuse_email){
                if (email == "") {
                    alertMsg("이메일을 입력해 주세요");
                    return;
                }else if(!isuse_confirm_email){
                    alertMsg("코드가 잘못되었습니다.");
                    return;
                }
                var _data = {
                    "email": email + ""
                   
                };

                changeRegisterCheck(_data,function(res){
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
                
            }else{
                
            
            
           
                if (company_name == "") {
                    alertMsg("업체명을 입력해 주세요");
                    return;
                }
                else if (!name) {
                    alertMsg("이름을 입력해 주세요");
                    return;
                }
    //            else if (yy == "") {
    //                alertMsg("년을 입력해 주세요");
    //                return;
    //            }
    //            else if (mm == "") {
    //                alertMsg("월을 입력해 주세요");
    //                return;
    //            }
    //            else if (dd == "") {
    //                alertMsg("일을 입력해 주세요");
    //                return;
    //            }
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

                addRegisterCheck(_data,function(res){
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
    }
    //현재 등록된 Accounts 에 이미 이메일이 있는지 체크
    function isInEmail(input_email){
        var flg = false;
        for(var i = 0 ; i < accounts.length;i++){
            if(accounts[i].mem_email == input_email)
                flg = true;
        }
        return flg;
    }    
    
    function isEmail(id){
        
        var txt_email_subdesc = document.getElementById("txt_email_subdesc");
        var input_email = document.getElementById(id).value;
        
        if(input_email == global_email){
            txt_email_subdesc.style.display = "block";
            txt_email_subdesc.innerHTML = "현재 계정과 같은 이메일은 등록할 수 없습니다.";
            return;
        }
        else if(isInEmail(input_email)){
            txt_email_subdesc.style.display = "block";
            txt_email_subdesc.innerHTML = "이미 등록된 이메일은 등록할 수 없습니다.";
            return;
        }
        
        inputIsEmail(id,function(res){
            var btn_send_emailcode = document.getElementById("btn_send_emailcode");//DB에 이메일없다.
            var sub_table = document.getElementById("sub_table");
            
            //이메일 DB에 있다.
            if(res == 0){
                
                isuse_email = true;
                btn_send_emailcode.style.display = "block";
                txt_email_subdesc.style.display = "block";
                sub_table.style.display = "none";
                txt_email_subdesc.innerHTML = "등록된 이메일이 있습니다.";

            }            
            //이메일 DB에 없다.
            else {
                isuse_email = false;
                btn_send_emailcode.style.display = "block";
                sub_table.style.display = "block";
                txt_email_subdesc.style.display = "block";
                txt_email_subdesc.innerHTML = "정보가 없습니다. Email 인증을 해주세요";
            }
           

        },true);
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
