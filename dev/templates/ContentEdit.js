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
