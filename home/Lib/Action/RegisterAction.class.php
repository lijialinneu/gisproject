<?php
class RegisterAction extends Action{
	
	/**
     * @函数	index
     * @功能	显示注册页面
     */
	
	function index(){
		
		//从数据库tb_security表中查询出所有安全问题
		$security = M('Security');
		$security_list = $security->order("sort desc,id desc")->select();
		$this->assign('security_list',$security_list);
		
		//从数据库tb_clause表中查询条款
		$clause = M('Clause');
		$clause_list = $clause->select();
		$this->assign('clause_list',$clause_list);
		
		$this->assign('title','用户注册');
		$this->display("../Login/register");
	}
	
	/**
     * @函数	register
     * @功能	用户注册限制
     */
	
	function register(){
		$user = D("User");
		$data = $user->create();
		
		$email = $_POST["useremail"];
		$username = $_POST["username"];
		
		$user_info = array(
			"userweibo" => $_POST["userweibo"],
			"userage" => $_POST["userage"],
			"userqq" => $_POST["userqq"],
			"usrtel" =>$_POST["usertel"],
			"professional" => $_POST["professional"],
			"introduce" => $_POST["introduce"],
			"userquestion" => $_POST["userquestion"],
			"useranswer" => $_POST["useranswer"]
		); 

        if($data){
        	header("Content-Type:text/html;charset=utf-8");
        	$user_info = json_encode($user_info);
        	$data["userinfo"] = $user_info;
        	$data["useranswer"] = md5($data["useranswer"]);
        	if(($data["userage"]<6 || $data["userage"]>100) && $data["userage"]){
        		$this->error('年龄输入有误',U('/Login/register/'));
        	}
        	$data["regtime"] = time();//注册时间
        	$data["permission"] = 1;//初始权限
        	$data["userstatus"] = 3;//邮件审核

        	if($user->add($data)){

        		$verification = md5(time().$_POST["useremail"]);
        		
        		$str = "http://127.0.0.1/gisproject/home/Lib/Action/Register/chkverify?verify='$verification'&email='$email";
				$linkstr = md5($str);
				$mailInfo = array(
					"greetings" => "尊敬的会员",
					"verification" => $verification,
					"email" => $email,
					"time" => time(),
					"linkstr" => $linkstr,
				);
				$this->assign("mail",$mailInfo);
				//邮件内容
				$body=$this->fetch("Public:mail");
				
	        	if(SendMail($email,"欢迎您加入'行走沈阳'",$body)){
	        		
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
				header("Content-Type:text/html;charset=utf-8");
        		$_SESSION['username'] = $username;
        		$url = U('/Index/index/username/'.$username);		
				redirect($url,3, '注册成功，正在跳转至首页...');
				
	        		
	        }else{
	        	$this->error('注册失败，请联系管理员');	
	        }	
	        	
        }else{
			$this->error($user->getError(),U('/Login/register/'));
        }
	}
	
	/**
     * @函数	chkverify
     * @功能	验证邮件的验证码
     */
	
	function chkverify(){
		header("Content-Type:text/html;charset=utf-8");
		$verification = D('Verification');
		$verify = $_GET['verify'];
		$useremail = $_GET['email'];
		
		$rows = $verification->where("verification ='$verify'")->find();
		$nowtime = time();
		
		if($rows){
			if($nowtime - $rows['add_time'] > 3600){//默认为一小时
				echo "链接已过期，我们重新给您发一封邮件";
				
				//重发邮件
				$verifications = md5(time().$useremail);
	        	$str = "http://127.0.0.1/gisproject/home/Lib/Action/Register/chkverify?verify='$verifications'&email='$useremail";
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
				$body=$this->fetch("Public:mail");
					
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
			}else{//链接在有效期内
				$user = M('User');
				$data = $user->create();
				$data["userstatus"] = 1;
				if($user->where("useremail = '$useremail'")->save($data)){
			 		$this->success("修改用户状态成功");
			 	}else{
			 		$this->error("修改用户状态失败，请联系管理员");
			 	}
			 	
			 	//删除tb_verification中对应的链接
			 	if($verification->where("verification ='$verify'")->delete()){
			 		echo "删除链接成功";
			 	}else{
			 		echo "删除链接失败";
			 	}
				echo "验证邮箱成功！！";
			}
		}else{
			echo "验证邮箱失败，请联系管理员！！";
		}
		
	}
	
}

?>