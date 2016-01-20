<?php
namespace Home\Controller;
/**
 * 前台签证控制器
 */
class VisaController extends HomeController {

    // 签证列表
    public function index(){
            $catid = I('get.catid','');
            $zone = I('get.zone','');
            $sub_id = I('get.sub_id','');
            $pageNum = 6;
            $nowPage =  I('get.p',1);
            $firstRow = ($nowPage-1)*$pageNum;

            $map = array();
            $map['visa_catid'] = $catid;
            $map['zone'] = $zone;
            $map['sub_id'] = $sub_id;
            $map['_logic'] = 'OR';
            $where['_complex'] = $map;
            $where['status'] = 1;

            $Visa = M('Visa');
            $visa_lists = $Visa->where($where)->order('sort asc,update_time desc')->limit($firstRow,$pageNum)->select();
            foreach($visa_lists as $k=>$val){
                   $visa_lists[$k]['is_yaoqing'] = $val['is_yaoqing']?'需要':'不需要';
                   $visa_lists[$k]['is_mianshi'] = $val['is_mianshi']?'需要':'不需要';
                   $visa_lists[$k]['url'] = U('Visa/show',array('id'=>$val['visa_id']));
                   $visa_lists[$k]['image'] = get_cover($val['cover_id'],'path');
                   $visa_lists[$k]['zone'] = get_visa_field($val['zone'],'title');
            }

            $count = $Visa->where($where)->count();
            $page = article_pages($count,$pageNum);
            $sub_ids = C(QZ_TYPE);
            $this->assign('sub_ids',$sub_ids);
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
