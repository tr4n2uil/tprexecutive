/**
 *	@template BatchAdd
 *
**/
Executive.jquery.template.BatchAdd = $.template('\
<div id="batch-add-container" class="panel form-panel">\
	<p class="head">Add Batch to ${deptname} Department</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._batch-add-container">\
				<input type="hidden" name="service" value="executive.batch.add">\
				<input type="hidden" name="deptid" value="${deptid}">\
				<label>Name\
					<input type="text" name="btname" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
					<p class="desc">Batch Enrollment year suggested as name eg. 2008</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
/**
 *	@template BatchEdit
 *
**/
Executive.jquery.template.BatchEdit = $.template('\
<div id="batch-edit-container" class="panel form-panel">\
	<p class="head">Edit Batch #${batchid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._batch-edit-container">\
				<input type="hidden" name="service" value="executive.batch.edit">\
				<input type="hidden" name="batchid" value="${batchid}">\
				<label>Name\
					<input type="text" name="btname" class="required" size="50" value="${btname}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
					<p class="desc">Batch Enrollment year suggested as name eg. 2008</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
/**
 *	@template BatchList
 *
**/
Executive.jquery.template.BatchList = $.template('\
<div id="batch-container">\
	{{if valid}}\
	<div id="batch-child-container"></div>\
	<div id="batch-list-container" class="panel left">\
		<p class="head">Batches in ${message.deptname} Department</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p>\
		<a href="#tplbind:cntr=#batch-child-container:tpl=tpl-bth-add:arg=deptname~${message.deptname}&deptid~${message.deptid}" class="navigate" >Add New ...</a>\
		<a href="#tplload:cntr=#batch-child-container:tpl=tpl-spc-lst:url=launch.php:arg=service~griddata.space.list&cntrid~${message.deptid}&cntrname~${message.deptname}" class="navigate" >Spaces</a>\
		</p>\
		{{/if}}\
		{{each message.batches}}\
		<div class="panel">\
			<p class="subhead">${btname}</p>\
			<p>\
				<a href="#tplload:cntr=#batch-child-container:tpl=tpl-std-lst:url=launch.php:arg=service~executive.student.list&batchid~${batchid}&btname~${btname}&course~B Tech" class="navigate" >Students B Tech</a>\
				<a href="#tplload:cntr=#batch-child-container:tpl=tpl-std-lst:url=launch.php:arg=service~executive.student.list&batchid~${batchid}&btname~${btname}&course~IDD" class="navigate" >Students IDD</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplbind:cntr=#batch-child-container:tpl=tpl-bth-edt:arg=btname~${btname}&deptname~${message.deptname}&batchid~${batchid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#batch-child-container:url=launch.php:arg=service~executive.batch.remove&deptid~${message.deptid}&batchid~${batchid}:cf=true" class="navigate" >Remove</a>\
				<a href="#tplload:cntr=#batch-child-container:tpl=tpl-rsc-lst:url=launch.php:arg=service~gridview.resource.list&siteid~${batchid}&stname~${btname}" class="navigate" >Resources</a>\
				<a href="#tplload:cntr=#batch-child-container:tpl=tpl-cnt-lst:url=launch.php:arg=service~gridview.content.list&siteid~${batchid}&stname~${btname}" class="navigate" >Contents</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
/**
 *	@template CompanyAdd
 *
**/
Executive.jquery.template.CompanyAdd = $.template('\
<div id="company-add-container" class="panel form-panel">\
	<p class="head">Add Company</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._company-add-container">\
				<input type="hidden" name="service" value="executive.company.add">\
				<input type="hidden" name="indid" value="${indid}">\
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
	<div id="file-panel"></div>\
	<div id="company-options-container" class="panel left">\
		<p class="head">{{if FireSpark.core.helper.equals(message.admin, 1)}}Company #${message.company.comid}{{else}}Profile{{/if}} Edit Options</p>\
		<ul class="horizontal menu">\
			<li><a href="#tplbind:cntr=#file-panel:tpl=tpl-stg-edt:arg=spname~Photo&stgid~${message.company.photo}&spaceid~${message.indphoto}" class="navigate" >Photo</a>\
			</li>\
		</ul>\
	</div>\
	<div id="company-edit-container" class="panel form-panel">\
	<p class="head">{{if FireSpark.core.helper.equals(message.admin, 1)}}Edit Company #${message.company.comid}{{else}}Edit Profile{{/if}}</p>\
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
		<p>\
		<a href="#tplbind:cntr=#company-child-container:tpl=tpl-com-add:arg=indid~${message.indid}&indname~${message.indname}" class="navigate" >Add New ...</a>\
		</p>\
		{{/if}}\
		{{each message.companies}}\
		<div class="panel">\
		<table class="margin5">\
			<tbody>\
				<tr>\
					<td rowspan="4" valign="top"><img src="launch.php?request=get&service=griddata.storage.read&stgid=${photo}&spaceid=0" alt="" width="250" ></td>\
					<td class="bold subhead">${name}</td>\
				</tr>\
				<tr><td><a href="${site}" target="_blank">${site}</a></td></tr>\
				<tr><td class="italic"><span>Interests :</span> ${interests}</td></tr>\
				<tr><td>\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-prc-lst:url=launch.php:arg=service~gridevent.event.list&seriesid~${comid}&srname~${name}" \
					class="navigate" >Proceedings</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplbind:cntr=#company-child-container:tpl=tpl-stg-edt:arg=spname~Photo&stgid~${photo}&spaceid~0" class="navigate" >Photo</a>\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-com-edt:url=launch.php:arg=service~executive.company.info&comid~${comid}&indid~${message.indid}&indname~${message.indname}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#company-child-container:url=launch.php:arg=service~executive.company.remove&comid~${comid}&indid~${message.indid}&indname~${message.indname}:cf=true" class="navigate" >Remove</a>\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-rsc-lst:url=launch.php:arg=service~gridview.resource.list&siteid~${comid}&stname~${name}" class="navigate" >Resources</a>\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-cnt-lst:url=launch.php:arg=service~gridview.content.list&siteid~${comid}&stname~${name}" class="navigate" >Contents</a>\
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
/**
 *	@template ContentEdit
 *
**/
Executive.jquery.template.ContentEdit = $.template('\
	{{if valid}}\
	<div id="content-edit-container" class="panel form-panel">\
		<p class="head">Edit Content #${message.content.cntid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._content-edit-container">\
				<input type="hidden" name="service" value="gridview.content.{{if FireSpark.core.helper.equals(message.admin, 1)}}edit{{else}}update{{/if}}">\
				<input type="hidden" name="cntid" value="${message.content.cntid}">\
				<input type="hidden" name="siteid" value="${message.siteid}">\
				<label>Name\
					<input type="text" name="cntname" size="50" disabled="disabled" value="${message.content.cntname}" />\
				</label>\
				<label>Style Type\
					<select name="cntstype" {{if FireSpark.core.helper.equals(message.admin, 1)}} {{else}}disabled="disabled"{{/if}}>\
						<option value="1" {{if FireSpark.core.helper.equals(message.content.cntstype, 1)}}selected="selected"{{/if}}>Inline</option>\
						<option value="2" {{if FireSpark.core.helper.equals(message.content.cntstype, 2)}}selected="selected"{{/if}}>Resource</option>\
					</select>\
				</label>\
				<label>Style</label>\
				<textarea name="cntstyle" rows="15">${message.content.cntstyle}</textarea>\
				<label>Template Type\
					<select name="cntttype" {{if FireSpark.core.helper.equals(message.admin, 1)}} {{else}}disabled="disabled"{{/if}}>\
						<option value="1" {{if FireSpark.core.helper.equals(message.content.cntttype, 1)}}selected="selected"{{/if}}>Inline</option>\
						<option value="2" {{if FireSpark.core.helper.equals(message.content.cntttype, 2)}}selected="selected"{{/if}}>Resource</option>\
					</select>\
				</label>\
				<label>Template</label>\
				<textarea name="cnttpl" rows="15">${message.content.cnttpl}</textarea>\
				<label>Data Type\
					<select name="cntdtype" {{if FireSpark.core.helper.equals(message.admin, 1)}} {{else}}disabled="disabled"{{/if}}>\
						<option value="1" {{if FireSpark.core.helper.equals(message.content.cntdtype, 1)}}selected="selected"{{/if}}>Inline</option>\
						<option value="2" {{if FireSpark.core.helper.equals(message.content.cntdtype, 2)}}selected="selected"{{/if}}>Resource</option>\
						<option value="3" {{if FireSpark.core.helper.equals(message.content.cntdtype, 3)}}selected="selected"{{/if}}>Query</option>\
					</select>\
				</label>\
				<label>Data</label>\
				<textarea name="cntdata" rows="15">${message.content.cntdata}</textarea>\
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
 *	@template ContentList
 *
**/
Executive.jquery.template.ContentList = $.template('\
<div id="content-container">\
	{{if valid}}\
	<div id="content-child-container"></div>\
	<div id="content-list-container" class="panel left">\
		<p class="head">Contents in ${message.stname} Site</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#content-child-container:tpl=tpl-cnt-add:arg=stname~${message.stname}&siteid~${message.siteid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.contents}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${cntname}</p>\
			<p>\
				<a href="#tplload:cntr=#content-child-container:key=template:url=launch.php:arg=service~gridview.content.view&stname~${message.stname}&cntid~${cntid}" class="navigate" >View</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#content-child-container:tpl=tpl-cnt-edt:url=launch.php:arg=service~gridview.content.info&stname~${message.stname}&cntid~${cntid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#content-child-container:url=launch.php:arg=service~gridview.content.remove&cntid~${cntid}&siteid~${message.siteid}:cf=true" class="navigate" >Remove</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
/**
 *	@template NoteAdd
 *
**/
Executive.jquery.template.NoteAdd = $.template('\
<div id="note-add-container" class="panel form-panel">\
	<p class="head">Add Note in ${bname} Board</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._note-add-container">\
				<input type="hidden" name="service" value="gridshare.note.add">\
				<input type="hidden" name="boardid" value="${boardid}">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80" class="editor"></textarea>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template NoteEdit
 *
**/
Executive.jquery.template.NoteEdit = $.template('\
	{{if valid}}\
	<div id="note-edit-container" class="panel form-panel">\
		<p class="head">Edit Note #${message.note.noteid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._note-edit-container">\
				<input type="hidden" name="service" value="gridshare.note.edit">\
				<input type="hidden" name="noteid" value="${message.note.noteid}">\
				<label>Title\
					<input type="text" name="title" class="required" size="50" value="${message.note.title}" />\
				</label>\
					<p class="error hidden margin5">Invalid Title</p>\
				<label>Message</label>\
				<textarea name="note" rows="5" cols="80" class="editor">${message.note.note}</textarea>\
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
 *	@template NoteInfo
 *
**/
Executive.jquery.template.NoteInfo = $.template('\
	{{if valid}}\
	<div id="note-info-container" class="panel left">\
		<p class="head">${message.note.title}</p>\
		<p>${message.note.time}</p>\
		<div class="panel">\
			<p>{{html message.note.note}}</p>\
		</div>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p>\
		<a href="#tplload:cntr=#note-child-container:tpl=tpl-nte-edt:url=launch.php:arg=service~gridshare.note.info&noteid~${message.note.noteid}&bname~${message.bname}" class="navigate" >Edit</a>\
		<a href="#tplload:cntr=#note-child-container:url=launch.php:arg=service~gridshare.note.remove&noteid~${message.note.noteid}&boardid~${message.boardid}:cf=true" class="navigate" >Remove</a>\
		</p>\
		{{/if}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
');
/**
 *	@template NoteList
 *
**/
Executive.jquery.template.NoteList = $.template('\
<div id="note-container">\
	{{if valid}}\
	<div id="note-child-container" class="editor"></div>\
	<div id="note-list-container" class="panel left">\
		<p class="head">Notes in ${message.bname} Board</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#note-child-container:tpl=tpl-nte-add:arg=bname~${message.bname}&boardid~${message.boardid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.notes}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${title}</p>\
			<p>\
				<a href="#tplload:cntr=#note-child-container:tpl=tpl-nte-inf:url=launch.php:arg=service~gridshare.note.info&noteid~${noteid}&bname~${message.bname}&boardid~${message.boardid}" class="navigate" >View</a>\ (Last Updated on ${time})\
			</p>\
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
				<a href="#tplload:cntr=#proceeding-child-container:key=template:url=launch.php:arg=service~gridview.content.view&cntid~${home}" class="navigate" >Details</a>\
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
/**
 *	@template ResourceList
 *
**/
Executive.jquery.template.ResourceList = $.template('\
<div id="resource-container">\
	{{if valid}}\
	<div id="resource-child-container"></div>\
	<div id="resource-list-container" class="panel left">\
		<p class="head">Resources in ${message.stname} Site</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#resource-child-container:tpl=tpl-rsc-add:arg=stname~${message.stname}&siteid~${message.siteid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.resources}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${rsrcname}</p>\
			{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<p>\
				<a href="#tplload:cntr=#resource-child-container:tpl=tpl-rsc-edt:url=launch.php:arg=service~gridview.resource.info&stname~${message.stname}&rsrcid~${rsrcid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#resource-child-container:url=launch.php:arg=service~gridview.resource.remove&rsrcid~${rsrcid}&siteid~${message.siteid}:cf=true" class="navigate" >Remove</a>\
			</p>\
			{{/if}}\
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
				<a href="#tplload:cntr=#selection-child-container:key=template:url=launch.php:arg=service~gridview.content.view&cntid~${home}" class="navigate" >Details</a>\
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
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<div class="form-panel">\
				<p>CSV Export\
					<textarea name="note" rows="5" cols="80">${message.csv}</textarea>\
				</p>\
			</div>\
		{{/if}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
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
');/**
 *	@template SpaceEdit
 *
**/
Executive.jquery.template.SpaceEdit = $.template('\
<div id="space-edit-container" class="panel form-panel">\
	<p class="head">Edit Space #${message.spaceid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._space-edit-container">\
				<input type="hidden" name="service" value="griddata.space.edit">\
				<input type="hidden" name="spaceid" value="${message.spaceid}">\
				<label>Name\
					<input type="text" name="spname" class="required" size="50"  value="${message.spname}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
				<label>Path\
					<input type="text" name="sppath" class="required" size="85" value="${message.sppath}" />\
				</label>\
					<p class="error hidden margin5">Invalid Path</p>\
					<p class="desc">Must end in / eg. "storage/test/"</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template SpaceList
 *
**/
Executive.jquery.template.SpaceList = $.template('\
<div id="space-container">\
	{{if valid}}\
	<div id="space-child-container"></div>\
	<div id="space-list-container" class="panel left">\
		<p class="head">Spaces in ${message.cntrname} Container</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#space-child-container:tpl=tpl-spc-add:arg=cntrname~${message.cntrname}&cntrid~${message.cntrid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.spaces}}\
		<div class="panel">\
			<p class="subhead">${spname}</p>\
			<p>\
				<a href="#tplload:cntr=#space-child-container:tpl=tpl-stg-lst:url=launch.php:arg=service~griddata.storage.list&spaceid~${spaceid}&spname~${spname}" class="navigate" >List</a>\
				<a href="launch.php?request=get&service=griddata.space.archive&spaceid=${spaceid}&asname=${spname}.zip" target="_blank">Archive</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplload:cntr=#space-child-container:tpl=tpl-spc-edt:url=launch.php:arg=service~griddata.space.info&cntrname~${message.cntrname}&spaceid~${spaceid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#space-child-container:url=launch.php:arg=service~griddata.space.remove&cntrid~${message.cntrid}&spaceid~${spaceid}:cf=true" class="navigate" >Remove</a> (Ensure empty before removing)\
				{{/if}}\
			</p>\
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
				<input type="hidden" name="level" value="3">\
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
 *	@template StorageAdd
 *
**/
Executive.jquery.template.StorageAdd = $.template('\
<div id="storage-add-container" class="panel form-panel">\
	<p class="head">Add Storage in ${spname} Space</p>\
		<form action="launch.php" method="post" class="navigate" enctype="multipart/form-data"  id="_formsubmit:sel._storage-add-container:iframe=true">\
				<input type="hidden" name="service" value="griddata.storage.add">\
				<input type="hidden" name="spaceid" value="${spaceid}">\
				<input type="hidden" name="filekey" value="storage">\
				<input type="hidden" name="filepath" value="${sppath}">\
				<label>File\
					<input type="file" name="storage" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid File</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template StorageEdit
 *
**/
Executive.jquery.template.StorageEdit = $.template('\
<div id="storage-edit-container" class="panel form-panel">\
	<p class="head">Edit Storage #${stgid}</p>\
		<form action="launch.php" method="post" class="navigate" enctype="multipart/form-data"  id="_formsubmit:sel._storage-edit-container:iframe=true">\
				<input type="hidden" name="service" value="griddata.storage.write">\
				<input type="hidden" name="filekey" value="storage">\
				<input type="hidden" name="stgid" value="${stgid}">\
				<input type="hidden" name="spaceid" value="${spaceid}">\
				<label>File\
					<input type="file" name="storage" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid File</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');/**
 *	@template StorageList
 *
**/
Executive.jquery.template.StorageList = $.template('\
<div id="storage-container">\
	{{if valid}}\
	<div id="storage-child-container"></div>\
	<div id="storage-list-container" class="panel left">\
		<p class="head">Storages in ${message.spname} Space</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
		<p><a href="#tplbind:cntr=#storage-child-container:tpl=tpl-stg-add:arg=spname~${message.spname}&spaceid~${message.spaceid}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.storages}}\
		<div class="panel">\
			<p class="subhead">${$index+1}. ${stgname}</p>\
			<p>\
				<a href="launch.php?request=get&service=griddata.storage.read&stgid=${stgid}" target="_blank">Download</a>\ (${FireSpark.core.helper.readFileSize(size)})\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplbind:cntr=#storage-child-container:tpl=tpl-stg-edt:arg=spname~${message.spname}&stgid~${stgid}&spaceid~${message.spaceid}" class="navigate" >Edit</a>\
				<a href="#tplload:cntr=#storage-child-container:url=launch.php:arg=service~griddata.storage.remove&stgid~${stgid}&spaceid~${message.spaceid}:cf=true" class="navigate" >Remove</a>\
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
');/**
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
/**
 *	@template StudentList
 *
**/
Executive.jquery.template.StudentList = $.template('\
<div id="student-container">\
	{{if valid}}\
	<div id="student-child-container"></div>\
	<div id="student-list-container" class="panel left">\
		<p class="head">All ${message.course} Students in ${message.btname} Batch</p>\
		{{if FireSpark.core.helper.equals(message.admin, 1)}}\
			<p><a href="#tplbind:cntr=#student-child-container:tpl=tpl-std-add:arg=batchid~${message.batchid}&btname~${message.btname}" class="navigate" >Add New ...</a></p>\
		{{/if}}\
		{{each message.students}}\
		<div class="panel">\
		<table class="margin5 full">\
			<tbody>\
				<tr>\
					<td rowspan="5" valign="top"><img src="launch.php?request=get&service=griddata.storage.read&stgid=${photo}&spaceid=${message.btphoto}" alt="" height="100" ></td>\
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
					<a href="launch.php?request=get&service=griddata.storage.read&stgid=${resume}&spaceid=${message.btresume}" target="_blank">Resume</a>\
					<a href="#tplload:cntr=#student-child-container:key=template:url=launch.php:arg=service~gridview.content.view&cntid~${home}" class="navigate" >Home Page</a>\
					{{if FireSpark.core.helper.equals(message.admin, 1)}}\
					<a href="#tplload:cntr=#student-child-container:tpl=tpl-std-edt:url=launch.php:arg=service~executive.student.info&stuid~${stuid}&batchid~${message.batchid}&btname~${message.btname}" class="navigate">Edit</a>\
					<a href="#tplload:cntr=#student-child-container:url=launch.php:arg=service~executive.student.remove&stuid~${stuid}&batchid~${message.batchid}:cf=true" class="navigate">Remove</a>\
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
