-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2017 at 10:39 AM
-- Server version: 5.6.21-log
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `searcaba_motorpool`
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `automobile`
--

CREATE TABLE IF NOT EXISTS `automobile` (
`automobile_id` int(11) NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `manufacturer` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `class` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `availability` enum('available','in_use','under_maintenance','junked') NOT NULL DEFAULT 'available'
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `automobile_class`
--

CREATE TABLE IF NOT EXISTS `automobile_class` (
`id` int(11) NOT NULL,
  `class` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`dept_id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_alias` varchar(100) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passengers`
--

CREATE TABLE IF NOT EXISTS `passengers` (
  `uid` int(11) NOT NULL,
  `tr_id` int(11) DEFAULT NULL,
  `type` enum('staff','scholar') NOT NULL DEFAULT 'staff',
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=563 DEFAULT CHARSET=latin1;

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
-- Table structure for table `signatory`
--

CREATE TABLE IF NOT EXISTS `signatory` (
  `account_profile_id` int(11) NOT NULL,
  `dept_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
`id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tr`
--

CREATE TABLE IF NOT EXISTS `tr` (
`id` int(11) NOT NULL,
  `purpose` text,
  `source_of_fund` enum('opf','otf','otfs','opfs','op','sf') NOT NULL DEFAULT 'opf',
  `mode_of_payment` enum('sd','cash') NOT NULL DEFAULT 'cash',
  `vehicle_type` int(11) NOT NULL DEFAULT '1',
  `requested_by` int(11) DEFAULT NULL,
  `approved_by` varchar(255) DEFAULT NULL,
  `recommended_by` int(11) DEFAULT NULL,
  `date_approved` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `plate_no` varchar(255) DEFAULT NULL,
  `request_type` varchar(255) NOT NULL DEFAULT 'official',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=433 DEFAULT CHARSET=latin1;

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
  `other_driver` varchar(255) NOT NULL,
  `linked` enum('yes','no') NOT NULL DEFAULT 'no',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=353 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notes` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

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
 ADD PRIMARY KEY (`automobile_id`), ADD UNIQUE KEY `plate_no` (`plate_no`), ADD KEY `class` (`class`);

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
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`dept_id`), ADD KEY `dept_name` (`dept_name`);

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
-- Indexes for table `signatory`
--
ALTER TABLE `signatory`
 ADD PRIMARY KEY (`id`), ADD KEY `uid` (`account_profile_id`), ADD KEY `dept_id` (`dept_id`);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `automobile`
--
ALTER TABLE `automobile`
MODIFY `automobile_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `automobile_class`
--
ALTER TABLE `automobile_class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `automobile_oil`
--
ALTER TABLE `automobile_oil`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `automobile_refuel`
--
ALTER TABLE `automobile_refuel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `automobile_rent`
--
ALTER TABLE `automobile_rent`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `automobile_repair`
--
ALTER TABLE `automobile_repair`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
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
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `otf_projects`
--
ALTER TABLE `otf_projects`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `passengers`
--
ALTER TABLE `passengers`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=563;
--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `signatory`
--
ALTER TABLE `signatory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tr`
--
ALTER TABLE `tr`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=433;
--
-- AUTO_INCREMENT for table `travel`
--
ALTER TABLE `travel`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=353;
--
-- AUTO_INCREMENT for table `travel_link`
--
ALTER TABLE `travel_link`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tr_charge`
--
ALTER TABLE `tr_charge`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tr_charge_breakdown`
--
ALTER TABLE `tr_charge_breakdown`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tr_gc`
--
ALTER TABLE `tr_gc`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
