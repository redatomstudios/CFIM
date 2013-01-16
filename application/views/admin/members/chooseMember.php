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
	<span class="lg-en"><button type="submit">Submit</button></span>
	<span class="lg-cn"><button type="submit">&#25552;&#20132;</button></span>
</div>
<?= form_close(); ?>
