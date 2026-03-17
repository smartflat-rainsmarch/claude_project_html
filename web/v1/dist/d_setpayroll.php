 
<div id='setpayroll_container' class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div class="reservation_center" style='padding:5px'>
            <text id = 'id_setting_title' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >급여 목표금액구간 설정</text>

    
		<br><br><br>

        <div style='width:1198px;height:100px; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;'>
             <div style='width:100%;height:44px;background-color:#f5f8fa; border-radius:10px 10px 0 0; border-bottom:1px solid #e4e6ef;'>
                <label style='font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px'>페이롤 부가세10% 차감 설정</label><span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>PT 결제시 부가세10% 제외한 금액을 페이롤에 적용할지 안할지 선택합니다.</span></span><span style="float:right"></span>
             </div>
            <div style='height:auto;padding:15px 30px 15px 30px'>
               <div style="">
                    <input id="payrollvat_0" type='radio' name='payrollvat' value='0' checked><text class="fmont" style='font-size:14px'>&nbsp;0%(차감안함)</text>&nbsp;&nbsp;&nbsp;&nbsp;
                   <input id="payrollvat_1" type='radio' name='payrollvat' value='1'><text  class="fmont"  style='font-size:14px'>&nbsp;카드10% 차감</text>&nbsp;&nbsp;&nbsp;
                   <input id="payrollvat_2" type='radio' name='payrollvat' value='2'><text  class="fmont"  style='font-size:14px'>&nbsp;현금10% 차감</text>&nbsp;&nbsp;&nbsp;
                   <input id="payrollvat_4" type='radio' name='payrollvat' value='4'><text  class="fmont" style='font-size:14px'>&nbsp;카드,현금10% 차감</text>&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <br><br>
		<div style='width:1198px;height:auto; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;'>
			 <div style='width:100%;height:44px;background-color:#f5f8fa; border-radius:10px 10px 0 0; border-bottom:1px solid #e4e6ef;'>
				<span style='float:left;padding-top: 10px;font-size: 15px; color:#181c32;font-weight:500; text-align:left;'><label style="margin-left:30px;">목표금액구간</label>
				<span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>설정한 목표 구간에 대한 금액을 %로 지급한다. 금액구간 기준으로 정렬됩니다. </span></span></span>
			 </div>
			 <div style='height:auto;'>
				 <table id="dataTable" class="fmont"  cellspacing="0" style="margin:30px 20px 30px 20px;border:1px solid #e7e7e7; width:1155px;height:auto;font-size:14px; color:#212529; text-align:center;font-weight:600;">
					 <thead>
						 <tr style="height:48px;background-color:#f5f6f8;" align="center">
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">구간</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">금액구간</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">퍼센트(%)</td>
							 <td style='width:70px;border:1px solid #e7e7e7;font-weight:500;'>간단설명</td>
							 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>버튼</td>
						 </tr>
					 </thead>
					 <tbody id = 'table_levelbody' align="center">                            

					 </tbody>
					 <tfoot id = "table_footer" align="center" style='background-color:#fffed2;text-align:center'>
						<tr height="60px" >
							<td style="border:1px solid #e7e7e7;">
                                <label id="foot_level" style="margin-top:5px"></label>
                            </td>
							<td style="border:1px solid #e7e7e7;">
                               
                                <input id='foot_price' type='text' onkeyup="inputChangeComma('foot_price')" style="font-size:14px;width:140px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;" placeholder="가격..." />
                                <text style="font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;">&nbsp;￦</text>
                            </td>
							<td style="border:1px solid #e7e7e7;">
                                <input id="foot_percent" type="number"  name="id_inputname" placeholder="퍼센트..." style="font-size:14px;width:100px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/>
                                <text style="font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;">&nbsp;%</text>
                            </td>
							<td  style="border:1px solid #e7e7e7;">
                                <input id = 'foot_note' type='text' value='' style="font-size:14px;width:296px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; padding-right:10px;" placeholder="설명..." />
                            </td>
							<td style="border:1px solid #e7e7e7;padding-left:20px;padding-right:20px">
								<button onclick='add_levelclass()' style='width:160px; height:40px; border-radius:5px; background-color:#f1416c;border:0px;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>구간추가</button>
							</td>                                

						</tr>
					</tfoot>
				 </table>

			</div>
			
		</div>
            <br><br>
        <div style='width:1198px;height:auto; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;'>
			 <div style='width:100%;height:44px;background-color:#f5f8fa; border-radius:10px 10px 0 0; border-bottom:1px solid #e4e6ef;'>
				<span style='float:left;padding-top: 10px;font-size: 15px; color:#181c32;font-weight:500; text-align:left;'><label style="margin-left:30px;">금액지급설정</label>
				<span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>금액을 지급하는 내용의 이름들을 삽입 ex)기본급 , 상여금 , 세일즈 수당, 공제금액, 조정금액 등등...</span></span></span>
			 </div>
			 <div style='height:auto;'>
                 <label style='margin-top:30px;margin-left:20px;'>(+)추가되는 금액</label>
				 <table id="mdataTable" class="fmont"  cellspacing="0" style="margin:5px 20px 30px 20px;border:1px solid #e7e7e7; width:1155px;height:auto;font-size:14px; color:#212529; text-align:center;font-weight:600;">
					 <thead>
						 <tr style="height:48px;background-color:#f5f6f8;" align="center">
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">번호</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">이름</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">금액</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">설명</td>
							 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>버튼</td>
						 </tr>
					 </thead>
					 <tbody id = 'mtable_namebody' align="center">                            

					 </tbody>
					 <tfoot id = "mtable_footer" align="center" style='background-color:#fffed2;text-align:center'>
						<tr height="60px" >
							<td style="border:1px solid #e7e7e7;">
                                <label id="mfoot_number" style="margin-top:5px"></label>
                            </td>
							<td style="border:1px solid #e7e7e7;">
                                <input id="mfoot_name" type="text"  placeholder="금액을 결정할 이름을 삽입..." style="font-size:14px;width:150px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/>
                                <text style="font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;"></text>
                            </td>
							<td style="border:1px solid #e7e7e7;">
                                <input id='mfoot_price' type='text' onkeyup="inputChangeComma('mfoot_price')" style="font-size:14px;width:200px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;" placeholder="기본가격을 설정..." />
                                <text style="font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;">&nbsp;￦</text>
                            </td>
                            <td  style="border:1px solid #e7e7e7;">
                                <input id = 'mfoot_note' type='text' value='' style="font-size:14px;width:296px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; padding-right:10px;" placeholder="설명..." />
                            </td>
							<td style="border:1px solid #e7e7e7;">
								<button onclick='add_priceclass()' style='width:160px; height:40px; border-radius:5px; background-color:#f1416c;border:0px;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>금액이름추가</button>
							</td>                                
						</tr>
					</tfoot>
				 </table>
                 
                 <label style='margin-top:0px;margin-left:20px;'>(-)차감되는 퍼센트</label>
                 <table id="precentPreceTable" class="fmont"  cellspacing="0" style="margin:5px 20px 30px 20px;border:1px solid #e7e7e7; width:1155px;height:auto;font-size:14px; color:#212529; text-align:center;font-weight:600;">
					 <thead>
						 <tr style="height:48px;background-color:#f5f6f8;" align="center">
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">번호</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">이름</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">퍼센트(%)</td>
							 <td style="width:70px;border:1px solid #e7e7e7;font-weight:500;">설명</td>
							 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>버튼</td>
						 </tr>
					 </thead>
					 <tbody id = 'ptable_namebody' align="center">                            

					 </tbody>
					 <tfoot id = "ptable_footer" align="center" style='background-color:#fffed2;text-align:center'>
						<tr height="60px" >
							<td style="border:1px solid #e7e7e7;">
                                <label id="pfoot_number" style="margin-top:5px"></label>
                            </td>
							<td style="border:1px solid #e7e7e7;">
                                <input id="pfoot_name" type="text"  placeholder="퍼센트 이름을 삽입..." style="font-size:14px;width:150px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/>
                                <text style="font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;"></text>
                            </td>
							<td style="border:1px solid #e7e7e7;">
                                <input id='pfoot_percent' type='text'  onkeyup="inputChangeFloat('pfoot_percent')" style="font-size:14px;width:200px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;" placeholder="퍼센트 설정..." />
                                <text style="font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;">&nbsp;%</text>
                            </td>
                            <td  style="border:1px solid #e7e7e7;">
                                <input id = 'pfoot_note' type='text' value='' style="font-size:14px;width:296px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; padding-right:10px;" placeholder="설명..." />
                            </td>
							<td style="border:1px solid #e7e7e7;">
								<button onclick='add_percentpriceclass()' style='width:160px; height:40px; border-radius:5px; background-color:#f1416c;border:0px;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>퍼센트이름추가</button>
							</td>                                
						</tr>
					</tfoot>
				 </table>
                 
			</div>
			
		</div>
        		
        <hr style="border: solid 1px #eff2f5;margin-top:25px;margin-left:-28px;margin-right:-28px;">
        <button onclick='update_setting()' class='btn btn-primary btn-raised' style='background-color:#33aaaa;float:right;margin:10px;cursor:pointer;'>설정정보 저장하기</button>
        <br><br>
		
	</div>
