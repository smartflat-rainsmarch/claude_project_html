function call_app(key,value){
    if(!key){
        C_AppCall("closeWebView",value);
    }
    else{
        
        switch(key){
            case "close":
                C_AppCall("closeWebView",value);
                break;
            case "toastShort":
                C_AppCall("toastShort",value); 
                break;
            case "toastLong":
                C_AppCall("toastLong",value); 
                break;
             case "phoneCall":
                C_AppCall("phoneCall",value); 
                break;
        }                  
    }
}
function loadJSON(filePath, callback) {
    fetch(filePath)
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(data => {
            callback(null, data); // 성공 시 callback에 데이터 전달
        })
        .catch(error => {
            callback(error, null); // 실패 시 callback에 에러 전달
        });
}
var savekey = "html";
function saveData(key, value) {
    if (savekey == null) return;

    var htype = window.location.hostname.indexOf("localhost") >= 0 ? "localhost" : "smartflatorder";
    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
    var type = htype + "_" + drtype;
    var skey = type + "_" + savekey + "_" + key;
    //    clog("SAVE skey "+skey+" value "+value);
    localStorage.setItem(skey, value);
}

function getData(key) {
    if (savekey == null) return;

    var htype = window.location.hostname.indexOf("localhost") >= 0 ? "localhost" : "smartflatorder";
    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
    var type = htype + "_" + drtype;
    var skey = type + "_" + savekey + "_" + key;

    var data = localStorage.getItem(skey, "");
    //    clog("LOAD key "+skey+" data "+data);

    return data;
}
function C_AppCall(key,message,callback){
   
    var callbackkey = random_string();
    if(getDevice() == "iphone") {
        try{
            var callbackkey = random_string();
            switch(key){
                case "phoneCall":
                    webkit.messageHandlers.phoneCall.postMessage({ "message" : message});
                    break;
                case "closeWebView":
                    webkit.messageHandlers.closeWebView.postMessage({ "message" : message});
                    break;
                case "toastShort":
                    webkit.messageHandlers.toastShort.postMessage({ "message" : message});
                    break;
                case "toastLong":
                    webkit.messageHandlers.toastLong.postMessage({ "message" : message});
                    break;
                    
                    
                case "checkQRCode":
                    webkit.messageHandlers.checkQRCode.postMessage({"callbackkey" :callbackkey , "message" : message});
                    
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
                case "gameLog":
                    webkit.messageHandlers.gameLog.postMessage({"callbackkey" :callbackkey , "message" : message});
                    break;
                case "appSaveData":
                    var key = message.key+"";
                    var value = JSON.stringify(message.value);
                    webkit.messageHandlers.appSaveData.postMessage({"key" :key , "value" : value});
                    
                    break;
                case "appLoadData":
                    webkit.messageHandlers.appLoadData.postMessage({"callbackkey" :callbackkey , "message" : message});
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
            }
        }catch(e){
            clog("iOS call error ",e);
        }
    }else {
        if(window.android){
           
//            clog("window.android is ",window);
            switch(key){
                case "phoneCall":
                    window.android.phoneCall(message);    
                    
                break;
                case "closeWebView":
                    window.android.closeWebView(message);    
                    break;
                case "toastShort":
                    window.android.toastShort(message);       
                    break;
                case "toastLong":
                    window.android.toastLong(message);       
                    break;
                case "checkQRCode":

                    window.android.checkQRCode(callbackkey , message);    
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
                case "gameLog":
                    window.android.gameLog(callbackkey , message);    
                    break;
                case "appSaveData":
                    var key = message.key+"";
                    var value = JSON.stringify(message.value);
                    window.android.appSaveData(key , value);    
                    break;
                case "appLoadData":
                    window.android.appLoadData(callbackkey , message);    
                    var gInterval = setInterval(function(){

                        var callback_value = window.CheckAppCallbackData(callbackkey);
                        if(callback_value != null){
                            clearInterval(gInterval);
                            callback(callback_value);
                        }
                    },100);
                    break;
            }
        }
    }
    
}
function getDevice(){
    var data = "other";
    if( /Android/i.test(navigator.userAgent)) {
        // 안드로이드
        data = "android";
    }else if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
        // iOS 아이폰, 아이패드, 아이팟
        data = "iphone";
    }else {
        // 그 외 디바이스
        data = "PC";
    }

    return data;

}
function random_string(_len) {
    var len = 16;
    if (_len) len = _len;
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_";

    for (var i = 0; i < len; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}
function CallHandlerGame(type, data, success, error) {

    var url = "";
    switch (type) {

        case "adm_game":
            url = '../../ssapi/adm_game.php?';
            break;
        
    }
    

    
    console.log("CallHandler type : "+type);
    console.log("CallHandler data : ",data);
    
    C_AsyncCallGame(url, data, function (res) {


//        C_HideLoadingProgress();
        if (success) success(res);

    }, function (err) {
//        C_HideLoadingProgress();
        if (error) error(err);

    });
}
function C_AsyncCallGame(callurl, datas, onComplete, onError, options) {
    


    if (!datas) datas = {};
//    console.log("datas : ", datas);
    // 기본 AJAX 설정
    let ajaxSettings = {
        url: callurl,
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: datas,
        transformRequest: function (data) {
            return $.param(data);
        },
        success: function (data, status, xhr) {
             console.log("SUCCESS response:", data); // ★ 여기
            if (onComplete) onComplete(data);
        },
        error: function (xhr, status, err) {
            console.log("C_AsyncCall error : ", xhr, status, err);
            if (onError) onError(err);
        }
    };

    // options가 있는 경우 AJAX 설정 재정의
    if (options) {
        // headers 옵션이 있고, 그 중 undefined 값이 있다면 해당 헤더 제거
        if (options.headers) {
            for (let key in options.headers) {
                if (options.headers[key] === undefined) {
                    delete ajaxSettings.headers[key];
                }
            }
        }
        ajaxSettings = { ...ajaxSettings, ...options };
    }

    return $.ajax(ajaxSettings);
}

function AJAX_AdmGetGame(type,_data,success,error){
    
   
    var senddata = {
        type :type,
        value : _data    
    };
    console.log("AJAX_AdmGet type "+type);
    console.log("AJAX_AdmGet datae ",_data);
    CallHandlerGame("adm_game", senddata, function (res) {
        console.log("AJAX_AdmGet success!!");
       if(success)success(res);
        
    }, function (err) {
        console.log("AJAX_AdmGet error!!");
        if(error)error(err);
        console.log("err ",err);
    },true);
}

function removeFileExtension(filename) {
    return filename.replace(/\.[^/.]+$/, '');
}

function getParam(sname) {
    var params = location.search.substr(location.search.indexOf("?") + 1);
    var sval = "";
    params = params.split("&");
    for (var i = 0; i < params.length; i++) {
        temp = params[i].split("=");
        if ([temp[0]] == sname) { sval = temp[1]; }
    }
    return sval;
}



var modal_id = null;
var modal_ids = [];
var screen_zoom = 100;
function showModalDialog(parent, title, message, ok_button_text, cancel_button_text, ok_callback, cancel_callback, style, callback) {
    var id = random_string();
    initModalDialog(id, parent, style);
    var modal = document.getElementById(id);
    modal.style.width = "80%;";
    modal.style.height = "80%;";

    var title_div = document.getElementById(id + "_title");
    var message_div = document.getElementById(id + "_body");
    if (style && style.bodycolor) message_div.style.backgroundColor = style.bodycolor;
    /* 221005 유진 수정 */
    message_div.style.backgroundColor = '#ffffff';
    var footer_div = document.getElementById(id + "_footer");
    
    if (typeof title === 'object' && title instanceof Node) {
        title_div.innerHTML = ''; // 기존 내용 비우기
        title_div.appendChild(title);
    }else{
        title_div.innerHTML = title;  
    }
    
    if (typeof message === 'object' && message instanceof Node) {
        message_div.innerHTML = ''; // 기존 내용 비우기
        message_div.appendChild(message);
    }else{
        message_div.innerHTML = message;  
    }
        



    if (cancel_button_text) {
        var cancel_bnt_id = id + "_cancel";
        createButton(cancel_bnt_id, footer_div, cancel_button_text, cancel_callback, style);
    }
    var ok_bnt_id = id + "_ok";
    createButton(ok_bnt_id, footer_div, ok_button_text, ok_callback, style);
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });

    //모달이 떴다면 처리한다.
    $("#" + id).on('shown.bs.modal', function (e) {
        var id_user_search = document.getElementById("id_user_search");
        if (id_user_search) id_user_search.focus();
    })

    // callback이 함수인 경우에만 실행
    if (typeof callback === 'function') {
        callback(id);
    }
}


