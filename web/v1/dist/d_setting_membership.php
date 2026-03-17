<div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div id= "reservation_center" class="reservation_center" style='padding:5px'>
            <text id='tb_title' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >회원권 설정</text>
			<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;"><br>
			<ul id="mtab" class="nav nav-tabs" style='height:auto'>
			  <li class="nav-item">
				<a href="#aaa"  class="nav-link active" data-toggle="tab" onclick="tab_click(1)">헬스 회원권</a>
			  </li>
			  <li class="nav-item">
				<a href="#bbb"  class="nav-link" data-toggle="tab"  onclick="tab_click(2)">P.T 회원권</a>
			  </li>
              <li class="nav-item">
				<a href="#ccc"  class="nav-link" data-toggle="tab"  onclick="tab_click(3)">그룹(GX) 회원권</a>
			  </li>
              <li class="nav-item">
				<a href="#ddd"  class="nav-link" data-toggle="tab"  onclick="tab_click(4)">기타 상품</a>
			  </li>
              
			</ul>
			<div class="tab-content" id="tabs">
				<div class="tab-pane" id="aaa"></div>
				<div class="tab-pane" id="bbb"></div>   
                <div class="tab-pane" id="ccc"></div>   
                <div class="tab-pane" id="ddd"></div>   
			</div>
			<br>
	
				
				
				
				 <div id = "all_classes" style ="height:auto">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;color:#3f4254; text-align:center; font-weight:500;"></table>
				 </div>
				<br>
				<p align="right"><button id='btn_add_basecoupon'   onclick='insert_membership();' class='btn' style='width:160px; height:35px; border-radius:5px; background-color:#009ef7;font-size:14px; color:#ffffff; text-align:center;font-weight: 700;border:0px;outline:none'>회원권 추가하기</button></p>
		
	</div>
</div>
<script>
	var istype = "termtype";
