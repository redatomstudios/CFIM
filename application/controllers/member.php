<?php

class Member extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		if($this->session->userdata('rank') != 3)
			redirect('/login');
	}

	public function index(){
		echo "Member's home page!!";
	}
}