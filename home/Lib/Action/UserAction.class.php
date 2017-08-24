<?php
class UserAction extends Action {
	
	/**
     * @函数	index
     * @功能	显示后台管理主页面（包含登录判断）
     */	
	
	public function index(){
		$username = $_GET['username'];
		//$username = $_SESSION['username'];
		//echo $username;	
		$user = M('User');
		$row = $user->where("username ='$username'")->find();
		if($row){
			$this->assign('row',$row);
			
		}else{
			$this->error('载入用户中心出错，请联系管理员',U('/User/index/'));
		}	
		
		$security = M('Security');
		$security_list = $security->order("sort desc,id desc")->select();
		$this->assign('security_list',$security_list);
		$this->display();
	}
	
	/**
     * @函数	quit
     * @功能	登出账户，跳转至首页。并清除Session
     */
    
    function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Index/index'),0, '重新登录');
    }
    
	/**
     * @函数	edit
     * @功能	用户编辑功能
     */
    
    function edit(){
    	header("Content-Type:text/html;charset=utf-8");
    	$username = $_GET['username'];
		
    	$user=M("User");
		$data=$user->create();
		
		$data['email'] = $_POST["useremail"];
		
		
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
			$user_info = json_encode($user_info);
        	$data["userinfo"] = $user_info;
        	$data["useranswer"] = md5($data["useranswer"]);
        	if(($data["userage"]<6 || $data["userage"]>100) && $data["userage"]){
        		$url = U('/User/index/username/'.$username);		
				redirect($url,3, '<center><div style="margin-top:150px;"><h1>年龄输入错误，正跳转至用户中心首页</h1></div></center>');
        	}
        	
        	if($user->where("username = '$username'")->save($data)){
				$this->success('修改成功',U('/User/index/username/'.$username));
        	}else{
        		$url = U('/User/index/username/'.$username);		
				redirect($url,3, '<center><div style="margin-top:150px;"><h1>修改失败，正跳转至用户中心首页</h1></div></center>');
        	}
        	if($data['email']){//如果修改邮箱
        		//发邮件验证，先不写了
        	}
			
		}else{
			$this->error($user->getError(),U('/User/index/username/'.$username));
		}
		
    }
	
}
?>