function createButton(btn_id, parent, button_text, click_callback, style) { //이부분 수정해야함
    var btn = document.createElement("BUTTON");
    btn.id = btn_id;
    btn.innerHTML = button_text;
    btn.style.background = "#007bff";
    btn.style.color = "#eeeeee";
    btn.style.paddingLeft = "20px";
    btn.style.paddingRight = "20px";
    btn.style.border = "0px";
    if (style) {
        if (style.color) btn.style.color = style.color;
        if (style.bgcolor) btn.style.backgroundColor = style.bgcolor;
    }
    btn.className = "btn btn-default";
    btn.onclick = click_callback;
    parent.appendChild(btn);
}


function hideModalDialog() {

    var id = modal_ids.pop();
    //     console.log("hide 000");
    if (id != null) {
        console.log("hide 111");
        document.getElementById(id + "_title").innerHTML = "";
        document.getElementById(id + "_body").innerHTML = "";
        document.getElementById(id + "_footer").innerHTML = "";
        $("#" + id).modal("hide").data('bs.modal', null);
        $("#" + id).on("hidden.bs.modal", function (e) { //fire on closing modal box
            if ($('.modal:visible').length) { // check whether parent modal is opend after child modal close
                $('body').addClass('modal-open'); // if open mean length is 1 then add a bootstrap css class to body of the page
                console.log("hide 333");
            }
        });
    }
}

