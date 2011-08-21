/**
 *	@template ListEdit
 *
**/
Executive.jquery.template.ListEdit = $.template('\
<div id="list-edit-container" class="panel form-panel">\
	<p class="head">Edit List #${message.list.listid}</p>\
		<form action="launch.php" method="post" class="navigate" id="_formsubmit:sel._list-edit-container">\
				<input type="hidden" name="service" value="gridcontrol.list.edit">\
				<input type="hidden" name="listid" value="${message.list.listid}">\
				<label>Name\
					<input type="text" name="listname" class="required" size="50" value="${message.list.listname}"/>\
				</label>\
					<p class="error hidden margin5">Invalid Name</p>\
					<label>Code\
					<select name="code">\
						{{each FireSpark.core.helper.dataSplit(message.list.addcode)}}\
						<option value="${$value}" {{if FireSpark.core.helper.equals(message.list.code, $value)}}selected="selected"{{/if}}>${$value}</option>\
						{{/each}}\
					</select>\
				</label>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');
