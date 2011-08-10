/**
 *	@template StageEdit
 *
**/
Executive.jquery.template.StageEdit = $.template('\
<div id="stage-edit-container" class="panel form-panel">\
	<p class="head">Edit Stage #${message.stage.stageid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._stage-edit-container">\
				<input type="hidden" name="service" value="gridevent.stage.edit">\
				<input type="hidden" name="stageid" value="${message.stage.stageid}">\
				<label>Name\
					<input type="text" name="name"  class="required" value="${message.stage.name}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Stage\
					<input type="text" name="stage" class="required" value="${message.stage.stage}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Stage</p>\
				<label>Start Time\
					<input type="text" name="start" class="required" value="${message.stage.start}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Start Time</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<label>End Time\
					<input type="text" name="end" class="required" value="${message.stage.end}"/>\
				</label>\
					<p class="error hidden margin5">Invalid End Time</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<label>Open\
					<input type="text" name="open" class="required" value="${message.stage.open}"/>\
				</label>\
				<label>Status\
					<input type="text" name="status" class="required" value="${message.stage.status}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Status value</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');