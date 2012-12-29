<?php


class DocumentsModel extends CI_Model{

	public function __construct(){
		# code...
		parent::__construct();
	}

	public function insertDocument($pid, $datas){
		# code...
		// print_r($data);
		foreach ($datas as $data) {
			$data['projectId'] = $pid;
			// echo "<br>";
			$this->db->insert('documents', $data);
			$ids[] = $this->db->insert_id();
		}
		return $ids;
	}

	public function getDocument($id){
		# code...
		$res = $this->db->get_where('documents', array('id' => $id));
		if($res->num_rows() > 0)
			return $res->row_array();
		return FALSE;
	}

}
?>