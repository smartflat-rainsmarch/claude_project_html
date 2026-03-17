    

    <div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text id='title_payment' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >페이롤 현황</text>
            <img id= "admin_settingid_215"  onclick="showAllTranerReservation()" style='float:right;margin-top:8px;cursor:pointer' src="./img/btn_alltraner.png"/>
            <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
            <div align='left' style='width:100%;height:50px;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding-left:20px;padding-right:20px;margin-top:25px;margin-bottom:25px;'>
                <span style='margin:top'>
                    <i class="fa-solid fa-circle-question" title="페이롤 현황을 색깔로 표현해 줍니다." style='color:;color:#9c9daf' ></i>&nbsp;&nbsp;
                    <svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#fffaeb'></rect></svg>&nbsp;<label style='font-size:14px; color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>일반</label>&nbsp;&nbsp;&nbsp;
                    <svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#ebebeb'></rect></svg>&nbsp;&nbsp;<label style='font-size:14px;color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>사용되지 않음</label>&nbsp;&nbsp;&nbsp;
                    <svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#fee0e3'></rect></svg>&nbsp;&nbsp;<label style='font-size:14px;color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>이번달 가입</label>&nbsp;&nbsp;&nbsp;                    
                </span>               
            </div>
           
           
            <div style="background-color:#fff8dc;border-top:1px solid #f0ead4;border-bottom:1px solid #f0ead4;height:52px">
                <img id='arrow_l' src='./img/button_prev_yellow.png' style='float:left;margin-left:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(0)" />
                <img id='arrow_r' src='./img/button_next_yellow.png' style='float:right;margin-right:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(1)" />
                <div align="center" style="margin-top:10px"><text style="margin-left:0px;font-size:18px;font-weight:700;" id="txt_title">Payroll Data</text></div>               
            </div>

            
            <div align="center" style="margin-top:40px;margin-bottom:15px;height:40px">
                
                <button id='btn_download_excel' onclick="exportPayrollExcel()" style='float:left;border:0px;background-color:#1d7146;border-radius:5px;font-size:14px;color:white;font-weigh:500;width:230px;height:35px;outline:none'><img src = './img/ic_excel.png' style='height:22px;margin-top:-1px;margin-right:10px'/>&nbsp;엑셀로 다운로드</button>
                 <button id='admin_settingid_229' onclick='allPriceListOpen()' style='float:right;width:100px; border:0px;height:35px;border-radius:5px;background-color:#009ef7;font-size:14px; color:#ffffff;text-align:center;font-weight:700;display:none'>전체페이롤</button>
<!--
                <button id='btn_allopen' onclick='allOpen()' style='float:right;width:90px; border:0px;height:35px;border-radius:5px;background-color:#009ef7;font-size:14px; color:#ffffff;text-align:center;font-weight:700;'>전체오픈</button>
                <button id='btn_allclose' onclick='allClose()' style='float:right;width:90px; border:0px;height:35px;border-radius:5px;background-color:#009ef7;font-size:14px; color:#ffffff;text-align:center;font-weight:700;display:none'>전체닫기</button>
-->
            </div>
<!--             <hr style="border: solid 1px #eff2f5;margin-left:-28px;margin-right:-28px;">-->
            <div id ='div_traners_info' style='width:1220px;height:auto'></div>
           
            <div id="container">

            </div>
            <div id="id_nodata">
            <br>
            <div align="center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style='background-color:white;display:none;'></table>
        </div>
    </div>
    
    <script>
        
        setImageButton("admin_settingid_215","btn_alltraner.png","btn_alltraner_press.png","btn_alltraner_hover.png");
        setImageButton("arrow_l","button_prev_yellow.png","button_prev_yellow_press.png","button_prev_yellow_hover.png");
        setImageButton("arrow_r","button_next_yellow.png","button_next_yellow_press.png","button_next_yellow_hover.png");
        
        var btn_download_excel = document.getElementById("btn_download_excel");
        var div_traners_info = document.getElementById("div_traners_info");
        if(!isPermission(227) && btn_download_excel)btn_download_excel.style.visibility = "hidden";
        console.log("d_setpayroll");
        var payroll_history = [];
        var status_isdelete_arr = [];
        var before_index = -1;
        var payroll_setting = null;
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var centercode = getData("nowcentercode");
        var centername = getData("nowcentername");
        var openlist = [];
        var alllist = [];
        var setpayrolldata = {};
        var excel_users_data = [];
        var center_setting = {};
        var gxdatas = []; //이번달 GX강좌들을 모두 불러온다.
        var excel_ptdata  =[];
        var excel_totalpricedata = [];
        var ptgx_tab_index = 0;
        var missing_gx_teacherlist = [];
