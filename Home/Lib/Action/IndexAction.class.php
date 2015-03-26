<?php

class IndexAction extends PublicAction {
    public function reg() {
        $this->display();
    }
        public function map() {
             $this->display();
         }
    public function login() {
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
            session('userinfo', $userInfo);
        }
        $this->redirect('Index/index');
    }

    public function logout() {
        $userInfo = session('userinfo');
        if(!empty($userInfo)){
            session('userinfo', null);
            unset($_SESSION['cart']);
        }
        $this->redirect('Index/index');
    }
    
    public function adduser() {
        $post = $this->filterAllParam('post');
        if (!$post['user_id']) {
            $this->error("用户名不能为空", 'index');
        }
        if (!$post['user_pw1']) {
            $this->error("密码不能为空", 'index');
        }
        if ($post['user_pw1'] != $post['user_pw2']) {
            $this->error("密码不一致", 'index');
        }
        $user = M("User");
        $userInfo = $user->where('user_id="'.$post['user_id'].'"')->field('id')->find();
        if ($userInfo) {
            $this->error("用户ID已存在", 'index');
        }
        $post['user_pw'] = md5($post['user_pw1']);
        $userid = $user->add($post);
        if ($userid) {
            $people = M("People");
            $peopleid = $people->add(array('user_id'=>$post['user_id'], 'people_email'=>$post['people_email']));
        }
        $this->redirect('User/changeinfo');
    }

    public function index1() {
        $userid = $this->userInfo['user_id'];
        $shopobj = M("Shop");
        $shoplist = $shopobj->where('shop_top="1"')->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->limit('0,5')->select();
        $topshop = array();
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
            $topshop[] = $shop;
        }
        $this->assign('topshop', $topshop);

        import('ORG.Util.Page');
        $count = $shopobj->count();
        $page = new Page($count, 10);
        $shoplist = $shopobj->where('shop_top="0"')->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id,user_people')->join(' dc_peoplefav ON dc_peoplefav.user_shop = dc_shop.user_id')->order(array('dc_shop.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
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
            $commonshop[] = $shop;
        }
        $this->assign('commonshop', $commonshop);

        $system = M("systempic");
        $syspicinfo = $system->select();
        $this->assign('syspicinfo', $syspicinfo);
        $this->assign('firstpicinfo', $syspicinfo[0]['system_pic']);
        $this->display('index1');
    }
    
    public function index() {
        $userid = $this->userInfo['user_id'];
        $domain = 'http://'.$_SERVER['SERVER_NAME'];
        $typelist_json = file_get_contents($domain.'/api.php/shop/getshoptype?pid=0');
        $typelist = json_decode($typelist_json, true);
        $this->assign('typelist', $typelist);
        
        $peoplefav = M("peoplefav");
        $orderobj = M('order');
        $shopnotice = M('shopnotice');
        $model = new Model();

        $lng = htmlspecialchars($_GET['lng']);
        $lat = htmlspecialchars($_GET['lat']);
        $distance = 0.5;
        
        $order = htmlspecialchars($_GET['order']);
        $orderby = '';
        if ($order == 1) {
            $mostshop = array();
            $resultlist = $model->query('SELECT food_shop FROM dc_order GROUP BY food_shop ORDER BY count( food_shop ) desc');
            foreach ($resultlist as $key => $value) {
                $mostshop[$value['food_shop']] = $key;
            }
        } elseif ($order == 2) {
            
        } elseif ($order == 3) {
            $orderby = ' order by shop_deliver_time desc';
        }
        $tid = htmlspecialchars($_GET['tid']);
        $where = '';
        if ($tid) {
            $where .= ' and shop_type = "'.$tid.'"';
        }
        $startsong = htmlspecialchars($_GET['startsong']);
        if ($startsong == 10 || $startsong == 20 || $startsong == 30) {
            $where .= ' and shop_deliver_beginmoney <= "'.$startsong.'"';
        }
        
        $squares = getSquarePoint($lng, $lat, $distance);
//        $info_sql = "select * from `dc_shop` where shop_lat<>0 and shop_lat>{$squares['right-bottom']['lat']} and shop_lat<{$squares['left-top']['lat']} and shop_lng>{$squares['left-top']['lng']} and shop_lng<{$squares['right-bottom']['lng']}".$where.$orderby;
        $info_sql = 'select * from dc_shop where 1 '.$where.$orderby;
        $shoplist = $model->query($info_sql);
        $topshop = array();
        $current_time = date('Gis');
        $i = 0;
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            $shop['is_fav'] = $peoplefav->where('user_people = "'.$userid.'" and user_shop = "'.$shop['user_id'].'"')->count();
            $shop['order_num'] = $orderobj->where('food_shop = "'.$shop['user_id'].'"')->count();
            $shop['shop_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$shop['shop_image'];
            $noticelist = $shopnotice->where('user_id = "'.$shop['user_id'].'"')->order('notice_date desc')->find();
            $shop['shopnotice'] = $noticelist['notice_content'];
            if ($order == 1) {
                if (isset($mostshop[$shop['user_id']])) {
                    $thisshoporder = $mostshop[$shop['user_id']];
                } else {
                    $thisshoporder = count($mostshop);
                    $thisshoporder = $thisshoporder + $i;
                }
                $topshop[$thisshoporder] = $shop;
            } else {
                $topshop[] = $shop;
            }
            $i++;
        }
        if ($order == 1) {
            ksort($topshop);
        }
        $this->assign('topshop', $topshop);
        $this->assign('tid', ($tid)?$tid:0);
        $this->assign('orderby', ($order)?$order:0);
        $this->assign('startsong', ($startsong)?$startsong:10000);
        $this->display('index1');
    }
}
