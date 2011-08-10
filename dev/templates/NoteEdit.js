/**
 *	@template NoteEdit
 *
**/
Executive.jquery.template.NoteEdit = $.template('\
	{{if valid}}\
	<div id="note-edit-container" class="panel form-panel">\
		<p class="head">Edit ${bname} #${message.note.noteid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._note-edit-container">\
				<input type="hidden" name="service" value="gridshare.note.edit">\
				<input type="hidden" name="noteid" value="${message.note.noteid}">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" value="${message.note.title}" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80" class="editor">${message.note.note}</textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
