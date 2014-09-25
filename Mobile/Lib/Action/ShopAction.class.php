<?php

class ShopAction extends PublicAction {

    public function detail(){
        $shopid = $this->_get('shopid');
        $typeid = $this->_get('typeid');
        //获取店铺菜品
        $food = M("Food");
        $orderdetail = M("orderdetail");
        if ($typeid) {
            $foodlist = $food->where('user_id="'.$shopid.'" and food_type = '.$typeid)->order(array('id'=>'desc'))->select();
        } else {
            $foodlist = $food->where('user_id="'.$shopid.'"')->order(array('id'=>'desc'))->select();
        }
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
        $this->assign('shopid',$shopid);
        $this->assign('typeid',$typeid);

        $shoptype = M("Shoptype");
        $typelist = $shoptype->where('parent_id = '.$shopinfo['shop_type'])->order(array('id'=>'desc'))->select();
        $this->assign('typelist', $typelist);
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
            
            $shopinfo = $shopobj->where('user_id="'.$order['food_shop'].'"')->field('shop_name, shop_phone, shop_deliver_money, shop_image')->find();
            $orderlist[$key]['shop_deliver_money'] = $shopinfo['shop_deliver_money'];
            $orderlist[$key]['shop_name'] = $shopinfo['shop_name'];
            $orderlist[$key]['shop_phone'] = $shopinfo['shop_phone'];
            $orderlist[$key]['shop_image'] = $shopinfo['shop_image'];
        }
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('orderlist', $orderlist);
        $this->assign('shopid',$userid);
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

    public function orderconfirm() {
        $userid = $this->userInfo['user_id'];
        $orderid = $this->_get('orderid');
        if (!$userid) {
            $this->error('请先登录');
        }
        $orderobj = M("order");
        $orderinfo = $orderobj->where('id="'.$orderid.'" and order_people = "'.$userid.'"')->find();
        if (!$orderinfo) {
            $this->error('没有可选订单');
        }

        $isok = $orderobj->where('id="'.$orderid.'"')->setField('order_status', '2');
        if ($isok) {
            $people = M("People");
            $peopleinfo = $people->field('people_point')->where('user_id="'.$userid.'"')->find();
            if ($peopleinfo) {
                $newpoint = $peopleinfo['people_point'] + intval($orderinfo['order_price']);
                $isok = $people->where('user_id="'.$userid.'"')->setField('people_point', $newpoint);
                if ($isok) {
                    $this->userInfo['people_point'] = $newpoint;
                    session('userinfo', $this->userInfo);
                }
            }
            $this->redirect('shop/orders');
        } else {
            $this->error('确定收货失败', 'shop/orders');
        }
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
            $this->redirect('shop/myfav');
        } else {
            $this->error('删除收藏失败', 'myfav');
        }
    }
    
    public function myfav() {
        $userid = $this->userInfo['user_id'];
        $peoplefav = M("peoplefav");
        $favlist = $peoplefav->where('user_people="'.$userid.'"')->field('shop_name, dc_shop.user_id')->join(' dc_shop on dc_shop.user_id = dc_peoplefav.user_shop')->select();
        $this->assign('favlist', $favlist);
        $this->display();
    }
}