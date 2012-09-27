<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	private $table = 'users';
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->library(array('xml_db'));
	}
	
	function insert($data)
	{
		$data['password'] = md5($data['password']);
		
		if(is_array($data['color']))
			$data['color'] = implode(',', $data['color']);
		
		$data['created'] = date(DATE_ISO8601);
		$data['last_update'] = date(DATE_ISO8601);
		
		return $this->xml_db->insert($this->table, $data);
	}
	
	function update($id, $data)
	{
		if(isset($data['password']))
			$data['password'] = md5($data['password']);
		
		if(isset($data['color']))
			if(is_array($data['color']))
				$data['color'] = implode(',', $data['color']);
		
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
	
	function get_error()
	{
		return $this->xml_db->get_error();
	}
	
}