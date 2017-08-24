<?php
/**
 * @类 IndexAction
 * @功能	后台首页控制器
 */
class IndexAction extends Action {	
	
	/**
     * @函数	index
     * @功能	显示后台管理主页面（包含登录判断）
     */
	
    public function index(){ 	
        header("Content-Type:text/html; charset=utf-8");
 
		if(session('adminname')){
			$this->assign('title','后台管理系统');
			$this->assign('adminname',session('adminname'));
			$this->display();
		}else{	
			$url = U('/Login/index/');
			redirect($url,1,'<center><div style="margin-top:150px;"><h1>您好，请先登录！正在跳转到登录界面</h1></div></center>');
		}	
    }
    
    /**
     * @函数	quit
     * @功能	登出账户，跳转至登录页面。并清除Session
     */
    
    function quit(){
    	session(null);//清空所有session信息
		redirect(U('/Login/index'),0, '重新登录');
    }
    
    /**
     * @函数	showmanageuser
     * @功能	跳转至管理用户信息页面
     */
    
    function showmanageuser(){
    	$this->assign('adminname',session('adminname'));

			//实例化用户模型
			$users = M('User');	
			$count = $users->count();
		
			//分页显示用户列表
			import('ORG.Util.Page');
			$page = new Page($count,5);//后台管理页面默认一页显示5个用户
			
            //设置分页回调方法
			$show = $page->show();
	
			$users_list = $users->field(array('userid','username','useremail'))->order('userid asc')->limit($page->firstRow.','.$page->listRows)->select();
			
			$this->assign('news_count',$count);
			$this->assign('title','后台管理系统');
			$this->assign('users_list',$users_list);
			$this->assign('page_method',$show);
    		
			$this->display("../Index/manageuser");
    }
    
    
    /**
     * @函数	delete
     * @功能	删除用户
     */
    
    function delete(){
    
    	//跳转至User控制器来实现
    	
	    	if($_GET['userid']){
	    		redirect(U('/User/delete/userid/'.$_GET['userid']),0, '删除用户');
	    	}
	    	else{
	    		$this->error('参数错误！',U('/Index/showmanageuser/'));
	    	}
    }
    
	/**
     * @函数	showaddgis
     * @功能	跳转到增加gis管理页面
     */
    
    function showaddgis(){
    	if(session('adminname')){
			$this->assign('adminname',session('adminname'));
			$this->assign('title','增加GIS');
			$this->display("../Index/addgis");
		}else{	
			$url = U('/Login/index/');
			redirect($url,1,'<center><div style="margin-top:150px;"><h1>您好，请先登录！正在跳转到登录界面</h1></div></center>');
		}	
		
    }
    
	/**
     * @函数	showmanagegis
     * @功能	跳转到修改gis管理页面
     */
    
    function showmanagegis(){
    	if(session('adminname')){
			$this->assign('adminname',session('adminname'));
			
			//实例化GIS模型
			$point = M('Point');	
			$count = $point->count();
			
			//分页显示point列表
			import('ORG.Util.Page');
			$page = new Page($count,5);//后台管理页面默认一页显示5个
				
	        //设置分页回调方法
			$show = $page->show();
			
			$point_list = $point->field(array('YEAR(timestamp)','AsText(point)','type','name','introduce'))->limit($page->firstRow.','.$page->listRows)->order('AsText(point) , YEAR(timestamp) desc')->select();
	
			for($i=0;$i<5;$i++){
				$point_list[$i]['introduce'] = json_decode($point_list[$i]['introduce'],true);
			}
			
			$this->assign('page_method',$show);
		    $this->assign('title','后台管理系统');
			$this->assign('point_list',$point_list);
			$this->assign('title','管理GIS');
			
			$this->display("../Index/managegis");
		}else{	
			$url = U('/Login/index/');
			redirect($url,1,'<center><div style="margin-top:150px;"><h1>您好，请先登录！正在跳转到登录界面</h1></div></center>');
		}	
    }

	
    
	/**
     * @函数	addgis
     * @功能	增加GIS
     */
    
