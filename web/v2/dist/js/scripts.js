/*!
 * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2020 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
(function ($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function () {
        if (this.href === path) {
            $(this).addClass("active");
        }
    });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function (e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });


})(jQuery);

var isshowLoadingProgress = false;
function C_ShowLoadingProgress(){
    var loading_progress = document.getElementById("div_loading_progress");
//    var loading_progress = document.createElement("div");
//    loading_progress.id = "div_loading_progress";
//    loading_progress.style.width = "100%";
//    loading_progress.style.height = "100%";
//    loading_progress.style.position = "absolute";
//    loading_progress.style.textAlign = "center";
//    loading_progress.style.backgroundColor = "#11111188";
//    loading_progress.innerHTML = "<img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%'/>";
    //osition:absolute;text-align:center;width:100%;height:100%;background-color:#88888899;position:fixed;z-index:1000;display:none'>
//    document.body.append(loading_progress);
    if(loading_progress){
         loading_progress.style.display ="block"; 
         loading_progress.style.zIndex = 999999999;
         isshowLoadingProgress = true;
         setTimeout(function(){
            if(isshowLoadingProgress == true){
                C_HideLoadingProgress();
            }
        },30000);
    }
}
function C_HideLoadingProgress(){
    
    var loading_progress = document.getElementById("div_loading_progress");
    if(loading_progress){
        loading_progress.style.display ="none"; 
        isshowLoadingProgress = false;
    }
}


var internet_connected = window.navigator.onLine;
var before_internet_connected = internet_connected;
window.addEventListener('online', ()=>{ 
    /*끊김->연결로 변경될 때 호출*/
    internet_connected = window.navigator.onLine;
    console.log("다시연결됨");
});

window.addEventListener('offline', ()=>{ 
    /*연갤->끊김으로 변경될 때 호출*/
    internet_connected = window.navigator.onLine;
    console.log("다시끊김");
});

function C_AsyncCall(callurl, options, onComplete, onError,ishide_progress) {
    if(!internet_connected && before_internet_connected != internet_connected){
        alertMsg("인터넷연결이 끊겼습니다. 네트워크 연결을 확인해 주세요",function(){
            before_internet_connected = true;
        });
        before_internet_connected = internet_connected;
        return;
    }else if(internet_connected && before_internet_connected != internet_connected){
        before_internet_connected = internet_connected;
    }
    
    
    
    if(!ishide_progress)C_ShowLoadingProgress();
    if (!options) options = {};
    
    return $.ajax({
        url: callurl,
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        data: options,
        transformRequest: function (data) {
            return $.param(data);
        },
        success: function (data, status, xhr) {
            if(!ishide_progress)C_HideLoadingProgress();
            if (onComplete) onComplete(data);
            
        },
        error: function (xhr, status, err) {
            if(!ishide_progress)C_HideLoadingProgress();
            if (onError) onError(err);
        }
    });

}

function GoToPage(url, data) {
    var form = document.createElement('form');

    if (data != null) {
        var objs;
        objs = document.createElement('input');
        objs.setAttribute("type", "hidden");
        objs.setAttribute("name", "message");
        objs.setAttribute("value", JSON.stringify(data));
    }

    form.appendChild(objs);
    form.setAttribute('method', 'post');
    form.setAttribute('action', url);
    document.body.appendChild(form);
    form.submit();
}

function CallHandler(type, data, success, error,ishide_progress) {
    var url = "";
    switch (type) {
        case "login":
            url = '../../../ssapi/login_web.php';
            break;
        case "logout":
            url = '../../../ssapi/logout_web.php';
            break;
        case "register":
            url = '../../../ssapi/register.php';
            break;
        case "getdata":
            url = '../../../ssapi/getdata.php';
            break;
        case "check_register":
            url = '../../../ssapi/check_register.php';
            break;
        case "cancel_register":
            url = '../../../ssapi/cancel_register.php';
            break;
        case "terms":
            url = '../../../ssapi/terms.php';
            break;
        case "getptrule":
            url = '../../../ssapi/getptrule.php';
            break;
        case "my_reservation":
            url = '../../../ssapi/my_reservation.php';
            break;
        case "my_gxreservation":
            url = '../../../ssapi/my_gxreservation.php';
            break;
        case "my_teacher_reservation":
            url = '../../../ssapi/my_teacher_reservation.php';
            break;
        case "my_info":
            url = '../../../ssapi/my_info.php';
            break;
        case "my_health_history":
            url = '../../../ssapi/my_health_history.php';
            break;
        case "my_nosetting_users":
            url = '../../../ssapi/my_get_nosetting_users.php';
            break;
        case "change_membership":
            url = '../../../ssapi/change_membership.php';
            break;
        case "insert_user_status":
            url = '../../../ssapi/insert_user_status.php';
            break;
        case "push_message":
        url = '../../../ssapi/push_message.php';
            break;
       case "my_payroll_history":
        url = '../../../ssapi/my_payroll_history.php';
            break;
       case "adm_get":
        url = '../../../ssapi/adm_get.php';
            break;
        

    }
    
    C_AsyncCall(url, data, function (res) {
        //        clog("res is ",res);
        if (success) success(res);

    }, function (err) {
        clog("err is ", err);
        if (error) error(err);

    },ishide_progress);
}

function getTranerMyUsers(uid,success,error){
    var groupcode = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
        
    var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :"gettranermyusers",
        value : uid
    
    };
    CallHandler("adm_get", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {if(error)error(err);});
}
function setPTTraner(user_uid,couponid,teachername, teacher_value,orner_status_value, before_managerid,before_managername,groupcode,centercode, success,error){
   // var groupcode = getData("nowgroupcode");
//    var centercode = getData("nowcentercode");
    
    var value = {
        useruid : user_uid,
        couponid : couponid,        
        teachername : teachername,
        teachervalue : teacher_value, //traner_uid
        ornerstatus : orner_status_value,
        beforemanagerid : before_managerid,
        beforemanagername : before_managername
    };    
    var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :"setpttraner",
        value : value
    };
    
   
    CallHandler("adm_get", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {if(error)error(err);});
}
function alertMsg(message,callback){
    if(!message)message = "";
    showModalDialog(document.body, "알림", message, "확인", null, function() {
        hideModalDialog();
        if(callback)callback();
    }, function() {});
    
}

//function getPageData(){
//    var data = "";
//    data = getRequestBody(document.forms[0]);
//    return data;
//}
//function getRequestBody(oForm){
//    var aParams = new Array();
//    for(var i = 0 ; i < oForm.elements.length; i++){
//        var data = encodeURIComponent(oForm.elements[i].name);
//        data += "=";
//        data += encodeURIComponent(oForm.elements[i].value);
//        aParams.push(data);
//    }
//    return aParams.join("&");
//}
//createCookie("height", $(window).height(), "10");
//function createCookie(name, value, days) {
//    clog("createCookie!!");
//  var expires;
//  if (days) {
//    var date = new Date();
//    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
//    expires = "; expires=" + date.toGMTString();
//  }
//  else {
//    expires = "";
//  }
//  document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
//}
//
//function getCookie(cookieName){
//    clog("getCookie!!");
//    var cookieValue=null;
//    if(document.cookie){
//        var array=document.cookie.split((escape(cookieName)+'='));
//        if(array.length >= 2){
//            var arraySub=array[1].split(';');
//            cookieValue=unescape(arraySub[0]);
//        }
//    }
//    return cookieValue;
//}
// 
//function deleteCookie(cookieName){
//    var temp=getCookie(cookieName);
//    if(temp){
//        setCookie(cookieName,temp,(new Date(1)));
//    }
//}
//function deleteAllCookies() {
//    
//        var cookies = document.cookie.split(";");
//    clog("cookies is ",cookies);
////        for (var i = 0; i < cookies.length; i++) {
////            var expires = new Date();
////            expires.setUTCFullYear(expires.getUTCFullYear() - 1);
////            document.cookie = cookies[i] + '; expires=' + expires.toUTCString() + '; path=/';
////        }
//    }

function login() {
    clog("click login");
    location.href = PAGE_HOME_LOGIN;
}

function gotoadmin() {
    location.href = PAGE_ADMIN_PATH + PAGE_ADMIN_INDEX;
}

function gotohome() {
    location.href = PAGE_HOME_INDEX;
}

//function join() {
//    location.href = PAGE_HOME_REGISTER;
//}

function logout() {

    CallHandler("logout", null, function (res) {
        var code = parseInt(res.code);
        call_app();
        if (code == 100) {
            location.href = PAGE_HOME_INDEX;
        } else {
            location.href = PAGE_HOME_401;
        }
        
    }, function (err) {});
}
//로그인 버튼 클릭
function page_login() {
    var beforepage = getParam("beforepage"); 
    clog("login Click!");
    var input_email = document.getElementById('inputEmailAddress').value;
    var input_password = document.getElementById('inputPassword').value;
    clog("inputPassword", input_password);
    //                location.href = "index.php";


    var _data = {
        "email": input_email,
        "pass": input_password,

    };
    
    CallHandler("login", _data, function (res) {
        var code = parseInt(res.code);
        if (code == 100) {
            var authgroup = parseInt(res.message);
            var memsetting = res.memsetting && res.memsetting != "" && res.memsetting != "null" ? JSON.parse(res.memsetting) : null;
            if(authgroup > 1){
                if(beforepage && beforepage.indexOf("index.php") == -1)
                    location.href = beforepage;
                else {
//                    if(getDevice() == "PC" && authgroup >= 4)
                    if(getDevice() == "PC" && authgroup >= 4 || getDevice() == "PC" && authgroup < 4 && memsetting && memsetting.adminsetting && memsetting.adminsetting.length > 0)
                        gotoadmin();
                    else 
                        location.href = PAGE_HOME_INDEX;
                }
                
            }else if(authgroup == 1 || authgroup == 0){
                //일반유저그룹이라서 홈페이지쪽으로 이동한다.    
                //location.href = PAGE_HOME_PATH + PAGE_HOME_INDEX;
                location.href = PAGE_RESERVATION;
            }else {
                location.href = PAGE_HOME_401; //권한이 낮아서 로그인 할 수 없음
            }
            
            
            
            
//            if (authgroup >= 0) {
//                //                        var data = res.message; 
//                //                        GoToPage("./main.php",data);
//                if(beforepage && beforepage.indexOf("index.php") == -1)
//                    location.href = beforepage;
//                else {
////                    if(getDevice() == "PC" && authgroup >= 4)
//                    if(getDevice() == "PC" && authgroup >= 4 || getDevice() == "PC" && authgroup < 4 && memsetting && memsetting.adminsetting && memsetting.adminsetting.length > 0)
//                        gotoadmin();
//                    else 
//                        location.href = PAGE_HOME_INDEX;
//                }
//                    
//                //                        location.href = "../../pc/index.html"
//            } else {
//                location.href = PAGE_HOME_401; //권한이 낮아서 로그인 할 수 없음
//            }

        } else {
            alertMsg(res.message);
        }


    }, function (err) {
        alertMsg("네트워크 에러 ");
    });
}
var global_vat = 0;
var global_centersetting = {};
var global_gxdatas = [];
function uiinit(issession, namedesc) {
    var btn_login = document.getElementById("btn_login");
//    var btn_logout = document.getElementById("btn_logout");
    var li_usericon = document.getElementById("li_usericon");
    var txt_name = document.getElementById("txt_name");
//    var userDropdown = document.getElementById("userDropdown");
    //로그인하지 않았다.
    if (issession == AUTH_NOMEMBER) {
        btn_login.style.display = "block";
//        btn_logout.style.display = "block`";
        li_usericon.style.display = "none";
        txt_name.style.visibility = "none";
        
        
//        document.getElementById("nav_join").style.display = "none";
//        document.getElementById("nav_reservation").style.display = "none";
        document.getElementById("btn_admin").style.display = "none";    
    }
    //이미 로그인해세 세션이 있다.
    else {
        btn_login.style.display = "none";
//        btn_logout.style.display = "none";
        li_usericon.style.display = "block";
        txt_name.style.visibility = "block";
        
        txt_name.innerHTML += namedesc;
//        userDropdown.style.display= "block";
        
        if (issession >= AUTH_MANAGER || permission_list != undefined && permission_list != null) {
            document.getElementById("btn_admin").style.display = "block";
        }
        if (issession < AUTH_TRANER){
//            document.getElementById("nav_join").style.display = "none";
//            document.getElementById("nav_reservation").style.display = "none";            
        }
    }
   
//    setMainDiv(!checkMainDiv());
    initVat(getData("nowcentercode"));
    
    //로그아웃버튼
//    if(getDevice() != "PC"){
//        li_usericon.style.display = "none";
//    }
    
    
}
function initVat(centercode){
    var _data = {
        "type": "getvat", // group or center or auth
        "centercode": centercode,        
    };
    if(centercode)
    CallHandler("getdata", _data, function(res) {
        code = parseInt(res.code);
        if (code == 100) {
            global_vat = res.message;
            global_centersetting = res.centersetting ? res.centersetting : {};
            console.log("global_centersetting ",global_centersetting);
            if(global_centersetting.center_holiday)initCustomHoliday(global_centersetting.center_holiday);
        }

    }, function(err) {
        alertMsg("네트워크 에러 ");

    });
}
function initCustomHoliday(center_holiday){
    
    for(var i = 0 ; i < center_holiday.length;i++){
        uholiday.push(center_holiday[i]);
    }
    
}
function getTranslateXY(element) {
    const style = window.getComputedStyle(element);
    const matrix = new DOMMatrixReadOnly(style.transform);
    return {
        translateX: matrix.m41,
        translateY: matrix.m42
    }
}

function checkMainDiv() {
//    var idnav = document.getElementById("layoutSidenav_nav");
//    var div_main = document.getElementById("div_main");
//    var position = getTranslateXY(idnav);
//   
//    clog("position.translateX ", position.translateX);
//    if (position.translateX == 0) {
//        return true;
//    } else {
//        return false;
//    }
}

function setMainDiv(flg) {
    var div_main = document.getElementById("div_main");
    if (flg) {
        div_main.style.marginLeft = "0px";
    } else
        div_main.style.marginLeft = "225px";
}

function initSaveKey(sid) {
    clog("initSaveKey1 " + sid);
//    if (sid == null || sid.length == 0) {
//        location.href = PAGE_HOME_LOGIN; //권한이 낮아서 로그인 할 수 없음
//        //        clog("sid XXXX "+sid);
//    } else
        savekey = sid;
}

function saveData(key, value) {
    clog("in SaveData", savekey);
    if (savekey == null) return;
    var skey = savekey + "_" + key;
    clog("SAVE skey " + skey + " value " + value);
    localStorage.setItem(savekey + "_" + key, value);
}

function getData(key) {
    if (savekey == null) return;
    var skey = savekey + "_" + key;

    var data = localStorage.getItem(savekey + "_" + key, "");
    clog("LOAD key " + skey + " data " + data);

    return data;
}
function CommaString(num){
    var number = parseInt(num);
    return number.toLocaleString('ko-KR');
}

//json object array 특정 변수로 정렬하기
//ex )  arr.sort(sort_by('mbs_type', false, (a) =>  a.toUpperCase())); 
//      arr.sort(sort_by('mbs_use_centercode', true, parseInt));
function sort_by(field, reverse, primer) {

    const key = primer ?
        function (x) {
            if(!x)return null;
            return primer(x[field])
        } :
        function (x) {
            if(!x)return null;
            return x[field]
        };

    reverse = !reverse ? 1 : -1;

    return function (a, b) {
        return a = key(a), b = key(b), reverse * ((a > b) - (b > a));
    }
}
function get_gender_icontag(gender){
    var tag = "<i class='fa-solid fa-mars-and-venus' style='width:15px;height:15px;color:#cccccc;'></i>";
    switch(gender){
        case "M":
            tag = "<i class='fa-solid fa-mars' style='width:15px;height:15px;color:#0075cf;' ></i>";
            break;
        case "F":
            tag = "<i class='fa-solid fa-venus' style='width:15px;height:15px;color:#ed5565;' ></i>";
            break;
        case "U":
            tag = "<i class='fa-solid fa-mars-and-venus' style='width:15px;height:15px;color:#cccccc;'></i>";
            break;            
    }
    return tag;
}
function changeDateToTimeStamp(date) {
    if(getDevice() == "iphone"){
        date = date.replace(' ', 'T');
        return Date.parse(date);
    }else
        return Date.parse(date);
}
function dateToTimestamp(d){
    var date = new Date(d);
    var str = date.getTime()+"";
    if(str.length > 12)
        return date.getTime()/1000;
    else
        return date.getTime();
}

var teacherlist = [];
var modal_id = null;
var modal_ids = [];
function showModalDialog(parent, title, message, ok_button_text, cancel_button_text, ok_callback, cancel_callback, style) {
    var id = random_string();
    initModalDialog(id, parent, style);
    
    var modal = document.getElementById(id);
    modal.style.width = "100%;";
    modal.style.height = "100%;";
    modal.style.marginTop = "30%";
    
    if(style && style.marginTop)modal.style.marginTop = style.marginTop;
    
    var title_div = document.getElementById(id + "_title");
    var message_div = document.getElementById(id + "_body");
    
    if (style && style.bodycolor) message_div.style.backgroundColor = style.bodycolor;
    var footer_div = document.getElementById(id + "_footer");
    
    
    var title_color = style && style.top &&  style.top.color ? style.top.color : mColor.WHITE;
    var title_tag = "<text style='text-align:center;font-size:18px;color:"+title_color+";font-weight:700;line-height:80px'>"+title+"</text>";
    title_div.innerHTML = title_tag;
    var message_tag = "<text style='text-align:center;font-size:15px;color:"+mColor.C919191+";line-height:1.4'>"+message+"</text>";
    message_div.innerHTML = message_tag;
    
    if(style && style.button_ispositionchange){
        createButton(footer_div, ok_button_text, false,ok_callback,style);
        if (cancel_button_text)
            createButton(footer_div, cancel_button_text, true, cancel_callback,style);
        
    }else{
        if (cancel_button_text)
            createButton(footer_div, cancel_button_text, true, cancel_callback,style);
        createButton(footer_div, ok_button_text, false,ok_callback,style);
    }
    
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });
    
}
/* 221031 유진 수정 */
function showModalDialogForReady(parent,title,user_search,message,ok_button_text,cancel_button_text,ok_callback,cancel_callback,style){ // gx예약대기자 모달
    var id = random_string();
    initModalDialog(id, parent, style);
    var modal = document.getElementById(id);
    modal.style.width = "80%;";
    modal.style.height = "80%;";
    
    var title_div = document.getElementById(id+"_title");
    var message_div = document.getElementById(id+"_body");
    if(style && style.bodycolor)message_div.style.backgroundColor=style.bodycolor;
    /* 221005 유진 수정 */
    message_div.style.backgroundColor='#ffffff';
    var footer_div = document.getElementById(id+"_footer"); 
    title_div.innerHTML  = title;
    title_div.innerHTML += user_search;
    message_div.innerHTML  = message;
    clog('ready');
    initAutoComplete();
  
    if(true){    
        createButton(footer_div, ok_button_text, false,ok_callback,style);
        if (cancel_button_text)
            createButton(footer_div, cancel_button_text, true, cancel_callback,style);
        
    }else{
        if (cancel_button_text)
            createButton(footer_div, cancel_button_text, true, cancel_callback,style);
        createButton(footer_div, ok_button_text, false,ok_callback,style);
    }
    
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });

}
function showModalDialog_sign_zone(parent, title, message, ok_button_text, cancel_button_text, ok_callback, cancel_callback, style) {
    var id = random_string();
    initModalDialog(id, parent, style);
    
    var modal = document.getElementById(id);
    modal.style.width = "100%;";
    modal.style.height = "100%;";
    modal.style.marginTop = "15%";
    
    if(style && style.marginTop)modal.style.marginTop = style.marginTop;
    
    var title_div = document.getElementById(id + "_title");
    var message_div = document.getElementById(id + "_body");
    
    if (style && style.bodycolor) message_div.style.backgroundColor = style.bodycolor;
    var footer_div = document.getElementById(id + "_footer");
    
    
    var title_color = style && style.top &&  style.top.color ? style.top.color : mColor.WHITE;
    var title_tag = "<text style='text-align:center;font-size:18px;color:"+title_color+";font-weight:700;line-height:80px'>"+title+"</text>";
    title_div.innerHTML = title_tag;
    message_div.innerHTML = message;
    
    if(style && style.button_ispositionchange){
        createButton(footer_div, ok_button_text, false,ok_callback,style);
        if (cancel_button_text)
            createButton(footer_div, cancel_button_text, true, cancel_callback,style);
        
    }else{
        if (cancel_button_text)
            createButton(footer_div, cancel_button_text, true, cancel_callback,style);
        createButton(footer_div, ok_button_text, false,ok_callback,style);
    }
    
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });
    
}
function showModalDialog3Button(parent,title,message,ok_button_text,cancel_button_text,other_button_text,ok_callback,cancel_callback,other_callback,style){
    var id = random_string();
    initModalDialog(id, parent, style);
    var modal = document.getElementById(id);
     modal.style.width = "100%;";
    modal.style.height = "100%;";
    modal.style.marginTop = "30%";
    
    if(style && style.marginTop)modal.style.marginTop = style.marginTop;
    
    if(style && style.width)modal.style.width = style.width;
    if(style && style.height)modal.style.height = style.height;
    var title_div = document.getElementById(id+"_title");
    var message_div = document.getElementById(id+"_body");
//    if(style && style.bodycolor)message_div.style.backgroundColor=style.bodycolor;
    var footer_div = document.getElementById(id+"_footer"); 
    
    var title_color = style && style.top &&  style.top.color ? style.top.color : mColor.WHITE;
    var title_tag = "<text style='text-align:center;font-size:18px;color:"+title_color+";font-weight:700;line-height:80px;'>"+title+"</text>";
    title_div.innerHTML = title_tag;
    var message_tag = "<text style='text-align:center;font-size:15px;color:"+mColor.C919191+";line-height:1.4;'>"+message+"</text>";
    message_div.innerHTML = message_tag;
    
    
    if (other_button_text)
        createButtonSmall(footer_div, other_button_text,false, other_callback);
    if (cancel_button_text)
        createButtonSmall(footer_div, cancel_button_text,true, cancel_callback);
    createButtonSmall(footer_div, ok_button_text,false, ok_callback);
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });

}
//PT 가입할때만 필요하다.
function showModalDialogPTJoin(parent, title, message, message_file, ok_button_text, cancel_button_text, ok_callback, cancel_callback, style,other_button_text,other_callback) {
    var id = random_string();
    initModalDialog(id, parent, style);
    var modal = document.getElementById(id);
    modal.style.width = "100%;";
    modal.style.height = "100%;";
    modal.style.marginTop = "30%";
    
    var modal_content = document.getElementById("modal_content_"+id);
    var screen_width = $(window).width();      
    if(screen_width > 1000){
        var modal_margin_left = (screen_width-stringGetOnlyNumber(modal_content.style.maxWidth))/2-50;
        modal.style.marginLeft = parseInt(modal_margin_left)+"px";
    }
    if(style && style.marginTop)modal.style.marginTop = style.marginTop;
    
    var title_div = document.getElementById(id + "_title");
    var message_div = document.getElementById(id + "_body");
    
    if (style && style.bodycolor) message_div.style.backgroundColor = style.bodycolor;
    var footer_div = document.getElementById(id + "_footer");
    
    var title_color = style && style.top &&  style.top.color ? style.top.color : mColor.WHITE;
    var title_tag = "<text style='text-align:center;font-size:18px;color:"+title_color+";font-weight:700;line-height:80px;'>"+title+"</text>";
    title_div.innerHTML = title_tag;
    //message_div.innerHTML = message;
     if($("#"+id+"_body"))
        $("#"+id+"_body").load(message_file, function() {
            
            $("#"+id+"_body").prepend(message);
            
//            var signtd1 = document.getElementById("signtd1");
//            var signtd2 = document.getElementById("signtd2");
//            var sign_devide1 = document.getElementById("sign_devide1");
//            var sign_devide2 = document.getElementById("sign_devide2");
//
//            var signtd1_width = signtd1.offsetWidth;
//            var signtd1_height = signtd1.offsetHeight;
//            sign_devide1.style.marginLeft = signtd1_width/3;
//            sign_devide2.style.marginLeft = signtd1_width/3*2;
//            
//            canvasName1.width = signtd1_width;
//            canvasSign1.width = signtd1_width;
//            canvasName1.height = signtd1_height;
//            canvasSign1.height = signtd1_height;
            
            clog("1111");
        });
    if (other_button_text)
        createButton(footer_div, other_button_text,false, other_callback,style);
    if (cancel_button_text)
        createButton(footer_div, cancel_button_text,true, cancel_callback,style);
    createButton(footer_div, ok_button_text,false, ok_callback,style);
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });
}
//잔여횟수 소진할때
function showModalDialogPTRemoveCount(parent, title, message, message_file, ok_button_text, cancel_button_text, ok_callback, cancel_callback, style) {
    var id = random_string();
    initModalDialog(id, parent, style);
    var modal = document.getElementById(id);
    modal.style.width = "80%;";
    modal.style.height = "80%;";
    var title_div = document.getElementById(id + "_title");
    var message_div = document.getElementById(id + "_body");
    
    if (style && style.bodycolor) message_div.style.backgroundColor = style.bodycolor;
    var footer_div = document.getElementById(id + "_footer");
    
    var title_tag = "<text style='text-align:center;font-size:18px;color:"+mColor.WHITE+";font-weight:700;line-height:80px;'>"+title+"</text>";
    title_div.innerHTML = title_tag;
    //message_div.innerHTML = message;
     if($("#"+id+"_body"))
        $("#"+id+"_body").load(message_file, function() {
             $("#"+id+"_body").prepend(message);
            canvasName1.width = $('#signpad1').width();
            canvasSign1.width = $('#signpad1').width();
            
        });
    
    if (cancel_button_text)
        createButton(footer_div, cancel_button_text,true, cancel_callback,style);
    createButton(footer_div, ok_button_text,false, ok_callback,style);
    $("#" + id).modal({
        keyboard: false,
        backdrop: 'static'
    });
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
//        modal.style.width = "100%";
//        modal.align="center";
        parent.appendChild(modal);
        
        var modal_class = document.createElement("div");
        modal_class.className = "modal-dialog";
        modal_class.style.width="100%";
        modal_class.align="center";
        
        modal.appendChild(modal_class);
//        modal.style.overflowY = "auto"; //모달 2개 띄우면 스크롤이 안되느 버그 수정되나 2중 스크롤바가 생성됨 그래서 사용안함
        var modal_content = document.createElement("div");
        
        modal_content.className = "modal-content";
        modal_content.style.borderRadius = "10px";
        modal_content.style.backgroundColor = style && style.bodycolor ? style.bodycolor : mColor.C111111;
        modal_content.id = "modal_content_"+id;
//        modal.style.overflowY = "hidden";
//        modal_content.style.overflowY = "hidden";
        
        modal_class.appendChild(modal_content);
        
        if (style && style.size) {
            clog("width aaa ",style.size.width);
//            modal_class.style.width = style.size.width;
            modal_class.style.height = style.size.height;
            modal_content.style.width = style.size.width;
            if(style.size.maxWidth)modal_content.style.maxWidth = style.size.maxWidth;
            modal_content.style.height = style.size.height;
            
            
            /////////////////////////////////////////////////////////
            // 모달 크기 늘리기
            ///////////////////////////////////////////////////////// 
            if(style && style.modaltype && style.modaltype == "large"){
                modal_class.style.float= "left";
                var screen_width = $(window).width();      
                var ispx = style.size.width.indexOf("px") >= 0 ? true : false;
                var wnum = parseInt(style.size.width);
                var now_paddingleft = screen_width/10; //100% , 80%  /2 = 10% =screen_width/10
                var now_width = now_paddingleft*8; //100% , 80%  /2 = 10% =screen_width/10
                var nowgab = now_width-wnum;
                var new_width = parseInt(style.size.width);

                if(!ispx){
                    var onepercent = screen_width/100;
                    new_width = onepercent*parseInt(style.size.width);

                }
                modal_class.style.width = "100%";
                modal_content.style.width = new_width+"px";
                var marginleft = (screen_width-new_width)/2;
                clog("now_paddingleft "+now_paddingleft+" marginleft "+marginleft+" screen_width "+screen_width+" new_width "+new_width);
                modal_content.style.marginLeft = (marginleft)+"px";
            
            }

            /////////////////////////////////////////////////////////
            
        }
        ////////////////////////////////////////////////
        // Top
        ////////////////////////////////////////////////
        var modal_title = document.createElement("div");
        modal_title.id = id + "_title";
        modal_title.style.textAlign = "center";
        modal_title.style.height = "80px";
        if(style && style.top){
            var mytop = style.top;
            if(mytop.color)modal_title.style.color = mytop.color;
            if(mytop.textAlign)modal_title.style.textAlign = mytop.textAlign;
            if(mytop.paddingLeft)modal_title.style.paddingLeft = mytop.paddingLeft;
            if(mytop.paddingRight)modal_title.style.paddingRight = mytop.paddingRight;
            if(mytop.borderBottom)modal_title.style.borderBottom = mytop.borderBottom;
            
        }
        
        
        modal_content.appendChild(modal_title);

        ////////////////////////////////////////////////
        // Main
        ////////////////////////////////////////////////
        var modal_body = document.createElement("div");
//        modal_body.className = "modal-body";
        modal_body.id = id + "_body";
        modal_body.style.textAlign = "center";
        modal_body.style.fontWeight = "300";
        
        modal_content.appendChild(modal_body);

        
        ////////////////////////////////////////////////
        // Bottom
        ////////////////////////////////////////////////
        var modal_footer = document.createElement("div");
        
        modal_footer.id = id + "_footer";
        modal_footer.style.width = "100%";
        modal_footer.style.height = "80px";
        modal_footer.align = "center";
        
        if(style && style.bottom){
             var mybottom = style.bottom;
             if(mybottom.textAlign)modal_footer.style.textAlign = mybottom.textAlign;
             if(mybottom.paddingLeft)modal_footer.style.paddingLeft = mybottom.paddingLeft;
             if(mybottom.paddingRight)modal_footer.style.paddingRight = mybottom.paddingRight;
             if(mybottom.borderTop)modal_footer.style.borderTop = mybottom.borderTop;
        }
        if (style && style.button_type && style.button_type == "vertical" ) {
            modal_footer.style.height = "110px";
            modal_footer.style.position = "fixed";
            modal_footer.style.bottom = "0px";
            modal_class.style.height = "97%";
        }
        
        modal_content.appendChild(modal_footer);
        
        
        
    }
}

function hideModalDialog() {
    var id = modal_ids.pop();
    
    if (id != null) {
        document.getElementById(id + "_title").innerHTML = "";
        document.getElementById(id + "_body").innerHTML = "";
        document.getElementById(id + "_footer").innerHTML = "";
        $("#" + id).modal("hide").data('bs.modal', null);

        //모달 2개 띄우면 스크롤이 안되는 버그 수정
        $("#" + id).on("hidden.bs.modal", function (e) { //fire on closing modal box
            if ($('.modal:visible').length) { // check whether parent modal is opend after child modal close
                $('body').addClass('modal-open'); // if open mean length is 1 then add a bootstrap css class to body of the page
            }
        });
    }
}
//1개 , 2개 짜리 버튼
function createButton(parent, button_text,isdark,  click_callback,style) { //이부분 수정해야함
    var btn = document.createElement("BUTTON");
    btn.innerHTML = button_text;
    btn.style.background = "#fffd00";
    if(style && style.button_bgcolor)btn.style.background = style.button_bgcolor;
    
    if(isdark){
        btn.style.background = "#333333";
        btn.style.color = "white";
        if(style && style.button_dark_bg) btn.style.background = style.button_dark_bg;
        if(style && style.button_dark_text_color) btn.style.color = style.button_dark_text_color;
        if(style && style.button_dark_text_decoration)btn.style.textDecoration = style.button_dark_text_decoration;
        
        
    }
    btn.style.width = "40%"; 
    if(style && style.button_color)btn.style.color = style.button_color;
    if(style && style.button_width)btn.style.width = style.button_width;
    if(style && style.button_height)btn.style.height = style.button_height;
    
    if(style && style.button_text_decoration)btn.style.textDecoration = style.button_text_decoration;
    btn.style.textAlign = "center";
    btn.style.fontSize = "15px";
    btn.style.fontFamily = "font-family: 'Montserrat Alternates', sans-serif;"
    
    //위아래 버튼이라면 
    if(style && style.button_type && style.button_type == "vertical")
        btn.style.marginBottom = "20px";
    else 
        btn.style.marginTop = "20px";
    
    btn.style.marginLeft = "10px";
    btn.style.marginRight = "10px";
    btn.style.fontWeight = "bold";
    btn.className = "btn btn-default fmont";
    btn.onclick = click_callback;
    parent.appendChild(btn);
}
//1개 , 2개 짜리 버튼
function createButtonSmall(parent, button_text,isdark,  click_callback) { //이부분 수정해야함
    var btn = document.createElement("BUTTON");
    btn.innerHTML = button_text;
    btn.style.background = "#fffd00";
    if(isdark){
        btn.style.background = "#333333";
         btn.style.color = "white";
    }
    btn.style.width = "30%";
    btn.style.textAlign = "center";
    btn.style.fontSize = "13px";
    btn.style.fontFamily = "font-family: 'Montserrat Alternates', sans-serif;"
    btn.style.marginTop = "20px";
    btn.style.marginLeft = "5px";
    btn.style.marginRight = "5px";
    btn.style.fontWeight = "bold";
    btn.className = "btn btn-default fmont";
    btn.onclick = click_callback;
    parent.appendChild(btn);
}

