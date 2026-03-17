
 <div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >SMS/PUSH 현황</text>
			<span style='float:right'><text id='toggle_title_smspush' style='float:left;font-size:18px;font-weight:bold;margin-top:13px;'>모든센터보기&nbsp;</text><label class='switch' style='float:left;margin-top:10px'><input id='toggle_smspush' type='checkbox' onchange='smspush_togglechange()'><span class='slider round'></span></label><text id='toggle_txt_smspush'style='float:left;font-size:18px;font-weight:bold;margin-top:13px;'>&nbsp;OFF</text></span>
			
			
			<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
            <div align='left' style='width:1258px;height:50px;background-color:#f8f9fd;padding-left:20px;margin-top:-15px;margin-left:-28px;margin-right:-28px;margin-bottom:25px;'>
                <span style='margin:top'>
                    <i class="fa-solid fa-circle-question" title="페이롤 현황을 색깔로 표현해 줍니다." style='color:;color:#9c9daf' ></i>&nbsp;&nbsp;
                    <svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#fffd00'></rect></svg>&nbsp;&nbsp;<label style='font-size:14px;color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>그룹전송</label>&nbsp;&nbsp;&nbsp;
					<svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#ff545c'></rect></svg>&nbsp;<label id='txt_sms_setprice' style='font-size:14px; color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>SMS 건당 8원</label>&nbsp;&nbsp;&nbsp;
                    <svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#ff545c'></rect></svg>&nbsp;&nbsp;<label id='txt_lms_setprice' style='font-size:14px;color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>LMS 건당 25원</label>&nbsp;&nbsp;&nbsp;
                    <svg style='width:13px;height:13px;margin-top:-3px'><rect width='13' height='13' rx='3' ry='3' style='fill:#00a1f2'></rect></svg>&nbsp;&nbsp;<label id='txt_push_setprice' style='font-size:14px;color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>PUSH 건당 6원</label>&nbsp;&nbsp;&nbsp;     
					
                </span>               
            </div>
			
			  
            <div align="center" style="height:52px;margin-bottom:10px">
                <img id='arrow_l' src='./img/button_prev.png' style='float:left;margin-left:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(0)" />
                <img id='arrow_r' src='./img/button_next.png' style='float:right;margin-right:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(1)" />
               <label style="margin-top:10px;font-size:18px;color:#3f4254;font-weight:700;" id="txt_title">Send Message Data</label>
               
            </div>
			
			
			
			<div align='center' >
				

				<div id = "container">
					<table class="table table-bordered" id="table_smspush" width="100%" cellspacing="0" style="font-size: 14px;color:#3f4254; text-align:center; font-weight:500;"></table>
				</div>
				<div id = "id_nodata">
					<br>
					<div align = "center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
				</div>
				<div align='right' style='width:100%; height:48px; border-top:1px solid #f4e7b7; border-bottom:1px solid #f4e7b7; background-color:#fff8dd;margin-top:20px'>
					<label style="font-size: 16px;color:#a1a5b7; font-weight:700;margin-top:10px;margin-right:20px">총 사용금액:</label><label class="fmont" id='txt_alltotalprice' style="font-size: 16px;color:#181c32; font-weight:bold;margin-top:10px;margin-right:20px">￦ 0</label>
				</div>
			</div>
			
			<br><br>
			
	
			<div align="right">
				<text id='id_view_title' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >목록보기</text>
				<label style="font-size: 14px; color:#3f4254; font-weight:500;margin-top:10px">정렬:</label>
				<img id='group_1' src='./img/button_sort_block_selected.png' style='margin-left:5px;margin-top:3px;cursor:pointer' onclick="isViewType(1)" />
                <img id='group_0' src='./img/button_sort_list.png' style='margin-left:7px;margin-top:3px;cursor:pointer' onclick="isViewType(0)" />
			</div>
			
			<div id='div_all' style='padding:5px;display:none'>
				
				<br><br>
				<div id = "div_loglist" style='height:auto'>
					<br>
					<table  id="dataTable" width="100%" cellspacing="0" style="font-size: 14px; color:#212529; text-align:center; font-weight:500;border:1px solid #eff2f5;"></table>
				</div>
			</div>

			
			
			
	 </div>
