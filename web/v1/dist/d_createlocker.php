<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div class="reservation_center" style='padding:5px'>
            <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >라커 만들기</text>
			
			<span style="float:right;margin-top:5px">
			 <button id='btn_insertlocker' class='btn btn-primary btn-raised'  onclick="insert_locker()" style='display:none'>+ 라커패턴 삽입</button>
			</span>
			<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">


            <br>
            <div id="container" style="width:100%;height:auto">
            </div>
            <br>
            <div align='right'><button id ="btn_alllocker" class='btn btn-primary btn-raised'  onclick="create_alllockers()" style="font-size:14px;background-color:#007bff;display:none;border:0px">전체라커 적용하기</button><br></div>
    </div>
</div>
<style>
    /* 221006 유진 수정  */
    .set_title{
        width: 100%;
        margin-bottom: 1px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        line-height: 2em;
        padding: 0 0.75em;
        font-size: 1em;
        border: 1px solid #e4e6ef;
        background-color: #eeeeee;
        color: black;
        background-color: #f5f8fa;
        border-radius: 5px;
    }
    /* 221006 유진 수정  */
    .createlocker_desc_input{
        width:60px;
        height:24px;
        font-size:12px; 
        /*margin-top:35px;*/
        border: 1px solid #d9dced; 
        border-radius: 5px; 
        /*margin-left: -0.25em;*/ 
        background-color: white;

    }
