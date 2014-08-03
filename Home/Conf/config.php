<?php
$common_config = include APP_PATH.'../Conf/config.php'; //公共配置
$private_config = array();//私有配置
return array_merge($common_config, $private_config);
