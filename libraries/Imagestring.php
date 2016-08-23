<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagestring {

        public function __construct() {
		$this->CI =& get_instance();
        }
	function image2string($upload_data) {

		//lakukan resize image berdasarkan nama file diberikan
		$this->CI->load->library('image_lib');
		$image_lib['source_image'] = getcwd().'/uploads/'.$upload_data['file_name'];
		$image_lib['maintain_ratio'] = TRUE;
		if ($upload_data['image_width'] > $upload_data['image_height']) {
			$image_lib['width'] = 400;
			$image_lib['height'] = 300;
		} else {
			$image_lib['width'] = 300;
			$image_lib['height'] = 400;
		}
		$this->CI->image_lib->initialize($image_lib);
		$this->CI->image_lib->resize();

		//ubah foto resized jadi string
		$this->CI->load->helper('file');
		$imgcontents = read_file(base_url().'uploads/'.$upload_data['file_name']);

		//konversi string jadi terenkripsi
		$this->CI->load->library('encryption');
		$result = $this->CI->encryption->encrypt($imgcontents);

		//hapus file image yang sudah diolah
		unlink(getcwd().'/uploads/'.$upload_data['file_name']);

		//kembalikan berupa encrypted_string
		return $result;

	}
	function string2image($string) {
		$converted = imagecreatefromstring($string);
		ob_start();
		imagepng($converted);
		$contents =  ob_get_contents();
		ob_end_clean();
		return "<img src='data:image/png;base64,".base64_encode($contents)."' />";
		imagedestroy($converted);
	}
}
