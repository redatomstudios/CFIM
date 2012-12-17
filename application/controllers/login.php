<?php

class Login extends CI_Controller {

	public function index(){

		$this->load->helper('captcha');


		$vals = array(
		    'img_path'	 => base_url().'captcha/',
		    'img_url'	 => $_SERVER['HTTP_HOST'].base_url().'captcha/',
		    );

		$cap = create_captcha($vals);
		$data['cap'] = $cap['image'];
		echo $cap['image'];
		
		if($post = $this->input->post())
			redirect('home');
		$this->load->view('login',$data);

	}

	

}

?>