</style>
<script>
    console.log("createlocker!!");
    var lockers = alllocker ? alllocker : [];
    var offset = 0;
    getAllLocker(getData("nowcentercode"),function(all_locker){
        lockers = all_locker;
        initLockerTable();
    })
    
    function init_d_createlocker(value){
        console.log("maininit testpage");
        var btn_insertlocker = document.getElementById("btn_insertlocker");
        
        if(auth >= AUTH_OPERATOR)
            btn_insertlocker.style.display = "block";
        else 
            btn_insertlocker.style.display = "none";
        
        
    }
    
    function insert_locker(){
        
       setTutorialStatus(TS._10_INSERTLOCKERDATA);
        
        
        var title = "라커뭉치 생성하기";
        var message = "<div>"+
                            "<table style='width:100%'>"+
                                "<tr>"+
                                /* 221005 유진 수정 */
                                    "<td  style='width:25%'>"+
                                        "<label for='authlevel' class='set_title'>*1달가격</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label for='centercode' class='set_title'>*1일가격</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label for='centercode' class='set_title'>*가로개수</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label for='centercode' class='set_title'>*세로개수</label>"+
                                    "</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td >"+
                                        "<input class='form-control' id='lockerprice_month' type ='text' value ='10,000' style='width:100%' onfocus='this.select()'  onkeyup='inputChangeComma(\"lockerprice_month\")' />"+
                                    "</td>"+
                                    "<td >"+
                                        "<input class='form-control' id='lockerprice_day' type ='text' value='400' style='width:100%' onfocus='this.select()'  onkeyup='inputChangeComma(\"lockerprice_day\")'/>"+
                                    "</td>"+
                                    "<td >"+
                                        "<input class='form-control' id='locker_land_num' type ='number' value ='0' style='width:100%' onfocus='this.select()' onchange='updateLockerTable()'/>"+
                                    "</td>"+
                                    "<td >"+
                                        "<input class='form-control' id='locker_port_num' type ='number' value='0' style='width:100%' onfocus='this.select()' onchange='updateLockerTable()'/>"+
                                    "</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td  style='width:25%'>"+
                                        "<label for='authlevel' class='set_title'>*라커시작숫자</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label for='centercode' class='set_title'>*라커방향설정</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        "<label for='centercode' class='set_title'>*라커성별설정</label>"+
                                    "</td>"+
                                    "<td  style='width:25%'>"+
                                        //"<label for='centercode' class='textevent'></label>"+
                                    "</td>"+
                                "</tr>"+
                                "<tr>"+
                                    "<td >"+
                                        "<input class='form-control' id='locker_offset' type ='text' value='"+(lockerlastnum+1)+"' style='width:100%' onfocus='this.select()'  onkeyup='inputChangeComma(\"lockerprice_day\")' onchange='updateLockerTable()'/>"+
                                    "</td>"+
                                    "<td >"+
                                        "<select id='locker_type' onchange='updateLockerTable()' class='form-control'>"+
                                            "<option value ='DOWN_RIGHT' >좌측상단 : 아래 오른쪽(↓→)</option>"+
                                            "<option value ='RIGHT_DOWN'>좌측상단 : 오른쪽 아래(→↓)</option>"+
                                            "<option value ='UP_RIGHT'>좌측하단 : 위 오른쪽(↑→)</option>"+
                                            "<option value ='RIGHT_UP'>좌측하단 : 오른쪽 위(→↑)</option>"+
                                            "<option value ='DOWN_LEFT'>우측상단 : 아래 왼쪽(↓←)</option>"+
                                            "<option value ='LEFT_DOWN'>우측상단 : 왼쪽 아래(←↓)</option>"+
                                            "<option value ='UP_LEFT'>우측하단 : 위 왼쪽(↑←)</option>"+
                                            "<option value ='LEFT_UP'>우측하단 : 왼쪽 위(←↑)</option>"+
                                        "</select>"+
                                    "</td>"+
                                    "<td >"+
                                        "<select id='locker_gender' onchange='updateLockerTable()' class='form-control'>"+
                                            "<option value ='U'>공용</option>"+
                                            "<option value ='M'>남자</option>"+
                                            "<option value ='F'>여자</option>"+
                                            
                                        "</select>"+
                                    "</td>"+
                                    "<td >"+
                                       // "<input class='form-control' id='locker_ccc' type ='number' value ='' style='width:100%' onfocus='this.select()' onchange='updateLockerTable()' disabled/>"+
                                    "</td>"+
                                    
                                "</tr>"+
                            "</table>"+
                        "</div>"+
                        //"<br>"+
                        /* 221005 유진 수정 */
                        //"<hr style='border: solid 1px light-gray;'>"+
                        //"<br>"+
                        "<div id='update_locker_container_"+lockers.length+"'>"+                           
                        "</div>";
            
          
        
        
         var style = {
                bodycolor: "#eeeeee",
                size: {
                    width: "1260px",
                    height: "100%"
                }
            };
        showModalDialog(document.body, title, message, "만들기", "취소", function() {
//            var container = document.getElementById("container");
//            var locker_container = document.getElementById("locker_container_"+lockers.length);
//            var btn_alllocker = document.getElementById("btn_alllocker");
//
//            lockers.push(making_locker_json);
//            container.append(locker_container);
//            hideModalDialog();
//            if(lockers.length > 0)
//                btn_alllocker.style.display = "block";
//            else 
//                btn_alllocker.style.display = "none";
            
            lockers.push(making_locker_json);
            initLockerTable();
            default_lockerjson_data = [];
            hideModalDialog();
            setTutorialStatus(TS._11_SENDCOUPONPRICE);
        }, function() {
            //setTutorialStatus(TS._9_CREATELOCKER);//real
            setTutorialStatus(TS._11_SENDCOUPONPRICE);//test
            hideModalDialog();
        },style);
    }
    var making_locker_json = null;
    var updates = [];
    function updateLockerTable(){
        updates = [];
        console.log("updateLockerTable");
        var locker_container = document.getElementById("update_locker_container_"+lockers.length);
        var lockerprice_month = document.getElementById("lockerprice_month");
        var lockerprice_day = document.getElementById("lockerprice_day");
        var locker_land_num = document.getElementById("locker_land_num");
        var locker_port_num = document.getElementById("locker_port_num");
        var locker_type = document.getElementById("locker_type");
        var locker_gender = document.getElementById("locker_gender");
        var locker_offset = document.getElementById("locker_offset");
        var update_max_len = 0;
        //가로세로 갯수가 입력되었다면
        if(parseInt(locker_land_num.value) > 0 && parseInt(locker_port_num.value) > 0){
            var json = create_lockerdata(lockerprice_month.value,lockerprice_day.value,locker_land_num.value,locker_port_num.value,locker_type.value,locker_gender.value,locker_offset.value);
            making_locker_json = json;
            console.log("json",json);
            
            var gender_type = [{"gender":"M","color":"#5a5aff99"},{"gender":"F","color":"#ff5a5a99"},{"gender":"U","color":"#e9e9e999"}];
            var gtype = gender_type[2];
            for(var j = 0 ; j < gender_type.length; j++){
                if(json.gender && json.gender == gender_type[j].gender){
                    gtype = gender_type[j];
                    break;
                }
            }
            
            var title_div = document.createElement("div");
            title_div.id = "making_locker_title_"+lockers.length;
             /* 221005 유진 수정 */
             title_div.innerHTML = "<h3 class='textevent' style='background-image: url(./img/bg_locker_titlebar.png);border-top-left-radius: 10px; border-top-right-radius: 10px; color: white; padding-top: 15px; padding-bottom: 40px; background-image: url(./img/bg_locker_titlebar.png); width: 100%; height: 50px; border: 0px; background-size: 100% 100%; text-align: center;' >"+get_gender_icontag(json.gender)+"&nbsp;&nbsp;&nbsp;" + json.id + "</h3>";
            var lockertable = create_lockertable(lockers.length,"update_locker_container_"+lockers.length,title_div.id,json.data,0,"updatelocker");
            updates.push(lockertable);
            var max_tad = getUpdateMaxTd(lockertable);
            if(max_tad > update_max_len)update_max_len = max_tad;
            console.log(lockertable);
            lockertable.style.margin = "auto";
            lockertable.style.textAlign = "center";  
            //lockertable.style.marginTop = '20px'; 
            locker_container.innerHTML = "";
            locker_container.appendChild(title_div);
            locker_container.appendChild(lockertable);
            
            var gender_color = {"M":"#8181e4","F":"#e48181","U":"d7d7d7"};
            locker_container.style.backgroundColor = gender_color[locker_gender.value];
            /* 221005 유진 수정 */
            locker_container.style.cssText = " padding-bottom: 15px; border-radius: 10px; background-color:rgb(29,29,30); margin-top: 10px;";
            
        }
        setUpdateTableZoom(update_max_len);
    }
    var lockertables = [];
    function initLockerTable(){
        lockertables = [];
        
        console.log("initLockerTable",lockers);
        var container = document.getElementById("container");
        var locker_container = document.createElement("div");
        var locker_max_len = 0;
        
        if(lockers.length > 0 && lockers[0]){
            for (var i = 0 ;i  < lockers.length; i++){
                
                locker_container.id="locker_container_"+i;

                
                var json = lockers[i];
                
                
                console.log("json",json);

                var gender_type = [{"gender":"M","color":"#5a5aff99"},{"gender":"F","color":"#ff5a5a99"},{"gender":"U","color":"#e9e9e999"}];
                var gtype = gender_type[2];
                for(var j = 0 ; j < gender_type.length; j++){
                    if(json.gender && json.gender == gender_type[j].gender){
                        gtype = gender_type[j];
                        break;
                    }
                }

                var title_div = document.createElement("div");
                /*221005 유진 수정*/
                title_div.style.marginTop = '20px';
                title_div.style.padding = '10px';
                title_div.id = "making_locker_title_"+i;
                /*221005 유진 수정*/
                title_div.innerHTML = "<h3 class='textevent' style='border-top-left-radius: 10px; border-top-right-radius: 10px; color:white; background-color: rgb(29, 29, 30); padding-top: 15px; padding-bottom: 40px; background-image: url(./img/bg_locker_titlebar.png); width: 100%; height: 50px; border: 0px; background-size: 100% 100%; text-align: center;' >"+get_gender_icontag(json.gender)+"&nbsp;&nbsp;&nbsp;" + json.id + "</h3>";
                
                var lockertable = create_lockertable(i,"locker_container_"+i, title_div.id, json.data,1,"createlocker");
                lockertables.push(lockertable);
                var max_td = getMaxTd(lockertable);
                if(max_td > locker_max_len)locker_max_len = max_td;
                
                console.log(i+" lockertable",lockertable);
                lockertable.style.margin = "auto";
                lockertable.style.textAlign = "center";   
                lockertable.style.marginTop = '30px';
                locker_container.appendChild(title_div);
                locker_container.appendChild(lockertable);

                var gender_color = {"M":"#8181e4","F":"#e48181","U":"d7d7d7"};
                locker_container.style.backgroundColor = gender_color[json.gender];
                /*221005 유진 수정*/
                locker_container.style.cssText = "border-radius : 10px; padding-bottom: 30px; margin-bottom: 20px; background-color:rgb(29,29,30); ";
            }
            setTableZoom(locker_max_len);
        }
        container.append(locker_container);
        
        if(auth >= AUTH_OPERATOR){
            var btn_alllocker = document.getElementById("btn_alllocker");
            if(lockers.length > 0)
                btn_alllocker.style.display = "block";
            else 
                btn_alllocker.style.display = "none";    
        }
        
    }
    function setTableZoom(maxlen){
        var default_tablewidth = 1202;
        var locker_width = 78; //변경됨
     
        var zoom = 1202/((maxlen+1)*locker_width);
        
        setZoomLockers(lockertables,zoom);
           
           
    }
    function setZoomLockers(lockertables,zoom){
        var lockerboxs = document.getElementsByClassName("createlocker_box");
        var createlocker_desc_input = document.getElementsByClassName("createlocker_desc_input");
       
        var lockerboxinterval = setInterval(function(){
            if(lockerboxs.length > 10){
                clearInterval(lockerboxinterval);
                 for (var i = 0; i < lockerboxs.length; i++) {
                     /* 221110 유진 수정 */
                     var boxwidth = parseInt(lockerboxs[i].style.width);
                     var boxheight = parseInt(lockerboxs[i].style.height);
                     var bwidth = boxwidth*zoom;

                     lockerboxs[i].style.width = boxwidth*zoom+"px";
                     lockerboxs[i].style.height = boxheight*zoom+"px";
                     lockerboxs[i].style.maxWidth = "80px";
                     lockerboxs[i].style.maxHeight = "100px";
                    

                     var inputwidth = createlocker_desc_input[i] ? parseInt(createlocker_desc_input[i].style.width) : 0;
                     var inputheight = createlocker_desc_input[i]  ? parseInt(createlocker_desc_input[i].style.height) : 0;
                     /* 221011 유진 수정 */
                     if(createlocker_desc_input[i]){
                        createlocker_desc_input[i].style.maxWidth = "60px";
                        createlocker_desc_input[i].style.maxHeight = "30px";
                        createlocker_desc_input[i].style.width = inputwidth*zoom+"px";
                        createlocker_desc_input[i].style.height = inputheight*zoom+"px";
                     }
                }
            }
        });
    }
    function getMaxTd(table){
        var rows = table.getElementsByTagName("tr");
        // tr만큼 루프돌면서 컬럼값 접근
        var max_td = 0;
        for( var r=0; r< rows.length; r++ ){
          var cells = rows[r].getElementsByTagName("td");
            if(cells.length > max_td)max_td = cells.length;            
        }
        return max_td;
    }
