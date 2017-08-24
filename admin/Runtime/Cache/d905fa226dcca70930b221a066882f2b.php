<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ($title); ?></title>
</head>
<body>
<form action="__URL__/altergis" method="post">
<table>
	<thead>
		<tr>
			<th>修改GIS</th>
		</tr>
	</thead>

	<!-- 表内容部分 -->
	
	<tbody>
	
	<?php if(is_array($point_list)): $i = 0; $__LIST__ = $point_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
			<td>点所处年代</td>
			<td><input type="text" name="timestamp" value="<?php echo ($vo['YEAR(timestamp)']); ?>"/></td>
			<td><input type="hidden" name="default_timestamp" value="<?php echo ($vo['YEAR(timestamp)']); ?>"></td>
		</tr>
		<tr>
			<td>经纬度</td>
			<td>
				<input type="text" name="point" id="point"  style="width:200px" value="<?php echo ($vo['AsText(point)']); ?>"/>
			</td>
			<td><input type="hidden" name="default_point" value="<?php echo ($vo['AsText(point)']); ?>"></td>
		</tr>
		<tr>
			<td>类型</td>
			<td>
				<select name="type" id="type">
					<option value="古遗址">古遗址</option>
					<option value="古墓葬">古墓葬</option>
					<option value="古建筑">古建筑</option>
					<option value="石窟寺及石刻">石窟寺及石刻</option>
					<option value="近代重要史记及代表性建筑">近代重要史记及代表性建筑</option>
					<option value="城市现代地标及代表性建筑">城市现代地标及代表性建筑</option>
					<option value="其他">其他</option>
				</select>
				注：修改的时候需要重新选择，还未做成动态设置option selected
            </td>
		</tr>
		<tr>
			<td>名称</td>
			<td><input type="text" name="name" value="<?php echo ($vo['name']); ?>"/></td>
		</tr>
		<tr>
			<td>介绍</td>
			<td>
				文字介绍:<textarea name="text"><?php echo ($vo['introduce']['text']); ?></textarea><br />
				图片目录:<input type="text" name="picture" style="width:200px;" value="<?php echo ($vo['introduce']['picture']); ?>"/> <br/>
				视频目录:<input type="text" name="video" style="width:200px;" value="<?php echo ($vo['introduce']['video']); ?>"><br/>
				维基百科uri:<input type="text" name="wiki" style="width:200px;" value="<?php echo ($vo['uri']); ?>">
			</td>
		</tr>
		<tr>
			<td><input type="submit" name="submit" value="提交" /></td>
		</tr><?php endforeach; endif; else: echo "" ;endif; ?>   

	</tbody>
</table>
</form>
</body>
</html>