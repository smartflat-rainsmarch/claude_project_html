<style>
    /* 221012 유진 수정 */
    .title_box {
        display: flex;
        justify-content: space-between;
        width: 1260px;
        height: auto;
        padding-bottom: 13px;
        background-color: #ffffff;
        border: 1px solid #eff2f5;
        border-radius: 10px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
    }
    .title_box_text {
        margin-top: 20px;
        margin-left: 30px;
        font-size: 18px;
        color: #181c32;
        text-align: left;
        font-weight: 700;
    }
    .modi_all {
        width: 1260px;
        padding: 0;
        border: 1px solid #eff2f5;
        border-radius: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 5%);
        background-color: #fff;
    }
    .year_month{
        background-color: #fff8dc;
        border-top: 1px solid #f0ead4;
        border-bottom: 1px solid #f0ead4;
        height: 52px;
        width:97%;
        margin: 0 auto;
        margin-top: 30px;
    }
    .sub_title{
        width: 100%;
        background-color: #f0f6fa;
    }
    .open_btn{
        float: right;
        width: 90px;
        border: 0px;
        height: 35px;
        border-radius: 5px;
        background-color: rgb(0, 158, 247);
        font-size: 14px;
        color: rgb(255, 255, 255);
        text-align: center;
        font-weight: 700;
    }
    .close_btn{
        float: right;
        width: 90px;
        border: 0px;
        height: 35px;
        border-radius: 5px;
        background-color: rgb(0, 158, 247);
        font-size: 14px;
        color: rgb(255, 255, 255);
        text-align: center;
        font-weight: 700;
    }
    .col_title{
        font-size: 16px;
    }
    .table td {
        vertical-align: center !important;
    }
</style>
    <!--221011 유진 수정-->
<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
    <div class="reservation_center" style='padding:5px'>
        <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >수정기록</text>
        <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
        
        <div class="year_month" >
            <img src ='./img/button_prev_yellow.png' style='float:left; margin-left: 5px; margin-top: 3px; cursor: pointer;' onclick = "arrowClick(0)"/>
            <img src ='./img/button_next_yellow.png' style='float:right; margin-right: 5px; margin-top: 3px; cursor:pointer;' onclick = "arrowClick(1)"/>
            <div align = "center" style="margin-top:10px"><text style="margin-left:10px;font-size:20px;color:#555555;font-weight:bold;" id ="txt_title"></text>&nbsp;&nbsp;</div>
            <div align = "center" style="margin-top:25px"><button id='btn_allopen' class="open_btn" onclick='allOpen()' >전체오픈</button><button id='btn_allclose' class="close_btn" onclick='allClose()' style='display:none' >전체닫기</button></div>
        </div>
        <div style="height:auto;">
            <div id = "container">

            </div>
        </div>
    </div>
    <div id = "id_nodata" style="margin-top: 50px; margin-bottom: 50px;">
            <br>
            <div align = "center" style="margin-top:30px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
        </div>

