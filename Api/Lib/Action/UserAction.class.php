<?php

class UserAction extends Action {

    public function login_post(){
        $userid = $this->_post('userid');
        $userpw = $this->_post('userpw');
        
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
            $this->response('用户名或密码错误');
        }
    }
}