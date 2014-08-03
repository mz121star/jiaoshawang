<?php

class FoodAction extends PublicAction {

    public function lists(){
        $user = M("Admin");
        $userlist = $user->where('type!=1')->field('id,username,email,phone,status,type')->order(array('id'=>'desc'))->select();
        $this->assign('userlist', $userlist);
        $this->display();
    }

    public function showadd(){
        $this->display();
    }

    public function add(){
        $this->redirect('User/lists');
    }
}