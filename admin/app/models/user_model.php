<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	
	private $table = 'users';
	
	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		
		$this->load->library(array('xml_db'));
	}
	
	function insert()
	{
		$data = $this->_get_post();
		
		if(!isset($data['color'])) $data['color'] = '';
		if(!isset($data['description'])) $data['description'] = '';
		
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
		
		if($this->input->post('login') !== FALSE)
			$data['login'] = $this->input->post('login');
		
		if($this->input->post('password') !== FALSE)
			$data['password'] = md5($this->input->post('password'));
		
		if($this->input->post('active') !== FALSE)
			$data['active'] = $this->input->post('active');
		
		if($this->input->post('sex') !== FALSE)
			$data['sex'] = $this->input->post('sex');
		
		if($this->input->post('color') !== FALSE)
			$data['color'] = implode(',', $this->input->post('color'));
		
		if($this->input->post('description') !== FALSE)
			$data['description'] = $this->input->post('description');
		
		return $data;
	}
	
	function get_error()
	{
		return $this->xml_db->get_error();
	}
	
}