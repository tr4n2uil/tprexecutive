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
					<td rowspan="4" valign="top"><img src="launch.php?request=get&service=griddata.storage.read&stgid=${photo}" alt="" height="100" ></td>\
					<td class="bold subhead">${name}</td>\
				</tr>\
				<tr><td><a href="${site}" target="_blank">${site}</a></td></tr>\
				<tr><td class="italic"><span>Interests :</span> ${interests}</td></tr>\
				<tr><td>\
				<a href="#tplload:cntr=#company-child-container:tpl=tpl-prc-lst:url=launch.php:arg=service~gridevent.event.list&seriesid~${comid}&srname~${name}" \
					class="navigate" >Proceedings</a>\
				{{if FireSpark.core.helper.equals(message.admin, 1)}}\
				<a href="#tplbind:cntr=#company-child-container:tpl=tpl-stg-edt:arg=spname~Photo&stgid~${photo}" class="navigate" >Photo</a>\
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
