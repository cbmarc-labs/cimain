<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	private $table = 'users';
	private $fields = array('login', 'password', 'active', 'sex', 'color', 
			'description');
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->library(array('xml_db'));
	}
	
	function insert()
	{
		$data = $this->_get_post();
		
		foreach($this->fields as $f)
			if(!isset($data[$f])) $data[$f] = '';
		
		$data['created'] = date(DATE_ISO8601);
		$data['last_update'] = date(DATE_ISO8601);
		
		return $this->xml_db->insert($this->table, $data);
	}
	
	function update($id)
	{
		$data = $this->_get_post();
				
		$data['id'] = $id;
		$data['last_update'] = date(DATE_ISO8601);
		
		return $this->xml_db->update($this->table, $data);
	}
	
	function get_all()
	{
		$result = $this->xml_db->get($this->table);
		
		foreach($result as $res)
		{
			$res['color'] = explode(',', $res['color']);
		}
		
		return $result;
	}
	
	function get_by_id($id)
	{
		$result = $this->xml_db->get($this->table, $id);
		
		if($result !== FALSE)
		{
			$result['color'] = explode(',', $result['color']);
		}
		
		return $result;
	}
	
	function delete($id)
	{
		return $this->xml_db->delete($this->table, $id);
	}
	
	private function _get_post()
	{
		$data = array();
		
		foreach($this->fields as $f)
			if($this->input->post($f) !== FALSE)
				$data[$f] = $this->input->post($f);
		
		if(isset($data['color']))
			$data['color'] = implode(',', $data['color']);
		
		if(isset($data['password']))
			if(empty($data['password']))
				unset($data['password']);
			else
				$data['password'] = md5($data['password']);
		
		return $data;
	}
	
	function get_error()
	{
		return $this->xml_db->get_error();
	}
	
}