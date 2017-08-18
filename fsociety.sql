/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50715
Source Host           : localhost:3306
Source Database       : fsociety

Target Server Type    : MYSQL
Target Server Version : 50715
File Encoding         : 65001

Date: 2017-05-03 18:37:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for a_articel
-- ----------------------------
DROP TABLE IF EXISTS `a_articel`;
CREATE TABLE `a_articel` (
  `articelid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `content` mediumtext COMMENT '正文',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `commentnumber` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `praisenumber` int(11) NOT NULL DEFAULT '0' COMMENT '赞数量',
  `knocknumber` int(11) NOT NULL DEFAULT '0' COMMENT '踩数量',
  `collectnumber` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `sharenumber` int(11) NOT NULL DEFAULT '0' COMMENT '分享数量',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  PRIMARY KEY (`articelid`),
  KEY `keytitle` (`title`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE,
  KEY `keyupdatetime` (`updatetime`) USING BTREE,
  KEY `keyhot` (`hot`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_articel
-- ----------------------------
INSERT INTO `a_articel` VALUES ('65', 'title', '<ul>\n<li>asdasdasd</li>\n<li>sdafsdfg</li>\n</ul>\n\n<h1>* asdfasdasd</h1>\n\n<p><strong>asdasdasdas</strong>\n1. dfszfsdfgsdfg\n2. asdasdasd<em>asdqr23trf</em></p>\n', '1', '3', '1', '2345', '235', '44', '3', '2017-03-27 14:54:24', '2017-04-14 16:07:13', '6');
INSERT INTO `a_articel` VALUES ('66', 'title1', '<ol>\n<li>asdasd</li>\n<li><em>asdasf</em></li>\n</ol>\n\n<h1>3. asdasdasd</h1>\n\n<ul>\n<li>hjkhjk</li>\n<li>fghfgjk</li>\n</ul>\n\n<h1>* rtdhdh</h1>\n\n<ol>\n<li>fghfgh</li>\n</ol>\n\n<p>* 2. dfgsdfg\n* dfghdfh\n* dfgsfhyreuq5tg<em>sdgsdfgh\n* dsgtsghsh</em></p>\n', '0', '2', '2', '234', '34', '4', '35', '2017-03-28 15:16:40', '2017-04-14 16:07:10', '6');
INSERT INTO `a_articel` VALUES ('67', '标题', '<p><strong>asdasdasd</strong></p>\n\n<h1>asfasg</h1>\n\n<p><a href=\"https://www。baidu.com\">百度</a></p>\n\n<p><img src=\"http://oj6n9nf7i.bkt.clouddn.com/4f577d94869a0d64-large\" alt=\"杀生丸\" />\nasdasdasd</p>\n', '1', '1', '3', '34', '4', '444', '0', '2017-03-27 17:33:04', '2017-04-14 16:07:08', '6');

-- ----------------------------
-- Table structure for a_head
-- ----------------------------
DROP TABLE IF EXISTS `a_head`;
CREATE TABLE `a_head` (
  `headid` int(11) NOT NULL AUTO_INCREMENT COMMENT '头像id',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `link` char(255) NOT NULL COMMENT '头像的link',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '头像大小（1：原尺寸， 2：500*500   3：200*200）',
  `hash` char(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0：失效',
  PRIMARY KEY (`headid`),
  KEY `keystatus` (`status`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='默认头像表';

-- ----------------------------
-- Records of a_head
-- ----------------------------
INSERT INTO `a_head` VALUES ('1', '2017-04-13 17:36:24', '2017-04-13 17:36:24', 'http://oj6n9nf7i.bkt.clouddn.com/e069b15fa47e04fe-small', '3', 'FiGlTRA-gQHUwwsKNBVNE2dCfGAx', '1');
INSERT INTO `a_head` VALUES ('2', '2017-04-13 17:36:57', '2017-04-13 17:40:32', 'http://oj6n9nf7i.bkt.clouddn.com/d2df72cb1f5f22ff-small', '3', 'FizTaGcvPlb8DxQ2yAEoHd9RHQt_', '1');
INSERT INTO `a_head` VALUES ('3', '2017-04-13 17:37:22', '2017-04-13 17:40:31', 'http://oj6n9nf7i.bkt.clouddn.com/b8ff39d014b6d763-small', '3', 'FuVi1zBxw48Gm6w_G_CIzslxdCIC', '1');
INSERT INTO `a_head` VALUES ('4', '2017-04-13 17:37:25', '2017-04-13 17:40:31', 'http://oj6n9nf7i.bkt.clouddn.com/9eb1bdc31d5e2572-small', '3', 'Fum3d0Cvibx7UysVKTyQr6gWFQ_t', '1');
INSERT INTO `a_head` VALUES ('5', '2017-04-13 17:37:28', '2017-04-13 17:40:30', 'http://oj6n9nf7i.bkt.clouddn.com/2dddf76af99dac7f-small', '3', 'FgCocTbn8RWQcclz21_vimGnTD-x', '1');
INSERT INTO `a_head` VALUES ('6', '2017-04-13 17:37:35', '2017-04-13 17:40:29', 'http://oj6n9nf7i.bkt.clouddn.com/c01b6ba0ddbade7e-small', '3', 'FhkFS8W_e_ywTe_uthFvUlWqri7i', '1');
INSERT INTO `a_head` VALUES ('7', '2017-04-13 17:37:40', '2017-04-13 17:40:28', 'http://oj6n9nf7i.bkt.clouddn.com/1ce315aa15527ef4-small', '3', 'FrSrAmcmuNtnjQvzLpn0pkAxKesd', '1');
INSERT INTO `a_head` VALUES ('8', '2017-04-13 17:37:42', '2017-04-13 17:40:28', 'http://oj6n9nf7i.bkt.clouddn.com/ddef2c6b2e4e9169-small', '3', 'Fs0cVfaYqFLjWpqIBjmsyI5kW21c', '1');
INSERT INTO `a_head` VALUES ('9', '2017-04-13 17:37:45', '2017-04-13 17:40:27', 'http://oj6n9nf7i.bkt.clouddn.com/d76b7b948348660d-small', '3', 'FucOJ5PZUjCoZILJMdW4wp4QFfnn', '1');
INSERT INTO `a_head` VALUES ('10', '2017-04-13 17:37:47', '2017-04-13 17:40:26', 'http://oj6n9nf7i.bkt.clouddn.com/4b7a9618000855e5-small', '3', 'FrC1qQGUIXMMeScrqmIsRbiVjIzK', '1');
INSERT INTO `a_head` VALUES ('11', '2017-04-13 17:37:52', '2017-04-13 17:40:25', 'http://oj6n9nf7i.bkt.clouddn.com/5fe88a652962f0e1-small', '3', 'FtxaqHrhjzcZlRR2XOPG9vNt7e9o', '1');

-- ----------------------------
-- Table structure for a_music
-- ----------------------------
DROP TABLE IF EXISTS `a_music`;
CREATE TABLE `a_music` (
  `musicid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `author` varchar(100) DEFAULT NULL COMMENT '歌手',
  `link` char(255) DEFAULT NULL COMMENT '音乐链接',
  `onlinetime` date DEFAULT NULL COMMENT '发行日期',
  `introduce` varchar(10000) DEFAULT NULL COMMENT '介绍',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `commentnumber` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `praisenumber` int(11) NOT NULL DEFAULT '0' COMMENT '赞数量',
  `knocknumber` int(11) NOT NULL DEFAULT '0' COMMENT '踩数量',
  `collectnumber` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `sharenumber` int(11) NOT NULL DEFAULT '0' COMMENT '分享数量',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `coverlink` char(255) DEFAULT '' COMMENT '封面链接',
  `coversize` int(11) DEFAULT '0' COMMENT '封面大小',
  `coverhash` char(50) DEFAULT NULL,
  PRIMARY KEY (`musicid`),
  UNIQUE KEY `keyhash` (`musicid`,`coverhash`) USING HASH,
  KEY `keytitle` (`title`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE,
  KEY `keyupdatetime` (`updatetime`) USING BTREE,
  KEY `keyhot` (`hot`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_music
-- ----------------------------
INSERT INTO `a_music` VALUES ('1', 'title', 'author', 'http://65.ierge.cn/11/168/336613.mp3', '2017-03-17', '*sadasdasdasdas*', '1', '0', '0', '0', '0', '0', '0', '2017-03-17 14:54:36', '2017-03-17 14:54:36', '6', 'http://oj6n9nf7i.bkt.clouddn.com/8330b314c3d6537b-middle', '2', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP');
INSERT INTO `a_music` VALUES ('2', 'ass', 'acasff', 'http://65.ierge.cn/11/168/336613.mp3', '2015-03-17', '*asdasd*', '1', '0', '0', '0', '0', '0', '0', '2017-03-17 15:36:49', '2017-03-17 15:36:49', '6', 'http://oj6n9nf7i.bkt.clouddn.com/5d3ba741653a02c1-middle', '2', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP');
INSERT INTO `a_music` VALUES ('3', 's', 's', 'http://65.ierge.cn/11/168/336613.mp3', '1993-05-07', '# asdasdas', '1', '0', '0', '0', '0', '0', '0', '2017-03-17 15:53:01', '2017-03-17 15:53:01', '6', 'http://oj6n9nf7i.bkt.clouddn.com/f876a33ac08dca32-middle', '2', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP');
INSERT INTO `a_music` VALUES ('5', 'asdasd', 'asdfasf', 'http://65.ierge.cn/11/168/336613.mp3', '2017-03-29', '<h1>asdasdf</h1>\n\n<ol>\n<li>dfgdfsgsg</li>\n<li>dfg</li>\n</ol>\n', '1', '0', '0', '0', '0', '0', '0', '2017-03-29 18:44:28', '2017-03-29 18:44:28', '6', 'http://oj6n9nf7i.bkt.clouddn.com/617df7d4e94de30e-middle', '2', 'FofiuMftwOB5SrMF8SFkV0pu4G8d');

-- ----------------------------
-- Table structure for a_picture
-- ----------------------------
DROP TABLE IF EXISTS `a_picture`;
CREATE TABLE `a_picture` (
  `pictureid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `introduce` varchar(10000) DEFAULT NULL COMMENT '介绍',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `commentnumber` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `praisenumber` int(11) NOT NULL DEFAULT '0' COMMENT '赞数量',
  `knocknumber` int(11) NOT NULL DEFAULT '0' COMMENT '踩数量',
  `collectnumber` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `sharenumber` int(11) NOT NULL DEFAULT '0' COMMENT '分享数量',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `link` varchar(500) NOT NULL COMMENT '图片上传后的地址',
  `hash` char(50) NOT NULL,
  `size` tinyint(1) NOT NULL DEFAULT '1' COMMENT '尺寸（1：原尺寸， 2：500*500   3：200*200）',
  PRIMARY KEY (`pictureid`),
  UNIQUE KEY `keyhash` (`pictureid`,`hash`) USING BTREE,
  KEY `keytitle` (`title`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE,
  KEY `keyupdatetime` (`updatetime`) USING BTREE,
  KEY `keyhot` (`hot`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_picture
-- ----------------------------
INSERT INTO `a_picture` VALUES ('1', 'title', '12rfafadfasd', '1', '4', '0', '0', '0', '0', '0', '2017-03-14 17:51:24', '2017-03-29 15:52:33', '6', 'http://oj6n9nf7i.bkt.clouddn.com/15e7d5a38dca844a-large', 'Fqr5G_3LAnMjWgoxYHC-5WLvmotB', '1');
INSERT INTO `a_picture` VALUES ('2', '水水水水*', 'asdasd', '1', '0', '0', '0', '0', '0', '0', '2017-03-16 14:29:07', '2017-03-29 14:56:11', '6', 'http://oj6n9nf7i.bkt.clouddn.com/3782acc7aa89208e-large', 'Fqr5G_3LAnMjWgoxYHC-5WLvmotB', '1');
INSERT INTO `a_picture` VALUES ('3', 'asd', '<h1>asdasdasdasd</h1>\n\n<p>sdfsdfsd<em>sdfsdfsdg</em>\n* asfdasfassf</p>\n', '1', '1', '0', '0', '0', '0', '0', '2017-03-16 15:20:24', '2017-03-29 15:52:38', '6', 'http://oj6n9nf7i.bkt.clouddn.com/77b0d9b36b4aa3f0-large', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP', '1');
INSERT INTO `a_picture` VALUES ('4', 's', '<h1>asdasdasdasd</h1>\n\n<p>sdfsdfsd<em>sdfsdfsdg</em>\n* asfdasfassf</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-03-17 15:22:23', '2017-03-29 14:56:05', '6', 'http://oj6n9nf7i.bkt.clouddn.com/c9f3a096fe3fd3df-large', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP', '1');
INSERT INTO `a_picture` VALUES ('5', 'title1', '<h1>asdasdasdasd</h1>\n\n<p>sdfsdfsd<em>sdfsdfsdg</em>\n* asfdasfassf</p>\n', '1', '2', '0', '0', '0', '0', '0', '2017-03-29 14:54:55', '2017-03-29 15:52:32', '6', 'http://oj6n9nf7i.bkt.clouddn.com/fd97c0a0f238615b-large', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP', '1');
INSERT INTO `a_picture` VALUES ('6', 'title2', '<p><em>asdasd</em>\n* asdasdas\n1. * asdasdasdfasfas\n2. sdzfasfgadfg</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-03-29 15:18:57', '2017-03-29 15:18:57', '6', 'http://oj6n9nf7i.bkt.clouddn.com/1a6a9d99a393d47c-large', 'Fqr5G_3LAnMjWgoxYHC-5WLvmotB', '1');
INSERT INTO `a_picture` VALUES ('7', 'title3', '<h1>sdfsdfsdf</h1>\n', '1', '2', '0', '0', '0', '0', '0', '2017-03-29 15:19:35', '2017-03-29 15:52:31', '6', 'http://oj6n9nf7i.bkt.clouddn.com/4f577d94869a0d64-large', 'Fqr5G_3LAnMjWgoxYHC-5WLvmotB', '1');
INSERT INTO `a_picture` VALUES ('8', 'title4', '<p>asdasdasdvsdbgsdgv</p>\n', '1', '1', '0', '0', '0', '0', '0', '2017-03-29 15:20:54', '2017-03-29 15:53:16', '6', 'http://oj6n9nf7i.bkt.clouddn.com/ae9f2c023d4da395-large', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP', '1');
INSERT INTO `a_picture` VALUES ('9', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:24', '2017-04-13 17:33:24', '6', 'http://oj6n9nf7i.bkt.clouddn.com/e069b15fa47e04fe-large', 'FiGlTRA-gQHUwwsKNBVNE2dCfGAx', '1');
INSERT INTO `a_picture` VALUES ('10', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/d2df72cb1f5f22ff-large', 'FizTaGcvPlb8DxQ2yAEoHd9RHQt_', '1');
INSERT INTO `a_picture` VALUES ('11', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/b8ff39d014b6d763-large', 'FuVi1zBxw48Gm6w_G_CIzslxdCIC', '1');
INSERT INTO `a_picture` VALUES ('12', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/9eb1bdc31d5e2572-large', 'Fum3d0Cvibx7UysVKTyQr6gWFQ_t', '1');
INSERT INTO `a_picture` VALUES ('13', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/2dddf76af99dac7f-large', 'FgCocTbn8RWQcclz21_vimGnTD-x', '1');
INSERT INTO `a_picture` VALUES ('14', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/c01b6ba0ddbade7e-large', 'FhkFS8W_e_ywTe_uthFvUlWqri7i', '1');
INSERT INTO `a_picture` VALUES ('15', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/1ce315aa15527ef4-large', 'FrSrAmcmuNtnjQvzLpn0pkAxKesd', '1');
INSERT INTO `a_picture` VALUES ('16', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/ddef2c6b2e4e9169-large', 'Fs0cVfaYqFLjWpqIBjmsyI5kW21c', '1');
INSERT INTO `a_picture` VALUES ('17', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/d76b7b948348660d-large', 'FucOJ5PZUjCoZILJMdW4wp4QFfnn', '1');
INSERT INTO `a_picture` VALUES ('18', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/4b7a9618000855e5-large', 'FrC1qQGUIXMMeScrqmIsRbiVjIzK', '1');
INSERT INTO `a_picture` VALUES ('19', 'ss', '<p>sss</p>\n', '1', '0', '0', '0', '0', '0', '0', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', 'http://oj6n9nf7i.bkt.clouddn.com/5fe88a652962f0e1-large', 'FtxaqHrhjzcZlRR2XOPG9vNt7e9o', '1');

-- ----------------------------
-- Table structure for a_user
-- ----------------------------
DROP TABLE IF EXISTS `a_user`;
CREATE TABLE `a_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` char(100) NOT NULL COMMENT '密码',
  `introduce` varchar(10000) DEFAULT NULL COMMENT '介绍',
  `vitality` int(11) NOT NULL DEFAULT '0' COMMENT '活跃度',
  `contribution` int(11) NOT NULL DEFAULT '0' COMMENT '贡献值',
  `totaltime` int(11) NOT NULL DEFAULT '0' COMMENT '登陆总天数',
  `realname` varchar(100) DEFAULT NULL COMMENT '真实姓名',
  `email` char(50) DEFAULT NULL COMMENT '邮箱',
  `phonenumber` char(20) DEFAULT NULL COMMENT '手机号',
  `address` varchar(1000) DEFAULT NULL COMMENT '地址',
  `job` varchar(255) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT '1' COMMENT '1：男 2：女',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `follownumber` int(11) NOT NULL DEFAULT '0' COMMENT '关注的人数量',
  `fannumber` int(11) NOT NULL DEFAULT '0' COMMENT '粉丝的数量',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `headlink` char(255) NOT NULL COMMENT '头像的link',
  `headsize` int(11) NOT NULL DEFAULT '0' COMMENT '头像大小',
  `headhash` char(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0：屏蔽 2：管理员 3：超级管理员',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `keyhash` (`userid`,`headhash`) USING BTREE,
  KEY `keyusername` (`username`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE,
  KEY `keyupdatetime` (`updatetime`) USING BTREE,
  KEY `keyvitality` (`vitality`) USING BTREE,
  KEY `keycontribution` (`contribution`) USING BTREE,
  KEY `keytotaltime` (`totaltime`) USING BTREE,
  KEY `keyfannumber` (`fannumber`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_user
-- ----------------------------
INSERT INTO `a_user` VALUES ('6', 'shenjieyi', '123456', '我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿我是程序猿', '0', '0', '0', null, null, null, null, null, '1', null, '0', '0', '2016-12-16 10:56:52', '2017-04-13 14:38:28', 'http://oj6n9nf7i.bkt.clouddn.com/15e7d5a38dca844a-small', '0', '1', '1');
INSERT INTO `a_user` VALUES ('7', 'hehe', '123456', '你是逗比，呵呵', '0', '0', '0', null, null, null, null, null, '2', null, '0', '0', '2017-04-11 09:58:03', '2017-04-13 12:11:28', 'http://oj6n9nf7i.bkt.clouddn.com/c9f3a096fe3fd3df-small', '0', '1', '1');
INSERT INTO `a_user` VALUES ('8', '呵呵呵呵呵', '123456', null, '0', '0', '0', null, null, null, null, null, '1', null, '0', '0', '2017-04-14 11:52:33', '2017-04-14 11:52:33', 'http://oj6n9nf7i.bkt.clouddn.com/FofiuMftwOB5SrMF8SFkV0pu4G8d-small', '3', 'FofiuMftwOB5SrMF8SFkV0pu4G8d', '1');
INSERT INTO `a_user` VALUES ('9', '请叫我女王大人', '123456', null, '0', '0', '0', null, null, null, null, null, '1', null, '0', '0', '2017-04-14 12:06:39', '2017-04-14 12:06:39', 'http://oj6n9nf7i.bkt.clouddn.com/1ce315aa15527ef4-small', '3', 'FrSrAmcmuNtnjQvzLpn0pkAxKesd', '1');

-- ----------------------------
-- Table structure for a_video
-- ----------------------------
DROP TABLE IF EXISTS `a_video`;
CREATE TABLE `a_video` (
  `videoid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL COMMENT '标题',
  `director` varchar(100) DEFAULT NULL COMMENT '导演',
  `type` varchar(255) DEFAULT NULL COMMENT '类型',
  `actor` varchar(255) DEFAULT NULL COMMENT '演员',
  `language` char(100) DEFAULT NULL COMMENT '语言',
  `link` char(255) DEFAULT NULL COMMENT '视频链接',
  `onlinetime` date DEFAULT NULL COMMENT '发行日期',
  `introduce` varchar(10000) DEFAULT NULL COMMENT '介绍',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `commentnumber` int(11) NOT NULL DEFAULT '0' COMMENT '评论数量',
  `praisenumber` int(11) NOT NULL DEFAULT '0' COMMENT '赞数量',
  `knocknumber` int(11) NOT NULL DEFAULT '0' COMMENT '踩数量',
  `collectnumber` int(11) NOT NULL DEFAULT '0' COMMENT '收藏数量',
  `sharenumber` int(11) NOT NULL DEFAULT '0' COMMENT '分享数量',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `coverlink` char(255) DEFAULT '' COMMENT '封面链接',
  `coversize` int(11) DEFAULT '0' COMMENT '封面大小',
  `coverhash` char(50) DEFAULT NULL,
  PRIMARY KEY (`videoid`),
  UNIQUE KEY `keyhash` (`videoid`,`coverhash`) USING BTREE,
  KEY `keytitle` (`title`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE,
  KEY `keyupdatetime` (`updatetime`) USING BTREE,
  KEY `keyhot` (`hot`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of a_video
-- ----------------------------
INSERT INTO `a_video` VALUES ('1', 'title', 'director1/director2', '4', 'actor1/actor2', 'KR', 'http://115.231.144.61/7/t/f/n/c/tfncnxligpbxdpxaqohytouiwngawn/hc.yinyuetai.com/656B015AEFBEFBA6236DB983E4621561.mp4', '2017-03-22', '# asdasdasd', '1', '2', '0', '0', '0', '0', '0', '2017-03-22 11:00:20', '2017-03-30 14:18:11', '6', 'http://oj6n9nf7i.bkt.clouddn.com/2ed959249ded1edc-middle', '2', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP');
INSERT INTO `a_video` VALUES ('2', '生化危机', '保罗-安德森', '4', '米拉-乔沃维奇/译哥', 'US', 'http://115.231.144.61/7/t/f/n/c/tfncnxligpbxdpxaqohytouiwngawn/hc.yinyuetai.com/656B015AEFBEFBA6236DB983E4621561.mp4', '2017-03-22', '* 故事紧接《生化危机5：惩罚》，在华盛顿特区爱丽丝被威斯克背叛后人类几乎要失去最后的希望。作为唯一的幸存者，也是人类对抗僵尸大军的最后防线，爱丽丝必须回到噩梦开始的地方——浣熊市。在那里雨伞公司正在集结所有的力量企图对残余的幸存者发起最后的打击。 　　\r\n* 在和时间赛跑的过程中，爱丽丝将和昔日的朋友一起对抗僵尸和最新变种怪物。爱丽丝失去了自己的超能力，加上雨伞公司的疯狂进攻，这将是她拯救人类以来打得最艰难的一仗', '1', '3', '0', '0', '0', '0', '0', '2017-03-22 11:41:40', '2017-03-30 14:18:14', '6', 'http://oj6n9nf7i.bkt.clouddn.com/7867bb45c4433d31-middle', '2', 'FinNxoowkXMa5c2RPsUDw0U-f9se');
INSERT INTO `a_video` VALUES ('3', 'title', 'dirctor1/director2/director3', '4', 'actor1/actor2/actor3', 'KR', 'http://115.231.144.61/7/t/f/n/c/tfncnxligpbxdpxaqohytouiwngawn/hc.yinyuetai.com/656B015AEFBEFBA6236DB983E4621561.mp4', '2017-03-27', '1. asdasdsad\r\n2. asdafq\r\n3. qw4wqrdaf\r\n4.', '1', '0', '0', '0', '0', '0', '0', '2017-03-27 10:01:58', '2017-03-27 10:01:58', '6', 'http://oj6n9nf7i.bkt.clouddn.com/e8a6d4ce0f6fa545-middle', '2', 'Fle9ySwYk_qkl6s-zFVKsFyj_trP');
INSERT INTO `a_video` VALUES ('4', '音乐mv', '译哥', '4', '田馥甄', 'JP', 'http://vali.cp31.ott.cibntv.net/youku/6773F4BCD0238715B8C8A5D6E/030008010058CA4ABE391E003E8803E5FBA10D-2388-523B-A77C-FFEC0843E15A.mp4?sid=049085406620912098809_00&sign=b9767e3a011c3fa1f5beaaddb10b7a0f&ctype=50', '2017-03-30', '<p><em>啊实打实大声道</em></p>\n', '1', '7', '0', '0', '0', '0', '0', '2017-03-30 14:35:31', '2017-03-30 14:48:37', '6', 'http://oj6n9nf7i.bkt.clouddn.com/40562b93107ee873-middle', '2', 'FmrjfeKIXM90mxoJG05r22teNylv');

-- ----------------------------
-- Table structure for b_collect
-- ----------------------------
DROP TABLE IF EXISTS `b_collect`;
CREATE TABLE `b_collect` (
  `collectid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1：articel  2： picture 3：music 4：video ',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `toid` int(11) NOT NULL DEFAULT '0' COMMENT '接受id',
  PRIMARY KEY (`collectid`),
  KEY `keytype` (`type`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_collect
-- ----------------------------
INSERT INTO `b_collect` VALUES ('1', '1', '2017-04-11 15:23:41', '2017-04-11 15:23:41', '6', '65');
INSERT INTO `b_collect` VALUES ('2', '2', '2017-04-11 15:23:49', '2017-04-11 15:23:49', '6', '1');

-- ----------------------------
-- Table structure for b_comment
-- ----------------------------
DROP TABLE IF EXISTS `b_comment`;
CREATE TABLE `b_comment` (
  `commentid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text COMMENT '评论内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1：article的评论 2：picture的评论 3：music的评论 4：video的评论 5：回复 ',
  `toid` int(11) NOT NULL DEFAULT '0',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  PRIMARY KEY (`commentid`),
  KEY `keytype` (`type`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_comment
-- ----------------------------
INSERT INTO `b_comment` VALUES ('1', 'gggg', '1', '0', '1', '65', '2017-04-06 10:17:14', '2017-04-11 09:57:18', '6');
INSERT INTO `b_comment` VALUES ('2', 'ttttt', '1', '0', '5', '1', '2017-04-11 09:58:34', '2017-04-14 12:08:59', '8');
INSERT INTO `b_comment` VALUES ('3', '34444', '1', '0', '5', '1', '2017-04-11 10:46:21', '2017-04-11 10:47:14', '6');
INSERT INTO `b_comment` VALUES ('4', 'rqewrt', '1', '0', '5', '2', '2017-04-11 11:28:58', '2017-04-14 12:09:02', '9');
INSERT INTO `b_comment` VALUES ('5', 'aaa', '1', '0', '1', '65', '2017-04-13 10:50:55', '2017-04-13 10:50:55', '7');

-- ----------------------------
-- Table structure for b_follow
-- ----------------------------
DROP TABLE IF EXISTS `b_follow`;
CREATE TABLE `b_follow` (
  `followid` int(11) NOT NULL AUTO_INCREMENT,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fromid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `toid` int(11) NOT NULL DEFAULT '0' COMMENT '接受id',
  PRIMARY KEY (`followid`),
  KEY `keyfromid` (`fromid`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_follow
-- ----------------------------

-- ----------------------------
-- Table structure for b_keyword
-- ----------------------------
DROP TABLE IF EXISTS `b_keyword`;
CREATE TABLE `b_keyword` (
  `keywordid` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(100) DEFAULT NULL COMMENT '标签内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  PRIMARY KEY (`keywordid`),
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keyhot` (`hot`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_keyword
-- ----------------------------

-- ----------------------------
-- Table structure for b_pk
-- ----------------------------
DROP TABLE IF EXISTS `b_pk`;
CREATE TABLE `b_pk` (
  `pkid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1：articel  2： picture 3：music 4：video ',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `toid` int(11) NOT NULL DEFAULT '0' COMMENT '接受id',
  `action` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：praise 2：knock',
  PRIMARY KEY (`pkid`),
  KEY `keytype` (`type`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keyaction` (`action`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_pk
-- ----------------------------
INSERT INTO `b_pk` VALUES ('1', '1', '2017-04-05 11:10:47', '2017-04-05 11:32:56', '6', '67', '1');
INSERT INTO `b_pk` VALUES ('2', '2', '2017-04-05 11:11:02', '2017-04-05 11:11:02', '6', '2', '2');
INSERT INTO `b_pk` VALUES ('3', '1', '2017-04-06 10:10:00', '2017-04-06 10:10:00', '6', '66', '1');
INSERT INTO `b_pk` VALUES ('4', '1', '2017-04-06 10:12:32', '2017-04-11 16:27:53', '6', '65', '1');
INSERT INTO `b_pk` VALUES ('5', '2', '2017-04-06 10:18:11', '2017-04-06 10:50:12', '6', '1', '1');
INSERT INTO `b_pk` VALUES ('6', '3', '2017-04-06 11:07:48', '2017-04-06 11:07:48', '6', '1', '1');
INSERT INTO `b_pk` VALUES ('7', '4', '2017-04-06 11:07:56', '2017-04-06 11:07:56', '6', '1', '1');

-- ----------------------------
-- Table structure for b_share
-- ----------------------------
DROP TABLE IF EXISTS `b_share`;
CREATE TABLE `b_share` (
  `shareid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1：articel  2： picture 3：music 4：video ',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `toid` int(11) NOT NULL DEFAULT '0' COMMENT '接受id',
  `action` int(11) NOT NULL DEFAULT '1' COMMENT ' 1：qq 2： wechat 3：blog',
  PRIMARY KEY (`shareid`),
  KEY `keytype` (`type`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keytoid` (`toid`) USING BTREE,
  KEY `keyaction` (`action`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_share
-- ----------------------------
INSERT INTO `b_share` VALUES ('1', '1', '2017-04-11 15:24:07', '2017-04-11 15:24:07', '6', '65', '1');
INSERT INTO `b_share` VALUES ('2', '2', '2017-04-11 15:24:12', '2017-05-03 17:20:44', '6', '1', '2');

-- ----------------------------
-- Table structure for b_tag
-- ----------------------------
DROP TABLE IF EXISTS `b_tag`;
CREATE TABLE `b_tag` (
  `tagid` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(100) DEFAULT NULL COMMENT '标签内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1：正常 0 删除',
  `hot` int(11) NOT NULL DEFAULT '0' COMMENT '热度',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '类型 1：articel  2： picture 3：music 4：video 5：user',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL DEFAULT '0' COMMENT '作者id',
  `toid` int(11) NOT NULL DEFAULT '0' COMMENT '接受id',
  PRIMARY KEY (`tagid`),
  KEY `keytype` (`type`) USING BTREE,
  KEY `keyuserid` (`userid`) USING BTREE,
  KEY `keyhot` (`hot`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_tag
-- ----------------------------
INSERT INTO `b_tag` VALUES ('42', 'tag1 ', '1', '0', '3', '2017-03-17 14:54:36', '2017-03-17 14:54:36', '6', '1');
INSERT INTO `b_tag` VALUES ('43', 'tag2', '1', '0', '3', '2017-03-17 14:54:36', '2017-03-17 14:54:36', '6', '1');
INSERT INTO `b_tag` VALUES ('44', 's', '1', '0', '2', '2017-03-17 15:22:23', '2017-03-17 15:22:23', '6', '4');
INSERT INTO `b_tag` VALUES ('45', 'asd', '1', '0', '3', '2017-03-17 15:36:49', '2017-03-17 15:36:49', '6', '2');
INSERT INTO `b_tag` VALUES ('46', ' asd', '1', '0', '3', '2017-03-17 15:36:49', '2017-03-17 15:36:49', '6', '2');
INSERT INTO `b_tag` VALUES ('47', ' asawrqf', '1', '0', '3', '2017-03-17 15:36:49', '2017-03-17 15:36:49', '6', '2');
INSERT INTO `b_tag` VALUES ('48', 's', '1', '0', '3', '2017-03-17 15:53:02', '2017-03-17 15:53:02', '6', '3');
INSERT INTO `b_tag` VALUES ('49', 'tag1', '1', '0', '4', '2017-03-22 11:00:20', '2017-03-22 11:00:20', '6', '1');
INSERT INTO `b_tag` VALUES ('50', 'tag2', '1', '0', '4', '2017-03-22 11:00:20', '2017-03-22 11:00:20', '6', '1');
INSERT INTO `b_tag` VALUES ('51', '生化', '1', '0', '4', '2017-03-22 11:41:40', '2017-03-22 11:41:40', '6', '2');
INSERT INTO `b_tag` VALUES ('52', '危机', '1', '0', '4', '2017-03-22 11:41:40', '2017-03-22 11:41:40', '6', '2');
INSERT INTO `b_tag` VALUES ('53', '僵尸', '1', '0', '4', '2017-03-22 11:41:40', '2017-03-22 11:41:40', '6', '2');
INSERT INTO `b_tag` VALUES ('54', 'tag1', '1', '0', '4', '2017-03-27 10:01:58', '2017-03-27 10:01:58', '6', '3');
INSERT INTO `b_tag` VALUES ('55', 'tag2', '1', '0', '4', '2017-03-27 10:01:58', '2017-03-27 10:01:58', '6', '3');
INSERT INTO `b_tag` VALUES ('56', 'tag3', '1', '0', '4', '2017-03-27 10:01:58', '2017-03-27 10:01:58', '6', '3');
INSERT INTO `b_tag` VALUES ('57', 'tag1', '1', '0', '1', '2017-03-27 14:54:25', '2017-03-27 14:54:25', '6', '65');
INSERT INTO `b_tag` VALUES ('58', 'tag2', '1', '0', '1', '2017-03-27 14:54:25', '2017-03-27 14:54:25', '6', '65');
INSERT INTO `b_tag` VALUES ('59', 'tag1', '1', '0', '1', '2017-03-27 15:16:40', '2017-03-27 15:16:40', '6', '66');
INSERT INTO `b_tag` VALUES ('60', '标签一号', '1', '0', '1', '2017-03-27 17:33:04', '2017-03-27 17:33:04', '6', '67');
INSERT INTO `b_tag` VALUES ('61', '标签二号', '1', '0', '1', '2017-03-27 17:33:04', '2017-03-27 17:33:04', '6', '67');
INSERT INTO `b_tag` VALUES ('62', 'tag', '1', '0', '2', '2017-03-29 14:54:55', '2017-03-29 14:54:55', '6', '5');
INSERT INTO `b_tag` VALUES ('63', 'tag', '1', '0', '2', '2017-03-29 15:18:57', '2017-03-29 15:18:57', '6', '6');
INSERT INTO `b_tag` VALUES ('64', 'tag', '1', '0', '2', '2017-03-29 15:19:35', '2017-03-29 15:19:35', '6', '7');
INSERT INTO `b_tag` VALUES ('65', 'tag', '1', '0', '2', '2017-03-29 15:20:54', '2017-03-29 15:20:54', '6', '8');
INSERT INTO `b_tag` VALUES ('66', '阿萨德', '1', '0', '3', '2017-03-29 18:42:54', '2017-03-29 18:42:54', '6', '4');
INSERT INTO `b_tag` VALUES ('67', 'afasf', '1', '0', '3', '2017-03-29 18:44:28', '2017-03-29 18:44:28', '6', '5');
INSERT INTO `b_tag` VALUES ('68', 'mv', '1', '0', '4', '2017-03-30 14:35:31', '2017-03-30 14:35:31', '6', '4');
INSERT INTO `b_tag` VALUES ('69', '音乐', '1', '0', '4', '2017-03-30 14:35:31', '2017-03-30 14:35:31', '6', '4');
INSERT INTO `b_tag` VALUES ('70', '程序员', '1', '0', '5', '2017-04-12 09:18:25', '2017-04-12 09:18:25', '6', '6');
INSERT INTO `b_tag` VALUES ('71', '低调', '1', '0', '5', '2017-04-12 09:18:36', '2017-04-12 09:18:36', '6', '6');
INSERT INTO `b_tag` VALUES ('72', 'ss', '1', '0', '2', '2017-04-13 17:33:24', '2017-04-13 17:33:24', '6', '9');
INSERT INTO `b_tag` VALUES ('73', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '10');
INSERT INTO `b_tag` VALUES ('74', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '11');
INSERT INTO `b_tag` VALUES ('75', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '12');
INSERT INTO `b_tag` VALUES ('76', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '13');
INSERT INTO `b_tag` VALUES ('77', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '14');
INSERT INTO `b_tag` VALUES ('78', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '15');
INSERT INTO `b_tag` VALUES ('79', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '16');
INSERT INTO `b_tag` VALUES ('80', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '17');
INSERT INTO `b_tag` VALUES ('81', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '18');
INSERT INTO `b_tag` VALUES ('82', 'ss', '1', '0', '2', '2017-04-13 17:33:25', '2017-04-13 17:33:25', '6', '19');

-- ----------------------------
-- Table structure for c_log
-- ----------------------------
DROP TABLE IF EXISTS `c_log`;
CREATE TABLE `c_log` (
  `logid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) NOT NULL DEFAULT '1' COMMENT '1：add articel 2：delete articel 3：update articel 4：add music 5：delete music 6：update music 7：add picture 8：delete picture 9：update picture 10：add video 11：delete video 12：update video 13：comment 14：pk（praise or knock） 15：collect 16：follow 17：share 18：register 19：login 20：logout',
  `toid` int(11) NOT NULL COMMENT '接受id',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`logid`),
  KEY `keytype` (`type`) USING BTREE,
  KEY `keytoid` (`toid`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_log
-- ----------------------------

-- ----------------------------
-- Table structure for c_top
-- ----------------------------
DROP TABLE IF EXISTS `c_top`;
CREATE TABLE `c_top` (
  `topid` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1：tag 2：product 3：user 4：keyword',
  `week` tinyint(3) NOT NULL DEFAULT '0' COMMENT '一年中的第几周',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`topid`),
  KEY `keyweek` (`week`) USING BTREE,
  KEY `keytype` (`type`) USING BTREE,
  KEY `keycreatetime` (`createtime`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of c_top
-- ----------------------------
