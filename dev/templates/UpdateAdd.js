/**
 *	@template UpdateAdd
 *
**/
Executive.jquery.template.UpdateAdd = $.template('\
<div id="update-add-container" class="panel form-panel">\
	<p class="head">Add Update</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._update-add-container">\
				<input type="hidden" name="service" value="gridshare.note.add">\
				<input type="hidden" name="boardid" value="2">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');