</div>
<script>
    var group = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    var centername = getData("nowcentername");
    
    
    var allsetting = null;
    var mlocker = null;
    var mreservationinfo = null;
    var msetting = null;
    var payrollvat = 0;
    console.log("d_setpayroll!!");
    //급여 테이블 Body
    var table_levelbody = document.getElementById("table_levelbody"); //페이롤 
    var mtable_namebody = document.getElementById("mtable_namebody"); //추가되는 금액
    var ptable_namebody = document.getElementById("ptable_namebody"); //차감되는 퍼센트
    
    function ttt(id){
        clog("ttt "+id);
    }
    function init_d_setpayroll(value){
		
		document.getElementById("id_setting_title").innerHTML = centername+"급여 목표금액 설정";
        var payrollvat_10 = document.getElementById("payrollvat_10");
        clog("mainii");
        getSettingData(function(res){
           if(res.code == 100){
                allsetting = res.message;
                var lockers =  allsetting.lockers;  
                var reservationinfos = allsetting.reservation_info;  
                clog("res.message ",allsetting);
                if(!allsetting.setting){
                    allsetting["setting"] = {};
                }
                msetting = allsetting.setting;
//                initGXPriceRule(); //gxpricerule 을 세팅한다.
                payrollvat = msetting.payrollvat ? parseInt(msetting.payrollvat) : 0;
                var payrollvattype = msetting.payrollvattype ? msetting.payrollvattype : "0";
                document.getElementById("payrollvat_"+payrollvattype).checked = "checked";
//                if(payrollvat == 0)document.getElementById("payrollvat_0").checked = "checked";
//                else {
//                    if(payrollvat_10)payrollvat_10.checked = "checked";
//                }
                updateTableLevelBody();
                updateTablePriceBody();
                updateTablePercentBody();

           }
       },function(err){
          clog("getSettingData error ",err);
       });
    }
    function update_setting(){
        updateSetTutorialStatus();
        
        showModalDialog(document.body,"설정 정보 변경", "설정 정보를 수정하시겠습니까?" , "수정하기", "취소",function(){
             settingAllUpdate();


        },function(){
            hideModalDialog();
            if(tutorial_status == TS._27_SETPAROLLPOPUP){
                console.log("_26_INSERTPAROLLDATA");
                setTutorialStatus(TS._26_INSERTPAROLLDATA);
            }

        });
        
        
    }
