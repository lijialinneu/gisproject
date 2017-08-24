<?php
/*
 * 根据不规则多边形查询
 */
if($path = $_GET['points']){
	include 'common.php';
	include 'rectangleSearch.php';
	include 'isPointInPolygon.php';
	header("Content-Type:text/html;charset=utf-8");
	$bbox = $_GET['bbox'];
		//file_put_contents("test.txt",json_encode($bbox));
	$date = $_GET['date'];
	$pinRecList = rectangleSearch($bbox,$date);
	
	//file_put_contents("test.txt",json_encode($pinRecList));
	
	
	//射线法判断点与多边形的位置关西
	$point_array =  array();
	$length = count($path);
	$count = 0;
	$result = array();
	for($i=0;$i<count($pinRecList);$i++){
		//$result[$i] = isPointInPolygon($pinRecList[$i][0],$path);

		if(isPointInPolygon($pinRecList[$i][0],$path)){	
				$point_array[$count] = $pinRecList[$i];
				$count++;
		}
	}
	echo json_encode($point_array);
file_put_contents("test.txt",json_encode($result));
}
?>