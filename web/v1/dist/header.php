 <nav id="nav_top" class="sb-topnav navbar navbar-expand navbar-dark " style="background-color:#03153533;height:70px">
     

     <a class="navbar-brand" href="index.php">
         <img  width=50 height=50 src="./img/bg_arclogo.png" style='margin-top:7px;'/>
         
    <label id="header_title" class="header-title" style="font-size:14px;margin-left:10px;margin-top:10px;">ADMIN</label></a>
    
    <select id="combo_projectids" class="fmont project-select" onClick='combo_click_projectid()' onchange="onChangeProjectId()" style='margin-left:10px;border:0px;padding-left:15px;padding-right:15px;width:150px;height:40px;border-radius:6px;background-color:#041261;font-size: 14px;color:#ffffff;text-align:left;font-weight:400;' title='프로젝트 선택하기' required>
        
    </select>
    <img id='img_addprojectid' src='./img/button_addlocker.png' style='margin-left:8px;margin-top:-3px;width:40px;cursor:pointer' title='프로젝트 추가하기' onclick='insertProjectIdPopup()'>
    <button class="project-menu-btn" onclick="toggleProjectMenu()" style="margin-left:10px; background:#041261; color:white; border:none; border-radius:5px; padding:8px 10px; cursor:pointer; display:none; position:relative;">P▽</button>
    <div class="project-dropdown" id="project-dropdown" style="display:none; position:absolute; background:#fff; border:1px solid #ccc; border-radius:5px; padding:10px; z-index:1000; top:100%; left:0;">
        <select id="combo_projectids_mobile" class="fmont" onchange="onChangeProjectId()" style='border:0px;padding-left:15px;padding-right:15px;width:150px;height:40px;border-radius:6px;background-color:#041261;font-size: 14px;color:#ffffff;text-align:left;font-weight:400;' title='프로젝트 선택하기'>
            <!-- options will be copied -->
        </select>
    </div>
<!--
    <select id="combo_group" class="fmont" onchange="mChangeHeaderGroup()" style='border:0px;padding-left:15px;padding-right:15px;width:150px;height:40px;border-radius:10px;background-color:#041261;font-size: 14px;color:#ffffff;text-align:left;font-weight:400;' required>
        <option value=''>그룹선택</option>
    </select>
     <select id="combo_center" class="" onchange="mChangeHeaderCenter()" onclick="check_tutorialdata()" style='margin-left:15px;border:0px;padding-left:15px;padding-right:15px;width:150px;height:40px;border-radius:10px;background-color:#041261;font-size: 14px;color:#ffffff;text-align:left;font-weight:400;' required>
        <option value=''>센터선택</option>
    </select>
    <div style="margin-left:60px;width:500px;height:50px;background-color:#000d28;border-radius:10px;">
          
          <span style="float:left"><button onclick='btn_price()'  class='btn' style='border:0px;margin:5px;cursor:pointer;width:95px; height:40px;border-radius:5px;background-color:#041261;color:white' id='admin_settingid_5'>매출현황</button></span>
         
          <span style="float:left"><button onclick='loadMainDiv(9)'  class='btn'style='border:0px;margin-top:5px;cursor:pointer;width:95px; height:40px;background-color:#0c0c0d;color:white' id='admin_settingid_6'>페이롤</button></span>
         <span style="float:left;margin-top:5px"><div style="width:1px;height:30px;margin-top:10px;background-color:#1e1e1e"></div></span>
          <span style="float:left"><button onclick='btn_locker()'  class='btn' style='border:0px;margin-top:5px;cursor:pointer;width:95px; height:40px;background-color:#0c0c0d;color:white' id='admin_settingid_4'>라커현황</button></span>
         <span style="float:left;margin-top:5px"><div style="width:1px;height:30px;margin-top:10px;background-color:#1e1e1e"></div></span>
          <span style="float:left"><button onclick='loadMainDiv(34);updateSetTutorialStatus()'  class='btn' style='border:0px;margin-top:5px;cursor:pointer;width:95px; height:40px;background-color:#0c0c0d;color:white' id='admin_settingid_35_0'>GX현황</button></span>
         <span style="float:left;margin-top:5px;"><div style="width:1px;height:30px;margin-top:10px;background-color:#1e1e1e"></div></span>
          <span style="float:left"><button onclick='showCheckGroupInsertList()'  class='btn' style='border:0px;margin-top:5px;cursor:pointer;width:95px; height:40px;background-color:#0c0c0d;color:red;display:none' id='label_groupinsertlist'>정보미입력</button></span>
     </div>
