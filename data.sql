-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2014 年 08 月 14 日 17:16
-- 服务器版本: 5.6.15-log
-- PHP 版本: 5.5.7

--
-- 转存表中的数据 `dc_food`
--

INSERT INTO `dc_food` (`id`, `food_name`, `food_price`, `food_number`, `food_description`, `food_image`, `food_top`, `user_id`) VALUES
(1, '砂锅丸子', 12, 0, '砂锅丸子', '53e84e808b5f1.jpeg', '1', 'miao'),
(2, '金针菇烤肉拌饭(小)', 10, 0, '金针菇烤肉拌饭(小)', '', '', 'miao'),
(3, '鲅鱼水饺', 15, 0, '鲅鱼水饺', '53ec20abf0fab.jpg', '1', 'test1'),
(4, '三鲜水饺', 18, 0, '三鲜水饺', '53ec20c8c77e1.jpg', '1', 'test1'),
(5, '猪肉水饺', 15, 0, '猪肉水饺', '53ec20eedeaed.jpg', '1', 'test1'),
(6, '芹菜水饺', 10, 0, '芹菜水饺', '53ec21092f44a.jpg', '0', 'test1'),
(7, '清蒸黄花鱼', 25, 0, '清蒸黄花鱼', '53ec216bd35e3.jpg', '1', 'test2'),
(8, '熏鲅鱼', 60, 0, '熏鲅鱼', '53ec218c289c1.jpg', '1', 'test2'),
(9, '河鱼乱炖', 25, 0, '河鱼乱炖', '53ec21b43c632.jpg', '1', 'test2'),
(10, '螃蟹', 100, 0, '螃蟹', '53ec2279b4cea.jpg', '1', 'test3'),
(11, '盐焗大虾', 60, 0, '盐焗大虾', '53ec2298674a7.jpg', '1', 'test3'),
(12, '烤大虾', 10, 0, '烤大虾', '53ec22cf46edd.jpg', '1', 'test4'),
(13, '烤羊肉串', 2, 0, '烤羊肉串', '53ec22e645fff.jpg', '1', 'test4'),
(14, '鱼香肉丝', 11, 0, '鱼香肉丝', '53ec230b7edfb.jpg', '1', 'test5'),
(15, '宫保鸡丁', 20, 0, '宫保鸡丁', '53ec233f08cdf.jpg', '1', 'test6'),
(16, '糖醋排骨', 22, 0, '糖醋排骨', '53ec2353a130d.jpg', '1', 'test6'),
(17, '清蒸排骨', 60, 0, '清蒸排骨', '53ec253537e00.jpg', '1', 'test7'),
(18, '猪肉水饺', 11, 0, '清蒸排骨', '53ec253f14cf2.jpg', '1', 'test7'),
(19, '猪肉水饺', 10, 0, '猪肉水饺', '53ec257737907.jpg', '1', 'test8'),
(20, '鱼香肉丝', 22, 0, '猪肉水饺', '53ec2582ed48f.jpg', '1', 'test8'),
(21, '宫保鸡丁', 15, 0, '宫保鸡丁', '53ec2591aeadf.jpg', '1', 'test8'),
(22, '芹菜水饺', 15, 0, '芹菜水饺', '53ec25b649456.jpg', '1', 'test9'),
(23, '蒜蓉白肉', 22, 0, '蒜蓉白肉', '53ec25c3b082e.jpg', '1', 'test9'),
(24, '河鱼乱炖', 33, 0, '河鱼乱炖', '53ec25de98768.jpg', '1', 'test11');

--
-- 转存表中的数据 `dc_people`
--

INSERT INTO `dc_people` (`id`, `people_name`, `people_email`, `people_phone`, `people_addr`, `user_id`) VALUES
(1, '苗', '395802201@qq.com', '13888456782', '大连市高新园区', 'mz121');

--
-- 转存表中的数据 `dc_shop`
--

