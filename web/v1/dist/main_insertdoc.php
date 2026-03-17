    


    <div>

        <br>

        <div id = "table_div" style="display:none">
            <p align="center">- 엑셀문서 테이블 -</p>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="doc_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <p id = "txt_total_user" style="margin-left:20px"></p>
        </div>
        
        
        <div id = "result_table_div" style="display:none">
        <br>
        <br>
        <br>
        
            <p id="intitle" align="center">- 삽입중인 테이블 -</p>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="result_doc_table" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        </thead>
                        <tfoot>
                        </tfoot>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <p id = "result_txt_total_user" style="margin-left:20px"></p>
        </div>
        
        <hr style="border: solid 1px light-gray;">


        <br><br>
        <div id="push">
            <div class="container">
                <h1 align="center" class="display-5">고객정보 저장하기</h1>

                <br><br>
                <p align="center">*엑셀파일선택&nbsp;&nbsp;&nbsp;<input type="file" onchange="readExcel()"></p>
                <br><br>
                
                  <!--센터코드가 입력이 되면 멤버쉽 테이블을 삽입한다-->
                            <div id = "div_membership" style="display:none">
                               
                                <label for="div_membership_list" style="font-weight:bold; color:red">** 멤버쉽 타입 목록 삽입하려면 선택하세요.&nbsp;&nbsp;&nbsp;</label><button type="submit" onclick="openMembership()" class="btn btn-primary btn-raised">목록열기</button><br>
                                
                                <div id="div_membership_list" class="form-control" style="height:100px; display:none">

                                    <br>
                                    수강구분 <select id="doc_membership_type_list" onchange="selectMembership()" name="doc_membership_type_list" >

                                    </select>
                                    <tr></tr>수강명

                                    <select id="doc_membership_name_list" onchange="selectMembership()" name="doc_membership_name_list" >
                                    </select>

                                    <br><br>

                                    <div id ="div_membership_all" style="display:none">
                                    <div class="form-control" id="doc_membership_all_list" name="doc_membership_all_list" height="200px" style="height:200px">
                                    </div>
                                    <br>
                                    <p align="right"><button onclick="insertMembership()" class="btn btn-primary btn-raised">삽입하기</button></p>
                                    </div>
                                </div>
                                 <hr style="border: solid 1px light-gray;">
                            </div>
                            
                <form action="#" method="post" id="push-us" target="iframe1" style="display:none;">

                    <div class="form-group row">
                        <div id=formdiv class="col-8 offset-2" class="form-control" >

                             
                           
                            
                            <br><br>
                            <div id="div_group">

                                <label for="doc_group" style="font-weight:bold; color:blue">* 그룹 선택</label><br>
                                <select id="doc_group" class="form-control" onchange="changeGroup()" name="doc_group" required>
                                    <option value="">== 그룹을 선택하세요 ==</option>
                                </select><br>
                            </div>

                            <div id="div_center" style="display:none">
                                <label for="doc_center" style="font-weight:bold; color:blue">* 센터 선택</label><br>

                                <select id="doc_center" class="form-control"  onchange="changeCenter()"name="doc_center" required>
                                    <option value=''>== 센터를 선택하세요 ==</option>
                                </select><br>
                            </div>

<!--
                            <div id="div_usertype">
                                <label for="doc_usertype">유료회원 선택</label><br>
                                <select id="doc_usertype" class="form-control" name="doc_usertype">
                                    <option value="">선택하지 않음</option>
                                    <option value="Y">유료회원(현재이용중인고객)</option>
                                    <option value="N">종료회원(이용이종료된고객)</option>
                                    
                                </select><br>
                            </div>