-->
     <div class="top-buttons" style="margin-left:60px;width:auto;height:50px;background-color:#fff;border-radius:10px;">
          
          <span style="float:left"><button onclick='showPreviewWindow()'  class='btn' style='border:0px;margin:5px;cursor:pointer;width:155px; height:40px;border-radius:5px;background-color:#041261;color:white' title='작업중인 화면 미리보기' id='admin_settingid_5'>새창으로 미리보기</button><button onclick='showReservationPopup()'  class='btn' style='border:0px;margin:5px;cursor:pointer;width:105px; height:40px;border-radius:5px;background-color:#041261;color:white' title='설정된 키오스크 켜기 끄기 시간을 설정할 수 있습니다.' id='admin_settingid_5'><i class="fa-solid fa-clock"></i>&nbsp;전원 설정</button></span>
          <span style="float:left"><img src='img/ic_img_editor.png' style="width:50px;height:50px;cursor:pointer" onclick="showEditorTest('download')" title="이미지 에디터로 이미지파일 만들기"></span>
            <span style="float:left"><img src='img/ic_remocon.png' style="width:50px;height:50px;cursor:pointer" onclick="sendRemocon()" title="가상 리모컨 띄우기"></span>
             
     </div>
     
     <button class="menu-btn" onclick="toggleMenu()" style="margin-left:10px; background:#041261; color:white; border:none; border-radius:5px; padding:10px; cursor:pointer; display:none; position:relative;">☰</button>
     <div class="dropdown-menu" id="menu-dropdown" style="display:none; position:absolute; background:#fff; border:1px solid #ccc; border-radius:5px; padding:10px; z-index:1000; top:100%; left:0;">
         <button onclick='showPreviewWindow()' style='display:block; margin:5px; width:155px; height:40px; border-radius:5px; background-color:#041261; color:white; border:none; cursor:pointer;'>새창으로 미리보기</button>
         <button onclick='showReservationPopup()' style='display:block; margin:5px; width:105px; height:40px; border-radius:5px; background-color:#041261; color:white; border:none; cursor:pointer;'><i class="fa-solid fa-clock"></i> 전원 설정</button>
         <img src='img/ic_img_editor.png' style="width:50px; height:50px; cursor:pointer; margin:5px;" onclick="showEditorTest('download')" title="이미지 에디터로 이미지파일 만들기">
         <img src='img/ic_remocon.png' style="width:50px; height:50px; cursor:pointer; margin:5px;" onclick="sendRemocon()" title="가상 리모컨 띄우기">
     </div>
     
     <!--  유저 아이콘 -->
     <ul class="navbar-nav ml-auto">
        <div class="neelhide" style="display:none">
         <div align='center' style='width:43px;height:50px'>
             <img src='./img/ic_add_comment.png' style='float:left;width:30px;height:30px;cursor:pointer'  onclick='addPostIt()' title='포스트잇을 삽입하여 간단한 정보를 표시할 수있습니다. ex) 전달사항...'/><br>
             <span style='zoom:0.5'>
                <text id='toggle_title_postit' style='color:gray;float:left;font-size:14px;font-weight:500;margin-top:-8px;'>&nbsp;&nbsp;</text>
                <label class='switch' style='float:left;margin-top:4px' title='포스트잇 메모를 숨기거나 활성화 시킬 수 있습니다.'>
                    <input id='toggle_postit' type='checkbox' onchange='togglechange_postit()' checked>
                    <span id='toggle_icon_postit'  class='slider round'>
                        <text class='fmont' id='toggle_txt_postit'style='color:white;float:left;font-size:14px;font-weight:400;margin-top:8px;margin-left:26px'></text>
                    </span>
                </label>
            </span>
             
         </div>
         <div style="width:250px;height:40px;background-color:#ffffff;border-radius:10px;margin-top:3px;">
            <span><img onclick='header_search()' src="./img/icon_search.png" style="width:16px;height:14px;margin:13px 7px 15px 7px "></span>
                          
            <span><input id="input_search" onkeyup="enterkey(1)" type="text" placeholder="이름,폰,회원번호로 찾기" aria-label="Search" aria-describedby="basic-addon2" title="이름, 회원번호 , 전화번호 끝 4자리 , 전체전화번호 로 찾을 수 있습니다. " style="width:140px; height:40px;border: none; background: transparent;outline: none;webkit-text-fill-color: #000;-webkit-box-shadow: 0 0 0px 1000px #fff inset;box-shadow: 0 0 0px 1000px #fff inset;transition: background-color 5000s ease-in-out 0s;"/></span>
            <button id="topbtn_search" onclick='header_search()'  class='btn' style='border:0px;margin-top:-5px;margin-left:5px;cursor:pointer;width:60px; height:34px;border-radius:8px;background-color:#0c0c0d;color:white;outline:none'>검색</button>
           
         </div>
           
         </div>
            
         <!--      로그인 버튼          -->
         <button id="btn_login" class="btn btn-link ml-auto" style="color:white" onclick="login()">로그인</button>

         <!--     회원가입 버튼           -->
         <button id="btn_logout" class="btn btn-link ml-auto" style="color:white" onclick="join()">회원가입</button>

         <!--     유저 아이콘           -->
         <li id="li_usericon" class="nav-item dropdown" style="margin-left:30px">
             <a class="" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="./img/ic_new_user.png" style="width:50px;height:50px;"></a>
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
<!--
                 <a class="dropdown-item" href="#">Settings</a>
                 <a class="dropdown-item" href="#">Activity Log</a>
-->
<!--                 <div class="dropdown-divider"></div>-->
                 <a class="dropdown-item" onclick="searchMyInfo()">회원정보수정</a>
                 <a class="dropdown-item" onclick="logout()">로그아웃</a>
             </div>
         </li>
         
         <!--     회원 이름           -->
         <label id="txt_name" class="user-label" style="color:white;margin-top:15px;font-size: 13px;color:#ffffff;font-weight:500;margin-left:5px;margin-right:15px;" ></label>
         <!--      관리자페이지 이동          -->
<!--         <button id="btn_admin"  class="btn btn-primary btn-raised" style="color:white; display:none;font-size:13px;border-radius:8px;width:80px;height:45px" onclick="gotohome()">태블릿</button>-->
<!--         <button id="btn_homerequest"  class="btn btn-primary btn-raised" style="margin-left:10px;color:white; display:none;font-size:13px;border-radius:8px;width:80px;height:45px" onclick="showHomepageRequestList()">가입요청</button>-->

     </ul>
   
    <style>
        @media (max-width: 768px) {
            .top-buttons { display: none !important; }
            .menu-btn { display: inline-block !important; }
            .project-select { display: none !important; }
            .project-menu-btn { display: inline-block !important; }
            .user-label { display: none !important; }
            .header-title { display: none !important; }
        }
        .dropdown-menu { display: none; }
        .dropdown-menu.show { display: block; }
        .project-dropdown { display: none; }
        .project-dropdown.show { display: block; }
    </style>
    
