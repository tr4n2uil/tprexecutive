<?php

	require_once('init.php');
	
	$kernel = new WorkflowKernel();
	
	if(isset($_POST['email']) && isset($_POST['password'])){
		
		$workflow = array(
		array(
			'service' => 'sb.key.authenticate.workflow',
			'email' => $_POST['email'],
			'key' => $_POST['password']
		),
		array(
			'service' => 'cloudcore.session.add.workflow',
			'email' => $_POST['email'],
			'expiry' => COOKIEEXPIRY
		));
		
		$memory = $kernel->execute($workflow);
		
		if($memory['valid']) {
			setcookie(COOKIENAME, $memory['sessionid'], time() + (COOKIEEXPIRY * 86400));
		}
		
		$result = array();
		$result['valid'] = $memory['valid'];
		$result['msg'] = $memory['msg'];
		$result['status'] = $memory['status'];
		$result['details'] = $memory['details'];
		
		echo json_encode($result);
	}
	else if(isset($_COOKIE[COOKIENAME])){
	
		$service = array(
			'service' => 'cloudcore.session.remove.workflow',
			'sessionid' => $_COOKIE[COOKIENAME]
		);
		
		$memory = $kernel->execute($workflow);
		
		if($memory['valid']) {
			header('Location: '. EXECUTIVEPATH);
		}
		else {
			echo '<h1>Invalid Session</h1>';
		}
		
	}
	else
		echo '<h1>Invalid Request</h1>';
?>