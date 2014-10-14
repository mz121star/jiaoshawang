<?php

class CartAction extends PublicAction {
    
    public function __construct() {
        parent::__construct();
        Vendor('Cart', '', '.class.php');
    }

    public function cart(){
        $userid = $this->userInfo['user_id'];
        if(empty($userid)){
            $this->error('请登录后下单');
        }
        $shopid = $this->_get('shopid');
        $shopobj = M("Shop");
        $shopinfo = $shopobj->where('user_id="'.$shopid.'"')->field('shop_deliver_beginmoney,shop_beginworktime, shop_endworktime')->find();
        if (!$shopinfo) {
            $this->redirect('Index/index');
        }
        $beginworktime = intval(implode('', explode(':', $shopinfo['shop_beginworktime'])));
        $endworktime = intval(implode('', explode(':', $shopinfo['shop_endworktime'])));
        $current_time = date('Gis');
        if ($current_time >= $beginworktime && $current_time <= $endworktime) {
            $is_working = 1;
        } else {
            $is_working = 0;
        }
        if (!$is_working) {
            unset($_SESSION['cart']);
            $this->error('非营业时间，请在'.$shopinfo['shop_beginworktime'].' - '.$shopinfo['shop_endworktime'].'时间段内下单');
        }

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
        if (!$cartprice) {
            $this->error('没有选择菜品');
        }
        $this->assign('shopid', $shopid);
        $this->assign('cartlist', $cartlist);
        $this->assign('cartprice', $cartprice);
        $this->assign('carttotle', $carttotle);
        if ($shopinfo['shop_deliver_beginmoney'] > $cartprice) {
            $this->assign('beginmoney', $shopinfo['shop_deliver_beginmoney']-$cartprice);
        } else {
            $this->assign('beginmoney', 0);
        }
        $people = M("People");
        $peopleinfo = $people->where('user_id="'.$userid.'"')->find();
        $this->assign('peopleinfo', $peopleinfo);
        
        $order = M("Order");
        $lastaddr = '';
        $lastphone = '';
        $lastpeoplename = '';
        $orderinfo = $order->field('order_addr,order_phone,order_peoplename')->where('order_people="'.$userid.'"')->order(array('order_createdate'=>'desc'))->limit(1)->find();
        if ($orderinfo) {
            $lastaddr = $orderinfo['order_addr'];
            $lastphone = $orderinfo['order_phone'];
            $lastpeoplename = $orderinfo['order_peoplename'];
        }
        $this->assign('lastaddr', $lastaddr);
        $this->assign('lastphone', $lastphone);
        $this->assign('lastpeoplename', $lastpeoplename);
        $this->display();
    }
    
    public function ordersuccess() {
        $orderobj = M("order");
        $orderdetailobj = M("orderdetail");
        $orderinfo = $this->filterAllParam('post');
        $insertdata = array();
        $i = 1;
        $totalprice = 0;
        foreach ($_SESSION['cart'] as $foodid => $food) {
            if ($i == 1) {
                $foodobj = M("food");
                $fooduser = $foodobj->where('id='.$foodid)->field('user_id')->find();
                $insertdata['food_shop'] = $fooduser['user_id'];
            }
            $totalprice += $food['num'] * $food['price'];
        }
        if (!$totalprice) {
            $this->error('没有选择菜品', '/mobile.php/shop/detail/'.$orderinfo['shopid']);
        }
        if ($orderinfo['area_select'] == 191) {
            $people = M("People");
            $peopleinfo = $people->where('user_id="'.$this->userInfo['user_id'].'"')->find();
            $insertdata['order_addr'] = $peopleinfo['people_addr'];
            $insertdata['order_phone'] = $peopleinfo['people_phone'];
            $insertdata['order_peoplename'] = $peopleinfo['people_name'];
        } else {
            $insertdata['order_addr'] = $orderinfo['louhao1'];
            $insertdata['order_phone'] = $orderinfo['mobile'];
            $insertdata['order_peoplename'] = $orderinfo['name'];
        }
        $insertdata['order_people'] = $this->userInfo['user_id'];
        $insertdata['order_sendtime'] = $orderinfo['arrive'];
        $insertdata['order_remark'] = $orderinfo['order_remark'];
        $insertdata['order_createdate'] = date('Y-m-d H:i:s');
        $insertdata['order_price'] = $totalprice;
        $insertdata['order_pay'] = 1;
        $insertdata['order_paystatus'] = 1;
        $insertdata['order_delivery'] = 1;
        $insertdata['order_receipt'] = 1;
        $insertdata['order_invoice'] = 1;
        $insertdata['order_status'] = 1;
        $order_id = $orderobj->add($insertdata);
        if (!$order_id) {
            $this->error("下单失败");
        }
        foreach ($_SESSION['cart'] as $foodid => $food) {
            $detailid = $orderdetailobj->add(array(
                                                  'order_id' => $order_id,
                                                  'food_id' => $foodid,
                                                  'food_name' => $food['name'],
                                                  'food_price' => $food['price'],
                                                  'food_count' => $food['num']
                                                  ));
        }
        unset($_SESSION['cart']);
        $this->success("下单成功", 'gotoshoporder');
    }

    public function gotoshoporder() {
        $this->redirect('shop/orders');
    }

    //购物车ajax方法
    public function add() {
        $userid = $this->userInfo['user_id'];
        if(empty($userid)){
            echo '请先登录再下单';exit;
        }
        $cart = new Cart();
        $foodinfo = $this->filterAllParam('post');
        $number = $cart->getCnt();
        if ($number > 0) {
            $foodobj = M("Food");
            foreach ($_SESSION['cart'] as $foodid => $food) {
                $fooduser = $foodobj->where('id='.$foodid)->field('user_id')->find();
                $foodnumber = $foodobj->where('id='.$foodinfo['id'].' and user_id="'.$fooduser['user_id'].'"')->field('user_id')->count();
                if (!$foodnumber) {
                    echo '请选择同一店铺的菜肴';exit;
                }
            }
        }
        $cart->addItem($foodinfo['id'], $foodinfo['food_name'], $foodinfo['food_price'], 1, $foodinfo['food_image']);
        echo '成功加入购物车';
        exit;
    }

    public function delete() {
        $userid = $this->userInfo['user_id'];
        if(empty($userid)){
            echo '请先登录';exit;
        }
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->delItem($foodid);
        exit;
    }

    public function inc() {
        $userid = $this->userInfo['user_id'];
        if(empty($userid)){
            echo '请先登录';exit;
        }
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->incNum($foodid);
        exit;
    }

    public function dec() {
        $userid = $this->userInfo['user_id'];
        if(empty($userid)){
            echo '请先登录';exit;
        }
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->decNum($foodid);
        exit;
    }
    
    public function setnum() {
        $userid = $this->userInfo['user_id'];
        if(empty($userid)){
            echo '请先登录';exit;
        }
        $cart = new Cart();
        $foodid = $this->_post('id');
        $foodnumber = $this->_post('num');
        $cart->modNum($foodid, $foodnumber);
        exit;
    }
 //购物车ajax方法
}