<?php
//公共配置
$common_config = include APP_PATH.'../Conf/config.php';

//私有配置
$private_config = array(
                        'LAYOUT_ON' => true,
                        'URL_ROUTER_ON' => true,
                        'URL_CASE_INSENSITIVE' =>true,
                        'URL_ROUTE_RULES' => array(
                                                  'modgift/:gid' => 'Gift/modgift',
                                                  'delgift/:gid' => 'Gift/delgift',
                                                  'modshop/:userid' => 'User/modshop',
                                                  'delshop/:userid' => 'User/delshop',
                                                  'topshop/:userid' => 'User/topshop',
                                                  'topcancel/:userid' => 'User/topcancel',
                                                  'modpeople/:userid' => 'User/modpeople',
                                                  'delpeople/:userid' => 'User/delpeople',
                                                  'upstatus/:userid/:status' => 'User/upstatus',
                                                  'modpw/:userid/:from' => 'User/modpw',
                                                  'modfood/:foodid' => 'Food/modfood',
                                                  'delfood/:foodid' => 'Food/delfood',
                                                  'modtype/:typeid' => 'Food/modtype',
                                                  'deltype/:typeid' => 'Food/deltype',
                                                  'delnav/:navid' => 'System/delnav',
                                                  'modnotice/:noticeid' => 'Notice/modnotice',
                                                  'delnotice/:noticeid' => 'Notice/delnotice',
                                                  'detailorder/:orderid' => 'Order/detailorder',
                                                  'refundorder/:orderid' => 'Order/refundorder',
                                                  'refuseorder/:orderid' => 'Order/refuseorder',

                                                  'confirmorder/:orderid' => 'Order/confirmorder',
                                                  'cancelorder/:orderid' => 'Order/cancelorder',
                                                  'acceptorder/:orderid' => 'Order/acceptorder',

                                                  'delshoptype/:typeid' => 'User/shoptype',
                                                  'showtalk/:tid' => 'Gift/showtalk',
                                                  'deladvert/:aid' => 'Advert/deladvert',
                                                  'startadvert/:aid' => 'Advert/startadvert',
                                                  'stopadvert/:aid' => 'Advert/stopadvert',
                                                  'modadvert/:aid' => 'Advert/modadvert',
                                                  ),
                        'SHOP_ROLE' => array(
                                            'Food'=>array('lists', 'showadd', 'save', 'modfood', 'delfood', 'typelist', 'addtype', 'modtype', 'deltype', 'typesave'),
                                            'Notice'=>array('lists', 'showadd', 'save', 'modnotice', 'delnotice'),
                                            'Order'=>array('lists', 'cancelorder', 'detailorder','refundorder', 'acceptorder'),
                                            'User'=>array('modself', 'upself')
                                            )
                        );

return array_merge($common_config, $private_config);
