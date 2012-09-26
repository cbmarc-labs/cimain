<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	private $content_data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url', 'message'));
		$this->load->library(array('auth_lib', 'xml_db'));
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
		
		$result = $this->xml_db->get('users', 
				array('login'=>$login, 'password'=>md5($password)));
				
		if(!$result) {
			$error = $this->xml_db->get_error();
			
			if(!$error)
				$error = lang('auth_incorrect');
				
			$this->form_validation->set_message('_check_login', $error);
			
			set_error($error);
				
			return FALSE;
		}
		
		$this->auth_lib->login($login);
		set_success(lang('auth_success'));
		
		return TRUE;
	}
	
	public function logout() {
		set_success(lang('auth_logout'));
		$this->auth_lib->logout();
		
		redirect('auth/login');
	}
	
	private function _load_view($view) {
		$this->load->view('header_view');
		$this->load->view($view, $this->content_data);
		$this->load->view('footer_view');		
	}
	
}