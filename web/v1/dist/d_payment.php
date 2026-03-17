<!--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>



<link rel="stylesheet" href="./css/calendar.css"/>
<style>
    
.container {
    width : 100%;
  height: 100%;
  position: relative;
/*  border: 3px solid green;*/
}

.center {
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  
}
.reservation_center {
  padding-top: 1%;
  color: b;
  text-align:center;
    width:100%;
}

.my-button {

/*    width:100px;*/
    
    background-color: #f8585b;

    border: none;
    border-radius:10px;
    color:#fff;

    padding: 15px 0;

    text-align: center;
    padding-left: 20px;
    padding-right:20px;
    text-decoration: none;

    display: inline-block;

    font-size: 15px;

    margin: 4px;

    cursor: pointer;

}
.my-button:hover {
/*    background-color: blue;*/
    border-radius:10px;
}

    .new_btn {
         background-image: -moz-linear-gradient( 90deg, rgb(109,110,112) 0%, rgb(139,141,145) 
        100%);
         background-image: -webkit-linear-gradient( 90deg, rgb(109,110,112) 0%, 
        rgb(139,141,145) 100%);
         background-image: -ms-linear-gradient( 90deg, rgb(109,110,112) 0%, rgb(139,141,145) 
        100%);

    }
    .new_btn2 {
        background-image: -moz-linear-gradient( 90deg, rgb(45,45,48) 0%, rgb(71,71,75) 100%);
         background-image: -webkit-linear-gradient( 90deg, rgb(45,45,48) 0%, rgb(71,71,75) 
        100%);
         background-image: -ms-linear-gradient( 90deg, rgb(45,45,48) 0%, rgb(71,71,75) 100%);

    }
    .new_data {
        border:1px solid #e9e9e9;
        background-image: -moz-linear-gradient( 90deg, rgb(228,230,239) 0%, rgb(242,243,247) 
        5%, rgb(255,255,255) 100%);
         background-image: -webkit-linear-gradient( 90deg, rgb(228,230,239) 0%, 
        rgb(242,243,247) 5%, rgb(255,255,255) 100%);
         background-image: -ms-linear-gradient( 90deg, rgb(228,230,239) 0%, rgb(242,243,247) 
        5%, rgb(255,255,255) 100%);
        padding-right:15px

    }

    .new_data_yellow {
        border:1px solid #e9e9e9;
         background-image: -moz-linear-gradient( 90deg, rgb(238, 240, 132) 0%, rgb(255, 252, 166) 
        5%, rgb(255,255,255) 100%);
         background-image: -webkit-linear-gradient( 90deg,  rgb(238, 240, 132) 0%, 
        rgb(255, 252, 166) 5%, rgb(255,255,255) 100%);
         background-image: -ms-linear-gradient( 90deg,  rgb(238, 240, 132) 0%, rgb(242,243,247) 
        5%, rgb(255, 252, 166) 100%);
        padding-right:15px

    }

    
</style>


<div id = "reservation_container" class="container" style='width:1260px;height:auto;margin-top:20px;padding-bottom:20px;background-color:#ffffff;border:1px solid #eff2f5;border-radius:10px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.05);'>
    <div id= "reservation_center" class="reservation_center" style='padding:5px'>
        
<!--
        <button class ="my-button" type="button"><h3 id ="max_count">PT 30회</h3><h5 id ="use_count">30회중 12회 진행</h5><h5 id ="period">2020-01-01~2020-04-30</h5></button>
        <br><br>
-->
<!--
//말풍선 테스트
        <br><br><br><br><br><br>
         <div class="lefttip">
            <img class="img1" src="./img/ques_20.png"/>
            <span>이 아이콘에 대한 설명입니다.!이 아이콘에 대한 설명입니다.!이 아이콘에 대한 설명입니다.!이 아이콘에 대한 설명입니다.!!이 아이콘에 대한 설명입니다.!!이 아이콘에 대한 설명입니다.!!이 아이콘에 대한 설명입니다.!!이 아이콘에 대한 설명입니다.!</span>
        </div>
-->
        <text id='title_payment' style="float:left;margin-top:11px;font-size: 18px;color:#181c32;text-align:left;font-weight:700;" >월별 매출현황</text>
        <hr style="border: solid 1px #eff2f5;margin-top:55px;margin-left:-28px;margin-right:-28px;">
        <div  id="day_total_table" style='width:100%;display:none'>
            <br>
            <div style='width:100%;height:50px'>
                <table style='width:500px;height:35px;float:left;'>
                    <tr align="center" style='height:35px'>

                        <td class = 'new_btn' onclick='show_click_data_list(6)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer'>신규등록</td>
                        <td align="right" class = 'new_data' id='td_day6' onclick='month_price_click(6)' style="cursor:pointer"><text class='fmont' id="day_new_regist" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>건</text></td>

                        <td  class = 'new_btn'  onclick='show_click_data_list(7)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>재등록</td>
                        <td  align="right" class = 'new_data' id='td_day7' onclick='month_price_click(7)' style="cursor:pointer" ><text class='fmont' id="day_renewal_regist" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>건</text></td>

                        <td class = 'new_btn2'  onclick='show_click_data_list(8)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>등록합계</td>
                        <td  align="right" class = 'new_data'><text class='fmont' id="day_total_regist" style='font-size: 14px; color:#f4436d;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>건</text></td>
                    </tr>
                </table>
                <table style='width:500px;height:35px;float:right;'>


                    <tr align="center" style='height:35px'>

                        <td colspan='2'></td>

                        <td  class = 'new_btn'  onclick='show_click_data_list(1)'  style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>카드</td>
                        <td  class='new_data' id='td_day1' onclick='month_price_click(1)' align="right"  style="cursor:pointer" ><text class='fmont' id="day_card_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>

                        <td class = 'new_btn'  onclick='show_click_data_list(2)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>현금</td>
                        <td class='new_data' id='td_day2' onclick='month_price_click(2)' align="right" class = 'new_data'><text class='fmont' id="day_cash_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>
                    </tr>
                    <tr style='height:6px'></tr>
                    <tr align="center" style='height:35px'>

                        <td colspan='2'></td>

                        <td  class = 'new_btn'  onclick='show_click_data_list(3)'  style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>환불</td>
                        <td  class='new_data' id='td_day3' onclick='month_price_click(3)' align="right"  style="cursor:pointer" >
                            <text class='fmont' id="day_refund_price" style='font-size: 14px; color:#009ef7;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text>
                        </td>

                        <td class = 'new_btn'  onclick='show_click_data_list(14)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>미수금</td>
                        <td class='new_data' id='td_day14' onclick='month_price_click(14)' align="right" class = 'new_data'>
                            <text class='fmont' id="day_nogetremain_count" style="font-size: 12px; color:#0000ff;font-weight:400;float:left;margin-left:10px;margin-top:4px">0건</text>
                            <text class='fmont' id="day_nogetremain_price" style='font-size: 14px; color:#bbbbbb;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#bbbbbb;text-align:right; font-weight:500;'>원</text><br>
                        </td>
                    </tr>

                </table>
            </div>
            <br><br><br>
            <table style='width:100%;margin-top:0px'>
                <thead>
                    <tr align="center"  style="background-color:#eeeeee;height:40px">
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer'onclick='show_click_data_list(11)' >기간제 매출(FC)</td>
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(12)' >횟수제 매출(PT)</td>
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(13)' >기타</td>
<!--
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(1)' >카드</td>
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(2)' >현금</td>
-->
<!--                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(3)' >환불</td>-->
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer;display:none' onclick='show_click_data_list(4)' >미수금 회수</td>
<!--                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer;' onclick='show_click_data_list(14)' >미수금</td>-->
                        <td  class = 'new_btn2' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer' onclick='show_click_data_list(5)' >합계</td>
                    </tr>


                </thead>
                <tbody>
                    <tr align="right" style='height:60px' >         
                        <td class='new_data' id='td_day11' onclick='month_price_click(11)' style="cursor:pointer">
                            <text class='fmont' id="day_term_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="day_term_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="day_term_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>
                        </td>
                        <td class='new_data' id='td_day12' onclick='month_price_click(12)' style="cursor:pointer">
                            <text class='fmont' id="day_count_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="day_count_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="day_count_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>
                        </td>
                        <td class='new_data' id='td_day13' onclick='month_price_click(13)' style="cursor:pointer">
                            <text class='fmont' id="day_other_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="day_other_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="day_other_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>
                        </td>
                        
<!--
                        <td class='new_data' id='td_day1' onclick='month_price_click(1)' style="cursor:pointer"><text class='fmont' id="day_card_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>
                        <td class='new_data' id='td_day2' onclick='month_price_click(2)' style="cursor:pointer"><text class='fmont' id="day_cash_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>
-->
                        
<!--                        <td class='new_data' id='td_day3' onclick='month_price_click(3)' style="cursor:pointer"><text class='fmont' id="day_refund_price" style='font-size: 14px; color:#009ef7;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>-->
                        <!--일 미수금 회수 : 보여지지 않음-->
                        <td class='new_data' id='td_day4' onclick='month_price_click(4)' style="cursor:pointer;display:none">
                            <text class='fmont' id="day_remain_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="day_getremain_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="day_getremain_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>

                        </td>
                        <!--일 미수금 : 보여짐 -->
<!--
                        <td class='new_data' id='td_day14' onclick='month_price_click(14)' style="cursor:pointer;">
                            <text class='fmont' id="day_nogetremain_count" style="font-size: 12px; color:#0000ff;font-weight:400;float:left;margin-left:10px;margin-top:4px">0건</text>
                            <text class='fmont' id="day_nogetremain_price" style='font-size: 14px; color:#bbbbbb;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#bbbbbb;text-align:right; font-weight:500;'>원</text><br>
                            
                        </td>
-->
                        <td class='new_data' style="cursor:pointer">
                            <text class='fmont' id="day_total_price" style='font-size: 14px; color:#f4436d;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text>
                        </td>

                    </tr>

                </tbody>
            </table>
            
            <div style='width:100%;height:50px;margin-top:40px'>
<!--                <span style="float:left" id='div_dummy'><button class='btn' onclick='dummy_button_click()' style='float:right;border:0px;border-radius:5px;background-color:#007bff;font-size:14px;color:white;padding:10px 15px 10px 15px'>상품입력하기</button></span>    -->
                <span style="float:right;margin-top:7px">
                    <div >
                        <i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf" title='색깔별로 해당 목록이 있는지 표시합니다. 잘못된 금액표기, 잘못된 입력등을 관리자와  직원간 소통부분 , 관리자는 다시체크요청을 할 수 있으며 담당직원은 해당부분을 확인하여 다시 확인요청을 합니다. 이상이 없으면 관리자는 다시 완료로 설정합니다.'></i>
                        &nbsp;
                        <svg style='width:13px;height:13px;'><rect width='13' height='13' rx='3' ry='3' style='fill:#ffacac'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>다시체크</text>&nbsp;&nbsp;
                        <svg style='width:13px;height:13px'><rect width='13' height='13' rx='3' ry='3' style='fill:#ddddee'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>확인요청</text>&nbsp;&nbsp;
                        
                    </div>
                    
                </span>
                
            </div>
            
        </div>
        <div id="month_total_table" style='margin-top:-41px'>

             <!-- 타이틀-->
            <br><br><br>
            <div style='width:100%;height:50px'>    
                <table style='width:500px;height:35px;float:left;'>
                    <tr  align="center" style='height:35px'>

                        <td class = 'new_btn' onclick='show_click_data_list(6)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer'>신규등록</td>
                        <td align="right" class = 'new_data' id='td_month6' onclick='month_price_click(6)' style="cursor:pointer"><text class='fmont' id="month_new_regist" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>건</text></td>

                        <td  class = 'new_btn'  onclick='show_click_data_list(7)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700; cursor:pointer'>재등록</td>
                        <td  align="right" class = 'new_data' id='td_month7' onclick='month_price_click(7)' style="cursor:pointer" ><text class='fmont' id="month_renewal_regist" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>건</text></td>

                        <td class = 'new_btn2'  onclick='show_click_data_list(8)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700; cursor:pointer'>등록합계</td>
                        <td  align="right" class = 'new_data' ><text class='fmont' id="month_total_regist" style='font-size: 14px; color:#f4436d;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>건</text></td>
                    </tr>
                </table>
                <table style='width:500px;height:35px;float:right;'>

                    <tr align="center" style='height:35px'>

                        <td colspan='2'></td>

                        <td  class = 'new_btn'  onclick='show_click_data_list(1)'  style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>카드</td>
                        <td  class='new_data' id='td_month1' onclick='month_price_click(1)' align="right"  style="cursor:pointer" ><text class='fmont' id="month_card_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>

                        <td class = 'new_btn'  onclick='show_click_data_list(2)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>현금</td>
                        <td class='new_data' id='td_month2' onclick='month_price_click(2)' align="right" ><text class='fmont' id="month_cash_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>
                    </tr>
                    <tr style='height:6px'></tr>
                    <tr align="center" style='height:35px'>

                        <td colspan='2'></td>

                        <td  class = 'new_btn'  onclick='show_click_data_list(3)'  style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>환불</td>
                        <td  class='new_data' id='td_month3' onclick='month_price_click(3)' align="right"  style="cursor:pointer" >
                            <text class='fmont' id="month_refund_price" style='font-size: 14px; color:#009ef7;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text>
                        </td>

                        <td class = 'new_btn'  onclick='show_click_data_list(14)' style='width:80px;font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer '>미수금</td>
                        <td class='new_data' id='td_month14' onclick='month_price_click(14)' align="right" >
                            <text class='fmont' id="month_nogetremain_count" style="font-size: 12px; color:#0000ff;font-weight:400;float:left;margin-left:10px;margin-top:4px">0건</text>
                            <text class='fmont' id="month_nogetremain_price" style='font-size: 14px; color:#bbbbbb;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#bbbbbb;text-align:right; font-weight:500;'>원</text><br>
                        </td>
                    </tr>
                </table>
            </div>
            <br><br><br>
            <table style='width:100%;margin-top:0px'>
                <thead>
                    <tr align="center"  style="background-color:#eeeeee;height:40px">
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer'onclick='show_click_data_list(11)' >기간제 매출(FC)</td>
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(12)' >횟수제 매출(PT)</td>
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(13)' >기타</td>
<!--
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(1)' >카드</td>
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(2)' >현금</td>
-->
<!--                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer' onclick='show_click_data_list(3)' >환불</td>-->
                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer;display:none' onclick='show_click_data_list(4)' >미수금 회수</td>
<!--                        <td  class = 'new_btn' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;border-right:1px solid #aaaaaa;cursor:pointer;' onclick='show_click_data_list(14)' >미수금</td>-->
                        <td  class = 'new_btn2' style='font-size:14px; color:#ffffff;text-align:center;font-weight:700;cursor:pointer' onclick='show_click_data_list(5)' >합계</td>
                    </tr>
                </thead>
                <tbody>
                    <tr align="right" style='height:60px' >         
                        <td class='new_data' id='td_month11' onclick='month_price_click(11)' style="cursor:pointer">
                            <text class='fmont' id="month_term_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="month_term_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="month_term_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>
                        </td>
                        <td class='new_data' id='td_month12' onclick='month_price_click(12)' style="cursor:pointer">
                            <text class='fmont' id="month_count_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="month_count_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="month_count_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>
                        </td>
                        <td class='new_data' id='td_month13' onclick='month_price_click(13)' style="cursor:pointer">
                            <text class='fmont' id="month_other_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="month_other_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="month_other_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>
                        </td>
<!--
                        <td class='new_data' id='td_month1' onclick='month_price_click(1)' style="cursor:pointer"><text class='fmont' id="month_card_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>
                        <td class='new_data' id='td_month2' onclick='month_price_click(2)' style="cursor:pointer"><text class='fmont' id="month_cash_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>
-->
                        
<!--                        <td class='new_data' id='td_month3' onclick='month_price_click(3)' style="cursor:pointer"><text class='fmont' id="month_refund_price" style='font-size: 14px; color:#009ef7;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text></td>-->
                        <!--월 미수금 회수 : 보여지지 않음-->
                        <td class='new_data' id='td_month4' onclick='month_price_click(4)' style="cursor:pointer;display:none">
                            <text class='fmont' id="month_remain_price" style='font-size: 14px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text><br>
                            <span>
                                <img src="./img/icon_card_img.png" style="width:15px;margin-top:6px">&nbsp;
                                <text class='fmont' id="month_getremain_price_card" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;+
                                <img src="./img/icon_cash_img.png" style="width:15px;margin-top:8px">&nbsp;
                                <text class='fmont' id="month_getremain_price_cash" style='font-size: 10px; color:#000000;font-weight:600;text-align:right;'>0</text>&nbsp;
                            </span>

                        </td>
                        <!--월 미수금 : 보여짐 -->
<!--
                        <td class='new_data' id='td_month14' onclick='month_price_click(14)' style="cursor:pointer;">
                            <text class='fmont' id="month_nogetremain_count" style="font-size: 12px; color:#0000ff;font-weight:400;float:left;margin-left:10px;margin-top:4px">0건</text>
                            <text class='fmont' id="month_nogetremain_price" style='font-size: 14px; color:#bbbbbb;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#bbbbbb;text-align:right; font-weight:500;'>원</text><br>
                        </td>
-->
                        <td class='new_data' style="cursor:pointer">
                            <text class='fmont' id="month_total_price" style='font-size: 14px; color:#f4436d;font-weight:600;text-align:right;'>0</text>&nbsp;<text style=' font-size:14px; color:#2d2d30;text-align:right; font-weight:500;'>원</text>
                        </td>

                    </tr>

                </tbody>
            </table>   
            <div style='width:100%;height:50px;margin-top:40px'>
                <button id='btn_download_excel' onclick="download_excel()" style='float:left;border:0px;background-color:#1d7146;border-radius:5px;font-size:14px;color:white;font-weigh:500;width:230px;height:35px;outline:none'><img src = './img/ic_excel.png' style='height:22px;margin-top:-1px;margin-right:10px'/>&nbsp;매출현황 엑셀로 다운로드</button>
                <span style="float:right">
                    <div>

                        <i class="fa-solid fa-circle-question" style="margin-top:4px;color:#9c9daf" title='색깔별로 해당 목록이 있는지 표시합니다. 잘못된 금액표기, 잘못된 입력등을 관리자와  직원간 소통부분 , 관리자는 다시체크요청을 할 수 있으며 담당직원은 해당부분을 확인하여 다시 확인요청을 합니다. 이상이 없으면 관리자는 다시 완료로 설정합니다.'></i>&nbsp;
                        <svg style='width:13px;height:13px;'><rect width='13' height='13' rx='3' ry='3' style='fill:#ffacac'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>다시체크</text>&nbsp;&nbsp;
                        <svg style='width:13px;height:13px'><rect width='13' height='13' rx='3' ry='3' style='fill:#ddddee'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>확인요청</text>&nbsp;&nbsp;
                        <svg style='width:13px;height:13px'><rect width='13' height='13' rx='3' ry='3' style='fill:#cffccf'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>다시체크+확인요청</text>&nbsp;&nbsp;
                        <svg style='width:13px;height:13px'><rect width='13' height='13' rx='3' ry='3' style='fill:white;stroke:#9fc6e8;stroke-width:2'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>오늘날짜</text>&nbsp;&nbsp;
                        <svg style='width:8px;height:8px'><rect width='8' height='8' rx='4' ry='4' style='fill:#f2923a;'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>신규등록</text>&nbsp;&nbsp;
                        <svg style='width:8px;height:8px'><rect width='8' height='8' rx='4' ry='4' style='fill:#7768d8;'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>재등록</text>&nbsp;&nbsp;
                        <svg style='width:8px;height:8px'><rect width='8' height='8' rx='4' ry='4' style='fill:#f4436d;'></rect></svg>&nbsp;<text style='font-size:13px; color:#3f4254;font-weight:500;'>등록합계</text>&nbsp;&nbsp;
                        
                    </div>
                </span>
            </div>
        </div>
