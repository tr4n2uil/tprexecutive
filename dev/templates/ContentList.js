/**
 *	@template ContentList
 *
**/
Executive.jquery.template.ContentList = $.template('\
<div id="content-container">\
	{{if valid}}\
	<div id="content-child-container"></div>\
	<div id="content-list-container" class="panel left">\
		<p class="head">Contents for ${message.stname}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#content-child-container:tpl=tpl-cnt-add:arg=stname~${message.stname}&siteid~${message.siteid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.contents}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${cntname}</p>\
			<p>\
				<a href="#tplload:cntr=#content-child-container:key=template:url=launch.php:arg=service~gridview.content.view&stname~${message.stname}&cntid~${cntid}" class="navigate" >View</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#content-child-container:tpl=tpl-cnt-edt:url=launch.php:arg=service~gridview.content.info&stname~${message.stname}&cntid~${cntid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#content-child-container:url=launch.php:arg=service~gridview.content.remove&cntid~${cntid}&siteid~${message.siteid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
