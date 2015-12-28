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

        $line_info['images'] = explode(',', $line_info['images']);
        foreach ($line_info['images'] as $key => $val) {
            $line_info['images'][$key] = get_cover($val, 'path');
        }
        $line_info['xingcheng'] = unserialize($line_info['xingcheng']);
        $line_info['remark'] = unserialize($line_info['remark']);
        $this->assign('line_info', $line_info);
        $this->display();
    }


}
