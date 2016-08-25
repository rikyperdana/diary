<div class="container">
	<div class="row">
<?php
		$pagination['base_url'] = site_url('/croom/beloved_diaries/');
		$pagination['total_rows'] = $this->mroom->count_beloved_diaries();
		$pagination['per_page'] = 2;
		$this->pagination->initialize($pagination);
		$pagenum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$daftar = $this->mroom->daftar_beloved_diaries($pagination['per_page'], $pagenum);
	
		$table['table_open'] = '<table class="table table-hover">';
		$this->table->set_template($table);
		$this->table->set_heading('Date', 'From', 'Text', 'Love', 'Action');
		foreach ($daftar as $item) :;
			$text = $this->encryption->decrypt($item['text']);
			$count_love = $this->mdiary->count_love($item['id']);
			$stranger = $this->encryption->decrypt($this->mdiary->cek_stranger($item['owner']));
			$hapus = anchor(site_url('/cdiary/rmv_diary_love/'.$item['id']), 'Unlove', 'class="btn btn-danger"');
			$this->table->add_row($item['created'], $stranger, $text, $count_love, $hapus);
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
