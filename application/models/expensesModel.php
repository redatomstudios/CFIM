<?php

class ExpensesModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function insertExpense($data){
		# code...
		if(isset($data['expense']))
			return $this->db->insert('expenses', $data);

		return FALSE;
	}

	public function insertUpdate($data){
		# code...
		if(!isset($data['expense']))
			return $this->db->insert('expenses', $data);

		return FALSE;
	}

	public function getExpenses($projectId){
		# code...
		$ret = $this->db->get_where('expenses', array('projectId' => $projectId, 'expense !=' => 0));
		if($ret->num_rows() > 0)
			return $ret->result_array();
		return FALSE;
	}

	public function getUpdates($projectId){
		# code...
		$ret = $this->db->get_where('expenses', array('projectId' => $projectId, 'expense' => 0));
		if($ret->num_rows() > 0)
			return $ret->result_array();
		return FALSE;
	}

	public function getAll($projectId){
		# code...
		$ret = $this->db->get_where('expenses', array('projectId' => $projectId));
		if($ret->num_rows() > 0)
			return $ret->result_array();
		return FALSE;
	}

	public function getAccumulatedExpense($projectId){
		# code...
		$this->db->select('SUM(`expense`) as sum');
		$res = $this->db->get_where('expenses', array('projectId' => $projectId));
		return $res->row()->sum;
	}

	public function getLatestFinancedProjects(){
		# code...
		$this->load->model('projectsModel');

		$this->db->select('projectId, max(`timestamp`) as max');
		$this->db->group_by('projectId DESC');
		$res = $this->db->get('expenses');


		$p = array();
		if($res->num_rows() > 0){
			$projects = $res->result_array();
			// print_r($projects);
			foreach ($projects as $project){
				# code...
				$pro = $this->projectsModel->getProject($project['projectId']);
				$pro['accumulatedExpense'] = $this->getAccumulatedExpense($project['projectId']);
				$p[] = $pro;
			}
		}
		return $p;
	}

	/**
	* Return project ids of all projects that have expenses
	**/
	public function getFinancedProjects(){
		# code...
		$this->db->select('DISTINCT(projectId) as id');
		$res = $this->db->get('expenses');
		if($res->num_rows() > 0)
			return $res->result_array();
		return FALSE;
	}

	public function checkExpense($projectId){
		# code...
		$this->db->select('count(id) as count');
		$res = $this->db->get_where('expenses', array('projectId' => $projectId, 'expense !=' => 0.00));
		if($res->row()->count > 0)
			return TRUE;
		return FALSE;
	}

	public function reviewExpense($data, $expenseId){
		# code...
		$this->db->where('id', $expenseId);
		if($res = $this->db->update('expenses', $data)){
			echo $this->db->last_query();
			return TRUE;
		}
		return FALSE;

	}
	
}



?>