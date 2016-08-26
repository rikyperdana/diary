<?php
class Muser extends CI_Model {

	public function __construct() {
		parent::__construct();
	}
	public function daftarkan_user() {
		$data['username'] = $this->input->post('username');
		$query = $this->db->get_where('users', array('username' => $data['username']), 1)->num_rows();
		if ($query == 0) {
			$data['username'] = $this->encryption->encrypt($this->input->post('username'));
			$data['password'] = $this->encryption->encrypt($this->input->post('password'));
			$data['email'] = $this->encryption->encrypt($this->input->post('email'));
			$data['stranger'] = $this->encryption->encrypt(random_string('nozero', '9'));
			$this->db->insert('users', $data); // kalau tidak ada, insert user baru ke db
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function id_user($username) {
		$query = $this->db->get('users')->result_array();
		foreach ($query as $item) {
			if ($this->encryption->decrypt($item['username']) == $username) {
				$id_user = $item['id_user'];
			}
		}
		return $id_user;
	}

	function id_user_name($id_user) {
		$query = $this->db->get_where('users', array('id_user' => $id_user))->row_array();
		return $this->encryption->decrypt($query['username']);
	}

	public function cek_login($id_user, $password) {
		$query = $this->db->get_where('users', array('id_user' => $id_user))->row_array();
		if ($this->encryption->decrypt($query['password']) == $password) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>
