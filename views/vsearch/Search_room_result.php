<?php
	$pagination['base_url'] = site_url('/csearch/search_room_result/');
	$pagination['per_page'] = $per_page = 5;
	$pagenum = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
	$daftar = $this->msearch->search_room($term, $per_page, $pagenum);
	$pagination['total_rows'] = count($daftar);
	$this->pagination->initialize($pagination);

	$table['table_open'] = '<table class="table table-hover">';
	$this->table->set_template($table);
	$this->table->set_heading('Date', 'Text');
	foreach ($daftar as $item) :;
		$text = $this->encryption->decrypt($item['text']);
		$linkdate = anchor('cdiary/view_diary/'.$item['id_diary'], $item['created'], 'Date');
		$this->table->add_row($linkdate, $text);
	endforeach;
	if (count($daftar) > 0) {
		echo $this->table->generate();
		echo $this->pagination->create_links();
	} else {
		echo 'No results found';
	}
?>
