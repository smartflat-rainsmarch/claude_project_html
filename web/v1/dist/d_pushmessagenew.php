 <!--push Us Form-->
    <!--<button type="button" class="btn btn-lg btn-block btn-outline-primary col-8 offset-2" data-toggle="collapse" data-target="#push"><h1 class="display-4">aaaWish to step</h1><h1 class="display-4"> forward with us?</h1></button>-->
    <div id="div_push" style="margin-top:60px" >
        <br><br>
        <div id="push">
            <div class="container">
                <h1 align="center" class="display-5"><img src='./img/icon_title.png'/>&nbsp;푸시 메세지 보내기</h1>

                <form action="#" method="post" id="pushmessage_form" target="iframe1">

                    <div class="form-group row">
                        <div id=formdiv class="col-8 offset-2">


                            <label for="id_title" class='text_style'>제목</label>
                            <input type="text" class="form-control" id="id_title" name="id_title" placeholder="메세지 제목을 입력하세요" required /><br>
                            <label for="id_message" class='text_style'>보낼 메세지 내용</label>
                            <textarea id="id_message" class="form-control" name="id_message" placeholder="메세지 내용을 입력하세요.." style="height:140px; " required></textarea><br>

                            <!--===============================-->
                            <!--개인 ,그룹 선택하기-->
                            <!--===============================-->
                            <label for="push_type" class='text_style'>메세지보낼 대상</label><br>
                            <select id="push_type" class="form-control" onchange="changeType()" name="push_type">
                                <option value="2">그룹으로 보내기</option>
                                <option value="1">개인으로 보내기</option>
                                
                            </select><br>


                            <div id="div_group" style="display:none">

                                <label for="push_group" class='text_style'>그룹 선택</label><br>
                                <select id="push_group" class="form-control" onchange="pChangeGroup()" name="push_group" required>
                                    <option value="">== 그룹을 선택하세요 ==</option>
                                </select><br>
                            </div>

                            <div id="div_center" style="display:none">
                                <label for="push_center" class='text_style'>센터 선택</label><br>

                                <select id="push_center" class="form-control" onchange="pChangeCenter()" name="push_center" required>
                                    <option value='0'>센터전체</option>
                                </select><br>
                            </div>

                            <div id="div_auth" style="display:none">
                                <label for="push_auth class='text_style'" class='text_style'>등급 선택</label><br>
                                <select id="push_auth" class="form-control" onchange="changeAuth()" name="push_auth" required>
                                    <option value="">== 등급을 선택하세요 ==</option>
                                    <option value="all">전체</option>
                                    <option value="admin">관리자</option>
                                    <option value="user">일반고객</option>
                                    <option value="custom_allmember">전체회원</option>
                                    <option value="custom_paidmember">유효회원</option>
                                    <option value="custom_endmember">수강종료예정자</option>
                                    <option value="custom_outmember">수강종료후미등록자</option>
                                    <option value="custom_todaymember">입실자목록</option>
                                    <option value="custom_delaymember">수강연기자</option>
                                    
                                </select><br>
                            </div>

                            <div id="div_username" style="display:none">
                                <label for="push_username" class='text_style'>고객 선택</label><br>
                                <select id="push_username" class="form-control" onchange="changeUser()" name="push_username">
                                    <option value="">== 고객을 선택하세요 ==</option>
                                </select><br>
                            </div>
                            <div id="div_users" style="display:none" class="form-control" name="div_users"></div>

                            <text id='txt_notice' style='color:red;display:none'>※ 그룹보내기에서 전체 , 관리자 ,일반고객 선택으로 보낼때는 주제별 금액이 적용됩니다.</text>
                            <br>
                            
                            <br>

                            <p align="right"><button type="submit" name="submit" class="btn btn-primary btn-raised">푸시 메세지 보내기</button></p>
                            <br><br>
                        </div>
                    </div>
                </form>
                <iframe name="iframe1" style="display:none;"></iframe>


            </div>

        </div>
    </div>


    <!--===========================-->
    <!--반드시 삽입해야함-->
    <!--===========================-->


    
    <script>

        
        var pushdata = {};
        var div_group = document.getElementById('div_group');
        var div_center = document.getElementById('div_center');
        var div_auth = document.getElementById('div_auth');
        var div_username = document.getElementById('div_username');
        var div_users = document.getElementById('div_users');
        
        var txt_notice = document.getElementById("txt_notice");
        var custom_data_user = [];
