<?php

	require_once('init.php');
	//Snowblozm::$debug = true;
	Snowblozm::$setmime = 'html';
	
	/**
	 *	WorkflowKernel instance and initialization
	**/
	$kernel = new WorkflowKernel();
	$email = false;
	
	if(isset($_COOKIE[COOKIENAME])){
		
		$service = array(
			'service' => 'cloudcore.session.info.workflow',
			'sessionid' => $_COOKIE[COOKIENAME]
		);
		
		$memory = $kernel->run($service);
		
		if($memory['valid']) 
			$email = $memory['email'];
	}		
	
	$memory = array(
		'reqtype' => 'post',
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'email' => $email,
		'access' => array(
			'root' => array('sbdemo', 'cloudid', 'cloudview', 'executive')
		)
	);
	
	$service = array(
		'service' => 'sb.launch.message.workflow'
	);
	
	$kernel->run($service, $memory);
	
?>