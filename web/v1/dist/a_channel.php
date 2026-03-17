    <div id = "reservation_container" class="container" style='width:auto;height:100%;margin-left:270px;margin-right:30px;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px;width:100%height:100%;'>
           
          
                <text id='title_payment' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >화면 수정하기</text>&nbsp;&nbsp;
                <img src="./img/icon_copy.png" style="float:left;width:35px;height:35px;margin-top:10px;margin-left:10px;cursor:pointer;margin-right: 10px" onclick="showCopyIframeAddress()" title="주소 복사하기">
                <div id="div_shorturl" style='width:auto;height:auto;float:left;margin-right:10px;padding-left:15px;padding-right:15px;border-radius:5px;border: 1px solid #e9e9e9;background-color:#f2faf9'>
                    <label style="color:red;">※중요: 숏URL은 키오스크에 삽입할때만 사용하세요</label><br>
                   &nbsp;&nbsp;&nbsp;<label id="label_shorturl" style="color:brown;text-decoration:underline;" title="키오스크에 입력할때만 해당 숏URL을 복사해서 입력해주세요." onclick="copyShortURL()">숏URL 복사</label>
                    
                </div>
                
    <!--            <button id="button_new_channel" style="float:right; width: 133px;margin-top:5px; height: 40px; border-radius: 5px; background-color: rgb(0, 158, 247); font-size: 13px; color: rgb(255, 255, 255); text-align: center; font-weight: 400; border: 0px; outline: none;" onclick="showAddChannel()">+ 신규 페이지생성</button>-->
               
                 
                <button id="button_new_channel" style="float:right; width: 133px;margin-top:5px; height: 40px; border-radius: 5px; background-color: rgb(0, 158, 247);margin-right:10px; font-size: 13px; color: rgb(255, 255, 255); text-align: center; font-weight: 400; border: 0px; outline: none;" onclick="showContentsData()">+ 데이터 삽입/수정</button>
                
              
              <!-- 재난안전문자 -->
              <div id="div_safetydata" align="center" style="float:right;width:auto;height:auto;margin-right:20px;margin-top:5px;padding-top:5px;padding-right:5px;display:none;border-radius:8px;background-color:#c2caf933;cursor:pointer">
                  <label class='switch' style='float:right;margin-top:0px;'>
                        <input id='toggle_safetydata_' type='checkbox' onchange="contentDataTogglechange('toggle_safetydata', '')" selected>
                        <span id='toggle_safetydata_span_' class='slider round'>
                            <text class='fmont' id='toggle_safetydata_txt_'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:blue'>&nbsp;ON</text>
                        </span>
                    </label>
                    <div style="display:flex;height:100%;width:auto"  onclick="showSafetySettingPopup()">
                    <i class="fa-solid fa-triangle-exclamation" style="float:right;margin:7px;color:red;font-size:20px"></i> <text style='margin-top:1px;float:right;width:auto;margin-top:5px;margin-right:10px;color:red' title='ON 으로 켜졌을때 재난안전문자를 표시할 수 있습니다.'>재난안전문자</text>
                    </div>
                </div>
                
                <hr style="border: solid 1px #eff2f5;margin-top:40px;margin-left:-28px;margin-right:-28px;">

                <div id='div_main_container' style='width:100%;display:flex'>
                    <div id='iframe_container' style='position:fixed;width:540px;height:961px;margin-right:10px;'>
                        <iframe id='iframe_preview' ></iframe>
                    </div>
                    <div id = "div_right" style='margin-left:580px;width:100%;height:100%;'>
                       <div>
                            <div id="container">

                            </div>

                            <div id="id_nodata">

                            </div>
                            <div id='main_div' style='height:auto'>

                            </div>
                             <div id='div_tab0' style='height:auto'>
                                <table class="default-table" id="contentTable" width="100%" cellspacing="0" style='text-align:center;background-color:white;font-size:14px;font-weight:400'></table>
                            </div>

                            <div id='div_tab1'  style='height:auto;display:none'>

                                 <table class="default-table" id="homeTable" width="100%" cellspacing="0" style='text-align:center;background-color:white;font-size:14px;font-weight:400'></table>
                            </div>
                            <div id='div_tab2' style='height:auto;display:none'>
                                <table class="default-table" id="mainTable" width="100%" cellspacing="0" style='text-align:center;background-color:white;font-size:14px;font-weight:400'></table>
                            </div>

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style='background-color:white;display:none;'></table>
                        </div>
                    </div>
              </div>
        </div>
    </div>
    
    <script>
        
        setImageButton("admin_settingid_215","btn_alltraner.png","btn_alltraner_press.png","btn_alltraner_hover.png");
        setImageButton("arrow_l","button_prev_yellow.png","button_prev_yellow_press.png","button_prev_yellow_hover.png");
        setImageButton("arrow_r","button_next_yellow.png","button_next_yellow_press.png","button_next_yellow_hover.png");
        
        var container = document.getElementById("container");
//        var div_shorturl = document.getElementById("div_shorturl");
       var label_shorturl = document.getElementById("label_shorturl");
        
        
        var homedatas = [];
        var maindatas = [];
        var contentdatas = [];
        $(document).ready(function() {
            init();          
            
        });
        var channels = null;
        var now_channel = null;
        var WMAX = 5; //채널 가로 최대갯수
        
       
        var hm_idx = 1;
        var arr_text_notice = [];
        var arr_home_notice_datas = [];
        var language_code = "KO";
        var orientation = "P";
         //최초
        function init(){
            console.log("a_channel");
//            getChannelList(function(res){
//                
//                console.log("getChannelList res ",res);
//                if(res != null){
//                    console.log("111 getChannelList res ",res);
//                    channels = res;
//                    drawChannels(res);
//                }
//            });
//            checkChannelPermission(PERMISSION_NEW_CHAANEL);
            
            
            var _data = {
                "projectid":now_projectid,
                "groupidx":session_groupidx
            }
            AJAX_AdmGet(ADM_TYPE.GET_HOME_DATA, _data, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                   homepage_data = res.message;
                   orientation = homepage_data.hm_orientation;
                   console.log("page_home_data",homepage_data);
                   if(homepage_data.hm_home_data.length > 5){
                       
                        homedatas = JSON.parse(homepage_data.hm_home_data);
                        
                   } 
                   if(homepage_data.hm_main_data.length > 5){
                       
                        maindatas = JSON.parse(homepage_data.hm_main_data);
                        
                   } 
                   if(homepage_data.hm_content_data.length > 5){
                       
                        contentdatas = JSON.parse(homepage_data.hm_content_data);
                   } 
                   if(homepage_data.hm_region){
                       //hm_region : 서울특별시, 경기도... 값이 있으면 재난안전문자 토글을 보이도록 한다.
                       document.getElementById("div_safetydata").style.display = "block";                       
                       document.getElementById("toggle_safetydata_").checked = homepage_data.hm_safety_onoff == 1 ? true : false;
                   }
                   language_code = homepage_data.hm_language;
                   console.log("homedatas",homedatas);
                   console.log("maindatas",maindatas);
                   getShortURL();
                   drawHomeMainDatas();
                   initIframePreview();
                   
                   //홈화면 공지사항이있는지 체크
                   for(var i = 0;  i < homedatas.length;i++){
                       if(homedatas[i].texttype && homedatas[i].texttype == "text_notice")
                           arr_text_notice.push(homedatas[i]);
                   }
                   if(arr_text_notice.length > 0){
                       getTextNoticeList();
                   }
               }               
            });  
        }
        function getTextNoticeList(){
            var _data = {
                "projectid":now_projectid,
                "groupidx":session_groupidx
            };
            AJAX_AdmGet(ADM_TYPE.GET_TEXT_NOTICE_LIST, _data, function(res){
               var code = parseInt(res.code);
               if (code == 100) {
                    arr_home_notice_datas = res.message;
                console.log("arr_home_notice_datas ",arr_home_notice_datas);
               }
            });
        }
        
        function getShortURL(){
            
//            if(auth < AUTH_OWNER){
//                div_shorturl.style.display = "none";
//            }else{
//                AJAX_AdmGet(ADM_TYPE.GET_SHORTURL, homepage_data.hm_idx, function(res){
//                   code = parseInt(res.code);
//                   if (code == 100) {
//                        var fullurl = "https://"+window.location.hostname+"/s/?s="+res.message.su_shorturl;
//                        label_shorturl.innerHTML = fullurl;
//                       div_shorturl.style.display = "block";
//                   }               
//                });   
//            }
            
            
            
            AJAX_AdmGet(ADM_TYPE.GET_SHORTURL, homepage_data.hm_idx, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                    var fullurl = "https://"+window.location.hostname+"/s/?s="+res.message.su_shorturl;
                    label_shorturl.innerHTML = fullurl;                       
               }               
            });   
               
        }
        function initIframePreview() {
            var container = document.getElementById("iframe_container");
            var div_right = document.getElementById("div_right");
            
            
            var swidth = homepage_data.hm_width > 0 ? parseInt(homepage_data.hm_width) : 1080;
            var sheight = homepage_data.hm_height > 0 ? parseInt(homepage_data.hm_height) : 1920;
            
            if(homepage_data.hm_orientation == "L"){
                swidth = homepage_data.hm_width > 0 ? parseInt(homepage_data.hm_width) : 1920;
                sheight = homepage_data.hm_height > 0 ? parseInt(homepage_data.hm_height) : 1080;
                container.style.width = (swidth/2)+"px";
                container.style.height = (sheight/2)+"px";
                div_right.style.marginLeft = "1000px";
            }
            if(swidth > 1300){
                console.log("sheight "+sheight);
                document.getElementById("iframe_container").style.position = "absolute";
                var marginTop = (sheight+30)/2;
                document.getElementById("div_right").style = "margin-left:0px;margin-top:"+marginTop+"px;width:100%";
            }
            
            var oldIframe = document.getElementById("iframe_preview");
            if (oldIframe) container.removeChild(oldIframe); // 기존 iframe 제거

            setTimeout(function(){
                
            
                if (!now_projectid) now_projectid = "sample_port";
                const domain = window.location.origin;
                const cacheBuster = new Date().getTime();

                const iframe_url = domain + "/html/game/school/" + now_projectid + "/v" + session_groupidx + 
                    "/?projectid=" + now_projectid + "&groupidx=" + session_groupidx+ "&cb=" + cacheBuster+"&sw=" + swidth+"&sh=" + sheight;

                const newIframe = document.createElement("iframe");
                newIframe.id = "iframe_preview";
                newIframe.src = iframe_url;
                newIframe.style.width = "100%";
                newIframe.style.height = "100%";
    //            newIframe.style.border = "none";

                container.appendChild(newIframe);
            },300);
        }
        function drawHomeMainDatas(){
           
            var main_div = document.getElementById("main_div");
            main_div.innerHTML = "";
           
            var manageruid = "";
           
            var div = document.createElement("div");
            div.innerHTML = "<div style='height:50px;'>"+
                                "<span style='float:left'><div align='center' id='tab_0_"+manageruid+"' onclick='click_tab(0, \""+manageruid+"\")'  style='cursor:pointer;background-color:#ffffff;width:150px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+  
                                      "<label id='tab_0_label' style='cursor:pointer;font-size: 16px; color:#3F4254;text-align:center;margin-top:8px'>컨텐츠 데이터</label>"+
                                "</div></span>"+
                
                                "<span style='float:left'><div align='center' id='tab_1_"+manageruid+"' onclick='click_tab(1, \""+manageruid+"\")' style='cursor:pointer;background-color:#eeeeee;font-weight:bold;width:100px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+       
                                     "<label id='tab_1_label' style='cursor:pointer;font-size: 16px; color:#aaaaaa;text-align:center;margin-top:8px'>홈화면</label>"+

                                "</div></span>"+
                                "<span style='float:left'><div align='center' id='tab_2_"+manageruid+"' onclick='click_tab(2, \""+manageruid+"\")'  style='cursor:pointer;background-color:#eeeeee;width:100px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+  
                                      "<label id='tab_2_label' style='cursor:pointer;font-size: 16px; color:#aaaaaa;text-align:center;margin-top:8px'>메인화면</label>"+
                                "</div></span>"+
                
                                
                
                            "</div>"+
            
                            "<div align='center' id='div_data_"+manageruid+"' style='width:100%;height:auto;margin-top-:-1px'>"+
                                    //내용은 금액을 계산한 후에 다른곳에서 입력한다. 
//                                    getDefaultTag(idx)+
//                                    getStudyTag(idx)+
                            "</div>";
            
                    
            var main_div = document.getElementById("main_div");
            
            main_div.appendChild(div);
            
            makeTable('contentTable',contentdatas,null,null,"contentdata");
            makeTable('homeTable',homedatas,null,null,"homedata");
            makeTable('mainTable',maindatas,null,null,"maindata");
          
//           initDefaultData();
//            
//            checkDrag();
//            
//            initChannelFileList();
      
            
        }
        function showCopyIframeAddress(){
             var iframe_preview = document.getElementById("iframe_preview");
            iframe_preview.src;
            var copy_address = iframe_preview.src;
            navigator.clipboard.writeText(copy_address).then(function() {
                  C_showToast("주소 복사 완료!", "페이지 정보 " + copy_address + " 를 복사하였습니다.");
                }).catch(function(err) {
                  C_showToast("알림", "주소 복사에 실패했습니다. 수동으로 복사해주세요.");
                  console.error('Failed to copy text: ', err);
                });
        }
        function copyShortURL(){
            
            
            
            var copy_address = label_shorturl.innerHTML;
            navigator.clipboard.writeText(copy_address).then(function() {
                  C_showToast("숏URL 복사 완료!", "" + copy_address + " 를 복사하였습니다.");
                }).catch(function(err) {
                  C_showToast("알림", "주소 복사에 실패했습니다. 수동으로 복사해주세요.");
                  console.error('Failed to copy text: ', err);
                });
            
        }
        
        var home_notice_idx = 0;
       function makeTable(tableid,rows,isdataTable,offset,statistic_key){
           
           
            var table = document.getElementById(tableid);
            var istabledisplay = isdataTable ? "block" : "none";
//           parent.appendChild(table);
           home_notice_idx = 0;
           //컨텐츠 데이터
           if(statistic_key == "contentdata"){
                console.log("rows ",rows);
                if(session_groupidx == 1 && now_projectid == "maecheon" || session_groupidx == 10 && now_projectid == "yclib")
                    table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>이름</th><th>타입</th><th>미리보기</th></tr></thead><tfoot></tfoot><tbody></tbody>";
                else 
                    table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>첫화면<br>정하기</th><th>번호</th><th>이름</th><th>타입</th><th>미리보기</th></tr></thead><tfoot></tfoot><tbody></tbody>";
                var head = table.getElementsByTagName("thead")[0];
                var body = table.getElementsByTagName("tbody")[0];
                var foot = table.getElementsByTagName("tfoot")[0];
                var len = rows.length;


                if (len > 0) {
                    for (let i = 0; i < len; i++) {
                        const idx = i;
                        const contentdata = rows[i];
                        const name    = contentdata["name"];
                        var type = contentdata["type"];
                        var imgfoldername = contentdata["imgfoldername"] ? contentdata["imgfoldername"] : "gallery";
                        if(type == "gallery1"){
                            type = contentdata["imgfoldername"] ? contentdata["imgfoldername"] : "gallery";
                        }
                        else if(type == "gallery2"){
                            type = contentdata["imgfoldername"] ? contentdata["imgfoldername"] : "gallery2";
                        }
                        
                        const _type = type;
                        const url     = contentdata["url"] || "";
                        const ischecked = contentdata["isfirstscene"] && contentdata["isfirstscene"] == "1" ? "checked" : "";

                        var schoolapitype = contentdata.schoolapitype ? contentdata.schoolapitype : "";
   
                        const content_url = getIFrameUrl(contentdata, schoolapitype,url,0);
                        console.log(i+") url: "+content_url);
                        const brow = body.insertRow();
                        if(!(session_groupidx == 1 && now_projectid == "maecheon" || session_groupidx == 10 && now_projectid == "yclib")){
                            // 첫화면
                            const bcell_first = brow.insertCell();  
                            bcell_first.align= "center";
                            bcell_first.innerHTML = getTag_Checkbox("checkbox_first_"+i,"","","margin-left:30%","onclick='clickCheckboxDefaultPage("+i+")' "+ischecked);                            
                        }
                        
                        // 번호
                        const bcell_idx = brow.insertCell();
                        bcell_idx.innerText =(idx+1);
                        bcell_idx.onclick = () => showPopupContentData(idx, contentdata, _type);
                        bcell_idx.style.cursor = "pointer";
                        // 이름
                        const bcell_name = brow.insertCell();
                        bcell_name.innerText = name;
                        bcell_name.onclick = () => showPopupContentData(idx, contentdata, _type);
                        bcell_name.style.cursor = "pointer";
                        
                        // 타입
                        const bcell_type = brow.insertCell();
                        bcell_type.innerText = type;
                        bcell_type.onclick = () => showPopupContentData(idx, contentdata, _type);
                        bcell_type.style.cursor = "pointer";
                        
                        // 미리보기
                        const bcell_url = brow.insertCell();
                        bcell_url.style.textAlign = "center";
                        if (type == "mapimg") {
                            
                          // 일반 이미지는 100×100 박스
                          const wrapper = document.createElement('div');                           
                          wrapper.style.width        = '300px';
                          wrapper.style.height       = '300px';  
                          wrapper.style.overflow     = 'hidden';
                          wrapper.style.margin       = '0 auto';  // wrapper도 가운데
                          wrapper.style.border = "2px solid #e9e9e9";
                            
                          const img = document.createElement('img');
                          img.id     = `id_preview_${idx}`;
                          img.src    = content_url;
                          img.style.width  = '300px';
                          img.style.height = '300px';
                          img.onerror = () => img.style.display = 'none';
                          img.style.margin     = '0 auto';  // img도 가운데
                            wrapper.appendChild(img);
                          bcell_url.appendChild(wrapper);
                            
                        }else {
                           // 1) wrapper div
                          const wrapper = document.createElement('div');
                           
                          wrapper.style.width        = '300px';
                          wrapper.style.height       = '390px';
                          wrapper.style.overflow     = 'hidden';
                          wrapper.style.margin       = '0 auto';  // wrapper도 가운데
                          wrapper.style.border = "2px solid #e9e9e9";

                          // 2) iframe thumbnail
                          const thumb = document.createElement('iframe');
                          thumb.id            = `id_preview_${idx}`;
                          
                          var param_imgfoldername = imgfoldername ? "&imgfoldername="+imgfoldername : "";
                          thumb.src           = content_url.indexOf("?") < 0 ? content_url+"?projectid="+now_projectid+"&groupidx="+session_groupidx+"&listid="+contentdata.id+param_imgfoldername+"&date="+new Date().getTime() : content_url+"&date="+new Date().getTime();
                          if(type == "webpage")thumb.src = url;
                          thumb.style.width   = '1000px';
                          thumb.style.height  = '1300px';
                          thumb.style.border  = 'none';
                          thumb.style.transform       = 'scale(0.3)';
                          thumb.style.transformOrigin = '0 0';
//                          thumb.style.pointerEvents = 'none'; //iframe 클릭막기

                          wrapper.appendChild(thumb);
                          bcell_url.appendChild(wrapper);
                        }
                    }
                }
           }
            //스마트플랫 사용자 목록
            else if(statistic_key == "homedata"){


                table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>이름</th><th>타입</th><th>이미지</th><th>클릭이미지</th><th>x</th><th>y</th><th>이벤트</th></tr></thead><tfoot></tfoot><tbody></tbody>";
                var head = table.getElementsByTagName("thead")[0];
                var body = table.getElementsByTagName("tbody")[0];
                var foot = table.getElementsByTagName("tfoot")[0];
                var len = rows.length;


                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        const idx = i;
                        var brow = body.insertRow();
                        brow.style.cursor = "pointer";
                        var name = rows[i]["name"];
                        var type = rows[i]["type"];
                        
                        var imgurl = type == "button_empty" ? "./img/empty_button.png" : rows[i]["imgurl"] +"?"+new Date().getTime();
                        var clickurl = rows[i]["clickurl"];
                        var x = rows[i]["x"];
                        var y = rows[i]["y"];
                    
                        var event = rows[i]["event"];
                        
                        var isfreeuser = true;

                        var texttype = rows[i]["texttype"] ? rows[i]["texttype"] : "";
                        var notice_title = "";
                        var notice_title = "";
                        
                        ///////////////////////////////////////////////
                        // 번호
                        ///////////////////////////////////////////////
                        const bcell_idx = brow.insertCell();
                        bcell_idx.innerText = (idx+1)+"";
                        
                        ///////////////////////////////////////////////
                        // 이름
                        ///////////////////////////////////////////////                        
                        var bcell_name = brow.insertCell();
                        bcell_name.innerHTML = name;
    
                        
                        
                        ///////////////////////////////////////////////
                        // 타입
                        ///////////////////////////////////////////////                        
                        var bcell_type = brow.insertCell();
                        bcell_type.innerHTML = type;
    
                        
                        
                        ///////////////////////////////////////////////
                        // 이미지
                        ///////////////////////////////////////////////
                        if(!imgurl)imgurl = "";
                        var bcell_imgurl = brow.insertCell();
                        bcell_imgurl.innerHTML = "<img id='id_home_preview_img_"+idx+"' src='"+imgurl+"' style='width:100px' onerror='this.style.display=\"none\"'>";
    
                        
                        
                        ///////////////////////////////////////////////
                        // 클릭이미지
                        ///////////////////////////////////////////////
                        if(!clickurl)clickurl = "";
                        var bcell_clickurl = brow.insertCell();
                        bcell_clickurl.innerHTML = "<img id='id_home_preview_clickimg_"+idx+"' src='"+clickurl+"' style='width:100px' onerror='this.style.display=\"none\"'>";
                        
                        ///////////////////////////////////////////////
                        // X
                        ///////////////////////////////////////////////
                        if(!x) x= "-";                            
                        var bcell_x = brow.insertCell();
                        bcell_x.innerHTML = x;
                        
                        
                        ///////////////////////////////////////////////
                        // Y
                        ///////////////////////////////////////////////
                        if(!y)y= "-";
                        var bcell_y = brow.insertCell();
                        bcell_y.innerHTML = y;    
                        
                      
                        
                        
                        ///////////////////////////////////////////////
                        // 이벤트
                        ///////////////////////////////////////////////
                        if(!event)event = "-";
                        var bcell_event = brow.insertCell();
                        bcell_event.innerHTML = JSON.stringify(event);
    
                        
                        
                        ///////////////////////////////////////////////
                        // 텍스트타입
                        ///////////////////////////////////////////////
                       if(texttype == "text_notice"){
                           const _home_notice_idx = home_notice_idx;
                           brow.onclick = function(){                              
                                showPopupProductData(idx, statistic_key, _home_notice_idx);
                           }
                           
                           home_notice_idx++;
                       }else {
                           brow.onclick = function(){                              
                                showPopupProductData(idx, statistic_key);
                           }
                       }
                        
                        
                        
                    }
                }
            }
           
        
           else if(statistic_key == "maindata"){


                table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>이름</th><th>타입</th><th>이미지</th><th>클릭이미지</th><th>x</th><th>y</th><th>이벤트</th></tr></thead><tfoot></tfoot><tbody></tbody>";
                var head = table.getElementsByTagName("thead")[0];
                var body = table.getElementsByTagName("tbody")[0];
                var foot = table.getElementsByTagName("tfoot")[0];
                var len = rows.length;


                if (len > 0) {
                    for (var i = 0; i < len; i++) {
                        const idx = i;
                        var brow = body.insertRow();
                        brow.style.cursor = "pointer";
                       
                        var name = rows[i]["name"];
                        var type = rows[i]["type"];
                        var imgurl = rows[i]["imgurl"] +"?"+new Date().getTime();
                        var clickurl = rows[i]["clickurl"];
                        var x = rows[i]["x"];
                        var y = rows[i]["y"];
                        var event = rows[i]["event"];
                        
                        var isfreeuser = true;
                        
                        ///////////////////////////////////////////////
                        // 번호
                        ///////////////////////////////////////////////
                        const bcell_idx = brow.insertCell();
                        bcell_idx.innerText = (idx+1)+"";
                        
                        ///////////////////////////////////////////////
                        // 이름
                        ///////////////////////////////////////////////
                        var bcell_name = brow.insertCell();
                        bcell_name.innerHTML = name;
    
                        
                        
                        ///////////////////////////////////////////////
                        // 타입
                        ///////////////////////////////////////////////
                        var bcell_type = brow.insertCell();
                        bcell_type.innerHTML = type;
    
    
                        
                        ///////////////////////////////////////////////
                        // 이미지
                        ///////////////////////////////////////////////
                        if(!imgurl)imgurl = "";
                        var bcell_imgurl = brow.insertCell();
                        bcell_imgurl.innerHTML = "<img id='id_main_preview_img_"+idx+"'  src='"+imgurl+"' style='width:100px' onerror='this.style.display=\"none\"'>";
    
                        
                        
                        ///////////////////////////////////////////////
                        // 클릭이미지
                        ///////////////////////////////////////////////
                        if(!clickurl)clickurl = "";
                        var bcell_clickurl = brow.insertCell();
                        bcell_clickurl.innerHTML = "<img id='id_main_preview_clickimg_"+idx+"' src='"+clickurl+"' style='width:100px' onerror='this.style.display=\"none\"'>";
    
                        
                        
                        ///////////////////////////////////////////////
                        // X
                        ///////////////////////////////////////////////
                        if(!x)x="-";
                        var bcell_x = brow.insertCell();
                        bcell_x.innerHTML = x;
    
                        
                        
                        ///////////////////////////////////////////////
                        // Y
                        ///////////////////////////////////////////////
                        if(!y)y="-";
                        var bcell_y = brow.insertCell();
                        bcell_y.innerHTML = y;
    
                        
                        
                        ///////////////////////////////////////////////
                        // 이벤트
                        ///////////////////////////////////////////////
                        if(!event)event="-";
                        var bcell_event = brow.insertCell();
                        bcell_event.innerHTML = JSON.stringify(event);
    
                         brow.onclick = function(){  
                            showPopupProductData(idx, statistic_key);
//                             C_showToast("알림", "메인화면 레이아웃 이미지 수정은 잠겨있습니다. 추후 지원예정입니다.");
                        }
                        
                    }
                }
            }
        }
