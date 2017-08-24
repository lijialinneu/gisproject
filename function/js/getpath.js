// 百度地图API功能
var map = new BMap.Map("allmap",{minZoom:9,maxZoom:18});//新建地图
map.centerAndZoom(new BMap.Point(123.4432300000,41.8239810000),13);
map.enableScrollWheelZoom();
//设置地图边界
var bounds = new BMap.Bounds(new BMap.Point(122.5498220000,41.2869960000),new BMap.Point(124.1871810000,42.4217280000));
try {	
	BMapLib.AreaRestriction.setBounds(map, bounds);//设置地图边界
}catch(e){
	alert(e);
}          
var driving = new BMap.DrivingRoute(map, {renderOptions: {map: map, panel: "r-result", autoViewport: true}});
driving.search("东北大学-南门", "北陵公园-南门");

//单击获取点击的经纬度
map.addEventListener("click",function(e){
	var point = "POINT("+e.point.lng+" "+e.point.lat+")";
	alert(point);
});
$(document).ready(function(){
	$('#btn_submit').click(function(){
//		var start = $('#start').val();
//		var pointlist = $('#pointlist').val();
		start = "POINT(123.463937 41.80754)";
		pointlist = "POINT(123.462177 41.803698),POINT(123.455188 41.80355),POINT(123.442073 41.809559),POINT(123.462945 41.799658)" +
				"POINT(123.470908 41.807711)";
		points = start+","+pointlist;
		getPath();
//		if(start==""){
//			alert("起点不能为空");
//		}else if(pointlist==""){
//			alert("途经点不能为空");
//		}else{
//			getPath();
//		}
	});
});

function getPath(){
	
	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/getPath.php",
	 	dataType: "text",
		data : { 
			points : points
		},
	 	success : function(data){
		 	alert(data);
	 	},
		error : function() {
			alert("系统正在维护");
		}
	});
}
