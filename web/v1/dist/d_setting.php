<div class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div  class="reservation_center" style='padding:5px'>
            <text id='id_setting_title' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >기본설정</text>
			<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
			
			
			<div >
				 
				 <!--탭관련 START-->
				 <script>
					 var issettingtabtype = "setlocker";

				 </script>
				 <div  style='width:1198px; height:140px; border-radius:5px; background-color:#f1faff;padding:20px'>
					 <div style='position:absolute;margin-top:60px;display:none'>
						 <span style="float:left"><label for="id_cardvat" style="position:absolute;margin-top:7px;font-size: 14px; color:#5e6278;font-weight:700; text-align:left;"><span class="lefttip"><img src="./img/icon_notice.png" style="width:27px;height:27px" /><span>해당 센터에 카드결제시 기본으로 설정되는 부가세입니다. (최초: 10%)</span></span>&nbsp;카드 기본부가세</label>
						 <input type='number'  id="id_cardvat" class="form-control" placeholder="예)10%" style="border:0px;margin-left:200px;width:930px" /></span><span><label style="margin-left:5px;margin-top:7px;font-size:14px">%</label></span>
					 </div>
					 <div style='position:absolute;margin-top:5px'>
						  
						 <img src="./img/ques_20.png" style='margin-top:8px' title="앱화면 중간부분에 센터를 간단히 설명하는 문구를 삽입할 수 있습니다. ex)운영시간 공지등등...">&nbsp;<label style='margin-top:5px'>앱 공지문구(운영시간)</label>
						 <input class="form-control" id="id_centerdesc" placeholder="예)사당점 운영시간 06:00 ~ 22:00" style="float:right;border:0px;margin-top:-5px;margin-left:50px;width:950px;height:45px" />
					 </div>
					 <div style='margin-top:65px'>
						  
						<label style="position:absolute;margin-top:12px;font-size: 15px; color:#181c32;font-weight:500; text-align:left; ">•&nbsp;&nbsp;센터 공휴일설정</label> 
						<button onclick='show_custom_holiday()' style='float:right;width:160px; height:40px; border-radius:5px; background-color:#f1416c;border:0px;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>공휴일 설정</button>
					 </div>
				 </div>
                
				 <br><br>
				 <ul class="nav nav-tabs">
					 <li id="tab1"  class="nav-item">
						 <a href="#aaa" id='tab_navlink1' class="nav-link active" data-toggle="tab" onclick="setting_tab_click(1)"><label for="locker_price" style="margin-top:5px;">기본 가격설정</label></a>
					 </li>
					 <li id="tab2" class="nav-item">
						 <a href="#bbb" id='tab_navlink2' class="nav-link" data-toggle="tab" onclick="setting_tab_click(2)"><label id='id_reservation_title' for="locker_price"  style="margin-top:5px;">PT/GX 강좌설정</label></a>
					 </li>
					 <li id="tab3"  class="nav-item">
						 <a href="#ccc" id='tab_navlink3' class="nav-link" data-toggle="tab" onclick="setting_tab_click(3)"><label  style="margin-top:5px;">전체기간 연장하기</label></a>
					 </li>

				 </ul>
				 <div class="tab-content" id="tabs">
					 <div class="tab-pane" id="aaa"></div>
					 <div class="tab-pane" id="bbb"></div>
					 <div class="tab-pane" id="ccc"></div>
				 </div>
				 <!--탭관련 END-->

				 <div id="div_tab1data">
					 <br>
					 <div style="width:1198px; height:auto; border-radius:10px; background-color:#ffffff; border:1px solid #eff2f5;">
						 <div id='div_locker'>
							
							 <div style="width:100%;height:69px;border-bottom:1px solid #eff2f5;padding-left:30px;padding-top:12px">
								 <label for="id_lockermonthprice" style="position:absolute;margin-top:12px;font-size: 15px; color:#181c32;font-weight:500; text-align:left; ">•&nbsp;&nbsp;1달 라커가격</label> 
								 <input type="number" class="form-control" id="id_lockermonthprice" name="id_lockermonthprice" placeholder="1달 기준 가격.." style="margin-left:140px;max-width:1000px;height:45px;border:0px;background-color:#f5f8fa;border-radius:10px;" />
							 </div>
							  <div style="width:100%;height:69px;padding-left:30px;padding-top:12px">
								 <label for="id_lockerdayprice" style="position:absolute;margin-top:12px;font-size: 15px; color:#181c32;font-weight:500; text-align:left; ">•&nbsp;&nbsp;1일 라커가격</label>
								 <input type="number" class="form-control" id="id_lockerdayprice" name="id_lockerdayprice" placeholder="1일 기준 가격.." style="margin-left:140px;max-width:1000px;height:45px;border:0px;background-color:#f5f8fa;border-radius:10px;" /><br>
							 </div> 
                             
						 </div>
                         <hr style="border: solid 1px #eff2f5;">
                         <div id='div_send_coupon_price' style="width:100%;height:69px;padding-left:30px;padding-top:3px">
                             <label for="id_sendprice" style="position:absolute;margin-top:12px;font-size: 15px; color:#181c32;font-weight:500; text-align:left; ">•&nbsp;&nbsp;회원권 양도가격</label>
                             <input type="number" class="form-control" id="id_sendprice" name="id_sendprice" placeholder="회원권 양도 기준 가격.." style="margin-left:140px;max-width:1000px;height:45px;border:0px;background-color:#f5f8fa;border-radius:10px;" /><br>
                         </div>
                        
					 </div>
					 <br>
				 </div>
				 <div id="div_tab2data" style='display:none'>

					
					 <div style="margin-top:10px;height:auto"><br>
			<!--
						 <div>
							 <label for="id_inserttime" style="position:absolute;margin-top:7px">● GX 예약하기 최소시간</label>
							 <input type="number" class="form-control" id="id_inserttime" name="id_inserttime" placeholder="설정시간 후에는 예약불가.." style="margin-left:200px;max-width:200px" />
						 </div>
						 <div>
							 <label for="id_canceltime" style="position:absolute;margin-top:7px">● GX 예약취소 최소시간</label>
							 <input type="number" class="form-control" id="id_canceltime" name="id_canceltime" placeholder="설정시간 후에는 예약불가.." style="margin-left:200px;max-width:200px" /><br>
						 </div>
			-->
						 <div style='width:1198px;height:258px; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px;'>
							 <div style='width:100%;height:44px;background-color:#f5f8fa; border-radius:10px 10px 0 0; border-bottom:1px solid #e4e6ef;'>
							 	<label style='font-size: 16px; color:#3f4254;font-weight:500; text-align:left;margin-top:10px;margin-left:30px'>PT 관련</label>
							 </div>
							 
							 <div style='height:auto;padding:15px 30px 15px 30px'>
								 <span style='float:left;padding-top: 10px;font-size: 15px; color:#181c32;font-weight:500; text-align:left;'>PT 전체 오픈시간
								 <span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>[PT] 하루동안 운동 예약가능한 시간대를 설정할 수 있습니다.PT예약만 해당됩니다.</span></span></span><span style="float:right"><select id="id_selectalltime" onchange="insertTime()" name="doc_membership_name_list" style='margin:10px;cursor:pointer;width:166px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:15px;padding-right:15px;font-size: 14px; color:#5e6278;font-weight:500; text-align:left;margin-right:-2px'>
									 <option value="">시간 추가하기</option>
								 </select></span>
								 <br>
								 <div id="id_alltimes" style="margin-top:40px;width:1138px; height:118px; background-color:#dfebf5;border:1px solid #3980c0;border-radius:10px;border-top-style: dashed;border-right-style: dashed;border-bottom-style: dashed;border-left-style: dashed; padding:20px;"></div>
								 <br>


							</div>
						 </div>
						 <br>

			<!--
						 <text class='textevent' style='float:left'>● GX 관련</text><br>
						 <div class ="form-control" style='height:auto'>
								<text>※ [GX] 예약횟수제한</text>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1주당<input id='foot_maxgx_reservation' type='number' style='max-width:25px'/>회<br>
						 </div><br><br>
			-->
						 <div id='div_ptgx_setting' style="width:1198px;height:auto; background-color:#ffffff; border:1px solid #e4e6ef; border-radius:10px; padding-left:30pxpadding-right:30px;">
							  <div style='width:100%;height:44px;background-color:#f5f8fa; border-radius:10px 10px 0 0; border-bottom:1px solid #e4e6ef;'>
							 	 <span style='float:left;padding-top: 10px;font-size: 15px; color:#181c32;font-weight:500; text-align:left;margin-left:30px'>PT/GX 강좌설정
								 <span class="lefttip"><i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf"></i><span>운동강좌 이름, 1시간단위운동 최대 인원수를 설정할 수 있습니다. 관리자가 먼저 다음에 예약가능한 운동시작날짜 종료날짜를 설정하면 담당트레이너가 설정되어있는 날짜안에서 일정을 정할 수 있습니다. ※강좌가 PT 일때는 강좌개수를 1개로 시간별 최대 인원수는 1~2명으로 고정하는것이 좋습니다.</span></span></span>
                                  <span style="float:right;margin-right:20px">
                                      <label>※복사하기로 강좌입력시 일요일 및 공휴일 예약제외 :&nbsp;</label><label class='switch' style='margin-top:10px;zoom:0.8'>
                                            <input id='holiday_reservation_0' type='checkbox' onchange='gxtogglechange("holiday_reservation",0)'>
                                            <span id='holiday_reservation_span_0' class='slider round'>
                                                <text class='fmont' id='holiday_reservation_txt_0'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:white'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF</text>
                                            </span>
                                        </label>
                                  </span>
							 </div>
							 
							  <div id="all_classes" style="height:auto;">
							 
								 <table id="dataTable"  cellspacing="0" style="margin:30px 20px 30px 20px;border:1px solid #e7e7e7; width:1155px;font-size:14px; color:#212529; text-align:center;font-weight:400;">
									 <thead>
										 <tr style="height:48px;background-color:#f5f6f8;" align="center">
											 <td style="width:80px;border:1px solid #e7e7e7;font-weight:500;">강좌타입</td>
											 <td style="width:140px;border:1px solid #e7e7e7;font-weight:500;">강좌이름</td>
											 <td style="width:180px;border:1px solid #e7e7e7;font-weight:500;">세부강좌명</td>
											 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>시간별<br>최대인원수</td>

											 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>[GX]예약<br>가능시간</td>
											 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>[GX]예약취<br>소가능시간</td>
											 <td style='width:80px;border:1px solid #e7e7e7;font-weight:500;'>[GX]예약<br>횟수제한</td>
											 <td style="width:55px;border:1px solid #e7e7e7;font-weight:500;">[GX]푸시<br>보내기</td>
											 <td style="width:55px;border:1px solid #e7e7e7;font-weight:500;">[GX]<br>자동출석</td>
											 <td style="width:55px;border:1px solid #e7e7e7;font-weight:500;">[GX]대기후<br>자동예약</td>

											 <td style="width:160px;border:1px solid #e7e7e7;font-weight:500;">[GX]기본<br>오픈설정</td>
											 <td style="width:65px;border:1px solid #e7e7e7;font-weight:500;">버튼</td>

										 </tr>
									 </thead>

									 <tbody id='table_body' align="center">
										 <tr>
										 </tr>
									 </tbody>

									 <!--                강좌추가하기 임시로 막아놓음-->

												<tfoot id = "table_footer" align="center" style='background-color:#fffed2;text-align:center'>
													<tr  height="70px" >
														<td style="border:1px solid #e7e7e7;"><select id="foot_type" placeholder="강좌타입 선택..." style="width:68px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; padding-right:10px;font-size: 13px;  color:#5e6278;font-weight:700;text-align:left;"><option value="">선택</option><option value="PT">PT</option><option value="GX">GX</option></select></td>
														<td style="border:1px solid #e7e7e7;"><input id="foot_name" name="id_inputname" placeholder="강좌이름 입력..." style="width:122px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/></td>
														<td style="border:1px solid #e7e7e7;"><input id="foot_detailname" name="id_inputname" placeholder="ex)기구1,기구2,기구3,..."  style="width:165px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/></td>
														<td  style="border:1px solid #e7e7e7;">최대<input type="number" id="foot_max"  name="id_inputname"  style="width:38px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/>명</td>
														<td  style="border:1px solid #e7e7e7;"><input type="number" id="foot_insertmaxtime"  name="foot_insertmaxtime"   style="width:48px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/>분전</td>
														<td  style="border:1px solid #e7e7e7;"><input type="number" id="foot_canceltime"  name="foot_canceltime"   style="width:48px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;"/>분전</td>
														<td  style="border:1px solid #e7e7e7;">주당<input type="number" id="foot_maxgx_reservation"  name="id_inputname"  style="width:33px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;" value='0'/>회</td>
														<td style="border:1px solid #e7e7e7;">
				<!--                                            <label style='font-size:16px'>푸시사용</label><br>-->
															<label class='switch' style='margin-top:10px;zoom:0.8'>
																<input id='foot_togglepush_0' type='checkbox' onchange='gxtogglechange("foot_togglepush",0)' checked>
																<span id='foot_togglepush_span_0' class='slider round'>
																	<text class='fmont' id='foot_togglepush_txt_0'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:white'>&nbsp;ON</text>
																</span>
															</label>
														</td>
														<td style="border:1px solid #e7e7e7;">
				<!--                                            <label style='font-size:16px'>자동출석</label><br>-->
															<label class='switch' style='margin-top:10px;zoom:0.8'>
																<input id='foot_toggleautocheckin_0' type='checkbox' onchange='gxtogglechange("foot_toggleautocheckin",0)' checked>
																<span id='foot_toggleautocheckin_span_0' class='slider round'>
																	<text class='fmont'id='foot_toggleautocheckin_txt_0'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:white'>&nbsp;ON</text>
																</span>
															</label>
														</td>
														<td style="border:1px solid #e7e7e7;">
				<!--                                            <label style='font-size:16px'>자동예약</label><br>-->
															<label class='switch' style='margin-top:10px;zoom:0.8'>
																<input id='foot_toggleautoreadyin_0' type='checkbox' onchange='gxtogglechange("foot_toggleautoreadyin",0)' checked>
																<span id='foot_toggleautoreadyin_span_0' class='slider round'>
																	<text class='fmont' id='foot_toggleautoreadyin_txt_0'style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:white'>&nbsp;ON</text>
																</span>
															</label>
														</td>

														<td style="border:1px solid #e7e7e7;">
															<select id='foot_gxopentime' style="font-size:14px;width:148px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;">
																<option value = "open_sunday">오픈전 일요일 0시</option>
																<option value = "open_monday">오픈전 월요일 0시</option>
																<option value = "open_tuesday">오픈전 화요일 0시</option>
																<option value = "open_wednesday">오픈전 수요일 0시</option>
																<option value = "open_thursday">오픈전 목요일 0시</option>
																<option value = "open_friyday">오픈전 금요일 0시</option>
																<option value = "open_saturday">오픈전 토요일 0시</option>
																<option value = "open_1day">오픈일 1일전</option>
																<option value = "open_2day">오픈일 2일전</option>
																<option value = "open_3day">오픈일 3일전</option>
																<option value = "open_4day">오픈일 4일전</option>
																<option value = "open_5day">오픈일 5일전</option>
																<option value = "open_6day">오픈일 6일전</option>
																<option value = "open_7day">오픈일 7일전</option>
																<option value = "open_now">즉시오픈</option>

															</select>
														</td>
														<td style="border:1px solid #e7e7e7;"><button onclick='add_class()' style='width:60px; height:40px; border-radius:5px; background-color:#f1416c;border:0px;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>강좌추가</button></td>                                

													</tr>
												</tfoot>

								 
								  </table>

							 </div>
						 </div>
					 </div>
					 <br>
				 </div>

				 <div id="div_tab3data" style='display:none'>
					 <br>
					 <div style="height:auto">
						 <span style="float:right"><button onclick='show_all_delay()' class='btn' title="현재까지 연장한 기간 기록을 볼 수 있습니다." style='border:0px;width:115px; height:35px; border-radius:5px; background-color:#009ef7;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>연장기록보기</button></span>
					 </div>
					 <br><br>
			<!--         <label style='color:#555555'>&nbsp;※센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...</label><br>-->
					 <div  style ='width:1198px; height:278px; border-radius:10px; background-color:#ffffff; border:1px solid #eff2f5;'>         
						<div style="height:70px;border-bottom:1px solid #eff2f5;padding-left:30px;padding-right:30px">
							<label for='id_delaygrouptype' style="font-size:14px; color:#181c32; text-align:left; font-weight:500;margin-top:23px">그룹선택</label>
							<select id='id_delaygrouptype' style="float:right;margin-top:12px;width:900px; height:45px; border-radius:10px; background-color:#f5f8fa; padding-left:20px;border:0px;" required>
								<option value=''>== 연장할 그룹을 선택하세요 ==</option>
								<option value='1'>유효회원 전체</option>
								<option value='2'>종료회원 전체</option>
								<option value='3'>모든 회원</option>                
							</select>
						</div>
						<div style="height:70px;border-bottom:1px solid #eff2f5;padding-left:30px;padding-right:30px">
							<label for='id_delaygrouptype' style="font-size:14px; color:#181c32; text-align:left; font-weight:500;margin-top:23px">연장일수 선택</label>
							<input type='number' style="float:right;margin-top:12px;width:900px; height:45px; border-radius:10px; background-color:#f5f8fa; padding-left:20px;border:0px"id='id_delayday' name='id_delayday' placeholder='연장할 일수를 선택...' /><br>
						</div>
						<div style="height:70px;border-bottom:1px solid #eff2f5;padding-left:30px;padding-right:30px">
							<label for='id_delaygrouptype' style="font-size:14px; color:#181c32; text-align:left; font-weight:500;margin-top:23px">연장사유</label>
							<input type='text' style="float:right;margin-top:12px;width:900px; height:45px; border-radius:10px; background-color:#f5f8fa; padding-left:20px;border:0px" id='id_delaynote' name='id_delaynote' placeholder='연장할 내용을 적어주세요..'/><br>     
						</div>
						<div style="height:70px;padding-left:30px;padding-right:30px">
							<label for='id_delaygrouptype' style="font-size:14px; color:#181c32; text-align:left; font-weight:500;margin-top:23px">연장항목</label>
							<div style="float:right;margin-top:12px;width:900px; height:45px; border-radius:10px; padding-left:20px;border:0px" name='subscription_path'>
								<div style="margin-top:12px;margin-left:-15px;">
									<span style="float:left;"><label class="mycheckbox"><input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='1'><span class="checkmark"></span></label></span>
									<span style="float:left;"><text >수강항목&nbsp;&nbsp;&nbsp;</text></span>
                                	<span style="float:left;"><label class="mycheckbox"><input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='2'><span class="checkmark"></span></label></span>
									<span style="float:left;"><text >라커항목&nbsp;&nbsp;&nbsp;</text></span>
                                	
								</div>
							</div>
						</div>
						<br>
						<div style="height:70px;margin-top:-15px;margin-right:-10px">
                             <span style="float:right"> <button onclick='set_all_delay()' class='btn btn-primary btn-raised' style='border:0px;width:125px; height:35px; border-radius:5px; background-color:#f1416c;font-size:13px; color:#ffffff; text-align:center;font-weight:700;margin-right:10px' title="*센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...)">전체기간 연장하기</button></span>
                        </div>
                         
					 </div>

				 </div>
				
				 <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
				 <button id='btn_save_setting' onclick='update_setting()' class='btn ' style='borer:0px;float:right;width:115px; height:43px; border-radius:5px; background-color:#009ef7;font-size:14px; color:#ffffff; text-align:center;font-weight:700 ;margin-top:5px'>저장하기</button>
				 <br><br>
			 </div>
			<div id = "div_member_table" style ="display:none">
				<table class="table table-bordered" id="memberTable" width="100%" cellspacing="0">
				</table>
			 </div>
	</div>
