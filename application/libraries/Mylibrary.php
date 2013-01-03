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

        function replaceQuotes($matches) {
            foreach ($matches as $match) {
                return "\\\"";
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

   public function escapeQuotes($data) {
        $data = preg_replace_callback('/\"/', 'replaceQuotes', $data);
        return $data;
   }

   public function uploader( $pid ){

        $th =& get_instance();

        if(!is_dir($_SERVER['DOCUMENT_ROOT'] . base_url(). 'resources/uploads/' . $pid))
                mkdir($_SERVER['DOCUMENT_ROOT'] . base_url(). 'resources/uploads/' . $pid);

        $th->load->library('upload');  // NOTE: always load the library outside the loop
        $th->total_count_of_files = count($_FILES['file']['name']);
        $data = array();
         /*Because here we are adding the "$_FILES['userfile']['name']" which increases the count, and for next loop it raises an exception, And also If we have different types of fileuploads */
        for($i=0; $i < $th->total_count_of_files; $i++){

            $_FILES['filename']['name']    = $_FILES['file']['name'][$i];
            $_FILES['filename']['type']    = $_FILES['file']['type'][$i];
            $_FILES['filename']['tmp_name'] = $_FILES['file']['tmp_name'][$i];
            $_FILES['filename']['error']       = $_FILES['file']['error'][$i];
            $_FILES['filename']['size']    = $_FILES['file']['size'][$i];

            $config['file_name']     = $_FILES['filename']['name'];
            $config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . base_url(). 'resources/uploads/' . $pid;
            $config['allowed_types'] = '*';
            $config['max_size']      = '0';
            $config['overwrite']     = FALSE;

            $th->upload->initialize($config);

            $error = 0;
            if($th->upload->do_upload('filename')){
                $uploadData = $th->upload->data();
                $arr = array(
                    'filename' => $uploadData['file_name'],
                    'size' => $uploadData['file_size']
                    );
                $data[] = $arr;
                $error += 0;
            }else{
                $error += 1;
                //echo $th->upload->display_errors();
            }
        }

        if($error > 0){ return FALSE; }else{ return $data; }
    }
}