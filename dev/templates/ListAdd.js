/**
 *	@template ListAdd
 *
**/
Executive.jquery.template.ListAdd = $.template('\
<div id="list-add-container" class="panel form-panel">\
	<p class="head">Add List in ${ctlgname} Catalogue</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._list-add-container">\
				<input type="hidden" name="service" value="gridcontrol.list.add">\
				<input type="hidden" name="ctlgid" value="${ctlgid}">\
				<input type="hidden" name="addcode" value="${addcode}">\
				<label>Name\
					<input type="text" name="listname" class="required" size="50" />\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
					<label>Code\
					<select name="code">\
						{{each FireSpark.core.helper.dataSplit(addcode)}}\
						<option value="${$value}" >${$value}</option>\
						{{/each}}\
					</select>\
				</label>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
