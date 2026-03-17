<?php
include('./common.php'); 

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
    <title>내정보 보기</title>

    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <script>
//        if( /Android/i.test(navigator.userAgent)) {
//           
//                var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=no, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }else {
//             var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=no, initial-scale=0.5, maximum-scale=2.0, minimum-scale=0.5');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }
          var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=no, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
    <link rel="icon" type="image/gif/png" href="img/black_arc_logo.png">
    <title>Join</title>
    <!--   signature about -->
    <style>
        body {
            font: normal 100.01%/1.375 "Helvetica Neue", Helvetica, Arial, sans-serif;
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
    <script src="js/scripts.js?ver3.02a"></script>
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

<body style="background-color:#111111;padding:3px">
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <!--X button-->
    <div onclick='call_app()' style='width:100%;height:46px'><img src='./img/btn_close_x.png' style='margin:20px;width:20px;height:21px'/><span style='float:right'><label id='label_registdate' class = "fmont" style='color:white;font-size:15px;font-wieght:600;margin:18px;'></label></span></div>
    <div id= "container" style="background:#111111;padding:20px" >
        <div id='div_contract_list' >
<!--            <h6 id = "txt_title_list" align="center" style="padding:10px;background-image: linear-gradient(#fff7d1 0px, #ffffb0 100%);font-size:35px;">- 계약서 목록-</h6>-->
<!--            <h1 id = "txt_title_list"  align='center' style='font-size:2em'>계약서 목록</h1>-->
            <text  id = "txt_title_list" align="center" style="font-weight:bold;color:white;font-size:20px">계약서 목록</text>
        </div>
        
        <div id = 'div_contract_view' style='display:none'>
             <text id = "txt_title_view" style='font-size:27px;color:white'>회원가입 신청서</text>
        </div>   
       
    </div>
    <script>
        
        setZoom();
        
        
//        if( /Android/i.test(navigator.userAgent)){
//                document.body.style.zoom = 0.5;
//                document.body.style.scale = 0.5;    
//        }
        var param_mbstype = decodeURIComponent(getParam("mbstype"));
        var param_couponid = decodeURIComponent(getParam("couponid"));
        
        //test
//        param_mbstype = "헬스";
//        param_couponid = "2022-05-31 16:42:57";
        
        
        var centercode = "";
        var myinfo = null;  //기간제와 횟수제 모두 가져온다. membership , reservation
        var contract_list = null;
        var ptruledata = null;
        var centerlist = null;
        var myauthname = "";
        var mem_signpath = "";
        var label_registdate = document.getElementById("label_registdate");
//        var print_tag = getDevice() == "PC" ? "<br><button id='id_print' type='button' class='btn btn-default' >프린트</button>" : "";
        $( document ).ready(function() {
            
            label_registdate.innerHTML = "<span style='font-size:13px;'>등록일 : </span>"+param_couponid.substr(0,10);
            
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.type = "myinfo";
            CallHandler("getdata",obj,function(res){
                var code = parseInt(res.code);
                    if (code == 100) {
                        myinfo = res.message;
                        mem_signpath = "img/"+myinfo.mem_groupcode+"/"+myinfo.mem_centercodes+"/"+myinfo.mem_userid;
                        setLogos(myinfo.mem_groupcode);
                        clog("myinfo ",myinfo);
                        initAuth(myinfo);
                        
                        
                    }else{
                        alertMsg(res.message);
                    }               
            });
            
        });
        function initCenters(myinfo){
            var _data = {
                "type": "center", // group or center or auth
                "group": myinfo.mem_groupcode
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                if (code == 100) {
                    centerlist = res.message;     
                    getMyPTJoin(myinfo); 
                }
            });
        }
        function initAuth(myinfo){
                var _data = {
                "type": "authname", // group or center or auth
                "group": myinfo.mem_groupcode,
                "auth": myinfo.mem_auth
            };

            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
                clog("auth res ", res);
                if (code == 100) {
                    myauthname = res.message;
                     initCenters(myinfo);
                    
                }
            });
        }
        function getMyPTJoin(info){
            
            var centercodes_str = info.mem_centercodes;
//            clog("userinfo ", membership);
//            clog("centercodes ", centercodes);
            
            var centers = centercodes_str.split(','); 
           
             if(centers.length > 0)centercode = centers[0];//첫번째 센터코드로만 체크한다.
            
             var obj = new Object();
             obj.uid = "<?php echo $uid; ?>";
             obj.id = "<?php echo $id; ?>";
             obj.type = "ptrule";
             obj.centercode = centercode;
            
             if(obj.centercode){
                CallHandler("getptrule",obj,function(res){
                    var code = parseInt(res.code);
                    if (code == 100) {
                        
                        var starttag = "<div style='color:"+mColor.C919191+";width:100%; height:220px; overflow:auto; line-height:14px;font-size:13px; margin:0 auto;font-weight:300'>";
                        var endtag = "</div>";
                        
                        ptruledata = starttag+unescapeHtml(res.message)+endtag;
                        clog("ptruledata ",ptruledata);
                        
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
                var sign_tag = "<div style='border-radius:5px;background-color:white;width:auto;height:33px;float:right;padding:3px;'>"+
                                   "<label style='font-size:14px;margin-top:7px;margin-right:4px;font-weight:400;color:#191919'>서명</label>"+
                                   "<img style='border:1px dashed #e1e9ea;float:right;width:70px;height:30px;margin-right:10px;margin-top:-2px;' src='"+signpath+"/"+key+"_"+i+"_"+signid+".png'/>"+
                               "</div><br><br>";            

                tag = tag.replace("{{sign}}",sign_tag); 

            }
            return tag;        
        }
        function setAllContractList(ptruledata,info){
            
            var div_contract_list = document.getElementById("div_contract_list");
            contract_list = getCoupons(info,"all");
            var jsonarray = contract_list;
            clog("jsonarray ",jsonarray);
            var couponid = -1;
            if(param_couponid && param_mbstype){
                for(var i = 0 ; i < jsonarray.length;i++){
                    if(jsonarray[i].mbstype == param_mbstype && jsonarray[i].id == param_couponid){
                        couponid = i;
                        break;
                    }
                }    
            }
            
            //회원권을 하나 지정했다면
            if(couponid >= 0){
                listClick(couponid);
            }else {
                 var message = document.createElement("div");
            
                clog("contract_list ", contract_list);


                var br0 = document.createElement('br');  
                message.appendChild(br0);
                div_contract_list.append(message);


                var is_membership = false;
                for(var i = 0 ; i < jsonarray.length; i++){
                    var item = jsonarray[i];
                    var stime = item.starttime.substring(0,10);
                    var etime = item.endtime.substring(0,10);

                    var clickindex = -1;
                    var color = "background-image: linear-gradient(#777777 0px, #999999 100%);";
                    var nowdate = Date.now();

                    var date = new Date();

                    if(date.getTime() < changeDateToTimeStamp(item.endtime)){
                       is_membership = true;
                         color = "background-image: linear-gradient(#add8e6 0px, #eeeeee 100%);";

                    }
                    clickindex = i;
                    var type_img_src = item.mbstype == "PT" || item.mbstype == "GX" ? "./img/thumb_PT.png" : "./img/thumb_health.png";
                    var mbsname = item.mbstype == "PT" || item.mbstype == "GX" ? getMbsMaxCount(item)+"회" : item.mbsname;
                    
                    //기본공통코드
                    var title_tag = "<img src='"+type_img_src+"' style='margin-top:10px;margin-left:12px;width:53px;height:53px'/><text  style='position:absolute;margin-top:13px;margin-left:10px;font-size:14px;color:white;'>"+mbsname+"</text>";
                    var stime_etime_tag = "<img src='./img/icon_newcalendar.png' style='margin-left:10px;margin-top:28px;width:15px;height:15px'/><text class='fmont' style='position:absolute;color:white;font-size:14px;margin-left:10px;margin-top:36px;'>"+stime+" ~ "+etime+"</text>";
                    var default_tag = title_tag+stime_etime_tag;
                    
                    if(item.holdingstarttime && item.holdingendtime){
                        var hstime = item.holdingstarttime.substring(0,10);
                        var hetime = item.holdendtime.substring(0,10);
//                        message.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+clickindex+")' class='form-control' style='height:110px;"+color+"'><h6 align='center'>"+item.mbstype+" : "+mbsname+"</h6><h6 align='center'>기간 : "+stime+" ~ "+etime+"</h6><h6 align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</h6></div><br>";
//                        message.innerHTML += "<h6 align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</h6></div><br>";
                        
                         message.innerHTML+= "<div onclick='listClick("+clickindex+")' class='holdingbox' id='div_membership_list_"+i+"'>"+default_tag+"<br><div class='mbtn' align='center' style='position:absolute;margin-left:12px;margin-top:5px;padding-left:0px;padding-right:0px;padding-top:10px;padding-bottom:10px;color:#c3da58;font-size:14px' >[홀딩기간]&nbsp;&nbsp;<img src='./img/icon_newcalendar_disable.png' style='width:14px;height:14px;margin-bottom:4px'/><text class='fmont' style='color:#919191;font-size:13px;margin-left:10px;'>"+hstime+" ~ "+hetime+"</text></div></div>";
                    }
                    else {
//                        message.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+clickindex+")' class='form-control' style='height:120px;"+color+"'><br><h6 align='center'>"+item.mbstype+" : "+mbsname+"</h6><h6 align='center'>기간 : "+stime+" ~ "+etime+"</h6></div><br>";                            
                        message.innerHTML+= "<div  onclick='listClick("+clickindex+")'  class='holdingbox' id='div_membership_list_"+i+"'>"+default_tag+"</div><br>";
                    }

                }
                if(!is_membership){
                    document.getElementById("txt_title_list").innerHTML = "현재 이용중인 회원권이 없습니다.";
                }
            }
            
            
           

               
        }
        function listClick(idx){
//            setZoom(0.5);
            var contract_data = contract_list[idx];
            
            
            setTermsOfServiceString(function(termsdata){
            
                if(contract_data && contract_data["mbstype"] == "PT" || contract_data && contract_data["mbstype"] == "GX"){ /// 횟수제인지 체크한다.
                    showCountContract(termsdata,contract_data,myinfo);
                }else{
                    showTermContract(termsdata,contract_data,myinfo,centerlist,myauthname);
                }
            });
            

        }
        //횟수제 계약문서
        function showCountContract(termsdata,data,myinfo){
            var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");
             var message = document.createElement("div");
            div_contract_list.style.display = "none";
            div_contract_view.style.display = "block";
            
            document.getElementById("txt_title_view").innerHTML = "P.T 계약서";
            
            var br0 = document.createElement('br');  
//            message.appendChild(br0);
            div_contract_view.append(message);
            var username = myinfo.mem_username;
            var userid = myinfo.mem_userid; 
            var phone = myinfo.mem_phone;
            
//            clog("data ",data);
            
            var managername = data.manager ? data.manager : "";
            var constructor = data.constructorname ? data.constructorname : "알수 없음"; //uid
            var ptid = data.id;
            var signid = dateToTimestamp(ptid);
            var stime = data.starttime.substring(0,10);
            var etime = data.endtime.substring(0,10);
            var maxcount = getMbsMaxCount(data);
            var totalprice = parseInt(data.mbsprice);
            var price1set = parseInt(totalprice/maxcount);
            var refundprice = data.refundprice ? data.refundprice : "0";
            var txt_paymenttype = ["무료","카드결제","현금결제","환불완료됨","카드+현금"];
             clog("paymenttype ",data.paymenttype);
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
            var special_contract_txt = data.pt_special_note ? data.pt_special_note : "";
            
            var signpath =  "../../../ssapi/"+mem_signpath;
            
            var special_contract_tag = "";
            if(special_contract_txt != ""){
                special_contract_tag = 
                        //특약!!특약!!특약!!특약!!
                        "<br><div style='width:100%;'><div class='form-control' id='special_contract' style='height:120px;background-color:"+mColor.C222222+"'>"+
                            "<label  class='sub_label'  style='font-size:14px;margin-top:0px;margin-left:5px;float:left;color:white'>특약</label><br>"+
                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C333333+";border:0px;width:100%' >"+special_contract_txt+"</text>"+
                            "<label style='margin-top:14px;color:white'>서명</label><img id='sign_img_special_contract' style='border-radius:4px;border:1px dashed #e1e9ea;float:right;width:100px;height:40px;margin-top:6px;background-color:white' src='"+signpath+"/pt_sign_special_contract_"+signid+".png'/>"+
                        "</div><br></div>";
            }
            
            
            
            message.innerHTML+=
                "<img src='./img/icon_membership.png' style='width:18px;height:15px;margin-top:-3px'/><text style='color:"+mColor.C919191+";font-size:17px;'>&nbsp;회원번호 : <span style='color:"+mColor.YELLOW+";font-weight:bold'>"+userid+"</span></text><br>"+
                "<label for='privacy_container' style='color:white;font-size:13px;height:40px;padding-top:15px'>*Personal Training Session 규정</label>"+
                "<div id='privacy_container' class='form-control' style='border:0px;background-color:"+mColor.C222222+";height:300px;'>"+
                    replacePTSignTag(ptruledata,"ptrule",signid)+
                    "<br>"+
                    "<input type='checkbox'  id='check_pt_desc' disabled checked ><text style='color:white;font-size:13px'>&nbsp;규정에 관한 설명을 충분히 들었으며 이에 동의합니다.</text>"+
                "</div>"+
                
                    special_contract_tag+
                
                "<div>"+
                
                        "<table style='color:white;font-size:13px;width:100%'>"+

                            "<tr style='height:40px'>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>*이름</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>*휴대폰 번호</label>"+
                                "</td>"+                                    
                            "</tr>"+
                            "<tr>"+
                                "<td>"+ 

                                    "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+username+"'>"+username+"</text>"+
                                "</td>"+
                                "<td>"+
                                    "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+phone+"'>"+phone+"</text>"+

                                "</td>"+ 
                            "</tr>"+

                           "<tr style='height:40px'>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>계약트레이너</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>*담당트레이너</label>"+
                                "</td>"+                                    
                            "</tr>"+
                            "<tr>"+
                                "<td>"+ 
                                    "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+constructor+"'>"+constructor+"</text>"+

                                "</td>"+
                                "<td>"+
                                    "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+managername+"'>"+managername+"</text>"+

                                "</td>"+ 
                            "</tr>"+

                            "<tr style='height:40px'>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>* P.T 시작일</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>* P.T 종료일</label>"+
                                "</td>"+                                    
                            "<tr>"+
                            "</tr>"+
                                "<td>"+ 
                                    "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+stime+"'>"+stime+"</text>"+
                                "</td>"+
                                "<td>"+
                                    "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+etime+"'>"+etime+"</text>"+
                                "</td>"+ 
                            "</tr>"+

                            "<tr style='height:40px'>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>총 Session</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>결제 방법</label>"+
                                "</td>"+                                    
                            "<tr>"+
                            "</tr>"+
                                "<td>"+ 
                                        
                                        "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+maxcount+"'>"+maxcount+"회</text>"+
                                    
                                "</td>"+
                                "<td>"+
                                        
                                        "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+paytext+"'>"+paytext+"</text>"+
                                    
                                "</td>"+ 
                            "</tr>"+

                            "<tr style='height:40px'>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>* P.T 가격</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>* 환불시 회당 적용단가</label>"+
                                "</td>"+                                    
                            "<tr>"+
                            "</tr>"+
                                "<td>"+ 
                                        "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+paytext+"'>"+CommaString(totalprice)+"원<br><span style='font-size:10px;color:"+mColor.YELLOW+"'>1회당 :&nbsp;"+CommaString(price1set)+"원</span></text>"+
                                    
                                "</td>"+
                                "<td>"+
                                    
                                        "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+refundprice+"'>"+CommaString(refundprice)+"원</text>"+
                                    
                                "</td>"+ 
                            "</tr>"+
                             "<tr style='height:40px'>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>회원서명(이름)</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label>회원서명(싸인)</label>"+
                                "</td>"+                                    
                            "<tr>"+
                            "</tr>"+
                                "<td style='width:50%'>"+   
                                     "<div class='form-control'>"+                                                
                                        "<img src='"+signpath+"/pt_name_"+signid+".png' style='width:100%'/>"+
                                     "</div>"+
                                "</td>"+
                                "<td style='width:50%'>"+   
                                    "<div class='form-control'>"+  
                                        "<img src='"+signpath+"/pt_sign_"+signid+".png' style='width:100%'/>"+
                                    "</div>"+
                                "</td>"+ 
                            "</tr>"+


                        "</table>"+
              
                "</div>";
           
        }
        //기간제 계약문서
        function showTermContract(termsdata,data){
            var div_contract_list = document.getElementById("div_contract_list");
            var div_contract_view = document.getElementById("div_contract_view");
             var message = document.createElement("div");
            div_contract_list.style.display = "none";
            div_contract_view.style.display = "block";
            
            document.getElementById("txt_title_view").innerHTML = "회원가입 신청서";
            
            var br0 = document.createElement('br');  
//            message.appendChild(br0);
            div_contract_view.append(message);
            var username = myinfo.mem_username;
            var userid = myinfo.mem_userid; 
            var userid = "<?php echo $id ;?>"; 
            var phone = myinfo.mem_phone;
            
            clog("termsdata terms",termsdata.terms);
            clog("termsdata mainuserool",termsdata.mainuserool);
            
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
            var coupondesc = data.mbstype+" "+data.mbsname;
            var stime = data.starttime.substring(0,10);
            var etime = data.endtime.substring(0,10);
            
            var lockerdesc = "";
            var lockertime = myinfo.mem_uselockertime ? myinfo.mem_uselockertime : "";
            var lockernumber = myinfo.mem_uselockertime ? myinfo.mem_lockernumber : "";
            var lockerpass = myinfo.mem_uselockertime ? myinfo.mem_lockerpass : "";
            var coupon_note = data.note;
            lockerdesc = "라커번호 : "+lockernumber+" , 비번 : "+lockerpass+" , 기간 : ~"+lockertime;
            
            var coupon_id = data.id ? data.id : "";
            var signid = dateToTimestamp(coupon_id);
            var termtypeprice = data.mbsprice ? parseInt(data.mbsprice) : 0; //기간제 가격
            var totalprice = data.totalprice ? parseInt(data.totalprice) : 0; //전체결제금액
            var lockerprice = data.lockerprice ? parseInt(data.lockerprice) : 0; //라커가격 
            var counttypeprice = data.counttypeprice ? parseInt(data.counttypeprice) : 0; //횟수제 가격이 있는이유는 전체가격 totalprice 에 횟수제 가격 counttypeprice이 포함되어있어서이다. 만약 counttypeprice를 뺀 금액을 알려면 totalprice - counttypeprice를 하면 된다.
            var maxcount = getMbsMaxCount(data);
            var totalprice = parseInt(data.mbsprice);
            var payment_desc = "기간제 : "+termtypeprice+"원 , 개인락커 : "+lockerprice+"원 , 전체결제금액 : "+(totalprice-counttypeprice);
            var txt_paymenttype = ["무료","카드결제","현금결제","환불완료됨","카드+현금"];
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
            var signpath =  "../../../ssapi/"+mem_signpath;
            
            message.innerHTML+= 
                "<div align='left'>"+       
                    "<img src='./img/icon_membership.png' style='width:18px;height:15px;margin-top:-3px'/><text style='color:"+mColor.C919191+";font-size:17px;'>&nbsp;회원번호 : <span style='color:"+mColor.YELLOW+";font-weight:bold'>"+userid+"</span></text>"+
                        "<hr style='border: solid 1px "+mColor.C222222+"'>"+
                        "<div id='pt_formdiv' style='color:white'>"+
                            
                               
                               
                                "<table style='color:white;font-size:13px;width:100%'>"+
                                
                                    "<tr style='height:40px'>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>고객등급</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>센터이름</label>"+
                                        "</td>"+                                    
                                    "</tr>"+
                                    "<tr>"+
                                        "<td>"+ 
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+myauthname+"'>"+myauthname+"</text>"+
                                        "</td>"+
                                        "<td>"+
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px;' value='"+centername+"'>"+centername+"</text>"+
                                        "</td>"+ 
                                    "</tr>"+
                                    
                                    "<tr style='height:40px'>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>이름</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>생년월일</label>"+
                                        "</td>"+                                    
                                    "</tr>"+
                                    "<tr>"+
                                        "<td>"+ 
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+username+"'>"+username+"</text>"+
                                            
                                        "</td>"+
                                        "<td>"+
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+birth+"'>"+birth+"</text>"+
                                            
                                        "</td>"+ 
                                    "</tr>"+
                                   "<tr style='height:40px'>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>휴대폰 번호</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>성별</label>"+
                                        "</td>"+                                    
                                    "<tr>"+
                                    "</tr>"+
                                        "<td>"+ 
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+phone+"'>"+phone+"</text>"+
                                            
                                        "</td>"+
                                        "<td>"+
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+gender+"'>"+gender+"</text>"+
                                            
                                        "</td>"+ 
                                    "</tr>"+
                
                                    "<tr style='height:40px'>"+
                                        "<td colspan='2'>"+                                    
                                            "<label>주소</label>"+
                                        "</td>"+                                                                         
                                    "</tr>"+
                                    "<tr>"+
                                        "<td colspan='2'>"+                                    
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;' value='"+homeaddress+"'>"+homeaddress+"</text>"+
                                        "</td>"+                                        
                                    "</tr>"+
                                    "<hr style='border: solid 1px light-gray;'>"+
                                    "<tr style='height:40px'>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>회원권</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>결제방법</label>"+
                                        "</td>"+                                    
                                    "</tr>"+
                                    "<tr>"+
                                        "<td>"+ 
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+coupondesc+"'>"+coupondesc+"</text>"+
                                            
                                        "</td>"+
                                        "<td>"+
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;width:155px' value='"+paytext+"'>"+paytext+"</text>"+
                                          
                                        "</td>"+ 
                                    "</tr>"+
                
                
                                   "<tr style='height:40px'>"+
                                        "<td colspan='2'>"+                                    
                                            "<label>결제내역</label>"+
                                        "</td>"+                                                                         
                                    "</tr>"+
                                    "<tr>"+
                                        "<td colspan='2'>"+                                    
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;' value='"+payment_desc+"'>"+payment_desc+"</text>"+
                                            
                                        "</td>"+                                        
                                    "</tr>"+
                
                                
                                    
                                   "<tr style='height:40px'>"+
                                        "<td colspan='2'>"+                                    
                                            "<label>기타특이사항</label>"+
                                        "</td>"+
                                                                         
                                    "</tr>"+
                                    "<tr>"+
                                        "<td colspan='2'>"+                                    
                                            
                                            "<text class='form-control' align='center-vertical' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;' value='"+payment_desc+"'>"+coupon_note+"</text>"+
                                        "</td>"+                                        
                                    "</tr>"+
                                    
                                     "<tr>"+
                                        "<td colspan='2'>"+     
                                             "<label for='privacy_container' style='height:40px;padding-top:15px'>*이용약관</label>"+
                                            "<div id='privacy_container' class='form-control' style='border:0px;background-color:"+mColor.C222222+";height:200px;'>"+
                                                replacePTSignTag(termsdata.terms,"terms1",signid)+
                                                
                                            "</div>"+
                                        "</td>"+      
                                    "</tr>"+
                                    "<tr>"+
                                        "<td colspan='2'>"+   
                                            "<label for='privacy_container' style='height:40px;padding-top:15px'>*주요 이용규정 및 환불규정</label>"+
                                            "<div id='privacy_container' class='form-control' style='border:0px;background-color:"+mColor.C222222+";height:250px;'>"+
                                                replacePTSignTag(termsdata.mainuserool,"mainuserule",signid) +
                                                
                                            "</div>"+
                                        "</td>"+      
                                    "</tr>"+
                
                                    "<tr>"+
                                        "<td colspan='2'>"+     
                                            "<label for='privacy_container' style='height:40px;padding-top:15px'>*개인정보 수집 및 이용</label>"+
                                            "<div id='privacy_container' class='form-control' style='color:"+mColor.C919191+";font-size:13px;background-color:"+mColor.C222222+";border:0px;' >"+
                                                "개인정보 수집 멏 이용에 동의하지 않을 권리가 있으며 동의를 거부할 경우 회원가입이 불가능합니다.<br>"+
                                                "(필수) 위 개인정보를 수집/이용하는데 동의하십니까? <p align='right'>동의합니다.&nbsp;&nbsp;<input id='id_privacy_policy' type='checkbox' disabled checked ></p>"+
                                            "</div>"+
                                        "</td>"+      
                                    "</tr>"+
                
                                    
                                       "<tr style='height:40px'>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>회원서명(이름)</label>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+                                    
                                            "<label>회원서명(싸인)</label>"+
                                        "</td>"+                                    
                                    "<tr>"+
                                    "</tr>"+
                                        "<td style='width:50%'>"+   
                                             "<div class='form-control'>"+                                                
                                                "<img src='"+signpath+"/name_"+signid+".png' style='width:100%'/>"+
                                             "</div>"+
                                        "</td>"+
                                        "<td style='width:50%'>"+   
                                            "<div class='form-control'>"+  
                                                "<img src='"+signpath+"/sign_"+signid+".png' style='width:100%'/>"+
                                            "</div>"+
                                        "</td>"+ 
                                    "</tr>"+
                                    
                
                                "</table>"+
                                
                           
//                            "<p id='id_mark' align = 'right'><img onclick='printscreen()' src='./img/mark.png' style='margin-top:-200px'/>"+
                        "</div>"+                
                "</div>";
        }
        function setTermsOfServiceString(callback) {
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.type = "termsofservice";
            obj.centercode = getData("nowcentercode");

            CallHandler("terms", obj, function(res) {
                var code = parseInt(res.code);
                console.log("res ",res);
                if (code == 100) {
                   res = decodeTerms(res);
                    //var container = document.getElementById("terms_container");
                    var container = document.createElement("div");
                    container.innerHTML = "";
                    var br0 = document.createElement('br');
                    container.append(br0);
                    termsofservice_count = res.message.length;
                    termsdatas = res.message;
                    
                    var starttag = "<div style='color:"+mColor.C919191+";width:100%; height:120px; overflow:auto; line-height:14px;font-size:13px; margin:0 auto'>";
                    var endtag = "</div>";
                    
                    for (var i = 1; i < res.message.length; i++) {
                        var terms_title = "이용약관";
                        
                        var div = document.createElement('div');
                        div.innerHTML = starttag+res.message[i]+endtag;
                        div.innerHTML += "<div style='font-size:13px;float:right;color:white;padding-top:10px'>이용약관확인&nbsp;&nbsp;<input type='checkbox' checked disabled></div>";
                 
                        container.append(div);

                        var br = document.createElement('br');

                        container.append(br);

                    }
                    
                    starttag = "<div style='color:"+mColor.C919191+";width:100%; height:190px; overflow:auto; line-height:14px;font-size:13px; margin:0 auto'>";
                    
                    
                    var mainuse_container_title = document.createElement("div");
                    var mainuse_container = document.createElement("div");
                    var mainuserule = res.mainuserule;
                   mainuse_container.style.backgroundColor = "#b1b1b1";
                    if(mainuserule){
                        mainuse_container_title.style.display = "block";
                       
                        mainuse_container.innerHTML =  starttag+mainuserule+endtag;
                        mainuse_container.innerHTML += "<div style='font-size:13px;float:right;color:white;padding-top:10px'>(필수) *약관의 모든 내용을 숙지하였으며, 이에 동의합니다 &nbsp;&nbsp;<input type='checkbox' checked disabled></div>";
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
//            if(getDevice() == "PC")
//                print();
        }
//        $("#id_print").click(function() { // calls the id of the button that will print
//           clog("aaa");
//             document.getElementById("id_print").style.visibility = "none";
//            if (print()) { // shows print preview.
//                document.getElementById("id_print").style.visibility = "none";
//            } else { // else statement will check if cancel button is clicked.
//                document.getElementById("id_print").style.visibility = "block";
//            }
//        });
    </script>
</body>
</html> 