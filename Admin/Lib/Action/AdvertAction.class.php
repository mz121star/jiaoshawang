<?php

class AdvertAction extends PublicAction {

    public function lists(){
        $advert = M("advert");
        import('ORG.Util.Page');
        $count = $advert->count();
        $page = new Page($count, 10);
        $advertlist = $advert->limit($page->firstRow.','.$page->listRows)->select();
        $show = $page->show();
        $this->assign('page',$show);
        $this->assign('advertlist', $advertlist);
        $this->display();
    }

    public function showadd(){
        $this->display();
    }
    
    public function modadvert() {
        $aid = $this->_get('aid');
        $advert = M("advert");
        $advertinfo = $advert->where('id='.$aid)->find();
        if (!$advertinfo) {
            $this->redirect('advert/lists');
        }
        $this->assign('advertinfo', $advertinfo);
        $this->display();
    }

    public function stopadvert() {
        $aid = $this->_get('aid');
        $advert = M("advert");
        $advert->where('id="'.$aid.'"')->setField('advert_status', '0');
        $this->redirect('advert/lists');
    }

    public function startadvert() {
        $aid = $this->_get('aid');
        $advert = M("advert");
        $advert->where('id="'.$aid.'"')->setField('advert_status', '1');
        $this->redirect('advert/lists');
    }
    
    public function deladvert(){
        $aid = $this->_get('aid');
        $advert = M("advert");
        $advertnumber = $advert->where('id='.$aid)->delete();
        $this->redirect('advert/lists');
    }

    public function save(){
        $userid = $this->userInfo['user_id'];
        $isdelimage = $this->_post('deladvert_image');
        if ($isdelimage) {
            $_POST['advert_image'] = '';
            unlink('./upload/'.$isdelimage);
        }
        if ($_FILES['advert_image']['name']) {
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
            $_POST['advert_image'] = $info[0]['savename'];
        }
        $advert = M("advert");
        $post = $this->filterAllParam('post');
        $post['advert_content'] = $_POST['advert_content'];
        if (isset($post['id']) && $post['id']) {
            $advertnumber = $advert->where('id='.$post['id'])->save($post);
        } else {
            $post['advert_addtime'] = date('Y-m-d H:i:s');
            $advertid = $advert->add($post);
        }
        $this->redirect('advert/lists');
    }
}