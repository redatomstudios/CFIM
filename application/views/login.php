<div>
<?= form_open('login/doLogin') ?>
Username: 
<?= form_input(array('name' => 'username', 'id' => 'username')) ?>
<br>
Password: 
<?= form_password(array('name' => 'password', 'id' => 'password')) ?>
<br>
<?php echo $cap; ?>
</br>
Enter Captcha:
<?= form_input(array('name' => 'captcha', 'id' => 'captcha')) ?>
</br>
<?= form_submit('Submit','Submit'); ?>
<?= form_close() ?>
</div>