function refresh_page(params) {
    if (params) {

        location.href = window.location.href.split("?")[0] + params;
    } else
        location.href = window.location.href;
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

////배열 중복제거
function trim_array(objs){
   return Array.from(new Set(objs));
}
//1차원배열에서 특정변수를 중복값 제거한 후 리턴
function trim_sort_1array(objs,key){
//    var arr = [];
//    for(var i =0 ;i < objs.length; i++){
//        arr.push(objs[i][key]);
//    }
    
    
    
//    var set = new Set(objs);
//    return Array.from(set);
    
    return objs;
}
////2차원배열에서 특정변수를 중복값 제거한 후 리턴
//function trim_sort_2array(objs,key){
//    var arr = [];
//    for(var i =0 ;i < objs.length; i++){
//        arr.push(objs[i][key]);
//    }
//    var set = new Set(objs);
//    return Array.from(set);
//    
//    
//    return objs;
//}
//2차원배열에서 특정변수를 중복값 제거한 후 리턴
function trim_sort_2array(objs,key){
    var arr = [];
    for(var i =0 ;i < objs.length; i++){
        var issame = false;
        for(var j = 0; j < arr.length;j++){
            if(arr[j][key] == objs[i][key]){
                issame = true;                
            }
        }
        if(!issame)
            arr.push(objs[i]);
    }
//    var set = new Set(objs);
//    return Array.from(set);
//    
    
    return arr;
}
//function trim_teacher_userinfosXXX(datas,myuid){
//    var newdatas = [];
//    clog("datas ",datas);
//    for(var i = 0 ; i < datas.length; i++){
//        var data = datas[i];
//       
//        var d_freecount = data.freecount ? parseInt(data.freecount) : 0;
//
//        var isin = false;
//        
//        for(var c = 0 ; c < newdatas.length; c++){
//            if(data.uid == newdatas[c].uid){
//                var b_freecount = newdatas[c].freecount ? parseInt(newdatas[c].freecount) : 0;
//                //같은 고객 PT 횟수가 2회남았다면 같은고객 다음 PT 예약건도 보여준다.
//                var b_max = parseInt(newdatas[c].mbsmaxcount)+parseInt(b_freecount);
//                var b_usecount = parseInt(newdatas[c].usecount);
//                var b_remaincount = b_max-b_usecount;
//                if(b_remaincount > 2)
//                    isin = true;
//                break;
//            }
//        }
////        clog("data ",data);
//        var d_max = parseInt(data.mbsmaxcount)+parseInt(d_freecount);
//        var d_usecount = parseInt(data.usecount);
//        var d_remaincount = d_max-d_usecount;
//        var ismyuser = data.managerid == myuid  ? true : false; //내회원인지 체크 , 담당자 변경했으면 내 회원이 아니다.
//        var isdelete = data.isdelete && data.isdelete == "D" ? true : false; // 삭제된 회원인지 체크 , 
//        
//        if(!isin && d_remaincount > 0 && ismyuser && !isdelete){
//            newdatas.push(data);
//        }
//            
//    }
//    clog("newdatas ",newdatas);
//    return newdatas;
//}
function trim_teacher_userinfos(mem_teacher_alldata,datas,myuid){

    var newdatas = {};
   
    var cnt = 0;
    var uids = [];
	
    for(var i = 0 ; i < datas.length; i++){
        var user = [];
        var data = datas[i];
        var d_freecount = data.freecount ? parseInt(data.freecount) : 0;
        var d_max = getMbsMaxCount(data)+parseInt(d_freecount);
        var d_usecount = parseInt(data.usecount);
        var status_req_cnt = getTeacherReservationStatusCount(data.couponid,10,mem_teacher_alldata); //트레이너가 요청만한상태 10
        var d_remaincount = d_max-d_usecount-status_req_cnt;
        var ismyuser = data.managerid == myuid  ? true : false; //내회원인지 체크 , 담당자 변경했으면 내 회원이 아니다.
        var isdelete = data.isdelete && data.isdelete == "D" ? true : false; // 삭제된 회원인지 체크 , 
        var ismax = parseInt(data.usecount) >= getMbsMaxCount(data) ? true : false; 
		var isfreeuserend = isFreeUserEnd(data);
		if(isfreeuserend)continue;
			
		
        if(d_remaincount > 0 && ismyuser && !isdelete && !ismax){
			//console.log("aaa "+data.id);
            if(!newdatas[data.uid]){
                uids.push(data.uid);
                newdatas[data.uid] = [];
            }
            newdatas[data.uid].push(data);
//            clog("newdatas[data.uid] ",newdatas[data.uid]);
            
        }
    }
    //console.log("newdatas ",newdatas);
    //같은 유저 쿠폰이 2개이상일때는 날짜가 빠른 회원권을 보여준다.
    var newuserdatas = [];
    for(var i = 0 ; i < uids.length;i++){
        var newuser = null;
//        clog("i "+i);
       
        if(newdatas[uids[i]].length == 1){
            newuser = newdatas[uids[i]][0];
        }else{
            newuser = newdatas[uids[i]][0];
            
            //if(newuser.name == "정진원")clog("정진원 user ",newdatas[uids[i]]);
            for(var j = 1 ; j < newdatas[uids[i]].length;j++){
                var couponid = newdatas[uids[i]][j].id;
                var starttime = newdatas[uids[i]][j].starttime;
                var endtime = newdatas[uids[i]][j].endtime;
                
                if(compare_date(newuser.endtime,endtime) == 1 ){
                    newuser = newdatas[uids[i]][j];
                }
            }                            
        } 
        newuserdatas.push(newuser);
    }
//    clog("새로운 유저들 ",newuserdatas);
    return newuserdatas;
    
}
//무료PT회원이면서 기간이 지났다면
function isFreeUserEnd(coupon){
	var flg = false;
	var isfree = checkFreePT(parseInt(coupon.mbsprice),coupon.mbsname);
	var isend = isNowTimeMinOver(coupon.endtime);
	
	if(isfree && isend < 0)
		flg = true;
	
	
	return flg;
}

function isNowTimeMinOver(d1){
    
    var now = new Date();
    var now_timestamp = now.getTime();
    if(getDevice() == 'iphone'){
        if (typeof d1 === 'string'){
            d1 = d1.replace("T", " ");
            var arr = d1.split(/[- :]/);
            var min = arr[4] ? arr[4] : "00";
            var sec = arr[5] ? arr[5] : "00";
            var date1 = new Date(arr[0], arr[1]-1, arr[2], arr[3], min, sec);
            var date1_timestamp = date1.getTime();
            
        }else{
           if(d1){
                var date1 = new Date(d1);
                var y = d1.getFullYear();
                var date1 = d1;
                var date1_timestamp = d1.getTime();
            }
        }
        
    }else {
        var date1 = new Date(d1);
        var date1_timestamp = date1.getTime();
    }
    
    if(now_timestamp > date1_timestamp)
        return -1;
    else if(now_timestamp < date1_timestamp)
        return 1;
    else 
        return 0;
}
function compare_date(date1, date2) {
    if (!date1 || !date2) {
        return 0;
    }
//    
//    var date = new Date();
//    
//    var date1 = new Date(date1);
//    var date1_timestamp = date1.getTime();
//    var date2 = new Date(date2);
//    var date2_timestamp = date2.getTime();
//    
//    if (date1_timestamp < date2_timestamp) {
////        clog("date1 이 작다");
//        return -1;
//    } else if (date1_timestamp > date2_timestamp) {
////        clog("date1 이 크다");
//        return 1;
//    } else {
////        clog("같다");
//        return 0;
//    }
    
    var time1 = changeDateToTimeStamp(date1);
    var time2 = changeDateToTimeStamp(date2);
    if(time1 < time2)
        return -1;
    else if(time1 > time2)
        return 1;
    else 
        return 0;
}
function spaceRemove(data){
    if(!data)
        return "";
    else
        return  data.replace(/ /gi,'');
}


function getParam(sname) {
    var params = location.search.substr(location.search.indexOf("?") + 1);
    var sval = "";
    params = params.split("&");
    for (var i = 0; i < params.length; i++) {
        temp = params[i].split("=");
        if ([temp[0]] == sname) {
            sval = temp[1];
        }
    }
    return sval;
}

function loadSetGroupValue(key, select_group) {
    var value = getData(key);
    var rvalue = null;
    if (value) {
        for (var i = 0; i < select_group.children.length; i++) {
            if (select_group.children[i].value == parseInt(value)) {
                select_group.selectedIndex = i;
                rvalue = value;
                break;
            }
        }
    }
    try{
        if(defaultUserCheck)defaultUserCheck();    
    }catch(e){
        
    }
    
    return rvalue;

}


//////////////////////////////////////////////////////////
// 라커 관련
//////////////////////////////////////////////////////////

//오늘날짜 비교하여 날짜가 지났는지 안지났는지 아니면 시작하지 않았는지  현재사용중 1 : 이미 지남 0 : 아직 시작전 : 2
function C_DateOverCheck(starttime, endtime) {
    if (!starttime || !endtime) {
        return 0;
    }
    clog("starttime " + starttime + " endtime " + endtime);
    var date = new Date();
    var now_timestamp = date.getTime();
    var start = new Date(starttime);
    var start_timestamp = start.getTime();
    var end = new Date(endtime);
    var end_timestamp = end.getTime();
    clog("now_timestamp " + now_timestamp + " start_timestamp " + start_timestamp + " end_timestamp " + end_timestamp);
    if (now_timestamp > start_timestamp && now_timestamp < end_timestamp) {
        clog("현재 운동중인 쿠폰");
        return 1;
    } else if (now_timestamp < start_timestamp) {
        clog("운동 시작할 예정인 쿠폰");
        return 2;
    } else {
        clog("운동끝난 쿠폰");
        return 0;
    }
}
function getDateToStrDisplay(yy,_mm,_dd,h,_m,s){
   
    var m = _mm+"";
    var d = _dd+"";
    
    
    var mm = m.length < 2 ? "0"+m:m;
    var dd = d.length < 2 ? "0"+d:d;
    
    var hh = "";
    var mmm = "";
    var ss = "";
    
    if(!h)
        hh = "00";
    else 
        hh = h.length < 2 ? "0"+h:h;
    
    if(!_m)
        mmm = "00";
    else 
        mmm = m.length < 2 ? "0"+_m:_m;
    
    if(!s)
        ss = "00";
    else 
        ss = s.length < 2 ? "0"+s:s;
    
    if(getDevice() == "iphone"){
        var _hh = ""+hh;
        if(parseInt(hh) < 10)
             _hh = "0"+parseInt(hh);
        return yy+"-"+mm+"-"+dd+"T"+_hh+":"+mmm+":"+ss;
    }         
    else 
        return yy+"-"+mm+"-"+dd+" "+hh+":"+mmm+":"+ss;
//    new Date(yy,mm,dd,hh,mmm,ss).toISOString();
}
function getDateToStr(yy,_mm,_dd,h,_m,s){
   
    var m = _mm+"";
    var d = _dd+"";
    
    
    var mm = m.length < 2 ? "0"+m:m;
    var dd = d.length < 2 ? "0"+d:d;
    
    var hh = "";
    var mmm = "";
    var ss = "";
    
    if(!h)
        hh = "00";
    else 
        hh = h.length < 2 ? "0"+h:h;
    
    if(!_m)
        mmm = "00";
    else 
        mmm = m.length < 2 ? "0"+_m:_m;
    
    if(!s)
        ss = "00";
    else 
        ss = s.length < 2 ? "0"+s:s;
    
    if(getDevice() == "iphone"){
        var _hh = ""+hh;
        if(parseInt(hh) < 10)
            _hh = "0"+parseInt(hh);
        return yy+"-"+mm+"-"+dd+"T"+_hh+":"+mmm+":"+ss;
    }         
    else 
        return yy+"-"+mm+"-"+dd+" "+hh+":"+mmm+":"+ss;
//    new Date(yy,mm,dd,hh,mmm,ss).toISOString();
}
//function getYMDH(yy,_mm,_dd,h){
//   
//    var m = _mm+"";
//    var d = _dd+"";
//    
//    
//    var mm = m.length < 2 ? "0"+m:m;
//    var dd = d.length < 2 ? "0"+d:d;
//    
//    var hh = "";
//    var mmm = "";
//    var ss = "";
//    
//    if(!h)
//        hh = "00";
//    else 
//        hh = h.length < 2 ? "0"+h:h;
//    
// 
//    return yy+"-"+mm+"-"+dd+" "+hh+":00:00";
////    new Date(yy,mm,dd,hh,mmm,ss).toISOString();
//}
//function new Date(time){
//    
//    if(getDevice() == "iphone"){
//        if(time){
//            
//           return new Date(time+"+09:00");
//        }else {
//            var d = new Date();
//            return new Date(d.getTime()+"+09:00");
//        }
//        
//    }        
//    else {
//        if(time){
//            clog("time is ",time);
//            return new Date(time);
//        }else {
//            return new Date();
//        }
//        
//    }
//        
//}
//function newDate2(y,m){
//    var time = getDateToStr(y,m);
//    if(getDevice() == "iphone"){
//        return time ? new Date(time+"+09:00") : new Date("+09:00");
//    }        
//    else {
//        return time ? new Date(time):new Date();
//    }
//        
//}
//function new Date(y,m,d){
//    var time = getDateToStr(y,m,d);
//    if(getDevice() == "iphone"){
//        if(time){
//           return new Date(time+"+09:00");
//        }else {
//            var d = new Date();
//            return new Date(d.getTime()+"+09:00");
//        }
//        
//    }          
//    else {
//        return time ? new Date(time):new Date();
//    }
//        
//}
//function newDate4(y,m,d,h){
//    var time = getDateToStr(y,m,d);
//    if(getDevice() == "iphone"){
//        return time ? new Date(time+"+09:00") : new Date("+09:00");
//    }        
//    else {
//        return time ? new Date(time):new Date();
//    }
//        
//}
//function new Date(y,m,d,h,mm){
//     var time = getDateToStr(y,m,d,h,mm);
//   if(getDevice() == "iphone"){
//        if(time){
//           return new Date(time+"+09:00");
//        }else {
//            var d = new Date();
//            return new Date(d.getTime()+"+09:00");
//        }
//        
//    }         
//    else {
//        return time ? new Date(time):new Date();
//    }
//        
//}


//아이폰때문에 사용하지 않음
//function stringGetYear(str){
//    var now = new Date(str);
//    return now.getFullYear();
//}
//function stringGetMonth(str){
//    var now = new Date(str);
//    var month = now.getMonth() + 1;
//    if (month < 10) month = "0" + month;
//    return month;
//}
//function stringGetDay(str){
//    var now = new Date(str);
//    var day = now.getDate();
//    if (day < 10) day = "0" + day;
//    return day;
//}

//function stringGetHour(str){
    
//    var now = new Date(str);
//    var hour = now.getHours();
//    return hour;
    
//    return parseInt(str.substr(11,2));
//}
function getTodayHour(){
    var now = new Date();
    return now.getHours();
}
function getToday(mdate) {
    
    if(!mdate)
        var now = new Date();
    else 
        var now = mdate;
    
    
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    if (month < 10) month = "0" + month;
    var day = now.getDate();
    if (day < 10) day = "0" + day;
    var today = year + "-" + month + "-" + day;
    
    return today;
}
function get_Day(start, end) {
//    if(getDevice() == "iphone"){
//        if(start && start.length <= 10)start+="T00:00:00Z";
//        if(end && end.length <= 10)end+="T00:00:00Z";             
////        clog("get_Day start ",start);
////        clog("get_Day end ",end);
//    }
//    else {
////         clog("get_Day start ",start);
////        clog("get_Day end ",end);
//        if(start && start.length <= 10)start+=" 00:00:00";
//        if(end && end.length <= 10)end+=" 00:00:00";    
//    }
    if(start.length > 10)start = start.substr(0,10);
    if(end.length > 10)end = end.substr(0,10);
//    clog(" start ",start);
//    clog("end ",end);
    var start_date = new Date(start);
    var end_date = new Date(end);
//    clog("start time "+start_date.getTime()+" endtime "+end_date.getTime());
    var gap = start_date.getTime() - end_date.getTime();
    var dday = Math.floor(gap / (1000 * 60 * 60 * 24)) * -1;
//    clog("dday is ",dday);
    return dday;
}
function getDay(start, end) {

    if (start.length <= 10) start += " 00:00:00";
    if (end.length <= 10) end += " 00:00:00";
    var start_date = new Date(start);
    var end_date = new Date(end);
    var gap = start_date.getTime() - end_date.getTime();
    var dday = Math.floor(gap / (1000 * 60 * 60 * 24)) * -1;
    return dday;
}
//only string type : end  ex)2023-02-04
function getDDay(end) {
//    var today = new Date();
//    return get_Day(getToday(), end);
    
    var str_today = getToday();
    var str_end = end.substr(0,10);
    
    var today_timestamp = new Date(str_today).getTime();
    var end_timestamp = new Date(str_end).getTime();
    var gabday = parseInt((end_timestamp - today_timestamp)/86400/1000);
//    console.log("gabday "+gabday);
    return gabday;
}

//현재날짜 현재시간이 지났는지 체크한다.
function isNowTimeOver(mday){
    var today = getToday();
    var todayhour = getTodayHour();

    var checkday = getToday(new Date(mday));
    var checkhour = stringGetHour(mday);

    var rflg = -1;  //이전시간이다.
    if(get_Day(today, checkday) == 0 && todayhour == checkhour) rflg = 0; //현재시간과 같다.
    else if(get_Day(today, checkday) > 0 || get_Day(today, checkday) == 0 && todayhour < checkhour)rflg = 1; // 이후시간
    
//    alertMsg("today "+today+" "+todayhour+"checkday "+checkday+" "+checkhour+" get_Day "+get_Day(today, checkday)+" todayhour "+todayhour+" checkhour"+checkhour+" rflg "+rflg);
    return rflg;
}

function dateFormat(date) {
        if(!date)date = new Date();
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let hour = date.getHours();
        let minute = date.getMinutes();
        let second = date.getSeconds();

        month = month >= 10 ? month : '0' + month;
        day = day >= 10 ? day : '0' + day;
        hour = hour >= 10 ? hour : '0' + hour;
        minute = minute >= 10 ? minute : '0' + minute;
        second = second >= 10 ? second : '0' + second;

        return date.getFullYear() + '-' + month + '-' + day + ' ' + hour + ':' + minute + ':' + second;
}
function getDateFullFormat(strdate){
	var date = new Date(strdate);
        let year = date.getFullYear();
        let month = date.getMonth() + 1;
        let day = date.getDate();
        let hour = date.getHours();
        let minute = date.getMinutes();
        let second = date.getSeconds();

        month = month >= 10 ? month : '0' + month;
        day = day >= 10 ? day : '0' + day;
        hour = hour >= 10 ? hour : '0' + hour;
        minute = minute >= 10 ? minute : '0' + minute;
        second = second >= 10 ? second : '0' + second;
		var ampm = hour > 12 ? "오후" : "오전";
		return month+"월"+day+"일"+" "+ampm+" "+hour+"시 "+minute+"분("+year+")";
}
function nextYear(date,num) {    
    // ex) 2019-12-10 
    var d = getDevice() == 'iphone' ? getIOSDate(date) : new Date(date);
    d.setFullYear(d.getFullYear() + num);
//    clog("d getdate ",d.getFullYear());
    return getToday(d);
}
function nextMonth(date,num) {    
    // ex) 2019-12-10 
    var d = getDevice() == 'iphone' ? getIOSDate(date) : new Date(date);
    d.setMinutes(d.getMinutes()-1);
    d.setDate(d.getDate() -1);
    d.setMonth(d.getMonth() + num);
//    clog("today "+today+" num "+num);
//     clog("d getFullYear ",d.getFullYear());
//    clog("d m ",d.getMonth());
//    clog("d d ",d.getDate());
//    clog("d h ",d.getHours());
//    clog("d m ",d.getMilliseconds());
//    clog("d s ",d.getSeconds());
    
    return getToday(d);
}
//format yyyy-mm-dd
function nextDay(date,num) {    
    // ex) 2019-12-10 
    var d = getDevice() == 'iphone' ? getIOSDate(date) : new Date(date);
    d.setDate(d.getDate() + num);
//    clog("d getdate ",d.getDate());
    return getToday(d);
}
//format yyyy-mm-dd
function nextHour(date,num) {    
    // ex) 2019-12-10 
    var d = getDevice() == 'iphone' ? getIOSDate(date) : new Date(date);
    d.setHours(d.getHours() + num);
//    clog("d getdate ",d.getDate());
    return d;
}
//format yyyy-mm-dd
function nextMin(date,num) {    
    // ex) 2019-12-10 
    var d = getDevice() == 'iphone' ? getIOSDate(date) : new Date(date);
        
    d.setMinutes(d.getMinutes() + num);
//    clog(date+" nextMin "+d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+d.getHours()+":"+d.getMinutes()+":00");
    return d;
}
function getIOSDate(datestr){
//    datestr = datestr.replace("T"," ");
    if(typeof datestr == "string"){
        var arr = datestr.split(/[- :]/);
        var len = arr.length;
        var d = null;
        if(len < 4)
             d = new Date(arr[0], arr[1]-1, arr[2]);
        else if(len < 5)
             d = new Date(arr[0], arr[1]-1, arr[2], arr[3]);
        else 
             d = new Date(arr[0], arr[1]-1, arr[2], arr[3], arr[4], arr[5]);
        return d;    
    }else {
        var d = datestr;
        
    }
    return d;    
    
}



function getAllLocker(my_centercode,callback){
    var _data = {
        "type": "alllocker", // group or center or auth
        "mbs_centercode": my_centercode,
       
    };
    CallHandler("getdata", _data, function (res) {
        code = parseInt(res.code);
        clog("setMembership res is ", res);
        if (code == 100) {

            if(callback)callback(res.message);
        } else {
            alertMsg(res.message);
            if(callback)callback("error");
        }

    }, function (err) {
        alertMsg("네트워크 에러 ");
        if(callback)callback("error");

    });
}


var alllocker = null;
function showLocker(my_centercode,gender,callback) {
    var _data = {
        "type": "locker", // group or center or auth
        "mbs_centercode": my_centercode,
        "gender" : gender
    };
    CallHandler("getdata", _data, function (res) {
        code = parseInt(res.code);
        clog("setMembership res is ", res);
        if (code == 100) {

            alllocker = JSON.parse(res.message);
            showLockerPopup(alllocker,callback);
            if(callback)callback("success");
        } else {
            alertMsg(res.message);
            if(callback)callback("error");
        }

    }, function (err) {
        alertMsg("네트워크 에러 ");
        if(callback)callback("error");

    });
}
var max_hwidth = 0;
function showLockerPopup(locker,callback) {
    
    
    //default width : 1340;
    max_hwidth = 0;
    var main_bg_div  = document.createElement("div");
    var locker_div = document.createElement("div");
    locker_div.style.marginTop = "20px";
    locker_div.style.backgroundColor = "#1d1d1e";
    locker_div.style.borderRadius = "10px";
    main_bg_div.append(locker_div);
    clog("lockerdata ",locker);
    for (var i = 0; i < locker.length; i++) {
        clog("locker is ", locker[i]);

        var title_div = document.createElement("div");
        var body_div = document.createElement("div");
        
        var gender_type = [{"gender":"M","color":"#5a5aff99"},{"gender":"F","color":"#ff5a5a99"},{"gender":"U","color":"#e9e9e999"}];
        var gtype = gender_type[2];
        for(var j = 0 ; j < gender_type.length; j++){
            if(locker[i].gender && locker[i].gender == gender_type[j].gender){
                gtype = gender_type[j];
                break;
            }
        }
//        body_div.style.backgroundColor = gtype.color;
//        clog("locker[i].gender "+locker[i].gender);
        title_div.innerHTML = "<div style='padding:10px'><div style='background-image:url(./img/bg_locker_titlebar.png);width:100%;height:50px;border:0px;background-size:100% 100%'>"+get_gender_icontag(locker[i].gender)+"&nbsp;&nbsp<text class='fmont' style='font-size:14px;color:white;line-height:50px;margin-top:20px'>" + locker[i].id + "</text></div></div>";
        

        var lockertable = insert_lockertable(locker[i].data);
        lockertable.style.margin = "auto";
        lockertable.style.textAlign = "center";
         body_div.appendChild(lockertable);

        locker_div.appendChild(title_div);
        locker_div.appendChild(body_div);
        locker_div.appendChild(document.createElement("br"));
    }
    
    //모든 라커 크기를 zoom으로 한다.
    var screen_width = $(window).width();
    var locker_tables = locker_div.getElementsByClassName("locker_tables");
    if(screen_width < max_hwidth){     
        var zoom = screen_width/(max_hwidth+150);
        
        for (var i = 0; i < locker_tables.length; i++) {
            locker_tables[i].style.zoom = zoom;
        }
        
    }
    //            clog("locker_div.innerHTML " + locker_div.innerHTML);
//    var style = {
//        bodycolor: "#bbbbbb",
//        size: {
//            width: "95%",
//            height: "100%"
//        }
//    };
    
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
    var monthprice  = alllocker && alllocker.length > 0 ? parseInt(alllocker[0].monthprice) : 10000;
    
    var header="<label  style='font-size:20px;color:#262930;font-weight:700;'>라커현황</label><button onclick='hideModalDialog();closeLockerDiv();' class='btn' style='padding-top:15px;background-color:#00000000;float:right;margin:10px;cursor:pointer;'><img src='./img/button_x_gray.png' style='width:20px;height:20px;opacity:0.5'></button>";
    var top_div = 
        "<div style='padding:20px'>"+
            "<div align='left' style='width:100%;height:48px;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding-left:20px;padding-right:20px;'>"+
                "<span><label style='color:#181c32;font-weight:700; text-align:left;margin-top:13px;'>※ 라커 선택 :</label>&nbsp;&nbsp;"+
                "<svg style='width:13px;height:13px'><rect width='13' height='13' rx='3' ry='3' style='fill:#4a4a4b'></rect></svg>&nbsp;<label style='color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>사용가능</label>&nbsp;&nbsp;"+
                "<svg style='width:13px;height:13px'><rect width='13' height='13' rx='3' ry='3' style='fill:#ffd481'></rect></svg>&nbsp;<label style='color:#181c32;font-weight:500; text-align:left;margin-top:13px;'>사용중</label></span>"+
                "<span style='float:right'><label style='color:#181c32;font-weight:700; text-align:left;margin-top:13px;'>월 ￦"+CommaString(monthprice)+"</label>"+
            "</div>"+
        "<div>";
    showModalDialog(document.body, header , top_div+main_bg_div.innerHTML, "닫기", null, function () {
        hideModalDialog();
        closeLockerDiv();
    }, function () {}, style);
}
function closeLockerDiv(){
    if(document.getElementById("use_locker"))document.getElementById("use_locker").value = 0;
    if(document.getElementById("locker_info"))document.getElementById("locker_info").style.display = "none";
    if(document.getElementById("locker_number"))document.getElementById("locker_number").style.display = "none";
    if(document.getElementById("locker_pass"))document.getElementById("locker_pass").style.display = "none";
    
}
function insert_lockertable(rows) {
    //             document.getElementById("table_div").style.display = "block";
    clog("rows ", rows);
    var table = document.createElement("table");
    table.innerHTML = "<thead></thead><tfoot></tfoot><tbody></tbody>";
    table.className = "locker_tables";
    
//    var zoom = 100;
//    var screen_width = $(window).width();
//    var calendar_width = 1600;
//    zoom = (screen_width/calendar_width)*0.95;
//    if(zoom > 1)zoom = 1;
    
    
//    table.style.zoom = zoom;
//    var loc_w = 70*zoom;
//    var loc_h = 84*zoom;
//    var fontsize = parseInt(16*zoom);
//    clog("zoom "+zoom+" locw "+loc_w+" loch "+loc_h);
    
    var body = table.getElementsByTagName("tbody")[0];

    var len = rows.length;
    if (len > 0) {
        for (var i = 0; i < len; i++) {
            var brow = body.insertRow();
//            body.style.backgroundColor = "#f9f9a9";
            var hcnt = 0;
            for (var key in rows[i]) {
//                clog("key " + key + " rows[i]" + rows[i]);
//                clog(" rows[i]", rows[i]);
                hcnt++;

                var button_tag = "";
                
                if (rows[i][key].name) {
                    
//                    var isover = C_DateOverCheck(rows[i][key].starttime, rows[i][key].endtime); 
                    var dday = getDDay(rows[i][key].endtime);
                    
                    var color = "#4a4a4a"; //비어있음 rows[i][key].endtime && dday > 15 ? "#4a4a4a" : "#ffd481";  //비어있음 , 차있음 사용중
                    var fontcolor = "white";
                    var desc_fontcolor = "#ffd481";
                    
                    if(dday){                        
                        if(dday > 15){
                            color = "#ffd481"; //기간임박
                            fontcolor = "#1d1d1e";
                            desc_fontcolor = "1d1d1e";
                        }
                            
                        else if(dday >=0 && dday <= 15){
                            color = "#57292f"; //기간임박
                            fontcolor = "white";
                            desc_fontcolor = "#ffd481";
                        }
                            
                        else if(dday < 0){
                            color = "#c4404f"; //기간 지남  
                            fontcolor = "white";
                            desc_fontcolor = "#ffd481";
                        } 
                    }
                    //날짜 + 표시
                    var issub = dday > 0 ? "" : "+";
                    //하단 설명
                    var desc_tag = !dday && rows[i][key].desc ? "<text style='font-size:12px;color:"+desc_fontcolor+";font-weight:600'>"+rows[i][key].desc+"</text>" : ""; //차있는라커설명은 보이지 않음
//                    var desc_tag = rows[i][key].desc ? "<text style='font-size:12px;color:"+desc_fontcolor+";font-weight:600'>"+rows[i][key].desc+"</text>" : ""; //모든라커설명이 보여짐
                    
                    clog("rows[i][key].desc "+rows[i][key].desc);
                    //차있을때 dday 비었을때 자물쇠
                    var center_tag = rows[i][key].endtime ? "<label style='font-size:14px;color:"+fontcolor+";font-weight:600;'>"+issub+""+(-dday) + "일</label>" : "<img src ='./img/lock_open18.png' style='width:16px;height:16px;margin-top:5px'>";
                    
//                    if(!rows[i][key].endtime && rows[i][key].desc)end = empty_desc_tag;
                    clog("rows[i][key] ",rows[i][key]);
                    button_tag = 
                        "<div align='center' onclick='locker_click(\"" + rows[i][key].name + "\","+dday+")' style='border:0px;width:70px;height:84px;background-color:" + color + "; box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.25);border-radius:5px;float:right;margin:2px;cursor:pointer;'>"+                        
                            "<text style='position:absolute;font-size:13px;color:"+fontcolor+";font-weight:600;float:left;margin-left:-27px;margin-top:3px'>" + rows[i][key].name + "</text>"+
                            "<div align='center' style='width:70px;height:84px;position:absolute;margin-top:30px'>"+center_tag +"</div>"+
                            "<div align='center' style='width:70px;height:84px;position:absolute;margin-top:60px'>"+desc_tag +"</div>"+
                        "</div>";

                } else
                    button_tag = "";
                var bcell = brow.insertCell();
                bcell.innerHTML = button_tag;

            }
//            clog("hcnt is "+hcnt);
            if(76*hcnt > max_hwidth ){
                max_hwidth = 76*hcnt;
                
            }
        }
    }
    
    return table;
}
function locker_click(id,dday){

    
    var id_locker_number = document.getElementById("id_locker_number");
    var id_locker_pass = document.getElementById("id_locker_pass");
    var obj = search_locker(id);
//            clog("obj is ",obj);
    if(dday && dday >= 0){
        alertMsg(id+"번은 이미 사용중인 라커입니다.<br>고객번호 : "+obj.useid+"<br>기간 : "+obj.starttime.substr(0,10)+" ~ "+obj.endtime.substr(0,10));
        return;
    }else if(dday && dday < 0){
        showModalDialog(document.body, "경고!", id+"번 라커가 비어있지 않습니다.<br>그래도 해당 라커를 사용하시겠습니까?","사용하기", "취소", function() {
            ///////////////////////////////////////////////////////
            //라커 사용하기
            ///////////////////////////////////////////////////////
            if(id_locker_number)id_locker_number.innerHTML = obj.name;
            if(id_locker_pass){
                id_locker_pass.value = obj.pass;
                //if(obj.pass == "" && obj.desc && !isNaN(obj.desc))id_locker_pass.value = obj.desc; //숫자일때만 비번입력
                if(obj.pass == "" && obj.desc)id_locker_pass.value = obj.desc.replace(/[^0-9]/g,''); //숫자만추출하여 비번입력


            }
            if(checkAllPrice)checkAllPrice();
            hideModalDialog();    hideModalDialog();    
            ///////////////////////////////////////////////////////
            //라커 사용하기
            ///////////////////////////////////////////////////////
        }, function() {
            hideModalDialog();
        });   
    }
    else{
        ///////////////////////////////////////////////////////
        //라커 사용하기
        ///////////////////////////////////////////////////////
        if(id_locker_number)id_locker_number.innerHTML = obj.name;
        if(id_locker_pass){
            id_locker_pass.value = obj.pass;
            //if(obj.pass == "" && obj.desc && !isNaN(obj.desc))id_locker_pass.value = obj.desc; //숫자일때만 비번입력
            if(obj.pass == "" && obj.desc)id_locker_pass.value = obj.desc.replace(/[^0-9]/g,''); //숫자만추출하여 비번입력
            

        }
        if(checkAllPrice)checkAllPrice();
        hideModalDialog();    
        ///////////////////////////////////////////////////////
        //라커 사용하기
        ///////////////////////////////////////////////////////
        
    }
}
function search_locker(id){
    var locker = alllocker;
    var rdata = null;
    for(var i = 0 ; i < locker.length;i++){
        for(var j = 0 ; j < locker[i].data.length;j++){
            for(var k = 0 ; k < locker[i].data[j].length; k++){
//                        clog("id "+id+"  locker[i].data[j][k].name "+locker[i].data[j][k].name);
                if(id == locker[i].data[j][k].name){
                    rdata = locker[i].data[j][k];
//                    clog("locker[i].data[j] ",locker[i].data[j][k]);
                    break;
                }
            }
        }   
    }
    return rdata;
}
function initInputSelectYMD(pyear,pmonth,pday){
    var now = new Date();
    var year = now.getFullYear();
    pyear.innerHTML = "<option>년도</option>";
    for(var i = 0 ; i < 100; i++){
        var val = year-i;
        pyear.innerHTML += "<option value='"+val+"'>"+val+"년</option>";
    }
    pmonth.innerHTML = "<option>월</option>";
    for(var i = 1 ; i <= 12; i++){
        pmonth.innerHTML += "<option value='"+i+"'>"+i+"월</option>";
    }
    pday.innerHTML = "<option>일</option>";
    for(var i = 1 ; i <= 31; i++){
        pday.innerHTML += "<option value='"+i+"'>"+i+"일</option>";
    }
}
function saveDataGroupCenter(gcode, cname, ccode) {
        saveData("nowgroupcode", gcode);
        saveData("nowcentername", cname);
        saveData("nowcentercode", ccode);

    }

function initToastDiv() {
    clog("document is ", document.body);
    document.body.innerHTML += "<div style='position: absolute; width: 100%; top:0; left:0; z-index:9999999999;' aria-live='polite' aria-atomic='true' style='position: relative; min-height: 200px;'><div id= 'toastarea' style='position: absolute; top: 100px; right: 20px;'></div></div>";
}
function C_showToast( title, message, callback, _delay) {
    var id = random_string();
    var mytoastarea = document.getElementById("toastarea");
    var delay = 3000;
    if (_delay) delay = _delay;

    if(mytoastarea){
        mytoastarea.innerHTML += " <div id='" + id + "' class=toast role='alert' aria-live='assertive' aria-atomic='true'><div class='toast-header' style='background-color:#33333388;color:white;font-size:16px'>" + title + "</div><div class='toast-body' style='background-color:#88877788;color:white;font-size:20px'>" + message + "</div></div>";
        $("#" + id).toast({
            "delay": delay
        });
        $("#" + id).toast("show");
        $("#" + id).on('hidden.bs.toast', function () {
    //        clog("===================");
    //        clog(id + "  toastarea ", this.id);

            $("#" + id).remove();
            if(callback)callback();
    //        clog("len is " + $('#toastarea').children('div').length);
        });
    }
}
function sortListIntType(list, direction) {
//        var direction = sortList.direction = sortList.direction ? false : true;
        var arr = [],
            c = list.children, l = c.length, i;
        for(i=0; i<l; i++) arr[i] = c[i]; // "convert" NodeList to array
        arr.sort(function(a,b) {return parseInt(a.id) < parseInt(b.id) ? -1 : 1;}); //sorting function ends here.
        if( direction) arr = arr.reverse();
        for(i=0; i<l; i++) list.appendChild(arr[i]);
    };


var yholiday = [["_1_1 ","신정"],["_3_1 ","삼일절"],["_5_5 ","어린이날"],["_6_6 ","현충일"],["_8_15 ","광복절"],["_10_3 ","개천절"],["_10_9 ","한글날"],["_12_25 ","크리스마스"]];
var uholiday = [["2000_2_4 ","설날"],["2000_2_5 ","설날"],["2000_2_6 ","설날연휴"],["2000_5_11 ","부처님오신날"],["2000_9_11 ","추석연휴"],["2000_9_12 ","추석"],["2000_9_13 ","추석연휴"],["2001_1_23 ","설날연휴"],["2001_1_24 ","설날"],["2001_1_25 ","설날연휴"],["2001_5_1 ","부처님오신날"],["2001_9_30 ","추석연휴"],["2001_10_1 ","추석"],["2001_10_2 ","추석연휴"],["2002_2_11 ","설날연휴"],["2002_2_12 ","설날"],["2002_2_13 ","설날연휴"],["2002_5_19 ","부처님오신날"],["2002_9_20 ","추석연휴"],["2002_9_21 ","추석"],["2002_9_22 ","추석연휴"],["2003_1_31 ","설날연휴"],["2003_2_1 ","설날"],["2003_2_2 ","설날연휴"],["2003_5_8 ","부처님오신날"],["2003_9_10 ","추석연휴"],["2003_9_11 ","추석"],["2003_9_12 ","추석연휴"],["2004_1_21 ","설날연휴"],["2004_1_22 ","설날"],["2004_1_23 ","설날연휴"],["2004_5_26 ","부처님오신날"],["2004_9_27 ","추석연휴"],["2004_9_28 ","추석"],["2004_9_29 ","추석연휴"],["2005_2_8 ","설날연휴"],["2005_2_9 ","설날"],["2005_2_10 ","설날연휴"],["2005_5_15 ","부처님오신날"],["2005_9_17 ","추석연휴"],["2005_9_18 ","추석"],["2005_9_19 ","추석연휴"],["2006_1_28 ","설날연휴"],["2006_1_29 ","설날"],["2006_1_30 ","설날연휴"],["2006_5_5 ","어린이날_부처님오신날"],["2006_10_5 ","추석연휴"],["2006_10_6 ","추석"],["2006_10_7 ","추석연휴"],["2007_2_17 ","설날연휴"],["2007_2_18 ","설날"],["2007_2_19 ","설날연휴"],["2007_5_24 ","부처님오신날"],["2007_9_24 ","추석연휴"],["2007_9_25 ","추석"],["2007_9_26 ","추석연휴"],["2008_2_6 ","설날연휴"],["2008_2_7 ","설날"],["2008_2_8 ","설날연휴"],["2008_5_12 ","부처님오신날"],["2008_9_13 ","추석연휴"],["2008_9_14 ","추석"],["2008_9_15 ","추석연휴"],["2009_1_25 ","설날연휴"],["2009_1_26 ","설날"],["2009_1_27 ","설날연휴"],["2009_5_2 ","부처님오신날"],["2009_10_2 ","추석연휴"],["2009_10_3 ","추석_개천절"],["2009_10_4 ","추석연휴"],["2010_2_13 ","설날연휴"],["2010_2_14 ","설날"],["2010_2_15 ","설날연휴"],["2010_5_21 ","부처님오신날"],["2010_9_21 ","추석연휴"],["2010_9_22 ","추석"],["2010_9_23 ","추석연휴"],["2011_2_2 ","설날연휴"],["2011_2_3 ","설날"],["2011_2_4 ","설날연휴"],["2011_5_10 ","부처님오신날"],["2011_9_11 ","추석연휴"],["2011_9_12 ","추석"],["2011_9_13 ","추석연휴"],["2012_1_22 ","설날연휴"],["2012_1_23 ","설날"],["2012_1_24 ","설날연휴"],["2012_5_28 ","부처님오신날"],["2012_9_29 ","추석연휴"],["2012_9_30 ","추석"],["2012_10_1 ","추석연휴"],["2013_2_9 ","설날연휴"],["2013_2_10 ","설날"],["2013_2_11 ","설날연휴"],["2013_5_17 ","부처님오신날"],["2013_9_18 ","추석연휴"],["2013_9_19 ","추석"],["2013_9_20 ","추석연휴"],["2014_1_30 ","설날연휴"],["2014_1_31 ","설날"],["2014_2_1 ","설날연휴"],["2014_5_6 ","부처님오신날"],["2014_9_7 ","추석연휴"],["2014_9_8 ","추석"],["2014_9_9 ","추석연휴"],["2015_2_18 ","설날연휴"],["2015_2_19 ","설날"],["2015_2_20 ","설날연휴"],["2015_5_25 ","부처님오신날"],["2015_9_26 ","추석연휴"],["2015_9_27 ","추석"],["2015_9_28 ","추석연휴"],["2016_2_7 ","설날연휴"],["2016_2_8 ","설날"],["2016_2_9 ","설날연휴"],["2016_5_14 ","부처님오신날"],["2016_9_14 ","추석연휴"],["2016_9_15 ","추석"],["2016_9_16 ","추석연휴"],["2017_1_27 ","설날연휴"],["2017_1_28 ","설날"],["2017_1_29 ","설날연휴"],["2017_5_3 ","부처님오신날"],["2017_10_3 ","추석_개천절"],["2017_10_4 ","추석"],["2017_10_5 ","추석연휴"],["2018_2_15 ","설날연휴"],["2018_2_16 ","설날"],["2018_2_17 ","설날연휴"],["2018_5_22 ","부처님오신날"],["2018_9_23 ","추석연휴"],["2018_9_24 ","추석"],["2018_9_25 ","추석연휴"],["2019_2_4 ","설날연휴"],["2019_2_5 ","설날"],["2019_2_6 ","설날연휴"],["2019_5_12 ","부처님오신날"],["2019_9_12 ","추석연휴"],["2019_9_13 ","추석"],["2019_9_14 ","추석연휴"],["2020_1_24 ","설날연휴"],["2020_1_25 ","설날"],["2020_1_26 ","설날연휴"],["2020_4_30 ","부처님오신날"],["2020_9_30 ","추석연휴"],["2020_10_1 ","추석"],["2020_10_2 ","추석연휴"],["2021_2_11 ","설날연휴"],["2021_2_12 ","설날"],["2021_2_13 ","설날연휴"],["2021_5_19 ","부처님오신날"],["2021_9_20 ","추석연휴"],["2021_9_21 ","추석"],["2021_9_22 ","추석연휴"],["2022_1_31 ","설날연휴"],["2022_2_1 ","설날"],["2022_2_2 ","설날연휴"],["2022_5_8 ","부처님오신날"],["2022_6_1 ","지방선거"],["2022_9_9 ","추석연휴"],["2022_9_10 ","추석"],["2022_9_11 ","추석연휴"],["2023_1_21 ","설날연휴"],["2023_1_22 ","설날"],["2023_1_23 ","설날연휴"],["2023_1_24 ", "설날연휴(대체공휴일)"],["2023_5_27 ","부처님오신날"],["2023_5_29 ","대체공휴일"],["2023_9_28 ","추석연휴"],["2023_9_29 ","추석"],["2023_9_30 ","추석연휴"],["2024_2_9 ","설날연휴"],["2024_2_10 ","설날"],["2024_2_11 ","설날연휴"],["2024_5_15 ","부처님오신날"],["2024_9_16 ","추석연휴"],["2024_9_17 ","추석"],["2024_9_18 ","추석연휴"],["2025_1_28 ","설날연휴"],["2025_1_29 ","설날"],["2025_1_30 ","설날연휴"],["2025_5_5 ","어린이날_부처님오신날"],["2025_10_5 ","추석연휴"],["2025_10_6 ","추석"],["2025_10_7 ","추석연휴"],["2026_2_16 ","설날연휴"],["2026_2_17 ","설날"],["2026_2_18 ","설날연휴"],["2026_5_24 ","부처님오신날"],["2026_9_24 ","추석연휴"],["2026_9_25 ","추석"],["2026_9_26 ","추석연휴"],["2027_2_6 ","설날연휴"],["2027_2_7 ","설날"],["2027_2_8 ","설날연휴"],["2027_5_13 ","부처님오신날"],["2027_9_14 ","추석연휴"],["2027_9_15 ","추석"],["2027_9_16 ","추석연휴"],["2028_1_26 ","설날연휴"],["2028_1_27 ","설날"],["2028_1_28 ","설날연휴"],["2028_5_2 ","부처님오신날"],["2028_10_2 ","추석연휴"],["2028_10_3 ","추석_개천절"],["2028_10_4 ","추석연휴"],["2029_2_12 ","설날연휴"],["2029_2_13 ","설날"],["2029_2_14 ","설날연휴"],["2029_5_20 ","부처님오신날"],["2029_9_21 ","추석연휴"],["2029_9_22 ","추석"],["2029_9_23 ","추석연휴"],["2030_2_2 ","설날연휴"],["2030_2_3 ","설날"],["2030_2_4 ","설날연휴"],["2030_5_9 ","부처님오신날"],["2030_9_11 ","추석연휴"],["2030_9_12 ","추석"],["2030_9_13 ","추석연휴"],["2031_1_22 ","설날연휴"],["2031_1_23 ","설날"],["2031_1_24 ","설날연휴"],["2031_5_28 ","부처님오신날"],["2031_9_30 ","추석연휴"],["2031_10_1 ","추석"],["2031_10_2 ","추석연휴"],["2032_2_10 ","설날연휴"],["2032_2_11 ","설날"],["2032_2_12 ","설날연휴"],["2032_5_16 ","부처님오신날"],["2032_9_18 ","추석연휴"],["2032_9_19 ","추석"],["2032_9_20 ","추석연휴"],["2033_1_30 ","설날연휴"],["2033_1_31 ","설날"],["2033_2_1 ","설날연휴"],["2033_5_6 ","부처님오신날"],["2033_10_6 ","추석연휴"],["2033_10_7 ","추석"],["2033_10_8 ","추석연휴"],["2034_2_18 ","설날연휴"],["2034_2_19 ","설날"],["2034_2_20 ","설날연휴"],["2034_5_25 ","부처님오신날"],["2034_9_26 ","추석연휴"],["2034_9_27 ","추석"],["2034_9_28 ","추석연휴"],["2035_2_7 ","설날연휴"],["2035_2_8 ","설날"],["2035_2_9 ","설날연휴"],["2035_5_15 ","부처님오신날"],["2035_9_15 ","추석연휴"],["2035_9_16 ","추석"],["2035_9_17 ","추석연휴"],["2036_1_27 ","설날연휴"],["2036_1_28 ","설날"],["2036_1_29 ","설날연휴"],["2036_5_3 ","부처님오신날"],["2036_10_3 ","추석_개천절"],["2036_10_4 ","추석"],["2036_10_5 ","추석연휴"],["2037_2_14 ","설날연휴"],["2037_2_15 ","설날"],["2037_2_16 ","설날연휴"],["2037_5_22 ","부처님오신날"],["2037_9_23 ","추석연휴"],["2037_9_24 ","추석"],["2037_9_25 ","추석연휴"],["2038_2_3 ","설날연휴"],["2038_2_4 ","설날"],["2038_2_5 ","설날연휴"],["2038_5_11 ","부처님오신날"],["2038_9_12 ","추석연휴"],["2038_9_13 ","추석"],["2038_9_14 ","추석연휴"],["2039_1_23 ","설날연휴"],["2039_1_24 ","설날"],["2039_1_25 ","설날연휴"],["2039_4_30 ","부처님오신날"],["2039_10_1 ","추석연휴"],["2039_10_2 ","추석"],["2039_10_3 ","추석_개천절"],["2040_2_11 ","설날연휴"],["2040_2_12 ","설날"],["2040_2_13 ","설날연휴"],["2040_5_18 ","부처님오신날"],["2040_9_20 ","추석연휴"],["2040_9_21 ","추석"],["2040_9_22 ","추석연휴"],["2041_1_31 ","설날연휴"],["2041_2_1 ","설날"],["2041_2_2 ","설날연휴"],["2041_5_7 ","부처님오신날"],["2041_9_9 ","추석연휴"],["2041_9_10 ","추석"],["2041_9_11 ","추석연휴"],["2042_1_21 ","설날연휴"],["2042_1_22 ","설날"],["2042_1_23 ","설날연휴"],["2042_5_26 ","부처님오신날"],["2042_9_27 ","추석연휴"],["2042_9_28 ","추석"],["2042_9_29 ","추석연휴"],["2043_2_9 ","설날연휴"],["2043_2_10 ","설날"],["2043_2_11 ","설날연휴"],["2043_5_16 ","부처님오신날"],["2043_9_16 ","추석연휴"],["2043_9_17 ","추석"],["2043_9_18 ","추석연휴"],["2044_1_29 ","설날연휴"],["2044_1_30 ","설날"],["2044_1_31 ","설날연휴"],["2044_5_5 ","어린이날_부처님오신날"],["2044_10_4 ","추석연휴"],["2044_10_5 ","추석"],["2044_10_6 ","추석연휴"],["2045_2_16 ","설날연휴"],["2045_2_17 ","설날"],["2045_2_18 ","설날연휴"],["2045_5_24 ","부처님오신날"],["2045_9_24 ","추석연휴"],["2045_9_25 ","추석"],["2045_9_26 ","추석연휴"],["2046_2_5 ","설날연휴"],["2046_2_6 ","설날"],["2046_2_7 ","설날연휴"],["2046_5_13 ","부처님오신날"],["2046_9_14 ","추석연휴"],["2046_9_15 ","추석"],["2046_9_16 ","추석연휴"],["2047_1_25 ","설날연휴"],["2047_1_26 ","설날"],["2047_1_27 ","설날연휴"],["2047_5_2 ","부처님오신날"],["2047_10_4 ","추석"],["2047_10_5 ","추석연휴"],["2048_2_13 ","설날연휴"],["2048_2_14 ","설날"],["2048_2_15 ","설날연휴"],["2048_5_20 ","부처님오신날"],["2048_9_21 ","추석연휴"],["2048_9_22 ","추석"],["2048_9_23 ","추석연휴"],["2049_2_1 ","설날연휴"],["2049_2_2 ","설날"],["2049_2_3 ","설날연휴"],["2049_5_9 ","부처님오신날"],["2049_9_10 ","추석연휴"],["2049_9_11 ","추석"],["2049_9_12 ","추석연휴"],["2050_1_22 ","설날연휴"],["2050_1_23 ","설날"],["2050_1_24 ","설날연휴"],["2050_5_28 ","부처님오신날"],["2050_9_29 ","추석연휴"],["2050_9_30 ","추석"],["2050_10_1 ","추석연휴"],["2051_2_10 ","설날연휴"],["2051_2_11 ","설날"],["2051_2_12 ","설날연휴"],["2051_5_17 ","부처님오신날"],["2051_9_18 ","추석연휴"],["2051_9_19 ","추석"],["2051_9_20 ","추석연휴"],["2052_1_31 ","설날연휴"],["2052_2_1 ","설날"],["2052_2_2 ","설날연휴"],["2052_5_6 ","부처님오신날"],["2052_9_6 ","추석연휴"],["2052_9_7 ","추석"],["2052_9_8 ","추석연휴"],["2053_2_18 ","설날연휴"],["2053_2_19 ","설날"],["2053_2_20 ","설날연휴"],["2053_5_25 ","부처님오신날"],["2053_9_25 ","추석연휴"],["2053_9_26 ","추석"],["2053_9_27 ","추석연휴"],["2054_2_7 ","설날연휴"],["2054_2_8 ","설날"],["2054_2_9 ","설날연휴"],["2054_5_15 ","부처님오신날"],["2054_9_15 ","추석연휴"],["2054_9_16 ","추석"],["2054_9_17 ","추석연휴"],["2055_1_27 ","설날연휴"],["2055_1_28 ","설날"],["2055_1_29 ","설날연휴"],["2055_5_4 ","부처님오신날"],["2055_10_4 ","추석연휴"],["2055_10_5 ","추석"],["2055_10_6 ","추석연휴"],["2056_2_14 ","설날연휴"],["2056_2_15 ","설날"],["2056_2_16 ","설날연휴"],["2056_5_22 ","부처님오신날"],["2056_9_23 ","추석연휴"],["2056_9_24 ","추석"],["2056_9_25 ","추석연휴"],["2057_2_3 ","설날연휴"],["2057_2_4 ","설날"],["2057_2_5 ","설날연휴"],["2057_5_11 ","부처님오신날"],["2057_9_12 ","추석연휴"],["2057_9_13 ","추석"],["2057_9_14 ","추석연휴"],["2058_1_23 ","설날연휴"],["2058_1_24 ","설날"],["2058_1_25 ","설날연휴"],["2058_4_30 ","부처님오신날"],["2058_10_1 ","추석연휴"],["2058_10_2 ","추석"],["2058_10_3 ","추석_개천절"],["2059_2_11 ","설날연휴"],["2059_2_12 ","설날"],["2059_2_13 ","설날연휴"],["2059_5_19 ","부처님오신날"],["2059_9_20 ","추석연휴"],["2059_9_21 ","추석"],["2059_9_22 ","추석연휴"],["2060_2_1 ","설날연휴"],["2060_2_2 ","설날"],["2060_2_3 ","설날연휴"],["2060_5_7 ","부처님오신날"],["2060_9_8 ","추석연휴"],["2060_9_9 ","추석"],["2060_9_10 ","추석연휴"],["2061_1_21 ","설날연휴"],["2061_1_22 ","설날"],["2061_1_23 ","설날연휴"],["2061_5_26 ","부처님오신날"],["2061_9_27 ","추석연휴"],["2061_9_28 ","추석"],["2061_9_29 ","추석연휴"],["2062_2_8 ","설날연휴"],["2062_2_9 ","설날"],["2062_2_10 ","설날연휴"],["2062_5_16 ","부처님오신날"],["2062_9_16 ","추석연휴"],["2062_9_17 ","추석"],["2062_9_18 ","추석연휴"],["2063_1_28 ","설날연휴"],["2063_1_29 ","설날"],["2063_1_30 ","설날연휴"],["2063_5_6 ","부처님오신날"],["2063_10_5 ","추석연휴"],["2063_10_6 ","추석"],["2063_10_7 ","추석연휴"],["2064_2_16 ","설날연휴"],["2064_2_17 ","설날"],["2064_2_18 ","설날연휴"],["2064_5_23 ","부처님오신날"],["2064_9_24 ","추석연휴"],["2064_9_25 ","추석"],["2064_9_26 ","추석연휴"],["2065_2_4 ","설날연휴"],["2065_2_5 ","설날"],["2065_2_6 ","설날연휴"],["2065_5_12 ","부처님오신날"],["2065_9_14 ","추석연휴"],["2065_9_15 ","추석"],["2065_9_16 ","추석연휴"],["2066_1_25 ","설날연휴"],["2066_1_26 ","설날"],["2066_1_27 ","설날연휴"],["2066_5_1 ","부처님오신날"],["2066_10_2 ","추석연휴"],["2066_10_3 ","추석_개천절"],["2066_10_4 ","추석연휴"],["2067_2_13 ","설날연휴"],["2067_2_14 ","설날"],["2067_2_15 ","설날연휴"],["2067_5_20 ","부처님오신날"],["2067_9_22 ","추석연휴"],["2067_9_23 ","추석"],["2067_9_24 ","추석연휴"],["2068_2_2 ","설날연휴"],["2068_2_3 ","설날"],["2068_2_4 ","설날연휴"],["2068_5_9 ","부처님오신날"],["2068_9_10 ","추석연휴"],["2068_9_11 ","추석"],["2068_9_12 ","추석연휴"],["2069_1_22 ","설날연휴"],["2069_1_23 ","설날"],["2069_1_24 ","설날연휴"],["2069_4_28 ","부처님오신날"],["2069_9_28 ","추석연휴"],["2069_9_29 ","추석"],["2069_9_30 ","추석연휴"],["2070_2_10 ","설날연휴"],["2070_2_11 ","설날"],["2070_2_12 ","설날연휴"],["2070_5_17 ","부처님오신날"],["2070_9_18 ","추석연휴"],["2070_9_19 ","추석"],["2070_9_20 ","추석연휴"],["2071_1_30 ","설날연휴"],["2071_1_31 ","설날"],["2071_2_1 ","설날연휴"],["2071_5_7 ","부처님오신날"],["2071_9_7 ","추석연휴"],["2071_9_8 ","추석"],["2071_9_9 ","추석연휴"],["2072_2_18 ","설날연휴"],["2072_2_19 ","설날"],["2072_2_20 ","설날연휴"],["2072_5_25 ","부처님오신날"],["2072_9_25 ","추석연휴"],["2072_9_26 ","추석"],["2072_9_27 ","추석연휴"],["2073_2_6 ","설날연휴"],["2073_2_7 ","설날"],["2073_2_8 ","설날연휴"],["2073_5_14 ","부처님오신날"],["2073_9_15 ","추석연휴"],["2073_9_16 ","추석"],["2073_9_17 ","추석연휴"],["2074_1_26 ","설날연휴"],["2074_1_27 ","설날"],["2074_1_28 ","설날연휴"],["2074_5_3 ","부처님오신날"],["2074_10_4 ","추석연휴"],["2074_10_5 ","추석"],["2074_10_6 ","추석연휴"],["2075_2_14 ","설날연휴"],["2075_2_15 ","설날"],["2075_2_16 ","설날연휴"],["2075_5_22 ","부처님오신날"],["2075_9_23 ","추석연휴"],["2075_9_24 ","추석"],["2075_9_25 ","추석연휴"],["2076_2_4 ","설날연휴"],["2076_2_5 ","설날"],["2076_2_6 ","설날연휴"],["2076_5_10 ","부처님오신날"],["2076_9_11 ","추석연휴"],["2076_9_12 ","추석"],["2076_9_13 ","추석연휴"],["2077_1_23 ","설날연휴"],["2077_1_24 ","설날"],["2077_1_25 ","설날연휴"],["2077_4_30 ","부처님오신날"],["2077_9_30 ","추석연휴"],["2077_10_1 ","추석"],["2077_10_2 ","추석연휴"],["2078_2_11 ","설날연휴"],["2078_2_12 ","설날"],["2078_2_13 ","설날연휴"],["2078_5_19 ","부처님오신날"],["2078_9_19 ","추석연휴"],["2078_9_20 ","추석"],["2078_9_21 ","추석연휴"],["2079_2_1 ","설날연휴"],["2079_2_2 ","설날"],["2079_2_3 ","설날연휴"],["2079_5_8 ","부처님오신날"],["2079_9_9 ","추석연휴"],["2079_9_10 ","추석"],["2079_9_11 ","추석연휴"],["2080_1_21 ","설날연휴"],["2080_1_22 ","설날"],["2080_1_23 ","설날연휴"],["2080_5_26 ","부처님오신날"],["2080_9_27 ","추석연휴"],["2080_9_28 ","추석"],["2080_9_29 ","추석연휴"],["2081_2_8 ","설날연휴"],["2081_2_9 ","설날"],["2081_2_10 ","설날연휴"],["2081_5_16 ","부처님오신날"],["2081_9_16 ","추석연휴"],["2081_9_17 ","추석"],["2081_9_18 ","추석연휴"],["2082_1_28 ","설날연휴"],["2082_1_29 ","설날"],["2082_1_30 ","설날연휴"],["2082_5_5 ","어린이날_부처님오신날"],["2082_10_5 ","추석연휴"],["2082_10_6 ","추석"],["2082_10_7 ","추석연휴"],["2083_2_16 ","설날연휴"],["2083_2_17 ","설날"],["2083_2_18 ","설날연휴"],["2083_5_24 ","부처님오신날"],["2083_9_25 ","추석연휴"],["2083_9_26 ","추석"],["2083_9_27 ","추석연휴"],["2084_2_5 ","설날연휴"],["2084_2_6 ","설날"],["2084_2_7 ","설날연휴"],["2084_5_12 ","부처님오신날"],["2084_9_13 ","추석연휴"],["2084_9_14 ","추석"],["2084_9_15 ","추석연휴"],["2085_1_25 ","설날연휴"],["2085_1_26 ","설날"],["2085_1_27 ","설날연휴"],["2085_5_1 ","부처님오신날"],["2085_10_2 ","추석연휴"],["2085_10_3 ","추석_개천절"],["2085_10_4 ","추석연휴"],["2086_2_13 ","설날연휴"],["2086_2_14 ","설날"],["2086_2_15 ","설날연휴"],["2086_5_20 ","부처님오신날"],["2086_9_21 ","추석연휴"],["2086_9_22 ","추석"],["2086_9_23 ","추석연휴"],["2087_2_2 ","설날연휴"],["2087_2_3 ","설날"],["2087_2_4 ","설날연휴"],["2087_5_10 ","부처님오신날"],["2087_9_10 ","추석연휴"],["2087_9_11 ","추석"],["2087_9_12 ","추석연휴"],["2088_1_23 ","설날연휴"],["2088_1_24 ","설날"],["2088_1_25 ","설날연휴"],["2088_4_28 ","부처님오신날"],["2088_9_28 ","추석연휴"],["2088_9_29 ","추석"],["2088_9_30 ","추석연휴"],["2089_2_10 ","설날연휴"],["2089_2_11 ","설날"],["2089_2_12 ","설날연휴"],["2089_5_17 ","부처님오신날"],["2089_9_18 ","추석연휴"],["2089_9_19 ","추석"],["2089_9_20 ","추석연휴"],["2090_1_29 ","설날연휴"],["2090_1_30 ","설날"],["2090_1_31 ","설날연휴"],["2090_5_7 ","부처님오신날"],["2090_9_7 ","추석연휴"],["2090_9_8 ","추석"],["2090_9_9 ","추석연휴"],["2091_2_17 ","설날연휴"],["2091_2_18 ","설날"],["2091_2_19 ","설날연휴"],["2091_5_25 ","부처님오신날"],["2091_9_26 ","추석연휴"],["2091_9_27 ","추석"],["2091_9_28 ","추석연휴"],["2092_2_6 ","설날연휴"],["2092_2_7 ","설날"],["2092_2_8 ","설날연휴"],["2092_5_13 ","부처님오신날"],["2092_9_15 ","추석연휴"],["2092_9_16 ","추석"],["2092_9_17 ","추석연휴"],["2093_1_26 ","설날연휴"],["2093_1_27 ","설날"],["2093_1_28 ","설날연휴"],["2093_5_3 ","부처님오신날"],["2093_10_4 ","추석연휴"],["2093_10_5 ","추석"],["2093_10_6 ","추석연휴"],["2094_2_14 ","설날연휴"],["2094_2_15 ","설날"],["2094_2_16 ","설날연휴"],["2094_5_21 ","부처님오신날"],["2094_9_23 ","추석연휴"],["2094_9_24 ","추석"],["2094_9_25 ","추석연휴"],["2095_2_4 ","설날연휴"],["2095_2_5 ","설날"],["2095_2_6 ","설날연휴"],["2095_5_11 ","부처님오신날"],["2095_9_12 ","추석연휴"],["2095_9_13 ","추석"],["2095_9_14 ","추석연휴"],["2096_1_24 ","설날연휴"],["2096_1_25 ","설날"],["2096_1_26 ","설날연휴"],["2096_4_30 ","부처님오신날"],["2096_9_30 ","추석연휴"],["2096_10_1 ","추석"],["2096_10_2 ","추석연휴"],["2097_2_11 ","설날연휴"],["2097_2_12 ","설날"],["2097_2_13 ","설날연휴"],["2097_5_19 ","부처님오신날"],["2097_9_19 ","추석연휴"],["2097_9_20 ","추석"],["2097_9_21 ","추석연휴"],["2098_1_31 ","설날연휴"],["2098_2_1 ","설날"],["2098_2_2 ","설날연휴"],["2098_5_8 ","부처님오신날"],["2098_9_9 ","추석연휴"],["2098_9_10 ","추석"],["2098_9_11 ","추석연휴"],["2099_1_20 ","설날연휴"],["2099_1_21 ","설날"],["2099_1_22 ","설날연휴"],["2099_5_27 ","부처님오신날"],["2099_9_28 ","추석연휴"],["2099_9_29 ","추석"],["2099_9_30 ","추석연휴"],["2100_2_8 ","설날연휴"],["2100_2_9 ","설날"],["2100_2_10 ","설날연휴"],["2100_5_16 ","부처님오신날"],["2100_9_17 ","추석연휴"],["2100_9_18 ","추석"],["2100_9_19 ","추석연휴"]];
function holidayCheck(isHidToday,isHideSaturday,txtcolor){
        var allblock = document.getElementsByClassName("calendar-day");
        
        var holidayinterval = setInterval(function(){
            if(allblock.length > 10){
                clearInterval(holidayinterval);
                var dateblock = document.getElementsByClassName("date");
                for(var i = 0 ; i < allblock.length;i++){
//                    clog("allblock ",allblock[i]);
                    var classname = allblock[i].className;

                    var dateblock = allblock[i].querySelector('.date');
                    //allblock[i].style.backgroundColor = classname.indexOf("outside") >=0 ? "#f5f5f5":"white";
                    allblock[i].style.backgroundColor = classname.indexOf("outside") >=0 ? "#00000000":"#00000000";
                    
                    //오늘날짜 네모박스
                    if(classname.indexOf("today") >=0){
//                        allblock[i].style.backgroundColor = "#f7e688";
                            if(!isHidToday){
                                allblock[i].style.border = "1px solid #fffd00";
                                allblock[i].style.backgroundColor = "#fffd0022";
                            }
                        
                    }
                    
                    if(classname.indexOf("sunday") >=0){
                        if(dateblock){
                            dateblock.style.color = classname.indexOf("outside") >=0 ? "#e36969" : "#e36969";
                            dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";   
                        }
                         
                    }else if(classname.indexOf("saturday") >=0){
                        if(dateblock)
                        if(!isHideSaturday)dateblock.style.color = classname.indexOf("outside") >=0 ? "#d7d8fa" : "blue";

                    }else {

//                        dateblock.style.color = classname.indexOf("outside") >=0 ? "#cccccc" : "black";    
                        if(dateblock){
                           if(txtcolor)
                               dateblock.style.color = txtcolor;
                            else 
                               dateblock.style.color = classname.indexOf("outside") >=0 ? "#ffffff" : "#ffffff";    
                            
                            dateblock.style.fontWeight ="normal";
                        }

                    }
                    
                    
                    

                    for(var j = 0 ; j < yholiday.length; j++){
                        if(classname.indexOf(yholiday[j][0]) >= 0){
                            var dateblock = allblock[i].querySelector('.date');
                            if(dateblock){
                                dateblock.style.color = classname.indexOf("outside") >=0 ? "#e36969" : "#e36969";
                                dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                            }
//                                dateblock.innerHTML= dateblock.innerHTML.substr(0,2)+" "+yholiday[j][1];
                            break;
                        }    
                    }
                    for(var j = 0 ; j < uholiday.length; j++){
                        if(classname.indexOf(uholiday[j][0]) >= 0){
                            var dateblock = allblock[i].querySelector('.date');
                            if(dateblock){
                                dateblock.style.color = classname.indexOf("outside") >=0 ? "#e36969" : "#e36969";
                                dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                            }
//                                dateblock.innerHTML =dateblock.innerHTML.substr(0,2)+" "+uholiday[j][1];
                            break;
                        }    
                    }
                    
                }
                
            }
        },10);
        
            
    
    }
    
function findValueinArray(array, key, find_value,couponid){
    var rvalue = null;
    if(array)
    for(var i = 0 ; i < array.length; i ++){
        if(array[i][key] == find_value && array[i]["id"] == couponid){
            rvalue = array[i];
            break;
        }
    }
    return rvalue;
}
function getUsers(json){
    var users = [];
    var myusers = json.myusers;
    var opentype = ["open","close","ready"];
    for(var i = 0 ; i < opentype.length; i++){
        var otype = opentype[i];
        var typeobj = json[otype];
        if(typeobj)
        for(var j =0; j < typeobj.length; j++){
            
            var dates = typeobj[j].dates;
            if(dates)
            for(var k = 0 ; k < dates.length; k++){
                var times = dates[k].times;
                if(times)
                for(var l = 0; l < times.length; l++){
                    var members = times[l].members;
                    if(members)
                    for(var m = 0; m < members.length; m++){
//                        clog("members[m] uid "+members[m].uid);
                        users.push(members[m]);
                    }
                }                                    
            }                            
        }                    
    }
    if(myusers)
    for(var i = 0 ; i < myusers.length; i++){
        var useruid = myusers[i].uid ? myusers[i].uid : null;
        var couponid = myusers[i].uid ? myusers[i].couponid : null;
        var usr = {"uid":useruid,"couponid":couponid};
        if(useruid)users.push(usr);
    }
//    clog("getUsers ",users);
    return trim_sort_1array(users);
}
function getTeacherReservationStatusCount(couponid,status,json){
    var users = [];
    var myusers = json.myusers;
    var opentype = ["open","close","ready"];
    
    var status_count = 0;
    for(var i = 0 ; i < opentype.length; i++){
        var otype = opentype[i];
        var typeobj = json[otype];
        if(typeobj)
        for(var j =0; j < typeobj.length; j++){
            
            var dates = typeobj[j].dates;
            if(dates)
            for(var k = 0 ; k < dates.length; k++){
                var times = dates[k].times;
                if(times)
                for(var l = 0; l < times.length; l++){
                    var members = times[l].members;
                    if(members)
                    for(var m = 0; m < members.length; m++){
                        if(members[m].couponid == couponid && members[m].status == status )
                            status_count++;
                    }
                }                                    
            }                            
        }                    
    }
    
    return status_count;
}
function show_error_popup(title,message,clickurl){
    $("#end_modal").modal({ keyboard: false, backdrop: 'static' });

}


var global_app_datalist = [];
function AndroidCallback(key,value){
    var data = {"key":key, "value":value};
    global_app_datalist.push(data);

}
function IOSCallback(key,value){
    var data = {"key":key, "value":value};
    global_app_datalist.push(data);

}
function CheckAppCallbackData(key){
    var return_data = null;
    for(var i = 0; i < global_app_datalist.length; i++) {
        if(global_app_datalist[i].key == key) {
            return_data = global_app_datalist[i].value;
            global_app_datalist.splice(i, 1);
            break;
        }
    }
    return return_data;
}
function C_AppSaveData(key,value){
    var data = {key:key,value:value};
    C_AppCall("appSaveData",data);
    
}
function C_AppLoadData(key,callback){
    C_AppCall("appLoadData",key,function(res){
        if(res != ""){
            callback(res);                
        }else {
            callback(null);
        }
    });
}
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
 function setDivType(type){
               
            var obj = {};
            
            switch(type){
                case "green":
                    obj.titlebackimg = "linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%)";
                     obj.timefontcolor = "red";
                    obj.fontcolor = "blue";
                    break;
                 case "default":
                    obj.titlebackimg = "linear-gradient(to bottom, #eeee00 0px, #f5f500 100%)";
                    obj.timefontcolor = "red";
                    obj.fontcolor = "blue";
                     break;
                 case "close":
                    obj.titlebackimg = "linear-gradient(to bottom, #774000 0px, #774444 100%)";
                    obj.timefontcolor = "#e9e9e9";
                    obj.fontcolor = "#e9e9e9";   
                     break;
                 case "over":
                    obj.titlebackimg = "linear-gradient(to bottom, #888888 0px, #aaaaaa 100%)";
                    obj.timefontcolor = "#e9e9e9";
                    obj.fontcolor = "#e9e9e9";
                     break;
                 case "tranerfinish": //상태값을 1이다.
                    obj.titlebackimg = "linear-gradient(to bottom, #996799 0px, #aa89aa 100%)";
                    obj.timefontcolor = "#e9e9e9";
                    obj.fontcolor = "#e9e9e9";
                     break;
                 case "userfinish"://상태값을 2이다.
                    obj.titlebackimg = "linear-gradient(to bottom, #e36969 0px, #e38989 100%)";
                    obj.timefontcolor = "#e9e9e9";
                    obj.fontcolor = "#333333";
                     break;
                 case "title":
                    obj.titlebackimg = "linear-gradient(to bottom, #774000 0px, #774444 100%)";
                    obj.timefontcolor = "#e9e9e9";
                    obj.fontcolor = "#e9e9e9";   
                    break;

             }
             return obj;
         }


var now_pageid = -1;
            var now_pagevalue = null;
            function loadMainDiv(id,value,callback){
//                 clog("id "+id+" vaule "+value);
                var path = "";
                
                switch(id){
                    case 0:
                        path = "d_main.php";
                        
                        break;
                    case 1:
                        path = "d_reservation.php";
                        break;
                    case 2:
                        path = "d_insertdoc.php";
                        break;
                    case 3:
                       path = "d_statistics.php";
                        break;
                    case 100:
                        path = "testpage.php";
                        break;
                }
                try{
//                    clog("div_main path : ",path);
                    if($("#div_main"))
                    $("#div_main").load(path, function() {
                       
                        maininit(value);
                        now_pageid = id;
                        now_pagevalue = value;
                        if(callback){
                            callback();
                            if(id == 0){
                                var def = document.getElementById("default_info");
                                if(def)def.style.display="none";
                            }
                        }
                    });    
                }catch(e){
                    clog("error !! ",e);
                    if(callback)callback();
                }
                
            }

function getAdmUserData(groupcode,centercode,_data,success,error){
    
    var data = ""+_data;
//    data = data.replace(/-/gi, '');
    data = data.replace(/ /gi,'');
    
    var type = "phone";
    if(data.length > 15 || data.indexOf("test_uid") >= 0 ){
        type = "uid";
    }
    else if(!isNaN(data) && data.length >= 6 && data.length < 11){
        type = "id";
    }
    else if(isNaN(data) == true) { //숫자인지 체크 : 숫자가 아니면 true 
        type = "name";
    }
    
    clog("type ",type);
    
    
    var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :type,
        value : data
    }
    CallHandler("adm_get", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {if(error)error(err);});
}
function getOwnerTokens(callback){
    var groupcode = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    if(groupcode && centercode){
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"getownertokens",           
        };
        CallHandler("adm_get", senddata, function (res) {
           callback(res);
        }, function (err) { 
            alertMsg(err);
        });
    }    
}
function getUserData(_data,success,error,groupcode,centercode){
    
    var data = ""+_data;
//    data = data.replace(/-/gi, '');
    data = data.replace(/ /gi,'');
    
    var type = "phone";
    if(data.length > 15 || data.indexOf("test_uid") >= 0 ){
        type = "uid";
    }
    else if(!isNaN(data) && data.length >= 6 && data.length < 11){
        type = "id";
    }
    else if(isNaN(data) == true) { //숫자인지 체크 : 숫자가 아니면 true 
        type = "name";
    }
    
    clog("type ",type);
    
    var groupcode = groupcode ? groupcode : getData("nowgroupcode");
    var centercode = centercode ? centercode : getData("nowcentercode");
    
    
    var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :type,
        value : data
    }
    CallHandler("adm_get", senddata, function (res) {
        
       if(success){
           global_user_info = res.message[0];
           success(res);
       }
        
    }, function (err) {if(error)error(err);});
}
//function getUserData(_data,success,error){
//    var data = ""+_data;
//    data = data.replace(/-/gi, '');
//    data = data.replace(/ /gi,'');
//   
//    var type = "search_customer_phone";
//    if(isNaN(data) == true) { //숫자인지 체크 : 숫자가 아니면 true 
//        type = "search_customer_name";
//    } else if(data.length >= 6 && data.length < 11){
//        type = "search_customer_id";
//    }
//    
//    
//    var centercode = getData("nowcentercode");
//    
//    
//    var senddata = {
//           
//        centercode : centercode,
//        type :type,
//        value : data
//    }
//    CallHandler("getdata", senddata, function (res) {
//       if(success)success(res);
//        
//    }, function (err) {if(error)success(res.message);});
//}
function getTeacherListByUid(teachers,uid){
    var teacher = null;
    for(var i = 0 ; i < teachers.length;i++){
        if(teachers[i].mem_uid == uid){
            teacher = teachers[i];
            break;
        }
    }
    return teacher;
}

