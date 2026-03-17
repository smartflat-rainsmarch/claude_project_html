     
        /////////////////////////////////////////////
        // STT 음성을 텍스트로 변환 START
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

                      //음성을 종료했을때 전송한다.
                      mediaRecorder.onstop = async () => {
                          
                           const {  callback } = mediaRecorder.customParams || {};
             
                        const audioBlob = new Blob(audioChunks, { type: "audio/wav" });
                        document.getElementById("audioPreview").src = URL.createObjectURL(audioBlob);
//                        document.getElementById("audioPreview").style.display = "block";

                        const formData = new FormData();
                        formData.append("file", audioBlob, "voice.wav");
                        // ✅ 추가 파라미터 전달
                        formData.append("param1", param_projectid);   //hm_projectid
                        formData.append("param2", param_groupidx);  //hm_groupidx
//                        formData.append("param3", param3);   //(선택) json string data 넘길
             
                        document.getElementById("resultText").textContent = "🎧 음성 분석 중... 잠시만 기다려주세요.";

                        const res = await fetch("../../../../ssapi/upload_stt.php", { method: "POST", body: formData });
                        const text = await res.text();
                        console.log("서버 응답11(raw):", text);

                        let data;
                        try {
                          data = JSON.parse(text);
                            
                        } catch (err) {
                          console.error("❌ JSON 파싱 오류:", err);
                          document.getElementById("resultText").textContent =
                            "❌ 서버 응답이 JSON 형식이 아닙니다:\n" + text;
                          return;
                        }
                          
                        console.log("data is ",data);
                        if (data.code == "100") {
                            var message = data.message;
                           
                            
                            if(callback){
                                
                                console.log("callback : ",callback);
                                callback(message);
                                
                            }
                            document.getElementById("resultText").textContent = "🗣️ 인식결과:\n" + data.text;
                            
                        } else {
                            document.getElementById("resultText").textContent = "❌ 인식 실패 또는 오류 발생:\n" + (data.error || "Unknown error");
                            
                        }
                          
                      };
                    }
                      
                  } catch (err) {
                    console.error("🎙️ 마이크 접근 실패:", err);
//                    alert("마이크 접근 실패!! 마이크 접근 권한을 허용해주세요. ");
                  }
                }
            
                function onTest(){
                    console.log("onTest!!!");
                }    
                var onGpioTimestamp = 0;
                var userClickTimestamp = 0;
                //센서로 누군가 접근할때마다 호출된다.
                function onGPIO(){
                    console.log("웹뷰내 신호감지됨");
                    onGpioTimestamp = (new Date()).getTime();                    
                    isPIRSensor = true;
                }
                function onShowSpeakDialog(){
                     console.log("onShowSpeakDialog !!");
                    C_ShowSpeak();
                }
                function onRecordFinished(isAutoStop, base64Data) {
                    try {
                        //자동으로 음성듣기를 중단했다면 화면도 변경한다.
                        if(window._speakDialogLayer && parseInt(isAutoStop) == 1){
                            window._speakDialogLayer.onSpeakDisplayStop();
                        }
                        
                        // ✅ Base64 → Blob 변환
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
                        document.getElementById("resultText").textContent ="업로드 중 오류 발생: " + err.message;
                    }
                }
               
                function startMediaRecord() {
                    console.log("startMediaRecord!!");
                    if(window.android){
                        window.android.startRecord();
                    }else {
                        if (mediaRecorder && mediaRecorder.state === "inactive") {
                            mediaRecorder.start();
                            console.log("🎙️ 녹음 시작");


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
                                console.log("⏹️ 녹음 중지");
                              initMediaRecord();
                          }
                    }
                }
                
                
