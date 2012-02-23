<?php

	/**
	 * 	@root TPR Executive
	**/
	define('EXROOT', dirname(__FILE__).'/' );
	
	/**
	 * 	@initialize CirrusBolt
	**/
	require_once(EXROOT. '../services/cirrusbolt/php/init.php');
	Snowblozm::$setmime = 'html';
	//Snowblozm::$debug = true;

	/**
	 * 	@initialize Service roots
	**/
	Snowblozm::add('excore', array(
		'root' => EXROOT.'core/services/',
		'location' => 'local'
	));
	
	Snowblozm::add('executive', array(
		'root' => EXROOT.'core/workflows/',
		'location' => 'local'
	));
	
	/**
	 *	@constants System
	**/
	define('COOKIEKEY', 'executive-session');
	define('CONTEXT', 'EX');
	define('FEEDBACKMAILS', 'tpo@itbhu.ac.in,vibhaj.rajan.cse08@itbhu.ac.in');
	define('PHPMAILER', EXROOT.'dev/libraries/phpmailer/PHPMailer.class.php');
	
	/**
	 *	@config Dataservices
	**/
	
	Snowblozm::init('cbconn', array(
		'type' => 'mysql',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'krishna',
		'database' => 'cirrusbolt'
	));
	
	Snowblozm::init('tsconn', array(
		'type' => 'mysql',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'krishna',
		'database' => 'thundersky'
	));
	
	Snowblozm::init('exconn', array(
		'type' => 'mysql',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'krishna',
		'database' => 'tprexecutive'
	));
	
	/**
	 *	@config Session
	**/
	Snowblozm::init('session', array(
		'key' => COOKIEKEY,
		'expiry' => 1,
		'root' => '/tprexecutive',
		'context' => CONTEXT
	));
	
	/**
	 *	@constants Mail
	**/
	define('MAIL_HOST', 'mail.itbhu.ac.in');
	define('MAIL_PORT', 465);
	define('MAIL_USER', 'TPR Executive Admin');
	define('MAIL_EMAIL', 'admin.tpo@itbhu.ac.in');
	define('MAIL_PASS', 'executive');
	
	/**
	 *	@config CacheLite
	**/
	Snowblozm::init('cachelite', array(
		'caching' => false,
		'cacheDir' => EXROOT.'cache'.DIRECTORY_SEPARATOR,
		'lifeTime' => 85,
		'automaticCleaningFactor' => 85,
		'hashedDirectoryLevel' => 0,
		'automaticSerialization' => true
	));
	
	/**
	 *	@initialize $memory
	**/
	$memory = array(
		'page' => isset($_GET['page']) ? $_GET['page'] : 'home',
		'pages' => array(
			'contact-us' => 'ui/html/contact-us',
			'companies' => 'ui/html/companies',
			'academics' => 'ui/html/academics',
			'why-at-itbhu' => 'ui/html/why-at-itbhu',
			'home' => 'ui/html/home',
			'error' => 'ui/html/error'
		),
		'templates' => array(
		),
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'email' => false,
		'context' => CONTEXT,
		'access' => array(
			'root' => array(
				'store', 
				'score', 
				'executive'
			),
			'maps' => array(
				'session' => 'invoke.interface.session'
			)
		),
		'error_page' => 'error'
	);

	/**
	 *	@check cookie for session
	**/
	if(isset($_COOKIE[COOKIEKEY])){
		$memory = Snowblozm::run(array(
			'service' => 'cbcore.session.info.workflow',
			'sessionid' => $_COOKIE[COOKIEKEY]
		), $memory);
	}

?>