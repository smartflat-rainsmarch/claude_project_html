
        <style>
            #sidemainnav {
                -ms-overflow-style: none; /* IE and Edge */
                scrollbar-width: none; /* Firefox */
                position:relative;
               overflow:auto;
            }
            #sidemainnav::-webkit-scrollbar {
                display: none; /* Chrome, Safari, Opera*/
            }
            #sidemainnav_bottom  {
                position:relative; 
                overflow:auto;
            }

            #sidemainnav_hr {cursor:pointer;}
            
            
            
            #div_todaylist {
                 width: 250px;
                height: 140px;
                overflow: auto;
              }
              #div_todaylist::-webkit-scrollbar {
                width: 10px;
              }
              #div_todaylist::-webkit-scrollbar-thumb {
                background-color: #2f3542;
                border-radius: 10px;
                background-clip: padding-box;
                border: 2px solid transparent;
              }
              #div_todaylist::-webkit-scrollbar-track {
                background-color: grey;
                border-radius: 10px;
                box-shadow: inset 0px 0px 5px white;
              }
            
            /* 작은 화면에서 메뉴 텍스트 숨기기 */
            @media (max-width: 768px) {
                .nav-text {
                    display: none;
                }
                #layoutSidenav_nav {
                    width: 60px !important;
                }
                #admin_settingid_210 {
                    width: 40px !important;
                    margin-left: 5px;
                }
                #div_todaylist {
                    width: 40px;
                }
            }
            
            
        </style>
        <!--===========================-->
        <!--        왼쪽 사이드바-->
        <!--===========================-->
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav" class='test' style="height:100%;background-color:#031535">
               
                <nav id = "mysidenav" class="sb-sidenav accordion" id="sidenavAccordion">
                   <!--충전관련-->
                    <div id='sidemainnav' class="sb-sidenav-menu">
                        <div class="nav"  style="background-color:#031535">

                            <!--===========================-->
                            <!--충전금액 박스 START-->
                            <!--===========================-->
                            <div style="position:fixed;width:235px;height:1px;margin-top:14px;margin-left:13px;background-color:#222222;"></div>
                            <div id="admin_settingid_210" class='form-control' style='display:none;border:0.2rem outset #e1ecc1;background-color:#031535;margin-top:24px;margin-left:10px;background-image:url(./img/box_left_dashboard.png);width:92%;height:229px;border:0px;background-size:100% 100%;padding:10px 22px 10px 22px'>
                                <text style='float:left;font-size: 13px;color:#808080;text-align:left;font-weight:500;'>현재 보유금액</text><br>
                                <text id='id_mychargepoint' class="fmont" value='0' style='margin-top:5px;float:left;font-size: 18px;color:#ffffff;text-align:left;font-weight:700;'></text><button id="button_charge" onclick="pointCharge()" style='margin-top:3px;float:right;width:60px; height:30px;border-radius:6px;background-color:#009ef7;font-size: 13px;color:#ffffff;font-weight:700;border:0px;outline:none'>충전</button>
                                <br><hr style="margin-top:20px;border: solid 1px #323234">
                                <div style='margin-top:-8px;margin-bottom:10px'>
                                    <table align="center" id ='locker_info' style='width:100%;'>
                                     
                                            <tr>
                                                <td style='width:50%;'>
                                                     <text style='font-size: 13px;color:#808080;text-align:left;font-weight:500;'> SMS(단문)</text>
                                                </td>
                                                <td style='width:50%;'>
                                                    <p style='float:right'><text class="fmont"  id='id_sms_count' style='font-size: 14px;color:#ffffff;text-align:right;font-weight:500;'>0</text> <text style='font-size: 14px;color:#808080;text-align:left;font-weight:500;'>건</text></p>                             
                                                </td>
                                             </tr>
                                            <tr>
                                                <td style='width:50%;'>
                                                     <text style='font-size: 13px;color:#808080;text-align:left;font-weight:500;'>LMS(장문)</text>
                                                </td>
                                                <td style='width:50%;'>
                                                     <p style='float:right'><text class="fmont"  id='id_lms_count'  style='font-size: 14px;color:#ffffff;text-align:right;font-weight:500;'>0</text> <text style='font-size: 14px;color:#808080;text-align:left;font-weight:500;'>건</text></p>                              
                                                </td>
                                             </tr>
                                            <tr>
                                                <td style='width:50%;'>
                                                     <text style='font-size: 13px;color:#808080;text-align:left;font-weight:500;'>앱푸시</text>
                                                </td>
                                               <td style='width:50%;height:20px'>
                                                   <p style='float:right'><text class="fmont"  id='id_push_count'  style='font-size: 14px;color:#ffffff;text-align:right;font-weight:500;'>0</text> <text style='font-size: 14px;color:#808080;text-align:left;font-weight:500;'>건</text></p>                            
                                                </td>
                                             </tr>
                                        </table>
                                    
                                </div>
                                <br><hr style="margin-top:-23px;border: solid 1px #323234">
                                <span style='float:left'><button id="button_chargehistory"  style='margin-top:-5px;width:93px; height:32px;border-radius:5px;background-color:#009ef7;font-size: 13px;color:#ffffff;text-align:center;font-weight:400;border:0px;outline:none'  onclick='showChargeList()'>결제내역</button></span><span style='float:right'><button id="button_sendhistory" style='margin-top:-5px;width:93px; height:32px;border-radius:5px;background-color:#009ef7;font-size: 13px;color:#ffffff;text-align:center;font-weight:400;border:0px;outline:none'   onclick='loadMainDiv(20)'>전송기록</button></span>
                            </div>
                            <br>
                            <!--===========================-->
                            <!--충전금액 박스 END-->
                            <!--===========================-->
                            
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" onclick="updateScreen()" id='nav_channel'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">화면수정</span></a>   
                                <a class="nav-link" onclick="loadMainDiv(999)" id='nav_createkey'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">학교코드 추가 (관리자용)</span></a>
                                  
