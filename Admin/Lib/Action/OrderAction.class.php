<?php

class OrderAction extends PublicAction {

    public function lists(){
        $order = M("Order");
        $shop = M("shop");
        $people = M("people");
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
         import('ORG.Util.Page');
        if ($usertype == 1) {
            $count = $order->count();
            $page = new Page($count, 10);
            $orderlist = $order->field('dc_order.id,shop_name as name,order_price,order_status,order_createdate')->join(' dc_shop ON dc_shop.user_id = dc_order.food_shop')->limit($page->firstRow.','.$page->listRows)->order(array('order_createdate'=>'desc'))->select();
        } else {
            $count = $order->where('food_shop="'.$userid.'"')->count();
            $page = new Page($count, 10);
            $orderlist = $order->where('food_shop="'.$userid.'"')->field('dc_order.id,people_name as name,food_shop,order_price,order_status,order_createdate')->join(' dc_people ON dc_people.user_id = dc_order.order_people')->limit($page->firstRow.','.$page->listRows)->order(array('order_createdate'=>'desc'))->select();
        }
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('orderlist', $orderlist);
        $this->display();
    }
    
    public function cancelorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        $get = $this->filterAllParam('get');
        if ($get['orderid']) {
            $order = M("Order");
            if ($usertype == 1) {
                $order->where('id= '.$get['orderid'])->setField('order_status', '3');
            } else {
                $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->setField('order_status', '3');
            }
            $this->redirect('Order/lists');
        } else {
            $this->error("未知订单ID", 'lists');
        }
    }
    
    public function detailorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        $get = $this->filterAllParam('get');
    }
}