function initModalDialog(id, parent, style) {

    //    clog(document.getElementById("my_modal_dialog"));
    if (!document.getElementById(id)) {
        //        parent.innerHTML="<div id='my_modal_dialog' class='modal fade' role='dialog'><div class='modal-dialog'><div class='modal-content'><div id='mymodaltitle' class='modal-header'></div><div id='mymodalbody' class='modal-body' style='text-align:center'></div><div id='mymodalfooter' class='modal-footer'></div></div></div></div>";
        modal_id = id;
        modal_ids.push(id);
        var modal = document.createElement("div");
        modal.className = "modal fade";
        modal.id = id;
        modal.setAttribute("role", "dialog");
        modal.style.boxShadow = "0px 5px 5px 0px rgba(0,0,0,0.1)";

        parent.appendChild(modal);



        var modal_class = document.createElement("div");
        modal_class.className = "modal-dialog";
        modal_class.id = id + "_class";
        if (style && style.size) {
            modal_class.style.maxWidth = style.size.width;
            modal_class.style.maxHeight = style.size.height;

        }

        modal.appendChild(modal_class);

        var modal_content = document.createElement("div");
        modal_content.className = "modal-content";
        modal_content.id = id + "_content";
        modal_class.appendChild(modal_content);

        var modal_title = document.createElement("div");
        modal_title.className = "modal-header";
        modal_title.id = id + "_title";
        modal_title.style.backgroundColor = "white";
        modal_title.style.height = "70px";
        modal_title.style.color = "#262930";
        modal_title.style.fontSize = "20px";
        modal_title.style.fontWeight = "700";
        modal_title.style.borderRadius = "10px 10px 0px 0px";
        modal_title.style.marginTop = "10px";
        modal_title.style.marginLeft = "10px";
        modal_title.style.marginRight = "10px";
        if (style && style.border) modal_title.style.border = style.border;

        modal_content.appendChild(modal_title);

        var modal_body = document.createElement("div");
        modal_body.className = "modal-body";
        modal_body.id = id + "_body";
        modal_body.style.textAlign = "center";
        modal_body.style.backgroundColor = "white";
        modal_body.style.border = "0px";
        if (style && style.border) modal_body.style.border = style.border;
        modal_content.appendChild(modal_body);

        var modal_footer = document.createElement("div");
        modal_footer.className = "modal-footer";
        modal_footer.id = id + "_footer";
        modal_footer.style.backgroundColor = "white";
        modal_footer.style.height = "70px";
        modal_content.appendChild(modal_footer);
        if (style && style.border) modal_footer.style.border = style.border;
        modal_body.style.overflow = "scroll";
        var screen_height = $(window).height();
        var zoom = screen_zoom / 100;

        modal_body.style.maxHeight = ((screen_height - 200 * zoom) / zoom) + "px";
    }
}

