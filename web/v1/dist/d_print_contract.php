<?php
include('./common'); 

//$uid = isset($_POST['uid']) ? $_POST['uid'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$id = isset($_POST['id']) ? $_POST['id'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$type = isset($_POST['type']) ? $_POST['type'] : '';

//$uid = "black_0000_test_name_2021-01-22 16:48:51";
//$uid = "test_uid0000";
//$id = "0000";
//$type = "membership";

?>
<!DOCTYPE html> 
<html lang="ko">
<head>
    

    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <script>

          var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=no, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
    <link rel="icon" type="image/gif/png" href="img/black_arc_logo.png">
    <title>.</title>
    <!--   signature about -->
    <style>
        body {
            font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .checkmark:after {
            left: 5px !important;
            top: 2px !important;
        }
        .sub_label{
            font-weight: bold;
            margin-top:20px;
        }
        .pt_ck{
            margin-top:-10px;
        }
    </style>
    
    <link href="./css/modaldialog.css" rel="stylesheet">
    
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
    <link rel="stylesheet" type="text/css" href="css/dd.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <script src="js/scripts.js?ver3.00a"></script>
    <script src="jquery.dd.min.js"></script>
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
        }
        .textevent {
            border-top: 1px solid #b2dba1;
            border-bottom: 1px solid #b2dba1;
            background-image: linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%);
            background-repeat: repeat-x;
            color: #3c763d;
            border-width: 1px;
            font-size: 1em;
            padding: 0 .75em;
            line-height: 2em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 1px;
            width:100%;
        }
        .holdingbox {
            width : 100%;
            height : 80px;
            background-image : url(./img/box_button_mainmenu.png);
            background-size: contain;
            background-repeat: no-repeat;
        }
        .fsans {
            font-family: 'Noto Sans KR', sans-serif;
        }    
       .fmont {
          font-family: 'Montserrat Alternates', sans-serif;
        } 

        .mbtn {
            width:302px;;
            height:43px;
            border-radius:10px;
            background-color:#191919;

        }
        
         
/*        //이미지 무한회전*/
        img.infinite_rotating_logo{
            animation: rotate_image 1s linear infinite;
            transform-origin: 50% 50%;
        }
        @keyframes rotate_image{
            100% {
                transform: rotate(360deg);
            }
        }
        
        
        /*모달 뒷배경 뿌옇게*/
/*
        .modal-backdrop{backdrop-filter: blur(5px);background-color: #000000cc;}
        .fade.modal-backdrop.show{opacity: 0.9;}
*/
        
    </style>
</head>

<body >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <!--X button-->
<!--    <div onclick='call_app()' style='width:100%;height:46px'><img src='./img/btn_close_x.png' style='margin:20px;width:20px;height:21px'/><span style='float:right'><label id='label_registdate' class = "fmont" style='color:white;font-size:15px;font-wieght:600;margin:18px;'></label></span></div>-->
    <div id= "container">
        <!-- 221017 유진 수정 -->
      <div id="txt_title_zone" style='width:96%;height:auto; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;margin:0 auto;'>
            <div style='width:100%;height:45px;background-color:#f5f8fa; border-radius:10px; '>
                <label id = "txt_title_list"  style='float:left;font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px;'>회원권 목록</label>
            </div>
            <div id='div_contract_list' style='width:100%;auto;border-radius:0 0 10px 10px;text-align:left;padding:20px' >

            </div>
       </div>
        <br>
        <div id = 'div_contract_view' style='display:none;height:auto;border-radius:10px;border:1px solid #dddddd'>
            <div style='width:100%;height:45px;background-color:#f5f8fa; border-radius:10px; '>
                <label id = "txt_title_view"  style='float:left;font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px;'>회원가입 문서</label>
            </div>
