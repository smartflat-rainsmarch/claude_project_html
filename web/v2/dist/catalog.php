
<?php
include('./common.php');
//echo "login session : ".$_SESSION['key'];
//echo "login authgroup : ".$_SESSION['authgroup'];
//echo "  _COOKIE ".$_COOKIE['key'];
//echo "session len :".strlen($_SESSION['key']);
//echo "cookie len :".strlen($_COOKIE['mysession']);
$session = null;
$auth = null;
$userinfo = null;
$usernamedesc = "";
if(isset($_SESSION['key'.DEV_REAL]) && isset($_SESSION['authgroup'.DEV_REAL]) && isset($_SESSION['data'.DEV_REAL])){
    $session = $_SESSION['key'.DEV_REAL];
    $auth = $_SESSION['authgroup'.DEV_REAL];
    
    $userinfo = $_SESSION['data'.DEV_REAL]['userinfo'];
//    echo "info ".$userinfo['name'];
    $id = $userinfo["id"];
    $usernamedesc = $userinfo['name'];
    
    $groupcode = $userinfo["groupcode"];
    $centercodes = $userinfo["centercodes"];
}
?>
<!DOCTYPE html>
<html lang="ko">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="./libs/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="./libs/swiper/swiper-bundle.min.js"></script>
    <title>카타로그</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
    

</head>

<body>
    <div class="swiper-container" style='overflow-y:hidden'>
        <div id='id_swiper' class="swiper-wrapper" style='overflow-y:hidden'>
<!--
            <div class="swiper-slide">
                <div id="catalog0">
                    <img src="./img/catalog/1_0.png" /><br>
                    <img src="./img/catalog/1_1.png" onclick='catalogImageClick(13)'/><br>
                    <img src="./img/catalog/1_2.png" onclick='catalogImageClick(12)'/><br>
                    <img src="./img/catalog/1_3.png" onclick='catalogImageClick(11)'/><br>
                    <img src="./img/catalog/1_4.png" /><br>
                </div>

            </div>
            <div class="swiper-slide">
                <div id="catalog1">
                    <img src="./img/catalog/2_0.png" /><br>
                    <img src="./img/catalog/2_1.png" onclick='catalogImageClick(25)'/><br>
                    <img src="./img/catalog/2_2.png" onclick='catalogImageClick(24)'/><br>
                    <img src="./img/catalog/2_3.png" onclick='catalogImageClick(23)'/><br>
                    <img src="./img/catalog/2_4.png" onclick='catalogImageClick(22)'/><br>
                    <img src="./img/catalog/2_5.png" onclick='catalogImageClick(21)'/><br>
                    <img src="./img/catalog/2_6.png" /><br>
                </div>
            </div>
-->

<!--

              <div id='div_catalog1' class="swiper-slide" style="display:none"><img id='img_catalog1' onclick = "catalogImageClick()"/></div>
              <div id='div_catalog2'  class="swiper-slide" style="display:none">
                   <img id='img_catalog2' onclick = "catalogImageClick()"/>
              </div>
              <div id='div_catalog3'  class="swiper-slide" style="display:none">
                   <img id='img_catalog3' onclick = "catalogImageClick()"/>
              </div>
              <div id='div_catalog4'  class="swiper-slide" style="display:none">
                   <img id='img_catalog4' onclick = "catalogImageClick()"/>
              </div>
