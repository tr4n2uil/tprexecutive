/**
 *	@template ResourceAdd
 *
**/
Executive.jquery.template.ResourceAdd = $.template('\
	<div id="resource-add-container" class="panel form-panel">\
		<p class="head">Add Resource in ${stname} Site</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._resource-add-container">\
				<input type="hidden" name="service" value="gridview.resource.add">\
				<input type="hidden" name="siteid" value="${siteid}">\
				<label>Name\
					<input type="text" name="rsrcname" size="50" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Resource</label>\
				<textarea name="resource" rows="15" cols="80"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
