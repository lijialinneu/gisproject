<?php
/*
 * 根据时间轴的时间查询
 */
if($date = $_GET['date']){
	include 'common.php';
	//查询tb_point
	$sql = "SELECT AsText(point),`name`,`picture`,`brief_introduce`,`space` FROM tb_point WHERE ABS(YEAR(`timestamp`) - $date) < 5  GROUP BY AsText(point) ORDER BY score DESC LIMIT 100";
	$count = 0;	
	$point_array = array();
	if($result = mysql_query($sql)){
		while($array = mysql_fetch_row($result)){
			$point_array[$count] = $array;
			$count++;
		}
			//file_put_contents("test.txt",json_encode($point_array));
		echo json_encode($point_array);
	}else{
		echo json_encode("查询错误，请联系管理员");		
	}
	
}
?>