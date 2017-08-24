<?php
//定义几个常量
define(R,6371004);
define(P,0.01745329);//3.1415926/180
define(MAX_NUM,1000000);


$points = $_GET['points'];
$points =  (explode(" ",$points));



//print_r(getDistance($points));
  primPath($points);


//求距离的函数，目前以POI的直线距离作为权值
function getDistance($points){
	$length = count($points);
	$distance = array(
		//array(),
	);
	for($i = 0;$i<$length-1;$i++){
		$f1 = strpos($points[$i],'(',0) + 1;
		$f2 = strpos($points[$i],' ',0);
		$f3 = strpos($points[$i],')',$f2);
		$distance[$i][$i] = MAX_NUM;
		for($j=$i+1;$j<$length;$j++){ 
			$lnga = (float)substr($points[$i],$f1,$f2-$f1)*P;
			$lngb = (float)substr($points[$j],$f1,$f2-$f1)*P;
			$lata = (float)substr($points[$i],$f2+1,$f3-$f2-1)*P;
			$latb = (float)substr($points[$j],$f2+1,$f3-$f2-1)*P;
			$C = cos($lata)*cos($latb)*cos($lnga-$lngb);
			$D = R*acos($C+sin($lata)*sin($latb));
			$distance[$i][$j] = $distance[$j][$i] = round($D,2); 
		}
		
	}
	$distance[$length-1][$length-1] = MAX_NUM;
	return $distance;
}
//PRIM和KRUSKAL算法，用python翻译过来
function primPath($points){
	$distance = getDistance($points);
	print_r($distance);
	$length = count($distance);

	$U = array(1);
	$V = array();
	if($length>1){
		for($i = 2;$i<$length+1;$i++){
			$V[] = $i;
		}
	}else{
		$V[] = 2;
	}
	$last_node = $U[count($U)-1];
	$min = $distance[$last_node-1][$last_node-1];



//	while(count($U)!=$length){
//		$last_node = $U[count($U)-1];
//		$min = $distance[$last_node-1][$last_node-1];
//		$index = 0;
//		for($i = 0;$i<count($V);$i++){
//			if($min>$distance[$last_node-1][$V[$i]-1]){
//				$min = $distance[$last_node-1][$V[$i]-1];
//				$index = $V[$i];
//				
//			}
//		}
//		echo $index;
//		$U[] = $index;
//
//		
//		//array_splice($V,array_keys($V,$index,true),1);
//	}
	return json_encode($U);
}
//function kruskalPath(){
//	
//}
?>
