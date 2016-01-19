<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;
use User\Api\UserApi;

/**
 * 用户控制器
 * 包括用户中心，用户登录及注册
 */
class UserController extends HomeController {
	/* 用户中心首页 */
	public function index(){
		$uid = is_login();
		$Order = M('Order');
		$map = array(
			'user_id' => $uid
		);
		$map['order_status'] = array('in', '1,4,5,6,7');
		$order_lists = $Order->where($map)->order('order_id desc')->select();
		foreach ($order_lists as $key => $value) {
			$order_lists[$key]['reserve_info'] = unserialize($value['reserve_info']);
			$order_lists[$key]['order_status_text'] = order_status_text($value['order_status']);
			$order_lists[$key]['pay_status_text'] = pay_status_text($value['pay_status']);
			switch ($value['order_type']) {
				case 'line':
					$line = M('Line')->field('title,images,starting')->where(array('line_id'=>$value['product_id']))->find();
					if ($line) {
						$order_lists[$key]['title'] = $line['title'];
						$order_lists[$key]['image'] = get_cover(array_shift(explode(',', $line['images'])), 'path');
						$order_lists[$key]['starting'] = $line['starting'];
						$order_lists[$key]['product_url'] = U('Line/show', array('id'=>$value['product_id']));
					} else {
						$order_lists[$key]['title'] = '不存在';
						$order_lists[$key]['image'] = '';
						$order_lists[$key]['starting'] = '';
						$order_lists[$key]['product_url'] = 'javascript:void(0);';
					}
					break;
				case 'visa':
					$visa = M('Visa')->field('title,images,starting')->where(array('visa_id'=>$value['product_id']))->find();
					if ($visa) {
						$order_lists[$key]['title'] = $visa['title'];
						$order_lists[$key]['image'] = get_cover(array_shift(explode(',', $visa['images'])), 'path');
						$order_lists[$key]['starting'] = $visa['starting'];
						$order_lists[$key]['product_url'] = U('Visa/show', array('id'=>$value['product_id']));
					} else {
						$order_lists[$key]['title'] = '不存在';
						$order_lists[$key]['image'] = '';
						$order_lists[$key]['starting'] = '';
						$order_lists[$key]['product_url'] = 'javascript:void(0);';
					}
					break;

				default:
					break;
			}
		}
		// echo '<pre>'; print_r($order_lists); echo '</pre>';
		// 待处理订单
		$map['order_status'] = array('in', '1,4,5,7');
		$chuli_count = $Order->where($map)->count();
		// 待评价订单
		$map['order_status'] = array('in', '6');
		$pingjia_count = $Order->where($map)->count();
		// 我的收藏
		$map = array(
			'user_id' => $uid
		);
		$collect_count = M('Collect')->where($map)->count();
		// 已回复咨询
		// $map = array(
		// 	'user_id' => $uid,
		// 	'status' => 2
		// );
		// $reply_count = M('Message')->where($map)->count();

		$get_notify_url=addons_url("Wxpay://Index/native", array('order_id'=>'NS201601061346482784'));
		// $get_notify_url=preg_replace('/.html/i','',$get_notify_url);
		// $get_notify_url="http://".$_SERVER['HTTP_HOST'].$get_notify_url;
		echo $get_notify_url;

		$this->assign('chuli_count', $chuli_count);
		$this->assign('pingjia_count', $pingjia_count);
		$this->assign('collect_count', $collect_count);


		$this->assign('order_lists', $order_lists);
		$this->display();
	}

	// 注册
	public function register($mobile = '', $password = '', $sms_code = '', $email = ''){
		if(!C('USER_ALLOW_REGISTER')){
			$this->error('注册已关闭');
		}
		if(IS_POST){ //注册用户
			/* 检测验证码 */
			$map = array(
				'mobile' => $mobile,
				'code' => $sms_code,
				'status' => 1
			);
			$count = M('SmsLog')->where($map)->count();
			if(!$count){
				$this->error('验证码输入错误！');
			}

			/* 调用注册接口注册用户 */
			$User = new UserApi;
			$uid = $User->register('', $password, $email, $mobile);
			if(0 < $uid){ //注册成功
				//TODO: 发送验证邮件
				M('SmsLog')->where($map)->save(array('utime'=>NOW_TIME, 'status'=>0));
				$this->success('注册成功！',U('login'));
			} else { //注册失败，显示错误信息
				$this->error($this->showRegError($uid));
			}

		} else { //显示注册表单
			$this->display();
		}
	}

