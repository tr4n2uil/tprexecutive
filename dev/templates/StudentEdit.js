/**
 *	@template StudentEdit
 *
**/
Executive.jquery.template.StudentEdit = $.template('\
	{{if valid}}\
	<div id="file-panel"></div>\
	<div id="student-options-container" class="panel left">\
		<p class="head">{{if FireSpark.core.helper.equals(message.admin, 1)}}Student #${message.student.stuid}{{else}}Profile{{/if}} Edit Options</p>\
		<ul class="horizontal menu">\
			<li><a href="#tplbind:cntr=#file-panel:tpl=tpl-stg-edt:arg=spname~Resume&stgid~${message.student.resume}&spaceid~${message.btresume}" class="navigate" >Resume</a>\
			</li>\
			<li><a href="#tplbind:cntr=#file-panel:tpl=tpl-stg-edt:arg=spname~Photo&stgid~${message.student.photo}&spaceid~${message.btphoto}" class="navigate" >Photo</a>\
			</li>\
			<li><a href="#tplload:cntr=#file-panel:key=template:url=launch.php:arg=service~gridview.content.view&cntid~${message.student.home}" class="navigate" >Home Page</a>\</li>\
		</ul>\
	</div>\
	<div id="student-key-container" class="panel form-panel">\
	<p class="head">Change Password</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._student-key-container">\
				<input type="hidden" name="service" value="executive.student.key">\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}<input type="hidden" name="stuid" value="${message.student.stuid}"/>{{/if}}\
				<label>{{if FireSpark.core.helper.equals(message.admin, 1)}}Admin {{/if}}Email\
					<input type="text" name="currentemail" class="required email" />\
				</label>\
					<p class="error hidden margin5">Invalid Email</p>\
				<label>{{if FireSpark.core.helper.equals(message.admin, 1)}}Admin {{else}}Current {{/if}}Password\
					<input type="password" name="currentkey" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Password</p>\
				<label>New Password\
					<input type="password" name="keyvalue" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Password</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
	<div id="student-edit-container" class="panel form-panel">\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._student-edit-container">\
			<p class="head">{{if FireSpark.core.helper.equals(message.admin, 1)}}Edit Student #${message.student.stuid}{{else}}Edit Profile{{/if}}</p>\
			<input type="hidden" name="service" value="executive.student.{{if FireSpark.core.helper.equals(message.admin, 1)}}edit{{else}}update{{/if}}"/>\
			<input type="hidden" name="stuid" value="${message.student.stuid}"/>\
			<label>Email\
				<input type="text" name="email" value="${message.student.email}" disabled="disabled" size="50"/>\
			</label>\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<label>Name\
				<input type="text" name="name" value="${message.student.name}" class="required"/>\
			</label>\
				<p class="error hidden margin5">Invalid Name</p>\
			<label>Roll Number\
				<input type="text" name="rollno" value="${message.student.rollno}" class="required"/>\
			</label>\
				<p class="error hidden margin5">Invalid Roll number</p>\
			<label>Course\
				<select name="course" >\
					<option value="B Tech" {{if FireSpark.core.helper.equals(message.student.course, "B Tech")}}selected="selected"{{/if}}>B.Tech</option>\
					<option value="IDD" {{if FireSpark.core.helper.equals(message.student.course, "IDD")}}selected="selected"{{/if}}>IDD</option>\
				</select>\
			</label>\
			<label>Year\
				<input type="text" name="year" value="${message.student.year}" />\
			</label>\
			{{/if}}\
			<label>Phone\
				<input type="text" name="phone" value="${message.student.phone}"/>\
			</label>\
			<label>CGPA\
				<input type="text" name="cgpa" value="${message.student.cgpa}"/>\
			</label>\
			<label>Interests\
				<textarea name="interests" rows="5">${message.student.interests}</textarea>\
			</label>\
			<label>SGPA I\
				<input type="text" name="sgpa1" value="${message.student.sgpa1}"/>\
			</label>\
			<label>SGPA II\
				<input type="text" name="sgpa2" value="${message.student.sgpa2}"/>\
			</label>\
			<label>SGPA III\
				<input type="text" name="sgpa3" value="${message.student.sgpa3}"/>\
			</label>\
			<label>SGPA IV\
				<input type="text" name="sgpa4" value="${message.student.sgpa4}"/>\
			</label>\
			<label>SGPA V\
				<input type="text" name="sgpa5" value="${message.student.sgpa5}"/>\
			</label>\
			<label>SGPA VI\
				<input type="text" name="sgpa6" value="${message.student.sgpa6}"/>\
			</label>\
			<label>SGPA VII\
				<input type="text" name="sgpa7" value="${message.student.sgpa7}"/>\
			</label>\
			<label>SGPA VIII\
				<input type="text" name="sgpa8" value="${message.student.sgpa8}"/>\
			</label>\
			<label>SGPA IX\
				<input type="text" name="sgpa9" value="${message.student.sgpa9}"/>\
			</label>\
			<label>SGPA X\
				<input type="text" name="sgpa10" value="${message.student.sgpa10}"/>\
			</label>\
			<label>YGPA I\
				<input type="text" name="ygpa1" value="${message.student.ygpa1}"/>\
			</label>\
			<label>YGPA II\
				<input type="text" name="ygpa2" value="${message.student.ygpa2}"/>\
			</label>\
			<label>YGPA III\
				<input type="text" name="ygpa3" value="${message.student.ygpa3}"/>\
			</label>\
			<label>YGPA IV\
				<input type="text" name="ygpa4" value="${message.student.ygpa4}"/>\
			</label>\
			<label>YGPA V\
				<input type="text" name="ygpa5" value="${message.student.ygpa5}"/>\
			</label>\
			<input name="submit" type="submit" value="Submit" class="margin5"/>\
			<input name="reset" type="reset" value="Reset" class="margin5"/>\
			<div class="status"></div>\
		</form>\
	</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
