<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mylibrary {

    public function loginCheck(){
    	$th =& get_instance();
    	if($th->session->userdata('username') == FALSE)
    		return FALSE;
   		return TRUE;

    }

    public function changePassword($memberId, $old, $new){
    	# code...
    }
}