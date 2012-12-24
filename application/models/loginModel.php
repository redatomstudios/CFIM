<?php

class LoginModel extends CI_Model{

	public function insertCaptcha($par){
		# code...
		$data = array(
		    'captcha_time'	=> $par['time'],
		    'ip_address'	=> $par['ip'],
		    'word'	 => $par['word']
		    );

		$query = $this->db->insert_string('captcha', $data);
		return $this->db->query($query);
	}

	public function deleteCaptchas(){
		# code...
		// First, delete old captchas
		$expiration = time()-7200; // Two hour limit
		return $this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	
	}

	public function checkCaptcha($word, $ip){
		# code...
		$expiration = time()-7200;
		$this->db->select('count(*) as count');
		$query = $this->db->get_where('captcha', array('word' => $word, 'ip_address' => $ip, 'captcha_time >' => $expiration));
		$row = $query->row();

		if ($row->count == 0)
			return FALSE;
		return TRUE;
	}

	public function loginCheck($username, $passcode){
		# code...

		$this->db->select('id, rank');
		$query = $this->db->get_where('members', array('username' => $username, 'password' => sha1($passcode)));
		if($query->num_rows() > 0){
			// echo $query->row()->rank;
			$this->session->set_userdata(array(
								'id' => $query->row()->id,
								'username' => $username,
								'rank' => $query->row()->rank ));
			return $query->row()->rank;
		}

		return FALSE;

	}
}

?>