function getTag_Button(id,text, onclick , width_text, height_text, bgcolor_text,txt_color_text, other_tag, add_style_tag){
    var text_Tag = text ? text : "";
    var onClick_Tag = onclick ? onclick : "";
    var width_Tag = width_text ? width_text : "160px";
    var height_Tag = height_text ? height_text : "40px";
    var bgColor_Tag = bgcolor_text ? bgcolor_text : "#33a186";
    var txtColor_Tag = txt_color_text ? txt_color_text : "#ffffff";
     var other_Tag = other_tag ? other_tag : "";
    
    return "<button onclick='"+onClick_Tag+"' class='btn ' style='cursor:pointer;width:"+width_Tag+"; height:"+height_Tag+";border-radius:5px;border:0px;outline:none;background-color:"+bgColor_Tag+";font-size:14px; color:"+txtColor_Tag+";text-align:center;font-weight:700;"+add_style_tag+"' id='"+id+"'  "+other_Tag+">"+text_Tag+"</button>";
    
}
function uploadFormProcess(FILE_UPLOAD_PLACE, type, _data,fileProgressId, progressBarId, largeImageInput, callback){
    var fileProgress = document.getElementById(fileProgressId);
    var progressBar = document.getElementById(progressBarId);
    // FormData 객체 생성
    const formData = new FormData();

    // 폼 데이터 추가
    formData.append('value', JSON.stringify(_data) );
    formData.append("type", type);

  // 이미지 파일 추가 (큰 이미지)
    
    if (largeImageInput && largeImageInput.files.length > 0) {
        formData.append("file", largeImageInput.files[0]);
    }
    

    const xhr = new XMLHttpRequest();
    xhr.open("POST", FILE_UPLOAD_PLACE, true);

    xhr.upload.onprogress = function (event) {
        if (event.lengthComputable) {
            const percentComplete = Math.round((event.loaded / event.total) * 100);
            if(progressBar)progressBar.style.width = percentComplete + "%";
        }
    };
//    C_ShowLoadingProgress();
    // Set up event listeners for the XMLHttpRequest
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
//            C_HideLoadingProgress();
            if (xhr.status === 200) {

                // File upload successful
                console.log('File upload successful',xhr);
                var res = JSON.parse(xhr.response);
                if(res.code="100"){
                   callback("success");
                    
                }else{
                     //메일발송 실패
                   callback("error");
                }
                
            } else {
                // File upload failed
                console.error('File upload failed',xhr);
            }
        }
    };


    xhr.onerror = function () {
        console.error("Upload error.");
        if(progressBar)progressBar.style.width = "0%";
    };

    xhr.send(formData);
}
function fadeIn(element) {
    element.classList.add('fade');
    element.style.display = "block"; // 우선 보여주고
    setTimeout(() => {
        element.classList.add('show');
    }, 10); // 다음 프레임에 show 추가
}

function fadeOut(element) {
    element.classList.remove('show');
    setTimeout(() => {
        element.style.display = "none";
    }, 1000); // transition 끝나고 안보이게
}


