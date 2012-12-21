<?php


class CitiesModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function getCities(){
		# code...
		$this->db->select('name');
		return $this->db->get('cities')->result_array();
	}

	public function insertCity($name){
		# code...
		return $this->db->insert('cities', array('name' => $name));
	}
}