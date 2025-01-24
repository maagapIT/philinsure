-- --------------------------------------------------------
-- Host:                         maadev
-- Server version:               5.6.21 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             9.3.0.4993
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for emarine_philinsure
CREATE DATABASE IF NOT EXISTS `emarine_philinsure` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `emarine_philinsure`;


-- Dumping structure for table emarine_philinsure.agent
CREATE TABLE IF NOT EXISTS `agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(9) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `id` (`id`),
  KEY `user_created` (`user_created`),
  KEY `user_modified` (`user_modified`),
  CONSTRAINT `agent_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `agent_ibfk_2` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.agent: ~0 rows (approximately)
/*!40000 ALTER TABLE `agent` DISABLE KEYS */;
INSERT INTO `agent` (`id`, `code`, `name`, `email`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'MK0209-01', 'PHILPACIFIC INSURANCE BROKERS AND MANAGERS, INC. (MAKATI)', 'pol.robles@philinsure.com', 1, 1, 1, '2016-03-15 18:17:49', '2016-03-16 12:04:27');
/*!40000 ALTER TABLE `agent` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.location
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` varchar(800) NOT NULL,
  `marine_policy_id` int(11) NOT NULL,
  `policy_number` varchar(18) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `agent_code` varchar(9) NOT NULL,
  `local_government_tax_percent` decimal(10,4) NOT NULL,
  `email` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `user_modified` (`user_modified`),
  KEY `policy_id` (`marine_policy_id`),
  KEY `agent_id` (`agent_id`),
  KEY `user_created` (`user_created`),
  CONSTRAINT `location_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `location_ibfk_2` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `location_ibfk_3` FOREIGN KEY (`marine_policy_id`) REFERENCES `marine_policy` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.location: ~4 rows (approximately)
/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`id`, `name`, `address`, `marine_policy_id`, `policy_number`, `agent_id`, `agent_code`, `local_government_tax_percent`, `email`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\r\nSOUTH SUPER HIGHWAY,\r\nMUNTINLUPA CITY, PHILIPPINES', 1, 'MK-07-16-LF-000004', 1, 'MK0209-01', 0.2000, 'leah_delacerna@fil-pacific.com, jsaligo@maa.com.ph, dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph, bernadette.devera@maa.com.ph, raymond.mojica@philinsure.com, sharon.deguzman@philinsure.com, joji.perreras@philinsure.com', 1, 1, 2, '2016-03-15 18:19:30', '2016-04-01 11:03:28'),
	(2, 'HEAD OFFICE', 'MAKATI CITY', 2, 'MK-01-01-DA-000001', 1, 'MK0209-01', 0.2000, 'dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph', 1, 1, 2, '2016-03-15 18:22:28', '2016-03-16 15:40:32'),
	(3, 'AUTHENTIC AMERICAN APPAREL, INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 1, 'MK-07-16-LF-000004', 1, 'MK0209-01', 0.2000, 'leah_delacerna@fil-pacific.com, jsaligo@maa.com.ph, dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph, bernadette.devera@maa.com.ph, raymond.mojica@philinsure.com, sharon.deguzman@philinsure.com, joji.perreras@philinsure.com', 1, 1, 2, '2016-03-16 16:05:11', '2016-04-01 11:03:28'),
	(4, 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 1, 'MK-07-16-LF-000004', 1, 'MK0209-01', 0.2000, 'leah_delacerna@fil-pacific.com, jsaligo@maa.com.ph, dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph, bernadette.devera@maa.com.ph, raymond.mojica@philinsure.com, sharon.deguzman@philinsure.com, joji.perreras@philinsure.com', 1, 1, 2, '2016-03-16 16:06:22', '2016-04-01 11:03:28');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_certificate
CREATE TABLE IF NOT EXISTS `marine_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_number` varchar(20) NOT NULL,
  `certificate_number` varchar(50) NOT NULL,
  `policy_number` varchar(18) NOT NULL,
  `date_issued` date NOT NULL,
  `insured_name` varchar(100) NOT NULL,
  `insured_address` varchar(800) NOT NULL,
  `vessel` varchar(50) NOT NULL,
  `voyage_from` varchar(50) NOT NULL,
  `voyage_to` varchar(50) NOT NULL,
  `etd` datetime NOT NULL,
  `eta` datetime NOT NULL,
  `blnum` varchar(50) NOT NULL,
  `lcnum` varchar(50) NOT NULL,
  `consignee` varchar(500) NOT NULL,
  `consignee_address` varchar(800) NOT NULL,
  `mortgagee` varchar(800) NOT NULL,
  `agent_code` varchar(9) NOT NULL,
  `subject_matter_insured` varchar(800) NOT NULL,
  `date_effective` date NOT NULL,
  `date_expiry` date NOT NULL,
  `total_sum_insured` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_premium` decimal(15,2) NOT NULL DEFAULT '0.00',
  `value_added_tax` decimal(15,2) NOT NULL DEFAULT '0.00',
  `document_stamp` decimal(15,2) NOT NULL DEFAULT '0.00',
  `local_government_tax` decimal(15,2) NOT NULL DEFAULT '0.00',
  `other_charges` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_amount_due` decimal(15,2) NOT NULL DEFAULT '0.00',
  `location_id` int(11) NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'PHP',
  `currency_other` varchar(3) DEFAULT NULL,
  `currency_rate` decimal(15,4) NOT NULL DEFAULT '1.0000',
  `posted` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `certificate_number_2` (`certificate_number`),
  KEY `id` (`id`,`reference_number`),
  KEY `policy_number` (`policy_number`),
  KEY `certificate_number` (`certificate_number`),
  KEY `created_by` (`user_created`),
  KEY `modified_by` (`user_modified`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `marine_certificate_ibfk_4` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marine_certificate_ibfk_5` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.marine_certificate: ~13 rows (approximately)
/*!40000 ALTER TABLE `marine_certificate` DISABLE KEYS */;
INSERT INTO `marine_certificate` (`id`, `reference_number`, `certificate_number`, `policy_number`, `date_issued`, `insured_name`, `insured_address`, `vessel`, `voyage_from`, `voyage_to`, `etd`, `eta`, `blnum`, `lcnum`, `consignee`, `consignee_address`, `mortgagee`, `agent_code`, `subject_matter_insured`, `date_effective`, `date_expiry`, `total_sum_insured`, `total_premium`, `value_added_tax`, `document_stamp`, `local_government_tax`, `other_charges`, `total_amount_due`, `location_id`, `currency`, `currency_other`, `currency_rate`, `posted`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'TZIV160448', 'MK-07-16-LF-000004-0001', 'MK-07-16-LF-000004', '2016-03-28', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CAPE MORETON V.1608S', 'SHANGHAI, CHINA', 'MANILA, PHILIPPINES', '2016-03-30 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160379B', 'ILC7041081823FLU', 'BANCO DE ORO UNIBANK, INC.', 'NIL', 'BANCO DE ORO UNIBANK, INC.', 'MK0209-01', '122 ROLLS/ 73% CTN 26% POLYESTER 2% SPANDEX AS PER INVOICE NO.TZIV160448', '2016-03-28', '2016-04-27', 1801889.53, 900.94, 108.11, 112.62, 1.80, 0.00, 1123.48, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-03-28 17:29:38', '2016-04-01 11:03:28'),
	(2, 'TZIV160449', 'MK-07-16-LF-000004-0002', 'MK-07-16-LF-000004', '2016-03-28', 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CAPE MORETON V.1608S', 'SHANGHAI, CHINA', 'MANILA, PHILIPPINES', '2016-03-30 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160379A', 'ILC7041081818FLU', 'BANCO DE ORO UNIBANK, INC.', 'NIL', 'BANCO DE ORO UNIBANK, INC.', 'MK0209-01', '29 ROLLS/ 73% COTTON 25% POLYESTER 2% SPANDEX AS PER INVOICE NO.TZIV160449', '2016-03-28', '2016-04-27', 443626.49, 500.00, 60.00, 62.50, 1.00, 0.00, 623.50, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-03-28 17:50:17', '2016-04-01 11:03:28'),
	(3, 'GMT-15420186', 'MK-07-16-LF-000004-0003', 'MK-07-16-LF-000004', '2016-03-31', 'AUTHENTIC AMERICAN APPAREL, INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'SICILIA 16001S', 'SHEKOU, CHINA', 'MANILA, PHILIPPINES', '2016-03-27 00:00:00', '0000-00-00 00:00:00', 'SKMNL6018281', '', 'AUTHENTIC AMERICAN APPAREL, INC.', 'SAME AS ABOVE', 'AUTHENTIC AMERICAN APPAREL, INC.', 'MK0209-01', '619 CTNS/ MENS 100% COTTON WOVEN SHIRT/MENS 70% CTN 30% NYLON WOVEN SHORTS AS PER INVOICE NO.GMT-15420186', '2016-03-27', '2016-04-26', 12192119.86, 6096.06, 731.53, 762.01, 12.19, 0.00, 7601.79, 1, 'USD', '', 46.3290, 1, 1, 4, 4, '2016-03-31 15:13:24', '2016-04-01 11:03:28'),
	(4, '16JSQC00119', 'MK-07-16-LF-000004-0004', 'MK-07-16-LF-000004', '2016-03-31', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'MIYUNHE 230S', 'XIAMEN, CHINA', 'MANILA, PHILIPPINES', '2016-03-26 00:00:00', '0000-00-00 00:00:00', 'COAU7070525140', '', 'FIL-PACIFIC APPAREL CORPORATION', 'SAME AS ABOVE', 'FIL-PACIFIC APPAREL CORPORATION', 'MK0209-01', '314 CTNS/ LADIES COLORED CARGO SHORTS/LADIES JACKET/MENS JACKET AS PER INVOICE NO.16JSQC00119', '2016-03-26', '2016-04-25', 6327725.08, 3163.86, 379.66, 395.48, 6.33, 0.00, 3945.34, 1, 'USD', '', 46.3290, 1, 1, 4, 4, '2016-03-31 15:21:19', '2016-04-01 11:03:28'),
	(5, 'TZIV160520', 'MK-07-16-LF-000004-0005', 'MK-07-16-LF-000004', '2016-04-01', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', '', 'SHANGHAI, CHINA', 'MANILA, PHILIPPINES', '2016-03-30 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160379B', 'ILC7041081823FLU', 'BANCO DE ORO UNIBANK, INC.', 'NIL', 'BANCO DE ORO UNIBANK, INC.', 'MK0209-01', '122 ROLLS/ 73% CTN 25% POLYESTER 2% SPANDEX AS PER INVOICE NO.TZIV160520', '2016-03-30', '2016-04-29', 1796124.23, 898.06, 107.77, 112.26, 1.80, 0.00, 1119.88, 1, 'USD', '', 46.1080, 1, 1, 4, 4, '2016-04-01 10:08:11', '2016-04-01 11:03:28'),
	(6, 'TZIV160519', 'MK-07-16-LF-000004-0006', 'MK-07-16-LF-000004', '2016-04-01', 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CAPE MORETON V.1608S', 'SHANGHAI, CHINA', 'MANILA, PHILIPPINES', '2016-03-30 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160379A', 'ILC7041081818FLU', 'BANCO DE ORO UNIBANK, INC.', 'NIL', 'BANCO DE ORO UNIBANK, INC.', 'MK0209-01', '29 ROLLS/ 73% CTN 25% POLYESTER 2% SPANDEX AS PER INVOICE NO.TZIV160519', '2016-03-30', '2016-04-29', 442207.07, 500.00, 60.00, 62.50, 1.00, 0.00, 623.50, 1, 'USD', '', 46.1080, 1, 1, 4, 4, '2016-04-01 10:20:54', '2016-04-01 11:03:28'),
	(7, '91608833', 'MK-07-16-LF-000004-0007', 'MK-07-16-LF-000004', '2016-04-05', 'AUTHENTIC AMERICAN APPAREL, INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'MARCLOUD V.16005S', 'HONG KONG', 'MANILA, PHILIPPINES', '2016-03-31 00:00:00', '0000-00-00 00:00:00', 'HKGMNL228305', '', 'AUTHENTIC AMERICAN APPAREL, INC.', 'SAME AS ABOVE', 'AUTHENTIC AMERICAN APPAREL, INC.', 'MK0209-01', '6 CTNS/ LEE ACCESSORIES AS PER INVOICE NO.91608833', '2016-03-31', '2016-04-30', 46556.97, 500.00, 60.00, 62.50, 1.00, 0.00, 623.50, 1, 'USD', '', 46.0650, 1, 1, 4, 4, '2016-04-05 14:46:32', '2016-04-05 14:51:37'),
	(8, '65276', 'MK-07-16-LF-000004-0008', 'MK-07-16-LF-000004', '2016-04-05', 'AUTHENTIC AMERICAN APPAREL, INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'MOL GENEROSITY 0011S', 'KOBE, JAPAN', 'MANILA, PHILIPPINES', '2016-04-01 00:00:00', '0000-00-00 00:00:00', 'SMCUKBMNL1603001', 'AUB950-40-160181', 'ASIA UNITED BANK CORPORATION', 'NIL', 'ASIA UNITED BANK CORPORATION', 'MK0209-01', '80 ROLLS/ 63% COTTON 35% POLYESTER 2% POLYURETHANE AS PER INVOICE NO.65276', '2016-04-01', '2016-05-01', 3262138.58, 1631.07, 195.73, 203.88, 3.26, 0.00, 2033.94, 1, 'USD', '', 46.0650, 1, 1, 4, 4, '2016-04-05 14:57:35', '2016-04-05 15:00:44'),
	(9, '0018/16', 'MK-07-16-LF-000004-0009', 'MK-07-16-LF-000004', '2016-04-18', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'XING HANG 328', 'GAOLAN, CHINA', 'MANILA, PHILIPPINES', '2016-04-13 00:00:00', '0000-00-00 00:00:00', '0296A06436', '02026010351894', 'BANK OF THE PHILIPPINE ISLANDS', 'NIL', 'BANK OF THE PHILIPPINE ISLANDS', 'MK0209-01', '218 ROLLS/ 1% LYCRA 12% RAYON 12% POLYESTER 75% CTN STRETCH DENIM AS PER INVOICE NO.0018/16', '2016-04-13', '2016-05-12', 4792395.44, 2396.20, 287.54, 299.52, 4.79, 0.00, 2988.06, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-04-18 16:31:12', '2016-04-18 16:32:55'),
	(10, 'FAB-16430001', 'MK-07-16-LF-000004-0010', 'MK-07-16-LF-000004', '2016-04-18', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CAPE MORETON V.1609S', 'SHANGHAI, CHINA', 'MANILA, PHIIPPINES', '2016-04-14 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160440', '', 'FIL-PACIFIC APPAREL CORPORATION', 'SAME AS ABOVE', 'FIL-PACIFIC APPAREL CORPORATION', 'MK0209-01', '301 PKGS/ MENS 100% CTN WOVEN SHORTS/LADIES 98% CTN 2% SPANDEX WOVEN SHORTS/PANTS/100% CTN WOVEN FABRIC AS PER INVOICE NO.\'s FAB-16430001/GMT-16420001', '2016-04-14', '2016-05-13', 5077574.78, 2538.79, 304.65, 317.35, 5.08, 0.00, 3165.87, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-04-18 16:37:49', '2016-04-18 17:04:16'),
	(11, 'DAA1050118/9', 'MK-07-16-LF-000004-0011', 'MK-07-16-LF-000004', '2016-04-18', 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'BOMAR SPRING V-010E', 'MANILA, PHILIPPINES', 'MANILA, PHILIPPINES', '2016-04-16 00:00:00', '0000-00-00 00:00:00', 'A1604045', '02026010351983', 'BANK OF THE PHILIPPINE ISLANDS', 'NIL', 'BANK OF THE PHILIPPINE ISLANDS', 'MK0209-01', '76 ROLLS/ 98% CTN 2% SPANDEX TWILL/ 100% CTN AS PER INVOICE NO.DAA1050118/9', '2016-04-16', '2016-05-15', 1175268.28, 587.63, 70.52, 73.45, 1.18, 0.00, 732.78, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-04-18 17:37:13', '2016-04-18 17:38:50'),
	(12, 'LT16B3782', 'MK-07-16-LF-000004-0012', 'MK-07-16-LF-000004', '2016-04-18', 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CSCL KINGSTON V.0176S', 'MANILA, PHILIPPINES', 'MANILA, PHILIPPINES', '2016-04-17 00:00:00', '0000-00-00 00:00:00', 'QDEL16040005', 'ILC-130016000695', 'SECURITY BANK CORPORATION', 'NIL', 'SECURITY BANK OF THE PHILIPPINES', 'MK0209-01', '68 ROLLS/ 98.7% CTN 1.3% SPANDEX AS PER INVOICE NO.LT16B3782', '2016-04-17', '2016-05-16', 845619.35, 500.00, 60.00, 62.50, 1.00, 0.00, 623.50, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-04-18 17:41:52', '2016-04-18 17:42:56'),
	(13, 'MODULE 001', 'MK-07-16-LF-000004-0013', 'MK-07-16-LF-000004', '2016-04-18', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'SINO TRANS SHENZHEN V.1616S', 'GUANGZHOU, CHINA', 'MANILA, PHILIPPINES', '2016-04-08 00:00:00', '0000-00-00 00:00:00', 'CANMNLNL16040040', '', 'FIL-PACIFIC APPAREL CORPORATION', 'SAME AS ABOVE', 'FIL-PACIFIC APPAREL CORPORATION', 'MK0209-01', '1 CTN / CUSTOM METAL DISPLAY RACK AS PER INVOICE MODULE 001', '2016-04-08', '2016-05-07', 55020.12, 500.00, 60.00, 62.50, 1.00, 0.00, 623.50, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-04-18 17:48:17', '2016-04-18 17:57:22');
/*!40000 ALTER TABLE `marine_certificate` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_coverage
CREATE TABLE IF NOT EXISTS `marine_coverage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  `rate_percent` decimal(4,4) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `user_created` (`user_created`),
  KEY `user_modified` (`user_modified`),
  CONSTRAINT `marine_coverage_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marine_coverage_ibfk_2` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.marine_coverage: ~2 rows (approximately)
/*!40000 ALTER TABLE `marine_coverage` DISABLE KEYS */;
INSERT INTO `marine_coverage` (`id`, `code`, `name`, `rate_percent`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'ICC "A"', 'INSTITUTE CARGO CLAUSES "A" (ALL RISK)', 0.0500, 1, 1, 1, '2016-03-15 18:31:47', '2016-03-16 15:27:04'),
	(2, 'ICC "AIR"', 'INSTITUTE CARGO CLAUSES "AIR"', 0.0500, 1, 1, 1, '2016-03-15 18:31:57', '2016-03-16 15:27:10');
/*!40000 ALTER TABLE `marine_coverage` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_coverage_details
CREATE TABLE IF NOT EXISTS `marine_coverage_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marine_certificate_id` int(11) NOT NULL,
  `marine_coverage_id` int(11) NOT NULL,
  `invoice_amount` decimal(10,2) NOT NULL,
  `markup_percent` decimal(4,2) NOT NULL,
  `markup_amount` decimal(15,2) NOT NULL DEFAULT '0.00',
  `sum_insured` decimal(15,2) NOT NULL DEFAULT '0.00',
  `rate_percent` decimal(4,4) DEFAULT '0.0000',
  `premium` decimal(15,6) NOT NULL DEFAULT '0.000000',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `marine_certificate_id` (`marine_certificate_id`,`user_created`,`user_modified`),
  KEY `marine_coverage_id` (`marine_coverage_id`),
  KEY `user_created` (`user_created`),
  KEY `user_modified` (`user_modified`),
  KEY `user_modified_2` (`user_modified`),
  CONSTRAINT `marine_coverage_details_ibfk_1` FOREIGN KEY (`marine_certificate_id`) REFERENCES `marine_certificate` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marine_coverage_details_ibfk_2` FOREIGN KEY (`marine_coverage_id`) REFERENCES `marine_coverage` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marine_coverage_details_ibfk_3` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marine_coverage_details_ibfk_4` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.marine_coverage_details: ~13 rows (approximately)
/*!40000 ALTER TABLE `marine_coverage_details` DISABLE KEYS */;
INSERT INTO `marine_coverage_details` (`id`, `marine_certificate_id`, `marine_coverage_id`, `invoice_amount`, `markup_percent`, `markup_amount`, `sum_insured`, `rate_percent`, `premium`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 1, 1, 35413.38, 10.00, 3541.34, 38954.72, 0.0500, 19.477359, 1, 4, 4, '2016-03-28 17:43:16', '2016-03-28 17:43:16'),
	(2, 2, 1, 8718.80, 10.00, 871.88, 9590.68, 0.0500, 4.795340, 1, 4, 4, '2016-03-28 17:56:48', '2016-03-28 17:56:48'),
	(3, 3, 1, 239239.90, 10.00, 23923.99, 263163.89, 0.0500, 131.581945, 1, 4, 4, '2016-03-31 15:16:15', '2016-03-31 15:16:15'),
	(4, 4, 1, 124165.80, 10.00, 12416.58, 136582.38, 0.0500, 68.291190, 1, 4, 4, '2016-03-31 15:24:03', '2016-03-31 15:24:03'),
	(5, 5, 1, 35413.38, 10.00, 3541.34, 38954.72, 0.0500, 19.477359, 1, 4, 4, '2016-04-01 10:11:45', '2016-04-01 10:11:45'),
	(6, 6, 1, 8718.80, 10.00, 871.88, 9590.68, 0.0500, 4.795340, 1, 4, 4, '2016-04-01 10:22:24', '2016-04-01 10:22:24'),
	(7, 7, 1, 918.80, 10.00, 91.88, 1010.68, 0.0500, 0.505340, 1, 4, 4, '2016-04-05 14:51:15', '2016-04-05 14:51:15'),
	(8, 8, 1, 64378.17, 10.00, 6437.82, 70815.99, 0.0500, 35.407993, 1, 4, 4, '2016-04-05 14:59:54', '2016-04-05 14:59:54'),
	(9, 9, 1, 94187.20, 10.00, 9418.72, 103605.92, 0.0500, 51.802960, 1, 4, 4, '2016-04-18 16:32:45', '2016-04-18 16:32:45'),
	(10, 10, 1, 99791.96, 10.00, 9979.20, 109771.16, 0.0500, 54.885578, 1, 4, 4, '2016-04-18 17:00:38', '2016-04-18 17:04:08'),
	(11, 11, 1, 23098.10, 10.00, 2309.81, 25407.91, 0.0500, 12.703955, 1, 4, 4, '2016-04-18 17:38:44', '2016-04-18 17:38:44'),
	(12, 12, 1, 16619.35, 10.00, 1661.94, 18281.29, 0.0000, 0.000000, 1, 4, 4, '2016-04-18 17:42:51', '2016-04-18 17:42:51'),
	(13, 13, 1, 1081.34, 10.00, 108.13, 1189.47, 0.0500, 0.594737, 1, 4, 4, '2016-04-18 17:56:34', '2016-04-18 17:56:34');
/*!40000 ALTER TABLE `marine_coverage_details` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_policy
CREATE TABLE IF NOT EXISTS `marine_policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `policy_number` varchar(18) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `policy_number` (`policy_number`),
  KEY `user_created` (`user_created`,`user_modified`),
  KEY `user_modified` (`user_modified`),
  CONSTRAINT `marine_policy_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `marine_policy_ibfk_2` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.marine_policy: ~2 rows (approximately)
/*!40000 ALTER TABLE `marine_policy` DISABLE KEYS */;
INSERT INTO `marine_policy` (`id`, `policy_number`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'MK-07-16-LF-000004', 1, 1, 1, '2016-03-15 18:17:09', '2016-04-01 11:03:28'),
	(2, 'MK-01-01-DA-000001', 1, 1, 1, '2016-03-15 18:21:35', '2016-03-15 18:21:35');
/*!40000 ALTER TABLE `marine_policy` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `label` varchar(100) NOT NULL,
  `parent` smallint(6) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(25) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.menu: ~13 rows (approximately)
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `name`, `label`, `parent`, `link`, `icon`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'system', 'System', 0, 'system.php', 'fi-widget', 1, 1, 1, '2015-07-22 15:07:31', '2015-11-05 11:06:04'),
	(2, 'report', 'Reports', 0, 'report.php', 'fi-page-pdf', 1, 1, 1, '2015-07-23 12:03:21', '2015-11-05 11:06:05'),
	(3, 'maintenance', 'Maintenance', 0, 'maintenance.php', 'fi-wrench', 1, 1, 1, '2015-07-23 12:08:33', '2015-11-05 11:06:06'),
	(4, 'marine_certificate_issuance', 'Marine Certificate Issuance', 1, 'marine_certificate.php', NULL, 1, 1, 1, '2015-07-23 12:09:07', '2015-11-05 11:06:07'),
	(5, 'marine_posted_certificate', 'Marine Posted Certificates', 2, 'reports/marine_posted_certificate.php', NULL, 1, 1, 1, '2015-07-23 12:09:50', '2015-11-05 11:06:08'),
	(6, 'marine_certificate_summary', 'Marine Certificate Summary', 2, 'reports/marine_certificate_summary.php', NULL, 1, 1, 1, '2015-07-23 12:09:59', '2015-11-05 11:06:09'),
	(7, 'user', 'Users', 3, 'user.php', NULL, 1, 1, 1, '2015-07-23 12:12:34', '2015-11-05 11:06:10'),
	(8, 'location', 'Locations', 3, 'location.php', NULL, 1, 1, 1, '2015-07-23 14:53:21', '2015-11-05 11:06:11'),
	(9, 'role', 'Roles', 3, 'role.php', NULL, 1, 1, 1, '2015-07-23 14:53:45', '2015-11-05 11:06:11'),
	(10, 'menu', 'Menu', 3, 'menu.php', NULL, 0, 1, 1, '2015-07-23 14:54:10', '2015-11-06 14:20:03'),
	(11, 'settings', 'Settings', 3, 'settings.php', NULL, 1, 1, 1, '2015-11-11 08:54:29', '2015-11-11 16:27:04'),
	(12, 'marine_policy', 'Marine Policy', 3, 'marine_policy.php', NULL, 1, 1, 1, '2015-11-11 16:27:00', '2015-11-11 16:27:05'),
	(13, 'agent', 'Agent', 3, 'agent.php', NULL, 1, 1, 1, '2015-11-11 16:38:28', '2015-11-13 11:31:43');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.role
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `menu` longtext NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `modified_by` (`user_modified`),
  KEY `created_by` (`user_created`),
  CONSTRAINT `role_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `role_ibfk_2` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.role: ~2 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `menu`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'administrator', 'marine_certificate_issuance,marine_posted_certificate,marine_certificate_summary,user,location,role,settings,marine_policy,agent', 1, 1, 1, '2016-03-15 18:11:09', '2016-03-15 18:11:09'),
	(2, 'user', 'marine_certificate_issuance,marine_posted_certificate,marine_certificate_summary', 1, 1, 1, '2016-03-15 18:11:17', '2016-03-15 18:11:17'),
	(3, 'report', 'marine_posted_certificate,marine_certificate_summary', 1, 2, 2, '2016-03-29 09:58:15', '2016-03-29 09:58:15');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.system
CREATE TABLE IF NOT EXISTS `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `user_created` (`user_created`),
  KEY `user_modified` (`user_modified`),
  CONSTRAINT `system_ibfk_1` FOREIGN KEY (`user_created`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `system_ibfk_2` FOREIGN KEY (`user_modified`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.system: ~2 rows (approximately)
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
INSERT INTO `system` (`id`, `name`, `value`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'percentage_value_added_tax', '12', 1, 1, 1, '2016-03-15 18:20:11', '2016-03-15 18:20:11'),
	(2, 'percentage_document_stamp', '12.5', 1, 1, 1, '2016-03-15 18:20:22', '2016-03-15 18:20:22'),
	(3, 'central_location', 'HEAD OFFICE', 1, 1, 1, '2016-03-15 18:20:35', '2016-03-15 18:20:35');
/*!40000 ALTER TABLE `system` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(500) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `location_id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role_name` longtext NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `user_created` int(11) NOT NULL,
  `user_modified` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `user_created` (`user_created`),
  KEY `user_modified` (`user_modified`),
  KEY `name` (`name`),
  KEY `location_id` (`location_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.user: ~6 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `password`, `first_name`, `last_name`, `email`, `location_id`, `location_name`, `role_id`, `role_name`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'admin', '5e35bbd0e0bde90b90768c475a5f286a', 'Admin', 'Traitor', 'jun.tapao@maa.com.ph', 2, 'HEAD OFFICE', 1, 'administrator', 1, 1, 1, '2016-03-15 18:10:06', '2016-03-15 18:24:41'),
	(2, 'juntapao', '5e35bbd0e0bde90b90768c475a5f286a', 'Jun', 'Tapao', 'jun.tapao@maa.com.ph', 2, 'HEAD OFFICE', 1, 'administrator', 1, 1, 1, '2016-03-15 18:23:16', '2016-03-15 18:25:51'),
	(3, 'dlopinac', 'a9e97f8dcc785b699d3928c10317c60b', 'Dennis', 'Lopinac', 'dennis.lopinac@maa.com.ph', 2, 'HEAD OFFICE', 2, 'user', 1, 1, 1, '2016-03-16 09:10:39', '2016-03-16 09:12:22'),
	(4, 'leah', 'a26d81dce5680ea4749f1bd22016c0cb', 'Leah', 'Dela Cerna', 'leah_delacerna@fil-pacific.com', 1, 'FIL-PACIFIC APPAREL CORPORATION', 2, 'user', 1, 1, 1, '2016-03-16 12:01:23', '2016-03-16 12:06:03'),
	(5, 'juntest', 'b4af804009cb036a4ccdc33431ef9ac9', 'Jun', 'Test', 'jun.tapao@maa.com.ph', 1, 'FIL-PACIFIC APPAREL CORPORATION', 2, 'user', 1, 2, 2, '2016-03-16 16:01:21', '2016-03-16 16:01:37'),
	(6, 'mbdevera', '24dd0edf9bc6b4403c874ce6ba9487a6', 'Mary Bernadette', 'de Vera', 'bernadette.devera@maa.com.ph', 1, 'FIL-PACIFIC APPAREL CORPORATION', 3, 'report', 1, 2, 2, '2016-03-29 09:56:18', '2016-03-29 09:59:53');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
