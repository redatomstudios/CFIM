<script>
	var subSector = [''];
</script>
<?= form_open_multipart('/admin/statistics') ?>
<div class="gridTwo spaceTop">
	<?= form_label('Project Leader', 'leader') ?>
	<?= form_dropdown('leader', $leaders) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('From', 'fromDate') ?>
	<?= form_input(array('name' => 'fromDate', 'class' => 'datePicker extended')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Project Member', 'member') ?>
	<?= form_dropdown('member', $projectMembers) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('To', 'toDate') ?>
	<?= form_input(array('name' => 'toDate', 'class' => 'datePicker extended')) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Sector', 'sector') ?>
	<?= form_dropdown('sector', $sectors) ?>
</div>
<div class="gridOne spaceTop">
	<?php
	/*
	 * Subsectors, by default, come with colons and their sector IDs
	 * so we need to remove the colon and the sector IDs, don't need them
	 * here since live update of subsectors based on selected sector isn't
	 * being used here.
	 */
	foreach($subsectors as $index => $thisSubsector) {
		$splitName = explode(':', $thisSubsector);

		/*
		 * The sector name itself might have a colon in it
		 * so let's just remove the last exploded element, since
		 * this should just leave the sector name, even if the
		 * sector name has colons in it.
		 */
		if(isset($splitName[0]) && sizeof($splitName) > 1) {
			array_pop($splitName); // Remove the last element
			$subsectors[$index] = implode('', $splitName); // Store the imploded remaining array as a subsector
		}
	}
	?>
	<?= form_label('Sub Sector', 'subsector') ?>
	<?= form_dropdown('subsector', $subsectors) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Region', 'province') ?>
	<?= form_dropdown('province', $provinces) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Status', 'status') ?>
	<?= form_dropdown('status', $status, '0') ?>
</div>
<div class="gridOne spaceTop">
	<?= form_submit('submission','Start Search') ?>
	<a href="<?= base_url() ?>admin/"><?= form_button('cancel','Cancel') ?></a>
</div>
<?= form_close() ?>
<div class="clear"></div>