-->
                            <hr style="border: solid 1px light-gray;">

                            
                          

                            <!--=======================================================================================-->
                            <div id="div_keylist">

                                <div id="div_name_key">
                                    <label for="doc_name_key" style="font-weight:bold; color:blue">* 이름 KEY 선택</label><br>
                                    <select id="doc_name_key" class="form-control" onchange="insert_keys('doc_name_key')" name="username" required>
                                    </select><br>
                                </div>
                                <div id="div_phone_key">
                                    <label for="doc_phone_key" style="font-weight:bold; color:blue">* 휴대폰 KEY 선택</label><br>
                                    <select id="doc_phone_key" class="form-control" onchange="insert_keys('doc_phone_key')" name="phone" required>
                                    </select><br>
                                </div>
                                
                                <div id="div_email_key">
                                    <label for="doc_email_key">이메일 KEY 선택</label><br>
                                    <select id="doc_email_key" class="form-control" onchange="insert_keys('doc_email_key')" name="email">
                                    </select><br>
                                </div>
                                <div id="div_birth_key">
                                    <label for="doc_birth_key">생년월일 KEY 선택</label><br>
                                    <select id="doc_birth_key" class="form-control" onchange="insert_keys('doc_birth_key')" name="birth">
                                    </select><br>
                                </div>
                                <div id="div_gender_key">
                                    <label for="doc_gender_key">성별 KEY 선택</label><br>
                                    <select id="doc_gender_key" class="form-control" onchange="insert_keys('doc_gender_key')" name="gender">
                                    </select><br>
                                </div>

                                <div id="div_constructor_key">
                                    <label for="doc_constructor_key">운동을 가르키는 담당자 KEY 선택</label><br>
                                    <select id="doc_constructor_key" class="form-control" onchange="insert_keys('doc_constructor_key')" name="constructor">
                                    </select><br>
                                </div>

                                <div id="div_regtime_key">
                                    <label for="doc_regtime_key">헬스등록일 KEY 선택</label><br>
                                    <select id="doc_regtime_key" class="form-control" onchange="insert_keys('doc_regtime_key')" name="regtime">
                                    </select><br>
                                </div>
                                <div id="div_starttime_key">
                                    <label for="doc_starttime_key">헬스시작일 KEY 선택</label><br>
                                    <select id="doc_starttime_key" class="form-control" onchange="insert_keys('doc_starttime_key')" name="starttime">
                                    </select><br>
                                </div>
                                <div id="div_endtime_key">
                                    <label for="doc_endtime_key">헬스종료일 KEY 선택</label><br>
                                    <select id="doc_endtime_key" class="form-control" onchange="insert_keys('doc_endtime_key')" name="endtime">
                                    </select><br>
                                </div>
                                <div id="div_homeaddress_key">
                                    <label for="doc_homeaddress_key">집주소 KEY 선택</label><br>
                                    <select id="doc_homeaddress_key" class="form-control" onchange="insert_keys('doc_homeaddress_key')" name="homeaddress">
                                    </select><br>
                                </div>
                                <div id="div_membership_key">
                                    <label for="doc_membership_key">수강명 KEY 선택 ex)6개월, 1년회원...</label><br>
                                    <select id="doc_membership_key" class="form-control" onchange="insert_keys('doc_membership_key')" name="membership">
                                    </select><br>
                                </div>
                                <div id="div_xp_key">
                                    <label for="doc_xp_key">운동등록횟수 선택 ex)운동등록횟수를 사용자 레벨로 변환... </label><br>
                                    <select id="doc_xp_key" class="form-control" onchange="insert_keys('doc_xp_key')" name="xp">
                                    </select><br>
                                </div>
                                <div id="div_point_key">
                                    <label for="doc_point_key">포인트로 전환할 KEY 선택 ex)출결횟수를 포인트로 변환... </label><br>
                                    <select id="doc_point_key" class="form-control" onchange="insert_keys('doc_point_key')" name="point">
                                    </select><br>
                                </div>
                                <div id="div_other_key">
                                    <label for="doc_other_key">기타 입력사항 </label><br>
                                    <select id="doc_other_key" class="form-control" onchange="insert_keys('doc_other_key')" name="other">
                                    </select><br>
                                </div>

                            </div>

                            <br><br>

                            <p align="right"><button type="submit" name="submit" class="btn btn-primary btn-raised">선택한 목록 삽입하기</button></p>
                            <br><br>
                        </div>
                    </div>

                </form>
                <iframe name="iframe1" style="display:none;"></iframe>


                <p align="center"><button id="btn_insertall" onclick="insertAllUsers()" class="btn btn-primary btn-raised" style="display:none;">모든 데이타 유저로 등록하기</button></p>
                <!-- 푸시 메세지 보내시겠습니까?  Dialog -->
