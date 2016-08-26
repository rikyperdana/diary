<?php

class Cdiary extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->id_user = $this->session->userdata('id_user');
		if ($this->id_user == NULL) {redirect('/cuser/login');}
	} //konstruktor & loader

	//FUNGSI VIEW
	function daftar() {
		$this->load->view('tmpl/header');
		$this->load->view('tmpl/index_top');
		$this->load->view('vdiary/List');
		$this->load->view('tmpl/footer');
	}

	function view_diary($id_diary) {
		$this->load->view('tmpl/header');
		$data['diary'] = $this->mdiary->view_diary($id_diary);
		$data['images'] = $this->mdiary->view_images($id_diary);
		if (!($this->mdiary->cek_publish($id_diary)) and !($this->mdiary->cek_owner($id_diary))) {
			redirect('/cdiary/daftar');
		}
		$this->load->view('vdiary/View', $data);
		if ($this->mdiary->cek_publish($id_diary)) {
			$data['id_diary'] = $id_diary;
			$this->load->view('vdiary/Comment_form', $data);
			$data['comments'] = $this->mroom->comment_list($id_diary);
			$this->load->view('vdiary/Comment_list', $data);
		}
		$this->load->view('tmpl/footer');
	} //baca 1 diary ditunjuk

	//FUNGSI CREATE
	function write_diary() {
		if ($this->mdiary->cek_today() == TRUE) {
			$latest = $this->mdiary->latest_diary();
			redirect(site_url('/cdiary/form_edit_diary/'.$latest));
		} else {
			redirect(site_url('/cdiary/form_create_diary'));
		}
	}

	function form_create_diary() {
		$this->load->view('tmpl/header');
		$this->load->view('vdiary/Create');
		$this->load->view('tmpl/footer');
	} //panggil form isi diary

	function isi_diary() {
		if ($this->input->post('id_diary') == NULL) {
			$image['id_diary'] = $diary['id_diary'] = random_string('alpha', 16);
		} else {
			$image['id_diary'] = $diary['id_diary'] = $this->input->post('id_diary');
		}
		$diary['id_user'] = $this->id_user;
		$diary['text'] = $this->encryption->encrypt($this->input->post('text'));
		$diary['mood'] = $this->input->post('mood');
		if ($this->input->post('publish') == FALSE) {$diary['publish'] = 0;} else {$diary['publish'] = 1;}

		if ($this->input->post('id_diary') == NULL) {
			$this->mdiary->create_diary($diary, $image);
		} else {
			$this->mdiary->edit_diary($diary);
		}

		$upload['upload_path'] = './uploads/';
                $upload['allowed_types'] = 'gif|jpg|png';
                $upload['max_size'] = 25000000;
                $upload['max_width'] = 8000;
                $upload['max_height'] = 6000;

		$files = $_FILES;
		$cpt = count($_FILES['userfile']['name']);

		for($i = 0; $i < $cpt; $i++) {
			$_FILES['userfile']['name']= $files['userfile']['name'][$i];
			$_FILES['userfile']['type']= $files['userfile']['type'][$i];
			$_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
			$_FILES['userfile']['error']= $files['userfile']['error'][$i];
			$_FILES['userfile']['size']= $files['userfile']['size'][$i];    
			$this->upload->initialize($upload);
			if ($this->upload->do_upload()) {
				if ($this->input->post('id_diary') == NULL) {
					$n = $i + 1;
					$img["img$n"] = $this->imagestring->image2string($this->upload->data());
					$this->mdiary->add_image($img, $image['id_diary']);
				} else {
					$array = array();
					array_push($array, $this->imagestring->image2string($this->upload->data()));
					$this->mdiary->add_image_slot($array, $image['id_diary']);
				}
			}
		}

		redirect('/cdiary/form_edit_diary/'.$diary['id_diary']);
	}

	//FUNGSI EDIT
	function form_edit_diary($id_diary) {
		$this->load->view('tmpl/header');
		$data['item'] = $this->mdiary->view_diary($id_diary);
		$data['images'] = $this->mdiary->view_images($id_diary);
		if ($this->mdiary->cek_owner($id_diary) == FALSE) {redirect('/croom/daftar');}
		$this->load->view('vdiary/Edit', $data);
		$this->load->view('tmpl/footer');
	} //panggil form edit diary


	//FUNGSI HAPUS
	function konfirmasi_hapus($id_diary, $i) {
		$this->load->view('tmpl/header');
		if ($this->mdiary->cek_owner($id_diary) == FALSE) {redirect('/croom/daftar');}
		if ($i == 0) {
			$data['item'] = $this->mdiary->view_diary($id_diary);
		} else {
			$data['item'] = $this->mdiary->view_image($id_diary, $i);
		}
		$data['i'] = $i;
		$this->load->view('vdiary/Konfirmasi', $data);
		$this->load->view('tmpl/footer');
	} //tangkap id, kalau user bilang oke, opor id ke hapus_diary

	function hapus_diary() {
		$id_diary = $this->input->post('id_diary');
		$this->mdiary->hapus_diary($id_diary);
		redirect('/cdiary/daftar');
	} //tangkap parameter, model hapus record sesuai id

	function hapus_image($id_diary, $i) {
		$id_diary = $this->input->post('id_diary');
		$i = $this->input->post('i');
		$this->mdiary->hapus_image($id_diary, $i);
		redirect('/cdiary/form_edit_diary/'.$id_diary);
	}

	//FUNGSI AKHIR
	function logout() {
		$this->session->sess_destroy();
		redirect('/cuser/login');
	}
}
?>
