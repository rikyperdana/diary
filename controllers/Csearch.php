<?php

class Csearch extends CI_Controller {

	function __construct() {
		parent::__construct();
		if ($this->session->userdata('userlog') == NULL) {redirect('/cuser/login');}
	}

	function search_diary() {
		$this->load->view('tmpl/header');
		$this->load->view('vsearch/Search_diary');
		$this->load->view('tmpl/footer');
	}

	function search_diary_result() {
		$data['term'] = $this->input->post('term');
		$this->load->view('tmpl/header');
		$this->load->view('vsearch/Search_diary_result', $data);
		$this->load->view('tmpl/footer');
	}

	function search_room() {
		$this->load->view('tmpl/header');
		$this->load->view('vsearch/Search_room');
		$this->load->view('tmpl/footer');
	}

	function search_room_result() {
		$data['term'] = $this->input->post('term');
		$this->load->view('tmpl/header');
		$this->load->view('vsearch/Search_room_result', $data);
		$this->load->view('tmpl/footer');
	}

}

?>
