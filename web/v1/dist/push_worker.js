//// main page의 script src는 공유가 되지 않기 때문에 따로 참조해야 한다.
//importScripts("../jquery-3.5.1.min.js");
//
//// postMessage를 보내면 쓰레드를 종료한다.
//postMessage(null);


var global_mypoint = 0;
var global_sms_sendprice = 0;//sms건당금액
var global_lms_sendprice = 0;//lms건당금액
var global_push_sendprice = 0;//푸시건당금액

var global_groupcode = "";
var global_centercode = "";
var global_uid = "";
var global_id = "";
onmessage = function(event){
    console.log("**************************** ai worker start");
    var _msg = event.data;
    var type = _msg.type;
    var datas = _msg.datas;
//    clog("********* Worker type is "+type);

    
    global_groupcode = datas.groupcode;
    global_centercode = datas.centercode;    
    global_uid = datas.uid;    
    global_id = datas.id;    
  
    
    mHandler(type,datas.value,function(v){     
       
        var msg = {"type":type,"datas":v};
//         clog("워커안 : 핸들러 콜백!!!",msg);
        if(v != null)postMessage(msg);        
    });


};

//t : type ,  v : value
function mHandler(t,v,callback){
    //clog("mhandler !!");
    var r = null;
    switch(t){
        case "sendpushmessages":
            
            //test
//            setTimeout(function(){
//                clog("Worker 푸시보내기 성공!!");
//                var result = {"code":100, "message":"success_sendpushmessage"};
//                callback(result);           
//            },7000);
            
//            clog("워커안 : mHandler sendpushmessage");
            //real
            sendReservationPushMessages(v,callback); 
            
            break;
        case "sendsmsmessages":
            
             //test
//            setTimeout(function(){
//                clog("Worker 메세지보내기 성공!!");
//                var result = {"code":100, "message":"success_sendsmsmessage"};
//                callback(result);
//            },8000);
            
//            clog("워커안 : mHandler sendsmsmessage");
            //real
            sendReservationSMSMessages(v,callback); 
            break;

    }
    

}

function sendReservationPushMessages(pushdata,callback){
    pushdata.guid = global_uid;
    pushdata.gid = global_id;
   
    CallHandler("sendpushmessages", StringEnterToBR(pushdata), function(res) {
//        clog("워커안 : 푸시보내기 성공");
        callback(res);
        
    }, function(err) {
         var result = {"code":-1, "message":"error"};
         callback(result);
    });
}
//

function sendReservationSMSMessages(smsdata,callback){
    smsdata.guid = global_uid;
    smsdata.gid = global_id;
   
    
    CallHandler("sendsmsmessages", StringEnterToBR(smsdata), function (res) {
//        clog("워커안 : SMS보내기 성공");
         callback(res);
        
    }, function(err) {
         var result = {"code":-1, "message":"error"};
         callback(result);
    });
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
function replaceBRToEnter(msg){
    if(msg && msg.length > 0){
        msg = msg.replaceAll("<br>", "\r\n");
    }
    return msg;
}


var allmessages = [];
var servertime = "";
function CallHandler(type, data, success, error) {
    data.type = type;
    data.groupcode = global_groupcode;
    data.centercode = global_centercode;
    var url = url = '../../../ssapi/worker_message';
    
    //test
//     if (success) success({"code":100, "message":"success"});

    
    //real
    C_AsyncCall(url, data, function (res) {
        if (success) success(res);       
    }, function (err) {        
        if (error) error(err);        
    });
}

function C_AsyncCall(callurl, options, onComplete, onError) {
 
//    options = "name=kimcoder&age=23";
//    callurl = "http://localhost/games/dev/black/ssapi/test_message";
//    clog("아작스 콜");
    ajax(callurl, options, function(data) {
       //do something with the data like:
//        clog("아작스 리절트");
//        clog("result data ",data);
       if (onComplete) onComplete(data);
    }, 'POST');

}
function clog(t,o){
//    var htype = window.location.hostname.indexOf("localhost") >= 0 ? "localhost" : "blackgym";
//    var drtype = window.location.pathname.indexOf("dev") >= 0 ? "dev" : "real";
//    
//    if(htype == "blackgym" && drtype == "real"){return;}   
//    
//    if(o)clog(t,o);
//    else clog(t);
}

//param string 형태 전송   aa=1&bb=2&..
//var ajax = function(url, data, callback, type) {
//  var data_array, data_string, idx, req, value;
//  if (data == null) {
//    data = {};
//  }
//  if (callback == null) {
//    callback = function() {};
//  }
//  if (type == null) {
//    //default to a GET request
//    type = 'GET';
//  }
//  data_array = [];
//  for (idx in data) {
//    value = data[idx];
//    data_array.push("" + idx + "=" + value);
//  }
//  data_string = data_array.join("&");
//  req = new XMLHttpRequest();
//  req.open(type, url, false);
//  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//  req.onreadystatechange = function() {
//    if (req.readyState === 4 && req.status === 200) {
//      return callback(req.responseText);
//    }
//  };
//  req.send(data_string);
//  return req;
//};

//JSON 전송 
var ajax = function(url, data, callback, type) {
  var req, value;
  if (data == null) {
    data = {};
  }
  if (callback == null) {
    callback = function() {};
  }
  if (type == null) {
    //default to a GET request
    type = 'GET';
  }

  req = new XMLHttpRequest();
  req.open(type, url, true);
  req.setRequestHeader("Content-type", "application/json");
  req.onreadystatechange = function() {
      clog("ajax res ",req);
    if (req.readyState === 4 && req.status === 200) {
      return callback(req.responseText);
    }
  };
  req.send(JSON.stringify(data));
  return req;
};