<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>
<script src="__PUBLIC__/Js/home/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/Js/home/getpwd.js" type="text/javascript"></script>	
</head>
<body>
<h1>两种找回方式</h1>
<input type="checkbox" name="che_1" class="che_1" style="display:none" style="checked:false" onchange="ShowByMail(this);">
<em>邮箱找回(默认)</em>
<fieldset class="ByMail"  title="邮箱找回">
			<legend>邮箱找回(默认)</legend>
			<form method="post" action="">
				请输入您的注册邮箱:<input type="text" name="bymail" value="邮箱"/>
			    <input type="submit" name="bymail_submit" value="确定"/>
			</form>
</fieldset><br/>
<input type="checkbox" name="che_2" class="che_2" style="checked:false" onchange="ShowByName(this);"><em>用户名找回</em>
<fieldset class="ByName"  style="display:none" title="用户名找回">
			<legend>用户名找回</legend>
			<form method="post" action="">
				请输入您的用户名:<input type="text" name="byname" value="用户名"/>
			    <input type="submit" name="byname_submit" value="确定"/>
			</form>
 </fieldset>

</body>
</html>