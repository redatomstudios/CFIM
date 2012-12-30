<?= form_open('member/changePassword') ?>

<div class="gridOne spaceTop spaceBottom small">
	<label>Old Password:</label> <?= form_password(array('name' => 'oldPassword', 'id' => 'oldPW')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom small">
	<label>New Password:</label> <?= form_password(array('name' => 'newPassword', 'id' => 'newPW')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom small">
	<label>Confirm Password:</label> <?= form_password(array('name' => 'confirmPassword', 'id' => 'confirmPW')) ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop spaceBottom small">
	<?= form_submit('submission', 'Submit') ?>
</div>

<?= form_close() ?>

<script>
	jQuery(document).ready(function(){
		$('form').submit(function(e){
			var pw1 = document.getElementById('newPW').value,
				pw2 = document.getElementById('confirmPW').value;
			if(pw1 != pw2) {
				console.log("New passwords must match");
				e.preventDefault();
			}
		});
	});
</script>