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
