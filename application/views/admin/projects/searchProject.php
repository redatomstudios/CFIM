<div class="gridOne spaceTop spaceBottom">
	<p>Select project to modify:</p>
</div>
<?= form_open('admin/editProject'); ?>
<div class="gridOne spaceTop spaceBottom">
	<span class="lg-en"><?= form_label('Project Name', 'name'); ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#20195;&#21495;', 'name'); ?></span>
	<?= form_dropdown('name', $projects); ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Sector', 'sector'); ?></span>
	<span class="lg-cn"><?= form_label('&#20027;&#35201;&#20998;&#31867;', 'sector'); ?></span>
	<?= form_dropdown('sector', $sectors, 0, 'id="liveSector"'); ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Sub-Sector', 'subsector'); ?></span>
	<span class="lg-cn"><?= form_label('&#19979;&#35774;&#20998;&#31867;', 'subsector'); ?></span>
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
	<span class="lg-en"><?= form_label('Geographical Region', 'province'); ?></span>
	<span class="lg-cn"><?= form_label('&#30465;', 'province'); ?></span>
	<?= form_dropdown('province', $provinces); ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('City', 'city'); ?></span>
	<span class="lg-cn"><?= form_label('&#22478;&#24066;', 'city'); ?></span>
	<?= form_dropdown('city', $cities); ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Discussion Date', 'discussionDate') ?></span>
	<span class="lg-cn"><?= form_label('&#35752;&#35770;&#26085;&#26399;', 'discussionDate') ?></span>
	<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'value' => '', 'class' => 'datePicker')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Status', 'status'); ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#36827;&#31243;', 'status'); ?></span>
	<?= form_dropdown('status', $status, '0'); ?>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<span class="lg-en"><?= form_label('Project Leader', 'leader'); ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#32463;&#29702;', 'leader'); ?></span>
	<?= form_dropdown('leader', $leaders); ?>
</div>
<div class="gridOne spaceTop">
	<!-- <?= form_submit('submission', 'Submit'); ?> -->
	<button type="submit">&#25552;&#20132;</button>
	<a href="<?= base_url() ?>admin"><?= form_button('cancel', '&#21462;&#28040;'); ?></a>
</div>
<?= form_close(); ?>