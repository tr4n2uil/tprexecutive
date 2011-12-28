<?php 
	
	/**
	 * 	@initialize TPR Executive
	**/
	include_once('init.php');	
	
	/**
	 *	@initialize $memory
	**/
	$memory['reqtype'] = isset($_GET['enc']) ? $_GET['enc'] : 'get';
	
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
		/**
		 *	@role Administrator
		**/
		if(in_array($memory['email'], array(
			'admin@executive.edu', 
			'tpo@itbhu.ac.in', 
			'vibhaj8@gmail.com'
		))){
			$memory['tiles'] .= file_get_contents('ui/html/admin.tile.html');
		}
		
		/**
		 *	@role Student
		**/
		$memory = Snowblozm::run(array(
			'service' => 'executive.student.find.workflow'
		), $memory);
		if($memory['valid']) {
		
		}
		
		/**
		 *	@role Company
		**/
		$memory = Snowblozm::run(array(
			'service' => 'executive.company.find.workflow'
		), $memory);
		if($memory['valid']) {
		
		}
		
		$memory['tiles'] .= file_get_contents('ui/html/logout.tile.html');
	}
	else {
		$memory['tiles'] .= file_get_contents('ui/html/login.tile.html');
		$memory['html'] .= file_get_contents('ui/html/login.html');
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
			<?php echo $memory['html']; ?>
		</div>
		
		<div class="clearfloat"></div>
	</div>
<?php 
		include_once('ui/html/footer.html'); 
	}
?>
