<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends User_Controller {

	public function index()
	{
		$data['content'] = 'welcome_message';
		$this->load->view('templates/default_template', $data);
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */