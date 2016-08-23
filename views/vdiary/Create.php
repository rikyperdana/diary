<p>Isikan ceritamu hari ini ;)</p>
<?= form_open_multipart('cdiary/isi_diary')?>

<?= form_label('Diary')?><br />
<?php
	$textarea['name'] = 'text';
	$textarea['id'] = 'text';
	$textarea['rows'] = '5';
	$textarea['cols'] = '60';
	echo form_textarea($textarea);
?>
<br />
<?= form_label('Mood')?>
<?= form_input('mood', '', 'class="form-control"')?>
<br />

<input type="file" multiple name="userfile[]" size="20"/>

<?= form_label('Publish?');?>
<?= form_checkbox('publish', 'yes', FALSE);?>
<br /><br />
<?= form_submit('submit', 'Simpan', 'class="btn btn-success"')?>
<?= form_close()?>
