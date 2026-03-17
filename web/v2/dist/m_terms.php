<?php
 include('./cmn_var.php');

$uid = isset($_POST['uid']) ? $_POST['uid'] : '';//제대로 가입한 유저인지 체크하기 위한 값
$id = isset($_POST['id']) ? $_POST['id'] : '';//제대로 가입한 유저인지 체크하기 위한 값
$type = isset($_POST['type']) ? $_POST['type'] : '';//이용약관인지 , 개인정보 처리방침인지

//$uid = "tMbarXf6IF7Rg01HuQjW_2021-11-02";
//$id = "106732";
//$type = "termsofservice";   //"termsofservice"; "privacy_policy";


?>
<!DOCTYPE html> 
<html lang="ko">
<head>
    <title>이용약관(표준 약관)</title>

    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
     <script>

            var MetaTag = document.createElement("META");
            MetaTag.setAttribute('name', 'viewport');
            MetaTag.setAttribute('content', 'width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1');
            document.getElementsByTagName('head')[0].appendChild(MetaTag);
        </script>
    <!--    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1, maximum-scale=2.0, minimum-scale=1" />--><meta name="format-detection" content="telephone=no, address=no, email=no" />

    <!-- 아이폰(사파리) UI 없애기 -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />

    <link rel="stylesheet" href="./css/layout.css"/>
    <link rel="stylesheet" href="./css/sub.css"/>
    <style>
    @font-face { font-family: 'Montserrat'; src: url('fonts/font_montserrat.ttf');}
    @font-face { font-family: 'Noto'; src: url('fonts/font_noto_sans_kr.otf');}

     body {
/*            font-family: 'Noto Sans KR', sans-serif;*/
         font-family: 'Noto Sans KR', sans-serif;
    }
    
    
    
        /*이미지 무한회전*/
        img.infinite_rotating_logo{
            animation: rotate_image 1s linear infinite;
            transform-origin: 50% 50%;
        }
        @keyframes rotate_image{
            100% {
                transform: rotate(360deg);
            }
        }

        
        /*모달 뒷배경 뿌옇게*/
        .modal-backdrop{backdrop-filter: blur(5px);background-color: #000000cc;}
        .fade.modal-backdrop.show{opacity: 0.9;}
        
    </style>
    <!--[if IE 9]>
    <link rel="stylesheet" href="/css/default.ie9fix.css">
    <![endif]-->

    <!--[if lt IE 9]>
    <script src="/js/html5shiv.js"></script>
    <script src="/js/respond.min.js"></script>
    <![endif]-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <script src="js/scripts.js?ver3.01a"></script>
</head>

<body style="background-color:#111111;" >
    <div id='div_loading_progress' style='position:absolute;text-align:center;width:100%;height:110%;background-color:#33333399;position:fixed;z-index:9999999;margin-top:-60px;display:none;'><img src='./img/loading80.png' class='infinite_rotating_logo' style='margin-top:50%;width:10%;'/></div>
    <div style="width:100%;height:70px;position:fixed;">
         <table style='width:100%;height:70px;background-color:#111;padding-left:20px;padding-right:20px'>
               
                     
                    <tr>
                        <td onclick="clickTab(0)"  style='width:50%;' align="center"><text id='left_title' style='font-weight:bold;color:white;font-family:Noto Sans KR'>BG테크</text>
                        </td>
                        <td onclick="clickTab(1)" style='width:50%;' align="center"><text id='right_title'  style='color:#afafaf;font-family:Noto Sans KR'>센터</text>
                        </td>   
                    </tr>
                    <tr>
                        <td>
                            <div id='left_line' style='width:100%;height:2px;background-color:#fffd00'></div>
                        </td>
                        <td>
                            <div id='right_line' style='width:100%;height:2px;background-color:#afafaf'></div>
                        </td>
                    </tr>
               
            </table>
    </div>
    <div id= "terms_container" style='margin-left:20px;margin-right:20px;padding-top:70px'>	
        
           
       

        <div id="left_main" style='margin-top:20px;overflow:hidden;width:100%;height:auto;font-family:Noto Sans KR'></div>
        <div id="right_main" style='margin-top:20px;overflow:hidden;width:100%;height:auto;display:none;font-family:Noto Sans KR'></div>
    </div>
    
   

</body>
</html>
 
<script>
    
    
    
    
    var obj = new Object();
    obj.uid = "<?php echo $uid; ?>";
    obj.id = "<?php echo $id; ?>";
    obj.type = "<?php echo $type; ?>";
    
    initType(obj.type);
    var zoom = setZoom();
    clog("zoom "+zoom);
    CallHandler("terms", obj, function(res) {
        
        var code = parseInt(res.code);
        clog("res ",res);
        if (code == 100) {
                
           setDatas(res.message,res.centernames);
           
           
        } else {
            alertMsg(res.message);
        }

    }, function(err) {
        alertMsg("네트워크 에러 ");
    });

    function initType(type){
        if(type == "termsofservice"){
            document.title = "이용약관(표준 약관)"; 
        }else if(type == "privacy_policy"){
            document.title = "개인정보 처리방침"; 
        }else 
            document.title = "약관"; 
    }
    function setDatas(rows,centernames){
        var left_title = document.getElementById("left_title");
        var right_title = document.getElementById("right_title");
        
        var left_main = document.getElementById("left_main");
        var right_main = document.getElementById("right_main");
        left_main.innerHTML = "<div style='color:white'>"+rows[0]+"</div>";
        right_main.innerHTML = "<div style='color:white'>"+rows[1]+"</div>";
        
        left_title.innerHTML = centernames[0];
        right_title.innerHTML = centernames[1];
    }
    
    function clickTab(idx){
        clog
        var left_title = document.getElementById("left_title");
        var left_line = document.getElementById("left_line");
        var left_main = document.getElementById("left_main");
        
        var right_title = document.getElementById("right_title");
        var right_line = document.getElementById("right_line");
        var right_main = document.getElementById("right_main");
        
        
        if(idx == 0){
            left_title.style.color = "white";
            left_title.style.fontWeight = "bold";
            left_line.style.backgroundColor = "#fffd00";
            left_main.style.display ="block";
            
            right_title.style.color = "#afafaf";
            right_title.style.fontWeight = "normal";
            right_line.style.backgroundColor = "#afafaf";
            right_main.style.display ="none";
            
        }else{
            right_title.style.color = "white";
            right_title.style.fontWeight = "bold";
            right_line.style.backgroundColor = "#fffd00";
            right_main.style.display ="block";
            
            left_title.style.color = "#afafaf";
            left_title.style.fontWeight = "normal";
            left_line.style.backgroundColor = "#afafaf";
            left_main.style.display ="none";
        }
    }
</script>


