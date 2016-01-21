<?php
namespace Home\Model;
use Think\Model;

class MessageModel extends Model{

    // 自动验证
    protected $_validate = array(
        array('content', 'require', '咨询内容必填！'),
        array('tel', 'require', '联系方式必填！'),
        array('code', 'check_verify', '验证码错误', self::MODEL_INSERT, 'function'),
    );

    // 自动完成
    protected $_auto = array(
        array('code', 'check_verify', self::MODEL_INSERT, self::MODEL_INSERT, 'function'),
        array('create_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', 0, self::MODEL_INSERT)
    );

    // 写入
    public function input(){
        $this->create();
        return $this->add();
    }

}
