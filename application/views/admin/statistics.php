<script>
	var subSector = [''];
</script>
<?= form_open_multipart('/admin/statistics') ?>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Project Leader', 'leader') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#32463;&#29702;', 'leader') ?></span>
	<?= form_dropdown('leader', $leaders) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('From', 'fromDate') ?></span>
	<span class="lg-cn"><?= form_label('&#30001;', 'fromDate') ?></span>
	<?= form_input(array('name' => 'fromDate', 'class' => 'datePicker extended')) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('Project Member', 'member') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#25104;&#21592;', 'member') ?></span>
	<?= form_dropdown('member', $projectMembers) ?>
</div>
<div class="gridTwo spaceTop">
	<span class="lg-en"><?= form_label('To', 'toDate') ?></span>
	<span class="lg-cn"><?= form_label('&#33267;', 'toDate') ?></span>
	<?= form_input(array('name' => 'toDate', 'class' => 'datePicker extended')) ?>
</div>
<div class="gridOne spaceTop">
	<span class="lg-en"><?= form_label('Sector', 'sector') ?></span>
	<span class="lg-cn"><?= form_label('&#20027;&#35201;&#20998;&#31867;', 'sector') ?></span>
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
	<span class="lg-en"><?= form_label('Sub Sector', 'subsector') ?></span>
	<span class="lg-cn"><?= form_label('&#19979;&#35774;&#20998;&#31867;', 'subsector') ?></span>
	<?= form_dropdown('subsector', $subsectors) ?>
</div>
<div class="gridOne spaceTop">
	<span class="lg-en"><?= form_label('Region', 'province') ?></span>
	<span class="lg-cn"><?= form_label('&#30465;', 'province') ?></span>
	<?= form_dropdown('province', $provinces) ?>
</div>
<div class="gridOne spaceTop">
	<span class="lg-en"><?= form_label('Status', 'status') ?></span>
	<span class="lg-cn"><?= form_label('&#39033;&#30446;&#36827;&#31243;', 'status') ?></span>
	<?= form_dropdown('status', $status, '0') ?>
</div>
<div class="gridOne spaceTop">
	<!-- <?= form_submit('submission','Start Search') ?> -->
	<button type="submit">&#25552;&#20132;</button>
	<a href="<?= base_url() ?>admin/">
		<span class="lg-en"><?= form_button('cancel','Cancel') ?></span>
		<span class="lg-cn"><?= form_button('cancel','&#21462;&#28040;') ?></span>
	</a>
</div>
<?= form_close() ?>
<div class="clear"></div>