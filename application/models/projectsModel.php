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

	public function getDiscussionDates(){
		$this->db->select('DISTINCT(discussionDate), id');
		$this->db->order_by("discussionDate", "asc");
		$res = $this->db->get('projects');
		// echo $this->db->last_query();
		if($res->num_rows() > 0){
			$res = $res->result_array();
			foreach ($res as $row) {
				$r[$row['discussionDate']] = $row['discussionDate'];
			}

			return $r;
		}

		return FALSE;
		# code...
	}

	public function getProjects(){
		# code...
		$projects = $this->db->get('projects');
		if($projects->num_rows() > 0)
			return $projects->result_array();
		return FALSE;
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
			'sectorId' => ($data['sector']),
			'subsectorId' => ($data['subsector']),
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
			//echo "<br>".$this->db->last_query();
			
		}

		//Updating project field in team leader
		$this->db->where('id', $data['leader']);
		$this->db->set('projects', 'concat(projects, ",'.$id.'")', FALSE);
		$this->db->update('members');

		// echo "<br>".$this->db->last_query();
		return $id;
	}

	public function updateProject($data){
		# code...
		$id = $data['id'];

		// echo "<pre>";
		// print_r($data);

		$subordinates = '';
		foreach($data['projectMembers'] as $value) {
			$subordinates .= $value . ',';
		}
		if($subordinates != NULL)
			$subordinates = trim($subordinates, ',');

		$v = array(
			'name' => $data['name'],
			'leaderId' => $data['leader'],
			'sectorId' => ($data['sector']),
			'subsectorId' => ($data['subsector']),
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
		
		$this->db->where(array('id' => $id));
		$this->db->update('projects', $v);
		// echo $this->db->last_query();

		

		//Updating project fields in team members
		foreach ($data['projectMembers'] as $value) {
			# code...
			//Check projects column in member table
			$this->db->select('projects');
			$res = $this->db->get_where('members', array('id' => $value));
			$projs = explode(',', $res->row()->projects);
			if(!in_array($id, $projs)){

				// echo "<br> Adding $id to members table of member $value";		//UNCOMMENT
				$this->db->where('id', $value);
				$this->db->set('projects', 'concat(projects, ",'.$id.'")', FALSE);
				$this->db->update('members');
				// echo "<br>".$this->db->last_query();
			}
			
		}

		//Updating project field in team leader
		$this->db->select('projects');
		$res = $this->db->get_where('members', array('id' => $data['leader']));
		$projs = explode(',', $res->row()->projects);
		if(!in_array($id, $projs)){

			// echo "<br> Adding $id to members table of member " . $data['leader'];		//UNCOMMENT
			$this->db->where('id', $data['leader']);
			$this->db->set('projects', 'concat(projects, ",'.$id.'")', FALSE);
			$this->db->update('members');
		}

		// echo "<br>".$this->db->last_query();
		return $id;
	}

	public function updateDocuments($pid, $ids){
		# code...
		$this->db->where('id', $pid);
		$this->db->set('documents', 'concat(documents, ",'.$ids.'")', FALSE);
		$this->db->update('projects');
	}

	public function deleteDocument($projectId, $documentId){
		# code...
		$this->db->select('documents');
		$res = $this->db->get_where('projects', array('id' => $projectId));
		$docs = $res->row()->documents;
		$csv = str_replace($documentId, '', $docs);
    	$arr = explode(',', $csv);
    	$arr = array_filter($arr);
    	$csv = implode(',', $arr);
    	// $csv;
    	$this->db->where('id', $projectId);
    	$this->db->update('projects', array('documents' => $csv));
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
		
		// print_r($data);
		$where = array();
		if((isset($data['name'])) && ($data['name'] != 0)){
			$where['id'] = $data['name'];
		}
		else{
			if(isset($data['sector']) && ($data['sector'] != 0))
				$where['sectorId'] = $data['sector'];

			if(isset($data['subsector']) && ($data['subsector'] != 0))
				$where['subsectorId'] = $data['subsector'];

			if(isset($data['province']) && ($data['province'] != 0))
				$where['geoRegion'] = $data['province'];

			if(isset($data['city']) && ($data['city'] != 0))
				$where['city'] = $data['city'];

			if(isset($data['discussionDate']) && ($data['discussionDate'] != ''))
				$where['discussionDate'] = $data['discussionDate'];

			if(isset($data['status']) && (ctype_alpha($data['status'])))
				$where['status'] = $data['status'];

			if(isset($data['leader']) && ($data['leader'] != 0))
				$where['leaderId'] = $data['leader'];
		}


		// echo "<pre>";
		// print_r($where);
		// echo $data['status'];
		// if($data['status'] != 0)
		// 	echo "Status not 0";
		$ret = $this->db->get_where('projects', $where);
		if($ret->num_rows() > 0){
			// echo $this->db->last_query();
			return $ret->result_array();
		}

		return FALSE;
	}

	public function getInvestedProjectsOfLeader($memberId){
		# code...
		$this->db->select('p.id, p.name, c.id, c.body, c.timestamp');
		$this->db->from('projects p');
		$this->db->join('comments c', 'c.projectId=p.id');
		$this->db->where('p.leaderId', $memberId);
		$this->db->where('p.status', 'Invested');
		$this->db->order_by('c.timestamp desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getInvestedProjects($memberId){
		# code...

	}

}