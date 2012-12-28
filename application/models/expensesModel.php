<?php

class ExpensesModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function insertExpense($data){
		# code...
		return $this->db->insert('expenses', $data);
	}

	public function getExpenses($projectId){
		# code...
		$ret = $this->db->get_where('expenses', array('projectId' => $projectId, 'expenses !=' => NULL));
		if($ret->num_rows() > 0)
			return $ret->result_array();
		return FALSE;
	}

	public function getUpdates($projectId){
		# code...
		$ret = $this->db->get_where('expenses', array('projectId' => $projectId, 'expenses' => NULL));
		if($ret->num_rows() > 0)
			return $ret->result_array();
		return FALSE;
	}

}

?>