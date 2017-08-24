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
	<script type="text/javascript" src="__PUBLIC__/Js/admin/jquery-1.3.2.min.js"></script>
	
	<script src="__PUBLIC__/Js/home/imageflow.js" type="text/javascript"></script>
	<script src="__PUBLIC__/Js/home/jquery-1.10.2.min.js" type="text/javascript"></script>
	<link rel="stylesheet" href="__PUBLIC__/Css/home/index3.css">
	<title>map3</title>
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
				width : 600,     // 信息窗口宽度
				height: 730,     // 信息窗口高度
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
						"<div id='main'onmouseover='test()'>"+
						"<div class='demo'>"+
							"<div id='imageflow'>"+
								"<div id='loading'><img src='__PUBLIC__/Images/home/1.jpg' alt='加载中' /></div>"+
								"<div id='captions'></div>"+
								"<div id='images'>"+
									"<img src='__PUBLIC__/Images/home/map1.jpg' alt='多彩图标按钮动画下拉菜单'/>"+
									"<img src='__PUBLIC__/Images/home/map2.jpg' alt='多彩图标按钮动画下拉菜单'/>"+
									"<img src='__PUBLIC__/Images/home/map3.jpg' alt='多彩图标按钮动画下拉菜单'/>"+
									
								
								"</div>"+
								"<div id='scrollbar'>"+
									"<div id='slider'></div>"+
								"</div>"+
							"</div></div></div>";
					
	
								
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