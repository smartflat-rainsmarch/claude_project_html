
<!--===========================-->
        <!--   가운데 메인     -->
        <!--- Image Slider -->
        
                    
        
        <!--- End Image Slider -->
        
        <!--- 가운데 하단 버튼 3개 Start -->
    <div>
    
        <div id = "div_search_group" style="margin-top:400px">
            <div style="width:100%;padding:55px;height:55px">
                <div  style="background-color:#1f1f1f;border-radius:10px;padding-left:55px;width:100%;height:50px" >
                    <button class="btn btn-primary" type="button" style='position:absolute;float:left;background-color:#00000000;border:0px;margin-left:-55px' onclick="header_search()" title="이름, 회원번호 , 전화번호 끝 4자리 , 전체전화번호 로 찾을 수 있습니다. ">
                        <i class="fas fa-search" style="margin-top:10px;margin-left:10;margin-right:10px;margin-bottom:13px;"></i>
                    </button>
                    <!--인풋 글자 자동완성시 배경을 제어하기 -->
                    <!---webkit-text-fill-color: #fff;-webkit-box-shadow: 0 0 0px 1000px #fff inset;box-shadow: 0 0 0px 1000px #1f1f1f inset;transition: background-color 5000s ease-in-out 0s;-->
                    <input class='fsans' id="input_search" onkeyup="enterkey(1)"  style="color:white;background-color:#00000000;-webkit-text-fill-color: #fff;-webkit-box-shadow: 0 0 0px 1000px #fff inset;box-shadow: 0 0 0px 1000px #1f1f1f inset;transition: background-color 5000s ease-in-out 0s;border:0px;border-radius:10px;width:82%;height:50px;border:0px;outline:none" type="text" placeholder="이름,폰번호 (회원검색 후 PT 가입)"  title="이름, 회원번호 , 전화번호 끝 4자리 , 전체전화번호 로 찾을 수 있습니다. "/>
                    <button id="topbtn_search" onclick='header_search()'  class='btn' style='float:right;border:0px;margin-top:5px;margin-right:60pxcursor:pointer;width:60px; height:40px;border-radius:8px;background-color:#0c0c0d;color:white;outline:none;margin-right:6px'>검색</button>
                    
                </div>
                
            </div>
            
            <div>
                <h3 id = "txt_search_result" style="color:#fffd00;font-size:17px;font-weight:bold" align="center"></h3>
                <div id = "div_list" class="card-body" style='background-color:white;display:none'>
                    <div class="table-responsive">
                        <table class="table fmont" id="dataTable" width="100%" cellspacing="0" style='background-color:white'>
                        </table>
                    </div>
                </div>
            </div>
        </div>
       
        <div align="bottom" style='width:100%;height:220x;padding:55px;margin-top:200px'>
            <button id="btn_signup" class='form-control fsans' style='height:45px;background-color:#fffd00;border:0px;border-radius:10px;font-size:15px;font-weight:bold;color:#111111' onclick="goToJoin()" >신규가입</button>
            <br>
            <button id= "btn_catalog" class='form-control fsans' style='height:45px;background-color:#00000000;border:1px solid white;border-radius:10px;font-size:15px;font-weight:bold;color:white' onclick="goToCatalog()" >카달로그</button>
            
        </div>
    </div>
        <!---  가운데 하단 버튼 3개 End -->
        <!--===========================-->
        
<script>
    
    var userdatas = null;
    
    
    function maininit(value) {
        clog("d_main.php :  maininit");
        //일반회원은 로그인을 해도 아무것도 할 수 없다.
//        var div_search_group = document.getElementById("div_search_group");
        
//        if(auth < AUTH_TRANER){
//            div_search_group.style.display = "none";
//        }else 
//            div_search_group.style.display = "block";
    }
    setBtnEventColor("btn_signup","#fffd00","#fffe69","#fffe99");
    setBtnEventColor("btn_catalog","#00000000","#fffe6933","#fffe6966");
