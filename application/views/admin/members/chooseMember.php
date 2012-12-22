<div class="bodyContent">
	<div class="gridOne spaceTop spaceBottom">
		<p>Select member to edit:</p>
	</div>
	<?= form_open('admin/editMember'); ?>
	<div class="gridOne spaceTop">
		<?= form_label('Choose Member: ', 'usernames'); ?>
		<?= form_dropdown('username', $usernames); ?>
	</div>
	<div class="gridOne spaceTop">
		<?= form_submit('submit', 'Submit'); ?>
	</div>
	<?= form_close(); ?>
</div>