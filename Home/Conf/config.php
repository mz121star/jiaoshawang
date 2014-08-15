<?php
$common_config = include APP_PATH.'../Conf/config.php'; //公共配置
$private_config = array(
                           'URL_ROUTER_ON' => true,
                           'URL_CASE_INSENSITIVE' =>true,
                           'URL_ROUTE_RULES' => array(
                                                      'shop/detail/:shopid' => 'Shop/index',
                                                      'shop/fav/:shopid' => 'Shop/fav',
                                                      'shop/cancelfav/:shopid' => 'Shop/cancelfav',
                                                      'shop/lastestsort/:page/:iswork' => 'Shop/lastestsort',
                                                      'shop/sellsort/:page/:iswork' => 'Shop/sellsort',
                                                      'shop/favsort/:page/:iswork' => 'Shop/favsort',
                                                      'user/cancelorder/:id' => 'User/cancelorder',
                                                      'notice/:noticeid' => 'Shop/notice',
                                                      'notice/list' => 'Shop/noticelist',
                                                      ));//私有配置
return array_merge($common_config, $private_config);
