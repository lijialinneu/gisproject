<?php
class GetpwdAction extends Action{
	
	/**
     * @函数	index
     * @功能	显示找回密码页面
     */
	
	function index(){
		
		//配置页面显示内容
		$this->assign('title','用户找回密码');
		$this->display("../Login/getpwd");
	}
	
	/**
     * @函数	bymail
     * @功能	通过邮箱找回密码
     */
	
	function bymail(){
		$email = $_POST["email"];
		
		//对email正则匹配,如果匹配失败跳转至找回密码首页
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (! preg_match( $pattern, $email ) )
        {
            $this->error('您输入的Email格式错误',U('/Getpwd/index/'));
        }
        
        //通过输入的Email到tb_user中查询是否有该用户
        $user = D('User');
        $row = $user->where("useremail ='$email'")->find();
        
		if($row){
			
			//产生一个验证码
			$verification = md5(time().$email);
			
		    $str = "http://127.0.0.1/test/home/Lib/Action/Register/chkverify?verify='$verification'&email='$email";
			$linkstr = md5($str);
		    $mailInfo = array(
				"greetings" => "尊敬的会员",
				"verification" => $verification,
				"email" =>$email,
				"time" => time(),
		    	"linkstr" => $linkstr,
			);
			$this->assign("mail",$mailInfo);
			
			//邮件内容
			$body=$this->fetch("Public:mailgetpwd");
				
	        if(SendMail($email,"'行走沈阳'找回密码",$body)){
	        		
	        	//将验证码保存到数据库
				$verify = M("Verification");
					
				$datav = $verify->create();
				$datav["verification"] = $verification;
				$datav["add_time"] = time();
				if (!$verify->add($datav)){
					echo "验正码保存出错,请联系管理员";	
				}
				$this->success('邮件已发送，请您及时查收');	
			}else{
				echo "发送邮件错误";
			}
			
			
		}else{
			$this->error('这个邮箱未注册',U('/Getpwd/index/'));
		}	
        
	}
	
	/**
     * @函数	byname，先不写，以后再说
     * @功能	通过用户名找回密码
     */
	
	function byname(){
		echo "byname";
	}
	
	/**
     * @函数	chkverify
     * @功能	验证邮件的验证码
     */
	
	function chkverify(){
		header("Content-Type:text/html;charset=utf-8");
		$verification = D('Verification');
		$verify = $_GET['verify'];
		
		$rows = $verification->where("verification ='$verify'")->find();
		$nowtime = time();
		
		if($rows){
			if($nowtime - $rows['add_time'] > 3600){//默认为一小时
				echo "链接已过期，我们重新给您发一封邮件";
				
				//重发邮件
				$verifications = md5(time().$useremail);
	        	$str = "http://127.0.0.1/test/home/Lib/Action/Register/chkverify?verify='$verifications'&email='$useremail";
				$linkstr = md5($str);
				$mailInfo = array(
						"greetings" => "尊敬的会员",
						"verification" => $verifications,
						"email" => $useremail,
						"time" => time(),
						"linkstr" => $linkstr,
				);
				$this->assign("mail",$mailInfo);
				//邮件内容
				$body=$this->fetch("Public:mailgetpwd");
					
		        if(SendMail($useremail,"欢迎您加入'行走沈阳'",$body)){
		        		
		        	//将验证码保存到数据库
					$verify = M("Verification");
					$datav = $verify->create();
					$datav["verification"] = $verifications;
					$datav["add_time"] = time();
						
					if (!$verify->add($datav)){
						echo "验正码保存出错,请联系管理员";	
					}	
				}else{
					echo "发送邮件错误";
				}
			}else{
				//删除tb_verification中对应的链接
				/*if($verification->where("verification ='$verify'")->delete()){
			 		echo "删除链接成功";
			 	}else{
			 		echo "删除链接失败";
			 	}
			 	*/
				$useremail = $_GET['email'];//取得用户名
				$url = U('/Getpwd/showresetpwd/useremail/'.$useremail);	
				redirect($url,0, '正在跳转至重设密码页码...');
			}

		}else{
			echo "找回密码失败，请联系管理员！！";
		}	
	}
	
	/**
     * @函数	showresetpwd
     * @功能	重设密码
     */
	
	function showresetpwd(){
		
		$email = $_GET['useremail'];
		$this->assign('email',$email);
		$this->assign('title','重设密码');
		$this->display("../Login/resetpwd");
		
	}
	
	
	/**
     * @函数	resetpwd
     * @功能	重设密码
     */
	
	function resetpwd(){
		header("Content-Type:text/html;charset=utf-8");
		$useremail = $_POST['email'];
		
		
		$user = D('User');
		$data=$user->create();
		
		if($data){
		 	if($user->where("useremail = '$useremail'")->save($data)){
		 		$this->success("重设密码成功",U('/Login/index/'));
		 	}else{
		 		$this->error("重设密码失败，请联系管理员",U('/Getpwd/showresetpwd/'));
		 	}
		}else{
			$this->error($user->getError(),U('/Getpwd/showresetpwd/'));
		}
		
		
	}
}
?>