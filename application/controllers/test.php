<?php

class Test extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		$this->load->model('membersModel');
		$this->load->model('projectsModel');
		$this->load->model('commentsModel');
	}

	public function test_insertComments(){
		# code...
		$data['orderNumber'] = '1';
		$data['projectId'] = 45;
		$data['memberId'] = 2;
		$data['body'] = 'This project is good!!';

		$this->commentsModel->insertComment($data);
	}


	public function test_agreeComment(){
		if($this->commentsModel->agreeComment('1', '45', '2'))
			echo "Success!!";
		else
			echo "Failed!!";
	}

	public function test_getComments($projectId){
		# code...
		$comments = $this->commentsModel->getComments($projectId);
		echo "<pre>";
		print_r($comments);
	}
}