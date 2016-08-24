<?php
echo form_open('cuser/user_reg');
	echo form_label('Your Username', 'username');
	echo form_input('username', set_value('username'), 'class=form-control');
echo '<br />';
	echo form_label('Your Password', 'password');
	echo form_password('password', '', 'class=form-control');
echo '<br />';
	echo form_label('Password Confirmation', 'passconf');
	echo form_password('passconf', '', 'class=form-control');
echo '<br />';
	echo form_label('Your Email', 'email');
	echo form_input('email', set_value('email'), 'class=form-control');
echo '<br />';
echo form_submit('submit', 'Daftar');
echo form_close();
?>
