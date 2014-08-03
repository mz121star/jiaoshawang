
CREATE TABLE `dc_user` (
  `id` int(11) NOT NULL auto_increment,
  `userid` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `status`enum('1','0') NOT NULL,
  `type` tinyint(3) unsigned NOT NULL default 3 COMMENT '用户类型，1是后台管理员，2是普通商户，3是普通订餐用户',
  PRIMARY KEY (`id`),
  UNIQUE KEY userid (userid)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户信息表';

INSERT INTO `dc_user` VALUES (1, 'admin','管理员', '21232f297a57a5a743894a0e4a801fc3', '123@qq.com', '订餐网站超级管理员', '', '', '', '1', 1);