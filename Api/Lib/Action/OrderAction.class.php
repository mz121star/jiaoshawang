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
        $insertdata['order_pay'] = (isset($orderinfo['order_pay']) && $orderinfo['order_pay']) ? $orderinfo['order_pay'] : 2;
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
        if (isset($_POST['reason']) && $_POST['reason']) {
            $reason = htmlspecialchars($_POST['reason']);
        } else {
            $reason = '';
        }
        if (!$orderid || !$userid) {
            $this->response(array('message' => '信息不足'), 'json');
        }
        $orderobj = M("order");
        $orderinfo = $orderobj->where('id="'.$orderid.'" and order_people = "'.$userid.'"')->find();
        if (!$orderinfo) {
            $this->response(array('message' => '没有可选订单'), 'json');
        }

        $where['order_status'] = '4';
        if ($reason) {
            $where['order_cancel_reason'] = $reason;
        }
        $isok = $orderobj->where('id="'.$orderid.'"')->setField($where);
        if ($isok) {
            $this->response(array('message' => '申请取消订单成功'), 'json');
        } else {
            $this->response(array('message' => '申请取消订单失败'), 'json');
        }
    }
    
    /*
     * call example : http://yourservername/api.php/order/notify?uid=test
     * call method : get
     */
    public function notify_get() {
        $shopid = htmlspecialchars($_GET['uid']);
        if (!$shopid) {
            $this->response(array('message' => '请指定要查看的用户'), 'json');
        }
        $startdate = date('Y-m-d H:i:s', mktime(date('H'),  date('i')-1,  0 ,  date('m'),  date('d'),  date('Y')));
        $enddate = date('Y-m-d H:i:s', mktime(date('H'),  date('i'),  0 ,  date('m'),  date('d'),  date('Y')));
        $orderobj = M("order");
        $where['food_shop'] = $shopid;
        $where['order_paystatus'] = '2';
        $where['order_status'] = '1';
        $where['order_createdate'] = array('between', array($startdate, $enddate));
        $orderinfo = $orderobj->where($where)->select();
        $ordernum = count($orderinfo);
        $orderinfo = json_encode($orderinfo);
        if ($ordernum > 0) {
            $shop = M("Shop");
            $shopinfo = $shop->where('user_id="'.$shopid.'"')->find();
            if ($shopinfo && $shopinfo['shop_smsphone']) {
                $smsphone = explode(',', $shopinfo['shop_smsphone']);
                foreach ($smsphone as $phone) {
                    $phone = trim($phone);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'http://'.$_SERVER['SERVER_NAME'].'/api.php/sms/send');
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array('phone'=>$phone, 'type'=>'notify')));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                    $smsresult = curl_exec($ch);
                    curl_close($ch);
                }
            }
        }
        $this->response(array('ordernum' => $ordernum, 'orderinfo'=>$orderinfo), 'json');
    }

    /*
     * call example : http://yourservername/api.php/order/shownotify?uid=test1
     * call method : get
     */
    public function shownotify_get() {
        $shopid = htmlspecialchars($_GET['uid']);
        if (!$shopid) {
            $this->response(array('message' => '请指定要查看的用户'), 'json');
        }
        $startdate = date('Y-m-d H:i:s', mktime(date('H'),  date('i'),  0 ,  date('m')-1,  date('d'),  date('Y')));
        $enddate = date('Y-m-d H:i:s', mktime(date('H'),  date('i'),  0 ,  date('m'),  date('d'),  date('Y')));
        $orderobj = M("order");
        $where['food_shop'] = $shopid;
        $where['order_paystatus'] = '2';
        $where['order_status'] = '1';
        $where['order_createdate'] = array('between', array($startdate, $enddate));
        $notifylist = $orderobj->where($where)->select();
        $orderlist = array();
        foreach ($notifylist as $order) {
            if ($order['order_pay'] == '1') {
                $order['order_pay'] = '货到付款';
            } else {
                $order['order_pay'] = '在线支付';
            }
            if ($order['order_paystatus'] == '1') {
                $order['order_paystatus'] = '未付款';
            } else {
                $order['order_paystatus'] = '已付款';
            }
            if ($order['order_delivery'] == '1') {
                $order['order_delivery'] = '未发货';
            } else {
                $order['order_delivery'] = '已发货';
            }
            if ($order['order_receipt'] == '1') {
                $order['order_receipt'] = '未收货';
            } else {
                $order['order_receipt'] = '已收货';
            }
            if ($order['order_invoice'] == '1') {
                $order['order_invoice'] = '不索取发票';
            } else {
                $order['order_invoice'] = '索取发票';
            }
            if ($order['order_status'] == '1') {
                $order['order_status'] = '初始订单';
            } elseif ($order['order_status'] == '2') {
                $order['order_status'] = '完结订单';
            } elseif ($order['order_status'] == '3') {
                $order['order_status'] = '订单已取消';
            } elseif ($order['order_status'] == '4') {
                $order['order_status'] = '申请退款';
            } elseif ($order['order_status'] == '5') {
                $order['order_status'] = '商家已接单';
            } else {
                $order['order_status'] = '未知状态';
            }
            $orderlist[] = $order;
        }
        $this->response($orderlist, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/order/acceptorder
     * call method : post
     */
    public function acceptorder_post() {
        $userid = htmlspecialchars($_POST['uid']);
        $orderid = htmlspecialchars($_POST['oid']);
        if ($orderid) {
            $order = M("Order");
            $changeorder = array('order_status'=>'5');
            $isok = $order->where('id= "'.$orderid.'" and food_shop="'.$userid.'"')->save($changeorder);
            if ($isok === false) {
                $this->response(array('message' => '接单失败'), 'json');
            } else {
                $this->response(array('message' => '接单成功'), 'json');
            }
        } else {
            $this->response(array('message' => '未知订单'), 'json');
        }
    }
    
    /*
     * call example : http://yourservername/api.php/order/agreecancel
     * call method : post
     */
    public function agreecancel_post() {
        $userid = htmlspecialchars($_POST['uid']);
        $orderid = htmlspecialchars($_POST['oid']);
        if ($orderid) {
            $order = M("Order");
            $changeorder = array('order_status'=>'3');
            $isok = $order->where('id= "'.$orderid.'" and food_shop="'.$userid.'"')->save($changeorder);
            if ($isok === false) {
                $this->response(array('message' => '取消失败'), 'json');
            } else {
                $this->response(array('message' => '取消成功'), 'json');
            }
        } else {
            $this->response(array('message' => '未知订单'), 'json');
        }
    }
}