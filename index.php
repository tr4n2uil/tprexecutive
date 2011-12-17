<?php 
	
	/**
	 * 	@initialize TPR Executive
	**/
	include_once('init.php');	
	
	/**
	 *	@initialize $memory
	**/
	$memory = array(
		'action' => isset($_GET['action']) ? $_GET['action'] : 'content',
		'content' => isset($_GET['content']) ? $_GET['content'] : 'home',
		'cookiename' => COOKIENAME,
		'static_pages' => array(
			'contact-us', 
			'companies', 
			'academics', 
			'why-at-itbhu', 
			'home'
		),
		'reqtype' => isset($_GET['request']) ? $_GET['request'] : 'post',
		'restype' => 'json',
		'crypt' => 'none',
		'hash' => 'none',
		'email' => $email,
		'context' => CONTEXT,
		'access' => array(
			'root' => array(
				'display', 
				'store', 
				'console', 
				'score', 
				'executive'
			)
		),
		'interface' => 'html',
		'raw' => true,
		'error_page' => 'error'
	);
	
	/**
	 *	@invoke Console Tile UI 
	**/
	$memory = Snowblozm::run(array(
		'service' => 'console.interface.tile.service'
	), $memory);
	
	/**
	 *	@invoke Get role based user content
	**/
	if($memory['email']){
		
	}
	else {
		$memory['tiles'] .= file_get_contents('ui/html/login.tile.html');
		$memory['contents'] .= file_get_contents('ui/html/login.html');
	}
	
	/**
	 *	Output view for user
	**/
	if($memory['ui']){
		include_once('ui/html/header.html'); 
?>
	<div id="container">
		<div class="tile-container">
			<?php echo $memory['tiles']; ?>
		</div>

		<div id="main-container" class="container">
			<?php echo $memory['contents']; ?>
		</div>
		
		<div class="clearfloat"></div>
	</div>
<?php 
		include_once('ui/html/footer.html'); 
	}
?>