<!--        <h5 id ="manager"></h5>-->
        <div class="calendar_container theme-showcase">
            <br>
            <div id="holder" class="row" ></div>
        </div>
    </div>

    
</div>

    





<script type="text/tmpl" id="tmpl">

  {{ 
  var date = date || new Date(),
      month = date.getMonth(), 
      year = date.getFullYear(), 
      first = new Date(year, month, 1), 
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(), 
      thedate = new Date(year, month, 1 - startingDay),
      dayclass = lastmonthcss,
      today = new Date(),
      i, j; 
      
      

  var date = date || new Date(),
      month = date.getMonth(), 
      year = date.getFullYear(), 
      first = new Date(year, month, 1), 
      last = new Date(year, month + 1, 0),
      startingDay = first.getDay(), 
      thedate = new Date(year, month, 1 - startingDay),
      dayclass = lastmonthcss,
      today = new Date(),
      i, j; 
      
       
  if (mode === 'week') {
    thedate = new Date(date);
    thedate.setDate(date.getDate() - date.getDay());
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(last.getDate()+6);
  } else if (mode === 'day') {
    thedate = new Date(date);
    first = new Date(thedate);
    last = new Date(thedate);
    last.setDate(thedate.getDate() + 1);
  }
  
  }}
  <div align="center" style="width:100%;height:80px;">
              <hr style="border: solid 1px #eff2f5;margin-top:0px;margin-left:-17px;margin-right:-17px;">
                    
                   <!-- 좌우화살표 -->   
                    <span class="btn-group" style="float:left;margin-top:8px">
                        <button class="js-cal-prev btn btn-default" style="background-color:#3e7db8;color:white;padding-top:10px;padding-bottom:10px"><i class="fa-solid fa-angle-left"></i></button>
                        <button class="js-cal-next btn btn-default" style="background-color:#3e7db8;color:white;padding-top:10px;padding-bottom:10px"><i class="fa-solid fa-angle-right"></i></button>
                    </span>
                     
                  <!-- Today -->   
                    <button style="float:left;margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;margin-left:10px;" class="js-cal-option btn btn-default {{: first.toDateInt() <= today.toDateInt() && today.toDateInt() <= last.toDateInt() ? 'active':'' }} " data-date="{{: today.toISOString()}}" data-mode="month">Today</button>
                   
                    <span class="btn-group btn-group-lg" style="font-size:18px;font-weight:700">
                                    {{





                    if (mode !== 'day') { 
                }}
                                    <text style="margin-top:10px">{{: year}}년</text>
                                    {{
                        if (mode === 'month') { 
                         var m_month = months[month];
                         
                           
                }}
                                    <text  style="margin-top:10px;margin-left:5px">{{: m_month }}</text>
                                    {{
                        } 
                        if (mode ==='week') { 
                        
                }}
                                    <text  style="margin-top:10px" >{{: shortMonths[first.getMonth()] }} {{: first.getDate() }} - {{: shortMonths[last.getMonth()] }} {{: last.getDate() }}</text>
                                    {{
                        } 
                
                    } else { 
                        var day_date =  date.toDateString();
                        
                        var arr_week = ["Sun","Mon","Tue","Wed","Thu","Fri", "Sat"];
                        var arr_month = ["Jan","Feb","Mar","Apr","May","Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        
                        function getmonthweek(arr,val){
                            var rdata = -1;
                            for(var i = 0 ; i < arr.length; i++){
                                if(arr[i] == val){
                                    rdata = i;
                                    break;
                                }
                            }
                            return rdata;
                        }
                        
                        var arr = day_date.split(' ');
                        
                        var myear = arr[3]+"년";
                        var mmonth = shortMonths[getmonthweek(arr_month,arr[1])];
                        var mday = arr[2]+"일";
                        var mweek = days[getmonthweek(arr_week,arr[0])]+"요일";
                        var mdate = myear+" "+mmonth+" "+mday+" ("+mweek+")"; 
                        
                        
                }}
                                    <text style="margin-top:10px">{{: mdate }}</text>
                                    {{
                    } 
                }}
                    </span>
                   
                    <span class="btn-group" style="float:right">

                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='year'? 'active':'' }}" data-mode="year">년</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='month'? 'active':'' }}" data-mode="month">월</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='week'? 'active':'' }}" data-mode="week">주</button>
                      <button style="margin-top:8px;background-color:#3e7db8;height:38px;color:white;font-size:13px;"  class="js-cal-option btn btn-default {{: mode==='day'? 'active':'' }}" data-mode="day">일</button>
                    </span>
                   

                    <button id="btn_dummy_insert" style="float:right;margin-top:8px;margin-right:10px;background-color:#3e7db8;height:38px;color:white;border:0px;border 0px;border-radius:3px;font-size:13px;padding-left:15px;padding-right:15px;display:none" onclick="dummy_button_click()" title="결제내역 이외의 별도의 금액을 입력 가능합니다.">상품입력하기</button>
             

    </div>
   <table style="width:100%">
   
    {{ if (mode ==='year') {
      month = 0;
    }}
    <tbody>
      {{ for (j = 0; j < 3; j++) { }}
      <tr>
        {{ for (i = 0; i < 4; i++) { 
        
            var mm = i+j*4+1 < 10 ? "0"+(1+(i+j*4)) : ""+(1+(i+j*4));
            var txtid = "year_price_"+year+"-"+mm;
            
        }}
            
        <td>
            <text>{{:1+(i+j*4)}}월달</text>&nbsp;&nbsp;&nbsp;&nbsp;
            <text style="color:#f4436d;font-weight:bold" id="{{:txtid}}"></text>
            
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
    {{ if (mode ==='month' || mode ==='week') { }}
    <thead>
            <tr class="c-weeks" align="center" style="height:38px;background-color:#f5f6f8">
                {{ for (i = 0; i < 7; i++) { }}
                <th class="c-name" style="font-size:14px; color:#3f4254;text-align:center; font-weight:500;border:1px solid #eaf0f1">
                    {{: days[i] }}
                </th>
                {{ } }}
            </tr>
    <tbody>
      {{ for (j = 0; j < 6 && (j < 1 || mode === 'month'); j++) { }}
      <tr >
        {{ for (i = 0; i < 7; i++) { }}
        {{ if (thedate > last) { dayclass = nextmonthcss; } else if (thedate >= first) { dayclass = thismonthcss; } 
          
           
        }}
        
        <td class="calendar-day {{: dayclass }} {{: thedate.toDateCssClass() }} {{: date.toDateCssClass() === thedate.toDateCssClass() ? 'selected':'' }} {{: daycss[i] }} js-cal-option" data-date="{{: thedate.toISOString() }}" style="border:2px solid #eaf0f1;vertical-align: top;">
          <div id="div_month_data{{: thedate.toDateCssClass() }}" height="50" align="left" valign="top" style="background-color:#FFFFFF;">
           <div align="right" class="date fmont" style="margin-right:10px;margin-top:7px;margin-bottom:7px;font-size:17px;color#3f4254;font-weight:700">{{: thedate.getDate() }}</div>
            <text id = "text_ornercheckdata{{: thedate.toDateCssClass() }}" style="display:none"></text>
            
          {{ if(dayclass == "current"){ }}
                
                <!-- 달력안 : 신규, 재등록 ,등록합계 -->
                <div align="center" style="width:94%;height:27px;background-color:#f6f7f7;margin-left:5px;margin-right:5px;border-radius:4px">
                    
                       <svg style="width:6px;height:6px;"><rect width="6" height="6" rx="3" ry="3" style="fill:#f2923a;"></rect></svg>
                       <label class="fmont" id="txt_new{{: thedate.toDateCssClass() }}" style="font-size:12px; color:#000000;font-weight:500;margin-right:30px;" title="신규등록 횟수">0</label>
                       <svg style="width:6px;height:6px;"><rect width="6" height="6" rx="3" ry="3" style="fill:#7768d8;"></rect></svg>&nbsp;
                       <text class="fmont" id="txt_renewal{{: thedate.toDateCssClass() }}" style="font-size:12px; color:#000000;font-weight:500;margin-right:30px;" title="재등록 횟수">0</text>
                       <svg style="width:6px;height:6px;"><rect width="6" height="6" rx="3" ry="3" style="fill:#f4436d;"></rect></svg>&nbsp;
                       <text class="fmont" id="txt_total_user{{: thedate.toDateCssClass() }}" style="font-size:12px; color:#000000;font-weight:500;" title="신규등록 + 재등록 횟수">0</text>
                    
                </div>
                
                <!-- 미수금 -->
                <text id="txt_remaincount{{: thedate.toDateCssClass() }}" style="font-size:12px;color:blue;float:right;margin-right:12px;cursor:pointer;"></text><br>
                <text id="txt_nogetremainprice{{: thedate.toDateCssClass() }}" style="font-size:12px;color:blue;float:right;margin-right:12px;cursor:pointer;display:none"></text>
                <!-- 삭제건수 -->
                <text id="txt_delete{{: thedate.toDateCssClass() }}" style="font-size:12px;color:red;float:right;margin-right:12px;cursor:pointer;"></text><br>
                
                <!-- 카드 -->
                <div style="margin-right:2px;margin-top:5px;font-size:14px;text-align:left">
                    <span style="float:left;padding:-4px 1;">
                        <text style="font-size:13px; color:#5e6278;font-weight:500; text-align:left;margin-left:10px">카드</text>
                    </span>
                    <text id="txt_card{{: thedate.toDateCssClass() }}" style="float:right;margin-right:10px;font-size:13px; color:#000000;font-weight:500;">0</text>
                </div>
                <br>
                <!-- 현금 -->
                <div style="margin-right:2px;margin-top:5px;ont-size:14px;text-align:left">
                    <span style="float:left;padding:-4px 1;">
                        <text style="font-size:13px; color:#5e6278;font-weight:500; text-align:left;margin-left:10px">현금</text>
                    </span>
                    <text id="txt_cash{{: thedate.toDateCssClass() }}" style="float:right;margin-right:10px;font-size:13px; color:#000000;font-weight:500;">0</text>
                </div>
                <br>
                <!-- 환불 -->
                <div style="margin-right:2px;margin-top:5px;font-size:14px;text-align:left">
                    <span style="float:left;padding:-4px 1;">
                        <text style="font-size:13px; color:#5e6278;font-weight:500; text-align:left;margin-left:10px">환불</text>
                    </span>
                    <text id="txt_refund{{: thedate.toDateCssClass() }}" style="float:right;margin-right:10px;font-size:13px; color:#009ef7;font-weight:500;">0</text>
                </div>
                <br>
                <!-- 미수금 회수 -->
                <div id="div_remain{{: thedate.toDateCssClass() }}" style="display:none;margin-right:2px;margin-top:5px;font-size:14px;text-align:left">
                    <span style="float:left;padding:-4px 1;">
                        <text style="font-size:13px; color:#5e6278;font-weight:500; text-align:left;margin-left:10px">미수금회수</text>
                    </span>
                    <text id="txt_remain{{: thedate.toDateCssClass() }}" style="float:right;margin-right:10px;font-size:13px; color:#000000;font-weight:500;">0</text>
                </div>
                <br>
                
                
                <hr style="border:1px dashed #cfcfcf;margin-top:3px;margin-left:5px;margin-right:5px">
                
                <!-- 합계 -->
                <div style="height:30px;margin-right:2px;font-size:14px;text-align:left;margin-top:-5px">
                    <span style="float:left;padding:-4px 1;">
                        <text style="font-size:13px; color:#5e6278;font-weight:500; text-align:left;margin-left:10px">합계</text>
                    </span>
                    <text id="txt_total_price{{: thedate.toDateCssClass() }}" style="float:right;margin-right:10px;font-size:13px; color:#f4436d;font-weight:500;">0</text>
                </div>
            </div>
            {{ } }}
          {{ thedate.setDate(thedate.getDate() + 1);}}
        </td>
        {{ } }}
      </tr>
      {{ } }}
    </tbody>
    {{ } }}
    {{ if (mode ==='day') { 
    
        
        var yy = thedate.getFullYear();
        var mm = (thedate.getMonth() + 1) < 10 ? "0"+(thedate.getMonth() + 1) : (thedate.getMonth() + 1);
        var dd = thedate.getDate() < 10 ? "0"+thedate.getDate() : thedate.getDate();
        var now = yy + "-" + mm + "-" + dd;
        var dday = getDDay(now);
        
        isnewstyle = compare_date(now,NEW_CHANGEDAY) >= 0 ? true : false;
        
        
    }}
    <tbody>
      <tr>
        <td colspan="7">
          <table id ="table_calendar_day{{: thedate.toDateCssClass() }}" style="width:100%;display:none" >
            <thead>
                 {{ if (!isnewstyle) {  }}
                    <tr style="border: 1px solid #e9e9e9;height:50px;background-color:#f5f6f8;font-size:14px;color:#212529;font-weight:500;text-align:center;">
                        <td style="vertical-align:middle;width:70px;border: 1px solid #e9e9e9;">구분</td>
                        <td style="vertical-align:middle;width:100px;border: 1px solid #e9e9e9;">이름</td>
                        <td style="vertical-align:middle;width:60px;border: 1px solid #e9e9e9;">결제자</td>
                        <td style="vertical-align:middle;width:150px;border: 1px solid #e9e9e9;">결제항목</td>
                        <td style="vertical-align:middle;width:100px;border: 1px solid #e9e9e9;">시작일</td>
                        <td style="vertical-align:middle;width:100px;border: 1px solid #e9e9e9;">종료일</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">라커가격</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;padding-left:7px;padding-right:7px">헬스/PT.GX 가격</td>
                        <td style="display:none;vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">카드</td>
                        <td style="display:none;vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">현금</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">미수금</td>
                        <td style="display:none;vertical-align:middle;width:90px;border: 1px solid #e9e9e9;color:#009ef7">할인</td>
                        <td style="vertical-align:middle;width:190px;border: 1px solid #e9e9e9;">결제총액(승인번호)</td>
                        <td style="vertical-align:middle;width:95px;border: 1px solid #e9e9e9;">특이사항</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">확인</td>
                    </tr>    
                  {{ } else { }}
                    <tr style="border: 1px solid #e9e9e9;height:50px;background-color:#f5f6f8;font-size:14px;color:#212529;font-weight:500;text-align:center;">
                        <td style="vertical-align:middle;width:70px;border: 1px solid #e9e9e9;">구분</td>
                        <td style="vertical-align:middle;width:100px;border: 1px solid #e9e9e9;">이름</td>
                        <td style="vertical-align:middle;width:60px;border: 1px solid #e9e9e9;">결제자</td>
                        <td style="vertical-align:middle;width:150px;border: 1px solid #e9e9e9;">결제항목</td>
                        <td style="vertical-align:middle;width:100px;border: 1px solid #e9e9e9;">시작일</td>
                        <td style="vertical-align:middle;width:100px;border: 1px solid #e9e9e9;">종료일</td>
                        <td style="display:none;vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">라커가격</td>
                        <td style="display:none;vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">헬스/PT.GX 가격</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">카드</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">현금</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">미수금</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;color:#009ef7">할인</td>
                        <td style="vertical-align:middle;width:190px;border: 1px solid #e9e9e9;">결제총액(승인번호)</td>
                        <td style="vertical-align:middle;width:95px;border: 1px solid #e9e9e9;">특이사항</td>
                        <td style="vertical-align:middle;width:90px;border: 1px solid #e9e9e9;">확인</td>
                    </tr>
                  {{ } }}
              
            </thead>
            <tbody style="width:100%;border:1px solid #e9e9e9;">
              
              
              {{for (i = 0; i < 300; i++) { }}
              
                 {{ if (!isnewstyle) {  }}
                    <tr align="center" class="fmont" id="id_tr_day_{{: i }}" style="font-size:14px;height:70px;background-color:white;border:1px solid #e9e9e9">                
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-membership_type"></td>                
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-name"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-constructor"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9;padding:7px" class="time-{{: i}}-desc"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-starttime"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-endtime"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-locker_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-term_or_count_price"></td>
                        <td style="display:none;display:none;vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-card_price"></td>
                        <td style="display:none;vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-cash_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-remain_price"></td>
                        <td style="display:none;vertical-align:middle;border:1px solid #e9e9e9;color:#009ef7" class="time-{{: i}}-discount_price"></td>
                        <td align="left" style="text-align:left;padding-left:10px;vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-total_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-other"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-ornercheck"></td>
                    </tr>
                 {{ } else { }}
                    <tr align="center" class="fmont" id="id_tr_day_{{: i }}" style="font-size:14px;height:70px;background-color:white;border:1px solid #e9e9e9">                
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-membership_type"></td>                
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-name"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-constructor"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9;padding:7px" class="time-{{: i}}-desc"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-starttime"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-endtime"></td>
                        <td style="display:none;vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-locker_price"></td>
                        <td style="display:none;vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-term_or_count_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-card_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-cash_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-remain_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9;color:#009ef7" class="time-{{: i}}-discount_price"></td>
                        <td align="left" style="text-align:left;padding-left:10px;vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-total_price"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-other"></td>
                        <td style="vertical-align:middle;border:1px solid #e9e9e9" class="time-{{: i}}-ornercheck"></td>
                    </tr>
                 
                 {{ } }}
              
              {{ } }}
              
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
    {{ } }}
  </table>
</script>

<script>

    
    var isnewstyle = false;
    
    // var click_day_tds = [false,false,false,false,false,false,false];    
    //첫번째는 안쓴다. 1~ 6까지 배열만 쓴다.
     //                     XXX , 카드 , 현금 ,환불 ,미수금회수, 신규등록, 재등록 
     var click_month_tds = [false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false];    
     var click_month_on_dates = [];
     var click_data_list = [[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]];
     function isclick_month_day(date,type){
//         console.log("isclick_month_day date "+date+" type "+type);
         var flg = false;
         if(type == CLICKTYPE.card_cash){
             flg = click_month_tds[CLICKTYPE.card] || click_month_tds[CLICKTYPE.cash] ? true : false;

         }
         else {



             if(click_month_tds[type]){
                click_month_on_dates.push(date);
                click_month_on_dates = trim_array(click_month_on_dates);
                 flg =  true;
             }else{
                 flg = false;
             }
         }
         return flg;

     }
    function check_month_on_date(){
        var allblock = document.getElementsByClassName("calendar-day");

        for(var i = 0 ; i < allblock.length; i++){
            for(var j = 0 ; j < click_month_on_dates.length;j++){
                var classname = allblock[i].className;
                var date = click_month_on_dates[j];
                if(classname.indexOf(date) >=0){
                    var div_bg = document.getElementById("div_month_data"+date);
                    div_bg.style.backgroundColor="#fffc9f";
                }
            }
        }
    }
    function clicOnBg(ison,obj){
         if(ison){
            obj.style.backgroundImage = "linear-gradient(to bottom, #f1f084 0px, #fdff8f 100%)";
            obj.style.backgroundSize="100% 100%";
             
         }else{
            obj.style.backgroundImage = "linear-gradient(to bottom, #e4e6ef 0px, #f2f3f7 100%)";
            obj.style.backgroundSize="100% 100%";     
         }
        
     }
    function month_price_click(type){
        
        click_month_tds[type] = !click_month_tds[type];
        var td_month = document.getElementById("td_month"+type);        
        var td_day = document.getElementById("td_day"+type); 
        td_month.style.backgroundColor = "white";
        td_day.style.backgroundColor = "white";
        var ison = click_month_tds[type];
        clicOnBg(ison, td_month);
        clicOnBg(ison, td_day);
        
//        if(ison){
//            clog("click_data_list ",click_data_list[type]);
//        }
        
        window.mdraw();
        
    }
    function show_click_data_list(type){
        
//        1 카드
//        2 현금
//        3 환불 
//        4 미수금 회수 (안보임)
//
//        5 합계
//        6 신규등록
//        7 재등록
//        8 등록합계
//
//        11 기간제 매출
//        12 횟수제 매출
//        13 기타
//
//        14 미수금
        
        var mode = window.options && window.options.mode ? window.options.mode : "";
        if(mode != "month"){
             alertMsg("<br>월 달력화면에서만 목록을 볼 수 있습니다.<br><br>");
            return;
        }
//        console.log("type ",type);
        var result = [];
        //총합계금액
        if(type == CLICKTYPE.totalprice){
            for(var j = 0 ; j < click_data_list[CLICKTYPE.card].length; j++){
                result.push(click_data_list[CLICKTYPE.card][j]);
            }
            for(var j = 0 ; j < click_data_list[CLICKTYPE.cash].length; j++){
                result.push(click_data_list[CLICKTYPE.cash][j]);
            }
            for(var j = 0 ; j < click_data_list[CLICKTYPE.refund].length; j++){
                result.push(click_data_list[CLICKTYPE.refund][j]);
            }
            for(var j = 0 ; j < click_data_list[CLICKTYPE.remain].length; j++){
                result.push(click_data_list[CLICKTYPE.remain][j]);
            }
        }
        //등록합계
        else if(type == CLICKTYPE.totalinsert){
        
            for(var j = 0 ; j < click_data_list[CLICKTYPE.new].length; j++){
                result.push(click_data_list[CLICKTYPE.new][j]);
            }
            for(var j = 0 ; j < click_data_list[CLICKTYPE.renewal].length; j++){
                result.push(click_data_list[CLICKTYPE.renewal][j]);
            }
            
        }
        //기간제
        else if(type == CLICKTYPE.term){
        
            for(var j = 0 ; j < click_data_list[CLICKTYPE.term].length; j++){
                result.push(click_data_list[CLICKTYPE.term][j]);
            }
//            for(var j = 0 ; j < click_data_list[CLICKTYPE.count].length; j++){
//                result.push(click_data_list[CLICKTYPE.count][j]);
//            }
            
        }
        //횟수제
        else if(type == CLICKTYPE.count){
        
//            for(var j = 0 ; j < click_data_list[CLICKTYPE.term].length; j++){
//                result.push(click_data_list[CLICKTYPE.term][j]);
//            }
            for(var j = 0 ; j < click_data_list[CLICKTYPE.count].length; j++){
                result.push(click_data_list[CLICKTYPE.count][j]);
            }
            
        }
        else{
            result = click_data_list[type];
        }
//        console.log("click_data_list ",click_data_list);
//        console.log("result ",result);
        var txt_title_types = ["","카드","현금","환불","미수금회수","총금액","신규등록","재등록","등록합계","","","기간제","횟수제","기타","미수금"];
        
        var style = {
            bodycolor: "#eeeeee",
            size: {
                width: "90%",
                height: "100%"
            }
        };
        showModalDialog(document.body,txt_title_types[type], getDataList(result), "확인", null,function(){
            hideModalDialog();
        },function(){},style);    
    }
    function getDataList(rows) {
        console.log("getDataList ");
        var div_member_table =document.createElement("div");
        var table = document.createElement('table');                                                      //등록일 = couponid                               
        /* 221028 유진 수정 */
        table.innerHTML = rows && rows.length > 0 ? "<thead><tr style='height:30px;background-color:#eeeeee;font-size:12px;text-align:center;' align='center' ><th>인덱스</th><th>등록일</th><th>구분</th><th>이름</th><th>결제자</th><th>결제항목</th><th>시작일</th><th>종료일</th><th>카드</th><th>현금</th><th>미수금</th><th>할인</th><th>결제총액(승인번호)</th><th>특이사항</th></tr></thead><tfoot></tfoot><tbody></tbody>" : "목록이 없습니다.";
        table.style.class = 'table table-bordered';
        table.width="100%";
        
        table.cellspacing="0";
        table.className="table table-bordered";
        table.style.margin = "10px";
        table.style.width = "auto";
        
        var head = table.getElementsByTagName("thead")[0];
        var body = table.getElementsByTagName("tbody")[0];
        var foot = table.getElementsByTagName("tfoot")[0];
        var len = rows.length;
        
        div_member_table.append(table);
        var isbeforesame = false;
        var bg_color_cnt = 0;
        if (len > 0) {
            for (var i = 0; i < len; i++) {
               
                var datas = rows[i];    
                var brow = body.insertRow();
                if(i > 0 && isSameCouponid(rows[i-1] , datas)){
                    isbeforesame = true;
                }
                    
                else{
                    isbeforesame = false;
                    bg_color_cnt++;
                } 
                    
                   
                
                var bgcolor = bg_color_cnt%2 == 0 ? "#e1ece9" : "white";
                 body.rows[i].style.backgroundColor = bgcolor;
               
                // 인덱스
                var bcell_index = brow.insertCell();
                bcell_index.innerHTML = (i+1)+"";
                bcell_index.style.maxWidth="30px";
                
                
                // 등록일       
                var bcell_id = brow.insertCell();
                bcell_id.innerHTML = datas.paymentid;

                // 구분       
                var bcell_type = brow.insertCell();
                bcell_type.innerHTML = datas.membership_type == "TERM" ? "헬스" : "P.T";

                // 이름       
                var bcell_name = brow.insertCell();
                bcell_name.innerHTML = datas.name;

                // 결제자       
                var bcell_constructor = brow.insertCell();
                bcell_constructor.innerHTML = datas.constructor;

                // 결제항목       
                var bcell_desc = brow.insertCell();
                bcell_desc.innerHTML = datas.desc;

                // 시작일       
                var bcell_starttime = brow.insertCell();
                bcell_starttime.innerHTML = datas.starttime;

                // 종료일     
                var bcell_endtime = brow.insertCell();
                bcell_endtime.innerHTML = datas.endtime;

                var remainprice = JSON.parse(datas.remain_price);
                
                
                // 카드가격     
                var bcell_cardprice = brow.insertCell();
                bcell_cardprice.innerHTML = number_format(remainprice.card);
                if(datas.coupontype == "R" && datas.term_or_count_price == 0 && remainprice && remainprice.card != 0)bcell_cardprice.innerHTML = "-"+number_format(remainprice.card);
                
                // 현금가격     
                var bcell_cashprice = brow.insertCell();
                bcell_cashprice.innerHTML = number_format(remainprice.cash);
                if(datas.coupontype == "R" && datas.term_or_count_price == 0 && remainprice && remainprice.cash != 0)bcell_cashprice.innerHTML = "-"+number_format(remainprice.cash);

                // 미수금가격     
                var bcell_remainprice = brow.insertCell();
                bcell_remainprice.innerHTML = remainprice.remain ? number_format(remainprice.remain) : "0";

                // 할인가격     
                var bcell_discountprice = brow.insertCell();
                bcell_discountprice.innerHTML = remainprice.discount ? number_format(remainprice.discount) : "0";

                
                
                
              
                
                // 결제총액(승인번호) 
                var bcell_totalprice = brow.insertCell();                
                var totalprice_tag = "";
                var color = datas.total_price > 0 ?  "#dd0000" : "blue";
                if(isbeforesame){
                     totalprice_tag = "&nbsp;<text style='color:red;font-weight:bold;'>-</text>";
                 }else{
                     var datas_coupontype = datas.coupontype ? datas.coupontype : "U";
                     //환불
                    if( datas.paymenttype == "3"){
                        if(!isbeforesame){
                            var remain_price = JSON.parse(datas.remain_price);
                            var price = remain_price && parseInt(remain_price.card) >= 0 ? Math.floor(remain_price.card) : datas.total_price;
                            if(isbeforesame)price = 0;
                            var inputid = i+"_"+datas.paymentid;
                            var btnid = i+"_"+datas.paymentid+"_btn";
                            totalprice_tag = getCashIcon(datas.paymenttype)+"&nbsp;<text style='color:"+color+";font-weight:bold'>"+number_format(price)+"</text><br><input id='"+inputid+"' style='width:80%' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...'><button id='"+btnid+"'  value='"+datas.paymentid+"' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas_coupontype + "\")'>입력</button>";

                        }

                    }//카드결제                          
                    else if(datas.paymenttype == "1"){

                        
                        var remain_price = JSON.parse(datas.remain_price);
                        var price = remain_price && parseInt(remain_price.card) >= 0 ? Math.floor(remain_price.card) : datas.total_price;
                        if(isbeforesame)price = 0;
                        var inputid = i+"_"+datas.paymentid;
                        var btnid = i+"_"+datas.paymentid+"_btn";
                        totalprice_tag = getCashIcon(datas.paymenttype)+"&nbsp;<text style='color:"+color+";font-weight:bold'>"+number_format(price)+"</text><br><input id='"+inputid+"' style='width:80%' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...'><button id='"+btnid+"'  value='"+datas.paymentid+"' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas_coupontype + "\")'>입력</button>";

                    }                          
                    //카드 + 현금결제
                    else if(datas.paymenttype == "4"){
                        var inputid = i+"_"+datas.paymentid;
                        var btnid = is_SameCoupon+"_"+datas.paymentid+"_btn";
                        var remain_price = JSON.parse(datas.remain_price);
                        totalprice_tag = getCashIcon(2)+"&nbsp;<text style='color:"+color+";font-weight:bold'>"+number_format(Math.floor(remain_price.cash))+"</text>&nbsp;+<br>"+getCashIcon(1)+"&nbsp;<text style='color:"+color+";font-weight:bold'>"+number_format(Math.floor(remain_price.card))+"</text><br><input id='"+inputid+"' style='width:80%' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas_coupontype + "\")'><button id='"+btnid+"'  value='"+datas.paymentid+"'>입력</button>";

                    }//현금결제                            
                    else {
                         var inputid = i+"_"+datas.paymentid;
                        var btnid = is_SameCoupon+"_"+datas.paymentid+"_btn";
                        var remain_price = JSON.parse(datas.remain_price);
                        var price = remain_price && parseInt(remain_price.cash) >= 0 ? Math.floor(remain_price.cash) : datas.total_price;
                        if(isbeforesame)
                            totalprice_tag = "<text style='color:"+color+";font-weight:bold;'>-</text>";
                        else
                            totalprice_tag = getCashIcon(datas.paymenttype)+"&nbsp;<text style='color:"+color+";font-weight:bold;'>"+number_format(price)+"</text><br><input id='"+inputid+"' style='width:80%' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas_coupontype + "\")'><button id='"+btnid+"'  value='"+datas.paymentid+"'>입력</button>";

                    }
                }   
                bcell_totalprice.innerHTML = totalprice_tag;
                
                if(datas.coupontype == "R" && remainprice && remainprice.total_remain)
                    bcell_totalprice.innerHTML =  "-"+number_format(remainprice.total_remain);

                // 특이사항
                var bcell_other = brow.insertCell();
                bcell_other.innerHTML = datas.other;

                
            }
        }
        
        
        return "<div style='max-height:700px;overflow-y:scroll'>"+div_member_table.innerHTML+"</div>";
        
    }

    
    holidayCheckNoText();
    
    var arr_years = [];
    var param_day = "";
    var param_year = 0;
    
    var thisyear = stringGetYear(getToday());
    var thismonth = stringGetMonth(getToday())-1;
    
    var allpayments = []; 
    var now_groupcode = getData("nowgroupcode");
    var now_centercode = getData("nowcentercode");
    function checkYearData(year){
        
        var isyear = false;
        for(var i =0 ; i < arr_years.length;i++){
            if(year == arr_years[i]){
                isyear = true;
                break;
            }
        }
        var value = {}
        value.year = year;
        if(!isyear){
//            init_d_payment(value);
        }
    }
    var isfirst = false;
    //엑셀다운로드버튼 숨기기
    var btn_download_excel = document.getElementById("btn_download_excel");
//    btn_download_excel.innerText  = (thismonth+1)+"월 매출현황 엑셀로 다운로드aaa";
//    btn_download_excel.style.visibility = auth >= AUTH_OPERATOR ? "visible" : "hidden";
//    
//    var div_dummy = document.getElementById("div_dummy");
//    div_dummy.style.visibility = auth >= AUTH_OPERATOR ? "visible" : "hidden";
    
    function download_excel(){        
        exportExcelFile(getData("nowcentername")+"_"+(thisyear)+"년_"+(thismonth+1)+"월_매출목록_"+getToday()+".xlsx");
    }
    function clickCenter(centercode){
//        now_centercode = centercode;
        showCenterPayment(centercode);      
    }
    function showCenterPayment(centercode){

        var value1 = {
            year : param_year,
            month : 0,
            day : 0
        }
        /* 221025 유진 수정 */
        getPaymentData(value1,function(res){
           if(res.code == 100){
               isfirst = arr_years.length == 0 ? true : false;
               insertCalenderDatas(res.message,isfirst);
               allpayments = res.message;
               
               arr_years.push(param_year);
               createExcelData();
               
//               div_center_list.style.display = "none";
//               div_main.style.display = "block";   
           }else{
               
               C_showToast("testid3", "에러", "데이터를 가져올 수 없습니다. 다시 시도하세요", function() {});
                
           }
            hideModalDialog();
        });
    }
    function init_d_payment(value){

        
        clog("d_payment maininit");
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");
        
        var v = value && value.year ? parseInt(value.year) : parseInt(getToday().substr(0,4));//ex) "2021"
        if(value && value.paramday)param_day = value.paramday;
        
        param_year = v;
        checkDayPage();
        
        
        var value1 = {
            year : param_year,
            month : 0,
            day : 0
        }
        clickCenter(getData("nowcentercode"));
    }
    
  var $currentPopover = null;
  $(document).on('shown.bs.popover', function (ev) {
    var $target = $(ev.target);
    if ($currentPopover && ($currentPopover.get(0) != $target.get(0))) {
      $currentPopover.popover('toggle');
    }
    $currentPopover = $target;
  }).on('hidden.bs.popover', function (ev) {
    var $target = $(ev.target);
    if ($currentPopover && ($currentPopover.get(0) == $target.get(0))) {
      $currentPopover = null;
    }
  });
    function ptogglechange(key,paymentid,couponid,uid){
    //    clog("toggle change!!"+ischeck);
        var ptoggle = document.getElementById("ptoggle_"+key);
        var ptoggle_icon = document.getElementById("ptoggle_icon_"+key);
        
        var ptoggle_txt = document.getElementById("ptoggle_txt_"+key);
    //    clog("toggle check ",toggle.checked);
        
        var status = ptoggle.checked ? "N" : "D";
        updateOnlyPaymentData(paymentid,couponid,uid,status,function(res){
            //success;
            if(res == 0){
              
               
                if(ptoggle.checked){
                    ptoggle_txt.innerHTML = "&nbsp;삭제";
                    ptoggle_txt.style.color = "white";
                    ptoggle_icon.style.backgroundColor = "red";

                }else{
                    ptoggle_txt.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;복구";
                    ptoggle_txt.style.color = "white";
                    ptoggle_icon.style.backgroundColor = "blue";

                }
                setTimeout(function(){
                    reload_calendar_page();    
                },200);
                
            }
            else {
                ptoggle.checked = !ptoggle.checked;
            }
            
        });
     }
    
    function onchange_ornercheck(paymentid,uid,couponid,pmidx){
         var select_ornercheck = document.getElementById("ornercheck_"+pmidx);
         
         var value = {
             "paymentid":paymentid,
             "useruid":uid,
             "couponid":couponid,
             "ornercheck":select_ornercheck.value,
             "pmidx":pmidx,
             
         }
         changePaymentOrnercheck(value);
     }
       function changePaymentOrnercheck(value){
        
        
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");

         var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"changepaymentornercheck",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
            code = parseInt(res.code);
            if (code == 100) {

               reload_calendar_page();
            } else {
                alertMsg(res.message,function(){
                    hideModalDialog();       
                });
            }
             
        }, function (err) {
            alertMsg("네트워크 에러 ");

        });
    }
    ///////////////////////////////////////////
    //달력 크기 스케일로 화면에 맞추기
    ///////////////////////////////////////////
//    var zoom = 100;
//    var screen_width = $(window).width();
//    var calendar_width = 700;
//    zoom = (screen_width/calendar_width)*0.95;
//    if(zoom > 1)zoom = 1;
//    clog("zoom is "+zoom);
//    document.getElementsByTagName("head")[0].innerHTML += "<style>.calendar-table {margin: 10px auto;width :  98%;  zoom: "+zoom+";-moz-transform: scale("+zoom+");}</style>";
   

$.extend({
    quicktmpl: function (template) {return new Function("obj","var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('"+template.replace(/[\r\t\n]/g," ").split("{{").join("\t").replace(/((^|\}\})[^\t]*)'/g,"$1\r").replace(/\t:(.*?)\}\}/g,"',$1,'").split("\t").join("');").split("}}").join("p.push('").split("\r").join("\\'")+"');}return p.join('');")}
});

