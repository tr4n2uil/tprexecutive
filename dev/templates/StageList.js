/**
 *	@template StageList
 *
**/
Executive.jquery.template.StageList = $.template('\
<div id="stage-container">\
	{{if valid}}\
	<div id="stage-child-container"></div>\
	<div id="stage-list-container" class="panel left">\
		<p class="head">All Stages in Proceeding for ${message.ename}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#stage-child-container:tpl=tpl-sta-add:arg=procname~${message.ename}&procid~${message.eventid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.stages}}\
		<div class="panel">\
			<p class="subhead">${name} (Stage ${stage})</p>\
			<p>\
				<a href="#tplload:cntr=#stage-child-container:tpl=tpl-sel-sta:url=launch.php:arg=service~executive.student.stage&stageid~${stageid}&eventid~${message.eventid}&ename~${message.ename}&stname~${name}" \
					class="navigate" >Selections</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#stage-child-container:tpl=tpl-sta-edt:url=launch.php:arg=service~gridevent.stage.info&stageid~${stageid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#stage-child-container:url=launch.php:arg=service~gridevent.stage.remove&stageid~${stageid}&eventid~${message.eventid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
