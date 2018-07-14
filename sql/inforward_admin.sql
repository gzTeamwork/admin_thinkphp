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

 Date: 30/06/2018 20:08:03
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

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
  `isShow` tinyint(3) unsigned DEFAULT '0',
  `isActive` tinyint(3) unsigned DEFAULT '1',
  `sort` int(11) unsigned DEFAULT '0',
  `icon` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of dashboard_menu
-- ----------------------------
BEGIN;
INSERT INTO `dashboard_menu` VALUES (50, 'total', '统计', '/admin/total', 'total', 0, 1, 1, 0, 'timeline');
INSERT INTO `dashboard_menu` VALUES (51, 'website_total', '站点统计', '/admin/total/website', 'total', 50, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (100, 'post', '文章', '/admin/post', 'post', 0, 1, 1, 0, 'send');
INSERT INTO `dashboard_menu` VALUES (101, 'post_list', '文章列表', '/admin/post/list', 'post', 100, 1, 1, 1, NULL);
INSERT INTO `dashboard_menu` VALUES (102, 'new_post', '发布新文章', '/admin/post/public', 'post', 100, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (200, 'category', '栏目', '/admin/category', 'category', 0, 1, 1, 0, 'list_alt');
INSERT INTO `dashboard_menu` VALUES (201, 'new_category', '添加新栏目', '/admin/category/insert', 'category', 200, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (300, 'user', '用户', '/admin/user', 'user', 0, 1, 1, 0, 'people');
INSERT INTO `dashboard_menu` VALUES (301, 'user_list', '用户列表', '/admin/user/list', 'user', 300, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (330, 'user_role', '角色', '/admin/user/role', 'user', 300, 1, 1, 30, NULL);
INSERT INTO `dashboard_menu` VALUES (340, 'user_rules', '权限', '/admin/user/rules', 'user', 300, 1, 1, 40, NULL);
INSERT INTO `dashboard_menu` VALUES (700, 'configuration', '配置', '/admin/configuration', 'configuration', 0, 1, 1, 0, 'settings');
INSERT INTO `dashboard_menu` VALUES (701, 'system_configuration', '系统配置', '/admin/configuration/sytem', 'configuration', 700, 1, 1, 0, '');
INSERT INTO `dashboard_menu` VALUES (702, 'website_configuration', '站点配置', '/admin/configuration/website', 'configuration', 700, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (2000, 'user_profile', '用户信息', '/admin/user/profile', 'userProfile', 0, 1, 1, 0, NULL);
INSERT INTO `dashboard_menu` VALUES (2001, 'user_logout', '登出', '/admin/user/logout', 'userProfile', 0, 1, 1, 0, 'power_settings_new');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
