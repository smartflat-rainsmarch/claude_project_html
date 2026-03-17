<style>
    .dellink {
        display: none;
    }

</style>
<div class="card-body">
    <H2 id='id_insertgroup_title'>업체 등록/수정하기</H2><br>

    <text style='color:blue;font-weight:bold'>※로고 이미지만 등록하거나 로고이미지만 교체하려면 그룹명만 입력 후 이미지들만 삽입한다.</text>
    <div id="div_tab3data">
        <br>



        <div class='form-control' style='height:auto'>
            <label align='left'><img src='./img/icon_title.png' title='업체를 구분할 수 있는 그룹명을 삽입한다. ex)sadanggym' style='width:20px;height:25px;margin-top:-8px;' />업체 그룹명</label><br>
            <div class='form-control' style='height:auto'>
                <label class='textevent' align='left'><img src='./img/ques_20.png' title='업체 그룹코드를 영문으로 입력한다.' style='margin-top:-8px;' />그룹코드 입력</label><br>
                <input class='form-control' id='input_groupcode' onchange='onChangeInsertGroup()' placeholder='영문 그룹코드 입력...' /><br>
                <label class='textevent' align='left'><img src='./img/ques_20.png' title='업체 그룹이름을 입력한다.' style='margin-top:-8px;' />그룹명 입력</label><br>
                <input class='form-control' id='input_groupname' placeholder='그룹이름 입력...' />


                <hr style='border: solid 1px light-gray;'>
                <label align='left'><img src='./img/icon_title.png' title='새로운 업체 로고 이미지를 삽입한다.' style='width:20px;height:25px;margin-top:-8px;' />업체 로고이미지 삽입<img id='icon_down2' align='right' onclick="viewImagePage(1)" src='./img/icon_down.png' /><img id='icon_up2' align='right' onclick="viewImagePage(0)" src='./img/icon_up.png' style='display:none' /></label><br>
                <div id='div_imagedata' class='form-control' style='height:700px;display:none'>
                    <table style='width:100%;height:700px'>
                        <tbody>
                            <thead>
                                <tr align="left" style="background-color:#eeeeee">

                                </tr>
                            </thead>
                            <tr align="center">
                                <td style='width:50%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='웹페이지 좌측상단에 삽입될 로고 이미지를 입력한다. (200x200) 밝은계열' style='margin-top:-8px;' />로고 삽입(200x200) 밝은계열</label><br>
                                </td>
                                <td style='width:50%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='QR코드에 사용할 이미지를 삽입한다.(400x400)' style='margin-top:-8px;' />QR코드 로고 삽입(400x400)</label><br>
                                </td>
                            </tr>
                            <tr align="center">
                                <td style='width:50%'><input type="file" id="fileInput1">
                                    <div id="image1"><img id='web_logo1' src="" width="171"></div>
                                </td>
                                <td style='width:50%'><input type="file" id="fileInput2">
                                    <div id="image2"><img id='web_logo2' src="" width="171"></div>
                                </td>
                            </tr>
                            <tr align="center">
                                <td style='width:50%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='가입페이지에서 보여질 밝은계열 텍스트 타이틀 로고를 삽입한다. (650x100)' style='margin-top:-8px;' />밝은계열 타이틀로고 삽입(650x100)</label><br>
                                </td>
                                <td style='width:50%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='태블릿 or 웹페이지에서 보여질 어두운계열 텍스트 타이틀 로고를 삽입한다. (650x100)' style='margin-top:-8px;' />어두운계열 타이틀로고 삽입(650x100)</label><br>
                                </td>
                            </tr>
                            <tr align="center">
                                <td><input type="file" id="fileInput3">
                                    <div id="image3"><img id='web_logo3' src="" width="171"></div>
                                </td>
                                <td><input type="file" id="fileInput4">
                                    <div id="image4"><img id='web_logo4' src="" width="171"></div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            <br><br>
            <!--             <hr style='border: solid 1px light-gray;'><br>-->
            <label align='left'><img src='./img/icon_title.png' title='새로운 업체 로고 이미지를 삽입한다.' style='width:20px;height:25px;margin-top:-8px;' /><text id='txt_center_title'>새로운 센터 삽입</text><img id='icon_down' align='right' onclick="viewCenterPage(1)" src='./img/icon_down.png' /><img id='icon_up' align='right' onclick="viewCenterPage(0)" src='./img/icon_up.png' style='display:none' /></label><span style='float:right'><select id="select_center" class="form-control"  onchange="onChangeCenter()" style='width:250px;margin-top:-5px'><option value=''>- 센터 선택 -</option></select></span><span style='float:right'>기존 센터선택 : &nbsp;</span><br>
            <div class='form-control' id='div_centerdata' style='display:none;height:auto'>
                <div>
                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='구분할 수 있는 센터의 이름을 입력한다.' style='margin-top:-8px;' />센터이름 입력</label><br>
                    <input class='form-control' id='input_centername' placeholder='ex)블랙짐 관양점...' /><br>
                </div>
                <div>
                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='운영하는 센터의 주소를 입력한다..' style='margin-top:-8px;' />센터주소 입력</label>
                    <input class='form-control' id='input_centeraddress' placeholder='ex)경기도 수원시...' /><br>

                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='운영하는 센터의 위도 경도를 입력한다..' style='margin-top:-8px;' />위도 경도 입력</label>
                    <div class='form-control' style='height:40px'>
                        위도 : <input id="input_location_latitude" placeholder="위도입력" style="max-width:250px" />&nbsp;&nbsp;경도 : <input id="input_location_longitude" placeholder="경도입력" style="max-width:250px" />
                    </div>
                </div>
                <br>
                <div>

                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='앱에서 표시될 내용을 입력..' style='margin-top:-8px;' />센터설명(운영시간)</label>
                    <input type='text' class='form-control' id='input_centerdesc' placeholder='ex)안양점 운영시간 06:00 ~ 21:00' /><br>
                </div>
                <div>

                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='이용약관을 입력한다..' style='margin-top:-8px;' />이용약관</label>
                    <textarea class='form-control' style='height:100px' id='input_termsofservice' placeholder='이용약관 입력...'></textarea><br>
                </div>
                <div>

                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='개인정보처리방침을 입력한다..' style='margin-top:-8px;' />개인정보처리방침 </label>
                    <textarea class='form-control' style='height:100px' id='input_privacypolicy' placeholder='개인정보처리방침  입력...'></textarea><br>
                </div>
                <div>

                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='PT 이용시 규정을 입력한다...' style='margin-top:-8px;' />PT 이용시 규정</label>
                    <textarea class='form-control' style='height:100px' id='input_counttype_rule' placeholder='이용시 규정...'></textarea><br>
                </div>
                <div>

                    <label class='textevent' align='left'>양도약관 </label>
                    <textarea class='form-control' style='height:100px' id='input_sendcoupon_rule' placeholder='양도약관  입력...'></textarea><br>
                </div>
                <div>

                    <label class='textevent' align='left'>가입페이지 주요 이용규정및 환불규정 </label>
                    <textarea class='form-control' style='height:100px' id='input_mainuse_rule' placeholder='가입페이지 주요 이용규정및 환불규정 입력...'></textarea><br>
                </div>


                <label align='left'><img src='./img/icon_title.png' title='센터를 홍보하는 카달로그 이미지를 삽입한다.' style='width:20px;height:25px;margin-top:-8px;' />카달로그 이미지 (최대4장)<img id='icon_catalog_down' align='right' onclick="viewCatalogImagePage(1)" src='./img/icon_down.png' /><img id='icon_catalog_up' align='right' onclick="viewCatalogImagePage(0)" src='./img/icon_up.png' style='display:none' /></label><br>
                <div id='div_catalog_imagedata' class='form-control' style='height:auto;'>
                    <table style='width:100%;'>
                        <tbody>
                            <thead>
                                <tr align="left" style="background-color:#eeeeee">

                                </tr>
                            </thead>
                            <tr align="center">
                                <td style='width:25%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='720x960 사이즈 JPEG 이미지' style='margin-top:-8px;' />첫번째(720x960)</label><br>
                                </td>
                                <td style='width:25%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='720x960 사이즈 JPEG 이미지' style='margin-top:-8px;' />두번째(720x960)</label><br>
                                </td>
                                <td style='width:25%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='720x960 사이즈 JPEG 이미지' style='margin-top:-8px;' />세번째(720x960)</label><br>
                                </td>
                                <td style='width:25%'>
                                    <label class='textevent' align='left'><img src='./img/ques_20.png' title='720x960 사이즈 JPEG 이미지' style='margin-top:-8px;' />네번째(720x960)</label><br>
                                </td>

                            </tr>
                            <tr align="center">
                                <td style='width:25%'><br><input type="file" id="fileCatalogInput1" style='font-size:13px;float:left;'>
                                    <div id="catalogimage1"><img id='catalog1_720x960' src="" width="171"></div><br>
                                </td>
                                <td style='width:25%'><br><input type="file" id="fileCatalogInput2" style='font-size:13px;float:left;'>
                                    <div id="catalogimage2"><img id='catalog2_720x960' src="" width="171"></div><br>
                                </td>
                                <td style='width:25%'><br><input type="file" id="fileCatalogInput3" style='font-size:13px;float:left;'>
                                    <div id="catalogimage3"><img id='catalog3_720x960' src="" width="171"></div><br>
                                </td>
                                <td style='width:25%'><br><input type="file" id="fileCatalogInput4" style='font-size:13px;float:left'>
                                    <div id="catalogimage4"><img id='catalog4_720x960' src="" width="171"></div><br>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>


        </div>

    </div>
    <button id='btn_save' onclick='check_group()' class='btn btn-primary btn-raised' style='background-color:#33aaaa;float:right;margin:10px;cursor:pointer;'>정보 저장하기</button>
