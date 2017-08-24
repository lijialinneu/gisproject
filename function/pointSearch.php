<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $_GET['point'];?></title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/pointsearch.css" media="screen" />
<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/jquery.timelinr-0.9.3.js" ></script>
<!--script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=beA5xPn5Q2mtr5ojgsIOm2rr"></script-->
<script type="text/javascript"> 
$(function(){
	$().timelinr();
});
</script>
</head>
<body>
<?php 
    include 'common.php';
	include 'login.php';
?>
		
<div id="timeline">
	<ul id="dates">
	<?php 
		$point = $_GET['point'];
		$sql = "SELECT YEAR(`timestamp`) FROM tb_point WHERE AsText(point) = '$point' ORDER BY YEAR(`timestamp`) ASC";
		if($result = mysql_query($sql)){
			while($array = mysql_fetch_array($result)){
	?>
			<li><a href="javascript:void(0);"><?php echo $array[0];?></a></li>
	<?php 
			}
		}else{
			echo "系统正在维护中";
		}
	?>
	</ul>
	<ul id="issues">
	 <?php
				$sql = "SELECT `timestamp`, `name`,`picture`,`introduce` FROM tb_point WHERE AsText(point) = '$point' ORDER BY `timestamp` ASC";
				if($result = mysql_query($sql)){					
					while($row = mysql_fetch_object($result)){
					$name = $row->name;
					$timestamp = substr($row->timestamp,0,4);
    ?>	
    <span class="name" hidden><?php echo $name;?></span>
			<li>
				<img src='<?php echo $row->picture;?>' width="256" height="256" />
				<h1><?php echo $timestamp;?></h1>
				<p>
					<?php echo $row->introduce;?><br/>
					<a href="showIntroduce.php?timestamp=<?php echo $timestamp;?>&point=<?php echo $point?>" target="_BLANK">显示全文</a>&nbsp;
					对此介绍不满意？&nbsp;<a href="edit.html" target="_BLANK">我来编辑</a>&nbsp;&nbsp;
					<a href="addthispoi.php?name=<?php echo $name;?>&point=<?php echo $point?>" target="_BLANK">新增<?php echo $name;?>的其他年代信息</a> 
				</p>
				
			</li>
	 <?php 
					}
			}
	?>
	</ul>
	<div id="grad_left"></div>
	<div id="grad_right"></div>
	<a href="javascript:void(0);" id="next">+</a>
	<a href="javascript:void(0);" id="prev">-</a>
</div>

<div id="operate">
	<table>
		<tr>
			<td>
				<?php
					$sqlpanor = "SELECT AsText(panorama) FROM tb_panorama WHERE `poiname` = '$name' ";
					if($resultpanor = mysql_query($sqlpanor)){
						$rowpanor = mysql_fetch_array($resultpanor);
						if($rowpanor == null){
							?>
								暂无全景图<a href="javascript:void(0);">我来添加全景图</a>	
							<?php
						}
				?>
					<span  class="panorama" hidden><?php echo $rowpanor[0];?></span>
					<div id="panorama"></div>
					<script type="text/javascript" src="js/mark.js"></script>
				<?php		
					}
				?>
			</td>
			<td>
			<input type="button" id="btn_album" value="进入图片目录" />
			<input type="button" id="btn_video" value="查看视频" />
			<input type="button" id="btn_wiki" value="进入维基百科" />
			<input type="button" id="btn_addpoi" value="新增<?php echo $name;?>的其他年代信息" />
			
			</td>
		</tr>
		<tr>
			<td>
				<ul id="oldmark">
				 <?php
							$sqlcom = "SELECT `userid`, `content` FROM tb_comment WHERE `poiname` = '$name' ORDER BY `addtime` DESC";
							if($resultcom = mysql_query($sqlcom)){
								$rowcom = mysql_fetch_object($resultcom);
								if($rowcom==null){
				?>
									<li>
										<p>暂无其他用户评论</p>
									</li>
				<?php
							  }else{
									do{
				?>
										<li>
												<p>用户id为<?php echo $rowcom->userid;?>的用户评论如下：&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $rowcom->content;?></p>
										</li>
				<?php
								 }while($rowcom = mysql_fetch_object($resultcom));
							  }
						}						
			    ?>	
				</ul>
			</td>
			<td>
			<?php
					$flag = 0;
					$sqlmark = "SELECT `comment`  FROM tb_user WHERE `username` = '$username' ";
					if($resultmark = mysql_query($sqlmark)){
						$rowmark = mysql_fetch_array($resultmark);
						$comment = json_decode($rowmark['comment'],true);
						$comment_array = $comment['comment'];
//echo $name." ".$comment_array[0]['name'];
//if($comment_array[0]['name']=='$name'){		
//print_r( $comment_array[0]['name']);
//}
						for($i=0;$i<count($comment_array);$i++){
							if($comment_array[$i]['name']==$name){
								$flag = 1;
						?>
								已评价：<br/>
								总体评价：<?php echo $comment_array[$i]['gscore'];?><br/>
								历史底蕴：<?php echo $comment_array[$i]['hscore'];?><br/>
								文物保护：<?php echo $comment_array[$i]['pscore'];?><br/>	
						<?php
								break;
							}
						} 
						?>

			<?php						
					}
					if(flag==0){
			?>
			<div id="mymark">
					<div class="starbox">
						<div class="starbox general">
							<span class="s_name">总体评价：</span>
							<ul class="square_ul fl">
								<li><a class="square-1" title="差" href="javascript:void(0);"></a></li>
								<li><a class="square-2" title="一般" href="javascript:void(0);"></a></li>
								<li><a class="square-3" title="好" href="javascript:void(0);"></a></li>
								<li><a class="square-4" title="很好" href="javascript:void(0);"></a></li>
								<li><a class="square-5" title="非常好" href="javascript:void(0);"></a></li>
							</ul>
							<span class="s_result_square fl" id="general">请评价</span>
						</div>
						
						<div class="starbox history">
							<span class="s_name">历史底蕴：</span>
							<ul class="square_ul fl">
								<li><a class="square-1" title="差" href="javascript:void(0);"></a></li>
								<li><a class="square-2" title="一般" href="javascript:void(0);"></a></li>
								<li><a class="square-3" title="好" href="javascript:void(0);"></a></li>
								<li><a class="square-4" title="很好" href="javascript:void(0);"></a></li>
								<li><a class="square-5" title="非常好" href="javascript:void(0);"></a></li>
							</ul>
							<span class="s_result_square fl" id= "history">请评价</span>
						</div>
						
						<div class="starbox protect">
							<span class="s_name">文物保护：</span>
							<ul class="square_ul fl">
								<li><a class="square-1" title="差" href="javascript:void(0);"></a></li>
								<li><a class="square-2" title="一般" href="javascript:void(0);"></a></li>
								<li><a class="square-3" title="好" href="javascript:void(0);"></a></li>
								<li><a class="square-4" title="很好" href="javascript:void(0);"></a></li>
								<li><a class="square-5" title="非常好" href="javascript:void(0);"></a></li>
							</ul>
							<span class="s_result_square fl" id="protect">请评价</span>
						</div>
						<textarea id="comment" placeholder="请输入您的评价"></textarea><br/>
						<input type="button"  id="btn_submit" class="btn_submit"  value="提交我的评价"/>
				</div>
			<?php		
					}
			?>
			
			</td>
		</tr>
	</table>
</div>		
</body>
</html>