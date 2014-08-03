<?php

class OrderAction extends PublicAction {

    public function lists(){
        $user = M("Admin");
        $userlist = $user->where('type!=1')->field('id,username,email,phone,status,type')->order(array('id'=>'desc'))->select();
        $this->assign('userlist', $userlist);
        $this->display();
    }
}