<?php
/**
 * @类		IndexAction
 * @功能	后台首页控制器
 */
class UserAction extends Action{
	
	private  $user_list;
	
	/**
     * @函数	index
     * @功能	显示用户主页面
     */
	
	function index(){
		header("Content-Type:text/html; charset=utf-8");
		$this->assign('title','修改用户信息');
		if($userid=(int)$_GET['userid']){
			$user=M('User');
			$user_list=$user->where("userid=$userid")->find();		
			$this->assign('uesrlist',$userlist);	
			$this->assign('btn_ok_text','完成修改');
			$this->assign('btn_ok_act','update');
		}else{
			$this->assign('btn_ok_act','add');
			$this->assign('btn_ok_text','添加文章');
		}
		$this->display();
	}
	
	/**
     * @函数	delete
     * @功能	删除用户
     */
	
	function delete(){	
    	$user = M('User');
    	$userid =  $_GET['userid'];
    	$userinfo = $user->where("userid ='$userid'")->select();
    	
  		//把删除的用户信息存到回收站里，避免误删
    	$dustbin = M('Dustbin');
		$dustbin->add($userinfo[0]);
		
    	if($user->delete($userid)){
			$this->success('用户删除成功',U('Index/showmanageuser'));
		}else{
			$this->error($user->getLastSql());
		}
	}
		
}

?>