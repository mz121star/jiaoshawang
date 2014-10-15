<?php

class GiftAction extends PublicAction {

    public function lists(){
        $userid = $this->userInfo['user_id'];
        if (!$userid) {
            $this->error('请先登录');
        }
        $gift = M("gift");
        $giftlist = $gift->select();
        $this->assign('giftlist', $giftlist);
        $this->display();
    }
    
    public function buygift() {
        $gid = $this->_get('gid');
        $gift = M("gift");
        $giftinfo = $gift->where('id='.$gid)->find();
        if (!$giftinfo) {
            $this->error('礼品已下架');
        }
        $this->assign('giftinfo', $giftinfo);
        $this->display();
    }
    
    public function exchange() {
        $userid = $this->userInfo['user_id'];
        if (!$userid) {
            $this->error('请先登录');
        }
        $post = $this->filterAllParam('post');
        if (!$post['exchange_addr']) {
            $this->error('请填写收货地址');
        }
        $people = M('people');
        $userinfo = $people->field('people_point')->where('user_id = "'.$userid.'"')->find();
        if ($post['exchange_number'] > $userinfo['people_point']) {
            $this->error('积分不足');
        }
        $post['people_id'] = $userid;
        $post['exchange_date'] = date('Y-m-d H:i:s');
        $giftexchange = M("giftexchange");
        $id = $giftexchange->add($post);
        if ($id) {
            $newnumber = $userinfo['people_point'] - $post['exchange_number'];
            $isok = $people->where('user_id = "'.$userid.'"')->setField('people_point', $newnumber);
            if ($isok) {
                $this->userInfo['people_point'] = $newnumber;
                session('userinfo', $this->userInfo);
                $this->success('兑换成功', 'lists');
            } else {
                $giftexchange->where('id = "'.$id.'"')->delete();
                $this->error('积分兑换失败');
            }
        } else {
            $this->error('礼品兑换失败');
        }
    }
}