$.extend(Date.prototype, {
  //provides a string that is _year_month_day, intended to be widely usable as a css class
  toDateCssClass:  function () { 
    return '_' + this.getFullYear() + '_' + (this.getMonth() + 1) + '_' + this.getDate(); 
  },
  //this generates a number useful for comparing two dates; 
  toDateInt: function () { 
    return ((this.getFullYear()*12) + this.getMonth())*32 + this.getDate(); 
  },
  toTimeString: function() {
    var hours = this.getHours(),
        minutes = this.getMinutes(),
        hour = (hours > 12) ? (hours - 12) : hours,
        ampm = (hours >= 12) ? ' pm' : ' am';
    if (hours === 0 && minutes===0) { return ''; }
    if (minutes > 0) {
      return hour + ':' + minutes + ampm;
    }
    return hour + ampm;
  }
});


(function ($) {

  //t here is a function which gets passed an options object and returns a string of html. I am using quicktmpl to create it based on the template located over in the html block
    var t = $.quicktmpl($('#tmpl').get(0).innerHTML);

    
    function setYearMonth(date){
        if(date){
            thisyear = date.getFullYear();
            thismonth = date.getMonth();    
        }
        
    }
 function calendar($el, options,key) {
      if(key){
//                 clog("key is "+key);
         if(key == "prev"){
//                     clog("prev --");
            switch(options.mode) {
                case 'year': 
                    options.date.setFullYear(options.date.getFullYear() - 1); 
                break;
                case 'month': 
                    options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1); 
                break;
                case 'week': 
                    options.date.setDate(options.date.getDate() - 7); 
                break;
                case 'day':  
                    options.date.setDate(options.date.getDate() - 1); 
                break;
            }
            setYearMonth(options.date);
            createExcelData();
            checkYearData(options.date.getFullYear());
            param_day = options.mode == "day" ? options.date.getTime() : "";
            draw();
            holidayCheck(true,true,"black");
         }else if(key == "next"){
//                     clog("next !!");
            switch(options.mode) {
                case 'year': 
                    options.date.setFullYear(options.date.getFullYear() + 1); 
                break;
                case 'month': 
                    options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1); 
                break;
                case 'week': 
                    options.date.setDate(options.date.getDate() + 7); 
                break;
                case 'day':  
                    options.date.setDate(options.date.getDate() + 1); 
                break;
            }
            setYearMonth(options.date);
            createExcelData();
            checkYearData(options.date.getFullYear());
            param_day = options.mode == "day" ? options.date.getTime() : "";
            draw();
            holidayCheck(true,true,"black");
         }
     }   
    //actions aren't currently in the template, but could be added easily...
    
      
      
    var before_bdatas = null;
    var tr_colorflg = false;  
    var before_date = "";
    var before_isclick_type = {"ptype" : CLICKTYPE.none,"rtype" : CLICKTYPE.none}; //가격타입 , 신규,재등록 타입 
     
    function dayAddEvent(index, event,max) {
        
        selectday_max_index = index;
        var e = new Date(event.start),
        dateclass = e.toDateCssClass(),
        startint = event.start.toDateInt(),
        dateint = options.date.toDateInt();
        
        var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
        var isbeforesame = false;
        var id_tr_day = document.getElementById("id_tr_day_"+index);
        id_tr_day.style.visibility = "visible";
        if(startint == dateint){
            
            var nday = parseInt(event.start.getDate());
            //background-color:white;border: 2px solid white;
            
            var table_calendar_day = document.getElementById("table_calendar_day"+e.toDateCssClass());
            table_calendar_day.style.display = "block";
//            clog("table_calendar_day ",table_calendar_day);
            if(table_calendar_day){
                var body = table_calendar_day.getElementsByTagName("tbody")[0];
                
                if(index == 0){
//                    body.rows[index].style.backgroundColor = tr_colorflg ? "#e8e8e8" : "white";    
//
//
//                    body.rows[index].style.borderTop = "2px solid gray";
//                    body.rows[index].style.borderLeft = "2px solid gray";
//                    body.rows[index].style.borderRight = "2px solid gray";
//                    var color = tr_colorflg ? "#e8e8e8" : "white";    
//                    body.rows[index].style.borderBottom = "2px solid "+color;

                }else {

                    //이전 데이타와 같이 결제한 쿠폰아이디이다. 
                    if(isSameCouponid(before_bdatas , event.bdatas)){
                       isbeforesame = true;
                        body.rows[index].style.borderTop = "2px solid white";
//                        body.rows[index].style.borderBottom = "2px solid gray";
//                        body.rows[index].style.borderLeft = "2px solid gray";
//                        body.rows[index].style.borderRight = "2px solid gray";

                    }
                    //이전 데이타와 다른 쿠폰아이디이다.
                    else{
//                        tr_colorflg = !tr_colorflg;
//
//                        body.rows[index].style.borderTop = "2px solid gray";
//                        body.rows[index].style.borderLeft = "2px solid gray";
//                        body.rows[index].style.borderRight = "2px solid gray";    
//                        var color = tr_colorflg ? "#e8e8e8" : "white";    
//                        body.rows[index].style.borderBottom = "2px solid "+color;
                    }
//                    body.rows[index].style.backgroundColor = tr_colorflg ? "#e8e8e8" : "white";

                }
            }
            
            
            
            before_bdatas = event.bdatas;
            var isclick_type = {"ptype" : CLICKTYPE.none,"rtype" : CLICKTYPE.none}; //가격타입 , 신규,재등록 타입
            var fields = ["membership_type","profile","name","gender","phone","constructor","desc","starttime","endtime","locker_price","term_or_count_price","card_price","cash_price","remain_id","remain_price","discount_price","total_price","paymenttype","paymentcardnumber","other","ornercheck"];
            if(event.bdatas){

                isclick_type = checknowdaydata(event.bdatas,isbeforesame);               
                
                 
                setTotalDayData(now_day);
                var datas = event.bdatas;
                var isdelete = datas.pmstatus == 'D' ? true : false;  
               
                for(var i = 0  ;i  < fields.length;i++){
                    
                    var value = datas[fields[i]]; 
                    
                    
                    if(fields[i] =="ornercheck"){

                         var select_style = "width:73px; height:33px;background-color:#ffffff;border-radius:5px;border:1px solid #d9dced;padding-left:10px; padding-right:10px;font-size:13px; color:#5e6278;text-align:left; font-weight:500;"
                         var option_tag = auth >= AUTH_OPERATOR ? "<option value ='N' selected>완료</option><option value='R'>다시체크</option>" : "<option value ='N' selected>완료</option><option value='C'>확인요청</option>" ;
                         if(datas[fields[i]] == "R"){ 
                             if(body && body.rows && body.rows[index])body.rows[index].style.backgroundColor = "#ffdcdc";
                             option_tag = auth >= AUTH_OPERATOR ? "<option value='R' selected>다시체크</option><option value ='N'>완료</option>" : "<option value='C'>확인요청</option><option value ='R' selected>다시체크</option>" ;
                         }
                         else if(datas[fields[i]] == "C"){
                             if(body && body.rows && body.rows[index])body.rows[index].style.backgroundColor = "#dcdcff";
                             option_tag = auth >= AUTH_OPERATOR ? "<option value='C' selected>확인요청</option><option value ='N'>완료</option>" : "<option value='C' selected>확인요청</option><option value ='R'>다시체크</option>" ;
                         }
//                        clog("datas ",datas);
                        value = "<select id='ornercheck_"+datas.pmidx+"' onchange='onchange_ornercheck(\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +couponid + "\",\"" +datas.pmidx + "\")' style='"+select_style+"'>"+option_tag+"</select>";
                    }
                    else if(fields[i] =="membership_type"){
//                        clog("datas.membership_type "+value);
//                        value = datas[fields[i]] == "TERM" ? "<text style='font-size: 14px;color:#495057;font-weight:400;text-align:center;'>헬스</text>" : "<text style='font-size: 14px;color:#495057;font-weight:400;text-align:center;'>P.T</text>";
//                        if(datas[fields[i]] == "TERM" && datas["coupontype"] == "G") value = "<text style='font-size: 14px;color:#495057;font-weight:400;text-align:center;'>그룹</text>";
                        var txt_coupontype = { "T" : "기간제" , "G" : "그룹" , "C" : "P.T" , "U" : "알수없음", "L" : "라커" , "TL" : "기간제 + 라커" , "R" :"환불" , "S": "양도", "M" : "미수금환불", "GA" : "횟수/기간추가", "UG" : "업그레이드", "O" : "기타상품"	};
                        var coupon_type = txt_coupontype[datas["coupontype"]];
                        value = "<text style='font-size: 14px;color:#495057;font-weight:400;text-align:center;'>"+coupon_type+"</text>";
                        if(datas.name && datas.name.indexOf("더미입력") >= 0){
                              
                            //뉴버전 매출기록만삭제
                            var id = datas.paymentid+"_"+datas.uid+"_"+datas.couponid;
                            var ison = "checked";
                            var txt_onoff = "삭제";
                            var tmargin_left = "2px";
                            var toggle_textcolor = "white";
                            var toggle_color = "#f2416d";
                            if(isPermission(214)){
                                if(isdelete){
                                    ison = "";
                                    txt_onoff = "복구";
                                    toggle_textcolor = "white";
                                    toggle_color = "#009df8";
                                    tmargin_left = "27px";

                                }

                                value = "<label class='switch' style='margin-top:10px'><input id='ptoggle_"+id+"' type='checkbox' onchange='ptogglechange( \""+id+"\",\"" +datas.paymentid + "\",\"" +datas.couponid + "\",\"" +datas.uid + "\")'  style='color:"+toggle_textcolor+"' "+ison+"><span id='ptoggle_icon_"+id+"' class='slider round' style='background-color:"+toggle_color+"'><text id='ptoggle_txt_"+id+"'style='float:left;font-size:12px;font-weight:bold;margin-top:8px;z-index:3;color:"+toggle_textcolor+";margin-left:"+tmargin_left+"'>&nbsp;"+txt_onoff+"</text></span></label>";
                            }else{
                                value = "";
                            }
                        }
//                        value = isdelete ? "<del>"+value+"</del>" : value;
                    }
                    else if(fields[i] =="name"){
                        var gender = datas[fields[3]];
                        var gendertag = get_gender_icontag(gender);
                        var btn_bgcolor = "#009ef7";
                        var username = datas.name;
                        if(datas.name && datas.name.indexOf("더미입력") >= 0){
                            username = "상품입력";
                            gendertag = get_gender_icontag("DUMMY");
                            btn_bgcolor = "#19c9c7";
                        }
                        
                        value = !isbeforesame ? "<button onclick='showUserInfoPopup(\"" +datas.userid + "\")' style='width:90px; height:35px;border:0px;font-size: 14px; color:#ffffff;font-weight:700;border-radius:5px;background-color:"+btn_bgcolor+"'>"+gendertag+" "+username+"</button>" : "";
                    }    
                    else if(fields[i] =="card_price" || fields[i] =="cash_price" || fields[i] =="discount_price"){
                        
                        var couponid = datas.couponid;
                        var json_remainprice = datas["remain_price"] ? JSON.parse(datas["remain_price"]) : null;
//                        clog("datas ",datas);
//                        clog("json_remainprice ",json_remainprice);
                        var keyname = fields[i] =="card_price" ? "card" : "cash";
                        if(fields[i] == "discount_price") keyname = "discount";
                        
                        value = json_remainprice && json_remainprice[keyname] ? ""+TXT_WON+CommaString(json_remainprice[keyname]) : TXT_WON+"0";
                    }
                    else if(fields[i] =="remain_price"){
//                        clog("datas.name "+event.bdatas["name"]+" "+event.bdatas["remain_price"]);
                        var inputid = index+"_"+datas.paymentid;
                        var couponid = datas.couponid;
                        var remainid = datas["remain_id"];
                        
                        var remainfinish = datas["remainfinish"];
                        var json_remainprice = datas[fields[i]] ? JSON.parse(datas[fields[i]]) : null;
                        
                        
                        if(json_remainprice){
                            var remaindata = setJSONStringToParamString(json_remainprice);
                            var rprice = parseInt(json_remainprice.remain);
                           
                            if(!isbeforesame && rprice > 0){
                                
                                value = remainfinish == "F" ? "<label style='color:#bbbbbb'>"+TXT_WON+number_format(rprice)+"</label>" : "<button id='remainbtn_"+couponid+"'  onclick='btn_remain(\"" +datas.pmidx + "\", \"" +datas.paymentid + "\", \"" +datas.uid + "\", \"" +datas.userid + "\",\"" +datas.name + "\",\"" +couponid + "\", \"" +remainid + "\", \"" +remaindata + "\")'>"+TXT_WON+number_format(rprice)+"</button>";    
                                
                               if(remainfinish != "F") {
                                   now_day.day_nogetremain_price += rprice;
                                   isclick_type.rrtype = CLICKTYPE.nogetremain;
                               }
                            }
                            else {
                                value = TXT_WON+"0";
                            }
                        }else {
                                value = TXT_WON+"0";
                        }
                    }
                    else if(fields[i] =="locker_price" || fields[i] =="term_or_count_price"){
                        value = ""+TXT_WON+number_format(datas[fields[i]]);
                    }
                    else if(fields[i] =="desc"){
                        var desc = datas[fields[i]].replace("헬스 헬스", "헬스");
                        value = desc;
                    }
                    else if(fields[i] =="total_price"){
                        var color = datas[fields[i]] > 0 ?  "#f1416c" : "#009ef7";
                         
                         if(isbeforesame){
                             value = "&nbsp;<text style='color:red;font-weight:bold;'>-</text>";
                         }else{
                             var input_style = "width:122px; height:23px;background-color:#00000000;padding-left:8px;outline:none;font-size: 13px; color:#5e6278;margin-bottom:5px;border:0px;outline:none";
                             var input_btn_style = "width:40px; height:28px;border-radius:5px;background-color:#e4e6ef;border:0px;outline;none;font-size:12px; color:#3f4254;text-align:center; font-weight:500;";
                             //환불
                            if( datas.paymenttype == "3"){
                                if(!isbeforesame){
                                     var remain_price = JSON.parse(datas.remain_price);
                                    //var price = remain_price && parseInt(remain_price.card) >= 0 ? Math.floor(remain_price.card) : datas[fields[i]];
                                    var price = remain_price ? parseInt(remain_price.card)+parseInt(remain_price.cash) : datas[fields[i]];
                                    if(isbeforesame)price = 0;
                                    var inputid = index+"_"+datas.paymentid;
                                    var btnid = index+"_"+datas.paymentid+"_btn";
//                                    console.log("priceis ",price);
                                    value = "<div style='widt:190px;height:30px'>"+getCashIcon(datas.paymenttype,7)+"&nbsp;<text style='color:"+color+";font-size: 14px; text-align:left; font-weight:500;line-height:30px'>"+TXT_WON+number_format(price)+"</text></div>"+
                                            "<div style='width:168px; height:30px;border-radius:5px;border:1px solid #d9dced;'>"+
                                                "<span style='float:left;margin-top:2px;'><input id='"+inputid+"' style='"+input_style+"' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...'></span>"+
                                                "<span style='float:right;'><button id='"+btnid+"' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas.coupontype + "\")' value='"+datas.paymentid+"' style='"+input_btn_style+"'>입력</button><span>"+
                                            "</div>";
                                    
                                }
                               
                            }//카드결제                          
                            else if(datas.paymenttype == "1"){
//                                clog("datas ",datas);
                                var remain_price = JSON.parse(datas.remain_price);
                                var price = remain_price && parseInt(remain_price.card) >= 0 ? Math.floor(remain_price.card) : datas[fields[i]];
                                if(isbeforesame)price = 0;
                                var inputid = index+"_"+datas.paymentid;
                                var btnid = index+"_"+datas.paymentid+"_btn";
                                value = "<div style='widt:190px;height:30px'>"+getCashIcon(datas.paymenttype,7)+"&nbsp;<text style='color:"+color+";font-size: 14px; text-align:left; font-weight:500;line-height:30px'>"+TXT_WON+number_format(price)+"</text></div>"+
                                        "<div style='width:168px; height:30px;border-radius:5px;border:1px solid #d9dced;'>"+    
                                            "<span style='float:left;margin-top:2px;'><input id='"+inputid+"' style='"+input_style+"' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...'></span>"+
                                            "<span style='float:right;'><button id='"+btnid+"' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas.coupontype + "\")' value='"+datas.paymentid+"' style='"+input_btn_style+"'>입력</button></span>"+
                                        "</div>";
                               
                            }                          
                            //카드 + 현금결제
                            else if(datas.paymenttype == "4"){
                                var inputid = index+"_"+datas.paymentid;
                                var btnid = index+"_"+datas.paymentid+"_btn";
                                var remain_price = JSON.parse(datas.remain_price);
                                value = "<div style='widt:190px;height:30px'>"+
                                            getCashIcon(2,7)+"<text style='color:"+color+";font-size: 11px; text-align:left; font-weight:500;line-height:30px'>"+TXT_WON+number_format(Math.floor(remain_price.cash))+"</text>&nbsp;+&nbsp;"+getCashIcon(1,7)+"<text style='color:"+color+";font-size: 11px; text-align:left; font-weight:500;'>"+TXT_WON+number_format(Math.floor(remain_price.card))+"</text></div>"+
                                "<div style='width:168px; height:30px;border-radius:5px;border:1px solid #d9dced;'>"+    
                                    "<span style='float:left;margin-top:2px;'><input id='"+inputid+"' style='"+input_style+"' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...'></span>"+
                                    "<span style='float:right;'><button id='"+btnid+"' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas.coupontype + "\")' value='"+datas.paymentid+"' style='"+input_btn_style+"'>입력</button></span>"+
                                "</div>";
                                
                            }//현금결제                            
                            else {
                                var inputid = index+"_"+datas.paymentid;
                                var btnid = index+"_"+datas.paymentid+"_btn";
                                var remain_price = JSON.parse(datas.remain_price);
                                var price = remain_price && parseInt(remain_price.cash) >= 0 ? Math.floor(remain_price.cash) : datas[fields[i]];
                                if(isbeforesame)
                                    value = "<text style='color:"+color+";font-weight:bold;'>-</text>";
                                else
                                    value = "<div style='widt:190px;height:30px'>"+getCashIcon(datas.paymenttype,7)+"&nbsp;<text style='color:"+color+";font-size: 14px; text-align:left; font-weight:500;line-height:30px'>"+TXT_WON+number_format(price)+"</text></div>"+
                                            "<div style='width:168px; height:30px;border-radius:5px;border:1px solid #d9dced;'>"+    
                                                "<span style='float:left;margin-top:2px;'><input id='"+inputid+"' style='"+input_style+"' value='"+datas.paymentcardnumber+"' title='카드결제일때는 카드승인번호 , 현금일때는 기타 특이사항을 입력해주세요' placeholder='승인번호, 특이사항을 입력...'></span>"+
                                                "<span style='float:right;'><button id='"+btnid+"' onclick='inputcardnumber(\"" +inputid + "\",\"" +datas.paymentid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas.coupontype + "\")' value='"+datas.paymentid+"' style='"+input_btn_style+"'>입력</button></div>"+
                                            "</div>";
                                
                            }
                         }   
                        
                       
                            
                            
                        
                    }
//                    else if(fields[i] == "button"){
//                        
//                        //이전버전  모든연결된 기록 삭제
////                        var str_datas = setJSONStringToParamString(datas);
////                        if(isPermission(121)){
////                            if(!isdelete){
////                                value = "<button onclick='update_payment(\"" +datas.paymentid + "\",\"" +datas.couponid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas.desc + "\", \"D\")' class='btn btn-primary btn-raised' style='background-color:red'>삭제</button>";
////                            }else {
////                                value = "<button onclick='update_payment(\"" +datas.paymentid + "\",\"" +datas.couponid + "\",\"" +datas.uid + "\",\"" +datas.name + "\",\"" +datas.desc + "\", \"N\")' class='btn btn-primary btn-raised' style='background-color:blue'>복구</button>";    
////                            }    
////                        }
//
//                        
//                        
//                        //뉴버전 매출기록만삭제
//                        var id = datas.paymentid+"_"+datas.uid+"_"+datas.couponid;
//                        var ison = "checked";
//                        var txt_onoff = "삭제";
//                        var tmargin_left = "2px";
//                        var toggle_textcolor = "white";
//                        var toggle_color = "#f2416d";
//                        if(isPermission(214)){
//                            if(isdelete){
//                                ison = "";
//                                txt_onoff = "복구";
//                                toggle_textcolor = "white";
//                                toggle_color = "#009df8";
//                                tmargin_left = "27px";
//                              
//                            }
//                            
//                            value = "<label class='switch' style='float:left;margin-top:10px'><input id='ptoggle_"+id+"' type='checkbox' onchange='ptogglechange( \""+id+"\",\"" +datas.paymentid + "\",\"" +datas.couponid + "\",\"" +datas.uid + "\")'  style='color:"+toggle_textcolor+"' "+ison+"><span id='ptoggle_icon_"+id+"' class='slider round' style='background-color:"+toggle_color+"'><text id='ptoggle_txt_"+id+"'style='float:left;font-size:12px;font-weight:bold;margin-top:8px;z-index:3;color:"+toggle_textcolor+";margin-left:"+tmargin_left+"'>&nbsp;"+txt_onoff+"</text></span></label>";
//                        }else{
//                            value = "";
//                        }
//                        
//                        
//                    }
                    else {
//                        clog("value is ",value);
                    }
                    var timeclass = '.time-' + index + '-' + fields[i];
//                    $(timeclass).parent().css("display", "block"); 
                    
                    value = isdelete ? "<del>"+value+"</del>" : value;
//                    if(fields[i] !="remain_price" || fields[i] =="remain_price" && !isbeforesame)//가격아닐때 , 그리고 가격이면서 이전데이타와 다를때 즉 그룹이 아닐때
                        $(timeclass).append(value);
                    
                    //타입을 선택했다면 배경을 노랗게 한다.
                    if(isclick_month_day(sdate,isclick_type.ptype) || isclick_month_day(sdate,isclick_type.rrtype) || isclick_month_day(sdate,isclick_type.rtype) || isclick_month_day(sdate,isclick_type.tctype) )
                        $(timeclass).parent().css("backgroundColor", "#fffc9f"); 
                    if(isbeforesame && before_isclick_type.ptype > 0 && isclick_month_day(sdate,before_isclick_type.ptype) || isbeforesame && before_isclick_type.rtype > 0  && isclick_month_day(sdate,before_isclick_type.rtype))
                        $(timeclass).parent().css("backgroundColor", "#fffc9f"); 
                }   
                
                
            }

            before_date = sdate;
            before_isclick_type = isclick_type;
            
        }
        
        //그아래부분 빈칸들을 안보이게 처리한다.
        if(index == max){
            for(var i = index+1 ; i < 300;i++){
                var timeclass = '.time-' + i + '-' + fields[0];    
                $(timeclass).parent().css("display", "none"); 
            }
        }
        
     }
     
//     var day_price_total_price = 0;
//      var day_price_card = 0;
//      var day_price_cash = 0;
//      var day_price_refund = 0;
    
    
     function checknowdaydata(bdata,isbeforesame){
       
         //ptype : 가격타입 , rrtype : 환불-미수금회수타입 , rtype: 신규,재등록 타입 , tctype: 기간제 횟수제타입
        var isclick_type = {"ptype" : CLICKTYPE.none, "rrtype" : CLICKTYPE.none, "rtype" : CLICKTYPE.none, "tctype":CLICKTYPE.none}; 
        var isdelete = bdata.pmstatus == 'D' ? true : false;  

        
//            clog("==================================="); 
         
//            clog(dateclass+" dateclass   sdate ",bdata.total_price);
            if(bdata.retake == "N"){  //신규유저
                
                now_day.day_new_regist++;
                isclick_type.rtype = CLICKTYPE.new;
            }else if(bdata.retake == "Y"){
                now_day.day_renewal_regist++;
                isclick_type.rtype = CLICKTYPE.renewal;
            }
            
            now_day.day_total_regist = now_day.day_new_regist+now_day.day_renewal_regist

            var paytype = parseInt(bdata.paymenttype);
//            clog("paytype "+paytype+" isbeforesame "+isbeforesame+" isdelete "+isdelete+" isgetremain(bdata) "+isgetremain(bdata));
            
            if(paytype == 1){// 카드
              
                var remain = JSON.parse(bdata.remain_price);
                if(!isbeforesame){
                  
                    if(!isdelete){
                        
                        var price = remain && parseInt(remain.card) >= 0 ? parseInt(remain.card) : parseInt(bdata.total_price);
                        if(isgetremain(bdata)){
                        
                            now_day.day_getremain_price_card += price;
                            
                            isclick_type.rrtype = CLICKTYPE.remain;
                            isclick_type.ptype = CLICKTYPE.card;
                            
                            now_day.day_card_price += price;
                            isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, price,paytype,bdata.name);
                        }

                        else{
                           
                            now_day.day_card_price += price;
                            isclick_type.ptype = CLICKTYPE.card;

                          
                            isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, price,paytype,bdata.name);
                        } 
                    }
                }
                else if(isbeforesame && !isdelete && !isgetremain(bdata)){
                    var price = parseInt(bdata.term_or_count_price);
//                    clog("카드결제 같이결제한 PT 회원권이다.");
                     //기간제 금액차감
                     isclick_type.tctype = addDayTermCountPrice("TERM", -price,paytype,bdata.name);
                     //횟수제 금액 더하기
                     isclick_type.tctype = addDayTermCountPrice("COUNT", price,paytype,bdata.name);
                }
                
//                clog("카드 "+price);
                
            }else if(paytype == 2 || paytype == 0){ // 현금  ,  기타결제
                 var remain = JSON.parse(bdata.remain_price);
                 if(!isbeforesame){
                     if(!isdelete){

                        var price = remain && parseInt(remain.cash) >= 0 ? parseInt(remain.cash) : parseInt(bdata.total_price);
                        if(isgetremain(bdata)){
    //                        day_price_refund += parseInt(bdata.total_price);
                            now_day.day_getremain_price_cash += parseInt(bdata.total_price);
    //                        clog("현금환불 "+now_day.day_getremain_price_cash);
                            isclick_type.rrtype = CLICKTYPE.remain;
                            isclick_type.ptype = CLICKTYPE.cash;
                            
                            now_day.day_cash_price += price;
                            isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, price,paytype,bdata.name);
                        }

                        else{
                            now_day.day_cash_price += price;
                            isclick_type.ptype = CLICKTYPE.cash;
                            isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, price,paytype,bdata.name);
                        }

                     }
                 }
                 else if(isbeforesame && !isdelete && !isgetremain(bdata)){
                     var price = parseInt(bdata.term_or_count_price);
                     
                     //기간제 금액차감
                     isclick_type.tctype = addDayTermCountPrice("TERM", -price,paytype,bdata.name);
                     //횟수제 금액 더하기
                     isclick_type.tctype = addDayTermCountPrice("COUNT", price,paytype,bdata.name);
                }
