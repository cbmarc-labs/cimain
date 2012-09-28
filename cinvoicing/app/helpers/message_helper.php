<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Message Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/xml_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('set_success'))
{
	function set_success($message, $flash = FALSE)
	{
		$CI =& get_instance();
		$CI->load->library(array('message'));
		
		$CI->message->set_message('success', $message, $flash);
	}
}

if ( ! function_exists('set_info'))
{
	function set_info($message, $flash = FALSE)
	{
		$CI =& get_instance();
		$CI->load->library(array('message'));
		
		$CI->message->set_message('info', $message, $flash);
	}
}

if ( ! function_exists('set_warning'))
{
	function set_warning($message, $flash = FALSE)
	{
		$CI =& get_instance();
		$CI->load->library(array('message'));
		
		$CI->message->set_message('warning', $message, $flash);
	}
}

if ( ! function_exists('set_error'))
{
	function set_error($message, $flash = FALSE)
	{
		$CI =& get_instance();
		$CI->load->library(array('message'));
		
		$CI->message->set_message('error', $message, $flash);
	}
}

// ------------------------------------------------------------------------

/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */