<?php

class ProjectsModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function getProject($id){
		$res = $this->db->get_where('projects', array('id' => $id));
		return $res->row_array();
	}
	public function insertProject($data){
		# code...
		$subordinates = '';
		foreach($data['projectMembers'] as $value) {
			$subordinates .= $value . ',';
		}
		if($subordinates != NULL)
			$subordinates = trim($subordinates, ',');

		$v = array(
			'name' => $data['name'],
			'leaderId' => $data['leader'],
			'sectorId' => ($data['sector'] + 1),
			'subsectorId' => ($data['subsector'] + 1),
			'geoRegion' => $data['province'],
			'city' => $data['city'],
			'discussionDate' => $data['discussionDate'],
			'status' => $data['status'],
			'members' => $subordinates,
			'dealSize' => $data['dealSize'],
			'companyName' => $data['companyName'],
			'companyAddress' => $data['companyAddress'],
			'contactPerson' => $data['contactPerson'],
			'contactEmail' => $data['contactEmail'],
			'contactTel' => $data['contactTel']);

		$this->db->insert('projects', $v);
		// echo $this->db->last_query();
		$id = $this->db->insert_id();

		//Updating project fields in team members
		foreach ($data['projectMembers'] as $value) {
			# code...
			$this->db->where('id', $value);
			$this->db->set('projects', 'concat(projects, ",'.$id.'")', FALSE);
			$this->db->update('members');
			// echo "<br>".$this->db->last_query();
		}

		//Updating project field in team leader
		$this->db->where('id', $data['leader']);
		$this->db->set('projects', 'concat(projects, ",'.$id.'")', FALSE);
		$this->db->update('members');

		// echo "<br>".$this->db->last_query();
		return $id;
	}

	public function updateDocuments($pid, $ids){
		# code...
		$this->db->where('id', $pid);
		$this->db->set('documents', 'concat(documents, ",'.$ids.'")', FALSE);
		$this->db->update('projects');
	}

	public function getProjectNames(){
		# code...
		$this->db->select('id, name');
		$projects = array();
		foreach ($this->db->get('projects')->result_array() as $row) {
			# code...
			$projects[$row['id']] = $row['name'];
		}
		return $projects;
	}

	public function getLeaders(){

		$names = '';
		$this->db->select('leaderId');
		$ids = $this->db->get('projects')->result();
		foreach ($ids as $rows) {
			$id = $rows->leaderId;
			$this->db->select('memberName');
			$name = $this->db->get_where('members', array('id' => $id))->row()->memberName;
			$names[$id] = $name;
		}
		return $names;
	}

	public function searchProjects($data){
		# code...

		// $where = array(
		// 	'' => );
		// $this->db->get_where('projects', $where);

		// echo "asdsa<pre>";
		// print_r($data);
		$where = array();
		if($data['name'] != 0){
			$where['id'] = $data['name'];
		}
		else{
			if($data['sector'] != 0)
				$where['sectorId'] = $data['sector'];
			if($data['subsector'] != 0)
				$where['subsectorId'] = $data['subsector'];
			if($data['province'] != 0)
				$where['geoRegion'] = $data['province'];
			if($data['city'] != 0)
				$where['city'] = $data['city'];
			if($data['discussionDate'] != '')
				$where['discussionDate'] = $data['discussionDate'];
			if($data['status'] != 0)
				$where['status'] = $data['status'];
			if($data['leader'] != 0)
				$where['leaderId'] = $data['leader'];
		}

		// echo "<pre>";
		// print_r($where);
		return $this->db->get_where('projects', $where)->result_array();
	}

}