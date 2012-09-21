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
		
		$this->load->library(array('XmlDB', 'table', 'form_validation'));
		$this->load->helper('form');
		
		$this->header_data['title'] = "Application - Users";
		
	}
	
	public function index()
	{		
		$this->table->set_heading('id', 'login', 'created', 'last_update');
		$this->table->set_template(
				array('table_open'=>'<table id="datatable">'));
		
		$data = $this->xmldb->get('users');
		
		if($data === FALSE)
		{
			$this->info_data['error'] = $this->xmldb->get_error();
		}
		else
		{
			foreach($data as $user)
			{
				$this->table->add_row(
						$user['id'],
						anchor('users/edit/'.$user['id'], $user['login']),
						$user['created'], 
						date('d-m-Y',strtotime($user['last_update'])));
			}
		}
		
		$this->content_data['table'] = $this->table->generate();
		
		$this->_load_view('users/index_view');
		
	}
	
	public function add()
	{
		$this->_set_values();
		
		if($this->input->post('submit'))
		{
			$this->_set_rules();
			$this->content_data['user'] = $this->_get_values();
			
			if($this->form_validation->run())
			{
				$user = $this->_get_values();
				$user['created'] = date(DATE_ISO8601);
				$user['last_update'] = date(DATE_ISO8601);
				
				if($this->xmldb->save('users', $user))
				{
					$this->content_data['user'] = $this->_set_values();
					$this->info_data['info'] = lang('xmldb_item_saved');
				}
				else
				{
					$this->info_data['error'] = $this->xmldb->get_error();
				}
			}
			
		}
		
		$this->_load_view('users/edit_view');
	}
	
	public function edit()
	{		
		$id = $this->uri->segment(3);
		
		if($this->input->post('submit'))
		{
			$this->_set_rules();
			
			if($this->form_validation->run())
			{
				$user = $this->_get_values();
				$user['id'] = $id;
				$user['last_update'] = date(DATE_ISO8601);
				
				if($this->xmldb->save('users', $user))				
					$this->info_data['info'] = lang('xmldb_item_saved');
				else
					$this->info_data['error'] = $this->xmldb->get_error();
			}
			
			$this->content_data['user'] = $this->_get_values();
		}
		elseif($this->input->post('delete'))
		{
			if($this->xmldb->delete('users', $id))
			{
				$this->session->set_flashdata('info', 
						lang('xmldb_item_deleted'));
				redirect('users');
			}
			
			// repopulate fields and show error
			$this->content_data['user'] = $this->_get_values();
			$this->info_data['error'] = $this->xmldb->get_error();
		}
		else
		{
			$this->content_data['user'] = $this->xmldb->get('users', $id);
			
			if($this->content_data['user'] == null)
			{
				$this->session->set_flashdata('info', 
						$this->xmldb->get_error());
				redirect('users');
			}
		}
		
		$this->_load_view('users/edit_view');
	}
	
	public function delete()
	{		
		$ids = $this->input->post('ids');
		
		if($ids)
		{
			$this->form_validation->set_rules('ids','ids',
					'trim|required|xss_clean');
			
			if($this->form_validation->run())
			{
				$values = explode(",", $ids);
				$it = 0;
												
				foreach($values as $id)
				{
					if($this->xmldb->delete('users', $id))
						$it ++;
				}
				
				if($it == count($values))
					$this->session->set_flashdata('info',
						lang('xmldb_item_deleted'));
				else 
					$this->session->set_flashdata('error',
							$it . '/' . count($values) . ' ' .
							lang('xmldb_item_deleted'));
			}
			else
			{
				$this->session->set_flashdata('error', lang('general_error'));
			}
		}
		else 
		{
			$this->session->set_flashdata('error', lang('general_error'));
		}
		
		redirect('users');
	}
	
	private function _set_values()
	{
		$data['login'] = '';
		
		$this->content_data['user'] = $data;
	}
	
	private function _get_values()
	{
		$data['login'] = $this->input->post('login');
		
		return $data;
	}
	
	private function _set_rules()
	{
		$this->form_validation->set_rules(
				'login', lang('user_form_login'),
				"trim|required|xss_clean|min_length[2]|max_length[25]");
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