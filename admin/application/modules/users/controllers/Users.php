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
}