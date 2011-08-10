/**
 *	@template NoteList
 *
**/
Executive.jquery.template.NoteList = $.template('\
<div id="note-container">\
	{{if valid}}\
	<div id="note-child-container" class="editor"></div>\
	<div id="note-list-container" class="panel left">\
		<p class="head">${message.bname}s</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#note-child-container:tpl=tpl-nte-add:arg=bname~${message.bname}&boardid~${message.boardid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.notes}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${title}</p>\
			<p>\
				<a href="#tplload:cntr=#note-child-container:tpl=tpl-nte-inf:url=launch.php:arg=service~gridshare.note.info&noteid~${noteid}&bname~${message.bname}&boardid~${message.boardid}" class="navigate" >View</a>\ (Last Updated on ${time})\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
