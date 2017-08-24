<?php 
/*
 * 记录用户评分
 */
include 'common.php';
session_start ();
$username = $_SESSION ['username'];
$name = $_GET['name'];
$gscore = $_GET['gscore'];//整体评分
$hscore = $_GET['hscore'];//文化
$pscore = $_GET['pscore'];//环境

//echo $username.$name.$gscore.$hscore.$pscore;

/*
 * 获取用户已经评分的POI的id及分数
 */
$sql = "SELECT `comment` FROM tb_user WHERE `username` = '$username'";
/*
 * 新构造的json数组
 */
$mark = array (
		'name' => urlencode($name),
		'gscore' => urlencode($gscore),
		'hscore' => urlencode($hscore),
		'pscore' => urlencode($pscore)
);

if ($result = mysql_query ( $sql )) {
	$array = mysql_fetch_row ( $result );
	$comment = $array [0]; // $comment是用户已经评分的POI的id，是一个字符串
	if ($comment == null) {
		$newcomment = '{' . "\"comment\":" . '[' .urldecode(json_encode ( $mark )). ']}';
	} else {
		$newcomment = substr ( $comment, 0, strlen ( $comment ) - 2 ) . ',' . urldecode(json_encode ( $mark )) . "]}";
	}
	/*
	 * 更新
	 */
	
	$updatesql = "UPDATE tb_user SET comment = '$newcomment' WHERE `username` = '$username'";
	if(mysql_query($updatesql)){
		echo "评论成功";
	}else{
		 echo mysql_error();
	}
	
}else{
	echo "系统正在维护";	
}



?>