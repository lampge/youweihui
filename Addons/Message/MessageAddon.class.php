<?php
namespace Addons\Message;
use Common\Controller\Addon;

/**
 * 系统环境信息插件
 * @author thinkphp
 */
class MessageAddon extends Addon{

    public $info = array(
        'name'=>'Message',
        'title'=>'在线咨询',
        'description'=>'在线咨询',
        'status'=>1,
        'author'=>'在路上',
        'version'=>'0.1'
    );

    public function install() {
		// $install_sql = './Addons/Message/install.sql';
		// if (file_exists($install_sql)) {
		// 	execute_sql_file($install_sql);
		// }
		return true;
	}
	public function uninstall() {
		// $uninstall_sql = './Addons/Message/uninstall.sql';
		// if (file_exists($uninstall_sql)) {
		// 	execute_sql_file($uninstall_sql);
		// }
		return true;
	}

    //实现的AdminIndex钩子方法
    public function AdminIndex($param){
        $config = $this->getConfig();
        $this->assign('addons_config', $config);
        if($config['display']){
            $lists = M('Message')->order('id desc')->select();
            $this->assign('_list', $lists);
            $this->display('info');
        }
    }

    public function message(){
        $this->display('message');
    }
}