//    function insertGXPriceUSer(){
//        var time = id_selectalluserlen.value;
//        if(time)insertXImageButton(id_alluserlen_list,time,time+"시");
//        updateXImageButton();
//    }
//   

    function remove_levelclass(idx){
        var len = table_levelbody.children.length;
        for(var i = 0 ; i < table_levelbody.children.length; i++){
             if (i == idx) {
//                    table_body.removeChild(table_body.children[i]);
                    msetting.pricerule.splice(i,1);
                    break;
                }
        }
        
        
       updateTableLevelBody();
    }

     function updateTableLevelBody(){
       table_levelbody.innerHTML = "";
       
       if(msetting && msetting.pricerule){
           clog("msetting ",msetting.pricerule);
           var len = msetting.pricerule.length;
           var price_offset = 0;
           for(var i = 0 ; i < len;i++){
               var level = i+1;
               var rule = msetting.pricerule[i];
    //           clog("cls.next_starttime is "+cls.next_starttime);
               var btnhtml = "<img src='./img/button_delete_list.png' onclick='remove_levelclass("+i+")' style='cursor:pointer'/>";

               table_levelbody.innerHTML += 
                   "<tr height='60px'>"+
                       "<td style='border:1px solid #e7e7e7;'>"+
                            "<label id='pricerule_level_"+i+"'>"+level+"</label>"+
                       "</td>"+
                       "<td style='width:300px;border:1px solid #e7e7e7;'>"+
                            "<label id='txt_pricerule_price_"+i+"' style='margin-left:20px;margin-top:7px'>"+CommaString(price_offset)+" "+TXT_WON+"</label>&nbsp;~&nbsp;"+
                            "<input id='pricerule_price_"+i+"' type='text' value='"+CommaString(rule.price)+"' style='font-size:14px;width:121px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                           "<text style='font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;'>&nbsp;"+TXT_WON+"</text>"+
                       "</td>"+
                       "<td style='border:1px solid #e7e7e7;'>"+
                           "<input id='pricerule_percent_"+i+"' type='number' value='"+rule.percent+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                           "<text style='font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;'>&nbsp;%</text>"+
                       "</td>"+
                       "<td style='border:1px solid #e7e7e7;'>"+
                           "<text value='"+rule.note+"' style='font-size:14px; color:#495057;text-align:center;font-weight:500;'>"+rule.note+"</text>"+
                       "</td>"+
                        "<td style='border:1px solid #e7e7e7;'>"+
                            btnhtml+
                        "</td>"+
                   "</tr>";
               price_offset = parseInt(rule.price)+1;
           }
           var foot_level = document.getElementById("foot_level")
           if(foot_level)foot_level.innerHTML = "입력";
       }
       
    }
   function add_levelclass(){
        var foot_level = document.getElementById("foot_level");
        var foot_percent = document.getElementById("foot_percent").value;
        var foot_price = document.getElementById("foot_price").value;
        var foot_note = document.getElementById("foot_note").value;
        clog("foot_level "+foot_level+" foot_percent "+foot_percent+" foot_price "+foot_price+" foot_note "+foot_note);
        clog("")
        var len = table_levelbody.children.length;
        var flevel = len+1;
        foot_level.innerHTML = flevel+"";
        
        
        var rule = {"level":flevel,"percent":foot_percent,"price":parseCommaInt(foot_price)+"","note":foot_note};
        
        
        if(msetting && !msetting.pricerule)
            msetting["pricerule"] = [];
        
      
        
        
        
        if(foot_percent && foot_price && foot_note){
            if(parseInt(foot_percent) > 300){
                alert("300% 이상은  설정할 수 없습니다.");
                return;
            }
            
            msetting.pricerule.push(rule);
//            msetting.pricerule.sort(sort_by('price', false, (a) => a.toUpperCase()));
            msetting.pricerule = new_sort(msetting.pricerule,"price",true);
            updateTableLevelBody();
            clog("msetting ",msetting);
//            table_body.innerHTML += "<tr><td>"+foot_name+"</td><td><input type='number' value='"+foot_max+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_starttime+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_endtime+"' style='margin-top:5px'/></td><td style='width:170px'><button onclick='remove_class("+len+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button></td></tr>";    
        }else{
            alert("입력되지 않은 부분이 있습니다. ");
        }
        
    }
    
    function remove_priceclass(id){
        
        for(var i = 0 ; i < msetting.pricenamesetting.length; i++){
             var mtype = msetting.pricenamesetting[i].type && msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
             if (mtype == "price" && parseInt(msetting.pricenamesetting[i].id) == id) {
//                    table_body.removeChild(table_body.children[i]);
                    msetting.pricenamesetting.splice(i,1);
                    break;
                }
        }
        
        
       updateTablePriceBody();
    }
    function remove_percentclass(id){
      
        for(var i = 0 ; i < msetting.pricenamesetting.length; i++){
            var mtype = msetting.pricenamesetting[i].type && msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
             if (mtype == "percent" && parseInt(msetting.pricenamesetting[i].id) == id) {
//                    table_body.removeChild(table_body.children[i]);
                    msetting.pricenamesetting.splice(i,1);
                    break;
                }
        }
        
        
       updateTablePercentBody();
    }
    function updateTablePriceBody(){
       mtable_namebody.innerHTML = "";
         
       /////////////////////////////////////
       //기본으로 삽입되는 내용들 START
       /////////////////////////////////////
       
        
        
        var allrules = getAllRules("price");
        
       if(msetting && msetting.pricenamesetting && allrules.length > 0){
           clog("msetting ",msetting);
           
           var len = allrules.length;
           
           for(var i = 0 ; i < allrules.length;i++){
               
               var rule = allrules[i];
               
               if(i < 2){
                   mtable_namebody.innerHTML += getDefaultPriceTag(i,rule.name,"-",rule.note,rule.ison);
                    
               }else {
                   var number = i+1;
                   var id = rule.id;
                   var btnhtml = "<img src='./img/button_delete_list.png' onclick='remove_priceclass("+id+")' style='cursor:pointer'/>";

                   mtable_namebody.innerHTML += 
                       "<tr height='60px'>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<label id='mpricerule_number_"+i+"'>"+number+"</label>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<input id='mpricerule_name_"+i+"' type='text' value='"+rule.name+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                                "<text style='font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;'></text>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<input id='mpricerule_price_"+i+"' type='text' value='"+CommaString(rule.price)+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                                "<text style='font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;'>&nbsp;"+TXT_WON+"</text>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<text value='"+rule.note+"' style='font-size:14px; color:#495057;text-align:center;font-weigh t:500;'>"+rule.note+"</text>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                btnhtml+
                            "</td>"+
                        "</tr>";
               }
           }
          
       }else {
           
           msetting.pricenamesetting = initPriceNameSetting("price");
           msetting.pricenamesetting.push({"id":0, "type":"price", "name":"PT수당","price":0,"note":"PT금액수당 페이롤금액 자동계산됨","ison":"true"});
           msetting.pricenamesetting.push({"id":1, "type":"price", "name":"그룹수업수당","price":0,"note":"GX금액수당 강사별 자동계산됨","ison":"false"});
           
           var allrules = getAllRules("price");
           var len = allrules.length;
           
           /////////////////////////////////////
           //기본으로 삽입되는 내용들 END
           /////////////////////////////////////
           for(var i = 0 ; i < len;i++){               
               var rule = allrules[i];
               mtable_namebody.innerHTML += getDefaultPriceTag(i,rule.name,"-",rule.note,rule.ison);             
           }
               
       }
        
         var mfoot_number = document.getElementById("mfoot_number")
           if(mfoot_number)mfoot_number.innerHTML = "입력";
       
    }
    function initPriceNameSetting(type){
        var arr  = [];
        if(msetting.pricenamesetting){
            for(var i = 0 ; i < msetting.pricenamesetting.length;i++){
                if(!findRule(msetting.pricenamesetting[i].id,type)){
                    arr.push(msetting.pricenamesetting[i]);
                }
                    
            }
        }
        return arr;
    }
    function getAllRules(type){
        var arr_rule = [];
        for(var i = 0 ;i < msetting.pricenamesetting.length; i++){
            var mtype = msetting.pricenamesetting[i].type && msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
            if(mtype == type){
                arr_rule.push(msetting.pricenamesetting[i]);
                
            }
        }
        return arr_rule;
    }
    function findRule(id,type){
        var rule = null;
        for(var i = 0 ;i < msetting.pricenamesetting.length; i++){
            var mtype = msetting.pricenamesetting[i].type && msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
            if(mtype == type && msetting.pricenamesetting[i].id == id){
                rule = msetting.pricenamesetting[i];
                break;
            }
        }
        return rule;
    }
    function setRullIsOn(id,type,str_ison){
        var rule = null;
        for(var i = 0 ;i < msetting.pricenamesetting.length; i++){
            var mtype = msetting.pricenamesetting[i].type && msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
            if(mtype == type && msetting.pricenamesetting[i].id == id){
                msetting.pricenamesetting[i].ison = str_ison;
                break;
            }
        }
        
    }
    function updateTablePercentBody(){
       ptable_namebody.innerHTML = "";
         
       /////////////////////////////////////
       //기본으로 삽입되는 내용들 START
       /////////////////////////////////////
       
        var allrules = getAllRules("percent");
        console.log("allrules ",allrules);
       if(msetting && msetting.pricenamesetting && allrules.length > 0){
           clog("msetting ",msetting);
           
           var len = allrules.length;
           
           for(var i = 0 ; i < allrules.length;i++){
               
               var rule = allrules[i];
               
               if(i < 1){
                   ptable_namebody.innerHTML += getDefaultPercentTag(i,rule.name,3.3,rule.note,rule.ison);
                    
               }else {
                   var number = i+1;
                   var id = rule.id;
                   var btnhtml = "<img src='./img/button_delete_list.png' onclick='remove_percentclass("+id+")' style='cursor:pointer'/>";

                   ptable_namebody.innerHTML += 
                       "<tr height='60px'>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<label id='ppricerule_number_"+i+"'>"+number+"</label>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<input id='ppricerule_name_"+i+"' type='text' value='"+rule.name+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                                "<text style='font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;'></text>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<input id='ppricerule_percent_"+i+"' type='text' value='"+rule.percent+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                                "<text style='font-family: Gulim; font-size: 14px; color:#495057; font-weight:400;'>&nbsp;"+TXT_PERCENT+"</text>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                "<text value='"+rule.note+"' style='font-size:14px; color:#495057;text-align:center;font-weigh t:500;'>"+rule.note+"</text>"+
                            "</td>"+
                            "<td style='border:1px solid #e7e7e7;'>"+
                                btnhtml+
                            "</td>"+
                        "</tr>";
               }
           }
           
       }else {
           
           msetting.pricenamesetting = initPriceNameSetting("percent");       
           msetting.pricenamesetting.push({"id":0, "type":"percent", "name":"원천징수(3.3%)","percent":3.3,"note":"원천징수금액 차감","ison":"true"});
           
           var allrules = getAllRules("percent");
           var len = allrules.length;
           /////////////////////////////////////
           //기본으로 삽입되는 내용들 END
           /////////////////////////////////////
           for(var i = 0 ; i < len;i++){               
               var rule = allrules[i];
               ptable_namebody.innerHTML += getDefaultPercentTag(i,rule.name,3.3,rule.note,rule.ison);             
           }
               
       }
        
        var pfoot_number = document.getElementById("pfoot_number")
        if(pfoot_number)pfoot_number.innerHTML = "입력";
       
    }
    function getDefaultPriceTag(i,name,value,note,ison){
       
        var checked = ison == "true" ? "checked" : "";
        var txt_onoff = ison == "true"  ?  "&nbsp;사용" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;안함";
        console.log("txt_onoff "+txt_onoff);
        
        var setting_tag = i == 1 ? "<i class='fa-solid fa-gear fa-spin fa-fw' style='position:absolute;font-size:20px;float:right;margin-left:50px;margin-top:10px;margin-right:10px;cursor:pointer' onclick='showGXPricePopup()' title='GX금액수당 강사별 자동계산방식 설정하기'></i>" : "";
        var tag = 
           "<tr height='60px'>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<label id='mpricerule_number_"+i+"'>"+(i+1)+"</label>"+
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<input id='mpricerule_name_"+i+"' type='text' value='"+name+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+                   
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<input id='mpricerule_price_"+i+"' type='text' value='"+value+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<text style='font-size:14px; color:#495057;text-align:center;font-weigh t:500;'>"+note+"</text>"+
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
            
                    "<label class='switch' style='margin-top:10px;zoom:0.8'>"+
                        "<input id='togglepricename_"+i+"' type='checkbox' onchange='togglenamesettingchange( \"togglepricename\","+i+", \"price\")' "+checked+">"+
                        "<span id='togglepricename_span_"+i+"' class='slider round'>"+
                            "<text class='fmont' id='togglepricename_txt_"+i+"' style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:white'>"+txt_onoff+"</text>"+
                        "</span>"+
                    "</label>"+
                    setting_tag+
                "</td>"+
            "</tr>";    
        return tag;
    }
    function getDefaultPercentTag(i,name,value,note,ison){
       
        var checked = ison == "true" ? "checked" : "";
        var txt_onoff = ison == "true"  ?  "&nbsp;사용" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;안함";
        console.log("txt_onoff "+txt_onoff);
        
       
        var tag = 
           "<tr height='60px'>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<label id='ppricerule_number_"+i+"'>"+(i+1)+"</label>"+
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<input id='ppricerule_name_"+i+"' type='text' value='"+name+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+                   
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<input id='mpricerule_price_"+i+"' type='text' value='"+value+"' style='font-size:14px;width:131px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;' disabled/>"+
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
                    "<text style='font-size:14px; color:#495057;text-align:center;font-weigh t:500;'>"+note+"</text>"+
                "</td>"+
                "<td style='border:1px solid #e7e7e7;'>"+
            
                    "<label class='switch' style='margin-top:10px;zoom:0.8'>"+
                        "<input id='ptogglepricename_"+i+"' type='checkbox' onchange='togglenamesettingchange(\"ptogglepricename\","+i+", \"percent\")' "+checked+">"+
                        "<span id='ptogglepricename_span_"+i+"' class='slider round'>"+
                            "<text class='fmont' id='ptogglepricename_txt_"+i+"' style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:white'>"+txt_onoff+"</text>"+
                        "</span>"+
                    "</label>"+
                    
                "</td>"+
            "</tr>";    
        return tag;
    }
    function togglenamesettingchange(key,idx,type){ //type : price , percent
        var ptoggle = document.getElementById(key+"_"+idx);
        var ptoggle_icon = document.getElementById(key+"_span_"+idx);
        var ptoggle_txt = document.getElementById(key+"_txt_"+idx);
               
        if(ptoggle.checked){
            ptoggle_txt.innerHTML = "&nbsp;사용";
            ptoggle_txt.style.color = "white";
            ptoggle_icon.style.backgroundColor = "#2194f3";

            setRullIsOn(idx,type,"true");
            
            
            if(type == "price" && idx == 1){
                showGXPricePopup();
            }
            
        }else{
            ptoggle_txt.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;안함";
            ptoggle_txt.style.color = "white";
            ptoggle_icon.style.backgroundColor = "#cccccc";
            
            setRullIsOn(idx,type,"false");
            
            
        }
    }
    
    
    
    function setGXPriceRuleDatas(none){
        //msetting.pricenamesetting[i].gxpricerule = {"pricetype":0,"lesson":0,"user":[],"noshow":0,"nobody":0,"other":0};
        
        
        var inputid_pricetype_lesson = document.getElementById("inputid_pricetype_lesson");
        var inputid_noshow = document.getElementById("inputid_noshow");
        var inputid_nobody = document.getElementById("inputid_nobody");
        var inputid_other = document.getElementById("inputid_other");
        for(var i = 0 ; i < msetting.pricenamesetting.length; i++){
            var mid = msetting.pricenamesetting[i].id;
            var mtype = msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
            if(parseInt(mid) == 1 && mtype == "price"){
                if(!msetting.pricenamesetting[i].gxpricerule)msetting.pricenamesetting[i].gxpricerule = {};
                msetting.pricenamesetting[i].gxpricerule.lesson = parseCommaInt(inputid_pricetype_lesson.value);
                msetting.pricenamesetting[i].gxpricerule.noshow = parseCommaInt(inputid_noshow.value);
                msetting.pricenamesetting[i].gxpricerule.nobody = parseCommaInt(inputid_nobody.value);
                msetting.pricenamesetting[i].gxpricerule.other = parseCommaInt(inputid_other.value);

                msetting.pricenamesetting[i].gxpricerule.user = [];
                msetting.pricenamesetting[i].gxpricerule.pricetype = global_gxpricetype;
                var usertype_1 = document.getElementById("usertype_1");
                msetting.pricenamesetting[i].gxpricerule.usertype = usertype_0 && usertype_1.checked ? 1 : 0; // 0 : 강좌별 , 1: 수강인원별
                for(var j = 1 ; j < 10 ; j++){
                    var gx_priceid = document.getElementById("gx_priceid_"+j);
                    if(gx_priceid)msetting.pricenamesetting[i].gxpricerule.user.push({"len":j,"price":parseCommaInt(gx_priceid.value)});
                }
            }
            
        }
        console.log("msetting.pricenamesetting[i].gxpricerule ",msetting.pricenamesetting[i].gxpricerule);
      
    }
    
    function removeUserLenData(id) {
//        for (var i = 0; i < parent.children.length; i++) {
//            if (parent.children[i].id == id) {
//                parent.removeChild(parent.children[i]);
//                break;
//            }
//        }
        var userdiv = document.getElementById(id);
        userdiv.parentNode.removeChild(userdiv);
        updateSettingTime();
    }
     
    function updateSettingTime() {
         var defaulttimes = [1,2,3,4,5,6,7,8,9,10,15,20,25,30,35,40,45,50];

         id_selectalluserlen.innerHTML = "<option>인원 추가하기</option>";

         var times = [];
         for (var i = 0; i < id_alluserlen_list.children.length; i++)
             if (id_alluserlen_list.children[i].id) times.push(parseInt(id_alluserlen_list.children[i].id));

         var difference = defaulttimes.filter(x => !times.includes(x));
         for (var i = 0; i < difference.length; i++){
             id_selectalluserlen.innerHTML += "<option value='" + difference[i] + "'>수강인원 " + difference[i] + "명까지</option>";
         }
             


         sortListIntType(id_alluserlen_list, false);

         var times = [];
         for (var i = 0; i < id_alluserlen_list.children.length; i++) {
             times.push(parseInt(id_alluserlen_list.children[i].id));
         }
         //mreservationinfo.opentimes = times;

     }
    
    
    function add_priceclass(){
        var mfoot_number = document.getElementById("mfoot_number");
        var foot_name = document.getElementById("mfoot_name").value;
        var foot_price = document.getElementById("mfoot_price").value;
        var foot_note = document.getElementById("mfoot_note").value;
        
        clog("foot_number "+mfoot_number+" foot_name "+foot_name+" foot_price "+foot_price);
        
        var len = mtable_namebody.children.length;
        var num = len;
        mfoot_number.innerHTML = num+"";
        
        
        var rule = {"id":num,"type":"price","name":foot_name,"price":parseCommaInt(foot_price),"note":foot_note,"ison":"true"};
        
        
        if(msetting && !msetting.pricenamesetting)
            msetting["pricenamesetting"] = [];
        
        
        if(foot_name){           
            msetting.pricenamesetting.push(rule);
            updateTablePriceBody();
        }else{
            alert("이름을 입력해 주세요");
        }
        
    }

    
    
    
    function add_percentpriceclass(){
        var mfoot_number = document.getElementById("pfoot_number");
        var foot_name = document.getElementById("pfoot_name").value;
        var foot_percent = document.getElementById("pfoot_percent").value;
        var foot_note = document.getElementById("pfoot_note").value;
        
        clog("foot_number "+mfoot_number+" foot_name "+foot_name+" foot_percent "+foot_percent);
        
        
        var len = ptable_namebody.children.length;
        var num = len;
        mfoot_number.innerHTML = num+"";
        
        
        var rule = {"id":num,"type":"percent","name":foot_name,"percent":foot_percent,"note":foot_note,"ison":"true"};
        
        
        if(msetting && !msetting.pricenamesetting)
            msetting["pricenamesetting"] = [];
        
        
        if(foot_name){    
            msetting.pricenamesetting.push(rule);
            updateTablePercentBody();
            
        }else{
            alert("이름을 입력해 주세요");
        }
        
    }
