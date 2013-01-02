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
		$this->load->library('mylibrary');
		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');
		$this->load->model('citiesModel');
		$this->load->model('membersModel');
		$this->load->model('commentsModel');
		

		if($id == 0){
			echo "No Project Specified";
			return;
		}
		
		$data = $this->projectsModel->getProject($id);
		$data['leader'] = $this->membersModel->getName($data['leaderId']);
		$data['sector'] = $this->sectorsModel->getName($data['sectorId']);
		$data['subsector'] = $this->sectorsModel->getName($data['subSectorId']);
		$data['georegion'] = $this->provincesModel->getName($data['geoRegion']);
		$data['comments'] = $this->commentsModel->getAllComments($id);


		if($this->membersModel->isMemberOf($this->session->userdata('id'), $id))
			unset($data['status']); // Status isn't displayed if the member is a part of the team
		

		$d1['currentPage'] = 'home';
		$d1['username'] = $this->session->userdata('username');	


		// echo "<pre>";
		// print_r($data);

		$this->load->view('member/header',$d1);
		$this->load->view('member/viewProject', $data);
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

		$this->load->model('commentsModel');
		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');


		$d1['currentPage'] = 'investedProjects';
		$d1['username'] = $this->session->userdata('username');

		$data['currentPage'] = 'investedProjects';
		$data['projectsAsLeader'] = $this->projectsModel->getInvestedProjectsOfLeader($this->session->userdata('id'));

		// echo "<pre>";
		$memberProjects = array();
		$leaderProjects = array();
		if($projects = $this->membersModel->getProjects($this->session->userdata('id'), 'Invested')){
			foreach ($projects as $project) {
				# code...
				// print_r($project);
				if($project['leaderId'] != $this->session->userdata('id')){
					// echo "BLAH";
					$p = array();
					$p = $project;
					if($comment = $this->commentsModel->getLatestComment($project['id'])){
						$p['commentTimestamp'] = $comment['timestamp'];
					}else
						$p['commentTimestamp'] = '';
					$memberProjects[] = $p;
					// echo "<br>" . sizeof($p);
				}
				else{
					$p = array();
					$p = $project;
					if($comment = $this->commentsModel->getLatestComment($project['id'])){
						$p['commentTimestamp'] = $comment['timestamp'];
					}else
						$p['commentTimestamp'] = '';
					$leaderProjects[] = $p;
				}
			}
		}
		
		$timestamp1 = array();
		foreach ($leaderProjects as $key => $row) {
		    $timestamp1[$key]  = $row['commentTimestamp'];
		}
		if(sizeof($leaderProjects) > 0)
		array_multisort( $timestamp1, SORT_DESC, $leaderProjects);


		foreach ($memberProjects as $key => $row) {
		    $timestamp[$key]  = $row['commentTimestamp'];
		}
		if(sizeof($memberProjects) > 0)
		array_multisort( $timestamp, SORT_DESC, $memberProjects);

		$data['memberProjects'] = array_merge($leaderProjects, $memberProjects);
		
		$ps = array();
		foreach ($data['memberProjects'] as $project) {

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

		$this->load->view('member/header', $d1);
		$this->load->view('member/listProjects', $data);
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

	/*
	* If $commentType = 'root', it is a root comment
	* Else if $commentType = 'foolowup'

	*/
	public function newComment($commentType = 'root'){
		# code...
		$this->load->model('commentsModel');
		$post = $this->input->post();
		echo "<pre>";
		print_r($this->input->post());

		if(!isset($post['responseType']))
			$data['orderNumber'] = $this->commentsModel->countComments($post['projectID'], 'root') + 1;
		else
		{
			$count = $this->commentsModel->countComments($post['projectID'], 'followup', $post['rootID']) + 1;
			$data['orderNumber'] = $post['rootID'] . '.' . $count . '.' . $post['responseType'];
		}

		$data['memberId'] = $this->session->userdata('id');
		$data['projectId'] = $post['projectID'];
		$data['body'] = $post['commentBody'];

		$this->commentsModel->insertComment($data);
		redirect('/member/viewProject/' . $post['projectID']);
	}

}