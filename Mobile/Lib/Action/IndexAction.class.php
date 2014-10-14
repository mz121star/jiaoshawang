<?php

class IndexAction extends PublicAction {

    public function index(){
        $userid = $this->userInfo['user_id'];
        $shopobj = M("Shop");
        $orderobj = M("order");
        import('ORG.Util.Page');
        $count = $shopobj->count();
        $page = new Page($count, 100);
        $shoplist = $shopobj->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        $commonshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            if ($userid && $shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $shop['order_number'] = $orderobj->where('food_shop = "'.$shop['user_id'].'"')->count();
            $commonshop[] = $shop;
        }
        $this->assign('commonshop', $commonshop);
        
        $shoptype = M('shoptype');
        $typelist = $shoptype->where('parent_id = 0')->select();
        $this->assign('typelist', $typelist);
        $this->display();
    }
    
    public function search() {
        $userid = $this->userInfo['user_id'];
        $searchshop = $this->_post('searchshop');
        $shopobj = M("Shop");
        if ($searchshop) {
            $where['shop_name'] = array('like', '%'.$searchshop.'%');
        } else {
            $where = array();
        }
        $orderobj = M("order");
        import('ORG.Util.Page');
        $count = $shopobj->where($where)->count();
        $page = new Page($count, 10);
        $shoplist = $shopobj->where($where)->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        $commonshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            if ($userid && $shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $shop['order_number'] = $orderobj->where('food_shop = "'.$shop['user_id'].'"')->count();
            $commonshop[] = $shop;
        }
        $this->assign('commonshop', $commonshop);
        
        $shoptype = M('shoptype');
        $typelist = $shoptype->where('parent_id = 0')->select();
        $this->assign('typelist', $typelist);
        $this->display('index');
    }
    
    public function settype(){
        $userid = $this->userInfo['user_id'];
        $shoptype = $this->_get('typeid');
        $shopobj = M("Shop");
        $orderobj = M("order");
        import('ORG.Util.Page');
        $count = $shopobj->count();
        $page = new Page($count, 10);
        if ($shoptype) {
            $shoplist = $shopobj->where('shop_type = '.$shoptype)->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        } else {
            $shoplist = $shopobj->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        }
        
        $commonshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            if ($userid && $shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $shop['order_number'] = $orderobj->where('food_shop = "'.$shop['user_id'].'"')->count();
            $commonshop[] = $shop;
        }
        $this->assign('commonshop', $commonshop);
        
        $shoptype = M('shoptype');
        $typelist = $shoptype->where('parent_id = 0')->select();
        $this->assign('typelist', $typelist);
        $this->display('index');
    }
    
    public function setorder(){
        $userid = $this->userInfo['user_id'];
        $orderid = $this->_get('orderid');
        $shopobj = M("Shop");
        $orderobj = M("order");
        import('ORG.Util.Page');
        $count = $shopobj->count();
        $page = new Page($count, 10);
        if ($orderid == 1) {
            $shoplist = $shopobj->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.shop_deliver_money'=>'asc'))->limit($page->firstRow.','.$page->listRows)->select();
        } elseif ($orderid == 2) {
            $shoplist = $shopobj->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.shop_deliver_time'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        } else {
            $shoplist = $shopobj->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        }
        
        $commonshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            if ($userid && $shop['user_people'] == $userid) {
                $shop['is_fav'] = 1;
            } else {
                $shop['is_fav'] = 0;
            }
            $shop['order_number'] = $orderobj->where('food_shop = "'.$shop['user_id'].'"')->count();
            $commonshop[] = $shop;
        }
        $this->assign('commonshop', $commonshop);
        
