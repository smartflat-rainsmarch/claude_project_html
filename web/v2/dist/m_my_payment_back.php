<?php
include('./common.php'); 


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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="./css/modaldialog.css" rel="stylesheet">
    
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
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

    <div id='div_center_list' style='margin-top:40%'>
    </div>
    <div id="div_main" style="display:none">
    
        <div style="padding:20px;background-image: linear-gradient(#fff7d1 0px, #ffffb0 100%);" >
            <img src ='./img/arrow_l.png' style='position:absolute' onclick = "arrowClick(0)"/>
            <img src ='./img/arrow_r.png' align="right" style='position:auto;' onclick = "arrowClick(1)"/>
            <p align = "center" style="margin-top:10px"><text style="margin-left:50px;font-size:20px;color:#555555;font-weight:bold;" id ="txt_title">Payroll Data</text></p>

        </div>

        <div id = "container">

        </div>
        <div id = "id_nodata">
            <br>
            <p align = "center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></p>
        </div>
    </div>
<script>
    
    if( /Android/i.test(navigator.userAgent)){
            document.body.style.zoom = 0.5;
            document.body.style.scale = 0.5;    
    }
    
    
     var payroll_history = [];
     var before_index = -1;
     var payroll_setting = null;
     var now = new Date();
     var year = now.getFullYear();
     var month = now.getMonth() + 1;
     var now_groupcode = "<?php echo $groupcode ;?>";
     var now_centercode = null;
     var now_centername = null;
    
     var allpayments = [];
     $( document ).ready(function() {
            var div_center_list = document.getElementById("div_center_list");
            var div_main = document.getElementById("div_main");
            var centercodes = "<?php echo $centercodes ;?>";
           
         
            var _data = {
                    "type": "center", // group or center or auth
                    "group": now_groupcode
            };
            CallHandler("getdata", _data, function(res) {
                code = parseInt(res.code);
               
                if (code == 100) {
                    var centers = res.message;
                    var len = centers.length;
                    if(len == 1){
                        now_centercode = centers[0].centercode;
                        now_centername = centers[0].centername;
                        div_center_list.style.display = "none";
                        div_main.style.display = "block";
                        
                    }else if(len > 1){
                       
                        var top = len*30+100;
                        div_center_list.innerHTML = "<div style='width:100%;height:50px;background-color:white;margin-top:"+(-top)+"px;margin-bottom:50px'><h5 align='center'  style='padding:10px'>운영자용 매출현황</h5><div>";
                         for(var i = 0 ; i < len; i++){
                          
                            now_centercode = centers[i].centercode;
                            now_centername = centers[i].centername;
                            div_center_list.innerHTML += "<div align='center'><button class='btn btn-primary btn-raised' onclick='clickCenter(\""+now_centercode+"\")' style='background-color:#116666;padding:20px' >"+now_centername+"</button></div><br>";
                         }
                    }
                } else {
                      alertMsg("센터정보를 가져오는데 실패하였습니다. 다시시도해 주세요");
                }

            }, function (err) {
                alertMsg("네트워크 에러 ");
                
            });
         
       
//         getMyTranerHistory(year,month);
     });
    function clickCenter(centercode){
        div_center_list.style.display = "none";
        div_main.style.display = "block";
        showCenterPayment(centercode);      
    }
    function showCenterPayment(centercode){
        console.log("센터 매출현황을 보여준다.");
        var param_year = parseInt(getToday().substr(0,4));
       
         var value1 = {
            year : param_year,
            month : 0,
            day : 0
        }
        getPaymentData(now_groupcode,now_centercode,value1,function(res){
           if(res.code == 100){
               allpayments = res.message;
               console.log("allpayments  ",allpayments );
           }else{
               
               C_showToast("testid3", "에러", "데이터를 가져올 수 없습니다. 다시 시도하세요", function() {});
                
           }
            hideModalDialog();
        });
    }
      var sortType = 'asc';  
    // 테이블 헤더 클릭시 정렬 
    function sortContent(tableid,index) {
        console.log("tableid "+tableid+" index "+index);
        var table = document.getElementById(tableid);
        
       
        sortType = (sortType =='asc')?'desc' : 'asc';

        console.log("table[0].children ",table.tBodies[0].children);
        var checkSort = true;
        var rows = table.tBodies[0].children;

        while (checkSort) { // 현재와 다음만 비교하기때문에 위치변경되면 다시 정렬해준다.
            checkSort = false;

            for (var i = 0; i < (rows.length - 1); i++) {
//            for (var i = 0; i < rows.length; i++) {
                
                var innertext = rows[i].cells[index].innerHTML;
                var innertext_1 = rows[i + 1].cells[index].innerHTML;
               
                var fCell = innertext.toUpperCase();
                var sCell = innertext_1.toUpperCase();

                var row = rows[i];

                // 오름차순<->내림차순 ( 이부분이 이해 잘안됬는데 오름차순이면 >, 내림차순이면 <
                //                        이고 if문의 내용은 동일하다 )
                if ( (sortType == 'asc' && fCell > sCell) || 
                        (sortType == 'desc' && fCell < sCell) ) {

                    row.parentNode.insertBefore(row.nextSibling, row);
                    checkSort = true;
                }
            }
            
        }
    }
    //rows = users 고객들 데이타
    function createUsersTable(idx,rows,setting,total_getprice){
        
        //             document.getElementById("table_div").style.display = "block";
        var issetheaderpercent = false;
        var div  = document.createElement("div");
        var table = document.createElement("table");
        var tableid = "table_payroll_"+idx;
        table.border = "1";
        table.style.width = "100%";
        table.innerHTML = "<thead align='center'><tr style='background-color:#f8f9fa'><th style='padding:3px' onclick='sortContent(\""+tableid+"\",0)'>순번</th><th onclick='sortContent(\""+tableid+"\",1)'>등록일</th><th onclick='sortContent(\""+tableid+"\",2)'>이름</th><th onclick='sortContent(\""+tableid+"\",3)'>등록횟수</th><th onclick='sortContent(\""+tableid+"\",4)'>무료횟수</th><th onclick='sortContent(\""+tableid+"\",5)' >단가</th><th onclick='sortContent(\""+tableid+"\",6)' >퍼센트</th><th onclick='sortContent(\""+tableid+"\",7)' >이전남은횟수</th><th onclick='sortContent(\""+tableid+"\",8)' >진행횟수</th><th onclick='sortContent(\""+tableid+"\",9)'>남은횟수</th><th onclick='sortContent(\""+tableid+"\",10)'>금액</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;
        body.textAlign = "center";
        var total_nowusecount = 0; //이번달 총 강습한 횟수
//        var total_getprice = 0; //단가기준 전체금액
        var total_get_percent_price = 0; //퍼센트 적용 기준 전체금액
        var header_percent_idx = -1;
        var total_removeptcount = 0;
//        console.log("setting ",setting);
//        console.log("total_getprice "+total_getprice);
        if (len > 0) {
           
            
            //헤더부분 퍼센트를 삽입하기 위함            
            var hpercent = getPTPercent(setting,total_getprice,null); //check       
            for(var i = 0 ;i  < head.children[0].children.length;i++)
                if(head.children[0].children[i].innerHTML == "퍼센트")
                    head.children[0].children[i].innerHTML = hpercent+"%";
            
           
            for (var i = 0; i < len; i++) {
                var user = rows[i];
                if(idx==0 && i == 8)
                    console.log("user is ",user);
                var brow = body.insertRow();
                brow.align = "center";
                var user_custom_percent = user["custompercent"] ? parseInt(user["custompercent"]) : 0;
                var couponid = user.id;
                var uid = user.uid;
                var percent = getPTPercent(setting,total_getprice,user_custom_percent); //check
                
                
                var totalcount  = user["totalptcount"] ? parseInt(user["totalptcount"]) : 0;
                var freecount  = user["freecount"] ? parseInt(user["freecount"]): 0;
                var usecount = parseInt(user["totalusecount"]);
                var setprice = parseInt(user["setprice"]);
                
                var orner_addnowuseptcount = user["orner_addnowuseptcount"] && parseInt(user["orner_addnowuseptcount"]) >= 0 ? parseInt(user["orner_addnowuseptcount"]) : 0;
                var nowusecount = parseInt(user["nowusecount"])+orner_addnowuseptcount;
                
                var removeptcount = user["removeptcount"] ? parseInt(user["removeptcount"]) : 0;
                
//                total_removeptcount += removeptcount;
                var reservationcount = user["reservationcount"] ?  parseInt(user["reservationcount"]) : 0; //현재 예약승인(0값)인 상태횟수
                var totalremaincount = totalcount-usecount-removeptcount-reservationcount;
                var percent_price = parseInt((setprice*percent)/100); //퍼센트 적용한 단가
                var beforeremaincount = parseInt(user["beforeremaincount"]);
                var getprice = 0;
                var color = i%2 == 0 ? "#ffffdd": "#ddddff";
                
                var tcount = nowusecount+removeptcount;// 이번달진행횟수 +잔여세션승인횟수
                if(freecount > 0 && tcount > 0){
                    totalremaincount = totalremaincount+freecount;
                    
                    if(tcount >= freecount){
                        tcount = tcount - freecount;
                        freecount = 0;
                    }else{ //무료횟수가 이번달 이용횟수보다 크다.
                        freecount = freecount - tcount;
                        tcount = 0;
                    }                    
                }
                
                if(tcount < 0)tcount = 0;
                brow.style.backgroundColor = color;
                
                
                var orner_totalcount = user["orner_totalcount"] && parseInt(user["orner_totalcount"]) >= 0 ? parseInt(user["orner_totalcount"]) : -1;
                var orner_freecount = user["orner_freecount"] && parseInt(user["orner_freecount"]) >= 0 ? parseInt(user["orner_freecount"]) : -1;
                var orner_freecount_text = user["orner_freecount_text"] && parseInt(user["orner_freecount_text"]) >= 0 ? parseInt(user["orner_freecount_text"]) : -1;//무료최대(max)횟수
                var orner_1setprice = user["orner_1setprice"] && parseInt(user["orner_1setprice"]) >= 0 ? parseInt(user["orner_1setprice"]) : -1;
                var orner_percentprice = user["orner_percentprice"] && parseInt(user["orner_percentprice"]) >= 0  ? parseInt(user["orner_percentprice"]) : -1;
                var orner_beforeptcount = user["orner_beforeptcount"] && parseInt(user["orner_beforeptcount"]) >= 0  ? parseInt(user["orner_beforeptcount"]) : -1;
                var orner_nowuseptcount = user["orner_nowuseptcount"] && parseInt(user["orner_nowuseptcount"]) >= 0  ? parseInt(user["orner_nowuseptcount"]) : -1;
                var orner_remaincount = user["orner_remaincount"] && parseInt(user["orner_remaincount"]) >= 0  ? parseInt(user["orner_remaincount"]) : -1;
                
                if(isNaN(orner_totalcount))orner_totalcount = -1;
                if(isNaN(orner_freecount))orner_freecount = -1;
                if(isNaN(orner_1setprice))orner_1setprice = -1;
                if(isNaN(orner_percentprice))orner_percentprice = -1;
                if(isNaN(orner_beforeptcount))orner_beforeptcount = -1;
                if(isNaN(orner_nowuseptcount))orner_nowuseptcount = -1;
                if(isNaN(orner_remaincount))orner_remaincount = -1;
                
                //오너 최대등록횟수가 있으면 이전 남은횟수를 수정한다.
                if(orner_totalcount > 0)beforeremaincount = beforeremaincount + orner_totalcount - totalcount;
                
                var new_maxcount = orner_totalcount != -1 ? orner_totalcount : totalcount;
                var new_beforeremaincount = orner_beforeptcount != -1  ? orner_beforeptcount : beforeremaincount;
                var new_setprice = orner_1setprice != -1  ? orner_1setprice : setprice;
                var new_percent_price = orner_percentprice != -1  ? orner_percentprice : parseInt((new_setprice*percent)/100);
                percent_price = new_percent_price;
                var new_nowuseptcount = orner_nowuseptcount != -1  ? orner_nowuseptcount : tcount;
                
                getprice = new_percent_price*new_nowuseptcount;
                total_get_percent_price += getprice;
                
                total_removeptcount += removeptcount; //footer 최종 총횟수
                if(new_beforeremaincount-new_nowuseptcount < totalremaincount)
                    totalremaincount = new_beforeremaincount-new_nowuseptcount;
//                total_nowusecount += nowusecount+removeptcount;
                total_nowusecount += new_nowuseptcount;
                
                
                {
                    //남은횟수맞춤
                    totalremaincount = new_beforeremaincount - (new_nowuseptcount + removeptcount);   orner_remaincount = -1;                        
//                         console.log(" totalremaincount = "+ totalremaincount+ " new_beforeremaincount "+new_nowuseptcount+"");
                }
                if(totalremaincount < 0 )totalremaincount = 0;
                
                //순번
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = (i+1)+"";
                
                //등록일
                var bcell_starttime = brow.insertCell();
                bcell_starttime.innerHTML = user["id"]; //date id
                
                //이름
                var bcell_name = brow.insertCell();
                bcell_name.innerHTML = user["name"];
                bcell_name.style.padding = "3px";
                
                insert_cell(brow,"totalcount",couponid,uid,idx,i,totalcount,orner_totalcount,false);//등록횟수
//                var freetag = orner_freecount_text >= 0 ? "&nbsp;<text style='color:red;font-weight:bold;'>"+orner_freecount_text+"/</text>" : "";
                insert_cell(brow,"freecount",couponid,uid,idx,i,freecount,orner_freecount,false,orner_freecount_text);//무료횟수
//                insert_cell(brow,"freecount",couponid,uid,idx,i,freecount,orner_freecount,false);//무료횟수
                insert_cell(brow,"1setprice",couponid,uid,idx,i,setprice,orner_1setprice,true);//단가
                insert_cell(brow,"percentprice",couponid,uid,idx,i,percent_price,orner_percentprice,true);//퍼센트가격
                insert_cell(brow,"beforeptcount",couponid,uid,idx,i,beforeremaincount,orner_beforeptcount,false);//이전남은횟수
//                 var addtag = removeptcount > 0 ? "&nbsp;<text style='color:red;font-weight:bold;'>("+removeptcount+")</text>" : "";
                 var addnum = removeptcount > 0 ? removeptcount : "";
                insert_cell(brow,"nowuseptcount",couponid,uid,idx,i,tcount,orner_nowuseptcount,false,addnum);//이번달진행횟수
                insert_cell(brow,"remaincount",couponid,uid,idx,i,totalremaincount,orner_remaincount,false);//전체남은횟수
 
                //획득금액      
                var bcell_getprice = brow.insertCell();
                bcell_getprice.innerHTML = "￦"+CommaString(getprice)+"";
                bcell_getprice.style.padding = "3px";

            }
            
        }
        div.appendChild(table);
        var resturndata = {"tag":div.innerHTML, "totalnowusecount":total_nowusecount, "totalgetprice":total_get_percent_price, "totalremoveptcount":total_removeptcount};
        return resturndata;

    }
    function insert_cell(brow,cellname,couponid,uid,idx,i,_default_value,_orner_value,isicon,_addnum){
        //var freeaddtag = _addnum && cellname == "freecount" ? _addnum : "";
        var freeaddtag = cellname == "freecount" && _addnum && parseInt(_addnum) != -1 ? "&nbsp;<text style='color:red;font-weight:bold;'>"+_addnum+"/</text>" : "";
        var addtag = _addnum && cellname != "freecount"  ? _addnum : "";
//        console.log(couponid+" _orner_value ",_orner_value);
         if(cellname == "nowuseptcount" && _addnum)
            addtag = "&nbsp;<text style='color:red;font-weight:bold;'>(" + _addnum + ")</text>";
        
        if(isNaN(_orner_value)){
            _orner_value = "-1";
        }
        var default_value = isicon ? CommaString(_default_value) : _default_value;
        var orner_value =  isicon ? CommaString(_orner_value) : _orner_value;
        var icon = isicon ? "" : "";
        //등록횟수 총횟수
        var bcell = brow.insertCell();
//        cellname = "totalcount";
        var tvalue = default_value; //기본값
        var nvalue = "";
        var ivalue = _default_value; //기본값
         if(_orner_value+"" != "-1"){
            tvalue = "<del>"+default_value+"</del>";  //default value
            nvalue = orner_value; //오너설정값    new value
            ivalue = _orner_value; //오너 설정값  input value 
        }
        
        bcell.innerHTML = freeaddtag+"<text id='text_"+cellname+"_"+idx+"_"+i+"' style='align:center;width:100%;'>"+icon+tvalue+"</text>&nbsp;<text id='ctext_"+cellname+"_"+idx+"_"+i+"' style='align:center;width:100%;color:blue;font-weight: bold;'>"+icon+nvalue+"</text>"+addtag;
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
        getMyTranerHistory(year,month);
        
    }
    function listClick(index){
        
        if(before_index != index && before_index != -1){
            if($(".sub"+before_index).is(":visible")){
//                $(".sub"+before_index).slideUp(100);
            }           
        }
        
        if($(".sub"+index).is(":visible")){
//            $(".sub"+index).slideUp(100);
            before_index = -1;
        }
        else{
            console.log("down ");
            $(".sub"+index).slideDown(150);
            before_index = index;
        }
    }
    function allListOpen(len){
       for(var i =0 ; i < len; i++)
            $(".sub"+i).slideDown(150);
    }
     
</script>

</body>
</html>


