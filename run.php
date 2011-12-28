<?php 
	
	/**
	 * 	@initialize TPR Executive
	**/
	include_once('init.php');	
	
	/**
	 *	@initialize $memory
	**/
	$memory['reqtype'] = isset($_GET['enc']) ? $_GET['enc'] : 'post';
	//Snowblozm::$debug = true;
	
	/**
	 *	@invoke Launch Message
	**/
	$memory = Snowblozm::run(array(
		'service' => 'invoke.launch.message.workflow'
	), $memory);
	
?>
