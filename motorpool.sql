-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 09:37 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_profile`
--

INSERT INTO `account_profile` (`id`, `uid`, `profile_name`, `last_name`, `first_name`, `middle_name`, `profile_email`, `department`, `department_alias`, `position`, `profile_image`, `date_modified`) VALUES
(1, 67, 'John Kenneth G. Abella', 'Abella', 'John Kenneth', NULL, NULL, 'Info Tech Services Unit', 'ITSU', 'programmer', '67.PNG', '2016-09-29 10:08:01'),
(6, 102, 'Renz B. Tabadero', 'Tabadero', 'Renz', NULL, NULL, 'Information Technology Services Unit', 'ITSU', '', '', '2016-09-29 10:08:00'),
(14, 102, 'Renz B. Tabadero', 'Tabadero', 'Renz', NULL, NULL, 'Information Technology Services Unit', 'ITSU', '', '', '2016-09-29 10:08:01'),
(15, 1, 'Administrator', '', '', NULL, NULL, 'Accounting Unit', 'AcU', 'administrator', '1.jpg', '2016-09-29 10:08:01'),
(16, 67, 'John Kenneth G. Abella', 'Abella', 'John Kenneth', NULL, NULL, 'Information Technology Services Unit', 'ITSU', 'programmer', '67.jpg', '2016-10-27 10:26:13');

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
('0EV-21859', 'Toyota Corolla GLI', 'Gray', 2, NULL, 'in_use'),
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `uid` int(11) NOT NULL,
  `tr_id` int(11) DEFAULT NULL,
  `type` enum('staff','scholar') NOT NULL DEFAULT 'staff',
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=344 DEFAULT CHARSET=latin1;

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
(1, 312, 'staff', 333),
(3, 312, 'staff', 334),
(26, 313, 'staff', 335),
(27, 313, 'staff', 336),
(4, 314, 'staff', 337),
(10, 314, 'staff', 338),
(10, 315, 'staff', 339),
(4, 315, 'staff', 340),
(26, 315, 'staff', 341),
(25, 315, 'staff', 342),
(12, 316, 'staff', 343);

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
  `approved_by` int(11) DEFAULT NULL,
  `date_approved` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plate_no` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=317 DEFAULT CHARSET=latin1;

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
(290, 'dfgdfg dfg dg dfgdgdgd', 'opf', 16, NULL, '', '2016-11-09 08:08:58', '2016-12-13 06:09:37', NULL, 2),
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
(312, 'xzcxzczxczc', 'opf', 16, NULL, '', '2016-12-13 07:47:03', '2016-12-13 07:47:03', NULL, 0),
(313, 'ate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est la', 'opf', 16, NULL, '', '2016-12-13 07:49:48', '2016-12-13 07:49:48', NULL, 0),
(314, 'ate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est la', 'opf', 16, NULL, '', '2016-12-13 07:50:17', '2016-12-13 07:50:17', NULL, 0),
(315, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est ', 'opf', 16, NULL, '', '2016-12-13 07:51:19', '2016-12-13 08:02:20', NULL, 0),
(316, 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est ', 'opf', 16, NULL, '', '2016-12-13 08:03:07', '2016-12-13 08:03:07', NULL, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=292 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`id`, `tr_id`, `res_id`, `location`, `destination`, `departure_time`, `actual_departure_time`, `returned_time`, `departure_date`, `returned_date`, `status`, `plate_no`, `driver_id`, `linked`, `date_created`) VALUES
(255, 273, NULL, 'SEARCA', 'Cavite', '05:00:00', '09:37:05', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', 'abc1315', 142, 'yes', '2016-10-10 02:47:40'),
(256, 274, NULL, 'SEARCA', 'Cavite', '04:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-10 06:11:56'),
(257, 275, NULL, 'SEARCA', 'Cavite', '04:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-10 06:12:57'),
(258, 276, NULL, 'Cabuyao', 'Tagaytay', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-10 06:16:16'),
(259, 277, NULL, 'Cabuyao', 'Tagaytay', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-10 06:17:29'),
(260, 278, NULL, 'test', 'test', '02:00:00', '00:00:00', '00:00:00', '2016-10-29', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-11 05:45:45'),
(261, 279, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-12 03:11:40'),
(265, 283, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-10-26', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-10-12 05:41:24'),
(266, 284, NULL, 'test', 'test', '05:00:00', '09:43:31', '00:00:00', '2016-10-29', '0000-00-00', 'ongoing', '0EV-21859', 141, 'no', '2016-10-17 01:36:42'),
(271, 289, NULL, 'test', 'Test', '05:00:00', '00:00:00', '00:00:00', '2016-10-29', '0000-00-00', 'scheduled', NULL, 0, 'yes', '2016-10-17 04:01:35'),
(272, 290, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-11-30', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-11-09 08:08:58'),
(273, 291, NULL, 'SEARCA', 'Cavite', '05:00:00', '00:00:00', '00:00:00', '2016-11-30', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-11-21 05:36:24'),
(275, 291, NULL, 'SEARA', 'Tagaytay', '04:00:00', '00:00:00', '00:00:00', '2016-12-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-08 07:09:43'),
(282, 303, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 06:46:49'),
(283, 310, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-14', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:41:31'),
(284, 311, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:42:21'),
(285, 311, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:46:47'),
(286, 311, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:46:49'),
(287, 312, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:47:23'),
(288, 313, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-31', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:50:03'),
(289, 314, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-29', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:50:35'),
(290, 315, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-24', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 07:51:36'),
(291, 316, NULL, 'test', 'test', '05:00:00', '00:00:00', '00:00:00', '2016-12-17', '0000-00-00', 'scheduled', NULL, 0, 'no', '2016-12-13 08:03:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `travel_link`
--

INSERT INTO `travel_link` (`id`, `child_id`, `parent_id`, `date_created`, `pay_extra_charge`) VALUES
(1, 271, 266, '2016-10-17 04:01:39', 'yes');

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trc`
--

INSERT INTO `trc` (`id`, `requested_by`, `approved_by`, `date_created`, `date_modified`, `status`) VALUES
(32, 1, 0, '2016-10-11 02:14:46', '2016-10-11 02:14:46', 0),
(33, 14, 0, '2016-10-11 06:32:08', '2016-10-12 01:23:22', 0),
(34, 15, 0, '2016-12-05 06:31:40', '2016-12-05 06:31:40', 0);

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
  `dca` enum('contracted','emergency') NOT NULL DEFAULT 'contracted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `returned_time` time DEFAULT NULL,
  `departure_date` date NOT NULL,
  `returned_date` date NOT NULL,
  `purpose` text NOT NULL,
  `status` enum('finished','ongoing','canceled','scheduled') NOT NULL DEFAULT 'scheduled',
  `plate_no` varchar(255) DEFAULT NULL,
  `driver_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trc_travel`
--

INSERT INTO `trc_travel` (`id`, `trc_id`, `location`, `destination`, `kms`, `departure_time`, `returned_time`, `departure_date`, `returned_date`, `purpose`, `status`, `plate_no`, `driver_id`, `date_created`) VALUES
(43, 32, 'Mayondon', 'Cabuyao', NULL, '18:00:00', NULL, '2016-10-29', '0000-00-00', '', 'scheduled', NULL, 0, '2016-10-11 02:14:46'),
(44, 33, 'Mayondon', 'Vega', NULL, '08:00:00', NULL, '2016-10-29', '0000-00-00', '', 'scheduled', NULL, 0, '2016-10-11 06:32:08'),
(45, 34, 'SEARCA', 'test', NULL, '03:00:00', NULL, '2016-12-31', '0000-00-00', '', 'scheduled', NULL, 0, '2016-12-05 06:31:40');

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
  `mode_of_payment` enum('sd','cash') NOT NULL,
  `requested_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `departure_date` date NOT NULL,
  `departure_time` time DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp`
--

INSERT INTO `trp` (`id`, `purpose`, `mode_of_payment`, `requested_by`, `approved_by`, `departure_date`, `departure_time`, `returned_date`, `returned_time`, `location`, `destination`, `charge_to`, `vehicle_type`, `date_created`, `date_modified`, `plate_no`, `driver_id`, `status`, `trp_status`) VALUES
(8, NULL, 'cash', 1, NULL, '2016-10-29', '03:00:00', '0000-00-00', '00:00:00', 'SEARA', 'Tagaytay', NULL, 3, '2016-10-11 01:21:39', '2016-12-02 01:19:42', 'AXA 1341', 139, 'scheduled', 2),
(11, NULL, 'sd', 14, NULL, '2016-10-29', '00:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-10-11 05:59:29', '2016-10-11 06:03:47', NULL, 0, 'scheduled', 0),
(13, NULL, 'sd', 14, NULL, '2016-10-31', '05:00:00', '0000-00-00', '00:00:00', 'test', 'test', NULL, 1, '2016-10-11 06:09:35', '2016-10-12 07:56:30', NULL, 143, 'canceled', 0);

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
  `dca` enum('contracted','emergency','','') NOT NULL DEFAULT 'contracted'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp_charge`
--

INSERT INTO `trp_charge` (`id`, `rid`, `start`, `end`, `gc`, `dc`, `dca`) VALUES
(1, 8, 100, 0, 7, 1, 'emergency');

-- --------------------------------------------------------

--
-- Table structure for table `trp_cust_passengers`
--

CREATE TABLE IF NOT EXISTS `trp_cust_passengers` (
`id` int(11) NOT NULL,
  `trp_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `designation` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trp_passengers`
--

CREATE TABLE IF NOT EXISTS `trp_passengers` (
  `uid` int(11) NOT NULL,
  `trp_id` int(11) NOT NULL,
  `type` enum('staff','scholar') NOT NULL DEFAULT 'staff',
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trp_passengers`
--

INSERT INTO `trp_passengers` (`uid`, `trp_id`, `type`, `id`) VALUES
(67, 8, 'staff', 13),
(3, 8, 'staff', 14);

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
  `dca` enum('emergency','contractual') NOT NULL DEFAULT 'contractual'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dc`
--
ALTER TABLE `dc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `otf_projects`
--
ALTER TABLE `otf_projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=344;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tr`
--
ALTER TABLE `tr`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=317;
--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=292;
--
-- AUTO_INCREMENT for table `travel_link`
--
ALTER TABLE `travel_link`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trc`
--
ALTER TABLE `trc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `trc_charge`
--
ALTER TABLE `trc_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trc_travel`
--
ALTER TABLE `trc_travel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `trp`
--
ALTER TABLE `trp`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `trp_charge`
--
ALTER TABLE `trp_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trp_cust_passengers`
--
ALTER TABLE `trp_cust_passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trp_passengers`
--
ALTER TABLE `trp_passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tr_charge`
--
ALTER TABLE `tr_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
ADD CONSTRAINT `tr_ibfk_1` FOREIGN KEY (`plate_no`) REFERENCES `automobile` (`plate_no`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `tr_ibfk_2` FOREIGN KEY (`requested_by`) REFERENCES `login_db`.`accounts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
ADD CONSTRAINT `tr_charge_ibfk_1` FOREIGN KEY (`gc`) REFERENCES `tr_gc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `tr_charge_ibfk_2` FOREIGN KEY (`dc`) REFERENCES `dc` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
ADD CONSTRAINT `tr_charge_ibfk_3` FOREIGN KEY (`rid`) REFERENCES `travel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
