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

		$data = $this->getProjectFormData();
		if($this->input->post()){
			$d = $this->input->post();
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
			$this->load->model('expensesModel');
			$ps = array();
			foreach ($data['memberProjects'] as $project) {

				$exp = $this->expensesModel->getAccumulatedExpense($project['id']);
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
				$p['expenses'] = ($exp) ? $exp : '0';

				$ps[] = $p;
			}
			// print_r($ps);

			$data['memberProjects'] = $ps;
		}

		// echo "<pre>";
		// print_r($data);

		$this->load->view('/super/header', $d1);
		$this->load->view('/super/listProjects', $data);
		$this->load->view('/super/footer');
	}

	public function investedProjects(){
		# code...

		$this->load->model('commentsModel');
		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');


		$d1['currentPage'] = 'investedProjects';
		$d1['username'] = $this->session->userdata('username');

		$data = $this->getProjectFormData();
		// $data['projectsAsLeader'] = $this->projectsModel->getInvestedProjectsOfLeader($this->session->userdata('id'));

		// echo "<pre>";
		$memberProjects = array();
		$leaderProjects = array();
		if($projects = $this->membersModel->getProjects($this->session->userdata('id'), 'Invested')){
			foreach ($projects as $project) {
				# code...
				// print_r($project);
				
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
		}
		
		foreach ($memberProjects as $key => $row) {
		    $timestamp[$key]  = $row['commentTimestamp'];
		}
		if(sizeof($memberProjects) > 0)
		array_multisort( $timestamp, SORT_DESC, $memberProjects);

		$data['memberProjects'] = $memberProjects;
		
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

		// echo "<pre>";
		// print_r($data);

		$this->load->view('super/header', $d1);
		$this->load->view('super/listProjects', $data);
		$this->load->view('super/footer');
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
		$members['0'] = 'ANY';
		foreach ($res as $value) {
			$members[$value['id']] = $value['memberName'];
		}
		$data['members'] = $members;
		$data['leaders'] = $members;

		return $data;
	}

	public function viewProject($id = 0){
		# code...
		$this->load->library('mylibrary');
		$this->load->model('sectorsModel');
		$this->load->model('provincesModel');
		$this->load->model('citiesModel');
		$this->load->model('membersModel');
		$this->load->model('commentsModel');
		$this->load->model('expensesModel');
		$this->load->model('documentsModel');
		
		// echo "<pre>";


		if($id == 0){
			redirect('/supervisor?n=' . urlencode('No Project Specified'));
		}

		$data = $this->projectsModel->getProject($id);

		$tempComments = array();
		$comments = $this->commentsModel->getAllComments($id);
		// echo "<pre>";
		if($comments){
			foreach ($comments as $comment) {
				# code...
				$names = array();
				$docs = '';
				$docs = $comment['attachments'];
				if($docs != ''){
					// echo "<br><br><br>" . $docs;
					$docs = trim($docs, ',');
					$docs = explode(',', $docs);
					
					if(sizeof($docs) > 0){
						$name = array();
						foreach ($docs as $doc) {
							# code...
							// echo "<br>" . $doc;
							$document = $this->documentsModel->getDocument($doc);
							// print_r($document);

							$n['filename'] = $document->filename;
							$n['timestamp'] = $document->timestamp;
							$name[] = $n;
						}
					}
				}
				$c = $comment;
				
				if(isset($name)) $c['files'] = $name;
				unset($name);
				$tempComments[] = $c;
				// print_r($c);
			}
		}$comments = $tempComments;


		$tempUpdates = array();
		$updates = $this->expensesModel->getAll($id);
		// print_r($updates);
		if($updates){
			foreach ($updates as $update) {
				# code...
				$docs = $update['attachments'];
				if($docs != ''){
					$attachmentName = array();

					$docs = trim($docs, ',');
					$docs = explode(',', $docs);
					
					if(sizeof($docs) > 0){
						foreach ($docs as $doc) {
							$document = $this->documentsModel->getDocument($doc);
							$n['filename'] = $document->filename;
							$n['timestamp'] = $document->timestamp;
							$attachmentName[] = $n;
						}
					}
				}

				if($update['expense'] != NULL){
					$docs = ( isset($update['voucher']) ? $update['voucher'] : '' );
					if($docs != ''){
						$voucherName = array();

						$docs = trim($docs, ',');
						$docs = explode(',', $docs);
						
						if(sizeof($docs) > 0){
							foreach ($docs as $doc) {
								$document = $this->documentsModel->getDocument($doc);
								$n['filename'] = $document->filename;
								$n['timestamp'] = $document->timestamp;
								$voucherName[] = $n;
							}
						}
					}
				}


				$c = $update;
				if(isset($attachmentName)) $c['attachments'] = $attachmentName;
				if(isset($voucherName)) $c['vouchers'] = $voucherName;
				unset($attachmentName);
				unset($voucherName);
				$tempUpdates[] = $c;
			}
		}

		$updates = $tempUpdates;

		
		$docs = $data['documents'];
		if($docs != ''){
			// $voucherName = array();

			$docs = trim($docs, ',');
			$docs = explode(',', $docs);
			
			if(sizeof($docs) > 0){
				foreach ($docs as $doc) {
					$document = $this->documentsModel->getDocument($doc);
					$n['filename'] = $document->filename;
					$n['timestamp'] = $document->timestamp;
					$voucherName[] = $n;
				}
			}
			$data['documents'] = $voucherName;
		}


		$data['leader'] = $this->membersModel->getName($data['leaderId']);
		$data['sector'] = $this->sectorsModel->getName($data['sectorId']);
		$data['subsector'] = $this->sectorsModel->getName($data['subSectorId']);
		$data['georegion'] = $this->provincesModel->getName($data['geoRegion']);
		$data['comments'] = $comments;
		$data['updates'] = $updates;
		

		$d1['currentPage'] = 'myProjects';
		$d1['username'] = $this->session->userdata('username');	
		// For live projects
		if(!($data['status'] == 'Invested' || $data['status'] == 'Exited')){

			$this->load->view('super/header',$d1);
			$this->load->view('super/viewProject', $data);
			$this->load->view('super/footer');
		}
		else{
		
			$this->load->view('super/header',$d1);
			$this->load->view('super/viewInvestedPRoject', $data);
			$this->load->view('super/footer');

		}
	}

	public function agreeComment(){
		# code...
		$this->load->model('commentsModel');
		$this->commentsModel->agreeComment($this->input->post('rootID'), $this->input->post('projectID'), $this->input->post('userID'));
		redirect('/supervisor/viewProject/'.$this->input->post('projectID'));
	}

	public function newComment(){
		# code...
		$this->load->model('commentsModel');
		$this->load->library('mylibrary');

		$post = $this->input->post();
		// echo "<pre>";
		// print_r($this->input->post());

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
		if($uploads = $this->mylibrary->uploader($post['projectID'])) {
			$this->load->model('documentsModel');

			$ids = $this->documentsModel->insertDocument($post['projectID'], $uploads);
			$ids = implode(',', $ids);

			// $this->projectsModel->updateDocuments($pid, $ids);
			$data['attachments'] = $ids;
		}

		// echo "<pre>";
		// print_r($data);
		$this->commentsModel->insertComment($data);
		// echo $this->db->last_query();
		redirect('/supervisor/viewProject/' . $post['projectID']);
	}

	public function newUpdate(){
		# code...
		$this->load->model('expensesModel');
		$this->load->library('mylibrary');

		$post = $this->input->post();
		// echo "<pre>";
		
		$data = array();
		$data['projectId'] = $post['projectID'];
		$data['memberId'] = $post['userID'];
		$data['updateBody'] = $post['commentBody'];
		if(!$uploads = $this->mylibrary->uploader($post['projectID'])) {
			// redirect('/admin/addProject?n=' . urlencode('Upload Failure.') . '^0');
			echo "No Uploads";	//Echo this error
		} else {
			$this->load->model('documentsModel');

			$ids = $this->documentsModel->insertDocument($post['projectID'], $uploads);
			$ids = implode(',', $ids);

			// $this->projectsModel->updateDocuments($pid, $ids);
			$data['attachments'] = $ids;
		}

		$this->expensesModel->insertUpdate($data);
		redirect('/supervisor/viewProject/'.$post['projectID']);
	}

	public function newExpense(){
		# code...
		$this->load->model('expensesModel');
		$this->load->library('mylibrary');

		$post = $this->input->post();
		// echo "<pre>";
		
		$data = array();
		$data['projectId'] = $post['projectID'];
		$data['memberId'] = $post['userID'];
		$data['updateBody'] = $post['commentBody'];
		$data['expense'] = $post['expense'];
		

		if(!$attachments = $this->mylibrary->uploader($post['projectID'])) {
			// redirect('/admin/addProject?n=' . urlencode('Upload Failure.') . '^0');
			echo "No Uploads";	//Echo this error
		} else {
			$this->load->model('documentsModel');

			$ids = $this->documentsModel->insertDocument($post['projectID'], $attachments);
			$ids = implode(',', $ids);

			// $this->projectsModel->updateDocuments($pid, $ids);
			$data['attachments'] = $ids;
		}

		if(!$vouchers = $this->mylibrary->uploader($post['projectID'], 'vouchers')) {
			// redirect('/admin/addProject?n=' . urlencode('Upload Failure.') . '^0');
			echo "No Uploads";	//Echo this error
		} else {
			$this->load->model('documentsModel');

			$ids = $this->documentsModel->insertDocument($post['projectID'], $vouchers);
			$ids = implode(',', $ids);

			// $this->projectsModel->updateDocuments($pid, $ids);
			$data['voucher'] = $ids;
		}

		if($this->expensesModel->insertExpense($data))
			redirect('/supervisor/viewProject/'.$post['projectID']);
		else
			redirect('/supervisor/viewProject/'.$post['projectID'].'?n=' . urlencode('Enter Expense'));
	}

	public function changePassword(){
		# code...

			$d1['currentPage'] = 'changePassword';
			$d1['username'] = $this->session->userdata('username');
			$this->load->view('super/header', $d1);
			$this->load->view('changePassword');
			$this->load->view('super/footer');


	}
	

}

?>