//                clog("현금 "+price);
                
            }else if(paytype == 3){// 환불
                if(!isbeforesame){
                    if(!isdelete){
                        
                        var total_price = parseInt(bdata.total_price);
                        if(total_price != 0 && bdata.remain_price.length < 5)
                            bdata.remain_price = JSON.stringify({"card":total_price,"cash":0,"remain":0,"total":total_price,"total_remain":total_price});
                        
                        now_day.day_refund_price += parseInt(bdata.total_price);
                        isclick_type.rrtype = CLICKTYPE.refund;

                        
                         //환불금액도  월 총 : 카드 , 현금에 차감한다.
                        var remain = JSON.parse(bdata.remain_price);
                        var rcard_price = remain && parseInt(remain.card) != 0 ? -Math.abs(parseInt(remain.card)) : 0;
                        var rcash_price = remain && parseInt(remain.cash) != 0 ? -Math.abs(parseInt(remain.cash)) : 0;
                        now_day.day_card_price += rcard_price;
                        now_day.day_cash_price += rcash_price;

                        if(rcard_price != 0 && rcard_price != 0)isclick_type.ptype = CLICKTYPE.card_cash;
                        else if(rcard_price != 0)isclick_type.ptype = CLICKTYPE.card;
                        else if(rcash_price != 0)isclick_type.ptype = CLICKTYPE.cash;
                        
                           //환불금도 카드금액추가       
                        var refund_paytype = 0;
                        if(rcard_price != 0 && rcash_price != 0)
                            refund_paytype = 4;
                        else if(rcard_price != 0 && rcash_price == 0)
                            refund_paytype = 1;
                        else if(rcard_price == 0 && rcash_price != 0)
                            refund_paytype = 2;
                        
                        isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, rcard_price+rcash_price, refund_paytype, bdata.name);
                        
                    }
                }
                
