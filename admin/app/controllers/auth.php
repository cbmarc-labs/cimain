<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	private $heading = array();
	private $data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'auth'));
		$this->load->library('auth_lib');
		
		$this->heading['title'] = "User login";
	}
	
	public function index()
	{
		redirect('auth/login');
	}
	
	public function login()
	{
		if(logged_in())
			redirect('');
		
		$this->load->library('form_validation');
		
		$login = $this->input->post('login', TRUE);
		$password = $this->input->post('password', TRUE);
		$remember = $this->input->post('remember');
				
		$params = "{$login},{$password},{$remember}";
				
		$this->form_validation->set_rules(
				'login', lang('auth_form_login'), 
				"trim|xss_clean|callback__check_login[{$params}]");
		$this->form_validation->set_rules(
				'password', lang('auth_form_password'), 'trim|xss_clean');
		$this->form_validation->set_rules('remember', 
				lang('auth_form_remember'), 'integer');
		
		if($this->form_validation->run())
			redirect('');
		
		$this->_load_view('auth/login_form');
	}
	
	function _check_login($str = '', $params = '')
	{
		list($login, $password, $remember) = explode(',', $params);
		
		if(!$this->auth_lib->login($login, $password, $remember)) {
			$this->form_validation->set_message(
					'_check_login', $this->auth_lib->get_error());
			
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function logout() {
		$this->auth_lib->logout();
		
		redirect('auth/login');
	}
	
	private function _load_view($view) {
		$this->load->view('auth/header_view', $this->heading);
		$this->load->view($view, $this->data);
		$this->load->view('auth/footer_view');		
	}
	
}