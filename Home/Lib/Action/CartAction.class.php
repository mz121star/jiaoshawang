<?php

class CartAction extends PublicAction {

    public function __construct() {
        parent::__construct();
        Vendor('Cart', '', '.class.php');
    }

    public function index(){
//        $userid = $this->userInfo['user_id'];
//        if(empty($userid)){
//            $this->redirect('Index/index');
//        }
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

    public function ordersuccess() {
        $orderobj = M("order");
        $food = M("food");
        $orderdetailobj = M("orderdetail");
        $allfoodid = array_keys($_SESSION['cart']);
        $order = array();
        foreach ($allfoodid as $foodid) {
            $foodinfo = $food->where('id='.$foodid)->field('user_id')->find();
            $order[$foodinfo['user_id']][] = $foodid;
        }
        foreach ($order as $shopid => $shopfoods) {
            
        }
        unset($_SESSION['cart']);
        $this->display();
    }



 //购物车ajax方法
    public function add() {
        $cart = new Cart();
        $foodinfo = $this->filterAllParam('post');
        $cart->addItem($foodinfo['id'], $foodinfo['food_name'], $foodinfo['food_price'], 1, $foodinfo['food_image']);
        exit;
    }

    public function delete() {
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->delItem($foodid);
        exit;
    }

    public function inc() {
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->incNum($foodid);
        exit;
    }

    public function dec() {
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->decNum($foodid);
        exit;
    }
    
    public function setnum() {
        $cart = new Cart();
        $foodid = $this->_post('id');
        $foodnumber = $this->_post('num');
        $cart->modNum($foodid, $foodnumber);
        exit;
    }
 //购物车ajax方法
}