<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
	<div class="reservation_center" style='padding:5px'>
		<span><label id="id_nosettinguser_title" style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;margin-top:15px" >트레이너 미설정 고객목록</label></span>
<!--
		<span style="float:right;padding-top:10px;">
			<select  id='select_month' onchange="changeOTMonth()" style='width:75px; height:35px; background-color:#f5f8fa; border-radius:5px; padding-left:10px;padding-right:10px;font-size:12px; color:#212529; text-align:left; font-weight:500;border:0px'><option value ="0">ALL</option><option value ="1">1월</option><option value ="2">2월</option><option value ="3">3월</option><option value ="4">4월</option><option value ="5">5월</option><option value ="6">6월</option><option value ="7">7월</option><option value ="8">8월</option><option value ="9">9월</option><option value ="10">10월</option><option value ="11">11월</option><option value ="12">12월</option></select>
		</span>
-->
		<br><br>
       
		<hr style="border: solid 1px #eff2f5;margin-left:-28px;margin-right:-28px;">
		
        
        <!--좌우화살표-->
        <div align="center" style="height:52px;margin-bottom:10px">
            <img id='arrow_l' src='./img/button_prev.png' style='float:left;margin-left:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(0)" />
            <img id='arrow_r' src='./img/button_next.png' style='float:right;margin-right:5px;margin-top:3px;cursor:pointer' onclick="arrowClick(1)" />
           <label style="margin-top:10px;font-size:18px;color:#3f4254;font-weight:700;" id="txt_title">Send Message Data</label>				
        </div>
        <br>
		<ul class="nav nav-tabs">
		  <li class="nav-item">
			<a href="#aaa"  class="nav-link active" data-toggle="tab" onclick="tab_click(1)">유료 PT 회원</a>
		  </li>
		  <li class="nav-item">
			<a href="#bbb"  class="nav-link" data-toggle="tab"  onclick="tab_click(2)">무료 PT 진행중</a>
		  </li>
		 <li class="nav-item">
			<a href="#ccc"  class="nav-link" data-toggle="tab"  onclick="tab_click(3)">무료 PT 종료</a>
		  </li>

		</ul>
		<div id='div_freept_btn' align="right" style='display:none;margin-top:-47px'><button onclick='insert_freept()' class='btn' style="width:115px; height:35px; border-radius:5px; background-color:#009ef7;font-size:13px; color:#ffffff; text-align:center;font-weight:700;">무료PT 추가</button></div>
		<div class="tab-content" id="tabs">
			<div class="tab-pane" id="aaa"></div>
			<div class="tab-pane" id="bbb"></div>   
			 <div class="tab-pane" id="ccc"></div>   
		</div>
		
		<br>
			
		 <div id = "all_classes" style ="width:100%;height:auto;margin-top:15px">

			<table class="table-bordered fmont" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;color:#3f4254; text-align:center; font-weight:500;"></table>
		 </div>
		<br>
		<!--     <p align="right"><button onclick='insert_membership()' class='btn btn-primary btn-raised'>회원권 추가하기</button></p>-->
		
	</div>
</div>
<script>
    
    setImageButton("arrow_l","button_prev.png","button_prev_press.png","button_prev_hover.png");
    setImageButton("arrow_r","button_next.png","button_next_press.png","button_next_hover.png");
    
	var istype = "otpaidtype";
    var group = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    var centername = getData("nowcentername");
    
    var nosettingtranerusers = null;
    
    var alltraners = null;
