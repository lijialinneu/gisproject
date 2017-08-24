<?php 
/**
 * @类 LoginAction
 * @功能	管理员控制器
 */
class LoginAction extends Action{
	
	/**
     * @函数	index
     * @功能	显示管理员登录页面
     */
	function index(){
		
		//配置页面显示内容
		$this->assign('title','后台管理系统');
		$this->display();
	}
	
	/**
     * @函数	login
     * @功能	管理员登录判断
     */
	function login(){
		 header("Content-Type:text/html; charset=utf-8");
		 
		//首先检查验证码是否正确(验证码存在Session中)
		if(	$_SESSION['verify']	!=	md5($_POST['verify'])	){
			$this->error('验证码不正确',U('/Login/index/'));
		}
		
		$admin = M('Admin');//参数的Admin必须首字母大写，否则自动验证功能失效！
		$adminname = $_POST['adminname'];
		$adminpassword = md5($_POST['adminpassword']);

		//查找输入的管理员名是否存在
		if($admin->where("adminname ='$adminname' AND adminpassword = '$adminpassword'")->find()){
			session(adminname,$adminname);
			$url = U('/Index/index/adminname/'.$adminname);			
			redirect($url,0, '跳转中...');
		}else{
			$this->error('用户名或密码错误',U('/Login/index/'));
		}	
	}

}
?>