function isThisMonth(couponid,year,month){
    var coupon_year = stringGetYear(couponid);
    var coupon_month = stringGetMonth(couponid);
    
//    var now = new Date();
//    var year = now.getFullYear();
//    var month = now.getMonth() + 1;
    if(parseInt(coupon_year) == year && parseInt(coupon_month) == month)
        return true;
    else return false;
}
function getCoupons(info,type){
    var used_coupons = [];
    var using_coupons = [];
    var after_coupons = [];

    if(info.mem_membership && info.mem_membership != null && info.mem_membership.length > 0){
        var membership = JSON.parse(info.mem_membership);
        if(membership)
        for(var a = 0 ; a < membership.length; a++){


            var data = membership[a];
//            if(data.mbsusecentercode == parseInt(getData("nowcentercode")))
            {
                var isuse = C_isUsingCoupon(data.starttime,data.endtime);
                if(isuse == 1){
                    using_coupons.push(data);
                }else if(isuse == 2){
                    after_coupons.push(data);
                    using_coupons.push(data); //나중에 사용할 쿠폰도 사용중인 쿠폰으로 등록한다.
                }                    
                else{
                    used_coupons.push(data);    
                } 
                    
            }
        }
    }

    if(info.mem_reservation && info.mem_reservation != null && info.mem_reservation.length > 0){
        
        var reservation = JSON.parse(info.mem_reservation);
        if(reservation)
        for(var a = 0 ; a < reservation.length; a++){
            var data = reservation[a];
//            if(data.mbsusecentercode == parseInt(getData("nowcentercode")))
            {
                var isuse = C_isUsingCoupon(data.starttime,data.endtime);
                if(isuse == 1){
                    using_coupons.push(data);
                }else if(isuse == 2){
                     using_coupons.push(data); //나중에 사용할 쿠폰도 사용중인 쿠폰으로 등록한다.
                    after_coupons.push(data);
                }
                    
                else 
                    used_coupons.push(data);
            }
        }
    }
//    clog("using_coupons : ",using_coupons);
//    clog("used_coupons : ",used_coupons);
//    clog("after_coupons : ",after_coupons);
    
    
    if(type == "using")
        return using_coupons;
    else if(type == "used")
        return used_coupons;
    else if(type == "using_after"){
        for(var i = 0 ; i  < after_coupons.length;i++)
            using_coupons.push(after_coupons[i]);
        return using_coupons;
    }else if(type == "all"){
        for(var i = 0 ; i  < used_coupons.length;i++)
            using_coupons.push(used_coupons[i]);
        for(var i = 0 ; i  < after_coupons.length;i++)
            using_coupons.push(after_coupons[i]);
        
        using_coupons = trim_sort_2array(using_coupons,"id");
        return using_coupons;
    }
    else
        return after_coupons;
}
function C_isUsingCoupon(starttime , endtime){
    
    var date = new Date();
    var now_timestamp = date.getTime();
    var start = new Date(starttime);
    var start_timestamp = start.getTime();
    var end = new Date(endtime);
    var end_timestamp = end.getTime();
//    clog("now_timestamp "+now_timestamp+" start_timestamp "+start_timestamp+" end_timestamp "+end_timestamp);
    if(now_timestamp > start_timestamp && now_timestamp < end_timestamp){
//        clog("1 현재 운동중인 쿠폰");
        return 1;
    }
    else if(now_timestamp < start_timestamp){
//        clog("2 운동 시작할 예정인 쿠폰");
        return 2;
    }
    else{
//        clog("0 운동끝난 쿠폰");
        return 0;  
    } 
}
/*
 * path : 전송 URL
 * params : 전송 데이터 {'q':'a','s':'b','c':'d'...}으로 묶어서 배열 입력
 * method : 전송 방식(생략가능)
 */
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.
    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);
    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }
    document.body.appendChild(form);
    form.submit();
}
function get_reservation_status_text(status){
//    if(status == undefined)return "";
//    var txt= "";
//    switch(parseInt(status)){
//        case 10:      //트레이너가 운동예약한상태 고객 승인전
//            txt= "[운동예약요청] ";
//            break;
//        case 0:     //고객이 예약 승인한 상태
//            txt= "[운동예약승인] ";
//            break;
//        case 1:     //트레이너가 운동종료 버튼 누른 상태
//            txt= "[운동완료신청] ";
//            break;
//        case 2:     //고객이 운동종료 승인한  상태
//            txt= "[운동완료] ";
//            break;
//        case 3:     //고객이 운동예약상태(status = 0)에서 운동취소한상태 잘못 예약했거나 했을때
//            txt= "[고객 예약취소] ";
//            break;
//        case 4:     //트레이너가 삭제함
////            txt= "<text style='color:red;font-weight:bold'>[트레이너 운동삭제]</text>";
//            break;            
//    }
//    return txt;
//    
}
function get_reservation_status_tag(status){
    if(status == undefined)return "";
    var txt= "";
    switch(parseInt(status)){
        case 10:     //트레이너가 운동예약한상태 고객 승인전
            txt= "<text style='font-size:12px;color:#ffa025;font-weight:400'>[예약]&nbsp;</text>";
            break;
        case 0:     //고객이 예약 승인한 상태
            txt= "<text style='font-size:12px;color:#ffa025;font-weight:400'>[고객승인]&nbsp;</text>";
            break;
        case 1:     //트레이너가 운동종료 버튼 누른 상태
            txt= "<text style='font-size:12px;color:#ffa025;font-weight:400'>[운동완료2]&nbsp;</text>";
            break;
        case 2:     //고객이 운동종료 승인한  상태
            txt= "<text style='font-size:12px;color:#ffa025;font-weight:400'>[운동완료]&nbsp;</text>";
            break;
        case 3:     //고객이 운동예약상태(status = 0)에서 운동취소한상태 잘못 예약했거나 했을때
            txt= "<text style='font-size:12px;color:#ffa025;font-weight:400'>[고객취소]&nbsp;</text>";
            break;
        case 4:     //트레이너가 삭제함
//            txt= "<text style='color:red;font-weight:bold'>[트레이너 운동삭제]</text>";
            break;            
    }
    return txt;
    
}
function get_token_user(uid,success){
    var senddata = {           
//        centercode : centercode,
        type :"getusertoken",
        value : uid
    }
    CallHandler("getdata", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {if(error)success(err);});
}
function StringEnterToBR(pushdata){
    var title = pushdata.title ? pushdata.title : null;
    var message = pushdata.message ? pushdata.message : null;
    var titles = pushdata.titles ? pushdata.titles : null;
    var messages = pushdata.messages ? pushdata.messages : null;
    
    if(title && message){
       title = replaceEnterToBR(title);
       message = replaceEnterToBR(message);
       pushdata.title = title;
       pushdata.message = message;
    }else{
        for(var i = 0 ; i < titles.length;i++){
            titles[i] = replaceEnterToBR(titles[i]);
            messages[i] = replaceEnterToBR(messages[i]);
        }
        pushdata.titles = titles;
        pushdata.messages = messages;
    }
    return pushdata;
}
function replaceEnterToBR(msg){
    if(msg && msg.length > 0){
        msg = msg.replaceAll(/(?:\r\n|\r|\n)/g, '<br>');
        msg = msg.replaceAll("\"", "&quot;");           
    }
    return msg;
}
function pushmessage_user(token,title,message,clickaction,success,error) {
    //if(!clickaction) clickaction = ClickAction.SHOW_GOTO_PTGX_RESERVATION;
    if(!clickaction) clickaction = ClickAction.SHOW_NOTICE;
    
    var titles = [];
    titles.push(title);
    var messages = [];
    messages.push(message);
    var tokens = [];
    tokens.push(token);
    
    var pushdata = {
            "titles": titles,
            "messages": messages,
            "tokens": tokens,
            "clickaction": clickaction
    };
   
    CallHandler("push_message", StringEnterToBR(pushdata), function(res) {
        if(success)success(res);
    }, function(err) {
        if(error)error(err);
        
    });
}
function pushmessage_tokens(tokens,title,message,clickaction,success,error) {
    //if(!clickaction) clickaction = ClickAction.SHOW_GOTO_PTGX_RESERVATION;
    if(!clickaction) clickaction = ClickAction.SHOW_NOTICE;
    
    var titles = [];
    titles.push(title);
    var messages = [];
    messages.push(message);
    var pushdata = {
            "titles": titles,
            "messages": messages,
            "tokens": tokens,
            "clickaction": clickaction
    };
   
    CallHandler("push_message", StringEnterToBR(pushdata), function(res) {
        if(success)success(res);
    }, function(err) {
        if(error)error(err);
        
    });
}
function sendPushToOwner(title,message){
    getOwnerTokens(function(res){
        if(res.code == 100){
            var tokens = res.message;
            pushmessage_tokens(tokens,title,message,ClickAction.SHOW_NOTICE,function(){});
        }
    });
}
function number_format(_number)
{
    var number = _number+"";
    number=number.replace(/\,/g,"");
    var nArr = String(number).split('').join(',').split('');
    for( var i=nArr.length-1, j=1; i>=0; i--, j++)  if( j%6 != 0 && j%2 == 0) nArr[i] = '';
    var str = nArr.join('');
//    str = str.replaceAll("-,","-");
    str = str.replace(/-,/g, '-');
    return str;
}
function number_format_to_number(_number){
    var number = _number+"";
//    var number = number.replaceAll(",","");
    var number = number.replace(/,/g, '');
    return number;
}
function stringGetOnlyNumber(str){
//    const str = "Hello_123_World_456_!!!";
    const regex = /[^0-9]/g;
    const result = str.replace(regex, "");
    const number = parseInt(result);
    return number ? number : 0;
}
var global_user_info = null;
var global_now_using_gx_couponid ="";
var loginuid = "";
var loginauth = -1;

