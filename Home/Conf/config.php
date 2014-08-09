<?php
$common_config = include APP_PATH.'../Conf/config.php'; //公共配置
$private_config = array(
                           'URL_ROUTER_ON' => true,
                           'URL_CASE_INSENSITIVE' =>true,
                           'URL_ROUTE_RULES' => array(
                                                    'shop/detail/:shopid' => 'Shop/index',
                                                    'notice/:noticeid' => 'Shop/notice',
                                                    'notice/list' => 'Shop/noticelist',
                                                ));//私有配置
return array_merge($common_config, $private_config);
