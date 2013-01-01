<?php

class MembersModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
		$this->db->flush_cache();
	}

	public function getMembers(){
		# code...
		return $this->db->get('members')->result_array();
	}

	public function getMember($id){
		# code...
		$res = $this->db->get_where('members', array('id' => $id));
		if($res->num_rows() > 0)
			return $res->row();
		return FALSE;
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
		return $this->db->insert('members', $data);
	}

	public function updateMember($memberId, $data){
		// echo "<pre>";
		// print_r($data);
		$this->db->where('id', $memberId);
		$this->db->update('members', $data);
		// echo $this->db->last_query();
		return $memberId;
	}

	public function getMemberUsernames(){
		$this->db->select('id, username');
		$query = $this->db->get_where('members', "rank in (2,3)");
		return $query->result_array();
	}

	public function getProjects($memberId, $status = ''){
		# code...
		$this->db->select('projects');
		$ret = $this->db->get_where('members', array('id' => $memberId));
		if($ret->num_rows() > 0){
			$ret = $ret->row()->projects;
			$ret = trim($ret, ',');
			if($ret == NULL)
				return false;
			$this->db->flush_cache();
			if($status != ''){
				$this->db->where('status', $status);
			}
			$this->db->where('id IN ('. $ret .')');
			
			$projects = $this->db->get_where('projects');
			// echo $this->db->last_query();
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
	
	public function isMemberOf($memberId, $projectId){
		# code...
		$this->db->select('projects');
		$projects = $this->db->get_where('members', array('id' => $memberId))->row()->projects;
		$projects = explode(',', $projects);
		return in_array($projectId, $projects);
	}		
}