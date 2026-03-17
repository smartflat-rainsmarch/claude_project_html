 <div class="card-body">
     <H2 id='id_setting_title'>기본설정</H2><br>

     <!--탭관련 START-->
     <script>
         var istype = "setlocker";

     </script>
     <ul class="nav nav-tabs">
         <li class="nav-item">
             <a href="#aaa" class="nav-link active" data-toggle="tab" onclick="tab_click(1)"><label for="locker_price">※라커개수 & 가격설정&nbsp;<img src="./img/ques_20.png" title="*라커가격 : 라커를 대여할때 1달 기준가격 , 1일 기준 가격을 모두 설정할 수 있습니다." style="margin-top:-4px;" /></label></a>
         </li>
         <li class="nav-item">
             <a href="#bbb" class="nav-link" data-toggle="tab" onclick="tab_click(2)"><label id='id_reservation_title' for="locker_price">※예약시간 설정 예)PT.GX 등 예약시간&nbsp;<img src="./img/ques_20.png" title="운동을 예약할때 예약가능한 최소 시간을 설정할 수 있습니다." style="margin-top:-4px;" /></label></a>
         </li>
         <li class="nav-item">
             <a href="#ccc" class="nav-link" data-toggle="tab" onclick="tab_click(3)"><label>※전체기간연장하기&nbsp;<img src="./img/ques_20.png" title="*센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...)" style="margin-top:-4px;" /></label></a>
         </li>

     </ul>
     <div class="tab-content" id="tabs">
         <div class="tab-pane" id="aaa"></div>
         <div class="tab-pane" id="bbb"></div>
         <div class="tab-pane" id="cc"></div>
     </div>
     <!--탭관련 END-->

     <div id="div_tab1data">
         <br>
         <div class="form-control" style="height:auto"><br>

             <!--라커 개수 설정하는 부분은 일단 보류-->
             <div style='display:none'>
                 <label for="id_lockermonthprice" style="position:absolute;margin-top:7px">● 라커개수 삽입</label>
                 <span><input type="number" id="id_lockercount_start" name="id_lockercount_start" placeholder="최소번호" style="margin-left:140px;max-width:200px" />&nbsp;~&nbsp;<input type="number" id="id_lockercount_end" name="id_lockercount_end" placeholder="최대번호" style="max-width:200px" /></span>
                 <br>
             </div>
             <!--라커 개수 설정하는 부분은 일단 보류-->
             <div>
                 <label for="id_lockermonthprice" style="position:absolute;margin-top:7px">● 1달 라커가격</label>
                 <input type="number" class="form-control" id="id_lockermonthprice" name="id_lockermonthprice" placeholder="1달 기준 가격.." style="margin-left:140px;max-width:200px" />
             </div>
             <div>
                 <label for="id_lockerdayprice" style="position:absolute;margin-top:7px">● 1일 라커가격</label>
                 <input type="number" class="form-control" id="id_lockerdayprice" name="id_lockerdayprice" placeholder="1일 기준 가격.." style="margin-left:140px;max-width:200px" /><br>
             </div>
         </div>
         <br>
     </div>
     <div id="div_tab2data" style='display:none'>

         <br>
         <div class="form-control" style="height:auto"><br>
             <div>
                 <label for="id_inserttime" style="position:absolute;margin-top:7px">● 예약하기 최소시간</label>
                 <input type="number" class="form-control" id="id_inserttime" name="id_inserttime" placeholder="설정시간 후에는 예약불가.." style="margin-left:200px;max-width:200px" />
             </div>
             <div>
                 <label for="id_canceltime" style="position:absolute;margin-top:7px">● 예약취소 최소시간</label>
                 <input type="number" class="form-control" id="id_canceltime" name="id_canceltime" placeholder="설정시간 후에는 예약불가.." style="margin-left:200px;max-width:200px" /><br>
             </div>
             <div>
                 <!--            <label for="id_alltimes">● 전체 오픈시간</label>-->
                 <div>
                     <span style='float:left;padding-top: 10px;'>● 전체 오픈시간&nbsp;<img src="./img/ques_20.png" title="하루동안 운동 예약가능한 시간대를 설정할 수 있습니다." style="margin-top:-4px;" /></span><select id="id_selectalltime" onchange="insertTime()" name="doc_membership_name_list" style='padding:3px;float:right;margin:10px;cursor:pointer;'>
                         <option value="">== 시간추가하기 ==</option>
                     </select>
                 </div><br><br>
                 <div class="form-control" id="id_alltimes" style="height:auto"></div>
             </div>
             <br>
             <label for="dataTable" style="position:absolute;margin-top:7px">● 강좌&nbsp;<img src="./img/ques_20.png" title="운동강좌 이름, 1시간단위운동 최대 인원수를 설정할 수 있습니다. 관리자가 먼저 다음에 예약가능한 운동시작날짜 종료날짜를 설정하면 담당트레이너가 설정되어있는 날짜안에서 일정을 정할 수 있습니다. ※강좌가 PT 일때는 강좌개수를 1개로 시간별 최대 인원수는 1명으로 고정하는것이 좋습니다." style="margin-top:-4px;" /></label><br><br>
             <div id="all_classes" class="form-control" style="height:auto">

                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr style="margin-top:-30px;background-color:#7774e414" align="center">
                             <td>강좌이름</td>
                             <td>시간별 최대인원수</td>
                             <td>다음오픈시작일</td>
                             <td>다음오픈종료일</td>
                             <td></td>

                         </tr>
                     </thead>

                     <tbody id='table_body' align="center">
                         <tr>
                         </tr>
                     </tbody>

                     <!--                강좌추가하기 임시로 막아놓음-->
                     <!--
                                <tfoot id = "table_footer" align="center" style='background-color:#7774e414'>
                                    <tr height="50px" >
                                        <td><input id="foot_name" name="id_inputname" placeholder="강좌이름 입력..." style="margin-top:5px"/></td>
                                        <td><input type="number" id="foot_max"  name="id_inputname" placeholder="최대인원수..." style="margin-top:5px"/></td>
                                        <td><input onchange='foot_date_onchange()' id = 'foot_starttime' type='date' value='' style="margin-top:5px"/></td>
                                        <td><input onchange='foot_date_onchange()' id = 'foot_endtime' type='date' value='' style="margin-top:5px"/></td>
                                        <td><button onclick='add_class()' class='btn btn-primary btn-raised' style='background-color:red;'>강좌 추가하기</button></td>                                

                                    </tr>
                                </tfoot>
        -->
                 </table>


             </div>
         </div>
         <br>
     </div>

     <div id="div_tab3data" style='display:none'>
         <br>
         <div style="height:auto">
             <span style="float:right"><button onclick='show_all_delay()' class='btn btn-primary btn-raised' title="현재까지 연장한 기간 기록을 볼 수 있습니다.">연장기록보기</button></span>
         </div>
         <br><br>
