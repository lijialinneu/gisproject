<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>删除确认</title>
<link rel="stylesheet" href="__PUBLIC__/Css/admin/check.css" type="text/css" media="screen" />
<script type="text/javascript" src="__PUBLIC__/Js/admin/check.js"></script>
</head>
<body>
<center>
<div id="check">
	<form method="post" action="_URL_/delete">
		<p><h1>确定要删除该用户？</h1></p><br/>
			<input type="submit" name="yes" value="确定">
		    <input type="button" name="no" value="取消" onclick="window.history.back(-1);">
	</form>
</div>
</center>
</body>
</html>