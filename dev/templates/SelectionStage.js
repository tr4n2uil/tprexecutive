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
