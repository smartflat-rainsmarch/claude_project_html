<?php
/**
 * SmartFlat CMS v3 - Entry Point
 * Redirects to main application or login page
 */

session_cache_expire(1440); // 24 hours
session_start();

// Include constants
require_once('./cmn_var.php');

// Check if user is logged in
$isLoggedIn = isset($_SESSION['key' . DEV_REAL]) && isset($_SESSION['authgroup' . DEV_REAL]);

if ($isLoggedIn) {
    // Redirect to main application
    header('Location: main.php');
    exit;
} else {
    // Redirect to login page
    header('Location: login.php');
    exit;
}
?>
