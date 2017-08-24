<?php
if($keyword = $_GET['keyword']){
	header("Content-Type:text/html; charset=utf-8");
	/*
	 * 利用coreseek来帮助实现全文检索
	 */
	require("sphinxapi.php");
	$date = $_GET['date'];
	$cl = new SphinxClient();
	$cl->SetServer ('127.0.0.1',9312);
	$cl->SetConnectTimeout(3);
	$cl->SetArrayResult(true);
	$cl->SetMatchMode(SPH_MATCH_ANY);
	
	$res = $cl->Query($keyword,"*");
	
	$length = $res['words'].length;
	$word_list = array();
	$count = 0;
	foreach ($res['words'] as $key => $value) { 
		if($value['docs']>0){
			$word_list[$count] = $key;
			$count++;
		}
	}
	
	$point_array = array();
	$count = 0;
	for($i=0;$i<$res['total'];$i++){
		include "common.php";
		$id = $res['matches'][$i]['id'];
		$sql = "SELECT AsText(point),`name`,`picture`,`brief_introduce`,YEAR(`timestamp`) FROM tb_point WHERE ABS(YEAR(`timestamp`) - $date) < 5 AND `id` = '$id'";
		if($result = mysql_query($sql)){
			while($array = mysql_fetch_row($result)){
				$point_array[$count] = $array;
				$count++;
			}
		}else{
			echo json_encode("查询错误");
		}
	}
	$point_array[count($point_array)] = $word_list;
  	//file_put_contents("test.txt",json_encode($point_array));
	echo json_encode($point_array);
}
?>