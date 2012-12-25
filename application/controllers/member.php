<?php

class Member extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		if($this->session->userdata('rank') != 3)
			redirect('/login');

		$this->load->model('membersModel');
	}

	public function index(){
		echo "Member's home page!!<br> <pre>";
		$this->membersModel->getProjects($this->session->userdata('id'));
		$this->load->view('member/home');
	}
}