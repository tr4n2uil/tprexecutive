
CREATE TABLE IF NOT EXISTS `chains` (
  `chainid` bigint(20) NOT NULL AUTO_INCREMENT,
  `masterkey` bigint(20) NOT NULL,
  `level` int(10) NOT NULL DEFAULT '0',
  `authorize` varchar(255) NOT NULL DEFAULT 'edit:add:remove:list',
  `root` varchar(255) NOT NULL,
  `links` bigint(20) NOT NULL DEFAULT '0',
  `reads` bigint(20) NOT NULL DEFAULT '0',
  `writes` bigint(20) NOT NULL DEFAULT '0',
  `ctime` datetime NOT NULL,
  `rtime` datetime NOT NULL,
  `wtime` datetime NOT NULL,
  PRIMARY KEY (`chainid`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `chains` (`chainid`, `masterkey`, `level`, `authorize`, `root`, `links`, `reads`, `writes`, `ctime`, `rtime`, `wtime`) VALUES
	(0, 5, 0, 'edit:add:remove:list', '/5', 0, 15, 0, '2011-08-14 21:19:15', '2011-08-14 20:33:39', '2011-08-14 21:19:15'),
	(1, 5, 1, 'edit:add:remove', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(2, 5, 1, 'edit:add:remove', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(3, 5, 1, 'edit:add:remove', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(4, 5, 1, 'edit', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(5, 5, 1, 'edit:add:remove:list', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(8, 5, 1, 'edit:add:remove:list', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(9, 5, 1, 'edit:add:remove:list', '/5', 0, 0, 0, '2011-08-14 21:19:15', '2011-08-14 21:19:15', '2011-08-14 21:19:15'),
	(10, 5, 1, 'edit:add:remove:list', '/5', 0, 0, 0, '2011-08-14 21:21:38', '2011-08-14 21:21:39', '2011-08-14 21:21:39');

CREATE TABLE IF NOT EXISTS `keys` (
  `keyid` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `keyvalue` varchar(255) NOT NULL,
  PRIMARY KEY (`keyid`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `keyvalue` (`keyvalue`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `keys` (`keyid`, `email`, `keyvalue`) VALUES
	(1, 'test', 'krishna'),
	(2, 'test2', 'unnikanna'),
	(3, 'test3', 'krishnamayam'),
	(4, 'test4', 'vennakrishna'),
	(5, 'vibhaj8@gmail.com', '68364d9181a10eaae87d7f73dc1bdb6f'),
	(6, 'admin@executive.edu', '0e90a8577d4ec94f67d38894c4d60845');

CREATE TABLE IF NOT EXISTS `members` (
  `chainkeyid` bigint(20) NOT NULL AUTO_INCREMENT,
  `chainid` bigint(20) NOT NULL,
  `keyid` bigint(20) NOT NULL,
  PRIMARY KEY (`chainkeyid`),
  UNIQUE KEY `chainid_keyid` (`chainid`,`keyid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO `members` (`chainkeyid`, `chainid`, `keyid`) VALUES 
	(1, 0, 6);

CREATE TABLE IF NOT EXISTS `webs` (
  `webid` bigint(20) NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) NOT NULL,
  `child` bigint(20) NOT NULL,
  `path` varchar(255) NOT NULL DEFAULT '/',
  `leaf` varchar(255) NOT NULL,
  PRIMARY KEY (`webid`),
  UNIQUE KEY `parent_path_leaf` (`parent`,`path`,`leaf`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO `webs` (`webid`, `parent`, `child`, `path`, `leaf`) VALUES
	(1, 0, 0, '/', '0'),
	(2, 0, 1, '/', '1'),
	(3, 0, 2, '/', '2'),
	(4, 0, 3, '/', '3'),
	(5, 0, 4, '/', '4'),
	(6, 0, 5, '/', '5');

CREATE TABLE IF NOT EXISTS `contents` (
  `cntid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `cntname` varchar(255) NOT NULL,
  `cntstype` int(11) NOT NULL DEFAULT '0',
  `cntstyle` varchar(255) NOT NULL DEFAULT '',
  `cntttype` int(11) NOT NULL,
  `cnttpl` varchar(255) NOT NULL,
  `cntdtype` int(11) NOT NULL,
  `cntdata` text NOT NULL,
  PRIMARY KEY (`cntid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `events` (
  `eventid` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rejection` text NOT NULL,
  `home` bigint(20) NOT NULL,
  PRIMARY KEY (`eventid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `notes` (
  `noteid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `note` mediumtext NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`noteid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `resources` (
  `rsrcid` bigint(20) NOT NULL,
  `rsrcname` varchar(255) NOT NULL,
  `resource` text NOT NULL,
  PRIMARY KEY (`rsrcid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

CREATE TABLE IF NOT EXISTS `selections` (
  `selid` bigint(20) NOT NULL,
  `eventid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `stageid` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`selid`),
  UNIQUE KEY `eventid_owner` (`eventid`,`owner`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `sessions` (
  `sessionid` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL,
  PRIMARY KEY (`sessionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `spaces` (
  `spaceid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `spname` varchar(255) NOT NULL,
  `sppath` varchar(255) NOT NULL,
  PRIMARY KEY (`spaceid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `spaces` (`spaceid`, `owner`, `spname`, `sppath`) VALUES
	(0, 5, 'Company_Photos', 'storage/photos/'),
	(1, 5, 'Downloads', 'storage/downloads/');

CREATE TABLE IF NOT EXISTS `stages` (
  `stageid` bigint(20) NOT NULL,
  `stage` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `open` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`stageid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `storages` (
  `stgid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `stgname` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `mime` varchar(255) NOT NULL,
  `size` bigint(20) NOT NULL,
  PRIMARY KEY (`stgid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `batches` (
  `batchid` bigint(20) NOT NULL,
  `owner` bigint(20) NOT NULL,
  `btname` varchar(255) NOT NULL,
  `resume` bigint(20) NOT NULL,
  `photo` bigint(20) NOT NULL,
  PRIMARY KEY (`batchid`),
  UNIQUE KEY `btname` (`btname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

