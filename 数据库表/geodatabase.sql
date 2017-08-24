/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1_3306
Source Server Version : 50090
Source Host           : 127.0.0.1:3306
Source Database       : geodatabase

Target Server Type    : MYSQL
Target Server Version : 50090
File Encoding         : 65001

Date: 2015-05-05 15:01:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin` (
  `adminid` int(11) NOT NULL auto_increment,
  `adminname` char(15) NOT NULL,
  `adminpassword` char(32) NOT NULL,
  `admincreatetime` int(11) NOT NULL,
  `adminip` char(16) NOT NULL,
  PRIMARY KEY  (`adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES ('17', 'ruby97', '405958c9e0888f6ddc6221f90576490c', '1337216331', '127.0.0.1');

-- ----------------------------
-- Table structure for tb_clause
-- ----------------------------
DROP TABLE IF EXISTS `tb_clause`;
CREATE TABLE `tb_clause` (
  `clause` text character set utf8
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_clause
-- ----------------------------
INSERT INTO `tb_clause` VALUES ('<p>\r\n感谢您访问行走沈阳网站。<br/> \r\n请务必仔细阅读以下条款和条件，因为您访问本网站即构成您已经接受了这些条款和条件。<br/>\r\n1.网站隐私权说明<br/>\r\n传送到本网站的任何个人信息或资料将受本网站隐私权说明中条款和条件的约束。<br/>\r\n2.追踪技术明<br/>\r\n本网站使用了追踪技术（“Cookies”）。使用“Cookies”的政策是基于个人信息隐私权的相关政策。<br/>\r\n3.信息的准确性、完整性和及时性 <br/>\r\n我们会尽合理努力确保本网站信息的准确性和完整性，但如果我们提供在本网站上的信息不准确或不完整，我们不承担任何责任。任何信赖本网站资料的风险由您自行承担。您认可跟进本网站资料及信息的变化是您的责任。<br/>\r\n4.传输 <br/>\r\n您经由电子邮件或其它方式传输到本网站的任何非个人交流信息或资料，包括任何数据、问题、评论、建议或其它类似内容，均为并将被视为非保密和非专有内容。您上传或发表于本网站的任何内容将成为雀巢的财产，雀巢可将其用作任何用途，包括但不限于复制、披露、传输、发行、播放和发表。此外，您上传至本网站的内容中包含的任何创意、插图、发明、动态、建议或观念，雀巢可自由使用于各种用途（包括但不限于产品的开发、生产、广告和营销)。 所有此类使用均无需对信息提供者支付补偿。通过提供信息，您亦保证所提供的资料/内容为您本人所有且不会涉及诽谤，雀巢也不会因为使用该信息而侵犯任何第三方的权利或违反任何适用法律。雀巢没有义务使用您提供的信息。<br/>\r\n5.知识产权<br/>\r\n本网站上所有文字、图像和其它素材的版权、商标权和其他知识产权皆属雀巢财产或授予雀巢使用权之相关所有权人所有。 \r\n您可以浏览本网站，以打印或下载至硬盘的方式复制其中的内容以转交给其他自然人，但前提是您在该复制内容上完整保留所有的版权和其它知识产权声明以及下述商标权声明：“雀巢产品有限公司  注册商标所有。”禁止为商业盈利之目的而贩卖或散布本网站任何部分的复制品，或将之修改或加入任何其它作品、刊物或网站。<br/>  \r\n本网站展示的所有商标、标志、文字和服务标识（统称“商标”)皆属于雀巢集团旗下的雀巢产品有限公司所有。本网站的任何内容均不应被解释为授予使用本网站所展示商标的许可或权利。除非本使用条款及条件另有规定，严格禁止使用/滥用本网站或本网站其他内容中所展示的商标。我们在此严正声明，雀巢将在法律允许的最大范围内不遗余力地保护其知识产权。<br/>\r\n6.链接至其他网站<br/>\r\n雀巢中国网站的链接会把您带到雀巢中国以外的网站和系统，雀巢对于这些第三方网站的内容、准确性或功能不承担任何责任。雀巢集团系基于善意提供这些链接，对其链接的其他第三方网站的任何后续变动不承担任何负责。提供其他网站的链接并不意味着雀巢认可这些网站。我们强烈建议您了解并仔细阅读您访问的所有其他网站的法律及隐私权说明。<br/>\r\n7.免责声明<br/>\r\n您将自行承担使用和浏览本网站所带来的任何风险。<br/>\r\n8.无担保<br/>\r\n本网站系基于“现状”及“现有内容”提供，因此雀巢不提供任何形式的担保，无论是明示的、默示的、法定的还是其他形式的担保（包括关于适销性、令人满意的质量、特定目的的适用性的默示担保），包括不保证或承诺：本网站中资料的完整性、准确性、可靠性、及时性、未侵害第三方权利；访问本网站将不受干扰、或无错误、或无病毒；本网站是安全的；通过本网站所获得的雀巢的任何建议或意见是准确的或可靠的。并且，雀巢相应地明确表示将不承担所有此类承诺或担保的责任。 <br/>\r\n我们保留不经通知即随时限制、暂停或终止您访问本网站或本网站任何专题或任何部分的权利。<br/>\r\n9.责任<br/>\r\n雀巢及/或代表雀巢参与创作、制作或发布本网站的第三方对因下列原因引起的任何直接的、偶然的、附属的、间接的、特殊的或惩罚性的损害、成本、损失或责任不承担任何形式的义务或责任：您访问、使用、不能使用、修改本网站内容；您通过本网站提供的链接访问其他网站；（在适用法律允许的范围内）针对您发给我们的任何电子邮件信息我们采取行动或不采取行动。 <br/>\r\n雀巢及/或参与创作、制作或发布本网站的第三方没有义务维护本网站提供的资料和服务，或对资料和服务进行任何更正、更新或重新发布。本网站的任何内容不需通知即可变更。 <br/>\r\n此外，由于您使用、访问本网站或从本网站下载任何资料而导致您的电脑设备或其他财产被病毒感染而造成的损失，雀巢不承担任何责任和义务。若您选择从本网站下载资料，须自行承担风险。<br/> \r\n在适用法律允许的最大范围内，您明确地放弃由于您使用或访问本网站而可能产生的针对雀巢及雀巢管理人员、董事、雇员、供应商及程序员的所有诉求。<br/>\r\n10.禁止的行为<br/>\r\n禁止实施以下行为：任何雀巢依其自行判断认定为不适当的行为，不合法的行为，或适用于本网站的任何法律禁止的行为，包括但不限于：\r\n任何构成侵犯他人隐私权（包括未经相关本人同意即上传隐私信息）或其他合法权利的行为\r\n利用本网站诽谤或诋毁雀巢、其雇员或其他自然人，或以有损雀巢良好声誉的方式行事\r\n上传夹带可能损害雀巢财产或他人财产的病毒的文档\r\n在本网站发布或传输任何未经授权的文件，包括但不限于我们认为可能带来骚扰、损害或侵犯雀巢或第三方系统或网络安全、诽谤、种族歧视、淫秽、威胁、色情或其他违法的资料。\r\n11.司法管辖及适用法律<br/>\r\n本网站所显示的任何雀巢产品、资料、报价和信息仅供中国用户及/或客户使用。雀巢不保证本网站上的产品及内容在中国以外的区域是适当的或有供应。请联系我们当地的经销商以获取在您所居住国家或地区产品供应的更多信息。本网站所展示的产品仅系视觉再现，因此并非其真实尺寸、包装、颜色等等。 \r\n您与雀巢皆同意，因使用本网站而产生的或与之有关的争议或索赔受中华人民共和国法律管辖，雀巢（中国）有限公司总部所在地人民法院为管辖法院。\r\n12.解释权<br/>\r\n在法律法规允许的范围内，雀巢对本网站上发布的有关雀巢的信息具有解释权。<br/>\r\n法律声明更新<br/>\r\n我们保留对本使用条款进行修订和更正的权利。请随时查阅本页面，了解本使用条款和新增信息。<br/> \r\n\r\n如您对本条款及条件有任何问题，请按以下地址和方式与我们联络。 <br/>\r\n请致信：<br/> \r\n雀巢（中国）有限公司 <br/>\r\n地址：北京市朝阳区酒仙桥邮局2号信箱 <br/>\r\n邮编：100016 <br/>\r\n收信人：消费者沟通部 <br/>\r\n电子邮件：<a href=\"\">consumerservices@cn.nestle.com</a>\r\n</p>');

-- ----------------------------
-- Table structure for tb_dustbin
-- ----------------------------
DROP TABLE IF EXISTS `tb_dustbin`;
CREATE TABLE `tb_dustbin` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `userpassword` varchar(256) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `usertel` varchar(255) NOT NULL,
  `userquestion` varchar(255) NOT NULL,
  `useranswer` varchar(255) NOT NULL,
  `userage` int(11) NOT NULL,
  `userqq` varchar(255) NOT NULL,
  `userweibo` varchar(255) NOT NULL,
  `professional` varchar(255) default NULL,
  `introduce` text,
  `regtime` int(11) NOT NULL,
  `permission` int(10) NOT NULL,
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_dustbin
-- ----------------------------
INSERT INTO `tb_dustbin` VALUES ('6', 'e', 'e', 'e', '', 'e', 'e', '0', '', '', null, null, '0', '0');
INSERT INTO `tb_dustbin` VALUES ('5', 'c', 'c', 'c', '', 'c', 'c', '0', '', '', null, null, '0', '0');
INSERT INTO `tb_dustbin` VALUES ('36', '豆腐干', '111111', '1040591526@qq.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '0', '1');
INSERT INTO `tb_dustbin` VALUES ('37', 'test', 'ruby97', '1040591527@qq.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '0', '1');
INSERT INTO `tb_dustbin` VALUES ('69', 'bbss', '94e7d712742adbbb7a73a1d52a7cc1a9', '1040591591@126.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '1416659360', '1');

-- ----------------------------
-- Table structure for tb_dustbingis
-- ----------------------------
DROP TABLE IF EXISTS `tb_dustbingis`;
CREATE TABLE `tb_dustbingis` (
  `timestamp` int(4) NOT NULL COMMENT '时间戳',
  `point` point NOT NULL COMMENT '经纬度',
  `type` char(20) character set utf8 NOT NULL COMMENT '点类型',
  `name` varchar(50) character set utf8 NOT NULL COMMENT '点名称',
  `introduce` text character set utf8 COMMENT '介绍，包含文字、视频、目录，json格式',
  `attention` int(5) NOT NULL default '0' COMMENT '关注人数',
  `score` tinyint(2) NOT NULL default '0' COMMENT '评分，用于协同过滤推荐',
  `status` tinyint(2) NOT NULL default '2' COMMENT '状态，用于管理员添加',
  `uri` varchar(255) character set utf8 default NULL COMMENT '维基uri',
  PRIMARY KEY  (`timestamp`,`point`(25))
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_dustbingis
-- ----------------------------
INSERT INTO `tb_dustbingis` VALUES ('1900', GeomFromText('POINT(123.384657 123.384657)'), '', '', '', '0', '0', '1', '');

-- ----------------------------
-- Table structure for tb_point
-- ----------------------------
DROP TABLE IF EXISTS `tb_point`;
CREATE TABLE `tb_point` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `timestamp` date NOT NULL COMMENT '时间戳',
  `point` point NOT NULL COMMENT '经纬度',
  `type` char(20) character set utf8 NOT NULL COMMENT '点类型',
  `name` varchar(50) character set utf8 NOT NULL COMMENT '点名称',
  `introduce` text character set utf8 COMMENT '介绍，包含文字、视频、目录，json格式',
  `uri` varchar(255) character set utf8 default NULL COMMENT '维基uri',
  `score` float(3,2) NOT NULL default '0.00' COMMENT '评分，用于协同过滤推荐',
  `status` tinyint(2) NOT NULL default '2' COMMENT '状态，用于管理员添加',
  PRIMARY KEY  (`id`,`timestamp`,`point`(25)),
  KEY `index_timestamp` USING BTREE (`timestamp`),
  FULLTEXT KEY `index_name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_point
-- ----------------------------
INSERT INTO `tb_point` VALUES ('1', '1900-01-01', GeomFromText('POINT(123.462202 41.804471)'), '景点', '沈阳故宫', '{\"text\":\"1900年左右的沈阳故宫文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '0.00', '1');
INSERT INTO `tb_point` VALUES ('2', '2015-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"清昭陵是清朝第二代开国君主太宗皇太极以及孝端文皇后博尔济吉特氏的陵墓，占地面积16万平方米，是清初“关外三陵”中规模最大、气势最宏伟的一座。位于（盛京）古城北约十...\",\"picture\":\"http://127.0.0.1/gisproject/Public/Images/home/beiling2014.jpg\",\"video\":\"video album\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('3', '2012-01-01', GeomFromText('POINT(123.401865 41.800438)'), '景点', '沈阳站', '{\"text\":\"2012年左右的沈阳站文字介绍\",\"picture\":\"http://127.0.0.1/gisproject/Public/Images/home/beiling2012.jpg\",\"video\":\"\"}', null, '5.00', '1');
INSERT INTO `tb_point` VALUES ('4', '2012-01-01', GeomFromText('POINT(123.443231 41.82398)'), '景点', '沈阳北站', '{\"text\":\"2012年左右的沈阳北站文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '3.33', '1');
INSERT INTO `tb_point` VALUES ('5', '1927-01-01', GeomFromText('POINT(123.421391 41.79414)'), '景点', '花旗银行', '{\"text\":\"1927年左右的花旗银行文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.50', '1');
INSERT INTO `tb_point` VALUES ('6', '2015-01-01', GeomFromText('POINT(123.421391 41.79414)'), '景点', '花旗银行', '{\"text\r\n\r\n\":\"2014年左右的花旗银行文字介绍\",\"picture\":\"\",\"video\":\r\n\"\"}', null, '4.50', '1');
INSERT INTO `tb_point` VALUES ('7', '1900-01-01', GeomFromText('POINT(123.401865 41.800438)'), '景点', '沈阳站', '{\"text\":\"1900年左右的沈阳站文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '5.00', '1');
INSERT INTO `tb_point` VALUES ('8', '1980-01-01', GeomFromText('POINT(123.462202 41.804471)'), '景点', '沈阳故宫', '{\"text\":\"1980年左右的沈阳故宫文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '0.00', '1');
INSERT INTO `tb_point` VALUES ('9', '2010-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵 ', '{\"text\":\"2012年左右的北陵文字介绍\",\"picture\":\"http://127.0.0.1/gisproject/Public/Images/home/beiling2012.jpg\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('10', '2000-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"2000年左右的北陵文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('11', '1980-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"1980年左右的北陵文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('12', '1950-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"1946年左右的北陵文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('13', '1940-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"1936年左右的北陵文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('14', '1930-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"1927年的北陵文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('15', '1900-01-01', GeomFromText('POINT(123.434063 41.858121)'), '景点', '北陵', '{\"text\":\"1900年左右的文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '4.67', '1');
INSERT INTO `tb_point` VALUES ('16', '2014-01-01', GeomFromText('POINT(123.443231 41.82398)'), '景点', '沈阳北站', '{\"text\":\"2014年的左右沈阳北站文字介绍\",\"picture\":\"\",\"video\":\"\"}', null, '3.33', '1');
INSERT INTO `tb_point` VALUES ('17', '2015-01-01', GeomFromText('POINT(123.418221 41.813901)'), '古遗址', '西塔', '{\"text\":\"西塔是沈阳城的代表性古建筑之一。。。。。\",\"picture\":\"\",\"video\":\"\"}', '', '3.33', '1');

-- ----------------------------
-- Table structure for tb_security
-- ----------------------------
DROP TABLE IF EXISTS `tb_security`;
CREATE TABLE `tb_security` (
  `id` int(11) NOT NULL auto_increment,
  `question` char(60) NOT NULL,
  `sort` tinyint(10) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_security
-- ----------------------------
INSERT INTO `tb_security` VALUES ('1', '我的母亲叫什么名字？', '0');
INSERT INTO `tb_security` VALUES ('2', '我的小学名称', '0');
INSERT INTO `tb_security` VALUES ('3', '我的父亲名字', '0');
INSERT INTO `tb_security` VALUES ('4', '我的中学名称', '0');
INSERT INTO `tb_security` VALUES ('5', '我暗恋的人', '0');
INSERT INTO `tb_security` VALUES ('6', '我最讨厌的人', '0');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `userid` int(11) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `userpassword` varchar(256) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `usertel` varchar(255) NOT NULL,
  `userquestion` varchar(255) default NULL,
  `useranswer` varchar(255) default NULL,
  `userage` int(11) default NULL,
  `userqq` varchar(255) default NULL,
  `userweibo` varchar(255) default NULL,
  `professional` varchar(255) default NULL,
  `introduce` text,
  `regtime` int(11) NOT NULL COMMENT '注册时间',
  `permission` int(10) NOT NULL COMMENT '权限',
  `userstatus` tinyint(4) NOT NULL default '1',
  `comment` text COMMENT '评论',
  `recommand` varchar(255) default NULL COMMENT '推荐的poi 的name',
  PRIMARY KEY  (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tb_user
-- ----------------------------
INSERT INTO `tb_user` VALUES ('1', 'people', '405958c9e0888f6ddc6221f90576490c', '1111111111@126.com', '1243', '1+1=?', '2', '0', null, null, null, null, '0', '0', '1', '{\"comment\":[{\"name\":\"北陵\",\"gscore\":\"4\",\"cscore\":\"4\",\"escore\":\"5\",\"sscore\":\"4\",\"pscore\":\"4\"},{\"name\":\"西塔\",\"gscore\":\"4\",\"cscore\":\"5\",\"escore\":\"4\",\"sscore\":\"5\",\"pscore\":\"3\"}]}', '\"沈阳站 沈阳北站 \"');
INSERT INTO `tb_user` VALUES ('2', '家霖', '405958c9e0888f6ddc6221f90576490c', '1040591511@qq.com', '', '我21岁？', 'yes', '0', null, null, null, null, '0', '0', '1', '{\"comment\":[{\"name\":\"沈阳北站\",\"gscore\":\"3\",\"cscore\":\"5\",\"escore\":\"3\",\"sscore\":\"4\",\"pscore\":\"5\"},{\"name\":\"沈阳站\",\"gscore\":\"5\",\"cscore\":\"3\",\"escore\":\"4\",\"sscore\":\"4\",\"pscore\":\"4\"},{\"name\":\"西塔\",\"gscore\":\"3\",\"cscore\":\"5\",\"escore\":\"4\",\"sscore\":\"4\",\"pscore\":\"3\"},{\"name\":\"花旗银行\",\"gscore\":\"5\",\"cscore\":\"3\",\"escore\":\"5\",\"sscore\":\"5\",\"pscore\":\"5\"}]}', '\"\"');
INSERT INTO `tb_user` VALUES ('3', 'leo', '405958c9e0888f6ddc6221f90576490c', '2634756377@qq.com', '', '我是外国人？', 'no', '0', null, null, null, null, '0', '0', '1', '{\"comment\":[{\"name\":\"花旗银行\",\"gscore\":\"4\",\"cscore\":\"4\",\"escore\":\"5\",\"sscore\":\"5\",\"pscore\":\"3\"},{\"name\":\"沈阳北站\",\"gscore\":\"3\",\"cscore\":\"4\",\"escore\":\"3\",\"sscore\":\"2\",\"pscore\":\"4\"},{\"name\":\"北陵\",\"gscore\":\"5\",\"cscore\":\"5\",\"escore\":\"4\",\"sscore\":\"4\",\"pscore\":\"5\"}]}', '\"北陵 沈阳北站 \"');
INSERT INTO `tb_user` VALUES ('4', 'a', '405958c9e0888f6ddc6221f90576490c', '1040591529@qq.com', '', 'a', 'a', '0', null, null, null, null, '0', '0', '1', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('30', '家霖李', '405958c9e0888f6ddc6221f90576490c', '1040591522@qq.com', '', '我的中学名称', '8089866903d137cce837219c1cf524fa', '21', '1040591522', 'http://aa.bb.cc.com', '学生', '哈工程本科生，大四，未婚，计算机，爱好城市历史，等等', '0', '0', '1', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('31', 'shopnc', '405958c9e0888f6ddc6221f90576490c', 'lijialing@hrbeu.edu.cn', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '0', '0', '1', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('33', 'shopncasd', '405958c9e0888f6ddc6221f90576490c', '1040591523@qq.com', '', '我暗恋的人', '86d51ce7753a36079041fc15f7248035', '33', '1040591522', 'http://', '教师', '某校教师', '0', '1', '1', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('34', '秦莞尔', '405958c9e0888f6ddc6221f90576490c', '1040591524@qq.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '0', '1', '1', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('35', '周星驰', '405958c9e0888f6ddc6221f90576490c', '1040591525@qq.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '44', '', 'http://', '', '', '0', '1', '1', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('74', 'ruby97', '405958c9e0888f6ddc6221f90576490c', '1040591521@qq.com', '18345153583', '我最讨厌的人', 'd41d8cd98f00b204e9800998ecf8427e', '21', '1040591521', 'http://', '学生', '我是哈尔滨工程大学的一名本科生，专业是计算机与技术。我学习成绩还可以，本科排名17。我的爱好是听音乐，电子游戏，读书，旅游。', '1416706953', '1', '1', '{\"comment\":[{\"name\":\"北陵\",\"gscore\":\"5\",\"cscore\":\"5\",\"escore\":\"5\",\"sscore\":\"5\",\"pscore\":\"5\"},{\"name\":\"沈阳北站\",\"gscore\":\"4\",\"cscore\":\"3\",\"escore\":\"4\",\"sscore\":\"2\",\"pscore\":\"3\"},{\"name\":\"西塔\",\"gscore\":\"3\",\"cscore\":\"4\",\"escore\":\"4\",\"sscore\":\"3\",\"pscore\":\"4\"},{\"name\":\"沈阳站\",\"gscore\":\"5\",\"cscore\":\"3\",\"escore\":\"3\",\"sscore\":\"3\",\"pscore\":\"2\"},{\"name\":\"undefined\",\"gscore\":\"3\",\"cscore\":\"3\",\"escore\":\"3\",\"sscore\":\"4\",\"pscore\":\"2\"}]}', '\"沈阳站 沈阳北站 \"');
INSERT INTO `tb_user` VALUES ('42', '李云飞', '405958c9e0888f6ddc6221f90576490c', '1060217504@qq.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '1416568798', '1', '3', '', '\"沈阳站 北陵 花旗银行\"');
INSERT INTO `tb_user` VALUES ('75', '李家霖', '405958c9e0888f6ddc6221f90576490c', '1040591511@qq.com', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '0', '', 'http://', '', '', '1428299427', '1', '3', null, null);

-- ----------------------------
-- Table structure for tb_verification
-- ----------------------------
DROP TABLE IF EXISTS `tb_verification`;
CREATE TABLE `tb_verification` (
  `id` int(11) NOT NULL auto_increment,
  `verification` char(32) default NULL COMMENT '生成的md5验证码',
  `add_time` int(11) default NULL COMMENT '生成时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_verification
-- ----------------------------
INSERT INTO `tb_verification` VALUES ('7', '37bfaf8bef2731353bc83d8800ea0826', '1416575073');
INSERT INTO `tb_verification` VALUES ('8', '7215573b584e6307de17a7507049d8c8', '1416575246');
INSERT INTO `tb_verification` VALUES ('9', '6386545ce7955f1818d87ac1e971b3f8', '1416625202');
INSERT INTO `tb_verification` VALUES ('10', '38b2f581003e3d27ef16007c4f8f21b4', '1416625432');
INSERT INTO `tb_verification` VALUES ('34', '1edb370ecc123d733779fea79ca04f86', '1428299430');

-- ----------------------------
-- Table structure for tb_xttj
-- ----------------------------
DROP TABLE IF EXISTS `tb_xttj`;
CREATE TABLE `tb_xttj` (
  `name` varchar(255) NOT NULL,
  `a` int(255) default NULL,
  `b` int(255) default NULL,
  `c` int(255) default NULL,
  `d` int(255) default NULL,
  `e` int(255) default NULL,
  `f` int(255) default NULL,
  `g` int(255) default NULL,
  `h` int(255) default NULL,
  PRIMARY KEY  (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tb_xttj
-- ----------------------------
INSERT INTO `tb_xttj` VALUES ('John', '4', '4', '5', '4', '3', '2', '1', null);
INSERT INTO `tb_xttj` VALUES ('Mary', '3', '4', '4', '2', '5', '4', '3', null);
INSERT INTO `tb_xttj` VALUES ('Lucy', '2', '3', null, '3', null, '3', '4', '5');
INSERT INTO `tb_xttj` VALUES ('Tom', '3', '4', '5', null, '1', '3', '5', '4');
INSERT INTO `tb_xttj` VALUES ('Bill', '3', '2', '1', '5', '3', '2', '1', '1');
INSERT INTO `tb_xttj` VALUES ('Leo', '3', '4', '5', '2', '4', null, null, null);
