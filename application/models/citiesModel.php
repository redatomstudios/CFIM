<?php


class CitiesModel extends CI_Model{

	public function __construct(){
		parent::__construct();
	}

	public function getCities(){
		$this->db->select('id, name');
		return $this->db->get('cities')->result_array();
	}

	public function insertCity($name){
		$this->db->insert('cities', array('name' => $name));
		return $this->db->insert_id();
	}
}