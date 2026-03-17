<script src='signature_pad.min.js'></script>
    <script src='signature/assets/json2.min.js'></script>
<div align='center' class='form-group row' >
    <div id='pt_formdiv1' style='width:100%;' class='col-12 offset-0'>
        <div align='center' id='signdiv1'  style='width:600px;text-align: center;' >
            <label for='signpad1'>(서명) 약관의 모든 내용을 숙지하였으며, 이에 동의합니다.</label>
            <div id='signpad1'>
                <label style='color:gray'>※이름 입력란</label>
                <div style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;margin-left:200px'></div>
                <div style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;margin-left:400px'></div>
                <div class='wrapper' style='background-color: #ffffff'>
                    <canvas id='signature-pad-name1' class='signature-pad-name1' width=800px height=200px></canvas>
                </div>
                <div>
                    <button id='clear' onclick='clear_sign1(1)'>이름다시쓰기</button>
                </div>
                <hr style='border: solid 1px light-gray;'>
                <label style='color:gray'>※서명란</label>
                <div class='wrapper' style='background-color: #ffffff'>
                    <canvas id='signature-pad-sign1' class='signature-pad-sign1' width=800px height=200px></canvas>
                </div>
                <div>
                    <button id='clear' onclick='clear_sign1(2)'>서명다시하기</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var canvasName1 = document.getElementById('signature-pad-name1');
    var canvasSign1 = document.getElementById('signature-pad-sign1');
    var signaturePadName1 = null;
    var signaturePadSign1 = null;
    var cInterval = setInterval(function(){
        if($('#signpad1').width() > 10){
            canvasName1.width = $('#signpad1').width();
            canvasSign1.width = $('#signpad1').width();
            signaturePadName1 = new SignaturePad(document.getElementById('signature-pad-name1'), {
                backgroundColor: 'rgba(255, 255, 0, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            signaturePadSign1 = new SignaturePad(document.getElementById('signature-pad-sign1'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
//            clog("pt_join_data is ",pt_join_data);
            
           
            
            clearInterval(cInterval);            
        }
    });
    
    function clear_sign1(type) {
        clog("clear sign!!");
        if (type == 1)
            signaturePadName1.clear();
        else
            signaturePadSign1.clear();

    }

</script>
