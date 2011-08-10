/**
 *	@template CompanyAdd
 *
**/
Executive.jquery.template.CompanyAdd = $.template('\
<div id="company-add-container" class="panel form-panel">\
	<p class="head">Add Company</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._company-add-container">\
				<input type="hidden" name="service" value="executive.company.add">\
				<label>Email\
					<input type="text" name="email" class="required email" />\
				</label>\
					<p class="error hidden margin5">Invalid Email</p>\
				<label>Password\
					<input type="password" name="password" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Password</p>\
				<label>Name\
					<input type="text" name="name"  class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Site\
					<input type="text" name="site" />\
				</label>\
				<label>Interests</label>\
				<textarea name="interests" rows="5" cols="80"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');