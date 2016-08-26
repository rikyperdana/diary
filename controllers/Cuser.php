<?php
Class Cuser extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function pendaftaran() {
		// panggil form pendaftaran user
		$this->load->view('tmpl/header');
		$this->load->view('vuser/userRegForm');
		$this->load->view('tmpl/footer');
	}

	function user_reg() {
		$this->form_validation->set_rules($this->form_rules->reg_rules());
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('tmpl/header');
			$this->load->view('vuser/userRegForm');
			$this->load->view('tmpl/footer');
		} else {
			if ($this->muser->daftarkan_user() == FALSE) {
				$data['hasil'] = 'Akun lain sudah terdaftar dengan username tersebut';
				$this->load->view('vuser/userRegSukses', $data);
			} else {
				$data['hasil'] = 'Akun berhasil didaftarkan';
				$this->load->view('vuser/userRegSukses', $data);
			}
		}
	}

	function login() {
		// tampilkan form login
		$this->load->view('tmpl/header');
		$this->load->view('vuser/userLoginForm');
		$this->load->view('tmpl/footer');
	}

	function user_login() {
		$id_user = $this->muser->id_user($this->input->post('username'));
		$password = $this->input->post('password');
		if ($this->muser->cek_login($id_user, $password)) {
			$this->session->set_userdata('id_user', $id_user);
			redirect('/cdiary/daftar');
		} else {
			redirect('/cuser/login');
		}
	}
}
?>