//    $( "#btn_signup" ).bind("touchstart",function(){
//        $(this).css("background-color", "#fffe69");
//    });
//    $( "#btn_signup" ).bind("touchend",function(){
//        $(this).css("background-color", "#fffd00");
//    });
//
//    $( "#btn_signup" ).mouseover(function(){
//         $(this).css("background-color", "#fffd00");
//    });
//
//    $( "#btn_signup" ).mouseout(function(){
//         $(this).css("background-color", "#fffd00");
//    });
//    $( "#btn_signup" ).mousedown(function(){
//        $(this).css("background-color", "#fffe69");
//    });
//     $( "#btn_signup" ).mouseup(function(){
//         $(this).css("background-color", "#fffd00");
//    });

    
    
    
//    $( "#btn_catalog" ).bind("touchstart",function(){
//        $(this).css("background-color", "#fffe6933");
//    });
//    $( "#btn_catalog" ).bind("touchend",function(){
//         $(this).css("background-color", "#00000000");
//    });
//
//    $( "#btn_catalog" ).mouseover(function(){
//          $(this).css("background-color", "#00000000");
//    });
//
//    $( "#btn_catalog" ).mouseout(function(){
//         $(this).css("background-color", "#00000000");
//    });
//    $( "#btn_catalog" ).mousedown(function(){
//         $(this).css("background-color", "#fffe6933");
//    });
//    $( "#btn_catalog" ).mouseup(function(){
//        $(this).css("background-color", "#00000000");
//    });
    
    function search_user(){
        var title = "PT 가입할 회원검색";
        var message = "<div align='center' style='width:100%; height:120px; background-color:#111111;padding-top:35px'>"+
                        "<div style='width:370px;height:40px;background-color:#ffffff;border-radius:10px;box-shadow: 0px 5px 10px 0px rgba(16, 26, 35, 0.1);'>"+
                            "<span><img onclick='tuser_search()' src='./img/icon_search.png' style='width:16px;height:14px;margin:13px 7px 15px 7px '></span>"+
                            "<span>"+
                                "<input id='id_user_search' type='text' placeholder='이름,폰,회원번호로 찾기' aria-label='Search' aria-describedby='basic-addon2' title='이름, 회원번호 , 전화번호 끝 4자리 , 전체전화번호 로 찾을 수 있습니다. ' style='width:260px; height:40px;border: none; background: transparent;outline: none;webkit-text-fill-color: #000;-webkit-box-shadow: 0 0 0px 1000px #fff inset;box-shadow: 0 0 0px 1000px #fff inset;transition: background-color 5000s ease-in-out 0s;'/>"+
                            "</span>"+
                            "<button onclick='tuser_search()'  class='btn' style='border:0px;margin-top:-5px;margin-left:5px;cursor:pointer;width:60px; height:34px;border-radius:8px;background-color:#0c0c0d;color:white;outline:none'>검색</button>"+
                        "</div>"+
                     "</div>";
        
		showModalDialog(document.body,title, message, "검색하기", "취소",function(){
            tuser_search();
            hideModalDialog();            
        },function(){
            hideModalDialog();                
        });		
    }
    function tuser_search(){
         var input_search = document.getElementById("input_search");
         var id_user_search = document.getElementById("id_user_search");
         input_search.value = id_user_search.value;
         header_search();
        hideModalDialog();            
    }
    
    function goToJoin(){
        if (!auth || auth && auth <= AUTH_NOMEMBER) {
              alertMsg("로그인을 해주세요");
              return;
        }
        if(!getData("nowcentercode") || isNaN(getData("nowcentercode"))){
            alertMsg("센터를 먼저 선택해 주세요.");
            return;
        }
        location.href = "./join.php";
    }
    function goToCatalog(){
        if (!auth || auth && auth <= AUTH_NOMEMBER) {
              alertMsg("로그인을 해주세요");
              return;
        }
        if(!getData("nowcentercode") || isNaN(getData("nowcentercode"))){
            alertMsg("센터를 먼저 선택해 주세요.");
            return;
        }
        location.href = "./catalog.php?groupcode="+session_groupcode+"&centercode="+getData("nowcentercode");
    }
    function bottomButtonClick(type){
        switch(type){
            case 0:
                break;
            case 1:
                break;
            case 2:
                break;
                
        }
    }
     function enterkey(type) {
         if(window.event.keyCode == 13) {
             switch (type) {
                 case 1:
                     // 엔터키가 눌렸을 때 실행할 내용
                     clog("endter");
                     header_search(document.getElementById("input_search").value);
                     break;
             }
         }

     }
     function header_search(value) {
         //neel_sessioncheck
        
         
         
//         var value = document.getElementById("input_search").value;
          if (!auth || auth && auth <= AUTH_NOMEMBER) {
              alertMsg("로그인을 해주세요");
              return;
          }
         if(!getData("nowcentercode")){
             alertMsg("센터를 선택해 주세요.")
             return;
         }
         
         if(value == undefined)value = document.getElementById("input_search").value;
         
         clog("header_search ",value);
         loadMainDiv(0,null,function(){
             var div_search_group = document.getElementById("div_search_group");    
             var div_list = document.getElementById("div_list");    
             var main = document.getElementById("div_main");
             if(!value){
                 alertMsg("검색할 이름이나 폰번호, 회원번호를 입력해 주세요!");
                 return;
             }
             getUserData(value,  function(res) {
                 clog("res is ", res);
                 var code = parseInt(res.code);
                 if (code == 100) {
                     //code == 100 :  가입된 고객이 1명이상 있다. 
                     div_list.style.display = "block";
                     div_search_group.style.marginTop = "0px";
                     insert_user_table(res.message);
//                     var desc =  "이미 가입된 고객입니다. 정보를 갱신하려면 센터에 문의 하세요.";
//                     var txt_search_result =  document.getElementById("txt_search_result");
//                     txt_search_result.innerHTML = desc;
//                     showModalDialog(document.body, "회원정보 있음", desc, "확인", null, function() {
//                        hideModalDialog();
//                    }, null);
                    
                 }
                 else {
                     div_list.style.display = "none";
                     div_search_group.style.marginTop = "400px";
                     var desc =  value+"님은 가입되지 않은 고객 입니다.";
                     var txt_search_result =  document.getElementById("txt_search_result");
                     txt_search_result.innerHTML = desc;
                     showModalDialog(document.body, "회원정보 없음", value+"님은 가입되지 않은 고객 입니다.회원가입 페이지로 이동합니다.", "이동하기", "취소", function() {
                        window.location.href = "./join.php"
                        hideModalDialog();  
                    },function(){
                         hideModalDialog();  
                     });
                     
                 }

             });
         });         
     }
    function insert_user_table(rows) {
        userdatas = rows;
        var txt_search_result = document.getElementById("txt_search_result")
        if(!rows){
            txt_search_result.innerHTML = "목록을 찾을 수 없습니다.";
            return;
        }
        txt_search_result.innerHTML = rows.length+"개의 목록을 찾았습니다.";

//            document.getElementById("table_div").style.display = "block";
        var table = document.getElementById('dataTable');
//        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>시작일</th> <th>종료일</th><th>재등록하기</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        //table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>이름</th><th>고객번호</th><th>생년월일</th><th>전화번호</th><th>재등록하기</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>이름</th><th>생년월일</th><th>전화번호</th><th>재등록하기</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;

        
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            for (var i = 0; i < len; i++) {
                var using_coupons = getCoupons(rows[i],"using");
                var brow = body.insertRow();
                var uid = rows[i]["mem_uid"];
//                var bcell_check = brow.insertCell();
//                bcell_check.innerHTML = "<button onclick='btn_userinfo(\"" + i + "\")' class='btn btn-primary btn-raised'>정보보기</button>";

                
                var gender_img = get_gender_icontag(rows[i]["mem_gender"])+"&nbsp;";//"<i class='fa-solid fa-mars'></i><img src = './img/"+rows[i]["mem_gender"]+".png' style='width:16px;height:17px'/>&nbsp;";
                var bcell_name = brow.insertCell();
                bcell_name.innerHTML =  "<button onclick='btn_userinfo(\"" + i + "\")' class='btn btn-primary btn-raised' style='font-size:14px;'>"+gender_img+rows[i]["mem_username"]+"</button>";

//                var bcell_id = brow.insertCell();
//                bcell_id.innerHTML = rows[i]["mem_userid"];

                var bcell_birth = brow.insertCell();
                bcell_birth.innerHTML = rows[i]["mem_birth"];

                var bcell_phone = brow.insertCell();
                bcell_phone.innerHTML = rows[i]["mem_phone"];

               

//                var bcell_starttime = brow.insertCell();
//                bcell_starttime.innerHTML = rows[i]["mem_starttime"].substr(0,10);
//
//                var bcell_endtime = brow.insertCell();
//                bcell_endtime.innerHTML = rows[i]["mem_endtime"].substr(0,10);

                var bcell_btn = brow.insertCell();

               // bcell_btn.innerHTML = "<button onclick='change_button_click(\"" + uid + "\")' class='btn btn-primary btn-raised'>변경하기</button>";
                var btn_health_id = random_string()+"_"+i+"_0";
                var btn_pt_id = random_string()+"_"+i+"_1";
                var btn_send_id = random_string()+"_"+i+"_2";
                
                 bcell_btn.innerHTML = "<div align='center'><img id='"+btn_health_id+"' src='./img/button_membership.png'  style='width:59px;height:44px' onclick='button_user_click("+i+")' >&nbsp;<img id='"+btn_pt_id+"' src='./img/button_pt.png'  style='width:59px;height:44px' onclick='button_user_click_pt("+i+")' >&nbsp;<img id='"+btn_send_id+"' src='./img/button_send.png'  style='width:59px;height:44px' onclick='button_user_click_send("+i+")' ></div>";

//                initClickButtonListener(btn_health_id,"HT");
//                initClickButtonListener(btn_pt_id,"PT");
                setImageButton(btn_health_id,"./img/button_membership.png", "./img/button_membership_press.png","./img/button_membership.png" );
                setImageButton(btn_pt_id,"./img/button_pt.png", "./img/button_pt_press.png","./img/button_pt.png" );
                setImageButton(btn_send_id,"./img/button_send.png", "./img/button_send_press.png","./img/button_send.png" );
                
            }
        }
        $('#dataTable').DataTable();
    }
