<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Home Class
 *
 * @author marc
 *
 */
class Home extends MY_Controller
{
	/**
	 * Constructor method
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	// -----------------------------------------------------------------------
	
	/**
	 * index method
	 *
	 * @access public
	 */
	public function index()
	{
		redirect( 'home/login' );
	}

	// --------------------------------------------------------------------
	
	/**
	 * login method
	 *
	 * @access public
	 */
	public function login()
	{	
		$this->load->helper( array( 'form' ) );
		
		$this->_set_form_values();
		
		if( $this->input->post() ) {			
			$this->_set_form_rules();
			
			if( $this->form_validation->run() ) {
				$data = $this->_get_form_values();
			
				if( $this->_check_login( $data ) ) {
					redirect( '/../admin' );
				}
			}
		}
	
		$this->_load_view( 'index_view' );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * logout method
	 *
	 * @access public
	 */
	public function logout()
	{	
		$this->ion_auth->logout();
		
  		redirect( 'home/login', 'refresh' );
	}

	// --------------------------------------------------------------------
	
	/**
	 * _check_login method
	 *
	 * @access public
	 */
	private function _check_login( $data )
	{
		$login = $this->ion_auth->login(
				$data['login'], $data['password'], FALSE);//$data['remember'] );
		
		if( $login ) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	// --------------------------------------------------------------------

	/**
	 * _get_form_values method
	 *
	 * @access private
	 * @return array
	 */
	private function _get_form_values()
	{
		$data['login']		= $this->input->post( 'login' );
		$data['password']	= $this->input->post( 'password' );
		$data['remember']	= $this->input->post( 'remember' ) ? 1 : 0;

		return $data;
	}
	
	// --------------------------------------------------------------------

	/**
	 * _set_form_values method
	 *
	 * @access private
	 * @param array
	 */
	private function _set_form_values( $data = array() )
	{
		$this->data['field']['login']		= 'admin@admin.com';
		$this->data['field']['password']	= 'password';
		$this->data['field']['remember']	= 1;
		
		if( $this->input->post() ) {
			$this->data['field'] = array_merge( $this->data['field'], $this->input->post() );
		}
		
		$this->data['field'] = array_merge( $this->data['field'], $data );
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _set_form_rules method
	 *
	 * @access private
	 */
	private function _set_form_rules()
	{
		$this->load->library( array( 'form_validation' ) );
		
		$this->form_validation->set_rules(
				'login',
				'Login',
				'trim|required'
		);
		
		$this->form_validation->set_rules(
				'password',
				'Password',
				'trim|required'
		);
		
		$this->form_validation->set_rules(
				'remember',
				'Remember me',
				'integer'
		);
	}
}