function gettag(key,info,showtype){
    
    
    
    
    
    clog("info",info);
    var using_coupons = getCoupons(info,"all"); //all, using, after , user , using_after  중 선택
    var all_coupons = getCoupons(info,"all");
    using_coupons.sort(sort_by('endtime', true, (a) => a.toUpperCase()));    
    using_coupons = sort_coupon_delete_to_last(using_coupons);
    
    
//    clog("aaa using_coupons",using_coupons);
    
    var uid = info.mem_uid;    
    var userid = info.mem_userid;
    var token = info.mem_fcmtoken;
    var trs = "";
    var trs2 = "";
    var arg = setJSONStringToParamString(all_coupons);
   
    var json_arg2 = {"other":info.mem_other,"userid":userid};
    var arg2 = setJSONStringToParamString(json_arg2);
    var len = using_coupons.length;
    var new_lockers = info.mem_newlockers && info.mem_newlockers != "null" ? JSON.parse(info.mem_newlockers) : [];
    var newlocker_len = new_lockers.length;
    var othercoupons = info.mem_othercoupon ? JSON.parse(info.mem_othercoupon) : [];
    var othercoupon_len = othercoupons.length;
    
    
    //clog("emain "+info.mem_email);
    var email = !info.mem_email || info.mem_email == "false" || info.mem_email == "null" ? "" : info.mem_email;
    var birth = !info.mem_birth || info.mem_birth == "false" || info.mem_birth == "null" ? "" : info.mem_birth;
    var address = !info.mem_homeaddress || info.mem_homeaddress == "false" || info.mem_homeaddress == "null" ? "" : info.mem_homeaddress;
    var other = !info.mem_other || info.mem_other == "false" || info.mem_other == "null" ? "" : info.mem_other;
    //이름 ,전화번호
    trs +=  "<tr align='left' height='50px'>"+
                "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "이름"+
                "</td>"+
                "<td style='min-width:140px;font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    info.mem_username+
                "</td>"+
                "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "전화번호"+
                "</td>"+
                "<td style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    "<text class='fmont'>"+info.mem_phone+"</text>"+
                    
                "</td>"+
            "</tr>";

    //회원번호 , 성별
    var mchecked = info.mem_gender == "M" ? "checked" : "";
    var fchecked = info.mem_gender == "F" ? "checked" : "";            
    var uchecked = info.mem_gender == "U" ? "checked" : "";      
    
    trs+="<tr align='left'>"+
             "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                "회원번호"+
            "</td>"+
             "<td class='fmont' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                info.mem_userid+
            "</td>"+
            "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "생년월일"+
                "</td>"+
                "<td class='fmont' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    birth+
                "</td>"+            
        "</tr>";

    //이메일, 생년월일
    trs +=  "<tr align='left'>"+
               "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "이메일"+
                "</td>"+
                 "<td style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    email+
                "</td>"+
                 "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "성별"+
                "</td>"+
                "<td style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    "<div style='margin-top:-5px'>"+
                            "<input type='radio' id='genderm_"+key+"' name='gender_"+key+"' value='남' "+mchecked+" style='margin-top:10px'>남&nbsp;&nbsp;"+
                            "<input type='radio' id='genderf_"+key+"' name='gender_"+key+"' value='여' "+fchecked+">여&nbsp;&nbsp;"+
                            "<input type='radio' id='genderu_"+key+"' name='gender_"+key+"' value='알수없음' "+uchecked+">모름"+
                    "</div>"+
                "</td>"+
            "</tr>";


//    clog("using_coupons ",using_coupons);
    
     var txt_coupons = "없음";
    //len = using_coupons.length
    if(len > 0 ){
        var now_using_coupon = null;
        global_now_using_gx_couponid = "";
        var last_dday = "-";
        var txt_plus = "";
        var txt_startend = "";
        var usecount = "0";
        var gx_mbsmaxcount_tag = "";
        var last_dday = "-";
        now_using_coupon = getNowMembershipCoupon(using_coupons);
        
        var now_using_gxcoupon = getNowMembershipCoupon(using_coupons,TYPE_GX);
        global_now_using_gx_couponid = now_using_gxcoupon ? now_using_gxcoupon.id : "";
        
       //첫번째
        if (!now_using_coupon || isNowCouponMaxUseAndNextCouponUse(uid, now_using_coupon, using_coupons)) {
            now_using_coupon = getNowMembershipNextCoupon(using_coupons);
        }


        
        if (now_using_coupon && !isNowCouponMaxUseAndNextCouponUse(uid, now_using_coupon, using_coupons)) {


            last_dday = now_using_coupon.endtime ? getDDay(getTotalEndtime(now_using_coupon)) : "-";
            console.log("last_dday "+last_dday);
            txt_plus = last_dday != "-" && parseInt(last_dday) < 0 ? "+" : "";

            txt_startend = now_using_coupon.starttime && now_using_coupon.endtime ? "<span style='float:right;margin-top:-6px;color:#333333;font-size:14px;font-family:Montserrat;background-color:#f0f6fa;border-radius:4px;padding:2px 10px 2px 10px;line-height:22px;'>" + now_using_coupon.starttime.substr(0, 10) + " ~ " + getTotalEndtime(now_using_coupon).substr(0,10) + "</span>" : "";

            usecount = now_using_coupon.usecount ? now_using_coupon.usecount : 0;
            
            //최근회원권에서 기존에 사용하던 이용횟수/최대횟수 부분 삭제함
//            gx_mbsmaxcount_tag = now_using_coupon.mbstype == TYPE_GX ? "(<span id='span_now_using_coupon_count' style='color:#f1416c'>" + usecount + "</span>/" + getMbsMaxCount(now_using_coupon) + ")" : "";
//            gx_mbsmaxcount_tag = "";
            txt_coupons = "<text class='fmont' style='float:right;font-weight:700;color:#fa6374;font-size:15px;padding:3px 10px 3px 10px;background-color:#feeff1;border-radius:5px;margin-top:-4px'>DDay &nbsp;  " + txt_plus + (-last_dday) + "</text><span  style='float:left;margin-right:30px;'><text>" + now_using_coupon.mbsname + " " + gx_mbsmaxcount_tag + "<text></span><br><br>" + txt_startend;
            
             
            
            global_now_using_gx_couponid = now_using_coupon.id;
        }
        
    }
    //집주소 ,특이사항
    trs +=  "<tr align='left'>"+
                "<td  style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "집주소"+
                "</td>"+
                "<td colspan='3' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    address+                    
                "</td>"+
            "</tr>"+

            "<tr align='left'>"+
               "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "특이사항"+
                "</td>"+
                "<td colspan='3' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    other+
                "</td>"+
            "</tr>";

    var nowgxcoupon_countdata = {"max":0,"use":0,"reservatio":0,"remain":0};
    var gxtag = "";
    if(now_using_coupon  && now_using_coupon.mbstype == TYPE_GX){
        nowgxcoupon_countdata = getNowGxCouponCountData();
       gxtag = "<div id='div_gx_all_count' style='width:100%;'>"+
                    "<table style='width:100%;height:35px;color:#3f4254;font-size:12px;font-weight:400'>"+
                        "<tr>"+
                            "<td style='width:25%'>"+
                                "<text style='margin-left:15px'>등록횟수</text><text id='txt_gx_allcount' style='float:right;color:#3f4254;font-size:13px;font-weight:700;'>"+nowgxcoupon_countdata.max+"</text>"+
                            "</td>"+
                            "<td style='width:25%'>"+
                                "<text style='margin-left:15px'>사용횟수</text><text id='txt_gx_usecount' style='float:right;color:#fa6374;font-size:13px;font-weight:700;'>"+nowgxcoupon_countdata.use+"</text>"+
                            "</td>"+
                            "<td style='width:25%'>"+
                                "<text style='margin-left:15px'>예약횟수</text><text id='txt_gx_reservationcount' style='float:right;color:#3f4254;font-size:13px;font-weight:700;'>"+nowgxcoupon_countdata.reservation+"</text>"+
                            "</td>"+
                            "<td style='width:25%'>"+
                                "<text style='margin-left:15px'>잔여횟수</text><text id='txt_gx_remaincount' style='float:right;color:#3f4254;font-size:13px;font-weight:700;'>"+nowgxcoupon_countdata.remain+"</text>"+
                            "</td>"+

                        "</tr>"+
                    "</table>"+
                "</div>";
    }
    
    ///////////////////////////////////////////////////////
    // 2번째 테이블에 삽입한다.
    ///////////////////////////////////////////////////////    
    var last_dday = using_coupons[0] && using_coupons[0].endtime ? getDDay(using_coupons[0].endtime) : "-";
    var txt_plus = last_dday != "-" && parseInt(last_dday) < 0 ? "+" : "";
    trs2 +=  "<tr align='left'  height='70px'>"+
                "<td style='min-width:125px;width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "회원가입일"+
                "</td>"+
                 "<td style='min-width:140px;font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                    info.mem_regtime.substr(0,10)+
                    
                "</td>"+
               "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "최근 회원권"+
                "</td>"+
                 "<td style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                  "<text style='line-height:1.7em'>"+txt_coupons+"</text>"+   
//                  "<span style='float:right'><text class='fmont' style='float:left;font-weight:700;color:#fa6374;font-size:15px;padding:3px 10px 3px 10px;background-color:#feeff1;border-radius:5px;margin-bottom:8px'>DDay &nbsp;&nbsp;  "+txt_plus+(-last_dday)+"</text></span>"+   
         //GX 횟수 총횟수 , 이용횟수 , 예약횟수 , 남은횟수
                    gxtag+
                "</td>"+
            "</tr>";

   

    var str_newlockers = setJSONStringToParamString(new_lockers);
    if(newlocker_len > 0){
        
        var clockers = [];
        for(var a = 0 ; a < new_lockers.length; a++){
           var locker = new_lockers[a];
            //삭제된 라커나 , 기간이 종료된 라커는 보여주지 않는다.
            if(locker.isdelete && locker.isdelete == "D" || getDDay(locker.endtime) < 0){}
            else{
                clockers.push(locker);
            }
        }
        clog("clockers ",clockers);
        if(clockers.length > 0){
            for(var a = 0 ; a < clockers.length; a++){
                var locker = clockers[a];
    //          
                //삭제된라커는 보여주지 않는다.
    //            if(locker.isdelete && locker.isdelete == "D" || getDDay(locker.endtime) < 0)
    //                continue;


                //라커정보
                var locker_id = locker.id;
                var locker_starttime = locker.starttime;
                var locker_endtime = locker.endtime;
        //        var locker_time = locker.mem_uselockertime;
                var locker_num = locker.num+"";
                var locker_pass = locker.pass+"";




        //        var lockerdate = locker_time ? locker_time.substr(0,10) : "";
                var locker_html =   "<text style='float:left;font-weight:700;color:#fa6374;font-size:15px;padding:3px 10px 3px 10px;background-color:#feeff1;border-radius:5px;margin-bottom:8px'>라커번호 "+locker_num+"</text><br>"+
                                    "<text style='float:left;color:##495057;font-size:15px;margin-bottom:4px'>기간: <span class='fmont'>"+getToday(new Date(locker_starttime))+" ~ "+getToday(new Date(locker_endtime))+"</span></text><br>"+
                                    "<text style='float:left;color:##495057;font-size:15px;'>비밀번호: <span class='fmont'>"+locker_pass+"</span></text><br>";
                                    
                var json_locker = {"useid":userid, "locker_id":locker_id,  "locker_num":locker_num, "bstart":locker_starttime, "bend":locker_endtime, "locker_pass":locker_pass};
                var locker_data = setJSONStringToParamString(json_locker);



    //            clog(a+" locker_html ",locker_html);
                var locker_title = a == 0 ? "<td rowspan='"+clockers.length+"' style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                                                "라커정보"+
                                            "</td>" : "";

                trs2 += "<tr align='left'>"+
                            locker_title+
                            "<td colspan='3' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                                "<span style='float:left;'>"+
                                    locker_html+    
                                "</span>"+
                                
                            "</td>"+
                        "</tr>";

            }
        }else {
            trs2 +=  "<tr align='left'>"+
                         "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                            "라커정보"+
                           
                        "</td>"+
                        "<td colspan='3' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                            "<span style='width:80%;float:left;'>"+
                            "</span>"+
                           
                        "</td>"+
                    "</tr>";
        }
        
    }else {
        
            trs2 += "<tr align='center'>"+
                         "<td style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                             "라커정보"+
                           
                        "</td>"+
                        "<td colspan='3' style='font-size:15px;color:#495057;padding-left:20px;background-color:white'>"+
                            "<span style='width:80%;float:left;'>"+
                            "</span>"+                           
                        "</td>"+
                    "</tr>";
    }
    
    
    ///////////////////////////////////////////////////////
    //기타상품정보
    ///////////////////////////////////////////////////////
    if(othercoupon_len > 0){
         var using_othercoupons = getNowUsingOtherCoupons(othercoupons);
        
//         trs2 += "<tr align='left' style='height:55px;border-top:1px solid #eff2f5;border-bottom:1px solid #eff2f5;'>" +
//            "<td rowspan='1' bgcolor='#F7F7F7' onclick='info_button_click(\"" + key + "\", \"" + uid + "\", \"more_locker\", \"" + userid + "\", \"" + str_newlockers + "\")'>" +
//            "<text style='font-size: 14px;color:#3f4254;text-align:left;font-weight:500;margin-left:20px'>기타상품정보</text>&nbsp;<i class='fa-solid fa-rectangle-list'></i>" +
//            "</td>" +
//            "<td colspan='3' style='font:bold 16px 'tomaho';color:#777777;text-align:left;padding-left:10px;background-color:#F7F7F7;'>" +
//            "<span style='width:80%;float:left;'></span>" +
//            //기타상품 등록
//            "<img  id='admin_settingid_112_a_" + key + "' onclick='info_button_click(\"" + key + "\", \"" + uid + "\", \"uselocker\", \"" + userid + "\", \"\")' src='./img/button_addlocker.png' style='float:right;cursor:pointer;visibility:hidden;margin-left:10px;margin-top:-5px;margin-right:25px;'  title='기타상품 등록'>" +
//            "</td>" +
//            "</tr>";
        var str_newothers = setJSONStringToParamString(using_othercoupons);
        if (using_othercoupons.length > 0) {

            for (var a = 0; a < using_othercoupons.length; a++) {
                var othercoupon = using_othercoupons[a];
                 var str_othercoupon = setJSONStringToParamString(othercoupon);
                console.log("othercoupon " ,othercoupon);
                var other_id = othercoupon.id;
                var other_name = othercoupon.couponname;
                
                var other_month = othercoupon.month;
                var other_starttime = othercoupon.starttime;
                var other_endtime = othercoupon.endtime;
                
                //금액관련
                var other_couponprice = othercoupon.couponprice;
                var other_card = parseInt(other_couponprice.card);
                var other_cash = parseInt(other_couponprice.cash);
                var other_remain = parseInt(other_couponprice.remain);
                var other_total_remain = parseInt(other_couponprice.total_remain);
                
                
                
                var other_card_price_id = "other_card_price_" + a + "_" + key + "";
                var other_cash_price_id = "other_cash_price_" + a + "_" + key + "";
                var other_remain_price_id = "other_remain_price_" + a + "_" + key + "";
//                var other_totalremain_price_id = "other_totalremain_price_" + a + "_" + key + "";
                
                
                var isdelete_tag = othercoupon.isdelete && othercoupon.isdelete == "D" ? "&nbsp;" + getCouponIssueRectTag("회수됨") : "";
                var other_dday = getDay(othercoupon.endtime, getToday());
                var isovertime_tag = other_dday > 0 ? "&nbsp;" + getCouponIssueRectTag("기간종료") : "";

                
                 var right_btn_tag = "<span style='float:right;'>" +
                    //수정버튼
                    "<img id='admin_settingid_144_" + a + "_" + key + "'  onclick='info_button_click(\"" + key + "\", \"" + uid + "\", \"editother\", \"" + a + "\", \"" + str_othercoupon + "\")' src='./img/button_complete_edit.png' style='visibility:hidden;cursor:pointer;margin-left:10px;margin-top:5px;' title='라커정보 수정'>" +
                      // 위아래 화살표
                    "<div id='div_othericon_updown_" + a + "' align='center' style='float:right;width:40px;height:40px;color:#a1a5b7;padding-top:10px;cursor:pointer' onclick='otherlistClick(" + a + ")' ><i class='fa-solid fa-angle-down'></i></div>" +
                    "</span>";
                
                var other_title = a == 0 ? "<td width='140px' rowspan='" + using_othercoupons.length + "' bgcolor='#f5f6f8'  onclick='info_button_click(\"" + key + "\", \"" + uid + "\", \"more_other\", \"" + userid + "\", \"" + str_newothers + "\")'><text style='font-size: 14px;color:#3f4254;text-align:left;font-weight:500;'>기타상품정보</text>" : ""; //&nbsp;<i class='fa-solid fa-rectangle-list'></i></td>" : "";

                
                 var other_html =   "<text style='float:left;font-weight:700;color:#fa6374;font-size:15px;padding:3px 10px 3px 10px;background-color:#feeff1;border-radius:5px;margin-bottom:8px'>"+other_name+"</text><br><br>"+
                                    "<text style='float:left;color:##495057;font-size:15px;'>등록일: <span class='fmont'>"+other_id.substr(0,10)+"</span></text><br>"+
                                    "<text style='float:left;color:##495057;font-size:15px;margin-bottom:4px'>기간: <span class='fmont'>"+ getToday(new Date(other_starttime)) + "~" + getToday(new Date(other_endtime))+"</span></text><br>";
                                    
                trs2 += "<tr align='left' style='height:80px;border-top:1px solid #eff2f5;border-bottom:1px solid #eff2f5;'>" +
                            other_title +
                            "<td colspan='3' style='font:bold 16px 'tomaho';color:#777777;text-align:left;padding:10px;background-color:#F7F7F7;'>" +
                                
                               other_html+
                                
                            "</td>" +
                        "</tr>";
            }
        }
    }
    else {
         trs2 += "<tr align='left' style='height:55px;border-top:1px solid #eff2f5;border-bottom:1px solid #eff2f5;'>" +
            "<td rowspan='1' bgcolor='#F7F7F7' onclick='info_button_click(\"" + key + "\", \"" + uid + "\", \"more_locker\", \"" + userid + "\", \"" + str_newlockers + "\")'>" +
            "<text style='font-size: 14px;color:#3f4254;text-align:left;font-weight:500;'>기타상품정보</text>"+//&nbsp;<i class='fa-solid fa-rectangle-list'></i>" +
            "</td>" +
            "<td colspan='3' style='font:bold 16px 'tomaho';color:#777777;text-align:left;padding-left:10px;background-color:#F7F7F7;'>" +
            "<span style='width:80%;float:left;'></span>" +
            //기타상품 등록
            "<img  id='admin_settingid_112_a_" + key + "' onclick='info_button_click(\"" + key + "\", \"" + uid + "\", \"uselocker\", \"" + userid + "\", \"\")' src='./img/button_addlocker.png' style='float:right;cursor:pointer;visibility:hidden;margin-left:10px;margin-top:-5px;margin-right:25px;'  title='기타상품 등록'>" +
            "</td>" +
            "</tr>";
    }
    
    
   

    //회원권 목록 
    var len = using_coupons.length;
//    clog("using_coupons",using_coupons);
//    using_coupons.sort(sort_by('endtime', true, (a) => a.toUpperCase()));
    clog("using_coupons.length "+using_coupons.length);
    
    var couponlist_tag = "";
    var using_coupon_cnt = 0;
    
    var permission_133 = isPermission(133) ? true : false; // 양도 
    
    for(var a = 0 ; a < using_coupons.length; a++){
        var data = using_coupons[a];
        var coupon = setJSONStringToParamString(data);
        var usecount = parseInt(data.usecount) < 0 ? 0 : parseInt(data.usecount);
        var remain_count = getMbsMaxCount(data) - data.usecount;
        var startdate = data.starttime.substr(0,10);
        var enddate = getTotalEndtime(data).substr(0,10); 
        var dday = get_Day(enddate,getToday());
        var isover = false;
        
        var lockerprice = data.lockerprice ? data.lockerprice : "0";
        var lockermonth_text = data.lockermonth ? "&nbsp;["+data.lockermonth+"개월]" : "";
        var mbstype_text = data.mbstype == "PT" || data.mbstype == "GX" ?  "운동권" : "회원권";
        
        var txt_rmpt = ["",getCouponIssueRectTag("소진신청됨"),getCouponIssueRectTag("신청승인됨")];
        var remove_pt_status =  data.removeptstatus ? parseInt(data.removeptstatus) : 0;
        var tag_removeptcount = data.removeptstatus ? txt_rmpt[remove_pt_status] : "";
          var price = data.mbstype == "PT" || data.mbstype == "GX" ? mbstype_text+" : ￦"+data.mbsprice+tag_removeptcount : mbstype_text+" : ￦"+data.mbsprice+", 라커 : ￦"+lockerprice+"";
        var payment_type = data.paymenttype ? parseInt(data.paymenttype) : 0;
        var repay = data.repay ? data.repay+"" : "";
        var repay_other = data.repay_other ? data.repay_other : "";
        var json_remainprice = data.remainprice ? data.remainprice : null;

        
        var remain_text = json_remainprice && parseInt(json_remainprice.remain) > 0 ? getCouponIssueRectTag("미수금 ￦"+CommaString(json_remainprice.remain)) : "";
        if(json_remainprice && json_remainprice.remain && parseInt(json_remainprice.remain) > 0){
            remain_text = getCouponIssueRectTag("미수금 ￦"+CommaString(json_remainprice.remain));//"<br><text style='font-size:14px;color:red'>(미수금:￦"+CommaString(json_remainprice.remain)+")";
        }
         //미수금 완납 텍스트
        var data_mbsprice = parseInt(data.mbsprice);
        var json_remainprice_total_remain = json_remainprice && json_remainprice.total_reamin ? parseInt(json_remainprice.total_remain) : 0;
        if(data.remainpricefinish && parseInt(data.remainpricefinish) == 1) remain_text = getCouponIssueRectTag("미수금완납 ￦"+CommaString(json_remainprice.total_remain));
        
        var price = data.mbstype == "PT" || data.mbstype == "GX" ? "<text style='font-size:14px;'>￦"+CommaString(data.mbsprice)+" "+remain_text+tag_removeptcount+"</text>" : "<text style='font-size:14px;'>￦"+CommaString(data.mbsprice)+"&nbsp;"+remain_text+"</text>";
        var payment_type = data.paymenttype ? parseInt(data.paymenttype) : 0;
        var isdelete = data.isdelete ? data.isdelete : "N";
        var issendedcoupon = data.issendedcoupon ? parseInt(data.issendedcoupon) : -1;
        var repay = data.repay ? data.repay+"" : "";
        var repay_other = data.repay_other ? data.repay_other : "";
        var coupon_id_date = data && data.id && data.id.length >= 10 ? data.id.substr(0,10) : data.id;
//        var refund = payment_type == 3 ? "<text style='font-size:12px;color:red'>환불완료 "+repay+" , 환불내용:"+repay_other+"</text>" : "";//real
////        var refund = "<text style='font-size:12px;color:red'>환불완료 "+repay+" , 환불내용:"+repay_other+"</text>";//test
//        if( dday > 0 )refund += "<text style='font-size:12px;color:blue'>기간종료</text>";
       
        var refund = payment_type == 3 ? getCouponIssueRectTag("환불완료")+" "+repay : "";
         if( dday > 0 )refund += "&nbsp;"+getCouponIssueRectTag("기간종료");
        
        if(data.issendedcoupon){
            if(parseInt(data.issendedcoupon) == -1){
                refund += "&nbsp;"+getCouponIssueRectTag("양도함");//"<text style='font-size:12px;color:red'>(양도함)</text>";                
            }else if(parseInt(data.issendedcoupon) > 0){
                refund += "&nbsp;"+getCouponIssueRectTag("양도받음");//"<text style='font-size:12px;color:blue'>(양도받음)</text>";                
            }
        }
        
           var txt_free = data.mbsname && data.mbsname.indexOf(ID_FREE) >= 0 ? ID_FREE : "";
         if(data.issendedcoupon && parseInt(data.issendedcoupon) == -1 || dday > 0  || payment_type == 3 || isdelete != "N")isover = true;
//        var coupon_name = data.mbstype == "PT" || data.mbstype == "GX" ? data.mbstype+" "+data.mbsmaxcount+"회 <text style='color:red;font-size:14px'>("+data.usecount+"회 이용)</text>" : data.mbsname;
         var coupon_name = data.mbstype == "PT" || data.mbstype == "GX" ? "<text style='font-size: 14px; color:#3f4254;text-align:left; font-weight:700;'>"+txt_free+data.mbstype+" "+getMbsMaxCount(data)+"회 (<span style='color:#f1416c'>"+usecount+"</span>/"+getMbsMaxCount(data)+")</text>" : "<text style='font-size: 14px; color:#3f4254;text-align:left; font-weight:700;'>"+data.mbsname+"</text>";
        
        if(data.mbstype == "그룹"){
            var uid_couponid = uid+"_"+data.id;
            var use_count = getGXCouponUseCount(uid_couponid,usecount);
            
            coupon_name = "<text style='font-size: 14px; color:#3f4254;text-align:left; font-weight:700;'>[그룹] "+data.mbsname+" (<span style='color:#f1416c'>"+use_count+"</span>/"+getMbsMaxCount(data)+")</text>"
        }
        
        //neel_removeptpage
        var isshowremoveptcount = data.mbstype == "PT" ? "block" : "none";
//         var isshowremoveptcount = data.mbstype == "PT" ? "block" : "block";
        
        var btn_txt = "잔여횟수소진";
        var snum = remove_pt_status < 1 ? 176 : 177;
        clog("remove_pt_status "+remove_pt_status+" snum "+snum);
        var isshowremoveptbtn = remove_pt_status == 2  || remove_pt_status == 1 && auth >= AUTH_OPERATOR ? "visible" : "hidden";
        
        var btn_color = "#ee3333";
        if(remove_pt_status == 1){
            btn_txt = "소진신청됨";
            
        }
        else if(remove_pt_status == 2){
            btn_txt = "소진승인됨";
            btn_color = "#3333ee";
        }
        
        
        //neel_removeptpage
        //real
        var remove_remaincount_btn = parseInt(loginauth) >= AUTH_MANAGER || parseInt(loginauth) == AUTH_TRANER && data.managerid == loginuid ? "<button onclick='info_button_click(\""+key+"\", \""+uid+"\", \"removeptcount\", \""+coupon+"\", \""+remove_pt_status+"\")' class='btn ' style='display:"+isshowremoveptcount+";margin-left:10px;width:120px; height:35px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;float:right;margin-right:5px'>"+btn_txt+"</button>":"";
       
        //test
//        var remove_remaincount_btn = "<button onclick='info_button_click(\""+key+"\", \""+uid+"\", \"removeptcount\", \""+coupon+"\", \""+remove_pt_status+"\")' class='btn ' style='display:"+isshowremoveptcount+";margin-left:10px;width:150px; height:35px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;float:right;margin-right:5px'>"+btn_txt+"</button>";
        
//        clog("permission_133 "+permission_133+" isdelete "+isdelete+" issendedcoupon "+issendedcoupon+ " " );
        //이미 양도한 회원권인지 체크
        var issendedcoupon = data.issendedcoupon && parseInt(data.issendedcoupon) == -1 ? true : false;
        var send_btn_tag = parseInt(loginauth) >= AUTH_TRANER  && isdelete == "N" && !issendedcoupon && getDDay(enddate) >=0 &&  permission_133 ?  "<button onclick='info_button_click(\""+key+"\", \""+uid+"\", \"sendcoupon\", \""+coupon+"\", \""+userid+"\", \""+info.mem_username+"\")' class='btn ' style='margin-left:10px;width:100px; height:35px;border-radius:5px;background-color:#009ef7;cursor:pointer;border:0px;font-size:14px; color:#ffffff;text-align:center; font-weight:700;float:right;margin-right:5px'>양도</button>" : "";
        if(data.mbstype == "PT" && remove_pt_status == 0 && remain_count == 0 || data.mbstype == "PT" && data.mbsname.indexOf(ID_FREE) >= 0 && parseInt(data.mbsprice) == 0)send_btn_tag = "";
        
       
//        clog(a+" send_btn_tag ",send_btn_tag);
        if(data.mbstype == "PT" && remove_pt_status == 0 && remain_count == 0 || data.mbstype == "PT" && data.mbsname.indexOf(ID_FREE) >= 0 && parseInt(data.mbsprice) == 0 || issendedcoupon || isdelete != "N")remove_remaincount_btn = "";
        
        
        var name_bg_color =  issendedcoupon || dday > 0  || payment_type == 3 || isdelete != "N" ? "#dddddd" : "#f0f6fa";
         var nvalue = coupon_name;
        var name_span = refund+" "+nvalue;
        
        var count_span = data.mbsiscounttype == 1 ? "<span style='float:left;padding:17px 10;'>"+price+"</span>" : "";
        var price_span = "<div class='fmont' style='float:left;width:100%;height:50px;'>"+getCashIcon(data.paymenttype)+"&nbsp;&nbsp;"+price+"</div>";
        

       
        
        var time_span = "<span class='fmont' style='float:right;padding:17px 10;'>"+startdate+"~"+enddate+"</span>";
//        var time_span = remove_remaincount_btn+"<span style='float:right;padding:17px 10;'>"+tvalue+"</span>";
        var coupontitle = a == 0 ? "<td rowspan='1000' style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                                "회원권목록"+
                             "</td>" : "";

        //////////////////////////////////////////
        //변경요청사항이 있으면 표시한다.  START
        //////////////////////////////////////////
        var holding_span = "";
        var request_index = 1;
        if(data.holdingdata && data.holdingdata.length > 0){
            for(var c = 0 ; c < data.holdingdata.length; c++){
                var holdingdata = data.holdingdata[c];
                var hstime = holdingdata.holding_starttime ? holdingdata.holding_starttime.substr(0,10) : "";
                var hetime = holdingdata.holding_endtime ? holdingdata.holding_endtime.substr(0,10) : "";
                var hday = holdingdata.day ? holdingdata.day : "0";
                holding_span+= "<text style='color:red;font-size:12px'>("+request_index+")홀딩기간 : "+hstime+" ~ "+hetime+" 총 : "+hday+"일</text><br>";
                request_index++;
            }
        }
        var changestarttime_span = "";
        if(data.holding_starttime && parseInt(data.holding_starttime) > 0)
            changestarttime_span = "<text style='color:red;font-size:12px'>("+request_index+")시작시간변경 : "+data.holding_starttime+"회</text><br>";
        var request_span  = "<span style='float:left;padding:17px 10;'>"+holding_span+changestarttime_span+"</span>";
        
        //////////////////////////////////////////
        //변경요청사항이 있으면 표시한다.   END
        //////////////////////////////////////////
        

        //등록일 태그      
        var coupon_regist_tag = "<div style='height:35px;padding-top:15px'>"+
                                    "<text class='fmont ' style='position:absolute;float:left;font-size: 14px; color:#3f4254;text-align:left; font-weight:500;margin-left:100px;'>"+coupon_id_date+"</text>"+
                                    "<text style='margin-left:-25px; color:#a1a5b7;font-weight:700'><span style='font-weight:900'>·</span>&nbsp;&nbsp;&nbsp;등록일</text>"+
                                    
                                "</div>";
        //회원권 가격 태그
        var price_tag = "<div style='height:35px;padding-top:15px'>"+
                            "<text class='fmont ' style='position:absolute;float:left;font-size: 14px; color:#3f4254;text-align:left; font-weight:500;margin-left:100px;'>"+price_span+"</text>"+
                            "<text style='margin-left:-25px; color:#a1a5b7;font-weight:700'><span style='font-weight:900'>·</span>&nbsp;&nbsp;&nbsp;"+mbstype_text+"</text>"+
                            
                        "</div>";
        //라커 태그
        var locker_tag =  data.lockermonth ? "<div style='height:35px;padding-top:15px'>"+
                                                 "<text class='fmont ' style='position:absolute;float:left;font-size: 14px; color:#3f4254;text-align:left; font-weight:500;margin-left:100px;'>"+data.lockermonth+"개월  ￦"+CommaString(lockerprice)+"</text>"+
                                                 "<text style='margin-left:-25px; color:#a1a5b7;font-weight:700'><span style='font-weight:900'>·</span>&nbsp;&nbsp;&nbsp;라커</text>"+
                                                 
                                             "</div>" : "";
        //기간 태그
        var startend_tag =  "<div style='height:35px;padding-top:15px'>"+                               
                                "<text class='fmont info_default' style='position:absolute;float:left;font-size: 14px; color:#3f4254;text-align:left; font-weight:500;margin-left:100px;'>"+startdate+" ~ "+enddate+"</text>"+
                                "<text style='margin-left:-25px; color:#a1a5b7;font-weight:700'><span style='font-weight:900'>·</span>&nbsp;&nbsp;&nbsp;기간</text>"+
//                                "<div style='height:50px'>"+send_btn_tag+" "+remove_remaincount_btn+"</div>"+
            
                            "</div>";
        
        //버튼들 태그 , 잔여횟수소진신청 , 양도
        var btns_tag = "<div style='height:45px;padding-top:15px'>"+                               
                                send_btn_tag+" "+remove_remaincount_btn+
            
                            "</div>";
        
        
        //요청사항 태그
        var request_tag = holding_span ? "<div style='height:35px;padding-top:15px'>"+
                                             "<text class='fmont ' style='position:absolute;float:left;font-size: 14px; color:#f1416c;text-align:left; font-weight:500;margin-left:100px;'>"+holding_span+"</text>"+
                                             "<text style='margin-left:-25px; color:#f1416c;font-weight:700'><span style='font-weight:900'>·</span>&nbsp;&nbsp;&nbsp;홀딩</text>"+
                                             
                                         "</div>" : "";
        //특이사항 태그
        
        var note_tag = data.note ?  "<div style='height:35px;padding-top:15px'>"+
                                        "<text class='fmont ' style='position:absolute;float:left;font-size: 14px; color:#3f4254;text-align:left; font-weight:500;margin-left:100px;'>"+data.note+"</text>"+
                                        "<text style='margin-left:-25px; color:#a1a5b7;font-weight:700'><span style='font-weight:900'>·</span>&nbsp;&nbsp;&nbsp;Note</text>"+
                                        
                                    "</div>" : "";
        
         var coupontitle_bgcolor = isover ? "#dddddd" : "#f0f6fa";
        var paddingtop = isover ? "5px" : "7px";
        if(!isover)using_coupon_cnt++;
        couponlist_tag +=   "<div align='left' style='border:1px solid #e4e6ef;border-radius:10px;margin:10px 10px 0px 10px;'>"+
                                "<div id='couponlist_header_"+key+"_"+a+"' onclick='couponlistClick("+a+")' style='height:35px;background-color:"+coupontitle_bgcolor+";border-radius:10px;padding-top:"+paddingtop+"'>"+
                                    "<span style='margin-left:20px;margin-top:15px'>"+
    //                                    "<label align='left'  style='position:absolute;width:800px;font-weight:700;color:#3f4254;font-size:15px;line-height:35px;border-radius:5px;margin-top:-5px;'>회원권<label>"+
                                        name_span+
                                    "</span>"+
                                    // 위아래 화살표
                                    "<div id='div_couponicon_updown_"+a+"' align='center' style='float:right;width:40px;height:40px;color:#a1a5b7;padding-top:5px'><i class='fa-solid fa-angle-down'></i></div>"+
                                    
                                    //right_btn_tag+
                                "</div>"+                    
                                //펼쳤을때 보이는 부분
                                "<ul class='csub"+a+"' style='display:none;'>"+
                                    "<div  id='couponlist_main_"+key+"_"+a+"'>"+
            
                                        coupon_regist_tag+
                                        price_tag+
                                        locker_tag+
                                        startend_tag+
                                        btns_tag +
                                        request_tag+
                                        note_tag+
                                    "</div>"+
                                "</ul>"+
                            "</div>";
    }
      
    //회원권 목록
    if(couponlist_tag)
    trs2 +=  "<tr align='left'>"+
                "<td rowspan='1000' style='width:125px;background-color:#f5f6f8;padding-left:17px;font-size:15px;color:#212529;font-weight:500'>"+
                    "회원권목록"+
                 "</td>"+
                "<td colspan='3' style='font-size:15px;color:#495057;padding-left:10px;background-color:white;height:auto'>"+
                    "<div align='center' id='div_coupon_list_title' onclick='onClickCouponListTitle()' style='width:100%;height:30px'>"+
                        "<label id='label_coupon_list_title' style='border:0px;color:#31b0f8;font-size:12px;padding-top:5px;padding-right:10px'>▼</label>"+
                    "</div>"+
                    "<div id='div_coupon_list_body' style='display:none'>"+
                        couponlist_tag+
                    "</div>"+
                "</td>"+
            "</tr>";    
    
//    trs2 += "<tr>"+
//            "<td colspan='4' >"+
//                "<button onclick='info_button_click(\""+key+"\", \""+uid+"\", \"contract\", \"HT\", \""+userid+"\")' class='btn btn-primary btn-raised' style='display:none;float:right;margin:10px;cursor:pointer;'>가입서류보기</button>"+
//            "</td>"+
//            "</tr>";
    
    var rdata = "<div id='table_div' style='width:100%;height:auto;margin:auto;text-align:center;padding:25px'>"+
                    "<table class='table' id='tb_user' style='width:100%;height:auto;border:1px solid #e7e7e7'>"+
                        trs+
                    "</table>"+
                    "<br><text style='float:left;font-size:17px;color:#262930;font-weight:700;margin-bottom:13px'>회원권 정보</text><br>"+
                     "<table class='table' id='tb_user_coupons' style='width:100%;height:auto;border:1px solid #e7e7e7'>"+
                        trs2+
                    "</table>"+
                "</div>";

    if(showtype && showtype == "coupons"){
        return couponlist_tag;
    }else{
        return rdata;
    } 
        
}


