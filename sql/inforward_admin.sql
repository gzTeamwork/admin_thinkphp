/*
 Navicat Premium Data Transfer

 Source Server         : 本地数据库
 Source Server Type    : MySQL
 Source Server Version : 80011
 Source Host           : localhost:3306
 Source Schema         : inforward_admin

 Target Server Type    : MySQL
 Target Server Version : 80011
 File Encoding         : 65001

 Date: 27/07/2018 20:49:01
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categorys
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sort` int(11) DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyblob,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of categorys
-- ----------------------------
BEGIN;
INSERT INTO `categorys` VALUES (39, '测试一下', 'ohYeah', 0, '2018-07-25 11:09:25', '2018-07-25 11:09:25', NULL, '', 0x31);
INSERT INTO `categorys` VALUES (40, '子分类', 'childCate', 0, '2018-07-25 11:14:08', '2018-07-25 11:14:08', NULL, '子', 0x31);
INSERT INTO `categorys` VALUES (41, '子分类', 'childCate', 32, '2018-07-25 11:14:49', '2018-07-25 11:14:49', NULL, '子', 0x31);
COMMIT;

-- ----------------------------
-- Table structure for configuration
-- ----------------------------
DROP TABLE IF EXISTS `configuration`;
CREATE TABLE `configuration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of configuration
-- ----------------------------
BEGIN;
INSERT INTO `configuration` VALUES (3, 'systemName', '系统名称', 'Inforward', NULL, 'text', NULL);
INSERT INTO `configuration` VALUES (1, 'systemEnable', '系统启用', '1', NULL, 'switch', NULL);
COMMIT;

-- ----------------------------
-- Table structure for dashboard_menu
-- ----------------------------
DROP TABLE IF EXISTS `dashboard_menu`;
CREATE TABLE `dashboard_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `is_show` tinyint(3) unsigned DEFAULT '0',
  `is_active` tinyint(3) unsigned DEFAULT '1',
  `sort` int(11) unsigned DEFAULT '0',
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of dashboard_menu
-- ----------------------------
BEGIN;
INSERT INTO `dashboard_menu` VALUES (50, 'total', '统计', '/admin/total', 'total', 0, 1, 1, 0, 'timeline');
INSERT INTO `dashboard_menu` VALUES (51, 'website_total', '站点统计', '/admin/total/website', 'total', 50, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (100, 'post', '文章', '/admin/post', 'post', 0, 1, 1, 0, 'send');
INSERT INTO `dashboard_menu` VALUES (101, 'post_list', '文章列表', '/admin/post/list', 'post', 100, 1, 1, 1, NULL);
INSERT INTO `dashboard_menu` VALUES (102, 'new_post', '发布新文章', '/admin/post/publish', 'post', 100, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (200, 'category', '栏目', '/admin/category', 'category', 0, 1, 1, 0, 'list_alt');
INSERT INTO `dashboard_menu` VALUES (201, 'new_category', '添加新栏目', '/admin/category/insert', 'category', 200, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (202, 'category_list', '栏目列表', '/admin/category/list', 'category', 200, 1, 1, 1, NULL);
INSERT INTO `dashboard_menu` VALUES (300, 'user', '用户', '/admin/user', 'user', 0, 1, 1, 0, 'people');
INSERT INTO `dashboard_menu` VALUES (301, 'user_list', '用户列表', '/admin/user/list', 'user', 300, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (330, 'user_role', '角色功能', '/admin/user/role', 'user', 300, 1, 1, 30, NULL);
INSERT INTO `dashboard_menu` VALUES (340, 'user_rules', '权限', '/admin/user/rules', 'user', 300, 1, 1, 40, NULL);
INSERT INTO `dashboard_menu` VALUES (700, 'configuration', '配置', '/admin/configuration', 'configuration', 0, 1, 1, 0, 'settings');
INSERT INTO `dashboard_menu` VALUES (701, 'system_configuration', '系统配置', '/admin/configuration/sytem', 'configuration', 700, 1, 1, 0, '');
INSERT INTO `dashboard_menu` VALUES (702, 'website_configuration', '站点配置', '/admin/configuration/website', 'configuration', 700, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (2000, 'user_profile', '用户信息', '/admin/user/profile', 'userProfile', 0, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (2001, 'user_logout', '用户登出', '/admin/user/logout', 'userProfile', 0, 1, 1, 0, 'power_settings_new');
COMMIT;

-- ----------------------------
-- Table structure for posts
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `category` int(10) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `thumb` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `kind` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of posts
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES (16, '环球都会广场904AB', '<p>这就是</p>\n<p></p>', NULL, 0, '2018-07-26 15:07:17', '2018-07-26 18:34:21', NULL, 'office_unit');
INSERT INTO `posts` VALUES (17, '环球都会广场14088', '<p><span style=\"font-size: 24pt;\"><strong>离开了看见了空间克隆</strong></span></p>\n<p><span style=\"font-size: 24pt;\"><strong>啊哈哈哈</strong></span></p>\n<p><strong><img src=\"https://file.iviewui.com/dist/e6ad43e0da499aacdbae3727276acfb3.png\" alt=\"\" /></strong></p>', NULL, 0, '2018-07-26 15:24:11', '2018-07-26 19:19:23', NULL, 'office_unit');
INSERT INTO `posts` VALUES (18, NULL, '', NULL, 0, '2018-07-26 18:26:09', '2018-07-26 18:26:09', NULL, 'post');
COMMIT;

-- ----------------------------
-- Table structure for posts_extra
-- ----------------------------
DROP TABLE IF EXISTS `posts_extra`;
CREATE TABLE `posts_extra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `group` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `describe` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of posts_extra
-- ----------------------------
BEGIN;
INSERT INTO `posts_extra` VALUES (16, 16, 'price', '300', NULL, NULL, '单元租金', 'number');
INSERT INTO `posts_extra` VALUES (17, 16, 'area', '260', NULL, NULL, '面积', 'number');
INSERT INTO `posts_extra` VALUES (18, 16, 'is_sold', '', NULL, NULL, '是否已售', 'boolean');
INSERT INTO `posts_extra` VALUES (19, 17, 'price', '2500', NULL, NULL, '单元租金', 'number');
INSERT INTO `posts_extra` VALUES (20, 17, 'area', '2200', NULL, NULL, '面积', 'number');
INSERT INTO `posts_extra` VALUES (21, 17, 'is_sold', '', NULL, NULL, '是否已售', 'boolean');
INSERT INTO `posts_extra` VALUES (22, 17, 'sold_time', '2018-08-31T07:25:00.000Z', NULL, NULL, '接盘时间', 'datetime');
INSERT INTO `posts_extra` VALUES (23, 17, 'tags', '', NULL, NULL, '标签', 'array');
INSERT INTO `posts_extra` VALUES (24, 17, 'province', '', NULL, NULL, '省份', 'address');
INSERT INTO `posts_extra` VALUES (25, 17, 'city', '', NULL, NULL, '城市', 'address');
INSERT INTO `posts_extra` VALUES (26, 17, 'region', '', NULL, NULL, '镇区', 'address');
INSERT INTO `posts_extra` VALUES (27, 17, 'address', '', NULL, NULL, '详细地址', 'address');
INSERT INTO `posts_extra` VALUES (28, 17, 'discount', '98', NULL, NULL, '接盘折扣', 'number');
INSERT INTO `posts_extra` VALUES (29, 17, 'titleEn', 'IMP1408', NULL, NULL, '英文标题', 'string');
COMMIT;

-- ----------------------------
-- Table structure for posts_template
-- ----------------------------
DROP TABLE IF EXISTS `posts_template`;
CREATE TABLE `posts_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `describe` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `is_active` tinyblob,
  `thumb` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `author` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `post_used` int(20) DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of posts_template
-- ----------------------------
BEGIN;
INSERT INTO `posts_template` VALUES (10, '新的啦', 'ojbk', NULL, '2018-07-26 12:42:14', '2018-07-26 12:46:48', '', NULL, 'system', 0, '[{\"title\":\"12312\",\"name\":\"444\",\"value\":\"\",\"type\":\"string\"},{\"title\":\"\\u57ce\\u5e02\",\"name\":\"area\",\"value\":\"\",\"type\":\"number\"}]');
INSERT INTO `posts_template` VALUES (11, '写字楼单元', 'office_unit', NULL, '2018-07-26 14:06:24', '2018-07-26 15:27:57', '', NULL, 'system', 0, '[{\"title\":\"\\u5355\\u5143\\u79df\\u91d1\",\"name\":\"price\",\"value\":\"\",\"type\":\"number\"},{\"title\":\"\\u9762\\u79ef\",\"name\":\"area\",\"value\":\"\",\"type\":\"number\"},{\"title\":\"\\u662f\\u5426\\u5df2\\u552e\",\"name\":\"is_sold\",\"value\":\"\",\"type\":\"boolean\"},{\"title\":\"\\u63a5\\u76d8\\u65f6\\u95f4\",\"name\":\"sold_time\",\"value\":\"\",\"type\":\"datetime\"},{\"title\":\"\\u6807\\u7b7e\",\"name\":\"tags\",\"value\":\"\",\"type\":\"array\"},{\"title\":\"\\u7701\\u4efd\",\"name\":\"province\",\"value\":\"\",\"type\":\"address\"},{\"title\":\"\\u57ce\\u5e02\",\"name\":\"city\",\"value\":\"\",\"type\":\"address\"},{\"title\":\"\\u9547\\u533a\",\"name\":\"region\",\"value\":\"\",\"type\":\"address\"},{\"title\":\"\\u8be6\\u7ec6\\u5730\\u5740\",\"name\":\"address\",\"value\":\"\",\"type\":\"address\"},{\"title\":\"\\u63a5\\u76d8\\u6298\\u6263\",\"name\":\"discount\",\"value\":\"\",\"type\":\"number\"},{\"title\":\"\\u6807\\u9898\\u82f1\\u6587\",\"name\":\"tittleEn\",\"value\":\"\",\"type\":\"string\"}]');
COMMIT;

-- ----------------------------
-- Table structure for role_list
-- ----------------------------
DROP TABLE IF EXISTS `role_list`;
CREATE TABLE `role_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of role_list
-- ----------------------------
BEGIN;
INSERT INTO `role_list` VALUES (1, '超级管理员', 'rootAdmin', '0', NULL, NULL, 1);
INSERT INTO `role_list` VALUES (2, '分担分担', 'rootAdmin2', NULL, '2018-07-10 17:32:30', '2018-07-10 17:32:30', 0);
COMMIT;

-- ----------------------------
-- Table structure for user_list
-- ----------------------------
DROP TABLE IF EXISTS `user_list`;
CREATE TABLE `user_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `union_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  `telphone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `role_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of user_list
-- ----------------------------
BEGIN;
INSERT INTO `user_list` VALUES (9, 'bYR_71f@cegG1530264902', 'admin', 'admin', '94a0c35ee25bce504dc392e0c0f95017', '21520993@qq.com', 1, 1, NULL, '2018-06-29 17:35:03', '2018-06-29 17:35:03', NULL);
INSERT INTO `user_list` VALUES (10, 'bYR_71f@cegG1530264901', 'admin2', 'admin2', '2', '21520993@qq.com', 1, 0, NULL, '2018-06-29 17:35:03', '2018-06-29 17:35:03', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
