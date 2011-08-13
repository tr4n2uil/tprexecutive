/**
 *	@template SpaceAdd
 *
**/
Executive.jquery.template.SpaceAdd = $.template('\
<div id="space-add-container" class="panel form-panel">\
	<p class="head">Add Space to ${cntrname} Container</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._space-add-container">\
				<input type="hidden" name="service" value="griddata.space.add">\
				<input type="hidden" name="cntrid" value="${cntrid}">\
				<label>Name\
					<input type="text" name="spname" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Path\
					<input type="text" name="sppath" class="required" size="85" />\
				</label>\
					<p class="error hidden margin5">Invalid Path</p>\
					<p class="desc">Must end in / eg. "storage/test/"</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');