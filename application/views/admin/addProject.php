<?= form_open_multipart('admin/'.(isset($id)?'editProject':'addProject')) ?>
<?= form_hidden('id',(isset($id)?$id:'')) ?>
</br><?= form_label('Project Name', 'name') ?>: <?= form_input(array('name' => 'name', 'id' => 'name', 'value' => (isset($name)?$name:''))) ?>
</br><?= form_label('Company Name', 'companyName') ?>: <?= form_input(array('name' => 'companyName', 'id' => 'companyName', 'value' => (isset($companyName)?$companyName:''))) ?>
</br>
</br><?= form_label('Company Address', 'companyAddress') ?>: <?= form_input(array('name' => 'companyAddress', 'id' => 'companyAddress', 'value' => (isset($cAddress)?$cAddress:''))) ?>
</br><?= form_label('Contact Person', 'contactPerson') ?>: <?= form_input(array('name' => 'contactPerson', 'id' => 'contactPerson', 'value' => (isset($contactPerson)?$contactPerson:''))) ?>
</br><?= form_label('Contact Email', 'contactEmail') ?>: <?= form_input(array('name' => 'contactEmail', 'id' => 'contactEmail', 'value' => (isset($contactEmail)?$contactEmail:''))) ?>
</br><?= form_label('Contact Tel', 'contactTel') ?>: <?= form_input(array('name' => 'contactTel', 'id' => 'contactTel', 'value' => (isset($contactTel)?$contactTel:''))) ?>
</br>


</br><?= form_label('Sector', 'sector') ?>: <?= form_dropdown('sector', $sectors, (isset($sector)?$sector:'1')) ?>
</br><?= form_label('Sub-Sector', 'subsector') ?>: <?= form_dropdown('subsector', $subsectors, (isset($subsector)?$subsector:'1')) ?>
</br><?= form_label('Geographical Region', 'province') ?>: <?= form_dropdown('province', $provinces, (isset($province)?$province:'1')) ?>
</br><?= form_label('City', 'city') ?>: <?= form_dropdown('city', $cities, (isset($city)?$city:'1')) ?>


</br><?= form_label('Date for discussion', 'discussionDate') ?>: <?= form_input(array('name' => 'discussionDate', 'id' => 'discussionDate', 'value' => (isset($discussionDate)?$discussionDate:''))) ?>
</br><?= form_label('Status', 'status') ?>: <?= form_dropdown('status', $status, (isset($thisStatus)?$thisStatus:'1')) ?>
</br><?= form_label('Team Leader', 'leader') ?>: <?= form_dropdown('leader', $leaders, (isset($leader)?$leader:'1')) ?>
</br><?= form_label('project Members', 'projectMembers') ?>: <?= form_multiselect('projectMembers[]', $projectMembers, (isset($selectedProjectMembers)?$selectedProjectMembers:'')) ?>
</br><?= form_label('Indicative Deal Size', 'dealSize') ?>: <?= form_input(array('name' => 'dealSize', 'id' => 'dealSize', 'value' => (isset($dealSize)?$dealSize:''))) ?>
</br><?= form_label('Upload File', 'file') ?>: <?= form_upload(array('name' => 'file', 'id' => 'file')) ?>


</br><?= form_submit('submit','Submit') ?>
</br><?= form_button('cancel','Cancel') ?>

<?= form_close() ?>