<!--         <label style='color:#555555'>&nbsp;※센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...</label><br>-->
         <div class = 'form-control' style ='height:auto'>         
            <div>
                <label class='textevent' for='id_delaygrouptype' align='left'>그룹선택</label><br>
                <select id='id_delaygrouptype' class='form-control' required>
                    <option value=''>== 연장할 그룹을 선택하세요 ==</option>
                    <option value='1'>유효회원 전체</option>
                    <option value='2'>종료회원 전체</option>
                    <option value='3'>모든 회원</option>                
                </select><br>
            </div>
            <div>
                <label class='textevent'  align='left'>연장일수 선택</label>
                <input type='number' class='form-control' id='id_delayday' name='id_delayday' placeholder='연장할 일수를 선택...'/><br>
            </div>
            <div>
                <label class='textevent'  align='left'>연장사유</label>
                <input type='text' class='form-control' id='id_delaynote' name='id_delaynote' placeholder='연장할 내용을 적어주세요..'/><br>     
            </div>
            <div>
                <label class='textevent'  align='left'>연장항목</label>
                <div class='form-control' name='subscription_path'>
                    <div>
                        <input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='1'>&nbsp;수강항목&nbsp;&nbsp;&nbsp;
                        <input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='2'>&nbsp;락커항목&nbsp;&nbsp;&nbsp;