//                 clog("환불 "+bdata.total_price);
                
            }else if(paytype == 4){// 카드 + 현금 
               var remain = JSON.parse(bdata.remain_price);
               if(!isbeforesame){
                   if(!isdelete){
                         var mcard = parseInt(remain.card);
                         var mcash = parseInt(remain.cash);
                         if(isgetremain(bdata)){
                             now_day.day_getremain_price_card += mcard;
                             now_day.day_getremain_price_cash += mcash;
                             isclick_type.rrtype =CLICKTYPE.remain;
                             isclick_type.ptype =CLICKTYPE.card_cash;
                             
                             now_day.day_card_price += mcard;
                             now_day.day_cash_price += mcash;
                             
                             isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, mcard,1,bdata.name);
                             isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, mcash,2,bdata.name);
                         }else{
                             now_day.day_card_price += mcard;
                             now_day.day_cash_price += mcash;
                             isclick_type.ptype = CLICKTYPE.card_cash; //카드 +현금

                             isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, mcard,1,bdata.name);
                             isclick_type.tctype = addDayTermCountPrice(bdata.membership_type, mcash,2,bdata.name);

                         }
                   }
               }
               else if(isbeforesame && !isdelete && !isgetremain(bdata)){
                   
                   //현금+카드이라서 카드결제 1개로 퉁친다.
                    var price = parseInt(bdata.term_or_count_price);
                   
                    //기간제 금액차감
                    isclick_type.tctype = addDayTermCountPrice("TERM", -price,1,bdata.name);
                    //횟수제 금액 더하기
                    isclick_type.tctype = addDayTermCountPrice("COUNT", price,1,bdata.name);
                     
               }    
               
//                 clog("카드+현금 "+(mcard+mcash));
                
            }
         
//            day_price_total_price = day_price_card+day_price_cash+day_price_refund;
//         clog("day_price_total_price "+day_price_total_price);
//         var mmm = now_day.day_card_price+now_day.day_cash_price+now_day.day_refund_price+now_day.day_getremain_price_card+now_day.day_getremain_price_cash;
//         clog(" mmm "+(day_price_card+day_price_cash));
         
         
           // now_day.day_total_price = now_day.day_card_price+now_day.day_cash_price+now_day.day_refund_price+now_day.day_getremain_price_card+now_day.day_getremain_price_cash;
          now_day.day_total_price = now_day.day_card_price+now_day.day_cash_price;//+now_day.day_refund_price; //month_getremain_price_card  , month_getremain_price_cash 금액은 이미  month_card_price , month_cash_price 에 추가됬다.
         
         
        return isclick_type;

     }
     
      function checkTotalMonthData(nowdate){
        var month_term_price = document.getElementById("month_term_price");
        var month_term_price_card = document.getElementById("month_term_price_card");
        var month_term_price_cash = document.getElementById("month_term_price_cash");
        var month_count_price = document.getElementById("month_count_price");
        var month_count_price_card = document.getElementById("month_count_price_card");
        var month_count_price_cash = document.getElementById("month_tcount_price_cash");
        
        var month_other_price = document.getElementById("month_other_price");
        var month_other_price_card = document.getElementById("month_other_price_card");
        var month_other_price_cash = document.getElementById("month_tother_price_cash");
          
        var month_card_price = document.getElementById("month_card_price");
        var month_cash_price = document.getElementById("month_cash_price");
        var month_refund_price = document.getElementById("month_refund_price");
        var month_getremain_price_card = document.getElementById("month_getremain_price_card");
        var month_getremain_price_cash = document.getElementById("month_getremain_price_cash");
        var month_remain_price = document.getElementById("month_remain_price");
        var month_nogetremain_count = document.getElementById("month_nogetremain_count");
        var month_nogetremain_price = document.getElementById("month_nogetremain_price");
          
        var month_total_price = document.getElementById("month_total_price");
        var month_new_regist = document.getElementById("month_new_regist");
        var month_renewal_regist = document.getElementById("month_renewal_regist");
        var month_total_regist = document.getElementById("month_total_regist");
        if(now_month.yy != nowdate.getFullYear() || now_month.mm != nowdate.getMonth()){
            now_month.month_term_price_card = 0;
            now_month.month_term_price_cash = 0;
            now_month.month_count_price_card = 0;
            now_month.month_count_price_cash = 0;
            now_month.month_other_price_card = 0;
            now_month.month_other_price_cash = 0;
            
            now_month.month_card_price = 0;
            now_month.month_cash_price = 0;
            now_month.month_refund_price = 0;
            now_month.month_getremain_price_card = 0;
            now_month.month_getremain_price_cash = 0;
            now_month.month_remain_price = 0;
            now_month.month_nogetremain_count = 0;
            now_month.month_nogetremain_price = 0;
            now_month.month_total_price = 0;
            now_month.month_new_regist = 0;
            now_month.month_renewal_regist = 0;
            now_month.month_total_regist = 0;
            
            if(month_term_price)month_term_price.innerHTML = 0;
            if(month_term_price_card)month_term_price_card.innerHTML = 0;
            if(month_term_price_cash)month_term_price_cash.innerHTML = 0;
            if(month_count_price)month_count_price.innerHTML = 0;
            if(month_count_price_card)month_count_price_card.innerHTML = 0;
            if(month_count_price_cash)month_count_price_cash.innerHTML = 0;
            
            if(month_other_price)month_other_price.innerHTML = 0;
            if(month_other_price_card)month_other_price_card.innerHTML = 0;
            if(month_other_price_cash)month_other_price_cash.innerHTML = 0;
            
            if(month_card_price)month_card_price.innerHTML = 0;
            if(month_cash_price)month_cash_price.innerHTML = 0;
            if(month_refund_price)month_refund_price.innerHTML = 0;
            if(month_getremain_price_card)month_getremain_price_card.innerHTML = 0;
            if(month_getremain_price_cash)month_getremain_price_cash.innerHTML = 0;
            if(month_remain_price)month_remain_price.innerHTML = 0;
            if(month_nogetremain_count)month_nogetremain_count.innerHTML = "0건";
            if(month_nogetremain_price)month_nogetremain_price.innerHTML = 0;
            if(month_total_price)month_total_price.innerHTML = 0;
            if(month_new_regist)month_new_regist.innerHTML = 0;
            if(month_renewal_regist)month_renewal_regist.innerHTML = 0;
            if(month_total_regist)month_total_regist.innerHTML = 0;
            
            click_month_on_dates = [];
            click_data_list = [[],[],[],[],[],[],[],[],[],[],[],[],[],[],[],[]];
            before_monthbdata = null;
        }
        initNowDayData();
    }
    function initNowDayData(){
        now_day = {yy:"",mm:"",dd:"",day_card_price:0,day_cash_price:0,day_refund_price:0,day_getremain_price_card:0,day_getremain_price_cash:0,day_remain_price:0,day_nogetremain_count:0,day_nogetremain_price:0,day_total_price:0,day_new_regist:0,day_renewal_regist:0,day_total_regist:0,day_term_price_card:0,day_term_price_cash:0,day_count_price_card:0,day_count_price_cash:0,day_other_price_card:0,day_other_price_cash:0};
//        day_price_total_price = 0;
//        day_price_card = 0;
//        day_price_cash = 0;
//        day_price_refund = 0;
        setTotalDayData(now_day);
    }
    function setTotalMonthData(){
        var month_term_price = document.getElementById("month_term_price");
        var month_term_price_card = document.getElementById("month_term_price_card");
        var month_term_price_cash = document.getElementById("month_term_price_cash");
        var month_count_price = document.getElementById("month_count_price");
        var month_count_price_card = document.getElementById("month_count_price_card");
        var month_count_price_cash = document.getElementById("month_count_price_cash");
        
        var month_other_price = document.getElementById("month_other_price");
        var month_other_price_card = document.getElementById("month_other_price_card");
        var month_other_price_cash = document.getElementById("month_other_price_cash");
        
        var month_card_price = document.getElementById("month_card_price");
        var month_cash_price = document.getElementById("month_cash_price");
        var month_refund_price = document.getElementById("month_refund_price");
        var month_getremain_price_card = document.getElementById("month_getremain_price_card");
        var month_getremain_price_cash = document.getElementById("month_getremain_price_cash");
        var month_remain_price = document.getElementById("month_remain_price");
        var month_nogetremain_count = document.getElementById("month_nogetremain_count");
        var month_nogetremain_price = document.getElementById("month_nogetremain_price");
        var month_total_price = document.getElementById("month_total_price");
        var month_new_regist = document.getElementById("month_new_regist");
        var month_renewal_regist = document.getElementById("month_renewal_regist");
        var month_total_regist = document.getElementById("month_total_regist");
        
        month_term_price_card.innerHTML = number_format(now_month.month_term_price_card);
        month_term_price_cash.innerHTML = number_format(now_month.month_term_price_cash);
        month_term_price.innerHTML = number_format(parseInt(now_month.month_term_price_card)+parseInt(now_month.month_term_price_cash));
        
        month_count_price_card.innerHTML = number_format(now_month.month_count_price_card);
        month_count_price_cash.innerHTML = number_format(now_month.month_count_price_cash);
        month_count_price.innerHTML = number_format(parseInt(now_month.month_count_price_card)+parseInt(now_month.month_count_price_cash));
        
        month_other_price_card.innerHTML = number_format(now_month.month_other_price_card);
        month_other_price_cash.innerHTML = number_format(now_month.month_other_price_cash);
        month_other_price.innerHTML = number_format(parseInt(now_month.month_other_price_card)+parseInt(now_month.month_other_price_cash));
        
        month_card_price.innerHTML = number_format(now_month.month_card_price);
        month_cash_price.innerHTML = number_format(now_month.month_cash_price);
        month_refund_price.innerHTML = number_format(now_month.month_refund_price);
        month_getremain_price_card.innerHTML = number_format(now_month.month_getremain_price_card);
        month_getremain_price_cash.innerHTML = number_format(now_month.month_getremain_price_cash);
        month_remain_price.innerHTML = number_format(parseInt(now_month.month_getremain_price_card)+parseInt(now_month.month_getremain_price_cash));
        month_nogetremain_count.innerHTML =  now_month.month_nogetremain_count+"건";
        month_nogetremain_price.innerHTML =  number_format(now_month.month_nogetremain_price);
        month_total_price.innerHTML = number_format(now_month.month_total_price);
        
        month_new_regist.innerHTML = now_month.month_new_regist;
        month_renewal_regist.innerHTML = now_month.month_renewal_regist;
        month_total_regist.innerHTML = now_month.month_total_regist;
        
        
        
    }
    function setTotalDayData(now_day){
        var day_term_price = document.getElementById("day_term_price");
        var day_term_price_card = document.getElementById("day_term_price_card");
        var day_term_price_cash = document.getElementById("day_term_price_cash");
        var day_count_price = document.getElementById("day_count_price");
        var day_count_price_card = document.getElementById("day_count_price_card");
        var day_count_price_cash = document.getElementById("day_count_price_cash");
        
        var day_other_price = document.getElementById("day_other_price");
        var day_other_price_card = document.getElementById("day_other_price_card");
        var day_other_price_cash = document.getElementById("day_other_price_cash");
        
        var day_card_price = document.getElementById("day_card_price");
        var day_cash_price = document.getElementById("day_cash_price");
        var day_refund_price = document.getElementById("day_refund_price");
        var day_getremain_price_card = document.getElementById("day_getremain_price_card");
        var day_getremain_price_cash = document.getElementById("day_getremain_price_cash");
        var day_remain_price = document.getElementById("day_remain_price");
        var day_nogetremain_count = document.getElementById("day_nogetremain_count");
        var day_nogetremain_price = document.getElementById("day_nogetremain_price");
        var day_total_price = document.getElementById("day_total_price");
        var day_new_regist = document.getElementById("day_new_regist");
        var day_renewal_regist = document.getElementById("day_renewal_regist");
        var day_total_regist = document.getElementById("day_total_regist");
        
        
        day_term_price_card.innerHTML = number_format(now_day.day_term_price_card);
        day_term_price_cash.innerHTML = number_format(now_day.day_term_price_cash);
        day_term_price.innerHTML = number_format(parseInt(now_day.day_term_price_card)+parseInt(now_day.day_term_price_cash));
        
        day_count_price_card.innerHTML = number_format(now_day.day_count_price_card);
        day_count_price_cash.innerHTML = number_format(now_day.day_count_price_cash);
        day_count_price.innerHTML = number_format(parseInt(now_day.day_count_price_card)+parseInt(now_day.day_count_price_cash));
        
        day_other_price_card.innerHTML = number_format(now_day.day_other_price_card);
        day_other_price_cash.innerHTML = number_format(now_day.day_other_price_cash);
        day_other_price.innerHTML = number_format(parseInt(now_day.day_other_price_card)+parseInt(now_day.day_other_price_cash));
        
        
        
//        clog("000 day_card_price.innerHTML "+day_card_price.innerHTML);
        day_card_price.innerHTML = number_format(now_day.day_card_price);
//        clog("111 day_card_price.innerHTML "+day_card_price.innerHTML);
        day_cash_price.innerHTML = number_format(now_day.day_cash_price);
        day_refund_price.innerHTML = number_format(now_day.day_refund_price);
        day_getremain_price_card.innerHTML = number_format(now_day.day_getremain_price_card);
        day_getremain_price_cash.innerHTML = number_format(now_day.day_getremain_price_cash);
        day_remain_price.innerHTML = number_format(parseInt(now_day.day_getremain_price_card)+parseInt(now_day.day_getremain_price_cash));
        day_nogetremain_count.innerHTML = now_day.day_nogetremain_count;
        day_nogetremain_price.innerHTML = number_format(now_day.day_nogetremain_price);
        day_total_price.innerHTML = number_format(now_day.day_total_price);
        
        day_new_regist.innerHTML = now_day.day_new_regist;
        day_renewal_regist.innerHTML = now_day.day_renewal_regist;
        day_total_regist.innerHTML = now_day.day_total_regist;
        
        
    }
    
    var now_month = {yy:"",mm:"",month_card_price:0,month_cash_price:0,month_refund_price:0,month_getremain_price_card:0,month_getremain_price_cash:0,month_remain_price:0,month_nogetremain_count:0,month_nogetremain_price:0,month_total_price:0,month_new_regist:0,month_renewal_regist:0,month_total_regist:0,month_term_price_card:0,month_term_price_cash:0,month_count_price_card:0,month_count_price_cash:0,month_other_price_card:0,month_other_price_cash:0};
    var now_day = {yy:"",mm:"",dd:"",day_card_price:0,day_cash_price:0,day_refund_price:0,day_getremain_price_card:0,day_getremain_price_cash:0,day_remain_price:0,day_nogetremain_count:0,day_nogetremain_price:0,day_total_price:0,day_new_regist:0,day_renewal_regist:0,day_total_regist:0,day_term_price_card:0,day_term_price_cash:0,day_count_price_card:0,day_count_price_cash:0,day_other_price_card:0,day_other_price_cash:0};
        
    var before_monthbdata = null;  
      
    //0 : X , 1 : 카드 , 2: 현금 , 3: 환불 , 4 : 미수금회수 , 5 : 합계 , 6 : 신규등록   5 : 재등록 , 6 : 등록합계 , 10 :카드+현금
    
    function monthAddEvent(index, event) {
        
        e = new Date(event.start),
        dateclass = e.toDateCssClass();
        
        var mdiv = document.getElementById("div_month_data"+dateclass);
        if(!mdiv)return;
        
        var mdiv = document.getElementById("div_month_data"+dateclass);
        var txt_new = document.getElementById("txt_new"+dateclass);
        var txt_renewal = document.getElementById("txt_renewal"+dateclass);
        var txt_total_user = document.getElementById("txt_total_user"+dateclass);
        var txt_card = document.getElementById("txt_card"+dateclass);
        var txt_cash = document.getElementById("txt_cash"+dateclass);
        var txt_refund = document.getElementById("txt_refund"+dateclass);
        var txt_remain = document.getElementById("txt_remain"+dateclass);
        var txt_remaincount = document.getElementById("txt_remaincount"+dateclass);
        var txt_nogetremainprice = document.getElementById("txt_nogetremainprice"+dateclass);
        var txt_delete = document.getElementById("txt_delete"+dateclass);
        var txt_total_price = document.getElementById("txt_total_price"+dateclass);
        var div_remain = document.getElementById("div_remain"+dateclass);
        
        
        
        if(!txt_new)return; //예외 버그 처리
        var count_new = parseInt(txt_new.innerHTML);
        var count_renewal = parseInt(txt_renewal.innerHTML);
        var count_total_user = parseInt(txt_total_user.innerHTML);
        var bdata = event.bdatas;
        var isdelete = bdata.pmstatus == 'D' ? true : false;  
//        clog(event.start+"isdelete "+isdelete);
        var sdate = "_"+event.start.getFullYear()+"_"+(event.start.getMonth()+1)+"_"+event.start.getDate();
        
//        clog("==============================",event.date);
//        clog(" bdata. ",bdata);
//        clog(dateclass+" bdata.b_isretake "+bdata.retake);
        
        var isbeforesame = before_monthbdata && isSameCouponid(before_monthbdata,bdata) ? true : false;
        var month_isclickdata_on = CLICKTYPE.none;
        var nowday = parseInt(event.start.getDate());
        var test_issetday = false;
        if(dateclass == sdate)
        {
            
//            if(sdate.indexOf("_2023_02") >= 0){
//                
//                clog(sdate+" month nowday "+nowday+" txt_total_price "+txt_total_price.innerHTML);    
////                clog(" bdata. ",bdata);
//                clog(txt_total_price.innerHTML+"  00 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML);
//                test_issetday = true;
//            }
            
//            clog(dateclass+" dateclass   sdate "+sdate);
            if(bdata.retake == "N"){  //신규유저
                count_new++;
                txt_new.innerHTML = ""+count_new;     
                now_month.month_new_regist++;
                isclick_month_day(sdate,CLICKTYPE.new);
                month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.new,bdata);
            }else if(bdata.retake == "Y"){
                count_renewal++;
                txt_renewal.innerHTML = ""+count_renewal;      
                now_month.month_renewal_regist++;
                isclick_month_day(sdate,CLICKTYPE.renewal);
                month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.renewal,bdata);
            }
            
            if(bdata.ornercheck != "N"){
                var back = document.getElementById("div_month_data"+sdate);
                var text_ornercheckdata = document.getElementById("text_ornercheckdata"+sdate);
                text_ornercheckdata.innerHTML += bdata.ornercheck;
//                clog(sdate+" month nowday "+nowday);
//                clog("bdata.ornercheck R "+text_ornercheckdata.innerHTML.indexOf("R"));
//                clog("bdata.ornercheck C "+text_ornercheckdata.innerHTML.indexOf("C"));
//                back.style.backgroundColor = bdata.ornercheck == "R" ? "#ffdcdc" : "#dcdcff";
                if(text_ornercheckdata.innerHTML.indexOf("R") >= 0 && text_ornercheckdata.innerHTML.indexOf("C") >= 0){
                   back.style.backgroundColor = "#cffccf";
                }else if(text_ornercheckdata.innerHTML.indexOf("R") >= 0 && text_ornercheckdata.innerHTML.indexOf("C") == -1){
                    back.style.backgroundColor = "#ffdcdc";
                    
                }else if(text_ornercheckdata.innerHTML.indexOf("C") >= 0 && text_ornercheckdata.innerHTML.indexOf("R") == -1){
                    back.style.backgroundColor = "#dcdcff";
                }
                
            } 
