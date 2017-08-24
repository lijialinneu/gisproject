<?php
/*
 * 自定义User模型类
 */
class UserModel extends Model{
	protected $_validate=array(
			array('username','require','请输入用户名'),
			array('username','','用户名已经存在',0,'unique',1),
			array('useremail','email','请输入正确的Email地址'),
			array('useremail','','Email已经存在',0,'unique',1),
			array('userpassword','6,20','密码6~20位',1,'length'),
			array('repassword','userpassword','确认密码不正确',0,'confirm'),
			array('verify','require','验证码必须！'),
			//array('userage','12,100','年龄错误',1,length),
	);
	protected $_auto=array(
         	array('userpassword','md5',1,'function'),  //密码用md5加密后填入数据表中
         	//array('create_time','time','add','function')  //在增加时自动将时间擢填入表中
    );
    
}

?>