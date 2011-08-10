/**
 *	@template StageAdd
 *
**/
Executive.jquery.template.StageAdd = $.template('\
<div id="stage-add-container" class="panel form-panel">\
	<p class="head">Add Stage in Proceeding for ${procname}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._stage-add-container">\
				<input type="hidden" name="service" value="gridevent.stage.add">\
				<input type="hidden" name="eventid" value="${procid}">\
				<label>Name\
					<input type="text" name="name"  class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Stage\
					<input type="text" name="stage" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid Stage</p>\
				<label>Start Time\
					<input type="text" name="start" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Start Time</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<label>End Time\
					<input type="text" name="end" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid End Time</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<label>Open\
					<input type="text" name="open" class="required" value="0"/>\
				</label>\
					<p class="error hidden margin5">Invalid Open value</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');