<?php

class Mroom extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->owner = $this->session->userdata('userlog');
	}

	function count_all_published() {
		return $this->db->get_where('diaries', array('publish' => 1))->num_rows();
	}

	function daftar_room($limit, $start) {
		$this->db->join('users', 'users.username = diaries.owner');
		$this->db->order_by('created', 'DESC');
		return $this->db->get_where('diaries', array('diaries.publish' => 1), $limit, $start)->result_array();
	}

	function daftar_beloved_diaries($limit, $start) {
		$list = $this->db->get_where('diary_loves', array('from_user' => $this->owner), $limit, $start)->result_array();
		$array = array();
		foreach ($list as $item) {
			$this->db->join('diaries', 'diaries.id = diary_loves.id_diary');
			array_push($array, $this->db->get_where('diary_loves', array('from_user' => $this->owner))->row_array());
		}
		return $array;


	}

	function count_beloved_diaries() {
		return $this->db->get_where('diary_loves', array('from_user' => $this->owner))->num_rows();
	}
}

?>
