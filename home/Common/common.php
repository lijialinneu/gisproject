<?php
/**
 * @函数	SendMail
 * @功能	发邮件
 */
function SendMail($address,$title,$message){
    vendor('PHPMailer.class#phpmailer');
    $mail=new PHPMailer();
    $mail->IsSMTP();// 设置PHPMailer使用SMTP服务器发送Email
    $mail->CharSet='UTF-8';
    $mail->AddAddress($address);// 添加收件人地址，可以多次使用来添加多个收件人
    $mail->Body=$message;// 设置邮件正文
    $mail->From=C('MAIL_ADDRESS');// 设置邮件头的From字段。
    $mail->FromName='行走沈阳';// 设置发件人名字
    $mail->Subject=$title;// 设置邮件标题
	$mail->Host=C('MAIL_SMTP');// 设置SMTP服务器。
    $mail->SMTPAuth=true;// 设置为"需要验证"
    $mail->Username=C('MAIL_LOGINNAME');
    $mail->Password=C('MAIL_PASSWORD');
    $mail->IsHTML(true);  // send as HTML 
    return($mail->Send());
}

/**
 * @函数	keyword_search
 * @功能	关键字查询
 */
/*
function keyword_search($keyword){
	header("Content-Type:text/html; charset=utf-8");
		
	//实例化GIS模型
	$point = D('Point');	
	$selectsql = "SELECT timestamp,AsText(point),type,name,introduce,attention,score,uri FROM tb_point WHERE name LIKE '%$keyword%' ORDER BY AsText(point),timestamp DESC ";
	//$selectsql = "SELECT timestamp,AsText(point),type,name,introduce,attention,score,uri FROM tb_point WHERE match(index_name) against('北陵') ORDER BY AsText(point),timestamp DESC ";
	
	$point_list = $point->query($selectsql);

	//查询结果数
	$count = count($point_list); 
	$point_array = array();
	$num = 1; $k = 0;
	for($i=0;$i<$count;$i++){
		$point_list[$i]['introduce'] = json_decode($point_list[$i]['introduce'],true);
		$point_list[$i]['text'] = $point_list[$i]['introduce']['text'];
		$point_list[$i]['picture'] = $point_list[$i]['introduce']['picture'];
			
		if($point_list[$i]['AsText(point)'] == $point_list[$i+1]['AsText(point)']){
			$num++;continue;
		}else{
			for($j=0;$j<$num;$j++){
				$t = $i-$num+1+$j;
				$point_array[$k][$j] = array(
						"point" => 	$point_list[$t]['AsText(point)'],
						"timestamp" => $point_list[$t]['timestamp'],
						"name" => $point_list[$t]['name'],
						"text" => $point_list[$t]['text'],
						"picture" => $point_list[$t]['picture'],						
				);
			}
			$num = 1;$k++;
		}
	}
	return ($point_array);	//dump($point_array);//$point_array = json_encode($point_array);
}
*/
/**
 * @函数	select_bytime($time)
 * @功能	按年代查poi点，返回json格式
 */
/*
function select_bytime($time){
	header("Content-Type:text/html; charset=utf-8");
		
	//实例化GIS模型
	$point = D('Point');	
	$selectsql = "SELECT X(point),Y(point),name FROM tb_point WHERE Year(timestamp) = $time ORDER BY AsText(point)ASC ";
	$point_list = $point->query($selectsql);

	//查询结果数
	$count = count($point_list); 
	return ($point_list);
}
*/
/**
 * @函数	select_bypoint($point)
 * @功能	按point查poi点，返回json格式
 */
/*
function select_bypoint($pointdata){
	header("Content-Type:text/html; charset=utf-8");
	//echo $pointdata;
	//实例化GIS模型
	$point = D('Point');	
	$selectsql = "SELECT timestamp,name,introduce FROM tb_point WHERE AsText(point) = '$pointdata' ORDER BY timestamp DESC ";
	$point_list = $point->query($selectsql);
		
	//查询结果数
	$count = count($point_list); 

	for($i=0;$i<$count;$i++){
		$point_list[$i]['introduce'] = json_decode($point_list[$i]['introduce'],true);
		$point_list[$i]['text'] = $point_list[$i]['introduce']['text'];
		$point_list[$i]['picture'] = $point_list[$i]['introduce']['picture'];
	}
	//dump($point_list);
	return ($point_list);
}*/
?>