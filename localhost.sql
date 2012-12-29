-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2012 at 08:25 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfim`
--
DROP DATABASE `cfim`;
CREATE DATABASE `cfim` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cfim`;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `accessible By` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(1, 1356464829, '::1', 'UvAOgi'),
(2, 1356504329, '117.196.137.37', 'fzckOY'),
(3, 1356504458, '::1', 'uzWzjf'),
(4, 1356529180, '::1', 'zbpPdG'),
(5, 1356577637, '::1', 'jMTSxr'),
(6, 1356577652, '::1', 'sGvEQq'),
(7, 1356578947, '::1', 'TotuaH'),
(8, 1356591456, '::1', 'cqasDB'),
(9, 1356597745, '::1', 'SEPKHE'),
(10, 1356604191, '::1', 'wRkNnF'),
(11, 1356604193, '::1', 'CAWknL'),
(12, 1356605998, '::1', 'XKOjuE'),
(13, 1356614977, '::1', 'YnjQEy'),
(14, 1356616727, '::1', 'xHSvSP'),
(15, 1356617596, '::1', 'ogTkFr'),
(16, 1356619340, '::1', 'glDiON'),
(17, 1356632353, '::1', 'GXLJqB'),
(18, 1356665590, '::1', 'lpXtns'),
(19, 1356677148, '::1', 'emnkNk'),
(20, 1356685068, '::1', 'ahyqAS'),
(21, 1356696555, '::1', 'CWsvKu'),
(22, 1356697422, '::1', 'pijvrt'),
(23, 1356710963, '::1', 'TYiOmv'),
(24, 1356713466, '::1', 'AFGcZh'),
(25, 1356714274, '::1', 'tbLHws'),
(26, 1356715669, '::1', 'orZsGU'),
(27, 1356715678, '::1', 'YjOBzs'),
(28, 1356766660, '::1', 'cSzldd'),
(29, 1356783430, '::1', 'DzOpvL'),
(30, 1356802062, '::1', 'gWQHos'),
(31, 1356805335, '::1', 'TEuNyb'),
(32, 1356808699, '::1', 'pwoeJB');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Ashdown'),
(2, 'Atkins'),
(3, 'Augusta'),
(4, 'Austin'),
(5, 'Avoca'),
(6, 'Bald Knob '),
(7, 'Barling '),
(8, 'Batesville '),
(9, 'Bauxite'),
(10, 'Bay'),
(11, 'Bearden'),
(12, 'Beebe'),
(13, 'Beedeville'),
(14, 'Bella Vista'),
(15, 'Belleville'),
(16, 'Benton (city)'),
(17, 'Bentonville'),
(18, 'Berryville'),
(19, 'Bethel Heights'),
(20, 'Black Rock'),
(21, 'Blevins'),
(22, 'Blue Mountain'),
(23, 'Blytheville'),
(24, 'Bonanza'),
(26, 'Bono'),
(25, 'Booneville'),
(27, 'Bradley (city)'),
(28, 'Branch'),
(29, 'Briarcliff'),
(30, 'Brinkley'),
(31, 'Brookland'),
(32, 'Bryant'),
(33, 'Bull Shoals'),
(34, 'Cabot'),
(35, 'Caddo Valley'),
(36, 'Calico Rock'),
(37, 'Camden'),
(38, 'Caraway'),
(39, 'Carlisle'),
(40, 'Cave Springs'),
(41, 'Centerton'),
(42, 'Charleston'),
(47, 'Cit');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderNumber` varchar(15) NOT NULL,
  `projectId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `body` text NOT NULL,
  `attachments` varchar(100) NOT NULL COMMENT 'document ids csv',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `counter` varchar(100) NOT NULL COMMENT 'member ids csv',
  PRIMARY KEY (`id`),
  UNIQUE KEY `projectId` (`projectId`,`orderNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `orderNumber`, `projectId`, `memberId`, `body`, `attachments`, `timestamp`, `counter`) VALUES
(3, '1', 45, 2, 'This project is good!!', '', '2012-12-27 15:23:35', ''),
(5, '2', 45, 2, 'This project is good!!', '', '2012-12-27 15:24:25', ''),
(11, '2', 46, 3, 'This project is good!!', '', '2012-12-27 15:30:16', ''),
(14, '1-1-1', 45, 2, 'WoW!!! Comments!! YAAAYY!!', '', '2012-12-29 18:59:36', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `projectId` int(11) NOT NULL,
  `size` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `filename`, `timestamp`, `projectId`, `size`) VALUES
(7, '.htaccess', '2012-12-27 10:31:15', 46, 1),
(8, 'CFIM+Projects.xls', '2012-12-27 10:31:15', 46, 114),
(9, 'CFIMProject.txt', '2012-12-27 10:31:15', 46, 1),
(11, 'Final-FI-28.9.11.pdf', '2012-12-28 12:11:25', 47, 135),
(12, 'TreeListRecursion.pdf', '2012-12-28 12:23:15', 49, 41),
(13, 'LinkedListBasics.pdf', '2012-12-28 12:23:15', 49, 46);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL,
  `projectId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `update` text NOT NULL,
  `attachments` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expenses` int(10) NOT NULL COMMENT 'null if update',
  `voucher` text NOT NULL,
  `reviewedBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobtitles`
--

CREATE TABLE IF NOT EXISTS `jobtitles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jobtitles`
--

INSERT INTO `jobtitles` (`id`, `name`) VALUES
(1, 'Systems Admin'),
(2, 'DB Admin'),
(3, 'ASE'),
(4, 'Subject Matter Expert'),
(5, 'Sweeper');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` int(1) NOT NULL COMMENT '1 - Supervisor; 2 - Admin; 3 - Member; 4 - Finance',
  `titleId` int(3) NOT NULL,
  `status` bit(1) NOT NULL COMMENT '0 - Suspended, 1 - Active',
  `subordinates` varchar(100) NOT NULL,
  `officeEmail` varchar(50) NOT NULL,
  `otherEmail` varchar(50) NOT NULL,
  `contactTel1` varchar(12) NOT NULL,
  `contactTel2` int(12) NOT NULL,
  `projects` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `memberName`, `username`, `password`, `rank`, `titleId`, `status`, `subordinates`, `officeEmail`, `otherEmail`, `contactTel1`, `contactTel2`, `projects`) VALUES
