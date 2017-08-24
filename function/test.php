<?php 
// --------------------------------------------------------------------------
// File name   : test_coreseek.php
// Description : coreseek中文全文检索系统测试程序
// Requirement : PHP5 (http://www.php.net)
//
// Copyright(C), HonestQiao, 2011, All Rights Reserved.
//
// Author: HonestQiao (honestqiao@gmail.com)
//
// 最新使用文档，请查看：http://www.coreseek.cn/products/products-install/
//
// --------------------------------------------------------------------------
require ( "sphinxapi.php" );
header("Content-Type:text/html; charset=utf-8");
$cl = new SphinxClient ();
$cl->SetServer ( '127.0.0.1', 9312);
$cl->SetConnectTimeout ( 3 );
$cl->SetArrayResult ( true );
$cl->SetMatchMode ( SPH_MATCH_ANY);
$keyword = '西塔大冷面';
$res = $cl->Query ( $keyword, "*" );
//print_r($cl);

print_r($res);

//print_r($res['words']);

echo "<p></p>";
for($i=0;$i<$res['total'];$i++){
	//echo $res['matches'][$i]['id']."<br/>"; 
	include "common.php";
	$id = $res['matches'][$i]['id'];
	$sql = "SELECT `timestamp`,AsText(point),`name`,`introduce` FROM tb_point WHERE `id` = '$id'";
	//$count = 0;	
	//$point_array = array();
	if($result = mysql_query($sql)){
		$array = mysql_fetch_row($result);
			//$point_array[$count] = $array;
			//$count++;
			//$cc = "一二三四五六七";
			//$content = str_replace('二', '<font color=red>'.'二二'.'</font>',$cc);
			//echo $content;
			echo $array[2]."<br/>";
		
		//echo json_encode($point_array);
	}else{
		echo "系统正在维护中";		
	}
}


?>