/* 221007 유진 추가 */
    function setUpdateTableZoom(maxlen){
        var default_tablewidth = 1202;
        var locker_width = 78; //변경됨
     
        var zoom = 1202/((maxlen+1)*locker_width);
        
        console.log(zoom);
        setZoomUpdateLockers(updates,zoom);
        
           
    }

    function setZoomUpdateLockers(updates,zoom){
        var lockerboxs = document.getElementsByClassName("updatelocker_box");
        var createlocker_desc_input = document.getElementsByClassName("updatelocker_desc_input");
        var locker_land_num = document.getElementById("locker_land_num") ? parseInt(document.getElementById("locker_land_num").value) : 100;
        var locker_port_num = document.getElementById("locker_port_num") ? parseInt(document.getElementById("locker_port_num").value) : 100;
        if(locker_land_num > 0 && locker_port_num > 0)
        var lockerboxinterval = setInterval(function(){
            if(locker_land_num/*lockerboxs.length*/ > 10){
                clearInterval(lockerboxinterval);
                 for (var i = 0; i < lockerboxs.length; i++) {
                     
                     var boxwidth = parseInt(lockerboxs[i].style.width);
                     var boxheight = parseInt(lockerboxs[i].style.height);
                     var bwidth = boxwidth*zoom;
                     lockerboxs[i].style.width = boxwidth*zoom+"px";
                     lockerboxs[i].style.height = boxheight*zoom+"px";
                     
                     var inputwidth = createlocker_desc_input[i] ? parseInt(createlocker_desc_input[i].style.width) : 0;
                     var inputheight = createlocker_desc_input[i]  ? parseInt(createlocker_desc_input[i].style.height) : 0;
                     
                     
                     if(createlocker_desc_input[i]){
                         createlocker_desc_input[i].style.width = inputwidth*zoom+"px";
                        createlocker_desc_input[i].style.height = inputheight*zoom+"px";
                     }
                     
                     
                }
            }
            //console.log(boxwidth+", "+boxheight+", "+bwidth);
        });
    }
    function getUpdateMaxTd(table){
        var rows = table.getElementsByTagName("tr");
        // tr만큼 루프돌면서 컬럼값 접근
        var max_td = 0;
        for( var r=0; r< rows.length; r++ ){
          var cells = rows[r].getElementsByTagName("td");
            if(cells.length > max_td)max_td = cells.length;            
        }
        return max_td;
    }
    function create_alllockers(){
        var title = "라커 삽입하기";
        var groupcode = getData("nowgroupcode");
        var centername = getData("nowcentername");
        var message = "[ "+centername+"] 의 전체라커를 적용하시겠습니까? <br><br><br><text align='center' style='color:red;font-size:22px'>※주의 : 이전 라커정보는 모두 삭제됩니다.</text>";
        showModalDialog(document.body, title, message, "전체라커 적용하기", "취소", function() {
            
            createaAllLockerSend();
        }, function() {
            hideModalDialog();
        });
    }
    function createaAllLockerSend(){
      
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");
        
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"createalllocker",
            value:lockers            
        };
        CallHandler("adm_get", senddata, function (res) {
//            console.log("setsettingres is ",res);
           if(res.code == 100){
               alertMsg("성공적으로 적용하였습니다.",function(){
                    hideModalDialog();
                   hideModalDialog();
                   
               });
               
           }else{
               alertMsg("적용중 에러발생 : "+res.message);
           }
            
        }, function (err) { 
            alertMsg("네트워크 에러 ");
            
        });
        
    
    }
</script>


