<?php

class Croom extends CI_Controller {

	public function __construct() {
		parent::__construct();
		if ($this->session->userdata('userlog') == NULL) {redirect('cuser/login');}
	}
	public function daftar() {
		$this->load->view('tmpl/header');
		$this->load->view('vroom/List');
		$this->load->view('tmpl/footer');
		}
	}
?>
