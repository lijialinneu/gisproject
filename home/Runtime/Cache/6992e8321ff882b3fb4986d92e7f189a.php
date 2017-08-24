<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>
<script src="__PUBLIC__/Js/home/jquery.js" type="text/javascript"></script>
<script src="__PUBLIC__/Js/home/checkbox.js" type="text/javascript"></script>	
</head>
<body>
<!-- 注册 begin -->

<form name="form1" method="post" action="__URL__/register">
	<p><span class="date">【用户注册】</span> </p>
    <div class="main">
		<fieldset  title="基础项" class="base">
			<legend>基础选项（必填）</legend>
				<ul>
					<li>用户名：<input  type="text" name="username" size="30"><em>用户名，支持中文</em></li>
					<li>登录邮箱：<input  type="text" name="useremail" size="30"><em>请埴写邮箱</em></li>
					<li>登录密码：<input  type="password" name="userpassword" size="30"><em>密码6~20位</em></li>
					<li>确认密码：<input  type="password" name="repassword" size="30"><em>重复一次密码</em></li>							
				</ul>
		</fieldset>
		<p><input type="checkbox" name="che_1" onchange="ShowExpert(this);"><em>高级选项（可选）</em></p>
		<fieldset class="expert" style="display:none" title="可选项">
			<legend>高级选项（可选）</legend>
				<ul>
					<li>安全口令：
						<select name="userquestion" >  
							<option value="">选择一个安全问题，提高登录安全性</option> 
								<?php if(is_array($security_list)): $i = 0; $__LIST__ = $security_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["question"]); ?>"><?php echo ($vo["question"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>  
						<em>用于设置安全登录</em>
					</li>
					<li>口令答案：<input  type="text" size="30" name="useranswer"><em>安全口令答案</em></li>
					<li>个人微博：<input  type="text" name="userweibo" value="http://" size="30"></li>
			        <li>个人年龄：<input  type="text" name="userage" size="10"></li>
			        <li>联系电话：<input  type="text" name="usertel" size="10"></li>
					<li>联系QQ：<input  type="text" name="userqq" size="10"></li>
					<li>从事职业：<input  type="text" name="professional" size="10"></li>
					<li>个人介绍
						<p><textarea name="introduce" class="introduce" rows="7" ></textarea></p>
					</li>
         		</ul>
        </fieldset>
		<div class="sub">
		    <input type="button" onclick="ShowClause();" value="阅读条款" style="width:70px; height:30px;">
		    <fieldset  class="clause" style="display:none">
				    <?php if(is_array($clause_list)): $i = 0; $__LIST__ = $clause_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?><p><?php echo ($vos["clause"]); ?></p><?php endforeach; endif; else: echo "" ;endif; ?>
			    <input  type="submit" value="我同意以上条款并注册" style="width:170px; height:30px;">
		    </fieldset>
			
		</div>
    </div>
</form>

<!-- 注册 end -->


</body>
</html>