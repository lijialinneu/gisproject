// 百度地图API功能
var map = new BMap.Map("allmap", {
	minZoom : 9,
	maxZoom : 18
});//新建地图
map.centerAndZoom(new BMap.Point(123.4432300000, 41.8109810000), 14);
map.enableScrollWheelZoom();
//设置地图边界
var bounds = new BMap.Bounds(new BMap.Point(122.5498220000, 41.2869960000),
		new BMap.Point(124.1871810000, 42.4217280000));
try {
	BMapLib.AreaRestriction.setBounds(map, bounds);//设置地图边界
} catch (e) {
	alert(e);
}


function resizepic(thispic) {
	if (thispic.width > 700)
		thispic.width = 700;
}
zoom = 0;
function bbimg(o) {
	zoom = parseInt(o.style.zoom, 10) || 100;
	zoom += event.wheelDelta / 12;
	if (zoom > 0)
		o.style.zoom = zoom + '%';
	return false;
}

function mousePosition(ev) {
	if (ev.pageX || ev.pageY) {
		return {
			x : ev.pageX,
			y : ev.pageY
		};
	}
	return {
		x : ev.clientX + document.body.scrollLeft - document.body.clientLeft,
		y : ev.clientY + document.body.scrollTop - document.body.clientTop
	};
}
mx = 0;
my = 0;
function mouseMove(ev) {
	ev = ev || window.event;
	var mousePos = mousePosition(ev);
	//document.getElementById('xxx').value = mousePos.x;
	//document.getElementById('yyy').value = mousePos.y;
	mx = mousePos.x;
	my = mousePos.y;
}
document.onmousemove = mouseMove;

function getNodePosition(node) {     
    var top = left = 0;
    while (node) {   
        if (node.tagName) {
            top = top + node.offsetTop;
            left = left + node.offsetLeft;   
            node = node.offsetParent;
        }
        else {
            node = node.parentNode;
        }
    } 
    return [top, left];
}

function Show(el) {
	map.clearOverlays()
    var top_rel_to_doc = getNodePosition(el)[0];
    var left_rel_to_doc = getNodePosition(el)[1];
	//var x = parseInt(document.getElementById('xxx').value) - left_rel_to_doc;
	//var y = parseInt(document.getElementById('yyy').value) - top_rel_to_doc;
    var x = parseInt(mx) - left_rel_to_doc;
	var y = parseInt(my) - top_rel_to_doc;

	if(zoom == 0){
		zoom = 100;
	}
	x = x / zoom * 100;
	y = y / zoom * 100;
	
	//var NW = [123.3802330000,41.8386810000];//西北角经纬度123.493186  123.380233
	var px = x / 700 * 0.112953 + 123.380233;
	var py = 41.838681 - y / 485 * 0.051507;
	//alert(px+" "+py);
	/*
	 * 根据不同px，py在Bmap上显示标注点
	 */
	if(px >= 123.455266 && px <= 123.469949){
		if(py >= 41.8045908 && py <= 41.8141488){
			var point = new BMap.Point(123.462202,41.804471);
			var marker = new BMap.Marker(point);  // 创建标注
			map.addOverlay(marker); 
	
			var label = new BMap.Label("故宫",{offset:new BMap.Size(20,-10)});//创建Label
			marker.setLabel(label);
		}
		
	}else{
		py = py - 0.005;
		var point = new BMap.Point(px,py);
		var overlay = new BMap.Circle(point, 300);
		map.addOverlay(overlay);
	}

}