<!--             <text id = "txt_title_view" class='txt_titles'  align='center' style='font-size:20px; color: #262930; font-weight: 700;'>회원가입 신청서</text>-->
             
        </div>   
       
    </div>
    <br>
    <div id='div_print'>
        <button id='btn_print' onclick="print_contract()" class='btn btn-primary btn-raised' style="float:right;display:none;margin:10px">출력하기</button>
        <button id='btn_prev' onclick="btn_prev_click()" class='btn btn-primary btn-raised' style="float:right;display:none;margin:10px">뒤로가기</button>
    </div>

<!--    <p align="right"><button id='id_contract_close' onclick='contract_close()' class='btn btn-primary btn-raised' style='margin-right:10px;'>닫기</button><button id='id_contract_print' onclick='printscreen()' class='btn btn-primary btn-raised' style='margin-right:30px;'>출력하기</button></p>-->
    
    <script>
        clog("contract_list");
        
         var param_mbstype = decodeURIComponent(getParam("mbstype"));
        var param_couponid = decodeURIComponent(getParam("couponid"));
        var param_groupcode = getParam("groupcode");
        var param_groupname = decodeURIComponent(getParam("groupname"));
        var param_centercode = getParam("centercode");
        var param_centername = decodeURIComponent(getParam("centername"));
        var param_useruid = getParam("useruid");
        var param_userid = getParam("userid");
        
        console.log("groupname "+param_groupname);
        var myinfo = null;  //기간제와 횟수제 모두 가져온다. membership , reservation
        var contract_list = null;
        var ptruledata = null;
        var centerlist = null;
        var myauthname = "";
        var mem_signpath = "";
         var stamp_tag = "<div align='right' style='width:100%;'>"+
                                "<div align='center' id='id_mark' style='width:234px;height:234px;display:none'>"+                                 
                                    "<label class='fmont' style='color:red;font-size:30px;font-weight:900;margin-top:-115px;'>"+param_groupname+"</label>"+
                                    "<img onclick='printscreen()' src='./img/mark.png' style='margin-top:-200px;'/>"+             
                                "</div>"+
                            "</div>";
