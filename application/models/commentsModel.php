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
}
?>