	/* 登录页面 */
	public function login($mobile = '', $password = '', $verify = ''){
		if(IS_POST){ //登录验证
			/* 检测验证码 */
			// if(!check_verify($verify)){
			// 	$this->error('验证码输入错误！');
			// }

			/* 调用UC登录接口登录 */
			$user = new UserApi;
			$uid = $user->login($mobile, $password, 3);
			if(0 < $uid){ //UC登录成功
				/* 登录用户 */
				$Member = D('Member');
				if($Member->login($uid)){ //登录用户
					//TODO:跳转到登录前页面
					$this->success('登录成功！', get_redirect_url());
				} else {
					$this->error($Member->getError());
				}

			} else { //登录失败
				switch($uid) {
					case -1: $error = '用户不存在或被禁用！'; break; //系统级别禁用
					case -2: $error = '密码错误！'; break;
					default: $error = '未知错误！'; break; // 0-接口参数错误（调试阶段使用）
				}
				$this->error($error);
			}

		} else { //显示登录表单
			set_redirect_url(I('referer'));
			$this->display();
		}
	}

	/* 退出登录 */
	public function logout(){
		if(is_login()){
			D('Member')->logout();
			$this->success('退出成功！', U('User/login'));
		} else {
			$this->redirect('User/login');
		}
	}

	/* 验证码，用于登录和注册 */
	public function verify(){
		$verify = new \Think\Verify();
		$verify->entry(1);
	}

	/**
	 * 获取用户注册错误信息
	 * @param  integer $code 错误编码
	 * @return string        错误信息
	 */
	private function showRegError($code = 0){
		switch ($code) {
			case -1:  $error = '用户名长度必须在16个字符以内！'; break;
			case -2:  $error = '用户名被禁止注册！'; break;
			case -3:  $error = '用户名被占用！'; break;
			case -4:  $error = '密码长度必须在6-30个字符之间！'; break;
			case -5:  $error = '邮箱格式不正确！'; break;
			case -6:  $error = '邮箱长度必须在1-32个字符之间！'; break;
			case -7:  $error = '邮箱被禁止注册！'; break;
			case -8:  $error = '邮箱被占用！'; break;
			case -9:  $error = '手机格式不正确！'; break;
			case -10: $error = '手机被禁止注册！'; break;
			case -11: $error = '手机号被占用！'; break;
			default:  $error = '未知错误';
		}
		return $error;
	}


    /**
     * 修改个人资料
     */
    public function profile(){
		$this->_checkLogin();
		$uid = is_login();
        if ( IS_POST ) {
            //获取参数
            $Member = D('Member');
			$data = $Member->create();
			$result = $Member->where(array('uid'=>$uid))->save($data);
			if($result){
                $this->success('修改成功！');
            }else{
                $this->error('修改失败！');
            }
        }else{
			$user_info = D('Member')->info($uid);

			$this->assign('user_info', $user_info);
            $this->display();
        }
    }
    /**
     * 修改密码提交
     */
    public function repassword(){
		$this->_checkLogin();
        if ( IS_POST ) {
            //获取参数
            $uid        =   is_login();
            $password   =   I('post.old');
            $repassword = I('post.repassword');
            $data['password'] = I('post.password');
            empty($password) && $this->error('请输入原密码');
            empty($data['password']) && $this->error('请输入新密码');
            empty($repassword) && $this->error('请输入确认密码');
            if($data['password'] !== $repassword){
                $this->error('您输入的新密码与确认密码不一致');
            }
            $Api = new UserApi();
            $res = $Api->updateInfo($uid, $password, $data);
            if($res['status']){
                $this->success('修改密码成功！');
            }else{
                $this->error($res['info']);
            }
        }else{
            $this->display();
        }
    }

