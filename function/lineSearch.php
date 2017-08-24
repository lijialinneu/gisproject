<?php
/*
 * 根据线查询
 */
if($path = $_GET['points']){
	include 'common.php';
	include 'rectangleSearch.php';
	header("Content-Type:text/html;charset=utf-8");
	$bbox = $_GET['bbox'];
	$date = $_GET['date'];
	$pinRecList = rectangleSearch($bbox,$date);
	
//		if($date = $_GET['date']){
//			echo $date;	
//		}else{
//			echo "没有获取到数据";
//		}
//	
	
	//file_put_contents("test.txt",json_encode($pinRecList));

//求点与直线的距离，在范围内的，认为在直线附近


	
	$point_array =  array();
	$length = count($path);
	$count = 0;
	//$d = array();
	for($i=0;$i<count($pinRecList);$i++){
			$plng = getLng($pinRecList[$i][0]);
			$plat = getLat($pinRecList[$i][0]);
			for($j=0;$j<$length-1;$j++){
				//由字符串求经纬度
				$p1lng = getLng($path[$j]);//p1经纬度
				$p1lat = getLat($path[$j]);
				
				$p2lng = getLng($path[$j+1]);//p2经纬度
				$p2lat = getLat($path[$j+1]);
				
				$c = $p2lat * $p1lng - $p1lat * $p2lng;
				$d = ($p2lng - $p1lng) * $plat + ($p1lat - $p2lat) * $plng + $c;
				if($d<0.003 && $d>-0.003){
					$point_array[$count] = $pinRecList[$i];
					$count++;
					break;
				}
			}  
	}
	echo json_encode($point_array);


//            
//	                c = p2.lat * p1.lng - p1.lat * p2.lng
//                d = (p2.lng - p1.lng) * p.lat + (p1.lat - p2.lat) * p.lng + c

   	
  
	
	//查询tb_point
	/*$sql = "SELECT AsText(point),`name`,`picture`,`brief_introduce`,`space` FROM tb_point WHERE ABS(YEAR(`timestamp`) - $date) < 5  GROUP BY AsText(point) ORDER BY score DESC LIMIT 100";
	$count = 0;	
	$point_array = array();
	if($result = mysql_query($sql)){
		while($array = mysql_fetch_row($result)){
			$point_array[$count] = $array;
			$count++;
		}
			//file_put_contents("test.txt",0son_encode($point_array));
		echo 0son_encode($point_array);
	}else{
		echo 0son_encode("查询错误，请联系管理员");		
	}*/
	
}
?>