//        $(document).ready(function() {
          function init_d_pushmessagenew(value){   
           
            
            txt_notice.innerHTML = "※ 그룹보내기에서 (전체 or 관리자 or 일반고객) 으로 보낼때는 주제별 금액 ("+TXT_WON+" "+global_topic_sendprice+") 이 적용됩니다.";
            clog("ready");
            var _data = {
                "type": "group" // group or center or auth
            };
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {
                    var group_code = getData("nowgroupcode");
                    var push_group = document.getElementById('push_group');
                    if(!push_group)return;
                    push_group.innerHTML = "<option value=''>== 그룹을 선택하세요 ==</option>";
                    var arr = res.message;
                    
                    for (var i = 0; i < arr.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = arr[i].groupcode;
                        opt.innerHTML = arr[i].groupcode;
                        push_group.appendChild(opt);
                        
                        if(group_code && group_code == arr[i].groupcode){
                            opt.selected = true;
                        }
                    }

                    if(push_group.value)pChangeGroup();
                    div_group.style.display = "block";

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });
              
              
              
        }
        //메세지 보낼 대상 클릭시
        function changeType() {
            var push_username = document.getElementById('push_username');
            var push_type = document.getElementById('push_type').value;
            
            if (push_type == 1) {
                push_username.style.display = "block";
                div_username.style.display = "block";
                div_users.style.display = "block";
            } else {
                push_username.style.display = "none";
                div_username.style.display = "none";
                div_users.style.display = "none";
            }
            pChangeGroup();
        }
        //그룹 선택 클릭시 
        function pChangeGroup() {
            var push_username = document.getElementById('push_username');
            var group_value = document.getElementById('push_group').value;
            var _data = {
                "type": "center", // group or center or auth
                "group": group_value
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {
                    var center_code = getData("nowcentercode");
                    var push_center = document.getElementById('push_center');
                    var push_auth = document.getElementById('push_auth');

                    push_center.innerHTML = "<option value='0'>센터전체</option>";
                    push_auth.selectedIndex = "0";
                    div_users.innerHTML = "";
                    push_username.innerHTML = "<option value=''>== 고객을 선택하세요 ==</option>";

                    var arr = res.message;
                    for (var i = 0; i < arr.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = arr[i]["centercode"];
                        opt.innerHTML = arr[i]["centername"];
                        push_center.appendChild(opt);
                        if(center_code && center_code == arr[i]["centercode"]){
                            opt.selected = true;
                        }
                    }

                    if(push_center.value)pChangeCenter();
                    div_center.style.display = "block";

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });
            div_group.style.display = "block";

        };
        //센터 선택 클릭시
        function pChangeCenter() {
            var push_type = document.getElementById("push_type");
            div_auth.style.display = "block";
           
            if(push_type.value == "1"){
                //개인으로 보내기
                push_auth.innerHTML = "<option value=''>== 등급을 선택하세요 ==</option>"+
                                    "<option value='all'>전체</option>"+
                                    "<option value='admin'>관리자</option>"+
                                    "<option value='user'>일반고객</option>";                              
            }else{
                //그룹으로 보내기
                push_auth.innerHTML = "<option value=''>== 등급을 선택하세요 ==</option>"+
                                    "<option value='all'>전체</option>"+
                                    "<option value='admin'>관리자</option>"+
                                    "<option value='user'>일반고객</option>"+
                                    "<option value='data_all_member'>전체회원</option>"+
                                    "<option value='data_paid_member'>유효회원</option>"+
                                    "<option value='data_end_member'>수강종료예정자</option>"+
                                    "<option value='data_out_member'>수강종료후미등록자</option>"+
                                    "<option value='data_today_member'>당일입실자</option>"+
                                    "<option value='data_delay_member'>수강연기자</option>";
            }
            push_auth.selectedIndex = "0";
            div_users.innerHTML = "";
            push_username.innerHTML = "<option value=''>== 고객을 선택하세요 ==</option>";
        }
        //등급 선택 클릭시
        function changeAuth() {

            div_auth.style.display = "block";
            var push_auth = document.getElementById('push_auth');
                
            //개인으로 보내기
            if (document.getElementById('push_type').value == 1) {
                txt_notice.style.display = "none";
                var group_value = document.getElementById('push_group').value;
                var center_value = document.getElementById('push_center').value;
                
                if (push_auth.value == "") {
                    alertMsg("등급을 선택하세요");

                    return;
                }
                var _data = {
                    "type": "name", // group or center or auth or name
                    "group": group_value,
                    "center": center_value,
                    "auth": push_auth.value
                };



                CallHandler("getdata", _data, function(res) {
                    code = parseInt(res.code);
                    if (code == 100) {

                        var push_username = document.getElementById('push_username');

                        push_username.innerHTML = "<option value=''>== 고객을 선택하세요 ==</option>";
                        var names = res.message;
                        for (var i = 0; i < names.length; i++) {
                            clog(names[i]["username"]+"  opt.value = names[i] "+ names[i]["userid"]);
                            if(names[i]["userid"] != "" && names[i]["userid"] != "null" && names[i]["userid"] != null){
                                var opt = document.createElement('option');
                                opt.value = names[i]["userid"]; //fcmtoken값이다.
                                opt.innerHTML = names[i]["username"];
                                push_username.appendChild(opt);    
                            }
                            
                        }

                        div_username.style.display = "block";
                        div_users.innerHTML = "";

                    } else {
                        alertMsg(res.message);
                    }

                }, function(err) {
                    alertMsg("네트워크 에러 ");

                });


            }
            //그룹으로 보내기
            else {
                 if(push_auth.value == "all" || push_auth.value == "admin" || push_auth.value == "user")txt_notice.style.display = "block";
                else txt_notice.style.display = "none";
                clog("div_auth.value ",push_auth.value);
                if(push_auth.value.indexOf("data_") >= 0){
                    custom_data_user = [];
                    
                    var key = push_auth.value;
                    switch(key){
                        case "data_all_member":
                            break;
                        case "data_paid_member":
                            break;
                        case "data_end_member":
                            break;
                        case "data_out_member":
                            break;
                        case "data_today_member":
                            break;
                        case "data_delay_member":
                            break;
                            
                    }
                    
                    var id_statistic_starttime = document.getElementById("id_statistic_starttime").value;
                    var id_statistic_endtime = document.getElementById("id_statistic_endtime").value;
                    
                    if(id_statistic_starttime == "" || id_statistic_endtime == ""){
                        if(key == "data_end_member" || key == "data_delay_member" ){
                            alertMsg("시작일과 종료일을 모두 입력해 주세요");
                            return;   
                        }else if(key == "data_today_member" || key == "data_out_member"){
                            if(id_statistic_starttime && id_statistic_starttime != id_statistic_endtime){
                                alertMsg("시작일과 종료일을 같은날짜로 입력해주세요.");
                            return;   
                            }
                        }                      
                    }
                    getStatisticData("statistic", key, id_statistic_starttime, id_statistic_endtime, function(res) {
            //             clog("statistic res is ", res);
                         var code = parseInt(res.code);
                         if (code == 100) {
            //                 document.getElementById("table_div").style.display = "block";
                             if(key == "data_paid_member" || key == "data_today_member"){
                                 res.message = checkPaidMember(res.message);
                             }
                             custom_data_user = res.message;
                         }                        
                     });
                }
            }


        }
        // 고객 선택 클릭시
        function changeUser() {

            
            var push_username = document.getElementById('push_username');
             clog("push_username ",push_username);
             clog("push_username ",push_username.value);
            if (push_username.value == "" || push_username.value == "null") {
                alertMsg("토큰값이 없어 보낼 수 없는 고객입니다.");
                return;
            }

            div_users.style.display = "block";
            div_users.style.height = "auto";
            var text = push_username.options[push_username.selectedIndex].text;
            var value = push_username.value;
            //                    clog("value is ",value);
            var arr = div_users.childNodes;
            //                    clog("arr is ",arr);

            var flg = false;
            for (var i = 0; i < arr.length; i++) {

                if (arr[i].id == value) {
                    flg = true;
                    break;
                }
            }
            if (!flg) div_users.innerHTML += "<span><ui id = '" + value + "'><input class='checkboxgroup' checked='true' type='checkbox' name='" + text + "' value='" + value + "'>&nbsp;" + text + "&nbsp;&nbsp;&nbsp;</ui></span>";

        }

        $("#pushmessage_form").submit(function(event) {

            var title = document.getElementById('id_title').value;
            var message = document.getElementById('id_message').value;
            var clickaction = ""; // 추후에 삽입할 예정임


            var push_group = document.getElementById('push_group').value;
            var push_center = document.getElementById('push_center').value;
            var push_auth = document.getElementById('push_auth');
            var txt_push_auth_name = push_auth.options[push_auth.selectedIndex].text;

            var arr = [];
            //개인으로 보낼때
            if (document.getElementById('push_type').value == 1) {
                var users = div_users.childNodes;
               

                for (var i = 0; i < users.length; i++)
                    arr.push(users[i].children[0].id);

                if (arr.length == 0) {
                    alertMsg("고객을 최소 1명이상 선택하세요");
                    return;
                }
                var push_titles = [];
                var push_messages = [];
                push_titles.push(title);
                push_messages.push(message);
                pushdata = {
                    "groupcode":push_group,
                    "centercode":push_center,
                    "titles": push_titles,
                    "messages": push_messages,
                    "tokens": arr,
                    "clickaction": clickaction
                };
            }

            //그룹으로 보낼때 
            else {
                var topic = "";
                if (push_group == "global")
                    topic = "ALL";
                else {
                    topic = push_group;

                    //센터코드 선택
                    if (push_center > 0)
                        topic += "_" + push_center;


                    //등급 선택
                    if (push_auth.value == "all")
                        topic += "_ALL";
                    else if (push_auth.value == "admin")
                        topic += "_ADMIN";
                    else if (push_auth.value == "user")
                        topic += "_NORMAL";
                    
                }

                //그룹 전체 , 관리자 , 일반회원 
                if(push_auth.value.indexOf("data_") >= 0){
                    for (var i = 0; i < custom_data_user.length; i++){
                        var token = custom_data_user[i].mem_fcmtoken;
                        
                        //토큰값은 길기때문에 토큰값이 있는사람들만 보낸다.
                        if(token && token.length > 10)
                            arr.push(custom_data_user[i].mem_fcmtoken);
                    }
                        

                    pushdata = {
                        "groupcode":push_group,
                        "centercode":push_center,
                        "title": title,
                        "message": message,
                        "tokens": arr,
                        "clickaction": clickaction
                    };    
                }
                //커스텀 회원들에게 보낼때
                else{
                    pushdata = {
                        "groupcode":push_group,
                        "centercode":push_center,
                        "title": title,
                        "message": message,
                        "clickaction": clickaction,
                        "topic": topic
                    };
                }
                
            }

            var modal_message = document.getElementById("modal_body");
            modal_message = "<label class='text_style'>*제목</label><p align='center'>" + title + "</p>";
            modal_message += "<br><label class='text_style'>*내용</label><p align='center'>" + message + "</p>";
            if (document.getElementById('push_type').value == 1) {
                var namearr = [];
                for (var i = 0; i < users.length; i++)
                    namearr.push(users[i].innerText);
                modal_message += "<br><label class='text_style'>*보낼사람들</label><p align='center'>" + namearr + "</p>";
            } else {
                
                modal_message += "<br><label class='text_style'>*보낼그룹</label><p align='center'>" + txt_push_auth_name + "</p>";
            }
                
           
            var date_body = "<label>●시작일 :</label>&nbsp;&nbsp;&nbsp;"+ 
                                            "<input id = 'push_starttime' onchange='check_pushdate()' type='date' style='width:140px' value='"+getToday()+"'/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label >●종료일 :</label>"+ 
                                            "<input id = 'push_endtime' onchange='check_pushdate()' type='date' style='width:140px' value='"+getToday()+"'/>";
                                   
            console.log("aa");
            showModalDialog(document.body,"메세지 기간을 선택해 주세요.", date_body , "확인", "취소",function(){
                var push_starttime = document.getElementById("push_starttime").value;
                var push_endtime = document.getElementById("push_endtime").value;
                if(isToday(push_endtime) == 1)
                    alertMsg("종료일이 오늘 이전입니다.");
                else if(compareDay(push_starttime,push_endtime) < 0)
                    alertMsg("종료일이 시작일보다 작습니다.");
                else {
                    send_msg(modal_message,message);
                }
            },function(){
                hideModalDialog();
            });

        });
        function send_msg(modal_message,message){
            showModalDialog(document.body,"아래 내용으로 메세지를 보내시겠습니까?", modal_message , "보내기", "취소",function(){
               
                if(pushdata.tokens && sendPointCheck(0,pushdata.tokens.length,message) || pushdata.topic && sendPointCheck(0,0,message,true)){
//                    push_check(pushdata,function(res){
                    var len = pushdata.tokens.length;
                    sendReservationPushMessages(getToday(), pushdata, len,function(res){
                        code = parseInt(res.code);
                        if (code == 100) {
                            hideModalDialog();
                            showModalDialog(document.body,"메세지 보내기 성공!", "푸시 메세지를 성공적으로 보냈습니다!" , "OK", null,function(){
                                refresh_page();
                            });
                        }else {
                            alertMsg(res.message);
                        }
                    },function(err){
                        alertMsg("네트워크 에러 ",err);
                    });
                }else{
                    alertMsg("보유금액이 부족합니다. 보유금액 충전이 필요합니다.");
                }
                
                
            },function(){
                hideModalDialog();               
            });
        }
        function check_pushdate(){
            var push_starttime = document.getElementById("push_starttime").value;
            var push_endtime = document.getElementById("push_endtime").value;
            if(isToday(push_endtime) == 1)
                alertMsg("종료일이 오늘 이전입니다.");
            else if(compareDay(push_starttime,push_endtime) < 0)
                alertMsg("종료일이 시작일보다 작습니다.");
        }
//        function push_check(pushdata,success,error) {
//            CallHandler("push_message", pushdata, function(res) {
//                success(res);
//            }, function(err) {
//                error(err);
//            });
//        }
</script>