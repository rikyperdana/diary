<?php

class Form_rules {

	public function __construct() {
		$this->CI =& get_instance();
        }

	function reg_rules() {
		$condition = 'trim|required|min_length[6]|max_length[20]';
		$config = array(
			array(
				'field' => 'username',
				'label' => 'Your Username',
				'rules' => $condition
			),
			array(
				'field' => 'password',
				'label' => 'Your Password',
				'rules' => $condition
			),
			array(
				'field' => 'passconf',
				'label' => 'Password Confirmation',
				'rules' => 'trim|required|matches[password]'
			),
			array(
				'field' => 'email',
				'label' => 'Your Email',
				'rules' => 'trim|required|valid_email'
			)
		);
		return $config;
	}
}

?>
