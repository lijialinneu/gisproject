<?php 
include "common.php";

/*
 * 以下代码用于完成将user的comment提取出来，解析，然后构造$poi_rank数组，用于存储POI的name及其平均score，并根据平均score由大到小排序
 * 默认每个POI都有不同的name，这是处理沈阳城文物这个问题的默认边界（我觉得）
 */

$sql = mysql_query("SELECT `comment` FROM tb_user");
$poi_rank = array();

while ($comment = mysql_fetch_array($sql)) {
	$thecomment = json_decode($comment[0],true);
	$num = count($thecomment["comment"]);//user的comment里评价过的POI的个数
	if($num == 0) continue;//如果user没有comment直接continue
	$flag = 0;//标志位
	for($i = 0 ; $i < $num ; $i++){
		for($j = 0;$j < count($poi_rank) ; $j++){
			if($poi_rank[$j]["name"] == $thecomment["comment"][$i]["name"]){//如果$poi_rank里已存在该POI，那么修改$poi_rank即可
				$poi_rank[$j]["num"]++  ;
				$poi_rank[$j]["score"] =  $poi_rank[$j]["score"] + $thecomment["comment"][$i]["gscore"];
				$flag = 1;//标志位
				break;
			}
		}
		if($flag == 1){
			$flag = 0;continue;
		}else{//如果$poi_rank不存在该POI，添加即可
			$poi_rank[count($poi_rank)] = array(
					"name" => $thecomment["comment"][$i]["name"],
					"score" => $thecomment["comment"][$i]["gscore"],
					"num" => 1
			);
		}
	}
}
for($i = 0 ; $i<count($poi_rank) ; $i++){
	if($poi_rank[$i]["num"] != 0){
		$poi_rank[$i]["score"] = $poi_rank[$i]["score"] / $poi_rank[$i]["num"];
		/*
		 * 将每个poi的score 更新到tb_point中
		 */
		
		$sql = "UPDATE tb_point SET `score` = '".$poi_rank[$i]["score"]."' WHERE `name` = '".$poi_rank[$i]["name"]."'";
	}
}

/*
 * 按POI的平均score由大到小排序，凑合用快排吧先
 */

function quicksort($str){
	if(count($str) <= 1) return $str;//如果个数不大于一，直接返回
	$key = $str[0];//取一个值，稍后用来比较；
	$key_score = $str[0]["score"];
	$left_arr = array();
	$right_arr = array();

	for($i = 1 ; $i < count($str) ; $i++){//比$key大的放在右边，小的放在左边；
		if($str[$i]["score"] >= $key_score)
			$left_arr[] = $str[$i];
		else
			$right_arr[] = $str[$i];
	}
	$left_arr = quicksort($left_arr);//进行递归；
	$right_arr = quicksort($right_arr);
	return array_merge($left_arr,array($key),$right_arr);//将左中右的值合并成一个数组；
}


$poi_rank = quicksort($poi_rank);//这个poi_rank是poi的排序，用这个排序向没有comment的user推荐


/*
 * 向tb_user表里更新推荐内recommand
 */
function recommand($user,$content){
	$recommand = urldecode(json_encode(urlencode($content)));
	$updatesql = "UPDATE tb_user SET recommand = '$recommand' WHERE `userid` = '$user'";
	if(!mysql_query($updatesql)){
		echo mysql_error();
	}
}

/*
 * 以下代码用于协同过滤推荐，对于没有comment的user，按POI的score高低进行推荐
 */

$sql = mysql_query( "SELECT `userid`,`comment` FROM tb_user" );
$userlist = array();
$i = 0;
while($user = mysql_fetch_array($sql)){
	if($user[1] == null){//向其推荐得分高的POI

		//echo "向用户".$user[0]."推荐的POI是：".$poi_rank[0]["name"]." ".$poi_rank[1]["name"]." ".$poi_rank[2]["name"]."<br/>";
		recommand($user[0],$poi_rank[0]["name"]." ".$poi_rank[1]["name"]." ".$poi_rank[2]["name"]);
	}else{
		$userlist[$i] = array(
				"id" => $user[0],
				"comment" => json_decode($user[1],true)
		);
		$i++;
	}
}

$num = count($userlist);  //$userlist是有comment的user集合
$cos = array();  //定义一个数组cos(),且定义cos(i,j) = cos(j,i)

/*
 * 对useri和userj 求cos(i,j) 注：cos(i,j)  = cos(j,i)
 */

