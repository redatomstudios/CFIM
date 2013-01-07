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
	<?= form_input(array('name' => 'fromDate', 'class' => 'datePicker')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Project Member', 'member') ?>
	<?= form_dropdown('member', $projectMembers) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('To', 'toDate') ?>
	<?= form_input(array('name' => 'toDate', 'class' => 'datePicker')) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Sector', 'sector') ?>
	<?= form_dropdown('sector', $sectors) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Sub Sector', 'subsector') ?>
	<?= form_dropdown('subsector', $subsectors) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Region', 'province') ?>
	<?= form_dropdown('province', $provinces) ?>
</div>
<div class="gridOne spaceTop">
	<?= form_label('Status', 'status') ?>
	<?= form_dropdown('status', $status) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_submit('submission','Start Search') ?>
	<?= form_button('cancel','Cancel') ?>
</div>
<?= form_close() ?>
<div class="clear"></div>