//현재 이용중인 GX회원권 카운트데이타를 가져온다.
function getNowGxCouponCountData(){

    var membership = global_user_info["mem_membership"] != "" && global_user_info["mem_membership"] != "null" ? JSON.parse(global_user_info["mem_membership"]) : [];
    console.log("global_now_using_gx_couponid "+global_now_using_gx_couponid);
    if(!global_now_using_gx_couponid){
        document.getElementById("div_gx_all_count").style.display = "none";
        return {"couponid":"","max":0,"use":0,"reservation":0,"remain":0};
    }
    var now_coupon = findCouponByCouponid(membership,global_now_using_gx_couponid);
    var uid_couponid = global_user_info["mem_uid"]+"_"+global_now_using_gx_couponid;
    var maxcount =  getMbsMaxCount(now_coupon);
    var allusecount = now_coupon.usecount ? parseInt(now_coupon.usecount) : 0;
    var reservation_count = getGXCouponReservationCount(uid_couponid);
    var usecount = getGXCouponUseCount(uid_couponid,allusecount);
    var remaincount = maxcount - allusecount;
    
    return {"couponid":global_now_using_gx_couponid,"max":maxcount,"use":usecount,"reservation":reservation_count,"remain":remaincount};
    
}
//예약한 현재시간 기준 사용 횟수다 uid_couponid
function getGXCouponUseCount(uid_couponid,user_usecount){
    
    if(user_reservation_couponcount[uid_couponid] && user_reservation_couponcount[uid_couponid].use >= 0)
        return user_reservation_couponcount[uid_couponid].use;
    else return user_usecount;
}
//예약한 현재시간 이후 미래의 횟수다 uid_couponid
function getGXCouponReservationCount(uid_couponid){
    if(user_reservation_couponcount[uid_couponid] && user_reservation_couponcount[uid_couponid].reservation >= 0)
        return user_reservation_couponcount[uid_couponid].reservation;
    else return 0;
}

function findCouponByCouponid(coupons,couponid){
    var coupon = null;
    for(var i = 0 ; i < coupons.length; i++){
        if(coupons[i].id == couponid){
            coupon = coupons[i];
            break;
        }
    }
    return coupon;
}

//일단 GX일때 횟수모두 소진했으며 다음 회원권이 있으면서 1회이상 사용했다면
function isNowCouponMaxUseAndNextCouponUse(uid, nowcoupon, coupons) {
    var now_coupontype = nowcoupon.mbstype;
    var now_couponid = nowcoupon.id;
    var now_coupon_endtime = nowcoupon.endtime;


    var flg = false;
    for (var i = 0; i < coupons.length; i++) {
        var coupon = coupons[i];
        //현재회원권이 아닌 다른회원권이며 , 종료일이 더 길고 , 횟수를 1회이상 사용했다. 

        if (now_coupontype == TYPE_GX && now_coupontype == coupon.mbstype && coupon.id != now_couponid && compare_date(now_coupon_endtime, coupon.endtime) == -1 && parseInt(coupon.usecount) > 0) {
            flg = true;
            break;
        }
    }
    return flg;
}
function sort_coupon_delete_to_last(coupons){
    
    //////////////////////////////////////////////
    // 삭제되거나 , 환불되거나 , 양도된 쿠폰을 구분한다.
    //////////////////////////////////////////////
    var top_coupons = [];
    var bottom_coupons = [];
    for(var a = 0 ; a < coupons.length; a++){
        var data = coupons[a];
        
        var isdelete = data.isdelete && data.isdelete == "D" ? true :false;
        
//        var repay = data.repay ? data.repay+"" : "";
//        var repay_other = data.repay_other ? data.repay_other : "";
        
        var payment_type = data.paymenttype ? parseInt(data.paymenttype) : 0;
        var isrefund = payment_type == 3 ? true : false;
        
        var issend = false;
        if(data.issendedcoupon){
            if(parseInt(data.issendedcoupon) == -1){
                issend = true;      
            }
        }
        
        
//        clog(a+") "+data.mbsname+" isdelete "+isdelete+" isrefund "+isrefund+" issend "+issend);
        
        if(isdelete || isrefund || issend){
//            clog("data.name "+data.mbsname);
            bottom_coupons.push(data);
        }else{
            top_coupons.push(data);
        }
    }
    
    for(var i = 0; i < bottom_coupons.length; i++){
        top_coupons.push(bottom_coupons[i]);
    }
    return top_coupons;
}
function getCouponIssueRectTag(txt,_fontcolor, _bgcolor, _bordercolor){
    var fontcolor = _fontcolor ? _fontcolor : "#f1416c";
    var bordercolor = _bordercolor ? _bordercolor : "#f49cb3";
    var bgcolor = _bgcolor ? _bgcolor : "#f8eff3";
    return "<label style='font-size:12px;background-color:"+bgcolor+";border:1px solid "+bordercolor+";border-radius:3px;font-size: 12px; color:"+fontcolor+";text-align:center; font-weight:700;padding:2px 8px 2px 8px'>"+txt+"</label>";//test
}
function onClickCouponListTitle(){
    var div_coupon_list_title = document.getElementById("div_coupon_list_title");
    var label_coupon_list_title = document.getElementById("label_coupon_list_title");
    var div_coupon_list_body = document.getElementById("div_coupon_list_body");
    
    if(label_coupon_list_title.innerHTML == "▼"){
        
        label_coupon_list_title.innerHTML = "▲";
//        div_coupon_list_body.style.display = "block";
        $("#div_coupon_list_body").show(200);
    }else {
        
        label_coupon_list_title.innerHTML = "▼";
//        div_coupon_list_body.style.display = "none";
        $("#div_coupon_list_body").hide(200);
    }
    
    
}
var before_index = 0;
function mlistClick(index){
        
        if(before_index != index && before_index != -1){
            if($(".csub"+before_index).is(":visible")){
                $(".csub"+before_index).slideUp(100);
            }           
        }
        
        if($(".csub"+index).is(":visible")){
            $(".csub"+index).slideUp(100);
            before_index = -1;
        }
        else{
            $(".csub"+index).slideDown(150);
            before_index = index;
        }
    }