<!--
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">


                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 id="usercodetitle">아래 목록으로 저장하시겠습니까?</h3>
                            </div>
                            <div id="modal_body" class="modal-body" style="text-align:center">
                                <p align="center"></p>
                                <p align="center"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" onclick="db_save_check()">저장하기</button>
                            </div>
                        </div>

                    </div>
                </div>
-->


                <!-- 푸시메세지 보내기 성공 Dialog -->
<!--
                <div id="end_modal" class="modal fade" role="dialog">
                    <div class="modal-dialog">


                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 id="usercodetitle">데이타 저장 성공!</h3>
                            </div>
                            <div class="modal-body" style="text-align:center">
                                <p id = "body_p" align="center"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" onclick="refresh_page()">OK</button>
                            </div>
                        </div>

                    </div>
                </div>
-->
                
                
            </div>

        </div>

    </div>


    <script>
        var div_group = document.getElementById('div_group');
        var div_center = document.getElementById('div_center');
        var save_key = randomString(16);
        var keydata = [];
        var all_rows = [];
        var selected_centername = "";
        
        $(document).ready(function() {
            clog("ready");
            var _data = {
                "type": "group" // group or center or auth
            };
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {

                    var doc_group = document.getElementById('doc_group');
                    doc_group.innerHTML = "<option value=''>== 그룹을 선택하세요 ==</option>";
                    var arr = res.message;
                    for (var i = 0; i < arr.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = arr[i].groupcode;
                        opt.innerHTML = arr[i].groupcode;
                        doc_group.appendChild(opt);
                    }

                } else {
                    alert(res.message);
                }

            }, function(err) {
                alert("네트워크 에러 ");

            });
            
            
            
            //modal test
