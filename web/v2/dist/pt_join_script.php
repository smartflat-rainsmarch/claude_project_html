<div align='center'>
    <div id='pt_formdiv1' style='width:100%;padding:20px'>
        <div align='center' id='signdiv1'  style='width:100%;text-align: center;' >
            <label for='signpad13' style='font-size:15px;color:#262930;font-weight:500;margin-bottom:30px'>약관의 모든 내용을 숙지하였으며, 이에 동의합니다.</label>
            <div id='signpad13'>
                <table style='width:100%'>
                    <tr>
                        <td style='width:20%;height:200px;vertical-align:top'>
                            
                                <text style='color:#3f4254;font-size:15px;font-weight:500'>이름 입력란:</text><br>
                                <button class='button' id='clear' onclick='clear_sign1(1)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>
                            
                        </td>
                        <td  id='signtda' style='background-color:#f5f8fa;border-radius:10px;width:80%;height:200px'>
                           
                            <div id='sign_devidea' style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;'></div>
                            <div id='sign_devideb' style='position:absolute;background-color:#cccccc;width:1px;height:180px;margin-top:10px;'></div>
                            <div id='div_namepad' class='wrapper'>
                                <canvas id='signature-pad-name1' class='signature-pad-name1' style='width:100%;height:200px'></canvas>
                            </div>
                           
                        </td>
                    </tr>
                    <tr>
                        <td colspan = '2' style='height:35px'>
                        </td>
                    </tr>
                    <tr>
                       <td style='width:20%;height:200px;vertical-align:top'>
                            <text style='color:#3f4254;font-size:15px;font-weight:500'>서명란:</text><br>
                             <button class='button' id='clear' onclick='clear_sign1(2)' style='margin-top:10px;background-color:#33a186;border:0px;border-radius:5px;padding:3px 8px 5px 10px;font-size:14px;color:white'>다시쓰기</button>
                        </td>
                        <td  id='signtdb' style='background-color:#f5f8fa;border-radius:10px;width:width:80%;height:200px'>
                            <div class='wrapper'>
                                <canvas id='signature-pad-sign1' class='signature-pad-sign1' style='width:100%;height:200px'></canvas>
                            </div>
                        </td>
                    </tr>
                    
                </table>
                
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
        if($('#signpad13').width() > 100){
            
            signaturePadName1 = new SignaturePad(document.getElementById('signature-pad-name1'), {
                backgroundColor: 'rgba(255, 255, 0, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            signaturePadSign1 = new SignaturePad(document.getElementById('signature-pad-sign1'), {
                backgroundColor: 'rgba(255, 255, 255, 0)',
                penColor: 'rgb(0, 0, 255)'
            });
            
            var signtda = document.getElementById("signtda");
            var signtdb = document.getElementById("signtdb");
            var sign_devidea = document.getElementById("sign_devidea");
            var sign_devideb = document.getElementById("sign_devideb");

            
            var signtda_width = signtda.offsetWidth;
            var signtda_height = signtda.offsetHeight;
            sign_devidea.style.marginLeft = signtda_width/3;
            sign_devideb.style.marginLeft = signtda_width/3*2;
            
            
            
            clog("signtda ",signtda);
            clog("sign_devidea ",sign_devidea);
            clog("sign_devideb ",sign_devideb);
            
            canvasName1.width = signtda_width; //좌측글씨 길이가 100이라서 100을 뺀다
            canvasSign1.width = signtda_width;//좌측글씨 길이가 100이라서 100을 뺀다
            canvasName1.height = signtda_height; //좌측글씨 길이가 100이라서 100을 뺀다
            canvasSign1.height = signtda_height;//좌측글씨 길이가 100이라서 100을 뺀다
            
            clog("signtda_width ",signtda_width);
            clog("signtda_height ",signtda_height);
            clog("canvasName1 ",canvasName1);
            
            
            try{
                if(pt_join_data && pt_join_data.signdataname1)signaturePadName1.fromDataURL(pt_join_data.signdataname1);
                if(pt_join_data && pt_join_data.signdatasign1)signaturePadSign1.fromDataURL(pt_join_data.signdatasign1);     
            
            }catch(e){
                
            }
            

            
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
