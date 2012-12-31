-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 31, 2012 at 12:37 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfim`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
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

DROP TABLE IF EXISTS `captcha`;
CREATE TABLE IF NOT EXISTS `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

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
(14, 1356675456, '::1', 'trePWc'),
(15, 1356676537, '117.196.167.3', 'famCzJ'),
(16, 1356677121, '::1', 'BoJUtO'),
(17, 1356677232, '117.196.167.3', 'khKcZu'),
(18, 1356677250, '117.196.167.3', 'QyKkut'),
(19, 1356703082, '::1', 'hmaaNP'),
(20, 1356703096, '::1', 'nptrVa'),
(21, 1356710058, '::1', 'uPAScS'),
(22, 1356710120, '::1', 'RKECMM'),
(23, 1356713312, '::1', 'jijzRb'),
(24, 1356713399, '::1', 'GoJXCt'),
(25, 1356713399, '::1', 'QObcdp'),
(26, 1356714302, '::1', 'OLuthW'),
(27, 1356716569, '122.172.241.98', 'DCZjuU'),
(28, 1356716638, '122.172.241.98', 'LQVWNz'),
(29, 1356723920, '::1', 'DfCfMP'),
(30, 1356773266, '::1', 'xhtKof'),
(31, 1356777456, '122.166.175.33', 'avcquW'),
(32, 1356777503, '122.166.175.33', 'bAIqXK'),
(33, 1356777523, '122.166.175.33', 'qRSqXG'),
(34, 1356777546, '122.166.175.33', 'ocAbcI'),
(35, 1356777563, '122.166.175.33', 'fogkTr'),
(36, 1356777579, '122.166.175.33', 'jEBuZt'),
(37, 1356777600, '122.166.175.33', 'qqISiT'),
(38, 1356777622, '122.166.175.33', 'ozYMrE'),
(39, 1356777635, '122.166.175.33', 'OcRhue'),
(40, 1356777636, '122.166.175.33', 'zCcuvZ'),
(41, 1356777639, '122.166.175.33', 'RJrvLC'),
(42, 1356777815, '122.166.175.33', 'mSWFma'),
(43, 1356777846, '122.166.175.33', 'oRuDVc'),
(44, 1356777871, '122.166.175.33', 'QHavmJ'),
(45, 1356789106, '::1', 'nWEZtc'),
(46, 1356802053, '::1', 'xtptsG'),
(47, 1356855874, '::1', 'oVewWI'),
(48, 1356891001, '::1', 'VIeSlO'),
(49, 1356891019, '::1', 'lVZTBo'),
(50, 1356891033, '::1', 'IXkcVn'),
(51, 1356892393, '::1', 'kMJhMY'),
(52, 1356892413, '::1', 'eXIafm'),
(53, 1356899128, '::1', 'uRzjfD'),
(54, 1356903696, '::1', 'nKeLtt'),
(55, 1356903698, '::1', 'PmiGWR'),
(56, 1356933954, '::1', 'tuTzyP'),
(57, 1356948251, '::1', 'cBSrOV'),
(58, 1356950159, '::1', 'IvPovG');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

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
(42, 'Charleston');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderNumber` varchar(15) NOT NULL,
  `projectId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `body` text NOT NULL,
  `attachments` varchar(100) NOT NULL COMMENT 'document ids csv',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `counter` varchar(100) NOT NULL COMMENT 'member ids csv',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `orderNumber`, `projectId`, `memberId`, `body`, `attachments`, `timestamp`, `counter`) VALUES
