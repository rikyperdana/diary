<div class="container">
	<div class="row">
<?php
		$pagination['base_url'] = site_url('/croom/daftar/');
		$pagination['total_rows'] = $this->mroom->count_all_published();
		$pagination['per_page'] = 2;
		$this->pagination->initialize($pagination);
		$pagenum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$daftar = $this->mroom->daftar_room($pagination['per_page'], $pagenum);
	
		$table['table_open'] = '<table class="table table-hover">';
		$this->table->set_template($table);
		$this->table->set_heading('Date', 'From', 'Text', 'Mood', 'Love', 'Action');
		foreach ($daftar as $item) :;
			$iconbaca = '<span class="glyphicon glyphicon-zoom-in"></span>';
			$linkbaca = anchor(('cdiary/view_diary/'.$item['id_diary']), $iconbaca, 'Read');
			$decryptedtext = $this->encryption->decrypt($item['text']);
			$trimmedtext = character_limiter($decryptedtext, 20);
			$stranger = $this->encryption->decrypt($item['stranger']);
			$count_love = $this->mroom->count_love($item['id_diary']);
			$this->table->add_row($item['created'], $stranger, $trimmedtext, $item['mood'], $count_love, $linkbaca);
		endforeach;
		echo $this->table->generate();
		echo $this->pagination->create_links();
?>
	</div>
	<div class="row">
		<?= anchor(site_url('/csearch/search_room'), 'Search Room', 'class="btn btn-info"')?><br /><br />
		<?= anchor(site_url('/cgallery/gallery'), 'My Gallery', 'class="btn btn-info"')?>
		<?= anchor(site_url('/cdiary/daftar'), 'My Diary', 'class="btn btn-info"')?>
	</div>
</div>
