<?php 

	/**
	 * 	@root TPR Executive
	**/
	define('EXROOT', dirname(__FILE__).'/' );

	/**
	 * 	@initialize ThunderSky
	**/
	require_once(EXROOT. '../services/thundersky/init.php');

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
	define('COOKIENAME', 'executive-session');
	define('COOKIEEXPIRY', 5);
	define('ROOTPATH', '/tprexecutive');
	
	/**
	 *	@config Dataservices
	**/
	
	Snowblozm::init('sbconn', array(
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
	

?>
