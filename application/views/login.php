<div>
<?= form_open('login') ?>
Username: 
<?= form_input(array('name' => 'username', 'id' => 'username')) ?>
<br>
Password: 
<?= form_password(array('name' => 'password', 'id' => 'password')) ?>
<br>
<?= $cap ?>
<?= form_submit('Submit','Submit'); ?>
<?= form_close() ?>
</div>