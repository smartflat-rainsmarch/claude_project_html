<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
	<div class="reservation_center" style='padding:5px'>
		<text id = 'id_setting_title' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >트레이너/강사정보</text>
		<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
		

		 <div id = "all_classes" style ="height:auto;margin-top:20px">
			<table class="table table-bordered fmont" id="dataTable" width="100%" cellspacing="0" style='text-align:center;background-color:white;font-size:14px;font-weight:400'>
			</table>
		 </div>
		 <div id = "div_member_table" style ="display:none" >
			<table class="table table-bordered" id="memberTable" width="100%" cellspacing="0" style='text-align:center;background-color:white;font-size:14px;font-weight:400'>
			</table>
		 </div>
		<br>
	</div>
</div>
<!--     <p align="right"><button onclick='insert_membership()' class='btn btn-primary btn-raised'>회원권 추가하기</button></p>-->
     

<script>
    var group = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    var centername = getData("nowcentername");
    
    var nosettingtranerusers = null;
    
    var alltraners = null;
    
    function init_d_traners_info(value){
        
        getCenterTraners(getData("nowcentercode"),function(_alltraners){
            alltraners = _alltraners;
            getTranersTable(alltraners);
        });
                   
    }
    function getTranersTable(rows) {
        
       
//        clog("getTranersTable!!",rows);
//            document.getElementById("table_div").style.display = "block";
        var table = document.getElementById('dataTable');
        var txt_idx_or_tranerinserttime = auth >= AUTH_OPERATOR ? "출근시간 / 퇴근시간" : "번호";
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa;text-align:left;text-align:center !important'><th style='padding-left:20px;'>"+txt_idx_or_tranerinserttime+"</th><th style='padding-left:20px'>이름</th><th style='padding-left:20px'>수업가능 시간설정</th><th style='padding-left:20px'>고객번호</th><th style='padding-left:20px'>전화번호</th><th style='padding-left:20px'>PT회원목록</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;
        table.style.textAlign = "center";
        
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            for (var i = 0; i < len; i++) {
                var using_coupons = getCoupons(rows[i],"using");
                var brow = body.insertRow();
                var useruid = rows[i]["mem_uid"];
                var userid = rows[i]["mem_userid"];
                var username = rows[i]["mem_username"];
                var userphone = rows[i]["mem_phone"];
                var memsetting = JSON.parse(rows[i]["mem_setting"]);
//                var token = rows[i]["mem_fcmtoken"];
//                clog("memsetting ",memsetting);
                var closetimes = memsetting && memsetting.closetimes ? memsetting.closetimes : [];
                
                var maxptcount = memsetting && memsetting.maxptcount ? parseInt(memsetting.maxptcount) : 0;
                var fixptpercent = memsetting && memsetting.fixptpercent ? parseInt(memsetting.fixptpercent) : 0;
//                clog("maxptcount "+maxptcount+" fixptpercent "+fixptpercent);
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = (i+1)+"";
                if(auth >= AUTH_OPERATOR){
                    var traner = findTodayInputUser(useruid);
//                    console.log("traner ",traner);
					var first_hhmm = "출근전";
                    var first_bgcolor = "white";
					if(traner && traner.firsttime){
						var hh = stringGetHour(traner.firsttime) < 10 ? "0"+stringGetHour(traner.firsttime) : ""+stringGetHour(traner.firsttime);
						var mm = stringGetMin(traner.firsttime) < 10 ? "0"+stringGetMin(traner.firsttime) : ""+stringGetMin(traner.firsttime);
						first_hhmm = hh+"시 "+mm+"분"; 
                        first_bgcolor = "#e6f2fe";
					}
                    var last_hhmm = "퇴근전";
                    var last_bgcolor = "white";
                    
					if(traner  && traner.firsttime && traner.lasttime && traner.firsttime.substr(0,16) != traner.lasttime.substr(0,16)){ //분 기준으로 짜른다.
//                        console.log("firsttime.substr(15) ",traner.firsttime.substr(0,16));
//						console.log("lasttime.substr(15) ",traner.lasttime.substr(0,16));
						var hh = stringGetHour(traner.lasttime) < 10 ? "0"+stringGetHour(traner.lasttime) : ""+stringGetHour(traner.lasttime);
						var mm = stringGetMin(traner.lasttime) < 10 ? "0"+stringGetMin(traner.lasttime) : ""+stringGetMin(traner.lasttime);
						last_hhmm = hh+"시 "+mm+"분"; 
                        last_bgcolor = "#e6f2fe";
					}
                    
                    var btn_tag = "<button onclick='get_traner_inputlist(\""+useruid+"\", \""+userid+"\", \""+username+"\")' class='btn' style='border:0px;width:auto; height:35px; border-radius:5px; background-color:#33a186;font-size:14px; color:#ffffff; text-align:center; font-weight:700;'>출근현황</button>";
					var insert_tag = "<label style='width:90px;height:35px; background-color:#ffffff;; border:1px solid #009ef7; border-radius:5px; border-top-style: dashed; border-right-style: dashed;border-bottom-style: dashed; border-left-style: dashed;padding:5px;font-size:14px; color:#009ef7; text-align:center; font-weight:700;background-color:"+first_bgcolor+"'>"+first_hhmm+"</label>&nbsp;&nbsp;<label style='width:90px;height:35px; background-color:#ffffff;; border:1px solid #009ef7; border-radius:5px; border-top-style: dashed; border-right-style: dashed;border-bottom-style: dashed; border-left-style: dashed;padding:5px;font-size:14px; color:#009ef7; text-align:center; font-weight:700;background-color:"+last_bgcolor+"'>"+last_hhmm+"</label>&nbsp;&nbsp;" 
                    bcell_index.innerHTML = insert_tag+btn_tag;
                }
                
                var bcell_name = brow.insertCell();
                var gender_icon = get_gender_icontag(rows[i]["mem_gender"]);
                var teacher_calendar_tag = auth >= AUTH_OPERATOR ? "&nbsp;<img src='./img/button_calendar.png' style='width:35px;height:35px'  onclick='showTranerReservation(\""+useruid+"\",\""+userid+"\",\""+username+"\",0)'/>" : "";
                bcell_name.innerHTML = "<button class='btn ' onclick='show_usertranerinfo_tag("+i+", 2)' style='width:auto; padding-left:15px;padding-right:15px;height:35px; border-radius:5px; background-color:#009ef7;border:0px;font-size:14px; color:#ffffff; text-align:center; font-weight:700;'>"+gender_icon+"&nbsp;"+rows[i]["mem_username"]+"</button>&nbsp;"+teacher_calendar_tag;
//                bcell_name.innerHTML = "<button class='btn btn-primary btn-raised' onclick='show_usertranerinfo_tag("+i+", 2)' style='background-color:#116666'>"+gender_icon+"&nbsp;"+rows[i]["mem_username"]+"</button><span aling='right'><button onclick='show_tranercalendar(\"" + useruid + "\",\"" + userid + "\")' style='background-color:#7777aa'>예약현황보기</button></span>";
                
                var bcell_infobtn = brow.insertCell();
                var strclosetimes = setJSONStringToParamString(closetimes);
//                clog("closetimes ",strclosetimes);
                bcell_infobtn.innerHTML = auth >= AUTH_OPERATOR ? "<button onclick='show_userclosetime(\""+useruid+"\", \""+strclosetimes+"\")' style='border:0px;width:auto;padding-left:15px;padding-right:15px; height:35px; border-radius:5px; background-color:#33a186;font-size:14px; color:#ffffff; text-align:center; font-weight:700;'>예약가능시간설정</button>&nbsp;" : "<button style='border:0px;width:auto;padding-left:15px;padding-right:15px; height:35px; border-radius:5px; background-color:#33a186;font-size:14px; color:#ffffff; text-align:center; font-weight:700;' disabled>예약가능시간설정</button>&nbsp;";
//                bcell_infobtn.innerHTML += auth >= AUTH_OPERATOR ? "<button onclick='show_userMaxPTCount(\""+useruid+"\", "+maxptcount+", "+fixptpercent+",8)'>월최대PT횟수설정</button>&nbsp;" : "<button disabled>월최대PT횟수설정</button>&nbsp;";
//                bcell_infobtn.innerHTML += auth >= AUTH_OPERATOR ? "<button onclick='show_userFixPTPercent(\""+useruid+"\", "+maxptcount+", "+fixptpercent+",8)'>PT단가고정%설정</button>" : "<button disabled>PT단가고정%설정</button>";
                
                
                var bcell_id = brow.insertCell();
                bcell_id.innerHTML = rows[i]["mem_userid"];
                
                var bcell_phone = brow.insertCell();
                bcell_phone.innerHTML = rows[i]["mem_phone"];

                var bcell_btn = brow.insertCell();
                bcell_btn.innerHTML = "<button onclick='get_mymembers(\""+useruid+"\", \""+username+"\")' class='btn'  style='width:auto; padding-left:15px;padding-right:15px;height:35px; border-radius:5px; background-color:#009ef7;border:0px;font-size:14px; color:#ffffff; text-align:center; font-weight:700;'>PT회원목록</button>";
                
            }
        }
        $('#dataTable').DataTable();
    }
