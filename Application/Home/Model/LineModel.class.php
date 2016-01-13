<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Model;
use Think\Model\RelationModel;

/**
 * 分类模型
 */
class LineModel extends RelationModel{

  protected $_link = array(
    'Line'=>array(
        'mapping_type'  => self::HAS_ONE,
        'class_name'    => 'Line',
        'foreign_key'   => 'line_id',
        'as_fields' => 'line_id,title,sub_title,images',
        ),
      'Line_tc'=>array(
          'mapping_type'  => self::HAS_ONE,
          'class_name'    => 'Line_tc',
          'foreign_key'   => 'line_id',
          'as_fields' => 'price,best_price,date_price_data,update_price_explan',
          ),
      'Line_type'=>array(
              'mapping_type'  => self::HAS_ONE,
              'class_name'    => 'Line_type',
              'foreign_key'   => 'type_id',
              'as_fields' => 'line_id',
              ),
      );


}