//        //최초로드시 첫화면 체크박스를 선택되도록 만든다.
//        function initCheckboxDefaultPage(){
//            for(var i = 0 ; i < contentdatas.length;i++){
//                var checkbox =  document.getElementById("checkbox_first_"+i);
//                if(contentdatas[i]["isfirstscene"] == "1"){                    
//                    checkbox.checked = true;
//                    break;
//                }                    
//            }
//        }
        //체크박스로 클릭하면 해당화면에 첫화면이 된다.
        function clickCheckboxDefaultPage(idx){
            for(var i = 0 ; i < contentdatas.length;i++){
                var checkbox =  document.getElementById("checkbox_first_"+i);
                if(i != idx){
                    contentdatas[i]["isfirstscene"] = "0";
                    checkbox.checked = false;
                }else {
                     contentdatas[i]["isfirstscene"] = checkbox.checked ? "1" : "0";                    
                }                    
            }
            sendContentDatas(contentdatas,function(){
                initIframePreview();
            });
            
        }
        function showPopupContentData(idx, _contentdata, type){
            
             console.log("showPopupContentData !@!");
            var name = _contentdata.name;
//            var type = _contentdata.type; // html , mapimg , board
            
            var MAX_LEN  = 0;
            var title_tag = "";
            var message_tag = "";
            
              var img_path = "contentdata/img/";
                var game_url = "../../../game/school/"+now_projectid+"/v"+session_groupidx+"/"+img_path;
              
            
            /////////////////////////////////////////
            // html 타입
            /////////////////////////////////////////
            
            
             var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "50%",
                        height: "auto"
                    }
                };
            
             var preview_img_tag  = "";
            if(type == "html" || type == "img"){
                MAX_LEN  = 5;
                title_tag = "["+_contentdata.name+"] 수정할 이미지를 삽입하세요 (최대 5장)"+checkIsSchoolDataToggle(_contentdata);//+getTag_Button("btn_editor_button","이미지 만들기", "showEditorTest()",null,null,null,null,null,"float:right");

                var mtag = "";
                
                
               
                for(var i = 0 ; i < MAX_LEN; i++){
                    var src = _contentdata.images && _contentdata.images.length > i ? game_url + _contentdata.images[i] +"?"+new Date().getTime() : "";
                    preview_img_tag += src ?  "<img id='show_preview_"+i+"' src='"+src+"' onerror='this.style.display=\"none\";' style='width:100%; height:auto;'>" : "";
                }
                    
                for(var i = 0 ; i < MAX_LEN; i++){
                    var src = _contentdata.images && _contentdata.images.length > i ? game_url + _contentdata.images[i] +"?"+new Date().getTime() : "";
                
                    console.log(i+" src "+src);
                    var previewtag = i == 0 ?  
                            "<td rowspan='5'>"+
                                "<h5>*미리보기</h5>"+
                                 "<div id='html_preview' style='background-color:#e9e9e9;border:1px solid #a9a9a9;width:600px;height:780px;overflow-y:scroll'>"+
                                    preview_img_tag+
                                 "</div>"+
                            "</td>" : "";
                    
                    mtag +=   
                        "<tr>"+
                            "<td>"+
                                 getTag_Label(null,(i+1)+"번째 이미지:",null,false)+
                            "</td>"+  
                            "<td>"+
                                "<div style='display:flex'>"+
                                   
                                    "<div id='img-container_"+i+"' style='cursor: pointer; border: 1px solid #ccc;width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;'  onclick='click_img("+i+")'>"+
                                        "<img id='img-preview_"+i+"' src='"+src+"' onerror='this.src=\""+BASE64_PICTURE+"\"' alt='큰이미지 미리보기' style='width: 100%; height: 100%; '>"+
                                        "<input type='file' id='input_pd_img_"+i+"' name='input_pd_img_"+i+"' src='"+src+"' style='display: none;'>"+
                                    "</div>"+
                                    "<img src='./img/btn_close_50.png' style='width:50px;height:50px;margin-left:-30px;margin-top:-20px' onclick='remove_preview_image("+i+")' title='이미지 삭제'>"+
                                    "<img src='./img/ic_img_editor.png' style='width:30px;height:30px;margin-left:-70px;margin-top:-10px' onclick='showEditorTest(\""+type+"\", "+i+")' title='이미지 에디터'>"+
                                "</div>"+
                            "</td>"+ 
                           previewtag+
                        "</tr>";
                }
                var display = _contentdata.useschoolapi == 1 ? "none" : "block";
                message_tag = "<div id='cdiv_tab0' style='display:"+display+"'>"+
                    "<table  id='ctable_tab0_' class='table table-borderless' style='width:100%;height:auto;border:0px;'>"+

                        mtag+

                        "<tr>"+
                            "<td colspan = '6'>"+
                                "<div id='fileProgress_"+i+"' style='width: 100%; height: 8px; margin-top: 5px; background-color: #f0f0f0; position: relative;border-radius:5px; display: none;'>"+
                                    "<div id='progressBar_"+i+"' style='width: 0%; height: 100%; background-color: #4caf50;border-radius:5px;'></div>"+
                                "</div>"+
                            "</td>"+
                        "</tr>"+
                    "</table>"+                  

                "</div>";
                
                showModalDialog(document.body, title_tag,  message_tag , "수정하기", "취소", function() {
                     onClickContentEdit(idx, _contentdata, MAX_LEN);
                },function(){
                    hideModalDialog();
                }, style);
            }
            else if(type == "webpage"){
  
                title_tag = "웹주소 입력";
                message_tag = 
                        "<table id='ctable_tab0_' class='table table-borderless' style='width:100%;height:auto;border:0px;'>"+
                            "<tr>"+
                                "<td>"+

                                    getTag_Label(null,"웹페이지 주소입력",null,true)+  
                                "</td>"+
                               

                            "</tr>"+//상품명
                            "<tr>"+
                              
                                "<td>"+
                                    getTag_Input("input_webpage_url", "type_text", _contentdata.url, null, null, "https://...")+
                                "</td>"+
                                      
                            "</tr>"+
                        "</table>";
                
                showModalDialog(document.body, title_tag,  message_tag , "수정하기", "취소", function() {
                    var input_webpage_url = document.getElementById("input_webpage_url");
                    _contentdata.url = input_webpage_url.value;
                     onClickWebpageEdit(idx, _contentdata, MAX_LEN);
                },function(){
                    hideModalDialog();
                }, style);
               
            }
            /////////////////////////////////////////
            // mapimg 타입
            /////////////////////////////////////////
            else if(type == "mapimg"){
                MAX_LEN  = 1;
                title_tag = _contentdata.name+" 이미지를 삽입하세요";
                var mtag = "";
                for(var i = 0 ; i < 1; i++){
                     var src = _contentdata.images && _contentdata.images.length > i ? game_url + _contentdata.images[i] +"?"+new Date().getTime() : "";
                     preview_img_tag += src ?  "<img id='show_preview_"+i+"' src='"+src+"' onerror='this.style.display=\"none\";' style='width:100%; height:auto;'>" : "";
                    
                    var previewtag = i == 0 ?  "<td rowspan='5'>"+
                                 "<h5>*미리보기</h5>"+
                                 "<div id='html_preview' style='background-color:#e9e9e9;border:1px solid #a9a9a9;width:600px;height:780px;overflow:scroll'>"+
                                    preview_img_tag+
                                "</div>"+
                            "</td>" : "";
                    mtag +=   
                        "<tr>"+
                            "<td>"+
                                 getTag_Label(null,(i+1)+"번째 이미지:",null,false)+
                            "</td>"+  
                            "<td>"+
                                "<div id='img-container_"+i+"' style='cursor: pointer; border: 1px solid #ccc;width: 100px; height: 100px; display: flex; justify-content: center; align-items: center;'  onclick='click_img("+i+")'>"+
                                    "<img id='img-preview_"+i+"' src='"+src+"' onerror='this.src=\""+BASE64_PICTURE+"\"' alt='큰이미지 미리보기' style='width: 100%; height: auto; object-fit: cover;border-radius:6px'>"+
                                    "<input type='file' id='input_pd_img_"+i+"' name='input_pd_img_"+i+"' src='"+src+"'  style='display: none;'>"+
                                    
                                "</div>"+
                                "<img src='./img/ic_img_editor.png' style='width:30px;height:30px;margin-left:-10px;margin-top:-110px' onclick='showEditorTest(\""+type+"\", "+i+")' title='이미지 에디터'>"+
                            "</td>"+ 
                           previewtag+
                        "</tr>";
                }
                
                message_tag = "<div id='cdiv_tab0' style=''>"+
                    "<table  id='ctable_tab0_' class='table table-borderless' style='width:100%;height:auto;border:0px;'>"+                       
                        mtag+                        
                        "<tr>"+
                            "<td colspan = '6'>"+
                                "<div id='fileProgress_' style='width: 100%; height: 8px; margin-top: 5px; background-color: #f0f0f0; position: relative;border-radius:5px; display: none;'>"+
                                    "<div id='progressBar_' style='width: 0%; height: 100%; background-color: #4caf50;border-radius:5px;'></div>"+
                                "</div>"+
                            "</td>"+
                        "</tr>"+
                    "</table>"+                                   
               "</div>";
                
                showModalDialog(document.body, title_tag,  message_tag , "수정하기", "취소", function() {
                     onClickContentEdit(idx, _contentdata, MAX_LEN);
                },function(){
                    hideModalDialog();
                }, style);
                    
            }
            
            /////////////////////////////////////////
            // 트랜드 타입
            /////////////////////////////////////////
            else if(type == "trand"){
                 title_tag = _contentdata.name+" [설문조사]";
                var screen_height = $(window).height();
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: "90%",
                        height: (screen_height*0.9)+"px"
                    }
                };
                
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);

                message_tag = "<iframe src='"+iframe_url+"' style='border:0;width:100%;height:"+(screen_height*0.7)+"px'>";
                  
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    
                    updatePreview(idx);
                     hideModalDialog();
                },null, style);
                return;
            }
            
             
            /////////////////////////////////////////
            // 교가 타입
            /////////////////////////////////////////
            else if(type == "lyrics"){
                 title_tag = _contentdata.name+" [설문조사]";
                var screen_height = $(window).height();
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: "90%",
                        height: (screen_height*0.9)+"px"
                    }
                };
                
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);

                message_tag = "<iframe src='"+iframe_url+"' style='border:0;width:100%;height:"+(screen_height*0.7)+"px'>";
                  
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    
                    updatePreview(idx);
                     hideModalDialog();
                },null, style);
                return;
            }
            
            /////////////////////////////////////////
            // 설문조사 타입
            /////////////////////////////////////////
            else if(type == "survey"){
                 title_tag = _contentdata.name+" [설문조사]";
                var screen_height = $(window).height();
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: "90%",
                        height: (screen_height*0.9)+"px"
                    }
                };
                
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);

                message_tag = "<iframe src='"+iframe_url+"' style='border:0;width:100%;height:"+(screen_height*0.7)+"px'>";
                  
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    
                    updatePreview(idx);
                     hideModalDialog();
                },null, style);
                return;
            }
            
            /////////////////////////////////////////
            // 게시판 타입
            /////////////////////////////////////////
            else if(type == "board" || type == "faq"){
                 title_tag = _contentdata.name+" [게시판]";
                var screen_height = $(window).height();
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: "90%",
                        height: (screen_height*0.9)+"px"
                    }
                };
                
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);

                message_tag = "<iframe src='"+iframe_url+"' style='border:0;width:100%;height:"+(screen_height*0.7)+"px'>";
                  
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                     
                    updatePreview(idx);
                    
                     hideModalDialog();
                },null, style);
                return;
            }
            /////////////////////////////////////////
            // Floor 타입
            /////////////////////////////////////////
            else if(type == "floor"){
                 title_tag = _contentdata.name+" [층별안내]";
                var screen_height = $(window).height();
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: "60%",
                        height: (screen_height*0.95)+"px"
                    }
                };
                
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);

                message_tag = "<iframe src='"+iframe_url+"' style='border:0;width:100%;height:"+(screen_height*0.7)+"px'>";
                    
                
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    updatePreview(idx);
                     hideModalDialog();
                },null, style);
                return;
            }

            /////////////////////////////////////////
            // 동영상 갤러리타입
            /////////////////////////////////////////
            else if(type.indexOf("video_gallery") >= 0){
                 title_tag = _contentdata.name+"<img src='./img/icon_add.png' style='float:right;margin-right:10px;cursor:pointer' onclick='insertVideoFile()' title='동영상 파일 업로드'/>";
                var screen_height = $(window).height();
                
                var width_percent =  type == "gallery2" ? "30%" : "50%";
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: width_percent,
                        height: (screen_height*0.95)+"px"
                    }
                };
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);
                console.log("gallery iframe_url "+iframe_url);

                var upload_tag = `<div id="div_uploadfile" align="center" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;display: none;justify-content: center;align-items: center;z-index: 9999;background-color: rgba(51, 51, 51, 0.5);">
                                     <div style="padding: 30px;background-color: white;border-radius: 20px;text-align: center;box-shadow: 0 0 10px rgba(0,0,0,0.3);">
                                        <input type="file" id="remoconFileInput" style="display:none"/><br>
                                        <progress id="remoconUploadProgress" value="0" max="100" style="width:300px;"></progress><br>
                                        <div id="div_progress_ani" class="progress-container" style="display:none">
                                            <div class="progress-bar"></div>
                                        </div>
                                        <div><span id="remoconUploadPercent"></span></div><br><br>
                                        <button onclick="hideVideoFileUploader()" style="width: 80px;height: 40px;font-size: 20px;border-radius: 8px;border: 1px solid #a2aaa9;background-color: #f2faf9;">닫기</button><br><br>
                                        <img id="thumbnailPreview" width="200" height="200" style="display:none"/>
                                    </div>
                                </div>`;

                var message_tag = `<div id="iframeContainer" style="position: relative;width: 100%;height: ${screen_height * 0.7}px;">
                                        <iframe src="${iframe_url}" style="border: 0;width: 100%;height: 100%;position: relative;z-index: 1;"></iframe>${upload_tag}
                                    </div>`;
   
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    updatePreview(idx);
                     hideModalDialog();
                },null, style);
                return;
            }
            
             
           
            /////////////////////////////////////////
            // 갤러리 타입 
            /////////////////////////////////////////
            else if(type.indexOf("gallery") >= 0){
                 title_tag = type == "pdf_gallery" ? _contentdata.name : _contentdata.name+checkIsGameModeToggle(_contentdata);
                var screen_height = $(window).height();
                
                var width_percent = type == "gallery2" ? "30%" : "50%";
                console.log("contentdata ",_contentdata);
                if(parseInt(_contentdata.width) > parseInt(_contentdata.height))width_percent = "70%";
                style = {
                    bodycolor: "white",
                    marginTop:"0px",
                    size: {
                        width: width_percent,
                        height: (screen_height*0.95)+"px"
                    }
                };
                var schoolapitype = _contentdata.schoolapitype ? _contentdata.schoolapitype : "";
               
                var iframe_url = getIFrameUrl(_contentdata, schoolapitype,"", 1);
                console.log("gallery iframe_url "+iframe_url);

                message_tag = "<iframe src='"+iframe_url+"' style='border:0;width:100%;height:"+(screen_height*0.7)+"px'>";
                    
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    updatePreview(idx);
                     hideModalDialog();
                },null, style);
                return;
            }
            
        }
        function hideVideoFileUploader(){
            console.log("hideVideoFileUploader!!");
            const div_uploadfile = document.getElementById("div_uploadfile");
             div_uploadfile.style.display = "none";
            clearDownloadSuccessCheckInterval();
        }
        function insertVideoFile(){
             var _data = {
                 "projectid":now_projectid,
                 "groupidx":session_groupidx,
                 "token":homepage_data.hm_fcmtoken,
                 "videothumb":""
             }
             uploadFileProcess(ADM_TYPE.UPLOAD_FILE, _data, "remoconFileInput", "remoconUploadProgress", "remoconUploadPercent", function(res){
                    code = parseInt(res.code);
                    if (code == 100) {
                        //upload file full path = res.message
                        var data = res.message;
                        var fullpath = data.fullpath;
                        var thumb_fullpath = data.thumbfullpath;
                        var uploadidx = data.uploadidx;

                        console.log("파일업로드 되었다 업로드경로 : "+data.fullpath);
                        document.getElementById("remoconUploadPercent").innerHTML = "기기에서 파일 다운로드중...";
                        document.getElementById("remoconUploadProgress").style.display = "none";
                        document.getElementById("div_progress_ani").style.display = "block";

                        sendPush("remote_control", "{'event': 'direct_download', 'option':{'url':'"+fullpath+"','callback': 'true','uploadidx': '"+uploadidx+"'}}");

                        //DB 비디오 목록을 갱신시킨다.
//                        setTimeout(function(){
//                            sendPush("video_storage", "");    
//                        },500); 
                        
                        //썸네일이 있다면 썸네일도 다운로드 시킨다. 호출만 하고 체크는 안함
                        if(thumb_fullpath){
                            setTimeout(function(){
                                sendPush("remote_control", "{'event': 'direct_download', 'option':{'url':'"+thumb_fullpath+"','callback': 'false'}}");    
                            },200);    
                        }
                       
                        

    //                        sendPush("direct_download" , "{'url':'"+res.message+"','callback': 'false'}");
                        startDownloadSuccessCheckInterval(uploadidx);

                    } else {
                        //
                          console.log("파일업로드 실패!!");
                    }
             });
         
        }
     
         var uploadcheck_timer = null;
     function startDownloadSuccessCheckInterval(uploadidx){
         clearDownloadSuccessCheckInterval();
         uploadcheck_timer = setInterval(function () {
             
             sendDownloadcheck(uploadidx);
        }, 2000);
     }
    function clearDownloadSuccessCheckInterval(){
        if(uploadcheck_timer){
            clearInterval(uploadcheck_timer);
            uploadcheck_timer = null;
            downlod_text_count = 0;
            document.getElementById("remoconFileInput").value = "";
            document.getElementById("remoconUploadProgress").style.display = "block";
            document.getElementById("div_progress_ani").style.display = "none";
         }
    }
    var downlod_text_count = 0;
     function sendDownloadcheck(uploadidx){

         url = FILE_UPLOAD_PLACE;
         var senddata = {
            type :"downloadsuccesscheck",
            value : uploadidx    
         };
     
             
         
         C_AsyncCall(url, senddata, function (res) {
            console.log("res is ",res);
            var code = parseInt(res.code);
            if(code == 100){
                console.log("다운로드체크 : 성공!!!");
                clearDownloadSuccessCheckInterval();

                hideVideoFileUploader();
                alertMsg("파일을 성공적으로 전송하였습니다.",function(){
                    sendPush("app_restart", "");    
                });
                
            }else if(code == -111){ //시간초과
                console.log("다운로드체크 : 시간초과!!!");
                clearDownloadSuccessCheckInterval();

                alertMsg("시간초과");
                
            }
             else {
                 console.log("다운로드체크 : 현재 다운로드중!!!");

                //현재 다운로드 중이다.
                 if(downlod_text_count%3 == 0){
                    document.getElementById("remoconUploadPercent").innerHTML = "기기에서 파일 다운로드중."; 
                 }                    
                 else if(downlod_text_count%3 == 1){
                     document.getElementById("remoconUploadPercent").innerHTML = "기기에서 파일 다운로드중..";
                 }                     
                 else {
                     document.getElementById("remoconUploadPercent").innerHTML = "기기에서 파일 다운로드중...";
                 }

                 downlod_text_count++;
            }

        }, function (err) {
            console.log("err is ",err);


        }); 
         
     }
        function updatePreview(idx){
            var iframe_preview = document.getElementById("iframe_preview");
            iframe_preview.src = iframe_preview.src;
            var preview = document.getElementById("id_preview_"+idx);
            preview.src = preview.src;
        }
          
        function remove_preview_image(idx){
            var img_thumb = document.getElementById("img-preview_"+idx); // 왼쪽 썸네일 이미지
            var show_preview = document.getElementById("show_preview_"+idx); //오른쪽 미리보기 안의 이미지
            var input_pd_img = document.getElementById("input_pd_img_"+idx);// 입력 이미지
            input_pd_img.value = "";
            show_preview.src = "";
            show_preview.style.display = "none";
            img_thumb.src = "";
        }
     function contentDataTogglechange(key,idx){
            var ptoggle = document.getElementById(key+"_"+idx);
            var ptoggle_icon = document.getElementById(key+"_span_"+idx);
            var ptoggle_txt = document.getElementById(key+"_txt_"+idx);

            if(ptoggle.checked){
                ptoggle_txt.innerHTML = "&nbsp;ON";
//                ptoggle_txt.style.color = "white";
                ptoggle_icon.style.backgroundColor = "#2194f3";
                if(key == "toggle_safetydata"){                   
                    updateSafetyData(1,homepage_data.hm_safety_closetime);
                    
                }else if(key == "toggle_schooldata"){
                    document.getElementById("cdiv_tab0").style.display = "none";
                    for(var i = 0 ; i < contentdatas.length; i++){
                        if(contentdatas[i].id == idx){
                            contentdatas[i].useschoolapi = 1;
                            break;
                        }
                    }
                    sendContentDatas(contentdatas);
                }else if(key == "toggle_gamemode"){
                    for(var i = 0 ; i < contentdatas.length; i++){
                        if(contentdatas[i].id == idx){
                            contentdatas[i].gamemode = 1;
                            break;
                        }
                    }
                    sendContentDatas(contentdatas);
                }
            }else{
                ptoggle_txt.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
//                ptoggle_txt.style.color = "white";
                ptoggle_icon.style.backgroundColor = "#cccccc";
                if(key == "toggle_safetydata"){                     
                    updateSafetyData(0,homepage_data.hm_safety_closetime);
                }else if(key == "toggle_schooldata"){
                    document.getElementById("cdiv_tab0").style.display = "block";
                    for(var i = 0 ; i < contentdatas.length; i++){
                        if(contentdatas[i].id == idx){
                            contentdatas[i].useschoolapi = 0;
                            break;
                        }
                    }
                    sendContentDatas(contentdatas);
                }else if(key == "toggle_gamemode"){
                    for(var i = 0 ; i < contentdatas.length; i++){
                        if(contentdatas[i].id == idx){
                            contentdatas[i].gamemode = 0;
                            break;
                        }
                    }
                    sendContentDatas(contentdatas);
                }
                
            }
            
        }
        function showSafetySettingPopup(){
            var safetydata_onoff = homepage_data.hm_safety_onoff;
            var countrys =["", "서울특별시", "부산광역시", "대구광역시", "인천광역시", "광주광역시", "대전광역시", "울산광역시", "세종특별자치시", "경기도", "강원특별자치도", "충청북도", "충청남도","전북특별자치도","전라남도","경상북도","경상남도","제주특별자치도"];
            var country_options_tag = "";
            for(var i = 0; i < countrys.length; i++){
                var selected = "";
                if(countrys[i] == "" && homepage_data.hm_region == "") 
                    selected = "selected";
                else 
                    selected = homepage_data.hm_region && countrys[i] == homepage_data.hm_region ? "selected" : "";
                country_options_tag +=  countrys[i] == "" ? "<option value='' "+selected+">-- 선택하세요 --</option>" : "<option value='"+countrys[i]+"'  "+selected+">"+countrys[i]+"</option>";
            }
            var country_tag = "<div style='float:left;height:50px;'>"+
                "*지역 : <select id='select_region' style='width:200px;height: 40px; border:1px solid #c0c0c0;border-radius:6px'>"+
                country_options_tag
            + "</select></div>";

            var title_tag = "재난안전 알림 설정";
           
            var closetime_tag = "<div style='float:left;height:50px'>*알림표시시간&nbsp;&nbsp;<span style='color:blue;font-weight:bold'>(0:계속표시, 1~1800초(30분))</span> : <input id='input_closetime' type='number' min='0' max='1800' step='1' value='"+homepage_data.hm_safety_closetime+"' style='height: 40px; border:1px solid #c0c0c0;border-radius:6px;padding-left:10px' inputmode='numeric' pattern='[0-9]*' maxlength='3' onkeydown=\"if(['e','E','+','-','.'].includes(event.key)) event.preventDefault();\" oninput=\"this.value=this.value.replace(/[^0-9]/g,''); if(this.value!==''){var v=parseInt(this.value,10); if(v<0) this.value=0; else if(v>1800) this.value=1800;}\" />초</div>";

            var message_tag = country_tag+"<br><br><br>"+closetime_tag;
            showModalDialog(document.body, title_tag,  message_tag , "저장하기", "취소", function() {
                 var input_closetime_value = document.getElementById("input_closetime") ? parseInt(document.getElementById("input_closetime").value) : 0;
                 updateSafetyData(safetydata_onoff, input_closetime_value);
                 hideModalDialog();
            },function(){                               
                 hideModalDialog();
            }, null);
        }
        function updateSafetyData(safetydata_onoff, closetime){
                        
            var data = {
                "projectid" : now_projectid,
                "safetyonoff": safetydata_onoff,
                "closetime" : closetime
            };
            
            AJAX_AdmGet(ADM_TYPE.UPDATE_SAFETY_DATA, data, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                   homepage_data.hm_safety_onoff = safetydata_onoff;
                   homepage_data.hm_safety_closetime = closetime;
                   var txt =  safetydata_onoff == 1 ? "재난안전문자가 활성화되었습니다." : "재난안전문자가 비활성되었습니다.";
                   C_showToast("수정완료!",txt);
               }               
            });   
        }
        
        function sendContentDatas(_contentdatas,callback){
            var data = {
                "projectid" : now_projectid,
                "contentdatas" : _contentdatas
            };
            
            AJAX_AdmGet(ADM_TYPE.UPDATE_CONTENT_DATA, data, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                   console.log("UPDATE_CONTENT_DATA res is ",res);
                   contentdatas = _contentdatas;
                   
                    C_showToast("수정완료!","컨텐츠 데이터를 수정하였습니다");
//                   hideModalDialog();
                   if(callback)callback();
               }               
            });          
        }
        function sendHomeDatas(_homedatas){
            var data = {
                "projectid" : now_projectid,
                "homedatas" : _homedatas
            };
            
            
            AJAX_AdmGet(ADM_TYPE.UPDATE_HOME_DATA, data, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                   console.log("UPDATE_HOME_DATA res is ",res);
                   homedatas = _homedatas;
                   
                    C_showToast("수정완료!","홈데이터를 수정하였습니다");
                   hideModalDialog();
               }               
            });          
        }
        function sendMainDatas(_maindatas){
            var data = {
                "projectid" : now_projectid,
                "maindatas" : _maindatas
            };
            
            AJAX_AdmGet(ADM_TYPE.UPDATE_MAIN_DATA, data, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                   console.log("UPDATE_MAIN_DATA res is ",res);
                   maindatas = _maindatas;
                   
                   C_showToast("수정완료!","메인데이터를 수정하였습니다");
                   hideModalDialog();
                   
               }               
            });          
        }
        function checkIsSchoolDataToggle(_contentdata){
            console.log("checkIsSchoolDataToggle 000",_contentdata);
            var toggle_tag = "";
            var checked = _contentdata.useschoolapi == 1 ? "checked" : "";
            var txt_onoff = _contentdata.useschoolapi == 1 ? "&nbsp;ON" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
            if(_contentdata.schoolapitype){
                
                toggle_tag = "<span><text style='margin-top:1px;float:right;width:auto' title='ON 으로 켜졌을때 학교정보사이트에서 정보를 가져올 수 있습니다.'>Neis "+_contentdata.name+" 연동</text><label class='switch' style='float:right;margin-top:0px;'>"+
                                "<input id='toggle_schooldata_"+_contentdata.id+"' type='checkbox' onchange='contentDataTogglechange(\"toggle_schooldata\",\""+_contentdata.id+"\")'  "+checked+">"+
                                "<span id='toggle_schooldata_span_"+_contentdata.id+"' class='slider round'>"+
                                    "<text class='fmont' id='toggle_schooldata_txt_"+_contentdata.id+"'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:blue'>&nbsp;ON</text>"+
                                "</span>"+
                            "</label></span>";
                
            }
           
            return toggle_tag;
        }
        function checkIsGameModeToggle(_contentdata){
            console.log("checkIsGameModeToggle 000",_contentdata);
            var toggle_tag = "";
            if(!_contentdata.gamemode)return toggle_tag;//게임모드 json 이 아예없으면 토글버튼이 없다.
            var checked = _contentdata.gamemode == 1 ? "checked" : "";
            var txt_onoff = _contentdata.gamemode == 1 ? "&nbsp;ON" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
            
                
                toggle_tag = "<span><text style='margin-top:1px;float:right;width:auto' title='ON 으로 켜졌을때 갤러리에서 퍼즐게임을 즐길 수 있습니다.'>게임모드 활성화</text><label class='switch' style='float:right;margin-top:0px;'>"+
                                "<input id='toggle_gamemode_"+_contentdata.id+"' type='checkbox' onchange='contentDataTogglechange(\"toggle_gamemode\",\""+_contentdata.id+"\")'  "+checked+">"+
                                "<span id='toggle_gamemode_span_"+_contentdata.id+"' class='slider round'>"+
                                    "<text class='fmont' id='toggle_gamemode_txt_"+_contentdata.id+"'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:blue'>&nbsp;ON</text>"+
                                "</span>"+
                            "</label></span>";
                
            
           
            return toggle_tag;
        }
        function getIFrameUrl(contentdata, schoolapitype, url, editmode){
            var id = contentdata.id;
            var type = contentdata.type;
            var imgfoldername = "";
            var param_isinfo = "";
            if(type == "gallery1"){
                imgfoldername = contentdata["imgfoldername"] ? "&imgfoldername="+contentdata["imgfoldername"] : "";
                param_isinfo = "&isinfo=1";
            }
            else if(type == "gallery2"){
                imgfoldername = contentdata["imgfoldername"] ? "&imgfoldername="+contentdata["imgfoldername"] : "&imgfoldername=gallery2";
            }
            var iframe_url = "";
            var fname = "";
            
            if(schoolapitype && editmode == 1){
                fname = "webpage/type_schooldata.html";
                iframe_url = "../../../game/"+fname+"?projectid="+now_projectid+"&groupidx="+session_groupidx+"&listid="+id+"&apitype="+schoolapitype+"&orientation="+orientation+"&editmode="+editmode+"&date="+new Date().getTime()
                return iframe_url;
            }
            else if(type == "game"){
                iframe_url = "../../../"+url;
                return iframe_url;
            }   
            else{
                fname = "";
                var param_pdfcategory = contentdata.pdfcategory ? "&pdfcategory="+contentdata.pdfcategory : "";
                switch(type){
                    case "html":
                        fname = "webpage/type_image.html";
                        break;
                   
                    case "img":
                        fname = "webpage/type_image.html";
                        break;
                    case "survey":
                        fname = "webpage/type_survey_list.html";
                        break;
                    case "floor":
                        fname = "webpage/type_floor.html";
                        break;
                    case "faq":
                        fname = "webpage/type_faq.html";
                        break;
                    case "board":
                        fname = "webpage/type_board.html";
                        break;
                    case "pdf_gallery":
                        fname = "webpage/type_pdf_upload.html";
                        break;
                    case "gallery":
                        fname = "webpage/type_gallery.html";
                        break;
                    case "gallery1":
                        fname = "webpage/type_gallery1.html";
                        break;
                    case "gallery2":
                        fname = "webpage/type_gallery2.html";
                        
                        break;
                    case "mapimg":                        
                        fname = "/school/"+now_projectid+"/v"+session_groupidx+"/"+url;
                        break;
                    case "video_gallery":   
                         fname = "webpage/type_video_gallery.html";
                        break;
                   case "trand":
                        fname = "webpage/type_trand_list.html";
                        break;
                    case "lyrics":
                        fname = "webpage/type_lyrics_list.html";
                        break;
                    case "webpage":
                        fname = "";
                        break;
                   
                     default:
                        
                        break;
                }
                iframe_url = "../../../game/"+fname+"?projectid="+now_projectid+"&groupidx="+session_groupidx+"&listid="+id+"&editmode="+editmode+imgfoldername+param_pdfcategory+param_isinfo+"&date="+new Date().getTime();
                if(type == "video_gallery")
                    iframe_url += "&fcmtoken="+homepage_data.hm_fcmtoken;
                console.log("iframe_url ::: "+iframe_url);
                return iframe_url;
            }
            
        }
       function base64ToFile(base64, filename, mimeType) {
            const arr = base64.split(',');
            const mime = mimeType || arr[0].match(/:(.*?);/)[1];
            const bstr = atob(arr.length > 1 ? arr[1] : arr[0]);
            let n = bstr.length;
            const u8arr = new Uint8Array(n);

            while (n--) {
                u8arr[n] = bstr.charCodeAt(n);
            }

            return new File([u8arr], filename, { type: mime });
        }
        function onClickWebpageEdit(idx, _contentdata, MAX_LEN) {
           
              
            var _data = {
                "contentdataid": _contentdata.id,
                "contentdataurl": _contentdata.url,
                "projectid": now_projectid,
                "groupidx": session_groupidx
            };

            AJAX_AdmGet(ADM_TYPE.UPDATE_CONTENT_WEBPAGE_DATA,_data,function(res){
               code = parseInt(res.code);
                if (code == 100) {
                    for(var i = 0 ; i < contentdatas.length;i++){
                        if(contentdatas[i].id == _contentdata.id){
                            contentdatas[i].url = _contentdata.url;
                            break;
                        }    
                    }
                    
                    reloadPreview(idx, "contentdata", _contentdata.url);
                    hideModalDialog();
                    hideModalDialog();
                    C_showToast("수정성공!", "웹주소를 수정하였습니다.");
                }else {
                    C_showToast("수정실패!", "웹주소 수정중 오류가 발생하였습니다.");
                }
            });
        }
        function onClickContentEdit(idx, _contentdata, MAX_LEN) {
            var img_files = [];

            for (var i = 0; i < MAX_LEN; i++) {
                var input_pd_img = document.getElementById("input_pd_img_" + i);
                console.log(i + " input_pd_img ", input_pd_img);

                if (input_pd_img.files && input_pd_img.files.length > 0) {
                    // 파일이 있다면 그대로 사용
                    img_files.push(input_pd_img.files[0]);
                } else if (input_pd_img.src && input_pd_img.src.startsWith("data:image")) {
                    // base64 이미지가 있을 경우 File 객체로 변환
                    const base64Data = input_pd_img.src;
                    const file = base64ToFile(base64Data, `image_${i}.png`, "image/png");
                    img_files.push(file);
                } else {
                    img_files.push(null); // 해당 인덱스 비워둘 수도 있음
                }
            }

            var _data = {
                "contentdata": _contentdata,
                "projectid": now_projectid,
                "groupidx": session_groupidx
            };

            uploadFormContentProcess(ADM_TYPE.UPLOAD_CONTENT_DATA, _data, "fileProgress_", "progressBar_", img_files, false, function(res) {
                hideModalDialog();
                hideModalDialog();

                if (res == "success") {
                    C_showToast("수정완료!", "[" + _data.contentdata.name + "] 를 수정하였습니다");
                    reloadPreview(idx, "contentdata");
                } else {
                    C_showToast("수정실패!", "이미지 수정 중 오류가 발생하였습니다.");
                }
            });
        }

        
        function reloadPreview(idx, statistic_key, newurl) {
            
            if(statistic_key == "contentdata"){
                const el = document.getElementById("id_preview_"+idx);
                if (!el){
                  return;  
                } 
               
                // 공통: 기존 src에서 쿼리스트링 제거하고 타임스탬프를 붙여 유니크하게 변경
                var base = (el.tagName.toLowerCase() === 'iframe' ? el.src : el.getAttribute('src')).split('?')[0];
                if(newurl)base = newurl;
                const newSrc = `${base}?_=${Date.now()}`;
                el.src = newSrc;
                console.log("newSrc is "+newSrc);
                
            }else if(statistic_key == "homedata"){
                const el = document.getElementById("id_home_preview_img_"+idx);
                const clickel = document.getElementById("id_home_preview_clickimg_"+idx);
                
                if (!el && !clickel){
                  return;  
                } 
                
                if(el){
                    const base = el.getAttribute('src').split('?')[0];
                    const newSrc = `${base}?_=${Date.now()}`;
                    el.src = newSrc;
                    
                }
                
                if(clickel){
                    const clickbase = clickel.getAttribute('src').split('?')[0];
                    const clicknewSrc = `${clickbase}?_=${Date.now()}`;
                    clickel.src = clicknewSrc;
                }
                
            }else if(statistic_key == "maindata"){
                const el = document.getElementById("id_main_preview_img_"+idx);
                const clickel = document.getElementById("id_main_preview_clickimg_"+idx);
                
                if(el){
                    const base = el.getAttribute('src').split('?')[0];
                    const newSrc = `${base}?_=${Date.now()}`;
                    el.src = newSrc;
                    
                }
                
                if(clickel){
                    const clickbase = clickel.getAttribute('src').split('?')[0];
                    const clicknewSrc = `${clickbase}?_=${Date.now()}`;
                    clickel.src = clicknewSrc;
                }
            }
            
            initIframePreview();
            
        }
        function checkChannelPermission(type ){
            
            
            var permission_flg = true;             
            if(auth_num > 99){
                return permission_flg;
            }
            var channel_permissions = JSON.parse(setting)["channel"];
            var _permission_flag = channel_permissions[type];
            
            if(_permission_flag == "false"){
                permission_flg = false;
                switch(type){
                    case PERMISSION_NEW_CHAANEL:
                        var button_new_channel = document.getElementById("button_new_channel")
                        button_new_channel.disabled = true;
                        button_new_channel.style.backgroundColor = "#cccccc";
                        break;
                    case PERMISSION_REMOVE_CHAANEL:
                        break;
                    case PERMISSION_EDIT_DEFAULT:
                        break;
                    case PERMISSION_EDIT_STUDY:
                        break;
                        
                }
            }
            return permission_flg; 
            
            
             
        }
        var date = new Date();
        var nowtimestamp = date.getTime();
        var now_object = null;
        function showPopupProductData(i, statistic_key, home_notice_idx){
            

            var product = statistic_key == "homedata" ? homedatas[i] : maindatas[i];
            now_object = product;
            var txt_ischecked = product.pd_istax == "Y" ? "checked" : "";
            console.log("product ",product);
            console.log("categorys ",categorys);
            console.log("product ",product);
             
            var image_path = product.type == "button_empty" ? "./img/empty_button.png" : product.imgurl+"?" + new Date().getTime();
            
            var clickimage_path = product.clickurl;
             
            var event_string = product.event && isJsonObject(product.event) ? JSON.stringify(product.event) : ""; 
            
            var categorys =[{"value":"img", "text":"이미지타입"},{"value":"button", "text":"버튼타입"},{"value":"button_empty", "text":"투명버튼타입"},{"value":"animation", "text":"애니메이션타입"},{"value":"text", "text":"텍스트타입"},{"value":"airapi", "text":"미세먼지표시"},{"value":"weatherapi", "text":"오늘날씨표시"}]; 
             console.log("product.type ",product.type);
            var event_locked = auth < AUTH_OWNER ? "readonly" : "";
            var event_bgcolor = auth < AUTH_OWNER ? "background-color:#e0e0e0;color:gray" : "";
            
            var tr_img_display = product.type == "text" || product.type == "airapi" || product.type == "weatherapi"  ? "none" : "block";
            
            var home_notice_data = null;
            var home_notice_tag = "";
            
            
            
            if(home_notice_idx != undefined){
                home_notice_data = arr_home_notice_datas[home_notice_idx];   
                
                
                var name = "homenotice";
                var txt_off = "숨기기";
                var txt_on = "보이기";
                var txt_default = home_notice_data.lt_show == "Y" ? "보이기" : "숨기기";
                var toggle_open = home_notice_data.lt_show == "Y" ? "checked" : "";
                var home_notice_toggle_tag = "<div style='width:100%; height:auto;padding-left:10px;padding-right:5px;'>" +
                                                "<label class='switch' style='float:left;'>" +
                                                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")' "+toggle_open+">" +
                                                "<span id='toggle_icon_"+name+"'  class='slider round'>" +
                                                "</span>" +
                                                "</label>" +
                                                 "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;'>"+txt_default+"</text>" +
                                            "</div>";

                home_notice_tag = 
                        "<table id='ctable_tab0_' class='table table-borderless' style='width:100%;height:auto;border:0px;'>"+
                            "<tr>"+
                                "<td>"+

                                    getTag_Label(null,"날짜",null,true)+  
                                "</td>"+
                                "<td>"+
                                     getTag_Label(null,"제목",null,true)+
                                "</td>"+                
                                "<td>"+
                                    getTag_Label(null,"내용",null,true)+
                                "</td>"+
                                "<td>"+
                                    getTag_Label(null,"활성/비활성",null,true)+
                                "</td>"+

                            "</tr>"+//상품명
                            "<tr>"+
                                "<td>"+
                                    getTag_Input("input_notice_date", "type_date",home_notice_data.lt_date.substr(0,10) , null, null, "날짜 입력")+
                                "</td>"+   
                                "<td>"+
                                    getTag_Input("input_notice_title", "type_text", home_notice_data.lt_title, null, null, "제목입력")+
                                "</td>"+
                                "<td>"+
                                    getTag_TextArea("input_notice_message",  home_notice_data.lt_message, null, "내용 입력",null,"200px")+

                                "</td>"+        
                                "<td>"+
                                     home_notice_toggle_tag+
                                "</td>"+        
                            "</tr>"+
                        "</table>";
            }
            var text_tag = "";
            
            if(product.text && product.text[language_code].message){
                var title_tag_ko = product.text["KO"] ? "<td>"+getTag_Label(null,"KO","margin-left:60px;margin-right:20px;",false)+"</td>" : "";
                var title_tag_en = product.text["EN"] ? "<td>"+getTag_Label(null,"EN","margin-left:60px;margin-right:20px;",false)+"</td>" : "";
                var title_tag_zh = product.text["ZH"] ? "<td>"+getTag_Label(null,"ZH","margin-left:60px;margin-right:20px;",false)+"</td>" : "";
                var title_tag_vi = product.text["VI"] ? "<td>"+getTag_Label(null,"VI","margin-left:60px;margin-right:20px;",false)+"</td>" : "";
                var title_tag_ms = product.text["MS"] ? "<td>"+getTag_Label(null,"MS","margin-left:60px;margin-right:20px;",false)+"</td>" : "";
                
                var textarea_tag_ko = product.text["KO"] ? "<td>"+"<textarea id='textarea_ko_text_"+i+"' style='width:150px;height:70px;' >"+replacePLineToEnter(product.text["KO"].message)+"</textarea>"+"</td>" : "";
                var textarea_tag_en = product.text["EN"] ? "<td>"+"<textarea id='textarea_en_text_"+i+"' style='width:150px;height:70px;' >"+replacePLineToEnter(product.text["EN"].message)+"</textarea>"+"</td>" : "";
                var textarea_tag_zh = product.text["ZH"] ? "<td>"+"<textarea id='textarea_zh_text_"+i+"' style='width:150px;height:70px;' >"+replacePLineToEnter(product.text["ZH"].message)+"</textarea>"+"</td>" : "";
                var textarea_tag_vi = product.text["VI"] ? "<td>"+"<textarea id='textarea_vi_text_"+i+"' style='width:150px;height:70px;' >"+replacePLineToEnter(product.text["VI"].message)+"</textarea>"+"</td>" : "";
                var textarea_tag_ms = product.text["MS"] ? "<td>"+"<textarea id='textarea_ms_text_"+i+"' style='width:150px;height:70px;' >"+replacePLineToEnter(product.text["MS"].message)+"</textarea>"+"</td>" : "";
                
                text_tag = "<div style = 'margin-left:100px'>"+
                    getTag_Label(null,"버튼내부글자","margin-left:0px;margin-right:20px;",true)+
                    "<br>"+
                    "<table style='border:1px solid #e9e9e9'>"+
                        "<tr>"+
                            title_tag_ko+title_tag_en+title_tag_zh+title_tag_vi+title_tag_ms+
                    
                        "</tr>"+
                        "<tr>"+
                            textarea_tag_ko+textarea_tag_en+textarea_tag_zh+textarea_tag_vi+textarea_tag_ms+                            
                        "</tr>"+
                    "</table>"+
                 "</div>";
//              
            }     
            
            var message_tag = "<div id='cdiv_tab0' style=''>"+
                    "<table id='ctable_tab0_' class='table table-borderless' style='width:100%;height:auto;border:0px;'>"+
                        "<tr>"+
                            "<td>"+
                
                                getTag_Label(null,"이름",null,true)+  
                            "</td>"+
                            "<td>"+
                                getTag_Input("input_pd_name_"+i, "type_text", product.name, null, null, "상품명 입력")+getTag_Label("lbl_id_"+i,product.id,"display:none",false)+
                            "</td>"+                
                            "<td>"+
                                getTag_Label(null,"타입",null,true)+
                            "</td>"+
                            "<td>"+
                                getTag_Select("select_type_"+i, "-- 타입 선택 --", categorys, "value", "text", null, product.type, null, null,"disabled")+
                            "</td>"+                
                        "</tr>"+//상품명
                        "<tr>"+
                            "<td>"+
                                getTag_Label(null,"X좌표",null,true)+
                            "</td>"+
                            "<td>"+
                                getTag_Input("input_pd_x_"+i, "type_number", product.x, null, null, "x좌표")+
                            "</td>"+   
                            "<td>"+
                                getTag_Label(null,"y좌표",null,true)+
                            "</td>"+
                            "<td>"+
                                getTag_Input("input_pd_y_"+i, "type_number", product.y, null, null, "y좌표")+
                            "</td>"+        
                        "</tr>"+
                        
                        "<tr>"+
                            "<td colspan='4'>"+
//                                getTag_Label(null,"이미지",null,true)+
//                            "</td>"+
//                            "<td>"+
                                
                                "<div style='display:flex;'>"+
                                    getTag_Label(null,"기본이미지",null,true)+
                                     "<div id='thumbnail-container_"+i+"' style='margin-left:80px;margin-right:20px;cursor: pointer; width: 100px; height: 100px; border: 1px solid #ccc; display: flex; justify-content: center; align-items: center;'  onclick='click_thumb("+i+")'>"+
                                        "<img id='thumbnail-preview_"+i+"'  src='"+image_path+"' onerror='this.src=\""+BASE64_PICTURE+"\"' alt='썸네일 미리보기' style='width: 100%; height: auto; object-fit: cover;margin-top:-5px;border-radius:6px'>"+
                                        "<input type='file' id='input_pd_thumb_"+i+"' name='input_pd_thumb_"+i+"' style='display: none;'>"+
                                    "</div>"+
                                    "<img src='./img/ic_img_editor.png' style='width:30px;height:30px;margin-left:-30px;margin-top:-10px' onclick='showEditorTest(\"img_home_default\", "+i+")' title='이미지 에디터'>"+
                                     getTag_Label(null,"클릭이미지","margin-left:50px",true)+
                                     "<div id='img-container_"+i+"' style='margin-left:20px;cursor: pointer; width: 100px; height: 100px; border: 1px solid #ccc; display: flex; justify-content: center; align-items: center;'  onclick='click_img("+i+")'>"+
                                        "<img id='img-preview_"+i+"' src='"+clickimage_path+"' onerror='this.src=\""+BASE64_PICTURE+"\"' alt='큰이미지 미리보기' style='width: 100%; height: auto; object-fit: cover;border-radius:6px'>"+
                                        "<input type='file' id='input_pd_img_"+i+"' name='input_pd_img_"+i+"' style='display: none;'>"+
                                    "</div>"+
                                    "<img src='./img/ic_img_editor.png' style='width:30px;height:30px;margin-left:-10px;margin-top:-10px' onclick='showEditorTest(\"img_home_click\", "+i+")' title='이미지 에디터'>"+
                                    text_tag+
                                "</div>"+
//                            "</td>"+  
//                            "<td>"+
//                                getTag_Label(null,"이벤트",null,true)+
//                            "</td>"+
//                            "<td>"+
                                 "<textarea id='textarea_event_"+i+"' style='display:none;width:100%;height:100px;"+event_bgcolor+"' "+event_locked+">"+event_string+"</textarea>"+
                            "</td>"+  
                        "</tr>"+//상품명
                        home_notice_tag+
                        
                        "<tr>"+
                            "<td colspan = '4'>"+
                                "<div id='fileProgress_"+i+"' style='width: 100%; height: 8px; margin-top: 5px; background-color: #f0f0f0; position: relative;border-radius:5px; display: none;'>"+
                                    "<div id='progressBar_"+i+"' style='width: 0%; height: 100%; background-color: #4caf50;border-radius:5px;'></div>"+
                                "</div>"+
                            "</td>"+
                        "</tr>"+
                    "</table>"+                                   
               "</div>";
               
            
              var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "80%",
                        height: "auto"
                    }
                };
                var title_tag = "["+product.name+"] 정보";
                showModalDialog(document.body, title_tag,  message_tag , "수정하기", "취소", function() {
                     if(home_notice_idx != undefined){
                         var notice_date = document.getElementById("input_notice_date").value;
                         var notice_title = document.getElementById("input_notice_title").value;
                         var notice_message = replaceEnterToNewline(document.getElementById("input_notice_message").value);
                         var notice_show = document.getElementById("toggle_homenotice").checked ? "Y" : "N";
                         home_notice_data.lt_date = notice_date;
                         home_notice_data.lt_title = notice_title;
                         home_notice_data.lt_message = notice_message;
                         home_notice_data.lt_show = notice_show;
                     }
                     onClickProductEdit( i , statistic_key, home_notice_data);
                     
                    
                },function(){
                        hideModalDialog();
                }, style);
        }
        function onClickProductEdit(idx, statistic_key, home_notice_data){
            var lbl_id = document.getElementById("lbl_id_"+idx);
            var input_pd_name = document.getElementById("input_pd_name_"+idx);
            var select_category = document.getElementById("select_type_"+idx);
            var input_pd_x = document.getElementById("input_pd_x_"+idx);
            var input_pd_y = document.getElementById("input_pd_y_"+idx);
            var textarea_event = document.getElementById("textarea_event_"+idx);
            var textarea_ko_text = document.getElementById("textarea_ko_text_"+idx);
            var textarea_en_text = document.getElementById("textarea_en_text_"+idx);
            var textarea_zh_text = document.getElementById("textarea_zh_text_"+idx);
            var textarea_vi_text = document.getElementById("textarea_vi_text_"+idx);
            var textarea_ms_text = document.getElementById("textarea_ms_text_"+idx);
            var textdata = null;
            if(textarea_ko_text){
                if(now_object.text["KO"])now_object.text["KO"].message = replaceEnterToPLine(textarea_ko_text.value);
                if(now_object.text["EN"])now_object.text["EN"].message = replaceEnterToPLine(textarea_en_text.value);
                if(now_object.text["ZH"])now_object.text["ZH"].message = replaceEnterToPLine(textarea_zh_text.value);
                if(now_object.text["VI"])now_object.text["VI"].message = replaceEnterToPLine(textarea_vi_text.value);
                if(now_object.text["MS"])now_object.text["MS"].message = replaceEnterToPLine(textarea_ms_text.value);
                textdata = now_object.text;
            }
            console.log("textarea_event "+textarea_event.value);
            var textarea_event_value = textarea_event.value ? JSON.parse(textarea_event.value) : {};
            var _data = {
                    "id":lbl_id.innerHTML+"",
                    "projectid":now_projectid,
                    "groupidx":session_groupidx,
                    "pagetype":statistic_key, //homedata , maindata
                    "name" : input_pd_name.value,
                    "type" : select_category.value,
                    "x" : parseInt(input_pd_x.value),
                    "y" : parseInt(input_pd_y.value),
                    "event":textarea_event_value,
                    "homenoticedata":home_notice_data,
                    "text":textdata
                }

            
            uploadFormProcess(ADM_TYPE.UPDATE_UI_DATA, _data, "fileProgress_"+idx, "progressBar_"+idx, "input_pd_thumb_"+idx, "input_pd_img_" + idx, false,function(res){
                 hideModalDialog();
                hideModalDialog();
                 if(res == "success"){
                    
                C_showToast("수정완료!","["+_data.name+"] 를 수정하였습니다");
                 // 미리보기 수정해야함

                 
                   reloadPreview(idx, statistic_key);    


                     
                }else{
                     //메일발송 실패
                     C_showToast("상품수정실패!","상품 수정중 오류가 발생하였습니다.");
                }
               
            });
            
        }
        //채널박스 생성
        function drawChannels(res){
            
            var len = res ? res.length : 0;
            if(len > 0)updateNoData(false);
            container.innerHTML = "";
            
            var permission_remove = checkChannelPermission(PERMISSION_REMOVE_CHAANEL);
            var cnt = 0;
            for(var j = 0; j <= parseInt(len/WMAX); j++){
                var sub_container = document.createElement("div");
                sub_container.id = "sub_container"+j;
                sub_container.style.display="flex";
                
                for(var i = 0; i < WMAX; i++){
                    if(cnt >= len)break;
                    
                    var channel = res[cnt];
                    var isselected = false;            
                    var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
                    var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
                    var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D9DCED;";
                    var users_info_display = isselected ? "block" : "none";
                    var channel_name = channel.ch_name;

                    var xtag = permission_remove ?  "<img src='./img/icon_list_black.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick='deleteChannel(\""+channel.ch_name+"\",\""+channel.ch_modelid+"\")'>" : "";
                    
                    var info_tag = 
                            "<div id='div_channelinfo_"+cnt+"' onclick ='selectChannel("+cnt+")' align='center' style='width:270px;height:120px;border-radius:5px;"+box_css+";color:#3F4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;zIndex:1'>"+
                                "<div  id='div_channelinfo_top_"+cnt+"' align='left' style='width:100%;height:40px;padding:10px 13px;10px;20px;background-color:#F6F7F7;border-radius:5px 5px 0px 0px;"+title_css+"'>"+
                                   //PT달력 이름
                                    "<label style='font-weight: 500;font-size:16px;float:left' >"+channel_name+"</label>"+
                                    xtag+
                                 "</div>"+

                                "<div  id='div_channelinfo_body_"+cnt+"'  style='display:flex;width:100%;height:80px;padding:10px 17px 10px 20px;border-radius:0px 0px 5px 5px;"+body_css+"'>"+
                                     "<div style='width:50px;height:50px;'>"+
                                         "<img src='./img/channel_type"+channel.ch_channeltype+".png' style='float:left;width:50px;height:50px;margin-top:5px' />"+
                                     "</div>"+
                                     "<div style='width:80%;height:50px;'>"+
                                        "<label style='font-size:12px;margin-top:20px'><span style='font-weight:bold'>ModelID :</span> <span style='color:#3333aa'>"+channel.ch_modelid+"</label>"+
                                     "</div>"+

    //                                "<img src='./img/icon_delete48.png' style='float:left;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick=''>"+
    //                                "<img src='./img/btn_reset.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick=''>"+
                                "</div>"+
                            "</div>";
                    sub_container.innerHTML += info_tag;    
                    cnt++;
                }
                container.appendChild(sub_container);
                
            }        
            if(len > 0)selectChannel(0);
            
            
        }
        function updateNoData(flg){
            var nodata = document.getElementById("nodata");
            nodata.style.display = flg ? "block" : "none";
        }
         function selectChannel(idx){
            
             
             
            var div_channelinfo_ = document.getElementById("div_channelinfo_"+idx);
            now_channel = channels[idx];
            for(var i = 0 ; i < channels.length;i++){
                var div_channelinfo = document.getElementById("div_channelinfo_"+i);
                var div_channelinfo_top = document.getElementById("div_channelinfo_top_"+i);
                var div_channelinfo_body = document.getElementById("div_channelinfo_body_"+i);
                //selected
                if(i == idx){
                    div_channelinfo.style.boxShadow = "0px 4px 4px rgba(0, 0, 0, 0.25)";
                    div_channelinfo.style.border = "0px";
                    div_channelinfo_top.style.borderBottom = "0px";
                    div_channelinfo_body.style.backgroundColor = "#F1FAFF";
                    div_channelinfo_body.style.borderBottom = "0px";                                        
                }
                //not selected
                else{
                     div_channelinfo.style.boxShadow = "0px 0px 0px rgba(0, 0, 0, 0)";
                    div_channelinfo.style.border = "1px solid #D9DCED";
                    div_channelinfo_top.style.borderBottom = "1px solid #D9DCED";
                    div_channelinfo_body.style.backgroundColor = "#ffffff";
                    div_channelinfo_body.style.borderBottom = "1px solid #D9DCED";                    
                }
            }
             editChannelDetailTag(idx);
             onclick_Ani(idx);
             
             
             var main_div = document.getElementById("main_div");
             animateHeight("main_div",main_div.offsetHeight+2,500);   
             
            
             
        }
        
        function onclick_Ani(idx){
             ///////////////////////////////////////////////////////////
            // name animation START
            ///////////////////////////////////////////////////////////


                var div_temp = document.createElement("div");
                div_temp.id = "div_temp";
                div_temp.align = "center";
                
                div_temp.innerHTML = "<label style='font-weight: 500;font-size:16px' ></label>";
            
                var div_box = document.getElementById("div_channelinfo_"+idx);

                var mleft = (idx%WMAX)*282+4;
                var mtop = parseInt(idx/5)*135+5;
                
                console.log("mleft "+mleft+" mtop "+mtop);
                
                div_temp.style="position:absolute;width:270px;height:120px;background-color:#F1FAFF;color:white;border-radius:5px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float:left;padding:10px 20px;10px;20px;px;margin-top:-120px;cursor:pointer;zIndex:0";


                
                div_box.appendChild(div_temp);


                div_temp.style.opacity = "0.5";
                
                var box_width = 270;
                var box_height = 120;
                
                $("#div_temp").animate({"margin-top":-30, "margin-left":-30, "width":"330px","height":"30px","opacity":0,"transition":"top 1s"} ,500,function(){
                    div_box.removeChild(div_temp);
                });
            ///////////////////////////////////////////////////////////
            // name animation END
            ///////////////////////////////////////////////////////////

            
        }
        function deleteChannel(name,modelid){
            var title_tag = "<label style='color:#181c32'>[경고]채널 삭제</label>";
            
            showModalDialog(document.body, title_tag,  "<br><label style='font-size:16px;font-weight:600;color:#181c32'><span style='color:#aa5555'>"+name+"</span><br>채널을 삭제하시겠습니까? 해당채널은 복구할 수 없습니다.<br> 신중하게 선택하세요.</label><br><br>" , "삭제하기", "취소", function() {
                    
                deleteChannelData(name,modelid);
                hideModalDialog();
            }, function() {
                hideModalDialog();
            }, null);
            
        }
        function deleteChannelData(name,modelid){

            
              deleteChannelCheck(modelid,function(res){
                    code = parseInt(res.code);
                    if (code == 100) {
                         init();
                         alertMsg(res.message);

                    } else {
                        //
                         alertMsg(res.message);
                    }
                },function(err){
                     alertMsg("네트워크 에러 ");
                });
        }
        var TITLE_HOME_PAGE = "홈화면 페이지";
        var TITLE_MAIN_PAGE = "메인화면 페이지";
        var TITLE_MAP_PAGE = "지도 화면 페이지";
        var TITLE_OTHER = "기타 ...(미정)";
        
        function getChannelBoxTag(type){
            var left_tag = "";
            var rigth_tag = "";
            var box_css = "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.35);border:1px solid #D9DCED";
    
            switch(type){
                case 0:
                    left_tag = "<img src='./img/channel_type"+type+".png' style='width:80px;height:80px'/>";
                    right_tag = "<label style='text-align:left'>"+TITLE_HOME_PAGE+"</label>";
                    
                    break;
                case 1:
                   left_tag = "<img src='./img/channel_type"+type+".png' style='width:80px;height:80px'/>";
                    right_tag = "<label style='text-align:left'>"+TITLE_MAIN_PAGE+"</label>";
                  
                    break;
                case 2:
                    left_tag = "<img src='./img/channel_type"+type+".png' style='width:80px;height:80px'/>";
                    right_tag = "<label style='text-align:left'>"+TITLE_MAP_PAGE+"</label>";
                  
                    break;
                case 3:
                    left_tag = "<img src='./img/channel_type"+type+".png' style='width:80px;height:80px'/>";
                    right_tag = "<label style='text-align:left'>"+TITLE_OTHER+"</label>";
                  
                    break;
            }
            
            //div 안에 가운데정렬
            var div_center_vertical_css = "display: flex; flex-direction: column; align-items: center; justify-content: center; box-sizing: border-box;";
            var div_center_vertical_css2 = "display: flex; flex-direction: column; justify-content: center; ";
            var boxtag = 
                "<div id='div_box_"+type+"' onclick ='clickChannelType("+type+")' align='center' style='display: flex; width:100%;height:auto;border-radius:10px;"+box_css+";background-color:#F6F7F7;color:#3F4254;border-radius:5px;float:left;cursor:pointer;'>"+                    
                    "<div style='"+div_center_vertical_css+"width:100px;height:160px;padding:10px'>"+
                        left_tag+  
                    "</div>"+
                    "<div  style='"+div_center_vertical_css2+"width:80%;height:160px;padding:10px'>"+
                        right_tag+    
                    "</div>"+
                "</div>";
           return boxtag;
        }
        function clickChannelType(type){
            for(var i = 0 ; i < 4; i++){
                var div_box = document.getElementById("div_box_"+i);
                if(i == type){
                    div_box.style.backgroundColor = "#F6F7ae";
                }else{
                    div_box.style.backgroundColor = "#F6F7F7";
                    
                }
            }
            select_channel_type = type;
        }

        function showContentsData(){
            const str_title = ["컨텐츠 데이터", "홈화면", "메인화면"];
            console.log("showContentsData : contentdatas ",contentdatas);
            var message_tag = "";
            if(auth_num > 990){
                
                switch(channel_tab_index){
                    case 0://컨텐츠 데이터
                        message_tag = "<textarea id='textarea_data' style='width:90%;height:700px;margin:30px' >"+JSON.stringify(contentdatas, null, 2)+"</textarea>";
                        break;
                    case 1://홈화면
                        message_tag = "<textarea id='textarea_data' style='width:90%;height:700px;margin:30px' >"+JSON.stringify(homedatas, null, 2)+"</textarea>";
                        break;
                    case 2://메인화면
                        message_tag = "<textarea id='textarea_data' style='width:90%;height:700px;margin:30px' >"+JSON.stringify(maindatas, null, 2)+"</textarea>";
                        break;                    
                }    
                var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "80%",
                        height: "auto"
                    }
                };
                var title_tag = "["+str_title[channel_tab_index]+"] 데이터 수정하기";
              
             
                showModalDialog(document.body, title_tag,  message_tag , "업데이트하기", "취소", function() {
                    
                    var textarea_data = document.getElementById("textarea_data");
                    var json_obj = null;
                    if(textarea_data){
                        
                    
                            json_obj = JSON.parse(textarea_data.value);
                        
                        if(channel_tab_index == 0)
                            sendContentDatas(json_obj);
                        else if(channel_tab_index == 1)
                            sendHomeDatas(json_obj);
                        else if(channel_tab_index == 2)
                            sendMainDatas(json_obj);
                    }
                },function(){
                        hideModalDialog();
                }, style);
            }else {
                C_showToast("알림","고정된 데이터로 이용 가능합니다. 데이터 수정은 업체에 문의해 주세요.");    
            }
            
            
            
        }
      
        
        var select_channel_type = -1;
         function showAddChannel() {
       
    //        var sdate = new Date(re_obj.starttime);
    //        var edate = new Date(re_obj.endtime);
            var stime = getToday();


            upload_fileurls = [];
             deleteImsiFiles(TYPE_IMSI);
             
            var container = document.getElementById("container");

    //        var tlist = "<option value=''>== 담당트레이너를 선택하세요 ==</option>";
    //        for (var i = 0; i < teacherlist.length; i++)
    //            tlist += "<option value='" + teacherlist[i].mem_uid + "' data-image='" + teacherlist[i].mem_photo + "'>" + teacherlist[i].mem_username + " 트레이너</option>";


             select_channel_type = -1;
            var title_tag = "<label style='color:#181c32'>데이터 삽입하기</label>";
            var message_tag = 
                "<div>"+
                 "<table id='select_channeltype_table' style='width:100%'>"+
                    "<tr>"+
                         "<td style='width:50%;padding:10px'>"+
                             getChannelBoxTag(0)+
                         "</td>"+
                         "<td style='width:50%;padding:10px'>"+
                            getChannelBoxTag(1)+
                         "</td>"+
                     "</tr>"+
                     "<tr>"+
                         "<td style='width:50%;padding:10px'>"+
                            getChannelBoxTag(2)+
                         "</td>"+
                         "<td style='width:50%;padding:10px'>"+
                            getChannelBoxTag(3)+
                         "</td>"+
                     "</tr>"+
                 "</table>"+
                 "</div>";
                


                var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "60%",
                        height: "auto"
                    }
                };
             
                 showModalDialog(document.body, title_tag,  message_tag , "다음단계 진행", "취소", function() {
                     if(select_channel_type == -1){
                         alertMsg("생성할 채널을 선택해 주세요!");
                         return;
                     }
                     hideModalDialog();
                     create_channel_setting(select_channel_type);

                }, function() {
                    hideModalDialog();
                }, style);

             
        
        }
        
        function getChannelTypeTitle(channel_type){
            var title = "";
            switch(channel_type){
                case 0:
                    title = TITLE_HOME_PAGE;
                    break;
                case 1:
                    title = TITLE_MAIN_PAGE;
                    break;
                case 2:
                    title = TITLE_MAP_PAGE;
                    break;
                case 3:
                    title = TITLE_OTHER;
                    break;
            }
            return title;
        }
        function create_channel_setting(channel_type){
            var title_tag = getTag_Input("input_button_name", "type_text", "", null, null, "업체명 입력")+getTag_Button("btn_add_button","버튼추가", "onclickAddHomeButtons()");
            var message_tag = drawAllButtonsTag();
            switch(channel_type){
                case TITLE_HOME_PAGE:
                    message_tag = ""
                break;
                case TITLE_MAIN_PAGE:
                break;
                case TITLE_MAP_PAGE:
                break;
                case TITLE_OTHER:
                break;
                    
            }
//            console.log("채널타입 "+channel_type);
//            
             var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "60%",
                        height: "auto"
                    }
                };
