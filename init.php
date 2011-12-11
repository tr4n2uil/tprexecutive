<?php

	/**
	 * 	@root TPR Executive
	**/
	define('EXROOT', dirname(__FILE__).'/' );
	
	/**
	 * 	@initialize ThunderSky
	**/
	require_once(EXROOT. '../services/thundersky/php/init.php');
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
	define('CONTEXT', 'EX');
	define('COOKIENAME', 'executive-session');
	define('COOKIEEXPIRY', 1);
	define('ROOTPATH', '/tprexecutive');
	define('FEEDBACKMAILS', 'tpo@itbhu.ac.in,vibhaj.rajan.cse08@itbhu.ac.in');
	define('PHPMAILER', EXROOT.'dev/libraries/phpmailer/PHPMailer.class.php');
	
	/**
	 *	@config Dataservices
	**/
	
	Snowblozm::init('adconn', array(
		'type' => 'mysql',
		'host' => 'localhost',
		'user' => 'root',
		'pass' => 'krishna',
		'database' => 'snowblozm'
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
	 *	@constants Mail
	**/
	define('MAIL_HOST', 'mail.itbhu.ac.in');
	define('MAIL_PORT', 465);
	define('MAIL_USER', 'TPR Executive Admin');
	define('MAIL_EMAIL', 'admin.tpo@itbhu.ac.in');
	define('MAIL_PASS', 'executive');
	
?>