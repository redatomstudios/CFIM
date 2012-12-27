<?php

class MembersModel extends CI_Model{

	public function __construct(){
		# code...
		$this->db->flush_cache();
	}

	public function getMembers(){
		# code...
		return $this->db->get('members')->result_array();
	}

	public function getMember($id){
		# code...
		return $this->db->get_where('members', array('id' => $id))->row();
	}

	public function getSubordinates(){
		# code...
		$this->db->select('id, memberName');
		$query = $this->db->get_where('members', "rank in (3,4)");
		return $query->result_array();
	}

	public function getTeamMembers(){
		# code...
		$this->db->select('id, memberName');
		$query = $this->db->get_where('members', "rank = 3");
		return $query->result_array();
	}

	public function insertMember($data){
		# code...

		$subordinates = '';
		foreach ($data['subordinates'] as $value) {
			# code...
			$subordinates .= $value.',';
		}
		if($subordinates != NULL)
			$subordinates = substr($subordinates, 0, strlen($subordinates)-1);

		$insert = array(
			'memberName' => $data['name'],
			'username' => $data['username'],
			'password' => sha1($data['password']),
			'rank' => $data['rank'],
			'titleId' => $data['title'],
			'status' => $data['status'],
			'subordinates' => $subordinates,
			'officeEmail' => $data['officeEmail'],
			'otherEmail' => $data['otherEmail'],
			'contactTel1' => $data['tel1'],
			'contactTel2' => $data['tel2']
			);
		
		return $this->db->insert('members', $insert);
	}

	public function updateMember($data){
		$subordinates = '';
		foreach ($data['subordinates'] as $value) {
			# code...
			$subordinates .= $value.',';
		}
		if($subordinates != NULL)
			$subordinates = substr($subordinates, 0, strlen($subordinates)-1);

		$insert = array(
			'memberName' => $data['name'],
			'username' => $data['username'],
			'password' => sha1($data['password']),
			'rank' => $data['rank'],
			'titleId' => $data['title'],
			'status' => $data['status'],
			'subordinates' => $subordinates,
			'officeEmail' => $data['officeEmail'],
			'otherEmail' => $data['otherEmail'],
			'contactTel1' => $data['tel1'],
			'contactTel2' => $data['tel2']
			);
		$this->db->where('id',$data['id']);
		return $this->db->update('members', $insert);
	}

	public function getMemberUsernames(){
		$this->db->select('id, username');
		$query = $this->db->get_where('members', "rank in (2,3)");
		return $query->result_array();
	}

	public function getProjects($memberId){
		# code...
		$this->db->select('projects');
		$ret = $this->db->get_where('members', array('id' => $memberId));
		if($ret->num_rows() > 0){
			$ret = $ret->row()->projects;
			$ret = trim($ret, ',');
			// echo $ret . "<br>";
			if($ret == NULL)
				return false;
			$this->db->flush_cache();
			$projects = $this->db->get_where('projects', 'id IN ('. $ret .')');
			return $projects->result_array();
		}
		
		return FALSE;
	}

	public function getName($id){
		# code...
		$this->db->select('memberName');
		$res = $this->db->get_where('members', array('id' => $id));
		return $res->row()->memberName;
	}

	
	public function checkVisibility($memberId, $projectId){
		# code...
		$this->db->select('projects');
		$res = $this->db->get_where('members', array('id' => $memberId));
		$projects = explode(',', $res->row()->projects);
		return in_array($projectId, $projects);
	}
		
}