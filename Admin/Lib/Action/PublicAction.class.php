<?php

class PublicAction extends Action {

    protected $userInfo = array();

    public function __construct(){
        $this->userInfo = session('userinfo');
        if(empty($this->userInfo)){
            $this->display('Index:showlogin');
            exit;
        }
        $this->assign('current_c', MODULE_NAME);
        $this->assign('current_a', ACTION_NAME);
    }
}