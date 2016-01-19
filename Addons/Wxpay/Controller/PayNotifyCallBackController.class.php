<?php
namespace Addons\Wxpay\Controller;

use Com\Wxpay\lib\WxPayApi;
use Com\Wxpay\lib\WxPayConfig;
use Com\Wxpay\lib\WxPayException;
use Com\Wxpay\lib\WxPayNotify;
use Com\Wxpay\lib\WxPayOrderQuery;


class PayNotifyCallBackController extends WxPayNotify
{
	//查询订单
	public function Queryorder($transaction_id)
	{
		$input = new WxPayOrderQuery();
		$input->SetTransaction_id($transaction_id);
		$result = WxPayApi::orderQuery($input);
		if(array_key_exists("return_code", $result)
			&& array_key_exists("result_code", $result)
			&& $result["return_code"] == "SUCCESS"
			&& $result["result_code"] == "SUCCESS")
		{
			return true;
		}
		return false;
	}
	//重写回调处理方法，成功的时候返回true，失败返回false，处理商城订单
	public function NotifyProcess($data, &$msg)
	{
		$notfiyOutput = array();

		if(!array_key_exists("transaction_id", $data)){
			$msg = "输入参数不正确";
			return false;
		}
		//查询订单，判断订单真实性
		if(!$this->Queryorder($data["transaction_id"])){
			$msg = "订单查询失败";
			return false;
		}
        //以上的代码都是相同的，以下代码写定制业务逻辑，这里应该写通用订单处理逻辑
		$map = array(
			'order_id' => $data["out_trade_no"],
			'pay_status' => 1,
			'order_status' => 4
		);
        $save = array(
			'pay_status' => 2,
			'order_status' => 5,
			'update_time' =>NOW_TIME
		);
        M('Order')->where($map)->save($save);
		transaction($data["out_trade_no"], $data["total_fee"]/100, $data["openid"], '旅游订单', '微信扫码');
		return true;
	}
}
