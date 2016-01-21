<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 李震
// +----------------------------------------------------------------------
namespace Admin\Controller;
use Admin\Model\AuthGroupModel;
use Think\Page;

/**
 * 后台内容控制器
 * @author huajie <banhuajie@163.com>
 */
class VisaController extends AdminController {
    private $site_id        =   null; //文档分类id
    /**
     * 显示左边菜单，进行权限控制
     * @author huajie
     */
     protected function getMenu(){
         //获取站点id
         $site_id        =   I('param.site_id', 0, 'intval');
         //获取动态分类
         $site_auth  =   AuthGroupModel::getAuthSiteies(UID); //获取当前用户所有的内容权限节点
         $site_auth  =   $site_auth == null ? array() : $site_auth;
         $site_list  =   C('SITE_LIST');
         if (!IS_ROOT && !in_array($site_id, $site_auth)) {
             $site_id = 0;
         }
         //没有权限的站点则不显示
         $nodes = array();
         foreach ($site_list as $key=>$val){
             if(IS_ROOT || in_array($key, $site_auth)){
                 $nodes[$key]['title']   =  $val . '站点';
                 $nodes[$key]['url']   =   U('Visa/index', array('site_id'=>$key));
                 if($site_id && $site_id == $key){
                     $nodes[$key]['current'] = 1;
                 }else{
                     $nodes[$key]['current'] = 0;
                 }
             }
         }
         if (!IS_ROOT && empty($site_id)) {
             if (count($nodes)) {
                 $i = 1;
                 foreach ($nodes as $key => $value) {
                     if ($i == 1) {
                         $site_id = $key;
                         $nodes[$key]['current'] = 1;
                         break;
                     }
                     $i++;
                 }
             } else {
                 $this->redirect('Visa/index');
             }
         }
         $this->assign('nodes', $nodes);
         $this->site_id = $site_id;
         $this->assign('site_id', $site_id);
     }

    /**
     * 分类文档列表页
     * @param integer $cate_id 分类id
     * @param integer $model_id 模型id
     * @param integer $position 推荐标志
     * @param integer $group_id 分组id
     */
    public function index(){
        //获取左边菜单
        $this->getMenu();

        if ($this->site_id) {
            $map['site_id'] = $this->site_id;
        }
        $title = I('title');
        if(is_numeric($title)){
            $map['visa_id|title'] = array(intval($title),array('like','%'.$title.'%'),'_multi'=>true);
        }else{
            $map['title'] = array('like', '%'.(string)$title.'%');
        }
        $l_type = I('l_type', null);
        if(!is_null($l_type)){
            $map['l_type'] = $l_type;
        }

        $sub_ids = C('QZ_TYPE');
        $list = $this->lists('Visa', $map, 'status desc, visa_id desc');
        foreach($list as $k=>$val){
           $list[$k]['sub_id'] = $sub_ids[$val['sub_id']];
        }
        int_to_string($list);
        $this->assign('_list', $list);
        $this->meta_title = '签证';
        $this->display();
    }
    /**
     * 文档编辑页面初始化
     */
    public function edit(){
        //获取左边菜单
        $visa_id = I('get.visa_id');
        $Visa = D('Visa');

        if (IS_POST) {
        $res = $Visa->update();
         if($res){
          $this->success('成功', U('index'));
         }else{
          $this->error($Visa->getError());
         }

    		}else{
          $this->getMenu();
           $Visa = M('Visa');

           $map = array();
           $map['visa_id'] = $visa_id;
           $data = $Visa->where($map)->find();
           $this->assign('data', $data);//签证信息



           $Visa_cate = M('Visa_cate');
           $catelist = $Visa_cate->where(array('pid'=>0))->select();
           $this->assign('catelist', $catelist);//栏目

           if($data['zone']){
              $catelist2 = $Visa_cate->where(array('pid'=>$data['visa_catid']))->select();
              $this->assign('catelist2', $catelist2);//栏目
           }

           $qz_list = C('QZ_TYPE');//签证类别
           $this->assign('qz_list', $qz_list);
           $qzh_list = C('QZH_TYPE');//签注类别
           $this->assign('qzh_list', $qzh_list);
           $this->meta_title   =   '快速创建签证';
           $this->display();
    		}
    }

    public function changeStatus(){
            $data['status'] = I('get.status');
            $data['visa_id'] = I('get.visa_id');
            if(empty($data['visa_id'])){
                 $this->success('非法参数');
            }
            $Visa = M('Visa');
            $res = $Visa->save($data);
            if($res){
               $this->success('成功');
            }else{
               $this->error('失败');
            }
    }

  public function zone_ajax(){

            $pid = I('get.pid');
            $Visa_cate = M('VisaCate');
            if(empty($pid)){
              $catelist = array();
            }else{
              $catelist = $Visa_cate->where(array('pid'=>$pid))->select();
            }

            $this->assign('catelist', $catelist);

            $this->display();
    }



}
