<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
	<div class="main">
		<p><?php echo ($mail["greetings"]); ?></p>
		<p>欢迎您加入"行走沈阳"，我们需要对您注册的Email进行激活，请点击以下链接进行验证</p>
		<a href="http://127.0.0.1/test/index.php/Register/chkverify?verify=<?php echo ($mail["verification"]); ?>" target="_blank">http://127.0.0.1/test/home/Lib/Action/Register/chkverify?verify=<?php echo ($mail["verification"]); ?></a>
		<div class="url">
			本邮件由【<a href="http://127.0.0.1/test">行走沈阳</a>】系统自动发送，请不要直接回复。如果以上链接无法点击,请将上面的地址复制到你的浏览器(如IE)的地址栏完成激活
		</div>
	</div>
</body>
</html>