<p>Isikan ceritamu hari ini ;)</p>
<div class="container">
	<div class="row">
		<div class="col-md-8">
		<!-- Untuk textarea -->
			<?php echo form_open_multipart('cdiary/isi_diary')?>
			<?php echo form_hidden('id', $item['id'])?>
			<?php echo form_label('Isi diary')?><br />
			<?php
			$textarea['name'] = 'text';
			$textarea['id'] = 'text';
			$textarea['value'] = $item['text'];
			$textarea['rows'] = '6';
			$textarea['class'] = 'form-control';
			echo form_textarea($textarea);
			?><br />
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
		<!-- untuk input mood -->
			<?= form_label('Mood')?>
			<?= form_input('mood', $item['mood'], 'class="form-control"')?>
			<br />
		</div>
	</div>

	<div class="row">
		<?php
			echo form_label('Publish?');
			if ($item['publish'] == 0) {$publish = FALSE;} else {$publish = TRUE;}
			echo form_checkbox('publish', 'yes', $publish);
		?>
		<br />
	</div>

	<br></br>
	<div class="row">
		<?php
			for ($i = 1; $i < 25; $i++) {
				if (!empty($images["img$i"])) {echo $images["img$i"].' ';}
			}
			echo '<br />';

			echo '<input type="file" multiple name="userfile[]" size="20"/>';
		?>
	</div>
	<div class="row">
		<!-- baris button simpan dan batal -->
		<div class="col-md-1">
			<?= form_submit('submit', 'Simpan', 'class="btn btn-warning"')?>
		</div>
		<div class="col-md-1">
			<?= anchor(site_url('/cdiary/daftar'), 'Back to list', 'class="btn btn-info"')?>
		</div>
		<?= form_close()?>
	</div>

</div>
