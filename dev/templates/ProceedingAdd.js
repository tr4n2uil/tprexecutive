/**
 *	@template ProceedingAdd
 *
**/
Executive.jquery.template.ProceedingAdd = $.template('\
<div id="proceeding-add-container" class="panel form-panel">\
	<p class="head">Add Proceeding for ${srname}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._proceeding-add-container">\
				<input type="hidden" name="service" value="executive.proceeding.add">\
				<input type="hidden" name="comid" value="${comid}">\
				<label>Name\
					<input type="text" name="name"  class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Year\
					<input type="text" name="year" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid Year</p>\
				<label>Type\
					<select name="type">\
						<option value="Internship">Internship</option>\
						<option value="Placement">Placement</option>\
					</select>\
				</label>\
				<label>Eligibility\
					<input type="text" name="eligibility" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Eligibility</p>\
				<label>Margin\
					<input type="text" name="margin" value="0.0" />\
				</label>\
				<label>Maximum Applications\
					<input type="text" name="max" value="85" />\
				</label>\
				<label>Deadline\
					<input type="text" name="deadline" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Deadline</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');