<?php
//公共配置
$common_config = include APP_PATH.'../Conf/config.php';

//私有配置
$private_config = array(
                        'LAYOUT_ON' => true,
                        'URL_ROUTER_ON' => true,
                        'URL_CASE_INSENSITIVE' =>true,
                        'URL_ROUTE_RULES' => array(
                                                  'modshop/:userid' => 'User/modshop',
                                                  'delshop/:userid' => 'User/delshop',
                                                  'modpeople/:userid' => 'User/modpeople',
                                                  'delpeople/:userid' => 'User/delpeople',
                                                  'upstatus/:userid/:status' => 'User/upstatus',
                                                  'modfood/:foodid' => 'Food/modfood',
                                                  'delfood/:foodid' => 'Food/delfood',
                                                  ),
                        'SHOP_ROLE' => array(
                                            'Food'=>array('lists', 'showadd', 'save', 'modfood', 'delfood'),
                                            'Order'=>array('lists'),
                                            'User'=>array('modself', 'upself')
                                            )
                        );

return array_merge($common_config, $private_config);
