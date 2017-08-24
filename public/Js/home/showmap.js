// 初始加载百度地图模块	
map = new BMap.Map("showmap",{minZoom:9,maxZoom:18, enableMapClick:false});//新建地图
map.centerAndZoom(new BMap.Point(123.44323,41.823981),13);
map.enableScrollWheelZoom();
//添加比例尺控件
var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
map.addControl(top_left_control);        
map.addControl(top_left_navigation);     
//设置地图边界
var bounds = new BMap.Bounds(new BMap.Point(122.549822,41.286996),new BMap.Point(124.187181,42.421728));
try {	
	BMapLib.AreaRestriction.setBounds(map, bounds);
}catch(e){
	alert(e);
}

$(document).ready(function(){
	//时间轴
	 changeDate();
	 var ff = new SellerScroll();
	 var ul = $ ("ul#carousel_ul");
     var imgs = ul.find ("li img");
     var len = imgs.length;
     $ ("input[type=range]").change (function (){ 
    	 if($(this).val()<=8){
	 		    ul.css ({
	 	             left :-(imgs.width ()+4.5) * ($ (this).val ()-1) * len / ($ (this).attr ("max")-1) + "px"
	 	         });
	 	 }else{
	 		 $('#img_frame').css({
	 			 left :+(imgs.width ()+4.5) * ($ (this).val ()-8)*len /  ($ (this).attr ("max")-1)+ "px"
	 		 });
	 	 }
	    changeDate();
	 	 if($(this).val()==1){//为了弥补wrong效果写的
	 		 $('#img_frame').css("left","0px");
	 	 }
     });
    
     //关键字
 	$('#btn_search').click(function(){
		keywordSearch();
	});
 	//区域查询
 	$('#btn_dpoly').click(function(){
 		drawPolygon(0);
 	});
 	//添加POI
 	$('#btn_addpoi').click(function(){
 		window.open("http://127.0.0.1/gisproject/function/addpoi.html");
 	});
 	//路线规划
 	$('#btn_getpath').click(function(){
 		window.open("http://127.0.0.1/gisproject/function/getpath.html");
 	});
 	//查看推荐
 	recommand();
});


markers = new Array();
points = new Array();
infoWindows = new Array();
contents = new Array();
newdate = 1900;
// 时间轴模块
function changeDate(){  
	switch($('#range').val()){
		case "1": newdate = 1900; break;
		case "2": newdate = 1910; break;
		case "3": newdate = 1920; break;
		case "4": newdate = 1930; break;
		case "5": newdate = 1940; break;
		case "6": newdate = 1950; break;
		case "7": newdate = 1960; break;
		case "8": newdate = 1970; break;
		case "9": newdate = 1980; break;
		case "10": newdate = 1990; break;
		case "11": newdate = 2000; break;
	}
	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/dateSearch.php",
	 	dataType: "json",
		data : { 
			date :newdate
		},
	 	success : function(data){
		 	showPOI(data,0);
	 	},
		error : function() {
				alert("系统正在维护");
		}
	});
}
function keywordSearch(){
	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/keywordSearch.php",
	 	dataType: "json",
		data : { 
			keyword : $('#keyword').val(),
			date:newdate
		},
	 	success : function(data){
		 	showPOI(data,1);
	 	},
		error : function() {
				alert("系统正在维护");
		}
	});
}

//区域查询
function drawPolygon(flag){
		if(flag==0){
			modes = [BMAP_DRAWING_MARKER,BMAP_DRAWING_POLYLINE,BMAP_DRAWING_POLYGON];
		}else if(flag==1){
			modes = [BMAP_DRAWING_MARKER]
		}else if(flag==2){
			modes = [BMAP_DRAWING_POLYLINE] 
		}
        //实例化鼠标绘制工具
       var drawingManager = new BMapLib.DrawingManager(map, {
            isOpen: false, //是否开启绘制模式
            enableDrawingTool: true, //是否显示工具栏
            drawingToolOptions: { 	
                anchor: BMAP_ANCHOR_TOP_RIGHT, //位置
                offset: new BMap.Size(5, 5), //偏离值
                drawingModes:modes,
            },
       });
	   drawingManager.addEventListener('overlaycomplete', overlaycomplete);
}
var overlays = [];
var overlaycomplete = function(e){
    overlays.push(e.overlay);
    if(e.drawingMode=="marker"){//近邻查询
    	nearbySearch(e);
    }else if(e.drawingMode=="polyline"){//直线查询
    	polySearch(e,1);
    }else{//多边形查询
    	polySearch(e,2);
    }
};
//function clearAll() {
//	for(var i = 0; i < overlays.length; i++){
//        map.removeOverlay(overlays[i]);
//    }
//    overlays.length = 0   
//}


