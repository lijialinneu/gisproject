<?php
if($bbox = $_GET['bbox']){
	header("Content-Type:text/html;charset=utf-8");
	
	$mysqli = new mysqli("localhost","root","admin","geodatabase");   //连接MySQL数据库  
    if (mysqli_connect_errno()) {                           
		 //检查连接错误  
         echo "连接失败:".mysqli_connect_error(); 
         exit(); 
    }
    $query  = "SET NAMES 'utf8';";                     
    $query .= "SET @bbox = '$bbox';"; 
    $query .= "SELECT AsText(point),`name`
			   FROM tb_point
			   WHERE Intersects(point,GeomFromText(@bbox)) GROUP BY AsText(point);";
    $result = $mysqli->multi_query($query);
    
	if($result == false){
	    echo($mysqli->errno);
	    echo($mysqli->error);
	}
	$point_array = array();
	do{
	    if($result = $mysqli->store_result()) {  
	    	$count =  mysqli_num_rows($result);
		    for($i=0;$i<$count;$i++){
		    	$point_array[$i] = $result->fetch_row();	
			}
        	$result->close();
		} 
    }while($mysqli->next_result());
    echo json_encode($point_array);
   	$mysqli->close();//关闭连接    
}                       
?>