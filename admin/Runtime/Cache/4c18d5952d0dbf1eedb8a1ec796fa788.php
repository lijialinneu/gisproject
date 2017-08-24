<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($title); ?></title>

<link rel="stylesheet" href="__PUBLIC__/Css/admin/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="__PUBLIC__/Css/admin/invalid.css" type="text/css" media="screen" />

<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/facebox.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery.wysiwyg.js"></script>

<script type="text/javascript">
function delcfm() {
    if (!confirm("确认要删除？")) {
        window.event.returnValue = false;
    }
}
</script>

</head>

<body>
<div id="body-wrapper">
  <div id="sidebar">
    <div id="sidebar-wrapper">
      	<h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
      	<img id="logo" src="__PUBLIC__/Images/admin/logo.png" alt="Simpla Admin logo" />
      	
      	<div id="profile-links"> 
      		您好,<a href="#" title="当前用户:<?php echo ($adminname); ?>"><?php echo ($adminname); ?></a> |
	 		<a href="__URL__/quit" title="退出">退出</a>
       	</div>
       	
	    <ul id="main-nav">
     		<!-- 类型为nav-top-item current 表示选中时的样式 -->
	        <li> <a href="#" class="nav-top-item">数据信息管理中心</a>
	          <ul>
	            <li><a href="__URL__/showaddgis">增加城市GIS</a></li>
	            <li><a href="__URL__/showmanagegis">管理城市GIS</a></li>
	          </ul>
	        </li>
			<li> 
				<a href="#" class="nav-top-item">用户信息管理中心</a>
				<ul>
		            <li><a href="__URL__/showmanageuser">管理用户信息</a></li>
		        </ul>
	        </li>
	     </ul>
    </div>
  </div>
  <!-- End #sidebar -->
  
  
  
  <div id="main-content">
 
    <noscript>
    <!-- Show a notification if the user has disabled javascript -->
	    <div class="notification error png_bg">
	      	<div> Javascript is disabled or is not supported by your browser. Please <a href="http://browsehappy.com/" title="Upgrade to a better browser">upgrade</a> your browser or <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="Enable Javascript in your browser">enable</a> Javascript to navigate the interface properly.
	        Download From
	        </div>
	    </div>
    </noscript>
    
    
    <!-- Page Head -->
    <div id="welcome">
    <h2>行走沈阳-后台管理系统</h2>
    <img src="__PUBLIC__/Images/home/1.jpg"></img>
	</div>
    
 

    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2014 XXXX Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
</html>