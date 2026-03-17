<?php session_cache_expire(14400);session_start();?>
<?php
date_default_timezone_set('Asia/Seoul');
include('./cmn_var.php');
include('./cmn_func.php');

   if(!isset($_SESSION['key'.DEV_REAL])){        
	
        echo "<script>window.location = '".PAGE_ADMIN_LOGIN."'</script>"; //로그아웃상태라면 로그인화면으로 이동한다.
   }else{
	
        echo "<script>window.location = '".PAGE_ADMIN_LOGIN."'</script>"; //로그인상태라면 메인화면으로 이동한다.
       
   }

?>
