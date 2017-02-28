/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : evo_maa

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-02-28 21:35:56
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adminuser
-- ----------------------------
DROP TABLE IF EXISTS `adminuser`;
CREATE TABLE `adminuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of adminuser
-- ----------------------------
INSERT INTO `adminuser` VALUES ('1', 'admin', 'sbutWLiRGGciV1psqeVc73e1xJh4uz-l', '$2y$13$1lWD3OZtvVbnVMmbmFTaXuLKpAlQW/AGKJVx1PlvczL3HmgOkbhe2', null, 'admin@admin.com', '10', '1481606559', '1481606559');
INSERT INTO `adminuser` VALUES ('2', 'evo', 'sbutWLiRGGciV1psqeVc73e1xJh4uz-l', '$2y$13$1lWD3OZtvVbnVMmbmFTaXuLKpAlQW/AGKJVx1PlvczL3HmgOkbhe2', null, 'evo@admin.com', '10', '1481606559', '1481606559');

-- ----------------------------
-- Table structure for auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_assignment
-- ----------------------------
INSERT INTO `auth_assignment` VALUES ('普通管理员', '2', '1481636347');
INSERT INTO `auth_assignment` VALUES ('站长', '1', '1481609006');

-- ----------------------------
-- Table structure for auth_item
-- ----------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_item
-- ----------------------------
INSERT INTO `auth_item` VALUES ('/admin-user/*', '2', null, null, null, '1481635690', '1481635690');
INSERT INTO `auth_item` VALUES ('/admin-user/index', '2', null, null, null, '1481635694', '1481635694');
INSERT INTO `auth_item` VALUES ('/admin/assignment/*', '2', null, null, null, '1481608893', '1481608893');
INSERT INTO `auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1481609194', '1481609194');
INSERT INTO `auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1481609201', '1481609201');
INSERT INTO `auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1481609204', '1481609204');
INSERT INTO `auth_item` VALUES ('/admin/permission/*', '2', null, null, null, '1481608900', '1481608900');
INSERT INTO `auth_item` VALUES ('/admin/permission/index', '2', null, null, null, '1481609208', '1481609208');
INSERT INTO `auth_item` VALUES ('/admin/role/*', '2', null, null, null, '1481608904', '1481608904');
INSERT INTO `auth_item` VALUES ('/admin/role/index', '2', null, null, null, '1481609215', '1481609215');
INSERT INTO `auth_item` VALUES ('/admin/route/*', '2', null, null, null, '1481608908', '1481608908');
INSERT INTO `auth_item` VALUES ('/admin/route/index', '2', null, null, null, '1481609220', '1481609220');
INSERT INTO `auth_item` VALUES ('/admin/rule/*', '2', null, null, null, '1481636001', '1481636001');
INSERT INTO `auth_item` VALUES ('/admin/rule/index', '2', null, null, null, '1481636006', '1481636006');
INSERT INTO `auth_item` VALUES ('/debug/*', '2', null, null, null, '1481635066', '1481635066');
INSERT INTO `auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1481635093', '1481635093');
INSERT INTO `auth_item` VALUES ('/gii/*', '2', null, null, null, '1481635064', '1481635064');
INSERT INTO `auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1481635105', '1481635105');
INSERT INTO `auth_item` VALUES ('修改管理员', '2', null, null, null, '1481635893', '1481635893');
INSERT INTO `auth_item` VALUES ('普通管理员', '1', null, '修改用户', null, '1481636086', '1481636263');
INSERT INTO `auth_item` VALUES ('权限控制', '2', null, null, null, '1481608947', '1481608947');
INSERT INTO `auth_item` VALUES ('站长', '1', null, null, null, '1481608973', '1481608973');
INSERT INTO `auth_item` VALUES ('调试', '2', null, null, null, '1481635042', '1481635042');

-- ----------------------------
-- Table structure for auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_item_child
-- ----------------------------
INSERT INTO `auth_item_child` VALUES ('修改管理员', '/admin-user/*');
INSERT INTO `auth_item_child` VALUES ('权限控制', '/admin/assignment/*');
INSERT INTO `auth_item_child` VALUES ('权限控制', '/admin/menu/*');
INSERT INTO `auth_item_child` VALUES ('权限控制', '/admin/permission/*');
INSERT INTO `auth_item_child` VALUES ('权限控制', '/admin/role/*');
INSERT INTO `auth_item_child` VALUES ('权限控制', '/admin/route/*');
INSERT INTO `auth_item_child` VALUES ('权限控制', '/admin/rule/*');
INSERT INTO `auth_item_child` VALUES ('调试', '/debug/*');
INSERT INTO `auth_item_child` VALUES ('调试', '/gii/*');
INSERT INTO `auth_item_child` VALUES ('普通管理员', '修改管理员');
INSERT INTO `auth_item_child` VALUES ('站长', '修改管理员');
INSERT INTO `auth_item_child` VALUES ('站长', '权限控制');
INSERT INTO `auth_item_child` VALUES ('普通管理员', '调试');
INSERT INTO `auth_item_child` VALUES ('站长', '调试');

-- ----------------------------
-- Table structure for auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of auth_rule
-- ----------------------------
INSERT INTO `auth_rule` VALUES ('修改用户', 'O:27:\"backend\\components\\UserRule\":3:{s:4:\"name\";s:12:\"修改用户\";s:9:\"createdAt\";i:1481636233;s:9:\"updatedAt\";i:1481636233;}', '1481636233', '1481636233');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(256) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` text,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '权限控制', null, null, '1', '{\"icon\":\"fa fa-lock\",\"visible\":true}');
INSERT INTO `menu` VALUES ('2', '路由', '1', '/admin/route/index', '1', null);
INSERT INTO `menu` VALUES ('3', '权限', '1', '/admin/permission/index', '2', null);
INSERT INTO `menu` VALUES ('4', '角色', '1', '/admin/role/index', '3', null);
INSERT INTO `menu` VALUES ('5', '分配', '1', '/admin/assignment/index', '4', null);
INSERT INTO `menu` VALUES ('6', '菜单', '1', '/admin/menu/index', '5', null);
INSERT INTO `menu` VALUES ('7', '调试', null, null, '2', '{\"icon\":\"fa fa-wrench\",\"visible\":true}');
INSERT INTO `menu` VALUES ('8', 'gii', '7', '/gii/default/index', '1', null);
INSERT INTO `menu` VALUES ('9', 'debug', '7', '/debug/default/index', '2', '{\"icon\":\"fa fa-bug\",\"visible\":true}');
INSERT INTO `menu` VALUES ('10', '规则', '1', '/admin/rule/index', '6', null);
INSERT INTO `menu` VALUES ('11', '管理员', null, '/admin-user/index', '3', '{\"icon\":\"fa fa-user\",\"visible\":true}');

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1481606366');
INSERT INTO `migration` VALUES ('m130524_201442_init', '1481606367');
INSERT INTO `migration` VALUES ('m161213_054721_adminuser', '1481608122');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
SET FOREIGN_KEY_CHECKS=1;
