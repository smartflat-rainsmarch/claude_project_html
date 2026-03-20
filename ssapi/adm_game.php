<?php session_cache_expire(14400);session_start();?>
<?php   
error_reporting(E_ALL); 

ini_set('display_errors',1); 
include('common.php');
include('dbcon.php');
include("acc_log.php");






//POST 값을 읽어온다.
$suid = "";
$sid = "";
$groupidx = 0;
 if(isset($_SESSION['data'.DEV_REAL])){
     $userinfo = $_SESSION['data'.DEV_REAL]['userinfo'];
     $suid = $userinfo['uid'];
     $sid = $userinfo['id'];    
     $groupcode = $userinfo['groupcode'];    
     $groupidx = $userinfo['groupidx'];    
     $myemail = $userinfo['email'];    
     $auth = $userinfo['auth'];
     
}
$uid = $suid;
$id = $sid;


$type = isset($_POST['type']) ? $_POST['type'] : '';
$groupcode = isset($_POST['groupcode']) ? $_POST['groupcode'] : '';
$centercode = isset($_POST['centercode']) ? $_POST['centercode'] : '';

$value = isset($_POST['value']) ? $_POST['value'] : '';

$mbsidx = isset($_POST['mbsidx']) ? $_POST['mbsidx'] : -1;
$date = new DateTime();
$now = $date->format('Y-m-d H:i:s');




//파일업로드시 사용 $type 데이타도 들어옴
$domain = isset($_POST['domain']) ? $_POST['domain'] : '';// type : 
$fileModelID = isset($_POST['modelid']) ? $_POST['modelid'] : 'imsi';// 