<!--                        <input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='3'>&nbsp;PT항목&nbsp;&nbsp;&nbsp;-->
                    </div>
                </div>
            </div>
             <br>
             <button onclick='set_all_delay()' class='btn btn-primary btn-raised' style='background-color:red;' title="*센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...)">전체기간연장하기</button>
         </div>
         
     </div>
     <button onclick='update_setting()' class='btn btn-primary btn-raised' style='background-color:#33aaaa;float:right;margin:10px;cursor:pointer;'>설정정보 저장하기</button>
 </div>
<div id = "div_member_table" style ="display:none">
        <table class="table table-bordered" id="memberTable" width="100%" cellspacing="0">
        </table>
     </div>
 <script>
     if (getData("setmembershiptype") == "counttype") activaTab('aaa');


     function activaTab(tab) {
         $('.nav-tabs a[href="#' + tab + '"]').tab('show');

     };

     function tab_click(idx) {
         if (idx == 1) {
             istype = "setlocker"; //라커개수 & 가격설정

         } else if (idx == 2) {
             istype = "reservationtime"; //예약시간 설정 예)PT.GX 등 예약시간
         } else {
             istype = "alluserdelay"; //전체유저기간연장
         }
         for (var i = 1; i <= 3; i++)
             document.getElementById("div_tab" + i + "data").style.display = i == idx ? "block" : "none";

     }



     var group = getData("nowgroupcode");
     var centercode = getData("nowcentercode");
     var centername = getData("nowcentername");


     var allsetting = null;
     var mlocker = null;
     var mreservationinfo = null;
     var msetting = null;

     //라커가격 설정

     var id_setting_title = document.getElementById("id_setting_title");
     var id_reservation_title = document.getElementById("id_reservation_title");

     var id_lockercount_start = document.getElementById("id_lockercount_start");
     var id_lockercount_end = document.getElementById("id_lockercount_end");

     var id_lockermonthprice = document.getElementById("id_lockermonthprice");
     var id_lockerdayprice = document.getElementById("id_lockerdayprice");

     //예약시간 설정
     var id_inserttime = document.getElementById("id_inserttime");
     var id_canceltime = document.getElementById("id_canceltime");

     var id_alltimes = document.getElementById("id_alltimes");
     var id_selectalltime = document.getElementById("id_selectalltime");

     //    var table_footer = document.getElementById("table_footer");
     var table_body = document.getElementById("table_body");

     var default_setting_index = 0; //기본세팅값  트레이너 : 1  매니저 : 2  운영자 : 3

     //수익률 테이블 Body
     var table_levelbody = document.getElementById("table_levelbody");

     function maininit(value) {
         id_setting_title.innerHTML = title_icon + centername + " 설정";
         clog("d_settingnew");
         getSettingData(function(res) {
             if (res.code == 100) {
                 allsetting = res.message;
                 var lockers = allsetting.lockers;
                 var reservationinfos = allsetting.reservation_info;
                 clog("res.message ", allsetting);
                 if (!allsetting.setting) {
                     allsetting["setting"] = {};
                 }
                 msetting = allsetting.setting;
                 updateTableLevelBody();

                 if (lockers && lockers.length > 0) {
                     mlocker = lockers[0];

                     id_lockermonthprice.value = parseInt(mlocker.monthprice);
                     id_lockerdayprice.value = parseInt(mlocker.dayprice);

                 }
                 if (reservationinfos && reservationinfos.length > 0) {



                     mreservationinfo = reservationinfos[0];
                     //                   id_reservation_title.innerHTML = mreservationinfo.type+" "+id_reservation_title.innerHTML;
                     id_inserttime.value = parseInt(mreservationinfo.insertmaxtime);
                     id_canceltime.value = parseInt(mreservationinfo.canceltime);
                     for (var i = 0; i < mreservationinfo.opentimes.length; i++) {
                         var text = mreservationinfo.opentimes[i] < 10 ? "0" + mreservationinfo.opentimes[i] + "시" : mreservationinfo.opentimes[i] + "시";
                         insertXImageButton(id_alltimes, mreservationinfo.opentimes[i], mreservationinfo.opentimes[i] + "시");
                     }
                     updateTableBody();

                 }
                 updateSettingTime();

             }
         }, function(err) {
             clog("getSettingData error ", err);
         });
     }

     function update_setting() {
         showModalDialog(document.body, "설정 정보 변경", "설정 정보를 수정하시겠습니까?", "수정하기", "취소", function() {
             settingAllUpdate();


         }, function() {
             hideModalDialog();

         });
     }

     function insertTime() {
         var time = id_selectalltime.value;
         if (time) insertXImageButton(id_alltimes, time, time + "시");
         updateXImageButton();
     }

     function updateXImageButton() {
         updateSettingTime();
     }

     function updateSettingTime() {
         var defaulttimes = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];

         id_selectalltime.innerHTML = "<option>== 시간추가하기 ==</option>";

         var times = [];
         for (var i = 0; i < id_alltimes.children.length; i++)
             if (id_alltimes.children[i].id) times.push(parseInt(id_alltimes.children[i].id));

         var difference = defaulttimes.filter(x => !times.includes(x));
         for (var i = 0; i < difference.length; i++)
             id_selectalltime.innerHTML += "<option value='" + difference[i] + "'>" + difference[i] + "시</option>";


         sortListIntType(id_alltimes, false);

         var times = [];
         for (var i = 0; i < id_alltimes.children.length; i++) {
             times.push(parseInt(id_alltimes.children[i].id));
         }
         mreservationinfo.opentimes = times;

     }

     function remove_class(idx) {
         var len = table_body.children.length;
         for (var i = 0; i < table_body.children.length; i++) {
             if (i == idx) {
                 //                    table_body.removeChild(table_body.children[i]);
                 mreservationinfo.classes.splice(i, 1);
                 break;
             }
         }


         updateTableBody();
     }

     function remove_levelclass(idx) {
         var len = table_levelbody.children.length;
         for (var i = 0; i < table_levelbody.children.length; i++) {
             if (i == idx) {
                 //                    table_body.removeChild(table_body.children[i]);
                 msetting.pricerule.splice(i, 1);
                 break;
             }
         }


         updateTableLevelBody();
     }

     function updateTableBody() {
         table_body.innerHTML = "";
         for (var i = 0; i < mreservationinfo.classes.length; i++) {
             var cls = mreservationinfo.classes[i];
             //           clog("cls.next_starttime is "+cls.next_starttime);
             var btnhtml = mreservationinfo.type == "PT" ? "" : "<button onclick='remove_class(" + i + ")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button>";
             table_body.innerHTML += "<tr><td>" + cls.name + "</td><td><input id='input_max_member_" + i + "' type='number' value='" + cls.max + "' style='margin-top:5px'/></td><td><input id='input_starttime_" + i + "' type='date' value='" + cls.next_starttime + "' style='margin-top:5px'/></td><td><input id='input_endtime_" + i + "' type='date' value='" + cls.next_endtime + "' style='margin-top:5px'/></td><td style='width:170px'>" + btnhtml + "</td></tr>";
         }
     }

     function updateTableLevelBody() {
         //       table_levelbody.innerHTML = "";
         //       if(msetting && msetting.pricerule){
         //           clog("msetting ",msetting);
         //           var len = msetting.pricerule.length;
         //           for(var i = 0 ; i < len;i++){
         //               var level = i+1;
         //               var rule = msetting.pricerule[i];
         //    //           clog("cls.next_starttime is "+cls.next_starttime);
         //               var btnhtml = "<button onclick='remove_levelclass("+i+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button>";
         //
         //               table_levelbody.innerHTML += "<tr><td><label id='pricerule_level_"+i+"'>"+level+"</label></td><td><input id='pricerule_percent_"+i+"' type='number' value='"+rule.percent+"' style='width:100px;margin-top:5px'/>&nbsp;%</td><td><input id='pricerule_price_"+i+"' type='number' value='"+rule.price+"' style='width:120px;margin-top:5px'/>&nbsp;￦</td><td style='width:500px'><text value='"+rule.note+"' style='margin-top:5px'>"+rule.note+"</text></td><td style='width:170px'>"+btnhtml+"</td></tr>";
         //           }
         //           var foot_level = document.getElementById("foot_level")
         //           if(foot_level)foot_level.innerHTML = (len+1)+"";
         //       }
         //       
     }

     function add_class() {
         var foot_name = document.getElementById("foot_name").value;
         var foot_max = document.getElementById("foot_max").value;
         var foot_starttime = document.getElementById("foot_starttime").value;
         var foot_endtime = document.getElementById("foot_endtime").value;
         //        clog("foot_name "+foot_name+" foot_max "+foot_max+" foot_starttime "+foot_starttime+" foot_endtime "+foot_endtime);

         var len = table_body.children.length;

         var mid = 0;
         for (var i = 0; i < mreservationinfo.classes.length; i++) {
             var id = parseInt(mreservationinfo.classes[i].id);
             if (id > mid) mid = id;
         }

         var cls = {
             "id": mid + 1,
             "name": foot_name,
             "max": parseInt(foot_max),
             "openid": 1,
             "next_openid": 2,
             "next_starttime": foot_starttime,
             "next_endtime": foot_endtime
         };


         if (foot_name && foot_max && foot_starttime && foot_endtime) {
             mreservationinfo.classes.push(cls);
             updateTableBody();
             //            table_body.innerHTML += "<tr><td>"+foot_name+"</td><td><input type='number' value='"+foot_max+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_starttime+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_endtime+"' style='margin-top:5px'/></td><td style='width:170px'><button onclick='remove_class("+len+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button></td></tr>";    
         } else {
             alert("입력되지 않은 부분이 있습니다. ");
         }

     }

     function add_levelclass() {
         var foot_level = document.getElementById("foot_level");
         var foot_percent = document.getElementById("foot_percent").value;
         var foot_price = document.getElementById("foot_price").value;
         var foot_note = document.getElementById("foot_note").value;
         clog("foot_level " + foot_level + " foot_percent " + foot_percent + " foot_price " + foot_price + " foot_note " + foot_note);
         clog("")
         var len = table_levelbody.children.length;
         var flevel = len + 1;
         foot_level.innerHTML = flevel + "";


         var rule = {
             "level": flevel,
             "percent": foot_percent,
             "price": foot_price,
             "note": foot_note
         };


         if (msetting && !msetting.pricerule)
             msetting["pricerule"] = [];





         if (foot_percent && foot_price && foot_note) {
             if (parseInt(foot_percent) > 300) {
                 alert("300% 이상은  설정할 수 없습니다.");
                 return;
             }

             msetting.pricerule.push(rule);
             msetting.pricerule.sort(sort_by('percent', false, (a) => a.toUpperCase()));
             updateTableLevelBody();
             clog("msetting ", msetting);
             //            table_body.innerHTML += "<tr><td>"+foot_name+"</td><td><input type='number' value='"+foot_max+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_starttime+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_endtime+"' style='margin-top:5px'/></td><td style='width:170px'><button onclick='remove_class("+len+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button></td></tr>";    
         } else {
             alert("입력되지 않은 부분이 있습니다. ");
         }

     }

     function foot_date_onchange() {
         var today = getToday();
         var foot_starttime = document.getElementById("foot_starttime");
         var foot_endtime = document.getElementById("foot_endtime");
         clog("today " + today + " starttime " + foot_starttime);

         if (foot_starttime) {
             var sday = getDay(today, foot_starttime.value);
             if (sday < 0) {
                 alert("오늘 이전 날짜는 설정할 수 없습니다.");
                 foot_starttime.value = "";
             }

         }

         if (foot_starttime.value && foot_endtime.value) {
             var dday = getDay(foot_starttime.value, foot_endtime.value);
             if (dday < 0) {
                 alert("종료일이 시작일보다 작습니다.종료일을 다시 설정하여 주세요");
                 foot_endtime.value = "";
             }
         }
         foot_starttime = document.getElementById("foot_starttime").value;
         foot_endtime = document.getElementById("foot_endtime").value;
     }

     function updateReservationClasses() {
         for (var i = 0; i < mreservationinfo.classes.length; i++) {
             var input_max_member = document.getElementById("input_max_member_" + i).value;
             var input_starttime = document.getElementById("input_starttime_" + i).value;
             var input_endtime = document.getElementById("input_endtime_" + i).value;

             mreservationinfo.classes[i].max = input_max_member;

             if (mreservationinfo.classes[i].next_starttime != input_starttime || mreservationinfo.classes[i].next_endtime != input_endtime) {
                 var next_openid = parseInt(mreservationinfo.classes[i].next_openid);
                 next_openid++;
                 mreservationinfo.classes[i].next_openid = next_openid + "";
                 mreservationinfo.classes[i].next_starttime = input_starttime;
                 mreservationinfo.classes[i].next_endtime = input_endtime;
             }



         }
     }

     function settingAllUpdate() {

         updateReservationClasses();
         var locker_num_start = parseInt(id_lockercount_start.value);
         var locker_num_end = parseInt(id_lockercount_end.value);

         var monthprice = parseInt(id_lockermonthprice.value);
         var dayprice = parseInt(id_lockerdayprice.value);
         mreservationinfo.insertmaxtime = parseInt(id_inserttime.value);
         mreservationinfo.canceltime = parseInt(id_canceltime.value);
         if (allsetting.reservation_info.length > 0) allsetting.reservation_info[0] = mreservationinfo;

         var value = {};
         value.lockernumstart = locker_num_start;
         value.lockernumend = locker_num_end;
         value.monthprice = monthprice;
         value.dayprice = dayprice;
         value.reservationinfo = allsetting.reservation_info;
//         value.setting = msetting;  //트레이너 강사설정으로 따로 이동함

         var groupcode = getData("nowgroupcode");
         var centercode = getData("nowcentercode");

         var senddata = {
             groupcode: groupcode,
             centercode: centercode,
             type: "setsetting",
             value: value
         };
         CallHandler("adm_get", senddata, function(res) {
             //            clog("setsettingres is ",res);
             if (res.code == 100) {
                 C_showToast( "설정완료!", "성공적으로 설정하였습니다.", function() {});
             } else {
                 C_showToast( "설정불가!", "" + res.message, function() {});
             }
             hideModalDialog();
         }, function(err) {
             C_showToast( "설정불가!", "" + res.message, function() {});
             hideModalDialog();
         });

     }

     function set_all_delay() {
         var id_delaygrouptype = document.getElementById("id_delaygrouptype");
         var txt_delaygrouptype = id_delaygrouptype.options[id_delaygrouptype.selectedIndex].text;
          var day = document.getElementById("id_delayday").value;
             var note = document.getElementById("id_delaynote").value;
             var clist = document.getElementsByClassName("delay_checkboxgroup");
             var list = [];
             for (var i = 0; i < clist.length; ++i) {
                 if (clist[i].checked) {
                     if (clist[i].value == "기타") {
                         list.push(edittext_other);
                     } else
                         list.push(clist[i].value);
                 }
             }

             if (!id_delaygrouptype || !day || !note || list.length == 0) {
                 if (!id_delaygrouptype)
                     alertMsg("그룹을 선택해주세요");
                 else if (!day)
                     alertMsg("연장일수를 선택해주세요");
                 else if (!day)
                     alertMsg("연장사유를 적어주세요");
                 else if (list.length == 0)
                     alertMsg("연장항목을 최소 1개 이상 선택해 주세요");

                 return;
             }
         
         var c1_checked = clist[0] && clist[0].checked ? "checked" : "";
         var c2_checked = clist[1] && clist[1].checked ? "checked" : "";
         
         var tag = "<label >※전체기간연장하기&nbsp;<img src='./img/ques_20.png' title='*센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...)' style='margin-top:-4px;'/></label><br>" +
             "<div class = 'form-control' style ='height:auto'>" +
                 "<div>" +
                     "<label class='textevent' for='id_delaygrouptype' align='left'>그룹</label><br>" +
                     "<label class='form-control' align='left'>"+txt_delaygrouptype+"</label><br>" +                     
                  "</div>" +
                  "<div>" +
                     "<label class='textevent'  align='left'>연장일수</label>" +
                    "<label class='form-control' align='left'>"+txt_delaygrouptype+"</label><br>" +    
                  "</div>" +
                  "<div>" +
                     "<label class='textevent'  align='left'>연장사유</label>" +
                     "<label class='form-control' align='left'>"+txt_delaygrouptype+"</label><br>" +    
                  "</div>" +
                  "<div>" +
                     "<label class='textevent'  align='left'>연장항목</label>" +
                  "</div>" +
                  "<div>" +
                     "<div class='form-control' name='subscription_path'>" +                 
                        "<input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='1' "+c1_checked+" disabled>&nbsp;수강항목&nbsp;&nbsp;&nbsp;" +
                        "<input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='2' "+c2_checked+" disabled>&nbsp;락커항목&nbsp;&nbsp;&nbsp;" +

                     "</div>" +                                      
                  "</div>" +                                      
             "</div>";

         showModalDialog(document.body, "전체기간 연장하기", tag, "연장하기", "취소", function() {
             var delaygrouptype = document.getElementById("id_delaygrouptype").value;
             var day = document.getElementById("id_delayday").value;
             var note = document.getElementById("id_delaynote").value;
             var clist = document.getElementsByClassName("delay_checkboxgroup");
             var list = [];
             for (var i = 0; i < clist.length; ++i) {
                 if (clist[i].checked) {
                     if (clist[i].value == "기타") {
                         list.push(edittext_other);
                     } else
                         list.push(clist[i].value);
                 }
             }

             if (!delaygrouptype || !day || !note || list.length == 0) {
                 if (!delaygrouptype)
                     alertMsg("그룹을 선택해주세요");
                 else if (!day)
                     alertMsg("연장일수를 선택해주세요");
                 else if (!day)
                     alertMsg("연장사유를 적어주세요");
                 else if (list.length == 0)
                     alertMsg("연장항목을 최소 1개 이상 선택해 주세요");

                 return;
             }

             var value = {
                 delaygrouptype: delaygrouptype,
                 day: parseInt(day),
                 note: note,
                 delaygroups: list
             }
             showModalDialog(document.body, "※경고", "※ 전체기간을 정말 연장하시겠습니까?", "연장하기", "취소", function() {
                 delayEndtimeAllUsers(value);


             }, function() {
                 hideModalDialog();
                 hideModalDialog();

             });

         }, function() {
             hideModalDialog();

         });

     }

     function show_all_delay() {

         var groupcode = getData("nowgroupcode");
         var centercode = getData("nowcentercode");

         var senddata = {
             groupcode: groupcode,
             centercode: centercode,
             type: "getdelayallusers"

         };
         CallHandler("adm_get", senddata, function(res) {
             //            clog("setsettingres is ",res);
             if (res.code == 100) {
                 showDelayData(res.message);
             } else {
                 alertMsg(res.message);
             }

         }, function(err) {
             C_showToast("에러!", "" + err, function() {});
             hideModalDialog();
         });
     }

     function showDelayData(rows) {


         //array_push($teacher_reservation[$i]["myusers"], array("uid" => $m_uid, "userid"=>$m_userid,"name"=>$m_username, "starttime" => $pt_starttime,  "endtime" => $pt_endtime, "ornerstatus" => $orner_status, "couponid" => $couponid));//1.트레이너지정 , 2PT/
         //uid, id, name , starttime , endtime , ornerstatus , couponid , 

         if (!rows || rows && rows.length == 0) {
             //            C_showToast( "연장기간", "목록이 없습니다.", function() {});
             alertMsg("목록이 없습니다.");
             return;
         }

         var div_member_table = document.getElementById("div_member_table");
         var table = document.getElementById('memberTable'); //등록일 = couponid                               
         table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>인덱스</th><th>날짜</th><th>이름</th><th>타입</th><th>연장일수</th><th>연장항목</th><th>연장사유</th></tr></thead><tfoot></tfoot><tbody></tbody>";
         var head = table.getElementsByTagName("thead")[0];
         var body = table.getElementsByTagName("tbody")[0];
         var foot = table.getElementsByTagName("tfoot")[0];
         var len = rows.length;

         if (len > 0) {
             //            for(var j = 0 ; j < 100 ; j++)//test
             for (var i = 0; i < len; i++) {



                 var brow = body.insertRow();
                 var mdate = rows[i]["date"]; // 날짜
                 var useruid = rows[i]["uid"]; //uid
                 var username = rows[i]["name"]; // 이름
                 var delaygrouptype = rows[i]["delaygrouptype"]; // 연장타입
                 var changeday = rows[i]["changeday"]; //연장일수 
                 var encode_delaygroups = JSON.parse(rows[i]["encode_delaygroups"]); //연장항목 []
                 var note = rows[i]["note"]; // 내용

                 var txt_type = ["", "유효회원 전체", "종료회원 전체", "모든 회원"];
                 var txt_groups = ["", "수강항목", "락커항목", ""];

                 // 인덱스
                 var bcell_index = brow.insertCell();
                 bcell_index.innerHTML = (i + 1) + "";
                 bcell_index.style.maxWidth = "30px";

                 //수정날짜
                 var bcell_datetime = brow.insertCell();
                 bcell_datetime.innerHTML = mdate ? mdate.substring(0, 10) : "";


                 // 이름               
                 var bcell_name = brow.insertCell();
                 bcell_name.innerHTML = "<button class='btn btn-primary btn-raised' onclick='getMyUserInfo(\"" + useruid + "\")' style='background-color:#116666' >" + username + "</button>";


                 //연장타입
                 var bcell_type = brow.insertCell();
                 bcell_type.innerHTML = txt_type[parseInt(delaygrouptype)];

                 //연장일수
                 var bcell_day = brow.insertCell();
                 bcell_day.innerHTML = changeday;

                 //연장항목 []
                 var bcell_delaygroup = brow.insertCell();
                 var str_groups = "";
                 for (var a = 0; a < encode_delaygroups.length; a++) {
                     if (a == 0)
                         str_groups += txt_groups[parseInt(encode_delaygroups[a])];
                     else
                         str_groups += "," + txt_groups[parseInt(encode_delaygroups[a])];
                 }
                 bcell_delaygroup.innerHTML = str_groups;


                 //내용
                 var bcell_note = brow.insertCell();
                 bcell_note.innerHTML = note;

             }
         }
         $('#memberTable').DataTable();

         var style = {
             bodycolor: "#ffffff",
             size: {
                 width: "90%",
                 height: "100%"
             }
         };
         showModalDialog(document.body, "기간연장 목록", div_member_table.innerHTML, "확인", null, function() {
             hideModalDialog();

         }, function() {}, style);

     }

     function delayEndtimeAllUsers(value) {
         var groupcode = getData("nowgroupcode");
         var centercode = getData("nowcentercode");

         var senddata = {
             groupcode: groupcode,
             centercode: centercode,
             type: "delayallusers",
             value: value
         };
         CallHandler("adm_get", senddata, function(res) {
             //            clog("setsettingres is ",res);
             if (res.code == 100) {
                 C_showToast( "설정완료!", "성공적으로 설정하였습니다.", function() {});
             } else {
                 C_showToast("설정불가!", "" + res.message, function() {});
             }
             hideModalDialog();
             hideModalDialog();
         }, function(err) {
             C_showToast( "에러!", "" + err, function() {});
             hideModalDialog();
             hideModalDialog();
         });
     }

     function change_default_setting() {
         var default_t = document.getElementById("default_t"); //트레이너
         var default_m = document.getElementById("default_m"); //점장
         var default_m = document.getElementById("default_tl"); //팀장
         var default_o = document.getElementById("default_o"); //운영자

         if (default_t.checked) default_setting_index = 1;
         if (default_m.checked) default_setting_index = 2;
         if (default_tl.checked) default_setting_index = 3;
         if (default_o.checked) default_setting_index = 4;

         clog("change_default_setting " + default_setting_index);


     }

 </script>
