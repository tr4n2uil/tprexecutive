/**
 *	@template ListInfo
 *
**/
Executive.jquery.template.ListInfo = $.template('\
	{{if valid}}\
	<div id="list-info-container" class="panel left">\
		<p class="head">${message.list.listname}</p>\
		<p>Last Updated on ${message.list.time}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p>\
		<a href="#tplload:cntr=#list-child-container:tpl=tpl-lst-edt:url=launch.php:arg=service~gridcontrol.list.info&listid~${message.list.listid}&ctlgname~${message.ctlgname}" class="navigate" >Edit</a>\
		<a href="#tplload:cntr=#list-child-container:url=launch.php:arg=service~gridcontrol.list.remove&listid~${message.list.listid}&ctlgid~${message.ctlgid}:cf=true" class="navigate" >Remove</a>\
		</p>\
		{{/if}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
