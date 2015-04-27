<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users Class
 *
 * @author marc
 *
 */
class Users extends MY_Controller
{
	/**
	 * Constructor method
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model( 'users_model' );
	}
	
	// -----------------------------------------------------------------------
	
	/**
	 * Index method
	 *
	 * @access public
	 */
	public function index()
	{
		$this->_load_view( 'index_view' );
	}

	// --------------------------------------------------------------------

	/**
	 * get_table method
	 *
	 * @access public
	 */
	public function get_table()
	{
		$result = $this->users_model->get_table();
			
		$this->output
			->set_content_type( 'application/json' )
			->set_output( json_encode( $result ) );
	}
}