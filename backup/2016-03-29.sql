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
DROP DATABASE IF EXISTS `emarine_philinsure`;
CREATE DATABASE IF NOT EXISTS `emarine_philinsure` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `emarine_philinsure`;


-- Dumping structure for table emarine_philinsure.agent
DROP TABLE IF EXISTS `agent`;
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
DROP TABLE IF EXISTS `location`;
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
	(1, 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\r\nSOUTH SUPER HIGHWAY,\r\nMUNTINLUPA CITY, PHILIPPINES', 1, 'MK-07-16-LF-000006', 1, 'MK0209-01', 0.2000, 'leah_delacerna@fil-pacific.com, jsaligo@maa.com.ph, dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph, bernadette.devera@maa.com.ph, raymond.mojica@philinsure.com, sharon.deguzman@philinsure.com, joji.perreras@philinsure.com', 1, 1, 2, '2016-03-15 18:19:30', '2016-03-29 11:23:28'),
	(2, 'HEAD OFFICE', 'MAKATI CITY', 2, 'MK-01-01-DA-000001', 1, 'MK0209-01', 0.2000, 'dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph', 1, 1, 2, '2016-03-15 18:22:28', '2016-03-16 15:40:32'),
	(3, 'AUTHENTIC AMERICAN APPAREL, INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 1, 'MK-07-16-LF-000006', 1, 'MK0209-01', 0.2000, 'leah_delacerna@fil-pacific.com, jsaligo@maa.com.ph, dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph, bernadette.devera@maa.com.ph, raymond.mojica@philinsure.com, sharon.deguzman@philinsure.com, joji.perreras@philinsure.com', 1, 1, 2, '2016-03-16 16:05:11', '2016-03-29 11:22:21'),
	(4, 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 1, 'MK-07-16-LF-000006', 1, 'MK0209-01', 0.2000, 'leah_delacerna@fil-pacific.com, jsaligo@maa.com.ph, dennis.lopinac@maa.com.ph, jun.tapao@maa.com.ph, bernadette.devera@maa.com.ph, raymond.mojica@philinsure.com, sharon.deguzman@philinsure.com, joji.perreras@philinsure.com', 1, 1, 2, '2016-03-16 16:06:22', '2016-03-29 11:23:08');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_certificate
DROP TABLE IF EXISTS `marine_certificate`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.marine_certificate: ~2 rows (approximately)
/*!40000 ALTER TABLE `marine_certificate` DISABLE KEYS */;
INSERT INTO `marine_certificate` (`id`, `reference_number`, `certificate_number`, `policy_number`, `date_issued`, `insured_name`, `insured_address`, `vessel`, `voyage_from`, `voyage_to`, `etd`, `eta`, `blnum`, `lcnum`, `consignee`, `consignee_address`, `mortgagee`, `agent_code`, `subject_matter_insured`, `date_effective`, `date_expiry`, `total_sum_insured`, `total_premium`, `value_added_tax`, `document_stamp`, `local_government_tax`, `other_charges`, `total_amount_due`, `location_id`, `currency`, `currency_other`, `currency_rate`, `posted`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'TZIV160448', 'MK-07-16-LF-000006-0001', 'MK-07-16-LF-000006', '2016-03-28', 'FIL-PACIFIC APPAREL CORPORATION', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CAPE MORETON V.1608S', 'SHANGHAI, CHINA', 'MANILA, PHILIPPINES', '2016-03-30 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160379B', 'ILC7041081823FLU', 'BANCO DE ORO UNIBANK, INC.', 'NIL', 'BANCO DE ORO UNIBANK, INC.', 'MK0209-01', '122 ROLLS/ 73% CTN 26% POLYESTER 2% SPANDEX AS PER INVOICE NO.TZIV160448', '2016-03-28', '2016-04-27', 1801889.53, 900.94, 108.11, 112.62, 1.80, 0.00, 1123.48, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-03-28 17:29:38', '2016-03-28 17:45:00'),
	(2, 'TZIV160449', 'MK-07-16-LF-000006-0002', 'MK-07-16-LF-000006', '2016-03-28', 'CORE LIFESTYLE CLOTHING INC.', 'KM. 21 WEST SERVICE ROAD,\nSOUTH SUPER HIGHWAY,\nMUNTINLUPA CITY, PHILIPPINES', 'CAPE MORETON V.1608S', 'SHANGHAI, CHINA', 'MANILA, PHILIPPINES', '2016-03-30 00:00:00', '0000-00-00 00:00:00', 'ECLNGB20160379A', 'ILC7041081818FLU', 'BANCO DE ORO UNIBANK, INC.', 'NIL', 'BANCO DE ORO UNIBANK, INC.', 'MK0209-01', '29 ROLLS/ 73% COTTON 25% POLYESTER 2% SPANDEX AS PER INVOICE NO.TZIV160449', '2016-03-28', '2016-04-27', 443626.49, 500.00, 60.00, 62.50, 1.00, 0.00, 623.50, 1, 'USD', '', 46.2560, 1, 1, 4, 4, '2016-03-28 17:50:17', '2016-03-29 09:38:41');
/*!40000 ALTER TABLE `marine_certificate` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_coverage
DROP TABLE IF EXISTS `marine_coverage`;
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
DROP TABLE IF EXISTS `marine_coverage_details`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table emarine_philinsure.marine_coverage_details: ~2 rows (approximately)
/*!40000 ALTER TABLE `marine_coverage_details` DISABLE KEYS */;
INSERT INTO `marine_coverage_details` (`id`, `marine_certificate_id`, `marine_coverage_id`, `invoice_amount`, `markup_percent`, `markup_amount`, `sum_insured`, `rate_percent`, `premium`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 1, 1, 35413.38, 10.00, 3541.34, 38954.72, 0.0500, 19.477359, 1, 4, 4, '2016-03-28 17:43:16', '2016-03-28 17:43:16'),
	(2, 2, 1, 8718.80, 10.00, 871.88, 9590.68, 0.0500, 4.795340, 1, 4, 4, '2016-03-28 17:56:48', '2016-03-28 17:56:48');
/*!40000 ALTER TABLE `marine_coverage_details` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.marine_policy
DROP TABLE IF EXISTS `marine_policy`;
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
	(1, 'MK-07-16-LF-000006', 1, 1, 1, '2016-03-15 18:17:09', '2016-03-15 18:17:09'),
	(2, 'MK-01-01-DA-000001', 1, 1, 1, '2016-03-15 18:21:35', '2016-03-15 18:21:35');
/*!40000 ALTER TABLE `marine_policy` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.menu
DROP TABLE IF EXISTS `menu`;
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
DROP TABLE IF EXISTS `role`;
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

-- Dumping data for table emarine_philinsure.role: ~3 rows (approximately)
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` (`id`, `name`, `menu`, `active`, `user_created`, `user_modified`, `date_created`, `date_modified`) VALUES
	(1, 'administrator', 'marine_certificate_issuance,marine_posted_certificate,marine_certificate_summary,user,location,role,settings,marine_policy,agent', 1, 1, 1, '2016-03-15 18:11:09', '2016-03-15 18:11:09'),
	(2, 'user', 'marine_certificate_issuance,marine_posted_certificate,marine_certificate_summary', 1, 1, 1, '2016-03-15 18:11:17', '2016-03-15 18:11:17'),
	(3, 'report', 'marine_posted_certificate,marine_certificate_summary', 1, 2, 2, '2016-03-29 09:58:15', '2016-03-29 09:58:15');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;


-- Dumping structure for table emarine_philinsure.system
DROP TABLE IF EXISTS `system`;
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
DROP TABLE IF EXISTS `user`;
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
