<?php
namespace Home\Controller;
use User\Api\UserApi;
/**
 * 前台线路控制器
 */
class LineController extends HomeController {

    // 线路列表
    public function index(){
        //$Line_type = M('Line_type');
        $catid =  I('get.catid',1);
        $sql = "select count(*) as num from __LINE_TYPE__ as a,__LINE__ as b
        where a.type_id = $catid and a.line_id = b.line_id and b.status=1";
        $pageNum = 15;
        $_page = pages($sql,$pageNum);
        $nowPage =  I('get.p',1);
        $firstRow = ($nowPage-1)*$pageNum;

       $Model = new \Think\Model();
       $line_lists =  $Model->query("select a.*, b.* from __LINE_TYPE__ as a,
       __LINE__ as b where a.type_id = $catid and a.line_id = b.line_id and b.status=1
       order by b.update_time desc, b.line_id desc limit $firstRow,$pageNum");
        $line_lists = array_filter($line_lists);

        foreach ($line_lists as $key => $val) {
      		    $map_two = array();
      		    $map_two['line_id&is_default'] =array($val['line_id'],1,'_multi'=>true);
      		    $res = get_tc_val($map_two);

              $line_lists[$key]['price'] = $res['price'];
              $line_lists[$key]['best_price'] = $res['best_price'];
      		    $line_lists[$key]['start_date'] = get_start_date($res['date_price_data']);
              $line_lists[$key]['img'] = get_cover(array_shift(explode(',', $val['images'])), 'path');
              $line_lists[$key]['url'] = U('show', array('id'=>$val['line_id']));
        }


        $this->assign('line_lists', $line_lists);
        $this->assign('_page', $_page);
        $this->display();
    }

    // 线路详情
    public function show($id = 0){
        if (empty($id)) {
            $this->error('无效参数');
        }
        $Line = M('Line');
        $line_info = $Line->find($id);


        // 线路信息
        $line_info['images'] = explode(',', $line_info['images']);
        foreach ($line_info['images'] as $key => $val) {
            $line_info['images'][$key] = get_cover($val, 'path');
        }
        $line_info['xingcheng'] = unserialize($line_info['xingcheng']);
        $line_info['remark'] = unserialize($line_info['remark']);

        // 套餐信息
        $map = array(
            'line_id' => $id,
            'end_time' => array('egt', strtotime('+'.$line_info['earlier_date'].'day'))
        );
        $line_tc = M('LineTc')->where($map)->select();
        if (empty($line_tc)) {
            $this->error('没有报价方案');
        }
        $default_tc = array();
        foreach ($line_tc as $key => $value) {
            if ($value['is_default']) {
                $default_tc = $value;
                break;
            }
        }
        if (empty($default_tc)) {
            $default_tc = $line_tc[0];
        }


        $this->assign('line_info', $line_info);
        $this->assign('line_tc', $line_tc);
        $this->assign('default_tc', $default_tc);
        $this->display();
    }

    public function checkOrder($order_id = ''){
        if (empty($order_id)) {
            $this->error('非法参数');
        }
        $order_info = D('Order')->where(array('order_id'=>$order_id))->find();
        if (empty($order_info)) {
            $this->error('订单不存在');
        }
        $this->assign('order_info', $order_info);
        $this->display();
    }

    public function order(){
        if (IS_POST) {
            $Order = D('Order');
            $order_id = 'NS' . date('YmdHis') . mt_rand(1000, 9999);
            $uid = is_login();
            if ($uid) {
                $result = $Order->input($order_id, $uid, 1);
            } else {
                $mobile = I('mobile', '', 'trim');
                /* 调用注册接口注册用户 */
                $User = new UserApi;
                $res = $User->checkMobile($mobile);
                if ($res == 1) {
                    $password = mt_rand(100000, 999999);
                    $uid = $User->register('', $password, '', $mobile);
                    if(0 < $uid){ //注册成功
                        send_sms($mobile, '您的密码：'. $password);
                        $result = $Order->input($order_id, $uid, 1);
                    }
                } else {
                    $user_info = $User->getinfo($mobile, 3);
                    $result = $Order->input($order_id, $user_info[0], 1);
                }
            }

            if ($result) {
                $this->redirect('checkOrder', array('order_id'=>$order_id));
            } else {
                $this->error('订单提交失败');
            }
        } else {
            $line_id = I('line_id', 0, 'intval');
            $tc_id = I('type_id', 0, 'intval');
            $date = I('date', 0, 'strtotime');

            if (empty($line_id) || empty($tc_id) || empty($date)) {
                $this->error('无效参数');
            }
            // 线路信息
            $line_info = M('Line')->find($line_id);


            // 套餐信息
            $map = array(
                'line_id' => $line_id,
                'end_time' => array('egt', strtotime('+'.$line_info['earlier_date'].'day'))
            );
            $line_tc = M('LineTc')->where($map)->select();

            if (empty($line_tc)) {
                $this->error('没有报价方案');
            }
            $tc_info = array();
            foreach ($line_tc as $key => $value) {
                if ($value['tc_id'] == $tc_id) {
                    $tc_info = $value;
                    break;
                }
            }
            $ext_time = strtotime('+'.$line_info['earlier_date'].'day');
            $tc_str = explode(',', $tc_info['date_price_data']);
            foreach ($tc_str as $value) {
                list($k, $val) = explode('|', $value);
                $k = strtotime($k);
                if ($k <= $ext_time) {
                    continue;
                }
                if ($k == $date) {
                    $tc_info['price_info'] = explode('-', $val);
                    $tc_info['price_info'][] = date('Y-m-d', $k);
                    break;
                }
            }
            if (empty($tc_info['price_info'])) {
                $this->error('没有价格');
            }


            $this->assign('line_info', $line_info);
            $this->assign('line_tc', $line_tc);
            $this->assign('tc_info', $tc_info);
            $this->display();
        }

    }

    // 检查验证码
    public function checkCode($verify = ''){
        if (check_verify($verify)) {
            $this->success('成功');
        } else {
            $this->error('失败');
        }
    }

    /* 验证码 */
	public function verify(){
		$verify = new \Think\Verify();
        $verify->length   = 4;
        $verify->codeSet = '0123456789';
        $verify->useCurve = false;
		$verify->entry(1);
	}

    // 价格方案
    public function showTypeDate($line_id, $type_id){
        $line_info = M('Line')->find($line_id);
        $line_tc = M('LineTc')->find($type_id);
        $ext_time = strtotime('+'.$line_info['earlier_date'].'day');
        $tc_str = explode(',', $line_tc['date_price_data']);
        $tc = array();
        foreach ($tc_str as $value) {
            list($k, $val) = explode('|', $value);
            if (strtotime($k) <= $ext_time) {
                continue;
            }
            $tc[$k] = explode('-', $val);
            $tc[$k][] = $k;
        }
        // print_r($tc);

        $moon = array();
        foreach ($tc as $key => $value) {
            $moon[date('Y-n', strtotime($key))][$key] = $value;
        }
        // print_r($moon);
        $date_type = array();
        foreach ($moon as $key => $value) {
            $t_num = date('t', strtotime($key));
            for ($i=0; $i < $t_num; $i++) {
                $day_k = date('Y-m-d', strtotime($key . '+' . $i . 'day'));
                $day_v = date('Y-n-j', strtotime($key . '+' . $i . 'day'));
                $date_type[$key][$day_k] = $tc[$day_v];
            }
        }
        // print_r($date_type);
        $this->assign('line_info', $line_info);
        $this->assign('line_tc', $line_tc);
        $this->assign('date_type', $date_type);
        $this->display();
    }

    // 查看价格方案
    public function showSpecifyPrice($line_id, $date){
        $line_info = M('Line')->find($line_id);
        $line_tcs = M('LineTc')->where(array('line_id'=>$line_id))->select();
        $data = array('status' => 0);
        $date = date('Y-n-j', strtotime($date));
        foreach ($line_tcs as $key => $line_tc) {
            $ext_time = strtotime('+'.$line_info['earlier_date'].'day');
            $tc_str = explode(',', $line_tc['date_price_data']);
            $tc = array();
            foreach ($tc_str as $value) {
                list($k, $val) = explode('|', $value);
                if (strtotime($k) <= $ext_time) {
                    continue;
                }
                $tc[$k] = explode('-', $val);
                $tc[$k][] = $k;
            }
            foreach ($tc as $key => $value) {
                if ($date == $key) {
                    $data['msg'][] = array(
                        'date' => date('Y-m-d', strtotime($date)),
                        'price' => $line_tc['price'],
                        'price_child_d' => $value[1],
                        'price_d' => $value[0],
                        'stock' => '-1',
                        'type_id' => $line_tc['tc_id'],
                        'typename' => $line_tc['typename'],
                        'typename_s' => $line_tc['typename'],
                    );
                }
            }
        }
        $this->ajaxReturn($data);
        exit;
    }

}
