<?php

class Supervisor extends CI_Controller{

	public function __construct(){
		# code...
		parent::__construct();
		if($this->session->userdata('rank') != 1)
			redirect('/login');

		$this->load->model('membersModel');
		$this->load->model('projectsModel');
	}

	public function index(){
		# code...

		$d1['username'] = $this->session->userdata('username');

		$d1['currentPage'] = 'home';

		$this->load->view('/super/header', $d1);
		$this->load->view('/super/listProjects');
		$this->load->view('/super/footer');
	}

	private function getProjectFormData() {

		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');
		$this->load->model('citiesModel');
		$this->load->model('membersModel');

		$sectors = $this->sectorsModel->getSectors();
		$sec[0] = 'ANY';
		foreach ($sectors as $sector) {
			$sec[$sector['id']] = $sector['name'];
		}
		$data['sectors'] = $sec;
		
		$sec = array();
		$sec[0] = 'ANY';
		$subsectors = $this->sectorsModel->getSubsectors(0);
		foreach ($subsectors as $subs) {
			$sec[$subs['id']] = $subs['name'].':'.$subs['subsectorOf'];
		}
		$data['subsectors'] = $sec;

		$sec = array();
		$sec[0] = 'ANY';
		$subsectors = $this->provincesModel->getProvinces();
		foreach ($subsectors as $subs) {
			$sec[$subs['id']] = $subs['name'];
		}
		$data['provinces'] = $sec;

		$sec = array();
		$sec[0] = 'ANY';
		$subsectors = $this->citiesModel->getCities();
		foreach ($subsectors as $subs) {
			$sec[$subs['id']] = $subs['name'];
		}
		$data['cities'] = $sec;

		$data['status'] = array(0 => 'ANY', 'Preliminary' => 'Preliminary', 'In-depth DD' => 'In-depth DD', 'Invested' => 'Invested', 'Pending' => 'Pending', 'Rejected' => 'Rejected', 'Exited' => 'Exited');

		$res = $this->membersModel->getTeamMembers();
		foreach ($res as $value) {
			$members[$value['id']] = $value['memberName'];
		}
		$data['projectMembers'] = $members;
		$data['leaders'] = $members;

		return $data;
	}


}

?>