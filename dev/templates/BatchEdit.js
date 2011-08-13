/**
 *	@template BatchEdit
 *
**/
Executive.jquery.template.BatchEdit = $.template('\
<div id="batch-edit-container" class="panel form-panel">\
	<p class="head">Edit Batch #${batchid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._batch-edit-container">\
				<input type="hidden" name="service" value="executive.batch.edit">\
				<input type="hidden" name="batchid" value="${batchid}">\
				<label>Name\
					<input type="text" name="btname" class="required" size="50" value="${btname}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
					<p class="desc">Batch Enrollment year suggested as name eg. 2008</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
