-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2013 at 05:34 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(127, 1357528019, '::1', 'AhhoiC'),
(128, 1357533249, '::1', 'mePTGY');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `orderNumber`, `projectId`, `memberId`, `body`, `attachments`, `timestamp`, `counter`) VALUES
(1, '1', 45, 2, 'This project is good!!', '', '2012-12-26 20:46:52', ',2,9'),
(2, '1.1.1', 45, 2, 'I''m responding to this', '', '2012-12-29 22:03:00', ''),
(3, '1.2.1', 45, 2, 'This is another response by a random person', '', '2012-12-29 22:03:00', ''),
(4, '1.3.2', 45, 2, 'This is a team response', '', '2012-12-29 22:03:39', ''),
(5, '1.4.2', 45, 2, 'This is another team response', '', '2012-12-29 22:03:39', ''),
(6, '2', 45, 3, 'Just another root comment!', '', '2012-12-30 00:31:34', ',9'),
(7, '2.1.1', 45, 2, 'Don''t post random comments on here.', '', '2012-12-30 00:31:34', ''),
(8, '2.2.2', 45, 3, 'I can do anything I want!', '', '2012-12-30 00:31:34', ''),
(9, '3', 45, 2, 'Root comments are so cool guys!ZZ*&!', '', '2012-12-30 00:38:17', ',9'),
(10, '3.1.1', 45, 3, 'You said we couldn''t post random comments =/', '', '2012-12-30 00:38:17', ''),
(11, '3.2.2', 45, 2, 'I lied! :D', '', '2012-12-30 00:38:17', ''),
(12, '1', 63, 2, 'Oh, WoW!! A precious comment!!', '', '2013-01-01 01:28:27', ''),
(13, '1', 64, 2, 'This is the latest project!!', '', '2013-01-01 12:10:10', ''),
(14, '2', 64, 2, 'AHA!!! Another Comment!!', '', '2013-01-01 12:13:00', ''),
(15, '1.1.2', 64, 2, 'Okay', '', '2013-01-03 01:38:39', ''),
(16, '4', 45, 9, 'Heh, respond shouldn''t be showing up for this....I think.', '', '2013-01-03 01:48:01', ''),
(17, '1', 65, 10, 'AHA!! A new comment!!', '', '2013-01-05 11:53:55', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `filename`, `timestamp`, `projectId`, `size`) VALUES
(7, '.htaccess', '2012-12-26 18:01:15', 46, 1),
(9, 'CFIMProject.txt', '2012-12-26 18:01:15', 46, 1),
(10, 'pages.sql', '2012-12-31 15:06:21', 57, 277),
(11, 'sliderRight.png', '2012-12-31 15:06:21', 57, 63),
(12, 'mix_db_Fresh.sql', '2012-12-31 15:07:45', 58, 6),
(13, 'sliderRight.png', '2013-01-02 23:26:45', 65, 63),
(14, 'sliderRight.png', '2013-01-03 00:21:43', 48, 63),
(15, 'viewPriceTable.php', '2013-01-03 00:21:44', 48, 7),
(16, '[isoHunt]_download.torrent', '2013-01-06 09:09:51', 65, 20),
(17, 'apache_pb.gif', '2013-01-06 09:10:59', 65, 2),
(18, 'apache_pb2.gif', '2013-01-06 09:10:59', 65, 2),
(19, 'apache_pb2_ani.gif', '2013-01-06 09:11:00', 65, 2);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL,
  `reviewedBy` int(11) NOT NULL,
  `updateBody` text NOT NULL,
  `attachments` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expense` decimal(10,2) NOT NULL,
  `voucher` varchar(50) NOT NULL,
  `status` enum('Pending','Approved','Rejected','') NOT NULL DEFAULT 'Pending',
  `statusReason` varchar(100) NOT NULL DEFAULT 'Not Reviewed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `projectId`, `memberId`, `reviewedBy`, `updateBody`, `attachments`, `timestamp`, `expense`, `voucher`, `status`, `statusReason`) VALUES
(1, 45, 2, 0, 'genius', '', '2013-01-03 00:45:19', 500.30, '', 'Pending', 'Not Reviewed'),
(2, 45, 2, 0, 'Update', '', '2013-01-03 03:29:48', 0.00, '', 'Pending', 'Not Reviewed'),
(3, 45, 2, 0, 'Expense', '', '2013-01-03 03:30:15', 920.00, '', 'Pending', 'Not Reviewed'),
(4, 65, 10, 11, 'Super Expense', '', '2013-01-05 11:54:19', 150.00, '', 'Approved', 'Hmmm, this seems ok =/'),
(5, 65, 10, 0, 'What the hell is this shit??', '16', '2013-01-06 09:09:51', 0.00, '', 'Pending', 'Not Reviewed'),
(6, 65, 10, 11, 'This is an expense by the super!!', '17', '2013-01-06 09:11:00', 2.00, '18,19', 'Rejected', 'WTF is this??');

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
(2, 'John Connor', 'dummy1', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 3, '1', '', 'dm1@gmail.com', 'dm1other@gmail.com', '2856547853', 2147483647, ',45,46,47,48,49,50,51,52,53,54,55,56,57,58,63,64,6'),
(3, 'Jane Doe', 'dm2', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 4, 'Active', '', 'dm2@gmail.com', 'dm2other@gmail.com', '12345', 2147483647, ',45,46,57,58,63,64,65,66,48'),
(8, 'Amala George', 'ammu', '4fcab400858d58a02b48f097bfdbc411e838ee12', 2, 4, 'Active', '2,3', 'albinin0002@gmail.com', 'albinin0002@gmail.com', '9620732469', 2147483647, NULL),
(9, 'James Randall', 'godfrzero', '4fcab400858d58a02b48f097bfdbc411e838ee12', 3, 1, 'Active', '', '', '', '', 0, NULL),
(10, 'super', 'super', '4fcab400858d58a02b48f097bfdbc411e838ee12', 1, 1, '1', '', '', '', '', 0, NULL),
(11, 'fin', 'finance', '4fcab400858d58a02b48f097bfdbc411e838ee12', 4, 1, '1', '', 'admin@gmail.com', 'adminother@gmail.com', '2856547853', 0, NULL);

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
  `dealSize` varchar(32) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `companyAddress` text NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `contactEmail` varchar(100) NOT NULL,
  `contactTel` int(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `leaderId`, `sectorId`, `subSectorId`, `geoRegion`, `city`, `discussionDate`, `status`, `members`, `documents`, `dealSize`, `companyName`, `companyAddress`, `contactPerson`, `contactEmail`, `contactTel`) VALUES
(45, 'Dummy Project', 2, 2, 4, 1, 1, '2012-12-27', 'Invested', '3', '', '12', 'red', 'asdas', 'adasd', '', 0),
(46, 'Dummy Project 3', 2, 2, 4, 1, 1, '01/17/2013', 'Invested', '3', '7,9', '4', 'ads', 'asd', 'asd', 'asd', 0),
(47, 'Test1', 2, 7, 3, 35, 1, '01/14/2013', 'Preliminary', '9', '', '19', 'Testing Co', 'Sydney Australia', 'John Chen', 'john909c@gmail.com', 187654321),
(48, 'Hercules', 9, 1, 3, 23, 30, '01/16/2013', 'Preliminary', '3', ',14,15', '22', 'Olympus Consulting.', 'Mt. Olympus', 'Zeus', 'thunder@awesome.com', 1234567890),
(57, 'Hercules', 2, 2, 4, 16, 1, '02/21/2013', 'Invested', '3,9', ',10,11', '20', 'Olympus Consulting.', 'Mt. Olympus', 'Zeus', 'thunder@awesome.com', 1234567890),
(58, 'Rabbithole', 9, 1, 6, 9, 18, '03/28/2013', 'Preliminary', '2,3', ',12', '20', 'Umbrella Corp.', 'The Hive', 'Alice', 'alice@umbrella.com', 1234567890),
(59, 'Fort Minor', 9, 7, 5, 18, 20, '01/31/2013', 'Invested', '2,3', '', '10', 'Fort Minor', '2200 Fort Ave. Minor, Arcade', 'Mike Shinoda', 'mike.shinoda@awesome.com', 1234567890),
(60, 'Echo', 2, 1, 5, 35, 39, '02/13/2013', 'Preliminary', '3', '', '10', 'Sonar Systems', 'lol', 'Batman', 'batman@cave.com', 2147483647),
(61, 'Desert Storm', 9, 1, 3, 1, 1, '02/22/2013', 'Preliminary', '2,3', '', '123', 'USAF', 'US', 'Barack Obama', 'flying@intheair.com', 1594872630),
(62, 'Final Test', 2, 1, 3, 1, 1, '02/03/2013', 'Preliminary', '3,9', '', '5', 'Testers', 'Test Drive', 'Tester', 'test@tester.com', 123458760),
(63, 'The Waste Land', 2, 1, 3, 1, 1, '01/30/2013', 'Invested', '3,9', '', '155', 'waSTeS', 'asdad', 'wasteboy', 'wb@gmialc.com', 2147483647),
(64, 'Coconut Tree', 3, 8, 3, 36, 1, '01/18/2013', 'Invested', '2,9', '', '69', 'Watermelon', 'Kurumbathumani', 'Kottayam Santha', 'santha@HOTmail.com', 2147483647),
(65, 'Administrator Koshi', 3, 1, 3, 1, 1, '01/26/2013', 'Invested', '2,9', ',13', '4', 'Asss', 'Sick', 'Mofo', 'Assd@asd.com', 965874521),
(66, 'Nothing', 3, 1, 3, 1, 1, '01/26/2013', 'Invested', '9', '', '99', 'as', 'sse', 'sde', 'sad@sadas.com', 324234432);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

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
(34, 'Zhejiang Province'),
(35, 'Guangdong'),
(36, 'Red Street');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `subsectorOf`) VALUES
(1, 'Sector A', 0),
(2, 'Sector B', 0),
(3, 'Sector C', 1),
(4, 'Sector D', 2),
(5, 'Sector 9', 1),
(6, 'Sector Format', 1),
(7, 'Energy', 0),
(8, 'RedHot', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
