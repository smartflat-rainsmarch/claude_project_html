<?php
include('./common.php'); 

//$uid = isset($_POST['uid']) ? $_POST['uid'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$id = isset($_POST['id']) ? $_POST['id'] : '';//제대로 가입한 유저인지 체크하기 위한 값
//$type = isset($_POST['type']) ? $_POST['type'] : '';

//$uid = "black_0000_test_name_2021-01-22 16:48:51";
//$uid = "test_uid0000";
//$id = "0000";
$type = "membership";

?>
<!DOCTYPE html> 
<html lang="ko">
<head>
<title>회원권 시작일 변경</title>

<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
 <script>
//        if( /Android/i.test(navigator.userAgent)) {
//           
//                var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }else {
//             var MetaTag = document.createElement("META");
//                MetaTag.setAttribute('name', 'viewport');
//                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=0.5, maximum-scale=2.0, minimum-scale=0.5');
//                document.getElementsByTagName('head')[0].appendChild(MetaTag);
//        }
      var MetaTag = document.createElement("META");
    MetaTag.setAttribute('name', 'viewport');
    MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
    document.getElementsByTagName('head')[0].appendChild(MetaTag);
    </script>
<!--    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1" />-->
<meta name="format-detection" content="telephone=no, address=no, email=no" />

<!-- 아이폰(사파리) UI 없애기 -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />

