<?php 
	
	/**
	 *	@launch Person Find
	**/
	$memory = Snowblozm::run(array(
		'service' => 'invoke.launch.workflow.workflow',
		'message' => array(
			'service' => 'portal.profile.find.workflow'
		)
	), $memory);
	
	/**
	 *	@launch Read response
	**/
	if($memory['message']['valid']) {
		$profile = $memory['message'];
		$pnid = $profile['plid'];
		
		//FIRESPARK_SI_DATA_URL_run.php_DATA_service=person&id=379&name=tr4n2uil&_TYPE_json_REQUEST_POST
		$HTML .= '
			<script type="text/javascript">
				Snowblozm.Registry.save("FIRESPARK_SI_DATA_URL_run.php_DATA_service=profile&id='.$profile['person']['username'].'&navigator=#/ui/profile/'.$profile['person']['username'].'/~/&_TYPE_json_REQUEST_POST", '.$memory['result'].');
				Executive.session.user = "'.$memory['user'].'";
				Executive.data.profile = '.$pnid.';
				Executive.data.username = "'.$profile['person']['username'].'";
			</script>';
			
		$memory['person'] = $profile;
		
		$STATEMENU .=
		'<ul class="hover-menu vertical">
			<li>
				<a href="#" class="navigate tile" style="background-image: url(\'storage/public/thumbnails/person/'.$memory['person']['person']['username'].'.png\')">'.$memory['user'].'</a>
				<ul class="menu-item">
					<li><a href="profile/'.$memory['person']['person']['username'].'/" class="ui" >Profile</a></li>
					<li><a href="#/read/~/data/service=session&enc=get/ln/#login" class="launch">Sign Out</a></li>
				</ul>
			</li>
		</ul>';
	}
	
?>