<?php

class ShopAction extends PublicAction {

    public function detail(){
        $shopid = $this->_get('shopid');
        //获取店铺菜品
        $food = M("Food");
        $orderdetail = M("orderdetail");
        $foodlist = $food->where('user_id="'.$shopid.'"')->order(array('id'=>'desc'))->select();
        $foods = array();
        foreach ($foodlist as $value) {
            $value['food_number'] = $orderdetail->where('food_id = "'.$value['id'].'"')->count();
            $foods[] = $value;
        }
        $this->assign('foodlist', $foods);
        //获取店铺信息
        $shop = M("Shop");
        $shoptype = M("shoptype");
        $shopinfo = $shop->where('user_id="'.$shopid.'"')->find();
        $shoptype = $shoptype->where('id="'.$shopinfo['shop_type'].'"')->find();
        $foodnumber = count($topfoodlist) + count($commonfoodlist);
        $this->assign('shopinfo', $shopinfo);
        $this->assign('shoptype', $shoptype);
        $this->assign('foodnumber', $foodnumber);

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