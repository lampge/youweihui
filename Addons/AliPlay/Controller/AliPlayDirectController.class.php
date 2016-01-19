<?php

namespace Addons\AliPlay\Controller;
use Home\Controller\AddonsController;

class AliPlayDirectController extends AddonsController{
	private $alipay_config = array();
	/**
	 * [_initialize 初始化支付宝类库]
	 * @return [type] [description]
	 */
	public function _initialize(){
		$filepath = './Addons/AliPlay/Play/AliPlayDirect/';
		require_once($filepath."alipay.config.php");
		require_once($filepath."lib/alipay_notify.class.php");
		require_once($filepath."lib/aliplay.php");
		require_once($filepath."lib/alipay_submit.class.php");
		$this->alipay_config = $alipay_config;
	}

	/**
	 * [alipayPost 提交到支付宝方法]
	 * @return [type] [description]
	 */
	public function alipayGet() {
		$order_id = I('order_id');
		if (empty($order_id)) {
			$this->error('非法订单参数...');
		}
		$map = array(
			'order_status' => 4,
			'order_id' => $order_id
		);
		$order_info = M('Order')->field('order_id,order_price,product_id,order_type')->where($map)->find();
		if (empty($order_info)) {
			$this->error('订单不存在...');
		}
		switch ($order_info['order_type']) {
			case 'line':
				$info = M('Line')->field('title,sub_title')->find($order_info['product_id']);
				if ($info) {
					$order_info['title'] = $info['title'];
					$order_info['sub_title'] = $info['sub_title'];
				} else {
					$order_info['title'] = '旅游线路';
					$order_info['sub_title'] = '旅游线路资费';
				}
				break;
			case 'visa':
				$info = M('Visa')->field('title,sub_title')->find($order_info['product_id']);
				if ($info) {
					$order_info['title'] = $info['title'];
					$order_info['sub_title'] = $info['sub_title'];
				} else {
					$order_info['title'] = '旅游线路';
					$order_info['sub_title'] = '旅游线路资费';
				}
				break;
			default:
				break;
		}
				/**************************请求参数**************************/
		        //支付类型
		        $payment_type = "1";
		        //必填，不能修改
		        //服务器异步通知页面路径
				$get_notify_url=addons_url("AliPlay://AliPlayDirect/notifyUrl");
				$get_notify_url=preg_replace('/.html/i','',$get_notify_url);
				$get_notify_url="http://".$_SERVER['HTTP_HOST'].$get_notify_url;

		        $notify_url = $get_notify_url;
		        //需http://格式的完整路径，不能加?id=123这类自定义参数

		        //页面跳转同步通知页面路径
				$get_return_url=addons_url("AliPlay://AliPlayDirect/returnUrl");
				$get_return_url=preg_replace('/.html/i','',$get_return_url);
				$get_return_url="http://".$_SERVER['HTTP_HOST'].$get_return_url;
		        $return_url = $get_return_url;
		        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

		        //卖家支付宝帐户
		        $seller_email = SELLER_EMAIL;
		        //必填

		        //商户订单号
		        $out_trade_no = $order_info['order_id'];
		        //商户网站订单系统中唯一订单号，必填

		        //订单名称
		        $subject = $order_info['title'];
		        //必填

		        //付款金额
		        $total_fee = $order_info['order_price'];
		        //必填

		        //订单描述

		        $body = $order_info['title'];
		        //商品展示地址
		        $show_url = '';
		        //需以http://开头的完整路径，例如：http://www.xxx.com/myorder.html

		        //防钓鱼时间戳
		        $anti_phishing_key = "";
		        //若要使用请调用类文件submit中的query_timestamp函数

		        //客户端的IP地址
		        $exter_invoke_ip = $_SERVER["REMOTE_ADDR"];
		        //非局域网的外网IP地址，如：221.0.0.1


		        //这里根据自己的逻辑处理



		/************************************************************/

		//构造要请求的参数数组，无需改动
		$parameter = array(
				"service" => "create_direct_pay_by_user",
				"partner" => trim($this->alipay_config['partner']),
				"payment_type"	=> $payment_type,
				"notify_url"	=> $notify_url,
				"return_url"	=> $return_url,
				"seller_email"	=> $seller_email,
				"out_trade_no"	=> $out_trade_no,
				"subject"	=> $subject,
				"total_fee"	=> $total_fee,
				"body"	=> $body,
				"show_url"	=> $show_url,
				"anti_phishing_key"	=> $anti_phishing_key,
				"exter_invoke_ip"	=> $exter_invoke_ip,
				"_input_charset"	=> trim(strtolower($this->alipay_config['input_charset']))
		);
		// echo '<pre>'; print_r($parameter); echo '</pre>'; exit;
		//建立请求
		$alipaySubmit = new AlipaySubmit($this->alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "支付宝");
		header("Content-type:text/html;charset=utf-8");
		echo $html_text;
	}


