<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mylibrary {

    public function loginCheck(){
    	$th =& get_instance();
    	$th->load->library('session');
    	if($th->session->userdata('username') == FALSE)
    		return FALSE;
    	else
    		return TRUE;

    }
}