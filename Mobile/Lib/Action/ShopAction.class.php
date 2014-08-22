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
    
    public function orders() {
        $userid = $this->userInfo['user_id'];
        $orderobj = M("order");
        $orderdetailobj = M("orderdetail");
        $shopobj = M("shop");
        import('ORG.Util.Page');
        $count = $orderobj->where('order_people="'.$userid.'"')->count();
        $page = new Page($count, 1000);
        $orderlist = $orderobj->where('order_people="'.$userid.'"')->limit($page->firstRow.','.$page->listRows)->order(array('order_createdate'=>'desc'))->select();
        foreach ($orderlist as $key => $order) {
            $detaillist = $orderdetailobj->where('order_id="'.$order['id'].'"')->select();
            $orderlist[$key]['orderdetail'] = $detaillist;
            
            $shopinfo = $shopobj->where('user_id="'.$order['food_shop'].'"')->field('shop_name, shop_deliver_money, shop_image')->find();
            $orderlist[$key]['shop_deliver_money'] = $shopinfo['shop_deliver_money'];
            $orderlist[$key]['shop_name'] = $shopinfo['shop_name'];
            $orderlist[$key]['shop_image'] = $shopinfo['shop_image'];
        }
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('orderlist', $orderlist);
        $this->display();
    }
    
    public function orderdetail() {
        $userid = $this->userInfo['user_id'];
        $orderid = $this->_get('orderid');
        $orderobj = M("order");
        $orderdetailobj = M("orderdetail");

        $orderinfo = $orderobj->where('id="'.$orderid.'"')->find();
        $detaillist = $orderdetailobj->where('order_id="'.$orderid.'"')->select();
        
        $this->assign('orderinfo', $orderinfo);
        $this->assign('detaillist', $detaillist);
        $this->assign('totalfood', count($detaillist));
        $this->display();
    }
}