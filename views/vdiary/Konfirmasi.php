<p>Image details :</p><br />
<div class='col-md-3'>
	<div class='row'>
		<div><?php
		if ($i == 0) {
			echo form_open('cdiary/hapus_diary');
			echo $item['text'];
		} else {
			echo form_open('cdiary/hapus_image');
			echo form_hidden('i', $i);
			echo $this->imagestring->string2image($this->encryption->decrypt($item["img$i"]));
		}

		echo form_hidden('id_diary', $item['id_diary']);

		echo form_submit('submit', 'Hapus', 'class="btn btn-danger col-sm-4"');
		echo form_close();
		?></div>
		<div>
			<?= anchor(site_url('/cdiary/form_edit_diary/'.$item['id_diary']), 'Back to Diary', 'class="btn btn-info col-sm-4 col-sm-offset-1"')?>
		</div>
	</div>
</div>