</div>
<script>
     var ornerview_history = [];
     var before_index = -1;
     var payroll_setting = null;
     var now = new Date();
     var year = now.getFullYear();
     var month = now.getMonth() + 1;
     var centercode = getData("nowcentercode");
     var openlist = [];
     var alllist = [];
     
     $( document ).ready(function() {
         
     });
    
    function init_d_apploginlog(key){
        clog("getOrnerViewLogHistory !!");
        now = new Date();
         year = now.getFullYear();
         month = now.getMonth() + 1;
         getOrnerViewLogHistory(year,month);
    }
    function getOrnerViewLogHistory(year,month){
        
       
         
            document.getElementById("txt_title").innerHTML = year+"년 "+month+"월";
            /* 221011 유진 수정 */
            getAppLoginLogData(year,month,function(res) {
                clog("res is ",res);
                var container = document.getElementById("container");
                container.innerHTML = "";
                container.style.marginTop='60px';
                //container.style.height = '1600px';
                var code = parseInt(res.code);
                if (code == 100) {

                    
                    container.innerHTML = ""; //초기화
                    ornerview_history = res.message;
                    var isdata = false;
                   
                       
                        
                       
                       
                        //먼저 일수를 가져온다.
                        var days = getmonthdays(ornerview_history);
                        alllist = days;
                        var mdiv = document.createElement("div");
                        var other_div = document.createElement("div");
                        other_div.style.backgroundColor = "#ffffff";
                        //other_div.style.border="1px solid #717c7a";
                        other_div.style.cssText = "border-radius:10px; border-top-left-radius:0px; border-top-right-radius: 0px; border:none; font-size: 20px; margin-bottom: 25px;";
                        //mdiv.style.height = other_div.id.style.height;
                        for(var i = 0 ; i < days.length; i++){
//                            clog("i is "+i);
                            isdata = true;
                            var row = days[i];
                            var table_data = getOrnerViewLogTable(row.datas);
//                            clog(i+" table_data "+table_data);
                            var color = "background-image: linear-gradient(rgb(255, 255, 255) 0px, rgb(230, 230, 230) 100%);";
                            var ptitle = "";
                            ptitle="<text class='sub_title' style='line-height:58px;color:black;margin-left:15px;'>"+row.day+"일</text>";
                            //ptitle="<text class='sub_title' style='float:left;width:100%;color:blue;padding:10px;'>"+row.day+"일</text>";
                            //other_div.innerHTML+= "<div onclick='listClick("+i+")' style='width:97%; background-color: #c3d9ec; height: 60px; margin:0 auto;'>"+ptitle+"</div><ul class='sub"+i+"' style='display:none'><div style='background:#aaaaaa'>"+table_data+"</div><br></ul></div></div>";                            
                            other_div.innerHTML+= "<div class='lists_"+i+" lists' onclick='listClick("+i+")' style='width:97%; background-color: #f0f6fa; margin:0 auto; border: 1px solid #e4e6ef; border-radius: 10px; cursor:pointer;'>"+ptitle+"</div><ul class='sub"+i+"' style='display:none'><div>"+table_data+"</div><br></ul></div></div>";
                        }                            
                        
                        mdiv.append(other_div);
                        container.append(mdiv);
                        
//                        allListOpen(jsonarray.length);
                        
                    }
                    var id_nodata = document.getElementById("id_nodata");
                    id_nodata.style.display = isdata ? "none" : "block";
                    
                    
                    checkOpenList(year,month);

                
            });
    }
    
    function getOrnerViewLogTable(rows){
        if(!rows)return "<h3>목록이 없습니다.</h3>";
        rows.sort(sort_by('date', true, (a) => a.toUpperCase()));
        var div_log_table =document.createElement("div");
        var table = document.createElement("table");
        div_log_table.appendChild(table);

        table.border = "1"; //테두리랑
        table.style.width = "97%";
        table.style.margin = '0 auto';
        table.id = "AllLogDataTable";
        table.className="table table-bordered";
        /* 221012 유진 수정 */
        table.innerHTML = "<thead><tr style='height:30px;background-image:linear-gradient(to bottom, #dff0d8 0px, #c8e5bc);font-size:12px;text-align:center;' align='center' ><th class='col_title' style='margin:10px;min-width:170px;background-color: #f8f9fa; border:1px solid #e4e6ef;'>날짜</th><th class='col_title' style='margin:10px;min-width:70px;background-color: #f8f9fa; border:1px solid #e4e6ef;'>수정인</th><th class='col_title' style='margin:10px;min-width:120px;background-color: #f8f9fa; border:1px solid #e4e6ef;'>이름[아이디]</th><th class='col_title' style='margin:10px;min-width:150px;background-color: #f8f9fa; border:1px solid #e4e6ef;'>타이틀</th><th class='col_title' style='width:100%;background-color: #f8f9fa; border:1px solid #e4e6ef;'>내용</th></tr></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];

        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;
        if (len > 0) {
            var beforepaymentid = "";
            var isbeforesame = false;
            for (var i = 0; i < len; i++) {
                var brow = body.insertRow();
                brow.align = "center";
                brow.style.padding= "10px";
                brow.style.height = "30px";
                brow.style.backgroundColor = "white";

                var message_isjson = rows[i].messagetype == "json" ? true : false;
                var message = "";
                if(message_isjson){
                    var jsondata = JSON.parse(rows[i].message);

                    var coupontype = {"T":"기간제", "G":"그룹",  "C":"횟수제", "U":"알수없음", "L":"라커", "TL":"기간제 + 라커", "R":"환불"};    
                    var paymenttype = {"0":"무료","1":"카드","2":"현금","3":"환불","4":"카드 + 현금"};
                    var str_retake =   jsondata.pm_retake == "Y" ? "Yes" : "No";
                    var registtime = jsondata.pm_date ? jsondata.pm_date : jsondata.couponid;

                    var json_remain = jsondata.pm_pay_remainprice ? JSON.parse(jsondata.pm_pay_remainprice) : 0;
                    var str_remain = "";
                    if(json_remain)str_remain = parseInt(json_remain.remain) == 0 ? "없음" : CommaString(json_remain.remain);

                    message = coupontype[jsondata["pm_coupontype"]]+" 등록일 : "+registtime+", 내용: "+jsondata["pm_desc"]+", 결제방법 : "+paymenttype[jsondata["pm_paymenttype"]+""]+", 재수강 유무 : "+str_retake+", 기간 "+jsondata["pm_starttime"]+" ~ "+jsondata["pm_endtime"]+", 기간제가격 : "+jsondata["pm_pay_termtype"]+", 횟수제가격 : "+jsondata["pm_pay_counttype"]+", 라커가격 : "+jsondata["pm_pay_locker"]+", 미수금 : "+str_remain+", 총금액 : "+jsondata["pm_total_pay"]+", 특이사항 : "+jsondata["pm_memo"];


                    
                }else {
                    message = rows[i].message;
                    
                }
                message = ornerMessageAccentCheck(message);
                
                brow.innerHTML += "<td>"+rows[i].date+"</td>";  //날짜 
                //var tag_constructor = rows[i].constructorname && rows[i].constructorid ? rows[i].constructorname+"["+rows[i].constructorid+"]" : "-"; 
                var tag_constructor = rows[i].constructorname && rows[i].constructorid ? rows[i].constructorname : "-";
                brow.innerHTML += "<td>"+tag_constructor+"</td>"; //수정인
                brow.innerHTML += "<td style='background-color:#e1ece9;'><button  class='btn btn-primary btn-raised'  onclick='showUserInfoPopup("+rows[i].userid+")'>"+rows[i].username+"["+rows[i].userid+"]</button</td>"; //이름[아이디]
                brow.innerHTML += "<td>"+rows[i].title+"</td>"; //타이틀
                brow.innerHTML += "<td>"+message+"</td>";//내용


            }
        }


    //    clog("div_log_table.innerHTML ",div_member_table.innerHTML);
        return div_log_table.innerHTML;  

    }
    function ornerMessageAccentCheck(message){
        var b1msg = message.match(/\((.*?)\)/g);
        if(message.indexOf("더미입력") >= 0){
            var arr =  message.split(",");
            
            
            if(arr.length > 1){
                message = "<text style='font-weight:bold;background-color:#ffcccc;padding:5px'>"+arr[0]+"</text>";
                for(var i = 1 ; i < arr.length; i++){
                    message += arr[i];
                }
            }
                
            
        }else if(b1msg && message.indexOf("수정 :") >= 0){
            message = message.replace(b1msg,"<text style='font-weight:bold;background-color:#ffcccc;padding:5px'>"+b1msg+"</text>");
        }else{
            
        }
        return message;
        
    }
    function getmonthdays(datas){
        var days = [];
        for(var i = 0 ; i < datas.length; i++){
            var row = datas[i];
            var day = stringGetDay(row.date)+"";
            
            if(!isinday(days,day)){
                days.push({"day":day,"datas":[]});
            }
            
            for(var j = 0 ; j < days.length;j++){
                if(days[j].day == day){
                    days[j].datas.push(row);
                    break;
                }
            }
        }
//        clog("days ",days);
        return days;
    }
    function isinday(days,day){
        var isin =false;
         for(var j = 0 ; j < days.length;j++){
                if(days[j].day == day){
                    isin = true;
                    
                    break;
                }
            }
        return isin;
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
        
        getOrnerViewLogHistory(year,month);
        
    }
   
    function listClick(index){
        
//        if(before_index != index && before_index != -1){
//            if($(".sub"+before_index).is(":visible")){
//                $(".sub"+before_index).slideUp(100);
//            }           
//        }
        /* 221012 유진 수정 */
        if($(".sub"+index).is(":visible")){
            $(".sub"+index).slideUp(100);
            before_index = -1;
            list_open(index,false);
            $(".lists_"+index).animate({
                'border-bottom-left-radius': '10px',
                'border-bottom-right-radius': '10px'
            },100);
        }
        else{
//            clog("down ");
            $(".sub"+index).slideDown(150);
            before_index = index;
            list_open(index,true);
            $(".lists_"+index).animate({
                'border-bottom-left-radius': '0px',
                'border-bottom-right-radius': '0px'
            },150);
        }
    }
    function list_open(index,isopen){
        
        if(isopen){
            var data = {"year":year,"month":month,"index":index};
        
            var isin = false;
            for(var i = 0 ; i < openlist.length; i++){
                if(openlist[i].year == year && openlist[i].month == month && openlist[i].index == index){
                    isin = true;
                    break;
                }
            }
            if(!isin)
                openlist.push(data);
        }else{
            
            var popindex = -1;
            for(var i = 0 ; i < openlist.length; i++){
                if(openlist[i].year == year && openlist[i].month == month && openlist[i].index == index){
                    popindex = i;
                    break;
                }
            }
            if(popindex >= 0)
                openlist.splice(popindex,1);
        }
        
//        clog("openlist is ",openlist);
    }
    function checkOpenList(year,month){
        for(var i = 0 ; i < openlist.length; i++){
           if(openlist[i].year == year && openlist[i].month == month){
               $(".sub"+openlist[i].index).slideDown(150);
           }
        }
    }
    function allListOpen(len){
       for(var i =0 ; i < len; i++)
            $(".sub"+i).slideDown(150);
    }
   function allListClose(len){
       for(var i =0 ; i < len; i++)
            $(".sub"+i).slideUp(100);
    }
    function allOpen(){
        var btn_allopen = document.getElementById("btn_allopen");
        var btn_allclose = document.getElementById("btn_allclose");
        $(".lists").animate({
                'border-bottom-left-radius': '0px',
                'border-bottom-right-radius': '0px'
            },100);
        btn_allopen.style.display = "none";
        btn_allclose.style.display = "block";
        allListOpen(alllist.length);
    }
     function allClose(){
        var btn_allopen = document.getElementById("btn_allopen");
        var btn_allclose = document.getElementById("btn_allclose");
        $(".lists").animate({
                'border-bottom-left-radius': '10px',
                'border-bottom-right-radius': '10px'
            },100);
        btn_allopen.style.display = "block";
        btn_allclose.style.display = "none";
        allListClose(alllist.length);
    }
</script>