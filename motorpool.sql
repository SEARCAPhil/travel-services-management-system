-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2017 at 10:33 AM
-- Server version: 5.6.21-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `motorpool`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_profile`
--

CREATE TABLE IF NOT EXISTS `account_profile` (
`id` int(11) NOT NULL,
  `uid` int(255) DEFAULT NULL,
  `profile_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `profile_email` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `department_alias` varchar(50) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_profile`
--

INSERT INTO `account_profile` (`id`, `uid`, `profile_name`, `last_name`, `first_name`, `middle_name`, `profile_email`, `department`, `department_alias`, `position`, `profile_image`, `date_modified`) VALUES
(1, 67, 'John Kenneth G. Abella', 'Abella', 'John Kenneth', NULL, NULL, 'Info Tech Services Unit', 'ITSU', 'programmer', '67.PNG', '2016-09-29 10:08:01'),
(6, 102, 'Renz B. Tabadero', 'Tabadero', 'Renz', NULL, NULL, 'Information Technology Services Unit', 'ITSU', '', '', '2016-09-29 10:08:00'),
(14, 102, 'Renz B. Tabadero', 'Tabadero', 'Renz', NULL, NULL, 'Information Technology Services Unit', 'ITSU', '', '', '2016-09-29 10:08:01'),
(15, 1, 'Administrator', '', '', NULL, NULL, 'Accounting Unit', 'AcU', 'administrator', '1.jpg', '2016-09-29 10:08:01'),
(16, 67, 'John Kenneth G. Abella', 'Abella', 'John Kenneth', NULL, NULL, 'Information Technology Services Unit', 'ITSU', 'programmer', '67.jpg', '2016-10-27 10:26:13'),
(24, 115, 'Zacyl A. Rivera-Jalotjot', 'Rivera-Jalotjot', 'Zacyl', NULL, NULL, 'Graduate Education and Institutional Development Department', 'GEIDD', '', '', '2016-09-29 10:08:01'),
(25, 25, 'Adoracion T. Robles', 'Robles', 'Adoracion', NULL, NULL, 'Planning and Budget Unit', 'PBU', '', '', '2016-09-29 10:08:01'),
(26, 64, 'Jaymark Warren T. Dia', 'Dia', 'Jaymark Warren ', NULL, NULL, 'Information Technology Services Unit', 'ITSU', '', '', '2016-09-29 10:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `automobile`
--

CREATE TABLE IF NOT EXISTS `automobile` (
  `plate_no` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `availability` enum('available','in_use','under_maintenance','junked') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automobile`
--

