<?php session_cache_expire(14400);session_start();?>
<?php

//if(!isset($_SERVER["HTTPS"])) {header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);}

date_default_timezone_set('Asia/Seoul');
 include('./cmn_var.php');
 

//$message = json_decode($_POST['message'],true);  //POST로 받은 값을 json형식으로 decode


//test
//echo "main session : ".$_SESSION['key'];
//echo "  main authgroup : ".$_SESSION['authgroup'];
//$userinfo = $_SESSION['data']['userinfo'];
//echo "  main userinfo : ".$userinfo;
//
//exit;
//$parameter = $_GET["beforepage"];


///////////////////////////////////////////
////Check Mobile   isMobileDevice
///////////////////////////////////////////
$mAgent = array("iPhone","iPod","Android","Blackberry", 
    "Opera Mini", "Windows ce", "Nokia", "sony" );
$chkMobile = false;
$devicename = "";
for($i=0; $i<sizeof($mAgent); $i++){
    if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
        $chkMobile = true;
        $devicename = $mAgent[$i];
        break;
    }
}
/////////////////////////////////////////



if(!isset($_SESSION['key'.DEV_REAL]) || !isset($_SESSION['authgroup'.DEV_REAL])) {
   $page =  "beforepage=".basename($_SERVER['PHP_SELF']); 
//    echo "<script>console.log('sssss');</script>";
//    echo "<script>alertMsg('오랫동안 입력하지 않아 로그아웃되었습니다. 다시로그인하여 주세요');</script>";
//    echo "<script>alert('오랫동안 입력하지 않아 로그아웃되었습니다. 다시로그인하여 주세요');</script>";
    if($chkMobile){
         //echo $devicename == "iPhone" || $devicename == "iPod" ? "<script>webkit.messageHandlers.closeWebView.postMessage();call_app();</script>" : "<script>window.android.closeWebView();call_app();</script>" ;
        echo "call_app();</script>" ;
    }else {
        echo "<script>alert('오랫동안 입력하지 않아 로그아웃되었습니다. 다시로그인하여 주세요');</script><meta http-equiv='refresh' content='0;url=login.php?$page'>";
    }
    exit;
}


if(isset($_SESSION['authgroup'.DEV_REAL]) && $_SESSION['authgroup'.DEV_REAL] < AUTH_CUSTOMER){
    echo "<script>console.log('dddddd');</script>";
    echo "<script>alertMsg('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    echo "<script>alert('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    if($chkMobile){
         echo $devicename == "iPhone" || $devicename == "iPod" ? "<script>webkit.messageHandlers.closeWebView.postMessage();</script>" : "<script>window.android.closeWebView();</script>" ;
    }else {
        echo "<meta http-equiv='refresh' content='0;url=login.php'>";
    }
    exit;
}



$userinfo = $_SESSION['data'.DEV_REAL]['userinfo'];
$uid = $userinfo["uid"];
$id = $userinfo["id"];
$groupcode = $userinfo["groupcode"];
$groupname = $userinfo["groupname"];
$centercodes = $userinfo["centercodes"];
$auth = $_SESSION['authgroup'.DEV_REAL];
$username = $userinfo['name'];
$usernamedesc = $username."님";
$setting = isset($userinfo['setting']) ? json_encode($userinfo['setting']) : '"{}"';
$isadmin = $userinfo['isadmin'];
$domain_name = $_SERVER['SERVER_NAME'];
?>
<script>
    var auth = "<?php echo $auth ;?>";
    var session_groupcode =  "<?php echo $groupcode ;?>";    
    var usernamedesc = "<?php echo $usernamedesc ;?>"; 
    var username = "<?php echo $username ;?>"; 
    var setting = <?php echo $setting;?>;
//   clog("setting : ",setting);
    var memsetting = setting ? JSON.parse(setting) : {};
    var permission_list = memsetting.adminsetting ? memsetting.adminsetting : null;
    var closetimes = memsetting.closetimes ? memsetting.closetimes : [];
    var domain_name = "<?php echo $domain_name ;?>";
//     clog("closetimes : ",closetimes);
    var isadmin = "<?php echo $isadmin;?>";
   
    

    
    
    
</script>