//近邻查询
var pointMK = [];
function nearbySearch(e){
	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/nearbySearch.php",
	 	dataType: "json",
		data : { 
			point : "POINT("+e.overlay.point.lng+" "+e.overlay.point.lat+")",
			date : newdate
		},
	 	success : function(data){
	 		showPOI(data,2);
	 		for(var i=0;i<pointMK.length;i++){
				map.removeOverlay(pointMK[i]);
			}
			var pointclick = new BMap.Point(e.overlay.point.lng,e.overlay.point.lat);
			var myIcon =new BMap.Icon("http://127.0.0.1/gisproject/public/Images/home/mypoint.jpg", new BMap.Size(32,70), {   
			    imageOffset: new BMap.Size(0, 0)    //图片的偏移量。为了是图片底部中心对准坐标点。
			});
		    marker = new BMap.Marker(pointclick,{icon:myIcon});  //创建标注
			var label = new BMap.Label("刚才的位置",{offset:new BMap.Size(20,-10)});
			marker.setLabel(label);
			pointMK.push(marker);
			map.addOverlay(marker);    //添加marker到地图上

			if(data.length ==0){
				var content = "附近<font color='red'>没有</font>POI";
			}else{
				var content = "附近有<font color='red'>"+data.length+"</font>个POI";
			}
			var opts = {
					width : 220,     
					height: 60,     
					title: '近邻查询结果',
					enableMessage:false//设置允许信息窗发送短息
			};
			var infoWindow =  new BMap.InfoWindow(content,opts);
			map.openInfoWindow(infoWindow,e.overlay.point); //开启信息窗口
	 	},
		error : function() {
				alert("系统正在维护");
		}
	});
}

function polySearch(e,flag){
	
	var path = e.overlay.getPath();
	var points = Array();
	var maxlng =  maxlat = 0;
	var minlng = minlat = 1000; 
	for(var i=0;i<path.length;i++){
		points[i] = "POINT("+path[i].lng+" "+path[i].lat+")";
		if(path[i].lng>maxlng) maxlng = path[i].lng;
		if(path[i].lng<minlng) minlng = path[i].lng;
		if(path[i].lat>maxlat) maxlat = path[i].lat;
		if(path[i].lat<minlat) minlat = path[i].lat;
	}
	if(flag==1){
		minlng -= 0.005;
		minlat -= 0.005;
		maxlng += 0.005;
		maxlat += 0.005;
	}
	var bbox =  "POLYGON(("+minlng+" "+minlat+","+maxlng+" "+minlat+","+maxlng+" "+maxlat+","+minlng+" "+maxlat+","+minlng+" "+minlat+"))";

	
	if(flag==1){
		var url =  "http://127.0.0.1/gisproject/function/lineSearch.php";
	}else{
		var url = "http://127.0.0.1/gisproject/function/polygonSearch.php";
	}
	$.ajax({
	 	type: "GET",
	 	url: url,
	 	dataType: "json",
		data : { 
			points : points ,
			bbox : bbox,
			date : newdate
		},
	 	success : function(data){
	 		showPOI(data,2);
	 		map.addOverlay(e.overlay);
	 	},
		error : function() {
			alert("系统正在维护");
		}
	});
}




