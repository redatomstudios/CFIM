<div class="bodyContent">
	<?= form_open('admin/'.(isset($id)?'editMember':'addMember')) ?>
	<?= form_hidden('id',(isset($id)?$id:'')) ?>
	<div class="gridOne spaceTop spaceBottom">
		<?= form_label('Member Name', 'name') ?><?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''))) ?>
	</div>
	<div class="gridTwo spaceTop">
		<?= form_label('Username', 'username') ?><?= form_input(array('name' => 'username', 'id' => 'username', 'value' => (isset($username)?$username:''))) ?>
	</div>
	<div class="gridTwo spaceTop">
		<?= form_label('Password', 'password') ?><?= form_password(array('name' => 'password', 'id' => 'password')) ?>
	</div>
	<div class="gridTwo spaceTop">
		<?= form_label('Rank', 'rank') ?><?= form_dropdown('rank', $ranks,(isset($rank)?$rank:'2')) ?>
	</div>
	<div class="gridTwo spaceTop">
		<?= form_label('Title', 'title') ?><?= form_dropdown('title', $titles, (isset($title)?$title:'1')) ?>
	</div>
	<div class="gridTwo spaceTop spaceBottom">
		<?= form_label('Status', 'status') ?><?= form_dropdown('status', array('Active', 'Suspended'), (isset($status)?$status:'0')) ?>
	</div>
	<div class="clear"></div>
	<div class="gridOne spaceTop spaceBottom">
		<?= form_label('Subordinates', 'subordinates') ?><?= form_multiselect('subordinates[]', $subordinates, (isset($selectedSubordinates)?$selectedSubordinates:'')) ?>
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
		<?= form_submit('submit','Submit') ?><?= form_button('cancel','Cancel') ?>
	</div>
	<?= form_close() ?>
</div>
<div class="clear"></div>