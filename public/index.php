<?php
session_start();

require("../app/core/init.php");

$url = $_GET['url'] ?? 'home';
$url = strtoLower($url);
$url = explode("/", $url);

$page_name = trim($url[0]);
$filename = "../app/pages/" . $page_name . ".php";

$PAGE = get_pagination_vars();

include("../app/core/webanalytics.php");

if(file_exists($filename)){
    require_once($filename);
}else{
    require_once("../app/pages/404.php");
}
