<?php

class Finance extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		// if($this->session->userdata('rank') != 4)
		// 	redirect('/login');

		$this->load->model('membersModel');
		$this->load->model('projectsModel');
	}

	public function index(){
		# code...
		echo "<pre>";

		$pros = $this->projectsModel->getLatestFinancedProjects();
		print_r($pros);

	}

	public function viewProject($id = 0){
		# code...
		$this->load->model('expensesModel');
		echo "<pre>";
		if($id == 0)
			redirect('/finace?n=' . urlencode('No Project Mentioned'));

		$project = $this->projectsModel->getProject($id);
		$expenses = $this->expensesModel->getExpenses($id);

		print_r($project);
		print_r($expenses);
	}
}

?>