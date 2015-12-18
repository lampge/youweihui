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
class LineTcModel extends Model{

    protected $_validate = array(
        array('tc_id', 'require', '套餐id不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('line_id', 'require', '线路id不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('typename', 'require', '价格类型名称不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
        array('price', 'require', '门市价不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    	array('update_price_explan', 'require', '费用说明不能为空', self::MUST_VALIDATE , 'regex', self::MODEL_BOTH),
    );

    protected $_auto = array(
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', '1', self::MODEL_BOTH),
    );

    public function update(){
        $data = $this->create();
        if(!$data){ //数据对象创建错误
            return false;
        }
        $count = $this->where(array('line_id'=>$data['line_id']))->count();
        if (!$count && $data['tc_id']) {
            $this->is_default = 1;
        }
        if ($data['date_price_data']) {
            $price_data = array();
            $date_price_data = $data['date_price_data'];
            $date_price_data = explode(',', $date_price_data);
            foreach ($date_price_data as $key => $val) {
                $date_price_data2 =  explode('|', $val);
                list($cr, $rt) = explode('-', $date_price_data2[1]);
                $price_data[$key]['date'] = $date_price_data2[0];
                $price_data[$key]['cr'] = $cr;
                $price_data[$key]['rt'] = $rt;
            }
            $crs = array_column($price_data, 'cr');
            sort($crs);
            $this->best_price = $crs[0];
        }

        /* 添加或更新数据 */
        if(empty($data['tc_id'])){

            $res = $this->add();
        }else{
            $res = $this->save();
        }
        return $res;
    }


}
