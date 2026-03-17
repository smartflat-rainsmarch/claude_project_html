<style>
    /* 221011 유진 추가 */
    .title_set{
        display: flex;
        justify-content: space-between;
        width: 1260px;
        height: auto;
        padding-bottom: 13px;
        background-color: #ffffff;
        border: 1px solid #eff2f5;
        border-radius: 10px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 5%);
    }
    .qr_all{
        width: 1260px;
        padding: 0;
        /*padding-top: 1.25rem;*/
        border: 1px solid #eff2f5;
        border-radius: 10px;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 5%);
        background-color: #fff;
    }
    .qr_title{
        margin-top: 20px;
        margin-left: 20px;
        font-size: 18px;
        color: #181c32;
        text-align: left;
        font-weight: 700;
    }
    .sub_title{
        width: 98%;
        border-radius: 10px;
        background-color: #c3d9ec;
        border: 1px solid #e4e6ef;
    }
    .sub_title_text{
        font-size: 16px;
        color: #3f4254;
        font-weight: 700;
        text-align: left;
        margin-left: 18px;
        height: 40px;
        line-height: 40px;
    }
    .form_sel_title{
        width: 100%;
        height: 44px;
        background-color: #f5f8fa;
        border-radius: 10px 10px 0 0;
        border: 1px solid #e4e6ef;
        border-bottom: none;
        margin-bottom: 0;
        padding-top: 10px;
        font-size: 15px;
        color: #181c32;
        font-weight: 500;
        text-align: left;
        padding-left: 0.75rem;
        margin-top: 20px;
    }
    .form-control{
        border-radius: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .control_all {
        border: none;
    }
    .backgrounds{
        width:400px;
        height: 400px;
        object-fit: contain;
    }
</style>

 <div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
    <div class="reservation_center" style='padding:5px'>
        <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >QR코드 만들기</text>
        <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
        <br>
        <div class="sub_title"><h2 class='sub_title_text'>QR코드 설정</h2>
            <div class='form-control control_all' style='width:100%;height:auto;'>
                <table style='width:100%;height:auto;'>
                <br>
                    <tr>
                        <td colspan='2' style='width:66%'>                                    
                            <label class='form_sel_title' style="margin-top:0px;">그룹선택</label>
                        </td>
                        <td colspan='1' style='width:34%'>                                    
                            <label class='form_sel_title' style="margin-top:0px;">센터선택</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2' style='width:100%'>     
                            <select id="qrcode_group" class="form-control" onchange="onChangeGroup()" name="doc_group" required>
                                <option value="">== 그룹을 선택하세요 ==</option>
                            </select><br>
                        </td>   
                        <td colspan='1' style='width:100%'>     
                        <select id="qrcode_center" class="form-control"  onchange="onChangeCenter()"name="doc_center" required>
                                <option value=''>- 센터 선택 -</option>
                            </select><br>
                        </td> 
                    </tr>
                    <tr>
                        <td colspan='3' style='width:100%'>                                    
                            <label class='form_sel_title'>값입력</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' style='width:100%'>     
                            <textarea  id="value" type="text" rows="3" cols="45" style='width:100%; margin-bottom: 20px;' disabled>https://www.bodypass.co.kr</textarea>
                        </td>            
                    </tr>
                        <tr>
                        <td>
                                <label class='form_sel_title'>배경색</label>
                            </td>
                            <td style='width:33%'>                                    
                                <label class='form_sel_title'>사이즈</label>
                            </td>
                            <td style='width:33%'>                                    
                                <label class='form_sel_title'>QR코드버전</label>
                            </td>                                    
                        </tr>
                        <tr>
                            <td> 
                                <input class = "form-control" id="bg" type="text" value="#fff"  style='width:100%'>
                            </td>
                            <td>
                                <input class = "form-control" id="size" type="number" value="512" style='width:100%'>
                            </td> 
                            <td>
                                <input class = "form-control" id="version" type="number" value="6" style='width:100%'>
                            </td> 
                        </tr>
                    <tr>
                        <td colspan='2' style='width:66%'>                                    
                            <label class='form_sel_title'>배경 이미지 파일선택</label>
                        </td>
                        <td colspan='1' style='width:34%'>                                    
                            <label class='form_sel_title'>디테일효과</label>
                        </td>             
                    </tr>
                    <tr>
                        <td colspan='2' style='width:66%'>                                    
                            <div  class = "form-control" style="height: 45px;" >

                                <select id='fillType' name="fillType">
                                <option>scale_to_fit</option>
                                <option>fill</option>
                                </select>
                                <input id="file" type="file">
                            </div>
                        </td>
                        <td colspan='1' style='width:34%'>
                            <div  class = "form-control" style="height: 45px; line-height: 30px;" >
                                <label>
                                    Threshold: <input type="radio" value="threshold" name="filter" checked>
                                    Color: <input type="radio" value="color" name="filter">
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' style='width:100%'>                                    
                            <label class='form_sel_title'>QR코드 and 배경이미지</label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' style='width:100%' align="center">       
                            <div  class = "form-control"  style="height:auto">
                                <div class="group" align="center" style='width:100%;height:500px'>
                                    <div id="qr" style='float:left'></div><div id="image" style='float:right;margin:50px'><img id='web_qr_logo_400x400' class="backgrounds" src="" ></div>

                                </div>
                            </div>
                        </td>
                    </tr>
                </table><br>
            </div>
        </div>
        <br>
        <div class="sub_title"><h2 class='sub_title_text'>최종이미지</h2></div><br>
        <div class="group">
            <div id="combine"></div>
            <div align="center"><button onclick='download_qrcode_image()' class='btn btn-primary btn-raised' style='float:right;margin:10px;margin-top:-15px; margin-right:20px;cursor:pointer;'>최종이미지 다운로드</button></div>
        </div>
        <br>
        <br>
    </div>
</div>
        
        
        <script>
            var web_qr_logo_400x400 = document.getElementById("web_qr_logo_400x400");
            web_qr_logo_400x400.src = QRCODE_LOGO;
            
            var qrcode_base64image = "";
            var groupcodes = [];
            var centercodes = [];
            function download_qrcode_image(){
                var combine = document.getElementById("combine");
                var canvas = combine.children[0];
                var dataURL = canvas.toDataURL();
//                clog("최종이미지 다운로드 ",dataURL);
              
                var qrcode_center = document.getElementById('qrcode_center');
                var centername = qrcode_center.options[qrcode_center.selectedIndex].text;
                var filename = centername+".png";
                downloadURI(dataURL,filename);
                
            }
            function downloadURI(uri, name) {
              var link = document.createElement("a");
              link.download = name;
              link.href = uri;
              document.body.appendChild(link);
              link.click();
              document.body.removeChild(link);
              delete link;
            }
            function init_d_visualqrcode(value) {
                var nowgroupcode = getData("nowgroupcode");
                var nowcentercode = getData("nowcentercode");
                getGroupCodes(function(res){
                    if (code == 100) {
                        var arr = res.message;
                        var qrcode_group = document.getElementById('qrcode_group');
                        
                        var groupcode = getData("nowgroupcode");
                        if(groupcode){
                            for (var i = 0; i < arr.length; i++) {
                                if(arr[i].groupcode == groupcode){
                                    qrcode_group.innerHTML = "<option value='"+arr[i].groupcode+"'>"+arr[i].groupcode+"</option>";
                                    onChangeGroup();
                                    break;    
                                }                                
                            }
                        
                        }else {
                            qrcode_group.innerHTML = "<option value=''>== 그룹을 선택하세요 ==</option>";
                            
                            for (var i = 0; i < arr.length; i++) {
                                var opt = document.createElement('option');
                                opt.value = arr[i].groupcode;
                                opt.innerHTML = arr[i].groupcode;
                                qrcode_group.appendChild(opt);
                            }    
                        }

                    } else {
                        alertMsg(res.message);
                    }
                    
                });
                //자동으로 센터를 선택
                setTimeout(function(){
                    onChangeCenter(getData("nowcentercode"));
                },1000);
            }
            function onChangeGroup(){
                var group_value = document.getElementById('qrcode_group').value;
                var nowcentercode = getData("nowcentercode");
                getCenters(group_value,function(res){
                     var code = parseInt(res.code);
                     if (code == 100) {


                        var qrcode_center = document.getElementById('qrcode_center');

                        qrcode_center.innerHTML = "<option value=''>- 센터 선택 -</option>";


                        var arr = res.message;
                        for (var i = 0; i < arr.length; i++) {
                            var opt = document.createElement('option');
                            opt.value = arr[i]["centercode"];
                            opt.optSelected = "true";
                            opt.innerHTML = arr[i]["centername"];
                            qrcode_center.appendChild(opt);
                            
//                            var selected = nowcentercode == arr[i]["centercode"] ? "selected" : "";
//                            qrcode_center.innerHTML += "<option value='"+arr[i]["centercode"]+"' "+selected+" >"+arr[i]["centername"]+"</option>";
                        }
                        
                        
                    } else {
                        alertMsg(res.message);
                    }
                });   
            }
            function onChangeCenter(center_code){
                var qrcode_center = document.getElementById('qrcode_center');
                if(qrcode_center && center_code){
                    qrcode_center.value = center_code;
                }
                var group_value = document.getElementById('qrcode_group').value;
                var center_value = qrcode_center.value;
                value = "{\"inputdata\":{\"groupcode\":\""+group_value+"\",\"centercode\":\""+center_value+"\"}}";
                document.getElementById("value").value = value;
                makeQR();
                makeQArt();
            }
            
                var value = "https://www."+domain_name;
                var filter = 'threshold';
                var imagePath = QRCODE_LOGO;
                var version = 6;
                var imageSize = 75 + (version * 12) - 24;
                var bg = "#fff";
                var size = "512";
                var fillType = 'scale_to_fit';

                var self = this;

//                $('#image img').width(imageSize);

                function makeQR() {
                    // clog('Current version:', version)
                    qrcode.qrcode.stringToBytes = qrcode.qrcode.stringToBytesFuncs['UTF-8']
                    var qr = qrcode.qrcode(version, 'H');
                    qr.addData(value);
                    try {
                      qr.make();

                    } catch (err) {
                      clog('Version is low:', version)
                      clog('Error:', err)
                    }
                    document.getElementById('qr').innerHTML = qr.createImgTag(10);
                }

                function makeQArt() {
                   var qart = new QArt({
                        value: value,
                        imagePath: imagePath,
                        filter: filter,
                        version: version,
                        background: bg,
                        size: size,
                        fillType: fillType
                    }).make(document.getElementById('combine'));
                    
                    clog("qart ",qart);
                }

                function getBase64(file, callback) {
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        callback(reader.result);
                    };
                }

                $('#value').keyup(function() {
                    value = $(this).val();
                    makeQR();
                    makeQArt();
                });

                $('#bg').keyup(function() {
                    bg = $(this).val();
                    makeQArt();
                });

                $('#size').keyup(function() {
                    size = $(this).val();
                    makeQArt();
                });

                $('#fillType').bind('change',function() {
                    fillType = $(this).val();
                    makeQArt();
                });


                $('#version').bind('keyup change click', function() {
                    clog($('#version').val());
                    version = $('#version').val();
                    imageSize = 75 + (version * 12) - 24;
                    $('#image img').width(imageSize);
                    makeQR();
                    makeQArt();
                });

                $('#file').change(function() {
                    getBase64(this.files[0], function(base64Img) {
                        
                        var regex = /data:(.*);base64,(.*)/gm;
                        var parts = regex.exec(base64Img);
                        imagePath = parts[0];
                        
                        $('#image img').attr('src', imagePath);
                        makeQArt();
                    });
                });

                $('input[type=radio]').click(function() {
                    filter = $(this).val();
                    makeQArt();
                });

                makeQR();
                makeQArt();
    
        </script>
    