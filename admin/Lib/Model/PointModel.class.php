<?php
/*
 * 自定义Point模型类
 */
class PointModel extends Model{
	protected $_validate=array(
			
			array('longitude','require','请输入经度'),
			array('latitude','require','请输入纬度'),
			array('name','require','请输入名称'),
			
	);
	protected $_auto=array(
         	array('status','2','add','function'), //自动将status默认为2
         	array('attention','0','add','function'),
         	array('score','0','add','function'),
         
    );
}
?>