<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  MY_Controller
* 
*/

class MY_Controller extends CI_Controller {
	
	var $data = array();
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		
		if(!logged_in())
			redirect('auth');
		
		$this->load->helper('message');
		$this->load->library(array('message'));
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _load_view method
	 *
	 * @access protected
	 */
	protected function _load_view($view)
	{
		$dir = $this->router->fetch_directory();
		$cls = $this->router->fetch_class();
			
		$this->load->view('header_view');
		$this->load->view('nav_view');
		$this->load->view('breadcrumb_view');
		$this->load->view($dir . $cls . '/' . $view, $this->data);
		$this->load->view('footer_view',array(
				'type'=>$this->message->get_type(), 
				'message'=>$this->message->get_message()));
	}
}