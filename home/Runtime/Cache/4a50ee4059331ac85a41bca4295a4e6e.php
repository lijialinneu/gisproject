<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/home/map.css"/>
	
	<script src="http://api.map.baidu.com/api?v=2.0&ak=beA5xPn5Q2mtr5ojgsIOm2rr" type="text/javascript" ></script>
	<link rel="stylesheet" href="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.css" />
	<script type="text/javascript" src="http://api.map.baidu.com/library/DrawingManager/1.4/src/DrawingManager_min.js"></script>
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
	<script src="__PUBLIC__/Js/home/jquery-1.10.2.min.js" type="text/javascript"></script>
	<script src="__PUBLIC__/Js/home/focus.js" type="text/javascript"></script>
	<script src="__PUBLIC__/Js/home/jquery.js" type="text/javascript"></script>	
	<script src="__PUBLIC__/Js/home/jquery.form.js" type="text/javascript"></script>		

	<!--script src="__PUBLIC__/Js/home/Base.js" type="text/javascript"></script>
	<script src="__PUBLIC__/Js/home/prototype.js" type="text/javascript"></script>
	<script src="__PUBLIC__/Js/home/mootools.js" type="text/javascript"></script>
	<script src="__PUBLIC__/Js/home/ThinkAjax.js" type="text/javascript"></script-->
	
	<script type="text/javascript">
     function initializemap(){
			showmap(1);
     }
    </script>
	
    <title>map</title>
</head>
<body onload="initializemap()">
	<div id="map">
            <div id="showmap">
            </div>
            <input type="hidden" id="count" value='<?php echo ($count); ?>'>
            <div id="point_array" style="display:none;"><?php echo ($point_array); ?></div>
          	<!--output  id="display">123412312</output--> 
          	
            <script type="text/javascript" src="http://api.map.baidu.com/library/AreaRestriction/1.2/src/AreaRestriction_min.js"></script>
            <script type="text/javascript">
            	function showmap(flag){
                	//调用map.js文件 
            		var oHead = document.getElementsByTagName('head').item(0);
            		var oScript= document.createElement("script");
            		oScript.type = "text/javascript";
            		oScript.src="__PUBLIC__/Js/home/map.js?showflag="+flag;
            		oHead.appendChild(oScript);
                }
            </script>  
            <!--script type="text/javascript">
            function gis_keyword_search(){
            	ThinkAjax.sendForm('gis_search_form','__URL__/gis_keyword_search',complete,'gis_result');
            }

            function complete(data,status){
            	if (status==1){
            	// 提示信息
            	//$('list').innerHTML = "<span>"+data+"</span>";
            	}
            }
            </script-->
      
           
     </div>
     <div id="operate">
		 <div id="time">
	                        访问不同年代的沈阳。
	         <input type="range" name="range" id="range" min="1" max="8" step="1"  value="3" onchange="showmap(1)"/><br/>
	                        您选择的是
	         <output name="displayTime" id="displayTime">2014</output>年的沈阳地图。                  
         </div> 
         <input type="button" onclick="showmap(0);window.times = 1;" value="显示全部POI"/>
         <input type="button" onclick="showmap(1);window.times = 0;" value="取消"/> 
         <div id="showoldmap"></div>
         <fieldset>
         	<legend>标准数据查询</legend>
         	 <input type="text" id="keyword" placeholder="请输入关键字"/><span>输入关键字，然后可以测试三种查询方式</span>
         	 <p>关键字查询<input type="button" onclick="keyword_search()" value="查询"/></p>
         	 <p>圆形区域查询<input type="button" onclick="circle_search()" value="开始绘制圆形域"></p>
         	 <p>矩形区域查询<input type="button" onclick="rectangle_search()" value="开始绘制矩形域"></p>
         </fieldset>
         <fieldset>
         	<legend>GIS数据查询</legend>
         	 <form id="gis_search_form" method="POST" action="__URL__/gis_keyword_search">
         	    <input type="hidden" name="ajax" value="1">
         	 	<input type="text" name="giskeyword" placeholder="请输入关键字"/><span>输入关键字，然后可以测试三种查询方式</span>
                <p>关键字查询<input type="submit" value="提 交" /></p>
                <!--p>关键字查询<input type="button" onclick="gis_keyword_search()" value="提 交" /></p-->
         	 	<!--p>圆形区域查询<input type="submit" onclick="" value="开始绘制圆形域"></p>
         	 	<p>矩形区域查询<input type="submit" onclick="" value="开始绘制矩形域"></p-->
         	 	
         	 </form>
         </fieldset>
    </div>
     <!-----------地图  end----------->
     <div id="result"></div>
     <div id="gis_result">
	 </div>
	 <div id="list" style="float:left;background-color:lightblue;width:500px;"></div>
	 
</body>
</html>