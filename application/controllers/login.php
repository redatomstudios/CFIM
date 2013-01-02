<?php

class Login extends CI_Controller {

	public function __construct(){
		# code...
		parent::__construct();
		$this->load->model('loginModel');
	}
	public function index(){
		if($this->session->userdata('rank') == 1)
			redirect('/supervisor');
		elseif($this->session->userdata('rank') == 2)
			redirect('/admin');
		elseif($this->session->userdata('rank') == 3)
			redirect('/member');
		elseif($this->session->userdata('rank') == 4)
			redirect('/finance');

		$this->load->helper('captcha');
		$this->load->helper('string');
		

		$vals = array(
				'word'		 => random_string('alpha', 6),
                'img_path'	 => './captcha/',
                'img_url'	 => base_url().'captcha/',
                'font_path'  => './system/fonts/krist.ttf',
                'size'  => '20',
                'img_width'	 => '270',
                'img_height' => '50',
                'border' => 1, 
                'expiration' => 7200
                );

		$cap = create_captcha($vals);
		$cap['ip'] = $this->input->ip_address();
		$this->loginModel->insertCaptcha($cap);

		$data['cap'] = $cap['image'];
		$this->load->view('login',$data);

	}

	public function doLogin(){
		# code...
		$post = $this->input->post();
		$word = $post['captcha'];
		$ip = $this->input->ip_address();
		$this->loginModel->deleteCaptchas();
		if($this->loginModel->checkCaptcha($word, $ip))
			if($this->loginModel->loginCheck($post['username'], $post['password']))
				redirect('/home/index');
			else
				redirect('/login?n=' . urlencode('Login failed.') . '^0');

		else
			redirect('/login?n=' . urlencode('Incorrect Captcha.') . '^0');
	}

	

	

}

?>