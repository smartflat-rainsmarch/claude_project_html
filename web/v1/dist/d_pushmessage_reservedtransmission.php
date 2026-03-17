<style>
/*
        .main_title{
            text-align: center;
        }
*/

        .main_list {
            width: 100%;
        }

        

        .list_detail {
            display: inline-block;
            width: 300px;
            height: auto;
            border: 1px solid;
            border-color : #bbbbbb;
            margin: 17px ;
        }

    
        .autoMaker{
            
            position: absolute; width: 200px;
            height: auto; background: white;
            margin-top: 3px; cursor:pointer;
        }
        .autoMaker > div{
            border : 1px solid #e6e6e6;
            margin-top : 3px;
        }
        .autoMaker > div:hover{
            background : #e6d1ff;
        }		
    
        /*보낼메세지 스크롤바*/
         .search_area {
             width: 250px;
            height: 200px;
            overflow: auto;
          }
          .search_area::-webkit-scrollbar {
            width: 6px;
          }
          .search_area::-webkit-scrollbar-thumb {
            background-color: #d9dde1;
            border-radius: 6px;
            background-clip: padding-box;
/*            border: 2px solid transparent;*/
          }
          .search_area::-webkit-scrollbar-track {
            background-color: #f5f8fa;
            border-radius: 6px;
/*            box-shadow: inset 0px 0px 5px white;*/
          }
            
    </style>

<br> 

<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
    <div class="reservation_center" style='padding:5px'>
        <div style="width:100%;height:60px;">
            <span><text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >메세지 예약전송하기</text><img src='./img/icon_tip.png' style='margin-top:15px;margin-left:15px'/>
                <label style='margin-top:13px;font-size: 15px;color:#3f4254;text-align:left;font-weight:500;'> <span style='color:#009ef7'>회원 : </span> 앱 설치후 최소1번이상 로그인한 회원, &nbsp;&nbsp;&nbsp;&nbsp; <span style='color:#009ef7'>비회원 : </span>  앱설치후 로그인을 1번도 안한 회원, 그밖의 비회원 <br><span style='font-size:14px;color:#f1416c'>※메세지 전송방법이 <span style='color:#009ef7'>'자동전송'</span>일때는 회원은 앱푸시로, 비회원은 문자로 전송됩니다.  <span style='color:#009ef7'>'모두문자로 전송'</span> 일때는 회원 비회원 모두 문자로 전송됩니다.</span></label>
            </span>
            <span style="float:right"><button class='btn btn-primary btn-raised'  onclick="insert_reservation_message()" style="margin-top:5px;font-size: 14px; color:#ffffff;text-align:center;font-weight:700;padding:10px 20px 10px 20px ;">+ 메세지 삽입</button></span>
        </div>
        <hr style="border: solid 1px #eff2f5;margin-top:0px;margin-left:-28px;margin-right:-28px;">

        
        <div class = 'form-control' style='margin-top:24px;background-color:#f1faff;height:90px;;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding-left:20px;padding-right:20px;padding:20px'>
            
        
            <img src="./img/icon_reservedword.png" style='position:absolute;margin-top:10px;'>
            <div style='position:absolute;width:1100px;height:auto;margin-left:50px'>
                <text style='font-size:16px; color:#181c32;text-align:left; font-weight:700;'>예약어 목록</text> <text style='font-size: 14px; color:#3f4254;text-align:left;font-weight:400;'>&nbsp;&nbsp;타이틀, 보낼메세지에서 <span style="font-weight:700">예약어</span>를 사용할 수 있습니다. <span style="font-weight:700">예약어</span>를 사용하면 해당 고객 정보로 자동으로 치환됩니다.</text><br>
               <text style='font-size: 14px; color:#5e6278;text-align:left;font-weight:700;'> #{이름} , #{고객번호} , #{생일}  , #{라커번호} , #{라커비번} , #{라커종료일} , #{시작일} , #{종료일} </text>
            </div>
            
        </div>
     </div>      
</div>


<br>
<div >
    <div class="main_list">
        <!-- 상단 제목 -->
<!--
        <div class="main_title">
            <p>DIV 영역을 나눠보자.</p>
        </div>
-->
        <!-- 리스트 -->
        <div id="container" class="list_start">
            
        </div>
        <!-- 하단 리스트 번호 -->
<!--
        <div class="paging_start">
            <div>1 2 3 4 5 </div>
        </div>
-->
	</div>
</div>
<br>  
  
