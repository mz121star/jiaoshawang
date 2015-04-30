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
            $upload->savePath = './upload/ad/';
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
    
    public function showtype() {
        $shoptype = M("shoptype");
        $systypeinfo = $shoptype->select();
        $this->assign('typeinfo', $systypeinfo);
        
        $toptype = $shoptype->where('is_top = "1"')->select();
        $this->assign('toptype', $toptype);
        $this->display();
    }

    public function shownav() {
        $nav = M("nav");
        if ($this->isPost()){
            $nav_name = $this->_post('nav_name');
            $nav_phone = $this->_post('nav_phone');
            $nav_type = $this->_post('nav_type');
            if (!$nav_name) {
                $this->error("请填写名称");
            }
            if (!$nav_phone) {
                $this->error("请填写电话");
            }
            if (!$nav_type) {
                $this->error("请填写类别");
            }
            $nav->add(array('nav_name'=>$nav_name,'nav_phone'=>$nav_phone,'nav_type'=>$nav_type));
        }
        
        $shoptype = M("shoptype");
        $systypeinfo = $shoptype->where('is_top ="1"')->select();
        $this->assign('typeinfo', $systypeinfo);

        $navlist = $nav->select();
        $this->assign('navlist', $navlist);
        $this->display();
    }

    public function delnav() {
        $nav = M("nav");
        $navid = $this->_get('navid');
        $isok = $nav->where('id = "'.$navid.'"')->delete();
        if ($isok) {
            $this->success("删除成功");
        } else {
            $this->error("删除失败");
        }
    }

    public function savetype() {
        $post = $this->filterAllParam('post');
        $shoptype = M("shoptype");
        if (!isset($post['oldtop'])) {
            $post['oldtop'] = array();
        }
        if (!isset($post['is_top'])) {
            $post['is_top'] = array();
        }
        $deletetop = array_diff($post['oldtop'], $post['is_top']);
        $newtop = array_diff($post['is_top'], $post['oldtop']);
        foreach ($newtop as $value1) {
            $shoptype->where('id = "'.$value1.'"')->setField('is_top', '1');
        }
        foreach ($deletetop as $value2) {
            $shoptype->where('id = "'.$value2.'"')->setField('is_top', '0');
        }
        $this->success('修改成功', U('System/showtype'));
    }
}