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

		if($this->input->post()){
			$d['discussionDate'] = $this->input->post('discussionDate');
			$data['memberProjects'] = $this->projectsModel->searchProjects($d);
			// $data['memberProjects'] = $this->projectsModel->getProjects();
		}
		else{
			$data['memberProjects'] = $this->projectsModel->getProjects();
		}

		if($data['memberProjects']){

			// echo "<pre>";
			$this->load->model('sectorsModel');
			$this->load->model('provincesModel');
			$this->load->model('commentsModel');
			$ps = array();
			foreach ($data['memberProjects'] as $project) {

				// echo "<br> <br>";
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
				$p['comments'] = $this->commentsModel->getComments($p['id'], 3);

				$ps[] = $p;
			}
			// print_r($ps);

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

	public function viewProject($id = 0){
		# code...
		if($id == 0){
			echo "No Project Specified";
			return;
		}
		$this->load->library('mylibrary');
		if($this->membersModel->isMemberOf($this->session->userdata('id'), $id)){
			$this->load->model('sectorsModel');
			$this->load->model('provincesModel');
			$this->load->model('citiesModel');
			$this->load->model('membersModel');
			$this->load->model('commentsModel');
			
			// echo "<pre>";
			$data = $this->projectsModel->getProject($id);

			$data['leader'] = $this->membersModel->getName($data['leaderId']);
			$data['sector'] = $this->sectorsModel->getName($data['sectorId']);
			$data['subsector'] = $this->sectorsModel->getName($data['subSectorId']);
			$data['georegion'] = $this->provincesModel->getName($data['geoRegion']);
			unset($data['status']); // Status isn't displayed if the member is a part of the team

			$data['comments'] = $this->commentsModel->getAllComments($id);

			$d1['currentPage'] = 'home';
			$d1['username'] = $this->session->userdata('username');
			$this->load->view('member/header',$d1);
			$this->load->view('member/viewProject', $data);
			$this->load->view('member/footer');

			// print_r($data);
			// print_r($data);
			// echo "</pre>";

		}	
		else{
			$this->load->model('sectorsModel');
			$this->load->model('provincesModel');
			$this->load->model('citiesModel');
			$this->load->model('membersModel');
			$this->load->model('commentsModel');

			$data = $this->projectsModel->getProject($id);

			$data['comments'] = $this->commentsModel->getAllComments($id);

			$data['leader'] = $this->membersModel->getName($data['leaderId']);
			$data['sector'] = $this->sectorsModel->getName($data['sectorId']);
			$data['subsector'] = $this->sectorsModel->getName($data['subSectorId']);
			$data['georegion'] = $this->provincesModel->getName($data['geoRegion']);

			$d1['currentPage'] = 'home';
			$d1['username'] = $this->session->userdata('username');
			$this->load->view('member/header',$d1);
			$this->load->view('member/viewProject', $data);
			$this->load->view('member/footer');

			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
		}
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
			$this->load->model('commentsModel');
			
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
				$p['comments'] = $this->commentsModel->getComments($p['id'], 3);
				$ps[] = $p;
			}
			$data['memberProjects'] = $ps;
		}
		$d1['currentPage'] = 'myProjects';
		$data['currentPage'] = 'myProjects';
		$d1['username'] = $this->session->userdata('username');
		$this->load->view('member/header', $d1);
		$this->load->view('member/listProjects', $data);
		$this->load->view('member/footer');
	}

	public function changePassword(){
		# code...

		if(!$this->input->post()){
			$d1['currentPage'] = 'changePassword';
			$d1['username'] = $this->session->userdata('username');
			$this->load->view('member/header', $d1);
			$this->load->view('member/changePassword');
			$this->load->view('member/footer');
		}
		else{
			$this->load->model('loginModel');
			if($this->loginModel->changePassword($this->session->userdata('id'), $this->input->post('oldPassword'), $this->input->post('newPassword')))
				redirect('/member');
			echo "Password change failed";

		}
	}

	public function investedProjects(){
		# code...
		$d1['currentPage'] = 'investedProjects';
		$d1['username'] = $this->session->userdata('username');
		$data['projectsAsLeader'] = $this->projectsModel->getInvestedProjectsOfLeader($this->session->userdata('id'));

		$projects = $this->membersModel->getProjects($this->session->userdata('id'), 'Invested');

		echo "<pre>" . $this->session->userdata('id');
		print_r($projects);
		// $this->load->view('member/header', $d1);
		// $this->load->view('member/changePassword');
		// $this->load->view('member/footer');
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

	
	public function agreeComment(){
		# code...
		$this->load->model('commentsModel');
		$this->commentsModel->agreeComment($this->input->post('rootID'), $this->input->post('projectID'), $this->input->post('userID'));
		redirect('/member/viewProject/'.$this->input->post('projectID'));
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