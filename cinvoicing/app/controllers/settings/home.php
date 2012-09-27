<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Index Class
 * 
 * @author marc
 *
 */
class Home extends MY_Controller {
	
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
		redirect('settings/messages');
	}
	
}