	/**
	 * [returnUrl 同步通知]
	 * @return [type] [description]
	 */
	public function returnUrl()
	{
		$alipayNotify = new AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		$this->success('支付成功', U('User/orderShow', array('order_id'=>$_GET['out_trade_no']))); exit;
		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代码

			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
		    //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

			//商户订单号

			$out_trade_no = $_GET['out_trade_no'];

			//支付宝交易号

			$trade_no = $_GET['trade_no'];
			$total_fee = $_GET['total_fee'];
			$buyer_email = $_GET['buyer_email'];
			//交易状态
			$trade_status = $_GET['trade_status'];


		    if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//如果有做过处理，不执行商户的业务程序
				// $map = array(
				// 	'order_id' => $out_trade_no,
				// 	'pay_status' => 1,
				// 	'order_status' => 4
				// );
				// $save = array(
				// 	'pay_status' => 2,
				// 	'order_status' => 5,
				// 	'update_time' =>NOW_TIME
				// );
				// M('Order')->where($map)->save($save);
				// transaction($out_trade_no, $total_fee, $buyer_email, '旅游订单', '支付宝');

				echo '支付成功';
		    } else {
		      echo "trade_status=".$_GET['trade_status'];
		    }



			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		} else {
		    //验证失败
		    //如要调试，请看alipay_notify.php页面的verifyReturn函数
		    echo "验证失败";
		}
	}


	/**
	 * [notifyUrl 异步通知]
	 * @return [type] [description]
	 */
	public function notifyUrl()
	{
		//计算得出通知验证结果
		$alipayNotify = new AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyNotify();

		file_put_contents('alipay.log', var_export($verify_result, true), FILE_APPEND);
		file_put_contents('alipay-post.log', var_export($_POST, true), FILE_APPEND);

		if($verify_result) {//验证成功
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			//请在这里加上商户的业务逻辑程序代


			//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——

		    //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

			//商户订单号

			$out_trade_no = $_POST['out_trade_no'];

			//支付宝交易号

			$trade_no = $_POST['trade_no'];
			$total_fee = $_POST['total_fee'];
			$buyer_email = $_POST['buyer_email'];

			//交易状态
			$trade_status = $_POST['trade_status'];


		    if($_POST['trade_status'] == 'TRADE_FINISHED') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序

				//注意：
				//该种交易状态只在两种情况下出现
				//1、开通了普通即时到账，买家付款成功后。
				//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

		        //调试用，写文本函数记录程序运行情况是否正常
		        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
				$map = array(
					'order_id' => $out_trade_no,
					'pay_status' => 1,
					'order_status' => 4
				);
				$save = array(
					'pay_status' => 2,
					'order_status' => 5,
					'update_time' =>NOW_TIME
				);
				M('Order')->where($map)->save($save);
				transaction($out_trade_no, $total_fee, $buyer_email, '旅游订单', '支付宝');

		    }
		    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				//判断该笔订单是否在商户网站中已经做过处理
					//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
					//如果有做过处理，不执行商户的业务程序

				//注意：
				//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

		        //调试用，写文本函数记录程序运行情况是否正常
		        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

		    }

			//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——



			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		}
		else {
		    //验证失败
		    echo "fail";

		    //调试用，写文本函数记录程序运行情况是否正常
		    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
		}


	}


}
