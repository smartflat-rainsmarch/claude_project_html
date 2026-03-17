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
<title>내정보 보기</title>

<meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
 <script>
        if( /Android/i.test(navigator.userAgent)) {
           
                var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
        }else {
             var MetaTag = document.createElement("META");
                MetaTag.setAttribute('name', 'viewport');
                MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=0.5, maximum-scale=2.0, minimum-scale=0.5');
                document.getElementsByTagName('head')[0].appendChild(MetaTag);
        }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <link href="./css/modaldialog.css" rel="stylesheet">

<script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
<script src="js/scripts.js"></script>
    <style>
    body			{ background:#fff}
.container		{ min-width:100%; background:#fff }
.body			{ width:100%;background:#fff }
.container {
    width : 100%;
  height: 100%;
  position: relative;
/*  border: 3px solid green;*/
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  
}
.history_title {
  padding-top: 5%;
  color: b;
  text-align:center;
}

.my-button {

/*    width:100px;*/
    
    background-color: #f8585b;

    border: none;
    border-radius:10px;
    color:#fff;

    padding: 15px 0;

    text-align: center;
    padding-left: 20px;
    padding-right:20px;
    text-decoration: none;

    display: inline-block;

    font-size: 15px;

    margin: 4px;

    cursor: pointer;

}
.my-button:hover {
/*    background-color: blue;*/
    border-radius:10px;
}


</style>
    
    
    </head>

<body class="form-control" style="background:#222222;padding:3px" >

    <div id= "container" style="background:#222222; padding:20px" >
        <br>
        
        <div id= "history_title" class="history_title">
<!--        <h3 style="text-align:center" id="reservation_title"></h3><br>-->
<!--        <button class ="my-button" type="button" style="width:80%"><h3 id="txt_title" style="position:auto;margin-left:0">오늘 운동기록이 없습니다.</h3><h1 id ="txt_min" style="display:none;position:absolute; margin-left:0">24분</h1><h5 id ="txt_kcal" style="margin-top:10px;display:none;">100kcal</h5><h6 id ="txt_date" style="display:none;">2021-02-02</h6></button>-->
            
            
            <div style="padding:20px;background-image: linear-gradient(#fff7d1 0px, #ffffb0 100%);" >
                <text style="font-size:20px;color:#555555;font-weight:bold;" id ="txt_title">오늘 운동기록이 없습니다.</text><br>
                <text style="font-size:25px;font-weight:bold;color:#ee0000" id ="txt_min"></text>&nbsp;&nbsp;<text style="font-size:20px;font-weight:bold;color:#ee0000" id ="txt_kcal"></text><br>
                <text style="color:blue;font-size:15px" id ="txt_date"></text>
            </div>
            
        </div>
        <div id = "div_top_kcal" style="display:none">
            <img src ="./img/kcalup.png" style="width:30px;height:auto;margin-top:-20px"><span>&nbsp;&nbsp;&nbsp;<text style="color:white;font-size:30px;font-weight:bold;color:yellow">오늘최고 칼로리 등극!</text></span><br>
            <text style="color:white;font-size:20px;font-weight:bold;color:white">축하합니다.! 오늘칼로리를 소모하였습니다.</text>
        </div>
<!--
        <div id="div_membership_list" class="form-control" style="height:120px;">
            <h3 align="center">헬스 일반 : 헬스 3개월</h3>
            <h5 align="center">기간 : 2012.04.23 ~ 2020.04.06</h5>
            <h6 align="center" style="color:gray">홀딩기간 : 2012.04.23 ~ 2020.04.06</h6>            
-->
        
        <br>
        
        <hr style="border: solid 1px light-gray;">
        <br>
        <h5  style="position:auto;margin-left:0; color:white;">최근 운동기록</h5>
        
<!--
        <ul class="sub">
            <div>
                <image src = "./img/weightpart/abs.png" style="position:absolute"/>
                <il style="margin-left:100px;color:white">test2fdsafdsafdsafsa111</il><br>
                <il style="margin-left:100px;color:white">test2fdsafdsafdsafsa222</il><br>
                <il style="margin-left:100px;color:white">test2fdsafdsafdsafsa333</il><br>
                <il style="margin-left:100px;color:white">test2fdsafdsafdsafsa444</il><br>
                <il style="margin-left:100px;color:white">test2fdsafdsafdsafsa555</il><br>
                
            </div>
        </ul>
-->
        
    </div>

    
<script>
    var health_history = [];
    var before_index = -1;
     $( document ).ready(function() {
            var obj = new Object();
            obj.uid = "<?php echo $uid; ?>";
            obj.id = "<?php echo $id; ?>";
            obj.type = "<?php echo $type; ?>";
            
            CallHandler("my_health_history", obj, function(res) {
                clog("res is ",res);
                var code = parseInt(res.code);
                if (code == 100) {
                    var today = getToday();
                    
                    clog("today ",today);
                    
                    
                    
                    
        //            document.write(res.message);
                    var container = document.getElementById("container");
//                    var br0 = document.createElement('br');  
//                    container.appendChild(br0);
                    var jsonarray = res.message;
                    health_history = jsonarray;
                    clog("datas is ",jsonarray);
                    var is_membership = false;
                    
                    
                   
                    var top_cal = 0;
                    var today_totaltime = 0;
                    var today_totalkcal = 0;
                    var len = jsonarray.length;
                    for(var i = 0 ; i < len; i++){
                        var item = jsonarray[i];
//                        var totaltime = parseInt(item.total/(60*1000));
//                        var kcal = 1 * (totaltime/10) * 70; //평군 70으로 잡는다.
//                        if(today == item.date){//real
////                        if(i == 0){//test
//                            var txt_title = document.getElementById("txt_title");
//                            var txt_min = document.getElementById("txt_min");
//                            var txt_kcal = document.getElementById("txt_kcal");
//                            var txt_date = document.getElementById("txt_date");
//                            txt_min.style.display = "block";
//                            txt_kcal.style.display = "block";
//                            txt_date.style.display = "block";
//                            
//                            //간단공식 강도 * 시간 * kg = kcal
//                            //1mets * 시간 * 체중
//                            
//                            
//                            txt_title.innerHTML = "오늘 운동기록";
//                            txt_min.innerHTML = totaltime+"분";
//                            txt_kcal.innerHTML = kcal+"kcal";
//                            txt_date.innerHTML = item.start+" ~ "+item.end;
//                            
//                        }
                        
                        var machines = JSON.parse(jsonarray[i].machines);
                        var uidiv = document.createElement("div");
                        var arr = ["하체","힙","등","어깨","가슴","팔"];
                        var pngs =["foot.png","hip.png","back.png","shoulder.png","chest.png","arm.png"]; 
                        var img_idx = 0;
                        for(var a = 0 ; a < arr.length; a++){
                            if(item.weightpart.indexOf(arr[a]) >= 0){
                                img_idx = a;
                                break;
                            }
                        }
                        
                        uidiv.innerHTML+=  "<image src = './img/weightpart/"+pngs[img_idx]+"' style='position:absolute;padding:15px'/>";
                        var cnt = 0;
                        var day_total = 0;
                        var day_kcal = 0;
                        
                        machines.forEach(function(item, index,arr2){
                            var weightname = item.name;
                            var starttime = item.starttime;
                            var endtime = item.endtime;
                            var total = parseInt((item.endtime-item.starttime)/(60*1000));
                            day_total += total+1;
                            var kcal = 1 * (total/10) * 70; //평군 70으로 잡는다.
                            day_kcal += kcal; //평군 70으로 잡는다.
                            uidiv.innerHTML+= "<il style='position:absolute;margin-left:110px;margin-top:10px;font-size:14px;color:white;'>"+weightname+"    "+total+"분 "+kcal+"Kcal</il><br>"; //y style="background:#222; padding:20px" 
                            cnt++;
                        });
                        if(today == item.date){//real
//                        if(i == 0){   //test
                            today_totaltime = day_total;
                            today_totalkal = day_kcal; //평군 70으로 잡는다.

                            var txt_title = document.getElementById("txt_title");
                            var txt_min = document.getElementById("txt_min");
                            var txt_kcal = document.getElementById("txt_kcal");
                            var txt_date = document.getElementById("txt_date");
                           
                            txt_title.innerHTML = "오늘 운동기록";
                            txt_min.innerHTML = today_totaltime+"분";
                            txt_kcal.innerHTML = today_totalkal+"Kcal";
                            txt_date.innerHTML = item.start+" ~ "+item.end;                            
                        }
                        
                        
                        for(var j = cnt; j < 7; j++)
                            uidiv.innerHTML+= "<br>";

                        
                        var color = i%2 == 0 ? "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);": "background-image: linear-gradient(#fff7d1 0px, #fff1b0 100%);";
                        container.innerHTML+= "<div onclick='listClick("+i+")' ><button class='form-control' style='height:50px;"+color+"'><h6 align='left' style='position:absolute;font-size:16px;margin-top:6px'>"+(len-i)+"일차 "+item.date+"</h6><h6 align='right' style='font-size:15px;margin-top:8px' >총 운동시간 : "+day_total+"분</h6></button><ul class='sub"+i+"' style='display:none'><div style='background:#aaaaaa'>"+uidiv.innerHTML+"</div><h6 style='"+color+"padding:10px;font-size:14px;'>시간 : "+item.start+" ~ "+item.end+" , 운동부위 : "+item.weightpart+" , 소모 칼로리 : "+day_kcal+"Kcal</h6></ul><div>";

                        if(today != item.date && top_cal < day_kcal)top_cal;
                    }
                    //최고 칼로리 갱신
                    if(today_totalkcal > top_cal){
                        document.getElementById("div_top_kcal").style.display="block";
                    }

                } else {
                    alertMsg(res.message);
                }

            }, function(err) {
                alertMsg("네트워크 에러 ");
            });
     });
    function listClick(index){
        if(before_index != index && before_index != -1){
            if($(".sub"+before_index).is(":visible")){
                $(".sub"+before_index).slideUp(100);
            }           
        }
        
        if($(".sub"+index).is(":visible")){
            $(".sub"+index).slideUp(100);
            before_index = -1;
        }
        else{
            $(".sub"+index).slideDown(150);
            before_index = index;
        }
    }
   
     
</script>

</body>
</html>