//////////////////////////////////////////////////////////////////////////////////
//콤보박스 태그 아이디, 디폴트값(null이면 생성안함) , objs
function getTag_Select(id,default_text, objs, value_key, text_key, onchange_str,value, width_text,height_text, other_tag, add_style_tag){
    var default_tag = default_text ? "<option value=''>"+default_text+"</option>" : "";
    var option_tags = "";
    
     var width_Tag = width_text ? width_text : "100%";
    var height_Tag = height_text ? height_text : "40px";
     var other_Tag = other_tag ? other_tag : "";
    
   
    if(objs)
    for(var i = 0 ; i < objs.length;i++){       
        var selected = value != undefined && value == objs[i][value_key] ? "selected" : "";    
        option_tags += value_key ? "<option value='"+objs[i][value_key]+"' "+selected+">"+objs[i][text_key]+"</option>" : "<option value='"+(i+1)+"'  "+selected+">"+objs[i][text_key]+"</option>";
    }
    var onchange_tag = onchange_str ? onchange_str : "";
    var tag = 
    "<select id='"+id+"' name='"+id+"' onchange='"+onchange_tag+"' class='form-control myinputtype' style='width:"+width_Tag+";height:"+height_Tag+";"+add_style_tag+"'  "+other_Tag+" >"+
        default_tag+
        option_tags+
    "</select>";
    return tag;
}
/*
입력박스
id : 아이디
type : 입력타입 type_text , type_number , type_innumber_own, type_password ,...
isOnFocus : 기본 포커스인지 아닌지  true , false
isCommaNumber : 콤마 숫자인지 (금액일때) 아닌지  true ,false
value : 값
width : default :100%
height : default : 45px
placeholder_text : 입력전 문구
*/
function getTag_Input(id, itype, value, width_text, height_text, placeholder_text, bgcolor_text, font_color_text, font_size_text, other_tag, add_class_tag, add_onkeyup_tag, add_style_tag){
    var _type = "text";
    var onFocus_Tag = "";
    var onKeyUp_Tag = "";
    var value_Tag = "";
    var addOnKeyup_Tag = add_onkeyup_tag ? add_onkeyup_tag : "";
    
    switch(itype){
        case "type_text":
            _type = "text";
            onFocus_Tag = "";
            onKeyUp_Tag = addOnKeyup_Tag;
            value_Tag = value ? value : "";
            break;
        case "type_number":
            _type = "number";
            onFocus_Tag = "this.select()";
            onKeyUp_Tag = addOnKeyup_Tag;
            value_Tag = value ? value : "";
            break;
        case "type_price":
            _type = "text";
            onFocus_Tag = "this.select()";
            onKeyUp_Tag = "inputChangeComma(\"" + id + "\");"+addOnKeyup_Tag;
            value_Tag = value ? CommaString(value) : "";
            break;
        case "type_priceown":
            _type = "text";
            onFocus_Tag = "this.select()";
            onKeyUp_Tag = "inputChangeComma(\"" + id + "\", true);"+addOnKeyup_Tag;
            value_Tag = value ? CommaStringWon(value) : "";
            break;
        case "type_password":
            _type = "password";
            onFocus_Tag = "";
            onKeyUp_Tag = addOnKeyup_Tag;
            value_Tag = value ? value : "";
            break;
        case "type_date":
            _type = "date";
            onFocus_Tag = "";
            onKeyUp_Tag = addOnKeyup_Tag;
            value_Tag = value ? value : "";
            break;    
       case "type_email":
            _type = "email";
            onFocus_Tag = "";
            onKeyUp_Tag = addOnKeyup_Tag;
            value_Tag = value ? value : "";
            break;
       default:
            _type = "text";
            onFocus_Tag = "";
            onKeyUp_Tag = addOnKeyup_Tag;
            value_Tag = value ? value : "";
            break;
    }

    var width_Tag = width_text ? width_text : "100%";
    var height_Tag = height_text ? height_text : "45px";
    var bgColor_Tag = bgcolor_text ? bgcolor_text : "#eef3f7";
    var font_color_text = font_color_text ? font_color_text : "#1e8298";
    var font_size_text = font_size_text ? font_size_text : "#14px";
    var other_Tag = other_tag ? other_tag : "";
    
    var tag = "<input type='"+_type+"' id='"+id+"' name='"+id+"'  class='form-control myinputtype "+add_class_tag+"' onfocus='"+onFocus_Tag+"' onkeyup='"+onKeyUp_Tag+"' value='" + value_Tag + "'   style='outline:none;border:0px;width:"+width_Tag+"; height:"+height_Tag+";border-radius:10px;background-color:"+bgColor_Tag+";font-size: "+font_size_text+"; color:"+font_color_text+";text-align:left;padding-left:20px;"+add_style_tag+"' placeholder='"+placeholder_text+"' "+other_Tag+" />";
    
//    console.log("tag "+tag);
    return tag;
}
function getTag_Label(id,text,style,isImportant, other_tag){
    var id_Tag = id ? id : "";
    var text_Tag = text ? text : "";
    var style_Tag = style ? style : "";
    var important_Tag = isImportant ? "<span style='color:red'>&nbsp;*&nbsp;</span>" : "";
     var other_Tag = other_tag ? other_tag : "";
   
    return "<label id='"+id_Tag+"' style='"+style_Tag+"' "+other_Tag+">"+important_Tag+""+text_Tag+"</label>";
}

