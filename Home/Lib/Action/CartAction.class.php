<?php

class CartAction extends PublicAction {

    public function index(){
        $this->display();
    }
    
    public function add() {
        Vendor('Cart', '', '.class.php');
        $cart = new Cart();
        $foodid = $this->_post('id');
        $foodinfo = $food->where('id='.$foodid)->find();
        $cart->addItem($foodid, $foodinfo['food_name'], $foodinfo['food_price'], 1, $foodinfo['food_image']);
        exit;
    }
    
    public function delete() {
        Vendor('Cart', '', '.class.php');
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->delItem($foodid);
        exit;
    }
    
    public function inc() {
        Vendor('Cart', '', '.class.php');
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->incNum($foodid);
        exit;
    }
    
    public function dec() {
        Vendor('Cart', '', '.class.php');
        $cart = new Cart();
        $foodid = $this->_post('id');
        $cart->decNum($foodid);
        exit;
    }
    
    public function setnum() {
        Vendor('Cart', '', '.class.php');
        $cart = new Cart();
        $foodid = $this->_post('id');
        $foodnumber = $this->_post('num');
        $cart->modNum($foodid, $foodnumber);
        exit;
    }

    public function ordersuccess(){
        $this->display();
    }
}