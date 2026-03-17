<?php  
include('./common'); 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/gif/png" href="img/black_arc_logo.png">
    <title>Push Message</title>
    <!--   signature about -->

    <link href="./css/toast.css" rel="stylesheet">
    <link href="./css/modaldialog.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <!--    <link href="signature/assets/jquery.signaturepad.css" rel="stylesheet">-->
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>

<!--    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js?ver3.00a"></script>


</head>

<body class="sb-nav-fixed" style="background-color: #f5f5f5;">



    <!--push Us Form-->
    <!--<button type="button" class="btn btn-lg btn-block btn-outline-primary col-8 offset-2" data-toggle="collapse" data-target="#push"><h1 class="display-4">aaaWish to step</h1><h1 class="display-4"> forward with us?</h1></button>-->
    <div id="div_main" style="margin-top:60px" >
        <br><br>
        <div id="push">
            <div class="container">
                <h1 align="center" class="display-5">푸시 메세지 보내기</h1>

                <form action="#" method="post" id="push-us" target="iframe1">

                    <div class="form-group row">
                        <div id=formdiv class="col-8 offset-2">


                            <label for="id_title">제목</label>
                            <input type="text" class="form-control" id="id_title" name="id_title" placeholder="메세지 제목을 입력하세요" required /><br>
                            <label for="id_message">보낼 메세지 내용</label>
                            <textarea id="id_message" class="form-control" name="id_message" placeholder="메세지 내용을 입력하세요.." style="height:140px; " required></textarea><br>

                            <!--===============================-->
                            <!--개인 ,그룹 선택하기-->
                            <!--===============================-->
                            <label for="push_type">메세지보낼 대상</label><br>
                            <select id="push_type" class="form-control" onchange="changeType()" name="push_type">
                                <option value="1">개인으로 보내기</option>
                                <option value="2">그룹으로 보내기</option>
                            </select><br>


                            <div id="div_group" style="display:none">

                                <label for="push_group">그룹 선택</label><br>
                                <select id="push_group" class="form-control" onchange="changeGroup()" name="push_group" required>
                                    <option value="">== 그룹을 선택하세요 ==</option>
                                </select><br>
                            </div>

                            <div id="div_center" style="display:none">
                                <label for="push_center">센터 선택</label><br>

                                <select id="push_center" class="form-control" onchange="changeCenter()" name="push_center" required>
                                    <option value='0'>센터전체</option>
                                </select><br>
                            </div>

                            <div id="div_auth" style="display:none">
                                <label for="push_auth">등급 선택</label><br>
                                <select id="push_auth" class="form-control" onchange="changeAuth()" name="push_auth" required>
                                    <option value="">== 등급을 선택하세요 ==</option>
                                    <option value="all">전체</option>
                                    <option value="admin">관리자</option>
                                    <option value="user">일반고객</option>
                                </select><br>
                            </div>

                            <div id="div_username" style="display:none">
                                <label for="push_username">고객 선택</label><br>
                                <select id="push_username" class="form-control" onchange="changeUser()" name="push_username">
                                    <option value="">== 고객을 선택하세요 ==</option>
                                </select><br>
                            </div>
                            <div id="div_users" style="display:none" class="form-control" name="div_users"></div>


                            <br><br>

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
    <div id="div_top"></div>
    <div id="div_nav"></div>
    <div id="div_bottom"></div>


    
    <script>
        //토스트 DIV 영역 생성
        initToastDiv();
        
        var pushdata = {};
        var div_group = document.getElementById('div_group');
        var div_center = document.getElementById('div_center');
        var div_auth = document.getElementById('div_auth');
        var div_username = document.getElementById('div_username');
        var div_users = document.getElementById('div_users');
        $(document).ready(function() {
            
           
            
            clog("readyddd");
            var _data = {
                "type": "group" // group or center or auth
            };
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                clog("aaa",res);
                if (code == 100) {

                    var push_group = document.getElementById('push_group');
                    push_group.innerHTML = "<option value=''>== 그룹을 선택하세요 ==</option>";
                    var arr = res.message;
                    
                    for (var i = 0; i < arr.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = arr[i].groupcode;
                        opt.innerHTML = arr[i].groupcode;
                        push_group.appendChild(opt);
                    }


                    div_group.style.display = "block";

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });
        });
        //메세지 보낼 대상 클릭시
        function changeType() {
            var push_username = document.getElementById('push_username');
            var push_type = document.getElementById('push_type').value;
            document.getElementById('push_group').selectedIndex = "0";
            if (push_type == 1) {
                push_username.style.display = "block";
                div_username.style.display = "block";
                div_users.style.display = "block";
            } else {
                push_username.style.display = "none";
                div_username.style.display = "none";
                div_users.style.display = "none";
            }
        }
        //그룹 선택 클릭시 
        function changeGroup() {
            var push_username = document.getElementById('push_username');
            var group_value = document.getElementById('push_group').value;
            var _data = {
                "type": "center", // group or center or auth
                "group": group_value
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {

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
                    }


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
        function changeCenter() {

            div_auth.style.display = "block";
            push_auth.selectedIndex = "0";
            div_users.innerHTML = "";
            push_username.innerHTML = "<option value=''>== 고객을 선택하세요 ==</option>";
        }
        //등급 선택 클릭시
        function changeAuth() {

            div_auth.style.display = "block";
            //개인으로 보내기
            if (document.getElementById('push_type').value == 1) {
                var group_value = document.getElementById('push_group').value;
                var center_value = document.getElementById('push_center').value;
                var push_auth = document.getElementById('push_auth').value;
                if (push_auth == "") {
                    alertMsg("등급을 선택하세요");

                    return;
                }
                var _data = {
                    "type": "name", // group or center or auth or name
                    "group": group_value,
                    "center": center_value,
                    "auth": push_auth
                };



                CallHandler("getdata", _data, function(res) {
                    code = parseInt(res.code);
                    if (code == 100) {

                        var push_username = document.getElementById('push_username');

                        push_username.innerHTML = "<option value=''>== 고객을 선택하세요 ==</option>";
                        var names = res.message;
                        for (var i = 0; i < names.length; i++) {
                            var opt = document.createElement('option');
                            opt.value = names[i]["userid"];
                            opt.innerHTML = names[i]["username"];
                            push_username.appendChild(opt);
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
                //div_auth.style.display = "block";
            }


        }
        // 고객 선택 클릭시
        function changeUser() {

            clog("push_username ",push_username);
            var push_username = document.getElementById('push_username');
            if (push_username.value == "") {
                alertMsg("고객을 선택하세요");
                return;
            }

            div_users.style.display = "block";
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
            if (!flg) div_users.innerHTML += "<div id = '" + value + "'><input class='checkboxgroup' checked='true' type='checkbox' name='" + text + "' value='" + value + "'>&nbsp;" + text + "&nbsp;&nbsp;&nbsp;</div>"

        }

        $("#push-us").submit(function(event) {

            var title = document.getElementById('id_title').value;
            var message = document.getElementById('id_message').value;
            var clickaction = ""; // 추후에 삽입할 예정임


            var push_group = document.getElementById('push_group').value;
            var push_center = document.getElementById('push_center').value;
            var push_auth = document.getElementById('push_auth').value;



            //개인으로 보낼때
            if (document.getElementById('push_type').value == 1) {
                var users = div_users.childNodes;
                var arr = [];

                for (var i = 0; i < users.length; i++)
                    arr.push(users[i].id);

                if (arr.length == 0) {
                    alertMsg("고객을 최소 1명이상 선택하세요");
                    return;
                }
                pushdata = {
                    "title": title,
                    "message": message,
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
                    if (push_auth == "all")
                        topic += "_ALL";
                    else if (push_auth == "admin")
                        topic += "_ADMIN";
                    else if (push_auth == "user")
                        topic += "_NORMAL";
                }

                pushdata = {
                    "title": title,
                    "message": message,
                    "clickaction": clickaction,
                    "topic": topic
                };
            }

            var modal_message = document.getElementById("modal_body");
            modal_message += "<p align='center'>제목:" + title + "</p>";
            modal_message += "<p align='center'>내용:" + message + "</p>";
            if (document.getElementById('push_type').value == 1) {
                var namearr = [];
                for (var i = 0; i < users.length; i++)
                    namearr.push(users[i].innerText);
                modal_message += "<p align='center'>보낼사람들:" + namearr + "</p>";
            } else
                modal_message += "<p align='center'>보낼그룹:" + topic + "</p>";
           
            
             showModalDialog(document.body,"아래 내용으로 메세지를 보내시겠습니까?", modal_message , "보내기", "취소",function(){
               
                push_check();
                
            },function(){
                hideModalDialog();
               
            });



        });

        function push_check() { //사용하지 않는파일 XXX 
            CallHandler("push_message", pushdata, function(res) {
//                clog("res is ", res);
                code = parseInt(res.code);
                if (code == 100) {

//                    $("#myModal").modal("hide");
//                    $("#end_modal").modal({
//                        keyboard: false,
//                        backdrop: 'static'
//                    });

                    hideModalDialog();
                    showModalDialog(document.body,"메세지 보내기 성공!", "푸시 메세지를 성공적으로 보냈습니다!" , "OK", null,function(){
                        refresh_page();
                    });


                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");

            });
        }




        function init(issession) {
            $("#div_top").load("header", function() {
                $("#div_nav").load("nav", function() {

                    //상단 타이틀바 로그인 했는지 안했는지 처리
                    uiinit(issession, usernamedesc);
                    //토스트 리스너 시작
                    startBeaconLog();

//                    //test
//                    C_showToast("dsadf","title","message fdsfds ");
                });
            });
        }

    </script>
</body>

</html>
<?php
    if($session != null && $auth != null && $auth >= AUTH_MANAGER){
        echo "<script>init($auth);</script>";
    }
?>
