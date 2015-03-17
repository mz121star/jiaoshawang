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
            $shopdetail['shop_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$shopdetail['shop_image'];
            $this->response($shopdetail, 'json');
        } else {
            $this->response(array('message' => '无此店铺'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/shop/list?uid=xxx
     * call method : get
     */
    public function list_get() {
        $userid = htmlspecialchars($_GET['uid']);
        $shop = M("Shop");
        $peoplefav = M("peoplefav");
        $order = M('order');
        $shoplist = $shop->order(array('id'=>'desc'))->select();
        $shops = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            $shop['is_fav'] = $peoplefav->where('user_people = "'.$userid.'" and user_shop = "'.$shop['user_id'].'"')->count();
            $shop['order_num'] = $order->where('food_shop = "'.$shop['user_id'].'"')->count();
            $shop['shop_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$shop['shop_image'];
            $shops[] = $shop;
        }
        $this->response($shops, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/shop/distance?lng=11&lat=222&distance=2&uid=xxx
     * call method : get
     */
    public function distance_get() {
        $userid = htmlspecialchars($_GET['uid']);
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
        $info_sql = "select * from `dc_shop` where shop_lat<>0 and shop_lat>{$squares['right-bottom']['lat']} and shop_lat<{$squares['left-top']['lat']} and shop_lng>{$squares['left-top']['lng']} and shop_lng<{$squares['right-bottom']['lng']}";
        $model = new Model();
        $result = $model->query($info_sql);
        if ($result === false) {
            $this->response(array('message' => '查询数据出错'), 'json');
        } else {
            $peoplefav = M("peoplefav");
            $order = M('order');
            $shoplist = array();
            foreach ($result as $shop) {
                $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
                $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
                if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                    $shop['is_working'] = 1;
                } else {
                    $shop['is_working'] = 0;
                }
                $shop['is_fav'] = $peoplefav->where('user_people = "'.$userid.'" and user_shop = "'.$shop['user_id'].'"')->count();
                $shop['order_num'] = $order->where('food_shop = "'.$shop['user_id'].'"')->count();
                $shop['shop_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$shop['shop_image'];
                $shoplist[] = $shop;
            }
            $this->response($shoplist, 'json');
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
            $shoplist_array = array();
            foreach ($shoplist as $shop) {
                $shop['shop_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$shop['shop_image'];
                $shoplist_array[] = $shop;
            }
            $this->response($shoplist_array, 'json');
        } else {
            $food = M("food");
            $where['food_name'] = array('like', '%'.$search_name.'%');
            $foodlist = $food->where($where)->select();
            if ($foodlist) {
                $foodlist_array = array();
                foreach ($foodlist as $food) {
                    $food['food_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$food['food_image'];
                    $foodlist_array[] = $food;
                }
                $this->response($foodlist_array, 'json');
            } else {
                $this->response(array('message' => '没有发现商铺或菜品'), 'json');
            }
        }
    }
    
    /*
     * call example : http://yourservername/api.php/shop/getshopbytype?tid=12
     * call method : get
     */
    public function getshopbytype_get() {
        $tid = htmlspecialchars($_GET['tid']);
        $shop = M("Shop");
        $peoplefav = M("peoplefav");
        $order = M('order');
        $shoplist = $shop->where(array('shop_type'=>$tid))->select();
        $shops = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            $shop['is_fav'] = $peoplefav->where('user_people = "'.$userid.'" and user_shop = "'.$shop['user_id'].'"')->count();
            $shop['order_num'] = $order->where('food_shop = "'.$shop['user_id'].'"')->count();
            $shop['shop_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$shop['shop_image'];
            $shops[] = $shop;
        }
        $this->response($shops, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/shop/getshoptype?pid=0
     * call method : get
     */
    public function getshoptype_get() {
        $pid = htmlspecialchars($_GET['pid']);
        $shoptype = M("shoptype");
        if ($pid == 'all') {
            $typelist = $shoptype->order('type_order')->select();
        } else {
            $pid = intval($pid);
            $typelist = $shoptype->where(array('parent_id'=>$pid))->order('type_order')->select();
        }
        $this->response($typelist, 'json');
    }
}