<?php

class Finance extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		// if($this->session->userdata('rank') != 4)
		// 	redirect('/login');

		$this->load->model('membersModel');
		$this->load->model('projectsModel');
		$this->load->model('expensesModel');
	}

	public function index(){

		$data['memberProjects'] = array();
		if($post = $this->input->post()){
			if($projects = $this->expensesModel->getFinancedProjects()){
				// echo "<pre>";
				$temp = '';
				foreach ($projects as $projectId) {
					# code...
					$temp .= ',' . $projectId['id'];
				}
				$projectIds = trim($temp, ',');
				$d['leaderId'] = $post['projectLeader'];
				$d['memberId'] = $post['projectMember'];
				$d['status'] = $post['status'];

				if($projects = $this->projectsModel->searchFinancedProjects($d, $projectIds)){

					$temp = array();
					foreach ($projects as $project) {
						# code...
						$project['accumulatedExpense'] =$this->expensesModel->getAccumulatedExpense($project['id']);
						$temp[] = $project;
					}

					$data['memberProjects'] = $temp;
				}

				// print_r($data);
			}
		}
		else
			$data['memberProjects'] = $this->expensesModel->getLatestFinancedProjects();

		$members = $this->membersModel->getMembers();
		foreach($members as $thisMember) {
			if($thisMember['rank'] == '3') {
				$data['members'][$thisMember['id']] = $thisMember['memberName'];
			}
			// Add the ANY option, with value 0
			$data['members'][0] = 'ANY';
		}

		$status = array(
			"0" => "ANY",
			"Preliminary" => "Preliminary",
			"In-depth DD" => "In-depth DD",
			"On-Going" => "On-Going",
			"Invested" => "Invested",
			"Pending" => "Pending",
			"Rejected" => "Rejected",
			"Exited" => "Exited"
			);
		$data['status'] = $status;

		$data['currentPage'] = 'myProjects';
		$data['username'] = $this->session->userdata('username');

		$this->load->view('finance/header', $data);
		$this->load->view('finance/listProjects', $data);
		$this->load->view('finance/footer');
	}

	public function viewProject($id = 0){
		# code...
		$this->load->model('expensesModel');
		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');
		
		if($id == 0)
			redirect('/finance?n=' . urlencode('No Project Mentioned'));

		$project = $this->projectsModel->getProject($id);
		$project['expenses'] = $this->expensesModel->getExpenses($id);

		// echo "<pre>";
		// print_r($project);
		// echo "</pre>";

		$data['leader'] = $this->membersModel->getName($project['leaderId']);
		$data['sector'] = $this->sectorsModel->getName($project['sectorId']);
		$data['subsector'] = $this->sectorsModel->getName($project['subSectorId']);
		$data['georegion'] = $this->provincesModel->getName($project['geoRegion']);
		$data['documents'] = '';
		$data['project'] = $project;

		/* 
			<th>Project Leader</th>
			<th>Sector</th>
			<th>Sub-Sector</th>
			<th>Geo Region</th>
			<th>Attachments</th>
		*/

		$data['currentPage'] = 'myProjects';
		$data['username'] = $this->session->userdata('username');

		$this->load->view('finance/header', $data);
		$this->load->view('finance/viewProject', $data);
		$this->load->view('finance/footer');
	}
}

?>