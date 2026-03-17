<style>
    .checkmark:after {
        left: 5px !important;
        top: 2px !important;
    }
</style>

<div id= "container">
        <!-- 221017 유진 수정 -->
      <div id="txt_title_zone" style='width:96%;height:auto; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;margin:0 auto;'>
            <div style='width:100%;height:45px;background-color:#f5f8fa; border-radius:10px; '>
                <label id = "txt_title_list"  style='float:left;font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px;'>계약서 목록</label>
            </div>
            <div id='div_contract_list' style='width:100%;auto;border-radius:0 0 10px 10px;text-align:left;padding:20px' >

            </div>
       </div>
        <br>
        <div id = 'div_contract_view' style='display:none'>
             <text id = "txt_title_view" class='txt_titles'  align='center' style='font-size:20px; color: #262930; font-weight: 700;'>회원가입 신청서</text>
            
        </div>   
       
    </div>
<!--    <p align="right"><button id='id_contract_close' onclick='contract_close()' class='btn btn-primary btn-raised' style='margin-right:10px;'>닫기</button><button id='id_contract_print' onclick='printscreen()' class='btn btn-primary btn-raised' style='margin-right:30px;'>출력하기</button></p>-->
    
    <script>
        clog("contract_list");
        
        var myinfo = null;  //기간제와 횟수제 모두 가져온다. membership , reservation
        var contract_list = null;
        var ptruledata = null;
        var centerlist = null;
        var myauthname = "";
        var stamp_tag = "<div align='right' style='width:100%;'>"+
                                "<div align='center' id='id_mark' style='width:234px;height:234px'>"+                                 
                                    "<text class='fmont' style='color:red;font-size:30px;font-weight:900'>"+session_groupname+"</text>"+
                                    "<img onclick='printscreen()' src='./img/mark.png' style='margin-top:-135px;'/>"+             
                                "</div>"+
                            "</div>";
