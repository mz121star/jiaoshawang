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
}