var before_index = -1;
function lockerlistClick(index){
    var div_beforelockericon_updown = document.getElementById("div_lockericon_updown_"+before_index);
    var div_lockericon_updown = document.getElementById("div_lockericon_updown_"+index);
    if(before_index != index && before_index != -1){
        if($(".sub"+before_index).is(":visible")){
            $(".sub"+before_index).slideUp(100);
            div_beforelockericon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
        }           
    }

    if($(".sub"+index).is(":visible")){
        $(".sub"+index).slideUp(100);
        before_index = -1;
        div_lockericon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
    }
    else{
        $(".sub"+index).slideDown(150);
        div_lockericon_updown.innerHTML = "<i class='fa-solid fa-angle-up'></i>";
        before_index = index;
    }
}
var before_other_index = -1;
function otherlistClick(index) {
    var div_beforeothericon_updown = document.getElementById("div_othericon_updown_" + before_other_index);
    var div_othericon_updown = document.getElementById("div_othericon_updown_" + index);

    if ($(".sub" + index).is(":visible")) {
        $(".sub" + index).slideUp(100);
        before_other_index = -1;
        div_othericon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
    } else {
        $(".sub" + index).slideDown(150);
        div_othericon_updown.innerHTML = "<i class='fa-solid fa-angle-up'></i>";
        before_other_index = index;
    }
}
var before_couponindex = -1;
function couponlistClick(index){
    var div_beforecouponicon_updown = document.getElementById("div_couponicon_updown_"+before_couponindex);
    var div_couponicon_updown = document.getElementById("div_couponicon_updown_"+index);
  
    if(before_couponindex != index && before_couponindex != -1){
        if($(".csub"+before_couponindex).is(":visible")){
            $(".csub"+before_couponindex).slideUp(100);
            div_beforecouponicon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
        }           
    }

    if($(".csub"+index).is(":visible")){
        $(".csub"+index).slideUp(100);
        before_index = -1;
        div_couponicon_updown.innerHTML = "<i class='fa-solid fa-angle-down'></i>";
    }
    else{
        $(".csub"+index).slideDown(150);
        div_couponicon_updown.innerHTML = "<i class='fa-solid fa-angle-up'></i>";
        before_index = index;
    }
    
}
function setJSONStringToParamString(json){
    var v = JSON.stringify(json);
//    v = v.replaceAll('"', '\\"');
    v = v.replace(/"/g, '\\"');
    return v;
}
var ptcoupon_remaincount = 0;
function info_button_click(key,uid,id,arg,arg2,arg3) {  
    switch(id){
        case "removeptcount":
            var data = JSON.parse(arg);
            var remove_pt_status = parseInt(arg2);
            getRemovePTCountData(uid,data.removeptid,function(rmptdata){
                showRemovePTCount(data,global_user_info,remove_pt_status,rmptdata);
            });
            
            break;
        case "sendcoupon":
            
            
           
            
            var str_coupon = arg;
            var coupon = JSON.parse(str_coupon);
            var groupid = coupon.groupid ? coupon.groupid : "";
            var userid = arg2;
            var username = arg3;
            
             var value = {
                couponid : coupon.id,
                useruid : uid,
                groupid : groupid
            }
            var groupcode = getData("nowgroupcode");
            var centercode = getData("nowcentercode");
            var uid_couponid = uid+"_"+coupon.id;
            ptcoupon_remaincount = 0; //초기화
            if(coupon.mbstype == "PT"){
                checkRemainReservation(uid,coupon.id,coupon.managerid,function(code,message){
                    if(code == "success"){
                        ptcoupon_remaincount = parseInt(message);

                        getPaymentData(groupcode, centercode, value,function(res){
                            var str_payments = JSON.stringify(res.message);
                            var code = parseInt(res.code);
                            if(code == 100)
                                user_coupon_update("changeuser",  uid,  userid ,  username, key, str_payments, str_coupon);
                            else 
                                user_coupon_update("changeuser",  uid,  userid ,  username, key, null, str_coupon);
                        });
                    }else{
    //                    alertMsg("남은 PT 횟수를 가져오는데 에러발생 :"+message);
                    }
                });

            }
             else if(coupon.mbstype == TYPE_GX && getGXCouponReservationCount(uid_couponid) > 0){
                var max = getMbsMaxCount(coupon);
                var allusecount = coupon.usecount ? parseInt(coupon.usecount) : 0;
                var use = getGXCouponUseCount(uid_couponid, allusecount);
                var reservation = getGXCouponReservationCount(uid_couponid);
                var sendcount = max -use;
                alertMsg("현재시간 이후에 예약된 횟수가("+reservation+"회) 있습니다.<br>현재시간 이후 예약된 횟수는 자동으로 소멸되고 남은 <span style='font-weight:bold;color:#fa6374'>"+sendcount+"회</span>만 양도됩니다.",function(){
                    user_coupon_update("changeuser",  uid,  userid ,  username, key, null, str_coupon);
                });

            }  
            else {
                getPaymentData(groupcode, centercode, value,function(res){
                    var str_payments = JSON.stringify(res.message);
                    var code = parseInt(res.code);
                    if(code == 100)
                        user_coupon_update("changeuser",  uid,  userid ,  username, key, str_payments, str_coupon);
                    else 
                        user_coupon_update("changeuser",  uid,  userid ,  username, key, null, str_coupon);
                });
            }
            
            break;
    }
}
function checkRemainReservation(uid,couponid,managerid,callback){
     var groupcode = getData("nowgroupcode");
     var centercode = getData("nowcentercode");

     var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :"checkremainreservation",
        value : {"uid":uid,"couponid":couponid,"managerid":managerid}
    }

     CallHandler("adm_get", senddata, function (res) {
       if(res.code == 100){
           callback("success",res.message);
       }else {
           callback("error",null);
       }

    }, function (err) {callback("error",err);});
}
function changeStrToJson(str){
    if(str == "")return null;
    try {
        var json = JSON.parse(str);
        return json;
    } catch (e) {
        str = str.replaceAll("\n","");
        var json = JSON.parse(str);
        return json;
    }
}
function user_coupon_update(type,useruid,userid,username, key, str_data, str_coupon){
    //tb_payment data 결제내역
    var datas = str_data ? changeStrToJson(str_data) : null;
    var data = datas ? datas[0] : null;
    clog("paymentdatas ",data);
    if(data){
        clog("결제내역",data);
        var coupon = JSON.parse(str_coupon);
        var paymentid = data.pm_date;//결제일
        var couponcentercode = coupon.mbsusecentercode;
        var user_mbstype = coupon.mbstype == "PT" || coupon.mbstype == "GX" ?  coupon.mbstype : "회원권"; //구분
        var constructorname = data.pm_constructorname ? data.pm_constructorname : ""; //가입시킨사람 
        var desc = data.pm_desc ? data.pm_desc : ""; //결제항목
        var starttime = data.pm_starttime ? data.pm_starttime : "";  //시작일

        var endtime = data.pm_endtime ? data.pm_endtime : ""; //종료일
        var lockerprice = data.pm_pay_locker ? data.pm_pay_locker: ""; // 라커가격
        var couponprice = coupon.mbstype == "PT" || coupon.mbstype == "GX" ? data.pm_pay_counttype : data.pm_pay_termtype; /// 쿠폰가격
        var totalprice = data.pm_total_pay ? data.pm_total_pay : ""; // 총금액
        var note = data.pm_memo ? data.pm_memo : ""; // 특이사항
        var button = "<button class='btn btn-primary btn-raised' onclick='' style='background-color:#116666;margin:10px' >삭제</button>"; // 삭제버튼
        var isdelete = data.pm_status != 'N' ? true : false;  
        var couponid = data.pm_couponid;
        var coupontype = data.pm_coupontype; //쿠폰타입 T : 기간제 , G : 그룹 ,  C : 횟수제 , U : 알수없음, L : 라커만 , TL : 기간제 + 라커 , R: 환불
        var remainid = data.pm_pay_remainid;
    //    var json_remainprice = JSON.parse(data.pm_pay_remainprice); // 빈값으로 변환해놔서 아무것도 없음
        var useruid = data.pm_useruid;
        var userid = data.pm_userid;
        var username = data.pm_username;
        var pmpaymenttype = data.pm_paymenttype;
        
        var note = data.pm_memo;
        
        //GX인지 체크
        var isshowgxcount = coupon && coupon.mbstype == TYPE_GX ? true : false;
        var gx_count_title_tag = isshowgxcount ? "<th style='width:60px'>그룹횟수</th>" : "";
        
        var maxholding_day = coupon && coupon.mbsmaxholdingday ? parseInt(coupon.mbsmaxholdingday) : 0;
    }else{
       
        var coupon = changeStrToJson(str_coupon);
         clog("결제내역XXX",coupon);
        var paymentid = "";//결제일
        var couponcentercode = coupon.mbsusecentercode;
        var user_mbstype = coupon.mbstype == "PT" || coupon.mbstype == "GX" ?  coupon.mbstype : "회원권"; //구분
        var constructorname = ""; //가입시킨사람 
        var desc = ""; //결제항목
        var starttime = coupon.starttime;  //시작일

        var endtime = coupon.endtime; //종료일
        var lockerprice = 0; // 라커가격
        var couponprice = 0; /// 쿠폰가격
        var totalprice = 0; // 총금액
        var note = ""; // 특이사항
        var button = "<button class='btn btn-primary btn-raised' onclick='' style='background-color:#116666;margin:10px' >삭제</button>"; // 삭제버튼
        var isdelete = false;  
        var couponid = coupon.id;
        var coupontype = "T"; //쿠폰타입 T : 기간제 , C : 횟수제 , U : 알수없음, L : 라커만 , TL : 기간제 + 라커 , R: 환불
        var remainid = "";
    //    var json_remainprice = JSON.parse(data.pm_pay_remainprice); // 빈값으로 변환해놔서 아무것도 없음
        var useruid = useruid;
        var userid = userid;
        var username = username;
        var pmpaymenttype = coupon.paymenttype;
        var note = coupon.note;
        //GX인지 체크
        var isshowgxcount = coupon && coupon.mbstype == TYPE_GX ? true : false;
        var gx_count_title_tag = isshowgxcount ? "<th style='width:60px'>그룹횟수</th>" : "";
        var maxholding_day = coupon && coupon.mbsmaxholdingday ? parseInt(coupon.mbsmaxholdingday) : 0;
    }

    
    switch(type){
       
        case "changeuser": //양도 , 다른고객에게 전달하기
            clog("coupon ",coupon);
            //양도할때  예약된 횟수가 있는지 체크한다.
            if(coupon.mbstype == TYPE_PT && ptcoupon_remaincount > 0){
                 var title = "경고";
                var message = "기존 트레이너와 예약된 횟수가 있습니다.<br>예약된 횟수를 삭제하고 양도하시겠습니까?";
                showModalDialog3Button(document.body, title, message, "삭제하고 양도하기 ", "삭제하지않고 양도하기","취소", function () {
                    
                    changeUserCoupon(useruid,userid,username,coupon,1);
                    
                },function(){
                    changeUserCoupon(useruid,userid,username,coupon,0);
                },function(){
                    hideModalDialog();
                },null);
            }
            if(coupon.mbstype == TYPE_GX){
                changeUserCoupon(useruid,userid,username,coupon,1);
            }
            else {
                changeUserCoupon(useruid,userid,username,coupon,0);
            }
            
            break;        
    }

}
function changeUserCoupon(useruid,userid,username,coupon,isremoveremaincount){
    var title = "회원권 양도하기";
    var message = 
		"<div style='width:100%;padding:20px;'><div style='width:100%;height:50px;background-color:#50cd8977; border-radius:10px 10px 0 0;padding-left:25px;padding-right:25px;padding-top:15px;border-bottom:1px solid #e4e6ef;box-shadow: 0px 5px 10px 0px rgba(16, 26, 35, 0.1);'>"+
			"<label style='font-size:14px; color:#3f4254; text-align:left; font-weight:700;'>양도할 회원을 입력해 주세요</label>"+
		"</div>"+
		"<div style='width:100%;height:50px;background-color:white; border-radius:0px 0px 10px 10px;padding-left:25px;padding-right:25px;padding-top:5px;border-bottom:1px solid #e4e6ef;box-shadow: 0px 5px 10px 0px rgba(16, 26, 35, 0.1);'>"+
			"<input id='input_send' type='text' style='width:328px; height:38px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; '>"+
		"</div></div>";
		//"양도할 회원을 입력해 주세요<br><input id='input_send' type='text' class='form-control'/>";
    
    var style = {
            bodycolor: "white",
             marginTop:"0px",
            size: {
                width: "580px",
                height: "auto"
            },
            top:{
                 color:"#262930",
                 textAlign:"left",
                 paddingLeft:"25px",
                 borderBottom: "1px solid #dddddd"
             },
        };
    showModalDialog3Button(document.body, title, message, "회원 검색하기", "신규가입", "취소", function () {
        var input_send = document.getElementById("input_send");
        if(input_send.value == ""){
            alertMsg("양도할 회원 이름, 고객번호 , 전화번호를 입력해 주세요");
            return;
        }

        //양수인 정보
        getUserData(input_send.value, function(res) {
             clog("res is ", res);
             var code = parseInt(res.code);
             if (code == 100) {
                 clog("회원을 찾았다..");
                 //양도인 정보//나의 생년월일 전화번호를 가져온다.

                 var startdate = res.message[0].mem_endtime && getDDay(res.message[0].mem_endtime) > 0 ? nextDay(res.message[0].mem_endtime.substr(0,10),1) : getToday();
                 var sgab = getDDay(coupon.starttime) > 0 ? getDDay(coupon.starttime) : 0; //회원권 시작일이 오늘보다 미래에 있다.
                 var gabday = getDDay(coupon.endtime)-1-sgab;
                 var enddate = nextDay(startdate,gabday);

                 getUserData(useruid, function(result) {
                     var code = parseInt(result.code);
                     if (code == 100) {
                         var birth = result.message[0].mem_birth;
                         var phone = result.message[0].mem_phone;
                         var parent = input_send.parentNode;


                         var list_tag = getUserTable(useruid,userid,username,birth,phone,coupon,res.message,isremoveremaincount);
                         parent.innerHTML += "<br>"+list_tag+"";

                         var button = document.createElement("button");
                         button.onclick = function(){creatNewUser(useruid,userid,username,coupon,isremoveremaincount)};
                         button.style.float = "right";
                         var textNode = document.createTextNode( '새로운고객등록' );
                         button.appendChild( textNode );
                         parent.appendChild( button );
						 
						 //화면이 안늘어나는 버그때문에 버튼을 없앨 수 없다. 그래서 안보여준다.
						 button.style.marginTop = "-30px";
						 button.style.visibility = "hidden";

                     }

                 });

             }
             else{
                 clog("회원을 찾을수 없다.");
                 creatNewUser(useruid,userid,username,coupon,isremoveremaincount);

             } 


         });
    }, function () {
        creatNewUser(useruid,userid,username,coupon,isremoveremaincount);
    }, function () {
      
        hideModalDialog();
    },style);
}
function CellInsert(brow,isdelete,isselected,tag){
    var cell = brow.insertCell();
    cell.innerHTML = isdelete ? "<del>"+tag+"</del>" : tag;
    if(!isselected)cell.style.backgroundColor = "#dddddd";
}

function creatNewUser(useruid,userid,username,coupon,isremoveremaincount){
     getUserData(useruid, function(res) {
        var birth = res.message[0].mem_birth;
        var phone = res.message[0].mem_phone;
        var startdate = getToday();
        var gabday = coupon ? getDDay(getTotalEndtime(coupon))-1 : 0;
        var enddate = nextDay(startdate,gabday);
         
         
        var new_maxcount = 0;
        if(coupon.mbstype == TYPE_PT){
            new_maxcount  = parseInt(coupon_obj.mbsmaxcount) - parseInt(coupon.usecount);    
        }            
        else if(coupon.mbstype == TYPE_GX){
            var uid_couponid = useruid+"_"+coupon.id;
            var max = getMbsMaxCount(coupon);
            var use = getGXCouponUseCount(uid_couponid,coupon.usecount);
            var reservation = getGXCouponReservationCount(uid_couponid);
            new_maxcount = isremoveremaincount ? max-use : max-use-reservation;
        }
         
        checkInsertUser(useruid,userid,username,birth,phone,startdate,enddate,gabday,coupon,null,isremoveremaincount,new_maxcount);    
     });
}
//회원검색 후에 user 가 null 이면 회원가입화면  : user가 있으면 양도화면으로 다이렉트로 이동
function checkInsertUser(useruid,userid,username,birth,phone,startdate,enddate,gabday,coupon,newuser,isremoveremaincount,new_maxcount){
    
    //initInputSelectYMD
    var newuseruid = "";
    var newuserid = "";
    var newusername = "";
    
    getSettingData(function (res) {
        if (res.code == 100) {
            var setting = res.message.setting;
            var sendprice = setting.sendprice ? setting.sendprice : 0;
            //고객정보가 있다.
            if(newuser){

                newuseruid = newuser.mem_uid;
                newuserid = newuser.mem_userid;
                newusername = newuser.mem_username;
                newuserbirth = newuser.mem_birth;
                newuserphone = newuser.mem_phone;



                var buser = {
                    uid :useruid,
                    id : userid,
                    name : username,
                    birth : birth,
                    phone : phone
                }
                var nuser = {
                    uid :newuseruid,
                    id : newuserid,
                    name : newusername,
                    birth : newuserbirth,
                    phone : newuserphone,
                    startdate : startdate,
                    enddate : enddate,
                    gabday : gabday
                }
                
                /////////////////////////////////////////////////////////////////////////
                //홀딩진행중이라면 해당 홀딩일수를 삭제한다. 그리고 holdingdata = [];로 수정한다.
                /////////////////////////////////////////////////////////////////////////
                var removed_holdingday = removeCouponHoldingDay(coupon);
                nuser.enddate = nextDay(nuser.enddate,-removed_holdingday);
                nuser.gabday = nuser.gabday-removed_holdingday;
                coupon.holdingdata = [];
                coupon.endtime = nextDay(coupon.endtime,-removed_holdingday);
                coupon.holdingday = 0;
                /////////////////////////////////////////////////////////////////////////
                
                
                
        //        sendCouponData(buser,nuser,coupon);
        //          clog("11 coupon is ",buser);
        //           clog("11 coupon is ",nuser);
        //           clog("11 coupon is ",coupon);
        //          clog("dd coupon is ",setJSONStringToParamString(coupon));
                 var params = {"buser": JSON.stringify(buser),"nuser": JSON.stringify(nuser),"coupon": setJSONStringToParamString(coupon),"isremoveremaincount":isremoveremaincount,"newmaxcount":new_maxcount};
                 var centercode = getData("nowcentercode");
                 post_to_url("./send_coupon.php?pagetype=home&centercode="+centercode + "&sendprice=" + sendprice, params);



            }
            //고객정보가 없다. 신규가입을 해야한다.
            else{
        createEmptyUser(function(nuser){
             newuseruid = nuser.uid;
             newuserid = nuser.id;
             newusername = nuser.name;
             newuserbirth = nuser.birth;
             newuserphone = nuser.phone;
           
            nuser.gabday = gabday;
             var buser = {
                uid :useruid,
                id : userid,
                name : username,
                birth : birth,
                phone : phone,
                gabday : gabday 
            }
            var params = {"buser": JSON.stringify(buser),"nuser": JSON.stringify(nuser),"coupon": setJSONStringToParamString(coupon),"isremoveremaincount":isremoveremaincount,"newmaxcount":new_maxcount};
            var centercode = getData("nowcentercode");
            post_to_url("./send_coupon.php?pagetype=home&centercode="+centercode + "&sendprice=" + sendprice, params);
            
             hideModalDialog();
             hideModalDialog();    
             hideModalDialog();    
        });
    }
        }
    });
}
//양도할때 홀딩기간 진행중이라면 삭제한다.
//return 삭제한 홀딩일수
function removeCouponHoldingDay(coupon){
    var removed_holdingday = 0;
    if(coupon.holdingdata){
        for(var i = 0 ; i < coupon.holdingdata.length;i++){
            var hday = getDDay(coupon.holdingdata[i].holding_endtime);
            if(coupon.holdingdata[i].requestype == "H" && coupon.holdingdata[i].status == "Y" && hday > 0 ){
                removed_holdingday += hday;                
            }
        }
    }   
    return removed_holdingday;
}
function createEmptyUser(callback){
    var now = new Date();
        var year = now.getFullYear();
        var ytag = "<option>년도</option>";
        var mtag = "<option>월</option>";
        var dtag = "<option>일</option>";
        for(var i = 0 ; i < 100; i++){
            var val = year-i;
            ytag += "<option value='"+val+"'>"+val+"년</option>";
        }
        
        for(var i = 1 ; i <= 12; i++){
            mtag += "<option value='"+i+"'>"+i+"월</option>";
        }
        
        for(var i = 1 ; i <= 31; i++){
            dtag += "<option value='"+i+"'>"+i+"일</option>";
        }
        var title = "<text >신규 가입하기</text><button onclick='hideModalDialog()' class='btn' style='float:right;cursor:pointer;'><i class='fa-solid fa-x''></i></button>";
        var message = "<div style='padding:20px'>"+ 
                        "<div align='left' style='width:520px;height:95px;background-color:#f1faff;border:1px solid #3cb5f9;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed;padding:10px 20px 10px 20px;margin-bottom:20px'>"+
                            "<text style='font-size: 14px; color:#181c32;text-align:left; font-weight:700;line-height:1.5;'>회원정보가 없어 신규가입을 합니다.</text><br>"+           
                            "<div style='margin-top:5px'>"+
                                "<text style='color:#009ef7'>•</text>&nbsp;&nbsp;<text style='font-size: 13px; color:#3f4254;text-align:left; font-weight:400;line-height:1.5;'>기본비밀번호는 전화번호 <span style='font-weight:700'>뒤 4자리</span>로 설정됩니다.</text><br>"+           
                                "<text style='color:#009ef7'>•</text>&nbsp;&nbsp;<text style='font-size: 13px; color:#3f4254;text-align:left; font-weight:400;line-height:1.5;'>전화번호가 입력되지 않으면 <span style='font-weight:700'>'0000'</span>으로 설정됩니다.</text><br>"+       
                            "</div>"+
                        "</div>"+            
                        "<table style='width:100%;margin-top:10px'>"+
                            "<tr>"+
                                "<td  style='width:50%;'>"+
                                    "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>*이름</label>"+
                                "</td>"+
                                "<td  style='width:50%;'>"+
                                    "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>*생년월일</label>"+
                                "</td>"+
                             "</tr>"+
                             "<tr>"+
                                "<td  style='width:50%;padding-right:12px;height:50px'>"+
                                    "<input type='text' class='form-control myinputtype' id='name' name='name' placeholder='예) 홍길동' required>"+
                                "</td>"+
                                "<td  style='width:50%'>"+
                                    "<div class='form-control myinputtype'>"+
                                        "<div id='bir_wrap' name='bir_wrap' style='margin-top:-5px'>"+
                                            "<span class='box'>"+
                                                "<select id='yy' style='width:85px;border:0px'>"+ytag+"</select>"+
                                            "</span>&nbsp;"+
                                            "<span class='box'>"+
                                                "<select id='mm' style='width:70px;border:0px'>"+mtag+"</select>"+
                                            "</span>&nbsp;"+
                                            "<span class='box'>"+
                                                "<select id='dd' style='width:70px;border:0px'>"+dtag+"</select>"+
                                            "</span>"+
                                        "</div>"+
                                        "<span class='error_next_box'></span>"+
                                    "</div>"+
                                "</td>"+
                             "</tr>"+
                             "<tr><td colspan='2' style='height:20px'></td></tr>"+          
                              
                             "<tr style='margin-top:20px'>"+
                                "<td  style='width:50%'>"+
                                    "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>*휴대폰 번호</label>"+
                                "</td>"+
                                "<td  style='width:50%'>"+
                                   "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>*성별</label>"+                               
                                "</td>"+
                             "</tr>"+
                             "<tr>"+
                                "<td  style='width:50%;padding-right:12px;height:60px'>"+
                                    "<input type='number' class='form-control myinputtype' maxlength='11' id='phone' name='mobile' onkeyup='maxLengthCheck(\"phone\")' placeholder='숫자만 입력..' style='padding:13px' required>"+
                                "</td>"+
                                "<td  style='width:50%'>"+
                                    "<div class='form-control myinputtype'>"+
                                        "<input id='gender_m' type='radio' name='gender' value='M' style='margin-top:10px' checked><label for='gender_m'>남</label>&nbsp;&nbsp;<input id='gender_f' type='radio' name='gender' value='F'><label for='gender_f'>여</label>&nbsp;&nbsp;"+
                                    "</div>"+
                                "</td>"+
                             "</tr>"+
                             "<tr><td colspan='2' style='height:20px'></td></tr>"+          
                             "<tr>"+
                                 "<td colspan='2' id='td_address1'>"+
                                    "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>주소</label>"+          
                                 "</td>"+ 
                            "</tr>"+
                             "<tr>"+
                                 "<td colspan='2' id='td_address2'>"+
                                        "<input type='text' class='form-control myinputtype' id='home_address' name='home_address' placeholder='ex) 서울시 중구 태평로1가 11번지...' required>"+
                                 "</td>"+
                             "</tr>"+
                            "<tr><td colspan='2' style='height:20px'></td></tr>"+          
                             "<tr>"+
                                 "<td colspan='2'  id='td_note' >"+
                                    "<label style='font-size:15px; color:#181c32;text-align:left; font-weight:500;'>특이사항</label>"+       
                                 "</td>"+
                             "</tr>"+
                             "<tr>"+
                                 "<td colspan='2' id='td_note' >"+
                                        "<input type='text' class='form-control myinputtype' id='note' name='note' placeholder='기타특이사항 입력...' required>"+
                                 "</td>"+                                 
                             "</tr>"+                             
                        "</table>"+
                    "</div>";
        
         var style = {
            bodycolor: "white",
             marginTop:"0px",
            size: {
                width: "580px",
                height: "auto"
            },
            top:{
                 color:"#262930",
                 textAlign:"left",
                 paddingLeft:"25px",
                 borderBottom: "1px solid #dddddd"
             },
        };
    clog("title "+title)
    clog("message ",message);
    
        showModalDialog(document.body, "신규 가입하기", message, "신규가입하기", "취소", function() {
             var name = document.getElementById("name").value;
             var yy = document.getElementById('yy').value;
             var mm = document.getElementById('mm').value < 10 ? "0" + document.getElementById('mm').value : document.getElementById('mm').value;
             var dd = document.getElementById('dd').value < 10 ? "0" + document.getElementById('dd').value : document.getElementById('dd').value;
             var birth = yy + mm + dd + "";
             
             var phone = document.getElementById("phone").value;
             var gender_m = document.getElementById('gender_m');
             var gender_f = document.getElementById('gender_f');
             var gender = gender_m.checked ? "M" : "F";
             var home_address = document.getElementById("home_address").value;
             var note = document.getElementById("note").value;
             
             
             if(name == "" || yy == "" || mm == "" || dd == "" || phone == "" || home_address == ""){
                 if(name == "")
                     alertMsg("이름을 입력해 주세요");
                 else if(yy == "" || mm == "" || dd == "")
                     alertMsg("생년월일을 제대로 입력해 주세요");
                 else if(phone == "")
                     alertMsg("전화번호를 제대로 입력해 주세요");
                 else if(home_address == "")
                     alertMsg("주소를 제대로 입력해 주세요");
                 
                 return;
             }
             if (phone.length < 11) {
                alertMsg("전화번호는 - 없이 11자리를 입력해 주세요.");
                  return;
             }
             
             var value = {
                 name : name,
                 birth : birth,
                 phone : phone, 
                 gender : gender,
                 homeaddress : home_address,
                 note : note
             }
             createUser(value,function(message,data){
                 if(message == "success"){
               
                     
                     var nuser = {
                        uid :data.uid,
                        id : data.id,
                        name : data.name,
                        birth : data.birth,
                        phone : data.phone
                    }

                     callback(nuser);
                    
                 }else {
                     alertMsg("가입되지 않았습니다. ",data);
                     hideModalDialog();
                 }
             });
             
             
        }, function() {
             hideModalDialog();
             hideModalDialog();
        },style);
}
function createUser(value,callback){
     var groupcode = getData("nowgroupcode");
     var centercode = getData("nowcentercode");

     var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :"createuser",
        value : value
    }

     CallHandler("adm_get", senddata, function (res) {
       if(res.code == 100){
           callback("success",res.message);
       }else {
           callback("error",null);
       }

    }, function (err) {callback("error",err);});
}
function getUserTable(useruid,userid,username,birth,phone,coupon,rows,isremoveremaincount){
    
//    rows.sort(sort_by('pm_date', true, (a) => a.toUpperCase()));
    var div_member_table =document.createElement("div");
    var table = document.createElement("table");
    div_member_table.appendChild(table);

    table.border = "1";
    table.style.width = "100%";
	table.style.marginTop = "40px";
    table.style.textAlign = "center";
    table.className="table table-bordered fmont";


    table.innerHTML = "<thead><tr style='background-color:#f8f9fa;height:40px'><th style='width:100px'>이름</th><th style='width:100px'>고객번호</th><th style='width:100px'>전화번호</th><th style='width:80px'>선택</th></tr></tr></thead><tfoot></tfoot><tbody></tbody>";
    var head = table.getElementsByTagName("thead")[0];
    var body = table.getElementsByTagName("tbody")[0];
   var isdelete = false;
    var isselected = true;
    var foot = table.getElementsByTagName("tfoot")[0];
    var len = rows.length;
    if (len > 0) {
        var beforepaymentid = "";
        var isbeforesame = false;
        for (var i = 0; i < len; i++) {
            var user = rows[i];
            var brow = body.insertRow();
            brow.align = "center";
            brow.style.padding= "10px";
            brow.style.backgroundColor = "white";
            brow.style.height = "40px";
            
            var newuser = {"mem_uid": user.mem_uid,"mem_userid": user.mem_userid,"mem_username": user.mem_username,"mem_birth": user.mem_birth,"mem_phone": user.mem_phone,"mem_endtime": user.mem_endtime};
            
           
            clog("양도 coupon ",coupon);
            var button_tag = "<button class='btn ' onclick='checkInsertUserString(\"" +useruid + "\",\"" +userid + "\",\"" +username + "\",\"" +birth + "\",\"" +phone + "\", \""+setJSONStringToParamString(coupon)+"\",\""+setJSONStringToParamString(newuser)+"\","+isremoveremaincount+")'   style='border:0px;width:60px;font-size:14px;background-color:#116666;color:white'  >선택</button>";   
            
            CellInsert(brow,isdelete,isselected,user.mem_username); // 결제일
            CellInsert(brow,isdelete,isselected,user.mem_userid); // 구분
//            CellInsert(brow,isdelete,isselected,user.mem_birth);// 생년월일
            CellInsert(brow,isdelete,isselected,user.mem_phone);// 전화번호
            CellInsert(brow,isdelete,isselected,button_tag);//결제항목
  
        }
    }
    return div_member_table.innerHTML;  
  
}
function checkInsertUserString(useruid,userid,username,birth,phone,coupon,newuser,isremoveremaincount){  //isremoveremaincount 1 or 0  기존회원남아있는 예약신청한거 
    var coupon_obj = coupon ? JSON.parse(coupon) : null;
    var user_obj = newuser ? JSON.parse(newuser) : null;
    
    
    var startdate = user_obj.mem_endtime && getDDay(user_obj.mem_endtime) > 0 ? nextDay(user_obj.mem_endtime.substr(0,10),1) : getToday();
    var sgab = getDDay(coupon_obj.starttime) > 0 ? getDDay(coupon_obj.starttime) : 0; //회원권 시작일이 오늘보다 미래에 있다.
    var gabday = getDDay(coupon_obj.endtime)-1-sgab;
    var enddate = nextDay(startdate,gabday);
    
    var new_maxcount = 0;
    if(coupon_obj.mbstype == TYPE_PT){
        new_maxcount  = parseInt(coupon_obj.mbsmaxcount) - parseInt(coupon_obj.usecount);    
    }            
    else if(coupon_obj.mbstype == TYPE_GX){
        var uid_couponid = useruid+"_"+coupon_obj.id;
        var max = getMbsMaxCount(coupon_obj);
        var use = getGXCouponUseCount(uid_couponid,coupon_obj.usecount);
        var reservation = getGXCouponReservationCount(uid_couponid);
        new_maxcount = isremoveremaincount ? max-use : max-use-reservation;
    }

    checkInsertUser(useruid,userid,username,birth,phone,startdate,enddate,gabday,coupon_obj,user_obj,isremoveremaincount,new_maxcount);
    
}
function getSettingData(success, error) {

    var groupcode = getData("nowgroupcode");
    var centercode = getData("nowcentercode");

    var senddata = {
        groupcode: groupcode,
        centercode: centercode,
        type: "getsetting"
    };
    CallHandler("adm_get", senddata, function (res) {

        if (success) success(res);

    }, function (err) {
        if (error) error(err);
    });
}