//            showModalDialog(document.body,"아래 목록으로 저장하시겠습니까?", "<p align='center'>sdfdsa</p>" , "저장하기", "취소",function(){
//               
//                hideModalDialog();
//                showModalDialog(document.body,"데이타 저장 성공!", " sdafdsa그룹 dsafsd 터 DB에 성공적으로 저장하였습니다.", "OK",null,function(){
//                    hideModalDialog();
//                },function(){
//                    hideModalDialog();
//                });
//            },function(){
//                hideModalDialog();
//            });
            
        });

        function init(issession) {

            $("#div_top").load("header", function() {
                $("#div_nav").load("nav", function() {
                    uiinit(issession, usernamedesc);
                });
            });
        }
        
        $("#push-us").submit(function(event) {
            var doc_keys = [];
            var div_keylist = document.getElementById("div_keylist").children;
            
            for (var i = 0; i < div_keylist.length; i++)
                doc_keys.push(div_keylist[i].getElementsByTagName("select")[0].id);
            var str = "";
            keydata = [];
            for (var i = 0; i < doc_keys.length; i++) {

                var dockey = document.getElementById(doc_keys[i]);
                if (dockey.value != "") {
                    str += dockey.value + " ";
                    keydata.push({"key":dockey.name , "value":dockey.value});
                }
               
            }
            
            

            if (str == "") {
                alert("하나 이상의 목록을 선택하세요");
                return;
            }

//            var body = document.getElementById("modal_body");
//            body.innerHTML += "<p align='center'>" + str + "</p>";

            showModalDialog(document.body,"아래 목록으로 저장하시겠습니까?", "<p align='center'>" + str + "</p>" , "저장하기", "취소",function(){
               
                db_save_check();
                
            },function(){
                hideModalDialog();
               
            });

        });
        function openMembership(){
            
            if($("#div_membership_list").is(":visible"))
                document.getElementById('div_membership_list').style.display = "none";
            else
                document.getElementById('div_membership_list').style.display = "block";
        }
        function selectMembership(){
            var div_membership_list = document.getElementById('div_membership_list');
            
            var type_key = document.getElementById('doc_membership_type_list').value;
            var name_key = document.getElementById('doc_membership_name_list').value;
            var all_key = document.getElementById('doc_membership_all_list');
            var div_membership_all = document.getElementById('div_membership_all');
            
            var arr = [];
            
            if(type_key == "" || name_key == ""){
                div_membership_all.style.display = "none";
                div_membership_list.style.height = "100px";
            }else {
                all_key.innerHTML = "";
                div_membership_all.style.display = "block";
                div_membership_list.style.height = "350px";
            
                for(var i = 0 ; i < all_rows.length; i++){
                    arr.push(all_rows[i][type_key]+"_"+all_rows[i][name_key]+"_"+getMembershipMonthValue(all_rows[i][name_key]));                
                }
                const set = new Set(arr);
                var membership_list = [...set];

                for(var i = 0 ; i < membership_list.length; i++){
                    all_key.innerHTML+="<input style='padding-left:5em' checked='true' class='checkboxgroup' type='checkbox' name='"+membership_list[i]+"' value='"+membership_list[i]+"'>&nbsp;"+membership_list[i]+"&nbsp;&nbsp;&nbsp;";
                }
            }
            
            
        }
        function insertMembership(){
            var all_key = document.getElementById('doc_membership_all_list');
            var centercode = document.getElementById('doc_center').value;
            clog("all_key child ", all_key.children);
            var sendlist = [];
            var str = "";
            for(var i = 0 ; i < all_key.children.length; i++){
                if(all_key.children[i].checked){
                    var arr = all_key.children[i].value.split('_');                
                    sendlist.push({type:arr[0]==""?"기타":arr[0],name:arr[1]==""?"기타":arr[1],month:arr[2],use_centercode:centercode});
                    str += "<input style='padding-left:5em' checked='true' class='checkboxgroup' type='checkbox'  disabled='true' name='"+all_key.children[i].value+"' value='"+all_key.children[i].value+"'>&nbsp;"+all_key.children[i].value+"&nbsp;&nbsp;&nbsp;";
                }                
            }
//            clog("str ",str);
//            clog("sendlist ",sendlist);
            if(str == ""){
                alert("목록이 없거나 하나이상을 선택하세요.");
            }
            
            showModalDialog(document.body,"아래 목록으로 새로운 멤버쉽 테이블을 추가하시겠습니까?", str , "저장하기", "취소",function(){
               
                send_membership_data(sendlist);
                
            },function(){
                hideModalDialog();
               
            });
        }
        function getMembershipMonthValue(name){
            var month = 0;
            const month_list = ["1개월","2개월","3개월","4개월","5개월","6개월","7개월","8개월","9개월","10개월","11개월","12개월","13개월","14개월","15개월","16개월","17개월","18개월","19개월","20개월","21개월","22개월","23개월","24개월","24개월","25개월","26개월","27개월","28개월","29개월","30개월","31개월","32개월","33개월","334개월","35개월","36개월"];
            if(name.indexOf("개월") >= 0){
                for(var i = month_list.length-1; i >=0; i--){
                    if(name.indexOf(month_list[i]) >= 0){
                        month = i+1;
                        break;
                    }
                }
            }else if(name.indexOf("1년") >= 0 || name.indexOf("년회원") >= 0 ){
                month = 12;
            }
            return month;
        }
       function send_membership_data(sendlist) {
            var userdata = [];
            var groupcode = document.getElementById('doc_group').value;
            var centercode = document.getElementById('doc_center').value;
             
            
            
            var data = {
                groupcode : groupcode,
                centercode : centercode,
                membershipdata : JSON.stringify(sendlist)
            }
//            return;
            CallHandler("insert_xlsx_membershipdata", data, function(res) {
                clog("res is ",res);
                code = parseInt(res.code);
                if (code == 100) {

                    
//                    document.getElementById("body_p").innerHTML = groupcode+" 그룹 "+selected_centername+" 센터 DB에 성공적으로 저장하였습니다.";
//                    $("#myModal").modal("hide");
//                    $("#end_modal").modal({ keyboard: false, backdrop: 'static' });

                    hideModalDialog();
                    insert_result_table(all_rows);
                    alert("데이타 저장 성공.  "+groupcode+" 그룹 "+selected_centername+" 센터 DB에 성공적으로 저장하였습니다.");
                    
//                    $('html, body').animate({ scrollTop: 700 }, 'fast');
//                    window.location.hash = '#result_table_div';
//                    $.scrollTo($('#result_table_div'), 200);
                     $('html, body').animate({scrollTop: $("#result_table_div").offset().top}, 200);
                } else {
                    alert("error code :"+code);
                }

            }, function(err) {
                alert("error ");

            });
        }
        function db_save_check() {
            var userdata = [];
            var groupcode = document.getElementById('doc_group').value;
            var centercode = document.getElementById('doc_center').value;
             
            
            for (var i = 0; i < all_rows.length; i++) { //real
//            for (var i = 0; i < 3; i++) {//test
//                clog("all_rows[i] ", all_rows[i]);
                var data = {};
                for (var j = 0; j < keydata.length; j++) {
                    data[keydata[j]["key"]] = all_rows[i][keydata[j]["value"]];
                }
                data["groupcode"] = groupcode;
                data["centercodes"] = centercode;
                
                userdata.push(data);
            }
//            clog("pushdata is ", userdata);
            
            
            var data = {
                groupcode : groupcode,
                centercode : centercode,
                userdata : JSON.stringify(userdata)
                
            }
//            return;
            CallHandler("insert_xlsx_data", data, function(res) {
//                clog("res is ",res);
                code = parseInt(res.code);
                if (code == 100) {

                    
//                    document.getElementById("body_p").innerHTML = groupcode+" 그룹 "+selected_centername+" 센터 DB에 성공적으로 저장하였습니다.";
//                    $("#myModal").modal("hide");
//                    $("#end_modal").modal({ keyboard: false, backdrop: 'static' });

                    hideModalDialog();
                    insert_result_table(all_rows);
                    alert("데이타 저장 성공.  "+groupcode+" 그룹 "+selected_centername+" 센터 DB에 성공적으로 저장하였습니다.");
                    
//                    $('html, body').animate({ scrollTop: 700 }, 'fast');
//                    window.location.hash = '#result_table_div';
//                    $.scrollTo($('#result_table_div'), 200);
                     $('html, body').animate({scrollTop: $("#result_table_div").offset().top}, 200);
                } else {
                    alert("error code :"+code);
                }

            }, function(err) {
                alert("error ");

            });
        }
        //그룹 선택 클릭시 
        function changeGroup() {

            var group_value = document.getElementById('doc_group').value;
            var _data = {
                "type": "center", // group or center or auth
                "group": group_value
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {

                    var push_center = document.getElementById('doc_center');

                    push_center.innerHTML = "<option value=''>== 센터를 선택하세요 ==</option>";


                    var arr = res.message;
                    for (var i = 0; i < arr.length; i++) {
                        var opt = document.createElement('option');
                        opt.value = arr[i]["centercode"];
                        opt.innerHTML = arr[i]["centername"];
                        push_center.appendChild(opt);
                    }

                    
                    div_center.style.display = "block";
                    checkGroupCenterValue();
                } else {
                    alert(res.message);
                }

            }, function(err) {
                alert("네트워크 에러 ");

            });


        };
        //센터 선택 클릭시
        function changeCenter() {
            var doc_center = document.getElementById('doc_center');
            selected_centername =  doc_center.options[doc_center.selectedIndex].text;
            
             checkGroupCenterValue();
        }
        function checkGroupCenterValue(){
            var doc_group = document.getElementById('doc_group');
            var doc_center = document.getElementById('doc_center');
            
            if(doc_center.value != "" &&  doc_group.value != ""){
                document.getElementById('div_membership').style.display = "block";
                document.getElementById('btn_insertall').style.display = "block";
            }
                
            else{
                document.getElementById('div_membership').style.display = "none";
                document.getElementById('btn_insertall').style.display = "none";
            } 
        }


        function readExcel() {
            let input = event.target;
            let reader = new FileReader();
            reader.onload = function() {
                let data = reader.result;
                let workBook = XLSX.read(data, {
                    type: 'binary'
                });
                all_rows = [];
                workBook.SheetNames.forEach(function(sheetName) {
//                    clog('SheetName: ' + sheetName);
                    let rows = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName]);
                    clog(JSON.stringify(rows));

                    //jsondata
//                    clog("rows is ", rows);

                    if (rows.length > 0) {
                        document.getElementById('txt_total_user').innerHTML = "총 "+rows.length+"명";
                        all_rows = rows;
                        document.getElementById("push-us").style.display = "block";

                        var doc_keys = [];
                        var div_keylist = document.getElementById("div_keylist").children;
                        for (var i = 0; i < div_keylist.length; i++)
                            doc_keys.push(div_keylist[i].getElementsByTagName("select")[0].id);
                        
                        doc_keys.push(document.getElementById("doc_membership_type_list").id);
                        doc_keys.push(document.getElementById("doc_membership_name_list").id);

                        for (var i = 0; i < doc_keys.length; i++) {
                            var doc_key = document.getElementById(doc_keys[i]);
                            
                            doc_key.innerHTML = "<option value=''>== 사용할 Key를 선택하세요 ==</option>";
                            

                            for (var key in rows[0]) {
                                //                                document.writeln(key + ": " + rows[key]);
                                //                                clog(key + ": " + rows[key]); 
                                if (!checkTableEmpty(rows, key)){
                                    var opt = document.createElement('option');
                                    opt.value = key;
                                    //opt.innerHTML = key+" (ex)"+rows[0][key];
                                    opt.innerHTML = key;
                                    doc_key.appendChild(opt);    
                                }
                                
                            }
                        }
                        
                        //테이블 보여주기
                        insert_table(all_rows);

                    }

                })
            };
            reader.readAsBinaryString(input.files[0]);
        }

        function insert_table(rows) {
             document.getElementById("table_div").style.display = "block";
            var table = document.getElementById('doc_table');
             table.innerHTML = "<thead></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];
            var len = rows.length;
           
            //                clog("table",table);
            //                clog("head",head);
            var hrow = head.insertRow();
            var frow = foot.insertRow();
            hrow.style.backgroundColor = "#e9e9e9";
            frow.style.backgroundColor = "#f9f9a9";
            hrow.style.fontWeight = "bold";
             
            var MAX_COUNT = 5;
            if (len > 0) {
                if (len > MAX_COUNT) len = MAX_COUNT;

                //타이틀 푸터 입력
                for (var key in rows[0]) {

                    if (!checkTableEmpty(rows, key)) {
                        var hcell = hrow.insertCell();
                        hcell.innerHTML = key;
                        var fcell = frow.insertCell();
                        fcell.innerHTML = "...";
                    }

                }

                for (var i = 0; i < len; i++) {
                    var brow = body.insertRow();
                    body.style.backgroundColor = "#f9f9a9";
                    for (var key in rows[i]) {
                        if (!checkTableEmpty(rows, key)) {
                            var bcell = brow.insertCell();
                            bcell.innerHTML = rows[i][key];
                        }
                    }
                }
            }
        }
        function insert_result_table(rows) {
            document.getElementById("result_table_div").style.display = "block";
            var table = document.getElementById('result_doc_table');
//            table.innerHTML = "<thead></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];
            var len = rows.length;
           
            if(head.children.length > 0){
                var hrow = head.rows[0];
                var frow = foot.rows[0];
            }else{
                var hrow = head.insertRow();
                var frow = foot.insertRow();    
                hrow.style.backgroundColor = "#e9e9e9";
                frow.style.backgroundColor = "#f9f9a9";
                hrow.style.fontWeight = "bold";
            
            }
            
             
            var MAX_COUNT = 5;
            if (len > 0) {
                if (len > MAX_COUNT) len = MAX_COUNT;
              
                //타이틀 & 푸터 입력
                var temp_keys = [];
                for (var key in rows[0]) {
                    
                    if (isInputKey(key) && !isCell(key,hrow.cells)) {
                        var hcell = hrow.insertCell();
                        hcell.innerHTML = getKey(key);
                        clog("rows[0][key]"+rows[0][key]);
                        hcell.value = key;
                        temp_keys.push(key);
                        var fcell = frow.insertCell();
                        fcell.innerHTML = "...";
                    }
                }
                //body 고객 데이터 부분
                for (var i = 0; i < len; i++) {
                    if(body.children.length < len){var brow = body.insertRow();}
                    else var brow = body.rows[i];
                    
                    
                    body.style.backgroundColor = "#f9f9a9";
                    for (var key in rows[i]) {
                        
                        if (isInputKey(key) && !check_inserted(key)) {
                            clog("body keuy"+key);
                            var bcell = brow.insertCell();
                            bcell.innerHTML = rows[i][key];
                            bcell.value = key;
                        }
                    }
                }
                for(var i = 0 ; i < temp_keys.length; i++){
                    inserted_table_keys.push(temp_keys[i]);
                }
                
                
            }
        }
        var inserted_table_keys = [];
        function check_inserted(key){
            var flg = false;
            for(var i = 0 ; i < inserted_table_keys.length;i++){
                if(inserted_table_keys[i] == key){
                    flg = true;
                    break;
                }
            }
            return flg;
        }
        function isCell(key, cells){
            var flg = false;
            if(!cells) return false;
            clog("cells len ",cells.length);
            clog("cells ",cells);
           
            for(var i = 0 ; i < cells.length; i++){
                clog("key "+key+" cells[i] "+cells[i].value);
                if(key == cells[i].value){
                    flg = true;
                    break;
                }
            }
            return flg;
        }
        function getKey(exal_key){
            var rkey = null;
            for(var i = 0 ; i < keydata.length; i++){
                if(exal_key == keydata[i].value){
                    rkey = keydata[i].key;
                    break;
                }
            }
            return rkey;
        }
        function isInputKey(key){
            var flg = false;
            for(var i = 0 ; i < keydata.length; i++){
                if(key == keydata[i].value){
                    flg = true;
                    break;
                }
            }
            return flg;
        }
        function checkTableEmpty(rows, key) {

            var flg = false;
            var len = rows.length;
            if (rows.length >= 5) {
                if (rows[0][key] == "" && rows[1][key] == "" && rows[2][key] == "" && rows[3][key] == "" && rows[4][key] == "")
                    flg = true;
            } else {
                flg = true;
                for (var i = 0; i < len; i++) {
                    if (rows[i][key] != "") {
                        flg = false;
                        break;
                    }
                }
            }
            return flg;

        }

        function insert_keys(id) {

           
            var doc_key = document.getElementById(id);
            if (doc_key.value == "") {
                alert("선택하세요");
                return;
            }
            var text = doc_key.options[doc_key.selectedIndex].text;
            var value = doc_key.value;
            //                    clog("value is ",value);
            var arr = doc_key.childNodes;
            //                    clog("arr is ",arr);

            var flg = false;
            for (var i = 0; i < arr.length; i++) {

                if (arr[i].id == value) {
                    flg = true;
                    break;
                }
            }
        }
        function insertAllUsers(){
               showModalDialog(document.body,"엑셀 데이타 등록하기", "현재 생성한 모든 고객정보를 고객리스트에 등록하시겠습니까?" , "등록하기", "취소",function(){
               
                
                sendAllUsers();
            },function(){
                hideModalDialog();
            });
        }
        function sendAllUsers(){
            var groupcode = document.getElementById('doc_group').value;
            var centercode = document.getElementById('doc_center').value;
           var data = {
                groupcode : groupcode,
                centercode : centercode
            }
//            return;
            CallHandler("upload_xlsx_to_userready", data, function(res) {
                clog("res is ",res);
                code = parseInt(res.code);
                if (code == 100) {
                    hideModalDialog();
                    showModalDialog(document.body,"모든 고객정보 저장 성공!", " 모든 고객정보를 DB에 성공적으로 저장하였습니다.", "OK",null,function(){
                        hideModalDialog();
                    });
                   
                } else {
                    alert("error code :"+code);
                    hideModalDialog();
                }

            }, function(err) {
                alert("error ");
                hideModalDialog();

            });
            
            
            
           
        }
    </script>

