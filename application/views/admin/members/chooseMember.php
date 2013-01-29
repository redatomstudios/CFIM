<div class="gridOne spaceTop spaceBottom">
	<p>Select member to edit:</p>
</div>
<?= form_open('admin/editMember'); ?>
<div class="gridOne spaceTop">
	<span class="lg-en"><?= form_label('Choose Member: ', 'usernames'); ?></span>
	<span class="lg-cn"><?= form_label('&#25104;&#21592;&#21517;&#23383;: ', 'usernames'); ?></span>
	<?= form_dropdown('username', $usernames); ?>
</div>
<div class="gridOne spaceTop">
	<span class="lg-en"><input type="submit" value="Submit" /></span>
	<span class="lg-cn"><input type="submit" value="&#25552;&#20132;" /></span>
</div>
<?= form_close(); ?>
