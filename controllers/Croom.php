<?php

class Croom extends CI_Controller {

	function __construct() {
		parent::__construct();
		if ($this->session->userdata('id_user') == NULL) {redirect('cuser/login');}
	}

	function daftar() {
		$this->load->view('tmpl/header');
		$this->load->view('vroom/List');
		$this->load->view('tmpl/footer');
	}

	function beloved_diaries() {
		$this->load->view('tmpl/header');
		$this->load->view('vroom/Beloved_diaries');
		$this->load->view('tmpl/footer');
	}

	//FUNGSI COMMENT
	function comment_insert() {
		$data['id_diary'] = $this->input->post('id_diary');
		$data['id_comment'] = random_string('alpha', 16);
		$data['id_user'] = $this->session->userdata('id_user');
		$data['comment'] = $this->encryption->encrypt($this->input->post('comment'));
		$this->mroom->comment_insert($data);
		redirect('cdiary/view_diary/'.$data['id_diary']);
	}

	//FUNGSI LOVE
	function add_diary_love($id_diary) {
		$this->mroom->add_diary_love($id_diary);
		redirect('cdiary/view_diary/'.$id_diary);
	}

	function rmv_diary_love($id_diary) {
		$this->mroom->rmv_diary_love($id_diary);
		redirect('cdiary/view_diary/'.$id_diary);
	}
}
?>
