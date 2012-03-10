<?php
	
	/**
	 * 	@root TPO
	**/
	define('EXROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);
	
	/**
	 *	@config System
	**/
	$EMERGENCY = false && !isset($_COOKIE['tamasomajyothirgamaya']);
	$STATUS = '<span class="state">Loading T&P Portal ...</span>';
	//$STATUS = '<span class="state">System maintenance in progress.</span>';
	
	/**
	 * 	@initialize Configuration
	**/
	require_once('core/config.php');
	//require_once('core/'.$YEAR.'/config.php');
	
	/**
	 * 	@initialize System
	**/
	require_once('core/init.php');
	//Snowblozm::$debug = true;	
	
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