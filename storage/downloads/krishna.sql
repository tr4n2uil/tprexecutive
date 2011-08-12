# --------------------------------------------------------
# Host:                         localhost
# Server version:               5.5.8
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-08-11 09:00:35
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table tprexecutive.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `comid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `site` varchar(255) NOT NULL,
  `interests` text NOT NULL,
  `photo` bigint(20) NOT NULL,
  PRIMARY KEY (`comid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Data exporting was unselected.


# Dumping structure for table tprexecutive.proceedings
CREATE TABLE IF NOT EXISTS `proceedings` (
  `procid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `eligibility` decimal(5,2) NOT NULL,
  `margin` decimal(5,2) NOT NULL,
  `max` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  PRIMARY KEY (`procid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Data exporting was unselected.


# Dumping structure for table tprexecutive.students
CREATE TABLE IF NOT EXISTS `students` (
  `stuid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `rollno` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `cgpa` decimal(5,2) NOT NULL,
  `interests` varchar(255) NOT NULL DEFAULT '',
  `resume` bigint(20) NOT NULL,
  `photo` bigint(20) NOT NULL,
  `home` bigint(20) NOT NULL,
  `sgpa1` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa2` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa3` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa4` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa5` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa6` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa7` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa8` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa9` decimal(5,2) NOT NULL DEFAULT '0.00',
  `sgpa10` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ygpa1` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ygpa2` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ygpa3` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ygpa4` decimal(5,2) NOT NULL DEFAULT '0.00',
  `ygpa5` decimal(5,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`stuid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Data exporting was unselected.
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
