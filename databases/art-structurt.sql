/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 80028
Source Host           : localhost:3306
Source Database       : art

Target Server Type    : MYSQL
Target Server Version : 80028
File Encoding         : 65001

Date: 2022-05-27 16:53:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for artists
-- ----------------------------
DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `ArtistID` int NOT NULL AUTO_INCREMENT,
  `ArtistName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Nationality` varchar(50) DEFAULT NULL,
  `Gender` varchar(1) DEFAULT 'M',
  `YearOfBirth` int DEFAULT '0',
  `YearOfDeath` int DEFAULT '0',
  `Details` longtext,
  `ArtistLink` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ArtistID`),
  KEY `ArtistID` (`ArtistID`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for arts
-- ----------------------------
DROP TABLE IF EXISTS `arts`;
CREATE TABLE `arts` (
  `ArtID` int NOT NULL AUTO_INCREMENT COMMENT '艺术品的唯一id标识',
  `ArtistID` int DEFAULT '0' COMMENT '艺术家（作者）的id',
  `ImageFileName` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '作品的图片名',
  `Title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '艺术品名',
  `AccessionDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '艺术品的发布日期',
  `AccessionUserID` int DEFAULT '0' COMMENT '发布艺术品的用户id',
  `Description` longtext CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '艺术品的描述',
  `Year` int DEFAULT '0' COMMENT '艺术品的创作年份',
  `Width` int DEFAULT NULL COMMENT '宽度',
  `Height` int DEFAULT NULL COMMENT '高度',
  `Price` decimal(19,4) DEFAULT '700.0000' COMMENT '艺术品售价',
  `State` bit(1) DEFAULT b'0' COMMENT '是否已售出',
  `VersionNumber` int DEFAULT '0' COMMENT '艺术品发布以来的版本号，表示艺术品的修改次数',
  `VisitTimes` int DEFAULT '0' COMMENT '该艺术品的被访问次数',
  `EraID` int DEFAULT '0' COMMENT '艺术品所处时代id',
  `GenreID` int DEFAULT '0' COMMENT '艺术品风格id',
  PRIMARY KEY (`ArtID`),
  UNIQUE KEY `ImageFileName` (`ImageFileName`),
  KEY `ArtistID` (`ArtistID`),
  KEY `Title` (`Title`),
  KEY `PaintingID` (`ArtID`)
) ENGINE=InnoDB AUTO_INCREMENT=600 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for carts
-- ----------------------------
DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `CartID` int NOT NULL AUTO_INCREMENT COMMENT '艺术品购物车id',
  `UserID` int DEFAULT '0' COMMENT '该购物车记录的用户id',
  `ArtID` int DEFAULT NULL COMMENT '该购物车记录的艺术品id',
  `ArtVersion` int DEFAULT '0' COMMENT '该购物车的艺术品版本号（被修改后版本）',
  PRIMARY KEY (`CartID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='加入购物车的艺术品信息';

-- ----------------------------
-- Table structure for eras
-- ----------------------------
DROP TABLE IF EXISTS `eras`;
CREATE TABLE `eras` (
  `EraID` int NOT NULL AUTO_INCREMENT,
  `EraName` varchar(255) DEFAULT NULL,
  `EraYears` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`EraID`),
  KEY `EraID` (`EraID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `GenreID` int NOT NULL AUTO_INCREMENT,
  `GenreName` varchar(50) NOT NULL,
  `EraID` int DEFAULT NULL,
  `Description` longtext,
  `Link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`GenreID`),
  UNIQUE KEY `GenreName` (`GenreName`),
  KEY `GenreID` (`GenreID`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for orderdetails
-- ----------------------------
DROP TABLE IF EXISTS `orderdetails`;
CREATE TABLE `orderdetails` (
  `OrderDetailID` int NOT NULL,
  `OrderID` int DEFAULT NULL,
  `PaintingID` int DEFAULT NULL,
  `FrameID` int DEFAULT NULL,
  `GlassID` int DEFAULT NULL,
  `MattID` int DEFAULT NULL,
  PRIMARY KEY (`OrderDetailID`),
  KEY `FrameID` (`FrameID`),
  KEY `GlassID` (`GlassID`),
  KEY `MattID` (`MattID`),
  KEY `OrderID` (`OrderID`),
  KEY `PaintingID` (`PaintingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `OrderID` int NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `PayUserID` int DEFAULT '0' COMMENT '付款方（买艺术品的用户id）',
  `ReceiveUSerID` int DEFAULT '0' COMMENT '收款方（卖艺术品）的用户id',
  `Date` datetime DEFAULT NULL COMMENT '交易日期',
  `Price` int DEFAULT '0' COMMENT '该订单交易金额',
  PRIMARY KEY (`OrderID`)
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `RatingID` int NOT NULL,
  `PaintingID` int DEFAULT NULL,
  `ReviewDate` datetime DEFAULT NULL,
  `Rating` int DEFAULT NULL,
  `Comment` longtext,
  PRIMARY KEY (`RatingID`),
  KEY `PaintingID` (`PaintingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for userlogon
-- ----------------------------
DROP TABLE IF EXISTS `userlogon`;
CREATE TABLE `userlogon` (
  `UserID` int NOT NULL,
  `Token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ExpirationTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `UserID` int NOT NULL AUTO_INCREMENT COMMENT '用户唯一表示',
  `UserName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT '' COMMENT '哈希加盐后的密码',
  `Salt` varchar(255) DEFAULT '' COMMENT '密码的盐',
  `Balance` int DEFAULT '0' COMMENT '用户的余额',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb3;

-- ----------------------------
-- Table structure for visits
-- ----------------------------
DROP TABLE IF EXISTS `visits`;
CREATE TABLE `visits` (
  `VisitID` int NOT NULL,
  `PaintingID` int DEFAULT NULL,
  `DateViewed` datetime DEFAULT NULL,
  `IpAddress` varchar(255) DEFAULT NULL,
  `CountryCode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`VisitID`),
  KEY `CountryCode` (`CountryCode`),
  KEY `PaintingID` (`PaintingID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
