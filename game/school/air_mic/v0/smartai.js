     
        /////////////////////////////////////////////
        // STT ??? ???? ?? START
        /////////////////////////////////////////////
                
                let mediaRecorder, audioChunks = [];
                var _lastCallback = null;
               
                async function initMediaRecord() {
                  try {
                    if (!mediaRecorder || mediaRecorder.state === "inactive") {
                        
                      const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                          
                      mediaRecorder = new MediaRecorder(stream);
                          
                      audioChunks = [];
                        
                      mediaRecorder.ondataavailable = e => audioChunks.push(e.data);

                      //??? ????? ????.
                      mediaRecorder.onstop = async () => {
                          
                           const {  callback } = mediaRecorder.customParams || {};
             
                        const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
                        document.getElementById("audioPreview").src = URL.createObjectURL(audioBlob);
//                        document.getElementById("audioPreview").style.display = "block";

                        const formData = new FormData();
                        formData.append("file", audioBlob, "voice.wav");
                        // ? ?? ???? ??
                        formData.append("param1", param_projectid);   //hm_projectid
                        formData.append("param2", param_groupidx);  //hm_groupidx
//                        formData.append("param3", param3);   //(??) json string data ??
             
                        document.getElementById("resultText").textContent = "? ?? ?? ?... ??? ??????.";

                        const res = await fetch("../../../../ssapi/upload_stt.php", { method: "POST", body: formData });
                        const text = await res.text();
                        console.log("?? ??11(raw):", text);

                        let data;
                        try {
                          data = JSON.parse(text);
                            
                        } catch (err) {
                          console.error("? JSON ?? ??:", err);
                          document.getElementById("resultText").textContent =
                            "? ?? ??? JSON ??? ????:\n" + text;
                          return;
                        }
                          
                        console.log("data is ",data);
                        if (data.code == "100") {
                            var message = data.message;
                           
                            
                            if(callback){
                                
                                console.log("callback : ",callback);
                                callback(message);
                                
                            }
                            document.getElementById("resultText").textContent = "?? ????:\n" + data.text;
                            
                        } else {
                            document.getElementById("resultText").textContent = "? ?? ?? ?? ?? ??:\n" + (data.error || "Unknown error");
                            
                        }
                          
                      };
                    }
                      
                  } catch (err) {
                    console.error("?? ??? ?? ??:", err);
//                    alert("??? ?? ??!! ??? ?? ??? ??????. ");
                  }
                }
            
                function onTest(){
                    console.log("onTest!!!");
                }    
                var onGpioTimestamp = 0;
                var userClickTimestamp = 0;
                //??? ??? ?????? ????.
                function onGPIO(){
                    console.log("??? ?????");
                    onGpioTimestamp = (new Date()).getTime();                    
                    isPIRSensor = true;
                }
                function onShowSpeakDialog(){
                     console.log("onShowSpeakDialog !!");
                    C_ShowSpeak();
                }
                function onRecordFinished(isAutoStop, base64Data) {
                    try {
                        //???? ????? ????? ??? ????.
                        if(window._speakDialogLayer && parseInt(isAutoStop) == 1){
                            window._speakDialogLayer.onSpeakDisplayStop();
                        }
                        
                        // ? Base64 ? Blob ??
                        const byteCharacters = atob(base64Data);
                        const byteNumbers = new Array(byteCharacters.length);
                        for (let i = 0; i < byteCharacters.length; i++) {
                            byteNumbers[i] = byteCharacters.charCodeAt(i);
                        }
                        const byteArray = new Uint8Array(byteNumbers);
                        const audioBlob = new Blob([byteArray], { type: "audio/wav" });

//                        if(param1 == "null")param1 = param_projectid;
//                        if(param2 == "null")param2 = param_groupidx;
                        
                        sendMediaFile(audioBlob);
                    } catch (err) {
                        console.error("onRecordFinished Error:", err);
                        document.getElementById("resultText").textContent ="??? ? ?? ??: " + err.message;
                    }
                }
               
                function startMediaRecord() {
                    console.log("startMediaRecord!!");
                    if(window.android){
                        window.android.startRecord();
                    }else {
                        if (mediaRecorder && mediaRecorder.state === "inactive") {
                            mediaRecorder.start();
                            console.log("?? ?? ??");


                      }
                    }
                }
                
                function stopMediaRecord(callback) {
                    _lastCallback = callback;
                    console.log("stopMediaRecord!!");
                    if(window.android){
                        window.android.stopRecord();
                    }else {
                          if (mediaRecorder && mediaRecorder.state === "recording") {
                                mediaRecorder.customParams = {callback};
                                mediaRecorder.stop();
                                console.log("?? ?? ??");
                              initMediaRecord();
                          }
                    }
                }
                
                
