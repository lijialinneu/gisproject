<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" src="__PUBLIC__/Js/home/jquery.js"></script>	
<script type="text/javascript" src="__PUBLIC__/Js/home/jquery.form.js"></script>
 <link rel="stylesheet" type="text/css" href="css/addpoi.css" />
 <script type="text/javascript" charset="utf-8" src="http://127.0.0.1/gisproject/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="http://127.0.0.1/gisproject/ueditor/ueditor.all.min.js"> </script>
<script type="text/javascript" charset="utf-8" src="http://127.0.0.1/gisproject/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" type="text/css" href="css/edit.css" />
<title>添加表单</title>
</head>
<body>
<div id="content">
<form action="#" method="post">
<table>
	<thead>
		<tr>
			<td><h2>增加<?php echo $_GET['name']?>其他年代信息</h2></td>
		</tr>
	</thead>

	<!-- 表内容部分 -->
	<tbody>
		<tr>
			<td><h3>名称</h3></td>
			<td><input type="text" name="name" value="<?php echo $_GET['name'];?>" readonly/></td>
		</tr>
		<tr>
			<td><h3>年代</h3></td>
			<td><input type="date" name="timestamp" /></td>
		</tr>
		<tr>
			<td><h3>经纬度</h3></td>
			<td>
				<input type="text" name="point" id="point"  style="width:200px;" value="<?php echo $_GET['point'];?>"/>
			</td>
		</tr>
		<tr>
			<td><h3>类型</h3></td>
			<td><select name="type">
              			<option value="古遗址">古遗址</option>
              			<option value="古墓葬">古墓葬</option>
              			<option value="古建筑">古建筑</option>
              			<option value="石窟寺及石刻">石窟寺及石刻</option>
              			<option value="近代重要史记及代表性建筑">近代重要史记及代表性建筑</option>
              			<option value="城市现代地标及代表性建筑">城市现代地标及代表性建筑</option>
              			<option value="其他">其他</option>
              		</select></td>
		</tr>
		<tr>
			<td><h3>简介</h3></td>
			<td>
				<input type="text" name="brief_introduce"  />
			</td>
		</tr>
		<tr>
			<td><h3>边界</h3></td>
			<td>
				<textarea name="border" placeholder="如：POINT(123.4 41.8),POINT(123.6 41.0),POINT(123.7 41),POINT(123.8 41.8)" /></textarea>
			</td>
		</tr>
		<!--tr>
			<td><h3>介绍</h3></td>
			<td>文字介绍:<br />
				<textarea name="text"></textarea><br />
				图片目录:<input type="text" name="picture" /> 
				视频目录:<input type="text" name="video" />
			</td>
		</tr>
		<tr>
			<td></td>
		</tr-->
	</tbody>
</table>
		<h3>详细介绍、图片、视频</h3>
		<script id="editor"name="text"  type="text/plain" style="width:600px;height:300px;"> </script>
		<script type="text/javascript">
		    var ue = UE.getEditor('editor');
	   </script>
	   <input type="submit" name="submit" value="确认添加" />
</form>
</div>
</body>
</html>
<?php
include 'common.php';
if($_POST["submit"]){
	$timestamp = $_POST["timestamp"];
	$point = $_POST["point"];
	$space = $_POST['border'];
	$type = $_POST["type"];
	$name = $_POST["name"];
	$brief_introduce = $_POST['brief_introduce'];
	$introduce = $_POST['text'];

	if($point == null){
		echo "<script>alert('经纬度不能为空');history.go(-1);</script>";
	}else{
		
		/*
		$introduce = array(
			'text' => urlencode($_POST['text']),
			'picture' => urlencode($_POST['picture']),
			'video' => urlencode($_POST['video']),
		);*/
	
		/*$data_introduce = urldecode(json_encode($introduce));*/
		
		
		
		$insertsql = "INSERT INTO tb_point (timestamp,point,space,type,name,brief_introduce,introduce,status) " .
			"VALUES ('$timestamp',PointFromText('$point'),'$space','$type','$name','$brief_introduce','$introduce','1')";
		
		if(mysql_query($insertsql)){
			echo "<script>alert('添加成功')</script>";
		}else{
			echo "<script>alert('添加失败')</script>";
		}
	}
}
?>