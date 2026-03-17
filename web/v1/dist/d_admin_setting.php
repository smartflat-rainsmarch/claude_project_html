<style>
   
    .form-control{
        border-radius: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border: none;
    }
    label{
        border-radius: 10px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        
    }
    .form-control > .form-control{
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border: 1px solid #e4e6ef;
    }
    .sub_title > .form-control > label {
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
    }
    .set_form{
        background-color: #ffffff;
        border: 1px solid #e4e6ef;
        border-radius: 10px;
    }
    .sub_title{
        width: 98%;
        border-radius: 10px;
        background-color: #c3d9ec;
        border: 1px solid #e4e6ef;
        margin-left: 1%;
        margin-top: 30px;
    }
    .sub_title_text{
        font-size: 16px;
        color: #3f4254;
        font-weight: 500;
        text-align: left;
        margin-top: 10px;
        margin-left: 18px;
    }
    .mycheckbox .checkmark:after{
        left: 5.5px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    /* modal css 221011 유진 추가*/
    .set_modal_sub_title{
        width: 100%;
        height: 44px;
        background-color: #f5f8fa;
        border-radius: 10px 10px 0 0;
        border: 1px solid #e4e6ef;
        border-bottom: none;
        margin-bottom: 0;
        padding-left: 20px;
        padding-top: 10px;
        font-size: 15px;
        color: #181c32;
        font-weight: 500;
        text-align: left;
    }
</style>
<div>
    <!-- 221011 유진 수정 -->
    <div class="container" id="adminsetting_container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
        <div class="reservation_center" id="adminsetting_reservation_center" style='padding:5px'>
            <text style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >권한 설정하기</text>
			
	
			<hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
	
            <div class="sub_title" >
               <label class="sub_title_text">*설정 담당자 선택</label><img src="./img/ques_20.png" title="직원,관리자를 선택합니다." style="margin-top:13px; margin-left:10px;"/>
                <div class = "form-control" style ="height:auto">
                <br>
                    <label>직원 선택</label>
                        <select id="select_staff" onchange="changeStaff()" class="form-control" name="payment_type" required>
                            <option value=''>== 직원을 선택하세요 ==</option>

                        </select><br>

                        <div id="div_default_setting" style='display:none'>
                            <label title="트레이너 , 점장 , 팀장,  운영자 의 기본값으로 설정됩니다..">(옵션)기본값으로 세팅하기</label>
                            <div class="form-control" onclick='change_default_setting()' style='height:auto' >
                            <span><input id="default_t" type='radio' name='default' value='T' style='margin-top:10px'><label for="default_t">트레이너</label>&nbsp;&nbsp;<input id="default_tl" type='radio' name='default' value='TL'><label for="default_tl" >팀장</label>&nbsp;&nbsp;<input id="default_m" type='radio' name='default' value='M'><label for="default_m" >점장</label>&nbsp;&nbsp;<input id="default_o" type='radio' name='default' value='o'><label for="default_o" >운영자</label>&nbsp;&nbsp;</span><span style='float:right'><button onclick='show_default_setting()' class='btn btn-primary btn-raised' style='float:right;cursor:pointer;'>기본값 수정하기</button></span>
                            </div>                
                        </div>
                </div>
            </div><br>
            
            <div class="sub_title" ><label class="sub_title_text">권한설정</label><img src="./img/ques_20.png" title="직원,관리자들에게 각 버튼들의 수정가능한 권한을 설정합니다." style="margin-top:13px; margin-left:10px;"/>

                <div class="form-control" name="subscription_path" style='height : auto'>
                    <!--neel_admin_setting-->
                    <!--상단바-->
                    <br>
                    <label>상단바</label><br>
                    <div class='form-control' style ="height:auto">
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="5"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;매출현황&nbsp;[&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="214"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;매출기록만 삭제/복구&nbsp;]&nbsp;</label>
                        <br>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="6"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;페이롤현황&nbsp;[&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="213"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;페이롤 수정기록보기&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="215"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;전체트레이너 시간표&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="228"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;트레이너 총금액보기&nbsp;]&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="229"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;급여 전체오픈&nbsp;]&nbsp;</label>
                        <br>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="4"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커현황&nbsp;&nbsp;&nbsp;</label>
                        <br>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="35"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;GX현황&nbsp;&nbsp;[&nbsp;</label>                        
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="220"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;그룹복사하기&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="221"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;그룹수정하기&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="222"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;강좌추가하기&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="223"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;강좌수정하기&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="224"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;강좌삭제하기&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="225"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;강좌내 예약삭제&nbsp;&nbsp;,</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="226"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;강좌내 예약추가&nbsp;]&nbsp;</label>
                        
                        
                    </div>
                    <!--좌측버튼들-->
                    <br>
                    <label>좌측메뉴</label><br>
                    <div class='form-control' style ="height:auto">
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="210"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;SMS/PUSH충전표&nbsp;&nbsp;&nbsp;</label>
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="200">&nbsp;회원정보 입력하기&nbsp;&nbsp;&nbsp;-->
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="1"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;푸시메세지보내기&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="10"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;메세지예약전송하기&nbsp;&nbsp;&nbsp;</label>
        <!--
                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="2">&nbsp;전체회원목록&nbsp;&nbsp;&nbsp;
                        <input class="checkboxgroup" type="checkbox" name="chk_info" value="3">&nbsp;유효회원목록&nbsp;&nbsp;&nbsp;
        -->
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="7"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;[홀딩/시작일] 변경요청&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="211"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;잔여세션 소진신청&nbsp;&nbsp;&nbsp;</label>

                        
                    </div>
                    <!--좌측버튼들-->
                    <br>
                    <label>라커 메뉴</label><br>
                    <div class='form-control' style ="height:auto">
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="9"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기간만료자&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="15"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기간임박&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="8"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;리셋설정&nbsp;&nbsp;&nbsp;</label>
                        <br>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="200"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기간임박/기간종료 목록에서 메세지보내기&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="201"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기간임박/기간종료 단일고객 메세지보내기&nbsp;&nbsp;&nbsp;</label>
                        
                    </div><br>
                    <!--회원검색-->
                    <label>회원가입</label><br>
                    <div class='form-control' style ="height:auto">
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="140"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;임시회원가입&nbsp;&nbsp;&nbsp;</label>
                        
                    </div><br>
                    
                    <!--회원검색-->
                    <label>회원검색</label><br>
                    <div class='form-control' style ="height:auto">
        <!--            <input class="checkboxgroup" type="checkbox" name="chk_info" value="10" onchange='onchangeTopCheckBox(10)'>&nbsp;통계전체&nbsp;&nbsp;&nbsp;<hr style="border: solid 1px light-gray;">-->
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="13"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;입실자 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="14"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;수강 연기자 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="11"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;수강종료예정자&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="12"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;수강종료후 미등록자&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="3"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;유효회원 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="17"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;유효 PT회원 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="2"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;누적회원 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="16"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;누적 PT회원 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="18"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커 사용중인 목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="19"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;미수금 목록&nbsp;&nbsp;&nbsp;</label>
                        
                    </div><br>
                    
                    <label>챠트</label><br>
                    <div class='form-control' style ="height:auto">
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="41"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;시간대별 입실자&nbsp;&nbsp;&nbsp;</label>
                    </div><br>

                    <label>관리자용</label><br>
                    <div class='form-control' style ="height:auto">
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="33"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;권한설정&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="52"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커만들기&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="24"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;QR코드만들기&nbsp;&nbsp;&nbsp;</label>
                    <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="51"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;수정기록보기&nbsp;&nbsp;&nbsp;</label>
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="23">&nbsp;고객정보 저장하기&nbsp;&nbsp;&nbsp;                -->
                    </div><br>
                    <!--설정-->
                    <label>설정</label><br>
                    <div class='form-control' style ="height:auto">
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="20" onchange='onchangeTopCheckBox(20)'>&nbsp;설정전체&nbsp;&nbsp;&nbsp;<hr style="border: solid 1px light-gray;">-->
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input id="default_set_btn"  onclick="click_default_btn()"  class="checkboxgroup" type="checkbox" name="chk_info" value="21"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기본설정&nbsp;[&nbsp;&nbsp;</label><label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input id="set_locker_btn" onclick="click_in_default_btn()" class="checkboxgroup" type="checkbox" name="chk_info" value="25"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커개수&가격설정&nbsp;&nbsp;&nbsp;</label><label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input id="set_reservationtime_btn" onclick="click_in_default_btn()"  class="checkboxgroup" type="checkbox" name="chk_info" value="26"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;예약시간설정&nbsp;&nbsp;&nbsp;</label><label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input id="set_alldelaytime_btn" onclick="click_in_default_btn()"  class="checkboxgroup" type="checkbox" name="chk_info" value="27"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;전체기간연장하기&nbsp;&nbsp;&nbsp;]</label><br>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="22"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;회원권 설정&nbsp;&nbsp;&nbsp;</label>
                    
                    </div><br>
                    <!--트레이너/강사설정-->
                    <label>트레이너/강사설정</label><br>
                    <div class='form-control' style="height:auto">
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="30" onchange='onchangeTopCheckBox(30)'>&nbsp;트레이너/강사설정 전체&nbsp;&nbsp;&nbsp;<hr style="border: solid 1px light-gray;">-->
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;">
                            <input class="checkboxgroup" type="checkbox" name="chk_info" value="31"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;OT회원목록&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="32"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;트레이너/강사정보&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="34"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;급여기본설정&nbsp;&nbsp;&nbsp;</label>
                        
                    </div>
                            <br>
                    <!--회원정보설정-->
                    <label>회원정보설정</label><br>
                    <div class='form-control' style ="height:auto">
                        <label style='font-size:18px;font-weight:bold'>*회원정보*</label><br>
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="100" onchange='onchangeTopCheckBox(100)'>&nbsp;회원정보 전체&nbsp;&nbsp;&nbsp;<hr style="border: solid 1px light-gray;">-->
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="101"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;비밀번호 재설정하기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="129"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;등급 변경하기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="102"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;유저 삭제하기&nbsp;&nbsp;&nbsp;</label>                        
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="103"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;이름수정&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="104"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;번호수정&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="105"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;메세지 보내기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="106"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;성별수정&nbsp;&nbsp;&nbsp;</label><br>
                        
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="107"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;이메일 수정&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="108"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;생년월일 변경&nbsp;&nbsp;&nbsp;</label>
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="109">&nbsp;재등록하기&nbsp;&nbsp;&nbsp;-->
        <!--                <input class="checkboxgroup" type="checkbox" name="chk_info" value="110">&nbsp;P.T만 재등록&nbsp;&nbsp;&nbsp;-->
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="111"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;주소수정&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="114"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;특이사항수정&nbsp;&nbsp;&nbsp;</label>                        
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="119"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;가입서류 보기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="142"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;메세지목록 보기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="143"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;회원예약화면 보기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="120"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;+더보기&nbsp;&nbsp;&nbsp;</label>
                        
                        
        <!--                <div class='form-control' style ="height:auto;padding-left:50px;">-->
                            <!--회원권목록-->
                            <br><br><label style='font-size:18px;font-weight:bold'>*상품정보*</label>
                            <br><label>&nbsp;&nbsp;&nbsp;&nbsp;- 회원권목록 -</label><br>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="115"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기간수정&nbsp;&nbsp;&nbsp;</label>
        <!--                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="checkboxgroup" type="checkbox" name="chk_info" value="116">&nbsp;잔여횟수소진하기&nbsp;&nbsp;&nbsp;-->
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="117"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;잔여횟수소진승인&nbsp;&nbsp;&nbsp;</label><br>
                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="121"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;상세&nbsp;&nbsp;&nbsp;</label>[
                                &nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="118"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;결제일변경&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="130"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;홀딩신청&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="131"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;수강추가&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="132"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;수정&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="133"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;양도&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="134"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;회수추가&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="135"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;담당자변경&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="136"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;삭제&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="137"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;복구&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="138"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;환불&nbsp;</label>
                                ,&nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="139"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;연기&nbsp;</label>]
                                
                        
                            
        <!--                </div>-->
                        
                         <br><br><label>&nbsp;&nbsp;&nbsp;&nbsp;- 라커목록 -</label><br>
                                 &nbsp; &nbsp; &nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="122"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커 수정&nbsp;&nbsp;&nbsp;</label>
                                <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="112"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커 등록&nbsp;&nbsp;&nbsp;</label>
                                <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="113"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커 자리이동&nbsp;&nbsp;&nbsp;</label>
                                <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="145"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;라커 환불&nbsp;&nbsp;&nbsp;</label>
                     
                         <br><br><label>&nbsp;&nbsp;&nbsp;&nbsp;- 기타상품목록 -</label><br>
                                &nbsp; &nbsp; &nbsp;<label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="147"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기타상품 등록&nbsp;&nbsp;&nbsp;</label>
                                <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="144"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기타상품 수정&nbsp;&nbsp;&nbsp;</label>
                                <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="146"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기타상품 환불&nbsp;&nbsp;&nbsp;</label>
                                <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class="checkboxgroup" type="checkbox" name="chk_info" value="148"><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;기타상품 숨기기&nbsp;&nbsp;&nbsp;</label>
                        
                        <br><br>
                    </div>
                    <br>
                    <label>기타설정</label><br>
                    <div class='form-control' style ='height:auto'>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class='checkboxgroup' type='checkbox' name='chk_info' value='202'><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;APK 수동설치주소(안드로이드전용)&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class='checkboxgroup' type='checkbox' name='chk_info' value='212'><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;페이롤 회원삭제하기&nbsp;&nbsp;&nbsp;</label>
                        <label class="mycheckbox" style="display:inline; font-size:15px;position: relative;padding-left: 15px;margin-bottom: 2px;border-radius: 5px;cursor: pointer; user-select: none;"><input class='checkboxgroup' type='checkbox' name='chk_info' value='227'><span class="checkmark" style="position: absolute;top: 4px;left: -1px;border-radius: 5px;height: 15px;width: 15px;"></span>&nbsp;엑셀다운로드&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <br>  
                            
            </div>
        </div>
        <br>
        
        <!-- 221007 유진 수정 -->
        <button onclick='update_admin_setting()' class='btn btn-primary btn-raised' style='background-color:#33aaaa;margin:10px;cursor:pointer;margin-left:1105px;border:none;'>설정정보 저장하기</button>
     </div>
    </div>
