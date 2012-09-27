<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Myurl Helpers
 *
 */

// ------------------------------------------------------------------------

/**
 * redirect_current_controller
 *
 * Redirect to current url class
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('redirect_current_controller'))
{
	function redirect_current_controller($method = '')
	{
		$CI =& get_instance();
		
		$dir = $CI->router->fetch_directory();
		$cls = $CI->router->fetch_class();
		
		redirect($dir + $cls + $method);
	}
}