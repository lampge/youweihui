<?php

namespace Addons\Wxpay\Controller;
use Home\Controller\AddonsController;
use Common\Model\UcuserModel;
use Com\Wxpay\example\JsApiPay;
use Com\Wxpay\lib\WxPayApi;
use Com\Wxpay\lib\WxPayConfig;
use Com\Wxpay\lib\WxPayUnifiedOrder;

require_once "../lib/WxPay.Api.php";
require_once "WxPay.NativePay.php";
require_once 'log.php';

use Addons\Wxpay\Controller\PayNotifyCallBackController;



use Com\TPWechat;

class IndexController extends AddonsController{

    public $options;    //使用微信支付的Controller最好有一个统一的微信支付配置参数
    public $wxpaycfg;
    public function index($mp_id = 0){
        $params['mp_id'] = get_mpid();   //系统中公众号ID
        $this->assign ( 'mp_id', $params['mp_id'] );
        $this->display ( );
    }

    //http://wwb.sypole.com/addon/Wxpay/Index/native/order_id/NS201601061346482784
    public function native($order_id = '') {
        exit('@@@@@@');
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
                # code...
                break;
        }
        //模式二
        /**
         * 流程：
         * 1、调用统一下单，取得code_url，生成二维码
         * 2、用户扫描二维码，进行支付
         * 3、支付完成之后，微信服务器会通知支付成功
         * 4、在支付成功通知中需要查单确认是否真正支付成功（见：notify.php）
         */
        $get_notify_url=addons_url("Wxpay://Index/notify");
        $get_notify_url=preg_replace('/.html/i','',$get_notify_url);
        $get_notify_url="http://".$_SERVER['HTTP_HOST'].$get_notify_url;
        $notify_url = $get_notify_url;
        //获取公众号信息，jsApiPay初始化参数
        $config = get_addon_config('Wxpay');
        $this->options['appid'] = $config['appid'];
        $this->options['mchid'] = $config['mchid'];
        $this->options['mchkey'] = $config['mchkey'];
        $this->options['secret'] = $config['secret'];
        $this->options['notify_url'] = $config['notify_url'];
        $this->wxpaycfg = new WxPayConfig($this->options);
        $input = new WxPayUnifiedOrder($this->wxpaycfg);
        $input->SetBody($order_info['title']);
        $input->SetAttach($order_info['sub_title']);
        $input->SetOut_trade_no($order_info['order_id']);
        $input->SetTotal_fee(intval($order_info['price']));
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag($order_info['title']);
        $input->SetNotify_url($notify_url);
        $input->SetTrade_type("NATIVE");
        $input->SetProduct_id("123456789");
		if($input->GetTrade_type() == "NATIVE") {
			$result = WxPayApi::unifiedOrder($input);
            $url2 = $result["code_url"]
		}

