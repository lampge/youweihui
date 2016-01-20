<?php
namespace Home\Controller;
/**
 * 前台签证控制器
 */
class VisaController extends HomeController {

    // 签证列表
    public function index(){
            $catid = I('get.catid','');
            $pageNum = 6;
            $nowPage =  I('get.p',1);
            $firstRow = ($nowPage-1)*$pageNum;

            $map = array();
            $map['visa_catid'] = $catid;
            $map['status'] = 1;
            $Visa = M('Visa');
            $visa_lists = $Visa->where($map)->order('sort asc,update_time desc')->limit($firstRow,$pageNum)->select();
            foreach($visa_lists as $k=>$val){
                   $visa_lists[$k]['is_yaoqing'] = $val['is_yaoqing']?'需要':'不需要';
                   $visa_lists[$k]['is_mianshi'] = $val['is_mianshi']?'需要':'不需要';
                   $visa_lists[$k]['url'] = U('Visa/show',array('id'=>$val['visa_id']));
                   $visa_lists[$k]['image'] = get_cover($val['cover_id'],'path');
            }

            $count = $Visa->where($map)->count();
            $page = article_pages($count,$pageNum);
            $this->assign('visa_lists',$visa_lists);
            $this->assign('_page',$page);
            $this->display();
    }

    // 签证详情
    public function show(){
            $visa_id = I('get.id');
            if(empty($visa_id)){
              $this->error();
            }
            $Visa = M('Visa');
            $map = array();
            $map['visa_id'] = $visa_id;
            $map['status'] = 1;
            $detail = $Visa->where($map)->find();
            $detail['image'] = get_cover($detail['cover_id'],'path');
            $detail['is_yaoqing'] = $detail['is_yaoqing']?'需要':'不需要';
            $detail['is_mianshi'] = $detail['is_mianshi']?'需要':'不需要';
            $this->assign('detail',$detail);
            $this->display();
    }


}
