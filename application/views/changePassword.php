<?= form_open('login/changePassword') ?>

<div class="gridOne spaceTop spaceBottom small">
	<span class="lg-en"><label>Old Password:</label></span>
	<span class="lg-cn"><label>&#26087;&#23494;&#30721;:</label></span>
	<?= form_password(array('name' => 'oldPassword', 'id' => 'oldPW')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom small">
	<span class="lg-en"><label>New Password:</label></span>
	<span class="lg-cn"><label>&#26032;&#23494;&#30721;:</label></span>
	<?= form_password(array('name' => 'newPassword', 'id' => 'newPW')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom small">
	<span class="lg-en"><label>Confirm Password:</label></span>
	<span class="lg-cn"><label>&#30830;&#35748;&#23494;&#30721;:</label></span>
	<?= form_password(array('name' => 'confirmPassword', 'id' => 'confirmPW')) ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop spaceBottom small">
	<span class="lg-en"><input type="submit" value="Submit" /></span>
	<span class="lg-cn"><input type="submit" value="&#25552;&#20132;" /></span>
</div>

<?= form_close() ?>

<script>
	jQuery(document).ready(function(){
		$('form').submit(function(e){
			var pw1 = document.getElementById('newPW').value,
				pw2 = document.getElementById('confirmPW').value;
			if(pw1 != pw2) {
				Notify([["New password should match confirmation!", 0]]);
				e.preventDefault();
			}
		});
	});
</script>