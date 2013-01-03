<div class="gridOne spaceTop spaceBottom">
	<p>Select project to modify:</p>
</div>
<?= form_open('admin/editProject'); ?>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Name', 'name'); ?>
	<?= form_dropdown('name', $projects); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Sector', 'sector'); ?>
	<?= form_dropdown('sector', $sectors, 0, 'id="liveSector"'); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Sub-Sector', 'subsector'); ?>
	<?php 
	$jsString = '';
	$subSectors = array();
	foreach($subsectors as $key => $thisSector) {
		$thisSector = explode(':', $thisSector); 
		if(sizeof($thisSector) == 2) {
			$sectorCategory = $thisSector[1];
			$sectorName = $thisSector[0];
			$jsString .= '
if(subSectors["' . $sectorCategory . '"]) { 
	subSectors["' . $sectorCategory . '"] += "<option value=\'' . $key . '\'>' . $sectorName . '</option>"; 
} else {
	subSectors["' . $sectorCategory . '"] = "<option value=\'0\'>ANY</option>";
	subSectors["' . $sectorCategory . '"] += "<option value=\'' . $key . '\'>' . $sectorName . '</option>"; 
}';
		$subSectors[$sectorCategory][0] = 'ANY';
		$subSectors[$sectorCategory][$key] = $sectorName;
		}
	}
	$subSectors[0][0] = 'ANY';
	echo'
<script>
var subSectors = {}; ' . $jsString . ' 
</script>
';
	?>
	<?= form_dropdown('subsector', $subSectors[0], 0, 'id="liveSubsector"'); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Geographical Region', 'province'); ?>
	<?= form_dropdown('province', $provinces); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('City', 'city'); ?>
	<?= form_dropdown('city', $cities); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Discussion Date', 'discussionDate') ?>
	<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'value' => '', 'class' => 'datePicker')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Status', 'status'); ?>
	<?= form_dropdown('status', $status, '0'); ?>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Leader: ', 'leader'); ?>
	<?= form_dropdown('leader', $leaders); ?>
</div>
<div class="gridOne spaceTop">
	<?= form_submit('submission', 'Submit'); ?>
	<?= form_button('cancel', 'Cancel'); ?>
</div>
<?= form_close(); ?>