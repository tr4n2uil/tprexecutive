/**
 *	@template StorageAdd
 *
**/
Executive.jquery.template.StorageAdd = $.template('\
<div id="storage-add-container" class="panel form-panel">\
	<p class="head">Add ${spname}</p>\
		<form action="launch.php" method="post" class="navigate" enctype="multipart/form-data"  id="_formsubmit:sel._storage-add-container:iframe=true">\
				<input type="hidden" name="service" value="griddata.storage.add">\
				<input type="hidden" name="spaceid" value="${spaceid}">\
				<input type="hidden" name="filekey" value="storage">\
				<input type="hidden" name="filepath" value="${sppath}">\
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