/**
 *	@template StudentList
 *
**/
Executive.jquery.template.StudentList = $.template('\
<div id="student-container">\
	{{if valid}}\
	<div id="student-child-container"></div>\
	<div id="student-list-container" class="panel left">\
		<p class="head">All ${message.course} Students Enrolled in ${message.year}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#student-child-container:tpl=tpl-std-add" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.students}}\
		<div class="panel">\
		<table class="margin5 full">\
			<tbody>\
				<tr>\
					<td rowspan="5" valign="top"><img src="launch.php?request=get&service=griddata.storage.read&stgid=${photo}" alt="" height="100" ></td>\
					<td class="bold subhead">${$index+1}. ${name}</td>\
					<td rowspan="5">\
						<table class="glass-white right round grid">\
							<thead class="bold"><tr>\
								<td>SGPA</td>\
								<td>Odd</td>\
								<td>Even</td>\
								<td>YGPA</td>\
							</tr><thead>\
							<tbody>\
								<tr>\
									<td>Part I</td>\
									<td>${sgpa1}</td>\
									<td>${sgpa2}</td>\
									<td>${ygpa1}</td>\
								</tr>\
								<tr>\
									<td>Part II</td>\
									<td>${sgpa3}</td>\
									<td>${sgpa4}</td>\
									<td>${ygpa2}</td>\
								</tr>\
								<tr>\
									<td>Part III</td>\
									<td>${sgpa5}</td>\
									<td>${sgpa6}</td>\
									<td>${ygpa3}</td>\
								</tr>\
								<tr>\
									<td>Part IV</td>\
									<td>${sgpa7}</td>\
									<td>${sgpa8}</td>\
									<td>${ygpa4}</td>\
								</tr>\
								{{if FireSpark.core.helper.equals(message.course, "IDD")}}\
								<tr>\
									<td>Part V</td>\
									<td>${sgpa9}</td>\
									<td>${sgpa10}</td>\
									<td>${ygpa5}</td>\
								</tr>\
								{{/if}}\
							<tbody>\
						</table>\
					</td>\
				</tr>\
				<tr><td>${email}  |  ${phone}</td></tr>\
				<tr><td>${rollno}  |  <span class="bold">${cgpa}</span></td></tr>\
				<tr><td class="italic"><span>Interests :</span> ${interests}</td></tr>\
				<tr><td>\
					<a href="launch.php?request=get&service=griddata.storage.read&stgid=${resume}" target="_blank">Resume</a>\
					<a href="#tplload:cntr=#student-child-container:key=template:url=launch.php:arg=service~gridview.content.view&cntid~${home}" class="navigate" >Home Page</a>\
					{{if FireSpark.core.helper.equals(message.admin, 1)}}\
					<a href="#tplload:cntr=#student-child-container:tpl=tpl-std-edt:url=launch.php:arg=service~executive.student.info&stuid~${stuid}" class="navigate">Edit</a>\
					<a href="#tplload:cntr=#student-child-container:url=launch.php:arg=service~executive.student.remove&stuid~${stuid}:cf=true" class="navigate">Remove</a>\
					{{/if}}\
				</td></tr>\
				</tbody>\
		</table>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