	/**
	 * 个人中心订单
	 * @return [type] [description]
	 */
    public function order(){
		$this->_checkLogin();
		$uid = is_login();
		$Order = M('Order');
		$map = array(
			'user_id' => $uid
		);
		$order_status = I('status', 1);
		switch ($order_status) {
			case '2':
				$map['order_status'] = array('in', '1,4,5,7');
				break;
			case '3':
				$map['order_status'] = array('in', '2,3,8,9,10');
				break;
			case '4': //待评价
				$map['order_status'] = array('in', '6');
				break;
			default:
				break;
		}
		$sousuo['status'] = $order_status;
		$order_lists = $Order->where($map)->order('order_id desc')->select();
		foreach ($order_lists as $key => $value) {
			$order_lists[$key]['reserve_info'] = unserialize($value['reserve_info']);
			$order_lists[$key]['order_status_text'] = order_status_text($value['order_status']);
			$order_lists[$key]['pay_status_text'] = pay_status_text($value['pay_status']);

			switch ($value['order_type']) {
				case 'line':
					$line = M('Line')->field('title,images,starting')->where(array('line_id'=>$value['product_id']))->find();
					if ($line) {
						$order_lists[$key]['title'] = $line['title'];
						$order_lists[$key]['image'] = get_cover(array_shift(explode(',', $line['images'])), 'path');
						$order_lists[$key]['starting'] = $line['starting'];
						$order_lists[$key]['product_url'] = U('Line/show', array('id'=>$value['product_id']));
					} else {
						$order_lists[$key]['title'] = '不存在';
						$order_lists[$key]['image'] = '';
						$order_lists[$key]['starting'] = '';
						$order_lists[$key]['product_url'] = 'javascript:void(0);';
					}
					break;
				case 'visa':
					$visa = M('Visa')->field('title,images,starting')->where(array('visa_id'=>$value['product_id']))->find();
					if ($visa) {
						$order_lists[$key]['title'] = $visa['title'];
						$order_lists[$key]['image'] = get_cover(array_shift(explode(',', $visa['images'])), 'path');
						$order_lists[$key]['starting'] = $visa['starting'];
						$order_lists[$key]['product_url'] = U('Visa/show', array('id'=>$value['product_id']));
					} else {
						$order_lists[$key]['title'] = '不存在';
						$order_lists[$key]['image'] = '';
						$order_lists[$key]['starting'] = '';
						$order_lists[$key]['product_url'] = 'javascript:void(0);';
					}
					break;

				default:
					break;
			}
		}
		// echo '<pre>'; print_r($order_lists); echo '</pre>';
		$this->assign('order_lists', $order_lists);
		$this->assign('sousuo', $sousuo);
        $this->display();
    }
	// 订单详情
	public function orderShow($order_id = ''){
		$this->_checkLogin();
		if (empty($order_id)) {
			$this->error('非法参数...');
		}
		$Order = D('Order');
		$map = array(
			'user_id' => is_login(),
			'order_id' => $order_id
		);
		$order_info = $Order->where($map)->find();
		if (empty($order_info)) {
			$this->error('订单不存在...');
		}
		$order_info['reserve_info'] = unserialize($order_info['reserve_info']);
		$order_info['order_status_text'] = order_status_text($order_info['order_status']);
		$order_info['pay_status_text'] = pay_status_text($order_info['pay_status']);
		switch ($order_info['order_type']) {
			case 'line':
				$line = M('Line')->field('title,images,starting')->where(array('line_id'=>$order_info['product_id']))->find();
				if ($line) {
					$order_info['title'] = $line['title'];
					$order_info['image'] = get_cover(array_shift(explode(',', $line['images'])), 'path');
					$order_info['starting'] = $line['starting'];
					$order_info['product_url'] = U('Line/show', array('id'=>$order_info['product_id']));
				} else {
					$order_info['title'] = '不存在';
					$order_info['image'] = '';
					$order_info['starting'] = '';
					$order_info['product_url'] = 'javascript:void(0);';
				}
				break;
			case 'visa':
				$visa = M('Visa')->field('title,images,starting')->where(array('visa_id'=>$order_info['product_id']))->find();
				if ($visa) {
					$order_info['title'] = $visa['title'];
					$order_info['image'] = get_cover(array_shift(explode(',', $visa['images'])), 'path');
					$order_info['starting'] = $visa['starting'];
					$order_info['product_url'] = U('Visa/show', array('id'=>$order_info['product_id']));
				} else {
					$order_info['title'] = '不存在';
					$order_info['image'] = '';
					$order_info['starting'] = '';
					$order_info['product_url'] = 'javascript:void(0);';
				}
				break;
			default:
				break;
		}
		// echo '<pre>'; print_r($order_info); echo '</pre>';
		$this->assign('order_info', $order_info);
		$this->display();
	}
	public function orderBuy($order_id = ''){

		$this->assign('order_id', $order_id);
		$this->display();
	}
	// 取消订单
	public function orderUndo($order_id = ''){
		$this->_checkLogin();
		$order_info = M('Order')->find($order_id);
		if (empty($order_info)) {
			$this->error('订单不存在...');
		}
		$data = array(
			'user_id' => is_login(),
			'order_id' => $order_id,
			'order_status' => 2,
			'update_time' =>NOW_TIME
		);
		$result = M('Order')->save($data);
		if ($result) {
			$this->success('成功');
		} else {
			$this->error('失败');
		}
	}
	// 订单退款
	public function orderRefund($order_id = ''){
		$this->_checkLogin();
		$order_info = M('Order')->find($order_id);
		if (empty($order_info)) {
			$this->error('订单不存在...');
		}
		$data = array(
			'user_id' => is_login(),
			'order_id' => $order_id,
			'order_status' => 7,
			'update_time' =>NOW_TIME
		);
		$result = M('Order')->save($data);
		if ($result) {
			$this->success('成功');
		} else {
			$this->error('失败');
		}
	}
	// 订单确认
	public function orderTrue($order_id = ''){
		$this->_checkLogin();
		$order_info = M('Order')->find($order_id);
		if (empty($order_info)) {
			$this->error('订单不存在...');
		}
		$data = array(
			'user_id' => is_login(),
			'order_id' => $order_id,
			'order_status' => 6,
			'update_time' =>NOW_TIME
		);
		$result = M('Order')->save($data);
		if ($result) {
			$this->success('成功');
		} else {
			$this->error('失败');
		}
	}