function getTag_Button(id,text, onclick , width_text, height_text, bgcolor_text,txt_color_text, other_tag, add_style_tag){
    var text_Tag = text ? text : "";
    var onClick_Tag = onclick ? onclick : "";
    var width_Tag = width_text ? width_text : "160px";
    var height_Tag = height_text ? height_text : "40px";
    var bgColor_Tag = bgcolor_text ? bgcolor_text : "#33a186";
    var txtColor_Tag = txt_color_text ? txt_color_text : "#ffffff";
     var other_Tag = other_tag ? other_tag : "";
    
    return "<button onclick='"+onClick_Tag+"' class='btn ' style='cursor:pointer;width:"+width_Tag+"; height:"+height_Tag+";border-radius:5px;border:0px;outline:none;background-color:"+bgColor_Tag+";font-size:14px; color:"+txtColor_Tag+";text-align:center;font-weight:700;"+add_style_tag+"' id='"+id+"'  "+other_Tag+">"+text_Tag+"</button>";
    
}
function getTag_TextArea(id, text, onclick, text_holder, width_text, height_text, bgcolor_text, txt_color_text, other_tag, add_style_tag){
    var text_Tag = text ? text : "";
    var onClick_Tag = onclick ? onclick : "";
    var width_Tag = width_text ? width_text : "100%";
    var height_Tag = height_text ? height_text : "40px";
    var bgColor_Tag = bgcolor_text ? bgcolor_text : "#33a186";
    var txtColor_Tag = txt_color_text ? txt_color_text : "#ffffff";
    var other_Tag = other_tag ? other_tag : "";
    
    return "<textarea id='" + id + "' name='" + id + "' class='form-control '  onclick='"+onClick_Tag+"'  placeholder='"+text_holder+"' style='width:"+width_Tag+"; height:"+height_Tag+";border-radius:5px;border:0px;outline:none;background-color:"+bgColor_Tag+";font-size:14px; font-weight:700;color:"+txtColor_Tag+";"+add_style_tag+"'  "+other_Tag+">"+text_Tag+"</textarea>";
}
function getTag_Checkbox(id,text,txt_checked, style, other_tag){
    var id_Tag = id ? id : "";
    var text_Tag = text ? text : "";
    var checked_Tag = txt_checked ? "checked" : "";
    var other_Tag = other_tag ? other_tag : "";
    return "<span style='float:left;"+style+"'><label class='mycheckbox'><input style='' type='checkbox' id='"+id_Tag+"'  name='"+id_Tag+"' "+checked_Tag+" "+other_Tag+"><span class='checkmark'></span></label></span>"+
            "<span style='float:left;'><text >"+text_Tag+"&nbsp;&nbsp;&nbsp;</text></span>";
}
function getFilename(path) {
    return path.split('/').pop();
}
//div 목록에서 id element만 지운다.
function removeElementByIdFromDiv(container, targetId) {
 

    const targetElement = document.getElementById(targetId);
    if (targetElement && container.contains(targetElement)) {
        container.removeChild(targetElement);
    }
}
function setBtnEventColor(id, normalcolor, clickcolor, hovercolor) {
    var ncolor = !normalcolor ? "white" : normalcolor;
    var ccolor = !clickcolor ? ncolor : clickcolor;
    var hcolor = !hovercolor ? ccolor : hovercolor;

    $("#" + id).bind("touchstart", function () {
        $(this).css("background-color", ccolor);
    });
    $("#" + id).bind("touchend", function () {
        $(this).css("background-color", ncolor);
    });

    $("#" + id).mouseover(function () {
        $(this).css("background-color", hcolor);
    });

    $("#" + id).mouseout(function () {
        $(this).css("background-color", ncolor);
    });
    $("#" + id).mousedown(function () {
        $(this).css("background-color", ccolor);
    });
    $("#" + id).mouseup(function () {
        $(this).css("background-color", ncolor);
    });
}

