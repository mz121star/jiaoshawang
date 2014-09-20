<?php

class CommentAction extends PublicAction {

    public function add() {
        $shopid = $this->_post('shopid');
        $userid = $this->userInfo['user_id'];
        if (!$userid) {
            $this->error('请登录后评论');
        }
        $order = M("order");
        $user_order_number = $order->where(array('order_people'=>$userid))->count();
        if (!$user_order_number) {
            $this->error('没买过这家就呗BB');
        }
        $comment = M("comment");
        $insert['comment_content'] = $this->_post('content');
        $insert['comment_date'] = date('Y-m-d H:i:s');
        $insert['people_id'] = $userid;
        $insert['shop_id'] = $shopid;
        $commentid = $comment->add($insert);
        if ($commentid) {
            $this->redirect('shop/detail/'.$shopid);
        } else {
            $this->error('评论失败', 'shop/detail/'.$shopid);
        }
    }

    public function lists() {
        $userid = $this->userInfo['user_id'];
        $shopid = $this->_get('shopid');
        $comment = M("comment");
        $commentlist = $comment->where('shop_id="'.$shopid.'"')->field('people_name, people_id, shop_id, comment_content, comment_date')->join(' dc_people on dc_people.user_id = dc_comment.people_id')->select();
        $this->assign('commentlist', $commentlist);

        $shop = M("Shop");
        $shopinfo = $shop->where('user_id="'.$shopid.'"')->find();
        $this->assign('shopinfo', $shopinfo);
        $this->display();
    }
}