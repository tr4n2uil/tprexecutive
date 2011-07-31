<?php 

	require_once('../init.php');
	require_once(TSROOT . 'console/sys/lib/Document.class.php');
	Document::header('ThunderSky Console', array(
		'default.css', 'jquery.css', 'layout.css'
	));
	
	include(TSROOT. 'console/ui/html/main-header.html');
	include(TSROOT. 'console/ui/html/main-menu.html');

?>

	<div id="main-container">
			<?php include(TSROOT. 'console/ui/html/main-home.html'); ?>
	</div>

<?php
	
	Document::footer('<p>Powered by SnowBlozm and FireSpark projects</p>', array(
		'jQuery Core' => 'jquery-1.6.1.min.js',
		'jQuery UI' => 'jquery-ui-1.8.13.min.js',
		'jQuery Templates' => 'jquery.tmpl.min.js',
		'jQuery Cookie' => 'jquery.cookie.js',
		'JSON Library' => 'json2.js',
		'jQuery FireSpark' => 'jquery-firespark.js',
		'ThunderSky Extensions' => 'thundersky-jquery.js',
		'ThunderSky Templates' => 'thundersky-templates.js'
	));
	
?>
	
	<script type="text/javascript">
		$(document).ready(function(){
			
			FireSpark.Registry.add('#tabtpl', FireSpark.jquery.workflow.TabTemplate);
			FireSpark.Registry.add('#htmlload', FireSpark.jquery.workflow.ElementHtml);
			FireSpark.Registry.add('#tplload', FireSpark.jquery.workflow.ElementTemplate);
			FireSpark.Registry.add('#formsubmit', FireSpark.jquery.workflow.FormSubmit);
			
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

			FireSpark.Kernel.run([{
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
					data : 'Initializing ...',
					animation : 'fadeout',
					duration : 1500,
					delay : 500
				}]);
			
		});
	</script>
	</body>
</html>