//        var reset_image = document.getElementById("reset_image");
//        reset_image.style.display = auth == AUTH_SYSTEMOWNER ? "block" : "none";
//        var refresh_datas = [];
        $(document).ready(function() {
            
            getMyTranerHistory(year, month);
        });

        function init_d_payroll_history(key) {
//            clog("aaakey is " + key);
        }
        function exportPayrollExcel(){
            excel_data = excel_ptdata;
            exportExcelFile(export_excel_filename);
        }
         function exportTotalPriceExcel(id){
             exportTableToExcel(id,export_totalprice_excel_filename);
        }
        function setNowMonthMissingGXTeachers(gxdatas,pt_teachers){
            missing_gx_teacherlist = [];
            var aym = parseInt(year)*12+parseInt(month);
            for(var i = 0; i < gxdatas.length; i++){

                //이번달일때
                if(aym == parseInt(gxdatas[i].gx_yearmonthnum)){
                    var gx_roomdata = JSON.parse(gxdatas[i].gx_roomdata);
                    var teacheruid = gx_roomdata.room_managerid ? gx_roomdata.room_managerid : "";
                    var teachername = gx_roomdata.room_managername ? gx_roomdata.room_managername : "";
                    
                    if(!isGXTeachers(teacheruid,pt_teachers)){                        
                        missing_gx_teacherlist.push({"pr_uid":teacheruid,"pr_name":teachername});
                    }
                }
            }
//            console.log("missing_gx_teacherlist ",missing_gx_teacherlist);
        }
        function isGXTeachers(teacheruid,pt_teachers){
            
                    
            var isin = false;
            for(var j = 0; j < missing_gx_teacherlist.length; j++){
                if(teacheruid == missing_gx_teacherlist[j].pr_uid){
                    isin = true;
                    break;
                }
            }
            for(var j = 0; j < pt_teachers.length; j++){
                if(teacheruid == pt_teachers[j].pr_uid){
                    isin = true;
                    break;
                }
            }
            
            return isin;
        }
        function getMyTranerHistory(year, month) {
//            refresh_datas = [];
//            clog("openlist ", openlist);
            var obj = new Object();
            obj.centercode = getData("nowcentercode");
            obj.uid = global_uid;
            obj.id = global_id;
            obj.year = year;
            obj.month = month;
            
            setpayrolldata = obj;
            
            document.getElementById("txt_title").innerHTML = year + "년 " + month + "월";
            if(!isPermission(215))document.getElementById("admin_settingid_215").style.display = "none";
            
            if(isPermission(229))document.getElementById("admin_settingid_229").style.display = "block";
            var nowselecteduid = loadSelectedTeacher(year,month);
           
            
            CallHandler("my_payroll_history", obj, function(res) {
                clog("my_payroll_history res is ", res);
                var container = document.getElementById("container");

                var code = parseInt(res.code);
                
                if (code == 100) {

                    excel_ptdata = [];
                    
                    if(container)container.innerHTML = ""; //초기화
                    payroll_history = res.message;
                    status_isdelete_arr = res.statusisdeletearr;
                    teacherlist = res.teacherlist;
                    gxdatas = res.gxdatas;
                    setNowMonthMissingGXTeachers(gxdatas,res.message[0].data);
                    if(res.message[0] && res.message[0].setting)center_setting = JSON.parse(res.message[0].setting);
//                    clog("traners is ",res.message[0].data);
//                    clog("teacherlist is ",teacherlist);
                    var isdata = false;
                    
                    
                    for(var a = 0; a < res.message.length; a++) {
                        var payrolllist = res.message[a];

                        var mdiv = document.createElement("div");

//                        var my_div = document.createElement("div");
                        var other_div = document.createElement("div");
                        
//                        my_div.style.backgroundColor = "#e1ecea";
//                        my_div.style.border = "1px solid #aaaaaa";
//                        other_div.style.backgroundColor = "#eeeeee";
//                        other_div.style.border = "1px solid #aaaaaa";

                        var payroll_centercode = payrolllist.centercode;
                        var payroll_centername = payrolllist.centername;
                        
                        var setting = payrolllist.setting ? JSON.parse(payrolllist.setting) : null; //payroll_setting
                        var jsonarray = payrolllist.data;

                        
                        
                        
                        //                        payroll_history = jsonarray;
                        //                        clog("payroll_history ",payroll_history);
                        //                        clog("datas is ",jsonarray);
                        alllist = jsonarray;
                        div_traners_info.innerHTML = "";
                        if (jsonarray && centercode == payroll_centercode) {
                            if (jsonarray.length > 0) isdata = true;
                            
                            jsonarray.sort(sort_by('pr_name', false, (a) => a.toUpperCase()));
                            
//                          console.log("missing_gx_teacherlist.length ",missing_gx_teacherlist.length);

                            //페이롤 회원들 내용들을 출력한다.
                            var total_len = jsonarray.length+missing_gx_teacherlist.length;
                            for (var i = 0; i < jsonarray.length+missing_gx_teacherlist.length; i++) {

                                var ismissing = i < jsonarray.length ? false : true;


                                var item = !ismissing ? jsonarray[i] : missing_gx_teacherlist[i-jsonarray.length]; //트레이너
                                if(item){

//                                    console.log("item ",item);
                                    var manageruid = item.pr_uid;
                                    var managerid = "";
                                    var managername = item.pr_name;
                                    var users = !ismissing && jsonarray[i].pr_users ? JSON.parse(jsonarray[i].pr_users) : []; //트레이너 안에 고객들
                                   
                                    var user_len = users.length;
                                    var pr_newtotalprice_list = !ismissing && item.pr_newtotalprice ? JSON.parse(item.pr_newtotalprice) : [];
                                    var pr_newtotalprice = 0;
                                    var fix_percent = !ismissing ? parseInt(item.pr_fixpercent) : 0;
                                    for(var j = 0 ; j < pr_newtotalprice_list.length; j++)
                                        pr_newtotalprice += parseInt(pr_newtotalprice_list[j].price);

                                    var table_data = createUsersTable(manageruid, i, users, setting, pr_newtotalprice,fix_percent);

                                    var num = a * jsonarray.length + i;
                                    var ptitle = i == 0 ? "<br>": "";

                                    var mem_teacher = getTeacherListByUid(teacherlist,manageruid);
                                    var teacher_setting = mem_teacher && mem_teacher.mem_setting != "" && mem_teacher.mem_setting != "null" ? JSON.parse(mem_teacher.mem_setting) : null;
                                    //트레이너 강사 금액산정

                                    var my_pricenamesetting = getMyPriceSettingData(teacher_setting,year,month);


//                                    console.log(i+" my_pricenamesetting ",my_pricenamesetting);
                                    var allpricedata = getTeacherAllPriceTag(manageruid,i,year,month,my_pricenamesetting,table_data.totalgetprice);
                                    
                                    var allprice_table_tag = isPermission(228) ? getAllPriceTableTag(allpricedata,my_pricenamesetting,manageruid,year,month) : "";
                                    var traner_allprice_tag = "<div id='div_total_price_"+manageruid+"'  style='width:100%;height:auto;border:1px solid #d9dced;border-radius:5px;margin-bottom:0px;padding:20px;box-shadow: 1px 1px 3px 1px #dadce044 inset;background-    color:white;margin-bottom:20px'>"+allprice_table_tag+"</div>";



                                    var target_amount = !ismissing && item.pr_targetamount ? CommaString(item.pr_targetamount) : "0";
                                    //내정보

                                    //트레이너 달력보기 아이콘
                                    var teacher_calendar_tag = auth >= AUTH_OPERATOR ? "<div onclick='showTranerReservation(\""+manageruid+"\",\""+managerid+"\",\""+managername+"\",1)' style='width:50px;height:59px;float:left'><i class='fa-regular fa-calendar'  style='color:#3f4254;width:14px; height:16px;margin-top:23px;margin-left:20px'></i></div>" : "";

                                    var viewhistory_btn_tag = isPermission(213) ? "<button onclick='show_ornersetpayroll_history(\"" + manageruid + "\")' class='btn ' style='float:right;margin-top:-5px;margin-right:20px;cursor:pointer;width:160px; height:30px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='admin_settingid_213'>페이롤 수정기록보기</button>" : "";

                                    var color = "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);";

                                    export_excel_filename = year+"년_"+month+"월_"+payroll_centername+"_페이롤.xlsx";
                                    export_totalprice_excel_filename = year+"년_"+month+"월_"+payroll_centername+"_총급여내역.xlsx";
                                    btn_download_excel.innerHTML = "<img src = './img/ic_excel.png' style='margin-top:-12px;height:22px;margin-top:-1px;margin-right:10px'/>"+month+"월 엑셀파일로 다운로드";


                                    var isselected = false;
                                    if(!nowselecteduid && i == 0 || nowselecteduid && nowselecteduid == manageruid){
                                        isselected = true;
                                        before_selected_traner_uid[year+"-"+month] = manageruid;
                                    }
                                    var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
                                    var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
                                    var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D9DCED;";
//                                    var info_backgroound_color = isselected ? "#5591fe" : "#F5F8FA";
//                                    var info_fontcolor = isselected ? "#ffffff" : "#3f4254";
                                    var users_info_display = isselected ? "block" : "none";

//                                    other_div.innerHTML +=  "<div id='div_traner_userinfos_"+manageruid+"' style='display:"+users_info_display+";box-shadow: 1px 1px 3px 1px #dadce0 inset;border-radius:10px;background-color:#00000003;height:auto'>" + 
//                                                                traner_allprice_tag+ 
//                                                                "<div style='padding:20px'>" + table_data.tag + "</div>"+
//                                                            "</div>";
                                    other_div.innerHTML +=  "<div id='div_traner_userinfos_"+manageruid+"' style='display:"+users_info_display+";'>" + 
                                                                traner_allprice_tag+ 
                                                                "<div>" + table_data.tag + "</div>"+
                                                            "</div>";

                                    var totaluserlen = !ismissing ? table_data.totaluserlen : 0;
                                    var traner_info_tag = 
                                        "<div id='div_tranerinfo_"+manageruid+"' onmouseover='tranerinfo_hover(\"div_tranerinfo_"+manageruid+"\")' onclick ='onclick_trander("+i+",\""+manageruid+"\","+year+","+month+")' align='center' style='width:230px;height:120px;border-radius:5px;"+box_css+";color:#3F4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;'>"+
                                            "<div id='div_tranerinfo_title_"+manageruid+"'  align='left' style='width:100%;height:40px;padding:10px 13px;10px;20px;background-color:#F6F7F7;border-radius:5px 5px 0px 0px;"+title_css+"'>"+
                                               //PT달력 이름
                                                "<label style='font-weight: 500;font-size:16px;float:left' >"+managername+"</label>"+
                                                "<img src='./img/icon_list_black.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick='clickInnerObj();showTotalPriceList("+i+",\""+manageruid+"\", \"" + year + "\",\"" + month + "\")'>"+
                                                "<i class='fa-regular fa-calendar' onclick='showTranerReservation(\""+manageruid+"\",\""+managerid+"\",\""+managername+"\",1)'  style='float:right;margin-top:2px;margin-left:5px;color:#3f4254;cursor:pointer'></i><br>"+
                                             "</div>"+
                                            
                                            "<div id='div_tranerinfo_body_"+manageruid+"' align='left' style='width:100%;height:80px;padding:10px 17px 10px 20px;border-radius:0px 0px 5px 5px;"+body_css+"'>"+
                                                //PT매출
                                                "<label style='float:left;font-size:12px;font-weight:500;margin-top:-5px'>P.T매출</label><label style='float:right;font-size:12px;font-weight:500;line-height:20px;margin-top:-5px'>"+TXT_WON+CommaString(pr_newtotalprice)+"</label><br><br>"+                      
                                           
                                                //PT목표금액 
                                                "<label style='float:left;font-size:12px;font-weight:500;margin-top:-26px'>P.T목표금액</label>"+
                                                "<input id='target_amount_" + a + "_" + i + "' type='text' onfocus='this.select()' onclick='clickInnerObj()' onkeyup='inputChangeComma(\"target_amount_" + a + "_" + i + "\")' onchange='change_target_amount(\"" + payroll_centercode + "\"," + year + "," + month + ",\"" + item.pr_uid + "\"," + a + "," + i + ")' value='" + target_amount + "' style='float:right;margin-top:-26px;margin-right:-3px;font-size:12px;width:80px;height17px;border-radius:3px;border:0.5px solid #d9dced;color:#3f4254;text-align:right'><label style='float:right;font-size:12px;font-weight:500;margin-top:-25px;margin-right:63px'>"+TXT_WON+"</label><br>"+ 
                                           
                                                //총운동회원 명
                                                "<label style='font-size:12px;font-weight:500;margin-top:-25px;'>총P.T회원</label><label style='float:right;font-size:12px;font-weight:500;margin-top:-25px;'>"+totaluserlen+"명</label>"+
                                            "</div>"+
                                        "</div>";
                                    div_traners_info.innerHTML += traner_info_tag;

                                    var newtotalprices = !ismissing && item.pr_newtotalprice ? JSON.parse(item.pr_newtotalprice) : [];
//                                    clog("newtotalprices",newtotalprices);
                                    var str_newtotalprice = "";
                                    for(var j = 0 ; j < newtotalprices.length;j++){                                       
                                        var str = newtotalprices[j].date.substr(0,10)+", 이름:"+newtotalprices[j].username+", 가격:"+newtotalprices[j].price+",설명:"+newtotalprices[j].desc+"\n";
                                        str_newtotalprice += str;    
                                    }

                                    var totalremoveptcount = !ismissing ? table_data.totalremoveptcount : 0;
                                    var totalnowusecount = !ismissing ? table_data.totalnowusecount : 0;
                                    var totalgetprice = !ismissing ? table_data.totalgetprice : 0;

                                    excel_ptdata.push({"강사이름" : managername,"목표금액" : target_amount,"총매출" : CommaString(pr_newtotalprice),"총매출설명":str_newtotalprice,"총담당회원" : user_len+"명","잔여세션":totalremoveptcount+"회","총횟수" : totalnowusecount+"회","총금액" : CommaString(totalgetprice),"":""});
                                    for(var j = 0 ; j < excel_users_data.length;j++){
                                        excel_ptdata.push(excel_users_data[j]);
                                    }    
                                }                               
                                
                                var addheight  = total_len%5 == 0 ? 0 : 1;
                                div_traners_info.style.height = 20+135*Math.floor(total_len/5+addheight)+"px";
                            }
                        }
//                        mdiv.append(my_div);
                        mdiv.append(other_div);
                        container.append(mdiv);
                        //                        allListOpen(jsonarray.length);
                        
                        
                        
                    }
                    var id_nodata = document.getElementById("id_nodata");
                    id_nodata.style.display = isdata ? "none" : "block";


                    checkOpenList(year, month);
                    updateGXPriceDatas();  
                    
                } else {
                    container.innerHTML = ""; //초기화
                    alertMsg(res.message);

                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
        }
        var before_divid = "";
        function tranerinfo_hover(divid){

//            if(!before_divid || before_divid && before_divid != divid){
//                if(before_divid)
//                tranerinfo_animate(before_divid,false);
//                tranerinfo_animate(divid,true);
//                before_divid = divid;
//            }
        }
        function tranerinfo_animate(divid,isnow){
//              var divid = document.getElementById(divid);
//              divid.style.backgroundColor = divid.style.backgroundColor == "#5591fe" ?  "#5591feaa" : "#f5f8faaa";
//            $("#"+divid).animate({"opacity":1,zoom:1} ,200);
            
        }
        function getMyPriceSettingData(teacher_setting,year,month){
            var nym = parseInt(year)*12+parseInt(month);
            //강사 세팅이 있다면 
            var my_pricenamesetting = null;
                                    
            
            var max_aym = 0;
            
             //강사 세팅이 있다면 강사의 마지막 세팅을 가져온다.
            
            
            if(teacher_setting && teacher_setting.allpricesetting){
                 
                var isin = false;
                for(key of Object.keys(teacher_setting.allpricesetting)) {
                    var ym = key.split("-");
                    var aym = parseInt(ym[0])*12+parseInt(ym[1]);
                    if(nym == aym){
                        
                        isin = true;
                        my_pricenamesetting = teacher_setting.allpricesetting[key];
                        break;
                    }
                }
                if(!isin)
                for(key of Object.keys(teacher_setting.allpricesetting)) {
                    var ym = key.split("-");
                    var aym = parseInt(ym[0])*12+parseInt(ym[1]);
                    if(aym > max_aym){
                        
                        my_pricenamesetting = teacher_setting.allpricesetting[key];
                        max_aym = aym;
                    }
                }
            }
            //강사 세팅이 없다면 tb_centercode setting 에서 가져온다.                                    
            else if(!my_pricenamesetting && center_setting){
                my_pricenamesetting = center_setting.pricenamesetting;
            
            }
            
            
            
            //ison 은 글로벌에서 모두 가져온다.
            for(var i = 0 ; i < my_pricenamesetting.length; i++){
                var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                var mid = parseInt(my_pricenamesetting[i].id);
//                if(mtype == "price" && mid < 2 || mtype == "percent" && mid < 1)
                for(var j = 0 ; j < center_setting.pricenamesetting.length; j++){
                    
                    var ctype = center_setting.pricenamesetting[j].type && center_setting.pricenamesetting[j].type == "percent" ? "percent" : "price";
                    var cid = parseInt(center_setting.pricenamesetting[j].id);
                    if(mtype == ctype && mid == cid){
                        my_pricenamesetting[i].ison = center_setting.pricenamesetting[j].ison;
                    }
                }
            }
            //PT수당, 그룹수업수당, 원천징수  는 디폴트이므로 무조건 있는지 체크 후 없으면 삽입한다.
            my_pricenamesetting = checkDefaultRules(my_pricenamesetting);
            
            return my_pricenamesetting;
        }
        //PT수당, 그룹수업수당, 원천징수  는 디폴트이므로 무조건 있는지 체크 후 없으면 삽입한다.
        function checkDefaultRules(my_pricenamesetting){
            
            var ptrule = null;
            var gxrule = null;
            var taxrule = null;
            for(var j = 0 ; j < center_setting.pricenamesetting.length; j++){                    
                 var ctype = center_setting.pricenamesetting[j].type && center_setting.pricenamesetting[j].type == "percent" ? "percent" : "price";
                 var cid = parseInt(center_setting.pricenamesetting[j].id);
                 if(ctype == "price" && cid == 0){
                     ptrule = center_setting.pricenamesetting[j];
                 }else if(ctype == "price" && cid == 1){
                     gxrule = center_setting.pricenamesetting[j];
                 }
                 else if(ctype == "percent" && cid == 0){
                     taxrule = center_setting.pricenamesetting[j];
                 }
            }
            var isptrule = false;    
            var isgxrule = false;    
            var istaxrule = false;    
            for(var i = 0 ; i < my_pricenamesetting.length; i++){
                var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                var mid = parseInt(my_pricenamesetting[i].id);
                if(mtype == "price" && mid == 0){
                     isptrule = true;
                 }else if(mtype == "price" && mid == 1){
                     isgxrule = true;
                 }
                 else if(mtype == "percent" && mid == 0){
                     istaxrule = true;
                 }                    
            }
                
            if(ptrule&& !isptrule)my_pricenamesetting.push(ptrule);
            if(gxrule&& !isgxrule)my_pricenamesetting.push(gxrule);
            if(taxrule&& !istaxrule)my_pricenamesetting.push(taxrule);
            return my_pricenamesetting;
        }
        function allPriceListOpen(){
             var style = {
                    bodycolor: "#eeeeee",
                    size: {
                        width: "80%",
                        height: "100%"
                    }
                };
            var message_tag = getAllTotalPriceListTag();
           
            showModalDialog(document.body, year+"년 "+month+"월 전체 금액목록", message_tag, "확인", null, function() {
                hideModalDialog();

            },null,style);   
        }
        function getAllTotalPriceListTag(){

            var div = document.createElement("div");
            
            //////////////////////////////////////////////////////////
            //트레이너별 금액 이름 삽입
            //////////////////////////////////////////////////////////
            console.log("total_teacher_pricedatas ",total_teacher_pricedatas);
            var isname = false;
            var titles = [];
            titles.push("순번");
            titles.push("이름");
            
            // + 금액먼저 삽입
            for(key of Object.keys(total_teacher_pricedatas)) {
                for(var i = 0 ; i < total_teacher_pricedatas[key].length;i++){
                    isname = true;
                     var type = total_teacher_pricedatas[key][i].type && total_teacher_pricedatas[key][i].type == "percent" ? "percent" : "price";
                    var name = total_teacher_pricedatas[key][i].name;
                    if(type == "price")titles.push(name);
                }
            }
            // - 금액은 나중에 삽입
             for(key of Object.keys(total_teacher_pricedatas)) {
                for(var i = 0 ; i < total_teacher_pricedatas[key].length;i++){
                    isname = true;
                    var name = total_teacher_pricedatas[key][i].name;
                    if(type == "percent")titles.push(name);
                }
                
            }
            
            titles.push("총금액");
            titles = Array.from(new Set(titles));
            console.log("titles ",titles);
            var title_tag = "<tr class='fmont' style='text-align:center;background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>";
            
            var td_width = ["10%","10%","auto"];
           
            for(var i = 0 ; i < titles.length;i++){
                var width = i < 2 ? td_width[i] : "auto";
                title_tag +="<td style='vertical-align:middle;width:"+width+";height:50px;border-right:1px solid #e4e6ef;background-color:#f0f6fa'>" +
                                "<text style='font-weight:bold'>"+titles[i]+"</text>" +
                            "</td>";
            }
            title_tag += "</tr>";
//            console.log("title_tag ",title_tag);
            //세로 총금액 초기화
            var num = 1;
            var row_totalprices = [];
            for(var i = 0 ; i < titles.length;i++){
                row_totalprices.push(0);
            }
            
            //////////////////////////////////////////////////////////
            //트레이너별 금액 내용 삽입
            //////////////////////////////////////////////////////////
            var allpricedata_tag = "";
             for(key of Object.keys(total_teacher_pricedatas)) {
                var number = num < 10 ? "0"+num:""+num;
                
                var total_price = 0;
                var mem_teacher = getTeacherListByUid(teacherlist,key);
                var teacher_name = mem_teacher.mem_username;
                var teacher_uid = mem_teacher.mem_uid;
                allpricedata_tag +="<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                        "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+number+"</text>" +
                                        "</td>"+
                                        "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                            "<button class='btn' style='height:30px;background-color:#009ef7;border:0px;border-radius:5px;font-size:14px;color:white' onclick='showUserInfoPopup(\""+teacher_uid+"\");'>"+teacher_name+"</button>" +
                                        "</td>";
                            
                
                for(var j = 0 ; j < titles.length;j++){ 
                    var isin = false;
                    var tname = titles[j];
                    if(tname == "순번" || tname == "이름" || tname == "총금액")
                        isin = true;
                    
                    for(var i = 0 ; i < total_teacher_pricedatas[key].length;i++){
                        
                        var name = total_teacher_pricedatas[key][i].name;
                        
                        if(tname == name){
                            var type = total_teacher_pricedatas[key][i].type && total_teacher_pricedatas[key][i].type == "percent" ? "percent" : "price";
                            var isadd = type == "price" ? true : false;
                            var price = parseInt(total_teacher_pricedatas[key][i].price);
                            
                            
                            if(type == "price"){
                                row_totalprices[j] += parseInt(price);
                                total_price += parseInt(price);
                            }
                                
                            else {
                                row_totalprices[j] -= parseInt(price);
                                total_price -= parseInt(price);
                            }
                                console.log("33 price "+total_price);  
                            
                            var minus_tag = !isadd && price != 0 ? "-" : "";
                            allpricedata_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                                    "<text >"+minus_tag+""+CommaString(price)+"</text>" +
                                                "</td>";
                            isin = true;
                           
                            break;
                        }
                        
                    }
                    if(!isin){
                        allpricedata_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                                "<text >0</text>" +
                                            "</td>";
                    }
                }
                 //트레이너 총금액
                allpricedata_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                            "<text>"+CommaString(total_price)+""+TXT_KORWON+"</text>" +
                                        "</td>";
                allpricedata_tag += "</tr>";
                row_totalprices[titles.length-1] += total_price;                 
                num++;
               
             
                
            }
            console.log("row_totalprices ",row_totalprices);
            //하단 전체 총금액 내용 삽입
            var rowtotalprice_tag = "<tr class='fmont' style='text-align:center;background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+ 
                                    "<td colspan = '2' style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                        "<text >Total</text>" +
                                    "</td>";
            for(var i = 2 ; i < row_totalprices.length;i++){
                var row_totalprice = row_totalprices[i];
                rowtotalprice_tag += "<td style='vertical-align:middle;height:50px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+CommaString(row_totalprice)+""+TXT_KORWON+"</text>" +
                                    "</td>";

            }
            rowtotalprice_tag += "</tr>";
            
            div.innerHTML = "<div align='center' style='width:100%;height:auto'>"+
                                "<table id='table_total_all_pricedata' align='center' class='table table-bordered' style='width:100%;height:auto;text-align:center'>"+                                    
                                        title_tag+                                        
                                        allpricedata_tag+                                        
                                        rowtotalprice_tag+                                                                            
                                 "</table>"+   
                                "<button onclick='exportTotalPriceExcel(\"table_total_all_pricedata\")' style='float:left;border:0px;background-color:#1d7146;border-radius:5px;font-size:14px;color:white;font-weigh:500;width:230px;height:35px;outline:none'><img src = './img/ic_excel.png' style='height:22px;margin-top:-1px;margin-right:10px'/>&nbsp;엑셀로 다운로드</button>"+
                            "</div>";

//            console.log(""+div.innerHTML);
            return div.innerHTML;

        }
        function updateGXPriceDatas(){
            if(teacher_gxprice_data){
                //key = teacheruid
                for(key of Object.keys(teacher_gxprice_data)) {
                     var table_gxpayroll = document.getElementById("table_gxpayroll_"+key);
                     if(table_gxpayroll){
                         table_gxpayroll.innerHTML = 
                                "<tr class='fmont' style='text-align:center;background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                     
                                        "<td style='vertical-align:middle;width:10%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>순번</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>정산방식</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>수업료</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>수업횟수</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:15%;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text style='font-weight:bold'>금액</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:auto;height:45px;'>" +
                                            "<text style='font-weight:bold'>내용</text>" +
                                        "</td>" +
                                        
                                    "</tr>";
                         
                         table_gxpayroll.innerHTML += teacher_gxprice_data[key].gxpricedata_tag ? teacher_gxprice_data[key].gxpricedata_tag : "";
                         var gx_bottom_total = document.getElementById("gx_bottom_total_"+key);
                         var now_total_roomcount = teacher_gxprice_data[key].now_total_roomcount ? teacher_gxprice_data[key].now_total_roomcount : "0";
                         var totalprice = teacher_gxprice_data[key].totalprice ? parseInt(teacher_gxprice_data[key].totalprice) : 0;
                         if(gx_bottom_total)gx_bottom_total.innerHTML = "총 횟수 : " + now_total_roomcount+ "회 , 총금액 : "+TXT_WON + CommaString(totalprice);
                     }
                 }
            }
            
//            var reservation_container = document.getElementById("reservation_container");
//            reservation_container.style.height = "1300px";
        }
        var before_selected_traner_uid = {};
        function onclick_trander(idx,manageruid,y,m){
            var div_traner_userinfos = document.getElementById("div_traner_userinfos_"+manageruid);
            var div_tranerinfo = document.getElementById("div_tranerinfo_"+manageruid);
            var div_tranerinfo_title = document.getElementById("div_tranerinfo_title_"+manageruid);
            var div_tranerinfo_body = document.getElementById("div_tranerinfo_body_"+manageruid);
            
            var before_div_traner_userinfos = document.getElementById("div_traner_userinfos_"+before_selected_traner_uid[y+"-"+m]);
            var before_div_tranerinfo = document.getElementById("div_tranerinfo_"+before_selected_traner_uid[y+"-"+m]);
            var before_div_tranerinfo_title = document.getElementById("div_tranerinfo_title_"+before_selected_traner_uid[y+"-"+m]);
            var before_div_tranerinfo_body = document.getElementById("div_tranerinfo_body_"+before_selected_traner_uid[y+"-"+m]);
            
            if(manageruid == before_selected_traner_uid[y+"-"+m])return;

            
            ///////////////////////////////////////////////////////////
            // name animation START
            ///////////////////////////////////////////////////////////
                var mem_teacher = getTeacherListByUid(teacherlist,manageruid);

                var div_temp = document.createElement("div");
                div_temp.id = "div_temp";
                div_temp.align = "center";
                
                div_temp.innerHTML = "<label style='font-weight: 500;font-size:16px' >"+mem_teacher.mem_username+"</label>";
                var div_traners_info = document.getElementById("div_traners_info");

                var mleft = (idx%5)*242+4;
                var mtop = parseInt(idx/5)*135+5;
                
                div_temp.style="position:absolute;width:230px;height:120px;background-color:#009ef7;color:white;border-radius:5px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float:left;padding:10px 20px;10px;20px;margin-left:"+mleft+"px;margin-top:"+mtop+"px;cursor:pointer";


                var tlen = div_traners_info.children.length;
                var hlen = tlen > 0 ? parseInt((tlen-1)/5) : 0;
                var addheight = (hlen-parseInt(idx/5))*135;
                
                div_traners_info.appendChild(div_temp);

                var anitop = parseInt(div_temp.style.marginTop)+170+addheight;
                var anileft = parseInt(div_temp.style.marginLeft)-mleft+87;
                div_temp.style.opacity = "0.0";
                $("#div_temp").animate({"margin-top":anitop, "margin-left":anileft, "width":"69px","height":"36px","opacity":1,"transition":"top 1s"} ,500,function(){
                    div_traners_info.removeChild(div_temp);
                });
            
//                $("#div_traner_userinfos_"+manageruid).animate({"zoom":1.1,"opacity":1} ,300,function(){
//                    $("#div_traner_userinfos_"+manageruid).animate({"zoom":1,"opacity":1} ,300);    
//                    
//                });
            ///////////////////////////////////////////////////////////
            // name animation END
            ///////////////////////////////////////////////////////////
            
            
            
//            var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
//            var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
//            var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D9DCED;";
            
            div_tranerinfo.style.border = "0px";
            div_tranerinfo.style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
            div_tranerinfo_title.style.borderBottom = "0px";
            div_tranerinfo_body.style.backgroundColor = "#F1FAFF";
            div_tranerinfo_body.style.borderBottom = "0px";
            div_traner_userinfos.style.display = "block";
            
//            console.log("before_selected_traner_uid[ym]is "+before_selected_traner_uid[y+"-"+m]);
            if(before_div_tranerinfo){
//                console.log("before_div_tranerinfo!! ");
                before_div_tranerinfo.style.border = "1px solid #D9DCED";
                before_div_tranerinfo.style.boxShadow = "0px 0px 0px rgba(0, 0, 0, 0.0)";
                before_div_tranerinfo.style.backgroundColor = "white";
                before_div_tranerinfo_title.style.borderBottom = "1px solid #D9DCED";
                before_div_tranerinfo_body.style.backgroundColor = "white";
                before_div_tranerinfo_body.style.borderBottom = "1px solid #D9DCED";
                
                before_div_traner_userinfos.style.display = "none";
            }
            
            saveSelectedTeacher(manageruid,y,m);
            
            before_selected_traner_uid[y+"-"+m] = manageruid;
            
            
//           var gx_table = document.getElementById("div_gxpayroll_"+manageruid);
//            var tab_idx = gx_table.style.display == "block" ? 1 : 0;
            click_users_tab(ptgx_tab_index,manageruid);
            updateReservationContainer(ptgx_tab_index,manageruid);
            
        }
        var export_excel_filename = "";
        var export_totalprice_excel_filename = "";
        
        var isClickMoreTotal = false;
        function clickInnerObj(){
//            clog("clickInnerObj");
            isClickMoreTotal = true;
        }
        
        
        var teacher_gxprice_data = {};
        
        var total_teacher_pricedatas = {};
        function getTeacherAllPriceTag(teacheruid,idx,y,m,my_pricenamesetting,pt_price){
            
            //tb_centercode-setting : pricenamesetting  == mem_setting.allpricesetting[y+"-"+m].pricenamesetting
//            if(!teacher_setting)teacher_setting = {};
            
           total_teacher_pricedatas[teacheruid] = [];

//          
            var price_datas = getMyPriceNameSetting(my_pricenamesetting,"price");
           
           
            var allprice = 0;
           
            console.log("aaaa ",my_pricenamesetting);
            ////////////////////////////////////////////
            // + 금액 추가되는 데이타
            ////////////////////////////////////////////
            var price_tag = "";
            if(price_datas)
            for(var i = 0 ; i < price_datas.length;i++){
                var p = price_datas[i];
//                console.log("p is ",p);
                var name = p.name;
                var price = p.price;
                //
                if(i == 0){
                    price = pt_price;
                }else if(i == 1){
                    
                    var gxgroupdata = getGXGroupPriceCalculate(teacheruid,p);
                    price = gxgroupdata && gxgroupdata.totalprice ? gxgroupdata.totalprice : 0;
                    teacher_gxprice_data[teacheruid] = gxgroupdata;
                }
                
                var id = p.id;
                var divid_tag = i%5 != 0 && price_tag != "" ? "<label style='margin-left:20px;margin-right:20px;color:#D9DCED;float:left;'>|</label>" : "";                
                var input_id = "inputprice_price_"+idx+"_"+id;
                var br5 = i != 0 && i%5 == 0 ? "<br><br>":"";

                if(p.ison == "true"){
                    
                    //idx : 트레이너 순번 
                    //id : namesetting id 번호 
                    if(i == 0){
                        
                        price_tag += br5+divid_tag+
                            "<text style='font-size:16px;float:left;font-weight:400' ><i class='fa-solid fa-lock' style='font-size:14px;color:gray' title='해당 금액은 자동으로 산정됩니다.'></i>&nbsp;"+name+"</text>"+
                            "<text id='textprice_price_"+idx+"_"+id+"' style='float:left;margin-left:20px;font-size:18px;font-weight:700'>"+CommaString(price)+""+TXT_KORWON+"</text>";
                    }else if(i == 1){
                        
                        price_tag += br5+divid_tag+
                            "<text style='font-size:16px;float:left;font-weight:400' ><i class='fa-solid fa-lock' style='font-size:14px;color:gray' title='해당 금액은 자동으로 산정됩니다.'></i>&nbsp;"+name+"</text>"+
                            "<text id='textprice_price_"+idx+"_"+id+"' style='float:left;margin-left:20px;font-size:18px;font-weight:700'>"+CommaString(price)+""+TXT_KORWON+"&nbsp;&nbsp;&nbsp;<i class='fa-solid fa-gear' style='cursor:pointer;margin-bottom:10px' onclick='show_my_pricesetting(\""+teacheruid+"\",\""+setJSONStringToParamString(my_pricenamesetting)+"\","+y+","+m+")'></i></text>";
                    }else {
                        price_tag += br5+divid_tag+
                            "<text style='font-size:16px;float:left;font-weight:400' onclick='click_pricetxt(\"price\", "+idx+", "+id+")'>"+name+"</text>"+
                            "<text id='textprice_price_"+idx+"_"+id+"' style='float:left;margin-left:20px;font-size:18px;font-weight:700' onclick='click_pricetxt(\"price\", "+idx+", "+id+")'>"+CommaString(price)+""+TXT_KORWON+"</text>"+
                            "<input class='fmont' id='"+input_id+"' type='text' onchange='outfocus_priceinput(\""+teacheruid+"\", \""+setJSONStringToParamString(p)+"\",  \""+setJSONStringToParamString(my_pricenamesetting)+"\", " + pt_price + ", " + y + ", " + m + ", " + idx + ", " + id + ")'  onfocus='this.select()' onkeyup='inputChangeComma(\"" + input_id + "\")'  value ='"+CommaString(price)+"' style='float:left;display:none;outline:none;border:0px;margin-left:20px;width:120px; height:30px;border-radius:10px;background-color:#eef3f7;font-size: 16px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;margin-right:10px' >"
                    }
                    total_teacher_pricedatas[teacheruid].push({"id":id,"type":"price","name":name,"price":price});
                }           
               
                allprice += parseInt(price);
            }
            
            ////////////////////////////////////////////
            // - 퍼센트 차감되는 데이터
            ////////////////////////////////////////////
            var percent_datas = getMyPriceNameSetting(my_pricenamesetting,"percent");
            var percent_tag = "";
            if(percent_datas)
            for(var i = 0 ; i < percent_datas.length;i++){
                var p = percent_datas[i];
//                console.log("percent_datas p is ",p);
                var name = p.name;
                
                var percent = parseFloat(p.percent);
                var price = parseInt((allprice/100)*percent);
                
              
                var id = p.id;
                var divid_tag = i%5 != 0 ? "<label style='margin-left:20px;margin-right:20px;color:#D9DCED;float:left;'>|</label>" : "";                
                var input_id = "inputprice_percent_"+idx+"_"+id;
                var label_id = "labelprice_percent_"+idx+"_"+id;
                var br5 = i != 0 && i%5 == 0 ? "<br><br>":"";
//                console.log(i+"p ison");
                if(p.ison == "true"){
                     var minus_tag = price != 0 ? "-" : "";
                    if(i == 0){
                        percent_tag +=br5+divid_tag+
                            "<text style='font-size:16px;float:left;font-weight:400' ><i class='fa-solid fa-lock' style='font-size:14px;color:gray' title='해당 금액은 자동으로 산정됩니다.'></i>&nbsp;"+name+"("+percent+"%)</text>"+
                            "<text id='textprice_percent_"+idx+"_"+id+"' style='float:left;margin-left:20px;font-size:18px;font-weight:700'>"+minus_tag+""+CommaString(price)+""+TXT_KORWON+"</text>";
                    }else{
                        
                       
                        percent_tag += br5+divid_tag+
                            "<text style='font-size:16px;float:left;font-weight:400' onclick='click_pricetxt(\"percent\", "+idx+", "+id+")'>"+name+"("+percent+"%)</text>"+
                            "<text id='textprice_percent_"+idx+"_"+id+"' style='float:left;margin-left:20px;font-size:18px;font-weight:700' onclick='click_pricetxt(\"percent\", "+idx+", "+id+")'>"+minus_tag+""+CommaString(price)+""+TXT_KORWON+"</text>"+
                            "<input class='fmont' id='"+input_id+"' type='text' onchange='outfocus_priceinput(\""+teacheruid+"\", \""+setJSONStringToParamString(p)+"\",  \""+setJSONStringToParamString(my_pricenamesetting)+"\", " + pt_price + ", " + y + ", " + m + ", " + idx + ", " + id + ")'  onfocus='this.select()' onkeyup='inputChangeFloat(\"" + input_id + "\")'  value ='"+percent+"' style='float:left;display:none;outline:none;border:0px;margin-left:20px;width:120px; height:30px;border-radius:10px;background-color:#eef3f7;font-size: 16px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;margin-right:10px'><label id='"+label_id+"' style='display:none;float:left;margin-left:-35px;margin-top:2px'>%</label>";
                    }
                      total_teacher_pricedatas[teacheruid].push({"id":id,"type":"percent","name":name,"price":price});
                }           
               
                allprice -= parseInt(price);
            }
            //console.log("price_tag "+price_tag);
            return {"price":allprice,"price_tag":price_tag,"percent_tag":percent_tag};
            
        }
        function getMyPriceNameSetting(my_pricenamesetting,type){
            var arr_rule = [];
            for(var i = 0 ;i < my_pricenamesetting.length; i++){
                var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                if(mtype == type){
                    arr_rule.push(my_pricenamesetting[i]);

                }
            }
            return arr_rule;
        }
        //gx 금액세팅데이타
        function getGXGroupPriceCalculate(teacheruid,pdata){ //pdata = price data
            var total_gxprice = 0;
            if(!pdata.gxpricerule)return total_gxprice;
            
            var myroomdatas = getTeacherRoomDatas(teacheruid);
            
            //p.lesson , p.usertype , p.user[] , p.nosho , p.noshow ,p.nobody , p.other
            var p = pdata.gxpricerule;
            var pricetype = p.pricetype;
            var usertype = p.usertype;
            
            var lesson_price = 0; //강좌별 금액
            var user_price = 0; //수강인원별 금액
            // (강좌가 오픈되었으며 : 예약은 1명이상 되어있으나 아무도 출석하지 않았을때)
            var noshow_price = 0;
            // (강좌가 오픈되었으며 : 아무도 예약하지 않았을때)
            var nobody_price = 0;
            //기타
            var other_price = parseInt(p.other);
            
            
           
            var gxpricedata_tag = "";
            
            //노쇼,노바디를 제외한 현재시간까지 횟수
            
            var now_lesson_count = 0; //강좌별일때 횟수 
            var now_total_room_count = 0; //강좌별일때 횟수 
            var now_noshow_count = 0;
            var now_nobody_count = 0;
            
            var usertype_price = {};
            
//            console.log("myroomdatas ",myroomdatas);
            for(var i = 0; i < myroomdatas.length; i++){
                var room_datetime = myroomdatas[i].room_datetime;
                
                var room_min = parseInt(myroomdatas[i].room_min);
                var room_lessontime = myroomdatas[i].room_lessontime;
                var end_min = parseInt(room_min)+parseInt(room_lessontime);
                var room_lesson_endtime = nextMin(room_datetime,end_min);
                var room_isshow = parseInt(myroomdatas[i].room_isshow);
                
//                console.log(i+" "+room_datetime+" ~ "+room_lesson_endtime+" end_min "+end_min+" room_isshow "+room_isshow+" isend : "+isNowTimeMinOver(room_lesson_endtime) );
                //강좌가 종료된 방정보만 계산한다.
                if(isNowTimeMinOver(room_lesson_endtime) < 0 && room_isshow == 1){
                    
                    var room_max = parseInt(myroomdatas[i].room_max);
                    var room_users = myroomdatas[i].room_users ? myroomdatas[i].room_users : [];
                    var now_noshow = false;
                    var now_nobody = false;
                    var user_len = room_users ? room_users.length : 0; //방에 예약한 회원수
                    var user_ready_cnt = 0; //예약한상태
                    var user_checkin_cnt = 0; //QR 출석한상태
                    for(var j=0; j < room_users.length; j++){
                        if(room_users[j].status == "0") //예약한상태
                            user_ready_cnt++;
                        else if(room_users[j].status == "2")//QR 출석한상태
                            user_checkin_cnt++;
                    }
                    
                    //강좌별
                    if(pricetype == "0"){
                        //노쇼 횟수 ,금액
                        if(user_ready_cnt > 0 && user_checkin_cnt == 0){
                            noshow_price += parseInt(p.noshow);
                            now_noshow_count++;
                        }
                        //노바디 횟수 ,금액
                        else if(user_ready_cnt == 0 && user_checkin_cnt == 0){
                            nobody_price += parseInt(p.nobody);
                            now_nobody_count++;
                        }
                        //강좌별 계산인데 노쇼, 노바디 가격이 0 이어도 강좌로 체크한다.
                        else {
                            lesson_price += parseInt(p.lesson);    
                            now_lesson_count++;
                        }
                    }
                    //수강인원별
                    else {
                        if(p.user)
                        for(var a = 0 ; a < p.user.length; a++){
                            var len = parseInt(p.user[a].len);
                            var len_price = parseInt(p.user[a].price);
                            var check_len = usertype == 0 ? user_len : user_checkin_cnt;
                            if(!usertype_price[""+len])usertype_price[""+len] = {"defaultprice":len_price,"count":0,"total_price":0};

                            if(check_len <= len){
                                user_price += len_price;
//                                    console.log(i+" len_price "+len_price);

                                usertype_price[""+len].count++; 
                                usertype_price[""+len].total_price += len_price; 

                                break;
                            }
                        }

                    }
                    
                    now_total_room_count++;
                                    
                }
            }
//            console.log("now_noshow_count "+now_noshow_count+" now_nobody_count "+now_nobody_count+" now_lesson_count "+now_lesson_count);
            
            //강좌별일때 해당 금액을 모두 합산한다.
            if(pricetype == "0"){
//                console.log("lesson :  lesson_price "+lesson_price+" noshow_price "+noshow_price+" nobody_price "+nobody_price+" other_price "+other_price);
                total_gxprice = lesson_price + noshow_price + nobody_price + other_price;
                
                
                 gxpricedata_tag += "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >01</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >강좌별 계산</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(parseInt(p.lesson))+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+now_lesson_count+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(lesson_price)+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                        "<text ></text>" +
                                    "</td>" +
                                "</tr>"+
                                "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >02</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >노쇼</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(parseInt(p.noshow))+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+now_noshow_count+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(noshow_price)+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                        "<text ></text>" +
                                    "</td>" +
                                "</tr>"+
                                "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >03</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >노바디</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(parseInt(p.nobody))+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+now_nobody_count+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                        "<text >"+ CommaString(nobody_price)+"</text>" +
                                    "</td>" +
                                    "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                        "<text ></text>" +
                                    "</td>" +
                                "</tr>";
                     
            }
            //수강인원별일때 해당 금액을 모두 합산한다.
            else{
//                console.log("user :  user_price "+user_price+" noshow_price "+noshow_price+" nobody_price "+nobody_price+" other_price "+other_price);
                
                total_gxprice = user_price + other_price;
                
                var cnt = 1;
                var offset = 0;
                for(key of Object.keys(usertype_price)) {
                     
                     var value = usertype_price[key];
                    var num = cnt < 10 ? "0"+cnt : ""+cnt;
                    
                     gxpricedata_tag += "<tr class='fmont' style='background-color:#ffffff;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                        "<td style='vertical-align:middle;width:100px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+num+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+offset+"~"+key+"인</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+usertype_price[key].defaultprice+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+usertype_price[key].count+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:150px;height:45px;border-right:1px solid #e4e6ef'>" +
                                            "<text >"+ CommaString(usertype_price[key].total_price)+"</text>" +
                                        "</td>" +
                                        "<td  style='vertical-align:middle;width:360px;height:45px;'>" +
                                            "<text ></text>" +
                                        "</td>" +
                                    "</tr>";
                    offset = parseInt(key)+1; 
                    cnt++;
                }

            }
//            var gx_bottom_total = document.getElementById("gx_bottom_total_"+teacheruid);
//            gx_bottom_total.innerHTML = "총 횟수 : " + now_total_room_count + "회 , 총금액 : "+TXT_WON + CommaString(total_gxprice) + "";
            return {"totalprice":total_gxprice,"now_total_roomcount":now_total_room_count,"gxpricedata_tag":gxpricedata_tag};
        }
        function getTeacherRoomDatas(teacheruid){
            var myroomdatas = [];
            if(gxdatas)
            for(var i = 0; i < gxdatas.length;i++){
                var gx_roomdata = JSON.parse(gxdatas[i].gx_roomdata);
                if(gx_roomdata.room_managerid == teacheruid){
                    myroomdatas.push(gx_roomdata);
                }
                    
            }
            return myroomdatas;
        }
       function outfocus_priceinput(teacheruid, str_p, str_my_pricenamesetting, pt_price, y,m,idx,id){
            var p = JSON.parse(str_p);
            var ptype = p.type && p.type == "percent" ? "percent" : "price";
           
            var my_pricenamesetting = JSON.parse(str_my_pricenamesetting);
            var textprice = document.getElementById("textprice_"+ptype+"_"+idx+"_"+id);
            var inputprice = document.getElementById("inputprice_"+ptype+"_"+idx+"_"+id);
            var inputpercent = document.getElementById("inputprice_"+ptype+"_"+idx+"_"+id);
           
//            console.log(idx+"_"+id+" inputprice.value "+inputprice.value);
            textprice.innerHTML = inputprice.value+""+TXT_KORWON;
            textprice.style.display = "block";
            inputprice.style.display = "none";
            inputpercent.style.display = "none";
           
            if(my_pricenamesetting){
                for(var i =0 ;i< my_pricenamesetting.length; i++){
                    var mtype = my_pricenamesetting[i].type && my_pricenamesetting[i].type == "percent" ? "percent" : "price";
                    if(ptype ==  mtype && my_pricenamesetting[i].id == id){
                        if(ptype == "percent")
                            my_pricenamesetting[i].percent = parseCommaFloat(inputpercent.value);
                        else 
                            my_pricenamesetting[i].price = parseCommaInt(inputprice.value);
                        
                        break;
                    }
                        
                }
                
//                console.log("outfocus_priceinput  my_pricenamesetting ",my_pricenamesetting);
            }
               
           
           updateMyPriceNameSetting(teacheruid,y,m,my_pricenamesetting,function(res){
                //res : success
                var allpricedata = getTeacherAllPriceTag(teacheruid,idx,y,m,my_pricenamesetting,pt_price);            
                var div_total_price = document.getElementById("div_total_price_"+teacheruid);
                div_total_price.innerHTML = getAllPriceTableTag(allpricedata, my_pricenamesetting, teacheruid, y, m);   
               
                updateGXPriceDatas();
           })
           
           
            
        }
        function updateMyPriceNameSetting(teacheruid,y,m,my_pricenamesetting,callback){
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "updatemypricenamesetting",
                value: {"teacheruid":teacheruid,"year":year,"month":month,"pricenamesetting":my_pricenamesetting}
            }

            CallHandler("adm_get", senddata, function(res) {
                if (res.code == "100") {
                    C_showToast("성공", "해당 금액을 성공적으로 수정했습니다.", function() {});
                    callback("success");
                }else{
                    alertMsg("에러 "+res.message);
                }
                
            }, function(err) {
                alertMsg(err)
            });
               
        }
        
        
        function getAllPriceTableTag(allpricedata,my_pricenamesetting,teacheruid,y,m){
//            console.log("총급여 ",allpricedata);
            var mem_teacher = getTeacherListByUid(teacherlist,teacheruid);
           
            if(allpricedata.price == 0 && !allpricedata.tag)allpricedata.tag = "<label style='color:#f4436d'>※금액지급설정이 되어있지 않습니다. 급여기본설정 화면으로 이동하여 <br>지급금액 내용(선택사항)을 입력후 [설정정보 저장하기] 버튼을 눌러주세요.</label><button class='btn btn-primary btn-raised' style='margin-left:20px;float:right' onclick='loadMainDiv(15)'>이동하기</button>";
            var rtag = "";
            if(mem_teacher)rtag = "<table style='width:100%'>"+
                                        "<tr>"+
                                            "<td rowspan='2' align='center' style='width:220px;padding-right:15px'>"+
                                                "<lable style='font-size:20px;font-weight:700'><span style='background-color:009ef7;border-radius:5px;color:white;padding:5px 15px 5px 15px;font-size:16px;cursor:pointer' onclick='showUserInfoPopup(\""+teacheruid+"\")'>"+mem_teacher.mem_username+"</span></label><br>"+
                                                "<lable style='font-size:20px;font-weight:700;line-height:50px'>총급여</label>&nbsp;&nbsp;<lable id='label_total_allprice' style='font-size:20px;font-weight:700'>"+CommaString(allpricedata.price)+""+TXT_KORWON+"</label>"+
                                            "</td>"+    
                                            "<td align='center' style='padding-right:20px;padding-bottom:15px'>"+
                                                 allpricedata.price_tag+
                                            "</td>"+    
                                        "</tr>"+
                                        "<tr style='border-top:1px solid #e9e9e9'>"+
                                
                                             "<td align='center' style='padding-right:20px;padding-top:15px'>"+
                                                 allpricedata.percent_tag+
                                            "</td>"+    
                                        "</tr>"+
                                        
                                        "</table>"+
                                        "";
            return rtag;
        }
        
        
        var selected_my_pricenamesetting = null;
        var selected_teacheruid = "";
        var selected_y = 0;
        var selected_m = 0;
        function show_my_pricesetting(teacheruid,str_my_pricenamesetting,y,m){
            
            selected_my_pricenamesetting = JSON.parse(str_my_pricenamesetting);
            selected_teacheruid = teacheruid;
            selected_y = y;
            selected_m = m;
            
//            console.log("show_my_pricesetting ",str_my_pricenamesetting);
            showGXPricePopup(selected_my_pricenamesetting[1].gxpricerule);
        }
        function setGXPriceRuleDatas(gxpricerule){
            //gxpricerule = {"pricetype":0,"lesson":0,"user":[],"noshow":0,"nobody":0,"other":0};


            var inputid_pricetype_lesson = document.getElementById("inputid_pricetype_lesson");
            var inputid_noshow = document.getElementById("inputid_noshow");
            var inputid_nobody = document.getElementById("inputid_nobody");
            var inputid_other = document.getElementById("inputid_other");
            gxpricerule.lesson = parseCommaInt(inputid_pricetype_lesson.value);
            gxpricerule.noshow = parseCommaInt(inputid_noshow.value);
            gxpricerule.nobody = parseCommaInt(inputid_nobody.value);
            gxpricerule.other = parseCommaInt(inputid_other.value);
            gxpricerule.pricetype = global_gxpricetype;
            gxpricerule.user = [];
            var usertype_1 = document.getElementById("usertype_1");
            gxpricerule.usertype = usertype_0 && usertype_1.checked ? 1 : 0;
            for(var i = 1 ; i < 10 ; i++){
                var gx_priceid = document.getElementById("gx_priceid_"+i);
                if(gx_priceid)gxpricerule.user.push({"len":i,"price":parseCommaInt(gx_priceid.value)});
            }

//            console.log("gxpricerule ",gxpricerule);
            
            
            //user mem_setting에 저장한다.
            //sendMyGXPriceRule(teacheruid,gxpricerule,y,m);
            selected_my_pricenamesetting[1].gxpricerule = gxpricerule;
            
            updateMyPriceNameSetting(selected_teacheruid,selected_y,selected_m,selected_my_pricenamesetting,function(res){
                //res : success
                 C_showToast("성공", "GX 금액설정을 성공적으로 수정했습니다.", function() {});
                loadMainDiv(9);
           });
        }
        var before_price_id = "";
        function click_pricetxt(type,idx,id){
            var now_price_id = type+"_"+idx+"_"+id;
            var textprice = document.getElementById("textprice_"+now_price_id);
            var inputprice = document.getElementById("inputprice_"+now_price_id);
            var labelprice = type == "percent" ? document.getElementById("labelprice_"+now_price_id) : null;
            
            
            textprice.style.display = "none";
            inputprice.style.display = "block";
            if(labelprice)labelprice.style.display = "block";
            inputprice.onfocus = inputprice.select();
            
            
            if(before_price_id && before_price_id != now_price_id){
                var before_textprice = document.getElementById("textprice_"+before_price_id);
                var before_inputprice = document.getElementById("inputprice_"+before_price_id);
                var before_labelprice = document.getElementById("labelprice_"+before_price_id);
                before_textprice.style.display = "block";
                before_inputprice.style.display = "none";
                if(before_labelprice)before_labelprice.style.display = "none";
                   
            }
            before_price_id = type+"_"+idx+"_"+id; 
            
            
        }
        function showTotalPriceList(index,teacher_uid,year,month){
            var newtotalpricelist = [];
            
          
            
            for (var i = 0; i < alllist.length; i++) {
                var item = alllist[i]; //트레이너
                if(item){
                    if(item.pr_uid == teacher_uid && item.pr_newtotalprice){
                        newtotalpricelist = JSON.parse(item.pr_newtotalprice);     
                         break;
                    }
                }
            }
            if(newtotalpricelist.length >= 0){
                var style = {
                        bodycolor: "#eeeeee",
                        size: {
                            width: "80%",
                            height: "100%"
                        }
                    };
                var message_tag = getPayrollTotalPriceList(teacher_uid, year, month, newtotalpricelist);
                if(auth >= AUTH_OPERATOR)message_tag += "<button  class='btn btn-primary btn-raised' style='float:right'  onclick='showInputTotalPriceDummy(\""+teacher_uid+"\",\""+year+"\",\""+month+"\")'>더미입력</button>";
                showModalDialog(document.body, "총금액 목록", message_tag, "확인", null, function() {
                    hideModalDialog();

                },null,style);
            }
        }
         function showInputTotalPriceDummy(teacheruid,year,month){
            
            
             var message = "<table style='width:100%;text-align:center;background-color:white;font-size:14px;font-weight:400'>"+
                                 "<tr>"+
                                        "<td style='width:25%;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px'>"+                                    
                                            "<label>날짜</label>"+
                                        "</td>"+
                                        "<td style='width:25%;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px'>"+                                    
                                            "<label >이름</label>"+
                                        "</td>"+   
                                        "<td style='width:25%;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px'>"+                                    
                                            "<label >설명</label>"+
                                        "</td>"+
                                        "<td style='width:25%;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px'>"+                                    
                                            "<label >가격</label>"+
                                        "</td>"+
                                    "<tr>"+
                                    "</tr>"+
                                        "<td>"+ 
                                            "<input id='ntdate' type ='date' class='form-control' value='\""+getToday()+"\"'>"+
                                        "</td>"+
                                        "<td>"+
                                            "<input id='ntname'  class='form-control' value='' placeHolder='이름을 입력하세요...'>"+
                                        "</td>"+ 
                                        "<td>"+ 
                                            "<input  id='ntdesc' class='form-control' placeholder='내용을 입력하세요' />"+
                                        "</td>"+
                                        "<td>"+
                                            "<input type='number' id='ntprice' onfocus='this.select()'  class='form-control' value='0' placeholder='삽입할 금액을 입력하세요' />"+
                                        "</td>"+ 
                                    "</tr>"+
                                "</table>";
            showModalDialog(document.body, "총금액 더미삽입", message, "더미 삽입하기", "취소", function() {
                var ntdate = document.getElementById("ntdate");
                var ntname = document.getElementById("ntname");
                var ntdesc = document.getElementById("ntdesc");
                var ntprice = document.getElementById("ntprice");
                var dummy = {
                    
                    "date":ntdate.value,
                    "name":ntname.value,
                    "desc":ntdesc.value,
                    "price":ntprice.value,  
                }
                sendInputTotalDummy(teacheruid,year, month,dummy);

            }, function() {
                hideModalDialog();
            });
        }
        function sendInputTotalDummy(teacheruid,year,month,dummy){
        
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "inputtotalpricedummy",
                value: {"teacheruid":teacheruid,"year":year,"month":month,"dummy":dummy}
            }

            CallHandler("adm_get", senddata, function(res) {
                if (res.code == "100") {
                   C_showToast("성공", "성공적으로 삽입했습니다.", function() {});
                    getMyTranerHistory(year, month); // 목록 다시 호출한다.
                    hideModalDialog();hideModalDialog();
                }else{
                    alertMsg("에러");
                }

            }, function(err) {
                alertMsg(err)
            });
        }
        function update_dummydata(type,idx,teacher_uid,year,month,str_dummbdata){
             var dummy = JSON.parse(str_dummbdata);
            var tagname = "nt"+type+"_"+idx;
            var ntid = document.getElementById(tagname);
            switch(type){
                case "name":
                    dummy.username = ntid.value;
                    break;
                case "desc":
                    dummy.desc = ntid.value;
                    break;
                case "price":
                    dummy.price = parseCommaInt(ntid.value);
                    break;
            }
            
             var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "updatetotalpricedummy",
                value: {"teacheruid":teacheruid,"year":year,"month":month,"dummy":dummy}
            }

            CallHandler("adm_get", senddata, function(res) {
                if (res.code == "100") {
                   C_showToast("성공", "성공적으로 삽입했습니다.", function() {});
                    getMyTranerHistory(year, month); // 목록 다시 호출한다.
                    hideModalDialog();hideModalDialog();
                }

            }, function(err) {
                alertMsg(err)
            });
        }
        function delete_dummy(teacheruid,year,month,str_dummbdata){
            var dummy = JSON.parse(str_dummbdata);
            
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "removetotalpricedummy",
                value: {"teacheruid":teacheruid,"year":year,"month":month,"dummy":dummy}
            }

            CallHandler("adm_get", senddata, function(res) {
                if (res.code == "100") {
                   C_showToast("성공", "성공적으로 삽입했습니다.", function() {});
                    getMyTranerHistory(year, month); // 목록 다시 호출한다.
                    hideModalDialog();hideModalDialog();
                }

            }, function(err) {
                alertMsg(err)
            });
        }
        function getPayrollTotalPriceList(teacher_uid, year, month,rows){
            //$pt_jsonprice = array("date"=>$now,"price" => $pt_price, "useruid"=>$user_uid, "couponid"=>$couponid,"desc"=>$username."(PT ".$ptmaxcount."회 이용권)");
        //    rows.sort(sort_by('pm_date', true, (a) => a.toUpperCase()));
            var div_totalprice_list =document.createElement("div");
            var table = document.createElement("table");
            div_totalprice_list.appendChild(table);

            table.border = "1";
            table.style.width = "100%";

            table.className="table table-bordered";


            table.innerHTML = "<thead><tr style='height:50px;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px' align='center' style='margin:10px;'><th style='max-width:50px;'>번호</th><th>날짜</th><th>이름</th><th>설명</th><th>가격</th><th>삭제</th></tr></tr></thead><tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var isdelete = false;
            var isselected = true;
            var foot = table.getElementsByTagName("tfoot")[0];
            var len = rows.length;
            if (len > 0) {
                var beforepaymentid = "";
                var isbeforesame = false;
                var sumprice = 0;
                
                var listcnt = 0;
                for (var i = 0; i <= len; i++) {
                    var data = rows[i];
                     if(i < len && parseInt(data.price) == 0)continue;
                    var brow = body.insertRow();
                    brow.align = "center";
                    brow.style.padding= "10px";
                    brow.style.backgroundColor = "white";
                    brow.style.height = "80px";
                   
                    //0원은 보이지 않는다.
                    
                        listcnt++;
                        if(i < len){
                            
//                            clog("data ",data);
                            var isdelete = false;
                            var isselected = true;
//                            clog("dummy data ",data);
                            var idx_tag = listcnt;
                            var date_tag = data.date;
                            var name_tag = !data.couponid ? "<input id='ntname_"+i+"' onchange='update_dummydata(\"name\","+i+",\""+teacher_uid+"\", \""+year+"\", \""+month+"\",  \""+setJSONStringToParamString(data)+"\")'class='form-control' value='"+data.username+"'/>" : "<button onclick='clickUsername(\"" + data.useruid + "\")' class='btn btn-primary btn-raised' >" + data.username + "</button>";
                            var desc_tag = !data.couponid ? "<input id='ntdesc_"+i+"' onchange='update_dummydata(\"desc\","+i+",\""+teacher_uid+"\", \""+year+"\", \""+month+"\",  \""+setJSONStringToParamString(data)+"\")' class='form-control' value='"+data.desc+"'>" : data.desc;
                            var price_tag = !data.couponid ? "<input id='ntprice_"+i+"' onfocus='this.select()'  onkeyup='inputChangeComma(\"ntprice_"+i+"\")'  onchange='update_dummydata(\"price\","+i+",\""+teacher_uid+"\", \""+year+"\", \""+month+"\",  \""+setJSONStringToParamString(data)+"\")' class='form-control' value='"+CommaString(data.price)+"' style='text-align:right;'/>" : CommaString(data.price);
                            var remove_tag = !data.couponid ? "<img src='./img/btn_close_50.png' onclick='delete_dummy(\""+teacher_uid+"\", \""+year+"\", \""+month+"\",  \""+setJSONStringToParamString(data)+"\")'/>" : "";
                            CellInsert(brow,isdelete,isselected,idx_tag); // 넘버
                            CellInsert(brow,isdelete,isselected,date_tag); // 날짜
                            CellInsert(brow,isdelete,isselected,name_tag);// 이름
                            CellInsert(brow,isdelete,isselected,desc_tag);// 설명
                            CellInsert(brow,isdelete,isselected,price_tag); // 가격
                            sumprice+= parseInt(data.price);    
                            CellInsert(brow,isdelete,isselected,remove_tag); // 삭제
                            
                        }else{
                            brow.style.backgroundColor = "#eeee77";
                            CellInsert(brow,isdelete,isselected,""); // 넘버
                            CellInsert(brow,isdelete,isselected,""); //
                            CellInsert(brow,isdelete,isselected,"");// 
                            CellInsert(brow,isdelete,isselected,"총금액");// 총금액 글자
                            CellInsert(brow,isdelete,isselected,""+TXT_WON+CommaString(sumprice)); // 전체 더한가격     
                            CellInsert(brow,isdelete,isselected,""); // 삭제
                        }
                    
                    
                }
            }
            
            return div_totalprice_list.innerHTML;  

        }
        function clickUsername(uid){
//            header_search(uid);
            showUserInfoPopup(uid);
            hideModalDialog();
        }
