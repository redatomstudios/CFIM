<?= form_open('admin/'.(isset($id)?'editMember':'addMember')) ?>
<?= form_hidden('id',(isset($id)?$id:'')) ?>
</br><?= form_label('Name', 'name') ?>: <?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''))) ?>
</br><?= form_label('Username', 'username') ?>: <?= form_input(array('name' => 'username', 'id' => 'username', 'value' => (isset($username)?$username:''))) ?>
</br><?= form_label('Password', 'password') ?>: <?= form_password(array('name' => 'password', 'id' => 'password')) ?>
</br><?= form_label('Rank', 'rank') ?>: <?= form_dropdown('rank', $ranks,(isset($rank)?$rank:'2')) ?>
</br><?= form_label('Title', 'title') ?>: <?= form_dropdown('title', $titles, (isset($title)?$title:'1')) ?>
</br><?= form_label('Status', 'status') ?>: <?= form_input(array('name' => 'status', 'id' => 'status', 'value' => (isset($status)?$status:'Active'))) ?>
</br><?= form_label('Subordinates', 'subordinates') ?>: <?= form_multiselect('subordinates[]', $subordinates, (isset($selectedSubordinates)?$selectedSubordinates:'')) ?>
</br><?= form_label('Office Email', 'officeEmail') ?>: <?= form_input(array('name' => 'officeEmail', 'id' => 'officeEmail', 'value' => (isset($officeEmail)?$officeEmail:''))) ?>
</br><?= form_label('Other Email', 'otherEmail') ?>: <?= form_input(array('name' => 'otherEmail', 'id' => 'otherEmail', 'value' => (isset($otherEmail)?$otherEmail:''))) ?>
</br><?= form_label('Tel No.1', 'tel1') ?>: <?= form_input(array('name' => 'tel1', 'id' => 'tel1', 'value' => (isset($contactTel1)?$contactTel1:''))) ?>
</br><?= form_label('Tel No.1', 'tel2') ?>: <?= form_input(array('name' => 'tel2', 'id' => 'tel2', 'value' => (isset($contactTel2)?$contactTel2:''))) ?>
</br><?= form_submit('submit','Submit') ?>
</br><?= form_button('cancel','Cancel') ?>

<?= form_close() ?>