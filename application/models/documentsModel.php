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
			echo "<br>";
			$this->db->insert('documents', $data);
			$ids[] = $this->db->insert_id();
		}
		return $ids;
	}

}
?>