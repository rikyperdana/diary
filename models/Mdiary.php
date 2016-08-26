<?php
class Mdiary extends CI_Model {
	function __construct() {
		parent::__construct();
		$this->id_user = $this->session->userdata('id_user');
	}

	function daftar_diary($limit, $start) {
		$this->db->order_by('created', 'DESC');
		return $this->db->get_where('diaries', array('id_user' => $this->id_user), $limit, $start)->result_array();
	}

	function owner_diary_count() {
		return $this->db->get_where('diaries', array('id_user' => $this->id_user))->num_rows();
	}

	function count_pics($id_diary) {
		$query = $this->db->get_where('images', array('id_diary' => $id_diary))->row_array();
		$count = 0;
		for ($i = 1; $i < 25; $i++) {
			if ($query["img$i"] != NULL) {
				$count++;
			}
		}
		return $count;
	}

	function view_diary($id_diary) {
		$query = $this->db->get_where('diaries', array('id_diary' => $id_diary))->row_array();
		$query['text'] = $this->encryption->decrypt($query['text']);
		return $query;
	}

	function cek_owner($id_diary) {
		$query = $this->db->get_where('diaries', array('id_diary' => $id_diary))->row_array();
		if ($this->session->userdata('id_user') == $query['id_user']) {return TRUE;} else {return FALSE;}
	}

	function cek_publish($id_diary) {
		$query = $this->db->get_where('diaries', array('id_diary' => $id_diary))->row_array();
		if ($query['publish'] == 1) {return TRUE;} else {return FALSE;}
	}

	function cek_today() {
		$query = $this->db->get_where('diaries', array('id_user' => $this->id_user));
		$row_array = $query->row_array();
		$user = $this->db->get_where('users', array('id_user' => $this->id_user))->row_array();
		if ($query->num_rows() > 0) {
			$user_time = unix_to_human(time());
			if (substr($row_array['created'], 0, 10) == substr($user_time, 0, 10)) {
				return TRUE;
			}
		}
	}

	function cek_stranger($id_user) {
		$query = $this->db->get_where('users', array('id_user' => $id_user))->row_array();
		return $query['stranger'];
	}

	function latest_diary() {
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get_where('diaries', array('id_user' => $this->id_user), 1)->row_array();
		return $query['id_diary'];
	}

	function view_images($id_diary) {
		$query = $this->db->get_where('images', array('id_diary' => $id_diary))->row_array();
		$array = array();
		for ($i = 1; $i < 25; $i++) {
			if ($query["img$i"] != NULL) {
				$decrypted["img$i"] = $this->encryption->decrypt($query["img$i"]);
				$data["img$i"] = $this->imagestring->string2image($decrypted["img$i"]);
				$linked["img$i"] = anchor(site_url('/cdiary/konfirmasi_hapus/'.$id_diary.'/'.$i), $data["img$i"]);
				array_push($array, '$query["img$i"]');
			}
		}
		// kalau salah satu img berisi, return images
		if (implode('or', $array) != NULL) {
			if ($this->uri->segment(2) == 'form_edit_diary') {
				return $linked;
			} else {
				return $data;
			}
		}
	}

	function view_image($id_diary) {
		return $this->db->get_where('images', array('id_diary' => $id_diary))->row_array();
	}

	function create_diary($diary, $image) {
		$this->db->insert('diaries', $diary);
		$this->db->insert('images', $image);
	} //terima dari post, insert ke db

	function add_image($img, $id_diary) {
		$this->db->update('images', $img, array('id_diary' => $id_diary));
	}

	function cek_images($id_diary) {
		$query = $this->db->get_where('diaries', array('id_diary' => $id_diary))->num_rows();
		if ($query == 0) {return NULL;}
	}

	function cek_slot($id_diary) {
		$query = $this->db->get_where('images', array('id_diary' => $id_diary))->row_array();
		$array = array();
		for ($i = 1; $i < 25; $i++) {
			if ($query["img$i"] == NULL) {array_push($array, "img$i");}
		}
		if ($array != NULL) {return $array[0];}
	}

	function add_image_slot($array, $id_diary) {
		foreach ($array as $key => $value) {
			$data["{$this->cek_slot($id_diary)}"] = $value;
			$this->db->update('images', $data, array('id_diary' => $id_diary));
		}
	}

	function edit_diary($data) {
		$this->db->update('diaries', $data, array('id_diary' => $data['id_diary']));
	}

	function hapus_diary($id_diary) {
		$this->db->delete('diaries', array('id_diary' => $id_diary));
		$this->db->delete('images', array('id_diary' => $id_diary));
	}

	function hapus_image($id_diary, $i) {
		$data["img$i"] = NULL;
		$this->db->update('images', $data, array('id_diary' => $id_diary));
	}
}
?>
