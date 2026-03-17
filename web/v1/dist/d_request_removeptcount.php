<div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >잔여세션 소진신청</text>
			 <br><br><br>
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
     $( document ).ready(function() {
        
         getRequestRemovePTCountList(year,month);
     });
    function init_d_request_removeptcount(key){
        clog("key is "+key);
    }
    function getRequestRemovePTCountList(year,month){
        var obj = new Object();
            obj.centercode = getData("nowcentercode");
        
            obj.year = year;
            obj.month = month;
//            obj.day = day;  // 1달기준으로 가져올거기때문에 사용하지 않음
            document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
            
            

            var senddata = {
                groupcode : getData("nowgroupcode"),
                centercode : getData("nowcentercode"),
                type :"getrequestremoveptcountlist",
                value : obj
            }
            CallHandler("adm_get", senddata, function (res) {
                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {

                    requestlist = res.message;
                    insertRequestRemovePTCountListTable(res.message);
                    

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
    function insertRequestRemovePTCountListTable(rows) {
        
        if(rows.length > 0)
            document.getElementById("id_nodata").style.display = "none";
        else 
            document.getElementById("id_nodata").style.display = "block";
//        clog("미설정고객들 ",rows);
//            document.getElementById("table_div").style.display = "block";
        var table = document.getElementById('dataTable');
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>인덱스</th><th>신청자</th><th>요청일</th><th>이름</th><th>회원권</th><th>소진신청횟수</th><th>PT기간</th><th>특이사항</th><th>상태</th><th>문서보기</th></tr></thead><tfoot></tfoot><tbody></tbody>";
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
                    var brow = body.insertRow();
                    var rqidx = rows[i]["rmpt_idx"];
                    var rdate = rows[i]["rmpt_nowdate"];
                    var managername = rows[i]["rmpt_managername"];
                    var useruid = rows[i]["rmpt_useruid"];
                    var userid = rows[i]["rmpt_userid"];
                    clog("userid ",userid);
                    var username = rows[i]["rmpt_username"];
                
//                    var requesttype = rows[i]["rmpt_requesttype"];
                    var status = rows[i]["rmpt_removeptstatus"];
                    //var mbstype = rows[i]["rmpt_mbstype"];
                    var maxcount = rows[i]["rmpt_maxcount"];
                    var usecount = rows[i]["rmpt_usecount"];
                    var removeptcount = rows[i]["rmpt_removecount"];
                
                    var mbstype = "PT";
                    var pt_couponname = mbstype+" "+maxcount+" 회/"+usecount+"회 진행";
                    var couponid = rows[i]["rmpt_couponid"];
                    var request_starttime = rows[i]["rmpt_starttime"];
                    var request_endtime = rows[i]["rmpt_endtime"];
                    var request_desc = rows[i]["rmpt_note"];
                    
                    var isfreeuser = true;
                    
					var label_fmont_f = "<label class='fmont' style='font-size: 14px; color:#495057; font-weight:500; text-align:center;'>";
					var label_f = "<label style='font-size: 14px; color:#495057; font-weight:500; text-align:center;'>";
					var label_e = "</label>";
                    ///////////////////////////////////////////////
                    // 인덱스
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_fmont_f+(i+1)+label_e); 
                    
                    ///////////////////////////////////////////////
                    // 신청자
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_f+managername+label_e); 
                    
                    ///////////////////////////////////////////////
                    // 요청일
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_fmont_f+rdate+label_e); 
                    
                    
                    
                    ///////////////////////////////////////////////
                    // 이름/ 고객번호
                    ///////////////////////////////////////////////                   
                    //var name_tag = "<button class='btn btn-primary btn-raised' onclick='show_usertag("+i+")' style='font-size:14px;background-color:#116666'>"+username+"["+userid+"]</button>";
					var name_tag = "<button class='btn btn-primary btn-raised' onclick='show_usertag("+i+")' style='font-size:14px;background-color:#116666'>"+username+"</button>";
                    insertOTCell(brow,isfreeuser,name_tag); 
                    

                    ///////////////////////////////////////////////
                    //PT 회원권이름
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_f+pt_couponname+label_e);
                    
                    ///////////////////////////////////////////////
                    //신청횟수
                    ///////////////////////////////////////////////
                    insertOTCell(brow,isfreeuser,label_fmont_f+removeptcount+"회"+label_e);
                    
                    ///////////////////////////////////////////////
                    //요청기간
                    ///////////////////////////////////////////////
                    var starttime_tag = request_starttime ? getToday(new Date(request_starttime)) : "";
                    var endtime_tag = request_endtime ? getToday(new Date(request_endtime)) : ""
                    var startend_tag = endtime_tag ? "<text style='font-size:12px'>"+starttime_tag+" ~ "+endtime_tag+"</text>" : "<text style='font-size:12px'>"+starttime_tag+"</text>";
                    insertOTCell(brow,isfreeuser,startend_tag);
                    
                    ///////////////////////////////////////////////
                    //특이사항
                    ///////////////////////////////////////////////
                    var desc_tag = request_desc ? request_desc : "";
                    insertOTCell(brow,isfreeuser,label_f+desc_tag+label_e);
                    
                    ///////////////////////////////////////////////
                    //상태변경
                    ///////////////////////////////////////////////
                    var status_text = ["","트레이너가 요청함","신청승인됨","신청거부됨"];
                    insertOTCell(brow,isfreeuser,status_text[status]);

                    ///////////////////////////////////////////////
                    //상태변경하기 버튼
                    ///////////////////////////////////////////////
                    var btn_oktag = "";
                    var btn_canceltag = "";
                    if(status == 1){
                        var str_rmptdata = setJSONStringToParamString(rows[i]);
                        clog("00 ",str_rmptdata);
                        btn_oktag = "<button onclick='showRemovePTCountDocument(\""+couponid+"\", \""+useruid+"\", \""+status+"\", \""+str_rmptdata+"\")' class='btn btn-primary btn-raised'>문서보기</button>";
//                        btn_oktag = "<button onclick='changeRequestRemovePTCountStatus("+i+","+rqidx+", \""+useruid+"\", \""+couponid+"\", \""+mbstype+"\", \"Y\" , \""+status+"\" , \""+request_starttime+"\" , \""+request_endtime+"\" , \""+request_desc+"\" )' class='btn btn-primary btn-raised'>승인하기</button>";
//                        btn_canceltag = "<button onclick='changeRequestRemovePTCountStatus("+i+","+rqidx+", \""+useruid+"\", \""+couponid+"\", \""+mbstype+"\",  \"N\" ,\""+status+"\" , \""+request_starttime+"\" , \""+request_endtime+"\" , \""+request_desc+"\" )' class='btn btn-primary btn-raised' style='background-color:red'>거부하기</button>";    
                         
                    }else if(status == 2){
                        
//                        btn_oktag = getDDay(request_endtime) > 0 ? "<button onclick='changeRequestRemovePTCountStatus("+i+","+rqidx+", \""+useruid+"\", \""+couponid+"\", \""+mbstype+"\", \""+requesttype+"\" , \"D\" , \""+status+"\" , \""+request_starttime+"\" , \""+request_endtime+"\" , \""+request_desc+"\")' class='btn btn-primary btn-raised'>홀딩풀기</button>" : "";    
                        
                    }
                    
                    insertOTCell(brow,isfreeuser,btn_oktag+"&nbsp;"+btn_canceltag);
              
            }
        }
        $('#dataTable').DataTable();
    }
    function showRemovePTCountDocument(couponid,useruid,before_remove_pt_status,str_rmptdata){
//        clog("str_rmptdata ",str_rmptdata);
        
        
        var rmptdata = str_rmptdata ? changeStrToJson(str_rmptdata) : null;
        getUserData(useruid,function(res){
            var code = parseInt(res.code);
             if (code == 100) {
                var userinfo = res.message[0];
                var reservation = JSON.parse(userinfo["mem_reservation"]);
                var coupon = null;
                for(var i = 0 ; i < reservation.length; i++){
                    if(couponid == reservation[i].id){
                        coupon = reservation[i];
                        break;
                    }
                }
                showRemovePTCount(coupon,userinfo,before_remove_pt_status,rmptdata); 
             }
        });
        
    }
    function changeRequestRemovePTCountStatus(i,rqidx,useruid,couponid,mbstype,changed_status,status,request_starttime,request_endtime,request_desc){

       
        if(!changed_status || changed_status == status){
            alertMsg("상태값을 변경해 주세요.");
            return;
        }
       
        var status_text = {"R":"요청","Y":"승인","N":"승인거부","D":"요청해제"};
        var txt_message = "";
       
        txt_message = "잔여세션 소진신청을 "+status_text[changed_status]+"하시겠습니까?<br>변경요청 날짜 : "+request_starttime;
        showModalDialog(document.body,"상태값 변경", txt_message , "변경하기", "취소",function(){
            var value = {
                useruid : useruid,
                couponid : couponid, 
                mbstype : mbstype, 
                rqidx : rqidx,
                
                status : changed_status , 
                requeststarttime : request_starttime,
                requestendtime : request_endtime,
                requestdesc : request_desc
            };
            sendRequestRemovePTCountStatus(value);


        },function(){
            hideModalDialog();hideModalDialog();

        });
    }
    
    //잔여세션소진 신청승인하기
    function changeRequestRemovePTCountStatus(value){
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");
        
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"changerequestremoveptcountstatus",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
//            clog("setsettingres is ",res);
           if(res.code == 100){
               //승인/승인거부 푸시메세지 보내기
               getUserData(value.useruid, function(result) {
                     var code = parseInt(result.code);
                     if (code == 100) {
                           var status_text = {"R":"요청","Y":"승인","N":"승인거부","D":"요청해제"};
                         

                           var token = result.message[0].mem_fcmtoken;
                           var mtitle = "잔여세션 소진";
                           var txt_time = "요청일("+value.requeststarttime.substr(0,10)+")";
                           var mmessage = "요청한 잔여세션소진신청 요청건이 "+status_text[value.status]+"되었습니다.<br>"+txt_time;
                           pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_NOTICE,function(res){
                                code = parseInt(res.code);
                                if (code == 100) {
                                   clog("푸시보내기성공");
                                } else {
                                    alertMsg(res.message);
                                }
                           },function(err){
                                alertMsg("네트워크 에러 ",err);
                           }); 
                     }
               });
               
               C_showToast( "설정완료!", "성공적으로 설정하였습니다.", function() {});
               loadMainDiv(33);
           }else{
               
               C_showToast( "설정불가!", ""+res.message, function() {});
           }
           hideModalDialog();hideModalDialog();
        }, function (err) { 
            C_showToast( "에러!", ""+err, function() {});
            hideModalDialog();hideModalDialog();
        });
    }
    
    function show_usertag(idx){
//        clog("idx "+idx+ " istraner "+istraner);
        var user = null;
        if(requestlist)user = requestlist[idx]; 
        
        getUserData(user.rmpt_userid,function(res){
             var style = {bodycolor:"#e9e9e9",size:{width:"1290px",height:"100%"}};
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
        getRequestRemovePTCountList(year,month);
        
    }
     
</script>