<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div class="reservation_center" style='padding:5px'>
            <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >[홀딩/시작일] 변경요청</text>
			
			<span style="float:right;margin-top:5px">
			<text id='toggle_title_request' style='color:gray;float:left;font-size:14px;font-weight:500;margin-top:10px;'>정보수정&nbsp;&nbsp;</text>
					<label class='switch' style='float:left;margin-top:4px'>
						<input id='toggle_request' type='checkbox' onchange='request_togglechange()'>
						<span  id='toggle_icon_request'  class='slider round'>
							<text class='fmont' id='toggle_txt_request'style='color:white;float:left;font-size:14px;font-weight:400;margin-top:8px;margin-left:26px'></text>
						</span>
					</label>
			</span>
			<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
	
	
			
			<div align="center" style="height:52px;margin-bottom:10px">
                <img id='arrow_l' src='./img/button_prev.png' style='float:left;margin-left:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(0)" />
                <img id='arrow_r' src='./img/button_next.png' style='float:right;margin-right:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(1)" />
               <label style="margin-top:10px;font-size:18px;color:#3f4254;font-weight:700;" id="txt_title">Send Message Data</label>
				
            </div>

				<div id = "container">
					
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;color:#3f4254; text-align:center; font-weight:500;"></table>
				</div>

				<div id = "id_nodata">
					<br>
					<div align = "center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
				</div>
	</div>
