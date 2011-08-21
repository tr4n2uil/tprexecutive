/**
 *	@template ListList
 *
**/
Executive.jquery.template.ListList = $.template('\
<div id="list-container">\
	{{if valid}}\
	<div id="list-child-container" class="editor"></div>\
	<div id="list-list-container" class="panel left">\
		<p class="head">Lists in ${message.ctlgname} Catalogue</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#list-child-container:tpl=tpl-lst-add:arg=ctlgname~${message.ctlgname}&ctlgid~${message.ctlgid}&addcode~${message.addcode}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.lists}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${listname}</p>\
			<p>\
				<a href="#tplload:cntr=#list-child-container:tpl=${tplcode}:url=launch.php:arg=service~${serviceuri}&${idparam}~${listid}&${nameparam}~${listname}&addcode~${addcode}" class="navigate" >Open</a>\
				<a href="#tplload:cntr=#list-child-container:tpl=tpl-lst-inf:url=launch.php:arg=service~gridcontrol.list.info&listid~${listid}&ctlgname~${message.ctlgname}&ctlgid~${message.ctlgid}" class="navigate" >Info</a>\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
