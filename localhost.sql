-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2012 at 11:13 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES
(11, 1355819777, '::1', 'EyOX0Hm8'),
(12, 1355862802, '::1', 'B0QC16Qr'),
(13, 1355900232, '::1', 'pltodjJt'),
(14, 1356082372, '::1', 'H2NTWGKK');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

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
-- Table structure for table `jobtitles`
--

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

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `memberName` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `rank` int(1) NOT NULL COMMENT '0 - Supervisor; 1 - Admin; 2 - Member; 3 - Finance',
  `titleId` int(3) NOT NULL,
  `status` varchar(10) NOT NULL,
  `subordinates` varchar(100) NOT NULL,
  `officeEmail` varchar(50) NOT NULL,
  `otherEmail` varchar(50) NOT NULL,
  `contactTel1` varchar(12) NOT NULL,
  `contactTel2` int(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `memberName`, `username`, `password`, `rank`, `titleId`, `status`, `subordinates`, `officeEmail`, `otherEmail`, `contactTel1`, `contactTel2`) VALUES
(1, 'Administrator', 'admin', '4fcab400858d58a02b48f097bfdbc411e838ee12', 0, 1, 'Active', '', 'admin@gmail.com', 'adminother@gmail.com', '2856547853', 2147483647),
(2, 'Dummy Member 1', 'dm1', 'passcode', 2, 3, 'Active', '', 'dm1@gmail.com', 'dm1other@gmail.com', '2856547853', 2147483647),
(3, 'Dummy Member 2', 'dm2', '4fcab400858d58a02b48f097bfdbc411e838ee12', 2, 4, 'Active', '', 'dm2@gmail.com', 'dm2other@gmail.com', '12345', 2147483647),
(8, 'Amala George', 'ammu', '4fcab400858d58a02b48f097bfdbc411e838ee12', 1, 4, 'Active', '2,3', 'albinin0002@gmail.com', 'albinin0002@gmail.com', '9620732469', 2147483647);

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
  `discussionDate` date NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `leaderId`, `sectorId`, `subSectorId`, `geoRegion`, `city`, `discussionDate`, `status`, `members`, `documents`, `dealSize`, `companyName`, `companyAddress`, `contactPerson`, `contactEmail`, `contactTel`) VALUES
(1, 'Dummy Project', 2, 2, 2, 5, 6, '2012-11-19', 'Preliminary', '2,3', '', 15, 'HCL', 'Add', 'Albin', 'asdasd', 0);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

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

CREATE TABLE IF NOT EXISTS `sectors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `subsectorOf` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `subsectorOf`) VALUES
(1, 'Sector A', 0),
(2, 'Sector B', 0),
(3, 'Sector C', 1),
(4, 'Sector D', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
