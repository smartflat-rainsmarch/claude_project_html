<div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text id='tb_title' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >목록</text>
						<br><br><br>
                        
                        <div class="card mb-4">
                            
                            <div class="card-body" id="div_notice"></div>
                           
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                검색결과
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <span style='float:left;'> <button id='btn_download_excel' onclick="download_excel()" style='float:left;border:0px;background-color:#1d7146;border-radius:5px;font-size:14px;color:white;font-weigh:500;width:230px;height:35px;outline:none'><img src = './img/ic_excel.png' style='height:22px;margin-top:-1px;margin-right:10px'/>&nbsp;검색결과 엑셀로 다운로드</button></span><select id='select_displaylength' style="border-radius:4px;border:1px solid #a9a9a9;float:right;padding:5px" onchange="change_displaylength()"></select><br><br>
                                    <table id="excelTable" width="100%" cellspacing="0" style="margin-top:-10px;display:none;"/>
                                    <table class="table table-bordered fmont" id="dataTable" width="100%" cellspacing="0" style='text-align:center;background-color:white;font-size:14px;font-weight:400'></table>
                                    <br>
                                    <button id='btn_send_message' onclick='btn_sendall_push()' class='btn btn-primary btn-raised' style='display:none;float:right;margin:10px;cursor:pointer;'>메세지 보내기</button> 
                                    
                                  
                                    <div id="div_pagenum" align="center">
                                        <ul class="w3-pagination">
                                          <li><a style='border-radius:4px;border:1px solid #a9a9ff;' href="#">❮❮&nbsp;&nbsp;</a></li>
                                          
                                          <li><a href="#">❮</a></li>    
                                          <li><a class="w3-blue" href="#">1</a></li>
                                          <li><a href="#">2</a></li>
                                          <li><a href="#">3</a></li>
                                          <li><a href="#">4</a></li>
                                          <li><a href="#">5</a></li>
                                          <li ><a href="#">❯</a></li>
<!--                                            <a href="javascript:void(0)">❯</a>-->
                                          <li><a style='border-radius:4px;border:1px solid #a9a9ff;' onclick="click_next()">&nbsp;&nbsp;❯❯</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
           

            </div>