//    var otmonth = "0";
    var div_freept_btn = document.getElementById("div_freept_btn");
    
    
    var now = new Date();
     var year = now.getFullYear();
     var month = now.getMonth() + 1;
     var day = now.getDate();
    
    if(getData("setottype") == "otfreetype"){
        activaTab('bbb');
        div_freept_btn.style.display="block";
    }
    else if(getData("setottype") == "otfreefinishtype"){
        activaTab('ccc');
        div_freept_btn.style.display="block";
    }else
        div_freept_btn.style.display="none";
    
    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };
    
    function init_d_select_traner(value){
        clog("트레이너 미설정 고객목록");
        var txt_title = document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
        var id_nosettinguser_title = document.getElementById("id_nosettinguser_title");
        id_nosettinguser_title.innerHTML = "트레이너 미설정 고객목록";
        getCenterTraners(getData("nowcentercode"),function(_alltraners){
            alltraners = _alltraners;
            getNoSettingUsersCall(year,month);   
        });

//        
    }
    function getNoSettingUsersCall(year,month){
        getNoSettingPTUsers(year,month,function(res){
            console.log("res ",res);
               if(res.code == 100){
                   var txt_title = document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
                   nosettingtranerusers = res.message;
                   initOTMonth();
                   istype = getOTType();
                   
                   insertSettingPTTranerTable(nosettingtranerusers,istype,month);

               }
           },function(err){
              clog("getSettingData error ",err);
           }); 
    }
    function initOTMonth(){
//        otmonth = getOTMonth();
//        var select_month = document.getElementById("select_month");
//        select_month.selectedIndex = parseInt(otmonth);
    }
    //nosetting user인지 체크한다.
    function isNoSettingUser(userstatus){
        var flg = 1;
        if(userstatus == "")
            flg = 1;
        else{
            var len = userstatus.length;
            for(var i = 0; i < len;i++){
                var ustatus = userstatus[i];
                if(parseInt(ustatus.status) == 100){
                    flg = 0;
                    break;
                }
                if(parseInt(ustatus.status) == 101){
                    flg = 2;
                    break;
                }
            }
            
        }
        
        return flg;
    }
    function insert_freept(){
        var freept_div = document.createElement("div"); 
            var style = {
                bodycolor: "#f8f8f8",
                size: {
                    width: "80%",
                    height: "100%"
                }
            };
         freept_div.innerHTML = "회원검색 : <input id='id_user_search' onkeyup='enterkey(2)' type='text' placeholder='이름,폰,회원번호로 찾기...' aria-label='Search' aria-describedby='basic-addon2' /><button class='btn btn-primary' type='button' style='margin-top:-5px' onclick='freept_user_search()' ><i class='fas fa-search'></i></button><br><br><div id='search_body'></div>";
        showModalDialog(document.body,"무료PT 등록하기", freept_div.innerHTML, "등록하기", "취소",function(){
          check_freept();
        },function(){hideModalDialog();},style);

    }
   
    function insertOTCell(brow,isfreeuser,tag,maxWidth,minWidth){
        var cell = brow.insertCell();
        if(!isfreeuser){
//            cell.style.backgroundImage = "linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%)";
            cell.style.backgroundColor = "#e9e9d9";
        }
        cell.style.padding="10px";
        if(maxWidth)cell.style.maxWidth = maxWidth;
        if(minWidth)cell.style.minWidth = minWidth;
        cell.innerHTML = tag;
    }
    function insertSettingPTTranerTable(rows,istype,otmonth) {
        
       
//        clog("미설정고객들 ",rows);
//            document.getElementById("table_div").style.display = "block";
        var table = document.getElementById('dataTable');
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa;height:50px'><th>순번</th><th style='width:60px'>등록일</th><th style='width:110px'>이름</th><th style='width:110px'>전화번호</th><th style='width:70px'>PT</th><th  style='width:80px'>기간</th><th style='width:55px'>가격</th><th style='width:60px'>시간</th><th style='width:70px'>현재상황</th><th style='width:130px'>트레이너선택</th><th style='width:180px'>진행상황</th><th style='width:80px'>상태변경</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows ? rows.length : 0;

        
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            
            for (var i = 0; i < len; i++) {
                var using_coupons = getCoupons(rows[i],"using");
                
                var ptcoupon = null;
                
                //먼저 트레이너 미설정 고객이 있는지 체크한다.
                for(var a = 0 ; a < using_coupons.length; a++){
                    if(using_coupons[a].mbstype == "PT" && isNoSettingUser(using_coupons[a].userstatus) != 0){                        
                       ptcoupon = using_coupons[a];
                       break;    
                    }
                }
                //미설정 고객이라면 삽입한다.
                if(ptcoupon != null){
                    rows[i]["pt_id"] = ptcoupon.id;
                    rows[i]["pt_starttime"] = ptcoupon.starttime;
                    rows[i]["pt_endtime"] = ptcoupon.endtime;
                }
            }
           
            
            rows = sort_array(rows,"pt_id");
            
            nosettingtranerusers = rows;
            
            var index = 1;
            for (var i = 0; i < len; i++) {
                var using_coupons = getCoupons(rows[i],"using");
                
                var ptcoupon = null;
                
                //먼저 트레이너 미설정 고객이 있는지 체크한다.
                for(var a = 0 ; a < using_coupons.length; a++){
                    if(using_coupons[a].mbstype == "PT" && isNoSettingUser(using_coupons[a].userstatus) != 0){                        
                       ptcoupon = using_coupons[a];
                       break;    
                    }
                }
                //미설정 고객이라면 삽입한다.
                if(ptcoupon != null){
//                     console.log("rows[i] ",rows[i]);
                    rows[i]["pt_starttime"] = ptcoupon.starttime;
                    rows[i]["pt_endtime"] = ptcoupon.endtime;
                    var useruid = rows[i]["mem_uid"];
                    var userid = rows[i]["mem_userid"];
                    var username = rows[i]["mem_username"];
                    var userphone = rows[i]["mem_phone"];
                    
                   
                    var isfreeuser =  parseInt(ptcoupon.mbsprice) == 0  && ptcoupon.mbsname.indexOf(ID_FREE) >= 0 ? true : false;
                    
                    var cooupon_date = ptcoupon.id.substr(0,10);
                    
                    if(month == 0 || month != 0 && parseInt(stringGetMonth(ptcoupon.id)) == month){
                    
                        
                        if(istype == "otpaidtype" && !isfreeuser || istype == "otfreetype" && isfreeuser && isNoSettingUser(ptcoupon.userstatus) == 1 || istype == "otfreefinishtype" && isfreeuser && isNoSettingUser(ptcoupon.userstatus) == 2){
                        

                            var allfinish = isNoSettingUser(ptcoupon.userstatus) == 2 ? true : false;

                            var brow = body.insertRow();
                            brow.style.height = "50px";
                            brow.style.padding = "10px";
                            ///////////////////////////////////////////////
                            // 번호
                            ///////////////////////////////////////////////
                            insertOTCell(brow,isfreeuser,index+"","30px","30px"); 
                                index++;

                            ///////////////////////////////////////////////
                            // 등록일
                            ///////////////////////////////////////////////
                            insertOTCell(brow,isfreeuser,cooupon_date,"100px","90px"); 



                            ///////////////////////////////////////////////
                            // 이름 성별
                            ///////////////////////////////////////////////
                            var gender_icon = get_gender_icontag(rows[i]["mem_gender"]);
                            var name_tag = "<button onclick='show_ptusertag("+i+")' style='min-width:90px;border:0px;border-radius:6px;outline:none;padding:9px 12px 9px 12px;font-size:14px;background-color:#116666;color:white' title='고객번호 : "+rows[i]["mem_userid"]+"'>"+gender_icon+"&nbsp;"+rows[i]["mem_username"]+"</button>";
                            insertOTCell(brow,isfreeuser,name_tag); 

                            ///////////////////////////////////////////////
                            //고객번호
                            ///////////////////////////////////////////////
//                            insertOTCell(brow,isfreeuser,rows[i]["mem_userid"]);

                            ///////////////////////////////////////////////
                            //전화번호
                            ///////////////////////////////////////////////
                            insertOTCell(brow,isfreeuser,"<text>"+rows[i]["mem_phone"]+"</text>","100px");

                            ///////////////////////////////////////////////
                            //PT운동권
                            ///////////////////////////////////////////////
                            var ptname = ptcoupon.mbstype+" "+ptcoupon.mbsmaxcount+"회";
                            insertOTCell(brow,isfreeuser,ptname);

                            
                            ///////////////////////////////////////////////
                            //기간 : 시작일 ~ 종료일
                            ///////////////////////////////////////////////
                            var starttime_tag = ptcoupon.starttime ? ptcoupon.starttime.substring(0,10) : ""
                            var endtime_tag = ptcoupon.endtime ? ptcoupon.endtime.substring(0,10) : ""
                            insertOTCell(brow,isfreeuser,starttime_tag+" ~<br>"+endtime_tag,"100px","100px");

                            
                            
//                            ///////////////////////////////////////////////
//                            //시작일
//                            ///////////////////////////////////////////////
//                            var starttime_tag = ptcoupon.starttime ? ptcoupon.starttime.substring(0,10) : ""
//                            insertOTCell(brow,isfreeuser,starttime_tag);
//
//                            ///////////////////////////////////////////////
//                            //종료일
//                            ///////////////////////////////////////////////
//                            var endtime_tag = ptcoupon.endtime ? ptcoupon.endtime.substring(0,10) : ""
//                            insertOTCell(brow,isfreeuser,endtime_tag);

                            ///////////////////////////////////////////////
                            //가격
                            ///////////////////////////////////////////////
                            var price_tag = using_coupons.length > 0 ? ptcoupon.mbsprice+""+TXT_WON : "-";
                            insertOTCell(brow,isfreeuser,price_tag);

                            ///////////////////////////////////////////////
                            //시간대 오전/오후/안함
                            ///////////////////////////////////////////////
                            var ampmno_str = {"AM" : "오전", "PM" : "오후", "NO" : "안함"}
                            var ampm_tag = ampmno_str[ptcoupon["counttypeampm"]];
                            insertOTCell(brow,isfreeuser,ampm_tag);

                            ///////////////////////////////////////////////
                            //현재상황 ex)전화/문자/예약...
                            ///////////////////////////////////////////////
                            var status_text = ["","전화","문자","연락안됨","예약됨","종료","팀장승인됨"];
                            var user_status = ptcoupon["userstatus"] ? ptcoupon["userstatus"] : "";
                            var my_status = "";
                            var isconnectuser = 0;
                            for (var c = 0; c < user_status.length; c++){
                                var status = parseInt(user_status[c].status);   
                                var finishnote = user_status[c].finishnote ? "["+user_status[c].finishnote+"]" : "";  
                                if(status == 4)isconnectuser = 1;
                                else if(status == 5)isconnectuser = 2;
                                else if(status == 6)isconnectuser = 3;

                                if(status == 101){
                                    my_status +="PT 모두종료";
                                }else 
                                    my_status += status == 100 ? status_text[6]+"/" : status_text[status]+finishnote+"/";                    
                            } 
                            var userstatus_tag = "";
                            if(isconnectuser == 1)
                               userstatus_tag = "<text style='background-color:yellow'>"+my_status+"</text>";
                            else if(isconnectuser === 2)
                                userstatus_tag ="<text style='background-color:#ffbbbb'>"+my_status+"</text>";
                            else if(isconnectuser === 3)
                                userstatus_tag ="<text style='background-color:#bbbbff'>"+my_status+"</text>";
                            else
                                userstatus_tag = "<text style='background-color:white'>"+my_status+"</text>";
                            insertOTCell(brow,isfreeuser,userstatus_tag);


                            var before_managerid = ptcoupon["managerid"];    
                            var before_managername = ptcoupon["manager"];    
                            ///////////////////////////////////////////////
                            //트레이너 선택
                            ///////////////////////////////////////////////
                            var option = "<option value=''>== PT트레이너 지정 ==</option>";

                            for (var c = 0; c < alltraners.length; c++){
                                var selected = "";
                                //트레이너는현재상황 ex)문자/전화 데이타가  트레이너를 변경할 수 없도록 만든다.
                                if(ptcoupon["managerid"] != "" && ptcoupon["manager"] != "" && ptcoupon["managerid"] == alltraners[c]["mem_uid"]){
                                    selected = "selected";
                                }
                                option += "<option value='" + alltraners[c]["mem_uid"] + "' data-image='" +alltraners[c]["mem_photo"] + "' "+selected+">" + alltraners[c]["mem_username"] + "</option>";
                            } 

                            var btn_txt = "변경";
                            var btn_color = "blue";
                            //현재상황 ex)문자/전화 데이타가 있어야 트레이너를 변경할 수 없도록 만든다.
                            //if(!isfreeuser && ptcoupon["managerid"] != "" && ptcoupon["manager"] != "" || isfreeuser && ptcoupon["managerid"] != "" && ptcoupon["manager"] != "" && ptcoupon["userstatus"] != "" ){
                            if(!isfreeuser && ptcoupon["managerid"] != "" && ptcoupon["manager"] != ""){
                                option = "<option value='"+ptcoupon["managerid"]+"'>"+ptcoupon["manager"]+"</option>";   
        //                        btn_txt = "완료";
                                btn_color = "#990000";
                            } 
                            if(isfreeuser && ptcoupon["managerid"] != "" && ptcoupon["manager"] != "" && ptcoupon["userstatus"] != "" ){
                                btn_color = "#990000";
                            }

                            var selected_traner = null;
                            var ornerstatus = 0;
                            var hide_tag = "";
                            for (var c = 0; c < alltraners.length; c++){
                                 if(alltraners[c]["mem_uid"] == ptcoupon["managerid"]){
                                     selected_traner = alltraners[c];
                                     hide_tag = "<text id = 'hide_txt' style='display:none'>_"+alltraners[c]["mem_username"]+"</text>"
                                     break;
                                 }
                            }
                            var select_tag = hide_tag+"<select class='form-control' id='teachers_list_"+i+"' name='teachers_list_"+i+"' >"+option+"</select>";
                            insertOTCell(brow,isfreeuser,select_tag,null,"100px");




                            ///////////////////////////////////////////////
                            //진행상황
                            ///////////////////////////////////////////////
                            if(selected_traner){
                                var teacher_reservation = JSON.parse(selected_traner["mem_teacher_reservation"]);
                                for(var d = 0 ; d < teacher_reservation.length; d++){
                                    if(teacher_reservation[d].centercode == centercode){
                                        var members = teacher_reservation[d]["myusers"];
                                        if(members){
                                            for(var e = 0 ;e < members.length; e++){
                                                if(members[e]["uid"] == useruid){
                                                    ornerstatus = parseInt(members[e]["ornerstatus"]);        
                                                    break;
                                                }
                                            }    
                                        }

                                    }
                                }
                            }
                            //유료PT 회원은 트레이너를 지정만 할 수 있게 한다.
                            var status = isfreeuser ? ["1.트레이너 지정", "2.PT진행중","3.PT모두종료"] : ["1.트레이너 지정"] ;
                            var option = "<option value=''>== 상태값 ==</option>";
                            for (var c = 1; c <= status.length; c++) 
                                option += "<option value='" + c+ "'>" + status[c-1] + "</option>"; 

                            if(ornerstatus == 1){
                                option = "<option value='1'>1.트레이너 지정</option>";
                                for (var c = 2; c <= status.length; c++) 
                                    option += "<option value='" + c+ "'>" + status[c-1] + "</option>"; 
                            }else if(ornerstatus == 2){
                                option = "<option value='2'>2.PT진행중</option>";
                                for (var c = 3; c <= status.length; c++) 
                                    option += "<option value='" + c+ "'>" + status[c-1] + "</option>"; 
                            }
                            else if(ornerstatus == 3){
                                option = "<option value=''>☆종료대기중 ==</option>";
                                if(isfreeuser)option += "<option value='3'>3.PT모두종료</option>";
                            }
                            else if(allfinish){
                                if(isfreeuser)option = "<option value='3'>3.PT모두종료</option>";
                            }
    //                        clog("ptcoupon ",ptcoupon);
                            var status_tag = "<select class='form-control'  id ='orner_status_"+i+"'>"+option+"</select>";
                            insertOTCell(brow,isfreeuser,status_tag,null,"160px"); 


                            ///////////////////////////////////////////////
                            //상태변경하기 버튼
                            ///////////////////////////////////////////////
                            var couponid = ptcoupon["id"];
                            var btn_tag = "<button onclick='setTraner("+i+", \""+useruid+"\", \""+userid+"\", \""+username+"\", \""+userphone+"\" , \""+couponid+"\" , \""+before_managerid+"\" , \""+before_managername+"\" )' class='btn btn-primary btn-raised' style='border:0px;width:60px; height:35px;font-size:14px; color:#ffffff; text-align:center; font-weight:700;background-color:"+btn_color+"'>"+btn_txt+"</button>";
                            insertOTCell(brow,isfreeuser,btn_tag);
                        }
                    
                    }

                }
            }
        }
        $('#dataTable').DataTable();
    }
    function setTraner(i,user_uid, user_id, user_name, user_phone,couponid,before_managerid,before_managername){
        
        var teacher = document.getElementById("teachers_list_"+i);
        var teacher_uid = teacher.value;  //teacher.value = teacher_uid 이다.
        
        var orner_status = document.getElementById("orner_status_"+i);
        var orner_status_value = orner_status.value;  //teacher.value = teacher_uid 이다.
        
       
             
        
        if(teacher_uid && orner_status_value){

            var title = "트레이너 설정";
            var teachername = teacher.options[teacher.selectedIndex].text;
            var orner_status_text = orner_status.options[orner_status.selectedIndex].text;
           
            var msg = teachername+" 트레이너 설정값("+orner_status_text+")로 설정하시겠습니까? ";
             
            //트레이너로 설정할까요? 팝업 띄운다.    
            showModalDialog(document.body, title, msg, "설정하기", "취소", function () {
                 
                
                if(parseInt(orner_status_value) == 0){
                    alertMsg("트레이너 상태값을 설정해 주세요.");
                    return;
                }
                var groupcode = getData("nowgroupcode");
                var centercode = getData("nowcentercode");
                //담당트레이너 설정하기
                setPTTraner(user_uid,couponid,teachername, teacher_uid,orner_status_value,before_managerid,before_managername,groupcode,centercode,function(res){
                     var token = res.message;
                     if(res.code == 100){
                         var mtitle = user_name+" 회원이 지정되었습니다.";
                         var mmessage = "고객번호 : "+user_id+", 전화번호 :"+user_phone+"입니다. 일정을 조율후 상태값을 업로드해주세요.";
                         //트레이너 설정 성공하면 담당트레이너에게 푸시메세지 보내기
                         pushmessage_user(token,mtitle,mmessage,ClickAction.SHOW_GOTO_MYUSERS,function(res){
                            if (res.code == 100) {
                                //푸시메세지를 보냈으면 성공팝업띄우고 종료
//                                showModalDialog(document.body, "설정완료", "트레이너를 설정하였습니다.", "확인 ", null, function () {
//                                    hideModalDialog();
//                                    hideModalDialog();
//                                    loadMainDiv(7);
//                                }); 
                                C_showToast( "푸시메세지","담당트레이너에게 푸시메세지를 보냈습니다.", function() {});
                                hideModalDialog();
                               
                            } else {
                                alertMsg(res.message);
                            }
                        },function(err){
                            alertMsg("네트워크 에러 ",err);
                        }); 
                        C_showToast( "성공","트레이너를 설정하였습니다.", function() {});
                        hideModalDialog();
                        
                     }else{
                         alertMsg(res.message);
                     }
                     
                    
                },function(err){
                    hideModalDialog();
                });
                
            }, function (err) {
                
                hideModalDialog();
            });
        }else{
            alertMsg("트레이너선택 과 진행상황을 모두 지정해 주세요.");
        }
    }
