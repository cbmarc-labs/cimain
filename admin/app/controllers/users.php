<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	private $header_data = array();
	private $info_data = array();
	private $content_data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->output->enable_profiler();
		
		if(!logged_in())
			redirect('auth');
		
		$this->load->library(array('XmlDB', 'table'));
		$this->load->helper('form');
		
		$this->header_data['title'] = "Application";
		
	}
	
	public function index()
	{
		//$this->xmldb->create('users');
		$data = $this->xmldb->get('users');
		
		if($data === FALSE)
			$this->info_data['error'] = $this->xmldb->get_error();
		
		$this->table->set_heading('id', 'login', 'created', 'last_update');
		$this->table->set_template(
				array('table_open'=>'<table id="datatable">'));
		$this->content_data['table'] = $this->table->generate($data);
		
		$this->_load_view('users/index_view');
		
	}
	
	public function edit()
	{
		$this->load->library('form_validation');
		
		$id = $this->uri->segment(3);
		
		if($this->input->post('submit') || $this->input->post('delete')) {
			$this->form_validation->set_rules(
				'login', lang('user_form_login'),
				"trim|required|xss_clean|min_length[2]|max_length[25]");
			
			$validation = $this->form_validation->run();
			
			if($this->input->post('submit')) {
				if($validation) {
					$this->_do_save($id);
				}
			} else {
				$this->_do_delete($id);
			}
		} else {
			if($id != null) {
				$this->content_data['user'] = $this->xmldb->get('users', $id);
				
				if($this->content_data['user'] == null)
					$this->info_data['error'] = $this->xmldb->get_error();
				
			}
		}
		
		$this->_load_view('users/edit_view');
	}
	
	private function _do_delete($id)
	{
		if($this->xmldb->delete('users', $id)) {
			$this->session->set_flashdata('info', lang('xmldb_item_deleted'));
			redirect('users');
		}
		
		$this->info_data['error'] = $this->xmldb->get_error();
	}
	
	private function _do_save($id)
	{
		$user['id'] = $id;
		$user['login'] = set_value('login');
		if($user['id'] === FALSE)
			$user['created'] = date(DATE_ISO8601);
		$user['last_update'] = date(DATE_ISO8601);
				
		if($this->xmldb->save('users', $user)) {
			if($id === FALSE) {
				$this->session->set_flashdata('info', lang('xmldb_item_saved'));
				redirect('users/edit');
			}
		
			$this->info_data['info'] = lang('xmldb_item_saved');
		} else {
			$this->info_data['error'] = $this->xmldb->get_error();
		}
	}
	
	private function _load_view($view)
	{
		$this->load->view('header_view', $this->header_data);
		$this->load->view('nav_view');
		$this->load->view('info_view', $this->info_data);
		$this->load->view($view, $this->content_data);
		$this->load->view('footer_view');		
	}
	
}