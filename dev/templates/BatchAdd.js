/**
 *	@template BatchAdd
 *
**/
Executive.jquery.template.BatchAdd = $.template('\
<div id="batch-add-container" class="panel form-panel">\
	<p class="head">Add Batch to ${deptname} Department</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._batch-add-container">\
				<input type="hidden" name="service" value="executive.batch.add">\
				<input type="hidden" name="deptid" value="${deptid}">\
				<label>Name\
					<input type="text" name="btname" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
					<p class="desc">Batch Enrollment year suggested as name eg. 2008</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
