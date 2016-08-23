<?php

class Mroom extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	function count_all_published() {
		return $this->db->get_where('diaries', array('publish' => 1))->num_rows();
	}

	function daftar_room($limit, $start) {
		$this->db->join('users', 'users.username = diaries.owner');
		$this->db->order_by('created', 'DESC');
		return $this->db->get_where('diaries', array('diaries.publish' => 1), $limit, $start)->result_array();
	}

}

?>