//            clog(txt_total_price.innerHTML+"  11 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML);
            count_total_user = count_new+count_renewal;
            txt_total_user.innerHTML = ""+count_total_user;     
            now_month.month_total_regist = now_month.month_new_regist+now_month.month_renewal_regist;
            
            var price_card = parseInt(number_format_to_number(txt_card.innerHTML));
            var price_cash = parseInt(number_format_to_number(txt_cash.innerHTML));
            var price_refund = parseInt(number_format_to_number(txt_refund.innerHTML));
            var price_remain = parseInt(number_format_to_number(txt_remain.innerHTML));
            
            var count_delete = getStringInNumber(txt_delete.innerHTML);
            var count_remain = getStringInNumber(txt_remaincount.innerHTML);
            
            var price_total_price = parseInt(number_format_to_number(txt_total_price.innerHTML));

            
//            if(bdata.paymentid.indexOf("2021-11-17") >= 0){
//                clog("=======================================");
//                clog("before_monthbdata ",before_monthbdata);
//                clog("bdata ",bdata);
//                clog("before_monthbdata.couponid"+before_monthbdata.couponid+" nowcouponid "+bdata.couponid);
//                clog("issame "+isSameCouponid(before_monthbdata,bdata));
//                clog("2021-10-28 data is ",bdata);              
//            }
//            
            var paytype = parseInt(bdata.paymenttype);
//            clog(paytype+" parseInt(bdata.total_price) "+parseInt(bdata.total_price));
            if(isdelete)count_delete++;
            var remain = JSON.parse(bdata.remain_price);
            var remainfinish = bdata.remainfinish;
            if(!isdelete)
                if(!before_monthbdata || before_monthbdata && !isbeforesame)
                    if(remainfinish != "F" && remain && remain.remain && parseInt(remain.remain) > 0){
                        count_remain++;
                        now_month.month_nogetremain_price += parseInt(remain.remain);
                        now_month.month_nogetremain_count++;
                        isclick_month_day(sdate,CLICKTYPE.nogetremain);
                        pushClickDataList(false,CLICKTYPE.nogetremain,bdata);
                    }
            
            
//           clog(txt_total_price.innerHTML+"  22 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML+" price_total_price"+price_total_price);
//            clog("sdate "+sdate);
//            clog("bdata.membership_type "+bdata.membership_type);
            if(paytype == 1){// 카드
                var remain = JSON.parse(bdata.remain_price);
                if(!before_monthbdata || before_monthbdata && !isbeforesame){
                    if(!isdelete){
                        var price = remain && parseInt(remain.card) >= 0 ? parseInt(remain.card) : parseInt(bdata.total_price);


                        //price_card += parseInt(bdata.total_price);
                        if(isgetremain(bdata)){
                            
                            now_month.month_getremain_price_card += price;
                            price_remain += price;
                            isclick_month_day(sdate,CLICKTYPE.remain);
                            month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.remain,bdata);
                            
                             //미수금도 카드금액추가                            
                             now_month.month_card_price += price;
                            addMonthTermCountPrice(bdata.membership_type, price,paytype,bdata.name,sdate,bdata);
                        }
                        else  // 미수금 회수도 총금액에 포함시킨다.
                        {
                            
                            price_card += price;
                            now_month.month_card_price += price;

                            isclick_month_day(sdate,CLICKTYPE.card);
                            month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.card,bdata);
                            addMonthTermCountPrice(bdata.membership_type, price,paytype,bdata.name,sdate,bdata);
                                                       
                        }                             

                    }
                }
                //같이결제한 회원권이면서 PT 이다    
                else if(isbeforesame && !isdelete && !isgetremain(bdata)){
                    var price = parseInt(bdata.term_or_count_price);
                     
                    //기간제 금액차감
                    addMonthTermCountPrice("TERM", -price,paytype,bdata.name,sdate,bdata);
                    //횟수제 금액 더하기
                    addMonthTermCountPrice("COUNT", price,paytype,bdata.name,sdate,bdata);
                    
                    
                }
//                 clog(txt_total_price.innerHTML+"  33 카드 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML+" price_total_price"+price_total_price);
                
            }else if(paytype == 2 || paytype == 0){ // 현금  ,  기타결제
                 var remain = JSON.parse(bdata.remain_price);
                 if(!before_monthbdata || before_monthbdata && !isbeforesame){
                     if(!isdelete){
                    
                        var price = remain && parseInt(remain.cash) >= 0 ? parseInt(remain.cash) : parseInt(bdata.total_price);

                      //  price_cash += parseInt(bdata.total_price);
                        if(isgetremain(bdata)){
                            now_month.month_getremain_price_cash += price;  
                            isclick_month_day(sdate,CLICKTYPE.remain);
                            month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.remain,bdata);
                            price_remain += price;
                            
                            //미수금도 현금금액추가
                            now_month.month_cash_price += price;
                            addMonthTermCountPrice(bdata.membership_type, price,paytype,bdata.name,sdate,bdata);

                        }
                        else  // 미수금 회수도 총금액에 포함시킨다.
                        {
                            price_cash += price;
    //                        clog(sdate+" 현금  "+price);
                            now_month.month_cash_price += price;
                            isclick_month_day(sdate,CLICKTYPE.cash);
                            month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.cash,bdata);
                            addMonthTermCountPrice(bdata.membership_type, price,paytype,bdata.name,sdate,bdata);
                        }

                    }
                      
                }
                //같이결제한 회원권이면서 PT 이다    
                else if(isbeforesame && !isdelete && !isgetremain(bdata)){
                    var price = parseInt(bdata.term_or_count_price);
                    
//                    clog(sdate+" 현금 : 같이결제한 회원권이면서 PT 이다 embershiptype is "+bdata.membership_type);
                    //기간제 금액차감
                    addMonthTermCountPrice("TERM", -price,paytype,bdata.name,sdate,bdata);
                    //횟수제 금액 더하기
                    addMonthTermCountPrice("COUNT", price,paytype,bdata.name,sdate,bdata);
                }
//                clog(txt_total_price.innerHTML+"  44 현금 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML);
                
            }else if(paytype == 3){// 환불
//                console.log("00");
                if(!before_monthbdata || before_monthbdata && !isbeforesame){
                    if(!isdelete){
//                       console.log("11");

                        var total_price = parseInt(bdata.total_price);
                        if(total_price != 0 && bdata.remain_price.length < 5)
                            bdata.remain_price = JSON.stringify({"card":total_price,"cash":0,"remain":0,"total":total_price,"total_remain":total_price});
                        
                        isclick_month_day(sdate,CLICKTYPE.refund);
                        month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.refund,bdata);
                        
                        //환불금액도  월 총 : 카드 , 현금에 차감한다.
                        var remain = JSON.parse(bdata.remain_price);
                        
                        var rcard_price = remain && parseInt(remain.card) != 0 ? -Math.abs(parseInt(remain.card)) : 0;
                        var rcash_price = remain && parseInt(remain.cash) != 0 ? -Math.abs(parseInt(remain.cash)) : 0;
                        
                       
                        price_refund += rcard_price+rcash_price;
                        now_month.month_refund_price += rcard_price+rcash_price;
                       

                        now_month.month_card_price += rcard_price;
                        now_month.month_cash_price += rcash_price;
                        
                         //환불금도 카드금액추가       
                        var refund_paytype = 0;
                        if(rcard_price != 0 && rcash_price != 0)
                            refund_paytype = 4;
                        else if(rcard_price != 0 && rcash_price == 0)
                            refund_paytype = 1;
                        else if(rcard_price == 0 && rcash_price != 0)
                            refund_paytype = 2;
                        
                        addMonthTermCountPrice(bdata.membership_type, rcard_price+rcash_price,refund_paytype,bdata.name,sdate,bdata);
//                        console.log(sdate+" "+bdata.membership_type+" refund price ",price_refund);

                        
                    }
                }
//                clog(txt_total_price.innerHTML+"  55 환불 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML+" price_total_price"+price_total_price);
                
            }else if(paytype == 4){// 카드 + 현금 
                var remain = JSON.parse(bdata.remain_price);
//                clog(" date "+sdate);
               if(!before_monthbdata || before_monthbdata && !isbeforesame){
                   if(!isdelete){
                    
                        if(isgetremain(bdata)){
                             now_month.month_getremain_price_card += parseInt(remain.card); 
                             now_month.month_getremain_price_cash += parseInt(remain.cash);
                             isclick_month_day(sdate,CLICKTYPE.remain);

                             month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.remain,bdata);
                             price_remain += parseInt(remain.card)+parseInt(remain.cash);
                             
                             
                             //미수금도 카드, 현금 금액 추가                             
                             now_month.month_card_price += parseInt(remain.card);
                             now_month.month_cash_price += parseInt(remain.cash);
                             
                             
                             addMonthTermCountPrice(bdata.membership_type, parseInt(remain.card), 1, bdata.name, sdate,bdata);
                             addMonthTermCountPrice(bdata.membership_type, parseInt(remain.cash), 2, bdata.name,  sdate,bdata);
                        }
                        else  // 미수금 회수도 총금액에 포함시킨다.
                        {
                             
                             price_card += parseInt(remain.card);
                             price_cash += parseInt(remain.cash);
    //                         clog("333 now_month.month_card_price"+now_month.month_card_price);
                             now_month.month_card_price += parseInt(remain.card);
                             now_month.month_cash_price += parseInt(remain.cash);
    //                        clog(sdate+"카드 + 현금  "+parseInt(remain.cash));
    //                         clog("444 now_month.month_card_price"+now_month.month_card_price);
                             isclick_month_day(sdate,CLICKTYPE.card_cash);
                             month_isclickdata_on = pushClickDataList(isbeforesame,CLICKTYPE.card_cash,bdata);

                             addMonthTermCountPrice(bdata.membership_type, parseInt(remain.card), 1, bdata.name,  sdate,bdata);
                             addMonthTermCountPrice(bdata.membership_type, parseInt(remain.cash), 2, bdata.name,  sdate,bdata);

                             
                             

                         }
                   }
                   
               }
               //같이결제한 회원권이면서 PT 이다    
                else if(isbeforesame && !isdelete && !isgetremain(bdata)){
                    var price = parseInt(bdata.term_or_count_price);
                    //기간제 금액차감
                    addMonthTermCountPrice("TREM", -price, 1, bdata.name, sdate,bdata);
                    //횟수제 금액 더하기
                    addMonthTermCountPrice("COUNT", price, 1, bdata.name,  sdate,bdata);
                }
//                clog(txt_total_price.innerHTML+"  66 카드+현금 txt_card "+txt_card.innerHTML+" cash "+txt_cash.innerHTML+" price_total_price"+price_total_price);
                
            }
//            clog(sdate+" isbeforesame "+isbeforesame+" month_isclickdata_on "+month_isclickdata_on);
            if(isbeforesame && before_month_isclickdata_on > 0){
                if(before_month_isclickdata_on == CLICKTYPE.card_cash){ //카드 + 현금이라면 카드데이타에도 삽입하고 현금데이타에도 삽입한다.
                    click_data_list[CLICKTYPE.card].push(bdata);    
                    click_data_list[CLICKTYPE.cash].push(bdata);    
                }else 
                    click_data_list[before_month_isclickdata_on].push(bdata);    
//                clog("같은데이타 ",bdata);
            }
            
            price_total_price = price_card+price_cash+price_refund+price_remain;