//        function reload_payroll(){
//            var groupcode = getData("nowgroupcode");
//            var centercode = getData("nowcentercode");
//
//            var senddata = {
//                groupcode: groupcode,
//                centercode: centercode,
//                type: "refresh_payroll",
//                value: alllist
//            }
//
//            CallHandler("adm_get", senddata, function(res) {
//                if (res.code == 100) {
//                    loadMainDiv(9);
//                }
//
//            }, function(err) {
//                alertMsg(err)
//            });
//        }
        
        function change_target_amount(centercode, year, month, uid, a, i) {
            var target_amount = document.getElementById("target_amount_" + a + "_" + i);
            var amount = parseCommaInt(target_amount.value);

            showModalDialog(document.body, "목표금액 재설정", "목표금액을 " + CommaString(amount) + "로 재설정하시겠습니까?", "재설정하기", "취소", function() {

                updateTranerAmount(centercode, year, month, uid, amount, "updatetargetamount");

            }, function() {
                hideModalDialog();
            });
        }

        function change_total_amount(centercode, year, month, uid, a, i) {
            var total_amount = document.getElementById("total_amount_" + a + "_" + i);
            var amount = parseCommaInt(total_amount.value);

            showModalDialog(document.body, "매출금액 재설정", "Total 금액을 " + CommaString(amount) + "로 재설정하시겠습니까?", "재설정하기", "취소", function() {

                updateTranerAmount(centercode, year, month, uid, amount, "updatetotalamount");

            }, function() {
                hideModalDialog();
            });
        }

        function updateTranerAmount(centercode, year, month, uid, targetamount, type) {
            var groupcode = getData("nowgroupcode");
            //        var centercode = getData("nowcentercode");
            var obj = new Object();
            obj.year = year;
            obj.month = month;
            obj.uid = uid;
            obj.targetamount = targetamount;

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: type,
                value: obj
            }
            CallHandler("getdata", senddata, function(res) {
                if (res.code == 100) {

                    alertMsg("금액을 재설정했습니다.", function() {
                        hideModalDialog();
                    });
                }

            }, function(err) {
                alertMsg(err)
            });
        }

        function getPTPercent(manageruid,setting, totalprice, user_custom_percent,fixpercent) {
            //        clog("totalprice "+totalprice+" user_custom_percent "+user_custom_percent);
            var rpercent = 0;
            var max_data = {
                "percent": 0,
                "price": 0
            };
            if(setting["pricerule"])
            for (var i = 0; i < setting["pricerule"].length; i++) {
                var setdata = setting["pricerule"][i];
                var price = parseInt(setdata.price);
                var percent = parseInt(setdata.percent);

                //나중에 속한 값이 없을때는 최고 퍼센트 배율을 삽입하기 위함
                if (price > max_data.price) {
                    max_data.percent = percent;
                    max_data.price = price;
                }


                if (totalprice <= price) {
                    rpercent = percent;
                    break;
                }


            }
            if (user_custom_percent > 0)
                rpercent = user_custom_percent;

            //속한 값이 없을때는 최고 퍼센트 배율을 삽입하기 위함
            if (rpercent == 0)
                max_data.percent;

            //        clog("percent is ",rpercent);
           
            return fixpercent > 0 ? fixpercent : rpercent;
        }
        
        var sortType = 'asc';
        
        // 테이블 헤더 클릭시 정렬  일단은 필요없어서 주석처리
        function sortContent(tableid, index) {
//            clog("tableid " + tableid + " index " + index);
//            var table = document.getElementById(tableid);
//
//
//            sortType = (sortType == 'asc') ? 'desc' : 'asc';
//
//            clog("table[0].children ", table.tBodies[0].children);
//            var checkSort = true;
//            var rows = table.tBodies[0].children;
//
//            while (checkSort) { // 현재와 다음만 비교하기때문에 위치변경되면 다시 정렬해준다.
//                checkSort = false;
//
//                for (var i = 0; i < (rows.length - 1); i++) {
//                    //            for (var i = 0; i < rows.length; i++) {
//                    
//                    if(rows[i].cells[index] && rows[i + 1].cells[index]){
//                        var innertext = rows[i].cells[index].innerHTML;
//                        var innertext_1 = rows[i + 1].cells[index].innerHTML;
//                        var fCell = innertext.toUpperCase();
//                        var sCell = innertext_1.toUpperCase();
//
//                        var row = rows[i];
//
//                        // 오름차순<->내림차순 ( 이부분이 이해 잘안됬는데 오름차순이면 >, 내림차순이면 <
//                        //                        이고 if문의 내용은 동일하다 )
//                        if ((sortType == 'asc' && fCell > sCell) ||
//                            (sortType == 'desc' && fCell < sCell)) {
//
//                            row.parentNode.insertBefore(row.nextSibling, row);
//                            checkSort = true;
//                        }    
//                    }                    
//                }
//
//            }
        }
        //rows = users 고객들 데이타
        function checkStatusIsDelete(uid,couponid,managerid){
           
            var rflg = "N";
            for(var i = 0 ; i < status_isdelete_arr.length; i++){
                if(status_isdelete_arr[i].uid == uid && status_isdelete_arr[i].couponid == couponid){
                    
                    
                    if(status_isdelete_arr[i].isdelete == "D")
                        rflg = "D";
                    if(status_isdelete_arr[i].issendedcoupon == "-1")
                        rflg = "S";
                    if(status_isdelete_arr[i].status == "M")
                        rflg = status_isdelete_arr[i].status;
                    if(status_isdelete_arr[i].managerid != managerid)
                        rflg = "M";
                    if(status_isdelete_arr[i].repay != 0)
                        rflg = "R";
                    break;
                }
            }
            return rflg;
        }
        function createUsersTable(manageruid, idx, rows, setting, total_getprice,fixpercent) {
//            clog(idx+" : rows");
            clog("rows ",rows);
            //        rows = trim_sort_2array(rows,"name");
                     if(rows)rows.sort(sort_by('id', false, (a) => a.toUpperCase()));//쿠폰아이디로 정렬
            //        clog("rows ",rows);

            //             document.getElementById("table_div").style.display = "block";
            excel_users_data = [];
            var issetheaderpercent = false;
            var div = document.createElement("div");
            var table = document.createElement("table");
            var tableid = "table_payroll_" + manageruid;
            table.id = tableid;
            table.className = 'table table-bordered';
//            table.style.border = "1px solid #e4e8eb";
//            table.style.borderRadius = "10px";
//            table.borderColor="#e4e8eb";
            table.style.width = "100%";
            table.innerHTML = "<thead align='center'>"+
                                "<tr class='fmont' style='background-color:#f0f6fa;height:50px;font-size:14px; color:#212529;font-weight:500;'>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb' onclick='sortContent(\"" + tableid + "\",0)' >순번</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",1)' >등록일</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",2)' >이름</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",3)' >등록횟수</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",4)' >무료횟수<br>[<span style='font-size:12px;color:#ff0000'>최대</span>/<span style='font-size:12px;color:#212529'>남은횟수</span>]</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",5)' >단가</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='showPercentSetting(\"" + manageruid + "\", "+fixpercent+")' >퍼센트</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",7)' >이전남은횟수</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",8)' >진행횟수</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",9)' >남은횟수</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb'  onclick='sortContent(\"" + tableid + "\",10)' >금액</th>"+
                                    "<th style='vertical-align:middle;padding:3px;border:1px solid #e4e8eb' >내용</th>"+
                                "</tr>"+
                            "</thead>"+
                            "<tfoot></tfoot><tbody></tbody>";
            var head = table.getElementsByTagName("thead")[0];
            var body = table.getElementsByTagName("tbody")[0];
            var foot = table.getElementsByTagName("tfoot")[0];
            var len = rows.length;
            body.textAlign = "center";
            body.style.fontSize = "14px";
            body.style.color = "##212529";
            body.style.fontWeight = "500";
            
            body.className = "fmont";
            var total_nowusecount = 0; //이번달 총 강습한 횟수
            //        var total_getprice = 0; //단가기준 전체금액
            var total_get_percent_price = 0; //퍼센트 적용 기준 전체금액
            var header_percent_idx = -1;
            var total_removeptcount = 0;
            var total_userlen = 0;