        $shoptype = M('shoptype');
        $typelist = $shoptype->where('parent_id = 0')->select();
        $this->assign('typelist', $typelist);
        $this->display('index');
    }

    public function detail(){
        $this->display();
    }

    public function cart(){
        $this->display();
    }

    public function login() {
        $this->display();
    }

    public function reg() {
        $this->display();
    }

    public function joinmarket() {
        $this->display();
    }

    public function logout() {
        $userInfo = session('userinfo');
        if(!empty($userInfo)){
            session('userinfo', null);
        }
        unset($_SESSION['cart']);
        $this->redirect('Index/index');
    }
    
    public function dologin() {
        $userInfo = session('userinfo');
        if(!empty($userInfo) && $userInfo['user_type'] == 3 ){
            $this->redirect('Index/index');
        }
        $user = M("User");
        $_POST['user_id'] = $this->_post('user_id');
        $_POST['user_pw'] = md5($this->_post('user_pw'));
        $_POST['user_status'] = 1;
        $userInfo = $user->where($_POST)->field('id,user_id,user_type')->find();
        if(!empty($userInfo) && $userInfo['user_type'] == 3){
            $people = M("People");
            $peopleinfo = $people->field('people_name,people_email,people_phone,people_addr,people_point,people_invitenum,people_invite')->where('user_id="'.$_POST['user_id'].'"')->find();
            if ($peopleinfo) {
                $userInfo = array_merge($userInfo, $peopleinfo);
            }
            session('userinfo', $userInfo);
            $this->success("登录成功", 'index');
        } else {
            $this->success("登录失败", 'login');
        }
    }

    public function adduser() {
        $post = $this->filterAllParam('post');
        if (!$post['user_id']) {
            $this->error("用户名不能为空");
        }
        if (!$post['user_pw1']) {
            $this->error("密码不能为空");
        }
        if ($post['user_pw1'] != $post['user_pw2']) {
            $this->error("密码不一致");
        }
        $user = M("User");
        $userInfo = $user->where('user_id="'.$post['user_id'].'"')->field('id')->find();
        if ($userInfo) {
            $this->error("用户ID已存在");
        }
        $post['user_pw'] = md5($post['user_pw1']);
        $userid = $user->add($post);
        if ($userid) {
            $people = M("People");
            $post['people_phone'] = $post['user_id'];
            $peopleid = $people->add($post);
            $this->success("注册成功", 'login');
        } else {
            $this->error("注册失败");
        }
    }

    public function addshop() {
        $post = $this->filterAllParam('post');
        if (!$post['shopname']) {
            $this->error("店名不能为空", 'index');
        }
        if (!$post['shopaddress']) {
            $this->error("地址不能为空", 'index');
        }
        if (!$post['shopphone']) {
            $this->error("电话不能为空", 'index');
        }
        $user = M("joinmarket");
        $shopid = $user->add($post);
        if ($shopid) {
            $this->redirect('Index');
        }
    }

    public function changeinfo(){
        $userid = $this->userInfo['user_id'];
        $people = M("People");
        $peopleinfo = $people->where('user_id="'.$userid.'"')->find();
        $this->assign('peopleinfo', $peopleinfo);
        $this->display();
    }

    public function upinfo(){
        $userid = $this->userInfo['user_id'];
        $post = $this->filterAllParam('post');
        if ($post['oldpwd']) {
            $user = M("User");
            $searchpw = md5($post['oldpwd']);
            $userInfo = $user->where('user_id="'.$userid.'" and user_pw="'.$searchpw.'"')->field('id')->find();
            if ($userInfo) {
                if ($post['pwd1'] && $post['pwd1'] == $post['pwd2']) {
                    $newpw = md5($post['pwd1']);
                    $isSuccess = $user->where('user_id="'.$userid.'"')->setField('user_pw', $newpw);
                } else {
                    $this->error("两次新密码不一致", 'changeinfo');
                }
            } else {
                $this->error("原密码错误", 'changeinfo');
            }
        } else {
            if ($post['pwd1']) {
                $this->error("请输入原密码", 'changeinfo');
            }
        }
        $people = M("People");
        $people->where('user_id="'.$userid.'"')->save($post);
        $this->success("信息修改成功", 'index');
    }
}