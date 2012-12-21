<?php


class ProvincesModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function getProvinces(){
		# code...
		$this->db->select('name');
		return $this->db->get('provinces')->result_array();
	}
}