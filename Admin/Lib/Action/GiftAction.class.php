<?php

class GiftAction extends PublicAction {

    public function lists(){
        $gift = M("gift");
        import('ORG.Util.Page');
        $count = $gift->count();
        $page = new Page($count, 10);
        $giftlist = $gift->limit($page->firstRow.','.$page->listRows)->select();
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('giftlist', $giftlist);
        $this->display();
    }

    public function talk(){
        $talk = M("talk");
        import('ORG.Util.Page');
        $count = $talk->count();
        $page = new Page($count, 20);
        $talklist = $talk->limit($page->firstRow.','.$page->listRows)->select();
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('talklist', $talklist);
        $this->display();
    }

    public function showtalk(){
        $tid = $this->_get('tid');
        $talk = M("talk");
        $talkinfo = $talk->where('id='.$tid)->find();
        if (!$talkinfo) {
            $this->redirect('gift/talk');
        }
        $this->assign('talkinfo', $talkinfo);
        $this->display();
    }

    public function showadd(){
        $this->display();
    }
    
    public function modgift() {
        $gid = $this->_get('gid');
        $gift = M("gift");
        $giftinfo = $gift->where('id='.$gid)->find();
        if (!$giftinfo) {
            $this->redirect('gift/lists');
        }
        $this->assign('giftinfo', $giftinfo);
        $this->display();
    }
    
    public function delgift(){
        $gid = $this->_get('gid');
        $gift = M("gift");
        $giftnumber = $gift->where('id='.$gid)->delete();
        $this->redirect('gift/lists');
    }

    public function save(){
        $isnumber = $_POST['gift_number'];
        if (!intval($isnumber)) {
            $this->error('积分请输入数字');
        }
        $userid = $this->userInfo['user_id'];
        $isdelimage = $this->_post('delgift_image');
        if ($isdelimage) {
            $_POST['gift_image'] = '';
            unlink('./upload/'.$isdelimage);
        }
        if ($_FILES['gift_image']['name']) {
            import('ORG.Net.UploadFile');
            $upload = new UploadFile();
            $upload->maxSize = 3145728;//3M
            $upload->allowExts = array('jpg', 'gif', 'png', 'jpeg');
            $upload->savePath = './upload/';
            if(!$upload->upload()) {
                $this->error($upload->getErrorMsg());
            }else{
                $info = $upload->getUploadFileInfo();
            }
            $_POST['gift_image'] = $info[0]['savename'];
        }
        $gift = M("gift");
        $post = $this->filterAllParam('post');
        if (isset($post['id']) && $post['id']) {
            $giftnumber = $gift->where('id='.$post['id'])->save($post);
        } else {
            $giftid = $gift->add($post);
        }
        $this->redirect('gift/lists');
    }
}