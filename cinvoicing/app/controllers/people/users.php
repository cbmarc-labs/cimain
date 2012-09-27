<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users Class
 * 
 * @author marc
 *
 */
class Users extends MY_Controller {

	var $fields = array('login'=>'', 'password'=>'', 'active'=>1, 'sex'=>0, 
			'color'=>array(), 'description'=>'');

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		
		log_message('debug', "Users Class Initialized");

		//$this->output->enable_profiler();

		if(!logged_in())
			redirect('auth');
		
		$this->load->model('user_model');
	}
	
	// --------------------------------------------------------------------

	/**
	 * Index method
	 * 
	 * @access public
	 */
	public function index()
	{
		$this->load->library(array('table'));
		$this->load->helper(array('form'));
				
		$this->table->set_heading(
				'id', 'login', 'created', 'last_update', 'active');
		$this->table->set_template(
				array('table_open'=>'<table class="table table-condensed table-hover" id="datatable_users">'));

		$data = $this->user_model->get_all();
		if($data !== FALSE)
		{
			foreach($data as $user)
			{
				$this->table->add_row(
						$user['id'],
						anchor(current_url().'/edit/'.$user['id'], $user['login']),
						date('Y-m-d H:i:s', strtotime($user['created'])),
						date('Y-m-d H:i:s',strtotime($user['last_update'])),
						form_checkbox(array('name'=>'active', 'value'=>1,
								'checked'=>$user['active']))
				);
			}
		}
		else
		{
			set_error($this->user_model->get_error());
		}

		$this->data['table'] = $this->table->generate();
		$this->_load_view('index_view');

	}
	
	// --------------------------------------------------------------------

	/**
	 * Add method
	 *
	 * @access public
	 */
	public function add()
	{
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form'));
		
		if($this->input->post('submit'))
		{
			$this->_set_form_rules();
				
			// extra rules
			$this->form_validation->set_rules(
					'password', lang('user_form_password'),
					"required|trim|xss_clean|min_length[2]|max_length[25]|alpha_dash|matches[confirm_password]");
			$this->form_validation->set_rules(
					'confirm_password', lang('user_form_confirm_password'),
					'trim|required|xss_clean|matches[password]');
			
			if($this->form_validation->run())
			{
				$data = $this->_get_post();				
				if($this->user_model->insert($data) === TRUE)
				{
					set_success(lang('xml_db_item_saved'), TRUE);
					redirect(current_url());
				}
								
				set_error($this->user_model->get_error());
			}
		}
		
		$this->_set_form_values();
		$this->_load_view('edit_view');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * Edit method
	 *
	 * @access	public
	 */
	public function edit()
	{
		$this->load->library(array('form_validation'));
		$this->load->helper(array('form', 'myurl'));
		
		$id = $this->uri->rsegment(3);
				
		if($id === FALSE)
			redirect_current_controller();
		
		if($this->input->post('delete'))
		{
			if($this->user_model->delete($id) === TRUE)
			{
				set_success(lang('xml_db_item_deleted'), TRUE);
				redirect_current_controller();
			}
		
			// repopulate fields and show error
			$this->_set_form_values();
			set_error($this->user_model->get_error());
		}
		elseif($this->input->post())
		{
			$this->_set_form_rules();
				
			// extra rules
			$this->form_validation->set_rules(
					'password', lang('user_form_password'),
					"trim|xss_clean|alpha_dash|matches[confirm_password]");
			$this->form_validation->set_rules(
					'confirm_password', lang('user_form_confirm_password'),
					'trim|xss_clean|matches[password]');
			
			if($this->form_validation->run())
			{
				$data = $this->_get_post();
				if(isset($data['password']))
					if(empty($data['password']))
						unset($data['password']);
				
				if($this->user_model->update($id, $data) === TRUE)
				{
					set_success(lang('xml_db_item_saved'));
				}
				else
				{
					set_error($this->user_model->get_error());
				}
			}
				
			$this->_set_form_values();
		}
		else
		{
			$data = $this->user_model->get_by_id($id);
			if($data === FALSE)
			{
				set_warning($this->user_model->get_error(), TRUE);
				redirect_current_controller();
			}
			
			$this->_set_form_values($data);
		}

		$this->_load_view('edit_view');
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * edit_ajax method
	 *
	 * @access public
	 * @return array
	 */	
	public function edit_ajax()
	{
		$id = $this->uri->rsegment(3);
		
		if($this->input->is_ajax_request() && $this->input->post() && $id !== FALSE)
		{
			if($this->user_model->update($id, $this->_get_post()) === FALSE)
			{
				set_error($this->user_model->get_error());
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
	
	// --------------------------------------------------------------------
	
	/**
	 * delete method
	 *
	 * @access public
	 */
	public function delete()
	{
		$this->load->helper(array('myurl'));
		
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
			
			redirect_current_controller();
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _get_post method
	 *
	 * @access private
	 * @return array
	 */
	private function _get_post()
	{
		$data = array();
		foreach($this->fields as $k=>$v)
		{
			if($this->input->post($k) !== FALSE)
				$data[$k] = $this->input->post($k);
		}
		
		return $data;		
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _set_form_values method
	 *
	 * @access private
	 * @param array
	 */
	private function _set_form_values($data = FALSE)
	{
		if($data === FALSE)
		{
			$data = $this->_get_post();
		
			foreach($this->fields as $k=>$v)
				if(!isset($data[$k]))
					$data[$k] = $this->fields[$k];
		}
		
		$this->data['field'] = $data;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * _set_form_rules method
	 *
	 * @access private
	 */
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
		
		$this->form_validation->set_rules(
				'description', lang('user_form_description'),
				"trim|xss_clean|max_length[200]");
	}

}