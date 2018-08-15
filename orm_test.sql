/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : orm_test

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-08-15 11:44:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `orm_test`
-- ----------------------------
DROP TABLE IF EXISTS `orm_test`;
CREATE TABLE `orm_test` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID编号',
  `name` varchar(10) DEFAULT '' COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='测试表';

-- ----------------------------
-- Records of orm_test
-- ----------------------------
