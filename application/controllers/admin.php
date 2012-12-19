<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('adminModel');
		$this->load->model('membersModel');
	}

	public function index(){

		echo anchor('admin/addMember', 'Add a new member');
		echo "<br>";
		echo anchor('admin/editMember', 'Edit member');
	}

	public function addMember(){
		# code...
		if($post = $this->input->post()){
			$this->membersModel->insertMember($this->input->post());
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
			$data['subordinates'] = $subordinates;
			$data['titles'] = $titles;
			if($this->load->view('admin/addMember',$data))
				redirect('admin');
			echo "Member Not Added!! Error in values!!";
		}
	}

	public function editMember(){
		if(!$this->input->post()){

			$res = $this->membersModel->getMemberUsernames();
			foreach ($res as $row) {
				$usernames[$row['id']] = $row['username'];
			}
			$data['usernames'] = $usernames;

			$this->load->view('admin/chooseMember', $data);
		}
		elseif($this->input->post('usernames')){
			echo "test";
		}
	}

}