<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	private $header_data = array();
	private $content_data = array();

	public function __construct()
	{
		parent::__construct();

		//$this->output->enable_profiler();

		if(!logged_in())
			redirect('auth');

		$this->load->library(array('table', 'form_validation', 'message', 'session'));
		$this->load->helper(array('form', 'message'));
		$this->load->model('user_model');

		$this->header_data['title'] = "Application - Users";
	}

	public function index()
	{
		//$this->xml_db->create('users');
		
		$this->table->set_heading(
				'id', 'login', 'created', 'last_update', 'active');
		$this->table->set_template(
				array('table_open'=>'<table class="table table-condensed table-hover" id="datatable_users">'));

		$data = $this->user_model->get_all();

		if($data === FALSE)
		{
			set_error($this->user_model->get_error());
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
						form_checkbox(array('name'=>'active', 'value'=>1,
								'checked'=>$user['active']))
				);
			}
		}

		$this->content_data['table'] = $this->table->generate();

		$this->_load_view('users/index_view');

	}

	public function add()
	{
		$this->content_data['section'] = lang('user_section_title_add');
		$this->_set_default_form_values();

		if($this->input->post('submit'))
		{
			$this->_set_form_rules();
				
			// EXTRA RULES FOR ADD
			$this->form_validation->set_rules(
					'password', lang('user_form_password'),
					"required|trim|xss_clean|min_length[2]|max_length[25]|alpha_dash|matches[confirm_password]");
			$this->form_validation->set_rules(
					'confirm_password', lang('user_form_confirm_password'),
					'trim|required|xss_clean|matches[password]');
			
			if($this->form_validation->run())
			{
				if($this->user_model->insert() === FALSE)
				{
					$this->_set_form_values();
					set_error($this->user_model->get_error());
				}
				else
				{
					$this->_set_default_form_values();
					set_success(lang('xml_db_item_saved'));
				}
			}
			else
			{
				$this->_set_form_values();
			}
				
		}

		$this->_load_view('users/edit_view');
	}

	public function edit()
	{
		$this->content_data['section'] = lang('user_section_title_edit');
		$id = $this->uri->segment(3);
		
		if($this->input->post('delete'))
		{
			if($this->user_model->delete($id))
			{
				set_success(lang('xml_db_item_deleted'), TRUE);
				redirect('users');
			}
		
			// repopulate fields and show error
			$this->_set_form_values();
			set_error($this->user_model->get_error());
		}
		elseif($this->input->post())
		{
			$this->_set_form_rules();
				
			// EXTRA RULES FOR EDIT
			$this->form_validation->set_rules(
					'password', lang('user_form_password'),
					"trim|xss_clean|alpha_dash|matches[confirm_password]");
			$this->form_validation->set_rules(
					'confirm_password', lang('user_form_confirm_password'),
					'trim|xss_clean|matches[password]');
			
			if($this->form_validation->run())
			{
				if($this->user_model->update($id) === FALSE)
				{
					$error = $this->user_model->get_error();
					set_error($error);
				}
				else
				{
					set_success(lang('xml_db_item_saved'));
				}
			}
				
			$this->_set_form_values();
		}
		else
		{
			$this->content_data['user'] = $this->user_model->get_by_id($id);
			if($this->content_data['user'] === FALSE)
			{
				set_warning($this->user_model->get_error(), TRUE);
				redirect('users');
			}
		}

		$this->_load_view('users/edit_view');
	}
	
	public function edit_ajax()
	{
		$id = $this->uri->segment(3);
		
		if($this->input->is_ajax_request() && $this->input->post() && $id !== FALSE)
		{
			if($this->user_model->update($id) === FALSE)
			{
				$error = $this->user_model->get_error();
				set_error($error);
			
				$result = array('error'=>1, 'type'=>'error',
						'message'=>$error);
			}
			else
			{
				set_success(lang('xml_db_item_saved'));
					
				$result = array('error'=>0, 'type'=>'success',
						'message'=>lang('xml_db_update_success'));
			}
			
			header('Content-Type: application/json', true);
			echo json_encode($result);
		}
	}

	public function delete()
	{
		if($this->input->post())
		{
			$ids = $this->input->post('ids');
			
			$values = explode(",", $ids);
			$it = 0;

			foreach($values as $id)
			{
				if($this->user_model->delete($id))
					$it ++;
			}

			if($it == count($values))
				set_success(lang('xml_db_item_deleted'), TRUE);
			else
				set_warning($it . '/' . count($values) . ' ' .
						lang('xml_db_item_deleted'), TRUE);
			
			redirect('users');
		}
	}
	
	private function _set_default_form_values()
	{
		$data = array();
		
		$data['login'] = '';
		$data['active'] = 1;
		$data['sex'] = 0;
		$data['color'] = array();
		
		$this->content_data['user'] = $data;
	}

	private function _set_form_values()
	{
		$data = array();
		
		if($this->input->post('login') !== FALSE)
			$data['login'] = $this->input->post('login');
		
		if($this->input->post('login') !== FALSE)
			$data['active'] = $this->input->post('active');
		
		if($this->input->post('sex') !== FALSE)
			$data['sex'] = $this->input->post('sex');
		
		$data['color'] = array();
		if($this->input->post('color') !== FALSE)
			$data['color'] = $this->input->post('color');
		
		$this->content_data['user'] = $data;
	}

	private function _set_form_rules()
	{
		$this->form_validation->set_error_delimiters(' (', ')');
		
		$this->form_validation->set_message('required', 'Required Field');
		$this->form_validation->set_message('matches', 'Not match');
		$this->form_validation->set_message('is_natural_no_zero', 'Required Field');
		$this->form_validation->set_message('alpha_dash', 'Not valid');
				
		$this->form_validation->set_rules(
				'login', lang('user_form_login'),
				"trim|required|xss_clean|min_length[2]|max_length[25]|alpha_dash");
		
		$this->form_validation->set_rules(
				'sex', lang('user_form_sex'), "is_natural_no_zero");
	}

	private function _load_view($view)
	{
		$this->load->view('header_view', $this->header_data);
		$this->load->view($view, $this->content_data);
		$this->load->view('footer_view');
	}

}