Select Member username:

<?php
echo form_open('admin/editMember');
echo form_label('Choose Member: ', 'usernames');
echo form_dropdown('usernames', $usernames);
echo form_submit('submit', 'Submit');
echo form_close();