//        var print_tag = getDevice() == "PC" ? "<br><button id='id_print' type='button' class='btn btn-default' >프린트</button>" : "";
        $( document ).ready(function() {
            
            var groupcode = param_groupcode;
            var centercode = param_centercode;
        
            var value ={
                useruid : param_useruid
            }
            
            var senddata = {
                groupcode : groupcode,
                centercode : centercode,
                type :"uid",
                value : param_useruid
            };
            CallHandler("adm_get", senddata, function (res) {
                var code = parseInt(res.code);
                    if (code == 100) {
                        myinfo = res.message[0];
                        mem_signpath = "img/"+param_groupcode+"/"+param_centercode+"/"+myinfo.mem_userid;
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
             obj.uid = param_useruid;
             obj.id = param_userid;
             obj.type = "ptrule";
             obj.centercode = param_centercode;
            
             if(obj.centercode){
                CallHandler("getptrule",obj,function(res){
                    var code = parseInt(res.code);
                    if (code == 100) {
                        
                        ptruledata = unescapeHtml(res.message);
                        
                        setAllContractList(ptruledata,info);
                        
                    }else{
                        alertMsg(res.message);
                    }
                }, function(err) {
                    alertMsg("네트워크 에러 ");
                });    
             }
        }
        function replacePTSignTag(tag,key,signid){
//        console.log("tag ",tag);
            sign_count = tag.split("{{sign}}").length - 1;
            console.log("sign_count ",sign_count);
            var signpath = "../../../ssapi/"+mem_signpath;
            for(var i = 0 ; i < sign_count; i++){
                var sign_tag = "<div style='border-radius:5px;background-color:white;width:auto;height:46px;float:right;padding:3px;'>"+
                                   "<label style='font-size:14px;margin-top:10px;margin-right:4px;font-weight:400;color:#191919'>서명</label>"+
                                   "<img style='border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-right:10px;' src='"+signpath+"/"+key+"_"+i+"_"+signid+".png'/>"+
                               "</div><br><br>";            

                tag = tag.replace("{{sign}}",sign_tag); 

            }
            return tag;        
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

                
                var bgcolor = "background-color:light-gray";
                var nowdate = Date.now();

                var date = new Date();

                if(date.getTime() < changeDateToTimeStamp(item.endtime)){
                   is_membership = true;
                     bgcolor = "background-color:white";
                     
                }
                
                var pt_txt = item.mbstype == "PT" || item.mbstype == "GX" ? item.mbsmaxcount+" 회" : item.mbsname;
                if(item.mbstype == TYPE_GX) pt_txt = item.mbsmaxcount+" 회";
                
                if(item.holdingstarttime && item.holdingendtime){
                    var hstime = item.holdingstarttime.substring(0,10);
                    var hetime = item.holdendtime.substring(0,10);
                                
                    message.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+i+")' style='color:#3f4254;height:50px;padding-top:10px;"+bgcolor+"'><label style='position:absolute;float:left;font-size:15px;font-weight:500'>&nbsp;&nbsp;"+item.mbstype+"<span style='font-weight:400'> : "+pt_txt+"</span></label><label style='position:absolute;margin-left:300px;font-size:15px;font-weight:500'>&nbsp;&nbsp;기간 : <span  style=' font-weight:400'>"+stime+" ~ "+etime+"</span></label><label align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</label></div><br>";
                    message.innerHTML += "<label align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</label><label style='float:right;width:60px; height:30px;border-radius:5px;background-color:#e4e6ef;font-size:13px; color:#3f4254;text-align:center; font-weight:700;padding-top:5px'>보기</label></div><br>";
                }
                else {
                    message.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+i+")' class='form-control' style='color:#3f4254;height:50px;padding-top:10px;"+bgcolor+"'><label style='position:absolute;float:left;font-size:15px;font-weight:500'>&nbsp;&nbsp;"+item.mbstype+"<span style='font-weight:400'> : "+pt_txt+"</span></label><label style='position:absolute;margin-left:300px;font-size:15px;font-weight:500'>&nbsp;&nbsp;기간 : <span style=' font-weight:400'>"+stime+" ~ "+etime+"</span></label><label style='float:right;width:60px; height:30px;border-radius:5px;background-color:#e4e6ef;font-size:13px; color:#3f4254;text-align:center; font-weight:700;padding-top:5px'>보기</label></div><br>";                            
                }

            }
            if(!is_membership){
                document.getElementById("txt_title_list").innerHTML = "현재 이용중인 회원권이 없습니다.";
            }

               
        }
        function listClick(idx){
            console.log("contract_list ",contract_list);
            var contract_data = contract_list[idx];
            var id_mark = document.getElementById("id_mark");
            var btn_print = document.getElementById("btn_print");
            var btn_prev = document.getElementById("btn_prev");
            var txt_title_zone = document.getElementById("txt_title_zone");
            var div_contract_view = document.getElementById("div_contract_view");            
//            var id_contract_print = document.getElementById("id_contract_print");            
            txt_title_zone.style.display = "none";
            div_contract_view.style.display = "block";
            btn_print.style.display = "block";
            btn_prev.style.display = "block";
            console.log("contract_data ",contract_data);
            setTermsOfServiceString(function(termsdata){
                
                if(contract_data && contract_data["mbstype"] == "PT" || contract_data && contract_data["mbstype"] == "GX"){ /// 횟수제인지 체크한다.
                    showCountContract(termsdata,contract_data,myinfo);
                }else{
                    //showTermContract(termsdata,contract_data,myinfo,centerlist,myauthname);
                    showTermContract(termsdata,contract_data);
                }
                document.getElementById("id_mark").style.display = "none";
            });
            

        }
        function btn_prev_click(){
            var btn_print = document.getElementById("btn_print");
            var btn_prev = document.getElementById("btn_prev");
            var txt_title_zone = document.getElementById("txt_title_zone");
            
             var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");            

            txt_title_zone.style.display = "block";
            
            btn_print.style.display = "none";
            btn_prev.style.display = "none";
            
            div_contract_list.style.display = "block";
            div_contract_view.style.display = "none";
        }
        
        //횟수제 계약문서 PT
        function showCountContract(terms,data,myinfo){
            var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");            
            div_contract_view.innerHTML = "<div style='width:100%;height:45px;background-color:#f5f8fa; border-radius:10px; '><label id = 'txt_title_view'  style='float:left;font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px;'>- P.T 계약서 -</label></div>";
            div_contract_list.style.display = "none";
            div_contract_view.style.display = "block";
            

            
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
            var special_contract_txt = data.pt_special_note ? data.pt_special_note : "";
            clog("data ",data);
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
           
            var special_contract_tag = special_contract_txt ?  "<div style='width:100%;padding-left:30px;padding-right:30px'><div class='form-control' id='special_contract' style='height:60px'>"+
                            "<label  class='sub_label'  style='font-size:14px;margin-top:12px;margin-left:5px;float:left'>특약&nbsp;&nbsp;</label><input class='form-control myinputtype' id='spacial_contract_input'  style='width:490px;float:left;font-size:14px;margin-top:7px' value='"+special_contract_txt+"' disabled/><img id='sign_img_special_contract' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-top:3px;' src='"+signpath+"/pt_sign_special_contract_"+signid+".png'/>"+
                        "</div><br></div>" : "";
          
            var signpath = "../../../ssapi/"+mem_signpath;
            message.innerHTML+="<br><div align='left' style='width:100%; margin: 0 auto;padding-left:20px;padding-right:20px'><div style='border:1px solid #ced4da; border-radius:10px;padding:20px'>"+replacePTSignTag(ptruledata,"ptrule",signid)+"</div></div><br>"+
            /* 221014 유진 수정 */
                "<p align='center' class='pt_ck'><img src='./img/checkbox_disabled.png' style='width:20px; height: 20px; margin-right:-15px; margin-top:2px;'><input type='checkbox' id='check_pt_desc' disabled checked style='visibility:hidden;'>&nbsp;규정에 관한 설명을 충분히 들었으며 이에 동의합니다.</p>"+
                
                        //특약!!특약!!특약!!특약!!
                        special_contract_tag+
                
//                    "<div align='center' class='form-group' style='width:95%; margin: 0 auto;'>"+                    
                        "<div id='pt_formdiv' style='margin:20px;padding:10px; padding-left:0; padding-right: 0;'>"+
                            "<div style='width:100%;height:auto; border-radius:10px; padding-bottom:10px;border:1px solid #ced4da; border-radius:10px;'>"+
//                               "<div style='border: 1px solid #ced4da; border-radius: 10px;'>"+
                                "<label class='top_bar' style='width: 100%; padding:15px 30px 15px 30px;border-radius:10px 10px 0px 0px;background-color: rgb(240, 246, 250); margin-bottom: 30px;'>회원번호 : "+userid+" , 가입일시 : "+ptid+"</label>"+
                                
                                        "<div style='width: 100%;display:flex; justify-content: space-evenly; margin-bottom:10px'>"+                                
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>*이름"+
                                                "<text class='form-control myinputtype' id='pt_name' name='pt_name' placeholder='ex) 홍길동' align='center-vertical' style='margin:auto; line-height: 34px; text-align:left;' value='"+username+"'>"+username+"</text>"+
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>*휴대폰 번호"+
                                                "<text class='form-control myinputtype' id='pt_phone' name='pt_phone' placeholder='ex) 010-1234-5678' style='margin:auto;line-height: 34px; text-align:left;' value='"+phone+"'>"+phone+"</text>"+
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
                                            "<div style='width: 100%;display:flex; justify-content: space-evenly; margin-bottom:10px'>"+
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>계약트레이너"+
                                                "<text class='form-control myinputtype' id='pt_name' name='pt_name' style='margin:auto;line-height: 34px; text-align:left;' value='"+constructor+"'>"+constructor+"</text>"+
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>*담당트레이너"+
                                            "<text class='form-control myinputtype' id='pt_name' name='pt_name' style='margin:auto; line-height: 34px;text-align:left;' value='"+managername+"'>"+managername+"</text>"+
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
                                            "<div style='width: 100%;display:flex; justify-content: space-evenly; margin-bottom:10px'>"+                               
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>* P.T 시작일"+
                                            "<text class='form-control myinputtype' id='pt_starttime' name='pt_starttime' style='margin:auto;line-height: 34px; text-align:left;' value='"+stime+"'>"+stime+"</text>"+
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>* P.T 종료일"+
                                            "<text class='form-control myinputtype' id='pt_endtime' name='pt_endtime' style='margin:auto;line-height: 34px; text-align:left;' value='"+etime+"'>"+etime+"</text>"+
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
                                            "<div style='width: 100%;display:flex; justify-content: space-evenly; margin-bottom:10px'>"+                                    
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>총 Session"+
                                            "<div class='form-control myinputtype' style='text-align:left;line-height: 34px;'>"+                                                
                                                "<text id='pt_count' type='number' style='width:100px; ' value='"+maxcount+"' >"+maxcount+"회</text>"+
                                             "</div>"+
                                             "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>결제 방법"+
                                            "<div class='form-control myinputtype' style='text-align:left;line-height: 34px;'>"+  
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
                                            "<div style='width: 100%;display:flex; justify-content: space-evenly; margin-bottom:10px'>"+
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>* P.T 가격설정"+
                                            "<div class='form-control myinputtype' onchange='onchange_ptprice()' style='height:auto;line-height: 34px; text-align:left;'>"+                 
                                                "총수업료:&nbsp;<text id='pt_pricetotal' value='"+totalprice+"'>"+totalprice+"</text>원,&nbsp;&nbsp;"+
                                                "1회당 :&nbsp;<text id='pt_price1set' value='"+price1set+"'>"+price1set+"</text>원"+
//                
                                            "</div>"+   
                                            "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>* 환불시 회당 적용단가"+
                                            "<div class='form-control myinputtype' style='text-align:left;line-height: 34px;'>"+  
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
                
//                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>회원서명(이름)"+
//                                            "<div class='form-control myinputtype' style='text-align:left;'>"+  
//                                                "<img src='"+signpath+"/pt_name_"+signid+".png' style='width:100%; height:100%'/>"+                                               
//                                            "</div>"+
//                                            "</label>"+
//                                            "</div>"+
//                                            
//                                            "<label class='sub_label' style='width:47%; height: 30px; line-height:29px; margin-bottom:40px; text-align:left;'>회원서명(싸인)"+
//                                            "<div class='form-control myinputtype' style='text-align:left;'>"+  
//                                                "<img src='"+signpath+"/pt_sign_"+signid+".png' style='width:100%; height:100%'/>"+                                           
//                                            "</div>"+
//                                            "</label>"+
//                                            "</div>"+stamp_tag+
                
//                                          
                                            
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
//                                "</div>"+
                            "</div>"+
                            "<br><hr style='border: solid 1px light-gray;margin-left:-20px;margin-right:-20px'>"+
                            "<div class='sign_zone' style='width:95%; display: flex; justify-content: space-around; margin: 0 auto; margin-top: 20px;'>"+
                                "<label style='width:45%;'>회원서명(이름)"+
                                "<div class='form-control' style='height:auto'>"+                                                
                                    "<img src='"+signpath+"/pt_name_"+signid+".png' style='width:100%;height:100px'/>"+
                                 "</div>"+
                                 "</label>"+
//                                        "</td>"+
//                                        "<td style='width:50%'>"+                                    
                                "<label style='width:45%;'>회원서명(싸인)"+
                                "<div class='form-control' style='height:auto'>"+  
                                    "<img src='"+signpath+"/pt_sign_"+signid+".png' style='width:100%;height:100px'/>"+
                                "</div>"+
                                "</label>"+
                            "</div>"+stamp_tag
                            
                        "</div>"+                
                "</div>";
           
        }//기간제 계약문서
        function showTermContract(termsdata,data){
            
            var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");      
            div_contract_view.innerHTML = "<div style='width:100%;height:45px;background-color:#f5f8fa; border-radius:10px; '><label id = 'txt_title_view'  style='float:left;font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px;'>회원가입 문서</label></div>";
            div_contract_list.style.display = "none";
            div_contract_view.style.display = "block";
//            div_contract_view.style.maxHeight = '1709px';
//            /* 221014 유진 수정 */
//            document.getElementById("txt_title_view").style.width = "95%";
//            //document.getElementById("txt_title_view").style.lineHeight = '0px';
//            document.getElementById("txt_title_view").innerHTML = /*"<img src='img/logo_white.png' class='d-block' style='width:260px;height:41px;float:right;margin-right:40px;margin-top:-10px;'>*/"<h2 style='font-size:20px; color: #262930; font-weight: 700; width: 95.5%;border: 1px solid #ced4da;padding-left: 23px;margin: 0 auto;height: 40px;line-height: 40px;border-radius: 10px;border-bottom-left-radius: 0;border-bottom-right-radius: 0;'>회원가입 신청서</h2>";
            
            clog("termsdata ",termsdata );
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
            var coupon_note = data.note;
            
            lockerdesc = "라커번호 : "+lockernumber+" , 비번 : "+lockerpass+" , 기간 : ~"+lockertime;
            
            var termtypeprice = data.mbsprice ? parseInt(data.mbsprice) : 0; //기간제 가격
            var totalprice = data.totalprice ? parseInt(data.totalprice) : 0; //전체결제금액
            var lockerprice = data.lockerprice ? parseInt(data.lockerprice) : 0; //라커가격 
            var counttypeprice = data.counttypeprice ? parseInt(data.counttypeprice) : 0; //횟수제 가격이 있는이유는 전체가격 totalprice 에 횟수제 가격 counttypeprice이 포함되어있어서이다. 만약 counttypeprice를 뺀 금액을 알려면 totalprice - counttypeprice를 하면 된다.
            var maxcount = parseInt(data.mbsmaxcount);
            var totalprice = parseInt(data.mbsprice);
            var payment_desc = "기간제 : "+termtypeprice+"원 , 개인라커 : "+lockerprice+"원 , 전체결제금액 : "+(totalprice-counttypeprice);
            var txt_paymenttype = ["무료","카드결제","현금결제","환불완료됨","카드+현금"];
           
            console.log("myinfo ",myinfo);
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
            
            var signpath =  "../../../ssapi/"+mem_signpath;
            message.innerHTML+=""+
        
                    "<div class='form-group' style='height:auto'>"+                    
                        "<div id='pt_formdiv' style=''>"+
                            "<div style='height:auto; border: none;height;auto padding-top:0;'>"+
                               
                               
//                            "<table style='width:100%'>"+
//                            
//                                    "<tr style='width:700px'>"+
//                                        "<td style='width:50%'>"+    
                                            "<div class='top_form' style=' padding-top:15px; padding-bottom:15px;border-bottom-left-radius: 0;border-bottom-right-radius: 0;border-bottom: 0;'>"+                                
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
                                                "<label style='width:45%; margin-bottom: 10px;'>기타특이사항"+
                                                    "<text class='form-control myinputtype' align='center-vertical' style='line-height:30px;margin:auto;height:auto' >"+coupon_note+"</text>"+ 
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
                                            "<div class='privacy_control' style=' width: 100%; height:auto; padding-top:5px; padding-bottom: 15px;display: flex;flex-direction: column;align-items: center;border-top-left-radius: 0px;border-top-right-radius: 0px;border-top: 0;'>"+
                                            "<label for='privacy_container' style='text-align:justify; width:95%; font-size: 20px; font-weight: 700; margin: 0 auto;'>*이용약관"+
                                            "<hr style=' width: 100%;border:1px solid #eff2f5;margin:0 auto;'>"+
                                            "<div id='privacy_container' class='form-control privacy' name='privacy_container' style='height:auto;width:100%; border:none; background-color: #f5f8fa;font-size:14px;line-height:auto'>"+
                                                replacePTSignTag(termsdata.terms,"terms1",signid)+
                                            "</div>"+
                                            "</label>"+
                                            
//                                        "</td>"+      
//                                    "</tr>"+
//                                    "<tr>"+
//                                        "<td colspan='2'>"+     
                                            "<label for='privacy_container' style='text-align:justify; width:95%; font-size: 20px; font-weight: 700; margin: 0 auto; margin-top: 20px;'>*주요 이용규정 및 환불규정"+
                                            "<hr style=' width: 100%;border:1px solid #eff2f5;margin:0 auto;'>"+
                                            "<div id='privacy_container' class='form-control privacys' name='privacy_container' style='background-color:white;height:auto;width:100%; border:none; background-color: #f5f8fa;'>"+
                                                replacePTSignTag(termsdata.mainuserool,"mainuserule",signid) +
                                                
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
                                        "<br><hr style='border: solid 1px light-gray;'>"+
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
                                        "</div>"+
                                            
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
                                
                            "</div>"+stamp_tag+
                            
                        "</div>"+                
                        
                "</div>";
        }
        function setTermsOfServiceString(callback) {
            var obj = new Object();
            obj.uid = param_useruid;
            obj.id = param_userid;
            obj.type = "termsofservice";
            obj.centercode = param_centercode;

            CallHandler("terms", obj, function(res) {
                var code = parseInt(res.code);
                if (code == 100) {
                    res = decodeTerms(res);
                    //var container = document.getElementById("terms_container");
                    var container = document.createElement("div");
                    container.innerHTML = "";
                    //var br0 = document.createElement('br');
                    //container.append(br0);
                    termsofservice_count = res.message.length;
                    termsdatas = res.message;
                    
                    for (var i = 1; i < res.message.length; i++) {
                        var terms_title = i == 0 ? "BG Tech 이용약관" : param_centername+" 이용약관";
                        /* 221018 유진 수정 */
                        var starttag = "<text class='title'>"+terms_title+"</text><div style='margin-top:10px;'><div class='privacy_overflow' style='height:auto; overflow:auto; line-height:14px;  padding:3%; margin:0 auto'>";
                        var endtag = "</div></div>";
                        var div = document.createElement('div');
                        div.innerHTML = starttag+res.message[i]+endtag;
                        div.innerHTML += "<br>(필수) *약관의 모든 내용을 숙지하였으며, 이에 동의합니다 <div style='float:right'><img src='./img/checkbox_disabled.png' style='width:20px; height: 20px; margin-right:-15px; margin-top:2px;'><input id='id_terms_" + i + "' type='checkbox' checked disabled style='visibility:hidden;'>&nbsp;&nbsp;이용약관확인</div>";
                 
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
        function print_contract(){
            var btn_print = document.getElementById("btn_print");
            var btn_prev = document.getElementById("btn_prev");
            btn_print.style.display ="none";
            btn_prev.style.display ="none";
            
            document.getElementById("id_mark").style.display = "block";
            
        }
        $("#btn_print").click(function() { // calls the id of the button that will print
//            console.log("aaaa print!!!"); 
            var btn_print = document.getElementById("btn_print");
            var btn_prev = document.getElementById("btn_prev");
            if (print()) { // shows print preview.
                btn_print.style.display ="none";
               console.log("print!!!"); 
            } else { // else statement will check if cancel button is clicked.
               btn_print.style.display ="block";
               btn_prev.style.display ="block";
               document.getElementById("id_mark").style.display = "none";
               console.log("print canceled");
            }
        });
    </script>
    </body>
</html> 