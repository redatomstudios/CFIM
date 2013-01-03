<?php

class Test extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		$this->load->model('membersModel');
		$this->load->model('projectsModel');
		$this->load->model('commentsModel');
		$this->load->model('expensesModel');
		echo "<pre>";
	}

	public function test_getLatestComments(){
		# code...
		$res = $this->commentsModel->getLatestComment(45);
		print_r($res);
	}
	public function test_getProjects(){
		# code...
		$res = $this->membersModel->getProjects(9, 'Invested');
		print_r($res);
	}
	public function test_investedProjects(){
		# code...
		$res = $this->projectsModel->getInvestedProjects(2);
		print_r($res);
	}
	public function test_escape(){
		# code...
		$this->load->library('mylibrary');
		echo $this->mylibrary->escapeFunction("\"Hello\"");
	}

	public function index(){
		# code...
		if(preg_match("/[0-9]/", 'In-depth DD'))
			echo "Matches";
		else
			echo "No match";


	}

	public function test_sortDates(){
		# code...
		echo "<pre>";

		$arr[] = date_create_from_format("m/d/Y", "12/29/2011")->format('Ymd');
		$arr[] = date_create_from_format("m/d/Y", "12/20/2012")->format('Ymd');
		$arr[] = date_create_from_format("m/d/Y", "12/25/2012")->format('Ymd');
		print_r($arr);
		// ksort($arr);
		sort($arr);
		print_r($arr);
		// echo $arr[0]->format('m/d/Y');


	}


	public function test_insertSubsector($name, $subsector){
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

	public function test_isMemberOf(){
		# code...
		if($this->membersModel->isMemberOf(9, 48))
			echo "Member";
		else
			echo "Not member!! GTFO";
	}

	public function test_countComments(){
		# code...
		echo $this->commentsModel->countComments(45, 'followup', 2);
	}
}