for($i = 0 ; $i < $num ; $i++){
	$numi = count($userlist[$i]["comment"]["comment"]); //useri的comment里评论的个数
	for($j = $i + 1 ; $j < $num ; $j++){
		$numj = count($userlist[$j]["comment"]["comment"]); //userj的comment里评论的个数
		$numerator = 0;	//初始化分子为0
		$denominatori = 0;	//初始化分母i为0
		$denominatorj = 0;	//初始化分母j为0
		$pnumerator = 0;		//初始化Predict分子为0
		$pdenominator = 0;	//初始化Predict分母i为0
		
		if($numi <= $numj){ //谁评论的数量少，就以谁为基础循环
			for($p = 0 ; $p < $numi ; $p++){
				//计算分母i
				$denominatori += pow($userlist[$i]["comment"]["comment"][$p]["gscore"],2);
				for($q = 0 ; $q < $numj ; $q++){
					//如果useri和userj有评论的交集
					if($userlist[$i]["comment"]["comment"][$p]["name"] == $userlist[$j]["comment"]["comment"][$q]["name"]){
						//计算分子
						$numerator += $userlist[$i]["comment"]["comment"][$p]["gscore"] * $userlist[$j]["comment"]["comment"][$q]["gscore"];
					}
				}
			}
			for($q = 0 ; $q < $numj ; $q++){
				//计算分母j
				$denominatorj += pow( $userlist[$j]["comment"]["comment"][$q]["gscore"],2);
			}
			$denominator = sqrt($denominatori) * sqrt($denominatorj);
			if($denominator !=0 ){
				$cos[$j][$i] = $cos[$i][$j]  = $numerator / $denominator;
			}
		} else {
			for($p = 0 ; $p < $numj ; $p++){
				//计算分母i
				$denominatorj += pow($userlist[$j]["comment"]["comment"][$p]["gscore"],2);
				for($q = 0 ; $q < $numi ; $q++){
					//如果useri和userj有评论的交集
					if($userlist[$j]["comment"]["comment"][$p]["name"] == $userlist[$i]["comment"]["comment"][$q]["name"]){
						//计算分子
						$numerator += $userlist[$j]["comment"]["comment"][$p]["gscore"] * $userlist[$i]["comment"]["comment"][$q]["gscore"];
					}
				}
			}
			for($q = 0 ; $q < $numi ; $q++){
				//计算分母j
				$denominatori += pow($userlist[$i]["comment"]["comment"][$q]["gscore"],2);
			}
			$denominator = sqrt($denominatori) * sqrt($denominatorj);
			if($denominator !=0 ){
				$cos[$j][$i] = $cos[$i][$j] = $numerator / $denominator;
			}
		}
	}
}
/*
 * 说明：$userlist存储用户id，和command
 *          $cos存储用户i,j之间的cos值，cos(i,j) = cos(j,i)
 *          $poi_rank存储POI的name和score，并按score由大到小排序
 *          $predict存储用户u和物品i的Predict值：Predict(u,i)
 */


$predict = array();
$recommand = array();
for($u = 0 ; $u < count($cos) ; $u++){
	$poi_recommand = "";
	for($i = 0 ; $i < count($poi_rank) ; $i++){
		$flag = 0;
		for($j = 0 ; $j < count($userlist[$u]["comment"]["comment"]) ; $j++){
			if($poi_rank[$i]["name"] != $userlist[$u]["comment"]["comment"][$j]["name"]){
				$flag++;
			}
		}
		if($flag == 2){
			/*
			 * 计算用户u和物品i的Predict值
			 */
			$pnumerator = 0;	//初始化分子为0
			$pdenominator = 0;	//初始化分母i为0
			for($k = $u+1 ; $k < count($cos) ; $k++){
				if($cos[$u][$k] > 0.5){
					//计算分子
					$pnumerator += $cos[$u][$k] * $userlist[$k]["comment"]["comment"][$i]["gscore"];
					//计算分母
					$pdenominator += abs($cos[$u][$k]);
				}
			}
			$predict[$u][$i] = $pnumerator/sqrt($pdenominator);		
			if($predict[$u][$i] > 3){
				//echo "向用户".$userlist[$u]["id"]."推荐的POI是".$poi_rank[$i]["name"]."<br/>";
				$poi_recommand = $poi_recommand.$poi_rank[$i]["name"]." ";
			}
		}
	}
	recommand($userlist[$u]["id"],$poi_recommand);
}
print_r($predict);


?>