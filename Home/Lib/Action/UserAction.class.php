<?php

class UserAction extends PublicAction {

    function __construct(){
        parent::__construct();
        if (!$this->userInfo['user_id']) {
            $this->redirect('Index/index');
        }
    }

    public function index(){
        $this->display();
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
        $this->redirect('User/orderdetail');
    }

    public function myfav(){
        $userid = $this->userInfo['user_id'];
        $shopobj = M("peoplefav");
        $shoplist = $shopobj->where('user_people="'.$userid.'"')->field('dc_shop.id, shop_name, shop_beginworktime, shop_endworktime, shop_deliver_money, shop_deliver_beginmoney, shop_deliver_time, shop_image, shop_top, user_id')->join(' dc_shop ON dc_shop.user_id = dc_peoplefav.user_shop')->order(array('dc_shop.id'=>'desc'))->select();
        $favshop = array();
        $current_time = date('Gis');
        foreach ($shoplist as $shop) {
            $beginworktime = intval(implode('', explode(':', $shop['shop_beginworktime'])));
            $endworktime = intval(implode('', explode(':', $shop['shop_endworktime'])));
            if ($current_time >= $beginworktime && $current_time <= $endworktime) {
                $shop['is_working'] = 1;
            } else {
                $shop['is_working'] = 0;
            }
            $favshop[] = $shop;
        }
        $this->assign('favshop', $favshop);
        $this->display();
    }

    public function orderdetail(){
        $userid = $this->userInfo['user_id'];
        $orderobj = M("order");
        $orderdetailobj = M("orderdetail");
        $shopobj = M("shop");
        import('ORG.Util.Page');
        $count = $orderobj->where('order_people="'.$userid.'"')->count();
        $page = new Page($count, 10);
        $orderlist = $orderobj->where('order_people="'.$userid.'"')->limit($page->firstRow.','.$page->listRows)->order(array('order_createdate'=>'desc'))->select();
        foreach ($orderlist as $key => $order) {
            $detaillist = $orderdetailobj->where('order_id="'.$order['id'].'"')->select();
            $orderlist[$key]['orderdetail'] = $detaillist;
            
            $shopinfo = $shopobj->where('user_id="'.$order['food_shop'].'"')->field('shop_deliver_money')->find();
            $orderlist[$key]['shop_deliver_money'] = $shopinfo['shop_deliver_money'];
        }
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('orderlist', $orderlist);
        $this->display();
    }
    
    public function cancelorder() {
        $userid = $this->userInfo['user_id'];
        $get = $this->filterAllParam('get');
        $orderobj = M("order");
        $isCancel = $orderobj->where('id = '.$get['id'].' and order_people="'.$userid.'"')->setField('order_status', '3');
        if ($isCancel) {
            $this->redirect('User/orderdetail');
        } else {
            $this->error("订单取消失败", 'orderdetail');
        }
    }

    public function confirmorder() {
        $userid = $this->userInfo['user_id'];
        $get = $this->filterAllParam('get');
        $orderobj = M("order");
        $changeorder = array('order_status'=>'2', 'order_paystatus'=>'2', 'order_delivery'=>'2', 'order_receipt'=>'2');
        $isConfirm = $orderobj->where('id = '.$get['id'].' and order_people="'.$userid.'"')->save($changeorder);
        if ($isConfirm) {
            $this->redirect('User/orderdetail');
        } else {
            $this->error("订单确认失败", 'orderdetail');
        }
    }
}