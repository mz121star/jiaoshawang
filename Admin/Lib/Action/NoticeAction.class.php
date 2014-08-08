<?php

class NoticeAction extends PublicAction {

    public function lists(){
        $shopnotice = M("shopnotice");
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        import('ORG.Util.Page');
        if ($usertype == 1) {
            $count = $shopnotice->count();
            $page = new Page($count, 10);
            $noticelist = $shopnotice->field('id,notice_title,notice_date')->order(array('id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        } else {
            $count = $shopnotice->where('user_id="'.$userid.'"')->count();
            $page = new Page($count, 10);
            $noticelist = $shopnotice->where('user_id="'.$userid.'"')->field('id,notice_title,notice_date')->order(array('id'=>'desc'))->limit($page->firstRow.','.$page->listRows)->select();
        }
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('noticelist', $noticelist);
        $this->display();
    }

    public function showadd(){
        $usertype = $this->userInfo['user_type'];
         if ($usertype == 1) {
             $this->redirect('Notice/lists');
         }
        $this->display();
    }
    
    public function modnotice() {
        $noticeid = $this->_get('noticeid');
        $userid = $this->userInfo['user_id'];
        $shopnotice = M("shopnotice");
        $noticeinfo = $shopnotice->where('id='.$noticeid.' and user_id="'.$userid.'"')->find();
        if (!$noticeinfo) {
            $this->redirect('Notice/lists');
        }
        $this->assign('noticeinfo', $noticeinfo);
        $this->display();
    }
    
    public function delnotice(){
        $noticeid = $this->_get('noticeid');
        $userid = $this->userInfo['user_id'];
        $usertype = $this->userInfo['user_type'];
        $shopnotice = M("shopnotice");
        if ($usertype == 1) {
            $noticenumber = $shopnotice->where('id='.$foodid)->delete();
            $this->redirect('Notice/lists');
        }
        $noticeinfo = $shopnotice->where('id='.$noticeid.' and user_id="'.$userid.'"')->find();
        if ($noticeinfo) {
            $noticenumber = $shopnotice->where('id='.$noticeid.' and user_id="'.$userid.'"')->delete();
            if ($noticenumber) {
                $this->redirect('Notice/lists');
            } else {
                $this->error("删除公告失败", 'lists');
            }
        } else {
            $this->error("删除公告失败", 'lists');
        }
    }

    public function save(){
        $userid = $this->userInfo['user_id'];
        $shopnotice = M("shopnotice");
        $post = $this->filterAllParam('post');
        if (!isset($post['notice_top'])) {
            $post['notice_top'] = 0;
        }
        $post['user_id'] = $userid;
        if (isset($post['id']) && $post['id']) {
            $noticenumber = $shopnotice->where('id='.$post['id'].' and user_id="'.$userid.'"')->save($post);
        } else {
            $post['notice_date'] = date('Y-m-d H:i:s');
            $noticeid = $shopnotice->add($post);
        }
        $this->redirect('Notice/lists');
    }
}