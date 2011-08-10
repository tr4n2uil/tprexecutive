/**
 *	@template StorageEdit
 *
**/
Executive.jquery.template.StorageEdit = $.template('\
<div id="storage-edit-container" class="panel form-panel">\
	<p class="head">Edit ${spname}</p>\
		<form action="launch.php" method="post" class="navigate" enctype="multipart/form-data"  id="_formsubmit:sel._storage-edit-container:iframe=true">\
				<input type="hidden" name="service" value="griddata.storage.write">\
				<input type="hidden" name="filekey" value="storage">\
				<input type="hidden" name="stgid" value="${stgid}">\
				<label>File\
					<input type="file" name="storage" class="required"/>\
				</label>\
					<p class="error hidden margin5">Invalid File</p>\
				<input name="submit" type="submit" value="Submit"  class="margin5"/>\
				<input name="reset" type="reset" value="Reset"  class="margin5"/>\
				<div class="status"></div>\
		</form>\
	</div>\
');