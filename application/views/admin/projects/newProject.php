<script>
	var subSector = [''];
</script>
<?= form_open_multipart('admin/'.(isset($id)?'editProject':'addProject'), 'class = "confirmationRequired"') ?>
<?= form_hidden('id',(isset($id)?$id:'')) ?>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Name', 'name') ?>
	<?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Company Name', 'companyName') ?>
	<?= form_input(array('name' => 'companyName', 'id' => 'companyName', 'value' => (isset($companyName)?$companyName:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Company Address', 'companyAddress') ?>
	<?= form_input(array('name' => 'companyAddress', 'id' => 'companyAddress', 'value' => (isset($cAddress)?$cAddress:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Contact Person', 'contactPerson') ?>
	<?= form_input(array('name' => 'contactPerson', 'id' => 'contactPerson', 'value' => (isset($contactPerson)?$contactPerson:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Contact Email', 'contactEmail') ?>
	<?= form_input(array('name' => 'contactEmail', 'id' => 'contactEmail', 'value' => (isset($contactEmail)?$contactEmail:''))) ?>
</div>
<div class="gridTwo spaceTop spaceBottom">
	<?= form_label('Contact Tel', 'contactTel') ?>
	<?= form_input(array('name' => 'contactTel', 'id' => 'contactTel', 'value' => (isset($contactTel)?$contactTel:''))) ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop">
	<?= form_label('Sector', 'sector') ?>
	<?= form_dropdown('sector', $sectors, (isset($sector)?$sector:'1'), 'class = "combobox", id="liveSector"') ?>
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
console.log(subSectors);
</script>
';
	?>
	<?= form_dropdown('subsector', $subSectors[(isset($sector)?$sector:'1')], (isset($subsector)?$subsector:'1'), 'class = "combobox" id="liveSubsector"') ?>
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
	<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker', 'value' => (isset($discussionDate)?$discussionDate:''))) ?>
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
	<?= form_input(array('name' => 'dealSize', 'id' => 'dealSize', 'value' => (isset($dealSize)?$dealSize:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Attachments', 'file') ?>
	<?= form_upload(array('name' => 'file[]', 'id' => 'file' ,'multiple' => 'multiple')) ?>
</div>
<?php if(isset($id)) { ?>
<div class="gridOne spaceTop spaceBottom">
	<table class="data" id="uploadedFiles">
		<tr>
			<th>Delete</th>
			<th>Filename</th>
			<th>Upload Time</th>
		</tr>
		<?php // Echo these rows for each file ?>
		<tr>
			<td><input type="checkbox" value="fileID" name="deletions[]" /></td>
			<td>Filename.jpg</td>
			<td>12:12 12/12/2012</td>
		</tr>
		<tr>
			<td><input type="checkbox" value="fileID" name="deletions[]" /></td>
			<td>Filename2.jpg</td>
			<td>12:12 12/12/2012</td>
		</tr>
	</table>
</div> 
<?php } ?>
<div class="gridTwo spaceTop">
	<?= form_submit('submission','Submit') ?>
	<?= form_button('cancel','Cancel') ?>
</div>
<?= form_close() ?>
<div class="clear"></div>