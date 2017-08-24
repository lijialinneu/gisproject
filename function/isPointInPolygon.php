<?php

//采用射线法，计算测试点是否任意一个建筑内
function  isPointInPolygon($p,$points){
	$Bound = $Vertex = true; //定义在边界上或者在顶点都建筑内
	$count = 0;
	$precision = 2e-10;
	$length = count($points);
	$plng = getLng($p);
	$plat = getLat($p);
	$p1 = $points[0];
	$p1lng = getLng($p1);
	$p1lat = getLat($p1);

	for($i = 1;$i<$length;$i++){
		$p2 = $points[$i % $length];
		$p2lng = getLng($p2);
		$p2lat = getLat($p2);
		if (($p==$p1)||($p==$p2)){  
			file_put_contents("test6.txt","6");
			return $Vertex;		
		}
		if(($plng<min($p1lng,$p2lng))||($plng>max($p1lng,$p2lng))||
			($plat>max($p1lat,$p2lat))){
			$p1 = $p2;
			$p1lng = getLng($p1);
			$p1lat = getLat($p1);   file_put_contents("test7.txt","7");
			continue;
		}else if(($plng>min($p1lng,$p2lng))&&($plng<max($p1lng,$p2lng))
				&&($plat<max($p1lat,$p2lat))){
			if($p1lat == $p2lat){
				if(($plat==$p1lat)){   file_put_contents("test8.txt","8");
					return $Bound;
				}else{
					$count++;		file_put_contents("test1.txt","1");
					continue;
				}
			}
			$c = $p2lat * $p1lng - $p1lat * $p2lng;
			$d = ($p2lng - $p1lng) * $plat + ($p1lat - $p2lat) * $plng + $c;
			if($p1lng<$p2lng){
				if($d<0){
					$count++;	file_put_contents("test2.txt","2");
				}else if($d>0){
					$p1 = $p2;
					$p1lng = getLng($p1);
					$p1lat = getLat($p1);  file_put_contents("test9.txt","9");
					continue;
				}else if(abs($plng-$d)<$precision){  file_put_contents("test10.txt","10");
					return $Bound;
				}
			}else if($p1lng>$p2lng){
				if($d<0){
					$p1 = $p2;
					$p1lng = getLng($p1);
					$p1lat = getLat($p1);  file_put_contents("test11.txt","11");
					continue;
				}else if($d>0){
					$count++;  file_put_contents("test3.txt","3");
				}else if(abs($plng-$d)<$precision){  file_put_contents("test12.txt","12");
					return $Bound;
				}
			}
			
		}else{
			if($p1lng==$p2lng){
				if(($plng==$p1lng)&&($plat>min($p1lat,$p2lat))&&
					$plat<max($p1lat,$p2lat) ){  file_put_contents("test13.txt","13");
					return $Bound;	
				}
			}else{
				$p3 = $points[($i+1) % $length];
				$p3lng = getLng($p3);
				$p3lat = getLat($p3);
				if(($plng<min($p1lng,$p3lng))||
					($plng>max($p1lng,$p3lng))){
					$count += 2;  file_put_contents("test4.txt","4");
				}else{
					$count++; file_put_contents("test5.txt","5");
				}
			}
		}
		$p1 = $p2;
		$p1lng = getLng($p1);
		$p1lat = getLat($p1);
	}
	//return $count;
	
	if($count%2==0){
		return false;
	}else{
		return true;
	}
}
     
?>
