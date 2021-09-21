<?php


// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Asia/Kolkata');

$_website = "https://online.com";

// root url
defined("URL") || define("URL", $_website);

// image 
defined("IMG_URL") || define("IMG_URL", $_website . "/assets/images/");
// image 
defined("AUTH_KEY") || define("AUTH_KEY", "key_here");
