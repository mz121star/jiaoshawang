<?php

class AdvertAction extends Action {

    /*
     * call example : http://yourservername/api.php/advert/list
     * call method : get
     */
    public function list_get() {
        $advert = M("advert");
        $lists = $advert->where('advert_status = "1"')->order('advert_addtime desc')->select();
        $advertlist = array();
        foreach ($lists as $a) {
            $a['advert_image'] = 'http://'.$_SERVER['SERVER_NAME'].'/upload/'.$a['advert_image'];
            $advertlist[] = $a;
        }
        $this->response($advertlist, 'json');
    }
}