    function addgis(){
    	$point = D("Point");
		$data = $point->create();
    	 
    	if($data){
    		header("Content-Type:text/html;charset=utf-8");
    		$longitude = $_POST["longitude"];
    		$latitude = $_POST["latitude"];

    		$introduce = array(
					'text' => urlencode($_POST['text']),
					'picture' => urlencode($_POST['picture']),
					'video' => urlencode($_POST['video']),
    		);

    		$data['introduce'] = urldecode(json_encode($introduce));
    		$data['point'] = "POINT($longitude $latitude)";
    		$data['uri'] = $_POST["wiki"];
    		$data['status'] = 1;
    		$insertsql = "INSERT INTO tb_point (`timestamp`,point,type,`name`,introduce,uri,status)
					        VALUES ('$data[timestamp]',PointFromText('POINT($longitude $latitude)'),'$data[type]', '$data[name]','$data[introduce]','$data[uri]','$data[status]')";

    		mysql_query("set names utf-8");

    		if(mysql_query($insertsql)){

				$this->success('添加成功');
    		}else{
    			$this->error('添加失败',U('/Index/showaddgis/'));
    		}
    	}else{
    		$this->error($point->getError(),U('/Index/showaddgis/'));
	    }
    }
    
    /**
     * @函数	deletegis
     * @功能	删除GIS
     */
    
    function deletegis(){
    	header("Content-Type:text/html;charset=utf-8");
    	
    	$point = D('Point');
    	$timestamp =  $_GET['timestamp'];
    	$pointinfo = $_GET['point'];
    	
    	$selectsql = "SELECT timestamp,AsText(point),type,name,introduce,attention,score,status,uri FROM tb_point ";
		$point_dustbin = $point->query($selectsql);
		
		$timestamp = $point_dustbin[0]['timestamp'];
    	$pointinfo = $point_dustbin[0]['AsText(point)'];
    	$type = $point_dustbin[0]['type'];
    	$name = $point_dustbin[0]['name'];
    	$introduce = $point_dustbin[0]['introduce'];
    	$attention = $point_dustbin[0]['attention'];
    	$score = $point_dustbin[0]['score'];
    	$status = $point_dustbin[0]['status'];
    	$uri = $point_dustbin[0]['uri'];

  		//把删除的GIS信息存到回收站里，避免误删
    	$dustbingis = D('DustbinGIS');
   		$insertsql = "INSERT INTO tb_dustbingis (timestamp,point,type,name,introduce,attention,score,status,uri) 
				      VALUES ($timestamp,PointFromText('$pointinfo'),'$type', '$name','$introduce','$attention','$score','$status','$uri')";
		
		$dustbingis->execute($insertsql);

    	if($point->where("timestamp = '$timestamp' AND AsText(point) = '$pointinfo'")->delete()){
			$this->success('数据删除成功',U('Index/showmanagegis'));
		}else{
			$this->error($point->getLastSql());
		}
    }
    
    /**
     * @函数showaltergis
     * @功能	 跳转到修改GIS页面
     */
    
    function showaltergis(){
		if(session('adminname')){
			
			$point = D('Point');
			$count = $point->count();
			
			$timestamp =  $_GET['timestamp'];
	    	$pointinfo = $_GET['point'];
	 
	    	$point_list = $point->field(array('YEAR(timestamp)','AsText(point)','type','name','introduce','uri'))->where("YEAR(timestamp) = '$timestamp' AND AsText(point) = '$pointinfo'")->select();
			$point_list[0]['introduce'] = json_decode($point_list[0]['introduce'],true);
	    	
	    	
			$this->assign('adminname',session('adminname'));
			$this->assign('point_list',$point_list);
			$this->assign('title','修改GIS');
			$this->display("../Index/altergis");
		}else{	
			$url = U('/Login/index/');
			redirect($url,1,'<center><div style="margin-top:150px;"><h1>您好，请先登录！正在跳转到登录界面</h1></div></center>');
		}	
    }
    
    /**
     * @函数altergis
     * @功能	 修改GIS
     */
    
    function altergis(){
    	$point = D('Point');
    	
    	$timestamp = $_POST['default_timestamp'];
    	$pointinfo = $_POST['default_point'] ;
    	$data['timestamp'] =  $_POST['timestamp']."-01-01";
    	$data['pointinfo'] = $_POST['point'];
    	$data['type'] =  $_POST['type'];
    	$data['name'] = $_POST['name'];
    	$data['uri'] =  $_POST['wiki'];

	    $introduce = array(
			'text' => urlencode($_POST['text']),
			'picture' => urlencode($_POST['picture']),
			'video' => urlencode($_POST['video']),
		);
	
		$data['introduce'] = urldecode(json_encode($introduce));
		
	    $result = $point->where("YEAR(timestamp) = '$timestamp' AND AsText(point) = '$pointinfo'")->save($data);
	 
	    if($result){
	    	$this->success('修改成功',U('Index/showmanagegis'));
		}else{
			$this->error($point->getLastSql());
		}
	
    }
    
}

