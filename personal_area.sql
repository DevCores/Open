/*
Navicat MySQL Data Transfer

Source Server         : мой
Source Server Version : 50559
Source Host           : 185.221.152.167:3306
Source Database       : personal_area

Target Server Type    : MYSQL
Target Server Version : 50559
File Encoding         : 65001

Date: 2018-04-04 22:35:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for as_account_bonus_level
-- ----------------------------
DROP TABLE IF EXISTS `as_account_bonus_level`;
CREATE TABLE `as_account_bonus_level` (
  `guid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `totaltime` int(11) NOT NULL,
  PRIMARY KEY (`guid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_account_lk
-- ----------------------------
DROP TABLE IF EXISTS `as_account_lk`;
CREATE TABLE `as_account_lk` (
  `guid` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `cookie_key` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `bonus` int(11) NOT NULL DEFAULT '0',
  `bonus_vp` int(11) NOT NULL DEFAULT '0',
  `link_ref` varchar(255) DEFAULT NULL,
  `level` int(11) NOT NULL DEFAULT '0',
  `binding_ip` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`guid`)
) ENGINE=InnoDB AUTO_INCREMENT=838 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_account_ref
-- ----------------------------
DROP TABLE IF EXISTS `as_account_ref`;
CREATE TABLE `as_account_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `link_ref` varchar(255) NOT NULL,
  `time_reg` int(11) NOT NULL,
  `usings` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1199 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_bonus_levels
-- ----------------------------
DROP TABLE IF EXISTS `as_bonus_levels`;
CREATE TABLE `as_bonus_levels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_time` int(11) NOT NULL,
  `bonus_vp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_bonuses_code
-- ----------------------------
DROP TABLE IF EXISTS `as_bonuses_code`;
CREATE TABLE `as_bonuses_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) NOT NULL,
  `action` int(11) NOT NULL DEFAULT '0',
  `author` varchar(255) NOT NULL DEFAULT 'system',
  `time` int(11) NOT NULL,
  `bonus_vp` int(11) DEFAULT NULL,
  `bonus_dp` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_logs_pay
-- ----------------------------
DROP TABLE IF EXISTS `as_logs_pay`;
CREATE TABLE `as_logs_pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `us_login` varchar(255) NOT NULL,
  `action` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_realm
-- ----------------------------
DROP TABLE IF EXISTS `as_realm`;
CREATE TABLE `as_realm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `realm_key` varchar(255) NOT NULL DEFAULT '0',
  `db_characters` varchar(255) NOT NULL DEFAULT 'characters',
  `db_lk` varchar(255) NOT NULL DEFAULT 'personal_area',
  `db_auth` varchar(255) NOT NULL DEFAULT 'auth',
  `db_world` varchar(255) NOT NULL DEFAULT 'wolrd',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_shop
-- ----------------------------
DROP TABLE IF EXISTS `as_shop`;
CREATE TABLE `as_shop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `name_item` varchar(255) NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `sale` int(11) NOT NULL DEFAULT '0',
  `category` int(11) NOT NULL DEFAULT '0',
  `realmid` int(11) NOT NULL DEFAULT '0',
  `price_vp` int(11) NOT NULL DEFAULT '0',
  `number` int(11) NOT NULL DEFAULT '1',
  `charge` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_ticket
-- ----------------------------
DROP TABLE IF EXISTS `as_ticket`;
CREATE TABLE `as_ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `primary_ticket` int(11) NOT NULL DEFAULT '0',
  `time` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_ticket_reply
-- ----------------------------
DROP TABLE IF EXISTS `as_ticket_reply`;
CREATE TABLE `as_ticket_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `guid` int(11) NOT NULL,
  `reply` text NOT NULL,
  `time` int(11) NOT NULL,
  `author` int(11) NOT NULL,
  `access` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_verifi_email
-- ----------------------------
DROP TABLE IF EXISTS `as_verifi_email`;
CREATE TABLE `as_verifi_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vkey` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `action` int(11) NOT NULL DEFAULT '0',
  `other` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_vote
-- ----------------------------
DROP TABLE IF EXISTS `as_vote`;
CREATE TABLE `as_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vote` int(11) NOT NULL,
  `name_vote` varchar(255) NOT NULL,
  `link_vote` varchar(255) NOT NULL,
  `bonus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_vote_mmotop
-- ----------------------------
DROP TABLE IF EXISTS `as_vote_mmotop`;
CREATE TABLE `as_vote_mmotop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `time_vote` varchar(30) NOT NULL,
  `date_bonus` varchar(20) NOT NULL DEFAULT '-',
  `action` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=637 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for as_vote_time
-- ----------------------------
DROP TABLE IF EXISTS `as_vote_time`;
CREATE TABLE `as_vote_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users` varchar(255) NOT NULL,
  `time_last` int(11) NOT NULL,
  `top` varchar(255) NOT NULL,
  `action` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;
