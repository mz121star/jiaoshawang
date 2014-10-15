<?php
$common_config = include APP_PATH.'../Conf/config.php'; //公共配置
$private_config = array(
                           'SESSION_OPTIONS' => array(
                                                    'name' => 'jiaoshawang',
                                                    'expire' => 360000000000
                                                ),
                           'TMPL_ACTION_ERROR' => APP_PATH . 'Tpl/Index/jump.html',
                           'TMPL_ACTION_SUCCESS' => APP_PATH . 'Tpl/Index/jump.html',
                           'URL_ROUTER_ON' => true,
                           'URL_CASE_INSENSITIVE' =>true,
                           'URL_ROUTE_RULES' => array(
                                                    'cart/cart/:shopid' => 'Cart/cart',
                                                    'shop/detail/:shopid' => 'Shop/detail',
                                                    'shopdetail/:shopid/:typeid' => 'Shop/detail',
                                                    'order/detail/:orderid' => 'Shop/orderdetail',
                                                    'order/confirm/:orderid' => 'Shop/orderconfirm',
                                                    'settype/:typeid' => 'Index/settype',
                                                    'setorder/:orderid' => 'Index/setorder',
                                                    'fav/:shopid' => 'Shop/fav',
                                                    'cancelfav/:shopid' => 'Shop/cancelfav',
                                                    'commentlist/:shopid' => 'Comment/lists',
                                                    'goodcomment/:cid' => 'Comment/good',
                                                    'badcomment/:cid' => 'Comment/bad',
                                                    'buygift/:gid' => 'Gift/buygift',
                                                ));//私有配置
return array_merge($common_config, $private_config);
