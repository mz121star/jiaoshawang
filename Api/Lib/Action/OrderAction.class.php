<?php

class OrderAction extends Action {

    /*
     * call example : http://yourservername/api.php/order/create
     * call method : post
     */
    public function create_post() {
        $orderobj = M("order");
        $orderdetailobj = M("orderdetail");
        $cart_content = $_POST['cart'];
        $orderinfo = filterAllParam('post');
        $orderinfo['cart'] = $cart_content;
        $insertdata = array();
        $i = 1;
        $totalprice = 0;
        if (!is_array($orderinfo['cart'])) {
            $orderinfo['cart'] = json_decode($orderinfo['cart'], true);
        }
        foreach ($orderinfo['cart'] as $food) {
            if (!is_array($food)) {
                $food = json_decode($food, true);
            }
            if ($i == 1) {
                $foodobj = M("food");
                $fooduser = $foodobj->where('id='.$food['food_id'])->field('user_id')->find();
                $insertdata['food_shop'] = $fooduser['user_id'];
            }
            $totalprice += $food['food_count'] * $food['food_price'];
        }
        if (!$totalprice) {
            $this->response(array('message' => '没有选择菜品'), 'json');
        }
        if (empty($orderinfo['user_id'])) {
            $this->response(array('message' => '请选择下单人'), 'json');
        }
        if (empty($orderinfo['order_addr'])) {
            $this->response(array('message' => '请填写下单地址'), 'json');
        }
        if (empty($orderinfo['order_phone'])) {
            $this->response(array('message' => '请填写联系电话'), 'json');
        }
        if (empty($orderinfo['sendtime'])) {
            $this->response(array('message' => '请选择送餐时间'), 'json');
        }
        if (empty($orderinfo['peoplename'])) {
            $orderinfo['peoplename'] = '顾客';
        }
        if (empty($orderinfo['order_remark'])) {
            $orderinfo['order_remark'] = '无';
        }
        if ($orderinfo['area_select'] == 191) {
            $people = M("People");
            $peopleinfo = $people->where('user_id="'.$orderinfo['user_id'].'"')->find();
            $insertdata['order_addr'] = $peopleinfo['people_addr'];
            $insertdata['order_phone'] = $peopleinfo['people_phone'];
            $insertdata['order_peoplename'] = $peopleinfo['people_name'];
        } else {
            $insertdata['order_addr'] = $orderinfo['order_addr'];
            $insertdata['order_phone'] = $orderinfo['order_phone'];
            $insertdata['order_peoplename'] = $orderinfo['peoplename'];
        }
        $insertdata['order_people'] = $orderinfo['user_id'];
        $insertdata['order_sendtime'] = $orderinfo['sendtime'];
        $insertdata['order_remark'] = $orderinfo['order_remark'];
        $insertdata['order_createdate'] = date('Y-m-d H:i:s');
        $insertdata['order_price'] = $totalprice;
        $insertdata['order_pay'] = 1;
        $insertdata['order_paystatus'] = 1;
        $insertdata['order_delivery'] = 1;
        $insertdata['order_receipt'] = 1;
        $insertdata['order_invoice'] = 1;
        $insertdata['order_status'] = 1;
        $insertdata['order_trade_no'] = '';
        $order_id = $orderobj->add($insertdata);
        if (!$order_id) {
            $this->response(array('message' => '下单失败'), 'json');
        }
        foreach ($orderinfo['cart'] as $food) {
            if (!is_array($food)) {
                $food = json_decode($food, true);
            }
            $detailid = $orderdetailobj->add(array(
                                                  'order_id' => $order_id,
                                                  'food_id' => $food['food_id'],
                                                  'food_name' => $food['food_name'],
                                                  'food_price' => $food['food_price'],
                                                  'food_count' => $food['food_count']
                                                  ));
        }
        $this->response(array('message' => '下单成功', 'order_number'=>$order_id, 'order_price'=>$totalprice), 'json');
    }

    /*
     * call example : http://yourservername/api.php/order/confirm
     * call method : post
     */
    public function confirm_post() {
        $userid = htmlspecialchars($_POST['uid']);
        $orderid = htmlspecialchars($_POST['oid']);
        if (!$orderid || !$userid) {
            $this->response(array('message' => '信息不足'), 'json');
        }
        $orderobj = M("order");
        $orderinfo = $orderobj->where('id="'.$orderid.'" and order_people = "'.$userid.'"')->find();
        if (!$orderinfo) {
            $this->response(array('message' => '没有可选订单'), 'json');
        }

        $isok = $orderobj->where('id="'.$orderid.'"')->setField('order_status', '2');
        if ($isok) {
            $return_msg = array('message' => '确定收货成功');
            $people = M("People");
            $peopleinfo = $people->field('people_point')->where('user_id="'.$userid.'"')->find();
            if ($peopleinfo) {
                $newpoint = $peopleinfo['people_point'] + intval($orderinfo['order_price']);
                $isok = $people->where('user_id="'.$userid.'"')->setField('people_point', $newpoint);
                if ($isok) {
                    $return_msg['people_point'] = $newpoint;
                }
            }
            $this->response($return_msg, 'json');
        } else {
            $this->response(array('message' => '确定收货失败'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/order/cancel
     * call method : post
     */
    public function cancel_post() {
        $userid = htmlspecialchars($_POST['uid']);
        $orderid = htmlspecialchars($_POST['oid']);
        if (!$orderid || !$userid) {
            $this->response(array('message' => '信息不足'), 'json');
        }
        $orderobj = M("order");
        $orderinfo = $orderobj->where('id="'.$orderid.'" and order_people = "'.$userid.'"')->find();
        if (!$orderinfo) {
            $this->response(array('message' => '没有可选订单'), 'json');
        }

        $isok = $orderobj->where('id="'.$orderid.'"')->setField('order_status', '3');
        if ($isok) {
            $this->response(array('message' => '取消订单成功'), 'json');
        } else {
            $this->response(array('message' => '取消订单失败'), 'json');
        }
    }
}