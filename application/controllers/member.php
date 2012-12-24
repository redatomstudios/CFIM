<?php

class Member extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		if($this->session->userdata('rank') != 1)
			redirect('/home');
	}

	public function index(){
		# code...
		echo "Member's home page!!";
	}
}