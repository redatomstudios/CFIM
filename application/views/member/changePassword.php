<?= form_open('member/changePassword') ?>

Old Password: <?= form_password('oldPassword') ?>
<br />
New Password: <?= form_password('newPassword') ?>

<br />
<?= form_submit('submission', 'Submit') ?>

<?= form_close() ?>