<link rel="stylesheet" href="./css/layout.css"/>
<link rel="stylesheet" href="./css/sub.css"/>
<!--
<style>
body			{ background:#222}
.container		{ min-width:auto; width:90%; margin:20px auto; background:#222 }
.body			{ width:100%;background:#222 }
h1.title		{ height:25px; margin:10px 0 0; color:#fff; font-size:18px; font-weight:700; font-family:'Spoqa Han Sans', sans-serif; 
    line-height:20px; text-align:left; letter-spacing:-.05em}
</style>
-->
<!--[if IE 9]>
<link rel="stylesheet" href="/css/default.ie9fix.css">
<![endif]-->

<!--[if lt IE 9]>
<script src="/js/html5shiv.js"></script>
<script src="/js/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"><!--Noto Sans 폰트설정-->
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'> <!--Montserrat 폰트설정-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
<script src="js/scripts.js?ver3.02a1"></script>
    
<style>
 @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
    @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}

     body {
/*            font-family: 'Noto Sans KR', sans-serif;*/
         font-family:  : "Noto";
    }
 .wrapper {
    height: 300px;
    width: 300px;
    background-color: #f33;
    padding: 3px;
    box-sizing: border-box;
}

.wrapper button {
    height: 10%;
    width: 10%;
}
    .holdingbox {
        width : 100%;
        height : 133px;
        background-image : url(./img/box_membership.png);
        background-size: contain;
        background-repeat: no-repeat;
    }
    .fsans {
            font-family: 'Noto', sans-serif;
        }    
       .fmont {
          font-family: 'Montserrat', sans-serif;
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
<body style="background-color:#111111;" >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <div id= "container" style="background:#111111; padding:20px" >
        
        <div>
             <text  id = "txt_title" align="center" style="font-weight:bold;color:white;font-size:20px">시작일 변경신청</text>
        </div>
        
     
            
            
<!--
    //test
        <div id="div_membership_list" class="form-control" style="height:120px;width:100%">
            <h3 align="center">헬스 일반 : 헬스 3개월</h3>
            <h5 align="center">기간 : 2012.04.23 ~ 2020.04.06</h5>
            <h6 align="center" style="color:gray">홀딩기간 : 2012.04.23 ~ 2020.04.06</h6>            
            <p align="right" style="margin-right:10px;margin-top:-68px;"><button onclick="listClick" class="btn btn-warning">변경하기</button></p> 
        </div>
-->
          
        
    </div>
    <br>
    <div align='center'><text style="font-size:14px;color:white">※ 시작일 변경은 1회, 한달내의 날짜로 선택 가능합니다.</text></div>
    
    
<script>
    setZoom();
    
    var membershiplist = [];
     $( document ).ready(function() {
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.type = "<?php echo $type; ?>";
            
            CallHandler("my_info", obj, function(res) {
//                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {
                    
        //            document.write(res.message);
                    var container = document.getElementById("container");
                    var br0 = document.createElement('br');  
                    container.appendChild(br0);
                     var jsonarray = [];
                    var membership = res.message.membership ? JSON.parse(res.message.membership) : [];
                    var reservation = res.message.reservation ? JSON.parse(res.message.reservation) : [];
                   
                    for(var i = 0 ; i < membership.length;i++)
                        jsonarray.push(membership[i]);
                    for(var i = 0 ; i < reservation.length;i++)
                        jsonarray.push(reservation[i]);
                    
                    membershiplist = jsonarray;
                   
                    var ischangeitem = false;
                    for(var i = 0 ; i < jsonarray.length; i++){
                        var item = jsonarray[i];
                        var stime = item.starttime.substring(0,10);
                        var etime = item.endtime.substring(0,10);
                        var maxchangestarttimecount = parseInt(item.mbsmaxchangestarttime);
                        var clickindex = -1;
                        var color = "background-image: linear-gradient(#777777 0px, #999999 100%);";
                        var nowdate = Date.now();
//                        clog("etime "+changeDateToTimeStamp(item.endtime));
                        
                        var date = new Date();
                        //현재 사용중인 회원권이 있는지체크
                        if(date.getTime() < changeDateToTimeStamp(item.endtime)){
//                            clog("i is "+i);
                           
                           is_membership = true;
//                             color =  "background-image: linear-gradient(#add8e6 0px, #eeeeee 100%);";
                             clickindex = i;
//                            changeDateToTimeStamp(new Date());
                            var changecount = item.starttime_changecount ? parseInt(item.starttime_changecount) : 0;
                            
                            var type_img_src = item.mbstype == "PT" || item.mbstype == "GX" ? "./img/thumb_PT.png" : "./img/thumb_health.png";
                            var mbsname = item.mbstype == "PT" || item.mbstype == "GX" ? getMbsMaxCount(item)+"회" : item.mbsname;
                            
                            var starttimechangedata = item.starttimechangedata;
                            var ctag = "";
                            var isrequest_starttime = false;
                            if(item.starttimechangedata)
                            for(var c = 0 ;c < item.starttimechangedata.length; c++){
                                var status = holdingdata[j].status;
                                if(status == "R")
                                    isrequest_starttime = true;
                                
                                var ctxt = status == "R" ? "시작시간변경요청함" : "시작시간변경됨";
//                                ctag += "<div align='center' style='font-size:12px;color:#4444ff'>"+ctxt+" : "+holdingdata[j].request_starttime+" </div>";
                                ctag += "<div class='mbtn' align='center' style='position:absolute;margin-left:12px;margin-top:5px;padding-left:0px;padding-right:0px;padding-top:10px;padding-bottom:10px;color:"+mColor.Cc3da58+";font-size:14px' >["+ctxt+"]&nbsp;&nbsp;<img src='./img/icon_newcalendar_disable.png' style='width:14px;height:14px;margin-bottom:4px'/><text class='fmont' style='color:"+mColor.C919191+";font-size:13px;margin-left:10px;'>"+holdingdata[j].request_starttime+"</text></div>"
                            }
                              
                            //기본공통코드
                            var title_tag = "<img src='"+type_img_src+"' style='margin-top:10px;margin-left:12px;width:53px;height:53px'/><text  style='position:absolute;margin-top:13px;margin-left:10px;font-size:14px;color:"+cColor.WHITE+";'>"+mbsname+"</text>";
                            var stime_etime_tag = "<img src='./img/icon_newcalendar.png' style='margin-left:10px;margin-top:28px;width:15px;height:15px'/><text class='fmont' style='position:absolute;color:white;font-size:14px;margin-left:10px;margin-top:36px;'>"+stime+" ~ "+etime+"</text>";
                            var default_tag = title_tag+stime_etime_tag;
                            
                            
                            //시작시간 최대로변경할수 있는 횟수가 0이거나 변경한 횟수가 최대변경횟수와 같거나 크다면
                            if(maxchangestarttimecount == 0 || changecount >= maxchangestarttimecount){
                                container.innerHTML+=  "<div class='holdingbox' id='div_membership_list_"+i+"' >"+default_tag+""+ctag+"<br><text class='mbtn' align='center' style='position:absolute;margin-left:12px;margin-top:5px;padding-left:0px;padding-right:0px;padding-top:10px;padding-bottom:10px;color:"+mColor.Ce36969+";font-size:14px'><img src='./img/icon_warning.png' style='width:18px;height:18px;'/>&nbsp;변경불가 회원권</text></div>";
                            }
                            else if(date.getTime() < changeDateToTimeStamp(item.starttime) && changecount == 0 && changecount < maxchangestarttimecount){
                                 ischangeitem = true;
                                //회원권이 시작시간변경을 할 수 있는 회원권인지 아닌지 체크한다.                                
                                 container.innerHTML+=  "<div class='holdingbox' id='div_membership_list_"+i+"' >"+default_tag+""+ctag+"<div class='mbtn' align='center' style='position:absolute;margin-left:12px;margin-top:5px;padding-left:0px;padding-right:0px;padding-top:10px;padding-bottom:10px;color:#333;background-color:"+mColor.YELLOW+";font-size:15px'  onclick='listClick("+clickindex+")' >시작시간변경신청하기</div></div>";
                                
                                
                            }else{

                                 container.innerHTML+= "<div class='holdingbox' id='div_membership_list_"+i+"' >"+default_tag+"<br><text class='mbtn' align='center' style='position:absolute;margin-left:12px;margin-top:5px;padding-left:0px;padding-right:0px;padding-top:10px;padding-bottom:10px;color:"+mColor.Ce36969+";font-size:14px'><img src='./img/icon_warning.png' style='width:18px;height:18px;'/>&nbsp;변경가능한 날짜아님</text></div>";
                            }

                        }                        
                    }
                    if(!ischangeitem)
                        container.innerHTML += "<div align='center'><text style='font-size:13px;color:"+mColor.Caa0000+"'>※ 시작일 변경 가능한 회원권이 없습니다.</text></div>";

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
     });
    function listClick(index){
//        clog("aaa index "+index);
        clog(index+" membershiplist[i] ",membershiplist[index]);
//        changeDateToTimeStamp(new Date());
        var idx = membershiplist[index].mbsidx;
        var couponid = membershiplist[index].id
        var type = "starttime";
        var starttime = membershiplist[index].starttime;
        var endtime = membershiplist[index].endtime;
        var starttime_changecount = membershiplist[index].starttime_changecount ? membershiplist[index].starttime_changecount : 0;
        var mbsmaxchangestarttime = membershiplist[index].mbsmaxchangestarttime ? membershiplist[index].mbsmaxchangestarttime : 0;
        var iscounttype = membershiplist[index].mbsiscounttype ? membershiplist[index].mbsiscounttype : 0;
        var centercode = membershiplist[index].mbsusecentercode ? membershiplist[index].mbsusecentercode : "";
        
        location.href = "m_my_change_calender.php?mbsidx="+idx+"&couponid="+couponid+"&type="+type+"&starttime="+starttime+"&endtime="+endtime+"&starttime_changecount="+starttime_changecount+"&mbsmaxchangestarttime="+mbsmaxchangestarttime+"&iscounttype="+iscounttype+"&centercode="+centercode;
    }
     
</script>

</body>
</html>


