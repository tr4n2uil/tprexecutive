<?php

	require_once('init.php');
	//Snowblozm::$debug = true;
	Snowblozm::$setmime = 'html';
	
	/**
	 *	Initialization
	**/
	$email = false;
	
	if(isset($_COOKIE[COOKIENAME])){
		
		$service = array(
			'service' => 'gridutil.session.info.workflow',
			'sessionid' => $_COOKIE[COOKIENAME]
		);
		
		$memory = Snowblozm::run($service);
		
		if($memory['valid']) 
			$email = $memory['email'];
	}		
	
	$memory = array(
		'reqtype' => isset($_GET['request']) ? $_GET['request'] : 'post',
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'email' => $email,
		'context' => CONTEXT,
		'access' => array(
			'root' => array('addemo', 'gridcontrol', 'gridview', 'gridevent', 'gridshare', 'griddata', 'executive')
		)
	);
	
	$service = array(
		'service' => 'ad.launch.message.workflow'
	);
	
	Snowblozm::run($service, $memory);
	
?>