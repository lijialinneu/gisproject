$(document).ready(function(){
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
	//单击获取点击的经纬度
	map.addEventListener("click",function(e){
		$("#longitude").val(e.point.lng);
		$("#latitude").val(e.point.lat);
	});
	
	$('#btn_submit').click(function(){
		name = $('#name').val();
		year = $('#timestamp').val().substring(0,4);

		
		var lng = $('#longitude').val();
		var lat = $('#latitude').val();
		//合成point
		point = "POINT("+lng+" "+lat+")";
		type = $('#type').val();
		brief_introduce = $('#brief_introduce').val();
		wiki = $('#wiki').val();
		panorama = $('#panorama').val();
		editor = UE.getEditor('editor').getContentTxt();
		
		if(name==""){
			alert("名字不能为空");
		}else if(timestamp==""){
			alert("时间不能为空");
		}else if(point==""){
			alert("经纬度不能为空");
		}else if(brief_introduce==""){
			alert("简介不能为空");
		}else if(wiki==""){
			alert("维基链接不能为空");
		}else if(panorama==""){
			alert("360全景图不能为空");
		}else if(editor==""){
			alert("详细简介不能为空");
		}else{
			addPOI();
		}
		
//		alert(UE.getEditor('editor').getContentTxt());
//		alert($('#name').val()+" "+$('#timestamp').val()+" "+$('#longitude').val()+" "+$('#latitude').val()+" "+$('#type').val()+" "+
//				$('#brief_introduce').val()+" "+$('#wiki').val()+" "+$('#panorama').val());
	});
});


function addPOI(){
	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/addNewPOI.php",
	 	dataType: "text",
		data : { 
			name : name,
			year : year,
   		    point : point,
			type : type,
			brief_introduce : brief_introduce,
			wiki : wiki,
			panorama : panorama,
			editor : editor
		},
	 	success : function(data){
		 	alert(data);
	 	},
		error : function() {
			alert("系统正在维护");
		}
	});
	
}