INSERT INTO `dc_shop` (`id`, `shop_name`, `shop_email`, `shop_description`, `shop_beginworktime`, `shop_endworktime`, `shop_deliver_money`, `shop_deliver_beginmoney`, `shop_deliver_time`, `shop_image`, `shop_phone`, `shop_addr`, `shop_top`, `user_id`) VALUES
(1, '李记砂锅鱼', '395802201@qq.com', '李记砂锅鱼', '08:00:00', '20:00:00', 4, 30, 8, '53e84e1e1b494.jpeg', '13840816169', '大连市沙河口区兴工街福佳新天地地下1层', '1', 'miao'),
(2, '船歌鱼水饺', '', '船歌鱼水饺(唐山街店)', '08:00:00', '20:00:00', 0, 20, 8, '53ead7dea2fc0.jpg', '0411-83702086', '西岗区 唐山街28号', '0', 'test1'),
(3, '品海楼', '', '品海楼(二七店)', '08:00:00', '20:00:00', 0, 30, 8, '53eadb32ccb00.jpg', '0411-82719688', '中山区 北斗街46号二七广场内(近鲁迅路)', '0', 'test2'),
(4, '万宝海鲜舫', '', '万宝海鲜舫', '08:00:00', '20:00:00', 0, 100, 8, '53eadbbb7d6d3.jpg', '0411-39912888', '中山区 解放路108号(劳动公园东门对面)', '0', 'test3'),
(5, '和茂隆海鲜大排档', '', '和茂隆海鲜大排档', '08:00:00', '20:00:00', 0, 20, 8, '53eadc161902c.jpg', '0411-86312288', '中山区 渔人码头滨海东路58-9-5号(石槽)', '0', 'test4'),
(6, '东海明珠美食城', '', '东海明珠美食城', '08:00:00', '20:00:00', 0, 22, 8, '53eadc4b9dfcf.jpg', '0411-82563366', '中山区 文林街1号', '0', 'test5'),
(7, '新东方渔人码头', '', '新东方渔人码头(港湾广场店)', '08:00:00', '20:00:00', 10, 0, 8, '53eadcfe22f9e.jpg', '0411-82706999', '中山区 港湾桥港湾广场3号', '0', 'test6'),
(8, '付家庄小渔村', '', '付家庄小渔村(五四广场店)', '00:00:00', '00:00:00', 0, 22, 10, '53eadcce7c8a9.jpg', '0411-86793666', '沙河口区 民权街298号(近富鸿国际大厦)', '0', 'test7'),
(9, '牟传仁大连老菜馆', '', '牟传仁大连老菜馆(星海店) ', '08:00:00', '20:00:00', 0, 20, 0, '53eadca26a0bc.jpg', '0411-84805998', '沙河口区 滨海西路583号星海新天地内', '0', 'test8'),
(10, '旅大印象餐厅', '', '旅大印象餐厅(华南沃特店)', '08:00:00', '20:00:00', 20, 0, 8, '53eadd5f464d7.jpg', '0411-39537888', '甘井子区 中华西路22号华南沃特购物广场4楼(近华南广场)', '1', 'test9'),
(11, '品海楼', '', '品海楼(老虎滩店)', '08:00:00', '20:00:00', 10, 0, 20, '53eadd9ab3048.jpg', '0411-82739088 ', '中山区 滨海东路72号(近老虎滩渔人码头)', '1', 'test11');

--
-- 转存表中的数据 `dc_user`
--

INSERT INTO `dc_user` (`id`, `user_id`, `user_pw`, `user_status`, `user_type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '1', 1),
(2, 'miao', '1058a42a81e5252c76cb308bcd6a0214', '1', 2),
(3, 'test1', '5a105e8b9d40e1329780d62ea2265d8a', '1', 2),
(4, 'test2', 'ad0234829205b9033196ba818f7a872b', '1', 2),
(5, 'test3', '8ad8757baa8564dc136c1e07507f4a98', '1', 2),
(6, 'test4', '86985e105f79b95d6bc918fb45ec7727', '1', 2),
(7, 'test5', 'e3d704f3542b44a621ebed70dc0efe13', '1', 2),
(8, 'test6', '4cfad7076129962ee70c36839a1e3e15', '1', 2),
(9, 'test7', 'b04083e53e242626595e2b8ea327e525', '1', 2),
(10, 'test8', '5e40d09fa0529781afd1254a42913847', '1', 2),
(11, 'test9', '739969b53246b2c727850dbb3490ede6', '1', 2),
(12, 'test11', 'f696282aa4cd4f614aa995190cf442fe', '1', 2),
(13, 'mz121', '1f1626e3566666df40211216b63f431d', '1', 3);