//        var print_tag = getDevice() == "PC" ? "<br><button id='id_print' type='button' class='btn btn-default' >프린트</button>" : "";
        $( document ).ready(function() {
            
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");
        
            var value ={
                useruid : contract_uid
            }
            
            var senddata = {
                groupcode : groupcode,
                centercode : centercode,
                type :"uid",
                value : contract_uid
            };
            CallHandler("adm_get", senddata, function (res) {
                var code = parseInt(res.code);
                    if (code == 100) {
                        myinfo = res.message[0];
                        clog("userinfo ",myinfo);
                        getMyPTJoin(myinfo); 
                        initCenters(myinfo.mem_groupcode);
                        initAuth(myinfo.mem_groupcode,myinfo.mem_auth);
                    }else{
                        alertMsg(res.message);
                    }               
            });
            
            
            
            
        });
        function initCenters(groupcode){
            var _data = {
                "type": "center", // group or center or auth
                "group": groupcode
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {
                    centerlist = res.message;                    
                }
            });
        }
        function initAuth(groupcode,auth){
                var _data = {
                "type": "authname", // group or center or auth
                "group": groupcode,
                "auth": auth
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                clog("auth res ", res);
                if (code == 100) {
                    myauthname = res.message;
                    
                }
            });
        }
        function getMyPTJoin(info){
           
            
             var obj = new Object();
             obj.uid = contract_uid;
             obj.id = contract_id;
             obj.type = "ptrule";
             obj.centercode = getData("nowcentercode");
            
             if(obj.centercode){
                CallHandler("getptrule",obj,function(res){
                    var code = parseInt(res.code);
                    if (code == 100) {
                        ptruledata = res.message;
                        
                        setAllContractList(ptruledata,info);
                        
                    }else{
                        alertMsg(res.message);
                    }
                }, function(err) {
                    alertMsg("네트워크 에러 ");
                });    
             }
        }
        function setAllContractList(ptruledata,info){
//            document.getElementById("id_contract_close").style.display = "block";
            var div_contract_list = document.getElementById("div_contract_list");
            contract_list = getCoupons(info,"all");
            if(contract_list)contract_list.sort(sort_by('id', true, (a) => a.toUpperCase()));
            var message = document.createElement("div");
            
            clog("contract_list ", contract_list);
            
          
//            var br0 = document.createElement('br');  
//            message.appendChild(br0);
            div_contract_list.append(message);
            var jsonarray = contract_list;
            
            var is_membership = false;
            for(var i = 0 ; i < jsonarray.length; i++){
                var item = jsonarray[i];
                var stime = item.starttime.substring(0,10);
                var etime = item.endtime.substring(0,10);

                var clickindex = -1;
                var bgcolor = "background-color:light-gray";
                var nowdate = Date.now();

                var date = new Date();

                if(date.getTime() < changeDateToTimeStamp(item.endtime)){
                   is_membership = true;
                     bgcolor = "background-color:white";
                     
                }
                clickindex = i;
                var pt_txt = item.mbstype == "PT" || item.mbstype == "GX" ? item.mbsmaxcount+" 회" : item.mbsname;
                if(item.mbstype == TYPE_GX) pt_txt = item.mbsmaxcount+" 회";
                
                if(item.holdingstarttime && item.holdingendtime){
                    var hstime = item.holdingstarttime.substring(0,10);
                    var hetime = item.holdendtime.substring(0,10);
                                
                    message.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+clickindex+")' style='color:#3f4254;height:50px;padding-top:10px;"+bgcolor+"'><label style='position:absolute;float:left;font-size:15px;font-weight:500'>&nbsp;&nbsp;"+item.mbstype+"<span style='font-weight:400'> : "+pt_txt+"</span></label><label style='position:absolute;margin-left:300px;font-size:15px;font-weight:500'>&nbsp;&nbsp;기간 : <span  style=' font-weight:400'>"+stime+" ~ "+etime+"</span></label><label align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</label></div><br>";
                    message.innerHTML += "<label align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</label><label style='float:right;width:60px; height:30px;border-radius:5px;background-color:#e4e6ef;font-size:13px; color:#3f4254;text-align:center; font-weight:700;padding-top:5px'>보기</label></div><br>";
                }
                else {
                    message.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+clickindex+")' class='form-control' style='color:#3f4254;height:50px;padding-top:10px;"+bgcolor+"'><label style='position:absolute;float:left;font-size:15px;font-weight:500'>&nbsp;&nbsp;"+item.mbstype+"<span style='font-weight:400'> : "+pt_txt+"</span></label><label style='position:absolute;margin-left:300px;font-size:15px;font-weight:500'>&nbsp;&nbsp;기간 : <span style=' font-weight:400'>"+stime+" ~ "+etime+"</span></label><label style='float:right;width:60px; height:30px;border-radius:5px;background-color:#e4e6ef;font-size:13px; color:#3f4254;text-align:center; font-weight:700;padding-top:5px'>보기</label></div><br>";                            
                }

            }
            if(!is_membership){
                document.getElementById("txt_title_list").innerHTML = "현재 이용중인 회원권이 없습니다.";
            }

               
        }
        function listClick(idx){
            var contract_data = contract_list[idx];
            var id_mark = document.getElementById("id_mark");
            
             var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");            
//            var id_contract_print = document.getElementById("id_contract_print");            
            div_contract_list.style.display = "none";
            div_contract_view.style.display = "block";
            setTermsOfServiceString(function(termsdata){
                
                if(contract_data && contract_data["mbstype"] == "PT" || contract_data && contract_data["mbstype"] == "GX"){ /// 횟수제인지 체크한다.
                    showCountContract(termsdata,contract_data,myinfo);
                }else{
                    //showTermContract(termsdata,contract_data,myinfo,centerlist,myauthname);
                    showTermContract(termsdata,contract_data);
                }
                document.getElementById("id_mark").style.visibility = "hidden";
            });
            

        }
 //횟수제 계약문서
        function showCountContract(terms,data,myinfo){
           
           
            
            document.getElementById("txt_title_view").innerHTML = "- P.T 계약서 -";
            
//            var br0 = document.createElement('br');  
//            message.appendChild(br0);
            
            var message = document.createElement("div");
            div_contract_view.append(message);
            var username = myinfo.mem_username;
            var userid = myinfo.mem_userid; 
            var phone = myinfo.mem_phone;
            
            clog("data ",data);
            
            var managername = data.manager ? data.manager : "";
            var constructor = data.constructorname ? data.constructorname : "알수 없음"; //uid
            var ptid = data.id;
            var signid = dateToTimestamp(ptid);
            var stime = data.starttime.substring(0,10);
            var etime = data.endtime.substring(0,10);
            var maxcount = parseInt(data.mbsmaxcount);
            var totalprice = parseInt(data.mbsprice);
            var price1set = parseInt(totalprice/maxcount);
            var refundprice = data.refundprice ? data.refundprice : "0";
            var txt_paymenttype = ["무료","카드결제","현금결제","환불완료됨","카드+현금"];
             clog("paymenttype ",data.paymenttype);
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
            var signpath = "../../../ssapi/"+myinfo.mem_sign;
            message.innerHTML+="<br><div align='left' style='border: 1px solid #e4e6ef;border-radius:10px;padding:15px; width: 95%; margin: 0 auto;'>"+ptruledata+"</div><br>"+
            /* 221014 유진 수정 */
                "<p align='center' class='pt_ck'><img src='./img/checkbox_disabled.png' style='width:20px; height: 20px; margin-right:-15px; margin-top:2px;'><input type='checkbox' id='check_pt_desc' disabled checked style='visibility:hidden;'>&nbsp;규정에 관한 설명을 충분히 들었으며 이에 동의합니다.</p>"+
                    "<div align='center' class='form-group' style='width:95%; margin: 0 auto;'>"+                    
                        "<div id='pt_formdiv' style='padding:10px; padding-left:0; padding-right: 0;'>"+
                            "<div class='form-control' style='width:100%;height:auto; padding-top:10px; border-radius:10px; padding-bottom:10px;'>"+
                               "<div style='border: 1px solid #ced4da; border-radius: 10px;'>"+
                                "<label class='top_bar' style='width: 100%; padding:15px 30px 15px 30px;border-radius:10px 10px 0px 0px;background-color: rgb(240, 246, 250); margin-bottom: 30px;'>회원번호 : "+userid+" , 가입일시 : "+ptid+"</label>"+
                                
//                                "<table style='width:100%'>"+
//                                
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+    
                                            "<div style='width: 100%;display:flex; justify-content: space-around; margin-bottom:10px'>"+                                
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>*이름"+
                                                "<text class='form-control' id='pt_name' name='pt_name' placeholder='ex) 홍길동' align='center-vertical' style='margin:auto' value='"+username+"'>"+username+"</text>"+
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>*휴대폰 번호"+
                                                "<text class='form-control' id='pt_phone' name='pt_phone' placeholder='ex) 010-1234-5678' style='margin:auto' value='"+phone+"'>"+phone+"</text>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "<tr>"+
//                                    "</tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+      
                                            "<div style='width: 100%;display:flex; justify-content: space-around; margin-bottom:10px'>"+
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>계약트레이너"+
                                                "<text class='form-control' id='pt_name' name='pt_name' style='margin:auto;' value='"+constructor+"'>"+constructor+"</text>"+
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>*담당트레이너"+
                                            "<text class='form-control' id='pt_name' name='pt_name' style='margin:auto;' value='"+managername+"'>"+managername+"</text>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                          
//                                        "</td>"+ 
//                                    "</tr>"+
//                                
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+     
                                            "<div style='width: 100%;display:flex; justify-content: space-around; margin-bottom:10px'>"+                               
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>* P.T 시작일"+
                                            "<text class='form-control' id='pt_starttime' name='pt_starttime' style='margin:auto;' value='"+stime+"'>"+stime+"</text>"+
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>* P.T 종료일"+
                                            "<text class='form-control' id='pt_endtime' name='pt_endtime' style='margin:auto;' value='"+etime+"'>"+etime+"</text>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "<tr>"+
//                                    "</tr>"+
//                                        "<td>"+ 
                                                
//                                        "</td>"+
//                                        "<td>"+
                                                
//                                        "</td>"+ 
//                                    "</tr>"+
//                
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+
                                            "<div style='width: 100%;display:flex; justify-content: space-around; margin-bottom:10px'>"+                                    
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>총 Session"+
                                            "<div class='form-control'>"+                                                
                                                "<text id='pt_count' type='number' style='width:100px' value='"+maxcount+"' >"+maxcount+"회</text>"+
                                             "</div>"+
                                             "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>결제 방법"+
                                            "<div class='form-control'>"+  
                                                "<text id='pt_paymenttype' value='"+paytext+"'>"+paytext+"</text>"+       
                                            "</div>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "<tr>"+
//                                    "</tr>"+
//                                        "<td>"+ 
                                             
//                                        "</td>"+
//                                        "<td>"+
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                                    
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<div style='width: 100%;display:flex; justify-content: space-around; margin-bottom:10px'>"+
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>* P.T 가격설정"+
                                            "<div class='form-control' onchange='onchange_ptprice()' style='height:auto'>"+                 
                                                "총수업료:&nbsp;<text id='pt_pricetotal' value='"+totalprice+"'>"+totalprice+"</text>원,&nbsp;&nbsp;"+
                                                "1회당 :&nbsp;<text id='pt_price1set' value='"+price1set+"'>"+price1set+"</text>원"+
//                
                                            "</div>"+   
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:45%; height: 30px; line-height:29px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>* 환불시 회당 적용단가"+
                                            "<div class='form-control'>"+  
                                                "<text id='pt_pricerefund' type='number' style='width:100px' value='"+refundprice+"' >"+refundprice+"원</text>"+                                                
                                            "</div>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "<tr>"+
//                                    "</tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                                     "<tr>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<div style='width: 100%;display:flex; justify-content: space-around; margin-bottom:10px'>"+
                                            "<label class='sub_label' style='width:45%; padding-top: 5px; height: 40px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>회원서명(이름)"+
                                            "<div class='form-control' style='height:100%; margin-top:10px;'>"+                                                
                                                "<img src='"+signpath+"/pt_name_"+signid+".png' style='width:100%'/>"+
                                             "</div>"+
                                             "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:45%; padding-top: 5px; height: 40px; margin-bottom:40px; background-color: #f8f9fa; border: 1px solid #e4e6ef; border-top-left-radius:10px; border-top-right-radius:10px;'>회원서명(싸인)"+
                                            "<div class='form-control' style='height:100%; margin-top:10px;'>"+  
                                                "<img src='"+signpath+"/pt_sign_"+signid+".png' style='width:100%'/>"+
                                            "</div>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "<tr>"+
//                                    "</tr>"+
//                                        "<td style='width:50%'>"+   
                                             
//                                        "</td>"+
//                                        "<td style='width:50%'>"+   
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                                    
//                
//                                "</table>"+
                                "</div>"+
                            "</div>"+stamp_tag
                            
                        "</div>"+                
                "</div>";
           
        }//기간제 계약문서
        function showTermContract(termsdata,data){
            
            var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");            
            div_contract_list.style.display = "none";
            div_contract_view.style.display = "block";
            div_contract_view.style.maxHeight = '1709px';
            /* 221014 유진 수정 */
            document.getElementById("txt_title_view").style.width = "95%";
            //document.getElementById("txt_title_view").style.lineHeight = '0px';
            document.getElementById("txt_title_view").innerHTML = /*"<img src='img/logo_white.png' class='d-block' style='width:260px;height:41px;float:right;margin-right:40px;margin-top:-10px;'>*/"<h2 style='font-size:20px; color: #262930; font-weight: 700; width: 95.5%;border: 1px solid #ced4da;padding-left: 23px;margin: 0 auto;height: 40px;line-height: 40px;border-radius: 10px;border-bottom-left-radius: 0;border-bottom-right-radius: 0;'>회원가입 신청서</h2>";
            
//            clog("contract_popup ",contract_popup );
//            var br0 = document.createElement('br');  
//            message.appendChild(br0);
            var message = document.createElement("div");
            message.class = "form-control";
            div_contract_view.append(message);
            var username = myinfo.mem_username;
            var userid = myinfo.mem_userid; 
            
            var phone = myinfo.mem_phone;
            
//            clog("data ",data);
            var centername = "";
            for(var i = 0 ; i < centerlist.length; i++){
                if(centerlist[i].centercode == data.mbsusecentercode){
                    centername = centerlist[i].centername;
                    break;
                }
            }
            //myauthname
            var managername = data.manager ? data.manager : "";
            var constructor = data.constructorname ? data.constructorname : "알수 없음"; //uid
            var birth = myinfo.mem_birth;
            var gender = "알수없음";
            if(myinfo.mem_gender == "M")gender = "남자";
            if(myinfo.mem_gender == "F")gender = "여자";
            var homeaddress = myinfo.mem_homeaddress;
            var mbstype = data.mbstype ? data.mbstype : "";
            var mbsname = data.mbstype ? data.mbsname : "";
            var coupondesc = mbstype+" "+mbsname;
            var ptid = data.id;
            var signid = dateToTimestamp(ptid);
            var stime = data.starttime.substring(0,10);
            var etime = data.endtime.substring(0,10);
            var lockerdesc = "";
            var lockertime = myinfo.mem_uselockertime ? myinfo.mem_uselockertime : "";
            var lockernumber = myinfo.mem_uselockertime ? myinfo.mem_lockernumber : "";
            var lockerpass = myinfo.mem_uselockertime ? myinfo.mem_lockerpass : "";
            
            lockerdesc = "라커번호 : "+lockernumber+" , 비번 : "+lockerpass+" , 기간 : ~"+lockertime;
            
            var termtypeprice = data.mbsprice ? parseInt(data.mbsprice) : 0; //기간제 가격
            var totalprice = data.totalprice ? parseInt(data.totalprice) : 0; //전체결제금액
            var lockerprice = data.lockerprice ? parseInt(data.lockerprice) : 0; //라커가격 
            var counttypeprice = data.counttypeprice ? parseInt(data.counttypeprice) : 0; //횟수제 가격이 있는이유는 전체가격 totalprice 에 횟수제 가격 counttypeprice이 포함되어있어서이다. 만약 counttypeprice를 뺀 금액을 알려면 totalprice - counttypeprice를 하면 된다.
            var maxcount = parseInt(data.mbsmaxcount);
            var totalprice = parseInt(data.mbsprice);
            var payment_desc = "기간제 : "+termtypeprice+"원 , 개인라커 : "+lockerprice+"원 , 전체결제금액 : "+(totalprice-counttypeprice);
            var txt_paymenttype = ["무료","카드결제","현금결제","환불완료됨","카드+현금"];
           
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
            var signpath = "../../../ssapi/"+myinfo.mem_sign;
            message.innerHTML+=""+
        
                    "<div class='form-group' style='max-height:1709px;'>"+                    
                        "<div id='pt_formdiv' style='padding:10px; max-height:1645px; padding-top:0px;' class='col-12 offset-0'>"+
                            "<div class='form-control' style='height:auto; border: none;max-height:1709px; padding-top:0;'>"+
                               
                               
//                            "<table style='width:100%'>"+
//                            
//                                    "<tr style='width:700px'>"+
//                                        "<td style='width:50%'>"+    
                                            "<div class='top_form' style='border:1px solid #ced4da; border-radius: 10px; border-top-left-radius:0; border-top-right-radius:0; border-top:0; padding-top:15px; padding-bottom:15px;border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-bottom: 0;'>"+                                
                                            "<div style='display:flex; width: 100%; justify-content: space-around; text-align:justify;'>"+
                                                "<label style='width:45%; margin-bottom: 10px;'>고객등급"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+myauthname+"'>"+myauthname+"</text>"+
                                                "</label>"+
        //                                        "</td>"+
        //                                        "<td style='width:50%'>"+                                    
                                                "<label style='width:45%; margin-bottom: 10px;'>센터이름"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+centername+"'>"+centername+"</text>"+
                                                "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                               
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+    
                                            "<div style='display:flex; width: 100%; justify-content: space-around; text-align:justify;'>"+                                
                                                "<label style='width:45%; margin-bottom: 10px;'>이름"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+username+"'>"+username+" ["+userid+"]</text>"+
                                                "</label>"+
    //                                        "</td>"+
    //                                        "<td style='width:50%'>"+                                    
                                                "<label style='width:45%; margin-bottom: 10px;'>생년월일"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+birth+"'>"+birth+"</text>"+
                                                "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+ 
                                            "<div style='display:flex; width: 100%; justify-content: space-around; text-align:justify;'>"+                                   
                                                "<label style='width:45%; margin-bottom: 10px;'>휴대폰 번호"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+phone+"'>"+phone+"</text>"+                            
                                                "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                                "<label style='width:45%; margin-bottom: 10px;'>성별"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+gender+"'>"+gender+"</text>"+
                                                "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                                                        
//                                        "</td>"+ 
//                                    "</tr>"+                
//                                    "<tr>"+
//                                        "<td colspan='2'>"+                                    
                                            "<div style='display:flex; width: 100%; justify-content: space-around; text-align:justify;'>"+
                                            "<label style='width:95%;'>주소"+
                                            "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+homeaddress+"'>"+homeaddress+"</text>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+                                                                         
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td colspan='2'>"+                                    
                                            
//                                        "</td>"+                                        
//                                    "</tr>"+
////                                    "<hr style='border: solid 1px light-gray;'>"+
//                                    "<tr>"+
//                                        "<td style='width:50%'>"+      
                                            "<div style='display:flex; width: 100%; justify-content: space-around; text-align:justify;'>"+                              
                                                "<label style='width:45%; margin-bottom: 10px;'>회원권"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+coupondesc+"'>"+coupondesc+"</text>"+
                                                "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                                "<label style='width:45%; margin-bottom: 10px;'>결제방법"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto; margin-top:5px;' value='"+paytext+"'>"+paytext+"</text>"+
                                                "</label>"+
                                            "</div>"+
//                                        "</td>"+                                    
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td>"+ 
                                            
//                                        "</td>"+
//                                        "<td>"+
                                          
//                                        "</td>"+ 
//                                    "</tr>"+
//                
//                
//                                    "<tr>"+
//                                        "<td colspan='2'>"+         
                                            "<div style='display:flex; width: 100%; justify-content: space-around; text-align:justify;'>"+                           
                                                "<label style='width:45%; margin-bottom: 10px;'>결제내역"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto;height:auto;' value='"+payment_desc+"'>"+payment_desc+"</text>"+
                                                "</label>"+
//                                        "</td>"+                                                                         
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td colspan='2'>"+                                    
                                            
//                                        "</td>"+                                        
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td colspan='2'>"+                                    
                                                "<label style='width:45%; margin-bottom: 10px;'>기타정보"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto;height:auto' value='"+lockerdesc+"'>"+lockerdesc+"<br>운동기간 : "+stime+" ~ "+etime+"</text>"+ 
                                                "</label>"+
                                            "</div>"+
                                            "</div>"+
//                                        "</td>"+
//                                                                         
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td colspan='2'>"+                                    
                                                                                       
//                                        "</td>"+                                        
//                                    "</tr>"+                                    
//                                    "<tr>"+
//                                        "<td colspan='2'>"+    
/* 221018 유진 수정 */ 
                                            "<div class='privacy_control' style=' width: 100%; border:1px solid #ced4da; border-radius:10px; height:auto; padding-top:5px; padding-bottom: 15px;display: flex;flex-direction: column;align-items: center;border-top-left-radius: 0px;border-top-right-radius: 0px;border-top: 0;'>"+
                                            "<label for='privacy_container' style='text-align:justify; width:95%; font-size: 20px; font-weight: 700; margin: 0 auto;'>*이용약관"+
                                            "<hr style=' width: 100%;border:1px solid #eff2f5;margin:0 auto;'>"+
                                            "<div id='privacy_container' class='form-control privacy' name='privacy_container' style='height:300px;width:100%; border:none; background-color: #f5f8fa;'>"+
                                                termsdata.terms+
                                            "</div>"+
                                            "</label>"+
                                            
//                                        "</td>"+      
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td colspan='2'>"+     
                                            "<label for='privacy_container' style='text-align:justify; width:95%; font-size: 20px; font-weight: 700; margin: 0 auto; margin-top: 20px;'>*주요 이용규정 및 환불규정"+
                                            "<hr style=' width: 100%;border:1px solid #eff2f5;margin:0 auto;'>"+
                                            "<div id='privacy_container' class='form-control privacys' name='privacy_container' style='background-color:white;height:250px;width:100%; border:none; background-color: #f5f8fa;'>"+
                                                termsdata.mainuserool+
                                                
                                            "</div>"+
                                            "</label>"+
                                            
//                                        "</td>"+      
//                                    "</tr>"+     
//               
//                                    "<tr>"+
//                                        "<td colspan='2'>"+     
                                            "<label for='privacy_container' style='text-align:justify; width:95%; font-size: 20px; font-weight: 700; margin: 0 auto; margin-top: 20px;'>*개인정보 수집 및 이용"+
                                            "<hr style=' width: 100%;border:1px solid #eff2f5;margin:0 auto;'>"+
                                            "<div id='privacy_container' class='form-control privacys' name='privacy_container' style=' line-height:30px; border:none; background-color: #f5f8fa;'>"+
                                                "개인정보 수집 및 이용에 동의하지 않을 권리가 있으며 동의를 거부할 경우 회원가입이 불가능합니다.<br>"+
                                                "(필수) 위 개인정보를 수집/이용하는데 동의하십니까? <div style='float:right'><img src='./img/checkbox_disabled.png' style='width:20px; height: 20px; margin-right:-15px; margin-top:6px;'><input id='id_privacy_policy' type='checkbox' disabled checked style='visibility: hidden;'>&nbsp;&nbsp;동의합니다.</div>"+
                                            "</div>"+
                                            "</label>"+
                                            "</div>"+
//                                        "</td>"+      
//                                    "</tr>"+
//                                     "<tr>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<div class='sign_zone' style='width:95%; display: flex; justify-content: space-around; margin: 0 auto; margin-top: 20px;'>"+
                                            "<label style='width:45%;'>회원서명(이름)"+
                                            "<div class='form-control' style='height:auto'>"+                                                
                                                "<img src='"+signpath+"/name_"+signid+".png' style='width:100%;height:100px'/>"+
                                             "</div>"+
                                             "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label style='width:45%;'>회원서명(싸인)"+
                                            "<div class='form-control' style='height:auto'>"+  
                                                "<img src='"+signpath+"/sign_"+signid+".png' style='width:100%;height:100px'/>"+
                                            "</div>"+
                                            "</label>"+
                                            "</div>"+stamp_tag
                                            
//                                        "</td>"+                                    
//                                    "</tr>"+
//                  "</table>"+
//                                "<table style='width:100%'>"+
//                                    "<tr>"+
//                                        "<td style='width:45%; padding-top: 5px; height: 40px;height:100px'>"   
                                             
//                                        "</td>"+
//                                        "<td style='width:45%; padding-top: 5px; height: 40px;height:100px'>"   
                                            
//                                        "</td>"+ 
//                                    "</tr>"+
//                                    
//                
//                                "</table>"+
                                
                            "</div>"+
                            
                        "</div>"+                
                        
                "</div>";
        }
        function setTermsOfServiceString(callback) {
            var obj = new Object();
            obj.uid = contract_uid;
            obj.id = contract_id;
            obj.type = "termsofservice";
            obj.centercode = getData("nowcentercode");

            CallHandler("terms", obj, function(res) {
                var code = parseInt(res.code);
                if (code == 100) {
                   
                    //var container = document.getElementById("terms_container");
                    var container = document.createElement("div");
                    container.innerHTML = "";
                    //var br0 = document.createElement('br');
                    //container.append(br0);
                    termsofservice_count = res.message.length;
                    termsdatas = res.message;
                    for (var i = 1; i < res.message.length; i++) {
                        var terms_title = i == 0 ? "BG Tech 이용약관" : getData("nowcentername")+" 이용약관";
                        /* 221018 유진 수정 */
                        var starttag = "<text class='title'>"+terms_title+"</text><div style='margin-top:10px;'><div class='privacy_overflow' style='width:94%; height:190px; overflow:auto; line-height:14px; border:1px solid; padding:3%; margin:0 auto'>";
                        var endtag = "</div></div>";
                        var div = document.createElement('div');
                        div.innerHTML = starttag+res.message[i]+endtag;
                        div.innerHTML += "<br><input type='button' style='position:absolute;margin-left:20px;margin-top:-10px' class='btn-raised detail_btn' name='약관 자세히보기' value='약관 자세히보기'/><div style='float:right'><img src='./img/checkbox_disabled.png' style='width:20px; height: 20px; margin-right:-15px; margin-top:2px;'><input id='id_terms_" + i + "' type='checkbox' checked disabled style='visibility:hidden;'>&nbsp;&nbsp;이용약관확인</div>";
                 
                        container.append(div);

                        var br = document.createElement('br');

                        container.append(br);

                    }
                    var mainuse_container_title = document.createElement("div");
                    var mainuse_container = document.createElement("div");
                    var mainuserule = res.mainuserule;
                   mainuse_container.style.backgroundColor = "#b1b1b1";
                    if(mainuserule){
                        mainuse_container_title.style.display = "block";
                       
                        mainuse_container.innerHTML = mainuserule;
                        mainuse_container.innerHTML += "<br>(필수) *약관의 모든 내용을 숙지하였으며, 이에 동의합니다 <div style='float:right'><img src='./img/checkbox_disabled.png' style='width:20px; height: 20px; margin-right:-15px; margin-top:2px;'><input id='id_privacy_policy2' type='checkbox' checked disabled style='visibility:hidden;'>&nbsp;&nbsp;동의합니다.</p>";
                    }
                    var br = document.createElement('br');
                     
                    callback({"terms":container.innerHTML,"mainuserool":mainuse_container.innerHTML});
                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
            
            
            
        }
        function printscreen(){
//            document.getElementById("id_contract_close").style.display = "none";
//            document.getElementById("id_contract_print").style.display = "none";
            
//            if(getDevice() == "PC"){
//                print();
//                hideModalDialog();
//            }
           
        }
        function contract_close(){
                hideModalDialog();
        }

    </script>