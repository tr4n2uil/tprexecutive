/**
 *	@template UpdateList
 *
**/
Executive.jquery.template.UpdateList = $.template('\
<div id="update-container">\
	{{if valid}}\
	<div id="update-child-container"></div>\
	<div id="update-list-container" class="panel left">\
		<p class="head">Updates</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#update-child-container:tpl=tpl-upd-add" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.notes}}\
		<div class="panel">\
			<p class="subhead">${title}</p>\
			<p>${time}</p>\
			<p>{{html note}}</p>\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<p>\
			<a href="#tplload:cntr=#update-child-container:tpl=tpl-upd-edt:url=launch.php:arg=service~gridshare.note.info&noteid~${noteid}" class="navigate" >Edit</a>\
			<a href="#tplload:cntr=#update-child-container:url=launch.php:arg=service~gridshare.note.remove&noteid~${noteid}:cf=true" class="navigate" >Remove</a>\
			</p>\
			{{/if}}\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
