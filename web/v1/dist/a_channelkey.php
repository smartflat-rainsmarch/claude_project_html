    

    <div id = "reservation_container" class="container" style='width:auto;height:100%;margin-left:270px;margin-right:30px;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text id='title_payment' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >채널키생성</text>
            
           
            <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
          
            
            <div id="container">

            </div>
            <div id="id_nodata">
                <br>
                <div align="center" style="margin-top:10px"><text style="font-size:20px;color:#ee0000;font-weight:bold;">- 데이타가 없습니다.- </text></div>
            </div>
            <br>
             <div id='main_div'>
                
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
            init();            
        });
        var channels = null;
        var now_channel = null;
        var WMAX = 5; //채널 가로 최대갯수
        //최초
        function init(){
            getChannelList(function(res){
                
                console.log("getChannelList res ",res);
                if(res != null){
                    console.log("111 getChannelList res ",res);
                    channels = res;
                    drawChannels(res);
                }
            });
            
        }
        
        function checkCreateKeyPermission(type){
            var permission_flg = true;          
            if(auth_num > 99){
                return permission_flg;
            }
            
            var channel_permissions = JSON.parse(setting)["createkey"];
            var _permission_flag = channel_permissions[type];
            
            if(_permission_flag == "false"){
                permission_flg = false;                
            }
            return permission_flg; 
        }
        //채널박스 생성
        function drawChannels(res){
            
            var len = res ? res.length : 0;
            if(len > 0)updateNoData(false);
            container.innerHTML = "";
          
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

                    var info_tag = 
                            "<div id='div_channelinfo_"+cnt+"' onclick ='selectChannel("+cnt+")' align='center' style='width:270px;height:120px;border-radius:5px;"+box_css+";color:#3F4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;'>"+
                                "<div  id='div_channelinfo_top_"+cnt+"' align='left' style='width:100%;height:40px;padding:10px 13px;10px;20px;background-color:#F6F7F7;border-radius:5px 5px 0px 0px;"+title_css+"'>"+
                                   //PT달력 이름
                                    "<label style='font-weight: 500;font-size:16px;float:left' >"+channel_name+"</label>"+
//                                    "<img src='./img/icon_list_black.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick='deleteChannel(\""+channel.ch_name+"\",\""+channel.ch_modelid+"\")'>"+
    //                                "<i class='fa-regular fa-calendar' onclick=''  style='float:right;margin-top:2px;margin-left:5px;color:#3f4254;cursor:pointer'></i><br>"+
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
        function copyApiKey() {
            // Get the content of the element
            var apiKey = document.getElementById("label_apikey").innerHTML;

            // Create a temporary textarea element to hold the text
            var tempTextarea = document.createElement("textarea");
            tempTextarea.value = apiKey;

            // Append the textarea to the document
            document.body.appendChild(tempTextarea);

            // Select and copy the text
            tempTextarea.select();
            document.execCommand("copy");

            // Remove the temporary textarea
            document.body.removeChild(tempTextarea);

            // Optional: Notify the user
            alertMsg("API Key를 복사했습니다.");
        }
        function updateNoData(flg){
            var nodata = document.getElementById("id_nodata");
            nodata.style.display = flg ? "block" : "none";
        }
         function selectChannel(idx){
            var div_channelinfo_ = document.getElementById("div_channelinfo_"+idx);
            
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
             now_channel = getNowChannel(idx);
             editChannelKeyTag();
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
                
                div_temp.style="position:absolute;width:270px;height:120px;background-color:#F1FAFF;color:white;border-radius:5px;box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);float:left;padding:10px 20px;10px;20px;px;margin-top:-120px;cursor:pointer";


                var tlen = div_box.children.length;
                var hlen = tlen > 0 ? parseInt((tlen-1)/WMAX) : 0;
                var addheight = (hlen-parseInt(idx/WMAX))*135;
                
                div_box.appendChild(div_temp);

                var anitop = parseInt(div_temp.style.marginTop)+170+addheight;
//                var anileft = parseInt(div_temp.style.marginLeft)-mleft+87;
            
                div_temp.style.opacity = "0.5";
            
                
                $("#div_temp").animate({"margin-top":anitop, "margin-left":-(idx%WMAX*282), "width":"769px","height":"236px","opacity":0,"transition":"top 1s"} ,500,function(){
                    div_box.removeChild(div_temp);
                });
            ///////////////////////////////////////////////////////////
            // name animation END
            ///////////////////////////////////////////////////////////

            
        }
        function editChannelKeyTag() {
            var main_div = document.getElementById("main_div");
            main_div.innerHTML = "";
            var manageruid = "";
            
            var div = document.createElement("div");
            div.innerHTML = "<div align='center' id='div_data_"+manageruid+"' style='width:100%;height:auto;'>"+
                
                   
//                                "<table align='center' id='table_gxpayroll_"+manageruid+"' class='table table-bordered' style='width:100%;height:auto;text-align:center'>"+
                                    
                                    //내용은 금액을 계산한 후에 다른곳에서 입력한다. 
                                    detailKeySettingTag()+
                                    
//                                 "</table>"+
                                 "<br><br><br><br><br><div align='left' style='height:60px;margin-left:20px;'>"+
                                    "<button onclick='downloadSDK()' class='btn ' style='float:right;;margin-right:20px;cursor:pointer;width:160px; height:40px;border-radius:5px;border:0px;outline:none;background-color:#33a186;font-size:14px; color:#ffffff;text-align:center;font-weight:700;' id='btn_change_channel_data'>SDK 다운로드</button>"+
                                 "</div>"+
                            "</div>";
            
              
            var main_div = document.getElementById("main_div");
            main_div.appendChild(div);
        }
        function addUrl(){
            
            var domains = parseInt(now_channel.ch_urls);
            if(domains.length >= parseInt(now_channel.ch_maxdomain)){
                alertMsg("도메인을 더이상 추가할 수 없습니다. ");
            }else {
                
                 var style = {
                    bodycolor: "white",
                     marginTop:"0px",
                    size: {
                        width: "60%",
                        height: "auto"
                    }
                };
                var title_tag = "<label style='color:#181c32'>도메인 추가하기</label>";
                
                var div_center_vertical_css = "display: flex; flex-direction: column; align-items: center; justify-content: center; box-sizing: border-box;";
                var div_center_vertical_css2 = "display: flex; flex-direction: column; justify-content: center; ";
                var message_tag = "<label style='font-size:16px;font-weight:600;color:#181c32'>추가할 도메인을 입력해 주세요. </label><br><br>"+
                "<div align='center' style='display: flex; width:100%;height:auto;border-radius:10px;color:#3F4254;border-radius:5px;float:left;cursor:pointer;'>"+                    
                    "<div style='"+div_center_vertical_css+"width:100px;height:60px;padding:10px'>"+
                        "<label style='text-align:left'>도메인 입력</label>"+
                    "</div>"+
                    "<div  style='"+div_center_vertical_css2+"width:80%;height:60px;padding:10px'>"+
                        "<input type='text' class='form-control myinputtype' onchange='' id='input_domain' name='input_url' placeholder='ex)www.smartflat.co.kr' style='width:100%;'>"+
                    "</div>"+
                "</div>";
                showModalDialog(document.body, title_tag,  message_tag , "추가하기", "취소", function() {
                    var input_domain = document.getElementById("input_domain");
                    if(input_domain.value == ""){
                        alertMsg("도메인 주소를 입력해주세요.");
                        return;
                    }
                    var empty = [];
                    var urls = now_channel.ch_urls == "" ? empty : JSON.parse(now_channel.ch_urls);
                    urls.push(input_domain.value);
                    urls = removeDuplicates(urls);
                    now_channel.ch_urls = JSON.stringify(urls);
                    
                    updateUrl(now_channel.ch_idx, now_channel.ch_urls);
                    C_showToast("도메인추가", input_domain.value+" 도메인을 추가하였습니다.", function () {});
                    hideModalDialog();
                }, function() {
                    hideModalDialog();
                }, null);
            }
            
        }
        
        function updateUrl(ch_idx, str_urls){
            var _data = {
                    "idx": ch_idx,
                    "urls" : str_urls      
                };
             updateChannelUrl(_data, function(res){
                 accounts = res;
                console.log("getSubUserList res ",res);
                if(res != null){
                    console.log("111 getSubUserList res ",res);
                    
                    editChannelKeyTag();
                }
            });
        }
       
        function getNowChannel(idx){
            var ch = null;
            if(idx < 0)return;
            for(var i=0 ; i < channels.length; i++){
                if(i == idx){
                    ch = channels[i];
                    break;
                }
            }
            return ch;
        }
        function getNowChannelChIdx(ch_idx){
            var ch = null;
            
            for(var i=0 ; i < channels.length; i++){
                if(channels[i].ch_idx == ch_idx){
                    ch = channels[i];
                    break;
                }
            }
            return ch;
        }
        //채널박스 생성
        function drawKeyUrls(){
            var urls_tag = "";
             var permission_delete_domain = checkCreateKeyPermission(PERMISSION_DELETE_DOMAIN);
            console.log("permission_delete_domain "+permission_delete_domain);
            if(now_channel){
                var empty = [];
                var urls = now_channel.ch_urls == "" ? empty : JSON.parse(now_channel.ch_urls);
                
                for (var i = 0 ; i < urls.length; i++){
                    var isselected = true;            
                    var box_css = isselected ? "box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);border:0px" : "border:1px solid #D9DCED";
                    var title_css = isselected ? "border-bottom:0px;" : "border-bottom:1px solid #D9DCED;";
                    var body_css = isselected ? "background-color:#F1FAFF;border-bottom:0px;" : "background-color:white;border-bottom:1px solid #D97C7D;";
                    var users_info_display = isselected ? "block" : "none";
                    var channel_name = now_channel.ch_name;
                    
                    var xtag = permission_delete_domain ? "<img src='./img/btn_rectx_press.png' style='float:right;margin-top:2px;margin-left:8px;width:16px;height:16px;cursor:pointer'  onclick='deleteUrl(\""+urls[i]+"\")'>" : "";
                    var traner_info_tag = 
                            "<div align='center' onClick='clickUrl(\""+urls[i]+"\")' style='width:300px;height:60px;border-radius:5px;"+box_css+";background-color:#aF4254;border-radius:5px;float:left;cursor:pointer;margin:5px 7px 10px 5px;padding:17px'>"+
                                    //PT달력 이름
                                    "<label style='color:white;font-weight: 500;font-size:16px;float:left' >"+urls[i]+"</label>"+
                                     xtag+
                            "</div>";
                    urls_tag += traner_info_tag;    
                }
            }
            return urls_tag;
        }
        function clickUrl(url){
            console.log("function clickUrl: "+url);
        }
        function deleteUrl(url){
            var title_tag = "<label style='color:#181c32'>[경고]도메인 삭제</label>";            
            showModalDialog(document.body, title_tag,  "<label style='font-size:16px;font-weight:600;color:#181c32'>"+url+" 를 삭제하시겠습니까? </label><br><br>" , "삭제하기", "취소", function() {
                
               var empty = [];
                var urls = now_channel.ch_urls == "" ? empty : JSON.parse(now_channel.ch_urls);
                // 배열에서 URL 삭제
                urls = urls.filter(item => item !== url);
                
                now_channel.ch_urls = JSON.stringify(urls);
                updateUrl(now_channel.ch_idx, now_channel.ch_urls);
                hideModalDialog();
            }, function() {
                hideModalDialog();
            }, null);
        }

        function detailKeySettingTag(){
            var permission_add_domain = checkCreateKeyPermission(PERMISSION_ADD_DOMAIN);
           
            var name = "open";
            var txt_off = "공개용";
            var txt_on = "개인전용";
            
            var div_center_vertical_css = "display: flex; flex-direction: column; align-items: center; justify-content: center; box-sizing: border-box;";
            var div_center_vertical_css2 = "display: flex; flex-direction: column; justify-content: center; ";
               
           
            
            var apikey_tag = 
                "<br><br><br>"+
                "<div id='div_apikey'>"+                      
                    "<div align='center' style='display: flex; width:100%;height:auto;border-radius:10px;background-color:#eeeeee;color:#3F4254;float:left;cursor:pointer;padding-top:5px'>"+                    
                        "<div style='"+div_center_vertical_css+"width:170px;height:60px;padding:10px'>"+
                            "<label style='font-size:20px;font-weight:bold;text-align:left'>API KEY</label>"+
                        "</div>"+
                        "<div  style='"+div_center_vertical_css2+"width:75%;height:60px;padding:10px'>"+
                            "<label id='label_apikey' style='display: inline-block;max-width: 75%px;white-space: nowrap;text-align:left;overflow: hidden; text-overflow: ellipsis;'>"+now_channel.ch_apikey+"</label>"+
                        "</div>"+
                        "<button id='button_chargehistory' style='float:right; width: 153px;margin-top:7px; margin-right:15px; height: 40px; border-radius: 5px; background-color: rgb(0, 158, 247); font-size: 13px; color: rgb(255, 255, 255); text-align: center; font-weight: 400; border: 0px; outline: none;' onclick='copyApiKey()'><img src='./img/icon_copy.png' style='width:25px;height:25px;float:left;'/>ApiKey 복사</button>"+
                    "</div>";
                "</div>";
            
            var btn_add_tag = permission_add_domain ? "<button id='button_chargehistory' style='float:right; width: 103px;margin-top:5px; height: 40px; border-radius: 5px; background-color: rgb(0, 158, 247); font-size: 13px; color: rgb(255, 255, 255); text-align: center; font-weight: 400; border: 0px; outline: none;' onclick='addUrl()'>+ 도메인 추가</button>" : "";
            
            var tag = 
               "<div style='width:100%;height:auto;border-radius:0 10px 10px 10px ;border:1px solid #eeeeee;padding:20px;'>"+
                    btn_add_tag+
                   "<div id='div_key_main' style='display:flex;'>"+
                        "<br>"+

                        drawKeyUrls()+


                   "</div>"+
                    "<div>"+
                            apikey_tag+
                     "<div>"+
                "</div>";
            return tag;
         
        }   
        
        function downloadSDK(){
            console.log("(작업해야함)SDK 다운로드한다!!! ");
        }
    </script>
