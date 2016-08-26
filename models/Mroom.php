<?php

class Mroom extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->id_user = $this->session->userdata('id_user');
	}

	function count_all_published() {
		return $this->db->get_where('diaries', array('publish' => 1))->num_rows();
	}

	function daftar_room($limit, $start) {
		$this->db->join('users', 'users.id_user = diaries.id_user');
		$this->db->order_by('created', 'DESC');
		return $this->db->get_where('diaries', array('diaries.publish' => 1), $limit, $start)->result_array();
	}

	function daftar_beloved_diaries($limit, $start) {
		$list = $this->db->get_where('diary_loves', array('id_user' => $this->id_user), $limit, $start)->result_array();
		$array = array();
		foreach ($list as $item) {
			$this->db->join('diaries', 'diaries.id_diary = diary_loves.id_diary');
			array_push($array, $this->db->get_where('diary_loves', array('id_user' => $this->id_user))->row_array());
		}
		return $array;
	}

	function count_beloved_diaries() {
		return $this->db->get_where('diary_loves', array('id_user' => $this->id_user))->num_rows();
	}

	function comment_list($id_diary) {
		$this->db->order_by('created', 'DESC');
		return $this->db->get_where('comments', array('id_diary' => $id_diary))->result_array();
	}

	function comment_insert($data) {
		$this->db->insert('comments', $data);
	}

	function cek_diary_love($id_diary) {
		$data = array('id_diary' => $id_diary, 'id_user' => $this->id_user);
		$cek = $this->db->get_where('diary_loves', $data)->num_rows();
		if ($cek > 0) {return TRUE;} else {return FALSE;}
	}

	function add_diary_love($id_diary) {
		$data = array('id_diary' => $id_diary, 'id_user' => $this->id_user);
		$cek = $this->db->get_where('diary_loves', $data)->num_rows();
		if ($cek < 1) {
			$this->db->insert('diary_loves', $data);
		}
	}

	function rmv_diary_love($id_diary) {
		$data = array('id_diary' => $id_diary, 'id_user' => $this->id_user);
		$cek = $this->db->get_where('diary_loves', $data);
		if ($cek > 0) {
			$this->db->delete('diary_loves', $data);
		}
	}

	function count_love($id_diary) {
		return $this->db->get_where('diary_loves', array('id_diary' => $id_diary))->num_rows();
	}


}

?>
