<?php 
	
	/**
	 * 	@initialize CirrusBolt
	**/
	require_once(EXROOT. '../services/cirrusbolt/php/init.php');
	
	Snowblozm::add('portal', array(
		'root' => EXROOT.'core/portal/',
		'location' => 'local'
	));
	
	/**
	 *	@constants System
	**/
	define('PHPMAILER', EXROOT .'dev/libraries/phpmailer/PHPMailer.class.php');
	define('CBQUEUECONF', EXROOT. 'core/que-config.php');
	
?>
