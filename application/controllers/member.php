<?php

class Member extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		if($this->session->userdata('rank') != 3)
			redirect('/login');

		$this->load->model('membersModel');
		$this->load->model('projectsModel');
	}

	public function index(){
		
		$data = $this->getProjectFormData();
		$data['projects'] = $this->projectsModel->getProjectNames();
		$data['leaders'] = $this->projectsModel->getLeaders();
		$data['dates'] = $this->projectsModel->getDiscussionDates();
		$data1['currentPage'] = 'modProject';

		$data['sectors'][0] = 'ANY';
		$data['subsectors'][0] = 'ANY';
		$data['provinces'][0] = 'ANY';
		$data['cities'][0] = 'ANY';
		$data['status'][0] = 'ANY';
		$data['projectMembers'][0] = 'ANY';
		$data['leaders'][0] = 'ANY';
		$data['projects'][0] = 'ANY';


		ksort($data['sectors']);
		ksort($data['subsectors']);
		ksort($data['provinces']);
		ksort($data['cities']);
		ksort($data['status']);
		ksort($data['projectMembers']);
		ksort($data['leaders']);
		ksort($data['projects']);

		if($data['memberProjects'] = $this->projectsModel->getProjects($this->session->userdata('id'))){

			$this->load->model('sectorsModel');
			$this->load->model('provincesModel');
			$ps = array();
			foreach ($data['memberProjects'] as $project) {
				# code...
				$leaderName = $this->membersModel->getName($project['leaderId']);
				$sector = $this->sectorsModel->getName($project['sectorId']);
				$subsector = $this->sectorsModel->getName($project['subSectorId']);
				$geoRegion = $this->provincesModel->getName($project['geoRegion']);
				$p['id'] = $project['id'];
				$p['projectName'] = $project['name'];
				$p['projectLeader'] = $leaderName;
				$p['sector'] = $sector;
				$p['subSector'] = $subsector;
				$p['geoRegion'] = $geoRegion;
				$p['dealSize'] = $project['dealSize'];
				$p['date'] = $project['discussionDate'];
				$p['status'] = $project['status'];
				$ps[] = $p;
			}
			$data['memberProjects'] = $ps;
		}
		$d1['currentPage'] = 'home';
		$d1['username'] = $this->session->userdata('username');
		// echo "<pre>";
		// print_r($data['dates']);
		$this->load->view('member/header', $d1);
		$this->load->view('member/listProjects', $data);
		$this->load->view('member/footer');
	}


	public function myProjects(){
		# code...
		$data = $this->getProjectFormData();
		$data['projects'] = $this->projectsModel->getProjectNames();
		$data['leaders'] = $this->projectsModel->getLeaders();
		// $data['dates'] = $this->projectsModel->getDiscussionDates();
		$data1['currentPage'] = 'modProject';

		$data['sectors'][0] = 'ANY';
		$data['subsectors'][0] = 'ANY';
		$data['provinces'][0] = 'ANY';
		$data['cities'][0] = 'ANY';
		$data['status'][0] = 'ANY';
		$data['projectMembers'][0] = 'ANY';
		$data['leaders'][0] = 'ANY';
		$data['projects'][0] = 'ANY';


		ksort($data['sectors']);
		ksort($data['subsectors']);
		ksort($data['provinces']);
		ksort($data['cities']);
		ksort($data['status']);
		ksort($data['projectMembers']);
		ksort($data['leaders']);
		ksort($data['projects']);

		if($data['memberProjects'] = $this->membersModel->getProjects($this->session->userdata('id'))){

			$this->load->model('sectorsModel');
			$this->load->model('provincesModel');
			$ps = array();
			foreach ($data['memberProjects'] as $project) {
				# code...
				$leaderName = $this->membersModel->getName($project['leaderId']);
				$sector = $this->sectorsModel->getName($project['sectorId']);
				$subsector = $this->sectorsModel->getName($project['subSectorId']);
				$geoRegion = $this->provincesModel->getName($project['geoRegion']);
				$p['id'] = $project['id'];
				$p['projectName'] = $project['name'];
				$p['projectLeader'] = $leaderName;
				$p['sector'] = $sector;
				$p['subSector'] = $subsector;
				$p['geoRegion'] = $geoRegion;
				$p['dealSize'] = $project['dealSize'];
				$p['date'] = $project['discussionDate'];
				$p['status'] = $project['status'];
				$ps[] = $p;
			}
			$data['memberProjects'] = $ps;
		}
		$d1['currentPage'] = 'myProjects';
		$d1['username'] = $this->session->userdata('username');
		$this->load->view('member/header', $d1);
		$this->load->view('member/listProjects', $data);
		$this->load->view('member/footer');
		

	}

	public function changePassword(){
		# code...
		$this->load->model('loginModel');
		$d1['currentPage'] = 'changePassword';
		$d1['username'] = $this->session->userdata('username');
		$this->load->view('member/header', $d1);
		$this->load->view('member/changePassword');
		$this->load->view('member/footer');
	}

	public function investedProjects(){
		# code...
		$d1['currentPage'] = 'investedProjects';
		$d1['username'] = $this->session->userdata('username');
		$this->load->view('member/header', $d1);
		// $this->load->view('member/changePassword');
		$this->load->view('member/footer');
	}
	private function getProjectFormData() {

		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');
		$this->load->model('citiesModel');
		$this->load->model('membersModel');

		$sectors = $this->sectorsModel->getSectors();
		foreach ($sectors as $sector) {
			$sec[$sector['id']] = $sector['name'];
		}
		$data['sectors'] = $sec;
		
		$sec = array();
		$subsectors = $this->sectorsModel->getSubsectors(0);
		foreach ($subsectors as $subs) {
			$sec[$subs['id']] = $subs['name'].':'.$subs['subsectorOf'];
		}
		$data['subsectors'] = $sec;

		$sec = array();
		$subsectors = $this->provincesModel->getProvinces();
		foreach ($subsectors as $subs) {
			$sec[$subs['id']] = $subs['name'];
		}
		$data['provinces'] = $sec;

		$sec = array();
		$subsectors = $this->citiesModel->getCities();
		foreach ($subsectors as $subs) {
			$sec[$subs['id']] = $subs['name'];
		}
		$data['cities'] = $sec;

		$data['status'] = array('Preliminary' => 'Preliminary', 'In-depth DD' => 'In-depth DD', 'Invested' => 'Invested', 'Pending' => 'Pending', 'Rejected' => 'Rejected', 'Exited' => 'Exited');

		$res = $this->membersModel->getTeamMembers();
		foreach ($res as $value) {
			$members[$value['id']] = $value['memberName'];
		}
		$data['projectMembers'] = $members;
		$data['leaders'] = $members;

		return $data;
	}

	public function viewProject($id = 0){
		# code...
		if($id == 0){
			echo "No Project Specified";
			return;
		}

		if($this->membersModel->checkVisibility($this->session->userdata('id'), $id)){
			$this->load->model('sectorsModel');
			$this->load->model('provincesModel');
			$this->load->model('citiesModel');
			$this->load->model('membersModel');


			$data = $this->projectsModel->getProject($id);

			$data['leader'] = $this->membersModel->getName($data['leaderId']);
			$data['sector'] = $this->sectorsModel->getName($data['sectorId']);
			$data['subsector'] = $this->sectorsModel->getName($data['subSectorId']);
			$data['georegion'] = $this->provincesModel->getName($data['geoRegion']);

			$d1['currentPage'] = 'myProjects';
			$this->load->view('member/header',$d1);
			$this->load->view('member/viewProject', $data);
			$this->load->view('member/footer');
		}	
		else
			echo 'Project Details Not Accessible by you!!';
	}

	public function viewInvested($id = 0){
		if($id == 0){
			echo "No Project Specified";
			return;
		}

		$d1['currentPage'] = 'myProjects';

		$this->load->view('member/header',$d1);
		$this->load->view('member/viewInvestedProject');
		$this->load->view('member/footer');
	}




}