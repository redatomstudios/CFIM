<?= form_open('admin/'.(isset($id)?'editMember':'addMember'), 'class = "confirmationRequired"') ?>
<?= form_hidden('id',(isset($id)?$id:'')) ?>
<div class="gridOne spaceTop spaceBottom">
	<?= form_label('Member Name', 'name') ?><?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''), 'required' => 'required')) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Username', 'username') ?><?= form_input(array('name' => 'username', 'id' => 'username', 'value' => (isset($username)?$username:''), 'required' => 'required')) ?>
</div>
<?php if(!isset($id)){ ?>
<div class="gridTwo spaceTop">
	<?= form_label('Password', 'password') ?><?= form_password(array('name' => 'password', 'id' => 'password', 'required' => 'required')) ?>
</div>
<?php } ?>
<div class="gridTwo spaceTop">
	<?= form_label('Rank', 'rank') ?><?= form_dropdown('rank', $ranks, (isset($rank)?$rank:'2'), 'id = "memberRank"') ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Title', 'title') ?>
	<?= form_dropdown('title', $titles, (isset($title)?$title:'1'), 'id="title"') ?>
	<?= form_input(array('name' => 'newTitle', 'placeholder' => 'New Title')) ?>
</div>
<div class="gridTwo spaceTop spaceBottom">
	<?= form_label('Status', 'status') ?><?= form_dropdown('status', $status, (isset($currentStatus)?$currentStatus:'1'), 'id = "status" required="required"') ?>
</div>
<div class="clear"></div>
<div class="gridOne spaceTop spaceBottom" id="displaySubordinates">
	<?= form_label('Subordinates', 'subordinates') ?><?= form_multiselect('subordinates[]', $subordinates, (isset($selectedSubordinates)?$selectedSubordinates:''), 'id="subordinates"') ?>
</div>
<div class="clear"></div>
<div class="gridTwo spaceTop">
	<?= form_label('Office Email', 'officeEmail') ?><?= form_input(array('name' => 'officeEmail', 'id' => 'officeEmail', 'value' => (isset($officeEmail)?$officeEmail:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Other Email', 'otherEmail') ?><?= form_input(array('name' => 'otherEmail', 'id' => 'otherEmail', 'value' => (isset($otherEmail)?$otherEmail:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Tel No.1', 'tel1') ?><?= form_input(array('name' => 'tel1', 'id' => 'tel1', 'value' => (isset($contactTel1)?$contactTel1:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_label('Tel No.1', 'tel2') ?><?= form_input(array('name' => 'tel2', 'id' => 'tel2', 'value' => (isset($contactTel2)?$contactTel2:''))) ?>
</div>
<div class="gridTwo spaceTop">
	<?= form_submit('submission','Submit') ?><?= form_button('cancel','Cancel') ?>
</div>
<?= form_close() ?>
<div class="clear"></div>