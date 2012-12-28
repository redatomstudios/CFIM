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
		$data['orderNumber'] = 2;
		$data['projectId'] = 46;
		$data['memberId'] = 3;
		$data['body'] = 'This project is good!!';

		$this->commentsModel->insertComment($data);
	}


	public function test_agreeComment(){
		if($this->commentsModel->agreeComment('2', '45', '3'))
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