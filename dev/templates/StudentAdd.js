/**
 *	@template StudentAdd
 *
**/
Executive.jquery.template.StudentAdd = $.template('\
<div id="student-add-container" class="panel form-panel">\
	<p class="head">Add Student in ${btname} Batch</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._student-add-container">\
				<input type="hidden" name="service" value="executive.student.add">\
				<input type="hidden" name="batchid" value="${batchid}">\
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
				<label>Roll No\
					<input type="text" name="rollno" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid Roll No</p>\
				<label>Phone\
					<input type="text" name="phone"/>\
				</label>\
				<label>Course\
					<select name="course">\
						<option value="B Tech">B.Tech</option>\
						<option value="IDD">IDD</option>\
					</select>\
				</label>\
				<label>Year\
					<input type="text" name="year" class="required" value="${btname}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Year</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');