function getRemovePTCountData(useruid,removeptid,callback){
     var obj = new Object();
     obj.useruid = useruid;
     obj.removeptid = removeptid;
     if(removeptid){
        var _data = {
            "type": "getremoveptcountdata", // group or center or auth
            "centercode": getData("nowcentercode"),
            "value" : obj
        };
        CallHandler("getdata", _data, function (res) {
            code = parseInt(res.code);
            clog("setMembership res is ", res);
            if (code == 100) {
                callback(res.message);

            } else {
                callback(null);
            }

        }, function (err) {
             callback(null);

        });    
     }else {
         callback(null);
     }
     
}
//잔여 세션 소진 확약서
function showRemovePTCount(data,myinfo,before_remove_pt_status,rmptdata){
            var message = document.createElement("div");
            message.style.width = "100%";
            
            var checkbox_checked = before_remove_pt_status > 0 ? "checked" : "";
    
            var useruid = myinfo.mem_uid;
            var username = myinfo.mem_username;
            var userid = myinfo.mem_userid; 
            var phone = myinfo.mem_phone;
            
            clog("data ",data);
            
            var managername = data.manager ? data.manager : "";
            var managerid = data.managerid ? data.managerid : "";
            var constructor = data.constructorname ? data.constructorname : "알수 없음"; //uid
            
            var coupon_id = data.id ? data.id : "";
            var signid = dateToTimestamp(coupon_id);
            var today = getToday();
            var stime = data.starttime.substring(0,10);
            var etime = data.endtime.substring(0,10);
            var maxcount = getMbsMaxCount(data);
            var usecount = parseInt(data.usecount);
            var remaincount = maxcount - usecount;
            //var vat = parseInt(data.paymenttype) == 1 ? 11 : 10;
            var vat = parseInt(data.paymenttype) == 1 ? global_vat : 10;
            
            var totalprice = parseInt(data.mbsprice);
            var price1set = (parseInt(data.mbsprice)/vat*10)/maxcount;
            var refundprice = data.refundprice ? data.refundprice : "0";
            var txt_paymenttype = ["무료","카드결제","현금결제"];
            var paytext = data.paymenttype ? txt_paymenttype[parseInt(data.paymenttype)] : "";
            var signpath = "../../../ssapi/"+myinfo.mem_sign;
    
            
            var manager_birth = "";
            var manager_phone = "";
    
            var ischangeinputbox = "";
            
            var signtag = "";
            var singdataname = "";
            var signdatasign = "";
            var request_date = today;
            if(rmptdata && before_remove_pt_status > 0 ){
                checkbox_checked = "checked";
                manager_birth = rmptdata.rmpt_managerbirth;
                manager_phone = rmptdata.rmpt_managerphone;  
                remaincount = rmptdata.rmpt_removecount;
                request_date = rmptdata.rmpt_nowdate;
                ischangeinputbox = "disabled";
                var signid = dateToTimestamp(rmptdata.rmpt_nowdate);
                signdataname = "<img src='../../../ssapi/"+rmptdata.rmpt_signpath+"/"+signid+"_removept_name.png' style='width:100%'/>";
                signdatasign = "<img src='../../../ssapi/"+rmptdata.rmpt_signpath+"/"+signid+"_removept_sign.png' style='width:100%'/>";
                
                signtag = "<tr>"+
                                "<td style='width:50%'>"+                                    
                                    "<label class='textevent'>※이름 입력란</label>"+
                                "</td>"+
                                "<td style='width:50%'>"+                                    
                                    "<label class='textevent'>※서명란</label>"+
                                "</td>"+                                    
                            "<tr>"+
                            "<tr><td><div class='form-control' style='width:100%;height:auto'>"+signdataname+"</div></td><td><div class='form-control' style='width:100%;height:auto'>"+signdatasign+"</div></td><tr>";
                
               
            }
//     clog("signtag is ",signtag);
            var removeptcountdesc = "<style>.textevent {border-top: 1px solid #b2dba1;border-bottom: 1px solid #b2dba1;background-image: linear-gradient(to bottom, #dff0d8 0px, #c8e5bc 100%);background-repeat: repeat-x;color: #3c763d;border-width: 1px;font-size: 1em;padding: 0 .75em;line-height: 2em;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;margin-bottom: 1px;width:100%;}</style>"+
            
            "<div style='background-color:#f5f8fa;width:94%; height:250px; overflow:auto; padding:3%; margin:0 auto'><text style='color:#5e6278;font-size:15px;line-height:1.5'>• P.T계약서에2번 약관에 따라 Session을 정해진 계약기간내에 회원이 소진하지 않았을 경우담당 트레이너는 잔여 Session에 대해 소진,계약만료 할 수 있다.<br>• 이때에 잔여 Session에 대해서 회원(계약당사자)에게 충분한 설명을 하고 동의를 구한 후에야 소진 시킬 수 있다.<br>• 소진 시키는  Session에 대해서 회원(계약당사자)은 잔여  Session에 관한 일체의 권리를포기함에 있고 트레이너는 아래와 같이 서명함으로써 추후에 PT잔여 Session에 관련된 어떠한 법적분쟁이나 문제를 일으키지 않을 것이며 또한, 잔여 Session 소진은 회원과 트레이너 간의 합의에의한 것으로 BLACK GYM은 그에 대한 하등의 책임이 없음을 확약합니다.</text></div>";
            message.innerHTML+="<br><div align='left'  style='width:100%;' >"+
                removeptcountdesc+
                "<br><p align='center'><input type='checkbox' id='check_removept_desc' "+checkbox_checked+" "+ischangeinputbox+">&nbsp;<text style='color:#262930;font-size:15px;font-weight:500'>규정에 관한 설명을 충분히 들었으며 이에 동의합니다.</text></p>"+
                    "<div align='left' >"+                    
                        "<div id='pt_formdiv' style='padding-top:30px;padding-left:20px;padding-right:20px;padding-bottom:10px;'>"+
                            "<div style='width:100%;height:600px'>"+
    
                                "<div style='width:100%;height:160px;border:1px solid #eff2f5;border-radius:8px;padding:0px 15px 0px 15px'>"+
                                     "<table align='left' style='width:100%;height:auto;height:auto'>"+
                                         "<tr style='height:50px;border-bottom:1px dashed #eff2f5'>"+
                                            "<td colspan='3'>"+                                    
                                                "<text style='font-size:18px;color#262930;font-weight:700'>트레이너 정보</text>"+
                                            "</td>"+
                                        "</tr>"+
                                         "<tr style='height:50px;'>"+
                                            "<td style='width:33%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>이름</text>"+
                                            "</td>"+
                                            "<td style='width:33%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>주민등록번호</text>"+
                                            "</td>"+
                                            "<td style='width:33%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>연락처</text>"+
                                            "</td>"+                                    
                                        "</tr>"+
                                        "<tr>"+
                                            "<td style='padding-right:10px'>"+ 
                                                "<text class='form-control' id='removept_managername' placeholder='ex) 홍길동' align='center-vertical' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px' value='"+managername+"'>"+managername+"</text>"+
                                            "</td>"+
                                            "<td style='padding-right:10px'>"+
                                                "<input type='number' class='form-control' id='removept_managerbirth' name='pt_phone' placeholder='주민번호를 입력하세요' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+manager_birth+"' "+ischangeinputbox+"/>"+
                                            "</td>"+ 
                                            "<td>"+
                                                "<input type='number' class='form-control' id='removept_managerphone' name='pt_phone' placeholder='010-1234-5678' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px' value='"+manager_phone+"' "+ischangeinputbox+">"+
                                            "</td>"+ 
                                        "</tr>"+
                                    "</table>"+
                                "</div>"+
                                "<div style='margin-top:30px;width:100%;height:400px;border:1px solid #eff2f5;border-radius:8px;padding:0px 15px 0px 15px'>"+
                                    "<table style='width:100%;height:auto'>"+
                                         "<tr style='height:50px;border-bottom:1px dashed #eff2f5'>"+
                                            "<td colspan='2'>"+                                    
                                                "<text style='font-size:18px;color#262930;font-weight:700'>회원 정보</text>"+
                                            "</td>"+
                                        "</tr>"+
                                        "<tr style='height:50px'>"+
                                            "<td style='width:50%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>이름</text>"+
                                            "</td>"+
                                            "<td style='width:50%'>"+                                    
                                               "<text style='font-size:15px;color#3f4254;font-weight:500'>연락처</text>"+
                                            "</td>"+                                    
                                        "</tr>"+
                                         "<tr>"+
                                             "<td style='padding-right:10px'>"+ 
                                                "<text class='form-control' id='pt_name' name='pt_name' placeholder='ex) 홍길동' align='center-vertical' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+username+"'>"+username+"</text>"+
                                            "</td>"+
                                            "<td>"+
                                                "<text class='form-control' id='pt_phone' name='pt_phone' placeholder='ex) 010-1234-5678' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+phone+"'>"+phone+"</text>"+
                                            "</td>"+ 
                                        "</tr>"+
                                        "<tr style='height:50px'>"+
                                            "<td style='width:50%'>"+ 
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>* P.T 시작일</text>"+                                                
                                            "</td>"+
                                            "<td style='width:50%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>* P.T 종료일</text>"+
                                            "</td>"+                                    
                                        "</tr>"+
                                        "<tr>"+
                                             "<td style='padding-right:10px'>"+ 
                                                    "<text class='form-control' id='pt_starttime' name='pt_starttime' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+stime+"'>"+stime+"</text>"+
                                            "</td>"+
                                            "<td>"+
                                                    "<text class='form-control' id='pt_endtime' name='pt_endtime' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+etime+"'>"+etime+"</text>"+
                                            "</td>"+ 
                                        "</tr>"+

                                        "<tr style='height:50px'>"+
                                            "<td style='width:50%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>총 Session</text>"+
                                            "</td>"+
                                            "<td style='width:50%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>진행 Session</text>"+
                                            "</td>"+                                    
                                        "</tr>"+
                                        "<tr>"+
                                             "<td style='padding-right:10px'>"+ 
                                                 "<div class='form-control'>"+                                                
                                                    "<text id='pt_count' type='number' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+maxcount+"' >"+maxcount+"회</text>"+
                                                 "</div>"+
                                            "</td>"+
                                            "<td>"+
                                                "<div class='form-control'>"+  
                                                    "<text id='pt_usecount' type='number' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+usecount+"' >"+usecount+"회</text>"+   
                                                "</div>"+
                                            "</td>"+ 
                                        "</tr>"+

                                        "<tr style='height:50px'>"+
                                            "<td style='width:50%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>소진 신청일</text>"+
                                            "</td>"+
                                            "<td style='width:50%'>"+                                    
                                                "<text style='font-size:15px;color#3f4254;font-weight:500'>소진 Session</text>"+
                                            "</td>"+                                    
                                        "</tr>"+
                                        "<tr>"+
                                             "<td style='padding-right:10px'>"+ 

                                                    "<text class='form-control' id='pt_today' name='pt_starttime' style='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278' value='"+request_date+"'>"+request_date+"</text>"+

                                            "</td>"+
                                            "<td>"+
                                                "<div class='form-control' style ='font-size:14px;color:#262930;background-color:#f5f8fa;border:0px;placeholder-color:#5e6278'>"+  
                                                    "<input id='pt_remaincount' type='number' style='width:100px;margin-top:-3px' value='"+remaincount+"' "+ischangeinputbox+"/>회"+   
                                                "</div>"+
                                            "</td>"+ 
                                        "</tr>"+
                                    
                                    "</table>"+                                    
                                 "</div>"+
                                 "<div style='margin-top:30px;width:100%;height:700px;'>"+ 
                                    "<table style='width:100%;height:auto'>"+
                                            signtag+
                                    "</table>"+
                                 "</div>"+
                            "</div>"+
                        "</div>"+ 
                     "</div>"+
                "</div><br>";
               
                
                var style = {
                     modaltype:"large",
                     marginTop:"0px",
                     bodycolor:"#ffffff",
                     size:{
                         width:"95%",
                         maxWidth:"960px",
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
                var centername = getData("nowcentername");
    
                if(before_remove_pt_status > 0 ){
                    showModalDialog(document.body, centername+" 잔여 세션 소진확약서",  message.innerHTML,"확인", null, function() {
                       hideModalDialog();
                    }, function() {}, style);      
                }else {
                    showModalDialogPTJoin(document.body, centername+" 잔여 세션 소진확약서",  message.innerHTML,"pt_join_script.php?ver1.01", "신청하기", "취소", function() {
                       check_removeptdata(coupon_id,managerid,managername,useruid,username,phone,stime,etime,maxcount,usecount);

                    }, function() {hideModalDialog();}, style);     
                }
                     
    
                
     
        }//잔여횟수 차감 
        function check_removeptdata(coupon_id, managerid,managername,useruid,username,userphone,stime,etime,maxcount,usecount){
            
            var obj = new Object();
            obj.centercode = getData("nowcentercode");
            obj.managerid = managerid;
            obj.managername = managername;
            obj.managername = managername;
            obj.useruid = useruid;
            obj.username = username;
            obj.userphone = userphone;
            obj.starttime = stime;
            obj.endtime = etime;
            obj.maxcount = maxcount;
            obj.usecount = usecount;
            obj.removecount = document.getElementById("pt_remaincount").value;
            obj.couponid = coupon_id;
            obj.check_removept_desc = document.getElementById("check_removept_desc").checked;
            obj.managerbirth = document.getElementById("removept_managerbirth").value;
            obj.managerphone = document.getElementById("removept_managerphone").value;
            obj.signdataname1 = signaturePadName1.toDataURL('image/png');
            obj.signdatasign1 = signaturePadSign1.toDataURL('image/png');
            
            obj.removeptstatus = 1; // 1 : 신청함  2: 관리자가 승인함
            obj.note = ""; //특이사항 입력
            if(!obj.check_removept_desc || !obj.managerbirth || !obj.managerphone || signaturePadName1.isEmpty() || signaturePadSign1.isEmpty()){
                    if(!obj.check_removept_desc){
                         alertMsg("잔여세션 소진확인 체크박스에 체크해 주세요.");
                    }else if(!obj.managerbirth){
                        alertMsg("주민등록번호를 입력해주세요.");     
                    }else if(!obj.managerphone){
                        alertMsg("전화번호를 입력해주세요.");     
                    }else if (signaturePadName1.isEmpty()){
                        alertMsg("이름서명이 필요합니다.");
                    }else if (signaturePadSign1.isEmpty()){
                        alertMsg("서명이 필요합니다.");
                    }                
                    return;
            } 
            showModalDialog(document.body, "잔여세션 소진신청", username+"님의 잔여 Session("+obj.removecount+"회) 소진 신청을 하시겠습니까?", "신청하기", "취소", function() {
              
                var _data = {
                    "type": "removeptcount", // group or center or auth
                    "centercode": getData("nowcentercode"),
                    "value" : obj
                };
                CallHandler("getdata", _data, function (res) {
                    code = parseInt(res.code);
                    clog("setMembership res is ", res);
                    if (code == 100) {
                        sendPushToOwner("잔여세션 소진신청",managername+" 님이 "+username+" 회원의  잔여세션("+obj.removecount+"회)을 소진신청하였습니다. 어드민 페이지[잔여세션 소진신청] 에서 확인해 주세요");
                        alertMsg("성공적으로 신청하였습니다.",function(){
                            refresh_page();
                        });
                       
                    } else {
                        alertMsg(res.message);
                    }

                }, function (err) {
                    alertMsg("네트워크 에러 ");

                });
               
                    
            }, function() {hideModalDialog();});
        }


function getCashIcon(type){
     var icon_img = "";
        switch(parseInt(type)){
            case 0:
                icon_img = "<img src ='./img/icon_free_img.png'>";
                break;
            case 1:
                icon_img = "<img src ='./img/icon_card_img.png'>";
                break;
            case 2:
                icon_img = "<img src ='./img/icon_cash_img.png'>";
                break;
            case 3:
                icon_img = "<img src ='./img/icon_cashsend_img.png'>";
                break;
                
        }
    return icon_img;
}
function parseCommaInt(_x) {
    if(_x == "")_x = "0";
    
    var x = _x+"";
    var isminus = x.indexOf("-") >= 0 ? true : false;
    x = x.replace(/[^0-9]/g,'');   // 입력값이 숫자가 아니면 공백
    x = x.replace(/,/g,'');          // ,값 공백처리
    
    if(isminus)
        return -parseInt(x);
    else 
        return parseInt(x);
}
function inputChangeComma(id){
    
    var input = document.getElementById(id);
    var x = input.value ? input.value : "0";
      x = x.replace(/[^0-9]/g,'');   // 입력값이 숫자가 아니면 공백
      x = x.replace(/,/g,'');          // ,값 공백처리
    input.value = CommaString(parseInt(x));
}
function maxLengthCheck(object){
   if (object.value.length > object.maxLength){
    object.value = object.value.slice(0, object.maxLength);
   }   
  }
//function new_Date(mdate){
//    if(!mdate)
//        moment();
//    else {
////        var arr = mdate.split(/:| /);
////        var m = parseInt(arr[1])-1;
////        var h = arr[3] ? arr[3] : 0;
////        var i = arr[4] ? arr[4] : 0;
////        var s = arr[5] ? arr[5] : 0;
////        new Date(arr[0],m,arr[2],h,i,s);
//        moment(mdate);
//    }
//        
//}
function getPaymentData(groupcode,centercode,value,callback){

        
        
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"getpaymentdata",
            value:value
        };
//        clog("year is ",v);
        CallHandler("adm_get", senddata, function (res) {
           callback(res);
        }, function (err) { 
            alertMsg(err);
        });
    }


function holidayCheckNoText(){
        var allblock = document.getElementsByClassName("calendar-day");
        var yholiday = ["_1_1 ","_3_1 ","_5_5 ","_6_6 ","_8_15 ","_10_3 ","_10_9 ","_12_25 "];
        var uholiday = ['2000_2_4 ', '2000_2_5 ', '2000_2_6 ', '2000_5_11 ', '2000_9_11 ', '2000_9_12 ', '2000_9_13 ', '2001_1_23 ', '2001_1_24 ', '2001_1_25 ', '2001_5_1 ', '2001_9_30 ', '2001_10_1 ', '2001_10_2 ', '2002_2_11 ', '2002_2_12 ', '2002_2_13 ', '2002_5_19 ', '2002_9_20 ', '2002_9_21 ', '2002_9_22 ', '2003_1_31 ', '2003_2_1 ', '2003_2_2 ', '2003_5_8 ', '2003_9_10 ', '2003_9_11 ', '2003_9_12 ', '2004_1_21 ', '2004_1_22 ', '2004_1_23 ', '2004_5_26 ', '2004_9_27 ', '2004_9_28 ', '2004_9_29 ', '2005_2_8 ', '2005_2_9 ', '2005_2_10 ', '2005_5_15 ', '2005_9_17 ', '2005_9_18 ', '2005_9_19 ', '2006_1_28 ', '2006_1_29 ', '2006_1_30 ', '2006_5_5 ', '2006_10_5 ', '2006_10_6 ', '2006_10_7 ', '2007_2_17 ', '2007_2_18 ', '2007_2_19 ', '2007_5_24 ', '2007_9_24 ', '2007_9_25 ', '2007_9_26 ', '2008_2_6 ', '2008_2_7 ', '2008_2_8 ', '2008_5_12 ', '2008_9_13 ', '2008_9_14 ', '2008_9_15 ', '2009_1_25 ', '2009_1_26 ', '2009_1_27 ', '2009_5_2 ', '2009_10_2 ', '2009_10_3 ', '2009_10_4 ', '2010_2_13 ', '2010_2_14 ', '2010_2_15 ', '2010_5_21 ', '2010_9_21 ', '2010_9_22 ', '2010_9_23 ', '2011_2_2 ', '2011_2_3 ', '2011_2_4 ', '2011_5_10 ', '2011_9_11 ', '2011_9_12 ', '2011_9_13 ', '2012_1_22 ', '2012_1_23 ', '2012_1_24 ', '2012_5_28 ', '2012_9_29 ', '2012_9_30 ', '2012_10_1 ', '2013_2_9 ', '2013_2_10 ', '2013_2_11 ', '2013_5_17 ', '2013_9_18 ', '2013_9_19 ', '2013_9_20 ', '2014_1_30 ', '2014_1_31 ', '2014_2_1 ', '2014_5_6 ', '2014_9_7 ', '2014_9_8 ', '2014_9_9 ', '2015_2_18 ', '2015_2_19 ', '2015_2_20 ', '2015_5_25 ', '2015_9_26 ', '2015_9_27 ', '2015_9_28 ', '2016_2_7 ', '2016_2_8 ', '2016_2_9 ', '2016_5_14 ', '2016_9_14 ', '2016_9_15 ', '2016_9_16 ', '2017_1_27 ', '2017_1_28 ', '2017_1_29 ', '2017_5_3 ', '2017_10_3 ', '2017_10_4 ', '2017_10_5 ', '2018_2_15 ', '2018_2_16 ', '2018_2_17 ', '2018_5_22 ', '2018_9_23 ', '2018_9_24 ', '2018_9_25 ', '2019_2_4 ', '2019_2_5 ', '2019_2_6 ', '2019_5_12 ', '2019_9_12 ', '2019_9_13 ', '2019_9_14 ', '2020_1_24 ', '2020_1_25 ', '2020_1_26 ', '2020_4_30 ', '2020_9_30 ', '2020_10_1 ', '2020_10_2 ', '2021_2_11 ', '2021_2_12 ', '2021_2_13 ', '2021_5_19 ', '2021_9_20 ', '2021_9_21 ', '2021_9_22 ', '2022_1_31 ', '2022_2_1 ', '2022_2_2 ', '2022_5_8 ', '2022_6_1 ', '2022_9_9 ', '2022_9_10 ', '2022_9_11 ', '2023_1_21 ', '2023_1_22 ', '2023_1_23 ', '2023_5_27 ', '2023_9_28 ', '2023_9_29 ', '2023_9_30 ', '2024_2_9 ', '2024_2_10 ', '2024_2_11 ', '2024_5_15 ', '2024_9_16 ', '2024_9_17 ', '2024_9_18 ', '2025_1_28 ', '2025_1_29 ', '2025_1_30 ', '2025_5_5 ', '2025_10_5 ', '2025_10_6 ', '2025_10_7 ', '2026_2_16 ', '2026_2_17 ', '2026_2_18 ', '2026_5_24 ', '2026_9_24 ', '2026_9_25 ', '2026_9_26 ', '2027_2_6 ', '2027_2_7 ', '2027_2_8 ', '2027_5_13 ', '2027_9_14 ', '2027_9_15 ', '2027_9_16 ', '2028_1_26 ', '2028_1_27 ', '2028_1_28 ', '2028_5_2 ', '2028_10_2 ', '2028_10_3 ', '2028_10_4 ', '2029_2_12 ', '2029_2_13 ', '2029_2_14 ', '2029_5_20 ', '2029_9_21 ', '2029_9_22 ', '2029_9_23 ', '2030_2_2 ', '2030_2_3 ', '2030_2_4 ', '2030_5_9 ', '2030_9_11 ', '2030_9_12 ', '2030_9_13 ', '2031_1_22 ', '2031_1_23 ', '2031_1_24 ', '2031_5_28 ', '2031_9_30 ', '2031_10_1 ', '2031_10_2 ', '2032_2_10 ', '2032_2_11 ', '2032_2_12 ', '2032_5_16 ', '2032_9_18 ', '2032_9_19 ', '2032_9_20 ', '2033_1_30 ', '2033_1_31 ', '2033_2_1 ', '2033_5_6 ', '2033_10_6 ', '2033_10_7 ', '2033_10_8 ', '2034_2_18 ', '2034_2_19 ', '2034_2_20 ', '2034_5_25 ', '2034_9_26 ', '2034_9_27 ', '2034_9_28 ', '2035_2_7 ', '2035_2_8 ', '2035_2_9 ', '2035_5_15 ', '2035_9_15 ', '2035_9_16 ', '2035_9_17 ', '2036_1_27 ', '2036_1_28 ', '2036_1_29 ', '2036_5_3 ', '2036_10_3 ', '2036_10_4 ', '2036_10_5 ', '2037_2_14 ', '2037_2_15 ', '2037_2_16 ', '2037_5_22 ', '2037_9_23 ', '2037_9_24 ', '2037_9_25 ', '2038_2_3 ', '2038_2_4 ', '2038_2_5 ', '2038_5_11 ', '2038_9_12 ', '2038_9_13 ', '2038_9_14 ', '2039_1_23 ', '2039_1_24 ', '2039_1_25 ', '2039_4_30 ', '2039_10_1 ', '2039_10_2 ', '2039_10_3 ', '2040_2_11 ', '2040_2_12 ', '2040_2_13 ', '2040_5_18 ', '2040_9_20 ', '2040_9_21 ', '2040_9_22 ', '2041_1_31 ', '2041_2_1 ', '2041_2_2 ', '2041_5_7 ', '2041_9_9 ', '2041_9_10 ', '2041_9_11 ', '2042_1_21 ', '2042_1_22 ', '2042_1_23 ', '2042_5_26 ', '2042_9_27 ', '2042_9_28 ', '2042_9_29 ', '2043_2_9 ', '2043_2_10 ', '2043_2_11 ', '2043_5_16 ', '2043_9_16 ', '2043_9_17 ', '2043_9_18 ', '2044_1_29 ', '2044_1_30 ', '2044_1_31 ', '2044_5_5 ', '2044_10_4 ', '2044_10_5 ', '2044_10_6 ', '2045_2_16 ', '2045_2_17 ', '2045_2_18 ', '2045_5_24 ', '2045_9_24 ', '2045_9_25 ', '2045_9_26 ', '2046_2_5 ', '2046_2_6 ', '2046_2_7 ', '2046_5_13 ', '2046_9_14 ', '2046_9_15 ', '2046_9_16 ', '2047_1_25 ', '2047_1_26 ', '2047_1_27 ', '2047_5_2 ', '2047_10_4 ', '2047_10_5 ', '2048_2_13 ', '2048_2_14 ', '2048_2_15 ', '2048_5_20 ', '2048_9_21 ', '2048_9_22 ', '2048_9_23 ', '2049_2_1 ', '2049_2_2 ', '2049_2_3 ', '2049_5_9 ', '2049_9_10 ', '2049_9_11 ', '2049_9_12 ', '2050_1_22 ', '2050_1_23 ', '2050_1_24 ', '2050_5_28 ', '2050_9_29 ', '2050_9_30 ', '2050_10_1 ', '2051_2_10 ', '2051_2_11 ', '2051_2_12 ', '2051_5_17 ', '2051_9_18 ', '2051_9_19 ', '2051_9_20 ', '2052_1_31 ', '2052_2_1 ', '2052_2_2 ', '2052_5_6 ', '2052_9_6 ', '2052_9_7 ', '2052_9_8 ', '2053_2_18 ', '2053_2_19 ', '2053_2_20 ', '2053_5_25 ', '2053_9_25 ', '2053_9_26 ', '2053_9_27 ', '2054_2_7 ', '2054_2_8 ', '2054_2_9 ', '2054_5_15 ', '2054_9_15 ', '2054_9_16 ', '2054_9_17 ', '2055_1_27 ', '2055_1_28 ', '2055_1_29 ', '2055_5_4 ', '2055_10_4 ', '2055_10_5 ', '2055_10_6 ', '2056_2_14 ', '2056_2_15 ', '2056_2_16 ', '2056_5_22 ', '2056_9_23 ', '2056_9_24 ', '2056_9_25 ', '2057_2_3 ', '2057_2_4 ', '2057_2_5 ', '2057_5_11 ', '2057_9_12 ', '2057_9_13 ', '2057_9_14 ', '2058_1_23 ', '2058_1_24 ', '2058_1_25 ', '2058_4_30 ', '2058_10_1 ', '2058_10_2 ', '2058_10_3 ', '2059_2_11 ', '2059_2_12 ', '2059_2_13 ', '2059_5_19 ', '2059_9_20 ', '2059_9_21 ', '2059_9_22 ', '2060_2_1 ', '2060_2_2 ', '2060_2_3 ', '2060_5_7 ', '2060_9_8 ', '2060_9_9 ', '2060_9_10 ', '2061_1_21 ', '2061_1_22 ', '2061_1_23 ', '2061_5_26 ', '2061_9_27 ', '2061_9_28 ', '2061_9_29 ', '2062_2_8 ', '2062_2_9 ', '2062_2_10 ', '2062_5_16 ', '2062_9_16 ', '2062_9_17 ', '2062_9_18 ', '2063_1_28 ', '2063_1_29 ', '2063_1_30 ', '2063_5_6 ', '2063_10_5 ', '2063_10_6 ', '2063_10_7 ', '2064_2_16 ', '2064_2_17 ', '2064_2_18 ', '2064_5_23 ', '2064_9_24 ', '2064_9_25 ', '2064_9_26 ', '2065_2_4 ', '2065_2_5 ', '2065_2_6 ', '2065_5_12 ', '2065_9_14 ', '2065_9_15 ', '2065_9_16 ', '2066_1_25 ', '2066_1_26 ', '2066_1_27 ', '2066_5_1 ', '2066_10_2 ', '2066_10_3 ', '2066_10_4 ', '2067_2_13 ', '2067_2_14 ', '2067_2_15 ', '2067_5_20 ', '2067_9_22 ', '2067_9_23 ', '2067_9_24 ', '2068_2_2 ', '2068_2_3 ', '2068_2_4 ', '2068_5_9 ', '2068_9_10 ', '2068_9_11 ', '2068_9_12 ', '2069_1_22 ', '2069_1_23 ', '2069_1_24 ', '2069_4_28 ', '2069_9_28 ', '2069_9_29 ', '2069_9_30 ', '2070_2_10 ', '2070_2_11 ', '2070_2_12 ', '2070_5_17 ', '2070_9_18 ', '2070_9_19 ', '2070_9_20 ', '2071_1_30 ', '2071_1_31 ', '2071_2_1 ', '2071_5_7 ', '2071_9_7 ', '2071_9_8 ', '2071_9_9 ', '2072_2_18 ', '2072_2_19 ', '2072_2_20 ', '2072_5_25 ', '2072_9_25 ', '2072_9_26 ', '2072_9_27 ', '2073_2_6 ', '2073_2_7 ', '2073_2_8 ', '2073_5_14 ', '2073_9_15 ', '2073_9_16 ', '2073_9_17 ', '2074_1_26 ', '2074_1_27 ', '2074_1_28 ', '2074_5_3 ', '2074_10_4 ', '2074_10_5 ', '2074_10_6 ', '2075_2_14 ', '2075_2_15 ', '2075_2_16 ', '2075_5_22 ', '2075_9_23 ', '2075_9_24 ', '2075_9_25 ', '2076_2_4 ', '2076_2_5 ', '2076_2_6 ', '2076_5_10 ', '2076_9_11 ', '2076_9_12 ', '2076_9_13 ', '2077_1_23 ', '2077_1_24 ', '2077_1_25 ', '2077_4_30 ', '2077_9_30 ', '2077_10_1 ', '2077_10_2 ', '2078_2_11 ', '2078_2_12 ', '2078_2_13 ', '2078_5_19 ', '2078_9_19 ', '2078_9_20 ', '2078_9_21 ', '2079_2_1 ', '2079_2_2 ', '2079_2_3 ', '2079_5_8 ', '2079_9_9 ', '2079_9_10 ', '2079_9_11 ', '2080_1_21 ', '2080_1_22 ', '2080_1_23 ', '2080_5_26 ', '2080_9_27 ', '2080_9_28 ', '2080_9_29 ', '2081_2_8 ', '2081_2_9 ', '2081_2_10 ', '2081_5_16 ', '2081_9_16 ', '2081_9_17 ', '2081_9_18 ', '2082_1_28 ', '2082_1_29 ', '2082_1_30 ', '2082_5_5 ', '2082_10_5 ', '2082_10_6 ', '2082_10_7 ', '2083_2_16 ', '2083_2_17 ', '2083_2_18 ', '2083_5_24 ', '2083_9_25 ', '2083_9_26 ', '2083_9_27 ', '2084_2_5 ', '2084_2_6 ', '2084_2_7 ', '2084_5_12 ', '2084_9_13 ', '2084_9_14 ', '2084_9_15 ', '2085_1_25 ', '2085_1_26 ', '2085_1_27 ', '2085_5_1 ', '2085_10_2 ', '2085_10_3 ', '2085_10_4 ', '2086_2_13 ', '2086_2_14 ', '2086_2_15 ', '2086_5_20 ', '2086_9_21 ', '2086_9_22 ', '2086_9_23 ', '2087_2_2 ', '2087_2_3 ', '2087_2_4 ', '2087_5_10 ', '2087_9_10 ', '2087_9_11 ', '2087_9_12 ', '2088_1_23 ', '2088_1_24 ', '2088_1_25 ', '2088_4_28 ', '2088_9_28 ', '2088_9_29 ', '2088_9_30 ', '2089_2_10 ', '2089_2_11 ', '2089_2_12 ', '2089_5_17 ', '2089_9_18 ', '2089_9_19 ', '2089_9_20 ', '2090_1_29 ', '2090_1_30 ', '2090_1_31 ', '2090_5_7 ', '2090_9_7 ', '2090_9_8 ', '2090_9_9 ', '2091_2_17 ', '2091_2_18 ', '2091_2_19 ', '2091_5_25 ', '2091_9_26 ', '2091_9_27 ', '2091_9_28 ', '2092_2_6 ', '2092_2_7 ', '2092_2_8 ', '2092_5_13 ', '2092_9_15 ', '2092_9_16 ', '2092_9_17 ', '2093_1_26 ', '2093_1_27 ', '2093_1_28 ', '2093_5_3 ', '2093_10_4 ', '2093_10_5 ', '2093_10_6 ', '2094_2_14 ', '2094_2_15 ', '2094_2_16 ', '2094_5_21 ', '2094_9_23 ', '2094_9_24 ', '2094_9_25 ', '2095_2_4 ', '2095_2_5 ', '2095_2_6 ', '2095_5_11 ', '2095_9_12 ', '2095_9_13 ', '2095_9_14 ', '2096_1_24 ', '2096_1_25 ', '2096_1_26 ', '2096_4_30 ', '2096_9_30 ', '2096_10_1 ', '2096_10_2 ', '2097_2_11 ', '2097_2_12 ', '2097_2_13 ', '2097_5_19 ', '2097_9_19 ', '2097_9_20 ', '2097_9_21 ', '2098_1_31 ', '2098_2_1 ', '2098_2_2 ', '2098_5_8 ', '2098_9_9 ', '2098_9_10 ', '2098_9_11 ', '2099_1_20 ', '2099_1_21 ', '2099_1_22 ', '2099_5_27 ', '2099_9_28 ', '2099_9_29 ', '2099_9_30 ', '2100_2_8 ', '2100_2_9 ', '2100_2_10 ', '2100_5_16 ', '2100_9_17 ', '2100_9_18 ', '2100_9_19'];
        var holidayinterval = setInterval(function(){
            if(allblock.length > 10){
                clearInterval(holidayinterval);
                var dateblock = document.getElementsByClassName("date");
                if(dateblock)
                for(var i = 0 ; i < allblock.length;i++){
    //                clog("allblock ",allblock[i]);
                    var classname = allblock[i].className;

                    var dateblock = allblock[i].querySelector('.date');
                    //allblock[i].style.backgroundColor = classname.indexOf("outside") >=0 ? "#f5f5f5":"white";
                    allblock[i].style.backgroundColor = classname.indexOf("outside") >=0 ? "#00000000":"#00000000";
                    if(classname.indexOf("today") >=0){
                        
                        //currentday 오늘날짜 css 
//                        allblock[i].style.backgroundColor = "#cce6ee";
//                        if(allblock[i].childNodes.length > 0)allblock[i].children[0].style.backgroundColor = "#cce6ee";
//                        clog("today block ",allblock[i]);
                        
                        allblock[i].style.border = "6px solid #ff000099";
                        
                    }
                    if(dateblock){
                        
                        if(classname.indexOf("sunday") >=0){
                             dateblock.style.color = classname.indexOf("outside") >=0 ? "#f5aba4" : "red";
                             dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                        }else if(classname.indexOf("saturday") >=0){
                            dateblock.style.color = classname.indexOf("outside") >=0 ? "#d7d8fa" : "blue";

                        }else {

                            dateblock.style.color = classname.indexOf("outside") >=0 ? "#cccccc" : "#ffffff";    
                            dateblock.style.fontWeight ="normal";

                        }

                        for(var j = 0 ; j < yholiday.length; j++){
                            if(classname.indexOf(yholiday[j]) >= 0){
                                var dateblock = allblock[i].querySelector('.date');
                                dateblock.style.color = classname.indexOf("outside") >=0 ? "#f5aba4" : "red";
                                dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                                break;
                            }    
                        }
                        for(var j = 0 ; j < uholiday.length; j++){
                            if(classname.indexOf(uholiday[j]) >= 0){
                                var dateblock = allblock[i].querySelector('.date');
                                dateblock.style.color = classname.indexOf("outside") >=0 ? "#f5aba4" : "red";
                                dateblock.style.fontWeight = classname.indexOf("outside") >=0 ? "normal" : "bold";
                                break;
                            }    
                        }
                    }


                }
                
            }
        },10);
        
            
    
    }   
function stringGetYear(str){
    var arr = str.split(' ');
    var datearr = arr[0].split('-');
    var y = datearr[0];
    return y;
    
//    var now = new Date(str);
//    return now.getFullYear();
    
    
}
function stringGetMonth(str){
    var arr = str.split(' ');
    var datearr = arr[0].split('-');
    var m = parseInt(datearr[1]) < 10 ? "0"+parseInt(datearr[1]) : datearr[1];
    return m;
    
//    var now = new Date(str);
//    var month = now.getMonth() + 1;
//    if (month < 10) month = "0" + month;
//    return month;
}
function stringGetDay(str){
    var arr = str.split(' ');
    var datearr = arr[0].split('-');
    var d = parseInt(datearr[2]) < 10 ? "0"+parseInt(datearr[2]) : datearr[2];
    return d;
    
    
//    var now = new Date(str);
//    var day = now.getDate();
//    if (day < 10) day = "0" + day;
//    return day;
}

function stringGetHour(str){
    var d = getDevice() == 'iphone' ? getIOSDate(str) : new Date(str);
    var hour = d.getHours();
//    var now = new Date(str);
//    var hour = now.getHours();
    return hour;
}
function stringGetMin(str){
    var d = getDevice() == 'iphone' ? getIOSDate(str) : new Date(str);
    var min = d.getMinutes();
    
//    var now = new Date(str);
//    var min = now.getMinutes();
	
    return min;
}
//문자열에서 숫자만 추출한다.
function getStringInNumber(str){
   var regex = /[^0-9]/g;				// 숫자가 아닌 문자열을 선택하는 정규식
var result = str.replace(regex, "");	// 원래 문자열에서 숫자가 아닌 모든 문자열을 빈 문자로 변경
//clog(result);	 
    var rvalue = result == "" ? 0 : parseInt(result);
    return rvalue;
}
function isSameCouponid(before_obj, obj) {
    var flg = false;
    //    clog("before_obj ",before_obj);
    //    clog("now_obj ",obj);


    if (before_obj && obj) {
        var bid = before_obj.couponid;
        var id = obj.couponid;
        var coupontype = obj.coupontype;

        var bpayment_timestamp = new Date(before_obj.paymentid).getTime();
        var payment_timestamp = new Date(obj.paymentid).getTime();

        //환불이라면 무조건 같은쿠폰으로 취급하지 않는다.
        if (before_obj.paymenttype == "3" || obj.paymenttype == "3") {
            return false;
        }

        if (coupontype != "L" && before_obj.uid == obj.uid && bid && id) {
            var bdate = new Date(bid);
            var before_timestamp = bdate.getTime();
            var ndate = new Date(id);
            var now_timestamp = ndate.getTime();

            if (before_timestamp == now_timestamp || before_timestamp == now_timestamp + 1000 || before_timestamp == now_timestamp - 1000) {
                //같이 결제했다면 결제날짜가 정확히 일치해야한다.
                if (bpayment_timestamp == payment_timestamp)
                    flg = true;
                else
                    flg = false;
            } else
                flg = false;
        } else
            flg = false;
    } else {
        flg = false;
    }
    return flg;

}
function isPermission(checknum){
    var flg = false;
    
    if(permission_list){
        for(var i = 0; i < permission_list.length; i++){
            var num = parseInt(permission_list[i]);
            if(num == checknum){
                flg = true;
                break;
            }
        }    
    }else{
        if(auth >= AUTH_OPERATOR){
            flg = true;
        }else {
            flg = false;
        }
    }
    
    return flg;
}
function showTranerReservation(groupcode,centercode,teacher_uid,teacher_id,teacher_name){
        
         getAdmUserData(groupcode,centercode,teacher_uid,function(res){
                teacher_id = res.message[0].mem_userid;
                var name = encodeURIComponent(teacher_name);
                var param = "teacheruid="+teacher_uid+"&teacherid="+teacher_id+"&teachername="+name;
                clog("screen height ",screen.height);
                var height = screen.height;
                window.open('../../v1/dist/d_teacher_reservation.php?'+param, '_blank'); 
         });
    
//        var message = "<iframe style='width:100%;height:"+height+"px' src='./d_teacher_reservation.php?"+param+"'></iframe>";
//        var modalstyle = {
//            bodycolor: "#eeeeee",
//            size: {
//                width: "100%",
//                height: "100%"
//            }
//        };
//
//       
//        getAdmUserData(groupcode,centercode,teacher_uid,function(res){
//            if(res.code == "100"){
//                var userid = res.message[0].mem_userid;
//
//                param = "teacheruid="+teacher_uid+"&teacherid="+userid+"&teachername="+name;
//                height = screen.height-300;
//                message = "<iframe style='width:100%;height:"+height+"px' src='../../v1/dist/d_teacher_reservation.php?"+param+"'></iframe>";
//
//                showModalDialog(document.body, teacher_name+" 트레이너 달력",  message,"닫기", null, function() {
//                    hideModalDialog();
//
//                },null,modalstyle);
//            }
//        })
        
    
    }
function getTimeTag(time,min){
    var tarr  = time.split(' ');
    var AMPM = tarr[1] == "am" ? "AM" : "PM";
    
    var min_tag = "";
    if(min){
        min_tag = parseInt(min) < 10 ? ":0"+min : ":"+min;
    }
    
    var tag = "<label class='fmont' style='font-size:10px;color:white;margin-top:-2px'>"+AMPM+"&nbsp;"+tarr[0]+""+min_tag+"</label>";
    return tag;
}
function getTimeIcon(time){
    var tarr  = time.split(' ');
//    clog(" tarr[0] "+tarr[0]+" tarr[1] "+tarr[1]);

    var img_name = tarr[1] == "am" ? "icon_am.png" : "icon_pm.png";
    svg_tag = "<img src='./img/"+img_name+"' style='margin-left:-10px;margin-top:-1px;width:20px'><text style='position:absolute;margin-left:-17px;margin-top:8px;color:white;font-size:12px;font-weight:bold'>"+tarr[0]+"</text>";
    
    return svg_tag;
    
}
function getTimeIconTag(time,margin_top,margin_left){
    var mtop = margin_top ? margin_top+"px" : "-1px";
    var mleft = margin_left ? margin_left+"px" : "-10px";
    var tarr  = time.split(' ');
    var ttop = margin_top ? (margin_top+13)+"px" : "8px";
//    clog(" tarr[0] "+tarr[0]+" tarr[1] "+tarr[1]);

    var img_name = tarr[1] == "am" ? "icon_am.png" : "icon_pm.png";
    svg_tag = "<img src='./img/"+img_name+"' style='margin-left:"+mleft+";margin-top:"+mtop+";width:20px'><text style='position:absolute;margin-left:-17px;margin-top:"+ttop+";color:white;font-size:12px;font-weight:bold'>"+tarr[0]+"</text>";
    
    return svg_tag;
    
}
function setLogos(groupcode){
    
    //상단 동그란 아이콘 로고
    var web_icon_white_200x200 = document.getElementById("web_icon_white_200x200");
    if(web_icon_white_200x200)web_icon_white_200x200.src = "../../../ssapi/img/"+groupcode+"/logos/web_icon_white_200x200.png";
    
    //긴 텍스트 로고
    var web_title_default_650x100 = document.getElementById("web_title_default_650x100");
    if(web_title_default_650x100)web_title_default_650x100.src = "../../../ssapi/img/"+groupcode+"/logos/web_title_default_650x100.png";
    TITLE_LOGO_DEFAULT = "../../../ssapi/img/"+groupcode+"/logos/web_title_default_650x100.png";
    
    //긴 텍스트 로고 흰색
    var web_title_white_650x100 = document.getElementById("web_title_white_650x100");
    if(web_title_white_650x100)web_title_white_650x100.src = "../../../ssapi/img/"+groupcode+"/logos/web_title_white_650x100.png";    
    TITLE_LOGO_WHITE = "../../../ssapi/img/"+groupcode+"/logos/web_title_white_650x100.png";
    
    
    
}
//////////////////////////////////////////////////////////////////
// 커스텀 콤보박스 코드 START
//////////////////////////////////////////////////////////////////

function C_ComboBox(parentid,id,default_text,objs,boxwidth,scale,functionname,isselected){
    //test customCombobox code
    if(!scale)scale = 1;
    var combobox = createCustomComboBox(id,default_text,objs,boxwidth,scale,functionname,isselected);
    var parent = document.getElementById(parentid);
    parent.innerHTML = "";
    parent.append(combobox);    
    parent.style.backgroundColor = mColor.C111111;
    
}
function C_ComboBoxTag(id,default_text,objs,boxwidth,scale,functionname,isselected){
    //test customCombobox code
    if(!scale)scale = 1;
    var combobox = createCustomComboBox(id,default_text,objs,boxwidth,scale,functionname,isselected);
    var div = document.createElement("div");
    div.style.backgroundColor = mColor.C111111;
    div.append(combobox);
    return div.innerHTML;
    
}
function createCustomComboBox(id,dtext,objs,boxwidth,scale,callbackfunction,isselected){  //scale = 0.1 ~ 3.1 대충
    if(!callbackfunction)callbackfunction = "aaa";
    if(!scale)scale = 1;
    var div = document.createElement("div");
    var screen_height = $(window).height();
    var div_width = parseInt(boxwidth*scale);
    var block_height = parseInt(30*scale);
    var fontsize = parseInt(18*scale);
    var img_margintop = -10*scale;
    var width = div_width > 0 ? div_width+"px" : "100%";
    div.style.width = width;
    
    var ui = document.createElement("ui");
    ui.class = "navbar-nav ml-auto";
   
    div.append(ui);
    div.style.backgroundColor = "#111111";
    
    //최초 보여지는 텍스트
    var click_tag = "<text style='font-size:"+fontsize+"px;color:"+mColor.Cafafaf+"'>"+dtext+"</text>";
    //
    console.log("screen_height "+screen_height);
    var list_tag = "<a class='dropdown-item' style='height:auto' onclick='customComboClick(\""+id+"\",\"\",\""+dtext+"\",\"\" , "+scale+",\""+callbackfunction+"\")' style='height:"+block_height+"px;float:center'><text style='font-size:"+fontsize+"px;color:"+mColor.Cafafaf+"'>"+dtext+"</text></a>";
    for(var i = 0 ; i < objs.length;i++){
        var obj = objs[i];
        var optionbg = obj.optionbg ? obj.optionbg : "#111111";
        var textcolor = obj.textcolor ? obj.textcolor : "#afafaf";
        clog("textcolor "+textcolor);
        var displayimage = obj.imgname ? "<img src='"+obj.imgname+"' style='height:"+block_height+"px;margin-top:"+img_margintop+"px;'/>&nbsp;" : "";
        list_tag += "<a class='dropdown-item' onclick='customComboClick(\""+id+"\",\""+obj.value+"\",\""+obj.text+"\",\""+obj.imgname+"\", "+scale+",\""+callbackfunction+"\")'  style='width:height:"+block_height+"px;float:center;background-color:"+optionbg+";color:"+textcolor+"'>"+displayimage+"<text style='font-size:"+fontsize+"px;color:"+textcolor+"'>"+obj.text+"</text></a>";
       
        
       
        //선택되었다면 보여지는 텍스트
        if(i == isselected)click_tag = displayimage+"<text style='font-size:"+fontsize+"px;color:"+textcolor+";'>"+obj.text+"</text>";
        
    }
    var radius = 4*scale;
    var cComboTag = 
       
             "<a class='nav-link dropdown' id='"+id+"' href='#' role='button' data-toggle='dropdown' aria-haspopup='false' aria-expanded='false'  style='height:auto;background-color:#111111;border:1px solid #292929 ;border-radius: "+radius+"px;' >"+click_tag+"</a>"+
             "<div class='dropdown-menu dropdown-menu-right' aria-labelledby='"+id+"' style='background-color:#111111;max-height:"+(screen_height/2)+";overflow-y:auto'>"+list_tag+"</div>";
//    clog("cComboTag "+cComboTag);
    ui.innerHTML = cComboTag;
//    ui.style.paddingBottom = "80px";
    return div;
    
}
function customComboClick(id,value,text,imgname,scale,callbackfunction){
     var block_height = parseInt(30*scale);
    var fontsize = parseInt(18*scale);
//    clog("scale is ",scale);
    var img_margintop = -10*scale;
    var userDropdown = document.getElementById(id);
    var displayimage = imgname ? "<img id='"+id+"_img' src='"+imgname+"' style='height:"+block_height+"px;margin-top:"+img_margintop+"px;'/>&nbsp;" : "";
    userDropdown.innerHTML = imgname ? displayimage+"<text id='"+id+"_text' style='font-size:"+fontsize+"px;color:#afafaf'>"+text+"</text><text id='"+id+"_value' style='display:none'>"+value+"</text>" : "<text id='"+id+"_text' style='font-size:"+fontsize+"px;color:#afafaf'>"+text+"</text><text id='"+id+"_value' style='display:none'>"+value+"</text>";
    
    var arg = getCustomComboData(id);
    eval(callbackfunction)(arg);
}

function executeFunctionByName(functionName, context /*, args */) {
    var args = Array.prototype.slice.call(arguments, 2);
    var namespaces = functionName.split(".");
    var func = namespaces.pop();
    for (var i = 0; i < namespaces.length; i++) {
        context = context[namespaces[i]];
    }
    return context[func].apply(context, args);
}
//커스텀 콤보박스 값 가져오기
function getCustomComboData(id){
    var img = document.getElementById(id+"_img");
    if(!document.getElementById(id+"_value")){
        alertMsg("시간, 이름을 선택하세요");
        return;
    }
    var value = document.getElementById(id+"_value").innerHTML;
    var text = document.getElementById(id+"_text").innerHTML;
    var rdata =  img ? {"value":value,"text":text, "img":img.src} : {"value":value,"text":text};
//    clog("rdata",rdata);
    return rdata;
}
//////////////////////////////////////////////////////////////////
// 커스텀 콤보박스 코드 END
//////////////////////////////////////////////////////////////////

function getDataListSelectedValue(txt_input, data_list_options) 
{
    try{
        var shownVal = document.getElementById(txt_input).value; //텍스트 글자
        var value2send = document.querySelector("#" + data_list_options + " option[value='" + shownVal + "']").dataset.value;
        return value2send;    
    }catch(e){
        
    }
    
}
function getDataListSelectedText(txt_input) 
{
    try{
        var shownVal = document.getElementById(txt_input).value; //텍스트 글자
    //    var value2send = document.querySelector("#" + data_list_options + " option[value='" + shownVal + "']").dataset.value;
        return shownVal;
    }catch(e){
        
    }
}


function makeQRTag(url) {
    // clog('Current version:', version)
    qrcode.qrcode.stringToBytes = qrcode.qrcode.stringToBytesFuncs['UTF-8']
    var qr = qrcode.qrcode(8, 'H');
    qr.addData(url);
    try {
      qr.make();

    } catch (err) {
      clog('Version is low:', 8)
      clog('Error:', err)
    }
//            document.getElementById('qr').innerHTML = qr.createImgTag(3);
    return qr.createImgTag(3);
}
function VAT(mbsidx){
    
    if(mbsidx){
        var vat = 0;
        for(var i = 0 ; i < allmembership.length;i++){
            if(parseInt(allmembership[i].mbs_idx) == parseInt(mbsidx)){
                vat = parseInt(allmembership[i].mbs_vat);
                break;
            }
        }
        return vat;
    }else {
        return global_vat;
    }
    
    
//    return global_vat;
}
function addVAT(mbsidx,price,mbsvat){
    var vat = mbsvat ? parseInt(mbsvat) : VAT(mbsidx);
    clog("vat "+vat);
    price = price*((100+vat)/100);
    clog("price "+price);
    return parseInt(price);
}
function subVAT(mbsidx,price,mbsvat){
    var vat = mbsvat ? parseInt(mbsvat) : VAT(mbsidx);
    clog("vat "+vat);
    price = (price/(100+vat))*100;
     clog("price "+price);
    return parseInt(price);
}
function checkFreePT(mbsprice,mbsname){
    if(parseInt(mbsprice) == 0 && mbsname.indexOf(ID_FREE) >= 0)
        return true;
    else 
        return false;
}
function IsJsonString(str) {
  try {
    var json = JSON.parse(str);
    return (typeof json === 'object');
  } catch (e) {
    return false;
  }
}
function setZoom(mzoom){
    
    // 강제로 비율조정할때 사용
    if(!mzoom)mzoom = 1;
    
    var zoom = 100;
    var screen_width = $(window).width();
    var max_width = 375;
    zoom = (screen_width / max_width)*mzoom;
//    clog("screen_width "+screen_width);
    var width_percent = 100;
//    if (zoom > 1) zoom = 1;
    clog(" zoom "+zoom+ " width_percent "+width_percent);
    document.body.style.width = width_percent = width_percent+"%";
    document.body.style.zoom = width_percent = zoom+"";
    
    return zoom;
}

//두날짜 사이 날짜 모두 가져오기
function getDatesStartToLast(startDate, lastDate) {
	var regex = RegExp(/^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/);
	if(!(regex.test(startDate) && regex.test(lastDate))) return "Not Date Format";
	var result = [];
	var curDate = new Date(startDate);
	while(curDate <= new Date(lastDate)) {
		result.push(curDate.toISOString().split("T")[0]);
		curDate.setDate(curDate.getDate() + 1);
	}
	return result;
}

function getDateOfWeek(datestr){ //날짜문자열 형식은 자유로운 편
    var week = ['일', '월', '화', '수', '목', '금', '토'];
    if(getDevice() == 'iphone'){
//        datestr = datestr.replace("T"," ");
         var arr = datestr.split(/[- :]/),
        date = new Date(arr[0], arr[1]-1, arr[2]);
        var dayOfWeek = week[date.getDay()];
    }else {
        
        var dayOfWeek = week[new Date(datestr).getDay()];
        
    }
    return dayOfWeek;    

}

function myCheckBoxTag(text,id){
    var tag = "<span style='float:right;'><text class='textevent'>"+text+"</text></span>"+
              "<span style='float:right;'><label class='mycheckbox' style='margin-left:-30px'><input id='"+id+"'  type='checkbox'><span class='checkmark'></span></label></span>";
    return tag;
}


function setBtnEventColor(id,normalcolor,clickcolor,hovercolor){
    var ncolor = !normalcolor ? "white" : normalcolor;
    var ccolor = !clickcolor ? ncolor: clickcolor;
    var hcolor = !hovercolor ? ccolor: hovercolor;
    
     $("#"+ id ).bind("touchstart",function(){
        $(this).css("background-color", ccolor);
    });
    $( "#"+id ).bind("touchend",function(){
        $(this).css("background-color", ncolor);
    });

    $( "#"+id).mouseover(function(){
         $(this).css("background-color", hcolor);
    });

    $( "#"+id ).mouseout(function(){
         $(this).css("background-color", ncolor);
    });
    $( "#"+id ).mousedown(function(){
        $(this).css("background-color", ccolor);
    });
     $( "#"+id ).mouseup(function(){
         $(this).css("background-color", ncolor);
    });
}

function setImageButton(id,_default_name,_press_name,_hover_name){
//    var _default_name = _default_name.indexOf("./img/") >= 0 ? _default_name : "./img/"+_default_name;
//    var _press_name = _press_name.indexOf("./img/") >= 0 ? _press_name : "./img/"+_press_name;
//    var _hover_name = _hover_name.indexOf("./img/") >= 0 ? _hover_name : "./img/"+_hover_name;
    
    var default_name = _default_name;
    var hover_name = _hover_name ? _hover_name : _press_name;
    if(!hover_name)hover_name = _default_name;
    var press_name = _press_name ? _press_name : _default_name;
    
    $("#"+ id ).bind("touchstart",function(){
        $(this).attr('src',press_name);  
    });
    $( "#"+id ).bind("touchend",function(){
        $(this).attr('src',default_name);  
    });

    $( "#"+id).mouseover(function(){
         $(this).attr('src',hover_name);  
    });

    $( "#"+id ).mouseout(function(){
         $(this).attr('src',default_name);  
    });
    $( "#"+id ).mousedown(function(){
         $(this).attr('src',press_name);
    });
     $( "#"+id ).mouseup(function(){
         $(this).attr('src',default_name);
    });
}

function isIntime(stime,etime){
    var flg = false;
    if(isNowTimeMinOver(stime) <= 0 && isNowTimeMinOver(etime) >= 0)
        flg = true;
    return flg;
}

 //정렬은 0번째가 현재 회원권 그다음이 미래의 회원권 순
function getNowAfterCoupons(userinfo){
    var using_coupons = getCoupons(userinfo,"using");
  
    var coupons = [];
    for(var i = 0 ; i < using_coupons.length; i++){
        if(!using_coupons[i].isdelete || using_coupons[i].isdelete && using_coupons[i].isdelete == "N")coupons.push(using_coupons[i]);
    }
   
    //정렬은 0번째가 현재 회원권 그다음이 미래의 회원권 순
    coupons.sort(sort_by('endtime', false, (a) => a.toUpperCase()));   
    return coupons;
}
 //정렬은 0번째가 현재 회원권 그다음이 미래의 회원권 순
function getNowMembershipCoupon(using_coupons){
   
    var coupons = [];
    for(var i = 0 ; i < using_coupons.length; i++){
        if(using_coupons[i].mbstype != "PT") //멤버쉽 회원권만 
        if(getDDay(getTotalEndtime(using_coupons[i])) >= 0)
        if(!using_coupons[i].isdelete || using_coupons[i].isdelete && using_coupons[i].isdelete == "N")coupons.push(using_coupons[i]);
    }
   
    //정렬은 0번째가 현재 회원권 그다음이 미래의 회원권 순
    coupons.sort(sort_by('endtime', false, (a) => a.toUpperCase()));   
    if(coupons.length > 0){
        clog("m coupons ",coupons);
        return coupons[0];
    }
        
    else 
        return null;
}
function getLastUsingLocker(lockers){
    var lastlocker = null;
    var ldate = getToday();
    if(lockers)
    for(var i = 0 ; i < lockers.length;i++){
        if(!lockers[i].isdelete || lockers[i].isdelete && lockers[i].isdelete == "N")
        if(getDay(ldate,lockers[i].endtime) > 0){
            lastlocker = lockers[i];
            ldate = lockers[i].endtime;
        }
    }
    return lastlocker;
}

function clog(t,o){
    var htype = window.location.hostname.indexOf("localhost") >= 0 ? "localhost" : "blackgym";
    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
    
    if(htype == "blackgym" && drtype == "real"){return;}   
    
    if(o)console.log(t,o);
    else console.log(t);
}

//입력된 이메일 형식체크 , 중복체크
 function inputIsEmail(id,callback) {
     var email = document.getElementById(id);
     var email_checkdiv = document.getElementById(id+"_checkdiv");
     var email_progress = document.getElementById(id+"_progress");
     
    
//       clog("00 inputIsEmail groupcode "+groupcode+" centercode "+centercode);
//       clog("inputIsEmail "+email.value);
    // 변수를 선언한다.
    var regExp = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;

    // 이메일 확인
    // test( ) : 검색한 문자열에 패턴이 있는지 여부를 나타낸다, 문자열이 존재하면 true, 존재하지 않으면 false를 리턴한다.
    if(regExp.test(email.value) == false) {
//        alert("e-mail 형식이 일치하지 않습니다.\n다시 입력하여 주시기 바랍니다.");
        
        //이메일 형식에 맞지 않다.
        showEmailCheckIcon(id,"notuse");
//        email.value = "";
        email.focus();
    } else {
        
        //이메일 형식에 맞다
        //1초후에 이메일 중복을 체크한다.
        
        setTimeout(function(){
            showEmailCheckIcon(id,"loading");
            console.log("이메일 중복체크한다.");
            
            isEmailCheck(email.value,function(res){
                var code = parseInt(res.code);
                if(code == 100){
                    showEmailCheckIcon(id,"use");
                    callback(1);
                }else {
                    showEmailCheckIcon(id,"notuse");
                    callback(0);
                }
            },function(err){
                showEmailCheckIcon(id,"notuse");
                callback(0);
            })
        },1000);
    }
}
function showEmailCheckIcon(id,type){
    var email = document.getElementById(id);
    var email_checkdiv = document.getElementById(id+"_checkdiv");
    var email_icon_loading = document.getElementById(id+"_icon_loading");
    var email_icon_notuse = document.getElementById(id+"_icon_notuse");
    var email_icon_use = document.getElementById(id+"_icon_use");
    email_checkdiv.style.display = "block";
    switch(type){
        case "loading":
            email_icon_loading.style.display = "block";
            email_icon_notuse.style.display = "none";
            email_icon_use.style.display = "none";
            
            break;
        case "notuse":
            email_icon_loading.style.display = "none";
            email_icon_notuse.style.display = "block";
            email_icon_use.style.display = "none";
            email.style.color = "red";
           
            break;
        case "use":
            email_icon_loading.style.display = "none";
            email_icon_notuse.style.display = "none";
            email_icon_use.style.display = "block";
            email.style.color = "#007bff";
           
            break;
            
    }
}
function isEmailCheck(email,success,error){
    var groupcode = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    
    var senddata = {
        groupcode : groupcode,
        centercode : centercode,
        type :"isemailcheck",
        value : email
    
    };
    CallHandler("adm_get", senddata, function (res) {
       if(success)success(res);
        
    }, function (err) {if(error)error(err);},true);
    
}


////////////////////////////////////////////////
// 웹뷰화면에서 일정시간(30분) 입력이 없으면 타임아웃하기
////////////////////////////////////////////////

var idleInterval;
var idleTime = 0;
function startTimeOutInterval(){
    idleInterval = setInterval(timerIncrement, 6000000); // 100 minute  //real
//    idleInterval = setInterval(timerIncrement, 1000); // 1 sec //test
    //일정시간 움직임이 있으면 초기화
    $(this).mousemove(function (e) {idleTime = 0; });
    $(this).keypress(function (e) { idleTime = 0; }); 
    $(document).bind("touchstart",function(e) { idleTime = 0; }); 
};
function timerIncrement() {
   console.log("time is "+idleTime);
    idleTime = idleTime + 1;
    if (idleTime > 29) { // 30 minutes
        //새로고침 하거나 로그아웃 처리
        console.log("로그아웃처리");
        clearInterval(idleInterval);
        if(typeof call_app == 'function'){
            call_app();
        }

    }

}
startTimeOutInterval();

  function escapeHtml(str) {
      var entityMap = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;',
      '/': '&#x2F;',
      '`': '&#x60;',
      '=': '&#x3D;'
    };
    return String(str).replace(/[&<>"'`=\/]/g, function (s) {
      return entityMap[s];
    });
  }
