<?php
return array(
    'DB_PREFIX' => 'dc_',
    'DB_DSN' => 'mysql://root:8ecba89b81@localhost:3306/jiaosha',


    'DEFAULT_FILTER'=>'htmlspecialchars,stripslashes',
      'APP_GROUP_LIST'     => 'Home,Mobile,Admin',
             'DEFAULT_GROUP'      =>'Mobile',
     'APP_SUB_DOMAIN_DEPLOY'=>1, // 开启子域名配置
        /*子域名配置
        *格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b');
        */
        'APP_SUB_DOMAIN_RULES'=>array(
            'm'=>array('Mobile/'),  // admin域名指向Admin分组

        ),
);