(1, '1', 45, 2, 'This project is good!!', '', '2012-12-27 13:16:52', ',2'),
(2, '1.1.1', 45, 2, 'I''m responding to this', '', '2012-12-30 14:33:00', ''),
(3, '1.2.1', 45, 2, 'This is another response by a random person', '', '2012-12-30 14:33:00', ''),
(4, '1.3.2', 45, 2, 'This is a team response', '', '2012-12-30 14:33:39', ''),
(5, '1.4.2', 45, 2, 'This is another team response', '', '2012-12-30 14:33:39', ''),
(6, '2', 45, 3, 'Just another root comment!', '', '2012-12-30 17:01:34', ''),
(7, '2.1.1', 45, 2, 'Don''t post random comments on here.', '', '2012-12-30 17:01:34', ''),
(8, '2.2.2', 45, 3, 'I can do anything I want!', '', '2012-12-30 17:01:34', ''),
(9, '3', 45, 2, 'Root comments are so cool guys!ZZ*&!', '', '2012-12-30 17:08:17', ''),
(10, '3.1.1', 45, 3, 'You said we couldn''t post random comments =/', '', '2012-12-30 17:08:17', ''),
(11, '3.2.2', 45, 2, 'I lied! :D', '', '2012-12-30 17:08:17', '');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `projectId` int(11) NOT NULL,
  `size` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `filename`, `timestamp`, `projectId`, `size`) VALUES
(7, '.htaccess', '2012-12-27 10:31:15', 46, 1),
(8, 'CFIM+Projects.xls', '2012-12-27 10:31:15', 46, 114),
(9, 'CFIMProject.txt', '2012-12-27 10:31:15', 46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobtitles`
--

DROP TABLE IF EXISTS `jobtitles`;
CREATE TABLE IF NOT EXISTS `jobtitles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jobtitles`
--

INSERT INTO `jobtitles` (`id`, `name`) VALUES
(1, 'Systems Admin'),
(2, 'DB Admin'),
(3, 'ASE'),
(4, 'Subject Matter Expert');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` int(1) NOT NULL COMMENT '1 - Supervisor; 2 - Admin; 3 - Member; 4 - Finance',
  `titleId` int(3) NOT NULL,
  `status` varchar(10) NOT NULL,
  `subordinates` varchar(100) NOT NULL,
  `officeEmail` varchar(50) NOT NULL,
  `otherEmail` varchar(50) NOT NULL,
  `contactTel1` varchar(12) NOT NULL,
  `contactTel2` int(12) NOT NULL,
  `projects` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `memberName`, `username`, `password`, `rank`, `titleId`, `status`, `subordinates`, `officeEmail`, `otherEmail`, `contactTel1`, `contactTel2`, `projects`) VALUES
(1, 'Administrator', 'admin', '4fcab400858d58a02b48f097bfdbc411e838ee12', 2, 1, 'Active', '', 'admin@gmail.com', 'adminother@gmail.com', '2856547853', 2147483647, NULL),
(2, 'John Connor', 'dm1', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 3, '2', '', 'dm1@gmail.com', 'dm1other@gmail.com', '2856547853', 2147483647, ',45,46,47,48,49,50,51,52,53,54,55,56'),
(3, 'Jane Doe', 'dm2', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 4, 'Active', '', 'dm2@gmail.com', 'dm2other@gmail.com', '12345', 2147483647, ',45,46'),
(8, 'Amala George', 'ammu', '4fcab400858d58a02b48f097bfdbc411e838ee12', 2, 4, 'Active', '2,3', 'albinin0002@gmail.com', 'albinin0002@gmail.com', '9620732469', 2147483647, NULL),
(9, 'James Randall', 'godfrzero', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 1, 'Active', '', '', '', '', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `leaderId`, `sectorId`, `subSectorId`, `geoRegion`, `city`, `discussionDate`, `status`, `members`, `documents`, `dealSize`, `companyName`, `companyAddress`, `contactPerson`, `contactEmail`, `contactTel`) VALUES
(45, 'Dummy Project', 2, 2, 4, 1, 1, '2012-12-27', 'Preliminary', '3', '', 12, 'red', 'asdas', 'adasd', '', 0),
(46, 'Dummy Project 3', 2, 2, 4, 1, 1, '01/17/2013', 'Preliminary', '3', ',7,8,9', 4, 'ads', '', 'asd', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

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

DROP TABLE IF EXISTS `sectors`;
CREATE TABLE IF NOT EXISTS `sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subsectorOf` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `subsectorOf`) VALUES
(1, 'Sector A', 0),
(2, 'Sector B', 0),
(3, 'Sector C', 1),
(4, 'Sector D', 2),
(5, 'Sector 9', 1),
(6, 'Sector Format', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
