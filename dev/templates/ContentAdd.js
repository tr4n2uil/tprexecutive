/**
 *	@template ContentAdd
 *
**/
Executive.jquery.template.ContentAdd = $.template('\
	<div id="content-add-container" class="panel form-panel">\
		<p class="head">Add Content in ${stname} Site</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._content-add-container">\
				<input type="hidden" name="service" value="gridview.content.add">\
				<input type="hidden" name="siteid" value="${siteid}">\
				<label>Name\
					<input type="text" name="cntname" size="50" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Style Type\
					<select name="cntstype">\
						<option value="1">Inline</option>\
						<option value="2">Resource</option>\
					</select>\
				</label>\
				<label>Style</label>\
				<textarea name="cntstyle" rows="15"></textarea>\
				<label>Template Type\
					<select name="cntttype">\
						<option value="1" >Inline</option>\
						<option value="2" >Resource</option>\
					</select>\
				</label>\
				<label>Template</label>\
				<textarea name="cnttpl" rows="15"></textarea>\
				<label>Data Type\
					<select name="cntdtype" >\
						<option value="1" >Inline</option>\
						<option value="2" >Resource</option>\
						<option value="3" >Query</option>\
					</select>\
				</label>\
				<label>Data</label>\
				<textarea name="cntdata" rows="15"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