//                //씬에서 레이어를 가져온다.
//                function getIsCCLayer(cocos_layer_name) {
//                    var scene = cc.director.getRunningScene();
//                    // 레이어 이름이 'SpeakLayer'라고 지정되어 있다면 (this.setName('SpeakLayer'))
//                    var layer = scene.getChildByName(cocos_layer_name); 
//                    if (layer) {
//                        return layer;
//                    }
//                }
                 //음성데이터 전송하기
                async function sendMediaFile(audioBlob){
//                    console.log("param1 "+param1+" param2 "+param2+" audioBlob "+audioBlob);
                     try {
                     // 미리보기
                        document.getElementById("audioPreview").src = URL.createObjectURL(audioBlob);

                        //FormData 생성
                        const formData = new FormData();
                        formData.append("file", audioBlob, "voice.wav");
                        formData.append("param1", param_projectid || "");
                        formData.append("param2", param_groupidx || "");
                        formData.append("param3", "");
                        if(now_weatherdata)formData.append("weatherdata",  JSON.stringify(now_weatherdata) || {});
                        if(now_airdata)formData.append("airdata", JSON.stringify(now_airdata) || {});
                         console.log("now_weatherdata ",now_weatherdata);
                         console.log("now_airdata ",now_airdata);
                        document.getElementById("resultText").textContent ="음성 분석 중... 잠시만 기다려주세요.";

                        //서버 업로드
                        const res = await fetch("../../../../ssapi/upload_stt.php", {
                            method: "POST",
                            body: formData,
                        });

                        const text = await res.text();
                        console.log("서버 응답(raw):", text);

                        let data;
                        try {
                            data = JSON.parse(text);
                        } catch (err) {
                            console.error("JSON 파싱 오류:", err);
                            document.getElementById("resultText").textContent = "서버 응답이 JSON 형식이 아닙니다:\n" + text;
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
//                            var question = "질문에 맞는 데이터부분들을 json string 으로 만들어서 보내줘. 우선순위 1~10까지 필요한 부분 데이터만 보내줘";
//                            question += "사용자 질문: "+message+"\n";
////                            question +=  "답변은 짧은 텍스트|{'page':page,'tab':tab,'sub':sub} 데이터로 해줘.  contentinfo.hm_content_data 에서 찾아서 답변 맨 마지막에 {'page':page,'tab':tab,'sub':sub} json 을 만들어줘 구분자| 이거는 꼭 넣어줘. 만약 질문에 대한 답변이 DB에 없다면 {'page':-1,'tab':0,'sub':0}로  바꾸고 답변은 웹에서 검색해서 답변을 해줘";
//                            //var str_dbdata = JSON.stringify(dbdata);
//                             var str_dbdata = JSON.stringify(floordata.floordata);
//                            // 특수문자를 %20, %22 등으로 변환하여 안전하게 전송
//                            var safe_dbdata = encodeURIComponent(str_dbdata); 
//
//                            if(window.android){
//                                window.android.processData(safe_dbdata, question);
//                            }
//                            
//                        } else {
//                            document.getElementById("resultText").textContent = "인식 실패 또는 오류 발생:" + (data.error || "Unknown error");
//                        }
                         
                         //////////////////////                         
                         //old backup
                         //////////////////////
                         
                        if (data.code == "100") {
                            var message = data.message;
                            
                            console.log("data 응답 : ",data);
                            if(_lastCallback){
                                console.log("callback : ",_lastCallback);
                                _lastCallback(message);
                            }else{
//                                var SpeakDialogLayer = getIsCCLayer("SpeakDialogLayer");
                                if(window._speakDialogLayer){
                                    window._speakDialogLayer.onSpeakeCheck(message);
                                }
                            }
                            document.getElementById("resultText").textContent = "인식결과:\n" + data.text;
                        } else {
                            document.getElementById("resultText").textContent = "인식 실패 또는 오류 발생:" + (data.error || "Unknown error");
                        }
                    } catch (err) {
                        console.error("sendMediaFile Error:", err);
                        document.getElementById("resultText").textContent ="전송중 오류 발생: " + err.message;
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

                // 페이지 로드 시 초기화
                if(!window.android)window.addEventListener("DOMContentLoaded", initMediaRecord);
        /////////////////////////////////////////////
        // STT 음성을 텍스트로 변환 END
        /////////////////////////////////////////////