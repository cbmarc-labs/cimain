<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Index Class
 * 
 * @author marc
 *
 */
class Index extends CI_Controller {
	
	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
	
		$this->load->helper(array('url'));
	}
	
	/**
	 * Index method
	 *
	 * @access public
	 */
	public function index()
	{
		redirect('users');
	}
	
}