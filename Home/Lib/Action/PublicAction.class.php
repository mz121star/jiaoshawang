<?php

class PublicAction extends Action {

    protected $userInfo = array();

    function __construct(){
        $this->userInfo = session('userinfo');
    }
}