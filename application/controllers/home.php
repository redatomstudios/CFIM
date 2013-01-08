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
		switch($this->session->userdata('rank'))
		{
			case 1:
				{
					redirect('/supervisor?n=Login%20Successful^1');
				}
				break;
			case 2:
				{
					redirect('/admin?n=Login%20Successful^1');	
				}
				break;
			case 3:
				{
					redirect('/member?n=Login%20Successful^1');	
				}
				break;
			case 4:
				{
					redirect('/finance?n=Login%20Successful^1');
				}
				break;
			default:
				{
					redirect('login?n=' . urlencode('Please login to continue') . '^0');
				}
		}
	}

	public function logout(){
		# code...
		$this->session->sess_destroy();
		redirect('/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
