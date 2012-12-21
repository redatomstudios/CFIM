<?php

class ProjectsModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function insertProject($data){
		# code...
		$subordinates = '';
		foreach ($data['projectMembers'] as $value) {
			# code...
			$subordinates .= $value.',';
		}
		if($subordinates != NULL)
			$subordinates = substr($subordinates, 0, strlen($subordinates)-1);

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
	}
}