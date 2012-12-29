<?php

class TitlesModel extends CI_Model{

	public function __construct(){
		# code...
		$this->db->flush_cache();
	}
	
	public function getTitles(){
		# code...
		$query = $this->db->get('jobtitles');
		return $query->result_array();
	}

	public function insertTitle($name){
		$this->db->insert('jobtitles', array('name' => $name));
		return $this->db->insert_id();
	}
}