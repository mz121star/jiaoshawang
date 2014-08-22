<?php
return array(
    'DB_PREFIX' => 'dc_',
    'DB_DSN' => 'mysql://root:820819@localhost:3306/jiaosha',

    'SHOW_PAGE_TRACE' => true,
    'DEFAULT_FILTER'=>'htmlspecialchars,stripslashes',

     'APP_SUB_DOMAIN_DEPLOY'=>1, // 开启子域名配置
        /*子域名配置
        *格式如: '子域名'=>array('分组名/[模块名]','var1=a&var2=b');
        */
        'APP_SUB_DOMAIN_RULES'=>array(
            'm'=>array('Mobile/'),  // admin域名指向Admin分组

        ),
);