<!--
                                <a class="nav-link" onclick="loadMainDiv(1001)" id='nav_createkey'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;페이지데이터 삽입</a>
                                <a class="nav-link" onclick="loadMainDiv(1002)" id='nav_account'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;계정생성</a>
                                <a class="nav-link" onclick="loadMainDiv(1003);updateSetTutorialStatus()" id='nav_qna'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;Q & A</a>  
-->
                                

                            </nav>
                            <!--리모컨 버튼-->
                            <div style="position:fixed; bottom:20px; float:left; text-align:center; z-index:9999;">
                                <img id='img_remocon_nav' src="img/ic_remocon.png" onclick="sendRemocon()" style="margin-left:30px;;cursor:pointer">
                            </div>
                            <div class="neelhide" style="display:none;margin-left:15px;">
                                
                                <!--회원가입-->
                                <div id="collapsePages1001" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages1001">
                                        <div>
                                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth1001" aria-expanded="false" aria-controls="pagesCollapseAuth1001" id='admin_settingid_1001'>
                                                <i class="fa-solid fa-user"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nav-text">회원가입</span>
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>                                        
                                        </div>
                                        <div class="collapse" id="pagesCollapseAuth1001" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages1001">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="gotojoin()" id='admin_settingid_default'><i class="fa-regular fa-address-card"></i>&nbsp;&nbsp;<span class="nav-text">회원양식가입</span></a>
                                                <a class="nav-link" onclick="clickEmptyUser()" id='admin_settingid_140'><i class="fa-regular fa-address-book"></i>&nbsp;&nbsp;<span class="nav-text">임시회원가입</span></a>
                                            </nav>
                                        </div>                                    
                                    </nav>
                                </div>

                                <!--챠트-->
                                 <div id="collapsePages4" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages4">
                                        <div>
                                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth4" aria-expanded="false" aria-controls="pagesCollapseAuth4" id='admin_settingid_40'>
                                                <i class="fa-solid fa-chart-area"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nav-text">챠트</span>
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>

                                        </div>
                                        <div class="collapse" id="pagesCollapseAuth4" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages4">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="loadMainDiv(11,'chart_time_line')" id='admin_settingid_41'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">시간대별 입실자</span></a>
                                            </nav>
                                        </div>

                                    </nav>
                                </div>
                                
                                <!--운영자용(비공개)-->
                                <div id="collapsePages1000" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages1000">
                                        <div>
                                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth1000" aria-expanded="false" aria-controls="pagesCollapseAuth1000" id='admin_settingid_1000'>
                                                <i class="fa-solid fa-user-secret"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nav-text">운영자용(비공개)</span>
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>                                        
                                        </div>
                                        <div class="collapse" id="pagesCollapseAuth1000" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages1000">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="loadMainDiv(19)" id='admin_settingid_61'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">업체등록/수정</span></a>
                                                <a class="nav-link" onclick="loadMainDiv(2)" id='admin_settingid_23'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">고객정보 저장하기</span></a>
                                            </nav>
                                        </div>                                    
                                    </nav>
                                </div>
                                
                                <!--트레이너/강사설정-->
                                <div id="collapsePages3" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages3">
                                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth3" aria-expanded="false" aria-controls="pagesCollapseAuth3" id='admin_settingid_30'>
                                            <i class="fa-solid fa-cog fa-spin" style="font-size:50%;margin-top:-8px"></i><i class="fa-solid fa-cog fa-spin fa-spin-reverse" style="font-size:50%;margin-top:8px;margin-left:-2px"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nav-text">트레이너/강사설정</span>
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuth3" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages3">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="loadMainDiv(7)" id='admin_settingid_31'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">OT회원목록</span></a>
                                                <a class="nav-link" onclick="loadMainDiv(8)" id='admin_settingid_32'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">트레이너/강사정보</span></a>  
                                                
                                            </nav>
                                        </div>                                    
                                    </nav>
                                </div>
                                 
                                <!--설정-->
                                <div id="collapsePages2" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages2">
                                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth2" aria-expanded="false" aria-controls="pagesCollapseAuth2" id='admin_settingid_20'>
                                            <i class="fa-solid fa-gear fa-spin fa-fw"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nav-text">설정</span>
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuth2" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages2">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="loadMainDiv(4);check_tutorialdata()" id='admin_settingid_21'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">기본설정</span></a>
                                                <a class="nav-link" onclick="loadMainDiv(6)" id='admin_settingid_22'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">회원권 설정</span></a> 
