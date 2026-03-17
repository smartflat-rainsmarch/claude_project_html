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
<script src="js/scripts.js?ver3.02a"></script>
<style>
    /*전체폰트설정*/
 body {
	font-family: 'Noto Sans KR', sans-serif;
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

<body style="background-color:#000000;padding:3px" >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <!--X button-->
    <div onclick='call_app()' style='width:100%;height:46px'><img src='./img/btn_close_x.png' style='margin:20px;width:20px;height:21px'/></div>
    <div id= "container" style="background:#000000; padding:20px" >
        
        <div>
            
            <text  id = "txt_title" align="center" style="font-weight:bold;color:white;font-size:20px">회원권 결제내역</text>
        </div>
        
        
        
<!--
        <div id="div_membership_list" class="form-control" style="height:120px;">
            <h3 align="center">헬스 일반 : 헬스 3개월</h3>
            <h5 align="center">기간 : 2012.04.23 ~ 2020.04.06</h5>
            <h6 align="center" style="color:gray">홀딩기간 : 2012.04.23 ~ 2020.04.06</h6>            
-->
        
       
    </div>
    
     <div align='right' style='padding:20px'>
<!--       <button type="button" class="btn btn-default" onclick="GoToPage('./m_my_contract.php','null')">계약문서보기</button> -->
          
    </div>
    
<script>
    
    setZoom();
    
    
    var membershiplist = [];
    $( document ).ready(function() {
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            

         
            CallHandler("my_info", obj, function(res) {
                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {
                    
        //          document.write(res.message);
                    var container = document.getElementById("container");
                    var br0 = document.createElement('br');  
                    container.appendChild(br0);
                    var jsonarray = [];
                    var membership = res.message.membership ? JSON.parse(res.message.membership) : [];
                    var reservation = res.message.reservation ? JSON.parse(res.message.reservation) : [];
                   
                    for(var i = 0 ; i < membership.length;i++)
                        jsonarray.push(membership[i]);
                    if(reservation)
                    for(var i = 0 ; i < reservation.length;i++)
                        jsonarray.push(reservation[i]);
                    
                    membershiplist = jsonarray;
                    clog("datas is ",jsonarray);
                    var is_membership = false;
                    for(var i = 0 ; i < jsonarray.length; i++){
                        var item = jsonarray[i];
                        clog("item is ",item);
                        if(item.mbstype == "PT" && item.mbsname.indexOf(ID_FREE) >= 0 && parseInt(item.mbsprice) == 0)continue;
                        else if(item.isdelete && item.isdelete == "D")continue;
                        
                        var stime = item.starttime.substring(0,10);
                        var etime = item.endtime.substring(0,10);
                       
                        var clickindex = -1;
//                        var color = "background-image: linear-gradient(#777777 0px, #999999 100%);";
                        var nowdate = Date.now();
//                        clog("etime "+changeDateToTimeStamp(item.endtime));
                        
                         var date = new Date();
                        //현재 사용중인 회원권이 있는지체크
//                        clog("date.getTime() ",date.getTime());
//                        
                        
                        if(date.getTime() < changeDateToTimeStamp(item.endtime)){
//                            clog("i is "+i);
                           
                           is_membership = true;
//                             color = "background-image: linear-gradient(#add8e6 0px, #eeeeee 100%);";
                             clickindex = i;
//                            changeDateToTimeStamp(new Date());
                        }
                        var type_img_src = item.mbstype == "PT" || item.mbstype == "GX" ? "./img/thumb_PT.png" : "./img/thumb_health.png";
                        var mbsname = item.mbstype == "PT" || item.mbstype == "GX" ? getMbsMaxCount(item)+"회" : item.mbsname;
                        
                        var title_tag = "<img src='"+type_img_src+"' style='margin-top:10px;margin-left:12px;width:53px;height:53px'/><text  style='position:absolute;margin-top:13px;margin-left:10px;font-size:14px;color:white;'>"+mbsname+"</text>";
                        var stime_etime_tag = "<img src='./img/icon_newcalendar.png' style='margin-left:10px;margin-top:28px;width:15px;height:15px'/><text class='fmont' style='position:absolute;color:"+mColor.WHITE+";font-size:14px;margin-left:10px;margin-top:36px;'>"+stime+" ~ "+etime+"</text>";
                        var default_tag = title_tag+stime_etime_tag;
                        
                        if(item.holdingstarttime && item.holdingendtime){
                            var hstime = item.holdingstarttime.substring(0,10);
                            var hetime = item.holdendtime.substring(0,10);
//                            container.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+clickindex+")' class='form-control' style='height:110px;"+color+"'><h6 align='center'>"+item.mbstype+" : "+mbsname+"</h6><h6 align='center'>기간 : "+stime+" ~ "+etime+"</h6><h6 align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</h6></div><br>";
//                            container.innerHTML += "<h6 align='center' style='color:gray'>홀딩기간 : "+hstime+" ~ "+hetime+"</h6></div><br>";
                            
                             container.innerHTML+= "<div  onclick='listClick("+i+")'  class='holdingbox' id='div_membership_list_"+i+"'>"+default_tag+"<br><div class='mbtn' align='center' style='position:absolute;margin-left:12px;margin-top:5px;padding-left:0px;padding-right:0px;padding-top:10px;padding-bottom:10px;color:"+mColor.Cc3da58+";font-size:14px' >[홀딩기간]&nbsp;&nbsp;<img src='./img/icon_newcalendar_disable.png' style='width:14px;height:14px;margin-bottom:4px'/><text class='fmont' style='color:"+mColor.C919191+";font-size:13px;margin-left:10px;'>"+hstime+" ~ "+hetime+"</text></div></div>";
                        }
                        else {
                            container.innerHTML+= "<div  onclick='listClick("+i+")'  class='holdingbox' id='div_membership_list_"+i+"'>"+default_tag+"</div><br>";
//                            container.innerHTML+= "<div id='div_membership_list_"+i+"' onclick='listClick("+clickindex+")' class='form-control' style='height:120px;"+color+"'><br><h6 align='center'>"+item.mbstype+" : "+mbsname+"</h6><h6 align='center'>기간 : "+stime+" ~ "+etime+"</h6></div><br>";                            
                        }
                        
                    }
                    if(!is_membership){
                        document.getElementById("txt_title").innerHTML = "현재 이용중인 회원권이 없습니다.";
                    }

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
     });
    function listClick(index){
//        if(index >= 0)
//            location.href = "m_my_membership_holding.php";
//        for( var i = 0 ; i < membershiplist.length; i++){
//            var param_mbstype = "?mbstype="+encodeURIComponent(membershiplist[i].mbstype);
//            var param_couponid = "&couponid="+encodeURIComponent(membershiplist[i].id);
//            var param = param_mbstype + param_couponid;
//            GoToPage('./m_my_contract.php'+param,'null')
//        }
        
        
        var param_mbstype = "?mbstype="+encodeURIComponent(membershiplist[index].mbstype);
        var param_couponid = "&couponid="+encodeURIComponent(membershiplist[index].id);
        var param = param_mbstype + param_couponid;
        GoToPage('./m_my_contract.php'+param,'null')
            
    }
    
</script>

</body>
</html>


