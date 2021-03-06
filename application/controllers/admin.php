<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();

		if($this->session->userdata('rank') != 2)
			redirect('/home');
		
		$this->load->model('adminModel');
		$this->load->model('membersModel');
		$this->load->model('projectsModel');
	}

	public function index() {

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



		$this->load->view('admin/header', $d1);
		$this->load->view('admin/dashboard', $data);
		$this->load->view('admin/footer');
	}

	public function addProject() { 
		$this->load->model('projectsModel');
		$this->load->library('mylibrary');

		if(!$this->input->post()){
			
			$data = $this->getProjectFormData();
			$data['projects'] = $this->projectsModel->getProjectNames();
			// $data['leaders'] = $this->projectsModel->getLeaders();

			


			ksort($data['sectors']);
			ksort($data['subsectors']);
			ksort($data['provinces']);
			ksort($data['cities']);
			ksort($data['status']);
			ksort($data['projectMembers']);
			ksort($data['leaders']);
			ksort($data['projects']);


			$data['currentPage'] = 'newProject';
			$this->load->view('admin/header', $data);
			$this->load->view('admin/projects/newProject', $data);
			$this->load->view('admin/footer');
		}
		else{

			$post = $this->input->post();
			if($this->isNotValidAddProject($post) == 0){
			// if(true){

				$this->load->model('sectorsModel');
				$this->load->model('citiesModel');
				$this->load->model('provincesModel');

				if($post['newSector'] != ''){
					$post['sector'] = $this->sectorsModel->insertSector($post['newSector']);
				}

				if($post['newSubsector'] != ''){
					$post['subsector'] = $this->sectorsModel->insertSubsector($post['newSubsector'], $post['sector']);
				}

				if($post['newCity'] != ''){
					$post['city'] = $this->citiesModel->insertCity($post['newCity']);
				}

			if($post['newProvince'] != ''){
					$post['province'] = $this->provincesModel->insertProvince($post['newProvince']);
				}

				$pid = $this->projectsModel->insertProject($post);
				
				if(!$uploads = $this->mylibrary->uploader($pid)) {
					 // redirect('/admin/addProject?n=' . urlencode('Upload Failure.') . '^0');
					// echo "No Uploads";	//Echo this error
				} else {
					$this->load->model('documentsModel');

					$ids = $this->documentsModel->insertDocument($pid, $uploads);
					$ids = implode(',', $ids);

					$this->projectsModel->updateDocuments($pid, $ids);
				}
				redirect('/admin?n=' . urlencode('New project created.') . '^1');


				
			}
			elseif($this->isNotValidAddProject($post) == 1)
				redirect('/admin/addProject?n=' . urlencode('Please fill all required fields').'^0');
			elseif($this->isNotValidAddProject($post) == 2)
				redirect('/admin/addProject?n=' . urlencode('Project leader can\'t also be project member.').'^0');

		}
	}

	public function editProject($id = 0) {

		if($id != 0){

			$this->load->model('documentsModel');

			$data = $this->getProjectFormData();

			$project = $this->projectsModel->getProject($id);

			$members = explode(',', $project['members']);
			$members = array_filter($members);

			$attachments = explode(',', $project['documents']);
			$attachments = array_filter($attachments);

			$at = array();
			foreach ($attachments as $attachment) {
				# code...
				$d = $this->documentsModel->getDocument($attachment);
				$at[] = $d;
			}


			$data['id'] = $project['id'];
			$data['name'] = $project['name'];
			$data['companyName'] = $project['companyName'];
			$data['companyAddress'] = $project['companyAddress'];
			$data['contactPerson'] = $project['contactPerson'];
			$data['contactEmail'] = $project['contactEmail'];
			$data['contactTel'] = $project['contactTel'];
			$data['sector'] = $project['sectorId'];
			$data['subsector'] = $project['subSectorId'];
			$data['province'] = $project['geoRegion'];
			$data['city'] = $project['city'];
			$data['discussionDate'] = $project['discussionDate'];
			$data['thisStatus'] = $project['status'];
			$data['leader'] = $project['leaderId'];
			$data['selectedProjectMembers'] = $members;
			$data['dealSize'] = $project['dealSize'];
			$data['attachments'] = $at;

			$data1['currentPage'] = 'modProject';
			$data1['username'] = $this->session->userdata('username');

			// echo "<pre>";
			// print_r($data1);
			// print_r($data);
			// echo "</pre>";

			$this->load->view('admin/header', $data1);
			$this->load->view('admin/projects/newProject', $data);
			$this->load->view('admin/footer');
		}
		elseif(!$this->input->post()){
			
			$data = $this->getProjectFormData();
			$data['projects'] = $this->projectsModel->getProjectNames();
			$data['leaders'] = $this->projectsModel->getLeaders();

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


			$data1['currentPage'] = 'modProject';
			$data1['username'] = $this->session->userdata('username');

			// print_r($data['status']);
			$this->load->view('admin/header', $data1);
			$this->load->view('admin/projects/searchProject', $data);
			$this->load->view('admin/footer');
		}
		elseif(!$this->input->post('id')){
			// $projects = $this->projectsModel->searchProjects($this->input->post());
			// echo "<pre>";
			// print_r($projects);
			// $this->load->view('admin/header', $d1);
			// $this->load->view('admin/projects/listProject', $data);
			// $this->load->view('admin/footer');
			if($data['memberProjects'] = $this->projectsModel->searchProjects($this->input->post())){

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


			$d1['currentPage'] = 'modProject';
			$d1['username'] = $this->session->userdata('username');

			$data['edit'] = 1;	// To show project names as hyperlinks for editing


			$this->load->view('admin/header', $d1);
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer');
		}
		else{

			$post = $this->input->post();
			// echo "<pre>";
			// print_r($post);
			if($this->isNotValidAddProject($post) != 2){
			// if(true){

				$this->load->model('sectorsModel');
				$this->load->model('citiesModel');
				$this->load->model('provincesModel');
				$this->load->model('documentsModel');
				$this->load->library('mylibrary');

				if($post['newSector'] != ''){
					$post['sector'] = $this->sectorsModel->insertSector($post['newSector']);
				}

				if($post['newSubsector'] != ''){
					$post['subsector'] = $this->sectorsModel->insertSubsector($post['newSubsector'], $post['sector']);
				}

				if($post['newCity'] != ''){
					$post['city'] = $this->citiesModel->insertCity($post['newCity']);
				}

				if($post['newProvince'] != ''){
					$post['province'] = $this->provincesModel->insertProvince($post['newProvince']);
				}

				$pid = $this->projectsModel->updateProject($post);
				
				if(!$uploads = $this->mylibrary->uploader($pid)) {
					// redirect('/admin/editProject?n=' . urlencode('Upload Failure.') . '^0');
					// echo "No Uploads";
				} else {
					$this->load->model('documentsModel');

					$ids = $this->documentsModel->insertDocument($pid, $uploads);
					$ids = implode(',', $ids);

					$this->projectsModel->updateDocuments($pid, $ids);
				}
				if(isset($post['deletions'])){
					$deletes = $post['deletions'];
					foreach ($deletes as $documentId) {
						# code...
						/*
						1. Delete file from server
						2. Delete entry from projects
						3. Delete entry from documents
						*/
						$doc = $this->documentsModel->getDocument($documentId);
						$name = $doc['filename'];

						unlink($_SERVER['DOCUMENT_ROOT'] . base_url(). 'resources/uploads/' . $pid . '/' . $name);

						$this->projectsModel->deleteDocument($pid, $documentId);

						$this->documentsModel->deleteDocument($documentId);

					}
				}

				redirect('/admin?n=' . urlencode('Project modified successfully.') . '^1');
			}
			else{
				redirect('/admin/addProject?n=' . urlencode('Team member cannot be a team leader') . '^1');
			}
		}
	}

	private function isNotValidAddProject($data){
		if(($data['name'] == '') || ($data['companyName'] == '') || ($data['companyAddress'] == '') || ($data['contactPerson'] == '') || ($data['contactEmail'] == '') || ($data['contactTel'] == '') || ($data['discussionDate'] == '') || ($data['status'] == '') || ($data['leader'] == '') || ($data['dealSize'] == ''))
			return 1;
		$leader = $data['leader'];
		$members = $data['projectMembers'];
		if(in_array($leader, $members))
			return 2;

		return 0;
	}

	public function addMember() { 
		# code...
		if($data = $this->input->post()){

			$this->load->model('titlesModel');
			$this->load->model('membersModel');
			
			$verify = $this->isNotValidAddMember($data);
			if($verify == 0){

				if($this->membersModel->checkUsernameExists($data['username']))
					redirect('/admin/addMember?n=' . urlencode('Username already exists') . '^0');
				$subordinates = '';
				if(isset($data['subordinates'])){
					foreach ($data['subordinates'] as $value) {
						# code...
						$subordinates .= $value.',';
					}
					if($subordinates != NULL)
						$subordinates = substr($subordinates, 0, strlen($subordinates)-1);
				}


				$insert = array(
					'memberName' => $data['name'],
					'username' => $data['username'],
					'password' => sha1($data['password']),
					'rank' => $data['rank'],
					'titleId' => ( isset($data['title']) ? $data['title'] : '' ),
					'status' => $data['status'],
					'subordinates' => $subordinates,
					'officeEmail' => $data['officeEmail'],
					'otherEmail' => $data['otherEmail'],
					'contactTel1' => $data['tel1'],
					'contactTel2' => $data['tel2']
					);

				if($data['newTitle'] != ''){
					$insert['titleId'] = $this->titlesModel->insertTitle($data['newTitle']);
				}

				if($this->membersModel->insertMember($insert))
					redirect('/admin/index?n=' . urlencode("Member added successfully") . '^1');
				redirect('/admin/index?n=' . urlencode("Create member Failure"));
			}
			elseif($verify == 1)
				redirect('/admin/addMember?n=' . urlencode('Fill all values'));
			elseif($verify == 2)
				redirect('/admin/addMember?n=' . urlencode('Rank Field Error'));
			elseif($verify == 3)
				redirect('/admin/addMember?n=' . urlencode('Status Field Error'));
			elseif($verify == 4)
				redirect('/admin/addMember?n=' . urlencode('Invalid Subordinate'));
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
				'1' => 'Supervisor',
				'2' => 'Administrator',
				'3' => 'Member',
				'4' => 'Finance');
			$data['status'] = array(
				'0' => 'Suspended',
				'1' => 'Active'
				);
			$data['subordinates'] = $subordinates;
			$data['titles'] = $titles;
			

			$d1['currentPage'] = 'newMember';
			$this->load->view('admin/header', $d1);
			$this->load->view('admin/members/newMember', $data);
			$this->load->view('admin/footer');
		}
	}

	public function isNotValidAddMember($data){
		# code...
		if(!($data['name'] != '' && $data['username'] != '' && (isset($data['title']) ? $data['title'] != '' : 1 )))
			return 1;
		if(!isset($data['id'])){
			if(!($data['password']))
				return 1;
		}

		elseif(!in_array($data['rank'], array(1, 2, 3, 4)))
			return 2;
		elseif(!in_array($data['status'], array(0, 1)))
			return 3;
		if(isset($data['subordinates']))
		foreach ($data['subordinates'] as $subordinate) {
			# code...
			if(!$this->membersModel->getMember($subordinate))
				return 4;
		}

		//ALSO validate Members only have subordinates


		return 0;

	}
	public function editMember() { 
		if(!$this->input->post()){

			$res = $this->membersModel->getMemberNames();
			foreach ($res as $row) {
				$usernames[$row['id']] = $row['memberName'];
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


				$d1['currentPage'] = 'modMember';
				$this->load->view('admin/header', $d1);
				$this->load->view('admin/members/newMember', $data);
				$this->load->view('admin/footer');
			}
			else{

				$this->load->model('titlesModel');
				// echo "<pre>";

				$data = $this->input->post();
				// print_r($data);
				$verify = $this->isNotValidAddMember($this->input->post());
				if($verify == 0){

					$subordinates = '';
					if(isset($data['subordinates'])){
						foreach ($data['subordinates'] as $value) {
							# code...
							$subordinates .= $value.',';
						}
						if($subordinates != NULL)
							$subordinates = substr($subordinates, 0, strlen($subordinates)-1);
					}

					$insert = array(
						'memberName' => $data['name'],
						'username' => $data['username'],
						'rank' => $data['rank'],
						'titleId' => $data['title'],
						'status' => $data['status'],
						'subordinates' => $subordinates,
						'officeEmail' => $data['officeEmail'],
						'otherEmail' => $data['otherEmail'],
						'contactTel1' => $data['tel1'],
						'contactTel2' => $data['tel2']
						);

					if(isset($data['password']) && $data['password'] != '') {
						$insert['password'] = sha1($data['password']);
					}

					if($data['newTitle'] != ''){
						$insert['titleId'] = $this->titlesModel->insertTitle($data['newTitle']);
					}

					if($this->membersModel->updateMember($data['id'], $insert))
						redirect('admin/editMember?n=' . urlencode("Member successfully modified.") . '^1');
					redirect('/admin/index?n=' . urlencode("Create member Failure"));
				}
				elseif($verify == 1)
				redirect('/admin/editMember?n=' . urlencode('Fill all values'));
			elseif($verify == 2)
				redirect('/admin/editMember?n=' . urlencode('Rank Field Error'));
			elseif($verify == 3)
				redirect('/admin/editMember?n=' . urlencode('Status Field Error'));
			elseif($verify == 4)
				redirect('/admin/editMember?n=' . urlencode('Invalid Subordinate'));
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
			'1' => 'Supervisor',
			'2' => 'Administrator',
			'3' => 'Member',
			'4' => 'Finance');
		$data['subordinates'] = $subordinates;
		$data['titles'] = $titles;
		$data['name'] = $member->memberName;
		$data['username'] = $member->username;
		$data['rank'] = $member->rank;
		$data['title'] = $member->titleId;
		$data['status'] = array( 1 => 'Active',
								 2 => 'Suspended');
		$data['currentStatus'] = $member->status;
		$data['selectedSubordinates'] = explode(',', $member->subordinates);
		$data['officeEmail'] = $member->officeEmail;
		$data['otherEmail'] = $member->otherEmail;
		$data['contactTel1'] = $member->contactTel1;
		$data['contactTel2'] = $member->contactTel2;

		return $data;
	}

	private function getProjectFormData() {

		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');
		$this->load->model('citiesModel');
		$this->load->model('membersModel');

		$sec = array();
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

	public function statistics(){
		# code...
			// print_r($data);
		$d['username'] = $this->session->userdata('username');
		$d['currentPage'] = 'stats';
		if(!$post = $this->input->post()){
		// 
		$data = $this->getProjectFormData();
			$data['projects'] = $this->projectsModel->getProjectNames();
			$data['leaders'] = $this->projectsModel->getLeaders();

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



			$this->load->view('admin/header', $d);
			$this->load->view('admin/statistics', $data);
			$this->load->view('admin/footer');
		}
		else{

			// echo "<pre>";
			// print_r($post);

			if($data['memberProjects'] = $this->projectsModel->searchProjects($this->input->post())){

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
			$this->load->view('admin/header', $d);
			$this->load->view('admin/dashboard', $data);
			$this->load->view('admin/footer');

		}
	}

}