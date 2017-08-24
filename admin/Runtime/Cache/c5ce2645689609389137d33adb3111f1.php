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
	        <li> <a href="#" class="nav-top-item current">数据管理</a>
	          <ul>
	            <li><a href="__URL__/showaddgis">增加城市GIS</a></li>
	            <li><a href="#" class="current">修改城市GIS</a></li>
	            <li><a href="__URL__/showdelgis">删除城市GIS</a></li>
	          </ul>
	        </li>
			<li> 
				<a href="__URL__/user" class="nav-top-item">用户信息管理</a>
				<ul>
		            <li><a href="__URL__/showdelete">删除用户</a></li>
		            <li><a href="__URL__/showmoduser">修改用户权限</a></li>
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
    <h2>行走沈阳-后台管理系统</h2>
	<br></br>
    <div class="clear"></div>
    <div class="content-box">
    
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3></h3>
        <ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">修改城市GIS</a></li>
          <!-- href must be unique and match the id of target div -->
          <!--li><a href="#tab2">登录记录</a></li-->
        </ul>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <!-- This is the target div. id must match the href of this div's tab -->
          <div class="notification attention png_bg"> <a href="#" class="close"><img src="__PUBLIC__/Images/admin/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>您好，<?php echo ($adminname); ?>，您可以在下面修改城市GIS！ </div>
          </div>
          
          <!-- 表头 -->
          <table>
            <thead>
              <tr>
                <th>
                 
                </th>
                <th>用户id</th>
                <th>用户名</th>
                <th>邮箱</th>	 
                <th>操作</th>
              </tr>
            </thead>
              
            <!-- 表内容部分 -->
            <tbody>
              <?php if(is_array($users_list)): $i = 0; $__LIST__ = $users_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td></td>
                <td><?php echo ($vo['userid']); ?> </td>
                <td><a href="#" title="title"><?php echo ($vo['username']); ?></a></td>
                <td><?php echo ($vo['useremail']); ?></td>
                <td>
                  <!-- Icons -->
                  <!--a href="__URL__/edit/userid/<?php echo ($vo['userid']); ?>" title="修改"><img src="__PUBLIC__/Images/admin/icons/pencil.png" alt="修改" /></a--> 
                  <a href="__URL__/delete/userid/<?php echo ($vo['userid']); ?>" title="删除" onclick="delcfm()"><img src="__PUBLIC__/Images/admin/icons/cross.png" alt="删除" /></a>
                  
                </td>
              </tr><?php endforeach; endif; else: echo "" ;endif; ?>                        
            </tbody>
           
           
            
              <!-- 表尾 -->
            <tfoot>
              <tr>
                <td colspan="6">
                  <div class="pagination">               	  
                  	<?php echo ($page_method); ?>
                  	
                  </div>                 
                  <div class="clear"></div>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        
      </div>
      <!-- End .content-box-content -->
    </div>
    
    </div> 
    <!-- End .content-box -->
    <div class="clear"></div>
   

    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2014 XXXX Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
</html>