INSERT INTO `automobile` (`plate_no`, `manufacturer`, `color`, `class`, `image`, `availability`) VALUES
('0EV-21859', 'Toyota Corolla GLI', 'Gray', 2, NULL, 'available'),
('1598fd', 'Toyota Camry LE', '#004040', NULL, '1598fd.png', 'available'),
('4589df', '', '#000000', NULL, '4589df.png', 'available'),
('abc1315', 'Honda CR-V', 'black', 3, 'abc1315.png', 'available'),
('asd', '', '', NULL, NULL, 'available'),
('asdasd', '', '', NULL, NULL, 'available'),
('AXA 1341', 'Toyota Fortuner 4x2 SUV', '#ffdbb7', NULL, 'asdasdasdas.png', 'available'),
('new', 'Toyota Wigo 13.0 GMT', '#ffffff', NULL, 'new.png', 'available'),
('no plate 2', 'Toyota Innova 2.5J MT', 'white', 1, '35603A.png', 'available'),
('OEV-22436', 'Mitsubishi L300 cab', '#ff9900', NULL, NULL, 'available'),
('OEV-24469', 'Toyota Hi-ACE Grandia GL 2.5 DSL 5s', '#f7f7f7', NULL, 'OEV-24469.png', 'available'),
('OEV-24498', 'Toyota Hi-Lux J M/T 4x2', '#ffffff', NULL, 'OEV-24498.jpg', 'available'),
('OEV-26782', 'Honda Accord 3.5 S AT', '#000000', NULL, 'OEV-26782.png', 'available'),
('OEV-28050', 'Hyundai Grand Starex GL', '#ffffff', NULL, 'OEV-28050.png', 'available'),
('po435', '', '#800000', NULL, NULL, 'available'),
('RENT A CAR', 'RENT A CAR', '#000000', NULL, 'RENT A CAR.png', 'available'),
('sdfsdf', '', '#000000', NULL, NULL, 'available'),
('TQE 247', 'SUZUKI multicab', '#ffffd7', NULL, NULL, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `automobile_class`
--

CREATE TABLE IF NOT EXISTS `automobile_class` (
`id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automobile_class`
--

INSERT INTO `automobile_class` (`id`, `class`) VALUES
(1, 'SUV'),
(2, 'Van'),
(3, 'Pick-up');

-- --------------------------------------------------------

--
-- Table structure for table `automobile_noti`
--

CREATE TABLE IF NOT EXISTS `automobile_noti` (
  `plate_no` varchar(255) NOT NULL,
  `mileage_limit` double NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `automobile_oil`
--

CREATE TABLE IF NOT EXISTS `automobile_oil` (
`id` int(11) NOT NULL,
  `plate_no` varchar(100) NOT NULL,
  `mileage` int(100) NOT NULL,
  `amount` double NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `oil_type` enum('regular','synthetic') NOT NULL DEFAULT 'regular',
  `station` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automobile_oil`
--

INSERT INTO `automobile_oil` (`id`, `plate_no`, `mileage`, `amount`, `receipt`, `oil_type`, `station`, `date_created`) VALUES
(1, 'abc1315', 7000, 1000, 'kouyb26', 'regular', '', '2015-08-14 08:31:20'),
(2, '1598fd', 8212, 200, 'xy-0856', 'regular', '', '2016-06-01 09:13:33'),
(3, '1598fd', 8212, 3500, '', 'synthetic', '', '2016-06-08 07:16:48'),
(4, '0EV-21859', 0, 1000, 'cvxc', 'synthetic', '', '2016-09-07 08:28:15');

--
-- Triggers `automobile_oil`
--
DELIMITER //
CREATE TRIGGER `autoRemoveNoti` AFTER INSERT ON `automobile_oil`
 FOR EACH ROW BEGIN

DELETE FROM automobile_noti where plate_no=NEW.plate_no;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `automobile_refuel`
--

CREATE TABLE IF NOT EXISTS `automobile_refuel` (
`id` int(11) NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `amount` double NOT NULL,
  `liters` double NOT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `station` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automobile_refuel`
--

INSERT INTO `automobile_refuel` (`id`, `plate_no`, `amount`, `liters`, `receipt`, `station`, `date_created`) VALUES
(2, 'no plate 2', 502, 5, '3', '', '2015-07-30 08:41:06'),
(3, 'abc1315', 250, 1.5, 'frdg', '', '2014-07-31 00:53:18'),
(4, 'no plate 2', 1000, 15, NULL, '', '2014-05-30 16:00:00'),
(5, 'no plate 2', 2, 1, '3', '', '2015-07-31 07:00:08'),
(11, 'no plate 2', 100, 0, '56890', '', '2013-07-31 07:08:00'),
(13, '0EV-21859', 1000, 17, 'drty659845h', '', '2015-08-05 06:27:10'),
(18, 'abc1315', 2000, 50, 'kh89Th', '', '2015-08-10 08:21:39'),
(19, 'abc1315', 1000, 20, 'n/a', '', '2015-08-10 09:11:11'),
(20, 'abc1315', 1000, 10, 'n/a', '', '2015-08-14 08:24:47'),
(21, 'abc1315', 1000, 56, '890-dghj', '', '2016-06-03 06:02:09'),
(24, '1598fd', 50, 1, '596df', 'caltex', '2016-09-15 05:46:03'),
(45, '1598fd', 456, 45, 'test', 'test', '2016-09-19 02:15:49'),
(46, '1598fd', 789, 45, 'test', 'test', '2016-09-19 02:16:15'),
(72, '1598fd', 3, 3, '3', '3', '2016-09-19 02:58:02'),
(73, '1598fd', 3, 2, '4', '5', '2016-09-19 02:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `automobile_rent`
--

CREATE TABLE IF NOT EXISTS `automobile_rent` (
  `travel_id` int(11) NOT NULL,
  `travel_type` enum('tr','trp','trc') NOT NULL DEFAULT 'tr',
  `automobile` varchar(255) NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `drivers_name` varchar(255) NOT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automobile_rent`
--

INSERT INTO `automobile_rent` (`travel_id`, `travel_type`, `automobile`, `plate_number`, `drivers_name`, `id`) VALUES
(252, 'tr', 'HONDA WAVE', '09Ilo', 'Mang Kanor', 1),
(0, 'tr', 'HONDA WAVE', '09Ilo', 'Mang Kanorsadsa', 3),
(239, 'tr', 'test', 'test', 'test', 18),
(42, 'trc', 'hah', 'haha', 'haha', 19),
(4, 'trp', 'trp hehe', 'hehe', 'hehe', 21);

-- --------------------------------------------------------

--
-- Table structure for table `automobile_repair`
--

CREATE TABLE IF NOT EXISTS `automobile_repair` (
`id` int(11) NOT NULL,
  `plate_no` varchar(100) NOT NULL,
  `item` varchar(100) NOT NULL,
  `amount` double NOT NULL,
  `details` text NOT NULL,
  `receipt` varchar(255) NOT NULL,
  `station` varchar(255) NOT NULL,
  `mode` enum('repair','replace') NOT NULL DEFAULT 'repair',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `automobile_repair`
--

INSERT INTO `automobile_repair` (`id`, `plate_no`, `item`, `amount`, `details`, `receipt`, `station`, `mode`, `date_created`) VALUES
(6, 'abc1315', 'break', 100, 'test', 'N/A', '', 'repair', '2015-01-02 01:30:04'),
(7, 'abc1315', 'bumper', 1000, 'test', '', '', 'repair', '2015-01-02 01:30:04'),
(8, 'abc1315', 'wind shield', 2000, 'damaged', '', '', 'replace', '2015-01-02 01:30:04'),
(9, '1598fd', 'horn', 5000, 'not working', '', '', 'replace', '2016-06-08 07:17:34'),
(10, '1598fd', 'seat cover', 2150, 'dirty', '56-09dghy3', 'kawasaki repair shop', 'repair', '2016-06-08 07:18:35'),
(12, '1598fd', 'Horn', 1500, '', '', '', 'replace', '2016-09-15 03:14:29'),
(15, '1598fd', 'test2', 10, 'twat1', '1000', 'gfgdsf', 'repair', '2016-09-15 03:23:41'),
(16, '1598fd', 'lahat', 25000, 'lahart', 'jdslfjskj', 'china HK', 'replace', '2016-09-15 03:31:30'),
(17, '0EV-21859', 'test', 100, 'test', 'test', 'test', 'repair', '2016-10-03 05:56:54');

-- --------------------------------------------------------

--
-- Table structure for table `cust_passengers`
--

CREATE TABLE IF NOT EXISTS `cust_passengers` (
`id` int(11) NOT NULL,
  `tr_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cust_passengers`
--

INSERT INTO `cust_passengers` (`id`, `tr_id`, `full_name`, `designation`) VALUES
(7, 333, 'sdfdsfdsf', 'sdfsf'),
(10, 335, 'estset', 'dsfdsf'),
(15, 338, 'test', 'test'),
(16, 315, 'john hey', 'baguio staff'),
(17, 355, 'MR. JK', 'hardinero'),
(18, 368, 'test', 'dasdasds'),
(19, 315, 'john hey', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `dc`
--

CREATE TABLE IF NOT EXISTS `dc` (
`id` int(11) NOT NULL,
  `days` varchar(255) NOT NULL,
  `rate` float NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dc`
--

INSERT INTO `dc` (`id`, `days`, `rate`, `date_created`) VALUES
(1, 'week day', 74.71, '2015-06-09'),
(2, 'week end', 77.7, '2015-06-09'),
(3, 'holiday', 119.54, '2015-06-09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `finished`
--
CREATE TABLE IF NOT EXISTS `finished` (
`id` int(11)
,`tr_id` int(11)
,`res_id` int(11)
,`location` varchar(255)
,`destination` varchar(255)
,`departure_time` time
,`departure_date` date
,`actual_departure_time` time
,`returned_time` time
,`linked` enum('yes','no')
,`status` enum('finished','ongoing','canceled','scheduled')
,`date_created` timestamp
,`returned_date` date
,`plate_no` varchar(255)
,`manufacturer` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `ongoing`
--
CREATE TABLE IF NOT EXISTS `ongoing` (
`id` int(11)
,`tr_id` int(11)
,`res_id` int(11)
,`location` varchar(255)
,`destination` varchar(255)
,`departure_time` time
,`departure_date` date
,`actual_departure_time` time
,`returned_time` time
,`linked` enum('yes','no')
,`status` enum('finished','ongoing','canceled','scheduled')
,`date_created` timestamp
,`returned_date` date
,`plate_no` varchar(255)
,`manufacturer` varchar(255)
);
-- --------------------------------------------------------

--
-- Table structure for table `otf_projects`
--

CREATE TABLE IF NOT EXISTS `otf_projects` (
`id` int(11) NOT NULL,
  `tr_id` int(11) NOT NULL,
  `project` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `otf_projects`
--

INSERT INTO `otf_projects` (`id`, `tr_id`, `project`) VALUES
(1, 347, 'N/A'),
(2, 349, 'N/A'),
(3, 350, 'Assessment and Management of Risks due to Natural Calamities in support of QUEDANCOR\\''s Lending Operations'),
(4, 350, 'Assessment and Management of Risks due to Natural Calamities in support of QUEDANCOR\\''s Lending Operations'),
(5, 350, 'Assessment and Management of Risks due to Natural Calamities in support of QUEDANCOR\\''s Lending Operations'),
(6, 350, 'Assessment and Management of Risks due to Natural Calamities in support of QUEDANCOR\\''s Lending Operations'),
(8, 354, 'Agricultural Innovation System in Southeast Asia'),
(9, 355, 'Asia Pacific Adaptation network (APAN) Thematic Node for Agriculture'),
(11, 333, 'Assessment and Management of Risks due to Natural Calamities in support of QUEDANCOR\\''s Lending Operations'),
(12, 368, 'Assessment of the Gulayan ng Masa Program of the Department of Agriculture (DA)'),
(13, 381, 'Assessment of Current Capacities and Needs for Institutional and Individual Capacity Development in Agricultural Innovation Systems in Asia'),
(15, 382, 'Agricultural Technology and Vocational Teachers Training'),
(16, 383, 'Agrarian Reform Communities Project II (TA 4390-PHI)'),
(17, 385, 'Adapting and Transferring Lessons Learned from Manupali to Other Critical Watersheds in Southeast Asia');

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `uid` int(11) NOT NULL,
  `tr_id` int(11) DEFAULT NULL,
  `type` enum('staff','scholar') NOT NULL DEFAULT 'staff',
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=458 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passengers`
--

INSERT INTO `passengers` (`uid`, `tr_id`, `type`, `id`) VALUES
(67, 273, 'staff', 290),
(27, 273, 'staff', 291),
(6, 276, 'scholar', 292),
(41, 276, 'staff', 293),
(40, 276, 'staff', 294),
(1, 278, 'staff', 295),
(67, 283, 'staff', 296),
(1, 284, 'staff', 298),
(4, 291, 'staff', 299),
(3, 291, 'staff', 300),
(8, 291, 'scholar', 304),
(3, 291, 'scholar', 305),
(2, 291, 'scholar', 306),
(4, 291, 'staff', 313),
(3, 291, 'staff', 315),
(1, 291, 'staff', 316),
(4, 291, 'staff', 317),
(24, 291, 'staff', 318),
(3, 307, 'staff', 322),
(10, 307, 'staff', 323),
(32, 307, 'staff', 324),
(10, 308, 'staff', 325),
(12, 308, 'staff', 326),
(1, 309, 'staff', 327),
(3, 309, 'staff', 328),
(4, 310, 'staff', 329),
(10, 310, 'staff', 330),
(12, 311, 'staff', 331),
(10, 311, 'staff', 332),
(26, 313, 'staff', 335),
(27, 313, 'staff', 336),
(4, 314, 'staff', 337),
(10, 314, 'staff', 338),
(10, 315, 'staff', 339),
(4, 315, 'staff', 340),
(26, 315, 'staff', 341),
(1, 318, 'staff', 349),
(3, 318, 'staff', 350),
(10, 320, 'staff', 353),
(12, 320, 'staff', 354),
(4, 333, 'staff', 380),
(5, 333, 'scholar', 381),
(4, 334, 'staff', 383),
(1, 335, 'staff', 384),
(24, 338, 'staff', 389),
(1, 338, 'scholar', 390),
(12, 334, 'staff', 393),
(1, 315, 'scholar', 394),
(10, 340, 'staff', 395),
(3, 341, 'staff', 396),
(6, 341, 'scholar', 397),
(1, 348, 'staff', 398),
(1, 349, 'staff', 399),
(10, 350, 'staff', 400),
(1, 351, 'staff', 401),
(10, 354, 'staff', 404),
(3, 355, 'staff', 405),
(33, 355, 'staff', 406),
(31, 355, 'staff', 407),
(34, 355, 'staff', 411),
(35, 355, 'staff', 412),
(36, 355, 'staff', 413),
(28, 355, 'staff', 414),
(26, 355, 'staff', 415),
(1, 355, 'scholar', 416),
(15, 355, 'scholar', 417),
(1, NULL, 'staff', 423),
(3, NULL, 'staff', 424),
(25, NULL, 'staff', 425),
(26, NULL, 'staff', 426),
(3, 366, 'staff', 427),
(4, 366, 'staff', 428),
(24, 367, 'staff', 429),
(26, 367, 'staff', 430),
(27, 368, 'staff', 431),
(26, 368, 'staff', 432),
(2, 368, 'scholar', 433),
(3, 368, 'scholar', 434),
(5, 315, 'scholar', 435),
(24, 381, 'staff', 446),
(3, 382, 'staff', 447),
(4, 382, 'staff', 448),
(10, 383, 'staff', 449),
(12, 383, 'staff', 450),
(67, 384, 'staff', 451),
(102, 384, 'staff', 452),
(10, 384, 'staff', 453),
(25, 385, 'staff', 454),
(24, 385, 'staff', 455),
(28, 334, 'staff', 456),
(27, 334, 'staff', 457);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
`id` int(11) NOT NULL,
  `tr_id` int(11) DEFAULT NULL,
  `plate_no` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `departure_time` time NOT NULL,
  `departure_date` date NOT NULL,
  `status` enum('canceled','finished','reserved','ongoing') NOT NULL DEFAULT 'reserved',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `reservation`
--
DELIMITER //
CREATE TRIGGER `travel` AFTER UPDATE ON `reservation`
 FOR EACH ROW BEGIN DECLARE oldId INTEGER;
SET oldId=OLD.id;
IF(NEW.status='ongoing') THEN

INSERT INTO travel(res_id,destination,departure_time,departure_date,plate_no)values(OLD.id,OLD.destination,OLD.departure_time,OLD.departure_date,OLD.plate_no);

END IF;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tr`
--

CREATE TABLE IF NOT EXISTS `tr` (
`id` int(11) NOT NULL,
  `purpose` text,
  `source_of_fund` enum('opf','otf','otfs','opfs') NOT NULL DEFAULT 'opf',
  `requested_by` int(11) DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `date_approved` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plate_no` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=386 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr`
--

INSERT INTO `tr` (`id`, `purpose`, `source_of_fund`, `requested_by`, `approved_by`, `date_approved`, `date_created`, `date_modified`, `plate_no`, `status`) VALUES
(273, 'dfgdfg dfg dg dfgdgdgd', 'opf', 1, NULL, '', '2016-10-10 02:47:40', '2016-12-13 06:09:37', NULL, 0),
(274, 'dfgdfg dfg dg dfgdgdgd', 'opf', 67, NULL, '', '2016-10-10 06:11:56', '2016-12-13 06:09:37', NULL, 0),
(275, 'dfgdfg dfg dg dfgdgdgd', 'opf', 102, NULL, '', '2016-10-10 06:12:57', '2016-12-13 06:09:37', NULL, 0),
(276, 'dfgdfg dfg dg dfgdgdgd', 'opf', 67, NULL, '', '2016-10-10 06:16:16', '2016-12-13 06:09:37', NULL, 0),
(277, 'dfgdfg dfg dg dfgdgdgd', 'opf', 102, NULL, '', '2016-10-10 06:17:29', '2016-12-13 06:09:37', NULL, 0),
(278, 'dfgdfg dfg dg dfgdgdgd', 'opf', 14, NULL, '', '2016-10-11 05:45:44', '2016-12-13 06:09:37', NULL, 0),
(279, 'dfgdfg dfg dg dfgdgdgd', 'opf', 14, NULL, '', '2016-10-12 03:11:40', '2016-12-13 06:09:37', NULL, 0),
(283, 'dfgdfg dfg dg dfgdgdgd', 'opf', 14, NULL, '', '2016-10-12 05:41:24', '2016-12-13 06:09:37', NULL, 0),
(284, 'dfgdfg dfg dg dfgdgdgd', 'opf', 1, NULL, '', '2016-10-17 01:36:42', '2016-12-13 06:09:37', NULL, 0),
(289, 'dfgdfg dfg dg dfgdgdgd', 'opf', 14, NULL, '', '2016-10-17 04:01:35', '2016-12-13 06:09:37', NULL, 0),
(290, 'dfgdfg dfg dg dfgdgdgd', 'opf', 16, NULL, '', '2016-11-09 08:08:58', '2017-01-09 08:25:33', NULL, 0),
(291, 'dfgdfg dfg dg dfgdgdgd', 'opf', 16, NULL, '', '2016-11-21 05:36:24', '2016-12-13 06:09:37', NULL, 0),
(294, 'dfgdfg dfg dg dfgdgdgd', 'opf', 16, NULL, '', '2016-12-13 05:54:48', '2016-12-13 06:09:37', NULL, 0),
(295, 'dfgdfg dfg dg dfgdgdgd', 'opf', 16, NULL, '', '2016-12-13 05:55:38', '2016-12-13 06:09:37', NULL, 0),
(296, 'dfgdfg dfg dg dfgdgdgd', 'opf', 16, NULL, '', '2016-12-13 05:56:45', '2016-12-13 06:09:37', NULL, 0),
(303, 'Before using Redis sessions with Laravel, you will need to install the predis/predis package (~1.0) via Composer. You may configure your Redis connections in the database configuration file. In the  session configuration file, the connection option may be used to specify which Redis connection is used by the session.', 'opf', 16, NULL, '', '2016-12-13 06:12:29', '2016-12-13 06:12:45', NULL, 0),
(307, 'asd', 'opf', 16, NULL, '', '2016-12-13 06:56:16', '2016-12-13 06:56:16', NULL, 0),
(308, ' aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n', 'opf', 16, NULL, '', '2016-12-13 07:34:08', '2016-12-13 07:34:08', NULL, 0),
(309, 'at cupidatat non proident, sunt in culpa qui officia deserunt mollit a', 'opf', 16, NULL, '', '2016-12-13 07:35:44', '2016-12-13 07:35:44', NULL, 0),
(310, ' consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'opf', 16, NULL, '', '2016-12-13 07:41:14', '2016-12-13 07:41:14', NULL, 0),
(311, ' consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'opf', 16, NULL, '', '2016-12-13 07:42:02', '2016-12-13 07:42:02', NULL, 0),
(313, 'ate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est la', 'opf', 16, NULL, '', '2016-12-13 07:49:48', '2016-12-13 07:49:48', NULL, 0),
(314, 'ate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est la', 'opf', 16, NULL, '', '2016-12-13 07:50:17', '2016-12-13 07:50:17', NULL, 0),
(315, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est ', 'opf', 16, NULL, '', '2016-12-13 07:51:19', '2017-01-23 07:27:32', NULL, 2),
(318, 'function dx', 'opf', 16, NULL, '', '2016-12-15 01:34:48', '2016-12-20 02:23:48', NULL, 0),
(319, 'test', 'opf', 16, NULL, '', '2016-12-21 04:06:51', '2016-12-21 04:06:51', NULL, 0),
(320, 'test', 'opf', 16, NULL, '', '2016-12-21 07:15:03', '2016-12-21 07:15:03', NULL, 0),
(333, 'dfsfds', 'otf', 16, NULL, '', '2016-12-29 06:10:10', '2017-01-23 02:13:25', NULL, 2),
(334, 'ahah', 'opf', 16, NULL, '', '2016-12-29 06:22:51', '2017-01-11 04:48:07', NULL, 3),
(335, 'test', 'opf', 24, NULL, '', '2016-12-29 06:53:32', '2017-01-06 01:29:49', NULL, 4),
(338, 'test submitted to be viewed by admin', 'opf', 24, NULL, '', '2016-12-29 06:53:32', '2017-01-05 07:10:46', NULL, 4),
(339, 'test', 'opf', 16, NULL, '', '2017-01-06 02:26:20', '2017-01-12 00:48:27', NULL, 2),
(340, 'testing', 'opf', 16, NULL, '', '2017-01-10 09:10:26', '2017-01-10 09:10:26', NULL, 0),
(341, 'test', 'opf', 16, NULL, '', '2017-01-19 01:13:24', '2017-01-19 01:13:24', NULL, 0),
(342, 'teeeeee', 'opf', 16, NULL, '', '2017-01-19 02:17:57', '2017-01-19 02:17:57', NULL, 0),
(343, 'hahahah', '', 16, NULL, '', '2017-01-19 02:18:39', '2017-01-19 02:19:13', NULL, 0),
(344, 'haha', '', 16, NULL, '', '2017-01-19 02:21:28', '2017-01-19 02:21:31', NULL, 0),
(345, 'tesa', '', 16, NULL, '', '2017-01-19 02:30:38', '2017-01-19 02:30:40', NULL, 0),
(346, 'test', '', 16, NULL, '', '2017-01-19 02:31:50', '2017-01-19 02:31:53', NULL, 0),
(347, 'testtestes', '', 16, NULL, '', '2017-01-19 02:35:50', '2017-01-19 02:35:53', NULL, 0),
(348, 'testtest', 'opf', 16, NULL, '', '2017-01-19 02:38:56', '2017-01-19 02:38:56', NULL, 0),
(349, 'test', '', 16, NULL, '', '2017-01-19 02:39:06', '2017-01-19 02:39:27', NULL, 0),
(350, 'test', 'otf', 16, NULL, '', '2017-01-19 02:40:03', '2017-01-19 05:31:10', NULL, 0),
(351, 'test', '', 16, NULL, '', '2017-01-19 02:49:10', '2017-01-19 02:49:30', NULL, 0),
(354, 'toinks', 'otf', 16, NULL, '', '2017-01-19 03:25:40', '2017-01-19 03:26:10', NULL, 0),
(355, 'SOUTHEAST ASIAN REGIONAL CENTER FOR GRADUATE', 'otf', 16, NULL, '', '2017-01-19 03:55:49', '2017-01-20 08:46:14', NULL, 0),
(356, 'test', 'opf', NULL, NULL, '', '2017-01-20 08:51:02', '2017-01-20 08:51:02', NULL, 0),
(360, 'with new approved', 'opf', 16, 'Adoracion T. Robles', '', '2017-01-20 09:03:15', '2017-01-26 03:14:05', NULL, 1),
(366, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'opf', 26, 'Adoracion T. Robles', '', '2017-01-20 09:42:50', '2017-01-20 09:42:50', NULL, 0),
(367, 'new gc and dc value tes', 'opf', 15, 'ICU', '', '2017-01-23 02:26:27', '2017-01-23 02:27:05', NULL, 0),
(368, 'test again for new dc and gc value', 'otf', 14, 'Adoracion T. Robles', '', '2017-01-23 02:28:05', '2017-01-26 03:22:41', NULL, 3),
(381, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n', 'opf', 25, 'Gil C. Saguiguit Jr.', '', '2017-01-25 06:13:44', '2017-01-25 09:31:10', NULL, 0),
(382, 'tetetetststst', 'otf', 15, 'ICU', '', '2017-01-26 00:52:42', '2017-01-26 00:53:04', NULL, 0),
(383, 'testing', 'otf', 15, 'ICU', '', '2017-01-26 03:46:14', '2017-01-26 03:46:59', NULL, 0),
(384, 'ed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totamas', 'opf', 16, 'Adoracion T. Robles', '', '2017-01-26 05:22:58', '2017-01-26 06:35:07', NULL, 2),
(385, 'test', 'otf', 15, 'ICU', '', '2017-01-27 07:50:20', '2017-01-27 07:50:48', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE IF NOT EXISTS `travel` (
`id` int(11) NOT NULL,
  `tr_id` int(11) DEFAULT NULL,
  `res_id` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `departure_time` time NOT NULL,
  `actual_departure_time` time NOT NULL,
  `returned_time` time NOT NULL,
  `departure_date` date NOT NULL,
  `returned_date` date NOT NULL,
  `status` enum('finished','ongoing','canceled','scheduled') NOT NULL DEFAULT 'scheduled',
  `plate_no` varchar(255) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `linked` enum('yes','no') NOT NULL DEFAULT 'no',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=327 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id`, `tr_id`, `res_id`, `location`, `destination`, `departure_time`, `actual_departure_time`, `returned_time`, `departure_date`, `returned_date`, `status`, `plate_no`, `driver_id`, `linked`, `date_created`) VALUES
(255, 273, NULL, 'SEARCA', 'Cavite', '05:00:00', '09:37:05', '00:00:00', '2016-10-26', '0000-00-00', 'finished', 'abc1315', 142, 'yes', '2016-10-10 02:47:40'),
(256, 274, NULL, 'SEARCA', 'Cavite', '04:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-10 06:11:56'),
(257, 275, NULL, 'SEARCA', 'Cavite', '04:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-10 06:12:57'),
(258, 276, NULL, 'Cabuyao', 'Tagaytay', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-10 06:16:16'),
(259, 277, NULL, 'Cabuyao', 'Tagaytay', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-10 06:17:29'),
(260, 278, NULL, 'test', 'test', '02:00:00', '00:00:00', '00:00:00', '2016-10-29', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-11 05:45:45'),
(261, 279, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-12 03:11:40'),
(265, 283, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-12 05:41:24'),
(266, 284, NULL, 'test', 'test', '05:00:00', '09:43:31', '00:00:00', '2016-10-29', '0000-00-00', 'scheduled', '0EV-21859', 141, 'no', '2016-10-17 01:36:42'),
(271, 289, NULL, 'test', 'Test', '05:00:00', '00:00:00', '00:00:00', '2016-10-29', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-17 04:01:35'),
(272, 290, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-11-30', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-11-09 08:08:58'),
(273, 291, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-11-30', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-11-21 05:36:24'),
(275, 291, NULL, 'SEARA', 'Tagaytay', '04:00:00', '00:00:00', '00:00:00', '2016-12-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-08 07:09:43'),
(282, 303, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 06:46:49'),
(283, 310, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-14', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:41:31'),
(284, 311, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:42:21'),
(286, 311, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:46:49'),
(288, 313, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:50:03'),
(289, 314, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-29', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:50:35'),
(290, 315, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', '0EV-21859', 142, 'yes', '2016-12-13 07:51:36'),
(291, 339, NULL, 'test', 'a', '05:00:00', '00:00:00', '00:00:00', '2017-01-30', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-09 08:15:58'),
(293, 333, NULL, 'Mayondon', 'Cabuyao', '05:00:00', '05:00:00', '04:30:00', '2017-01-31', '2017-02-02', 'scheduled', '4589df', 139, 'no', '2017-01-12 03:43:25'),
(294, 341, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-20', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-19 01:13:45'),
(295, 349, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-17', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-19 02:39:23'),
(296, 350, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-25', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-19 02:40:19'),
(297, 351, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-23', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-19 02:49:26'),
(300, 354, NULL, 'a', 'b', '05:00:00', '00:00:00', '00:00:00', '2017-01-28', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-19 03:25:58'),
(301, 355, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-19 03:56:03'),
(306, 366, NULL, 'hshs', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-20 09:44:04'),
(307, 367, NULL, 'test123', 'test1234', '01:00:00', '00:00:00', '00:00:00', '2017-01-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-23 02:26:47'),
(308, 368, NULL, 'test123', 'test1234', '05:00:00', '00:00:00', '00:00:00', '2017-01-30', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-23 02:28:21'),
(309, 381, NULL, 'test', 'hehe', '05:00:00', '00:00:00', '00:00:00', '2017-01-25', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-25 06:14:03'),
(310, 382, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-26 00:53:00'),
(311, 383, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2017-01-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-26 03:46:31'),
(312, 355, NULL, 'test1236', 'test123', '05:00:00', '00:00:00', '00:00:00', '2017-01-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2017-01-26 05:22:08'),
(313, 384, NULL, 'SEARCA', 'Makati', '05:00:00', '00:00:00', '00:00:00', '2017-01-31', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2017-01-26 05:23:43'),
(316, 384, NULL, 'Cabuyao', 'Quezon', '05:00:00', '00:00:00', '00:00:00', '2017-01-31', '0000-00-00', 'ongoing', NULL, 143, 'no', '2017-01-26 06:06:11'),
(326, 385, NULL, 'a', 'b', '05:00:00', '00:00:00', '00:00:00', '2017-01-27', '0000-00-00', 'scheduled', NULL, 133, 'no', '2017-01-27 07:50:45');

--
-- Triggers `travel`
--
DELIMITER //
CREATE TRIGGER `autostat` AFTER UPDATE ON `travel`
 FOR EACH ROW BEGIN

IF(NEW.status='ongoing' and (OLD.plate_no IS NOT NULL)) THEN

	
    	UPDATE automobile set availability='in_use' where plate_no=OLD.plate_no;
   

END IF;

IF(NEW.status='finished' and (OLD.plate_no IS NOT NULL)) THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
        
       

END IF;

IF(OLD.status='ongoing' and NEW.status='canceled') THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
   

END IF;


IF(NEW.status='scheduled') THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
   

END IF;




END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `travel_link`
--

CREATE TABLE IF NOT EXISTS `travel_link` (
`id` int(11) NOT NULL,
  `child_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pay_extra_charge` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_link`
--

INSERT INTO `travel_link` (`id`, `child_id`, `parent_id`, `date_created`, `pay_extra_charge`) VALUES
(1, 271, 266, '2016-10-17 04:01:39', 'yes'),
(41, 290, 293, '2017-01-23 07:27:42', 'yes'),
(43, 313, 316, '2017-01-26 06:35:26', 'yes');

--
-- Triggers `travel_link`
--
DELIMITER //
CREATE TRIGGER `autoLinked` AFTER INSERT ON `travel_link`
 FOR EACH ROW BEGIN

UPDATE travel set linked='yes' where id=NEW.child_id;

END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trc`
--

CREATE TABLE IF NOT EXISTS `trc` (
`id` int(11) NOT NULL,
  `requested_by` int(11) DEFAULT NULL,
  `approved_by` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trc`
--

INSERT INTO `trc` (`id`, `requested_by`, `approved_by`, `date_created`, `date_modified`, `status`) VALUES
(32, 1, 0, '2016-10-11 02:14:46', '2016-10-11 02:14:46', 0),
(33, 14, 0, '2016-10-11 06:32:08', '2016-10-12 01:23:22', 0),
(34, 15, 0, '2016-12-05 06:31:40', '2016-12-05 06:31:40', 0),
(53, 16, 0, '2017-01-03 05:34:37', '2017-01-03 05:34:37', 0),
(55, 16, 0, '2017-01-25 06:39:28', '2017-01-27 01:14:16', 2),
(56, 25, 0, '2017-01-25 06:42:04', '2017-01-25 06:42:04', 0),
(57, 14, 0, '2017-01-26 08:41:45', '2017-01-26 09:07:52', 2),
(61, 15, 0, '2017-01-26 09:12:22', '2017-01-26 09:12:22', 0),
(62, 14, 0, '2017-01-26 09:14:53', '2017-01-26 09:15:23', 2);

-- --------------------------------------------------------

--
-- Table structure for table `trc_charge`
--

CREATE TABLE IF NOT EXISTS `trc_charge` (
`id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `start` float NOT NULL,
  `end` float NOT NULL,
  `gc` int(11) DEFAULT NULL,
  `dc` int(11) DEFAULT NULL,
  `dca` enum('contracted','emergency') NOT NULL DEFAULT 'contracted',
  `gasoline_charge` double NOT NULL,
  `drivers_charge` double NOT NULL,
  `base_km` float DEFAULT NULL,
  `drivers_day_rate` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trc_charge`
--

INSERT INTO `trc_charge` (`id`, `rid`, `start`, `end`, `gc`, `dc`, `dca`, `gasoline_charge`, `drivers_charge`, `base_km`, `drivers_day_rate`) VALUES
(12, 69, 1000, 1500, 7, 1, 'contracted', 25, 74.71, NULL, 'week day');

-- --------------------------------------------------------

--
-- Table structure for table `trc_charge_breakdown`
--

CREATE TABLE IF NOT EXISTS `trc_charge_breakdown` (
`id` int(11) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `charge` double NOT NULL,
  `additional_charge` double NOT NULL,
  `drivers_overtime_charge` double NOT NULL,
  `overtime` float NOT NULL,
  `total` double NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trc_charge_breakdown`
--

INSERT INTO `trc_charge_breakdown` (`id`, `charge_id`, `charge`, `additional_charge`, `drivers_overtime_charge`, `overtime`, `total`, `date_created`, `date_modified`) VALUES
(3, 12, 25, 12500, 3586.08, 55, 16111.08, '2017-01-27 07:00:00', '2017-01-27 07:49:22'),
(4, 13, 3500, 33250, 6574.7, 55, 43324.7, '2017-01-27 07:00:00', '2017-01-27 07:07:06');

-- --------------------------------------------------------

--
-- Table structure for table `trc_travel`
--

CREATE TABLE IF NOT EXISTS `trc_travel` (
`id` int(11) NOT NULL,
  `trc_id` int(11) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `kms` int(11) DEFAULT NULL,
  `departure_time` time NOT NULL,
  `actual_departure_time` time NOT NULL,
  `returned_time` time DEFAULT NULL,
  `departure_date` date NOT NULL,
  `returned_date` date NOT NULL,
  `purpose` text NOT NULL,
  `status` enum('finished','ongoing','canceled','scheduled') NOT NULL DEFAULT 'scheduled',
  `plate_no` varchar(255) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trc_travel`
--

INSERT INTO `trc_travel` (`id`, `trc_id`, `location`, `destination`, `kms`, `departure_time`, `actual_departure_time`, `returned_time`, `departure_date`, `returned_date`, `purpose`, `status`, `plate_no`, `driver_id`, `date_created`) VALUES
(43, 32, 'Mayondon', 'Cabuyao', NULL, '18:00:00', '00:00:00', NULL, '2016-10-29', '0000-00-00', '', 'scheduled', NULL, 0, '2016-10-11 02:14:46'),
(44, 33, 'Mayondon', 'Vega', NULL, '08:00:00', '00:00:00', NULL, '2016-10-29', '0000-00-00', '', 'scheduled', NULL, 0, '2016-10-11 06:32:08'),
(45, 34, 'SEARCA', 'test', NULL, '03:00:00', '00:00:00', NULL, '2016-12-31', '0000-00-00', '', 'scheduled', NULL, 0, '2016-12-05 06:31:40'),
(61, 53, 'hshs', 'test', NULL, '05:00:00', '00:00:00', NULL, '2017-05-01', '0000-00-00', '', 'scheduled', NULL, 0, '2017-01-03 05:34:37'),
(63, 55, 'test', 'hehe', NULL, '05:00:00', '00:00:00', NULL, '2017-01-30', '0000-00-00', '', 'scheduled', NULL, 0, '2017-01-25 06:39:29'),
(64, 56, 'test', 'test1235', NULL, '05:00:00', '00:00:00', NULL, '2017-01-31', '0000-00-00', '', 'scheduled', NULL, 0, '2017-01-25 06:42:04'),
(69, 57, 'SEARCA', 'test', NULL, '17:00:00', '00:00:00', NULL, '2017-03-16', '2017-03-19', '', 'scheduled', NULL, 0, '2017-01-26 09:07:11'),
(70, 61, 'SEARCA', 'SEARCA', NULL, '05:00:00', '00:00:00', NULL, '2017-02-09', '0000-00-00', '', 'scheduled', NULL, 141, '2017-01-26 09:12:22'),
(71, 62, 'SEARCA', 'SEARCA', NULL, '05:00:00', '00:00:00', NULL, '2017-02-23', '0000-00-00', '', 'scheduled', NULL, 140, '2017-01-26 09:14:53');

--
-- Triggers `trc_travel`
--
DELIMITER //
CREATE TRIGGER `autostarttrc` AFTER UPDATE ON `trc_travel`
 FOR EACH ROW BEGIN

IF(NEW.status='ongoing' and (OLD.plate_no IS NOT NULL)) THEN

	
    	UPDATE automobile set availability='in_use' where plate_no=OLD.plate_no;
   

END IF;

IF(NEW.status='finished' and (OLD.plate_no IS NOT NULL)) THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
        
       

END IF;

IF(OLD.status='ongoing' and NEW.status='canceled') THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
   

END IF;

IF(NEW.status='scheduled') THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
   

END IF;




END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trp`
--

CREATE TABLE IF NOT EXISTS `trp` (
`id` int(11) NOT NULL,
  `purpose` text,
  `mode_of_payment` enum('sd','cash') NOT NULL DEFAULT 'cash',
  `requested_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time DEFAULT NULL,
  `actual_departure_time` time NOT NULL,
  `returned_date` date NOT NULL,
  `returned_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `charge_to` int(11) DEFAULT NULL,
  `vehicle_type` int(11) NOT NULL DEFAULT '1',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plate_no` varchar(255) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `status` enum('finished','ongoing','canceled','scheduled') NOT NULL DEFAULT 'scheduled',
  `trp_status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp`
--

INSERT INTO `trp` (`id`, `purpose`, `mode_of_payment`, `requested_by`, `approved_by`, `departure_date`, `departure_time`, `actual_departure_time`, `returned_date`, `returned_time`, `location`, `destination`, `charge_to`, `vehicle_type`, `date_created`, `date_modified`, `plate_no`, `driver_id`, `status`, `trp_status`) VALUES
(8, 'test', 'cash', 16, NULL, '2016-10-29', '03:00:00', '00:00:00', '0000-00-00', '00:00:00', 'SEARA', 'Tagaytay', NULL, 3, '2016-10-11 01:21:39', '2017-01-09 03:33:58', 'AXA 1341', 139, 'scheduled', 0),
(11, NULL, 'sd', 14, NULL, '2016-10-29', '00:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-10-11 05:59:29', '2016-10-11 06:03:47', NULL, 0, 'scheduled', 0),
(13, NULL, 'sd', 14, NULL, '2016-10-31', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-10-11 06:09:35', '2016-10-12 07:56:30', NULL, 143, 'canceled', 0),
(14, 'alert(''Oops something went wrong!Please try again later.'')', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-14 07:21:24', '2016-12-14 07:21:24', NULL, 0, 'scheduled', 0),
(15, 'alert(''Oops something went wrong!Please try again later.'')', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-14 07:21:32', '2016-12-14 07:21:32', NULL, 0, 'scheduled', 0),
(16, 'if(res>0&&res.length<50){', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-14 07:22:11', '2016-12-14 07:22:11', NULL, 0, 'scheduled', 0),
(17, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-14 09:44:34', '2016-12-14 09:44:34', NULL, 0, 'scheduled', 0),
(18, 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 01:22:57', '2016-12-15 01:22:57', NULL, 0, 'scheduled', 0),
(19, 'dsfsadf af adfa ', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 01:34:18', '2016-12-15 01:34:18', NULL, 0, 'scheduled', 0),
(20, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 01:42:29', '2016-12-15 01:42:29', NULL, 0, 'scheduled', 0),
(21, '<?php\n\nnamespace App\\Http\\Controllers;\n\nuse Illuminate\\Http\\Request;\n\nuse Illuminate\\Support\\Facades\\DB;\n\n\nuse App\\Http\\Requests;\n\n\n\n\nclass Official_staff extends Controller\n{\n    /**\n     * Display a listing of the resource.\n     *\n     * @return \\Illuminate\\Http\\Response\n     */\n    public function index($id)\n    {\n\n        try{\n                $this->pdoObject=DB::connection()->getPdo();\n                $this->id=htmlentities(htmlspecialchars($id));\n                $this->pdoObject->beginTransaction();\n                $sql="SELECT passengers.id,passengers.uid,login_db.account_profile.profile_name,login_db.account_profile.position,login_db.account_profile.profile_image,login_db.department.dept_name,login_db.department.dept_alias  FROM passengers LEFT JOIN login_db.account_profile on login_db.account_profile.uid=passengers.uid LEFT JOIN login_db.department on login_db.department.dept_id=login_db.account_profile.dept_id  where  tr_id=:id and type=''staff''";\n                $statement=$this->pdoObject->prepare($sql);\n                $statement->bindParam('':id'',$this->id);\n                $statement->execute();\n                $res=Array();\n                while($row=$statement->fetch(\\PDO::FETCH_OBJ)){\n                    $res[]=Array(''name''=>$row->profile_name,''uid''=>$row->uid,''id''=>$row->id,''designation''=>$row->position,''office''=>$row->dept_name,''profile_image''=>$row->profile_image,''allias''=>$row->dept_alias);\n                }\n                $this->pdoObject->commit();\n\n                return json_encode($res);\n\n        }catch(Exception $e){echo $e->getMessage();$this->pdoObject->rollback();}\n\n\n     \n    }\n\n    /**\n     * Show the form for creating a new resource.\n     *\n     * @return \\Illuminate\\Http\\Response\n     */\n    public function create(Request $request)\n    {\n        $id = $request->input(''id'');\n        $uid = $request->input(''uid'');\n        $token = $request->input(''_token'');\n\n        if(!empty($id)&&!empty($uid)&&!empty($token)){\n            \n           try{\n\n                $this->pdoObject=DB::connection()->getPdo();\n                #begin transaction\n                $this->pdoObject->beginTransaction();\n                \n                $insert_sql="INSERT INTO passengers(tr_id,uid)values(:tr_id,:uid)";\n                $insert_statement=$this->pdoObject->prepare($insert_sql);\n        \n                #params\n                $insert_statement->bindParam('':tr_id'',$id);\n                $insert_statement->bindParam('':uid'',$uid);\n  \n                #exec the transaction\n                $insert_statement->execute();\n                $lastId=$this->pdoObject->lastInsertId();\n                $this->pdoObject->commit();\n\n                #return\n                echo $lastId;\n\n            }catch(Exception $e){ echo $e->getMessage();$this->pdoObject->rollback();} \n\n\n        }else{\n            echo 0;\n        }\n        \n    }\n\n\n\n    /**\n     * Display the specified resource.\n     *\n     * @param  int  $id\n     * @return \\Illuminate\\Http\\Response\n     */\n    public function show($id)\n    {\n        //\n    }\n\n   \n\n    /**\n     * Remove the specified resource from storage.\n     *\n     * @param  int  $id\n     * @return \\Illuminate\\Http\\Response\n     */\n    public function destroy($id)\n    {\n        try{\n                $this->pdoObject=DB::connection()->getPdo();\n                $this->id=htmlentities(htmlspecialchars($id));\n                $this->pdoObject->beginTransaction();\n                $remove_rfp_sql="DELETE FROM passengers where id=:id";\n                $remove_statement=$this->pdoObject->prepare($remove_rfp_sql);\n                $remove_statement->bindParam('':id'',$this->id);\n                $remove_statement->execute();\n                $this->pdoObject->commit();\n\n                return $remove_statement->rowCount()>0?$remove_statement->rowCount():0;\n\n        }catch(Exception $e){/*echo $e->getMessage();*/$this->pdoObject->rollback();}\n    }\n}\n', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 01:43:03', '2016-12-15 01:43:03', NULL, 0, 'scheduled', 0),
(22, 'asdsd', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 02:08:22', '2016-12-15 02:08:22', NULL, 0, 'scheduled', 0),
(23, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 02:52:47', '2016-12-15 02:52:47', NULL, 0, 'scheduled', 0),
(24, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 03:03:21', '2016-12-15 03:03:21', NULL, 0, 'scheduled', 0),
(25, 'asdsd', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 03:17:59', '2016-12-15 03:17:59', NULL, 0, 'scheduled', 0),
(26, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 03:24:48', '2016-12-15 03:24:48', NULL, 0, 'scheduled', 0),
(27, 'test', 'sd', 16, NULL, '2016-12-19', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-12-15 03:25:43', '2016-12-15 03:26:05', NULL, 0, 'scheduled', 0),
(28, 'something', 'sd', 16, NULL, '2016-12-23', '07:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'laguna', NULL, 1, '2016-12-15 03:27:36', '2016-12-15 03:30:48', NULL, 3, 'scheduled', 0),
(29, 'test', 'sd', 16, NULL, '2016-12-30', '06:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'laguna', NULL, 1, '2016-12-15 03:36:56', '2016-12-15 03:37:38', NULL, 3, 'scheduled', 0),
(30, 'test', 'sd', 16, NULL, '2016-12-24', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-12-15 03:42:21', '2016-12-15 03:42:40', NULL, 4, 'scheduled', 0),
(31, 'enderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id e', 'sd', 16, NULL, '2016-12-29', '06:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-12-15 03:43:50', '2016-12-15 03:44:10', NULL, 2, 'scheduled', 0),
(32, 'test', 'sd', 16, NULL, '2016-12-31', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-12-15 03:44:38', '2016-12-15 03:44:59', NULL, 3, 'scheduled', 0),
(33, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 2, '2016-12-15 06:16:36', '2016-12-15 06:19:18', NULL, 0, 'scheduled', 0),
(34, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 2, '2016-12-15 06:19:52', '2016-12-15 06:19:56', NULL, 0, 'scheduled', 0),
(35, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 3, '2016-12-15 06:29:03', '2016-12-15 06:29:06', NULL, 0, 'scheduled', 0),
(36, 'again', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 3, '2016-12-15 06:31:41', '2016-12-15 06:31:44', NULL, 0, 'scheduled', 0),
(37, 'test', 'sd', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-15 07:50:52', '2016-12-15 07:59:20', NULL, 0, 'scheduled', 0),
(38, 'This JavaScript code will type words iside a section of your webpage.This will bring life to your dull and lifeless texts. Go to the sample page to see in action', 'sd', 16, NULL, '2016-12-30', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'Los Ba&ntilde;os', 'Cabuyao', NULL, 2, '2016-12-15 08:06:40', '2016-12-15 08:07:35', NULL, 6, 'scheduled', 0),
(39, 'This JavaScript code will type words iside a section of your webpage.This will bring life to your dull and lifeless texts. Go to the sample page to see in action', 'sd', 16, NULL, '2016-12-31', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'Los Ba&ntilde;os', 'Cabuyao', NULL, 2, '2016-12-15 08:08:21', '2016-12-15 08:09:47', NULL, 2, 'scheduled', 0),
(40, 'changeCircleState(''.vehicle-circle-group'')\n	changeButtonState(''.vehicleTypeFormButton'',''enabled'')', 'sd', 16, NULL, '2016-12-07', '06:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-12-15 08:11:32', '2016-12-15 08:23:47', NULL, 1, 'scheduled', 0),
(41, 'test', 'cash', 16, NULL, '2016-12-31', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 2, '2016-12-19 00:40:34', '2016-12-19 00:42:07', NULL, 2, 'scheduled', 0),
(42, 'test', 'sd', 16, NULL, '2016-12-31', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 3, '2016-12-19 00:43:14', '2016-12-19 00:45:02', NULL, 5, 'scheduled', 0),
(43, 'test', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-19 00:46:04', '2016-12-19 00:46:04', NULL, 0, 'scheduled', 0),
(44, 'test', 'sd', 16, NULL, '2017-01-11', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 3, '2016-12-19 00:46:16', '2016-12-19 00:46:40', NULL, 5, 'scheduled', 0),
(46, 'sd', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-19 00:48:45', '2016-12-19 00:48:45', NULL, 0, 'scheduled', 0),
(47, 'test', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-19 00:49:23', '2016-12-19 00:49:23', NULL, 0, 'scheduled', 0),
(49, 'hehe', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-19 00:53:16', '2016-12-19 00:53:16', NULL, 0, 'scheduled', 0),
(51, 'what?!', 'sd', 16, NULL, '2016-12-26', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'a', 'b', NULL, 3, '2016-12-19 02:54:17', '2016-12-20 01:39:42', NULL, 1, 'scheduled', 0),
(57, 'ss', 'sd', 16, NULL, '0000-00-00', '00:00:00', '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 2, '2016-12-19 08:40:18', '2016-12-21 06:26:08', NULL, 0, 'scheduled', 0),
(58, 'test', 'cash', 16, NULL, '0000-00-00', '00:00:00', '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-20 06:27:08', '2016-12-21 02:24:37', NULL, 0, 'scheduled', 0),
(59, 'test', 'cash', 16, NULL, '0000-00-00', '00:00:00', '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 05:46:41', '2016-12-21 06:19:58', NULL, 0, 'scheduled', 0),
(67, 'test', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 07:07:45', '2016-12-21 07:07:45', NULL, 0, 'scheduled', 0),
(68, 'test', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 07:10:43', '2016-12-21 07:10:43', NULL, 0, 'scheduled', 0),
(69, 'test', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 07:21:55', '2016-12-21 07:21:55', NULL, 0, 'scheduled', 0),
(75, 'test', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 07:56:20', '2016-12-21 07:56:20', NULL, 0, 'scheduled', 0),
(76, 'test', 'cash', 16, NULL, '2016-12-28', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'test', 'hehe', NULL, 1, '2016-12-21 07:58:28', '2016-12-21 07:58:55', NULL, 3, 'scheduled', 0),
(77, 'testtest', 'cash', 16, NULL, '2016-12-14', '05:00:00', '00:00:00', '0000-00-00', '00:00:00', 'hshs', 'test', NULL, 1, '2016-12-21 08:00:05', '2016-12-21 08:00:27', NULL, 3, 'scheduled', 0),
(78, 'test', 'cash', 16, NULL, '0000-00-00', '00:00:00', '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 08:02:16', '2016-12-21 08:03:47', NULL, 0, 'scheduled', 0),
(79, 'test', 'cash', 16, NULL, '0000-00-00', '00:00:00', '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2016-12-21 08:04:50', '2016-12-21 08:05:42', NULL, 0, 'scheduled', 0),
(85, 'test', 'sd', 16, NULL, '2017-01-28', '05:00:00', '00:00:00', '2017-01-29', '00:00:00', 'test', 'test', NULL, 1, '2017-01-03 05:32:03', '2017-01-26 06:43:36', '4589df', 139, 'scheduled', 2),
(86, 'hahaha', 'cash', 16, NULL, '0000-00-00', NULL, '00:00:00', '0000-00-00', '00:00:00', '', '', NULL, 1, '2017-01-03 05:33:54', '2017-01-09 04:04:04', NULL, 0, 'scheduled', 4);

--
-- Triggers `trp`
--
DELIMITER //
CREATE TRIGGER `autostattrp` AFTER UPDATE ON `trp`
 FOR EACH ROW BEGIN

IF(NEW.status='ongoing' and (OLD.plate_no IS NOT NULL)) THEN

	
    	UPDATE automobile set availability='in_use' where plate_no=OLD.plate_no;
   

END IF;

IF(NEW.status='finished' and (OLD.plate_no IS NOT NULL)) THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
        
       

END IF;

IF(OLD.status='ongoing' and NEW.status='canceled') THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
   

END IF;

IF(NEW.status='scheduled') THEN

	
    	UPDATE automobile set availability='available' where plate_no=OLD.plate_no;
   

END IF;





END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `trp_charge`
--

CREATE TABLE IF NOT EXISTS `trp_charge` (
`id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `start` float NOT NULL,
  `end` float NOT NULL,
  `gc` int(11) DEFAULT NULL,
  `dc` int(11) DEFAULT NULL,
  `dca` enum('contracted','emergency','','') NOT NULL DEFAULT 'contracted',
  `gasoline_charge` double NOT NULL,
  `drivers_charge` double NOT NULL,
  `base_km` float NOT NULL,
  `drivers_day_rate` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp_charge`
--

INSERT INTO `trp_charge` (`id`, `rid`, `start`, `end`, `gc`, `dc`, `dca`, `gasoline_charge`, `drivers_charge`, `base_km`, `drivers_day_rate`) VALUES
(1, 8, 100, 0, 7, 1, 'emergency', 0, 0, 0, ''),
(13, 85, 1000, 2000, 1, 1, 'contracted', 1, 1, 150, 'week day');

-- --------------------------------------------------------

--
-- Table structure for table `trp_charge_breakdown`
--

CREATE TABLE IF NOT EXISTS `trp_charge_breakdown` (
`id` int(11) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `charge` double NOT NULL,
  `additional_charge` double NOT NULL,
  `drivers_overtime_charge` double NOT NULL,
  `overtime` float NOT NULL,
  `total` double NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp_charge_breakdown`
--

INSERT INTO `trp_charge_breakdown` (`id`, `charge_id`, `charge`, `additional_charge`, `drivers_overtime_charge`, `overtime`, `total`, `date_created`, `date_modified`) VALUES
(2, 12, 2700, 21750, 2271.26, 19, 26721.26, '2017-01-27 06:02:39', '2017-01-27 07:34:01'),
(4, 13, 3200, 21250, 279.079205, 19, 24729.079205, '2017-01-27 07:43:03', '2017-01-27 08:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `trp_cust_passengers`
--

CREATE TABLE IF NOT EXISTS `trp_cust_passengers` (
`id` int(11) NOT NULL,
  `trp_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp_cust_passengers`
--

INSERT INTO `trp_cust_passengers` (`id`, `trp_id`, `full_name`, `designation`) VALUES
(10, 86, 'agagaga', 'ghfhfh'),
(11, 85, 'test2', 'twat');

-- --------------------------------------------------------

--
-- Table structure for table `trp_passengers`
--

CREATE TABLE IF NOT EXISTS `trp_passengers` (
  `uid` int(11) NOT NULL,
  `trp_id` int(11) NOT NULL,
  `type` enum('staff','scholar') NOT NULL DEFAULT 'staff',
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp_passengers`
--

INSERT INTO `trp_passengers` (`uid`, `trp_id`, `type`, `id`) VALUES
(67, 8, 'staff', 13),
(3, 8, 'staff', 14),
(10, 21, 'staff', 15),
(1, 22, 'staff', 16),
(4, 23, 'staff', 17),
(10, 23, 'staff', 18),
(4, 24, 'staff', 19),
(3, 25, 'staff', 20),
(4, 25, 'staff', 21),
(3, 26, 'staff', 22),
(1, 26, 'staff', 23),
(24, 27, 'staff', 24),
(12, 27, 'staff', 25),
(4, 28, 'staff', 26),
(10, 28, 'staff', 27),
(4, 29, 'staff', 28),
(1, 30, 'staff', 29),
(24, 31, 'staff', 30),
(4, 32, 'staff', 31),
(10, 32, 'staff', 32),
(38, 32, 'staff', 33),
(35, 38, 'staff', 34),
(36, 38, 'staff', 35),
(38, 39, 'staff', 36),
(37, 39, 'staff', 37),
(12, 40, 'staff', 38),
(24, 41, 'staff', 39),
(25, 42, 'staff', 40),
(10, 44, 'staff', 41),
(12, 47, 'staff', 42),
(1, 49, 'staff', 44),
(1, 51, 'staff', 46),
(10, 57, 'staff', 52),
(3, 58, 'staff', 54),
(27, 58, 'staff', 55),
(12, 59, 'staff', 56),
(25, 67, 'staff', 73),
(26, 67, 'staff', 74),
(10, 68, 'staff', 75),
(24, 68, 'staff', 76),
(24, 69, 'staff', 77),
(12, 69, 'staff', 78),
(24, 75, 'staff', 89),
(25, 75, 'staff', 90),
(10, 76, 'staff', 91),
(25, 77, 'staff', 93),
(24, 77, 'staff', 94),
(31, 79, 'staff', 97),
(1, 85, 'staff', 110),
(3, 85, 'scholar', 111),
(26, 86, 'staff', 112),
(4, 86, 'scholar', 113);

-- --------------------------------------------------------

--
-- Table structure for table `tr_charge`
--

CREATE TABLE IF NOT EXISTS `tr_charge` (
`id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `start` float NOT NULL,
  `end` float NOT NULL,
  `gc` int(11) DEFAULT NULL,
  `dc` int(11) DEFAULT NULL,
  `dca` enum('emergency','contracted') NOT NULL DEFAULT 'contracted',
  `gasoline_charge` double NOT NULL,
  `drivers_charge` double NOT NULL,
  `base_km` float NOT NULL,
  `drivers_day_rate` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_charge`
--

INSERT INTO `tr_charge` (`id`, `rid`, `start`, `end`, `gc`, `dc`, `dca`, `gasoline_charge`, `drivers_charge`, `base_km`, `drivers_day_rate`) VALUES
(46, 290, 1, 9, NULL, NULL, '', 1, 1, 0, ''),
(53, 313, 1, 3, 1, 1, 'contracted', 3200, 74.71, 0, ''),
(54, 316, 0, 0, 1, 1, 'emergency', 3200, 74.71, 0, ''),
(59, 293, 1000, 2000, 5, 2, 'contracted', 2700, 77.7, 130, 'week end');

-- --------------------------------------------------------

--
-- Table structure for table `tr_charge_breakdown`
--

CREATE TABLE IF NOT EXISTS `tr_charge_breakdown` (
`id` int(11) NOT NULL,
  `charge_id` int(11) NOT NULL,
  `charge` double NOT NULL,
  `additional_charge` double NOT NULL,
  `drivers_overtime_charge` double NOT NULL,
  `overtime` float NOT NULL,
  `total` double NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_charge_breakdown`
--

INSERT INTO `tr_charge_breakdown` (`id`, `charge_id`, `charge`, `additional_charge`, `drivers_overtime_charge`, `overtime`, `total`, `date_created`, `date_modified`) VALUES
(4, 293, 3200, 21250, 2072.119205, 47.5, 26522.119205, '2017-01-27 03:54:05', '2017-01-27 05:58:28'),
(5, 293, 3200, 21250, 2072.119205, 47.5, 26522.119205, '2017-01-27 03:54:05', '2017-01-27 05:58:28'),
(6, 293, 3200, 21250, 2072.119205, 47.5, 26522.119205, '2017-01-27 03:54:05', '2017-01-27 05:58:28'),
(7, 59, 2700, 21750, 3690.75, 47.5, 28140.75, '2017-01-27 05:48:42', '2017-01-27 06:01:42');

-- --------------------------------------------------------

--
-- Table structure for table `tr_gc`
--

CREATE TABLE IF NOT EXISTS `tr_gc` (
`id` int(11) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `rates` float NOT NULL,
  `base` int(11) DEFAULT NULL,
  `dtz` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_gc`
--

INSERT INTO `tr_gc` (`id`, `destination`, `rates`, `base`, `dtz`) VALUES
(1, 'Airport/MAKATI', 3200, 150, '2015-06-08'),
(2, 'Quezon City', 3500, 170, '2015-06-08'),
(3, 'Calamba', 1500, 60, '2015-06-08'),
(4, 'San Pablo/Sta Rosa', 2500, 120, '2015-06-08'),
(5, 'Paete/Lumban/Majayjay', 2700, 130, '2015-06-08'),
(6, 'Tagaytay', 2500, 130, '2015-06-08'),
(7, 'campus', 25, NULL, '2015-06-08');

-- --------------------------------------------------------

--
-- Structure for view `finished`
--
DROP TABLE IF EXISTS `finished`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `finished` AS select `travel`.`id` AS `id`,`travel`.`tr_id` AS `tr_id`,`travel`.`res_id` AS `res_id`,`travel`.`location` AS `location`,`travel`.`destination` AS `destination`,`travel`.`departure_time` AS `departure_time`,`travel`.`departure_date` AS `departure_date`,`travel`.`actual_departure_time` AS `actual_departure_time`,`travel`.`returned_time` AS `returned_time`,`travel`.`linked` AS `linked`,`travel`.`status` AS `status`,`travel`.`date_created` AS `date_created`,`travel`.`returned_date` AS `returned_date`,`travel`.`plate_no` AS `plate_no`,`automobile`.`manufacturer` AS `manufacturer` from (`travel` left join `automobile` on((`automobile`.`plate_no` = `travel`.`plate_no`))) where (`travel`.`status` = 'finished');

-- --------------------------------------------------------

--
-- Structure for view `ongoing`
--
DROP TABLE IF EXISTS `ongoing`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ongoing` AS select `travel`.`id` AS `id`,`travel`.`tr_id` AS `tr_id`,`travel`.`res_id` AS `res_id`,`travel`.`location` AS `location`,`travel`.`destination` AS `destination`,`travel`.`departure_time` AS `departure_time`,`travel`.`departure_date` AS `departure_date`,`travel`.`actual_departure_time` AS `actual_departure_time`,`travel`.`returned_time` AS `returned_time`,`travel`.`linked` AS `linked`,`travel`.`status` AS `status`,`travel`.`date_created` AS `date_created`,`travel`.`returned_date` AS `returned_date`,`travel`.`plate_no` AS `plate_no`,`automobile`.`manufacturer` AS `manufacturer` from (`travel` left join `automobile` on((`automobile`.`plate_no` = `travel`.`plate_no`))) where (`travel`.`status` = 'ongoing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_profile`
--
ALTER TABLE `account_profile`
 ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `profile_name` (`profile_name`);

--
-- Indexes for table `automobile`
--
ALTER TABLE `automobile`
 ADD PRIMARY KEY (`plate_no`), ADD KEY `class` (`class`);

--
-- Indexes for table `automobile_class`
--
ALTER TABLE `automobile_class`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `automobile_noti`
--
ALTER TABLE `automobile_noti`
 ADD PRIMARY KEY (`plate_no`);

--
-- Indexes for table `automobile_oil`
--
ALTER TABLE `automobile_oil`
 ADD PRIMARY KEY (`id`), ADD KEY `plate_no` (`plate_no`);

--
-- Indexes for table `automobile_refuel`
--
ALTER TABLE `automobile_refuel`
 ADD PRIMARY KEY (`id`), ADD KEY `plate_no` (`plate_no`);

--
-- Indexes for table `automobile_rent`
--
ALTER TABLE `automobile_rent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `automobile_repair`
--
ALTER TABLE `automobile_repair`
 ADD PRIMARY KEY (`id`), ADD KEY `plate_no` (`plate_no`);

--
-- Indexes for table `cust_passengers`
--
ALTER TABLE `cust_passengers`
 ADD PRIMARY KEY (`id`), ADD KEY `tr_id` (`tr_id`);

--
-- Indexes for table `dc`
--
ALTER TABLE `dc`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otf_projects`
--
ALTER TABLE `otf_projects`
 ADD PRIMARY KEY (`id`), ADD KEY `tr_id` (`tr_id`);

--
-- Indexes for table `passengers`
--
ALTER TABLE `passengers`
 ADD PRIMARY KEY (`id`), ADD KEY `tid` (`tr_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
 ADD PRIMARY KEY (`id`), ADD KEY `tr_id` (`tr_id`), ADD KEY `plate_no` (`plate_no`);

--
-- Indexes for table `tr`
--
ALTER TABLE `tr`
 ADD PRIMARY KEY (`id`), ADD KEY `plate_no` (`plate_no`), ADD KEY `requested_by` (`requested_by`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
 ADD PRIMARY KEY (`id`), ADD KEY `res_id` (`res_id`), ADD KEY `tr_id` (`tr_id`), ADD KEY `plate_no` (`plate_no`);

--
-- Indexes for table `travel_link`
--
ALTER TABLE `travel_link`
 ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`child_id`), ADD KEY `parent_id_2` (`parent_id`);

--
-- Indexes for table `trc`
--
ALTER TABLE `trc`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trc_charge`
--
ALTER TABLE `trc_charge`
 ADD PRIMARY KEY (`id`), ADD KEY `rid` (`rid`), ADD KEY `gc` (`gc`), ADD KEY `dc` (`dc`);

--
-- Indexes for table `trc_charge_breakdown`
--
ALTER TABLE `trc_charge_breakdown`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trc_travel`
--
ALTER TABLE `trc_travel`
 ADD PRIMARY KEY (`id`), ADD KEY `res_id` (`trc_id`), ADD KEY `plate_no` (`plate_no`);

--
-- Indexes for table `trp`
--
ALTER TABLE `trp`
 ADD PRIMARY KEY (`id`), ADD KEY `plate_no` (`plate_no`), ADD KEY `requested_by` (`requested_by`), ADD KEY `charge_to` (`charge_to`);

--
-- Indexes for table `trp_charge`
--
ALTER TABLE `trp_charge`
 ADD PRIMARY KEY (`id`), ADD KEY `rid` (`rid`), ADD KEY `gc` (`gc`), ADD KEY `dc` (`dc`);

--
-- Indexes for table `trp_charge_breakdown`
--
ALTER TABLE `trp_charge_breakdown`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trp_cust_passengers`
--
ALTER TABLE `trp_cust_passengers`
 ADD PRIMARY KEY (`id`), ADD KEY `tr_id` (`trp_id`);

--
-- Indexes for table `trp_passengers`
--
ALTER TABLE `trp_passengers`
 ADD PRIMARY KEY (`id`), ADD KEY `tid` (`trp_id`);

--
-- Indexes for table `tr_charge`
--
ALTER TABLE `tr_charge`
 ADD PRIMARY KEY (`id`), ADD KEY `rid` (`rid`), ADD KEY `gc` (`gc`), ADD KEY `dc` (`dc`);

--
-- Indexes for table `tr_charge_breakdown`
--
ALTER TABLE `tr_charge_breakdown`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_gc`
--
ALTER TABLE `tr_gc`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_profile`
--
ALTER TABLE `account_profile`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `automobile_class`
--
ALTER TABLE `automobile_class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `automobile_oil`
--
ALTER TABLE `automobile_oil`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `automobile_refuel`
--
ALTER TABLE `automobile_refuel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `automobile_rent`
--
ALTER TABLE `automobile_rent`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `automobile_repair`
--
ALTER TABLE `automobile_repair`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `cust_passengers`
--
ALTER TABLE `cust_passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `dc`
--
ALTER TABLE `dc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `otf_projects`
--
ALTER TABLE `otf_projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=458;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr`
--
ALTER TABLE `tr`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=386;
--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=327;
--
-- AUTO_INCREMENT for table `travel_link`
--
ALTER TABLE `travel_link`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `trc`
--
ALTER TABLE `trc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `trc_charge`
--
ALTER TABLE `trc_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `trc_charge_breakdown`
--
ALTER TABLE `trc_charge_breakdown`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trc_travel`
--
ALTER TABLE `trc_travel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `trp`
--
ALTER TABLE `trp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `trp_charge`
--
ALTER TABLE `trp_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `trp_charge_breakdown`
--
ALTER TABLE `trp_charge_breakdown`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `trp_cust_passengers`
--
ALTER TABLE `trp_cust_passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `trp_passengers`
--
ALTER TABLE `trp_passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT for table `tr_charge`
--
ALTER TABLE `tr_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `tr_charge_breakdown`
--
ALTER TABLE `tr_charge_breakdown`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tr_gc`
--
ALTER TABLE `tr_gc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `automobile`
--
ALTER TABLE `automobile`
ADD CONSTRAINT `automobile_ibfk_1` FOREIGN KEY (`class`) REFERENCES `automobile_class` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `automobile_noti`
--
ALTER TABLE `automobile_noti`
ADD CONSTRAINT `automobile_noti_ibfk_1` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `automobile_oil`
--
ALTER TABLE `automobile_oil`
ADD CONSTRAINT `automobile_oil_ibfk_1` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `automobile_refuel`
--
ALTER TABLE `automobile_refuel`
ADD CONSTRAINT `automobile_refuel_ibfk_1` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `automobile_repair`
--
ALTER TABLE `automobile_repair`
ADD CONSTRAINT `automobile_repair_ibfk_1` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cust_passengers`
--
ALTER TABLE `cust_passengers`
ADD CONSTRAINT `cust_passengers_ibfk_1` FOREIGN KEY (`tr_id`) REFERENCES `tr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `otf_projects`
--
ALTER TABLE `otf_projects`
ADD CONSTRAINT `otf_projects_ibfk_1` FOREIGN KEY (`tr_id`) REFERENCES `tr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `passengers`
--
ALTER TABLE `passengers`
ADD CONSTRAINT `passengers_ibfk_1` FOREIGN KEY (`tr_id`) REFERENCES `tr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`tr_id`) REFERENCES `tr` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tr`
--
ALTER TABLE `tr`
ADD CONSTRAINT `tr_ibfk_1` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `travel`
--
ALTER TABLE `travel`
ADD CONSTRAINT `travel_ibfk_2` FOREIGN KEY (`res_id`) REFERENCES `reservation` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `travel_ibfk_3` FOREIGN KEY (`tr_id`) REFERENCES `tr` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `travel_ibfk_4` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `travel_link`
--
ALTER TABLE `travel_link`
ADD CONSTRAINT `travel_link_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `travel_link_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `travel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trc_charge`
--
ALTER TABLE `trc_charge`
ADD CONSTRAINT `trc_charge_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `trc_travel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `trc_charge_ibfk_2` FOREIGN KEY (`gc`) REFERENCES `tr_gc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `trc_charge_ibfk_3` FOREIGN KEY (`dc`) REFERENCES `dc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `trc_travel`
--
ALTER TABLE `trc_travel`
ADD CONSTRAINT `trc_travel_ibfk_1` FOREIGN KEY (`trc_id`) REFERENCES `trc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trp`
--
ALTER TABLE `trp`
ADD CONSTRAINT `trp_ibfk_1` FOREIGN KEY (`charge_to`) REFERENCES `login_db`.`accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `trp_ibfk_2` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `trp_charge`
--
ALTER TABLE `trp_charge`
ADD CONSTRAINT `trp_charge_ibfk_1` FOREIGN KEY (`rid`) REFERENCES `trp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `trp_charge_ibfk_2` FOREIGN KEY (`gc`) REFERENCES `tr_gc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `trp_charge_ibfk_3` FOREIGN KEY (`dc`) REFERENCES `dc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `trp_cust_passengers`
--
ALTER TABLE `trp_cust_passengers`
ADD CONSTRAINT `trp_cust_passengers_ibfk_1` FOREIGN KEY (`trp_id`) REFERENCES `trp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trp_passengers`
--
ALTER TABLE `trp_passengers`
ADD CONSTRAINT `trp_passengers_ibfk_1` FOREIGN KEY (`trp_id`) REFERENCES `trp` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tr_charge`
--
ALTER TABLE `tr_charge`
ADD CONSTRAINT `tr_charge_ibfk_3` FOREIGN KEY (`rid`) REFERENCES `travel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
