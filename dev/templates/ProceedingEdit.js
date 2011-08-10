/**
 *	@template ProceedingEdit
 *
**/
Executive.jquery.template.ProceedingEdit = $.template('\
<div id="proceeding-edit-container" class="panel form-panel">\
	<p class="head">Edit Proceeding #${message.proceeding.procid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._proceeding-edit-container">\
				<input type="hidden" name="service" value="executive.proceeding.edit">\
				<input type="hidden" name="procid" value="${message.proceeding.procid}">\
				<label>Name\
					<input type="text" name="name" value="${message.proceeding.name}" disabled="disabled" size="50"/>\
				</label>\
				<label>Year\
					<input type="text" name="year" class="required" value="${message.proceeding.year}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Year</p>\
				<label>Type\
					<select name="type">\
						<option value="Internship" {{if FireSpark.core.helper.equals(message.proceeding.type, "Internship")}}selected="selected"{{/if}}>Internship</option>\
						<option value="Placement" {{if FireSpark.core.helper.equals(message.proceeding.type, "Placement")}}selected="selected"{{/if}}>Placement</option>\
					</select>\
				</label>\
				<label>Eligibility\
					<input type="text" name="eligibility" class="required" value="${message.proceeding.eligibility}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Eligibility</p>\
				<label>Margin\
					<input type="text" name="margin" value="${message.proceeding.margin}" />\
				</label>\
				<label>Maximum Applications\
					<input type="text" name="max" value="${message.proceeding.max}" />\
				</label>\
				<label>Deadline\
					<input type="text" name="deadline" class="required" value="${message.proceeding.deadline}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Eligibility</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');