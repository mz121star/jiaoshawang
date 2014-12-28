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
        $userInfo = $user->where($data)->field('id,user_id')->find();
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
     * call example : http://yourservername/api.php/user/myfav?uid=xx
     * call method : get
     */
    public function myfav() {
        $userid = htmlspecialchars($_GET['uid']);
    }

    /*
     * call example : http://yourservername/api.php/user/myorder?uid=xx
     * call method : get
     */
    public function myorder() {
        $userid = htmlspecialchars($_GET['uid']);
    }
}