<?php

class CommentAction extends Action {

    /*
     * call example : http://yourservername/api.php/comment/list?sid=test
     * call method : get
     */
    public function list_get() {
        $shop_id = htmlspecialchars($_GET['sid']);
        if (!$shop_id) {
            $this->response(array('message' => '请选择要查看评论的商户'), 'json');
        }
        $comment = M("comment");
        $lists = $comment->where('shop_id = "'.$shop_id.'"')->select();
        $people = M("people");
        $commentlist = array();
        foreach ($lists as $c) {
            $userinfo = $people->where('user_id = "'.$c['people_id'].'"')->find();
            $c['people_name'] = $userinfo['people_name'];
            $commentlist[] = $c;
        }
        $this->response($commentlist, 'json');
    }
    
    /*
     * call example : http://yourservername/api.php/comment/save
     * call method : post
     */
    public function save_post() {
        $data['people_id'] = htmlspecialchars($_POST['uid']);
        $data['shop_id'] = htmlspecialchars($_POST['sid']);
        $data['comment_content'] = htmlspecialchars($_POST['content']);
        $data['comment_star'] = htmlspecialchars($_POST['star']);
        $data['comment_date'] = date('Y-m-d H:i:s');
        if (!$data['people_id'] || !$data['shop_id'] || !$data['comment_content'] || !$data['comment_star']) {
            $this->response(array('message' => '提交的信息不全'), 'json');
        }
        $comment = M("comment");
        $cid = $comment->add($data);
        if ($cid) {
            $this->response(array('message' => '评论成功'), 'json');
        } else {
            $this->response(array('message' => '评论失败'), 'json');
        }
    }

}