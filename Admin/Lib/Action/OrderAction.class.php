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
            $orderlist = $order->field('dc_order.id,shop_name as name,order_price,order_status,order_createdate,order_paystatus,order_receipt')->join(' dc_shop ON dc_shop.user_id = dc_order.food_shop')->limit($page->firstRow.','.$page->listRows)->order(array('order_createdate'=>'desc'))->select();
        } else {
            $count = $order->where('food_shop="'.$userid.'"')->count();
            $page = new Page($count, 10);
            $orderlist = $order->where('food_shop="'.$userid.'"')->field('dc_order.id,people_name as name,food_shop,order_price,order_status,order_createdate,order_paystatus,order_receipt')->join(' dc_people ON dc_people.user_id = dc_order.order_people')->limit($page->firstRow.','.$page->listRows)->order(array('order_createdate'=>'desc'))->select();
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
            $orderinfo =  $order->where('id= '.$get['orderid'])->find();
            $order_status = 3;
            if ($orderinfo['order_paystatus'] == '2') {
                $order_status = 4;
            }
            if ($usertype == 1) {
                $order->where('id= '.$get['orderid'])->setField('order_status', $order_status);
            } else {
                $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->setField('order_status', $order_status);
            }
            $this->redirect('Order/lists');
        } else {
            $this->error("未知订单ID", 'lists');
        }
    }

    public function confirmorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        $get = $this->filterAllParam('get');
        if ($get['orderid']) {
            $order = M("Order");
            $changeorder = array('order_status'=>'2', 'order_paystatus'=>'2', 'order_delivery'=>'2', 'order_receipt'=>'2');
            if ($usertype == 1) {
                $order->where('id= '.$get['orderid'])->save($changeorder);
            } else {
                $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->save($changeorder);
            }
            $this->redirect('Order/lists');
        } else {
            $this->error("未知订单ID", 'lists');
        }
    } 

    public function acceptorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        $get = $this->filterAllParam('get');
        if ($get['orderid']) {
            $order = M("Order");
            $changeorder = array('order_status'=>'5');
            if ($usertype == 1) {
                $order->where('id= '.$get['orderid'])->save($changeorder);
            } else {
                $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->save($changeorder);
            }
            $this->redirect('Order/lists');
        } else {
            $this->error("未知订单ID", 'lists');
        }
    }

    public function refundorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        if ($usertype == 1) {
            $this->error("您无权取消此订单", 'lists');
        }
        $get = $this->filterAllParam('get');
        if ($get['orderid']) {
            $order = M("Order");
            $orderinfo = $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->find();
            if (!$orderinfo) {
                $this->error("无此订单", 'lists');
            }
            if ($orderinfo['order_paystatus'] == 1) {
                $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->setField('order_status', '3');
            } elseif ($orderinfo['order_paystatus'] == 2) {
                $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->setField('order_status', '3');
//                $refundurl = 'http://'.$_SERVER['SERVER_NAME'].'/api.php/pay/refund';
//                $ch = curl_init();
//                curl_setopt($ch, CURLOPT_URL, $refundurl);
//                curl_setopt($ch, CURLOPT_POST, 1);
//                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('amount'=>$orderinfo['order_price'])));
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//                curl_setopt($ch, CURLOPT_HEADER, 0);
//                $output = curl_exec($ch);
//                curl_close($ch);
//                echo '<pre>';
//                print_r($output);exit;
            }
            $this->redirect('Order/lists');
        } else {
            $this->error("未知订单ID", 'lists');
        }
    }

    public function refundorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        if ($usertype == 1) {
            $this->error("您无权拒绝取消此订单", 'lists');
        }
        $get = $this->filterAllParam('get');
        if ($get['orderid']) {
            $order = M("Order");
            $orderinfo = $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->find();
            if (!$orderinfo) {
                $this->error("无此订单", 'lists');
            }
            $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->setField('order_status', '6');
            $this->redirect('Order/lists');
        } else {
            $this->error("未知订单ID", 'lists');
        }
    }

    public function detailorder() {
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        $get = $this->filterAllParam('get');
        if ($get['orderid']) {
            $order = M("Order");
            $orderdetail = M("orderdetail");
            if ($usertype == 1) {
                $orderinfo = $order->where('id= '.$get['orderid'])->find();
            } else {
                $orderinfo = $order->where('id= '.$get['orderid'].' and food_shop="'.$userid.'"')->find();
            }
            if ($orderinfo) {
                $orderinfo['orderdetail'] = $orderdetail->where('order_id = '.$get['orderid'])->select();
            }
            $this->assign('orderinfo', $orderinfo);
            $this->display();
        } else {
            $this->error("未知订单ID", 'lists');
        }
    }
}