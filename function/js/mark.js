





$(document).ready(function(){
	
	//获取poi的全景图point
//	var point  = $('.panorama').text();
//	if(point){
//		var lng = point.substring(point.indexOf("(")+1,point.indexOf(" "));
//		var lat = point.substring(point.indexOf(" ")+1,point.indexOf(")"));
//		//显示全景图
//		var map = new BMap.Map("panorama",{minZoom:9,maxZoom:18, enableMapClick:false});//新建地图
//		map.centerAndZoom(new BMap.Point(123.44323,41.823981), 12);
//		map.addTileLayer(new BMap.PanoramaCoverageLayer());
//		var panorama = new BMap.Panorama('panorama'); 
//		panorama.setPov({heading: -40, pitch: 6});
//		panorama.setPosition(new BMap.Point(lng,lat));
//	}

	
	//星级评分
	$('.square_ul a').hover(function(){
		$(this).addClass('active-square');
	},function(){
		$(this).removeClass('active-square');
	});
	$('.general a').click(function(){
		$('#general').css('color','#c00').html($(this).attr('title'));
	});
	$('.history a').click(function(){
		$('#history').css('color','#c00').html($(this).attr('title'));
	});
	$('.protect a').click(function(){
		$('#protect').css('color','#c00').html($(this).attr('title'));
	});

	$('.btn_submit').click(function(){
		var username = $('.username').text();
		if(username != ""){
			var gscore = change($('#general').html());
			var hscore = change($('#history').html());
			var pscore = change($('#protect').html());
			submitMark(gscore,hscore,pscore);
		}else{
			alert("请您先登录");
		}
	});
	
});

function submitMark(gscore,hscore,pscore){
	$.ajax({
	 	type: "GET",
	 	url: "http://127.0.0.1/gisproject/function/mark.php",
	 	dataType: "text",
		data : { 
			name : $('.name').text(),
			gscore : gscore,
			hscore : hscore,
			pscore : pscore
		},
	 	success : function(data){
		 	alert(data);
	 	},
		error : function() {
			alert("系统正在维护");
		}
	});
	
}

function change(score){
	switch(score){
		case "差": score = '1' ; break;
		case "一般": score = '2'; break;
		case "好": score = '3'; break;
		case "很好": score = '4'; break;
		case "非常好": score = '5'; break; 
    }
	return score;	
}

/*
var xmlHttp;		
function xmlhttprequest(){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}
}


function change(score){
	switch(score){
		case "差": score = '1' ; break;
		case "一般": score = '2'; break;
		case "好": score = '3'; break;
		case "很好": score = '4'; break;
		case "非常好": score = '5'; break; 
    }
	return score;	
}
function submit_comment(){
	if($('#username').val() != ""){
		var gscore = change($('#general').html());
		var cscore = change($('#cultural').html());
		var escore = change($('#environment').html());
		var sscore = change($('#serve').html());
		var pscore = change($('#price').html());
		
		xmlhttprequest();
		var url = "http://127.0.0.1/gisproject/function/mark.php?name="+$('#name').val()+
				       "&gscore="+gscore+"&cscore="+cscore+"&escore="+escore+"&sscore="+sscore+"&pscore="+pscore;
		xmlHttp.open("GET",url,true);
		xmlHttp.onreadystatechange = ready;
		xmlHttp.send(null);
	}else{
		alert("请您先登录，登录后才能评价,登录入口在首页右上角");
	}
	
}


var ready = function (){
	if(xmlHttp.readyState == 4){
		if(xmlHttp.status == 200){
			alert(xmlHttp.responseText);
		}else{
			alert("系统正在维护中。");
		}
	}	
}*/