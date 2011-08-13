/**
 *	@template ResourceList
 *
**/
Executive.jquery.template.ResourceList = $.template('\
<div id="resource-container">\
	{{if valid}}\
	<div id="resource-child-container"></div>\
	<div id="resource-list-container" class="panel left">\
		<p class="head">Resources in ${message.stname} Site</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#resource-child-container:tpl=tpl-rsc-add:arg=stname~${message.stname}&siteid~${message.siteid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.resources}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${rsrcname}</p>\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<p>\
				<a href="#tplload:cntr=#resource-child-container:tpl=tpl-rsc-edt:url=launch.php:arg=service~gridview.resource.info&stname~${message.stname}&rsrcid~${rsrcid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#resource-child-container:url=launch.php:arg=service~gridview.resource.remove&rsrcid~${rsrcid}&siteid~${message.siteid}:cf=true" class="navigate" >Remove</a>\
			</p>\
			{{/if}}\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
