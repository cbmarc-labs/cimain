<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Alert
 * 
 * Alert library
 * 
 * @author marc
 *
 */
class Alert
{
	private $_CI;
	private $_type;
	private $_message;

	/**
	 * Constructor method
	 */
	function __construct()
	{
		$this->_CI =& get_instance();
		
		$this->_CI->load->library( array( 'session' ) );
	}
	
	// -----------------------------------------------------------------------
	
	/**
	 * set method
	 *
	 * @access public
	 */
	function set( $type, $message, $flash = FALSE )
	{
		if($flash) {
			$this->_CI->session->set_flashdata( 'type', $type );
			$this->_CI->session->set_flashdata( 'message', $message );
		}
		
		$this->_type = $type;
		$this->_message = $message;
	}
	
	// -----------------------------------------------------------------------
	
	/**
	 * get method
	 *
	 * @access public
	 */
	function get()
	{
		if( $this->_CI->session->flashdata( 'type' ) ) {
			$this->_type = $this->_CI->session->flashdata( 'type' );
			$this->_message = $this->_CI->session->flashdata( 'message' );
		}
		
		if( empty( $this->_message ) ) {
			return FALSE;
		}
		
		return array( "type" => $this->_type, "message" => $this->_message );
	}	
}