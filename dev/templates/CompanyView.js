/**
 *	@template CompanyView
 *
**/
Executive.jquery.template.CompanyView = $.template('\
<div id="courses-view-container" class="panel left"><fieldset>\
		<legend class="head">All Courses</legend>\
		{{each courses}}\
		<table class="margin5">\
			<tbody>\
				<tr>\<td class="bold">${crsid}</td></tr>\
				<tr><td class="bold">${crsname}</td></tr>\
				<tr><td>${crsdescription}</td></tr>\
				<tr><td>${IITBHUCSE.jquery.helper.getPart(crspart)}</td></tr>\
				</tr>\
				<tr><td>\
					{{if crshome}}\
						<a href="#tplload:cntr=#main-container:url=core/content/view.php:arg=cntid~${crshome}" \
						class="navigate" >Home Page</a>\
					{{/if}}\
				</td></tr>\
			</tbody>\
		</table>\
		{{/each}}\
	</fieldset>\
</div>');

/**
 *	@helper getCourse
 *
**/
Executive.jquery.helper.getStage = function(index){
	switch(index){
		case '1' :
			return 'Willingness';
		case '' :
			return 'CV Submission';
		case '3' :
			return 'Part III';
		case '4' :
			return 'Part IV';
		case '5' :
			return 'Part V';
		default :
			return 'Unknown';
	}
}
