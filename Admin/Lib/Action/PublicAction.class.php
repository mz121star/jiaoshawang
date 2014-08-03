<?php

class PublicAction extends Action {

    protected $userInfo = array();

    public function __construct(){
        $this->userInfo = session('userinfo');
        if(empty($this->userInfo)){
            $this->display('Index:showlogin');
            exit;
        }
    }
}