</div>
<script>
    setImageButton("arrow_l","button_prev.png","button_prev_press.png","button_prev_hover.png");
    setImageButton("arrow_r","button_next.png","button_next_press.png","button_next_hover.png");
    
     var payroll_history = [];
     var before_index = -1;
     var payroll_setting = null;
     var now = new Date();
     var year = now.getFullYear();
     var month = now.getMonth() + 1;
     var day = now.getDate();
     var centercode = getData("nowcentercode");
    var requestlist = null;
     var ischange
     $( document ).ready(function() {
        
         getRequestList(year,month);
     });
    function init_d_request(key){
        clog("key is "+key);
    }
    function getRequestList(year,month){
        var obj = new Object();
            obj.centercode = getData("nowcentercode");
        
            obj.year = year;
            obj.month = month;
//            obj.day = day;  // 1달기준으로 가져올거기때문에 사용하지 않음
            document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
            
            

            var senddata = {
                groupcode : getData("nowgroupcode"),
                centercode : getData("nowcentercode"),
                type :"getrequestlist",
                value : obj
            }
            CallHandler("adm_get", senddata, function (res) {
                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {

                    requestlist = res.message;
                    insertRequestListTable(res.message);
                    

                } else {
//                    alertMsg("목록이 없습니다.");
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
    }
    function insertOTCell(brow,isfreeuser,tag,maxWidth,minWidth){
        var cell = brow.insertCell();
       
        if(maxWidth)cell.style.maxWidth = maxWidth;
        if(minWidth)cell.style.minWidth = minWidth;
        cell.innerHTML = tag;
    }
    
    function request_togglechange(couponlen,newlockerlen){

        var toggle = document.getElementById("toggle_request");
        var toggle_icon = document.getElementById("toggle_icon_request");
        if(toggle.checked){
            toggle_icon.style.backgroundColor = "#33aaaa";
        }else{
            toggle_icon.style.backgroundColor = "#cccccc";
        }

//        if(couponlen && newlockerlen)
//            initAdminUserInfoSetting(key,couponlen,newlockerlen,toggle.checked);
//
        showInputTags(toggle.checked);

    }
    function insertRequestListTable(rows) {
        
        if(rows.length > 0)
            document.getElementById("id_nodata").style.display = "none";
        else 
            document.getElementById("id_nodata").style.display = "block";
//        clog("미설정고객들 ",rows);
//            document.getElementById("table_div").style.display = "block";
        var table = document.getElementById('dataTable');
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>요청일</th><th>이름</th><th>요청타입</th><th>회원권</th><th>요청기간</th><th>특이사항</th><th>상태</th><th>승인/거부</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;

        
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            for (var i = 0; i < len; i++) {
//                var using_coupons = getCoupons(rows[i],"using");
//                
//                var ptcoupon = null;
//                
//                //먼저 트레이너 미설정 고객이 있는지 체크한다.
//                for(var a = 0 ; a < using_coupons.length; a++){
//                    if(using_coupons[a].mbstype == "PT" && isNoSettingUser(using_coupons[a].userstatus)){                        
//                       ptcoupon = using_coupons[a];
//                       break;    
//                    }
//                }
//                //미설정 고객이라면 삽입한다.
//                if(ptcoupon != null){
                
                    clog("request rows[i] is ",rows[i]);
                
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
                    var request_desc = rows[i]["rq_desc"];
                    var request_delayday = rows[i]["rq_delayday"];
                    
                    var isfreeuser = true;
                    
					var label_fmont_f = "<label class='fmont' style='font-size: 14px; color:#495057; font-weight:500; text-align:center;'>";
					var label_f = "<label style='font-size: 14px; color:#495057; font-weight:500; text-align:center;'>";
					var label_e = "</label>";
                    ///////////////////////////////////////////////
                    // 인덱스
                    ///////////////////////////////////////////////
					var idx_tag = label_fmont_f+(i+1)+label_e;
                    insertOTCell(brow,isfreeuser,idx_tag); 
                    
                     ///////////////////////////////////////////////
                    // 요청일
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_fmont_f+rdate+label_e); 
                    
                    
                    
                    ///////////////////////////////////////////////
                    // 이름/ 고객번호
                    ///////////////////////////////////////////////                   
                    //var name_tag = "<button class='btn btn-primary btn-raised' onclick='show_usertag("+i+")' style='background-color:#116666;font-size:14px'>"+username+"["+userid+"]</button>";
				var name_tag = "<button class='btn btn-primary btn-raised' onclick='show_usertag("+i+")' style='border:0px;background-color:#116666;font-size:14px'>"+username+"</button>";
                    insertOTCell(brow,isfreeuser,name_tag); 
                    
                    ///////////////////////////////////////////////
                    //요청타입
                    ///////////////////////////////////////////////
                    var requesttype_text = {"H":"홀딩","S":"시작시간변경","N":"없음"};
                    insertOTCell(brow,isfreeuser,label_f+requesttype_text[requesttype]+label_e);
                    
                    ///////////////////////////////////////////////
                    //회원권
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_f+mbstype+label_e);
                    
                    ///////////////////////////////////////////////
                    //요청기간
                    ///////////////////////////////////////////////
                    var starttime_tag = request_starttime ? getToday(new Date(request_starttime)) : "";
                    var endtime_tag = request_endtime ? getToday(new Date(request_endtime)) : ""
                    var startend_tag = endtime_tag ? "<text class='info_default fmont' style='font-size:12px'>"+starttime_tag+" ~ "+endtime_tag+"&nbsp;&nbsp;<span style='color:blue'>["+request_delayday+"일]</span></text>" : "<text class='info_default' style='font-size:12px'>"+starttime_tag+"</text>";
                
                
                    var str_rqdata = setJSONStringToParamString(rows[i]);
                
                    var edit_tag = endtime_tag ? "<div  class='info_edit' style='display:none'>"+
                         "<input type='date'  id='request_start_"+i+"' value='"+starttime_tag+"' class='fmont' onfocus='this.select()' style='outline:none;border:0px;margin-left:20px;width:140px;width:150px; height:35px;border-radius:10px;background-color:#eef3f7;font-size: 14px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;'>"+
                         "&nbsp;&nbsp;~&nbsp;&nbsp;"+
                         "<input type='date'  id='request_end_"+i+"' value='"+endtime_tag+"'  class='fmont' onfocus='this.select()' style='outline:none;border:0px;width:140px;width:150px; height:35px;border-radius:10px;background-color:#eef3f7;font-size: 14px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;'>"+
                         "<img onclick='update_requestdata(\"requestholding\",\""+i+"\",\""+str_rqdata+"\")' src='./img/button_complete_edit.png' style='cursor:pointer;margin-left:10px;margin-top:3px;' title='홀딩요청기간 수정'>"+
                    "</div>" : "<div  class='info_edit' style='display:none'>"+
                         "<input type='date'  id='request_start_"+i+"' value='"+starttime_tag+"' class='fmont' onfocus='this.select()' style='outline:none;border:0px;margin-left:20px;width:140px;width:150px; height:35px;border-radius:10px;background-color:#eef3f7;font-size: 14px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;'>"+
                        "<img onclick='update_requestdata(\"requeststart\",\""+i+"\",\""+str_rqdata+"\")' src='./img/button_complete_edit.png' style='cursor:pointer;margin-left:10px;margin-top:3px;' title='시작요청시간 수정'>"+
                    "</div>";
                    insertOTCell(brow,isfreeuser,startend_tag+edit_tag);
                   
                
                   
                    ///////////////////////////////////////////////
                    //특이사항
                    ///////////////////////////////////////////////
                    var desc_tag = request_desc ? "<text class='info_default' style='font-size: 14px; color:#495057; font-weight:500; text-align:center;'>"+request_desc+"</text><div class='info_edit' style='display:none'><input id='request_desc_"+i+"' value='"+request_desc+"' onfocus='this.select()' style='outline:none;border:0px;margin-left:20px;width:140px;width:150px; height:35px;border-radius:10px;background-color:#eef3f7;font-size: 14px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;'><img  onclick='update_requestdata(\"requestdesc\",\""+i+"\",\""+str_rqdata+"\")' src='./img/button_complete_edit.png' style='cursor:pointer;margin-left:10px;margin-top:3px;' title='시작요청시간 수정'></div>" :
                    
                    "<div class='info_edit' style='display:none'><input id='request_desc_"+i+"' value='"+request_desc+"' onfocus='this.select()' style='outline:none;border:0px;margin-left:20px;width:140px;width:150px; height:35px;border-radius:10px;background-color:#eef3f7;font-size: 14px; color:#5e6278;text-align:left; font-weight:700;padding-left:20px;padding-right:20px;'><img onclick='update_requestdata(\"requestdesc\",\""+i+"\",\""+str_rqdata+"\")' src='./img/button_complete_edit.png' style='cursor:pointer;margin-left:10px;margin-top:3px;' title='시작요청시간 수정'></div>";
                    insertOTCell(brow,isfreeuser,desc_tag);
                    
                    ///////////////////////////////////////////////
                    //상태변경
                    ///////////////////////////////////////////////
                    var status_text = {"R":"요청","Y":"승인됨","N":"승인거부됨","D":"요청해제됨"};
//                    var status_option_tag = "";
//                    status_option_tag += status == "R" ? "<option value='R' selected>요청</option>" : "<option value='R'>요청</option>" ;
//                    status_option_tag += status == "Y" ? "<option value='Y' selected>승인됨</option>" : "<option value='Y'>승인됨</option>" ;
//                    status_option_tag += status == "N" ? "<option value='N' selected>승인거부됨</option>" : "<option value='N'>승인거부됨</option>" ;
//                    status_option_tag += status == "D" ? "<option value='D' selected>요청해제됨</option>" : "<option value='D'>요청해제됨</option>" ;
//                    
//                    var status_tag = "<text class='info_default' >"+status_text[status]+"</text>"+
//                                    "<select class = 'info_edit' style='display:none'>"+status_option_tag+"</select>";
                                        
                    
                
                
                    //insertOTCell(brow,isfreeuser,status_text[status]);
                    insertOTCell(brow,isfreeuser,label_f+status_text[status]+label_e);
                
//                    var option = "<option value=''>== 상태값 ==</option>";
//                    option += status == "R" ? "<option value='R' selected>요청</option>" : "<option value='R'>요청</option>"; 
//                    option += status == "Y" ? "<option value='Y' selected>승인</option>" : "<option value='Y'>승인</option>"; 
//                    option += status == "N" ? "<option value='N' selected>승인거부</option>" : "<option value='N'>승인거부</option>"; 
//                    var select_tag = "<select class='form-control' id='requesttype_"+i+"' name='requesttype_"+i+"' >"+option+"</select>";
//                    insertOTCell(brow,isfreeuser,select_tag);

                    ///////////////////////////////////////////////
                    //상태변경하기 버튼
                    ///////////////////////////////////////////////
                    var btn_oktag = "";
                    var btn_canceltag = "";
                    if(status == "R"){
                        btn_oktag = "<button onclick='changeRequestStatus("+rqidx+", \""+useruid+"\", \""+couponid+"\", \""+mbstype+"\", \""+requesttype+"\" , \"Y\" , \""+status+"\" , \""+request_starttime+"\" , \""+request_endtime+"\" , \""+request_desc+"\" )' class='btn btn-primary btn-raised' style='font-size:14px;border:0px;'>승인하기</button>";
                        btn_canceltag = "<button onclick='changeRequestStatus("+rqidx+", \""+useruid+"\", \""+couponid+"\", \""+mbstype+"\", \""+requesttype+"\" , \"N\" ,\""+status+"\" , \""+request_starttime+"\" , \""+request_endtime+"\" , \""+request_desc+"\" )' class='btn btn-primary btn-raised' style='background-color:red;font-size:14px;border:0px;'>거부하기</button>";    
                         
                    }else if(status == "Y"){
                        if(requesttype == "H"){
                          
                            btn_oktag = getDDay(request_endtime) > 0 ? "<button onclick='changeRequestStatus("+rqidx+", \""+useruid+"\", \""+couponid+"\", \""+mbstype+"\", \""+requesttype+"\" , \"D\" , \""+status+"\" , \""+request_starttime+"\" , \""+request_endtime+"\" , \""+request_desc+"\")' class='btn btn-primary btn-raised' style='font-size:14px;border:0px;'>홀딩풀기</button>" : "";    
                        }
                        
                        
                    }
                    
                    insertOTCell(brow,isfreeuser,btn_oktag+"&nbsp;"+btn_canceltag);
              
            }
        }
        $('#dataTable').DataTable();
    }
    function update_requestdata(key,idx,str_rqdata){
        //key  : requestholding , requeststart , requestdesc
        var request_start = document.getElementById("request_start_"+idx).value;
        var request_end = document.getElementById("request_end_"+idx).value;
        var request_desc = document.getElementById("request_desc_"+idx).value;
        
        
        var rqdata = JSON.parse(str_rqdata);
        
        var senddata = {
            groupcode : getData("nowgroupcode"),
            centercode : getData("nowcentercode"),
            type :"updaterequestdata",
            value : {"type":key,"rqdata":rqdata,"newstart":request_start,"newend":request_end,"newdesc":request_desc}
        }
        CallHandler("adm_get", senddata, function (res) {
            clog("res is ",res);
            var code = parseInt(res.code);
            if (code == 100) {
                if(key == "requestholding")
                    C_showToast( "홀딩요청기간 변경완료!", "홀딩요청기간을 "+request_start+" ~ "+request_end+" 로 변경하였습니다.", function() {});
                else if(key == "requeststart")
                    C_showToast( "시작요청시간 변경완료!", "시작요청시간을 "+request_start+" 로 변경하였습니다.", function() {});
                else if(key == "requestdesc")
                    C_showToast( "특이사항 변경완료!", "특이사항을 변경하였습니다.", function() {});
                loadMainDiv(12);
            } else {
//                    alertMsg("목록이 없습니다.");
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");
        });
        
        
    }
//    function changeRequestStatus(rqidx,useruid,couponid,mbstype,requesttype,changed_status,status,request_starttime,request_endtime,request_desc){
////        var changed_status = document.getElementById("requesttype_"+i).value;
//        var requesttype_text = {"H":"홀딩","S":"시작시간변경","N":"없음"};
//        if(!changed_status || changed_status == status){
//            alertMsg("상태값을 변경해 주세요.");
//            return;
//        }
//        if(requesttype == "N"){ //
//            alertMsg("요청한 값이 없습니다.");
//            return;
//        }
//        var status_text = {"R":"요청","Y":"승인","N":"승인거부","D":"요청해제"};
//        var txt_message = "";
//        if(requesttype == "H")txt_message = "홀딩신청을 "+status_text[changed_status]+"하시겠습니까?<br>홀딩 요청기간 : "+request_starttime+" ~ "+request_endtime;
//        else if(requesttype == "S")txt_message = "시작시간변경 신청을 "+status_text[changed_status]+"하시겠습니까?<br>변경요청 날짜 : "+request_starttime;
//        
//        
//        showModalDialog(document.body,"상태값 변경", txt_message , "변경하기", "취소",function(){
//            var value = {
//                useruid : useruid,
//                couponid : couponid, 
//                mbstype : mbstype, 
//                rqidx : rqidx,
//                requesttype : requesttype,
//                status : changed_status , 
//                requeststarttime : request_starttime,
//                requestendtime : request_endtime,
//                requestdesc : request_desc
//            };
//            sendRequestStatus(value);
//
//
//        },function(){
//            hideModalDialog();hideModalDialog();
//
//        });
//    }
//    function sendRequestStatus(value){
//        var groupcode = getData("nowgroupcode");
//        var centercode = getData("nowcentercode");
//        
//        var senddata = {
//            groupcode : groupcode,
//            centercode : centercode,
//            type :"changerequeststatus",
//            value:value
//        };
//        CallHandler("adm_get", senddata, function (res) {
////            clog("setsettingres is ",res);
//           if(res.code == 100){
//               //승인/승인거부 푸시메세지 보내기
//               getUserData(value.useruid, function(result) {
//                     var code = parseInt(result.code);
//                     if (code == 100) {
//                           var status_text = {"R":"요청","Y":"승인","N":"승인거부","D":"요청해제"};
//                           var requesttype_text = {"H":"홀딩","S":"시작시간변경","N":"없음"};
////                           status_text[value.status_text];
////                           requesttype_text[value.requesttype];
//                           var token = result.message[0].mem_fcmtoken;
//                           var mtitle = requesttype_text[value.requesttype]+" 요청 "+status_text[value.status];
//                           var txt_time = value.requesttype == "H" ? "홀딩기간("+value.requeststarttime.substr(0,10)+" ~ "+value.requestendtime.substr(0,10)+")" : "요청일("+value.requeststarttime.substr(0,10)+")";
//                           var mmessage = "고객님께서 요청하신 "+requesttype_text[value.requesttype]+" 요청건이 "+status_text[value.status]+"되었습니다.<br>"+txt_time;
//                           pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_NOTICE,function(res){
//                                code = parseInt(res.code);
//                                if (code == 100) {
//                                   clog("푸시보내기성공");
//                                } else {
//                                    alertMsg(res.message);
//                                }
//                           },function(err){
//                                alertMsg("네트워크 에러 ",err);
//                           }); 
//                     }
//               });
//               
//               C_showToast( "설정완료!", "성공적으로 설정하였습니다.", function() {});
//               loadMainDiv(12);
//           }else{
//               
//               C_showToast( "설정불가!", ""+res.message, function() {});
//           }
//           hideModalDialog();hideModalDialog();
//        }, function (err) { 
//            C_showToast( "에러!", ""+err, function() {});
//            hideModalDialog();hideModalDialog();
//        });
//    }
    
    function show_usertag(idx){
//        clog("idx "+idx+ " istraner "+istraner);
        var user = null;
        if(requestlist)user = requestlist[idx]; 
        
        getUserData(user.rq_userid,function(res){
             var style = {bodycolor:"#e9e9e9",size:{width:"66.5%",height:"100%"}};
            if(res.code == 100){
               
                 showinfo(res.message[0]);
            }else{
                alertMsg("고객을 찾을 수 없습니다.");
            }
            
        })
        
       
    }
    
  function arrowClick(leftright){
        
        //left
        if(leftright == 0){
            if(month == 1){
                month = 12;
                year = year-1;
            }else {
                month--;
            }    
        }
        //right
        else {
            if(month == 12){
                month = 1;
                year = year+1;
            }else{
                month++;
            }  
        }
        getRequestList(year,month);
        
    }
     
</script>