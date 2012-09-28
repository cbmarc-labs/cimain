<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products_model extends CI_Model {
	
	private $table = 'products';
		
	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('xml_db'));
	}
	
	function insert($data)
	{
		return $this->xml_db->insert($this->table, $data);
	}
	
	function update($id, $data)
	{
		$data['id'] = $id;
		
		return $this->xml_db->update($this->table, $data);
	}
	
	function get_all()
	{
		$result = $this->xml_db->get($this->table);
		
		return $result;
	}
	
	function get_by_id($id)
	{
		$result = $this->xml_db->get($this->table, $id);
		
		return $result;
	}
	
	function delete($id)
	{
		return $this->xml_db->delete($this->table, $id);
	}
	
	function get_error()
	{
		return $this->xml_db->get_error();
	}
	
}