<!--        <span style='float:left;padding:17px 10;'>※ 세팅 데이터 수정하기 </span><button onclick='update_setting()' class='btn btn-primary btn-raised' style='float:right;margin:10px;cursor:pointer;'>수정하기</button>-->
</div>
<script>
    var group = getData("nowgroupcode");
    var centercode = getData("nowcentercode");
    var centername = getData("nowcentername");
    
    var alltraners = null; 
    var checklist = null;
    var now_traner = null;
    //급여 테이블 Body
    var table_levelbody = document.getElementById("table_levelbody");
    var default_setting_index = 0; //기본세팅값  트레이너 : 1  매니저 : 2  운영자 : 3
    console.log("d_admin_setting.php");
    function init_d_admin_setting(value){
//        var id_nosettinguser_title = document.getElementById("id_admin_setting_title");
//        id_nosettinguser_title.innerHTML = /*title_icon+*/"어드민페이지 권한설정";
        
        getCenterTraners(getData("nowcentercode"),function(_alltraners){
            alltraners = _alltraners;
            setStaffs(alltraners);
        });
    }
    function setStaffs(rows){
        var select_staff = document.getElementById("select_staff");
        select_staff.innerHTML = "<option value=''>== 직원을 선택하세요 ==</option>";
        console.log("rows ",rows);
        for(var i = 0 ; i < rows.length; i++){
            select_staff.innerHTML += "<option value='"+rows[i]["mem_uid"]+"'>"+rows[i]["mem_username"]+"&nbsp;&nbsp;["+rows[i]["mem_userid"]+"]</option>";
        }
    }
    function changeStaff(){
        var select_staff = document.getElementById("select_staff");
        var uid = select_staff.value;
//        clog("uiud "+uid);
        initallcheckbox(uid);
        
        var div_default_setting = document.getElementById("div_default_setting");
        div_default_setting.style.display = select_staff.value ? "block" : "none";
        
    }
    
    function change_default_setting(){
        var default_t = document.getElementById("default_t"); //트레이너
        var default_m = document.getElementById("default_m"); //매니저
        var default_tl = document.getElementById("default_tl"); //매니저
        var default_o = document.getElementById("default_o"); //운영자
        
        if(default_t.checked)default_setting_index = 1;
        if(default_m.checked)default_setting_index = 2;
        if(default_tl.checked)default_setting_index = 3;
        if(default_o.checked)default_setting_index = 4;
        
        clog("change_default_setting "+default_setting_index);
        
        //권한설정을 디폴트값으로 설정한다.
        if(default_setting_index > 0)setDefault_setting(default_setting_index);
       
    }
    function setDefault_setting(idx){
        getDefaultSetting(function(adminsetting){
            
            var dtype = ["","traner","manager","teamleader","operator"];
            
             var getlist = adminsetting ?  adminsetting[dtype[default_setting_index]] : null;
//            var getlist = JSON.parse(getData("default_admin_setting_"+idx));

                var clist = document.getElementsByClassName("checkboxgroup");
                var checkvalues = [];
                if(getlist){
                    for (var i = 0; i < clist.length; ++i)
                        clist[i].checked = checked(getlist,parseInt(clist[i].value));        
                }else{
                    for (var i = 0; i < clist.length; ++i)
                        clist[i].checked = "";        
                }
        });
    }
    
   
