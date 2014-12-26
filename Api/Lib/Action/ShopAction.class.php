<?php

class ShopAction extends Action {

    public function getshop_get(){
        $this->response('test');
    }
    
    public function getshoplist_get() {
        $shop = M("Shop");
        $shoplist = $shop->join(' dc_user ON dc_user.user_id = dc_shop.user_id')->field('dc_user.user_id,shop_name,shop_image,shop_email,shop_phone,user_status')->order(array('dc_user.id'=>'desc'))->select();
        $this->response($shoplist, 'json');
    }
}