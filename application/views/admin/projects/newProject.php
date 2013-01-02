<script>
	var subSector = [''];
</script>
<?= form_open_multipart('admin/'.(isset($id)?'editProject':'addProject'), 'class = "confirmationRequired"') ?>
<?= form_hidden('id',(isset($id)?$id:'')) ?>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Name', 'name') ?>
	<?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Company Name', 'companyName') ?>
	<?= form_input(array('name' => 'companyName', 'id' => 'companyName', 'value' => (isset($companyName)?$companyName:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Company Address', 'companyAddress') ?>
	<?= form_input(array('name' => 'companyAddress', 'id' => 'companyAddress', 'value' => (isset($companyAddress)?$companyAddress:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Contact Person', 'contactPerson') ?>
	<?= form_input(array('name' => 'contactPerson', 'id' => 'contactPerson', 'value' => (isset($contactPerson)?$contactPerson:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Contact Email', 'contactEmail') ?>
	<?= form_input(array('name' => 'contactEmail', 'id' => 'contactEmail', 'value' => (isset($contactEmail)?$contactEmail:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom">
	<?= form_label('Contact Tel', 'contactTel') ?>
	<?= form_input(array('name' => 'contactTel', 'id' => 'contactTel', 'value' => (isset($contactTel)?$contactTel:''), 'required' => 'required')) ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop">
	<?= form_label('Sector', 'sector') ?>
	<?= form_dropdown('sector', $sectors, (isset($sector)?$sector:'1'), 'class = "combobox" id="liveSector" required="required"') ?>
	<?= form_input(array('name' => 'newSector', 'placeholder' => 'New Sector')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Sub-Sector', 'subsector') ?>
	<?php 
	$jsString = '';
	$subSectors = array();
	foreach($subsectors as $key => $thisSector) {
		$thisSector = explode(':', $thisSector); 
		$sectorCategory = $thisSector[1];
		$sectorName = $thisSector[0];
		$jsString .= '
if(subSectors["' . $sectorCategory . '"]) { 
	subSectors["' . $sectorCategory . '"] += "<option value=\'' . $key . '\'>' . $sectorName . '</option>"; 
} else {
	subSectors["' . $sectorCategory . '"] = "<option value=\'' . $key . '\'>' . $sectorName . '</option>"; 
}';
	$subSectors[$sectorCategory][$key] = $sectorName;
	}
	echo'
<script>
var subSectors = {}; ' . $jsString . ' 
</script>
';
	?>
	<?php 
		if(isset($sector)) {
			if(isset($subSectors[$sector])) {
				$subSectorList = $subSectors[$sector];
			} else {
				$subSectorList = array();
			}
		} else {
			$subSectorList = $subSectors[1];
		}
	?>
	<?= form_dropdown('subsector', $subSectorList, (isset($subsector)?$subsector:'1'), 'class = "combobox" id="liveSubsector" required="required"') ?>
	<?= form_input(array('name' => 'newSubsector', 'placeholder' => 'New Subsector')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Geographical Region', 'province') ?>
	<?= form_dropdown('province', $provinces, (isset($province)?$province:'1'), 'class = "combobox"') ?>
	<?= form_input(array('name' => 'newProvince', 'placeholder' => 'New Region')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('City', 'city') ?>
	<?= form_dropdown('city', $cities, (isset($city)?$city:'1'), 'class = "combobox"') ?>
	<?= form_input(array('name' => 'newCity', 'placeholder' => 'New City')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Discussion Date', 'discussionDate') ?>
	<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker', 'value' => (isset($discussionDate)?$discussionDate:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Status', 'status') ?>
	<?= form_dropdown('status', $status, (isset($thisStatus)?$thisStatus:'1')) ?>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Leader', 'leader') ?>
	<?= form_dropdown('leader', $leaders, (isset($leader)?$leader:'1'), 'class="projectLeader"') ?>
</div>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Members', 'projectMembers') ?>
	<?= form_multiselect('projectMembers[]', $projectMembers, (isset($selectedProjectMembers)?$selectedProjectMembers:''), 'class = "projectMembers"') ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop">
	<?= form_label('Indicative Deal Size', 'dealSize') ?>
	<?= form_input(array('name' => 'dealSize', 'id' => 'dealSize', 'value' => (isset($dealSize)?$dealSize:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Attachments', 'file') ?>
	<?= form_upload(array('name' => 'file[]', 'id' => 'file' ,'multiple' => 'multiple')) ?>
</div>
<?php
	if(isset($id)) {
?>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<table class="data" id="uploadedFiles">
		<thead>
			<th>Filename</th>
			<th>Upload Time</th>
			<th>Delete?</th>
		</thead>
		<?php 
			foreach ($attachments as $at) { 
		?>
		<tr>
			<td style="text-align: center;"><?= $at['filename'] ?></td>
			<td style="text-align: center;"><?= $at['timestamp'] ?></td>
			<td style="text-align: center;"><input type="checkbox" value="<?= $at['id'] ?>" name="deletions[]" /></td>
		</tr>

		<?php 
			}

		?>
	</table>
	<script>
	filesToDelete = '';
		$('#uploadedFiles').on('click', 'input[type="checkbox"]', function(){
			if(this.checked) {
				filesToDelete += this.value + ',';
			} else {
				filesToDelete = filesToDelete.split(this.value + ',').join('');
			}
			document.getElementById('deleteFiles').value = filesToDelete.substring(0, filesToDelete.length - 1);
			console.log(filesToDelete);
		});
	</script>
	<input id="deleteFiles" type="hidden" name"deleteFiles" value="" />
</div> 
<div class="clear"></div>
<?php } ?>
<div class="gridTwo spaceTop">
	<?= form_submit('submission','Submit') ?>
	<?= form_button('cancel','Cancel') ?>
</div>
<?= form_close() ?>
<div class="clear"></div>