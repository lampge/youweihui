<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;

/**
 * 线路
 */
class LineModel extends Model{

    protected $_validate = array(
        array('site_id', 'require', '所属站点不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('title', 'require', '主标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('sub_title', 'require', '副标题不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('l_type', 'require', '线路类型不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('ct_type', 'require', '参团类型不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('categorys', 'require', '产品分类不能为空', self::VALUE_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('earlier_date', 'require', '游客需提前几天报名不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('daynum', 'require', '行程天数不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('traffic', 'require', '交通方式不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('starting', 'require', '出发地不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('dest', 'require', '目的地不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('images', 'imagesCalback', self::MODEL_BOTH, 'callback'),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_BOTH),
    );

    protected function imagesCalback($data){
        if ($data) {
            return implode(',', (array) $data);
        } else {
            return '';
        }
    }


    public function update(){
        $data = $this->create();
        if(!$data){ //数据对象创建错误
            return false;
        }
        /* 添加或更新数据 */
        if(empty($data['line_id'])){
            $res = $this->add();
        }else{
            $res = $this->save();
        }
        return $res;
    }


}
