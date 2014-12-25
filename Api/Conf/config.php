<?php
$common_config = include APP_PATH.'../Conf/config.php'; //公共配置
$private_config = array(
                           'SESSION_OPTIONS' => array(
                                                    'name' => 'jiaoshaapi',
                                                    'expire' => 360000000000
                                                ),
                           'URL_ROUTER_ON' => true,
                           'URL_CASE_INSENSITIVE' =>true,
                           'URL_ROUTE_RULES' => array(
                                                    
                                                ));//私有配置
return array_merge($common_config, $private_config);
