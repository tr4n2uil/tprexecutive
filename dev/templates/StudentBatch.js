/**
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