//                //??? ???? ????.
//                function getIsCCLayer(cocos_layer_name) {
//                    var scene = cc.director.getRunningScene();
//                    // ??? ??? 'SpeakLayer'?? ???? ??? (this.setName('SpeakLayer'))
//                    var layer = scene.getChildByName(cocos_layer_name); 
//                    if (layer) {
//                        return layer;
//                    }
//                }
                 //????? ????
                async function sendMediaFile(audioBlob){
//                    console.log("param1 "+param1+" param2 "+param2+" audioBlob "+audioBlob);
                     try {
                     // ????
                        document.getElementById("audioPreview").src = URL.createObjectURL(audioBlob);

                        //FormData ??
                        const formData = new FormData();
                        formData.append("file", audioBlob, "voice.wav");
                        formData.append("param1", param_projectid || "");
                        formData.append("param2", param_groupidx || "");
                        formData.append("param3", "");
                        if(now_weatherdata)formData.append("weatherdata",  JSON.stringify(now_weatherdata) || {});
                        if(now_airdata)formData.append("airdata", JSON.stringify(now_airdata) || {});
                         console.log("now_weatherdata ",now_weatherdata);
                         console.log("now_airdata ",now_airdata);
                        document.getElementById("resultText").textContent ="?? ?? ?... ??? ??????.";

                        //?? ???
                        const res = await fetch("../../../../ssapi/upload_stt.php", {
                            method: "POST",
                            body: formData,
                        });

                        const text = await res.text();
                        console.log("?? ??(raw):", text);

                        let data;
                        try {
                            data = JSON.parse(text);
                        } catch (err) {
                            console.error("JSON ?? ??:", err);
                            document.getElementById("resultText").textContent = "?? ??? JSON ??? ????:\n" + text;
                            return;
                        }

                        console.log("data is ", data);
                         
                         //////////////////////
                         //new 
                         //////////////////////
                         
//                         if (data.code == "100") {
//                            var message = data.message;
//                            var dbdata = {};
//                             dbdata["floordata"] = floordata;
//                             dbdata["homedata"] = getgamedata;
//                             
//                             
//                            var question = "??? ?? ??????? json string ?? ???? ???. ???? 1~10?? ??? ?? ???? ???";
//                            question += "??? ??: "+message+"\n";
////                            question +=  "??? ?? ???|{'page':page,'tab':tab,'sub':sub} ???? ??.  contentinfo.hm_content_data ?? ??? ?? ? ???? {'page':page,'tab':tab,'sub':sub} json ? ???? ???| ??? ? ???. ?? ??? ?? ??? DB? ??? {'page':-1,'tab':0,'sub':0}?  ??? ??? ??? ???? ??? ??";
//                            //var str_dbdata = JSON.stringify(dbdata);
//                             var str_dbdata = JSON.stringify(floordata.floordata);
//                            // ????? %20, %22 ??? ???? ???? ??
//                            var safe_dbdata = encodeURIComponent(str_dbdata); 
//
//                            if(window.android){
//                                window.android.processData(safe_dbdata, question);
//                            }
//                            
//                        } else {
//                            document.getElementById("resultText").textContent = "?? ?? ?? ?? ??:" + (data.error || "Unknown error");
//                        }
                         
                         //////////////////////                         
                         //old backup
                         //////////////////////
                         
                        if (data.code == "100") {
                            var message = data.message;
                            
                            console.log("data ?? : ",data);
                            if(_lastCallback){
                                console.log("callback : ",_lastCallback);
                                _lastCallback(message);
                            }else{
//                                var SpeakDialogLayer = getIsCCLayer("SpeakDialogLayer");
                                if(window._speakDialogLayer){
                                    window._speakDialogLayer.onSpeakeCheck(message);
                                }
                            }
                            document.getElementById("resultText").textContent = "????:\n" + data.text;
                        } else {
                            document.getElementById("resultText").textContent = "?? ?? ?? ?? ??:" + (data.error || "Unknown error");
                        }
                    } catch (err) {
                        console.error("sendMediaFile Error:", err);
                        document.getElementById("resultText").textContent ="??? ?? ??: " + err.message;
                    }
                }
                function onAIResult(question, answerdata){
                    var _data = {
                        "projectid":param_projectid, 
                        "groupidx":param_groupidx,
                        "question":question,
                        "answerdata":answerdata,
                    }
                    AJAX_AdmGetGame("sendgptquestion", _data, function(res){ 
                       var code = parseInt(res.code);
                       if (code == 100) {
                            if(_lastCallback){
                                console.log("callback : ",_lastCallback);
                                _lastCallback(res.message);
                            }else{
//                                var SpeakDialogLayer = getIsCCLayer("SpeakDialogLayer");
                                if(window._speakDialogLayer){
                                    window._speakDialogLayer.onSpeakeCheck(res.message);
                                }
                            }

                        }            
                    }); 
                }

                // ??? ?? ? ???
                if(!window.android)window.addEventListener("DOMContentLoaded", initMediaRecord);
        /////////////////////////////////////////////
        // STT ??? ???? ?? END
        /////////////////////////////////////////////