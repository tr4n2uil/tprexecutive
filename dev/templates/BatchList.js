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
		<p><a href="#tplbind:cntr=#batch-child-container:tpl=tpl-bth-add:arg=deptname~${message.deptname}&deptid~${message.deptid}" class="navigate" >Add New ...</a></p>\
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
				<a href="launch.php?request=get&service=griddata.space.archive&spaceid=${resume}&asname=${btname}.zip" target="_blank">Resumes</a>\
				{{/if}}\
			</p>\
		</div>\
		{{/each}}\
	{{else}}\
	<p class="error">${msg}</p>\
	{{/if}}\
</div>');
