/**
 *	@template NoteInfo
 *
**/
Executive.jquery.template.NoteInfo = $.template('\
	{{if valid}}\
	<div id="note-info-container" class="panel left">\
		<p class="head">${message.note.title}</p>\
		<div class="panel">\
			<p>Author : <span class="bold">${message.note.author}</span> (Last Updated on ${message.note.time})\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<a href="#tplload:cntr=#note-child-container:tpl=tpl-nte-edt:url=launch.php:arg=service~gridshare.note.info&noteid~${message.note.noteid}&bname~${message.bname}" class="navigate" >Edit</a>\
			<a href="#tplload:cntr=#note-child-container:url=launch.php:arg=service~gridshare.note.remove&noteid~${message.note.noteid}&boardid~${message.boardid}:cf=true" class="navigate" >Remove</a>\
			{{/if}}\
			</p>\
		</div>\
		<div class="panel">\
			<p>{{html message.note.note}}</p>\
		</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
