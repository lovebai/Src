/*
 Navicat Premium Data Transfer

 Source Server         : MySql
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : cmsrc

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 30/07/2021 19:16:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for src_admin
-- ----------------------------
DROP TABLE IF EXISTS `src_admin`;
CREATE TABLE `src_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '后台用户id',
  `name` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户姓名',
  `username` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '后台用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '后台用户密码',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '后台用户头像默认使用QQ',
  `qq` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '后台用户头像默认使用QQ',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '后台用户状态',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE COMMENT '唯一用户名'
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_admin
-- ----------------------------
INSERT INTO `src_admin` VALUES (9, '测试账号', 'testtest@test.cn', '220d64bcdeb9b42e4afb123e9ddc9cdf1e28b5b0', '', '', 1);

-- ----------------------------
-- Table structure for src_attachment
-- ----------------------------
DROP TABLE IF EXISTS `src_attachment`;
CREATE TABLE `src_attachment`  (
  `aid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '附件ID',
  `gid` int(10) NOT NULL COMMENT '漏洞id',
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文件名',
  `filepath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '附件路径',
  `uptime` datetime NOT NULL COMMENT '上传时间',
  PRIMARY KEY (`aid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_attachment
-- ----------------------------
INSERT INTO `src_attachment` VALUES (4, 1, '漏洞一', '/uploads/bfile/20210519\\16c49b55e2c98fc9a14b52d53ab7a101.jpg', '2021-05-19 16:32:52');
INSERT INTO `src_attachment` VALUES (5, 18, 'd15dcc1d8d62629c173d0b5a52e0e9dc.jpg', 'bfile/20210523\\d15dcc1d8d62629c173d0b5a52e0e9dc.jpg', '2021-05-23 17:44:40');
INSERT INTO `src_attachment` VALUES (6, 18, '55bb782104a8478135031c71296bf33a.jpg', 'bfile/20210523\\55bb782104a8478135031c71296bf33a.jpg', '2021-05-23 19:27:03');
INSERT INTO `src_attachment` VALUES (7, 18, '0152c7eab6c426b873bf7708a324a5f8.jpg', 'bfile/20210523\\0152c7eab6c426b873bf7708a324a5f8.jpg', '2021-05-23 19:38:22');
INSERT INTO `src_attachment` VALUES (8, 18, '686fea5d60af9210aa390b3cd63ac095.jpg', 'bfile/20210524\\686fea5d60af9210aa390b3cd63ac095.jpg', '2021-05-24 16:35:54');
INSERT INTO `src_attachment` VALUES (9, 18, 'd53571a7f516a6c5c35aac0927f19c49.jpg', 'bfile/20210524\\d53571a7f516a6c5c35aac0927f19c49.jpg', '2021-05-24 16:37:17');
INSERT INTO `src_attachment` VALUES (10, 18, 'c812b02af579a28f348b7e693f81c083.jpg', 'bfile/20210524\\c812b02af579a28f348b7e693f81c083.jpg', '2021-05-24 16:38:36');
INSERT INTO `src_attachment` VALUES (11, 18, 'd56d0599965fa6b2ba5089546ca1c687.jpg', 'bfile/20210524\\d56d0599965fa6b2ba5089546ca1c687.jpg', '2021-05-24 16:39:24');
INSERT INTO `src_attachment` VALUES (12, 18, '5869f002056c2cb5a0385c52e7e9fd25.jpg', 'bfile/20210524\\5869f002056c2cb5a0385c52e7e9fd25.jpg', '2021-05-24 16:40:00');
INSERT INTO `src_attachment` VALUES (13, 18, 'b5827db460c74dc75a7b648e52a44262.jpg', 'bfile/20210524\\b5827db460c74dc75a7b648e52a44262.jpg', '2021-05-24 16:45:37');
INSERT INTO `src_attachment` VALUES (14, 18, 'f2f8a7970dd36d3ad3b3f7b394546d95.jpg', 'bfile/20210524\\f2f8a7970dd36d3ad3b3f7b394546d95.jpg', '2021-05-24 17:02:59');
INSERT INTO `src_attachment` VALUES (15, 18, 'de797b1c9d221e06c65c09787cce2ab1.jpg', 'bfile/20210524\\de797b1c9d221e06c65c09787cce2ab1.jpg', '2021-05-24 17:05:17');
INSERT INTO `src_attachment` VALUES (16, 20, '66a31de9b7fc04799d414bb48203c797.jpg', 'bfile/20210524\\66a31de9b7fc04799d414bb48203c797.jpg', '2021-05-24 17:31:29');
INSERT INTO `src_attachment` VALUES (17, 19, 'bb90db900080254adcd6572f39d4e10a.docx', 'bfile/20210527\\bb90db900080254adcd6572f39d4e10a.docx', '2021-05-27 15:59:02');
INSERT INTO `src_attachment` VALUES (18, 22, 'c756c33a4888340c7444267951eae4e6.jpg', 'bfile/20210528\\c756c33a4888340c7444267951eae4e6.jpg', '2021-05-28 12:46:13');
INSERT INTO `src_attachment` VALUES (19, 23, 'e412802813e3f5d8f1babd000f79a36e.jpg', 'bfile/20210528\\e412802813e3f5d8f1babd000f79a36e.jpg', '2021-05-28 12:47:18');
INSERT INTO `src_attachment` VALUES (20, 23, '3950c4935a5c77cad516b8393ea1f2aa.png', 'bfile/20210528\\3950c4935a5c77cad516b8393ea1f2aa.png', '2021-05-28 12:54:44');
INSERT INTO `src_attachment` VALUES (21, 23, 'bc251f52b6f1634877548d92a35dfc74.png', 'bfile/20210528\\bc251f52b6f1634877548d92a35dfc74.png', '2021-05-28 12:55:54');
INSERT INTO `src_attachment` VALUES (22, 23, '797bb29646ffab4f1fa12fdb8b8ad19a.png', 'bfile/20210528\\797bb29646ffab4f1fa12fdb8b8ad19a.png', '2021-05-28 12:57:46');
INSERT INTO `src_attachment` VALUES (23, 23, '91a331bd0b5a7aa1ce6d2aa0353ef3b5.png', 'bfile/20210528\\91a331bd0b5a7aa1ce6d2aa0353ef3b5.png', '2021-05-28 12:58:08');
INSERT INTO `src_attachment` VALUES (24, 23, 'de9d2d426d99ff60785db0b9722be07d.png', 'bfile/20210528\\de9d2d426d99ff60785db0b9722be07d.png', '2021-05-28 12:58:24');
INSERT INTO `src_attachment` VALUES (25, 23, 'c9b4c1753cefde801def35de247b8d80.png', 'bfile/20210528\\c9b4c1753cefde801def35de247b8d80.png', '2021-05-28 14:02:32');
INSERT INTO `src_attachment` VALUES (26, 23, '0f4c4538893b725d2af63f4a294f9441.png', 'bfile/20210528\\0f4c4538893b725d2af63f4a294f9441.png', '2021-05-28 14:03:37');

-- ----------------------------
-- Table structure for src_bug
-- ----------------------------
DROP TABLE IF EXISTS `src_bug`;
CREATE TABLE `src_bug`  (
  `gid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `author` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '作者',
  `type` int(5) NOT NULL COMMENT '类型',
  `grade` tinyint(1) NOT NULL DEFAULT 1 COMMENT '等级',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '状态',
  `subdate` datetime NULL DEFAULT NULL,
  `attach` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`gid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_bug
-- ----------------------------
INSERT INTO `src_bug` VALUES (22, '常见漏洞', '<p><span style=\"color: #4d4d4d; font-family: -apple-system, \'SF UI Text\', Arial, \'PingFang SC\', \'Hiragino Sans GB\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif, SimHei, SimSun; font-size: 16px; background-color: #ffffff;\">网络交慢或者弱网状态下，新增某个功能时，快速2次点击提交按钮，会造成数据的重复提交</span><br style=\"box-sizing: border-box; outline: 0px; overflow-wrap: break-word; color: #4d4d4d; font-family: -apple-system, \'SF UI Text\', Arial, \'PingFang SC\', \'Hiragino Sans GB\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif, SimHei, SimSun; font-size: 16px; background-color: #ffffff;\" /><span style=\"color: #4d4d4d; font-family: -apple-system, \'SF UI Text\', Arial, \'PingFang SC\', \'Hiragino Sans GB\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif, SimHei, SimSun; font-size: 16px; background-color: #ffffff;\">&nbsp; 解决方法：点击提交后，将按钮变为disable状态，禁止用户再次点</span></p>', '123456', 17, 1, 0, '2021-05-28 12:46:21', 0);
INSERT INTO `src_bug` VALUES (21, '常见bug', '<p><span style=\"color: #4d4d4d; font-family: -apple-system, \'SF UI Text\', Arial, \'PingFang SC\', \'Hiragino Sans GB\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif, SimHei, SimSun; font-size: 16px; background-color: #ffffff;\">网络交慢或者弱网状态下，新增某个功能时，快速2次点击提交按钮，会造成数据的重复提交</span><br style=\"box-sizing: border-box; outline: 0px; overflow-wrap: break-word; color: #4d4d4d; font-family: -apple-system, \'SF UI Text\', Arial, \'PingFang SC\', \'Hiragino Sans GB\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif, SimHei, SimSun; font-size: 16px; background-color: #ffffff;\" /><span style=\"color: #4d4d4d; font-family: -apple-system, \'SF UI Text\', Arial, \'PingFang SC\', \'Hiragino Sans GB\', \'Microsoft YaHei\', \'WenQuanYi Micro Hei\', sans-serif, SimHei, SimSun; font-size: 16px; background-color: #ffffff;\">&nbsp; 解决方法：点击提交后，将按钮变为disable状态，禁止用户再次点</span></p>', '123456', 10, 0, 0, '2021-05-28 12:40:41', 0);
INSERT INTO `src_bug` VALUES (23, '再次测试提交', '<p>撒旦飞洒尽量考虑考虑看看&nbsp;</p>', '123456', 28, 1, 0, '2021-05-29 00:46:43', 0);
INSERT INTO `src_bug` VALUES (24, '常见漏洞', '<p>广泛广泛风格和关怀分隔符</p>', '123456', 19, 3, 0, '2021-05-29 00:47:31', 0);
INSERT INTO `src_bug` VALUES (25, '常见漏洞', '<p>dfaffssssssssssssssssss</p>', '123456', 1, 1, 0, '2021-07-09 10:34:24', 0);
INSERT INTO `src_bug` VALUES (26, '常见漏洞123132132', '<p>dsfadsfasdf df65454</p>', '123456', 15, 1, 0, '2021-07-09 11:10:11', 0);
INSERT INTO `src_bug` VALUES (27, '常见漏洞123132132', '<p>dsfadsfasdf df65454</p>', '123456', 15, 1, 0, '2021-07-09 11:10:18', 0);

-- ----------------------------
-- Table structure for src_bugcg
-- ----------------------------
DROP TABLE IF EXISTS `src_bugcg`;
CREATE TABLE `src_bugcg`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is` enum('y','n') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'n',
  `u_id` int(5) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_bugcg
-- ----------------------------
INSERT INTO `src_bugcg` VALUES (1, 'WEB漏洞', 'y', 0);
INSERT INTO `src_bugcg` VALUES (2, '反射型XSS', 'n', 1);
INSERT INTO `src_bugcg` VALUES (3, '存储型XSS', 'n', 1);
INSERT INTO `src_bugcg` VALUES (4, 'DOM XSS', 'n', 1);
INSERT INTO `src_bugcg` VALUES (5, 'SQL注入', 'n', 1);
INSERT INTO `src_bugcg` VALUES (6, '命令执行', 'n', 1);
INSERT INTO `src_bugcg` VALUES (7, '文件包含', 'n', 1);
INSERT INTO `src_bugcg` VALUES (8, '权限绕过', 'n', 1);
INSERT INTO `src_bugcg` VALUES (9, '信息泄漏', 'n', 1);
INSERT INTO `src_bugcg` VALUES (10, 'CSRF', 'n', 1);
INSERT INTO `src_bugcg` VALUES (11, '上传漏洞', 'n', 1);
INSERT INTO `src_bugcg` VALUES (12, 'URL跳转', 'n', 1);
INSERT INTO `src_bugcg` VALUES (13, '弱口令', 'n', 1);
INSERT INTO `src_bugcg` VALUES (14, '其他', 'n', 1);
INSERT INTO `src_bugcg` VALUES (15, '服务器漏洞', 'y', 0);
INSERT INTO `src_bugcg` VALUES (16, '配置不当', 'n', 15);
INSERT INTO `src_bugcg` VALUES (17, '弱口令', 'n', 15);
INSERT INTO `src_bugcg` VALUES (18, '高危端口', 'n', 15);
INSERT INTO `src_bugcg` VALUES (19, '远程代码执行', 'n', 15);
INSERT INTO `src_bugcg` VALUES (20, '疑似入侵', 'n', 15);
INSERT INTO `src_bugcg` VALUES (21, 'DOS', 'n', 15);
INSERT INTO `src_bugcg` VALUES (22, '其他', 'n', 15);
INSERT INTO `src_bugcg` VALUES (23, '安全情报', 'y', 0);
INSERT INTO `src_bugcg` VALUES (24, '刷量/作弊工具', 'n', 23);
INSERT INTO `src_bugcg` VALUES (25, '挂机/自动化工具', 'n', 23);
INSERT INTO `src_bugcg` VALUES (26, '下载工具', 'n', 23);
INSERT INTO `src_bugcg` VALUES (27, '破解工具', 'n', 23);
INSERT INTO `src_bugcg` VALUES (28, '黑产交易网', 'n', 23);
INSERT INTO `src_bugcg` VALUES (29, '盗版盗播网站/AP', 'n', 23);
INSERT INTO `src_bugcg` VALUES (30, '漏洞情报', 'n', 23);
INSERT INTO `src_bugcg` VALUES (31, '其他黑产情报', 'n', 23);

-- ----------------------------
-- Table structure for src_config
-- ----------------------------
DROP TABLE IF EXISTS `src_config`;
CREATE TABLE `src_config`  (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站描述',
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站关键词',
  `domain` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '后台域名',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '网站状态',
  `logo` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站logo',
  `icp` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站备案信息',
  `copyright` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '版权信息',
  `footer_info` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '底部其他信息',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_config
-- ----------------------------
INSERT INTO `src_config` VALUES (1, 'XXX平台', 'XXXX漏洞提交平台', '漏洞,提交,SRC,应急', 'http://127.0.0.1:8080', 1, 'http://127.0.0.1:8080/uploads/topic/20210528\\7d35382c651ff6c0dcecd6c80b1caa96.png', '滇ICP备1111111号', 'xxxxx版权所有', '统计代码');

-- ----------------------------
-- Table structure for src_link
-- ----------------------------
DROP TABLE IF EXISTS `src_link`;
CREATE TABLE `src_link`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '网站名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '网站描述',
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '网站链接',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '是否显示',
  `sort_id` int(6) NULL DEFAULT NULL COMMENT '排序id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_link
-- ----------------------------
INSERT INTO `src_link` VALUES (1, '表土', '描述暗室逢灯金卡', 'https://adsfafas.cd', 0, 4);
INSERT INTO `src_link` VALUES (2, 'adfaf1', '描述暗室逢灯金卡', 'jkj ', 1, 45);
INSERT INTO `src_link` VALUES (4, '安全之dgsfdg家', '描述hsfdhs暗室逢灯金卡', 'ddafdgsfa', 1, 3);
INSERT INTO `src_link` VALUES (5, '安全gfs之家', '描述暗gsf室逢灯金卡', 'ddaffsgdfa', 1, 2);
INSERT INTO `src_link` VALUES (6, '安全gsg之家', '描述暗室gsfg逢灯金卡', 'ddafgrgrdfa', 1, 7);
INSERT INTO `src_link` VALUES (7, '安全gsfdg之家', '描述暗室gaqrgh逢灯金卡', 'ddagrsfdfa', 1, 5);
INSERT INTO `src_link` VALUES (8, '安全之dsfgg家', '描述暗室逢fsgs灯金卡', 'http://asdfasdf.cd', 0, 20);
INSERT INTO `src_link` VALUES (9, '安df全fdsgs之家', '描述暗室dfgerg逢灯金卡', 'ddgsfgrgafdfa', 1, 12);
INSERT INTO `src_link` VALUES (10, '安全之sdfgdgsfdg家', '描述sdfgshsfdhs暗室逢灯金卡', 'ddsfgafdgsfa', 1, 23);
INSERT INTO `src_link` VALUES (13, '安全gsfgsfdg之家', '描述暗室gsfgsfgaqrgh逢灯金卡', 'ddagrgfssfdfa', 1, 35);
INSERT INTO `src_link` VALUES (16, '大家好', '阿道夫卡JFK', 'http://baidu.cn', 0, 65);
INSERT INTO `src_link` VALUES (17, '测试', '发给四个', 'http://127.0.0.12', 1, 100);

-- ----------------------------
-- Table structure for src_nav
-- ----------------------------
DROP TABLE IF EXISTS `src_nav`;
CREATE TABLE `src_nav`  (
  `id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '链接',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态',
  `sort_id` int(5) NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_nav
-- ----------------------------
INSERT INTO `src_nav` VALUES (1, '首页', 'hjhj ', 1, 0);
INSERT INTO `src_nav` VALUES (3, '测试', 'adfa1', 0, 44);

-- ----------------------------
-- Table structure for src_option
-- ----------------------------
DROP TABLE IF EXISTS `src_option`;
CREATE TABLE `src_option`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` enum('y','n') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'n',
  `uid` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `v3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `other` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_option
-- ----------------------------
INSERT INTO `src_option` VALUES (1, 'https://api.smsbao.com/', 'y', '15187667123', '88fa82471c1bcdeaab24be6a397e34e2', '签名', '', '');
INSERT INTO `src_option` VALUES (2, 'smtp.exmail.qq.com', 'y', 'admin@test.com', '123465', '移动云', '', '');

-- ----------------------------
-- Table structure for src_postcg
-- ----------------------------
DROP TABLE IF EXISTS `src_postcg`;
CREATE TABLE `src_postcg`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_postcg
-- ----------------------------
INSERT INTO `src_postcg` VALUES (1, '默认分类');
INSERT INTO `src_postcg` VALUES (2, '公告');
INSERT INTO `src_postcg` VALUES (3, '最新活动');
INSERT INTO `src_postcg` VALUES (4, '安全情报');
INSERT INTO `src_postcg` VALUES (5, '测试四');
INSERT INTO `src_postcg` VALUES (6, '测试二');
INSERT INTO `src_postcg` VALUES (7, '测试三');
INSERT INTO `src_postcg` VALUES (9, '大事发生123');

-- ----------------------------
-- Table structure for src_posts
-- ----------------------------
DROP TABLE IF EXISTS `src_posts`;
CREATE TABLE `src_posts`  (
  `gid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '文章ID',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '文章内容',
  `author` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'admin' COMMENT '文章作者',
  `sort_id` int(10) NOT NULL DEFAULT -1 COMMENT '位置排序id',
  `date` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '发布时间',
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'BUG' COMMENT '文章分类',
  `views` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '访问人数',
  `top` enum('n','y') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'n' COMMENT '是否置顶显示',
  `hide` enum('n','y') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'n' COMMENT '是否隐藏',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文章访问密码',
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签',
  PRIMARY KEY (`gid`) USING BTREE,
  UNIQUE INDEX `gid`(`gid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_posts
-- ----------------------------
INSERT INTO `src_posts` VALUES (22, '今天是个好日子', '<p>今天阳光明媚，太阳照常升起☀</p>', '胡杰', 0, '2021-05-28 00:00:00', '2', 27, 'y', 'n', '', '');

-- ----------------------------
-- Table structure for src_user
-- ----------------------------
DROP TABLE IF EXISTS `src_user`;
CREATE TABLE `src_user`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `username` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户密码',
  `phone` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机号',
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户邮箱',
  `status` int(1) UNSIGNED NULL DEFAULT 1 COMMENT '用户状态',
  `gender` tinyint(1) UNSIGNED NULL DEFAULT 0 COMMENT '用户性别',
  `birthday` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '出生日期',
  `team` int(6) NULL DEFAULT 0 COMMENT '团队',
  `about` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '个人简介',
  `wechat` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '微信号',
  `qq` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'QQ号',
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户头像',
  `create_date` datetime NOT NULL COMMENT '用户注册时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE COMMENT '唯一用户名',
  UNIQUE INDEX `phone`(`phone`) USING BTREE COMMENT '唯一手机号',
  UNIQUE INDEX `email`(`email`) USING BTREE COMMENT '唯一邮箱'
) ENGINE = InnoDB AUTO_INCREMENT = 315 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of src_user
-- ----------------------------
INSERT INTO `src_user` VALUES (1, '小白', 'e1743b364cd8965a0a9562a010386c80b537bf5e', '15289667596', '1507820362@qq.com', 1, 1, '2021-05-14', 0, '个人简介个人简介', '15287667593', '2607820372', '', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (288, '小张', '123456', '15145477596', '15450203162@qq.com', 1, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', '', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (289, '小里', '123456', '15143567894', '1545020362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', '', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (290, '小六', '123456', '15145466556', '1545020d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', '', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (291, '小黑', '123456', '15145647596', '154502d02362@qq.com', 1, 1, '2021-05-14', 0, '个人简介个', '15da675adf93', '820372', '', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (292, '小打包', '123456', '15148567596', '15450d20362@qq.com', 1, 1, '2021-05-14', 0, '个人简介个人简', '15da675adf93', '820372', '', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (293, '小aaan', '123456', '15144267596', '1545d020362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (294, '小王', '123456', '15145357596', '15450d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', '/uploads/topic/20210516\\ae409a9d4ec94973502d35bda0101594.jpg', '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (298, '周迅', '123456', '15145665896', '15450203262@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (299, '王菲', '123456', '15145665396', '1545020d2362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (300, '中国人', '123456', '15145667128', '1545024420362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (301, '大家', '123456', '15145667597', '15450202d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (302, '小路', '123456', '15145667596', '15450220362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (303, '小小王', '123456', '15145667595', '154540d20d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (304, '小哈', '123456', '15145667527', '154504270d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (305, '打野', '123456', '15145667594', '154504280d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (306, '有点', '123456', '15145667593', '1542502036d2@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (307, '五大', '123456', '15145667592', '15450d240362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (308, '周先迅', '123456', '15145667591', '125450204362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (309, '酷酷', '123456', '15145667590', '15425020d362@qq.com', 0, 1, '2021-05-14', 0, '个人简介个人简介', '15da675adf93', '820372', NULL, '2021-05-06 15:04:02');
INSERT INTO `src_user` VALUES (310, 'asdfasdf', '123456', '15287667589', 'asdfasdfa@qq.cn', 1, 0, '2021-05-15', 0, NULL, '', '', '', '2021-05-15 00:00:00');
INSERT INTO `src_user` VALUES (312, '添加用户', '3bc483c462ef6411c93d1cc529a7dbdc', '15165484520', 'adfadfad@adf.cn', 1, 1, '2021-05-09', 0, '', 'fffff', '1204551', '', '2021-05-20 14:54:48');
INSERT INTO `src_user` VALUES (313, '123456', 'e1743b364cd8965a0a9562a010386c80b537bf5e', '15212345678', 'xiaodai@aiemail.cn', 1, 1, '20001001', 0, '今天是个大好日子', 'xiaodai', '1767566191', '', '2021-05-22 10:20:12');
INSERT INTO `src_user` VALUES (314, '123', 'e1743b364cd8965a0a9562a010386c80b537bf5e', '18312345678', '1767566191@qq.com', 0, 0, NULL, 0, NULL, NULL, NULL, NULL, '2021-05-25 12:12:36');

SET FOREIGN_KEY_CHECKS = 1;