<!--                                                <a class="nav-link" onclick="loadMainDiv(34)" id='admin_settingid_35'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;GX현황</a>-->

                                            </nav>

                                        </div>                                    
                                    </nav>
                                </div>
                                
                                
                                <!--관리자용-->
                                <div id="collapsePages5" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages5">
                                        <div>
                                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth5" aria-expanded="false" aria-controls="pagesCollapseAuth5" id='admin_settingid_50'>
                                                <i class="fa-solid fa-heading"></i>&nbsp;&nbsp;&nbsp;&nbsp;<span class="nav-text">관리자용</span>
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>

                                        </div>
                                        <div class="collapse" id="pagesCollapseAuth5" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages5">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="loadMainDiv(10);check_tutorialdata()" id='admin_settingid_33'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">권한설정</span></a>   
                                                <a class="nav-link" onclick="loadMainDiv(17)" id='admin_settingid_52'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">라커만들기</span></a>
                                                <a class="nav-link" onclick="loadMainDiv(13)" id='admin_settingid_24'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">QR코드만들기</span></a>
                                                <a class="nav-link" onclick="loadMainDiv(15);updateSetTutorialStatus()" id='admin_settingid_34'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">급여기본설정</span></a>  
                                                <a class="nav-link" onclick="loadMainDiv(16)" id='admin_settingid_51'><i class="fa-solid fa-caret-right"></i>&nbsp;&nbsp;<span class="nav-text">수정기록보기</span></a>

                                            </nav>
                                        </div>

                                    </nav>
                                </div>
                               <!--===========================-->
                                <!--메뉴 START-->
                                <!--===========================-->
                                <hr style="border: solid 1px #333333;margin-right:20px"/>
                                
                                 <!--관리자용-->
                                <div id="collapsePages100" aria-labelledby="headingTwo" data-parent="#sidenavAccordion" style="font-size:14px">
                                    <nav class="sb-nav-menu-nested nav accordion" id="sidenavAccordionPages100">
                                        <div>
                                            <a class="nav-link" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth100" aria-expanded="false" aria-controls="pagesCollapseAuth100">
                                                <i class="fa-solid fa-bars"></i>&nbsp;&nbsp;&nbsp;<span class="nav-text">메뉴</span><img id='nav_menu_icon_n' style='width:30px;height:30px;position:absolute;margin-left:170px;margin-top:-20px;visibility:hidden' src='./img/icon_n.png'/>
                                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                            </a>

                                        </div>
                                        <div class="collapse" id="pagesCollapseAuth100" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages100">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" onclick="loadMainDiv(1)" id='admin_settingid_1'><i class="fa-solid fa-message"></i>&nbsp;&nbsp;<span class="nav-text">푸시메세지 보내기</span></a>   
                                                <a class="nav-link" onclick="loadMainDiv(18)" id='admin_settingid_10'><i class="fa-solid fa-comment-sms"></i>&nbsp;&nbsp;<span class="nav-text">메세지 예약전송하기</span></a>
                                                <a class="nav-link" onclick="loadMainDiv(12)" id='admin_settingid_7'>
                                                    <i class="fa-solid fa-hand"></i>&nbsp;&nbsp;<span class="nav-text">[홀딩/시작일] 변경요청</span> 
                                                    <img id='nav_request_icon_n' style='width:30px;height:30px;position:absolute;margin-left:170px;margin-top:-20px;visibility:hidden' src='./img/icon_n.png'/>
                                                </a>
                                                <a class="nav-link" onclick="loadMainDiv(33)" id='admin_settingid_211'>
                                                    <i class="fa-solid fa-person-circle-xmark"></i>&nbsp;&nbsp;<span class="nav-text">잔여세션 소진신청</span>
                                                    <img id='nav_request_removeptcount_icon_n' style='width:30px;height:30px;position:absolute;margin-left:170px;margin-top:-20px;visibility:hidden' src='./img/icon_n.png'/>
                                                </a>  
                                                <a class="nav-link"  onclick="loadMainDiv(31)" id='div_ornertest' style='display:none'><i class="fa-solid fa-ban"></i>&nbsp;&nbsp;<span class="nav-text">[비공개] 실험실</span></a>

                                            </nav>
                                        </div>

                                    </nav>
                                </div>

                                <!--===========================-->
                                <!--메뉴 END-->
                                <!--===========================-->
                                
                            </div>
                        </div>
                    </div>
                   
                    <!--중간마우스 커서 바뀌는 드래그 부분-->
                    <div class="neelhide" style="display:none">
                        <div id="sidemainnav_hr" align="center" style="width:100%;background-color:rgba(255, 0, 0, 0.0);height:22px" title='오늘 입장한 고객 화면크기를 조절할 수 있습니다.'>
                            <img src='./img/hr_handle.png' style='width:40;height:22px;margin-top:10px;margin-top:1px;'/>
                        </div>
                        <div id='sidemainnav_bottom' class="sb-sidenav-footer" style="height:250px;overflow-x: hidden;overflow-y: hidden;background-color:#000d28;border-radius:10px 10px 0px 0px;margin-left:10px;margin-right:10px;padding:0px 20px 20px 20px">
                            <img id='id_icon_down' onclick='showTodayList(0)' src='./img/icon_down.png' style='float:right;display:none;margin-right:-20px'/><img id='id_icon_up'  onclick='showTodayList(1)'  src='./img/icon_up.png' style='float:right;display:none;margin-right:-20px'/><br>
                            <div style="font-size: 14px;color:#ffffff;text-align:left;font-weight:500;"><text style="float:left">오늘 입장한 고객</text><text class="fmont" id="listview_title"  style="float:right;margin-top:0px;font-size: 14px;color:#32d74b;text-align:right;font-weight:500;">0</text><img src="./img/icon_member.png" style="float:right;margin-top:5px;margin-right:4px"></div><br><br>
                            <div style="margin-top:-15px;margin-bottom:10px">
                                <svg style="width:12px;height:12px;margin-top:4px"><rect width="7" height="7" rx="3" ry="3" style="fill:#76b4e6;" /></svg><text style='color:#76b4e6;font-size:13px;'>유효회원</text>&nbsp;&nbsp;
                                <svg style="width:12px;height:12px;margin-top:4px"><rect width="7" height="7" rx="3" ry="3" style="fill:#ff4444;" /></svg><text style='color:#ff4444;font-size:13px'>종료회원</text>&nbsp;&nbsp;
                                <svg style="width:12px;height:12px;margin-top:4px"><rect width="7" height="7" rx="3" ry="3" style="fill:#ba9aec;" /></svg><text style='color:#ba9aec;font-size:13px'>홀딩회원</text>
                            </div>
                            <div  id='div_todaylist' style="width:100%;height:160px;padding-bottom:10px">
                                <ul id = "listview_input" class="list-group" >
    <!--                              <li type ="button" onclick="listclick(0)" style="background-color:gray" class="list-group-item"><span style="float:left;padding17px 10;font-size:15px">(M)&nbsp;허광용</span><span style="float:right;padding17px 10;font-size:15px">12시:36분</span></li>-->


                                </ul>
                            </div>

                        </div>
                    </div>
                </nav>
            </div>
            
        </div>
        
        <script>
            
            //버튼 클릭이벤트 버튼색깔설정
            setBtnEventColor("button_charge","#009ef7","#29acf6","#52baf5");
            setBtnEventColor("button_chargehistory","##009ef7","#29acf6","#52baf5");
            setBtnEventColor("button_sendhistory","##009ef7","#29acf6","#52baf5");
             
             var div_ornertest = document.getElementById("div_ornertest");
            if(auth == AUTH_SYSTEMOWNER)
                div_ornertest.style.display = "block";
            function gotojoin(){
                var groupcode = getData("nowgroupcode");
                var url = "../../v2/dist/join?pagetype=adm&groupcode="+groupcode+"&centercode="+getData("nowcentercode");
                location.href = url;
                
            }

            function updateScreen(){
                console.log("updateScreen!!");
              loadMainDiv(1000);    
               
                
            }
            function menu_click(){
//                setMainDiv(checkMainDiv());
                $("body").toggleClass("sb-sidenav-toggled");
            }
            
            function listclick(idx){
                clog("list click!! "+idx);
            }
            function initNav(issession){
               console.log("issession "+issession);
                if(issession < AUTH_OWNER){
                    
                    if(document.getElementById("img_addprojectid"))document.getElementById("img_addprojectid").style.display = "none"; //헤더쪽 프로젝트 추가
                    if(document.getElementById("nav_createkey"))document.getElementById("nav_createkey").style.display = "none";
                    if(document.getElementById("btn_savexlsx"))document.getElementById("btn_savexlsx").style.display = "none";
                    if(document.getElementById("collapsePages1000"))document.getElementById("collapsePages1000").style.display = "none";
//                    if(document.getElementById("admin_settingid_1"))document.getElementById("admin_settingid_1").style.display = "none";
                }
            }
            function inputlist(gender, name, time,id,memberstatus){
                if(!gender)gender = "U";
                var title = document.getElementById("listview_title");
                var img_gender = "<i class='fa-solid fa-mars-and-venus' style='width:15px;height:15px;color:#fffd00;margin-left:-3'></i>";
                if(gender == "M")img_gender = "<i class='fa-solid fa-mars' style='width:15px;height:15px;color:#0075cf;margin-left:-3px' ></i>";
                else if(gender == "F")img_gender = "<i class='fa-solid fa-venus' style='width:15px;height:15px;color:#e92c89;margin-left:-3px' ></i>";

                var listview = document.getElementById("listview_input");
            
                var hhmm = time.substr(11,5);
                
                var bgcolor = "#e6f2fe";
                if(memberstatus == "O" || memberstatus == "I")bgcolor = "#ff4444";
                else if(memberstatus == "H")bgcolor = "#dacbf2";
                
                
                listview.innerHTML = "<li type ='button' onclick='header_search(\""+id+"\")' style='background-color:"+bgcolor+";height:45px' class='list-group-item'><span style='float:left;padding7px 10;color:#444444;font-size:14px;margin-top:0px;font-weight:500;'>"+img_gender+"&nbsp;&nbsp;&nbsp;"+name+"</span><span class='fmont' style='float:right;padding7px 10;color:#555555;font-size:14px;font-weight:500;'>"+hhmm+"</span></li>"+listview.innerHTML;
                
                
                var show_icon_down = isshowtodaylist ? "block" : "none";
                var show_icon_up = isshowtodaylist ? "none" : "block";
                
//                title.innerHTML ="<text style='color:#ffffff;font-size:15px'>("+listview.children.length+"명)</text><span style='float:right;'><img id='id_icon_down' onclick='showTodayList(0)' src='./img/icon_down.png' style='display:"+show_icon_down+"'/><img id='id_icon_up'  onclick='showTodayList(1)'  src='./img/icon_up.png' style='display:"+show_icon_up+"'/></span>";
                title.innerHTML = listview.children.length+"";
                showTodayList(isshowtodaylist);
            }
            function showTodayList(isshow){
                var div_todaylist = document.getElementById("div_todaylist");
                var id_icon_down = document.getElementById("id_icon_down");
                var id_icon_up = document.getElementById("id_icon_up");
                var sidemainnav_bottom = document.getElementById("sidemainnav_bottom");
                var sidemainnav_hr = document.getElementById("sidemainnav_hr");
                if(isshow){
                    div_todaylist.style.display = "block";
                    id_icon_down.style.display = "block";
                    id_icon_up.style.display = "none";
                    isshowtodaylist = true;
                    sidemainnav_bottom.style.height = now_sidemainnav_bottom_height+"px";
                    sidemainnav_hr.style.display = "block";
                }else{
                    div_todaylist.style.display = "none";
                    id_icon_down.style.display = "none";
                    id_icon_up.style.display = "block";
                    isshowtodaylist = false;
                    sidemainnav_bottom.style.height = "90px";
                    sidemainnav_hr.style.display = "none";
                }
                
               
            }
            function testsendsms(){
                //test
                 var smsdata = {
                        "titles": "test",
                        "messages": "testmessages",
                        "phones": "testphones",
                        "clickaction": ""
                    };
                sendReservationSMSMessages("now", "dsads",2);
            }
            
            
            /////////////////////////////////////
            // 좌측하단 입장고객 마우스 크기조절하기 start
            /////////////////////////////////////
      
            var startpos, diffpos=0, eControl = false;
            function divMouseDown(e) {
                document.onmouseup = divMouseUp;
                document.onmousemove = divMouseMove;
                
                 if(isshowtodaylist){
                    if (!document.all) startpos = e.screenY + diffpos;
                    else startpos = event.clientY + diffpos;
                    eControl = true;
                     
                    return false;
                 }
            }

            function divMouseUp(e) {
                 if(isshowtodaylist){
                    eControl = false;
                    return false;
                 }
            }

            function divMouseMove(e) {
                
                if(isshowtodaylist){
                    if (eControl) {
                        if (!document.all) 
                            pos = e.screenY;
                        else 
                            pos = event.clientY;

                        diffpos = startpos-pos;
    //                    if (diffpos > -250 && diffpos < 250) 

                            document.getElementById("sidemainnav").style.height = sidemain_height - diffpos + "px";
                            now_sidemainnav_bottom_height = default_sidebottom_height + diffpos;
                            document.getElementById("sidemainnav_bottom").style.height = now_sidemainnav_bottom_height + "px";
                            document.getElementById("div_todaylist").style.height = (now_sidemainnav_bottom_height-90) + "px";

                    }
                }
                
            }
            var now_sidemainnav_bottom_height = 250;
        
            var sidemain_height = document.getElementById("sidemainnav").clientHeight;
            var default_sidebottom_height = 250;
            function init() {
                document.getElementById("sidemainnav_hr").onmousedown = divMouseDown;
                document.onmouseup = divMouseUp;
                document.onmousemove = divMouseMove;
                
                var img_remocon_nav = document.getElementById("img_remocon_nav");
                if(getDevice() == "PC"){
                    img_remocon_nav.style.display = "none";
                }
            }
            init();
             /////////////////////////////////////
            // 좌측하단 입장고객 마우스 크기조절하기 end
            /////////////////////////////////////
    </script>