//    function show_tranercalendar()
//    
     function insertMyMembersTable(traner_uid, traner_name, rows) {
        
       //array_push($teacher_reservation[$i]["myusers"], array("uid" => $m_uid, "userid"=>$m_userid,"name"=>$m_username, "starttime" => $pt_starttime,  "endtime" => $pt_endtime, "ornerstatus" => $orner_status, "couponid" => $couponid));//1.트레이너지정 , 2PT/
         //uid, id, name , starttime , endtime , ornerstatus , couponid , 

        var div_member_table =document.getElementById("div_member_table");
        var table = document.getElementById('memberTable');                                                      //등록일 = couponid                               
        //table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>인덱스</th><th>이름</th><th>고객번호</th><th>등록일</th><th>시작일</th><th style='max-width:100px'>종료일</th><th>오너설정값</th></tr></thead><tfoot></tfoot><tbody></tbody>";
         table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>이름</th><th>고객번호</th><th>내용</th><th>오너설정값</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;
//        clog("insertMyMembersTable rows",rows)
        
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            for (var i = 0; i < len; i++) {
               
                    
                
                var brow = body.insertRow();
                var useruid = rows[i]["uid"];
                var username = rows[i]["name"];
                var userid = rows[i]["userid"];
                var couponid = rows[i]["couponid"];
                var starttime = rows[i]["stattime"] ? rows[i]["stattime"] : couponid;
                var endtime = rows[i]["endtime"];
                var ornerstatus = rows[i]["ornerstatus"];
                var isdelete = rows[i]["isdelete"] ? rows[i]["isdelete"] : "N";
                
               if(isdelete == "D")continue;
                // 인덱스
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = (i+1)+"";
                bcell_index.style.maxWidth="30px";
                
                // 이름 성별               
                var bcell_name = brow.insertCell();
                bcell_name.innerHTML = "<button class='btn btn-primary btn-raised' onclick='getMyUserInfo(\""+userid+"\")' style='border:0px;background-color:#116666' >"+username+"</button>";

                
                //고객번호
                var bcell_id = brow.insertCell();
                bcell_id.innerHTML = userid;
                bcell_id.style.maxWidth="30px";

                //내용
                var bcell_desc = brow.insertCell();
                
                var mdate = rows[i]["date"] ? rows[i]["date"] : "";
                var mbsdesc = rows[i]["mbsdesc"] ? rows[i]["mbsdesc"] : "";
                var mbstype = rows[i]["mbstype"] ? rows[i]["mbstype"] : "";
                var mbsmaxcount = rows[i]["mbsmaxcount"] ? rows[i]["mbsmaxcount"] : "";
                var usecount = rows[i]["usecount"] ? rows[i]["usecount"] : "0";
                
                var desc = "["+mdate+" : "+mbsdesc+"] "+mbstype+" 총"+mbsmaxcount+"회 중 "+usecount+"회 진행";
                bcell_desc.innerHTML = desc;

//                //등록일 :couponid
//                var bcell_couponid = brow.insertCell();
//                bcell_couponid.innerHTML =couponid;
//                bcell_couponid.innerHTML = couponid ? couponid.substring(0,10) : "";
//                
//                
//               
//                //시작일
//                var bcell_starttime = brow.insertCell();
//                bcell_starttime.innerHTML = starttime ? starttime.substring(0,10) : "";
//
//                //종료일
//                var bcell_endtime = brow.insertCell();
//                bcell_endtime.innerHTML = endtime ? endtime.substring(0,10) : "";
                
                //오너설정값
                var status = ["트레이너 지정", "P.T 진행중","P.T 모두종료"];
                var bcell_ornerstatus = brow.insertCell();
                var txt_ornerstatus = ornerstatus ? status[parseInt(ornerstatus)] : "-";
                bcell_ornerstatus.innerHTML = txt_ornerstatus;
                
               
            }
        }
