<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
		#showmap{width:100%;height:500px;}
		p{margin-left:5px; font-size:14px;}
	</style>
	<script src="http://api.map.baidu.com/api?v=2.0&ak=beA5xPn5Q2mtr5ojgsIOm2rr" type="text/javascript" ></script>
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script src="__PUBLIC__/Js/home/focus.js" type="text/javascript"></script>
	<title>map</title>
</head>
<body onload="showmap()">
	<div id="time">
                <h2>访问不同年代的沈阳。</h2>
				 <input type="range" name="range" id="range" min="1" max="8" step="1"  value="8" onchange="showmap()"/><br/>
                        您选择的是<output name="displayTime" id="displayTime">2014</output>年的沈阳地图。           	  
	</div>        
	<div id="showmap"></div>
	<script type="text/javascript">
	function showmap(){
		// 百度地图API功能	
		map = new BMap.Map("showmap");
		map.centerAndZoom(new BMap.Point(123.4432300000,41.8239810000), 13);
		map.enableScrollWheelZoom();
	
		var point_array = <?php echo ($point_array); ?>;
		var count = <?php echo ($count); ?>;
	
		var opts = {
				width : 350,     // 信息窗口宽度
				height: 300,     // 信息窗口高度
				title : "时空数据窗口" , // 信息窗口标题
				enableMessage:true//设置允许信息窗发送短息
			   };

		//显示时间轴的年份 
		var time = document.getElementById("range");
		var displayTime = document.getElementById("displayTime");
		var newtime;
		switch(time.value){
			case "1": newtime = 1900; break;
			case "2": newtime = 1927; break;
			case "3": newtime = 1936; break;
			case "4": newtime = 1946; break;
			case "5": newtime = 1980; break;
			case "6": newtime = 2000; break;
			case "7": newtime = 2012; break;
			case "8": newtime = 2014; break;
		
			default: alert("wrong!");
		}
		displayTime.innerHTML = "<font color='#FF0000'>"+newtime+"</font>";
		
		
		for(var i=0;i<count;i++){
			
			//获得经纬度 
			var index1 = point_array[i][0]['point'].indexOf("(");
			var index2 = point_array[i][0]['point'].indexOf(" ");
			var index3 = point_array[i][0]['point'].indexOf(")");
	
			var longitude = point_array[i][0]['point'].substring(index1+1,index2);
			var latitude = point_array[i][0]['point'].substring(index2+1,index3);

			var content = "<table>";
			for(var key in point_array[i]){
				
				//判断timestamp与时间轴显示的年份是否相等 ,如果相等，添加标注点，添加Label
				if(newtime == point_array[i][key]['timestamp'].substring(0,4)){
					
					//添加地图标注点 
					var marker = new BMap.Marker(new BMap.Point(longitude,latitude));  // 创建标注
					map.addOverlay(marker); 
			
					//添加Label
					var label = new BMap.Label(point_array[i][0]['name'],{offset:new BMap.Size(20,-10)});
					marker.setLabel(label);
					
					var content =  
								"<table>"+
									"<tr>"+
										"<td>"+
											"<h4 style='margin:0 0 5px 0;padding:0.2em 0'>"+point_array[i][key]['timestamp']+"年</h4>"+
											"<p style='margin:0;line-height:1.5;font-size:13px;text-indent:2em'>"+point_array[i][key]['text']+"</p>"+
										"</td>"+
										"<td><img style='float:right;margin:4px' id='imgDemo' src="+point_array[i][key]['picture']+" width='139' height='104' title="+point_array[i][key]['name']+"/></td>"
									"</tr>"+
								"</table>";
					//添加方法
					addClickHandler(content,marker); 
					
				}else{
					continue;	
				}
					        
	        }
		
			
		}
		
		function addClickHandler(content,marker){
			marker.addEventListener("mouseover",function(e){
				openInfo(content,e)}
			);
		}
		function openInfo(content,e){
			var p = e.target;
			var point = new BMap.Point(p.getPosition().lng, p.getPosition().lat);
			var infoWindow = new BMap.InfoWindow(content,opts);  // 创建信息窗口对象 
			map.openInfoWindow(infoWindow,point); //开启信息窗口
		}
	}
</script>
	
</body>
</html>