//            clog(" price_card "+price_card+" price_cash "+price_cash+" price_refund "+price_refund+" price_remain "+price_remain+" = price_total_price "+price_total_price);
            //now_month.month_total_price = now_month.month_card_price+now_month.month_cash_price+now_month.month_refund_price+now_month.month_getremain_price_card+now_month.month_getremain_price_cash;
            now_month.month_total_price = now_month.month_card_price+now_month.month_cash_price;//month_getremain_price_card  , month_getremain_price_cash 금액은 이미  month_card_price , month_cash_price 에 추가됬다.
           
//            console.log("=================== now_month.month_card_price "+now_month.month_card_price);
            txt_card.innerHTML = ""+number_format(price_card);
            txt_cash.innerHTML = ""+number_format(price_cash);
            txt_refund.innerHTML = ""+number_format(price_refund);
            txt_remain.innerHTML = ""+number_format(price_remain);
            txt_remaincount.innerHTML = count_remain > 0 ? "(미수금건수 : "+count_remain+"건)" : "";
            txt_delete.innerHTML = count_delete > 0 ? "(삭제건수 : "+count_delete+"건)" : "";
            txt_total_price.innerHTML = ""+number_format(price_total_price);
            setTotalMonthData();
            before_monthbdata = bdata;
            before_month_isclickdata_on = month_isclickdata_on;
            
            
//            if(test_issetday){
//                clog("eee txt_total_price is ",txt_total_price.innerHTML);
//                clog("eee price_total_price is "+price_total_price);
//                clog("============================================================");
//            }
            
            if(price_remain > 0)div_remain.style.display = "block";
//             clog("before_month_isclickdata_on ",before_month_isclickdata_on);
            
            
//            console.log("ee now_month.month_card_price "+now_month.month_card_price+" now_month.month_cash_price "+now_month.month_cash_price);
        }
        
    }
    function addMonthTermCountPrice(membership_type, price,paytype,name,sdate,bdata){
         var clicktype = CLICKTYPE.none;
       
            
        //기타상품
        if(membership_type == "OTHER" || name && name.indexOf("더미입력") >= 0){
              if(paytype == 1)
                now_month.month_other_price_card += price;
            else 
                now_month.month_other_price_cash += price;
            clicktype = CLICKTYPE.other;
            pushClickDataList(false,CLICKTYPE.other,bdata);
        }            
        else if(membership_type == "COUNT"){
            if(paytype == 1)
                now_month.month_count_price_card += price;
            else 
                now_month.month_count_price_cash += price;
            clicktype = CLICKTYPE.count;
            pushClickDataList(false,CLICKTYPE.count,bdata);
            
        }else{
            if(membership_type == "TERM") pushClickDataList(false,CLICKTYPE.term,bdata);

            
            if(paytype == 1)
                now_month.month_term_price_card += price;
            else 
                now_month.month_term_price_cash += price;
            clicktype = CLICKTYPE.term;
           
        }
        isclick_month_day(sdate,clicktype);
        
        
    }
    function addDayTermCountPrice(membership_type, price,paytype,name){
        var clicktype = CLICKTYPE.none;
        
        //기타상품
        if(membership_type == "OTHER" || name && name.indexOf("더미입력") >= 0){
            if(paytype == 1)
                now_day.day_other_price_card += price;
            else 
                now_day.day_other_price_cash += price;
            clicktype = CLICKTYPE.other;
        }            
        else if(membership_type == "COUNT"){
            if(paytype == 1)
                now_day.day_count_price_card += price;
            else 
                now_day.day_count_price_cash += price;
            clicktype = CLICKTYPE.count;
        }
        
        else{
            if(paytype == 1)
                now_day.day_term_price_card += price;
            else 
                now_day.day_term_price_cash += price;
             clicktype = CLICKTYPE.term;
        }
        return clicktype;
    }
    var before_month_isclickdata_on = CLICKTYPE.none;
    function pushClickDataList(isbeforesame,type,bdata){
        if(type == CLICKTYPE.card_cash){
            click_data_list[CLICKTYPE.card].push(bdata);    
            click_data_list[CLICKTYPE.cash].push(bdata);    
        }else 
            click_data_list[type].push(bdata);    
        return !isbeforesame ? type : CLICKTYPE.none;
    }
    //회수한 미수금인지 아닌지 체크한다.
    function isgetremain(bdata){
        var flg = false;
        var pm_pay_locker = bdata.locker_price;
        var pm_pay_termtype = bdata.term_price;
        var pm_pay_counttype = bdata.count_price;
        var remain = JSON.parse(bdata.remain_price); 
       
        
        if(bdata.coupontype != "UG" && bdata.coupontype != "GA" && bdata.coupontype != "O" && bdata.coupontype != "R")
        if(bdata.uid != "dummyuid" && parseInt(pm_pay_locker) == 0 && parseInt(pm_pay_termtype) == 0 && parseInt(pm_pay_counttype) == 0 && remain && parseInt(remain.remain) == 0){
            if(parseInt(remain.total_remain) != 0 && parseInt(remain.total) != 0 && parseInt(remain.totalprice) != 0)
                flg = true;
        }
        
        return flg;
    }  
    function yearAddEvents(events, year) {
      var counts = [0,0,0,0,0,0,0,0,0,0,0,0];
      $.each(events, function (i, v) {
        if (v.start.getFullYear() === year) {
            counts[v.start.getMonth()]++;
        }
      });
      $.each(counts, function (i, v) {
        if (v!==0) {
            $('.month-'+i).append('<span class="badge">'+v+'</span>');
        }
      });
    }
    
    function draw() {
      $el.html(t(options));
      //potential optimization (untested), this object could be keyed into a dictionary on the dateclass string; the object would need to be reset and the first entry would have to be made here
      $('.' + (new Date()).toDateCssClass()).addClass('today');
        
       
       
      if (options.data && options.data.length) {
          
          var title_payment = document.getElementById("title_payment");
          if(title_payment)title_payment.innerHTML = options.mode == "day" ? "일별 매출현황" : "월별 매출현황";
          
          
          var btn_dummy_insert = document.getElementById("btn_dummy_insert");
          if(btn_dummy_insert)btn_dummy_insert.style.display = options.mode == "day" ? "block" : "none";
           var day_total_table = document.getElementById("day_total_table");
          if(day_total_table)day_total_table.style.display = options.mode == "day" ? "block" : "none";
          
          var month_total_table = document.getElementById("month_total_table");
          if(month_total_table)month_total_table.style.display = options.mode == "month" ? "block" : "none";
          checkTotalMonthData(options.date);
          
        if (options.mode === 'year') {
            yearAddEvents(options.data, options.date.getFullYear());
           
            
            //'년'으로 볼때 월별 총금액
            var y = options.date.getFullYear();
            for(var i = 1 ; i <= 12;i++){
                var mm = i < 10 ? "0"+i : ""+i;
                var yyyymm = y+"-"+mm;
                var aym = y*12+i;
//                console.log(aym+" year_price_"+y+"-"+mm);
                var txt = document.getElementById("year_price_"+y+"-"+mm);
                if(aym >= 24275) //2022년 11월 부터
                if(txt && statistic_month[yyyymm])txt.innerHTML = TXT_WON+" "+CommaString(statistic_month[yyyymm]);
            }
//            console.log("statistic_month ",statistic_month);
        } else if (options.mode === 'month' || options.mode === 'week') {
            
            $.each(options.data, monthAddEvent);
            
            
        } else {
            
            //맨위로가기
            window.scrollTo(0,0);
            
            //////////////////////////////////////////////////////////////////////////////
            //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. START
            //////////////////////////////////////////////////////////////////////////////
            
//            var title = "예약버튼"; //제목이지만 내용을 적으면 된다.
//            var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
//            y = 2021;
//            m = 0;  //
//            d = 6;
//            hh = 13;
//            mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
//            start = new Date(y, m, d, hh, mm);
//            clog("dayaddeventcall!!",options.data);
//            var event = { title: title, start: start, end: null, allDay: allday, type:"reservation_button"};
//            dayAddEvent(0,event);
            
            //////////////////////////////////////////////////////////////////////////////
            //여기서 해당날짜의 트레이너의 시간표를 가져와서 예약가능한 시간에 버튼을 삽입한다. END
            //////////////////////////////////////////////////////////////////////////////
            
            
            //기존 예약되어있는 날짜 표시
//            $.each(options.data, dayAddEvent);
            var mday = options.date.getFullYear()+"_"+options.date.getMonth()+"_"+options.date.getDate();
            var arr = [];
            for(var i = 0 ; i < options.data.length; i++){
                obj = options.data[i].start;
                var lday = obj.getFullYear()+"_"+obj.getMonth()+"_"+obj.getDate();
                if(mday == lday){
                    arr.push(options.data[i]);                    
                }                
            }
            var len = arr.length; //개수만큼 데이타를 삽입하고 나머지 빈곳들을 삭제하기 위해서
            for(var i = 0 ; i < len;i++){
                dayAddEvent(i,arr[i],len-1);
            }
        }
          
          
          check_month_on_date();
      }
    }
    
    draw();  
      window.mdraw = draw;
  }
  
    
 window.calendar = calendar;
  ;(function (defaults, $, window, document) {
    $.extend({
      calendar: function (options) {
        return $.extend(defaults, options);
      }
    }).fn.extend({
      calendar: function (options) {
        options = $.extend({}, defaults, options);
        window.options = options;
        return $(this).each(function () {
          var $this = $(this);
          calendar($this, options);
            
            
            
            $this.on('click', '.js-cal-prev', function () {
                clog("prev click 000");
                /* 221025 유진 수정 */
                var prev_year = options.date.getFullYear();
                switch(options.mode) {
                    case 'year': 
                        options.date.setFullYear(options.date.getFullYear() - 1); 
                    break;
                    case 'month': 
                        options.date.setDate(1);options.date.setMonth(options.date.getMonth() - 1); 
                    break;
                    case 'week': 
                        options.date.setDate(options.date.getDate() - 7); 
                    break;
                    case 'day':  
                        options.date.setDate(options.date.getDate() - 1); 
                    break;
                }
                setYearMonth(options.date);
                createExcelData();
                checkYearData(options.date.getFullYear());
                param_day = options.mode == "day" ? options.date.getTime() : "";
                window.mdraw();
                holidayCheck(true,true,"black");
                /* 221025 유진 수정 */
                var year_change = options.date.getFullYear();
                if(prev_year != year_change){
                    var value1 = {
                        year : year_change,
                        month : 0,
                        day : 0
                    }
                    getPaymentData(value1,function(res){
                    if(res.code == 100){
                        isfirst = arr_years.length == 0 ? true : false;
                        insertCalenderDatas(res.message,isfirst);
                        allpayments = res.message;
                        arr_years.shift();
                        arr_years.push(year_change);
                        
            //               div_center_list.style.display = "none";
            //               div_main.style.display = "block";   
                    }else{
                        
                        C_showToast("testid3", "에러", "데이터를 가져올 수 없습니다. 다시 시도하세요", function() {});
                            
                    }
                        hideModalDialog();
                    });
                }
            }).on('click', '.js-cal-next', function () {
                clog("next click 111 ");
                /* 221025 유진 수정 */
                var prev_year = options.date.getFullYear();

                switch(options.mode) {
                    case 'year':
                        options.date.setFullYear(options.date.getFullYear() + 1); 
                    break;
                    case 'month':
                        options.date.setDate(1);options.date.setMonth(options.date.getMonth() + 1); 
                    break;
                    case 'week': 
                        options.date.setDate(options.date.getDate() + 7); 
                    break;
                    case 'day': 
                        options.date.setDate(options.date.getDate() + 1);
                    break;
                }
                setYearMonth(options.date);
                createExcelData();
                checkYearData(options.date.getFullYear());
                param_day = options.mode == "day" ? options.date.getTime() : "";
                window.mdraw();
                holidayCheck(true,true,"black");
                /* 221025 유진 수정 */
                var year_change = options.date.getFullYear();
                if(prev_year != year_change){
                    var value1 = {
                        year : year_change,
                        month : 0,
                        day : 0
                    }
                    getPaymentData(value1,function(res){
                    if(res.code == 100){
                        isfirst = arr_years.length == 0 ? true : false;
                        insertCalenderDatas(res.message,isfirst);
                        allpayments = res.message;
                        arr_years.shift();
                        arr_years.push(year_change);
                        
            //               div_center_list.style.display = "none";
            //               div_main.style.display = "block";   
                    }else{
                        
                        C_showToast("testid3", "에러", "데이터를 가져올 수 없습니다. 다시 시도하세요", function() {});
                            
                    }
                        hideModalDialog();
                    });
                }
            }).on('click', '.js-cal-option', function () {
              clog("==============================");
              clog("option click 222");

              var $t = $(this), o = $t.data();
              if (o.date) {
                  o.date = new Date(o.date);
                  if(o.mode == undefined)o.mode = "day";          
              }
              setYearMonth(o.date);
              createExcelData();
                
              param_day = o.mode && o.mode == "day" ? o.date.getTime() : "";
              $.extend(options, o);
              window.mdraw();
              holidayCheck(true,true,"black");

            }).on('click', '.js-cal-years', function () {
                param_day = "";
                clog("years click 222");
                holidayCheck(true,true,"black");
              var $t = $(this), 
                  haspop = $t.data('popover'),
                  s = '', 
                  y = options.date.getFullYear() - 2, 
                  l = y + 5;
              if (haspop) { return true; }
              for (; y < l; y++) {
                s += '<button type="button" class="btn btn-default btn-lg btn-block js-cal-option" data-date="' + (new Date(y, 1, 1)).toISOString() + '" data-mode="year">'+y + '</button>';


              }
        //      $t.popover({content: s, html: true, placement: 'auto top'}).popover('toggle');
              return false;
            }).on('click', '.event', function () {
                clog(" click 3333");
                var $t = $(this), o = $t.data();
                if (o.date) {
                  clog("o.mode is "+o.mode);
                  clog("o.date is "+o.date);
                  o.date = new Date(o.date);
                  if(o.mode == undefined)o.mode = "day";

                    holidayCheck(true,true,"black");
              }

              $.extend(options, o);
              window.mdraw();

            });
            
            
        });
      }
    });
  })({
    days: ["일", "월", "화", "수", "목", "금", "토"],
    months: ["1월달", "2월달", "3월달", "4월달", "5월달", "6월달", "7월달", "8월달", "9월달", "10월달", "11월달", "12월달"],
    shortMonths: ["1월", "2월", "3월", "4월", "5월", "6월", "7월", "8월", "9월", "10월", "11월", "12월"],
    date: (new Date()),
        daycss: ["c-sunday", "", "", "", "", "", "c-saturday"],
        todayname: "오늘로가기",
        thismonthcss: "current",
        lastmonthcss: "outside",
        nextmonthcss: "outside",
    mode: "month",
    data: []
  }, jQuery, window, document);
    
   
})(jQuery);
    
    function dummy_button_click(){
        var y = options.date.getFullYear();
        var m = options.date.getMonth()+1;
        var d = options.date.getDate();
         var style = {
                bodycolor: "#eeeeee",
                size: {
                    width: "40%",
                    height: "100%"
                }
            };
        var title ="상품입력하기";
        var message = "<br><text class='textevent' style='float:left'>결제항목</text><br>"+
                      "<input class='form-control' id='input_dummy_desc' placeholder='결제항목 내용을 입력하세요...'/><br>"+
                      
                     "<table>"+
                    "<table style='width:100%;hieght:auto'>"+
                
                                    "<tr>"+
                                        "<td style='width:33%'>"+                                    
                                            "<label class='textevent'>카드</label>"+
                                        "</td>"+
                                        "<td style='width:33%'>"+                                    
                                            "<label class='textevent'>현금</label>"+
                                        "</td>"+
                                        "<td style='width:33%'>"+                                    
                                            "<label class='textevent'>결제총액</label>"+
                                        "</td>"+                                    
                                    "<tr>"+
                                    "</tr>"+
                                        "<td>"+ 
                                            "<input type='text' onfocus='this.select()' onkeyup='onChangeDummyPrice(1)' class='form-control' id='input_dummy_card'  placeholder='카드가격 입력...' style='margin:auto' value='0' />"+
                                        "</td>"+
                                        "<td>"+
                                            "<input type='text' onfocus='this.select()' onkeyup='onChangeDummyPrice(2)' class='form-control' id='input_dummy_cash' placeholder='현금가격 입력...' style='margin:auto' value='0' />"+
                                        "</td>"+ 
                                        "<td>"+
                                            "<input type='text' onfocus='this.select()' class='form-control' id='input_dummy_price' placeholder='결제 총금액 입력...' style='margin:auto' value='0' disabled >"+
                                        "</td>"+ 
                                    "</tr>"+
                                "</table><br>"+
                        "<br><text class='textevent' style='float:left'>결제방법</text><br>"+
                        "<select class='form-control' id='input_dummy_paymenttype' disabled>"+
                                "<option value='0'>선택하세요</option>"+
                                "<option value='1'>카드결제</option>"+
                                "<option value='2'>현금결제</option>"+
                                "<option value='4'>카드+현금</option>"+
                                "<option value='3'>환불</option>"+                                
                            "</select><br>"+    
                    
//                        "<text  style='float:left' class='textevent'>결제총액</text><br>"+
//                      "<input type='number' class='form-control' id='input_dummy_price' placeholder='결제금액 숫자로만 입력하세요...'/><br>"+
                      "<text class='textevent' style='float:left'>특이사항</text><br>"+
                      "<input class='form-control' id='input_dummy_memo' placeholder='특이사항 내용을 입력하세요...'/><br>";
                      
        
        showModalDialog(document.body, title, message, "입력하기", "취소", function() {
            var now = new Date();
            var input_dummy_desc = document.getElementById("input_dummy_desc").value;
            var input_dummy_paymenttype = document.getElementById("input_dummy_paymenttype").value;
            var input_dummy_card = document.getElementById("input_dummy_card").value;
            var input_dummy_cash = document.getElementById("input_dummy_cash").value;
            var input_dummy_price = document.getElementById("input_dummy_price").value;
            var input_dummy_memo = document.getElementById("input_dummy_memo").value;
            
            if(parseInt(input_dummy_price) == 0){
                input_dummy_paymenttype = "0";
            }else if(parseInt(input_dummy_paymenttype) < 1){
                alertMsg("결제방법을 선택하세요");
                return;
            }
            
            var hh = now.getHours();
            var mm = now.getMinutes();
            var ss = now.getSeconds();
//            clog("now "+now);
            var date = y+"-"+m+"-"+d+" "+hh+":"+mm+":"+ss;
            var value = {
                date:date,
                desc :input_dummy_desc,
                paymenttype:input_dummy_paymenttype,
                card : parseCommaInt(input_dummy_card),
                cash : parseCommaInt(input_dummy_cash),
                price : parseCommaInt(input_dummy_price),
                memo : input_dummy_memo
            }
            sendDummyPayment(value);
        }, function() {
            hideModalDialog();
        },style);
      }
    
    function onChangeDummyPrice(type){
        var input_dummy_card = document.getElementById("input_dummy_card");
        var input_dummy_cash = document.getElementById("input_dummy_cash");
        var input_dummy_price = document.getElementById("input_dummy_price");
        var input_dummy_paymenttype = document.getElementById("input_dummy_paymenttype");
        
//        clog("input_dummy_card "+input_dummy_card.value+" input_dummy_cash "+input_dummy_cash.value);
        var card = input_dummy_card.value && parseCommaInt(input_dummy_card.value) != 0 ? parseCommaInt(input_dummy_card.value) : 0;
        var cash = input_dummy_cash.value &&  parseCommaInt(input_dummy_cash.value) != 0 ? parseCommaInt(input_dummy_cash.value) : 0;
        var price = card+cash;
        
        
        var paymenttype = 0;
        if(card == 0 && cash == 0)paymenttype = 0;
        else if(card > 0 && cash == 0)paymenttype = 1;
        else if(card == 0 && cash > 0)paymenttype = 2;
        else if(card > 0 && cash > 0 )paymenttype = 4;
        else if(card < 0 || cash < 0 )paymenttype = 3;
        
//        clog("card "+card+" cash "+cash+" total "+price);
        
        input_dummy_paymenttype.value = paymenttype+"";
        input_dummy_card.value = CommaString(card);
        input_dummy_cash.value = CommaString(cash);
        input_dummy_price.value = CommaString(price);
        
    }
    function sendDummyPayment(value){
        
        
        var groupcode = getData("nowgroupcode");
        var centercode = getData("nowcentercode");

         var senddata = {
            groupcode : groupcode,
            centercode : centercode,
            type :"insertdummypayment",
            value:value
        };
        CallHandler("adm_get", senddata, function (res) {
            code = parseInt(res.code);
            if (code == 100) {

               alertMsg(res.message,function(){
                   reload_calendar_page();
               });
            } else {
                alertMsg(res.message,function(){
                    hideModalDialog();       
                });
            }
             
        }, function (err) {
            alertMsg("네트워크 에러 ");

        });
    }
 function update_window_optionsdata(paymentid, cardnumber){
    for(var i = 0; i < options.data.length; i++){        
        if(options.data[i].bdatas.paymentid == paymentid)
            options.data[i].bdatas.paymentcardnumber = cardnumber;
    }
 }

    function is_SameCoupon(now_couponid){
        var flg= false;
        if(allpayments)
//        for(i = 0; 0 < allpayments.length; i++) {
//           var obj = allpayments[i];
//            if(obj){
////                var b_couponid = obj.pm_couponid ? obj.pm_couponid : obj.pm_date;
////            clog("bcouponid "+b_couponid+ "now_couponid "+now_couponid);
////                if(isSameCouponid(b_couponid, now_couponid)){
////                    flg = true; 
////                    break;
////                }
//            }
//            
//                
//        }
        return flg;
        
    } 
    function createExcelData(){
        btn_download_excel.innerHTML  = "<img src = './img/ic_excel.png' style='margin-top:-12px;height:22px;margin-top:-1px;margin-right:10px'/>"+(thismonth+1)+"월 매출현황 엑셀로 다운로드";
        var titles = ["구분","이름","고객번호","생년월일","성별","결제자","결제항목","시작일","라커가격","헬스가격","PT.GX 가격","미수금가격","결제총액","승인번호","특이사항","매출기록삭제/복구"];
        var txt_gender = {"M":"남자" , "F" : "여자" , "U" : ""};
        var len = allpayments.length;
        excel_data = [];
        var before_obj = null;
        if (len > 0) {
            for(i = 0; i < allpayments.length; i++) {
                var obj = allpayments[i];

                if(!obj)break;
                var tdate = obj.pm_date;
                var date = new Date(tdate);

                var title = "PT"; //제목이지만 내용을 적으면 된다.
                var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
                var y = date.getFullYear();
                var m = date.getMonth();  //
                var d = date.getDate();
                var hh = date.getHours();
                var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
                var start = new Date(y, m, d, hh, mm);


                var b_date = new Date(y, m, d);
                var b_profile = "";
                var b_paymentid = obj.pm_date;
                var b_status = obj.pm_status ? obj.pm_status : 'N';
                var b_uid = obj.pm_useruid;
                var b_userid = obj.pm_userid;
                var b_name = obj.pm_username;
                var b_gender = obj.pm_usergender;
                
                var b_couponid = obj.pm_couponid ? obj.pm_couponid : obj.pm_date;
                var b_coupontype = obj.pm_coupontype;

        //        var b_constructor = obj.pm_constructor; //uid 를 표시
                var b_constructor = obj.pm_constructorname ? obj.pm_constructorname : ""; //가입시킨사람 이름을 표시
                var b_desc = obj.pm_desc;
                var b_starttime = obj.pm_starttime;
                var b_endtime = obj.pm_endtime;
                var b_locker_price = obj.pm_pay_locker;
                
        //        var b_term_price = obj.pm_pay_termtype;
        //        var b_count_price = obj.pm_pay_counttype;
                var membership_type = parseInt(obj.pm_pay_counttype) > 0  ? "PT" : "기간제"; //구분 
                if(membership_type == "기간제" && b_coupontype == "G") membership_type = "그룹";
                
                var txt_coupontype = { "T" : "기간제" , "G" : "그룹" , "C" : "횟수제" , "U" : "알수없음", "L" : "라커만" , "TL" : "기간제 + 라커" , "R" :"환불" , "S": "양도", "M" : "미수금환불", "GA" : "GX횟수/기간추가", "UG" : "업그레이드", "O" : "기타상품"	};
                var coupon_type = txt_coupontype[b_coupontype];
                
                var b_term_or_count_price = membership_type == "COUNT" ? obj.pm_pay_counttype : obj.pm_pay_termtype;
                var b_termtype_price = obj.pm_pay_termtype;
                var b_counttype_price = obj.pm_pay_counttype;
                var b_remain_id = obj.pm_pay_remainid ? obj.pm_pay_remainid : "";
                var b_remain_price = obj.pm_pay_remainprice ? obj.pm_pay_remainprice : "";

                var b_total_price = obj.pm_total_pay;
                var b_other = obj.pm_memo;
                var b_retake = obj.pm_retake;
                var b_paymenttype = obj.pm_paymenttype;
                var b_paymentcardnumber = obj.pm_paymentcardnumber;
                var b_userid = obj.pm_userid;
                
                
                
                var txt_remainprice = "";
                var txt_totalprice = "";
                var before_cid = before_obj && before_obj.pm_couponid ? before_obj.pm_couponid : "";
                var isbeforesame = isSameCouponid(before_obj,obj);
                if(b_remain_price){

                    var json_remainprice = JSON.parse(b_remain_price);
                    if(json_remainprice){
                        var rprice = parseInt(json_remainprice.remain);

                        if(!isbeforesame && rprice > 0)
                            txt_remainprice = ""+TXT_WON+number_format(rprice); 
                        else {
                            txt_remainprice = TXT_WON+"0";
                        }
                    }
               

                     if(isbeforesame){
                         value = "&nbsp;<text style='color:red;font-weight:bold;'>-</text>";
                     }else{
                         //카드결제
                        if(b_paymenttype == "1" || b_paymenttype == "3"){

                            var remain_price = JSON.parse(b_remain_price);
                            var price = remain_price && parseInt(remain_price.card) >= 0 ? Math.floor(remain_price.card) : 0;
                            if(isbeforesame)price = 0;
                           
                            txt_totalprice = "카드 : "+TXT_WON+CommaString(price);
                            
                        }                          
                        //카드 + 현금결제
                        else if(b_paymenttype == "4"){
                           
                            var remain_price = JSON.parse(b_remain_price);
                            txt_totalprice = "카드 : "+TXT_WON+number_format(Math.floor(remain_price.card)) + "현금 : "+TXT_WON+number_format(Math.floor(remain_price.cash));
                            
                        }//현금결제                            
                        else {
                            var remain_price = JSON.parse(b_remain_price);
                            var price = remain_price && parseInt(remain_price.cash) >= 0 ? Math.floor(remain_price.cash) : 0;
                            if(isbeforesame)price = 0;
                           
                            txt_totalprice = "현금 : "+TXT_WON+CommaString(price);
                        }
                     }   
                }
                
                var remain_price = b_remain_price ? JSON.parse(b_remain_price): {"card":0, "cash":0, "remain":0, "discount":0, "total":0, "total_remain":0};
                var b_card = remain_price.card ? remain_price.card+"" : "0";   
                var b_cash = remain_price.cash ? remain_price.cash+"" : "0";
                var b_remain = remain_price.remain ? remain_price.remain+"" : "0";
                var b_discount = remain_price.discount ? remain_price.discount+"" : "0";
                var b_total = remain_price.total_remain ? remain_price.total_remain+"" : "0";
                if(b_coupontype == "R"){
                    if(remain_price.card && remain_price.card != 0)b_card = -remain_price.card+"";
                    if(remain_price.cash && remain_price.cash != 0)b_cash = -remain_price.cash+"";
                    if(remain_price.remain && remain_price.remain != 0)b_discount = -remain_price.remain+"";
                    if(remain_price.discount && remain_price.discount != 0)b_discount = -remain_price.discount+"";
                    if(remain_price.total_remain && remain_price.total_remain != 0)b_total = -remain_price.total_remain+"";
                }
                
//                clog("tdate "+tdate);
                if(stringGetYear(tdate) == thisyear && stringGetMonth(tdate) == thismonth+1)
                excel_data.push({"결제일":tdate,"구분":coupon_type,"이름":b_name,"고객번호":b_userid,"성별":txt_gender[b_gender],"결제자":b_constructor,"결제항목":b_desc,"시작일":b_starttime,"종료일":b_endtime,"카드":b_card,"카드":b_card,"카드":b_card,"현금":b_cash,"미수금":b_remain,"할인":b_discount,"결제총액":b_total,"승인번호":b_paymentcardnumber,"특이사항":b_other});
                
                before_obj = obj;
            
            }
        }
 
    }
    
    
 