        // echo $url2;
        $this->assign('url2', $url2);
        $this->display();
    }

    /**
     *
     * jsApi微信支付示例
     * 注意：
     * 1、微信支付授权目录配置如下  http://www.youweihui.net/addon/Wxpay/Index/jsApiPay/mp_id/
     * 2、支付页面地址需带mp_id参数
     * 3、管理后台-基础设置-公众号管理，微信支付必须配置的参数都需填写正确
     * @param array $mp_id 公众号在系统中的ID
     * @return 将微信支付需要的参数写入支付页面，显示支付页面
     */
    public function jsApiPay(){
        $uid = get_ucuser_uid();                         //获取粉丝用户uid，一个神奇的函数，没初始化过就初始化一个粉丝
        if($uid === false){
            $this->error('只可在微信中访问');
        }
        $user = get_uid_ucuser($uid);                    //获取本地存储公众号粉丝用户信息
        $this->assign('user', $user);

        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $surl = get_shareurl();
        if(!empty($surl)){
            $this->assign ( 'share_url', $surl );
        }

        //odata通用订单数据,订单数据可以从订单页面提交过来
        $odata['uid'] = $uid;
        $odata['mp_id'] = $params['mp_id'];                    // 当前公众号在系统中ID
        $odata['order_id'] = "time".date("YmdHis");   //
        $odata['order_status'] = 1;                            //不带该字段-全部状态, 2-待发货, 3-已发货, 5-已完成, 8-维权中
        $odata['order_total_price'] = 1;                      //订单总价，单位：分
        $odata['buyer_openid'] = $user['openid'];
        $odata['buyer_nick'] = $user['nickname'];
        $odata['receiver_mobile'] = $user['mobile'];
        $odata['product_id'] = 1;
        $odata['product_name'] = "UCToo";
        $odata['product_price'] = 100;                          //商品价格，单位：分
        $odata['product_sku'] = "UCToo_Wxpay";
        $odata['product_count'] = 1;
        $odata['module'] = MODULE_NAME;
        $odata['model'] = "order";
        $odata['aim_id'] = 1;
        $order = D("Order"); // 实例化order对象
        $order->create($odata); // 生成数据对象
        $result = $order->add(); // 写入数据
        if($result){
            // 如果主键是自动增长型 成功后返回值就是最新插入的值

        }

        //获取公众号信息，jsApiPay初始化参数
        $info = get_mpid_appinfo ( $odata['mp_id'] );
        $this->options['appid'] = $info['appid'];
        $this->options['mchid'] = $info['mchid'];
        $this->options['mchkey'] = $info['mchkey'];
        $this->options['secret'] = $info['secret'];
        $this->options['notify_url'] = $info['notify_url'];
        $this->wxpaycfg = new WxPayConfig($this->options);

        //①、初始化JsApiPay
        $tools = new JsApiPay($this->wxpaycfg);
        $wxpayapi = new WxPayApi($this->wxpaycfg);

        //②、统一下单
        $input = new WxPayUnifiedOrder($this->wxpaycfg);           //这里带参数初始化了WxPayDataBase
      //  $input->SetAppid($info['appid']);//公众账号ID
      //  $input->SetMch_id($info['mchid']);//商户号
        $input->SetBody($odata['product_name']);
        $input->SetAttach($odata['product_sku']);
        $input->SetOut_trade_no($odata['order_id']);
        $input->SetTotal_fee($odata['order_total_price']);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
       // $input->SetGoods_tag("WXG");                      //商品标记，代金券或立减优惠功能的参数
      //  $input->SetNotify_url($info['notify_url']);       //http://test.uctoo.com/index.php/UShop/Index/notify
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($user['openid']);
        $order = $wxpayapi->unifiedOrder($input);

        $jsApiParameters = $tools->GetJsApiParameters($order);
//获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();
//③、在支持成功回调通知中处理成功之后的事宜，见 notify.php
        /**
         * 注意：
         * 1、当你的回调地址不可访问的时候，回调通知会失败，可以通过查询订单来确认支付是否成功
         * 2、jsapi支付时需要填入用户openid，WxPay.JsApiPay.php中有获取openid流程 （文档可以参考微信公众平台“网页授权接口”，
         * 参考http://mp.weixin.qq.com/wiki/17/c0f37d5704f0b64713d5d2c37b468d75.html）
         */

        $this->assign ( 'order', $odata );
        $this->assign ( 'jsApiParameters', $jsApiParameters );
        $this->assign ( 'editAddress', $editAddress );

		$this->display ( );
	}

    //支付完成接收支付服务器返回通知，PayNotifyCallBackController继承WxPayNotify处理定制业务逻辑
    public function notify(){

        $rsv_data = $GLOBALS ['HTTP_RAW_POST_DATA'];
        $result = xmlToArray($rsv_data);

        $map["appid"] = $result["appid"];
        $map["mchid"] = $result["mch_id"];

        $info = M ( 'member_public' )->where ( $map )->find ();
       //获取公众号信息，jsApiPay初始化参数
        $this->options['appid'] = $info['appid'];
        $this->options['mchid'] = $info['mchid'];
        $this->options['mchkey'] = $info['mchkey'];
        $this->options['secret'] = $info['secret'];
        $this->options['notify_url'] = $info['notify_url'];
        $this->wxpaycfg = new WxPayConfig($this->options);

        //发送模板消息
        $TMArray = array(
            "touser" => $result["openid"],
            "template_id" => "diW6jm5hBwemeoDF0FZdU2agSZ9kydje22YJIC0gVMo",
            "url" => "http://test.uctoo.com/index.php?s=/home/addons/execute/Ucuser/Ucuser/index/mp_id/107.html",
            "topcolor" => "#FF0000",
            "data" => array(
                "name" => array(
                    "value" => "优创智投",
                    "color" => "#173177",
                ),
                "remark" => array(
                    "value" => "今天",
                    "color" => "#173177",
                )
            )
        );

        $options['appid'] = $info['appid'];    //初始化options信息
        $options['appsecret'] = $info['secret'];
        $options['encodingaeskey'] = $info['encodingaeskey'];
        $weObj = new TPWechat($options);
        $res = $weObj->sendTemplateMessage($TMArray);

        //回复公众平台支付结果
        $notify = new PayNotifyCallBackController($this->wxpaycfg);    //
        $notify->Handle(false);

        //处理业务逻辑

    }

    //支付成功JS回调显示支付成功页
    public function orderpaid(){
        $map['order_id'] = I('order_id');
        $order = M('Order')-> where($map)->find();
        $this->assign ( 'order', $order );
        //显示支付成功结果页
        $this->display ();
    }



}
