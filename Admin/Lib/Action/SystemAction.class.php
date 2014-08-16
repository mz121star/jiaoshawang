<?php

class SystemAction extends PublicAction {

    public function showset(){
        $system = M("system");
        $sysinfo = $system->find();
        $this->assign('sysinfo', $sysinfo);
        $this->display();
    }

    public function setting(){
        $system = M("system");
        $post = $this->filterAllParam('post');
        if (isset($post['id']) && $post['id']) {
            $systemnumber = $system->where('id='.$post['id'])->save($post);
        } else {
            $post['id'] = $system->add($post);
        }
        $this->redirect('System/showset');
    }

    public function showimage() {
        $system = M("systempic");
        $syspicinfo = $system->select();
        $this->assign('syspicinfo', $syspicinfo);
        $this->display();
    }

    public function setimage() {
        $post = $this->filterAllParam('post');
        $isdelimage = $post['del_image'];
        $del_image = array();
        if (count($isdelimage)) {
            foreach ($isdelimage as $key => $value) {
                $del_image[] = $key;
                unlink('./upload/ad/'.$value);
            }
        }
        $system = M("systempic");
        foreach ($del_image as $id) {
            $system->where('id='.$id)->delete();
        }

        $isUpload = 0;
        foreach ($_FILES['system_pic']['name'] as $name) {
            if ($name) {
                $isUpload = 1;
                break;
            }
        }
        if ($isUpload) {
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
        }
        foreach ($info as $key => $value) {
            $system->add(array('system_pic'=>$value['savename']));
        }
        $this->redirect('System/showimage');
    }
}