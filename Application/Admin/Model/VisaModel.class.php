<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;
use Admin\Model\AuthGroupModel;

/**
 * 文档基础模型
 */
class VisaModel extends Model{

    /* 自动验证规则 */
    protected $_validate = array(
        array('site_id', 'require', '所属站点不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('title', 'require', '标题不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('zone', 'require', '国家不能为空', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('visa_catid', 'require','请选择产品分类', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),

        array('sub_id', 'require', '请选择签证类别', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('ly_type', 'require', '请选择签注类别', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('work_time', 'require', '请填写办理时间', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('expiration', 'require','请填写有效期', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),

        array('stay_days', 'require', '请填写停留时间', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('is_mianshi', 'require', '请选择是否面试', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('is_yaoqing', 'require', '请选择邀请函', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('acceptance_range', 'require','请填受理范围', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),

        array('address', 'require', '请填所属领区', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('price', 'require', '请填写门市价', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('price_cncn', 'require', '请填写优惠价', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),

    );

    /* 自动完成规则 */
    protected $_auto = array(
        array('create_time', 'getCreateTime', self::MODEL_BOTH,'callback'),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('expire_date', 'getExpire_date', self::MODEL_BOTH,'callback'),
        array('status', '1', self::MODEL_BOTH),
    );

    /**
     * 创建时间不写则取当前时间
     */
    protected function getCreateTime(){
        $create_time    =   I('post.create_time');
        return $create_time ? strtotime($create_time) : NOW_TIME;
    }

    /**
     * 有效期时间
     */
    protected function getExpire_date(){
        $expire_date    =   I('post.expire_date');
        return $expire_date ? strtotime($expire_date) : NOW_TIME;
    }


    /**
     * 新增或更新一个文档
     */
    public function update(){
       $data = $this->create();
       if(!$data){ //数据对象创建错误
           return false;
       }
       /* 添加或更新数据 */
       if(empty($data['visa_id'])){
           $res = $this->add();
       }else{
           $res = $this->save();
       }
       return $res;
    }

}
