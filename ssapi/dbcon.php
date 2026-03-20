<?php

//    $host = 'ec2-13-125-128-42.ap-northeast-2.compute.amazonaws.com';
    $host = 'localhost';

    $username = 'root'; # MySQL ���� ���̵�
    $password = ''; # MySQL ���� �н�����
    $dbname = 'smartflat_claude_html';  # DATABASE
    

    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    try {

        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    } catch(PDOException $e) {

        die("Failed to connect to the database: " . $e->getMessage()); 
    }


    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//    if(function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) { 
//        function undo_magic_quotes_gpc(&$array) { 
//            foreach($array as &$value) { 
//                if(is_array($value)) { 
//                    undo_magic_quotes_gpc($value); 
//                } 
//                else { 
//                    $value = stripslashes($value); 
//                } 
//            } 
//        } 
// 
//        undo_magic_quotes_gpc($_POST); 
//        undo_magic_quotes_gpc($_GET); 
//        undo_magic_quotes_gpc($_COOKIE); 
//    } 


if ( version_compare(phpversion(), '7.0.0', '>=') ) {
		function undo_magic_quotes_gpc(&$array) { 
            foreach($array as &$value) { 
                if(is_array($value)) { 
                    undo_magic_quotes_gpc($value); 
                } 
                else { 
                    $value = stripslashes($value); 
                } 
            } 
        } 
 
        undo_magic_quotes_gpc($_POST); 
        undo_magic_quotes_gpc($_GET); 
        undo_magic_quotes_gpc($_COOKIE); 
	}
		
	else if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) { 
		function undo_magic_quotes_gpc(&$array) { 
            foreach($array as &$value) { 
                if(is_array($value)) { 
                    undo_magic_quotes_gpc($value); 
                } 
                else { 
                    $value = stripslashes($value); 
                } 
            } 
        } 
 
        undo_magic_quotes_gpc($_POST); 
        undo_magic_quotes_gpc($_GET); 
        undo_magic_quotes_gpc($_COOKIE); 
	}

 
    header('Content-Type: text/html; charset=utf-8'); 
    #session_start();
?>