<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Language Class
 *
 * @author marc
 *
 */
class Language extends CI_Controller
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
		$this->english();
	}
	
	public function english()
	{
		$this->lang->load( 'labels', 'english' );
		
		$cookie = array(
				'name'   => 'LANGUAGE',
				'value'  => 'english',
				'expire' => 604800
		);
		
		$this->input->set_cookie( $cookie );
		
		header( "location: ".$_GET["ref"] );
	}
	
	public function catalan()
	{
		//$this->lang->load( 'labels', 'catalan' );
		
		$cookie = array(
				'name'   => 'LANGUAGE',
				'value'  => 'catalan',
				'expire' => 604800
		);
		
		$this->input->set_cookie($cookie);
		
		header("location: ".$_GET["ref"]);
	}
}