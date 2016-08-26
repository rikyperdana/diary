<div class="container">
	<div class="row">
<?php
	$pagination['base_url'] = site_url('/cdiary/daftar/');
	$pagination['total_rows'] = $this->mdiary->owner_diary_count();
	$pagination['per_page'] = $per_page = 5;
	$this->pagination->initialize($pagination);
	$pagenum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$daftar = $this->mdiary->daftar_diary($per_page, $pagenum);

	$table['table_open'] = '<table class="table table-hover">';
	$this->table->set_template($table);
	$this->table->set_heading('Date', 'Text', 'Mood', 'Pics', 'Action');
	foreach ($daftar as $item) :;
		$iconbaca = '<span class="glyphicon glyphicon-zoom-in"></span>';
		$iconedit = '<span class="glyphicon glyphicon-pencil"></span>';
		$iconhapus = '<span class="glyphicon glyphicon-trash"></span>';
		$linkbaca = anchor(('cdiary/view_diary/'.$item['id_diary']), $iconbaca, 'Read');
		$linkedit = anchor(('cdiary/form_edit_diary/'.$item['id_diary']), $iconedit, 'Edit');
		$linkhapus = anchor(('cdiary/konfirmasi_hapus/'.$item['id_diary'].'/0'), $iconhapus, 'Delete');
		$action = $linkbaca.'|'.$linkedit.'|'.$linkhapus;
		$decryptedtext = $this->encryption->decrypt($item['text']);
		$trimmedtext = character_limiter($decryptedtext, 20);
		$count_pics = $this->mdiary->count_pics($item['id_diary']);
		$this->table->add_row($item['created'], $trimmedtext, $item['mood'], $count_pics, $action);
	endforeach;
	echo $this->table->generate();
	echo $this->pagination->create_links();
?>
	</div>
	<div class="row">
	<?= anchor(site_url('/csearch/search_diary'), 'Search Diary', 'class="btn btn-info"')?><br /><br />
	<?= anchor(site_url('/cgallery/gallery'), 'My Gallery', 'class="btn btn-info"')?>
	<?= anchor(site_url('/croom/daftar'), 'Diary Room', 'class="btn btn-info"')?>
	</div>
</div>

