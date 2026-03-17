<?php 
function sessionTimeCheck(){ 
    
     echo "console.log('sessionTimeCheck!!');";
    /////////////////////////////////////////
    //Check Mobile   isMobileDevice
    /////////////////////////////////////////
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
    $sessionlog = isset($_SESSION['key'.DEV_REAL]);
//    echo "console.log('sessiong log is ".$sessionlog."');";
    
    if(!isset($_SESSION['key'.DEV_REAL]) || !isset($_SESSION['authgroup'.DEV_REAL])) 
    {
       $page =  "beforepage=".basename($_SERVER['PHP_SELF']); 
        if($chkMobile){
             echo $devicename == "iPhone" || $devicename == "iPod" ? "call_app();" : "call_app();" ;
        }else {
           
        }
//        exit;
    }
    
} 

//function sessionTimeCheckOutTest(){ 
//    
//     echo "console.log('sessionTimeCheckOutTest!!');";
//    /////////////////////////////////////////
//    //Check Mobile   isMobileDevice
//    /////////////////////////////////////////
//    $mAgent = array("iPhone","iPod","Android","Blackberry", 
//        "Opera Mini", "Windows ce", "Nokia", "sony" );
//    $chkMobile = false;
//    $devicename = "";
//    for($i=0; $i<sizeof($mAgent); $i++){
//        if(stripos( $_SERVER['HTTP_USER_AGENT'], $mAgent[$i] )){
//            $chkMobile = true;
//            $devicename = $mAgent[$i];
//            break;
//        }
//    }
//    /////////////////////////////////////////
//    $sessionlog = isset($_SESSION['key'.DEV_REAL]);
//    echo "console.log('sessiong log is ".$sessionlog."');";
//    
////    if(!isset($_SESSION['key'.DEV_REAL]) || !isset($_SESSION['authgroup'.DEV_REAL])) 
////    if($cnt > 9)
//    {
//       $page =  "beforepage=".basename($_SERVER['PHP_SELF']); 
////        echo "<script>console.log('sssss');</script>";
//    //    echo "<script>alertMsg('오랫동안 입력하지 않아 로그아웃되었습니다. 다시로그인하여 주세요');</script>";
//    //    echo "<script>alert('오랫동안 입력하지 않아 로그아웃되었습니다. 다시로그인하여 주세요');</script>";
//        if($chkMobile){
//             echo $devicename == "iPhone" || $devicename == "iPod" ? "call_app();" : "call_app();" ;
//        }else {
//            
//        }
////        exit;
//    }
//    
//} 

?>