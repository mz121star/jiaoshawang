
DROP TABLE IF EXISTS `dc_system`;
CREATE TABLE `dc_system` (
  `id` int(11) NOT NULL auto_increment,
  `system_name` varchar(250) NOT NULL,
  `system_title` varchar(250) NOT NULL,
  `system_description` varchar(255) NOT NULL,
  `system_keyword` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统信息表';


DROP TABLE IF EXISTS `dc_systempic`;
CREATE TABLE `dc_systempic` (
  `id` int(11) NOT NULL auto_increment,
  `system_pic` varchar(250) NOT NULL,
  `system_picurl` varchar(250) NOT NULL default '',
  `system_pictitle` varchar(250) NOT NULL default '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='首页广告图片表';


DROP TABLE IF EXISTS `dc_user`;
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


DROP TABLE IF EXISTS `dc_shop`;
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
  `shop_type` int(11) unsigned NOT NULL default 0 COMMENT '类型ID，关联dc_shoptype表的id',
  `shop_lng` float(10,6) NOT NULL,
  `shop_lat` float(10,6) NOT NULL,
  `shop_pay` enum('1','2','3') NOT NULL COMMENT '支持的支付方式，1是两者都支持，2是在线支付，3是货到付款',
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY user_id (user_id),
  INDEX lng_lat (shop_lng,shop_lat)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商户信息表';


DROP TABLE IF EXISTS `dc_shoptype`;
CREATE TABLE `dc_shoptype` (
  `id` int(11) NOT NULL auto_increment,
  `type_name` varchar(250) NOT NULL,
  `parent_id` int(11) unsigned NOT NULL default 0,
  `type_order` int(11) unsigned NOT NULL default 0,
  `type_image` varchar(250),
  `is_top` enum('0','1') NOT NULL COMMENT '分类是否在首页显示，0是不显示，1是显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商户和产品类型表';
INSERT INTO `dc_shoptype` VALUES (1, '饭店', 0, 1, 'food_u', '0');
INSERT INTO `dc_shoptype` VALUES (2, '鲜花店', 0, 7, 'flower', '0');
INSERT INTO `dc_shoptype` VALUES (3, '超市', 0, 2, 'seafood_o', '0');
INSERT INTO `dc_shoptype` VALUES (4, '水果店', 0, 3, 'fruit', '0');
INSERT INTO `dc_shoptype` VALUES (5, '电脑店', 0, 8, 'computer', '0');
INSERT INTO `dc_shoptype` VALUES (6, '成人用品', 0, 10, '', '0');
INSERT INTO `dc_shoptype` VALUES (7, '海鲜店', 0, 5, '', '0');
INSERT INTO `dc_shoptype` VALUES (8, '蔬菜店', 0, 4, '', '0');
INSERT INTO `dc_shoptype` VALUES (9, '蛋糕店', 0, 6, 'snack_u', '0');
INSERT INTO `dc_shoptype` VALUES (10, '药店', 0, 9, '', '0');
INSERT INTO `dc_shoptype` VALUES (11, '熟食', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (12, '米粉', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (13, '盖饭', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (14, '饼', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (15, '热菜', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (16, '凉菜', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (17, '炖菜', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (18, '海鲜', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (19, '麻辣香锅', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (20, '麻辣烫', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (21, '特色', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (22, '水饺', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (23, '披萨', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (24, '面', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (25, '套餐', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (26, '饮料', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (27, '肉类', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (28, '汤', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (29, '饭', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (30, '菜类', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (31, '调料', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (32, '小菜', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (33, '粥', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (34, '包子', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (35, '主食', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (36, '烤肉类', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (37, '青菜类', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (38, '烧烤类', 1, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (39, '鲜花', 2, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (40, '饮料酒水', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (41, '香烟', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (42, '休闲食品', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (43, '调味品', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (44, '冲泡', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (45, '清洁洗涤', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (46, '厨具日杂', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (47, '针织', 3, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (48, '水果', 4, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (49, '电脑配件', 5, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (50, '手机配件', 5, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (51, '成人用品', 6, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (52, '海鲜', 7, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (53, '蔬菜', 8, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (54, '蛋糕', 9, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (55, '中药类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (56, '西药类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (57, '感冒药类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (58, '抗菌消炎药类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (59, '清热解毒类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (60, '止咳平喘类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (61, '胃肠道类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (62, '心脑血管类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (63, '妇科内服类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (64, '妇科外用类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (65, '五官外用类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (66, '消炎镇痛抗炎抗风湿类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (67, '食品', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (68, '非食品类', 10, 0, '', '0');
INSERT INTO `dc_shoptype` VALUES (69, '医疗机械类', 10, 0, '', '0');


DROP TABLE IF EXISTS `dc_shopnotice`;
CREATE TABLE `dc_shopnotice` (
  `id` int(11) NOT NULL auto_increment,
  `notice_title` varchar(250) NOT NULL,
  `notice_content` text NOT NULL,
  `notice_date` datetime NOT NULL,
  `notice_top` enum('0','1') NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商户公告表';


DROP TABLE IF EXISTS `dc_people`;
CREATE TABLE `dc_people` (
  `id` int(11) NOT NULL auto_increment,
  `people_name` varchar(250) NOT NULL,
  `people_email` varchar(250) NOT NULL,
  `people_phone` varchar(250) NOT NULL,
  `people_addr` varchar(250) NOT NULL,
  `people_point` int(11) unsigned NOT NULL default 0,
  `people_invitenum` int(11) unsigned NOT NULL default 0 COMMENT '本人的邀请码',
  `people_invite` int(11) unsigned NOT NULL default 0 COMMENT '邀请人的邀请码',
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY user_id (user_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='普通用户信息表';


DROP TABLE IF EXISTS `dc_peoplefav`;
CREATE TABLE `dc_peoplefav` (
  `id` int(11) NOT NULL auto_increment,
  `user_people` varchar(250) NOT NULL COMMENT '收藏人，关联dc_user表的user_id',
  `user_shop` varchar(250) NOT NULL COMMENT '被收藏的店铺，关联dc_user表的user_id',
  `fav_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户收藏表';


DROP TABLE IF EXISTS `dc_food`;
CREATE TABLE `dc_food` (
  `id` int(11) NOT NULL auto_increment,
  `food_name` varchar(250) NOT NULL,
  `food_price` float(6,2) NOT NULL default 0,
  `food_number` tinyint(3) unsigned NOT NULL default 0,
  `food_description` text NOT NULL,
  `food_image` varchar(250) NOT NULL,
  `food_top` enum('0','1') NOT NULL,
  `food_type` int(11) unsigned NOT NULL default 0 COMMENT '关联dc_shoptype表的id',
  `user_id` varchar(250) NOT NULL,
  `type_id` int(11) unsigned NOT NULL default 0 COMMENT '类型ID，关联dc_foodtype表的id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜品表';


DROP TABLE IF EXISTS `dc_foodtype`;
CREATE TABLE `dc_foodtype` (
  `id` int(11) NOT NULL auto_increment,
  `type_name` varchar(250) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='菜品类型表';


DROP TABLE IF EXISTS `dc_order`;
CREATE TABLE `dc_order` (
  `id` int(11) NOT NULL auto_increment,
  `order_people` varchar(250) NOT NULL COMMENT '订购人，关联dc_user表的user_id',
  `food_shop` varchar(250) NOT NULL COMMENT '菜品所属餐厅，关联dc_user表的user_id',
  `order_addr` varchar(250) NOT NULL,
  `order_phone` varchar(250) NOT NULL,
  `order_peoplename` varchar(250) NOT NULL,
  `order_pay` enum('1','2') NOT NULL COMMENT '支付方式，1是货到付款，2是在线支付',
  `order_paystatus` enum('1','2') NOT NULL COMMENT '支付状态，1是未付款，2是已付款',
  `order_delivery` enum('1','2') NOT NULL COMMENT '发货状态，1是未发货，2是已发货',
  `order_receipt` enum('1','2') NOT NULL COMMENT '收货状态，1是未收货，2是已收货',
  `order_invoice` enum('1','2') NOT NULL COMMENT '是否索取发票，1是不索取，2是索取',
  `order_status` enum('1','2','3','4','5') NOT NULL COMMENT '订单状态，1是正常，2是完结，3是取消，4是申请取消，5是商家接单',
  `order_sendtime` varchar(250) NOT NULL,
  `order_price` float(6, 2) NOT NULL COMMENT '订单总金额',
  `order_remark` varchar(250) NOT NULL,
  `order_createdate` datetime NOT NULL,
  `order_trade_no` varchar(250) NOT NULL COMMENT '支付宝交易号',
  `order_comment_id` int(11) unsigned NOT NULL default 0 COMMENT '订单评论ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='订单表';


DROP TABLE IF EXISTS `dc_orderdetail`;
CREATE TABLE `dc_orderdetail` (
  `id` int(11) NOT NULL auto_increment,
  `order_id` varchar(250) NOT NULL COMMENT '订单ID，关联dc_order表的id',
  `food_id` int(11) NOT NULL,
  `food_name` varchar(250) NOT NULL,
  `food_price` float(6, 2) NOT NULL,
  `food_count` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='订单详情表';


DROP TABLE IF EXISTS `dc_comment`;
CREATE TABLE `dc_comment` (
  `id` int(11) NOT NULL auto_increment,
  `people_id` varchar(250) NOT NULL COMMENT '普通用户ID，关联dc_user表的user_id',
  `shop_id` varchar(250) NOT NULL COMMENT '商户用户ID，关联dc_user表的user_id',
  `comment_content` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_good` int(11) unsigned NOT NULL default 0,
  `comment_bad` int(11) unsigned NOT NULL default 0,
  `comment_star` int(11) unsigned NOT NULL default 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户评论表';


DROP TABLE IF EXISTS `dc_gift`;
CREATE TABLE `dc_gift` (
  `id` int(11) NOT NULL auto_increment,
  `gift_name` varchar(250) NOT NULL COMMENT '礼品名称',
  `gift_desc` text NOT NULL COMMENT '礼品描述',
  `gift_image` varchar(250) NOT NULL COMMENT '礼品图片',
  `gift_number` int(11) unsigned NOT NULL COMMENT '礼品积分',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='礼品表';


DROP TABLE IF EXISTS `dc_giftexchange`;
CREATE TABLE `dc_giftexchange` (
  `id` int(11) NOT NULL auto_increment,
  `gift_id` int(11) unsigned NOT NULL COMMENT '礼品ID，对应gift表的ID字段',
  `people_id` varchar(250) NOT NULL COMMENT '普通用户ID，关联dc_user表的user_id',
  `gift_name` varchar(250) NOT NULL COMMENT '礼品名称',
  `gift_image` varchar(250) NOT NULL COMMENT '礼品图片',
  `exchange_number` int(11) unsigned NOT NULL COMMENT '兑换花费的积分',
  `exchange_name` varchar(250) NOT NULL COMMENT '礼品收货人姓名',
  `exchange_addr` varchar(250) NOT NULL COMMENT '礼品收货地址',
  `exchange_phone` varchar(250) NOT NULL COMMENT '礼品收货人电话',
  `exchange_date` datetime NOT NULL COMMENT '礼品兑换时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='礼品兑换表';


DROP TABLE IF EXISTS `dc_talk`;
CREATE TABLE `dc_talk` (
  `id` int(11) NOT NULL auto_increment,
  `talkuser_id` varchar(250) NOT NULL COMMENT '留言者用户ID，关联dc_user表的user_id',
  `talkuser_name` varchar(250) NOT NULL COMMENT '留言者姓名',
  `talkuser_phone` varchar(250) NOT NULL COMMENT '留言者电话',
  `talkuser_content` text NOT NULL COMMENT '留言内容',
  `talk_date` datetime NOT NULL COMMENT '留言时间',
  `talk_status` enum('1','2') NOT NULL COMMENT '留言状态，1是未采纳，2是已采纳',
  `talk_gift` enum('1','2') NOT NULL COMMENT '是否有奖品，1是没有，2是有',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='有奖留言表';


DROP TABLE IF EXISTS `dc_advert`;
CREATE TABLE `dc_advert` (
  `id` int(11) NOT NULL auto_increment,
  `advert_title` varchar(250) NOT NULL COMMENT '广告标题',
  `advert_image` varchar(250) NOT NULL COMMENT '广告图片',
  `advert_desc` varchar(250) NOT NULL COMMENT '广告说明',
  `advert_content` text NOT NULL COMMENT '广告内容',
  `advert_addtime` datetime NOT NULL COMMENT '添加时间',
  `advert_status` enum('1','0') NOT NULL COMMENT '广告状态，1是启用，0是停用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告表';


DROP TABLE IF EXISTS `dc_smscode`;
CREATE TABLE `dc_smscode` (
  `id` int(11) NOT NULL auto_increment,
  `sms_phone` varchar(20) NOT NULL COMMENT '手机号',
  `sms_code` varchar(20) NOT NULL COMMENT '手机验证码',
  `sms_expire` tinyint(4) unsigned NOT NULL COMMENT '过期时间，分钟单位',
  `sms_adddate` datetime NOT NULL COMMENT '验证码添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='手机验证码表';
