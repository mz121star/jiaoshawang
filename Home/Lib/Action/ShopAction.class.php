<?php

class ShopAction extends PublicAction {

    public function index(){
        $shopid = $this->_get('shopid');
        //获取店铺菜品
        $food = M("Food");
        $topfoodlist = $food->where('user_id="'.$shopid.'" and food_top="1"')->order(array('id'=>'desc'))->select();
        $this->assign('topfoodlist', $topfoodlist);
        $commonfoodlist = $food->where('user_id="'.$shopid.'" and food_top="0"')->order(array('id'=>'desc'))->select();
        $this->assign('commonfoodlist', $commonfoodlist);
        //获取店铺信息
        $shop = M("Shop");
        $shopinfo = $shop->where('user_id="'.$shopid.'"')->find();
        $foodnumber = count($topfoodlist) + count($commonfoodlist);
        $this->assign('shopinfo', $shopinfo);
        $this->assign('foodnumber', $foodnumber);
        //获取店铺公告
        $shopnotice = M("shopnotice");
        $noticelist = $shopnotice->where('user_id="'.$shopid.'"')->field('id, notice_title')->order(array('notice_date'=>'desc'))->select();
        $this->assign('noticelist', $noticelist);

        $cartlist = array();
        $carttotle = 0;
        $cartprice = 0;
        if (isset($_SESSION['cart']) && count($_SESSION['cart'])) {
            $cartlist = $_SESSION['cart'];
            $carttotle = count($_SESSION['cart']);
            foreach ($_SESSION['cart'] as $cart) {
                $cartprice += $cart['price']*$cart['num'];
            }
        }
        $this->assign('cartlist', $cartlist);
        $this->assign('cartprice', $cartprice);
        $this->assign('carttotle', $carttotle);
        $this->display();
    }
    
    public function fav() {
        $shopid = $this->_get('shopid');
        $userid = $this->userInfo['user_id'];
        if (!$userid) {
            echo '请登录后收藏';exit;
        }
        $peoplefav = M("peoplefav");
        $isfav = $peoplefav->where('user_people="'.$userid.'" and user_shop="'.$shopid.'"')->find();
        if ($isfav) {
            echo '已经收藏过该店';exit;
        }
        $favid = $peoplefav->add(array('user_people'=>$userid, 'user_shop'=>$shopid, 'fav_date'=>date('Y-m-d H:i:s')));
        if ($favid) {
            echo '收藏成功';
        } else {
            echo '收藏失败';
        }
        exit;
    }
    
    public function cancelfav() {
        $shopid = $this->_get('shopid');
        $userid = $this->userInfo['user_id'];
        if (!$userid) {
            echo '请登录后删除收藏';exit;
        }
        $peoplefav = M("peoplefav");
        $favid = $peoplefav->where(array('user_people'=>$userid, 'user_shop'=>$shopid))->delete();
        if ($favid) {
            echo '删除收藏成功';
        } else {
            echo '删除收藏失败';
        }
        exit;
    }
    
    public function lastestsort() {
        $getparam = $this->filterAllParam('get');
        $page = $getparam['page'];
        $iswork = $getparam['iswork'];
        if ($iswork) {
            $morewhere = ' and "'.date('G:i:s').'" between shop_beginworktime and shop_endworktime';
        } else {
            $morewhere = '';
        }
        $shopobj = M("Shop");
        $shoplist = $shopobj->where('shop_top="0"'.$morewhere)->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->page($page.', 10')->select();
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
            if ($userid && $shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $commonshop[] = $shop;
        }
        echo json_encode($commonshop);
        exit;
    }
    
    public function sellsort() {
        $getparam = $this->filterAllParam('get');
        $page = $getparam['page'];
        $iswork = $getparam['iswork'];
        if ($iswork) {
            $morewhere = ' and "'.date('G:i:s').'" between shop_beginworktime and shop_endworktime';
        } else {
            $morewhere = '';
        }
        $shopobj = M("Shop");
        $shoplist = $shopobj->where('shop_top="0"'.$morewhere)->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id')->join(' dc_order ON dc_order.food_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->page($page.', 10')->select();
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
            if ($userid &&$shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $commonshop[] = $shop;
        }
        echo json_encode($commonshop);
        exit;
    }
    
    public function favsort() {
        $getparam = $this->filterAllParam('get');
        $page = $getparam['page'];
        $iswork = $getparam['iswork'];
        if ($iswork) {
            $morewhere = ' and "'.date('G:i:s').'" between shop_beginworktime and shop_endworktime';
        } else {
            $morewhere = '';
        }
        $peoplefavobj = M("peoplefav");
        $shoplist = $peoplefavobj->where('shop_top="0"'.$morewhere)->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->page($page.', 10')->select();
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
            if ($userid &&$shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $commonshop[] = $shop;
        }
        echo json_encode($commonshop);
        exit;
    }

    public function noticelist() {
        
    }

    public function notice() {
        
    }
}