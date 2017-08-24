<?php 
/*
 * 协同推荐算法思想及流程
 * 在index.php中添加import,导入协同推荐代码，使协同推荐过程一直运行
 * 
 * 开始
 * n = count(tb_user);//总人数
 * //计算user[i]的推荐
 * for($i = 0 ; $i < n ; $i++){
 * 	if(user[i] dont have coment){//此处调用查询tb_user的comment函数
 * 		推荐评分高的poi给user[i]//根据user的总评，建表，将被评价过的POI按得分高低排序。计算方法为：POI总得分 = ∑user评分 / n
 * 	}else{ 
 * 		for($j = $i ; $j < n ; $j++){
 *             cos[j] = 0//初始化分数值为0
 *             numerator = 0;//初始化分子为0
 *             denominatori = 0;//初始化分母i为0
 *             denominatorj = 0;//初始化分母j为0
 * 			if(user[i][comment].length <= user[j][comment].length){
 * 				//以i为基础计算Cos
 * 				for($k = 0 ; $k < user[i][comment].length ; $k++){
 * 					denominatori += user[i][comment][k]["gscore"]^2;
 * 					for($t = 0;$t < us   er[j][comment].length;$t++){
 * 						denominatorj += user[j][comment][t]["gscore"]^2;
 * 						if(user[i][comment][k]["name"] == user[j][comment][t]["name"])	{//useri和userj如果有评分项相同的，比如都有北陵
 * 							numerator += user[i][comment][k]["gscore"] * user[j][comment][t]["gscore"];
 * 							break;
 * 						}
 * 					}
 * 				}
 * 				//计算分数值,记录i和j的Cos值
 *                 cos[j]  =  numerator / sqrt(denominatori) * sqrt(denominatorj);
 * 			}else[
 * 			   //以j为基础计算Cos
 * 				for($k = 0 ;$k < user[j][comment].length ; $k++){
 * 					denominatorj += user[j][comment][k]["gscore"]^2;
 * 					for($t = 0;$t < user[i][comment].length;$t++){
 * 						denominatori += user[i][comment][t]["gscore"]^2;
 * 						if(user[j][comment][k]["name"] == user[i][comment][t]["name"])	{//useri和userj如果有评分项相同的，比如都有北陵
 * 							numerator += user[j][comment][k]["gscore"] * user[i][comment][t]["gscore"];
 * 							break;
 * 						}
 * 					}
 * 				}
 * 				//计算分数值,记录j和i的Cos值
 *                 cos[j]  =  numerator / sqrt(denominatori) * sqrt(denominatorj);
 * 			}  
 * 		}
 * 	}
 * 
 * }
 * 	//计算好cos[j]值后，用快排按cos[j]值由大到小排序cos[j]
 *             快排代码略。。。。
 *     //根据排序结果，选出前5个cos[j]大的来计算Predict(u,i)
 *             pnumerator = 0;//初始化p分子为0
 *             pdenominator = 0;//初始化p分母为0
 *             np = count(tb_point);//POI个数
 *             for($u = 0 ; $u < np ; $u++){
 *             	 for($p = 0 ; $p < 5 ; $p++){
 *             		pnumerator += cos[$p] * R(p,u);
 *             	 }
 *                  pdenominator += cos[$p];
 *                 new pdenomitor = sqrt(pdenomitor);
 *                 
 *                 
 *                 
 *             }
 *             
 */
 $aaa;
 $aaa;
 /*
  * 构造函数
  * $file 缓存文件地址
  * $cachetime 缓存时间
  */
 function _construct($file,$cachetime = 3600){
 	$this->flie = $file;
 	$this->cachetime = $cachetime;
 }
 
 
 
 
?>
