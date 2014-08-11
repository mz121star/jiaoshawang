<?php

class IndexAction extends PublicAction {
    public function reg(){
      $this->display();
    }
    public function index() {
        $userid = $this->userInfo['user_id'];

        $shopobj = M("Shop");
        $shoplist = $shopobj->where('shop_top="1"')->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->limit('0,5')->select();
        $topshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            if ($shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $topshop[] = $shop;
        }
        $this->assign('topshop', $topshop);

        import('ORG.Util.Page');
        $count = $shopobj->count();
        $page = new Page($count, 10);
        $shoplist = $shopobj->where('shop_top="0"')->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        $commonshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            if ($shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $commonshop[] = $shop;
        }
        $this->assign('commonshop', $commonshop);
        $this->display();
    }
}
