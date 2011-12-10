<?php

	/**
	 * 	@root TPR Executive
	**/
	define('EXROOT', dirname(__FILE__).'/' );
	
	/**
	 *	@constants System
	**/
	
	define('COOKIENAME', 'executive-session');
	define('COOKIEEXPIRY', 1);
	define('ROOTPATH', '/tprexecutive');
	define('FEEDBACKMAILS', 'tpo@itbhu.ac.in,vibhaj.rajan.cse08@itbhu.ac.in');
	define('PHPMAILER', EXROOT.'dev/libraries/phpmailer/PHPMailer.class.php');
	
	/**
	 *	@constants MySQL Local:Vibhaj
	**/
	define('MYSQL_HOST', 'localhost');
	define('MYSQL_USER', 'root');
	define('MYSQL_PASS', 'krishna');
	define('MYSQL_DB', 'tprexecutive');
	
	/**
	 *	@constants MySQL Production
	**
	define('MYSQL_HOST', 'localhost');
	define('MYSQL_USER', 'ictsanto_db');
	define('MYSQL_PASS', 'santoshkumar#');
	define('MYSQL_DB', 'ictsanto_ict');
	**/
	
	/**
	 *	@constants Mail
	**/
	define('MAIL_HOST', 'mail.itbhu.ac.in');
	define('MAIL_PORT', 465);
	define('MAIL_USER', 'TPR Executive Admin');
	define('MAIL_EMAIL', 'admin.tpo@itbhu.ac.in');
	define('MAIL_PASS', 'executive');
	
?>