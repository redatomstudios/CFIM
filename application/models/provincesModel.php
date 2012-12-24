<?php


class ProvincesModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function getProvinces(){
		# code...
		$this->db->select('id, name');
		return $this->db->get('provinces')->result_array();
	}
}