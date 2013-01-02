<?php

class CommentsModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function insertComment($data){
		# code...
		return $this->db->insert('comments', $data);
	}

	public function getAllComments($projectId){
		$this->db->order_by('orderNumber', 'desc');
		$res = $this->db->get_where('comments', array('projectId' => $projectId));
		// echo "<br>". $this->db->last_query();
		return $res->result_array();
	}

	public function getComments($projectId, $limit = 0){

		$this->db->order_by('orderNumber', 'desc');
		if($limit != 0)
			$res = $this->db->get_where('comments', array('projectId' => $projectId, 'orderNumber REGEXP' => '^-?[0-9]+$'), $limit);
		else
			$res = $this->db->get_where('comments', array('projectId' => $projectId, 'orderNumber REGEXP' => '^-?[0-9]+$'));
		return $res->result_array();
	}

	public function agreeComment($orderNumber, $projectId, $memberId){
		# code...
		if(!$this->isAgree($orderNumber, $projectId, $memberId)){
			
			$this->db->where(array('projectId' => $projectId, 'orderNumber' => $orderNumber));
			$this->db->set('counter', 'concat(counter, ",'.$memberId.'")', FALSE);
			$this->db->update('comments');

			// echo $this->db->last_query() . "<br>";
		}
	}

	public function isAgree($orderNumber, $projectId, $memberId){
		$this->db->select('counter');
		$res = $this->db->get_where('comments', array('projectId' => $projectId, 'orderNumber' => $orderNumber));
		// echo $this->db->last_query() . "<br>";
		// $counter = $res->counter;
		if($res->num_rows() > 0){
			$res = $res->row()->counter;
			$members = explode(',', $res);
			return in_array($memberId, $members);
		}
		return FALSE;
	}

	public function getLatestComment($projectId){
		$this->db->select('timestamp');
		$this->db->limit(1);
		$this->db->order_by('timestamp', 'desc');
		$res = $this->db->get_where('comments', array('projectId' => $projectId));
		if($res->num_rows() > 0)
			return $res->row_array();
		return FALSE;
	}

	/*
	* If $root = '', it returns, the number of all comments in that project
	* Else if $root = 'root', it returns, the number of root comments
	* Else if $root = 'followup', it returns, the number of followup comments
	*/
	public function countComments($projectId, $root = '', $rootId = 0){
		# code...
		$this->db->select('count(`id`) AS count');
		$this->db->where('projectId', $projectId);
		if($root == 'root')
			$this->db->where('`orderNumber` REGEXP \'^[0-9]+$\'');
		elseif($root == 'followup'){
			if($rootId == 0)
				echo "Give the order number of the root comment";
			else
				$this->db->where('`orderNumber` REGEXP \'^'.$rootId.'.[0-9]+.[0-9]+$\'');
		}
		$res = $this->db->get('comments');
		return $res->row()->count;

	}
}
?>