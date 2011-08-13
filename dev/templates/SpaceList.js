/**
 *	@template SpaceList
 *
**/
Executive.jquery.template.SpaceList = $.template('\
<div id="space-container">\
	{{if valid}}\
	<div id="space-child-container"></div>\
	<div id="space-list-container" class="panel left">\
		<p class="head">Spaces in ${message.cntrname} Container</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#space-child-container:tpl=tpl-spc-add:arg=cntrname~${message.cntrname}&cntrid~${message.cntrid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.spaces}}\
		<div class="panel">\
			<p class="subhead">${spname}</p>\
			<p>\
				<a href="#tplload:cntr=#space-child-container:tpl=tpl-stg-lst:url=launch.php:arg=service~griddata.storage.list&spaceid~${spaceid}&spname~${spname}" class="navigate" >List</a>\
				<a href="launch.php?request=get&service=griddata.space.archive&spaceid=${spaceid}&asname=${spname}.zip" target="_blank">Archive</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#space-child-container:tpl=tpl-spc-edt:url=launch.php:arg=service~griddata.space.info&cntrname~${message.cntrname}&spaceid~${spaceid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#space-child-container:url=launch.php:arg=service~griddata.space.remove&cntrid~${message.cntrid}&spaceid~${spaceid}:cf=true" class="navigate" >Remove</a> (Ensure empty before removing)\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
