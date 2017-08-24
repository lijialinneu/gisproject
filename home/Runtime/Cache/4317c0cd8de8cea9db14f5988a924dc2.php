<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<div class="main">
		<p><?php echo ($mail["greetings"]); ?></p>
		<p>您正在进行找回密码操作，请点击以下链接找回密码</p>
		<a href="http://127.0.0.1/test/index.php/Getpwd/chkverify?verify=<?php echo ($mail["verification"]); ?>&email=<?php echo ($mail["email"]); ?>" target="_blank">http://127.0.0.1/test/index.php/link=<?php echo ($mail["linkstr"]); ?></a>
		<div class="url">
			本邮件由【<a href="http://127.0.0.1/test">行走沈阳</a>】系统自动发送，请不要直接回复。如果以上链接无法点击,请将上面的地址复制到你的浏览器(如IE)的地址栏完成激活
		</div>
	</div>
</body>
</html>