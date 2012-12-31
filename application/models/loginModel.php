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
			$row = $query->row();
			$this->session->set_userdata(array(
								'id' => $row->id,
								'username' => $username,
								'rank' => $row->rank ));
			return $row->rank;
		}

		return FALSE;

	}

	public function changePassword($memberId, $old, $new){
        # code...
        $this->db->select('password');
        $oldPwd = $this->db->get_where('members', array('id' => $memberId))->row()->password;
        if(sha1($old) == $oldPwd){
            $this->db->where('id', $memberId);
            if($this->db->update('members', array('password' => sha1($new))))
                return TRUE;
            echo "Password Change Failed!!";
        }
        else
            return FALSE;
    }
}

?>