/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : db_cntlis

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-07-16 18:21:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `action`
-- ----------------------------
DROP TABLE IF EXISTS `action`;
CREATE TABLE `action` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL COMMENT '售前管理， 售后管理'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统权限表';

-- ----------------------------
-- Records of action
-- ----------------------------

-- ----------------------------
-- Table structure for `actionrole`
-- ----------------------------
DROP TABLE IF EXISTS `actionrole`;
CREATE TABLE `actionrole` (
  `id` int(11) DEFAULT NULL,
  `roleId` int(11) DEFAULT NULL,
  `actionId` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='权限角色关系表';

-- ----------------------------
-- Records of actionrole
-- ----------------------------

-- ----------------------------
-- Table structure for `attackorderinfo`
-- ----------------------------
DROP TABLE IF EXISTS `attackorderinfo`;
CREATE TABLE `attackorderinfo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `SessionId` varchar(50) DEFAULT NULL,
  `ActionKey` varchar(50) DEFAULT NULL,
  `ProInfo` varchar(50) DEFAULT NULL,
  `OrderAmount` float(8,2) DEFAULT NULL,
  `UserName` varchar(20) DEFAULT NULL,
  `UserPhone` varchar(50) DEFAULT NULL,
  `UserAddress` varchar(50) DEFAULT NULL,
  `UserExt` varchar(200) DEFAULT NULL,
  `OrderType` varchar(50) DEFAULT NULL,
  `OrderKeywords` varchar(50) DEFAULT NULL,
  `OpenUrl` varchar(200) DEFAULT NULL,
  `OpenReferUrl` varchar(200) DEFAULT NULL,
  `HttpAllRow` text,
  `APIUrl` varchar(200) DEFAULT NULL,
  `ServerAddr` varchar(50) DEFAULT NULL,
  `UserAgent` varchar(200) DEFAULT NULL,
  `UserIP` varchar(200) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL COMMENT '待确认-需要电话确认\r\n            待发货-已经确认等待发货\r\n            延迟发货\r\n            取消订单',
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `IDX_AttackOrderInfo_Key` (`ActionKey`,`SessionId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='攻击订单表';

-- ----------------------------
-- Records of attackorderinfo
-- ----------------------------

-- ----------------------------
-- Table structure for `clientsessioninfo`
-- ----------------------------
DROP TABLE IF EXISTS `clientsessioninfo`;
CREATE TABLE `clientsessioninfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SessionId` varchar(50) DEFAULT NULL,
  `UserId` int(11) DEFAULT '0',
  `UserIP` varchar(100) DEFAULT NULL,
  `Key32` varchar(32) DEFAULT NULL,
  `Key64` varchar(64) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  `LastActiveTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_SessionInfo_SessionId` (`SessionId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='密钥表';

-- ----------------------------
-- Records of clientsessioninfo
-- ----------------------------

-- ----------------------------
-- Table structure for `config`
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sfid` varchar(255) DEFAULT NULL,
  `sfkey` varchar(255) DEFAULT NULL,
  `sfurl` varchar(255) DEFAULT NULL,
  `sfcustId` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', '00012694', '66F226D4D8D0E9F68AD6B1D8DC3DE036', 'https://open-prod.sf-express.com', '0217777383');

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `source` tinyint(50) DEFAULT NULL COMMENT '来源',
  `ip` varchar(50) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `qq` varchar(10) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `wx` varchar(30) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `state` tinyint(20) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL COMMENT '账号',
  `userid` int(11) DEFAULT NULL,
  `userkey` varchar(255) DEFAULT NULL,
  `sersession` varchar(255) DEFAULT NULL,
  `memo` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COMMENT='客户表';

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', '2323', '2', null, '男', '323', '2323', '2323', null, null, null, null, '32323', null, null, null, '232323');
INSERT INTO `customer` VALUES ('3', '12121', '1', null, '男', '121', '17717353366', '1212', null, null, null, null, '12121', null, null, null, '121');
INSERT INTO `customer` VALUES ('4', '的说法都是', '2', null, '男', 'dsfsd', 'sdfd', 'dsfds', null, null, null, '2', '12121ee', null, null, null, '的说法都是');

-- ----------------------------
-- Table structure for `customertrack`
-- ----------------------------
DROP TABLE IF EXISTS `customertrack`;
CREATE TABLE `customertrack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer` varchar(50) DEFAULT NULL,
  `staff` varchar(50) DEFAULT NULL,
  `content` varchar(2000) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `uid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of customertrack
-- ----------------------------
INSERT INTO `customertrack` VALUES ('1', '2323', 'admin', 'sedfsdfsd', '2016-07-26 22:16:17', '1');
INSERT INTO `customertrack` VALUES ('2', '2323', 'admin', 'sedfsdfsdfsdfdsfdsfds', '2016-07-26 22:16:22', '1');
INSERT INTO `customertrack` VALUES ('3', '2323', 'admin', 'sedfsdfsdfsdfdsfdsfdsdsfsdfsdfsdf', '2016-07-26 22:16:27', '1');
INSERT INTO `customertrack` VALUES ('4', '2323', 'admin', '添加剂士大夫但是你大师傅', '2016-07-26 22:16:36', '1');
INSERT INTO `customertrack` VALUES ('5', '2323', 'admin', '大师傅士大夫大师傅大师傅', '2016-07-26 22:16:50', '1');
INSERT INTO `customertrack` VALUES ('6', '2323', 'admin', '大师傅士大夫大师傅大师傅', '2016-07-26 22:16:54', '1');
INSERT INTO `customertrack` VALUES ('7', '2323', 'admin', '大师傅士大夫大师傅大师傅', '2016-07-26 22:16:58', '1');
INSERT INTO `customertrack` VALUES ('8', '2323', 'admin', '大师傅士大夫大师傅大师傅', '2016-07-26 22:17:03', '1');
INSERT INTO `customertrack` VALUES ('9', '2323', 'admin', '大师傅士大夫大师傅大师傅', '2016-07-26 22:17:05', '1');
INSERT INTO `customertrack` VALUES ('10', '2323', 'admin', '大师傅士大夫大师傅大师傅', '2016-07-26 22:17:07', '1');
INSERT INTO `customertrack` VALUES ('11', '2323', 'admin', '大师傅士', '2016-07-26 22:17:10', '1');
INSERT INTO `customertrack` VALUES ('12', '2323', 'admin', '大师', '2016-07-26 22:17:14', '1');
INSERT INTO `customertrack` VALUES ('13', '2323', 'admin', '21211士大夫大师傅', '2016-07-26 22:17:32', '1');
INSERT INTO `customertrack` VALUES ('14', '2323', 'admin', '21211士大夫大师傅大师傅士大夫', '2016-07-26 22:17:36', '1');
INSERT INTO `customertrack` VALUES ('15', '的说法都是', 'admin', 'sdfsdfsd', '2016-07-26 22:26:22', '4');
INSERT INTO `customertrack` VALUES ('16', '的说法都是', 'admin', 'erewewrewrewr', '2016-07-26 22:26:28', '4');
INSERT INTO `customertrack` VALUES ('17', '的说法都是', 'admin', 'fsdfsdfds', '2016-07-26 22:26:33', '4');
INSERT INTO `customertrack` VALUES ('18', '的说法都是', 'admin', '121212', '2016-07-30 17:25:57', '4');
INSERT INTO `customertrack` VALUES ('19', '的说法都是', 'admin', '1212123232', '2016-07-30 17:26:00', '4');
INSERT INTO `customertrack` VALUES ('20', '2323', 'admin', 'dfsfdsf', '2016-10-31 21:24:06', '1');
INSERT INTO `customertrack` VALUES ('21', '2323', 'admin', 'dfsfdsfdsfdsfd', '2016-10-31 21:24:10', '1');
INSERT INTO `customertrack` VALUES ('22', '2323', 'admin', 'dfsfdsfdsfdsfd', '2016-10-31 21:24:12', '1');
INSERT INTO `customertrack` VALUES ('23', '2323', 'admin', 'dfsfdsfdsfdsfd', '2016-10-31 21:24:13', '1');
INSERT INTO `customertrack` VALUES ('24', '2323', 'admin', 'sdfdsfdsf', '2016-10-31 21:24:22', '1');

-- ----------------------------
-- Table structure for `good`
-- ----------------------------
DROP TABLE IF EXISTS `good`;
CREATE TABLE `good` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) DEFAULT NULL COMMENT '商品名称',
  `type` varchar(255) DEFAULT NULL COMMENT '商品类别',
  `price` decimal(10,0) DEFAULT NULL COMMENT '商品价格',
  `count` int(11) DEFAULT NULL COMMENT '商品库存',
  `memo` varchar(5000) DEFAULT NULL,
  `img` varchar(1000) DEFAULT NULL COMMENT '商品图片',
  `json` varchar(100) DEFAULT NULL COMMENT '商品属性',
  `postPrice` decimal(10,0) DEFAULT '0',
  `face` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='商品信息表';

-- ----------------------------
-- Records of good
-- ----------------------------
INSERT INTO `good` VALUES ('2', '乐梵丝补水保湿面膜', '保健品', '136', '100', 'XXL,SL,S', '/i/uploads/20160329205246_105.png', null, '10', null);
INSERT INTO `good` VALUES ('3', '乐梵丝焕亮补水保湿面膜', '保健品', '1', '6000', 'XXL,SL,S', '/i/uploads/20160330172431_540.jpg', null, '0', null);

-- ----------------------------
-- Table structure for `log`
-- ----------------------------
DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_title` varchar(500) DEFAULT NULL,
  `log_ip` varchar(100) DEFAULT NULL,
  `log_name` varchar(10) DEFAULT NULL,
  `log_date` datetime DEFAULT NULL,
  `log_type` tinyint(4) DEFAULT '0' COMMENT '0、表示前台日志，1、表示后台日志',
  `log_memo` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of log
-- ----------------------------
INSERT INTO `log` VALUES ('1', '【现金币】会员毛海 给 毛海转款', '113.122.235.94', '6', '2016-07-01 19:11:22', '3', null);
INSERT INTO `log` VALUES ('2', '【现金币】会员毛海 给 毛海转款奖金转帐', '113.122.235.94', '6', '2016-07-01 23:26:17', '3', null);
INSERT INTO `log` VALUES ('3', '【现金币】会员毛海 给 毛海转款测试', '113.122.235.94', '7', '2016-07-01 23:47:19', '3', null);
INSERT INTO `log` VALUES ('4', '【现金币】会员王琼 给 毛海2转款推荐蒋生铭与刘炳达的市场奖金', '113.122.237.214', '8', '2016-07-16 23:46:33', '3', null);
INSERT INTO `log` VALUES ('5', '删除客户_2\"', '127.0.0.1', '1', '2016-07-26 22:48:10', '0', '{\"id\":\"2\\\"\",\"a\":\"delete\",\"c\":\"user\",\"m\":\"admin\"}');
INSERT INTO `log` VALUES ('6', '3', '127.0.0.1', '1', '2016-07-26 22:50:15', '0', '{\"id\":\"3\",\"name\":\"12121\",\"account\":\"12121\",\"sex\":\"\\u7537\",\"source\":\"1\",\"qq\":\"121\",\"mobile\":\"17717353366\",\"wx\":\"1212\",\"memo\":\"121\",\"a\":\"modify\",\"c\":\"user\",\"m\":\"admin\"}');
INSERT INTO `log` VALUES ('7', '4', '127.0.0.1', '0', '2016-07-26 23:34:51', '0', '{\"id\":\"4\",\"name\":\"\\u7684\\u8bf4\\u6cd5\\u90fd\\u662f\",\"account\":\"12121ee\",\"sex\":\"\\u7537\",\"source\":\"2\",\"qq\":\"dsfsd\",\"mobile\":\"sdfd\",\"wx\":\"dsfds\",\"memo\":\"\\u7684\\u8bf4\\u6cd5\\u90fd\\u662f\",\"a\":\"modify\",\"c\":\"user\",\"m\":\"admin\"}');
INSERT INTO `log` VALUES ('8', '4', '127.0.0.1', 'admin', '2016-07-26 23:37:13', '0', '{\"id\":\"4\",\"name\":\"\\u7684\\u8bf4\\u6cd5\\u90fd\\u662f\",\"account\":\"12121ee\",\"sex\":\"\\u7537\",\"source\":\"2\",\"qq\":\"dsfsd\",\"mobile\":\"sdfd\",\"wx\":\"dsfds\",\"memo\":\"\\u7684\\u8bf4\\u6cd5\\u90fd\\u662f\",\"a\":\"modify\",\"c\":\"user\",\"m\":\"admin\"}');
INSERT INTO `log` VALUES ('9', '3', '127.0.0.1', 'admin', '2016-07-27 00:11:25', '0', '/admin/user_modify.html');
INSERT INTO `log` VALUES ('10', '3', '127.0.0.1', 'admin', '2016-07-27 00:13:25', '0', 'Array');
INSERT INTO `log` VALUES ('11', '3', '127.0.0.1', 'admin', '2016-07-27 00:14:24', '0', 'a:13:{s:4:\"Host\";s:11:\"www.crm.com\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"95\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:6:\"Accept\";s:74:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\";s:6:\"Origin\";s:18:\"http://www.crm.com\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:110:\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:7:\"Referer\";s:46:\"http://www.crm.com/admin/user_modify.html?id=3\";s:15:\"Accept-Encoding\";s:13:\"gzip, deflate\";s:15:\"Accept-Language\";s:14:\"zh-CN,zh;q=0.8\";s:6:\"Cookie\";s:36:\"PHPSESSID=fc52lf6il9bnu3jpl0abn3sml6\";}');
INSERT INTO `log` VALUES ('12', '3', '127.0.0.1', 'admin', '2016-07-27 00:19:50', '0', 'a:13:{s:4:\"Host\";s:11:\"www.crm.com\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"95\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:6:\"Accept\";s:74:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\";s:6:\"Origin\";s:18:\"http://www.crm.com\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:110:\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:7:\"Referer\";s:46:\"http://www.crm.com/admin/user_modify.html?id=3\";s:15:\"Accept-Encoding\";s:13:\"gzip, deflate\";s:15:\"Accept-Language\";s:14:\"zh-CN,zh;q=0.8\";s:6:\"Cookie\";s:36:\"PHPSESSID=fc52lf6il9bnu3jpl0abn3sml6\";}');
INSERT INTO `log` VALUES ('13', '修改客户_3', '127.0.0.1', 'admin', '2016-07-27 00:20:25', '0', 'a:13:{s:4:\"Host\";s:11:\"www.crm.com\";s:10:\"Connection\";s:10:\"keep-alive\";s:14:\"Content-Length\";s:2:\"95\";s:13:\"Cache-Control\";s:9:\"max-age=0\";s:6:\"Accept\";s:74:\"text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\";s:6:\"Origin\";s:18:\"http://www.crm.com\";s:25:\"Upgrade-Insecure-Requests\";s:1:\"1\";s:10:\"User-Agent\";s:110:\"Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\";s:12:\"Content-Type\";s:33:\"application/x-www-form-urlencoded\";s:7:\"Referer\";s:46:\"http://www.crm.com/admin/user_modify.html?id=3\";s:15:\"Accept-Encoding\";s:13:\"gzip, deflate\";s:15:\"Accept-Language\";s:14:\"zh-CN,zh;q=0.8\";s:6:\"Cookie\";s:36:\"PHPSESSID=fc52lf6il9bnu3jpl0abn3sml6\";}');
INSERT INTO `log` VALUES ('14', '用户admin登录', '127.0.0.1', 'admin', '2016-07-27 00:58:47', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"8dc62814f4c946db5e0c3d950246130b\";s:8:\"codeName\";s:8:\"3994rao4\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('15', '用户admin登录', '127.0.0.1', 'admin', '2016-07-27 00:58:51', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"0279f4333146b9f9db29b2aafecd4d6c\";s:8:\"codeName\";s:8:\"dqznbvi7\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('16', '用户admin登录', '127.0.0.1', 'admin', '2016-07-27 21:50:37', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"a3e8ba75257230ff4fe36fbd80b9038f\";s:8:\"codeName\";s:8:\"rjt8bsgy\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('17', '用户admin登录', '127.0.0.1', 'admin', '2016-07-28 21:18:52', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"429f5969f8fce92ba718ae0d41f5c7bd\";s:8:\"codeName\";s:8:\"zyk34ou4\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('18', '登出', '127.0.0.1', 'admin', '2016-07-28 22:41:28', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('19', '用户admin登录', '127.0.0.1', 'admin', '2016-07-28 22:41:42', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"b1540c12a85e6ee8c14f32b1b2ba5217\";s:8:\"codeName\";s:8:\"jkoxk8wo\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('20', '登出', '127.0.0.1', 'admin', '2016-07-28 22:42:13', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('21', '用户admin登录', '127.0.0.1', 'admin', '2016-07-28 22:50:22', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"8df216f122b9422342cbcb1306a11094\";s:8:\"codeName\";s:8:\"2u5kkvta\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('22', '登出', '127.0.0.1', 'admin', '2016-07-28 22:52:01', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('23', '用户admin登录', '127.0.0.1', 'admin', '2016-07-30 14:46:54', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"26c4d063e7613599cee42342281cd32b\";s:8:\"codeName\";s:8:\"0pmbezzp\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('24', '用户admin登录', '127.0.0.1', 'admin', '2016-07-30 23:11:13', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"ae1871e2e329ba00e80bb59b5e90c2a3\";s:8:\"codeName\";s:8:\"e0thgvlh\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('25', '用户admin登录', '127.0.0.1', 'admin', '2016-07-30 23:11:17', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"b7b08f35b4cb18ab9754c1609896551e\";s:8:\"codeName\";s:8:\"ulobop6h\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('26', '用户admin登录', '127.0.0.1', 'admin', '2016-07-31 01:05:40', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"afd04f1a2d27f908b0d49b82a1564711\";s:8:\"codeName\";s:8:\"i0qyc332\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('27', '用户admin登录', '127.0.0.1', 'admin', '2016-07-31 18:54:58', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"5eb8b00b8649692cdae9b135f253d2aa\";s:8:\"codeName\";s:8:\"jrphj00h\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('28', '登出', '127.0.0.1', 'admin', '2016-07-31 23:43:11', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('29', '用户admin登录', '127.0.0.1', 'admin', '2016-08-01 20:33:31', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"a42ab25d34e61191402b3ab7445a46b1\";s:8:\"codeName\";s:8:\"ujrsnrwp\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('30', '登出', '127.0.0.1', 'admin', '2016-08-01 22:15:57', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('31', '用户admin登录', '127.0.0.1', 'admin', '2016-08-01 22:16:04', '0', 'a:6:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:32:\"756040022da2e77024bd30a70d342a86\";s:8:\"codeName\";s:8:\"rfoqv0d5\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('32', '用户admin登录', '127.0.0.1', 'admin', '2016-08-01 22:19:21', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"10df18d00765ed9bdcdb4c08f9d69b3b\";s:8:\"codeName\";s:8:\"5lhbwm2v\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('33', '登出', '127.0.0.1', 'admin', '2016-08-01 22:19:24', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('34', '用户admin登录', '127.0.0.1', 'admin', '2016-08-01 22:19:29', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"c74fb8b48b52d1e1ef18e77d13f5985c\";s:8:\"codeName\";s:8:\"sdxwzn0x\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('35', '登出', '127.0.0.1', 'admin', '2016-08-01 22:19:49', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('36', '用户admin登录', '127.0.0.1', 'admin', '2016-08-01 22:20:45', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"89b14a8f383215053a413837c24922eb\";s:8:\"codeName\";s:8:\"8uu4rsc0\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('37', '登出', '127.0.0.1', 'admin', '2016-08-01 22:20:56', '0', 'a:3:{s:1:\"a\";s:6:\"logout\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('38', '用户admin登录', '127.0.0.1', 'admin', '2016-08-03 20:58:42', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"b92387806884ec7d82a510a5e06f593e\";s:8:\"codeName\";s:8:\"o1tog1ec\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('39', '用户admin登录', '127.0.0.1', 'admin', '2016-08-04 20:44:41', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"c79f0618ec12de0fe9327ac8ead53942\";s:8:\"codeName\";s:8:\"96a3xk4x\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('40', '用户admin登录', '127.0.0.1', 'admin', '2016-10-31 21:11:04', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"d738d389ba66b82fcbcf654dea8cac05\";s:8:\"codeName\";s:8:\"zcods18v\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('41', '修改客户_4', '127.0.0.1', 'admin', '2016-10-31 21:12:38', '0', 'a:12:{s:2:\"id\";s:1:\"4\";s:4:\"name\";s:15:\"的说法都是\";s:7:\"account\";s:7:\"12121ee\";s:3:\"sex\";s:3:\"男\";s:6:\"source\";s:1:\"2\";s:2:\"qq\";s:5:\"dsfsd\";s:6:\"mobile\";s:4:\"sdfd\";s:2:\"wx\";s:5:\"dsfds\";s:4:\"memo\";s:15:\"的说法都是\";s:1:\"a\";s:6:\"modify\";s:1:\"c\";s:4:\"user\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('42', '修改客户_4', '127.0.0.1', 'admin', '2016-10-31 21:12:41', '0', 'a:12:{s:2:\"id\";s:1:\"4\";s:4:\"name\";s:15:\"的说法都是\";s:7:\"account\";s:7:\"12121ee\";s:3:\"sex\";s:3:\"男\";s:6:\"source\";s:1:\"2\";s:2:\"qq\";s:5:\"dsfsd\";s:6:\"mobile\";s:4:\"sdfd\";s:2:\"wx\";s:5:\"dsfds\";s:4:\"memo\";s:15:\"的说法都是\";s:1:\"a\";s:6:\"modify\";s:1:\"c\";s:4:\"user\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('43', '用户admin登录', '127.0.0.1', 'admin', '2016-12-21 22:21:03', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"ecd47f9ec540f84702c2c7ca244f8621\";s:8:\"codeName\";s:8:\"0hmrxbed\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');
INSERT INTO `log` VALUES ('44', '用户admin登录', '127.0.0.1', 'admin', '2016-12-28 22:24:51', '0', 'a:7:{s:8:\"username\";s:5:\"admin\";s:8:\"password\";s:6:\"123456\";s:9:\"passwords\";s:32:\"7f0aae0f3acbd3920e6463e9f18579ef\";s:8:\"codeName\";s:8:\"t6tkiqpt\";s:1:\"a\";s:5:\"login\";s:1:\"c\";s:4:\"main\";s:1:\"m\";s:5:\"admin\";}');

-- ----------------------------
-- Table structure for `orderinfo`
-- ----------------------------
DROP TABLE IF EXISTS `orderinfo`;
CREATE TABLE `orderinfo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) DEFAULT NULL,
  `SessionId` varchar(50) DEFAULT NULL,
  `ActionKey` varchar(50) DEFAULT NULL,
  `ProInfo` varchar(50) DEFAULT NULL,
  `OrderAmount` float(8,2) DEFAULT NULL,
  `UserName` varchar(20) DEFAULT NULL,
  `UserPhone` varchar(50) DEFAULT NULL,
  `UserAddress` varchar(50) DEFAULT NULL,
  `UserExt` varchar(200) DEFAULT NULL,
  `OrderType` varchar(50) DEFAULT NULL,
  `OrderKeywords` varchar(50) DEFAULT NULL,
  `OpenUrl` varchar(200) DEFAULT NULL,
  `OpenReferUrl` varchar(200) DEFAULT NULL,
  `HttpAllRow` text,
  `APIUrl` varchar(200) DEFAULT NULL,
  `ServerAddr` varchar(50) DEFAULT NULL,
  `UserAgent` varchar(200) DEFAULT NULL,
  `UserIP` varchar(200) DEFAULT NULL,
  `Status` varchar(50) DEFAULT NULL COMMENT '待确认-需要电话确认\r\n            待发货-已经确认等待发货\r\n            延迟发货\r\n            取消订单',
  `CreateDate` datetime DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  `customerAccount` varchar(255) DEFAULT NULL,
  `goodName` varchar(200) DEFAULT NULL COMMENT '商品名字',
  `goodPrice` decimal(10,0) DEFAULT NULL COMMENT '单价',
  `goodNum` int(255) DEFAULT NULL COMMENT '数据量',
  `goodMemo` varchar(800) DEFAULT NULL COMMENT '备注',
  `creater` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `IDX_OrderInfo_Key` (`SessionId`,`ActionKey`),
  KEY `11` (`UserId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='订单明细表';

-- ----------------------------
-- Records of orderinfo
-- ----------------------------
INSERT INTO `orderinfo` VALUES ('1', '23', '2', '2', '1', '232.00', '231', '213', '232', '23', '23', '23', '22', '22', '2', '22', '2', null, '1', '1', '2016-07-27 22:54:16', '1', '122', '2121', '1', '1', '1', '2', '1');
INSERT INTO `orderinfo` VALUES ('2', '1', null, null, null, '300.00', null, '12121', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:40:56', '0', '12121ee', '男士内裤', '300', '1', '12121223333', 'admin', null);
INSERT INTO `orderinfo` VALUES ('3', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:34:13', '0', '12121ee', '男士内裤', '300', '1', '士大夫大师傅', 'admin', null);
INSERT INTO `orderinfo` VALUES ('4', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '5', '2016-07-28 22:34:38', '0', '12121ee', '男士内裤', '300', '1', '大师傅大师傅', 'admin', null);
INSERT INTO `orderinfo` VALUES ('5', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:35:32', '0', '12121ee', '男士内裤', '300', '1', '的说法都是', 'admin', null);
INSERT INTO `orderinfo` VALUES ('6', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:36:33', '4', '12121ee', '男士内裤', '300', '1', '士大夫但是', 'admin', null);
INSERT INTO `orderinfo` VALUES ('7', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:36:52', '4', '12121ee', '男士内裤', '300', '1', '23232', 'admin', null);
INSERT INTO `orderinfo` VALUES ('8', '1', null, null, null, '300.00', null, '18317033205', null, null, null, null, null, null, null, null, null, null, null, '3', '2016-07-28 22:37:21', '4', '12121ee', '男士内裤', '300', '1', '1212', 'admin', null);
INSERT INTO `orderinfo` VALUES ('9', '1', null, null, null, '300.00', null, '18817710855', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:37:40', '0', '12121ee', '男士内裤', '300', '1', '', 'admin', null);
INSERT INTO `orderinfo` VALUES ('10', '1', null, null, null, '300.00', null, '18817710855', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:37:47', '0', '12121ee', '男士内裤', '300', '1', '色drew', 'admin', null);
INSERT INTO `orderinfo` VALUES ('11', '1', null, null, null, '300.00', null, '18317033205', null, null, null, null, null, null, null, null, null, null, null, '2', '2016-07-28 22:37:56', '0', '12121ee', '男士内裤', '300', '1', '232323', 'admin', null);
INSERT INTO `orderinfo` VALUES ('12', '1', null, null, null, '300.00', null, '12121222', null, null, null, null, null, null, null, null, null, null, null, '1', '2016-07-28 22:40:45', '0', '12121ee', '男士内裤', '300', '1', '鄂我热我热', 'admin', null);
INSERT INTO `orderinfo` VALUES ('13', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '1', null, '4', '12121ee', '男士内裤', '300', '1', '大师傅士大夫士大夫士大夫', 'admin', null);
INSERT INTO `orderinfo` VALUES ('14', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '4', null, '4', '12121ee', '男士内裤', '300', '1', '发士大夫士大夫', 'admin', null);
INSERT INTO `orderinfo` VALUES ('15', '1', null, null, null, '300.00', null, 'sdfd2132', null, null, null, null, null, null, null, null, null, null, null, '9', null, '4', '12121ee', '男士内裤', '300', '1', '3232', 'admin', null);
INSERT INTO `orderinfo` VALUES ('16', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, '', null, null, null, null, null, null, null, '5', '2016-10-31 21:28:12', '4', '12121ee', null, '300', '1', '发士大夫适当的放松的', 'admin', null);
INSERT INTO `orderinfo` VALUES ('17', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '1', null, '4', '12121ee', '男士内裤', '300', '1', '发士大夫适当的放松的', 'admin', null);
INSERT INTO `orderinfo` VALUES ('18', '1', null, null, null, '300.00', null, 'sdfd', null, null, null, null, null, null, null, null, null, null, null, '9', '2016-07-30 21:24:16', '4', '12121ee', '男士内裤', '300', '1', '121212', 'admin', null);
INSERT INTO `orderinfo` VALUES ('19', '1', null, null, null, '1.00', null, 'sdfd', null, null, null, 'XXL*1', null, null, null, null, null, null, null, '9', '2016-08-01 21:04:27', '4', '12121ee', '乐梵丝焕亮补水保湿面膜', '1', '1', '12121121', 'admin', null);
INSERT INTO `orderinfo` VALUES ('20', '1', null, null, null, '1.00', null, '18317033203', null, null, null, 'XXL*1', null, null, null, null, null, null, null, '5', '2016-08-04 00:42:43', '4', '12121ee', '乐梵丝焕亮补水保湿面膜', '1', '1', '12121212', 'admin', null);

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL COMMENT '快递公司名称',
  `code` varchar(255) NOT NULL COMMENT '快递公司代号',
  `user` varchar(255) DEFAULT NULL COMMENT '收货人',
  `no` varchar(255) DEFAULT NULL COMMENT '快递单号',
  `address` varchar(500) NOT NULL COMMENT '发货地',
  `info` varchar(200) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `transMessageId` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='订单快递信息';

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES ('1', '顺丰', '', '康静宇', null, '大师傅似的', null, 'sdfd', '14', '四川', '成都', '锦江区', '1', '201607301713548325600000');
INSERT INTO `post` VALUES ('2', '顺丰', '', '232', '1212121212', '3232', null, 'sdfd2132', '15', '天津', '河西区', null, '1', '201607301726158164200000');
INSERT INTO `post` VALUES ('3', '顺丰', '', '康静宇', '12121', '山塘沽海的发发', null, 'sdfd', '16', '河北', '石家庄', '长安区', '1', '201607302122236626800000');
INSERT INTO `post` VALUES ('4', '顺丰', '', '康静宇', null, '山塘沽海的发发', null, 'sdfd', '17', '山西', '太原', '小店区', '1', '201607302123022567300000');
INSERT INTO `post` VALUES ('5', '顺丰', '', '康静宇', '1212131212121', '12121', null, 'sdfd', '18', '山西', '太原', '小店区', '1', '201607302124168682800000');
INSERT INTO `post` VALUES ('6', '顺丰', '', '1222', null, '12121', null, 'sdfd', '19', '北京', null, null, '1', '201608012104273108200000');
INSERT INTO `post` VALUES ('7', '顺丰', '', '康静宇', '606495025138', '大师傅大师傅', null, '18317033205', '20', '河北', '秦皇岛', '山海关区', '1', '201608032157095268800000');

-- ----------------------------
-- Table structure for `queue`
-- ----------------------------
DROP TABLE IF EXISTS `queue`;
CREATE TABLE `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `retionName` varchar(255) DEFAULT NULL,
  `retionId` int(11) DEFAULT NULL,
  `state` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of queue
-- ----------------------------
INSERT INTO `queue` VALUES ('1', 'orderinfo', '18', '0', null);
INSERT INTO `queue` VALUES ('2', 'orderinfo', '4', '0', '2016-08-01 21:28:15');

-- ----------------------------
-- Table structure for `role`
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '售前');
INSERT INTO `role` VALUES ('2', '售后');

-- ----------------------------
-- Table structure for `staff`
-- ----------------------------
DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `passwords` varchar(50) DEFAULT NULL,
  `roleId` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `lastLoginTime` datetime DEFAULT NULL,
  `lastLoginIP` varchar(255) DEFAULT NULL,
  `memo` varchar(800) DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `qq` varchar(10) DEFAULT NULL,
  `wx` varchar(50) DEFAULT NULL,
  `state` tinyint(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='员工表';

-- ----------------------------
-- Records of staff
-- ----------------------------
INSERT INTO `staff` VALUES ('1', '管理员', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', '1', '2016-06-19 17:20:22', '2016-06-19 17:20:26', '2016-06-19 17:20:29', '1', '22', '111', '11', '11', '1');

-- ----------------------------
-- Table structure for `token`
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) DEFAULT NULL,
  `refresh` varchar(255) DEFAULT NULL,
  `tokenDate` datetime DEFAULT NULL,
  `refreshDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', '7210D9D60026186401BCCC901563142E', '569CB3856074A1E84355ACF079D2364A', '2016-08-03 23:51:54', '2016-08-03 23:51:54');

-- ----------------------------
-- Table structure for `userclientlog`
-- ----------------------------
DROP TABLE IF EXISTS `userclientlog`;
CREATE TABLE `userclientlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SessionId` varchar(50) DEFAULT NULL,
  `UserId` int(11) DEFAULT '0',
  `ActionKey` varchar(50) DEFAULT NULL,
  `IsAttack` tinyint(1) DEFAULT '0',
  `Title` varchar(50) DEFAULT NULL,
  `Details` longblob,
  `KeyWords` varchar(50) DEFAULT NULL,
  `HttpAllRow` longblob,
  `OpenUrl` varchar(200) DEFAULT NULL,
  `OpenReferUrl` varchar(2000) DEFAULT NULL,
  `APIUrl` varchar(200) DEFAULT NULL,
  `ServerAddr` varchar(100) DEFAULT NULL,
  `UserAgent` varchar(200) DEFAULT NULL,
  `UserIP` varchar(100) DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_ClientLog_Key` (`SessionId`,`ActionKey`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='客户行为日志表';

-- ----------------------------
-- Records of userclientlog
-- ----------------------------

-- ----------------------------
-- View structure for `vieworder`
-- ----------------------------
DROP VIEW IF EXISTS `vieworder`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vieworder` AS select `orderinfo`.`Id` AS `Id`,`orderinfo`.`goodName` AS `goodName`,`orderinfo`.`customerAccount` AS `customerAccount`,`orderinfo`.`UserId` AS `UserId`,`orderinfo`.`ActionKey` AS `ActionKey`,`orderinfo`.`SessionId` AS `SessionId`,`orderinfo`.`ProInfo` AS `ProInfo`,`post`.`name` AS `name`,`post`.`code` AS `code`,`post`.`user` AS `user`,`post`.`no` AS `no`,`post`.`address` AS `address`,`post`.`info` AS `info`,`post`.`mobile` AS `mobile`,`post`.`orderId` AS `orderId`,`orderinfo`.`OrderAmount` AS `OrderAmount`,`orderinfo`.`UserName` AS `UserName`,`orderinfo`.`UserPhone` AS `UserPhone`,`orderinfo`.`UserAddress` AS `UserAddress`,`orderinfo`.`UserExt` AS `UserExt`,`orderinfo`.`OrderType` AS `OrderType`,`orderinfo`.`OrderKeywords` AS `OrderKeywords`,`orderinfo`.`OpenUrl` AS `OpenUrl`,`orderinfo`.`OpenReferUrl` AS `OpenReferUrl`,`orderinfo`.`HttpAllRow` AS `HttpAllRow`,`orderinfo`.`APIUrl` AS `APIUrl`,`orderinfo`.`ServerAddr` AS `ServerAddr`,`orderinfo`.`UserAgent` AS `UserAgent`,`orderinfo`.`UserIP` AS `UserIP`,`orderinfo`.`Status` AS `Status`,`orderinfo`.`CreateDate` AS `CreateDate`,`orderinfo`.`customerId` AS `customerId`,`orderinfo`.`goodPrice` AS `goodPrice`,`orderinfo`.`goodNum` AS `goodNum`,`orderinfo`.`goodMemo` AS `goodMemo`,`orderinfo`.`creater` AS `creater`,`orderinfo`.`service` AS `service`,`post`.`province` AS `province`,`post`.`city` AS `city`,`post`.`county` AS `county`,`post`.`weight` AS `weight`,`post`.`transMessageId` AS `transMessageId` from (`orderinfo` join `post`) where (`orderinfo`.`Id` = `post`.`orderId`) ;
