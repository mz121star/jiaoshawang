
CREATE TABLE `dc_system` (
  `id` int(11) NOT NULL auto_increment,
  `system_name` varchar(250) NOT NULL,
  `system_title` varchar(250) NOT NULL,
  `system_description` varchar(255) NOT NULL,
  `system_keyword` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统信息表';


CREATE TABLE `dc_user` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` varchar(250) NOT NULL,
  `user_pw` varchar(250) NOT NULL,
  `user_status`enum('1','0') NOT NULL,
  `user_type` tinyint(3) unsigned NOT NULL default 3 COMMENT '用户类型，1是后台管理员，2是普通商户，3是普通订餐用户',
  PRIMARY KEY (`id`),
  UNIQUE KEY user_id (user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户表';

INSERT INTO `dc_user` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 1);


CREATE TABLE `dc_shop` (
  `id` int(11) NOT NULL auto_increment,
  `shop_name` varchar(250) NOT NULL,
  `shop_email` varchar(250) NOT NULL,
  `shop_description` text NOT NULL,
  `shop_beginworktime` time NOT NULL,
  `shop_endworktime` time NOT NULL,
  `shop_deliver_money` tinyint(3) unsigned NOT NULL default 0,
  `shop_deliver_beginmoney` tinyint(3) unsigned NOT NULL default 0,
  `shop_deliver_time` tinyint(3) unsigned NOT NULL default 0,
  `shop_image` varchar(250) NOT NULL,
  `shop_phone` varchar(250) NOT NULL,
  `shop_addr` varchar(250) NOT NULL,
  `shop_top` enum('0','1') NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY user_id (user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商户信息表';


CREATE TABLE `dc_shopnotice` (
  `id` int(11) NOT NULL auto_increment,
  `notice_title` varchar(250) NOT NULL,
  `notice_content` text NOT NULL,
  `notice_date` datetime NOT NULL,
  `notice_top` enum('0','1') NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商户公告表';


CREATE TABLE `dc_people` (
  `id` int(11) NOT NULL auto_increment,
  `people_name` varchar(250) NOT NULL,
  `people_email` varchar(250) NOT NULL,
  `people_phone` varchar(250) NOT NULL,
  `people_addr` varchar(250) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY user_id (user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='普通用户信息表';


CREATE TABLE `dc_peoplefav` (
  `id` int(11) NOT NULL auto_increment,
  `user_people` varchar(250) NOT NULL COMMENT '收藏人，关联dc_user表的user_id',
  `user_shop` varchar(250) NOT NULL COMMENT '被收藏的店铺，关联dc_user表的user_id',
  `fav_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户收藏表';


CREATE TABLE `dc_food` (
  `id` int(11) NOT NULL auto_increment,
  `food_name` varchar(250) NOT NULL,
  `food_price` tinyint(3) unsigned NOT NULL default 0,
  `food_number` tinyint(3) unsigned NOT NULL default 0,
  `food_description` text NOT NULL,
  `food_image` varchar(250) NOT NULL,
  `food_top` enum('0','1') NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜品表';


CREATE TABLE `dc_order` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` varchar(250) NOT NULL,
  `order_people` varchar(250) NOT NULL COMMENT '订购人，关联dc_user表的user_id',
  `food_shop` varchar(250) NOT NULL COMMENT '菜品所属餐厅，关联dc_user表的user_id',
  `order_addr` varchar(250) NOT NULL,
  `order_phone` varchar(250) NOT NULL,
  `order_pay` enum('1','2') NOT NULL COMMENT '支付方式，1是货到付款，2是在线支付',
  `order_paystatus` enum('1','2') NOT NULL COMMENT '支付状态，1是未付款，2是已付款',
  `order_delivery` enum('1','2') NOT NULL COMMENT '发货状态，1是未发货，2是已发货',
  `order_receipt` enum('1','2') NOT NULL COMMENT '收货状态，1是未收货，2是已收货',
  `order_invoice` enum('1','2') NOT NULL COMMENT '是否索取发票，1是不索取，2是索取',
  `order_sendtime` time NOT NULL,
  `order_price` tinyint(3) unsigned NOT NULL COMMENT '订单总金额',
  `order_remark` varchar(250) NOT NULL,
  `order_createdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='订单表';


CREATE TABLE `dc_orderdetail` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` varchar(250) NOT NULL,
  `food_id` int(11) NOT NULL,
  `food_name` varchar(250) NOT NULL,
  `food_price` tinyint(3) unsigned NOT NULL,
  `food_count` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='订单详情表';