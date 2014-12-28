<?php

class FoodAction extends Action {

    /*
     * call example : http://yourservername/api.php/food/detail?id=2
     * call method : get
     */
    public function detail_get(){
        $food_id = htmlspecialchars($_GET['id']);
        if (!$food_id) {
            $this->response(array('message' => '无此菜肴'), 'json');
        }
        $food = M("food");
        $fooddetail = $food->where('id = "'.$food_id.'"')->find();
        if ($fooddetail) {
            $this->response($fooddetail, 'json');
        } else {
            $this->response(array('message' => '无此菜肴'), 'json');
        }
    }

    /*
     * call example : http://yourservername/api.php/food/list?id=test
     * call method : get
     */
    public function list_get() {
        $shop_user_id = htmlspecialchars($_GET['id']);
        if (!$shop_user_id) {
            $this->response(array('message' => '请选择要查看的商户'), 'json');
        }
        $food = M("food");
        $foodlist = $food->where('user_id = "'.$shop_user_id.'"')->select();
        $this->response($foodlist, 'json');
    }

    /*
     * call example : http://yourservername/api.php/food/typelist?id=test
     * call method : get
     */
    public function typelist_get() {
        $user_id = htmlspecialchars($_GET['id']);
        if (!$user_id) {
            $this->response(array('message' => '请选择要查看的商户'), 'json');
        }
        $foodtype = M("foodtype");
        $typelist = $foodtype->where('user_id = "'.$user_id.'"')->select();
        $this->response($typelist, 'json');
    }

    /*
     * call example : http://yourservername/api.php/food/getfoodbytype?id=1
     * call method : get
     */
    public function getfoodbytype_get() {
        $type_id = htmlspecialchars($_GET['id']);
        if (!$type_id) {
            $this->response(array('message' => '请选择要查看的类型'), 'json');
        }
        $food = M("food");
        $foodlist = $food->where('type_id = "'.$type_id.'"')->select();
        $this->response($foodlist, 'json');
    }
}