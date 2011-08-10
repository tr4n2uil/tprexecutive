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
');/**
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
/**
 *	@template CompanyList
 *
**/
Executive.jquery.template.CompanyList = $.template('\
<div id="company-container">\
	{{if valid}}\
	<div id="company-child-container"></div>\
	<div id="company-list-container" class="panel left">\
		<p class="head">All Companies</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#company-child-container:tpl=tpl-com-add" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.companies}}\
		<div class="panel">\
		<table class="margin5 full">\
			<tbody>\
				<tr>\
					<td rowspan="4" valign="top"><img src="core/space/read.php?spid=${stphoto}" alt="" height="100" ></td>\
					<td class="bold subhead">${name}</td>\
				</tr>\
				<tr><td><a href="${site}" target="_blank">${site}</a></td></tr>\
				<tr><td class="italic"><span>Interests :</span> ${interests}</td></tr>\
				<tr><td>\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-prc-lst:url=launch.php:arg=service~gridevent.event.list&seriesid~${comid}&srname~${name}" \
					class="navigate" >Proceedings</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-com-edt:url=launch.php:arg=service~executive.company.info&comid~${comid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#company-child-container:url=launch.php:arg=service~executive.company.remove&comid~${comid}:cf=true" class="navigate" >Remove</a>\
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
/**
 *	@template ProceedingAdd
 *
**/
Executive.jquery.template.ProceedingAdd = $.template('\
<div id="proceeding-add-container" class="panel form-panel">\
	<p class="head">Add Proceeding for ${srname}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._proceeding-add-container">\
				<input type="hidden" name="service" value="executive.proceeding.add">\
				<input type="hidden" name="comid" value="${comid}">\
				<label>Name\
					<input type="text" name="name"  class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Year\
					<input type="text" name="year" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid Year</p>\
				<label>Type\
					<select name="type">\
						<option value="Internship">Internship</option>\
						<option value="Placement">Placement</option>\
					</select>\
				</label>\
				<label>Eligibility\
					<input type="text" name="eligibility" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Eligibility</p>\
				<label>Margin\
					<input type="text" name="margin" value="0.0" />\
				</label>\
				<label>Maximum Applications\
					<input type="text" name="max" value="85" />\
				</label>\
				<label>Deadline\
					<input type="text" name="deadline" class="required" />\
				</label>\
					<p class="error hidden margin5">Invalid Deadline</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template ProceedingEdit
 *
**/
Executive.jquery.template.ProceedingEdit = $.template('\
<div id="proceeding-edit-container" class="panel form-panel">\
	<p class="head">Edit Proceeding #${message.proceeding.procid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._proceeding-edit-container">\
				<input type="hidden" name="service" value="executive.proceeding.edit">\
				<input type="hidden" name="procid" value="${message.proceeding.procid}">\
				<label>Name\
					<input type="text" name="name" value="${message.proceeding.name}" disabled="disabled" size="50"/>\
				</label>\
				<label>Year\
					<input type="text" name="year" class="required" value="${message.proceeding.year}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Year</p>\
				<label>Type\
					<select name="type">\
						<option value="Internship" {{if FireSpark.core.helper.equals(message.proceeding.type, "Internship")}}selected="selected"{{/if}}>Internship</option>\
						<option value="Placement" {{if FireSpark.core.helper.equals(message.proceeding.type, "Placement")}}selected="selected"{{/if}}>Placement</option>\
					</select>\
				</label>\
				<label>Eligibility\
					<input type="text" name="eligibility" class="required" value="${message.proceeding.eligibility}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Eligibility</p>\
				<label>Margin\
					<input type="text" name="margin" value="${message.proceeding.margin}" />\
				</label>\
				<label>Maximum Applications\
					<input type="text" name="max" value="${message.proceeding.max}" />\
				</label>\
				<label>Deadline\
					<input type="text" name="deadline" class="required" value="${message.proceeding.deadline}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Eligibility</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template ProceedingList
 *
**/
Executive.jquery.template.ProceedingList = $.template('\
<div id="proceeding-container">\
	{{if valid}}\
	<div id="proceeding-child-container"></div>\
	<div id="proceeding-list-container" class="panel left">\
		<p class="head">All Proceedings for ${message.srname}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#proceeding-child-container:tpl=tpl-prc-add:arg=srname~${message.srname}&comid~${message.seriesid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.events}}\
		<div class="panel">\
			<p class="subhead">${name}</p>\
			<p>\
				<a href="#tplload:cntr=#proceeding-child-container:url=core/content/view.php:arg=cntid~${home}" \
					class="navigate" >Details</a>\
				<a href="#tplload:cntr=#proceeding-child-container:tpl=tpl-sta-lst:url=launch.php:arg=service~gridevent.stage.list&eventid~${eventid}&ename~${name}" class="navigate" >Stages</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#proceeding-child-container:url=launch.php:arg=service~executive.proceeding.init&procid~${eventid}" \
					class="navigate" >Initialize</a>\
				<a href="#tplload:cntr=#proceeding-child-container:tpl=tpl-prc-edt:url=launch.php:arg=service~executive.proceeding.info&procid~${eventid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#proceeding-child-container:url=launch.php:arg=service~executive.proceeding.remove&procid~${eventid}&comid~${message.seriesid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
/**
 *	@template SelectionList
 *
**/
Executive.jquery.template.SelectionList = $.template('\
<div id="selection-container">\
	{{if valid}}\
	<div id="selection-child-container"></div>\
	<div id="selection-list-container" class="panel left">\
		<p class="head">All your Selections in Proceedings</p>\
		{{each message.selections}}\
		<div class="panel">\
			<p class="subhead">${ename} : ${stname} (Stage ${stage})</p>\
			<p>\
				<a href="#tplload:cntr=#selection-child-container:url=core/content/view.php:arg=cntid~${home}" \
					class="navigate" >Details</a>\
				<a href="#tplload:cntr=#selection-child-container:tpl=tpl-sta-lst:url=launch.php:arg=service~gridevent.stage.list&eventid~${eventid}&ename~${ename}" \
					class="navigate" >Stages</a>\
				{{if FireSpark.core.helper.equals(open & ongoing & status, 1)}}\
					<a href="#tplload:cntr=#selection-child-container:url=launch.php:arg=service~gridevent.selection.qualify&eventid~${eventid}:cf=true" \
					class="navigate" >Accept</a>\
					<a href="#tplload:cntr=#selection-child-container:url=launch.php:arg=service~executive.proceeding.reject&procid~${eventid}:cf=true" \
					class="navigate" >Reject</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
/**
 *	@template SelectionStage
 *
**/
Executive.jquery.template.SelectionStage = $.template('\
<div id="selection-stage-container">\
	{{if valid}}\
	<div id="selection-stage-child-container"></div>\
	<div id="selection-stage-list-container" class="panel left">\
		<p class="head">Selections in ${message.stname} Stage for Proceeding of ${message.ename}</p>\
		{{each message.students}}\
			<div class="panel">\
			<p class="subhead">${$index+1}. ${name}</p>\
			<p>${rollno} | ${email} | ${phone}</p>\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<p>\
				<a href="#tplload:cntr=#selection-stage-child-container:url=launch.php:arg=service~gridevent.selection.qualify&eventid~${message.eventid}&owner~${owner}:cf=true" \
					class="navigate" >Qualify</a>\
				<a href="#tplload:cntr=#selection-stage-child-container:url=launch.php:arg=service~gridevent.selection.qualify&eventid~${message.eventid}&owner~${owner}&qualify~0:cf=true" \
					class="navigate" >Disqualify</a>\
			</p>\
			{{/if}}\
			</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
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
');/**
 *	@template StageEdit
 *
**/
Executive.jquery.template.StageEdit = $.template('\
<div id="stage-edit-container" class="panel form-panel">\
	<p class="head">Edit Stage #${message.stage.stageid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._stage-edit-container">\
				<input type="hidden" name="service" value="gridevent.stage.edit">\
				<input type="hidden" name="stageid" value="${message.stage.stageid}">\
				<label>Name\
					<input type="text" name="name"  class="required" value="${message.stage.name}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Stage\
					<input type="text" name="stage" class="required" value="${message.stage.stage}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Stage</p>\
				<label>Start Time\
					<input type="text" name="start" class="required" value="${message.stage.start}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Start Time</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<label>End Time\
					<input type="text" name="end" class="required" value="${message.stage.end}"/>\
				</label>\
					<p class="error hidden margin5">Invalid End Time</p>\
					<p class="desc">Format : YYYY-MM-DD hh:mm:ss</p>\
				<label>Open\
					<input type="text" name="open" class="required" value="${message.stage.open}"/>\
				</label>\
				<label>Status\
					<input type="text" name="status" class="required" value="${message.stage.status}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Status value</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template StageList
 *
**/
Executive.jquery.template.StageList = $.template('\
<div id="stage-container">\
	{{if valid}}\
	<div id="stage-child-container"></div>\
	<div id="stage-list-container" class="panel left">\
		<p class="head">All Stages in Proceeding for ${message.ename}</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#stage-child-container:tpl=tpl-sta-add:arg=procname~${message.ename}&procid~${message.eventid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.stages}}\
		<div class="panel">\
			<p class="subhead">${name} (Stage ${stage})</p>\
			<p>\
				<a href="#tplload:cntr=#stage-child-container:tpl=tpl-sel-sta:url=launch.php:arg=service~executive.student.stage&stageid~${stageid}&eventid~${message.eventid}&ename~${message.ename}&stname~${name}" \
					class="navigate" >Selections</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#stage-child-container:tpl=tpl-sta-edt:url=launch.php:arg=service~gridevent.stage.info&stageid~${stageid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#stage-child-container:url=launch.php:arg=service~gridevent.stage.remove&stageid~${stageid}&eventid~${message.eventid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
/**
 *	@template StudentAdd
 *
**/
Executive.jquery.template.StudentAdd = $.template('\
<div id="student-add-container" class="panel form-panel">\
	<p class="head">Add Student</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._student-add-container">\
				<input type="hidden" name="service" value="executive.student.add">\
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
					<input type="text" name="year" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid Year</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template StudentBatch
 *
**/
Executive.jquery.template.StudentBatch = $.template('\
<div id="student-container">\
	{{if valid}}\
	<div id="grid-panel"></div>\
	<div id="student-menu-container" class="panel left">\
			<p class="head">All Students by Enrollment year</p>\
			{{each message.batches}}\
			<span class="bold">${year}</span>\
			<ul class="horizontal menu">\
				<li>\
					<a class="navigate" \
	href="#tplload:cntr=#grid-panel:tpl=tpl-std-lst:url=launch.php:arg=service~executive.student.list&year~${year}&course~B Tech"\
					>B Tech</a>\
				</li>\
				<li>\
					<a class="navigate" \
	href="#tplload:cntr=#grid-panel:tpl=tpl-std-lst:url=launch.php:arg=service~executive.student.list&year~${year}&course~IDD"\
					>IDD</a>\
				</li>\
			</ul>\
			{{/each}}\
	</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');

/**
 *	@template StudentEdit
 *
**/
Executive.jquery.template.StudentEdit = $.template('\
	{{if valid}}\
	<div id="file-panel"></div>\
	<div id="student-options-container" class="panel left">\
		<p class="head">{{if FireSpark.core.helper.equals(message.admin, 1)}}Student #${message.student.stuid}{{else}}Profile{{/if}} Options</p>\
		<ul class="horizontal menu">\
			<li><a href="#tplload:cntr=#file-panel:tpl=tpl-spc-edt:url=core/admin/space.php:arg=do~get&spid~${message.student.resume}" class="navigate" >Resume</a>\
			</li>\
			<li><a href="#tplload:cntr=#file-panel:tpl=tpl-spc-edt:url=core/admin/space.php:arg=do~get&spid~${message.student.photo}" class="navigate" >Photo</a>\
			</li>\
			<li><a href="#tplload:cntr=#main-container:url=core/content/view.php:arg=cntid~${message.student.home}" class="navigate" >Home Page</a>\</li>\
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
					<option value="IDD" {{if FireSpark.core.helper.equals(message.student.course, "IDD")}}selected="selected"{{/if}}>M.Tech</option>\
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
					<td rowspan="5" valign="top"><img src="core/space/read.php?spid=${stphoto}" alt="" height="100" ></td>\
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
					{{if rssize}}\
						<a href="core/space/read.php?spid=${resume}" target="_blank">\
							Resume [${ServiceClient.jquery.helper.readFileSize(rssize)}]\
						</a>\
					{{/if}}\
					{{if home}}\
						<a href="#tplload:cntr=#student-child-container:url=core/content/view.php:arg=cntid~${home}" \
							class="navigate" >Home Page</a>\
					{{/if}}\
					{{if FireSpark.core.helper.equals(message.admin, 1)}}\
						<a href="#tplload:cntr=#student-child-container:tpl=tpl-std-edt:url=launch.php:arg=service~executive.student.info&stuid~${stuid}" \
							class="navigate">Edit</a>\<a href="#tplload:cntr=#student-child-container:url=launch.php:arg=service~executive.student.remove&stuid~${stuid}:cf=true" \
							class="navigate">Remove</a>\
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
/**
 *	@template UpdateAdd
 *
**/
Executive.jquery.template.UpdateAdd = $.template('\
<div id="update-add-container" class="panel form-panel">\
	<p class="head">Add Update</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._update-add-container">\
				<input type="hidden" name="service" value="gridshare.note.add">\
				<input type="hidden" name="boardid" value="2">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template UpdateEdit
 *
**/
Executive.jquery.template.UpdateEdit = $.template('\
	{{if valid}}\
	<div id="update-edit-container" class="panel form-panel">\
		<p class="head">Edit Update #${message.note.noteid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._update-edit-container">\
				<input type="hidden" name="service" value="gridshare.note.edit">\
				<input type="hidden" name="noteid" value="${message.note.noteid}">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" value="${message.note.title}" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80">${message.note.note}</textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
/**
 *	@template UpdateList
 *
**/
Executive.jquery.template.UpdateList = $.template('\
<div id="update-container">\
	{{if valid}}\
	<div id="update-child-container"></div>\
	<div id="update-list-container" class="panel left">\
		<p class="head">Updates</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#update-child-container:tpl=tpl-upd-add" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.notes}}\
		<div class="panel">\
			<p class="subhead">${title}</p>\
			<p>${time}</p>\
			<p>{{html note}}</p>\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<p>\
			<a href="#tplload:cntr=#update-child-container:tpl=tpl-upd-edt:url=launch.php:arg=service~gridshare.note.info&noteid~${noteid}" class="navigate" >Edit</a>\
			<a href="#tplload:cntr=#update-child-container:url=launch.php:arg=service~gridshare.note.remove&noteid~${noteid}:cf=true" class="navigate" >Remove</a>\
			</p>\
			{{/if}}\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
