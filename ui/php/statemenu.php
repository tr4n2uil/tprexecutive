<?php 
	
	/**
	 *	@launch Person Find
	**/
	$memory = Snowblozm::run(array(
		'service' => 'invoke.launch.workflow.workflow',
		'message' => array(
			'service' => 'executive.student.find.workflow'
		)
	), $memory);
	//echo json_encode($memory);exit;
	/**
	 *	@launch Read response
	**/
	if($memory['message']['valid']){
		$student = $memory['message'];
		$stdid = $student['stdid'];
		
		//FIRESPARK_SI_DATA_URL_run.php_DATA_service=person&id=379&name=tr4n2uil&_TYPE_json_REQUEST_POST
		$HTML .= '
			<script type="text/javascript">
				Snowblozm.Registry.save("FIRESPARK_SI_DATA_URL_run.php_DATA_service=student&id='.$student['person']['username'].'&navigator=#/ui/student/'.$student['person']['username'].'/~/&_TYPE_json_REQUEST_POST", '.$memory['result'].');
				Executive.session.user = "'.$memory['user'].'";
				Executive.data.student = '.$stdid.';
				Executive.data.username = "'.$student['person']['username'].'";
				Executive.data.dept = "'.$student['batch']['dept'].'";
			</script>';
		
		$memory['person'] = $student;
		
		$STATEMENU .=
		'<ul class="hover-menu vertical">
			<li>
				<a href="student/'.$student['person']['username'].'/" class="ui tile" style="background-image: url(\'storage/public/thumbnails/person/'.$memory['person']['person']['username'].'.png\')">'.$memory['user'].'</a>
				<ul class="menu-item">
					<li><a href="batch/'.$student['batch']['btname'].'/" class="ui" >Batch '.$student['batch']['btname'].'</a></li>
					<li><a href="batches/'.$student['batch']['year'].'/" class="ui" >Batches '.$student['batch']['year'].'</a></li>
					<li><a href="batches/'.$student['batch']['dept'].'/" class="ui" >Batches '.strtoupper($student['batch']['dept']).'</a></li>
					<li><a href="#/read/~/data/service=session&enc=get/ln/#login" class="launch">Sign Out</a></li>
				</ul>
			</li>
		</ul>';
		
		$TPR = $memory['message']['btadmin'];
	}
	
?>