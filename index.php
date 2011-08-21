<?php 

	require_once('init.php');
	require_once('lib/Document.class.php');
	
	/*if((substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip'))&&(!substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'sdch')))
		$gzip = '.gz';
	else*/ $gzip = '';
	
	Document::header('TPR Executive', array("executive-ui.css$gzip"));
	
	include('ui/html/main-header.html');
	
?>

	
	<div id="centre-panel" class="panel">
		<div id="quick-panel">
			<?php 
				$kernel = new WorkflowKernel();
				$email = false;
				if(isset($_COOKIE[COOKIENAME])){
					$service = array(
						'service' => 'gridutil.session.info.workflow',
						'sessionid' => $_COOKIE[COOKIENAME]
					);
					$memory = $kernel->run($service);
					if($memory['valid']) 
						$email = $memory['email'];
				}
				if($email){
					include('ui/html/quick-account.html');
					
					$service = array(
						'service' => 'executive.student.find.workflow'
					);
					$memory = $kernel->run($service, $memory);
					if($memory['valid']) {
?>
			<div id="student-quick-panel" class="panel">
				<p class="headdark"><?php echo $memory['name'] ?></p>
				<div><img src="launch.php?request=get&service=griddata.storage.read&stgid=<?php echo $memory['photo'] ?>&spaceid=<?php echo $memory['btphoto'] ?>" alt="" height="100" ></div>
				<ul class="vertical menu">
					<li><a href="#tplload:cntr=#main-container:tpl=tpl-std-edt:url=launch.php:arg=service~executive.student.info&batchid~<?php echo $memory['batchid'] ?>" class="navigate">Profile</a></li>
					<li><a href="launch.php?request=get&service=griddata.storage.read&stgid=<?php echo $memory['resume'] ?>&spaceid=<?php echo $memory['btresume'] ?>" target="_blank">Resume</a></li>
					<li><a href="#tplload:cntr=#main-container:key=template:url=launch.php:arg=service~gridview.content.view&cntid~<?php echo $memory['home'] ?>" class="navigate" >Home Page</a></li>
					<li><a href="#tplload:cntr=#main-container:tpl=tpl-sel-lst:url=launch.php:arg=service~gridevent.selection.all" 
						class="navigate" >Selections</a></li>
				</ul>
		</div>
		<div id="student-quick-panel" class="panel">
				<p class="headdark">Batch <?php echo $memory['btname'] ?></p>
				<ul class="vertical menu">
					<li><a href="#tplload:cntr=#main-container:tpl=tpl-std-lst:url=launch.php:arg=service~executive.student.list&batchid~<?php echo $memory['batchid'] ?>&btname~<?php echo $memory['btname'] ?>&course~B Tech" class="navigate" >B Tech</a></li>
					<li><a href="#tplload:cntr=#main-container:tpl=tpl-std-lst:url=launch.php:arg=service~executive.student.list&batchid~<?php echo $memory['batchid'] ?>&btname~<?php echo $memory['btname'] ?>&course~IDD" class="navigate" >IDD</a></li>
				</ul>
		</div>
<?php
					}
					else { 
						$service = array(
							'service' => 'executive.company.find.workflow'
						);
						$memory = $kernel->run($service, $memory);
						if($memory['valid']) {
?>
			<div id="company-quick-panel" class="panel">
				<p class="headdark"><?php echo $memory['name'] ?></p>
				<img src="launch.php?request=get&service=griddata.storage.read&stgid=<?php echo $memory['photo'] ?>&spaceid=<?php echo $memory['indphoto'] ?>" alt="" width="150" align="center">
				<ul class="vertical menu">
					<li><a href="#tplload:cntr=#main-container:tpl=tpl-com-edt:url=launch.php:arg=service~executive.company.info&indid~<?php echo $memory['indid'] ?>" class="navigate">Profile</a></li>
					<li><a href="#tplload:cntr=#main-container:tpl=tpl-prc-lst:url=launch.php:arg=service~gridevent.event.list&seriesid~<?php echo $memory['comid'] ?>&srname~<?php echo $memory['name'] ?>" class="navigate" >Proceedings</a></li>
				</ul>
		</div>
<?php
						}
					}
					
					if(in_array($email, array('admin@executive.edu', 'vibhaj@gmail.com', 'vibhaj8@gmail.com'))){
						include('ui/html/quick-console.html');
					}
				}
				else {
					include('ui/html/quick-login.html');
				}
			?>
			<div id="update-panel"></div>
		</div>
		<div id="main-container">
				<?php include('ui/html/main-home.html'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="bottom-panel" class="panel">
<?php
	
	$footer = <<<FOOTER
		<div class="fleft">
			<div class="panel">
				<p>Developed by enhanCSE Technologies</p>
				<p>2011 <a href="http://www.github.com/tr4n2uil/tprexecutive" target="_blank">Open Source</a><a href="mailto:enhancse.tech@gmail.com">enhancse.tech@gmail.com</a></p>
			</div>
		</div>
		<div class="fleft panel" style="background:white; height: 3em;">
			<img src="ui/img/officials/opensource.png" alt="opensource_logo">
			<img src="ui/img/officials/php.png" alt="php_logo">
			<img src="ui/img/officials/mysql.png" alt="mysql_logo">
			<img src="ui/img/officials/jquery.png" alt="jquery_logo">
		</div>
		<div class="fright panel" style="width: 15%">
				<p>Executive UI Optimized for Mozilla Firefox 3.6+</p>
		</div>
FOOTER;

	Document::footer($footer, array(
	/*	'jQuery Core' => 'jquery-1.6.1.min.js',
	//	'jQuery UI' => 'jquery-ui-1.8.13.min.js',
		'jQuery Templates' => 'jquery.tmpl.min.js',
		'jQuery Cookie' => 'jquery.cookie.js',
		'JSON Library' => 'json2.js',
		'jQuery FireSpark' => 'jquery-firespark.js',
		'Executive Extensions' => 'executive-jquery.js',
		'Executive Templates' => 'executive-templates.js'
		'LAB Library' => "LAB.min.js$gzip",*/
		'Executive UI' => "executive-ui.js$gzip",
		'CKEditor' => "ckeditor/ckeditor.js$gzip",
		'jQuery CKEditor' => "ckeditor/adapters/jquery.js$gzip"
	));
	
?>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			
			FireSpark.Registry.add('#tabtpl', FireSpark.jquery.workflow.TabTemplate);
			FireSpark.Registry.add('#htmlload', FireSpark.jquery.workflow.ElementHtml);
			FireSpark.Registry.add('#tplload', FireSpark.jquery.workflow.ElementTemplate);
			FireSpark.Registry.add('#formsubmit', FireSpark.jquery.workflow.FormSubmit);
			FireSpark.Registry.add('#tplbind', FireSpark.jquery.workflow.BindTemplate);
			
			FireSpark.Registry.save('login', FireSpark.jquery.workflow.CookieLogin);
			
			FireSpark.Registry.save('tpl-bth-add', Executive.jquery.template.BatchAdd);
			FireSpark.Registry.save('tpl-bth-lst', Executive.jquery.template.BatchList);
			FireSpark.Registry.save('tpl-bth-edt', Executive.jquery.template.BatchEdit);
			
			FireSpark.Registry.save('tpl-std-add', Executive.jquery.template.StudentAdd);
			FireSpark.Registry.save('tpl-std-bth', Executive.jquery.template.StudentBatch);
			FireSpark.Registry.save('tpl-std-lst', Executive.jquery.template.StudentList);
			FireSpark.Registry.save('tpl-std-edt', Executive.jquery.template.StudentEdit);
			
			FireSpark.Registry.save('tpl-com-add', Executive.jquery.template.CompanyAdd);
			FireSpark.Registry.save('tpl-com-lst', Executive.jquery.template.CompanyList);
			FireSpark.Registry.save('tpl-com-edt', Executive.jquery.template.CompanyEdit);
			
			FireSpark.Registry.save('tpl-sta-add', Executive.jquery.template.StageAdd);
			FireSpark.Registry.save('tpl-sta-lst', Executive.jquery.template.StageList);
			FireSpark.Registry.save('tpl-sta-edt', Executive.jquery.template.StageEdit);
			
			FireSpark.Registry.save('tpl-sel-lst', Executive.jquery.template.SelectionList);
			FireSpark.Registry.save('tpl-sel-sta', Executive.jquery.template.SelectionStage);
			
			FireSpark.Registry.save('tpl-prc-add', Executive.jquery.template.ProceedingAdd);
			FireSpark.Registry.save('tpl-prc-lst', Executive.jquery.template.ProceedingList);
			FireSpark.Registry.save('tpl-prc-edt', Executive.jquery.template.ProceedingEdit);
			
			FireSpark.Registry.save('tpl-nte-add', Executive.jquery.template.NoteAdd);
			FireSpark.Registry.save('tpl-nte-lst', Executive.jquery.template.NoteList);
			FireSpark.Registry.save('tpl-nte-inf', Executive.jquery.template.NoteInfo);
			FireSpark.Registry.save('tpl-nte-edt', Executive.jquery.template.NoteEdit);
			
			FireSpark.Registry.save('tpl-lst-add', Executive.jquery.template.ListAdd);
			FireSpark.Registry.save('tpl-lst-lst', Executive.jquery.template.ListList);
			FireSpark.Registry.save('tpl-lst-inf', Executive.jquery.template.ListInfo);
			FireSpark.Registry.save('tpl-lst-edt', Executive.jquery.template.ListEdit);
			
			FireSpark.Registry.save('tpl-spc-add', Executive.jquery.template.SpaceAdd);
			FireSpark.Registry.save('tpl-spc-lst', Executive.jquery.template.SpaceList);
			FireSpark.Registry.save('tpl-spc-edt', Executive.jquery.template.SpaceEdit);
			
			FireSpark.Registry.save('tpl-stg-add', Executive.jquery.template.StorageAdd);
			FireSpark.Registry.save('tpl-stg-lst', Executive.jquery.template.StorageList);
			FireSpark.Registry.save('tpl-stg-edt', Executive.jquery.template.StorageEdit);
			
			FireSpark.Registry.save('tpl-rsc-add', Executive.jquery.template.ResourceAdd);
			FireSpark.Registry.save('tpl-rsc-lst', Executive.jquery.template.ResourceList);
			FireSpark.Registry.save('tpl-rsc-edt', Executive.jquery.template.ResourceEdit);
			
			FireSpark.Registry.save('tpl-cnt-add', Executive.jquery.template.ContentAdd);
			FireSpark.Registry.save('tpl-cnt-lst', Executive.jquery.template.ContentList);
			FireSpark.Registry.save('tpl-cnt-edt', Executive.jquery.template.ContentEdit);

			FireSpark.Kernel.execute([{
				service : FireSpark.jquery.service.NavigatorInit,
				selector : 'a.navigate',
				attribute : 'href'
			},{
				service : FireSpark.jquery.service.NavigatorInit,
				selector : 'form.navigate',
				event : 'submit',
				attribute : 'id',
				escaped : true
			},{
				service : FireSpark.jquery.service.ElementContent,
				element : '#load-status',
				select : true,
				data : 'Initializing ...',
				animation : 'fadeout',
				duration : 1500,
				delay : 500
			}]);
			
			$('#main-container div').live('load' , function(){
				if($(this).hasClass('editor')){
					FireSpark.Kernel.run({
						service : FireSpark.jquery.service.ElementEditor,
						selector : 'textarea.editor'
					}, {});
				}
			});
			
		});
	</script>
	</body>
</html>
