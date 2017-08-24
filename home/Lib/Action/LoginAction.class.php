<?php 
class LoginAction extends Action{
	
	/**
     * @函数	index
     * @功能	显示登录页面
     */
	function index(){
		
		//配置页面显示内容
		$this->assign('title','用户登录');
		$this->display();
	}
	
    /**
     * @函数	login
     * @功能	登录判断
     */
	
	function login(){
		 header("Content-Type:text/html; charset=utf-8");
		//首先检查验证码是否正确(验证码存在Session中)
		if(	$_SESSION['verify']	!=	md5($_POST['verify'])	){
			$this->error('验证码不正确',U('/Login/index/'));
		}
		
		$user = M('User');//参数的User必须首字母大写，否则自动验证功能失效！
		$user_email = $_POST['user_email'];
		$password = md5($_POST['password']);
		
		//检查邮箱格式是否正确
		$pattern = "/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/";
		if(!preg_match($pattern, $_POST['user_email'])){
			$this->error('邮箱格式错误',U('/Login/index/'));
		}
		
		//查找输入的用户名是否存在
		$rows = $user->where("useremail ='$user_email' AND userpassword = '$password'")->find();
		if($rows['userstatus'] == 3){
			//需要邮件验证
				echo "您需要对邮件进行验证才能登录";
				$verification = md5(time().$_POST["useremail"]);
				
				$str = "http://127.0.0.1/test/home/Lib/Action/Register/chkverify?verify='$verification'&email='$email";
				$linkstr = md5($str);
				$mailInfo = array(
					"greetings" => "尊敬的会员",
					"verification" => $verification,
					"email" => $user_email,
					"time" => time(),
					"linkstr" => $linkstr,
				);
				$this->assign("mail",$mailInfo);
				//邮件内容
				$body=$this->fetch("Public:mail");
				
	        	if(SendMail($user_email,"欢迎您加入'行走沈阳'",$body)){
	        		
	        		//将验证码保存到数据库
					$verify = M("Verification");
					$datav = $verify->create();
					$datav["verification"] = $verification;
					$datav["add_time"] = time();
					
					if (!$verify->add($datav)){
						echo "验正码保存出错,请联系管理员";	
					}	
				}else{
					echo "发送邮件错误";
				}
				
				
		}else if($rows['userstatus'] == 2){
			//管理员审核中
			$this->error('管理员正在审核您的信息。。',U('/Index/index/'));
		}else if($rows['userstatus'] == 1){
			$_SESSION['username'] = $rows['username'];    
			$url = U('/Index/index/username/'.$username);			
			redirect($url,0, '跳转中...');
		}else{
			$this->error('用户邮箱或密码错误',U('/Login/index/'));
		}
	

	}

	
	/**
     * @函数	register
     * @功能	跳转到注册控制器
     */
	
	function register(){
		redirect(U('/Register/index'));
	}
    
    /**
     * @函数	findpwd
     * @功能	跳转到找回密码控制器
     */
	
	function findpwd(){
		redirect(U('/Getpwd/index'));
	}

}



?>