//        $('#memberTable').DataTable();
        
         var style = {
                bodycolor: "#ffffff",
                size: {
                    width: "90%",
                    height: "100%"
                }
            };
        showModalDialog(document.body, traner_name+" PT회원목록", div_member_table.innerHTML ,"확인",null, function() {
                hideModalDialog();
                
            }, function() {},style);
    }
   
   
    
    
//    function getTraners() {
//
//            if (centercode == null) return;
//            
//            var _data = {
//                "type": "teachers", // group or center or auth
//                "mbs_centercode": centercode
//            };
//           
//            CallHandler("getdata", _data, function(res) {
//                code = parseInt(res.code);
//                if (code == 100) {
//                    if (res.message.length == 0) return;
//                    
//                    alltraners = res.message;
//                  
//                    getTranersTable(alltraners);
//                } else {
//                    alertMsg(res.message);
//                }
//
//            }, function(err) {
//                alertMsg("네트워크 에러 ");
//
//            });
//
//        }
    
    function getOpenTimeTag(closetimes){
       
        var mtag = "";
        for(var i = 6 ;i <= 24; i++){  //6시 ~ 23시까지 
            var isopen = true;
            for(var j = 0 ; j < closetimes.length; j++){
                if(closetimes[j] == i){
                    isopen = false;
                    break;
                }
                    
            }
            var checked = isopen ? "checked" : "";
            var strtime = i < 10 ? "0"+i : i;
            mtag += "<span style='float:left;'><label class='mycheckbox'><input class='rtime_checkboxgroup' type='checkbox' name='rtime_info' value='"+i+"' "+checked+"><span class='checkmark'></span></label></span>"+
					 "<span style='float:left;'><text style='line-height:30px;'>&nbsp;"+strtime+"시&nbsp;&nbsp;&nbsp;</text></span>"; 
				
//				"<input class='rtime_checkboxgroup' type='checkbox' name='rtime_info' value='"+i+"' "+checked+">&nbsp;"+strtime+"시&nbsp;&nbsp;&nbsp;";
        }
         var opentag = 
			 "<div style='width:465px;height:200px; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;'>"+
				 "<div style='width:100%;height:44px;background-color:#f5f8fa; border-radius:10px 10px 0 0; border-bottom:1px solid #e4e6ef;'>"+
					"<label style='font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px'>수업가능시간</label>"+
				 "</div>"+

				 "<div style='height:auto;padding:15px 30px 15px 30px'>"+
			 		mtag
			 	 "</div>"+
			 "</div>";
			 
			
        return opentag;
    }
    function show_userclosetime(uid,str_closetimes){
        var closetimes = JSON.parse(str_closetimes);
        var message = getOpenTimeTag(closetimes);
        showModalDialog(document.body,"운동예약시간설정", message, "수정하기", "취소",function(){
              var clist = document.getElementsByClassName("rtime_checkboxgroup");
              var opentime_str = "";
              var closetimes = [];
              for (var i = 0; i < clist.length; ++i){
                  if(!clist[i].checked)
                       closetimes.push(parseInt(clist[i].value));
                   else 
                       opentime_str += clist[i].value+",";
              }
              updateCloseTimes(uid,closetimes,opentime_str);
                
            },function(){
             hideModalDialog();
            },null);    
    }
    
    function updateCloseTimes(uid,closetimes,opentime_str){
         var value = {
            uid:uid,
            closetimes : closetimes
        };
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");
        
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"updateclosetimes",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
//            clog("setsettingres is ",res);
           if(res.code == 100){
               sendPushMessage(uid,"수업가능시간 변경됨!","수업가능시간이 변경되었습니다. 예약가능시간 : "+opentime_str);
//               pushmessage_user(token,"운동예약가능시간 변경됨!","운동예약가능시간이 변경되었습니다. 예약가능시간 : "+opentime_str,ClickAction.SHOW_NOTICE,function(res){});
               
               alertMsg("성공적으로 수정하였습니다.",function(){
                   
                   loadMainDiv(8);
                    hideModalDialog();     
                   
               });
           }else{
               alertMsg(res.message+"");
           }
            
        }, function (err) { 
            alertMsg("네트워크 에러");
        });
    }
    
    //uid : 트레이너 uid ,  name : 트레이너 이름
    function get_mymembers(uid,name){
//        getNoSettingPTUsers(function(res){
       getTranerMyUsers(uid,function(res){
           if(res.code == 100){
               
                nosettingtranerusers = res.message;               
               insertMyMembersTable(uid,name,nosettingtranerusers);
           }
       },function(err){
          clog("getSettingData error ",err);
       });            
    }
    function get_traner_inputlist(useruid,userid,username){
        var now = new Date();
            var year = now.getFullYear();
        var style = {bodycolor:"#e9e9e9",size:{height:"500px"}};
       getInputLog(useruid,userid,year,function(logs){
            var title = username+" 출근기록";
           var inputlen = logs ? logs.length : 0;
           
           
           var calendar_tag =   "<div class='fmont' style='width:315px;height:325px;box-shadow: 1px 1px 3px 1px #dadce0'>" +
                                    "<div align='center' class='calendar_title' style='height:35px;background-color: #0c0c0d'>" +
                                        "<button class='tprev' style='border:0px;background-color:#00000000;outline:none;'><img src='./img/minicalendar_arrow_left.png' style='margin-top:-7px'></button>" +
                                        "<span class='current-year-month' style='font-size: 14px; color:#ffffff;text-align:center; font-weight:500;margin-top:10px'></span>" +
                                        "<button class='tnext' style='border:0px;background-color:#00000000;outline:none;'><img src='./img/minicalendar_arrow_right.png' style='margin-top:-7px'></button>" +
                                    "</div>" +

                                    "<section class='content-right' style='height:25px;background-color: #0c0c0d'>" +
                                        "<div class='day-of-week' style=''>" +
                                            "<div class='dayHeader sun'  style='background-color: #0c0c0d;color:font-size: 13px; color:#ffffff;text-align:center; font-weight:500;'>일</div>" +
                                            "<div class='dayHeader' style='background-color: #0c0c0d;color:#ffffff;text-align:center; font-weight:500;'>월</div>" +
                                            "<div class='dayHeader' style='background-color: #0c0c0d;color:#ffffff;text-align:center; font-weight:500;'>화</div>" +
                                            "<div class='dayHeader' style='background-color: #0c0c0d;color:#ffffff;text-align:center; font-weight:500;'>수</div>" +
                                            "<div class='dayHeader' style='background-color: #0c0c0d;color:#ffffff;text-align:center; font-weight:500;'>목</div>" +
                                            "<div class='dayHeader' style='background-color: #0c0c0d;color:#ffffff;text-align:center; font-weight:500;'>금</div>" +
                                            "<div class='dayHeader sat' style='background-color: #0c0c0d;color:#ffffff;text-align:center; font-weight:500;'>토</div>" +
                                        "</div>" +
                                        "<div class='calendar-body' style='overflow:hidden;background-color:white'></div>" +
                                    "</section>" +

                                "</div>";

                             
           
           var mtag = 
			   "<div align='center' id='div_inputlog'>"+
                    "<div style='height:360px;border:1px dashed #009ef6;padding-top:13px;background-color:e6f2fe'>"+calendar_tag+"</div>"+
                "</div>";
			   
           
           createInputLogExcelData(username,userid,logs);
            showModalDialog(document.body, title, mtag, "닫기",null, function () {
               hideModalDialog();
            }, style);
           
           getTranerInputLogTable(logs);
           
        })
        
    }
    function show_usertranerinfo_tag(idx, istraner){
        
        var user = null;
        //트레이너
        if(istraner == 2 && alltraners)
            user = alltraners[idx];
        else{
            //트레이너 PT유저
            if(nosettingtranerusers)user = nosettingtranerusers[idx];
        }  
            
        
        
        if(user){
        
            showinfo(user);
        }
        
    }
</script>