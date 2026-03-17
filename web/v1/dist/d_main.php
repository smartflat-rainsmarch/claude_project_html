<div id='div_default_title'>

    <br><br><br><br><br><br>
    
    <div id="default_info">
        
        <div align='center' style="margin-top:100px">
            <label class="fmont" id="label_groupname" style="font-size:70px;font-weight:900"></label><br>
            <label id = "main_txt_name" align="center" style="text-align:center;font-size:30px;color:#000000;"></label><br>
            <label style="color:#555555" id = "main_txt_auth" align="center" style="text-align:center;font-size:18px;color:#848484;font-weight:500;"></label><br>
        </div>    
    </div>
    <!--        <div id="table_div" class='form-control' style="max-width:1020px;height:auto;margin-left:30px;display:none"></div>-->

</div>



<br><br>









<script>
//    function userDropdownClick(value,text,imgname){
//        clog("userDropdownClick "+value+" "+text);
//        var default_tag = "<text>==선택하세요==</text>";
//        var userDropdown = document.getElementById("userDropdown");
//        userDropdown.innerHTML = imgname ? "<img src='./img/"+imgname+".png' style='height:25px;margin-top:-15px;'/>"+text : text;
//    }
    
    
   
    
    function setMainTitle(centername,authstr,name){
        
        var txt_auth = document.getElementById("main_txt_auth");
        var txt_name = document.getElementById("main_txt_name");
        
        if(txt_auth)txt_auth.innerHTML = centername+" ("+authstr+")";
        if(txt_name)txt_name.innerHTML = name+", 계정에 오신것을 환영합니다.";
    }
    

    var div_group = document.getElementById("div_group");
    var div_center = document.getElementById("div_center");

   

    //        $(document).ready(function() {
    function init_d_main(value) {
        
        var now_div = document.getElementById('now_group_center');
        var push_group = document.getElementById('push_group');
        
        updateHeaderTitle();
        
        document.getElementById("label_groupname").innerHTML = session_groupname;
    
    }
   
    function setCenterName() {

    }
