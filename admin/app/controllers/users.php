<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {
	
	private $header_data = array();
	private $msg_data = array();
	private $content_data = array();
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->output->enable_profiler();
		
		if(!logged_in())
			redirect('auth');
		
		$this->load->library(array('xml_db', 'table', 'form_validation'));
		$this->load->helper('form');
		
		$this->header_data['title'] = "Application - Users";
		
	}
	
	public function index()
	{		
		$this->table->set_heading(
				'id', 'login', 'created', 'last_update', 'active');
		$this->table->set_template(
				array('table_open'=>'<table id="datatable">'));
		
		$data = $this->xml_db->get('users');
		
		if($data === FALSE)
		{
			$this->_set_msg('error_msg', $this->xml_db->get_error());
		}
		else
		{
			foreach($data as $user)
			{
				$this->table->add_row(
						$user['id'],
						anchor('users/edit/'.$user['id'], $user['login']),
						$user['created'], 
						date('d-m-Y',strtotime($user['last_update'])),
						//form_checkbox(array('name'=>'active', 'value'=>1, 'checked'=>$user['active']))
						form_checkbox(array('name'=>'active', 'value'=>1, 'checked'=>$user['active']))
						);
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
			
			// EXTRA RULES FOR ADD
			$this->form_validation->set_rules(
					'password', lang('user_form_password'),
					"required|trim|xss_clean|min_length[2]|max_length[25]|alpha_dash");
			$this->form_validation->set_rules(
					'confirm_password', lang('user_form_confirm_password'), 
					'trim|required|xss_clean|matches[password]');
			
			$this->content_data['user'] = $this->_get_values();
			
			if($this->form_validation->run())
			{
				$user = $this->_get_values();
				$user['created'] = date(DATE_ISO8601);
				$user['last_update'] = date(DATE_ISO8601);
								
				if($this->xml_db->save('users', $user))
				{
					$this->content_data['user'] = $this->_set_values();
					$this->_set_msg('success_msg', lang('xml_db_item_saved'));
				}
				else
				{
					$this->_set_msg('error_msg', $this->xml_db->get_error());
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
			
			// EXTRA RULES FOR EDIT
			$this->form_validation->set_rules(
					'password', lang('user_form_password'),
					"trim|xss_clean|alpha_dash|matches[confirm_password]");
			$this->form_validation->set_rules(
					'confirm_password', lang('user_form_confirm_password'),
					'trim|xss_clean|matches[password]');
			
			if($this->form_validation->run())
			{
				$user = $this->_get_values();
				$user['id'] = $id;
				$user['last_update'] = date(DATE_ISO8601);
								
				if($this->xml_db->save('users', $user))				
					$this->_set_msg('success_msg', lang('xml_db_item_saved'));
				else
					$this->_set_msg('error_msg', $this->xml_db->get_error());
			}
			
			$this->content_data['user'] = $this->_get_values();
		}
		elseif($this->input->post('delete'))
		{
			if($this->xml_db->delete('users', $id))
			{
				$this->_set_flashdata('success_msg', 
						lang('xml_db_item_deleted'));
				redirect('users');
			}
			
			// repopulate fields and show error
			$this->content_data['user'] = $this->_get_values();
			$this->_set_msg('error_msg', $this->xml_db->get_error());
		}
		else
		{
			$this->content_data['user'] = $this->xml_db->get('users', $id);
			
			if($this->content_data['user'] == null)
			{
				$this->_set_flashdata('warning_msg', 
						$this->xml_db->get_error());
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
					if($this->xml_db->delete('users', $id))
						$it ++;
				}
				
				if($it == count($values))
					$this->_set_flashdata('success_msg', 
							lang('xml_db_item_deleted'));
				else 
					$this->_set_flashdata('warning_msg',
							$it . '/' . count($values) . ' ' .
							lang('xml_db_item_deleted'));
			}
			else
			{
				$this->_set_flashdata('error_msg', lang('general_error'));
			}
		}
		else 
		{
			$this->_set_flashdata('error_msg', lang('general_error'));
		}
		
		redirect('users');
	}
	
	public function update()
	{
		if($this->input->is_ajax_request() == TRUE)
		{
			$data['id'] = $this->input->post('id');
			$data['active'] = $this->input->post('active');
			
			$error = array();
			if(!$this->xml_db->save('users', $data))
				$error = array('msg_type'=>'error_msg', 
						'msg_value'=>$this->xml_db->get_error());
			
			header('Content-Type: application/json',true);
			echo json_encode($error);
		}
	}
	
	private function _set_values()
	{
		$data['login'] = '';
		$data['password'] = '';
		$data['active'] = 1;
		
		$this->content_data['user'] = $data;
	}
	
	private function _get_values()
	{
		$data['login'] = $this->input->post('login');
		if($this->input->post('password'))
			$data['password'] = md5($this->input->post('password'));
		$data['active'] = $this->input->post('active')?1:0;
				
		return $data;
	}
	
	private function _set_rules()
	{
		$this->form_validation->set_error_delimiters(
				'<div class="error_field">', '</div>');
		
		$this->form_validation->set_rules(
				'login', lang('user_form_login'),
				"trim|required|xss_clean|min_length[2]|max_length[25]|alpha_dash");
	}
	
	private function _set_msg($type, $value)
	{
		$this->msg_data['msg_type'] = $type;
		$this->msg_data['msg_value'] = $value;
	}
	
	private function _set_flashdata($type, $value)
	{
		$this->session->set_flashdata('msg_type', $type);
		$this->session->set_flashdata('msg_value', $value);
	}
	
	private function _load_view($view)
	{
		$this->load->view('header_view', $this->header_data);
		$this->load->view('nav_view');
		$this->load->view('msg_view', $this->msg_data);
		$this->load->view($view, $this->content_data);
		$this->load->view('footer_view');		
	}
	
}