</div>

<script>
    clog("업체등록/수정하기");
    var logoimagedata = "";
    var qrcodeimagedata = "";
    var titlewhiteimagedata = "";
    var titledarkimagedata = "";
    var iscentershow = false;
    var isimageshow = false;

    var catalogimage1data = "";
    var catalogimage2data = "";
    var catalogimage3data = "";
    var catalogimage4data = "";
    
     var isupdate_centercode = "";
    function init_d_insert_group(value) {
        
    }

    function check_group() {
        var input_groupcode = document.getElementById("input_groupcode").value; //그룹명

        getAllGroups(function(groups) {
            var isgroup = false;
            for (var i = 0; i < groups.length; i++) {
                if (input_groupcode == groups[i].groupcode) {
                    //clog("input_groupcode "+input_groupcode+" groups[i].groupcode "+groups[i].groupcode);
                    isgroup = true;
                    break;
                }
            }
            if(!isupdate_centercode)insert_groupdata(isgroup);
            else change_centerdata(isupdate_centercode);

        });

        //         insert_groupdata();
    }
    //입력한 그룹이 있는지 체크하기 위해 그룹목록을 가져온다. 
    function getAllGroups(callback) {
        var _data = {
            "type": "getgroupcodes" // group or center or auth
        };
        CallHandler("adm_get", _data, function(res) {
            code = parseInt(res.code);

            if (code == 100) {
                callback(res.message);

            } else {
                //                alertMsg(res.message);
            }

        }, function(err) {
            alertMsg("네트워크 에러 ");

        });
    }
    function onChangeInsertGroup(){
        var input_groupcode = document.getElementById('input_groupcode');
        var input_groupname = document.getElementById("input_groupname");
        var group_value = "";
        if(auth >= AUTH_OPERATOR){
            group_value = input_groupcode.value;   
        }            
        else{
            group_value = session_groupcode; 
            input_groupcode.disabled = true;
        } 
            
        getGroupName(input_groupcode.value,function(res){
            var code = parseInt(res.code);
            if (code == 100) {
                
                input_groupname.value = res.message;
            }else 
                input_groupname.value = "";
        })
        
        getCenters(group_value,function(res){
            var code = parseInt(res.code);
            if (code == 100) {
                
                initGroupLogoImageData();
                
                var select_center = document.getElementById('select_center');

                select_center.innerHTML = "<option value=''>- 센터 선택 -</option>";


                var arr = res.message;
                for (var i = 0; i < arr.length; i++) {
                    var opt = document.createElement('option');
                    opt.value = arr[i]["centercode"];
                    opt.innerHTML = arr[i]["centername"];
                    select_center.appendChild(opt);
                }


            } else {
                alertMsg(res.message);
            }
        });
    }
   
    function onChangeCenter(){
         var input_groupcode = document.getElementById("input_groupcode"); //그룹명
        var select_center = document.getElementById('select_center');
        if(select_center.value){
            getCenterData(input_groupcode.value, select_center.value)
        }else{
            isupdate_centercode = "";
            setCenterData(null);
        }
    }
    function getCenterData(groupcode,centercode){
        var value = {
            groupcode : groupcode,
            centercode : centercode
        }
         var senddata = {
            groupcode: groupcode,
            type: "insertgroup_getcenterdata",
            value : value
        };
        CallHandler("adm_get", senddata, function(res) {
            //            clog("setsettingres is ",res);
            if (res.code == 100) {
               isupdate_centercode = res.message.centercode;
                setCenterData(res.message);
            } else {
                isupdate_centercode = "";
                C_showToast( "센터데이타를 가져오지 못하였습니다.!", "" + res.message, function() {});
               setCenterData(null);
            }


        }, function(err) {
            isupdate_centercode = "";
            setCenterData(null);
            C_showToast( "네트워크에러!", "" + err, function() {});
          
        });
    }
    function setCenterData(centercodedata){
        var txt_center_title = document.getElementById("txt_center_title");
        var btn_save = document.getElementById("btn_save");
        if(centercodedata != null){
            txt_center_title.innerHTML = "기존센터 수정";
            btn_save.innerHTML = "정보 수정하기";
            
        }else{
            txt_center_title.innerHTML = "새로운 센터 삽입";
            btn_save.innerHTML = "정보 저장하기";
        }
        setCentercodeData(centercodedata);
            
        
    }
    var pricenamesetting = "";
    function setCentercodeData(centercodedata){
        var input_centername = document.getElementById("input_centername");
        var input_centeraddress = document.getElementById("input_centeraddress");
        var input_location_latitude = document.getElementById("input_location_latitude");
        var input_location_longitude = document.getElementById("input_location_longitude");
        var input_centerdesc = document.getElementById("input_centerdesc");
        var input_termsofservice = document.getElementById("input_termsofservice");
        var input_privacypolicy = document.getElementById("input_privacypolicy");
        var input_counttype_rule = document.getElementById("input_counttype_rule");
        var input_sendcoupon_rule = document.getElementById("input_sendcoupon_rule");
        var input_mainuse_rule = document.getElementById("input_mainuse_rule");
        var catalog1_720x960 = document.getElementById("catalog1_720x960");
        var catalog2_720x960 = document.getElementById("catalog2_720x960");
        var catalog3_720x960 = document.getElementById("catalog3_720x960");
        var catalog4_720x960 = document.getElementById("catalog4_720x960");
     
        if(!centercodedata){
            input_centername.value = "";
            input_centeraddress.value = "";
            input_location_latitude.value = "";
            input_location_longitude.value = "";
            input_centerdesc.value = "";
            
            input_termsofservice.value = "";
            input_privacypolicy.value = "";
            input_counttype_rule.value = "";
            input_sendcoupon_rule.value = "";
            input_mainuse_rule.value = "";
            
            catalog1_720x960.src = "";
            catalog2_720x960.src = "";
            catalog3_720x960.src = "";
            catalog4_720x960.src = "";   
            
        }else{
            
            var setting = centercodedata.setting ? JSON.parse(centercodedata.setting) : null;
            input_centername.value = centercodedata.centername ? centercodedata.centername : "";
            input_centeraddress.value = setting && setting.centeraddress ? setting.centeraddress : "";
            input_location_latitude.value = setting && setting.location ? setting.location.latitude : "";
            input_location_longitude.value = setting && setting.location ? setting.location.longitude : "";
            input_centerdesc.value = setting && setting.centerdesc ? setting.centerdesc : "";
            
            input_termsofservice.value =  centercodedata.termsofservice ? centercodedata.termsofservice : "";
            input_privacypolicy.value = centercodedata.privacy_policy ? centercodedata.privacy_policy : "";
            input_counttype_rule.value = centercodedata.counttype_rule ? centercodedata.counttype_rule : "";
            input_sendcoupon_rule.value = centercodedata.sendcoupon_rule ? centercodedata.sendcoupon_rule : "";
            input_mainuse_rule.value = centercodedata.main_use_rule ? centercodedata.main_use_rule : "";
            
            pricenamesetting = setting && setting.pricenamesetting ? setting.pricenamesetting : "";
            
            catalog1_720x960.src = PAGE_IMAGE_PATH+centercodedata.groupcode+"/logos/catalog1_"+centercodedata.centercode+"_720x960.JPG";
            catalog2_720x960.src = PAGE_IMAGE_PATH+centercodedata.groupcode+"/logos/catalog2_"+centercodedata.centercode+"_720x960.JPG";
            catalog3_720x960.src = PAGE_IMAGE_PATH+centercodedata.groupcode+"/logos/catalog3_"+centercodedata.centercode+"_720x960.JPG";
            catalog4_720x960.src = PAGE_IMAGE_PATH+centercodedata.groupcode+"/logos/catalog4_"+centercodedata.centercode+"_720x960.JPG";
        }
    }
    function change_centerdata(centercode){
        var select_center = document.getElementById('select_center');
//        var before_centercode = select_center.value;
        var before_centername = select_center.options[select_center.selectedIndex].text;
        
        var input_groupcode = document.getElementById("input_groupcode").value; //그룹코드
        var input_groupname = document.getElementById("input_groupname").value; //그룹이름
        var input_centername = document.getElementById("input_centername").value; //센터이름
        var input_centeraddress = document.getElementById("input_centeraddress").value; //센터주소
        var input_location_latitude = document.getElementById("input_location_latitude").value; //위도
        var input_location_longitude = document.getElementById("input_location_longitude").value; //경도
        var input_centerdesc = document.getElementById("input_centerdesc").value; //센터설명(운영시간)
        var input_termsofservice = document.getElementById("input_termsofservice").value; //이용약관
        var input_privacypolicy = document.getElementById("input_privacypolicy").value; //개인정보처리방침
        var input_counttype_rule = document.getElementById("input_counttype_rule").value; //PT/GX 이용시 규정
        var input_sendcoupon_rule = document.getElementById("input_sendcoupon_rule").value; //회원권 양도약관
        var input_mainuse_rule = document.getElementById("input_mainuse_rule").value; //가입페이지 주요 이용규정및 환불규정

        var value = {
            groupcode: input_groupcode,
            groupname: input_groupname,
            centercode: centercode,            
            centername: input_centername,
            centeraddress: input_centeraddress,
            location_latitude: input_location_latitude,
            location_longitude: input_location_longitude,
            centerdesc: input_centerdesc,
            termsofservice: escapeHtml(input_termsofservice),
            privacypolicy: escapeHtml(input_privacypolicy),
            counttype_rule: escapeHtml(input_counttype_rule),
            sendcoupon_rule: escapeHtml(input_sendcoupon_rule),
            mainuse_rule: escapeHtml(input_mainuse_rule),
            logoimagedata: logoimagedata,
            qrcodeimagedata: qrcodeimagedata,
            titlewhiteimagedata: titlewhiteimagedata,
            titledarkimagedata: titledarkimagedata,
            catalogimage1data : catalogimage1data,
            catalogimage2data : catalogimage2data,
            catalogimage3data : catalogimage3data,
            catalogimage4data : catalogimage4data,
            pricenamesetting: pricenamesetting
            
        }
        showModalDialog(document.body, "기존센터수정", "기존센터["+before_centername+"] 데이타를 수정하시겠습니까?", "확인", "취소", function() {
            insertGroupChangeCenterDataSend(value);
        }, function() {
            hideModalDialog();
        }, null);
    }
    function insert_groupdata(isgroup) {
        clog("insert_groupdata");
        var input_groupcode = document.getElementById("input_groupcode").value; //그룹코드
        var input_groupname = document.getElementById("input_groupname").value; //그룹이름
        var input_centername = document.getElementById("input_centername").value; //센터이름
        var input_centeraddress = document.getElementById("input_centeraddress").value; //센터주소
        var input_location_latitude = document.getElementById("input_location_latitude").value; //위도
        var input_location_longitude = document.getElementById("input_location_longitude").value; //경도
        var input_centerdesc = document.getElementById("input_centerdesc").value; //센터설명(운영시간)
        var input_termsofservice = document.getElementById("input_termsofservice").value; //이용약관
        var input_privacypolicy = document.getElementById("input_privacypolicy").value; //개인정보처리방침
        var input_counttype_rule = document.getElementById("input_counttype_rule").value; //PT 이용시 규정
        var input_sendcoupon_rule = document.getElementById("input_sendcoupon_rule").value; //회원권 양도약관
        var input_mainuse_rule = document.getElementById("input_mainuse_rule").value; //가입페이지 주요 이용규정및 환불규정

        var value = {
            groupcode: input_groupcode,
            groupname: input_groupname,
            centername: input_centername,
            centeraddress: input_centeraddress,
            location_latitude: input_location_latitude,
            location_longitude: input_location_longitude,
            centerdesc: input_centerdesc,
            termsofservice: escapeHtml(input_termsofservice),
            privacypolicy: escapeHtml(input_privacypolicy),
            counttype_rule: escapeHtml(input_counttype_rule),
            sendcoupon_rule: escapeHtml(input_sendcoupon_rule),
            mainuse_rule: escapeHtml(input_mainuse_rule),
            logoimagedata: logoimagedata,
            qrcodeimagedata: qrcodeimagedata,
            titlewhiteimagedata: titlewhiteimagedata,
            titledarkimagedata: titledarkimagedata,
            catalogimage1data : catalogimage1data,
            catalogimage2data : catalogimage2data,
            catalogimage3data : catalogimage3data,
            catalogimage4data : catalogimage4data
            
        }
        if (!input_groupcode) {
            alertMsg("그룹코드를 입력해주세요.");
            return;
        }
        clog("centername " + input_centername);
        var txt_isgroup = isgroup ? "(기존업체) " : "(새로운 업체) ";
        var title = txt_isgroup + "센터추가";
        var message = input_centername != "" ? txt_isgroup + " " + input_groupcode + " 에 센터를 추가하시겠습니까?" : txt_isgroup + " " + input_groupcode + " 에 이미지만 수정하시겠습니까?";
        if (!input_centername && !logoimagedata && !qrcodeimagedata && !logoimagedata && !titledarkimagedata) {
            alertMsg("센터명이나 이미지를 삽입하세요");
            return;
        }
        showModalDialog(document.body, title, message, "확인", "취소", function() {

            insertGroupDataSend(value);
        }, function() {
            hideModalDialog();
        }, null);


    }

    function viewCenterPage(isshow) {
        var icon_down = document.getElementById("icon_down");
        var icon_up = document.getElementById("icon_up");
        var div_centerdata = document.getElementById("div_centerdata");
        iscentershow = isshow == 1 ? true : false;
        if (iscentershow) {
            icon_down.style.display = "none";
            icon_up.style.display = "block";
            div_centerdata.style.display = "block";
        } else {
            icon_down.style.display = "block";
            icon_up.style.display = "none";
            div_centerdata.style.display = "none";
        }

    }
    //업체로고이미지 
    function viewImagePage(isshow) {
        var icon_down = document.getElementById("icon_down2");
        var icon_up = document.getElementById("icon_up2");
        var div_imagedata = document.getElementById("div_imagedata");
        isimageshow = isshow == 1 ? true : false;
        if (isimageshow) {
            icon_down.style.display = "none";
            icon_up.style.display = "block";
            div_imagedata.style.display = "block";
            
        } else {
            icon_down.style.display = "block";
            icon_up.style.display = "none";
            div_imagedata.style.display = "none";
        }

    }
    //센터 카달로그 이미지
    function viewCatalogImagePage(isshow) {
        var icon_down = document.getElementById("icon_catalog_down");
        var icon_up = document.getElementById("icon_catalog_up");
        var div_imagedata = document.getElementById("div_catalog_imagedata");
        isimageshow = isshow == 1 ? true : false;
        if (isimageshow) {
            icon_down.style.display = "none";
            icon_up.style.display = "block";
            div_imagedata.style.display = "block";
            
        } else {
            icon_down.style.display = "block";
            icon_up.style.display = "none";
            div_imagedata.style.display = "none";
        }
    }
