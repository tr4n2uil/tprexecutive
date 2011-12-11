<?php 
	
	$flag = true;
	$content = isset($_GET['content']) ? $_GET['content'] : 'home';
	if($content == 'download') $flag = false;
	
	if(in_array($content, array('cnt-office', 'cnt-varanasi', 'com-procedure', 'acd-overview', 'acd-disciplines', 'acd-beyond', 'adv-itbhu', 'adv-alumni', 'adv-facilities', 'hom-msgtpo', 'hom-msgdct', 'home'))){
		$content = 'ui/html/'.$content.'.html';
	}
	elseif(in_array($content, array('course-list', 'course', 'test', 'lecture', 'download', 'feedback', 'tutorial'))){
		$content = 'ui/php/'.$content.'.php';
	}
	else {
		echo "Invalid Content";
		exit;
	}
	
	include_once('init.php');
	
	if($flag){
	include_once('ui/html/header.html'); 

?>
	<div id="container">
		<div id="quick-container">
			Krishnakripa
		</div>
		<div id="main-container">
			<?php include_once($content); ?>
		</div>
		<div class="clearfloat"></div>
	</div>
<?php 
	include_once('ui/html/footer.html'); 
	}
	else {
		include_once($content);
	}
?>
