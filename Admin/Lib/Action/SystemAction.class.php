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
            $systemid = $system->add($post);
        }
        $this->redirect('System/showset');
    }
}