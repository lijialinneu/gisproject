<?php
if($_GET['center'] && $_GET['radius']){
	$center = $_GET['center'];
	$radius = $_GET['radius'];
	//圆形域查询
	header("Content-Type:text/html;charset=utf-8");
	
	$mysqli = new mysqli("localhost","root","admin","geodatabase");   //连接MySQL数据库  
    if (mysqli_connect_errno()) {                           
		 //检查连接错误  
         echo "连接失败:".mysqli_connect_error(); 
         exit(); 
    }
    $query  = "SET NAMES 'utf8';"; 
    $query .= "SET @center = GeomFromText('$center');";     
    $query .= "SET @radius = $radius;";                     
    $query .= "SET @bbox = CONCAT('POLYGON((',
	X(@center) - @radius, ' ', Y(@center) - @radius, ',',
	X(@center) + @radius, ' ', Y(@center) - @radius, ',',
	X(@center) + @radius, ' ', Y(@center) + @radius, ',',
	X(@center) - @radius, ' ', Y(@center) + @radius, ',',
	X(@center) - @radius, ' ', Y(@center) - @radius, '))'
	);"; 
    $query .= "SELECT `timestamp`,AsText(point),`name`,introduce
	FROM tb_point
	WHERE Intersects(point, GeomFromText(@bbox) )
	AND SQRT(POW( ABS( X(point) - X(@center)), 2) + POW( ABS(Y(point) - Y(@center)), 2 )) < @radius ORDER BY AsText(point),timestamp DESC";
    
    $result = $mysqli->multi_query($query);
    
	if($result == false){
	    echo($mysqli->errno);
	    echo($mysqli->error);
	}
    
	$k = -1;$j = -1;
	$point_array =  array();
	do{
	    if($result = $mysqli->store_result()) {  
	    	$count =  mysqli_num_rows($result);
	    	
		    for($i=0;$i<$count;$i++){
		    	$point_list = $result->fetch_array();
		    	
		    	$point_list['introduce'] = json_decode($point_list['introduce'],true);
				$point_list['text'] = $point_list['introduce']['text'];
				$point_list['picture'] = $point_list['introduce']['picture'];
		    	
		    	if($point_list['AsText(point)'] != $point_array[$k][$j]["point"]){
		    		$k++;$j = -1;
		    	}
		    	$j++;
		    	$point_array[$k][$j] = array(
		    		"point" => 	$point_list['AsText(point)'],
					"timestamp" => $point_list['timestamp'],
					"name" => $point_list['name'],
					"text" => $point_list['text'],
					"picture" => $point_list['picture'],	
		    	);	
			}
        	$result->close();
		} 
    }while($mysqli->next_result());
    echo json_encode($point_array);
   	$mysqli->close();//关闭连接    
}                       
?>