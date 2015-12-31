<?php
namespace Home\Controller;
/**
 * 前台线路控制器
 */
class LineController extends HomeController {

    // 线路列表
    public function index(){
        $Line = M('Line');
        $map = array();
        $order = 'update_time desc, line_id desc';
        $line_lists = $Line->where($map)->order($order)->limit()->select();
        foreach ($line_lists as $key => $val) {

            $line_lists[$key]['img'] = get_cover(array_shift(explode(',', $val['images'])), 'path');
            $line_lists[$key]['url'] = U('show', array('id'=>$val['line_id']));
        }

        echo '<pre><!-- ';
        print_r($line_lists);
        echo ' --></pre>';

        $this->assign('line_lists', $line_lists);
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

    public function order(){
        if (IS_POST) {

        } else {
            $line_id = I('line_id', 0, 'intval');
            $tc_id = I('type_id', 0, 'intval');

            if (empty($line_id) || empty($tc_id)) {
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

}
