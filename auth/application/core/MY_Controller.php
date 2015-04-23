<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MY_Controller Class
 *
 * @author marc
 *
 */
class MY_Controller extends MX_Controller
{
	protected $data = array();
	
	/**
	 * Constructor method
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _load_view method
	 *
	 * @access protected
	 */
	protected function _load_view( $view )
	{		
		$this->load->view( 'header_view' );
		$this->load->view( $view, $this->data );
		$this->load->view( 'footer_view' );
	}
}