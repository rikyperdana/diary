<?php
echo form_open('cuser/user_reg');
	echo form_label('Your Username', 'username');
	echo form_input('username', set_value('username'));
echo '<br />';
	echo form_label('Your Password', 'password');
	echo form_password('password');
echo '<br />';
	echo form_label('Password Confirmation', 'passconf');
	echo form_password('passconf');
echo '<br />';
	echo form_label('Your Email', 'email');
	echo form_input('email', set_value('email'));
echo '<br />';
	echo form_label('Stranger Name', 'stranger');
	echo form_input('stranger', set_value('stranger'));
echo '<br />';
	echo form_label('Timezone', 'timezone');
	echo form_dropdown('timezone', $this->timezone->timezone_list(), 'UP7');
echo '<br />';
echo form_submit('submit', 'Daftar');
echo form_close();
?>
