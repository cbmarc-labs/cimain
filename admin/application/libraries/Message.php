<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * XmlDB
 * 
 * XmlDB library
 * 
 * @author marc
 *
 */
class Message {
	
	private $CI;
	private $type = '';
	private $message = '';

	function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->library(array('session', 'message', 'auth_lib'));
	}
	
	function set_message($type, $message, $flash = FALSE)
	{
		if($flash) {
			$this->CI->session->set_flashdata('type', $type);
			$this->CI->session->set_flashdata('message', $message);
		}
		
		$this->type = $type;
		$this->message = $message;
		
		$this->CI->xml_db->insert(
				'messages',
				array(
						"date"=>date(DATE_ISO8601), 
						"login"=>$this->CI->auth_lib->get_login(),
						"section"=>uri_string(),
						"type"=>$this->type, 
						"message"=>$this->message)
				);
	}
	
	function get_type()
	{
		if($this->CI->session->flashdata('type'))
			$this->type = $this->CI->session->flashdata('type');
		
		return $this->type;		
	}
	
	function get_message()
	{
		if($this->CI->session->flashdata('message'))
			$this->message = $this->CI->session->flashdata('message');
		
		return $this->message;
	}
	
}