<?php

namespace Addons\Message\Controller;
use Home\Controller\AddonsController;

class IndexController extends AddonsController{

    public function index(){

        // $this->display(T('Addons://Message@Index/index'));
    }

    // 添加留言
    public function add(){
        $Message = D('Addons://Message/Message');
        if (IS_POST) {
            $result = $Message->input();
            if ($result) {
                $this->success('咨询成功');
            } else {
                $this->error('失败');
            }
        }
    }

}