<!--     <p align='center' style='width:100%'><text>아직 설정하지 않는 데이타가 있습니다. 클릭하여 확인하세요</text></p>-->
 </nav>

    


 <script>
   console.log("global_uid "+global_uid);
     setImageButton("img_addprojectid","button_addlocker.png","button_addlocker_hover.png","button_addlocker_hover.png");
     //버튼 클릭이벤트 버튼색깔설정   
     //setBtnEventColor("topbtn_home","#041261","#3e3e40","#4e4e50");
     
     setBtnEventColor("admin_settingid_5","#041261","#3e3e40","#4e4e50");
     setBtnEventColor("admin_settingid_6","#000000","#2b2b2b","#3b3b3b");
     setBtnEventColor("admin_settingid_4","#000000","#2b2b2b","#3b3b3b");
     setBtnEventColor("admin_settingid_35_0","#000000","#2b2b2b","#3b3b3b");
     setBtnEventColor("label_groupinsertlist","#000000","#2b2b2b","#3b3b3b");
     setBtnEventColor("topbtn_search","#111111","#222222","#333333");
          
      var combo_projectids = document.getElementById("combo_projectids");
     function searchMyInfo(){
         console.log("global_uid "+global_uid);
         header_search(global_uid);
     }
     function updateHeaderTitle() {
         
         var header_title = document.getElementById("header_title");
         var arr = global_email.split('@');
          header_title.innerHTML = arr[0]+"@<br>"+arr[1];
         
         
         if(typeof(setMainTitle) == 'function') //함수가 있는지 체크
            setMainTitle(getData("nowcentername"),getAuthName(auth_num),usernamedesc);
         checkIsNew();
		 initPostIt();
     }
     function showPreviewWindow(){
        var swidth = homepage_data.hm_width > 0 ? homepage_data.hm_width : 1080;
        var sheight = homepage_data.hm_height > 0 ? homepage_data.hm_height : 1920;

        if(homepage_data.hm_orientation == "L"){
            swidth = homepage_data.hm_width > 0 ? homepage_data.hm_width : 1920;
            sheight = homepage_data.hm_height > 0 ? homepage_data.hm_height : 1080;
        }
         showPreview(now_projectid, swidth, sheight);
     }
     
     function sendRemocon(){
         createRemoconID(function(remoconId){
             
            var token = homepage_data.hm_fcmtoken;
            var appid = "smartflat-lite";
             
            //양천도서관 매천중만 뷰어앱으로 제어
            if(now_projectid == "yclib" && session_groupidx == 10 || now_projectid == "maecheon" && session_groupidx == 1){
                 appid = "smartflat-pjt";
            }
             
             //test
//             token = "dIgEihcTRwCpNGjcBq_3fq:APA91bFRmuAxCvGFw3ORqqO8vR7w8KxDCUGOxSE2emo5EbZBPniwHFrPUl6Qe-KS_GIelxLWDCEL7NCsJCeHR4GN8qvA65ARzDDcwiw9E59-kMNl44NdCkI";//test
//             appid = "smartflat-pjt";//test
             
            showRemocon(now_projectid, appid, token, remoconId);    
         });
         
     }
   
     
     function initSelectProjectIds(){
         console.log("initSelectProjectIds");
         combo_projectids.innerHTML = "";
         if(now_projectid == null)
            now_projectid = getData("nowprojectid");
         
         
         if(now_projectid == null && arr_projectids && arr_projectids.length > 0){
             now_projectid = arr_projectids[0];
             saveData("nowprojectid", now_projectid);
         }else if(now_projectid == null){
             insertProjectIdPopup();
         }
        
        
         if(arr_projectids && arr_projectids.length > 0){
             for(var i = 0 ; i < arr_projectids.length;i++){
                 var selected = now_projectid == arr_projectids[i]  ? "selected" : "";
                 combo_projectids.innerHTML+=  "<option value='"+arr_projectids[i]+"' "+selected+">"+arr_projectids[i]+"</option>";
             }    
         }else {
             combo_projectids.innerHTML+=  "<option value='' selected>프로젝트 없음</option>";
         }
         
     }
     
     
     function insertProjectIdPopup(){
        
         var country_tag = "<div style='float:left;height:50px; color:#ffffff; font-family:Roboto, sans-serif;'>"+
             "*지역 : <select id='select_region' style='width:200px; background:#2a2a2a; color:#ffffff; border:1px solid #555; border-radius:5px; padding:5px;'>"
                + "   <option value='' style='background:#2a2a2a; color:#ffffff;'>-- 선택하세요 --</option>"
                + "   <option value='서울특별시' style='background:#2a2a2a; color:#ffffff;'>서울특별시</option>"
                + "   <option value='부산광역시' style='background:#2a2a2a; color:#ffffff;'>부산광역시</option>"
                + "   <option value='대구광역시' style='background:#2a2a2a; color:#ffffff;'>대구광역시</option>"
                + "   <option value='인천광역시' style='background:#2a2a2a; color:#ffffff;'>인천광역시</option>"
                + "   <option value='광주광역시' style='background:#2a2a2a; color:#ffffff;'>광주광역시</option>"
                + "   <option value='대전광역시' style='background:#2a2a2a; color:#ffffff;'>대전광역시</option>"
                + "   <option value='울산광역시' style='background:#2a2a2a; color:#ffffff;'>울산광역시</option>"
                + "   <option value='세종특별자치시' style='background:#2a2a2a; color:#ffffff;'>세종특별자치시</option>"
                + "   <option value='경기도' style='background:#2a2a2a; color:#ffffff;'>경기도</option>"
                + "   <option value='강원특별자치도' style='background:#2a2a2a; color:#ffffff;'>강원특별자치도</option>"
                + "   <option value='충청북도' style='background:#2a2a2a; color:#ffffff;'>충청북도</option>"
                + "   <option value='충청남도' style='background:#2a2a2a; color:#ffffff;'>충청남도</option>"
                + "   <option value='전북특별자치도' style='background:#2a2a2a; color:#ffffff;'>전북특별자치도</option>"
                + "   <option value='전라남도' style='background:#2a2a2a; color:#ffffff;'>전라남도</option>"
                + "   <option value='경상북도' style='background:#2a2a2a; color:#ffffff;'>경상북도</option>"
                + "   <option value='경상남도' style='background:#2a2a2a; color:#ffffff;'>경상남도</option>"
                + "   <option value='제주특별자치도' style='background:#2a2a2a; color:#ffffff;'>제주특별자치도</option>"
                + "</select></div>";
         
         
         var title_tag = "프로젝트 추가";
         var message_tag = "<label style='color:#ffffff; font-family:Roboto, sans-serif;'> 프로젝트 ID를 추가해 주세요. </label><br><label style='color:#cccccc; font-size:12px; font-family:Roboto, sans-serif;'>(영어소문자 or 숫자만입력) 최대20글자</label><br><br>"+
             "<div style='float:left;padding-left:30px'>"+
                "<div style='float:left;height:50px'>"+
                    "<label style='color:#ffffff; font-family:Roboto, sans-serif;'>*프로젝트명 : </label><input id='input_projectid' placeholder='ex) sample' type='text' style='width:200px; max-length:20; background:#2a2a2a; color:#ffffff; border:1px solid #555; border-radius:5px; padding:5px;'>&nbsp;&nbsp;&nbsp;&nbsp;<input id='orientation_port' type='radio' name='orientation' value='P' style='margin-top:10px' checked><label style='color:#ffffff; font-family:Roboto, sans-serif;'>세로</label>&nbsp;&nbsp;<input id='orientation_land' type='radio' name='orientation' value='L'><label style='color:#ffffff; font-family:Roboto, sans-serif;'>가로</label>"+
                "</div>"+
                "<div style='float:left;height:50px'>"+
                    "<label style='color:#ffffff; font-family:Roboto, sans-serif;'>*사이즈 : </label><input id='input_pwidth' placeholder='가로..' type='number' style='width:70px; max-length:20; background:#2a2a2a; color:#ffffff; border:1px solid #555; border-radius:5px; padding:5px;'>&nbsp;&nbsp;x&nbsp;&nbsp;<input id='input_pheight' placeholder='세로..' type='number' style='width:70px; max-length:20; background:#2a2a2a; color:#ffffff; border:1px solid #555; border-radius:5px; padding:5px;'>"
                +"</div>"+
                country_tag+
             "</div>";
         
         showModalDialog(document.body, title_tag, message_tag, "프로젝트 추가", "취소", function () {
                var orientation = document.getElementById("orientation_port").checked ? "P":"L";
                var input_projectid = document.getElementById("input_projectid");
                var input_pwidth = document.getElementById("input_pwidth");
                var input_pheight = document.getElementById("input_pheight");
                var select_region = document.getElementById("select_region");
                if(!input_projectid.value){
                    
                    return;
                }
                if(!select_region.value){
                    alertMsg("지역을 선택해 주세요");
                    return;
                }
                sendAddProjectId(document.getElementById("input_projectid").value, orientation, input_pwidth.value, input_pheight.value,select_region.value);
             
            }, function () {
             hideModalDialog();
         }, null);
     }
     function sendAddProjectId(_projectid,orientation, pwidth, pheight, region){
         var _data = { 
             "projectid":_projectid,
             "groupidx":session_groupidx,
             "orientation":orientation,
             "width":pwidth,
             "height":pheight,
             "region":region
         };
         AJAX_AdmGet(ADM_TYPE.INSERT_PROJECTID, _data, function(res){
           code = parseInt(res.code);
           if (code == 100) {
               var isin = res.message; //1: 이미 들어있다. 0 : 삽입해야함
               if(isin == 0){
                   arr_projectids.push(_projectid);
                   if(now_projectid == null){
                       now_projectid = _projectid;
                       saveData("nowprojectid", now_projectid);
                   }
                   initSelectProjectIds();
                   location.href = location.href;
               }
               hideModalDialog();
               
           }               
        });  
     }
     function showReservationPopup(){
         loadOnOffTime();
         
         var week_names = ["매일", "월", "화", "수", "목", "금", "토", "일"];
         var week_tag = "";
         for(var i = 0 ; i < 7;i++){
            var week_off_hourmin = DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].offtimehour == -1 ? "사용안함" : DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].offtimehour+":"+DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].offtimemin;
            var week_on_hourmin = DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].ontimehour == -1 ? "사용안함" : DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].ontimehour+":"+DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].ontimemin;
            var ison = DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].offtimehour != -1 || DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].ontimehour == -1 ? true : false;
            var txt_week = DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].name;
             
            var btn_week_off_bgcolor =  DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].offtimehour == -1 == -1 ? "#e9e9e9" : "#041261";
            var btn_week_on_bgcolor =  DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[i].ontimehour == -1 ? "#e9e9e9" : "#041261";
            
            week_tag += "<tr>" +
                            "<td style='width:50px;height:44px'>"+txt_week+"</td>" +
                            "<td style='height:44px'><button id='week_0_1_"+(i+1)+"' onclick='setReservationPopup(0,1,\""+txt_week+"\")' class='btn' style='border:0px;margin:5px;cursor:pointer;width:155px; height:40px;border-radius:5px;background-color:"+btn_week_off_bgcolor+";color:white' title='"+txt_week+"요일끄기 시간설정' id='admin_settingid_5'>"+week_off_hourmin+"</button></td>" +
                            "<td style='height:44px'><button id='week_1_1_"+(i+1)+"' onclick='setReservationPopup(1,1,\""+txt_week+"\")' class='btn' style='border:0px;margin:5px;cursor:pointer;width:155px; height:40px;border-radius:5px;background-color:"+btn_week_on_bgcolor+";color:white' title='"+txt_week+"요일켜기 시간설정' id='admin_settingid_5'>"+week_on_hourmin+"</button></td>" +                
                        "</tr>";
         }
         
        var switch_restart_onoff = DEFAULT_ONOFF_SETTINGDATA.IS_SET_RESTART ? "checked" : "";
        var div_restart_display = DEFAULT_ONOFF_SETTINGDATA.IS_SET_RESTART ? "block" : "none";
        var restart_hourmin =  DEFAULT_ONOFF_SETTINGDATA.RESTART_HOUR == -1 ? "사용안함" : DEFAULT_ONOFF_SETTINGDATA.RESTART_HOUR+":"+DEFAULT_ONOFF_SETTINGDATA.RESTART_MIN;
        var btn_restart_bgcolor =  DEFAULT_ONOFF_SETTINGDATA.RESTART_HOUR == -1 ? "#e9e9e9" : "#041261"; 
         
                           
        var switch_turn_onoff = DEFAULT_ONOFF_SETTINGDATA.SWITCH_TURN_ON_OFF ? "checked" : "";      
        var switch_week_on = DEFAULT_ONOFF_SETTINGDATA.SWITCH_WEEK_ON ? "" : "checked";
        
        var day_off_hourmin = DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR == -1 ? "사용안함" : DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR+":"+DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_MIN;
        var day_on_hourmin = DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR == -1 ? "사용안함" : DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR+":"+DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_MIN;
          
        var div_onoff_body_display =  DEFAULT_ONOFF_SETTINGDATA.SWITCH_TURN_ON_OFF ? "block" : "none";      
        var div_day_display =  DEFAULT_ONOFF_SETTINGDATA.SWITCH_WEEK_ON ? "none" : "block";
        var div_week_display =  DEFAULT_ONOFF_SETTINGDATA.SWITCH_WEEK_ON ? "block" : "none";
         
        var btn_day_off_bgcolor =  DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR == -1 ? "#e9e9e9" : "#041261";
        var btn_day_on_bgcolor =  DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR == -1 ? "#e9e9e9" : "#041261";
         
         var title_tag = "전원 On/Off 시간설정";
         var message_tag = 
                "<label style='float:left;font-weight:bold;font-size:18px'>※ 재시작시간을 설정해 주세요. </label><label class='switch' style='float:right;margin-top:-4px' title='재시작시간 ON/OFF 설정'>"+
                    "<input id='toggle_restartonoff' type='checkbox' onchange='togglechange_restartonoff()' "+switch_restart_onoff+">"+
                    "<span id='toggle_icon_restartonoff'  class='slider round'>"+
                        "<text class='fmont' id='toggle_txt_restartonoff' style='color:white;float:left;font-size:12px;font-weight:400;margin-top:8px;margin-left:3px'>ON&nbsp;&nbsp;OFF</text>"+
                    "</span>"+
                "</label><br><br>"+
                "<div style='width:100%;height:auto;border:1px solid #c9c9c9;border-radius:10px;padding:10px'>"+
                     //재시작 테이블
                     "<div id='div_restart' style='width:100%;height:auto;background-color:#f2faf9;display:"+div_restart_display+"'>"+
                        "<table class='fmont' align='center' style='text-align:center;margin-left:10px;width:100%;height:auto;border:0px;color:#3f4254;font-size:15px'>" +
                            "<tr >" +
                                "<td style='height:44px;color:blue;font-weight:bold'>재시작 시간</td>" +                
                     
                                "<td style='height:44px'><button id='btn_restart' onclick='setRestartPopup()'  class='btn' style='border:0px;margin:5px;cursor:pointer;width:155px; height:40px;border-radius:5px;background-color:"+btn_restart_bgcolor+";color:white' title='설정된 기기 매일켜기 시간설정' id='admin_settingid_5'>"+restart_hourmin+"</button></td>" +                
                            "</tr>"+
                        "</table>"+
                    "</div>"+
                "</div><br><br>"+
                "<label style='float:left;font-weight:bold;font-size:18px'>※ 예약시간을 설정해 주세요. </label><label class='switch' style='float:right;margin-top:-4px' title='설정된 기기 예약시간 설정 ON/OFF'>"+
                    "<input id='toggle_reservationonoff' type='checkbox' onchange='togglechange_reservationonoff()' "+switch_turn_onoff+">"+
                    "<span id='toggle_icon_reservationonoff'  class='slider round'>"+
                        "<text class='fmont' id='toggle_txt_reservationonoff' style='color:white;float:left;font-size:12px;font-weight:400;margin-top:8px;margin-left:3px'>ON&nbsp;&nbsp;OFF</text>"+
                    "</span>"+
                "</label><br><br>"+