function setImageButton(id, _default_name, _press_name, _hover_name) {
    var _default_name = _default_name.indexOf("./img/") >= 0 ? _default_name : "./img/" + _default_name;
    var _press_name = _press_name.indexOf("./img/") >= 0 ? _press_name : "./img/" + _press_name;
    var _hover_name = _hover_name.indexOf("./img/") >= 0 ? _hover_name : "./img/" + _hover_name;

    var default_name = _default_name;
    var hover_name = _hover_name ? _hover_name : _press_name;
    if (!hover_name) hover_name = _default_name;
    var press_name = _press_name ? _press_name : _default_name;

    $("#" + id).bind("touchstart", function () {
        $(this).attr('src', press_name);
    });
    $("#" + id).bind("touchend", function () {
        $(this).attr('src', default_name);
    });

    $("#" + id).mouseover(function () {
        $(this).attr('src', hover_name);
    });

    $("#" + id).mouseout(function () {
        $(this).attr('src', default_name);
    });
    $("#" + id).mousedown(function () {
        $(this).attr('src', press_name);
    });
    $("#" + id).mouseup(function () {
        $(this).attr('src', default_name);
    });
}

function isWithinPeriod(startdate, enddate) {
    const now = new Date();
    const start = new Date(startdate);
    const end = new Date(enddate);

    if (now < start) {
        return -1; // 설문 전
    } else if (now > end) {
        return 0; // 설문 종료
    } else {
        return 1; // 설문 중
    }
}
function C_showConfirmPopup({ message, onConfirm ,oktext,canceltext}) {
    const existing = document.getElementById('popupOverlay');
    if (existing) existing.remove();

    const overlay = document.createElement('div');
    overlay.id = 'popupOverlay';
    Object.assign(overlay.style, {
        position: 'fixed',
        top: 0, left: 0, right: 0, bottom: 0,
        backgroundColor: 'rgba(0,0,0,0.5)',
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'center',
        zIndex: 10000
    });

    const box = document.createElement('div');
    Object.assign(box.style, {
        minWidth: '400px',
        backgroundColor: '#fff',
        borderRadius: '8px',
        padding: '20px',
        boxShadow: '0 4px 10px rgba(0,0,0,0.3)',
        textAlign: 'center'
    });

    const text = document.createElement('div');
    text.innerHTML = message;
    Object.assign(text.style, {
        marginBottom: '20px',
        fontSize: '16px',
        color: '#333'
    });

    const btnWrapper = document.createElement('div');
    Object.assign(btnWrapper.style, {
        display: 'flex',
        justifyContent: 'flex-end',
        gap: '10px'
    });

    const cancelBtn = document.createElement('button');
    
    cancelBtn.onclick = () => overlay.remove();
     cancelBtn.innerText =  canceltext ? canceltext : '취소';

    const deleteBtn = document.createElement('button');
    
    deleteBtn.innerText =  oktext ? oktext : '삭제하기';
    deleteBtn.style.backgroundColor = '#dc3545';
    deleteBtn.style.color = '#fff';
    if(oktext == "")
        deleteBtn.style.display = "none";
    
    deleteBtn.onclick = () => {
        onConfirm();
        overlay.remove();
    };

    [cancelBtn, deleteBtn].forEach(btn => {
        Object.assign(btn.style, {
            padding: '8px 16px',
            border: 'none',
            borderRadius: '4px',
            cursor: 'pointer'
        });
    });

    btnWrapper.appendChild(cancelBtn);
    btnWrapper.appendChild(deleteBtn);
    box.appendChild(text);
    box.appendChild(btnWrapper);
    overlay.appendChild(box);
    document.body.appendChild(overlay);
}     
function reloadPage(){
    location.reload();
}

