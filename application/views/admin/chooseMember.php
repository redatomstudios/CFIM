Select Member username:

<?php
echo form_open('admin/editMember');
echo form_label('Choose Member: ', 'usernames');
echo form_dropdown('username', $usernames);
echo form_submit('submit', 'Submit');
echo form_close();
