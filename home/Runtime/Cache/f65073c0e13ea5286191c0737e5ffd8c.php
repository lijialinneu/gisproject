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

</head>

<body>
<div id="body-wrapper">

  <div id="sidebar">
    <div id="sidebar-wrapper">
     
      	<h1 id="sidebar-title">Simpla Admin</h1>
	      	<a href="http://127.0.0.1/test/index.php">
	      		<img id="logo" src="__PUBLIC__/Images/admin/logo.png" alt="Simpla Admin logo" />
		    </a>
      	<div id="profile-links"> 
      		您好,<a href="#" title="当前用户:<?php echo ($_SESSION['username']); ?>"><?php echo ($_SESSION['username']); ?></a> |
	 		<a href="__URL__/quit" title="退出">退出</a> 
       	</div>
       	
	    <ul id="main-nav">
     		<!-- 类型为nav-top-itrm current 表示选中时的样式 -->
     		 <li> <a href="#" class="nav-top-item current" >个人信息管理</a>
	          <ul>
	            <li><a href="#">查看城市兴趣点访问记录</a></li>
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
    <h2>后台管理系统</h2>
	<br></br>
	
    <!--ul class="shortcut-buttons-set">
      <li>
      	<a class="shortcut-button" href="#">
      		<span> 
      			<img src="__PUBLIC__/Images/admin/icons/pencil_48.png" alt="icon" /><br />
        		写文章
        	</span>
        </a>
      </li>
      
      <li>
      	<a class="shortcut-button" href="__URL__/article">
      		<span> 
      			<img src="__PUBLIC__/Images/admin/icons/paper_content_pencil_48.png" alt="icon" /><br />
        		写新闻
        	</span>
        </a>
      </li>
      
       
      <li>
      	<a class="shortcut-button" href="#">
      		<span> 
      			<img src="__PUBLIC__/Images/admin/icons/image_add_48.png" alt="icon" /><br />
        		上传图片
        	</span>
        </a>
      </li>
      
      <li>
      	<a class="shortcut-button" href="#">
      		<span> 
      			<img src="__PUBLIC__/Images/admin/icons/clock_48.png" alt="icon" /><br />
        		添加事件
        	</span>
        </a>
      </li>
     
      
    </ul-->
    

    <div class="clear"></div>
    
    

    <div class="content-box">
    
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3></h3>
        <ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">查看个人信息</a></li>
          <!-- href must be unique and match the id of target div -->
          <li><a href="#tab2">编辑个人信息</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <!-- This is the target div. id must match the href of this div's tab -->
          <div class="notification attention png_bg"> <a href="#" class="close"><img src="__PUBLIC__/Images/admin/icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>您好，<?php echo ($_SESSION['username']); ?>，下面是您的个人信息！ </div>
          </div>
          
          <!-- 表头 -->
          <table>
            <tr>
          		<td>用户名</td>
          		<td><?php echo ($row["username"]); ?></td>
          	</tr>
          	<tr>
          		<td>邮箱</td>
          		<td><?php echo ($row["useremail"]); ?></td>
          	</tr>
          	<tr>
          		<td>电话</td>
          		<td><?php echo ($row["usertel"]); ?></td>
          	</tr>
          	<tr>
          		<td>安全问题</td>
          		<td><?php echo ($row["userquestion"]); ?></td>
          	</tr>
          	<tr>
          		<td>答案</td>
          		<td>（用MD5加密的答案，待定）</td>
          	</tr>
          	<tr>
          		<td>年龄</td>
          		<td><?php echo ($row["userage"]); ?></td>
          	</tr>
          	<tr>
          		<td>QQ</td>
          		<td><?php echo ($row["userqq"]); ?></td>
          	</tr>
          	<tr>
          		<td>微博</td>
          		<td><?php echo ($row["userweibo"]); ?></td>
          	</tr>
          	<tr>
          		<td>职业</td>
          		<td><?php echo ($row["professional"]); ?></td>
          	</tr>

          	<tr>
          		<td>个人介绍</td>
          		<td><textarea cols="29" rows="5" placeholder='<?php echo ($row["introduce"]); ?>' readonly></textarea></td>
          	</tr>
 
          </table>
        </div>
        
        
        
        <!-- End #tab1 -->
        <div class="tab-content" id="tab2">
          <form action="__URL__/edit/username/<?php echo ($row["username"]); ?>" method="post">
            <fieldset>
            <p>
              <label>可编辑信息</label>
              	邮箱：<input class="text-input small-input" type="text" id="small-input" name="useremail" value="<?php echo ($row["useremail"]); ?>"/>
              <br />
            	 电话：<input class="text-input small-input" type="text" id="small-input" name="usertel" value="<?php echo ($row["usertel"]); ?>"/>
              <br />
              	年龄：<input class="text-input small-input" type="text" id="small-input" name="userage" value="<?php echo ($row["userage"]); ?>"/>
              <br />
              	Q Q：<input class="text-input small-input" type="text" id="small-input" name="userqq" value="<?php echo ($row["userqq"]); ?>"/>
              <br />
             	 微博：<input class="text-input small-input" type="text" id="small-input" name="userweibo" value="<?php echo ($row["userweibo"]); ?>"/>
              <br />
             	 职业：<input class="text-input small-input" type="text" id="small-input" name="professional" value="<?php echo ($row["professional"]); ?>"/>
              <br />
             	 安全问题:
	              <select name="userquestion" class="small-input">
	                <option value="<?php echo ($row["userquestion"]); ?>"><?php echo ($row["userquestion"]); ?>(已选)</option> 
	                <?php if(is_array($security_list)): $i = 0; $__LIST__ = $security_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["question"]); ?>"><?php echo ($vo["question"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
	              </select>
              <br/>
              	答案：<input class="text-input small-input" type="text" id="small-input" name="useranswer" />
              <br/>
              <small>A small description of the field</small> 
           </p>
            <p>
              <label>个人介绍</label>
              <textarea class="text-input textarea wysiwyg" id="textarea" name="introduce" cols="79" rows="15" value="<?php echo ($row["introduce"]); ?>"></textarea>
            </p>
            <p>
              <input class="button" type="submit" value="Submit" />
            </p>
            </fieldset>
            <div class="clear"></div>
            <!-- End .clear -->
          </form>
        </div>
        <!-- End #tab2 -->
      </div>
      <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    
   

    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2010 Your Company | Powered by <a href="http://www.865171.cn">admin templates</a> | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>