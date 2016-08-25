<?php
class Mdiary extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->owner = $this->session->userdata('userlog');
	}

	function daftar_diary($limit, $start) {
		$this->db->order_by('created', 'DESC');
		return $this->db->get_where('diaries', array('owner' => $this->owner), $limit, $start)->result_array();
	}

	function owner_diary_count() {
		return $this->db->get_where('diaries', array('owner' => $this->owner))->num_rows();
	}

	function count_pics($id) {
		$query = $this->db->get_where('images', array('id' => $id))->row_array();
		$count = 0;
		for ($i = 1; $i < 25; $i++) {
			if ($query["img$i"] != NULL) {
				$count++;
			}
		}
		return $count;
	}

	function view_diary($id) {
		$query = $this->db->get_where('diaries', array('id' => $id))->row_array();
		$query['text'] = $this->encryption->decrypt($query['text']);
		return $query;
	}

	function cek_owner($id) {
		$query = $this->db->get_where('diaries', array('id' => $id))->row_array();
		if ($this->session->userdata('userlog') == $query['owner']) {return TRUE;} else {return FALSE;}
	}

	function cek_publish($id) {
		$query = $this->db->get_where('diaries', array('id' => $id))->row_array();
		if ($query['publish'] == 1) {return TRUE;} else {return FALSE;}
	}

	function cek_today() {
		$query = $this->db->get_where('diaries', array('owner' => $this->owner));
		$row_array = $query->row_array();
		$user = $this->db->get_where('users', array('username' => $this->owner))->row_array();
		if ($query->num_rows() > 0) {
			$user_time = unix_to_human(time());
			if (substr($row_array['created'], 0, 10) == substr($user_time, 0, 10)) {
				return TRUE;
			}
		}
	}

	function cek_stranger($username) {
		$query = $this->db->get_where('users', array('username' => $username))->row_array();
		return $query['stranger'];
	}

	function latest_diary() {
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get_where('diaries', array('owner' => $this->owner), 1)->row_array();
		return $query['id'];
	}

	function view_images($id) {
		$query = $this->db->get_where('images', array('id' => $id))->row_array();
		$array = array();
		for ($i = 1; $i < 25; $i++) {
			if ($query["img$i"] != NULL) {
				$decrypted["img$i"] = $this->encryption->decrypt($query["img$i"]);
				$data["img$i"] = $this->imagestring->string2image($decrypted["img$i"]);
				$linked["img$i"] = anchor(site_url('/cdiary/konfirmasi_hapus/'.$id.'/'.$i), $data["img$i"]);
				array_push($array, '$query["img$i"]');
			}
		}
		// kalau salah satu img berisi, return images
		if (implode('or', $array) != NULL) {
			if ($this->uri->segment(2) == 'view_diary') {
				return $data;
			} else {
				return $linked;
			}
		}
	}

	function view_image($id) {
		return $this->db->get_where('images', array('id'=>$id))->row_array();
	}

	function create_diary($diary, $image) {
		$this->db->insert('diaries', $diary);
		$this->db->insert('images', $image);
	} //terima dari post, insert ke db

	function add_image($img, $id) {
		$this->db->update('images', $img, array('id'=>$id));
	}

	function cek_images($id) {
		$query = $this->db->get_where('diaries', array('id' => $id))->num_rows();
		if ($query == 0) {return NULL;}
	}

	function cek_slot($id) {
		$query = $this->db->get_where('images', array('id' => $id))->row_array();
		$array = array();
		for ($i = 1; $i < 25; $i++) {
			if ($query["img$i"] == NULL) {array_push($array, "img$i");}
		}
		if ($array != NULL) {return $array[0];}
	}

	function add_image_slot($array, $id) {
		foreach ($array as $key => $value) {
			$data["{$this->cek_slot($id)}"] = $value;
			$this->db->update('images', $data, array('id' => $id));
		}
	}

	function edit_diary($diary) {
		$this->db->update('diaries', $diary, array('id' => $diary['id']));
	}

	function hapus_diary($id) {
		$this->db->delete('diaries', array('id' => $id));
		$this->db->delete('images', array('id' => $id));
	}

	function hapus_image($id, $i) {
		$data["img$i"] = NULL;
		$this->db->update('images', $data, array('id' => $id));
	}
}
?>
