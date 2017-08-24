<?php
if($point = $_GET['point']){
	$date = $_GET['date'];
	//近邻查询
	header("Content-Type:text/html;charset=utf-8");
	$mysqli = new mysqli("localhost","root","admin","geodatabase");   //连接MySQL数据库  
    if (mysqli_connect_errno()) {                           
		 //检查连接错误  
         echo "连接失败:".mysqli_connect_error(); 
         exit(); 
    }
	
    $query  = "SET NAMES 'utf8';"; 
    $query .= "SET @center = GeomFromText('$point');";     
    $query .= "SET @radius = 0.015;";                     
    $query .= "SET @bbox = CONCAT('POLYGON((',
	X(@center) - @radius, ' ', Y(@center) - @radius, ',',
	X(@center) + @radius, ' ', Y(@center) - @radius, ',',
	X(@center) + @radius, ' ', Y(@center) + @radius, ',',
	X(@center) - @radius, ' ', Y(@center) + @radius, ',',
	X(@center) - @radius, ' ', Y(@center) - @radius, '))'
	);"; 
    $query .= "SELECT AsText(point),`name`,`picture`,`brief_introduce`
	FROM tb_point
	WHERE ABS(YEAR(`timestamp`) - $date) < 5 AND  Intersects(point, GeomFromText(@bbox) )
	AND SQRT(POW( ABS( X(point) - X(@center)), 2) + POW( ABS(Y(point) - Y(@center)), 2 )) < @radius GROUP BY AsText(point)";
    
    $result = $mysqli->multi_query($query);
    
	if($result == false){
	    echo($mysqli->errno);
	    echo($mysqli->error);
	}
	$point_array =  array();
	do{
	    if ($result = $mysqli->store_result()) {  
	    	$count =  mysqli_num_rows($result);
		    for($i=0;$i<$count;$i++){
		    		$point_array[$i] = $result->fetch_row();	
			}
        	$result->close();
		} 
    }while($mysqli->next_result());
    //file_put_contents("test.txt",json_encode($point_array));
    echo json_encode($point_array);

   	$mysqli->close();//关闭连接                          
}
?>