    

    <div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text id='title_payment' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >Q & A</text>
            
            <button id="button_chargehistory" style="float:right; width: 133px;margin-top:5px; height: 40px; border-radius: 5px; background-color: rgb(0, 158, 247); font-size: 13px; color: rgb(255, 255, 255); text-align: center; font-weight: 400; border: 0px; outline: none;" onclick="showChargeList()">+ 신규 채널생성</button>
            <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
          
            
            <div id="container" style="display:flex">

            </div>
            <div id="id_nodata">
            <br>
            <div align="center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
            </div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style='background-color:white;display:none;'></table>
        </div>
    </div>
    
    <script>
        
        setImageButton("admin_settingid_215","btn_alltraner.png","btn_alltraner_press.png","btn_alltraner_hover.png");
        setImageButton("arrow_l","button_prev_yellow.png","button_prev_yellow_press.png","button_prev_yellow_hover.png");
        setImageButton("arrow_r","button_next_yellow.png","button_next_yellow_press.png","button_next_yellow_hover.png");
        
        var container = document.getElementById("container");
        $(document).ready(function() {
            
            var isselected = true;            
            var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
            var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
            var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D9DCED;";
            var users_info_display = isselected ? "block" : "none";
            var channel_name = "테스트 채널";
            var traner_info_tag = 
                    "<div id='div_tranerinfo_' onclick ='' align='center' style='width:230px;height:120px;border-radius:5px;"+box_css+";color:#3F4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;'>"+
                        "<div id='div_tranerinfo_title_'  align='left' style='width:100%;height:40px;padding:10px 13px;10px;20px;background-color:#F6F7F7;border-radius:5px 5px 0px 0px;"+title_css+"'>"+
                           //PT달력 이름
                            "<label style='font-weight: 500;font-size:16px;float:left' >"+channel_name+"</label>"+
                            "<img src='./img/icon_list_black.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick=''>"+
                            "<i class='fa-regular fa-calendar' onclick=''  style='float:right;margin-top:2px;margin-left:5px;color:#3f4254;cursor:pointer'></i><br>"+
                         "</div>"+
                        "<div i align='left' style='width:100%;height:80px;padding:10px 17px 10px 20px;border-radius:0px 0px 5px 5px;"+body_css+"'>"+
                        "</div>"+
                    "</div>";
            container.innerHTML += traner_info_tag;                            
        });
        
                
    </script>
