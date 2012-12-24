<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('adminModel');
		$this->load->model('membersModel');
	}

	public function index() {
		$data['currentPage'] = 'home';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	}

	public function addMember() { 
		# code...
		if($post = $this->input->post()){
			if($this->membersModel->insertMember($this->input->post()))
				redirect('admin');
			echo "Member Not Added!! Error in values!!";
		}
		else{
			$this->load->model('titlesModel');

			$subordinates = array();
			$titles = array();

			$res = $this->membersModel->getSubordinates();
			foreach ($res as $value) {
				$subordinates[$value['id']] = $value['memberName'];
			}
			$res = $this->titlesModel->getTitles();
			foreach ($res as $value) {
				$titles[$value['id']] = $value['name'];
			}
			$data['ranks'] = array(
				'0' => 'Supervisor',
				'1' => 'Administrator',
				'2' => 'Member',
				'3' => 'Finance');
			$data['status'] = array(
				'0' => 'Active',
				'1' => 'Suspended');
			$data['subordinates'] = $subordinates;
			$data['titles'] = $titles;
			$data['currentPage'] = 'newMember';
			$this->load->view('admin/header', $data);
			$this->load->view('admin/members/newMember', $data);
			$this->load->view('admin/footer');
		}
	}

	public function editMember() { 
		if(!$this->input->post()){

			$res = $this->membersModel->getMemberUsernames();
			foreach ($res as $row) {
				$usernames[$row['id']] = $row['username'];
			}
			$data['usernames'] = $usernames;
			$data['currentPage'] = 'modMember';
			$this->load->view('admin/header', $data);
			$this->load->view('admin/members/chooseMember', $data);
			$this->load->view('admin/footer');
		}
		elseif($this->input->post('username')){
			
			if(!$this->input->post('id')){				
				$data = $this->getMemberFormData();
				$data['currentPage'] = 'modMember';
				$this->load->view('admin/header', $data);
				$this->load->view('admin/members/newMember', $data);
				$this->load->view('admin/footer');
			}
			else{
				if($this->membersModel->updateMember($this->input->post()))
					redirect('admin');
				echo "Member Not Updated!! Error in values!!";
			}

		}
	}

	private function getMemberFormData() {
		# code...
		$this->load->model('titlesModel');

		$id = $this->input->post('username');
		$member = $this->membersModel->getMember($this->input->post('username'));
		$res = $this->membersModel->getSubordinates();
		foreach ($res as $value) {
			if($value['id'] != $id)
			$subordinates[$value['id']] = $value['memberName'];
		}
		$res = $this->titlesModel->getTitles();
		foreach ($res as $value) {
			$titles[$value['id']] = $value['name'];
		}

		$data['id'] = $member->id;
		$data['ranks'] = array(
			'0' => 'Supervisor',
			'1' => 'Administrator',
			'2' => 'Member',
			'3' => 'Finance');
		$data['subordinates'] = $subordinates;
		$data['titles'] = $titles;
		$data['name'] = $member->memberName;
		$data['username'] = $member->username;
		$data['rank'] = $member->rank;
		$data['title'] = $member->titleId;
		$data['status'] = array( 1 => 'Active',
								 2 => 'Exausted');
		$data['currentStatus'] = $member->status;
		$data['selectedSubordinates'] = explode(',', $member->subordinates);
		$data['officeEmail'] = $member->officeEmail;
		$data['otherEmail'] = $member->otherEmail;
		$data['contactTel1'] = $member->contactTel1;
		$data['contactTel2'] = $member->contactTel2;

		return $data;
	}

	public function addProject() { 
		# code...
		$this->load->model('projectsModel');

		if(!$this->input->post()){
			$data = $this->getProjectFormData();
			$data['currentPage'] = 'newProject';
			$this->load->view('admin/header', $data);
			$this->load->view('admin/projects/newProject', $data);
			$this->load->view('admin/footer');
		}
		else{
			echo "<pre>";
			print_r($this->input->post());
			$this->projectsModel->insertProject($this->input->post());
		}
	}

	public function editProject() { // Temporary, to test project search, list and editing.
		$data['currentPage'] = 'modProject';
		$this->load->view('admin/header', $data);
		$this->load->view('admin/projects/searchProjects');
		$this->load->view('admin/footer');
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
			$sec[] = $subs['name'];
		}
		$data['provinces'] = $sec;

		$sec = array();
		$subsectors = $this->citiesModel->getCities();
		foreach ($subsectors as $subs) {
			$sec[] = $subs['name'];
		}
		$data['cities'] = $sec;

		$data['status'] = array(1 => 'Preliminary', 'In-depth DD', 'Invested', 'Pending', 'Rejected', 'Exited');

		$res = $this->membersModel->getTeamMembers();
		foreach ($res as $value) {
			$members[$value['id']] = $value['memberName'];
		}
		$data['projectMembers'] = $members;
		$data['leaders'] = $members;

		return $data;
	}


}