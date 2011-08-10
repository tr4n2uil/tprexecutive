/**
 *	@template NoteInfo
 *
**/
Executive.jquery.template.NoteInfo = $.template('\
	{{if valid}}\
	<div id="note-info-container" class="panel left">\
		<p class="head">${message.note.title}</p>\
		<p>${message.note.time}</p>\
		<div class="panel">\
			<p>{{html message.note.note}}</p>\
		</div>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p>\
		<a href="#tplload:cntr=#note-child-container:tpl=tpl-nte-edt:url=launch.php:arg=service~gridshare.note.info&noteid~${message.note.noteid}&bname~${message.bname}" class="navigate" >Edit</a>\
		<a href="#tplload:cntr=#note-child-container:url=launch.php:arg=service~gridshare.note.remove&noteid~${message.note.noteid}&boardid~${message.boardid}:cf=true" class="navigate" >Remove</a>\
		</p>\
		{{/if}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
