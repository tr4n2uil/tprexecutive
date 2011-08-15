/**
 *	@template StorageList
 *
**/
Executive.jquery.template.StorageList = $.template('\
<div id="storage-container">\
	{{if valid}}\
	<div id="storage-child-container"></div>\
	<div id="storage-list-container" class="panel left">\
		<p class="head">Storages in ${message.spname} Space</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#storage-child-container:tpl=tpl-stg-add:arg=spname~${message.spname}&spaceid~${message.spaceid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.storages}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${stgname}</p>\
			<p>\
				<a href="launch.php?request=get&service=griddata.storage.read&stgid=${stgid}&spaceid=${message.spaceid}" target="_blank">Download</a>\ (${FireSpark.core.helper.readFileSize(size)})\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplbind:cntr=#storage-child-container:tpl=tpl-stg-edt:arg=spname~${message.spname}&stgid~${stgid}&spaceid~${message.spaceid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#storage-child-container:url=launch.php:arg=service~griddata.storage.remove&stgid~${stgid}&spaceid~${message.spaceid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
