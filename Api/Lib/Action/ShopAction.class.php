<?php

class ShopAction extends Action {

    /*
     * call example : http://yourservername/api.php/shop/detail?id=2
     * call method : get
     */
    public function detail_get(){
        $shop_id = htmlspecialchars($_GET['id']);
        if (!$shop_id) {
            $this->response(array('message' => '无此店铺'), 'json');
        }
        $shop = M("Shop");
        $shopdetail = $shop->where('id = "'.$shop_id.'"')->find();
        if ($shopdetail) {
            $this->response($shopdetail, 'json');
        } else {
            $this->response(array('message' => '无此店铺'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/shop/list
     * call method : get
     */
    public function list_get() {
        $shop = M("Shop");
        $shoplist = $shop->join(' dc_user ON dc_user.user_id = dc_shop.user_id')->field('dc_user.user_id,dc_shop.id,shop_name,shop_image,shop_email,shop_phone,user_status')->order(array('dc_user.id'=>'desc'))->select();
        $this->response($shoplist, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/shop/distance?lng=11&lat=222&distance=2
     * call method : get
     */
    public function distance_get() {
        $lng = htmlspecialchars($_GET['lng']);
        $lat = htmlspecialchars($_GET['lat']);
        $distance = htmlspecialchars($_GET['distance']);
        if (!$lng || !$lat) {
            $this->response(array('message' => '请给出具体位置'), 'json');
        }
        if (!$distance) {
            $distance = 0.5;
        }
        $squares = getSquarePoint($lng, $lat, $distance);
        $info_sql = "select * from `dc_shop` where shop_lat<>0 and shop_lat>{$squares['right-bottom']['lat']} and shop_lat<{$squares['left-top']['lat']} and shop_lng>{$squares['left-top']['lng']} and shop_lng<{$squares['right-bottom']['lng']} ";
        $model = new Model();
        $result = $model->query($info_sql);
        if ($result === false) {
            $this->response(array('message' => '查询数据出错'), 'json');
        } else {
            $this->response($result, 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/shop/search?search_name=丸子
     * call method : get
     */
    public function search_get() {
        $search_name = htmlspecialchars($_GET['search_name']);
        if (!$search_name) {
            $this->response(array('message' => '请输入要查询的内容'), 'json');
        }
        $shop = M("Shop");
        $where['shop_name'] = array('like', '%'.$search_name.'%');
        $shoplist = $shop->where($where)->select();
        if ($shoplist) {
            $this->response($shoplist, 'json');
        } else {
            $food = M("food");
            $where['food_name'] = array('like', '%'.$search_name.'%');
            $foodlist = $food->where($where)->select();
            if ($foodlist) {
                $this->response($foodlist, 'json');
            } else {
                $this->response(array('message' => '没有发现商铺或菜品'), 'json');
            }
        }
    }
}