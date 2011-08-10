<?php 

	require_once('init.php');
	require_once(TSROOT . 'console/sys/lib/Document.class.php');
	
	Document::header('TPR Executive', array(
		'default.css', 'jquery.css', 'layout.css'
	));
	
	include(EXROOT. 'ui/html/main-header.html');
	
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
					include(EXROOT. 'ui/html/quick-student.html');
					if(in_array($email, array('admin@executive.org', 'vibhaj@gmail.com'))){
						include(EXROOT. 'ui/html/quick-admin.html');
					}
				}
				else {
					include(EXROOT. 'ui/html/quick-login.html');
				}
			?>
			<div id="update-panel"></div>
		</div>
		<div id="main-container">
				<?php include(EXROOT. 'ui/html/main-home.html'); ?>
		</div>
		<div class="clear"></div>
	</div>
	<div id="bottom-panel" class="panel">
<?php
	
	Document::footer('<p>Powered by enhanCSE Development Team</p>', array(
		'jQuery Core' => 'jquery-1.6.1.min.js',
	//	'jQuery UI' => 'jquery-ui-1.8.13.min.js',
		'jQuery Templates' => 'jquery.tmpl.min.js',
		'jQuery Cookie' => 'jquery.cookie.js',
		'JSON Library' => 'json2.js',
		'jQuery FireSpark' => 'jquery-firespark.js',
		'Executive Extensions' => 'executive-jquery.js',
		'Executive Templates' => 'executive-templates.js'
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
			
			FireSpark.Registry.save('tpl-upd-add', Executive.jquery.template.UpdateAdd);
			FireSpark.Registry.save('tpl-upd-lst', Executive.jquery.template.UpdateList);
			FireSpark.Registry.save('tpl-upd-edt', Executive.jquery.template.UpdateEdit);
			
			/*FireSpark.Registry.save('tpl-test', FireSpark.jquery.template.Test);
			FireSpark.Registry.save('tpl-usr-all', ThunderSky.jquery.template.UserAll);
			FireSpark.Registry.save('tpl-usr-edt', ThunderSky.jquery.template.UserEdit);
			FireSpark.Registry.save('tpl-spc-all', ThunderSky.jquery.template.SpaceAll);
			FireSpark.Registry.save('tpl-spe-all', ThunderSky.jquery.template.SpaceEntryAll);
			FireSpark.Registry.save('tpl-spc-edt', ThunderSky.jquery.template.SpaceEdit);
			FireSpark.Registry.save('tpl-rsrc-all', ThunderSky.jquery.template.ResourceAll);
			FireSpark.Registry.save('tpl-rsrc-edt', ThunderSky.jquery.template.ResourceEdit);
			FireSpark.Registry.save('tpl-cnt-all', ThunderSky.jquery.template.ContentAll);
			FireSpark.Registry.save('tpl-cnt-edt', ThunderSky.jquery.template.ContentEdit);*/

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
			
		});
	</script>
	</body>
</html>
