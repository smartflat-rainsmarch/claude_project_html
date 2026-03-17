<br> 
<div>
    <!--221005 유진 수정-->
    <div style="display:flex; justify-content: space-between; width:1260px;height:auto;padding-bottom:13px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px; border-bottom-left-radius: 0px;border-bottom-right-radius: 0px; box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);">
     <H2 style="margin-top:20px; margin-left: 30px; font-size: 18px;color:#181c32;text-align:left;font-weight:700;"><!--<img src='./img/icon_title.png'/>-->&nbsp;라커 만들기</H2><br>
<!--    real-->
    <button id='btn_insertlocker' class='btn btn-primary btn-raised'  onclick="insert_locker()" style='margin-top:10px; height: 40px; margin-right: 30px; background-color: #009ef7; font-weight: 700; color: #ffffff; font-size: 14px;'>+ 라커패턴 삽입</button>
    
</div>
<div id="container" class = "form-control" style="height:auto; border: 1px solid #eff2f5; border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px; box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 5%);">
</div>
<div align='right'><br><button id ="btn_alllocker" class='btn btn-primary btn-raised'  onclick="create_alllockers()" style="background-color:red;display:none">전체라커 적용하기</button><br><br></div>
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
    .locker_input{
        width:60px;
        height:24px;
        font-size:12px; 
        margin-top:26px; 
        border: 1px solid #d9dced; 
        border-radius: 5px; 
        margin-left: -7px; 
        background-color: white;
    }
</style>
<script>
    clog("createlocker!!");
    var lockers = alllocker ? alllocker : [];
    var offset = 0;
    getAllLocker(getData("nowcentercode"),function(all_locker){
        lockers = all_locker;
        initLockerTable();
    })
    
    function maininit(value){
        clog("maininit testpage");
        var btn_insertlocker = document.getElementById("btn_insertlocker");
        
        if(auth >= AUTH_OPERATOR)
            btn_insertlocker.style.display = "block";
        else 
            btn_insertlocker.style.display = "none";
        
        
    }
    
    function insert_locker(){
        
       
        
        var title = "라커뭉치 생성하기";
        var message = "<div>"+
                            "<table style='width:100%'>"+
                                "<tr>"+
                                    "<td  style='width:25%'>"+
                                    /* 221005 유진 수정 */
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
                        "<div id='locker_container_"+lockers.length+"'>"+                           
                        "</div>";
        
        
        
         var style = {
                bodycolor: "#eeeeee",
                size: {
                    width: "90%",
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
        }, function() {
            hideModalDialog();
        },style);
    }
    var making_locker_json = null;
    function updateLockerTable(){
        clog("updateLockerTable");
        var locker_container = document.getElementById("locker_container_"+lockers.length);
        
        var lockerprice_month = document.getElementById("lockerprice_month");
        var lockerprice_day = document.getElementById("lockerprice_day");
        var locker_land_num = document.getElementById("locker_land_num");
        var locker_port_num = document.getElementById("locker_port_num");
        var locker_type = document.getElementById("locker_type");
        var locker_gender = document.getElementById("locker_gender");
        var locker_offset = document.getElementById("locker_offset");
        //가로세로 갯수가 입력되었다면
        if(parseInt(locker_land_num.value) > 0 && parseInt(locker_port_num.value) > 0){
            var json = create_lockerdata(lockerprice_month.value,lockerprice_day.value,locker_land_num.value,locker_port_num.value,locker_type.value,locker_gender.value,locker_offset.value);
            making_locker_json = json;
            clog("json",json);
            
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
            title_div.style.cssText = 'padding:10px;';
            /* 221005 유진 수정 */
            title_div.innerHTML = "<h3 class='textevent' style='background-image: url(./img/bg_locker_titlebar.png);border-top-left-radius: 10px; border-top-right-radius: 10px; color: white; padding-top: 15px; padding-bottom: 40px; background-image: url(./img/bg_locker_titlebar.png); width: 100%; height: 50px; border: 0px; background-size: 100% 100%; text-align: center;' >"+get_gender_icontag(json.gender)+"&nbsp;&nbsp;&nbsp;" + json.id + "</h3>";
            var lockertable = create_lockertable(lockers.length,"locker_container_"+lockers.length,title_div.id,json.data,0);
            lockertable.style.margin = "auto";
            lockertable.style.textAlign = "center";   
            locker_container.innerHTML = "";
            locker_container.appendChild(title_div);
            locker_container.appendChild(lockertable);
            var gender_color = {"M":"#8181e4","F":"#e48181","U":"d7d7d7"};
            locker_container.style.backgroundColor = gender_color[locker_gender.value];
            /* 221005 유진 수정 */
            locker_container.style.cssText = " padding-bottom: 15px; border-radius: 10px; background-color:rgb(29,29,30); margin-top: 10px;";
        }
        
    }
    function initLockerTable(){

        clog("initLockerTable",lockers);
        var container = document.getElementById("container");
        var locker_container = document.createElement("div");

        if(lockers.length > 0){
            for (var i = 0 ;i  < lockers.length; i++){
                
                locker_container.id="locker_container_"+i;

                
                var json = lockers[i];
                
                clog("json",json);

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
                var lockertable = create_lockertable(i,"locker_container_"+i, title_div.id, json.data,1);
                lockertable.style.margin = "auto";
                lockertable.style.textAlign = "center";   
                
                locker_container.appendChild(title_div);
                locker_container.appendChild(lockertable);
                
                setZoom(lockertable);
                var gender_color = {"M":"#8181e4","F":"#e48181","U":"d7d7d7"};
                locker_container.style.backgroundColor = gender_color[json.gender];
                /*221005 유진 수정*/
                locker_container.style.cssText = "border-radius : 10px; padding-bottom: 30px; margin-bottom: 20px; background-color:rgb(29,29,30); ";
            }
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
    function setZoom(parent,mzoom){
    clog(parent);
    // 강제로 비율조정할때 사용
    if(!mzoom)mzoom = 1;
    
    //parent = my_btn;
    var zoom = 100;
    var screen_width = 1000;//$(window).width();
    var max_width = 1260;
    zoom = (screen_width / max_width)*mzoom;
    clog(screen_width+", "+max_width);
//    clog("screen_width "+screen_width);
    var width_percent = 100;
//    if (zoom > 1) zoom = 1;
    clog(" zoom "+zoom+ " width_percent "+width_percent);
    parent.style.width = width_percent = width_percent+"%";
    parent.style.zoom = width_percent = zoom+"";
    
    return zoom;
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
//            clog("setsettingres is ",res);
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


