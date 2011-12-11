<?php

	if(!isset($_GET['cid'])){
		echo "Invalid Course";
		exit;
	}
	
	$cid = $_GET['cid'];
	if(!is_numeric($cid)){
		echo "Invalid Course";
		exit;
	}
	
?>

<div id="courses-info-container">	
	<div id="sidebar1">
		<hr />
		<p><a href="index.php?content=course-list">View All Courses</a></p>
		<hr />
		<p><a href="index.php?content=course&cid=<?php echo $cid; ?>">Course Home</a></p>
		<p><a href="index.php?content=course&action=syllabus&cid=<?php echo $cid; ?>">Syllabus</a></p>
		<p><a href="index.php?content=course&action=lectures&cid=<?php echo $cid; ?>">Lectures & Tutorials</a></p>
		<p><a href="index.php?content=course&action=test&cid=<?php echo $cid; ?>">Test</a></p>
		<p><a href="index.php?content=download&action=syllabus&cid=<?php echo $cid; ?>">Downloads</a></p>
		<hr />
	</div>
	<!-- end #sidebar1 -->
	
	<div id="mainContent" style="min-height:350px;">
		<div id="courses-info">

<?php
	
	$action = isset($_GET['action']) ? $_GET['action'] : 'info';
	if(in_array($action, array('info', 'syllabus', 'test', 'lectures'))){
		include('ui/php/course-'.$action.'.php');
	}
	else {
		echo "Invalid Action";
		exit;
	}

?>

		</div>
		<!-- end #courses-info -->
	</div>
</div>