//    function initClickButtonListener(id,type){
//        var btnid = "#"+id;
//        var normal_src = type == "HT" ? "./img/button_health.png" : "./img/button_pt.png";
//        var press_src = type == "HT" ? "./img/button_health_press.png" : "./img/button_pt_press.png";
//        $( btnid).bind("touchstart",function(){
//            $(this).attr("src", press_src);
//            
//        });
//        $(btnid ).bind("touchend",function(){
//            
//            $(this).attr("src", normal_src);
//
//        });
//
//        $(btnid).mouseover(function(){
//            $(this).attr("src", normal_src);
//        });
//
//        $(btnid).mouseout(function(){
//             $(this).attr("src", normal_src);
//        });
//        $(btnid).mousedown(function(){
//             $(this).attr("src", press_src);
//        });
//         $(btnid).mouseup(function(){
//            $(this).attr("src", normal_src);
//        });
//    }
    function button_user_click(i){
        //neel_sessioncheck
        
        clog("갱신하기버튼 클릭 "+i);
		var centercode = getData("nowcentercode");
        post_to_url('./join.php?centercode='+centercode, userdatas[i]);
    }
    function button_user_click_pt(i){
        //neel_sessioncheck
        
        clog("PT 갱신하기버튼 클릭 "+i);
		var centercode = getData("nowcentercode");
        post_to_url('./join_pt.php?centercode='+centercode, userdatas[i]);
    }
    function button_user_click_send(i){
        //neel_sessioncheck
          var useruid = userdatas[i].mem_uid;
         getUserGXDatas(session_groupcode,getData("nowcentercode"),useruid,function(){ 
             var style = {
                 modaltype:"large",
                 marginTop:"0px",
                 bodycolor:"#ffffff",
                 size:{
                     width:"95%",
                     height:"auto"
                 },
                 top:{
                     color:"#262930",
                     textAlign:"left",
                     paddingLeft:"25px",
                     borderBottom: "1px solid #dddddd"
                 },
                 bottom:{
                     textAlign:"right",
                     paddingRight:"25px",
                     borderTop: "1px solid #dddddd",


                 },
                 //커스텀 버튼
                 button_width: "100px",
                 button_height: "43px",
                 button_color : "white",
                 button_bgcolor : "#31b0f8"


            };

            showModalDialog(document.body,"고객정보보기", gettag(random_string(),userdatas[i],"coupons"), "확인", null,function(){
              hideModalDialog();
            },function(){},style);
        });
    }
    function btn_userinfo(i){
        
         var useruid = userdatas[i].mem_uid;
         getUserGXDatas(session_groupcode,getData("nowcentercode"),useruid,function(){ 
             
                 //neel_sessioncheck
            var style = {
                 modaltype:"large",
                 marginTop:"0px",
                 bodycolor:"#ffffff",
                 size:{
                     width:"95%",
                     height:"auto"
                 },
                 top:{
                     color:"#262930",
                     textAlign:"left",
                     paddingLeft:"25px",
                     borderBottom: "1px solid #dddddd"
                 },
                 bottom:{
                     textAlign:"right",
                     paddingRight:"25px",
                     borderTop: "1px solid #dddddd",


                 },
                 //커스텀 버튼
                 button_width: "100px",
                 button_height: "43px",
                 button_color : "white",
                 button_bgcolor : "#31b0f8"


            };
            showModalDialog(document.body,"고객정보보기", gettag(random_string(),userdatas[i]), "확인", null,function(){
                hideModalDialog();
            },function(){},style);
         });
        
    }
</script>