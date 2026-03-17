<?php session_cache_expire(14400);session_start();?>
<?php
//if(!isset($_SERVER["HTTPS"])) {header('Location: https://'.$_SERVER["HTTP_HOST"].$_SERVER['REQUEST_URI']);}

date_default_timezone_set('Asia/Seoul');
 include('./cmn_var.php');
 include('./cmn_func.php');
//$message = json_decode($_POST['message'],true);  //POST로 받은 값을 json형식으로 decode


//test
//echo "main session : ".$_SESSION['key'];
//echo "  main authgroup : ".$_SESSION['authgroup'];
//echo "  userinfo  groupcode : ".$userinfo['groupcode'];
//echo " <br> userinfo centercodes : ".$userinfo['centercodes'];



//echo "<br><br><br><br><br>https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]$_SERVER[QUERY_STRING]";
//echo "<br> HTTP_HOST : $_SERVER[HTTP_HOST]";
//echo "<br> REQUEST_URI : $_SERVER[REQUEST_URI]";
//echo "<br> QUERY_STRING : $_SERVER[QUERY_STRING]";

function checkSession(){
    
    if(!isset($_SESSION['key'.DEV_REAL]) || !isset($_SESSION['authgroup'.DEV_REAL])) 
    {
        echo "<script>alert('오랫동안 입력하지 않아 로그아웃되었습니다... 다시로그인하여 주세요');</script>";
        echo "<meta http-equiv='refresh' content='0;url=login.php'>";
        exit;
    }
}

if(!isset($_SESSION['key'.DEV_REAL]) || !isset($_SESSION['authgroup'.DEV_REAL])) {
    echo "<script>alert('오랫동안 입력하지 않아 로그아웃되었습니다. 다시로그인하여 주세요');</script>";
	echo "<meta http-equiv='refresh' content='0;url=login.php'>";
	exit;
}
if(isset($_SESSION['authgroup'.DEV_REAL]) && $_SESSION['authgroup'.DEV_REAL] < AUTH_TRANER){
    echo "<script>alert('접근할 수 있는 권한이 부여되지 않았습니다.');</script>";
    echo "<meta http-equiv='refresh' content='0;url=../../v2/index.html'>";
	exit;
}


$session = $_SESSION['key'.DEV_REAL];
$userinfo = $_SESSION['data'.DEV_REAL]["userinfo"];


//echo "<br><br><br><br><br><br><br>userinfo ".json_encode($userinfo,JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE). "<br>";
$uid = $userinfo["uid"];
$id = $userinfo["id"];
$email = $userinfo["email"];

//echo "id : ".$id;
$auth = $_SESSION['authgroup'.DEV_REAL];

$auth_num = $userinfo['auth'];
$usernamedesc = $userinfo['name'];
$mygroupcode = $userinfo['groupcode'];
$mygroupname = $userinfo['groupname'];
$mycentercodes = $userinfo['centercodes'];
$projectids = $userinfo['projectids'];
$groupidx = $userinfo['groupidx'];

$setting = isset($userinfo['setting']) ? json_encode($userinfo['setting']) : '"{}"';


//$isnew_request_centercodes = $isnew["request_centercodes"];
//$isnew_ot_centercodes = $isnew["ot_centercodes"];
//
//$isnewrmpt_request_centercodes = $isnewrmpt["request_centercodes"];
//$isnewrmpt_ot_centercodes = $isnewrmpt["ot_centercodes"];

$domain_name = $_SERVER['SERVER_NAME'];
//트레이너이라면
if($_SESSION['authgroup'.DEV_REAL] == AUTH_TRANER && $setting == "" ||  $_SESSION['authgroup'.DEV_REAL] == AUTH_TRANER && $setting == "null"){
    echo "<meta http-equiv='refresh' content='0;url=../../v2/index.html'>";
	exit;
}
?>
<script>
   console.log("common call ");
   var global_uid = "<?php echo $uid ;?>"; //auth_group
   var global_id = "<?php echo $id ;?>"; //auth_group
   var global_email = "<?php echo $email ;?>"; //auth_group
   var auth = "<?php echo $auth;?>"; //auth_group

   var auth_num = "<?php echo $auth_num ;?>"; //auth_group
    
   var usernamedesc = "<?php echo $usernamedesc ;?>";
   var session_groupcode =  "<?php echo $mygroupcode;?>";
   var session_groupname =  "<?php echo $mygroupname;?>";
   var session_centercodes =  "<?php echo $mycentercodes ;?>";
   var session_projectids = "<?php echo $projectids;?>";
   var session_groupidx = "<?php echo $groupidx;?>";
   
//   var arr_projectids = session_projectids && typeof session_projectids === "string" ?  session_projectids.split(",") : [];
//   var arr_projectids = [];    
               

//  console.log("session_groupcode "+session_groupcode+" session_groupname "+session_groupname);
    var domain_name = "<?php echo $domain_name ;?>";
    
   var setting = <?php echo $setting;?>;
//    console.log("setting is ",setting);
   var memsetting = setting ? JSON.parse(setting) : {};
//   console.log("memsetting ",memsetting);
   var permission_list = memsetting.adminsetting ? memsetting.adminsetting : null;
   var closetimes = setting.closetimes ? memsetting.closetimes : [];
   

   var ison = false;       
   function isSession(){

       <?php 
           checkSession();
       ?>        
       
     
   }
   
</script>