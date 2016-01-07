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
			'user_id' => $uid,
			'order_status' => 1,
		);

		$order_lists = $Order->where($map)->order(`create_time desc`)->select();
		$order_status = array(
			1 => '待审核',
			2 => '用户取消',
			3 => '无效订单',
			4 => '已确认',
			5 => '交易完成',
			6 => '交易评价',
			7 => '退款中',
			8 => '已退款',
		);
		$pay_status = array(
			1 => '未支付',
			2 => '已支付'
		);
		foreach ($order_lists as $key => $value) {
			$order_lists[$key]['reserve_info'] = unserialize($value['reserve_info']);
			$order_lists[$key]['order_status_text'] = $order_status[$value['order_status']];
			$order_lists[$key]['pay_status_text'] = $pay_status[$value['pay_status']];

			switch ($value['order_type']) {
				case 'line':
					$line = M('Line')->field('title,images,starting')->where(array('line_id'=>$value['product_id']))->find();
					if ($line) {
						$order_lists[$key]['title'] = $line['title'];
						$order_lists[$key]['image'] = get_cover(array_shift(explode(',', $line['images'])), 'path');
						$order_lists[$key]['starting'] = $line['starting'];
					} else {
						$order_lists[$key]['title'] = '不存在';
						$order_lists[$key]['image'] = '';
						$order_lists[$key]['starting'] = '';
					}
					break;

				default:
					break;
			}
		}

		// print_r($order_lists);


		$this->assign('order_lists', $order_lists);
        $this->display();
    }

	// 评价
    public function comment(){
		$this->_checkLogin();
        if ( IS_POST ) {

        }else{
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

	// 积分帐号
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