function alertMsg(str, callback){
    C_showConfirmPopup({
        message: str,
        onConfirm: () => callback,
        oktext : "",
        canceltext : "확인",
        
    });
}

//순서대로 정렬 int값 기준
function sortByKeyInt(arr, key, isUpper = false) {
  for (let i = 0; i < arr.length - 1; i++) {
    for (let j = 0; j < arr.length - i - 1; j++) {
      const a = parseInt(arr[j][key]);
      const b = parseInt(arr[j + 1][key]);

      let shouldSwap = false;
      if (isUpper) {
        // 내림차순 (큰 수부터) 정렬
        if (a < b) {
          shouldSwap = true;
        }
      } else {
        // 오름차순 (기본값) 정렬
        if (a > b) {
          shouldSwap = true;
        }
      }

      if (shouldSwap) {
        // Swap elements
        let temp = arr[j];
        arr[j] = arr[j + 1];
        arr[j + 1] = temp;
      }
    }
  }
  return arr;
}
//순서대로 정렬 string값 기준
function sortByKey(arr, key, isUpper = false) {
  for (let i = 0; i < arr.length - 1; i++) {
    for (let j = 0; j < arr.length - i - 1; j++) {
      const a = arr[j][key];
      const b = arr[j + 1][key];

      let shouldSwap = false;
      if (isUpper) {
        // 내림차순 (큰 수부터) 정렬
        if (a < b) {
          shouldSwap = true;
        }
      } else {
        // 오름차순 (기본값) 정렬
        if (a > b) {
          shouldSwap = true;
        }
      }
      
      if (shouldSwap) {
        // Swap elements
        let temp = arr[j];
        arr[j] = arr[j + 1];
        arr[j + 1] = temp;
      }
    }
  }
  return arr;
}
function new_sort(arr,key,isupper){
    //오름차순
    if(isupper){
        return arr.sort(function (a, b) {
            const valueOfKeyA = a[key].toUpperCase();
            const valueOfKeyB = b[key].toUpperCase();
            return valueOfKeyA.localeCompare(valueOfKeyB, undefined, {
              numeric: true,
              sensitivity: 'base',
            });
          });
    }
    //내림차순
    else{
        return arr.sort(function (a, b) {
            const valueOfKeyA = a[key].toUpperCase();
            const valueOfKeyB = b[key].toUpperCase();
            return valueOfKeyB.localeCompare(valueOfKeyA, undefined, {
              numeric: true,
              sensitivity: 'base',
            });
          });
    }
    console.log("key is "+key+" isupper "+isupper);
    console.log("new_sort arr is ",arr);
    return arr;
}

// HEX 색상을 RGB 객체로 변환
function hexToRgb(hex) {
    const bigint = parseInt(hex.slice(1), 16);
    const r = (bigint >> 16) & 255;
    const g = (bigint >> 8) & 255;
    const b = bigint & 255;
    return { r, g, b };
}
function C_getToday(date, type){
    var year = date.getFullYear();
    var month = (date.getMonth()+1);
    month = month >= 10 ? month : '0'+month;
    var day = date.getDate();
    day = day >= 10 ? day : '0'+day;
    var hh = date.getHours();
    var mm = date.getMinutes();
    var ss = date.getSeconds();
    
    
    if(type && type == "yyyy-mm-dd")
        return year+'-'+month+'-'+day;
    else if(type && type == "hh:mm:ss")
        return hh+":"+mm+":"+ss;
    else 
        return year+'-'+month+'-'+day+" "+hh+":"+mm+":"+ss;
}