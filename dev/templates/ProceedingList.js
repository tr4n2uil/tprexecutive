/**
 *	@template ProceedingList
 *
**/
Executive.jquery.template.ProceedingList = $.template('\
<div id="proceeding-container">\
	{{if valid}}\
	<div id="proceeding-child-container"></div>\
	<div id="proceeding-list-container" class="panel left">\
		<p class="head">All Proceedings for ${message.srname}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#proceeding-child-container:tpl=tpl-prc-add:arg=srname~${message.srname}&comid~${message.seriesid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.events}}\
		<div class="panel">\
			<p class="subhead">${name}</p>\
			<p>\
				<a href="#tplload:cntr=#proceeding-child-container:key=template:url=launch.php:arg=service~gridview.content.view&cntid~${home}" class="navigate" >Details</a>\
				<a href="#tplload:cntr=#proceeding-child-container:tpl=tpl-sta-lst:url=launch.php:arg=service~gridevent.stage.list&eventid~${eventid}&ename~${name}" class="navigate" >Stages</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#proceeding-child-container:url=launch.php:arg=service~executive.proceeding.init&procid~${eventid}" \
					class="navigate" >Initialize</a>\
				<a href="#tplload:cntr=#proceeding-child-container:tpl=tpl-prc-edt:url=launch.php:arg=service~executive.proceeding.info&procid~${eventid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#proceeding-child-container:url=launch.php:arg=service~executive.proceeding.remove&procid~${eventid}&comid~${message.seriesid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