<script>
    
    $(document).ready(function() {
//      $('#dataTable').DataTable();

    });
    var excel_title = "";
    var statistic_key ="";
    var page_json = {
        "lengthMenu":[ 10, 25, 50 ,75,100,9999],
        "displayLength":10,
        "page" : 0,
        "maxlength" : 0,
    }
    var alldatas = [];
    function init_d_statistics(key){
        
        //엑셀다운로드버튼 숨기기
        var btn_download_excel = document.getElementById("btn_download_excel");
        btn_download_excel.style.visibility = auth >= AUTH_OPERATOR ? "visible" : "hidden";
        
        
        clog("d_statistic!!");
        var title = document.getElementById("tb_title");
        switch(key){
            case "data_end_member":
                excel_title = "수강종료 예정자";
                title.innerHTML = "수강종료 예정자";
                
                break;
            case "data_out_member":
                excel_title = "수강종료후 미등록자";
                title.innerHTML = "수강종료후 미등록자";
                break;
            case "data_all_member":
                excel_title = "전체회원 리스트";
                title.innerHTML = "전체회원 리스트"; //전체회원 리스트
                break;
            case "data_paid_member":
                excel_title = "유효회원 리스트";
                title.innerHTML = "유효회원 리스트"; //유효회원 리스트
                break;
            case "data_today_member":
                excel_title = "입실자 리스트";
                title.innerHTML = "입실자 리스트"; //유효회원중 입실자 리스트
                break;
            case "data_delay_member":
                excel_title = "연기자 리스트";
                title.innerHTML = "연기자 리스트"; //유효회원중 연기자 리스트
                break;
            case "data_pt_member":
                excel_title = "전체 PT회원 리스트";
                title.innerHTML = "전체 PT회원 리스트"; //전체 PT 고객 리스트
                break;
            case "data_paid_pt_member":
                excel_title = "유효 PT회원 리스트";
                title.innerHTML = "유효 PT회원 리스트"; //전체 PT 고객 리스트
                break;
            case "data_locker_all_member":
                excel_title = "라커 이용중인 리스트";
                title.innerHTML = "라커 이용중인 리스트"; //전체 PT 고객 리스트
                break;
            case "data_notpaying_member":
                excel_title = "미수금 리스트";
                title.innerHTML = "미수금 리스트"; //전체 PT 고객 리스트
                break;
                
        }
        statistic_key = key;
        clog("maininit testpage");
//        clog("param value "+value);
        
        var id_statistic_starttime = document.getElementById("id_statistic_starttime").value;  // 2022-10-19 00:00:00
        var id_statistic_endtime = document.getElementById("id_statistic_endtime").value;       //2022-10-19 00:00:00
        
        
        if(getDay(id_statistic_starttime,id_statistic_endtime) < 0){
            alertMsg("시작일은 종료일보다 작거나 같아야 합니다. 다시 선택해 주세요");
            return;   
        }
        else if(key == "data_end_member" || key == "data_delay_member" || key == "data_out_member" ){
            if(!id_statistic_starttime || !id_statistic_endtime){
                alertMsg("시작일과 종료일을 모두 입력해 주세요");
                return;       
            }
        }
        
       
        getStatisticData("statistic", key, id_statistic_starttime, id_statistic_endtime, function(res) {
             clog("statistic res is ", res);
             var code = parseInt(res.code);
             if (code == 100) {
//                 document.getElementById("table_div").style.display = "block";
                 if(statistic_key == "data_paid_member" || statistic_key == "data_today_member"){
                     res.message = checkPaidMember(res.message);
                 }
                 init_displaylength();
                 alldatas = res.message;     
                 createExcelData(alldatas);
                 page_json.maxlength = alldatas.length;
                 insert_statistic_table(res.message);
//                 makeTable('excelTable',alldatas,false);
                  
//                 exportExcelFile("excelTable",getData("nowcentername")+"_"+excel_title+"_"+getToday());
             }
             else 
                 insert_statistic_table(null);

             C_HideLoadingProgress();
         });
    }
    
    function setList(res){
        var dataTable = document.getElementById("dataTable");        
    }
    var userdatas = [];
    function insert_statistic_table(rows) {
        userdatas = rows;
        var div_notice = document.getElementById("div_notice")
        if(!rows){
            if(div_notice)div_notice.innerHTML = "목록을 찾을 수 없습니다.";
            document.getElementById("btn_send_message").style.display = "none";
            document.getElementById("btn_download_excel").style.display = "none";
            
            return;
        }
        if(div_notice)div_notice.innerHTML = rows.length+"개의 목록을 찾았습니다.";

//            document.getElementById("table_div").style.display = "block";
        
//        var excelTable = document.getElementById('excelTable');
//        excelTable.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>선택하기</th><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>회원권</th><th>가격</th><th>시작일</th> <th>종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
//        var head = excelTable.getElementsByTagName("thead")[0];
//        var body = excelTable.getElementsByTagName("tbody")[0];
//        var foot = excelTable.getElementsByTagName("tfoot")[0];
//        var len = rows.length;
        var new_rows = [];
        var newlen = page_json.displayLength;
        var offset = page_json.page * newlen;
        for(var i = 0; i < newlen; i++){
            var idx = offset+i;
            if(idx < rows.length)
                new_rows.push(rows[idx]);
        }
        
        makeTable('dataTable',new_rows,true,offset,statistic_key);
        
//        var table = document.getElementById('dataTable');
//        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>선택하기</th><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>회원권</th><th>가격</th><th>시작일</th> <th>종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
//        var head = table.getElementsByTagName("thead")[0];
//        var body = table.getElementsByTagName("tbody")[0];
//        var foot = table.getElementsByTagName("tfoot")[0];
//        var len = rows.length;
//
//        
//        if (len > 0) {
////            for(var j = 0 ; j < 100 ; j++)//test
//            for (var i = 0; i < len; i++) {
//                var using_coupons = getCoupons(rows[i],"using");
//                var brow = body.insertRow();
//                var uid = rows[i]["mem_uid"];
//                var bcell_check = brow.insertCell();
//                bcell_check.innerHTML = "<input style='padding-left:5em' checked='true' id='checkbox_"+i+"' class='checkboxgroup' type='checkbox' value='"+uid+"'>";
//
//                var bcell_name = brow.insertCell();
//                bcell_name.innerHTML = "<button onclick='statistic_button_click("+i+")' class='btn btn-primary btn-raised'><img src = './img/"+rows[i]["mem_gender"]+".png' style='width:10px;'/>"+rows[i]["mem_username"]+"</button>";
//
//                var bcell_id = brow.insertCell();
//                bcell_id.innerHTML = rows[i]["mem_userid"];
//
//                var bcell_birth = brow.insertCell();
//                bcell_birth.innerHTML = rows[i]["mem_birth"];
//
//                var bcell_phone = brow.insertCell();
//                bcell_phone.innerHTML = rows[i]["mem_phone"];
//
////                var bcell_gender = brow.insertCell();
////                bcell_gender.innerHTML = rows[i]["mem_gender"];
//
//
//                var bcell_membership = brow.insertCell();
//                bcell_membership.innerHTML = using_coupons.length > 0 ? using_coupons[0].mbsmaxcount : "-";
//
//                var bcell_membership_price = brow.insertCell();
//                bcell_membership_price.innerHTML = using_coupons.length > 0 ? "￦"+CommaString(using_coupons[0].mbsprice) : "-";
//
//                var bcell_starttime = brow.insertCell();
//                bcell_starttime.innerHTML = rows[i]["mem_starttime"];
//
//                var bcell_endtime = brow.insertCell();
//                bcell_endtime.innerHTML = rows[i]["mem_endtime"];
//
////                var bcell_btn = brow.insertCell();
////
////               // bcell_btn.innerHTML = "<button onclick='change_button_click(\"" + uid + "\")' class='btn btn-primary btn-raised'>변경하기</button>";
////                 bcell_btn.innerHTML = "<button onclick='statistic_button_click("+i+")' class='btn btn-primary btn-raised'>정보보기</button>";
//
//                
//            }
//        }
//        $('#dataTable').DataTable();
    }
    function createExcelData(rows){
        
        var titles = ["이름","고객번호","생년월일","성별","전화번호","집주소","라커","회원권","회원권가격","PT운동권","시작일","종료일","기타"];
        var txt_gender = {"M":"남자" , "F" : "여자" , "U" : ""};
        var len = rows.length;
        excel_data = [];
        if (len > 0) {
            for (var a = 0; a < len; a++) {
                var user = rows[a];
                var using_coupons = getCoupons(user,"using");
                var username = user["mem_username"];
                var userid = user["mem_userid"];
                var birth = user["mem_birth"] ? user["mem_birth"] : "";
                var gender = user["mem_gender"];
                var phone = user["mem_phone"];
                var homeaddress = user["mem_homeaddress"] ? user["mem_homeaddress"] : "";
//                var newlockers = user["mem_newlockers"];
                var termcoupons = user["mem_membership"];
                var countcoupons = user["mem_reservation"];
                var starttime = user["mem_starttime"];
                var endtime = getCouponsLastEndtime(using_coupons);
//                console.log(username+" endtime "+endtime);
                var other = user["mem_other"] ? user["mem_other"] : "";
                var term_coupons = user["mem_membership"] ? JSON.parse(user["mem_membership"]) : null;
                var count_coupons = user["mem_reservation"] ? JSON.parse(user["mem_reservation"]) : null;
                var newlockers = user["mem_newlockers"] ? JSON.parse(user["mem_newlockers"]) : null;                
                var last_termcoupon = null;
                var last_countcoupon = null;
                var last_locker = null;
                if(term_coupons)
                    for(var i = 0 ; i < term_coupons.length; i++){
                        var tcoupon = term_coupons[i];
                        if(!last_termcoupon || last_termcoupon && compareDay(last_termcoupon.endtime,tcoupon.endtime) >= 0){
                            last_termcoupon = tcoupon;
                        }
                    }
                if(count_coupons)
                    for(var i = 0 ; i < count_coupons.length; i++){
                        var ccoupon = count_coupons[i];
                        if(!last_countcoupon || last_countcoupon && compareDay(last_countcoupon.endtime,ccoupon.endtime) >= 0){
                            last_countcoupon = ccoupon;
                        }
                    }
                if(newlockers)
                    for(var i = 0 ; i < newlockers.length; i++){
                        var locker = newlockers[i];
                        if(!last_locker || last_locker && compareDay(last_locker.endtime,locker.endtime) >= 0){
                            last_locker = locker;
                        }
                    }
                var txt_lockernum = last_locker && last_locker.n ? last_locker.num : "";
                var txt_termcoupon = last_termcoupon && last_termcoupon.mbsmonth ? last_termcoupon.mbsmonth+"개월 이용권" : "";
                var txt_termcoupon_price = last_termcoupon && last_termcoupon.mbsprice ? ""+TXT_WON+CommaString(last_termcoupon.mbsprice) : "";
                var last_countcoupon = last_locker && last_locker.mbsmaxcount ? getMbsMaxCount(last_locker)+"회 운동권" : "";
               
                excel_data.push({"이름":username,"고객번호":userid,"생년월일":birth,"성별":txt_gender[gender],"전화번호":phone,"집주소":homeaddress,"라커번호":txt_lockernum,"회원권":txt_termcoupon,"회원권가격":txt_termcoupon_price,"PT운동권":last_countcoupon,"시작일":starttime,"종료일":endtime,"기타":other});
            }
        }
 
    }
    function download_excel(){
        exportExcelFile(getData("nowcentername")+"_"+excel_title+"_"+getToday()+".xlsx");
    }
    
    function makeTable(tableid,rows,isdataTable,offset,statistic_key){
         var table = document.getElementById(tableid);
        var istabledisplay = isdataTable ? "block" : "none";
        
        if(statistic_key == "data_delay_member"){
          
        
            table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>요청일</th><th>이름</th><th>요청타입</th><th>회원권</th><th>요청시작일</th><th>요청종료일</th><th>상태</th></tr></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];
            var len = rows.length;

        
            if (len > 0) {
                for (var i = 0; i < len; i++) {

                    var brow = body.insertRow();
                    var rqidx = rows[i]["rq_idx"];
                    var rdate = rows[i]["rq_date"];
                    var useruid = rows[i]["rq_uid"];
                    var userid = rows[i]["rq_userid"];
                    var username = rows[i]["rq_username"];
                    var requesttype = rows[i]["rq_requesttype"];
                    var status = rows[i]["rq_status"];
                    var mbstype = rows[i]["rq_mbstype"];
                    var couponid = rows[i]["rq_couponid"];
                    var request_starttime = rows[i]["rq_starttime"];
                    var request_endtime = rows[i]["rq_endtime"];

                    var isfreeuser = true;

                    ///////////////////////////////////////////////
                    // 인덱스
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,(i+1)+""); 

                     ///////////////////////////////////////////////
                    // 요청일
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,rdate); 



                    ///////////////////////////////////////////////
                    // 이름/ 고객번호
                    ///////////////////////////////////////////////                   
                    var name_tag = "<button class='btn btn-primary btn-raised' onclick='show_usertag("+i+")' style='font-size:14px;background-color:#116666'>"+username+"["+userid+"]</button>";
                    insertOTCell(brow,isfreeuser,name_tag); 

                    ///////////////////////////////////////////////
                    //요청타입
                    ///////////////////////////////////////////////
                    var requesttype_text = {"H":"홀딩","S":"시작시간변경","N":"없음"};
                    insertOTCell(brow,isfreeuser,requesttype_text[requesttype]);

                    ///////////////////////////////////////////////
                    //회원권
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,mbstype);

                    ///////////////////////////////////////////////
                    //요청시작일
                    ///////////////////////////////////////////////
                    var starttime_tag = request_starttime ? getToday(new Date(request_starttime)) : ""
                    insertOTCell(brow,isfreeuser,starttime_tag);

                    ///////////////////////////////////////////////
                    //요청종료일
                    ///////////////////////////////////////////////
                    var endtime_tag = request_endtime ? getToday(new Date(request_endtime)) : ""
                    insertOTCell(brow,isfreeuser,endtime_tag);

                    ///////////////////////////////////////////////
                    //상태변경
                    ///////////////////////////////////////////////
                    var status_text = {"R":"요청","Y":"승인","N":"승인거부","D":"요청해제"};
                    insertOTCell(brow,isfreeuser,status_text[status]);
                }
            }

        }
        else if(statistic_key == "data_pt_member" || statistic_key == "data_paid_pt_member"){ //PT 멤버
            
            table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>이름</th><th>고객번호</th><th>전화번호</th><th>PT 회원권</th><th>총 PT횟수</th><th>PT 가격</th><th>PT 시작일</th> <th>PT 종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];


    //        //입실시간으로 정렬한다.
    //        if(statistic_key == "data_today_member"){
    //            clog("aaaa ",rows);
    //            rows.sort(sort_by('inserttime', false, (a) => a.toUpperCase()));
    //        }


            var len = rows.length;

            if (len > 0) {
    //            for(var j = 0 ; j < 100 ; j++)//test
                for (var i = 0; i < len; i++) {
                    var using_coupons = getCoupons(rows[i],"using");
                    var brow = body.insertRow();
                    var uid = rows[i]["mem_uid"];
                    var userid = rows[i]["mem_userid"];
                    var bcell_check = brow.insertCell();

                    //bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] :"<input style='padding-left:5em' checked='true' id='checkbox_"+i+"' class='checkboxgroup' type='checkbox' value='"+uid+"'>";
                    bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] : "<text style='float:center'>"+(i+offset+1)+"</text>";

                    var bcell_name = brow.insertCell();
                    bcell_name.innerHTML = "<button onclick='statistic_button_click(\""+userid+"\")' class='btn btn-primary btn-raised'><img src = './img/"+rows[i]["mem_gender"]+".png' style='width:10px;'/>"+rows[i]["mem_username"]+"</button>";

                    var bcell_id = brow.insertCell();
                    bcell_id.innerHTML = rows[i]["mem_userid"];

//                    var bcell_birth = brow.insertCell();
//                    bcell_birth.innerHTML = rows[i]["mem_birth"] ? rows[i]["mem_birth"] : "-";

                    var bcell_phone = brow.insertCell();
                    bcell_phone.className = "excel_text";
                    bcell_phone.innerHTML = "&#8203;"+rows[i]["mem_phone"];  //&#8203; 추가 : 맨앞숫자가 0으로 시작하면 0을 삭제하는 버그때문에 수정함 ex)01033.. => 1033.. 으로 변하는버그때문


                    var count_coupons = rows[i]["mem_reservation"] ? JSON.parse( rows[i]["mem_reservation"]) : null;

                    var last_countcoupon = null;
                    if(count_coupons)
                        for(var a = 0 ; a < count_coupons.length; a++){
                            var ccoupon = count_coupons[a];
                            if(!last_countcoupon || last_countcoupon && compareDay(last_countcoupon.endtime,ccoupon.endtime) >= 0){
                                if(statistic_key == "data_pt_member" || statistic_key == "data_paid_pt_member" && parseInt(ccoupon.mbsprice) > 0)
                                    last_countcoupon = ccoupon;
                            }
                        }
    //                clog("last_countcoupon ",last_countcoupon);
                    var txt_countcoupon = last_countcoupon && last_countcoupon.mbsmonth ? last_countcoupon.mbstype+" "+last_countcoupon.mbsmaxcount+"회 이용권" : "-";
                    var txt_countcoupon_price = last_countcoupon && last_countcoupon.mbsprice ? ""+TXT_WON+CommaString(last_countcoupon.mbsprice) : "-";
                    

                    var bcell_membership = brow.insertCell();
                    bcell_membership.innerHTML = txt_countcoupon;

                    var bcell_pt_count = brow.insertCell();
                    bcell_pt_count.innerHTML = last_countcoupon ? getMbsMaxCount(last_countcoupon)+"회" : "0회";

                    var bcell_membership_price = brow.insertCell();
                    bcell_membership_price.innerHTML = txt_countcoupon_price;

                    var bcell_starttime = brow.insertCell();
                    bcell_starttime.innerHTML = last_countcoupon ? last_countcoupon.starttime : "-";

                    var bcell_endtime = brow.insertCell();
                    bcell_endtime.innerHTML = last_countcoupon ? last_countcoupon.endtime : "-";

    //                var bcell_btn = brow.insertCell();
    //
    //               // bcell_btn.innerHTML = "<button onclick='change_button_click(\"" + uid + "\")' class='btn btn-primary btn-raised'>변경하기</button>";
    //                 bcell_btn.innerHTML = "<button onclick='statistic_button_click("+i+")' class='btn btn-primary btn-raised'>정보보기</button>";


                }
            }
        }
        else if(statistic_key == "data_locker_all_member"){ // 라커이용 멤버
            
            table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>라커 번호</th><th>라커 가격</th><th>라커 시작일</th><th>라커 종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];


    //        //입실시간으로 정렬한다.
    //        if(statistic_key == "data_today_member"){
    //            clog("aaaa ",rows);
    //            rows.sort(sort_by('inserttime', false, (a) => a.toUpperCase()));
    //        }


            var len = rows.length;

            if (len > 0) {
    //            for(var j = 0 ; j < 100 ; j++)//test
                for (var i = 0; i < len; i++) {
                    var using_coupons = getCoupons(rows[i],"using");
                    var brow = body.insertRow();
                    var uid = rows[i]["mem_uid"];
                    var userid = rows[i]["mem_userid"];
                    var bcell_check = brow.insertCell();
                    console.log("username "+rows[i]["mem_username"])
                    //bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] :"<input style='padding-left:5em' checked='true' id='checkbox_"+i+"' class='checkboxgroup' type='checkbox' value='"+uid+"'>";
                    bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] : "<text style='float:center'>"+(i+offset+1)+"</text>";

                    var bcell_name = brow.insertCell();
                    bcell_name.innerHTML = "<button onclick='statistic_button_click(\""+userid+"\")' class='btn btn-primary btn-raised'><img src = './img/"+rows[i]["mem_gender"]+".png' style='width:10px;'/>"+rows[i]["mem_username"]+"</button>";

                    var bcell_id = brow.insertCell();
                    bcell_id.innerHTML = rows[i]["mem_userid"];

                    var bcell_birth = brow.insertCell();
                    bcell_birth.innerHTML = rows[i]["mem_birth"] ? rows[i]["mem_birth"] : "-";

                    var bcell_phone = brow.insertCell();
                    bcell_phone.className = "excel_text";
                    bcell_phone.innerHTML = "&#8203;"+rows[i]["mem_phone"];  //&#8203; 추가 : 맨앞숫자가 0으로 시작하면 0을 삭제하는 버그때문에 수정함 ex)01033.. => 1033.. 으로 변하는버그때문


                    var newlockers = rows[i]["mem_newlockers"] ? JSON.parse( rows[i]["mem_newlockers"]) : null;

                    var last_locker = null;
                    if(newlockers)
                        for(var a = 0 ; a < newlockers.length; a++){
                            var locker = newlockers[a];
                           
                            if(!last_locker || last_locker && compareDay(last_locker.endtime,locker.endtime) >= 0){
                                if(!(locker.isdelete && locker.isdelete == "D"))
                                    last_locker = locker;
                            }
                        }



                    var bcell_lockernum = brow.insertCell();
                    bcell_lockernum.innerHTML = last_locker ? last_locker.num : "-";

                    var bcell_locker_price = brow.insertCell();
                    console.log("last_locker ",last_locker);
                    var locker_price = 0;
                    if(last_locker && last_locker.price){
                        if(typeof(last_locker.price) === "string" || typeof(last_locker.price) === "number")locker_price = CommaString(last_locker.price);
                        else  locker_price = CommaString(parseInt(last_locker.price.card)+parseInt(last_locker.price.cash));    
                    }
                    
                    bcell_locker_price.innerHTML = TXT_WON+CommaString(locker_price);

                    var bcell_starttime = brow.insertCell();
                    bcell_starttime.innerHTML = last_locker ? last_locker.starttime.substr(0,10) : "-";

                    var bcell_endtime = brow.insertCell();
                    bcell_endtime.innerHTML = last_locker ? last_locker.endtime.substr(0,10) : "-";

    //                var bcell_btn = brow.insertCell();
    //
    //               // bcell_btn.innerHTML = "<button onclick='change_button_click(\"" + uid + "\")' class='btn btn-primary btn-raised'>변경하기</button>";
    //                 bcell_btn.innerHTML = "<button onclick='statistic_button_click("+i+")' class='btn btn-primary btn-raised'>정보보기</button>";


                }
            }
        }
        //미수금 목록
        else if(statistic_key == "data_notpaying_member"){
            var txt_row0_title = "번호";
        
            table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>"+txt_row0_title+"</th><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>회원권</th><th>가격</th><th>시작일</th> <th>종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];


    //        //입실시간으로 정렬한다.
    //        if(statistic_key == "data_today_member"){
    //            clog("aaaa ",rows);
    //            rows.sort(sort_by('inserttime', false, (a) => a.toUpperCase()));
    //        }


            var len = rows.length;

            if (len > 0) {
    //            for(var j = 0 ; j < 100 ; j++)//test
                for (var i = 0; i < len; i++) {
                    var using_coupons = getCoupons(rows[i],"using");
                    var brow = body.insertRow();
                    var uid = rows[i]["mem_uid"];
                    var userid = rows[i]["mem_userid"];
                    var bcell_check = brow.insertCell();

                    //bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] :"<input style='padding-left:5em' checked='true' id='checkbox_"+i+"' class='checkboxgroup' type='checkbox' value='"+uid+"'>";
                    bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] : "<text style='float:center'>"+(i+offset+1)+"</text>";

                    var bcell_name = brow.insertCell();
                    bcell_name.innerHTML = "<button onclick='statistic_button_click(\""+userid+"\")' class='btn btn-primary btn-raised'><img src = './img/"+rows[i]["mem_gender"]+".png' style='width:10px;'/>"+rows[i]["mem_username"]+"</button>";

                    var bcell_id = brow.insertCell();
                    bcell_id.innerHTML = rows[i]["mem_userid"];

                    var bcell_birth = brow.insertCell();
                    bcell_birth.innerHTML = rows[i]["mem_birth"] ? rows[i]["mem_birth"] : "-";

                    var bcell_phone = brow.insertCell();
                    bcell_phone.className = "excel_text";
                    bcell_phone.innerHTML = "&#8203;"+rows[i]["mem_phone"];  //&#8203; 추가 : 맨앞숫자가 0으로 시작하면 0을 삭제하는 버그때문에 수정함 ex)01033.. => 1033.. 으로 변하는버그때문


                    var term_coupons = rows[i]["mem_membership"] ? JSON.parse( rows[i]["mem_membership"]) : null;

                    var last_termcoupon = null;
                    if(term_coupons)
                        for(var a = 0 ; a < term_coupons.length; a++){
                            var tcoupon = term_coupons[a];
                            if(!last_termcoupon || last_termcoupon && compareDay(last_termcoupon.endtime,tcoupon.endtime) >= 0){
                                last_termcoupon = tcoupon;
                            }
                        }
    //                clog("last_termcoupon ",last_termcoupon);
                    var txt_termcoupon = last_termcoupon && last_termcoupon.mbsmonth ? last_termcoupon.mbsmonth+"개월 이용권" : "-";
                    var txt_termcoupon_price = last_termcoupon && last_termcoupon.mbsprice ? ""+TXT_WON+CommaString(last_termcoupon.mbsprice) : "-";
                    if(last_termcoupon && last_termcoupon.mbsname == "기존회원권"){
                        txt_termcoupon = last_termcoupon.mbsname;
                        txt_termcoupon_price = TXT_WON+"0";
                    }


                    var bcell_membership = brow.insertCell();
                    bcell_membership.innerHTML = txt_termcoupon;

                    var bcell_membership_price = brow.insertCell();
                    bcell_membership_price.innerHTML = txt_termcoupon_price;

                    var bcell_starttime = brow.insertCell();
                    bcell_starttime.innerHTML = rows[i]["mem_starttime"];

                    var bcell_endtime = brow.insertCell();
                    bcell_endtime.innerHTML = rows[i]["mem_endtime"];

    //                var bcell_btn = brow.insertCell();
    //
    //               // bcell_btn.innerHTML = "<button onclick='change_button_click(\"" + uid + "\")' class='btn btn-primary btn-raised'>변경하기</button>";
    //                 bcell_btn.innerHTML = "<button onclick='statistic_button_click("+i+")' class='btn btn-primary btn-raised'>정보보기</button>";


                }
            }
        
        }
        else {
            var txt_row0_title = statistic_key == "data_today_member" ? "입실시간" : "번호";
        
            table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>"+txt_row0_title+"</th><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>회원권</th><th>가격</th><th>시작일</th> <th>종료일</th></tr></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];


    //        //입실시간으로 정렬한다.
    //        if(statistic_key == "data_today_member"){
    //            clog("aaaa ",rows);
    //            rows.sort(sort_by('inserttime', false, (a) => a.toUpperCase()));
    //        }


            var len = rows.length;

            if (len > 0) {
    //            for(var j = 0 ; j < 100 ; j++)//test
                for (var i = 0; i < len; i++) {
                    var using_coupons = getCoupons(rows[i],"using");
                    var brow = body.insertRow();
                    var uid = rows[i]["mem_uid"];
                    var userid = rows[i]["mem_userid"];
                    var bcell_check = brow.insertCell();

                    //bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] :"<input style='padding-left:5em' checked='true' id='checkbox_"+i+"' class='checkboxgroup' type='checkbox' value='"+uid+"'>";
                    bcell_check.innerHTML =  statistic_key == "data_today_member" ? rows[i]["inserttime"] : "<text style='float:center'>"+(i+offset+1)+"</text>";

                    var bcell_name = brow.insertCell();
                    bcell_name.innerHTML = "<button onclick='statistic_button_click(\""+userid+"\")' class='btn btn-primary btn-raised'><img src = './img/"+rows[i]["mem_gender"]+".png' style='width:10px;'/>"+rows[i]["mem_username"]+"</button>";

                    var bcell_id = brow.insertCell();
                    bcell_id.innerHTML = rows[i]["mem_userid"];

                    var bcell_birth = brow.insertCell();
                    bcell_birth.innerHTML = rows[i]["mem_birth"] ? rows[i]["mem_birth"] : "-";

                    var bcell_phone = brow.insertCell();
                    bcell_phone.className = "excel_text";
                    bcell_phone.innerHTML = "&#8203;"+rows[i]["mem_phone"];  //&#8203; 추가 : 맨앞숫자가 0으로 시작하면 0을 삭제하는 버그때문에 수정함 ex)01033.. => 1033.. 으로 변하는버그때문


                    var term_coupons = rows[i]["mem_membership"] ? JSON.parse( rows[i]["mem_membership"]) : null;

                    var last_termcoupon = null;
                    if(term_coupons)
                        for(var a = 0 ; a < term_coupons.length; a++){
                            var tcoupon = term_coupons[a];
                            if(!last_termcoupon || last_termcoupon && compareDay(last_termcoupon.endtime,tcoupon.endtime) >= 0){
                                last_termcoupon = tcoupon;
                            }
                        }
    //                clog("last_termcoupon ",last_termcoupon);
                    var txt_termcoupon = last_termcoupon && last_termcoupon.mbsmonth ? last_termcoupon.mbsmonth+"개월 이용권" : "-";
                    var txt_termcoupon_price = last_termcoupon && last_termcoupon.mbsprice ? ""+TXT_WON+CommaString(last_termcoupon.mbsprice) : "-";
                    if(last_termcoupon && last_termcoupon.mbsname == "기존회원권"){
                        txt_termcoupon = last_termcoupon.mbsname;
                        txt_termcoupon_price = TXT_WON+"0";
                    }


                    var bcell_membership = brow.insertCell();
                    bcell_membership.innerHTML = txt_termcoupon;

                    var bcell_membership_price = brow.insertCell();
                    bcell_membership_price.innerHTML = txt_termcoupon_price;

                    var bcell_starttime = brow.insertCell();
                    bcell_starttime.innerHTML = last_termcoupon ? last_termcoupon.starttime.substr(0,10) : "-";

                    var bcell_endtime = brow.insertCell();
                    bcell_endtime.innerHTML = last_termcoupon ? getTotalEndtime(last_termcoupon).substr(0,10) : "-";

    //                var bcell_btn = brow.insertCell();
    //
    //               // bcell_btn.innerHTML = "<button onclick='change_button_click(\"" + uid + "\")' class='btn btn-primary btn-raised'>변경하기</button>";
    //                 bcell_btn.innerHTML = "<button onclick='statistic_button_click("+i+")' class='btn btn-primary btn-raised'>정보보기</button>";


                }
            }
        
        }
       if(isdataTable) $('#dataTable').DataTable({
           // 표시 건수기능 숨기기
            lengthChange: false,
            // 검색 기능 숨기기
//            searching: false,
            // 정렬 기능 숨기기
//            ordering: false,
            // 정보 표시 숨기기
            info: false,
            // 페이징 기능 숨기기
            paging: false,
//           bDestroy: true,
//             stateSave: true,
           
           
          // order:[  [ 1, "asc"] ]
            //order:[ [ 0, "asc" ] ]
           // 표시 건수를 10건 단위로 설정
//	       lengthMenu: [ 10, 20, 30, 40, 50 ],

            // 기본 표시 건수를 50건으로 설정
            displayLength: page_json.displayLength
       });
       updatePageNumber();
    }
     function insertOTCell(brow,isfreeuser,tag,maxWidth,minWidth){
        var cell = brow.insertCell();
       
        if(maxWidth)cell.style.maxWidth = maxWidth;
        if(minWidth)cell.style.minWidth = minWidth;
        cell.innerHTML = tag;
    }
    //하단 페이지 넘버를 갱신한다.
    function updatePageNumber(){
        var div_pagenum = document.getElementById("div_pagenum");
        div_pagenum.innerHTML = "";
        var page = page_json.page;
        var displayLength = page_json.displayLength;
        var pageoffset = parseInt(page/5)*5;
        var num_tag = "";
        var max_len = alldatas.length; //최대갯수
        
        var flen = 5; 
        var rnum  =  max_len - pageoffset * displayLength ;
        if(parseInt(rnum/displayLength) < 5)flen = rnum/displayLength;
        
        for(var i = 0; i < flen; i++){
            var num = pageoffset+i;
            var selected = num == page ? "class='w3-blue'" : "";
            num_tag += "<li><a "+selected+" onclick='click_page("+(num)+")'>"+(num+1)+"</a></li>";
        }
            
        var page_tag = 
            "<ul class='w3-pagination'>"+
              "<li><a style='border-radius:4px;border:1px solid #a9a9ff;'  onclick='click_first()' >❮❮&nbsp;&nbsp;</a></li>"+
              "<li><a  onclick='click_prev()'>❮</a></li>"+num_tag+              
              "<li ><a  onclick='click_next()'>❯</a></li>"+
              "<li><a style='border-radius:4px;border:1px solid #a9a9ff;'  onclick='click_end()'>&nbsp;&nbsp;❯❯</a></li>"+
            "</ul>";
        div_pagenum.innerHTML = page_tag;
    }
    function init_displaylength(){
        var lengthMenu = page_json.lengthMenu;
        var select_displaylength = document.getElementById("select_displaylength");
        var length_tag = "";
        for(var i = 0 ;i  < lengthMenu.length;i++){
            var selected = page_json.displayLength == lengthMenu[i] ? "selected" : "";
            length_tag += "<option style='font-size:15px;f' value = '"+lengthMenu[i]+"' "+selected+">"+lengthMenu[i]+"개씩 보기</option>";
        }
        select_displaylength.innerHTML = length_tag;
        
    }
    function change_displaylength(){
       var select_displaylength = document.getElementById("select_displaylength");
        page_json.displayLength = parseInt(select_displaylength.value);
        page_json.page = 0;
        update_page();
    }
    function click_end(){
        clog(parseInt(page_json.maxlength/page_json.displayLength)+" page_json.maxlength "+(page_json.maxlength)+" page_json.displayLength "+page_json.displayLength+" 나머지 "+(page_json.maxlength%page_json.displayLength));
        var maxpage = page_json.maxlength%page_json.displayLength == 0 ? parseInt(page_json.maxlength/page_json.displayLength) : parseInt(page_json.maxlength/page_json.displayLength)+1;
        clog("maxpage "+maxpage);
        page_json.page = maxpage-1;
        
        update_page();
    }
    function click_first(){
        page_json.page = 0;
        update_page();
    }
    function click_page(page){
        page_json.page = page;
        update_page();
    }    
    function click_prev(){
        page_json.page--;
        if(page_json.page < 0)page_json.page = 0;
        update_page();
        
    }
    function click_next(){
        page_json.page++;
        var maxpage = page_json.maxlength%page_json.displayLength == 0 ? parseInt(page_json.maxlength/page_json.displayLength) : parseInt(page_json.maxlength/page_json.displayLength)+1;
        
        if(page_json.page > maxpage-1)page_json.page = maxpage-1;
        update_page();
    }
    function update_page(){
        $("#dataTable").dataTable({destroy:true});
        $("#dataTable").dataTable().fnDestroy();
        
        var dataTable = document.getElementById("dataTable");
        var div_notice = document.getElementById("div_notice"); 
        
        $('#dataTable tbody').empty();
        div_notice.innerHTML = "";
        dataTable.innerHTML = "";
        
       
       insert_statistic_table(alldatas);    
        
    }
    function btn_sendall_push(){
            var users = [];
            if(!userdatas || userdatas && userdatas.length == 0){
                alertMsg("메세지를 보낼수 있는 고객이 없습니다.");
                return;
            }
            for(var i = 0 ; i < userdatas.length; i++){
                
                if(userdatas[i]["mem_fcmtoken"] != "")users.push(userdatas[i]["mem_fcmtoken"]);
            }
            
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

        
            var user_len = users.length;
            var title = "목록전체 메세지 보내기";
            var msg = "<div class='form-group row'><div id=formdiv class='col-12'><br><label class='text_style'>*제목</label><input type='text' class='form-control' id='id_title_all' name='id_title' placeholder='메세지 제목을 입력하세요' required /><br><label class='text_style'>*보낼 메세지 내용</label><textarea id='id_message_all' class='form-control' name='id_message' placeholder='메세지 내용을 입력하세요..' style='height:140px; ' required></textarea><br><p align='right'></p><div>보낼수 있는 회원 <br>총 "+user_len+" 명의 고객에게 전송 가능합니다.</div></div></div>";
            showModalDialog(document.body, title, msg, "푸시 메세지 보내기", "취소", function () {
                var mtitle = document.getElementById("id_title_all").value;
                var mmessage = document.getElementById("id_message_all").value;               
                var clickaction = "";               
                
                var modal_message = "";
                modal_message += "<br><label class='text_style'>*제목</label><p align='center' class='form-control'>" + mtitle + "</p>";
                modal_message += "<br><label class='text_style'>*내용</label><p align='center' class='form-control'>" + mmessage + "</p>";
                modal_message += user_len+"명에게 메세지를 전송하시겠습니까?";
                
                showModalDialog(document.body, "메세지 전송", modal_message, "보내기", "취소", function () {
                        pushdata = {
                            "groupcode" : groupcode,
                            "centercode" : centercode,
                            "title": mtitle,
                            "message": mmessage,
                            "tokens": users,
                            "clickaction": clickaction
                        };
                    
                    
//                       push_check(pushdata,function(res){
                        var len = pushdata.tokens.length;
                        sendReservationPushMessages(getToday(), pushdata, len, function(res){
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
                    }, function (err) {
                        
                        hideModalDialog();
                        hideModalDialog();
                    });
            }, function (err) {
                clog("err ",err);
                hideModalDialog();
            });
    }
    function statistic_button_click(id){
//        clog("change_button_click !!! uid is "+idx);
        
        var arr = [];
        var info = null;
        for(var i = 0; i < userdatas.length; i++){
            if(userdatas[i].mem_userid == id){
                arr.push(userdatas[i]);    
                info = userdatas[i];
                break;
            }
            
        }
        

          showinfo(info);
    }
   function show_usertag(idx){
//        clog("idx "+idx+ " istraner "+istraner);
        var user = null;
        if(alldatas)user = alldatas[idx]; 
        
        getUserData(user.rq_userid,function(res){
            
            if(res.code == 100){
            
                
                showinfo(res.message[0]);
            }else{
                alertMsg("고객을 찾을 수 없습니다.");
            }
            
        })
    }

</script>