<?php

class UserAction extends PublicAction {

    public function shoplist(){
        $shop = M("Shop");
        $userlist = $shop->join(' dc_user ON dc_user.user_id = dc_shop.user_id')->field('dc_user.user_id,shop_name,shop_email,shop_phone,user_status')->order(array('dc_user.id'=>'desc'))->select();
        $this->assign('userlist', $userlist);
        $this->display();
    }

    public function peoplelist(){
        $people = M("People");
        $userlist = $people->join(' dc_user ON dc_user.user_id = dc_people.user_id')->field('dc_user.user_id,people_name,people_phone,user_status')->order(array('dc_user.id'=>'desc'))->select();
        $this->assign('userlist', $userlist);
        $this->display();
    }

    public function showadd(){
        $this->display();
    }

    public function modshop(){
        $userid = $this->_get('userid');
        $shop = M("Shop");
        $shopinfo = $shop->where('user_id="'.$userid.'"')->find();
        $this->assign('shopinfo', $shopinfo);
        $this->display();
    }

    public function upshop() {
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
        $shop->where('user_id="'.$_POST['user_id'].'"')->save($_POST);
        $this->redirect('User/shoplist');
    }

    public function delshop(){
        $userid = $this->_get('userid');
        $shop = M("Shop");
        $shopnumber = $shop->where('user_id="'.$userid.'"')->delete();
        if ($shopnumber) {
            $user = M("User");
            $usernumber = $user->where('user_id="'.$userid.'"')->delete();
            if ($usernumber) {
                $this->redirect('User/shoplist');
            } else {
                $this->error("删除商户失败", 'shoplist');
            }
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
        $people->where('user_id="'.$_POST['user_id'].'"')->save($_POST);
        $this->redirect('User/peoplelist');
    }

    public function delpeople(){
        $userid = $this->_get('userid');
        $people = M("People");
        $peoplenumber = $people->where('user_id="'.$userid.'"')->delete();
        if ($peoplenumber) {
            $user = M("User");
            $usernumber = $user->where('user_id="'.$userid.'"')->delete();
            if ($usernumber) {
                $this->redirect('User/peoplelist');
            } else {
                $this->error("删除用户失败", 'peoplelist');
            }
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

    public function add(){
        $user = M("User");
        $userInfo = $user->where('user_id="'.$_POST['user_id'].'"')->field('id')->find();
        if ($userInfo) {
            $this->error("用户ID已存在", 'showadd');
        }
        $_POST['user_pw'] = md5($_POST['user_pw']);
        $userid = $user->add($_POST);
        if ($userid) {
            if ($_POST['user_type'] == 2) {
                $shop = M("Shop");
                $shop->add(array('user_id'=>$_POST['user_id']));
                $this->redirect('User/shoplist');
            } else {
                $people = M("People");
                $people->add(array('user_id'=>$_POST['user_id']));
                $this->redirect('User/peoplelist');
            }
        } else {
            $this->error("用户添加失败", 'showadd');
        }
    }
}