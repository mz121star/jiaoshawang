<?php

class OrderAction extends PublicAction {

    public function lists(){
        $order = M("Order");
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        if ($usertype == 1) {
            $orderlist = $order->field('id,order_id,food_price')->order(array('order_date'=>'desc'))->select();
        } else {
            $orderlist = $order->where('user_id="'.$userid.'"')->field('id,food_name,food_price')->order(array('order_date'=>'desc'))->select();
        }
        $this->assign('orderlist', $orderlist);
        $this->display();
    }
}