(1, 'Administrator', 'admin', '4fcab400858d58a02b48f097bfdbc411e838ee12', 2, 1, '1', '', 'admin@gmail.com', 'adminother@gmail.com', '2856547853', 2147483647, ''),
(2, 'Dummy Member 1', 'dm1', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 3, '1', '', 'dm1@gmail.com', 'dm1other@gmail.com', '2856547853', 2147483647, ',45,46,48,49'),
(3, 'Dummy Member 2', 'dm2', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 4, '1', '', 'dm2@gmail.com', 'dm2other@gmail.com', '12345', 2147483647, ',45,46,47'),
(8, 'Amala George', 'ammu', '4fcab400858d58a02b48f097bfdbc411e838ee12', 2, 4, '1', '2,3', 'albinin0002@gmail.com', 'albinin0002@gmail.com', '9620732469', 2147483647, ''),
(9, 'Dummy Member 3', 'dm3', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 3, '1', '', '', '', '', 0, ',48,47'),
(10, 'Dummy Member 4', 'dm4', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 3, '1', '9', 'dm4@asdas.com', '', '954646546', 23121984, ',49'),
(11, 'Member 2', 'dm5', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 2, '1', '', 'admin@gmail.com', 'adminother@gmail.com', '2856547853', 2147483647, '');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `leaderId` int(10) NOT NULL,
  `sectorId` int(11) NOT NULL,
  `subSectorId` int(11) NOT NULL,
  `geoRegion` int(2) NOT NULL,
  `city` int(2) NOT NULL,
  `discussionDate` varchar(12) NOT NULL,
  `status` enum('Preliminary','In-depth DD','On-Going','Invested','Pending','Rejected','Exited') NOT NULL DEFAULT 'Preliminary',
  `members` varchar(100) NOT NULL,
  `documents` varchar(100) NOT NULL,
  `dealSize` int(11) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `companyAddress` text NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `contactEmail` varchar(100) NOT NULL,
  `contactTel` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `leaderId`, `sectorId`, `subSectorId`, `geoRegion`, `city`, `discussionDate`, `status`, `members`, `documents`, `dealSize`, `companyName`, `companyAddress`, `contactPerson`, `contactEmail`, `contactTel`) VALUES
(45, 'Dummy Project', 2, 2, 4, 1, 1, '01/17/2013', 'Preliminary', '3', '', 12, 'red', 'asdas', 'adasd', '', 0),
(46, 'Dummy Project 3', 2, 2, 4, 1, 1, '01/17/2013', 'Preliminary', '3', ',7,8,9', 4, 'ads', '', 'asd', '', 0),
(47, 'Dummy Project 2', 3, 16, 17, 37, 47, '12/29/2012', 'In-depth DD', '9', '11', 111, 'HAHAHA', 'asdas', 'adasd', 'asdasd@gmail.com', 987987),
(48, 'Dummy Project 1', 9, 2, 15, 1, 1, '12/29/2012', 'Invested', '2', '', 12, 'ads', 'asdas', 'Person', 'asdasd@adsad.com', 12345);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`) VALUES
(1, 'Anhui Province'),
(2, 'Beijing Municipality'),
(3, 'Chongqing Municipality'),
(4, 'Fujian Province'),
(5, 'Gansu Province'),
(6, 'Guangdong Province'),
(7, 'Guangxi Zhuang Autonomous Region'),
(8, 'Guizhou Province'),
(9, 'Hainan Province'),
(10, 'Hebei Province'),
(11, 'Heilongjiang Province'),
(12, 'Henan Province'),
(13, 'Hong Kong Special Administrative Region'),
(14, 'Hubei Province'),
(15, 'Hunan Province'),
(16, 'Inner Mongolia Autonomous Region'),
(17, 'Jiangsu Province'),
(18, 'Jiangxi Province'),
(19, 'Jilin Province'),
(20, 'Liaoning Province'),
(21, 'Macau Special Administrative Region'),
(22, 'Ningxia Hui Autonomous Region'),
(37, 'Prov'),
(23, 'Qinghai Province'),
(24, 'Shaanxi Province'),
(25, 'Shandong Province'),
(26, 'Shanghai Municipality'),
(27, 'Shanxi Province'),
(28, 'Sichuan Province'),
(29, 'Taiwan Province †'),
(30, 'Tianjin Municipality'),
(31, 'Tibet Autonomous Region'),
(32, 'Xinjiang Uyghur Autonomous Region'),
(33, 'Yunnan Province'),
(34, 'Zhejiang Province');

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE IF NOT EXISTS `sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subsectorOf` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `subsectorOf`) VALUES
(1, 'Sector A', 0),
(2, 'Sector B', 0),
(3, 'Sector C', 1),
(4, 'Sector D', 2),
(15, 'Sector E', 2),
(16, 'Sec', 0),
(17, 'SubSec', 16);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
