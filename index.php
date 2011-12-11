<?php 
	
	/**
	 * 	@initialize flags
	**/
	$ui = true;
	$service = true;
	$email = false;
	$tiles = '';
	$content = '';
	
	$action = isset($_GET['action']) ? $_GET['action'] : 'content';
	
	switch($action){
		case 'download' :
			$ui = false;
			break;
			
		case 'content' :
			$content = isset($_GET['content']) ? $_GET['content'] : 'home';
			$service = false;
			if(in_array($content, array('contact-us', 'companies', 'academics', 'why-at-itbhu', 'home'))){
				$tiles .= file_get_contents('ui/html/'.$content.'.tile.html');
				$content = file_get_contents('ui/html/'.$content.'.html');
			}
			else {
				$tiles .= <<<ERRORTILE
				<p class="head2">Error</p>
				<hr class="hgt1 skyblue" />
				<p><a href="#showtile:tile=#invalid" class="navigate tile" style="background: url('ui/img/executive/error.png') no-repeat center bottom; background-size: 50px 50px;">Invalid Content</a><p/>
ERRORTILE;
				$content = <<<ERROR
					<div id="invalid" class="tile-content" style="display:block">
						<h1>Invalid Content</h1>
					</div>
ERROR;
			}
			break;
			
		default :
			break;
	}
	
	
	
	/**
	 * 	@initialize TPR Executive
	**/
	include_once('init.php');
	
	/**
	 *	@check cookie for session
	**/
	if(isset($_COOKIE[COOKIENAME])){
		$service = array(
			'service' => 'gridutil.session.info.workflow',
			'sessionid' => $_COOKIE[COOKIENAME]
		);
		
		$memory = Snowblozm::run($service);
		
		if($memory['valid']) 
			$email = $memory['email'];
	}		
	
	/**
	 *	@initialize $memory
	**/
	$memory = array(
		'reqtype' => isset($_GET['request']) ? $_GET['request'] : 'post',
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'email' => $email,
		'context' => CONTEXT,
		'access' => array(
			'root' => array('display', 'store', 'console', 'score', 'executive')
		),
		'interface' => 'html',
		'raw' => true
	);
	
	/**
	 *	@invoke Launch Message if any 
	**/
	if($service){
		Snowblozm::run(array(
			'service' => 'invoke.launch.message.workflow'
		), $memory);
	}
	
	/**
	 *	@invoke Get role based user content
	**/
	if($email){
		
	}
	else {
		$tiles .= file_get_contents('ui/html/login.tile.html');
		$content .= file_get_contents('ui/html/login.html');
	}
	
	/**
	 *	Output view for user
	**/
	if($ui){
		include_once('ui/html/header.html'); 
?>
	<div id="container">
		<div class="tile-container">
			<?php echo $tiles; ?>
		</div>

		<div id="main-container" class="container">
			<?php echo $content; ?>
		</div>
		
		<div class="clearfloat"></div>
	</div>
<?php 
		include_once('ui/html/footer.html'); 
	}
	else {
		//include_once($content);
	}
?>