function unescapeHtml(str){

    return str.replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/&quot;/g, "\"").replace(/&#39;/g, "'").replace(/&#x2F;/g, "/").replace(/&#x60;/g, "`").replace(/&#x3D;/g, "=");
}
function decodeTerms(res){
    for(var i = 0 ; i < res.mainuserule.length;i++){
        if(res && res.mainuserule && res.mainuserule[i])res.mainuserule[i] = unescapeHtml(res.mainuserule[i]);
    }
    for(var i = 0 ; i < res.message.length;i++){
        if(res && res.message && res.message[i])res.message[i] = unescapeHtml(res.message[i]);
    }
    return res;
}
function getNowUsingOtherCoupons(coupons){
    
    var usingcoupons = [];
    
    for(var i = 0 ; i < coupons.length;i++){
        var c = coupons[i];
        
        if(c.isdelete && c.isdelete == "D" || c.issendedcoupon && parseInt(c.issendedcoupon) == -1 || !isIntime(c.starttime,c.endtime)){
            
        }else {
            usingcoupons.push(c);
        }
    }
    //return {"endcoupons":endcoupons, "usingcoupons":usingcoupons, "aftercoupons":aftercoupons};
    return usingcoupons;
}
function getMbsMaxCount(coupon) {
    var maxcount = parseInt(coupon.mbsmaxcount);
    if (coupon.addcountdatas) {
        for (var i = 0; i < coupon.addcountdatas.length; i++) {
            if(!(coupon.addcountdatas[i].isdelete && coupon.addcountdatas[i].isdelete == "D") && coupon.addcountdatas[i].count){
            
                maxcount += parseInt(coupon.addcountdatas[i].count);
            }
        }
    }
    return maxcount;
}

function getTotalCouponPrice(coupon){
    var totalprice = coupon.remainprice && typeof coupon.remainprice === 'object' ? parseInt(coupon.remainprice.total) : 0;
    
    
    var remainprice = {}
    if(coupon.remainprice){
        if(typeof coupon.remainprice === 'string' && coupon.remainprice.length > 10){
            var arr = coupon.remainprice.split(',');
            
            for(var i = 0 ; i < arr.length;i++){
                if(i%2 == 0){
                    remainprice[""+arr[i]] = arr[i+1];
                }
            }
            totalprice = parseInt(remainprice.total);
            if(isNaN(totalprice))totalprice = 0;
        }else{
            remainprice = coupon.remainprice;
        }    
    }
    
    if(coupon.addcountdatas)
    for(var i = 0 ; i < coupon.addcountdatas.length;i++){       
        if(coupon.addcountdatas[i].total)
        totalprice += parseInt(coupon.addcountdatas[i].total_remain);        
    }
    
    //쿠폰에서 미수금 금액 (remainprice.remain ) 이 있는부분은 뺀다.
    var remainprice_remain = remainprice.remain ? parseInt(remainprice.remain) : 0;
    if(isNaN(remainprice_remain))remainprice_remain = 0;
    if(remainprice_remain != 0) totalprice -= remainprice_remain;
    
    return totalprice;
}
function getTotalEndtime(coupon){
    var total_addday = 0;
    if(coupon.addcountdatas)
    for(var i = 0 ; i < coupon.addcountdatas.length;i++){       
        if(coupon.addcountdatas[i].addday)
        total_addday += parseInt(coupon.addcountdatas[i].addday);        
    }
    var endtime = nextDay(coupon.endtime,total_addday)+" 23:59:59";
    return endtime;
}
function updateTranerPayrollVat(select,paymenttype){
    console.log("global_centersetting ",global_centersetting);
    select.value = "0";
    if(!global_centersetting.payrollvattype)global_centersetting.payrollvattype = parseInt(global_centersetting.payrollvat) == 0 ? 0 : 4;
    var global_payrollvattype = parseInt(global_centersetting.payrollvattype);
    switch(global_payrollvattype){
        case 0: // 적용안함
            select.value = "0";
            break;
        case 1: //카드일때만 적용
            if(paymenttype == 1 || paymenttype == 4)
                select.value = "1";
            break;
        case 2: //현금일때만 적용
            if(paymenttype == 2 || paymenttype == 4)
            select.value = "1";
            break;
        case 4://카드,현금일때 모두 적용
            select.value = "1";
            break;
    }
}
function replaceStr(str, len) {
    var nstr = str;
    if (str.length > len) {
        nstr = str.substr(0, len) + "..";
    }
    return nstr;
}
function isObject(obj) {
    return obj === Object(obj);
}
function isPayrollUser(my_payroll_users,uid,couponid){
     var flg = false;
        for(var i = 0 ; i < my_payroll_users.length;i++){
            if(uid == my_payroll_users[i].uid && couponid == my_payroll_users[i].id){
                flg = true;
                break;
            }
        }
        return flg;
}
function getHoldingOKLength(holdingdata){
    var oklen = 0;
    if(!holdingdata)return oklen;
    
    for(var i = 0 ; i < holdingdata.length; i++){
        if(holdingdata[i].requestype == "H" && holdingdata[i].status == "Y"){
            oklen++;   
        }
    }
    return oklen;
}
function getUserGXDatas(groupcode,centercode,useruid,callback){
     var senddata = {
        groupcode: groupcode,
        centercode: centercode,
        type: "getusergxdatas",
        
    }
    CallHandler("adm_get", senddata, function (res) {
        if (res.code == "100") {
            global_gxdatas = res.message;
            setGXCalenderDatas(global_gxdatas,useruid);
            callback();
        }
        
    });
}


var user_allgxdatas = [];
var user_reservation_couponcount = {};
function setGXCalenderDatas(datas, useruid) {
    
    user_reservation_couponcount = {};
    
    var membership = useruid == global_user_info["mem_uid"] && global_user_info["mem_membership"] != "" && global_user_info["mem_membership"] != "null" ? JSON.parse(global_user_info["mem_membership"]) : [];
    user_allgxdatas = [];
    for (i = 0; i < datas.length; i++) {
        var roomdata = JSON.parse(datas[i].gx_roomdata);

       
            var tdate = roomdata.room_datetime;
            var date = new Date(tdate);

            var title = roomdata.room_name; //제목이지만 내용을 적으면 된다.
            var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
            var y = date.getFullYear();
            var m = date.getMonth() + 1; //
            var d = date.getDate();
            var hh = date.getHours();
            var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.


            var ymd = y + "-" + m + "-" + d;

            //                var isthisweek = isThisWeek(yyyymmdd, weeks);
            var users = roomdata.room_users;
            var ready_users = roomdata.room_readyusers;
            var min = roomdata.room_min ? roomdata.room_min : "0";
            var room_name = roomdata.room_name;
            var room_id = roomdata.room_id ? roomdata.room_id : "";
            var room_detailname = roomdata.room_detailname ? roomdata.room_detailname : "";
            var room_managername = roomdata.room_managername ? roomdata.room_managername : "";
            //                clog("*** room_name "+room_name+" room_detailname "+room_detailname+" room_managername "+room_managername+" min "+min);
            var data = {
                "date": "",
                "roomid": room_id,
                "roomname": room_name,
                "roomdetailname": room_detailname,
                "roommanagername": room_managername,
                "hour": hh,
                "min": min,
                "type": ""
            };
        
            //                clog("users ",users);
            if (users)
                for (k = 0; k < users.length; k++) {
                    if (users[k].useruid == useruid) {
                        data.date = ymd;
                        data.type = users[k].status;
                        data.username = users[k].username;
                        data.useruid = users[k].useruid;
                        data.couponid = users[k].couponid;
                        if (users[k].checkintime) data.checkintime = users[k].checkintime;
                        user_allgxdatas.push(data);
                        
                        
                        
                        //////////////////////////////////////////////
                        // GX횟수를 구한다. 총횟수 , 이용횟수 , 예약횟수 , 남은횟수
                        //////////////////////////////////////////////
                        var roommin = parseInt(roomdata.room_min);
                        var roomlessontime = roomdata.room_lessontime ? parseInt(roomdata.room_lessontime): 50;
                        var emin = (parseInt(roommin)+roomlessontime); //50분기준으로 한다.
                        var lesson_endtime = nextMin(tdate,emin);
                        var etime = getDateToStr(y,m,d,hh,roommin);
                        var lesson_endtime = nextMin(tdate,emin);
                        var date = new Date(lesson_endtime);
                        var gxy = date.getFullYear();
                        var gxm = date.getMonth()+1;  //
                        var gxd = date.getDate();
                        var gxhh = date.getHours();
                        var gxmm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                        var etime = getDateToStr(gxy,gxm,gxd,gxhh,gxmm);

                        var uid_couponid = data.useruid+"_"+data.couponid;
                        
                        var now_coupon = findCouponByCouponid(membership,data.couponid);
                        
                        if (getDDay(getTotalEndtime(now_coupon)) >= 0)
                        if(isNowTimeMinOver(etime) > 0){
                            if(!user_reservation_couponcount[uid_couponid])user_reservation_couponcount[uid_couponid] = {"use":0,"reservation":0};
                            user_reservation_couponcount[uid_couponid].reservation++;
                        }else {
                            if(!user_reservation_couponcount[uid_couponid])user_reservation_couponcount[uid_couponid] = {"use":0,"reservation":0};
                            user_reservation_couponcount[uid_couponid].use++;
                        }  
                        
                        
                       
                        //////////////////////////////////////////////
                        
                    }
                }
            //                clog("ready_users ",ready_users);
            if (ready_users)
                for (k = 0; k < ready_users.length; k++) {
                    if (ready_users[k].useruid == useruid) {
                        data.date = ymd;
                        data.type = ready_users[k].status;
                        data.username = ready_users[k].username;
                        data.useruid = ready_users[k].useruid;
                        data.couponid = ready_users[k].couponid;
                        user_allgxdatas.push(data);
                    }
                }

        
    }
    
    //        clog("user_allgxdatas ",user_allgxdatas);
    
}
//정렬은 0번째가 현재 회원권 그다음이 미래의 회원권 순
function getNowMembershipNextCoupon(using_coupons) {

    var coupons = [];
    for (var i = 0; i < using_coupons.length; i++) {
        if (using_coupons[i].mbstype != "PT") //멤버쉽 회원권만 
            if (getDDay(getTotalEndtime(using_coupons[i])) >= 0)
                if (!using_coupons[i].isdelete || using_coupons[i].isdelete && using_coupons[i].isdelete == "N") coupons.push(using_coupons[i]);
    }

    //정렬은 0번째가 현재 회원권 그다음이 미래의 회원권 순
    coupons.sort(sort_by('endtime', false, (a) => a.toUpperCase()));
    if (coupons.length > 1) {
        clog("m coupons ", coupons);
        return coupons[1];
    } else
        return null;
}