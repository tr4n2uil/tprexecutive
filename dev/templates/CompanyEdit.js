/**
 *	@template CompanyEdit
 *
**/
Executive.jquery.template.CompanyEdit = $.template('\
	{{if valid}}\
	<div id="company-edit-container" class="panel form-panel">\
	<p class="head">Edit Company #${message.company.comid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._company-edit-container">\
				<input type="hidden" name="service" value="executive.company.edit">\
				<input type="hidden" name="comid" value="${message.company.comid}">\
				<label>Email\
					<input type="text" name="email" class="required email" value="${message.company.email}" disabled="disabled" size="50" />\
				</label>\
				<label>Name\
					<input type="text" name="name"  class="required"  value="${message.company.name}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Site\
					<input type="text" name="site" value="${message.company.site}" />\
				</label>\
				<label>Interests</label>\
				<textarea name="interests" rows="5" cols="80">${message.company.interests}</textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
