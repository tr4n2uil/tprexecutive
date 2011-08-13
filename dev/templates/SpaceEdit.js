/**
 *	@template SpaceEdit
 *
**/
Executive.jquery.template.SpaceEdit = $.template('\
<div id="space-edit-container" class="panel form-panel">\
	<p class="head">Edit Space #${message.spaceid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._space-edit-container">\
				<input type="hidden" name="service" value="griddata.space.edit">\
				<input type="hidden" name="spaceid" value="${message.spaceid}">\
				<label>Name\
					<input type="text" name="spname" class="required" size="50"  value="${message.spname}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Path\
					<input type="text" name="sppath" class="required" size="85" value="${message.sppath}" />\
				</label>\
					<p class="error hidden margin5">Invalid Path</p>\
					<p class="desc">Must end in / eg. "storage/test/"</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');