-->


            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <!--
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
-->

        <div class="swiper-scrollbar"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        //        var screen_width = window.screen.height;
        //        
        //        var catalog0 = document.getElementById("catalog0");
        //        catalog0.style.marginTop = "100px";
        //        console.log(screen_width+"catalog0.height "+catalog0.style.height);
        function getParam(sname) {
            var params = location.search.substr(location.search.indexOf("?") + 1);
            var sval = "";
            params = params.split("&");
            for (var i = 0; i < params.length; i++) {
                temp = params[i].split("=");
                if ([temp[0]] == sname) { sval = temp[1]; }
            }
            return sval;
        }
        

            var param_centercode = getParam("centercode");
            var div_catalog1 = document.getElementById("div_catalog1");
            var div_catalog2 = document.getElementById("div_catalog2");
            var div_catalog3 = document.getElementById("div_catalog3");
            var div_catalog4 = document.getElementById("div_catalog4");
        
            var img_catalog1 = document.getElementById("img_catalog1");
            var img_catalog2 = document.getElementById("img_catalog2");
            var img_catalog3 = document.getElementById("img_catalog3");
            var img_catalog4 = document.getElementById("img_catalog4");
        
            var catalog1_path = PAGE_IMAGE_PATH + session_groupcode+"/logos/catalog1_"+param_centercode+"_720x960.JPG";
            var catalog2_path = PAGE_IMAGE_PATH + session_groupcode+"/logos/catalog2_"+param_centercode+"_720x960.JPG";
            var catalog3_path = PAGE_IMAGE_PATH + session_groupcode+"/logos/catalog3_"+param_centercode+"_720x960.JPG";
            var catalog4_path = PAGE_IMAGE_PATH + session_groupcode+"/logos/catalog4_"+param_centercode+"_720x960.JPG";
            console.log("catalog1_path "+UrlExists(catalog1_path));
         console.log("catalog2_path "+UrlExists(catalog2_path));
         console.log("catalog3_path "+UrlExists(catalog3_path));
         console.log("catalog4_path "+UrlExists(catalog4_path));
        
            
            if(!UrlExists(catalog1_path) && !UrlExists(catalog2_path) && !UrlExists(catalog3_path) && !UrlExists(catalog4_path)){
                alert("카달로그 이미지가 없습니다.");                
            }
            var urls = [];
        
            if(UrlExists(catalog1_path)){
//                console.log("00");
//                img_catalog1.src = catalog1_path;
//                div_catalog1.style.display = "block";
                urls.push(catalog1_path);
            }
            
            if(UrlExists(catalog2_path)){
//                console.log("11");
//                img_catalog2.src = catalog2_path;
//                 div_catalog2.style.display = "block";
                 urls.push(catalog2_path);
            }
            
            if(UrlExists(catalog3_path)){
//                console.log("22");
//                img_catalog3.src = catalog3_path;
//                div_catalog3.style.display = "block";
                urls.push(catalog3_path);
            }
//            
            if(UrlExists(catalog4_path)){
//                console.log("33");
//                img_catalog4.src = catalog4_path;
//                div_catalog4.style.display = "block";
                urls.push(catalog4_path);
            }
            console.log("urls ",urls);
            var id_swiper = document.getElementById("id_swiper");
            for(var i = 0 ; i < urls.length;i++){
                id_swiper.innerHTML += " <div id='div_catalog"+(i+1)+"' class='swiper-slide' ><img id='img_catalog"+(i+1)+"' src ='"+urls[i]+"' onclick = 'catalogImageClick()'/></div>";
            }
            
        
//            img_catalog1.src = UrlExists(catalog1_path) ? catalog1_path : div_catalog1.style.display = "none";
//            img_catalog2.src = UrlExists(catalog1_path) ? catalog2_path : div_catalog2.style.display = "none";
//            img_catalog3.src = UrlExists(catalog1_path) ? catalog3_path : div_catalog3.style.display = "none";
//            img_catalog4.src = UrlExists(catalog1_path) ? catalog4_path : div_catalog4.style.display = "none";
            
     
         var mySwiper = new Swiper('.swiper-container', {
            // 슬라이드를 버튼으로 움직일 수 있습니다.
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            // 현재 페이지를 나타내는 점이 생깁니다. 클릭하면 이동합니다.
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
            },

            // 현재 페이지를 나타내는 스크롤이 생깁니다. 클릭하면 이동합니다.
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
            },

            // 3초마다 자동으로 슬라이드가 넘어갑니다. 1초 = 1000
            //  autoplay: {
            //    delay: 3000,
            //  },
            
            onAny(eventName, ...args) {
//             console.log('Event: ', eventName);
//             console.log('Event data: ', args);
           }
        });
     
        
        
        function UrlExists(url)
        {
            var http = new XMLHttpRequest();
            http.open('HEAD', url, false);
            http.send();
            return http.status!=404;
        }
        function catalogImageClick(index){
            var param = "?";
            switch(index){
                case 11:
                case 12:
                case 13:
                    param+="catalogtype=PT&catalognum="+index;
                    break;
                case 21:
                case 22:
                case 23:
                case 24:
                case 25:
                    param+="catalogtype=term&catalognum="+index;
                    break;
                
            }
            goToJoinParam(param);
        }
        function goToJoinParam(str_param){
            if (!auth || auth && auth <= AUTH_NOMEMBER) {
                  alertMsg("로그인을 해주세요");
                  return;
            }
            location.href = str_param ? "./join.php"+str_param : "./join.php";
        }
    </script>
</body>

</html>
