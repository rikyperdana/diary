<?php
class Muser extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function daftarkan_user() {
		$data['username'] = $this->input->post('username');
		$query = $this->db->get_where('users', array('username' => $data['username']), 1)->num_rows();
		if ($query == 0) {
			$data['username'] = $this->input->post('username');
			$input['password'] = $this->input->post('password'); // password yg diinput dienkripsi dulu
			$data['password'] = $this->encryption->encrypt($input['password']);
			$input['email'] = $this->input->post('email');
			$data['email'] = $this->encryption->encrypt($input['email']);
			$data['stranger'] = $this->input->post('stranger');
			$data['timezone'] = $this->input->post('timezone');
			$this->db->insert('users', $data); // kalau tidak ada, insert user baru ke db
			return TRUE;
		} else {
			return FALSE;
		}
	}
	public function cek_login($data) {
		$cekdb = $this->db->get_where('users', array('username' => $data['username']))->row_array();
		$decryptedpassword = $this->encryption->decrypt($cekdb['password']);
		if ($decryptedpassword == $data['password']) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>
