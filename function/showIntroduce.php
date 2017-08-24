<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/showIntroduce.css" media="screen" />
<title><?php echo $_GET['point'];?></title>
</head>
<?php
//显示全文
include 'common.php';
$timestamp = $_GET["timestamp"];
$point = $_GET["point"];

if($timestamp!=null && $point !=null){
	$sql = "SELECT `introduce` FROM tb_point WHERE YEAR(`timestamp`) = $timestamp AND AsText(point) = '$point' ";
	if($result = mysql_query($sql)){
		$array = mysql_fetch_array($result);
		if($array==null){
?>
			没有详细的描述<a href="edit.html">我来编辑</a>		
<?php
		}else{
?>
	<div id="introduce"><?php echo $array[0];?></div>
<?php
		}
	}
}
?>
