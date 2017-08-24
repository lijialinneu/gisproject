<?php 
// 查询向用户推荐的POI
include 'common.php';
//如果用户已经登录，采用协同过滤推荐
$recommand_list = array();
if($username = $_GET['username']){
	$sql = mysql_query("SELECT `recommand` FROM tb_user WHERE `username` = '$username'");
	$recommand = mysql_fetch_array($sql);
	if($recommand[0]!=""){
		echo $recommand[0]." ";
	}else{
		
		selectPointByScore();
	}
}else{
	selectPointByScore();
}

function selectPointByScore(){
	$sql = mysql_query("SELECT `name` FROM tb_point GROUP BY `point` ORDER BY `score` DESC LIMIT 5");
	echo mysql_error();
	while($recommand = mysql_fetch_array($sql)){
		echo $recommand[0]." ";
	}
}
?>