</div>
 <script>
     function onMouseovertest(e){
		 clog("onMouseovertest",e);
		 clog("onMouseovertest00",e.name);
		 clog("onMouseovertest11", e.getAttribute("desc"));
		
	 }
	 
     if (isPermission(25)) activaTab('aaa');
     else if(isPermission(26))activaTab('bbb');
     else activaTab('ccc');


     function activaTab(tab) {
         $('.nav-tabs a[href="#' + tab + '"]').tab('show');

     };

     function setting_tab_click(idx) {
         var btn_save_setting = document.getElementById("btn_save_setting");
         if (idx == 1) {
             issettingtabtype = "setlocker"; //라커개수 & 가격설정
             btn_save_setting.style.display = "block";
         } else if (idx == 2) {
             issettingtabtype = "insertmaxtime"; //예약시간 설정 예)PT.GX 등 예약시간
             btn_save_setting.style.display = "block";
         } else {
             issettingtabtype = "alluserdelay"; //전체유저기간연장
            btn_save_setting.style.display = "none";
         }
         for (var i = 1; i <= 3; i++){
             document.getElementById("div_tab" + i + "data").style.display = i == idx ? "block" : "none";
             
             var tab = document.getElementById("tab_navlink"+i);
             if(i == idx && tab.className.indexOf("active") < 0) tab.classList.add("active");
             if( i != idx && tab.className.indexOf("active") >= 0)tab.className = tab.className.replace("active","");
         }

     }
     
     


     var group = getData("nowgroupcode");
     var centercode = getData("nowcentercode");
     var centername = getData("nowcentername");


     var allsetting = null;
     var mlocker = null;
     var mreservationinfo = null;
     var msetting = null;

     //라커가격 설정
     var id_centerdesc = document.getElementById("id_centerdesc");
     var id_cardvat = document.getElementById("id_cardvat");
     
     var id_setting_title = document.getElementById("id_setting_title");
     var id_reservation_title = document.getElementById("id_reservation_title");

