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
}