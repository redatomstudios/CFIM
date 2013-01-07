<?php

class SectorsModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
		$this->db->flush_cache();
	}
	
	public function getName($id){
		# code...
		$this->db->select('name');
		$ret = $this->db->get_where('sectors', array('id' => $id));
		if($ret->num_rows() >0)
			return $ret->row()->name;
		return FALSE;
	}
	
	public function getSectors(){
		# code...
		$this->db->select('id, name');
		$query = $this->db->get_where('sectors',array('subsectorOf' => 0));
		return $query->result_array();
	}

	public function getSubsectors($sector){

		$this->db->select('id, name, subsectorOf');
		if($sector == 0)
			$query = $this->db->get_where('sectors','subsectorOf != 0');
		else
			$query = $this->db->get_where('sectors',array('subsectorOf' => $sector));
		return $query->result_array();
	}

	private function getSectorId($sector){
		$this->db->select('id');
		$query = $this->db->get_where('sectors', array('name' => $sector));
		return $query->row()->id;
	}

	public function insertSector($name){
		$query = $this->db->insert('sectors', array('name' => $name));
		return $this->db->insert_id();
	}

	public function insertSubsector($name, $subsectorOf){
		// echo "<br>Name: $name <br>Subsector: $subsectorOf";
		$query = $this->db->insert('sectors', array('name' => $name, 'subsectorOf' => $subsectorOf));
		return $this->db->insert_id();
	}
}