	// 评价
    public function comment(){
		$this->_checkLogin();
        if ( IS_POST ) {
			$order_id = I('request.order_id');
			$content = I('content');
			if (empty($order_id)) {
				$this->error('订单编号不能为空...');
			}
			if (empty($content)) {
				$this->error('评价内容不能为空...');
			}
			$order_info = M('Order')->find($order_id);
			if (empty($order_info)) {
				$this->error('订单不存在...');
			}
			if ($order_info['order_status'] != 6) {
				$this->error('订单不能评价...');
			}
			$data = array(
				'user_id' => is_login(),
				'order_id' => $order_id,
				'order_status' => 10,
				'update_time' => NOW_TIME
			);
			M('Order')->save($data);
			$data = array(
				'user_id' => is_login(),
				'order_id' => $order_id,
				'product_id' => $order_info['product_id'],
				'order_price' => $order_info['order_price'],
				'create_time' => NOW_TIME,
				'update_time' => NOW_TIME,
				'content' => $content,
				'status' => 1
			);
			$result = M('Comment')->add($data);
			if ($result) {
				$this->success('成功');
			} else {
				$this->error('失败');
			}
        }else{
			$map = array(
				'user_id' => is_login()
			);
			$comment = M('Comment')->where($map)->order('id desc')->select();
			foreach ($comment as $key => $value) {
				$order_info = M('Order')->field('order_type')->find($value['order_id']);
				switch ($order_info['order_type']) {
					case 'line':
						$line = M('Line')->field('title')->where(array('line_id'=>$value['product_id']))->find();
						if ($line) {
							$comment[$key]['title'] = $line['title'];
							$comment[$key]['product_url'] = U('Line/show', array('id'=>$value['product_id']));
						} else {
							$comment[$key]['title'] = '不存在';
							$comment[$key]['product_url'] = 'javascript:void(0);';
						}
						break;
					case 'visa':
						$visa = M('Visa')->field('title')->where(array('visa_id'=>$value['product_id']))->find();
						if ($visa) {
							$comment[$key]['title'] = $visa['title'];
							$comment[$key]['product_url'] = U('Visa/show', array('id'=>$value['product_id']));
						} else {
							$comment[$key]['title'] = '不存在';
							$comment[$key]['product_url'] = 'javascript:void(0);';
						}
						break;
					default:
						break;
				}
			}
			// echo '<pre>'; print_r($comment); echo '</pre>';
			$this->assign('comment', $comment);
            $this->display();
        }
    }

	// 积分帐号
    public function score(){
		$this->_checkLogin();
        if ( IS_POST ) {

        }else{
            $this->display();
        }
    }

	// 收藏
    public function collect(){
		$this->_checkLogin();
        if ( IS_POST ) {

        }else{
            $this->display();
        }
    }

	// 检查手机号是否已经注册
	public function checkMobile($mobile){
		$User = new UserApi;
		$res = $User->checkMobile($mobile);
		if ($res == 1) {
			$this->success('true');
		} else {
			$this->error('false');
		}
	}

	// 发送短信验证码
	public function sendSms($mobile){
		if (!preg_match('/^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/', $mobile)) {
			$this->error('手机号错误');
		}
		$rand = mt_rand(1000, 9999);
		M('SmsLog')->add(array(
			'type'		=> '注册',
			'mobile' 	=> $mobile,
			'code' 		=> $rand,
			'ctime'		=> NOW_TIME,
			'utime'		=> NOW_TIME,
			'status'	=> 1
		));
		$this->success($rand);
	}

	private function _checkLogin(){
		if (!is_login()) {
			$this->error('您还没有登陆', U('User/login'));
		}
	}

}
