<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * XmlDB
 * 
 * XmlDB library
 * 
 * @author marc
 *
 */
class Xml_db {
	
	private $CI;
	private $_error;

	function __construct()
	{
		$this->CI =& get_instance();
		
		$this->CI->load->config('app');
		$this->CI->load->helper('language');
	}
	
	function get($filename, $var = NULL)
	{
		$arr = FALSE;
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE) {
			
			// return all records
			if($var == NULL)
			{
				$arr = array();
				foreach($xml->item as $node)
					$arr[] = get_object_vars($node);
			
			// return by query key=>value
			}
			elseif(is_array($var))
			{
				foreach($xml->item as $node)
				{
					$match = TRUE;
					foreach($var as $key=>$value)
					{
						if(strcasecmp($node->$key,$value))
							$match = FALSE;
					}
					
					if($match === TRUE)
					{
						$arr[] = get_object_vars($node);
						break;
					}
				}
				
			// return by id
			} else {
				foreach($xml->item as $node)
				{
					if($node->id == $var)
					{
						$arr = get_object_vars($node);
						
						break;
					}
				}
				
				if($arr === FALSE)
					$this->set_error('xml_db_item_not_found');
			}
		}
		
		return $arr;
	}
	
	function insert($filename, $data)
	{
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE) {
			$newItem = $xml->addChild("item");
			
			$data['id'] = uniqid();
		
			foreach($data as $key=>$value)
			{
				$newItem->addChild($key, $value);
			}
			
			log_message('debug', 'Inserting(' . $filename . '): ' 
					. print_r($newItem, true));
			$xml = $this->save_xml_file($filename, $xml);
		}
		
		return $xml;
	}
	
	function update($filename, $data)
	{
		$xml = $this->load_xml_file($filename);
				
		if($xml !== FALSE) {
			$found = FALSE;
			foreach($xml->item as $node)
			{
				if($node->id == $data['id'])
				{
					$found = TRUE;
					break;
				}
			}
			
			if($found === TRUE) {
				foreach($data as $key=>$value)
				{
					$node->$key = $value;
				}
				
				log_message('debug', 'Updating(' . $filename . '): ' 
						. print_r($data, true));
				$xml = $this->save_xml_file($filename, $xml);
			}
			else
			{
				$this->set_error('xml_db_item_not_found');
				$xml = FALSE;
			}
		}
		
		return $xml;
	}
	
	function save($filename, $data)
	{	
		$result = TRUE;
		
		if(isset($data['id']))
		{
			$result = $this->update($filename, $data);
			
		}
		else
		{
			$result = $this->insert($filename, $data);
		}
		
		return $result;
	}
	
	function delete($filename, $id)
	{
		$xml = $this->load_xml_file($filename);
		
		if($xml !== FALSE)
		{
			$found = FALSE;
			
			foreach($xml->item as $node)
			{
				if ($node->id == $id)
				{				
					$found = TRUE;
					break;
				}
			}
			
			if($found) {
				$dom = dom_import_simplexml($node);
				$dom->parentNode->removeChild($dom);
				
				$xml = $this->save_xml_file($filename, $xml);
			}
			else
			{
				$this->set_error('xml_db_item_not_found');
				$xml = FALSE;
			}
		}
		
		return $xml;
	}
	
	function create($filename)
	{		
		$xmlstr = '<?xml version="1.0"?><data></data>';
		$xml = new SimpleXMLElement($xmlstr);
		
		return $this->save_xml_file($filename, $xml);
	}
	
	function load_xml_file($filename)
	{
		$file = $this->get_file($filename);
		$result = @simplexml_load_file($file);
		
		if($result === FALSE)
			$this->set_error('xml_db_load_error');
		
		return $result;
	}
	
	function save_xml_file($filename, $xml)
	{
		$file = $this->get_file($filename);
		$result = $xml->asXML($file);
		
		if($result === FALSE)
			$this->set_error('xml_db_save_error');
		
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