//    clog("gettype ",getData("setmembershiptype"));
    if(getData("setmembershiptype") == "counttype")activaTab('bbb');
    if(getData("setmembershiptype") == "gxtype")activaTab('ccc');
    if(getData("setmembershiptype") == "othertype")activaTab('ddd');
    
    var group = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    var centername = getData("nowcentername");
    
    
    
    function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    };
    function init_d_setting_membership(value){
       
        getSettingMembershipDatas(function(res){
           if(res.code == 100){
                allmembership = res.message;
               
               document.getElementById("tb_title").innerHTML = centername+" 회원권 설정";
//                clog("회원권수정");
    
               istype = getSettingMembershipType();
               insertSettingMembershipTable(allmembership,istype);
           }
       },function(err){
          clog("getSettingData error ",err);
       });
			

         
    }
    function checkfree_text(idx){
            console.log("checkfree_text !! ");
            var mname = document.getElementById("mname_"+idx);
            var radio_paid = document.getElementById("mpaid_"+idx);
            var radio_free = document.getElementById("mfree_"+idx);
            
            if(mname.value.indexOf(ID_FREE) >= 0){
                radio_free.checked = "checked";
            }else{
                radio_paid.checked = "checked";
            }
        }
    function insertSettingMembershipTable(rows,istype) {
        
//         var id_membership_setting_title = document.getElementById("id_membership_setting_title");
//        if(id_membership_setting_title)id_membership_setting_title.innerHTML = istype == "termtype" ? title_icon+getData("nowcentername")+"회원권 설정" : title_icon+getData("nowcentername")+" P.T 회원권 설정";
//        var id_membership_setting2_title = document.getElementById("id_membership_setting2_title");
//        id_membership_setting2_title.innerHTML = title_icon+getData("nowcentername")+"P.T 회원권 설정";
       
//        clog("aaa",rows);
//            document.getElementById("table_div").style.display = "block";
        
        var membership_type = getSettingMembershipType();
        var btn_add_basecoupon = document.getElementById("btn_add_basecoupon");
        btn_add_basecoupon.innerHTML = membership_type == "othertype" ? "기타상품 추가하기" : "회원권 추가하기";
        
        var table = document.getElementById('dataTable');
        table.innerHTML = "";
        table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>번호</th><th>회원권타입</th><th>회원권제목</th><th>회원권부가세</th><th>회원권개월수</th><th>최대홀딩일수</th><th>시작시간변경회수</th><th>PT/GX회수</th><th>가격</th><th>수정</th><th>삭제</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;

        
        if (len > 0) {
//            for(var j = 0 ; j < 100 ; j++)//test
            var index = 1;
            for (var i = 0; i < len; i++) {
                if(istype == "termtype" && rows[i]["mbs_type"] == TYPE_TERM || istype == "gxtype" && rows[i]["mbs_type"] == TYPE_GX || istype == "counttype" && rows[i]["mbs_type"] == TYPE_PT  || istype == "othertype" && rows[i]["mbs_type"] == TYPE_OTHER ){
                    var brow = body.insertRow();
                
                    var bcell_index = brow.insertCell();
                   // bcell_index.innerHTML = rows[i]["mbs_idx"];
                     bcell_index.innerHTML = index;

                    var bcell_type = brow.insertCell();
                    bcell_type.innerHTML = rows[i]["mbs_type"];

                    var bcell_name = brow.insertCell();
                    bcell_name.innerHTML = rows[i]["mbs_name"];

//                    var bcell_desc = brow.insertCell();
//                    bcell_desc.innerHTML = rows[i]["mbs_desc"];

                    var bcell_vat = brow.insertCell();
                    bcell_vat.innerHTML = rows[i]["mbs_vat"]+" %";


                    var bcell_month = brow.insertCell();
                    bcell_month.innerHTML = rows[i]["mbs_month"]+" 개월";

                    var bcell_maxholdingday = brow.insertCell();
                    bcell_maxholdingday.innerHTML = rows[i]["mbs_max_holdingday"]+" 일";


                    var bcell_maxchangestarttime = brow.insertCell();
                    bcell_maxchangestarttime.innerHTML = rows[i]["mbs_max_change_starttime"]+" 번";

                    var bcell_maxcount = brow.insertCell();
                    bcell_maxcount.innerHTML = rows[i]["mbs_max_count"]+" 회";

                    var bcell_price = brow.insertCell();
                    bcell_price.innerHTML = ""+TXT_WON+CommaString(rows[i]["mbs_price"]);

                    
                    var bcell_editbtn = brow.insertCell();
                    bcell_editbtn.innerHTML = "<button onclick='setting_membership_button_edit("+i+")' class='btn' style='width:60px; height:35px; border-radius:5px; background-color:#009ef7;font-size:14px; color:#ffffff; text-align:center;font-weight: 700;border:0px;outline:none'>수정</button>";

                    var bcell_deletebtn = brow.insertCell();
                    bcell_deletebtn.innerHTML = "<button onclick='setting_membership_button_delete("+i+")' class='btn'  style='width:60px; height:35px; border-radius:5px; background-color:#f1416c;font-size:14px; color:#ffffff; text-align:center;font-weight: 700;border:0px;outline:none'>삭제</button>";
                    
                    index++;
                }
            }
        }
       
        $('#dataTable').DataTable();
    }
    function getMembershipType(idx){
        var tag = "";
        var membership_type = getSettingMembershipType();
        if(membership_type == "termtype"){
            tag = 
                        "<select id='mtype_"+idx+"'  style='border:0px;background-color:#e2e2e2;'  onchange='mbstype_change("+idx+")' class='form-control' name='mbs_type' required>"+
                            "<option value='헬스'>헬스</option>"+                
                        "</select>";
        }else if(membership_type == "gxtype"){
            tag = 
                        "<select id='mtype_"+idx+"'  style='border:0px;background-color:#e2e2e2;'  onchange='mbstype_change("+idx+")' class='form-control' name='mbs_type' required>"+
                            "<option value='"+TYPE_GX+"'>"+TYPE_GX+"(GX)</option>"+
                        "</select>";
        }else if(membership_type == "pttype"){
            tag = 
                "<select  style='border:0px;background-color:#e2e2e2;width:220px'  id='mtype_"+idx+"' class='form-control' name='mbs_type' required>"+
                    "<option value='PT'>PT</option>"+
                "</select>";
        }
        else{
            tag = 
                "<select  style='border:0px;background-color:#e2e2e2;'  id='mtype_"+idx+"' class='form-control' name='mbs_type' required>"+
                    "<option value='"+TYPE_OTHER+"'>기타</option>"+
                "</select>";
        }
        return tag;
    }
    function mbstype_change(idx){
//        clog("mbstype_change!!" ,idx);
        var mtype = document.getElementById("mtype_"+idx).value;
        
        //기타
        if(mtype == "Other"){
            document.getElementById("mtype_other_"+idx).style.display = "block";
        }else 
            document.getElementById("mtype_other_"+idx).style.display = "none";
    }
    function insert_membership_freechecck(idx){
       var isfree = document.getElementById("mfree_"+idx).checked ? true : false; //무료에 체크했다면
       var input_price = document.getElementById("mprice_"+idx);
       var input_name = document.getElementById("mname_"+idx);
//       var input_desc = document.getElementById("mdesc_"+idx);
       if(isfree){
           
           input_name.value = input_name.value.indexOf(ID_FREE) >= 0 ? input_name.value : input_name.value+" "+ID_FREE;
//           input_desc.value = input_desc.value.indexOf(ID_FREE) >= 0 ? input_desc.value : input_desc.value+" "+ID_FREE;
           input_price.value = "0";
           input_price.disabled = true;
		   input_price.style.backgroundColor = "#cccccc";
       }else{
           input_name.value = input_name.value.indexOf(ID_FREE) >= 0 ? input_name.value.replace(ID_FREE, "") : input_name.value;
//           input_desc.value = input_desc.value.indexOf(ID_FREE) >= 0 ? input_desc.value.replace(ID_FREE, "") : input_desc.value;
           input_price.value = "";
           input_price.disabled = false;
		   input_price.style.backgroundColor = "#f5f8fa";
       }
       
    }
    function insert_membership(){
        var idx = 100000;
        var f_title = "";
        
        //별도부가세 설정 태그
//        var coupon_vat_tag = "<input type='number' class='form-control' id='mvat_"+idx+"' placeholder='ex)0% ~ 99% ' value='"+global_vat+"'>";
         var membership_type = getSettingMembershipType();
       
        setTutorialStatus(TS._5_COUPON_SHOWPOPUP);
        //기간제 헬스 이용권
        if(membership_type == "termtype"){
			f_title = "GX 회원권 ";
            var iscounttype_tag = "<select id='miscounttype_"+idx+"' class='form-control' style='border:0px;background-color:#e2e2e2'  name='gender' required><option value='0'>기간제</option></select>";        
		
            
            var mbstype_tag = "<input type='text' class='form-control' id='mtype_other_"+idx+"' placeholder='ex)기타 = 이벤트, 신년이벤트 등등.. ' style='display:none'>";

            
            
            
            var main = 
				"<div id=formdiv align='left' style='width:100%;height:580px;margin-left:5px;font-size:15px; color:#181c32; text-align:left; font-weight:500;'>"+
			
				//기간제/횟수제 
                "<label for='gender'>기간제(헬스 이용권 등등)"+qTip("설명: [기간제] ex)헬스1개월권~1년권 등 날짜기준,  [횟수제] ex)PT10회, GX30회 등..")+"</label>"+
                	iscounttype_tag+"<br>"+
                //*회원권 타입
			    "<label for='mtype'>*회원권 타입"+qTip("설명: 관리자가 구분하기 편하도록 해당 회원권 타입을 선택한다.")+"</label>"+
                	getMembershipType(idx)+
                    mbstype_tag+
			
                
				//회원권 부가세 재설정
//                "<br><label for='gender'>부가세 별도설정"+qTip("설명: 해당 회원권만 별도로 부가세를 다르게 설정할 수 있습니다.")+"</label>"+
//                	coupon_vat_tag+"<br>"+
                

				
				//*회원권 제목 , *유료 무료 설정 
			    "<br><label for='mname' style='position:absolute;margin-left:3px'>*회원권 제목"+qTip("설명: 해당 회원권를 구분할수 있는 제목을 설정한다.")+"</label>"+
				"<label for='mtype' style='position:absolute;margin-left:240px'>*유료 무료 설정"+qTip("설명: 해당 회원권이 무료이면 반드시 무료로 체크하세요",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mname_"+idx+"' onkeyup='checkfree_text("+idx+")'   name='mstart' placeholder='ex)헬스 3개월권...' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<div class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' >" +
							"<input id='mpaid_"+idx+"' type='radio' onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='n' style='margin-top:10px' checked>&nbsp;유료&nbsp;&nbsp;<input id='mfree_"+idx+"'' type='radio'  onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='y'>&nbsp;무료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>"+ 
						"</div>" +
					"</span>"+
					
				"</div><br><br>"+
				
								
				//회원권 설명  , *회원권 개월수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>회원권 설명"+qTip("설명: 해당 회원권에 대한 자세한 내용을 삽입한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*회원권 개월수"+qTip("설명: 회원권을 사용할 수 있는 개월수를 입력한다. ex) 3 = 3개월",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'   class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'  id='mdesc_"+idx+"' name='mdesc' placeholder='ex)3개월동안 헬스장 이용상품..' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='number'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mmonth_"+idx+"' name='mmonth' placeholder='ex)헬스장 개월수 (숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+
				
				
									
				//*회원권 운동회수  , *최대 회원권 홀딩일수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*회원권 운동회수"+qTip("설명: 헬스장 회원권 일때는 : 0 , 그밖의 그룹운동일때는 운동회수를 입력한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*최대 회원권 홀딩일수"+qTip("설명: 운동중에 부득이한 사정이 있을때를 대비해 운동을 잠시 홀딩할 수있는 최대 일수를 삽입한다.",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input type='number'    class='form-control'  style='border:0px;background-color:#e2e2e2;width:220px' id='mcount_"+idx+"' name='mcount' placeholder='ex)운동횟수 (숫자로 입력)' value='0' disabled required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='number'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mholding_"+idx+"' name='mholding' placeholder='ex)최대홀딩일수 30일..(숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+
				
				
									
				//*시작날짜 변경할 수 있는 회수  , *회원권 가격
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*시작날짜 변경할 수 있는 회수"+qTip("설명: 회원권 시작전에 시작날짜를 입력한 횟수만큼 변경할 수 있다. ex)1 = 1번만 변경가능")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*회원권 가격"+qTip("설명: 해당회원권의 가격을 설정한다. ",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input type='number'    class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'id='mstart_"+idx+"' name='mstart' placeholder='ex)시작일 변경할 수 있는 횟수..(숫자로 입력)' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mprice_"+idx+"' onfocus='this.select()' onkeyup='inputChangeComma(\"mprice_"+idx+"\")'  name='mprice' placeholder='ex)100000 (숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+

            "</div>";
        }
        else if(membership_type == "gxtype"){
			f_title = "일반 회원권 ";
            var iscounttype_tag = "<select id='miscounttype_"+idx+"' class='form-control' style='border:0px;background-color:#e2e2e2'  name='gender' required><option value='0'>기간제</option></select>";        
		
       
            var mbstype_tag = "<input type='text' class='form-control' id='mtype_other_"+idx+"' placeholder='ex)기타 = 이벤트, 신년이벤트 등등.. ' style='display:none'>";

            var main = 
				"<div id=formdiv align='left' style='width:100%;height:580px;margin-left:5px;font-size:15px; color:#181c32; text-align:left; font-weight:500;'>"+
			
				//기간제/횟수제 
                "<label for='gender'>기간제(헬스 이용권 등등)"+qTip("설명: [기간제] ex)헬스1개월권~1년권 등 날짜기준,  [횟수제] ex)PT10회, GX30회 등..")+"</label>"+
                	iscounttype_tag+"<br>"+
			   "<label for='mtype'>*회원권 타입"+qTip("설명: 관리자가 구분하기 편하도록 해당 회원권 타입을 선택한다.")+"</label>"+
                	getMembershipType(idx)+
                    mbstype_tag+
			

                //회원권 부가세 재설정
//                "<br><label for='gender'>부가세 별도설정"+qTip("설명: 해당 회원권만 별도로 부가세를 다르게 설정할 수 있습니다.")+"</label>"+
//                	coupon_vat_tag+"<br>"+
                
				
				//*회원권 제목 , *유료 무료 설정 
			    "<br><label for='mname' style='position:absolute;margin-left:3px'>*회원권 제목"+qTip("설명: 해당 회원권를 구분할수 있는 제목을 설정한다.")+"</label>"+
				"<label for='mtype' style='position:absolute;margin-left:240px'>*유료 무료 설정"+qTip("설명: 해당 회원권이 무료이면 반드시 무료로 체크하세요",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mname_"+idx+"'  onkeyup='checkfree_text("+idx+")'    name='mstart' placeholder='ex)GX 3개월권...' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<div class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' >" +
							"<input id='mpaid_"+idx+"' type='radio' onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='n' style='margin-top:10px' checked>&nbsp;유료&nbsp;&nbsp;<input id='mfree_"+idx+"'' type='radio'  onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='y'>&nbsp;무료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>"+ 
						"</div>" +
					"</span>"+
					
				"</div><br><br>"+
				
								
				//회원권 설명  , *회원권 개월수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>회원권 설명"+qTip("설명: 해당 회원권에 대한 자세한 내용을 삽입한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*회원권 개월수"+qTip("설명: 회원권을 사용할 수 있는 개월수를 입력한다. ex) 3 = 3개월",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'   class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'  id='mdesc_"+idx+"' name='mdesc' placeholder='ex)3개월동안 헬스장 이용상품..' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='number'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mmonth_"+idx+"' name='mmonth' placeholder='ex)헬스장 개월수 (숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+
				
				
									
				//*회원권 운동회수  , *최대 회원권 홀딩일수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*회원권 운동회수"+qTip("설명: 헬스장 회원권 일때는 : 0 , 그밖의 그룹운동일때는 운동회수를 입력한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*최대 회원권 홀딩일수"+qTip("설명: 운동중에 부득이한 사정이 있을때를 대비해 운동을 잠시 홀딩할 수있는 최대 일수를 삽입한다.",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input type='number'    class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' id='mcount_"+idx+"' name='mcount' placeholder='ex)운동횟수 (숫자로 입력)' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='number'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mholding_"+idx+"' name='mholding' placeholder='ex)최대홀딩일수 30일..(숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+
				
				
									
				//*시작날짜 변경할 수 있는 회수  , *회원권 가격
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*시작날짜 변경할 수 있는 회수"+qTip("설명: 회원권 시작전에 시작날짜를 입력한 횟수만큼 변경할 수 있다. ex)1 = 1번만 변경가능")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*회원권 가격"+qTip("설명: 해당회원권의 가격을 설정한다. ",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input type='number'    class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'id='mstart_"+idx+"' name='mstart' placeholder='ex)시작일 변경할 수 있는 횟수..(숫자로 입력)' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mprice_"+idx+"' onfocus='this.select()' onkeyup='inputChangeComma(\"mprice_"+idx+"\")'  name='mprice' placeholder='ex)100000 (숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+

            "</div>";
        }
        //횟수제 PT, GX
        else if(membership_type == "pttype"){
			f_title = "PT 회원권";
            var iscounttype_tag = "<select id='miscounttype_"+idx+"' style='border:0px;background-color:#e2e2e2'  class='form-control' name='gender' required><option value='1'>횟수제</option></select>";        

            var main = 
				"<div id=formdiv align='left' style='width:100%;height:430px;margin-left:5px;font-size:15px; color:#181c32; text-align:left; font-weight:500;'>"+
			
				//기간제/횟수제 
                "<label for='gender'>횟수제(PT)"+qTip("설명: PT로 고정됨.")+"</label>"+
                	iscounttype_tag+"<br>"+
				
                //회원권 부가세 재설정
//                "<br><label for='gender'>부가세 별도설정"+qTip("설명: 해당 회원권만 별도로 부가세를 다르게 설정할 수 있습니다.")+"</label>"+
//                	coupon_vat_tag+"<br>"+
                
					
				//*횟수제 타입 , *유료 무료 설정 
			    "<br><label for='mname' style='position:absolute;margin-left:3px'>*횟수제 타입"+qTip("설명: 해당 회원권를 구분할수 있는 제목을 설정한다.")+"</label>"+
				"<label for='mtype' style='position:absolute;margin-left:240px'>*유료 무료 설정"+qTip("설명: 해당 회원권이 무료이면 반드시 무료로 체크하세요",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						getMembershipType(idx)+
					"</span>"+
					"<span style='float:right'>"+
						"<div class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' >" +
							"<input id='mpaid_"+idx+"' type='radio' onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='n' style='margin-top:10px' checked>&nbsp;유료&nbsp;&nbsp;<input id='mfree_"+idx+"'' type='radio'  onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='y'>&nbsp;무료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>"+ 
						"</div>" +
					"</span>"+
					
				"</div><br><br>"+
				
									
				//*횟수제 제목  , 횟수제 설명
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*횟수제 제목"+qTip("설명: 횟수제 이용권을 구분할수 있는 제목을 설정한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>횟수제 설명"+qTip("명: 해당 횟수제 이용권에 대한 자세한 내용을 삽입한다.",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'   class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' id='mname_"+idx+"'  onkeyup='checkfree_text("+idx+")'  name='mname' placeholder='ex)PT 10회 이용권...' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mdesc_"+idx+"' name='mdesc' placeholder='ex)PT 10회 이용상품..' required>"+
					"</span>"+
				"</div><br><br>"+
				
				
				//*PT 운동회수  , *PT 가격
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*PT 운동회수"+qTip("설명:  PT 운동회수를 입력한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*PT 가격"+qTip("설명: 부가세를 제외한 해당회원권의 가격을 설정한다.",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='number'  class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'id='mcount_"+idx+"' name='mcount' placeholder='ex)PT횟수 (숫자로 입력)'  required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mprice_"+idx+"' onfocus='this.select()' onkeyup='inputChangeComma(\"mprice_"+idx+"\")'  name='mprice' placeholder='ex)100000 (숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+
			"</div>";
				
        }
        //기타상품등록
        else{
			f_title = "기타상품 ";
            var iscounttype_tag = "<select id='miscounttype_"+idx+"' class='form-control' style='border:0px;background-color:#e2e2e2'  name='gender' required><option value='2'>기타상품</option></select>";        
		    var mbstype_tag = "<input type='text' class='form-control' id='mtype_other_"+idx+"' placeholder='ex)기타 = 운동복, 수건 등등.. ' style='display:none'>";
            var main = 
				"<div id=formdiv align='left' style='width:100%;height:580px;margin-left:5px;font-size:15px; color:#181c32; text-align:left; font-weight:500;'>"+
			
				//기타상품
                "<label for='gender'>기타상품(운동복,수건 등등)"+qTip("설명: [기타상품] ex)기타 운동복 ,수건 등 기타 다른상품을 입력한다.")+"</label>"+
                	iscounttype_tag+"<br>"+
			   "<label for='mtype'>*기타상품 타입"+qTip("설명: 관리자가 구분하기 편하도록 해당 상품 타입을 선택한다.")+"</label>"+
                	getMembershipType(idx)+
                    mbstype_tag+
			

				
				//*기타상품 제목 , *유료 무료 설정 
			    "<br><label for='mname' style='position:absolute;margin-left:3px'>*기타상품 제목"+qTip("설명: 해당 상품을 구분할수 있는 제목을 설정한다.")+"</label>"+
				"<label for='mtype' style='position:absolute;margin-left:240px'>*유료 무료 설정"+qTip("설명: 해당 상품이 무료이면 반드시 무료로 체크하세요",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mname_"+idx+"'  onkeyup='checkfree_text("+idx+")'    name='mstart' placeholder='ex)GX 3개월권...' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<div class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' >" +
							"<input id='mpaid_"+idx+"' type='radio' onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='n' style='margin-top:10px' checked>&nbsp;유료&nbsp;&nbsp;<input id='mfree_"+idx+"'' type='radio'  onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='y'>&nbsp;무료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>"+ 
						"</div>" +
					"</span>"+
					
				"</div><br><br>"+
				
								
				//상품 설명  , *상품 개월수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>상품 설명"+qTip("설명: 해당 상품에 대한 자세한 내용을 삽입한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>*상품 개월수"+qTip("설명: 상품을 사용할 수 있는 개월수를 입력한다. 상품기간이 없으면 0으로 설정한다. ex) 3 = 3개월",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input  type='text'   class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'  id='mdesc_"+idx+"' name='mdesc' placeholder='ex)3개월동안 헬스장 수건 이용상품..' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input type='number'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mmonth_"+idx+"' name='mmonth' placeholder='ex)상품사용 개월수 (숫자로 입력)' value='0' required>"+
					"</span>"+
				"</div><br><br>"+
				
				
			
				
									
				//*시작날짜 변경할 수 있는 회수  , *회원권 가격
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>*기타상품권 가격"+qTip("설명: 해당상품의 가격을 설정한다. ",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					
						"<input type='text'  class='form-control' style='border:0px;background-color:#f5f8fa;' id='mprice_"+idx+"' onfocus='this.select()' onkeyup='inputChangeComma(\"mprice_"+idx+"\")'  name='mprice' placeholder='ex)100000 (숫자로 입력)' required>"+
					
				"</div><br><br>"+

            "</div>";
				
        }
        
        
        
		var style = {bodycolor:"#ffffff",size:{width:"500px",height:"100%"}};
		var title="<text style='float:left;margin-top:1px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;'>"+f_title+" 추가</text><button onclick='hideModalDialog()' class='btn' style='float:right;cursor:pointer;'><i class='fa-solid fa-x''></i></button>";
        showModalDialog(document.body,title, main , "추가하기", "취소",function(){
               
               var type = document.getElementById("mtype_"+idx).value;
               var other_type = document.getElementById("mtype_other_"+idx) ? document.getElementById("mtype_other_"+idx).value : "";
               var isfree = document.getElementById("mfree_"+idx).checked ? true : false; //무료에 체크했다면
               if(isfree){
                   var input_price = document.getElementById("mprice_"+idx);
                   var input_name = document.getElementById("mname_"+idx);

                   input_name.value = input_name.value.indexOf(ID_FREE) >= 0 ? input_name.value : input_name.value+" "+ID_FREE;

                   input_price.value = "0";
                   input_price.disabled = true;
               }
                                                    
                                                     
               if(type &&  type == "Other" && !other_type){
                   alertMsg("기타 사항을 입력해 주세요.");
                   return;
               }
            
               if(type &&  type == "Other"){
                   type = other_type;
               }
                   clog
               var name = document.getElementById("mname_"+idx).value;
               var desc = document.getElementById("mdesc_"+idx) ? document.getElementById("mdesc_"+idx).value : "";
               var month = document.getElementById("mmonth_"+idx) ? document.getElementById("mmonth_"+idx).value : 1;
               var holdingday = document.getElementById("mholding_"+idx) ? document.getElementById("mholding_"+idx).value : 0;
               var changestarttime = document.getElementById("mstart_"+idx) ? document.getElementById("mstart_"+idx).value : 0;
               var maxcount = document.getElementById("mcount_"+idx) ? document.getElementById("mcount_"+idx).value : 0;
               var price = document.getElementById("mprice_"+idx).value;
//               var vat = document.getElementById("mvat_"+idx).value;
                var vat = 0;
               var iscounttype = document.getElementById("miscounttype_"+idx).value;
            
               
               var data = {
                    mbs_type : type,
                    mbs_name : name,
                    mbs_desc : desc,
                    mbs_month : parseInt(month),
                    mbs_max_holdingday : parseInt(holdingday),
                    mbs_max_change_starttime : parseInt(changestarttime),  // 시작시간 변경횟수
                    mbs_max_count : parseInt(maxcount),
                    mbs_price : parseCommaInt(price),
                    mbs_vat : vat,
                    mbs_iscounttype : parseInt(iscounttype)                   
               }    
               
               
               //if(!type || !name || !month || !holdingday || !changestarttime || !maxcount || !price || !vat) {
               if(!type || !name || !month ) {
                   alertMsg("입력되지 않는 부분이 있습니다. 다시 확인해주세요.");
                   return;
               }
               if(vat && parseInt(vat) < 0 || parseInt(vat) > 100){
                   alertMsg("부가세 입력 범위는 0 ~ 100 사이입니다.");
                   return;
               }
               
               insertMembershipData(data,function(res){
                   if(res.code == 100){
//                    loadMainDiv(6);
//                    hideModalDialog();
                    showModalDialog(document.body,"추가성공 ", "성공적으로 추가되었습니다. " , "확인", null,function(){
//                        hideModalDialog();
                        setTutorialStatus(TS._6_DEFAULTSETTING);
                        loadMainDiv(6);
                        hideModalDialog();hideModalDialog();
                    });
                   }else{
                        showModalDialog(document.body,"에러", res.message , "확인", null,function(){
                            setTutorialStatus(TS._4_SETTING_ADDCOUPON);
                             hideModalDialog();
                        });   
                   }
               },function(e){
                    showModalDialog(document.body,"에러", "업데이트가 되지 않음 " , "확인", null,function(){
                        setTutorialStatus(TS._4_SETTING_ADDCOUPON);
                         hideModalDialog();
                    });

               })
              
        },function(){
            console.log("allmembership ",allmembership);
            checkTutorialStatus();
            
            hideModalDialog();
            
        },style);
    }
    function checkTutorialStatus(){
        if(tutorial_status < TS.FINISH){
            var isterm_membership = false;
            for(var i = 0 ; i < allmembership.length; i++){
                if(allmembership[i].mbs_type == TYPE_TERM){
                    isterm_membership = true;
                    break;
                }
            }
            
            if(isterm_membership) {
                
                setTutorialStatus(TS._6_DEFAULTSETTING);
                loadMainDiv(4);
            } 
            else {
                setTutorialStatus(TS._4_SETTING_ADDCOUPON);   
            }
        }
        
    }
    function setting_membership_button_edit(idx){
//        clog("setting_membership_button_edit");
        var membershipdata = allmembership[idx];
        var idx = membershipdata["mbs_idx"];
        var type = membershipdata["mbs_type"];
        var name = membershipdata["mbs_name"] ? membershipdata["mbs_name"] : "";
        var desc = membershipdata["mbs_desc"] ? membershipdata["mbs_desc"] : "";
        
        var month = membershipdata["mbs_month"];
        var holdingday = membershipdata["mbs_max_holdingday"];
        var changestarttime = membershipdata["mbs_max_change_starttime"];
        var maxcount = membershipdata["mbs_max_count"];
        var price = membershipdata["mbs_price"];
        var vat = membershipdata["mbs_vat"] ? membershipdata["mbs_vat"] : global_vat;
        clog("global_vat is "+global_vat);
        var iscounttype_0 = parseInt(membershipdata["mbs_iscounttype"]) == 0 ? "selected" : "";
        var iscounttype_1 = parseInt(membershipdata["mbs_iscounttype"]) == 1 ? "selected" : "";
         
        //이부분은 고정이라 숨기고 부가세 별도설정태그로 바꾼다.
        var iscounttype_tag = getSettingMembershipType() == "counttype" ? "<select id='miscounttype_"+idx+"' class='form-control' style='border:0px;background-color:#f5f8fa;width:220px;display:none'  name='gender' required><option value='1'>횟수제</option></select>" :  "<select id='miscounttype_"+idx+"' class='form-control' style='border:0px;background-color:#f5f8fa;width:220px;display:none' name='gender' required><option value='0'>기간제</option></select>";
        
        //부가세 별도설정 태그
        var coupon_vat_tag = "<input type='number' class='form-control' id='mvat_"+idx+"' placeholder='ex)0% ~ 99% ' style='display:none' value='"+vat+"'>";
        
        var mbstype_tag = getSettingMembershipType() == "counttype" ? "<span style='float:left'><input value='"+type+"' type='text' class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' id='mtype_"+idx+"' name='mtype' placeholder='ex)헬스, 일반, 이벤트, PT, GX, 기타... ' disabled></span>" : "<span style='float:left'><input value='"+type+"' type='text' class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'  id='mtype_"+idx+"' name='mtype' placeholder='ex)헬스, 일반, 이벤트, PT, GX, 기타... ' disabled></span>";
        
        var isfree = name.indexOf(ID_FREE) >= 0 && price == 0 ? true : false;
        var c0_checked = isfree ? "" : "checked";
        var c1_checked = isfree ? "checked" : "";
        var main = "<div id=formdiv align='left' style='width:100%;height:470px;margin-left:5px;font-size:15px; color:#181c32; text-align:left; font-weight:500;'>"+
			
				//기간제/횟수제 
//                "<label for='gender'>기간제/횟수제"+qTip("설명: [기간제] ex)헬스1개월권~1년권 등 날짜기준,  [횟수제] ex)PT10회, GX30회 등..")+"</label>"+
//                iscounttype_tag+
//			
				
					
				//*기간제/횟수제 , *유료 무료 설정 
//			    "<br><label for='mname' style='position:absolute;margin-left:3px'>*횟수제 타입"+qTip("설명: [기간제] ex)헬스1개월권~1년권 등 날짜기준,  [횟수제] ex)PT10회, GX30회 등..")+"</label>"+
                "<br><label for='mname' style='position:absolute;margin-left:3px;display:none'>*부가세 별도설정"+qTip("설명: 해당 회원권만 별도로 부가세를 다르게 설정할 수 있습니다.")+"</label>"+
				"<label for='mtype' style='position:absolute;margin-left:240px'>*유료 무료 설정"+qTip("설명: 해당 회원권이 무료이면 반드시 무료로 체크하세요",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						iscounttype_tag+coupon_vat_tag+
//                          iscounttype_tag+
					"</span>"+
					"<span style='float:right'>"+
						"<div class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' >" +
							"<input id='mpaid_"+idx+"' type='radio' onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='n' style='margin-top:10px' "+c0_checked+">&nbsp;유료&nbsp;&nbsp;"+
                            "<input id='mfree_"+idx+"'' type='radio'  onclick='insert_membership_freechecck("+idx+")' name='mpaid' value='y' "+c1_checked+" >&nbsp;무료&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br>"+ 
						"</div>" +
					"</span>"+
					
				"</div><br><br>"+
				
					
			
			
			
				//회원권 타입 , 회원권 제목
                "<br><label for='mtype' style='position:absolute;margin-left:3px'>회원권 타입"+qTip("설명: 관리자가 구분하기 편하도록 해당 회원권 타입을 선택한다.")+"</label><label for='mname' style='position:absolute;margin-left:240px'>회원권 제목"+qTip("설명: 해당 회원권를 구분할수 있는 제목을 설정한다.",true)+"</label><br>"+			
                "<div style='margin-top:10px;'>"+mbstype_tag+"<span style='float:right'><input value='"+name+"' type='text' class='form-control'   style='border:0px;background-color:#f5f8fa;width:220px'  id='mname_"+idx+"'  onkeyup='checkfree_text("+idx+")'  name='mname' placeholder='ex)헬스 3개월권...' required></span></div><br><br>"+
			
			
				//회원권 설명  , 회원권 개월수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>회원권 설명"+qTip("설명: 해당 회원권에 대한 자세한 내용을 삽입한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>회원권 개월수"+qTip("설명: 회원권을 사용할 수 있는 개월수를 입력한다.",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'><span style='float:left'><input value='"+desc+"' type='text' class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px' id='mdesc_"+idx+"' name='mdesc' placeholder='ex)3개월동안 헬스장 이용상품..' required></span>"+
				"<span style='float:right'><input value="+month+" type='number' class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mmonth_"+idx+"' name='mmonth' placeholder='ex)헬스장 개월수 (숫자로 입력)' required></span></div><br><br>"+
			
			
                //최대 회원권 홀딩일수  , 시작날짜를 변경할 수 있는 회수
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>최대 회원권 홀딩일수"+qTip("설명: 운동중에 부득이한 사정이 있을때를 대비해 운동을 잠시 홀딩할 수있는 최대 일수를 삽입한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>시작날짜 변경할 수 있는 회수"+qTip("설명: 회원권 시작전에 시작날짜를 입력한 횟수만큼 변경할 수 있다. ex)1 = 1번만 변경가능",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input value="+holdingday+" type='number'  class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'  id='mholding_"+idx+"'  name='mholding' placeholder='ex)최대홀딩일수 30일..(숫자로 입력)' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input  value="+changestarttime+" type='number'  class='form-control' style='border:0px;background-color:#f5f8fa;width:220px' id='mstart_"+idx+"'  name='mstart' placeholder='ex)시작일 변경할 수 있는 횟수..(숫자로 입력)' required>"+
					"</span>"+
				"</div><br><br>"+
			
               
			
                //PT 운동회수 , 회원권 가격
			    "<br><label for='mtype' style='position:absolute;margin-left:3px'>PT 운동회수"+qTip("설명: 기간제일때는 : 0 , 횟수제일때는 운동회수를 입력한다.")+
				"</label><label for='mname' style='position:absolute;margin-left:240px'>회원권 가격"+qTip("설설명: 해당회원권의 가격을 설정한다. ",true)+"</label><br>"+
			
				"<div style='margin-top:10px;'>"+
					"<span style='float:left'>"+
						"<input value="+maxcount+" type='number'  class='form-control'  style='border:0px;background-color:#f5f8fa;width:220px'  id='mcount_"+idx+"'  name='mcount' placeholder=ex)PT횟수 (숫자로 입력)' required>"+
					"</span>"+
					"<span style='float:right'>"+
						"<input  value="+CommaString(price)+" type='text'  class='form-control' onfocus='this.select()' onkeyup='inputChangeComma(\"mprice_"+idx+"\")'  style='border:0px;background-color:#f5f8fa;width:220px' id='mprice_"+idx+"'  name='mprice' placeholder='ex)100000 (숫자로 입력)' required>"+
					"</span>"+
				"</div>"+

         "</div>";
		
		var style = {bodycolor:"#ffffff",size:{width:"500px",height:"100%"}};
		var title="<text style='float:left;margin-top:1px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;'>"+idx+"번 회원권 수정</text><button onclick='hideModalDialog()' class='btn' style='float:right;cursor:pointer;'><i class='fa-solid fa-x''></i></button>";
        showModalDialog(document.body,title, main , "수정하기", "취소",function(){
               
               var type = document.getElementById("mtype_"+idx).value;
               var name = document.getElementById("mname_"+idx).value;
               var desc = document.getElementById("mdesc_"+idx) ? document.getElementById("mdesc_"+idx).value : "";
               var month = document.getElementById("mmonth_"+idx) ? document.getElementById("mmonth_"+idx).value : 1;
               var holdingday = document.getElementById("mholding_"+idx) ? document.getElementById("mholding_"+idx).value : 0;
               var changestarttime = document.getElementById("mstart_"+idx) ? document.getElementById("mstart_"+idx).value : 0;
               var maxcount = document.getElementById("mcount_"+idx).value;
               var price = document.getElementById("mprice_"+idx).value;
//               var vat = document.getElementById("mvat_"+idx).value;
                var vat = 0;
               var iscounttype = document.getElementById("miscounttype_"+idx).value;
               var data = {
                    mbs_idx :  parseInt(idx),
                    mbs_type : type,
                    mbs_name : name,
                    mbs_desc : desc,
                    mbs_month : parseInt(month),
                    mbs_max_holdingday : parseInt(holdingday),
                    mbs_max_change_starttime : parseInt(changestarttime),  // 시작시간 변경횟수
                    mbs_max_count : parseInt(maxcount),
                    mbs_price : parseCommaInt(price),
                    mbs_vat: parseInt(vat),
                    mbs_iscounttype : parseInt(iscounttype)
                   
               }    
               
               //if(!type || !name || !month || !holdingday || !changestarttime || !maxcount || !price || !vat) {
               if(!type || !name || !month  ) {
                   alertMsg("입력되지 않는 부분이 있습니다. 다시 확인해주세요.");
                   return;
               }
               if(vat && parseInt(vat) < 0 || parseInt(vat) > 100){
                   alertMsg("부가세 입력 범위는 0 ~ 100 사이입니다.");
                   return;
               }
            
               updateMembershipData(data,function(res){
                    if(res.code == 100){
//                        loadMainDiv(6);
//                        hideModalDialog();
                        showModalDialog(document.body,"업데이트성공 ", "성공적으로 적용되었습니다. " , "확인", null,function(){
                            loadMainDiv(6);
                            hideModalDialog();hideModalDialog();
                            
                        });
                    }else {
                         showModalDialog(document.body,"에러", "업데이트가 되지 않음 " , "확인", null,function(){
                             hideModalDialog();
                        });
                    }
                    
               },function(e){
                    showModalDialog(document.body,"에러", "업데이트가 되지 않음 " , "확인", null,function(){
                         hideModalDialog();
                    });
               })

        },function(){
            hideModalDialog();
        },style);
    }
    function setting_membership_button_delete(idx){
//        clog("ddd");
        var membershipdata = allmembership[idx];
        var mbsidx = membershipdata["mbs_idx"];
        showModalDialog(document.body,"회원권 삭제", "해당 항목을 삭제하시겠습니까?" , "목록에서 삭제하기", "취소",function(){
            
            removeMembershipData(mbsidx,function(res){
                if(res.code == "100"){
//                    loadMainDiv(6);
//                    hideModalDialog();
                    showModalDialog(document.body,"삭제성공 ", "성공적으로 적용되었습니다. " , "확인", null,function(){
//                                hideModalDialog();
                        loadMainDiv(6);
                        hideModalDialog();hideModalDialog();
                    });         
                }else {
                    alertMsg("에러 : "+res.message);    
                }
                
            },function(err){
                alertMsg("네트워크 에러");
            });
            
           
        },function(){
            hideModalDialog();               
        });
    }
    function tab_click(idx){
        if(idx == 1){
            istype = "termtype";
            setSettingMembershipType(istype);
            loadMainDiv(6);
        }else if(idx == 2){
            istype = "counttype";
            setSettingMembershipType(istype);
            
            loadMainDiv(6);
        }else if(idx == 3){
            istype = "gxtype";
            setSettingMembershipType(istype);
            loadMainDiv(6);
        }else{
            istype = "othertype";
            setSettingMembershipType(istype);
            loadMainDiv(6);
        }
        
    }
    function getSettingMembershipType(){
        var type = "termtype";
        if(getData("setmembershiptype"))
            type = getData("setmembershiptype");
//        clog("gettype "+getData("setmembershiptype"));
        return type;        
    }
    function setSettingMembershipType(type){
//        clog("settype ",type);
        saveData("setmembershiptype",type);
    }
</script>
