/**
 *	@template ResourceEdit
 *
**/
Executive.jquery.template.ResourceEdit = $.template('\
	{{if valid}}\
	<div id="resource-edit-container" class="panel form-panel">\
		<p class="head">Edit Resource #${message.resource.rsrcid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._resource-edit-container">\
				<input type="hidden" name="service" value="gridview.resource.edit">\
				<input type="hidden" name="rsrcid" value="${message.resource.rsrcid}">\
				<label>Name\
					<input type="text" name="rsrcname" size="50" disabled="disabled" value="${message.resource.rsrcname}" />\
				</label>\
				<label>Resource</label>\
				<textarea name="resource" rows="15" cols="80">${message.resource.resource}</textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
