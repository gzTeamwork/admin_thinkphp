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

 Date: 25/07/2018 19:34:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categorys
-- ----------------------------
DROP TABLE IF EXISTS `categorys`;
CREATE TABLE `categorys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sort` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `group` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `is_show` tinyint(3) unsigned DEFAULT '0',
  `is_active` tinyint(3) unsigned DEFAULT '1',
  `sort` int(11) unsigned DEFAULT '0',
  `icon` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `title` text,
  `content` text,
  `author` text,
  `category` int(10) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `thumb` text,
  `kind` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of posts
-- ----------------------------
BEGIN;
INSERT INTO `posts` VALUES (1, NULL, '', NULL, 0, '2018-07-25 00:00:00', '2018-07-25 16:51:18', NULL, 'post');
INSERT INTO `posts` VALUES (2, NULL, '<p>佛挡杀佛</p>\n<p></p>', NULL, 0, '2018-07-25 00:00:00', '2018-07-25 16:51:36', NULL, 'office');
INSERT INTO `posts` VALUES (3, NULL, '', NULL, 0, '2018-07-25 17:07:58', '2018-07-25 17:07:58', NULL, 'post');
INSERT INTO `posts` VALUES (4, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:08:23', '2018-07-25 17:08:23', NULL, 'office');
INSERT INTO `posts` VALUES (5, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:09:09', '2018-07-25 17:09:09', NULL, 'office');
INSERT INTO `posts` VALUES (6, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:09:54', '2018-07-25 17:09:54', NULL, 'office');
INSERT INTO `posts` VALUES (7, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:10:12', '2018-07-25 17:10:12', NULL, 'office');
INSERT INTO `posts` VALUES (8, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:10:51', '2018-07-25 17:10:51', NULL, 'office');
INSERT INTO `posts` VALUES (9, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:11:57', '2018-07-25 17:11:57', NULL, 'office');
INSERT INTO `posts` VALUES (10, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:12:07', '2018-07-25 17:12:07', NULL, 'post');
INSERT INTO `posts` VALUES (11, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:19:29', '2018-07-25 17:19:29', NULL, 'post');
INSERT INTO `posts` VALUES (12, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:20:41', '2018-07-25 17:20:41', NULL, 'post');
INSERT INTO `posts` VALUES (13, '什么玩意👿', '<p>哈哈哈哈</p>\n<p></p>', NULL, 40, '2018-07-25 17:21:05', '2018-07-25 17:21:05', NULL, 'office');
COMMIT;

-- ----------------------------
-- Table structure for posts_extra
-- ----------------------------
DROP TABLE IF EXISTS `posts_extra`;
CREATE TABLE `posts_extra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) DEFAULT NULL,
  `name` text,
  `value` text,
  `group` text,
  `describe` text,
  `title` text,
  `type` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of posts_extra
-- ----------------------------
BEGIN;
INSERT INTO `posts_extra` VALUES (1, 13, 'price', '0', NULL, NULL, '租金', 'number');
INSERT INTO `posts_extra` VALUES (2, 13, 'area', '0', NULL, NULL, '面积', 'number');
INSERT INTO `posts_extra` VALUES (3, 13, 'tags', NULL, NULL, NULL, '标签', 'array');
INSERT INTO `posts_extra` VALUES (4, 13, 'is_sold', '', NULL, NULL, '是否已售', 'boolean');
INSERT INTO `posts_extra` VALUES (5, 13, 'sold_time', '2018-07-25T09:21:02.806Z', NULL, NULL, '租售到期', 'datetime');
INSERT INTO `posts_extra` VALUES (6, 13, 'sold_discount', '98', NULL, NULL, '接盘折扣', 'number');
INSERT INTO `posts_extra` VALUES (7, 13, 'province', '', NULL, NULL, '省', 'string');
INSERT INTO `posts_extra` VALUES (8, 13, 'city', '', NULL, NULL, '市', 'string');
INSERT INTO `posts_extra` VALUES (9, 13, 'area', '', NULL, NULL, '区', 'string');
INSERT INTO `posts_extra` VALUES (10, 13, 'address', '', NULL, NULL, '地址', 'string');
COMMIT;

-- ----------------------------
-- Table structure for posts_template
-- ----------------------------
DROP TABLE IF EXISTS `posts_template`;
CREATE TABLE `posts_template` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `describe` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `is_active` tinyblob,
  `thumb` text,
  `author` int(20) DEFAULT NULL,
  `post_used` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user_list
-- ----------------------------
BEGIN;
INSERT INTO `user_list` VALUES (9, 'bYR_71f@cegG1530264902', 'admin', 'admin', '94a0c35ee25bce504dc392e0c0f95017', '21520993@qq.com', 1, 1, NULL, '2018-06-29 17:35:03', '2018-06-29 17:35:03', NULL);
INSERT INTO `user_list` VALUES (10, 'bYR_71f@cegG1530264901', 'admin2', 'admin2', '2', '21520993@qq.com', 1, 0, NULL, '2018-06-29 17:35:03', '2018-06-29 17:35:03', NULL);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
