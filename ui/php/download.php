<?php
	

	if(isset($_GET['stgid']) && isset($_GET['spaceid'])){
		
		$service = array(
			'service' => 'store.storage.read.workflow',
			''
		);
	
		Snowblozm::run($service, $memory);
	
	
		$stgid = $_GET['cid'];
		if(!is_numeric($cid)){
			echo "Invalid Course";
			exit;
		}
	
		$action = isset($_GET['action']) ? $_GET['action'] : 'syllabus';
		if(in_array($action, array('info', 'syllabus', 'video', 'ppt'))){
			include('ui/php/download-'.$action.'.php');
		}
		else {
			echo "Invalid Action";
			exit;
		}
		
	}
?>