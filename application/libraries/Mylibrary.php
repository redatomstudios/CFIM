<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Mylibrary {

    public function __construct()
    {
        # code...
        function replace($matches) {
            foreach ($matches as $match) {
                return "'";
            }
        }

    }

    public function loginCheck(){
    	$th =& get_instance();
    	if($th->session->userdata('username') == FALSE)
    		return FALSE;
   		return TRUE;

    }

    

    public function deleteFromCSV($csv, $value){
    	# code...
    	$csv = str_replace($value, '', $csv);
    	$arr = explode(',', $csv);
    	$arr = array_filter($arr);
    	$csv = implode(',', $arr);
    	return $csv;
    }

    
    public function escapeFunction($data){
        
        

        $data = preg_replace_callback('/\"/', 'replace', $data);
        return $data;
    }

   

}