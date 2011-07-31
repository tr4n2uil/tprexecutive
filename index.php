<?php 

	require_once('init.php');
	require_once(TSROOT . 'console/sys/lib/Document.class.php');
	
	Document::header('TPR Executive', array(
		'default.css', 'jquery.css', 'layout.css'
	));
	
	include(EXROOT. 'ui/html/main-header.html');
	include(EXROOT. 'ui/html/main-menu.html');

?>
	<div id="quick-panel">
		<?php 
			$kernel = new WorkflowKernel();
			$email = false;
			if(isset($_COOKIE[COOKIENAME])){
				$service = array(
					'service' => 'cloudcore.session.info.workflow',
					'sessionid' => $_COOKIE[COOKIENAME]
				);
				$memory = $kernel->run($service);
				if($memory['valid']) 
					$email = $memory['email'];
			}
			if($email){
				include(EXROOT. 'ui/html/quick-account.html');
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

<?php
	
	Document::footer('<p>Powered by enhanCSE Development Team</p>', array(
		'jQuery Core' => 'jquery-1.6.1.min.js',
	//	'jQuery UI' => 'jquery-ui-1.8.13.min.js',
		'jQuery Templates' => 'jquery.tmpl.min.js',
	//	'jQuery Cookie' => 'jquery.cookie.js',
		'JSON Library' => 'json2.js',
		'jQuery FireSpark' => 'jquery-firespark.js',
	//	'TPR Executive Extensions' => 'thundersky-jquery.js',
		'TPR Executive Templates' => 'thundersky-templates.js'
	));
	
?>
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			FireSpark.Registry.add('#tabtpl', FireSpark.jquery.workflow.TabTemplate);
			FireSpark.Registry.add('#htmlload', FireSpark.jquery.workflow.ElementHtml);
			FireSpark.Registry.add('#tplload', FireSpark.jquery.workflow.ElementTemplate);
			FireSpark.Registry.add('#formsubmit', FireSpark.jquery.workflow.FormSubmit);
			
			FireSpark.Registry.save('reload', FireSpark.core.service.WindowReload);
			
			/*FireSpark.Registry.save('tpl-test', FireSpark.jquery.template.Test);
			FireSpark.Registry.save('tpl-usr-all', ThunderSky.jquery.template.UserAll);
			FireSpark.Registry.save('tpl-usr-edt', ThunderSky.jquery.template.UserEdit);
			FireSpark.Registry.save('tpl-prv-all', ThunderSky.jquery.template.PrivilegeAll);
			FireSpark.Registry.save('tpl-prv-edt', ThunderSky.jquery.template.PrivilegeEdit);
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
