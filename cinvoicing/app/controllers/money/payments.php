<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Index Class
 * 
 * @author marc
 *
 */
class Payments extends MY_Controller {
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Index method
	 *
	 * @access public
	 */
	public function index()
	{
		$this->_load_view('index_view');
	}
	
}