<?php

class IndexAction extends Action {
   
	/**
     * @函数	index
     * @功能	显示后台管理主页面（包含登录判断）
     */
	
	public function index(){	
		header("Content-Type:text/html; charset=utf-8");
		$ip = get_client_ip();//获取用户ip
		$this->assign('title',$ip);
		$this->display();
	}
	
	/**
     * @函数	login
     * @功能	用户登录
     */
	
	function login(){
		redirect(U('/Login/index'));
	}
	
	/**
     * @函数	quit
     * @功能	登出账户，跳转至登录页面。并清除Session
     */
	
    function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Index/index'),0, '重新登录');
    }
    

	
    function gotousercenter(){
    	$username = $_GET['username'];
    	$url = U('/User/index/username/'.$username);
		redirect($url,0,'跳转中...');
    }
}
?>


