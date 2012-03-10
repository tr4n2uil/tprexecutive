<?php 

	/**
	 * 	@initialize TPR Executive
	**/
	include_once('init.php');
	
	/**
	 *	@initialize $memory
	**/
	$memory['source'] = 'query_string';
	$memory['reqtype'] = isset($_GET['enc']) ? $_GET['enc'] : 'path';

	/**
	 *	@invoke Launch Message
	**/
	$memory = Snowblozm::run(array(
		'service' => 'invoke.launch.message.workflow',
		'raw' => true
	), $memory);
	
	/**
	 *	@invoke Read response
	**/
	$message = $memory['response']['message'];
	if($memory['valid'] && $message['service'] == 'invoke.interface.console.workflow'){
		$TILES_0 .= $message['tiles'];
		$HTML .= $message['html'];
		
		/**
		 *	@parse Year and Page
		**/
		$YEAR = isset($message[0]) ? $message[0] : $YEAR;
		$PAGE = isset($message[1]) ? $message[1] : $YEAR;
	}
	else {
		if(isset($memory['data']))
			$HTML .= '
			<script type="text/javascript">
				Snowblozm.Registry.save("ui-global-data", '.$memory['result'].');
				Executive.data.launch.push("#/ui'.(strpos($memory['data'], '~') === false ? $memory['data'].'~/' : $memory['data']).'glb/true/");
			</script>';
		
		/**
		 *	@parse Year and Page
		**/
		$YEAR = isset($memory['year']) ? $memory['year'] : $YEAR;
		$PAGE = isset($message[0]) ? $message[0] : $YEAR;
	}
	
	/**
	 *	@invoke Get role based user content
	**/
	if($memory['user'] && !$EMERGENCY){
	
		/**
		 *	@role Administrator
		**/
		if(in_array($memory['user'], array(
			'admin.tpo', 
			'web.tpo', 
			'vibhaj'
		))){
			$STATEMENU .= file_get_contents('ui/html/admin.tile.html');
		}
		
		/**
		 *	@state Menu & Profile
		**/
		require_once('ui/php/statemenu.php');	
	}
	else {
		$STATEMENU .= file_get_contents('ui/html/login.tile.html');
		$SHTML.= file_get_contents('ui/html/login.html');
	}
	
	$TILES_0 .= file_get_contents('ui/html/info/home.tile.html');
	$HTML .= file_get_contents('ui/html/info/home.html');
	
	/*$TILES_0 .= file_get_contents('ui/html/'.$YEAR.'/events.tile.html');
	$HTML.= file_get_contents('ui/html/'.$YEAR.'/events.html');
	
	//$TILES_0 .= file_get_contents('ui/html/'.$YEAR.'/interact.tile.html');*/
	$TILES_0 .= file_get_contents('ui/html/downloads.tile.html');
	//$TILES_0 .= file_get_contents('ui/html/'.$YEAR.'/about.tile.html');
	
	//$TILES_1 .= file_get_contents('ui/html/'.$YEAR.'/partners.ribbon.html');
	
	if($EMERGENCY)
		$TILES_1 .= file_get_contents('ui/html/emergency.tile.html');
		
	//$TILES_1 .= file_get_contents('ui/html/portal.tile.html');
	
	//if($PAGE == $YEAR)
		//$TILES_1 .= file_get_contents('ui/html/social.tile.html');
	
	$HTML .= $SHTML;
	
	/**
	 *	Output view for user
	**/
	include_once('ui/php/header.php');
	include_once('ui/php/canvas.php');
	include_once('ui/html/footer.html');
	
?>
