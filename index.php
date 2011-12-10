<?php 
	
	$flag = true;
	$content = isset($_GET['content']) ? $_GET['content'] : 'home';
	if($content == 'download') $flag = false;
	
	if(in_array($content, array('procedure', 'advantage', 'alumni', 'facilities', 'home'))){
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
		<?php include_once($content); ?>
		<div class="clearfloat"></div>
	</div>
<?php 
	include_once('ui/html/footer.html'); 
	}
	else {
		include_once($content);
	}
?>