//     var id_lockercount_start = document.getElementById("id_lockercount_start");
//     var id_lockercount_end = document.getElementById("id_lockercount_end");

     var id_lockermonthprice = document.getElementById("id_lockermonthprice");
     var id_lockerdayprice = document.getElementById("id_lockerdayprice");
     var id_sendprice = document.getElementById("id_sendprice");

     //예약시간 설정
//     var id_inserttime = document.getElementById("id_inserttime");
//     var id_canceltime = document.getElementById("id_canceltime");

     var id_alltimes = document.getElementById("id_alltimes");
     var id_selectalltime = document.getElementById("id_selectalltime");

         var table_footer = document.getElementById("table_footer");
     var table_body = document.getElementById("table_body");

     var default_setting_index = 0; //기본세팅값  트레이너 : 1  매니저 : 2  운영자 : 3

     //급여 테이블 Body
     var table_levelbody = document.getElementById("table_levelbody");

     function init_d_setting(value) {
         
         check_tab_permission();
         
         
         id_setting_title.innerHTML = centername + " 설정";
         clog("mainii");
         getSettingData(function(res) {
             if (res.code == 100) {
                 allsetting = res.message;
                 var lockers = allsetting.lockers;
                 var reservationinfos = allsetting.reservation_info;
                 var setting = allsetting.setting;
                 id_centerdesc.value = setting.centerdesc;
//                 id_cardvat.value = setting.vat;//neel_vat0
                 id_cardvat.value = 0;//neel_vat0
                 clog("res.message ", allsetting);
                  clog("setting ", setting.centerdesc);
                 if (!allsetting.setting) {
                     allsetting["setting"] = {};
                 }
                 msetting = allsetting.setting;
                 updateTableLevelBody();
                 id_sendprice.value = msetting.sendprice ? parseInt(msetting.sendprice) : 0;
                 if (lockers && lockers.length > 0) {
                     mlocker = lockers[0];

                     id_lockermonthprice.value = parseInt(mlocker.monthprice);
                     id_lockerdayprice.value = parseInt(mlocker.dayprice);
                     
                 }else {
                     var div_locker = document.getElementById("div_locker");
                     if(div_locker)div_locker.innerHTML = "<label style='color:red;font-size:18px;margin-top:20px;margin-left:40px'>※현재 라커데이타가 없습니다. </label>&nbsp;<button id='btn_goto_locker' onclick='btn_goto_locker_click();'  class='btn btn-primary btn-raised' style=''>라커설정하기</button><br>";
                 }
                 if (reservationinfos && reservationinfos.length > 0) {



                     mreservationinfo = reservationinfos[0];
                     //                   id_reservation_title.innerHTML = mreservationinfo.type+" "+id_reservation_title.innerHTML;
//                     id_inserttime.value = parseInt(mreservationinfo.insertmaxtime);
//                     id_canceltime.value = parseInt(mreservationinfo.canceltime);
                     id_alltimes.innerHTML = "";
                     for (var i = 0; i < mreservationinfo.opentimes.length; i++) {
                         var text = mreservationinfo.opentimes[i] < 10 ? "0" + mreservationinfo.opentimes[i] + "시" : mreservationinfo.opentimes[i] + "시";
                         insertXImageButton(id_alltimes, mreservationinfo.opentimes[i], mreservationinfo.opentimes[i] + "시");
                     }
                     updateTableBody();

                 }
                 updateSettingTime();

             }
         }, function(err) {
             clog("getSettingData error ", err);
         });
     } 
     var new_add_holiday = global_centersetting.center_holiday ? global_centersetting.center_holiday : [];
     var imsi_add_holiday = global_centersetting.center_holiday ? global_centersetting.center_holiday : [];
     function show_custom_holiday(){
         initImsiHoldingDay();
         var list_tag = getHolidayTable(global_centersetting.center_holiday);
         var input_tag = "<div style='width:100%;height:60px;background-color:#f1faff;border-radius:6px;padding-top:15px'>"+
                            "<label style='float:left;margin-top:5px;margin-left:20px;margin-right:10px'>휴일명</label>"+
						    "<input type='text' id='input_holiday_name' style='float:left;width:120px;border:1px solid #e9e9e9;margin-top:-5px;height:45px' >"+
                    	    "<button onclick='button_inputholiday()' style='float:right;width:80px; height:40px; border-radius:5px; background-color:#f1416c;border:0px;font-size:13px; color:#ffffff; text-align:center;font-weight:700;'>휴일추가</button>"+
                            "<input type='date' id='input_holiday_date' style='float:right;width:120px;border:1px solid #e9e9e9;margin-top:-5px;height:45px;margin-right:10px' >"+
                            "<label style='float:right;margin-top:5px;margin-left:10px;margin-right:10px'>날짜</label>"+
					    "</div>";
             
         var message = list_tag+input_tag;
         showModalDialog(document.body, "삽입한 휴일 목록", message, "수정하기", "취소", function() {    
                new_add_holiday = imsi_add_holiday;
                hideModalDialog();
             console.log("확인 new_add_holiday ",new_add_holiday);
         }, function() {
             hideModalDialog();
             console.log("취소 new_add_holiday ",new_add_holiday);
         });
     }
     function initImsiHoldingDay(){
         imsi_add_holiday = [];
         for(var i = 0 ;i  < new_add_holiday.length;i++){
             var hday = [new_add_holiday[i][0],new_add_holiday[i][1]];
             imsi_add_holiday.push(hday);             
         }
         
     }
     function button_inputholiday(){
         var input_holiday_name = document.getElementById("input_holiday_name").value;
         var input_holiday_date = document.getElementById("input_holiday_date").value;
         if(!input_holiday_name || !input_holiday_date){
             alertMsg("휴일명과 or 날짜를 제대로 입력하세요");
         }else{
             console.log("input_holiday_name "+input_holiday_name+" input_holiday_date "+input_holiday_date);
             var y = stringGetYear(input_holiday_date);
             var m = stringGetMonth(input_holiday_date);
             var d = stringGetDay(input_holiday_date);
             var _ymd = y+"_"+parseInt(m)+"_"+parseInt(d)+" ";//마지막 빈공간 필수
             
             update_custom_holiday(_ymd,input_holiday_name);
         }
         
     }
     function update_custom_holiday(_ymd,input_holiday_name){
         var isin = false;
         for(var i = 0 ; i < imsi_add_holiday.length;i++){
             if(imsi_add_holiday[i][0] == _ymd){
                 isin = true;
                 break;
             }
         }
//         for(var i = 0 ; i < uholiday.length;i++){
//              if(uholiday[i][0] == _ymd){
//                 isin = true;
//                 break;
//             }
//         }
         if(isin){
             alertMsg("해당날짜는 이미 다른 휴일로 지정되어 있습니다.");
         }
         else{
             var new_holiday = [_ymd,input_holiday_name];
             imsi_add_holiday.push(new_holiday);
             
             var table_holidaylist = document.getElementById("table_holidaylist");
            var body = table_holidaylist.getElementsByTagName("tbody")[0];
            var brow = body.insertRow();
            brow.align = "center";
            brow.style.padding = "10px";
            brow.id = "tr_homepagelist_"+i;
            brow.style.backgroundColor = "white";

            var isdelete = false;
            var isselected = true;

             var len = body.childNodes.length;
            CellInsert(brow, isdelete, isselected, len + 1); // 번호
            CellInsert(brow, isdelete, isselected, _ymd); // 요청일
            CellInsert(brow, isdelete, isselected, input_holiday_name); // 이름
//             console.log("global_centersetting.center_holiday ",global_centersetting.center_holiday);
         }
     }
     function getHolidayTable(rows) {

       
        var div_member_table = document.createElement("div");
        var table = document.createElement("table");
        div_member_table.appendChild(table);

        table.border = "1";
        table.style.width = "100%";
        table.id = "table_holidaylist";
        table.className = "table table-bordered fmont";


    //    console.log("HomePage rows ",rows);

        table.innerHTML = "<thead><tr style='background-color:#e0e9e9;font-size:12px;text-align:center;' align='center' style='margin:10px;'><th>번호</th><th>날짜</th><th>휴일이름</th></tr></thead><tfoot></tfoot><tbody></tbody>";
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var isdelete = false;
        var isselected = true;
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows ? rows.length : 0;
        if (len > 0) {
            var beforepaymentid = "";
            var isbeforesame = false;
            console.log(" len ",len);
            for (var i = 0; i < len; i++) {
                var data = rows[i];

                var brow = body.insertRow();
                brow.align = "center";
                brow.style.padding = "10px";
                brow.id = "tr_homepagelist_"+i;
                brow.style.backgroundColor = "white";


             

                CellInsert(brow, isdelete, isselected, i + 1); // 번호
                CellInsert(brow, isdelete, isselected, rows[i][0]); // 요청일
                CellInsert(brow, isdelete, isselected, rows[i][1]); // 이름

            }
        }
        return div_member_table.innerHTML;


    }
     function btn_goto_locker_click(){
         setTutorialStatus(TS._9_CREATELOCKER);
         loadMainDiv(17);
         
     }
     function check_tab_permission(){
         if(permission_list){
             
             clog("check_tab_permission!! 1 : "+isPermission(25)+" 2 : "+isPermission(26)+" 3 : "+isPermission(27));
             
              var tab1 = document.getElementById("tab1");
              var tab2 = document.getElementById("tab2");
              var tab3 = document.getElementById("tab3");
              tab1.style.display = isPermission(25) ? "block" : "none";
              tab2.style.display = isPermission(26) ? "block" : "none";
              tab3.style.display = isPermission(27) ? "block" : "none";
         }         
     }
     function update_setting() {
         console.log("update_setting !!");
         updateSetTutorialStatus();
         showModalDialog(document.body, "설정 정보 변경", "설정 정보를 수정하시겠습니까?", "수정하기", "취소", function() {             
             settingAllUpdate();
         }, function() {
             hideModalDialog();
             if(tutorial_status < TS.FINISH){
                 if(tutorial_status == TS._19_SETTINGSAVEPOPUP){
                    setTutorialStatus(TS._18_SETTINGGXLESSION); 
                 }else {
                    loadMainDiv(0);
                    updateSetTutorialStatus();    
                 }                 
             }
         });
     }

     function insertTime() {
         var time = id_selectalltime.value;
         if (time) insertXImageButton(id_alltimes, time, time + "시");
         updateXImageButton();
     }

     function updateXImageButton() {
         updateSettingTime();
     }

     function updateSettingTime() {
         var defaulttimes = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24];

         id_selectalltime.innerHTML = "<option>시간 추가하기</option>";

         var times = [];
         for (var i = 0; i < id_alltimes.children.length; i++)
             if (id_alltimes.children[i].id) times.push(parseInt(id_alltimes.children[i].id));

         var difference = defaulttimes.filter(x => !times.includes(x));
         for (var i = 0; i < difference.length; i++)
             id_selectalltime.innerHTML += "<option value='" + difference[i] + "'>" + difference[i] + "시</option>";


         sortListIntType(id_alltimes, false);

         var times = [];
         for (var i = 0; i < id_alltimes.children.length; i++) {
             times.push(parseInt(id_alltimes.children[i].id));
         }
         mreservationinfo.opentimes = times;

     }