<script>
    var group = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    var centername = getData("nowcentername");
    
    var nosettingtranerusers = null;
    
    
    var making_message_json = {};
    function init_d_pushmessage_reservedtransmission(){
        loadAllMessage();
        clog("reservation push sms");
    }
    function loadAllMessage(){
        
        getRPushMessages(function(res){
            clog("getRPushMessages res is ",res);
            if(res == "error"){
                alertMsg("네트워크 에러");
            }else{
                var code = parseInt(res.code);
                if (code == 100) {
                    if(res.message){
                        var container = document.getElementById("container");
                        if(container)container.innerHTML = "";
                        setAllMessages();
                    }
                }else{
                    alertMsg("데이타를 가져오지 못하였습니다. 다시 시도하여 주세요");
                }
            }        
        });
    }
    function insert_reservation_message(id){
        var title = "메세지 그룹 생성하기";
        var today = getToday();
        var iscreate = id ? false : true;
        
        
        //현재시간 분까지 
        var startdatetime = getNowDateTime();
        
        var json = {};
        //json.id = random_string(8)+"_"+today;
        json.id = "";
        json.messagetype = "app_phone"; //app : SMS/LMS/MMS , phone: 앱 푸시 , app_phone : SMS/LMS/MMS + 앱 푸시;
        json.startday = startdatetime;
        json.repeattype = "repeat_zero";
        json.sendtype = "data_all_member";
        json.issended = "sended"; //"ready : 아직안보냄 ,  sended : 보내짐
        json.starttime =  getToday();
        json.endtime =  getToday();
        json.name = "";
        json.title = "";
        json.message = "";
        json.phones = "";
        
        var btn_txt = "수정하기";
        //아이디 생성
        if(!id)id = randomString(8)+"_"+today;
        else {
            if(allmessages)
            for(var i = 0; i < allmessages.length; i++){
                if(allmessages[i].id == id){
                    json = allmessages[i];
                    break;
                }
            }
        }
        json.message = replaceBRToEnter(json.message);
        if(json.id == ""){
            json.id = random_string(8)+"_"+today;
            btn_txt = "만들기";
        }
        var isexcel = json.sendtype == "data_excel_phone_member" ? true : false;
        var isshowexcel = isexcel ? "block" : "none"; //엑셀 태그 보여주기
        var phones_len = json.phones ? json.phones.split(',').length : 0;
        
        var byte_len = json.message.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length;
        var sms_lms = byte_len < 90 ? "SMS" : "<text style='color:red;font-weight:bold'>LMS</text>";
        var txt_byte = json.message.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length+" Byte / "+sms_lms;
        /////////////////////////////////
        //repet option
        /////////////////////////////////
        var repeat_arr = [{"value":"repeat_zero","txt":"1번만 보내기"},{"value":"repeat_1day","txt":"매일 보내기"},{"value":"repeat_1week","txt":"매주 보내기"},{"value":"repeat_2week","txt":"2주마다 보내기"},{"value":"repeat_3week","txt":"3주마다 보내기"},{"value":"repeat_month","txt":"매달 보내기"},{"value":"repeat_year","txt":"매년마다 보내기"}];
        var repeat_option_tag = "";
        for(var i = 0 ; i  < repeat_arr.length; i++){
            var selected = repeat_arr[i].value == json.repeattype ? "selected" : "";
            repeat_option_tag +=  "<option value ='"+repeat_arr[i].value+"' "+selected+">"+repeat_arr[i].txt+"</option>";
        }
        
        /////////////////////////////////
        //sendtype option
        /////////////////////////////////
        var sendtype_arr = [{"value":"data_all_member","txt":"전체회원"},{"value":"data_paid_member","txt":"유효회원"},{"value":"data_end_member","txt":"수강종료예정자"},{"value":"data_out_member","txt":"수강종료후미등록자"},{"value":"data_today_member","txt":"입실자목록"},{"value":"data_delay_member","txt":"수강연기자목록"},{"value":"data_notinstall_member","txt":"앱미설치고객목록"},{"value":"data_locker_all_member","txt":"전체라커고객"},{"value":"data_locker_over_member","txt":"라커기간만료"},{"value":"data_locker_limit_member","txt":"라커기간임박(0~14일)"},{"value":"data_excel_phone_member","txt":"엑셀폰번호목록"}];
        var sendtype_option_tag = "";
        var sendtype_disabled = "";
        for(var i = 0 ; i  < sendtype_arr.length; i++){
            var selected = sendtype_arr[i].value == json.sendtype ? "selected" : "";
//            sendtype_disabled = selected == "selected" && json.sendtype == "data_excel_phone_member" ? "disabled" : "";
            sendtype_option_tag +=  "<option value ='"+sendtype_arr[i].value+"' "+selected+">"+sendtype_arr[i].txt+"</option>";
        }
        
        /////////////////////////////////
        //messagetype option
        /////////////////////////////////
        var messagetype_arr = json.sendtype == "data_excel_phone_member" ? [{"value":"phone","txt":"비회원만 문자전송"},{"value":"all_phone","txt":"모두문자로 전송"}] : [{"value":"app_phone","txt":"자동전송"},{"value":"app","txt":"회원만 앱푸시로 전송"},{"value":"phone","txt":"비회원만 문자전송"},{"value":"all_phone","txt":"모두문자로 전송"}];
        var messagetype_option_tag = "";
        for(var i = 0 ; i  < messagetype_arr.length; i++){
            var selected = messagetype_arr[i].value == json.messagetype ? "selected" : "";
            messagetype_option_tag +=  "<option value ='"+messagetype_arr[i].value+"' "+selected+">"+messagetype_arr[i].txt+"</option>";
        }
        
         clog("ddd");
        /////////////////////////////////
        //issended option
        /////////////////////////////////
        //var issended_arr = iscreate ? [{"value":"ready","txt":"켜짐"}] : [{"value":"ready","txt":"켜짐"},{"value":"sended","txt":"꺼짐"}] ;
        var issended_arr = [{"value":"ready","txt":"켜짐"},{"value":"sended","txt":"꺼짐"}] ;
        var issended_option_tag = "";
        for(var i = 0 ; i  < issended_arr.length; i++){
            var selected = issended_arr[i].value == json.issended ? "selected" : "";
            issended_option_tag +=  "<option value ='"+issended_arr[i].value+"' "+selected+">"+issended_arr[i].txt+"</option>";
        }
        
        
       
        
        var message = "<div >"+
                            "<input id='making_id' value='"+id+"' style='display:none'/>"+
                            "<table style='width:100%'>"+
                                "<tr>"+
                                    "<td colspan='1' >"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>현재상태</label>"+
                                    "</td>"+
                                    "<td colspan='3' >"+
//                                        "<select id='making_issended'  onchange='updatePushMessageTable()' class='form-control'>"+issended_option_tag+"</select>"+
                                        "<select id='making_issended' style='width:100%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px' onchange='updatePushMessageTable()'>"+issended_option_tag+"</select>"+
                                    "</td>"+
                                "</tr>"+    
                                "<tr>"+
                                     "<td colspan='4' >"+
                                        "<hr style='border: solid 1px light-gray;'>"+
                                    "</td>"+
                                "</tr>"+    
                                "<tr>"+                                   
                                    "<td colspan='1' >"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>예약메세지 이름</label>"+
                                    "</td>"+
                                    "<td colspan='3' >"+
//                                        "<input id='making_name' class='form-control' placeholder='메세지를 구분할 수 있는 이름을 입력하세요.....'  value='"+json.name+"' />"+
                                         "<input id='making_name' placeholder='메세지를 구분할 수 있는 이름을 입력하세요.....' value='"+json.name+"'  style='width:100%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px'  />"+
                                    "</td>"+
                                "</tr>"+
            
                                "<tr>"+
                                    "<td colspan='4' >"+
                                        "<hr style='border: solid 1px light-gray;'>"+
                                    "</td>"+
                                "</tr>"+
                               
                                "<tr style='margin-top:300px'>"+
                                    "<td  style='width:25%'>"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>예약날짜</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>반복설정</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>보낼그룹</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>메세지 전송방법</label>"+
                                    "</td>"+
                    
                                "</tr>"+
                               
                                "<tr>"+
                                    "<td >"+
//                                        "<input id='making_startday' type='datetime-local' class='form-control' min='"+getToday()+"'  placeholder='검색기준 시작일을 선택...' value='"+json.startday+"'/>"+
                                        "<input id='making_startday' type='datetime-local' min='"+getToday()+"'  placeholder='검색기준 시작일을 선택...' value='"+json.startday+"' style='width:97%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px'  />"+
                                    "</td>"+
                                   
                                    "<td >"+

                                         "<select id='making_repeat' style='width:97%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px' onchange='updatePushMessageTable()'>"+repeat_option_tag+"</select>"+
                                    "<td >"+

                                         "<select id='making_sendtype' style='width:97%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px' onchange='updatePushMessageTable()'>"+sendtype_option_tag+"</select>"+
                                    "</td>"+
                                      "<td >"+

                                          "<select id='making_messagetype' style='width:97%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px' onchange='updatePushMessageTable(1)' "+sendtype_disabled+" >"+messagetype_option_tag+"</select>"+
                                    "</td>"+
                                "</tr>"+
                                
                                "<tr>"+
                                    "<td colspan='4' >"+
                                        "<div id ='div_making_startend' style='display:none'>"+
                                            "<hr style='border: solid 1px light-gray;'>"+
                                            "<span style='float:left;width:49.8%'><label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>시작일</label></span><span style='float:right;width:49.8%'><label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>종료일</label></span><br>"+
                                            "<span style='float:left;width:49.8%'>"+
//                                                "<input id='making_starttime' type='date' class='form-control'  placeholder='검색기준 시작일을 선택...'  value='"+json.starttime+"'/>"+
                                                "<input id='making_starttime' type='date' placeholder='검색기준 시작일을 선택...' value='"+json.starttime+"' style='width:97%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px'  />"+
                                            "</span>"+
                                            "<span style='float:right;width:49.8%'>"+
//                                                "<input id='making_endtime' type='date'class='form-control'  placeholder='검색기준 종료일을 선택...' value='"+json.endtime+"' />"+
                                                "<input id='making_endtime' type='date' placeholder='검색기준 종료일을 선택...' value='"+json.endtime+"' style='width:97%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px'  />"+
                                            "</span>"+
                                        "</div>"+
                                    "</td>"+
                                "</tr>"+
                                
                               
                                "<tr>"+
                                    "<td colspan='4' >"+
                                        "<hr style='border: solid 1px light-gray;'>"+
                                    "</td>"+
                                "</tr>"+
                                

                                   
                                "<tr><td colspan='4' ><br><br></td></tr>"+
                                
                                "<tr id='div_message_title'>"+
                                    "<td colspan='4' >"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>제목</label><br>"+
                                        "<input id='making_title' placeholder='보낼 메세지 제목을 입력하세요.....' value='"+json.title+"' style='width:100%;height:43px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px;margin-right:10px'  />"+
                                        "<div class ='autoMaker' id='mautomessage_title' ></div>"+
                                    "</td>"+
                                    
                                    
                                "</tr>"+
                                
                                "<tr><td colspan='4' ><br></td></tr>"+
            
                                "<tr>"+
                                    
                                    "<td colspan='4' >"+
                                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>내용</label><text id='mtext_notuse_' style='margin-top:8px;float:right;font-size:14px;color:red;visibility:visible'></text>"+
                                    "</td>"+
                                    
                                    
                                "<tr>"+
                                    
                                    "<td colspan='4' >"+
//                                        "<textarea id='making_message' class='search_area' placeholder='보낼 메세지 내용을 입력하세요.....' style='width:100%;height:200px;' value='"+json.message+"'  onkeyup='updateMessageByte()' autocomplete='off'    >"+json.message+"</textarea>"+
                                        "<textarea class='search_area'  id='making_message'   placeholder='보낼 메세지 내용을 입력하세요.....' style='width:100%;height:200px;background-color:#f5f8fa;border:0px;border-radius:5px;font-size: 13px;font-family:Gulim;color:#000000;text-align:left; font-weight:600;padding:15px' value='"+json.message+"'onkeyup='updateMessageByte()' autocomplete='off'    >"+json.message+"</textarea><br>"+
            
                                        "<div class ='autoMaker' id='mautomessage_message' ></div>"+
                                        "<text id='making_byte' style='float:right;font-size: 13px; color:#181c32;text-align:right; font-weight:400;' >"+txt_byte+"</text>"+
                                        "<div id='making_excel_btn' align='left' style='display:none'><br><br>"+
                                            "<div style='background-color:#f1faff;height:50px;;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:5px 0 0 25px'>"+
                                                "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>전화번호가 있는 엑셀파일을 선택해 주세요.&nbsp;<span style='color:#f4436d'>[문자메세지를 전송합니다.]</span></label>"+
                                            "</div><br>"+
                                        "<input id='inputfile' type='file' onchange='readExcel(\"making_phones\",\"making_phones_count\",\"\")'></div>"+
                                    "</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td colspan='4' >"+
                                        "<div id='excel_title' style='width:100%;display:"+isshowexcel+"'>"+
                                            "<label for='authlevel' class='textevent'>전화번호목록</label>"+
                                        "</div>"+
                                    "</td>"+

                                "</tr>"+
                                "<tr>"+
                                    "<td colspan='4' >"+
                                        "<div id='excel_message' style='width:100%;display:"+isshowexcel+"'>"+
                                            "<textarea id='making_phones' class='search_area' placeholder='엑셀파일에서 불러온 전화번호 목록.....'  style='width:100%;height:200px;background-color:#f5f8fa;border:0px;border-radius:5px;font-size: 13px;font-family:Gulim;color:#000000;text-align:left; font-weight:600;padding-left:15px;padding:15px' vaue='"+json.phones+"'>"+json.phones+"</textarea>"+
                                            "<text id='making_phones_count' style='float:right;font-size: 13px; color:#007bff;text-align:right; font-weight:400;' >"+phones_len+" 개 번호</text>"+
                                       "</div>"+
                                    "</td>"+                                        
                                "</tr>"+
                            "</table>"+
                        "</div>"+
                        "<br>"+
                        "<hr style='border: solid 1px light-gray;'>"+
                        "<br>";
        
        
         var style = {
//                bodycolor: "#eeeeee",
                size: {
                    width: "50%",
                    height: "100%"
                }
            };
        
        showModalDialog(document.body, title, message, btn_txt, "취소", function() {
            var container = document.getElementById("container");
            making_message_json = getJsonReservationPushMessage();
            var isin = false;
            for(var i = 0 ; i < allmessages.length; i++){
                if(allmessages[i].id == making_message_json.id){
                    isin = true;
                    allmessages[i] = making_message_json;
                    break;
                }
            }
            if(!isin)
                allmessages.push(making_message_json);
            
            if(allmessages.length > 0)
                savePushMessages(true);

                        
            hideModalDialog();

//            clog("allmessages ",allmessages);
        }, function() {
            hideModalDialog();
        },style);
        
        guideon();
    }
    function updateMessageByte(id){
        if(id){
            var making_message = document.getElementById("mmessage_"+id);
            var making_byte = document.getElementById("mbyte_"+id);
            
            var byte_len = making_message.value.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length;
            var sms_lms = byte_len < 90 ? "SMS" : "<text style='color:red;font-weight:bold'>LMS</text>";
            var txt_byte = byte_len+" Byte / "+sms_lms;
            making_byte.innerHTML = txt_byte; 
            editing_check(id);
        }else{
            var making_message = document.getElementById("making_message");
            var making_byte = document.getElementById("making_byte");
            var byte_len = making_message.value.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length;
            var sms_lms = byte_len < 90 ? "SMS" : "<text style='color:red;font-weight:bold'>LMS</text>";
            var txt_byte = byte_len+" Byte / "+sms_lms;
            making_byte.innerHTML = txt_byte;    
        }
        
        
    }
    var all_rows = []; //엑셀 rows
    //비회원 전화번호 목록 불러오기
    function readExcel(excel_id,excelcount_id,id) {
        var making_messagetype_value = id ? document.getElementById("mmessagetype_"+id).value : document.getElementById("making_messagetype").value;
       
        
        let input = event.target;
        let reader = new FileReader();
        C_ShowLoadingProgress();

        reader.onload = function() {
            let data = reader.result;
            let workBook = XLSX.read(data, {
                type: 'binary'
            });
            all_rows = [];
            workBook.SheetNames.forEach(function(sheetName) {
//                    clog('SheetName: ' + sheetName);
                C_HideLoadingProgress();
                let rows = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName]);
//                    clog(JSON.stringify(rows));

                //jsondata
                clog("rows is ", rows);

                if (rows.length > 0) {
                    var doc_key = document.getElementById(excel_id);                            
                    var numcnt = document.getElementById(excelcount_id);
                    var mtext_note = document.getElementById("mtext_notuse_"+id);
                    all_rows = rows;
                    if(document.getElementById("excel_title"))document.getElementById("excel_title").style.display = "block";
                    if(document.getElementById("excel_message"))document.getElementById("excel_message").style.display = "block";

                    var str_phonenumbers = "";
                    var phonenumbers = [];
                    for (var key in rows[0]) {
//                            clog("rows[0] is ",rows[0]);
//                             clog("key is ",key);
                        var value = rows[0].key;
                        //key 가 전화번호인지 : 즉 모든 셀이 전화번호일 수 있음
                        if(keyIsPhoneNumber(key)){
                            str_phonenumbers += ""+key;
                            phonenumbers.push(key);
                        }

                        if(isPhoneKey(rows,key)){

                            var phonenumbers = insert_phonenumbers(key);

                            for(var i = 0 ; i < phonenumbers.length; i++)
                                str_phonenumbers = str_phonenumbers == ""  ? phonenumbers[i] : str_phonenumbers+","+phonenumbers[i];

                            break;
                        }

                    }
                    checkUseReservedWord(str_phonenumbers,function(res){

                        var code = parseInt(res.code);
                        if(code == 100){
                            mtext_note.style.color = "blue";
                            mtext_note.innerHTML = "※예약어 사용가능";
                        }else {
                            mtext_note.style.color = "red";
                            mtext_note.innerHTML = "※예약어 사용불가";
                        }

                        clog("checkUseReservedWord success",res);
                        var phones_arr = str_phonenumbers.split(",");
                        doc_key.value = str_phonenumbers;
                        if(numcnt) numcnt.innerHTML = "현재 "+phones_arr.length+"개 번호";                            
                    },function(err){
                        clog("checkUseReservedWord err",er);
                    });

                    //테이블 보여주기
//                      insert_doc_table(all_rows);


                }else {
                    alertMsg("엑셀파일에 번호가 없거나 전화번호가 1개라면 제목(전화번호)이 없을 수 있습니다. 제목을 적어주세요");
                }
                
                
                

            })
        };
        if(reader)reader.readAsBinaryString(input.files[0]);
        
         var inputfile = id ? document.getElementById("minputfile_"+id) : document.getElementById("inputfile");
        inputfile.value = "";
                

    }
    function checkUseReservedWord(str_phones,success,error){

    
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");

        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"isallcenteruserphones",
            value : str_phones

        };
        CallHandler("adm_get", senddata, function (res) {
           if(success)success(res);

        }, function (err) {if(error)error(err);});
         

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
    //key도 전화번호인지 체크  즉 키가없는 모든 셀이 전화번호일 수 있다.
    function keyIsPhoneNumber(str){
        var flg = false;
        if(!isNaN(str))  //숫자로만 되어있는지 체크
        if(str.length == 10 || str.length == 11){
            if(str.substr(0,3) == "010")
                flg = true;
        }
        return flg;
    }
    function isPhoneKey(rows,key){
        var phonenumbers = [];
        var phone_010count = 0;
        var len = all_rows.length < 10 ? all_rows.length : 10;
        var flg = false;
        if(len > 0){
            for(var i = 0 ; i < len; i++){
                if(all_rows[i][key] && all_rows[i][key].indexOf("010") >= 0)phone_010count++;
            }
            if(len < 10 && phone_010count > 0)
                flg = true;
            else if(len >= 10 && phone_010count > 5)
                flg = true;
            else 
                flg = false;
            
        }else {
            return flg;
        }
        return flg;
        
    }
    function insert_phonenumbers(key){
        var phonenumbers = [];
        for(var i = 0 ; i < all_rows.length; i++){
            
            if(all_rows[i][key]){
                var number = all_rows[i][key].replace(/[^0-9]/g,'');
                phonenumbers.push(number);
            }
        }
//        clog("phonenumbers ",phonenumbers);
//        var str_phonenumbers = "";
//        for(var i = 0 ; i < phonenumbers.length; i++){
//            str_phonenumbers = i == 0  ? phonenumbers[i] : str_phonenumbers+","+phonenumbers[i];
//        }
        return phonenumbers;
    }
    function savePushMessages(isshowToast){

        saveAllPushMessages(function(res){
           if(res.code == 100){
               
               hideModalDialog();
               if(isshowToast)C_showToast( "내용", "예약 메세지를 설정하였습니다. ", function() {});
               setAllMessages();
           }else{
               alertMsg("예약 메세지를 설정중 에러발생 : "+res.message);
           }
        });
    }
    function setAllMessages(){
        var container = document.getElementById("container");
        container.innerHTML = "";
        
        getMessageUsersCount(function(res){
            
            var code = parseInt(res.code);
            if (code == 100) {
                var countmessages = res.message;
                clog("getMessageUsersCount ",res);
                for(var i = 0 ; i < allmessages.length; i++){
                    for(var j = 0 ; j < countmessages.length; j++){
//                        array("id"=>$sendid,"smscount"=>0,"pushcount"=>0);
                        if(countmessages[j].id == allmessages[i].id){
                            var sms_len = countmessages[j].smscount;
                            var lms_len = countmessages[j].smscount;
                            var push_len = countmessages[j].pushcount;
                            var byte_len = allmessages[i].message.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length;
                            if(byte_len < 90)lms_len = 0;
                            else sms_len = 0;
                            
                            allmessages[i].sms_len = sms_len;
                            allmessages[i].lms_len = lms_len;
                            allmessages[i].push_len = push_len;
                            createMessageTable(container,allmessages[i]); 
                            break;
                        }
                    }
                }
                guideon();
            
            }
            
            
        });
        
        
    }
    function displayMessage(container,json,i){
        getMessageUsersCount(function(res){
             if(res){
                  var code = parseInt(res.code);
                  if (code == 100) {
                        var sms_users = res.sms_users;
                        var push_users = res.push_users;
                        var byte_len = json.message.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length;
                        var issms = byte_len < 90 ? true : false;

                        var sms_len = sms_users && issms ? sms_users.length : 0;
                        var lms_len = sms_users && !issms ? sms_users.length : 0;
                        var push_len = push_users ? push_users.length : 0;  
                      
                        json.sms_len = sms_len;
                        json.lms_len = lms_len;
                        json.push_len = push_len;
                        allmessages[i] = json;
                      
                        createMessageTable(container,json);    
                  }   
             }
              
        });
    }
    function createMessageTable(parent,json){
        clog("createMessageTable json is ",json.message);
        var id = json.id;
        
        json.message = json.message.replaceAll("<br>", "\r\n");
//        var repeat_txt = {"repeat_zero":"1번만 보내기",
//                         "repeat_1day":"매일 보내기",
//                          "repeat_1week":"매주 보내기",
//                          "repeat_2week":"2주마다 보내기",
//                          "repeat_3week":"3주마다 보내기",
//                          "repeat_month":"매달 보내기",
//                          "repeat_year":"1년마다 보내기"};
//        
//        var sendtype_txt = {"data_all_member":"전체회원",
//                            "data_paid_member":"유효회원",
//                            "data_end_member":"수강종료예정자",
//                            "data_out_member":"수강종료후미등록자",
//                            "data_today_member":"입실자목록",
//                            "data_delay_member":"수강연기자목록"};
//        
//        var isfix_txt = {"not_fixed":"1회용","fixed":"계속고정"};
//        
//        var start_end_tag =  json.sendtype == "data_all_member" ? "" : "<label class='form-control'>기간 : "+json.starttime+"~"+json.endtime+"</label>"; // "● 시작일 : <input id='mstarttime_"+id+"' style='float:right;width:60%;' type='date' value='"+json.starttime+"' disabled/><br><br>"+
//                       // "● 종료일 : <input id='mendtime_"+id+"' style='float:right;width:60%;' type='date' value='"+json.endtime+"' disabled/><br><br>";
//        
        
        
        
        /////////////////////////////////
        //repet option
        /////////////////////////////////
        var repeat_arr = [{"value":"repeat_zero","txt":"1번만 보내기"},{"value":"repeat_1day","txt":"매일 보내기"},{"value":"repeat_1week","txt":"매주 보내기"},{"value":"repeat_2week","txt":"2주마다 보내기"},{"value":"repeat_3week","txt":"3주마다 보내기"},{"value":"repeat_month","txt":"매달 보내기"},{"value":"repeat_year","txt":"매년마다 보내기"}];
        var repeat_option_tag = "";
        for(var i = 0 ; i  < repeat_arr.length; i++){
            var selected = repeat_arr[i].value == json.repeattype ? "selected" : "";
            repeat_option_tag +=  "<option value ='"+repeat_arr[i].value+"' "+selected+">"+repeat_arr[i].txt+"</option>";
        }
        
        /////////////////////////////////
        //sendtype option
        /////////////////////////////////
        var sendtype_arr = [{"value":"data_all_member","txt":"전체회원"},{"value":"data_paid_member","txt":"유효회원"},{"value":"data_end_member","txt":"수강종료예정자"},{"value":"data_out_member","txt":"수강종료후미등록자"},{"value":"data_today_member","txt":"입실자목록"},{"value":"data_delay_member","txt":"수강연기자목록"},{"value":"data_notinstall_member","txt":"앱미설치고객목록"},{"value":"data_locker_all_member","txt":"전체라커고객"},{"value":"data_locker_over_member","txt":"라커기간만료"},{"value":"data_locker_limit_member","txt":"라커기간임박(0~14일)"},{"value":"data_excel_phone_member","txt":"엑셀폰번호목록"}];
        var sendtype_option_tag = "";
        for(var i = 0 ; i  < sendtype_arr.length; i++){
            var selected = sendtype_arr[i].value == json.sendtype ? "selected" : "";
            sendtype_option_tag +=  "<option value ='"+sendtype_arr[i].value+"' "+selected+">"+sendtype_arr[i].txt+"</option>";
        }
        

        /////////////////////////////////
        //messagetype option
        /////////////////////////////////
        var messagetype_arr =  json.sendtype == "data_excel_phone_member" ? [{"value":"phone","txt":"비회원만 문자전송"},{"value":"all_phone","txt":"모두문자로 전송"}] : [{"value":"app_phone","txt":"자동전송"},{"value":"app","txt":"회원만 앱푸시로 전송"},{"value":"phone","txt":"비회원만 문자전송"},{"value":"all_phone","txt":"모두문자로 전송"}];
        var messagetype_option_tag = "";
        for(var i = 0 ; i  < messagetype_arr.length; i++){
            var selected = messagetype_arr[i].value == json.messagetype ? "selected" : "";
            messagetype_option_tag +=  "<option value ='"+messagetype_arr[i].value+"' "+selected+">"+messagetype_arr[i].txt+"</option>";
        }
        
        var isshow_startend = json.sendtype == "data_all_member" ||   json.sendtype == "data_locker_all_member" ||   json.sendtype == "data_locker_over_member" ||   json.sendtype == "data_locker_limit_member"  ||   json.sendtype == "data_excel_phone_member" ? "none" : "block";
        var isshow_title = json.messagetype == "phone" || json.messagetype == "all_phone" ? "none" : "block";
        
        var byte_len = json.message.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length;
        var sms_lms = byte_len < 90 ? "<span style='color:#f1416c;font-weight:700'>SMS</span>" : "<span style='color:#f1416c;font-weight:700'>LMS</span>";
        var txt_byte = json.message.replace(/[\0-\x7f]|([0-\u07ff]|(.))/g,"$&$1$2").length+" Byte / "+sms_lms;
        
        
        var tag_issended = "<text id='missended_"+id+"' style='color:blue;float:left' >켜짐</text>"
        var ison = "checked";
        var txt_onoff = "켜짐";
        var toggle_color = "blue";
        var bgcolor = "#ffffdd";
        //OFF 이미보냈다면
        if(json.issended && json.issended == "sended")
        { 
            tag_issended = "<text id='missended_"+id+"' style='color:red;float:left' >꺼짐</text>";
            ison = "";
            txt_onoff = "꺼짐";
            toggle_color = "gray";
            bgcolor = "#ffffff";
        }
        var phones = json.phones ? json.phones.split(',') : [];
        var txt_excel_count = phones.length;
        var isshowexceltag = phones.length ? "block" : "none";
        var isshowexcelvisible = phones.length ? "visible" : "hidden";
        //엑셀파일 전화번호들
        //var messagetype_disabled =  json.sendtype == "data_excel_phone_member" ? "disabled" : "";
        var messagetype_disabled =  "";
        
        var txt_sms = json.sms_len > 0 ? "SMS("+json.sms_len+")":"";
        var txt_lms = json.lms_len > 0 ? "LMS("+json.lms_len+")":"";
        var txt_push = json.push_len > 0 ? "푸시("+json.push_len+")":"";
        var txt_totalprice = ""+TXT_WON+CommaString(json.sms_len * global_sms_sendprice + json.lms_len * global_lms_sendprice + json.push_len * global_push_sendprice);
        var txt_count_price = txt_lms || txt_sms ? ""+txt_sms+txt_lms+" + "+txt_push : ""+txt_push ;
        if(!txt_push)txt_count_price = ""+txt_sms+txt_lms;
        
//        //푸시만 표현
//        if(json.messagetype == "app" ){
//            txt_count_price = txt_push;
//            txt_totalprice = "￦"+CommaString(json.push_len * global_push_sendprice);            
//        }
//        //비회원 문자만표현
//        else if(json.messagetype == "phone"){
//            txt_count_price = txt_sms+txt_lms;
//            txt_totalprice = "￦"+CommaString(json.sms_len * global_sms_sendprice + json.lms_len * global_lms_sendprice); 
//        }
//        //모두문자로 보내기
//        else if(json.messagetype == "all_phone"){
//            txt_count_price = txt_sms ? "SMS("+(json.sms_len+json.push_len)+")" : "LMS("+(json.sms_len+json.push_len)+")";
//            txt_totalprice = txt_sms ? "￦"+CommaString(global_sms_sendprice * (json.sms_len + json.push_len)) :  "￦"+CommaString(global_lms_sendprice * (json.lms_len + json.push_len)); 
//        }
            
        
        var tag = "<div class='list_detail' id='mdiv_"+id+"' style='padding:15px;width:280px;height:auto;border-radius:10px;box-shadow: 0px 5px 10px 0px rgba(0, 0, 0, 0.05);background-color:"+bgcolor+";border:0px;' >"+
                        "<input id='mid_"+id+"' value='"+id+"' style='display:none'/>"+
                        "<div style='height:30px;padding:10px;'>"+
                            "<i class='fa-solid fa-pen' onclick='message_edit(\""+json.id+"\")' title='메세지그룹 전체 수정하기'style='float:left;color:#a1a5b7;'></i>"+
                            "<i class='fa-solid fa-trash' onclick='message_delete(\""+json.id+"\")' title='메세지그룹 삭제하기' style='float:right;color:#a1a5b7;'></i>"+
                            "<i class='fa-solid fa-check' id='miconsave_"+json.id+"' onclick='message_save(\""+json.id+"\")' title='수정한 메세지그룹 저장하기' style='font-size:24px;float:right;color:#a1a5b7;display:none;margin-right:16px;display:none;margin-top:-5px' ></i>"+
                                
                        "</div>"+
                        "<hr style='border: solid 1px light-gray;'>"+
                        "<div style='width:250px; height:35px;border-radius:5px;background-color:#e8fff3;'>"+
                            "<label id='mtext_smspush_"+id+"' style='font-size: 14px; color:#a1a5b7;text-align:left;font-weight:700;margin-left:15px;margin-top:7px'>"+txt_count_price+"</label>"+
                            "<label id='mprice_smspush_"+id+"'  style='float:right;font-size: 14px; color:#181c32;text-align:left;font-weight:600;margin-right:15px;margin-top:7px'>"+txt_totalprice+"</label>"+
                        "</div>"+
                        "<div style='width:100%;float:right'>"+
                            "<text id='toggle_txt_"+id+"'style='float:left;font-size: 14px; color:#181c32;text-align:left;font-weight:500;margin-top:13px;color:"+toggle_color+"'>&nbsp;"+txt_onoff+"</text>"+
                            "<text id='toggle_title_"+id+"' style='float:right;font-size:18px;font-weight:bold;margin-top:13px;color:"+toggle_color+"'></text>"+
                            "<label class='switch' style='float:right;margin-top:10px'>"+
                                "<input id='toggle_"+id+"' type='checkbox' onchange='messagetogglechange( \""+id+"\")'  style='color:"+toggle_color+"' "+ison+"><span class='slider round'></span>"+
                            "</label>"+
                           
                        "</div>"+
                        
                       "<hr style='border: solid 1px light-gray;margin-top:50px;'>"+
                        "<label id='mname_"+id+"' style='width:250px;height:35px;background-color:#ffd6a9;border-radius:5px;float:left;padding:5px 15px;font-size: 16px; color:#543615;text-align:left;font-weight:500;' value='"+json.name+"' >"+json.name+"</label>"+
                        "<br>"+
            
                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>메세지 전송방법</label><br>"+
                        "<select id='mmessagetype_"+id+"' style='width:248px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px' onchange='editing_check(\""+json.id+"\")' "+messagetype_disabled+">"+messagetype_option_tag+"</select><br>"+
                       
                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>예약날짜</label><br>"+
                        "<input id='mstartday_"+id+"' type='datetime-local' style='width:248px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px' value='"+json.startday+"' onchange='editing_check(\""+json.id+"\")' /><br>"+
                        
                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>반복</label><br>"+
                        "<select id='mrepeat_"+id+"' style='width:248px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px' onchange='editing_check(\""+json.id+"\")' >"+repeat_option_tag+"</select><br><br>"+
                        
                        "<div class='form-control' style='background-color:#f1faff;height:140px;;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:8px'>"+
                            "<label style='font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>그룹</label><br>"+
                            "<select id='msendtype_"+id+"' style='margin-top:-5px;width:228px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px' onchange='change_frontgroup(\""+json.id+"\")'>"+sendtype_option_tag+"</select><br>"+
                            "<div id='div_startend_"+id+"' style='display:"+isshow_startend+"'>"+
                                "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>기간</label><br>"+
                                "<input id='mstarttime_"+id+"' style='margin-top:-5px;width:105px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px;color:#5e626e;text-align:left; font-weight:600;' type='date' value='"+json.starttime+"'  onchange='editing_check(\""+json.id+"\")'/><text> ~</text>"+
                                "<input id='mendtime_"+id+"' style='float:right;margin-top:-5px;width:105px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px;  color:#5e626e;text-align:left; font-weight:600;' type='date' value='"+json.endtime+"'   onchange='editing_check(\""+json.id+"\")'/>"+
                            "</div>"+
                        "</div>"+
                        "<hr style='border: solid 1px light-gray;'>"+
            
                        "<div id='div_title_"+id+"' style='display:"+isshow_title+"'>"+
                            "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>타이틀</label><br>"+
                            "<input type='text' class='search_area' id='mtitle_"+id+"'  placeholder='보낼 메세지 제목을 입력하세요.....'  style='width:248px;height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;padding-left:15px' value='"+json.title+"' autocomplete='off'  onkeyup='editing_check(\""+json.id+"\")'/><br>"+
                            "<div class ='autoMaker' id='mautotitle_"+id+"' ></div>"+
                        "</div>"+
                        "<label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>보낼메세지</label><img src='./img/ques_20.png' title='가입된 번호가 아닐때 예약어사용불가 , 입력된 모든폰번호가 가입된 회원번호일때 예약어 사용가능합니다.' style='float:right;margin-top:10px;margin-left:10px'/><text id='mtext_notuse_"+id+"' style='margin-top:8px;float:right;font-size:14px;color:red;visibility:"+isshowexcelvisible+"'>※예약어사용불가</text><br>"+
                        "<textarea class='search_area'  id='mmessage_"+id+"'  placeholder='보낼 메세지 내용을 입력하세요.....' style='width:248px;height:200px;background-color:#f5f8fa;border:0px;border-radius:5px;font-size: 13px;font-family:Gulim;color:#000000;text-align:left; font-weight:600;padding:15px' value='"+json.message+"' autocomplete='off'  onkeyup='updateMessageByte(\""+json.id+"\")' >"+json.message+"</textarea><br>"+
                        "<div class ='autoMaker' id='mautomessage_"+id+"' ></div>"+
                        "<text style='float:right;font-size: 13px; color:#181c32;text-align:right; font-weight:400;' id='mbyte_"+id+"'>"+txt_byte+"</text>"+
            
                        //엑셀파일번호들
                        "<div id='div_excel_"+id+"' style='display:"+isshowexceltag+"'>"+
            
                            "<br><label style='margin-top:10px;font-size: 14px; color:#181c32;text-align:left;font-weight:500;'>엑셀파일 번호들</label><br>"+
                            "<textarea id='mphones_"+id+"'  placeholder='가입되지 않은 전화번호들을 입력하세요.....'  style='width:248px;height:100px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;font-size: 14px; color:#5e626e;text-align:left; font-weight:600;;padding:15px' value='"+json.phones+"' >"+json.phones+"</textarea><br>"+
                            "<input id='minputfile_"+id+"' type='file' onchange='readExcel(\"mphones_"+id+"\",\"mphones_count_"+id+"\", \""+id+"\")' style='margin-top:7px'><text style='color:#007bff;float:right' id='mphones_count_"+id+"'>현재 "+txt_excel_count+" 개 번호</text>"+                        
                        "</div>"+
                  "</div>";
//                  "<br>"+
//                  "<hr style='border: solid 1px light-gray;'>"+
//                  "<br>";
                       
          parent.innerHTML += tag;  
        
        
         //엑셀파일이라면 예약어가 사용가능한지 불가능한지 체크한다.
         if(json.sendtype == "data_excel_phone_member" && json.messagetype == "all_phone"){
            checkUseReservedWord(json.phones,function(res){
                var mtext_note = document.getElementById("mtext_notuse_"+id);
                var code = parseInt(res.code);
                if(code == 100){
                    mtext_note.style.color = "blue";
                    mtext_note.innerHTML = "※예약어 사용가능";
                }else {
                    mtext_note.style.color = "red";
                    mtext_note.innerHTML = "※예약어 사용불가";
                }

            },function(err){
                clog("checkUseReservedWord err",er);
            });
         }
    }
    function messagetogglechange(id){
    //    clog("toggle change!!"+ischeck);
        var toggle = document.getElementById("toggle_"+id);
        var toggle_title = document.getElementById("toggle_title_"+id);
        var toggle_txt = document.getElementById("toggle_txt_"+id);
    //    clog("toggle check ",toggle.checked);
        var mdiv = document.getElementById("mdiv_"+id);
        var edit_json = getJsonFrontMessageJson(id);
        
        if(toggle.checked){
            toggle_txt.innerHTML = "&nbsp;켜짐";
            toggle_txt.style.color = "blue";
            toggle_title.style.color = "blue";
            edit_json.issended = "ready";
            mdiv.style.backgroundColor = "#ffffdd";
            
            var mstartday = document.getElementById("mstartday_"+id).value;
            if(compare_date(mstartday,getNowDateTime()) != 1 ){
                alertMsg("※주의하세요! <br> 예약날짜가 오늘이전이어서 저장시 바로 전송됩니다.<br>다른날 전송을 원하시면 예약날짜를 변경하여 주세요.");
            }
        }else{
            toggle_txt.innerHTML = "&nbsp;꺼짐";
            toggle_txt.style.color = "gray";
            toggle_title.style.color = "gray";
            edit_json.issended = "sended";
            mdiv.style.backgroundColor = "#eeeeee";
            
        }
//        for(var i = 0; i < allmessages.length; i++){
//            if(allmessages[i].id == id){
//                allmessages[i] = edit_json;
//                break;
//            }
//        }
        //토글을 바꾸면서 바로 저장한다.
//        savePushMessages(false);
        
        editing_check(id);
        
        
    }
    function change_frontgroup(id){
        var messagetype = document.getElementById("mmessagetype_"+id);
        var div_startend = document.getElementById("div_startend_"+id);
        var msendtype = document.getElementById("msendtype_"+id);
        var div_excel = document.getElementById("div_excel_"+id);
        var text_notuse = document.getElementById("mtext_notuse_"+id);
        div_startend.style.display = msendtype.value == "data_all_member"  ||  msendtype.value == "data_locker_all_member" ||  msendtype.value == "data_locker_over_member" ||  msendtype.value == "data_locker_limit_member" ||  msendtype.value == "data_excel_phone_member" ? "none" : "block";
        div_excel.style.display = msendtype.value == "data_excel_phone_member" ?  "block" : "none";
       
        if(msendtype.value == "data_excel_phone_member"){
            messagetype.value = "phone";
            messagetype.disabled =  true;
            text_notuse.style.visibility = "visible";
        }else{
            text_notuse.style.visibility = "hidden";
            messagetype.disabled = false;            
        }
        
        editing_check(id);
    }
    function message_delete(id){
        showModalDialog(document.body, "메세지 삭제", "선택한 메세지그룹을 삭제하시겠습니까?", "삭제하기", "취소", function() {
            removemessage(id);
            hideModalDialog();
        }, function() {
            hideModalDialog();
        });
    }
    function message_edit(id){
        insert_reservation_message(id);
    }
    
    function message_save(id){
        var edit_json = getJsonFrontMessageJson(id);
       
        clog("edit_json ",edit_json);
        if(edit_json.issended == "ready" && compare_date(edit_json.startday,getNowDateTime()) != 1){ //edit_json.startday 가 오늘이전날 , 현재날이다.
            showModalDialog(document.body, "경고!!", "예약날짜가 현재시간보다 이전입니다. 메세지가 바로 전송됩니다.<br><text style='font-size:14px;color:red'>(바로전송을 원하지 않으시면 예약날짜를 변경하시거나 메세지활성화를 꺼주세요.)</text><br>", "바로전송하기", "취소", function() {
                for(var i = 0; i < allmessages.length; i++){
                    if(allmessages[i].id == id){
                        allmessages[i] = edit_json;
                        break;
                    }
                }
                savePushMessages();  
                hideModalDialog();
            }, function() {
                hideModalDialog();
            });
        }else{
             for(var i = 0; i < allmessages.length; i++){
                if(allmessages[i].id == id){
                    allmessages[i] = edit_json;
                    break;
                }
            }
            savePushMessages();  
        }
//        
    }
    
    function removemessage(id){
        for(var i = 0 ; i < allmessages.length; i++){
            if(allmessages[i].id == id){
                allmessages.splice(i,1);
                break;
            }
        }
        savePushMessages();
    }
    //현재 작성중이면 색깔을 주황색 : 작성중이 아니라면  켜짐 , 꺼짐 색깔
    function editing_check(id){
        var edit_json = getJsonFrontMessageJson(id);
        var before_json = null;
        for(var i = 0; i < allmessages.length; i++){
            if(allmessages[i].id == id){
                before_json = allmessages[i];
                break;
            }
        }
        var mdiv = document.getElementById("mdiv_"+id);
        var miconsave = document.getElementById("miconsave_"+id);
        
        var mmessagetype = document.getElementById("mmessagetype_"+id);
        var mtext_smspush = document.getElementById("mtext_smspush_"+id);
        var mprice_smspush = document.getElementById("mprice_smspush_"+id);
        
//        var txt_sms = before_json.sms_len > 0 ? "SMS("+before_json.sms_len+")":"";
//        var txt_lms = before_json.lms_len > 0 ? "LMS("+before_json.lms_len+")":"";
//        var txt_push = before_json.push_len > 0 ? "푸시("+before_json.push_len+")":"";
//        
//        var txt_totalprice = "￦"+CommaString(before_json.sms_len * global_sms_sendprice + before_json.lms_len * global_lms_sendprice + before_json.push_len * global_push_sendprice);
//        var txt_count_price = txt_lms || txt_sms ? ""+txt_sms+txt_lms+" + "+txt_push : ""+txt_push ;
//        //푸시만 표현
//        if(mmessagetype.value == "app" ){
//            txt_count_price = txt_push;
//            txt_totalprice = "￦"+CommaString(before_json.push_len * global_push_sendprice);
//            
//        }
//        //비회원 문자만 표현   
//        else if(mmessagetype.value == "phone"){
//            txt_count_price = txt_sms+txt_lms;
//            txt_totalprice = "￦"+CommaString(before_json.sms_len * global_sms_sendprice + before_json.lms_len * global_lms_sendprice); 
//        }
//        //모두 문자로 보내기
//        else if(mmessagetype.value == "all_phone"){
//            txt_count_price = txt_sms ? "SMS("+(before_json.sms_len+before_json.push_len)+")" : "LMS("+(before_json.sms_len+before_json.push_len)+")";
//            txt_totalprice = txt_sms ? "￦"+CommaString(global_sms_sendprice * (before_json.sms_len + before_json.push_len)) :  "￦"+CommaString(global_lms_sendprice * (before_json.lms_len + before_json.push_len)); 
//        }
//        
//        mtext_smspush.innerHTML = txt_count_price;
//        mprice_smspush.innerHTML = txt_totalprice;
        
        mtext_smspush.innerHTML = "저장시 확인가능";
        mprice_smspush.innerHTML = "";
        
        
        
        if(JSON.stringify(edit_json) == JSON.stringify(before_json)){
            mdiv.style.background = before_json.issended == "ready" ? "#ffffdd" : "#eeeeee" ;
            miconsave.style.display = "none";
        }else{
            mdiv.style.background = "#fff4f8";
            miconsave.style.display = "block";
        }
        check_showtitle(id);
    }
    
    //메세지 타이틀을 보여줄건지 체크
    function check_showtitle(id){
//        clog("check_showtitle !! ");
        if(id){
            var making_messagetype = document.getElementById("mmessagetype_"+id);
            var div_title = document.getElementById("div_title_"+id);
            div_title.style.display = making_messagetype.value == "phone"  || making_messagetype.value == "all_phone" ? "none" : "block";
        }else{
            var making_messagetype = document.getElementById("making_messagetype");
            var div_title = document.getElementById("div_message_title");    
            div_title.style.display = making_messagetype.value == "phone"  || making_messagetype.value == "all_phone" ? "none" : "block";
        }
    }
 function getJsonFrontMessageJson(id){
        
        var making_id = document.getElementById("mid_"+id);
        var toggle = document.getElementById("toggle_"+id);
       
        var making_messagetype = document.getElementById("mmessagetype_"+id);
        var making_startday = document.getElementById("mstartday_"+id);
        var making_repeat = document.getElementById("mrepeat_"+id);
        var making_sendtype = document.getElementById("msendtype_"+id);
        var making_starttime = document.getElementById("mstarttime_"+id);
        var making_endtime = document.getElementById("mendtime_"+id);
        var making_name = document.getElementById("mname_"+id);
        var making_title = document.getElementById("mtitle_"+id);
        var making_message = document.getElementById("mmessage_"+id);
        var making_phones = document.getElementById("mphones_"+id);
     
        var json = {};
        json.id = making_id.value;
        json.issended = toggle.checked ? "ready" : "sended";
        json.messagetype = making_messagetype.value;
        json.startday = making_startday.value;
        json.repeattype = making_repeat.value;
        json.sendtype = making_sendtype.value;
        json.starttime = making_starttime.value;
        json.endtime = making_endtime.value;
        json.name = making_name.innerHTML;
        json.title = making_title.value;
        json.message = making_message.value;
//        json.phones = making_phones.value;
        json.phones = making_sendtype.value == "data_excel_phone_member" ? making_phones.value : "";
        return json;
    }
    function getJsonReservationPushMessage(){
        var making_id = document.getElementById("making_id");
        var making_issended = document.getElementById("making_issended");
        var making_messagetype = document.getElementById("making_messagetype");
        var making_startday = document.getElementById("making_startday");
        var making_repeat = document.getElementById("making_repeat");
        var making_sendtype = document.getElementById("making_sendtype");
        var making_messagetype = document.getElementById("making_messagetype");
        var making_starttime = document.getElementById("making_starttime");
        var making_endtime = document.getElementById("making_endtime");
        var making_name = document.getElementById("making_name");
        var making_title = document.getElementById("making_title");
        var making_message = document.getElementById("making_message");
        var making_phones = document.getElementById("making_phones");
        
        var json = {};
        json.id = making_id.value;
        json.issended = making_issended.value;
        json.messagetype = making_messagetype.value;
        json.startday = making_startday.value;
        json.repeattype = making_repeat.value;
        json.sendtype = making_sendtype.value;
        json.messagetype = making_messagetype.value;
        json.starttime = making_starttime.value;
        json.endtime = making_endtime.value;
        json.name = making_name.value;
        json.title = making_title.value;
        json.message = making_message.value;
        json.phones = making_sendtype.value == "data_excel_phone_member" ? making_phones.value : "";
        return json;
    }
    function updateSelectMessageType(){
        var making_sendtype = document.getElementById("making_sendtype");
        var making_messagetype = document.getElementById("making_messagetype");
        
        if(making_sendtype.value == 'data_excel_phone_member'){
             var messagetype_arr = [{"value":"phone","txt":"비회원만 문자전송"},{"value":"all_phone","txt":"모두문자로 전송"}];
        }else{
             var messagetype_arr = [{"value":"app_phone","txt":"자동전송"},{"value":"app","txt":"회원만 앱푸시로 전송"},{"value":"phone","txt":"비회원만 문자전송"},{"value":"all_phone","txt":"모두문자로 전송"}];
        }
        
        var messagetype_option_tag = "";
        for(var i = 0 ; i  < messagetype_arr.length; i++){
           
            messagetype_option_tag +=  "<option value ='"+messagetype_arr[i].value+"'>"+messagetype_arr[i].txt+"</option>";
        }
        making_messagetype.innerHTML = messagetype_option_tag;
    }
    function updatePushMessageTable(type){ //type == 1 ? making_messagetype 변경함
        var making_sendtype = document.getElementById("making_sendtype");
        var div_making_startend = document.getElementById("div_making_startend");
        var making_excel_btn = document.getElementById("making_excel_btn");
        var making_messagetype = document.getElementById("making_messagetype");
        
        if(!type)updateSelectMessageType();
        
        if(making_sendtype.value == 'data_all_member'){
            div_making_startend.style.display = "none";
            making_excel_btn.style.display = "none";
            

            
        }else if(making_sendtype.value == 'data_excel_phone_member'){
            div_making_startend.style.display = "none";
            making_excel_btn.style.display = "block";
            
            
            
            
            
        }else{
            div_making_startend.style.display = "block";
            making_excel_btn.style.display = "none";

            
        }   
        check_showtitle();
        
    }
    
    
    
    //프로그램에서 지정한 가이드 텍스트
     var guide_text = [
        {key:"mem_username", name:'#이름', val:'#{이름}'},
        {key:"mem_userid", name:'#고객번호', val:'#{고객번호}'},
        {key:"mem_birth", name:'#생일', val:'#{생일}'},
        {key:"mem_uselockernumber", name:'#라커번호', val:'#{라커번호}'},
        {key:"mem_lockerpass", name:'#라커비번', val:'#{라커비번}'},
        {key:"mem_uselockertime", name:'#라커종료일', val:'#{라커종료일}'},
        {key:"mem_starttime", name:'#시작일', val:'#{시작일}'},
        {key:"mem_endtime", name:'#종료일', val:'#{종료일}'},         
    ];

    var isComplete = false;  //autoMaker 자식이 선택 되었는지 여부
    var autoMakerfocus = -1;
    
    function guideon(){
        clog("guideon");
        $(".search_area").on("keyup",function(key){
        //enter
         var txt = $(this).val();
         var id = $(this).attr('id'); 
         var automakerid = getAutoMakerId(id);
         var autoMaker = document.getElementById(automakerid);
         var search_area = document.getElementById(id);
            
         var lasttext = isGuide(txt);
//         clog("key.keyCode " +key.keyCode);
                clog("automakerid "+automakerid);
            if(key.keyCode==13) { 
//                clog("엔터키 이벤트");
                 if(autoMaker && autoMaker.children.length > 0 && autoMakerfocus >= 0 && autoMakerfocus < autoMaker.children.length){
                    search_area.value = replaceGuideText(txt,lasttext,autoMaker.children[autoMakerfocus].name);
                     // $("#"+automakerid).children().remove();
                    autoMaker.innerHTML = "";
                    autoMakerfocus = -1;
                }

            }else if(key.keyCode== 38){
//                clog("UP 이벤트",autoMaker.children);
                autoMakerfocus--;
                if(autoMakerfocus < 0)autoMakerfocus = autoMaker.children.length-1;

                for(var i = 0 ; i < autoMaker.children.length; i++){
                    autoMaker.children[i].focus = false;
                    autoMaker.children[i].style.backgroundColor = "#e1ecea";    
                }
                if(autoMakerfocus >= 0 && autoMakerfocus < autoMaker.children.length){
                    autoMaker.children[autoMakerfocus].focus = true;
                    autoMaker.children[autoMakerfocus].style.backgroundColor = "#fff4f8";    
                }

            }else if(key.keyCode == 40){
//                clog("DOWN 이벤트",autoMaker.children);
                autoMakerfocus++;
                if(autoMakerfocus >= autoMaker.children.length)autoMakerfocus = 0;

                for(var i = 0 ; i < autoMaker.children.length; i++){
                    autoMaker.children[i].focus = false;
                    autoMaker.children[i].style.backgroundColor = "#e1ecea";    
                }
                if(autoMakerfocus >= 0 && autoMakerfocus < autoMaker.children.length){
                    autoMaker.children[autoMakerfocus].focus = true;
                    autoMaker.children[autoMakerfocus].style.backgroundColor = "#fff4f8";    
                }
            }else{
                
                 if(lasttext.indexOf("#") >= 0){  //빈줄이 들어오면
//                    $("#"+automakerid).children().remove();
                    autoMaker.innerHTML = "";
                    autoMakerfocus = -1;
                     for(var i = 0 ; i < guide_text.length; i++){
                         if(guide_text[i].name.indexOf(lasttext) >= 0){
//                             $("#"+automakerid).append($('<div>').text(guide_text[i].name).attr({'key':guide_text[i].key}));
                             
                             var text = document.createElement("div");
                             text.innerHTML = "&nbsp;&nbsp;&nbsp;"+guide_text[i].name;
                             text.name = guide_text[i].val;
                             text.style.backgroundColor = "#e1ecea";
                             autoMaker.append(text);
                         }
                     }

                    $("#"+automakerid).children().each(function(){
                        $(this).click(function(){
                            $('.search_area').val($(this).text());
//                            $("#"+automakerid).children().remove();	
                             autoMaker.innerHTML = "";
                            isComplete = true;
                        });
                    });			
                } else {
//                    $("#"+automakerid).children().remove();
                     autoMaker.innerHTML = "";
                }  
            }
        });
    }

   function getAutoMakerId(inputid){
       var txtarr = inputid.split('_');
       var id = "";
       if(txtarr.length > 1){
           var id = txtarr[0] == "mtitle" ? "mautotitle_" : "mautomessage_";
           for(var i = 1 ; i < txtarr.length; i++)
              id += i == txtarr.length-1 ? txtarr[i] : txtarr[i]+"_";
       }
       
       return id;
   }
    function isGuide(txt){
        
        var txtarr = txt.split(/\n| /);
        var lastnum = txtarr.length-1;
        var rtxt = "";
        if(txtarr[lastnum] == " "){
            lastnum--;            
        }
        if(lastnum >= 0){
            rtxt = txtarr[lastnum];
        }
//        clog("rtxt ",rtxt);
        return rtxt;
    }
    
    function replaceGuideText(txt,lasttext,newtext){
        var txtarr = txt.split(' ');
        var lastnum = txtarr.length-1;
        var rtxt = "";
        if(txtarr[lastnum] == " "){
            lastnum--;            
        }
        if(lastnum >= 0){
            rtxt = txtarr[lastnum];
        }
        var new_txt = "";
        for( var i = 0 ; i < lastnum; i++)
            new_txt += txtarr[i]+" ";
        new_txt += newtext;
        return new_txt;
    }

</script>