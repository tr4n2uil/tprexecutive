<?php
	
	/**
	 * 	@initialize TPR Executive
	**/
	require_once(EXROOT. 'core/sb-init.php');
	
	/**
	 * 	@static SnowBlozm
	**/
	Snowblozm::$setmime = 'html';
	
	/**
	 *	@config CacheLite
	**/
	Snowblozm::init('cachelite', array(
		'caching' => $CACHE_ENABLE,
		'cacheDir' => EXROOT.'cache'.DIRECTORY_SEPARATOR,
		'lifeTime' => $CACHE_LIFE,
		'automaticCleaningFactor' => $CACHE_LIFE,
		'hashedDirectoryLevel' => $CACHE_LEVEL,
		'automaticSerialization' => true
	));
	
	/**
	 *	@config Session
	**/
	Snowblozm::init('session', array(
		'key' => COOKIEKEY,
		'expiry' => COOKIEEXPIRY,
		'root' => ROOTPATH,
		'context' => CONTEXT
	));
	
	/**
	 *	@config Dataservices
	**/
	
	Snowblozm::init('cbconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CB_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbqconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBQ_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbsconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBS_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbdconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBD_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('cbpconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $CBP_DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	Snowblozm::init('exconn', array(
		'type' => 'mysql',
		'host' => $DB_HOST,
		'user' => $DB_USER,
		'pass' => $DB_PASS,
		'database' => $DB_NAME,
		'persist' => $DB_PERSIST
	));
	
	/**
	 *	@config Mail
	**/
	Snowblozm::init('mail', array(
		'type' => 'smtp',
		'host' => $MAIL_HOST,
		'port' => 465,
		'secure' => 'tls',
		'user' => $MAIL_USER,
		'email' => $MAIL_EMAIL,
		'pass' => $MAIL_PASS,
		'params' => "-f$MAIL_USER <$MAIL_EMAIL>"
	));
	
	/**
	 *	@config reCAPTCHA
	**/
	Snowblozm::init('recaptcha', array(
		'url' => 'http://www.google.com/recaptcha/api/verify',
		'public' => '6LeS880SAAAAAHH2R_CjmQpN61jVlpsI3jRttnoj',
		'private' => '6LeS880SAAAAAAHWd2Msjq9qoDC2T16lFxtQdvHv',
	));
	
	/**
	 *	@initialize $memory
	**/
	$memory = array(
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'user' => false,
		'context' => CONTEXT,
		'emergency' => $EMERGENCY,
		'access' => array(
			'root' => array(
				'storage', 
				'display',
				'people',
				'portal',
				'access'
			),
			'maps' => array(
				'default' => 'invoke.interface.console',
				'session' => 'invoke.interface.session',
				'register' => 'portal.profile.add',
				'available' => 'people.person.available',
				'send' => 'people.person.send',
				'verify' => 'portal.profile.verify',
				'reset' => 'people.person.reset',
				'file' => 'storage.file.read',
				'user' => 'portal.profile.info',
				'profile' => 'portal.profile.find',
				'profiles' => 'portal.profile.list',
				'post' => 'display.post.info',
				'posts' => 'display.post.list',
				'board' => 'display.board.info',
				'boards' => 'display.board.list',
				'comment' => 'display.comment.info',
				'comments' => 'display.comment.list',
				'questions' => 'quiz.question.list',
				'problems' => 'quiz.problem.list',
				'puzzles' => 'quiz.puzzle.list',
				'permissions' => 'access.permission.list',
				'parikshan' => 'quiz.submission.parikshan',
				'scoreboard' => 'quiz.submission.scores',
				'feedback' => 'display.comment.list',
			)
		),
		'pages' => $PAGES
	);

?>