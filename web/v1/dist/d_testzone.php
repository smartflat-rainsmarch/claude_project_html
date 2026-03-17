<div>

    
    <br><br><br><br><br><br>
    
    <div id="default_info">
        <h1 style="color:#555555" id = "main_test_zone" align="center">테스트존</h1>
            
    </div>
    <br><br>
    <div id='main_testzone'>
        <button id="testzone_btn1" onclick='testzone_btn_click(1)' class='btn btn-primary btn-raised' >버튼1 테스트</button>&nbsp;
        <button id="testzone_btn2" onclick='testzone_btn_click(2)' class='btn btn-primary btn-raised' >버튼2 테스트</button>&nbsp;
        <button id="testzone_btn3" onclick='testzone_btn_click(3)' class='btn btn-primary btn-raised' >버튼3 테스트</button>&nbsp;
        <button id="testzone_btn4" onclick='testzone_btn_click(4)' class='btn btn-primary btn-raised' >버튼4 테스트</button>&nbsp;
        <button id="testzone_btn5" onclick='testzone_btn_click(5)' class='btn btn-primary btn-raised' >버튼5 테스트</button><br><br>
        <button id="testzone_btn6" onclick='testzone_btn_click(6)' class='btn btn-primary btn-raised' >버튼6 테스트</button>&nbsp;
        <button id="testzone_btn7" onclick='testzone_btn_click(7)' class='btn btn-primary btn-raised' >버튼7 테스트</button>&nbsp;
        <button id="testzone_btn8" onclick='testzone_btn_click(8)' class='btn btn-primary btn-raised' >버튼8 테스트</button>&nbsp;
        <button id="testzone_btn9" onclick='testzone_btn_click(9)' class='btn btn-primary btn-raised' >버튼9 테스트</button>&nbsp;
        <button id="testzone_btn10" onclick='testzone_btn_click(10)' class='btn btn-primary btn-raised' >버튼10 테스트</button>&nbsp;
        
        
    </div>
</div>



<br><br>
   
<script>
    
    //실험실
    function testzone_btn_click(idx){
        switch(idx){
            case 1:
                test_dbcreate();
                break;
            case 2:
                showAllTranerReservation();
                break;
            case 3:
                showTestPopup();
                break;
            case 4:
                loadMainDiv(35);
                break;
            case 5:
                playSound("./sound/01.mp3");
                break;
            case 6:
//                sendWebhook();
                break;
            case 7:
                break;
            case 8:
                break;
            case 9:
                break;
            case 10:
                break;
                
        }
        clog("테스트 버튼 "+idx+" 클릭");
    
    }
    
//    function userDropdownClick(value,text,imgname){
//        clog("userDropdownClick "+value+" "+text);
//        var default_tag = "<text>==선택하세요==</text>";
//        var userDropdown = document.getElementById("userDropdown");
//        userDropdown.innerHTML = imgname ? "<img src='./img/"+imgname+".png' style='height:25px;margin-top:-15px;'/>"+text : text;
//    }
    


    //        $(document).ready(function() {
    function init_d_testzone(value) {
        
        
        //test customCombobox code
//        var objs = [{"value":"v1","text":"셀렉트1","imgname":"./img/arrow_l.png"},{"value":"v2","text":"셀렉트2","imgname":"./img/arrow_r.png"},{"value":"v3","text":"셀렉트3","imgname":"./img/black_arc_logo.png"}];
//        var combobox  = createCustomComboBox("testid","==테스트선택==",objs,2);
//        var default_info = document.getElementById("div_main");
//        default_info.append(combobox);
       
    }
   

    function setCenterName() {

    }
