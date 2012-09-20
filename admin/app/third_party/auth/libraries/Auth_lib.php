<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth
 * 
 * Authenticator library
 * 
 * @author marc
 *
 */
class Auth_lib {
	
	private $CI;
	private $_error;

	function __construct()
	{
		$this->CI =& get_instance();
		log_message('debug', 'Auth_lib: library initialized.');
		
		$this->CI->load->config('auth');
		$this->CI->load->library('session');
		$this->CI->lang->load('auth');
		$this->CI->load->helper('language');
	}
	
	/**
	 * Login user
	 * 
	 * @param string $login
	 * @param string $password
	 * @param boolean $remember
	 * @return boolean
	 */
	function login($login, $password, $remember)
	{
		$this->CI->load->helper('cookie');
		
		if($login == $this->CI->config->item('login')) {
			if($password == $this->CI->config->item('password')) {
				$this->CI->session->set_userdata(array('logged_in'=>TRUE));
				set_cookie(array('name'=>'auth','value'=>'auth','expire'=>31*24*60*60));
				return TRUE;
				
			} else {
				$this->set_error('auth_incorrect_password');
			}
			
		} else {
			$this->set_error('auth_incorrect_login');
		}
		
		return FALSE;
	}
	
	/**
	 * Logout user
	 * 
	 * @return void
	 */
	function logout()
	{
		$this->CI->load->helper('cookie');
		
		delete_cookie('auth');
		
		$this->CI->session->set_userdata(array('logged_in'=>''));
		$this->CI->session->sess_destroy();
	}
	
	/**
	 * Check if user logged in
	 * 
	 * @return boolean
	 */
	function logged_in()
	{
		return $this->CI->session->userdata('logged_in');
	}
	
	function set_error($error)
	{
		$this->_error = lang($error);
	}
	
	/**
	 * Get error messages
	 * 
	 * @return	string
	 */
	function get_error()
	{
		return $this->_error;
	}

}