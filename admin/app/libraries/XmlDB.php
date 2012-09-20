<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * XmlDB
 * 
 * XmlDB library
 * 
 * @author marc
 *
 */
class XmlDB {
	
	private $CI;
	private $_error;

	function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->config('app');
		$this->CI->load->helper('language');
	}
	
	function get($filename, $id = NULL)
	{
		$arr = FALSE;
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE) {
			if($id == NULL) {
				foreach($xml->item as $node)
					$arr[] = get_object_vars($node);
			
			} else {
				foreach($xml->item as $node) {
					if($node->id == $id) {
						$arr = get_object_vars($node);
						
						break;
					}
				}
				
				if($arr === FALSE)
					$this->set_error('xmldb_item_not_found');
			}
		}
		
		return $arr;
	}
	
	function insert($filename, $data)
	{
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE) {
			$newItem = $xml->addChild("item");
			
			if(!$data['id'])
				$data['id'] = uniqid();
		
			foreach($data as $key=>$value)
				$newItem->addChild($key, $value);
		
			$xml = $this->save_xml_file($filename, $xml);
		}
		
		return $xml;
	}
	
	function update($filename, $data)
	{
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE) {
			$found = FALSE;
			foreach($xml->item as $node) {
				if($node->id == $data['id']) {
					$found = TRUE;
					break;
				}
			}
			
			if($found === TRUE) {
				foreach($data as $key=>$value)
					$node->$key = $value;
				
				$xml = $this->save_xml_file($filename, $xml);
			} else {
				$this->set_error('xmldb_item_not_found');
				$xml = FALSE;
			}
		}
		
		return $xml;
	}
	
	function save($filename, $data)
	{	
		$result = TRUE;
		
		if($data['id']) {
			$result = $this->update($filename, $data);
			
		} else {
			$result = $this->insert($filename, $data);
		}
		
		return $result;
	}
	
	function delete($filename, $id)
	{
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE) {
			$found = FALSE;
			
			foreach($xml->item as $node) {
				if ($node->id == $id) {				
					$found = TRUE;
					break;
				}
			}
			
			if($found) {
				$dom = dom_import_simplexml($node);
				$dom->parentNode->removeChild($dom);
				
				$xml = $this->save_xml_file($filename, $xml);
			} else {
				$this->set_error('xmldb_item_not_found');
				$xml = FALSE;
			}
		}
		
		return $xml;
	}
	
	function create($filename)
	{
		$file = $this->get_file($filename);
		
		$xmlstr = '<?xml version="1.0"?><data></data>';
		$xml = new SimpleXMLElement($xmlstr);
		$xml->asXML($file);
	}
	
	function load_xml_file($filename)
	{
		$file = $this->get_file($filename);
		$result = simplexml_load_file($file);
		
		if($result === FALSE)
			$this->set_error('xmldb_load_error');
		
		return $result;
	}
	
	function save_xml_file($filename, $xml)
	{
		$file = $this->get_file($filename);
		$result = $xml->asXML($file);
		
		if($result === FALSE)
			$this->set_error('xmldb_save_error');
		
		return $result;
	}
	
	function get_file($file)
	{
		return $this->CI->config->item('data_path') . $file . '.xml';
	}
	
	/**
	 * Set error messages
	 *
	 * @param string $error
	 * @return
	 */
	function set_error($error)
	{
		$this->_error = lang($error);
	}
	
	/**
	 * Get error messages
	 * 
	 * @return	string
	 */
	function get_error()
	{
		return $this->_error;
	}
	
}