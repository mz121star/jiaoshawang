<?php

class UserAction extends PublicAction {

    public function shoplist(){
        $shop = M("Shop");
        import('ORG.Util.Page');
        $count = $shop->count();
        $page = new Page($count, 10);
        $show = $page->show();
        $userlist = $shop->join(' dc_user ON dc_user.user_id = dc_shop.user_id')->field('dc_user.user_id,shop_name,shop_email,shop_phone,shop_top,user_status')->order(array('dc_user.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('userlist', $userlist);
        $this->assign('page',$show);
        $this->display();
    }

    public function peoplelist(){
        $people = M("People");
        import('ORG.Util.Page');
        $count = $people->count();
        $page = new Page($count, 10);
        $show = $page->show();
        $userlist = $people->join(' dc_user ON dc_user.user_id = dc_people.user_id')->field('dc_user.user_id,people_name,people_phone,people_point,user_status')->order(array('dc_user.id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        $this->assign('userlist', $userlist);
        $this->assign('page',$show);
        $this->display();
    }

    public function showadd(){
        $this->display();
    }

    public function modpw(){
        $userid = $this->_get('userid');
        $this->assign('userid', $userid);
        $from = $this->_get('from');
        $this->assign('from', $from);
        $this->display();
    }

    public function uppw(){
        $userid = $this->_post('userid');
        if ($userid == 'admin') {
            $this->error("没有权限");
        }
        $user_pw = $this->_post('user_pw');
        $user_pw = md5($user_pw);
        $from = $this->_post('from');
        $user = M("User");
        $isok = $user->where('user_id = "'.$userid.'"')->setField('user_pw', $user_pw);
        if ($isok) {
            if ($from == 'shop') {
                $this->success("修改成功", U('user/shoplist'));
            } else {
                $this->success("修改成功", U('user/peoplelist'));
            }
        } else {
            $this->error("修改失败，请重试");
        }
    }

    public function modshop(){
        $userid = $this->_get('userid');
        $shop = M("Shop");
        $shopinfo = $shop->where('user_id="'.$userid.'"')->find();
        $beginworktime = explode(':', $shopinfo['shop_beginworktime']);
        $shopinfo['shop_beginworktime1'] = $beginworktime[0];
        $shopinfo['shop_beginworktime2'] = $beginworktime[1];
        $endworktime = explode(':', $shopinfo['shop_endworktime']);
        $shopinfo['shop_endworktime1'] = $endworktime[0];
        $shopinfo['shop_endworktime2'] = $endworktime[1];
        $this->assign('shopinfo', $shopinfo);
        $shoptype = M("Shoptype");
        $typelist = $shoptype->order(array('type_order'=>'asc'))->select();
        $this->assign('typelist', $typelist);
        $this->display();
    }
    
    public function modself(){
        $userid = $this->userInfo['user_id'];
        $shop = M("Shop");
        $shopinfo = $shop->where('user_id="'.$userid.'"')->find();
        $beginworktime = explode(':', $shopinfo['shop_beginworktime']);
        $shopinfo['shop_beginworktime1'] = $beginworktime[0];
        $shopinfo['shop_beginworktime2'] = $beginworktime[1];
        $endworktime = explode(':', $shopinfo['shop_endworktime']);
        $shopinfo['shop_endworktime1'] = $endworktime[0];
        $shopinfo['shop_endworktime2'] = $endworktime[1];
        $this->assign('shopinfo', $shopinfo);
        $this->display();
    }
    
    public function upself(){
        $userid = $this->userInfo['user_id'];
        $user_pw = $this->_post('user_pw');
        if ($user_pw) {
            $user = M("User");
            $infonum = $user->where('user_id="'.$userid.'"')->setField('user_pw', md5($user_pw));
            if ($infonum) {
                $this->error('修改成功');
            } else {
                $this->error('修改失败');
            }
        } else {
            $this->error('请填写密码');
        }
//        $isdelimage = $this->_post('delshop_image');
//        if ($isdelimage) {
//            $_POST['shop_image'] = '';
//            unlink('./upload/'.$isdelimage);
//        }
//        if ($_FILES['shop_image']['name']) {
//            import('ORG.Net.UploadFile');
//            $upload = new UploadFile();
//            $upload->maxSize = 3145728;//3M
//            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
//            $upload->savePath = './upload/';
//            if(!$upload->upload()) {
//                $this->error($upload->getErrorMsg());
//            }else{
//                $info = $upload->getUploadFileInfo();
//            }
//            $_POST['shop_image'] = $info[0]['savename'];
//        }
//        $shop = M("Shop");
//        $post = $this->filterAllParam('post');
//        $post['shop_beginworktime'] = intval($post['shop_beginworktime1']).':'.intval($post['shop_beginworktime2']);
//        $post['shop_endworktime'] = intval($post['shop_endworktime1']).':'.intval($post['shop_endworktime2']);
//        $shop->where('user_id="'.$userid.'"')->save($post);
        $this->redirect('User/modself');
    }

    public function upshop() {
        $isdelimage = $this->_post('delshop_image');
        if ($isdelimage) {
            $_POST['shop_image'] = '';
            unlink('./upload/'.$isdelimage);
        }
        if ($_FILES['shop_image']['name']) {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize = 3145728;//3M
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->savePath = './upload/';
            if(!$upload->upload()) {
                $this->error($upload->getErrorMsg());
            }else{
                $info = $upload->getUploadFileInfo();
            }
            $_POST['shop_image'] = $info[0]['savename'];
        }
        $shop = M("Shop");
        $post = $this->filterAllParam('post');
        if (!isset($post['shop_top']) || !$post['shop_top']) {
            $post['shop_top'] = "0";
        }
        $post['shop_beginworktime'] = intval($post['shop_beginworktime1']).':'.intval($post['shop_beginworktime2']);
        $post['shop_endworktime'] = intval($post['shop_endworktime1']).':'.intval($post['shop_endworktime2']);
        $shop->where('user_id="'.$post['user_id'].'"')->save($post);
        $this->redirect('User/shoplist');
    }

    public function delshop(){
        $userid = $this->_get('userid');
        $user = M("User");
        $usernumber = $user->where('user_id="'.$userid.'"')->find();
        if ($usernumber) {
            $user->where('user_id="'.$userid.'"')->delete();
            $shop = M("Shop");
            $shop->where('user_id="'.$userid.'"')->delete();
            $food = M("Food");
            $food->where('user_id="'.$userid.'"')->delete();
            $this->redirect('User/shoplist');
        } else {
            $this->error("删除商户失败", 'shoplist');
        }
    }

    public function modpeople(){
        $userid = $this->_get('userid');
        $people = M("People");
        $peopleinfo = $people->where('user_id="'.$userid.'"')->find();
        $this->assign('peopleinfo', $peopleinfo);
        $this->display();
    }

    public function uppeople() {
        $people = M("People");
        $post = $this->filterAllParam('post');
        $people->where('user_id="'.$post['user_id'].'"')->save($post);
        $this->redirect('User/peoplelist');
    }

    public function delpeople(){
        $userid = $this->_get('userid');
        $user = M("User");
        $usernumber = $user->where('user_id="'.$userid.'"')->setField('user_status', '0');
        if ($usernumber) {
            $this->redirect('User/peoplelist');
        } else {
            $this->error("删除用户失败", 'peoplelist');
        }
    }

    public function upstatus() {
        $userid = $this->_get('userid');
        $status = $this->_get('status');
        $user = M("User");
        $user->where('user_id="'.$userid.'"')->setField('user_status', $status);
        $this->redirect('User/shoplist');
    }

    public function topshop() {
        $userid = $this->_get('userid');
        $shop = M("Shop");
        $shop->where('user_id="'.$userid.'"')->setField('shop_top', '1');
        $this->redirect('User/shoplist');
    }

    public function topcancel() {
        $userid = $this->_get('userid');
        $shop = M("Shop");
        $shop->where('user_id="'.$userid.'"')->setField('shop_top', '0');
        $this->redirect('User/shoplist');
    }

    public function add(){
        $user = M("User");
        $_POST['user_pw'] = md5($_POST['user_pw']);
        $post = $this->filterAllParam('post');
        $userInfo = $user->where('user_id="'.$post['user_id'].'"')->field('id')->find();
        if ($userInfo) {
            $this->error("用户ID已存在", 'showadd');
        }
        $userid = $user->add($post);
        if ($userid) {
            if ($post['user_type'] == 2) {
                $shop = M("Shop");
                $shop->add(array('user_id'=>$post['user_id']));
                $this->redirect('User/shoplist');
            } else {
                $people = M("People");
                $people->add(array('user_id'=>$post['user_id']));
                $this->redirect('User/peoplelist');
            }
        } else {
            $this->error("用户添加失败", 'showadd');
        }
    }

    public function shoptype(){
        $shoptype = M("Shoptype");
        if ($this->isPost()){
            $post = $this->filterAllParam('post');
            if ($post['id']) {
                $shoptype->save($post);
            } else {
                $shoptype->add($post);
            }
        } else {
            $get = $this->filterAllParam('get');
            if ($get['typeid']) {
                $shoptype->where('id = '.$get['typeid'])->delete();
            }
        }
        $typelist = $shoptype->order(array('id'=>'desc'))->select();
        $this->assign('typelist', $typelist);
        $this->display();
    }
}