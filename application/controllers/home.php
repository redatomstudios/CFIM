<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index(){

		// echo "Rank: ".$this->session->userdata('rank') ;
		if($this->session->userdata('rank') == 1)
			redirect('/supervisor');
		elseif($this->session->userdata('rank') == 2)
			redirect('/admin');
		elseif($this->session->userdata('rank') == 3)
			redirect('/member');
		elseif($this->session->userdata('rank') == 4)
			redirect('/finance');
		else
			redirect('login');

	}

	public function logout(){
		# code...
		$this->session->sess_destroy();
		redirect('/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */