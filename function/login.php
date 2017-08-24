<?php
	session_start();
	$username = $_SESSION['username'];
	if($username){
		echo "<span class='username' hidden>$username</span>";
		echo "<div style='float:right;'>欢迎". $username."！</div>"; 
	}else{
		echo "<div style='float:right;'><a href='http://127.0.0.1/gisproject/index.php/Login/index' target=_BLANK>请先登录</a></div>";
	}
?>
