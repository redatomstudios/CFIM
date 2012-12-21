<?php

class SectorsModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
		$this->db->flush_cache();
	}
	
	public function getSectors(){
		# code...
		$this->db->select('name');
		$query = $this->db->get_where('sectors',array('subsectorOf' => 0));
		return $query->result_array();
	}

	public function getSubsectors($sector){

		$this->db->select('name');
		if($sector == 0)
			$query = $this->db->get_where('sectors','subsectorOf != 0');
		else
			$query = $this->db->get_where('sectors',array('subsectorOf' => $sector));
		return $query->result_array();
	}

	public function insertSector($name){
		# code...
		$query = $this->db->insert('sectors', array('name' => $name, 'subsectorOf' => 0));
		return $query;
	}

	private function getSectorID($sector){
		# code...
		$query = $this->db->select('id');
		$query = $this->db->get_where('sectors', array('name' => $sector));
	}

	public function insertSubsector($name, $subsectorOf){
		# code...
		$query = $this->db->insert('sectors', array('name' => $name, 'subsectorOf' => getSectorID($subsectorOf)));

		return $query;
	}
}