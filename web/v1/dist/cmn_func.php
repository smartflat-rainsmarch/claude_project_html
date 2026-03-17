<?php
    function isDevLocalHost(){
        $http_host = $_SERVER['HTTP_HOST'];
        $request_uri = $_SERVER['REQUEST_URI'];
        $url = 'https://' . $http_host . $request_uri;
        $real_pos        = strpos($url, "real");
        $pos        = strpos($url, "dev");
        $pos2        = strpos($url, "localhost");
        $blackgym_pos1        = strpos($url, "blackgym.co.kr");//domain_name
        $blackgym_pos2        = strpos($url, "bodypass.co.kr");//domain_name

   

        //sendtest 개발페이지 로컬페이지는 안보냄



        /////////////////////////////
        //test
        /////////////////////////////
    //    return false; //false : 무조건 보낸다.   true :무조건 보내지 않는다.




        /////////////////////////////
        //real
        /////////////////////////////
        if($pos2) {   //localhost site 
            return true;
        }
        //domain_name
        else if($blackgym_pos1 || $blackgym_pos2){
            //real site
            if($real_pos){ 
                return false;    
            }
            //dev , dev2 site
            else {        
                return true;
            }
        }
        else{
            return true;
        } 

    }
    function getTossKey(){
        //$secretKey = 'test_ak_ZORzdMaqN3wQd5k6ygr5AkYXQGwy';//toss old test
        //$secretKey = 'test_sk_4Gv6LjeKD8awdnBKy9MVwYxAdXy1';//개발연동테스트 test key
        $secretKey_dev = 'test_sk_4Gv6LjeKD8aeg6Mm1Ne8wYxAdXy1';//toss bgtech test
        $secretKey = 'live_sk_oeqRGgYO1r5bNZZW0m18QnN2Eyaz'; //toss live
         if(!isDevLocalHost()){
             return $secretKey;
         }else{
             return $secretKey_dev;
         }

    }

?>