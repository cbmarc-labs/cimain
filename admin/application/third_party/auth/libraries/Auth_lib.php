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

	function __construct()
	{
		$this->CI =& get_instance();
		log_message('debug', 'Auth_lib: library initialized.');
		
		$this->CI->load->config('auth');
		$this->CI->load->library('session');
		$this->CI->load->helper('language');
		
		$this->CI->lang->load('auth');
	}
	
	/**
	 * Login user
	 * 
	 * @param string $login
	 * @param string $password
	 * @param boolean $remember
	 * @return boolean
	 */
	function login($login = null, $remember = null)
	{
		$this->CI->load->helper('cookie');
		
		if(!$this->logged_in())
		{
			$this->CI->session->set_userdata(
					array(
							'logged_in'=>TRUE,
							'login'=>$login
					)
			);
			
			if($remember)
			{
				set_cookie(array(
						'name'=>$this->CI->config->item('auth_cookie_name'),
						'value'=>'auth','expire'=>31*24*60*60));
			}
			
			return TRUE;
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
		
		$this->CI->session->set_userdata(array('logged_in'=>'', 'login'=>''));
		$this->CI->session->sess_destroy();
	}
	
	function get_login()
	{
		return $this->CI->session->userdata('login');
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

}