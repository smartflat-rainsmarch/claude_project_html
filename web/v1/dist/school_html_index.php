<div>
   <div style="margin-left:270px;margin-top:20px">
    *학교명 입력 
    <input id ="input_schoolname" type="text"/>
    
   <div id="div_schoollist">
       
   </div>
   <br><br>
   <h3 id="txt_result"></h3>
    <!--===========================-->
    <!--반드시 삽입해야함-->
    <!--===========================-->
    <div id="div_top"></div>
    <div id="div_nav"></div>
    <div id="div_bottom"></div>
    

</div>
    <script>
        var all_rows = [];
       
        // 이벤트 리스너 등록
        var inputSchoolName = document.getElementById("input_schoolname");
        inputSchoolName.addEventListener("input", (event) => {
            const searchTerm = event.target.value;
            updateSchoolList(searchTerm);
        });
        $(document).ready(function() {
            
            readExcelFromPath("학교기본정보_2024년11월30일기준.xlsx");
        });

          async function readExcelFromPath(fileUrl) {
            try {
                // Fetch the file from the given URL
                const response = await fetch(fileUrl);
                if (!response.ok) {
                    throw new Error(`Failed to fetch file: ${response.statusText}`);
                }

                // Read the file as ArrayBuffer
                const data = await response.arrayBuffer();

                // Parse the Excel file
                const workBook = XLSX.read(data, {
                    type: 'array'
                });

                all_rows = [];
                workBook.SheetNames.forEach(function (sheetName) {
                    all_rows = XLSX.utils.sheet_to_json(workBook.Sheets[sheetName]);
                    
                    if (all_rows.length > 0) {
                        console.log("excel rows ",all_rows);
//                        document.getElementById('txt_total_user').innerHTML = "총 " + rows.length + "명";
//                        all_rows = rows;
//                        document.getElementById("push-us").style.display = "block";
//
//                        var doc_keys = [];
//                        var div_keylist = document.getElementById("div_keylist").children;
//                        console.log("div_keylist ",div_keylist);
//                        for (var i = 0; i < div_keylist.length; i++)
//                            doc_keys.push(div_keylist[i].getElementsByTagName("select")[0].id);
//
//                        doc_keys.push(document.getElementById("doc_membership_type_list").id);
//                        doc_keys.push(document.getElementById("doc_membership_name_list").id);
//
//                        for (var i = 0; i < doc_keys.length; i++) {
//                            var doc_key = document.getElementById(doc_keys[i]);
//
//                            doc_key.innerHTML = "<option value=''>== 사용할 Key를 선택하세요 ==</option>";
//
//                            for (var key in rows[0]) {
//                                if (!checkTableEmpty(rows, key)) {
//                                    var opt = document.createElement('option');
//                                    opt.value = key;
//                                    opt.innerHTML = key;
//                                    doc_key.appendChild(opt);
//                                }
//                            }
//                        }
//
//                        // Show the table
//                        insert_table(all_rows);
                    }
                });
            } catch (error) {
                console.error("Error reading Excel file:", error);
            }
        }
        
        
        function updateSchoolList(searchTerm) {
            const schoolListDiv = document.getElementById("div_schoollist");

            // 기존 리스트 초기화
            schoolListDiv.innerHTML = "";

            // 검색어가 비어 있으면 종료
            if (!searchTerm.trim()) return;

            // 검색 결과 필터링
//            for(var i = 0 ; i < all_rows.length;i++){
//                var row = all_rows[i];
//                console.log("학교명 "+row["학교명"]);
//                if(row["학교명"].indexOf(searchTerm) >= 0){
//                    const schoolDiv = document.createElement("div");
//                    schoolDiv.textContent = row.학교명;
//                    schoolListDiv.appendChild(schoolDiv);
//                    console.log("row ",row["학교명"]);
//                }
//            }

            
             // 검색 결과 필터링
            const filteredRows = all_rows.filter(row => row.학교명.includes(searchTerm));

            
            var cnt = 1;
            const schoolDiv = document.createElement("div");
             schoolDiv.innerHTML = "<table><tr style='width:100%'>"+
                    "<td style='width:3%;border: 1px solid gray;'>번호</td>"+
                    "<td style='width:17%;border: 1px solid gray;'>학교명</td>"+
                    "<td style='width:20%;border: 1px solid gray;'>시도교육청명</td>"+
                    "<td style='width:30%;border: 1px solid gray;'>도로명주소</td>"+
                    "<td style='width:10%;border: 1px solid gray;'>기기 인증번호</td>"+
                    "<td style='width:10%;border: 1px solid gray;'>DB에 입력하기</td>"+
                    "<tr></table>";
            // 검색 결과가 있으면 리스트 생성
            filteredRows.forEach(row => {
                const schoolDiv = document.createElement("div");
//                schoolDiv.textContent = row.학교명;
                schoolListDiv.appendChild(schoolDiv);
                schoolDiv.innerHTML = "<table><tr style='width:100%'>"+
                    "<td style='width:3%;border: 1px solid gray;'>"+cnt+"</td>"+
                    "<td style='width:17%;border: 1px solid gray;'>"+row.학교명+"</td>"+
                    "<td style='width:20%;border: 1px solid gray;'>"+row.시도교육청명+"</td>"+
                    "<td style='width:30%;border: 1px solid gray;'>"+row.도로명주소+"</td>"+
                    "<td style='width:10%;border: 1px solid gray;'><input id='input_"+row.행정표준코드+"' tyle='text'/></td>"+
                    "<td style='width:10%;border: 1px solid gray;'><button onclick='insertMatjumUUID(\""+row.행정표준코드+"\" )'>DB에 입력하기</button></td>"+
                    "<tr></table>";
                cnt++;
            });
           
        }
        function insertMatjumUUID(standardcode){
            var txt_result = document.getElementById('txt_result');
            txt_result.innerHTML = "";
            var uuid = document.getElementById('input_'+standardcode).value;
            var row = null;
            for(var i = 0 ; i < all_rows.length;i++){
                if(all_rows[i].행정표준코드 == standardcode){
                    row = all_rows[i];
                    break;
                }
            }
            if(uuid != "" && row != null){
                
            
                var _data = {
                    "standardcode" : standardcode,
                    "projectid" : uuid,
                    "schooldata" : row
                };
                console.log("school code data is ",_data);
//                CallHandler("key_matjum_insertcode", _data, function(res) {
//                    code = parseInt(res.code);
//                    if (code == 100) {
//                            txt_result.innerHTML=row.학교명+" DB 입력 완료!!";
//                      console.log("DB에 입력 완료!!!");
//                    } else {
//                        alertMsg(res.message);
//                    }
//
//                }, function(err) {
//                    alertMsg("네트워크 에러 ");
//
//                });

            if(auth >= AUTH_OWNER)
            AJAX_AdmGet(ADM_TYPE.INSERT_SCHOOL_CODE, _data, function(res){
               code = parseInt(res.code);
               if (code == 100) {
                   console.log("UPDATE_CONTENT_DATA res is ",res);
                   
                    C_showToast("학교추가 완료!","학교 코드를 추가하였습니다");
                   hideModalDialog();
               }               
            });      
            }
            
        }

       
    </script>