//    function getTraners(callback) {
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
//                    callback();
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
    function show_ptusertag(idx){
//        clog("idx "+idx+ " istraner "+istraner);
        var user = null;
        if(nosettingtranerusers)user = nosettingtranerusers[idx]; 
            
        
        var style = {bodycolor:"#e9e9e9",size:{width:"1290px",height:"100%"}};
        
        if(user){
            
             showinfo(user);
        }
        
    }
    function tab_click(idx){
        if(idx == 1){
            istype = "otpaidtype";
            setOTType(istype);
            
//            loadMainDiv(7);
        }else if(idx == 2){
            istype = "otfreetype";
            setOTType(istype);
//            loadMainDiv(7);
        }
        else{
            istype = "otfreefinishtype";
            setOTType(istype);
//            loadMainDiv(7);
            
        }
        insertSettingPTTranerTable(nosettingtranerusers,istype,month);
    }
    function getOTType(){
        var type = "otpaidtype";
        if(getData("setottype"))
            type = getData("setottype");
        return type;        
    }
    
    function setOTType(type){
        saveData("setottype",type);
    }
//    function setOTMonth(month){
//        saveData("setotmonth",month);
//    }
//    function getOTMonth(){
//        var month = "0";
//        if(getData("setotmonth"))
//            month = getData("setotmonth");
//        
//        return month;        
//    }
    function changeOTMonth(){
//        var month = document.getElementById("select_month").value;
//        setOTMonth(month);
//        loadMainDiv(7);
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
        getNoSettingUsersCall(year,month);
        
    }
</script>