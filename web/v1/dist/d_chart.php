<div>

                    <div class="container-fluid">
                        <br>
                       <H2 id = 'id_chart_title'>챠트</H2><br>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index">홈으로</a></li>
                            <li class="breadcrumb-item active">Charts</li>
                        </ol>
                        
                        <div class="card mb-4">
<!--
                            <div class="card-body">
                                Chart.js is a third party plugin that is used to generate the charts in this template. The charts below have been customized - for further customization options, please visit the official
                                <a target="_blank" href="https://www.chartjs.org/docs/latest/">Chart.js documentation</a>
                                .
                            </div>
-->
                             <div style="padding:20px;background-image: linear-gradient(#fff7d1 0px, #ffffb0 100%);" >
                                <img src ='./img/arrow_l.png' style='position:absolute' onclick = "arrowClick(0)"/>
                                <img src ='./img/arrow_r.png' align="right" style='position:auto;' onclick = "arrowClick(1)"/>
                                <div align = "center" style="margin-top:10px"><input id="id_chart_date" type="date"style="margin-left:50px;font-size:20px;color:#555555;font-weight:bold;" onchange='onChangeCalendar()' value="<?php echo date('Y-m-d'); ?>"/></div>

                            </div>
<!--
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area mr-1"></i>
                                    Area Chart Example
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="30"></canvas></div>
                                <div class="card-footer small text-muted"><text id='chart_desc'>총 0 명</text></div>
                            </div>
-->
                        </div>
                         <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area mr-1 " title='시간대별 입실자 인원수를 표시합니다.'></i>
                                    시간대별 그래프
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="50" disabled></canvas></div>
                                <div class="card-footer small text-muted"><text id='chart_desc'>총 0 명</text></div>
                        </div>
<!--
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-8">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar mr-1"></i>
                                        시간대별 그래프
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                    <div class="card-footer small text-muted"><text id='chart_desc'>총 0 명</text></div>
                                </div>
                            </div>                            
                        </div>
-->
                    </div>
              
        <div align='center'><txext id='id_empty_txt' class='textevent' style='color:red;width:100%'></txext></div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->
<!--        <script src="js/scripts.js?ver=1.23"></script>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>-->
<!--
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="./assets/demo/chart-bar-demo.js"></script>
        <script src="assets/demo/chart-pie-demo.js"></script>
-->
<script>
    
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var day = now.getDate();
    var myLineChart = null;
    var chart_type = "";
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';
    function init_d_chart(value){

        clog("maininit testpage");
        //타이틀 제목
        var id_chart_title = document.getElementById("id_chart_title");
        
        chart_type = value;
        switch(value){
            case "chart_time_line":
                id_chart_title.innerHTML = title_icon+"시간대별 입실자";
                break;
        }
        setChartData(getToday());
    }
    function onChangeCalendar(){
        var id_chart_date = document.getElementById("id_chart_date");
        if(id_chart_date){
            now = new Date(id_chart_date.value);
            setChartData(id_chart_date.value);
        }
    }
    function setChartData(_now){
        clog("now ",_now);
        var id_chart_date = document.getElementById("id_chart_date");
        id_chart_date.value = _now;
        
       
        
        getStatisticData("statistic", chart_type, _now, _now, function(res) {
             var code = parseInt(res.code);
             if (code == 100) {
                 clog("data is ",res.message);
                  drawChart(res.message);
             }
             else {
                 
                  drawChart(null);
             }
                 

            
         },function(err){
            alertMsg("네트워크 에러 ");
        });
    }

    function arrowClick(type){
        if(type == 0)
            now.setDate(now.getDate() -1);
        else 
            now.setDate(now.getDate() +1);
        
        setChartData(getToday(now));
    }
    
  

    
    function drawChart(rows){
        var id_empty_txt = document.getElementById("id_empty_txt");
         var id_chart_date = document.getElementById("id_chart_date");
        if(!rows){
            id_empty_txt.innerHTML = id_chart_date.value+"일 데이타를 찾을 수 없습니다.";
            id_empty_txt.style.display = "block";
        }else{
            id_empty_txt.innerHTML = "";
            id_empty_txt.style.display = "none";
        }
        var len = rows ? rows.length : 0;
        var chart_desc = document.getElementById("chart_desc");
        chart_desc.innerHTML = "입실자 총 "+len+"명";
        // Bar Chart Example
        
        var timedata = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];
        
        if(rows)
        for(var i = 0 ; i < rows.length;i++){
            var hour = stringGetHour(rows[i].datetime);
//            clog(i+ " hour "+hour);
            if(hour > 0 && hour < 24){
                timedata[hour-1]++;
            }else if(hour == 23){
                timedata[0]++;
            }
        }
        
        var ctx = document.getElementById("myBarChart");
        var ymax = 10;
        for(var i = 0 ; i < timedata.length; i++){
            if(timedata[i] > ymax){
                ymax = Math.floor(timedata[i]/10)*10+10;
            }
        }
        if(myLineChart != null )myLineChart = null;
        myLineChart = new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ["01","02","03","04","05","06", "07", "08", "09", "10", "11","12","13","14","15","16","17","18","19","20","21","22","23","24"],
            datasets: [{
              label: "인원수",
              backgroundColor: "rgba(2,117,216,1)",
              borderColor: "rgba(2,117,216,1)",
              data:timedata,
//                data: [8,7,7,7,8,4,2,5,9,7,7,7,8,4,2,5,8,7,7,7,8,4,2,5,9,7,7,7,8,4,2,5,9],//test
            }],
          },
          options: {
            scales: {
                //X 축
              xAxes: [{
                time: {
                  unit: 'time'
                },
                gridLines: {
                  display: false
                },
                ticks: {
                  maxTicksLimit: 24
                }
              }],
                //Y 축
              yAxes: [{
                ticks: {
                  min: 0,
                  max: ymax,
                  maxTicksLimit: ymax
                },
                gridLines: {
                  display: true
                }
              }],
            },
            legend: {
              display: false
            }
          }
        });
        
     
    };
    

</script>