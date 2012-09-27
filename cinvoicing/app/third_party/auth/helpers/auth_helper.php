<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Auth Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/xml_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('logged_in'))
{
	function logged_in()
	{
		$CI =& get_instance();
		
		$CI->load->library('auth_lib');
		
		return (bool) $CI->auth_lib->logged_in();
	}
}

// ------------------------------------------------------------------------

/* End of file xml_helper.php */
/* Location: ./system/helpers/xml_helper.php */