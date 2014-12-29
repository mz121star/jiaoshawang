<?php

class UserAction extends Action {

    /*
     * call example : http://yourservername/api.php/user/login
     * call method : post
     */
    public function login_post(){
        $userid = htmlspecialchars($_POST['userid']);
        $userpw = htmlspecialchars($_POST['userpw']);

        $user = M("User");
        $data['user_id'] = $userid;
        $data['user_pw'] = md5($userpw);
        $data['user_status'] = 1;
        $data['user_type'] = 3;
        $userInfo = $user->where($data)->field('user_pw', true)->find();
        if ($userInfo) {
            $people = M("people");
            $peopleInfo = $people->where('user_id = "'.$userInfo['user_id'].'"')->find();
            $result['user_id'] = $userInfo['user_id'];
            if ($peopleInfo) {
                $result['people_name'] = $peopleInfo['people_name'];
                $result['people_email'] = $peopleInfo['people_email'];
                $result['people_phone'] = $peopleInfo['people_phone'];
                $result['people_addr'] = $peopleInfo['people_addr'];
                $result['people_point'] = $peopleInfo['people_point'];
            }
            $this->response($result, 'json');
        } else {
            $this->response(array('message' => '用户名或密码错误'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/user/favshop
     * call method : post
     */
    public function favshop() {
        $userid = htmlspecialchars($_GET['uid']);
        $shopid = htmlspecialchars($_GET['sid']);
        $people = M("people");
        $peopleNum = $people->where('user_id = "'.$userid.'"')->count();
        if (!$peopleNum) {
            $this->response(array('message' => '无此用户'), 'json');
        }
        $shop = M("Shop");
        $shopNum = $shop->where('user_id = "'.$shopid.'"')->count();
        if (!$shopNum) {
            $this->response(array('message' => '无此商户'), 'json');
        }
        $peoplefav = M("peoplefav");
        $insert = array('user_people'=>$userid, 'user_shop'=>$shopid, '$shopid'=>date('Y-m-d H:i:s'));
        $favid = $peoplefav->add($insert);
        if ($favid) {
            $this->response(array('message' => '收藏成功'), 'json');
        } else {
            $this->response(array('message' => '收藏失败'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/user/myfav?uid=zb
     * call method : get
     */
    public function myfav() {
        $userid = htmlspecialchars($_GET['uid']);
        $peoplefav = M("peoplefav");
        $favshoplist = $peoplefav->where('user_people = "'.$userid.'"')->select();
        $shop = M("shop");
        $shoplist = array();
        foreach ($favshoplist as $favshop) {
            $shopinfo = $shop->where('user_id = "'.$favshop['user_shop'].'"')->find();
            $shopinfo['fav_date'] = $favshop['fav_date'];
            $shoplist[] = $shopinfo;
        }
        $this->response($shoplist, 'json');
    }

    /*
     * call example : http://yourservername/api.php/user/myorder?uid=zb
     * call method : get
     */
    public function myorder() {
        $userid = htmlspecialchars($_GET['uid']);
        $order = M("order");
        $orderlist = $order->where('order_people = "'.$userid.'"')->select();
        $this->response($orderlist, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/user/orderdetail?id=8
     * call method : get
     */
    public function orderdetail() {
        $orderid = htmlspecialchars($_GET['id']);
        $order = M("order");
        $orderinfo = $order->where('id = "'.$orderid.'"')->find();
        if (!$orderinfo) {
            $this->response(array('message' => '无此订单'), 'json');
        } else {
            $orderdetail = M("orderdetail");
            $detail = $orderdetail->where('order_id = "'.$orderinfo['id'].'"')->select();
            $orderinfo['order_detail'] = $detail;
            $this->response($orderinfo, 'json');
        }
    }
}