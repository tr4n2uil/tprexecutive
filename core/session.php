<?php

	require_once('../init.php');
	
	if(isset($_POST['email']) && isset($_POST['password'])){
		
		$workflow = array(
		array(
			'service' => 'ad.key.authenticate.workflow',
			'email' => $_POST['email'],
			'key' => $_POST['password'],
			'context' => CONTEXT
		),
		array(
			'service' => 'gridutil.session.add.workflow',
			'email' => $_POST['email'],
			'expiry' => COOKIEEXPIRY
		));
		
		$memory = Snowblozm::execute($workflow);
		$result = array();
		
		if($memory['valid']) {
			$result['firespark'] = array(
				array(
					'service' => 'login',
					'key' => COOKIENAME,
					'value' => $memory['sessionid'],
					'expires' => COOKIEEXPIRY
				)
			);
		}
		
		$result['valid'] = $memory['valid'];
		$result['msg'] = $memory['msg'];
		$result['status'] = $memory['status'];
		$result['details'] = $memory['details'];
		
		echo json_encode($result);
	}
	else if(isset($_COOKIE[COOKIENAME])){
	
		$service = array(
			'service' => 'gridutil.session.remove.workflow',
			'sessionid' => $_COOKIE[COOKIENAME]
		);
		
		$memory = Snowblozm::run($service);
		
		if($memory['valid']) {
			header('Location: '. ROOTPATH);
		}
		else {
			echo '<h1>Invalid Session</h1>';
		}
		
	}
	else
		echo '<h1>Invalid Request</h1>';
?>