//            
//            
//             var title_tag = 
//                    "<div>"+
//                        "<label style='margin-top:8px;font-size:18px; color:#353533;font-weight:700;'>"+getChannelTypeTitle(channel_type)+"</label>" +
//                    "</div>"+
//                    "<div align='center'>" +
//                        "<div style='width:400px; height:50px;background-color:#ffffff;border:0px;border-radius:8px;padding:4px 4px;'>" +
//                            "<table align='center' style='width:100%;'>" +
//                                "<tr align='center' >" +
//                                    "<td onclick='clickCreateTab(0)' align='center' style='width:33.3%;cursor:pointer'>" +
//                                        "<div id='select_channel_tab_0'  style='position:absolute;width:190px;height:40px;border-radius:7px;background-color:#e4e6ef;margin-left:3px'><label style='margin-top:8px;font-size:14px; color:#3f4254;font-weight:700;cursor:pointer '>기본설정</label></div>" +
//                                        "<label style='margin-top:8px;font-size:14px; color:#b5b5c3;font-weight:700;cursor:pointer '>기본설정</label>" +
//                                        
//                                    
//                                    "</td>" +
//                                    "<td  onclick='clickCreateTab(1)'  align='center' style='width:33.3%;cursor:pointer'>" +
//                                        "<div id='select_channel_tab_1'  style='position:absolute;width:190px;height:40px;border-radius:7px;background-color:#e4e6ef;margin-left:3px;display:none'><label style='margin-top:8px;font-size:14px; color:#3f4254;font-weight:700;cursor:pointer '>학습관리</label></div>" +
//                                        "<label style='margin-top:8px;font-size:14px; color:#b5b5c3;font-weight:700;cursor:pointer '>학습관리</label>" +                                  
//                                "<tr>" +
//                            "</table>" +
//                            "</div>" +
//                        "</div>";
//                   
//             var message_tag = 
//            "<div id='div_create_default'>"+
//                createDefaultTag()+
//            "</div>"+                    
//            "<div id='div_create_study' style='display:none'>"+
//                createStudyTag()+
//            "</div>";


            showModalDialog(document.body, title_tag,  message_tag , "채널생성하기", "취소", function() {


                createChannelDefault(channel_type);

//                    hideModalDialog();


            }, function() {
                hideModalDialog();
            }, style);


            checkPopupDrag();
            
        }
        
        
     
        //홈화면버튼생성하기
        function onclickAddHomeButtons() {
       

            var container = document.getElementById("container");


           
            var title_tag = "<label style='color:#181c32'>상품 카테고리 생성하기</label>";
             //div 안에 가운데정렬
            var box_css = "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px";
             
            var message_tag = 
                "<div align='center' style='width:100%;height:auto;border-radius:10px;"+box_css+";background-color:#fff;color:#3F4254;border-radius:5px;float:left;cursor:pointer;'>"+                    
                    "<label style='float:left;margin-left:20px;margin-top:10px;'>* 홈화면 클릭할 버튼들을 추가해 주세요.</label>"+
                    "<br>"+    
                       
                    "<div id='div_all_categorys' style='width:100%;height:auto;padding:10px'>"+
                        drawAllButtonsTag()+
                    "</div>"+    
                    "<br>"+    
                    "<div style='width:100%;height:160px;padding:10px'>"+
                        "<input type='text' class='form-control myinputtype' onkeypress='inputbutton(event)' id='input_category' name='channel_name' placeholder='카테고리 입력.' style='width:100%;' >"+
                    "</div>"+                    
                "</div>";
                


                var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "80%",
                        height: "auto"
                    }
                };
             
                showModalDialog(document.body, title_tag,  message_tag , "확인", null, function() {
                    
                    init();
                     hideModalDialog();
                    
                },null, style);

             
        
        }
        
         //홈화면버튼생성 생성
        function drawAllButtonsTag(){
            
            var len = categorys ? categorys.length : 0;
            if(len > 0)updateNoData(false);
            
            var container = document.createElement("div");
            
            var cnt = 0;
            for(var j = 0; j <= parseInt(len/WMAX); j++){
                var sub_container = document.createElement("div");
                sub_container.id = "sub_container"+j;
                sub_container.style.display="flex";
                sub_container.style.width="100%";
                
                for(var i = 0; i < WMAX; i++){
                    if(cnt >= len)break;                    
                    var category = categorys[cnt];
                    sub_container.innerHTML += addButtonTag(parseInt(category.cg_idx), category.cg_name);   
                    cnt++;
                }
                container.appendChild(sub_container);
                
            }        
            return container.innerHTML;
            
            
        }
        function addButtonTag(cg_idx,cg_name){
            console.log("cd_idx "+cg_idx+" naem "+cg_name);
            var isselected = true;            
            var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
            var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
            var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D97C7D;";
            var users_info_display = isselected ? "block" : "none";
            
            var category_tag = 
                            "<div align='center' style='width:300px;height:60px;border-radius:5px;"+box_css+";background-color:#aF4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;padding:17px'>"+
                                    //PT달력 이름
                                    "<label style='color:white;font-weight: 500;font-size:16px;float:left' >"+cg_name+"</label>"+
                                     "<img src='./img/btn_rectx_press.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick='deleteCategoryClick("+cg_idx+")'>"+
                            "</div>";
            return category_tag;
        }
         function removeCategory(remove_cg_idx) {
            var new_categorys = [];
            for(var i = 0 ; i < categorys.length;i++){
                if(categorys[i].cg_idx != remove_cg_idx)
                    new_categorys.push(categorys[i]);
            }
            categorys = new_categorys;
        }
        function inputbutton(e){
             if(e.keyCode == 13){
//                console.log("inputbutton000 ");
                 //입력창
                var input_category = document.getElementById("input_category");
                var input_value = input_category.value;
                 
                 if(isButton(input_value)){
                     C_showToast("경고","이미 카테고리가 있습니다. 다른 이름을 입력해 주세요.");
                     input_category.value = "";
                     return;
                 }
                 
                 //목록창
                var div_all_categorys = document.getElementById("div_all_categorys");
               
                if(input_value != ""){
                    if(auth == AUTH_SYSTEMOWNER)
                     AJAX_AdmGet(ADM_TYPE.ADD_HOME_DATA,input_value,function(res){
                       code = parseInt(res.code);
                        if (code == 100) {
                             var category = res.message;
                            categorys.push(category);
                            div_all_categorys.innerHTML = drawAllCategorysTag();

                             input_category.value = "";
                        }
                    });
                 }               
             }            
        }
        function isButton(name){
            var flg = false;
            if(categorys != null)
            for(var i = 0  ; i < categorys.length;i++){
                if(categorys[i].cg_name == name){
                    flg = true;
                    break;
                }
            }
            return flg;
        }
        
        
        
        
        
        
        function checkDrag(){
            var upload_modelid = now_channel != null ? now_channel.ch_modelid : TYPE_IMSI;
            const dropZone = document.getElementById("dropZone");
            const fileInput = document.getElementById("fileInput");
            const fileList = document.getElementById("fileList");
            const fileProgress = document.getElementById("fileProgress");
            const progressBar = document.getElementById("progressBar");

            if(dropZone){
                dropZone.addEventListener("dragover", (e) => {
                    e.preventDefault();
                    dropZone.style.borderColor = "blue";
                    dropZone.style.color = "blue";
                });

                dropZone.addEventListener("dragleave", () => {
                    dropZone.style.borderColor = "#ccc";
                    dropZone.style.color = "#aaa";
                });

                dropZone.addEventListener("drop", (e) => {
                    e.preventDefault();
                    dropZone.style.borderColor = "#ccc";
                    dropZone.style.color = "#aaa";

                    const files = e.dataTransfer.files;
                    handleFiles(files, upload_modelid);
                });

                dropZone.addEventListener("click", () => fileInput.click());
                fileInput.addEventListener("change", (e) => {
                    const files = e.target.files;

                    upload_fileurl = "";
                    handleFiles(files, upload_modelid);
                });

            }

        }
        var upload_fileurls = [];
        
        function checkPopupDrag(){
            
            var popup_upload_modelid = TYPE_IMSI;
            const dropZone = document.getElementById("pdropZone");
            const fileInput = document.getElementById("pfileInput");
            const fileList = document.getElementById("pfileList");
            const fileProgress = document.getElementById("pfileProgress");
            const progressBar = document.getElementById("pprogressBar");

            dropZone.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZone.style.borderColor = "blue";
                dropZone.style.color = "blue";
            });

            dropZone.addEventListener("dragleave", () => {
                dropZone.style.borderColor = "#ccc";
                dropZone.style.color = "#aaa";
            });

            dropZone.addEventListener("drop", (e) => {
                e.preventDefault();
                dropZone.style.borderColor = "#ccc";
                dropZone.style.color = "#aaa";

                const files = e.dataTransfer.files;
                handleFiles(files, popup_upload_modelid);
            });

            dropZone.addEventListener("click", () => fileInput.click());
            fileInput.addEventListener("change", (e) => {
                const files = e.target.files;
                
                
                handleFiles(files, popup_upload_modelid);
            });



        }
       function handleFiles(files, modelid) {
            for (const file of files) {
                const listItem = document.createElement("li");
                listItem.textContent = `File: ${file.name}, Size: ${file.size} bytes`;
                fileList.appendChild(listItem);

                // Call uploadFile function
                uploadFile(file, modelid);
//                uploadFileTest(file);
            }
        }

        function uploadFile(file, modelid) {
            const formData = new FormData();
           
            // 파일데이터 : 모든 파일 가능
            formData.append("file", file);
            // 도메인 주소 : 해당 도메인 이외 다른 도메인 접근 불가
            formData.append('domain', window.location.hostname); // 도메인주소  
            // 기기 매핑을 위해 
            formData.append('modelid', modelid );
            // 파일 저장소 분류를 위해
            formData.append('type', "fileupload" );
            
            
            // Show progress bar
            fileProgress.style.display = "block";
            progressBar.style.width = "0%";

            // Simulate progress using XMLHttpRequest for detailed progress updates
            const xhr = new XMLHttpRequest();
            xhr.open("POST", FILE_UPLOAD_PLACE, true);

            xhr.upload.onprogress = function (event) {
                if (event.lengthComputable) {
                    const percentComplete = Math.round((event.loaded / event.total) * 100);
                    progressBar.style.width = percentComplete + "%";
                }
            };
            // Set up event listeners for the XMLHttpRequest
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // File upload successful
                        console.log('File upload successful',xhr);
                        var res = JSON.parse(xhr.response);
                        if(res.code="100"){
                            var imsiurl = res.message;
                            
//                            upload_fileurls = imsiurl;
                            if(modelid == TYPE_IMSI){
                                getPopupStudyFileListTable(res.message);
                            }
                        }else{
                            
                        }
                    } else {
                        // File upload failed
                        console.error('File upload failed',xhr);
                    }