{
    ////////////////////////////////////////////////
    // 홈페이지에서 데이터를 가져온다
    ////////////////////////////////////////////////
    if($type == "gethomedata"){
        $hm_projectid = $value; //maecheon1
        
      
        $table_name = 'tb_home';      
        $where = " WHERE hm_projectid = '$hm_projectid'";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $insertedData = $stmt_select->fetch(PDO::FETCH_ASSOC);
        return_json_message(array("code" => "100", "message" => $insertedData));  
        

    }
     else if($type == "sendgptquestion"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_gr_idx = $value["groupidx"]; //maecheon1
        $qs_question = $value["question"];
        $answerdata = $value["answerdata"];
        
        $apiKey = OPENAI_APIKEY;
        
         // GPT에게 보낼 프롬프트 작성
        $prompt = "다음 JSON 데이터를 참고하여 사용자의 질문에 답해주세요. \n\n";
        $prompt .= "JSON 데이터:\n" . $encode_jsondata . "\n\n";
        $prompt .= "사용자 질문: ".$qs_question."\n";
        $prompt .= "답변은 짧은 텍스트|{'page':page,'tab':tab,'sub':sub} 데이터로 해줘.  contentinfo.hm_content_data 에서 찾아서 답변 맨 마지막에 {'page':page,'tab':tab,'sub':sub} json 을 만들어줘 구분자| 이거는 꼭 넣어줘. 만약 질문에 대한 답변이 DB에 없다면 {'page':-1,'tab':0,'sub':0}로  바꾸고 답변은 웹에서 검색해서 답변을 해줘";

        

        // GPT API 호출
        $ch = curl_init("https://api.openai.com/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $apiKey",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "model" => "gpt-4o-mini",   // 최신 GPT 모델
            "messages" => [
                ["role"=>"system", "content"=>"You are a helpful assistant."],
                ["role"=>"user", "content"=>$prompt]
            ],
            "temperature" => 0
        ]));

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            echo json_encode(["error"=>"GPT API 오류: $error"]);
            exit;
        }

    //    echo "response : ".$response;
    //    exit;

       $json_response = json_decode($response, true);
        $arr = array();
        $return_tab_sub_data = array();
        $return_tab_sub_data['question'] = $qs_question;
        if(isset($json_response["choices"][0]["message"]["content"])){
            $str_content =  $json_response["choices"][0]["message"]["content"];        
            $arr = explode("|", $str_content);    

        }
    //    echo "arr is : ".json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    //    exit;
        if(count($arr) >= 2){

            $qs_answer = $arr[0];
            $raw = $arr[1];
            $raw = str_replace("'", '"', $raw);  // 작은따옴표를 큰따옴표로 변경
            $tabsub = json_decode($raw, true);

    //        echo "tab ".$tabsub["tab"];
    //        echo "sub ".$tabsub["sub"];
    //        exit;

            $return_tab_sub_data['answer'] = $qs_answer;
            $return_tab_sub_data['tab'] = array_key_exists('tab', $tabsub) ? (int)$tabsub['tab'] : -1;
            $return_tab_sub_data['sub'] = array_key_exists('sub', $tabsub) ? (int)$tabsub['sub'] : -1;

        }
        //qs_othercode 에 json string 으로 넣기 위해
        $json_othercode = array();
        $json_othercode["tab"] = isset($return_tab_sub_data["tab"]) ? $return_tab_sub_data["tab"] : -1;
        $json_othercode["sub"] = isset($return_tab_sub_data["sub"]) ? $return_tab_sub_data["sub"] : -1;
        $encode_othercode = json_encode($json_othercode, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        //////////////////////////////////////////
        //GPT가 답변했을때 저장한다.
        //////////////////////////////////////////
        $table_name = "tb_question";
        $tb_question = array(
            'qs_title'   => $qs_question,
            'qs_answer'         => $qs_answer,
            'qs_othercode'     => $encode_othercode,
            'qs_projectid'     => $hm_projectid,
            'qs_groupidx'     => $hm_groupidx
        );

        $keys = array_keys($tb_question);
        $columns = implode(",",$keys);
        $datas  = array_values($tb_question);
        $values = implode("','",$datas);
        $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";

        $stmt = $con->prepare($sql);
        $stmt->execute();

        return_json_message(array("code" => "100", "message" => $return_tab_sub_data));       
    }
    else if($type == "newgethomedata"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_gr_idx = $value["groupidx"]; //maecheon1
        
      
        $table_name = 'tb_home';      
        $where = " WHERE hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_gr_idx";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $insertedData = $stmt_select->fetch(PDO::FETCH_ASSOC);
        return_json_message(array("code" => "100", "message" => $insertedData));


    }
    else if($type == "updatehmother"){
        $hm_projectid = $value["projectid"];
        $hm_gr_idx = (int)$value["groupidx"];
        $hm_other = $value["hm_other"];

        $sql = "UPDATE tb_home SET hm_other = :hm_other WHERE hm_projectid = :pid AND hm_gr_idx = :gidx";
        $stmt = $con->prepare($sql);
        $stmt->execute([
            ':hm_other' => $hm_other,
            ':pid' => $hm_projectid,
            ':gidx' => $hm_gr_idx
        ]);

        return_json_message(array("code" => "100", "message" => "저장 완료"));
    }
    else if($type == "getranking"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        
        $table_name = 'tb_home';      
        $where = " WHERE hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_groupidx";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        
        return_json_message(array("code" => "100", "message" => $row["hm_ranking"]));  
        

    }
    else if($type == "getrankinglist"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        $type = isset($value["type"]) ? $value["type"] : "lyrics";
        $table_name = 'tb_home';      
        $where = " WHERE hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_groupidx";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        
        $hm_ranking = json_decode($row["hm_ranking"], true);
        $ranklist = isset($hm_ranking[$type]) ? $hm_ranking[$type] : array();
        
        return_json_message(array("code" => "100", "message" => $ranklist));  
        

    }
    else if($type == "setranking"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        $hm_ranking = $value["ranking"]; //maecheon1
        
       
         $table_name = 'tb_home';      
        $encode_ranking = json_encode($hm_ranking,JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        $sql = "UPDATE $table_name SET hm_ranking='$encode_ranking' where hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_groupidx";      
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        return_json_message(array("code" => "100", "message" => "success"));  
    }
    else if($type == "updatefcmtoken"){
        $hm_projectid = $value["projectid"]; 
        $hm_groupidx = (int)$value["groupidx"]; 
        $hm_fcmtoken = $value["fcmtoken"];         
       
        $table_name = 'tb_home';      
        
        $sql = "UPDATE $table_name SET hm_fcmtoken='$hm_fcmtoken' where hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_groupidx";      
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        return_json_message(array("code" => "100", "message" => "success"));  
    }
    else if($type == "deletevideofile"){
        $projectid = $value["projectid"];
        $groupidx = (int)$value["groupidx"];
        $path = $value["path"];
        $table_name = 'tb_home';      
        
        $where = " WHERE hm_projectid = '$projectid' and hm_gr_idx=$groupidx";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        
        if($row["hm_videolist"] != "" && $row["hm_videolist"] != "[]"){
            $json_videolist = json_decode($row["hm_videolist"],true);
            $new_videolist = array();
            for($i = 0 ; $i < count($json_videolist);$i++){
                $videodata = $json_videolist[$i];
                if($videodata["path"] != $path){
                    array_push($new_videolist,$videodata);
                }
            }  
            $encode_videolist = json_encode($new_videolist, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $sql = "UPDATE $table_name SET hm_videolist='$encode_videolist' $where";
            $stmt = $con->prepare($sql);        
            $stmt->execute();
        }
        return_json_message(array("code" => 100, "message" => "비디오파일데이터 DB에서 삭제완료"));  
    }
    else if($type == "getvideolist"){
        $hm_projectid = $value["projectid"]; 
        $hm_groupidx = (int)$value["groupidx"]; 
//        $hm_fcmtoken = $value["fcmtoken"];         
       
        $table_name = 'tb_home';      
        $where = " WHERE hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_groupidx";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        return_json_message(array("code" => "100", "message" => $row["hm_videolist"]));  
    }
     else if($type =="push"){
        $fcmtoken = isset($value["fcmtoken"]) ? $value["fcmtoken"] : "";
        $command = isset($value["command"]) ? $value["command"] : "";
        $seq= isset($value["seq"]) ? $value["seq"] : "";
        $appid = APPID_SMARTFLAT_LITE;
        $now = date("Y-m-d H:i:s");
        
        
        $timestamp = time();
       $fields = array(         
            "message" => array(
                'token' => $fcmtoken,
                'data' => array(
                   "command"=> $command,
                   "seq" => $seq,
                   "control" => $seq,
                   "timestamp" => $timestamp."",
                   "required" => "true",
                   "accept_time" => ($timestamp+10000).""                    
                ),
            ),
        );
    
        fcmPushMessageHTTPV1($con, $fields, $appid);
       
        return_json_message(array("code" => 100, "message" => "푸시전송성공"));  
        
    }
    //neis 에서 가져온 학교정보 입력한다.
//     else if($type == "type_insert_school_code"){ //image,type,appid 사용
//        $pm_info = array(
//            'sc_schoolname'=>$schooldata["학교명"],                               //이값이 아이디이다.
//            'sc_uuid'=>$uuid,                              //유저 UID
//            'sc_sidocode'=>$schooldata["시도교육청코드"],                              //유저 ID
//            'sc_standardcode'=>$standardcode,
//
//            'sc_sidoname'=>$schooldata["시도교육청명"],
//            'sc_address1'=>$schooldata["도로명주소"],
//            'sc_address2'=>$schooldata["도로명상세주소"],
//            'sc_phone'=>$schooldata["전화번호"],
//            'sc_zipcode'=>$schooldata["도로명우편번호"],
//            'sc_homepage'=>$schooldata["홈페이지주소"]
//
//        );
//        $keys = array_keys($pm_info);
//        $columns = implode(",",$keys);
//        $datas  = array_values($pm_info);
//        $values = implode("','",$datas);
//
//        $sql = "INSERT INTO `tb_school` ($columns) VALUES ('".$values."')";
//        $stmt = $con->prepare($sql);
//        if($stmt->execute()){
//
//            return_json_message(array("code" => "100", "message" => "success"));     
//        }else{
//            return_json_message(array("code" => "-1", "message" => "error"));     
//        }
//       
//         
//    }
    else if($type == "changelanguage"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        $languagecode = $value["languagecode"];
        $table_name = "tb_home";
        $sql = "UPDATE $table_name SET hm_language='$languagecode' where hm_projectid='$hm_projectid' and hm_gr_idx=$hm_groupidx;";
        $stmt = $con->prepare($sql);        
        if($stmt->execute()){
            return_json_message(array("code" => "100", "message" => "success"));         
        }else{
            return_json_message(array("code" => "-1", "message" => "error"));         
        }
    }
    else if($type == "deletepdffile"){
        $projectid = $value["projectid"]; //maecheon1
        $groupidx = (int)$value["groupidx"]; //maecheon1
        $pdfidx = $value["pdfidx"];
        $pdfmanageid = $value["pdfmanageid"];
        
        $table_name = "tb_pdf";
        
        $result = get_aes_sql_array($con, "SELECT * FROM", $table_name, " WHERE pdf_manageid='$pdfmanageid';");
        $result_count = $result["count"];
        $result_row = $result["row"];
        
        for($i = 0 ; $i < count($result_row); $i++){
            $filename = $result_row[$i]["pdf_filename"];
            $languagecode = $result_row[$i]["pdf_language"];
            $pdfcategory = $result_row[$i]["pdf_category"];
            $deleteDir = "../game/school/$projectid/v$groupidx/contentdata/pdf/$languagecode/$pdfcategory/$filename";
            if(is_file($deleteDir))
                unlink($deleteDir);
        }

        if($result_count > 0){
            $query = "DELETE from $table_name WHERE pdf_manageid='".$result_row[0]["pdf_manageid"]."'";
           
            $stmt5 = $con->prepare($query);
            $stmt5->execute();

            return_json_message(array("code" => "100", "message" => "success"));       
        }else {
            return_json_message(array("code" => "100", "message" => "success!"));       
        }
           
        
    }
     else if ($type == "senddefaultpdf") {
        $obj_value = json_decode($value, true);
        $projectid = $obj_value["projectid"];
        $groupidx = $obj_value["groupidx"];
        $pdfcategory = $obj_value["pdfcategory"];
        $pdfidx = isset($obj_value["pdfidx"]) ? $obj_value["pdfidx"] : null; //값이 있다면 언어별로 다찾아서(5개) 모두 업데이트한다.
        $pdfdatas = $obj_value["pdfdatas"];//언어별 pdfdatas
        $newFilePaths = array(); // 업로드된 파일 경로를 저장할 배열
        $isfiles = [false,false,false,false,false];
        
        // 파일 업로드 처리
        if (isset($_FILES['files'])) {  // 'file'에서 'files'로 변경
            $files = $_FILES['files'];  // $_FILES['files']로 받음

            // 여러 파일 처리
            $cnt = 0;
            foreach ($files['name'] as $key => $name) {
                // 각 파일에 대한 정보 추출
                $filename = $name;
                $tmpFilePath = $files['tmp_name'][$key];
                $fileError = $files['error'][$key];
                $languagecode = $pdfdatas[$cnt]["pdf_language"];                
                
                // 파일이 올바르게 업로드되었는지 확인
                if ($fileError === UPLOAD_ERR_OK) {
                   
                    // 파일을 저장할 디렉토리 경로 설정
                    $uploadDir = "../game/school/$projectid/v$groupidx/contentdata/pdf/$languagecode/$pdfcategory/";

                    if (!is_dir($uploadDir))
                        mkdir($uploadDir, 0777, true);

                    // 파일을 새 경로로 이동
                    $newFilePath = $uploadDir . $filename;
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $newFilePaths[] = $newFilePath; // 배열에 파일 경로 추가
//                        array_push($newFilePaths, $newFilePath);
                    } else {
                        // 파일 이동 실패
                        return_json_message(array("code" => -1, "message" => "파일 이동 실패: " . $filename));
                    }
                    
                     $isfiles[$cnt] = true;
                    
                    
                    
                    
                } else {
                    // 파일 업로드 실패 (개별 파일)
                    return_json_message(array("code" => -1, "message" => "파일 업로드 실패: " . $filename));
                }
                $cnt++;
            }
        } else {
            // 파일이 제대로 전송되지 않았음
            // return_json_message(array("code" => -1, "message" => "파일이 제대로 전송되지 않았음")); // 파일 없을때도 메일은 보내야 할 수도 있으므로, 이부분 제거.
        }
        
        $table_name = 'tb_pdf';      
        
        $pdf_idxs = array();
         $stmt = null;
        for($i = 0; $i < count($isfiles);$i++){
            if($isfiles[$i] == true){
                $pdfdata = $pdfdatas[$i];
                $company = isset($pdfdata["pdf_company"]) ? $pdfdata["pdf_company"] : "";
                
                $json = json_encode($pdfdata["pdf_other"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
           
                $json = str_replace("'", "\'", $json);
                $tb_pdf = array(
                    'pdf_category'=>$pdfdata["pdf_category"],
                    'pdf_filename'=>$pdfdata["pdf_filename"],              
                    'pdf_companyid'=>$pdfdata["pdf_companyid"],              
                    'pdf_manageid'=>$pdfdata["pdf_manageid"],              
                    'pdf_company'=>$company,              
                    'pdf_workplace'=>$pdfdata["pdf_workplace"],              
                    'pdf_language'=>$pdfdata["pdf_language"],              
                    'pdf_startdate'=>$pdfdata["pdf_startdate"],              
                    'pdf_enddate'=>$pdfdata["pdf_enddate"],              
                    'pdf_other'=>$json,
                    'pdf_projectid'=>$pdfdata["pdf_projectid"],              
                    'pdf_groupidx'=>$pdfdata["pdf_groupidx"]

                );
                
                $keys = array_keys($tb_pdf);
                $columns = implode(",",$keys);
                $datas  = array_values($tb_pdf);
                $values = implode("','",$datas);
                $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."');";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                 // ✅ 삽입된 ID 얻기
                $rqidx = $con->lastInsertId();

                array_push($pdf_idxs, $rqidx);

            }
        }
        if($stmt != null)$stmt->closeCursor();   
         
         
         if(count($pdf_idxs) > 0){
             $ids = implode(",", $pdf_idxs);
             if(count($pdf_idxs) == 1){
                 $where = " WHERE pdf_idx = ".$pdf_idxs[0].";";
                 $sql= "select * from $table_name $where";
        
                 $stmt = $con->prepare($sql);
                 $stmt->execute();
                 $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 $result_row = array();
                 array_push($result_row, $row);
                 return_json_message(array("code" => "100", "message" => $result_row)); 
             }else if(count($pdf_idxs) > 1){
                 $where = " WHERE pdf_idx IN ($ids);";

                 $result = get_aes_sql_array($con, "SELECT * FROM", $table_name,  $where);        
                 $result_count = $result["count"];
                 $result_row = $result["row"];
                 return_json_message(array("code" => "100", "message" => $result_row)); 
             }
                

           
         }else{
              return_json_message(array("code" => "-1", "message" => "업로드할 PDF 파일이 없습니다.")); 
         }
        
        
    }
    
     else if ($type == "sendupdatepdf") {
        $obj_value = json_decode($value, true);
//         $obj = json_encode( $obj_value["pdfdatas"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//         $trimmed = trim($obj, '"');

//         $testother = json_decode($obj_value["pdfdatas"][0]["pdf_other"], true);
//        echo $obj_value["projectid"];
//         exit;
//         
        $projectid = $obj_value["projectid"];
        $groupidx = $obj_value["groupidx"];
        $pdfcategory = $obj_value["pdfcategory"];
        $pdfidx = isset($obj_value["pdfidx"]) ? $obj_value["pdfidx"] : null; //값이 있다면 언어별로 다찾아서(5개) 모두 업데이트한다.
        $pdfdatas = $obj_value["pdfdatas"];//언어별 pdfdatas
        $newFilePaths = array(); // 업로드된 파일 경로를 저장할 배열
        $isfiles = [false,false,false,false,false];
        
        // 파일 업로드 처리
        if (isset($_FILES['files'])) {  // 'file'에서 'files'로 변경
            $files = $_FILES['files'];  // $_FILES['files']로 받음

            // 여러 파일 처리
            $cnt = 0;
            foreach ($files['name'] as $key => $name) {
                // 각 파일에 대한 정보 추출
                $filename = $name;
                $tmpFilePath = $files['tmp_name'][$key];
                $fileError = $files['error'][$key];
                $languagecode = $pdfdatas[$cnt]["pdf_language"];                
                
                // 파일이 올바르게 업로드되었는지 확인
                if ($fileError === UPLOAD_ERR_OK) {
                   
                    // 파일을 저장할 디렉토리 경로 설정
                    $uploadDir = "../game/school/$projectid/v$groupidx/contentdata/pdf/$languagecode/$pdfcategory/";

                    if (!is_dir($uploadDir))
                        mkdir($uploadDir, 0777, true);

                    // 파일을 새 경로로 이동
                    $newFilePath = $uploadDir . $filename;
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $newFilePaths[] = $newFilePath; // 배열에 파일 경로 추가
//                        array_push($newFilePaths, $newFilePath);
                    } else {
                        // 파일 이동 실패
                        return_json_message(array("code" => -1, "message" => "파일 이동 실패: " . $filename));
                    }
                    
                     $isfiles[$cnt] = true;
                    
                    
                    
                    
                } else {
                    // 파일 업로드 실패 (개별 파일)
                    return_json_message(array("code" => -1, "message" => "파일 업로드 실패: " . $filename));
                }
                $cnt++;
            }
        } else {
            // 파일이 제대로 전송되지 않았음
            // return_json_message(array("code" => -1, "message" => "파일이 제대로 전송되지 않았음")); // 파일 없을때도 메일은 보내야 할 수도 있으므로, 이부분 제거.
        }
        
        $table_name = 'tb_pdf';              
        $pdf_idxs = array();
        $stmt = null;
        for($i = 0; $i < count($isfiles);$i++){
            $pdfdata = $pdfdatas[$i];
            $json = json_encode($pdfdata["pdf_other"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            
          
            $json = str_replace("'", "\'", $json);
            $pdfidx = isset($pdfdata["pdf_idx"]) && (int)$pdfdata["pdf_idx"] > 0 ? $pdfdata["pdf_idx"] : 0;
            if($pdfidx > 0){
                $sql = "UPDATE $table_name SET pdf_manageid='".$pdfdata["pdf_manageid"]."', pdf_filename='".$pdfdata["pdf_filename"]."', pdf_company='".$pdfdata["pdf_company"]."', pdf_companyid='".$pdfdata["pdf_companyid"]."', pdf_workplace='".$pdfdata["pdf_workplace"]."', pdf_startdate='".$pdfdata["pdf_startdate"]."', pdf_enddate='".$pdfdata["pdf_enddate"]."' , pdf_other='".$json."' where pdf_idx=".$pdfdata["pdf_idx"].";";

                $stmt = $con->prepare($sql);        
                $stmt->execute();
            }
        }
        if($stmt != null)$stmt->closeCursor();   
        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));  
         
        
    }
    else if($type == "updatecompaniesdata"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        $companiesdata = $value["companiesdata"];
        
          $table_name = "tb_home";
        $encode_companiesdata = json_encode($companiesdata, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $sql = "UPDATE $table_name SET hm_other='$encode_companiesdata' where hm_projectid='$hm_projectid' and hm_gr_idx=$hm_groupidx;";
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        
        return_json_message(array("code" => "100", "message" => "success"));        
    }
    else if($type == "getpdflist"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        $languagecode = isset($value["languagecode"]) ? $value["languagecode"] : null;
        $pdfcategory = $value["pdfcategory"];        
        $page = $value["page"];        
        $max = $value["max"];
        $table_name = "tb_pdf";
         
        if($languagecode != null)
            $result = get_aes_sql_array($con, "SELECT * FROM", $table_name,  " WHERE pdf_projectid = '$hm_projectid' and pdf_groupidx=$hm_groupidx and pdf_category='$pdfcategory' and pdf_language='$languagecode';");
        else 
            $result = get_aes_sql_array($con, "SELECT * FROM", $table_name,  " WHERE pdf_projectid = '$hm_projectid' and pdf_groupidx=$hm_groupidx and pdf_category='$pdfcategory';");
        
        $result_count = $result["count"];
        $result_row = $result["row"];
        return_json_message(array("code" => "100", "message" => $result_row));       
        
    }
    else if($type == "getsafetydata"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        
        
        $region = getTBHomeRegion($con, $hm_projectid, $hm_groupidx);
        
        $safetydata = checkSafetyData($con, $region);
        

        $json_data = isset($safetydata) ? json_decode($safetydata, true) : null;
        $datas = array();
        //////////////////////////////////
        //test START
        //////////////////////////////////
//        $json_data = array(
//            "header" => array(
//                "resultMsg" => "NORMAL SERVICE",
//                "resultCode" => "00",
//                "errorMsg" => null
//            ),
//            "numOfRows" => 10,
//            "pageNo" => 1,
//            "totalCount" => 4,
//            "body" => array(
//                array(
//                    "MSG_CN" => "오늘 오후부터 내일 오전까지 많은비가 예상됩니다. 위험지역(저지대,지하공간,산,하천 등) 접근금지 및 사전대피, 낙뢰시 실내이동 등 안전에 유의바랍니다.[당진시]",
//                    "RCPTN_RGN_NM" => "경기도 시흥시 ",
//                    "CRT_DT" => "2025/09/24 11:37:48",
//                    "REG_YMD" => "2025/09/24 11:37:49.000000000",
//                    "EMRG_STEP_NM" => "안전안내",
//                    "SN" => 249905,
//                    "DST_SE_NM" => "호우",
//                    "MDFCN_YMD" => "2025/09/24 11:46:58.000000000"
//                ),
//                array(
//                    "MSG_CN" => "금일(24일) 오후부터 강풍을 동반한 비가 예상되오니 ▲ 야외활동 자제 ▲ 위험지역 접근 자제 ▲ 저지대 침수 주의 등 안전에 유의하시기 바랍니다.[신안군]",
//                    "RCPTN_RGN_NM" => "전라남도 신안군 ",
//                    "CRT_DT" => "2025/09/24 10:12:00",
//                    "REG_YMD" => "2025/09/24 10:12:09.000000000",
//                    "EMRG_STEP_NM" => "안전안내",
//                    "SN" => 249891,
//                    "DST_SE_NM" => "호우",
//                    "MDFCN_YMD" => "2025/09/24 10:21:58.000000000"
//                ),
//                array(
//                    "MSG_CN" => "금일 오후부터 강한 바람과 많은 비가 내릴 것으로 예상되니 간판·시설하우스 등 고정, 배수구 점검 등 사전 대비에 적극 협조해 주시기 바랍니다.[부여군]",
//                    "RCPTN_RGN_NM" => "충청남도 부여군 ",
//                    "CRT_DT" => "2025/09/24 10:28:39",
//                    "REG_YMD" => "2025/09/24 10:28:48.000000000",
//                    "EMRG_STEP_NM" => "안전안내",
//                    "SN" => 249892,
//                    "DST_SE_NM" => "호우",
//                    "MDFCN_YMD" => "2025/09/24 10:37:58.000000000"
//                ),
//                array(
//                    "MSG_CN" => "금일 인천지역 호우예비특보 발효(12~18시). 많은 비가 예상되오니 하천 주변,농수로,지하주차장 침수 등 위험발생 시 접근금지 및 안전에 유의하세요.[계양구청]",
//                    "RCPTN_RGN_NM" => "인천광역시 계양구 ",
//                    "CRT_DT" => "2025/09/24 09:21:29",
//                    "REG_YMD" => "2025/09/24 09:21:39.000000000",
//                    "EMRG_STEP_NM" => "안전안내",
//                    "SN" => 249890,
//                    "DST_SE_NM" => "호우",
//                    "MDFCN_YMD" => "2025/09/24 09:30:58.000000000"
//                )
//            )
//        );
    
        //////////////////////////////////
        //test END
        //////////////////////////////////
      
        if(isset($json_data) && isset($json_data["body"])){
            $arr = $json_data["body"];
            for($i = 0; $i < count($arr); $i++){
                 if (containsStr($arr[$i]["RCPTN_RGN_NM"], $region))
                 {
                     array_push($datas, $arr[$i]);
                 }
            }            
        }
        
        return_json_message(array("code" => "100", "message" => $datas));
    }
    //neis 에서 정보가져온다. //식단 / 시간표 / 학사일정
    else if($type == "type_getschooldata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = isset($value["groupidx"]) ? (int)$value["groupidx"] : 1;       // 예: 1  매천중이기때문에 최초 1로 한다.
        
        $list_name_id = $value["listnameid"]; // 게시판 아이디 (ex. mylist1)
        $pagenum       = max(1, intval($value["pagenum"])); // 현재 페이지
        $listmax       = max(1, intval($value["listmax"])); // 한 페이지당 개수
        $tgrade = isset($value["tgrade"]) ? $value["tgrade"] : "";       //시간표 - 학년        string
        $tclass = isset($value["tclass"]) ? $value["tclass"] : "";       //시간표 - 학급(반)     string
        //test
        
        $apitype = $value["apitype"]; //mealServiceDietInfo(식단표) , misTimetable(시간표) , SchoolSchedule(학사일정)
        
        $table_name = 'tb_school';     
        $sc_uuid = $projectid."|".$groupidx;
        if($projectid == "maecheon"){
            $sql = "SELECT * FROM $table_name WHERE sc_uuid LIKE '%maecheon%'";
        }else 
            $sql= "select * from $table_name where sc_uuid = '".$sc_uuid."'";
        
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $schooldata = $stmt->fetch(PDO::FETCH_ASSOC);


       
        if($schooldata != null){
             
                // 사용 예시
                $key = "815fc634d06a40aaadd5350d5a1decdf";//smartflat@digigroove.co.kr , 
                $date = new DateTime();
     
                //mealServiceDietInfo(식단표)
                if($apitype == "mealServiceDietInfo"){
                    // 한 달 전으로 이동
                    $date->modify('-1 month');            
                    // YYYYMMDD 형식으로 포맷팅
                    $previousMonth = $date->format('Ymd');
     
                    $url = "https://open.neis.go.kr/hub/mealServiceDietInfo"; //학교급식데이터
                    $postData = array(
                        "Key" => $key, //인증키
                        "Type" => "json",//호출 문서(xml, json)
                        "pIndex" => $pagenum,//페이지 위치
                        "pSize" => $listmax,//페이지 당 요청 숫자
                        "ATPT_OFCDC_SC_CODE" => $schooldata["sc_sidocode"]."",//시도교육청구분코드
                        "SD_SCHUL_CODE" => $schooldata["sc_standardcode"],//행정표준코드
                        // "MMEAL_SC_CODE" => 2, //식사구분코드  아침:1, 점심:2, 저녁3: 일거같음
                        // "MLSV_YMD" => "20241211",//급식일자
                        "MLSV_FROM_YMD" => $previousMonth//급식시작일자
                        // "MLSV_TO_YMD" => "20241211"//급식종료일자
                    );
      
                    $response = postToNeisAPI($url,  str_replace(" ", "", $postData));
                    $jsonResponse = json_decode($response,true);
                }
                //misTimetable(시간표)
                else if($apitype == "elsTimetable" || $apitype == "misTimetable" || $apitype == "hisTimetable"){
                    // 한 달 전으로 이동
                    $date->modify('-1 month');            
                    // YYYYMMDD 형식으로 포맷팅
                    $previousMonth = $date->format('Ymd');

                    $url = "https://open.neis.go.kr/hub/misTimetable"; //학교시간표  //elsTimetable, misTimetable hisTimetable
                    $postData = array(
                        "Key" => $key, //인증키
                        "Type" => "json",//호출 문서(xml, json)
                        "pIndex" => $pagenum,//페이지 위치
                        "pSize" => $listmax,//페이지 당 요청 숫자
                        "ATPT_OFCDC_SC_CODE" => $schooldata["sc_sidocode"]."",//시도교육청구분코드
                        "SD_SCHUL_CODE" => $schooldata["sc_standardcode"],//행정표준코드
                        // "AY" => 1, //학년도
                        // "SEM" => "1",//학기
                        // "ALL_TI_YMD" => "1",//시간표일자
                       // "DGHT_CRSE_SC_NM" => "1",//주야과정명
                        "GRADE" => $tgrade,// 학년
                        "CLASS_NM" => $tclass,//학급명
                       // "PERIO" => "1",//교시
                       // "TI_FROM_YMD" => "1",//시간표시작일자
                       // "TI_TO_YMD" => "20241211"//시간표종료일자
                       
                    );

                    $response = postToNeisAPI($url,  str_replace(" ", "", $postData));
                    $jsonResponse = json_decode($response,true);

                }
                //SchoolSchedule(학사일정)
                else if($apitype == "SchoolSchedule"){
                   
                    // 한 달 전으로 이동
                    $date->modify('-1 month');            
                    // YYYYMMDD 형식으로 포맷팅
                    $previousMonth = $date->format('Ymd');

                    $url = "https://open.neis.go.kr/hub/SchoolSchedule"; //학교급식데이터
                    $postData = array(
                        "Key" => $key, //인증키
                        "Type" => "json",//호출 문서(xml, json)
                        "pIndex" => $pagenum,//페이지 위치
                        "pSize" => $listmax,//페이지 당 요청 숫자
                        "ATPT_OFCDC_SC_CODE" => $schooldata["sc_sidocode"],//시도교육청구분코드
                        "SD_SCHUL_CODE" => $schooldata["sc_standardcode"],//행정표준코드
                        // "DGHT_CRSE_SC_NM" => , // 주야과정명
                        // "SCHUL_CRSE_SC_NM" => ,// 학교과정명
                        // "AA_YMD" => "20241211",// 학사일자
                        "AA_FROM_YMD" => $previousMonth//학사시작일자
                        // "AA_TO_YMD" => "20241211"//학사종료일자
                    );

                    $response = postToNeisAPI($url,  str_replace(" ", "", $postData));
                    $jsonResponse = json_decode($response,true);

                }


                if ($response) {
                    return_json_message(array("code" => "100", "message" => $jsonResponse));
                } else {
                    return_json_message(array("code" => "-1", "message" => "error"));   
                }
        }else{
            return_json_message(array("code" => "-100", "message" => "error"));   
        }
    }
    
    else if($type == "getweatherdata"){
//        header('Content-Type: application/json; charset=utf-8');
       
        $mode = $value["mode"];
        $sido = isset($value["sido"]) ? $value["sido"] : "서울";
        $gu = isset($value["gu"]) ? $value["gu"] : "";
        $dong = isset($value["dong"]) ? $value["dong"] : "";
        
        
        $now = new DateTime();
        $yyyymmddhh = $now->format('Y-m-d H');
        $pa_updatedate = $yyyymmddhh.":00:00";
        
        $pa_addr = $sido." ".$gu." ".$dong;
       
        if($mode == "today"){
            ////////////////////////////////////
            //   오늘날씨 최저 최고 기온 현재기온 구할때 
            ////////////////////////////////////        
            
            $result = getVilageFcst($con, $sido, $pa_addr, $pa_updatedate);     
            
            return_json_message(array("code" => "100", "message" => $result["result"]));
        }
        
        
        //아직여기사용안함
        //아직여기사용안함
        //아직여기사용안함
        ////////////////////////////////////
        //   오늘날씨 내일날씨 구할때 호출
        ////////////////////////////////////
        
        // 입력 파라미터 받기
        // 현재 시간 기준 5분 전
        // 현재 시간 기준
        
        $pa_title = "오늘/내일날씨";
        $pa_type = "weather_tt";
        
        $table_name = "tb_publicapi";
        $pa_addr = $sido." ".$gu." ".$dong;
        $sql="SELECT * FROM $table_name WHERE pa_addr = '$pa_addr' and pa_type='$pa_type';";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        $status = "";
        if($stmt->rowCount() == 0){  
           $status = "insert";
        }else {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row["pa_updatedate"] != $pa_updatedate)
                $status = "update";
        }
        
     
        
        if($status != ""){
             $curHour = (int)$now->format('H');

            // 조건에 따라 기준 시간/날짜 설정
            if ($curHour < 3) {
                // 새벽 0~2시 → 어제 23시
                $baseDate = (new DateTime())->modify('-1 day')->format('Ymd');
                $baseTime = "2300";
            } else {
                // 3시 이후 → 오늘 02시
                $baseDate = $now->format('Ymd');
                $baseTime = "0200";
            }

            $nx    = isset($_POST['nx']) ? $_POST['nx'] : null;
            $ny    = isset($_POST['ny']) ? $_POST['ny'] : null;
            $nx = 60; //seoul
            $ny = 127; //seoul

            // 필수값 체크
            if (!$baseDate || !$baseTime || !$nx || !$ny) {
                echo json_encode([
                    "result" => "FAIL",
                    "message" => "필수 파라미터가 누락되었습니다."
                ]);
                exit;
            }

            // 기상청 API 키 (개인 발급받은 키를 넣으세요)
             $serviceKey = AIR_APIKEY;

            // API URL 구성
            $baseUrl = "http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getVilageFcst";
            $queryParams = http_build_query([
                "ServiceKey" => $serviceKey,
                "base_date"  => $baseDate,
                "base_time"  => $baseTime,
                "nx"         => $nx,
                "ny"         => $ny,
                "numOfRows"  => 510,
                "pageNo"     => 1,
                "dataType"   => "JSON"
            ]);

            $url = $baseUrl . "?" . $queryParams;

            // cURL 요청
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-type: application/json;charset=utf-8"
            ]);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if($httpCode >= 200 && $httpCode < 300 ){
                
                if($status == "insert")
                    insertPublicApi($con, $pa_title, $pa_addr, $pa_type, $pa_updatedate, $response);               
                else if($status == "update")
                    updatePublicApi($con, $pa_title, $pa_addr, $pa_type, $pa_updatedate, $response);               
                
                
                return_json_message(array("code" => "100", "message" => $response));       
            }else {
//                return_json_message(array("code" => "-1", "message" => "날씨데이터 가져오기 실패"));     
                
                $response = json_decode($row["pa_data"], true);
                return_json_message(array("code" => "100", "message" => $response));       
            }
        }else{
            $response = json_decode($row["pa_data"], true);
            return_json_message(array("code" => "100", "message" => $response));       
        }
        
        
        
        
    }
    else if($type == "getairdata"){
   
//        header('Content-Type: application/json; charset=utf-8');
        $sido = isset($value["sido"]) ? $value["sido"] : "서울";
        $gu = isset($value["gu"]) ? $value["gu"] : "";
        $dong = isset($value["dong"]) ? $value["dong"] : "";
        
        $pa_title = "미세먼지 수치";
        $now = new DateTime();
        $yyyymmddhh = $now->format('Y-m-d H');
        $pa_updatedate = $yyyymmddhh.":00:00";
        
        $pa_addr = $sido." ".$gu." ".$dong;
        
        $pa_type = "air";
        
        $table_name = "tb_publicapi";
        $pa_addr = $sido." ".$gu." ".$dong;
        $sql="SELECT * FROM $table_name WHERE pa_addr = '$pa_addr' and pa_type='$pa_type';";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
        $status = "";
        if($stmt->rowCount() == 0){              
           $status = "insert";
            
        }else {            
      
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
           
            
            if($row["pa_updatedate"] != $pa_updatedate){
                $status = "update";
            }                
        }
        return_json_message(array("code" => "100", "message" => $row["pa_data"]));       //test
        
        
        //20251020 이부분수정해야함 Neel
        //20251020 이부분수정해야함 Neel
        //20251020 이부분수정해야함 Neel
//        if($status != ""){
//            
//            // API 키 (필요 시 안전하게 보관하세요)
//            $serviceKey = AIR_APIKEY;
//
//            // POST 파라미터로 sido 값 받기
//            //$sido = isset($_POST['sido']) ? $_POST['sido'] : null;
//    //        $sido = "서울"; //서울 예시
//
//            if (!$sido) {
//                echo json_encode([
//                    "result" => "FAIL",
//                    "message" => "sido 파라미터가 없습니다."
//                ]);
//                exit;
//            }
//
//            // API URL 구성
//            $baseUrl = "http://apis.data.go.kr/B552584/ArpltnInforInqireSvc/getCtprvnRltmMesureDnsty";
//            $queryParams = http_build_query([
//                "ServiceKey" => $serviceKey,
//                "returnType" => "json",
//                "numOfRows" => 1,
//                "pageNo" => 1,
//                "sidoName" => $sido,
//                "ver" => "1.3"
//            ]);
//            $requestUrl = $baseUrl . "?" . $queryParams;
//
//            $header = array(
//                "Content-Type: application/json; charset=utf-8"
//            );
//
//            // cURL 실행
//            $ch = curl_init();
//            curl_setopt($ch, CURLOPT_URL, $requestUrl);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
//
//            $response = curl_exec($ch);
//            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//            curl_close($ch);
//
//            // 결과 반환
//            
//            if($httpCode >= 200 && $httpCode < 300 ){
//                
//                if($status == "update" && isset($response["body"]) && isset($response["body"]["items"][0]) && $response["body"]["items"][0]["pm10Flag"] == "통신장애"){
//                     return_json_message(array("code" => "100", "message" => $row["pa_data"]));  
//                     exit;
//                }
//                    
//                if($status == "insert"){
//                    insertPublicApi($con, $pa_title, $pa_addr, $pa_type, $pa_updatedate, $response);               
//                }
//                    
//                else if($status == "update"){
//                   
//                    updatePublicApi($con, $pa_title, $pa_addr, $pa_type, $pa_updatedate, $response);        
//                }
//              
//                return_json_message(array("code" => "100", "message" => $response));       
//            }else {
////                return_json_message(array("code" => "-1", "message" => "미세먼지데이터 가져오기 실패"));  
//                return_json_message(array("code" => "100", "message" => $row["pa_data"]));     
//            }
//        }else{
//            // $response = json_decode($row["pa_data"], true);
//                
//            //string 으로 넘긴다.
//            return_json_message(array("code" => "100", "message" => $row["pa_data"]));       
//        }

    }
    //////////////////////////////////////////////
    //교가 관련 START
    //////////////////////////////////////////////
    else if($type == "updatelyricsdata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $lyricsdata = $value["lyricsdata"];
        $lr_idx = $value["lridx"];
        
        $table_name = "tb_lyrics";
        
        $title = $lyricsdata["title"];
        $subtitle = $lyricsdata["subtitle"];
        $startdate = $lyricsdata["startdate"];
        $enddate = $lyricsdata["enddate"];
        
        $encode_lrdata = json_encode($lyricsdata["lrdata"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
 
        $sql = "UPDATE $table_name SET lr_title='$title', lr_title='$title', lr_data='$encode_lrdata', lr_startdate='$startdate', lr_enddate='$enddate' where lr_idx=$lr_idx;";
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        
        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));        

        
    }
    else if($type == "deleterank"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $rankdata = isset($value["rankdata"]) ? $value["rankdata"] : null;
        
        //
        $table_name = "tb_home";
        $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $hm_ranking = isset($row["hm_ranking"]) && strlen($row["hm_ranking"]) > 5 ? json_decode($row["hm_ranking"],true) : null;
        
        $new_list = array();
        if($rankdata != null){
            $list_lyrics = isset($hm_ranking["lyrics"]) ? $hm_ranking["lyrics"] : array();
            
            for($i = 0; $i < count($list_lyrics); $i++){
                if($list_lyrics[$i]["nickname"] != $rankdata["nickname"] || $list_lyrics[$i]["score"] != $rankdata["score"] )
                    array_push($new_list,$list_lyrics[$i]);
            }
            $hm_ranking["lyrics"] = $new_list;
        }else {
            $hm_ranking["lyrics"] = $new_list;
        }
        $encode_hm_ranking = json_encode($hm_ranking,  JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $sql = "UPDATE $table_name SET hm_ranking='$encode_hm_ranking' where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        
        return_json_message(array("code" => "100", "message" => "success"));        
        
    }
    else if($type == "getranking"){
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        
        $table_name = 'tb_home';      
        $where = " WHERE hm_projectid = '$hm_projectid' and hm_gr_idx=$hm_groupidx";
        $sql_select = "SELECT * FROM $table_name $where"; // 'id'는 테이블의 기본 키로 대체하세요.
        $stmt_select = $con->prepare($sql_select);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        
        return_json_message(array("code" => "100", "message" => $row["hm_ranking"]));  
        

    }
    else if($type == "getrankinglist"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $lr_type = isset($value["type"]) ? $value["type"] : "lyrics";
       
        $table_name = "tb_home";
        $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $hm_ranking = isset($row["hm_ranking"]) && strlen($row["hm_ranking"]) > 5 ? json_decode($row["hm_ranking"],true) : array();
        $list_rank = array();
        if(isset($hm_ranking[$lr_type])){
            $list_rank = $hm_ranking[$lr_type];
        }
        return_json_message(array("code" => "100", "message" => $list_rank));        
    }
     else if($type == "deletemp3file"){
        // 입력 데이터
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];
        $mp3data       = $value["mp3data"]; // 인덱스
        
        $mp3foldername = "bgm"; //기본갤러리 폴더이다. 
     
        $directory = "../game/school/$projectid/v$groupidx/contentdata/$mp3foldername/";             
        $flg = deleteDirectoryFile($directory, $projectid, $groupidx, $mp3data);
        
        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));       
        
    }
    else if($type == "insertlyricsdata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $lyricsdata = $value["lyricsdata"];
        
        $table_name = "tb_lyrics";
          $tb_lyrics = array(
            'lr_title'=>$lyricsdata["title"],
            'lr_subtitle'=>$lyricsdata["subtitle"],              
            'lr_data'=>json_encode($lyricsdata["lrdata"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            'lr_startdate'=>$lyricsdata["startdate"],
            'lr_enddate'=>$lyricsdata["enddate"],
            'lr_projectid'=>$projectid,
            'lr_groupidx'=>$groupidx
           
        );
        $keys = array_keys($tb_lyrics);
        $columns = implode(",",$keys);
        $datas  = array_values($tb_lyrics);
        $values = implode("','",$datas);
        $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
     // ✅ 삽입된 ID 얻기
        $rqidx = $con->lastInsertId();

        // ✅ 방금 삽입한 데이터 조회
        $stmt_select = $con->prepare("SELECT * FROM $table_name WHERE lr_idx = ?");
        $stmt_select->execute([$rqidx]);
        $insertedData = $stmt_select->fetch(PDO::FETCH_ASSOC);

        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => $insertedData));
       
    }
    else if($type == "deletelyricsdata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $lr_idx = $value["lridx"];
        
        $table_name = "tb_lyrics";
        
        $query = "DELETE from $table_name WHERE lr_idx=$lr_idx";
        $stmt5 = $con->prepare($query);
        $stmt5->execute();

        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));       

    }
    
    else if($type == "getlyricsdata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $lyricsidx = isset($value["lyricsidx"]) ? (int)$value["lyricsidx"] : -1;
        $lr_type = isset($value["type"]) ? $value["type"] : "school_lyrics";
        
        $str_type = $lr_type == "lyrics" ? "설문" : "트랜드";
        $table_name = "tb_lyrics";
        
       
        $result = get_aes_sql_array($con, "SELECT * FROM", $table_name, " WHERE lr_type='$lr_type' AND lr_projectid='$projectid' AND lr_groupidx=$groupidx;");
        $result_count = $result["count"];
        $result_row = $result["row"];
        
        
        //현재 설문중인게 없다면
        if($result_count == 0){
            return_json_message(array("code" => "-1", "message" => "현재 생성된 ".$lr_type."갯수가 0개입니다."));  
        }
            
        
        
        //지정된게 없다면        
        if($result_count > 0 && $lyricsidx == 0){            
            return_json_message(array("code" => "-1", "message" => "선택된  ".$lr_type."이 없습니다."));        
        }
        //지정된게 있다면
        else if($result_count > 0 && $lyricsidx > 0){
             for($i = 0 ; $i < count($result_row);$i++){
                 if((int)$result_row[$i]["lr_idx"] == $lyricsidx){
                     
                     if(isWithinPeriod($result_row[$i]["lr_startdate"], $result_row[$i]["lr_enddate"]))
                        return_json_message(array("code" => "100", "message" => $result_row[$i]));       
                     else
                         return_json_message(array("code" => "-1", "message" => "기간이 지났습니다. $lyricsidx"));  
                        
                     break;
                 }
             }
        }else //목록가져오기라면
            return_json_message(array("code" => "100", "message" => $result_row));       
       
        
    }
    else if($type == "getnowlyricsidx"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $contentid = $value["contentid"];       // 예: 1
        $lr_type = isset($value["type"]) ? $value["type"] : "lyrics";
       
        $table_name = "tb_home";
        $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        if($row["hm_content_data"] != ""){
            $hm_content_data = json_decode($row["hm_content_data"],true);    
            $now_lyrics_id = -1;
            $now_lyrics_onoff = 0;
            for($i = 0; $i < count($hm_content_data); $i++){
                //hm_content_data 에서 $lr_type(설문 or 트랜드) 정보를 가져온다.
                if($hm_content_data[$i]["type"] == $lr_type && $hm_content_data[$i]["id"] == $contentid){
                    $now_lyrics_id = (int)$hm_content_data[$i]["lyricsidx"];
                    $now_lyrics_onoff = (int)$hm_content_data[$i]["lyricsonoff"];
                    break;
                }
            }
            
            $result = array("nowlyricsidx"=>$now_lyrics_id,"nowlyricsonoff"=>$now_lyrics_onoff);
            
            return_json_message(array("code" => "100", "message" => $result));         
        }else {
            return_json_message(array("code" => "-1", "message" => "설문조사 정보가 없습니다."));            
        }
        
        
        
    }
    else if($type == "updatenowlyricsidx"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $contentid = $value["contentid"];       // 예: 1
        $nowlyricsidx = (int)$value["nowlyricsidx"];
        
        
        $table_name = "tb_home";
        $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $rdata = 0;
        if($row["hm_content_data"] != ""){
            $hm_content_data = json_decode($row["hm_content_data"],true);    
            
            for($i = 0; $i < count($hm_content_data); $i++){
                if($hm_content_data[$i]["type"] == "lyrics" && $hm_content_data[$i]["id"] == $contentid){
                    $hm_content_data[$i]["lyricsidx"] = $nowlyricsidx;
                    $rdata = $nowlyricsidx;
                    
                    break;
                }
            }
            $encode_hm_contentdata = json_encode($hm_content_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
            $sql = "UPDATE $table_name SET hm_content_data='$encode_hm_contentdata' where  hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
            $stmt = $con->prepare($sql);        
            $stmt->execute();
            updateOn($con, $projectid, $groupidx);
            return_json_message(array("code" => "100", "message" => "$rdata"));         
        }else {
            return_json_message(array("code" => "-1", "message" => "현재설문조사 업데이트 에러"));            
        }
    }
     else if($type == "getbgmlist"){
        
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        
        $page = $value["page"]; //페이지
        $maxcount = $value["maxcount"]; //한번에 가져올 최대갯수
       
        
        $directory = "../game/school/$hm_projectid/v$hm_groupidx/contentdata/bgm/";
        $bgmdatas = getFilesInFolderFiles($hm_projectid, $hm_groupidx, $page, $maxcount, $directory);
        

        return_json_message(array("code" => "100", "message" => $bgmdatas));       
//       
    }
    else if($type == "insertmp3"){
        $obj_value = json_decode($value, true);
        $projectid = $obj_value["projectid"];
        $groupidx = (int)$obj_value["groupidx"];
        $list_name_id = $obj_value["listnameid"];
        $bgmfoldername = isset($obj_value["bgmfoldername"]) ? $obj_value["bgmfoldername"] : "bgm"; //
      
        // 업로드된 파일이 존재하는지 확인
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];

            // 파일 정보 출력
            // 파일이 올바르게 업로드되었는지 확인
            if ($file['error'] === UPLOAD_ERR_OK) {

                $filename = $file['name'];
                $tmpFilePath = $file['tmp_name'];
        //        echo "filename ".$filename;
        //        echo "tmpFilePath ".$tmpFilePath;

                // 파일을 저장할 디렉토리 경로 설정
                
                 $uploadDir = "../game/school/$projectid/v$groupidx/contentdata/$bgmfoldername/";

                if(!is_dir($uploadDir))
                    mkdir($uploadDir,0777,true);
               
                // 파일을 새 경로로 이동
                $newFilePath = $uploadDir . $filename;                
                
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                  
                    
                    
                     // 파일 업로드 성공
                     return_json_message(array("code" => 100, "message" => "success"));     
                } else {
                    // 파일 업로드 실패
                     return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
                }
            } else {
                // 파일 업로드 실패
                return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
            }
        } else {

             // 파일이 제대로 전송되지 않았음
             return_json_message(array("code" => -1, "message" => "파일이 제대로 전송되지 않았음"));     
        }
    }
    else if($type == "updatesvsticker"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $surveyidx = $value["surveyidx"];
        if($surveyidx < 1){
             return_json_message(array("code" => "-1", "message" => "error"));      
        }
        $json_svdatas = $value["json_svdatas"];
        $sv_data = json_encode($json_svdatas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $table_name = "tb_survey";
        $sql = "UPDATE $table_name SET sv_data='$sv_data' where sv_idx=$surveyidx";      
       
        $stmt = $con->prepare($sql);        
        if($stmt->execute()){
            return_json_message(array("code" => "100", "message" => "success"));         
        }else{
            return_json_message(array("code" => "-1", "message" => "error"));         
        }
        
    }
    
    //////////////////////////////////////////////
    //교가 관련 END
    //////////////////////////////////////////////
    else if($type == "updatesurveydata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $surveydata = $value["surveydata"];
        $sv_idx = $value["svidx"];
        
        $table_name = "tb_survey";
        
        $title = $surveydata["title"];
        $max = $surveydata["max"];
        $startdate = $surveydata["startdate"];
        $enddate = $surveydata["enddate"];
        $resultopen = $surveydata["resultopen"];
        $iconid = $surveydata["iconid"];
        
        $encode_svdata = json_encode($surveydata["svdata"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $encode_svsetting = isset($surveydata["svsetting"]) ? json_encode($surveydata["svsetting"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : "";
        if($encode_svsetting == "")
            $sql = "UPDATE $table_name SET sv_title='$title', sv_title='$title', sv_data='$encode_svdata',sv_max=$max, sv_startdate='$startdate', sv_enddate='$enddate', sv_resultopen=$resultopen, sv_iconid=$iconid  where sv_idx=$sv_idx;";
        else 
            $sql = "UPDATE $table_name SET sv_title='$title', sv_title='$title', sv_data='$encode_svdata', sv_setting='$encode_svsetting', sv_max=$max, sv_startdate='$startdate', sv_enddate='$enddate', sv_resultopen=$resultopen, sv_iconid=$iconid  where sv_idx=$sv_idx;";
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        
        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));        

        
    }
    else if($type == "insertsurveydata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $surveydata = $value["surveydata"];
        
        $table_name = "tb_survey";
        $encode_svsetting = isset($surveydata["svsetting"]) ? $surveydata["svsetting"] : "";
          $tb_survay = array(
            'sv_title'=>$surveydata["title"],
            'sv_data'=>json_encode($surveydata["svdata"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            'sv_setting'=>$encode_svsetting,
            'sv_max'=>$surveydata["max"],
            'sv_startdate'=>$surveydata["startdate"],
            'sv_enddate'=>$surveydata["enddate"],
            'sv_projectid'=>$projectid,
            'sv_groupidx'=>$groupidx,
            'sv_resultopen'=>$surveydata["resultopen"],
            'sv_iconid'=>$surveydata["iconid"]

        );
        $keys = array_keys($tb_survay);
        $columns = implode(",",$keys);
        $datas  = array_values($tb_survay);
        $values = implode("','",$datas);
        $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        
     // ✅ 삽입된 ID 얻기
        $rqidx = $con->lastInsertId();

        // ✅ 방금 삽입한 데이터 조회
        $stmt_select = $con->prepare("SELECT * FROM $table_name WHERE sv_idx = ?");
        $stmt_select->execute([$rqidx]);
        $insertedData = $stmt_select->fetch(PDO::FETCH_ASSOC);

        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => $insertedData));
       
    }
    else if($type == "deletesurveydata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $sv_idx = $value["svidx"];
        
        $table_name = "tb_survey";
        
        $query = "DELETE from $table_name WHERE sv_idx=$sv_idx";
        $stmt5 = $con->prepare($query);
        $stmt5->execute();

        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));       

    }
    
    else if($type == "getsurveydata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $surveyidx = isset($value["surveyidx"]) ? (int)$value["surveyidx"] : -1;
        $sv_type = isset($value["type"]) ? $value["type"] : "survey";
        
        $str_type = $sv_type == "survey" ? "설문" : "트랜드";
        $table_name = "tb_survey";
        
       
        $result = get_aes_sql_array($con, "SELECT * FROM", $table_name, " WHERE sv_type='$sv_type' AND sv_projectid='$projectid' AND sv_groupidx=$groupidx;");
        $result_count = $result["count"];
        $result_row = $result["row"];
        
        
        //현재 설문중인게 없다면
        if($result_count == 0){
            return_json_message(array("code" => "-1", "message" => "현재 생성된 ".$sv_type."갯수가 0개입니다."));  
        }
            
        
        
        //지정된게 없다면        
        if($result_count > 0 && $surveyidx == 0){            
            return_json_message(array("code" => "-1", "message" => "선택된  ".$sv_type."이 없습니다."));        
        }
        //지정된게 있다면
        else if($result_count > 0 && $surveyidx > 0){
             for($i = 0 ; $i < count($result_row);$i++){
                 if((int)$result_row[$i]["sv_idx"] == $surveyidx){
                     
                     if(isWithinPeriod($result_row[$i]["sv_startdate"], $result_row[$i]["sv_enddate"]))
                        return_json_message(array("code" => "100", "message" => $result_row[$i]));       
                     else
                         return_json_message(array("code" => "-1", "message" => "기간이 지났습니다. $surveyidx"));  
                        
                     break;
                 }
             }
        }else //목록가져오기라면
            return_json_message(array("code" => "100", "message" => $result_row));       
       
        
    }
    else if($type == "getnowsurveyidx"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $contentid = $value["contentid"];       // 예: 1
        $sv_type = isset($value["type"]) ? $value["type"] : "survey";
       
        $table_name = "tb_home";
        $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        if($row["hm_content_data"] != ""){
            $hm_content_data = json_decode($row["hm_content_data"],true);    
            $now_survey_id = -1;
            $now_survey_onoff = 0;
            for($i = 0; $i < count($hm_content_data); $i++){
                //hm_content_data 에서 $sv_type(설문 or 트랜드) 정보를 가져온다.
                if($hm_content_data[$i]["type"] == $sv_type && $hm_content_data[$i]["id"] == $contentid){
                    $now_survey_id = (int)$hm_content_data[$i]["surveyidx"];
                    $now_survey_onoff = (int)$hm_content_data[$i]["surveyonoff"];
                    break;
                }
            }
            
            $result = array("nowsurveyidx"=>$now_survey_id,"nowsurveyonoff"=>$now_survey_onoff);
            
            return_json_message(array("code" => "100", "message" => $result));         
        }else {
            return_json_message(array("code" => "-1", "message" => "설문조사 정보가 없습니다."));            
        }
        
        
        
    }
    else if($type == "updatenowsurveyidx"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $contentid = $value["contentid"];       // 예: 1
        $nowsurveyidx = (int)$value["nowsurveyidx"];
        $nowsurveyonoff = (int)$value["nowsurveyonoff"];
        
        $table_name = "tb_home";
        $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($row["hm_content_data"] != ""){
            $hm_content_data = json_decode($row["hm_content_data"],true);    
            
            for($i = 0; $i < count($hm_content_data); $i++){
                if($hm_content_data[$i]["type"] == "survey" && $hm_content_data[$i]["id"] == $contentid){
                    $hm_content_data[$i]["surveyidx"] = $nowsurveyidx;
                    $hm_content_data[$i]["surveyonoff"] = $nowsurveyonoff;
                    
                    break;
                }
            }
            $encode_hm_contentdata = json_encode($hm_content_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
            $sql = "UPDATE $table_name SET hm_content_data='$encode_hm_contentdata' where  hm_projectid='$projectid' and hm_gr_idx=$groupidx;";
            $stmt = $con->prepare($sql);        
            $stmt->execute();
            updateOn($con, $projectid, $groupidx);
            return_json_message(array("code" => "100", "message" => "success"));         
        }else {
            return_json_message(array("code" => "-1", "message" => "현재설문조사 업데이트 에러"));            
        }
    }
    
    else if($type == "updatesvsticker"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];       // 예: 1
        $surveyidx = $value["surveyidx"];
        if($surveyidx < 1){
             return_json_message(array("code" => "-1", "message" => "error"));      
        }
        $json_svdatas = $value["json_svdatas"];
        $sv_data = json_encode($json_svdatas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        $table_name = "tb_survey";
        $sql = "UPDATE $table_name SET sv_data='$sv_data' where sv_idx=$surveyidx";      
       
        $stmt = $con->prepare($sql);        
        if($stmt->execute()){
            return_json_message(array("code" => "100", "message" => "success"));         
        }else{
            return_json_message(array("code" => "-1", "message" => "error"));         
        }
        
    }
   
    else if($type == "getlistdata"){
        $table_name = 'tb_list';

        // 입력 데이터
        $hm_projectid = $value["projectid"];       // 예: maecheon1
        $hm_groupidx = (int)$value["groupidx"];       // 예: 1
        $list_name_id = $value["listnameid"]; // 게시판 아이디 (ex. mylist1)
        $pagenum       = max(1, intval($value["pagenum"])); // 현재 페이지
        $listmax       = max(1, intval($value["listmax"])); // 한 페이지당 개수

        $result = get_aes_sql_array($con, "SELECT * FROM", $table_name, " WHERE lt_projectid='$hm_projectid' AND lt_groupidx=$hm_groupidx AND lt_listid='$list_name_id';");
        $result_count = $result["count"];
        $result_row = $result["row"];
        $totalPage = ceil($result_count / $listmax);
        
       
        
        // 1. WHERE 조건 만들기
        $where_conditions = [];
        if (!empty($hm_projectid)) {
            $where_conditions[] = "lt_projectid = '$hm_projectid'";
        }
        if (!empty($hm_groupidx)) {
            $where_conditions[] = "lt_groupidx = $hm_groupidx";
        }
        if (!empty($list_name_id)) {
            $where_conditions[] = "lt_listid = '$list_name_id'";
        }

        // 2. 최종 WHERE 문자열
        $where_clause = "";
        if (count($where_conditions) > 0) {
            $where_clause = "WHERE " . implode(" AND ", $where_conditions);
        }
        
        if($list_name_id == "home"){
            $where_clause =  "WHERE lt_projectid='$hm_projectid' AND lt_groupidx=$hm_groupidx AND lt_listid='$list_name_id'";
        }
        
        // 3. LIMIT & OFFSET 계산
        $page = max(1, intval($pagenum));  // 1페이지부터 시작
        $limit = intval($listmax);
        $offset = ($page - 1) * $limit;

        // 4. 데이터 가져오기
        $result = get_aes_sql_array($con, "SELECT * FROM", $table_name, $where_clause . " ORDER BY lt_idx DESC LIMIT $offset, $limit;");
        $result_count = $result["count"];
        $result_row = $result["row"];

        
        //echo "000111";
//        exit;
        // 5. 리턴
        return_json_message(array(
            "code" => "100",
            "list" => $result_row,
             "totalPage"   => $totalPage,
            "currentPage" => $pagenum,
            "projectid"   => $hm_projectid
        ));   
       
    }
    //목록이 상단고정인지 아닌지
    else if($type == "updatelististop"){
        // 입력 데이터
        $lt_projectid = $value["projectid"];       // 예: maecheon1
        $lt_groupidx = (int)$value["groupidx"];       // 예: 1
        $lt_idx       = $value["ltidx"]; // 인덱스
        $lt_istop       = $value["ltistop"]; // 제목
        
    
        $table_name = "tb_list";
        $sql = "UPDATE $table_name SET lt_istop='$lt_istop' where lt_idx = $lt_idx";      
        $stmt = $con->prepare($sql);        
        $stmt->execute();
        updateOn($con, $lt_projectid, $lt_groupidx);
        return_json_message(array("code" => "100", "message" => "success")); 
    }
    else if($type == "updatelistdata"){
        // 입력 데이터
        $lt_projectid = $value["projectid"];       // 예: maecheon1
        $lt_groupidx = (int)$value["groupidx"];       // 예: 1
        $list_name_id = $value["listnameid"]; // 게시판 아이디 (ex. listid)
        $lt_idx       = $value["ltidx"]; // 인덱스
        $lt_title       = $value["lttitle"]; // 제목
        $lt_subtitle = isset($value["ltsubtitle"]) ? $value["ltsubtitle"] : ""; // 제목
        $lt_startdate = isset($value["ltstartdate"]) ? $value["ltstartdate"] : ""; // 제목
        $lt_enddate = isset($value["ltenddate"]) ? $value["ltenddate"] : ""; // 제목
        $lt_message       = $value["ltmessage"]; // 내용
        $type       = $value["type"]; //add, edit , delete
     
    
        $table_name = "tb_list";
        if($type == "add"){
            $tb_list = array(
                'lt_title'=>$lt_title,
                'lt_subtitle'=>$lt_subtitle,
                'lt_startdate'=>$lt_startdate,
                'lt_enddate'=>$lt_enddate,
                'lt_message'=>$lt_message,
                'lt_listid'=>$list_name_id,
                'lt_projectid'=>$lt_projectid,
                'lt_groupidx'=>$lt_groupidx     
            );
            $keys = array_keys($tb_list);
            $columns = implode(",",$keys);
            $datas  = array_values($tb_list);
            $values = implode("','",$datas);
            $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            
            updateOn($con, $lt_projectid, $lt_groupidx);
            
            return_json_message(array("code" => "100", "message" => "success"));    
        }else if($type == "edit"){
            $sql = "UPDATE $table_name SET lt_title='$lt_title', lt_subtitle='$lt_subtitle', lt_startdate='$lt_startdate', lt_enddate='$lt_enddate', lt_message='$lt_message' where lt_idx = $lt_idx";      
            $stmt = $con->prepare($sql);        
            $stmt->execute();
            updateOn($con, $lt_projectid, $lt_groupidx);
            return_json_message(array("code" => "100", "message" => "success"));     
        }else if($type == "delete"){                          
            $query = "DELETE from $table_name WHERE lt_idx=$lt_idx";
            $stmt5 = $con->prepare($query);
            $stmt5->execute();

            updateOn($con, $lt_projectid, $lt_groupidx);
            return_json_message(array("code" => "100", "message" => "success"));       
        }
    }
     else if($type == "deletegalleryimage"){
        // 입력 데이터
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];
//        $list_name_id = $value["listnameid"]; // 게시판 아이디 (ex. listid)
        $imagedata       = $value["imagedata"]; // 인덱스
//        $type       = $value["type"]; //add, edit , delete
        $imgfoldername = isset($value["imgfoldername"]) ? $value["imgfoldername"] : "gallery"; //기본갤러리 폴더이다. 
     
        $directory = "../game/school/$projectid/v$groupidx/contentdata/$imgfoldername/";             
        $flg = deleteDirectoryFile($directory, $projectid, $groupidx, $imagedata);
        
        updateOn($con, $projectid, $groupidx);
        return_json_message(array("code" => "100", "message" => "success"));       
        
    }
    else if($type =="savefloordata"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];
        $json_floor = $value["jsondata"];
        $imgfoldername = isset($value["imgfoldername"]) ? $value["imgfoldername"] : "floor"; //기본갤러리 폴더이다. 
        $filename = isset($value["filename"]) ? $value["filename"] : "floor.json";
        
        $path = "../game/school/$projectid/v$groupidx/contentdata/$imgfoldername/$filename";        
        
        // 디렉토리 생성 (없으면)
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        // JSON 저장 (UTF-8 + pretty print)
        $json_string = json_encode($json_floor, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        if (file_put_contents($path, $json_string) !== false) {
            $result["status"] = "success";
            $result["message"] = "저장 완료";
            
            updateOn($con, $projectid, $groupidx);
            return_json_message(array("code" => "100", "message" => "success"));       
        } else {
            $result["status"] = "error";
            $result["message"] = "파일 저장 실패";
            return_json_message(array("code" => "-1", "message" => "error"));       
        }
    }
    //층별안내에서 이미지 목록을 가져온다.
    else if($type == "getfloorimageres"){
        $obj_value = $value;
        $projectid = $obj_value["projectid"];
        $groupidx = (int)$obj_value["groupidx"];
//        $floorname = $obj_value["floorname"];
//        $titlenames = isset($obj_value["titlenames"]) ? $obj_value["titlenames"] : array();
        
        $flooridx = $obj_value["flooridx"];
        $titleidxs = $obj_value["titleidxs"];
        $languagecode = isset($obj_value["languagecode"]) ? strtolower($obj_value["languagecode"]) : "ko";
        
        
        $imgfoldername = isset($obj_value["imgfoldername"]) ? $obj_value["imgfoldername"] : "floor";
        $fileDir = "../game/school/$projectid/v$groupidx/contentdata/$imgfoldername/";
        $isInFiles = array();
        for($j = 0; $j < count($titleidxs); $j++){
            $titleidx = $titleidxs[$j];
            for($i =0; $i < 9; $i++){
                $filename = $languagecode."_".$flooridx."_".$titleidx."_".$i.".jpg";
                $filePath = $fileDir."".$filename;
                if (file_exists($filePath)) 
                    array_push($isInFiles, $filename);        
            }

        }
        
//        for($j = 0; $j < count($titlenames); $j++){
//            $titlename = $titlenames[$j];
//            for($i =0; $i < 9; $i++){
//                $filename = $floorname."_".$titlename."_".$i.".jpg";
//                $filePath = $fileDir."".$filename;
//                if (file_exists($filePath)) 
//                    array_push($isInFiles, $filename);        
//            }
//
//        }
        
        return_json_message(array("code" => "100", "message" => $isInFiles));       
    }
    else if($type == "insertgalleryimage"){
        $obj_value = json_decode($value, true);
        $projectid = $obj_value["projectid"];
        $groupidx = (int)$obj_value["groupidx"];
        $list_name_id = $obj_value["listnameid"];
        $imgfoldername = isset($obj_value["imgfoldername"]) ? $obj_value["imgfoldername"] : "gallery"; //기본갤러리 폴더이다. 
      
        // 업로드된 파일이 존재하는지 확인
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];

            // 파일 정보 출력
            // 파일이 올바르게 업로드되었는지 확인
            if ($file['error'] === UPLOAD_ERR_OK) {

                $filename = $file['name'];
                $tmpFilePath = $file['tmp_name'];
        //        echo "filename ".$filename;
        //        echo "tmpFilePath ".$tmpFilePath;

                // 파일을 저장할 디렉토리 경로 설정
                
                 $uploadDir = "../game/school/$projectid/v$groupidx/contentdata/$imgfoldername/";

                if(!is_dir($uploadDir))
                    mkdir($uploadDir,0777,true);
               
                // 파일을 새 경로로 이동
                $newFilePath = $uploadDir . $filename;                
                
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                  
                    
                    
                     // 파일 업로드 성공
                     return_json_message(array("code" => 100, "message" => "success"));     
                } else {
                    // 파일 업로드 실패
                     return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
                }
            } else {
                // 파일 업로드 실패
                return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
            }
        } else {

             // 파일이 제대로 전송되지 않았음
             return_json_message(array("code" => -1, "message" => "파일이 제대로 전송되지 않았음"));     
        }
    }
    else if($type == "checkautoupdate"){
        $projectid = $value["projectid"];       // 예: maecheon1
        $groupidx = (int)$value["groupidx"];
        
        
         $table_name = 'tb_home';      

         $sql="select * from $table_name where hm_projectid='$projectid' and hm_gr_idx = $groupidx";
         $stmt = $con->prepare($sql);
         $stmt->execute();
         $row = $stmt->fetch(PDO::FETCH_ASSOC);
       
         if($row["hm_autoupdate"] == 1){
             $sql = "UPDATE $table_name SET hm_autoupdate = 0 where hm_projectid='$projectid' and hm_gr_idx = $groupidx";
             $stmt = $con->prepare($sql);        
             $stmt->execute();
             return_json_message(array("code" => 100, "message" => 1));         
         }else {
            return_json_message(array("code" => -1, "message" => 0));         
         }
         
    }
     else if($type == "updatefloorimage"){
        $obj_value = json_decode($value, true);
        $projectid = $obj_value["projectid"];
        $groupidx = (int)$obj_value["groupidx"];
        $mfilename = $obj_value["filename"]; // 인덱스
        $list_name_id = isset($obj_value["listnameid"]) ? $obj_value["listnameid"] : "";
        $imgfoldername = isset($obj_value["imgfoldername"]) ? $obj_value["imgfoldername"] : "gallery"; //기본갤러리 폴더이다.
         
      
        // 업로드된 파일이 존재하는지 확인
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];

            // 파일 정보 출력
            // 파일이 올바르게 업로드되었는지 확인
            if ($file['error'] === UPLOAD_ERR_OK) {

                //$filename = $file['name'];
                $filename = $mfilename;
                $tmpFilePath = $file['tmp_name'];
        //        echo "filename ".$filename;
        //        echo "tmpFilePath ".$tmpFilePath;

                // 파일을 저장할 디렉토리 경로 설정
                
                 $uploadDir = "../game/school/$projectid/v$groupidx/contentdata/$imgfoldername/";

                if(!is_dir($uploadDir))
                    mkdir($uploadDir,0777,true);
               
                // 파일을 새 경로로 이동
                $newFilePath = $uploadDir . $filename;                
                
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                  
                    
                    
                    // 파일 업로드 성공
                     return_json_message(array("code" => 100, "message" => "success"));     
                } else {
                    // 파일 업로드 실패
                     return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
                }
            } else {
                // 파일 업로드 실패
                return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
            }
        } else {

            // 파일이 제대로 전송되지 않았음
             return_json_message(array("code" => -1, "message" => "파일이 제대로 전송되지 않았음"));     
        }
    }
    
    else if($type == "updategalleryimage"){
        $obj_value = json_decode($value, true);
        $projectid = $obj_value["projectid"];
        $groupidx = (int)$obj_value["groupidx"];
        $mfilename = $obj_value["filename"]; // 인덱스
        $list_name_id = isset($obj_value["listnameid"]) ? $obj_value["listnameid"] : "";
        $imgfoldername = isset($obj_value["imgfoldername"]) ? $obj_value["imgfoldername"] : "gallery"; //기본갤러리 폴더이다.
         
      
        // 업로드된 파일이 존재하는지 확인
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];

            // 파일 정보 출력
            // 파일이 올바르게 업로드되었는지 확인
            if ($file['error'] === UPLOAD_ERR_OK) {

                //$filename = $file['name'];
                $filename = $mfilename;
                $tmpFilePath = $file['tmp_name'];
        //        echo "filename ".$filename;
        //        echo "tmpFilePath ".$tmpFilePath;

                // 파일을 저장할 디렉토리 경로 설정
                
                 $uploadDir = "../game/school/$projectid/v$groupidx/contentdata/$imgfoldername/";

                if(!is_dir($uploadDir))
                    mkdir($uploadDir,0777,true);
               
                // 파일을 새 경로로 이동
                $newFilePath = $uploadDir . $filename;                
                
                if (move_uploaded_file($tmpFilePath, $newFilePath)) {

                  
                    
                    
                    // 파일 업로드 성공
                     return_json_message(array("code" => 100, "message" => "success"));     
                } else {
                    // 파일 업로드 실패
                     return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
                }
            } else {
                // 파일 업로드 실패
                return_json_message(array("code" => -1, "message" => "파일 업로드 실패"));     
            }
        } else {

            // 파일이 제대로 전송되지 않았음
             return_json_message(array("code" => -1, "message" => "파일이 제대로 전송되지 않았음"));     
        }
    }
    
    else if($type == "getgallerydata"){
        
        $hm_projectid = $value["projectid"]; //maecheon1
        $hm_groupidx = (int)$value["groupidx"]; //maecheon1
        $imgfoldername = isset($value["imgfoldername"]) ? $value["imgfoldername"] : "gallery"; //기본갤러리 폴더이다. 
        
        $page = $value["page"]; //페이지
        $maxcount = $value["maxcount"]; //한번에 가져올 최대갯수
       
         $directory = "../game/school/$hm_projectid/v$hm_groupidx/contentdata/$imgfoldername/";
   
        $gallerydatas = getFilesInFolderFiles($hm_projectid, $hm_groupidx, $page, $maxcount, $directory);
        
        
        return_json_message(array("code" => "100", "message" => $gallerydatas));       
//       
    }
    
    //이메일 DB에 있는지 체크
    else if($type == "isemailcheck"){
         $email = $value;
         isEmailCheck($con,$email);
    }
    //이메일 확인코드 메일로 전송
    else if($type == "sendemailconfirmcode"){
         $email = $value["email"];
         $mailtype = $value["mailtype"]; //0 : nodb 6code , 1: yesdb 6code , 2: password change
         
         if(strlen($email) > 1){
             $date = new DateTime();
             $nowafter4min = $date->add(new DateInterval('PT4M'))->format('Y-m-d H:i:s'); //현재시간 4분추가
             $randomcode = generateRandomNumber();
             $enc_email = enc($email);
              $fname = "스마트플랫";
             $fmail = NAVER_EMAIL;
             $tomail = $email;
             $subject = "[$fname] 에서 이메일 인증을 위한 확인 코드입니다.";
             $content = "$fname 에서 보내온 이메일 인증코드입니다. <br> 이메일 인증코드를 입력해 주세요.<br><br> 이메일 인증코드 :<text style='color:blue;font-weight:bold'> [$randomcode] </text>  <br><br>인증종료시간 :  $nowafter4min";

             $table_name = 'tb_sendcode';      

             $sql="select * from $table_name where sd_email mem_email = '".$enc_email."'";
             $stmt = $con->prepare($sql);

             $query = "DELETE from $table_name WHERE sd_email='$enc_email'";
             $stmt5 = $con->prepare($query);
             $stmt5->execute();

            $tb_sendcode = array(
                'sd_email'=>$enc_email,                              
                'sd_email'=>$enc_email,                              
                'sd_code'=>$randomcode,                          
                'sd_date'=>$nowafter4min           
            );
            $keys = array_keys($tb_sendcode);
            $columns = implode(",",$keys);
            $datas  = array_values($tb_sendcode);
            $values = implode("','",$datas);
            $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";
            $stmt = $con->prepare($sql);
            $stmt->execute();



             //fname 보내는이 , $fmail 보내는 네이버메일주소  $tomail 받는사람 메일주소 ,  $subject 제목 , $content 내용
             mailer_naver($fname, $fmail, $tomail, $subject, $content,  "", "", "");
             return_json_message(array("code" => "100", "message" => "success")); 

         }
         else 
             return_json_message(array("code" => "-1", "message" => "올바른 이메일을 입력해주세요"));
     }
    //이메일 코드가 맞는지 확인 
    else if($type == "isemailconfirmcheck"){
        
         $email = $value["email"];
         $code =  (int)$value["code"];

        isEmailConfirmCheck($con, $email, $code, $now);
        
        
    }
    //회원가입
    else if($type == "registercheck"){
        $company_name = $value["company_name"];
        $name = $value["name"];
//        $birth = $value["birth"];
        $email = $value["email"];
        $phone = $value["phone"];
        $phone4 = substr($phone,-4);
//        $gender = $value["gender"];
        $pass = $value["pass"];

         if(strlen($email) > 1){

             $groupcode = "smartflat";
             $enc_email = enc($email);
              $enc_name = enc($name);
             $enc_phone = enc($phone);
             $enc_phone4 = enc($phone4);
             $enc_pass = enc($pass);

             $table_name = 'tb_user';      

             $sql="select * from $table_name where mem_email IS NOT NULL and mem_email = '".$enc_email."'";
             $stmt = $con->prepare($sql);
             $stmt->execute();




             //이메일이 없으므로 정상이다.
             if($stmt->rowCount() == 0){  
                 $groupcode = "smartflat";    
                 $userid = create_id($con);
                 $user_uid = create_uid($con,$groupcode,$userid,$name,$now);

                 $tb_user = array(
                    'mem_uid'=>$user_uid,                              
                    'mem_userid'=>$userid,                          
                    'mem_email'=>$enc_email,                          
                    'mem_username'=>$enc_name,                          
                    'mem_groupcode'=>$groupcode,                            
                    'mem_auth'=>111,          //메인관리자
                    'mem_phone'=>$enc_phone,    
                    'mem_phone4'=>$enc_phone4,    
//                    'mem_birth'=>$birth,
                    'mem_nickname'=>$company_name,  //업체명
//                    'mem_gender'=>$gender,  
                    'mem_password'=>$enc_pass                
                );

                $keys = array_keys($tb_user);
                $columns = implode(",",$keys);
                $datas  = array_values($tb_user);
                $values = implode("','",$datas);


                $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";
                $stmt = $con->prepare($sql);

                if($stmt->execute()){
                    return_json_message(array("code" => "100", "message" => "success")); 
                }else {
                   return_json_message(array("code" => "-11", "message" => "회원가입 실패")); 
                }


             }else {
                 return_json_message(array("code" => "-1", "message" => "중복된 이메일이 있습니다.")); 
             }

         }
         else 
             return_json_message(array("code" => "-1", "message" => "올바른 이메일을 입력해주세요"));
     }
    //아이디 찾기
    else if($type == "findidcheck"){
        $company_name = $value["company_name"];
        $name = $value["name"];
        $phone = $value["phone"];

         $enc_name = enc($name);
         $enc_phone = enc($phone);


         $table_name = 'tb_user';      

         $sql="select * from $table_name where mem_nickname = '$company_name' and mem_username = '$enc_name' and mem_phone = '$enc_phone'";
         $stmt = $con->prepare($sql);
         $stmt->execute();




         if($stmt->rowCount() == 0){  
             return_json_message(array("code" => "-11", "message" => "정보가 일치하지 않습니다.")); 


         }else {
             $row=$stmt->fetch(PDO::FETCH_ASSOC);    
             $email = dec($row["mem_email"]);
             return_json_message(array("code" => "100", "message" => "회원님의 로그인 아이디는 $email 입니다.")); 
         }
    }
    //비밀번호 변경 이메일로 전송하기
    else if($type == "findpasswordcheck"){
        $company_name = $value["company_name"];
        $name = $value["name"];
        $phone = $value["phone"];
        $email = $value["email"];

        $enc_name = enc($name);
        $enc_phone = enc($phone);
        $enc_email = enc($email);

         $table_name = 'tb_user';      

         $sql="select * from $table_name where mem_email = '$enc_email' and mem_username = '$enc_name' and mem_phone = '$enc_phone'";
         $stmt = $con->prepare($sql);
         $stmt->execute();
         if($stmt->rowCount() == 0){  
             return_json_message(array("code" => "-11", "message" => "정보가 일치하지 않습니다."));          
         }else {
             $row=$stmt->fetch(PDO::FETCH_ASSOC);  
             $date = new DateTime();
             $nowafter4min = $date->add(new DateInterval('PT4M'))->format('Y-m-d H:i:s'); //현재시간 4분추가
             $randomkey = generateRandomKey(16);

              $table_name = 'tb_sendcode';      
             $query = "DELETE from $table_name WHERE sd_email='$enc_email'";
             $stmt5 = $con->prepare($query);
             $stmt5->execute();

            $tb_sendcode = array(
                'sd_email'=>$enc_email,                              
                'sd_type'=>"pass",                              
                'sd_passkey'=>$randomkey,                          
                'sd_date'=>$nowafter4min                
            );
            $keys = array_keys($tb_sendcode);
            $columns = implode(",",$keys);
            $datas  = array_values($tb_sendcode);
            $values = implode("','",$datas);
            $sql = "INSERT INTO $table_name ($columns) VALUES ('".$values."')";
            $stmt = $con->prepare($sql);
            $stmt->execute();


              $fname = "스마트플랫";
             $fmail = NAVER_EMAIL;
             $tomail = $email;
             $subject = "$fname 에서 비밀번호 변경을 합니다.";
             $content = "$fname 에서 회원님이 비밀번호 변경을 요청하였습니다.. <br> 아래 비밀번호변경하기 를 클릭하셔서 새로운 비밀번호를 입력해 주세요.<br> <br> <a style='color:blue;font-weight:bold' href='https://smart-flat.mooo.com/smartai/web/v1/dist/changepass.php?key=$randomkey'>비밀번호변경하기</a>";


              //fname 보내는이 , $fmail 보내는 네이버메일주소  $tomail 받는사람 메일주소 ,  $subject 제목 , $content 내용
             mailer_naver($fname, $fmail, $tomail, $subject, $content,  "", "", "");
             return_json_message(array("code" => "100", "message" => "비밀번호를 변경할 수 있는 링크를 $email 주소로 전송하였습니다.<br>메일을 확인해 주세요.")); 
         }


     }
    //이메일 변경페이지에서 비밀번호를 받아서 비밀번호를 변경완료한다.
    else if($type == "changepasswordcheck"){
    $pass = $value["pass"];
    $key = $value["key"];
            
//     $enc_name = enc($name);
//     $enc_phone = enc($phone);


     $table_name = 'tb_sendcode';      

     $sql="select * from $table_name where sd_passkey = '$key'";
     $stmt = $con->prepare($sql);
     $stmt->execute();




     if($stmt->rowCount() == 0){  
         return_json_message(array("code" => "-11", "message" => "정보가 일치하지 않습니다.")); 


     }else {
         $row=$stmt->fetch(PDO::FETCH_ASSOC);    
         $enc_email = $row["sd_email"];
         $enc_pass = enc($pass);
         $end_date = $row["sd_date"];
         
         //시간초과
         if(compareDate($now, $end_date) != 1){
             return_json_message(array("code" => "-1", "message" => "시간이 오래되어 세션이 종료되었습니다. <br>비밀번호를 변경할 수 없습니다.")); 
         }
         
         $table_name = 'tb_user';      

         $sql = "UPDATE tb_user SET mem_password ='$enc_pass' where mem_email = '$enc_email'";
         $stmt = $con->prepare($sql);        
         $stmt->execute();

         return_json_message(array("code" => "100", "message" => "비밀번호 변경완료!")); 
     }
 }


} 
   

?>
