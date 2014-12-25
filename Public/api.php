<?php
header("content-type:text/html;charset=utf-8");
define('APP_NAME','Api');
define('APP_PATH','../Api/');
define('APP_DEBUG',true);
define('MODE_NAME', 'rest');
require '../ThinkPHP/ThinkPHP.php';