var stack_years = []   
var alldata = [];
var statistic_month = {}; //년 기준 월별 총매출표기
function insertCalenderDatas(datas,isfirst){   
    alldata = [];
//    clog("datas is ",datas);
    //test
    statistic_month = {};
    for(i = 0; i < datas.length; i++) {
        var obj = datas[i];

        if(!obj)break;
        var tdate = obj.pm_date;
        var date = new Date(tdate);

        var title = "PT"; //제목이지만 내용을 적으면 된다.
        var allday = false; //true 이면 AllDay 에 표기되며 false 일때 시간으로 표시된다.
        var y = date.getFullYear();
        var m = date.getMonth();  //
        var d = date.getDate();
        var hh = date.getHours();
        var mm = 0; //30분짜리는 삭제했다.  그래서 항상 0으로 고정해야한다.
        var start = new Date(y, m, d, hh, mm);


        var b_date = new Date(y, m, d);
        var b_profile = "";
        var b_paymentid = obj.pm_date;
        var b_pmidx = obj.pm_idx;
        var b_status = obj.pm_status ? obj.pm_status : 'N';
        var b_uid = obj.pm_useruid;
        var b_name = obj.pm_username;
        var b_gender = obj.pm_usergender;
        
        var b_couponid = obj.pm_couponid ? obj.pm_couponid : obj.pm_date;
        var b_coupontype = obj.pm_coupontype;
        
//        var b_constructor = obj.pm_constructor; //uid 를 표시
        var b_constructor = obj.pm_constructorname ? obj.pm_constructorname : ""; //가입시킨사람 이름을 표시
        var b_desc = obj.pm_desc;
        var b_starttime = obj.pm_starttime;
        var b_endtime = obj.pm_endtime;
        var b_locker_price = obj.pm_pay_locker;
//        var b_term_price = obj.pm_pay_termtype;
//        var b_count_price = obj.pm_pay_counttype;
        
        var membership_type = parseInt(obj.pm_pay_counttype) > 0  ? "COUNT" : "TERM";
        //미수금회수일때는 pm_pay_termtype = 0 , pm_pay_counttype = 0 pm_coupontype ??? 에따라 결정됨
        if(parseInt(obj.pm_pay_termtype) == 0 && parseInt(obj.pm_pay_counttype) == 0 && obj.pm_coupontype == "C") 
            membership_type = "COUNT"; 
        
        if(obj.pm_coupontype == "R" && b_desc.indexOf(TYPE_PT) >= 0){            
            membership_type = "COUNT";             
        }
        
        
       
        
//        console.log(b_name+" "+obj.pm_date+" "+obj.pm_coupontype+" membership_type "+membership_type);
//        console.log("obj",obj);
        var b_term_or_count_price = membership_type == "COUNT" ? obj.pm_pay_counttype : obj.pm_pay_termtype;
        var b_termtype_price = obj.pm_pay_termtype;
        var b_counttype_price = obj.pm_pay_counttype;
        
        var b_remain_id = obj.pm_pay_remainid ? obj.pm_pay_remainid : "";
        var b_remainfinish = obj.pm_remainfinish ? obj.pm_remainfinish : "N";
        var b_remain_price = obj.pm_pay_remainprice ? obj.pm_pay_remainprice : "";
        
        var json_remainprice = b_remain_price && b_remain_price != 0 ? JSON.parse(b_remain_price) : null;
        var b_card_price = json_remainprice ? parseInt(json_remainprice.card) : 0;
        var b_cash_price = json_remainprice ? parseInt(json_remainprice.cash) : 0;
        var b_discount_price = json_remainprice ? parseInt(json_remainprice.discount) : 0;

        var b_total_price = obj.pm_total_pay;
        var b_other = obj.pm_memo;
        var b_retake = obj.pm_retake;
        var b_paymenttype = obj.pm_paymenttype;
        var b_paymentcardnumber = obj.pm_paymentcardnumber;
        var b_userid = obj.pm_userid;
        var b_ornercheck = obj.pm_ornercheck;
        var b_datas =   {"membership_type":membership_type,"pmidx":b_pmidx,"paymentid":b_paymentid,"pmstatus":b_status,"uid":b_uid,"date":b_date,"profile":b_profile,"name":b_name,"gender":b_gender,"couponid":b_couponid,"coupontype":b_coupontype,"constructor":b_constructor,"desc":b_desc,"starttime":b_starttime,"endtime":b_endtime,"locker_price":b_locker_price,"term_or_count_price":b_term_or_count_price,"term_price":b_termtype_price,"count_price":b_counttype_price,"card_price":b_card_price,"cash_price":b_cash_price,"remain_id":b_remain_id,"remainfinish":b_remainfinish,"remain_price":b_remain_price,"discount_price":b_discount_price,"total_price":b_total_price,"other":b_other,"retake":b_retake,"paymenttype":b_paymenttype,"paymentcardnumber":b_paymentcardnumber,"userid":b_userid,"ornercheck":b_ornercheck};
//        clog("title",title);
//        clog("start",start);
//        clog("b_datas",b_datas);
//        clog("******** b_constructor "+b_constructor);
        alldata.push({ title: title, start: start, bdatas:b_datas});
        
        //매월 총금액만 계산
        insertbdata(tdate,b_datas);
        
    }
//    console.log("statistic_month ",statistic_month);
//    clog("alldata ",alldata);
//    if(window.options)clog("window.options.data",window.options.data);
    if(isfirst){
        alldata.sort(function(a,b) { return (+a.start) - (+b.start); });
        $('#holder').calendar({
            data: alldata
        });
        window.el = $('#holder');    

        isInYear(window.options.date.getFullYear());
        
        //clog("window.options.date ",window.options.date.getFullYear());
        
        
    }else{
        if(!isInYear(window.options.date.getFullYear())){
            for(var i =0; i < alldata.length;i++)
                window.options.data.push(alldata[i]);
        }
        window.mdraw();
    }
   
    
}
    
    //매월 총금액만 계산
    function insertbdata(date,bdata){
       
        if(bdata.pmstatus == "D")return;
        
       var yyyy = stringGetYear(date);
       var mm = stringGetMonth(date);
        
       var yyyymm = yyyy+"-"+mm;
//        console.log("yyyy- mm "+yyyymm);
        //ptype : 가격타입 , rrtype : 환불-미수금회수타입 , rtype: 신규,재등록 타입 , tctype: 기간제 횟수제타입
        var isclick_type = {"ptype" : CLICKTYPE.none, "rrtype" : CLICKTYPE.none, "rtype" : CLICKTYPE.none, "tctype":CLICKTYPE.none}; 
        var isdelete = bdata.pmstatus == 'D' ? true : false;  
        var paytype = parseInt(bdata.paymenttype);
        var remainprice = bdata.remain_price ? JSON.parse(bdata.remain_price) : {"card":0,"cash":0,"remain":0,"total_remain":0,"total":0};
//        console.log("bdata ",bdata);

        if(!statistic_month[yyyymm])
            statistic_month[yyyymm] = 0;

        if(paytype == 1){// 카드
            statistic_month[yyyymm] += parseInt(remainprice.card);
        }else if(paytype == 2 || paytype == 0){ // 현금  ,  기타결제
            statistic_month[yyyymm] += parseInt(remainprice.cash);

        }else if(paytype == 3){// 환불
            statistic_month[yyyymm] += parseInt(bdata.total_price);

        }else if(paytype == 4){// 카드 + 현금 
            statistic_month[yyyymm] += parseInt(remainprice.card);
            statistic_month[yyyymm] += parseInt(remainprice.cash);
        }
//        console.log("statistic_month ",statistic_month);
     }
    
    function isInYear(year){
       
        var isin = false;
        for(var i = 0; i < stack_years.length; i++){
            if(stack_years[i] == year){
                isin = true;
                break;
            }
        }
        if(!isin)stack_years.push(year);
        return isin;
    }
    
    var first_goto_day = false;
    var first_goto_toggle = false; // 매출기록삭제복구눌렀을때를 체크하기위해
    function checkDayPage(){
        if(!first_goto_day && param_day){

            
            var fInterval = setInterval(function(){
                if(!isfirst){
                    // 달력으로 이동한다.테스트
                    window.options.mode = "day";
                    var date = new Date(parseInt(param_day));
                    window.options.date = date;
        //            window.calendar(window.el,window.options);
                      if(window.mdraw)window.mdraw();
                    first_goto_day = true;
                    clearInterval(fInterval);
                }
            },100);
        }
    }
    //오직 매출기록만 (토글) 삭제/복구 눌렀을때 호출된다.
     function paramDayToggleCheck(){
        if(!first_goto_toggle && param_day){
            // 달력으로 이동한다.테스트
            window.options.mode = "day";
            var date = new Date(parseInt(param_day));
            window.options.date = date;
//            window.calendar(window.el,window.options);
              if(window.mdraw)window.mdraw();
            first_goto_toggle = true;
            param_day = "";
        }
    }
    
    
    
    //mode == day 라면 해당날짜로 간다.
    function reload_calendar_page(centercode){
        if(centercode)param_centercode = centercode;
        var mode = window.options && window.options.mode ? window.options.mode : "month";
        var date = window.options && window.options.date ? window.options.date.getTime() : "";
        param_day = mode == "day" ? date : "";
//        refresh_page("?centercode="+param_centercode+"&day="+param_day); //
        first_goto_day = false;
        var value = {};
        value.year = param_year;
        value.paramday = param_day;
        loadMainDiv(5);
    }
    
</script>