//     function remove_class(idx) {
//         var len = table_body.children.length;
//         for (var i = 0; i < table_body.children.length; i++) {
//             if (i == idx) {
//                 //                    table_body.removeChild(table_body.children[i]);
//                 mreservationinfo.classes.splice(i, 1);
//                 break;
//             }
//         }
//
//
//         updateTableBody();
//     }

     function remove_levelclass(idx) {
         var len = table_levelbody.children.length;
         for (var i = 0; i < table_levelbody.children.length; i++) {
             if (i == idx) {
                 //                    table_body.removeChild(table_body.children[i]);
                 msetting.pricerule.splice(i, 1);
                 break;
             }
         }


         updateTableLevelBody();
     }

     function updateTableBody() {
         table_body.innerHTML = "";
         
         //주말및공휴일 예약제외
         var holiday_reservation_0 = document.getElementById("holiday_reservation_0");
         var holiday_reservation = mreservationinfo.holiday_reservation ? parseInt(mreservationinfo.holiday_reservation) : 0;
         if(holiday_reservation)
            holiday_reservation_0.checked = holiday_reservation && holiday_reservation == 0 ? false : true;
         gxtogglechange("holiday_reservation",0);
         
         
         for (var i = 0; i < mreservationinfo.classes.length; i++) {
             var cls = mreservationinfo.classes[i];
             var detailname = cls.detailname ? cls.detailname  : "";
             var gxmaxreservation = cls.gxmaxreservation ? cls.gxmaxreservation  : "";
             var push = cls.push && parseInt(cls.push) == 1 ? "checked" : "";
             var push_onoff = cls.push && parseInt(cls.push) == 1 ? "&nbsp;ON" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
             var push_color = cls.push && parseInt(cls.push) == 1 ? "white" : "white";
             
             var autocheckin = cls.gxautocheckin && parseInt(cls.gxautocheckin) == 1 ? "checked" : "";
             var autocheckin_onoff = cls.gxautocheckin && parseInt(cls.gxautocheckin) == 1 ? "&nbsp;ON" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
             var autocheckin_color = cls.gxautocheckin && parseInt(cls.gxautocheckin) == 1 ? "white" : "white";
             
             var autoreadyin = cls.gxautoreadyin && parseInt(cls.gxautoreadyin) == 1 ? "checked" : "";
             var autoreadyin_onoff = cls.gxautoreadyin && parseInt(cls.gxautoreadyin) == 1 ? "&nbsp;ON" : "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
             var autoreadyin_color = cls.gxautoreadyin && parseInt(cls.gxautoreadyin) == 1 ? "white" : "white";
             
             var maxreservation = cls.gxmaxreservation && parseInt(cls.gxmaxreservation) > 0 ? parseInt(cls.gxmaxreservation) : 0;
             var foot_maxgx_reservation = document.getElementById("foot_maxgx_reservation");
             if(foot_maxgx_reservation) foot_maxgx_reservation.value = maxreservation;
             var gxopentime = cls.gxopentime  ? cls.gxopentime : "open_now";
             
             
            
             clog("mreservationinfo.classes[i].type ",mreservationinfo);
             var type_tag = cls.type == "PT" ? "<select id='select_type_"+i+"' style='width:68px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; padding-right:10px;font-size: 13px;  color:#5e6278;font-weight:700;text-align:left;'><option value='PT' selected>PT</option></select>" : "<select id='select_type_"+i+"' style='width:68px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px; padding-right:10px;font-size: 13px;  color:#5e6278;font-weight:700;text-align:left;'><option value='GX'  selected>GX</option></select>";
             var detailname_tag = "<input id='input_detailname_"+i+"' value='"+detailname+"'  style='width:165px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;'>";
            
             var arr_open_options = [{"val":"open_sunday","text":"오픈전 일요일 0시"},{"val":"open_monday","text":"오픈전 월요일 0시"},{"val":"open_tuesday","text":"오픈전 화요일 0시"},{"val":"open_wednesday","text":"오픈전 수요일 0시"},{"val":"open_thursday","text":"오픈전 목요일 0시"},{"val":"open_friday","text":"오픈전 금요일 0시"},{"val":"open_saturday","text":"오픈전 토요일 0시"},{"val":"open_1day","text":"오픈일 1일전"},{"val":"open_2day","text":"오픈일 2일전"},{"val":"open_3day","text":"오픈일 3일전"},{"val":"open_4day","text":"오픈일 4일전"},{"val":"open_5day","text":"오픈일 5일전"},{"val":"open_6day","text":"오픈일 6일전"},{"val":"open_7day","text":"오픈일 7일전"},{"val":"open_now","text":"즉시오픈"}];
             
             var opentime_options_tag = "";
             for(var j = 0 ; j < arr_open_options.length;j++){
                 var open_options = arr_open_options[j];
                 var selected = open_options.val == gxopentime ? "selected" : "";
                 opentime_options_tag += "<option value = '"+open_options.val+"' "+selected+">"+open_options.text+"</option>";
             }
//             clog("opentime_options_tag ",opentime_options_tag);
             //[GX]푸시보내기	[GX]자동출석	[GX]대기후자동예약	[GX]예약횟수제한
             var gxtag = cls.type == "PT" ? "<td style='border:1px solid #e7e7e7;'></td><td style='border:1px solid #e7e7e7;'></td><td style='border:1px solid #e7e7e7;'></td><td style='border:1px solid #e7e7e7;'></td>" : "<td style='border:1px solid #e7e7e7;'>"+
//                "<label style='font-size:16px'>푸시사용</label>"+
                "<label class='switch' style='margin-top:10px;zoom:0.8'>"+
                    "<input id='togglepush_"+i+"' type='checkbox' onchange='gxtogglechange( \"togglepush\","+i+")' "+push+">"+
                    "<span id='togglepush_span_"+i+"' class='slider round'>"+
                        "<text class='fmont' id='togglepush_txt_"+i+"' style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:"+push_color+"'>"+push_onoff+"</text>"+
                    "</span>"+
                "</label>"+
             "</td>"+
             "<td style='border:1px solid #e7e7e7;'>"+
//                "<label style='font-size:16px'>자동출석</label>"+
                "<label class='switch' style='margin-top:10px;zoom:0.8'>"+
                    "<input id='toggleautocheckin_"+i+"' type='checkbox' onchange='gxtogglechange( \"toggleautocheckin\","+i+")' "+autocheckin+">"+
                    "<span id='toggleautocheckin_span_"+i+"' class='slider round'>"+
                        "<text class='fmont' id='toggleautocheckin_txt_"+i+"' style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:"+autocheckin_color+"'>"+autocheckin_onoff+"</text>"+
                    "</span>"+
                "</label>"+
             "</td>"+
             "<td style='border:1px solid #e7e7e7;'>"+
//                "<label style='font-size:16px'>자동예약</label>"+
                "<label class='switch' style='margin-top:10px;zoom:0.8'>"+
                    "<input id='toggleautoreadyin_"+i+"' type='checkbox' onchange='gxtogglechange( \"toggleautoreadyin\","+i+")' "+autoreadyin+">"+
                    "<span id='toggleautoreadyin_span_"+i+"' class='slider round'>"+
                        "<text class='fmont' id='toggleautoreadyin_txt_"+i+"' style='float:left;font-size:13px;font-weight:500;margin-top:8px;z-index:3;color:"+autoreadyin_color+"'>"+autoreadyin_onoff+"</text>"+
                    "</span>"+
                "</label>"+
             "</td>"+
//             "<td>"+
//                "1주당<input id='maxgx_reservation_"+i+"' type='number'/ value='"+maxreservation+"' style='max-width:25px'>회"+
//             "</td>"+
             "<td style='border:1px solid #e7e7e7;'>"+
                "<select id='gxopentime_"+i+"' style='font-size:14px;width:148px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;'>"+
                   opentime_options_tag+
                "</select>"+
            "</td>";
             
             var closetag = cls.type == "PT" ? "<td style='border:1px solid #e7e7e7;'></td>" : "<td style='border:1px solid #e7e7e7;'><img src='./img/button_delete_list.png' onclick='remove_reservationinfo("+i+")'/></td>";
             clog("cls ",cls);
//             var btnhtml = mreservationinfo.type == "PT" ? "" : "<button onclick='remove_class(" + i + ")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button>";
             var input_reservationtime_tag = cls.type == "PT" ? "<td style='border:1px solid #e7e7e7;'></td>" : "<td style='border:1px solid #e7e7e7;'><input id='input_reservationtime_" + i + "' type='number' value='" + cls.insertmaxtime + "'  style='width:48px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;'/>분전</td>";
             var input_canceltime_tag = cls.type == "PT" ? "<td style='border:1px solid #e7e7e7;'></td>" : "<td style='border:1px solid #e7e7e7;'><input id='input_canceltime_" + i + "' type='number' value='" + cls.canceltime + "'  style='width:48px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;'/>분전</td>";
              var max_gx_reservation_tag = cls.type == "PT" ? "</td><td style='border:1px solid #e7e7e7;'>" : "<td style='border:1px solid #e7e7e7;'>주당<input type='number' id='maxgx_reservation_"+i+"'value='"+gxmaxreservation+"'  style='width:33px; height:33px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;'/>회</td>";
             table_body.innerHTML += "<tr style='height:70px'><td style='border:1px solid #e7e7e7;'>"+type_tag+"</td><td style='border:1px solid #e7e7e7;'>" + cls.name + "</td><td style='border:1px solid #e7e7e7;'>" + detailname_tag + "</td><td style='border:1px solid #e7e7e7;'>최대<input id='input_max_member_" + i + "' type='number' value='" + cls.max + "'  style='width:33px; height:38px; background-color:#ffffff; border-radius:5px; border:1px solid #d9dced; padding-left:10px;padding-right:10px;'/>명</td>"+
               input_reservationtime_tag+input_canceltime_tag+max_gx_reservation_tag+gxtag+closetag;
//             "<td style='width:170px'>" + btnhtml + "</td></tr>";
         }
     }

     function updateTableLevelBody() {
         //       table_levelbody.innerHTML = "";
         //       if(msetting && msetting.pricerule){
         //           clog("msetting ",msetting);
         //           var len = msetting.pricerule.length;
         //           for(var i = 0 ; i < len;i++){
         //               var level = i+1;
         //               var rule = msetting.pricerule[i];
         //    //           clog("cls.next_starttime is "+cls.next_starttime);
         //               var btnhtml = "<button onclick='remove_levelclass("+i+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button>";
         //
         //               table_levelbody.innerHTML += "<tr><td><label id='pricerule_level_"+i+"'>"+level+"</label></td><td><input id='pricerule_percent_"+i+"' type='number' value='"+rule.percent+"' style='width:100px;margin-top:5px'/>&nbsp;%</td><td><input id='pricerule_price_"+i+"' type='number' value='"+rule.price+"' style='width:120px;margin-top:5px'/>&nbsp;￦</td><td style='width:500px'><text value='"+rule.note+"' style='margin-top:5px'>"+rule.note+"</text></td><td style='width:170px'>"+btnhtml+"</td></tr>";
         //           }
         //           var foot_level = document.getElementById("foot_level")
         //           if(foot_level)foot_level.innerHTML = (len+1)+"";
         //       }
         //       
     }

     function add_class() {
         var foot_name = document.getElementById("foot_name").value;
         var foot_detailname = document.getElementById("foot_detailname").value;
         var foot_type = document.getElementById("foot_type").value;
         var foot_max = document.getElementById("foot_max").value;
         var foot_insertmaxtime = document.getElementById("foot_insertmaxtime").value;
         var foot_canceltime = document.getElementById("foot_canceltime").value;
         var foot_togglepush_0 = document.getElementById("foot_togglepush_0") && document.getElementById("foot_togglepush_0").checked ? 1 : 0;
         var foot_toggleautocheckin_0 = document.getElementById("foot_toggleautocheckin_0") && document.getElementById("foot_toggleautocheckin_0").checked ? 1 : 0;
         var foot_toggleautoreadyin_0 = document.getElementById("foot_toggleautoreadyin_0") && document.getElementById("foot_toggleautoreadyin_0").checked ? 1 : 0;
         var foot_maxgx_reservation = document.getElementById("foot_maxgx_reservation") ? parseInt(document.getElementById("foot_maxgx_reservation").value) : 0;
         var foot_gxopentime = document.getElementById("foot_gxopentime") ? document.getElementById("foot_gxopentime").value : "open_now";
         //        clog("foot_name "+foot_name+" foot_max "+foot_max+" foot_starttime "+foot_starttime+" foot_endtime "+foot_endtime);

         var len = table_body.children.length;

         var mid = 0;
         for (var i = 0; i < mreservationinfo.classes.length; i++) {
             var id = parseInt(mreservationinfo.classes[i].id);
             if (id > mid) mid = id;
         }

         var cls = {
             "id": mid + 1,
             "name": foot_name,
             "detailname": foot_detailname,
             "type": foot_type,
             "max": parseInt(foot_max),
             "insertmaxtime" : foot_insertmaxtime,
             "canceltime" : foot_canceltime,
             "push" : foot_togglepush_0, //푸시보내기
             "gxautocheckin" : foot_toggleautocheckin_0,
             "gxautoreadyin" : foot_toggleautoreadyin_0,
             "gxmaxreservation" : foot_maxgx_reservation,
             "gxopentime" : foot_gxopentime,
             "openid": 1,   //사용하지 않음
             "next_openid": 2, //사요아지 않음 
             "next_starttime": "2022-1-1 00:00:00", //최대범위 사용하지 않음
             "next_endtime": "3025-12-31 23:59:59"  //최대범위 사용하지 않음
         };


         if (foot_type == "GX" && foot_name && foot_max && foot_insertmaxtime && foot_canceltime  || foot_type == "PT" && foot_name && foot_max) {
             mreservationinfo.classes.push(cls);
             updateTableBody();
             //            table_body.innerHTML += "<tr><td>"+foot_name+"</td><td><input type='number' value='"+foot_max+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_starttime+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_endtime+"' style='margin-top:5px'/></td><td style='width:170px'><button onclick='remove_class("+len+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button></td></tr>";    
         } else {
             alert("입력되지 않은 부분이 있습니다. ");
         }

     }

     function add_levelclass() {
         var foot_level = document.getElementById("foot_level");
         var foot_percent = document.getElementById("foot_percent").value;
         var foot_price = document.getElementById("foot_price").value;
         var foot_note = document.getElementById("foot_note").value;
         clog("foot_level " + foot_level + " foot_percent " + foot_percent + " foot_price " + foot_price + " foot_note " + foot_note);
         clog("")
         var len = table_levelbody.children.length;
         var flevel = len + 1;
         foot_level.innerHTML = flevel + "";


         var rule = {
             "level": flevel,
             "percent": foot_percent,
             "price": foot_price,
             "note": foot_note
         };


         if (msetting && !msetting.pricerule)
             msetting["pricerule"] = [];





         if (foot_percent && foot_price && foot_note) {
             if (parseInt(foot_percent) > 300) {
                 alert("300% 이상은  설정할 수 없습니다.");
                 return;
             }

             msetting.pricerule.push(rule);
//             msetting.pricerule.sort(sort_by('price', false, (a) => a.toUpperCase()));
             msetting.pricerule = new_sort(msetting.pricerule,"price",true);
             updateTableLevelBody();
             clog("msetting ", msetting);
             //            table_body.innerHTML += "<tr><td>"+foot_name+"</td><td><input type='number' value='"+foot_max+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_starttime+"' style='margin-top:5px'/></td><td><input type='date' value='"+foot_endtime+"' style='margin-top:5px'/></td><td style='width:170px'><button onclick='remove_class("+len+")' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;margin-right:40px;'>삭제</button></td></tr>";    
         } else {
             alert("입력되지 않은 부분이 있습니다. ");
         }

     }

     function foot_date_onchange() {
         var today = getToday();
         var foot_starttime = document.getElementById("foot_starttime");
         var foot_endtime = document.getElementById("foot_endtime");
         clog("today " + today + " starttime " + foot_starttime);

         if (foot_starttime) {
             var sday = getDay(today, foot_starttime.value);
             if (sday < 0) {
                 alert("오늘 이전 날짜는 설정할 수 없습니다.");
                 foot_starttime.value = "";
             }

         }

         if (foot_starttime.value && foot_endtime.value) {
             var dday = getDay(foot_starttime.value, foot_endtime.value);
             if (dday < 0) {
                 alert("종료일이 시작일보다 작습니다.종료일을 다시 설정하여 주세요");
                 foot_endtime.value = "";
             }
         }
         foot_starttime = document.getElementById("foot_starttime").value;
         foot_endtime = document.getElementById("foot_endtime").value;
     }

     function updateReservationClasses() {
         clog("mreservationinfo ",mreservationinfo);
         for (var i = 0; i < mreservationinfo.classes.length; i++) {
             clog("i "+i);
             var input_type = document.getElementById("select_type_" + i);
             var input_detailname = document.getElementById("input_detailname_" + i);
             var input_max_member = document.getElementById("input_max_member_" + i);
            
             var input_reservationtime = document.getElementById("input_reservationtime_" + i);
             var input_canceltime = document.getElementById("input_canceltime_" + i);
             
             var input_push =  document.getElementById("togglepush_" + i) && document.getElementById("togglepush_" + i).checked ? 1 : 0;
             var input_autocheckin = document.getElementById("toggleautocheckin_" + i) && document.getElementById("toggleautocheckin_" + i).checked ? 1 : 0;
             var input_autoreadyin = document.getElementById("toggleautoreadyin_" + i) && document.getElementById("toggleautoreadyin_" + i).checked ? 1 : 0;
             var input_maxreservation = document.getElementById("maxgx_reservation_"+i) ? parseInt(document.getElementById("maxgx_reservation_"+i).value) : 0;
             var input_gxopentime = document.getElementById("gxopentime_" + i) ? document.getElementById("gxopentime_" + i).value : "open_now";

             mreservationinfo.classes[i].detailname = input_detailname ? input_detailname.value : "";
             mreservationinfo.classes[i].max = input_max_member ? input_max_member.value : 2;
             mreservationinfo.classes[i].insertmaxtime = input_reservationtime ? input_reservationtime.value : "60";
             mreservationinfo.classes[i].canceltime = input_canceltime ? input_canceltime.value : "60";
             mreservationinfo.classes[i].type = input_type.value;

             mreservationinfo.classes[i].push = input_push;
             mreservationinfo.classes[i].gxautocheckin = input_autocheckin;
             mreservationinfo.classes[i].gxautoreadyin = input_autoreadyin;
             mreservationinfo.classes[i].gxmaxreservation = input_maxreservation;
             mreservationinfo.classes[i].gxopentime = input_gxopentime;
             
             mreservationinfo.classes[i].next_openid = "1";
             mreservationinfo.classes[i].next_starttime = "2022-1-1 00:00:00";
             mreservationinfo.classes[i].next_endtime = "3025-12-31 23:59:59";
         }
     }

     function settingAllUpdate() {

         updateReservationClasses();
//         var locker_num_start = parseInt(id_lockercount_start.value);
//         var locker_num_end = parseInt(id_lockercount_end.value);

         var monthprice = parseInt(id_lockermonthprice.value);
         var dayprice = parseInt(id_lockerdayprice.value);
         var sendprice = parseInt(id_sendprice.value)
//         mreservationinfo.insertmaxtime = parseInt(id_inserttime.value);
//         mreservationinfo.canceltime = parseInt(id_canceltime.value);
         var holiday_reservation = document.getElementById("holiday_reservation_0") && document.getElementById("holiday_reservation_0").checked ? 1 : 0;
         mreservationinfo.holiday_reservation = holiday_reservation;
         if (allsetting.reservation_info.length > 0) allsetting.reservation_info[0] = mreservationinfo;

         var value = {};
//         value.lockernumstart = locker_num_start;
//         value.lockernumend = locker_num_end;
         value.monthprice = monthprice;
         value.dayprice = dayprice;
         value.sendprice = sendprice;
         value.reservationinfo = allsetting.reservation_info;
         value.centerdesc = id_centerdesc.value;
         //value.vat = id_cardvat.value;  //neel_vat0
         value.vat = 0;  //neel_vat0
         value.center_holiday = new_add_holiday;
//         value.setting = msetting;  //트레이너 강사설정으로 따로 이동함
         console.log("value is ",value);
         var groupcode = getData("nowgroupcode");
         var centercode = getData("nowcentercode");

         var senddata = {
             groupcode: groupcode,
             centercode: centercode,
             type: "setsetting",
             value: value
         };
         clog("senddata ",senddata);
         CallHandler("adm_get", senddata, function(res) {
                         clog("setsettingres is ",res);
             
//             clog("00 global_vat "+global_vat);
             
             if (res.code == 100) {
                 global_vat = parseInt(value.vat);
//                 clog("11 global_vat "+global_vat);
                 C_showToast("설정완료!", "성공적으로 설정하였습니다.", function() {});
                 
                 checkTutorialStatus(value);
                 
                 if(new_add_holiday != global_centersetting.center_holiday)location.href = location.href;
             } else {
                 C_showToast("설정불가!", "" + res.message, function() {});
             }
             hideModalDialog();
         }, function(err) {
             C_showToast( "설정불가!", "" + res.message, function() {});
             hideModalDialog();
         });

     }
     function checkTutorialStatus(value){
         var isgxinfo = false;
         if(value.reservationinfo && value.reservationinfo[0] && value.reservationinfo[0].classes)
         for(var i = 0 ; i < value.reservationinfo[0].classes.length; i++){
             if(value.reservationinfo[0].classes[i].type == "GX"){
                 isgxinfo = true;
                 break;
             }                         
         }

         if(tutorial_status < TS.FINISH){
             if(tutorial_status == TS._19_SETTINGSAVEPOPUP){
                 if(isgxinfo){
                    loadMainDiv(0);
                    updateSetTutorialStatus();    
                 }else {
                    setTutorialStatus(TS._18_SETTINGGXLESSION); 
                 }
             }else {
                loadMainDiv(0);
                updateSetTutorialStatus();     
             }
         }
     }
     function set_all_delay() {
         var id_delaygrouptype = document.getElementById("id_delaygrouptype");
         var txt_delaygrouptype = id_delaygrouptype.options[id_delaygrouptype.selectedIndex].text;
         var day = document.getElementById("id_delayday").value;
         var note = document.getElementById("id_delaynote").value;
         var clist = document.getElementsByClassName("delay_checkboxgroup");
         
         var list = [];
         for (var i = 0; i < clist.length; ++i) {
             if (clist[i].checked) {
                 if (clist[i].value == "기타") {
                     list.push(edittext_other);
                 } else
                     list.push(clist[i].value);
             }
         }

         if (!id_delaygrouptype || !day || !note || list.length == 0) {
             if (!id_delaygrouptype)
                 alertMsg("그룹을 선택해주세요");
             else if (!day)
                 alertMsg("연장일수를 선택해주세요");
             else if (!day)
                 alertMsg("연장사유를 적어주세요");
             else if (list.length == 0)
                 alertMsg("연장항목을 최소 1개 이상 선택해 주세요");

             return;
         }
         
         var c1_checked = clist[0] && clist[0].checked ? "checked" : "";
         var c2_checked = clist[1] && clist[1].checked ? "checked" : "";
         
//         var tag = "<label >※전체기간연장하기&nbsp;<img src='./img/ques_20.png' title='*센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...)' style='margin-top:-4px;'/></label><br>" +
//             "<div class = 'form-control' style ='height:auto'>" +
//                 "<div>" +
//                     "<label class='textevent' for='id_delaygrouptype' align='left'>그룹</label><br>" +
//                     "<label class='form-control' align='left'>"+txt_delaygrouptype+"</label><br>" +                     
//                  "</div>" +
//                  "<div>" +
//                     "<label class='textevent'  align='left'>연장일수</label>" +
//                    "<label class='form-control' align='left'>"+day+"</label><br>" +    
//                  "</div>" +
//                  "<div>" +
//                     "<label class='textevent'  align='left'>연장사유</label>" +
//                     "<label class='form-control' align='left'>"+note+"</label><br>" +    
//                  "</div>" +
//                  "<div>" +
//                     "<label class='textevent'  align='left'>연장항목</label>" +
//                  "</div>" +
//                  "<div>" +
//                     "<div class='form-control' name='subscription_path'>" +                 
//                        "<input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='1' "+c1_checked+" disabled>&nbsp;수강항목&nbsp;&nbsp;&nbsp;" +
//                        "<input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='2' "+c2_checked+" disabled>&nbsp;라커항목&nbsp;&nbsp;&nbsp;" +
//
//                     "</div>" +                                      
//                  "</div>" +                                      
//             "</div>";

         //연장신청 정보 테이블
          var tag = 
               
              "<table style='width:100%;height:auto'>" +
                        "<tr>" +
                            "<td style='border-bottom:1px solid #eff2f5;width:140px;height:65px;background-color:#f5f6f8;padding-left:30px;font-size:15px;font-weight:500;border:1px solid #eff2f5'>" +
                                "그룹" +
                            "</td>" +
                            "<td  style='border-top:1px solid #eff2f5;border-bottom:1px solid #eff2f5;'>" +
                                "<input class='fmont' style='width:295px;height:45px;border:0px;border-radius:5px;background-color:#f5f8fa;margin-left:30px;padding-left:30px;padding-right:15px;font-weight:400;font-size:14px' value='"+txt_delaygrouptype+"' disabled>"+
                            "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td style='border-bottom:1px solid #eff2f5;width:140px;height:65px;background-color:#f5f6f8;padding-left:30px;font-size:15px;font-weight:500;border:1px solid #eff2f5'>" +
                                "연장일수" +
                            "</td>" +
                            "<td  style='border-top:1px solid #eff2f5;border-bottom:1px solid #eff2f5;'>" +
                               
                                "<input class='fmont' style='width:295px;height:45px;border:0px;border-radius:5px;background-color:#f5f8fa;margin-left:30px;padding-left:30px;padding-right:15px;font-weight:400;font-size:14px'  value='"+day+"' disabled>"+
                            "</td>" +
                            
                        "</tr>" +
                        "<tr>" +
                            "<td style='border-bottom:1px solid #eff2f5;width:140px;height:65px;background-color:#f5f6f8;padding-left:30px;font-size:15px;font-weight:500;'>" +
                                "연장사유" +
                            "</td>" +
                            "<td  style='border-bottom:1px solid #eff2f5;'>" +
                                 "<input class='fmont' style='width:295px;height:45px;border:0px;border-radius:5px;background-color:#f5f8fa;margin-left:30px;padding-left:30px;padding-right:15px;font-weight:400;font-size:14px'  value='"+note+"' disabled>"+
                            "</td>" +
                        "</tr>" +
                        "<tr>" +
                            "<td style='border-bottom:1px solid #eff2f5;width:140px;height:65px;background-color:#f5f6f8;padding-left:30px;font-size:15px;font-weight:500;border:1px solid #eff2f5'>" +
                                "연장항목" +
                            "</td>" +
                            "<td style='border-top:1px solid #eff2f5;border-bottom:1px solid #eff2f5;'>" +
              
                             
              
              
                                "<div align='center' class='fmont' style='padding-top:10px;padding-left:800px;width:295px;height:45px;border:0px;border-radius:5px;background-color:#f5f8fa;margin-left:30px;padding-left:30px;font-weight:400;font-size:14px' >"+
                                    "<span style='float:left;'><label class='mycheckbox'><input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='1' "+c1_checked+" disabled><span class='checkmark'></span></label></span>"+
									"<span style='float:left;'><text >수강항목&nbsp;&nbsp;&nbsp;</text></span>"+
                                	"<span style='float:left;'><label class='mycheckbox'><input class='delay_checkboxgroup' type='checkbox' name='chk_info' value='2' "+c2_checked+" disabled><span class='checkmark'></span></label></span>"+
									"<span style='float:left;'><text >라커항목&nbsp;&nbsp;&nbsp;</text></span>"+
                                "</div>"+
                            "</td>" +
                        "</tr>" +
                "</table>";
         
         var push_tag =
                "<br><br><div id='div_pushmessage' style='display:none'>" +
                    "<div style='width:100%;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px'><label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>제목</label></div>" +
                    "<input type='text' class='form-control' id='id_pushtitle' name='id_title' placeholder='메세지 제목을 입력하세요' required /><br>" +
                    "<div style='width:100%;background-color:f4f8fb;border:1px solid #e9e9e9;height:40px;padding-top:7px'><label style='font-size:14px; color:#3f4254; text-align:left; font-weight:500;'>메세지 내용</label></div>" +
                    "<textarea id='id_pushmessage' class='form-control' name='id_message' placeholder='메세지 내용을 입력하세요..' style='height:140px; ' required></textarea><br>" +
                    "<p align='right'></p>" +
                "</div>";
         
         var table_tag = "<label >※선택한 내용으로 전체기간을 연장하시겠습니까?&nbsp;&nbsp;<img src='./img/ques_20.png' title='*센터에서 특별한 사유로 인하여 기간을 연장하는 기능입니다. (센터휴업 ,내부수리 ,코로나연장 ,기타 등등...)' style='margin-top:4px;'/></label><br>" + 
                         "<div id='div_mmain' align='center' style='margin-top:20px;height:auto;font-size:15px;font-weight:500;color#3f4254;border:1px solid #eff2f5;border-radius:10px;padding:10px'>"+
                             tag+
                              "</div><br>"+
                              "<text id='toggle_title_request' style='color:gray;float:left;font-size:14px;font-weight:500;margin-top:10px;'>연장회원 푸시보내기&nbsp;&nbsp;</text><text style='float:right;color:red;margin-top:10px;'>※예약어 #{이름} , #{고객번호} 사용가능</text>"+
                                    "<label class='switch' style='float:left;margin-top:4px'>"+
                                        "<input id='toggle_request' type='checkbox' onchange='popup_togglechange()'>"+
                                        "<span  id='toggle_icon_request'  class='slider round'>"+
                                            "<text class='fmont' id='toggle_txt_request'style='color:white;float:left;font-size:14px;font-weight:400;margin-top:8px;margin-left:26px'></text>"+
                                        "</span>"+
                                    "</label>"+
                              "</span>"+
                              push_tag+    
                         "<div class='fmont' id='div_mmain_addarea' align='center' style='margin-top:-40px;width:450px;height:auto;font-size:15px;font-weight:500;color#3f4254;'></div><br><br>";
         
         
         showModalDialog(document.body, "전체기간 연장하기", table_tag, "연장하기", "취소", function() {
             var delaygrouptype = id_delaygrouptype.value;
             
             var toggle_request_checkd = document.getElementById("toggle_request").checked;
             var push_title  = document.getElementById("id_pushtitle").value;
             var push_message  = document.getElementById("id_pushmessage").value;
             
            
             var list = [];
             for (var i = 0; i < clist.length; ++i) {
                 if (clist[i].checked) {
                     if (clist[i].value == "기타") {
                         list.push(edittext_other);
                     } else
                         list.push(clist[i].value);
                 }
             }

             if (!delaygrouptype || !day || !note || list.length == 0) {
                 if (!delaygrouptype)
                     alertMsg("그룹을 선택해주세요");
                 else if (!day)
                     alertMsg("연장일수를 선택해주세요");
                 else if (!note)
                     alertMsg("연장사유를 적어주세요");
                 else if (list.length == 0)
                     alertMsg("연장항목을 최소 1개 이상 선택해 주세요");

                 return;
             }

             var value = {
                 delaygrouptype: delaygrouptype,
                 day: parseInt(day),
                 note: note,
                 delaygroups: list
             }
             var addtag = "";
             if(toggle_request_checkd){
                 
                 addtag = "<br><br><푸시메세지><br><div class='form-control' style='height:300px'><label style='float:left'>제목 : "+push_title+"</label><br><hr style='border: solid 1px #eff2f5;'>"+"<label style='float:left'>내용 : </label><textarea style='width:100%;height:200px;background-color:#f5f8fa;border:0px;' disabled >"+push_message+"</textarea><br></div>";
                 value.pushtitle = push_title;
                 value.pushmessage = push_message;
             }else {
                 value.pushtitle = "";
                 value.pushmessage = "";
             }
             
             showModalDialog(document.body, "※경고", "※ 전체기간을 정말 연장하시겠습니까?"+addtag, "연장하기", "취소", function() {
                 delayEndtimeAllUsers(value);


             }, function() {
                 hideModalDialog();
                 hideModalDialog();

             });

         }, function() {
             hideModalDialog();

         });

     }

     function show_all_delay() {

         var groupcode = getData("nowgroupcode");
         var centercode = getData("nowcentercode");

         var senddata = {
             groupcode: groupcode,
             centercode: centercode,
             type: "getdelayallusers"

         };
         CallHandler("adm_get", senddata, function(res) {
             //            clog("setsettingres is ",res);
             if (res.code == 100) {
                 showDelayData(res.message);
             } else {
                 alertMsg(res.message);
             }

         }, function(err) {
             C_showToast( "에러!", "" + err, function() {});
             hideModalDialog();
         });
     }

     function showDelayData(rows) {


         //array_push($teacher_reservation[$i]["myusers"], array("uid" => $m_uid, "userid"=>$m_userid,"name"=>$m_username, "starttime" => $pt_starttime,  "endtime" => $pt_endtime, "ornerstatus" => $orner_status, "couponid" => $couponid));//1.트레이너지정 , 2PT/
         //uid, id, name , starttime , endtime , ornerstatus , couponid , 

         if (!rows || rows && rows.length == 0) {
             //            C_showToast( "연장기간", "목록이 없습니다.", function() {});
             alertMsg("목록이 없습니다.");
             return;
         }

         var div_member_table = document.getElementById("div_member_table");
         var table = document.getElementById('memberTable'); //등록일 = couponid                               
         table.innerHTML = "<thead><tr style='background-color:#f8f9fa'><th>순번</th><th>날짜</th><th>이름</th><th>타입</th><th>연장일수</th><th>연장항목</th><th>연장사유</th><th>푸시메세지</th></tr></thead><tfoot></tfoot><tbody></tbody>";
         var head = table.getElementsByTagName("thead")[0];
         var body = table.getElementsByTagName("tbody")[0];
         var foot = table.getElementsByTagName("tfoot")[0];
         var len = rows.length;

         if (len > 0) {
             //            for(var j = 0 ; j < 100 ; j++)//test
             for (var i = 0; i < len; i++) {



                 var brow = body.insertRow();
                 var mdate = rows[i]["date"]; // 날짜
                 var useruid = rows[i]["uid"]; //uid
                 var username = rows[i]["name"]; // 이름
                 var delaygrouptype = rows[i]["delaygrouptype"]; // 연장타입
                 var changeday = rows[i]["changeday"]; //연장일수 
                 var encode_delaygroups = JSON.parse(rows[i]["encode_delaygroups"]); //연장항목 []
                 var note = rows[i]["note"]; // 내용

                 var pushtitle = rows[i]["pushtitle"]; // 푸시타이틀
                 var pushmessage = rows[i]["pushmessage"]; // 푸시내용

                 var txt_type = ["", "유효회원 전체", "종료회원 전체", "모든 회원"];
                 var txt_groups = ["", "수강항목", "라커항목", ""];

                 // 인덱스
                 var bcell_index = brow.insertCell();
                 bcell_index.innerHTML = (i + 1) + "";
                 bcell_index.style.maxWidth = "30px";

                 //수정날짜
                 var bcell_datetime = brow.insertCell();
                 bcell_datetime.innerHTML = mdate ? mdate.substring(0, 10) : "";


                 // 이름               
                 var bcell_name = brow.insertCell();
                 bcell_name.innerHTML = "<button class='btn btn-primary btn-raised' onclick='getMyUserInfo(\"" + useruid + "\")' style='background-color:#116666' >" + username + "</button>";


                 //연장타입
                 var bcell_type = brow.insertCell();
                 bcell_type.innerHTML = txt_type[parseInt(delaygrouptype)];

                 //연장일수
                 var bcell_day = brow.insertCell();
                 bcell_day.innerHTML = changeday+" 일";

                 //연장항목 []
                 var bcell_delaygroup = brow.insertCell();
                 var str_groups = "";
                 for (var a = 0; a < encode_delaygroups.length; a++) {
                     if (a == 0)
                         str_groups += txt_groups[parseInt(encode_delaygroups[a])];
                     else
                         str_groups += "," + txt_groups[parseInt(encode_delaygroups[a])];
                 }
                 bcell_delaygroup.innerHTML = str_groups;


                 //내용
                 var bcell_note = brow.insertCell();
                 bcell_note.innerHTML = note;
                 
                 //푸시메세지
                 var bcell_push = brow.insertCell();
                 bcell_push.innerHTML = "<span style='color:#009ef7'>제목</span><br>"+pushtitle+"<br><span style='color:#009ef7'>내용</span><br>"+pushmessage;

             }
         }
//         $('#memberTable').DataTable();

         var style = {
             bodycolor: "#ffffff",
             size: {
                 width: "90%",
                 height: "100%"
             }
         };
         showModalDialog(document.body, "기간연장 목록", div_member_table.innerHTML, "확인", null, function() {
             hideModalDialog();

         }, function() {}, style);

     }

     function delayEndtimeAllUsers(value) {
         var groupcode = getData("nowgroupcode");
         var centercode = getData("nowcentercode");

         var senddata = {
             groupcode: groupcode,
             centercode: centercode,
             type: "delayallusers",
             value: value
         };
         CallHandler("adm_get", senddata, function(res) {
                         clog("setsettingres is ",res);
             if (res.code == 100) {
                 //푸시를 보냄 토큰 array를 리턴함
                 
                 if(res.message && res.message.tokens && res.message.tokens.length > 0){
                     C_showToast("설정완료!", "성공적으로 설정하였습니다.", function() {});
                     hideModalDialog();
                     hideModalDialog();   
//                     push_check(res.message);
                    
                     var pushdata = res.message;
                     var len = pushdata.tokens.length;
                     sendReservationPushMessages(getToday(), pushdata, len);
                 }
                 //푸시를 보내지 않음
                 else {
                    C_showToast("설정완료!", "성공적으로 설정하였습니다.", function() {});
                    hideModalDialog();
                    hideModalDialog();    
                 }
                 
             } else {
                 C_showToast( "설정불가!", "" + res.message, function() {});
             }
             
         }, function(err) {
             C_showToast( "에러!", "" + err, function() {});
             hideModalDialog();
             hideModalDialog();
         });
     }

     function change_default_setting() {
         var default_t = document.getElementById("default_t"); //트레이너
         var default_m = document.getElementById("default_m"); //점장
         var default_tl = document.getElementById("default_m"); //팀장
         var default_o = document.getElementById("default_o"); //운영자

         if (default_t.checked) default_setting_index = 1;
         if (default_m.checked) default_setting_index = 2;
         if (default_m.checked) default_setting_index = 3;
         if (default_o.checked) default_setting_index = 4;

         clog("change_default_setting " + default_setting_index);


     }
     function remove_reservationinfo(idx){
         mreservationinfo.classes.splice(idx,1);
         updateTableBody();
     }
    function gxtogglechange(key,idx){
        var ptoggle = document.getElementById(key+"_"+idx);
        var ptoggle_icon = document.getElementById(key+"_span_"+idx);
        var ptoggle_txt = document.getElementById(key+"_txt_"+idx);
               
        if(ptoggle.checked){
            ptoggle_txt.innerHTML = "&nbsp;ON";
            ptoggle_txt.style.color = "white";
            ptoggle_icon.style.backgroundColor = "#2194f3";

        }else{
            ptoggle_txt.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OFF";
            ptoggle_txt.style.color = "white";
            ptoggle_icon.style.backgroundColor = "#cccccc";

        }
     }
     function popup_togglechange(couponlen,newlockerlen){

        var toggle = document.getElementById("toggle_request");
        var toggle_icon = document.getElementById("toggle_icon_request");
         var div_pushmessage = document.getElementById("div_pushmessage");
        if(toggle.checked){
            toggle_icon.style.backgroundColor = "#33aaaa";
            
             $("#div_pushmessage").show(200);
        }else{
            toggle_icon.style.backgroundColor = "#cccccc";
            
            $("#div_pushmessage").hide(200);
        }
    }
 </script>
