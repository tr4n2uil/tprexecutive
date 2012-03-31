<?php 
	
	/**
	 * 	@initialize CirrusBolt
	**/
	require_once(EXROOT. '../services/cirrusbolt/php/init.php');
	
	Snowblozm::add('executive', array(
		'root' => EXROOT.'core/executive/',
		'location' => 'local'
	));
	
	/**
	 *	@constants System
	**/
	define('PHPMAILER', EXROOT .'dev/libraries/phpmailer/PHPMailer.class.php');
	define('CBQUEUECONF', EXROOT. 'core/que-config.php');
	
?>
