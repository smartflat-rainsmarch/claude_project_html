<?php
/**
 * SmartFlat CMS v3 - Common Variables
 * Constants and global configuration
 */

// Version
define("CMS_VERSION", "3.0.0");

// Page Constants
define("PAGE_ADMIN_INDEX", "index");
define("PAGE_ADMIN_LOGIN", "./login.php");
define("PAGE_ADMIN_MAIN", "main");
define("PAGE_ADMIN_401", "401.html");
define("PAGE_ADMIN_404", "404.html");
define("PAGE_ADMIN_500", "500.html");

// Path Constants
define("PAGE_HOME_PATH", "../../v3/");
define("PAGE_HOME_INDEX", "./");
define("PAGE_API_PATH", "../../../ssapi/");
define("PAGE_IMAGE_PATH", "../../../ssapi/img/");
define("FILE_UPLOAD_PLACE", "../../../ssapi/adm_get.php");

// Authentication Levels
define("AUTH_OTHER", -1);      // Unknown or blacklisted
define("AUTH_NOMEMBER", 0);    // Non-member
define("AUTH_CUSTOMER", 1);    // Regular customer
define("AUTH_TRANER", 2);      // Trainer
define("AUTH_MANAGER", 3);     // Manager
define("AUTH_OPERATOR", 4);    // Shop owner
define("AUTH_OWNER", 5);       // Owner
define("AUTH_SYSTEMOWNER", 7); // System admin

// Environment Detection
define("DEV_REAL", strpos($_SERVER["REQUEST_URI"] ?? '', "real") ? "_real" : "_dev");

// Timezone
date_default_timezone_set('Asia/Seoul');
?>
<script>
/**
 * SmartFlat CMS v3 - JavaScript Constants
 */

// Version
const CMS_VERSION = "3.0.0";

// Authentication Levels
const AUTH_OTHER = -1;
const AUTH_NOMEMBER = 0;
const AUTH_CUSTOMER = 1;
const AUTH_TRANER = 2;
const AUTH_MANAGER = 3;
const AUTH_OPERATOR = 4;
const AUTH_OWNER = 5;
const AUTH_SYSTEMOWNER = 7;

// Page Constants
const PAGE_ADMIN_INDEX = "index";
const PAGE_ADMIN_LOGIN = "./login.php";
const PAGE_ADMIN_MAIN = "main";
const PAGE_ADMIN_401 = "401.html";
const PAGE_ADMIN_404 = "404.html";
const PAGE_ADMIN_500 = "500.html";

// Path Constants
const PAGE_HOME_PATH = "../../v3/";
const PAGE_HOME_INDEX = "./";
const PAGE_API_PATH = "../../../ssapi/";
const PAGE_IMAGE_PATH = "../../../ssapi/img/";
const FILE_UPLOAD_PLACE = "../../../ssapi/adm_get.php";

// API Type Constants for SmartFlat CMS
const ADM_TYPE = {
    // Home & Dashboard
    GET_HOME_DATA: "gethomedata",
    UPDATE_HOME_DATA: "updatehomedata",

    // Project Management
    GET_PROJECTIDS: "getprojectids",
    INSERT_PROJECTID: "insertprojectid",
    UPDATE_PROJECT: "updateproject",
    DELETE_PROJECT: "deleteproject",

    // Content Management
    GET_MAIN_DATA: "getmaindata",
    UPDATE_MAIN_DATA: "updatemaindata",
    UPDATE_UI_DATA: "updateuidata",
    UPDATE_CONTENT_DATA: "updatecontentdata",
    UPDATE_CONTENT_WEBPAGE_DATA: "updatecontentwebpagedata",
    UPLOAD_CONTENT_DATA: "uploadcontentdata",

    // Device Management
    GET_DEVICE_LIST: "getdevicelist",
    UPDATE_DEVICE: "updatedevice",
    DELETE_DEVICE: "deletedevice",
    CREATE_REMOCONID: "createremoconid",

    // Deployment
    PUSH: "push",
    GET_DEPLOYMENT_HISTORY: "getdeploymenthistory",

    // File Upload
    UPLOAD_FILE: "uploadfile",

    // Monitoring
    GET_MONITORING_DATA: "getmonitoringdata",
    GET_LOG_DATA: "getlogdata",

    // Settings
    GET_SETTING_DATA: "getsettingdata",
    UPDATE_SETTING_DATA: "updatesettingdata"
};

// Color Constants
const mColor = {
    WHITE: "#ffffff",
    PRIMARY: "#009ef7",
    SUCCESS: "#50cd89",
    WARNING: "#ffc700",
    DANGER: "#f1416c",
    INFO: "#7239ea",
    DARK: "#181c32",
    GRAY_100: "#eff2f5",
    GRAY_200: "#e4e6ef",
    GRAY_300: "#b5b5c3",
    GRAY_400: "#a1a5b7",
    GRAY_500: "#7e8299",
    GRAY_600: "#5e6278",
    GRAY_700: "#3f4254",
    GRAY_800: "#2d2d3a",
    GRAY_900: "#1e1e2d"
};

// Global save key (declared in core.js)
</script>