//    function insertGroupChangeCenterDataSend(value) {
//        var senddata = {
//            groupcode: value.groupcode,
//            type: "insertgroup_changecenter",
//            value: value
//        };
//        CallHandler("adm_get", senddata, function(res) {
//                        clog("setsettingres is ",res);
//            if (res.code == 100) {
//                //                 C_showToast( "삽입완료!", "성공적으로 삽입하였습니다.", function() {});
//                alertMsg("성공적으로 삽입하였습니다.", function() {
//                    loadMainDiv(0);
//                    hideModalDialog();
//                    hideModalDialog();
//                });
//            } else {
//                C_showToast( "삽입불가!", "" + res.message, function() {});
//                hideModalDialog();
//            }
//
//
//        }, function(err) {
//            C_showToast( "에러!", "" + err, function() {});
//            hideModalDialog();
//
//        });
//    }
    function insertGroupChangeCenterDataSend(value) {
        var senddata = {
            groupcode: value.groupcode,
            type: "insertgroup_changecenter",
            value: value
        };
        console.log("value ",value);
        CallHandler("adm_get", senddata, function(res) {
            //            clog("setsettingres is ",res);
            if (res.code == 100) {
                //                 C_showToast( "삽입완료!", "성공적으로 삽입하였습니다.", function() {});
                alertMsg("성공적으로 삽입하였습니다.", function() {
                    refresh_page();
//                    loadMainDiv(0);
//                    hideModalDialog();
//                    hideModalDialog();
                });
            } else {
                C_showToast( "삽입불가!", "" + res.message, function() {});
                hideModalDialog();
            }


        }, function(err) {
            C_showToast( "에러!", "" + err, function() {});
            hideModalDialog();

        });
    }
    function insertGroupDataSend(value) {
        var senddata = {
            groupcode: value.groupcode,
            type: "insertgroup",
            value: value
        };
        CallHandler("adm_get", senddata, function(res) {
            //            clog("setsettingres is ",res);
            if (res.code == 100) {
                //                 C_showToast( "삽입완료!", "성공적으로 삽입하였습니다.", function() {});
                alertMsg("성공적으로 삽입하였습니다.", function() {
                     refresh_page();
//                    loadMainDiv(0);
//                    hideModalDialog();
//                    hideModalDialog();
                });
            } else {
                C_showToast( "삽입불가!", "" + res.message, function() {});
                hideModalDialog();
            }


        }, function(err) {
            C_showToast( "에러!", "" + err, function() {});
            hideModalDialog();

        });
    }
    function initGroupLogoImageData(){
        clog("initGroupLogoImageData");
        var logoimagedata = "";
        var qrcodeimagedata = "";
        var titlewhiteimagedata = "";
        var titledarkimagedata = "";
        
        var input_groupcode_value = document.getElementById("input_groupcode").value;
       
        var image1 = document.getElementById("web_logo1");
        var image2 = document.getElementById("web_logo2");
        var image3 = document.getElementById("web_logo3");
        var image4 = document.getElementById("web_logo4");
        
        try{
            image1.src = PAGE_IMAGE_PATH+input_groupcode_value+"/logos/web_icon_white_200x200.png";
            image2.src = PAGE_IMAGE_PATH+input_groupcode_value+"/logos/web_qr_logo_400x400.png";
            image3.src = PAGE_IMAGE_PATH+input_groupcode_value+"/logos/web_title_white_650x100.png";
            image4.src = PAGE_IMAGE_PATH+input_groupcode_value+"/logos/web_title_default_650x100.png";
        }catch(e){
            
        }
        
        
    }


    $('#fileInput1').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#image1 img').attr('src', imagePath);
            logoimagedata = base64Img;

        });
    });
    $('#fileInput2').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#image2 img').attr('src', imagePath);
            qrcodeimagedata = base64Img;
        });
    });
    $('#fileInput3').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#image3 img').attr('src', imagePath);
            titlewhiteimagedata = base64Img;
        });
    });
    $('#fileInput4').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#image4 img').attr('src', imagePath);
            titledarkimagedata = base64Img;
        });
    });

    
    $('#fileCatalogInput1').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#catalogimage1 img').attr('src', imagePath);
            catalogimage1data = base64Img;
        });
    });
    $('#fileCatalogInput2').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#catalogimage2 img').attr('src', imagePath);
            catalogimage2data = base64Img;
        });
    });
    $('#fileCatalogInput3').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#catalogimage3 img').attr('src', imagePath);
            catalogimage3data = base64Img;
        });
    });
    $('#fileCatalogInput4').change(function() {
        getBase64(this.files[0], function(base64Img) {
            var regex = /data:(.*);base64,(.*)/gm;
            var parts = regex.exec(base64Img);
            imagePath = parts[0];

            $('#catalogimage4 img').attr('src', imagePath);
            catalogimage4data = base64Img;
        });
    });
    function getBase64(file, callback) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function() {
            callback(reader.result);
        };
    }

</script>
