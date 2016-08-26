<?php

class Mgallery extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function get_all() {
		$this->db->join('diaries', 'images.id_diary = diaries.id_diary');
		$this->db->order_by('diaries.created', 'DESC');
		$query = $this->db->get_where('images', array('diaries.id_user'=>$this->session->userdata('id_user')))->result_array();
		$array = array();
		foreach ($query as $row) {
			for ($i = 1; $i < 25; $i++) {
				if ($row["img$i"] != NULL) {
					$decrypt["img$i"] = $this->encryption->decrypt($row["img$i"]);
					$image["img$i"] = $this->imagestring->string2image($decrypt["img$i"]);
					$imglink["img$i"] = anchor(('cdiary/form_edit_diary/'.$row['id_diary']), $image["img$i"]);
					array_push($array, $imglink["img$i"]);
				}
			}
		}
		return $array;
	}

}

?>
