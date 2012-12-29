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

	public function getName($id){
		# code...
		$this->db->select('name');
		$ret = $this->db->get_where('provinces', array('id' => $id));
		return $ret->row()->name;
	}

	public function insertProvince($name){
		$this->db->insert('provinces', array('name' => $name));
		echo $this->db->last_query();
		return $this->db->insert_id();
	}

}