//                    setTimeout(function(){
//                        location.href = location.href;    
//                    },20000);
    //                location.href = location.href;
                }
            };


            xhr.onerror = function () {
                console.error("Upload error.");
                progressBar.style.width = "0%";
            };

            xhr.send(formData);
        }
       
        
        
        
        
        
        
        function clickCreateTab(idx){
            onclick_channel_tab(idx);
            
            var div_create_default = document.getElementById("div_create_default");
            var div_create_study = document.getElementById("div_create_study");
            
            if(idx == 0){
                div_create_default.style.display = "block";
                div_create_study.style.display = "none";    
            }else {
                div_create_default.style.display = "none";
                div_create_study.style.display = "block";
            }
            
            
        }
        var channel_tab_index = 0;
        function editChannelDetailTag(idx) {
            var main_div = document.getElementById("main_div");
            main_div.innerHTML = "";
           
            var manageruid = "";
           
            var div = document.createElement("div");
            div.innerHTML = "<div style='height:50px;'>"+
                                "<span style='float:left'><div align='center' id='tab_0_"+manageruid+"' onclick='click_tab(0, \""+manageruid+"\")' style='cursor:pointer;background-color:#ffffff;font-weight:bold;width:100px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+       
                                     "<label id='tab_0_label' style='cursor:pointer;font-size: 16px; color:#3F4254;text-align:center;margin-top:8px'>기본설정</label>"+

                                "</div></span>"+
                                "<span style='float:left'><div align='center' id='tab_1_"+manageruid+"' onclick='click_tab(1, \""+manageruid+"\")'  style='cursor:pointer;background-color:#eeeeee;width:100px;height:50px;padding:5px 15px 5px 15px;border-top:1px solid #e9e9e9;border-left:1px solid #e9e9e9;border-right:1px solid #e9e9e9;border-radius:10px 10px 0 0;'>"+  
                                      "<label id='tab_1_label' style='cursor:pointer;font-size: 16px; color:#aaaaaa;text-align:center;margin-top:8px'>학습관리</label>"+
                                "</div></span>"+
                            "</div>"+
            
                            "<div align='center' id='div_data_"+manageruid+"' style='width:100%;height:auto;margin-top-:-1px'>"+
                                    //내용은 금액을 계산한 후에 다른곳에서 입력한다. 
                                    getDefaultTag(idx)+
                                    getStudyTag(idx)+
                            "</div>";
            
                    
            var main_div = document.getElementById("main_div");
            
            main_div.appendChild(div);
            
           initDefaultData();
            
            checkDrag();
            
            initChannelFileList();
        }
        function initChannelFileList(){
            var channel = now_channel;
                
            getDirectoryFiles(channel.ch_modelid, function(res){
                code = parseInt(res.code);
                if (code == 100) {
                     console.log("res ",res);
                    getStudyFileListTable(channel, res.message);    

                }
            },function(err){
                 alertMsg("네트워크 에러 ");
            });
        }
        //select 는 바로 안되서 생성후 데이터 init
        function initDefaultData(){
            var channel = now_channel;
            var input_answer_type = document.getElementById('input_answer_type');
            var input_answer_style = document.getElementById('input_answer_style');
            console.log("")
            if(parseInt(channel.ch_answertype) > 0){
                input_answer_type.value = parseInt(channel.ch_answertype);
            }
            if(parseInt(channel.ch_answerstyle) > 0)
                input_answer_style.value = parseInt(channel.ch_answerstyle);
            
        }
        function createChannelDefault(channel_type){
            var toggle_open = document.getElementById("toggle_copen").checked;
            var channel_name = document.getElementById("cchannel_name").value;
            var chanlel_message = document.getElementById("cchanlel_message").value;
            var channel_welcome = document.getElementById("cchannel_welcome").value;
            var input_answer_type = document.getElementById("cinput_answer_type").value;
            var input_answer_style = document.getElementById("cinput_answer_style").value;
            var input_max_channel = document.getElementById("cinput_max_channel").value;
            
            
            if(channel_name == ""){
                alertMsg("이름을 선택해주세요.");
                return;
            }
            else if(input_answer_type == 0){
                alertMsg("답변타입을 선택해주세요.");
                return;
            }
            else if(input_answer_style == 0){
                alertMsg("답변스타일을 선택해주세요.");
                return;
            }
            
//            console.log("toggle_open : "+toggle_open+", channel_name : "+channel_name+", chanlel_message : "+chanlel_message+", channel_welcome : "+channel_welcome+", input_answer_type : "+input_answer_type+", input_answer_style : "+input_answer_style+", input_max_channel : "+input_max_channel);
            var _data = {
                "channeltype" : channel_type,
                "open" : toggle_open,
                "name" : channel_name,
                "message" : chanlel_message,
                "welcome" : channel_welcome,
                "answertype" : input_answer_type,
                "answerstyle" : input_answer_style,
                "maxchannel" : input_max_channel,                
            };
            createChannelDetail(_data,function(res){
                    code = parseInt(res.code);
                    if (code == 100) {
                         init();
                         hideModalDialog();

                    } else {
                        //
                         alertMsg(res.message);
                    }
                },function(err){
                     alertMsg("네트워크 에러 ");
                });
        }
        function updateChannelDefault(idx){
            var channel = now_channel;
            var toggle_open = document.getElementById("toggle_open").checked;
            var channel_name = document.getElementById("channel_name").value;
            var chanlel_message = document.getElementById("chanlel_message").value;
            var channel_welcome = document.getElementById("channel_welcome").value;
            var input_answer_type = document.getElementById("input_answer_type").value;
            var input_answer_style = document.getElementById("input_answer_style").value;
            var input_max_channel = document.getElementById("input_max_channel").value;
            
            
            if(channel_name == ""){
                alertMsg("이름을 선택해주세요.");
                return;
            }
            else if(input_answer_type == 0){
                alertMsg("답변타입을 선택해주세요.");
                return;
            }
            else if(input_answer_style == 0){
                alertMsg("답변스타일을 선택해주세요.");
                return;
            }
            
//            console.log("toggle_open : "+toggle_open+", channel_name : "+channel_name+", chanlel_message : "+chanlel_message+", channel_welcome : "+channel_welcome+", input_answer_type : "+input_answer_type+", input_answer_style : "+input_answer_style+", input_max_channel : "+input_max_channel);
            var _data = {
                "idx" : channel.ch_idx,
                "open" : toggle_open,
                "name" : channel_name,
                "message" : chanlel_message,
                "welcome" : channel_welcome,
                "answertype" : input_answer_type,
                "answerstyle" : input_answer_style,
                "maxchannel" : input_max_channel,                
            };
            updateChannelDetail(_data,function(res){
                    code = parseInt(res.code);
                    if (code == 100) {
                         init();
                         alertMsg(res.message);

                    } else {
                        //
                         alertMsg(res.message);
                    }
                },function(err){
                     alertMsg("네트워크 에러 ");
                });
        }
        function updateChannelStudy(idx){
            console.log("학습관리 수정하기 클릭!!");
        }
        
        function togglechange(name, txt_off,txt_on) {

            var toggle_title_ = document.getElementById("toggle_title_"+name); //글자바꾸기
            var toggle = document.getElementById("toggle_"+name);
            var toggle_icon = document.getElementById("toggle_icon_"+name);
            
            if (toggle.checked) {
                toggle_icon.style.backgroundColor = "#33aaaa";
                
                toggle_title_.innerHTML = txt_on;
            } else {
                toggle_icon.style.backgroundColor = "#cccccc";
                toggle_title_.innerHTML = txt_off;
            }
        }
        function createDefaultTag(){
            
            var toggle_open = "checked";
            var channel_name = "";
            var channel_message = "";
            var channel_welcome = "";
            var input_answer_type = 0;
            var input_answer_style = 0;
            var input_max_channel = 5;

           
            
            
            //div 안에 가운데정렬
            var div_center_vertical_css = "display: flex; flex-direction: column; align-items: center; justify-content: center; box-sizing: border-box;";
            var div_center_vertical_css2 = "display: flex; flex-direction: column; justify-content: center; ";

           var name = "copen";
           var txt_off = "개인전용";
           var txt_on = "공개용";
            
           var txt_default = toggle_open == "checked" ? txt_on : txt_off;
           var toggle_tag =
            "<div style='width:100%; height:auto;padding-left:10px;padding-right:5px;'>" +
                "<label class='switch' style='float:left;'>" +
                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")' "+toggle_open+">" +
                "<span id='toggle_icon_"+name+"'  class='slider round'>" +
                "</span>" +
                "</label>" +
                 "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;'>"+txt_default+"</text>" +
            "</div>";

            
           var tag = 
               "<div id='cdiv_tab0' style='border-radius:0 10px 10px 10px ;border:1px solid #eeeeee;margin-top:-1px'>"+
                    "<br>"+
                    "<table align='center' id='ctable_tab0_' class='table table-borderless' style='width:100%;height:auto;text-align:center;border:0px'>"+
                        "<tr>"+  //채널유형
                            "<td style='width:10%'>"+
                                "<label style='text-align:left'>채널유형<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td style='width:90%'>"+
                                toggle_tag+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//채널이름
                            "<td>"+
                                "<label style='text-align:left'>채널이름<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td>"+
                                "<input type='text' class='form-control myinputtype' onchange='' id='cchannel_name' name='channel_name' placeholder='채널이름 입력.' style='width:100%;' value='"+channel_name+"'>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//채널설명
                            "<td>"+
                                "<label style='text-align:left'>채널설명</label>"+
                            "</td>"+
                            "<td>"+
                                "<input type='text' class='form-control myinputtype' onchange='' id='cchanlel_message' name='chanlel_message' placeholder='채널내용을 입력하세요.' style='width:100%;' value='"+channel_message+"'>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//웰컴안내
                            "<td>"+
                                "<label style='text-align:left'>웰컴안내</label>"+
                            "</td>"+
                            "<td>"+
                                "<input type='text' class='form-control myinputtype' onchange='' id='cchannel_welcome' name='channel_welcome' placeholder='웰컴메세지를 입력하세요.' style='width:100%;' value='"+channel_welcome+"'>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//답변타입
                            "<td>"+
                                "<label style='text-align:left'>답변타입<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td>"+
                                "<select id='cinput_answer_type' onchange='' class='form-control myinputtype' name='payment_type'>"+
                                    "<option value=''>답변타입을 선택하세요</option>"+
                                    "<option value='1'>정확히</option>"+
                                    "<option value='2'>정확히 + 추론</option>"+
                                    "<option value='3'>추론</option>"+
                                "</select>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//답변스타일
                            "<td>"+
                               "<label style='text-align:left'>답변스타일<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td>"+
                                "<select id='cinput_answer_style' onchange='' class='form-control myinputtype' name='payment_type'>"+
                                    "<option value=''>답변스타일을 선택하세요</option>"+
                                    "<option value='1'>친절하게 짧게 답변합니다.</option>"+
                                    "<option value='2'>친절하게 길게 답변합니다.</option>"+
                                    "<option value='3'>자유롭게 짧게 답변합니다.</option>"+
                                    "<option value='4'>자유롭게 길게 답변합니다.</option>"+
                                "</select>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//최대채널수
                            "<td >"+
                                "<label style='text-align:left'>최대채널수<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td >"+
                                "<input type='number' maxlength='3'  class='form-control myinputtype' id='cinput_max_channel' style='width:100%;' value='"+input_max_channel+"' readonly>"+
                            "</td>"+                            
                        "</tr>"+
               
                    "</table>"+
                  
               "</div>";
            return tag;
         
        }
        //TAB 0 기본설정
        function getDefaultTag(idx){
            var permission_default = checkChannelPermission(PERMISSION_EDIT_DEFAULT);
            var permission_readonly = permission_default ? "" : "readonly";
            var permission_disabled = permission_default ? "" : "disabled";
             console.log("permission_readonly "+permission_readonly);
            var channel = now_channel;
            var toggle_open = channel.ch_opentype == 1 ? "checked" : "";
            var channel_name = channel.ch_name;
            var channel_message = channel.ch_desc;
            var channel_welcome = channel.ch_welcomedesc;
            var input_answer_type = channel.ch_answertype;
            var input_answer_style = channel.ch_answerstyle;
            var input_max_channel = channel.ch_maxdomain;

           
            
            
            //div 안에 가운데정렬
            var div_center_vertical_css = "display: flex; flex-direction: column; align-items: center; justify-content: center; box-sizing: border-box;";
            var div_center_vertical_css2 = "display: flex; flex-direction: column; justify-content: center; ";

           var name = "open";
           var txt_off = "개인전용";
           var txt_on = "공개용";
            
           var txt_default = toggle_open == "checked" ? txt_on : txt_off;
           var toggle_tag =
            "<div style='width:100%; height:auto;padding-left:10px;padding-right:5px;'>" +
                "<label class='switch' style='float:left;'>" +
                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")' "+toggle_open+"  "+permission_disabled+"/>" +
                "<span id='toggle_icon_"+name+"'  class='slider round'>" +
                "</span>" +
                "</label>" +
                 "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;'>"+txt_default+"</text>" +
            "</div>";


            var btn_edit_default_tag = permission_default ?  "<button onclick='updateChannelDefault("+idx+")' class='btn ' style='float:right;;margin-right:20px;cursor:pointer;width:160px; height:40px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='btn_change_channel_data'>기본설정 수정하기</button>" : "";
            
           var tag = 
               "<div id='div_tab0' style='border-radius:0 10px 10px 10px ;border:1px solid #eeeeee;margin-top:-1px'>"+
                    "<br>"+
                    "<table align='center' id='table_tab0_' class='table table-borderless' style='width:100%;height:auto;text-align:center;border:0px'>"+
                        "<tr>"+  //채널유형
                            "<td style='width:10%'>"+
                                "<label style='text-align:left'>채널유형<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td style='width:90%'>"+
                                toggle_tag+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//채널이름
                            "<td>"+
                                "<label style='text-align:left'>채널이름<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td>"+
                                "<input type='text' class='form-control myinputtype' onchange='' id='channel_name' name='channel_name' placeholder='채널이름 입력.' style='width:100%;' value='"+channel_name+"' "+permission_readonly+" />"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//채널설명
                            "<td>"+
                                "<label style='text-align:left'>채널설명</label>"+
                            "</td>"+
                            "<td>"+
                                "<input type='text' class='form-control myinputtype' onchange='' id='chanlel_message' name='chanlel_message' placeholder='채널내용을 입력하세요.' style='width:100%;' value='"+channel_message+"' "+permission_readonly+" />"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//웰컴안내
                            "<td>"+
                                "<label style='text-align:left'>웰컴안내</label>"+
                            "</td>"+
                            "<td>"+
                                "<input type='text' class='form-control myinputtype' onchange='' id='channel_welcome' name='channel_welcome' placeholder='웰컴메세지를 입력하세요.' style='width:100%;' value='"+channel_welcome+"' "+permission_readonly+" />"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//답변타입
                            "<td>"+
                                "<label style='text-align:left'>답변타입<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td>"+
                                "<select id='input_answer_type' onchange='' class='form-control myinputtype' name='payment_type' "+permission_disabled+">"+
                                    "<option value=''>답변타입을 선택하세요</option>"+
                                    "<option value='1'>정확히</option>"+
                                    "<option value='2'>정확히 + 추론</option>"+
                                    "<option value='3'>추론</option>"+
                                "</select>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//답변스타일
                            "<td>"+
                               "<label style='text-align:left'>답변스타일<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td>"+
                                "<select id='input_answer_style' onchange='' class='form-control myinputtype' name='payment_type' "+permission_disabled+">"+
                                    "<option value=''>답변스타일을 선택하세요</option>"+
                                    "<option value='1'>친절하게 짧게 답변합니다.</option>"+
                                    "<option value='2'>친절하게 길게 답변합니다.</option>"+
                                    "<option value='3'>자유롭게 짧게 답변합니다.</option>"+
                                    "<option value='4'>자유롭게 길게 답변합니다.</option>"+
                                "</select>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//최대채널수
                            "<td >"+
                                "<label style='text-align:left'>최대채널수<span style='color:red'>*</span></label>"+
                            "</td>"+
                            "<td >"+
                                "<input type='number' maxlength='3'  class='form-control myinputtype' id='input_max_channel' style='width:100%;' value='"+input_max_channel+"' readonly>"+
                            "</td>"+                            
                        "</tr>"+
               
                    "</table>"+
                    "<br><br><div align='left' style='height:60px;margin-left:20px;'>"+
                       btn_edit_default_tag+
                     "</div>"+
               "</div>";
            return tag;
         
        }
        
        function createStudyTag(){
           var name = "cstudy";
           var txt_off = "중복데이터 학습안함";
           var txt_on = "중복데이터 재학습";
           var toggle_tag =
            "<div style='position:fixed;width:100%; height:auto;padding-left:10px;padding-right:5px;'>" +
                "<label class='switch' style='float:left;'>" +
                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")'>" +
                "<span  id='toggle_icon_"+name+"'  class='slider round'>" +
                "</span>" +
                "</label>" +
                "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;'>중복데이터 학습안함</text>" +
            "</div>";

            var tag = 
                  "<div id='cdiv_tab1' style='border-radius:0 10px 10px 10px ;border:1px solid #eeeeee;margin-top:-1px'>"+
                    "<br>"+
                    "<table align='center' id='ctable_tab1_' class='table table-borderless' style='width:100%;height:auto;text-align:center;border:0px'>"+
                        "<tr>"+//샘플문서 다운로드
                           "<td style='width:20%'>"+
                                
                            "</td>"+
                            "<td >"+
                                 "<button onclick='' class='btn ' style='float:right;margin-top:-5px;margin-right:20px;cursor:pointer;width:160px; height:30px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='cbtn_download_channel_data'>샘플문서 다운로드</button>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//채널유형
                            "<td >"+
                                "<label style='text-align:left'>채널유형</label>"+
                            "</td>"+
                            "<td >"+
                                toggle_tag+
                            "</td>"+                            
                        "</tr>"+
//                        "<tr>"+//채널이름
//                            "<td >"+
//                                "<label style='text-align:left'>채널이름<span style='color:red'>*</span></label>"+
//                            "</td>"+
//                            "<td >"+
//                                "<input type='number' maxlength='3'  class='form-control myinputtype' style='width:100%;' value='' readonly>"+
//                            "</td>"+                            
//                        "</tr>"+
                        "<tr>"+//문서 업로드
                            "<td >"+
                                "<label style='text-align:left'>문서 업로드</label>"+
                            "</td>"+
                            "<td >"+
                                "<div id='pdropZone' style='width: 100%; height: 150px; border: 2px dashed #ccc; border-radius:10px; display: flex; align-items: center; justify-content: center; text-align: center; color: #aaa; '><img src='./img/icon_uploadfile.png' style='width:50px;height:50px'/><dv>이곳을 클릭하거나 파일을 끌어다 놓으세요.</div>"+
                                    
                                    "<input type='file' id='pfileInput' multiple style='display: none;'>"+
                                "</div>"+
                                "<div id='pfileProgress' style='width: 100%; height: 8px; margin-top: 5px; background-color: #f0f0f0; position: relative;border-radius:5px; display: none;'>"+
                                    "<div id='pprogressBar' style='width: 0%; height: 100%; background-color: #4caf50;border-radius:5px; '></div>"+
                                "</div>"+
                                "<ul id='pfileList'></ul>"+
                                
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//문서목록
                            "<td >"+
                                "<label style='text-align:left'>문서목록</label>"+
                            "</td>"+
                            "<td >"+
                                "<div id='pdiv_channel_filelist' style='width:100%'>"+
                                    
                                "</div>"+
                            "</td>"+                            
                        "</tr>"+                        
                    "</table>"+                                   
                "</div>";
            return tag;
        }
        
        function getStudyFileListTable(channel, rows) {
            var permission_study = checkChannelPermission(PERMISSION_EDIT_STUDY);
            var div_channel_filelist = document.getElementById("div_channel_filelist");
            div_channel_filelist.innerHTML = "";
            console.log("rows ",rows);
            rows.sort(sort_by('date', true, (a) => a.toUpperCase()));
            for(var i = 0 ; i < rows.length;i++){
                const row = rows[i];
                var div = document.createElement("div");
                
                var xtag = permission_study ? "<img src='./img/btn_rectx_press.png' style='float:right;width:24px;height:24px;margin-right:10px;margin-top:2px;cursor:pointer'  onclick='deleteFile(\""+channel.ch_modelid+"\", \""+row.filename+"\", )' />" : "";
                
                div_channel_filelist.innerHTML += 
                
                     "<div class='form-control myinputtype' style='display:flex;width:100%;margin-bottom:4px'>"+
                         "<div style='width:80%;height:50px;'>"+
                            "<label style='float:left;margin-left:20px;font-size:16px;color:#3333aa;margin-top:3px'>"+row.filename+"</label>"+
                         "</div>"+
                         "<div style='width:200px;'>"+
                             "<label style='font-size:16px;float:right;margin-top:3px'>"+row.date+"</label>"+
                         "</div>"+
                         "<div style='width:80px;'>"+
                             xtag+
                         "</div>"+

                    "</div>";
            }
            
        }
         function deleteFile(modelid,filename){
             var title_tag = "<label style='color:#181c32'>학습파일 삭제</label>";             
             var message_tag = "<br><label style='font-size:16px;font-weight:600;color:#181c32'><span style='color:#aa4444'>"+filename+"</span><br>학습데이터를 삭제하시겠습니까? </label><br><br>";
                 
             showModalDialog(document.body, title_tag,  message_tag , "삭제하기", "취소", function() {
                   
                 _deleteStudyFile(modelid,filename);
                 
            }, function() {
                hideModalDialog();
            }, null);
         }
        function _deleteStudyFile(modelid,filename){
            var _data = {
                "modelid":modelid,
                "filename":filename
            }
            deleteStudyFile(_data, function(res){
                    code = parseInt(res.code);
                    if (code == 100) {                        
                         alertMsg(res.message,function(){
                             initChannelFileList();
                             hideModalDialog();
                         });
                        
                    } else {
                        //
                         alertMsg(res.message,function(){
                             hideModalDialog();
                         });
                       
                    }
                    
                },function(err){
                     alertMsg("네트워크 에러 ");
                });
        }

        
        function getPopupStudyFileListTable(rows) {
            var div_channel_filelist = document.getElementById("pdiv_channel_filelist");
            div_channel_filelist.innerHTML = "";
            console.log("rows ",rows);
            rows.sort(sort_by('date', true, (a) => a.toUpperCase()));
            for(var i = 0 ; i < rows.length;i++){
                const row = rows[i];
                var div = document.createElement("div");
                div_channel_filelist.innerHTML += 
                
                     "<div class='form-control myinputtype' style='display:flex;width:100%;margin-bottom:4px'>"+
                         "<div style='width:80%;height:50px;'>"+
                            "<label style='float:left;margin-left:20px;font-size:16px;color:#3333aa;margin-top:3px'>"+row.filename+"</label>"+
                         "</div>"+
                         "<div style='width:200px;'>"+
                             "<label style='font-size:16px;float:right;margin-top:3px'>"+row.date+"</label>"+
                         "</div>"+
                         "<div style='width:80px;'>"+
                             "<img src='./img/btn_rectx_press.png' style='float:right;width:24px;height:24px;margin-right:10px;margin-top:2px;cursor:pointer'  onclick='deleteFile(\""+TYPE_IMSI+"\", \""+row.filename+"\", )' />"+
                         "</div>"+
                    "</div>";
            }
            
        }
        
        //TAB 1 학습관리
        function getStudyTag(idx){
         
           var permission_study = checkChannelPermission(PERMISSION_EDIT_STUDY);
            var permission_readonly = permission_study ? "" : "readonly";
            var permission_disabled = permission_study ? "" : "disabled";     
            
           var name = "study";
           var txt_off = "중복데이터 학습안함";
           var txt_on = "중복데이터 재학습";
           var toggle_tag =
            "<div style='width:100%; height:auto;padding-left:10px;padding-right:5px;'>" +
                "<label class='switch' style='float:left;'>" +
                "<input id='toggle_"+name+"' type='checkbox' onchange='togglechange(\""+name+"\", \""+txt_off+"\", \""+txt_on+"\")' "+permission_disabled+" />" +
                "<span  id='toggle_icon_"+name+"'  class='slider round'>" +
                "</span>" +
                "</label>" +
                 "<text id='toggle_title_"+name+"' style='color:gray;float:left;font-size:14px;margin-left:10px;font-weight:500;margin-top:5px;'>중복데이터 학습안함</text>" +
            "</div>";

            var drag_tag = permission_study ?  "<div id='dropZone' style='width: 100%; height: 150px; border: 2px dashed #ccc; border-radius:10px; display: flex; align-items: center; justify-content: center; text-align: center; color: #aaa; '><img src='./img/icon_uploadfile.png' style='width:50px;height:50px'/><dv>이곳을 클릭하거나 파일을 끌어다 놓으세요.</div>"+
                                    
                                    "<input type='file' id='fileInput' multiple style='display: none;'>"+
                                "</div>"+
                                "<div id='fileProgress' style='width: 100%; height: 8px; margin-top: 5px; background-color: #f0f0f0; position: relative;border-radius:5px; display: none;'>"+
                                    "<div id='progressBar' style='width: 0%; height: 100%; background-color: #4caf50;border-radius:5px;'></div>"+
                                "</div>"
                                 : "<div style='width: 100%; height: 150px; border: 2px dashed #ccc; border-radius:10px; display: flex; align-items: center; justify-content: center; text-align: center; color: #aaa; '><img src='./img/icon_uploadfile.png' style='width:50px;height:50px'/><dv>문서 업로드 기능 잠김.</div>"+                                  
                                "</div>";
            
            var edit_btn_tag = permission_study ? "<button onclick='updateChannelStudy("+idx+")' class='btn ' style='float:right;;margin-right:20px;cursor:pointer;width:160px; height:40px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='btn_change_channel_data'>학습관리 수정하기</button>" : "";
            
            var tag = 
                
                  "<div id='div_tab1' style='border-radius:0 10px 10px 10px ;border:1px solid #eeeeee;display:none;margin-top:-1px'>"+
                    "<br>"+
                    "<table align='center' id='table_tab1_' class='table table-borderless' style='width:100%;height:auto;text-align:center;border:0px'>"+
                        "<tr>"+//샘플문서 다운로드
                           "<td style='width:10%'>"+
                                
                            "</td>"+
                            "<td style='width:90%'>"+
                                 "<button onclick='' class='btn ' style='float:right;margin-top:-5px;margin-right:20px;cursor:pointer;width:160px; height:30px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='btn_download_channel_data'>샘플문서 다운로드</button>"+
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//채널유형
                            "<td >"+
                                "<label style='text-align:left'>채널유형</label>"+
                            "</td>"+
                            "<td >"+
                                toggle_tag+
                            "</td>"+                            
                        "</tr>"+
//                        "<tr>"+//채널이름
//                            "<td >"+
//                                "<label style='text-align:left'>채널이름</label>"+
//                            "</td>"+
//                            "<td >"+
//                                "<input type='number' maxlength='3'  class='form-control myinputtype' onkeyup='maxLengthCheck(\"input_max_channel\")' id='input_channel_name' style='width:100%;' value='1' readonly>"+
//                            "</td>"+                            
//                        "</tr>"+
                        "<tr>"+//문서 업로드
                            "<td >"+
                                "<label style='text-align:left'>문서 업로드</label>"+
                            "</td>"+
                            "<td >"+
                                drag_tag+
                                "<ul id='fileList'></ul>"+
                                
                            "</td>"+                            
                        "</tr>"+
                        "<tr>"+//문서목록
                            "<td >"+
                                "<label style='text-align:left'>문서목록</label>"+
                            "</td>"+
                            "<td >"+
                                 "<div id='div_channel_filelist' style='width:100%'>"+
                                    
                                "</div>"+
                            "</td>"+                            
                        "</tr>"+                        
                    "</table>"+
                   "<br><br><div align='left' style='height:60px;margin-left:20px;'>"+
                        edit_btn_tag+
                    "</div>"+
                "</div>";
            return tag;
        }
        
        function click_tab(tab_idx, manageruid){
            console.log("click_tab "+tab_idx);
            var tab_0 = document.getElementById("tab_0_"+manageruid);
            var tab_1 = document.getElementById("tab_1_"+manageruid);
            var tab_2 = document.getElementById("tab_2_"+manageruid);
            var tab_0_label = document.getElementById("tab_0_label"+manageruid);
            var tab_1_label = document.getElementById("tab_1_label"+manageruid);
            var tab_2_label = document.getElementById("tab_2_label"+manageruid);
            
            
            channel_tab_index = tab_idx;
            if(tab_idx == 0){
                tab_0.style.backgroundColor = "#ffffff";
                tab_1.style.backgroundColor = "#eeeeee";
                tab_2.style.backgroundColor = "#eeeeee";
                tab_0_label.style.color = "#3F4254";
                tab_1_label.style.color = "#aaaaaa";
                tab_2_label.style.color = "#aaaaaa";
                tab_0_label.style.fontWeight = "bold";
                tab_1_label.style.fontWeight = "normal";
                tab_2_label.style.fontWeight = "normal";
                
            }
            else if(tab_idx == 1){
                tab_0.style.backgroundColor = "#eeeeee";
                tab_1.style.backgroundColor = "#ffffff";
                tab_2.style.backgroundColor = "#eeeeee";
                tab_0_label.style.color = "#aaaaaa";
                tab_1_label.style.color = "#3F4254";
                tab_2_label.style.color = "#aaaaaa";
                tab_0_label.style.fontWeight = "normal";
                tab_1_label.style.fontWeight = "bold";
                tab_2_label.style.fontWeight = "normal";
                
            }else {
                tab_0.style.backgroundColor = "#eeeeee";
                tab_1.style.backgroundColor = "#eeeeee";
                tab_2.style.backgroundColor = "#ffffff";
                tab_0_label.style.color = "#aaaaaa";
                tab_1_label.style.color = "#aaaaaa";
                tab_2_label.style.color = "#3F4254";
                tab_0_label.style.fontWeight = "normal";
                tab_1_label.style.fontWeight = "normal";
                tab_2_label.style.fontWeight = "bold";
                
            }
            updateTabData(channel_tab_index);
            
            var main_div = document.getElementById("main_div");
            main_div.style.height = "auto";
        }
        function updateTabData(tab_idx){
            console.log("tab_idx "+tab_idx);
            var div_tab0 = document.getElementById("div_tab0");
            var div_tab1 = document.getElementById("div_tab1");
            var div_tab2 = document.getElementById("div_tab2");
            div_tab0.style.display = tab_idx == 0 ? "block" : "none";
            div_tab1.style.display = tab_idx == 1 ? "block" : "none";
            div_tab2.style.display = tab_idx == 2 ? "block" : "none";
            
        }
    </script>