//            console.log(manageruid+" : "+rows.length);
            //        clog("setting ",setting);
            //        clog("total_getprice "+total_getprice);
            if (len > 0) {

                //헤더부분 퍼센트를 삽입하기 위함
                var isfixpercent = fixpercent > 0 ? true : false;
                var hpercent = getPTPercent(manageruid,setting, total_getprice, null,fixpercent); //check       
                for (var i = 0; i < head.children[0].children.length; i++)
                    if (head.children[0].children[i].innerHTML == "퍼센트")
                        head.children[0].children[i].innerHTML = isfixpercent ? "<text style='color:#999999'>ⓕ"+hpercent + "%</text>" : "<text>"+hpercent + "%</text>" ;

                var cellname = "";
                
                for (var i = 0; i < len; i++) {
                    var user = rows[i];
//                    console.log(user.name+" user iss ",getDDay(user.endtime));
//                    console.log("user ",user);
                    //1년지난 데이터는 보여주지 않는다.
                    if(getDDay(user.endtime) < -365)continue;
//                    if(user.name != "서문희라")continue;//test
                    if(user.isdeleteym){
                        var nym = parseInt(year)*12 + parseInt(month);
                        var oym = parseInt(stringGetYear(user.isdeleteym)) * 12 + parseInt(stringGetMonth(user.isdeleteym));
//                        clog(user.name+" nym "+nym+ "oym "+oym);
                        
                        if(oym < nym)continue;                        
                    }
                    
//                    if(user.name == "최서영"){
//                        clog("\====== "+user.name);
//                        clog("user ",user);
//                        
//                    }
                    
                    var isdelete = user.isdelete && user.isdelete == "D" ? true : false; 
//                    if (idx == 1 && i == 9)
//                        clog(" user is ", user);
                    var brow = body.insertRow();
                    brow.align = "center";
                    
                    var user_custom_percent = user["custompercent"] ? parseInt(user["custompercent"]) : 0;
                    var couponid = user.id;
                    var uid = user.uid;
                    var username = user.name;
                    
//                    clog("user is ",user);
                    var percent = getPTPercent(manageruid,setting, total_getprice, user_custom_percent,fixpercent); //check
                    
                    //              
                    //                clog(i+" percent "+percent);
                    var status = user["status"] ? user["status"] : "N";
                    if(status == "N")status = checkStatusIsDelete(uid,couponid,manageruid);
                    
//                    if(user["name"] == "최서영"){
//                        clog("최여경 user status",user);
//                    }
                    //매니저가 다르다면 담당자 변경됨으로 수정한다.
//                    if(status == "M")continue; //담당자변경 보여줄지 안보여줄지
                   

                    var totalcount = user["totalptcount"] ? parseInt(user["totalptcount"]) : 0;
                    var freecount = user["freecount"] ? parseInt(user["freecount"]) : 0;
//                    var nowusecount = parseInt(user["nowusecount"]);
                    var setprice = parseInt(user["setprice"]);


                    var orner_addnowuseptcount = user["orner_addnowuseptcount"] && parseInt(user["orner_addnowuseptcount"]) >= 0 ? parseInt(user["orner_addnowuseptcount"]) : 0;
                    var nowusecount = parseInt(user["nowusecount"]) + orner_addnowuseptcount;



                    var removeptcount = user["removeptcount"] ? parseInt(user["removeptcount"]) : 0; //removeptcount = 잔여세션소진횟수
                    
                    var reservationcount = user["reservationcount"] ? parseInt(user["reservationcount"]) : 0; //현재 예약승인(0값)인 상태횟수
                    var totalremaincount = totalcount - nowusecount - removeptcount - reservationcount; //최종 남은횟수
                    
                    var beforeremaincount = user["beforeremaincount"] ? parseInt(user["beforeremaincount"]) : 0;
                    var getprice = 0;
                    var color = "white";
                    

                   
                    brow.style.backgroundColor = color;
                    if (status != "N") brow.style.backgroundColor = "#ebebeb";
                    
                    //쿠폰이 이번달 등록한 쿠폰이라면
                    if(isThisMonth(couponid,year,month)){
                        brow.style.backgroundColor = "#fee0e3";
                    }
                    
//                   if(user["name"] == "고유진"){
//                       clog("고유진이다");
//                   }
                    var orner_totalcount =  user["orner_totalcount"] != undefined && user["orner_totalcount"] != null && parseInt(user["orner_totalcount"]) >= 0 ? parseInt(user["orner_totalcount"]) : -1; //등록최대(max)횟수
                    var orner_freecount =  user["orner_freecount"] != undefined && user["orner_freecount"] != null &&  parseInt(user["orner_freecount"]) >= 0 ? parseInt(user["orner_freecount"]) : -1; //무료최대(max)횟수
                    var orner_freecount_text = user["orner_freecount_text"] != undefined && user["orner_freecount_text"] != null && parseInt(user["orner_freecount_text"]) >= 0 ? parseInt(user["orner_freecount_text"]) : -1;
                    var orner_1setprice = user["orner_1setprice"] != undefined && user["orner_1setprice"] != null  && parseInt(user["orner_1setprice"]) >= 0 ? parseInt(user["orner_1setprice"]) : -1;
                    var orner_percentprice = user["orner_percentprice"] != undefined && user["orner_percentprice"] != null && parseInt(user["orner_percentprice"]) >= 0 ? parseInt(user["orner_percentprice"]) : -1;
                    var orner_beforeptcount = user["orner_beforeptcount"] != undefined && user["orner_beforeptcount"] != null && parseInt(user["orner_beforeptcount"]) >= 0 ? parseInt(user["orner_beforeptcount"]) : -1;
                    var orner_nowuseptcount = user["orner_nowuseptcount"] != undefined && user["orner_nowuseptcount"] != null && parseInt(user["orner_nowuseptcount"]) >= 0 ? parseInt(user["orner_nowuseptcount"]) : -1;
                    var orner_remaincount = user["orner_nowuseptcount"] != undefined && user["orner_nowuseptcount"] != null && parseInt(user["orner_remaincount"]) >= 0 ? parseInt(user["orner_remaincount"]) : -1;
//                    if(user["name"] == "고유진"){
//                        clog("고유진 00 orner_freecount "+orner_freecount+" orner_freecount_text "+orner_freecount_text);
//                    }
                    
                   
                    

                    if (isNaN(orner_totalcount)) orner_totalcount = -1;
                    if (isNaN(orner_freecount)) orner_freecount = -1;
                    if (isNaN(orner_1setprice)) orner_1setprice = -1;
                    if (isNaN(orner_percentprice)) orner_percentprice = -1;
                    if (isNaN(orner_beforeptcount)) orner_beforeptcount = -1;
                    if (isNaN(orner_nowuseptcount)) orner_nowuseptcount = -1;
                    if (isNaN(orner_remaincount)) orner_remaincount = -1;
                    
                    //만약 설정된 무료최대횟수가 있다면 freecount를 설정된 무료최대횟수로 변경한다.
                    if(orner_freecount_text >= 0)freecount = orner_freecount_text;
                    

                    var tcount = nowusecount + removeptcount; // 이번달진행횟수 +잔여세션승인횟수
                    if (freecount > 0 && tcount > 0) {
                        clog(totalremaincount+" freecount" +freecount)
                        totalremaincount = totalremaincount + freecount;

                        if (tcount >= freecount) {
                            tcount = tcount - freecount;
                            freecount = 0;
                        } else { //무료횟수가 이번달 이용횟수보다 크다.
                            freecount = freecount - tcount;
                            tcount = 0;
                        }
                        
                        if(user["name"] == "고유진"){
                            clog(tcount+" 고유진 11  totalremaincount "+totalremaincount+" : totalcount "+totalcount+" : freecount "+freecount+" tcount "+tcount+" nowusecount "+nowusecount+" removeptcount "+removeptcount+" beforeremaincount "+beforeremaincount);
                        }
                        
                        
                    }
                    if (tcount < 0) tcount = 0;
                    
                    

                    //오너 최대등록횟수가 있으면 이전 남은횟수를 수정한다.
                    if (orner_totalcount >= 0) beforeremaincount = beforeremaincount + orner_totalcount - totalcount;

                    //                clog(orner_nowuseptcount+" ****************** orner_nowuseptcount "+user["orner_nowuseptcount"]);
                    var new_maxcount = orner_totalcount != -1 ? orner_totalcount : totalcount;
                    var new_beforeremaincount = orner_beforeptcount != -1 ? orner_beforeptcount : beforeremaincount;
                    var new_setprice = orner_1setprice != -1 ? orner_1setprice : setprice;
                    var new_percent_price = orner_percentprice != -1 ? orner_percentprice : parseInt((new_setprice * percent) / 100);
                    var base_percent_price = parseInt((new_setprice * percent) / 100); //퍼센트 적용한 단가
//                    base_percent_price = new_percent_price;
//                    console.log(user.name+ " new_setprice "+new_setprice+" percent "+percent+" percente_price "+percent_price+" base_percent_price "+base_percent_price+" new_percent_price "+new_percent_price+" orner_percentprice "+orner_percentprice);
                    var new_nowuseptcount = orner_nowuseptcount != -1 ? orner_nowuseptcount : tcount;



                    getprice = new_percent_price * new_nowuseptcount;
                    total_get_percent_price += getprice;

                    total_removeptcount += removeptcount; //footer 최종 총횟수
                    if (new_beforeremaincount - new_nowuseptcount < totalremaincount)
                        totalremaincount = new_beforeremaincount - new_nowuseptcount;

                    total_nowusecount += new_nowuseptcount;

                    
                    {
                        //남은횟수맞춤
                        totalremaincount = new_beforeremaincount - (new_nowuseptcount + removeptcount);   orner_remaincount = -1;                        
//                         clog(" totalremaincount = "+ totalremaincount+ " new_beforeremaincount "+new_nowuseptcount+"");
                    }
                    if(totalremaincount < 0 )totalremaincount = 0;
                    

                    //순번
                    var bcell_index = brow.insertCell();
                    bcell_index.style.height = "50px";bcell_index.style.border = "1px solid #e4e8eb";bcell_index.style.verticalAlign = "middle";
                    bcell_index.innerHTML = total_userlen + 1 < 10 ? "0" + (total_userlen + 1) : total_userlen + 1 + "";
                    if(isdelete) bcell_index.innerHTML = "<del>"+ bcell_index.innerHTML+"</del>";
                    
                    //현재 진행하고 있다면 NEXT 아이콘을 삽입하지 않는다.
                    if(tcount <= 0)futureCouponCheck(brow,bcell_index,user["starttime"]);
                    
                    //등록일
                    var bcell_starttime = brow.insertCell();
                    bcell_starttime.innerHTML = user["id"].substr(0,10);
                    bcell_starttime.style.height = "50px";bcell_starttime.style.border = "1px solid #e4e8eb";;bcell_starttime.style.verticalAlign = "middle";
                    if(isdelete)bcell_starttime.innerHTML = "<del><text style='color:red;font-weight:bold'>(삭제됨)<text>"+bcell_starttime.innerHTML+"</del>";

                    //이름
                    var bcell_name = brow.insertCell();
                    bcell_name.style.height = "50px";bcell_name.style.border = "1px solid #e4e8eb";bcell_name.style.verticalAlign = "middle";
                    bcell_name.innerHTML = "<button onclick='showUserInfoPopup(\"" + uid + "\")' style='width:70px; height:30px;border-radius:5px;background-color:#009ef7;border:0px;outline:none;font-size:14px; color:#ffffff;text-align:center;font-weight:700;'>" + username + "</button>";
                    bcell_name.style.padding = "3px";

                    
                    
                    //등록횟수
                    insert_cell(brow, "totalcount", couponid, uid, idx, i, hpercent, totalcount, orner_totalcount, false); 
                    
                    //무료횟수
                    // var freetag = orner_freecount_text >= 0 ? "&nbsp;<text style='color:red;font-weight:bold;'>"+orner_freecount_text+"/</text>" : "";
                     if(user.name == "aaa")clog("freecount "+freecount+" orner_freecount "+orner_freecount+" orner_freecount_text "+orner_freecount_text);
                    insert_cell(brow, "freecount", couponid, uid, idx, i, hpercent, freecount, orner_freecount, false, orner_freecount_text); 
                    
                    //단가
                    insert_cell(brow, "1setprice", couponid, uid, idx, i, hpercent, setprice, orner_1setprice, true); 
                    
                    //퍼센트가격
                    insert_cell(brow, "percentprice", couponid, uid, idx, i, hpercent, base_percent_price, orner_percentprice, true); 
                    
                    //이전남은횟수
                    insert_cell(brow, "beforeptcount", couponid, uid, idx, i, hpercent, beforeremaincount, orner_beforeptcount, false); 
                    
                    //이번달진행횟수+잔여세션승인횟수
                    var addnum = removeptcount > 0 ? removeptcount : "";
                    insert_cell(brow, "nowuseptcount", couponid, uid, idx, i, hpercent, tcount, orner_nowuseptcount, false, addnum); 
                    
                    //전체남은횟수
                    insert_cell(brow, "remaincount", couponid, uid, idx, i, hpercent, totalremaincount, orner_remaincount, false); 


                    //금액(획득금액)
                    var bcell_getprice = brow.insertCell();
                    bcell_getprice.style.height = "50px";bcell_getprice.style.border = "1px solid #e4e8eb";bcell_getprice.style.verticalAlign = "middle";
                    bcell_getprice.innerHTML = ""+TXT_WON + CommaString(getprice);
                    bcell_getprice.style.padding = "3px";

                    //페이롤 삭제하기
                    var bcell_name = brow.insertCell();
                    bcell_name.style.height = "50px";bcell_name.style.border = "1px solid #e4e8eb";bcell_name.style.verticalAlign = "middle";
                    //페이롤 상태값 : 'N' : 일반 ,'D' : 삭제,'R' : 환불, 'M' : 이동(담당자변경)
                    var txt_status = {
                        "N": "일반",
                        "D": "삭제됨",
                        "R": "환불됨",
                        "S": "양도됨",
                        "M": "담당자 변경됨"
                    };
                    var desc = "";
                    if (status == "N"){
//                        clog("담당자 변경안됨 ",user);
                        desc = user.desc ? user.desc+"" : "";
                        bcell_name.innerHTML = desc;
                    }                        
                    else{
//                        clog("담당자 변경됨 ",user);
                        desc = "";
                        var arr=user.isdeletedesc ? user.isdeletedesc.split(',') : [""];
                        var user_name = arr[0];
                        if(user.isdeletedesc)desc = "<button style='height:30px;border-radius:5px;background-color:#f1416c;font-size:14px; color:#ffffff;text-align:center;font-weight:700;border:0px;outline:none'>"+user_name+"</button>";
                        if(user.desc)desc += user.desc+"";
                        bcell_name.innerHTML = txt_status[status]+" "+desc;
                    }
                        
                    bcell_name.style.padding = "3px";
                    
                    var ex_total_count = orner_totalcount >= 0 ? orner_totalcount : totalcount;
                    var ex_free_count = orner_freecount >= 0 ? orner_freecount : freecount;
                    var ex_setprice = orner_1setprice >= 0 ? orner_1setprice : setprice;
                    var ex_percent_price = orner_percentprice >= 0 ? orner_percentprice : base_percent_price;
                    var ex_beforeremaincount = orner_beforeptcount >= 0 ? orner_beforeptcount : beforeremaincount;
                    var ex_tcount = addnum > 0 ? tcount+"("+addnum+")": tcount+"";
                    var ex_totalremaincount = orner_remaincount >= 0 ? orner_remaincount : totalremaincount;
                    
                    total_userlen++;
                    excel_users_data.push({"순번":i + 1+"","등록일":user["id"].substr(0,10),"이름":username,"등록횟수":ex_total_count+"","무료횟수":ex_free_count+"","단가":ex_setprice,"퍼센트가격":ex_percent_price,"이전남은횟수":ex_beforeremaincount,"진행횟수":ex_tcount,"남은횟수":ex_totalremaincount,"금액":CommaString(getprice),"내용":txt_status[status]+" "+desc});
                }
                excel_users_data.push({"순번":"","등록일":"","이름":"","등록횟수":"","무료횟수":"","단가":"","퍼센트가격":"","이전남은횟수":"","진행횟수":total_nowusecount+"","남은횟수":"","금액":CommaString(total_get_percent_price),"내용":""});
                excel_users_data.push({"순번":"","등록일":"","이름":"","등록횟수":"","무료횟수":"","단가":"","퍼센트가격":"","이전남은횟수":"","진행횟수":"","남은횟수":"","금액":"","내용":""}); // 빈줄을 삽입
            }
            div.innerHTML = "<div style='height:50px;'>"+
                                "<span style='float:left'><div align='center' id='tab_pt_"+manageruid+"' onclick='click_users_tab(0, \""+manageruid+"\")' style='cursor:pointer;background-color:#f0f6fa;width:100px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+       
                                     "<label id='tab_pt_label' style='cursor:pointer;font-size: 16px; color:#3F4254;text-align:center;margin-top:8px'>1:1(P.T)</label>"+

                                "</div></span>"+
                                "<span style='float:left'><div align='center' id='tab_gx_"+manageruid+"' onclick='click_users_tab(1, \""+manageruid+"\")'  style='cursor:pointer;width:100px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+  
                                      "<label id='tab_pt_user' style='cursor:pointer;font-size: 16px; color:#3F4254;text-align:center;margin-top:8px'>그룹수업</label>"+
                                "</div></span>"+
                            "</div>";
            var gx_tab_display = ptgx_tab_index == 0 ? "none" : "block";
            div.innerHTML += "<div align='center' id='div_gxpayroll_"+manageruid+"' style='width:100%;height:auto;display:none'>"+
                                "<table align='center' id='table_gxpayroll_"+manageruid+"' class='table table-bordered' style='width:100%;height:auto;text-align:center'>"+
                                    
                                    //내용은 금액을 계산한 후에 다른곳에서 입력한다. 
                                 "</table>"+
                                 "<div align='left' style='height:50px;margin-left:20px;'>"+
                                     "<text id='gx_bottom_total_"+manageruid+"' style='font-size:14px; color:#495057;text-align:left;font-weight:400;'>총 횟수 : 0회 , 총금액 : "+TXT_WON +"0</text>"+
                                 "</div>"
                            "</div>";
            
            
            var viewhistory_btn_tag = isPermission(213) ? "<button onclick='show_ornersetpayroll_history(\"" + manageruid + "\")' class='btn ' style='float:right;margin-top:-5px;margin-right:20px;cursor:pointer;width:160px; height:30px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='admin_settingid_213'>페이롤 수정기록보기</button>" : "";
            
            
            var pt_div = document.createElement("div");
            pt_div.id= "div_ptpayroll_"+manageruid;
            pt_div.appendChild(table);
            pt_div.style.display = ptgx_tab_index == 0 ? "block":"none";
            pt_div.innerHTML += "<div style='height:50px'>"+
                "<span style='float:left;margin-left:20px;'>"+
                    "<text style='margin-right:20px;color:red;display:none;font-size:14px;text-align:left;font-weight:400;'>잔여세션 소진승인(" + total_removeptcount + ")</text>"+
                    "<text style='font-size:14px; color:#495057;text-align:left;font-weight:400;'>총 횟수 : " + total_nowusecount + "회 , 총금액 : "+TXT_WON + CommaString(total_get_percent_price) + "</text>"+
                "</span>"+
                viewhistory_btn_tag+"<br>"+
            "</div>";

            
            div.appendChild(pt_div);
            
            var resturndata = {
                "tag": div.innerHTML,
                "totalnowusecount": total_nowusecount,
                "totalgetprice": total_get_percent_price,
                "totaluserlen" : total_userlen,
                "totalremoveptcount": total_removeptcount
            };
            return resturndata;

        }
        function click_users_tab(tab_idx, manageruid){
//            console.log("idx "+idx+" manageruid "+manageruid);
            
            var pt_table = document.getElementById("div_ptpayroll_"+manageruid);
            var gx_table = document.getElementById("div_gxpayroll_"+manageruid);
            var tab_pt = document.getElementById("tab_pt_"+manageruid);
            var tab_gx = document.getElementById("tab_gx_"+manageruid);
            ptgx_tab_index = tab_idx;
            if(tab_idx == 0){
                pt_table.style.display = "block";
                gx_table.style.display = "none";
                tab_pt.style.backgroundColor = "#f0f6fa";
                tab_gx.style.backgroundColor = "#ffffff";
                
            }else {
                pt_table.style.display = "none";
                gx_table.style.display = "block";
                tab_pt.style.backgroundColor = "#ffffff";
                tab_gx.style.backgroundColor = "#f0f6fa";
                
                if(gxdatas.length == 0 ){
                    alertMsg("그룹수업내역이 없습니다.");
                    click_users_tab(0,manageruid);
                    return;
                }    
            }
            updateReservationContainer(tab_idx,manageruid);
            
        }
        function updateReservationContainer(tab_idx,manageruid){
            var reservation_container = document.getElementById("reservation_container");
            var table_payroll = document.getElementById("table_payroll_"+manageruid);
            var table_gxpayroll = document.getElementById("table_gxpayroll_"+manageruid);
           
            //box-shadow: 1px 1px 3px 1px #dadce0 inset
            reservation_container.style.height = "auto";
            var allheight = parseInt(reservation_container.clientHeight);
            
       
            allheight = parseInt(reservation_container.clientHeight);

            reservation_container.style.height = allheight+"px";

        }
        function showPercentSetting(manageruid,fixptpercent){
            var maxptcount = getBaseMaxPTCount(manageruid);
//            var fixptpercent = getFixPTPercent(manageruid);
            
            show_userFixPTPercent(manageruid,maxptcount,fixptpercent,9,year,month);
            
        }
        function futureCouponCheck(brow,cell,starttime){
            var now = new Date();
            var nowyear = now.getFullYear();
            var nowmonth = now.getMonth()+1;
//            clog("nowyear "+nowyear+" nowmonth "+nowmonth);
//            if(stringGetYear(starttime) > nowyear || stringGetYear(starttime) == nowyear && stringGetMonth(starttime) > nowmonth){
//                brow.style.backgroundColor = "#aaaaaa";
//                cell.innerHTML = "<img src='./img/icon_next.png' title='시작일이 이번달 이후일때 NEXT 아이콘이 표시됩니다.'/>"+cell.innerHTML;
//            }
        }
        function btnremovepayrolldata(manageruid, useruid, username, couponid, year, month) {
            var title = "페이롤 삭제";
            var message = "선택한 [" + username + "] " + couponid + " 데이타를 삭제하시겠습니까?<br><text style='color:red'>※주의 : 삭제후 복구할 수 없습니다.</text>";

            showModalDialog(document.body, title, message, "삭제하기", "취소", function() {

                var value = {
                    managerid: manageruid,
                    useruid: useruid,
                    couponid: couponid,
                    year: year,
                    month: month
                }
                removePayrollData(value);

            }, function() {
                hideModalDialog();
            });
        }

        function removePayrollData(value) {
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "removepayrolldata",
                value: value
            }

            CallHandler("adm_get", senddata, function(res) {
                if (res.code == 100) {
                    C_showToast( "성공", "성공적으로 삭제했습니다.", function() {});
                    getMyTranerHistory(year, month); // 목록 다시 호출한다.
                    hideModalDialog();
                }

            }, function(err) {
                alertMsg(err)
            });
        }

        function insert_cell(brow, cellname, couponid, uid, idx, i, hpercent, _default_value, _orner_value, isicon, _addnum) {

            var freeaddtag = cellname == "freecount" && _addnum && parseInt(_addnum) != -1 ? "&nbsp;<text style='color:red;font-weight:bold;'>" + _addnum + "/</text>" : "";
            var addtag = _addnum && cellname != "freecount" ? _addnum : "";

            if(cellname == "nowuseptcount" && _addnum)
                addtag = "&nbsp;<text style='color:red;font-weight:bold;'>(" + _addnum + ")</text>";
            
            //        clog(couponid+" _orner_value ",_orner_value);
            if (isNaN(_orner_value)) {
                _orner_value = "-1";
            }
            var default_value = isicon ? CommaString(_default_value) : _default_value;
            var orner_value = isicon ? CommaString(_orner_value) : _orner_value;
            var icon = isicon ? "" : "";
            //등록횟수 총횟수
            var bcell = brow.insertCell();
            bcell.style.width = "9.5%";
            bcell.style.height = "50px";
            bcell.style.border = "1px solid #e4e8eb";
            bcell.style.verticalAlign = "middle";
            //        cellname = "totalcount";
            var tvalue = default_value; //기본값
            var nvalue = "";
            var ivalue = _default_value; //기본값
            if (_orner_value + "" != "-1") {
                tvalue = "<del>" + default_value + "</del>"; //default value
                nvalue = orner_value; //오너설정값    new value
                ivalue = _orner_value; //오너 설정값  input value 
            }

            var onclick = auth >= AUTH_OPERATOR ? "onclick='cell_click(" + idx + "," + i + ",\"" + cellname + "\",\"" + _addnum + "\")'" : ""; //오직 freecount 일때만 _addnum 가 숫자로 들어가있다.
            
            bcell.innerHTML = freeaddtag + "<text id='text_" + cellname + "_" + idx + "_" + i + "' " + onclick + " style='align:center;'>" + icon + tvalue + "</text>&nbsp;<text id='ctext_" + cellname + "_" + idx + "_" + i + "' onclick='cell_click(" + idx + "," + i + ",\"" + cellname + "\",\"" + _addnum + "\")' style='align:center;color:blue;font-weight: bold;'>" + icon + nvalue + "</text><input onchange='cell_changed(" + idx + "," + i + ",\"" + cellname + "\",\"" + couponid + "\",\"" + uid + "\",\"" + hpercent + "\")'  onfocusout='out_focus(" + idx + "," + i + ",\"" + cellname + "\")' onfocus='this.select()'  id='input_" + cellname + "_" + idx + "_" + i + "' type='number' value='" + ivalue + "' style='display:none'>" + addtag;

        }

        function out_focus(idx, i, type) {
            //        clog("out_focus!!");
            var tag_txt = document.getElementById("text_" + type + "_" + idx + "_" + i);
            var tag_ctxt = document.getElementById("ctext_" + type + "_" + idx + "_" + i);
            var tag_input = document.getElementById("input_" + type + "_" + idx + "_" + i);
            tag_txt.style.display = "block";
            tag_input.style.display = "none";
        }

        function cell_click(idx, i, type, value) {
            //        clog("idx "+idx+" i "+i+" type "+type);

            if (type == "remaincount") {
                alertMsg("남은횟수는 변경할 수 없습니다. 남은횟수를 변경하려면 이전남은횟수를 조정하세요.");
                return;
            }

            var tag_txt = document.getElementById("text_" + type + "_" + idx + "_" + i);
            var tag_ctxt = document.getElementById("ctext_" + type + "_" + idx + "_" + i);
            var tag_input = document.getElementById("input_" + type + "_" + idx + "_" + i);

            if (type == "freecount") {
                tag_input.value = value;
            }
            tag_txt.style.display = tag_ctxt.innerHTML == "" ? "none" : "block";
            tag_input.style.display = "block";
            tag_input.focus();



            //        switch(type){
            //            case "totalcount":
            //                clog("aaa");
            //                document.getElementById("text_"+type+"_"+idx+"_"+i).style.display = "none";
            //                document.getElementById("input_"+type+"_"+idx+"_"+i).style.display = "block";
            //                break;
            //            case "1setprice":
            //                clog("aaa");
            //                document.getElementById("text_"+type+"_"+idx+"_"+i).style.display = "none";
            //                document.getElementById("input_"+type+"_"+idx+"_"+i).style.display = "block";
            //                break;
            //        }
        }

        function cell_changed(idx, i, type, couponid, uid, hpercent) {
            //        clog("cell_changed idx "+idx+" i "+i+" type "+type);
            var tag_txt = document.getElementById("text_" + type + "_" + idx + "_" + i); //기존데이타 
            var tag_ctxt = document.getElementById("ctext_" + type + "_" + idx + "_" + i); //수정한 데이터
            var tag_input = document.getElementById("input_" + type + "_" + idx + "_" + i); //수정한 값 인풋필드
            if (parseInt(tag_input.value) < 0) {
                alertMsg("- 값은 수정할 수 없습니다.");
                return;
            }
            switch (type) {
                case "totalcount": //등록횟수


                    tag_ctxt.innerHTML = tag_input.value;

                    break;
                case "1setprice": //1세트 단가
                    tag_ctxt.innerHTML = ""+TXT_WON + CommaString(tag_input.value);
                    break;
                case "percentprice": //퍼센트가격
                    tag_ctxt.innerHTML = ""+TXT_WON + CommaString(tag_input.value);
                    break;
                case "beforeptcount": //이전남은횟수
                    var totalptcount_value = document.getElementById("text_totalcount_" + idx + "_" + i).innerHTML; //기존데이타 
                    clog("beforeptcount_value" + totalptcount_value + " tag_input.value " + tag_input.value);
                    if (parseInt(tag_input.value) > parseInt(totalptcount_value)) {
                        alertMsg("이전남은횟수는 등록횟수보다 작거나 같아야 합니다.");
                        return;
                    }


                    tag_ctxt.innerHTML = tag_input.value;
                    break;
                case "nowuseptcount": //진행횟수
                    tag_ctxt.innerHTML = tag_input.value;
                    break;
                case "remaincount": //남은횟수
                    tag_ctxt.innerHTML = tag_input.value;
                    break;
            }

            var deltxt = "<del>" + tag_txt.innerHTML + "</del>";
            if (tag_ctxt.innerHTML != "") {

                deltxt = deltxt.replace("<del><del>", "<del>");
                deltxt = deltxt.replace("</del></del>", "</del>");
                tag_txt.innerHTML = deltxt;

            }


            //최초금액과 같은지 비교한다.

//            var del_ctext = "<del>" + tag_ctxt.innerHTML + "</del>";
//            if (tag_ctxt.innerHTML != "" && del_ctext == deltxt) {
//                tag_txt.innerHTML = tag_ctxt.innerHTML;
//                tag_ctxt.innerHTML = "";
//                tag_input.value = "";
//            }

            tag_txt.style.display = "block";
            tag_input.style.display = "none";
            var orner_key = "orner_" + type;
            var orner_value = parseInt(tag_input.value);
            change_payrolluserdata(idx, i, couponid, uid, type, orner_key, orner_value, hpercent);
        }

        function change_payrolluserdata(idx, i, couponid, uid, type, orner_key, orner_value, hpercent) {
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");
//            console.log("change_payrolluserdata");
            var history = null;
            var payrolldata = null;
            for (var i = 0; i < payroll_history.length; i++) {
                if (payroll_history[i].centercode == centercode) {
                    history = payroll_history[i];
                    break;
                }
            }
            if (!history) return;
            payrolldata = history.data[idx]

            //        clog("idx",idx);
            //        clog("payroll_history",payroll_history);
            //        clog("payrolldata",payrolldata);
            var payroll_idx = payrolldata.pr_idx;
            var users = JSON.parse(payrolldata.pr_users);
            var user = null;
            for (var i = 0; i < users.length; i++) {
                //            clog("users[i].couponid "+users[i].couponid+" couponid "+couponid);
                if (users[i].id == couponid && users[i].uid == uid) {
                    user = users[i];
                    break;
                }
            }
            if (!user) return;

            var user_payrollid = user.id; //같은유저 아이디가 더 있을 수 있으므로 해당 아이디 유저로 찾는다.
            var useruid = user.uid;

            var obj = new Object();
            obj.payrollidx = payroll_idx;
            obj.userpayrollid = user_payrollid;
            obj.useruid = useruid;
            obj.ornerkey = orner_key;
            obj.ornervalue = parseInt(orner_value);
            obj.hpercent = hpercent;
            obj.teacheruid = payrolldata.pr_uid;
            obj.pryear = payrolldata.pr_year;
            obj.prmonth = payrolldata.pr_month;


            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "insertpayrollornerdata",
                value: obj
            }
            C_ShowLoadingProgress();
            CallHandler("adm_get", senddata, function(res) {
                if (res.code == 100) {
                    C_showToast( "성공", res.message, function() {});
                    getMyTranerHistory(year, month); // 목록 다시 호출한다.
                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg(err)
            });
        }

        function arrowClick(leftright) {

            //left
            if (leftright == 0) {
                if (month == 1) {
                    month = 12;
                    year = year - 1;
                } else {
                    month--;
                }
            }
            //right
            else {
                if (month == 12) {
                    month = 1;
                    year = year + 1;
                } else {
                    month++;
                }
            }

            getMyTranerHistory(year, month);

        }

        function listClick(index) {

            //        if(before_index != index && before_index != -1){
            //            if($(".sub"+before_index).is(":visible")){
            //                $(".sub"+before_index).slideUp(100);
            //            }           
            //        }
//            clog("isClickMoreTotal "+isClickMoreTotal);
            if(!isClickMoreTotal){
                
                if ($(".sub" + index).is(":visible")) {
                    $(".sub" + index).slideUp(100);
                    before_index = -1;
                    list_open(index, false);
                } else {
                    //            clog("down ");
                    $(".sub" + index).slideDown(150);
                    before_index = index;
                    list_open(index, true);

                }
                
            }
            isClickMoreTotal = false;
            
            
        }

        function list_open(index, isopen) {
//            clog("list_open !!");
            if (isopen) {
                var data = {
                    "year": year,
                    "month": month,
                    "index": index
                };

                var isin = false;
                for (var i = 0; i < openlist.length; i++) {
                    if (openlist[i].year == year && openlist[i].month == month && openlist[i].index == index) {
                        isin = true;
                        break;
                    }
                }
                if (!isin)
                    openlist.push(data);
            } else {

                var popindex = -1;
                for (var i = 0; i < openlist.length; i++) {
                    if (openlist[i].year == year && openlist[i].month == month && openlist[i].index == index) {
                        popindex = i;
                        break;
                    }
                }
                if (popindex >= 0)
                    openlist.splice(popindex, 1);
            }

            //        clog("openlist is ",openlist);
        }

        function checkOpenList(year, month) {
            for (var i = 0; i < openlist.length; i++) {
                if (openlist[i].year == year && openlist[i].month == month) {
                    $(".sub" + openlist[i].index).slideDown(150);
                }
            }
        }

        function allListOpen(len) {
            for (var i = 0; i < len; i++)
                $(".sub" + i).slideDown(150);
        }

        function allListClose(len) {
            for (var i = 0; i < len; i++)
                $(".sub" + i).slideUp(100);
        }

        function show_ornersetpayroll_history(manageruid) {
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");

            var value = {
                managerid: manageruid,
                year: year,
                month: month
            }

            var senddata = {
                groupcode: groupcode,
                centercode: centercode,
                type: "getornersetpayrollhistory",
                value: value
            }
            CallHandler("adm_get", senddata, function(res) {
                if (res.code == 100) {
                    var title = "Payroll 전체 로그기록";

                    var mtag = getUserAllLogTable(res.message);
                    clog("res.message ", res.message);

                    var style = {
                        bodycolor: "#eeeeee",
                        size: {
                            width: "90%",
                            height: "100%"
                        }
                    };
                    showModalDialog(document.body, title, mtag, "닫기", null, function() {
                        hideModalDialog();
                    }, null, style);
                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg(err)
            });
        }

        function allOpen() {
            var btn_allopen = document.getElementById("btn_allopen");
            var btn_allclose = document.getElementById("btn_allclose");
            btn_allopen.style.display = "none";
            btn_allclose.style.display = "block";
            allListOpen(alllist.length);
        }

        function allClose() {
            var btn_allopen = document.getElementById("btn_allopen");
            var btn_allclose = document.getElementById("btn_allclose");
            btn_allopen.style.display = "block";
            btn_allclose.style.display = "none";
            allListClose(alllist.length);
        }
        function saveSelectedTeacher(teacheruid,y,m){
//            console.log("save clickuid_"+y+"_"+m+"  "+teacheruid);
            saveData("clickuid_"+centercode+"_"+y+"_"+m, teacheruid);
        }
        function loadSelectedTeacher(y,m){
//            console.log("load clickuid_"+y+"_"+m+"  "+getData("clickuid_"+y+"_"+m));
            
            return getData("clickuid_"+centercode+"_"+y+"_"+m);
        }
        
    </script>
