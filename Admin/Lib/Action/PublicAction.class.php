<?php

class PublicAction extends Action {

    protected $userInfo = array();

    public function __construct(){
        $this->userInfo = session('userinfo');
        if(empty($this->userInfo)){
            $this->display('Index:showlogin');
            exit;
        }
        if ($this->userInfo['user_type'] == 2) {
            $shop_role = C('SHOP_ROLE');
            if (!isset($shop_role[MODULE_NAME])) {
                $this->error("没有权限");
            }
            if (!in_array(ACTION_NAME, $shop_role[MODULE_NAME])) {
                $this->error("没有权限");
            }
        }
        $this->assign('current_c', MODULE_NAME);
        $this->assign('current_a', ACTION_NAME);
    }
}