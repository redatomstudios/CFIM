<script>
	var subSector = [''];
</script>
<?= form_open_multipart('admin/'.(isset($id)?'editProject':'addProject'), 'class = "confirmationRequired"') ?>
<?= form_hidden('id',(isset($id)?$id:'')) ?>
<div class="gridOne spaceTop spaceBottom">
	<span class="lg-en"><?= form_label('Project Name', 'name') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#20195;&#21495;', 'name') ?></span>
	<?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Company Name', 'companyName') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#20844;&#21496;&#21517;&#23383;', 'companyName') ?></span>
	<?= form_input(array('name' => 'companyName', 'id' => 'companyName', 'value' => (isset($companyName)?$companyName:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Company Address', 'companyAddress') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#20844;&#21496;&#22320;&#22336;', 'companyAddress') ?></span>
	<?= form_input(array('name' => 'companyAddress', 'id' => 'companyAddress', 'value' => (isset($companyAddress)?$companyAddress:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Contact Person', 'contactPerson') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#32852;&#32476;', 'contactPerson') ?></span>
	<?= form_input(array('name' => 'contactPerson', 'id' => 'contactPerson', 'value' => (isset($contactPerson)?$contactPerson:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Contact Email', 'contactEmail') ?></span>
	<span class="lg-cn"><?= form_label('&#32852;&#32476;&#30005;&#37038;', 'contactEmail') ?></span>
	<?= form_input(array('name' => 'contactEmail', 'id' => 'contactEmail', 'value' => (isset($contactEmail)?$contactEmail:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom">
	<span class="lg-en"><?= form_label('Contact Tel', 'contactTel') ?></span>
	<span class="lg-cn"><?= form_label('&#32852;&#32476;&#30005;&#35805;', 'contactTel') ?></span>
	<?= form_input(array('name' => 'contactTel', 'id' => 'contactTel', 'value' => (isset($contactTel)?$contactTel:''))) ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Sector', 'sector') ?></span>
	<span class="lg-cn"><?= form_label('&#20027;&#35201;&#20998;&#31867;', 'sector') ?></span>
	<?= form_dropdown('sector', $sectors, (isset($sector)?$sector:'1'), 'class = "combobox" id="liveSector"') ?>
	<?= form_input(array('name' => 'newSector', 'placeholder' => 'New Sector')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Sub-Sector', 'subsector') ?></span>
	<span class="lg-cn"><?= form_label('&#19979;&#35774;&#20998;&#31867;', 'subsector') ?></span>
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
	<?= form_dropdown('subsector', $subSectorList, (isset($subsector)?$subsector:'1'), 'class = "combobox" id="liveSubsector"') ?>
	<?= form_input(array('name' => 'newSubsector', 'placeholder' => 'New Subsector')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Geographical Region', 'province') ?></span>
	<span class="lg-cn"><?= form_label('&#30465;', 'province') ?></span>
	<?= form_dropdown('province', $provinces, (isset($province)?$province:'1'), 'class = "combobox"') ?>
	<?= form_input(array('name' => 'newProvince', 'placeholder' => 'New Region')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('City', 'city') ?></span>
	<span class="lg-cn"><?= form_label('&#22478;&#24066;', 'city') ?></span>
	<?= form_dropdown('city', $cities, (isset($city)?$city:'1'), 'class = "combobox"') ?>
	<?= form_input(array('name' => 'newCity', 'placeholder' => 'New City')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Discussion Date', 'discussionDate') ?></span>
	<span class="lg-cn"><?= form_label('&#35752;&#35770;&#26085;&#26399;', 'discussionDate') ?></span>
	<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker', 'value' => (isset($discussionDate)?$discussionDate:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Status', 'status') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#36827;&#31243;', 'status') ?></span>
	<?= form_dropdown('status', $status, (isset($thisStatus)?$thisStatus:'Preliminary')) ?>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<span class="lg-en"><?= form_label('Project Leader', 'leader') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#32463;&#29702;', 'leader') ?></span>
	<?= form_dropdown('leader', $leaders, ( isset($leader) ? $leader : '1' ), 'class="projectLeader"') ?>
</div>
<div class="gridOne spaceTop spaceBottom">
	<span class="lg-en"><?= form_label('Project Members', 'projectMembers') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#25104;&#21592;', 'projectMembers') ?></span>
	<?= form_multiselect('projectMembers[]', $projectMembers, (isset($selectedProjectMembers)?$selectedProjectMembers:''), 'class = "projectMembers"') ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Indicative Deal Size', 'dealSize') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#37329;', 'dealSize') ?></span>
	<?= form_input(array('name' => 'dealSize', 'id' => 'dealSize', 'value' => (isset($dealSize)?$dealSize:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Attachments', 'file') ?></span>
	<span class="lg-cn"><?= form_label('&#38468;&#20214;', 'file') ?></span>
	<?= form_upload(array('name' => 'file[]', 'id' => 'file' ,'multiple' => 'multiple')) ?>
</div>
<?php
	if(isset($id)) {
?>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<table class="data" id="uploadedFiles">
		<thead>
			<th>
				<span class="lg-en">Filename</span>
				<span class="lg-cn">&#26723;&#26696;&#21517;&#31216;</span>
			</th>
			<th>
				<span class="lg-en">Upload Time</span>
				<span class="lg-cn"></span>
			</th>
			<th>
				<span class="lg-en">Delete?</span>
				<span class="lg-cn">&#21024;&#38500;?</span>
			</th>
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
		});
	</script>
	<input id="deleteFiles" type="hidden" name"deleteFiles" value="" />
</div> 
<div class="clear"></div>
<?php } ?>
<div class="gridTwo spaceTop">
	<span class="lg-en">
		<button type="submit">Submit</button>
		<?php	if(isset($id)) { ?>
				<a href="<?= base_url() ?>admin/editProject"><?= form_button('cancel','Cancel') ?></a>
		<?php	} else { ?>
				<a href="<?= base_url() ?>admin"><?= form_button('cancel','Cancel') ?></a>
		<?php	} ?>
	</span>
	<span class="lg-cn">
		<button type="submit">&#25552;&#20132;</button>
		<?php	if(isset($id)) { ?>
				<a href="<?= base_url() ?>admin/editProject"><button type="button">&#21462;&#28040;</button></a>
		<?php	} else { ?>
				<a href="<?= base_url() ?>admin"><button type="button">&#21462;&#28040;</button></a>
		<?php	} ?>
	</span>
</div>
<?= form_close() ?>
<div class="clear"></div>