//    function onchangeTopCheckBox(index){
//
//        
//    }
    function initallcheckbox(uid){
        var clist = document.getElementsByClassName("checkboxgroup");
        for (var i = 0; i < clist.length; ++i)
           clist[i].checked = "";
        
        //담당트레이너 정보를 세팅한다.
        for(var i = 0; i < alltraners.length; i++){
            if(alltraners[i].mem_uid == uid){
                now_traner = alltraners[i];
                break;
            }
        }
//        now_traner["mem_setting"] = "1,2,3";//test
        var memsetting = now_traner["mem_setting"] ? JSON.parse(now_traner["mem_setting"]): {};
        var setting_array = memsetting["adminsetting"] ? memsetting["adminsetting"] : [];
        
        //체크박스에 체크한다.
        for (var i = 0; i < clist.length; ++i){
            for( var j = 0 ; j < setting_array.length; j++){
                if(clist[i].value == setting_array[j]){
                    clist[i].checked = "checked";
                    break;
                }
            }    
        }        
    }

    
    function update_admin_setting(){
        if(!document.getElementById("select_staff").value){
            alertMsg("직원을 선택하세요.");
            return;
        }
        showModalDialog(document.body,"어드민 권한변경", "권한정보를 수정하시겠습니까?" , "수정하기", "취소",function(){
                
            var clist = document.getElementsByClassName("checkboxgroup");
            var setting_str = [];
            for (var i = 0; i < clist.length; ++i){
                if(clist[i].checked){
                   setting_str.push(clist[i].value);
                }
            }
            
            adminSettingAllUpdate(now_traner.mem_uid,setting_str);

            
        },function(){
            hideModalDialog();

        });
    }
    
   
   
    function adminSettingAllUpdate(uid,setting_str){
    

        var value = {
            uid:uid,
            settingstr : setting_str
        };
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");
        
        var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"updateadminsetting",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
//            clog("setsettingres is ",res);
           if(res.code == 100){
               
               sendPushMessage(uid,"권한 변경됨!","어드민페이지 권한이 변경되었습니다. 변경된 권한을 확인해 주세요.");
               C_showToast( "설정완료!", "성공적으로 설정하였습니다.", function() {});
               if(tutorial_status < TS.FINISH){
                    setTutorialStatus(TS._17_SETTINGGX);
                   window.scrollTo(0,0);
               }
                   
                loadMainDiv(10);
               
           }else{
               C_showToast( "설정불가!", ""+res.message, function() {});
           }
            hideModalDialog();
        }, function (err) { 
            C_showToast( "설정불가!", "최소 1가지 이상의 권한을 선택하세요", function() {});
            hideModalDialog();
        });
        
    }
    
</script>