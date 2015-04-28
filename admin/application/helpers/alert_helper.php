<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Alert Helpers
 */

// ------------------------------------------------------------------------

if ( ! function_exists( 'set_success' ) ) {
	function set_success( $message, $flash = FALSE ) {
		$CI =& get_instance();
		$CI->load->library( array( 'alert' ) );
		
		$CI->alert->set( 'success', $message, $flash );
	}
}

if ( ! function_exists( 'set_info' ) ) {
	function set_info( $message, $flash = FALSE ) {
		$CI =& get_instance();
		$CI->load->library( array( 'alert' ) );
		
		$CI->alert->set( 'info', $message, $flash );
	}
}

if ( ! function_exists( 'set_warning' ) ) {
	function set_warning( $message, $flash = FALSE ) {
		$CI =& get_instance();
		$CI->load->library( array( 'alert' ) );
		
		$CI->alert->set( 'warning', $message, $flash );
	}
}

if ( ! function_exists( 'set_error' ) ) {
	function set_error( $message, $flash = FALSE ) {
		$CI =& get_instance();
		$CI->load->library( array( 'alert' ) );
		
		$CI->alert->set( 'danger', $message, $flash );
	}
}

if ( ! function_exists( 'get_alert' ) ) {
	function get_alert() {
		$CI =& get_instance();
		$CI->load->library( array( 'alert' ) );
		
		return $CI->alert->get();
	}
}

// ------------------------------------------------------------------------

/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */