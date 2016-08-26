<?php

class Msearch extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->id_user = $this->session->userdata('id_user');
	}

	function search_diary($term, $limit, $start) {
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get_where('diaries', array('id_user' => $this->id_user), $limit, $start)->result_array();
		$result = array();
		foreach ($query as $row) {
			$text = $this->encryption->decrypt($row['text']);
			if (stripos($text, ' '.$term) or stripos($text, $term.' ')) {
				array_push($result, $row);
			}
		}
		return $result;
	}

	function search_room($term, $limit, $start) {
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get_where('diaries', array('publish' => 1), $limit, $start)->result_array();
		$result = array();
		foreach ($query as $row) {
			$text = $this->encryption->decrypt($row['text']);
			if (stripos($text, ' '.$term) or stripos($text, $term.' ')) {
				array_push($result, $row);
			}
		}
		return $result;
	}

}

?>