//                "<div style='width:100%;height:1px;background-color:#e9e9e9'></div>"+
                "<div style='width:100%;height:auto;border:1px solid #c9c9c9;border-radius:10px;padding:10px'>"+
                     "<div id='div_reservation' style='width:100%;display:"+div_onoff_body_display+"'>"+
                        "<text id='toggle_title_reservationtype' style='color:gray;float:left;font-weight:500;margin-top:8px;'>기기 끄기/켜기 타입&nbsp;&nbsp;</text>"+
                        "<label class='switch' style='float:right;margin-top:4px' title='매일 켜기끄기를 설정하거나 요일별로 켜기끄기 설정을 할 수 있습니다.'>"+
                            "<input id='toggle_reservationtype' type='checkbox' onchange='togglechange_reservationtype()' "+switch_week_on+">"+
                            "<span id='toggle_icon_reservationtype'  class='slider round'>"+
                                "<text class='fmont' id='toggle_txt_reservationtype' style='color:white;float:left;font-size:12px;font-weight:400;margin-top:8px;margin-left:4px'>매일&nbsp;&nbsp;요일</text>"+
                            "</span>"+
                        "</label>"+
                     "<br><br>"+
                    //매일 테이블
                     "<div id='div_reservation_day' style='width:100%;height:auto;background-color:#f2faf9;display:"+div_day_display+"'>"+
                        "<table class='fmont' align='center' style='text-align:center;margin-top:20px;margin-left:10px;width:100%;height:auto;border:0px;color:#3f4254;font-size:15px'>" +
                            "<tr >" +
                                "<td style='width:50px;height:44px;color:blue;font-weight:bold'>요일</td>" +
                                "<td style='height:44px;color:blue;font-weight:bold'>끄기</td>" +
                                "<td style='height:44px;color:blue;font-weight:bold'>켜기</td>" +                
                            "</tr>" +
                            "<tr>" +
                                "<td style='width:50px;height:44px'>매일</td>" +
                                "<td style='height:44px'><button id='day_0_0_' onclick='setReservationPopup(0,0,\"매일\")'  class='btn' style='border:0px;margin:5px;cursor:pointer;width:155px; height:40px;border-radius:5px;background-color:"+btn_day_off_bgcolor+";color:white' title='매일끄기 시간설정' id='admin_settingid_5'>"+day_off_hourmin+"</button></td>" +
                                "<td style='height:44px'><button id='day_1_0_' onclick='setReservationPopup(1,0,\"매일\")'  class='btn' style='border:0px;margin:5px;cursor:pointer;width:155px; height:40px;border-radius:5px;background-color:"+btn_day_on_bgcolor+";color:white' title='매일켜기 시간설정' id='admin_settingid_5'>"+day_on_hourmin+"</button></td>" +                
                            "</tr>"+
                        "</table>"+
                    "</div>"+
                    //요일별 테이블
                    "<div id='div_reservation_week' style='width:100%;height:auto;background-color:#f2faf9;display:"+div_week_display+"'>"+
                         "<table class='fmont' align='center' style='text-align:center;margin-top:20px;margin-left:10px;width:100%;height:auto;border:0px;color:#3f4254;font-size:15px'>" +
                            "<tr>" +
                                "<td style='width:50px;height:44px;color:blue;font-weight:bold'>요일</td>" +
                                "<td style='height:44px;color:blue;font-weight:bold'>끄기</td>" +
                                "<td style='height:44px;color:blue;font-weight:bold'>켜기</td>" +                
                            "</tr>" +
                            week_tag+
                        "</table>"+  
                     "</div>"+
                    "</div>"+
                "</div>";
         
         showModalDialog(document.body, title_tag, message_tag, "설정하기", "취소", function () {
                saveOnOffTime();
                pushOnOffSetting();  
                hideModalDialog();
            }, function () {
             hideModalDialog();
         }, null);
     }
     function togglechange_restartonoff(){
        var toggle_restartonoff = document.getElementById("toggle_restartonoff");
        var div_restart = document.getElementById("div_restart");
        
        div_restart.style.display = toggle_restartonoff.checked ? "block" : "none";
        
        DEFAULT_ONOFF_SETTINGDATA.IS_SET_RESTART = toggle_restartonoff.checked ? true : false;
         
     }
     function togglechange_reservationonoff(){
        var toggle_reservationonoff = document.getElementById("toggle_reservationonoff");
        var div_reservation = document.getElementById("div_reservation");
        
        div_reservation.style.display = toggle_reservationonoff.checked ? "block" : "none";
        
         DEFAULT_ONOFF_SETTINGDATA.SWITCH_TURN_ON_OFF = toggle_reservationonoff.checked ? true : false;
         
     }
     
     function togglechange_reservationtype(){
         var toggle_reservationonoff = document.getElementById("toggle_reservationonoff");
         var toggle_reservationtype = document.getElementById("toggle_reservationtype");
         var div_reservation_day = document.getElementById("div_reservation_day");
         var div_reservation_week = document.getElementById("div_reservation_week");
         
         //매일
         if(toggle_reservationtype.checked){
             div_reservation_day.style.display = "block";
             div_reservation_week.style.display = "none";
         }
         //요일별
         else{
             div_reservation_day.style.display = "none";
             div_reservation_week.style.display = "block";
         }
     }
     var DEFAULT_ONOFF_SETTINGDATA = {
         "IS_SET_RESTART":false,
         "RESTART_HOUR":-1,
         "RESTART_MIN":-1,
         
         "SWITCH_TURN_ON_OFF": false,
         "SWITCH_WEEK_ON": false,
         "DAILY_ONTIME_HOUR": -1,
         "DAILY_OFFTIME_HOUR": -1,
         "DAILY_ONTIME_MIN": -1,
         "DAILY_OFFTIME_MIN": -1,         
         "WEEK_TURN_ONOFF_DATAS":[ 
             {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" :-1,
              "ison" : false,
              "name" : "월"
            }, {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" : -1,
              "ison" : false,
              "name" : "화"
            }, {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" : -1,
              "ison" : false,
              "name" : "수"
            }, {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" : -1,
              "ison" : false,
              "name" : "목"
            }, {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" : -1,
              "ison" : false,
              "name" : "금"
            }, {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" : -1,
              "ison" : false,
              "name" : "토"
            }, {
              "ontimehour" : -1,
              "offtimehour" : -1,
              "ontimemin" : -1,
              "offtimemin" : -1,
              "ison" : false,
              "name" : "일"
            } 
         ]
     }
     function setRestartPopup(){
          var title_tag = "재시작 시간설정";
          var time = DEFAULT_ONOFF_SETTINGDATA.RESTART_HOUR+":"+DEFAULT_ONOFF_SETTINGDATA.RESTART_MIN;
          var btn = document.getElementById("btn_restart");
          var message_tag = "<input type='time' id='input_onofftime' name='input_onofftime' "+time+">";
            showModalDialog(document.body, title_tag, message_tag, "입력", "사용안함", function () {
               var input_onofftime = document.getElementById("input_onofftime");
               console.log("input_onofftime.value ",input_onofftime.value);
               var t = input_onofftime.value.split(":");
               var hour = t[0] ? parseInt(t[0]) : -1;
               var min = t[1] ? parseInt(t[1]) : -1;
                DEFAULT_ONOFF_SETTINGDATA.RESTART_HOUR = hour;
                DEFAULT_ONOFF_SETTINGDATA.RESTART_MIN = min;
                 btn.innerHTML = hour+":"+min;
                 btn.style.backgroundColor = "#041261";
                 hideModalDialog();
            }, function () {
                DEFAULT_ONOFF_SETTINGDATA.RESTART_HOUR = -1;
                DEFAULT_ONOFF_SETTINGDATA.RESTART_MIN = -1;
                btn.innerHTML = "사용안함";
                btn.style.backgroundColor = "#e9e9e9";
                 hideModalDialog();
            });
         
     }
     //시간세팅팝업
     function setReservationPopup(ison, isweek, name){
         
         var week_names = {"월":0,"화":1,"수":2,"목":3,"금":4,"토":5,"일":6};
         
         var txt_onoff_type = ison ? "켜기" : "끄기";
         var txt_week_type = isweek ? "요일별" : "매일";
         var title_tag = txt_week_type+" "+txt_onoff_type+" 시간설정";
         var time = getOnOffTime(ison,isweek,name);
         var message_tag = "<input type='time' id='input_onofftime' name='input_onofftime' "+time+">";
         
         
         var btn_id = name == "매일" ? "day_"+ison+"_"+isweek+"_" : "week_"+ison+"_"+isweek+"_"+week_names[name];
         var btn = document.getElementById(btn_id);
         
         showModalDialog(document.body, title_tag, message_tag, "입력", "사용안함", function () {
               var input_onofftime = document.getElementById("input_onofftime");
                console.log("input_onofftime.value ",input_onofftime.value);
               var t = input_onofftime.value.split(":");
               var hour = parseInt(t[0]);
               var min = parseInt(t[1]);
                               
                if(isweek){
                           
                    if(ison){//켜기이다
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimehour = hour;
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimemin = min;
                    }else{//끄기이다.
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimehour = hour;
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimemin = min;
                    }
                    DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ison = true;
                    
                }else{
                    if(ison){//켜기이다.
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR = hour;
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_MIN = min;
                    }else{//끄기이다.
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR = hour;
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_MIN = min;
                    }
                }
             
                 btn.innerHTML = hour+":"+min;
                 btn.style.backgroundColor = "#041261";
                 hideModalDialog();
            }, function () {
               var input_onofftime = document.getElementById("input_onofftime");
              if(isweek){
                           
                    if(ison){
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimehour = -1;
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimemin = -1;
                    }else{
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimehour = -1;
                        DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimemin = -1;
                    }
                    DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ison = false;
                    
                }else{
                    if(ison){
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR = -1;
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_MIN = -1;
                    }else{
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR = -1;
                        DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_MIN = -1;
                    }
                }
                btn.innerHTML = "사용안함";
                btn.style.backgroundColor = "#e9e9e9";
                hideModalDialog();
             }, null);
         //
     }
     function getOnOffTime(ison,isweek,name){
         var value = "";
         if(isweek){
             if(ison){
                 if(DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimehour != -1 && DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimemin != -1){
                    value = DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimehour+":"+ DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].ontimemin;   
                 }
                 
             }else{
                 if(DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimehour != -1 && DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimemin != -1){
                    value = DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimehour+":"+ DEFAULT_ONOFF_SETTINGDATA.WEEK_TURN_ONOFF_DATAS[week_names[name]].offtimemin;   
                 }                 
             }
         }else{
             if(ison){
                 if(DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR != -1 && DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_MIN != -1){
                     value = DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_HOUR+":"+ DEFAULT_ONOFF_SETTINGDATA.DAILY_ONTIME_MIN;   
                 }
             }else{
                 if(DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR != -1 && DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_MIN != -1){
                     value = DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_HOUR+":"+ DEFAULT_ONOFF_SETTINGDATA.DAILY_OFFTIME_MIN;   
                 }
             }
         }
         if(value){
             value = " value='"+value+"'";
         }
         return value;
         
     }
     function pushOnOffSetting(){
           var pushdata = {"event":"setting","option":DEFAULT_ONOFF_SETTINGDATA};
            sendPush("remote_control", JSON.stringify(pushdata), function(res){
                if(res == "success"){
                    C_showToast( "전원ON/Off 설정 전송 성공!", "설정데이터를 성공적으로 전송하였습니다.", function() {});
                }else{
                    C_showToast( "전원ON/Off 설정 전송 실패!", "설정데이터 전송중 에러가 발생하였습니다.", function() {});
                }
            });   
     }
     function saveOnOffTime(){
         saveData("onofftime_"+now_projectid, JSON.stringify(DEFAULT_ONOFF_SETTINGDATA));
     }
     function loadOnOffTime(){
         var str_onoffdata = getData("onofftime_"+now_projectid);
         if(str_onoffdata && str_onoffdata.length > 10){
             DEFAULT_ONOFF_SETTINGDATA = JSON.parse(str_onoffdata);
         }
     }
     
     
     function combo_click_projectid(){
         console.log("click_combo");
         if(!arr_projectids || arr_projectids.length == 0){
             insertProjectIdPopup();
             
         }
     }
     function onChangeProjectId(){
         var combo_projectids = document.getElementById("combo_projectids");
         now_projectid = combo_projectids.value;
         console.log("change combobox "+now_projectid);
         saveData("nowprojectid", now_projectid);
         location.href = location.href;
         
         
     }
	 function initPostIt(){
		 var key = "postit";
        var toggle = document.getElementById("toggle_"+key);
		 if(getData("postittoggle") =="1"){
			  $(".postitcard").show(300);
			 toggle.checked = true;
		 }
			 
		 else {
			 $(".postitcard").hide(100);
			 toggle.checked = false;
		 }
			 
	 }
     function togglechange_postit(){
        var key = "postit";
        var toggle = document.getElementById("toggle_"+key);
        if(toggle.checked){
            
            $(".postitcard").show(300);
			saveData("postittoggle","1");
        }else{
            $(".postitcard").hide(100);
			saveData("postittoggle","0");
        }
     }

     
