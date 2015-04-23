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
		$this->load->helper( array( 'form' ) );
		
		if( $this->input->post() ) {
			redirect( '/../admin' );
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
		//$this->auth_lib->logout();
		
		redirect( 'home' );
	}
}