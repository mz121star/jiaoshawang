<?php

class UserAction extends PublicAction {

    public function lists(){
        $type = $this->_get("type", 2);
        if (!in_array($type, array('2', '3'))) {
            $type = 2;
        }
        $user = M("User");
        $userlist = $user->where('type='.$type)->field('id,userid,username,email,phone,status,type')->order(array('id'=>'desc'))->select();
        $this->assign('userlist', $userlist);
        $this->display();
    }

    public function showadd(){
        $this->display();
    }

    public function add(){
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize = 3145728;//3M
        $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
        $upload->savePath = './Uploads/';
        if(!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        }else{
            $info = $upload->getUploadFileInfo();
        }
        $user = M("User");
        $_POST['password'] = md5($_POST['password']);
        $_POST['image'] = $info[0]['savename'];
        $userid = $user->add($_POST);
        if ($userid) {
            $this->redirect('User/lists');
        } else {
            $this->error("用户添加失败", 'User/showadd');
        }
    }
}