//     function getHeaderGroups(){
//        
//        console.log("getHeaderGroups");
//        var _data = {
//            "type": "group" // group or center or auth
//        };
//        
//        CallHandler("getdata", _data, function(res) {
//            code = parseInt(res.code);
//            
//            if (code == 100) {
//                //                    clog("result ",res);
//                var combo_group = document.getElementById('combo_group');
//
//                
//                var arr = res.message;
//                var len = arr.length;
//                if (len == 1) {
//                    
////                    var opt = document.createElement('option');
////                    opt.value = arr[0].groupcode;
////                    opt.innerHTML = arr[0].groupcode;
////                    combo_group.appendChild(opt);
////                    combo_group.selectedIndex = 1;
//                    combo_group.innerHTML = "<option value='"+arr[0].groupcode+"'>"+arr[0].groupname+"</option>";
//                    getCenter(arr[0].groupcode);
//                    
//
//                } else if (len > 1) {
//                    
//                    combo_group.innerHTML = "<option value=''>- 그룹선택 -</option>";
//                    console.log("arr is ",arr);
//                    if(auth < AUTH_OWNER){
//                         for (var i = 0; i < arr.length; i++) {
//                             if(session_groupcode == arr[i].groupcode){
//                                 combo_group.innerHTML = "<option value='"+arr[i].groupcode+"'>"+arr[i].groupname+"</option>";
//                                 break;
//                             }
//                                 
//                         }
//                        
//                    }else {
//                        for (var i = 0; i < arr.length; i++) {
//                            var opt = document.createElement('option');
//                            opt.value = arr[i].groupcode;
//                            opt.innerHTML = arr[i].groupname;
//                                combo_group.appendChild(opt);    
//                        }
//                        
//                    }
//                    var nowgroupcode = getData("nowgroupcode") ? getData("nowgroupcode") : session_groupcode;
//                        if(nowgroupcode){
//                            for(var i = 0 ; i < combo_group.children.length; i++){
//                                if(combo_group.children[i].value == nowgroupcode){
//                                    combo_group.selectedIndex = i;
//                                    getCenter(nowgroupcode);
//                                    break;
//                                }
//                            }
//                        }
//                    
//
//
//                    
//                    
//                    
//                }
//
//
//            } else {
////                alertMsg(res.message);
//            }
//
//        }, function(err) {
//            alertMsg("네트워크 에러 getHeaderGroups");
//
//        });
//    }
//   function getCenter(groupcode) {
//       
//        setLogos(groupcode);
//       
//        clog("getcenter");
//        var _data = {
//            "type": "center", // group or center or auth
//            "group": groupcode
//        };
//        
//        CallHandler("getdata", _data, function(res) {
//            code = parseInt(res.code);
//            console.log("getCenter res ",res);
//            if (code == 100) {
//
//                var combo_center = document.getElementById('combo_center');
//
//                var arr = res.message;
//                var len = arr.length;
//                if (len == 1) {
//                    var ccode = arr[0].centercode;
//                    var cname = arr[0].centername;
//                    var setting = JSON.parse(arr[0].setting);
//                    var theme = null;
//                    if(setting && setting.theme){
//                        theme = setting.theme;
//                        setTheme(theme);
//                    }
//                    
//                    clog("setting ",setting);
//                    clog("테마 ",theme);
//                    
//                    //데이타를 세이브하고 버튼자체를 없앤다.
//                    saveDataGroupCenter(groupcode, cname, ccode);
//                    startBeaconLog(); // 비콘 리스너 다시 시작
//                    updateHeaderTitle();
////                    updateGroupCenterText();
//                    combo_center.innerHTML = "<option value='"+ccode+"'>"+cname+"</option>";
//                    clog("환영합니다.! 현재 센터는 " + getData("nowcentername") + "입니다.");
//                    C_showToast( "환영합니다.!", "현재 센터는 " + getData("nowcentername") + "입니다.", function() {});
//                   
//                } else if (len > 1) {
//                    combo_center.innerHTML = "<option value=''>- 센터선택 -</option>";
//                    for (var i = 0; i < arr.length; i++) {
//                        var opt = document.createElement('option');
//                        opt.value = arr[i]["centercode"];
//                        opt.innerHTML = arr[i]["centername"];
//                        combo_center.appendChild(opt);
//                    }
//                    
//                    
//                    
//                    var nowcentercode = getData("nowcentercode");
//                    if(nowcentercode && combo_center.children.length > 1){
//                        for(var i = 0 ; i < combo_center.children.length; i++){
//                            if(combo_center.children[i].value == nowcentercode){
//                                combo_center.selectedIndex = i;
//                                break;
//                            }
//
//                        }
//                    }
//                }
//                
//                
//                
//
//            } else {
//                alertMsg(res.message);
//            }
//
//        }, function(err) {
//            alertMsg("네트워크 에러 ");
//
//        });
//        
//
//    };
//   
     //그룹 선택 클릭시 
    function mChangeProjectIds() {
        var combo_group = document.getElementById('combo_group');
        var group_value = combo_group.value;
        var group_name = combo_group.options[combo_group.selectedIndex].text;
        clog("헤더그룹선택 "+group_name);
        var _data = {
            "type": "center", // group or center or auth
            "group": group_value
        };
       
        CallHandler("getdata", _data, function(res) {
            code = parseInt(res.code);
            if (code == 100) {

                var combo_center = document.getElementById('combo_center');

                combo_center.innerHTML = "<option value=''>- 센터 선택 -</option>";

                var arr = res.message;
                for (var i = 0; i < arr.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = arr[i]["centercode"];
                    opt.innerHTML = arr[i]["centername"];
                    combo_center.appendChild(opt);

                }


                

            } else {
                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });
       

    };
     function mChangeHeaderCenter(){
         clog("mChangeHeaderCenter");
        var nowgroupcode = getData("nowgroupcode");
        var nowcentercode = getData("nowcentercode");
        var group_value = document.getElementById('combo_group').value;
        var center_value = document.getElementById('combo_center').value;
        if (!group_value || !center_value) {
            alertMsg("변경할 그룹과 센터를 정확히 선택하여 주세요.");
            return;
        }
        clog("group_value " + group_value + " nowgroupcode " + nowgroupcode);
        clog("center_value " + center_value + " nowcentercode " + nowcentercode);
        if (group_value == nowgroupcode && center_value == nowcentercode) {
            alertMsg("이미 현재 선택된 센터와 동일합니다.");
            return;
        }
        
        saveGroupCenter();
        startBeaconLog(); // 비콘 리스너 다시 시작
//        document.getElementById('push-us').style.display = "none";
//        $("#btn_changecenter").html("▼ 현재센터 변경하기");

        updateHeaderTitle();
//        updateGroupCenterText();
        var centername = document.getElementById('combo_center').options[combo_center.selectedIndex].text;
        C_showToast("센터변경완료!", "현재 센터를 " + centername + "로 변경하였습니다...", function() {
            
        });""
        loadMainDiv(now_pageid,now_pagevalue);
        checkIsNew();
         
         setLogos(group_value);
         getMYChargePoint();
         checkCenterInsertData();
         
         
         //센터가 변경되면 좌측하단 출석목록 초기화
         var listview_input = document.getElementById("listview_input");
         var listview_title = document.getElementById("listview_title");
         if(listview_input)listview_input.innerHTML = ""; 
         if(listview_title)listview_title.innerHTML = "0";
     }
     function saveGroupCenter() {
        var combo_group = document.getElementById('combo_group');
        var combo_center = document.getElementById('combo_center');

        saveDataGroupCenter(document.getElementById('combo_group').value, document.getElementById('combo_center').options[combo_center.selectedIndex].text, document.getElementById('combo_center').value);
    }

    
     
     

     
     function setUserTable(parent,infos){
//            clog("info ",infos);
//            var div_main = document.getElementById("div_main");
            var table_div = document.getElementById("table_div");
            
            if(table_div)table_div.remove();
            var tb_user = document.getElementById("tb_user");
            if(infos == null || infos != null && infos.length == 0){
                
                parent.innerHTML = "<div align='center'><br><text align='center' style='color:#bb0000;background-color:white;padding:10px'>※ 고객 정보를 찾을 수 없습니다.</text></div>";
                return;
            }
            
//            for(var c = 0; c<3;c++)//test
            global_userinfos = [];
            var len = infos.length;
            parent.innerHTML = "";
            if(len > 1){
                //parent.innerHTML = len && len > 1 ?  "<h2 style='color:red'>"+len+"명의 회원이 검색되었습니다.</h2>" : "";
                headersearch_userstable(parent,infos);
            }else if(len == 1){
                var info = infos[0]; 
                var isgxon = getIsGXON(info);
                var ihtml = gettag(isgxon,random_string(),info,true);
                parent.innerHTML = parent.innerHTML+ihtml;   

                if(isgxon)initminicalendar(info.mem_uid);
            }
        }
     
   
       
        function toggleMenu() {
            var menu = document.getElementById('menu-dropdown');
            if (menu.style.display === 'none' || menu.style.display === '') {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
        
        function toggleProjectMenu() {
            var menu = document.getElementById('project-dropdown');
            if (menu.style.display === 'none' || menu.style.display === '') {
                // copy options to mobile select
                var original = document.getElementById('combo_projectids');
                var mobile = document.getElementById('combo_projectids_mobile');
                mobile.innerHTML = original.innerHTML;
                mobile.value = original.value;
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        }
 </script>
 <style>
     @media (max-width: 1200px) {
         .top-buttons {
             display: none !important;
         }
         .menu-btn {
             display: block !important;
             width: 40px !important;
             height: 40px !important;
             padding: 0 !important;
             text-align: center;
             line-height: 40px;
         }
     }
 </style>