//    function initGXPriceRule(){
//        for(var i = 0 ; i < msetting.pricenamesetting.length; i++){
//            var nid = parseInt(msetting.pricenamesetting[i].id);
//            var ntype = msetting.pricenamesetting[i].type && msetting.pricenamesetting[i].type == "percent" ? "percent" : "price";
//            //그룹수업수당
//            if(nid == 1 && ntype == "price" && !msetting.pricenamesetting[i].gxpricerule){
//                msetting.pricenamesetting[i].gxpricerule = {
//                                                    "pricetype": "0",
//                                                    "lesson": "0",
//                                                    "usertype": "0",
//                                                    "noshow": "0",
//                                                    "nobody": "0",
//                                                    "other": "0",
//                                                    "gxpricetype": "0"
//                                                }
//                break;
//            }
//                
//        }
//        
//    }
    function settingAllUpdate(){
    
       
        var value = {};
        
        
        msetting.payrollvattype = document.querySelector('input[name="payrollvat"]:checked').value;
        msetting.payrollvat = parseInt(msetting.payrollvattype) == 0 ? 0 : 10;
        
        value.setting = msetting;
       
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");
        
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"setcentersetting",
            value:value
        };
        
        CallHandler("adm_get", senddata, function (res) {
//            clog("setsettingres is ",res);
           if(res.code == 100){
//               console.log("value.setting ",msetting.pricerule);
               
               if(tutorial_status < TS.FINISH && tutorial_status == TS._27_SETPAROLLPOPUP){
                   
                    if(msetting.pricerule && msetting.pricerule.length > 0 ){
                        updateSetTutorialStatus();
                    }                        
                    else {
                        setTutorialStatus(TS._26_INSERTPAROLLDATA);
                    }
               }
               
               C_showToast( "설정완료!", "성공적으로 설정하였습니다.", function() {});
           }else{
               C_showToast( "설정불가!", ""+res.message, function() {});
           }
           hideModalDialog();
        }, function (err) { 
            C_showToast( "설정불가!", ""+res.message, function() {});
            hideModalDialog();
        });
        
    }
</script>