</div>	

<div id='div_group' style='height:auto;margin-top:-20px'> 
	<div id="div_phone_cards" style="margin-top:50px">				
	</div>
</div>
<table id="hideTable" width="100%" cellspacing="0" style="font-size: 14px; color:#212529; text-align:center; font-weight:500;border:1px solid #eff2f5;display:none"></table>
<script>
     
    
     var viewtype = 1;  // 1 :  핸드폰화면타입 , 0 : 리스트타입
     var before_index = -1;
     var isallcenter = false;
     var now = new Date();
     var year = now.getFullYear();
     var month = now.getMonth() + 1;
	
     var groupcode = getData("nowgroupcode");
     var centercode = getData("nowcentercode");
     var requestlist = null;
     $( document ).ready(function() {
        
       
     });
    var price_sms = 8;
    var price_lms = 25;
    var price_push = 5;
    
    var logsms = [];
    var logpush = [];
    var centernames = {};
    function init_d_smspush(key){ //month
        clog("key is "+key);
        var txt_sms_setprice = document.getElementById("txt_sms_setprice");
        var txt_lms_setprice = document.getElementById("txt_lms_setprice");
        var txt_push_setprice = document.getElementById("txt_push_setprice");
        txt_sms_setprice.innerHTML = "SMS 건당 "+global_sms_sendprice+"원";
        txt_lms_setprice.innerHTML = "LMS 건당 "+global_lms_sendprice+"원";
        txt_push_setprice.innerHTML = "PUSH 건당 "+global_push_sendprice+"원";
        
		if(key){
			year = key.year;
			month = key.month;
			viewtype = key.viewtype;
			isallcenter = key.isallcenter;
		}
		 inittoggle();
		 getCenters(getData("nowgroupcode"),function(res){
             clog("centers ",res);
         });
         getSMSPushList(year,month);
		 isViewType(viewtype);
    }
	function inittoggle(){
		  var toggle = document.getElementById("toggle_smspush");
        var toggle_title = document.getElementById("toggle_title_smspush");
        var toggle_txt = document.getElementById("toggle_txt_smspush");
    //    clog("toggle check ",toggle.checked);
        if(isallcenter){
			toggle.checked = true;
            toggle_txt.innerHTML = "&nbsp;ON";
            toggle_txt.style.color = "blue";
            toggle_title.style.color = "blue";
		}
	}
    function getSMSPushList(year,month){
        var obj = new Object();
            obj.mycentercodes = session_centercodes        
            obj.year = year;
            obj.month = month;

            document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
            
            
            
            var senddata = {
                groupcode : getData("nowgroupcode"),
                centercode : getData("nowcentercode"),
                type :"getsmspushlist",
                value : obj
            }
            CallHandler("adm_get", senddata, function (res) {
                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {

                    requestlist = res.message;
                    insertSMSPushListTable(res.message,getData("nowgroupcode"),getData("nowcentercode"));
                    

                } else {
//                    alertMsg("목록이 없습니다.");
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
    }
	function isViewType(isgroup){
		var group_1 = document.getElementById("group_1"); // group
		var group_0 = document.getElementById("group_0"); // list
		var div_group = document.getElementById("div_group");
		var div_all = document.getElementById("div_all");
		var id_view_title = document.getElementById("id_view_title");
		if(isgroup){
			group_1.src = "./img/button_sort_block_selected.png";
			group_0.src = "./img/button_sort_list.png";
			div_group.style.display = "block";
			div_all.style.display = "none";
			viewtype = isgroup;
			id_view_title.innerHTML = "바둑판 보기";
		}else{
			group_1.src = "./img/button_sort_block.png";
			group_0.src = "./img/button_sort_list_selected.png";
			div_group.style.display = "none";
			div_all.style.display = "block";
			viewtype = isgroup;
			id_view_title.innerHTML = "목록 보기";
		}
		var reservation_container = document.getElementById("reservation_container");
		reservation_container.style.height = "auto";
	}
    function insertOTCell(brow,tag,maxWidth,minWidth){
        var cell = brow.insertCell();
		cell.style.paddingLeft="10px";
        cell.style.paddingRight="10px";
		cell.style.border = "1px solid #e7e7e7"
       
        if(maxWidth)cell.style.maxWidth = maxWidth;
        if(minWidth)cell.style.minWidth = minWidth;
        cell.innerHTML = tag;
    }
    function insertSMSPushListTable(rows,nowgroupcode,nowcentercode) {
        
        logsms = [];
        logpush = [];
        centernames = [];
        
        if(rows.length > 0)
            document.getElementById("id_nodata").style.display = "none";
        else 
            document.getElementById("id_nodata").style.display = "block";
//        clog("미설정고객들 ",rows);
//            document.getElementById("table_div").style.display = "block";
        var table = document.getElementById('table_smspush');
        table.innerHTML = "<thead><tr style='background-color:#f8f9fd'><th>센터명</th><th>SMS 횟수</th><th>LMS 횟수</th><th>PUSH 횟수</th><th>총금액</th></tr></thead><tfoot></tfoot><tbody></tbody>";
//        table.innerHTML = "<thead><tr style='background-color:#e8f9fa'><th>센터명</th><th>문자 횟수</th><th>앱푸시 횟수</th><th>총금액</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;

        var alltotalprice = 0;
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
					brow.style.backgroundColor = "#fef7f7";
                    var rqidx = rows[i]["data"]["sp_idx"];
                    var spgroupcode = rows[i]["data"]["sp_groupcode"];
                    var centercode = rows[i]["data"]["sp_centercode"];
                    var centername = rows[i]["data"]["sp_centername"];
                    var smscount = rows[i]["data"]["sp_smscount"];
                    var lmscount = rows[i]["data"]["sp_lmscount"];
                    var pushcount = rows[i]["data"]["sp_pushcount"];
                
                    if(spgroupcode != nowgroupcode)continue;
                
                    //var totalprice = smscount*price_sms+lmscount*price_lms+pushcount*price_push;
                    var totalprice = smscount*global_sms_sendprice+lmscount*global_lms_sendprice+pushcount*global_push_sendprice;
                    
//                    clog("isallcenter "+isallcenter+" nowcentercode "+nowcentercode+" centercode "+centercode);
                    if(!isallcenter && nowcentercode != centercode+"")continue;
                
                    alltotalprice += totalprice;
                    centernames.push({"code":centercode,"name":centername});
                    addLogSMSData(rows[i]["logsms"]);
                    addLogPUSHData(rows[i]["logpush"]);
                    ///////////////////////////////////////////////
                    // 센터명
                    ///////////////////////////////////////////////
                    insertOTCell(brow,centername); 
                    
                    ///////////////////////////////////////////////
                    // SMS 횟수
                    ///////////////////////////////////////////////
                    insertOTCell(brow,smscount); 
                    
                    ///////////////////////////////////////////////
                    // LMS 횟수
                    ///////////////////////////////////////////////
                    insertOTCell(brow,lmscount); 
                
//                    ///////////////////////////////////////////////
//                    // 문자 횟수
//                    ///////////////////////////////////////////////
//                    insertOTCell(brow,smscount+lmscount); 
                    
                    ///////////////////////////////////////////////
                    // PUSH 횟수
                    ///////////////////////////////////////////////
                    insertOTCell(brow,pushcount); 
                    
                    ///////////////////////////////////////////////
                    // 총금액
                    ///////////////////////////////////////////////
                    insertOTCell(brow,TXT_WON+" "+CommaString(totalprice)); 
                    
                    
            }
        }
        var txt_alltotalprice = document.getElementById("txt_alltotalprice");
        txt_alltotalprice.innerHTML = TXT_WON+" "+CommaString(alltotalprice);
        var alllogs = [];
        for(var i = 0 ; i < logsms.length;i++)
            if(logsms[i].status != "" && logsms[i].centercode != "")alllogs.push(logsms[i]);
        for(var i = 0 ; i < logpush.length;i++)
            if(logpush[i].status != "" && logpush[i].centercode != "")alllogs.push(logpush[i]);
        
        alllogs = alllogs.sort(sort_by('date', true, (a) => a.toUpperCase()));
		
        insertLogSmsPushTable(setRowsToGroup(alllogs));
       
		
    }
    function setRowsToGroup(rows){
		var groups = {};
		for(var i = 0 ; i < rows.length; i++){
			var logdata = rows[i];
			if(!groups[""+logdata.date])groups[""+logdata.date] = [];
			
			groups[""+logdata.date].push(logdata);			
		}
		
		
		
//		groups = sortKeyValueLength(groups);// value 갯수를 기준으로 정렬한다.
		
		return groups;
		
	}
	//key value 갯수를 기준으로 정렬
	function sortKeyValueLength(objs){
		return Object.keys(objs).map(function(k) { return { key: k, value: objs[k] }; }).sort(function(a, b) { return b.value.length - a.value.length; });
	}
	
	//무조건 갯수가 1개이상이다.
    function insertCardPhoneTable(parent,rows,cnt){
        
        var div_temp = document.createElement("div");
        
		var isleft = cnt%2 == 1 ? true : false;
		var len = rows.length;
		var logdata = rows[0];
		
		var float = isleft ? "left" : "right";
		
		var date = logdata["date"];
		var centercode = logdata["centercode"];
		var centername = getCenterName(centercode);

		var sendtype = logdata["type"];//전송타입
		var phone = len > 1 ? "그룹전송" : logdata["to"];//번호 or 아이디

		var status = logdata["status"]; // 전송상태
		var statusmessage = len > 1 ? "" : logdata["statusmessage"];//전송상태내용
		var title = logdata["title"] == "empty" ? "" : logdata["title"];//메세지제목
		var extag = len > 1 ? "[ex] " : "";
		var message = len > 1 ? "[ex] "+logdata["content"] : logdata["content"];//메세지내용

		var byte_txt = "약 "+message.length+" Byte";
		var date_txt = getDateFullFormat(date);
		var txtcolor = sendtype == "SMS" || sendtype == "MMS" || sendtype == "LMS" ? "#ff545c": "#00a1f2";
		var bgcolor = "white";
		if(len > 1){
			bgcolor = "#fffd0066";
			txtcolor = "#232323";
		}
			
		
		
		var issmstype = false;
		var ispushtype = false;
		var issms_push = false;
		for(var i = 0 ; i < rows.length; i++){
			if(rows[i]["type"] == "PUSH")ispushtype = true;
			if(rows[i]["type"] == "SMS" || rows[i]["type"] == "MMS" || rows[i]["type"] == "LMS")issmstype = true;
		}
		if(issmstype && ispushtype)issms_push = true;
		var txt_smspush = issms_push ? "LMS+PUSH" : sendtype;
		var txt_smspush_tag = len > 1 ? "" : "<label class='fmont' style='position:absolute;float:left; font-size: 18px; color:"+txtcolor+";font-weight:700;margin-top:17px;margin-left:25px'>"+txt_smspush+"</label>";
		var detailtag = "<label style='font-size: 13px; color:#181c32; font-weight:500;'>"+statusmessage+"</label>";
		if(len > 1){
			/*var btn = document.createElement("button");
			btn.style="border:0px;outline:none;width:50px; height:23px; border-radius:5px; background-color:#009ef7;font-size: 13px; color:#ffffff;text-align:center; font-weight:700;";
			btn.innerHTML = "상세";
			btn.onclick = function(){
				clog("aaaa");
				showRowsTable(rows,date_txt);
			}
			parent.querySelector("#td_btn_"+cnt).append(btn);*/
			
			detailtag = "<button style='border:0px;outline:none;width:50px; height:23px; border-radius:5px; background-color:#009ef7;font-size: 13px; color:#ffffff;text-align:center; font-weight:700;' onclick='showRowsTable(\""+setJSONStringToParamString(rows)+"\",\""+date_txt+"\")'>상세</button>";
		}
		
		
		var tag = "<span style='float:"+float+"'>"+
						"<div class='sms_card' style='width:615px;height:513px;background-color:"+bgcolor+"; border:1px solid #eff2f5; border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);padding:30px;'>"+
							"<span style='float:left'>"+
								"<img src='./img/device.png' alt='Avatar' style='position:absolute'>"+
									txt_smspush_tag+
								//main message
								"<div style='position:absolute;width:190px;height:50px;margin-top:70px;margin-left:30px'>"+
									"<label style=' font-size: 13px; color: #000000; line-height: 1.2; text-align:left;font-family:Gulim'>"+extag+title+"</label>"+  //title message
									"<hr style='border: solid 1px light-gray;'>"+
								"</div>"+
								"<div style='position:absolute;width:190px;height:250px;margin-top:140px;margin-left:30px;font-family:Gulim'>"+
									"<text style='width:100%;height:100%; font-size: 13px; color: #000000; line-height: 1.2; text-align:left;'>"+message+"</text>"+  //main message

								"</div>"+
								"<div align='right' style='position:absolute;width:190px;margin-top:380px;margin-left:30px'>"+
									//"<label class='fmont' style='float:left; font-size: 13px; color:#181c32;font-weight:400;'>"+txt_smspush+"</label>"+  //main message
									"<label class='fmont' style=' font-size: 13px; color:#181c32;font-weight:400;'>"+byte_txt+"</label>"+  //main message
								"</div>"+				
							"</span>"+
							"<span style='float:right'>"+
								"<div style='width:270px;height:450px;margin-top:50px;'>"+
									"<label style='font-size: 16px; color:#3f4254; font-weight:700;'>메시지 정보</label><br>"+
									"<table style='width:270px;'>"+
										"<tr style='height:39px;border-top:1px solid #effef5;background-color:white'>"+
											"<td style='width:70px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#5e6278; font-weight:500;'>전송시간</label>"+
											"</td>"+
											"<td style='width:200px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#181c32; font-weight:500;'>"+date_txt+"</label>"+
											"</td>"+										
										"</tr>"+
										"<tr style='height:39px;border-top:1px solid #effef5;background-color:white'>"+
											"<td style='width:70px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#5e6278; font-weight:500;'>전송타입</label>"+
											"</td>"+
											"<td style='width:200px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#181c32; font-weight:500;'>"+txt_smspush+"</label>"+
											"</td>"+										
										"</tr>"+
										"<tr style='height:39px;border-top:1px solid #effef5;background-color:#f8fafb'>"+
											"<td style='width:70px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#5e6278; font-weight:500;'>전송건수</label>"+
											"</td>"+
											"<td style='width:200px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#181c32; font-weight:500;'>"+len+"건</label>"+
											"</td>"+										
										"</tr>"+
										"<tr style='height:39px;border-top:1px solid #effef5;background-color:white'>"+
											"<td style='width:70px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#5e6278; font-weight:500;'>전송그룹</label>"+
											"</td>"+
											"<td style='width:200px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#181c32; font-weight:500;'>"+centername+"</label>"+
											"</td>"+										
										"</tr>"+
										"<tr style='height:39px;border-top:1px solid #effef5;background-color:#f8fafb'>"+
											"<td style='width:70px;padding-left:10px'>"+
												"<label style='font-size: 13px; color:#5e6278; font-weight:500;'>전송상태</label>"+
											"</td>"+
											"<td id='td_btn_"+cnt+"' style='width:200px;padding-left:10px'>"+
												detailtag+
											"</td>"+	
										"</tr>"+									
									"</table>"+
								"</div>"+
							"</span>"+
						"</div>"+
					"</span>";																				
//		parent.innerHTML+= tag;
		
		div_temp.innerHTML = tag;
		parent.append(div_temp);
	}
    
    function insertLogSmsPushTable(objs){
		
		clog(" insertLogSmsPushTable(objs ");
		
        var table = document.getElementById('dataTable');
        table.innerHTML = "<thead><tr style='background-color:#f5f6f8;height:50px'><th style='width:60px;border:1px solid #eff2f5;'>번호</th><th style='width:90px;border:1px solid #eff2f5;'>날짜</th><th style='width:100px;border:1px solid #eff2f5;'>센터명</th><th style='width:60px;border:1px solid #eff2f5;'>전송타입</th><th style='width:100px;border:1px solid #eff2f5;'>전화번호 or ID</th><th  style='width:190px;border:1px solid #eff2f5;'>전송상태</th><th style='width:180px;border:1px solid #eff2f5;'>제목</th><th style='width:350px;border:1px solid #eff2f5;'>내용</th><th style='width:70px;border:1px solid #eff2f5;'>전송건수</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
		
        var parent = document.getElementById("div_phone_cards");
        console.log("objs len ",objs);
        var cnt = 0;
		for(key in objs){
			var rows = objs[key];
//			clog("rows",rows);
			var len = rows.length;
//			clog("centernames ",centernames);
			var alltotalprice = 0;
			var index = 1;
			if (len > 0) {
				cnt++;
                insertCardPhoneTable(parent,rows,cnt);
            }
        }
        console.log("cnt is "+cnt);
        
        
		var cnt = 0;
		for(key in objs){
			var rows = objs[key];
//			clog("rows",rows);
			var len = rows.length;
//			clog("centernames ",centernames);
			var alltotalprice = 0;
			var index = 1;
			if (len > 0) {
				cnt++;
				//for (var i = 0; i < len; i++) {
				for (var i = 0; i < 1; i++) {
                    
					var logdata = rows[i];
					var brow = body.insertRow();
					var idx = index;
					var date = logdata["date"];
					var centercode = logdata["centercode"];
					var centername = getCenterName(centercode);
					
					var sendtype = logdata["type"];//전송타입
					var phone = len > 1 ? "그룹전송" : logdata["to"];//번호 or 아이디
					
					var status = logdata["status"]; // 전송상태
					var statusmessage = len > 1 ? "" : logdata["statusmessage"];//전송상태내용
					var title = logdata["title"] == "empty" ? "" : logdata["title"];//메세지제목
					var message = len > 1 ? "[ex] "+logdata["content"] : logdata["content"];//메세지내용

					var txtcolor = sendtype == "SMS" || sendtype == "MMS" || sendtype == "LMS" ? "#ff545c": "#00a1f2";
					var bgcolor = "white";
					if(len > 1){
						bgcolor = "#fffd0066";
						txtcolor = "#232323";
					}
					
					brow.style.backgroundColor = bgcolor;
					
					var date_txt = getDateFullFormat(date);
					var detailtag = len > 1 ? "<br><button style='border:0px;outline:none;width:50px; height:23px; border-radius:5px; background-color:#009ef7;font-size: 13px; color:#ffffff;text-align:center; font-weight:700;' onclick='showRowsTable(\""+setJSONStringToParamString(rows)+"\",\""+date_txt+"\")'>상세</button>": "";
					
					var issmstype = false;1
					var ispushtype = false;
					var issms_push = false;
					for(var i = 0 ; i < rows.length; i++){
						if(rows[i]["type"] == "PUSH")ispushtype = true;
						if(rows[i]["type"] == "SMS" || rows[i]["type"] == "MMS" || rows[i]["type"] == "LMS")issmstype = true;
					}
					if(issmstype && ispushtype)issms_push = true;
					var txt_smspush = issms_push ? "LMS+PUSH" : sendtype;
					///////////////////////////////////////////////
					// 삽입
					///////////////////////////////////////////////
					insertOTCell(brow,cnt); 
					insertOTCell(brow,date); 
					insertOTCell(brow,centername); 
					insertOTCell(brow,txt_smspush); 
					insertOTCell(brow,phone); 
					insertOTCell(brow,statusmessage); 
					insertOTCell(brow,title); 
					insertOTCell(brow,message); 
					insertOTCell(brow,len+"건"+detailtag); 
					index++;
				}
			}
		}
       
		
//        $('#dataTable').DataTable();
    }
    
	function showRowsTable(str_rows,date_txt){
		var rows = JSON.parse(str_rows);
		clog("aaaa showRowsTable");
		var title = date_txt+" 메세지정보";
		var message = getRowsTableTag(rows);
		var style = {bodycolor:"#ffffff",size:{width:"1310px",height:"100%"}};
		showModalDialog(document.body,title, message , "확인", null,function(){
            hideModalDialog();
        },null,style);
	}
    function getRowsTableTag(rows){
        var div = document.createElement("div");
		
		var table = document.createElement("table");
		table.className = "table table-borded";
		table.align="center";
		table.style.textAlign = "center";
		div.append(table);
		table.innerHTML = "<thead><tr style='background-color:#e8f9fa'><th>번호</th><th>날짜</th><th>센터명</th><th>전송타입</th><th>전화번호 or ID</th><th>전송상태</th><th>제목</th><th>내용</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;
        
        var alltotalprice = 0;
        var index = 1;
        if (len > 0) {
            for (var i = 0; i < len; i++) {
                var logdata = rows[i];
                var brow = body.insertRow();
                var idx = index;
                var date = logdata["date"];
                var centercode = logdata["centercode"];
                var centername = getCenterName(centercode);
                var sendtype = logdata["type"];//전송타입
                var phone = logdata["to"];//번호 or 아이디
                var status = logdata["status"]; // 전송상태
                var statusmessage = logdata["statusmessage"];//전송상태내용
                var title = logdata["title"] == "empty" ? "" : logdata["title"];//메세지제목
                var message = logdata["content"];//메세지내용
                
                ///////////////////////////////////////////////
                // 삽입
                ///////////////////////////////////////////////
                insertOTCell(brow,idx); 
                insertOTCell(brow,date); 
                insertOTCell(brow,centername); 
                insertOTCell(brow,sendtype); 
                insertOTCell(brow,phone); 
                insertOTCell(brow,statusmessage); 
                insertOTCell(brow,title); 
                insertOTCell(brow,message); 
                index++;
                    
                    
            }
        }
        return div.innerHTML;
    }
    function getCenterName(centercode){
        var centername = "";
        for(var i = 0 ;i < centernames.length; i++){
            if(centernames[i].code == centercode){
                centername = centernames[i].name;
                break;
            }
        }
        return centername;
    }
    function addLogSMSData(datas){
        if(datas)
        for(var i = 0 ; i < datas.length; i++)
            logsms.push(datas[i]);
    }
    function addLogPUSHData(datas){
        if(datas)
        for(var i = 0 ; i < datas.length; i++)
            logpush.push(datas[i]);
    }
 
    function show_usertag(idx){
//        clog("idx "+idx+ " istraner "+istraner);
        var user = null;
        if(requestlist)user = requestlist[idx]; 
        
        getUserData(user.rq_userid,function(res){
             
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
        //getSMSPushList(year,month);
	  	 var data = {"year":year,"month":month,"viewtype":viewtype,"isallcenter":isallcenter};
	    loadMainDiv(20,data);
        
    }
    function smspush_togglechange(){
    //    clog("toggle change!!"+ischeck);
        var toggle = document.getElementById("toggle_smspush");
        var toggle_title = document.getElementById("toggle_title_smspush");
        var toggle_txt = document.getElementById("toggle_txt_smspush");
    //    clog("toggle check ",toggle.checked);
        if(toggle.checked){
            toggle_txt.innerHTML = "&nbsp;ON";
            toggle_txt.style.color = "blue";
            toggle_title.style.color = "blue";
            isallcenter = true;
        }else{
            toggle_txt.innerHTML = "&nbsp;OFF";
            toggle_txt.style.color = "gray";
            toggle_title.style.color = "gray";
            isallcenter = false;
        }
        //getSMSPushList(year,month);
		setTimeout(function(){
			var data = {"year":year,"month":month,"viewtype":viewtype,"isallcenter":isallcenter};
	    	loadMainDiv(20,data);	
		},300);
        
       
       
    }
</script>