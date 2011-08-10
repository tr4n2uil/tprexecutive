/**
 *	@template NoteAdd
 *
**/
Executive.jquery.template.NoteAdd = $.template('\
<div id="note-add-container" class="panel form-panel">\
	<p class="head">Add ${bname}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._note-add-container">\
				<input type="hidden" name="service" value="gridshare.note.add">\
				<input type="hidden" name="boardid" value="${boardid}">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80" class="editor"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');