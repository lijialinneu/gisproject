<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>
<script type="text/javascript">
	function show(obj){
		obj.src="__APP__/Common/verify/random/"+Math.random();
	}
</script>
</head>
<body>


		<!--登录-->
		
	    <center>
		<h2>用户登录</h2>
		<div id="User-Login">
			<form  method="post" action="__URL__/login">
                  <p>
                  	邮箱：<input name="user_email"  type="text" id="user_email" value="邮箱"  />
                  </p>
                  <p>
                  	密码：<input type="password" name="password" id="password" value="密码"/>
                  </p>
                  <p>
                  	<span>验证码：</span>
                  	<span><input type="text" size="6" id="verify" name="verify" /></span>
                  	<span><img src="__APP__/Common/verify/" onclick="show(this);"></span>
                  </p>
                  <p>
                  	<input type="submit"  id="UserLoginBut" value="登录" />
                  	<span>[<a  href="__URL__/register/" target="_blank">注册新用户</a>]</span>
                  	<span>[<a  href="__URL__/findpwd/" target="_blank">忘记密码?</a>]</span>
                  </p>
                  <p class="wei_ico">
                  	<span>使用其它帐号登录：</span>
                    <span><a id="qqLink"  title="使用QQ登录"   href="">使用QQ帐号登录</a></span>
                    <span><a id="sinaLink"  title="使用新浪微博帐户登录"   href="">使用新浪微博帐户登录</a></span>
                  </p>
                       
             </form>
		</div>
</center>

 
        <!--end登录-->
</body>
</html>