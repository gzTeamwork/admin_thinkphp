/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : oa_attendance

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-04-09 19:56:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user_rest_days
-- ----------------------------
DROP TABLE IF EXISTS `user_rest_days`;
CREATE TABLE `user_rest_days` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` text NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `userid` varchar(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_rest_days
-- ----------------------------
INSERT INTO `user_rest_days` VALUES ('4', '2018-04-25', '2018', '04', '25', 'zhangsan', 'rest', '1523266477');
INSERT INTO `user_rest_days` VALUES ('3', '2018-04-26', '2018', '04', '26', 'zhangsan', 'rest', '1523266480');