function showPOI(data,flag){
	map.clearOverlays();
	var result = "<div id='result'>";
	
	if(data.length<1&&flag==1){
		result += "没有命中的记录"+
		"<a href='http://127.0.0.1/gisproject/function/addpoi.html' target='_BLANK'>" +
		"<font color='orange'>添加</font></a></div>";
		result +="</div>";
		$('#panel').html(result).show();
	}else if(data.length>0){
		for(var i=0;i<data.length;i++){
			data[i][3] = changeContent(data[i][3],data[i][1]);
			addSpace(data[i][4]);
			
			if(flag==1){
				var str = "<div class='introduce' id="+(i+1)+">" +
					"<div id='img'><img src="+data[i][2]+" /></div>" +
						"<div id='name'>"+data[i][4]+"年代的"+data[i][1]+"："+data[i][3]+"</div></div>";
				result += str;
				var splitWord = data[data.length-1];
				var string = '';
				for(var j=0;j<splitWord.length;j++){
					string += (splitWord[j]+" ");   
				}
			}else{
				result += "<div class='introduce' id="+(i+1)+">" +
				"<div id='img'><img src="+data[i][2]+" /></div>" +
					"<div id='name'>"+data[i][3]+"</div></div>";
			}
			
			var lng = getLng(data[i][0]);
			var lat = getLat(data[i][0]);
			addMarker(lng,lat,i);
			addLabel(data[i][1],i);
			addInfoWindowContent(data[i][1],data[i][3],data[i][0],i);
			
			if((flag==1) && (i==data.length-2)){break;}
		}
		result += "</div>";
		$('#panel').html(result).show();
		if(flag==1){
			$("#panel").textSearch(string,{markColor: "red"});
		}
		addResultPanelEvent();
	}else{
		result += "没有命中的记录"+
		"<a href='http://127.0.0.1/gisproject/function/addpoi.html' target='_BLANK'>" +
		"<font color='orange'>添加</font></a></div>";
		$('#panel').html(result).show();
	}
}
function changeContent(content,name){
	if(content==null){
		content = name+"：暂无简介"+
		"<a href='http://127.0.0.1/gisproject/function/edit.html' target='_BLANK'>" +
		"<font color='orange'>编辑</font></a>";
	}
	return content;
}
function addSpace(pointlist){
	if(pointlist!=null){
		var space = pointlist.split(',');
		for(var i=0;i<space.length-1;i++){
			var lng = getLng(space[i]);
			var lat =  getLat(space[i]);
			var point = new BMap.Point(lng,lat);
			var lngNext = getLng(space[i+1]);
			var latNext =  getLat(space[i+1]);
			var pointNext = new BMap.Point(lngNext,latNext);
			var polyline = new BMap.Polyline([point,pointNext], {strokeColor:"#f90", strokeWeight:9, strokeOpacity:0.5});  
			map.addOverlay(polyline); 
		}
	}
}
function getLng(point){
	return point.substring(point.indexOf("(")+1,point.indexOf(" "));
}
function getLat(point){
	return point.substring(point.indexOf(" ")+1,point.indexOf(")"));
}
function addMarker(lng,lat,i){
	points[i] = new BMap.Point(lng,lat);
	markers[i] = new BMap.Marker(points[i]);  
	map.addOverlay(markers[i]); 
}
function addLabel(name,i){
	var label = new BMap.Label(name,{offset:new BMap.Size(20,-10)});
	markers[i].setLabel(label);
}
function addInfoWindowContent(name,brief_introduce,point,i){
	var url = "http://127.0.0.1/gisproject/function/pointSearch.php";
	contents[i] = "<div id='info'>"+name+"：<br/>"+brief_introduce+"<br/><a href='"+url+"?point="+point+"' target='_blank'>详情</a></div>";
	addClickHandler(contents[i],markers[i],i); 	
}
function addResultPanelEvent(){
	$("div .introduce").mouseout(function(){
		 $(this).css("background-color","#222");
	});
	$("div .introduce").mouseover(function(){
		$(this).css("background-color","#f90");	   
	     var k = this.id-1;
		 infoWindows[k] =  new BMap.InfoWindow(contents[k],opts);
		 map.openInfoWindow(infoWindows[k],points[k]); //开启信息窗口
	});
};
var opts = {
	width : 300,     
	height: 150,     
	title: '简介',
	enableMessage:false//设置允许信息窗发送短息
};
function addClickHandler(content,marker,i){
	marker.addEventListener("click",function(e){
		openInfo(content,e,i);
	});
}
function openInfo(content,e,i){
	infoWindows[i] =  new BMap.InfoWindow(content,opts);
	map.openInfoWindow(infoWindows[i],points[i]); //开启信息窗口
}




/*
 *推荐列表模块 
 */

function recommand(){

	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/recommand.php",
	 	dataType: "text",
		data : { 
			username : $('.username').text()
		},
	 	success : function(data){
	
	 		if(data==" "){
	 			$('#recommand').html("暂无，因你没有评价过,快去评价");
	 		}else{
	 			$('#recommand').html(data);
	 		}
	 	},
		error : function() {
				alert("系统正在维护");
		}
	});

}

