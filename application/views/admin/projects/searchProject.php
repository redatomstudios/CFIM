<div class="gridOne spaceTop spaceBottom">
	<p>Select project to modify:</p>
</div>
<?= form_open('admin/editMember'); ?>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Name', 'name'); ?>
	<?= form_dropdown('name', array('ANY')); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Sector', 'sector'); ?>
	<?= form_dropdown('sector', array('ANY')); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Sub-Sector', 'subsector'); ?>
	<?= form_dropdown('subsector', array('ANY')); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Geographical Region', 'province'); ?>
	<?= form_dropdown('province', array('ANY')); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('City', 'city'); ?>
	<?= form_dropdown('city', array('ANY')); ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Discussion Date', 'discussionDate') ?>
	<?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'class' => 'datePicker')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Status', 'status'); ?>
	<?= form_dropdown('status', array('ANY')); ?>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Project Leader: ', 'leader'); ?>
	<?= form_dropdown('leader', array('ANY')); ?>
</div>
<div class="gridOne spaceTop">
	<?= form_submit('submit', 'Submit'); ?>
	<?= form_button('cancel', 'Cancel'); ?>
</div>
<?= form_close(); ?>