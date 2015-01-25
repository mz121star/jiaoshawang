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
     * call example : http://yourservername/api.php/user/regist
     * call method : post
     */
    public function regist_post() {
        $post = $this->filterAllParam('post');
        if (!$post['user_id']) {
            $this->response(array('message' => '用户名不能为空'), 'json');
        }
        if (!$post['user_pw1']) {
            $this->response(array('message' => '密码不能为空'), 'json');
        }
        if ($post['user_pw1'] != $post['user_pw2']) {
            $this->response(array('message' => '密码不一致'), 'json');
        }
        $user = M("User");
        $userInfo = $user->where('user_id="'.$post['user_id'].'"')->field('id')->find();
        if ($userInfo) {
            $this->response(array('message' => '用户ID已存在'), 'json');
        }
        $post['user_pw'] = md5($post['user_pw1']);
        $userid = $user->add($post);
        if ($userid) {
            $people = M("People");
            $peopleid = $people->add($post);
            $this->response(array('message' => '注册成功'), 'json');
        } else {
            $this->response(array('message' => '注册失败'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/user/favshop
     * call method : post
     */
    public function favshop_post() {
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
    public function myfav_get() {
        $userid = htmlspecialchars($_GET['uid']);
        if (!$userid) {
            $this->response(array('message' => '请给出用户'), 'json');
        }
        $peoplefav = M("peoplefav");
        $favshoplist = $peoplefav->where('user_people = "'.$userid.'"')->select();
        if (!count($favshoplist)) {
            $this->response(array('message' => '无收藏'), 'json');
        }
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
     * call example : http://yourservername/api.php/user/cancelfav
     * call method : get
     */
    public function cancelfav_post() {
        $userid = htmlspecialchars($_GET['uid']);
        $shopid = htmlspecialchars($_GET['sid']);
        if (!$userid) {
            $this->response(array('message' => '请登录后删除收藏'), 'json');
        }
        $peoplefav = M("peoplefav");
        $favid = $peoplefav->where(array('user_people'=>$userid, 'user_shop'=>$shopid))->delete();
        if ($favid) {
            $this->response(array('message' => '删除收藏成功'), 'json');
        } else {
            $this->response(array('message' => '删除收藏失败'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/user/myorder?uid=zb
     * call method : get
     */
    public function myorder_get() {
        $userid = htmlspecialchars($_GET['uid']);
        if (!$userid) {
            $this->response(array('message' => '请给出用户'), 'json');
        }
        $order = M("order");
        $orderlist = $order->where('order_people = "'.$userid.'"')->select();
        if (!count($orderlist)) {
            $this->response(array('message' => '无订单'), 'json');
        }
        $this->response($orderlist, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/user/orderdetail?id=8
     * call method : get
     */
    public function orderdetail_get() {
        $orderid = htmlspecialchars($_GET['id']);
        if (!$orderid) {
            $this->response(array('message' => '请给出订单ID'), 'json');
        }
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